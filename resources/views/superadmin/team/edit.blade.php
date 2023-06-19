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
        <form action="{{ route('superadmin.team.update', ['id' => $id]) }}" method="POST" id="form-team" enctype="multipart/form-data">
            @csrf
                    <div class="modal-body">                
                        <div class="row">
                            <div class="form-group col-lg-6">
                            <label for="Name">Họ và tên</label>
                            <input type="text" class="form-control" id="Name" placeholder="Nhập tên dự án" name="name" value="{{ $user->name }}">
                            <span class="error-message" id="name-error"></span>

                            </div>
                            <div class="form-group col-lg-6">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" placeholder="Nhập tên khách hàng" name="email" value="{{ $user->email }}">
                            <span class="error-message" id="email-error"></span>

                            </div>
                            <div class="form-group col-lg-6">
                            <label for="Password">Mật khẩu</label>
                            <input type="password" class="form-control" id="Password" placeholder="Nếu không nhập mật khẩu xem như không đổi" name="password" >
                            <span class="error-message" id="password-error"></span>

                            </div>
                            <div class="form-group col-lg-6">
                            <label for="repassword">Nhập lại mật khẩu</label>
                            <input type="password" class="form-control" id="repassword" placeholder="Nếu không nhập mật khẩu xem như không đổi" name="repassword" >
                            <span class="error-message" id="repassword-error"></span>
                            <input type="hidden" name="noPass">
                            </div>
                            <div class="form-group col-lg-6">
                            <label for="phone_number">Số điện thoại</label>
                            <input type="text" class="form-control" id="phone_number" placeholder="Nhập tên khách hàng" name="phone_number" value="{{ $user->phone_number }}">
                            <span class="error-message" id="phone_number-error"></span>

                            </div>
                            <div class="form-group col-lg-4">
                                <label for="image">Ảnh đại diện</label>
                                <input type="file" class="form-control" id="image" name="image" onchange="displayThumbnail(event)">
                                <span class="error-message" id="image-error"></span>
                            </div>
                            @include('select-options.show_thumnail', ['image' => $user->image])


                            <div class="form-group col-lg-6">
                                <label for="status">Trạng thái hoạt động</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="">Thiết lập trạng thái</option>
                                    <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>Hoạt động</option>
                                    <option value="2" {{ $user->status == 2 ? 'selected' : '' }}>Không hoạt động</option>
                                </select>
                                <span class="error-message" id="status-error"></span>
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="gender">Giới tính</label>
                                <select class="form-control" id="gender" name="gender">
                                    <option value="">Chọn giới tính</option>
                                    <option value="1" {{ $user->gender == 1 ? 'selected' : '' }}>Nam</option>
                                    <option value="2" {{ $user->gender == 2 ? 'selected' : '' }}>Nữ</option>
                                    <option value="3" {{ $user->gender == 3 ? 'selected' : '' }}>Khác</option>
                                </select>
                                <span class="error-message" id="gender-error"></span>
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="date">Ngày sinh</label>
                                <input type="date" class="form-control" id="date" placeholder="Nhập người dùng" name="birthday" value="{{ $user->birthday }}">
                                <span class="error-message" id="birthday-error"></span>
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="role">Vai trò</label>
                                <select class="form-control" name="role" id="role">
                                    <option value="">Chọn vai trò</option>
                                    <option value="1" {{ $user->role == 1 ? 'selected' : '' }}>Superadmin</option>
                                    <option value="2" {{ $user->role == 2 ? 'selected' : '' }}>Chủ doanh nghiệp</option>
                                    <option value="no" {{ $user->role == 'no' ? 'selected' : '' }}>Nhân viên</option>
                                </select>
                                <span class="error-message" id="role-error"></span>
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="business_id">Thuộc doanh nghiệp</label>
                                <select class="form-control" name="business_id" id="business_id">
                                    <option value="">Chọn doanh nghiệp</option>
                                    @if(!empty($businesses)){
                                    @foreach($businesses as $business){
                                        <option value="{{$business->id}}" {{ $user->business_id == $business->id ? 'selected' : '' }}>{{$business->name}}</option>
                                    }
                                    @endforeach
                                    }
                                    @endif
                                </select>
                                <span class="error-message" id="business_id-error"></span>
                            </div>

                            <div class="form-group col-lg-6">
                        
                                 @if(!empty($user->address))
                                    @php
                                        $decodedAddress = json_decode($user->address);
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
                                
                            <div class="form-group text-right">                
                                <button type="submit" class="btn btn-primary" id="submit-btn">Lưu</button>
                            </div>
                        </div>                   
                  </div>
        </form>
    </div>
</div>
<!-- Gọi hàm validate để xử lý form -->
<script src="{{ asset('assets/js/validateForm.js') }}"></script>
<script>
    $(document).ready(function() {
        var formId = '#form-team';
        var validateUrl = '/validate-team';

        setupFormValidation(formId, validateUrl);
    });
</script>

@endsection