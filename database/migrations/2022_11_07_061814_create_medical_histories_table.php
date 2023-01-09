<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_histories', function (Blueprint $table) {
            $table->id();
            $table->string('patient_id');
            $table->string('blood_type');
            $table->string('asmathic');
            $table->string('diabetic_history');
            $table->string('major_illness');
            $table->string('allergic_to_any_drug');
            $table->string('list_of_current_medic');
            $table->string('care_giver_name')->nullable();
            $table->string('care_giver_phone')->nullable();
            $table->string('health_status');
            $table->string('comment');







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
        Schema::dropIfExists('medical_histories');
    }
}
