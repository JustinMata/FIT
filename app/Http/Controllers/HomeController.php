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
        $user = Auth::user();

        if($user->hasRole('driver'))
        {
            return redirect('/driver/dashboard');
        }
        else if($user->hasRole('restaurant'))
        {
            return redirect('/restaurant/dashboard');
        }
        else if($user->hasRole('admin')){
            return redirect('/admin/dashboard');
        }
        else return redirect('/');
    }
}
