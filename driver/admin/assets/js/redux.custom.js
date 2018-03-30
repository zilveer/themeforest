
jQuery(document).ready(function ($) {
	
	$('input[name="ironband[newsletter_type]"]').change(function() {
	
		if($(this).val() == 'iron_newsletter_subscribe') {
			
			$('#mailchimp_api_key').closest('tr').hide();
			$('#mailchimp_list_id').closest('tr').hide();
			$('#newsletter_download').closest('tr').fadeIn();
			
		}else{
		
			$('#newsletter_download').closest('tr').hide();
			$('#mailchimp_api_key').closest('tr').fadeIn();
			$('#mailchimp_list_id').closest('tr').fadeIn();
		
		}
		
	});
	
	$('input[name="ironband[newsletter_type]"]:checked').change();
});