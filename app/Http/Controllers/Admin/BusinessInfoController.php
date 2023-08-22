<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Business;
use App\BusinessCategory;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SelectOptionsController;
use App\Http\Controllers\UploadDriverColtroller;

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
        return view('admin.setting_business.business_info', compact('provinces', 'wards', 'districts','businesses','category'));
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
        if ($request->hasFile('image')) {
            // upload image
            $uploadController = new UploadDriverColtroller();
            $path_image = $uploadController->upload_singer_image($request);

            // Delete old image
            if(!empty($business->logo_image)){
            $deleteimage = new UploadDriverColtroller();
            $deleteimage->delete_image($business->logo_image);
            }
            $business->logo_image = $path_image;
        }else{
            $business->logo_image  = $business->logo_image;
        }
        $business->save();
        return redirect()->back()->with('success', 'Cập nhật doanh nghiệp thành công');
    }

    public function businessDisplay(){
        $business = Business::findOrFail(Auth::user()->business_id);
        $display_information = json_decode($business->display_information);
        // dd($display_information->service);
        return view('admin.setting_business.business_display', compact('display_information'));
    }

    public function setBusinessDisplay(Request $request){

        $business = Business::findOrFail(Auth::user()->business_id);
        $display_information_old = json_decode($business->display_information);

        // echo"<pre>";
        // print_r(json_decode($business->display_information)->images);die;
        if ($request->hasFile('images')) {
            $uploadImage = new UploadDriverColtroller();
            $pathImage = $uploadImage->upload_image($request);

            $displayInformation['images'] = $pathImage;

            // Xóa ảnh cũ
            if(!empty(json_decode($business->display_information)->images)){
                foreach (json_decode($business->display_information)->images as $key => $image) {
                        $deleteImage = new UploadDriverColtroller();
                        $deleteImage->delete_image($image);
                }
            }

        }else{
            $displayInformation['images'] = !empty($display_information_old->images) ? $display_information_old->images : '';
        }

        if ($request->hasFile('image')) {
            // upload image
            $uploadController = new UploadDriverColtroller();
            $path_image = $uploadController->upload_singer_image($request);
            $displayInformation['image'] = $path_image;
            // Delete old image
            if(!empty(json_decode($business->display_information)->image)){
            $deleteimage = new UploadDriverColtroller();
            $deleteimage->delete_image(json_decode($business->display_information)->image);
            }
        }else{
            $displayInformation['image'] = !empty($display_information_old->image) ? $display_information_old->image : '';
        }

        $displayInformation['title_banner'] = $request->title_banner ? $request->title_banner : null;
        $displayInformation['service'] = $request->service ? $request->service : null;
        $displayInformation['service_title'] = $request->service_title ? $request->service_title : null;
        $jsonData = json_encode($displayInformation);
        $business->display_information = $jsonData;
        $business->save();
        return redirect()->back()->with('success', 'Cập nhật giao diện thành công');

    }

    public function businessService(){
        $business = Business::findOrFail(Auth::user()->business_id);
        $display_information = json_decode($business->display_information);
        // dd($display_information->service);
        return view('admin.services_business.business_services', compact('display_information'));
    }

}