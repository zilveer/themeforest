jQuery(document).ready(function() {

	jQuery(".weather-form").submit( function(e){
		form = jQuery(this);
		city = form.find('input').val();
			jQuery.ajax({
			type: "post",
			url: MomWeather.url,
                        dataType: 'html',
                        data: "action=mom_ajaxweather&nonce="+MomWeather.nonce+"&city="+city,
			beforeSend: function() {
				form.find('.sf-loading').fadeIn();
			},
			success: function(data){
                            if (city !== '') {
				if (data !== '') {
					form.nextAll('.weather-widget').html(data).hide().fadeIn();
					form.next('.message-box').fadeOut();
				} else {
					form.next('.message-box').remove();
					form.after('<span class="message-box error">'+MomWeather.error+'<i class="brankic-icon-error"></i></span>');
				}
                            } 
				form.find('.sf-loading').fadeOut();
			//message box
				$('.message-box i').on('click', function(e) {
				    $(this).parent().fadeOut();    
				});	
		
			}
			
		});	
		return false;
	})
})