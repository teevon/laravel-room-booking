<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("guest_id")->unique();;
            $table->string("guest_name");
            $table->string("guest_type_gender");
            $table->string("phone_number")->nullable();
            $table->string("contact_address")->nullable();
            $table->integer("total_rooms_booked")->default('1');
            //$table->dateTime("last_checkin");
            $table->timestamp("check_in_date")->useCurrent();
            $table->integer("room_outstanding");
            $table->integer("restaurant_outstanding")->default('0');
            $table->string("checked_out")->default('NO');
            $table->string("checked_in")->default('YES');
            $table->integer("visit_count")->default('1');
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
        Schema::dropIfExists('guests');
    }
}
