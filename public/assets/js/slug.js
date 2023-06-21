

    // Thêm hàm oninput="generateSlug()" và 
    
//     <div class="form-group col-lg-6">
//          <label for="slug">Domain</label>
//          <input type="text" class="form-control" id="slug" placeholder="Slug" name="domain" readonly>
//       </div>
    function slug(title) {
        // Đổi chữ hoa thành chữ thường
        let slugResult = title.toLowerCase();
    
        // Đổi ký tự có dấu thành không dấu
        slugResult = slugResult.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
        slugResult = slugResult.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
        slugResult = slugResult.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
        slugResult = slugResult.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
        slugResult = slugResult.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
        slugResult = slugResult.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
        slugResult = slugResult.replace(/đ/gi, 'd');
        // Xóa các ký tự đặt biệt
        slugResult = slugResult.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
        // Đổi khoảng trắng thành ký tự gạch ngang
        slugResult = slugResult.replace(/ /gi, "-");
        // Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
        // Phòng trường hợp người nhập vào quá nhiều ký tự trắng
        slugResult = slugResult.replace(/\-\-\-\-\-/gi, '-');
        slugResult = slugResult.replace(/\-\-\-\-/gi, '-');
        slugResult = slugResult.replace(/\-\-\-/gi, '-');
        slugResult = slugResult.replace(/\-\-/gi, '-');
        // Xóa các ký tự gạch ngang ở đầu và cuối
        slugResult = '@' + slugResult + '@';
        slugResult = slugResult.replace(/\@\-|\-\@|\@/gi, '');
        return slugResult;
    }
    
    function generateSlug(isRadom) {
        const nameInput = document.getElementById('projectName');
        const slugInput = document.getElementById('slug');
    
        const name = nameInput.value;
        const generatedSlug = slug(name);
    
        const randomString = generateRandomString(4);
        
        if(isRadom == 1 ){
            let finalSlug = generatedSlug + '-' + randomString;
            slugInput.value = finalSlug;
        }else if(isRadom == 0){
            let finalSlug = generatedSlug;
            slugInput.value = finalSlug;
        }

    }
    
    function generateRandomString(length) {
        let result = '';
        const characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
    
        for (let i = 0; i < length; i++) {
            const randomIndex = Math.floor(Math.random() * characters.length);
            result += characters.charAt(randomIndex);
        }
    
        return result;
    }
    
    const nameInput = document.getElementById('projectName');
    nameInput.addEventListener('input', generateSlug);

