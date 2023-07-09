<div class="nav-align-top mb-4">
      
                      <div class="tab-pane fade active show" id="navs-justified-home" role="tabpanel">

                        <div class="form-group">
                            <label for="name"><h6 class="card-title text-primary">Tên dịch vụ  </h6> </label>
                            <input type="text" class="form-control" id="name" name="name" value ="{{!empty($business_service->name) ? $business_service->name : '' }}">
                            <span class="error-message" id="name-error"></span>

                        </div>

                        <h6 class="card-title text-primary">Ảnh</h6>
                        <div class="form-group">
                                <label for="image">Ảnh nhỏ</label>
                                <input type="file" class="form-control" id="image" name="image" onchange="displayThumbnail(event)">
                                <span class="error-message" id="image-error"></span>
                        </div>
                        @include('select-options.show_thumnail')
                        <input type="hidden" id="" name="image_width" value="408" >
                        <input type="hidden" id="" name="image_height" value="230" >


                        
                        <div class="form-group">
                          <label for="short_description"><h6 class="card-title text-primary mt-3">Mô tả ngắn gọn dịch vụ của bạn</h6> </label>
                          <textarea id ="short_description" class="form-control mt-3 mb-3" style="height: 100px" placeholder="Mô tả chung về dịch vụ của bạn" name="short_description">{{!empty($business_service->short_description) ? $business_service->short_description : '' }}</textarea>    
                          <span class="error-message" id="short_description-error"></span>
                        
                        </div>    

                        <h6 class="card-title text-primary">Tính năng của dịch vụ</h6> 
                        <div id="input-container">
                        <!-- Input ban đầu -->
                        @if (!empty($business_service->service) )
                            @foreach ($business_service->service as $index => $value)
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
                        <div class="btn btn-success mt-4 mb-4" onclick="addInput()">Thêm tính năng</div>

                        <h6 class="card-title text-primary">Mô tả chi tiết dịch vụ</h6> 
                        @include('ckeditor.ckeditor')
                        
                        <!-- <div class="text-right">
                          <button style="submit" class="btn btn-primary mt-3">Lưu</button>
                        </div> -->
                      
        </div>
    </div>

