<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectHomePage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        //check if user had login and has role =1 (admin) then redirect to admin's home page else redirect to user's home page
        if (\Auth::check() && \Auth::user()->role == 1) {
            return redirect()->route('admin.home');
        } else {
            return redirect()->route('user.home');;
        }
        return abort(403);
    }
}
