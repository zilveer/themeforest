(function($) {
	"use strict";
	
	var $window = $(window);
	
	$(document).ready(function () {
		$('.dfd-blog').each(function() {
			var $container = $(this),
				layout_style = $container.data('layout-style'),
				columns_wide = $container.data('columns'),
				$items = $('.post', $container),
				columns_normal, columns_medium, columns_small, columns_mobile;

			if($container.hasClass('dfd-blog-masonry') || $container.hasClass('dfd-blog-fitRows')) {
			
				if(!layout_style) layout_style = 'masonry';
				if(!columns_wide) columns_wide = 5;
				columns_normal = (columns_wide > 4) ? 4 : columns_wide;
				columns_medium = (columns_wide > 3) ? 3 : columns_wide;
				columns_small = (columns_wide > 2) ? 2 : columns_wide;
				columns_mobile = (columns_wide > 1) ? 1 : columns_wide;

				var columns = 3;
				var columnsWidth;

				var setColumns = function () {
					$items = $('> .post', $container);
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
						itemSelector : '.post',
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

				$container.parent('.dfd-blog-wrap').find('.sort-panel .filter a').click(function () {
					var selector = $(this).attr('data-filter');

					$(this).parent().parent().find('> li.active').removeClass('active');
					$(this).parent().addClass('active');

					$container.isotope({
						filter : selector
					});

					return false;
				});

				$window.on('resize',runIsotope);

				$container.observeDOM(function(){
					runIsotope();
				});
			}
		});
	});
})(jQuery);