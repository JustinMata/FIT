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
            if ($orders->count() > 0) {

                $restaurantID = $orders->first()->restaurant_id;
                $restaurant = Restaurant::where('id', $restaurantID)->first();
                $restaurantLocation = Address::where('id', $restaurant->user()->first()->address_id)->first();

                data_fill($destinations, 'restaurant', $restaurantLocation->google_geocode_address);

                // Setting the delivery addresses
                $orders->each(function($order, $key) use ( &$destinations) {
                    data_fill($destinations, "delivery.$key", Address::where('id', $order->address_id)->first()->google_geocode_address);
                });

                // dd(count($destinations['delivery']));
                if (count($destinations['delivery']) == 1) {
                    $directions[] =  $this->getDirections($destinations['driver'], $destinations['restaurant'], $destinations['delivery'][0]);
                } else {
                    $directions[] =  $this->getDirections($destinations['driver'], $destinations['restaurant'], $destinations['delivery'][0], $destinations['delivery'][1]);
                    $directions[] =  $this->getDirections($destinations['driver'], $destinations['restaurant'], $destinations['delivery'][1], $destinations['delivery'][0]);
                }

                // dd($destinations);
                // calculating the durations
                if (count($directions) == 1 ) {
                    $durations[] = $this->totalDuration($directions[0]);

                    return view('driver.pages.map', [
                        'directions' => $directions[0],
                        'orders' => $orders,
                        'duration' => $durations[0]
                    ]);
                }

                // calculating the durations
                $durations = [$this->totalDuration($directions[0]), $this->totalDuration($directions[1])];

                if ($durations[0] <= $durations[1]) {
                    return view('driver.pages.map', [
                        'directions' => $directions[0],
                        'orders' => $orders,
                        'duration' => $durations[0]
                    ]);
                }

                return view('driver.pages.map', [
                    'directions' => $directions[1],
                    'orders' => $orders,
                    'duration' => $durations[1]
                ]);
            }
        }

        return view('driver.pages.map', [
            'directions' => null,
            'orders' => $orders,
            'duration' => []
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
        $durations = [];

        if($direction->status == 'OK'){
            $durations = data_get($direction, 'routes.*.legs.*.duration.value');
        }

        return array_sum($durations);
    }
}
