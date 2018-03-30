(function($) {
	'use strict';
	$(document).ready(function() {
		if($('#footer-wrap').length) {
			$('#footer-wrap').remove();
		}
		if(Modernizr.touch === false && $(window).width() > 800) {
			var width, height, dfd_logo_light, dfd_logo_dark;
			var $header_container = $('#header-container');
			var $carousel = $('#layout.one-page-scroll');
			var enable_dots = $('#layout').data('enable-dots');
			var enable_animation = $('#layout').data('enable-animation');
			var slideshow_speed = 1000;
			var current_logo = $header_container.find('.logo-for-panel img').attr('src');
			var easeStyle = 'linear';
			var fadeVal = false;
			var verticalVal = true;
			$('#main-wrap').addClass('dfd-one-page-scroll-layout');
			if('dfd_smart_logo_light' in window && dfd_smart_logo_light != '') {
				dfd_logo_light = dfd_smart_logo_light;
			} else {
				dfd_logo_light = current_logo;
			}
			if('dfd_smart_logo_dark' in window && dfd_smart_logo_dark != '') {
				dfd_logo_dark = dfd_smart_logo_dark;
			} else {
				dfd_logo_dark = current_logo;
			}
			
			if(enable_animation) {
				if($carousel.hasClass('dfd-3d-style-1')) {
					slideshow_speed = 500;
				}
				if($carousel.hasClass('dfd-3d-style-2')) {
					fadeVal = true;
					verticalVal = false;
					//slideshow_speed = 800;
				}
				if($carousel.hasClass('dfd-3d-style-3')) {
					fadeVal = true;
					verticalVal = false;
					easeStyle = 'cubic-bezier(.51,.6,.52,.83)';
					//slideshow_speed = 800;
				}
				$carousel.on('beforeChange', function(event, slick, currentSlide, nextSlide){
					if(currentSlide > nextSlide) {
						$carousel.find('.vc-row-wrapper.slick-slide').eq(nextSlide)
								.addClass('active-from-prev')
								.next().addClass('from-prev')
								.siblings().removeClass('from-prev from-next');
						$carousel.find('.vc-row-wrapper.slick-slide').eq(nextSlide).siblings().removeClass('active-from-prev active-from-next');
						setTimeout(function() {
							$carousel.find('.vc-row-wrapper.slick-slide').eq(nextSlide).removeClass('active-from-prev').next().removeClass('from-prev');
						}, 1000);
					} else {
						$carousel.find('.vc-row-wrapper.slick-slide').eq(nextSlide)
								.addClass('active-from-next')
								.prev().addClass('from-next')
								.siblings().removeClass('from-prev').removeClass('from-next');
						$carousel.find('.vc-row-wrapper.slick-slide').eq(nextSlide).siblings().removeClass('active-from-prev active-from-next');
						setTimeout(function() {
							$carousel.find('.vc-row-wrapper.slick-slide').eq(nextSlide).removeClass('active-from-next').prev().removeClass('from-next');
						}, 1000);
					}
				});
			}
			
			$carousel.on('init reInit afterChange', function (event, slick, currentSlide) {
				if($header_container.hasClass('dfd-smart-header')) {
					if($carousel.find('.vc-row-wrapper.slick-slide.slick-active').hasClass('dfd-background-dark')) {
						$header_container.find('.logo-for-panel img').attr('src', dfd_logo_light);
						$header_container.removeClass('dfd-header-light').addClass('dfd-header-dark');
						$carousel.find('> .slick-dots').removeClass('dfd-dots-light').addClass('dfd-dots-dark');
					} else {
						$header_container.find('.logo-for-panel img').attr('src', dfd_logo_dark);
						$header_container.removeClass('dfd-header-dark').addClass('dfd-header-light');
						$carousel.find('> .slick-dots').removeClass('dfd-dots-dark').addClass('dfd-dots-light');
					}
				}
				$header_container.addClass('dfd-disable-transition');
				setTimeout(function() {
					$header_container.removeClass('dfd-disable-transition');
				}, 500);
			});
			$carousel.slick({
				infinite: false,
				slidesToShow: 1,
				slidesToScroll: 1,
				arrows: false,
				dots: enable_dots,
				draggable: false,
				autoplay: false,
				cssEase: easeStyle,
				speed: slideshow_speed,
				fade: fadeVal,
				vertical: verticalVal,
				customPaging: function(slider, i) {
					var $tooltip = '';
					if($(slider.$slides[i]).data('dfd-dots-title')) {
						$tooltip = '<span><span>' + $(slider.$slides[i]).data('dfd-dots-title') + '</span></span>';
					}
					return '<button type="button">' + $(slider.$slides[i]).data('slick-index') + '</button>' + $tooltip;
				}
			});

			if($header_container.hasClass('dfd-smart-header') && $carousel.find('.vc-row-wrapper.slick-slide.slick-active').hasClass('dfd-background-dark')) {
				$header_container.addClass('dfd-header-dark');
			}
			
			var mousewheelevt = (/Firefox/i.test(navigator.userAgent)) ? 'DOMMouseScroll' : 'mousewheel';
			$carousel.bind(mousewheelevt, function(e){
				var ev = window.event || e;
				ev = ev.originalEvent ? ev.originalEvent : ev;
				var delta = ev.detail ? ev.detail*(-40) : ev.wheelDelta;
				if(delta > 0) {
					if($carousel.find('.vc-row-wrapper.slick-slide.slick-active').prev('.slick-slide').length > 0) {
						ev.preventDefault();
						//$(window).stop().animate({scrollTop: 0}, 'fast');
						$carousel.slickPrev();
					}
				} else {
					if($carousel.find('.vc-row-wrapper.slick-slide.slick-active').next('.slick-slide').length > 0) {
						ev.preventDefault();
						//$(window).stop().animate({scrollTop: 0}, 'fast');
						$carousel.slickNext();
					}
				}
			});
			$('body').keyup(function(e) {
				if (e.keyCode == 38 || e.keyCode == 37) {
					if($carousel.find('.vc-row-wrapper.slick-slide.slick-active').prev('.slick-slide').length > 0) {
						e.preventDefault();
						$(window).stop().animate({scrollTop: 0}, 'fast');
						$carousel.slickPrev();
					}
				}
				if (e.keyCode == 40 || e.keyCode == 39) {
					if($carousel.find('.vc-row-wrapper.slick-slide.slick-active').next('.slick-slide').length > 0) {
						e.preventDefault();
						$(window).stop().animate({scrollTop: 0}, 'fast');
						$carousel.slickNext();
					}
				}
			});

			var recalcValues = function() {
				var heightOffset = 0;
				var widthOffset = 0;
				if($('body').hasClass('admin-bar')) {
					heightOffset = $('#wpadminbar').outerHeight();
				}
				if($('body > .boxed_layout').length > 0) {
					$('body > .boxed_layout').css('maxWidth', '100%');
				}
				if($('.dfd-custom-padding-html').length > 0) {
					var bodyOffset = $('.dfd-custom-padding-html').css('margin').replace('px', '');
					heightOffset += bodyOffset * 2;
					widthOffset = bodyOffset * 2;
				}
				width = $(window).width() - widthOffset;
				height = $(window).height() - heightOffset;
				$('.vc-row-wrapper.slick-slide', $carousel).css({
					width : width,
					maxWidth : width,
					height : height,
					maxHeight : height
				});
				$carousel.find('.vc-row-wrapper.slick-slide >.row').addClass('dfd-vertical-aligned');
			};

			recalcValues();
			$(window).on('load resize', recalcValues);
		}
	});
})(jQuery);