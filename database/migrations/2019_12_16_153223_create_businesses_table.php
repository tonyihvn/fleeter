<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('businesses', function (Blueprint $table) {
            $table->id();
            $table->string('business_name',70)->nullable();
            $table->string('motto',70)->nullable();
            $table->string('logo',70)->nullable();
            $table->string('address',100)->nullable();
            $table->string('background',70)->nullable();
            $table->string('mode',30)->nullable();
            $table->string('color',30)->nullable();
            $table->unsignedBigInteger('businessgroup_id')->index()->nullable();
            $table->foreign('businessgroup_id')->references('id')->on('businessgroups')->nullable();
            $table->unsignedBigInteger('user_id')->index()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->nullable();
            $table->timestamps();
        });

        DB::table('businesses')->insert(
            array(
                'business_name' => 'AccessMade',
                'businessgroup_id'=>1
            ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('businesses');
    }
}
