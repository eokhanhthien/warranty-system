<?php

namespace App\Http\Controllers\Seller;
use App\Http\Controllers\Controller;
use App\Business;
use App\BusinessCategory;
use App\BusinessService;
use Illuminate\Http\Request;
use App\Product;
use App\ProductDetail;
use App\ProductCategory;
use App\ProductSubcategory;
use App\Variant;
use App\Customer;
use App\ProductType;
use App\Http\Controllers\SelectOptionsController;
use Illuminate\Support\Facades\Auth;

class SellerController extends Controller
{
public function index(Request $request, $domain, $category){
    // echo"<pre>";
    // print_r($request->business);die;
    $business = $request->business;
    $display_information = json_decode($request->business->display_information);
    $service_business = BusinessService::where('business_id', $business->id)->get();
    $products = Product::where('business_id', $business->id)->take(16)->get();
    return view('view-seller.' .$category. '/' .$request->display_slug.  '.index', compact('business','display_information','service_business', 'products', ) );
}

public function all_product(Request $request, $domain, $category)
{
    $business = $request->business;
    $paginationLimit = 16;

    // Lấy danh sách sản phẩm với phân trang
    $productsQuery = Product::where('business_id', $business->id);

    // Lọc theo subcategories nếu có
    $subcategories = $request->subcategories;

    // Kiểm tra và đưa biến $subcategories về mảng nếu không phải là mảng
    if (!is_array($subcategories)) {
        $subcategories = [];
    }

    // Loại bỏ các giá trị null và rỗng trong mảng subcategories
    $subcategories = array_filter($subcategories, function ($item) {
        return $item !== null;
    });

    // Nếu có subcategories được chọn, thêm điều kiện vào query
    if (!empty($subcategories)) {
        $productsQuery->whereIn('subcategory_id', $subcategories);
    }

    // Sắp xếp sản phẩm nếu có tùy chọn
    $sortOption = $request->sort_by;
    switch ($sortOption) {
        case 'price_asc':
            $productsQuery->orderBy('price', 'asc');
            break;
        case 'price_desc':
            $productsQuery->orderBy('price', 'desc');
            break;
        case 'date_asc':
            $productsQuery->orderBy('created_at', 'asc');
            break;
        case 'date_desc':
        default:
            $productsQuery->orderBy('created_at', 'desc');
            break;
    }

    // Lấy dữ liệu phân trang
    $products = $productsQuery->paginate($paginationLimit);

    if ($request->ajax()) {
        return response()->json([
            'pagination' => view('view-seller.' . $category . '/' . $request->display_slug . '.pagination', compact('products'))->render(),
            'data' => view('view-seller.' . $category . '/' . $request->display_slug . '.list_product', compact('products'))->render()
        ]);
    }

    $product_categories = ProductCategory::where('business_id', $business->id)->get();
    $product_subcategories = ProductSubcategory::where('business_id', $business->id)->get();

    $display_slug = $request->display_slug;
    $category_slug = $category;
    $display_information = json_decode($request->business->display_information);

    return view('view-seller.' . $category . '/' . $request->display_slug . '.all_product', compact('business', 'products', 'product_categories', 'product_subcategories', 'category_slug', 'display_slug','display_information'));
}



public function detail(Request $request, $domain, $category , $id){
    $business = $request->business;
    $product =  Product::find($id);
    $product_detail =  ProductDetail::where('product_id', $id)->first();
    $variant = Variant::where('product_id' , $product->id)->get();
    $product_attribute = json_decode($product_detail->attributes, true);
    $product_type = ProductType::find($product->attribute_id); 
    $attributes = !empty($product_type) ? json_decode($product_type->attributes, true) : '';
    // dd($attributes);
    return view('view-seller.' .$category. '/' .$request->display_slug.  '.detail', compact('business','product','product_detail','variant','product_attribute','attributes'));
}

public function Service(Request $request, $domain, $category ){
    $business = $request->business;
    $service_business = BusinessService::where('business_id', $business->id)->get();

    return view('view-seller.' .$category. '/' .$request->display_slug.  '.service', compact('business','service_business'));
}

public function getProfile(Request $request, $domain, $category )  {
    $business = $request->business;
    $service_business = BusinessService::where('business_id', $business->id)->get();
    // Thêm address
    $selectOptionsController = new SelectOptionsController();
    $selectOptions = $selectOptionsController->getAddressOptions();
    $provinces = $selectOptions->getData()['provinces'];
    $wards = $selectOptions->getData()['wards'];
    $districts = $selectOptions->getData()['districts'];
    return view('view-seller.' .$category. '/' .$request->display_slug.  '.profile', compact('business','service_business','provinces','wards','districts'));
}

public function postProfile(Request $request, $domain, $category){
    $data = $request->all();
    
    $user = Customer::findOrFail(Auth::guard('customer')->user()->id);
    
    $addressArray = [
        'province' => $data['province'],
        'district' => $data['district'],
        'ward' => $data['ward']
    ];
    
    $addressJson = json_encode($addressArray);

    // Update user data
    $user->full_name = $data['full_name'];
    // if(!empty($data['password'])){
    //     $user->password = bcrypt($data['password']);
    // }else{
    //     $user->password = $user->password;
    // }
    $user->phone_number = $data['phone_number'];
    // $user->status = 1;
    // $user->gender = $data['gender'];
    $user->birth_date = $data['birth_date'];
    $user->address = $addressJson;

    $user->save();

    // Redirect or return a response
    return redirect()->back()->with('success', 'Cập nhật thông tin thành công');
}

public function requestRepair(Request $request, $domain, $category){
    $business = $request->business;
    $business_service =  BusinessService::where('business_id', $business->id)->get();

    return view('view-seller.' .$category. '/' .$request->display_slug.  '.request_repair',compact('business','business_service'));
}
}