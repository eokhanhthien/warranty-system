
<div class="row ">
<div class="form-group" style="">
<label for="address">Địa chỉ</label>
<select name="province" id="province" class="form-control mt-2">
    <option value="">Chọn Tỉnh/Thành phố</option>
    @foreach ($provinces as $province)
        <option value="{{ $province->id }}">{{ $province->city_name }}</option>
    @endforeach
</select>
<span class="error-message" id="province-error"></span>

<select name="district" id="district" class="form-control mt-2">
    <option value="">Chọn Quận/Huyện</option>
</select>
<span class="error-message" id="district-error"></span>

<select name="ward" id="ward" class="form-control mt-2">
    <option value="">Chọn Phường/Xã</option>
</select>
<span class="error-message" id="ward-error"></span>

</div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Sự kiện chọn tỉnh/thành phố
    $('#province').change(function() {
        var provinceId = $(this).val();
        
        // Gửi yêu cầu AJAX để lấy danh sách quận/huyện
        $.ajax({
            url: '/get-districts/' + provinceId,
            type: 'GET',
            success: function(response) {
                var districts = response;
                var districtSelect = $('#district');
                districtSelect.empty();
                districtSelect.append('<option value="">Chọn Quận/Huyện</option>');
                
                // Thêm các option cho danh sách quận/huyện
                $.each(districts, function(key, district) {
                    districtSelect.append('<option value="' + district.id + '">' + district.districts_name + '</option>');
                });
                
                // Xóa các option trong danh sách phường/xã
                $('#ward').empty();
            }
        });
    });
    
    // Sự kiện chọn quận/huyện
    $('#district').change(function() {
        var districtId = $(this).val();
        
        // Gửi yêu cầu AJAX để lấy danh sách phường/xã
        $.ajax({
            url: '/get-wards/' + districtId,
            type: 'GET',
            success: function(response) {
                var wards = response;
                var wardSelect = $('#ward');
                wardSelect.empty();
                wardSelect.append('<option value="">Chọn Phường/Xã</option>');
                
                // Thêm các option cho danh sách phường/xã
                $.each(wards, function(key, ward) {
                    wardSelect.append('<option value="' + ward.id + '">' + ward.wards_name + '</option>');
                });
            }
        });
    });
});
</script>
