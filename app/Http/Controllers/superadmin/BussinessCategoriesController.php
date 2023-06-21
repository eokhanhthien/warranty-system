<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use App\BusinessCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\SelectOptionsController;
use Illuminate\Support\Facades\Validator;

class BussinessCategoriesController extends Controller
{
    public function index()
    {

        $bussinessCategories = BusinessCategory::paginate(10);
        return view('superadmin.bussiness_categories.index', compact('bussinessCategories'));
    }

    public function create()
    {
        // Trả về view để hiển thị form tạo doanh nghiệp
        // return view('superadmin.businesses.create');
    }
    public function show($id)
    {
 
    }
    public function store(Request $request)
    {
        $addressArray = [
            'province' => $request->province,
            'district' => $request->district,
            'ward' => $request->ward
        ];
        
        $addressJson = json_encode($addressArray);
        // Create the user
        $business = new Business();
        $business->name = $request->name;
        $business->domain = $request->domain;
        $business->email = $request->email;
        $business->phone_number = $request->phone_number;
        $business->business_category_id = $request->business_category_id;   
        $business->address = $addressJson;
        $business->save();

        // Redirect or return a response
        return redirect()->back()->with('success', 'Business added successfully');
    }

    public function edit($id)
    {
        // Thêm address
        $selectOptionsController = new SelectOptionsController();
        $selectOptions = $selectOptionsController->getAddressOptions();
        $provinces = $selectOptions->getData()['provinces'];
        $wards = $selectOptions->getData()['wards'];
        $districts = $selectOptions->getData()['districts'];
        $businesses = Business::findOrFail($id);

        return view('superadmin.businesses.edit',compact('id','provinces', 'wards', 'districts','businesses',));
    }

    public function update(Request $request, $id)
    {

        $business = Business::findOrFail($id);
        $addressArray = [
            'province' => $request->province,
            'district' => $request->district,
            'ward' => $request->ward
        ];
        
        $addressJson = json_encode($addressArray);
        // Create the user
        $business->name = $request->name;
        $business->email = $request->email;
        $business->phone_number = $request->phone_number;
        $business->business_category_id = $request->business_category_id;   
        $business->address = $addressJson;
        $business->save();

        // Redirect or return a response
        return redirect()->back()->with('success', 'Business updated successfully');
    }

    public function destroy($id)
    {
        $business = Business::findOrFail($id);
        $business->delete();
        // Redirect or return a response
        return redirect()->back()->with('success', 'Business deleted successfully');
    }

}
