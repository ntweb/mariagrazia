<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class LabEnter
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
        if (Auth::user()->business == '1') {
            Auth::logout();
            return redirect()->action('Lab\LoginController@login')->with('status', 'Cannot access!');;
        }


        return $next($request);
    }
}
