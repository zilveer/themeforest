
/*	J Q U E R Y   A J A X   C O N T A C T   F O R M
.............................................................................................................................................*/

$(function() {
		/* AJAX CONTACT FORM */
		var sendButton = $('#submit-mail');
		var formStatus = $('#form-status');
		var statusMessage = $('#status-message');
		var form = $('#contact-form');
		var loading = $('#loading');
				
		sendButton.click(function(event) {
			event.preventDefault();
										
			//This code will send a data object via a POST request and display the retrieved data.
			$.ajax({
				url : wpurl.template_url + '/function-includes/theme-shortcodes/contact-form-shortcode/ajax.php', 
				dataType: 'json',
				type: 'POST',                                                                      
				data: 'name=' + $('#name').val() + '&email=' + $('#email').val() + '&message=' + $('#message').val() + 
					  '&myemail=' + $('#myemail').val() + '&success=' + $('#success').val() + '&failure=' + $('#failure').val() +
					  '&invalid=' + $('#invalid').val() + '&incomplete=' + $('#incomplete').val() + '&subject=' + $('#subject').val(), 
				beforeSend: function() {
					sendButton.disabled = true;						
					loading.css('visibility', 'visible');
				},
				success: function(response) {
					sendButton.disabled = false;
					loading.css('visibility', 'hidden');
							
					if(response.type === 'success') {
						statusMessage.text(response.message);
						if(formStatus.hasClass('error')) { formStatus.removeClass('error'); }		
						formStatus.addClass('success').css('visibility', 'visible');
					}
					else {								
						statusMessage.text(response.message);		
						if(formStatus.hasClass('success')) { formStatus.removeClass('success'); }
						formStatus.addClass('error').css('visibility', 'visible');
					}
				}
			});
		});
});








