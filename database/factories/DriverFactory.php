<?php

use App\Driver;
use App\Address;
use Illuminate\Support\Str;
use Faker\Generator as Faker;


$factory->define(Driver::class, function (Faker $faker) {
    return [
        'location_id' => $faker->unique()->numberBetween(1, Address::count()),
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


$factory->define(App\Profile::class, function (Faker\Generator $faker) {
    return [
        'user_id' => $faker->unique()->numberBetween(1, App\User::count()),
        // Rest of attributes...
    ];
});
