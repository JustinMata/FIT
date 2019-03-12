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

        // factory(App\Address::class, 400)->create();

        // $addresses = App\Address::all()->pluck('id')->toArray();
        // // factory(App\User::class, 50)->create();

        // factory(App\User::class, 200)->state($addresses)->create()->each(
        //     function($user) use ($addresses) {
        //         $user->address_id = Arr::pull(Arr::random($addresses));
        //     }
        // );
        // // factory(App\Driver::class, 50)->create();
        // // factory(App\Restaurant::class, 50)->create();
        // // factory(App\Order::class, 15)->create();
        // // factory(App\OrderArchive::class, 100)->create();

        // // factory(App\Order::class, 15)->create()->each(
        // //     function($order) {
        // //         $order->restaurant()->save(
        // //             factory(App\Restaurant::class)->create()->each(
        // //                 function($restaurant) {
        // //                     $restaurant->user()->create()->each(
        // //                         function($address) {

        // //                         }
        // //                     );
        // //                 }
        // //             ));
        // //         $order->driver()->save(factory('App\Driver')->make());
        // //     });

        // // factory(App\Order::class, 15)->create()->each(
        // //     function($order) {
        // //         factory(App\Restaurant::class)->create()->each(

        // //         )
        // //     }
        // // );

    }
}
