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
                <h5 class="card-header">Tất cả thành viên</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table" id="table_team">
                    <thead>
                      <tr>
                        <th>STT</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Email</th>
                        <th>Verify email</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      @foreach($users as $user)
                      <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td><iframe src="https://drive.google.com/file/d/{{$user->image}}/preview" alt="" style = "width: 120px; height: 120px"></iframe></td>
                        <td>{{ $user->email }}</td>
                        <td><span class="badge bg-label-primary me-1">{{ $user->email_verified_at ? 'Verified' : 'Not Verified' }}</span></td>
                        <td>
                          <button class="btn btn-primary">
                            <a style="color: white" class="d-inline-block" href="{{route('superadmin.team.edit',[$user->id])}}">
                              <i class="bx bx-edit-alt me-1"></i> Edit
                            </a>
                          </button> 
            
                       
                          <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmationModal{{ $user->id }}">
                              <i class="bx bx-trash me-1"></i> Delete
                          </button>
                          <div class="modal fade" id="confirmationModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <h5 class="modal-title" id="confirmationModalLabel">Confirm Delete</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                          </button>
                                      </div>
                                      <div class="modal-body">
                                          Are you sure you want to delete this item?
                                      </div>
                                      <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                          <form action="{{ route('superadmin.team.destroy', ['id' => $user->id]) }}" method="POST" style="display: inline-block;">
                                              @csrf
                                              @method('DELETE')
                                              <button type="submit" class="btn btn-danger">Delete</button>
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
                {{ $users->links() }}

                </div>

                <!-- Modal -->
            <form action="{{ route('superadmin.team.store') }}" method="POST" id="form-team" enctype="multipart/form-data">
              @csrf
              <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title" id="myModalLabel">Thêm thành viên</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                    
                      <div class="row">
                        <div class="form-group col-lg-6">
                          <label for="Name">Họ và tên</label>
                          <input type="text" class="form-control" id="Name" placeholder="Nhập tên dự án" name="name">
                          <span class="error-message" id="name-error"></span>

                        </div>
                        <div class="form-group col-lg-6">
                          <label for="email">Email</label>
                          <input type="text" class="form-control" id="email" placeholder="Nhập tên khách hàng" name="email">
                          <span class="error-message" id="email-error"></span>

                        </div>
                        <div class="form-group col-lg-6">
                          <label for="Password">Mật khẩu</label>
                          <input type="password" class="form-control" id="Password" placeholder="Nhập người dùng" name="password">
                          <span class="error-message" id="password-error"></span>

                        </div>
                        <div class="form-group col-lg-6">
                          <label for="repassword">Nhập lại mật khẩu</label>
                          <input type="password" class="form-control" id="repassword" placeholder="Nhập người dùng" name="repassword">
                          <span class="error-message" id="repassword-error"></span>

                        </div>
                        <div class="form-group col-lg-6">
                          <label for="phone_number">Số điện thoại</label>
                          <input type="text" class="form-control" id="phone_number" placeholder="Nhập tên khách hàng" name="phone_number">
                          <span class="error-message" id="phone_number-error"></span>

                        </div>
                        <div class="form-group col-lg-4">
                                <label for="image">Ảnh đại diện</label>
                                <input type="file" class="form-control" id="image" name="image" onchange="displayThumbnail(event)">
                                <span class="error-message" id="image-error"></span>
                          </div>
                        @include('select-options.show_thumnail')

                        <div class="form-group col-lg-6">
                          <label for="status">Trạng thái hoạt động</label>
                          <select class="form-control" id="status" name="status">
                            <option value="">Thiết lập trạng thái</option>
                            <option value="1">Hoạt động</option>
                            <option value="2">Không hoạt động</option>
                          </select>          
                          <span class="error-message" id="status-error"></span>

                        </div>

                        <div class="form-group col-lg-6">
                          <label for="gender">Giới tính</label>
                          <select class="form-control" id="gender" name="gender">
                            <option value="">Chọn giới tính</option>
                            <option value="1">Nam</option>
                            <option value="2">Nữ</option>
                            <option value="3">Khác</option>
                          </select>         
                          <span class="error-message" id="gender-error"></span>

                        </div>

                        <div class="form-group col-lg-6">
                          <label for="date">Ngày sinh</label>
                          <input type="date" class="form-control" id="date" placeholder="Nhập người dùng" name="birthday">
                          <span class="error-message" id="birthday-error"></span>

                        </div>
                
                        <div class="form-group col-lg-6">
                          <label for="role">Vai trò</label>
                          <select class="form-control" name="role" id="role" >
                            <option value="">Chọn vai trò</option>
                            <option value="1">Superadmin</option>
                            <option value="2">Chủ doanh nghiệp</option>
                            <option value="no">Nhân viên</option>
                          </select>     
                          <span class="error-message" id="role-error"></span>

                        </div>

                        <div class="form-group col-lg-6">
                          <label for="business_id">Thuộc doanh nghiệp</label>
                          <select class="form-control" name="business_id" id="business_id">
                            <option value="">Chọn doanh nghiệp</option>
                            @if(!empty($businesses)){
                              @foreach($businesses as $business){
                                <option value="{{$business->id}}">{{$business->name}}</option>
                              }
                              @endforeach
                            }
                            @endif
                          </select>  
                          <span class="error-message" id="business_id-error"></span>
                        </div>         
                            @include('select-options.address', ['provinces' => $provinces, 'wards' => $wards, 'districts' => $districts,
                            'selectedProvince' => null,
                            'selectedDistrict' => null,
                            'selectedWard' => null
                            ])
    
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                      <button type="submit" class="btn btn-primary" id="submit-btn">Lưu</button>
                    </div>
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
<!-- Gọi hàm thêm search table -->
<script src="{{ asset('assets/js/data-table-js.js') }}"></script>
<script>
    $(document).ready(function() {
        var formId = '#form-team';
        var validateUrl = '/validate-team';

        setupFormValidation(formId, validateUrl);

        var id_table = '#table_team';
        searchDataTable(id_table,true, false);

    });
</script>
@endsection