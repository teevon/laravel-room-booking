<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Guest;
use App\Booking;
use App\Room;
use App\Reservation;
use App\Payment;
use App\Transaction;

class GuestController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function index(){
    	$guests = Guest::get()->toJson(JSON_PRETTY_PRINT);
    	return response($guests);
    }

    public function create(){}

    public function store($checkin_data) {
    	$res = [];
    	foreach ($checkin_data as $key => $value) {
    		${"$key"} = $value;
    	}

 		$guest = new Guest();
 		foreach ($checkin_data as $index => $data) {
 				$guest->{"$index"} = $data;
 		}
 		$guest->save();
 		$res['OUTPUT'] = "Guest Added";
        $res['status'] = 200;
 		return $res;
    }

    public function show(){}

    public function edit(){}

    public function update(Request $request){
    	$update_guest = json_decode($request->update_guest, true);
    	// $update_guest = '{"contact_address": "No 20 Woji Road", "guest_name": "Ethan McClure PhD", "guest_type_gender": "female", "id": "XYbFA0DRI7", "new_contact_address": "", "new_guest_name": "Ser June", "new_guest_type_gender": "male", "new_phone_number": "", "phone_number": "729.886.9633 x4"}';
    	// $update_guest = json_decode($update_guest, true);

    	$id = $update_guest["id"];
        $guest_name = $update_guest["new_guest_name"] ? $update_guest["new_guest_name"] : $update_guest["guest_name"];
        $guest_type_gender = $update_guest["new_guest_type_gender"] ? $update_guest["new_guest_type_gender"] : $update_guest["guest_type_gender"];
        $phone_number = $update_guest["new_phone_number"] ? $update_guest["new_phone_number"] : $update_guest["phone_number"];
        $contact_address = $update_guest["new_contact_address"] ? $update_guest["new_contact_address"] : $update_guest["contact_address"];

    	if(Guest::where('guest_id', $id)->exists()) {
    		$guest = Guest::where('guest_id', $id)->firstOrFail();
    		$guest->guest_name = $guest_name;
    		$guest->guest_type_gender = $guest_type_gender;
    		$guest->phone_number = $phone_number;
    		$guest->contact_address = $contact_address;
    		$guest->save();

    		return response()->json([ "OUTPUT" ," records updated successfully " ], 200);

    		//echo json_decode($request);
    	} else {
            return response()->json([ "ERROR" ,"Guest not found"], 404);
        }
    }

    public function destroy(){}

    public function setArrayKeyToVariable($arr) {
    	foreach ($arr as $key => $value) {
    		${"$key"} = $value;
    	}
    }
}
