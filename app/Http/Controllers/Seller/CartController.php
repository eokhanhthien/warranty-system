<?php

namespace App\Http\Controllers\Seller;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Variant;
use App\Cart;
use App\Order;
use App\OrderItem;
use App\DiscountCode;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SelectOptionsController;
use Illuminate\Support\Str;
use Carbon\Carbon;

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

        $total_price = $this->calculateTotalPrice();
        session(['total_cart' => $total_price]);

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
            $total_price = $this->calculateTotalPrice();
            session(['total_cart' => $total_price]);
    
            return response()->json(['success' => '1','message' => 'Sản phẩm đã được thêm vào giỏ hàng']);
        } catch (\Throwable $th) {
            return response()->json(['success' => '0','message' => 'Bạn chưa đăng nhập']);
        }
    }
    

    public function deletefromCart(Request $request, $domain, $category, $id)
    {
        $cart = Cart::find($id);
        $cart->delete();
        $total_price = $this->calculateTotalPrice();

        session(['total_cart' => $total_price]);
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

            $total_price = $this->calculateTotalPrice();
            session(['total_cart' => $total_price]);

            $partialView = view('view-seller.repair-system.repair-system.cart_total')->render(); // Thay 'partials.total' bằng đường dẫn thực tế đến phần view bạn muốn render
            return $partialView;
        }

        return response()->json(['success' => 0,'message' => 'cập nhật thất bại']);
    }

    public function checkDiscount(Request $request){
        $discount = DiscountCode::where('code',$request->code)->first();
        
        if ($discount) {
            $now = now(); // Thời gian hiện tại
            $startAt = $discount->start_at;
            $endAt = $discount->expires_at;
            if ($now >= $startAt && $now <= $endAt) {
                session(['discount_amount' => $discount->amount , 'code' => $request->code]);
                $partialView = view('view-seller.repair-system.repair-system.cart_total')->render(); // Thay 'partials.total' bằng đường dẫn thực tế đến phần view bạn muốn render
                return $partialView;
            } else {
                session()->forget(['discount_amount', 'code']);
                $partialView = view('view-seller.repair-system.repair-system.cart_total')->render(); // Thay 'partials.total' bằng đường dẫn thực tế đến phần view bạn muốn render
                return $partialView;
            }
        } else {
            session()->forget(['discount_amount', 'code']);
            $partialView = view('view-seller.repair-system.repair-system.cart_total')->render(); // Thay 'partials.total' bằng đường dẫn thực tế đến phần view bạn muốn render
            return $partialView;
        }
    }

    public function destroyDiscount(){
            session()->forget(['discount_amount', 'code']);
            $partialView = view('view-seller.repair-system.repair-system.cart_total')->render(); 
            return $partialView;
    }

    function calculateTotalPrice() {
        $total_price = 0;
    
        $carts = Cart::where('customer_id', Auth::guard('customer')->user()->id)
        ->leftJoin('products', 'carts.product_id', '=', 'products.id')
        ->leftJoin('variants', 'carts.variant_id', '=', 'variants.id')
        ->select( 'carts.id','products.id as product_id','products.name','products.image', 'products.price','carts.quantity','variants.id as variant_id', 'variants.title_1', 'variants.title_1','variants.title_2','variants.value_1','variants.value_2','variants.price as variant_price')
        ->get();


        foreach ($carts as $cart) {
            if (!empty($cart->title_1) && !empty($cart->value_1) || !empty($cart->title_2) && !empty($cart->value_2)) {
                $total_price += $cart->variant_price * $cart->quantity;
            } else {
                $total_price += $cart->price * $cart->quantity;
            }
        }
    
        return $total_price;
    }

    public function Order(Request $request){
        $order = new Order();
        $order->customer_id = Auth::guard('customer')->user()->id;
        $randomString = Str::random(5);
        $order->order_code = $randomString;
        $order->order_date = Carbon::now();
        $order->status = 'pendding';
        $order->is_completed = 0;
        $order->name = $request->name;
        $order->phone_number = $request->phone_number;
        $order->email = $request->email;
        $order->province = $request->province;
        $order->district = $request->district;
        $order->ward = $request->ward;
        $order->note = $request->note ? $request->note : 'Không có lưu ý';
        $order->pay_method = $request->pay_method;
        $order->pay_method = $request->pay_method;
        $order->discount_code = $request->discount_code;
        $order->total_price = $request->total_price;
        $order->save();

        $carts = Cart::where('customer_id', Auth::guard('customer')->user()->id)
        ->leftJoin('products', 'carts.product_id', '=', 'products.id')
        ->leftJoin('variants', 'carts.variant_id', '=', 'variants.id')
        ->select( 'carts.id','products.id as product_id','products.name','products.image', 'products.price','carts.quantity','variants.id as variant_id', 'variants.title_1', 'variants.title_1','variants.title_2','variants.value_1','variants.value_2','variants.price as variant_price')
        ->get();


        foreach ($carts as $cart) {
            $order_items = new OrderItem();
            $order_items->customer_id = Auth::guard('customer')->user()->id;
            $order_items->order_id = $order->id;
            $order_items->product_id = $cart->product_id; 
            $order_items->variant_id = $cart->variant_id; 
            $order_items->quantity = $cart->quantity;
            $order_items->save();
        }

        return redirect()->back()->with('success', 'Đặt hàng thành công');
    }
}