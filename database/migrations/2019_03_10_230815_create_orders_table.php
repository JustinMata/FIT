<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('base_rate', 8, 2);
            $table->decimal('mileage_rate', 8, 2);
            $table->decimal('delivery_price', 8, 2)->comment('Food price');
            $table->decimal('taxes', 8, 2);
            $table->decimal('mileage_trip', 8, 2);
            $table->string('delivery_name', 50);
            $table->string('delivery_comments', 200);
            $table->boolean('is_delivered')->comment('false = not delivered, true = delivered');
            $table->bigInteger('restaurant_id')->unsigned();
            $table->bigInteger('driver_id')->unsigned()->nullable();
            $table->bigInteger('address_id')->unsigned()->comment('delivery address');
            $table->boolean('is_archived', false);
            $table->boolean('is_payed', false);
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
        Schema::dropIfExists('orders');
    }
}
