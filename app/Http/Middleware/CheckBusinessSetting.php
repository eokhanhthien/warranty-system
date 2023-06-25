<?php

namespace App\Http\Middleware;

use Closure;
use App\Business;
use App\BusinessCategory;
use Illuminate\Support\Facades\Auth;

class CheckBusinessSetting
{
    public function handle($request, Closure $next)
    {
        $business = $request->business;
        $businessCategory = $request->businessCategory;
    
        $businesses = Business::where('owner_id', Auth::user()->id)
        ->join('business_categories', 'businesses.business_category_id', '=', 'business_categories.id')
        ->select('businesses.domain', 'business_categories.slug')
        ->first();

        if (empty($businesses)) {
            return redirect()->route('business.setting');
        }
        // Chuyển thông tin đã có và thông tin mới vào request
        $request->merge([
            'business' => $business,
            'businessCategory' => $businessCategory,
            // Thêm thông tin mới khác vào đây nếu cần
        ]);
    
        return $next($request);
    }
}
