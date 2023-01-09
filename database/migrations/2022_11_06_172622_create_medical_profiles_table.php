<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('name_of_university');
            $table->string('year_of_graduation');
            $table->string('certificate');
            $table->string('year_of_collection');
            $table->string('liensence');





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
        Schema::dropIfExists('medical_profiles');
    }
}
