/**
 * This file contains validation and AJAX script relate to Login, Register and Forgot Password forms
 */
(function ($) {
    "use strict";

    /**
     * Modal dialog for Login and Register
     */
    $('.activate-section').click(function(e){
        e.preventDefault();
        var $this = $(this);
        var target_section = $this.data('section');
        $this.closest('.modal-section').hide();
        $this.closest('.forms-modal').find('.'+target_section).show();
    });

    if ( jQuery().validate && jQuery().ajaxSubmit ) {

        /**
         * AJAX Login Form
         */

        var loginButton = $('#login-button'),
            loginAjaxLoader = $('#login-loader'),
            loginError = $("#login-error" ),
            loginMessage = $('#login-message');

        var loginOptions = {
            beforeSubmit: function () {
                loginMessage.fadeOut( 50 );
                loginError.fadeOut( 50 );
                loginButton.attr('disabled', 'disabled');
                loginAjaxLoader.fadeIn( 200 );
            },
            success: function (ajax_response, statusText, xhr, $form) {
                var response = $.parseJSON( ajax_response );
                loginAjaxLoader.fadeOut( 100 );
                loginButton.removeAttr('disabled');
                if ( response.success ) {
                    loginMessage.html( response.message ).fadeIn( 200 );
                    document.location.href = response.redirect;
                } else {
                    loginError.html( response.message ).fadeIn( 200 );
                }
            }
        };

        $('#login-form').validate({
            submitHandler: function ( form ) {
                $(form).ajaxSubmit( loginOptions );
            }
        });


        /**
         * AJAX Register Form
         */
        var registerButton = $('#register-button'),
            registerAjaxLoader = $('#register-loader'),
            registerError = $("#register-error" ),
            registerMessage = $('#register-message');

        var registerOptions = {
            beforeSubmit: function () {
                registerButton.attr('disabled', 'disabled');
                registerAjaxLoader.fadeIn('fast');
                registerMessage.fadeOut('fast');
                registerError.fadeOut('fast');
            },
            success: function (ajax_response, statusText, xhr, $form) {
                var response = $.parseJSON( ajax_response );
                registerAjaxLoader.fadeOut('fast');
                registerButton.removeAttr('disabled');
                if ( response.success ) {
                    registerMessage.html( response.message ).fadeIn('fast');
                    document.location.href = response.redirect;
                } else {
                    registerError.html( response.message ).fadeIn('fast');
                }
            }
        };

        $('#register-form').validate({
            rules: {
                register_username: {
                    required: true
                },
                register_email: {
                    required: true,
                    email: true
                },
                register_pwd: {
                    required: true
                },
                register_pwd2: {
                    equalTo: "#register_pwd"
                }
            },
            submitHandler: function ( form ) {
                $(form).ajaxSubmit( registerOptions );
            }
        });


        /**
         * Forgot Password Form
         */
        var forgotButton = $('#forgot-button'),
            forgotAjaxLoader = $('#forgot-loader'),
            forgotError = $("#forgot-error" ),
            forgotMessage = $('#forgot-message');

        var forgotOptions = {
            beforeSubmit: function () {
                forgotButton.attr('disabled', 'disabled');
                forgotAjaxLoader.fadeIn('fast');
                forgotMessage.fadeOut('fast');
                forgotError.fadeOut('fast');
            },
            success: function (ajax_response, statusText, xhr, $form) {
                var response = $.parseJSON( ajax_response );
                forgotAjaxLoader.fadeOut('fast');
                forgotButton.removeAttr('disabled');
                if ( response.success ) {
                    forgotMessage.html( response.message ).fadeIn('fast');
                    $form.resetForm();
                } else {
                    forgotError.html( response.message ).fadeIn('fast');
                }
            }
        };

        $('#forgot-form').validate({
            submitHandler: function ( form ) {
                $(form).ajaxSubmit( forgotOptions );
            }
        });

    }


    /**
     * Forgot Form
     */
    $('.login-register #forgot-form').slideUp('fast');
    $('.login-register .toggle-forgot-form').click(function(event){
        event.preventDefault();
        $('.login-register #forgot-form').slideToggle('fast');
    });

})(jQuery);