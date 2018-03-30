/*
 * Contact Form Jquery
 * Inspired by http://trevordavis.net/blog/wordpress-jquery-contact-form-without-a-plugin
*/

jQuery(document).ready(function($){
	$('form#contactForm').submit(function() {
		$('.error').remove();
		var hasError = false;
		$('.requiredField').each(function() {
			if(jQuery.trim($(this).val()) == '') {
				var labelText;
				switch($(this).attr('id')){
					case 'contactName':
					labelText = nameErrorText;
					break;
					
					case 'email':
					labelText = emailErrorText;
					break;
					
					case 'comments':
					labelText = commentErrorText;
					break;
					
					case 'captcha':
					labelText = captchaErrorText;
					break;
				}
				if($('.error')!==''){
				  $(this).parent().before('<span class="error">'+forgot_error+' '+labelText+'.</span>');
				}
				hasError = true;
			} else if($(this).hasClass('email')) {
				var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
				if(!emailReg.test(jQuery.trim($(this).val()))) {
					var labelText = $(this).attr('placeholder');
					if($('.error')!==''){
					  $(this).parent().before('<span class="error">'+email_error+' '+labelText+'.</span>');
					}
					hasError = true;
				}
			}  else if($(this).hasClass('captcha')) {
				 var captcha = $(this).val();
				 
				 $.ajax({
					type: "POST",
					async:false,
					cache:false,
					url: verify,
			        data:{code:captcha},
					success:function(msg){
					  var labelText = $('#captcha').attr('placeholder');
						if(msg==0){
						   if($('.error')!==''){	
							  $('#captcha').parent().before('<span class="error">'+email_error+' '+labelText+'.</span>');
						   }
						   hasError = true;
						}
					 }
		         });
				
			}
		});
		if(!hasError) {	
			$('#contactForm #submitMsg').fadeOut('normal', function() {
				$(this).parent().append('<img src="'+loadimg+'" />');
			});
			var formInput = $(this).serialize();
			$.post($(this).attr('action'),formInput, function(data){
				$('form#contactForm').slideUp("fast", function() {		   
					$(this).before('<span class="success">'+success+'</span>');
				});
			});
		}
		return false;
		
	});
});
