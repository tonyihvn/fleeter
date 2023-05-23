<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMtripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mtrips', function (Blueprint $table) {
            $table->id();

            $table->string('destination',100)->nullable();
            $table->string('geocord',100)->nullable();
            $table->unsignedBigInteger('request_id')->index()->nullable();
            $table->foreign('request_id')->references('id')->on('requests');

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
        Schema::dropIfExists('mtrips');
    }
}
