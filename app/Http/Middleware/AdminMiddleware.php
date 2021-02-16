<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class AdminMiddleware
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
        if(Auth::user()->usertype=='admin')
        {
            return $next($request);
        }
        else
        {
            return redirect('/home')->with('status','You Have Been Removed As Admin So You are Redirect to Appointment Booking');
        }

    }
}
