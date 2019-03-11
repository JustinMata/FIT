<?php

use Faker\Generator as Faker;

$factory->define(App\Restaurant::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1, App\User::count()),
        'provider' => $faker->randomElement(['VISA', 'AMEX', 'DISCOVERY']),
        'CC_name' => $faker->name,
        'CC_number' => $faker->creditCardNumber,
        'CC_expiration' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'CC_CVC' => $faker->numerify('###'),
    ];
});
