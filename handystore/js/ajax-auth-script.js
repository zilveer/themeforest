
jQuery(document).ready(function ($) {
		"use strict";
    // Display form from link inside a popup
		$('#pop_login, #pop_signup').on('click', function (e) {
        var formToFadeOut = $('form#register');
        var formtoFadeIn = $('form#login');
        if ($(this).attr('id') == 'pop_signup') {
            formToFadeOut = $('form#login');
            formtoFadeIn = $('form#register');
        }
        formToFadeOut.fadeOut(500, function () {
            formtoFadeIn.fadeIn();
        })
        return false;
    });

		// Close popup
    $(document).on('click', '.login_overlay, .close', function () {
		$('form#login, form#register').fadeOut(300);
        $('.login_overlay').fadeOut(300, function () {
            $('.login_overlay').remove();
        });
        return false;
    });

    // Show the login/signup popup on click
    $('#show_login, #show_signup').on('click', function (e) {
        var overlay = '<div class="login_overlay"></div>';
        $('body').prepend($(overlay).hide().fadeIn(500));
        if ($(this).attr('id') == 'show_login') {
						$('form#login').fadeIn(500);
				} else {
						$('form#register').fadeIn(500);
				}
        e.preventDefault();
    });

		// Perform AJAX login/register on form submit
		$('form#login, form#register').on('submit', function (e) {
        if (!$(this).valid()) return false;
        $('p.status', this).show().text(ajax_auth_object.loadingmessage);
				var action = 'ajaxlogin';
				var username = 	$('form#login #username').val();
				var password = $('form#login #password').val();
				var email = '';
				var security = $('form#login #security').val();
        var become_vendor = null;
        var accept_terms = null;

				if ($(this).attr('id') == 'register') {
						action = 'ajaxregister';
						username = $('#signonname').val();
						password = $('#signonpassword').val();
	        	email = $('#email').val();
	        	security = $('#signonsecurity').val();
            if ( $('#apply_for_vendor_widget').is(":checked") ) {
                become_vendor = '1';
            }
            if ( $('#agree_to_terms_widget').is(":checked") ) {
                accept_terms = '1';
            }
				}
				var ctrl = $(this);

				$.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajax_auth_object.ajaxurl,
            data: {
                'action': action,
                'username': username,
                'password': password,
								'email': email,
                'security': security,
                'become_vendor': become_vendor,
                'accept_terms': accept_terms
            },
            success: function (data) {
								$('p.status', ctrl).text(data.message);
								if (data.loggedin == true) {
				            document.location.href = data.redirect_url;
				        }
				    }
        });

        e.preventDefault();
	  });

		// Client side form validation
		jQuery.validator.addMethod("lettersonly", function(value, element) {
			return this.optional(element) || /^[a-z ]+$/i.test(value);
		}, "Letters and spaces only please");

		if (jQuery("#register").length) {
	      jQuery("#register").validate({
	          rules: {
	              password2: { equalTo:'#signonpassword' },
	    					/*signonname: { lettersonly: true },*/
	          },
	      });
	  }
	  else if (jQuery("#login").length) {
	    	jQuery("#login").validate();
	  }
	  jQuery.extend(jQuery.validator.messages, {
	      required: "This field is required.",
	      email: "Please enter a valid email address.",
	      equalTo: "Your passwords not equal.",
	  });

});
