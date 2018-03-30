/*
 * @package Gather - Event Landing Page Wordpress Theme
 * @author Cththemes - http://themeforest.net/user/cththemes
 * @date: 10-8-2015
 *
 * @copyright  Copyright ( C ) 2014 - 2015 cththemes.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
*/

jQuery(function() {

    "use strict";

    /* 
    VALIDATE
    -------- */

    jQuery("#subscribeform").submit(function(e) {
        e.preventDefault();
    }).validate({
        rules: {
            /* uncomment if Name is needed */
            /* 
            first_name: "required",
            last_name: "required", 
            */
            email: {
                required: true,
                email: true
            }
        },
        messages: {
            /*
            first_name: "Your first name please",
            last_name: "Your last name please", 
            */
            email: subscribe_ajax.email_validate, // Please enter your email address
        },
        submitHandler: function(form) {

            jQuery("#js-subscribe-btn").attr("disabled", true);

            /* 
             CHECK PAGE FOR REDIRECT (Thank you page)
             ---------------------------------------- */

            var redirect = jQuery('#subscribeform').data('redirect');
            var noredirect = false;
            if (redirect == 'none' || redirect == "" || redirect == null) {
                noredirect = true;
            }

            jQuery("#js-subscribe-result").fadeIn("slow").html('<p class="help-block">'+subscribe_ajax.pl_w+'</p>');

            /* 
             FETCH SUCCESS / ERROR MSG FROM HTML DATA-ATTR
             --------------------------------------------- */

            var success_msg = jQuery('#js-subscribe-result').data('success-msg');
            var error_msg = jQuery('#js-subscribe-result').data('error-msg');

            var dataString = jQuery(form).serialize();
            dataString += '&action=cth_mailchimp_subscribe';
            //console.log(dataString);

            /* 
             AJAX POST
             --------- */

            jQuery.ajax({
                type: "POST",
                data: dataString,
                url: subscribe_ajax.url,
                cache: false,
                success: function(d) {
                    console.log(d);
                    jQuery(".form-group").removeClass("has-success");
                    if (d == 'success') {
                        if (noredirect) {
                            jQuery('#js-subscribe-result').fadeIn('slow').html('<p class="help-block text-success">' + success_msg + '</p>').delay(3000).fadeOut('slow');
                        } else {
                            window.location.href = redirect;
                        }
                    } else {
                        jQuery('#js-subscribe-result').fadeIn('slow').html('<p class="help-block text-danger">' + error_msg + '</p>').delay(3000).fadeOut('slow');
                    }
                    jQuery("#js-subscribe-btn").attr("disabled", false);
                }
            });
            return false;

        }
    });

});
