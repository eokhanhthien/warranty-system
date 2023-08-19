@extends('layouts.superadmin')
@section('content')
<style>
    body,html {
        overflow: hidden !important;
    }
</style>

<div class="content-wrapper" >
    <div class="container-xxl flex-grow-1 container-p-y">
        <iframe frameborder="0" width="100%" height="800px" src="https://webtygia.com/api/json/laisuatchovay?hienthi=&amp;fontsize=13&amp;padding=5&amp;bgheader=FFC107&amp;colorheader=fffff"></iframe>
    </div>
</div>

@endsection