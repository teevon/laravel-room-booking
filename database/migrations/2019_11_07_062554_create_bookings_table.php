<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('booking_ref');
            $table->integer("room_number");
            $table->integer("room_id")->nullable();
            $table->integer("room_category")->nullable();
            $table->integer("room_rate");
            $table->string("guest_name")->nullable();
            $table->string("guest_id")->nullable();
            $table->integer("no_of_nights");
            $table->integer("net_cost");
            $table->integer("guests")->default('1');
            $table->timestamp("check_in_date")->useCurrent();
            $table->dateTime("expected_check_out_date");
            $table->time("expected_check_out_time")->nullable();
            $table->integer("extended_stay")->default('0');
            $table->integer("checked_out")->default('0');
            $table->time("check_out_time")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
