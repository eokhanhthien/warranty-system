<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="https://drive.google.com/uc?export=view&id={{$business->logo_image}}">

    <title>{{$business->name}}</title>


    <!-- Additional CSS Files -->
    <!-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/shop_clothes/css/bootstrap.min.css')}}"> -->

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/shop_clothes/css/font-awesome.css')}}">

    <link rel="stylesheet" href="{{ asset('assets/shop_clothes/css/templatemo-hexashop.css')}}">

    <link rel="stylesheet" href="{{ asset('assets/shop_clothes/css/owl-carousel.css')}}">

    <link rel="stylesheet" href="{{ asset('assets/shop_clothes/css/lightbox.css')}}">

    <link href="{{ asset('assets/manager_web/css/style_all_product.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/manager_web/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    </head>
    
    <body>
    
   
    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="{{ route('seller.business', ['domain' => request()->segment(2), 'category_slug' => request()->segment(3)]) }}" class="logo text-dark">
                            <!-- <img src="{{ asset('assets/shop_clothes/images/logo.png')}}"> -->
                            {{$business->name}}
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                        <li class="scroll-to-section"><a href="{{ route('seller.business', ['domain' => request()->segment(2), 'category_slug' => request()->segment(3)]) }}" class="{{ str_starts_with(request()->url(), url('artisq/' . request()->segment(2) . '/' . request()->segment(3))) && url()->current() == url('artisq/' . request()->segment(2) . '/' . request()->segment(3)) ? ' active' : '' }}">Trang chủ</a></li>
                        <li class="scroll-to-section"><a href="{{ route('seller.business.all.product', ['domain' => request()->segment(2), 'category_slug' => request()->segment(3)]) }}" class="{{ str_starts_with(request()->url(), url('artisq/' . request()->segment(2) . '/' . request()->segment(3) . '/all-product')) && url()->current() == url('artisq/' . request()->segment(2) . '/' . request()->segment(3). '/all-product') ? ' active' : '' }}">Sản phẩm</a></li>

                            <!-- <li class="scroll-to-section"><a href="#top" class="active">Home</a></li> -->
                            <!-- <li class="scroll-to-section"><a href="#men">Men's</a></li> -->
                            <li class="scroll-to-section"><a href="#women">Women's</a></li>
                            <li class="scroll-to-section"><a href="#kids">Kid's</a></li>
                            <li class="submenu">
                                <a href="javascript:;">Pages</a>
                                <ul>
                                    <li><a href="about.html">About Us</a></li>
                                    <li><a href="products.html">Products</a></li>
                                    <li><a href="single-product.html">Single Product</a></li>
                                    <li><a href="contact.html">Contact Us</a></li>
                                </ul>
                            </li>
                            <li class="submenu">
                                <a href="javascript:;">Features</a>
                                <ul>
                                    <li><a href="#">Features Page 1</a></li>
                                    <li><a href="#">Features Page 2</a></li>
                                    <li><a href="#">Features Page 3</a></li>
                                    <li><a rel="nofollow" href="https://templatemo.com/page/4" target="_blank">Template Page 4</a></li>
                                </ul>
                            </li>
                            <li class="scroll-to-section"><a href="#explore">Explore</a></li>
                        </ul>        
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->

    @yield('content')
  
    <!-- ***** Subscribe Area Ends ***** -->
    
    <!-- ***** Footer Start ***** -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="first-item">
                        <div class="logo">
                            <img src="{{ asset('assets/shop_clothes/images/white-logo.png')}}" alt="hexashop ecommerce templatemo">
                        </div>
                        <ul>
                        @if(!empty($business->address))
                            @php
                                $decodedAddress = json_decode($business->address);
                                $provinceName = App\Province::where('id', $decodedAddress->province)->first();
                                $districtName = App\District::where('id', $decodedAddress->district)->first();
                                $wardName = App\Ward::where('id', $decodedAddress->ward)->first();
                            
                                @endphp
                            @endif
                            <li>{{!empty($provinceName->city_name) ? $provinceName->city_name : 'Sunny Isles Beach'}}, {{!empty($districtName->districts_name) ? $districtName->districts_name : ' FL 33160'}}, {{!empty($wardName->wards_name) ? $wardName->wards_name : ' United States'}}</li></li>
                            <li>{{$business->email}}</li>
                            <li>{{$business->number_phone}}</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3">
                    <h4>Shopping &amp; Categories</h4>
                    <ul>
                        <li><a href="#">Men’s Shopping</a></li>
                        <li><a href="#">Women’s Shopping</a></li>
                        <li><a href="#">Kid's Shopping</a></li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><a href="#">Homepage</a></li>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Help</a></li>
                        <li><a href="#">Contact Us</a></li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <h4>Help &amp; Information</h4>
                    <ul>
                        <li><a href="#">Help</a></li>
                        <li><a href="#">FAQ's</a></li>
                        <li><a href="#">Shipping</a></li>
                        <li><a href="#">Tracking ID</a></li>
                    </ul>
                </div>
                <div class="col-lg-12">
                    <div class="under-footer">
                        <p>Copyright © 2022 {{$business->name}} Co., Ltd. All Rights Reserved. 
                    
                        <ul>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-behance"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    

    <!-- jQuery -->
    <script src="{{ asset('assets/shop_clothes/js/jquery-2.1.0.min.js')}}"></script>

    <!-- Bootstrap -->
    <script src="{{ asset('assets/shop_clothes/js/popper.js')}}"></script>
    <script src="{{ asset('assets/shop_clothes/js/bootstrap.min.js')}}"></script>

    <!-- Plugins -->
    <script src="{{ asset('assets/shop_clothes/js/owl-carousel.js')}}"></script>
    <script src="{{ asset('assets/shop_clothes/js/accordions.js')}}"></script>
    <script src="{{ asset('assets/shop_clothes/js/datepicker.js')}}"></script>
    <script src="{{ asset('assets/shop_clothes/js/scrollreveal.min.js')}}"></script>
    <script src="{{ asset('assets/shop_clothes/js/waypoints.min.js')}}"></script>
    <script src="{{ asset('assets/shop_clothes/js/jquery.counterup.min.js')}}"></script>
    <script src="{{ asset('assets/shop_clothes/js/imgfix.min.js')}}"></script> 
    <script src="{{ asset('assets/shop_clothes/js/slick.js')}}"></script> 
    <script src="{{ asset('assets/shop_clothes/js/lightbox.js')}}"></script> 
    <script src="{{ asset('assets/shop_clothes/js/isotope.js')}}"></script> 
    
    <!-- Global Init -->
    <script src="{{ asset('assets/shop_clothes/js/custom.js')}}"></script>

    <script>

        $(function() {
            var selectedClass = "";
            $("p").click(function(){
            selectedClass = $(this).attr("data-rel");
            $("#portfolio").fadeTo(50, 0.1);
                $("#portfolio div").not("."+selectedClass).fadeOut();
            setTimeout(function() {
              $("."+selectedClass).fadeIn();
              $("#portfolio").fadeTo(50, 1);
            }, 500);
                
            });
        });

    </script>

  </body>
</html>