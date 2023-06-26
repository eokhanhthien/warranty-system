@extends('layouts.superadmin')
@section('content')
@section('title', 'Doanh nghiệp')
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
<div class="card">
                <div class="text-right">
                      <button class="btn btn-primary float-right m-3" data-toggle="modal" data-target="#myModal">Thêm</button>
                </div>
                <h5 class="card-header">Tất cả doanh nghiệp</h5>
                <div class="table-responsive text-nowrap">
                <table class="table" id="table_businesses">
                  <thead>
                    <tr>
                      <th>STT</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Verify email</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody class="table-border-bottom-0">
                    @foreach($businesses as $business)
                    <tr>
                      <td>{{ $loop->index + 1 }}</td>
                      <td>{{ $business->name }}</td>
                      <td>{{ $business->email }}</td>
                      <td><span class="badge bg-label-primary me-1">{{ $business->email_verified_at ? 'Verified' : 'Not Verified' }}</span></td>
                      <td>
                        <button class="btn btn-primary">
                          <a style="color: white" class="d-inline-block" href="{{route('superadmin.businesses.edit',[$business->id])}}">
                            <i class="bx bx-edit-alt me-1"></i> Sửa
                          </a>
                        </button> 
           

                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmationModal{{ $business->id }}">
                              <i class="bx bx-trash me-1"></i> Xóa
                          </button>

                          <!-- Confirmation Modal -->
                          <div class="modal fade" id="confirmationModal{{ $business->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <h5 class="modal-title" id="confirmationModalLabel">Xác nhận xóa</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                          </button>
                                      </div>
                                    <div class="modal-body">Bạn có chắc muốn xóa ?  </div>
                                      <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>                                          <form id="deleteForm{{ $business->id }}" action="{{ route('superadmin.businesses.destroy', ['id' => $business->id]) }}" method="POST">
                                              @csrf
                                              @method('DELETE')
                                              <button type="submit" class="btn btn-danger">Xóa</button>                                          
                                            </form>
                                      </div>
                                  </div>
                              </div>
                          </div>



                 
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>

                </div>

                <!-- Modal -->
                <form action="{{ route('superadmin.businesses.store') }}" method="POST" id="form-business">
                    @csrf
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel">Thêm chi nhánh</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label for="projectName">Tên doanh nghiệp</label>
                                        <input type="text" class="form-control" id="projectName" placeholder="Nhập tên dự án" name="name" oninput="generateSlug(1)">
                                        <span class="error-message" id="name-error"></span>
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <label for="slug">Domain</label>
                                        <input type="text" class="form-control" id="slug" placeholder="Slug" name="domain" readonly>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="email">Email doanh nghiệp</label>
                                        <input type="text" class="form-control" id="email" placeholder="Nhập người dùng" name="email">
                                        <span class="error-message" id="email-error"></span>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="phone_number">Số điện thoại liên hệ</label>
                                        <input type="text" class="form-control" id="phone_number" placeholder="Nhập Số điện thoại liên hệ" name="phone_number">
                                        <span class="error-message" id="phone_number-error"></span>
                                    </div>

                                    <div class="form-group col-lg-6">
                                    <label for="business_category_id">Danh mục doanh nghiệp</label>
                                        <select name="business_category_id" id="business_category_id" style="padding-right: 1.9rem !important;" class="form-control">
                                                <option value="">Chọn danh mục</option> 
                                                @if(!empty($business_category))
                                                    @foreach($business_category as $category)
                                                        <option value="{{$category->id}}">{{$category->vi_name}}</option>    
                                                    @endforeach
                                                @endif   
                                        </select>
                                        <span class="error-message" id="business_category_id-error"></span>
                                    </div>
                                      
                                    <div class="form-group col-lg-6">
                                    <label for="owner_id">Chủ sỡ hữu</label>
                                        <select name="owner_id" id="owner_id" style="padding-right: 1.9rem !important;" class="form-control">
                                                <option value="">Chọn chủ sỡ hữu</option> 
                                                @foreach($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                                @foreach($owners as $owner)
                                                    <option value="{{ $owner->id }}" style="color: darkgrey;" disabled>{{ $owner->name }}</option>
                                                @endforeach 
                                        </select>
                                        <span class="error-message" id="owner_id-error"></span>
                                    </div>
                                    
                                    </div>
                                    <div class="col-lg-6 p-0">
                                        @include('select-options.address', ['provinces' => $provinces, 'wards' => $wards, 'districts' => $districts])
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                    <button type="submit" class="btn btn-primary" id="submit-btn">Lưu</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
        </div>
</div>
</div>
<!-- Gọi hàm validate để xử lý form -->
<script src="{{ asset('assets/js/validateForm.js') }}"></script>
<!-- Gọi hàm tạo slug -->
<script src="{{ asset('assets/js/slug.js') }}"></script>
<!-- Gọi hàm thêm search table -->
<script src="{{ asset('assets/js/data-table-js.js') }}"></script>
<script>
    $(document).ready(function() {
        var formId = '#form-business';
        var validateUrl = '/validate-business';

        setupFormValidation(formId, validateUrl);

        var id_table = '#table_businesses';
        searchDataTable(id_table,true, true , 10);
    });


</script>
@endsection