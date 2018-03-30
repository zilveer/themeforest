/**
 * Prints out the inline javascript needed for the colorpicker and choosing
 * the tabs in the panel.
 */

jQuery(document).ready(function($) {
	
	// Fade out the save message
	$('.fade').delay(1000).fadeOut(1000);
	$('.of-color').wpColorPicker();
	
	// Switches option sections
	$('.group').hide();
	var active_tab = '';
	if (typeof(localStorage) != 'undefined' ) {
		active_tab = localStorage.getItem("active_tab");
	}
	if (active_tab != '' && $(active_tab).length ) {
		$(active_tab).fadeIn();
	} else {
		$('.group:first').fadeIn();
	}
	$('.group .collapsed').each(function(){
		$(this).find('input:checked').parent().parent().parent().nextAll().each( 
			function(){
				if ($(this).hasClass('last')) {
					$(this).removeClass('hidden');
						return false;
					}
				$(this).filter('.hidden').removeClass('hidden');
			});
	});
        
        
	if (active_tab != '' && $(active_tab + '-tab').length ) {
		$(active_tab + '-tab').addClass('nav-tab-active');
	}
	else {
		$('.nav-tab-wrapper a:first').addClass('nav-tab-active');
	}
	
	$('.nav-tab-wrapper a').click(function(evt) {
		$('.nav-tab-wrapper a').removeClass('nav-tab-active');
		$(this).addClass('nav-tab-active').blur();
		var clicked_group = $(this).attr('href');
		if (typeof(localStorage) != 'undefined' ) {
			localStorage.setItem("active_tab", $(this).attr('href'));
		}
		$('.group').hide();
		$(clicked_group).fadeIn();
		evt.preventDefault();
		
		// Editor Height (needs improvement)
		$('.wp-editor-wrap').each(function() {
			var editor_iframe = $(this).find('iframe');
			if ( editor_iframe.height() < 30 ) {
				editor_iframe.css({'height':'auto'});
			}
		});
	
	});
        

jQuery('#background_body_option_pattern').next('div').next('img').click(function() {
  		jQuery('#section-background_parttern').show();
		jQuery('#section-background_large_image, #section-background_color, #section-background_color_img').hide();
});
	
jQuery('#background_body_option_big_image').next('div').next('img').click(function() {
  		jQuery('#section-background_parttern, #section-background_color, #section-background_color_img').hide();
		jQuery('#section-background_large_image').show();
});

jQuery('#background_body_option_color').next('div').next('img').click(function() {
  		jQuery('#section-background_parttern, #section-background_large_image').hide();
		jQuery('#section-background_color, #section-background_color_img').show();
});

if (jQuery('#background_body_option_pattern:checked').val() !== undefined) {
		jQuery('#section-background_parttern').show();
		jQuery('#section-background_large_image, #section-background_color, #section-background_color_img').hide();
}

if (jQuery('#background_body_option_big_image:checked').val() !== undefined) {
		jQuery('#section-background_parttern, #section-background_color, #section-background_color_img').hide();
		jQuery('#section-background_large_image').show();
}

if (jQuery('#background_body_option_color:checked').val() !== undefined) {
		jQuery('#section-background_parttern, #section-background_large_image').hide();
		jQuery('#section-background_color, #section-background_color_img').show();
}

           					
	$('.group .collapsed input:checkbox').click(unhideHidden);
				
	function unhideHidden(){
		if ($(this).attr('checked')) {
			$(this).parent().parent().parent().nextAll().removeClass('hidden');
		}
		else {
			$(this).parent().parent().parent().nextAll().each( 
			function(){
				if ($(this).filter('.last').length) {
					$(this).addClass('hidden');
					return false;		
					}
				$(this).addClass('hidden');
			});
           					
		}
	}
	
	// Image Options
	$('.of-radio-img-img').click(function(){
		$(this).parent().parent().find('.of-radio-img-img').removeClass('of-radio-img-selected');
		$(this).addClass('of-radio-img-selected');		
	});
		
	$('.of-radio-img-label').hide();
	$('.of-radio-img-img').show();
	$('.of-radio-img-radio').hide();
		 		
});	