<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SuperadminMiddleware
{
    public function handle($request, Closure $next)
    {
        if ( Auth::user()->role == 1) {
            return $next($request);
        }
        // Nếu không có quyền, chuyển hướng hoặc xử lý theo yêu cầu của bạn
        // return redirect()->route('access-denied');
        return response()->view('error.index');
    }
}
