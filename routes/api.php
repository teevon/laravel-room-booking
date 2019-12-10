<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('guests', 'GuestController@index');
Route::get('guests/create', 'GuestController@create');
Route::post('guests', 'GuestController@store');
Route::get('guests/{guest}', 'GuestController@show');
Route::get('guests/{guest}/edit', 'GuestController@edit');
Route::put('guests/{guest}', 'GuestController@update');
Route::delete('guests/{guest}', 'GuestController@destroy');

Route::post('bookings/custom', 'BookingController@custom_listing');
Route::post('bookings', 'BookingController@store');

Route::post('rooms', 'RoomController@index');
Route::get('rooms/category', 'RoomController@category');

Route::get('reservations/conflicts', 'ReservationController@date_conflict');

Route::post('payments/', 'PaymentController@store');

Route::post('transactions/', 'TransactionController@store');
