<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if ( Auth::user()->role == 2) {
            return $next($request);
        }
        
        // Nếu không có quyền, chuyển hướng hoặc xử lý theo yêu cầu của bạn
        // return redirect()->route('access-denied');
        return view('error.index');
    }
}
