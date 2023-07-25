<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Business;
use App\BusinessService;
use App\ProductCategory;
use App\ProductSubcategory;
use App\ProductType;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UploadDriverColtroller;

class BusinessProductController extends Controller
{
    public function index(Request $request){
  
        $business_service =  BusinessService::where('business_id', auth()->user()->business_id)->get();

        $categories = ProductCategory::where('business_id', Auth::user()->business_id)->get();
        $sub_categories = ProductSubcategory::where('business_id', Auth::user()->business_id)->get();
        $product_types = ProductType::get();
        // dd($product_types[0]);
        return view('admin.product_business.index',compact('business_service','categories','sub_categories','product_types'));
    }

    public function create()
    {
        return view('admin.business.service.create');
    }

    public function store(Request $request)
    {
        dd($request->all());
        // upload image
        $uploadController = new UploadDriverColtroller();
        $path_image = $uploadController->upload_image($request);

        $business_service = new BusinessService;
        $business_service->name = $request->name;
        $business_service->short_description = $request->short_description;
        $service = json_encode($request->service);
        $business_service->service = $service;
        $business_service->detail_description = $request->content;
        $business_service->business_id = auth()->user()->business_id;
        $business_service->image = $path_image;

        $business_service->save();

        return redirect()->route('business-service.index')->with('success', 'Tạo dịch vụ thành công.');
    }

    public function show(BusinessService $businessService)
    {
        dd(123);
        // return view('admin.business.service.show', compact('businessService'));
    }

    public function edit(BusinessService $businessService)
    {
        $business_service = $businessService;
        return view('admin.services_business.edit', compact('business_service'));
    }

    public function update(Request $request, BusinessService $businessService)
    {
        $business_service = $businessService;
        
        if ($request->hasFile('image')) {
            $uploadimage = new UploadDriverColtroller();
            $path_image = $uploadimage->upload_image($request);
            
            // Delete old image
            $deleteimage = new UploadDriverColtroller();
            $deleteimage->delete_image($business_service->image);
            
            $business_service->image = $path_image;
        }
    
        $business_service->name = $request->name;
        $business_service->short_description = $request->short_description;
        $service = json_encode($request->service);
        $business_service->service = $service;
        $business_service->detail_description = $request->content;
    
        $business_service->save();
    
        return redirect()->route('business-service.index')->with('success', 'Cập nhật dịch vụ thành công.');
    }
    

    public function destroy(BusinessService $businessService)
    {
        $deleteimage = new UploadDriverColtroller();
        $deleteimage->delete_image($businessService->image);

        $businessService->delete();

        return redirect()->route('business-service.index')->with('success', 'Xóa dịch vụ thành công..');
    }


    public function getAttributes($id)
    {
        $productType = ProductType::findOrFail($id);
        $attributes = json_decode($productType->attributes, true);
        return response()->json($attributes);
    }
}