(function($) {
	"use strict";
	
	var $window = $(window);
	
	$(document).ready(function () {
		$('.dfd-gallery').each(function() {
			var $container = $(this);
			var layout_style = $container.data('layout-style');
			var columns_wide = $container.data('columns');

			var $items = $('.dfd-gallery-single-item');
			var columns_normal, columns_medium, columns_small, columns_mobile;

			if(!layout_style) layout_style = 'masonry';
			if(!columns_wide) columns_wide = 5;
			columns_normal = (columns_wide > 4) ? 4 : columns_wide;
			columns_medium = (columns_wide > 3) ? 3 : columns_wide;
			columns_small = (columns_wide > 2) ? 2 : columns_small;
			columns_mobile = (columns_wide > 1) ? 1 : columns_mobile;

			var columns = 3;
			var columnsWidth;

			var setColumns = function () {
				$items = $('.dfd-gallery-single-item');
				var width = $container.width();

				switch(true) {
					case (width > 1280): columns = columns_wide; break;
					case (width > 1024): columns = columns_normal; break;
					case (width > 800): columns = columns_medium; break;
					case (width > 460): columns = columns_small; break;
					default: columns = columns_mobile;
				}

				columnsWidth = Math.floor(width / columns);
				$items.width(columnsWidth);
			};

			var runIsotope = function() {
				setColumns();

				$container.isotope({
					layoutMode: layout_style,
					masonry: {
						columnWidth: columnsWidth
					},
					itemSelector : '.dfd-gallery-single-item', 
					resizable : true
				});

				$('body').bind('isotope-add-item', function(e, item) {
					$(item).width(columnsWidth);
					$(item).imagesLoaded(function() {
						$container.isotope('insert', $(item));
					});
				});
			};

			runIsotope();
			$container.imagesLoaded(runIsotope);

			$window.on('resize',runIsotope);

			$container.observeDOM(function(){ 
				runIsotope($container);
			});
		});
	});
})(jQuery);