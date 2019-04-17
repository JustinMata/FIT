<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
        $user = Auth::user();

        if($user->hasRole('driver')){
            return redirect( '/driver/dashboard');
        }

        if($user->hasRole('restaurant')){
            return redirect( '/restaurant/dashboard');
        }

        if($user->hasRole('admin')){
            return redirect( '/admin/dashboard');
        }

        return redirect('/home');
    }
}
