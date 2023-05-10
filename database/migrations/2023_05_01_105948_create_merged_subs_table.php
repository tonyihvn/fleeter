<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMergedSubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merged_subs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id')->index();
            $table->foreign('client_id')->references('id')->on('users')->onDelete('cascade');

            $table->string('mproduct_name',100)->nullable();


            $table->double('amount_paid',10,2)->default(0)->nullable();
            $table->date('payment_date')->nullable();

            $table->unsignedBigInteger('subscription_id')->index()->nullable();
            $table->foreign('subscription_id')->references('id')->on('subscriptions');

            $table->unsignedBigInteger('business_id')->index()->nullable();
            $table->foreign('business_id')->references('id')->on('businesses');

            $table->string('status',100)->nullable();


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
        Schema::dropIfExists('merged_subs');
    }
}
