<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routes', function (Blueprint $table) {
            $table->id();
            $table->string('type',100)->nullable();
            $table->string('destination',100)->nullable();

            $table->string('geocord',100)->nullable();

            $table->timestamp('timedate')->nullable();

            $table->unsignedBigInteger('trip_id')->index()->nullable();
            $table->foreign('trip_id')->references('id')->on('trips');
            $table->string('status',30)->nullable();
            $table->string('odometer',30)->nullable();
            $table->unsignedBigInteger('vehicle_id')->index()->nullable();
            $table->foreign('vehicle_id')->references('id')->on('vehicles');

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
        Schema::dropIfExists('routes');
    }
}
