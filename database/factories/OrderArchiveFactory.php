<?php

use Faker\Generator as Faker;

$factory->define(App\OrderArchive::class, function (Faker $faker) {
    return [
        'base_rate' => 6.00,
        'mileage_rate' => 0.58,
        'delivery_price' => $faker->randomFloat(2, 4.50, 60.0),
        'taxes' => 10.25,
        'mileage_trip' => $faker->randomFloat(2, 0.2, 10),
        'delivery_name' => $faker->name,
        'delivery_comments' => $faker->sentence(10),
        'is_delivered' => $faker->boolean,
        'restaurant_id' => $faker->numberBetween(1, App\Restaurant::count()),
        'driver_id' => $faker->numberBetween(1, App\Driver::count()),
        'address_id' => $faker->numberBetween(1, App\Address::count()),
        'is_archived' => true,
        'is_payed' => $faker->boolean,
    ];
});