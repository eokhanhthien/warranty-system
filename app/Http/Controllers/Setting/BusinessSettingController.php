<?php

namespace App\Http\Controllers\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BusinessCategory;
use App\BusinessDisplay;
use App\Business;
use App\User;
use Illuminate\Support\Facades\Auth;

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
      $business = new Business();
      $business->name = $request->name;
      $business->domain = $request->domain;
      $business->email = $request->email;
      $business->phone_number = $request->phone_number;
      $business->business_category_id = $request->business_category_id; 

      $business_display_default = BusinessDisplay::where('business_category_id', $request->business_category_id)->first();
      $business->business_display_id = !empty($request->business_display_id)?$request->business_display_id : $business_display_default->id;   
      $business->owner_id = Auth::user()->id;
      $business->save();
      $business_id = $business->id;
      $user =  User::find(Auth::user()->id);
      $user->business_id = $business_id;
      $user->save();
      // Redirect or return a response
      return redirect()->route('admin.dashboard')->with('success', 'Thiết lập danh nghiệp thành công');
      }
}
