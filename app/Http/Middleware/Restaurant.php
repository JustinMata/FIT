<?php

namespace App\Http\Middleware;

use Closure;

class Restaurant
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!auth()->user()->hasRole('restaurant')) {
            return route('home');
        }

        return $next($request);
    }
}
