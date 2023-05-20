<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->id();

            $table->string('from',100)->nullable();
            $table->string('to',100)->nullable();

            $table->string('from_geocord',100)->nullable();
            $table->string('to_geocord',100)->nullable();

            $table->timestamp('expdeparture_timedate')->nullable();
            $table->timestamp('exparrival_timedate')->nullable();

            $table->unsignedBigInteger('requested_by')->index()->nullable();
            $table->foreign('requested_by')->references('id')->on('users');

            $table->unsignedBigInteger('approved_by')->index()->nullable();
            $table->foreign('approved_by')->references('id')->on('users');

            $table->string('purpose',150)->nullable();
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
        Schema::dropIfExists('requests');
    }
}
