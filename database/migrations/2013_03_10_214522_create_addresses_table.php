<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100);
            $table->string('number', 15);
            $table->string('street1', 50);
            $table->string('street2', 50);
            $table->string('city', 100);
            $table->string('state', 2);
            $table->string('postal', 5);
            $table->decimal('longitude', 10, 8);
            $table->decimal('latitude', 11, 8);
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
        Schema::dropIfExists('addresses');

        // /**
        // * Adding foreign key constraints to users table
        // */
        // if (Schema::hasTable('users')) {
        //     Schema::table('users', function (Blueprint $table) {
        //         $table->dropForeign(['address_id', 'restaurant_id', 'driver_id']);
                
        //     });
        // }
        
        
        // /**
        // * Adding foreign key constraints to restaurants table
        // */
        // if (Schema::hasTable('restaurants')) {
        //     Schema::table('restaurants', function (Blueprint $table) {
        //         $table->dropForeign(['user_id']);
        //     });
        // }
        
        // /**
        // * Adding foreign key constraints to drivers table
        // */
        // if (Schema::hasTable('drivers')) {
        //     Schema::table('drivers', function (Blueprint $table) {
        //         $table->dropForeign(['location_id', 'order_id']);
        //     });
        // }
        
        // /**
        // * Adding foreign key constraints to orders table
        // */
        // if (Schema::hasTable('orders')) {
        //     Schema::table('orders', function (Blueprint $table) {
        //         $table->dropForeign(['address_id', 'restaurant_id', 'driver_id']);
        //     });
        // }
        
        // /**
        // * Adding foreign key constraints to orders archive table
        // */
        // if (Schema::hasTable('orders_archive')) {
        //     Schema::table('orders_archive', function (Blueprint $table) {
        //         $table->dropForeign(['address_id', 'restaurant_id', 'driver_id']);

        //     });
        // }
    }
}
