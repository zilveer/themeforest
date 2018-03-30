(function($) {
	"use strict";
	var initHoverDir = function() {
		$('.project.portfolio-hover-style-1 .entry-thumb, .dfd-gallery-single-item.portfolio-hover-style-1 .entry-thumb').each( function() {
			$(this).hoverdir({
				//hoverDelay : 75
				//hoverDelay : 50,
				//inverse : true
			});
		});
	};
	$(window).load(function() {
		initHoverDir();
		$('.dfd-blog, .dfd-portfolio, .dfd-gallery').observeDOM(function() {
			initHoverDir();
		});
	});
})(jQuery);