@extends('layouts.superadmin')
@section('content')
<style>
    body,html {
        overflow: hidden !important;
    }
</style>

<div class="content-wrapper" >
    <div class="container-xxl flex-grow-1 container-p-y">
        <iframe id="externalFrame" frameborder="0" width="100%" height="800px" src="https://webtygia.com/api/json/laisuatchovay?hienthi=&amp;fontsize=13&amp;padding=5&amp;bgheader=FFC107&amp;colorheader=fffff"></iframe>
    </div>
</div>
<script>
        // Check if the page was reloaded
        if (sessionStorage.getItem('reloaded_gold')=='false' || !sessionStorage.getItem('reloaded_gold')) {
            sessionStorage.setItem('reloaded_gold', 'true');
            setTimeout(function() {
                location.reload();
            }, 500); // Reload once immediately
        }
        // Clear sessionStorage after 10 minutes (600000 milliseconds)
        setTimeout(function() {
            sessionStorage.setItem('reloaded_gold', 'false');

        }, 1000);
</script>
@endsection