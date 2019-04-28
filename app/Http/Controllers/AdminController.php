<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends UserController
{
    /**
     * Show the admin application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();

        return view('admin.pages.dashboard', ['user' => $user]);
    }

    /**
     * Show the admin application dashboard.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function changeDriver(Request $request)
    {
        $order = Order::where('id', $request->input('order-id'))->first();
        $order->driver_id = $request->input('driver-id');
        $order->save();

        return redirect()->action('RestaurantController@show');
    }
}
