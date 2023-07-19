@extends('layouts.superadmin')
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
<div class="card">
                <div class="text-right">
                      <button class="btn btn-primary float-right m-3" data-toggle="modal" data-target="#myModal"><i class='bx bx-plus'></i> Thêm</button>
                </div>
                <h5 class="card-header">Tất cả gói</h5>
                <div class="table-responsive text-nowrap">
                <table class="table" id="table_package">
                  <thead>
                    <tr>
                      <th>STT</th>
                      <th>Name</th>
                      <th>Danh mục</th>
                      <th>Giá</th>
                      <th>Thời gian</th>
                      <th>action</th>
                    </tr>
                  </thead>
                  <tbody class="table-border-bottom-0">
                    @foreach($packages as $package)
                    <tr>
                      <td>{{ $loop->index + 1 }}</td>
                      <td>{{ $package->name }}</td>
                      <td>
                            @php
                            $businessCategory = App\BusinessCategory::find($package->business_category_id);
                            if ($businessCategory) {
                                echo $businessCategory->vi_name;
                            }
                            @endphp
                        </td>

                      <td>{{ number_format($package->price)  }} đ</td>
                      <td>
                        {{ number_format($package->time) }}
                            @if($package->type == "month")
                                tháng
                            @elseif($package->type == "year")
                                năm
                            @else
                                ngày
                            @endif</td>
                      <td>
                        <button class="btn btn-primary">
                          <a style="color: white" class="d-inline-block" href="{{route('businesses-package.edit',[$package->id])}}">
                            <i class="bx bx-edit-alt me-1"></i> Sửa
                          </a>
                        </button> 
           

                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmationModal{{ $package->id }}">
                              <i class="bx bx-trash me-1"></i> Xóa
                          </button>

                          <!-- Confirmation Modal -->
                          <div class="modal fade" id="confirmationModal{{ $package->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
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
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button> 
                                          <form id="deleteForm{{ $package->id }}" action="{{ route('businesses-package.destroy', ['id' => $package->id]) }}" method="POST">
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
                <form action="{{ route('businesses-package.store') }}" method="POST" id="form-business-package" enctype="multipart/form-data">
                    @csrf
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel">Thêm gói đăng ký</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label for="name">Tên gói</label>
                                        <input type="text" class="form-control" id="name" placeholder="Nhập tên gói" name="name" >
                                        <span class="error-message" id="name-error"></span>
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
                                    <label for="price">Giá</label>
                                    <div class="input-group col-lg-12 ">
                                        <span class="input-group-text">VNĐ</span>
                                        <input type="text" class="form-control" placeholder="Giá gói đăng ký" aria-label="Amount (to the nearest dollar)" name ="price" id="price">
                                    </div>
                                    <span class="error-message" id="price-error"></span>

                                    <div class="form-group col-lg-6">                 
                                        <label for="time">Thời gian:</label>
                                        <input type="number" id="time" name="time" min="0" class="form-control" placeholder="Nhập thời gian">
                                        <span class="error-message" id="time-error"></span>
                                    </div>

                                    <div class="form-group col-lg-6">                 
                                    <label for="type">Kiểu:</label>
                                        <select id="type" name="type" class="form-control">
                                        <option value="day">Ngày</option>
                                        <option value="month">Tháng</option>
                                        <option value="year">Năm</option>
                                        </select>
                                    </div>

                                    <!-- <div class="form-group col-lg-6">                 
                                        <label for="quantity_category">Số lượng danh mục sản phẩm:</label>
                                        <input type="number" id="quantity_category" name="quantity_category" min="1" class="form-control" placeholder="Nhập số lượng danh mục sản phẩm">
                                        <span class="error-message" id="quantity_category-error"></span>
                                    </div>

                                    <div class="form-group col-lg-6">                 
                                        <label for="quantity_product">Số lượng sản phẩm:</label>
                                        <input type="number" id="quantity_product" name="quantity_product" min="1" class="form-control" placeholder="Nhập số lượng sản phẩm">
                                        <span class="error-message" id="quantity_product-error"></span>
                                    </div>

                                    <div class="form-group col-lg-6">                 
                                        <label for="quantity_employee">Số lượng nhân viên:</label>
                                        <input type="number" id="quantity_employee" name="quantity_employee" min="1" class="form-control" placeholder="Nhập số lượng nhân viên">
                                        <span class="error-message" id="quantity_employee-error"></span>
                                    </div> -->

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

<!-- Gọi hàm thêm search table -->
<script src="{{ asset('assets/js/data-table-js.js') }}"></script>
<script>
    $(document).ready(function() {
        var formId = '#form-business-package';
        var validateUrl = '/validate-business-package';

        setupFormValidation(formId, validateUrl);

        var id_table = '#table_package';
        searchDataTable(id_table,true, true, 10);
    });
</script>
@endsection