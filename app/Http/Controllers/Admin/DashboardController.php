<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Business;
use App\BusinessCategory;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request){
        $baseUrl = $request->getSchemeAndHttpHost();
        $businesses = Business::where('owner_id', Auth::user()->id)
        ->join('business_categories', 'businesses.business_category_id', '=', 'business_categories.id')
        ->select('businesses.domain', 'business_categories.slug')
        ->first();

        $domain =  $baseUrl . '/artisq/' . $businesses->domain . '/' . $businesses->slug;
        return view('admin.dashboard', compact('domain'));
    }

}