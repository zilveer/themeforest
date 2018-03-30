(function($, window){
	"use strict";
	
	var run_isotope = function($container) {
		var $els = $('.project', $container);
		var width = $container.width();
		var columns;

		switch(true) {
			case (width < 630): columns = 1; break;
			case (width < 830): columns = 2; break;
			default: columns = 3;
		}

		var column_width = Math.floor( width / columns ) - 30;
		$els.css({
			'width': column_width + 'px'
		});

		$container.isotope({
			itemSelector: '.project',
			resizable : true,
			layoutMode : 'masonry'
		});
		
		$('body').bind('isotope-add-item', function(e, item) {
			$(item).imagesLoaded(function() {
				$container.isotope('insert', $(item));
			});
		});
	};

	$(document).ready(function(){
		$('#grid-folio').each(function(){
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
