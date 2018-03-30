/* global document */
/* global jQuery */

(function ($) {
    "use strict";

    var config = $.parseJSON(g1_contact_form_config);
    var submitHandler;

    $(document).ready(function() {
        submitHandler = function ($selector) {
            $selector = $selector || $('.contact-form.g1-ajax-submit');

            $selector.each(function () {
                var $this = $(this);

                (function ($form) {
                    $form.submit(function (e) {
                        e.stopImmediatePropagation();

                        var data = {};

                        $form.find('input,textarea').each(function () {
                            var key = $(this).attr('name');
                            var value = $(this).val();

                            data[key] = value;
                        });

                        send(data, $form);

                        return false;
                    });
                })($(this));
            });
        };

        submitHandler();

        function send (data, $context) {
            $context.addClass('g1-form--sending');

            data['action'] = 'g1_contact_form_send';

            var xhr = $.post(
                config.ajax_url,
                data,
                function (response) {
                    if (response.length > 0) {
                        var $response = $(response);

                        $context.replaceWith($response);
                        submitHandler($response);

                        G1.theme.replaceButtonsToLinks($response);
                    } else {
                        var errorMessage = '<div class="g1-message g1-message--warning g1-message-ajax"><div class="g1-inner">'+ config.i18n.error_message +'</div></div>';

                        if ($context.find('.g1-message-ajax').length === 0) {
                            $context.prepend(errorMessage);
                        }
                    }
                }
            );

            xhr.always(function () {
                $context.removeClass('g1-form--sending');
            });
        }
    });
})(jQuery);