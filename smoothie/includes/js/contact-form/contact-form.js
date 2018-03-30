$(document).ready(function() {
	$('form#contactForm').submit(function() {
		if(!hasError) {
			$('form#contactForm p.buttons button').fadeOut('normal', function() {
				$(this).parent().append('<img src="/images/loading.gif" alt="Loading&hellip;" height="31" width="31" />');
			});
			var formInput = $(this).serialize();
			$.post($(this).attr('action'),formInput, function(data){
				$('form#contactForm').slideUp("fast", function() {				   
					$(this).before('<p class="thanks"><strong>Thanks!</strong> Your email was successfully sent. I check my email all the time, so I should be in touch soon.</p>');
				});
			});
		}
		return false;
	});
});