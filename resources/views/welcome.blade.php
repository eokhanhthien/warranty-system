<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <link rel="icon" href="{{ asset('assets/img/images_home/logo.jpg')}}" type="image/gif" />
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>Long Tỵ - Digital</title>


  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/css_home/bootstrap.css')}}" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

  <!-- font awesome style -->
  <link href="{{ asset('assets/css/css_home/font-awesome.min.css')}}" rel="stylesheet" />

  <!-- Custom styles for this template -->
  <link href="{{ asset('assets/css/css_home/style.css')}}" rel="stylesheet" />
  <!-- responsive style -->
  <link href="{{ asset('assets/css/css_home/responsive.css')}}" rel="stylesheet" />

    <!-- Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>
<style>
  .img-box {
    height: 400px;
}
header.header_section {
    position: fixed;
    left: 0;
    right: 0;
    top: 0;
    background: #000000a1;
    z-index: 1000;
}
</style>
<body>

  <div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
      <div class="container-fluid">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
          <a class="navbar-brand" href="">
            <span>LONG TỴ - DIGITAL</span>
          </a>

          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class=""> </span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav  ml-auto">
              <!-- <li class="nav-item active">
                <a class="nav-link" href="#">Trang chủ <span class="sr-only">(current)</span></a>
              </li> -->
              <li class="nav-item">
                <a class="nav-link" href="{{route('login')}}">Đăng nhập</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#service">Dịch vụ</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#template">Giao diện mẫu</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#price">Bảng giá</a>
              </li>
            </ul>
            <div class="quote_btn-container">
              <form class="form-inline">
                <button class="btn   nav_search-btn" type="submit">
                  <i class="fa fa-search" aria-hidden="true"></i>
                </button>
              </form>
              <a href="tel: 0946144333">
                <i class="fa fa-phone" aria-hidden="true"></i>
                <span>
                  Call : +84 0946 144 333
                </span>
              </a>
            </div>
          </div>
        </nav>
      </div>
    </header>
    <!-- end header section -->
    <!-- slider section -->
    <section class="slider_section " id="#">
      <div id="customCarousel1" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="container ">
              <div class="row">
                <div class="col-md-6">
                  <div class="detail-box">
                    <h1>
                        Các giải pháp <br>
                        Mang đến giải pháp bán hàng và quản lý doanh nghiệp tối ưu
                    </h1>
                    <p>
                    Giải Pháp Thiết Kế Website Toàn Diện, công cụ cho phép khởi tạo website doanh nghiệp, website bán hàng nhanh chóng </p>
                    <div class="btn-box">
                      <a href="{{route('login')}}" class="btn-1">
                        Dùng thử miễn phí
                      </a>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="row">
                    <div class=" col-lg-10 mx-auto">
                      <div class="img-box">
                      <img src="https://themercen.com/wp-content/uploads/2023/01/graphic-hero-banner-565x492.png" alt="">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="container ">
              <div class="row">
                <div class="col-md-6">
                    <div class="detail-box">
                        <h1>
                          Mang đến chất lượng <br>
                          Tùy chỉnh linh hoạt giao diện và hình ảnh của website
                        </h1>
                        <p>
                        Chúng tôi cung cấp các công cụ tùy chỉnh mạnh mẽ để bạn có thể thay đổi giao diện, màu sắc, kiểu chữ, hình ảnh, chủ đề. </p>
                        <div class="btn-box">
                        <a href="{{route('login')}}" class="btn-1">
                        Dùng thử miễn phí
                        </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                  <div class="row">
                    <div class=" col-lg-10 mx-auto">
                      <div class="img-box">
                        <img src="https://www.digitallabz.ca/wp-content/uploads/revslider/home-1/rev_1-5.png" alt="">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="container ">
              <div class="row">
                <div class="col-md-6">
                <div class="detail-box">
                    <h1>
                        SEO tối ưu cho Website <br>
                        Quản lý nội dung rõ ràng với giao diện bắt mắt, chuẩn SEO
                    </h1>
                    <p>
                    Hệ thống quản lý nội dung tích hợp cho phép bạn thêm, sửa đổi và xóa nội dung trên các trang web một cách dễ dàng. </p>
                    <div class="btn-box">
                      <a href="{{route('login')}}" class="btn-1">
                        Dùng thử miễn phí
                      </a>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="row">
                    <div class=" col-lg-10 mx-auto">
                      <div class="img-box">
                        <img src="https://whisskers.com/wp-content/uploads/2019/04/about-service1.png" alt="">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="carousel_btn-box">
          <a class="carousel-control-prev" href="#customCarousel1" role="button" data-slide="prev">
            <i class="fa fa-angle-left" aria-hidden="true"></i>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#customCarousel1" role="button" data-slide="next">
            <i class="fa fa-angle-right" aria-hidden="true"></i>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
    </section>
    <!-- end slider section -->
  </div>

  <!-- service section -->

  <section class="service_section layout_padding" id="service">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Dịch vụ của chúng tôi
        </h2>
      </div>
    </div>
    <div class="container ">
      <div class="row">
        <div class="col-md-6 col-lg-4">
          <div class="box ">
              <img src="{{ asset('assets/img/images_home/ss1.png')}}" alt="" style ="width: 100%; height: 170px; object-fit: cover;">
            <div class="detail-box">
              <h4>
                Ecommerce
              </h4>
              <p>
              Tạo Web bán hàng và giới thiệu doanh nghiệp chỉ với vài thao tác, trình tạo landing page không giới hạn, tính năng book lịch, tiếp thị liên kết, ví và tích điểm
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="box ">

            <img src="{{ asset('assets/img/images_home/ss2.png')}}" alt="" style="width:100%; height: 170px; object-fit: cover;">

            <div class="detail-box">
              <h4>
                Sale
              </h4>
              <p>
                Quản lý bán hàng và POS, đồng bộ đa kênh, quản lý tồn kho, đa chi nhánh, giải pháp fnb, quản lý nhân sự, công việc, chấm công, tính lương
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4 ">
          <div class="box ">

                <img src="{{ asset('assets/img/images_home/ss3.jpg')}}" alt="" style="width:100%; height: 170px; object-fit: cover;">

            <div class="detail-box">
              <h4>
              Marketing
              </h4>
              <p>
              Nền tảng giúp doanh nghiệp triển khai Marketing theo chiến lược Inbound Marketing hiệu quả, tiết kiệm chi phí, thu hút được nhiều khách hàng.
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="box ">

            <img src="{{ asset('assets/img/images_home/ss4.jpg')}}" alt="" style="width:100%; height: 170px; object-fit: cover;">

            <div class="detail-box">
              <h4>
                Đa dạng tính năng
              </h4>
              <p>
              Có tất cả tính năng cần thiết cho một website TMDT hoặc website giới thiệu doanh nghiệp
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="box ">
          <img src="{{ asset('assets/img/images_home/ss5.jpg')}}" alt="" style="width:100%; height: 170px; object-fit: cover;">

            <div class="detail-box">
              <h4>
                Đa nền tảng
              </h4>
              <p>
              Phù hợp với nhiều nghành nghề khác nhau Spa, nhà hàng, khách sạn, bán hàng điện tử, bán quần áo, bán mỹ phẩm...
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="box ">
          <img src="{{ asset('assets/img/images_home/ss6.png')}}" alt="" style="width:100%; height: 170px; object-fit: cover;">

            <div class="detail-box">
              <h4>
                Tùy chỉnh đa dạng
              </h4>
              <p>
              Có thể tùy chỉnh toàn bộ nội dung hiển thị trên web gồm nội dung, hình ảnh, giao diện, font chữ, màu sắc ...
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="container mt-5" id="template">
      <div class="heading_container heading_center">
        <h2>
          Một số giao diện mẫu
        </h2>
      </div>
    </div>
    <div class="container ">
      <div class="row">
        <div class="col-md-6 col-lg-6">
          <div class="box ">
              <img src="{{ asset('assets/img/images_home/temp1.jpg')}}" alt="" style ="width: 100%;  object-fit: cover;">
            <div class="detail-box">
              <h4>
                <a href="https://longty.io.vn/artisq/hai-dang-ke-ilwv/repair-system" target="_blank">
                  Bán hàng, sửa chữa, bảo hành
                </a>
              </h4>
            </div>
          </div>
        </div>
    
        <div class="col-md-6 col-lg-6">
          <div class="box ">
              <img src="{{ asset('assets/img/images_home/temp2.jpg')}}" alt="" style ="width: 100%; object-fit: cover;">
            <div class="detail-box">
              <h4>
                <a href="https://longty.io.vn/artisq/pho-xa-32nd/ecommerce" target="_blank">
                  Thương mại điện tử
                </a>
              </h4>
            </div>
          </div>
        </div>

      </div>
    </div>

  </section>

  <!-- end service section -->

  <!-- about section -->

  <section class="about_section layout_padding-bottom">
    <div class="container  ">
      <div class="row">
        <div class="col-md-6">
          <div class="detail-box">
            <div class="heading_container">
              <h2>
                Về chúng tôi
              </h2>
            </div>
            <p>
            Tại Long Tỵ, chúng tôi không chỉ tìm hiểu các yêu cầu của khách hàng, mà chúng tôi tìm hiểu về thực trạng và thực tế nhu cầu của họ. Từ đó đề ra các giải pháp công nghệ tổng thể để tối ưu và tăng tốc doanh nghiệp, hơn là chỉ giải quyết các yêu cầu đơn lẻ.</p>
            <a href="{{route('login')}}">
              Dùng thử miễn phí
            </a>
          </div>
        </div>
        <div class="col-md-6 ">
          <div class="img-box">
            <img src="{{ asset('assets/img/images_home/about-img.png')}}" alt="">
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- end about section -->


  <!-- server section -->

  <section class="server_section">
    <div class="container ">
      <div class="row">
        <div class="col-md-6">
          <div class="img-box">
            <img src="{{ asset('assets/img/images_home/server-img.jpg')}}" alt="">
            <div class="play_btn">
              <button>
                <i class="fa fa-play" aria-hidden="true"></i>
              </button>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="detail-box">
            <div class="heading_container">
              <h2>
                Giúp bạn tạo ra website của chính mình
              </h2>
              <p>
                Giải Pháp Thiết Kế Website Toàn Diện, công cụ cho phép khởi tạo website doanh nghiệp, website và ứng dụng bán hàng nhanh chóng
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end server section -->

  <!-- price section -->

  <section class="price_section layout_padding" id="price">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Bảng giá
        </h2>
      </div>
      <div class="price_container ">
        <div class="box">
          <div class="detail-box">
            <h2> <span>150.000 VNĐ / 1 tháng</span></h2>
            <h6>
              Free Go
            </h6>
            <ul class="price_features">
              <li>
                Tạo website
              </li>
              <li>
                Quản lý sản phẩm (30 sản phẩm)
              </li>
              <li>
                Giới hạn tính năng
              </li>
              <li>
                Tốc độ cơ bản
              </li>
            </ul>
          </div>
          <div class="btn-box">
            <a href="{{route('login')}}">
             Dùng thử
            </a>
          </div>
        </div>
        <div class="box">
          <div class="detail-box">
            <h2><span>700.000 VNĐ / 6 tháng</span></h2>
            <h6>
                STARTUP
            </h6>
            <ul class="price_features">
              <li>
                Tạo website
              </li>
              <li>
                Quản lý sản phẩm (100 sản phẩm)
              </li>
              <li>
                Đầy đủ tính năng 
              </li>
              <li>
                Tốc độ nhanh
              </li>
            </ul>
          </div>
          <div class="btn-box">
            <a href="{{route('login')}}">
            Đăng ký ngay
            </a>
          </div>
        </div>
        <div class="box">
          <div class="detail-box">
            <h2> <span>1.200.000 VNĐ / 1 năm</span></h2>
            <h6>
              Business
            </h6>
            <ul class="price_features">
              <li>
                Tạo website
              </li>
              <li>
                Quản lý sản phẩm (không giới hạn)
              </li>
              <li>
                Đầy đủ tính năng 
              </li>
              <li>
                Tốc độ nhanh
              </li>
            </ul>
          </div>
          <div class="btn-box">
            <a href="{{route('login')}}">
                Đăng ký ngay
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- price section -->

  <!-- client section -->
  <section class="client_section ">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Đánh giá
        </h2>
        <p>
          Các đánh giá của khách hàng
        </p>
      </div>
    </div>
    <div class="container px-0">
      <div id="customCarousel2" class="carousel  slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="container">
              <div class="row">
                <div class="col-md-10 mx-auto">
                  <div class="box">
                    <div class="img-box">
                      <img src="{{ asset('assets/img/images_home/client.jpg')}}" alt="">
                    </div>
                    <div class="detail-box">
                      <div class="client_info">
                        <div class="client_name">
                          <h5>
                            Morojink
                          </h5>
                          <h6>
                            Customer
                          </h6>
                        </div>
                        <i class="fa fa-quote-left" aria-hidden="true"></i>
                      </div>
                      <p>
                      Tôi thật sự ấn tượng với trang web chuyển đổi kỹ thuật số này! Giao diện thân thiện và dễ sử dụng, cho phép tôi dễ dàng tìm kiếm thông tin cần thiết. Tôi cũng rất thích tính năng tương tác mượt mà, giúp tôi tiết kiệm thời gian trong việc thực hiện các giao dịch và thủ tục trực tuyến
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="container">
              <div class="row">
                <div class="col-md-10 mx-auto">
                  <div class="box">
                    <div class="img-box">
                      <img src="{{ asset('assets/img/images_home/nhan.jpg')}}" alt="">
                    </div>
                    <div class="detail-box">
                      <div class="client_info">
                        <div class="client_name">
                          <h5>
                            Thành Nhân
                          </h5>
                          <h6>
                            Customer
                          </h6>
                        </div>
                        <i class="fa fa-quote-left" aria-hidden="true"></i>
                      </div>
                      <p>
                      Website chuyển đổi kỹ thuật số này đã đem lại cho tôi trải nghiệm mua sắm trực tuyến tuyệt vời. Tôi cảm thấy yên tâm hơn khi thấy dữ liệu của tôi được bảo mật và giao dịch được thực hiện một cách an toàn. Mong rằng họ sẽ tiếp tục phát triển và cải thiện để mang đến nhiều tiện ích hơn nữa.
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
        <div class="carousel_btn-box">
          <a class="carousel-control-prev" href="#customCarousel2" role="button" data-slide="prev">
            <i class="fa fa-angle-left" aria-hidden="true"></i>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#customCarousel2" role="button" data-slide="next">
            <i class="fa fa-angle-right" aria-hidden="true"></i>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
    </div>
  </section>
  <!-- end client section -->

  <!-- info section -->

  <section class="info_section layout_padding2">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <div class="info_contact">
            <h4>
              Điạ chỉ
            </h4>
            <div class="contact_link_box">
              <a href="">
                <i class="fa fa-map-marker" aria-hidden="true"></i>
                <span>
                  Thành phố Hồ Chí Minh
                </span>
              </a>
              <a href="">
                <i class="fa fa-phone" aria-hidden="true"></i>
                <span>
                  Call +84 0946144333
                </span>
              </a>
              <a href="">
                <i class="fa fa-envelope" aria-hidden="true"></i>
                <span>
                  thienpark.fx@gmail.com
                </span>
              </a>
            </div>
          </div>
          <div class="info_social">
            <a href="">
              <i class="fa fa-facebook" aria-hidden="true"></i>
            </a>
            <a href="">
              <i class="fa fa-twitter" aria-hidden="true"></i>
            </a>
            <a href="">
              <i class="fa fa-linkedin" aria-hidden="true"></i>
            </a>
            <a href="">
              <i class="fa fa-instagram" aria-hidden="true"></i>
            </a>
          </div>
        </div>

        <div class="col-md-3">
          <div class="info_detail">
            <h4>
              Thông tin
            </h4>
            <p>
            Giải Pháp Thiết Kế Website Toàn Diện, công cụ cho phép khởi tạo website doanh nghiệp, website và ứng dụng bán hàng nhanh chóng
          </div>
        </div>
        <div class="col-md-6 mb-0">
          <h4>
            Đăng ký
          </h4>
          <form action="#">
            <input type="text" placeholder="Nhập email" />
            <button type="submit">
              Đăng ký
            </button>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- end info section -->


  <!-- footer section -->

  <!-- footer section -->

  <!-- jQery -->
  <script src="{{ asset('assets/js/js_home/jquery-3.4.1.min.js')}}"></script>
  <!-- bootstrap js -->
  <script src="{{ asset('assets/js/js_home/bootstrap.js')}}"></script>
  <!-- custom js -->
  <script src="{{ asset('assets/js/js_home/custom.js')}}"></script>


</body>

</html>