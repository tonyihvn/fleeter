<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trip_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('trip_id')->index()->nullable();
            $table->foreign('trip_id')->references('id')->on('trips');

            $table->unsignedBigInteger('submited_by')->index()->nullable();
            $table->foreign('submited_by')->references('id')->on('users');

            $table->text('details')->nullable();
            $table->timestamp('timedate')->nullable();
            $table->string('status',30)->nullable();
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
        Schema::dropIfExists('trip_reports');
    }
}
