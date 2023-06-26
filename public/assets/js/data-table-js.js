function searchDataTable (id , searching = true , paging = null , pageLength = null  ) {

    $(id).DataTable({
        searching: searching, // Hiển thị ô tìm kiếm
        paging: paging, // Hiển thị phân trang
        pageLength: pageLength, // Số lượng mục trên mỗi trang
        // Các tùy chọn khác
        // language: {
        //     "lengthMenu": "Hiển thị _MENU_ bản ghi",
        //     "search": "Tìm kiếm:",
        //     "info": "Hiển thị _START_ đến _END_ của _TOTAL_ bản ghi",
        //     "paginate": {
        //         "first": "Đầu",
        //         "last": "Cuối",
        //         "next": "Tiếp",
        //         "previous": "Trước"
        //     }
        // }
      });
}