<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Business;
use App\BusinessService;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UploadDriverColtroller;
use App\Order;
use App\OrderItem;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function index(Request $request){
        $orders = Order::where('business_id', auth()->user()->business_id)->get();
        $pending = Order::where('business_id', auth()->user()->business_id)->where('status', 'pending')->count();
        $preparing = Order::where('business_id', auth()->user()->business_id)->where('status', 'preparing')->count();
        $delivering = Order::where('business_id', auth()->user()->business_id)->where('status', 'delivering')->count();
        $delivered = Order::where('business_id', auth()->user()->business_id)->where('status', 'delivered')->count();
        $denied = Order::where('business_id', auth()->user()->business_id)->where('status', 'denied')->count();

        return view('admin.order.index', compact('orders','pending','preparing','delivering','delivered','denied'));
    }

    public function pendingOrder(Request $request){
        $orders = Order::where('business_id', auth()->user()->business_id)->where('status', 'pending')->get();
        return view('admin.order.pending', compact('orders'));
    }

    public function preparingOrder(Request $request){
        $orders = Order::where('business_id', auth()->user()->business_id)->where('status', 'preparing')->get();
        return view('admin.order.preparing', compact('orders'));
    }

    public function deliveringOrder(Request $request){
        $orders = Order::where('business_id', auth()->user()->business_id)->where('status', 'delivering')->get();
        return view('admin.order.delivering', compact('orders'));
    }

    public function deliveredOrder(Request $request){
        $orders = Order::where('business_id', auth()->user()->business_id)->where('status', 'delivered')->get();
        return view('admin.order.delivered', compact('orders'));
    }

    public function getDeniedOrder(Request $request){
        $orders = Order::where('business_id', auth()->user()->business_id)->where('status', 'denied')->get();
        return view('admin.order.denied', compact('orders'));
    }


    public function create()
    {
        return view('admin.business.service.create');
    }

    public function store(Request $request)
    {

    }

    public function show(BusinessService $businessService)
    {

    }

    public function edit(BusinessService $businessService)
    {

    }

    public function update(Request $request, BusinessService $businessService)
    {

    }
    

    public function destroy(BusinessService $businessService)
    {

    }


    public function confirmOrder(Request $request, $id){
        $order = Order::find($id);
        $order->status = 'preparing';
        $order->save();
        return redirect()->back()->with('success', 'Xác nhận thành công');
    }

    public function deniedOrder(Request $request, $id){
        $order = Order::find($id);
        $order->status = 'denied';
        $order->save();
        return redirect()->back()->with('success', 'Từ chối thành công');
    }

    public function donePreparingOrder(Request $request, $id){
        $order = Order::find($id);
        $order->status = 'delivering';
        $order->shipping_method = $request->shipping_method;
        $currentDate = Carbon::now();
        $order->sent_date = $currentDate;
        $order->expected_receipt_date = $currentDate->copy()->addDays(4);
        $order->save();
        return redirect()->back()->with('success', 'Xác nhận đang giao');
    }
    public function doneDeliveredOrder(Request $request, $id){
        $order = Order::find($id);
        $order->status = 'delivered';
        $order->is_completed = 1;
        $order->save();
        return redirect()->back()->with('success', 'Xác nhận đã giao');
    }

    public function donePay(Request $request, $id){
        $order = Order::find($id);
        $order->is_completed = 1;
        $order->save();
        return redirect()->back()->with('success', 'Thành công');
    }

    public function detailOrder(Request $request, $id){
        $order = Order::find($id);
        $items = OrderItem::where('order_id',$id )->get();
        // $gateway =  TransferGateway::where('business_id', Auth::user()->business_id)->first();
        return view('admin.order.detail', compact('order','items'));

    }
}