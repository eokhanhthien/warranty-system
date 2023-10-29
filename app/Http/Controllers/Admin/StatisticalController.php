<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Customer;
use App\Staff;
use App\Order;
use App\Product;
use App\suppliers;
use Illuminate\Support\Facades\Auth;
use App\Charts\SampleChart;
use App\User;
use Illuminate\Support\Facades\DB;

class StatisticalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function statisticalOrder(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
    
        if ($startDate && $endDate) {
            $orders = Order::select(DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month"), DB::raw('count(*) as total'))
                ->where('business_id', auth()->user()->business_id)
                ->whereBetween('created_at', [$startDate, $endDate])
                ->groupBy('month')
                ->get();
            $revenue = Order::select(
                    DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month"),
                    DB::raw('sum(total_price) as total')
                )
                ->where('business_id', auth()->user()->business_id)
                ->whereBetween('created_at', [$startDate, $endDate])
                ->where('is_completed', 1)
                ->groupBy('month')
                ->get();

            $users = Staff::select(DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month"), DB::raw('count(*) as total'))
                ->where('business_id', auth()->user()->business_id)
                ->whereBetween('created_at', [$startDate, $endDate])
                ->groupBy('month')
                ->get();
    
            $customers = Customer::select(DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month"), DB::raw('count(*) as total'))
                ->where('business_id', auth()->user()->business_id)
                ->whereBetween('created_at', [$startDate, $endDate])
                ->groupBy('month')
                ->get();
    
            $products = Product::select(DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month"), DB::raw('count(*) as total'))
                ->where('business_id', auth()->user()->business_id)
                ->whereBetween('created_at', [$startDate, $endDate])
                ->groupBy('month')
                ->get();
        } else {
            $orders = Order::select(DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month"), DB::raw('count(*) as total'))
                ->where('business_id', auth()->user()->business_id)
                ->whereYear('created_at', date('Y'))
                ->groupBy('month')
                ->get();
            $revenue = Order::select(
                    DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month"),
                    DB::raw('SUM(total_price) as total')
                )
                ->where('business_id', auth()->user()->business_id)
                ->where('is_completed', 1)
                ->whereYear('created_at', date('Y'))
                ->groupBy('month')
                ->get();
                
            $users = Staff::select(DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month"), DB::raw('count(*) as total'))
                ->where('business_id', auth()->user()->business_id)
                ->whereYear('created_at', date('Y'))
                ->groupBy('month')
                ->get();
    
            $customers = Customer::select(DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month"), DB::raw('count(*) as total'))
                ->where('business_id', auth()->user()->business_id)
                ->whereYear('created_at', date('Y'))
                ->groupBy('month')
                ->get();
    
            $products = Product::select(DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month"), DB::raw('count(*) as total'))
                ->where('business_id', auth()->user()->business_id)
                ->whereYear('created_at', date('Y'))
                ->groupBy('month')
                ->get();
        }
    
        $chart = new SampleChart;
        $chart->labels($orders->pluck('month'));
        $chart->dataset('Đơn hàng', 'bar', $orders->pluck('total'))->options([
            'backgroundColor' => 'rgba(75, 192, 192, 0.2)',
            'borderColor' => 'rgba(75, 192, 192, 1)',
        ]);
        // $chart->dataset('Doanh thu', 'bar', $revenue->pluck('total'))->options([
        //     'backgroundColor' => 'rgba(75, 11, 22, 0.2)',
        //     'borderColor' => 'rgba(75, 11, 22, 1)',
        // ]);
        $chart->dataset('Nhân viên', 'bar', $users->pluck('total'))->options([
            'backgroundColor' => 'rgba(192, 75, 75, 0.2)',
            'borderColor' => 'rgba(192, 75, 75, 1)',
        ]);
        $chart->dataset('Khách hàng', 'bar', $customers->pluck('total'))->options([
            'backgroundColor' => 'rgba(75, 75, 192, 0.2)',
            'borderColor' => 'rgba(75, 75, 192, 1)',
        ]);
        $chart->dataset('Sản phẩm', 'bar', $products->pluck('total'))->options([
            'backgroundColor' => 'rgba(45, 45, 192, 0.2)',
            'borderColor' => 'rgba(45, 45, 192, 1)',
        ]);
    
        return view('admin.statistical.index', compact('chart'));
    }
    
    

  
}
