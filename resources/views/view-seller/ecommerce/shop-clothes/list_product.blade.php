 @if(!empty($products))
    @foreach($products as $product)
    <div class="product col-lg-3 col-6" style="z-index: 1;">
        <div class="make3D">
            
                <div class="shadow"></div>
                <div class="img-siza" style ="max-height: 243px;overflow: hidden;" >
                    <img  class="" src="https://drive.google.com/uc?export=view&id={{$product->image}}" alt="" style ="width: 100% ">
                </div>

                <div class="image_overlay"></div>
                <div class="add_to_cart">Thêm giỏ hàng</div>
                <a href="{{route('seller.business.detail.product', ['domain' => request()->segment(2), 'category_slug' => request()->segment(3), 'id' => $product->id ])}}"><div class="view_gallery">Xem chi tiết</div></a>  
                <div class="p-3">          
                    <span class="product_name">{{$product->name}}</span>    
                    <p class="text-primary">{{number_format($product->price)}} đ</p>                                                 
                    <div class="product-options">
                        <strong>SIZES</strong>
                        <span>XS, S, M, L, XL, XXL</span>                     
                    </div>  
                </div>
                    
        </div>	
    </div>
    @endforeach
    @endif

    
