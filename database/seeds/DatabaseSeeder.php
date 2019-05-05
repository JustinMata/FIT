<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
    * Seed the application's database.
    *
    * @return void
    */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $migrate = (bool)$this->command->ask('Do you want to migrate:fresh the database?', 'yes');

        // Fresh migration
        if ($migrate == 'yes') {
            Artisan::call('migrate:fresh', ['--force' => true]);
        }

        $this->command->info('Migration complete!');


        $entryNumber = (int)$this->command->ask('How many entries do you want to create?', 200);

        // create permissions
        Permission::create(['name' => 'user_create']);
        Permission::create(['name' => 'user_update']);
        Permission::create(['name' => 'user_delete']);
        Permission::create(['name' => 'order_create']);
        Permission::create(['name' => 'order_cancel']);
        Permission::create(['name' => 'order_accept']);
        Permission::create(['name' => 'order_decline']);

        $this->command->info('Permissions generated!');

        // create roles and assign created permissions
        $role = Role::create(['name' => 'admin'])
        ->givePermissionTo(Permission::all());

        // create roles and assign created permissions
        $role = Role::create(['name' => 'restaurant'])
        ->givePermissionTo(['order_create', 'order_cancel']);

        // create roles and assign created permissions
        $role = Role::create(['name' => 'driver'])
        ->givePermissionTo(['order_accept', 'order_decline']);

        $this->command->info('Roles generated!');

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
                $user[0]->assignRole('driver');
            } else {
                DB::table('users')
                ->where('id', $user[0]->id)
                ->update(['type' => 'RESTAURANT']);

                factory(App\Restaurant::class, 1)
                ->create([
                    'user_id' => $user[0]->id,
                    ]
                );
                $user[0]->assignRole('restaurant');
            }
        });

        $this->command->info('Drivers and Restaurants generated!');

        // Generate addresses for deliveries
        $addresses = factory(App\Address::class, $entryNumber)->create();

        // Getting list of restaurants and drivers id's
        $restaurants = App\Restaurant::pluck('id')->shuffle()->all();
        $drivers = App\Driver::pluck('id')->shuffle()->all();


        // @TESTING
        $headers = ['id'];
        // $this->command->table($headers, $drivers);
        // $this->command->info($drivers);

        $addresses->each(function($address) use ($drivers, $restaurants){

            // creating an order for each address
            factory(App\Order::class, 1)
            ->create([
                'base_rate' => config('api.BASE_RATE'),
                'mileage_rate' => config('api.MILEAGE_RATE'),
                'taxes' => config('api.TAXES'),
                'address_id' => $address->id,
                'restaurant_id' => (int)array_pop($restaurants),
                'driver_id' => (int)array_pop($drivers)
                ]
            );
        });

        $this->command->info('Orders generated!');

        $password = Hash::make('password');

        // $address = App\Address::first();

        // Generating Admins
        $user = factory(App\User::class, 1)
        ->create([
            'first_name' => 'Jean',
            'last_name' => 'Marcellin',
            'email' => 'jamarcellin@gmail.com',
            'password' => $password,
            'phone_number' => '6503538639',
            'type' => 'ADMIN',
            'address_id' => $addresses[1]->id
            ]
        );

        $driver = factory(App\Driver::class, 1)
        ->create([
            'user_id' => $user[0]->id,
            'location_id' => $addresses[0]->id,
            'is_available' => true
            ]
        );

        $restaurant = factory(App\Restaurant::class, 1)
        ->create([
            'user_id' => $user[0]->id,
            ]
        );

        factory(App\Order::class, 2)
        ->create([
            'driver_id' => $driver[0]->id,
            'restaurant_id' => $restaurant[0]->id,
            'is_archived' => false
            ]
        );

        factory(App\User::class, 1)
        ->create([
            'first_name' => 'Tien',
            'last_name' => '',
            'email' => 'temp1@gmail.com',
            'password' => $password,
            'phone_number' => '',
            'type' => 'ADMIN'
            ]
        );

        factory(App\User::class, 1)
        ->create([
            'first_name' => 'Justin',
            'last_name' => '',
            'email' => 'temp2@gmail.com',
            'password' => $password,
            'phone_number' => '',
            'type' => 'ADMIN'
            ]
        );

        factory(App\User::class, 1)
        ->create([
            'first_name' => 'Sang',
            'last_name' => '',
            'email' => 'temp3@gmail.com',
            'password' => $password,
            'phone_number' => '',
            'type' => 'ADMIN'
            ]
        );

        factory(App\User::class, 1)
        ->create([
            'first_name' => 'Chico',
            'last_name' => '',
            'email' => 'temp4@gmail.com',
            'password' => $password,
            'phone_number' => '',
            'type' => 'ADMIN'
            ]
        );

        $user = App\User::where('email', '=', 'jamarcellin@gmail.com')->first();

        $user->assignRole('admin');

        $user = App\User::where('email', '=', 'temp1@gmail.com')->first();

        $user->assignRole('admin');

        $user = App\User::where('email', '=', 'temp2@gmail.com')->first();

        $user->assignRole('admin');

        $user = App\User::where('email', '=', 'temp3@gmail.com')->first();

        $user->assignRole('admin');

        $user = App\User::where('email', '=', 'temp4@gmail.com')->first();

        $user->assignRole('admin');

    }
}
