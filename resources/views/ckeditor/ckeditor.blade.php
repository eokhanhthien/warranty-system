<textarea name="content" id="content">{{!empty($content) ? $content : ''}}</textarea>
<script src="https://cdn.ckeditor.com/4.16.1/full/ckeditor.js"></script>
<script>
    CKEDITOR.replace('content', {
        extraPlugins: 'colorbutton,colordialog,font,justify,colorbutton',
        toolbar: [
            { name: 'document', items: ['Source'] },
            { name: 'clipboard', items: ['Undo', 'Redo'] },
            { name: 'editing', items: ['Find', 'Replace', '-', 'SelectAll'] },
            { name: 'links', items: ['Link', 'Unlink'] },
            { name: 'insert', items: ['Image', 'Table', 'HorizontalRule'] },
            { name: 'tools', items: ['Maximize'] },
            '/',
            { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript'] },
            { name: 'styles', items: ['Styles', 'Format', 'Font', 'FontSize', 'TextColor', 'BGColor'] },
            { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote'] },
            { name: 'justify', items: ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'] }
        ],
        colorButton_colors: '0088CC,00CC99,FF0000',
        colorButton_enableMore: true,
        colorButton_foreStyle: {
            element: 'span',
            styles: { 'color': '#(color)' }
        }
    });
</script>
