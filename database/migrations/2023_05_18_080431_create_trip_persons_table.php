<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripPersonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trip_persons', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('request_id')->index()->nullable();
            $table->foreign('request_id')->references('id')->on('requests');

            $table->unsignedBigInteger('person_id')->index()->nullable();
            $table->foreign('person_id')->references('id')->on('users');

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
        Schema::dropIfExists('trip_persons');
    }
}
