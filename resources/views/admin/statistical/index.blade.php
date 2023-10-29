@extends('layouts.superadmin')
@section('content') 
@section('title', 'Gói')
@if(session('success'))
    <script>
        toastr.success('{!! html_entity_decode(session('success')) !!}');
    </script>
@endif

@if(session('error'))
    <script>
        toastr.error('{!! html_entity_decode(session('error')) !!}');
    </script>
@endif

    <div class="tab-filter">
            <button id="filterButton">Lọc theo &#9658;</button>      
            <input type="text" id="datePicker" name="selected_dates" class="form-control" placeholder="Thời gian"/>
            <button id="bnt-datePicker" class="btn btn-primary mt-2">Lọc</button>
            <button id="bnt-date-default" class="btn btn-danger mt-2">Xóa lọc</button>
    </div>
    <div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y"> 
        <div class="" id="chart">
            @include('admin.statistical.chart')
        </div>
        </div>
    </div>
<style>
        /* CSS để tạo giao diện tab */
        .tab-filter {
            position: fixed;
            top: 50%;
            /* right: -19%; */
            left: 100%;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            width: 360px;
            transition: 0.3s;
        }
        .active{
            /* right: 0% !important; */
            left: 81% !important;

        }
        .tab-filter .filter-options {
            display: none;
            list-style: none;
            padding: 0;
        }
        .tab-filter .filter-options li {
            margin-bottom: 5px;
        }
        .tab-filter .filter-options li a {
            text-decoration: none;
            color: #333;
        }
        button#filterButton {
            position: relative;
            left: -31%;
            border: none;
            border-radius: 5px;
        }
    </style>


<script>
    $(document).ready(function () {
        $('#bnt-datePicker').on('click', function () {
        // Lấy giá trị của trường nhập ngày
        const selectedDates = document.querySelector('input[name="selected_dates"]').value;

        const dateParts = selectedDates.split(' to ');

        let start_date, end_date;

        if (dateParts.length === 2) {
            start_date = dateParts[0];
            end_date = dateParts[1];
        } else if (dateParts.length === 1) {
            start_date = end_date = dateParts[0];
        }

        const newURL = "{{ route('statistical')}}?start_date=" + start_date + "&end_date=" + end_date;

         window.location.href = newURL;
        });

        $('#bnt-date-default').on('click', function () {
        const newURL = "{{ route('statistical')}}";
         window.location.href = newURL;
        });

    });

</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/6.0.6/highcharts.js" charset="utf-8"></script>
<script src="https://cdn.jsdelivr.net/npm/fusioncharts@3.12.2/fusioncharts.js" charset="utf-8"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/4.0.2/echarts-en.min.js" charset="utf-8"></script>
<script src="https://cdn.jsdelivr.net/npm/frappe-charts@1.1.0/dist/frappe-charts.min.iife.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/d3/5.7.0/d3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/c3/0.6.7/c3.min.js"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
flatpickr('#datePicker', {
    mode: "range", // Cho phép chọn nhiều ngày
    dateFormat: "Y-m-d", // Định dạng ngày
});
</script>

<script>
    const filterButton = document.getElementById('filterButton');
    const tabFilter = document.querySelector('.tab-filter');

    filterButton.addEventListener('click', function() {
        tabFilter.classList.toggle('active'); // Toggle class "active" for tab-filter
    });
</script>

@endsection