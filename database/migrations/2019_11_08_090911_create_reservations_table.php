<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("ref");
            $table->string("guest_name");
            $table->string("guest_id")->nullable();
            $table->string("phone")->nullable();
            $table->string("email")->nullable();
            $table->dateTime("reserved_date");
            $table->timestamp("inquiry_date")->nullable();
            $table->string("room_id");
            $table->integer("no_of_nights");
            $table->integer("cost");
            $table->integer("deposit");
            $table->integer("booked")->default('0');
            $table->integer("cancelled")->default('0');
            $table->integer("user_id");
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
        Schema::dropIfExists('reservations');
    }
}
