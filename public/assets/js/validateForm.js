function setupFormValidation(formId, validateUrl) {
    var form = $(formId);

    form.change(function(event) {
        event.preventDefault();

        var formData = form.serialize();

        $.ajax({
            type: 'POST',
            url: validateUrl,
            data: formData,
            success: function(response) {
                if (response.success) {
                    displayErrors({}, form); // Xóa các thông báo lỗi
                } else {
                    displayErrors(response.errors, form);
                }
            },
            error: function(xhr, textStatus, errorThrown) {
                console.log(xhr.responseText);
            }
        });
    });

    // form.change(function(event) {
    //     event.preventDefault();
    
    //     var formData = new FormData(form[0]); // Tạo đối tượng FormData
    
    //     $.ajax({
    //         type: 'POST',
    //         url: validateUrl,
    //         data: formData,
    //         processData: false, // Tắt xử lý dữ liệu
    //         contentType: false, // Tắt thiết lập kiểu dữ liệu
    //         success: function(response) {
    //             if (response.success) {
    //                 displayErrors({}, form); // Xóa các thông báo lỗi
    //             } else {
    //                 displayErrors(response.errors, form);
    //             }
    //         },
    //         error: function(xhr, textStatus, errorThrown) {
    //             console.log(xhr.responseText);
    //         }
    //     });
    // });

    form.submit(function(event) {
        event.preventDefault();

        // Kiểm tra lỗi trước khi submit
        var hasError = checkErrors(form);

        if (!hasError) {
            var formData = form.serialize();

            $.ajax({
                type: 'POST',
                url: validateUrl,
                data: formData,
                success: function(response) {
                    if (response.success) {
                        form.unbind('submit').submit();
                    } else {
                        displayErrors(response.errors, form);
                    }
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.log(xhr.responseText);
                }
            });
        }
    });

    function displayErrors(errors, form) {
        form.find('.error-message').empty(); // Xóa các thông báo lỗi cũ

        $.each(errors, function(field, messages) {
            var errorElement = form.find('#' + field + '-error');
            errorElement.text(messages[0]);
        });
    }

    function checkErrors(form) {
        var hasError = false;

        form.find('.error-message').each(function() {
            if ($(this).text() !== '') {
                hasError = true;
                return false; // Dừng vòng lặp nếu có lỗi
            }
        });

        return hasError;
    }
}