<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('location_id')->unsigned();
            $table->json('schedule');
            $table->string('account_number');
            $table->string('account_routing');
            $table->boolean('is_available')->comment('false not available, true available');
            $table->bigInteger('order_id')->unsigned()->nullable();
            $table->json('car');
            $table->string('license_plate');
            $table->string('license_number');
            $table->date('license_expiration');
            $table->string('insurance_number');
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
        Schema::dropIfExists('drivers');
    }
}
