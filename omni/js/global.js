/*-------------------------------------------------------------------------------------------------------------------------------*/
/*This is main JS file that contains custom style rules used in this template*/
/*-------------------------------------------------------------------------------------------------------------------------------*/
/* Template Name: omni*/
/* Version: 1.0 Initial Release*/
/* Build Date: 25-02-2015*/
/* Author: Unbranded*/
/* Website: 
 /* Copyright: (C) 2015 */
/*-------------------------------------------------------------------------------------------------------------------------------*/
/*--------------------------------------------------------*/
/* TABLE OF CONTENTS: */
/*--------------------------------------------------------*/
/* 01 - VARIABLES */
/* 02 - page calculations */
/* 03 - function on document ready */
/* 04 - function on page load */
/* 05 - function on page resize */
/* 06 - function on page scroll */
/* 07 - swiper sliders */
/* 08 - buttons, clicks, hovers */
/*-------------------------------------------------------------------------------------------------------------------------------*/


(function ($) {


	"use strict";

	/*================*/
	/* 01 - VARIABLES */
	/*================*/

	var swipers = [], winW, winH, _isresponsive, xsPoint = 767, smPoint = 991, mdPoint = 1199, enableScroll = 1, header_top = 0;
	var isSafari = /constructor/i.test(window.HTMLElement);
	if (isSafari) $('body').addClass('safari');
	var mabile_animation = true;
	if ($('body').hasClass('no-mobile-animation')) {
		mabile_animation = false;
	}

	var headerHeight = ($('.sidebar-menu-added').length) ? 0 : 77;

	if (navigator.userAgent.match(/MSIE 10/i) || navigator.userAgent.match(/Trident\/7\./) || navigator.userAgent.match(/Edge\/\d+/) ||
		navigator.userAgent.match(new RegExp("Trident/7.", ""))) {
		$('body').addClass('IE');
	}


	/*========================*/
	/* 02 - page calculations */
	/*========================*/
	function pageCalculations() {

		if (jQuery('body').hasClass('admin-bar')) {
			header_top = jQuery('#wpadminbar').height();
		}

		winW = $(window).width();
		winH = $(window).height() - header_top;
		if ($('.mob-icon').is(':visible')) _isresponsive = true;
		else _isresponsive = false;
		$('.block.type-2 .col-md-6.col-md-push-6').height($('.block.type-2 .col-md-4.col-md-pull-6').height());

		if (winH < 700 && $('.bottom-fixed-control-class').length) $('header').removeClass('bottom-fixed-control-class bottom-fixed');
		$('.teaser-container').css({'height': winH});
	}


	/*=================================*/
	/* 03 - function on document ready */
	/*=================================*/
	$(document).ready(function () {
		pageCalculations();

		//Add classes to current menu items.
		var $current_menu = $('#nav').find('.current-menu-item');
		if ($current_menu.length) {
			$current_menu.find(' > a').addClass('act');
		}
		var $current_menu_parent = $('#nav').find('.current-menu-ancestor');
		if ($current_menu_parent.length) {
			$current_menu_parent.find(' > a').addClass('act');
		}

		//center all images inside containers
		$('.center-image').each(function () {
			var bgSrc = $(this).attr('src');
			$(this).parent().css({'background-image': 'url(' + bgSrc + ')'});
			$(this).hide();
		});

		if ($('#loader-wrapper').length > 0) {
			$('#loader-wrapper').delay(500).fadeOut(600);
		}

		// Run animation engine on page scroll
		var wow = new WOW(
			{
				boxClass    : 'wow',      // animated element css class (default is wow)
				animateClass: 'animated', // animation css class (default is animated)
				offset      : 100,          // distance to the element when triggering the animation (default is 0)
				mobile      : mabile_animation,       // trigger animations on mobile devices (default is true)
				live        : true,       // act on asynchronously loaded content (default is true)
				callback    : function (box) {
					// the callback is fired every time an animation is started
					// the argument that is passed in is the DOM node being animated
				}
			}
		);
		$('body').addClass('loaded');

		scrollCall();
		resizeCall();
		wow.init();

		setTimeout(function () {
			initSwiper();
		}, 100);


		setTimeout(function () {
			;
			(function (window, document, undefined) {

				'use strict';

				// Cut the mustard
				var supports = 'querySelector' in document && 'addEventListener' in window;
				if (!supports) return;

				// Get all anchors
				var anchors = $('a[href*=\\#]').filter(function () {
					return $(this).parent().is(":not(.vc_tta-tab)");
				});

				// Add smooth scroll to all anchors
				for (var i = 0, len = anchors.length; i < len; i++) {
					var url = new RegExp(window.location.hostname + window.location.pathname);
					if (!url.test(anchors[i].href)) continue;
					anchors[i].setAttribute('data-scroll', true);
				}

				smoothScroll.init({
					selector : '[data-scroll]', // Selector for links (must be a valid CSS selector)
					speed    : 500, // Integer. How fast to complete the scroll in milliseconds
					easing   : 'easeOutQuad', // Easing pattern to use
					offset   : headerHeight,
					updateURL: true, // Boolean. If true, update the URL hash on scroll
					callback : function (anchor, toggle) {
					} // Function to run after scrolling
				});

			})(window, document);
		}, 200);

	});


	/*=================================*/
	/* 03 - function on window load */
	/*=================================*/

	$(window).load(function () {
		if (window.location.hash) {
			var hash = smoothScroll.escapeCharacters(window.location.hash); // Escape the hash
			var toggle = document.querySelector('a[href*="' + hash + '"]'); // Get the toggle (if one exists)
			var options = {
				offset   : headerHeight,
				speed    : 500, // Integer. How fast to complete the scroll in milliseconds
				easing   : 'easeOutQuad', // Easing pattern to use
				updateURL: true, // Boolean. If true, update the URL hash on scroll
				callback : function (anchor, toggle) {
					$('.scroll-to-link.act').removeClass('act');
					$(toggle).addClass('act');
				} // Function to run after scrolling
			}; // Any custom options you want to use would go here
			$('body').imagesLoaded(function () {
				smoothScroll.animateScroll(hash, toggle, options);
			});

		}
	});

	/*==============================*/
	/* 05 - function on page resize */
	/*==============================*/
	function resizeCall() {
		pageCalculations();
		$('.swiper-container.initialized[data-slides-per-view="responsive"]').each(function () {
			var thisSwiper = swipers['swiper-' + $(this).attr('id')], $t = $(this), slidesPerViewVar = updateSlidesPerView($t);
			thisSwiper.params.slidesPerView = slidesPerViewVar;
			var paginationSpan = $t.find('.pagination span');
			paginationSpan.hide().slice(0, (paginationSpan.length + 1 - slidesPerViewVar)).show();
		});
	}

	$(window).on('resize', throttle(function () {
		resizeCall();
	}, 250));

	window.addEventListener("orientationchange", function () {
		resizeCall();
	}, false);


	/*==============================*/
	/* 06 - function on page scroll */
	/*==============================*/
	var _buffer = null;

	$(window).on('scroll', throttle(function () {
		scrollCall();
	}, 50));

	function scrollCall() {
		var winScroll = $(window).scrollTop() + 1;
		if (!_isresponsive && !$('#header').hasClass('default-act') && !$('.sidebar-menu-added').length) {
			if ($(window).scrollTop() >= 25) $('#header').addClass('act');
			else $('#header').removeClass('act');
		}

		if ($('#header').hasClass('bottom-fixed-control-class')) {
			if (winScroll >= (winH - 75)) $('#header').removeClass('bottom-fixed');
			else $('#header').addClass('bottom-fixed');
		}

		if ($('.vc_row').length && enableScroll) {
			$('.vc_row').each(function (index, element) {
				if ($(element).data('id') && $(element).offset()) {

					if ($(element).offset().top <= (winScroll + headerHeight + header_top) && ($(element).offset().top + $(element).height()) > (winScroll + headerHeight + header_top)) {
						var navigation = $('#nav');
						navigation.find('.scroll-to-link').removeClass('act');
						navigation.find('.scroll-to-link[href="#' + $(element).attr('data-id') + '"]').addClass('act');
						return false;
					}
				}
			});
		}
	}


	/*=====================*/
	/* 07 - swiper sliders */
	/*=====================*/
	function initSwiper() {
		var initIterator = 0;
		$('.swiper-container').each(function () {
			var $t = $(this);

			var index = 'swiper-unique-id-' + initIterator;

			$t.addClass('swiper-' + index + ' initialized').attr('id', index);
			$t.find('.pagination').addClass('pagination-' + index);

			var autoPlayVar = parseInt($t.attr('data-autoplay'), 10);
			var centerVar = parseInt($t.attr('data-center'), 10);
			var simVar = ($t.closest('.circle-description-slide-box').length/* || $t.closest('.screens-custom-slider-box').length*/) ? false : true;

			var slidesPerViewVar = $t.attr('data-slides-per-view');
			if (slidesPerViewVar == 'responsive') {
				slidesPerViewVar = updateSlidesPerView($t);
			}
			else if (slidesPerViewVar != 'auto') {
				slidesPerViewVar = parseInt(slidesPerViewVar, 10);
			}
			var loopVar = parseInt($t.attr('data-loop'), 10);
			var speedVar = parseInt($t.attr('data-speed'), 10);


			swipers['swiper-' + index] = new Swiper('.swiper-' + index, {
				speed              : speedVar,
				pagination         : '.pagination-' + index,
				loop               : loopVar,
				paginationClickable: true,
				autoplay           : autoPlayVar,
				slidesPerView      : slidesPerViewVar,
				keyboardControl    : true,
				calculateHeight    : true,
				simulateTouch      : simVar,
				centeredSlides     : centerVar,
				roundLengths       : true,
				preloadImages      : true,
				updateOnImagesReady: true,
				onSlideChangeStart : function (swiper) {
					var activeIndex = (loopVar === true) ? swiper.activeIndex : swiper.activeLoopIndex;
					if ($t.closest('.register-login').length) {
						$('.block.type-5 .img-wrap-move').css({'margin-top': 700 * swiper.activeLoopIndex * (-1)});
						$t.closest('.testimonials-wrapper').find('.testimonials-icons .entry div.active').removeClass('active');
						$t.closest('.testimonials-wrapper').find('.testimonials-icons .entry div').eq(activeIndex).addClass('active');
					}
					if ($t.find('.banner-tabs').length) {
						$t.find('.banner-tabs .active').removeClass('active');
						$t.find('.banner-tabs .entry').eq(activeIndex).addClass('active');
					}
					if ($t.find('.thumbnails').length) {
						$t.find('.thumbnails .active').removeClass('active');
						$t.find('.thumbnails .entry').eq(activeIndex).addClass('active');
					}
				},
				onSlideClick       : function (swiper) {
					if ($t.closest('.screens-custom-slider-box').length) {
						swiper.slideTo(swiper.clickedSlideIndex);
					}
				}
			});

			if ($t.attr('data-slides-per-view') == 'responsive') {
				var paginationSpan = $t.find('.pagination span');
				paginationSpan.hide().slice(0, (paginationSpan.length + 1 - slidesPerViewVar)).show();
			}
			if ($t.closest('.screens-custom-slider-box').length) swipers['swiper-' + index].slideTo(1, 0);

			initIterator++;
		});

	}

	function updateSlidesPerView(swiperContainer) {
		if (winW > mdPoint) return parseInt(swiperContainer.attr('data-lg-slides'), 10);
		else if (winW > smPoint) return parseInt(swiperContainer.attr('data-md-slides'), 10);
		else if (winW > xsPoint) return parseInt(swiperContainer.attr('data-sm-slides'), 10);
		else return parseInt(swiperContainer.attr('data-xs-slides'), 10);
	}

	//swiper arrows
	$('.swiper-arrow.left').on('click', function () {
		swipers['swiper-' + $(this).parent().attr('id')].swipePrev();
	});

	$('.swiper-arrow.right').on('click', function () {
		swipers['swiper-' + $(this).parent().attr('id')].swipeNext();
	});

	$('.swiper-arrow-gallery.left').on('click', function () {
		swipers['swiper-' + $(this).closest('.gallery-popup').find('.swiper-container').attr('id')].swipePrev();
	});

	$('.swiper-arrow-gallery.right').on('click', function () {
		swipers['swiper-' + $(this).closest('.gallery-popup').find('.swiper-container').attr('id')].swipeNext();
	});

	//swiper tabs
	$('.banner-tabs .entry, .thumbnails .entry').on('click', function () {
		if ($(this).hasClass('active')) return false;
		var activeIndex = $(this).parent().find('.entry').index(this);
		swipers['swiper-' + $(this).closest('.swiper-container').attr('id')].slideTo(activeIndex);
		$(this).parent().find('.active').removeClass('active');
		$(this).addClass('active');
	});


	/*==============================*/
	/* 08 - buttons, clicks, hovers */
	/*==============================*/

	//menu click in responsive
	$('.mob-icon').on('click', function () {
		if ($(this).hasClass('act')) {
			$('.mob-icon').removeClass('act');
			$('header').removeClass('act-mob');
		} else {
			$('.mob-icon').addClass('act');
			$('header').addClass('act-mob');
		}
	});


	var options = {
		offset   : headerHeight + header_top,
		speed    : 500, // Integer. How fast to complete the scroll in milliseconds
		easing   : 'easeOutQuad', // Easing pattern to use
		updateURL: true, // Boolean. If true, update the URL hash on scroll
		callback : function (hash, toggle) {
			$('header').removeClass('act-mob');
			$('.mob-icon').removeClass('act');
			$('.scroll-to-link.act').removeClass('act');
			$(toggle).addClass('act');
		} // Function to run after scrolling
	};
	$('.scroll-to-link').on('click', function () {
		var hash = smoothScroll.escapeCharacters($(this).attr('href').substr(1)); // Escape the hash
		var toggle = document.querySelector('.scroll-to-link[href*="' + hash + '"]');
		smoothScroll.animateScroll(hash, toggle, options);
	});


	//theme config - changing color scheme
	$('.theme-config .open').on('click', function () {
		$('.theme-config').toggleClass('active');
	});

	$('.theme-config .colours-wrapper .entry').on('click', function () {
		var prevTheme = $('body').attr('data-theme');
		var newTheme = $(this).attr('data-theme');
		if ($(this).hasClass('active')) return false;
		$(this).parent().find('.active').removeClass('active');
		$(this).addClass('active');
		$('body').attr('data-theme', newTheme);
		$('img').each(function () {
			$(this).attr("src", $(this).attr("src").replace(prevTheme + '/', newTheme + '/'));
		});
		localStorage.setItem("theme", newTheme);
	});

	var localStorageThemeVar = localStorage.getItem('theme');
	if (name !== null && name !== 'null') {
		$('.theme-config .colours-wrapper .entry[data-theme="' + localStorageThemeVar + '"]').click();
	}

	//tabs
	var tabsFinish = 0;
	$('.tabs-switch').on('click', function () {
		if ($(this).hasClass('active') || tabsFinish) return false;
		tabsFinish = 1;
		$(this).parent().find('.active').removeClass('active');
		$(this).addClass('active');
		var tabIndex = $(this).parent().find('.tabs-switch').index(this);
		var tabsContainer = $(this).closest('.tabs-switch-container');
		tabsContainer.find('.tabs-entry:visible').fadeOut('fast', function () {
			tabsContainer.find('.tabs-entry').eq(tabIndex).fadeIn('fast', function () {
				tabsFinish = 0;
			});
		});
	});

	//accordeon
	$('.accordeon .entry .title').on('click', function () {
		$(this).parent().toggleClass('active');
		$(this).parent().find('.text').slideToggle('fast');
	});

	$('.categories-wrapper .entry.toggle').on('click', function () {
		$(this).toggleClass('active');
		$(this).next('.sub-wrapper').slideToggle('fast');
	});


	$('.gallery-popup .close-popup').on('click', function () {
		$('.gallery-popup').removeClass('active');
		$('body, html').toggleClass('overflow-hidden');
	});

	//search popup
	$('.open-search').on('click', function () {
		$('.screen-search-popup').addClass('active').find('.overflow img').attr('src', $(this).data('fullscreen'));
		$('body, html').toggleClass('overflow-hidden');
	});

	$('.screen-search-popup .close-popup').on('click', function () {
		$('.screen-search-popup').removeClass('active');
		$('body, html').toggleClass('overflow-hidden');
	});

	//open fullscreen preview popup
	$('.open-fullscreen').on('click', function () {
		$('.screen-preview-popup').addClass('active').find('.overflow img').attr('src', $(this).data('fullscreen'));
		$('body, html').toggleClass('overflow-hidden');
	});

	$('.screen-preview-popup .close-popup').on('click', function () {
		$('.screen-preview-popup').removeClass('active');
		$('body, html').toggleClass('overflow-hidden');
	});

	//checkbox
	$('.checkbox-entry.checkbox label').on('click', function () {
		$(this).parent().toggleClass('active');
		$(this).parent().find('input').click();
	});

	$('.checkbox-entry.radio label').on('click', function () {
		$(this).parent().find('input').click();
		if (!$(this).parent().hasClass('active')) {
			var nameVar = $(this).parent().find('input').attr('name');
			$('.checkbox-entry.radio input[name="' + nameVar + '"]').parent().removeClass('active');
			$(this).parent().addClass('active');
		}
	});

	//responsive drop-down in gallery
	$('.responsive-filtration-title').on('click', function () {
		$(this).closest('.sorting-menu').toggleClass('active');
	});

	//mousehover on phone-icons block
	$('.phone-icons-description .entry').on('mouseover', function () {
		var thisWrapper = $(this).closest('.phone-icons-box'), val = thisWrapper.find('.phone-icons-description .entry').index(this) + 1;
		thisWrapper.find('.phone-icons-image').eq(val).addClass('visible');
	});

	$('.phone-icons-description .entry').on('mouseleave', function () {
		$('.phone-icons-image').removeClass('visible');
	});


	/*==========================*/
	/* 09 - contact form submit */
	/*==========================*/
	var formPopupTimeout;
	$('.contact-form').each(function () {
		var jQuerythis = jQuery(this);
		$(this).on("submit", function () {

			clearTimeout(formPopupTimeout);

            var id = $(this).data('id'),
                toSendEmail = $(this).data('contact-email'),
                verification_type = $(this).data('verification'),
                name = $.trim($('#contactName' + id).val()),
                email = $.trim($('#email' + id).val()),
                subject = $.trim($('#contactSubject' + id).val()) ? $.trim($('#contactSubject' + id).val()) : '',
                message = $.trim($('#comments' + id).val()),
                antispam_answer = $.trim($('#contactAntispam' + id).val()),
                antispam_cpatcha = $.trim($('#captcha' + id).val());

            jQuery.post(omni_ajax_object.ajax_url, {
                    'action': 'omni_send_message',
                    'id': id,
                    'name': name,
                    'email': email,
                    'toSendEmail': toSendEmail,
                    'subject': subject,
                    'message': message,
                    'type': verification_type,
                    'answer': antispam_answer,
                    'captcha': antispam_cpatcha
                },
                function (response) {
                    var jsonObj = $.parseJSON('[' + response + ']');

                    if (jsonObj[0].status === "success") {
                        updateTextPopup(jsonObj[0].status, jsonObj[0].message);
                        jQuerythis.append('<input type="reset" class="reset-button"/>');
                        jQuery('.reset-button').click().remove();
                        jQuerythis.find('.focus').removeClass('focus');
                        $('.form-popup .text').text(jsonObj[0].message);
                        $('.form-popup').fadeIn(300);
                        formPopupTimeout = setTimeout(function () {
                            $('.form-popup').fadeOut(300);
                            jQuerythis.find("input, textarea").val("");
                        }, 3000);

                    } else if (jsonObj[0].status === "error") {
                        $('.form-popup .text').text(jsonObj[0].message);
                        $('.form-popup').fadeIn(300);
                        formPopupTimeout = setTimeout(function () {
                            $('.form-popup').fadeOut(300);
                        }, 3000);

                    }

                });

            return false;
		});
	});

	function updateTextPopup(title, text){
		jQuery('.text-popup .text-popup-title').text(title);
		jQuery('.text-popup .text-popup-message').text(text);
		jQuery('.text-popup').addClass('active');
	}

	$(document).on('focus', '.error-class', function () {
		$(this).removeClass('error-class');
	});

	$('.form-popup-close-layer').on('click', function () {
		clearTimeout(formPopupTimeout);
		$('.form-popup').fadeOut(300);
	});

	$('.mouse-icon').on('click', function () {
		$('body, html').animate({'scroll-top': winH});
	});

	$('.back-to-top').on('click', function () {
		$('body, html').animate({'scroll-top': 0});
	});

	/*========================================*/
	/* 10 - Responsive wordpress video helper */
	/*========================================*/

	$(function () {
		$('.mejs-overlay-loading').closest('.mejs-overlay').addClass('load'); //just a helper class

		var $video = $('div.video video');
		var vidWidth = $video.attr('width');
		var vidHeight = $video.attr('height');

		$(window).on('resize load', function () {
			var targetWidth = $(this).width(); //using window width here will proportion the video to be full screen; adjust as needed
			$('div.wp-video, div.wp-video .mejs-container').css('height', Math.ceil(vidHeight * (targetWidth / vidWidth)));
		})
	});

	/*===========================================*/
	/* 11 - Dom modification for design proposes */
	/*===========================================*/
	$(document).ready(function () {
		jQuery(".widget-entry").find("select").wrap("<div class='select-wrapper'></div>");

		jQuery(".sml_subscribe_widget_display p label").each(function () {
			if (jQuery.trim(jQuery(this).text()) == "") {
				jQuery(this).css({"display": "none"})
			}
		});
	});


	/*===========================================*/
	/* 12 - Run sharrre script for share buttons */
	/*===========================================*/
	$(document).ready(function () {
		jQuery('.share-buttons-js').each(function () {
			jQuery(this).sharrre({
				share         : {
					facebook: true
				},
				template      : '<a href="#" class="facebookIcon"><i class="fa fa-facebook"></i></a><a href="#" class="linkedinIcon"><i class="fa fa-linkedin"></i></a><a class="googleIcon" href="#"><i class="fa fa-google-plus"></i></a><a class="twitterIcon" href="#"><i class="fa fa-twitter"></i></a>',
				enableHover   : false,
				enableTracking: false,
				render        : function (api, options) {

					jQuery(api.element).on('click', '.facebookIcon', function () {

						api.openPopup('facebook');
					});
					jQuery(api.element).on('click', '.linkedinIcon', function () {

						api.openPopup('linkedin');
					});
					jQuery(api.element).on('click', '.googleIcon', function () {

						api.openPopup('googlePlus');
					});
					jQuery(api.element).on('click', '.twitterIcon', function () {

						api.openPopup('twitter');
					});
				}
			});
		});
	});


	jQuery('li.menu-item-has-children > a').doubleTapToGo();

})(jQuery);

jQuery.fn.touchScrolling = function () {
	var startPos = 0,
		self = $(this);

	self.bind('touchstart', function (event) {
		var e = event.originalEvent;
		startPos = self.scrollTop() + e.touches[0].pageY;
		e.preventDefault();
	});

	self.bind('touchmove', function (event) {
		var e = event.originalEvent;
		self.scrollTop(startPos - e.touches[0].pageY);
		e.preventDefault();
	});
};

/*!
 swap search in sidebar menu
 */

jQuery(document).ready(function () {

	if (jQuery(".sidebar-menu-added").length) {

		var stuff = jQuery('.menu-search');
		stuff.clone().addClass("cloned");
		jQuery('#menu-home-sidebar-menu').after(stuff);

	}

	/* ==============================================
	 Magnific popup
	 =============================================== */

	jQuery('.play-embed-video-js').magnificPopup({
		type     : 'iframe',
		preloader: false
	});
	//gallery detail popup
	var close_text = jQuery('.sorting-container').data('close-text');
	var prev_text = jQuery('.sorting-container').data('prev-text');
	var next_text = jQuery('.sorting-container').data('next-text');
	var counter_text = jQuery('.sorting-container').data('counter-text');

	jQuery('.sorting-container').magnificPopup({
		delegate    : 'a',
		type        : 'image',
		tClose      : close_text,
		gallery     : {
			tPrev   : prev_text,
			tNext   : next_text,
			tCounter: counter_text,
			enabled : true
		},
		callbacks   : {
			beforeOpen: function () {
				// just a hack that adds mfp-anim class to markup
				this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
				this.st.mainClass = 'mfp-zoom-in';
			}
		},
		removalDelay: 500
	});

});
