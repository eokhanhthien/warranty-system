<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use App\Business;
use App\BusinessCategory;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\SelectOptionsController;
use Illuminate\Support\Facades\Validator;

class BusinessesController extends Controller
{
    public function index()
    {
        $selectOptionsController = new SelectOptionsController();
        $selectOptions = $selectOptionsController->getAddressOptions();
        $provinces = $selectOptions->getData()['provinces'];
        $wards = $selectOptions->getData()['wards'];
        $districts = $selectOptions->getData()['districts'];
        $business_category = BusinessCategory::all();
        $owners = User::join('businesses', 'users.id', '=', 'businesses.owner_id')
            ->select('users.*')
            ->get();

        $users = User::whereNotIn('id', $owners->pluck('id'))
            ->where('users.role', '2')
            ->where('users.status', '1')
            ->select('users.*')
            ->get();
        $businesses = Business::all();
        return view('superadmin.businesses.index', compact('provinces', 'wards', 'districts','businesses','business_category','owners','users'));
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
        $business->owner_id = $request->owner_id;
        $business->save();

        iF(!empty($request->owner_id)){
            $user = User::find($request->owner_id);
            $user->business_id = $business->id;
            $user->save();
        }

        // Redirect or return a response
        return redirect()->back()->with('success', 'Thêm doanh nghiệp thành công');
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
        $business_category = BusinessCategory::all();
        $owners = User::join('businesses', 'users.id', '=', 'businesses.owner_id')
            ->select('users.*')
            ->get();

        $users = User::whereNotIn('id', $owners->pluck('id'))
            ->where('users.role', '2')
            ->where('users.status', '1')
            ->select('users.*')
            ->get();

        return view('superadmin.businesses.edit',compact('id','provinces', 'wards', 'districts','businesses','business_category','owners','users'));
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
        $business->domain = $request->domain;
        $business->phone_number = $request->phone_number;
        $business->business_category_id = $request->business_category_id;   
        $business->address = $addressJson;
        $business->owner_id = $request->owner_id;
        $business->save();

        iF(!empty($request->owner_id)){
            $user = User::find($request->owner_id);
            $user->business_id = $business->id;
            $user->save();
        }
        // Redirect or return a response
        return redirect()->back()->with('success', 'Cập nhật doanh nghiệp thành công');
    }

    public function destroy($id)
    {
        $business = Business::findOrFail($id);
        $business->delete();
        // Redirect or return a response
        return redirect()->back()->with('success', 'Xóa doanh nghiệp thành công');
    }

}
