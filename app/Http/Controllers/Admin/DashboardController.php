<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Business;
use App\BusinessCategory;
use Illuminate\Support\Facades\Auth;
use App\Product;
use App\BusinessService;
use App\Order;
use App\OrderItem;
use App\Customer;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request){
        $baseUrl = $request->getSchemeAndHttpHost();
        $businesses = Business::where('owner_id', Auth::user()->id)
        ->join('business_categories', 'businesses.business_category_id', '=', 'business_categories.id')
        ->select('businesses.domain', 'business_categories.slug')
        ->first();
        
        $display = Business::where('owner_id', Auth::user()->id )
        ->join('business_displays', 'businesses.business_display_id', '=', 'business_displays.id')
        ->select('business_displays.slug as display_slug')
        ->first();
        $businesses->display = $display->display_slug;

        $request->session()->put('businesses', $businesses);
        
        $domain =  $baseUrl . '/artisq/' . $businesses->domain . '/' . $businesses->slug;
        $request->session()->put('domain', $domain);

        // Thống kê
        $countProducts =  Product::where('business_id', auth()->user()->business_id)->count();
        $countService =  BusinessService::where('business_id', auth()->user()->business_id)->count();
        $countOrders = Order::where('business_id', auth()->user()->business_id)->count();
        $countCustomers = Customer::where('business_id', auth()->user()->business_id)->count();
        $countOrderItem = OrderItem::join('orders', 'order_items.order_id', '=', 'orders.id')
        ->where('orders.business_id', Auth::user()->business_id)
        ->count();
        $totalPrice = Order::where('business_id', auth()->user()->business_id)->where('is_completed', 1)->sum('total_price');
        $topSellingItems = OrderItem::join('orders', 'order_items.order_id', '=', 'orders.id')
        ->where('orders.business_id', Auth::user()->business_id)
        ->where('orders.is_completed', 1)
        ->select('order_items.product_id', DB::raw('SUM(order_items.quantity) as total_quantity'))
        ->groupBy('order_items.product_id')
        ->orderBy('total_quantity', 'desc')
        ->get();

        // Lấy năm hiện tại
        $currentYear = date('Y');

        // Lấy năm từ 4 năm trước đến hiện tại
        $years = range($currentYear - 4, $currentYear);

        $data = [];

        foreach ($years as $year) {
        // Truy vấn cơ sở dữ liệu để lấy tổng số tiền theo tháng cho năm hiện tại
        $monthlyTotal = Order::select(DB::raw('MONTH(created_at) as month'), DB::raw('SUM(total_price) as total'))
            ->where('business_id', auth()->user()->business_id)
            ->where('is_completed', 1)
            ->whereYear('created_at', $year)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->pluck('total', 'month')
            ->toArray();

        // Tạo mảng data cho năm này
        $yearData = [
            'name' => (string) $year,
            'data' => array_fill(1, 12, 0), // Khởi tạo mảng 12 tháng với giá trị ban đầu là 0
        ];

        // Cập nhật giá trị tháng theo kết quả từ truy vấn
        foreach ($monthlyTotal as $month => $total) {
            $yearData['data'][$month] = (float) $total;
        }

        $data[] = $yearData;
        }
        $priceData = $data;
        // dd($priceData);

        return view('admin.dashboard', compact('domain','countProducts','countService','countOrders','totalPrice','countCustomers','priceData','countOrderItem','topSellingItems'));
    }

}