jQuery(document).ready(function($){

    $.fn.yit_contact_form = function() {// contact
        var error = true;

        function addLoading(e) {
            $(e).val('{wait}'.replace('{wait}', contact_localization.wait)).attr('disabled', true);
        }

        function removeLoading(e, value_submit) {
            $(e).val(value_submit).attr('disabled', false);
        }

        function addError(msg, e) {
            $(e).addClass("error");
            $(e).parents('li').find('.msg-error').text(msg);
            $(e).parents('form').find('.yit_sendemail').attr('disabled', true);
        }

        function removeError(e) {
            $(e).removeClass("error");
            $(e).parents('li').find('.msg-error').text('');
            $(e).parents('form').find('.yit_sendemail').attr('disabled', false);
        }

        $('.contact-form .required').on('blur', function () {

            var name = $(this).attr('name').match(/(.*)\[(.*)\]/);
            var msg = $('.contact-form-error-' + name[2]).html();

            if ($(this).val() == '')
                addError(msg, this);
            else
                removeError(this);
        });


        $('.contact-form .email-validate').on('blur', function () {
            var expr = /^[_a-z0-9+-]+(\.[_a-z0-9+-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)+$/;
            var name = $(this).attr('name').match(/(.*)\[(.*)\]/);
            var id_form = $(this).parents('.contact-form').find('input[name="id_form"]').val();

            var msg = $('.contact-form-error-' + name[2]).html();

            if (( $(this).val() != '' && !expr.test($(this).val().toLowerCase()) ) || ( $(this).is('.required') && $(this).val() == '' ))
                addError(msg, this);
            else
                removeError(this);
        });


        $('.yit_sendemail').on('click', function (e) {
            e.preventDefault();
            var $t = $(this),
                $form = $t.parents('form'),
                value_submit = $('.yit_sendemail').val(),
                $do_ajax = $form.find('.yit_ajax');

            $success_message = $form.find('.user-message');
            if ($success_message.length > 0) {
                $success_message.remove();
            }

            if ($do_ajax.length > 0) {

                $.ajax({
                    cache: false,
                    beforeSend: function (jqXHR, settings) {
                        addLoading($t);
                    },
                    complete: function (jqXHR, status) {
                        removeLoading($t, value_submit);
                    },
                    dataType: 'json',
                    method: 'POST',
                    data: $form.serialize(),
                    success: function (data, status, jqXHR) {
                        var message_div;
                        if ($form.find('.user-message').length == 0) {
                            message_div = $('<div />', {
                                'class': 'user-message'
                            }).prependTo($form);
                        } else {
                            message_div = $form.find('.user-message');
                        }


                        if (data.type == 'success') {
                            message_div.addClass('success');
                        } else {
                            message_div.addClass('error');
                        }

                        message_div.html(data.msg);
                    },
                    url: contact_localization.url + '?action=' + $do_ajax.data('action')
                });
            } else {
                addLoading($t);
                document.forms[$form.attr('id')].submit();
            }
        });
    };

    $.fn.yit_contact_form();


});