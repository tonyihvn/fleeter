<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountheadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accountheads', function (Blueprint $table) {
            $table->id();
            $table->string('title',50)->nullable();
            $table->string('category',50)->nullable();
            $table->string('type',50)->nullable();
            $table->string('description',50)->nullable();
            $table->timestamps();
        });

        // DB::table('accountheads')->insert(
        //     array(
        //         'title' => 'Client Payment',
        //         'category' => 'Inflow',
        //         'type'=> 'Payment Recieved',
        //         'description'=>'All payments made by owner of the project',
        //         'business_id'=>1

        //     ));
        // DB::table('accountheads')->insert(
            // array(
            //     'title' => 'Material Supply',
            //     'category' => 'Expenditure',
            //     'type'=> 'Building Material',
            //     'description'=>'For payment of material supplies',
            //     'business_id'=>1

            // ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accountheads');
    }
}
