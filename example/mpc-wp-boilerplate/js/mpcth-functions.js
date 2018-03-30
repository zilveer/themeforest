jQuery(document).ready(function($) {

/*-----------------------------------------------------------------------------------*/
/*	Menu
/*-----------------------------------------------------------------------------------*/

	// add custom classes to the menu
	$('.menu > li:first-child').addClass('first-item');
	$('.menu > li:last-child').addClass('last-item');

	$('.sub-menu li:first-child').addClass('first-item');
	$('.sub-menu li:last-child').addClass('last-item');

	$("ul.sub-menu").parents().addClass('parent_menu_item');

	// Header menu item with drop down hover
	$("#mpcth_aside_menu_section .menu li").hover(function() {
		var $this = $(this).find('> ul');

		if($this.length) {
			var offset = $(this).offset().top,
				menuHeight = $this.height(),
				winHeight = $(window).height();

			if(winHeight - offset < menuHeight) {
				var itemHeight = parseInt($this.find('> li > a').css('line-height'));

				if(menuHeight > winHeight) {
					var height = Math.floor(winHeight / itemHeight) * itemHeight - itemHeight;

					$this.height(height);
					menuHeight = height;

					$this.css({'overflow-y': 'scroll', '-ms-overflow-y': 'scroll'});
				}

				var overlap = (offset + menuHeight) - winHeight,
					ratio = Math.ceil(overlap / itemHeight);

				$this.css({
					top			: - ratio * itemHeight,
					visibility	: "visible"
				})
			}

			$this.css({
				visibility	: "visible"
			}).stop(true, true).delay(300).slideDown(300);
		}
	}, function() {
		$(this).find('ul:first').stop(true, true).slideUp(100, function() {
			// $(this).find(' > li > a ').css({
			// 	'line-height' : ''
			// });
		});
	});

	$(window).load(function() {
		$("aside ul.sub-menu").slideUp(0);
		$("#mpcth_menu").css('overflow', 'visible');
	});

/*-----------------------------------------------------------------------------------*/
/*	Footer
/*-----------------------------------------------------------------------------------*/

	var footerRows = $('#mpcth_footer_content > ul > li:first-child').attr('data-row');
	if(footerRows != null) {
		$('#mpcth_footer_content > ul > li:nth-child(' + footerRows + 'n - ' + (footerRows - 1) + ')').addClass('first-item');
		$('#mpcth_footer_content > ul > li:nth-child(' + footerRows + 'n)').addClass('last-item');
	}

/*-----------------------------------------------------------------------------------*/
/*	Top Dropdown
/*-----------------------------------------------------------------------------------*/

	var dropdownRows = $('#mpcth_top_widget_area_content > ul > li:first-child').attr('data-row');
	if(dropdownRows != null) {
		$('#mpcth_top_widget_area_content > ul > li:nth-child(' + dropdownRows + 'n - ' + (dropdownRows - 1) + ')').addClass('first-item');
		$('#mpcth_top_widget_area_content > ul > li:nth-child(' + dropdownRows + 'n)').addClass('last-item');
	}

/* ---------------------------------------------------------------- */
/* Mediaelements
/* ---------------------------------------------------------------- */

	videoLoadTimeout = setTimeout(function() {
		$(window).trigger('MediaPlayerLoaded');
	}, 2000);

	$(window).on('MediaPlayerLoaded', function() {
		clearTimeout(videoLoadTimeout);

		$('.mejs-container').css('visibility', 'visible');
	})

	$('.mpcth-post-thumbnail .mpcth-video-container').parent().css('margin-bottom', 0);

/* ---------------------------------------------------------------- */
/* Flexslider
/* ---------------------------------------------------------------- */

	$(window).load(function() {
		$('.wpb_flexslider').each(function() {
			var this_element = $(this);
			var sliderSpeed = 800,
				sliderTimeout = parseInt(this_element.attr('data-interval'))*1000,
				sliderFx = this_element.attr('data-flex_fx'),
				slideshow = true;
			if ( sliderTimeout == 0 ) slideshow = false;

			this_element.flexslider({
				animation: sliderFx,
				slideshow: slideshow,
				slideshowSpeed: sliderTimeout,
				sliderSpeed: sliderSpeed,
				smoothHeight: true
			});
		});
	})

/* ---------------------------------------------------------------- */
/* Top Widget Area
/* ---------------------------------------------------------------- */

	var $top_widget_content = $('#mpcth_top_widget_area_content');
	var $top_widget_content_widgets = $('#mpcth_top_widget_area_content > ul');

	$('#mpcth_top_widget_area_handle').on('click', function() {
		if($top_widget_content.hasClass('mpcth-top-widget-hidden')) {
			$top_widget_content.removeClass('mpcth-top-widget-hidden');
			$top_widget_content_widgets.slideDown();
		} else {
			$top_widget_content.addClass('mpcth-top-widget-hidden');
			$top_widget_content_widgets.slideUp();
		}
	})

/* ---------------------------------------------------------------- */
/* Content Toggler
/* ---------------------------------------------------------------- */

	$('#mpcth_content_toggler').one('click', 'a', contentToggler);

	function contentToggler(e) {
		e.preventDefault();

		var $this = $(this),
			$content = $('#mpcth_page_container');

		if($this.is('#mpcth_content_toggler_show')) {
			$this.next().show();
			$this.hide();
			$this.parent().removeClass('mpcth-toggler-hidden');
			$content.fadeIn(300, function() {
				$('#mpcth_content_toggler').one('click', 'a', contentToggler);
			});
		} else {
			$this.prev().show();
			$this.hide();
			$this.parent().addClass('mpcth-toggler-hidden');
			$content.fadeOut(300, function() {
				$('#mpcth_content_toggler').one('click', 'a', contentToggler);
			});
		}
	}

/* ---------------------------------------------------------------- */
/*	Resize Window
/* ---------------------------------------------------------------- */

	var admin_bar = $('body').is('.admin-bar') ? 28 : 0,
		$window = $(window),
		$container = $('#mpcth_page_container'),
		$menu = $('#mpcth_aside_menu_section'),
		windowW = $window .width();

	if(windowW > 967){
		$container.height($window .height() - admin_bar);
		$menu.height($window .height() - admin_bar);
		$('.mpcth-filterable-categories').css('bottom', $('#mpcth_bottom_footer').height());
	}

	$window .resize(function(){
		windowW = $window .width();

		if(windowW > 967){
			$container.height($window .height() - admin_bar);
			$menu.height($window .height() - admin_bar);
		} else {
			$container.height('auto');
			$menu.height('auto');
		}
	});

/* ---------------------------------------------------------------- */
/* Max Width
/* ---------------------------------------------------------------- */

	var $window = $(window),
		$wrap = $('#mpcth_page_articles'),
		$load_more = $('#mpcth_lm'),
		$info = $('#mpcth-archive-header-info'),
		$cat = $('.mpcth-filterable-categories');
		$sidebar = $('#mpcth_sidebar');

	$window.on('resize', max_width);

	function max_width() {
		if($window.width() <= 768) {
			$wrap.width($window.width());
			$load_more.width($window.width());
			$info.width($window.width());
			$cat.width($window.width());
			$sidebar.width($window.width());
		} else {
			$wrap.width('auto');
			$load_more.width('auto');
			$info.width('auto');
			$cat.width('');
			$sidebar.width('');
		}
	}

	max_width();

/* ---------------------------------------------------------------- */
/* Visual Composer fixes
/* ---------------------------------------------------------------- */

	if (typeof $.fn.waypoint !== 'undefined') {
		$('.vc_progress_bar').waypoint(function() {
			$(this).find('.vc_single_bar').each(function(index) {
			var $this = $(this),
				bar = $this.find('.vc_bar'),
				val = bar.data('percentage-value');

				setTimeout(function(){ bar.css({"width" : val+'%'}); }, index*200);
			});
		}, {
			offset: '85%',
			context: '#mpcth_page_container'
		});

		$('.wpb_animate_when_almost_visible').waypoint(function() {
			$(this).addClass('wpb_start_animation');
		}, {
			offset: '85%',
			context: '#mpcth_page_container'
		});
	}

/* ---------------------------------------------------------------- */
/* Twitter Widget
/* ---------------------------------------------------------------- */

	var $twitterWidgets = $('.mpcth-twitter-wrap');

	$twitterWidgets.each(function() {
		var $this = $(this);

		if(!$this.is('.mpcth-twitter-cached')) {
			var unique = $this.attr('data-unique'),
				id = $this.attr('data-id'),
				number = $this.attr('data-number'),
				src = document.createElement('script');

			mpcthFetcher['callback_' + unique] = function(data) {
				var $body = $('<div>').html(data.body),
					$tweets = $body.find('.stream .h-feed .tweet').slice(0, number);

				$tweets.each(function() {
					var $tweet = $(this),
						$time = $tweet.find('a.permalink'),
						$author = $tweet.find('div.header'),
						$content = $tweet.find('div.e-entry-content'),
						$detail = $tweet.find('div.detail-expander'),
						$footer = $tweet.find('div.footer');

					$tweet.append($time);

					$detail.remove();

					$footer.remove();

					$author.find('span.verified').remove();
				})

				$tweets.last().addClass('last');

				$('#mpcth_twitter_' + unique).append($tweets);

				$.post(ajaxurl, {
					action: 'cache_twitter',
					tweets: encodeURIComponent($('#mpcth_twitter_' + unique).html()),
					id: id,
					number: number
				});
			}

			src.type = 'text/javascript';
			src.src = '//cdn.syndication.twimg.com/widgets/timelines/' + id + '?&lang=en&callback=mpcthFetcher.callback_' + unique + '&suppress_response_codes=true';
			document.getElementsByTagName('head')[0].appendChild(src);
		}
	});
});

var mpcthFetcher = {};

jQuery(window).load(function() {
	var $ = jQuery;

/* ---------------------------------------------------------------- */
/*	Recent Posts Widget
/* ---------------------------------------------------------------- */

	var $recent_posts = $('.mpcth-recent-posts-widget');

	if($recent_posts.length) {
		$('.widget .attachment-post-thumbnail').each(function() {
			var $img = $(this),
				ratio = 60 / $img.attr('width'),
				width = Math.round($img.attr('width') * ratio),
				height = Math.round($img.attr('height') * ratio);

			if(height > 45) {
				$img.css('margin-top', (height - 45) / -2);
			} else {
				$img.addClass('mpcth-image-vertical');
				$img.css('margin-left', (width - 60) / -2);
			}
		})
	}
});