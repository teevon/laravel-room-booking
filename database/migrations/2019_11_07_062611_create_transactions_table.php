<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("transaction_type");
            $table->string("booking_ref");
            $table->string("guest_id");
            $table->integer("total_rooms_booked");
            $table->integer("total_cost");
            $table->integer("deposited");
            $table->integer("balance");
            $table->string("means_of_payment");
            $table->string("payment_status");
            $table->string("frontdesk_rep");
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
        Schema::dropIfExists('transactions');
    }
}
