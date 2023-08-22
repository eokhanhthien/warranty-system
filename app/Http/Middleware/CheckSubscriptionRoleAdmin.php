<?php

namespace App\Http\Middleware;

use Closure;
use App\Subscription;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CheckSubscriptionRoleAdmin
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
    
        $now = Carbon::now()->toDateString();
        $subscription = new Subscription();
        $currentPackage = $subscription->where('start_date', '<=', $now)
        ->where('end_date', '>=', $now)
        ->where('status', 'accept')
        ->where('business_id', Auth::user()->business_id)
        ->first();
        if ( !empty($currentPackage) && $currentPackage != null) {
            return $next($request);
        } else {
            return redirect()->back()->with('error', 'Gói đăng ký đã hết hạn hoặc không hỗ trợ.');
        }
    }
}
