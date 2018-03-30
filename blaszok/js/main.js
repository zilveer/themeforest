if (!window.console) console = {log: function() {}};

jQuery(document).ready(function($) {
	var $window = $(window),
		$body = $('body'),
		is_admin_bar_enabled = $('#wpadminbar').length,
		is_touch = 'ontouchstart' in window,
		is_push_state = typeof history.pushState === "function" ? true : false,
		is_rtl = $body.hasClass('rtl');

/* ---------------------------------------------------------------- */
/* Smart resize
/* ---------------------------------------------------------------- */
	var resize_timer;

	$window.on('resize', function(e) {
		clearTimeout(resize_timer);
		resize_timer = setTimeout(function() {
			$window.trigger('smart_resize');
		}, 250);
	});

	$window.on('load', function() {
		$window.trigger('resize');
	});

/* ---------------------------------------------------------------- */
/* Search
/* ---------------------------------------------------------------- */
	var $search_toggle = $('#mpcth_search'),
		$search_wrap = $('#mpcth_smart_search_wrap'),
		$search_box = $('#mpcth_mini_search');

	$search_toggle.on('click', function(e) {
		$search_toggle.toggleClass('active');

		if ($search_toggle.is('.active')) {
			$search_wrap.slideDown();
			// $search_box.fadeIn();
			$search_box.addClass('active');

			$search_toggle.on('mousedown', catch_search_wrap_mousedown);
			$search_wrap.on('mousedown', catch_search_wrap_mousedown);
			$search_box.on('mousedown', catch_search_wrap_mousedown);
			$window.one('mousedown', close_smart_search);
		} else {
			$search_wrap.stop(true).slideUp();
			// $search_box.stop(true).fadeOut();
			$search_box.removeClass('active');

			$search_toggle.off('mousedown', catch_search_wrap_mousedown);
			$search_wrap.off('mousedown', catch_search_wrap_mousedown);
			$search_box.off('mousedown', catch_search_wrap_mousedown);
			$window.off('mousedown', close_smart_search);
		}

		e.preventDefault();
	});

	function catch_search_wrap_mousedown(e) {
		e.stopPropagation();
	}
	function close_smart_search() {
		$search_toggle.off('mousedown', catch_search_wrap_mousedown);
		$search_wrap.off('mousedown', catch_search_wrap_mousedown);
		$search_box.off('mousedown', catch_search_wrap_mousedown);
		$search_toggle.trigger('click');
	}

	/* Smart search */
	var $search_category = $('#mpcth_smart_search_wrap .mpc-w-smart-search-filter-category'),
		$search_form = $('#mpcth_smart_search_wrap #searchform'),
		$search_prices = $('#mpcth_smart_search_wrap .mpc-w-smart-search-filter-price'),
		$search_fields = $('#mpcth_smart_search'),
		$search_field = $('#mpcth_smart_search_wrap #s'),
		$search_button = $('#mpcth_smart_search_wrap #searchsubmit');

	var search_currency = $('#mpcth_currency_symbol').val(),
		search_currency_position = $('#mpcth_currency_symbol').attr('data-position');

	// $search_category.on('change', function() {
	// 	$search_form.attr('action', $search_category.val());
	// });

	$search_button.on('click', function() {
		if ($search_field.val() == '') {
			var $min_price = $search_prices.filter('[name=min_price]');
			var $max_price = $search_prices.filter('[name=max_price]');

			if ($min_price.val() == '')
				$min_price.val(0);

			if ($max_price.val() == '')
				if ($max_price.next('.mpc-w-smart-search-filter-price-max').length)
					$max_price.val($max_price.next('.mpc-w-smart-search-filter-price-max').val());
				else
					$max_price.val(9999999);

			$search_fields.find('select, input').each(function() {
				var $this = $(this);

				if ($this.val() == '')
					$this.attr('name', '');
			});

			$search_prices.each(function() {
				var $this = $(this);

				$this.val($this.val().replace(search_currency, ''));
			});

			$search_field.attr('name', '');
		} else {
			$search_fields.find('select, input:not(#s)').attr('name', '');
		}
	});

	$search_prices.on('focus', function() {
		var $this = $(this);

		$this.val($this.val().replace(search_currency, ''));
	});
	$search_prices.on('blur', function() {
		var $this = $(this);

		if ($this.val().length > 0)
			if (search_currency_position == 'right' || search_currency_position == 'right_space')
				$this.val($this.val() + search_currency);
			else
				$this.val(search_currency + $this.val());
	});

/* ---------------------------------------------------------------- */
/* Header setup
/* ---------------------------------------------------------------- */
	var $logo = $('#mpcth_logo'),
		$header_container = $('#mpcth_page_header_container'),
		$header_menu = $('#mpcth_nav');

	if ( $logo.children('img').length ) {
		var $logo_image = $logo.children('img').last(),
			$temp_image = $('<img>');

		$temp_image.on('load', function() {
			setup_sticky();
		}).attr('src', $logo_image.attr('src'));
	} else {
		setup_sticky();
	}

/* ---------------------------------------------------------------- */
/* Sticky header
/* ---------------------------------------------------------------- */
	function setup_sticky() {
		var $sticky_header = $('#mpcth_page_header_wrap'),
			$sticky_header_spacer = $('#mpcth_page_header_wrap_spacer'),
			$mobile_menu = $('#mpcth_simple_mobile_nav_wrap');

		var is_transparent = $('#mpcth_page_wrap').is('.mpcth-transparent-header');

		var is_mobile_sticky_header = $sticky_header.is('.mpcth-mobile-sticky-header-enabled');

		if ($sticky_header.is('.mpcth-sticky-header-enabled')) {
			$sticky_header_spacer.waypoint({
				handler: function(direction) {
					if ($window.width() > 979 || is_mobile_sticky_header) {
						var height = $header_container.height();

						if (direction == 'up') {
							$sticky_header.stop(true, true).animate({top: -height}, 200, function() {
								$sticky_header_spacer.height(0);
								$sticky_header.css('top', is_admin_bar_enabled && is_transparent ? 32 : 0).removeClass('mpcth-sticky-header');
								center_menu_dropdowns();
							});
						} else {
							$sticky_header_spacer.height(height);
							$sticky_header.addClass('mpcth-sticky-header').css('top', -height).animate({top: is_admin_bar_enabled ? 32 : 0}, 700, function() {
								center_menu_dropdowns();
							});

							if (is_mobile_sticky_header) {
								$mobile_menu.css('max-height', $window.height() - height);
							}
						}
					}
				},
				offset: '-' + $sticky_header.data('offset')
			});

			if (is_mobile_sticky_header) {
				$window.on('smart_resize', function() {
					$mobile_menu.css('max-height', $window.height() - $header_container.height());
				});

				$mobile_menu.css('max-height', $window.height() - $header_container.height());
			}
		}

		$header_container.addClass('mpcth-header-ready');
	}

/* ---------------------------------------------------------------- */
/* Back to top
/* ---------------------------------------------------------------- */
	var $back_to_top = $('#mpcth_back_to_top'),
		$page_top = $('#mpcth_page_header_wrap_spacer');;

	if ($back_to_top.length > 0) {
		$back_to_top.on('click', function(e) {
			$('html, body').animate({scrollTop: 0});
			$back_to_top.removeClass('active');

			e.preventDefault();
		});

		$page_top.waypoint({
			handler: function(direction) {
				if (direction == 'up')
					$back_to_top.removeClass('active');
				else
					$back_to_top.addClass('active');
			},
			offset: '-25%'
		});
	}

/* ---------------------------------------------------------------- */
/* Mega menu
/* ---------------------------------------------------------------- */
	var $mega_menu = $('#mpcth_mega_menu');

	$window.on('load', function() {
		$mega_menu.find('.menu-item').off('mouseover');

		$mega_menu.find('.mega-hdr-a').each(function() {
			var $this = $(this),
				text = $this.html();

			$this.html('<span class="mpcth-color-main-border">' + text + '</span>');
		});
	});

/* ---------------------------------------------------------------- */
/* Menu center dropdowns
/* ---------------------------------------------------------------- */
	var $main_menu = $('#mpcth_nav'),
		menu_checker;

	$main_menu.find('.mpcth-menu > ul > .page_item > .children, .mpcth-menu > .menu-item > .sub-menu').each(function() {
		var $this = $(this);

		$this.css(is_rtl ? 'right' : 'left', $this.width() * -.5);
	});

	if ($mega_menu.length) {
		menu_checker = setInterval(center_menu_dropdowns, 50);
	}

	$window.on('load', function() {
		center_menu_dropdowns();
	});

	$window.on('smart_resize', function() {
		center_menu_dropdowns();
	});

	function center_menu_dropdowns() {
		if ($main_menu.find('.sub-container').length) {
			var window_width = $window.width();

			$main_menu.find('.sub-container').each(function() {
				var $this = $(this),
					$parent = $this.parent(),
					center = $parent.offset().left + $parent.width() * .5,
					move = $this.width() * .5;

				$this.css('left', -move);

				if (center + move > window_width)
					$this.css('left', -move + (window_width - (center + move)));

				if (center - move < 0)
					$this.css('left', -move + (move - center));
			});

			if ($('html').is('.ie'))
				$mega_menu.find('.row').each(function() {
					var $this = $(this);

					if (! $this.is('.extended')) {
						$this.width($this.width() + 10);
						$this.addClass('extended');
					}
				});

			clearInterval(menu_checker);
		} else {
			clearInterval(menu_checker);
		}
	}

/* ---------------------------------------------------------------- */
/* Menu touch hover
/* ---------------------------------------------------------------- */
    if (is_touch) {
        var $menu_items = $('#mpcth_secondary_mini_menu .menu-item-has-children, #mpcth_nav .menu-item-has-children');
        $('body').on('click', function () {
            $menu_items.removeClass('mpc-active');
        });
        $menu_items.children('a').on('click', function(e) {
            if (! $(this).parent().is('.mpc-active')) {
                $menu_items.removeClass('mpc-active');
                $(this).parents('.menu-item-has-children').addClass('mpc-active');

                e.preventDefault();
            }

            e.stopImmediatePropagation();
        });
    }

/* ---------------------------------------------------------------- */
/* Menu nav fixed width
/* ---------------------------------------------------------------- */
	if ($('#mpcth_page_header_content').is('.mpcth-header-order-m_s_l')) {
		$main_menu.width($main_menu.children().width());

		$window.on('smart_resize', function() {
			$main_menu.width($main_menu.children().width());
		});
	}

/* ---------------------------------------------------------------- */
/* Header Widget Area
/* ---------------------------------------------------------------- */
	var $header_area_toggle = $('#mpcth_toggle_header_area'),
		$header_area_wrap = $('#mpcth_header_area_wrap');
		$header_area = $('#mpcth_header_area');

	$header_area_toggle.on('click', function(e) {
		$header_area_toggle.toggleClass('active');
		$header_area_wrap.toggleClass('active');

		if ($header_area_toggle.is('.active'))
			$header_area.slideDown();
		else
			$header_area.stop(true, true).slideUp();

		e.preventDefault();
	});

	$window.on('smart_resize', function() {
		if ($window.width() < 801) {
			$header_area_toggle.removeClass('active');
			$header_area_wrap.removeClass('active');
			$header_area.css('display', '');
		}
	});

/* ---------------------------------------------------------------- */
/* Mobile footer
/* ---------------------------------------------------------------- */
	var $mobile_footer_toggle = $('#mpcth_toggle_mobile_footer'),
		$mobile_footer_wrap = $('#mpcth_footer_content');

	$mobile_footer_toggle.on('click', function(e) {
		$mobile_footer_toggle.toggleClass('active');

		if ($mobile_footer_toggle.is('.active'))
			$mobile_footer_wrap.slideDown();
		else
			$mobile_footer_wrap.stop(true, true).slideUp();

		e.preventDefault();
	});

	$window.on('smart_resize', function() {
		if ($window.width() > 480) {
			$mobile_footer_toggle.removeClass('active');
			$mobile_footer_wrap.css('display', '');
		}
	});

/* ---------------------------------------------------------------- */
/* Mobile extended footer
/* ---------------------------------------------------------------- */
	var $mobile_extended_footer_toggle = $('#mpcth_toggle_mobile_extended_footer'),
		$mobile_extended_footer_wrap = $('#mpcth_footer_extended_content');

	$mobile_extended_footer_toggle.on('click', function(e) {
		$mobile_extended_footer_toggle.toggleClass('active');

		if ($mobile_extended_footer_toggle.is('.active'))
			$mobile_extended_footer_wrap.slideDown();
		else
			$mobile_extended_footer_wrap.stop(true, true).slideUp();

		e.preventDefault();
	});

	$window.on('smart_resize', function() {
		if ($window.width() > 480) {
			$mobile_extended_footer_toggle.removeClass('active');
			$mobile_extended_footer_wrap.css('display', '');
		}
	});

/* ---------------------------------------------------------------- */
/* Mobile sidebar
/* ---------------------------------------------------------------- */
	var $mobile_sidebar_toggle = $('#mpcth_toggle_mobile_sidebar'),
		$mobile_sidebar_wrap = $('#mpcth_sidebar');

	$mobile_sidebar_toggle.on('click', function(e) {
		$mobile_sidebar_toggle.toggleClass('active');
		$mobile_sidebar_wrap.toggleClass('active');

		e.preventDefault();
	});

	$window.on('smart_resize', function() {
		if ($window.width() > 979) {
			$mobile_sidebar_toggle.removeClass('active');
			$mobile_sidebar_wrap.removeClass('active');
		}
	});

/* ---------------------------------------------------------------- */
/* Mobile side menu
/* ---------------------------------------------------------------- */
	var $mobile_menu_toggle = $('#mpcth_toggle_mobile_menu'),
		$mobile_menu_wrap = $('#mpcth_mobile_nav_wrap');

	$mobile_menu_toggle.on('click', function(e) {
		$mobile_menu_toggle.toggleClass('active');
		$mobile_menu_wrap.toggleClass('active');

		e.preventDefault();
	});

	$window.on('smart_resize', function() {
		if ($window.width() > 979) {
			$mobile_menu_toggle.removeClass('active');
			$mobile_menu_wrap.removeClass('active');
		}
	});

/* ---------------------------------------------------------------- */
/* Mobile simple menu
/* ---------------------------------------------------------------- */
	var $simple_mobile_menu_toggle = $('#mpcth_simple_menu'),
		$simple_mobile_menu_wrap = $('#mpcth_simple_mobile_nav_wrap');

	$simple_mobile_menu_toggle.on('click', function(e) {
		$simple_mobile_menu_toggle.toggleClass('active');

		if ($simple_mobile_menu_toggle.is('.active')) {
			$simple_mobile_menu_wrap.slideDown();
		} else {
			$simple_mobile_menu_wrap.stop(true).animate({'scrollTop': 0}, 200, function() {
				$simple_mobile_menu_wrap.slideUp();
			});
		}

		e.preventDefault();
	});

/* ---------------------------------------------------------------- */
/* Mobile swap secondary header
/* ---------------------------------------------------------------- */
	var $secondary_header = $('#mpcth_page_header_secondary_content');
	var $secondary_header_container = $('#mpcth_header_second_section .mpcth-header-wrap');
	var mobile = false;

	function swap_menu() {
		if ($window.width() > 979) {
			if (mobile) {
				mobile = false;
				$secondary_header_container.prepend($secondary_header);
			}
		} else {
			if (! mobile) {
				mobile = true;
				$mobile_menu_wrap.prepend($secondary_header);
				$simple_mobile_menu_wrap.prepend($secondary_header);
			}
		}
	}

	$window.on('smart_resize', swap_menu);
	swap_menu();

/* ---------------------------------------------------------------- */
/* Lightbox
/* ---------------------------------------------------------------- */
	init_lightbox($('#mpcth_content'));

	function init_lightbox($target) {
		$target.find('.mpcth-lightbox, .mpc-sc-lightbox').magnificPopup({
			type: 'image',
			// key: 'mpcth-popup',
			removalDelay: 300,
			mainClass: 'mfp-fade mpcth-popup',
			image: {
				verticalFit: true
			},
			gallery: {
				enabled: true
			}
		});

		$target.find('.mpcth-alt-lightbox').magnificPopup({
			type: 'image',
			// key: 'mpcth-alt-popup',
			removalDelay: 300,
			mainClass: 'mfp-fade mpcth-alt-popup',
			image: {
				verticalFit: true
			},
			gallery: {
				enabled: false
			}
		});
	}

/* ---------------------------------------------------------------- */
/* Portfolio filters & sorts
/* ---------------------------------------------------------------- */
	var $portfolio_wrap = $('.page-template-template-portfolio-php #mpcth_content'),
		mixitup_settings = {
			targetSelector: '.mpcth-post',
			filterSelector: '.mpcth-portfolio-filter',
			sortSelector: '.mpcth-portfolio-sort',
			effects: ['fade'],
			easing: 'snap',
			perspectiveDistance: '0'
		};

	$portfolio_wrap.mixitup(mixitup_settings);

	var $portfolio_filters_and_sorts = $('#mpcth_portfolio_filters, #mpcth_portfolio_sorts');

	$portfolio_filters_and_sorts.on('click', 'li', function() {
		$portfolio_filters_and_sorts.children().removeClass('active');
		$(this).addClass('active');
	});

	var $portfolio_mobile_filters_and_sorts = $portfolio_filters_and_sorts.children('select');

	$portfolio_mobile_filters_and_sorts.on('change', function() {
		var $this = $(this);

		$this.siblings('ul').find('li').filter('[data-filter=' + $this.val() + '], [data-sort=' +  $this.val() + ']').click();
	});

/* ---------------------------------------------------------------- */
/* FAQ
/* ---------------------------------------------------------------- */
	$( '.wpb_toggle_content' ).each(function() {
		if( !$( this ).is( '.wpb_toggle_open' ) ) {
			$( this ).slideUp();
		}

		$( this ).after( '<div class="last_toggle_el_margin"></div>' );
	} );

	$( '.wpb_toggle' ).on( 'click', function() {
		$( this ).toggleClass( 'wpb_toggle_title_active' );
		$( this ).next( '.wpb_toggle_content' ).slideToggle();
	} );
/* ---------------------------------------------------------------- */
/* Counter
/* ---------------------------------------------------------------- */
	$('.mpc-vc-counter').each(function() {
		$(this).on('mpc_waypoint', mpcth_count_up);
	});

	function mpcth_count_up() {
		var $this = $(this);

		if( $this.is('.active') ) return;

		var id = this.id,
			begin = $this.attr('data-begin'),
			end = $this.attr('data-end'),
			counter = new countUp(id, begin, end, 0, 2);

		setTimeout(function() {
			$this.addClass('active');
			counter.start();
		}, 500);
	}

/* ---------------------------------------------------------------- */
/* Countdown
/* ---------------------------------------------------------------- */
        $('.mpc-vc-countdown').each(function() {
            var end_time = $( this ).attr('data-end'),
                format = $( this ).attr('data-format'),
                layout = $( this ).attr('data-style');

            if( end_time !== '' && end_time !== undefined ) {
                var end = new Date( end_time * 1000 );

                $( this ).countdown({
                    until: end,
                    format: (format !== '' && format !== undefined) ? format : 'WDHMS',
                    layout: (layout !== '' && layout !== undefined) ? layout : ''
                });
            }
        });

/* ---------------------------------------------------------------- */
/* Parallax
/* ---------------------------------------------------------------- */
	$('.mpcth-vc-row-wrap-parallax').waypoint(function() {
		$(this).children('.mpcth-overlay-image').delay(1000).animate({'opacity': 1}, 500);
	}, { offset: '85%' });

/* ---------------------------------------------------------------- */
/* Waypoint
/* ---------------------------------------------------------------- */
	$('.mpcth-waypoint').waypoint(function() {
		$(this).addClass('mpcth-waypoint-triggered').trigger('mpc_waypoint');
	}, { offset: '85%' });

/* ---------------------------------------------------------------- */
/* One page scroll
/* ---------------------------------------------------------------- */
	// var $scroll_links = $('#mpcth_nav a[href^=#]'),
	var $scroll_links = $('#mpcth_page_wrap a[href^="#"]'),
		$rows = $('#mpcth_content .mpcth-page-content .mpcth-vc-row-wrap');

	$scroll_links = $scroll_links.filter(function() { return this.hash !== ''; });

	$scroll_links.on('click', function(e) {
		var id = this.hash,
			$row = $rows.filter(id);

		if ($row.length) {
			var destination_pos = $(id).offset().top - 44,
				current_pos = $window.scrollTop();

			$('html, body').animate({
				scrollTop: destination_pos
			}, Math.min(2000, Math.abs(destination_pos - current_pos) * .75));

			if(is_push_state) {
				history.pushState(null, null, window.location.href.split('#').shift() + id);
			} else {
				var $section = $(id);

				$section.attr('id', '');
				window.location.hash = id;
				$section.attr('id', id.substring(1));
			}

			e.preventDefault();
		}
	});

/* ---------------------------------------------------------------- */
/* iFrame resize
/* ---------------------------------------------------------------- */
	var $frame_container = $('#mpcth_main');
	iframe_check();

	function iframe_check() {
		var frame_count = $frame_container.find('iframe').length,
			frame_loaded = 0,
			frame_checker = setInterval(function() {
				frame_count = $frame_container.find('iframe').length;
				frame_loaded = 0;
				$frame_container.find('iframe').each(function() {
					if($(this).height() > 0)
						frame_loaded++;
				});
				if (frame_count == frame_loaded) {
					clearInterval(frame_checker);

					$window.trigger('iframe_loaded');
				}
			}, 500);
	}

/* ---------------------------------------------------------------- */
/* Masonry Blog
/* ---------------------------------------------------------------- */
	var $masonry_blog = $('#mpcth_content.mpcth-blog-layout-masonry');

	if ($masonry_blog.length) {
		$masonry_blog.imagesLoaded(function() {
			$masonry_blog.masonry({
				itemSelector: '.mpcth-post'
			});

			$masonry_blog.children('.mpcth-post').addClass('mpcth-post-fading').addClass('mpcth-post-added');
			setTimeout(function() {
				$masonry_blog.children('.mpcth-post').removeClass('mpcth-post-fading')
			}, 300);

			$window.on('flexslider-loaded', function() {
				$masonry_blog.masonry();
			});
		});

		function mpcth_masonry_layout_tweets() {
			$masonry_blog.find('.mpcth-post.format-status .mpcth-post-thumbnail').each(function() {
				var $tweet = $(this),
					height = 0;

				var refresh = setInterval(function() {
					var $status = $tweet.children('iframe.twitter-tweet');

					if (height != 0 && $status.height() == height) {
						$masonry_blog.masonry();
						$tweet.addClass('mpcth-loaded');

						clearInterval(refresh);
					}

					if ($status.height() != 0)
						height = $status.height();
				}, 500);
			});
		}
		mpcth_masonry_layout_tweets();
	}

/* ---------------------------------------------------------------- */
/* Load more
/* ---------------------------------------------------------------- */
	var $load_more = $('#mpcth_load_more'),
		$load_more_icon = $load_more.children('.mpcth-load-more-icon'),
		$load_more_pagination = $('#mpcth_pagination .page-numbers'),
		$load_more_target = $('#mpcth_content'),
		$load_more_container = $('#mpcth_load_more_wrapper'),
		is_blog_template = $body.is('.page-template-template-blog-php'),
		is_portfolio_template = $body.is('.page-template-template-portfolio-php');

	if($load_more.length) {
		var pages_current = $load_more_pagination.find('.page-numbers.current').text(),
			pages_total = $load_more_container.attr('data-max-pages'),
			pages_next_link = $load_more_pagination.find('.page-numbers.next').attr('href'),
			is_loading = false;
			// can_pushState = typeof history.pushState === "function" ? true : false;

		function ajax_load_more(e) {
			if (! is_loading) {
				is_loading = true;

				$load_more.addClass('active');

				$load_more_container.load(pages_next_link + ' #mpcth_content .mpcth-post', function() {
					var $loaded_posts = $load_more_container.children();

					$loaded_posts.appendTo($load_more_target);
					is_loading = false;

					$load_more.removeClass('active');

					$load_more.on('click', ajax_load_more);

					$load_more_target.imagesLoaded(function() {
						if (is_blog_template) {
							$masonry_blog.masonry('appended', $loaded_posts);
							$masonry_blog.children('.mpcth-post').addClass('mpcth-post-added');

							init_flexslider($loaded_posts);
							$loaded_posts.find('.twitter-tweet').after('<script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>');
							mpcth_masonry_layout_tweets();
						} else if (is_portfolio_template) {
							$portfolio_wrap.mixitup('remix', 'all');

							init_flexslider($loaded_posts);
						}
					});

					if(++pages_current < pages_total) {
						if(pages_next_link.indexOf('page/') != -1)
							pages_next_link = pages_next_link.replace(/page\/[0-9]+\//, 'page/' + (pages_current + 1) + '/');
						else
							pages_next_link = pages_next_link.replace(/paged=[0-9]+/, 'paged=' + (pages_current + 1));
					} else {
						$load_more.remove();
					}

					$window.trigger('loaded_more');
				});

			}

			e.preventDefault();
		}

		$load_more.on('click', ajax_load_more);
	}

/* ---------------------------------------------------------------- */
/* Flexslider
/* ---------------------------------------------------------------- */
	setTimeout( function() {
		init_flexslider($('#mpcth_content'));
	}, 200 );

	function init_flexslider($target) {
		$target.find('.flexslider:not(#main_slider, #main_thumbs, .mpcth-items-slider, .flexslider_fade, .flexslider_slide, .mpcth-main-slider, .mpcth-thumbs-slider)').flexslider({
			animation: 'slide',
			useCSS: false,
			slideshow: false,
			start: function() {
				$window.trigger('flexslider-loaded');
			}
		});

		$('.flex-direction-nav .flex-prev').addClass('fa fa-fw fa-angle-left');
		$('.flex-direction-nav .flex-next').addClass('fa fa-fw fa-angle-right');
	}

	$window.on('load', function() {
		$('.flex-direction-nav .flex-prev').addClass('fa fa-fw fa-angle-left');
		$('.flex-direction-nav .flex-next').addClass('fa fa-fw fa-angle-right');
	});

	$('#main_slider').flexslider({
		animation: 'slide',
		useCSS: false,
		controlNav: false,
		animationLoop: false,
		slideshow: false,
		sync: '#main_thumbs'
	});

	$('#main_thumbs').flexslider({
		animation: 'slide',
		useCSS: false,
		controlNav: false,
		animationLoop: false,
		slideshow: false,
		minItems: 3,
		maxItems: 4,
		itemWidth: 80,
		itemMargin: 20,
		asNavFor: '#main_slider'
	});

	$('.mpcth-items-slider.mpc-vc-blog-posts-slider').flexslider({
		animation: 'slide',
		useCSS: false,
		controlNav: false,
		animationLoop: true,
		slideshow: false,
		minItems: 1,
		maxItems: 2,
		itemWidth: 560,
		itemMargin: 40
	});

	$('.mpc-vc-gallery .mpcth-main-slider').each( function() {
		var $this = $( this );

		$this.flexslider({
			animation: 'slide',
			useCSS: false,
			controlNav: false,
			animationLoop: false,
			slideshow: false,
			sync: $this.parent().find('.mpcth-thumbs-slider')
		});
	});

	$('.mpc-vc-gallery .mpcth-thumbs-slider').each(function() {
		var $this = $( this );

		$this.flexslider({
			animation: 'slide',
			useCSS: false,
			controlNav: false,
			animationLoop: false,
			slideshow: false,
			minItems: 3,
			maxItems: 4,
			itemWidth: 80,
			itemMargin: 20,
			asNavFor: $this.parent().find('.mpcth-main-slider')
		});
	});

/* ---------------------------------------------------------------- */
/* CarouFredSel
/* ---------------------------------------------------------------- */
	var $carousels = $('.mpcth-items-slider-wrap');
	var carousel_defaults = {
		circular: true,
		infinite: true,
		responsive: true,
		width: '100%',
		height: 'variable',
		items: {
			visible: {
				min: 1,
				max: 4
			},
			width: 320,
			height: 'variable'
		},
		next: {
			button: ''
		},
		prev: {
			button: ''
		},
		scroll: {
			items: 1
		},
		auto: {
			play: false,
			timeoutDuration: 0,
			items: null
		}
	};

	$carousels.each(function() {
		var $this = $(this),
			$carousel = $this.find('.mpcth-items-slider'),
			$prev = $this.find('.mpcth-items-slider-prev'),
			$next = $this.find('.mpcth-items-slider-next');

		carousel_defaults.circular = true;
		carousel_defaults.infinite = true;
		carousel_defaults.items.visible.max = 4;
		carousel_defaults.items.width = 320;
		carousel_defaults.auto.play = false;
		carousel_defaults.auto.timeoutDuration = 0;
		carousel_defaults.auto.items = null;
		carousel_defaults.scroll.items = null;

		if ( $carousel.is('.mpc-vc-images-slider') ) {
			if ( $carousel.data('speed') != '' ) {
				carousel_defaults.auto.play = true;
				carousel_defaults.auto.timeoutDuration = parseInt( $carousel.data('speed') );
			}

			if ( $carousel.data('single') == '1' ) {
				carousel_defaults.auto.items = 1;
				carousel_defaults.scroll.items = 1;
			}

			if ( $carousel.data('loop') != '1' ) {
				carousel_defaults.circular = false;
				carousel_defaults.infinite = false;
			}
		}

		carousel_defaults.prev.button = $prev;
		carousel_defaults.next.button = $next;

		if ($carousel.is('.mpcth-items-slider-wide')) {
			carousel_defaults.items.visible.max = 2;
			carousel_defaults.items.width = 800;
		}

		if ($carousel.is('.mpc-vc-blog-posts-slider') && (! $carousel.parents('.wpb_column').first().is('.vc_span12, .vc_col-xs-12, .vc_col-sm-12, .vc_col-md-12, .vc_col-lg-12') || ! $body.is('.mpcth-sidebar-none'))) {
			carousel_defaults.items.visible.max = 1;
		}

		if ($carousel.attr('data-max-width') != '' && $carousel.attr('data-max-width') < 320) {
			var max_width = $carousel.attr('data-max-width');

			carousel_defaults.items.width = max_width;
			carousel_defaults.items.visible.max = Math.ceil($carousel.width() / max_width);
		}

		if( $carousel.is( '.mpc-vc-products-slider' ) ) {
			var _columns = parseInt( $carousel.attr( 'data-columns' ) ) ? parseInt( $carousel.attr( 'data-columns' ) ) : 4;
			carousel_defaults.items.width = 1260 / _columns;
			carousel_defaults.items.visible.max = Math.ceil( _columns );
		}

		$carousel.carouFredSel(carousel_defaults);

		$window.on('load', function() {
			$carousel.trigger('updateSizes');
		});
		$window.on('smart_resize', function() {
			$carousel.trigger('updateSizes');
		});
	});
	$carousels.swipe({
		excludedElements: "button, input, select, textarea, .noSwipe",
		swipeLeft: function() {
			$(this).children('.mpcth-items-slider-next').trigger('click');
		},
		swipeRight: function() {
			$(this).children('.mpcth-items-slider-prev').trigger('click');
		},
		tap: function(event, target) {
			if (is_touch) {
				var $target = $(target).closest('a');

				$target.trigger('click');

				if ($target.is('.mpcth-slide') || $target.is('.mpcth-post-thumbnail') || $target.parent().is('.mpcth-post-title') || $target.parent().is('.mpcth-post-categories') || ($target.is('.add_to_cart_button') && $target.attr('href').indexOf('add-to-cart=') == -1))
					window.open($target.attr('href'), '_self');
			}
		}
	});

/* ---------------------------------------------------------------- */
/* Nivoslider
/* ---------------------------------------------------------------- */
	$window.on('load', function() {
		$('.nivoSlider .nivo-prevNav').addClass('fa fa-fw fa-angle-left');
		$('.nivoSlider .nivo-nextNav').addClass('fa fa-fw fa-angle-right');
	});

/* ---------------------------------------------------------------- */
/* Lookbook badges
/* ---------------------------------------------------------------- */
        function mpcth_badge_size() {
            $('.mpcth-badge-circle').each( function() {
                var $this = $( this ),
					el_height  = $this.height(),
					el_width   = $this.width(),
					square_size = el_height > el_width ? el_height : el_width;

				$this.find('.mpcth-badge-content,.mpcth-badge-content-wrap').height( square_size ).width( square_size );

				$this.find('.mpcth-badge-content-wrap').css('transform', 'scale(0)');
            });

            $('.mpcth-badge-dropdown').each( function() {
                var $this = $( this ),
					content_width = $this.find('.mpcth-badge-content-wrap').width(),
					toggle_width = $this.find('.mpcth-badge-toggle-wrap').width(),
					width = content_width > toggle_width ? content_width : toggle_width;

				$this.find('.mpcth-badge-toggle-wrap,.mpcth-badge-content-wrap').width( width );
            });
        }

        $window.on('load', function() {
			setTimeout( function() {
				mpcth_badge_size();
			}, 250 );

			$('.mpcth-badge-circle .mpcth-badge-content-wrap').on('mouseleave', function(){
				var $badge_content = $( this ).parents('.mpcth-rev-badge').find('.mpcth-badge-content-wrap');

				$badge_content.removeClass('active');
			});
			$('.mpcth-badge-circle .mpcth-badge-toggle-wrap').on('mouseenter', function(){
				var $badge_content = $( this ).parents('.mpcth-rev-badge').find('.mpcth-badge-content-wrap');

				$badge_content.addClass('active');
			});

			$('.mpcth-rev-badge.mpcth-badge-dropdown').find('.mpcth-badge-toggle').on('click', function() {
				var $this = $( this ),
					$badge = $this.parents('.mpcth-rev-badge'),
					$badge_content = $badge.find('.mpcth-badge-content');

				if( $badge_content.hasClass('active') )
					$badge_content.removeClass('active');
				else
					$badge_content.addClass('active');
			});
        });

        //$window.on( 'smart_resize', mpcth_badge_size() );

/* ---------------------------------------------------------------- */
/* Newsletter
/* ---------------------------------------------------------------- */
	var $newsletter = $('#mpcth_newsletter');

	$newsletter.find('br').remove();
	$newsletter.find('input[name=subscribe]').wrap('<span class="mpcth-newsletter-subscribe">');

	$newsletter.on('click', '.mpcth-newsletter-toggle', function(e) {
		$newsletter.toggleClass('mpcth-toggled');
		e.preventDefault();
	});

/* ---------------------------------------------------------------- */
/* WooCommerce
/* ---------------------------------------------------------------- */
	/* Accordions */
	var $product_tabs = $('.woocommerce-tabs .tabs'),
		$product_accordions = $('.woocommerce-accordions > h6');

	$product_accordions.on('click', 'a', function(e) {
		$product_accordions.removeClass('active');
		$(this).parent().addClass('active');

		$product_tabs.find('[href="' + $(this).attr('href') + '"]').trigger('click');

		e.preventDefault();
	});

	/* Wrap quantity buttons */
	if ($body.is('.woocommerce-cart') || $body.is('.single-product')) {
		var $quantity = $('.cart .quantity');

		var checker = setInterval(function() {
			if ($quantity.is('.buttons_added')) {
				clearInterval(checker);

				$quantity.children('.plus').wrap('<span class="plus-wrap mpcth-color-main-background-hover">');
				$quantity.children('.minus').wrap('<span class="minus-wrap mpcth-color-main-background-hover">');
			}
		}, 50);
	}

	/* Update cart quantity inputs */
	if ($body.is('.woocommerce-cart') || $body.is('.woocommerce')) {
		$('.shop_table_wrap table.cart').on('click', '.plus, .minus', function() {
			var $button = $(this),
				$input = $button.parents('.quantity').find('.qty'),
				value = parseInt($input.val()) + ($button.is('.plus') ? 1 : -1);

			$('.shop_table_wrap .mpcth-mobile-cart').find('input[name="' + $input.attr('name') + '"]').val(value >= 0 ? value : 0);
		});

		$('.shop_table_wrap table.cart').on('change', '.qty', function() {
			var $button = $(this);

			$('.shop_table_wrap .mpcth-mobile-cart').find('input[name="' + $button.attr('name') + '"]').val( $button.val() );
		});
	}

	/* Sidebar height */
	$('.woocommerce-cart .shop_table_wrap').css('min-height', $('.woocommerce-cart .cart-sidebar').outerHeight() + 1);

	$window.on('smart_resize', function() {
		$('.woocommerce-cart .shop_table_wrap').css('min-height', $('.woocommerce-cart .cart-sidebar').outerHeight() + 1);
	});

	/* Display mini-cart */
	var $page_header = $('#mpcth_page_header_wrap'),
		$cart_toggle = $('#mpcth_cart'),
		$cart_wrap = $('#mpcth_mini_cart'),
		$cart_products = $cart_wrap.find('.mpcth-mini-cart-products');

	function catch_cart_wrap_mousedown(e) {
		e.stopPropagation();
	}
	function close_mini_cart() {
		$cart_toggle.off('mousedown', catch_cart_wrap_mousedown);
		$cart_wrap.off('mousedown', catch_cart_wrap_mousedown);
		$cart_toggle.trigger('click');
	}
	function resize_mini_cart(e) {
		shrink_mini_cart(e.data.defH);
	}
	function shrink_mini_cart(defH) {
		var window_height = $window.height(),
			header_height = $page_header.height(),
			cart_products_height = $cart_products.height(),
			cart_buttons_height = $cart_wrap.outerHeight() - cart_products_height;

		if (cart_products_height + cart_buttons_height + header_height > window_height) {
			$cart_products.height(window_height - cart_buttons_height - header_height).addClass('shrink');
		} else if (defH + header_height > window_height) {
			$cart_products.height(window_height - cart_buttons_height - header_height).addClass('shrink');
		} else {
			$cart_products.css('height', '').removeClass('shrink');
		}
	}

	$body.on('added_to_cart wc_fragments_refreshed', function() {
		$cart_products = $cart_wrap.find('.mpcth-mini-cart-products');
	});

	$cart_toggle.on('click', function(e) {
		$cart_toggle.toggleClass('open');

		if ($cart_toggle.is('.open')) {
			$cart_wrap.addClass('active');

			var defH = $cart_wrap.outerHeight();
			$window.on('resize', { defH: $cart_wrap.outerHeight() }, resize_mini_cart);
			shrink_mini_cart(defH);

			$cart_toggle.on('mousedown', catch_cart_wrap_mousedown);
			$cart_wrap.on('mousedown', catch_cart_wrap_mousedown);
			$window.one('mousedown', close_mini_cart);
		} else {
			$cart_wrap.removeClass('active');

			$window.off('resize', resize_mini_cart);
			$cart_products.css('height', '').removeClass('shrink');

			$cart_toggle.off('mousedown', catch_cart_wrap_mousedown);
			$cart_wrap.off('mousedown', catch_cart_wrap_mousedown);
			$window.off('mousedown', close_mini_cart);
		}

		e.preventDefault();
	});

	/* Remove product from mini-cart */
	var $mini_cart = $('#mpcth_mini_cart');

	/* Storage Handling */
	var $supports_html5_storage;
	try {
		$supports_html5_storage = ( 'sessionStorage' in window && window.sessionStorage !== null );

		window.sessionStorage.setItem( 'wc', 'test' );
		window.sessionStorage.removeItem( 'wc' );
	} catch( err ) {
		$supports_html5_storage = false;
	}

	if( typeof wc_cart_fragments_params !== 'undefined' ) {
		var $fragment_refresh = {
			url: wc_cart_fragments_params.wc_ajax_url.toString().replace( '%%endpoint%%', 'get_refreshed_fragments' ),
			type: 'POST',
			success: function( data ) {
				if ( data && data.fragments ) {

					$.each( data.fragments, function( key, value ) {
						$( key ).replaceWith( value );
					});

					if ( $supports_html5_storage ) {
						sessionStorage.setItem( wc_cart_fragments_params.fragment_name, JSON.stringify( data.fragments ) );
						sessionStorage.setItem( 'wc_cart_hash', data.cart_hash );
					}

					$( document.body ).trigger( 'wc_fragments_refreshed' );
				}
			}
		};

		function refresh_mini_cart() {
			$.ajax( $fragment_refresh )
				.done( function( response ) {
					if( response.cart_hash.length !== 0 )
						return true;

					$('#mpcth_cart').removeClass( 'active' );
				});
		}

		$mini_cart.on('click', '.mpcth-mini-cart-remove', function(e) {
			var $this = $(this);

			$mini_cart.block({
				message: null,
				overlayCSS: {
					background: '#fff',
					opacity: 0.6
				}
			});

			$.ajax( $this.attr('href'), {
				complete: function() {
					refresh_mini_cart();

					$mini_cart.unblock();
				}
			});

			$this.parents('.mpcth-mini-cart-product').slideUp();

			e.preventDefault();
		});
	}

	/* Refresh custom tabs */
	$('.single-product .woocommerce-tabs .tabs a').on('click', function() {
		$window.trigger('resize');
	});

	/* Added to cart icon */
	$body.on('added_to_cart', function() {
		$('.mpcth-cart-wrap .added_to_cart').wrapInner('<span>').prepend('<i class="fa fa-fw fa-check"></i>');

		$('#mpcth_cart').addClass('active');
	});

	/* Wishlist icon */
	$('.mpcth-post-header .yith-wcwl-add-to-wishlist, .mpcth-post-thumbnail .yith-wcwl-add-to-wishlist').find('a').wrapInner('<div class="mpcth-tooltip-message mpcth-color-main-background mpcth-color-main-border">').prepend('<div class="mpcth-tooltip-text"><i class="fa fa-fw fa-star"></i></div>').wrapInner('<div class="mpcth-tooltip-wrap">');

	$body.on('aln_reloaded', function() {
		setTimeout(function() {
			$('.mpcth-post-header .yith-wcwl-add-to-wishlist, .mpcth-post-thumbnail .yith-wcwl-add-to-wishlist').find('a').wrapInner('<div class="mpcth-tooltip-message mpcth-color-main-background mpcth-color-main-border">').prepend('<div class="mpcth-tooltip-text"><i class="fa fa-fw fa-star"></i></div>').wrapInner('<div class="mpcth-tooltip-wrap">');
		}, 250);
	});

	$('.product .mpcth-post-content .yith-wcwl-add-to-wishlist, .summary .yith-wcwl-add-to-wishlist').find('a').prepend('<i class="fa fa-fw fa-star"></i>');

	$body.on('jckqv_open', function() {
		$('#jckqv .yith-wcwl-add-to-wishlist, .summary .yith-wcwl-add-to-wishlist').find('a').prepend('<i class="fa fa-fw fa-star"></i>');
	});

	/* Masonry layout */
	var $masonry_shop = $('.mpcth-masonry-shop #mpcth_content > .products');

	if ($masonry_shop.length) {
		$masonry_shop.imagesLoaded(function() {
			$masonry_shop.masonry({
				itemSelector: '.product'
			});

			$masonry_shop.children('.product').addClass('mpcth-product-fading').addClass('mpcth-product-added');
			setTimeout(function() {
				$masonry_shop.children('.product').removeClass('mpcth-product-fading');
			}, 300);
		});
	}

	/* Load more */
	var $shop_load_more = $('#mpcth_shop_load_more'),
		$shop_load_more_icon = $shop_load_more.children('.mpcth-load-more-icon'),
		$shop_load_more_pagination = $('.woocommerce-pagination .page-numbers'),
		$shop_load_more_target = $('#mpcth_content .products'),
		$shop_load_more_container = $('#mpcth_shop_load_more_wrapper');

	if($shop_load_more.length) {
		var shop_pages_current = $shop_load_more_pagination.find('.page-numbers.current').text(),
			shop_pages_total = $shop_load_more_container.attr('data-max-pages'),
			shop_pages_next_link = $shop_load_more_pagination.find('.page-numbers.next').attr('href'),
			shop_is_loading = false;
			// can_pushState = typeof history.pushState === "function" ? true : false;

		function shop_ajax_load_more(e) {
			if (! shop_is_loading) {
				shop_is_loading = true;

				$shop_load_more.addClass('active');

				$shop_load_more_container.load(shop_pages_next_link + ' #mpcth_content .product', function() {
					var $shop_loaded_posts = $shop_load_more_container.children();

					$shop_loaded_posts.appendTo($shop_load_more_target);
					shop_is_loading = false;

					$shop_load_more.removeClass('active');

					$shop_load_more.on('click', shop_ajax_load_more);

					$shop_load_more_target.imagesLoaded(function() {
						$masonry_shop.masonry('appended', $shop_loaded_posts);
						$masonry_shop.children('.product').addClass('mpcth-product-added');

						$shop_loaded_posts.find('.mpcth-post-header .yith-wcwl-add-to-wishlist a, .mpcth-post-thumbnail .yith-wcwl-add-to-wishlist a').html('<i class="fa fa-fw fa-star"></i>');
						//$shop_loaded_posts.find('.mpcth-post-header .yith-wcwl-add-to-wishlist .yith-wcwl-add-button a, .mpcth-post-thumbnail .yith-wcwl-add-to-wishlist .yith-wcwl-add-button a').html('<i class="fa fa-fw fa-star-o"></i>');
						$shop_loaded_posts.find('.mpcth-post-content .yith-wcwl-add-to-wishlist a, .summary .yith-wcwl-add-to-wishlist a').prepend('<i class="fa fa-fw fa-star"></i>');
					});

					if(++shop_pages_current < shop_pages_total) {
						if(shop_pages_next_link.indexOf('page/') != -1)
							shop_pages_next_link = shop_pages_next_link.replace(/page\/[0-9]+\//, 'page/' + (shop_pages_current + 1) + '/');
						else
							shop_pages_next_link = shop_pages_next_link.replace(/paged=[0-9]+/, 'paged=' + (shop_pages_current + 1));
					} else {
						$shop_load_more.remove();
					}

					$window.trigger('loaded_more');
				});

			}

			e.preventDefault();
		}

		$shop_load_more.on('click', shop_ajax_load_more);
	}

/* ---------------------------------------------------------------- */
/* Quickview
/* ---------------------------------------------------------------- */

	$body.on('jckqv_open', function(e) {
		ajaxContentAdded = $.magnificPopup.instance.st.callbacks.ajaxContentAdded;
		$.magnificPopup.instance.st.callbacks.ajaxContentAdded = function() {
			ajaxContentAdded();

			$('#jckqv_summary .onsale').wrap('<div class="mpcth-sale-wrap">');

			$window.trigger('quickview_loaded');
		};

		var $products_wrapper = $('.mpcth-post-content');
		$.magnificPopup.instance.st.callbacks.afterClose = function() {
		    $products_wrapper.css('position', 'static');
		    setTimeout( function() { $products_wrapper.css('position', ''); $( '.mpcth-post-content' ).scrollTop(0); }, 1 );
		};
	});

/* ---------------------------------------------------------------- */
/* Visual Composer
/* ---------------------------------------------------------------- */
	$('.mpc-vc-share-facebook').on('click', function(e) {
		window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(location.href), 'facebook-share', 'width=630,height=430');
		e.preventDefault();
	});

	$('.mpc-vc-share-twitter').on('click', function(e) {
		window.open('https://twitter.com/intent/tweet?url=' + encodeURIComponent(location.href) + '&text=' +  encodeURIComponent(document.title), 'twitter-share', 'width=630,height=430');
		e.preventDefault();
	});

	$('.mpc-vc-share-google-plus').on('click', function(e) {
		window.open('https://plus.google.com/share?url=' + encodeURIComponent(location.href), 'googleplus-share', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');
		e.preventDefault();
	});

	$('.mpc-vc-share-pinterest').on('click', function(e) {
		var $img = $('#mpcth_page_wrap .mpcth-post-thumbnail img'),
			img_src = $img.length > 0 ? encodeURIComponent($img.first().attr('src')) : '';

		window.open('https://pinterest.com/pin/create/button/?url=' + encodeURIComponent(location.href) + '&amp;description=' + encodeURIComponent(document.title) + '&media=' + img_src, 'pinterest-share', 'width=630,height=430');

		e.preventDefault();
	});

/* ---------------------------------------------------------------- */
/* Contact Form 7
/* ---------------------------------------------------------------- */
	var $contact_form = $('.wpcf7-form');

	if ($contact_form.find('.contact-form-input').length) {
		$contact_form.find('label').each(function() {
			$(this).appendTo($(this).siblings('span'));
		});
	}

/* ---------------------------------------------------------------- */
/* Google Maps
/* ---------------------------------------------------------------- */
	var $google_map = $( '.wpb_map_wraper' );

	$google_map.each( function() {
		var $this = $( this );
		$this.append( '<div class="mpcth-map-overlay"></div>' );
	} );

	var $mpcth_map_overlay = $( '.mpcth-map-overlay' );

	$mpcth_map_overlay.on( 'click', function() {
		var $this = $( this );

		$this.addClass( 'unactive' );
	} );

	$window.on( 'scroll', function() {
		$mpcth_map_overlay.each( function() {
			var $this = $( this );

			$this.removeClass( 'unactive' );
		} );
	} );

/* ---------------------------------------------------------------- */
/* Custom select
/* ---------------------------------------------------------------- */
	var $variations = $('.single-product .variations select'),
		$variations_form = $('.single-product .variations_form');

	$variations.each(function() {
		$(this).width($(this).outerWidth());
	});
	$variations.customSelect({customClass: 'mpcthSelect'});

	$window.on('load', function() {
		//$variations.on('woocommerce_variation_select_change', function() {
		$variations.on('woocommerce_variation_select_change change', function() {
			$variations.trigger('update');
		});
	});

	$window.on('quickview_loaded', function() {
		$('#jckqv .variations select').customSelect({customClass: 'mpcthSelect'});
		$('#jckqv .variations_form').on('woocommerce_variation_select_change', function() {
			$('#jckqv .variations select').trigger('update');
		});
	});

	// Portfolio
	$('.page-template-template-portfolio-php #mpcth_portfolio_sorts .mpcth-portfolio-sort-select').customSelect({customClass: 'mpcthSelect'});
	$('.page-template-template-portfolio-php #mpcth_portfolio_sorts').addClass('mpcth-select-ready');
	$('.page-template-template-portfolio-php #mpcth_portfolio_filters .mpcth-portfolio-filter-select').customSelect({customClass: 'mpcthSelect'});
	$('.page-template-template-portfolio-php #mpcth_portfolio_filters').addClass('mpcth-select-ready');

	// bbPress
	$('.bbpress #mpcth_content .bbp-topic-form .bbp-form select, .bbpress #mpcth_content #bbp-your-profile .bbp-form select').customSelect({customClass: 'mpcthSelect'});
	var $mpcth_bbp_selects = $('.bbpress #mpcth_content .bbp-topic-form .bbp-form .mpcthSelect, .bbpress #mpcth_content #bbp-your-profile .bbp-form .mpcthSelect');
	$window.on('smart_resize', function() {
		$mpcth_bbp_selects.trigger('update').prev('.hasCustomSelect').outerWidth($mpcth_bbp_selects.outerWidth());
	})

	// Contact forms
	$('.wpcf7 .wpcf7-select').customSelect({customClass: 'mpcthSelect'});
	var  $contact_selects = $('.wpcf7 .mpcthSelect');
	$window.on('smart_resize', function() {
		$contact_selects.each( function() {
			var $this = $(this);
			$this.trigger('update').prev('.hasCustomSelect').outerWidth( $this.outerWidth() );
		});
	});

	// WooCommerce
	$('.woocommerce-page .woocommerce-ordering select').customSelect({customClass: 'mpcthSelect'});
	var $shippingSelects = $('.woocommerce-page .shipping select');
	
	$('.shipping-calculator-button').on('click', function(){
		setTimeout( function() {
			$shippingSelects.customSelect({customClass: 'mpcthSelect'});
		}, 50 );
	});

	$body.on('updated_shipping_method', function() {
		$shippingSelects.customSelect({customClass: 'mpcthSelect'});
	});

	// Custom Select for updated_checkout event
	$body.on('updated_checkout', function() {
	    $('.woocommerce-page .shipping select').customSelect({customClass: 'mpcthSelect'});
	});

	// Widget
	$('.widget select').customSelect({customClass: 'mpcthSelect'});
	var $mpcth_custom_selects = $('.widget .mpcthSelect');
	$window.on('smart_resize', function() {
		$mpcth_custom_selects.trigger('update').prev('.hasCustomSelect').outerWidth($mpcth_custom_selects.outerWidth());
	});

	// Header
	$('#mpcth_secondary_menu .wcml_currency_switcher').customSelect({customClass: 'mpcthSelect'});

	$('#mpcth_smart_search_wrap select').customSelect({customClass: 'mpcthSelect'});
	$('#mpcth_smart_search_wrap').addClass('mpcth-search-ready');

/* ---------------------------------------------------------------- */
/* Comment form validation
/* ---------------------------------------------------------------- */
	function is_mail_valid(value) {
		// contributed by Scott Gonzalez: http://projects.scottsplayground.com/email_address_validation/
		return /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))$/i.test(value);
	}

	function is_url_valid(value) {
		// contributed by Scott Gonzalez: http://projects.scottsplayground.com/iri/
		return /^(https?|s?ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(value);
	}

	var $comment_form = $('#mpcth_comment_form'),
		$input_author = $('#mpcth_comment_form_author'),
		$input_mail = $('#mpcth_comment_form_mail'),
		$input_url = $('#mpcth_comment_form_url'),
		$input_message = $('#mpcth_comment_form_message');

	if (typeof mpc_cf != 'undefined') {
		var default_author = mpc_cf.field_name,
			default_mail = mpc_cf.field_email,
			default_url = mpc_cf.field_url,
			default_message = mpc_cf.field_comment;
	} else {
		var default_author = default_mail = default_url = default_message = '';
	}

	$comment_form.on('focus', 'input, textarea', function() {
		$(this).removeClass('mpcth-input-invalid');
	});

	$comment_form.on('blur', 'input, textarea', function() {
		check_input($(this));
	});

	$comment_form.on('submit', function(e) {
		var is_form_valid = true;

		if(! check_input($input_author))
			is_form_valid = false;

		if(! check_input($input_mail))
			is_form_valid = false;

		if(! check_input($input_url))
			is_form_valid = false;

		if(! check_input($input_message))
			is_form_valid = false;

		if(! is_form_valid)
			e.preventDefault();
		else if($input_url.val() == default_url)
			$input_url.val('');
	});

	function check_input($input) {
		var is_valid = true,
			value = $input.val();

		if ($input.is('#mpcth_comment_form_author'))
			if (value == default_author || value.replace(' ', '') == '') {
				is_valid = false;
			} else if (value.length < 2) {
				is_valid = false;
				$input.addClass('mpcth-input-invalid');
			} else {
				$input.removeClass('mpcth-input-invalid');
			}

		else if ($input.is('#mpcth_comment_form_mail'))
			if (value == default_mail || value == '') {
				is_valid = false;
			} else if (! is_mail_valid(value) || value.length < 6) {
				is_valid = false;
				$input.addClass('mpcth-input-invalid');
			} else {
				$input.removeClass('mpcth-input-invalid');
			}

		else if ($input.is('#mpcth_comment_form_url'))
			if (value != '' && value != default_url && ! is_url_valid(value)) {
				is_valid = false;
				$input.addClass('mpcth-input-invalid');
			} else {
				$input.removeClass('mpcth-input-invalid');
			}

		else if ($input.is('#mpcth_comment_form_message'))
			if (value == default_message || value.replace(' ', '') == '') {
				is_valid = false;
			} else if (value.length < 5) {
				is_valid = false;
				$input.addClass('mpcth-input-invalid');
			} else {
				$input.removeClass('mpcth-input-invalid');
			}

		return is_valid;
	}
/* ---------------------------------------------------------------- */
/* Sticky Footer
/* ---------------------------------------------------------------- */
	$( window ).on( 'load', function() {
        var $footer = $( '#mpcth_footer.sticky_footer' );
        function mpcth_fixed_footer() {
            if( $( window ).height() >= $( 'body' ).height() ) {
                
                $footer.addClass( 'mpcth-fixed-footer' ).removeClass( 'mpcth-not-fixed-footer' );
            } else {
                $footer.removeClass( 'mpcth-fixed-footer' ).addClass( 'mpcth-not-fixed-footer' );
            }
        }
        mpcth_fixed_footer();
        $( window ).on( 'resize', function() {
            mpcth_fixed_footer();
        });
    });
});

jQuery(document).ready(function($) {
	$(window).on('smart_resize', function() {
		$('.rev_slider .mpcth-lookbook-price, .rev_slider .mpcth-lookbook-badge').removeAttr('style').find('*').removeAttr('style');
	});
});

jQuery(document).ready(function($) {
	if ($('.home.page-id-1768').length) {
		var $sticky_header = $('#mpcth_page_header_wrap'),
			$sticky_header_spacer = $('#mpcth_page_header_wrap_spacer'),
			$header_container = $('#mpcth_page_header_container'),
			is_admin_bar_enabled = $('#wpadminbar').length;

		$sticky_header_spacer.waypoint({
			handler: function(direction) {
				if ($(window).width() <= 979) {
					var height = $header_container.height();

					if (direction == 'up') {
						$sticky_header.stop(true, true).animate({top: -height}, 200, function() {
							$sticky_header.css('top', is_admin_bar_enabled ? 32 : 0).removeClass('mpcth-sticky-header');
						});
					} else {
						$sticky_header.addClass('mpcth-sticky-header').css('top', -height).animate({top: is_admin_bar_enabled ? 32 : 0}, 700);
					}
				}
			},
			offset: '-10%'
		});
	}
});

jQuery(document).ready(function($) {
	$('.wpb_tabs_nav').on('mouseup', '.ui-tabs-anchor', function() {
		var $content = $($(this).attr('href')),
			$slider = $content.find('.mpcth-items-slider');

		if ($slider.length) {
			setTimeout(function() { $slider.trigger('updateSizes'); }, 100);
			setTimeout(function() { $slider.trigger('updateSizes'); }, 200);
		}
	});
});


// Mail Chimp support
(function($) {
	var $formSubmited = $('.mc4wp-form-submitted');
	var $mailChimpForm = $('#mpcth_newsletter');
	var $subError = $('.mc4wp-form-submitted.mc4wp-form-error');
	var $response = $('.mc4wp-response');

	if ($formSubmited.length > 0) {
		$mailChimpForm.addClass('mpcth-toggled');
	}
	if ($subError.length > 0) {
		$response.delay(5000).fadeOut('slow');
	}
})(jQuery);