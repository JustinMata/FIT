<?php

namespace App\Http\Controllers;

use App\Driver;
use App\Address;
use App\Order;
use App\Restaurant;
use Illuminate\Http\Request;


class MapController extends Controller
{

    /**
     * Undocumented function
     *
     * @return void
     */
    public function show()
    {

        if (request()->is('*driver*')) {
            if (auth()->check() && (auth()->user()->hasAnyRole(['driver', 'admin']))) {

                $destinations = [];

                $userID = auth()->user()->id;

                // Getting driver location
                $driver = Driver::where('user_id', $userID)->first();
                $driverLocation = Address::where('id', $driver->location_id)->first();
                data_fill($destinations, 'driver', $driverLocation->google_geocode_address);

                // Getting orders from driver
                $orders = Order::where(['driver_id' => $driver->id, 'is_archived' => false])->limit(2)->get();

                // Getting restaurant location
                if ($orders->count() > 0) {

                    $restaurantID = $orders->first()->restaurant_id;
                    $restaurant = Restaurant::where('id', $restaurantID)->first();
                    $restaurantLocation = Address::where('id', $restaurant->user()->first()->address_id)->first();

                    data_fill($destinations, 'restaurant', $restaurantLocation->google_geocode_address);

                    // Setting the delivery addresses
                    $orders->each(function ($order, $key) use (&$destinations) {
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
                    if (count($directions) == 1) {
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

        if (request()->is('*restaurant*')) {
            if (auth()->check() && (auth()->user()->hasAnyRole(['restaurant', 'admin']))) {

                $destinations = [];

                $user = auth()->user();
                $restaurant = $user->restaurant()->first();
                $restaurantAddress = $user->address()->first();

                //dd($restaurantAddress);
                // Getting driver location
                //$driver = Driver::where('user_id', $userID)->first();
                //$driverLocation = Address::where('id', $driver->location_id)->first();
                //data_fill($destinations, 'driver', $driverLocation->google_geocode_address);

                // Getting orders from driver
                $orders = Order::where(['restaurant_id' => $restaurant->id, 'is_archived' => false])->get();

                // Getting restaurant location
                if ($orders->count() > 0) {

                    $restaurantID = $orders->first()->restaurant_id;
                    $restaurant = Restaurant::where('id', $restaurantID)->first();
                    $restaurantLocation = Address::where('id', $restaurant->user()->first()->address_id)->first();

                    data_fill($destinations, 'restaurant', $restaurantLocation->google_geocode_address);

                    // Setting the delivery addresses
                    $orders->each(function ($order, $key) use (&$destinations) {
                        data_fill($destinations, "delivery.$key", Address::where('id', $order->address_id)->first()->google_geocode_address);
                    });

                    // dd(count($destinations['delivery']));
                    // if (count($destinations['delivery']) == 1) {
                    //     $directions[] =  $this->getDirections($destinations['driver'], $destinations['restaurant'], $destinations['delivery'][0]);
                    // } else {
                    //     $directions[] =  $this->getDirections($destinations['driver'], $destinations['restaurant'], $destinations['delivery'][0], $destinations['delivery'][1]);
                    //     $directions[] =  $this->getDirections($destinations['driver'], $destinations['restaurant'], $destinations['delivery'][1], $destinations['delivery'][0]);
                    // }

                    // dd($destinations);
                    // calculating the durations
                    // if (count($directions) == 1) {
                    //     $durations[] = $this->totalDuration($directions[0]);

                    //     return view('restaurant.pages.map', [
                    //         'directions' => $directions[0],
                    //         'orders' => $orders,
                    //         'duration' => $durations[0]
                    //     ]);
                    // }

                    // calculating the durations
                    //$durations = [$this->totalDuration($directions[0]), $this->totalDuration($directions[1])];
                    $durations = [];

                    // if ($durations[0] <= $durations[1]) {
                    //     return view('restaurant.pages.map', [
                    //         'directions' => $directions[0],
                    //         'orders' => $orders,
                    //         'duration' => $durations[0]
                    //     ]);
                    // }

                    return view('restaurant.pages.map', [
                        'directions' => null,
                        'orders' => $orders,
                        'duration' => null
                    ]);
                }
            }

            return view('restaurant.pages.map', [
                'directions' => null,
                'orders' => $orders,
                'duration' => []
            ])->withErrors(['warning' => 'There was an error retrieving your location']);
        }
    }

    public function select(Request $request)
    {
        $destinations = [];
        // getting selected order

        $order = Order::where('id', $request->input('order-id'))->first();


        // getting driver
        //dd($order);
        $driver = Driver::where('id', $order->driver_id)->first();
        $driverLocation = Address::where('id', $driver->location_id)->first();

        data_fill($destinations, 'driver', $driverLocation->google_geocode_address);

        // // getting restaurant
        // // $restaurant = $order->restaurant()->first()->user()->first()->address()->first();
        $restaurant = $order->restaurant()->first();
        $restaurantLocation = Address::where('id', $restaurant->user()->first()->address_id)->first();

        data_fill($destinations, 'restaurant', $restaurantLocation->google_geocode_address);

        // // getting all orders

        $orders = Order::where(['restaurant_id' => $restaurant->id, 'is_archived' => false])->get();

        // //dd($orders);

        $orders->each(function ($order, $key) use (&$destinations) {
            data_fill($destinations, "delivery.$key", Address::where('id', $order->address_id)->first()->google_geocode_address);
        });

        // // $driver->order()->get()->each(function ($driverEntry, $key) use (&$deliveries) {


        // //     $deliveries =  $driverEntry->address()->first();
        // // });

        // // $directions = $this->getDirections($driverAddress, $restaurantAddress, $orders->get(1), $orders->get(2));

        if (count($destinations['delivery']) == 1) {
            $directions[] =  $this->getDirections($destinations['driver'], $destinations['restaurant'], $destinations['delivery'][0]);
        } else {
            $directions[] =  $this->getDirections($destinations['driver'], $destinations['restaurant'], $destinations['delivery'][0], $destinations['delivery'][1]);
            $directions[] =  $this->getDirections($destinations['driver'], $destinations['restaurant'], $destinations['delivery'][1], $destinations['delivery'][0]);
        }

        // //dd($destinations);
        // // calculating the durations
        if (count($directions) == 1) {
            $durations[] = $this->totalDuration($directions[0]);

            return response()->json(['directions' => $directions[0], 'orders' => $orders, 'durations', $durations[0]], 200);
            //return response()->json(['success' => 'Success'], 200);
        }

        // calculating the durations
        $durations = [$this->totalDuration($directions[0]), $this->totalDuration($directions[1])];

        if ($durations[0] <= $durations[1]) {
            return response()->json(['directions' => $directions[0], 'orders' => $orders, 'durations', $durations[0], 200]);
            //return response()->json(['success' => 'Success'], 200);
        }

        return response()->json(['directions' => $directions[1], 'orders' => $orders, 'durations', $durations[1]], 200);
        //return response()->json(['success' => $restaurant], 200);

        // dd($deliveries);
    }

    private function getDirections($driver, $restaurant, $firstDestination, $secondDestination = null)
    {
        $directions =  \GoogleMaps::load('directions')->setParam([
            'origin' => $driver,
            'waypoints' => [$restaurant, $secondDestination],
            'destination' => $firstDestination,
            'departure_time' => 'now'
        ])->get();

        return json_decode($directions);
    }


    private function totalDuration($direction)
    {
        $durations = [];

        if ($direction->status == 'OK') {
            $durations = data_get($direction, 'routes.*.legs.*.duration.value');
        }

        return array_sum($durations);
    }
}
