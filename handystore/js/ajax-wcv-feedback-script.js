
jQuery(document).ready(function ($) {
	// Perform AJAX send mail on form submit
	$('form#vendor-feedback').on('submit', function (e) {
        $('form#vendor-feedback p.status').show().text(ajax_wcv_form_object.loadingmessage);
				$.ajax({
		            type: 'POST',
		            url: ajax_wcv_form_object.ajaxurl,
		            dataType: 'json',
		            data: {
		                'action': 'pt_ajax_send_mail_to_vendor',
		                'sender': $('form#vendor-feedback #sender-name').val(),
										'sender-email': $('form#vendor-feedback #sender-email').val(),
		                'security': $('form#vendor-feedback #security').val(),
		                'subject': $('form#vendor-feedback #subject').val(),
		                'text': $('form#vendor-feedback #text-message').val(),
		                'to-email': $('form#vendor-feedback #vendor-mail').val(),
										'sender-first-name': $('form#vendor-feedback #sender-firstname').val(),
										'sender-last-name': $('form#vendor-feedback #sender-lastname').val(),
										'captcha': $('form#vendor-feedback #captcha').val(),
		            },
		            success: function (data) {
									$('form#vendor-feedback p.status').text(data.message);
		            }
		  });
		  e.preventDefault();
		});
});
