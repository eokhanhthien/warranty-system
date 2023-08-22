<!DOCTYPE html>
<html lang="en">

<head>
  <!-- basic -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- mobile metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="viewport" content="initial-scale=1, maximum-scale=1">
  <!-- site metas -->
  <title> {{$business->name}}</title>
  <meta name="keywords" content="">
  <meta name="description" content="">
  <meta name="author" content="">
  <!-- fevicon -->
  <link rel="icon" type="image/png" href="https://drive.google.com/uc?export=view&id={{$business->logo_image}}">

  <!-- bootstrap css -->
  <link rel="stylesheet" href="{{ asset('assets/agriculture/css/bootstrap.min.css')}}">
  <!-- style css -->
  <link rel="stylesheet" href="{{ asset('assets/agriculture/css/style.css')}}">
  <!-- Responsive-->
  <link rel="stylesheet" href="{{ asset('assets/agriculture/css/responsive.css')}}">  
  <!-- Scrollbar Custom CSS -->
  <link rel="stylesheet" href="{{ asset('assets/agriculture/css/jquery.mCustomScrollbar.min.css')}}">
  <!-- Tweaks for older IEs-->
  <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>
<!-- body -->

<body class="main-layout">
  <!-- loader  -->

  <!-- end loader -->
  <!-- header -->
  <header>
    <!-- header inner -->
    <div class="header-top">
      <div class="header">
        <div class="container-fluid">
          <div class="row">
            <div class="col-xl-2 col-lg-4 col-md-4 col-sm-3 col logo_section">
              <div class="full">
                <div class="center-desk">
                  <div class="logo">
                    <!-- <a href="index.html"><img src="{{ asset('assets/agriculture/images/logo.png')}}" alt="#" /></a> -->
                    <h1 class="m-0" style="color: green;font-weight: 600;">{{$business->name}}</h1>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-10 col-lg-8 col-md-8 col-sm-9">
         
               <div class="menu-area">
                <div class="limit-box">
                  <nav class="main-menu ">
                    <ul class="menu-area-main">
                      <!-- <li class="active"> <a href="index.html">Home</a> </li> -->
                      <li class="{{ str_starts_with(request()->url(), url('artisq/' . request()->segment(2) . '/' . request()->segment(3))) && url()->current() == url('artisq/' . request()->segment(2) . '/' . request()->segment(3)) ? 'active' : ''}}"><a href="{{ route('seller.business', ['domain' => request()->segment(2), 'category_slug' => request()->segment(3)]) }}" >Trang chủ</a></li>
                      <li class="{{ str_starts_with(request()->url(), url('artisq/' . request()->segment(2) . '/' . request()->segment(3) . '/all-product')) && url()->current() == url('artisq/' . request()->segment(2) . '/' . request()->segment(3) . '/all-product') ? 'active' : ''}}"><a href="{{ route('seller.business.all.product', ['domain' => request()->segment(2), 'category_slug' => request()->segment(3)]) }}" >Sản phẩm</a></li>
                      <li> <a href="#vegetable">Vegetable</a> </li>
                      <li> <a href="#testimonial">Testomonial</a> </li>
                      <li> <a href="#contact">Contact Us</a> </li>
                     
                     <li> <a href="#"><img src="{{ asset('assets/agriculture/icon/icon_b.png')}}" alt="#" /></a></li>
                     </ul>
                   </nav>
                 </div>
               </div> 
              </div>
           </div>
         </div>
       </div>
     </div>
     <!-- end header inner -->




@yield('content')


    <!--  footer -->
    <footr>
      <div class="footer ">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
            <a href="#" class="logo_footer">
                <img style="width: 50px" src="{{ $business->logo_image ? 'https://drive.google.com/uc?export=view&id=' . $business->logo_image : asset('assets/agriculture/images/logo2.png') }}" alt="#"/>
            </a>

            </div>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 ">
              <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 ">
                  <div class="address">
                    <h3>Địa chỉ </h3>
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
                      </div>
                      </div>
                      <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="address">
                          <h3>Mạng xã hội</h3>
                          <ul class="Menu_footer">
                            <li class="active"> <a href="#">Twitter</a> </li>
                            <li><a href="#">Facebook</a> </li>
                            <li><a href="#">Instagram</a> </li>
                            <li><a href="#">Linkdin</a> </li>
                          </ul>
                        </div>
                      </div>
                     

                      <div class="col-lg-4 col-md-6 col-sm-6 ">
                        <div class="address">
                          <h3>Đăng ký</h3>
                           <form class="news">
                           <input class="newslatter" placeholder="Enter your email" type="text" name=" Enter your email">
                            <button class="submit">Đăng ký</button>
                            </form>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>

              </div>

            </div>
          </footr>
          <!-- end footer -->
          <!-- Javascript files-->
          <script src="{{ asset('assets/agriculture/js/jquery.min.js')}}"></script>
          <script src="{{ asset('assets/agriculture/js/popper.min.js')}}"></script>
          <script src="{{ asset('assets/agriculture/js/bootstrap.bundle.min.js')}}"></script>
          <script src="{{ asset('assets/agriculture/js/jquery-3.0.0.min.js')}}"></script>
          <script src="{{ asset('assets/agriculture/js/plugin.js')}}"></script>
          <!-- sidebar -->
          <script src="{{ asset('assets/agriculture/js/jquery.mCustomScrollbar.concat.min.js')}}"></script>
          <script src="{{ asset('assets/agriculture/js/custom.js')}}"></script>
          <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>


          <script>
// This example adds a marker to indicate the position of Bondi Beach in Sydney,
// Australia.
function initMap() {
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 11,
    center: {
      lat: 40.645037,
      lng: -73.880224
    },
  });

  var image = 'images/maps-and-flags.png';
  var beachMarker = new google.maps.Marker({
    position: {
      lat: 40.645037,
      lng: -73.880224
    },
    map: map,
    icon: image
  });
}
</script>
<!-- google map js -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8eaHt9Dh5H57Zh0xVTqxVdBFCvFMqFjQ&callback=initMap"></script>
<!-- end google map js -->



</body>

</html>