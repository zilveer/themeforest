(function($, undefined) {
	"use strict";

	var mobileSafari = (/iPad|iPod|iPhone/i).test(navigator.userAgent);

	$(function() {
		// Load More Buttons
		// ---------------------------------------------------------------------
		$("body").on("click.pagination", ".load-more", function() {

			if(mobileSafari)
				return true;

			var url = $("a.lm-btn", this).attr("href");
			if (!url) {
				return true;
			}

			// Skip if alredy started
			if ($(this).is(":animated")) {
				return false;
			}

			var $currentLink = $(this);
			var $currentList = $currentLink.prev();

			var containerSelector = $currentList.is("section.portfolios > ul") ?
				"section.portfolios > ul" :
					$currentList.is(".loop-wrapper") ?
						".loop-wrapper.paginated" :
						null;

			if (containerSelector) {
				// Start loading indicator
				$(this).addClass("loading").find("> *").animate({opacity: 0});

				$.ajax({
					url      : url,
					dataType : "text",
					data     : { reduced : 1 },
					cache    : false,
					// headers  : { "X-Vamtam" : "reduced-response" },
					success  : function(html) {

						html = $($.parseHTML(html, document, true));
						var article = html.find('article');

						var newContainer = $(containerSelector, article);
						if (newContainer.length) {

							// Append the new items as transparent ones
							var newItems = newContainer.children().css("opacity", 0);

							window.newitems = newItems;
							try {
								$currentList.append(newItems);
							} catch(e) {
								if('log' in window.console)
									console.log("can't append these properly: ", newItems, e);
							}

							if($currentList.hasClass('masonry')) {
								newItems.removeClass('clearboth');
								$currentList.trigger('reload-isotope');
							}

							/*
								$("script", $currentList).each(function(i, o) {
									$.globalEval($(o).text());
								}).remove();
							*/

							$currentList.trigger("rawContent", newItems.get());

							if(! ('mediaelementplayer' in jQuery.fn) ) {
								html.filter('#mediaelement-css, #wp-mediaelement-css').appendTo($('head'));
								html.filter('script').each(function(i, o) {
									if($(o).prop('src').match('mediaelement-and-player')) {
										jQuery.getScript($(o).prop('src'), function() {
											$('.wp-audio-shortcode, .wp-video-shortcode').mediaelementplayer();
										});
									}
								});
							} else {
								$('.wp-audio-shortcode, .wp-video-shortcode').not('.mejs-container').mediaelementplayer();
							}

							// Get the final height
							var endHeight = $currentList.height();

							// Expand the container
							if($currentList.is(':not(.masonry)')) {
								$currentList.height(endHeight);
								$currentList.css("height", "auto");
								$currentList.children().animate({opacity: 1}, 1000);
							}

							var newPager = $(".load-more", article);

							if (newPager.length) {
								$currentLink
									.html(newPager.html())
									.removeClass("loading")
									.find("> *").animate({opacity: 1}, 600, "linear");
							}
							else {
								$currentLink.slideUp().remove();
							}
							$(window).trigger("resize").trigger("scroll");
							article = newContainer = endHeight = newPager = null;
						}
					}
				});
			}
			return false;
		});

		//infinite scrolling
		if($('body').is('.pagination-infinite-scrolling')) {
			var last_auto_load = 0;
			$(window).bind('resize scroll', function(e) {
				var button = $('.lm-btn'),
					now_time = e.timeStamp || (new Date()).getTime();

				if(now_time - last_auto_load > 500 && parseFloat(button.css('opacity'), 10) === 1 && $(window).scrollTop() + $(window).height() >= button.offset().top) {
					last_auto_load = now_time;
					button.click();
				}
			});
		}
	});
})(jQuery);