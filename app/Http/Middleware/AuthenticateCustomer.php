<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthenticateCustomer
{
    public function handle($request, Closure $next)
    {

        if (Auth::guard('customer')->check()) {
            return $next($request);
        }
  
        return redirect()->back()->with('error', 'Bạn chưa đăng nhập');

    }
}
