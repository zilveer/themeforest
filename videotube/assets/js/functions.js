(function($) {
  "use strict";
  jQuery(document).ready(function($){
	 try {
		jQuery('form#mars-submit-video-form').mousedown( function() {
		    tinyMCE.triggerSave();
		});
	} catch (e) {
		// TODO: handle exception
	}
	
	try {
		
		$(".dropdown-toggle").dropdown();
		// Stop carousel
		jQuery('.carousel').carousel({
			interval: false
		});
		// Fix placeholder
		jQuery('input, textarea').placeholder();		
		
	} catch (e) {
		// TODO: handle exception
	}
	
  });
})(jQuery);
