	function submitContactForm (form) {
		var the_button =  document.getElementById('contact-button');
		errors = new Array();
		if(!document.getElementById('contact-name').value.length) {
			errors.push('Please enter your name.');
		}
		if(!document.getElementById('contact-email').value.length) {
			errors.push('Please enter your email.');
		}
		if(!document.getElementById('contact-message').value.length) {
			errors.push('Please enter your message.');
		}
		if(errors.length) {
			var message = "Unable to submit your form due to the following errors:\n\n";
			for(i = 0; i < errors.length; i++) {
				message += errors[i] + "\n";
			}
			alert(message);
			return false;
		}
		return true;
	}
