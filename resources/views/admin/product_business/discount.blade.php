@extends('layouts.superadmin')
@section('content')
<?php
// echo "<pre>";
// print_r(session()->get('businesses'));die;
?>
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
        <button class="btn btn-primary btn-pd" data-toggle="modal" data-target="#addCategoryModal">Thêm mã giảm giá</button>
    </div>

    <!-- Bảng danh mục -->

    <div class="card mt-4">
    <h5 class="card-header">Tất cả danh mục</h5>
        <div class="table-responsive text-nowrap">
    <table class="table table-bordered" id="table_categories_1">
      <thead>
        <tr>
          <th>STT</th>
          <th>Tên mã giảm</th>
          <th>CODE</th>
          <th>Số tiền giảm</th>
          <th>Ngày bắt đầu</th>
          <th>Ngày kết thúc</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
      @foreach($discount_codes as $category)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->code }}</td>
                <td>{{  number_format ($category->amount) }} đ</td>
                <td>{{ $category->start_at }}</td>
                <td>{{ $category->expires_at }}</td>
                <td>
                <button class="btn btn-primary btn-pd" data-toggle="modal" data-target="#editModal{{ $category->id }}">
                    <i class="bx bx-edit-alt me-1"></i> Sửa
                </button> 


                <button type="button" class="btn btn-danger btn-pd" data-toggle="modal" data-target="#confirmationModal{{ $category->id }}">
                        <i class="bx bx-trash me-1"></i> Xóa
                    </button>

                    <!-- Confirmation Modal -->
                    <div class="modal fade" id="confirmationModal{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
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
                                    <form id="deleteForm{{ $category->id }}" action="{{ route('product.discounts.delete', ['id' => $category->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden"  name="type" value = "category">
                                        <button type="submit" class="btn btn-danger">Xóa</button>                                          
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- editModal -->
                    <div class="modal fade" id="editModal{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel">Sửa mã giảm</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                        <form action="{{ route('product.discounts.update',['id' => $category->id]) }}" method="POST" >
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <label for="categoryName">Tên mã giảm:</label>
                                                <input type="text" class="form-control" id="categoryName" name="name" value="{{$category->name}}" require placeholder="VD: Điện thoại">
                                                <input type="hidden"  name="type" value = "category">
                                            </div>
                                            <div class="form-group">
                                                <label for="categoryName">CODE:</label>
                                                <input type="text" class="form-control" id="categoryName" name="code" value="{{$category->code}}" require placeholder="VD: Điện thoại">
                                                <input type="hidden"  name="type" value = "category">
                                            </div>
                                            <div class="form-group">
                                                <label for="categoryName">Số tiền giảm:</label>
                                                <input type="text" class="form-control" id="categoryName" name="amount" value="{{$category->amount}}" require placeholder="VD: Điện thoại">
                                                <input type="hidden"  name="type" value = "category">
                                            </div>
                                            <div class="form-group">
                                                <label for="categoryName">Ngày bắt đầu:</label>
                                                <input type="text" class="form-control" id="categoryName" name="start_at" value="{{$category->start_at}}" require placeholder="VD: Điện thoại">
                                                <input type="hidden"  name="type" value = "category">
                                            </div>
                                            <div class="form-group">
                                                <label for="categoryName">Ngày kết thúc:</label>
                                                <input type="text" class="form-control" id="categoryName" name="expires_at" value="{{$category->expires_at}}" require placeholder="VD: Điện thoại">
                                                <input type="hidden"  name="type" value = "category">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                                <button type="submit" class="btn btn-primary" id="submit-btn">Lưu</button>
                                            </div>
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
    </div>
    <!-- Bảng danh mục con -->
 
    <!-- Modal Thêm mã giảm giá -->
    <div class="modal fade" id="addCategoryModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Thêm mã giảm giá</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <form action="{{ route('product.discounts.create') }}" method="POST" >
            @csrf
                <div class="form-group">
                    <label for="name"><h6 class="card-title text-primary">Tên mã giảm giá  </h6> </label>
                    <input type="text" class="form-control" id="name" name="name" value ="{{!empty($business_service->name) ? $business_service->name : '' }}" placeholder="VD: Mã giảm giá khai trương" required>
                    <span class="error-message" id="name-error"></span>

                </div>
                <div class="form-group">
                    <label for="code"><h6 class="card-title text-primary">Mã giảm giá (CODE) </h6> </label>
                    <input type="text" class="form-control" id="code" name="code" value ="{{!empty($business_service->name) ? $business_service->name : '' }}" placeholder="VD: MAGIAMGIA01" required>
                    <span class="error-message" id="code-error"></span>
                </div>
                <div class="form-group">
                    <label for="amount"><h6 class="card-title text-primary">Số tiền giảm </h6> </label>
                    <input type="text" class="form-control" id="amount" name="amount" value ="{{!empty($business_service->name) ? $business_service->name : '' }}" placeholder="VD: 100000" required>
                    <span class="error-message" id="amount-error"></span>
                </div>
                <div class="form-group">
                    <label for="start_at"><h6 class="card-title text-primary">Ngày bắt đầu </h6> </label>
                    <input type="date" class="form-control" id="start_at" name="start_at" value ="{{!empty($business_service->name) ? $business_service->name : '' }}" required>
                    <span class="error-message" id="start_at-error"></span>
                </div>
                <div class="form-group">
                    <label for="expires_at"><h6 class="card-title text-primary">Ngày kết thúc </h6> </label>
                    <input type="date" class="form-control" id="expires_at" name="expires_at" value ="{{!empty($business_service->name) ? $business_service->name : '' }}" required>
                    <span class="error-message" id="expires_at-error"></span>
                </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary" id="submit-btn">Lưu</button>
                    </div>
            </form>
          </div>
        </div>
      </div>
    </div>



    </div>
</div>
<script src="{{ asset('assets/js/data-table-js.js') }}"></script>
<script>
    // $(document).ready(function() {

    //     var id_table = '#table_categories_1';
    //     var id_table2 = '#table_categories_2';
    //     searchDataTable(id_table,true, true,10);
    //     searchDataTable(id_table2,true, true,10);
    // });
</script>
@endsection
