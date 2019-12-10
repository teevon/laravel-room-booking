<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("frontdesk_txn");
            $table->integer("payment_index")->default('1');
            $table->dateTime("txn_date")->useCurrent();
            $table->integer("amount_paid");
            $table->dateTime("date_of_payment")->useCurrent();
            $table->integer("amount_balance");
            $table->integer("net_paid");
            $table->integer("txn_worth");
            $table->string("guest_id");
            $table->string("means_of_payment");
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
        Schema::dropIfExists('payments');
    }
}
