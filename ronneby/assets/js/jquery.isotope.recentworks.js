;(function($){
	"use strict";
	$.fn.sbIsotopeRecentWorks = function(layout_mode) {
		
		if(!layout_mode || layout_mode == '') layout_mode = 'masonry';
		
		var $window = $(window);
		var $container = $('.recent-works-list', $(this));
		var $items = $('.recent-works-item.project', $container);
		
		var columns = 4;
		var columnsWidth;

		var setColumns = function () {
			$items = $('.recent-works-item.project', $container);
			var width = $container.width();

			switch(true) {
				case (width > 1279): columns = 4; break;
				case (width > 1024): columns = 3; break;
				case (width > 640): columns = 2; break;
				default: columns = 1;
			}

			columnsWidth = Math.floor($container.width() / columns);
			$items.width(columnsWidth);
		};

		var runIsotope = function() {
			setColumns();
			
			$container.isotope({
				layoutMode: layout_mode,
				masonry: {
					columnWidth: columnsWidth
				},
				itemSelector : '.recent-works-item.project', 
				resizable : true
			});
			
			$('body').bind('isotope-add-item', function(e, item) {
				$(item).width(columnsWidth);
				$(item).imagesLoaded(function() {
					$container.isotope('insert', $(item));
				});
			});
		};

		var init = function() {
			runIsotope();
			$container.imagesLoaded(runIsotope);
			//$container.observeDOM(function(){ 
			//	runIsotope();
			//});
			$window.on('resize',runIsotope);

			$('.sort-panel .filter a', $(this)).click(function () { 
				var selector = $(this).attr('data-filter');

				$(this).parent().parent().find('> li.active').removeClass('active');
				$(this).parent().addClass('active');

				$container.isotope( { 
					filter : selector 
				});

				return false;
			});
		};
		
		return this.each(init);
	};
})(jQuery);
