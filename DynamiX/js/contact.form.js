
/* :: 	Contact Form										      	  
---------------------------------------------*/

jQuery(document).ready(function($) {
	
	$('form#contactForm').submit(
		function()
		{
			$('form#contactForm .error').remove();
			var hasError = false;
			
			$('.requiredField').each(
				function()
				{
					if($.trim($(this).val()) == '')
					{
						var labelText = $(this).prev('label').text();
						$(this).parent().append('<span class="error">You forgot to enter your '+labelText+'.</span>');
						hasError = true;
					}
					else if($(this).hasClass('email'))
					{
						var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
						if(!emailReg.test($.trim($(this).val())))
						{
							var labelText = $(this).prev('label').text();
							$(this).parent().append('<span class="error">You entered an invalid '+labelText+'.</span>');
							hasError = true;
						}
					}
				}
			);
			
			if(!hasError)
			{
				var formInput = $(this).serialize();
				$.post($(this).attr('action'),formInput,
					function(data) {
						$('form#contactForm').slideUp("fast", function() {				   
							$(this).before('<p class="thanks"><strong>Thanks!</strong> Your email was successfully sent. I check my email all the time, so I should be in touch soon.</p>');
					});
				});
			}
			
			return false;
			
		}
	);
});