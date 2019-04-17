<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DriverController extends UserController
{
    /**
     * Show the admin application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('driver.pages.dashboard');
    }
}
