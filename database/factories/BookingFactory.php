<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Booking;
use App\Guest;
use App\Room;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Booking::class, function (Faker $faker) {
	$guest = factory(\App\Guest::class)->create();
	$room = factory(\App\Room::class)->create();
	$room->current_guest_id = $guest->guest_id;
	$room->booked = "YES";
	$room->guests = 2;
	$booking_ref = Str::random(10);
	$room->booking_ref = $booking_ref;
	$room->booked_on = now();
	$check_out = $faker->dateTimeBetween('+1 day', '+5 days');
	$room->booking_expires = $check_out;
	$room->save();
    return [
        'booking_ref' => $booking_ref,
        'room_number' => $room->room_number,
        'room_rate' => $room->room_rate,
        'guest_id' => $guest->guest_id,
        'guest_name' => $guest->guest_name,
        'no_of_nights' => rand(1, 5),
        'net_cost' => 25000,
        'guests' => 2,
        'check_in_date' => now(),
        'expected_check_out_date' => $check_out,
        'extended_stay' => 0,
        'checked_out' => 0,
    ];
});
