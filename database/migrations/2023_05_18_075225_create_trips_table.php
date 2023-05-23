<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->id();

            $table->string('from',100)->nullable();
            $table->string('to',100)->nullable();

            $table->string('from_geocord',100)->nullable();
            $table->string('to_geocord',100)->nullable();

            $table->timestamp('departure_timedate')->nullable();
            $table->timestamp('arrival_timedate')->nullable();

            $table->unsignedBigInteger('request_id')->index()->nullable();
            $table->foreign('request_id')->references('id')->on('requests');

            $table->unsignedBigInteger('vehicle_id')->index()->nullable();
            $table->foreign('vehicle_id')->references('id')->on('vehicles');

            $table->unsignedBigInteger('driver_id')->index()->nullable();
            $table->foreign('driver_id')->references('id')->on('users');

            $table->string('type',100)->nullable();

            $table->string('remarks',100)->nullable();
            $table->string('status',50)->nullable();

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
        Schema::dropIfExists('trips');
    }
}
