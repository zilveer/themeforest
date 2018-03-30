jQuery(document).ready(function() {

	jQuery(".mom_mailchimp_subscribe").submit( function(e){
		sf = jQuery(this);
		email = sf.find('.mms-email').val();
		list = sf.data('list_id');
		$('.message-box').fadeOut();
		if (email === '')
		{
			sf.before('<span class="message-box error">'+momMailchimp.error+'<i class="brankic-icon-error"></i></span>');
		}
		else
		{
			jQuery.ajax({
			type: "post",
			url: momMailchimp.url,
                        dataType: 'html',
                        data: "action=mom_mailchimp&nonce="+momMailchimp.nonce+"&email="+email+"&list_id="+list,
			beforeSend: function() {
				sf.find('.sf-loading').fadeIn();
			},
			success: function(data){
				if(data ==="success") {
				sf.find('.email').val("");
					sf.before('<span class="message-box success">'+momMailchimp.success+'<i class="brankic-icon-error"></i></span>').hide().fadeIn();
				}
				else
				{
					sf.before('<span class="message-box error">'+momMailchimp.error+'<i class="brankic-icon-error"></i></span>').hide().fadeIn();
				}
				sf.find('.sf-loading').fadeOut();
			//message box
				$('.message-box i').on('click', function(e) {
				    $(this).parent().fadeOut();    
				});
			}
		});	
		}
		return false;
	});
});