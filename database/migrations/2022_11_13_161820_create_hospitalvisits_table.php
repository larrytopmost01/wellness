<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHospitalvisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hospitalvisits', function (Blueprint $table) {
            $table->id();
            $table->string('patient_id');
            $table->string('hospital');
            $table->string('doctor_name');
            $table->date('appoint_date');
            $table->string('appoint_time');
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
        Schema::dropIfExists('hospitalvisits');
    }
}
