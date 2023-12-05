@extends('view-seller.repair-system.repair-system.layout.layout')
@section('content')

<div class="container-xxl py-5">
        <div class="container">     
           
                    <div class="row">
                    @if(!empty($service_business) && count($service_business)>0)
                        @foreach($service_business as $service)
                                <div class="col-6 ">
                                  <div class="p-3 mb-3 card" style="border-radius: 14px;">
                                    <h4 class="mb-3">{{$service->name}}</h4>
                                    <p>{{$service->short_description}}</p>

                                    @if(!empty($service->service))
                                        @php
                                            $services = json_decode($service->service);
                                            $counter = 0;
                                        @endphp
                                        @foreach($services as $service)
                                            @if($counter < 4)
                                                <p class="text-primary fw-medium"><i class="fa fa-check text-success me-2"></i>{{$service}}</p>
                                                @php $counter++; @endphp
                                            @endif
                                        @endforeach
                                    @endif
                                    <a href="tel:{{$business->phone_number}}" class="btn bg-white text-primary w-100 mt-2">Liên hệ ngay<i class="fa fa-arrow-right text-secondary ms-2"></i></a>
                                </div>
                                </div>
                        @endforeach
                    
                    @endif
                    </div>
                </div>
           
</div>

@endsection