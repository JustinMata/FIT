<?php

namespace App\Http\Controllers;

use DB;
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
        if (\Auth::user()->hasAnyRole('admin') && request()->is('driver*')) {
            return view('driver.pages.orders', ['orders' => \App\Order::orderBy('is_archived', 'asc')->paginate(10)]);
        } else {
            $driver = \App\Driver::where('user_id', auth()->id())->first();
            $driverID = $driver->id;
            return view('driver.pages.orders', ['orders' => \App\Order::where('driver_id', $driverID)->paginate(10)]);
        }
    }
}
