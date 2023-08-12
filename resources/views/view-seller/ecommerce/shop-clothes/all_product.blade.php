@extends('view-seller.ecommerce.shop-clothes.layout.layout')
@section('content')
  <!-- Page Header Start -->

  <div class="container-fluid page-header mb-5 py-5">
         <img src="https://img.freepik.com/premium-photo/shirt-mockup-concept-with-plain-clothing_23-2149448787.jpg" alt="" style ="width: 100%; height: 300px; object-fit: cover;" >
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
                                    <div class="dropdown-menu show" aria-labelledby="navbarDropdown">
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
                    @include('view-seller.' . $category_slug . '.' . $display_slug . '.list_product' )
                </div>
                    @include('view-seller.' . $category_slug . '.' . $display_slug . '.pagination' )

                </div>
        </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Thêm đoạn mã JavaScript sau khi đã tải thư viện Bootstrap JS -->
<!-- <script>
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
</script> -->

<script>
    $(document).ready(function() {
        var selectedSubcategories = []; // Mảng chứa danh sách subcategory đã chọn

        // Xử lý khi người dùng nhấn vào các mục trong danh sách categories
        $(document).on('click', '.category-link', function() {
            $(this).next('.dropdown-menu').find('input[type="checkbox"]').each(function() {
                if ($(this).is(':checked')) {
                    var subcategory_id = $(this).val();
                    if (!selectedSubcategories.includes(subcategory_id)) {
                        selectedSubcategories.push(subcategory_id);
                    }
                } else {
                    var subcategory_id = $(this).val();
                    if (selectedSubcategories.includes(subcategory_id)) {
                        selectedSubcategories.splice(selectedSubcategories.indexOf(subcategory_id), 1);
                    }
                }
            });

            // fetch_data(1, selectedSubcategories); // Đặt trang về 1 khi thay đổi mục lọc
        });

        // Xử lý khi người dùng nhấn vào các checkbox trong dropdown-menu
        $(document).on('click', '.subcategory-option input[type="checkbox"]', function() {
            var category_id = $(this).closest('.dropdown-menu').prev('.category-link').data('category');
            $(this).closest('.dropdown-menu').find('input[type="checkbox"]').each(function() {
                if ($(this).is(':checked')) {
                    var subcategory_id = $(this).val();
                    if (!selectedSubcategories.includes(subcategory_id)) {
                        selectedSubcategories.push(subcategory_id);
                    }
                } else {
                    var subcategory_id = $(this).val();
                    if (selectedSubcategories.includes(subcategory_id)) {
                        selectedSubcategories.splice(selectedSubcategories.indexOf(subcategory_id), 1);
                    }
                }
            });

            fetch_data(1, selectedSubcategories); // Đặt trang về 1 khi thay đổi mục lọc
        });

        // Xử lý khi người dùng thay đổi trang phân trang
        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];

            fetch_data(page, selectedSubcategories);
        });

        function fetch_data(page, selectedSubcategories) {
            $.ajax({
                url: '?page=' + page,
                type: 'GET',
                dataType: 'json',
                data: {
                    subcategories: selectedSubcategories
                },
                success: function(data) {
                    $('#list_product').empty();
                    $('#pagination').empty();
                    if (data.data.length === 0) {
                        // Hiển thị thông báo "Not Found"
                        $('#list_product').html(`
                            <div id="notFound">
                                <img src="https://cdn.dribbble.com/users/721524/screenshots/4117132/untitled-1-_1_.png" alt="Not Found">
                                <p>Không tìm thấy sản phẩm nào.</p>
                            </div>
                        `);
                    } else {
                        $('#list_product').html(data.data);
                    }
                    $('#pagination').html(data.pagination);
                }
            });
        }
    });
</script>

@endsection