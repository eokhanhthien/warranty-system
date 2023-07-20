@extends('layouts.superadmin')
@section('content')
<?php
// echo "<pre>";
// print_r(session()->get('businesses'));die;
?>
@if(session('success'))
    <script>
        toastr.success('{!! html_entity_decode(session('success')) !!}');
    </script>
@endif

@if(session('error'))
    <script>
        toastr.error('{!! html_entity_decode(session('error')) !!}');
    </script>
@endif

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
   
    <div class="row mb-5">
        @if(!empty($packages))
        @foreach($packages as $package)
        <div class="col-md-6 col-lg-4 mb-3">
        <form method="POST" action="{{ route('subscription-package.store') }}">
            <div class="card text-center">
            <div class="card-header" style="    font-size: 20px;font-weight: 500;color: blue;">{{$package->name}}</div>
            <div class="card-body mt-4">
            <h6 class="card-title">
                Thời gian: {{ number_format($package->time) }}
                @if($package->type == "month")
                    tháng
                @elseif($package->type == "year")
                    năm
                @else
                    ngày
                @endif
            </h6>
            <input type="hidden" name="package_id" value="{{$package->id}}">
                <h5 class="card-title text-success">{{$package->price > 0 ? number_format($package->price) . " VNĐ" : "Miễn phí (gói dùng thử)" }} </h5>
                @if($package->price > 0)
                    <button type="button" id ="subscriptionPackage" class="btn btn-primary subscriptionPackage" data-toggle="modal" data-target="#buyModal{{$package->id}}">Đăng ký</button>
                @else
                    @csrf
                    <button type="submit" class="btn btn-primary">Kích hoạt</button>
                @endif
            </div>
            </div>
            </form>
        </div>

            <!-- Modal -->
        <div class="modal fade" id="buyModal{{$package->id}}" tabindex="-1" role="dialog" aria-labelledby="buyModal{{$package->id}}Label" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="buyModal{{$package->id}}Label">Mua gói - {{$package->name}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Nội dung của modal -->

                        <p>Mua gói {{$package->name}} với giá {{number_format($package->price)}} VNĐ?</p>
                        <div id="qrImage" style="display: flex; justify-content: center;">
                            <img style="width: 70%;" src="https://img.vietqr.io/image/{{$gateway->bank_id}}-{{$gateway->account_no}}-{{$gateway->template}}.png?amount={{$package->price}}&addInfo=123&accountName={{$gateway->account_name}}" alt="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        <button type="button" class="btn btn-primary">Xác nhận mua</button>
                    </div>
                </div>
            </div>
        </div>

        @endforeach
        @endif
    </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $(".subscriptionPackage").click(function () {
          
            // Get the form data including the package_id
            var formData = $(this).closest('form').serialize();
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            // Perform the AJAX request
            $.ajax({
                type: "POST",
                url: "{{ route('subscription-package.store') }}",
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function (response) {  
                    var newImageUrl = "https://img.vietqr.io/image/{{$gateway->bank_id}}-{{$gateway->account_no}}-{{$gateway->template}}.png?amount={{$package->price}}&addInfo=" + response.orderCode + "&accountName={{$gateway->account_name}}";

                    // Cập nhật lại thuộc tính src của thẻ <img>
                    $("#qrImage img").attr("src", newImageUrl);

                },
                error: function (xhr, status, error) {
                  
                }
            });
        });
    });
</script>
@endsection
