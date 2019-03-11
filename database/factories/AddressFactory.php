<?php

use App\Address;
use Illuminate\Support\Str;
use Faker\Generator as Faker;


$factory->define(Address::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'number' => $faker->buildingNumber,
        'street1' => $faker->streetAddress,
        'street2' => '',
        'city' => $faker->city,
        'postal' => $faker->postcode,
        'state' => $faker->stateAbbr,
        'latitude' => $faker->latitude(37.276572, 37.4),
        'longitude' => $faker->longitude(-122.035278, -121.748864)
    ];
});