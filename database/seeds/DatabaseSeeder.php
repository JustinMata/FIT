<?php

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

        // Fresh migration
        Artisan::call('migrate:fresh', [
            '--force' => true,
        ]);

        factory(App\Address::class, env('DUMMY_ADDRESSES'))->create();
        factory(App\User::class, env('DUMMY_USERS'))->create();
        factory(App\Driver::class, env('DUMMY_DRIVERS'))->create();
        factory(App\Restaurant::class, env('DUMMY_RESTAURANTS'))->create();
        factory(App\Order::class, env('DUMMY_ACTIVE_ORDERS'))->create();
        factory(App\OrderArchive::class, env('DUMMY_ARCHIVED_ORDERS'))->create();

    }
}
