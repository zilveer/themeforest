(function($){
	"use strict";
	
	var $window = $(window);
	
	$(document).ready(function () {
		var $container = $('#grid-posts');
		var $items = $('article.small-news', $container);
		
		var columns = 4;
		var columnsWidth;

		var setColumns = function () {
			$items = $('article.small-news', $container);
			var width = $container.width();

			switch(true) {
				case (width > 1024): columns = 4; break;
				case (width > 640): columns = 2; break;
				default: columns = 1;
			}

			columnsWidth = Math.floor($container.width() / columns);
			$items.width(columnsWidth - 30);
		};

		var runIsotope = function() {
			setColumns();
			
			$container.isotope({
				layoutMode: 'masonry',
				masonry: {
					columnWidth: columnsWidth
				},
				itemSelector : 'article.small-news', 
				resizable : true
			});
			
			$('body').bind('isotope-add-item', function(e, item) {
				$(item).width(columnsWidth - 30);
				$(item).imagesLoaded(function() {
					$container.isotope('insert', $(item), function() {
						fluidvids.apply();
					});
				});
			});
		};

		runIsotope();
		$container.imagesLoaded(runIsotope);
		$container.observeDOM(function(){ 
			runIsotope();
		});
		$window.on('resize',runIsotope);
	});
	
})(jQuery);
