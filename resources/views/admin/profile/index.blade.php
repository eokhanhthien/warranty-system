@extends('layouts.superadmin')
@section('content')
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
            <div class="card mb-4">
            <form action="{{ route('profile.update',  ['id' => Auth::user()->id]) }}" method="POST" id="form-team" enctype="multipart/form-data">
                      @csrf
                      @method('PUT')
                    <h5 class="m-3">Thông tin cá nhân</h5>
                    <!-- Account -->
                    <div class="card-body">
                      <div class="d-flex align-items-start align-items-sm-center gap-4">
                             @include('select-options.show_thumnail', ['image' => $profile->image])
                
                            <div class="form-group col-lg-4">
                                <label for="image">Ảnh đại diện</label>
                                <input type="file" class="form-control" id="image" name="image" onchange="displayThumbnail(event)">
                                <span class="error-message" id="image-error"></span>
                            </div>

                      </div>
                    </div>
                    <hr class="my-0">
                    <div class="card-body">

                        <div class="row">
                          <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label">Họ và Tên</label>
                            <input class="form-control" type="text" id="firstName" name="name" value="{{$profile->name}}" autofocus="">
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">E-mail</label>
                            <input class="form-control" type="text" id="email" name="email" value="{{$profile->email}}" placeholder="john.doe@example.com">
                          </div>
                          <div class="mb-3 col-md-6">
                            <label class="form-label" for="phoneNumber">Số điện thoại</label>
                            <div class="input-group input-group-merge">
                              <span class="input-group-text">VI (+84)</span>
                              <input type="text" id="phoneNumber" name="phone_number" class="form-control" placeholder="Ex: 0946144333" value="{{$profile->phone_number}}">
                            </div>
                          </div>


                            <div class="form-group col-lg-6">
                                <label for="gender">Giới tính</label>
                                <select class="form-control" id="gender" name="gender">
                                    <option value="">Chọn giới tính</option>
                                    <option value="1" {{ $profile->gender == 1 ? 'selected' : '' }}>Nam</option>
                                    <option value="2" {{ $profile->gender == 2 ? 'selected' : '' }}>Nữ</option>
                                    <option value="3" {{ $profile->gender == 3 ? 'selected' : '' }}>Khác</option>
                                </select>
                                <span class="error-message" id="gender-error"></span>
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="date">Ngày sinh</label>
                                <input type="date" class="form-control" id="date" placeholder="Nhập người dùng" name="birthday" value="{{ $profile->birthday }}">
                                <span class="error-message" id="birthday-error"></span>
                            </div>

                            <label for="date">Địa chỉ</label>
                            <div class="form-group col-lg-6">
                        
                                 @if(!empty($profile->address))
                                    @php
                                        $decodedAddress = json_decode($profile->address);
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
                            </div>
                       
                          <div class="mb-3 col-md-6">
                          <label for="firstName" class="form-label">Liên kết tài khoản Google và xác thực                             
                            @if(!empty($profile->verify_email_at))
                               <div> <p class="badge bg-label-primary me-1">Đã xác thực</p></div>
                            @else
                               <div> <p class="badge bg-label-primary me-1">Chưa xác thực</p></div>
                            @endif</label>
                          <div class="d-flex mb-3">
                            <div class="flex-shrink-0">
                              <img src="../assets/img/icons/brands/google.png" alt="google" class="me-3" height="30">
                            </div>
                            <div class="flex-grow-1 row">
                              <div class="col-8 mb-sm-0 mb-2">
                                <h6 class="mb-0">Google</h6>
                                <small class="text-muted">Xác thực với tài khoản google</small>
                              </div>
                              @if(empty(Auth::user()->verify_email_at) && Auth::user()->verify_email_at == '')
                                <div class="col-4 text-end">
                                  <div class="btn btn-warning" data-toggle="modal" data-target="#myModal">Xác thực</div>
                                </div>
                              @endif
                            </div>
                          </div>
                          </div>                         
                        </div>
                        <div class="mt-2">
                          <button type="submit" class="btn btn-primary me-2">Cập nhật</button>
                        </div>
                      </form>
                    </div>
                    <!-- /Account -->
                  </div>
            </div>
        </div>
        
        <!-- Modal -->
        @if(empty(Auth::user()->verify_email_at) && Auth::user()->verify_email_at == '')
        <form action="{{ route('confirm.verify.email')}}" method="POST" >
        @csrf
        <div class="modal fade " id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
              <h4 class="modal-title text-start" id="myModalLabel">Xác thực tài khoản Google</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="row">
                    <div class="mb-3 col-md-9">
                      <input class="form-control" type="text" id="verify" name="verify_code"  autofocus="" placeholder="Nhập mã xác thực" required>
                    </div>         
                    <div class="mb-3 col-md-3">
                      <div class="btn btn-warning submit-load" id="sendCodeButton">Gửi mã</div>                          
                      <div class="spinner-3 tag-hidden"></div>
                    </div>           
                </div>  
                
                <div id="res-ajax"></div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Xác thực</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
              </div>
            </div>
          </div>
        </div>
        </form>
        @endif

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
  $("#sendCodeButton").click(function() {
    // Thực hiện yêu cầu AJAX khi nút "Gửi mã" được nhấn
    // $.ajax({
    //   url: "{{ route('verify.email', ['email' => auth()->user()->email]) }}", // Điều hướng bạn muốn gửi yêu cầu đến
    //   type: "GET", // Phương thức yêu cầu (GET, POST, PUT, DELETE, v.v.)
    //   success: function(response) {
    //     console.log(response);
    //     // Xử lý kết quả trả về từ máy chủ ở đây
    //     console.log("Yêu cầu AJAX thành công!");
    //     // Ví dụ: Hiển thị kết quả trong modal
    //     $("#res-ajax").html(response);
    //     // $("#myModal").modal("show");
    //   },
    //   error: function(xhr, status, error) {
    //     // Xử lý lỗi ở đây (nếu có)
    //     console.error("Lỗi trong quá trình yêu cầu AJAX: " + error);
    //   }
    // });
    $(".submit-load").addClass("tag-hidden");
    $(".spinner-3").removeClass("tag-hidden");
    
  });
});
</script>

@endsection