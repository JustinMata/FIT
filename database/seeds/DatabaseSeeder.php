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
            
            // $this->command->info($user[0]->id);
            
            // creating equal number of drivers and restaurants
            if ($user[0]->id % 2 == 0) {
                factory(App\Driver::class, 1)
                ->create([
                    'user_id' => $user[0]->id,
                    'location_id' => $address->id
                    ]
                );
            } else {
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
        
        // Ask range for film per user needed
        // $r = 0 . '-' . 10;
        // $filmRange = $this->command->ask('How many films per user do you need ?', $r);
        
        // $this->command->info("Creating {$userCount} users each having a film range of {$filmRange}.");
        
        // // Create the Users 
        // $users = factory(App\User::class, $userCount)->create();
        
        // // Create a range of films for each users
        // $users->each(function($user) use ($filmRange){
            //     factory(App\Film::class, $this->count($filmRange))
            //     ->create(['user_id' => $user->id]);
            // });
            
            // $this->command->info('Users and Films Created!');
            
            // factory(App\Address::class, 400)->create();
            
            // $addresses = App\Address::all()->pluck('id')->toArray();
            // // factory(App\User::class, 50)->create();
            
            // factory(App\User::class, 200)->create()->each(
                //     function($user) use ($addresses) {
                    //         $user->address_id = Arr::pull(Arr::random($addresses));
                    //     }
                    // );
                    // factory(App\Driver::class, 50)->create();
                    // factory(App\Restaurant::class, 50)->create();
                    // factory(App\Order::class, 15)->create();
                    // factory(App\OrderArchive::class, 100)->create();
                    
                    // factory(App\Order::class, 15)->create()->each(
                        //     function($order) {
                            //         $order->restaurant()->save(
                                //             factory(App\Restaurant::class)->create()->each(
                                    //                 function($restaurant) {
                                        //                     $restaurant->user()->create()->each(
                                            //                         function($address) {
                                                
                                                //                         }
                                                //                     );
                                                //                 }
                                                //             ));
                                                //         $order->driver()->save(factory('App\Driver')->make());
                                                //     });
                                                
                                                // factory(App\Order::class, 15)->create()->each(
                                                    //     function($order) {
                                                        //         factory(App\Restaurant::class)->create()->each(
                                                            
                                                            //         )
                                                            //     }
                                                            // );
                                                            
                                                        }
                                                    }
                                                    