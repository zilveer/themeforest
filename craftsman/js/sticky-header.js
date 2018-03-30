jQuery(document).ready(function($) {
	"use strict"; 

	// Sticky header
	$(window).scroll(function() {
		var scrolled = $(this).scrollTop(),
		headerHeight = $('#site-header').height(),
		headerOffset = $('#site-header').offset().top;
		
		if(scrolled > headerOffset) {
			$('#site-header #header-wrapper').css({ 'position' : 'fixed', 'top' : '0px' });
			$('.admin-bar #site-header #header-wrapper').css({ 'position' : 'fixed', 'top' : '32px'});
			
		} else {
			$('#site-header #header-wrapper').css({ 'position' : 'static', 'top' : 'auto' });
		}
		
	});
	
	
	// Trigger scroll
	setTimeout( function(){ 
		$(window).scroll();
	}, 500 );
	
});