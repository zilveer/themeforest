jQuery(document).ready(function($) {
	jQuery('form#MaincontactForm').submit(function() {
		jQuery('form#MaincontactForm .main-contactform-error').remove();
		var hasError = false;
		jQuery('.requiredField').each(function() {
			if(jQuery.trim(jQuery(this).val()) == '') {
				var labelText = jQuery(this).prev('label').text();
				jQuery(this).parent().append('<span class="main-contactform-error">'+labelText+' required</span>');
				hasError = true;
			} else if(jQuery(this).hasClass('email')) {
				var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
				if(!emailReg.test(jQuery.trim(jQuery(this).val()))) {
					var labelText = jQuery(this).prev('label').text();
					jQuery(this).parent().append('<span class="main-contactform-error">invalid '+labelText+'</span>');
					hasError = true;
				}
			}
		});
		if(!hasError) {
			jQuery('form#MaincontactForm ol').slideUp("slow");
			var formInput = jQuery(this).serialize();
			jQuery.post(jQuery(this).attr('action'),formInput, function(data){
				jQuery('form#MaincontactForm').slideUp("fast", function() {				   
					jQuery(this).before('<p class="main-contactform-thanks"><strong>Thanks!</strong> We recieved your request.</p>');
				});
			});
		}
		
		return false;
		
	});
});