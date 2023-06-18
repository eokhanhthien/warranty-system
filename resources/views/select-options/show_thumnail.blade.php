<div class="form-group col-lg-2" id="thumbnail-container" style="width: 70%;">
    <label>Ảnh nhỏ:</label>
    <div id="thumbnail" style="border: 1px solid #ddd; padding: 5px; height: 100px; overflow: hidden;width: 100px">
    @if (!empty($image))
            <iframe src="https://drive.google.com/file/d/{{ $image }}/preview" alt="" style="width: 100%; height: 100%; object-fit: cover;"></iframe>
        @else
            <img id="thumbnail-img" style="width: 100%; object-fit: cover;" src="https://static.vecteezy.com/system/resources/thumbnails/008/442/086/small/illustration-of-human-icon-user-symbol-icon-modern-design-on-blank-background-free-vector.jpg" style="max-width: 100%; max-height: 100%; object-fit: cover;" loading="lazy">
        @endif
    </div>
</div>

<script>
function displayThumbnail(event) {
    var input = event.target;
    var thumbnailContainer = document.getElementById("thumbnail-container");
    var thumbnailImg = document.getElementById("thumbnail-img");

    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            thumbnailImg.src = e.target.result;
            thumbnailImg.style.maxHeight = "100%";
            thumbnailImg.style.display = "block";
            centerThumbnail();
        };
        reader.readAsDataURL(input.files[0]);
    } else {
        thumbnailImg.src = ""; // Xóa ảnh nếu không có ảnh được chọn
        thumbnailImg.style.display = "none";
        thumbnailContainer.style.display = "none"; // Ẩn khung chứa thumbnail khi không có ảnh
    }
}


</script>