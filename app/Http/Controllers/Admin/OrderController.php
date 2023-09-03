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


class OrderController extends Controller
{
    public function index(Request $request){
        $orders = Order::where('business_id', auth()->user()->business_id)->get();
        return view('admin.order.index', compact('orders'));
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
        $order->save();
        return redirect()->back()->with('success', 'Xác nhận đang giao');
    }
    public function doneDeliveredOrder(Request $request, $id){
        $order = Order::find($id);
        $order->status = 'delivered';
        $order->save();
        return redirect()->back()->with('success', 'Xác nhận đã giao');
    }
}