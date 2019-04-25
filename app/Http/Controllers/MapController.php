<?php

namespace App\Http\Controllers;

use App\Driver;
use App\Address;
use App\Order;
use App\Restaurant;


class MapController extends Controller
{

    /**
     * Undocumented function
     *
     * @return void
     */
    public function show(){

        // dd(\App\User::where('id', 4)->driver());

        // $driverLocationID = Driver::where('user_id', auth()->user()->id)->first()->location_id;
        // $driverLocation = Address::where('id', $driverLocationID)->first();
        // $driverLocation = $driverLocation->google_geocode_address;



        // $orderIDs[] = Order::where([
        //     'driver_id' => Driver::where('user_id', auth()->user()->id)->first()->id,
        //     'is_archived' => false
        //     ])->get();

        // dd($orderIDs);

        // dd(\App\Address::first()->order()->);

        if (auth()->check() && (auth()->user()->hasRole('driver') || (auth()->user()->hasRole('admin')) && request()->is('*driver*'))) {

            $destinations = collect([]);

            $userID = auth()->user()->id;
            // Getting driver location
            $driver = Driver::where('user_id', $userID)->first();
            $driverLocation = Address::where('id', $driver->location_id)->first();
            $destinations->push('push', $driverLocation->google_geocode_address);

            // Getting orders from driver
            $orders = Order::where([
                'driver_id' => $driver->id,
                'is_archived' => false
                ])->take(2)->get();

            // Getting restaurant location
            $restaurantID = $orders->first()->restaurant_id;
            $restaurant = Restaurant::where('id', $restaurantID)->first();
            $restaurantLocation = Address::where('id', $restaurant->user()->first()->address_id)->first();
            // $destinations['restaurant'] = $restaurantLocation->google_geocode_address;
            $destinations->push($restaurantLocation->google_geocode_address);

            $orders->each(function($order, $key) use ( $destinations) {
                // var_dump($order);
                // $destinations['delivery'][] = Address::where('id', $order->address_id)->first();
            });

            dd($destinations);
            // $restaurantLocation = "140+E+San+Carlos+St,CA";
            // $driverLocationID = Driver::where('user_id', auth()->user()->id)->first()->location_id;
            // $clientLocation = "san+jose+state+university";
        }



        // $directions = \GoogleMaps::load('directions')
		// ->setParam ([
        //     'origin' => $driverLocation,
        //     'waypoints' => ['optimize:true',$restaurantLocation],
        //     'destination' => $clientLocation,
        //     'departure_time' => 'now'
        //     ])
        //  ->get();

        // return view('driver.pages.map', ['directions' => json_decode($directions)]);

    }
}
