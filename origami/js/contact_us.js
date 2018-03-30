jQuery.noConflict();
jQuery(document).ready(function() {

	jQuery("#contactName1, #email1, #commentsText1").defaultvalue(
        "Name",
        "Email",
        "Message"
    );


	jQuery('#mainContactUs #contactForm').submit(function() {
		jQuery('#mainContactUs #contactForm .error').remove();
		var hasError = false;
		jQuery('#mainContactUs .requiredField').each(function() {
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
				jQuery('#mainContactUs #contactForm').slideUp("fast", function() {				   
					jQuery(this).before('<p><strong>Thanks!</strong> Your email was successfully sent.</p>');
				});
			});
		}
		
		return false;
		
	});
	
});