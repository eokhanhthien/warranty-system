@extends('view-seller.repair-system.repair-system.layout.layout')
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
<div class="container-xxl py-5" style="margin-top: 70px;">
    <div class="container">
   
    <div class="container padding-bottom-3x mb-1 p-0">
        @if( $order->status != 'cancel'|| $order->status == 'return')   
        <div class="card mb-3 ">
          <div class="p-4 text-center text-white text-lg bg-dark rounded-top"><span class="text-uppercase">Đơn hàng - </span><span class="text-medium">{{$order->order_code}}</span></div>
          <div class="d-flex flex-wrap flex-sm-nowrap justify-content-between py-3 px-2 bg-secondary">
            <div class="w-100 text-center py-1 px-2"><span class="text-medium">Phương thức thanh toán:</span> {{ $order->pay_method  == 'POD' ? 'Thanh toán chuyển khoản' : 'Thanh toán khi nhận hàng'}}</div>
            <div class="w-100 text-center py-1 px-2"><span class="text-medium">Trạng thái:</span> 
            @if( $order->status == 'pending')
                    Chưa xác nhận                     
                @elseif( $order->status == 'preparing')
                    Đang chuẩn bị hàng
                @elseif( $order->status == 'delivering')
                    Đang giao <i class="fa fa-truck text-success" aria-hidden="true"></i>
                @elseif( $order->status == 'delivered')
                    Đã giao <i class="fas fa-check-circle text-success"></i>
                @elseif( $order->status == 'denied')
                    Từ chối <i class="fas fa-times-circle text-danger"></i>
                @elseif( $order->status == 'cancel')  
                    Đã hủy 
                @elseif( $order->status == 'return')  
                    Yêu cầu hoàn trả
                @endif
            </div>
            <div class="w-100 text-center py-1 px-2"><span class="text-medium">Ngày đặt:</span> {{$order->created_at}}</div>
            <div class="w-100 text-center py-1 px-2"><span class="text-medium">Ngày nhận dự kiến:</span> {{$order->expected_receipt_date}}</div>
          </div>
          <div class="card-body">
            <div class="steps d-flex flex-wrap flex-sm-nowrap justify-content-between padding-top-2x padding-bottom-1x">
              <div class="step  {{$order->status == 'return'|| $order->status == 'pending'||$order->status == 'preparing'  || $order->status == 'delivering' ||$order->status == 'delivered' ? 'completed' : '' }}">
                <div class="step-icon-wrap">
                  <div class="step-icon"><i class="pe-7s-cart"></i></div>
                </div>
                <h4 class="step-title">Đơn hàng đã đặt</h4>
              </div>
              <div class="step {{ $order->status == 'return'|| $order->status != 'pending'|| $order->status == 'preparing'  || $order->status == 'delivering' ||$order->status == 'delivered'  ? 'completed' : '' }}">
                <div class="step-icon-wrap">
                  <div class="step-icon"><i class="pe-7s-config"></i></div>
                </div>
                <h4 class="step-title">Đơn hàng đã xác nhận</h4>
              </div>
              <div class="step  {{ $order->status == 'return'|| $order->status == 'preparing'  || $order->status == 'delivering' ||$order->status == 'delivered'  ? 'completed' : '' }}">
                <div class="step-icon-wrap">
                  <div class="step-icon"><i class="pe-7s-medal"></i></div>
                </div>
                <h4 class="step-title">Đang chuẩn bị</h4>
              </div>
              <div class="step {{ $order->status == 'return'|| $order->status == 'delivering' ||$order->status == 'delivered'  ? 'completed' : '' }}">
                <div class="step-icon-wrap">
                  <div class="step-icon"><i class="pe-7s-car"></i></div>
                </div>
                <h4 class="step-title">Đang giao</h4>
              </div>
              <div class="step {{$order->status == 'return'|| $order->status == 'delivered'  ? 'completed' : '' }}">
                <div class="step-icon-wrap">
                  <div class="step-icon"><i class="pe-7s-home"></i></div>
                </div>
                <h4 class="step-title">Đã giao</h4>
              </div>
            </div>
          </div>
        </div>
        @else
        <h5 class="text-danger">Đơn hàng đã bị hủy</h5>   
        @endif
      </div>


        <div class="card card-stepper text-black" style="border-radius: 16px;">

          <div class="card-body p-5">

      <div class="row mt-5">
      <h5>Danh sách sản phẩm</h5>

         <div class="col-sm-6">
           
            <div class="list list-row block">
                @foreach($items as $item)
              
               <div class="list-item" data-id="19">
                  <div><a href="#" data-abc="true"><img  class="" src="https://drive.google.com/uc?export=view&id={{ \App\Product::where('id', $item->product_id)->value('image') }}" alt="" style ="width: 100px"></a></div>
                  <div class="flex">
                     <a href="#" class="item-author text-color" data-abc="true">{{ \App\Product::where('id', $item->product_id)->value('name') }}</a>
                     <div class="item-except text-muted text-sm h-1x">Số lượng: {{$item->quantity}}</div>
                     <div class="item-except text-muted text-sm h-1x">Giá: {{ \App\Product::where('id', $item->product_id)->value('price') }}</div>
                  </div>
               </div>
               @endforeach
            </div>
         </div>
         
         <div class="mt-4">
            
            <p>Mã giảm giá: {{$order->discount_code?$order->discount_code:"#No_discount"}}</p>
            <p>Phương thức thanh toán: {{ $order->pay_method  == 'POD' ? 'Thanh toán chuyển khoản' : 'Thanh toán khi nhận hàng'}}</p>
            <p>Trạng thái thanh toán: <strong>{{ $order->is_completed  == '0' ? 'Chưa thanh toán' : 'Đã thanh toán'}}</strong></p>
            <strong class="text-success">Tổng tiền: {{number_format($order->total_price)}} đ</strong>
            @if($order->is_completed  == '0'&& !empty($gateway))
            <p class="text-danger mt-3">Vui lòng quét mã QR để thanh toán</p>
                <div id="qrImage" style="display: flex; justify-content: start;">
                    <img style="width: 20%;" class="qr-image" src="https://img.vietqr.io/image/{{$gateway->bank_id}}-{{$gateway->account_no}}-{{$gateway->template}}.png?amount={{$order->total_price}}&addInfo={{$order->order_code}}&accountName={{$gateway->account_name}}" alt="">
                </div>
            @endif
         </div>
      </div>

        @if( $order->status != 'delivered' && $order->status != 'cancel' && $order->status != 'return')
        <button class="btn btn-danger mt-5">
            <a style="color: white" class="d-inline-block" href="{{route('cancel.order',[$order->id])}}">
                Hủy đơn hàng
            </a>
        </button>
        @endif

        @if( $order->is_completed == 1 && $order->status != 'return')
        @php
            $sentDate = \Carbon\Carbon::parse($order->sent_date);
            $sevenDaysFromSentDate = $sentDate->copy()->addDays(7);
            $currentDate = \Carbon\Carbon::now();
        @endphp

        @if($currentDate->lt($sevenDaysFromSentDate))
            <button class="btn btn-warning mt-5">
                <a style="color: white" class="d-inline-block" href="{{route('return.order',[$order->id])}}">
                    Hoàn trả
                </a>
            </button>
            <p>(Bạn có thể hoàn trả trong vòng 7 ngày)</p>
            <h5>Điều kiện trả hàng</h5>
            <p>a. Người mua đã thanh toán nhưng (i) không nhận được sản phẩm, hoặc (ii) không nhận được toàn bộ các sản phẩm đã đặt, hoặc (iii) nhận được sản phẩm là hàng giả, hàng nhái;</p>
            <p>b. Sản phẩm bị lỗi hoặc bị hư hại trong quá trình vận chuyển;</p>
            <p>c. Người bán giao sai sản phẩm cho Người mua (ví dụ: sai kích cỡ, sai màu sắc, v.vv...);</p>
            <p>d. Sản phẩm Người mua nhận được khác biệt một cách rõ rệt so với thông tin mà Người bán cung cấp trong mục mô tả sản phẩm;</p>
            <p>e. Sản phẩm hết hạn sử dụng;</p>

        @endif
        @elseif( $order->status == 'return')
            <h5 class="mt-5 text-primary">Yêu cầu hoàn trả của bạn đang được xem xét</h5>
        @endif
    </div>
  </div>




    </div>
</div>

<style>
   .card-stepper {
z-index: 0
}

#progressbar-2 {
color: #455A64;
}

#progressbar-2 li {
list-style-type: none;
font-size: 13px;
width: 33.33%;
float: left;
position: relative;
}

#progressbar-2 #step1:before {
content: '\f058';
font-family: "Font Awesome 5 Free";
color: #fff;
width: 37px;
margin-left: 0px;
padding-left: 0px;
}

#progressbar-2 #step2:before {
content: '\f058';
font-family: "Font Awesome 5 Free";
color: #fff;
width: 37px;
}

#progressbar-2 #step3:before {
content: '\f058';
font-family: "Font Awesome 5 Free";
color: #fff;
width: 37px;
margin-right: 0;
text-align: center;
}

#progressbar-2 #step4:before {
content: '\f111';
font-family: "Font Awesome 5 Free";
color: #fff;
width: 37px;
margin-right: 0;
text-align: center;
}

#progressbar-2 li:before {
line-height: 37px;
display: block;
font-size: 12px;
background: #c5cae9;
border-radius: 50%;
}

#progressbar-2 li:after {
content: '';
width: 100%;
height: 10px;
background: #c5cae9;
position: absolute;
left: 0%;
right: 0%;
top: 15px;
z-index: -1;
}

#progressbar-2 li:nth-child(1):after {
left: 1%;
width: 100%
}

#progressbar-2 li:nth-child(2):after {
left: 1%;
width: 100%;
}

#progressbar-2 li:nth-child(3):after {
left: 1%;
width: 100%;
/* background: #c5cae9 !important; */
}

#progressbar-2 li:nth-child(4) {
left: 0;
width: 37px;
}

#progressbar-2 li:nth-child(4):after {
left: 0;
width: 0;
}

#progressbar-2 li.active:before,
#progressbar-2 li.active:after {
background: #6520ff;
}
#page-content{
    
    margin-top:100px;
}


a {
    color: #448bff;
    text-decoration: none;
    background-color: transparent
}

a:hover {
    color: #005ef7;
    text-decoration: underline
}

a:not([href]):not([tabindex]) {
    color: inherit;
    text-decoration: none
}

a:not([href]):not([tabindex]):focus,
a:not([href]):not([tabindex]):hover {
    color: inherit;
    text-decoration: none
}

a:not([href]):not([tabindex]):focus {
    outline: 0
}






/*Mark Down*/


@media (min-width:576px) {
    .col-sm {
        flex-basis: 0;
        flex-grow: 1;
        max-width: 100%
    }
    .col-sm-auto {
        flex: 0 0 auto;
        width: auto;
        max-width: 100%
    }
    .col-sm-1 {
        flex: 0 0 8.3333333333%;
        max-width: 8.3333333333%
    }
    .col-sm-2 {
        flex: 0 0 16.6666666667%;
        max-width: 16.6666666667%
    }
    .col-sm-3 {
        flex: 0 0 25%;
        max-width: 25%
    }
    .col-sm-4 {
        flex: 0 0 33.3333333333%;
        max-width: 33.3333333333%
    }
    .col-sm-5 {
        flex: 0 0 41.6666666667%;
        max-width: 41.6666666667%
    }
    .col-sm-6 {
        flex: 0 0 50%;
        max-width: 50%
    }
    .col-sm-7 {
        flex: 0 0 58.3333333333%;
        max-width: 58.3333333333%
    }
    .col-sm-8 {
        flex: 0 0 66.6666666667%;
        max-width: 66.6666666667%
    }
    .col-sm-9 {
        flex: 0 0 75%;
        max-width: 75%
    }
    .col-sm-10 {
        flex: 0 0 83.3333333333%;
        max-width: 83.3333333333%
    }
    .col-sm-11 {
        flex: 0 0 91.6666666667%;
        max-width: 91.6666666667%
    }
    .col-sm-12 {
        flex: 0 0 100%;
        max-width: 100%
    }
    .order-sm-first {
        order: -1
    }
    .order-sm-last {
        order: 13
    }
    .order-sm-0 {
        order: 0
    }
    .order-sm-1 {
        order: 1
    }
    .order-sm-2 {
        order: 2
    }
    .order-sm-3 {
        order: 3
    }
    .order-sm-4 {
        order: 4
    }
    .order-sm-5 {
        order: 5
    }
    .order-sm-6 {
        order: 6
    }
    .order-sm-7 {
        order: 7
    }
    .order-sm-8 {
        order: 8
    }
    .order-sm-9 {
        order: 9
    }
    .order-sm-10 {
        order: 10
    }
    .order-sm-11 {
        order: 11
    }
    .order-sm-12 {
        order: 12
    }
    .offset-sm-0 {
        margin-left: 0
    }
    .offset-sm-1 {
        margin-left: 8.3333333333%
    }
    .offset-sm-2 {
        margin-left: 16.6666666667%
    }
    .offset-sm-3 {
        margin-left: 25%
    }
    .offset-sm-4 {
        margin-left: 33.3333333333%
    }
    .offset-sm-5 {
        margin-left: 41.6666666667%
    }
    .offset-sm-6 {
        margin-left: 50%
    }
    .offset-sm-7 {
        margin-left: 58.3333333333%
    }
    .offset-sm-8 {
        margin-left: 66.6666666667%
    }
    .offset-sm-9 {
        margin-left: 75%
    }
    .offset-sm-10 {
        margin-left: 83.3333333333%
    }
    .offset-sm-11 {
        margin-left: 91.6666666667%
    }
}





.text-muted {
    color: #99a0ac!important
}

.block,
.card {
    background: #fff;
    border-width: 0;
    border-radius: .25rem;
    box-shadow: 0 1px 3px rgba(0, 0, 0, .05);
    margin-bottom: 1.5rem
}

.avatar {
    position: relative;
    line-height: 1;
    border-radius: 500px;
    white-space: nowrap;
    font-weight: 700;
    border-radius: 100%;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-pack: center;
    justify-content: center;
    -ms-flex-align: center;
    align-items: center;
    -ms-flex-negative: 0;
    flex-shrink: 0;
    border-radius: 500px;
    box-shadow: 0 5px 10px 0 rgba(50, 50, 50, .15)
}

.avatar img {
    border-radius: inherit;
    width: 100%
}

.gd-primary {
    color: #fff;
    border: none;
    background: #448bff linear-gradient(45deg, #448bff, #44e9ff)
}


.gd-success {
    color: #fff;
    border: none;
    background: #31c971 linear-gradient(45deg, #31c971, #3dc931)
}



.gd-info {
    color: #fff;
    border: none;
    background: #14bae4 linear-gradient(45deg, #14bae4, #14e4a6)
}


.gd-warning {
    color: #fff;
    border: none;
    background: #f4c414 linear-gradient(45deg, #f4c414, #f45414)
}


@media (min-width:992px) {
    .page-container {
        max-width: 1140px;
        margin: 0 auto
    }
    .page-sidenav {
        display: block!important
    }
}


.list {
    padding-left: 0;
    padding-right: 0
}

.list-item {
    position: relative;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word
}





.list-row .list-item {
    -ms-flex-direction: row;
    flex-direction: row;
    -ms-flex-align: center;
    align-items: center;
    padding: .75rem .625rem
}

.list-row .list-item>* {
    padding-left: .625rem;
    padding-right: .625rem
}



.no-wrap {
    white-space: nowrap
}



.text-color {
    color: #5e676f
}



.text-gd {
    -webkit-background-clip: text;
    -moz-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent;
    -moz-text-fill-color: transparent;
    text-fill-color: transparent
}



.text-sm {
    font-size: .825rem
}

.h-1x {
    height: 1.25rem;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical
}


.w-48 {
    width: 48px!important;
    height: 48px!important
}


a:link{

   text-decoration: none;
}

.steps .step {
    display: block;
    width: 100%;
    margin-bottom: 35px;
    text-align: center
}

.steps .step .step-icon-wrap {
    display: block;
    position: relative;
    width: 100%;
    height: 80px;
    text-align: center
}

.steps .step .step-icon-wrap::before,
.steps .step .step-icon-wrap::after {
    display: block;
    position: absolute;
    top: 50%;
    width: 50%;
    height: 3px;
    margin-top: -1px;
    background-color: #e1e7ec;
    content: '';
    z-index: 1
}

.steps .step .step-icon-wrap::before {
    left: 0
}

.steps .step .step-icon-wrap::after {
    right: 0
}

.steps .step .step-icon {
    display: inline-block;
    position: relative;
    width: 80px;
    height: 80px;
    border: 1px solid #e1e7ec;
    border-radius: 50%;
    background-color: #f5f5f5;
    color: #374250;
    font-size: 38px;
    line-height: 81px;
    z-index: 5
}

.steps .step .step-title {
    margin-top: 16px;
    margin-bottom: 0;
    color: #606975;
    font-size: 14px;
    font-weight: 500
}

.steps .step:first-child .step-icon-wrap::before {
    display: none
}

.steps .step:last-child .step-icon-wrap::after {
    display: none
}

.steps .step.completed .step-icon-wrap::before,
.steps .step.completed .step-icon-wrap::after {
    background-color: #0da9ef
}

.steps .step.completed .step-icon {
    border-color: #0da9ef;
    background-color: #0da9ef;
    color: #fff
}

@media (max-width: 576px) {
    .flex-sm-nowrap .step .step-icon-wrap::before,
    .flex-sm-nowrap .step .step-icon-wrap::after {
        display: none
    }
}

@media (max-width: 768px) {
    .flex-md-nowrap .step .step-icon-wrap::before,
    .flex-md-nowrap .step .step-icon-wrap::after {
        display: none
    }
}

@media (max-width: 991px) {
    .flex-lg-nowrap .step .step-icon-wrap::before,
    .flex-lg-nowrap .step .step-icon-wrap::after {
        display: none
    }
}

@media (max-width: 1200px) {
    .flex-xl-nowrap .step .step-icon-wrap::before,
    .flex-xl-nowrap .step .step-icon-wrap::after {
        display: none
    }
}

.bg-faded, .bg-secondary {
    background-color: #f5f5f5 !important;
}
</style>
@endsection