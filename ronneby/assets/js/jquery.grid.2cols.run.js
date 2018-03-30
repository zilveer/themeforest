(function($, window){
	"use strict";
	
	var run_isotope = function($container) {
		var $els = $('article.small-news', $container);
		var width = $container.width();
		var columns;

		switch(true) {
			case (width < 630): columns = 1; break;
			default: columns = 2;
		}

		var column_width = Math.floor( width / columns ) - 30;
		
		$els.css({
			width: column_width + 'px'
		});

		$container.isotope({
			itemSelector : 'article.small-news', 
			resizable : true,
			layoutMode : 'fitRows'
		});
		
		$('body').bind('isotope-add-item', function(e, item) {
			$(item).imagesLoaded(function() {
				$container.isotope('insert', $(item), function() {
					fluidvids.apply();
				});
			});
		});
	};

	$(document).ready(function(){
		$('#grid-posts').each(function(){
			var $container = $(this);

			$container.imagesLoaded(function () { 
				run_isotope($container);
			});
			$(window).on('resize', function(){
				run_isotope($container);
			});
			$container.observeDOM(function(){ 
				run_isotope($container);
			});
		});
	});
	
})(jQuery, window, undefined);