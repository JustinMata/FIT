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


        if (auth()->check() && (auth()->user()->hasRole('driver') || (auth()->user()->hasRole('admin')) && request()->is('*driver*'))) {

            $destinations = [];

            $userID = auth()->user()->id;
            // Getting driver location
            $driver = Driver::where('user_id', $userID)->first();
            $driverLocation = Address::where('id', $driver->location_id)->first();
            data_fill($destinations, 'driver', $driverLocation->google_geocode_address);

            // Getting orders from driver
            $orders = Order::where(['driver_id' => $driver->id,'is_archived' => false])->limit(2)->get();

            // Getting restaurant location
            $restaurantID = $orders->first()->restaurant_id;
            $restaurant = Restaurant::where('id', $restaurantID)->first();
            $restaurantLocation = Address::where('id', $restaurant->user()->first()->address_id)->first();
            // $destinations['restaurant'] = $restaurantLocation->google_geocode_address;
            data_fill($destinations, 'restaurant', $restaurantLocation->google_geocode_address);

            // Setting the delivery addresses
            $orders->each(function($order, $key) use ( &$destinations) {
                data_fill($destinations, "delivery.$key", Address::where('id', $order->address_id)->first()->google_geocode_address);
            });

            if (count($destinations['delivery']) == 1) {
                $directions[] =  $this->getDirections($destinations['driver'], $destinations['restaurant'], $destinations['delivery'][0]);
            } else {
                $directions[] =  $this->getDirections($destinations['driver'], $destinations['restaurant'], $destinations['delivery'][0], $destinations['delivery'][1]);
                $directions[] =  $this->getDirections($destinations['driver'], $destinations['restaurant'], $destinations['delivery'][1], $destinations['delivery'][0]);
            }

            if (count($directions) == 1 ) {
                return view('driver.pages.map', [
                    'directions' => $directions[0],
                    'orders' => $orders
                    ]);
            }

            if ($this->totalDuration($directions[0]) <= $this->totalDuration($directions[1])) {
                return view('driver.pages.map', [
                    'directions' => $directions[0],
                    'orders' => $orders
                    ]);
            }

            return view('driver.pages.map', [
                'directions' => $directions[1],
                'orders' => $orders
                ]);
        }

        return view('driver.pages.map', [
            'directions' => null,
            'orders' => $orders
            ])->withErrors(['warning' => 'There was an error retrieving your location']);
    }

    private function getDirections($driver, $restaurant, $firstDestination, $secondDestination = null){
        $directions =  \GoogleMaps::load('directions')->setParam([
            'origin' => $driver,
            'waypoints' => [$restaurant, $secondDestination],
            'destination' => $firstDestination,
            'departure_time' => 'now'
        ])->get();

        return json_decode($directions);
    }


    private function totalDuration($direction){
        $duration = 0;

        if($direction->status == 'OK'){
            foreach (data_get($direction, 'routes.*.legs') as $value) {
                $duration += data_get($value, 'duration.value');
            }
        }

        return $duration;
    }
}
