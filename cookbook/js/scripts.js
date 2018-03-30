"use strict";

/*************************************************************
SCRIPTS INDEX

ISOTOPE: INIT
FLEXSLIDER INIT
FANCYBOX INIT
OWL CAROUSEL INIT
MOSAIC INIT
MINOR PLUGINS INIT
		// FITVIDS
		// CLEANTABS
		// SCROLL UP
		// EMBED SCROLL PROTECT
 	  	// STELLAR PARALLAX
SIDR RESPONSIVE MENU
SLIDER NAVIGATION ON HOVER ONLY
AJAX MULTIPOST PAGINATION
COUNTDOWN
CLICKABLE BACKGROUND
STICKY HEADER
	SCROLL TO ANCHOR
	SEARCH BUTTON
SEARCH AUTOCOMPLETE
@FONT-FACE FIX
LAZY LOAD ANIMATION
RATINGS BAR
USER RATING
INFO BOX LIST CHECK
CANON PARALLAX SCROLLING
COMMENTS FORM FIX

*************************************************************/

 
/*************************************************************
ISOTOPE: INIT
*************************************************************/

	// ARCHIVE MASONRY INIT
	jQuery(document).ready(function($) {

		if ($('.archive-masonry-container').size() == 0) { return; }

		var $archiveMasonryContainer = $('.archive-masonry-container');

		// INIT
		$archiveMasonryContainer.isotope({
			itemSelector: '.single-item',
			masonry: {
				columnWidth: '.grid-sizer',
				gutter: '.gutter-sizer',
			},
		});

		// RELAYOUT ON IMAGES LOADED
		$archiveMasonryContainer.imagesLoaded( function() {
		  	$archiveMasonryContainer.isotope('layout');
		});	

		// RELAYOUT ON WINDOW LOADED
		$(window).load(function() {
			$('.archive-masonry-container').isotope('layout');
		});

	});



/*************************************************************
FLEXSLIDER INIT
*************************************************************/

	jQuery(window).load(function($){
		$ = jQuery;

		// STANDARD FLEXSLIDER
		if ($('.flexslider-default').size() > 0) {

			var canonAnimImgSliderSlidershow = (extData.canonOptionsAppearance['anim_img_slider_slideshow'] == 'checked') ? true : false;

			$('.flexslider-default').flexslider({
				slideshow: canonAnimImgSliderSlidershow,
				slideshowSpeed: parseInt(extData.canonOptionsAppearance['anim_img_slider_delay']),
				animationSpeed: parseInt(extData.canonOptionsAppearance['anim_img_slider_anim_duration']),
				animation: "fade",
				smoothHeight: true,
				touch: true,
				controlNav: true,
				prevText: "&#xf104;",
				nextText: "&#xf105;",
				start: function(slider){
					$('body').removeClass('loading');
				},
				after: function(slider) {
					if ($('.archive-masonry-container').size() > 0) {
						$('.archive-masonry-container').isotope('layout');							
					}
				},
			});

		}

		// FLEXSLIDER QUOTE
		if (($('.flexslider-quote').size() > 0) && ($('#hp_tweets').size() === 0)) {

			var canonAnimQuoteSliderSlidershow = (extData.canonOptionsAppearance['anim_quote_slider_slideshow'] == 'checked') ? true : false;

			$('.flexslider-quote').flexslider({
				slideshow: canonAnimQuoteSliderSlidershow,
				slideshowSpeed: parseInt(extData.canonOptionsAppearance['anim_quote_slider_delay']),
				animationSpeed: parseInt(extData.canonOptionsAppearance['anim_quote_slider_anim_duration']),
				animation: "fade",
				smoothHeight: true,
				touch: true,
				directionNav: false,
				start: function(slider){
					$('body').removeClass('loading');
				}
			});	 

		}

	});


/*************************************************************
FANCYBOX INIT
*************************************************************/

	//attach fanybox class to all image links
	jQuery(document).ready(function($) {
		$("a[href$='.jpg'],a[href$='.png'],a[href$='.gif']").attr('rel','gallery').addClass('fancybox');
	});

	//init fancybox
	jQuery(document).ready(function($) {

		// default fancybox
		if ($(".fancybox").size() > 0) {
			var canonLightboxColor = extData.canonOptionsAppearance['lightbox_overlay_color'];
			var canonLightboxOpacity = extData.canonOptionsAppearance['lightbox_overlay_opacity'];;

			$(".fancybox").fancybox({

				openEffect	: 'fade',	//fade, elastic, none
				closeEffect	: 'fade',
				openSpeed	: 'normal',	//slow, normal, fast or ms
				closeSpeed	: 'fast',

				helpers : {
			        overlay : {
			            css : {
			                'background' : jQuery.GlobalFunctions.hexOpacityToRgbaString(canonLightboxColor, canonLightboxOpacity)
			            }
			        }
			    }
			});
		}


		// media fancybox - same as fancybox but lets you open media links in lightbox and set a max height of 500px
		if ($(".fancybox-media").size() > 0) {
			var canonLightboxColor = extData.canonOptionsAppearance['lightbox_overlay_color'];
			var canonLightboxOpacity = extData.canonOptionsAppearance['lightbox_overlay_opacity'];;

			$(".fancybox-media").fancybox({

				openEffect	: 'fade',	//fade, elastic, none
				closeEffect	: 'fade',
				openSpeed	: 'normal',	//slow, normal, fast or ms
				closeSpeed	: 'fast',

				helpers : {
			        overlay : {
			            css : {
			                'background' : jQuery.GlobalFunctions.hexOpacityToRgbaString(canonLightboxColor, canonLightboxOpacity)
			            },
			        },
					media : {},
			    },

			    maxHeight: '500',

			});
		}

	});


/*************************************************************
OWL CAROUSEL INIT
*************************************************************/
	
	jQuery(document).ready(function($) {

		setTimeout(function(){ 			// Visual Composer front end editor fix

			// bouncer
			if ($(".canon-posts-carousel").size() == 0) { return; }

			// for each canon-posts-carousel read settings and init
			$('.canon-posts-carousel').each(function(index){
				var $this = $(this);
				var displayNumPosts = $this.attr('data-display_num_posts');
				var slideSpeed = $this.attr('data-slide_speed');
				var autoPlay = ($this.attr('data-autoplay_speed') === "0") ? false : parseInt($this.attr('data-autoplay_speed'));
				var stopOnHover = ($this.attr('data-stop_on_hover') == 'checked') ? true : false;
				var pagination = ($this.attr('data-hide_pagination') == 'checked') ? false : true;

				// responsive num posts
				var numPostsDesktop = 4;
				var numPostsDesktopSmall = 3;
				var numPostsTablet = 2;
				var numPostsMobile = 1;
				if (displayNumPosts < numPostsDesktop) { numPostsDesktop = displayNumPosts; }
				if (displayNumPosts < numPostsDesktopSmall) { numPostsDesktopSmall = displayNumPosts; }
				if (displayNumPosts < numPostsTablet) { numPostsTablet = displayNumPosts; }
				if (displayNumPosts < numPostsMobile) { numPostsMobile = displayNumPosts; }


				$this.canonOwlCarousel({
					items: parseInt(displayNumPosts),
					slideSpeed: parseInt(slideSpeed),
					autoPlay: autoPlay,
					stopOnHover: stopOnHover,
					addClassActive: true,
					pagination: pagination,
					itemsDesktop: [1199,numPostsDesktop],
					itemsDesktopSmall: [979,numPostsDesktopSmall],
					itemsTablet: [768,numPostsTablet],
					itemsMobile: [479,numPostsMobile],
					// itemsCustom: [[0, 1], [700, 1], [1000, 2], [1200, 3], [1600, 4]],
				});

				// navigation: next
				$this.prev('.customNavigation').find('.next').on('click', function(event) { 
					$this.trigger('owl.next'); 
					owlAutoHeight($this);
				});

				// navigation: prev
				$this.prev('.customNavigation').find('.prev').on('click', function(event) { 
					$this.trigger('owl.prev'); 
					owlAutoHeight($this);
				});

			});

			// owlAutoHeightAll on load re-adjustment
			jQuery(window).load(function($) { owlAutoHeightAll(); });

		}, 1);


		function owlAutoHeightAll () {
			$('.canon-posts-carousel').each(function(index){
				var $this = $(this);
				owlAutoHeight($this);
			});
				
		}

		function owlAutoHeight ($this) {

			var $owlWrapperOuter = $this.find('.owl-wrapper-outer');
			var $activeItems = $this.find('.owl-item.active');
			var maxHeight = 0;
			$activeItems.each(function (index) {
				var $thisItem = $(this);
				var height = $thisItem.height();
				if (height > maxHeight) { maxHeight = height; }
			});
			$owlWrapperOuter.animate({
				height: maxHeight,
			}, 800);	
		}

	});

/*************************************************************
MOSAIC INIT
*************************************************************/


	jQuery(document).ready(function($) {

		setTimeout(function(){ 			// Visual Composer front end editor fix

			$('.circle').mosaic({
				opacity		:	0.8			//Opacity for overlay (0-1)
			});

			$('.fade').mosaic();

			$('.bar').mosaic({
				animation	:	'slide'		//fade or slide
			});

			$('.bar2').mosaic({
				animation	:	'slide'		//fade or slide
			});

			$('.bar3').mosaic({
				animation	:	'slide',	//fade or slide
				anchor_y	:	'top'		//Vertical anchor position
			});

			$('.cover').mosaic({
				animation	:	'slide',	//fade or slide
				hover_x		:	'400px'		//Horizontal position on hover
			});

			$('.cover2').mosaic({
				animation	:	'slide',	//fade or slide
				anchor_y	:	'top',		//Vertical anchor position
				hover_y		:	'80px'		//Vertical position on hover
			});

			$('.cover3').mosaic({
				animation	:	'slide',	//fade or slide
				hover_x		:	'400px',	//Horizontal position on hover
				hover_y		:	'300px'		//Vertical position on hover
			});

		}, 1);

	});



/*************************************************************
MINOR PLUGINS INIT
*************************************************************/

	jQuery(document).ready(function($) {

	  	// SCROLLUP
	  	$.scrollUp({
	  	    scrollName: 'scrollUp', 	// Element ID
	        scrollDistance: 300,         // Distance from top/bottom before showing element (px)
	        scrollFrom: 'top',           // 'top' or 'bottom'
	        scrollSpeed: 800,            // Speed back to top (ms)
	        easingType: 'linear',        // Scroll to top easing (see http://easings.net/)
	        animation: 'fade',           // Fade, slide, none
	        animationSpeed: 200,         // Animation speed (ms)
	  	    scrollText: '',			 // Text for element, can contain HTML
	        // scrollTrigger: false,        // Set a custom triggering element. Can be an HTML string or jQuery object
	        // scrollTarget: false,         // Set a custom target element for scrolling to. Can be element or number
	        // scrollTitle: false,          // Set a custom <a> title if required.
	        // scrollImg: false,            // Set true to use image
	        // activeOverlay: false,        // Set CSS color to display scrollUp active point, e.g '#00FFFF'
	        // zIndex: 2147483647           // Z-Index for the overlay
		});


		// FITVIDS
		setTimeout(function(){ 			// Visual Composer front end editor fix
			$(".body-wrapper").fitVids();
		}, 1);


		// CLEANTABS
		$('.canon-cleanTabs-container').each(function (index) {
			var $this = $(this);
			$this.cleanTabs({
				"speed": 400
			});

			// CLEANTABS INIT
			$this.find('.tab_content').hide();
			$this.find('.v_active').next('.tab_content').show();

		});


		// EMBED SCROLL PROTECT
		$('.embed-scroll-protect').embedScrollProtect();


 	  	// STELLAR PARALLAX
		// $(window).stellar({
	 //  		horizontalScrolling: false,
	 //  	});


	});


/*************************************************************
SIDR RESPONSIVE MENU
*************************************************************/

	jQuery(document).ready(function($) {

		// SIDR
		$('.responsive-menu-button').sidr({
		    name: 'sidr-main',
		    source: '#sidr-navigation-container',
		    renaming: false,
		});
		$('#sidr-main .closebtn').click(function() {
		    $.sidr('close', 'sidr-main');
		});

	});

	jQuery(window).resize(function() {

		// SIDR CLOSE ON RESIZE
		jQuery.sidr('close', 'sidr-main');
		
	});



/*************************************************************
SLIDER NAVIGATION ON HOVER ONLY
*************************************************************/


	jQuery(window).load(function($) {
		$=jQuery;
		
		if ($('.flexslider ul.flex-direction-nav').size() > 0) {

			var $slidesNavArrows = $('.flex-direction-nav');
			var $slidesNavBullets = $('.feature .flex-control-nav.flex-control-paging');
			$slidesNavArrows.hide();
			$slidesNavBullets.hide();

			//on slider hover
			$('.flexslider').hover(function () {
				$slidesNavArrows.fadeIn();
				$slidesNavBullets.fadeIn();
			}, function() {
				$slidesNavArrows.hide();
				$slidesNavBullets.hide();
			});

			//on navigation button hover
			$slidesNavArrows.hover(function () {
				$slidesNavArrows.show();
				$slidesNavBullets.show();
			});

		}


	});





	
/*************************************************************
AJAX MULTIPOST PAGINATION
*************************************************************/


	jQuery(document).ready(function($){

		if ($('.multi_nav_control').size() > 0) {

			// NEXT CLICK
			$('body').on('click', '.multipost_nav_forward', function(e) {
				e.preventDefault();
				var $this = $(this);
				ajaxLoadPostPage($this);
			});

			// PREV CLICK
			$('body').on('click', '.multipost_nav_back', function(e) {
				e.preventDefault();
				var $this = $(this);
				ajaxLoadPostPage($this);
			});

			// DETECT ARROW KEYPRESS
			document.onkeydown = mb_checkKey;

		}


		// DETECT ARROW KEYPRESS FUNCTION
		function mb_checkKey(e) {
		    e = e || window.event;
			// console.log(e.keyCode);		// remember to put focus on window not on console.

		    if (e.keyCode == '39') {
		        $('.multipost_nav_forward').click();
		    }
		    else if (e.keyCode == '37') {
		        $('.multipost_nav_back').click();
		    }
		}
		

		// AJAX
		function ajaxLoadPostPage($this) {
			var newHeightAnimationSpeed = 2300;
			var loadDelay = 500;
			var fadeInSpeed = 1500;
			var link = $this.closest('a').attr('href');
			var link = link + " #content_container > *";
			var $contentContainer = $('#content_container');

			$contentContainer.load(link, function () {
				var $this = $(this);
				$this.wrapInner('<div/>');
				var $innerDiv = $this.find('div').first();
				var $multiContent = $this.find('.multi_content');
				$multiContent.css('opacity',0);

				setTimeout(function() {
					var newHeight = $innerDiv.height();
					$contentContainer.animate({
						height: newHeight
					});
					$multiContent.animate({
						opacity: 1,
					}, fadeInSpeed);
	
				}, loadDelay);

			});


		}

	});



/*************************************************************
COUNTDOWN
*************************************************************/

	jQuery(document).ready(function($){

		//bouncer
		if ($('.countdown').size() == 0) { return; }

		$('.countdown').each(function(index, element) {
			var $this = $(this);

			//get vars
			var labelYears = $this.data('label_years');
			var labelMonths = $this.data('label_months');
			var labelWeeks = $this.data('label_weeks');
			var labelDays = $this.data('label_days');
			var labelHours = $this.data('label_hours');
			var labelMinutes = $this.data('label_minutes');
			var labelSeconds = $this.data('label_seconds');

			var labelYear = $this.data('label_year');
			var labelMonth = $this.data('label_month');
			var labelWeek = $this.data('label_week');
			var labelDay = $this.data('label_day');
			var labelHour = $this.data('label_hour');
			var labelMinute = $this.data('label_minute');
			var labelSecond = $this.data('label_second');

			var labelY = $this.data('label_y');
			var labelM = $this.data('label_m');
			var labelW = $this.data('label_w');
			var labelD = $this.data('label_d');

			var datetimeString = $this.data('datetime_string');
			var gmtOffset = $this.data('gmt_offset');
			var format = $this.data('format');
			var useCompact = $this.data('use_compact');
			var description = $this.data('description');
			var layout = $this.data('layout');


			//handle vars
			if (useCompact == "checked") { var useCompactBool = true; } else { var useCompactBool = false; }
			if (datetimeString == "") { datetimeString = "" }
			layout = (typeof layout != "undefined") ? layout : null;

			// set labels
			var defaultArgs = {
				labels: [labelYears, labelMonths, labelWeeks, labelDays, labelHours, labelMinutes, labelSeconds],
				labels1: [labelYear, labelMonth, labelWeek, labelDay, labelHour, labelMinute, labelSecond],
				compactLabels: [labelY, labelM, labelW, labelD],
				windowhichLabels: null,
				digits: ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'],
				timeSeparator: ':', isRTL: false};
			$.countdown.setDefaults(defaultArgs);

			// set date
			var countdownDatetime = new Date(); 
			// countdownDatetime = new Date(2013, 11, 31, 23, 59, 59, 100);
			countdownDatetime = new Date(datetimeString);

			$this.countdown({
				compactLabels: ['y', 'm', 'w', 'd'],
				until: countdownDatetime,
				timezone: parseInt(gmtOffset),
				format: format,
				compact: useCompactBool,					
				description: description,
				layout: layout,
			}); 
			 
		});

	});



/*************************************************************
CLICKABLE BACKGROUND
*************************************************************/

	jQuery(document).ready(function($){

		if (extData.canonOptions['use_boxed_design'] == "checked") {

			var bgLink = extData.canonOptionsAppearance['bg_link'];

			if (typeof bgLink != "undefined") {
				if (bgLink != "") {
						
					$(document).on('click','body', function(event) {
						if (event.target.nodeName == "BODY") {
							window.open(bgLink, "_blank");
						}
					});
					
				}
			}

		}
	});

/*************************************************************
STICKY HEADER
*************************************************************/

	jQuery(document).ready(function($){

		if ($('.canon_sticky').size() > 0) {

			// add stickyness to these elements
			var stickySelectorClass = ".canon_sticky";
			var $stickyElements = $(stickySelectorClass);
			$stickyElements.each(function(index) {
				$(this).wrap('<div class="sticky_placeholder"></div>');	
			});

			
			// init vars
			var adjustedOffset = 0;
         	var windowPosition = 0;
         	var placeholderOffset = 0;
	        var $win = $(window);

			updateStickyPlaceholderHeights();				// set height of this subject's placeholder
			$win.on('scroll', stickyScrollEvent);

			// UPDATE PLACEHOLDER HEIGHTS ON WINDOW LOAD (TO PROTECT AGAINST LATE ARRIVAL CONTENT)
			$(window).load(function() {
				updateStickyPlaceholderHeights();
			});

         	// ON RESIZE
			$(window).resize(function () {

				// turn off old scroll event to allow for new
				$(window).off('scroll', stickyScrollEvent);

				updateStickyPlaceholderHeights();
				$win.on('scroll', stickyScrollEvent);	

			}); 


		}

		function updateStickyPlaceholderHeights () {

 			$('.canon_sticky').each(function (index) {
				var $stickySubject = $(this);
				var $stickyPlaceholder = $stickySubject.closest('.sticky_placeholder');
				var stickySubjectHeight = $stickySubject.height();

				//maintain height of placeholder
				$stickyPlaceholder.css({
					"display": "block",
					"height": stickySubjectHeight,
				});
			});


		}

		function stickyScrollEvent () {

 			$('.canon_sticky').each(function (index) {
				var $stickySubject = $(this);
		        var $stickyPlaceholder = $stickySubject.closest('.sticky_placeholder');

	        	var originalOffset = getWPAdminBarOffset();

				var placeholderOffset = $stickyPlaceholder.offset().top;
				var adjustedOffset = getAdjustedOffset($stickySubject);
				var startingZIndex = 999;
				var thisZIndex = startingZIndex - index;

	     		windowPosition = $win.scrollTop();

	     		// console.log("windowposition+adjustedoffset: " + (windowPosition+adjustedOffset));
	     		// console.log("placeholderOffset: " + placeholderOffset);

	     		// apply stickyness when scrolling past
	     		if (windowPosition+adjustedOffset >= placeholderOffset) {
	     			// console.log("STICKY ON");
					$stickySubject.css({
					    "position": "fixed",
					    "top": adjustedOffset,
					    "z-index": thisZIndex,
					});
					$stickySubject.addClass('canon_stuck');
	     		}

	     		// remove stickyness when scrolling back over
	     		if (windowPosition+adjustedOffset < placeholderOffset) {
	     			// console.log("STICKY OFF");
					$stickySubject.css({
					    "position": "static",
					    "top": "auto",
					    "z-index": thisZIndex,
					});
					$stickySubject.removeClass('canon_stuck');
	     		}

	     		// if turn off in responsive then remove stickyness from all
				var windowWidth = $(window).width();
				var turnOffWidth = extData.canonOptionsFrame['sticky_turn_off_width'];
				// console.log("window width: " + windowWidth);
				// console.log("turn off width: " + turnOffWidth);
	     		if (windowWidth < turnOffWidth) {
	     			// console.log("STICKY OFF");
					$stickySubject.css({
					    "position": "static",
					    "top": "auto",
					    "z-index": thisZIndex,
					});
					$stickySubject.removeClass('canon_stuck');
	     		}

 			});
		}
		
		function getAdjustedOffset ($stickySubject) {
			var index = $('.sticky_placeholder').index($stickySubject.closest('.sticky_placeholder'));
         	var originalOffset = getWPAdminBarOffset();

			var adjustedOffset = originalOffset;
			var $placeholdersAbove = $('.sticky_placeholder').slice(0, index);
			$placeholdersAbove.each(function (index) {
				var $thisPlaceholder = $(this);
				adjustedOffset = adjustedOffset + $thisPlaceholder.height();	
			});
			return adjustedOffset;
		}

		function getWPAdminBarOffset () {

			var offset = 0;
         	var $wpAdminBar = $('#wpadminbar');
         	if ($wpAdminBar.size() > 0) {
	         	var wpAdminBarPosition = $wpAdminBar.css('position');
	         	var wpAdminBarHeight = $wpAdminBar.height();
	         	offset = (wpAdminBarPosition == "fixed") ? wpAdminBarHeight : 0;
         	}
         	return offset;

		}

	/*************************************************************************
	SCROLL TO ANCHOR

	USE: link #example will scroll to the first element with class "example"
	Can also be linked to other internal pages. So link "http://www.mypage.com/#example" will first load http://www.mypage.com/example and then after a short delay scroll to first element with class "example".
	*************************************************************************/

			jQuery(window).load(function($) {
				$=jQuery;

				var scrollToSelector = '#';
				var onLoadScrollToDelay = 1500;

				// on window load grab the url and scan for # then initiate scroll if this is found
				var href = isolateScrollToHref(document.URL, scrollToSelector);
				if (href !="") { setTimeout(function() { canonScrollToAnchor(href) }, onLoadScrollToDelay); }

				// on click a tag
				$('body').on('click', 'a', function (event) {

					if (typeof $(this).attr('href') == "undefined") { return; } // failsafe against a tags with no href
					var href = isolateScrollToHref($(this).attr('href'), scrollToSelector)
					if (href != "") { canonScrollToAnchor(href); }
						
				});

			});

			function isolateScrollToHref (source, scrollToSelector) {
				if (source.indexOf('#') != -1) {
					var splitArray = source.split(scrollToSelector);
					return splitArray[1];
				} else {
					return "";	
				}
			}

			function canonScrollToAnchor(href){
				var target = $("."+href);

				if (target.size() > 0) {
					var originalOffset = getWPAdminBarOffset();
					var adjustedOffset = originalOffset;

					// first adjust for header stickies
					var $headerStickies = $('.sticky-header-wrapper .canon_sticky');
					$headerStickies.each(function(index) {
						var $thisSticky = $(this);
						adjustedOffset = adjustedOffset + $thisSticky.height();	
					});

					// next adjust for block stickies
					if (target.hasClass('pb_block')) {
						var $blockClosest = target;	
					} else {
						var $blockClosest = target.closest('.pb_block');	
					}
					var $prevStickyBlocks = $blockClosest.prevAll('.sticky_placeholder');
					$prevStickyBlocks.each(function(index) {
						var $thisSticky = $(this);
						adjustedOffset = adjustedOffset + $thisSticky.height();	
					});

					var scrollToOffset = target.offset().top - adjustedOffset;

					$('html,body').animate({scrollTop: scrollToOffset},'slow');
					
				}
			}



	/*************************************************************
	SEARCH BUTTON
	*************************************************************/

			if ($('.toolbar-search-btn').size() > 0) {

				// SEARCH BUTTON CLICK
				$('body').on('click','.toolbar-search-btn', function (event) {
					event.preventDefault();
					var $searchHeaderContainer = $('.search-header-container');
					var status = $searchHeaderContainer.attr('data-status');

					//update status
					if (status == "closed") {
						$searchHeaderContainer.slideDown();
						$searchHeaderContainer.attr('data-status', 'open');
					} 

					//calculate offset
					var originalOffset = getWPAdminBarOffset();
					var adjustedOffset = originalOffset;

					var $headerStickies = $('.sticky-header-wrapper .canon_sticky');
					$headerStickies.each(function(index) {
						var $thisSticky = $(this);
						adjustedOffset = adjustedOffset + $thisSticky.height();	
					});

					var scrollToOffset = $searchHeaderContainer.offset().top - adjustedOffset;

					//scroll
					$('html,body').animate({
						scrollTop: scrollToOffset
					},'slow',function () {
						$searchHeaderContainer.find('#s').focus();
					});
				});

				// SEARCH CONTROL SEARCH
				$('body').on('click','.search_control_search', function (event) {
					$('.search-header-container #searchform').submit();
				});

				// SEARCH CONTROL CLOSE
				$('body').on('click','.search_control_close', function (event) {
					var $searchHeaderContainer = $('.search-header-container');
					$searchHeaderContainer.slideUp();
					$searchHeaderContainer.attr('data-status', 'closed');
					// $('html,body').animate({scrollTop: 0},'slow');
				});


			}



	});


/*************************************************************
SEARCH AUTOCOMPLETE
*************************************************************/

	jQuery(document).ready(function($){

		if (typeof extDataAutocomplete != "undefined") {

			var autocompleteArray = extDataAutocomplete.autocompleteArray;
			$( ".search-header-container #s" ).autocomplete({ source: autocompleteArray });
			
		}

	});

/*************************************************************
@FONT-FACE FIX
*************************************************************/

	jQuery(window).load(function($){

		if (extData.canonOptions['fontface_fix'] == 'checked') {

			$ = jQuery;
	 		$('body').hide().show();
				
		}
 		
	});

/*************************************************************
LAZY LOAD ANIMATION
*************************************************************/

	jQuery(document).ready(function($){


		// apply data-scroll-reveal attribute
		if (extData.canonOptionsAppearance['lazy_load_on_pagebuilder_elements'] == 'checked') { $('.wpb_content_element').attr('data-scroll-reveal', ''); }
		if (extData.canonOptionsAppearance['lazy_load_on_widgets'] == 'checked') { $('.widget').attr('data-scroll-reveal', ''); }
		if (extData.canonOptionsAppearance['lazy_load_on_archive_posts'] == 'checked') { $('.canon-archive-classic .single-item').attr('data-scroll-reveal', ''); }


		var config = {
            after: extData.canonOptionsAppearance['lazy_load_after'] + 's',
            enter: extData.canonOptionsAppearance['lazy_load_enter'],
            move: extData.canonOptionsAppearance['lazy_load_move'] +'px',
            over: extData.canonOptionsAppearance['lazy_load_over'] +'s',
            easing: 'ease-in-out',
            viewportFactor: parseInt(extData.canonOptionsAppearance['lazy_load_viewport_factor']),
            reset: false,
            init: true
		};

    	window.scrollReveal = new scrollReveal( config );

	});



/*************************************************************
RATINGS BAR
*************************************************************/


	jQuery(document).ready(function($){

		if ($('.ratings-bar').size() === 0) { return; }

		var $ratingBars = $('.ratings-bar');

		$ratingBars.each(function(index) {
			var $this = $(this);
			var percentage = parseFloat($this.attr('data-ratio')) * 100;
			$this.css('width', percentage + "%");
			// $this.animate({
			// 	width: percentage + "%",
			// }, 2000);
		});

	});



/*************************************************************
USER RATING
*************************************************************/


	jQuery(document).ready(function($){

		// bouncer
		if ($('.star-rating').size() === 0) { return; }

		// set colours
		var ratedColor = extData.canonOptionsAppearance['color_feat_text_1'];
		var hoverColor = 'orange';

		// initial state
		var $starRatingContainers = $('.star-rating');
		$starRatingContainers.each(function(index) {
			var $this = $(this);
			if ($this.attr('class').indexOf('unrated') == -1) {
				var starRating = $this.attr('data-my_rating');
				var $incStars = $this.find('li i').slice(0, starRating);
				$incStars.removeClass('fa-star-o').addClass('fa-star').css('color', ratedColor);
			}
				
		});

		// bounce from here if already rated
		if ($('.star-rating.unrated').size() === 0) { return; }

		var $stars = $('.star-rating.unrated li i');


		// hover effect
		$stars.hover(function (event) {
			var $this = $(this);
			var starRating = $stars.index($this)+1;
			var $incStars = $stars.slice(0, starRating);
			$incStars.removeClass('fa-star-o').addClass('fa-star').css('color', hoverColor);

		}, function (event) {
			$stars.removeClass('fa-star').addClass('fa-star-o').css('color', '#ddd');
		});


		$stars.on('click', function (event) {
			var $this = $(this);
			var $thisStarRatingContainer = $this.closest('.star-rating');
			var starRating = $stars.index($this)+1;
			var $incStars = $stars.slice(0, starRating);
			var postID = $thisStarRatingContainer.attr('data-post_id');
			var nonce = $thisStarRatingContainer.attr('data-nonce');

			$.ajax({
				type: 'post',
				url: extData.ajaxUrl,
				data: {
					action: 'user_rating',
					star_rating: starRating,
					post_id: postID,
					nonce: nonce
				},
				success: function(response) {
					if (response != "") {

						// change class to rated
						$thisStarRatingContainer.removeClass('unrated').addClass('rated');

						// unbind hover event
						$stars.unbind();

						// color stars to user rating
						$incStars.removeClass('fa-star-o').addClass('fa-star').css('color', '#ff6666');

						// recalculate new rating results
						var resultsArray = response.split(',');
						var sum = 0;
						$.each(resultsArray, function (index, value) {
							sum = sum + parseInt(value);	
						});
						var average = Math.round(sum/resultsArray.length * 10) / 10;
						var resultString = average + " (" + resultsArray.length + " votes)";
						$('.star-rating-result').text(resultString);

					}
				}
			}); //end ajax
		});

	});



/*************************************************************
INFO BOX LIST CHECK
*************************************************************/
  
	jQuery(document).ready(function($){

		// bouncer
		if ($('.tc-info-box-ul li').size() === 0) { return; }

		$( ".tc-info-box-ul li" ).click(function() {
			$( this ).toggleClass( "checked" );
		});

	});


/*************************************************************
CANON PARALLAX SCROLLING

HOWTO: Add class "canon-parallax" to a container with a background image to make the background image do a parallax animation.
You can set data-canon-parallax-amount (0 is off, 100 is max/fixed) on the container. This is optional, if not set it will default to 50% parallax.
You can set data-canon-parallax-yoffset (can also contain negative numbers). This is optional, if not set it will default to 0px offset.
Default styling like background-repeat etc. must be set for .canon-parallax in style.css or similar.
*************************************************************/

	jQuery(document).ready(function($) {

		$(".canon-parallax").each(function (index) {

			var $this = $(this);
			var parallaxAmount = (typeof $this.attr('data-canon-parallax-amount') != "undefined") ? parseInt($this.attr('data-canon-parallax-amount')) : 50 ;
			var parallaxYOffset = (typeof $this.attr('data-canon-parallax-yoffset') != "undefined") ? parseInt($this.attr('data-canon-parallax-yoffset')) : 0 ;

			var factor = 11 - (parallaxAmount / 10); // 0 is none, 100 is max

			// special case: factor 11 (no parallax)
			if (factor == 11) { return; }

			// special case: factor 1 (max parallax)
			// if (factor === 1) {
			// 	$this.css('background-attachment','fixed');
			// 	return;	
			// }


	        $(window).scroll(function() {
				var yPos = ($(window).scrollTop() / factor ) + parallaxYOffset; 

	            var coords = '50% '+ yPos + 'px';
	            $this.css({ backgroundPosition: coords });
	        }); 

		}); 

	});


/*************************************************************
COMMENTS FORM FIX
*************************************************************/
  
	jQuery(document).ready(function($){

		//bouncer
		if ($('#commentform').size() === 0) { return; }

		var $commentFormSubmit = $('#commentform p.form-submit');
		var $commentNotesAfter = $('#commentform .comment-notes-after');
		$commentNotesAfter.insertBefore($commentFormSubmit);

	});

