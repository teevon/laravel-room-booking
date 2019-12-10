<?php

namespace App\Http\Controllers;
use App\Room;
use App\Reservation;

use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function index() {
    	$rooms = Room::get()->toJson(JSON_PRETTY_PRINT);
    	$rooms = json_decode($rooms, true);
    	foreach ($rooms as &$room) {
    		$reservations = Reservation::where('room_id', $room['room_id'])
    		->orderBy('reserved_date')->get();
    		$room["reservations"] = $reservations;
    		// if($room['room_number'] == 85)
    		//   return $room;
    	}
    	return $rooms;
    }

    public function category(Request $request) {
    	$category = $request->input('category');
    	$rooms = Room::where([
    		['room_category', $category],
    		['booked', 'NO'] 
    	])->get()->toJson(JSON_PRETTY_PRINT);
    	//return response()->json([ "OUTPUT" ,"hey $category records updated successfully " ], 200);
    	return response($rooms);
    }

    public function book($rooms) {
    	$no_of_rooms = count($rooms);
    	$res = [];

 		if (($no_of_rooms == 0) || ($no_of_rooms == "")) {
 			$res['ERROR'] = "No room selected";
            $res['status'] = 203;
    		return $res;
 		}

 		foreach ($rooms as $room => $value) {
    		$room_number = $room["room_number"];
    		if (Room::where([
    			['room_number', $room_number],
    			['booked', 'YES'] 
    		])->exists()) {
    			$res['ERROR'] = $room_number . " already booked";
              	$res['status'] = 204;
    			return $res;
    		}
    	}
    	$res['status'] = 200;
    	return $res;
    }
}
