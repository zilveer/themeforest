jQuery(document).ready(function ($) {
	jQuery("body").on('click','.mom_gn_upgrade_button', function(e){
                var t = $(this);
			jQuery.ajax({
			type: "post",
			url: momAjaxOpt.url,
                        dataType: 'html',
                        data: "action=mom_gnUpgrade&nonce="+momAjaxOpt.nonce,
			beforeSend: function() {
                            t.next('span').text(' Processing...').hide().fadeIn();
			},
			success: function(data){
                            t.next('span').text(' Done...').delay(1000).fadeOut();
			    t.removeClass('mom_gn_upgrade_button');
			}
			
		});	
		return false;
	})
});