<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessgroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('businessgroups', function (Blueprint $table) {
            $table->id();
            $table->string('businessgroup_name',70)->nullable();
            $table->string('motto',70)->nullable();
            $table->string('logo',70)->nullable();
            $table->string('address',100)->nullable();
            $table->string('background',70)->nullable();
            $table->string('mode',30)->nullable();
            $table->string('color',30)->nullable();
            $table->unsignedBigInteger('user_id')->index()->nullable();
            $table->foreign('user_id')->references('id')->on('users');

            $table->timestamps();
        });

        DB::table('businessgroups')->insert(
                array(
                    'businessgroup_name' => 'AccessMade'
                ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('businessgroups');
    }
}
