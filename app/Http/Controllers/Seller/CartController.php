<?php

namespace App\Http\Controllers\Seller;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Variant;
use App\Cart;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SelectOptionsController;


class CartController extends Controller
{
    public function showCart(Request $request, $domain, $category){
        $selectOptionsController = new SelectOptionsController();
        $selectOptions = $selectOptionsController->getAddressOptions();
        $provinces = $selectOptions->getData()['provinces'];
        $wards = $selectOptions->getData()['wards'];
        $districts = $selectOptions->getData()['districts'];

        $business = $request->business;
        $carts = Cart::where('customer_id', Auth::guard('customer')->user()->id)
        ->leftJoin('products', 'carts.product_id', '=', 'products.id')
        ->leftJoin('variants', 'carts.variant_id', '=', 'variants.id')
        ->select( 'carts.id','products.id as product_id','products.name','products.image', 'products.price','carts.quantity','variants.id as variant_id', 'variants.title_1', 'variants.title_1','variants.title_2','variants.value_1','variants.value_2','variants.price as variant_price')
        ->get();

        return view('view-seller.' .$category. '/' .$request->display_slug.  '.cart',compact('business','carts','provinces', 'wards', 'districts'));
    }

    public function addToCart(Request $request)
    {
        try {
            $productId = $request->input('product_id');
            $variantId = $request->input('variant_id');
            $quantity = $request->input('quantity');
    
            $existingCartItem = Cart::where('customer_id', Auth::guard('customer')->user()->id)
                ->where('product_id', $productId)
                ->where('variant_id', $variantId)
                ->first();
    
            if ($existingCartItem) {
                // Sản phẩm đã có trong giỏ hàng, cập nhật lại quantity
                $existingCartItem->quantity += $quantity;
                $existingCartItem->save();
            } else {
                // Sản phẩm chưa có trong giỏ hàng, tạo mới mục giỏ hàng
                $cart = new Cart();
                $cart->customer_id = Auth::guard('customer')->user()->id;
                $cart->product_id = $productId;
                $cart->variant_id = $variantId;
                $cart->quantity = $quantity;
                $cart->save();
            }
    
            return response()->json(['success' => '1','message' => 'Sản phẩm đã được thêm vào giỏ hàng']);
        } catch (\Throwable $th) {
            return response()->json(['success' => '0','message' => 'Bạn chưa đăng nhập']);
        }
    }
    

    public function deletefromCart(Request $request, $domain, $category, $id)
    {
        $cart = Cart::find($id);
        $cart->delete();
        return redirect()->back()->with('success', 'Xóa sản phẩm thành công');
    }

    public function updateQuantity(Request $request)
    {
        $cart = Cart::find($request->id);

        if ($cart) {
            $cart->quantity = $request->quantity;
            $cart->save();

            $total_price = 0;
            $carts = Cart::where('customer_id', Auth::guard('customer')->user()->id)
            ->leftJoin('products', 'carts.product_id', '=', 'products.id')
            ->leftJoin('variants', 'carts.variant_id', '=', 'variants.id')
            ->select( 'carts.id','products.id as product_id','products.name','products.image', 'products.price','carts.quantity','variants.id as variant_id', 'variants.title_1', 'variants.title_1','variants.title_2','variants.value_1','variants.value_2','variants.price as variant_price')
            ->get();

            foreach($carts as $cart) {
                if (!empty($cart->title_1) && !empty($cart->value_1) || !empty($cart->title_2) && !empty($cart->value_2)) {
                    $total_price += $cart->variant_price * $cart->quantity;
                } else {
                    $total_price += $cart->price * $cart->quantity;
                }
            }
            return response()->json(['success' => 1,'message' => 'Số lượng đã được cập nhật thành công.','data'=> $total_price]);
        }

        return response()->json(['success' => 0,'message' => 'cập nhật thất bại']);
    }
}