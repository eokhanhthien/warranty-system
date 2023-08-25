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


class CartController extends Controller
{

    public function addToCart(Request $request)
    {
        dd( $request->all());
        $productId = $request->input('product_id');
        $variantId = $request->input('variant_id');

        // Logic để thêm sản phẩm vào giỏ hàng dựa trên $productId và $variantId

        return response()->json(['message' => 'Sản phẩm đã được thêm vào giỏ hàng']);
    }

}