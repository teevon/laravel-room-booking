<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Guest;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Guest::class, function (Faker $faker) {
    return [
        'guest_name' => $faker->name,
        'guest_id' => Str::random(10),
        'guest_type_gender' => 'female',
        'phone_number' => $faker->phoneNumber,
        'contact_address' => 'No 20 Woji Road',
        //'email' =>  $faker->unique()->safeEmail,
        'total_rooms_booked' => 1,
        'check_in_date' => $faker->dateTimeBetween('-1 month', '+0 days'),
        'room_outstanding' => rand(1000, 10000),
        'restaurant_outstanding' => rand(1000, 10000),
        'checked_out' => 'NO',
        'checked_in' => 'YES',
        'visit_count' => rand(1, 10),
    ];
});
