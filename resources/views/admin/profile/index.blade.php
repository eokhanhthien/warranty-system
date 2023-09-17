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
                            @if(!empty($profile->verify_email_at))
                               <div> <p class="badge bg-label-primary me-1">Đã xác thực</p></div>
                            @else
                               <div> <p class="badge bg-label-primary me-1">Chưa xác thực</p></div>
                            @endif
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
                          <label for="firstName" class="form-label">Liên kết tài khoản Google và xác thực</label>
                          <div class="d-flex mb-3">
                            <div class="flex-shrink-0">
                              <img src="../assets/img/icons/brands/google.png" alt="google" class="me-3" height="30">
                            </div>
                            <div class="flex-grow-1 row">
                              <div class="col-9 mb-sm-0 mb-2">
                                <h6 class="mb-0">Google</h6>
                                <small class="text-muted">Xác thực với tài khoản google</small>
                              </div>
                              <div class="col-3 text-end">
                                <div class="form-check form-switch">
                                  <input class="form-check-input float-end" type="checkbox" role="switch">
                                </div>
                              </div>
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
        
@endsection