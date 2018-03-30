/* global document */
/* global jQuery */
/* global g1_mailchimp_config */

(function ($) {
    "use strict";

    var config = $.parseJSON(g1_mailchimp_config);

    $(document).ready(function() {
        $('.g1-mailchimp').each(function () {
            var $this = $(this);
            var debug_mode_enabled = $this.find('input[name=g1_debug_mode]').length > 0;

            $this.find('form').submit(function () {
                var mailing_list = $this.find('input[name=g1_mailing_list]').val();
                var mailing_list_not_set = (mailing_list.length === 0 || mailing_list === '0');

                if (mailing_list_not_set) {
                    if (debug_mode_enabled) {
                        log(config.i18n.error_missing_mailing_list, 'error', $this);
                    } else {
                        log(config.i18n.subscription_error, 'error', $this);
                    }
                } else {
                    var email = $this.find('input[name=g1_subscriber_email]').val();

                    if (email.length > 0) {
                        subscribe(mailing_list, email, $this);
                    } else {
                        log(config.i18n.error_missing_email, 'error', $this);
                    }
                }

                return false;
            });
        });

        function log (message, type, $context) {
            var $status = $context.find('.g1-subscription-status');

            $status.addClass('g1-' + type);
            $status.text(message);
        }

        function clearLog ($context) {
            var $status = $context.find('.g1-subscription-status');

            $status.removeClass('g1-success');
            $status.removeClass('g1-error');
            $status.text('');
        }

        function subscribe (mailing_list, email, $context) {
            var data = {
                'mailing_list': mailing_list,
                'subscriber_email': email
            };

            $context.addClass('g1-loading');
            clearLog($context);

            var xhr = $.post(
                config.ajax_url,
                {
                    action: 'g1_mailchimp_add_to_mailing_list',
                    ajax_data: data
                },
                function (response) {
                    if (response !== 'success') {
                        log(response, 'error', $context);
                    } else {
                        $context.find('input[name=g1_subscriber_email]').val('');
                        log(config.i18n.subscription_success, 'success', $context);
                    }
                }
            );

            xhr.always(function () {
                $context.removeClass('g1-loading');
            });
        }
    });
})(jQuery);