<div class="card mb-4">
    <div class="card-body p-4 d-flex flex-row">
    <div class="form-outline flex-fill">
        <input type="text" name="discount_code" placeholder="Nhập mã giảm giá" id="form1" class="form-control " value="{{session()->has('code') ? session('code') : ''}}" />
    </div>
    @if(!session()->has('code'))
    <button type="button" class="btn btn-outline-warning ms-3" onclick="checkDiscount()">Áp dụng</button>
    @else
    <button type="button" class="btn btn-outline-warning ms-3 " onclick="destroyDiscount()">Hủy</button>
    @endif
    </div>
</div>

<h5 class="mt-4">Tổng tiền</h5>
    <div class="d-flex justify-content-between" style="font-weight: 500;">
    <p class="mb-2">Tạm tính</p>
    <p class="mb-2 text-primary total_price" id="totalPrice_temp">{{number_format(session('total_cart', 0))}} đ</p>
    </div>

    <div class="d-flex justify-content-between" style="font-weight: 500;">
    <p class="mb-0">Phí vận chuyển</p>
    <p class="mb-0">30.000 đ</p>
    </div>
    @if(session()->has('discount_amount'))
    <div class="d-flex justify-content-between mt-2" style="font-weight: 500;">
    <p class="mb-0">Mã giảm giá</p>
    <p class="mb-0">- {{number_format(session('discount_amount', 0))}} đ</p>
    <input type="hidden" name="discount_amount" value="{{session('discount_amount', 0)}}">
    </div>
    @endif
    <hr class="my-4">
    @if(!session()->has('discount_amount'))
        <div class="d-flex justify-content-between mb-4" style="font-weight: 500;">
        <p class="mb-2">Tổng cộng</p>
        <p class="mb-2 total_price text-primary" id="totalPrice" >{{number_format(session('total_cart', 0) + 30000)}} đ</p>
        <input type="hidden" name="total_price" value="{{session('total_cart', 0) + 30000}}">
        </div>
    @else
        <div class="d-flex justify-content-between mb-4" style="font-weight: 500;">
            <p class="mb-2">Tổng cộng</p>
            <p class="mb-2 total_price text-primary" id="totalPrice">{{number_format(session('total_cart', 0) - session('discount_amount', 0) + 30000)}} đ</p>
            
            <input type="hidden" name="total_price" value="{{session('total_cart', 0) - session('discount_amount', 0) + 30000}}">
        </div>
    @endif
