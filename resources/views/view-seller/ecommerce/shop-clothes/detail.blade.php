@extends('view-seller.ecommerce.shop-clothes.layout.layout')
@section('content')
<style>  
    .swiper {
      width: 100%;
      height: 100%;
    }

    .swiper-slide {
      text-align: center;
      font-size: 18px;
      background: #fff;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .swiper-slide img {
      display: block;
      width: 100%;
      height: 100%;
      object-fit: cover;
    }


    .swiper {
      width: 100%;
      height: 300px;
      margin-left: auto;
      margin-right: auto;
    }

    .swiper-slide {
      background-size: cover;
      background-position: center;
    }

    .mySwiper2 {
      height: 70%;
      width: 100%;
    }

    .mySwiper {
      height: 20%;
      box-sizing: border-box;
      padding: 10px 0;
    }

    .mySwiper .swiper-slide {
      width: 25%;
      height: 100%;
      opacity: 0.4;
    }

    .mySwiper .swiper-slide-thumb-active {
      opacity: 1;
    }

    .swiper-slide img {
      display: block;
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
    .content-detail img{
      width: 100% !important;
      object-fit: contain;
    }
  </style>

<div class="container-xxl py-5" style="margin-top: 100px;">
        <div class="container">     
            <div class="row">
                <div class="col-lg-6">
                <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="swiper mySwiper2">
                  <div class="swiper-wrapper">
                  @php
                    $decodedImages = json_decode($product_detail->images);
                  @endphp

                  @if(!empty($decodedImages))
                    @foreach($decodedImages as $image)
                      <div class="swiper-slide">
                        <img class="" src="https://drive.google.com/uc?export=view&id={{ $image }}" alt="" style="width: 100%">
                      </div>
                    @endforeach
                  @endif

                  
                  </div>
                  <div class="swiper-button-next"></div>
                  <div class="swiper-button-prev"></div>
                </div>
                  <div thumbsSlider="" class="swiper mySwiper">
                    <div class="swiper-wrapper">
                    @if(!empty($decodedImages))
                      @foreach($decodedImages as $image)
                        <div class="swiper-slide">
                          <img class="" src="https://drive.google.com/uc?export=view&id={{ $image }}" alt="" style="width: 100%">
                        </div>
                      @endforeach
                    @endif
                    </div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <h3>{{$product->name}}</h3>
                  <h3 class="text-primary">{{ number_format($product->price)}} đ</h3>
                  <button class='btn btn-primary'>Thêm vào giỏ hàng</button>
                </div>
            </div>

            <div class="row content-detail">
            @if(isset($product_detail->content))
                {!! $product_detail->content !!}
            @endif
            </div>
        </div>
</div>
<script>
    var swiper = new Swiper(".mySwiper", {
      loop: true,
      spaceBetween: 10,
      slidesPerView: 4,
      freeMode: true,
      watchSlidesProgress: true,
    });
    var swiper2 = new Swiper(".mySwiper2", {
      loop: true,
      spaceBetween: 10,
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      thumbs: {
        swiper: swiper,
      },
    });
  </script>
@endsection