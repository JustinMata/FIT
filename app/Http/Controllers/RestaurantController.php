<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RestaurantController extends UserController
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
        return view('restaurant.pages.dashboard');
    }

    /**
     * Show the admin application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show()
    {
        if (\Auth::user()->hasAnyRole(['admin']) && request()->is('restaurant*')) {
            return view('restaurant.pages.orders', ['orders' => \App\Order::paginate(10), 'drivers' => \App\Driver::all(), 'users' => \App\User::all()]);
        } else {
            $restaurant = \App\Restaurant::where('user_id', auth()->id())->first();
            $restaurantID = $restaurant->id;
            return view('restaurant.pages.orders', ['orders' => \App\Order::where('restaurant_id', $restaurantID)->paginate(10), 'drivers' => \App\Driver::all(), 'users' => \App\User::all()]);
        }
    }
}
