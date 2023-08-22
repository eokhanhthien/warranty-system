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
        
        $display = Business::where('owner_id', Auth::user()->id )
        ->join('business_displays', 'businesses.business_display_id', '=', 'business_displays.id')
        ->select('business_displays.slug as display_slug')
        ->first();
        $businesses->display = $display->display_slug;

        $request->session()->put('businesses', $businesses);
        
        $domain =  $baseUrl . '/artisq/' . $businesses->domain . '/' . $businesses->slug;
        $request->session()->put('domain', $domain);
        return view('admin.dashboard', compact('domain'));
    }

}