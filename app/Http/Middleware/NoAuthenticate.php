<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class NoAuthenticate
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()&& Auth::user()->role === 1) {
            return redirect()->route('superadmin.dashboard');
        }
        else if (Auth::check()&& Auth::user()->role === 2) {
            return redirect()->route('admin.dashboard');
        }
        return $next($request);
    }
}
