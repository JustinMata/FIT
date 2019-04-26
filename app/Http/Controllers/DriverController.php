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
            return view('driver.pages.orders', ['orders' => \App\Order::paginate(10)]);
        } else {
            $driver = \App\Driver::where('user_id', auth()->id())->first();
            $driverID = $driver->id;
            return view('driver.pages.orders', ['orders' => \App\Order::where('driver_id', $driverID)->paginate(10)]);
        }
    }

    public function showRegistrationForm()
    {
        return view('driver.pages.registerDriver');
    }

    public function register(Request $data)
    {
        $addressID = \App\User::where('id', auth()->id())->value('address_id');

        DB::table('drivers')->insert([
            'user_id' => auth()->id(),
            'location_id' => $addressID,
            'account_number' => $data['account_number'],
            'account_routing' => $data['account_routing'],
            'is_available' => true,
            'car' => $data['car'],
            'license_plate' => $data['license_plate'],
            'license_number' => $data['license_number'],
            'license_expiration' => $data['license_expiration'],
            'insurance_number' => $data['insurance_number'],
        ]);

        return redirect('/');
    }
}
