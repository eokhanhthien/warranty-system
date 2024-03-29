@extends('staff.layout.index')
@section('content') 
@section('title', 'Gói')
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
 
                <div class="text-right">
                      <button class="btn btn-primary  m-3" data-toggle="modal" data-target="#myModal"><i class='bx bx-plus'></i> Thêm</button>
                </div>
                <h5 class="card-header">Tất cả nhân viên</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table" id="table_team">
                    <thead>
                      <tr>
                        <th>STT</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Email</th>
                        <th>Chức vụ</th>
                        <th>Last login</th>
                        <th>Created at</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      @foreach($users as $user)
                      <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $user->name }}</td>
                        @if(!empty($user->image))
                          <td><img  style = "width: 100px;height: 100px;object-fit: cover;" class="img-fluid" src="https://drive.google.com/uc?export=view&id={{$user->image}}" alt=""></td>
                        @else
                         <td><img style = "width: 100px; height: 100px" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAAMFBMVEXFxcX////CwsLGxsb7+/vT09PJycn19fXq6urb29ve3t7w8PDOzs7n5+f5+fnt7e30nlkBAAAFHUlEQVR4nO2dC5qqMAyFMTwUBdz/bq+VYYrKKJCkOfXmXwHna5uTpA+KwnEcx3Ecx3Ecx3Ecx3Ecx3Ecx3Ecx3Ecx3EcA2iO9cdIc5PUdO257y+BU39u66b4HplE3fk6VIcnqmNfl1+gksr6+iIucjl3WYukor7+re6Hoe1y1UhNO3zUd+fUFRmKpOa0Tt6dY5ubRCrOG/QFLk1WGmnt/JxzykcjdZ/jyxJDLlOV2l36AtcsJJb9boG3YcR3DuqODIE3ztYKPkDdmwRmpUToUaSaq++AvRgZMWbOpbQW8hdCAm8ZDugoikzREdCJ2okJPBx6azFLNOwoOgcxojJ98JkaTSJxMpklKrCAKhZGI0drTY/wU5lXoJYibannV9NYy4oozNEAkPHTjop+DTDxVGkIgYJNoyQQJtiIW+EMjGAjm649AjGIaqswcEFQKJ2QPlJbqytki6ZXAAZRJ52J2McaUowzAfs+uFzrYhnzaapphiPWdaJWShqxjqa6kTTQ205TVbsfMa6htL0iYOsXpJrQjHSmCkv1QGPtiHqlYcQ21Gj7fcDU8xOEUuNgSltPzexh+HqFlanCBHZ4OLhCV+gK/3OF6vWvucLv98MUOY2pwu/PS/+D2qJU7pYGbOvDFDW+bbON9p3o3oRxn0bfLgZTgSn6pSfrtr56qLHemtHPTK2319SzGvtjQ9qeb39WgS66Cm073nd0U1PzDdJCO3Gzn6TKpl9Zq7ujGWsQhlA3NwWIMwG9zM08Y/tBrR9VWeczv5CSQuuUNKIUTk23ZJ5RKfVhjnkXotfWIlgX2BSCDYbZR+QTcLhb3dKZDUY2M0d4KWItwhHRah/zsrOgKw4wycwjcgEVcgQDQo23CqSiWEJkFAfod2oE1uIFdA1OsCPqFXYNTjCfb8Ez+iX2x5sKLlVbhtqdDcar9ZevhnbZxoBUD35k23t0d304LYs1ELVbnfFaZ/REJJX9niP8Q19moZGo3m8XR/yBvOnjFfsXcI2c8ZuNo7WMP5HQh6yRGrlmFOJTnyTcT+zRlqPUBI2gTVWNUzUna1ERgecgF4GpNBQ38jGqxVLzQA1A31Rrhk6Yz9QEh/WND0GnuG9huhiTXJkxfAizTHLr6cbJKN6UCU6x/2DTRE1xEeEXi3O0ZUqBN4nJRzHhFB1JPlFTBZlI2kQ8zc3KJ1Le8DIRmFJiknuVS6RK4Ej/JtBfJErDSzOBiY4wJHX6Z1I4v1GUmdCPNirnLLeg3oJLcbX5PcpHNbRvOa1A956QmRPOUXVF+zkaUJynpkYR0bOMJH2nNej1pqyV/aKkz9jr5yj5vrXXz1F5SQLACiMapmierj2ikLyleKdlA/I/2oFxiglxx9B+mHwz0lf34IZQfhDRhlD6bhvgEAoPYooHkTczSIZTLC+cEExsoNKZiGBiY9cCfo/Y/SjIOBMQizWWTe73CMUasJx7jlD+DdKdWUKoY4PRYFtGpO0G1Lx4RaadgTtJhf4fiGqGIwKWCGuGIwKWqP+7IxYCzygjR9IAO5pC7Da9g70TBVpWRNgFBlgT8RV2WxHbKwJMv4BOaEaYaU2K16yZMN/qgV+G7IWIvwyZCxHeDQMsR8wg0DBDDXB5H2EV+hkEGmaoySHQsEJNFoGGFWrAq98JRhUMX1iMMMqLLEIpK5jCbd4vw9nSt/72lewXiN6jmdjfq8Hdknlk92ZwJnbIMMRM7JBhiFlUFoHd1UWaP1QKsPsHA5mkNB+Smn9JqV3wskatnQAAAABJRU5ErkJggg==" alt=""></td> 
                        @endif
                          <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>

                          <td>
                              @if ($user->last_login)
                                  <?php
                                  $lastLogin = is_string($user->last_login) ? new \Carbon\Carbon($user->last_login) : $user->last_login;
                                  ?>
                                  <span style="color: black" class="badge bg-label-primary me-1">{{ $lastLogin->format('d/m/Y') }}</span>
                              @else
                                  <span style="color: black" class="badge bg-label-primary me-1">N/V</span>
                              @endif
                          </td>
                          <td>{{ $user->created_at }}</td>

                        <td>
                          <button class="btn btn-primary btn-pd">
                            <a style="color: white" class="d-inline-block" href="{{route('staff-hrm.edit',[$user->id])}}">
                              <i class="bx bx-edit-alt me-1"></i> Sửa
                            </a>
                          </button> 
            
                       
                          <button type="button" class="btn btn-danger btn-pd" data-toggle="modal" data-target="#confirmationModal{{ $user->id }}">
                              <i class="bx bx-trash me-1"></i> Xóa
                          </button>
                          <div class="modal fade" id="confirmationModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <h5 class="modal-title" id="confirmationModalLabel">Xác nhận xóa</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                          </button>
                                      </div>
                                      <div class="modal-body">Bạn có chắc muốn xóa ? </div>
                                      <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>                                          <form action="{{ route('staff-hrm.destroy', ['id' => $user->id]) }}" method="POST" style="display: inline-block;">
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
            <form action="{{ route('staff-hrm.store') }}" method="POST" id="form-team" enctype="multipart/form-data">
              @csrf
              <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title" id="myModalLabel">Thêm nhân viên</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                    
                      <div class="row">
                        <div class="form-group col-lg-6">
                          <label for="Name">Họ và tên</label>
                          <input type="text" class="form-control" id="Name" placeholder="Nhập tên" name="name">
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
                            <option value="technical">Nhân viên Kỹ thuật</option>
                            <option value="Sales">Nhân viên Kinh doanh</option>
                            <option value="human_resources">Nhân viên Nhân sự</option>
                            <option value="no">Nhân viên</option>
                          </select>     
                          <span class="error-message" id="role-error"></span>
                        </div>

                        <div class="form-group col-lg-6">
                          <!-- <label for="business_id">Thuộc doanh nghiệp</label> -->
                          <input class="form-control" type="hidden" name="business_id" id="business_id" value="0">
                           
           
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
        searchDataTable(id_table,true, true, 20);

    });
</script>

@endsection