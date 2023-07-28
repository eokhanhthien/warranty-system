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
    <div class="card">
                <div class="text-right">
                      <button class="btn btn-primary float-right m-3" data-toggle="modal" data-target="#myModal"><i class='bx bx-plus'></i> Thêm</button>
                </div>
                <h5 class="card-header">Tất cả thành viên</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table" id="table_team">
                    <thead>
                      <tr>
                        <th>STT</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    @if(!empty($products))
                    <tbody class="table-border-bottom-0">
                      @foreach($products as $product)
                      <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $product->name }}</td>
                        @if(!empty($product->image))
                        <td><img  class="img-fluid w-50 h-50" src="https://drive.google.com/uc?export=view&id={{$product->image}}" alt=""></td>

                        @else
                         <td><img style = "width: 120px; height: 120px" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAAMFBMVEXFxcX////CwsLGxsb7+/vT09PJycn19fXq6urb29ve3t7w8PDOzs7n5+f5+fnt7e30nlkBAAAFHUlEQVR4nO2dC5qqMAyFMTwUBdz/bq+VYYrKKJCkOfXmXwHna5uTpA+KwnEcx3Ecx3Ecx3Ecx3Ecx3Ecx3Ecx3Ecx3EcA2iO9cdIc5PUdO257y+BU39u66b4HplE3fk6VIcnqmNfl1+gksr6+iIucjl3WYukor7+re6Hoe1y1UhNO3zUd+fUFRmKpOa0Tt6dY5ubRCrOG/QFLk1WGmnt/JxzykcjdZ/jyxJDLlOV2l36AtcsJJb9boG3YcR3DuqODIE3ztYKPkDdmwRmpUToUaSaq++AvRgZMWbOpbQW8hdCAm8ZDugoikzREdCJ2okJPBx6azFLNOwoOgcxojJ98JkaTSJxMpklKrCAKhZGI0drTY/wU5lXoJYibannV9NYy4oozNEAkPHTjop+DTDxVGkIgYJNoyQQJtiIW+EMjGAjm649AjGIaqswcEFQKJ2QPlJbqytki6ZXAAZRJ52J2McaUowzAfs+uFzrYhnzaapphiPWdaJWShqxjqa6kTTQ205TVbsfMa6htL0iYOsXpJrQjHSmCkv1QGPtiHqlYcQ21Gj7fcDU8xOEUuNgSltPzexh+HqFlanCBHZ4OLhCV+gK/3OF6vWvucLv98MUOY2pwu/PS/+D2qJU7pYGbOvDFDW+bbON9p3o3oRxn0bfLgZTgSn6pSfrtr56qLHemtHPTK2319SzGvtjQ9qeb39WgS66Cm073nd0U1PzDdJCO3Gzn6TKpl9Zq7ujGWsQhlA3NwWIMwG9zM08Y/tBrR9VWeczv5CSQuuUNKIUTk23ZJ5RKfVhjnkXotfWIlgX2BSCDYbZR+QTcLhb3dKZDUY2M0d4KWItwhHRah/zsrOgKw4wycwjcgEVcgQDQo23CqSiWEJkFAfod2oE1uIFdA1OsCPqFXYNTjCfb8Ez+iX2x5sKLlVbhtqdDcar9ZevhnbZxoBUD35k23t0d304LYs1ELVbnfFaZ/REJJX9niP8Q19moZGo3m8XR/yBvOnjFfsXcI2c8ZuNo7WMP5HQh6yRGrlmFOJTnyTcT+zRlqPUBI2gTVWNUzUna1ERgecgF4GpNBQ38jGqxVLzQA1A31Rrhk6Yz9QEh/WND0GnuG9huhiTXJkxfAizTHLr6cbJKN6UCU6x/2DTRE1xEeEXi3O0ZUqBN4nJRzHhFB1JPlFTBZlI2kQ8zc3KJ1Le8DIRmFJiknuVS6RK4Ej/JtBfJErDSzOBiY4wJHX6Z1I4v1GUmdCPNirnLLeg3oJLcbX5PcpHNbRvOa1A956QmRPOUXVF+zkaUJynpkYR0bOMJH2nNej1pqyV/aKkz9jr5yj5vrXXz1F5SQLACiMapmierj2ikLyleKdlA/I/2oFxiglxx9B+mHwz0lf34IZQfhDRhlD6bhvgEAoPYooHkTczSIZTLC+cEExsoNKZiGBiY9cCfo/Y/SjIOBMQizWWTe73CMUasJx7jlD+DdKdWUKoY4PRYFtGpO0G1Lx4RaadgTtJhf4fiGqGIwKWCGuGIwKWqP+7IxYCzygjR9IAO5pC7Da9g70TBVpWRNgFBlgT8RV2WxHbKwJMv4BOaEaYaU2K16yZMN/qgV+G7IWIvwyZCxHeDQMsR8wg0DBDDXB5H2EV+hkEGmaoySHQsEJNFoGGFWrAq98JRhUMX1iMMMqLLEIpK5jCbd4vw9nSt/72lewXiN6jmdjfq8Hdknlk92ZwJnbIMMRM7JBhiFlUFoHd1UWaP1QKsPsHA5mkNB+Smn9JqV3wskatnQAAAABJRU5ErkJggg==" alt=""></td> 
                        @endif
                         
                       
                        <td>
                          <button class="btn btn-primary">
                            <a style="color: white" class="d-inline-block" href="{{route('business-service.edit',[$product->id])}}">
                              <i class="bx bx-edit-alt me-1"></i> Sửa
                            </a>
                          </button> 
                          <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmationModal{{ $product->id }}">
                              <i class="bx bx-trash me-1"></i> Xóa
                          </button>
                          <div class="modal fade" id="confirmationModal{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
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
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>                                         
                                      <form action="{{ route('business-service.destroy', ['id' => $product->id]) }}" method="POST" style="display: inline-block;">
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
                    @endif
                  </table>
                </div>

            <!-- Modal -->
            <form action="{{ route('products.store') }}" method="POST" id="form-admin-product" enctype="multipart/form-data">
              @csrf
              <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-xl" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title" id="myModalLabel">Thêm sản phẩm</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body"> 
                    <div class="nav-align-top mb-4"> 
                          <div class="tab-pane fade active show" id="navs-justified-home" role="tabpanel">
                          <div class="form-group">
                            <label for="category"><h6 class="card-title text-primary">Danh mục </h6></label>
                                <select id="category" name="category" class="form-control" required>
                                    <option value="">Chọn một danh mục</option>
                                    <!-- Dùng Blade để hiển thị các tùy chọn cho categories -->
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="subcategory"><h6 class="card-title text-primary">Danh mục con </h6></label>
                                <select id="subcategory" name="subcategory" class="form-control" required>
                                    <option value="">Chọn một danh mục con</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="name"><h6 class="card-title text-primary">Tên sản phẩm  </h6> </label>
                                <input type="text" class="form-control" id="name" name="name" value ="{{!empty($business_service->name) ? $business_service->name : '' }}">
                                <span class="error-message" id="name-error"></span>
                            </div>

                            <h6 class="card-title text-primary">Ảnh</h6>
                            <div class="thumbnails row">
                            <div class="thumbnail col-lg-2 col-sm-4 col-md-3 col-6 mb-3">
                                  <label for="imageInput">
                                      <img src="https://via.placeholder.com/150" alt="Ảnh mới" id="imageThumbnail">
                                  </label>
                                  <input type="file" id="imageInput" name="image" accept="image/*" style="display:none;">
                              </div>

                                @for($i = 0; $i < 7; $i++)
                                    <div class="thumbnail col-lg-2 col-sm-4 col-md-3 col-6 mb-3">
                                        <label for="thumbnailInput{{$i}}">
                                            <img src="https://via.placeholder.com/150" alt="Ảnh {{$i+1}}" id="thumbnail{{$i}}">
                                            <!-- <p>Ảnh {{$i+1}}</p> -->
                                        </label>
                                        <input type="file" id="thumbnailInput{{$i}}" name="images[{{$i}}]" accept="image/*" style="display:none;">
                                    </div>
                                @endfor
                            </div>
                          
                        </div>
                        <input type="file" id="imageInput" accept="image/*" style="display:none;">
                        <input type="hidden" id="selectedImagesData" name="images[]" value="">

                        <input type="hidden" id="" name="image_width" value="200" >
                        <input type="hidden" id="" name="image_height" value="300" >

                        <div class="form-group">
                                <label for="price"><h6 class="card-title text-primary">Giá sản phẩm </h6> </label>
                                <input type="text" class="form-control" id="price" name="price" value ="{{!empty($business_service->name) ? $business_service->name : '' }}">
                                <span class="error-message" id="price-error"></span>
                        </div>

                        <div class="form-group">
                                <label for="stock"><h6 class="card-title text-primary">Kho hàng </h6> </label>
                                <input type="text" class="form-control" id="stock" name="stock" value ="{{!empty($business_service->name) ? $business_service->name : '' }}">
                                <span class="error-message" id="stock-error"></span>
                        </div>

                        
                        <div id="variants" >
                        <div class="btn btn-success col-lg-2" onclick="addVariant()">Thêm biến thể</div>
                        </div>
                        <div onclick="generateTable()" class="mt-2 mb-2 form-control btn btn-dark btn-create-variant" style="display: none">Tạo bảng</div>

                        <!-- Bảng hiển thị giá cho từng giá trị thuộc tính của biến thể -->
                        <div class="card p-2">
                        <table id="variantTable">
                        <tr>
                            <th>Biến thể 1</th>
                            <th>Biến thể 2</th>
                            <th>Giá</th>
                            <th>Kho hàng</th>
                        </tr>
                        </table>
                        </div>
                        
                        <label for=""><h6 class="card-title text-primary mt-4">Thuộc tính sản phẩm </h6> </label>
                        <select id="productTypeSelect" class="form-control ">
                            <option value="">Chọn dữ liệu mâu</option>
                            @foreach($product_types as $product_type)
                                <option value="{{ $product_type->id }}">{{ $product_type->name }}</option>
                            @endforeach
                        </select>

                        <div id="attributes-container">
                          <!-- The attributes will be populated dynamically through JavaScript -->
                      </div>

                        <h6 class="card-title text-primary mt-3">Mô tả chi tiết sản phẩm</h6> 
                        @include('ckeditor.ckeditor')  
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

<!-- Js thêm -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const numThumbnails = 7;
        for (let i = 0; i < numThumbnails; i++) {
            const thumbnailInput = document.getElementById(`thumbnailInput${i}`);
            thumbnailInput.addEventListener('change', function (event) {
                const thumbnailIndex = i;
                const files = event.target.files;

                if (files && files.length > 0) {
                    const file = files[0];
                    const reader = new FileReader();
                    reader.onload = function () {
                        const imageDataUrl = reader.result;
                        const thumbnailImg = document.getElementById(`thumbnail${thumbnailIndex}`);
                        if (thumbnailImg) {
                            thumbnailImg.src = imageDataUrl;
                        }
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

      // Xử lý sự kiện chọn ảnh mới với name="image"
      const imageInput = document.getElementById('imageInput');
      imageInput.addEventListener('change', function (event) {
          const files = event.target.files;

          if (files && files.length > 0) {
              const file = files[0];
              const reader = new FileReader();
              reader.onload = function () {
                  const imageDataUrl = reader.result;
                  const imageThumbnail = document.getElementById('imageThumbnail');
                  if (imageThumbnail) {
                      imageThumbnail.src = imageDataUrl;
                  }
              };
              reader.readAsDataURL(file);
          }
      });

    });
</script>

<script>
  let variantCount = 0;

  function addVariant() {
    if (variantCount < 2) { // Giới hạn tối đa 2 biến thể
      variantCount++;
      const variantDiv = document.createElement("div");
      variantDiv.classList.add("card", "p-2", "mt-2", "mb-4");
      variantDiv.innerHTML = `
        <label>Biến thể ${variantCount}: </label>
        <input type="text" class="form-control mb-2" name="variant[${variantCount}][name]" placeholder="Tên biến thể">
        <div class="btn btn-success" onclick="addAttributeValue(${variantCount})">Thêm giá trị</div>
        <div id="values${variantCount}"></div>
      `;
      document.getElementById("variants").appendChild(variantDiv);
    }
  }

  function addAttributeValue(variantIndex) {
    const valuesDiv = document.getElementById(`values${variantIndex}`);
    if (valuesDiv.childElementCount < 4) { // Giới hạn tối đa 4 giá trị cho mỗi biến thể
      const valueDiv = document.createElement("div");
      valueDiv.classList.add("d-flex", "mb-2");
      valueDiv.innerHTML = `
        <input type="text" class="mt-2 mb-2 form-control col-lg-2 input-variant" name="variant[${variantIndex}][values][${valuesDiv.childElementCount}][value]" placeholder="Giá trị biến thể">
        <div class="btn btn-danger mt-2 mb-2" onclick="removeValue(${variantIndex}, ${valuesDiv.childElementCount})"><i class="bx bx-trash me-1"></i></div>
      `;
      valuesDiv.appendChild(valueDiv);
    }
  }

  function removeValue(variantIndex, valueIndex) {
    const valuesDiv = document.getElementById(`values${variantIndex}`);
    const valueToRemove = document.querySelector(`[name="variant[${variantIndex}][values][${valueIndex}][value]"]`);
    if (valueToRemove) {
      valuesDiv.removeChild(valueToRemove.parentElement);
    }
  }

  function generateTable() {
    const table = document.getElementById("variantTable");
    const variantNames = []; // Mảng lưu trữ tên biến thể
    table.innerHTML = `
      <tr>
        <th>Biến thể 1</th>
        <th>Biến thể 2</th>
        <th>Giá</th>
        <th>Kho hàng</th>
      </tr>
    `;

    const variants = document.querySelectorAll("[id^='values']");
    const variantCounts = Array.from(variants).map((variant) => variant.childElementCount);

    // Kiểm tra nếu chỉ có một biến thể, thì đặt variantCounts[1] thành 1
    if (variantCounts.length === 1) {
      variantCounts.push(1);
    }

    // Lưu trữ tên biến thể vào mảng variantNames
    for (let i = 1; i <= variantCount; i++) {
      const variantNameInput = document.querySelector(`[name="variant[${i}][name]"]`);
      variantNames.push(variantNameInput.value);
    }

    for (let i = 0; i < variantCounts[0]; i++) {
      for (let j = 0; j < variantCounts[1]; j++) {
        const newRow = document.createElement("tr");
        newRow.innerHTML = `
          <td>${getVariantValue(1, i)}</td>
          <td>${getVariantValue(2, j)}</td>
          <td><input type="text" class="mt-2 mb-2 form-control" name="price_${i}_${j}" placeholder="Giá" required></td>
          <td><input type="text" class="mt-2 mb-2 form-control" name="stock_${i}_${j}" placeholder="Kho hàng" required></td>
        `;
        table.appendChild(newRow);
      }
    }

    // Cập nhật lại tiêu đề của bảng dựa trên tên biến thể
    const thElements = table.getElementsByTagName("th");
    for (let i = 0; i < variantNames.length; i++) {
      thElements[i].textContent = variantNames[i];
    }
  }

  function getVariantValue(variantIndex, valueIndex) {
    const variantValues = document.querySelectorAll(`[name="variant[${variantIndex}][values][${valueIndex}][value]"]`);
    return variantValues.length > 0 ? variantValues[0].value : "";
  }
</script>



<!-- Gọi hàm validate để xử lý form -->
<script src="{{ asset('assets/js/validateForm.js') }}"></script>
<!-- Gọi hàm thêm search table -->
<script src="{{ asset('assets/js/data-table-js.js') }}"></script>
<script>
    $(document).ready(function() {
        var formId = '#form-admin-product';
        var validateUrl = '/validate-admin-product';

        setupFormValidation(formId, validateUrl);

        var id_table = '#table_team';
        searchDataTable(id_table,true, true, 10);

    });
</script>

<script>
    // Sử dụng jQuery (yêu cầu thư viện jQuery đã được bao gồm trong trang)
    $(document).ready(function() {
        // Gán sự kiện "change" cho select category
        $('#category').on('change', function() {
            var category_id = $(this).val(); // Lấy giá trị category_id được chọn

            // Gọi Ajax để lấy danh sách sub_category dựa vào category_id
            $.ajax({
                url: '{{ route('getSubcategories', ['category_id' => ':category_id']) }}'.replace(':category_id', category_id),
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    // Xóa tất cả các option hiện tại trong select sub_category
                    $('#subcategory').empty();

                    // Thêm các option mới từ response
                    $('#subcategory').append('<option value="">Chọn một danh mục con</option>');
                    $.each(response, function(index, subcategory) {
                        $('#subcategory').append('<option value="' + subcategory.id + '">' + subcategory.name + '</option>');
                    });
                },
                error: function(xhr) {
                    // Xử lý lỗi nếu cần
                    console.log(xhr.responseText);
                }
            });
        });
    });
</script>


<script>
    // JavaScript code to handle the product type selection and fetch attributes through Ajax
    $(document).ready(function () {
        // Handle product type selection change event
        $("#productTypeSelect").on("change", function () {
          const productTypeId = $(this).val();
          if (productTypeId === "") {
              // If the selected option has an empty value, clear the attributes container
              $("#attributes-container").empty();
          } else {
              // If a valid product type is selected, fetch and display the attributes
              fetchProductTypeAttributes(productTypeId);
          }
        });

        // Function to fetch and display product type attributes
        function fetchProductTypeAttributes(productTypeId) {
            // Make an Ajax request to fetch the product type attributes
            $.ajax({
                url: "/admin/get-product-type-attributes/" + productTypeId,
                method: "GET",
                dataType: "json",
                success: function (response) {
                    // Clear the existing attributes in the container
                    $("#attributes-container").empty();
                    // Loop through the attributes and create corresponding HTML elements
                    for (const attributeId in response) {
                        const attribute = response[attributeId];
                        const attributeDiv = `<div class="form-group">
                            <label>${attribute.title}</label>
                            <input type="text" name="attributes[${attribute.req_name}]" class="form-control">
                        </div>`;
                        // Append the attribute div to the container
                        $("#attributes-container").append(attributeDiv);
                    }
                },
                error: function (xhr, status, error) {
                    console.error(error);
                },
            });
        }
    });
</script>
<script>
    // Bắt sự kiện khi người dùng nhập giá trị vào input có class "input-variant"
    $(document).on('input', '.input-variant', function() {
        // Tự động kích hoạt sự kiện click trên nút "btn-create-variant"
        $('.btn-create-variant').click();
    });

</script>
@endsection