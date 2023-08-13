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


class SellerController extends Controller
{
public function index(Request $request, $domain, $category){
    // echo"<pre>";
    // print_r($request->business);die;
    $business = $request->business;
    $display_information = json_decode($request->business->display_information);
    $service_business = BusinessService::where('business_id', $business->id)->get();
    
    return view('view-seller.' .$category. '/' .$request->display_slug.  '.index', compact('business','display_information','service_business') );
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
    return view('view-seller.' .$category. '/' .$request->display_slug.  '.detail', compact('business','product','product_detail'));
}
}