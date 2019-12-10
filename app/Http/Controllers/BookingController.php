<?php

namespace App\Http\Controllers;

use App\Guest;
use App\Booking;
use App\Room;
use App\Reservation;
use App\Payment;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function custom_listing(Request $request) {
    	$column = $request->col;
    	$val = $request->val;
    	if (is_int($val)) {
          $check_val = $val;
        } else {
          $check_val = strval($val);
        }

        $bookings = Booking::where([[$column, $check_val]])->get();
        echo json_encode($bookings);
    }

    public function store(Request $request) {
    	$checkin_data = json_decode($request->input('checkin_data'));

    	$guest_id = "LOD_" . mt_rand(0, 100000);
 		while (Guest::where('guest_id', $guest_id)->exists()) {
 			$guest_id = "LOD_" . mt_rand(0, 100000);
 		}

    	$booking_ref = "BK_" . mt_rand(0, 100000);
 		while (Booking::where('booking_ref', $booking_ref)->exists()) {
 			$booking_ref = "LOD_" . mt_rand(0, 100000);
 		}
 		
 		foreach ($checkin_data as $key => $value) {
    		${"$key"} = $value;
    	}

    	$room_outstanding = $room_outstanding ? $room_outstanding + $balance : $balance;
    	$guest = compact("guest_name", "guest_id", "guest_type_gender", "phone_number", "contact_address", "room_outstanding", "total_rooms_booked");

    	$reservation_response = app('App\Http\Controllers\ReservationController')->date_conflict($rooms);
    	if($reservation_response["status"] != 200) {
    		return $reservation_response;
    	}

    	$room_response = app('App\Http\Controllers\RoomController')->book($rooms);
    	if($room_response['status'] != 200) {
    		return $room_response["OUTPUT"];
    	}

    	$guest_response = app('App\Http\Controllers\GuestController')->store($guest);
    	if($guest_response['status'] != 200) {
    		return $guest_response["OUTPUT"];
    	}
    	$transaction_type = "Booking";
    	$payment_status = $balance ? "OWING" : "PAID FULL";

    	$transaction = compact("means_of_payment", "transaction_type", "booking_ref", "guest_id", "total_rooms_booked",
    		"total_cost", "deposited", "balance", "means_of_payment", "payment_status", "frontdesk_rep");
    	$transaction_entry = Transaction::create($transaction);

    	$frontdesk_txn = $booking_ref;
    	$amount_paid = $deposited;
    	$amount_balance = $balance;
    	$net_paid = $amount_paid;
    	$txn_worth = $total_cost;
    	$payment = compact("frontdesk_txn", "amount_paid", "guest_id", "txn_worth", "net_paid", "amount_balance", "means_of_payment", "frontdesk_rep");
    	$payment_entry = Payment::create($payment);

    	//return response()->json([ "OUTPUT" , print_r($rooms) ], 200);

    	foreach ($rooms as $room) {
    		foreach ($room as $index => $detail) {
          if($index != "booking_ref") {
            ${"$index"} = $detail;
          }
    		}
        $booked = compact("booking_ref", "guest_id", "guest_name", "room_number", "room_id", "room_category", "room_rate", "no_of_nights");
    		$booked["net_cost"] = $room_rate * $no_of_nights;
    		$d = strtotime("+"."$no_of_nights days");
			  $booked["expected_check_out_date"] = date("Y-m-d", $d);
			  $booking = Booking::create($booked);
			  $booked_room = Room::where('room_id', $room_id)->firstOrFail();
    		$booked_room->booked_on = now();
    		$booked_room->booked = "YES";
    		$booked_room->guests = $guests;
    		$booked_room->current_guest_id = $guest_id;
    		$booked_room->booking_ref = $booking_ref;
    		$booked_room->booking_expires = $booked["expected_check_out_date"];
    		$booked_room->save();
    	}
    	$res[0] = "OUTPUT";
        $res[1] = "SUCCESSFULLY ADDED";
 		return $res;

    	//return response()->json([ "OUTPUT" ,"Rooms Booked successfully " ], 200);
    }
}
