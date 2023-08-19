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
                      <th>Tên</th>
                      <th>action</th>
                    </tr>
                  </thead>
                  <tbody class="table-border-bottom-0">
                    @if(!empty($product_types))
                    @foreach($product_types as $product_type)
                    <tr>
                      <td>{{ $loop->index + 1 }}</td>
                      <td>{{ $product_type->name }}</td>
                   
                      <td>
                        <button class="btn btn-primary btn-pd">
                          <a style="color: white" class="d-inline-block" href="{{route('product-type.edit',[$product_type->id])}}">
                            <i class="bx bx-edit-alt me-1"></i> Sửa
                          </a>
                        </button> 
           

                        <button type="button" class="btn btn-danger btn-pd" data-toggle="modal" data-target="#confirmationModal{{ $product_type->id }}">
                              <i class="bx bx-trash me-1"></i> Xóa
                          </button>

                          <!-- Confirmation Modal -->
                          <div class="modal fade" id="confirmationModal{{ $product_type->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
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
                                          <form id="deleteForm{{ $product_type->id }}" action="{{ route('product-type.destroy', ['id' => $product_type->id]) }}" method="POST">
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
                    @endif
                  </tbody>
                </table>
        
                </div>

                <!-- Modal -->
                <form action="{{ route('product-type.store') }}" method="POST" id="form-business-package" enctype="multipart/form-data">
                    @csrf
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel">Thêm loại sản phẩm</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                    <div class="row">
                                    <div class="row">
                                        <div class="form-group col-lg-6">
                                            <label for="name">Loại sản phẩm</label>
                                            <input type="text" class="form-control" id="name" placeholder="Nhập loại sản phẩm" name="name" required>
                                            <span class="error-message" id="name-error"></span>
                                        </div>
                                    </div>

                                    <div class="row" id="attributes-container">
                                        <div class="form-group col-lg-6">
                                            <label for="attribute-title">Tiêu đề thuộc tính</label>
                                            <input type="text" class="form-control attribute-title" placeholder="Nhập tiêu đề thuộc tính">
                                        </div>
                                        <div class="form-group col-lg-4">
                                            <label for="attribute-req_name">Tên thuộc tính yêu cầu</label>
                                            <input type="text" class="form-control attribute-req_name" placeholder="Nhập tên thuộc tính yêu cầu">
                                        </div>
                                        <div class="form-group col-lg-2">
                                            <label>&nbsp;</label>
                                            <div class="btn btn-primary btn-block" id="add-attribute-btn">Thêm</div>
                                        </div>
                                    </div>

                                <div class="row" id="added-attributes-container">
                                    <!-- Thẻ div này sẽ chứa các thuộc tính đã thêm -->
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


<!-- Gọi hàm thêm search table -->
<script src="{{ asset('assets/js/data-table-js.js') }}"></script>
<script>
    $(document).ready(function() {

        var id_table = '#table_package';
        searchDataTable(id_table,true, true, 10);
    });
</script>
<script>
    $(document).ready(function () {
        let attributes = []; // Mảng lưu trữ các thuộc tính

        // Xử lý khi nhấn nút "Thêm thuộc tính"
        $("#add-attribute-btn").click(function () {
            const title = $(".attribute-title").val();
            const req_name = $(".attribute-req_name").val();

            if (title !== "" && req_name !== "") {
                // Thêm thuộc tính vào mảng attributes
                attributes.push({
                    title: title,
                    req_name: req_name
                });

                // Reset các input
                $(".attribute-title").val("");
                $(".attribute-req_name").val("");

                // Hiển thị các thuộc tính đã thêm
                displayAttributes();
            }
        });

        // Hiển thị các thuộc tính đã thêm
        function displayAttributes() {
            const addedAttributesContainer = $("#added-attributes-container");
            addedAttributesContainer.empty();

            attributes.forEach(function (attr, index) {
                const attributeDiv = `
                    <div class="form-group col-lg-6">
                        <input type="text" class="form-control" value="${attr.title}" readonly>
                        <input type="hidden" name="attributes[${index}][title]" value="${attr.title}">
                    </div>
                    <div class="form-group col-lg-4">
                        <input type="text" class="form-control" value="${attr.req_name}" readonly>
                        <input type="hidden" name="attributes[${index}][req_name]" value="${attr.req_name}">
                    </div>
                    <div class="form-group col-lg-2">
                        
                        <button class="btn btn-danger btn-block delete-attribute-btn" data-index="${index}">Xóa</button>
                    </div>
                `;

                addedAttributesContainer.append(attributeDiv);
            });

            // Xử lý khi nhấn nút "Xóa thuộc tính"
            $(".delete-attribute-btn").click(function () {
                const index = $(this).data("index");
                attributes.splice(index, 1);
                displayAttributes();
            });
        }
    });
</script>


@endsection