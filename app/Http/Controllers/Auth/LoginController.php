<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
    * Where to redirect users after login.
    *
    * @var string
    */
    // protected $redirectTo = '/';
    protected function redirectTo()
    {
        $user = Auth::user();

        if($user->hasRole('driver'))
        {
            return '/driver/dashboard';
        }
        else if($user->hasRole('restaurant'))
        {
            return '/restaurant/dashboard';
        }
        else if($user->hasRole('restaurant'))
        {
            return '/admin/dashboard';
        }
        else return '/home';
    }

    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
