@extends('view-seller.repair-system.repair-system.layout.layout')
@section('content')

    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container">
        <section class="h-100" >
  <div class="container h-100 py-5">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12">

        <div class="d-flex justify-content-between align-items-center mb-4">
          <h3 class="fw-normal mb-0 text-black">Giỏ hàng</h3>
        </div>

        @php
          $total_price = 0;
        @endphp
        @if(!empty($carts) && count($carts) > 0)
          @foreach($carts as $cart)
          @php
            if (!empty($cart->title_1) && !empty($cart->value_1) || !empty($cart->title_2) && !empty($cart->value_2)) {
                $total_price += $cart->variant_price * $cart->quantity;
            } else {
                $total_price += $cart->price * $cart->quantity;
            }
          @endphp
          <div class="card rounded-3 mb-4">
          <div class="card-body p-4">
            <div class="row d-flex justify-content-between align-items-center">
              <div class="col-md-2 col-lg-2 col-xl-2 mb-3">
                <img
                src="https://drive.google.com/uc?export=view&id={{$cart->image}}"
                  class="img-fluid rounded-3" alt="Cotton T-shirt">
              </div>


              <div class="col-md-3 col-lg-3 col-xl-3">
                <p class=" fw-normal mb-2">{{$cart->name}}</p>
                  @if(!empty($cart->title_1) && !empty($cart->value_1))
                    <span class="text-muted">{{$cart->title_1}}: </span>{{$cart->value_1}}
                  @endif
                  @if(!empty($cart->title_2) && !empty($cart->value_2))
                    <span class="text-muted">, {{$cart->title_2}}: </span>{{$cart->value_2}}
                  @endif
         
              </div>
              <!-- Chỗ này với thêm 2 cái hàm ở dưới -->
              <div class="col-6 col-md-3 col-lg-3 col-xl-2 d-flex mb-3">
                <button class="btn btn-link px-2" onclick="changeQuantity(this, -1)">
                  <i class="fas fa-minus"></i>
                </button>

                <input data-id="{{$cart->id}}" min="1" name="quantity" value="{{$cart->quantity}}" type="number"
                  class="form-control form-control-sm" onchange="updateQuantity(this.value, this.getAttribute('data-id'))" />

                <button class="btn btn-link px-2" onclick="changeQuantity(this, 1)">
                  <i class="fas fa-plus"></i>
                </button>
              </div>


              <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                <h6 class="mb-0">
                  @if(!empty($cart->title_1) && !empty($cart->value_1) || !empty($cart->title_2) && !empty($cart->value_2))
                  <span>{{number_format($cart->variant_price)}} đ</span>
                  @else
                  <span>{{number_format($cart->price)}} đ</span>
                  @endif
                </h6>
              </div>
              <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                <a href="#!" class="text-danger" data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal{{ $cart->id }}">
                  <i class="fas fa-trash fa-lg"></i>
                </a>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="deleteConfirmationModal{{ $cart->id }}" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel{{ $cart->id }}" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="deleteConfirmationModalLabel{{ $cart->id }}">Xác nhận xóa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                Bạn có chắc chắn muốn xóa mục này khỏi giỏ hàng?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Hủy</button>
                <form method="POST" action="{{ route('seller.delete.cart', ['domain' => request()->segment(2), 'category_slug' => request()->segment(3), 'id' => $cart->id]) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Xóa</button>
                </form>
   
              </div>
            </div>
          </div>
        </div>
          @endforeach
        @else
        <div style="width: 100%; text-align: center;">
          <img style="width: 50%; display: inline-block;" src="https://cdn.dribbble.com/users/687236/screenshots/5838300/group_852_2x.png" alt="">
          <p>Không có sản phẩm nào trong giỏ hàng</p>
        </div>


        @endif
      </div>
    </div>
  </div>


</section>
@if(!empty($carts) && count($carts) > 0)
<div class="card shadow-2-strong mb-5 mb-lg-0" style="border-radius: 16px;">
            <div class="card-body p-4">
            <form action="{{ route('seller.order', ['domain' => request()->segment(2), 'category_slug' => request()->segment(3)]) }}" method="POST" id="info-order">
            @csrf
              <div class="row justify-content-end">
                
                <div class="col-md-12 col-lg-6 col-xl-6 mb-4 mb-md-0 col-12">
                <h5 >Thông tin khách hàng<span class="text-danger">*</span></h5>
                <div class="row">
                  <div class="col-5 col-ms-5 col-lg-3 col-xl-3" style="line-height: 40px;">Họ và tên<span class="text-danger">*</span> : </div> <div class="col-7 col-ms-7 col-lg-9 col-xl-9"> <input  class="form-control" type="text" name="name" value="{{Auth::guard('customer')->user()->full_name}}" ><span class="error-message" id="name-error"></span></div>
                </div>

                <div class="row">
                  <div class="col-5 col-ms-5 col-lg-3 col-xl-3" style="line-height: 40px;">Số điện thoại<span class="text-danger">*</span> : </div> <div class="col-7 col-ms-7 col-lg-9 col-xl-9"> <input  class="form-control" type="text" name="phone_number" value="{{Auth::guard('customer')->user()->phone_number}}" ><span class="error-message" id="phone_number-error"></span></div>
                </div>

                <div class="row">
                  <div class="col-5 col-ms-5 col-lg-3 col-xl-3" style="line-height: 40px;">Email<span class="text-danger">*</span> : </div> <div class="col-7 col-ms-7 col-lg-9 col-xl-9"> <input  class="form-control" type="text" name="email" value="{{Auth::guard('customer')->user()->email}}" ><span class="error-message" id="email-error"></span></div>
                </div>

                <h5 class="mt-4">Vui lòng chọn địa chỉ giao hàng<span class="text-danger">*</span></h5>
                <div>
                @if(!empty(Auth::guard('customer')->user()->address))
                    @php
                        $decodedAddress = json_decode(Auth::guard('customer')->user()->address);
                    @endphp
                @endif
                
                @include('select-options.address', [
                    'provinces' => $provinces,
                    'wards' => $wards,
                    'districts' => $districts,
                    'selectedProvince' => !empty($decodedAddress->province) ? $decodedAddress->province : null,
                    'selectedDistrict' => !empty($decodedAddress->district) ? $decodedAddress->district : null,
                    'selectedWard' => !empty($decodedAddress->ward) ? $decodedAddress->ward : null
                ])

                  <textarea class="w-100 mt-3 form-control" style="height: 100px" placeholder="Nhập chi tiết địa chỉ" name="note"></textarea>

                  <input type="checkbox" name="set_default" class="mt-4" > <span>Đặt làm thông tin mặc định</span>
                </div>
                  
                </div>

                <div class="col-lg-6 col-xl-6">
                
                <h5>Vui lòng chọn phương thức thanh toán<span class="text-danger">*</span></h5>
                  <div class="d-flex flex-row pb-3">
                      <div class="d-flex align-items-center pe-2">
                        <input class="form-check-input" type="radio" name="pay_method" id="radioNoLabel2v" value="POD" aria-label="..." checked="">
                      </div>
                      <div class="rounded border w-100 p-3">
                        <p class="d-flex align-items-center mb-0">
                        <i style ="font-size: 26px;"class="fas fa-money-bill-wave-alt text-dark pe-2"></i> Thanh toán khi nhận hàng
                        </p>
                      </div>
                    </div>

                    <div class="d-flex flex-row pb-3">
                      <div class="d-flex align-items-center pe-2">
                        <input class="form-check-input" type="radio" name="pay_method" id="radioNoLabel1v" value="VNpay" aria-label="..." >
                      </div>
                      <div class="rounded border w-100 p-3">
                        <p class="d-flex align-items-center mb-0">
                          <i class="fab fa-cc-mastercard fa-2x text-dark pe-2"></i> Thanh toán VNPay (Thanh toán chuyển khoản)
                        </p>
                      </div>
                    </div>

                    <div id="discount">
                     @include('view-seller.repair-system.repair-system.cart_total', ['total_price'=> $total_price] )
                    </div>

          
                  <button type="submit" class="btn btn-primary btn-block btn-lg">
                    <div class="d-flex justify-content-between">
                      <span>Đặt hàng</span>
                    </div>
                  </button>

                </div>
              </div>
          </form>
            </div>
</div>
@endif
        </div>
    </div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Gọi hàm validate để xử lý form -->
<script src="{{ asset('assets/js/validateForm.js') }}"></script>

<script>



    $(document).ready(function() {
        var formId = '#info-order';
        var validateUrl = '/validate-info-order';

        setupFormValidation(formId, validateUrl);

    });


var csrfToken = $('meta[name="csrf-token"]').attr('content');

function updateQuantity(newQuantity, productId) {
  $.ajax({
    type: 'POST',
    url: "{{ route('cart.update')}}",
    headers: {
        'X-CSRF-TOKEN': csrfToken
    },
    data: {
      id: productId,
      quantity: newQuantity
    },

    success: function(response) {
     
      $('#discount').html(response);
    },
    error: function(xhr, status, error) {
      console.error('Có lỗi xảy ra khi cập nhật dữ liệu: ' + error);
    }
  });
}


function changeQuantity(button, step) {
  var input = button.parentNode.querySelector('input[type=number]');
  var currentValue = parseInt(input.value);
  
  var newValue = currentValue + step;
  if (newValue >= 1) {
    input.value = newValue;
    var cartId = input.getAttribute('data-id');
    updateQuantity(input.value, cartId);
  }
}


function checkDiscount() {
  var discountCode = $('#form1').val();
  $.ajax({
    type: 'POST',
    url: "{{ route('check.discount')}}",
    headers: {
        'X-CSRF-TOKEN': csrfToken
    },
    data: {
      code: discountCode,
    },
   
    success: function(response) {
      console.log(response)
      $('#discount').html(response);

    },
    error: function(xhr, status, error) {
      console.error('Có lỗi xảy ra khi cập nhật dữ liệu: ' + error);
    }
  });
}

function destroyDiscount() {
  $.ajax({
    type: 'GET',
    url: "{{ route('destroy.discount')}}",
    headers: {
        'X-CSRF-TOKEN': csrfToken
    },

    success: function(response) {
      console.log(response)
      $('#discount').html(response);
    },
    error: function(xhr, status, error) {
      console.error('Có lỗi xảy ra khi cập nhật dữ liệu: ' + error);
    }
  });
}
</script>
@endsection