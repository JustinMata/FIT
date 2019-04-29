<?php

namespace App\Http\Controllers;

use App\Driver;
use App\Address;
use App\Order;
use App\Restaurant;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test()
    {
        $destinations = [];
        // getting selected order

        // $order = Order::where('id', $request->input('order-id'))->first();

        $order = Order::where('id', 53)->first();
        // getting driver
        //$driver = $order->driver()->first()->location()->first();
        $driver = $order->driver()->first();
        $driverLocation = Address::where('id', $driver->location_id)->first();

        data_fill($destinations, 'driver', $driverLocation->google_geocode_address);

        // getting restaurant
        // $restaurant = $order->restaurant()->first()->user()->first()->address()->first();
        $restaurant = $order->restaurant()->first();
        $restaurantLocation = Address::where('id', $restaurant->user()->first()->address_id)->first();

        data_fill($destinations, 'restaurant', $restaurantLocation->google_geocode_address);

        // getting all orders

        $orders = Order::where(['restaurant_id' => $restaurant->id, 'is_archived' => false])->get();

        //dd($orders);

        $orders->each(function ($order, $key) use (&$destinations) {
            data_fill($destinations, "delivery.$key", Address::where('id', $order->address_id)->first()->google_geocode_address);
        });

        //dd($orders);

        // $driver->order()->get()->each(function ($driverEntry, $key) use (&$deliveries) {


        //     $deliveries =  $driverEntry->address()->first();
        // });

        // $directions = $this->getDirections($driverAddress, $restaurantAddress, $orders->get(1), $orders->get(2));
        //dd($destinations);

        if (count($destinations['delivery']) == 1) {
            $directions[] =  $this->getDirections($destinations['driver'], $destinations['restaurant'], $destinations['delivery'][0]);
        } else {
            $directions[] =  $this->getDirections($destinations['driver'], $destinations['restaurant'], $destinations['delivery'][0], $destinations['delivery'][1]);
            $directions[] =  $this->getDirections($destinations['driver'], $destinations['restaurant'], $destinations['delivery'][1], $destinations['delivery'][0]);
        }
        dd($directions);

        //dd($destinations);
        // calculating the durations
        if (count($directions) == 1) {
            $durations[] = $this->totalDuration($directions[0]);

            // return view('restaurant.pages.map', [
            //     'directions' => $directions[0],
            //     'orders' => $orders,
            //     'duration' => $durations[0]
            // ]);
            return response()->json(['directions' => $directions[0], 'orders' => $orders, 'durations', $durations[0]], 200);
        }

        // calculating the durations
        $durations = [$this->totalDuration($directions[0]), $this->totalDuration($directions[1])];

        if ($durations[0] <= $durations[1]) {
            // return view('restaurant.pages.map', [
            //     'directions' => $directions[0],
            //     'orders' => $orders,
            //     'duration' => $durations[0]
            // ]);
            return response()->json(['directions' => $directions[0], 'orders' => $orders, 'durations', $durations[0], 200]);
        }

        // return view('driver.pages.map', [
        //     'directions' => $directions[1],
        //     'orders' => $orders,
        //     'duration' => $durations[1]
        // ]);



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

    public function testPost(Request $request)
    {

        dd($request);

        Order::create([
            'base_rate' => config(api . BASE_RATE),
            'mileage_rate' => config(api . MILEAGE_RATE),
            'delivery_price' => config(api . DELIVERY_PRICE),
            'taxes' => config(api . TAXES),
            'mileage_trip' => 0,
            'delivery_name' => $request

        ]);

        $drivers = $this->findDriver(Address::where('id', auth()->user()->address_id)->first());

        dd($drivers);

        $driverLocation = "345+E+William+St,CA";
        $restaurantLocation = "140+E+San+Carlos+St,CA";
        $clientLocation = "san+jose+state+university";

        $directions = \GoogleMaps::load('directions')
            ->setParam([
                'origin' => $driverLocation,
                'waypoints' => ['optimize:true', $restaurantLocation],
                'destination' => $clientLocation,
                'departure_time' => 'now'
            ])
            ->get();

        return view('driver.pages.map', ['directions' => $directions]);
    }
}
