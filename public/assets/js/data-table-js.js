function searchDataTable (id , searching = true , paging = null , pageLength = null  ) {

    $(id).DataTable({
        searching: searching, // Hiển thị ô tìm kiếm
        paging: paging, // Hiển thị phân trang
        pageLength: pageLength, // Số lượng mục trên mỗi trang

        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, 100, "All"]],
        "pageLength": 10,

        dom: 'Blfrtip',
        // buttons: [
        //   {
        //     extend: 'pdfHtml5',
        //     text: 'Export PDF',
        //     customize: function(doc) {
        //       // Loại bỏ cột cuối cùng
        //       doc.content[1].table.widths.splice(-1, 1);
        //       doc.content[1].table.body.forEach(function(row) {
        //         row.splice(-1, 1);
        //       });
        //     }
        //   },
        //   {
        //     extend: 'excel',
        //     text: 'Export Excel',
        //     exportOptions: {
        //       columns: ':not(:last-child)' // Loại bỏ cột cuối cùng
        //     }
        //   }
        // ],
        
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