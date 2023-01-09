<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddServicenameToDoctorpaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('doctorpayments', function (Blueprint $table) {
            //
            $table->string('servicename')->after('transactionid');
            $table->string('narration')->after('transactionid');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('doctorpayments', function (Blueprint $table) {
            //
        });
    }
}
