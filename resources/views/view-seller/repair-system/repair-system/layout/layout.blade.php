<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title> {{$business->name}}</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="https://drive.google.com/uc?export=view&id={{$business->logo_image}}">


    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('assets/manager_web/lib/animate/animate.min.css')}} " rel="stylesheet">
    <link href="{{ asset('assets/manager_web/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/manager_web/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('assets/manager_web/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/manager_web/css/style_all_product.css') }}" rel="stylesheet">

    <!-- swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <!-- Template Stylesheet -->
    <link href="{{ asset('assets/manager_web/css/style.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">

      <!-- Bao gồm tệp tin CSS của Toastr -->
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bao gồm tệp tin JavaScript của Toastr -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
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

 
  @if(!empty($business->color) && $business->color != '')
  <style>
    i.fa.fa-map-marker-alt.text-primary.me-2,
    i.far.fa-envelope-open.text-primary.me-2,
    .add_to_cart:hover,
    .view_gallery:hover,
    p.text-primary.fw-medium,
    .cart,
    .navbar-light .navbar-nav .nav-link:hover,
    .navbar-light .navbar-nav .nav-link.active {
      color: {{ $business->color }} !important;
    }

    .add-cart-detail,
    .container-fluid.bg-dark.text-light.footer.pt-5.mt-5.wow.fadeIn {
    background-color: {{ $business->color }} !important;
    }
    a.btn.btn-primary.py-md-3.px-md-5.me-3.animated.slideInLeft,
    li.page-item.active span,
    a.btn.btn-lg.btn-primary.btn-lg-square.rounded-0.back-to-top {
    background-color: {{ $business->color }} !important;
    border-color: {{ $business->color }} !important;
    }
    </style>
  @endif


    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Topbar Start -->
    <div class="container-fluid bg-light d-none d-lg-block">
        <div class="row align-items-center top-bar">
            <div class="col-lg-3 col-md-12 text-center text-lg-start">
                <a href="" class="navbar-brand m-0 p-0">
                    <h1 style="{{ !empty($business->color) && $business->color != '' ? 'color: ' . $business->color : '' }}" class="{{ !empty($business->color) && $business->color != '' ? '' : 'text-primary' }} m-0">{{ $business->name }}</h1>
                </a>
            </div>
            <div class="col-lg-9 col-md-12 text-end">
                @if(!empty($business->address))
                    @php
                        $decodedAddress = json_decode($business->address);
                        $provinceName = App\Province::where('id', $decodedAddress->province)->first();
                        $districtName = App\District::where('id', $decodedAddress->district)->first();
                        $wardName = App\Ward::where('id', $decodedAddress->ward)->first();
                    
                    @endphp
                @endif
                <div class="h-100 d-inline-flex align-items-center me-4">
                    <i class="fa fa-map-marker-alt text-primary me-2"></i>
                    <p class="m-0">{{!empty($provinceName->city_name) ? $provinceName->city_name : 'USA'}}, {{!empty($districtName->districts_name) ? $districtName->districts_name : 'New York'}}, {{!empty($wardName->wards_name) ? $wardName->wards_name : '123 Street'}} </p>
                </div>
                <div class="h-100 d-inline-flex align-items-center me-4">
                    <i class="far fa-envelope-open text-primary me-2"></i>
                    <p class="m-0">{{$business->email}}</p>
                </div>
                <div class="h-100 d-inline-flex align-items-center">
                    <a class="btn btn-sm-square bg-white text-primary me-1" href=""><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-sm-square bg-white text-primary me-1" href=""><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-sm-square bg-white text-primary me-1" href=""><i class="fab fa-linkedin-in"></i></a>
                    <a class="btn btn-sm-square bg-white text-primary me-0" href=""><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid nav-bar bg-light" style="z-index: 999;">
        <nav class="navbar navbar-expand-lg navbar-light bg-white p-3 py-lg-0 px-lg-4">
            <a href="" class="navbar-brand d-flex align-items-center m-0 p-0 d-lg-none">
                <h1 class="text-primary m-0">{{$business->name}}</h1>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav me-auto">
                    <a href="{{ route('seller.business', ['domain' => request()->segment(2), 'category_slug' => request()->segment(3)]) }}" class="{{ str_starts_with(request()->url(), url('artisq/' . request()->segment(2) . '/' . request()->segment(3))) && url()->current() == url('artisq/' . request()->segment(2) . '/' . request()->segment(3)) ? 'nav-item nav-link active' : 'nav-item nav-link' }}">Trang chủ</a>
                    <a href="{{ route('seller.business.all.product', ['domain' => request()->segment(2), 'category_slug' => request()->segment(3)]) }}" class="{{ str_starts_with(request()->url(), url('artisq/' . request()->segment(2) . '/' . request()->segment(3) . '/all-product')) && url()->current() == url('artisq/' . request()->segment(2) . '/' . request()->segment(3). '/all-product') ? 'nav-item nav-link active' : 'nav-item nav-link' }}">Sản phẩm</a>
                    <a href="{{ route('seller.business.service', ['domain' => request()->segment(2), 'category_slug' => request()->segment(3)]) }}" class="{{ str_starts_with(request()->url(), url('artisq/' . request()->segment(2) . '/' . request()->segment(3) . '/service')) && url()->current() == url('artisq/' . request()->segment(2) . '/' . request()->segment(3). '/service') ? 'nav-item nav-link active' : 'nav-item nav-link' }}">Dịch vụ</a>
                    <!-- <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Trang</a>
                        <div class="dropdown-menu fade-up m-0">
                            <a href="booking.html" class="dropdown-item">Booking</a>
                            <a href="team.html" class="dropdown-item">Technicians</a>
                            <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                            <a href="404.html" class="dropdown-item">404 Page</a>
                        </div>
                    </div> -->
                    <!-- <a href="contact.html" class="nav-item nav-link">Liên hệ</a> -->
                </div>
                <div>
                <a style=" font-weight: 600;text-transform: uppercase;" href="{{ route('seller.show.cart', ['domain' => request()->segment(2), 'category_slug' => request()->segment(3)]) }}" class="nav-item nav-link cart"><i class="fas fa-shopping-cart" style="font-size: 24p;cursor: pointer;"></i> Giỏ hàng</a>
                    
                </div>
                @php
                    $loggedInCustomer = Auth::guard('customer')->user();
                    $customerDomain = null;

                    if ($loggedInCustomer) {
                        $customerBusiness = \App\Business::find($loggedInCustomer->business_id);
                        if ($customerBusiness) {
                            $customerDomain = $customerBusiness->domain;
                        }
                    }
                @endphp
                @if(Auth::guard('customer')->check() && $customerDomain == request()->segment(2))
                @php
                        $name = Auth::guard('customer')->user()->full_name;
                        $lastSpacePosition = mb_strrpos($name, ' ');
                        $lastName = mb_substr($name, $lastSpacePosition + 1);
                        $initial = mb_strtoupper(mb_substr($lastName, 0, 1));
                    @endphp

                <div class="dropdown">
                <div class="avatar avatar-online" style="background-color: #f8f9fa; text-align: center; display: inline-block; width: 40px; height: 40px; border-radius: 50%; line-height: 40px; font-weight: bold;margin-right: 20px;">
                        <span style="display: inline-block; vertical-align: middle;">{{ $initial }}</span>
                </div>
                <div class="dropdown-content" style="font-size: 14px;border-radius: 4px">
                    <a  style="padding: 2px 16px;" href="">{{Auth::guard('customer')->user()->full_name}}</a>
                    <a  style="padding: 2px 16px;" href="{{route('seller.order', ['domain' => request()->segment(2), 'category_slug' => request()->segment(3)])}}">Đơn hàng</a>
                    <a  style="padding: 2px 16px;" href="{{route('seller.logout', ['domain' => request()->segment(2), 'category_slug' => request()->segment(3)])}}">Đăng xuất</a>
                </div>
                </div>
                @else
                <div>
                    <a href="{{route('seller.login', ['domain' => request()->segment(2), 'category_slug' => request()->segment(3)])}}" class="pr-4" style="    color: var(--dark);
                    font-size: 15px;
                    font-weight: 600;
                    text-transform: uppercase;
                    outline: none;
                    padding: 0 20px 0 0"> Đăng nhập </a>
                </div>
                @endif

                <div class="mt-4 mt-lg-0 me-lg-n4 py-3 px-4 {{ !empty($business->color) && $business->color != '' ? '' : 'bg-primary' }} d-flex align-items-center" style="{{ !empty($business->color) && $business->color != '' ? 'background-color: ' . $business->color : '' }}">
                    <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-white" style="width: 45px; height: 45px;">
                        <i class="fa fa-phone-alt text-primary"></i>
                    </div>
                    <div class="ms-3">
                        <p class="mb-1 text-white">Hỗ trợ 24/7</p>
                        <h5 class="m-0 text-secondary">{{$business->phone_number}}</h5>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    <!-- Navbar End -->


    @yield('content')



    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">Địa chỉ</h4>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>{{!empty($provinceName->city_name) ? $provinceName->city_name : 'USA'}}, {{!empty($districtName->districts_name) ? $districtName->districts_name : 'New York'}}, {{!empty($wardName->wards_name) ? $wardName->wards_name : '123 Street'}} </p>

                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>{{$business->phone_number}}</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>{{$business->email}}</p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">Giờ mở cửa</h4>
                    <h6 class="text-light">Monday - Friday:</h6>
                    <p class="mb-4">09.00 AM - 09.00 PM</p>
                    <h6 class="text-light">Saturday - Sunday:</h6>
                    <p class="mb-0">09.00 AM - 12.00 PM</p>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">Dịch vụ</h4>
                    <a class="btn btn-link" href="">Drain Cleaning</a>
                    <a class="btn btn-link" href="">Sewer Line</a>
                    <a class="btn btn-link" href="">Water Heating</a>
                    <a class="btn btn-link" href="">Toilet Cleaning</a>
                    <a class="btn btn-link" href="">Broken Pipe</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">Nhận thông báo</h4>
                    <p>Nhập mail của bạn để nhận thông báo mới nhất</p>
                    <div class="position-relative mx-auto" style="max-width: 400px;">
                        <input class="form-control border-0 w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email">
                        <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-0 back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/manager_web/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('assets/manager_web/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('assets/manager_web/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/manager_web/lib/counterup/counterup.min.js') }}"></script>
    <script src="{{ asset('assets/manager_web/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/manager_web/lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/manager_web/lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('assets/manager_web/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('assets/manager_web/js/main.js') }}"></script>
    <script src="{{ asset('assets/manager_web/js/style_all_product.js') }}"></script>
</body>

</html>