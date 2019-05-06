<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $user = Auth::user();

        $driver = [];
        $currentOrder = [];
        $customerAddress = [];

        if ($user->hasRole('driver')) {
            $driver = \App\Driver::where('user_id', $user->id)->first();
            $order = \App\Order::where('driver_id', $driver->id)->where('is_delivered', false)->where('is_archived', false);
            if ($order->first()) {
                $currentOrder = $order->first();
                $customerAddress = \App\Address::where('id', $currentOrder->address_id)->first();
            }
        }

        $address = \App\Address::where('id', $user->address_id)->first();

        return view('driver.pages.dashboard', compact('user', 'driver', 'currentOrder', 'customerAddress', 'address'));
    }

    /**
     * Show the orders in table.
     *
     * @return void
     */
    public function show()
    {
        if (\Auth::user()->hasAnyRole('admin') && request()->is('driver*')) {
            return view('driver.pages.orders', ['orders' => \App\Order::orderBy('is_archived', 'asc')->paginate(10)]);
        } else {
            $driver = \App\Driver::where('user_id', auth()->id())->first();
            $driverID = $driver->id;
            return view('driver.pages.orders', ['orders' => \App\Order::where('driver_id', $driverID)->paginate(10)]);
        }
    }

    /**
     * Show the orders in table.
     *
     * @return void
     */
    public function updateLocation(Request $request)
    {

        $input = $request->all();

        $driver = \App\Driver::where('id', $request->input('driverID'))->first();

        $location = $driver->location()->first();

        // $location->latitude = $request->input(json_decode('result.lat');
        // $location->longitude = $request->input('result.lng');

        // if($location->save())
        // {
        $response =  ['success' => 'New geolocation saved!'];
        return response()->json($response, 200);
        // } else {
        //     $response =  ['error'=>'Could not save new geolocation!'];
        //     return response()->json($response, 200);
        // }
    }

    /**
     * Deliver the order.
     *
     * @return void
     */
    public function deliver(Request $request)
    {
        $order = \App\Order::where('id', $request->input('order-id'))->first();

        $order->is_delivered = true;

        $order->save();

        app(OrderController::class)->archiveOrder($order);

        $driver = \App\Driver::where('id', $order->driver_id)->first();

        $driver->totalEarnings += $order->delivery_price / 2;

        $driver->save();

        return redirect()->action('DriverController@index');
    }
}
