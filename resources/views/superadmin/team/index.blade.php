@extends('layouts.superadmin')
@section('content')
<div class="content-wrapper">
<div class="container-xxl flex-grow-1 container-p-y">
<div class="card">
                <div class="text-right">
                      <button class="btn btn-primary float-right m-3" data-toggle="modal" data-target="#myModal">Thêm</button>
                </div>
                <h5 class="card-header">Tất cả thành viên</h5>
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
                          <input type="text" class="form-control" id="Name" placeholder="Nhập tên dự án">
                        </div>
                        <div class="form-group col-lg-6">
                          <label for="email">Email</label>
                          <input type="text" class="form-control" id="email" placeholder="Nhập tên khách hàng">
                        </div>
                        <div class="form-group col-lg-6">
                          <label for="Password">Mật khẩu</label>
                          <input type="password" class="form-control" id="Password" placeholder="Nhập người dùng">
                        </div>
                        <div class="form-group col-lg-6">
                          <label for="rePassword">Nhập lại mật khẩu</label>
                          <input type="password" class="form-control" id="rePassword" placeholder="Nhập người dùng">
                        </div>
                        <div class="form-group col-lg-6">
                          <label for="avatar">Ảnh đại diện</label>
                          <input type="file" class="form-control" id="avatar" placeholder="Nhập người dùng">
                        </div>
                        <div class="form-group col-lg-6">
                          <label for="status">Trạng thái hoạt động</label>
                          <select class="form-control" name="" id="status">
                            <option>Thiết lập trạng thái</option>
                            <option>Hoạt động</option>
                            <option>Không hoạt động</option>
                          </select>          
                        </div>

                        <div class="form-group col-lg-6">
                          <label for="sex">Giới tính</label>
                          <select class="form-control" name="" id="sex">
                            <option>Chọn giới tính</option>
                            <option>Nam</option>
                            <option>Nữ</option>
                            <option>Khác</option>
                          </select>          
                        </div>

                        <div class="form-group col-lg-6">
                          <label for="date">Ngày sinh</label>
                          <input type="date" class="form-control" id="date" placeholder="Nhập người dùng">
                        </div>
                
                        <div class="form-group col-lg-6">
                          <label for="role">Vai trò</label>
                          <select class="form-control" name="role" id="role">
                            <option>Chọn chức vụ</option>
                            <option>Nam</option>
                            <option>Nữ</option>
                            <option>Khác</option>
                          </select>          
                        </div>

                        <div class="form-group col-lg-6">
                          <label for="role">Thuộc doanh nghiệp</label>
                          <select class="form-control" name="role" id="role">
                            <option>Chọn doanh nghiệp</option>
                            <option>Nam</option>
                            <option>Nữ</option>
                            <option>Khác</option>
                          </select>          
                        </div>         
                            @include('select-options.address', ['provinces' => $provinces, 'wards' => $wards, 'districts' => $districts])
    
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                      <button type="button" class="btn btn-primary" type="submit">Lưu</button>
                    </div>
                  </div>
                </div>
              </div>
          
              </div>
</div>
</div>
@endsection