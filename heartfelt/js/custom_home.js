/* ----------------- Start Document ----------------- */
(function($){
	$(document).ready(function(){
		"use strict";

/*----------------------------------------------------*/
/*	Home Blog Posts Carousel
/*----------------------------------------------------*/

	$(".owl-carousel").owlCarousel({
      autoPlay: 5000, 
      items : 4,
      itemsDesktop : [1199,4],
      itemsDesktopSmall : [979,2],
      itemsMobile: [479,1],
      scrollPerPage: true,
      stopOnHover: true
	});

/* ------------------ End Document ------------------ */
});
	
})(this.jQuery);
