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
<div class="card">
                <div class="text-right">
                      <button class="btn btn-primary float-right m-3" data-toggle="modal" data-target="#myModal">Thêm</button>
                </div>
                <h5 class="card-header">Tất cả doanh nghiệp</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Project</th>
                        <th>Client</th>
                        <th>Users</th>
                        <th>Status</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      

                      <tr>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>Angular Project</strong></td>
                        <td>Albert Cook</td>
                        <td>
                          <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="" data-bs-original-title="Lilian Fuller">
                              <img src="../assets/img/avatars/5.png" alt="Avatar" class="rounded-circle">
                            </li>
                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="" data-bs-original-title="Sophia Wilkerson">
                              <img src="../assets/img/avatars/6.png" alt="Avatar" class="rounded-circle">
                            </li>
                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="" data-bs-original-title="Christina Parker">
                              <img src="../assets/img/avatars/7.png" alt="Avatar" class="rounded-circle">
                            </li>
                          </ul>
                        </td>
                        <td><span class="badge bg-label-primary me-1">Active</span></td>
                        <td>
                         <button class="btn btn-primary">
                         <a style="color: white" class=" d-inline-block" href="javascript:void(0);">
                            <i class="bx bx-edit-alt me-1"></i> 
                          </a>
                         </button> 
                         <button class="btn btn-warning">
                          <a style="color: white" class=" d-inline-block" href="javascript:void(0);">
                            <i class="bx bx-trash me-1"></i> 
                          </a>
                         </button> 
                        </td>

                      </tr>

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
                            <input type="text" class="form-control" id="projectName" placeholder="Nhập tên dự án" name="name">
                            <span class="error-message" id="name-error"></span>
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
                                    <option value="1">Trung tâm bảo hành</option>    
                                    <option value="2">Trung tâm đào tạo</option>    
                            </select>
                            <span class="error-message" id="business_category_id-error"></span>
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
<script>
    $(document).ready(function() {
        var formId = '#form-business';
        var validateUrl = '/validate-business';

        setupFormValidation(formId, validateUrl);
    });
</script>
@endsection