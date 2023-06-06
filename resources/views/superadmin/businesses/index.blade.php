@extends('layouts.superadmin')
@section('content')
<div class="content-wrapper">
<div class="container-xxl flex-grow-1 container-p-y">
<div class="card">
                <div class="text-right">
                      <button class="btn btn-primary float-right m-3" data-toggle="modal" data-target="#myModal">Thêm</button>
                </div>
                <h5 class="card-header">Table Basic</h5>
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
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Thêm dự án mới</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form>
          <div class="form-group">
            <label for="projectName">Tên dự án</label>
            <input type="text" class="form-control" id="projectName" placeholder="Nhập tên dự án">
          </div>
          <div class="form-group">
            <label for="clientName">Tên khách hàng</label>
            <input type="text" class="form-control" id="clientName" placeholder="Nhập tên khách hàng">
          </div>
          <div class="form-group">
            <label for="users">Người dùng</label>
            <input type="text" class="form-control" id="users" placeholder="Nhập người dùng">
          </div>
          <div class="form-group">
            <label for="status">Trạng thái</label>
            <input type="text" class="form-control" id="status" placeholder="Nhập trạng thái">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        <button type="button" class="btn btn-primary">Lưu</button>
      </div>
    </div>
  </div>
</div>
          
              </div>
</div>
</div>
@endsection