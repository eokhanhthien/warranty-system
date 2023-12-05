@extends('view-seller.repair-system.repair-system.layout.layout')
@section('content')


    
        
        
            <!-- Booking Start -->
            <div class="container-fluid px-0" style="margin: 6rem 0;">
                <div class="video wow fadeInUp" data-wow-delay="0.1s">
                    {{-- <button type="button" class="btn-play" data-bs-toggle="modal" data-src="https://www.youtube.com/embed/DWRcNpR6Kdc" data-bs-target="#videoModal">
                        <span></span>
                    </button> --}}
        
                    <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content rounded-0">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Youtube Video</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- 16:9 aspect ratio -->
                                    <div class="ratio ratio-16x9">
                                        <iframe class="embed-responsive-item" src="" id="video" allowfullscreen allowscriptaccess="always"
                                            allow="autoplay"></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        
                    <h1 class="text-white mb-4">Đặt lịch dịch vụ online</h1>
                    <h3 class="text-white mb-0">24 giờ 7 ngày trên 1 tuần</h3>
                </div>
                <div class="container position-relative wow fadeInUp" data-wow-delay="0.1s" style="margin-top: -6rem;">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="bg-light text-center p-5">
                                <h1 class="mb-4">Đặt lịch dịch vụ</h1>
                                <form>
                                    <div class="row g-3">
                                        <div class="col-12 col-sm-6">
                                            <input type="text" class="form-control border-0" placeholder="Họ và tên" style="height: 55px;">
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <input type="email" class="form-control border-0" placeholder="Email" style="height: 55px;">
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <select class="form-select border-0" style="height: 55px;">
                                                @foreach($business_service as $service)
                                                    <option value="{{$service->id}}">{{$service->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="date" id="date1" data-target-input="nearest">
                                                <input type="text"
                                                    class="form-control border-0 datetimepicker-input"
                                                    placeholder="Service Date" data-target="#date1" data-toggle="datetimepicker" style="height: 55px;">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <textarea class="form-control border-0" placeholder="Ghi chú"></textarea>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary w-100 py-3" style="{{ !empty($business->color) && $business->color != '' ? 'background-color: ' . $business->color : '' }}" type="submit">Đặt ngay</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                 
        </div>
           


@endsection