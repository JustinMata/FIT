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
        $orders = [];
        $firstCustomerAddress = [];
        $secondCustomerAddress = [];

        if ($user->hasRole('driver')) {
            $driver = \App\Driver::where('user_id', $user->id)->first();
            $orders = \App\Order::where('driver_id', $driver->id)->where('is_delivered', false)->where('is_archived', false)->get();
            if (count($orders) > 0) {
                $firstCustomerAddress = \App\Address::where('id', $orders->get(0)->address_id)->first();
                if (count($orders) > 1) $secondCustomerAddress = \App\Address::where('id', $orders->get(1)->address_id)->first();
            }
            // $firstOrder = $orders->first();
            // $firstCustomerAddress = \App\Address::where('id', $firstOrder->address_id)->first();
            // $secondOrder = [];
            // $secondCustomerAddress = [];
            // if ($orders->count > 1) {
            //     $secondOrder = $orders->get(2);
            //     $secondCustomerAddress = \App\Address::where('id', $secondOrder->address_id)->first();
            // }
        }

        $address = \App\Address::where('id', $user->address_id)->first();

        return view('driver.pages.dashboard', compact('user', 'driver', 'orders', 'firstCustomerAddress', 'secondCustomerAddress', 'address'));
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

        $location->latitude = $request->input('coords')[0];
        $location->longitude = $request->input('coords')[1];

        if ($location->save()) {
            $response =  ['success' => 'New geolocation saved!'];
            return response()->json($location, 200);
        } else {
            $response =  ['error' => 'Could not save new geolocation!'];
            return response()->json($response, 400);
        }
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

    /**
     * Toggle availability for driver.
     *
     * @return void
     */
    public function available(Request $request)
    {
        $driver = \App\Driver::where('id', $request->input('driver-id'))->first();

        $driver->is_available = !$driver->is_available;

        $driver->save();

        return redirect()->action('DriverController@index');
    }
}
