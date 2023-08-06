@extends('view-seller.repair-system.repair-system.layout.layout')
@section('content')
  <!-- Page Header Start -->
  <div class="container-fluid page-header mb-5 py-5">
        <div class="container">
            <h1 class="display-3 text-white mb-3 animated slideInDown">Tất cả sản phẩm</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb text-uppercase">
                    <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">About</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->
    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-3 col-md-3 " data-wow-delay="0.1s">
                <div id="sidebar">  
                <h3>CATEGORIES</h3>
                <form id="filterForm">
    <div class="checklist categories">
        @if(!empty($product_categories))
            @foreach($product_categories as $category)
                <div class="category-link" data-category="{{ $category->id }}">
                    {{$category->name}}
                </div>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    @if(!empty($product_subcategories))
                        @foreach($product_subcategories as $subcategory)
                            @if($subcategory->category_id === $category->id)
                                <label class="dropdown-item subcategory-option">
                                    <input type="checkbox" name="subcategories[]" value="{{ $subcategory->id }}">
                                    {{$subcategory->name}}
                                </label>
                            @endif
                        @endforeach
                    @endif
                </div>
            @endforeach
        @endif
    </div>


</form>



                    
                                     
                </div>
                </div>
                <div class="col-lg-9 col-md-9 " data-wow-delay="0.3s">
           
                    <div class="row" id="list_product">
                        @if(!empty($products))
                        @foreach($products as $product)
                        <div class="product col-lg-3 col-6" style="z-index: 1;">
                            <div class="make3D">
                                
                                    <div class="shadow"></div>
                                    <!-- <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/1.jpg" alt=""> -->
                                    <img  class="" src="https://drive.google.com/uc?export=view&id={{$product->image}}" alt="" style ="width: 100%">

                                    <div class="image_overlay"></div>
                                    <div class="add_to_cart">Thêm giỏ hàng</div>
                                    <a href="{{route('seller.business.detail.product', ['domain' => request()->segment(2), 'category_slug' => request()->segment(3), 'id' => $product->id ])}}"><div class="view_gallery">Xem chi tiết</div></a>  
                                    <div class="p-3">          
                                        <span class="product_name">{{$product->name}}</span>    
                                        <p class="text-primary">{{number_format($product->price)}} đ</p>                                                 
                                        <div class="product-options">
                                            <strong>SIZES</strong>
                                            <span>XS, S, M, L, XL, XXL</span>                     
                                        </div>  
                                    </div>
                                     
                            </div>	
                        </div>
                        @endforeach
                        @endif
                    
                        
                    </div>
                </div>
        </div>
        </div>
    </div>


    <!-- Thêm đoạn mã JavaScript sau khi đã tải thư viện Bootstrap JS -->
<script>
    // Bắt sự kiện khi click vào danh mục (category)
    const categoryLinks = document.querySelectorAll('.category-link');
    categoryLinks.forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            // Hiển thị dropdown menu của danh mục tương ứng
            const dropdownMenu = this.nextElementSibling;
            dropdownMenu.classList.toggle('show');
        });
    });
</script>

<script>
    // Bắt sự kiện khi click vào các subcategory và các lựa chọn lọc khác
    const filters = document.querySelectorAll('.category-link, input[type="checkbox"]');
    filters.forEach(filter => {
        filter.addEventListener('change', function() {
            // Gửi Ajax để cập nhật lại trang với các lựa chọn lọc
            const formData = new FormData(document.getElementById('filterForm'));
            // Kiểm tra nếu không có checkbox nào được chọn, gán một mảng rỗng cho biến 'subcategories'
            if (!formData.get('subcategories[]')) {
                formData.set('subcategories[]', []);
            }
            // Gửi Ajax request bằng jQuery
            $.ajax({
                url: 'filter-product', // Thay your_domain và your_category_slug bằng giá trị thực tế của bạn
                method: 'POST',
                data: formData,
                contentType: false, // Không cần xử lý contentType
                processData: false, // Không cần xử lý processData
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}', // Thêm CSRF token nếu trang yêu cầu
                },
                success: function(data) {
                    // Xóa các sản phẩm hiện có trong phần tử có id "list_product"
                    $('#list_product').empty();

                    // Tạo phần tử HTML cho mỗi sản phẩm và đưa chúng vào phần tử có id "list_product"
                    if (data.length === 0) {
                        // Hiển thị thông báo "Not Found"
                        $('#list_product').html(`
                            <div id="notFound">
                                <img src="https://cdn.dribbble.com/users/721524/screenshots/4117132/untitled-1-_1_.png" alt="Not Found">
                                <p>Không tìm thấy sản phẩm nào.</p>
                            </div>
                        `);
                    } else {
                    data.forEach(product => {
                        const productId = product.id;
                        const productHTML = `
                            <div class="product col-lg-3 col-6" style="z-index: 1;">
                                <div class="make3D">
                                    <div class="shadow"></div>
                                    <img class="" src="https://drive.google.com/uc?export=view&id=${product.image}" alt="" style="width: 100%">
                                    <div class="image_overlay"></div>
                                    <div class="add_to_cart">Thêm giỏ hàng</div>
                                    <a href="{{ route('seller.business.detail.product', ['domain' => request()->segment(2), 'category_slug' => request()->segment(3), 'id' => '' ]) }}/` + productId + `">
                                        <div class="view_gallery">Xem chi tiết</div>
                                    </a>
                                    <div class="p-3">          
                                        <span class="product_name">${product.name}</span>    
                                        <p class="text-primary">${product.price.toLocaleString()} đ</p>                                           
                                        <div class="product-options">
                                            <strong>SIZES</strong>
                                            <span>XS, S, M, L, XL, XXL</span>                     
                                        </div>  
                                    </div>
                                </div>	
                            </div>
                        `;

                        $('#list_product').append(productHTML);
                    });
                }
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        });
    });
</script>



@endsection