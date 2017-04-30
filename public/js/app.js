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


    $('#form_quotation_customer').validate({
        submitHandler: function(form) {
            $.post($(form).attr('action'), $(form).serialize(), function (response) {
                if(response.status === 'error') {
                    showErrorDialog(response.api_error_message);
                    $('#form_quotation input[name="customer_id"]').val('');
                    $('input[name="customer_full_name"]').val('');
                    $('input[name="customer_phone_number"]').val('');
                    $('input[name="customer_email"]').val('');
                    $('input[name="customer_contact_full_name"]').val('');
                    $('input[name="customer_contact_phone_number"]').val('');
                    $('input[name="customer_contact_email"]').val('');
                    return false;
                } else {
                    var data = response.data.data;
                    $('#form_quotation input[name="customer_id"]').val(data.id);
                    $('input[name="customer_full_name"]').val(data.name + ' ' + data.lastname);
                    $('input[name="customer_phone_number"]').val(data.phone_number);
                    $('input[name="customer_email"]').val(data.email);
                    $('input[name="customer_contact_full_name"]').val(data.name_contact);
                    $('input[name="customer_contact_phone_number"]').val(data.phone_number_contact);
                    $('input[name="customer_contact_email"]').val(data.email_contact);
                }
            });
        }
    })


    function showErrorDialog(message) {
        var $modal = $('#ajax_error_message');
        console.log($modal.length);
        $modal.html(message);
        $modal.fadeIn();

        setTimeout(function () {
            $modal.fadeOut();
        }, 4000);
    }

});
