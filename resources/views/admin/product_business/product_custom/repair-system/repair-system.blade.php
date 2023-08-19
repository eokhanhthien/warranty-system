
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

                    <input type="hidden" id="" name="image_width" value="400" >
                    <input type="hidden" id="" name="image_height" value="600" >

                    <div class="form-group">
                            <label for="price"><h6 class="card-title text-primary">Giá sản phẩm </h6> </label>
                            <input type="text" class="form-control" id="price" name="price" value ="{{!empty($business_service->name) ? $business_service->name : '' }}">
                            <span class="error-message" id="price-error"></span>
                    </div>

                    <div class="form-group">
                            <label for="warehouse"><h6 class="card-title text-primary">Kho hàng </h6> </label>
                            <input type="text" class="form-control" id="warehouse" name="warehouse" value ="{{!empty($business_service->name) ? $business_service->name : '' }}">
                            <span class="error-message" id="warehouse-error"></span>
                    </div>

                    
                    <div id="variants" >
                    <div class="btn btn-success col-lg-2" onclick="addVariant()">Thêm biến thể</div>
                    </div>
                    <div onclick="generateTable()" class="mt-2 mb-2 form-control btn btn-dark">Tạo bảng</div>

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
                    <h6 class="card-title text-primary">Mô tả chi tiết sản phẩm</h6> 
                    @include('ckeditor.ckeditor')  
        </div>    
<!-- Chọn ảnh -->
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
        <input type="text" class="mt-2 mb-2 form-control col-lg-2" name="variant[${variantIndex}][values][${valuesDiv.childElementCount}][value]" placeholder="Giá trị biến thể">
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
    if (variantCounts.length == 1) {
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
          <td><input type="text" class="mt-2 mb-2 form-control" name="price_${i}_${j}" placeholder="Giá"></td>
          <td><input type="text" class="mt-2 mb-2 form-control" name="stock_${i}_${j}" placeholder="Kho hàng"></td>
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

