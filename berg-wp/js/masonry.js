// masonry template js script
(function($) {
	'use strict';

	var mobile = jQuery.browser.mobile;
	
	var blogMasonry = {
		loadStatus: true,
		init: function() {

			var that = this,
				masonry_container = $('.blog-masonry');

			// if ( mobile || $('.load-more-masonry').parent().is(':visible') ) {

			$('.load-more-masonry').on('click', function(e){
				e.preventDefault();

				var nextPage = parseInt(masonry_container.find('.load-page-counter').data('next-page')),
					layoutIndex = parseInt(masonry_container.find('.load-page-counter').data('next-layout')),
					maxPages = parseInt($(this).data('max-pages'));

				that.loadMore(nextPage, layoutIndex, maxPages);
			});
			
			if ( !mobile  && $('.load-more-masonry').hasClass('visible-xs-alt')) {

				$(window).scroll(function(){
					if ( that.checkIsSiteBottom() ) {
						var nextPage = parseInt(masonry_container.find('.load-page-counter').data('next-page')),
							layoutIndex = parseInt(masonry_container.find('.load-page-counter').data('next-layout')),
							maxPages = parseInt($('.load-more-masonry').data('max-pages'));

						that.loadMore(nextPage, layoutIndex, maxPages);
						
					}
				});

			}

		},
		checkIsSiteBottom: function() {
			return ( $(window).scrollTop() + $(window).height() === $(document).height() );
		},

		loadMore: function(nextPage,layoutIndex, maxPages) {
			$(window).resize();

			var that = this;

			if ( that.loadStatus === true ) {
				that.loadStatus = false;
				$('.js-loading').velocity('fadeIn');
				$('.load-more-masonry').velocity({opacity: 0}, 200, function(){});

				jQuery.ajax({
					url: masonryOptions.ajaxurl,
					type: 'POST',
					cache: false,
					dataType: 'html',
					data: { action: 'load-masonry', page: nextPage, layout: layoutIndex, postsPerPage: masonryOptions.postsPerPage, categories: masonryOptions.masonryCategories, customLayout: masonryOptions.customLayout}
				}).done(function(response) {
					$('.blog-masonry-layout').find('.load-page-counter').remove();
					if ( nextPage >= maxPages ) {
						$('.load-more-masonry').parent().delay(400).velocity('slideUp',function(){
							$('.load-more-masonry').parent().remove();
						})
					}
					setTimeout(function(){
						that.add(response);
					}, 200)

				});

				return true;
			}

			return false;


		},
		add: function(response) {
			$('.blog-masonry-layout .hidden-content').html(response);


			var items = $('.blog-masonry-layout .hidden-content article').css('display', 'none').addClass('new-element'),
				pageControl = $('.blog-masonry-layout .load-page-counter'),
				that = this;
			
			$.each(items, function(){
				$(this).css('display', 'none').addClass('new-element');
			});

			$('.blog-masonry-layout .hidden-content').waitForImages(function() {
				$('.js-loading').velocity('fadeOut');
				setTimeout(function(){
					$('.blog-masonry-layout').isotope('insert', items).isotope('layout').append(pageControl);
					$('.load-more-masonry').delay(400).velocity('fadeIn', { duration: 200, display: 'inline-block', complete: function(){
						$('.blog-masonry-layout .new-element').removeClass('new-element');
					}});
					that.loadStatus = true;
				},300);

			});
			
			return true;
		}

	};

	if ( $('#masonry-template').length > 0 ) {
		blogMasonry.init();
	}

})(jQuery);
