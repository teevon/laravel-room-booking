<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment;
use App\Transaction;
use App\Guest;

class PaymentController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function store(Request $request) {
    	$payment_details = json_decode($request->input('payment_details'), true);
    	$means_of_payment = $payment_details["means_of_payment"];
		$amount_paid = $payment_details["amount_paid"];

		if ($amount_paid <= 0) {
			$msg_response[0] = "ERROR";
          	$msg_response[1] = "Please pay a valid amount";
         	return response()->json($msg_response, 201);
  		}
  		$frontdesk_rep = $payment_details["frontdesk_rep"];
		$guest_id = $payment_details["guest_id"];
		$guest = Guest::where('guest_id', $guest_id)->firstOrFail();

		if ($amount_paid > $guest->room_outstanding) {
  			$msg_response[0] = "ERROR";
 			$msg_response[1] = "outstanding balance is being over paid for, please adjust payment details";
 			return response()->json($msg_response, 200);
 		}

 		if(Transaction::where([
           ['guest_id', $guest_id], 
           ['balance', '!=', '0']])->exists()) { 
           	  $transactions = Transaction::where([['guest_id', $guest_id], ['balance', '!=', '0']])
           	  ->orderBy('balance', 'desc')->get();
        } else {
        	$msg_response[0] = "ERROR";
 			$msg_response[1] = "This guest does not have an outstanding room booking balance ";
 			return response()->json($msg_response, 200);
        }

        for ($i=0; $amount_paid>0; $i++) { 
        	$last_payment = Payment::where('frontdesk_txn', ($transactions[$i])->booking_ref)->latest()->first();
        	$txn_worth = $last_payment->txn_worth;
        	if(($last_payment->amount_balance - $amount_paid) >= 0) {
    			$net_paid = $last_payment->net_paid + $amount_paid;
    			$last_payment->payment_index = $last_payment->payment_index + 1;
    			$last_payment->amount_balance = $last_payment->amount_balance - $amount_paid;
    			$last_payment->amount_paid = $amount_paid;
    			$last_payment->net_paid = $net_paid;
    			$last_payment->date_of_payment = now();
    			$last_payment->means_of_payment = $means_of_payment;
    			$last_payment->frontdesk_rep = $frontdesk_rep;
    			$last_payment->id = null;
    			$last_payment = json_decode(json_encode($last_payment), true);
    			$new_payment = Payment::create($last_payment);

    			if (!($last_payment["amount_balance"])) {
       				$payment_status = "PAID FULL";
    			} else {
       				$payment_status = "OWING";
    			}

    			$update_txn = Transaction::where('booking_ref', $last_payment["frontdesk_txn"])->first();
    			$update_txn->payment_status = $payment_status;
    			$update_txn->deposited = $net_paid;
    			$update_txn->balance = $last_payment["amount_balance"];
    			$update_txn->save();

    			$update_guest = Guest::where('guest_id', $guest_id)->first();
    			$update_guest->room_outstanding = $update_guest->room_outstanding - $amount_paid;
    			$update_guest->save();
    			$amount_paid = 0;
        	} else {
        		$net_paid = $last_payment->txn_worth;
    			$last_payment->payment_index = $last_payment->payment_index++;
    			$last_payment->amount_paid = $last_payment->amount_balance;
    			$extra = $amount_paid - $last_payment->amount_balance;
    			$last_payment->amount_balance = 0;
    			$last_payment->net_paid = $net_paid;
    			$last_payment->date_of_payment = now();
    			$last_payment->means_of_payment = $means_of_payment;
    			$last_payment->frontdesk_rep = $frontdesk_rep;
    			$last_payment->id = null;
    			$last_payment = json_decode(json_encode($last_payment), true);
    			$new_payment = Payment::create($last_payment);

    			$update_txn = Transaction::where('booking_ref', $last_payment["frontdesk_txn"])->first();
    			$update_txn->payment_status = "PAID FULL";
    			$update_txn->deposited = $net_paid;
    			$update_txn->balance = 0;
    			$update_txn->save();

    			$update_guest = Guest::where('guest_id', $guest_id)->first();
    			$update_guest->room_outstanding = $update_guest->room_outstanding - $amount_paid;
    			$update_guest->save();
    			$amount_paid = $extra;
        	}
        }

        $msg_response[0] = "OUTPUT";
      	$msg_response[1] = "PAYMENT RECORDS UPDATED";
      	return response()->json($msg_response, 200);
    }
}
