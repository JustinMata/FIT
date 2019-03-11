<?php

use Faker\Generator as Faker;

$factory->define(App\Driver::class, function (Faker $faker) {
    return [
        'location_id' => $faker->numberBetween(1, App\Address::count()),
        'schedule' => '{}',
        'account_number' => $faker->bankAccountNumber,
        'account_routing' => $faker->bankRoutingNumber,
        'is_available' => $faker->boolean,
        'car' => '{}',
        'license_plate' => $faker->bothify('#########'),
        'license_number' => $faker->numerify('#########'),
        'license_expiration' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'insurance_number' => $faker->bothify('########'),
    ];
});

