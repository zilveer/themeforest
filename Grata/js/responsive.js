jQuery(document).ready(function() {
	"use strict";

	var resizeTimer = null,
		videoInit = false,
		scrollInit = false,
		$window = jQuery(window);

	window.setVideoProportion = function() {
		jQuery('.l-section-video').each(function(){
			var container = jQuery(this);
			if (($window.width()-0) <= 1024) {
				return jQuery(this).hide();
			}
			var mejsContainer = container.find('.mejs-container'),
				poster = container.find('.mejs-mediaelement img'),
				video = container.find('video'),
				videoWidth = video.attr('width'),
				videoHeight = video.attr('height'),
				parent = container.parent(),
				parentWidth = parent.outerWidth(),
				parentHeight = parent.outerHeight(),
				proportion,
				centerX, centerY;
			if (mejsContainer.length == 0) return;
			// Proper sizing
			//if (video.length > 0 && video[0].player && video[0].player.media) videoWidth = video[0].player.media.videoWidth;
			//if (video.length > 0 && video[0].player && video[0].player.media) videoHeight = video[0].player.media.videoHeight;

			container.show();

			parent.find('span.mejs-offscreen').hide();
			parent.find('.mejs-controls').hide();

			proportion = (parentWidth/parentHeight > videoWidth/videoHeight)?parentWidth/videoWidth:parentHeight/videoHeight;
			container.width(proportion*videoWidth);
			container.height(proportion*videoHeight);

			poster.width(proportion*videoWidth);
			poster.height(proportion*videoHeight);

			centerX = (parentWidth < videoWidth*proportion)?(parentWidth - videoWidth*proportion)/2:0;
			centerY = (parentHeight < videoHeight*proportion)?(parentHeight - videoHeight*proportion)/2:0;

			container.css({ 'left': centerX, 'top': centerY });

			mejsContainer.css({width: '100%', height: '100%'});
			video.css({'object-fit': 'cover', 'display': 'inline-block'});

		});
	};

	window.resizeHandler = function(){
		var body = jQuery('body'),
			header = jQuery('.l-header'),
			firstSection = jQuery('.l-section').first(),
			firstSectionBottom,
			headerTop = 0,
			scrollOffsetTolerance = 0,
			H = jQuery(window).height()-0,// Browser window height
			W = jQuery(window).width()- 0,// Browser window width
			h,// header height, calculated depending on window width
			f = jQuery('.l-footer').height()-0;// footer height, affects .l-main bottom margin

		if (window.defaultHeaderHeight && window.mobileHeaderHeight) {
			if (W < 768) {
				jQuery('.l-header').css({'line-height': window.mobileHeaderHeight+'px'});
				if (body.hasClass('header_sticky')) {
					jQuery('.l-main').css({'padding-top': window.mobileHeaderHeight+'px'});
				}
				h = window.headerHeight = window.mobileHeaderHeight-0;
			} else {
				jQuery('.l-header').css({'line-height': window.defaultHeaderHeight+'px'});
				if (body.hasClass('header_sticky')) {
					jQuery('.l-main').css({'padding-top': window.defaultHeaderHeight+'px'});
				}
				h = window.headerHeight = window.defaultHeaderHeight-0;
			}
		}

		if (window.defaultLogoHeight && window.mobileLogoHeight) {
			if (W < 768) {
				jQuery('.w-logo-img').css({'height': window.mobileLogoHeight+'px'});
			} else {
				jQuery('.w-logo-img').css({'height': window.defaultLogoHeight+'px'});
			}
		}

		jQuery('.l-main').css('margin-bottom', f-1+'px');

		jQuery('.l-section.full_screen').each(function(){
			var section = jQuery(this),
				sectionH = section.find('.l-section-h');
			if (body.hasClass('header_sticky')) {
				section.css({'height': Math.max((H-h), (sectionH.outerHeight()-0))+'px'});
			} else {
				section.css({'height': Math.max((H), (sectionH.outerHeight()-0))+'px'});
			}
		});

		if (firstSection.hasClass('full_screen')) {
			var firstSectionH = firstSection.find('.l-section-h');
			if (( ! body.hasClass('header_sticky')) || (body.hasClass('header_sticky') && header.hasClass('type_default'))) {
				firstSection.css({'height': Math.max((H-h), (firstSectionH.outerHeight()-0))+'px'});
			} else {
				firstSection.css({'height': Math.max((H), (firstSectionH.outerHeight()-0))+'px'});
			}
		}

		jQuery('.l-section.full_screen.valign_center').each(function(){
			var section = jQuery(this),
				sectionH = section.find('.l-section-h'),
				heightDifference = section.height() - sectionH.outerHeight();
			if (heightDifference > 0) {
				sectionH.css('margin-top', heightDifference/2);
			} else {
				sectionH.css('margin-top', '');
			}
		});

		firstSectionBottom = firstSection.offset().top+(firstSection.height()*0.25);



		if (body.hasClass('header_sticky')) {
			scrollOffsetTolerance = h-1;
		}

		if (window.MediaElementPlayer){
			if (videoInit) {
				window.setVideoProportion();
			} else {
				videoInit = true;
				jQuery('.l-section-video video').mediaelementplayer({
					enableKeyboard: false,
					enableAutosize: true,
					iPadUseNativeControls: false,
					pauseOtherPlayers: false,
					iPhoneUseNativeControls: false,
					AndroidUseNativeControls: false,
					videoWidth: '100%',
					videoHeight: '100%',
					features: [],
					success: function (mediaElement, domObject) {
						window.setVideoProportion();
						jQuery(domObject).css('display', 'block');
					}
				});
			}
		}

		var linkScroll = function(event, link) {
			event.preventDefault();
			event.stopPropagation();

			jQuery("html, body").animate({
				scrollTop: jQuery(link.hash).offset().top-scrollOffsetTolerance+"px"
			}, {
				duration: 1200,
				easing: "easeInOutQuint"
			});
		};

		jQuery('a[class="w-logo-link"][href="#"]').off('click').click(function(event) {
			event.preventDefault();
			event.stopPropagation();
			jQuery("html, body").animate({
				scrollTop: 0
			}, {
				duration: 1200,
				easing: "easeInOutQuint"
			});
		});

		jQuery('a[class="w-toplink"]').off('click').on('click', function(event) {
			event.preventDefault();
			event.stopPropagation();
			jQuery("html, body").animate({
				scrollTop: 0
			}, {
				duration: 1200,
				easing: "easeInOutQuint"
			});
		});

		jQuery('a[href^="#"][href!="#"]').each(function() {
			if (jQuery(this).hasClass('w-nav-anchor') || jQuery(this).hasClass('g-btn') || jQuery(this).hasClass('smooth-scroll') || jQuery(this).hasClass('w-icon-link') || jQuery(this).hasClass('w-iconbox-link') || jQuery(this).hasClass('bbp-reply-permalink') || jQuery(this).parent().hasClass('slidelink')) {
				jQuery(this).off('click').on('click',function(event) {
					linkScroll(event, this);
				});
			}
		});

		if (scrollInit == false && document.location.hash && jQuery(document.location.hash).length) {
			jQuery(window).load(function(){
				scrollInit = true;

				jQuery("html, body").animate({
					scrollTop: jQuery(document.location.hash).offset().top-scrollOffsetTolerance+"px"
				}, {
					duration: 1200,
					easing: "easeInOutQuint"
				});
			});
		}

		var menuHandler = function(){
			jQuery('.l-header .w-nav').each(function(){
				var nav = jQuery(this),
					navControl = nav.find('.w-nav-control'),
					navList = nav.find('.w-nav-list.level_1'),
					navSubLists = navList.find('.w-nav-item.has_sublevel .w-nav-list'),
					navAnchors = nav.find('.w-nav-anchor'),
					navRunning = false,
					mobileNavWidth = 1000,
					W = jQuery(window).width()- 0;

				if (window.mobileNavWidth !== undefined) {
					mobileNavWidth = window.mobileNavWidth-0;
				}

				if (W <= mobileNavWidth) {
					var listOpen = false,
						navSubControls = navList.find('.w-nav-item.has_sublevel .w-nav-arrow');

					nav.removeClass('touch_disabled');

					if ( ! nav.hasClass('touch_enabled')) {
						nav.addClass('touch_enabled');
						navList.css({display: 'none'});
						navSubLists.css({display: 'none'});
					}

					if (body.hasClass('header_sticky')) {
						navList.css('max-height', H-h+'px');
					}

					navControl.off('click').click(function(){
						if ( ! navRunning) {
							navRunning = true;
							if (listOpen) {
								navList.slideUp(250, function(){
									navRunning = false;
								});
								nav.removeClass('open');
								listOpen = false;
							} else {
								navList.slideDown(250, function(){
									navRunning = false;
								});
								nav.addClass('open');
								listOpen = true;
							}
						}
					});

					navSubControls.off('click').click(function(){
						if ( ! navRunning) {
							navRunning = true;
							var subList = jQuery(this).closest('.w-nav-item').find('.w-nav-list').first(),
								subListOpen = subList.data('subListOpen'),
								currentNavItem = jQuery(this).closest('.w-nav-item');

							if (subListOpen) {
								subList.slideUp(250, function(){
									navRunning = false;
									currentNavItem.removeClass('open');
								});
								subListOpen = false;
							} else {
								subList.slideDown(250, function(){
									navRunning = false;
									currentNavItem.addClass('open');
								});
								subListOpen = true;
							}

							subList.data('subListOpen', subListOpen);
						}

						return false;
					});

					navAnchors.click(function(){
						if (W <= mobileNavWidth) {
							navRunning = true;
							navList.slideUp(250, function(){
								navRunning = false;
							});
							listOpen = false;
						}
					});

				} else {
					nav.removeClass('touch_enabled');
					if ( ! nav.hasClass('touch_disabled')) {
						nav.addClass('touch_disabled');
					}
					nav.removeClass('open');
					nav.find('.w-nav-item').removeClass('open');
					navList.css({height: '', display: '', 'max-height': ''});
					navSubLists.css({height: '', display: ''});
					navControl.off('click');

				}

			});
		};

		menuHandler();

		var scrollTimer = false,
			scrollHandler = function(){
				var scrollPosition	= parseInt(jQuery(window).scrollTop(), 10);

				if (scrollPosition >= H) {
					jQuery('.w-toplink').addClass('active');
				} else {
					jQuery('.w-toplink').removeClass('active');
				}
				if (body.hasClass('header_sticky') && body.hasClass('one_page_home')) {
					if ((firstSectionBottom-scrollOffsetTolerance) < scrollPosition) {
						if (body.hasClass('first_section')){
							body.removeClass('first_section');
						}
					} else {
						if ( ! body.hasClass('first_section')){
							body.addClass('first_section');
						}
					}
				}


				//Move trough each menu and check its position with scroll position then add current class
				jQuery('.w-nav-item a[href^=#]').each(function() {
					var thisHref = jQuery(this).attr('href');

					if (jQuery(thisHref).length) {
						var thisTruePosition = parseInt(jQuery(thisHref).offset().top, 10),
							thisPosition = thisTruePosition - h;

						if(scrollPosition >= thisPosition) {
							jQuery('.w-nav-item a[href^=#]').parents('.w-nav-item').removeClass('active');
							jQuery('.w-nav-item a[href='+ thisHref +']').parents('.w-nav-item').addClass('active');

							jQuery('.w-cart').each(function(){
								if (jQuery(this).hasClass('status_empty')) {
									jQuery(this).css('display', '');
								}
							});
							jQuery(thisHref).find('.w-cart').css('display', 'block');
						}
					}
				});


				//If we're at the bottom of the page, move pointer to the lal-section-hst section
				var bottomPage	= parseInt(jQuery(document).height(), 10) - parseInt(jQuery(window).height(), 10);

				if(scrollPosition >= bottomPage) {
					var lastSectionID = jQuery('.l-section:last').attr('id');
					if (jQuery('.w-nav-item a[href=#'+ lastSectionID +']').length) {
						jQuery('.w-nav-item a[href^=#]').parents('.w-nav-item').removeClass('active');
						jQuery('.w-nav-item a[href=#'+ lastSectionID +']').parents('.w-nav-item').addClass('active');
					}
				}
			};

		window.clearTimeout(scrollTimer);
		scrollHandler();

		jQuery(window).scroll(function(){
			window.clearTimeout(scrollTimer);
			scrollTimer = window.setTimeout(function(){
				scrollHandler();
			}, 20);
		});

	};

	window.resizeHandler();
	jQuery(window).load(function(){
		window.resizeHandler();
	});

	jQuery(window).resize(function(){
		window.clearTimeout(resizeTimer);
		resizeTimer = window.setTimeout(function(){
			window.resizeHandler();
		}, 50);

	});

	if (jQuery('.l-preloader').length)
	{
		var images = jQuery('.l-section').first().find('.l-section-h img'),
			preloaderLoadedImageCount = 0,
			preloaderTotalImageCount = 0,
			preloaderContainer = jQuery('.l-preloader');

		jQuery('.l-section-img').each(function(){
			var el = jQuery(this)
				, image = el.css('background-image').match(/url\((['"])?(.*?)\1\)/);
			if(image)
				images = images.add(jQuery('<img>').attr('src', image.pop()));
		});

		images.imagesLoaded().always(function(){
			window.resizeHandler();
			window.setTimeout(function(){
				jQuery('.l-preloader' ).animate({height: 0}, 300, function () {
					jQuery('.l-preloader').remove();

					if (jQuery().waypoint){
						jQuery('.animate_zoomIn, .animate_fadeIn, .animate_fadeInUp, .animate_fadeInDown, .animate_fadeInLeft, .animate_fadeInRight').waypoint(function() {
							if ( ! jQuery(this).hasClass('animate_start')){
								var elm = jQuery(this);
								setTimeout(function() {
									elm.addClass('animate_start');
								}, 20);
							}
						}, {offset:'75%', triggerOnce: true});

						jQuery('.w-counter').waypoint(window.counterFunction, window.counterOptions);
					}

				});
			}, 200);
		});

	} else {
		if (jQuery().waypoint){
			jQuery('.animate_zoomIn, .animate_fadeIn, .animate_fadeInUp, .animate_fadeInDown, .animate_fadeInLeft, .animate_fadeInRight').waypoint(function() {
				if ( ! jQuery(this).hasClass('animate_start')){
					var elm = jQuery(this);
					setTimeout(function() {
						elm.addClass('animate_start');
					}, 20);
				}
			}, {offset:'75%', triggerOnce: true});

			jQuery('.w-counter').waypoint(window.counterFunction, window.counterOptions);
		}

	}

});
