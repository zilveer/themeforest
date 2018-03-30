/* Portfolio Sorting */
(function($) {
	"use strict";
	
	jQuery(document).ready(function () {
	
		var run_isotope = function($container) {
			var $els = $('.project', $container);
			var width = $container.width();
			var columns;
			
			switch(true) {
				case (width < 480): columns = 1; break;
				default: columns = 2;
			}
			
			var column_width = Math.floor( width / columns ) - 30;
			$els.css({
				'width': column_width + 'px'
			});
			
			$container.isotope({ 
				itemSelector : '.project', 
				resizable : true,
				layoutMode : 'masonry'
			});
			
			$('body').bind('isotope-add-item', function(e, item) {
				$(item).imagesLoaded(function() {
					$container.isotope('insert', $(item));
				});
			});
		};
		
		$('.works-list').each(function(){
			var $container = $(this);
			
			$container.imagesLoaded(function () {
				run_isotope($container);
			});

			$('.sort-panel .filter a').click(function () { 
				var selector = $(this).attr('data-filter');

				$(this).parent().parent().find('> li.active').removeClass('active');
				$(this).parent().addClass('active');

				$container.isotope({
					filter : selector
				});

				return false;
			});

			$(window).on('resize',function(){
				run_isotope($container);
			});
			$container.observeDOM(function(){
				run_isotope($container);
			});
		});
	});
})(jQuery);
