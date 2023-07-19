<?php

namespace App\Http\Middleware;

use Closure;
use App\Subscription;
use Carbon\Carbon;

class CheckSubscription
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

        $now = Carbon::now();
        $subscription = new Subscription();
        $currentPackage = $subscription->where('start_date', '<=', $now)
        ->where('end_date', '>=', $now)
        ->where('status', 'accept')
        ->where('business_id', $request->business->id)
        ->first();
        if ( !empty($currentPackage) && $currentPackage != null) {
            return $next($request);
        } else {
            return response()->view('error.not_found_package');
        }
    }
}
