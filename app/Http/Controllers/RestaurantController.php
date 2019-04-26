<?php

namespace App\Http\Controllers;

use DB;
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
        if (\Auth::user()->hasAnyRole(['admin', 'restaurant']) && request()->is('restaurant*')) {
            return view('restaurant.pages.orders', ['orders' => \App\Order::paginate(10), 'drivers' => \App\Driver::all(), 'users' => \App\User::all()]);
        } else {
            $restaurant = \App\Restaurant::where('user_id', auth()->id())->first();
            $restaurantID = $restaurant->id;
            return view('restaurant.pages.orders', ['orders' => \App\Order::where('restaurant_id', $restaurantID)->paginate(10), 'drivers' => \App\Driver::all(), 'users' => \App\User::all()]);
        }
    }

    public function showRegistrationForm()
    {
        return view('restaurant.pages.registerRestaurant');
    }

    public function register(Request $data)
    {

        DB::table('restaurants')->insert([
            'user_id' => auth()->id(),
            'provider' => $data['provider'],
            'CC_name' => $data['CC_name'],
            'CC_number' => $data['CC_number'],
            'CC_expiration' => $data['CC_expiration'],
            'CC_CVC' => $data['CC_CVC'],
        ]);

        return redirect('/');
    }
}
