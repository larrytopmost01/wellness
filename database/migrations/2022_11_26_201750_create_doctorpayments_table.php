<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorpaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctorpayments', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('transactionid');
            $table->string('amount');
            $table->string('transaction_type');
            $table->string('recepient');
            $table->string('sender');
            $table->string('date');
            $table->string('transaction_status');
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
        Schema::dropIfExists('doctorpayments');
    }
}
