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

        factory(Address::class, env('DUMMY_ADDRESSES'))->create();
        factory(User::class, env('DUMMY_USERS'))->create();
        factory(Driver::class, env('DUMMY_DRIVERS'))->create();
        factory(Restaurant::class, env('DUMMY_RESTAURANTS'))->create();

    }
}
