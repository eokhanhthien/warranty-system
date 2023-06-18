<div class="row">
    <div class="form-group">
        <label for="address">Địa chỉ</label>
        <select name="province" id="province" class="form-control mt-2">
            <option value="">Chọn Tỉnh/Thành phố</option>
            @foreach ($provinces as $province)
                <option value="{{ $province->id }}" @if (isset($selectedProvince) && $province->id == $selectedProvince) selected @endif>{{ $province->city_name }}</option>
            @endforeach
        </select>
        <span class="error-message" id="province-error"></span>

        <select name="district" id="district" class="form-control mt-2">
            <option value="">Chọn Quận/Huyện</option>
            @foreach ($districts as $district)
                <option value="{{ $district->id }}" @if (isset($selectedDistrict) && $district->id == $selectedDistrict) selected @endif>{{ $district->district_name }}</option>
            @endforeach
        </select>
        <span class="error-message" id="district-error"></span>

        <select name="ward" id="ward" class="form-control mt-2">
            <option value="">Chọn Phường/Xã</option>
            @foreach ($wards as $ward)
                <option value="{{ $ward->id }}" @if (isset($selectedWard) && $ward->id == $selectedWard) selected @endif>{{ $ward->ward_name }}</option>
            @endforeach
        </select>
        <span class="error-message" id="ward-error"></span>
    </div>
</div>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Tải danh sách quận/huyện khi trang được tải
    var selectedProvince = '{{ isset($selectedProvince) ? $selectedProvince : "" }}';
    if (selectedProvince) {
        loadDistricts(selectedProvince);
    }
    
    // Tải danh sách phường/xã khi trang được tải
    var selectedDistrict = '{{ isset($selectedDistrict) ? $selectedDistrict : "" }}';
    if (selectedDistrict) {
        loadWards(selectedDistrict);
    }
    
    // Sự kiện chọn tỉnh/thành phố
    $('#province').change(function() {
        var provinceId = $(this).val();
        loadDistricts(provinceId);
    });
    
    // Sự kiện chọn quận/huyện
    $('#district').change(function() {
        var districtId = $(this).val();
        loadWards(districtId);
    });
    
    // Hàm tải danh sách quận/huyện
    function loadDistricts(provinceId) {
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
                
                // Tải danh sách phường/xã cho quận/huyện đã chọn
                var selectedDistrict = '{{ isset($selectedDistrict) ? $selectedDistrict : "" }}';
                if (selectedDistrict) {
                    districtSelect.val(selectedDistrict);
                    loadWards(selectedDistrict);
                }
            }
        });
    }
    
    // Hàm tải danh sách phường/xã
    function loadWards(districtId) {
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
                
                // Chọn phường/xã đã lưu trữ
                var selectedWard = '{{ isset($selectedWard) ? $selectedWard : "" }}';
                if (selectedWard) {
                    wardSelect.val(selectedWard);
                }
            }
        });
    }
});
</script>

