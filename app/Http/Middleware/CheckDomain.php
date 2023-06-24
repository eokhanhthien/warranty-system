<?php

namespace App\Http\Middleware;

use Closure;
use App\Business;
use App\BusinessCategory;

class CheckDomain
{
    public function handle($request, Closure $next)
    {
        $domain = $request->domain;
        $category = $request->category_slug;

        $business = Business::where('domain', $domain)->first();

        if (!$business) {
            return response('Lỗi: Không tìm thấy doanh nghiệp với tên miền này.', 404);
        }

        $businessCategory = BusinessCategory::find($business->business_category_id);

        if (!$businessCategory) {
            return response('Lỗi: Không tìm thấy danh mục doanh nghiệp.', 404);
        }

        if ($businessCategory->slug != $category) {
            return response('Lỗi: Tên danh mục doanh nghiệp không khớp.', 404);
        }

        // Chuyển thông tin doanh nghiệp và danh mục vào request để có thể truy cập từ controller
        $request->merge([
            'business' => $business,
            'businessCategory' => $businessCategory,
        ]);

        return $next($request);
    }
}
