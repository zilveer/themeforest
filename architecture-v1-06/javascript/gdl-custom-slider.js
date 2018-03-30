jQuery(document).ready(function(){
	var custom_slider = jQuery('#gdl-custom-slider');
	var custom_slides = custom_slider.children('.custom-slides');
	var custom_caption = custom_slider.children('.custom-caption-row').children('.custom-caption-column');
	
	var header_area = jQuery('.header-wrapper').filter(':first');
	
	custom_slides.cycle({ 
	    before:     before_transition,
        after:      after_transition,
		fx:			'fade',
		pager:  	custom_slider.children('.custom-slider-nav-wrapper').children('.custom-slider-nav'),
		speed:   	parseInt(CUSTOM.speed), 
		timeout: 	parseInt(CUSTOM.timeout) 
	});
	
	jQuery(window).scroll(function(){
		var cur_pos = jQuery(this).scrollTop();
		var header_height = header_area.outerHeight();
		var parallax = parseInt(CUSTOM.parallax);
		
		if( cur_pos <= header_height && parallax > 0 ){
			custom_slides.children().css('background-position', 'center -' + (cur_pos / parallax ) + 'px');
		}
	});	
	
	set_slider_height();
	jQuery(window).resize(function(){
		set_slider_height();
	});
	
	function set_slider_height(){
		var default_height = parseInt(custom_caption.attr('data-height'));
		var new_height;
		
		if( jQuery(window).width() < 1140 ){
			new_height = ( default_height * jQuery(window).width() ) / 1140;
		}else{
			new_height = default_height;
		}

		custom_caption.height(new_height);	
	}
	
	function before_transition(curr, next, opts, fwd){
		jQuery(curr).removeClass('active');
		
		var data_caption = jQuery(curr).attr('data-caption');
		custom_caption.children('[data-caption="' + data_caption + '"]').hide();
	}
	
	function after_transition(curr, next, opts, fwd){
		jQuery(next).addClass('active');

		var data_caption = jQuery(next).attr('data-caption');
		var cur_caption = custom_caption.children('[data-caption="' + data_caption + '"]'); 
		
		// Determine the caption height
		cur_caption.css('display', 'block');
		var caption_height = cur_caption.outerHeight();
		cur_caption.css({'margin-top': '-' + (caption_height/2) + 'px', 'display': 'none'});
		
		cur_caption.fadeIn();
	}
	

});