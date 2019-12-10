<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('room_number')->unique();;
            $table->string('room_id')->unique();;
            $table->integer('room_rate');
            $table->string('room_category');
            $table->string('features')->nullable();
            $table->string('current_guest_id')->nullable();
            $table->integer('guests')->nullable();
            $table->string('booked')->default('NO');
            $table->string('booking_ref')->nullable();
            $table->timestamp('booked_on')->nullable();
            $table->timestamp('booking_expires')->nullable();
            $table->string('reserved')->default('NO');
            $table->string('reserved_by')->nullable();
            $table->string('reservation_ref')->nullable();
            $table->integer('reserved_nights')->nullable();
            $table->dateTime('reservation_date')->nullable();
            $table->integer('days_till_reservation_date')->nullable();;
            $table->string('reservation_expiry')->nullable();
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
        Schema::dropIfExists('rooms');
    }
}
