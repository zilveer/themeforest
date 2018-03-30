/*

Script  : Contact Form
Version : 1.0
Author  : Surjith S M
URI     : http://themeforest.net/user/surjithctly

Copyright © All rights Reserved
Surjith S M / @surjithctly

*/

jQuery(function() {

    "use strict";

    /* 
    VALIDATE
    -------- */

    jQuery("#phpcontactform").submit(function(e) {
        e.preventDefault();
    }).validate({
        rules: {
            first_name: "required",
            last_name: "required",
            email: {
                required: true,
                email: true
            },
            phone: {
                required: true,
                number: true
            },
            message: "required",
        },
        messages: {
            first_name: "Your first name please",
            last_name: "Your last name please",
            email: "We need your email address",
            phone: "Please enter your phone number",
            message: "Please enter your message",
        },
        submitHandler: function(form) {

            jQuery("#js-contact-btn").attr("disabled", true);

            /* 
            CHECK PAGE FOR REDIRECT (Thank you page)
            ---------------------------------------- */

            var redirect = jQuery('#phpcontactform').data('redirect');
            var noredirect = false;
            if (redirect == 'none' || redirect == "" || redirect == null) {
                noredirect = true;
            }

            jQuery("#js-contact-result").html('<p class="help-block">Please wait...</p>');

            /* 
            FETCH SUCCESS / ERROR MSG FROM HTML DATA-ATTR
            --------------------------------------------- */

            var success_msg = jQuery('#js-contact-result').data('success-msg');
            var error_msg = jQuery('#js-contact-result').data('error-msg');

            var dataString = jQuery(form).serialize();

            /* 
             AJAX POST
             --------- */

            jQuery.ajax({
                type: "POST",
                data: dataString,
                url: "php/contact.php",
                cache: false,
                success: function(d) {
                    jQuery(".form-group").removeClass("has-success");
                    if (d == 'success') {
                        if (noredirect) {
                            jQuery('#js-contact-result').fadeIn('slow').html('<div class="alert alert-success top-space">' + success_msg + '</div>').delay(3000).fadeOut('slow');
                        } else {
                            window.location.href = redirect;
                        }
                    } else {
                        jQuery('#js-contact-result').fadeIn('slow').html('<div class="alert alert-danger top-space">' + error_msg + '</div>').delay(3000).fadeOut('slow');
                    }
                    jQuery("#js-contact-btn").attr("disabled", false);
                }
            });
            return false;

        }
    });

})
