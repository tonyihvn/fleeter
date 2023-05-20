<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('staff_id',12)->nullable();
            $table->string('designation',50)->nullable();
            $table->string('phone_number',22)->nullable();

            $table->unsignedBigInteger('facility_id')->index()->nullable();
            $table->foreign('facility_id')->references('id')->on('facilities');

            $table->unsignedBigInteger('department_id')->index()->nullable();
            $table->foreign('department_id')->references('id')->on('departments');

            $table->unsignedBigInteger('unit_id')->index()->nullable();
            $table->foreign('unit_id')->references('id')->on('units');

            $table->unsignedBigInteger('supervisor')->index()->nullable();
            $table->foreign('supervisor')->references('id')->on('users');

            $table->string('role')->nullable();
            $table->string('status')->nullable();

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
