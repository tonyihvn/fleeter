<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('reg_no',30)->nullable();
            $table->string('chasis_no',50)->nullable();
            $table->string('model',50)->nullable();
            $table->string('brand',50)->nullable();
            $table->date('purchase_date')->nullable();
            $table->string('odometer',10)->nullable();
            $table->string('fuel_level',30)->nullable();
            $table->string('color',30)->nullable();
            $table->string('picture',30)->nullable();
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
        Schema::dropIfExists('vehicles');
    }
}
