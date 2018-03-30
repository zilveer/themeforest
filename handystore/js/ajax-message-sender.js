
jQuery(document).ready(function ($) {
		"use strict";

		// Close popup
    $(document).on('click', '.messenger_overlay, .close', function (e) {
				$('form#vendor-message-seller').fadeOut(300);
        $('.messenger_overlay').css('opacity', '0');
        $('.messenger_overlay').remove();
        e.preventDefault();
    });

    // Show the login/signup popup on click
    $('#pt-message-seller').on('click', function (e) {
        var overlay = '<div class="messenger_overlay"></div>';
        $('body').prepend($(overlay).css('opacity', '0.5'));
				$('form#vendor-message-seller').fadeIn(300);
        e.preventDefault();
    });

		// Perform AJAX login/register on form submit
		$('form#vendor-message-seller').on('submit', function (e) {
			console.log('form submit');
        $(this).find('.status').show().text(ajax_message_sender_var.loadingmessage);

				$.ajax({
		            type: 'POST',
		            url: ajax_message_sender_var.url,
		            dataType: 'json',
		            data: {
		                'action': 'pt-message-sender',
		                'sender': $('form#vendor-message-seller #sender-name').val(),
										'sender-email': $('form#vendor-message-seller #sender-email').val(),
		                'subject': $('form#vendor-message-seller #subject').val(),
		                'text': $('form#vendor-message-seller #text-message').val(),
		                'to-email': $('form#vendor-message-seller #vendor-mail').val(),
										'sender-first-name': $('form#vendor-message-seller #sender-firstname').val(),
										'sender-last-name': $('form#vendor-message-seller #sender-lastname').val(),
										'captcha': $('form#vendor-message-seller #captcha').val(),
										'security': $('form#vendor-message-seller #seller-security').val()
		            },
		            success: function (data) {
									$('form#vendor-message-seller p.status').text(data.message);
		            }
		  });
			e.preventDefault();
	});
});
