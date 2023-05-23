<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facilities', function (Blueprint $table) {
            $table->id();
            $table->string('facility_name')->nullable();
            $table->string('facility_no')->nullable();
            $table->string('state')->nullable();
            $table->string('lga')->nullable();
            $table->string('town')->nullable();
            $table->string('address')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('geocordinates')->nullable();
            $table->timestamps();
        });


        DB::table('facilities')->insert(
            array(
                'id' => 1,
                'facility_name' => 'Not Applicable'
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('facilities');
    }
}
