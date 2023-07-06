<?php

namespace App\Http\Middleware;

use Closure;
use App\Business;
use App\BusinessCategory;
use App\BusinessDisplay;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
class CheckDomain
{
    public function handle($request, Closure $next)
    {
        $domain = $request->domain;
        $category = $request->category_slug;

        $business = Business::where('domain', $domain)->first();

        if (!$business) {
            return response()->view('error.index');
        }

        $businessCategory = BusinessCategory::find($business->business_category_id);

        if (!$businessCategory) {
            return response()->view('error.index');
        }

        if ($businessCategory->slug != $category) {
            return response()->view('error.index');
        }

        $businesses = Business::where('owner_id', $business->owner_id )
        ->join('business_displays', 'businesses.business_display_id', '=', 'business_displays.id')
        ->select('business_displays.slug as display_slug')
        ->first();

        // Chuyển thông tin doanh nghiệp và danh mục vào request để có thể truy cập từ controller
        $request->merge([
            'business' => $business,
            'businessCategory' => $businessCategory,
            'display_slug' => $businesses->display_slug
        ]);

        return $next($request);
    }
}
