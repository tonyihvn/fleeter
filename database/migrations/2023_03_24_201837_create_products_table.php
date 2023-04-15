<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title',50);
            $table->string('model',50);
            $table->double('price',10,2)->nullable();
            $table->unsignedBigInteger('supplier_id')->index()->nullable();
            $table->foreign('supplier_id')->references('id')->on('users');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->text('detail')->nullable();
            $table->string('terms',100)->nullable();
            $table->string('category',70)->nullable();
            $table->string('status',100)->nullable();
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
        Schema::dropIfExists('products');
    }
}
