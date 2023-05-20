<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->string('unit_name')->nullable();
            $table->unsignedBigInteger('facility_id')->index()->nullable();
            $table->foreign('facility_id')->references('id')->on('facilities');

            $table->unsignedBigInteger('department_id')->index()->nullable();
            $table->foreign('department_id')->references('id')->on('departments');

            $table->string('internal_location')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        DB::table('units')->insert(
            array(
                'id' => 1,
                'unit_name' => 'Not Applicable'
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
        Schema::dropIfExists('units');
    }
}
