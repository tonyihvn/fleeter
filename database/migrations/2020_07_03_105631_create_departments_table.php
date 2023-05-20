<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('department_name')->nullable();
            $table->unsignedBigInteger('facility_id')->index()->nullable();
            $table->foreign('facility_id')->references('id')->on('facilities');

            $table->string('internal_location')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });


        DB::table('departments')->insert(
            array(
                'id' => 1,
                'department_name' => 'Not Applicable'
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
        Schema::dropIfExists('departments');
    }
}
