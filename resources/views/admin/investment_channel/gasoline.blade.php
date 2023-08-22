@extends('layouts.superadmin')
@section('content')
<style>
    body,html {
        overflow: hidden !important;
    }
</style>
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">

        <iframe id="externalFrame" frameborder="0" width="100%" height="500px" src="https://webtygia.com/api/xang-dau?fonttitle=13&amp;fontsize=13&amp;hienthi=thegioi%2Ctrongnuoc&amp;border=1&amp;padding=5&amp;bgheader=9C27B0&amp;colorheader=fff"></iframe>

    </div>
</div>
<script>
        // Check if the page was reloaded
        if (sessionStorage.getItem('reloaded_gold')=='false') {
            sessionStorage.setItem('reloaded_gold', 'true');
            setTimeout(function() {
                location.reload();
            }, 0); // Reload once immediately
        }
        // Clear sessionStorage after 10 minutes (600000 milliseconds)
        setTimeout(function() {
            sessionStorage.setItem('reloaded_gold', 'false');

        }, 2000);
</script>
@endsection