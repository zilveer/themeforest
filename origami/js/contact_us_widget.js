jQuery.noConflict();
jQuery(document).ready(function() {

	jQuery("#contactName, #email, #commentsText").defaultvalue(
        "Name",
        "Email",
        "Message"
    );


	jQuery('.widget #contactForm').submit(function() {
		jQuery('.widget #contactForm .error').remove();
		var hasError = false;
		jQuery('.widget .requiredField').each(function() {
			if(jQuery.trim(jQuery(this).val()) == '' || jQuery.trim(jQuery(this).val()) == 'Name' || jQuery.trim(jQuery(this).val()) == 'Email' || jQuery.trim(jQuery(this).val()) == 'Message' ) {
				var labelText = jQuery(this).attr('name');
				jQuery(this).parent().append('<span class="error">You forgot to enter your '+labelText+'.</span>');
				hasError = true;
			} else if(jQuery(this).hasClass('email')) {
				var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
				if(!emailReg.test(jQuery.trim(jQuery(this).val()))) {
					var labelText = jQuery(this).attr('name');
					jQuery(this).parent().append('<span class="error">You entered an invalid '+labelText+'.</span>');
					hasError = true;
				}
			}
		});
		if(!hasError) {
			var formInput2 = jQuery(this).serialize();
			jQuery.post(jQuery(this).attr('action'),formInput2, function(data){
				jQuery('.widget #contactForm').slideUp("fast", function() {				   
					jQuery(this).before('<p class="contactSuccess"><strong>Thanks!</strong> Your email was successfully sent.</p>');
				});
			});
		}
		
		return false;
		
	});
	
	
	jQuery('#footer #contactForm').submit(function() {
		jQuery('#footer #contactForm .error').remove();
		var hasError = false;
		jQuery('#footer .requiredField').each(function() {
			if(jQuery.trim(jQuery(this).val()) == '' || jQuery.trim(jQuery(this).val()) == 'Name' || jQuery.trim(jQuery(this).val()) == 'Email' || jQuery.trim(jQuery(this).val()) == 'Message' ) {
				var labelText = jQuery(this).attr('name');
				jQuery(this).parent().append('<span class="error">You forgot to enter your '+labelText+'.</span>');
				hasError = true;
			} else if(jQuery(this).hasClass('email')) {
				var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
				if(!emailReg.test(jQuery.trim(jQuery(this).val()))) {
					var labelText = jQuery(this).attr('name');
					jQuery(this).parent().append('<span class="error">You entered an invalid '+labelText+'.</span>');
					hasError = true;
				}
			}
		});
		if(!hasError) {
			var formInput = jQuery(this).serialize();
			jQuery.post(jQuery(this).attr('action'),formInput, function(data){
				jQuery('#footer #contactForm').slideUp("fast", function() {				   
					jQuery(this).before('<p class="contactSuccess"><strong>Thanks!</strong> Your email was successfully sent.</p>');
				});
			});
		}
		
		return false;
		
	});
});