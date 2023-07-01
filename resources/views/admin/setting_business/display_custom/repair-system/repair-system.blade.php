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
                     <form id="imageUploadForm" class="mt-4">
                        <div class="form-group">
                          <label for="imageUpload" class="control-label">Chọn hình ảnh (tối đa 4 ảnh)</label>
                          <label class="custom-file-upload">
                            <input type="file" id="imageUpload" name="images[]" multiple accept="image/*" class="file-upload">
                            Chọn tệp
                          </label>
                          <small id="imageUploadMessage" class="form-text text-muted"></small>
                        </div>

                        <div class="form-group">
                            <label for="input1">Tiêu đề 1:</label>
                            <input type="text" class="form-control" id="input1" name="input1">
                        </div>

                        <div class="form-group">
                            <label for="input2">Tiêu đề 2:</label>
                            <input type="text" class="form-control" id="input2" name="input2">
                        </div>

                        <div class="form-group">
                            <label for="input3">Tiêu đề 3:</label>
                            <input type="text" class="form-control" id="input3" name="input3">
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
              
                        <div id="input-container">
                        <!-- Input ban đầu -->
                        <div class="input-group">
                            <input type="text" name="service[0]" class="form-control">
                            <div class="btn btn-danger" onclick="removeInput(this)">Xóa</div>
                        </div>
                        </div>
                        <div class="btn btn-primary mt-4" onclick="addInput()">Thêm</div>
                      </form>

                      <div id="thumbnailContainer" class="row"></div>
                      </div>
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

