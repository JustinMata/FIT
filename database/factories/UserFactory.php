<?php

use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'username' => $faker->username,
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'phone_number' => $faker->numerify('##########'),
        'type' => $faker->randomElement(['DRIVER', 'RESTAURANT']),
        'address_id' => $faker->unique()->numberBetween(1, App\Address::count()),
        'remember_token' => Str::random(10),
    ];
});

$factory->state(\App\User::class, 'admin', function (Faker $faker) {
    return [
    'type' => '',
    ];
  });

  $factory->state(\App\User::class, 'driver', function (Faker $faker) {
    return [
    'type' => 'DRIVER',
    ];
  });

  $factory->state(\App\User::class, 'restaurant', function (Faker $faker) {
    return [
    'type' => 'RESTAURANT',
    ];
  });
