jQuery(document).ready(function($) {
	$.validator.addMethod("notEqual", function(value, element, param) {
		return value !== param;
	}, cfdata.empty_input_msg);

	/* Validation for contact form */
	$('#mpcth_contact_form').validate({
		rules: {
			author_cf: {
				required: true,
				minlength: 2,
				notEqual: cfdata.author_label + '*'
			},
			
			email_cf: {
				required: cfdata.email_required == 1 ? true : false,
				email: true, 
				notEqual: cfdata.email_label + (cfdata.email_required == 1 ? '*' : '')
			},
			
			message_cf: {
				required: true,
				minlength: 5,
				notEqual: cfdata.message_label + '*'
			}			
		},
				
		messages: {
			author_cf	: cfdata.email_error_msg,
			email_cf	: cfdata.message_error_msg,
			message_cf	: cfdata.author_error_msg
		}
	});
	
	$('form#mpcth_contact_form').off('submit');
	$('form#mpcth_contact_form').submit(function() {
		var $this = $(this),
			$requiredFields = $this.find('.requiredField'),
			requireEmail = cfdata.email_required;

		$requiredFields.removeClass('mpcth-cf-error');
		var hasError = false;

		$requiredFields.each(function() {
			var $this = $(this);
			if(jQuery.trim($this.val()) == '') {
				var labelText = $this.prev('label').text();
				$this.addClass('mpcth-cf-error');
				hasError = true;
			} else if($this.hasClass('email_cf') && requireEmail == '1') {
				var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
				if(!emailReg.test(jQuery.trim($this.val()))) {
					var labelText = $this.prev('label').text();
					$this.addClass('mpcth-cf-error');
					hasError = true;
				}
			} else if($this.hasClass('author_cf')) {
				if($this.val().length < 1 || $this.val() == cfdata.author_label + '*' ) {
					var labelText = $this.prev('label').text();
					$this.addClass('mpcth-cf-error');
					hasError = true;
				}
			} else if($this.hasClass('message_cf')) {
				if($this.val().length < 5 || $this.val() == cfdata.message_label + '*' ) {
					$this.addClass('mpcth-cf-error');
					hasError = true;
				}
			}
		});
					
		if(!hasError) {
			var formInput = $this.serialize();
			formInput += '&target_email=' + encodeURIComponent(cfdata.target_email);
			formInput += '&from_text=' + encodeURIComponent(cfdata.from_text);
			formInput += '&subject_text=' + encodeURIComponent(cfdata.subject_text);
			formInput += '&header_text=' + encodeURIComponent(cfdata.header_text);
			formInput += '&body_name_text=' + encodeURIComponent(cfdata.body_name_text);
			formInput += '&body_email_text=' + encodeURIComponent(cfdata.body_email_text);
			formInput += '&body_msg_text=' + encodeURIComponent(cfdata.body_msg_text);
			
			$.post($this.attr('action'), formInput, function(data) {
				if(data == 'success') {
					$this.find('#message_cf').after('<p class="mpcth-cf-response success">' + cfdata.success_msg + '</p>');

					$requiredFields.each(function() {
						var $input = $(this);
						if($input.hasClass('email_cf')) {
							$input.val(cfdata.email_label);
						} else if($input.hasClass('author_cf')) {
							$input.val(cfdata.author_label + '*');
						} else if($input.hasClass('message_cf')) {
							$input.val(cfdata.message_label + '*');
						}
					})
				} else {
					$this.find('#message_cf').after('<p class="mpcth-cf-response error">' + cfdata.error_msg + '</p>');
				}
			});
		} else {
			$this.valid();
		}
		
		return false;
	});
});