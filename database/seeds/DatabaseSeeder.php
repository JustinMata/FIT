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
        $migrate = (bool)$this->command->ask('Do you want to migrate:fresh the database?', 'yes');

        // Fresh migration
        if ($migrate == 'yes') {
            Artisan::call('migrate:fresh', ['--force' => true]);
        }

        $this->command->info('Migration complete!');


        $entryNumber = (int)$this->command->ask('How many entries do you want to create?', env('GENERATED_USERS_NUMBER'));

        // Generating addresses
        $addresses = factory(App\Address::class, $entryNumber)->create();

        $this->command->info('Addresses generated!');


        // Generate users, drivers and restaurants
        $addresses->each(function($address) {
            // creating a user for each address
            $user = factory(App\User::class, 1)
            ->create(['address_id' => $address->id]);

            // creating equal number of drivers and restaurants
            if ($user[0]->id % 2 == 0) {
                DB::table('users')
                ->where('id', $user[0]->id)
                ->update(['type' => 'DRIVER']);

                factory(App\Driver::class, 1)
                ->create([
                    'user_id' => $user[0]->id,
                    'location_id' => $address->id
                    ]
                );
            } else {
                DB::table('users')
                ->where('id', $user[0]->id)
                ->update(['type' => 'RESTAURANT']);

                factory(App\Restaurant::class, 1)
                ->create([
                    'user_id' => $user[0]->id,
                    ]
                );
            }
        });

        $this->command->info('Drivers and Restaurants generated!');

        // Generate addresses for deliveries
        $addresses = factory(App\Address::class, $entryNumber)->create();

        // Getting list of restaurants and drivers id's
        $restaurants = App\User::select('id')->where('type', '=', 'RESTAURANT')->get()->shuffle();
        $drivers = App\User::select('id')->where('type', '=', 'DRIVER')->get()->shuffle();


        // @TESTING
        // $headers = ['id'];
        // $this->command->table($headers, $drivers->pluck('id')->all());
        // $this->command->info($restaurants->pop()->id);

        $addresses->each(function($address) use ($drivers, $restaurants){

            // creating an order for each address
            factory(App\Order::class, 1)
            ->create([
                'base_rate' => env('BASE_RATE'),
                'mileage_rate' => env('MILEAGE_RATE'),
                'taxes' => env('TAXES'),
                'address_id' => $address->id,
                // 'restaurant_id' => (int)$restaurants->pop()->id,
                // 'driver_id' => (int)$drivers->pop()->id,
                ]
            );
        });

        $this->command->info('Orders generated!');

        $password = Hash::make('password');

        // Generating Admins
        factory(App\User::class, 1)
        ->create([
            'first_name' => 'Jean',
            'last_name' => 'Marcellin',
            'email' => 'jamarcellin@gmail.com',
            'password' => $password,
            'phone_number' => '6503538639',
            'type' => 'ADMIN'
        ]);

        factory(App\User::class, 1)
        ->create([
            'first_name' => 'Tien',
            'last_name' => '',
            'email' => 'temp1@gmail.com',
            'password' => $password,
            'phone_number' => '',
            'type' => 'ADMIN'
        ]);

        factory(App\User::class, 1)
        ->create([
            'first_name' => 'Justin',
            'last_name' => '',
            'email' => 'temp2@gmail.com',
            'password' => $password,
            'phone_number' => '',
            'type' => 'ADMIN'
        ]);

        factory(App\User::class, 1)
        ->create([
            'first_name' => 'Sang',
            'last_name' => '',
            'email' => 'temp3@gmail.com',
            'password' => $password,
            'phone_number' => '',
            'type' => 'ADMIN'
        ]);

        factory(App\User::class, 1)
        ->create([
            'first_name' => 'Chico',
            'last_name' => '',
            'email' => 'temp4@gmail.com',
            'password' => $password,
            'phone_number' => '',
            'type' => 'ADMIN'
        ]);
    }
}
