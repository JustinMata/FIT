<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test(){
        $user = \App\User::where('email', '=', 'jamarcellin@gmail.com')->first();

        var_dump($user);
    }
}
