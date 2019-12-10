<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reservation;

class ReservationController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function date_conflict($rooms) {
    	$today = date("Y-m-d");
    	$reservation_conflict = [];
    	$res = [];
    	foreach ($rooms as $room) {
 			$room_id = $room->room_id;
 			$no_of_nights = $room->no_of_nights;
 			$d = strtotime("+"."$no_of_nights days");
    		$check_out_date = date("Y-m-d", $d);
 			if (Reservation::where([['room_id', $room_id],['reserved_date', '>=', $today] ])->exists()) {
 				$reservation = Reservation::where([
    			  ['room_id', $room_id],
    			  ['reserved_date', '>=', $today] 
    		    ])->first();

    		    $compare_checkin = date_create($reservation->reserved_date);
    		    $compare_checkout = date_create($reservation->reserved_date);
    		    $reserved_nights = $reservation->no_of_nights;
		   		date_add($compare_checkout, date_interval_create_from_date_string("$reserved_nights days"));
		        if ((($today < $compare_checkin) && ($check_out_date < $compare_checkin)) || ($today > $compare_checkout) && ($check_out_date > $compare_checkout)) {
 	            } else {
 	  	            $reservation_conflict[] = $reservation->reservation_ref . " / " . $rooms->room_number;
 	            }
 			}
 		}

 		if (count($reservation_conflict)) {
 	    	$reservation_conflicts = implode(", ", $reservation_conflict);
 	    	$res["OUTPUT"] = $reservation_conflicts . " conflicts";
            $res["status"] = 204;
 			return $res;
 		} else {
 			$res["OUTPUT"] = 0;
            $res["status"] = 200;
            return $res;
 		}
    }
}
