<?php

use App\Address;
use App\User;
use App\Driver;
use App\Restaurant;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        Artisan::call('migrate:fresh', [
            '--force' => true,
        ]);

        factory(Address::class, 200)->create();
        factory(User::class, 100)->create();
        factory(Driver::class, 25)->create();
        factory(Restaurant::class, 25)->create();

    }
}
