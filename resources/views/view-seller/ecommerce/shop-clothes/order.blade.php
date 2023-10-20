@extends('view-seller.ecommerce.shop-clothes.layout.layout')
@section('content')
<div class="container-xxl py-5" style="margin-top: 70px;">
    <div class="container">
   
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex justify-content-between align-items-center activity">
                    <div><span class="activity-done">Tất cả đơn hàng</span></div>
          
                </div>
                <div class="mt-3">
                    <ul class="list list-inline">

                    @foreach($orders as $order)
                    <a  href="{{ route('seller.get.detail.order', ['domain' => request()->segment(2), 'category_slug' => request()->segment(3),'id' =>  $order->id]) }}">
                        <li class="d-flex justify-content-between">
                            <div class="d-flex flex-row align-items-center"><i class="fa fa-check-circle checkicon"></i>
                                <div class="ml-2">
                                    <h6 class="mb-0">Mã đơn: {{$order->order_code}}</h6>
                                    <div class="d-flex flex-row mt-1 text-black-50 date-time">
                                        <div><i class="fa fa-calendar-o"></i><span class="ml-2">{{$order->created_at}}</span></div>
                                        <p class="mb-2">Trạng thái <span class="text-primary font-weight-bold">: 
                                        @if( $order->status == 'pending')
                                            Chưa xác nhận <i class="fa fa-clock-o text-success" aria-hidden="true"></i>                    
                                        @elseif( $order->status == 'preparing')
                                            Đang chuẩn bị hàng <i class="fa fa-clock-o text-success" aria-hidden="true"></i>
                                        @elseif( $order->status == 'delivering')
                                            Đang giao <i class="fa fa-truck text-success" aria-hidden="true"></i>
                                        @elseif( $order->status == 'delivered')
                                            Đã giao <i class="fas fa-check-circle text-success"></i>
                                        @elseif( $order->status == 'denied')
                                            Từ chối <i class="fas fa-times-circle text-danger"></i>
                                        @endif
                                        </span></p>
                                        <!-- <div class="ml-3"><i class="fa fa-clock-o"></i><span class="ml-2">6h</span></div> -->
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-row align-items-center">
                                <div class="d-flex flex-column mr-2">
                                    
                                <i
                                    class="fa fa-ellipsis-h">
                                </i>
                            </div>
                        </li>
                        </a>
                    @endforeach

                    </ul>
                </div>
            </div>
        </div>
    </div>

    </div>
</div>

<style>
    .icons i {
  color: #b5b3b3;
  border: 1px solid #b5b3b3;
  padding: 6px;
  margin-left: 4px;
  border-radius: 5px;
  cursor: pointer;
}

.activity-done {
  font-weight: 600;
}

.list-group li {
  margin-bottom: 12px;
}

.list-group-item {
}

.list li {
  list-style: none;
  padding: 10px;
  border: 1px solid #e3dada;
  margin-top: 12px;
  border-radius: 5px;
  background: #fff;
}

.checkicon {
  color: green;
  font-size: 19px;
}

.date-time {
  font-size: 12px;
}

.profile-image img {
  margin-left: 3px;
}
i.fa.fa-check-circle.checkicon {
    margin-right: 20px;
}
</style>
@endsection