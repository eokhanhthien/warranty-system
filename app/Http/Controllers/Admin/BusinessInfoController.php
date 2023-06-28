<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Business;
use App\BusinessCategory;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SelectOptionsController;

class BusinessInfoController extends Controller
{
    public function index(Request $request){
        // Thêm address
        // print_r(auth()->user()->id);die;
        $selectOptionsController = new SelectOptionsController();
        $selectOptions = $selectOptionsController->getAddressOptions();
        $provinces = $selectOptions->getData()['provinces'];
        $wards = $selectOptions->getData()['wards'];
        $districts = $selectOptions->getData()['districts'];
        $businesses = Business::findOrFail(auth()->user()->business_id);
        $category = Business::join('business_categories', 'businesses.business_category_id', '=', 'business_categories.id')
        ->select('business_categories.vi_name')
        ->where('businesses.id', $businesses->id)
        ->first();
        return view('admin.business_info', compact('provinces', 'wards', 'districts','businesses','category'));
    }

    public function update(Request $request){
        $business = Business::findOrFail(Auth::user()->business_id);
        $addressArray = [
            'province' => !empty($request->province)?$request->province : '',
            'district' => !empty($request->district)?$request->district : '',
            'ward' => !empty($request->ward)?$request->ward : ''
        ];
        
        $addressJson = json_encode($addressArray);
        $business->email = !empty($request->email) ? $request->email : '';
        $business->phone_number = !empty($request->phone_number) ? $request->phone_number : '';
        $business->fb_link = !empty($request->fb_link) ? $request->fb_link : '';
        $business->twitter_link = !empty($request->twitter_link) ? $request->twitter_link : '';
        $business->address = $addressJson;
        $business->save();
        return redirect()->back()->with('success', 'Cập nhật doanh nghiệp thành công');
    }

}