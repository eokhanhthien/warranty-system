@extends('view-seller.ecommerce.agriculture.layout.layout')
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
      object-fit: contain;
      max-height: 400px;
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

    .content-detail img{
      width: 100% !important;
      object-fit: contain;
    }
    .table {
      display: flex;
      flex-direction: column;
      width: 100%; /* Điều chỉnh độ rộng theo nhu cầu */
    }

    .row {
      display: flex;
      flex-direction: row;
    }

    .column {
      flex: 1;

      text-align: center;
      line-height: 40px; /* Căn giữa văn bản theo chiều dọc */
    }

    .white {
      text-align: left;
      background-color: #fff; /* Màu trắng */
    }

    .gray {
      text-align: left;
      background-color: #f3f3f3; /* Màu xám */
    }
    .sticky-content{
      position: sticky;
      top: 140px;
    }
  </style>

<div class="container-xxl "  style="padding-top:160px">
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
                  <h4>{{$product->name}}</h4>
                  <input type="hidden" name="product_id" value="{{ $product->id }}">

                  <h5 class="text-primary">{{ number_format($product->price)}} đ @if(!empty($variant)) <span> (Option mặc định)</span> @endif</h5>
                  <div class="row" style="font-size: 14px;">
                      @if(!empty($variant))
                              @foreach ($variant as $index => $variantItem)
                              <div class="col-sm-3 col-6 mt-2">
                                      <div class="card" onclick="handleCardClick(this)">
                                          <div class="card-body">
                                              <input type="checkbox" name="variant_checkbox" value="{{ $variantItem->id }}">
                                              <strong class="card-title">Option: {{$index + 1 }} </strong>
                                              <p class="m-0">{{ $variantItem->title_1 }}: <span>{{ $variantItem->value_1 }}</span></p>
                                              <p class="m-0">{{ $variantItem->title_2 }}: <span>{{ $variantItem->value_2 }}</span></p>
                                              <p class="text-primary m-0">Giá: {{ $variantItem->price }} VNĐ</p>
                                              <p class="m-0">Số lượng: {{ $variantItem->stock }}</p>
                                          </div>
                                      </div>
                                </div>
                              @endforeach
                      @endif
                  </div>
                  <button class='btn btn-primary mt-3 add-cart-detail' onclick="addToCart()">Thêm vào giỏ hàng</button>
              </div>
            </div>

            <div class="row content-detail ">
              <div class="col col-md-8 col-12">
                @if(isset($product_detail->content))
                    {!! $product_detail->content !!}
                @endif
              </div>
              <div class="col col-md-4 col-12">
              <div class="table text-left sticky-content">
      
                  @if (!empty($product_attribute) && count($product_attribute) > 0)
                      @foreach(array_keys($product_attribute) as $index => $key)
                          <div class="row">
                              <div class="column {{ $index % 2 == 0 ? 'gray' : 'white' }}">
                              @foreach ($attributes as $attribute)
                                  @if ($attribute['req_name'] === $key)
                                      {{ $attribute['title'] }}
                                  @endif
                              @endforeach
                              </div>
                              <div class="column {{ $index % 2 == 0 ? 'gray' : 'white' }}">{{ $product_attribute[$key] }}</div>
                          </div>
                      @endforeach
                  @endif
              </div>
            </div>

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
                  variant_id: variantId,
                  quantity : 1
                },
                success: function(response) {
                  if(response.success == 1){
                    toastr.success(response.message);
                  }else{
                    toastr.error(response.message);
                  }
                }
            });
        // console.log(variantId,product_id);
    }
</script>
@endsection