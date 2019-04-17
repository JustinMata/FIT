<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RestaurantController extends UserController
{
    /**
     * Show the admin application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('restaurant.pages.dashboard');
    }

    /**
     * Show the admin application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show()
    {
        return view('restaurant.pages.orders', ['orders'=> \App\Order::all()->take(10)]);
    }
}
