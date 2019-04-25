<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DriverController extends UserController
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the admin application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('driver.pages.dashboard');
    }


    /**
     * Show the orders in table.
     *
     * @return void
     */
    public function show()
    {
        if (\Auth::user()->hasAnyRole(['admin']) && request()->is('driver*')) {
            return view('driver.pages.orders', ['orders' => \App\Order::all()->take(10)]);
        } else {
            $driver = \App\Driver::where('user_id', auth()->id())->first();
            $driverID = $driver->id;
            return view('driver.pages.orders', ['orders' => \App\Order::where('driver_id', $driverID)->get()]);
        }
    }

    /**
     * Gathers driver location and returns map info
     *
     * @return void
     */
    public function map()
    {
        // if (\Auth::user()->hasAnyRole(['admin']) && request()->is('driver*')) {
        //     return view('driver.pages.orders', ['orders' => \App\Order::all()->take(10)]);
        // } else {
        //     $driver = \App\Driver::where('user_id', auth()->id())->first();
        //     $driverID = $driver->id;
        //     return view('driver.pages.orders', ['orders' => \App\Order::where('driver_id', $driverID)->get()]);
        // }

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
