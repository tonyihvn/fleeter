<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('org_name',70)->nullable();
            $table->string('motto',70)->nullable();
            $table->string('logo',70)->nullable();
            $table->string('address',100)->nullable();
            $table->string('background',70)->nullable();
            $table->string('mode',30)->nullable();
            $table->string('color',30)->nullable();
            $table->timestamps();
        });

        DB::table('settings')->insert(
            array(
                'org_name' => 'IHVN - Transportation ERP',
                'motto' => 'Fleet Management System',
                'logo' => 'logo-dark.png',
                'background' => 'login-bg.jpg',
                'mode' => 'Active',
                'address' => 'IHVN Transport Office Address',
                'color' => '',
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
        Schema::dropIfExists('settings');
    }
}
