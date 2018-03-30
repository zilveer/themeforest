(function($, undefined) {
	"use strict";

	$(function() {
		var win = $(window),
			win_width,
			body = $('body'),
			hbox = $('.fixed-header-box'),
			hbox_filler,
			header = $('header.main-header'),
			single_row_header = header.hasClass('layout-logo-menu'),
			type_over = body.hasClass('sticky-header-type-over'),
			middle = $('.header-middle'),
			middle_filler,
			main_content = $('#main-content'),
			second_row = hbox.find('.second-row'),
			admin_bar_fix = body.hasClass('admin-bar') ? 32 : 0,
			logo_wrapper = hbox.find('.logo-wrapper'),
			logo_wrapper_height = 0,
			top_nav = $('.top-nav'),
			top_nav_height = 0,
			explorer = /MSIE (\d+)/.exec(navigator.userAgent),
			loaded = false,
			interval,
			small_logo_height = 46,
			tween = $('.wpv-grid.has-video-bg').length ? 'animate' : 'transition',
			tween_easing = tween === 'transition' ? 'ease' : 'linear';

		var ok_to_load = function() {
			return ( body.hasClass( 'sticky-header' ) || body.hasClass( 'had-sticky-header' ) ) &&
				! ( explorer && parseInt( explorer[1], 10 ) === 8 ) &&
				! $.WPV.MEDIA.is_mobile() &&
				! $.WPV.MEDIA.layout["layout-below-max"] &&
				hbox.length && second_row.length;
		};

		var ok_to_load_middle = function() {
			return $('#header-slider-container').length && $('.wpv-grid.parallax-bg').length === 0;
		};

		var init = function() {
			if ( ! ok_to_load() ) {
				if ( body.hasClass( 'sticky-header' ) ) {
					body.removeClass( 'sticky-header' ).addClass( 'had-sticky-header' );
				}
				return;
			}

			win_width = win.width();

			hbox_filler = hbox.clone().html('').css({
				'z-index': 0,
				visibility: 'hidden',
				height: single_row_header && type_over ? top_nav.outerHeight() : hbox.outerHeight()
			}).insertAfter(hbox);

			hbox.css({
				position: 'fixed',
				top: hbox.offset().top,
				left: hbox.offset().left,
				width: hbox.outerWidth(),
				'-webkit-transform': 'translateZ(0)'
			});

			if(ok_to_load_middle()) {
				middle_filler = middle.clone().html('').css({
					'z-index': 0,
					visibility: 'hidden',
					height: middle.outerHeight()
				}).insertAfter(middle);

				middle.css({
					position: 'fixed',
					top: middle.offset().top,
					left: middle.offset().left,
					width: middle.outerWidth(),
					'z-index': 0
				});
			} else {
				middle_filler = null;
			}

			logo_wrapper_height = logo_wrapper.removeClass('scrolled').outerHeight();
			top_nav_height = top_nav.show().outerHeight();
			logo_wrapper.addClass('loaded');

			interval = setInterval(reposition, 41);

			loaded = true;

			win.scroll();
		};

		var destroy = function() {
			if(hbox_filler)
				hbox_filler.remove();

			hbox.removeClass('static-absolute fixed').css({
				position: '',
				top: '',
				left: '',
				width: '',
				'-webkit-transform': ''
			});

			if(middle_filler) {
				middle_filler.remove();

				middle.css({
					position: '',
					top: '',
					left: '',
					width: '',
					'z-index': 0
				});
			}

			logo_wrapper.removeClass('scrolled loaded');

			clearInterval(interval);

			loaded = false;
		};

		var chrome_video_bg_bug = $('.wpv-grid.has-video-bg').length > 0 &&  $('.wpv-grid.parallax-bg').length > 0,
			prev_cpos = -1,
			scrolling_down = true,
			scrolling_up = false,
			start_scrolling_up;

		var reposition = function() {
			if(!loaded)
				return;

			var cpos = win.scrollTop();

			body.toggleClass('wpv-scrolled', cpos > 0).toggleClass('wpv-not-scrolled', cpos === 0);

			if(single_row_header) {
				var delta = type_over ? top_nav_height : logo_wrapper_height - small_logo_height + top_nav_height;
				var trigger = chrome_video_bg_bug ? delta*1.5 : 0;

				if(!('blockStickyHeaderAnimation' in $.WPV) || !$.WPV.blockStickyHeaderAnimation) {
					scrolling_down = prev_cpos < cpos;
					scrolling_up = prev_cpos > cpos;

					if(scrolling_up && start_scrolling_up === undefined) {
						start_scrolling_up = cpos;
					} else if(scrolling_down) {
						start_scrolling_up = undefined;
					}

					prev_cpos = cpos;
				}

				if(!body.hasClass('no-sticky-header-animation') && !body.hasClass('no-sticky-header-animation-tmp')) {
					if( cpos > trigger && scrolling_down ) {
						if(!(logo_wrapper.hasClass('scrolled'))) {
							logo_wrapper.addClass('scrolled');
							top_nav.slideUp(300);

							body.addClass('no-sticky-header-animation-tmp');
							setTimeout(function() {
								body.removeClass('no-sticky-header-animation-tmp');
							}, 350);

							if(!chrome_video_bg_bug) {
								hbox_filler[tween]({
									height: '-='+delta+'px'
								}, 300, tween_easing);

								if(middle_filler && middle_filler.length) {
									middle[tween]({
										top: '-='+delta+'px'
									}, 300, tween_easing);
								}
							}
						}
					} else if(logo_wrapper.hasClass('scrolled') && scrolling_up && (start_scrolling_up - cpos > 60 || start_scrolling_up < 120) ) {
						logo_wrapper.removeClass('scrolled');
						top_nav.slideDown(300);

						body.addClass('no-sticky-header-animation-tmp');
						setTimeout(function() {
							body.removeClass('no-sticky-header-animation-tmp');
						}, 350);

						if(!chrome_video_bg_bug) {
							hbox_filler[tween]({
								height: '+='+delta+'px'
							}, 300, tween_easing);

							if(middle_filler && middle_filler.length) {
								middle[tween]({
									top: '+='+delta+'px'
								}, 300, tween_easing);
							}
						}
					}
				}
			} else {
				var hbox_height = hbox.outerHeight(),
					second_row_height = second_row.height(),
					mcpos = main_content.offset().top - admin_bar_fix;

				if(mcpos <= cpos + hbox_height) {
					if( cpos + second_row_height <= mcpos) {
						hbox.css({
							position: 'absolute',
							top: mcpos - hbox_height,
							left: 0
						}).addClass('static-absolute').removeClass('fixed second-stage-active');
					} else {
						hbox.css({
							position: 'fixed',
							top: admin_bar_fix + second_row_height - hbox_height,
							left: hbox_filler.offset().left,
							width: hbox.outerWidth()
						}).addClass('second-stage-active');
					}
				} else {
					hbox.removeClass('static-absolute second-stage-active').css({
						position: 'fixed',
						top: hbox_filler.offset().top,
						left: hbox_filler.offset().left,
						width: hbox_filler.outerWidth()
					});
				}
			}

			if(!hbox.hasClass('fixed') && !hbox.hasClass('static-absolute') && !hbox.hasClass('second-stage-active')) {
				hbox.css({
					position: 'fixed',
					top: hbox_filler.offset().top,
					left: hbox_filler.offset().left,
					width: hbox.outerWidth()
				}).addClass('fixed');
			}
		};

		win.bind('scroll touchmove', reposition).smartresize(function() {
			if(win.width() !== win_width) {
				destroy();
				init();
			}
		});

		init();
	});
})(jQuery);