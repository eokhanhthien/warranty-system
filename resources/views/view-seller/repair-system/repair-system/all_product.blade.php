@extends('view-seller.repair-system.repair-system.layout.layout')
@section('content')
  <!-- Page Header Start -->
  <div class="container-fluid page-header mb-5 py-5">
        <div class="container">
            <h1 class="display-3 text-white mb-3 animated slideInDown">Tất cả sản phẩm</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb text-uppercase">
                    <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">About</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->
    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-3 col-md-3 " data-wow-delay="0.1s">
                <div id="sidebar">  
                    <h3>CATEGORIES</h3>
                    <div class="checklist categories">
                        <ul>
                            <li><a href=""><span></span>New Arivals</a></li>
                            <li><a href=""><span></span>Accesories</a></li>
                            <li><a href=""><span></span>Bags</a></li>
                            <li><a href=""><span></span>Dressed</a></li>
                            <li><a href=""><span></span>Jackets</a></li>
                            <li><a href=""><span></span>jewelry</a></li>
                            <li><a href=""><span></span>Shoes</a></li>
                            <li><a href=""><span></span>Shirts</a></li>
                            <li><a href=""><span></span>Sweaters</a></li>
                            <li><a href=""><span></span>T-shirts</a></li>
                        </ul>
                    </div>
                    
                    <h3>COLORS</h3>
                    <div class="checklist colors">
                        <ul>
                            <li><a href=""><span></span>Beige</a></li>
                            <li><a href=""><span style="background:#222"></span>Black</a></li>
                            <li><a href=""><span style="background:#6e8cd5"></span>Blue</a></li>
                            <li><a href=""><span style="background:#f56060"></span>Brown</a></li>
                            <li><a href=""><span style="background:#44c28d"></span>Green</a></li>
                        </ul>
                        
                        <ul>
                            <li><a href=""><span style="background:#999"></span>Grey</a></li>
                            <li><a href=""><span style="background:#f79858"></span>Orange</a></li>
                            <li><a href=""><span style="background:#b27ef8"></span>Purple</a></li>
                            <li><a href=""><span style="background:#f56060"></span>Red</a></li>
                            <li><a href=""><span style="background:#fff;border: 1px solid #e8e9eb;width:13px;height:13px;"></span>White</a></li>
                        </ul>        
                    </div>
                    
                    <h3>SIZES</h3>
                    <div class="checklist sizes">
                        <ul>
                            <li><a href=""><span></span>XS</a></li>
                            <li><a href=""><span></span>S</a></li>
                            <li><a href=""><span></span>M</a></li>
                        </ul>
                        
                        <ul>
                            <li><a href=""><span></span>L</a></li>
                            <li><a href=""><span></span>XL</a></li>
                            <li><a href=""><span></span>XXL</a></li>
                        </ul>        
                    </div>
                    
                    <h3>PRICE RANGE</h3>
                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/price-range.png" alt="" />
                </div>
                </div>
                <div class="col-lg-9 col-md-9 " data-wow-delay="0.3s">
           
                    <div class="row">
                        @if(!empty($products))
                        @foreach($products as $product)
                        <div class="product col-lg-3 col-6" style="z-index: 1;">
                            <div class="make3D">
                                
                                    <div class="shadow"></div>
                                    <!-- <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/1.jpg" alt=""> -->
                                    <img  class="" src="https://drive.google.com/uc?export=view&id={{$product->image}}" alt="" style ="width: 100%">

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
                    
                        
                    </div>
                </div>
        </div>
        </div>
    </div>


@endsection