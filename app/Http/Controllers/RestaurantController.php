<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
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
        $user = Auth::user();
        $address = \App\Address::where('id', $user->address_id)->first();

        return view('restaurant.pages.dashboard', compact('user','address'));
    }

    /**
     * Show the admin application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show()
    {
        if (\Auth::user()->hasAnyRole('admin') && request()->is('restaurant*'))
        {
            return view('restaurant.pages.orders', ['orders' => \App\Order::orderBy('is_archived', 'asc')->paginate(10), 'drivers' => \App\Driver::all(), 'users' => \App\User::all()]);
        } else {
            $restaurant = \App\Restaurant::where('user_id', auth()->id())->first();
            $restaurantID = $restaurant->id;
            return view('restaurant.pages.orders', ['orders' => \App\Order::where('restaurant_id', $restaurantID)->orderBy('is_archived', 'asc')->paginate(10), 'drivers' => \App\Driver::all(), 'users' => \App\User::all()]);
        }
    }
}
