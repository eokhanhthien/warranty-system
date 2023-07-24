@extends('layouts.superadmin')
@section('content')
@section('title', 'Giao diện')
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
    <div class="row">
    <form action="{{ route('product-type.update', ['id' => $product_types->id ]) }}" method="POST" id="form-business-package" enctype="multipart/form-data">
    @csrf
    @method('PUT')
                                    <div class="row">
                                        <div class="form-group col-lg-6">
                                            <label for="name">Loại sản phẩm</label>
                                            <input type="text" class="form-control" id="name" placeholder="Nhập loại sản phẩm" name="name" value="{{$product_types->name}}">
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
                                <div id="attributes-container">
    @php
        $attributes = json_decode($product_types->attributes, true);
    @endphp
    @foreach($attributes as $index => $attribute)
    <div class="row">
        <div class="form-group col-lg-6">
            <input type="text" class="form-control" value="{{ $attribute['title'] }}" readonly>
            <input type="hidden" name="attributes[{{ $index }}][title]" value="{{ $attribute['title'] }}">
        </div>
        <div class="form-group col-lg-4">
            <input type="text" class="form-control" value="{{ $attribute['req_name'] }}" readonly>
            <input type="hidden" name="attributes[{{ $index }}][req_name]" value="{{ $attribute['req_name'] }}">
        </div>
        <div class="form-group col-lg-2">
            <button class="btn btn-danger btn-block delete-attribute-btn" data-index="{{ $index }}">Xóa</button>
        </div>
    </div>
    @endforeach
</div>

<!-- Các input mới sẽ được thêm vào container này -->
<div id="new-attributes-container"></div>


                      
                                </div>



                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                    <button type="submit" class="btn btn-primary" id="submit-btn">Lưu</button>
                                </div>
</form>
                            </div>
    </div>
</div>

<script>
    // Định nghĩa biến attributes ở đây để có thể truy cập từ cả hai event handler
    let attributes = @json($attributes);

    $(document).ready(function () {
        // Tính số lượng thuộc tính đã có sẵn
        let existingAttributesCount = {{ count($attributes) }};
        let newAttributesCount = 0;

        // Xử lý khi nhấn nút "Thêm thuộc tính"
        $("#add-attribute-btn").click(function () {
            const title = $(".attribute-title").val();
            const req_name = $(".attribute-req_name").val();

            if (title !== "" && req_name !== "") {
                // Tăng biến đếm cho thuộc tính mới và tính index cho nó
                newAttributesCount++;
                let newIndex = existingAttributesCount + newAttributesCount;

                // Tạo HTML cho các thuộc tính mới với index tăng lên
                const attributeDiv = `<div class="row">
                    <div class="form-group col-lg-6">
                        <input type="text" class="form-control" value="${title}" readonly>
                        <input type="hidden" name="attributes[${newIndex}][title]" value="${title}">
                    </div>
                    <div class="form-group col-lg-4">
                        <input type="text" class="form-control" value="${req_name}" readonly>
                        <input type="hidden" name="attributes[${newIndex}][req_name]" value="${req_name}">
                    </div>
                    <div class="form-group col-lg-2">
                        <button class="btn btn-danger btn-block delete-attribute-btn" data-index="${newIndex}">Xóa</button>
                    </div>
                </div>`;

                // Thêm vào container "new-attributes-container"
                $("#new-attributes-container").append(attributeDiv);

                // Reset các input
                $(".attribute-title").val("");
                $(".attribute-req_name").val("");
            }
        });

        // Xử lý khi nhấn nút "Xóa thuộc tính"
        $(document).on("click", ".delete-attribute-btn", function () {
            const index = $(this).data("index");

            // Xóa thuộc tính khỏi mảng attributes
            // Các thuộc tính mới được lưu trong mảng newAttributesCount
            if (index >= existingAttributesCount) {
                const newAttributesIndex = index - existingAttributesCount;
                newAttributesCount--;
                attributes.splice(newAttributesIndex, 1);
            }

            // Xóa div chứa thuộc tính
            $(this).closest(".row").remove();
        });
    });
</script>
@endsection