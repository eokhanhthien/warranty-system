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

        return view('view-seller.business_setting.index', compact('business_category'));
    }

    public function businessDisplaySetting(Request $request){
      $business_display = BusinessDisplay::where('business_category_id', $request->business_category_id)->get();
      return response()->json($business_display);
    }

    public function businessSettingAdd(Request $request){
        echo "<pre>";
        print_r($request->all());die;
      }
}
