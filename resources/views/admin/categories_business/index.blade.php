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
    <div class="container mt-5" >
    <button class="btn btn-primary btn-pd" data-toggle="modal" data-target="#addCategoryModal">Thêm danh mục</button>
    <button class="btn btn-primary btn-pd" data-toggle="modal" data-target="#addSubCategoryModal">Thêm danh mục con</button>

    <!-- Bảng danh mục -->

    <div class="card mt-4">
    <h5 class="card-header">Tất cả danh mục</h5>
        <div class="table-responsive text-nowrap">
    <table class="table table-bordered" id="table_categories_1">
      <thead>
        <tr>
          <th>STT</th>
          <th>Tên danh mục</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <!-- Hiển thị danh sách danh mục từ CSDL (nếu có) -->
        @foreach($categories as $category)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $category->name }}</td>
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
                                    <form id="deleteForm{{ $category->id }}" action="{{ route('categories.destroy', ['id' => $category->id]) }}" method="POST">
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
                                    <h5 class="modal-title" id="editModalLabel">Sửa danh mục</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                        <form action="{{ route('categories.update',['id' => $category->id]) }}" method="POST" >
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <label for="categoryName">Tên danh mục:</label>
                                                <input type="text" class="form-control" id="categoryName" name="name" value="{{$category->name}}" require>
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
    <div class="card mt-4">
    <h5 class="card-header">Tất cả danh mục con</h5>
    <div class="table-responsive text-nowrap">
    <table class="table table-bordered" id="table_categories_2">
      <thead>
        <tr>
          <th>ID</th>
          <th>Tên danh mục con</th>
          <th>Danh mục cha</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
      @foreach($subcategories as $subcategory)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $subcategory->name }}</td>
                <td>{{ $subcategory->parrent_category->name }}</td>
                <td>
                <button class="btn btn-primary btn-pd" data-toggle="modal" data-target="#editModal_sub{{ $subcategory->id }}">
                    <i class="bx bx-edit-alt me-1"></i> Sửa
                </button> 


                <button type="button" class="btn btn-danger btn-pd" data-toggle="modal" data-target="#confirmationModal{{ $subcategory->id }}">
                        <i class="bx bx-trash me-1"></i> Xóa
                </button>

                    <!-- Confirmation Modal -->
                    <div class="modal fade" id="confirmationModal{{ $subcategory->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
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
                                    <form id="deleteForm{{ $subcategory->id }}" action="{{ route('categories.destroy', ['id' => $subcategory->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden"  name="type" value = "subcategory">
                                        <button type="submit" class="btn btn-danger">Xóa</button>                                          
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                        <!-- editModal_sub -->
                        <div class="modal fade" id="editModal_sub{{ $subcategory->id }}" tabindex="-1" role="dialog" aria-labelledby="editModal_subLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModal_subLabel">Sửa danh mục</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                        <form action="{{ route('categories.update',['id' => $subcategory->id]) }}" method="POST" >
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <label for="subCategoryName">Tên danh mục con:</label>
                                                <input type="text" class="form-control" id="subCategoryName" name="name" value = "{{$subcategory->name}}">
                                                <input type="hidden"  name="type" value = "subcategory">
                                            </div>
                                            <div class="form-group">
                                                <label for="parentCategory">Danh mục cha:</label>
                                                <select class="form-control" id="parentCategory" name="category_id">
                                                    <option value="">Chọn danh mục</option>
                                                    @foreach($categories as $category)
                                                        <option value="{{$category->id}}" {{$category->id == $subcategory->category_id ? 'selected' : ''}} >{{$category->name}}</option>
                                                    @endforeach
                                                </select>
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
    <!-- Modal thêm danh mục -->
    <div class="modal fade" id="addCategoryModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Thêm danh mục</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <form action="{{ route('categories.store') }}" method="POST" >
            @csrf
              <div class="form-group">
                <label for="categoryName">Tên danh mục:</label>
                <input type="text" class="form-control" id="categoryName" name="name" required>
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

    <!-- Modal thêm danh mục con -->
    <div class="modal fade" id="addSubCategoryModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Thêm danh mục con</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <form action="{{ route('categories.store') }}" method="POST" >
            @csrf
              <div class="form-group">
                <label for="subCategoryName">Tên danh mục con:</label>
                <input type="text" class="form-control" id="subCategoryName" name="name" required>
                <input type="hidden"  name="type" value = "subcategory">
              </div>
              <div class="form-group">
                <label for="parentCategory">Danh mục cha:</label>
                <select class="form-control" id="parentCategory" name="category_id" required>
                    <option value="">Chọn danh mục</option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
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
</div>
<script src="{{ asset('assets/js/data-table-js.js') }}"></script>
<script>
    $(document).ready(function() {

        var id_table = '#table_categories_1';
        var id_table2 = '#table_categories_2';
        searchDataTable(id_table,true, true,10);
        searchDataTable(id_table2,true, true,10);
    });
</script>
@endsection
