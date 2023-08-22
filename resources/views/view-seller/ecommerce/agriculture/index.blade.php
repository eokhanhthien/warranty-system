@extends('view-seller.ecommerce.agriculture.layout.layout')
@section('content')
     <!-- end header -->
     <section class="slider_section">
      <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
          <li data-target="#myCarousel" data-slide-to="1"></li>
          <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
        @if(!empty($display_information->images))
          @php
              $image_about_1 = !empty($display_information->images[0])?$display_information->images[0]:'';
              $image_about_2 = !empty($display_information->images[1])? $display_information->images[1] : '';
          @endphp
          @endif
         @if(!empty($display_information->images))
         @foreach($display_information->images as $index => $image)
          <div class="carousel-item{{ $index === 0 ? ' active' : '' }}">
            <div class="container-fluid padding_dd">
              <div class="carousel-caption">
                <div class="row">
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                    <div class="text-bg">
                     <span>Chào mừng đến với {{$business->name}}</span>
                      <h1>{{ !empty($display_information->title_banner[0]) ? $display_information->title_banner[0] : "Vegetables Shop" }}</h1>
                      <p>{{ !empty($display_information->title_banner[1]) ? $display_information->title_banner[1] : "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal" }} </p>
                      <form class="Vegetable">
                <input class="Vegetable_fom" placeholder="Vegetable" type="text" name=" Vegetable">
                <button class="Search_btn">Tìm kiếm</button>
              </form>
                    </div>
                  </div>
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                    <div class="images_box" style=" ">
                      <!-- <figure><img src="{{ asset('assets/agriculture/images/img2.png')}}"></figure> -->
                      <img class="" src="https://drive.google.com/uc?export=view&id={{$image}}" alt="" style="width: 80%; border-radius: 50%;object-fit: cover;max-height : 440px;overflow: hidden; ">

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @endforeach
          @else
          <div class="carousel-item active">

            <div class="container-fluid padding_dd">
              <div class="carousel-caption">

                <div class="row">
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                    <div class="text-bg">
                       <span>Chào mừng đến với {{$business->name}}</span>
                      <h1>{{ !empty($display_information->title_banner[0]) ? $display_information->title_banner[0] : "Vegetables Shop" }}</h1>
                      <p>{{ !empty($display_information->title_banner[1]) ? $display_information->title_banner[1] : "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal" }} </p>
                      <form class="Vegetable">
                <input class="Vegetable_fom" placeholder="Vegetable" type="text" name=" Vegetable">
                <button class="Search_btn">Search</button>
              </form>
                    
                    </div>
                  </div>

                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                    <div class="images_box">
                      <figure><img src="{{ asset('assets/agriculture/images/img2.png')}}"></figure>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>


          <div class="carousel-item">

            <div class="container-fluid padding_dd">
              <div class="carousel-caption ">
                <div class="row">
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                    <div class="text-bg">
                       <span>Chào mừng đến với {{$business->name}}</span>
                      <h1>{{ !empty($display_information->title_banner[0]) ? $display_information->title_banner[0] : "Vegetables Shop" }}</h1>
                      <p>{{ !empty($display_information->title_banner[1]) ? $display_information->title_banner[1] : "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal" }} </p>
                       <form class="Vegetable">
                <input class="Vegetable_fom" placeholder="Vegetable" type="text" name=" Vegetable">
                <button class="Search_btn">Search</button>
              </form>
                    
                    </div>
                  </div>
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                    <div class="images_box">
                      <figure><img src="{{ asset('assets/agriculture/images/img2.png')}}"></figure>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="carousel-item">

          <div class="container-fluid padding_dd">
            <div class="carousel-caption ">
              <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                  <div class="text-bg">
                    <span>Welcome To Shree</span>
                    <h1>Vegetables Shop</h1>
                    <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal </p>
                    <form class="Vegetable">
              <input class="Vegetable_fom" placeholder="Vegetable" type="text" name=" Vegetable">
              <button class="Search_btn">Search</button>
            </form>
                  
                  </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                  <div class="images_box">
                    <figure><img src="{{ asset('assets/agriculture/images/img2.png')}}"></figure>
                  </div>
                </div>
              </div>
            </div>
          </div>
          </div>
          @endif
        </div>
      </div>
    </div>
    <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>

</section>

</header>
<!-- about  -->
<div id="about" class="about">
  <div class="container-fluid">
    <div class="row">
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
        <div class="about-box">
          <h2>Về chúng tôi</h2>
          <p class="">{{ !empty($display_information->service_title) ? $display_information->service_title : "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages andIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many" }}</p>
        </div>
      </div>
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 padding_rl">
        <div class="about-box_img">
          <figure><img src="{{ asset('assets/agriculture/images/about.jpg')}}" alt="#" /></figure>
        </div>
      </div>
    </div>

  </div>
</div>
<!-- end abouts -->



<!-- vegetable -->
<div id="vegetable" class="vegetable">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div  class="titlepage">
          <h2> Dịch vụ <strong class="llow">của chúng tôi</strong> </h2>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 ">
        <div class="vegetable_shop">
          <h3>Các dịch vụ:</h3>
          @if(!empty($display_information->service))
                         @foreach($display_information->service as $service)
                            @if(!empty($service))
                            <p class=""><i class="fa fa-check text-success me-3"></i> {{$service}}</p>
                            @endif
                         @endforeach
                     @else
                        <p class=""><i class="fa fa-check text-success me-3"></i> Residential & commercial plumbing</p>
                        <p class=""><i class="fa fa-check text-success me-3"></i> Quality services at affordable prices</p>
                        <p class=""><i class="fa fa-check text-success me-3"></i> Immediate 24/ 7 Hỗ trợ services</p>
                    @endif 
          <!-- <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages andIt is a long established fact that a reader will be distracted </p> -->
        </div>
      </div>
       <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12 ">
        <div class="vegetable_img">
         <figure><img src="{{ asset('assets/agriculture/images/v1.jpg')}}" alt="#"/></figure>
         <span>01</span>
        </div>
      </div>
       <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 ">
        <div class="vegetable_img margin_top">
         <figure><img src="{{ asset('assets/agriculture/images/v2.jpg')}}" alt="#"/></figure>
         <span>02</span>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end vegetable -->




   <!-- clients -->
    <div id="testimonial" class="clients">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="titlepage">
                        <h2>Đánh giá</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clients_red">
        <div class="container">
            <div id="testimonial_slider" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ul class="carousel-indicators">
                    <li data-target="#testimonial_slider" data-slide-to="0" class=""></li>
                    <li data-target="#testimonial_slider" data-slide-to="1" class="active"></li>
                    <li data-target="#testimonial_slider" data-slide-to="2" class=""></li>
                </ul>
                <!-- The slideshow -->
                <div class="carousel-inner">
                    <div class="carousel-item">
                        <div class="testomonial_section">

                            <div class="full testimonial_cont">
                                <div class="row">
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 pa_right">
                                        <div class="testomonial_img">
                                            <figure><img src="{{ asset('assets/agriculture/images/tes.jpg')}}" alt="#"/></figure>
                                            <i><img src="{{ asset('assets/agriculture/images/test_con.png')}}" alt="#"/></i>
                                        </div>
                                    </div>
                                    <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12 pa_left">
                                        <div class="cross_inner">
                                            <h3>Nguyễn Thanh Hương<br><strong class="ornage_color">review</strong></h3>
                                            <p>"Tôi đã mua rất nhiều loại rau củ và quả từ Cửa hàng Nông Sản và tôi rất hài lòng với chất lượng của sản phẩm. Tất cả đều tươi ngon và thơm ngon. Giao hàng nhanh chóng và dịch vụ khách hàng tốt."
                                          
                                            </p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="carousel-item active">

                        <div class="testomonial_section">
                            <div class="full center">
                            </div>
                            <div class="full testimonial_cont ">
                                <div class="row">
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 pa_right">
                                        <div class="testomonial_img">
                                            <figure><img src="{{ asset('assets/agriculture/images/tes.jpg')}}" alt="#"/></figure>
                                            <i><img src="{{ asset('assets/agriculture/images/test_con.png')}}" alt="#"/></i>
                                        </div>
                                    </div>
                                    <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12 pa_left">
                                        <div class="cross_inner">
                                            <h3>Trần Văn Nam<br><strong class="ornage_color">review</strong></h3>
                                            <p>"Tôi thường xuyên đặt hàng trực tuyến từ Cửa hàng Nông Sản và tôi thực sự thích giao diện mua sắm dễ dàng. Tôi có thể lựa chọn từ một loạt các sản phẩm và nhận được hàng một cách nhanh chóng và an toàn." 
                                              
                                            </p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="carousel-item">

                        <div id="testomonial" class="testomonial_section">
                            <div class="full center">
                            </div>
                            <div class="full testimonial_cont ">
                                <div class="row">
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 pa_right">
                                        <div class="testomonial_img">
                                            <figure><img src="{{ asset('assets/agriculture/images/tes.jpg')}}" alt="#"/></figure>
                                            <i><img src="{{ asset('assets/agriculture/images/test_con.png')}}" alt="#"/></i>
                                        </div>
                                    </div>
                                    <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12 pa_left">
                                        <div class="cross_inner">
                                            <h3>Lê Thị Mai<br><strong class="ornage_color">review</strong></h3>
                                            <p>"Cửa hàng này có một sự đa dạng về các loại rau củ quả và hạt giống. Tôi đã tìm thấy những loại hạt giống mà tôi không thể tìm thấy ở bất kỳ nơi nào khác. Sản phẩm chất lượng và giá cả hợp lý."
                                              
                                            </p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
  
    <!-- end clients -->




<!-- contact -->
<div id="contact" class="contact">
  <div class="container">
   <div class="row">
     <div class="col-md-12">
                <div class="titlepage">
                  <h2>Kết nối <strong class="llow">với chúng tôi</strong></h2>
                </div>
   </div>

</div>
    <div class="white_color">
      <div class="row">

        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
           <form class="contact_bg">
            <div class="row">
              <div class="col-md-12">
              
                <div class="col-md-12">
                  <input class="contactus" placeholder="Your Name" type="text" name="Your Name">
                </div>
                <div class="col-md-12">
                  <input class="contactus" placeholder="Email" type="text" name="Email">
                </div>
                <div class="col-md-12">
                  <input class="contactus" placeholder="Phone Number" type="text" name="Phone Number">
                </div>
                <div class="col-md-12">
                  <textarea class="textarea" placeholder="Message" type="text" name="Message"></textarea>
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                  <button class="send">Gửi</button>
                </div>
              </div>
            </form>
          </div>
            </div>
      
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
<div id="map">
          </div>
           </div>
          </div>
        </div>

      </div>
    </div>
</div>
</div>
    <!-- end contact -->
@endsection