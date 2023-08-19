<div class="nav-align-top mb-4">
                    <ul class="nav nav-tabs nav-fill" role="tablist">
                      <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-home" aria-controls="navs-justified-home" aria-selected="true">
                          <i class="tf-icons bx bx-home"></i> Home
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
                      <div class="tab-pane fade active show" id="navs-justified-home" role="tabpanel">
                      <h6 class="card-title text-primary">Ảnh đầu trang  
                        <span class="demo-inline-spacing cursor-pointer">
                          <span class=" me-1"  data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="true" aria-controls="collapseExample">
                          <i class='bx bx-question-mark'></i>
                          </span>
                        </span>
                      </h6>
                    
                      <div class="collapse" id="collapseExample">
                        <div class="d-grid d-sm-flex p-3 border">
                          <!-- <img src="https://static-cse.canva.com/image/77825/banner.jpg" alt="collapse-image" height="300" class="me-4 mb-sm-0 mb-2"> -->
                          <img  class="img-fluid" src="https://drive.google.com/uc?export=view&id=1dgJ-GFBV43v5maQaH1JrSS36yW6SFIoW" alt="" style =" width: 500px">

                          <span>
                            <p>Banner là các hình ảnh phía trên cùng của website.</p>
                            <p>Banner được sử dụng để thu hút sự chú ý của người xem. Người truy cập khi họ lướt qua các banner quảng cáo trên trang web. Tiêu đề phải súc tích và truyền đạt những thông điệp mà bạn muốn gửi tới khách hàng.</p>
                          </span>
                        </div>
                     </div>   
                     <form  class="mt-4" action="{{route('admin.set.business.display')}}" enctype="multipart/form-data" method="POST">
                      @csrf
                     <h6 class="card-title text-primary">Ảnh cũ</h6>
                      <div class="row">
                          @if(isset($display_information->images) && !empty($display_information->images))
                                  @foreach($display_information->images as $image)
                                  <div class="col-lg-2 col-sm-4 col-md-3 col-6 mb-3">
                                      <img  class="img-fluid" src="https://drive.google.com/uc?export=view&id={{$image}}" alt="" style ="width: 100px">
                                  </div>
                                  @endforeach
                          @endif
                      
                      <h6 class="card-title text-primary">Thêm mới ảnh </h6>
                      <p style = "color: red">Lưu ý: nếu thêm ảnh mới thì các ảnh cũ sẽ bị xóa đi</p>
                        @for($i = 0; $i < 5; $i++)
                                    <div class="thumbnail col-lg-2 col-sm-4 col-md-3 col-6 mb-3">
                                        <label for="thumbnailInput{{$i}}">
                                            <img src="https://via.placeholder.com/150" alt="Ảnh {{$i+1}}" id="thumbnail{{$i}}">
                                            <!-- <p>Ảnh {{$i+1}}</p> -->
                                        </label>
                                        <input type="file" id="thumbnailInput{{$i}}" name="images[{{$i}}]" accept="image/*" style="display:none;">
                                    </div>
                        @endfor

                        </div>

                        <h6 class="card-title text-primary">Tiêu đề tương ứng trên mỗi ảnh </h6>
                        <div id="input-container">
                        <!-- Input ban đầu -->
                        @if (!empty($display_information->service) )
                            @foreach ($display_information->service as $index => $value)
                                <div class="input-group m-2">
                                    <label for="title_banner_3">Tiêu đề {{ $index + 1 }}:</label>
                                    <input type="text" name="service[{{ $index }}]" class="form-control" value="{{ $value }}">
                                </div>
                            @endforeach
                        @else
                        <div class="input-group m-2">
                          <label for="title_banner_3">Tiêu đề 1: </label>
                            <input type="text" name="service[0]" class="form-control">
                        </div>
                        <div class="input-group m-2">
                          <label for="title_banner_3">Tiêu đề 2: </label>
                            <input type="text" name="service[1]" class="form-control">
                        </div>
                        <div class="input-group m-2">
                          <label for="title_banner_3">Tiêu đề 3: </label>
                            <input type="text" name="service[2]" class="form-control">
                        </div>
                        <div class="input-group m-2">
                          <label for="title_banner_3">Tiêu đề 4: </label>
                            <input type="text" name="service[3]" class="form-control">
                        </div>
                        <div class="input-group m-2">
                          <label for="title_banner_3">Tiêu đề 5: </label>
                            <input type="text" name="service[4]" class="form-control">
                        </div>
                        @endif
                        </div>

                        <h6 class="card-title text-primary">Thêm mới ảnh tiêu đề trang sản phẩm</h6>
                          @if(!empty($display_information->image))         
                                    <div class="img-size col-6 col-lg-3 col-sm-6 mt-2">
                                      <img src="https://drive.google.com/uc?export=view&id={{$display_information->image}}" style="width: 100%; "alt="">
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

                        <div class="text-right">
                          <button style="submit" class="btn btn-primary ">Lưu</button>
                        </div>
                      </form>
                        </div>


                        <input type="file" id="imageInput" accept="image/*" style="display:none;">
                        <input type="hidden" id="selectedImagesData" name="images[]" value="">

                        <input type="hidden" id="" name="image_width" value="1000" >
                        <input type="hidden" id="" name="image_height" value="600" >


                      <div id="thumbnailContainer" class="row"></div>
       
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
                  </div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const numThumbnails = 5;
        for (let i = 0; i < numThumbnails; i++) {
            const thumbnailInput = document.getElementById(`thumbnailInput${i}`);
            thumbnailInput.addEventListener('change', function (event) {
                const thumbnailIndex = i;
                const files = event.target.files;

                if (files && files.length > 0) {
                    const file = files[0];
                    const reader = new FileReader();
                    reader.onload = function () {
                        const imageDataUrl = reader.result;
                        const thumbnailImg = document.getElementById(`thumbnail${thumbnailIndex}`);
                        if (thumbnailImg) {
                            thumbnailImg.src = imageDataUrl;
                        }
                    };
                    reader.readAsDataURL(file);
                }
            });
        }
      });
</script>       