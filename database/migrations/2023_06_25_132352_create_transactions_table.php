<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('title',50);
            $table->integer('amount');
            $table->string('account_head',50);
            $table->date('date')->nullable();
            $table->string('reference_no',70)->nullable();
            $table->string('upload')->nullable();
            $table->string('detail')->nullable();
            $table->unsignedBigInteger('from')->index()->nullable();
            $table->foreign('from')->references('id')->on('users');
            $table->unsignedBigInteger('to')->index()->nullable();
            $table->foreign('to')->references('id')->on('users');
            $table->string('approved_by',50)->nullable();
            $table->string('recorded_by',50)->nullable();
            $table->unsignedBigInteger('trip_id')->index()->nullable();
            $table->foreign('trip_id')->references('id')->on('trips');
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
        Schema::dropIfExists('transactions');
    }
}
