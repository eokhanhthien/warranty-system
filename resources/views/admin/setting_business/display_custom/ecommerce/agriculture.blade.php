<div class="nav-align-top mb-4">
                    <ul class="nav nav-tabs nav-fill" role="tablist">
                      <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-home" aria-controls="navs-justified-home" aria-selected="true">
                          <i class="tf-icons bx bx-home"></i> Website
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-profile" aria-controls="navs-justified-profile" aria-selected="false">
                          <i class="tf-icons bx bx-user"></i> Profile
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-messages" aria-controls="navs-justified-messages" aria-selected="false">
                          <i class="tf-icons bx bx-message-square"></i> Messages
                        </button>
                      </li>
                    </ul>
                    <div class="tab-content">
                      <!-- Tab 1 -->
                      <div class="tab-pane fade active show" id="navs-justified-home" role="tabpanel">
                      <h6 class="card-title text-primary">Banner  
                        <span class="demo-inline-spacing cursor-pointer">
                          <span class=" me-1"  data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="true" aria-controls="collapseExample">
                          <i class='bx bx-question-mark'></i>
                          </span>
                        </span>
                      </h6>
                    
                      <div class="collapse" id="collapseExample">
                        <div class="d-grid d-sm-flex p-3 border">
                        <img src="{{ asset('img/repair-system.png')}}" alt="collapse-image" class="me-4 mb-sm-0 mb-2 img-fluid col-lg-6 col-sm-12" style="object-fit: contain;">
                          <span class="col-lg-6 col-sm-12">
                            <p>Banner là các hình ảnh phía trên cùng của website.</p>
                            <p>Banner được sử dụng để thu hút sự chú ý của người xem. Người truy cập khi họ lướt qua các banner quảng cáo trên trang web. Tiêu đề phải súc tích và truyền đạt những thông điệp mà bạn muốn gửi tới khách hàng.</p>
                          </span>
                        </div>
                     </div>   
                     <form id="imageUploadForm" class="mt-4" action="{{route('admin.set.business.display')}}" enctype="multipart/form-data" method="POST">
                    @csrf
                        <div class="form-group">
                          <label for="imageUpload" class="control-label">Chọn hình ảnh (tối đa 4 ảnh)</label>
                          <label class="custom-file-upload">
                            <input type="file" id="imageUpload" name="images[]" multiple accept="image/*" class="file-upload">
                            Chọn tệp
                          </label>
                          <div for="imageUpload" class="control-div"><strong>Ảnh Banner nên có kích thước > 1200x600</strong> </div>
                          <small id="imageUploadMessage" class="form-text text-muted"></small>
                        </div>
                        <input type="hidden" id="" name="image_width" value="3000" >
                        <input type="hidden" id="" name="image_height" value="1000" >

                        <div id="thumbnailContainer" class="row"></div>
                        <div class="row">
                        @if(!empty($display_information->images))
                            @foreach($display_information->images as $image)
                                <!-- <iframe src="https://drive.google.com/file/d/{{$image}}/preview" alt="" style="width: 120px; height: 120px"></iframe> -->
                                  <div class="img-size col-6 col-lg-3 col-sm-6 mt-2">
                                    <img src="https://drive.google.com/uc?export=view&id={{$image}}" style="width: 100%;  height: 150px; object-fit: cover;"alt="">
                                  </div>
                            @endforeach
                        @endif
                        </div>

                        <div class="form-group">
                            <label for="title_banner_1">Tiêu đề banner chính:</label>
                            <input type="text" class="form-control" id="title_banner_1" name="title_banner[0]" value ="{{ data_get($display_information, 'title_banner.0') }}">
                        </div>

                        <div class="form-group">
                            <label for="title_banner_2">Tiêu đề banner phụ:</label>
                            <input type="text" class="form-control" id="title_banner_2" name="title_banner[1]" value ="{{ data_get($display_information, 'title_banner.1') }}">
                        </div>

                        <div class="form-group">
                            <label for="title_banner_3">Tiêu đề banner phụ:</label>
                            <input type="text" class="form-control" id="title_banner_3" name="title_banner[2]" value ="{{ data_get($display_information, 'title_banner.2') }}">
                        </div>


                        <h6 class="card-title text-primary">Thêm mới ảnh tiêu đề trang sản phẩm</h6>
                          @if(!empty($display_information->image))         
                                    <div class="img-size col-6 col-lg-3 col-sm-6 mt-2">
                                      <img src="https://drive.google.com/uc?export=view&id={{$display_information->image}}" style="width: 100%;"alt="">
                                    </div>                   
                          @endif
                          <p style = "color: red">Lưu ý: nếu thêm ảnh mới thì các ảnh cũ sẽ bị xóa đi</p>
                          <div class="thumbnails row">
                            <div class="thumbnail col-lg-2 col-sm-4 col-md-3 col-6 mb-3">
                                    <label for="imageInput">
                                        <img src="https://via.placeholder.com/150" alt="Ảnh mới" id="imageThumbnail">
                                    </label>
                                    <input type="file" id="imageInput" name="image" accept="image/*" style="display:none;">
                            </div>
                          </div>


                        <h6 class="card-title text-primary">Các dịch vụ của bạn  
                            <span class="demo-inline-spacing cursor-pointer">
                            <span class=" me-1"  data-bs-toggle="collapse" data-bs-target="#collapseService" aria-expanded="true" aria-controls="collapseService">
                            <i class='bx bx-question-mark'></i>
                            </span>
                            </span>
                        </h6>

                        <div class="collapse" id="collapseService">
                            <div class="d-grid d-sm-flex p-3 border">
                            <img src="{{ asset('img/repair-service.png')}}" alt="collapse-image" height="300" class="me-4 mb-sm-0 mb-2 img-fluid col-lg-6 col-sm-12" style="object-fit: contain;">
                            <span class="col-lg-6 col-sm-12">
                                <p>Hãy thêm các dịch vụ vủa bạn.</p>
                                <p>Mô tả ngắn gọn để khách hàng có cái nhìn tổng quát về doanh nghiệp của bạn</p>
                            </span>
                            </div>
                        </div> 
                        <div class="form-group">
                          <label for="">Mô tả cửa hàng:</label>
                          <textarea class="form-control mt-3 mb-3" style="height: 100px" placeholder="Mô tả cửa hàng của bạn" name="service_title">{{!empty($display_information->service_title) ? $display_information->service_title : '' }}</textarea>    
                        </div>   
                        
                        <label for="title_banner_3">Các dịch vụ cửa hàng:</label>
                    
                        <div id="input-container">
                        <!-- Input ban đầu -->
                        @if (!empty($display_information->service) )
                            @foreach ($display_information->service as $index => $value)
                                <div class="input-group">
                                    <input type="text" name="service[{{ $index }}]" class="form-control" value="{{ $value }}">
                                    <div class="btn btn-danger" onclick="removeInput(this)">Xóa</div>
                                </div>
                            @endforeach
                        @else
                        <div class="input-group">
                            <input type="text" name="service[0]" class="form-control">
                            <div class="btn btn-danger" onclick="removeInput(this)">Xóa</div>
                        </div>
                        @endif
                        </div>
                        <div class="btn btn-success mt-4" onclick="addInput()">Thêm dịch vụ</div>

                        <div class="text-right">
                          <button style="submit" class="btn btn-primary ">Lưu</button>
                        </div>
                      </form>


                      </div>
                      <!-- Tab 2 -->
                      <div class="tab-pane fade" id="navs-justified-profile" role="tabpanel">
                        <p>
                          Donut dragée jelly pie halvah. Danish gingerbread bonbon cookie wafer candy oat cake ice
                          cream. Gummies halvah tootsie roll muffin biscuit icing dessert gingerbread. Pastry ice cream
                          cheesecake fruitcake.
                        </p>
                        <p class="mb-0">
                          Jelly-o jelly beans icing pastry cake cake lemon drops. Muffin muffin pie tiramisu halvah
                          cotton candy liquorice caramels.
                        </p>
                      </div>

                      <!-- Tab 3 -->
                      <div class="tab-pane fade" id="navs-justified-messages" role="tabpanel">
                        <p>
                          Oat cake chupa chups dragée donut toffee. Sweet cotton candy jelly beans macaroon gummies
                          cupcake gummi bears cake chocolate.
                        </p>
                        <p class="mb-0">
                          Cake chocolate bar cotton candy apple pie tootsie roll ice cream apple pie brownie cake. Sweet
                          roll icing sesame snaps caramels danish toffee. Brownie biscuit dessert dessert. Pudding jelly
                          jelly-o tart brownie jelly.
                        </p>
            </div>
        </div>
    </div>

