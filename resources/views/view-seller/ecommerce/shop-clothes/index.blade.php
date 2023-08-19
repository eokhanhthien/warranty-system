@extends('view-seller.ecommerce.shop-clothes.layout.layout')
@section('content')
  <div class="main-banner" id="top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="left-content">
                        <div class="thumb">
                            <div class="inner-content">
                            @if(!empty($display_information->service) && isset($display_information->service[0]))
                                <h4>{{$display_information->service[0]}}</h4>
                                <span>Cảm ơn bạn đã luôn đồng hành</span>           
                            @else
                                 <h4>We Are {{$business->name}}</h4>
                                <span>Cảm ơn bạn đã luôn đồng hành</span>
                            @endif 

                                <div class="main-border-button">
                                    <a href="{{ route('seller.business.all.product', ['domain' => request()->segment(2), 'category_slug' => request()->segment(3)]) }}">Purchase Now!</a>
                                </div>
                            </div>
                            @if(!empty($display_information->images))
                            <img class="img-fluid" src="https://drive.google.com/uc?export=view&id={{$display_information->images[0]}}" alt="">
                            @else
                            <img src="{{ asset('assets/shop_clothes/images/left-banner-image.jpg')}}" alt="">
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="right-content">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="right-first-image">
                                    <div class="thumb">
                                        <div class="inner-content">
                                            <h4>Women</h4>
                                            <span>Best Clothes For Women</span>
                                        </div>
                                        <div class="hover-content">
                                            <div class="inner">
                                            @if(!empty($display_information->service) && isset($display_information->service[1]))
                                                <h4>{{$display_information->service[1]}}</h4>
                                                <span>Đảm bảo chất lượng sản phẩm</span>           
                                            @else
                                                <h4>Women</h4>
                                                <p>Lorem ipsum dolor sit amet, conservisii ctetur adipiscing elit incid.</p>
                                            @endif 

                                                <div class="main-border-button">
                                                    <a href="{{ route('seller.business.all.product', ['domain' => request()->segment(2), 'category_slug' => request()->segment(3)]) }}">Discover More</a>
                                                </div>
                                            </div>
                                        </div>
                                        @if(!empty($display_information->images))
                                        <img class="img-fluid" src="https://drive.google.com/uc?export=view&id={{$display_information->images[1]}}" alt="">
                                        @else
                                        <img src="{{ asset('assets/shop_clothes/images/baner-right-image-01.jpg')}}">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="right-first-image">
                                    <div class="thumb">
                                        <div class="inner-content">
                                            <h4>Men</h4>
                                            <span>Best Clothes For Men</span>
                                        </div>
                                        <div class="hover-content">
                                            <div class="inner">
                                            @if(!empty($display_information->service) && isset($display_information->service[2]))
                                                <h4>{{$display_information->service[2]}}</h4>
                                                <span>Uy tín trong từng sản phẩm</span>           
                                            @else
                                                <h4>Men</h4>
                                                <p>Lorem ipsum dolor sit amet, conservisii ctetur adipiscing elit incid.</p>
                                            @endif 

                                                <div class="main-border-button">
                                                    <a href="{{ route('seller.business.all.product', ['domain' => request()->segment(2), 'category_slug' => request()->segment(3)]) }}">Discover More</a>
                                                </div>
                                            </div>
                                        </div>
                                        @if(!empty($display_information->images))
                                        <img class="img-fluid" src="https://drive.google.com/uc?export=view&id={{$display_information->images[2]}}" alt="">
                                        @else
                                        <img src="{{ asset('assets/shop_clothes/images/baner-right-image-02.jpg')}}">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="right-first-image">
                                    <div class="thumb">
                                        <div class="inner-content">
                                            <h4>Kids</h4>
                                            <span>Best Clothes For Kids</span>
                                        </div>
                                        <div class="hover-content">
                                            <div class="inner">
                                            @if(!empty($display_information->service) && isset($display_information->service[3]))
                                                <h4>{{$display_information->service[3]}}</h4>
                                                <span>Sự hài lòng của bạn là niềm vui của chúng tôi</span>           
                                            @else
                                                <h4>Kids</h4>
                                                <p>Lorem ipsum dolor sit amet, conservisii ctetur adipiscing elit incid.</p>
                                            @endif 

                                                <div class="main-border-button">
                                                    <a href="{{ route('seller.business.all.product', ['domain' => request()->segment(2), 'category_slug' => request()->segment(3)]) }}">Discover More</a>
                                                </div>
                                            </div>
                                        </div>
                                        @if(!empty($display_information->images))
                                        <img class="img-fluid" src="https://drive.google.com/uc?export=view&id={{$display_information->images[3]}}" alt="">
                                        @else
                                        <img src="{{ asset('assets/shop_clothes/images/baner-right-image-03.jpg')}}">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="right-first-image">
                                    <div class="thumb">
                                        <div class="inner-content">
                                            <h4>Accessories</h4>
                                            <span>Best Trend Accessories</span>
                                        </div>
                                        <div class="hover-content">
                                            <div class="inner">
                                            @if(!empty($display_information->service) && isset($display_information->service[4]))
                                                <h4>{{$display_information->service[4]}}</h4>
                                                <span>Sự hài lòng của bạn là niềm vui của chúng tôi</span>           
                                            @else
                                                <h4>Accessories</h4>
                                                <p>Lorem ipsum dolor sit amet, conservisii ctetur adipiscing elit incid.</p>
                                            @endif 
                                                <div class="main-border-button">
                                                    <a href="{{ route('seller.business.all.product', ['domain' => request()->segment(2), 'category_slug' => request()->segment(3)]) }}">Discover More</a>
                                                </div>
                                            </div>
                                        </div>
                                        @if(!empty($display_information->images))
                                        <img class="img-fluid" src="https://drive.google.com/uc?export=view&id={{$display_information->images[4]}}" alt="">
                                        @else
                                        <img src="{{ asset('assets/shop_clothes/images/baner-right-image-04.jpg')}}">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Main Banner Area End ***** -->

    <!-- ***** Men Area Starts ***** -->
    <section class="section" id="men">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-heading">
                        <h2>Sản phẩm mới nhất</h2>
                        <span>Sản phẩm mới nhất được cập nhật trên website của chúng tôi</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="men-item-carousel">
                        <div class="owl-men-item owl-carousel">
                        @if(!empty($products))
                        @foreach ($products as $product)
                            <div class="item">
                                <div class="thumb">
                                    <div class="hover-content">
                                        <ul>
                                            <li><a href="{{route('seller.business.detail.product', ['domain' => request()->segment(2), 'category_slug' => request()->segment(3), 'id' => $product->id ])}}"><i class="fa fa-eye"></i></a>  
                                            <!-- <a href="{{route('seller.business.detail.product', ['domain' => request()->segment(2), 'category_slug' => request()->segment(3), 'id' => $product->id ])}}"><i class="fa fa-eye"></a> -->

                                        </li>
                                            <li><a href="single-product.html"><i class="fa fa-star"></i></a></li>
                                            <li><a href="single-product.html"><i class="fa fa-shopping-cart"></i></a></li>
                                        </ul>
                                    </div>
                                    <img src="https://drive.google.com/uc?export=view&id={{$product->image}}" alt="" style="max-height: 412px;object-fit: cover;">

                                </div>
                                <div class="down-content">                                   
                                    <h4>{{ $product->name}}</h4>
                                    <span>{{ number_format($product->price) }} VNĐ</span>
                                    <ul class="stars">
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                    </ul>
                                </div>
                            </div>
                            @endforeach
                            @else
                            <div class="item">
                                <div class="thumb">
                                    <div class="hover-content">
                                        <ul>
                                            <li><a href="single-product.html"><i class="fa fa-eye"></i></a></li>
                                            <li><a href="single-product.html"><i class="fa fa-star"></i></a></li>
                                            <li><a href="single-product.html"><i class="fa fa-shopping-cart"></i></a></li>
                                        </ul>
                                    </div>
                                    <img src="{{ asset('assets/shop_clothes/images/men-02.jpg')}}" alt="">
                                </div>
                                <div class="down-content">
                                    <h4>Air Force 1 X</h4>
                                    <span>$90.00</span>
                                    <ul class="stars">
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="item">
                                <div class="thumb">
                                    <div class="hover-content">
                                        <ul>
                                            <li><a href="single-product.html"><i class="fa fa-eye"></i></a></li>
                                            <li><a href="single-product.html"><i class="fa fa-star"></i></a></li>
                                            <li><a href="single-product.html"><i class="fa fa-shopping-cart"></i></a></li>
                                        </ul>
                                    </div>
                                    <img src="{{ asset('assets/shop_clothes/images/men-03.jpg')}}" alt="">
                                </div>
                                <div class="down-content">
                                    <h4>Love Nana ‘20</h4>
                                    <span>$150.00</span>
                                    <ul class="stars">
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="item">
                                <div class="thumb">
                                    <div class="hover-content">
                                        <ul>
                                            <li><a href="single-product.html"><i class="fa fa-eye"></i></a></li>
                                            <li><a href="single-product.html"><i class="fa fa-star"></i></a></li>
                                            <li><a href="single-product.html"><i class="fa fa-shopping-cart"></i></a></li>
                                        </ul>
                                    </div>
                                    <img src="{{ asset('assets/shop_clothes/images/men-01.jpg')}}" alt="">
                                </div>
                                <div class="down-content">
                                    <h4>Classic Spring</h4>
                                    <span>$120.00</span>
                                    <ul class="stars">
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                    </ul>
                                </div>
                            </div>

                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Men Area Ends ***** -->


    <!-- ***** Explore Area Starts ***** -->
    <section class="section" id="explore">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="left-content">
                        <h2>Khám phá sản phẩm của chúng tôi</h2>
                        <span>Với mục tiêu mang đến sự phong cách và thoải mái cho khách hàng, chúng tôi chọn lựa kỹ lưỡng từng sản phẩm trong bộ sưu tập. Chất liệu cao cấp, cắt may tỉ mỉ và sự tinh tế trong từng chi tiết là những yếu tố mà chúng tôi không bao giờ bỏ qua</span>
                        <div class="quote">
                            <i class="fa fa-quote-left"></i><p>Với sự đa dạng trong mẫu mã và kiểu dáng, cửa hàng quần áo của chúng tôi là nơi bạn có thể tìm thấy những sản phẩm phù hợp với mọi dịp, từ những bữa tiệc sang trọng, ngày làm việc bận rộn cho đến những buổi dạo chơi thoải mái cùng bạn bè và gia đình.</p>
                        </div>
                        <p>Chúng tôi luôn cập nhật bộ sưu tập mới theo xu hướng thời trang hiện đại nhất để bạn luôn được trải nghiệm những điều mới mẻ và thú vị.</p>
                        <p>Không chỉ dừng lại ở việc bán sản phẩm, chúng tôi mong muốn xây dựng một cộng đồng thời trang nơi bạn có thể cùng nhau chia sẻ và trao đổi về những phong cách và xu hướng thời trang yêu thích. </p>
                        <div class="main-border-button">
                            <a href="{{ route('seller.business.all.product', ['domain' => request()->segment(2), 'category_slug' => request()->segment(3)]) }}">Discover More</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="right-content">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="leather">
                                    <h4>Leather Bags</h4>
                                    <span>Latest Collection</span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="first-image">
                                    <img src="{{ asset('assets/shop_clothes/images/explore-image-01.jpg')}}" alt="">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="second-image">
                                    <img src="{{ asset('assets/shop_clothes/images/explore-image-02.jpg')}}" alt="">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="types">
                                    <h4>Different Types</h4>
                                    <span>Over 304 Products</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Explore Area Ends ***** -->

    <!-- ***** Social Area Starts ***** -->
    <section class="section" id="social">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading">
                        <h2>Truyền thông xã hội</h2>
                        <span>Chi tiết đến từng chi tiết chính là điều làm nên sự khác biệt của {$business->name}.</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row images">
                <div class="col-2">
                    <div class="thumb">
                        <div class="icon">
                            <a href="http://instagram.com">
                                <h6>Fashion</h6>
                                <i class="fa fa-instagram"></i>
                            </a>
                        </div>
                        <img src="{{ asset('assets/shop_clothes/images/instagram-01.jpg')}}" alt="">
                    </div>
                </div>
                <div class="col-2">
                    <div class="thumb">
                        <div class="icon">
                            <a href="http://instagram.com">
                                <h6>New</h6>
                                <i class="fa fa-instagram"></i>
                            </a>
                        </div>
                        <img src="{{ asset('assets/shop_clothes/images/instagram-02.jpg')}}" alt="">
                    </div>
                </div>
                <div class="col-2">
                    <div class="thumb">
                        <div class="icon">
                            <a href="http://instagram.com">
                                <h6>Brand</h6>
                                <i class="fa fa-instagram"></i>
                            </a>
                        </div>
                        <img src="{{ asset('assets/shop_clothes/images/instagram-03.jpg')}}" alt="">
                    </div>
                </div>
                <div class="col-2">
                    <div class="thumb">
                        <div class="icon">
                            <a href="http://instagram.com">
                                <h6>Makeup</h6>
                                <i class="fa fa-instagram"></i>
                            </a>
                        </div>
                        <img src="{{ asset('assets/shop_clothes/images/instagram-04.jpg')}}" alt="">
                    </div>
                </div>
                <div class="col-2">
                    <div class="thumb">
                        <div class="icon">
                            <a href="http://instagram.com">
                                <h6>Leather</h6>
                                <i class="fa fa-instagram"></i>
                            </a>
                        </div>
                        <img src="{{ asset('assets/shop_clothes/images/instagram-05.jpg')}}" alt="">
                    </div>
                </div>
                <div class="col-2">
                    <div class="thumb">
                        <div class="icon">
                            <a href="http://instagram.com">
                                <h6>Bag</h6>
                                <i class="fa fa-instagram"></i>
                            </a>
                        </div>
                        <img src="{{ asset('assets/shop_clothes/images/instagram-06.jpg')}}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Social Area Ends ***** -->

    <!-- ***** Subscribe Area Starts ***** -->
    <div class="subscribe">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="section-heading">
                        <h2>Đăng ký với chúng tôi</h2>
                        <span>Đăng ký email để nhận các thông báo mới nhất về các sản phẩm.</span>
                    </div>
                    <form id="subscribe" action="" method="get">
                        <div class="row">
                          <div class="col-lg-5">
                            <fieldset>
                              <input name="name" type="text" id="name" placeholder="Your Name" required="">
                            </fieldset>
                          </div>
                          <div class="col-lg-5">
                            <fieldset>
                              <input name="email" type="text" id="email" pattern="[^ @]*@[^ @]*" placeholder="Your Email Address" required="">
                            </fieldset>
                          </div>
                          <div class="col-lg-2">
                            <fieldset>
                              <button type="submit" id="form-submit" class="main-dark-button"><i class="fa fa-paper-plane"></i></button>
                            </fieldset>
                          </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-4">
                    <div class="row">
                        <div class="col-6">
                            <ul>
                                <li>Vị trí cửa hàng:<br>
                                @if(!empty($business->address))
                                    @php
                                        $decodedAddress = json_decode($business->address);
                                        $provinceName = App\Province::where('id', $decodedAddress->province)->first();
                                        $districtName = App\District::where('id', $decodedAddress->district)->first();
                                        $wardName = App\Ward::where('id', $decodedAddress->ward)->first();
                                    
                                    @endphp
                                @endif
                                <span>{{!empty($provinceName->city_name) ? $provinceName->city_name : 'Sunny Isles Beach'}}, {{!empty($districtName->districts_name) ? $districtName->districts_name : ' FL 33160'}}, {{!empty($wardName->wards_name) ? $wardName->wards_name : ' United States'}}</span></li>
                                <li>Số điện thoại:<br><span>{{$business->phone_number}}</span></li>
                            </ul>
                        </div>
                        <div class="col-6">
                            <ul>
                                <li>Giờ mở cửa:<br><span>07:30 AM - 9:30 PM mỗi ngày</span></li>
                                <li>Email:<br><span>{{$business->email}}</span></li>
                                <li>Social Media:<br><span><a href="#">Facebook</a>, <a href="#">Instagram</a>, <a href="#">Behance</a>, <a href="#">Linkedin</a></span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection