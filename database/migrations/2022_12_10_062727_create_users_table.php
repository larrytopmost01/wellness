<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email');
            $table->string('phone');
            $table->string('password');
            $table->string('spec_id');
            $table->string('university')->nullable();
            $table->string('yearofgraduation')->nullable();
            $table->string('certificate')->nullable();
            $table->string('yearofcollection')->nullable();
            $table->string('liencence')->nullable();
            $table->string('commonhealthissue_id')->nullable();
            $table->string('status')->nullable();
            $table->string('appoint_status')->nullable();
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
        Schema::dropIfExists('users');
    }
}
