(function($) {
	"use strict";
	var $window = $(window);

	$(document).ready(function () {
		$('.dfd-blog-module.blog_masonry').each(function() {
			var $self = $(this);
			var $container = $('.posts-list', $self);
			var $items = $('.post', $container);

			var columns = 3;
			var columnsWidth;
			var delim = 20;
			
			var masonry_layout_mode = $self.data('masonry-layout');
			
			if(!masonry_layout_mode) {
				masonry_layout_mode = 'masonry';
			}

			var setColumns = function () {
				$items = $('.post', $container);
				var width = $container.width();


				switch(true) {
					case (width > 1380): columns = 4; break;
					case (width > 980): columns = 3; break;
					case (width > 640): columns = 2; break;
					default: columns = 1;
				}
				columnsWidth = Math.floor($container.width() / columns);

				$items.width(columnsWidth);
			};

			var runIsotope = function() {
				setColumns();

				$container.isotope({
					layoutMode: masonry_layout_mode,
					/*masonry: {
						columnWidth: columnsWidth,
					},*/
					itemSelector : '.post', 
					resizable : true
				});

				$('body').bind('isotope-add-item', function(e, item) {
					$(item).imagesLoaded(function() {
						$container.isotope('insert', $(item));
					});
				});
			};

			runIsotope();
			$container.imagesLoaded(runIsotope);
			$window.resize(runIsotope);

			$self.find('.sort-panel .filter a').click(function () { 
				var selector = $(this).attr('data-filter');

				$(this).parent().parent().find('> li.active').removeClass('active');
				$(this).parent().addClass('active');

				$container.isotope( { 
					filter : selector 
				});

				return false;
			});
		});
	});
})(jQuery);