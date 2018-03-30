(function($, undefined) {
	"use strict";

	$(function() {
		var sortable = function(containerSel, innerSel) {
			if (!$.fn.isotope) return;

			var callback = function() {
				var container = $(this),
					container_width = container.width(),
					columns = $.WPV.reduce_column_count(parseInt(container.attr('data-columns'), 10));

				container.bind('reload-isotope', callback);

				var	column_width = Math.floor(container_width/columns),
					lis = container.find(innerSel),
					layout_type = container.hasClass('masonry') ? 'masonry' : 'fit_rows';

				if(container.hasClass('isotope') || (container.hasClass('loop-wrapper') && !container.hasClass('wpv-isotope-loaded')))
					lis.not('.isotope-item');

				lis.removeClass('clearboth');

				var options = {
					fit_rows: {
						resizable: false,
						layoutMode: 'fitRows'
					},
					masonry: {
						resizable: false,
						columnWidth: column_width
					}
				};

				container.addClass('wpv-notransition');

				lis.css({
					width: column_width
				});

				container.removeClass('wpv-notransition');

				container.imagesLoaded(function() {
					if ( container.hasClass( 'wpv-isotope-loaded' ) ) {
						container.isotope('appended', lis.not('.isotope-item'));
					} else {
						container.addClass('wpv-isotope-loaded');
					}

					lis.addClass('isotope-item');

					container.isotope(options[layout_type]);

					if( ! container.hasClass('loop-wrapper')) {
						var p = container.parent();
						if(!p.data('wpv-isotope-loaded') && !container.hasClass('no-isotope-fadein')) {
							p.data('wpv-isotope-loaded', true);
							p.css({
								height: 'auto',
								overflow: 'visible'
							});
						}
					}
				});
			};

			$(containerSel).each(callback);
		};

		var initPortfolio = function() {
			sortable('.portfolios.isotope > ul', '>li');

			$( '.page-content, .page-content > .row:first-child > .wpv-grid:first-child' ).find( ' > .portfolios.isotope:first-child > .sort_by_cat' ).appendTo( $( '.page-header-content' ) ).removeClass( 'grid-1-1' );

			$('.sort_by_cat').show();
		};

		$.rawContentHandler(function() {
			initPortfolio();

			$('.sort_by_cat[data-for] a').click(function(e) {
				var filter = $(this).attr('data-value'),
					list = $($(this).closest('.sort_by_cat').data('for')).find('> ul');

				$(this).parent().siblings().find('.active').removeClass('active');
				$(this).addClass('active');

				list.trigger("portfolioSortStart", [filter]);

				list.isotope({
					filter: (filter === 'all' ? '*' : '[data-type~="' + filter + '"]')
				}, function() {
					list.trigger("portfolioSortComplete", [filter]);
				});

				e.preventDefault();
			}).each(function() {
				var filter = $(this).attr('data-value'),
					isotope = $($(this).closest('.sort_by_cat').data('for')).find('> ul');

				if (filter !== 'all' && isotope.children().filter('[data-type~="' + filter + '"]').length === 0) $(this).parent().hide();
			});
		});

		if ($.fn.isotope) $(window).smartresize(initPortfolio);

		var initNews = function() {
			$('.loop-wrapper.news:not(.scroll-x):not(.masonry)').each(function() {
				var columns = $.WPV.reduce_column_count(parseInt($(this).attr('data-columns'), 10));

				$('> .page-content', this).removeClass('clearboth').filter(':nth-child('+columns+'n+1)').addClass('clearboth');
			});

			sortable('.loop-wrapper.news.masonry', '>.page-content');
		};

		$(window).smartresize(initNews);
		initNews();
	});

})(jQuery);