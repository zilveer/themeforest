jQuery(document).ready(function ($) {

	jQuery('#publish').on('click', function() {
		var saveall = false;
		if( !(saveall = jQuery('#dt_slider-uploader .inside iframe').contents().find('#save-all')) || !saveall.length ) {
			saveall = jQuery('#gallery-admin .inside iframe').contents().find('#save-all');
		}
		
		if( saveall && saveall.length ) {
			var post = jQuery('form#post');
			saveall.click();
			setTimeout( function() { post.submit(); }, 600 );	
			return false;
		}

		return true;
	});

});
