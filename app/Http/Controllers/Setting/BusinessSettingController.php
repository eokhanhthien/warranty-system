<?php

namespace App\Http\Controllers\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BusinessCategory;
use App\BusinessDisplay;

class BusinessSettingController extends Controller
{
    public function businessSetting(Request $request){
        $business_category = BusinessCategory::all();
        $business_display = BusinessDisplay::all();

        return view('view-seller.business_setting.index', compact('business_category','business_display'));
    
    }
}
