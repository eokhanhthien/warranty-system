<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Business;
use App\BusinessService;


use App\ProductCategory;
use App\ProductSubcategory;
use App\ProductType;
use App\Product;
use App\ProductDetail;
use App\Variant;
use App\DiscountCode;
use App\Http\Controllers\SelectOptionsController;
use App\Supplier;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UploadDriverColtroller;

class SupplierController extends Controller
{
    public function index(Request $request){
  
        // Thêm address
        $selectOptionsController = new SelectOptionsController();
        $selectOptions = $selectOptionsController->getAddressOptions();
        $provinces = $selectOptions->getData()['provinces'];
        $wards = $selectOptions->getData()['wards'];
        $districts = $selectOptions->getData()['districts'];

        $suppliers =  Supplier::where('business_id', auth()->user()->business_id)->get();
        $categories = ProductCategory::where('business_id', Auth::user()->business_id)->get();
        $sub_categories = ProductSubcategory::where('business_id', Auth::user()->business_id)->get();
        $product_types = ProductType::get();

        return view('admin.supplier.index',compact('suppliers','districts','wards','provinces', ));
    }

    public function create()
    {
        return view('admin.business.service.create');
    }

    public function store(Request $request)
    {
        $addressArray = [
            'province' => $request->province,
            'district' => $request->district,
            'ward' => $request->ward
        ];
        
        $addressJson = json_encode($addressArray);

        $supplier = new Supplier();
        $supplier->name = $request->name;
        $supplier->email = $request->email;
        $supplier->phone_number = $request->phone_number;
        $supplier->address = $addressJson;
        $supplier->business_id = auth()->user()->business_id;
        $supplier->save();

        return redirect()->back()->with('success', 'Thêm mới nhà cung cấp thành công.');
    }

    public function show(BusinessService $businessService)
    {
        dd(123);
        // return view('admin.business.service.show', compact('businessService'));
    }

    public function edit($id)
    {        
        // Thêm address
        $selectOptionsController = new SelectOptionsController();
        $selectOptions = $selectOptionsController->getAddressOptions();
        $provinces = $selectOptions->getData()['provinces'];
        $wards = $selectOptions->getData()['wards'];
        $districts = $selectOptions->getData()['districts'];

        $supplier = Supplier::find($id);
        // dd( $variant);
        return view('admin.supplier.edit',compact('supplier','provinces','wards','districts'));
    }

    public function update(Request $request,$id)
    {
        $addressArray = [
            'province' => $request->province,
            'district' => $request->district,
            'ward' => $request->ward
        ];
        
        $addressJson = json_encode($addressArray);

        $supplier =  Supplier::find($id);
        $supplier->name = $request->name;
        $supplier->email = $request->email;
        $supplier->phone_number = $request->phone_number;
        $supplier->address = $addressJson;
        $supplier->business_id = auth()->user()->business_id;
        $supplier->save();

        return redirect()->back()->with('success', 'Cập nhật thành công.');
    }
    

    public function destroy($id)
    {  
        $supplier =  Supplier::find($id);
        $supplier->delete();
        
        return redirect()->back()->with('success', 'Xóa nhà cung cấp thành công.');
    }


    public function getAttributes($id)
    {
        $productType = ProductType::findOrFail($id);
        $attributes = json_decode($productType->attributes, true);
        return response()->json($attributes);
    }

    public function updateQuantity(Request $request)
    {
        $product = Product::find($request->id);

        if ($product) {
            $product->stock = $request->quantity;
            $product->save();
            
            return response()->json(['success' => 1,'message' => 'Cập nhật kho thành công.']);
        }

        return response()->json(['success' => 0,'message' => 'cập nhật thất bại']);
    }

    public function getDiscount(){
        $discount_codes =  DiscountCode::where('business_id', auth()->user()->business_id)->get();
        return view('admin.product_business.discount', compact('discount_codes'));
    }

    public function createDiscount(Request $request){
        // dd($request->all());
        $discount_code = new DiscountCode();
        $discount_code->name = $request->name;
        $discount_code->code = $request->code;
        $discount_code->amount = $request->amount;
        $discount_code->start_at = $request->start_at;
        $discount_code->expires_at = $request->expires_at;
        $discount_code->business_id = auth()->user()->business_id;
        $discount_code->save();
        return redirect()->back()->with('success', 'Tạo mã giảm giá thành công.');

    }

    public function updateDiscount(Request $request,$id){
        $discount_code = DiscountCode::find($id);
        $discount_code->name = $request->name;
        $discount_code->code = $request->code;
        $discount_code->amount = $request->amount;
        $discount_code->start_at = $request->start_at;
        $discount_code->expires_at = $request->expires_at;
        $discount_code->business_id = auth()->user()->business_id;
        $discount_code->save();
        return redirect()->back()->with('success', 'Cập nhật mã giảm giá thành công.');

    }

    public function deleteDiscount(Request $request,$id){
        $discount_code = DiscountCode::find($id);
        $discount_code->delete();
        return redirect()->back()->with('success', 'Xóa mã giảm giá thành công.');
    }
}