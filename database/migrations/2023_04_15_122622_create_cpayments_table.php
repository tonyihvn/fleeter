<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCpaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cpayments', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('client_id')->index();
            $table->foreign('client_id')->references('id')->on('users')->onDelete('cascade');

            $table->double('amount',10,2)->default(0)->nullable();
            $table->date('payment_date')->nullable();
            $table->string('saving_plan',50)->nullable();
            $table->string('account_head',50)->nullable();
            $table->string('credit_officer',50)->nullable();

            $table->string('status',50)->nullable();

            $table->unsignedBigInteger('business_id')->index()->nullable();
            $table->foreign('business_id')->references('id')->on('businesses');


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
        Schema::dropIfExists('cpayments');
    }
}
