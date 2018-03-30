/*global jQuery,google,AnimOnScroll */
(function(){
	
	// USE STRICT
	"use strict";
	
	/////////////////////////////////////////////
	// PAGE FUNCTIONS
	/////////////////////////////////////////////
	
	var page = {
		init: function () {
			
			// BROWSER CHECK
			jQuery.browser = {};
			jQuery.browser.mozilla = /mozilla/.test(navigator.userAgent.toLowerCase()) && !/webkit/.test(navigator.userAgent.toLowerCase());
			jQuery.browser.webkit = /webkit/.test(navigator.userAgent.toLowerCase());
			jQuery.browser.opera = /opera/.test(navigator.userAgent.toLowerCase());
			jQuery.browser.msie = /msie/.test(navigator.userAgent.toLowerCase());
			jQuery.browser.msieMobile10 = /iemobile\/10\.0/.test(navigator.userAgent.toLowerCase());
					
			// BODY CLASSES
			if (isMobileAlt) {
				body.addClass("mobile-browser");
			} else {
				body.addClass("standard-browser");
			}
			if (isIEMobile) {
				body.addClass("ie-mobile");
			}
			if (isAppleDevice) {
				body.addClass("apple-mobile-browser");
			}
			if (body.hasClass("woocommerce-page") && !body.hasClass("woocommerce")) {
				body.addClass("woocommerce");
			}
			// ADD IE CLASS
			if (IEVersion && IEVersion < 10) {
				body.addClass('browser-ie');
			}
			
			// ADD IE10 CLASS
			var pattern = /MSIE\s([\d]+)/,
				ua = navigator.userAgent,
				matched = ua.match(pattern);
			if (matched) {
				body.addClass('browser-ie10');
			}
			
			if (jQuery.browser.mozilla) {
				body.addClass('browser-ff');
			}
			
			// ADD IE11 CLASS
			var isIE11 = !!navigator.userAgent.match(/Trident.*rv\:11\./);
			if (isIE11) {
				body.addClass('browser-ie11');
			}
			
			
			// ONE PAGE NAV
			if (jQuery('#one-page-nav').length > 0) {
				page.onePageNav();
			}
			
			// BACK TO TOP
			if (jQuery('#back-to-top').length > 0) {
				$window.scroll(function() {
					page.backToTop();
				});
			}
			
			// CAROUSEL GRAB POINTER FUNCTIONALITY
			if (!isMobileAlt) {
				body.on('mousedown', '.caroufredsel_wrapper', function() {
					jQuery(this).addClass('isSwiping');
				});
				body.on('mouseup', '.caroufredsel_wrapper', function() {
					jQuery(this).removeClass('isSwiping');
				});
			}
			
			// FANCY HEADING
			if (jQuery('.fancy-heading').length > 0) {
				page.fancyHeading();
			}
									
			// FITVIDS
			//page.fitVids();
			
			// SMOOTH SCROLL
			if (isMobile && !jQuery.browser.msieMobile10 && !isIEMobile) {
				page.niceScroll();
			}
			
			if (jQuery('#page-wrap').has('.full-width-display-wrap')) {
				page.fullscreenMedia();
				$window.smartresize( function() {
					page.fullscreenMedia();
				});			
			}
			
			// MOVE MODALS TO BOTTOM OF PAGE
			jQuery(".modal").each(function(){
				jQuery(this).appendTo("body");
			});
			
			// LOAD MAP ASSET ON MODAL CLICK
			jQuery('a[data-toggle="modal"]').on('click', function() {
				setTimeout(function() {
					map.init();						
				}, 300);
				
				return true;
			});
			
			// REFRESH MODAL IFRAME ON CLOSE (FOR VIDEOS)
			jQuery(".modal-backdrop, .modal .close, .modal .btn").on("click", function() {
				jQuery(".modal iframe").each(function() {
					var thisModal = jQuery(this);
					thisModal.attr("src", thisModal.attr("src"));
				});
			});
			
			// REPLACE COMMENTS REPLY TITLE HTML
			if (body.hasClass('single-post')) {
				var replyTitle = jQuery('#respond').find('h3');
				var originalText = jQuery('#respond').find('h3').html();
				
				replyTitle.addClass('spb-heading');
				replyTitle.html('<span>'+originalText+'</span>');
			}
			
			// SMOOTH SCROLL LINKS
			jQuery('a.smooth-scroll-link').on('click', function(e) {
				
				var linkHref = jQuery(this).attr('href');
								
				if (linkHref.indexOf('#') === 0) {
					var spacerHeight = jQuery(linkHref).height(),
						headerHeight = 0;
						
					if (jQuery('.sticky-header').length > 0) {
						headerHeight = jQuery('.sticky-header').height();
					}
					if (jQuery('#wpadminbar').length > 0) {
						headerHeight = headerHeight + 28;
					}
					
					jQuery('html, body').stop().animate({
						scrollTop: jQuery(linkHref).offset().top + spacerHeight - headerHeight - 10
					}, 1000, 'easeInOutExpo');
					
					e.preventDefault();
					
				} else {
					return e;
				}
				
			});
			
			// STICKY SIDEBAR
			if (!isMobileAlt && sfIncluded.hasClass('stickysidebars') && jQuery('.sidebar').length > 0) {
				page.stickySidebars();
			}
			
			// PORTFOLIO STICKY SIDEBAR	
			if (!isMobileAlt && jQuery('.sticky-details').length > 0) {
				//portfolio.stickyDetails();
			}
			
			// BUDDYPRESS ACTIVITY LINK CLICK
			jQuery('.activity-time-since,.bp-secondary-action').on('click', function(e) {
				e.preventDefault();
				jQuery('.viewer').css('display', 'none');
				window.location = jQuery(this).attr('href');
			});
		},
		fitVids: function() {
			//jQuery('.portfolio-items:not(.carousel-items),.blog-items:not(.carousel-items),article.type-portfolio,article.type-post,article.type-team,.spb_video_widget,.infocus-item,.recent-posts,.full-width-detail,#activity-stream').fitVids();
		},
		niceScroll: function() {
			jQuery("html").niceScroll({	
				scrollspeed: 50,
				zindex: 999,
				mousescrollstep: 30,
				horizrailenabled: false
			});
		},
		fancyHeading: function() {
			jQuery('body,html').scrollTop(0);
			if (jQuery('.fancy-heading').hasClass('fancy-image')) {
				jQuery('.fancy-heading').parallax("50%", 0.5);
			}
			setTimeout(function() {
				jQuery('.fancy-heading').slideDown({
					duration: 600, 
					easing: "easeInOutQuart" 
				});		
			}, 200);
			$window.scroll(function() {
				if ($window.width() > 767) {
					var scrollTop = $window.scrollTop();
					var isSafari = deviceAgent.indexOf("safari") !=-1 && deviceAgent.indexOf("chrome") == -1;
					
					if (!(isSafari)) {
						
						var paddingBottom = (120 - scrollTop / 5 > 0) ? 120 - scrollTop / 5 : 0,
							letterSpacing = (scrollTop / 35 < 10) ? scrollTop / 35 : 10;
						
						jQuery(".fancy-heading").css("opacity", 1 - scrollTop / 300).css('padding-bottom', paddingBottom + "px");
						jQuery(".fancy-heading .heading-text").css("opacity", 1 - scrollTop / 180).css("letter-spacing", letterSpacing);
					}
				}
			});
		},
		fullscreenMedia: function() {
			var fullscreenMedia = jQuery('.full-width-display-wrap'),
				container = jQuery('#page-wrap'),
				mediaOffset = container.offset().left,
				windowWidth = $window.width();

			if (windowWidth > 768) {
				mediaOffset = mediaOffset;
			} else {
				mediaOffset = 24;
			}
			
			if (jQuery('#container').hasClass('boxed-layout')) {
				windowWidth = jQuery('#container').width() + 2;
				
				if (windowWidth > 1026) {
					mediaOffset = 45;
				} else if (windowWidth > 770) {
					mediaOffset = 30;
				} else if (windowWidth > 482) {
					mediaOffset = 24;
				} else {
					mediaOffset = 7;
				}
			}
						
			fullscreenMedia.find('figure').css('width', windowWidth).css('margin-left', '-' + mediaOffset + 'px');
			
			if (!fullscreenMedia.find('figure').is(":visible")) {
				fullscreenMedia.find('figure').slideDown(500);
			} else {
				var slider = fullscreenMedia.find('.item-slider').data('flexslider');
				if (slider) {
				slider.resize();
				}
			}
			
			if (fullscreenMedia.find('.portfolio-options-bar').length > 0) {
				setTimeout(function() {
					fullscreenMedia.find('.portfolio-options-bar').animate({
						opacity: 1
					}, 200);				
				}, 700);
			}
		},
		fullWidthArea: function() {
			var fullWidthArea = jQuery('.full-width-area'),
				container = jQuery('#page-wrap'),
				mediaOffset = container.offset().left,
				windowWidth = $window.width();

			if (windowWidth > 768) {
				mediaOffset = mediaOffset;
			} else {
				mediaOffset = 24;
			}
			
			if (jQuery('#container').hasClass('boxed-layout')) {
				windowWidth = jQuery('#container').width() + 2;
				
				if (windowWidth > 1026) {
					mediaOffset = 45;
				} else if (windowWidth > 770) {
					mediaOffset = 30;
				} else if (windowWidth > 482) {
					mediaOffset = 24;
				} else {
					mediaOffset = 7;
				}
			}
						
			fullWidthArea.each( function() {
				jQuery(this).css('width', windowWidth).css('margin-left', '-' + mediaOffset + 'px');
			});
		},
		onePageNav: function() {
				
			var onePageNav = jQuery('#one-page-nav'),
				onePageNavList = onePageNav.find('ul'),
				onePageNavItems = "",
				mainContent = jQuery('.page-content');
			
			mainContent.find('.blank_spacer').each(function() {
				var linkID = jQuery(this).attr('id'),
					linkName = jQuery(this).data('spacername');
				
				if (linkID && linkName.length > 0) {
					onePageNavItems += '<li><a href="#'+linkID+'" rel="tooltip" data-original-title="'+linkName+'" data-placement="left"><i></i></a></li>';
				}
			});
			
			if (onePageNavItems.length > 0) {
				onePageNavList.append(onePageNavItems);	
				onePageNav.vCenter();
				setTimeout(function() {
					onePageNav.stop().animate({
						'right': '40px',
						'opacity': 1
					}, 1000, "easeOutQuart");
					
					jQuery('#one-page-nav ul li a').bind('click', function(e) {
						var anchor = jQuery(this),
							spacerHeight = jQuery(anchor.attr('href')).height(),
							headerHeight = 0;
							
						if (jQuery('.sticky-header').length > 0) {
							headerHeight = jQuery('.sticky-header').height();
						}
						if (jQuery('#wpadminbar').length > 0) {
							headerHeight = headerHeight + 28;
						}
						
						jQuery('html, body').stop().animate({
							scrollTop: jQuery(anchor.attr('href')).offset().top + spacerHeight - headerHeight - 30
						}, 1000, 'easeInOutExpo');
						
						e.preventDefault();
					});
					
					$window.scroll(function () {
						var currentSection = jQuery('.blank_spacer:in-viewport:first').data('spacername');

						if (onePageNav.is(':visible') && currentSection) {
							onePageNavList.find('li').removeClass('selected');					
							onePageNavList.find('li a[data-original-title="'+currentSection+'"]').parent().addClass('selected');
						}
					});
					
				}, 1000);
			}
		},
		backToTop: function() {
			var scrollPosition = $window.scrollTop();
						
			if (scrollPosition > 300) {
				jQuery('#back-to-top').stop().animate({
					'bottom': '10px',
					'opacity': 1
				}, 300, "easeOutQuart");
			} else if (scrollPosition < 300) {
				jQuery('#back-to-top').stop().animate({
					'bottom': '-40px',
					'opacity': 0
				}, 300, "easeInQuart");
			}
		},
		stickySidebars: function() {
		
			var stickyWidget = jQuery('.sticky-widget'),
				sidebar = stickyWidget.parent(),
				content = jQuery('.page-content'),
				offset = 24;

			if (jQuery('.sticky-header').length > 0) {
				offset = offset + jQuery('.sticky-header').height() > 0 ? jQuery('.sticky-header').height() : jQuery('#header-section').height();
			}
			if (jQuery('#wpadminbar').length > 0) {
				offset = offset + 32;
			}

			page.initStickyWidget(stickyWidget, sidebar, offset);

			$window.smartresize( function() {
				jQuery('.inner-page-wrap').stickem().destroy();
				page.resizeStickyWidget(stickyWidget, sidebar);
				page.initStickyWidget(stickyWidget, sidebar, offset);
			});

		},
		initStickyWidget: function(stickyWidget, sidebar, offset) {
			jQuery('.inner-page-wrap').stickem({
				item: '.sticky-widget',
				container: '.inner-page-wrap',
				offset: offset + 24,
				onStick: function() {
					page.resizeStickyWidget(stickyWidget, sidebar);
				}
			});
		},
		resizeStickyWidget: function(stickyWidget, sidebar) {
			var headerHeight = 0,
				content = jQuery('.page-content'),
				sidebarHeight = sidebar.find('.sidebar-widget-wrap').height(),
				contentHeight = content.height();

			if (jQuery('.sticky-header').length > 0) {
				headerHeight = jQuery('.sticky-header').height() > 0 ? jQuery('.sticky-header').height() : jQuery('#header-section').height();
			}
			if (jQuery('#wpadminbar').length > 0) {
				headerHeight = headerHeight + 32;
			}
			stickyWidget.css('width', sidebar.width()).css('top', headerHeight + 30);
			if (contentHeight > sidebarHeight) {
				sidebar.css('height', contentHeight);
			} else {
				sidebar.css('height', sidebarHeight);
			}
		},
		getViewportHeight: function() {
			var height = "innerHeight" in window ? window.innerHeight: document.documentElement.offsetHeight; 
			return height;		
		},
		checkIE: function() {
			// ----------------------------------------------------------
			// A short snippet for detecting versions of IE in JavaScript
			// without resorting to user-agent sniffing
			// ----------------------------------------------------------
			// If you're not in IE (or IE version is less than 5) then:
			//     ie === undefined
			// If you're in IE (>=5) then you can determine which version:
			//     ie === 7; // IE7
			// Thus, to detect IE:
			//     if (ie) {}
			// And to detect the version:
			//     ie === 6 // IE6
			//     ie > 7 // IE8, IE9 ...
			//     ie < 9 // Anything less than IE9
			// ----------------------------------------------------------
			
			// UPDATE: Now using Live NodeList idea from @jdalton
			var undef,
				v = 3,
				div = document.createElement('div'),
				all = div.getElementsByTagName('i');
				
			while (
				div.innerHTML = '<!--[if gt IE ' + (++v) + ']><i></i><![endif]-->',
				all[0]
			);
			
			return v > 4 ? v : undef;
		}
	};

	
	/////////////////////////////////////////////
	// SUPER SEARCH
	/////////////////////////////////////////////
		
	var superSearch = {
		init: function() {
			
			var deviceAgent = navigator.userAgent.toLowerCase(),
				agentID = deviceAgent.match(/(iphone|ipod|ipad|android|iemobile)/);
			
			jQuery('.search-go').vCenter();
			
			jQuery('.search-options .ss-dropdown').on('click', function(e) {
				e.preventDefault();
				
				var option = jQuery(this),
					dropdown = option.find( 'ul' );
								
				if (agentID) {
					if (dropdown.hasClass('show-dropdown')) {
						dropdown.removeClass('show-dropdown');
					} else {
						dropdown.addClass('show-dropdown');							
					}
				} else {
					if (dropdown.hasClass('show-dropdown')) {
						dropdown.css('top', 30);
						dropdown.removeClass('show-dropdown');
					} else {
						dropdown.css('top', -10);
						dropdown.addClass('show-dropdown');							
					}
				}
			});
						
			jQuery('.ss-option').on('click', function(e) {
				e.preventDefault();
				
				var selectedOption = jQuery(this).attr('data-attr_value');
				var parentOption = jQuery(this).parent().parent().parent();
								
				parentOption.find('li').removeClass('selected');
				jQuery(this).parent().addClass('selected');
				
				parentOption.attr('data-attr_value', selectedOption);
				parentOption.find('span').text(jQuery(this).text());
			});
			
			jQuery('.swift-search-link').on('click', function(e) {
				e.preventDefault();
				
				if (jQuery('#header > div').hasClass('is-sticky')) {
					jQuery('body,html').animate({scrollTop: 0}, 400);
					jQuery('body').addClass('header-aux-opening');
					setTimeout(function() {
						header.headerAuxShow('super-search');
					}, 500);
				} else {
					header.headerAuxShow('super-search');
				}
			});

			jQuery('.super-search-go').on('click', function(e) {
				e.preventDefault();
				var parentSearch = jQuery(this).parents('.sf-super-search'),
					filterURL = superSearch.urlBuilder(parentSearch),
					homeURL = jQuery(this).attr('data-home_url'),
					shopURL = jQuery(this).attr('data-shop_url');
				
				if (filterURL.indexOf("product_cat") >= 0) {
				location.href = homeURL + filterURL;
				} else {
				location.href = shopURL + filterURL;
				}
				
			});
			
			jQuery('.super-search-close').on('click', function(e) {
				e.preventDefault();
				header.headerAuxClose();
			});
		
		},
		urlBuilder: function(searchInstance) {
			
			var queryString = "";
			
			jQuery(searchInstance).find('.search-options .ss-dropdown').each(function() {
				
				var attr = jQuery(this).attr('id');
				var attrValue = jQuery(this).attr('data-attr_value');
				if (attrValue !== "") {
					if (attr === "product_cat") {
						if (queryString === "") {
							queryString += "?product_cat=" + attrValue;
						} else {
							queryString += "&product_cat=" + attrValue;
						}
					} else {
						if (queryString === "") {
						queryString += "?filter_" + attr + "=" + attrValue;				
						} else {
						queryString += "&filter_" + attr + "=" + attrValue;									
						}
					}
				}
			});
			
			jQuery('.search-options input').each(function() {
				var attr = jQuery(this).attr('name');
				var attrValue = jQuery(this).attr('value');
				if (queryString === "") {
					queryString += "?"+ attr + "=" + attrValue;				
				} else {
					queryString += "&" + attr + "=" + attrValue;									
				}
			});
			
			return queryString;
		}
	};
	
	
	/////////////////////////////////////////////
	// HEADER
	/////////////////////////////////////////////
		
	var header = {
		init: function() {
			
			var stickyHeaderMobile = !isMobileAlt,
				lastAjaxSearchValue = "",
				searchTimer = false;
			
			if (sfIncluded.hasClass('sticky-header-mobile')) {
				stickyHeaderMobile = true;
			}
			
			if (body.hasClass('header-overlay')) {
				header.headerOverlaySet();
				$window.smartresize( function() {  
					header.headerOverlaySet();
				});
			}
									
			if (body.hasClass('mini-header-enabled') && stickyHeaderMobile) {
				header.stickyHeaderInit();
				$window.scroll(function() { 
					var scrollTop = $window.scrollTop(),
						stickyHeader = jQuery('.sticky-header'),
						headerHeight = jQuery('#header-section').height(),
						headerTop = jQuery('#header-section').offset().top;
					
					if (jQuery('#top-bar').length > 0) {
						headerHeight = headerHeight + jQuery('#top-bar').height();
					}
					
					if (scrollTop >= headerTop + headerHeight + 30) {
						stickyHeader.addClass('sticky-header-resized');
					} else if (stickyHeader.hasClass('sticky-header-resized')) {
						stickyHeader.removeClass('sticky-header-resized');
					}
				});	
			}
			
			jQuery('.header-search-link').on('click', function(e) {
				e.preventDefault();
				
				if (jQuery('#header > div').hasClass('is-sticky')) {
					jQuery('body,html').animate({scrollTop: 0}, 400);
					jQuery('body').addClass('header-aux-opening');
					setTimeout(function() {
						header.headerAuxShow('search');
					}, 500);
				} else {
					header.headerAuxShow('search');
				}
			});
			
			jQuery('.header-search-link-alt').on('click', function(e) {
				e.preventDefault();
				
				var ajaxSearchWrap = jQuery('.ajax-search-wrap');
				
				if (ajaxSearchWrap.is(':visible')) {
					ajaxSearchWrap.fadeOut(300);
					setTimeout(function() {
						jQuery('.ajax-search-results').slideUp(100).empty();
						jQuery('.ajax-search-form input[name=s]').val('');
					}, 300);
				} else {
					ajaxSearchWrap.fadeIn(300);
					setTimeout(function() {
						jQuery('.ajax-search-form input[name=s]').focus();
						jQuery("#container").bind("click", function(e) {
							var ajaxSearchWrap = jQuery('.ajax-search-wrap');
							if (!jQuery(e.target).closest('.ajax-search-wrap').length) {
								ajaxSearchWrap.fadeOut(300);
								setTimeout(function() {
									jQuery('.ajax-search-results').slideUp(100).empty();
									jQuery('.ajax-search-form input[name=s]').val('');
								}, 300);
								jQuery("#container").unbind("click");
							}
						});
					}, 300);
				}
				
			});

			jQuery('.ajax-search-form input[name=s]').on('keyup', function(e) {
				var searchvalue = e.currentTarget.value;

				clearTimeout(searchTimer);								
				if (lastAjaxSearchValue != jQuery.trim(searchvalue) && searchvalue.length >= 3) {
					searchTimer = setTimeout( function() {
						header.ajaxSearch(e);
					}, 400);
				}
			});
			
			jQuery('#header-search-close').on('click', function(e) {
				e.preventDefault();
				header.headerAuxClose();
			});
			
			jQuery('#header-search input').on('blur', function() {
				header.headerAuxClose();
			});
			
			$window.scroll(function() { 
				var scrollTop = $window.scrollTop();
				
				if (scrollTop > 100 && jQuery('body').hasClass('header-aux-open') && !jQuery('body').hasClass('header-aux-opening')) {
					header.headerAuxClose();
				}
			});				
		},
		stickyHeaderInit: function() {
			
			var spacing = 0;
			
			if (jQuery('#wpadminbar').length > 0) {
				spacing = jQuery('#wpadminbar').height();
			}
			
			if (isMobileAlt && sfIncluded.hasClass('sticky-header-mobile')) {
				jQuery('.header-wrap').sticky({
					topSpacing: spacing
				});
			} else {
				jQuery('.sticky-header').sticky({
					topSpacing: spacing
				});
			}
		},
		headerOverlaySet: function() {
			var headerWrapHeight = jQuery('.header-wrap').height();
									
			if (jQuery('#main-container').find('#swift-slider').length === 0 && jQuery('#main-container').find('.home-slider-wrap').length === 0 && jQuery('#main-container').find('.page-heading').length === 0) {
				jQuery('.inner-page-wrap').animate({
					'padding-top': headerWrapHeight + 30
				}, 300);
			} else if (!(jQuery('#main-container').find('#swift-slider').length > 0 || jQuery('#main-container').find('.home-slider-wrap').length > 0)) {
				if (jQuery('.page-heading').hasClass('fancy-heading')) {
					jQuery('.page-heading').animate({
						'padding-top': headerWrapHeight + 110
					}, 300);
				} else {
					jQuery('.page-heading').animate({
						'padding-top': headerWrapHeight + 35
					}, 300);
				}
			}
			
			if (jQuery('#main-container').find('#swift-slider').length > 0 || jQuery('#main-container').find('.home-slider-wrap').length > 0) {
				if (jQuery('.page-heading').hasClass('fancy-heading')) {
				jQuery('.page-heading').css('padding-top', 120);
				} else {
				jQuery('.page-heading').css('padding-top', 35);
				}
			}
		},
		headerAuxShow: function(type) {
			jQuery('body').addClass('header-aux-open');
			if (type == "search") {
				if (jQuery('body > #super-search:visible')) {
					header.headerSuperSearchFadeOut();
				}
				if (IEVersion && IEVersion < 9) {
					jQuery('#header-search').show();
				} else {
					jQuery('#header-search').animate({
						'opacity': 1
					}, 500).css('z-index', '100');
				}
				jQuery('#header-search input').focus();
			} else if (type == "super-search") {
				if (jQuery('#header-search:visible')) {
					header.headerSearchFadeOut();
				}
				if (IEVersion && IEVersion < 9) {
					setTimeout(function() {
						jQuery('body > #super-search').show();
					}, 400);
				} else {
					setTimeout(function(){
						jQuery('body > #super-search').animate({
							'opacity': 1
						}, 500).css('z-index', '100');
					}, 400);
				}
				jQuery('body').addClass('ss-open');
			}
			setTimeout(function() {
				jQuery('body').removeClass('header-aux-opening');
			}, 500);			
		},
		headerAuxClose: function() {
			jQuery('body').removeClass('header-aux-open');
			jQuery('body').addClass('header-aux-closing');
				header.headerSearchFadeOut();
				header.headerSuperSearchFadeOut();
			setTimeout(function() {
				jQuery('body').removeClass('header-aux-closing');
			}, 700);
		},
		headerSearchFadeOut: function() {
			if (IEVersion && IEVersion < 9) {
				jQuery('#header-search').hide();
			} else {
				jQuery('#header-search').animate({
					'opacity': 0
				}, 500).css('z-index', '');
			}
		},
		headerSuperSearchFadeOut: function() {
			if (IEVersion && IEVersion < 9) {
				jQuery('body > #super-search').hide();
			} else {
				jQuery('body > #super-search').animate({
					'opacity': 0
				}, 500).css('z-index', '');
			}
			jQuery('body').removeClass('ss-open');
		},
		ajaxSearch: function(e) {			
			var searchInput = jQuery(e.currentTarget),
				searchValues = searchInput.parents('form').serialize() + '&action=sf_ajaxsearch',
				results = jQuery('.ajax-search-results'),
				loadingIndicator = jQuery('.ajax-search-wrap .ajax-loading');
						
			jQuery.ajax({
				url: ajaxurl,
				type: "POST",
				data: searchValues,
				beforeSend: function() {
					loadingIndicator.fadeIn(50);
				},
				success: function(response) {
					if (response === 0) {
						response = "";
					} else {
						results.html(response);
					}
				},
				complete: function() {
					loadingIndicator.fadeOut(200);
					results.slideDown(400);
				}
			});
		}
	};
	
	
	/////////////////////////////////////////////
	// NAVIGATION
	/////////////////////////////////////////////
	
	var nav = {
		init: function() {
			
			// Add parent class to items with sub-menus
			jQuery("ul.sub-menu").parents('.menu-item').addClass('parent');
			
			// Menu parent click function
			jQuery('.menu li.parent > a').on('click', function(e) {
			
				if (jQuery('#container').width() < 1024 || body.hasClass('standard-browser')) {
					return e;
				}
				
				var directDropdown = jQuery(this).parent().find('ul.sub-menu').first();
				
				if (directDropdown.css('opacity') === '1' || directDropdown.css('opacity') === 1) {
					return e;
				} else {
					e.preventDefault();
				}
			});
			
			var menuTop = 40;
			var menuTopReset = 80;
			
			// Enable hover dropdowns for window size above tablet width
			jQuery("nav.std-menu").find(".menu li.parent").hoverIntent({
				over: function() {
					if (jQuery('#container').width() > 767 || body.hasClass('responsive-fixed')) {
						
						// Setup menuLeft variable, with main menu value
						var subMenuWidth = jQuery(this).find('ul.sub-menu').first().outerWidth(true);
						var mainMenuItemWidth = jQuery(this).outerWidth(true);
						var menuLeft = '-' + (Math.round(subMenuWidth / 2) - Math.round(mainMenuItemWidth / 2)) + 'px';
						var menuContainer = jQuery(this).parent().parent();
												
						// Check if this is the top bar menu		
						if (menuContainer.hasClass("top-menu") || menuContainer.parent().hasClass("top-menu")) {
							if (menuContainer.parent().parent().hasClass("tb-right")) {
							menuLeft = "";
							} else {
							menuLeft = "-1px";
							}
							menuTop = 31;
							menuTopReset = 40;
						} else if (menuContainer.hasClass("header-menu")) {
							menuLeft = "-1px";
							menuTop = 28;
							menuTopReset = 40;
						} else if (menuContainer.hasClass("search-nav")) {
							menuTop = 44;
							menuTopReset = 64;
						} else if (jQuery('#header-section').hasClass('header-1') || jQuery('#header-section').hasClass('header-2')) {
							menuTop = 47;
							menuTopReset = 67;
						} else {
							menuTop = 44;
							menuTopReset = 64;
						}
						
						// Check if second level dropdown
						if (jQuery(this).find('ul.sub-menu').first().parent().parent().hasClass("sub-menu")) {
							menuLeft = jQuery(this).find('ul.sub-menu').first().parent().parent().outerWidth(true) - 2;
						}
						
						jQuery(this).find('ul.sub-menu').first().addClass('show-dropdown').css('top', menuTop);
					}
				},
				out:function() {
					if (jQuery('#container').width() > 767 || body.hasClass('responsive-fixed')) {
						jQuery(this).find('.sub-menu').first().removeClass('show-dropdown').css('top', menuTopReset);
					}
				}
			});
			
			jQuery(".shopping-bag-item").on("mouseenter", function() {
				
				var subMenuTop = 44,
					subMenuTopReset = 64;
				
				if (jQuery(this).parent().parent().hasClass("top-menu")) {
					subMenuTop = 31;
					subMenuTopReset = 40;
				} else if (jQuery(this).parent().parent().hasClass("mini-menu")) {
					subMenuTop = 40;
					menuTopReset = 60;
				} else if (jQuery('#header-section').hasClass('header-1') || jQuery('#header-section').hasClass('header-2')) {
					subMenuTop = 47;
					menuTopReset = 67;
				}
				
				jQuery(this).find('ul.sub-menu').first().addClass('show-dropdown').css('top', subMenuTop);
				
			}).on("mouseleave", function() {
				if (jQuery('#container').width() > 767 || body.hasClass('responsive-fixed')) {
					jQuery(this).find('ul.sub-menu').first().removeClass('show-dropdown').css('top', 56);
				}
			});
			
			
			jQuery('.menu-item').on('click', 'a', function(e) {
				
				var isMobile = false;
				
				if (jQuery(this).parents('#mobile-menu').length > 0) {
					isMobile = true;
				}
				
				var linkHref = jQuery(this).attr('href');
							
				if (linkHref.indexOf('#') === 0) {
					var spacerHeight = jQuery(linkHref).height(),
						headerHeight = 0;
						
					if (jQuery('.sticky-header').length > 0) {
						headerHeight = jQuery('.sticky-header').outerHeight();
					}
					if (jQuery('#wpadminbar').length > 0) {
						headerHeight += jQuery('#wpadminbar').outerHeight();
					}
					
					if (jQuery(linkHref).length > 0) {
						jQuery('html, body').stop().animate({
							scrollTop: jQuery(linkHref).offset().top + spacerHeight - headerHeight - 20
						}, 1000, 'easeInOutExpo');
					}
					
					if (isMobile) {
						nav.hideMobileMenu();
					}
					
					e.preventDefault();
				} else {
					return e;
				}
				
			});
		
			// Toggle Mobile Nav show/hide			
			jQuery('.mobile-menu-show').on('click', function(e) {
				e.preventDefault();
				if (body.hasClass('mobile-menu-open')) {
				nav.hideMobileMenu();
				} else {
				nav.showMobileMenu();
				}
			});
			
			jQuery('.mobile-menu-close').on('click', function(e) {
				e.preventDefault();
				nav.hideMobileMenu();
			});
		
			$window.smartresize( function() {  
				if (jQuery('#container').width() > 767 || body.hasClass('responsive-fixed')) {
					var menus = jQuery('nav').find('ul.menu');
					menus.each(function() {
						jQuery(this).css("display", "");
					});
				}
			});
			
			// Set current language to top bar item
			var currentLanguage = jQuery('li.aux-languages').find('.current-language').html();
			if (currentLanguage !== "") {
				jQuery('li.aux-languages > a').html(currentLanguage);
			}
			
			// Change menu active when scroll through sections
			nav.currentScrollIndication();
			$window.scroll(function () {
				nav.currentScrollIndication();
			});

		},
		load: function() {
			// Set up Mega Menu
			if ((!isMobile || $window.width() > 768) && !sfIncluded.hasClass('disable-megamenu')) {
				nav.megaMenu();
			}
		},
		currentScrollIndication: function() {
			var adjustment = 0;
			
			if (body.hasClass('sticky-header-enabled')) {
				adjustment = jQuery('.header-wrap').height();
			}
			
			var inview = inview = jQuery('.blank_spacer:in-viewport:first').attr('id'),
				menuItems = jQuery('#main-navigation .menu li a'),
				link;
				
			if ( inview !== "" && typeof inview != 'undefined' ) {
				link = menuItems.filter('[href="#' + inview + '"]');
			}
			
			menuItems.parent().removeClass('current-scroll-item');
			menuItems.parent().parent().find('.current-menu-item').removeClass('indicator-disabled');
			
			if (typeof inview != 'undefined' && link.length > 0 && !link.hasClass('.current-scroll-item')) {
				menuItems.parent().removeClass('current-scroll-item');
				menuItems.parent().parent().find('.current-menu-item').addClass('indicator-disabled');
				link.parent().addClass('current-scroll-item');
			}
		},
		megaMenu: function() {
			jQuery('#main-navigation .menu').dcMegaMenu({
				rowItems: '5',
				speed: 200,
				effect: 'fade',
				fullWidth: true
			});
			
			// Set sub-menu position based on menu height
			var mainNav = jQuery('#main-navigation'),
				mainNavHeight = mainNav.height(),
				subMenu = mainNav.find('.sub-container');
			
			subMenu.each(function() {
				jQuery(this).css('top', mainNavHeight);
			});
		},
		showMobileMenu: function() {
			body.addClass('mobile-menu-open');
			setTimeout(function() {
				jQuery('#container').on('click', nav.containerClick);
			}, 500);
		},
		hideMobileMenu: function() {
			body.removeClass('mobile-menu-open');
			jQuery('#container').off('click', nav.containerClick);
		},
		containerClick: function() {
			body.removeClass('mobile-menu-open');
			nav.hideMobileMenu();
		}
	};
	
	
	/////////////////////////////////////////////
	// WOOCOMMERCE FUNCTIONS
	/////////////////////////////////////////////
	
	var woocommerce = {
		init: function() {
			
			// WISHLIST UPDATE
			jQuery(document).on('click', '.add_to_wishlist', function(){
				 				
				jQuery(this).parent().parent().find('.yith-wcwl-wishlistaddedbrowse').show().removeClass("hide").addClass("show");
				jQuery(this).hide().addClass("hide").removeClass("show");
															
			});
		
			// QUANTITY FUNCTIONS
			woocommerce.productQuantityAdjust();
		
			jQuery('.add_to_cart_button').on('click', function() {
				var button = jQuery(this);
				var added_text = button.attr("data-added_text");
				button.addClass("product-added");
				button.find('span').text(added_text);
			});
						
			jQuery('.show-products-link').on('click', function(e) {
				e.preventDefault();
				var linkHref = jQuery(this).attr('href').replace('?', ''),
					currentURL = document.location.href.replace('/page/2', '').replace('/page/3', '').replace('/page/4', '').replace('/page/5', '').replace('/page/6', '').replace('/page/7', '').replace('/page/8', '').replace('/page/9', ''),
					currentQuery = document.location.search;
				
				if (currentQuery.indexOf('?show') >= 0) {				
					window.location = jQuery(this).attr('href');
				} else if (currentQuery.indexOf('?') >= 0) {
					window.location = currentURL + '&' + linkHref;
				} else {
					window.location = currentURL + '?' + linkHref;
				}
			});
			
			jQuery('ul.products li').hover(function() {
				var imageOverlay = jQuery(this).find('.image-overlay');
				imageOverlay.animate({
					top: jQuery(this).height()*-1
				}, 400);
			}, function() {
				var imageOverlay = jQuery(this).find('.image-overlay');
				imageOverlay.animate({
					top: 0
				}, 400);
			});
			
			if (jQuery.fn.imagesLoaded) {
				//woocommerce.productSetup();
				
				$window.smartresize( function() {  
				//	woocommerce.productSetup();
				});
			}
			
			jQuery('.shipping-calculator-form input').keypress(function(e) {
				if(e.which == 10 || e.which == 13) {
					jQuery(".update-totals-button button").click();
				}
			}); 
		},
		productSetup: function() {
			jQuery('ul.products').imagesLoaded(function() {
				var captionVisible = jQuery(this).first('li.type-product').find('figure > figcaption').is(":visible");
				jQuery('ul.products li.type-product').each(function() {
					var productImageHeight = jQuery(this).find('.product-image > img').height();
					if (jQuery('#container').width() <= 1024 && captionVisible) {
						productImageHeight = productImageHeight + 20;
					}
					jQuery(this).find('figure').css('padding-bottom', productImageHeight  + 'px');
				});
			});
			
		},
		variations: function() {
			jQuery('.single_variation_wrap').on("show_variation", function() {
				if (jQuery('#sf-included').hasClass('has-productzoom')) {
					jQuery('.zoomContainer').remove();
					setTimeout(function() {
						jQuery('.product-slider-image').each(function() {
							jQuery(this).data('zoom-image', jQuery(this).parent().find('a.zoom').attr('href'));
						});
						var currentImage = jQuery('#product-img-slider li:first').find('.product-slider-image');
						woocommerce.productZoom(currentImage);
						jQuery('#product-img-slider').flexslider(0);
					}, 500);
				} else {
					setTimeout(function() {
						jQuery('#product-img-slider').flexslider(0);
						var flexViewport = jQuery('#product-img-slider').find('.flex-viewport'),
						flexsliderHeight = flexViewport.find('ul.slides').css('height');
					}, 500);
				}
				setTimeout(function() {
					// Update lightbox image
					jQuery('.product-slider-image').each(function() {
						var zoomImage = jQuery(this).attr('src');
						jQuery(this).parent().find('a.zoom').attr('href', zoomImage).attr('data-o_href', '').attr('data-o_href', zoomImage);
						jQuery('[data-rel="ilightbox[product]"]').removeClass('ilightbox-enabled').iLightBox().destroy();
						lightbox.init();
					});
				}, 600);
			});
		},
		productZoom: function(zoomObject) {
			
			if ( isMobileAlt ) {
				return;
			}
			
			zoomObject.elevateZoom({
				zoomType: "inner",
				cursor: "crosshair",
				zoomParent: '#product-img-slider',
				responsive: true,
				zoomWindowFadeIn: 500,
				zoomWindowFadeOut: 750
			});
		},
		productQuantityAdjust: function() {
		
			// Increase
			jQuery(document).on('click', '.qty-plus', function(e) {
				e.preventDefault();
				var quantityInput = jQuery(this).parents('.quantity').find('input.qty'),
					newValue = parseInt(quantityInput.val(), 10) + 1,
					maxValue = parseInt(quantityInput.attr('max'), 10);

				if (!maxValue) {
					maxValue = 9999999999;
				}
				
				if ( newValue <= maxValue ) {
					quantityInput.val(newValue);
					quantityInput.change();
				}
			});

			// Decrease
			jQuery(document).on('click', '.qty-minus', function(e) {
				e.preventDefault();
				var quantityInput = jQuery(this).parents('.quantity').find('input.qty'),
					newValue = parseInt(quantityInput.val(), 10) - 1,
					minValue = parseInt(quantityInput.attr('min'), 10);
					
				if (!minValue) {
					minValue = 1;
				}
				
				if ( newValue >= minValue ) {
					quantityInput.val(newValue);
					quantityInput.change();
				}
			});

		}
	};
	
	/////////////////////////////////////////////
	// FLEXSLIDER FUNCTION
	/////////////////////////////////////////////
	
	var flexSlider = {
		init: function() {
			
			var hasProductZoom = false;
			
			if (jQuery('#sf-included').hasClass('has-productzoom') && !body.hasClass('mobile-browser')) {
				hasProductZoom = true;
			}
			
			if(jQuery('.recent-posts').length > 0) {
				flexSlider.thumb();
			}
			
			if (jQuery('#product-img-nav ul.slides li').length > 1) {
				jQuery('#product-img-nav').flexslider({
					animation: "slide",
					directionNav: false,
					controlNav: false,
					animationLoop: false,
					slideshow: false,
					itemWidth: 70,
					itemMargin: 30,
					asNavFor: '#product-img-slider'
				});
			} else {
				jQuery('#product-img-nav').css('display', 'none');
			}
			
			var currentImage = "";
			
			jQuery('#product-img-slider').flexslider({
				animation: "slide",
				controlNav: false,
				smoothHeight: true,
				animationLoop: false,
				slideshow: sliderAuto,	//Boolean: Animate slider automatically
				slideshowSpeed: sliderSlideSpeed,           //Integer: Set the speed of the slideshow cycling, in milliseconds
				animationDuration: sliderAnimSpeed,         //Integer: Set the speed of animations, in milliseconds
				sync: "#product-img-nav",
				start: function(productSlider) {
					if (hasProductZoom) {
						if (productSlider.slides) {
							currentImage = productSlider.slides.eq(productSlider.currentSlide).find('.product-slider-image');
							woocommerce.productZoom(currentImage);
						} else {
							currentImage = jQuery('#product-img-slider').find('.product-slider-image');
							woocommerce.productZoom(currentImage);
						}
					}
				},
				before: function() {
					if (hasProductZoom) {
						jQuery('.zoomContainer').remove();
					}
				},
				after: function(productSlider) {
					if (hasProductZoom) {
						currentImage = productSlider.slides.eq(productSlider.currentSlide).find('.product-slider-image');
						woocommerce.productZoom(currentImage);
					}
				}
			});
			
			var flexUseCSS = true;
			
			if (isMobileAlt) {
				flexUseCSS = false;
			}
					
			jQuery('.item-slider').flexslider({
				useCSS: flexUseCSS,
				animation: "slide",              //String: Select your animation type, "fade" or "slide"
				slideDirection: "horizontal",   //String: Select the sliding direction, "horizontal" or "vertical"
				slideshow: sliderAuto,	//Boolean: Animate slider automatically
				slideshowSpeed: sliderSlideSpeed,           //Integer: Set the speed of the slideshow cycling, in milliseconds
				animationDuration: sliderAnimSpeed,         //Integer: Set the speed of animations, in milliseconds
				smoothHeight: true,         
				directionNav: true,             //Boolean: Create navigation for previous/next navigation? (true/false)
				controlNav: true,               //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
				keyboardNav: false,              //Boolean: Allow slider navigating via keyboard left/right keys
				mousewheel: false,              //Boolean: Allow slider navigating via mousewheel
				prevText: "Prev",           //String: Set the text for the "previous" directionNav item
				nextText: "Next",               //String: Set the text for the "next" directionNav item
				pausePlay: true,               //Boolean: Create pause/play dynamic element
				pauseText: '',             //String: Set the text for the "pause" pausePlay item
				playText: '',               //String: Set the text for the "play" pausePlay item
				randomize: false,               //Boolean: Randomize slide order
				slideToStart: 0,                //Integer: The slide that the slider should start on. Array notation (0 = first slide)
				animationLoop: true,            //Boolean: Should the animation loop? If false, directionNav will received "disable" classes at either end
				pauseOnAction: true,            //Boolean: Pause the slideshow when interacting with control elements, highly recommended.
				pauseOnHover: false,            //Boolean: Pause the slideshow when hovering over slider, then resume when no longer hovering
				controlsContainer: "",          //Selector: Declare which container the navigation elements should be appended too. Default container is the flexSlider element. Example use would be ".flexslider-container", "#container", etc. If the given element is not found, the default action will be taken.
				manualControls: "",             //Selector: Declare custom control navigation. Example would be ".flex-control-nav li" or "#tabs-nav li img", etc. The number of elements in your controlNav should match the number of slides/tabs.
				start: function(){},            //Callback: function(slider) - Fires when the slider loads the first slide
				before: function(){},           //Callback: function(slider) - Fires asynchronously with each slider animation
				after: function(){},      //Callback: function(slider) - Fires after each slider animation completes
				end: function(){}               //Callback: function(slider) - Fires when the slider reaches the last slide (asynchronous)
			});
			jQuery('#swift-slider').flexslider({
				animation: "slide",              //String: Select your animation type, "fade" or "slide"
				slideDirection: "horizontal",   //String: Select the sliding direction, "horizontal" or "vertical"
				slideshow: sliderAuto,	//Boolean: Animate slider automatically
				slideshowSpeed: sliderSlideSpeed,           //Integer: Set the speed of the slideshow cycling, in milliseconds
				animationDuration: sliderAnimSpeed,         //Integer: Set the speed of animations, in milliseconds
				directionNav: true,             //Boolean: Create navigation for previous/next navigation? (true/false)
				controlNav: false,               //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
				keyboardNav: false,              //Boolean: Allow slider navigating via keyboard left/right keys
				mousewheel: false,              //Boolean: Allow slider navigating via mousewheel
				prevText: "Prev",           //String: Set the text for the "previous" directionNav item
				nextText: "Next",               //String: Set the text for the "next" directionNav item
				pausePlay: false,               //Boolean: Create pause/play dynamic element
				animationLoop: true,            //Boolean: Should the animation loop? If false, directionNav will received "disable" classes at either end
				pauseOnAction: true,            //Boolean: Pause the slideshow when interacting with control elements, highly recommended.
				pauseOnHover: true,
				start: function(postsSlider) {
					jQuery('.swift-slider-loading').fadeOut(200);
					if (postsSlider.slides) {
						postsSlider.slides.eq(postsSlider.currentSlide-1).addClass('flex-active-slide'); 
						if (postsSlider.slides.eq(postsSlider.currentSlide).has('.flex-caption-large')) {
							var chart = postsSlider.slides.eq(postsSlider.currentSlide).find('.fw-chart');
							if (body.hasClass("browser-ie")) {
							chart = postsSlider.slides.eq(postsSlider.currentSlide).find('.chart');
							}
							chart.each( function() {
								var countValue = parseInt(jQuery(this).attr('data-count'), 10);
								jQuery(this).data('easyPieChart').update(80);
								jQuery(this).find('span').replaceWith("<span>0</span>");
								jQuery(this).find('span').animateNumber(countValue);
							});
						}
						postsSlider.slides.eq(postsSlider.currentSlide).find('.comment-chart:not(.fw-chart) span').replaceWith("<span>0</span>");
					}
				},
				before: function(postsSlider) {
					if (postsSlider.slides) {
						if (postsSlider.slides.eq(postsSlider.currentSlide-1).has('.flex-caption-large')) {
							var chart = postsSlider.slides.eq(postsSlider.currentSlide).find('.fw-chart');
							if (body.hasClass("browser-ie")) {
							chart = postsSlider.slides.eq(postsSlider.currentSlide).find('.chart');
							}
							chart.each( function() {
								jQuery(this).data('easyPieChart').update(0);
								jQuery(this).find('span').replaceWith("<span>0</span>");
							});
						}
						setTimeout( function() {
							postsSlider.slides.eq(postsSlider.currentSlide).addClass('flex-active-slide');
							if (postsSlider.slides.eq(postsSlider.currentSlide).has('.flex-caption-large')) {
								var chart = postsSlider.slides.eq(postsSlider.currentSlide).find('.fw-chart');
								if (body.hasClass("browser-ie")) {
								chart = postsSlider.slides.eq(postsSlider.currentSlide).find('.chart');
								}
								chart.each( function() {
									var countValue = parseInt(jQuery(this).attr('data-count'), 10);
									jQuery(this).data('easyPieChart').update(80);
									jQuery(this).find('span').animateNumber(countValue);
								});
							}
						}, 1000);
					}
				}
			});
			jQuery('.content-slider').each(function() {
				var slider = jQuery(this),
					autoplay = ((slider.attr('data-autoplay') === "yes") ? true : false);
				
				slider.flexslider({
					animation: "fade",              //String: Select your animation type, "fade" or "slide"
					slideshow: autoplay,	//Boolean: Animate slider automatically
					slideshowSpeed: sliderSlideSpeed,           //Integer: Set the speed of the slideshow cycling, in milliseconds
					animationDuration: sliderAnimSpeed,         //Integer: Set the speed of animations, in milliseconds
					smoothHeight: true,         
					directionNav: true,             //Boolean: Create navigation for previous/next navigation? (true/false)
					controlNav: false,               //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
					pauseOnHover: true,
					start: function() {}
				});
			});
						
			// LOAD THE LOVE-IT CHARTS
			jQuery('#swift-slider li').each( function() {
				jQuery(this).find('.chart').each( function() {
					jQuery(this).easyPieChart({
						animate: 1000,
						size: 70,
						barColor: jQuery(this).attr('data-barcolor'),
						trackColor: 'transparent',
						scaleColor: false
					});
					jQuery(this).find('span').replaceWith("<span>0</span>");
				});
			});
			
			// CAPTION HOVER ADD/REMOVE CLASSES
			jQuery('#swift-slider li').hover(function() {
				jQuery(this).find('.flex-caption-details').removeClass('closing');
				jQuery(this).find('.flex-caption-details').addClass('open');
			}, function() {
				jQuery(this).find('.flex-caption-details').addClass('closing');
				jQuery(this).find('.flex-caption-details').removeClass('open');
			});
						
			// CAPTION TRANSITION LISTENERS
			jQuery('.caption-details-inner').on('transitionend webkitTransitionEnd oTransitionEnd otransitionend MSTransitionEnd', function() {
				var chart = jQuery(this).find('.chart');
				if (jQuery(this).parent().hasClass('closing')) {
					chart.each( function() {
						jQuery(this).data('easyPieChart').update(0);
						jQuery(this).find('span').replaceWith("<span>0</span>");
					});
					jQuery(this).parent().removeClass('closing');
				} else if (jQuery(this).parent().hasClass('open')) {
					chart.each( function() {
						var countValue = parseInt(jQuery(this).attr('data-count'), 10);
						jQuery(this).data('easyPieChart').update(80);
						jQuery(this).find('span').animateNumber(countValue);
					});
				}
			});
		},
		thumb: function() {
			jQuery('.thumb-slider').flexslider({
				animation: "fade",              //String: Select your animation type, "fade" or "slide"
				slideDirection: "horizontal",   //String: Select the sliding direction, "horizontal" or "vertical"
				slideshow: sliderAuto,	//Boolean: Animate slider automatically
				slideshowSpeed: sliderSlideSpeed,           //Integer: Set the speed of the slideshow cycling, in milliseconds
				animationDuration: sliderAnimSpeed,         //Integer: Set the speed of animations, in milliseconds
				directionNav: true,             //Boolean: Create navigation for previous/next navigation? (true/false)
				controlNav: false,               //Boolean: Create navigation for paging control of each slide? Note: Leave true for manualControls usage
				keyboardNav: false,              //Boolean: Allow slider navigating via keyboard left/right keys
				smoothHeight: true
			});
		},
		gallery: function() {
			
			jQuery('.spb_gallery_widget').each(function() {
				
				var gallerySlider = jQuery(this).find('.gallery-slider'),
					galleryNav = jQuery(this).find('.gallery-nav'),
					galleryAuto = gallerySlider.data('autoplay');
				
				if (galleryAuto === "yes") {
					galleryAuto = true;
				} else {
					galleryAuto = false;
				}
								
				galleryNav.flexslider({
					animation: "slide",
					directionNav: true,
					controlNav: false,
					animationLoop: false,
					slideshow: false,
					itemWidth: 100,
					itemMargin: 30, 
					asNavFor: gallerySlider
				});
				
				gallerySlider.flexslider({
					animation: gallerySlider.data('transition'),
					slideshow: galleryAuto,
					smoothHeight: true,
					slideshowSpeed: sliderSlideSpeed,           //Integer: Set the speed of the slideshow cycling, in milliseconds
					animationDuration: sliderAnimSpeed,         //Integer: Set the speed of animations, in milliseconds
					controlNav: false,
					animationLoop: galleryAuto,
					sync: galleryNav
				});
				
			});
			
		}
	};
	
	/////////////////////////////////////////////
	// PORTFOLIO
	/////////////////////////////////////////////
	
	var portfolioContainer = jQuery('.portfolio-wrap').find('.filterable-items');
	
	var portfolio = {
		init: function() {
			
			if (portfolioContainer.hasClass('masonry-items')) {
				portfolio.masonrySetup();
			} else {
				portfolio.standardSetup();
			}
						
			// PORTFOLIO WINDOW RESIZE
			$window.smartresize( function() {  
				portfolio.windowResized();
			});
			
			// Enable filter options on when there are items from that skill
			jQuery('.filtering li').each( function() {
				var itemCount = 0;
				var filter = jQuery(this),
					filterName = jQuery(this).find('a').attr('class'),
					portfolioItems = jQuery(this).parent().parent().parent().parent().find('.filterable-items');
				
				portfolioItems.find('.portfolio-item').each( function() {
					if ( jQuery(this).hasClass(filterName) ) {
						filter.addClass('has-items');
						itemCount++;
					}
				});
				
				if (jQuery(this).hasClass('all')) {
					itemCount = portfolioItems.children('li').length;
					jQuery(this).find('.item-count').text(itemCount);
				} else {
					jQuery(this).find('.item-count').text(itemCount);
				}
			}).parents('.portfolio-filter-tabs').animate({
				opacity: 1
			}, 400);
	
			// filter items when filter link is clicked
			jQuery('.filtering li').on('click', 'a', function(e) {
				e.preventDefault();
				jQuery(this).parent().parent().find('li').removeClass('selected');
				jQuery(this).parent().addClass('selected');
				var selector = jQuery(this).data('filter');
				var portfolioItems = jQuery(this).parent().parent().parent().parent().parent().find('.filterable-items');
				portfolioItems.isotope({ filter: selector });	
			});  
			
			jQuery('.filter-wrap > a').on('click', function(e) {
				e.preventDefault();
				jQuery(this).parent().find('.filter-slide-wrap').slideToggle();
			});
		},
		standardSetup: function() {
			// SET ITEM HEIGHTS
			portfolioContainer.imagesLoaded(function () {
				portfolio.setItemHeight();
				flexSlider.thumb();
				portfolioContainer.animate({opacity: 1}, 800);
				portfolioContainer.isotope({
					animationEngine: 'best-available',
					animationOptions: {
						duration: 300,
						easing: 'easeInOutQuad',
						queue: false
					},
					resizable: true,
					layoutMode: 'fitRows'
				});
				portfolioContainer.isotope("layout");
			});
		},
		masonrySetup: function() {
			//portfolioContainer.fitVids();
			portfolioContainer.imagesLoaded(function () {
				flexSlider.thumb();
				portfolioContainer.animate({opacity: 1}, 800);
				portfolioContainer.isotope({
					itemSelector : '.portfolio-item',
					animationEngine: 'best-available',
					animationOptions: {
						duration: 300,
						easing: 'easeInOutQuad',
						queue: false
					},
					resizable: true
				});
				
			});
		},
		setItemHeight: function() {
			if (!portfolioContainer.hasClass('masonry-items')) {
				portfolioContainer.children().css('min-height','0');
				portfolioContainer.equalHeights();
			}
		},
		windowResized: function() {
			if (!portfolioContainer.hasClass('masonry-items')) {
				portfolio.setItemHeight();
			}
			if (portfolioContainer.hasClass('full-width-area')) {
				setTimeout(function () {
					portfolioContainer.isotope("layout");
				}, 500);
			} else {
				portfolioContainer.isotope("layout");
			}
		},
		portfolioShowcaseInit: function() {
			flexSlider.thumb();
			portfolio.portfolioShowcaseWrap();
			portfolio.portfolioShowcaseItems();
			$window.smartresize( function() {
				portfolio.portfolioShowcaseWrap();
				portfolio.portfolioShowcaseItems();
			});
		},
		portfolioShowcaseWrap: function() {
			var portfolioShowcaseWrap = jQuery('.portfolio-showcase-wrap'),
				container = jQuery('#page-wrap'),
				mediaOffset = container.offset().left,
				windowWidth = $window.width() + 2;
		
			if (windowWidth > 768) {
				mediaOffset = mediaOffset - 15;
			} else {
				mediaOffset = 7;
			}
			
			if (jQuery('#container').hasClass('boxed-layout')) {
				windowWidth = jQuery('#container').width() + 2;
				
				if (windowWidth > 1026) {
					mediaOffset = 30;
				} else if (windowWidth > 770) {
					mediaOffset = 17;
				} else if (windowWidth > 482) {
					mediaOffset = 11;
				} else {
					mediaOffset = 7;
				}
			}
									
			portfolioShowcaseWrap.css('width', windowWidth);
			portfolioShowcaseWrap.css('margin-left', '-' + mediaOffset + 'px');
			portfolioShowcaseWrap.animate({opacity: 1}, 600);
		},
		portfolioShowcaseItems: function() {
			jQuery('.portfolio-showcase-wrap').each(function() {
				
				var contWidth = $window.width();
				
				if (jQuery('#container').hasClass('boxed-layout')) {
					contWidth = jQuery('#container').width();
				}
				
				var thisShowcase = jQuery(this),
					columns = thisShowcase.find('.portfolio-showcase-items').data('columns'),
					windowWidth = contWidth + 2,
					itemWidth = Math.floor(windowWidth / columns),
					maximisedWidth = Math.floor(windowWidth * 40 / 100),
					reducedWidth = Math.floor(windowWidth / 5),
					deselectedLeft = (itemWidth / 2 - maximisedWidth / 2) / 0.75,
					resetLeft = (reducedWidth / 2 - maximisedWidth / 2) / 1.3,
					isAnimating = !1,
					speed = 300;

				var showcaseItem = thisShowcase.find('li.portfolio-item');
				
				if (columns === 5) {
					maximisedWidth = Math.floor(windowWidth * 25 / 100);
					reducedWidth = Math.floor(windowWidth / 5.33);
					deselectedLeft = (itemWidth / 2 - maximisedWidth / 2) / 0.75;
					resetLeft = (reducedWidth / 2 - maximisedWidth / 2) / 1.3;
					showcaseItem.css("width", itemWidth);
					showcaseItem.css("height", maximisedWidth / 1.5);
					showcaseItem.find('.main-image').css("width", maximisedWidth);
					showcaseItem.find('.main-image').css("left", resetLeft);
					showcaseItem.find('.main-image').css("top", - maximisedWidth / 6);
					speed = 200;
				} else {
					showcaseItem.css("width", itemWidth);
					showcaseItem.css("height", maximisedWidth / 2);
					showcaseItem.find('.main-image').css("width", maximisedWidth);
					showcaseItem.find('.main-image').css("left", resetLeft);
				}
							
				showcaseItem.each(function () {
					if (windowWidth > 768) {
						jQuery(this).mouseenter(function () {
							if (!isAnimating) {
								isAnimating = !0;
								jQuery(this).removeClass("deselected-item");
								thisShowcase.find(".deselected-item").stop().animate({
									width: reducedWidth
								}, speed);
								thisShowcase.find(".deselected-item").find(".main-image").stop().animate({
									left: deselectedLeft
								}, speed);
								jQuery(this).find(".main-image").stop().animate({
									left: 0
								}, speed);
								jQuery(this).stop().animate({
									width: maximisedWidth
								}, speed + 1, function () {
									jQuery(this).find(".item-info").stop().show();
									jQuery(this).find(".item-info").stop().animate({
										bottom: 0
									}, speed, "easeInOutQuart");
								});
							}
						});
						jQuery(this).mouseleave(function () {
							if (isAnimating) {
								isAnimating = !1;
								jQuery(this).addClass("deselected-item");
								thisShowcase.find(".portfolio-item").stop().animate({
									width: itemWidth
								}, speed);
								thisShowcase.find(".portfolio-item .main-image").stop().animate({
									left: resetLeft
								}, speed);
								jQuery(this).find(".item-info").stop().animate({
									bottom: -80
								}, speed, function () {
									jQuery(this).find(".item-info").stop().hide();
								});
							}
						});
					}
				});
			});			
		},
		stickyDetails: function() {
			
			var offset = 0,
				navSelectorElement = '.media-wrap',
				footerOffset = 160;
			
			if (jQuery('.page-heading').length > 0) {
				offset += jQuery('.page-heading').outerHeight(true);
			}
			
			if (jQuery('.inner-page-wrap').hasClass('portfolio-type-standard')) {
				offset += 130;
			}
			
			if (jQuery('.related-projects').length > 0) {
				footerOffset = 520;
			}
			
			jQuery('.sticky-details').stickySidebar({
				headerSelector: '.header-wrap',
				navSelector: navSelectorElement,
				contentSelector: '.article-body-wrap',
				footerSelector: '#footer-wrap',
				sidebarTopMargin: 0,
				footerThreshold: footerOffset,
				offset: offset
			});
			
			jQuery('.sticky-details').css('max-width', jQuery('.sticky-details').outerWidth(true));
			
			portfolio.stickyDetailsScroll();
			$window.scroll(function() { 
				portfolio.stickyDetailsScroll();
			});
		},
		stickyDetailsScroll: function() {
			
			var contentElement = jQuery('.article-body-wrap');
			
			if (jQuery('.inner-page-wrap').hasClass('portfolio-type-fw-media')) {
				contentElement = jQuery('.portfolio-detail-description');
			}
			
			if (jQuery('.sticky-details').hasClass('sticky')) {
				jQuery('.sticky-details').css('margin-left', contentElement.outerWidth(true));
			} else {
				jQuery('.sticky-details').css('margin-left', 0);			
			}
		},
	};
	
	
	/////////////////////////////////////////////
	// BLOG
	/////////////////////////////////////////////
	
	var blogItems = jQuery('.blog-wrap').find('.blog-items');
	
	var blog = {
		init: function() {
		
			// BLOG ITEM SETUP
			if (blogItems.hasClass('masonry-items')) {
				blog.masonryBlog();
			} else {
				flexSlider.thumb();
			}
			
			
			// BLOG AUX SLIDEOUT
			jQuery('.blog-slideout-trigger').on('click', function(e) {
				e.preventDefault();
				
				// VARIABLES
				var blogWrap = jQuery(this).parent().parent().parent().parent();
				var filterPanel = blogWrap.find('.filter-wrap .filter-slide-wrap');
				var auxType = jQuery(this).attr('data-aux');
								
				// ADD COLUMN SIZE AND REMOVE BRACKETS FROM COUNT
				blogWrap.find('.aux-list li').addClass('col-sm-2');
				blogWrap.find('.aux-list li a span').each(function() {
					jQuery(this).html(jQuery(this).html().replace("(","").replace(")",""));
				});
				
				// IF SELECTING AN OPTION THAT IS OPEN, CLOSE THE PANEL
				if (jQuery(this).parent().hasClass('selected') && !filterPanel.is(':animated')) {
					blogWrap.find('.blog-aux-options li').removeClass('selected');
					filterPanel.slideUp(400);
					return;
				}
				
				// AUX BUTTON SELECTED STATE
				blogWrap.find('.blog-aux-options li').removeClass('selected');	
				jQuery(this).parent().addClass('selected');
				
				// IF SLIDEOUT IS OPEN
				if (filterPanel.is(':visible')) {
					
					filterPanel.slideUp(400);
					setTimeout(function() {
						blogWrap.find('.aux-list').css('display', 'none');
						blogWrap.find('.aux-'+auxType).css('display', 'block');
						filterPanel.slideDown();
					}, 600);
					
				// IF SLIDEOUT IS CLOSED
				} else {
					
					blogWrap.find('.aux-list').css('display', 'none');
					blogWrap.find('.aux-'+auxType).css('display', 'block');
					filterPanel.slideDown();
					
				}
			});
			
		},
		masonryBlog: function() {
			flexSlider.thumb();
			if (!(IEVersion && IEVersion < 9)) {
				var scrollAnimateElement = new AnimOnScroll( document.getElementById( 'blogGrid' ), {
					minDuration : 0.4,
					maxDuration : 0.7,
					viewportFactor : 0.2
				});
			}
			blogItems.imagesLoaded(function () {
				flexSlider.thumb();
			});
			//blogItems.fitVids();
		},
		infiniteScroll: function() {
			if (!(IEVersion && IEVersion < 9)) {
				var infScrollData = jQuery('#inf-scroll-params');
				var infiniteScroll = {
					loading: {
						img: infScrollData.data('loadingimage'),
						msgText: infScrollData.data('msgtext'),
						finishedMsg: infScrollData.data('finishedmsg')
					},
					"nextSelector":".pagenavi li.next a",
					"navSelector":".pagenavi",
					"itemSelector":".blog-item",
					"contentSelector":".blog-items:not(.carousel-items)"
				};
				jQuery( infiniteScroll.contentSelector ).infinitescroll(
					infiniteScroll, function() {
						if (blogItems.parent().find('.pagination-wrap').hasClass('load-more')) {
							jQuery('.load-more-btn').fadeIn(400);
						}
						jQuery('[data-rel="ilightbox[posts]"]').removeClass('ilightbox-enabled').iLightBox().destroy();
						lightbox.init();
						blogItems.imagesLoaded(function () {
							if (blogItems.hasClass('masonry-items')) {
								flexSlider.thumb();
								blog.masonryBlog();
							} else {
								flexSlider.thumb();
								//blogItems.fitVids();
							}
						});
					}
				);
				if (blogItems.parent().find('.pagination-wrap').hasClass('load-more')) {
					$window.unbind('.infscr');
					jQuery('.load-more-btn').on('click', function(e) {
						e.preventDefault();					
						jQuery( infiniteScroll.contentSelector ).infinitescroll('retrieve');
						jQuery('.load-more-btn').fadeOut(400);
					});
				}
			} else {
				jQuery('.pagination-wrap').removeClass('hidden');
			}
		}
	};
	
	
	/////////////////////////////////////////////
	// CAROUSEL FUNCTIONS
	/////////////////////////////////////////////
	
	var carouselWidgets = {
		init: function() {

			// CAROUSELS
			var carousel = jQuery('.carousel-items'),
				carouselAuto = sfOptionParams.data('carousel-autoplay'),
				carouselPSpeed = sfOptionParams.data('carousel-pagespeed'),
				carouselSSpeed = sfOptionParams.data('carousel-slidespeed'),
				carouselPagination = sfOptionParams.data('carousel-pagination'),
				carouselPDirection = 'ltr',
				desktopWidth = 1199;

			if (body.hasClass('vertical-header')) {
				desktopWidth = desktopWidth + jQuery('#header-section').width();
			}

			if (carouselAuto) {
				carouselAuto = true;
			} else {
				carouselAuto = false;
			}
			if (carouselPagination) {
				carouselPagination = true;
			} else {
				carouselPagination = false;
			}
			if (isRTL) {
				carouselPDirection = 'rtl';
			}

			carousel.each(function() {
				var carouselInstance = jQuery('#'+jQuery(this).attr('id')),
					carouselColumns = parseInt(carouselInstance.attr("data-columns"), 10),
					desktopCarouselItems = 4 > carouselColumns ? carouselColumns : 4,
					desktopSmallCarouselItems = 3 > carouselColumns ? carouselColumns : 3,
					mobileCarouselItems = 1,
					carouselAutoplay = carouselAuto;

				if (carouselInstance.hasClass('clients-items')) {
					mobileCarouselItems = 2;
				}
				if (carouselInstance.hasClass('testimonials')) {
					desktopCarouselItems = 1;
					desktopSmallCarouselItems = 1;
					mobileCarouselItems = 1;
				}
				
				if ( carouselInstance.data('auto') ) {
					carouselAutoplay = true;
				}

				carouselInstance.imagesLoaded(function () {

					if (!carouselInstance.hasClass('no-gutters')) {
						var carouselWidth = carouselInstance.width();
						if (isRTL) {
						carouselInstance.css('margin-right', '-15px').css('width', carouselWidth + 30);
						} else {
						carouselInstance.css('margin-left', '-15px').css('width', carouselWidth + 30);
						}
					}

					carouselInstance.owlCarousel({
						items : carouselColumns,
						itemsDesktop: [desktopWidth,desktopCarouselItems],
						itemsDesktopSmall: [desktopWidth-220,desktopSmallCarouselItems],
						itemsMobile: [479,mobileCarouselItems],
						paginationSpeed: carouselPSpeed,
						slideSpeed: carouselSSpeed,
						autoPlay: carouselAutoplay,
						autoPlayDirection : carouselPDirection,
						pagination: carouselPagination,
						autoHeight : false,
						beforeUpdate: function() {
							if (!carouselInstance.hasClass('no-gutters')) {
								var carouselWidth = carouselInstance.parent().width();
								carouselInstance.css('width', carouselWidth + 30);
							}
						},
						afterUpdate: function () {
							setTimeout(function() {
								flexSlider.thumb();
							}, 200);
						},
						afterInit: function() {
							flexSlider.thumb();
							$window.trigger('resize');
							setTimeout(function() {
								parallax.init(true);
							}, 200);
						},
						afterAction: function(){
							var carouselNext = carouselInstance.parents('.carousel-wrap').find('.carousel-next'),
								carouselPrev = carouselInstance.parents('.carousel-wrap').find('.carousel-prev');
								
						    if ( this.itemsAmount > this.visibleItems.length ) {
						        carouselNext.show();
						        carouselPrev.show();
						
						        carouselNext.removeClass('disabled');
						        carouselPrev.removeClass('disabled');
						        if ( this.currentItem === 0 ) {
						            carouselPrev.addClass('disabled');
						        }
						        if ( this.currentItem == this.maximumItem ) {
						            carouselNext.addClass('disabled');
						        }
						
						    } else {
						        carouselNext.hide();
						        carouselPrev.hide();
						    }
						}
					}).animate({
						'opacity': 1
					},800);
				});
			});

			// Previous
			jQuery('.carousel-next').click( function(e) {
				e.preventDefault();
				var carousel = jQuery(this).closest('.spb_content_element').find('.owl-carousel');
				if (isRTL) {
				carousel.data( 'owlCarousel' ).prev();
				} else {
				carousel.data( 'owlCarousel' ).next();
				}
			});

			// Next
			jQuery('.carousel-prev').click( function(e) {
				e.preventDefault();
				var carousel = jQuery(this).closest('.spb_content_element').find('.owl-carousel');
				if (isRTL) {
				carousel.data( 'owlCarousel' ).next();
				} else {
				carousel.data( 'owlCarousel' ).prev();
				}
			});
		},
		carouselSwipeIndicator: function(carousel) {
			carousel.appear(function() {
				var swipeIndicator = jQuery(this).parents('.carousel-wrap').find('.sf-swipe-indicator');
				setTimeout(function() {
					swipeIndicator.fadeIn(500);
				}, 400);
				setTimeout(function() {
					swipeIndicator.addClass('animate');
				}, 1000);
				setTimeout(function() {
					swipeIndicator.fadeOut(400);
				}, 3000);
			});
		},
		carouselMinHeight: function(carousel) {
			var minHeight = parseInt(carousel.find('.carousel-item:not(.no-thumb)').eq(0).css('height'));
			carousel.find('.owl-item').each(function () {
				jQuery(this).css('min-height',minHeight+'px');
			});
		}
	};
	
	
	/////////////////////////////////////////////
	// WIDGET FUNCTIONS
	/////////////////////////////////////////////
	
	var widgets = {
		init: function() {
			
			// CHARTS
			if (sfIncluded.hasClass('has-chart')) {
				jQuery('.chart-shortcode').each(function(){
					jQuery(this).easyPieChart({
						animate: 1000,
						lineCap: 'round',
						lineWidth: jQuery(this).attr('data-linewidth'),
						size: jQuery(this).attr('data-size'),
						barColor: jQuery(this).attr('data-barcolor'),
						trackColor: jQuery(this).attr('data-trackcolor'),
						scaleColor: 'transparent'
					});
				});
			}
			
			// LOAD WIDGETS
			widgets.accordion();
			widgets.tabs();
			widgets.toggle();
			widgets.fullWidthVideo();
			widgets.introAnimations();
			widgets.iconBoxes();
			widgets.countAssets();
			
			if (sfIncluded.hasClass('has-countdown')) {
			widgets.countdownAssets();
			}
			
			if (sfIncluded.hasClass('has-imagebanner')) {
			widgets.imageBanners();
			}
			
			jQuery('ul.nav-tabs li a, .spb_accordion_section > h3 a').click(function(){
				setTimeout(function() {
					$window.trigger('resize');
				}, 200);    		   
			});
			
			// RESIZE ASSETS
			widgets.resizeAssets();
			$window.smartresize( function() {  
				widgets.resizeAssets();
			});
			
			// SF TOOLTIPS
			jQuery('[rel=tooltip]').tooltip();
			
		},
		resizeAssets: function() {	
			var carousels = jQuery('.carousel-active .carousel-items,.carousel-active .products');
			var assets = jQuery('.alt-bg');
			var assetWidth = 0;
			
			if (jQuery('#container').width() < 460 && body.hasClass('responsive-fluid')) {
				assetWidth = jQuery('#container').width() - 40;			
				carousels.find('.carousel-item,.product').each(function() {
					jQuery(this).css("width", assetWidth + "px");
					
				});
			} else if (jQuery('#container').width() < 768 && body.hasClass('responsive-fluid')) {
				if (carousels.hasClass('testimonials')) {
				assetWidth = jQuery('#container').width() - 40;	
				} else {
				assetWidth = Math.floor(jQuery('#container').width() / 2) - 35;	
				}
				carousels.find('.carousel-item,.product').each(function() {
					jQuery(this).css("width", assetWidth + "px");
				});
			} else if (body.hasClass('responsive-fluid')) {
				carousels.find('.carousel-item,.product').each(function() {
					jQuery(this).css("width", "");
				});
			}
			
			if (jQuery('#container').width() < 768 && body.hasClass('responsive-fluid')) {
				assetWidth = jQuery('#container').width();
				assets.each(function() {
					jQuery(this).css("width", assetWidth + "px");
				});	
			} else {
				assets.each(function() {
					jQuery(this).css("width", "");
				});	
			}
		},
		accordion: function() {
			jQuery('.spb_accordion').each(function() {
				var spb_tabs,				
					active_tab = false,
					active_attr = parseInt(jQuery(this).attr('data-active'), 10);
							
				if (jQuery.type( active_attr ) === "number") { active_tab = active_attr; }
							
				spb_tabs = jQuery(this).find('.spb_accordion_wrapper').accordion({
					header: "> div > h3",
					autoHeight: true,
					collapsible: true,
					active: active_tab,
					heightStyle: "content"
				});
			}).fadeIn(400);
		},
		tabs: function() {
			// SET ACTIVE TABS PANE
			jQuery('.spb_tabs').each(function() {
				jQuery(this).find('.tab-pane').first().addClass('active');
				jQuery(this).find('.tab-pane').removeClass('load');
			});
			
			// SET ACTIVE TOUR PANE
			jQuery('.spb_tour').each(function() {
				jQuery(this).find('.tab-pane').first().addClass('active');
				jQuery(this).find('.tab-pane').removeClass('load');
			});
			
			// SET DESIRED TAB ON LOAD
			setTimeout(function() {
				if (jQuery('.spb_tabs').length > 0) {
					
					// Show correct tab on page load
					var url = document.location.toString();
					if (url.match('#') && jQuery('.nav-tabs a[href="#'+url.split('#')[1]+'"]').length > 0) {
					    var thisTab = jQuery('.nav-tabs a[href="#'+url.split('#')[1]+'"]'),
					    	parentTabs = thisTab.parents('.spb_tabs'),
					    	tabHash = url.split('#')[1];
					    
					    jQuery('.nav-tabs a[href="#'+tabHash+'"]').tab('show');
					} 
					
					// Change hash on tab click
					jQuery('.nav-tabs a').click(function (e) {
						var hash = e.target.hash;
						
						if (history.pushState) {
						    history.pushState(null, null, hash);
						} else {
						    location.hash = hash;
						}
					});
				}
			}, 50);
		},
		toggle: function() {
			jQuery('.spb_toggle').click(function() {
				if ( jQuery(this).hasClass('spb_toggle_title_active') ) {
					jQuery(this).removeClass('spb_toggle_title_active').next().slideUp(500);
				} else {
					jQuery(this).addClass('spb_toggle_title_active').next().slideDown(500);
				}
			});
			jQuery('.spb_toggle_content').each(function() {
				if ( jQuery(this).next().is('h4.spb_toggle') === false ) {
					jQuery('<div class="last_toggle_el_margin"></div>').insertAfter(this);
				}
			});
		},
		initSkillBars: function() {		
			// SKILL BARS
			widgets.animateSkillBars();
			jQuery('a.ui-tabs-anchor').click(function(){
				widgets.animateSkillBars();
			});
		},
		animateSkillBars: function() {
			jQuery('.progress').each(function(){
				var progress = jQuery(this);
				
				progress.appear(function() {
					var progressValue = progress.find('.bar').attr('data-value');
					
					if (!progress.hasClass('animated')) {
						progress.addClass('animated');
						progress.find('.bar').animate({
							width: progressValue + "%"
						}, 800, function() {
							progress.parent().find('.bar-text .progress-value').fadeIn(600);
						});
					}
				});
			});
		},
		charts: function() {
			widgets.animateCharts();
		},
		animateCharts: function() {
			jQuery('.chart-shortcode').each(function(){
				var chart = jQuery(this);
				chart.appear(function() {
					if (!jQuery(this).hasClass('animated')) {
						jQuery(this).addClass('animated');
						var animatePercentage = parseInt(jQuery(this).attr('data-animatepercent'), 10);
						jQuery(this).data('easyPieChart').update(animatePercentage);
					}
				});
			});
		},
		fullWidthVideo: function() {			
			jQuery(document).on('click', '.fw-video-link', function() {
				if (jQuery(this).data('video') !== "") {
					widgets.openFullWidthVideo(jQuery(this));
				}
				return false;
			});
			
			jQuery(document).on('click', '.fw-video-close', function() {
				widgets.closeFullWidthVideo();
			});
		},
		openFullWidthVideo: function(element) {
			jQuery('.fw-video-close').addClass('is-open');
			jQuery('.fw-video-spacer').animate({
				height: windowheight
			}, 1000, 'easeInOutExpo');
			
			jQuery('.fw-video-area').css('display', 'block').animate({
				top: 0,
				height: '100%'
			}, 1000, 'easeInOutExpo', function() {
				// load video here
				jQuery('.fw-video-area').append('<iframe class="fw-video" src="'+element.data('video')+'" width="100%" height="100%" frameborder="0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen=""></iframe>');
			});
		},
		closeFullWidthVideo: function() {
			jQuery('.fw-video-close').removeClass('is-open');
			jQuery('.fw-video-spacer').animate({
				height: 0
			}, 1000, 'easeInOutExpo', function(){
			});
			jQuery('.fw-video-area').animate({
				top:'-100%'
			}, 1000, 'easeInOutExpo', function() {
				jQuery('.fw-video-area').css('display', 'none');
				jQuery('.fw-video-area .fw-video').remove();
			});
			
			// pause videos
			jQuery('.fw-video-area video').each(function(){
				this.pause();
			});
			setTimeout(function() {
				jQuery('.fw-video-area').find('iframe').remove();
			}, 1500);
			
			return false;
		},
		introAnimations: function() {
			
			if (!isMobileAlt) {
				jQuery('.sf-animation').each(function() {
	
					var animatedItem = jQuery(this),
						itemAnimation = animatedItem.data('animation'),
						itemDelay = animatedItem.data('delay');
										
					animatedItem.appear(function() {				
						if (itemAnimation == 'fade-from-left') {
							animatedItem.delay(itemDelay).animate({
								'opacity' : 1,
								'left' : '0px'
							}, 600, 'easeOutCubic');
						} else if (itemAnimation == 'fade-from-right') {
							animatedItem.delay(itemDelay).animate({
								'opacity' : 1,
								'right' : '0px'
							}, 600, 'easeOutCubic');
						} else if(itemAnimation == 'fade-from-bottom') {
							if (animatedItem.hasClass('image-banner-content')) {
								animatedItem.delay(itemDelay).animate({
									'opacity' : 1,
									'bottom' : '50%'
								}, 1000, 'easeOutCubic');
							} else {
								animatedItem.delay(itemDelay).animate({
									'opacity' : 1,
									'bottom' : '0px'
								}, 600, 'easeOutCubic');
							}
						} else if (itemAnimation == 'fade-in') {
							animatedItem.delay(itemDelay).animate({
								'opacity' : 1
							}, 600, 'easeOutCubic');
						} else if (itemAnimation == 'grow') {
							setTimeout(function(){ 
								animatedItem.addClass('sf-animate');
							}, itemDelay);
						} else {
							setTimeout(function() {
								animatedItem.addClass('sf-animate');						
							}, itemDelay);
						}
					}, {accX: 0, accY: -150}, 'easeInCubic');
				
				});
			}
		},
		iconBoxes: function() {
			if (isMobileAlt) {
				jQuery('.sf-icon-box').on('click', function() {
					jQuery(this).addClass('sf-mobile-hover');
				});
			} else {
				jQuery('.sf-icon-box').hover(
					function() {
						jQuery(this).addClass('sf-hover');
					}, function() {
						jQuery(this).removeClass('sf-hover');
					}
				);
			}
		},
		countAssets: function() {
			jQuery('.sf-count-asset').each(function() {

				var countAsset = jQuery(this),
					countNumber = countAsset.find('.count-number'),
					countDivider = countAsset.find('.count-divider').find('span'),
					countSubject = countAsset.find('.count-subject');
				
				if (!isMobileAlt) {						
					countAsset.appear(function() {				
					
						countNumber.countTo({
							onComplete: function () {
								countDivider.animate({
									'width': 50
								}, 400, 'easeOutCubic');
								countSubject.delay(100).animate({
									'opacity' : 1,
									'bottom' : '0px'
								}, 600, 'easeOutCubic');
							}
						});
						
					}, {accX: 0, accY: -150}, 'easeInCubic');
				} else {
					countNumber.countTo({
						onComplete: function () {
							countDivider.animate({
								'width': 50
							}, 400, 'easeOutCubic');
							countSubject.delay(100).animate({
								'opacity' : 1,
								'bottom' : '0px'
							}, 600, 'easeOutCubic');
						}
					});
				}
			
			});
		},
		countdownAssets: function() {
			jQuery('.sf-countdown').each(function() {
				var countdownInstance = jQuery(this),
					year = parseInt(countdownInstance.data('year'), 10),
					month = parseInt(countdownInstance.data('month'), 10),
					day = parseInt(countdownInstance.data('day'), 10),
					hour = parseInt(countdownInstance.data('hour'), 10),
					countdownDate = new Date(year, month - 1, day, hour),
					type = countdownInstance.data('type');
				
				var labelStrings = jQuery('#countdown-locale'),
					pluralLabels = [labelStrings.data('label_years'),labelStrings.data('label_months'),labelStrings.data('label_weeks'),labelStrings.data('label_days'),labelStrings.data('label_hours'),labelStrings.data('label_mins'),labelStrings.data('label_secs')],
					singularLabels = [labelStrings.data('label_year'),labelStrings.data('label_month'),labelStrings.data('label_week'),labelStrings.data('label_day'),labelStrings.data('label_hour'),labelStrings.data('label_min'),labelStrings.data('label_sec')];
				
				if (type == "countup") {
					countdownInstance.countdown({
						since: countdownDate,
						format: 'dHMS',
						labels: pluralLabels,
						labels1: singularLabels,
						onExpiry: function() {
							setTimeout(function() {
								countdownInstance.fadeOut(500);						
							}, 1000);
						}
					});
				} else {
					countdownInstance.countdown({
						until: countdownDate,
						since: null,
						format: 'dHMS',
						labels: pluralLabels,
						labels1: singularLabels,
						onExpiry: function() {
							setTimeout(function() {
								countdownInstance.fadeOut(500);						
							}, 1000);
						}
					});
				}
			});
		},
		imageBanners: function() {
			jQuery('.sf-image-banner').each(function() {
				jQuery(this).find('.image-banner-content').vCenter();
			});
		}
	};
	
	
	/////////////////////////////////////////////
	// TEAM MEMBERS FUNCTION
	/////////////////////////////////////////////
	
	var teamMembers = {
		init: function() {
			// TEAM EQUAL HEIGHTS
			var team = jQuery('.team-members.carousel-items');
			team.imagesLoaded(function () {
				team.equalHeights();
			});
			
			// TEAM ASSETS
			$window.smartresize( function() {
				jQuery('.team-members.carousel-items').children().css('min-height','0');
				jQuery('.team-members.carousel-items').equalHeights();
			});
		}
	};
	
	
	/////////////////////////////////////////////
	// PARALLAX FUNCTION
	/////////////////////////////////////////////
	
	var parallax = {
		init: function(reset) {

			jQuery('.spb_parallax_asset').each(function(reset) {

				var parallaxAsset = jQuery(this),
					parallaxContent = parallaxAsset.find('div:first');

				if (parallaxAsset.hasClass('sf-parallax-video')) {

					if (!isMobileAlt) {
						parallax.parallaxVideoInit();
					} else {
						parallaxAsset.find('video').remove();

						// Fade in
						parallaxContent.animate({
							'opacity': 1,
						}, 300, 'easeOutExpo');
					}

					// Add resize handler
					$window.smartresize( function() {
						parallax.parallaxVideoResize(parallaxAsset);
					});

				} else if (parallaxAsset.hasClass('parallax-window-height')) {

					parallaxAsset.css('height', '');
					var assetHeight = $window.height();

					if (parallaxAsset.height() > assetHeight && !reset) {
						assetHeight = parallaxAsset.height();
					}

					parallaxAsset.height(assetHeight - (parseInt(parallaxAsset.css('padding-top'), 10) * 2));
					if (parallaxAsset.data('v-center') === "true") {
						parallaxAsset.find('div:first').vCenterTop();
					}

					// Fade in
					parallaxContent.animate({
						'opacity': 1,
					}, 300, 'easeOutExpo');

					// Add resize handler
					parallax.windowImageResize(parallaxAsset);
					$window.smartresize( function() {
						parallax.windowImageResize(parallaxAsset);
					});
				}
				
				if (parallaxAsset.hasClass('parallax-stellar')) {
					var parallaxSpeed = parallaxAsset.data('stellar-background-ratio');
					parallaxAsset.parallax("50%", parallaxSpeed);
				}
			});
		},
		videoScroll: function(asset) {

			var offsetTop = asset.offset().top,
				windowTop = $window.scrollTop(),
				defaultHeight = parseInt(asset.data('height-default'), 10),
				diff = windowTop - offsetTop,
				currentTop = asset.find('.spb_content_wrapper').css('top'),
				heightDifference = defaultHeight - diff * 1.5;

			if (windowTop > offsetTop) {
				asset.css('height', heightDifference);
				asset.find('.spb_content_wrapper').css('opacity', 1 - (diff / 300));
				if (asset.hasClass('parallax-window-height') && asset.data('v-center') === "true") {
				asset.find('.spb_content_wrapper').css('top', currentTop + (diff / 4));
				} else if (asset.data('v-center') === "true") {
				asset.find('.spb_content_wrapper').css('top', (diff / 3));
				}
			} else {
				asset.css('height', defaultHeight);
				asset.find('.spb_content_wrapper').css('opacity', 1);
				if (asset.hasClass('parallax-video-height') && asset.data('v-center') === "true") {
				asset.find('.spb_content_wrapper').css('top', '50%');
				} else {
				asset.find('.spb_content_wrapper').css('top', 0);
				}
			}

		},
		windowImageResize: function(asset) {

			if (asset.hasClass('spb-row-container')) {

				var rowContentHeight = asset.find('> .spb_content_element').height();

				if (asset.hasClass('parallax-window-height')) {

					if (rowContentHeight < $window.height()) {
						rowContentHeight = $window.height();
					}
				}

				asset.height(rowContentHeight);

				if (asset.data('v-center')) {
				asset.find('> .spb_content_element').vCenterTop();
				}

			} else {

				var assetHeight = asset.height();

				if (asset.hasClass('parallax-window-height')) {

					if (assetHeight < $window.height()) {
						assetHeight = $window.height();
					}
				}

				asset.height(assetHeight - asset.css('padding-top') / 2);
				asset.find('.spb_content_wrapper').vCenterTop();
			}

		},
		parallaxVideoInit: function() {
			jQuery('.spb_parallax_asset.sf-parallax-video').each(function() {
				var parallaxAsset = jQuery(this),
					parallaxVideo = parallaxAsset.find('video'),
					parallaxVideoWidth = parallaxVideo.width(),
					parallaxContent = parallaxAsset.find('div:first'),
					parallaxAssetHeight = 0;

				if (parallaxAsset.hasClass('parallax-window-height')) {

					if (parallaxContent.height() > $window.height()) {
						parallaxAssetHeight = parallaxContent.height();
					} else {
						parallaxAssetHeight = $window.height();
					}

					parallaxAsset.animate({
						'height': parallaxAssetHeight
					}, 400);

					setTimeout(function() {

						// Scale video
						parallax.parallaxVideoResize(parallaxAsset);

						// Fade in
						parallaxContent.animate({
							'opacity': 1,
						}, 300, 'easeOutExpo');

					}, 500);

					setTimeout(function() {
						parallaxAsset.find('.video-overlay').animate({
							'opacity': 0.8
						}, 200);
					}, 100);

					if (parallaxAsset.data('v-center') === "true") {
					parallaxContent.vCenterTop();
					}

					setTimeout(function() {
						parallaxContent.animate({
							'opacity': 1,
							'top': '50%'
						}, 600, 'easeOutExpo');
					}, 600);

					parallaxAsset.attr('data-height-default', parallaxVideo.height());

				} else {
					parallax.scaleVideo(parallaxAsset);
				}

				if ($window.width() < parallaxVideoWidth) {
					parallaxVideo.css('left', - (parallaxVideoWidth - $window.width()) /2);
				}
				
				var videoInstance = parallaxVideo.get( 0 );
				videoInstance.load();
				videoInstance.addEventListener( 'loadeddata' , function() {
				        parallax.parallaxVideoResize(parallaxAsset);
				    }
				);

			});
		},
		parallaxVideoResize: function(parallaxAsset) {
			var parallaxContent = parallaxAsset.find('div:first'),
				parallaxAssetHeight = 0;

			if (parallaxAsset.hasClass('parallax-window-height')) {
				if (parallaxContent.height() > $window.height()) {
					parallaxAssetHeight = parallaxContent.height();
				} else {
					parallaxAssetHeight = $window.height();
				}

				parallaxAsset.animate({
					'height': parallaxAssetHeight
				}, 400);

				if (parallaxAsset.data('v-center') === "true") {
				parallaxContent.vCenterTop();
				}
			}

			parallax.scaleVideo(parallaxAsset);
		},
		scaleVideo: function(parallaxAsset) {

			var video = parallaxAsset.find('video'),
				assetHeight = parallaxAsset.outerHeight(),
				assetWidth = parallaxAsset.outerWidth(),
				videoWidth = video[0].videoWidth,
				videoHeight = video[0].videoHeight;

			// Use the largest scale factor of horizontal/vertical
			var scale_h = assetWidth / videoWidth;
			var scale_v = assetHeight / videoHeight;
			var scale = scale_h > scale_v ? scale_h : scale_v;

			// Update minium width to never allow excess space
			var min_w = videoWidth/videoHeight * (assetHeight+20);

			// Don't allow scaled width < minimum video width
			if (scale * videoWidth < min_w) {scale = min_w / videoWidth;}

			// Scale the video
			video.width(Math.ceil(scale * videoWidth +2));
			video.height(Math.ceil(scale * videoHeight +50));
			video.css('margin-top', - (video.height() - assetHeight) /2);
			video.css('margin-left', - (video.width() - assetWidth) /2);
		},

	};
	
	/////////////////////////////////////////////
	// LIGHTBOX FUNCTION
	/////////////////////////////////////////////
	
	var lightbox = {
		init: function() {
			// Lightbox Social
			var lightboxSocial = {};
			if (lightboxSharing) {
				lightboxSocial = {
					facebook: {
						source: 'https://www.facebook.com/sharer/sharer.php?u={URL}',
						text: 'Share on Facebook'
					},
					twitter: true,
					googleplus: true,
					pinterest: {
						source: "https://pinterest.com/pin/create/bookmarklet/?url={URL}",
						text: "Share on Pinterest"
					}
				};
			}
					
			// Lightbox Galleries
			var galleryArr = [];
			jQuery('[data-rel^="ilightbox["]').each(function () {
				var attr = this.getAttribute("data-rel");
				if ( jQuery(this).hasClass( 'ilightbox-enabled' ) ) {
					return;
				}
				if (jQuery.inArray(attr, galleryArr) == -1 ) {
					galleryArr.push(attr);
				}
			});
			jQuery.each(galleryArr, function (b, c) {
				jQuery('[data-rel="' + c + '"]').iLightBox({
					skin: lightboxSkin,
					social: {
						buttons: lightboxSocial
					},
					minScale: 0.1,
					maxScale: 0.6,
					path: 'horizontal',
					thumbnails: {
						maxWidth: 120,
						maxHeight: 120
					},
					controls: {
						arrows: lightboxControlArrows,
						thumbnail: lightboxThumbs
					}
				});
				jQuery('[data-rel="' + c + '"]').addClass( 'ilightbox-enabled' );
			});
		}
	};
	
	
	/////////////////////////////////////////////
	// MAP FUNCTIONS
	/////////////////////////////////////////////
	
	var map = {
		init:function() {
			
			var maps = jQuery('.map-canvas');
			maps.each(function(index, element) {
				var mapContainer = element,
					mapAddress = mapContainer.getAttribute('data-address'),
					mapZoom = mapContainer.getAttribute('data-zoom'),
					mapType = mapContainer.getAttribute('data-maptype'),
					mapColor = mapContainer.getAttribute('data-mapcolor'),
					mapSaturation = mapContainer.getAttribute('data-mapsaturation'),
					pinLogoURL = mapContainer.getAttribute('data-pinimage'),
					pinLink = mapContainer.getAttribute('data-pinlink');
				
				map.getCoordinates(mapAddress, mapContainer, mapZoom, mapType, mapColor, mapSaturation, pinLogoURL, pinLink);
								
			});
			jQuery('ul.nav-tabs li a').click(function(){
				var thisTabHref = jQuery(this).attr('href');
				if (jQuery(thisTabHref).find('.spb_gmaps_widget').length > 0) {
					map.init();
				}
			});
			
			jQuery('.spb_accordion_section > h3 a').click(function(){
				var thisAccordion = jQuery(this).parents('.spb_accordion_section');
				if (thisAccordion.find('.spb_gmaps_widget').length > 0) {
					map.init();
				}
			});
			
		},
		getCoordinates: function(address, mapContainer, mapZoom, mapType, mapColor, mapSaturation, pinLogoURL, pinLink) {
			var geocoder;
			geocoder = new google.maps.Geocoder();			
			geocoder.geocode({
				'address': address
			}, function(results, status) {
				if (status == google.maps.GeocoderStatus.OK) {
					
					if (mapSaturation == "mono") {
						mapSaturation = -100;
					} else {
						mapSaturation = -20;
					}
					
					var styles = [
						{
							stylers: [
								{hue: mapColor},
								{saturation: mapSaturation}
							]
						}
					];
					
					var styledMap = new google.maps.StyledMapType(styles,{name: "Styled Map"});  
					
					var mapTypeIdentifier = "",
						companyPos = "",
						isDraggable = true,
						mapCoordinates = results[0].geometry.location,
						latitude = results[0].geometry.location.lat(),
						longitude = results[0].geometry.location.lng();				
					
					if (isMobileAlt) {
					isDraggable = false;
					}
					
					if (mapType === "SATELLITE") {
					mapTypeIdentifier = google.maps.MapTypeId.SATELLITE;
					} else if (mapType === "TERRAIN") {
					mapTypeIdentifier = google.maps.MapTypeId.TERRAIN;
					} else if (mapType === "HYBRID") {
					mapTypeIdentifier = google.maps.MapTypeId.HYBRID;
					} else {
					mapTypeIdentifier = google.maps.MapTypeId.ROADMAP;
					}
							
					var latlng = new google.maps.LatLng(latitude, longitude);
					var settings = {
						zoom: parseInt(mapZoom, 10),
						scrollwheel: false,
						center: latlng,
						draggable: isDraggable,
						mapTypeControl: true,
						mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
						navigationControl: true,
						navigationControlOptions: {style: google.maps.NavigationControlStyle.SMALL},
						mapTypeId: mapTypeIdentifier
					};
					var mapInstance = new google.maps.Map(mapContainer, settings);
					var companyMarker = "";
					
					// ADD MARKER AFTER 1 SECOND
					jQuery(mapContainer).appear(function() {
						setTimeout(function() {
							if (pinLogoURL) {
								var companyLogo = new google.maps.MarkerImage(pinLogoURL,
									new google.maps.Size(150,75),
									new google.maps.Point(0,0),
									new google.maps.Point(75,75)
								);
								companyPos = new google.maps.LatLng(latitude, longitude);
								companyMarker = new google.maps.Marker({
									position: mapCoordinates,
									map: mapInstance,
									icon: companyLogo,
									animation: google.maps.Animation.DROP
								});
							} else { 
								companyPos = new google.maps.LatLng(latitude, longitude);
								companyMarker = new google.maps.Marker({
									position: mapCoordinates,
									map: mapInstance,
									animation: google.maps.Animation.DROP
								});
							}
							
							google.maps.event.addListener(companyMarker, 'click', function() {
								//window.location.href = 'http://maps.google.com/maps?q='+companyPos;
								if (pinLink === "") {
									pinLink = 'http://maps.google.com/maps?q='+companyPos;
								}
								window.open(pinLink);
							});
							
							google.maps.event.addDomListener(window, 'resize', function() {
								mapInstance.setCenter(companyPos);
							});
						}, 1000);
					});
								
					// MAP COLOURIZE
					if (mapColor !== "") {
					mapInstance.mapTypes.set('map_style', styledMap);
					mapInstance.setMapTypeId('map_style');
					}

				} else {
					console.log(status);
				}
			});			
		}
	};
		
	
	/////////////////////////////////////////////
	// RELOAD FUNCTIONS
	/////////////////////////////////////////////
	
	var reloadFunctions = {
		init:function() {	
	
			// Remove title attributes from images to avoid showing on hover 
			jQuery('img[title]').each(function() {
				jQuery(this).removeAttr('title');
			});
			
			if (!isAppleDevice) {
				jQuery('embed').show();
			}
						
			// Animate Top Links
			jQuery('.animate-top').on('click', function(e) {
				e.preventDefault();
				jQuery('body,html').animate({scrollTop: 0}, 800, 'easeOutCubic');           
			});
		},
		load:function() {
			if (!isMobile) {
			
				// Button hover tooltips
				jQuery('.tooltip').each( function() {
					jQuery(this).css( 'marginLeft', '-' + Math.round( (jQuery(this).outerWidth(true) / 2) ) + 'px' );
				});
				
				jQuery('.comment-avatar').hover( function() {
					jQuery(this).find('.tooltip' ).stop().animate({
						bottom: '44px',
						opacity: 1
					}, 500, 'easeInOutExpo');
				}, function() {
						jQuery(this).find('.tooltip').stop().animate({
							bottom: '25px',
							opacity: 0
						}, 400, 'easeInOutExpo');
				});
				
				jQuery('.grid-image').hover( function() {
					jQuery(this).find('.tooltip' ).stop().animate({
						bottom: '85px',
						opacity: 1
					}, 500, 'easeInOutExpo');
				}, function() {
						jQuery(this).find('.tooltip').stop().animate({
							bottom: '65px',
							opacity: 0
						}, 400, 'easeInOutExpo');
				});
				
				
				// HASH CHECK
				setTimeout(function() {
				 	var urlHash = document.location.toString();
					if (urlHash.match('#')) {
					    var hash = urlHash.split('#')[1];
					    		   
					    if ( jQuery('#' + hash).length > 0 ) {
					        var headerHeight = 0;
					        	
					        if (jQuery('.sticky-header').length > 0) {
					        	headerHeight = jQuery('.sticky-header').height();
					        }
					        if (jQuery('#wpadminbar').length > 0) {
					        	headerHeight = headerHeight + 28;
					        }
					        
					        jQuery('html, body').stop().animate({
					        	scrollTop: jQuery('#' + hash).offset().top - headerHeight - 30
					        }, 600, 'easeInOutExpo');
					        
					        e.preventDefault();
					    }
					}
				}, 200);	
			}
		}
	};
	
	
	/////////////////////////////////////////////
	// GLOBAL VARIABLES
	/////////////////////////////////////////////
	
	var $window = jQuery(window),
		body = jQuery('body'),
		sfIncluded = jQuery('#sf-included'),
		sfOptionParams = jQuery('#sf-option-params'),
		windowheight = page.getViewportHeight(),
		deviceAgent = navigator.userAgent.toLowerCase(),
		isMobile = deviceAgent.match(/(iphone|ipod|android|iemobile)/),
		isMobileAlt = deviceAgent.match(/(iphone|ipod|ipad|android|iemobile)/),
		isAppleDevice = deviceAgent.match(/(iphone|ipod|ipad)/),
		isIEMobile = deviceAgent.match(/(iemobile)/),
		IEVersion = page.checkIE(),
		isRTL = false,
		lightboxControlArrows = sfOptionParams.data('lightbox-nav') === "arrows" ? true : false,
		lightboxThumbs = sfOptionParams.data('lightbox-thumbs') ? true : false,
		lightboxSkin = sfOptionParams.data('lightbox-skin') === "dark" ? "metro-black" : "metro-white",
		lightboxSharing = sfOptionParams.data('lightbox-sharing') ? true : false,
		sliderAuto = sfOptionParams.data('slider-autoplay') ? true : false,
		sliderSlideSpeed = sfOptionParams.data('slider-slidespeed'),
		sliderAnimSpeed = sfOptionParams.data('slider-animspeed');
		
	/////////////////////////////////////////////
	// LOAD + READY FUNCTION
	/////////////////////////////////////////////
		
	var onReady = {
		init: function(){
			page.init();
			if (jQuery('.sf-super-search').length > 0) {
			superSearch.init();
			}
			if (jQuery('#header-section').length > 0) {
			header.init();
			}
			nav.init();
			lightbox.init();
			if (sfIncluded.hasClass('has-products') || body.hasClass('woocommerce-cart') || body.hasClass('woocommerce-account')) {
			woocommerce.init();
			}
			if (sfIncluded.hasClass('has-portfolio')) {
			portfolio.init();
			}
			if (sfIncluded.hasClass('has-portfolio-showcase')) {
			portfolio.portfolioShowcaseInit();
			}
			if (sfIncluded.hasClass('has-blog')) {
			blog.init();
			}
			if (sfIncluded.hasClass('has-infscroll') && !isMobile) {
			blog.infiniteScroll();
			}
			widgets.init();
			if (sfIncluded.hasClass('has-team')) {
			//teamMembers.init();
			}
			if (sfIncluded.hasClass('has-carousel')) {
			carouselWidgets.init();
			}
			if (sfIncluded.hasClass('has-parallax')) {
			parallax.init();
			}
			reloadFunctions.init();
		}
	};
	var onLoad = {
		init: function(){
			nav.load();
			flexSlider.init();
			if (sfIncluded.hasClass('has-gallery')) {
			flexSlider.gallery();
			}
			if (sfIncluded.hasClass('has-chart')) {
			widgets.charts();
			}
			if (sfIncluded.hasClass('has-progress-bar')) {
			widgets.initSkillBars();
			}
			if (sfIncluded.hasClass('has-map')) {
			map.init();
			}
			reloadFunctions.load();
			woocommerce.variations();
			
			// ANCHOR ON LOAD
			var anchorID = window.location.hash;
			if (anchorID !== "" && jQuery(anchorID).length > 0) {	
				setTimeout(function() {
					var anchorPosition = jQuery(anchorID).offset(); 
					jQuery('body,html').scrollTop(anchorPosition.top - 200); 
				}, 300);
			}
		}
	};
	
	jQuery(document).ready(onReady.init);
	jQuery(window).load(onLoad.init);
	
})(jQuery);
