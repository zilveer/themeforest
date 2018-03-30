(function($) {
  "use strict";
	/** jquery.mb.YTPlayer.js  **/
	try {
		$('.cover-player').mb_YTPlayer();
	} catch (e) {
		// TODO: handle exception
		console.log('Can not load jquery.mb.YTPlayer.js');
	}  
	try {
		$('.widget_calendar table').addClass('table');
	}
	catch (e) {
	}  	
	/** Fitvideo **/
	try {
		$('.fitvideo').fitVids();
	}
	catch (e) {
		// TODO: handle exception
		console.log('Can not load fitVids.');
	}
	/** headroom  **/
	try {
		$('.header').headroom();
	} catch (e) {
		// TODO: handle exception
		console.log('Can not load headroom.min.js');
	}  
	try{
		$(".flexslider").flexslider({
			directionNav: false
		});
	}
	catch (e) {
		// TODO: handle exception
	}
	
    $( document.body ).on( 'post-load', function () {
    	try{
    		$('.fitvideo').fitVids();
    		$(".flexslider").flexslider({
    			directionNav: false
    		});
    	}
    	catch (e) {
    		// TODO: handle exception
    	}
    } );	
	
	
})(jQuery);