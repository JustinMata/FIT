<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test(){
        // $user = \App\User::where('email', '=', 'jamarcellin@gmail.com')->first();

        // var_dump($user);

        $driverLocation = "345+E+William+St,CA";
        $restaurantLocation = "140+E+San+Carlos+St,CA";
        $clientLocation = "san+jose+state+university";

        $response = \GoogleMaps::load('directions')
		->setParam ([
            'origin' => $driverLocation,
            'waypoints' => ['optimize:true',$restaurantLocation],
            'destination' => $clientLocation,
            'departure_time' => 'now'
            ])
         ->get();

         dd($response);


    }

    public function testPost(Request $request){

        dd($request);

        Order::create([
            'base_rate' => config(api.BASE_RATE),
            'mileage_rate' => config(api.MILEAGE_RATE),
            'delivery_price' => config(api.DELIVERY_PRICE),
            'taxes' => config(api.TAXES),
            'mileage_trip' => 0,
            'delivery_name' => $request

            ]);

        $drivers = $this->findDriver(Address::where('id', auth()->user()->address_id)->first());

        dd($drivers);

        $driverLocation = "345+E+William+St,CA";
        $restaurantLocation = "140+E+San+Carlos+St,CA";
        $clientLocation = "san+jose+state+university";

        $directions = \GoogleMaps::load('directions')
		->setParam ([
            'origin' => $driverLocation,
            'waypoints' => ['optimize:true',$restaurantLocation],
            'destination' => $clientLocation,
            'departure_time' => 'now'
            ])
         ->get();

         return view('driver.pages.map', ['directions' => $directions]);



    }
}
