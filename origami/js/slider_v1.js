jQuery.noConflict();
jQuery(document).ready(function() {

		jQuery('#full-width-slider').cycle({      
			fx: 'scrollVert',      
			speed: 1000,      
			pause: 1,      
			timeout: 7000,      
			delay: 500,      
			prev: '#slider_prev',      
			next: '#slider_next'    
		});
		//jQuery("#full-width-slider").parent("#origami-slider").css({ "padding-top": "0", "height": "auto" });
});