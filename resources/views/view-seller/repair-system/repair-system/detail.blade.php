@extends('view-seller.repair-system.repair-system.layout.layout')
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

<div class="container-xxl py-5">
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
                  <input type="hidden" name="product_id" value="{{ $product->id }}">

                  <h3 class="text-primary">{{ number_format($product->price)}} đ @if(!empty($variant)) <span> (Option mặc định)</span> @endif</h3>
                  <div class="row">
                      @if(!empty($variant))
                              @foreach ($variant as $index => $variantItem)
                                  <div class="col-6 col-sm-6 col-6 mt-2">
                                      <div class="card" onclick="handleCardClick(this)">
                                          <div class="card-body">
                                              <input type="checkbox" name="variant_checkbox" value="{{ $variantItem->id }}">
                                              <h5 class="card-title">Option: {{$index + 1 }} </h5>
                                              <div class="">{{ $variantItem->title_1 }}: <span>{{ $variantItem->value_1 }}</span></div>
                                              <div class="">{{ $variantItem->title_2 }}: <span>{{ $variantItem->value_2 }}</span></div>
                                              <div class="text-primary">Giá: {{ $variantItem->price }} VNĐ</div>
                                              <div class="">Số lượng trong kho: {{ $variantItem->stock }}</div>
                                          </div>
                                      </div>
                                </div>
                              @endforeach
                      @endif
                  </div>
                  <button class='btn btn-primary mt-3' onclick="addToCart()">Thêm vào giỏ hàng</button>
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
  <script>
function handleCardClick(card) {
    var checkboxes = document.querySelectorAll('input[name="variant_checkbox"]');
    var cardCheckbox = card.querySelector('input[name="variant_checkbox"]');
    
    // Nếu checkbox trong card được click đã được chọn trước đó
    if (cardCheckbox.checked) {
        // Bỏ chọn checkbox
        cardCheckbox.checked = false;
    } else {
        // Bỏ chọn tất cả các checkbox trước đó
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = false;
        });
        
        // Chọn checkbox trong card được click
        cardCheckbox.checked = true;
    }
}


    function addToCart() {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        var selectedVariant = document.querySelector('input[name="variant_checkbox"]:checked');
        var product_id = document.querySelector('input[name="product_id"]').value;
        if (selectedVariant) {
          var variantId = selectedVariant.value;
        }
        $.ajax({
                url: "{{ route('cart.add')}}",
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                data: {
                  product_id: product_id,
                  variant_id: variantId
                },
                // success: function(data) {
                //     $('#list_product').empty();
                //     $('#pagination').empty();
                //     if (data.data.length == 0) {
                //         // Hiển thị thông báo "Not Found"
                //         $('#list_product').html(`
                //             <div id="notFound">
                //                 <img src="https://cdn.dribbble.com/users/721524/screenshots/4117132/untitled-1-_1_.png" alt="Not Found">
                //                 <p>Không tìm thấy sản phẩm nào.</p>
                //             </div>
                //         `);
                //     } else {
                //         $('#list_product').html(data.data);
                //     }
                //     $('#pagination').html(data.pagination);
                // }
            });
        // console.log(variantId,product_id);
    }
</script>
@endsection