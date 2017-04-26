$(function () {


    $('.delete-alert-box').on('click', function () {
        if (!confirm('¿Confirma que desea eliminar el registro?')) {
            return false;
        }
    });


    $('#add_element_package').on('click', function (e) {
        e.preventDefault();

        var id = Math.random().toString(36).substring(7);
        var template = $('#x_tpl_package_element').html();
        Mustache.parse(template);
        var rendered = Mustache.render(template, {id:id});
        $('#tbl_elements_package tbody').append(rendered);
    });


    $('#tbl_elements_package').on('click', '.btn-remove-package-element', function (e) {
        e.preventDefault();
        if (confirm('¿Confirma que desea quitar el elemento?')) {
            $(this).parents('tr').remove();
        }
    });


    $("#form_package").validate({
        submitHandler: function(form) {
            form.submit();
        }
    });

});
