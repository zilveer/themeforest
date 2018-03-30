jQuery(document).ready(function($) {
	jQuery('form#contactForm').submit(function() {
		jQuery('form#contactForm .error').remove();
		var hasError = false;
		jQuery('.requiredField').each(function() {
			if(jQuery.trim(jQuery(this).val()) == '') {
				var labelText = jQuery(this).prev('label').text();
				jQuery(this).stop().animate({borderTopColor:"#ff9999",borderBottomColor:"#ff9999",borderRightColor:"#ff9999",borderLeftColor:"#ff9999", color:"red"},300);		
								
				hasError = true;
				jQuery('.requiredField').hover(function(){
					jQuery(this).removeAttr('style');
					jQuery(this).unbind('mouseenter mouseleave')
				});
			} else if(jQuery(this).hasClass('email')) {
				var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
				if(!emailReg.test(jQuery.trim(jQuery(this).val()))) {
					var labelText = jQuery(this).prev('label').text();
					jQuery(this).stop().animate({borderTopColor:"#ff9999",borderBottomColor:"#ff9999",borderRightColor:"#ff9999",borderLeftColor:"#ff9999", color:"red"},300);	
					hasError = true;
				}else {
					jQuery(this).removeClass('error-highlight').css('color','#666');		
				}
			} else {
				jQuery(this).removeClass('error-highlight').css('color','#666');	
			}
		});		
		if(!hasError) {
			jQuery('.loading').fadeIn();
			
			var formInput = jQuery(this).serialize();
			jQuery.post(jQuery(this).attr('action'),formInput, function(data){
				jQuery('form#contactForm').hide(600);	
				jQuery('.form-success').fadeIn();			   
			});
		}
		
		return false;
		
	});
});