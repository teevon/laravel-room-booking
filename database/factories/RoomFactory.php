<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Room;
use App\Booking;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Room::class, function (Faker $faker) {
	$rm_cat = mt_rand(1, 10);
	$room_category = "standard";
	if(($rm_cat % 2)) {
		$room_category = "deluxe";
	}
    return [
        'room_number' => mt_rand(1, 500),
        'room_id' => Str::random(10),
        'room_category' => $room_category,
        'room_rate' => 5000,
    ];
});
