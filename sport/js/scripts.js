"use strict";

/*************************************************************
SCRIPTS INDEX

ISOTOPE: INIT
ISOTOPE: GALLERY FILTER MENU
ISOTOPE: MASONRY GALLERY FILTER MENU
FLEXSLIDER INIT
FANCYBOX INIT
OWL CAROUSEL INIT
MINOR PLUGINS INIT
	  	// SCROLLUP
		// FITVIDS
		// MOSAIC
 	  	// STELLAR PARALLAX
		// EMBED SCROLL PROTECT
SIDR RESPONSIVE MENU
MAIN.JS
ADD NAV-PARENT CLASS TO NAV MENU ITEMS WITH SUBMENUS
SLIDER NAVIGATION ON HOVER ONLY
TOGGLE
ACCORDION
HIGHLIGHT LAST MENU ITEM
EVEN HEIGHT
TIMELINE
AJAX MULTIPOST PAGINATION
COUNTDOWN
PAGEBUILDER TOP HORIZONTAL RULER
CLICKABLE BACKGROUND
STICKY HEADER
	SCROLL TO ANCHOR
	SEARCH BUTTON
STATUS OF SCROLL TO MENU ITEMS
SEARCH AUTOCOMPLETE
@FONT-FACE FIX
LAZY LOAD ANIMATION
MENU ANIMATION
COMMENTS FORM FIX

*************************************************************/



  

/*************************************************************
ISOTOPE: INIT
*************************************************************/


	jQuery(window).load(function($) {

		$=jQuery;

		if ($('.page_isotope_gallery').size() > 0) {
			$('.page_isotope_gallery').isotope({
				itemSelector: '.gallery_item',
				layoutMode: 'fitRows'
			});
		}

		//$('.page_isotope_gallery').isotope('reLayout');

		if ($('.page_masonry_gallery').size() > 0) {

			$('.page_masonry_gallery').isotope({
				itemSelector: '.gallery_item',
				layoutMode: 'masonry'
			});
		}


	});

	
	// RELAYOUT ON RESIZE
	jQuery(window).resize(function() {

		$ = jQuery;

		// bounce
		if ($('.page_masonry_gallery').size() == 0) { return; }

		$('.page_masonry_gallery').isotope('reLayout');
		
	});

/*************************************************************
ISOTOPE: GALLERY FILTER MENU
*************************************************************/

	jQuery(document).ready(function($) {
		if ($('.filters li').size() > 0) {
			
			//apply selected class to first menu item (show all)
			$('.filters li:eq(1) a').addClass('selected');

			$('.filters li a').on('click', function (event) {
				event.preventDefault();
				var $this = $(this);
				var $this_gallery = $this.closest('aside').next();
				var numColumns = $this_gallery.attr('data-num_columns');

				//update selected filter item
				$('.filters li a').removeClass('selected');
				$this.addClass('selected');


				var filterVar = $this.closest('li').attr('class');
				if ( (typeof filterVar == 'undefined') || (filterVar.indexOf('cat-item-all') != -1) )  {
					filterVar = "*";
				} else {
					filterVar = filterVar.split(' ');
					filterVar = "." + filterVar[1];
				}
				$this_gallery.isotope({ filter: filterVar});

				//recalculate last item
				var $filteredItems = $('.gallery_item:not(.isotope-hidden)');
				if ($filteredItems.size() > 0) {

					$filteredItems.each(function(index, e) {
						$this = $(this);
						$this.removeClass('last');
						if (((index+1) % numColumns) === 0) $this.addClass('last');
					});

				$('.page_isotope_gallery').isotope('reLayout');
						
				}
			});

		}
	});


/*************************************************************
ISOTOPE: MASONRY GALLERY FILTER MENU
*************************************************************/

	jQuery(document).ready(function($) {
		if ($('.gallery-filter li').size() > 0) {
			
			//apply selected class to first menu item (show all)
			$('.gallery-filter li:eq(0) a').addClass('selected');

			$('.gallery-filter li a').on('click', function (event) {
				event.preventDefault();
				var $this = $(this);
				var thisGallerySelector = $this.closest('.gallery-filter').attr('data-associated_gallery_selector');
				var $this_gallery = $(thisGallerySelector);
				var numColumns = $this_gallery.attr('data-num_columns');

				//update selected filter item
				$('.gallery-filter li a').removeClass('selected');
				$this.addClass('selected');


				var filterVar = $this.closest('li').attr('class');
				if ( (typeof filterVar == 'undefined') || (filterVar.indexOf('cat-item-all') != -1) )  {
					filterVar = "*";
				} else {
					filterVar = filterVar.split(' ');
					filterVar = "." + filterVar[1];
				}
				$this_gallery.isotope({ filter: filterVar});

			});

		}
	});


/*************************************************************
FLEXSLIDER INIT
*************************************************************/

	jQuery(window).load(function($){
		$ = jQuery;

		if ($('.flexslider-standard').size() > 0) {

			var canonAnimImgSliderSlidershow = (extData.canonOptionsAppearance['anim_img_slider_slideshow'] == 'checked') ? true : false;

			$('.flexslider-standard').flexslider({
				slideshow: canonAnimImgSliderSlidershow,
				slideshowSpeed: parseInt(extData.canonOptionsAppearance['anim_img_slider_delay']),
				animationSpeed: parseInt(extData.canonOptionsAppearance['anim_img_slider_anim_duration']),
				animation: "fade",
				smoothHeight: true,
				touch: true,
				controlNav: true,
				prevText: "S",
				nextText: "s",
				start: function(slider){
					$('body').removeClass('loading');
				}
			});

		}

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

		if ( ($('.flexslider-menu').size() > 0) ) {

			var canonAnimMenuSliderSlidershow = (extData.canonOptionsAppearance['anim_menu_slider_slideshow'] == 'checked') ? true : false;

			$('.flexslider-menu').flexslider({
				slideshow: canonAnimMenuSliderSlidershow,
				slideshowSpeed: parseInt(extData.canonOptionsAppearance['anim_menu_slider_delay']),
				animationSpeed: parseInt(extData.canonOptionsAppearance['anim_menu_slider_anim_duration']),
				animation: "fade",
				smoothHeight: true,
				touch: true,
				directionNav: true,
				controlNav: false,
				prevText: "S",
				nextText: "s",
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


		if ($(".post-carousel").size() > 0) {
			
			// for each post-carousel read settings and init
			$('.post-carousel').each(function(index){
				var $this = $(this);
				var displayNumPosts = $this.attr('data-display_num_posts');
				var slideSpeed = $this.attr('data-slide_speed');
				var autoPlay = ($this.attr('data-autoplay_speed') === "0") ? false : parseInt($this.attr('data-autoplay_speed'));
				var stopOnHover = ($this.attr('data-stop_on_hover') == 'checked') ? true : false;
				var pagination = ($this.attr('data-pagination') == 'checked') ? true : false;

				var blockID = $this.closest('.pb_block').attr('id');

				$('#'+ blockID).find('.post-carousel').owlCarousel({
					items: parseInt(displayNumPosts),
					slideSpeed: parseInt(slideSpeed),
					autoPlay: autoPlay,
					stopOnHover: stopOnHover,
					pagination: pagination,
				});

			});

			// navigation: next
			$('.owlCustomNavigation .next2').on('click', function(event) {
				var $this = $(this);
				var $related_carousel = $this.closest('.text-seperator').next('.owl-carousel');
				$related_carousel.trigger('owl.next')
			});

			// navigation: prev
			$('.owlCustomNavigation .prev2').on('click', function(event) {
				var $this = $(this);
				var $related_carousel = $this.closest('.text-seperator').next('.owl-carousel');
				$related_carousel.trigger('owl.prev')
			});

		}

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
		$(".outter-wrapper").fitVids();


		// MOSAIC
		$('.fade').mosaic();
	 

 	  	// STELLAR PARALLAX
	  	if (typeof $.stellar != 'undefined') { 
		  	$(window).stellar({
		  		horizontalScrolling: false,
		  	});
	  	}


		// EMBED SCROLL PROTECT
		$('.embed-scroll-protect').embedScrollProtect();


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
ADD NAV-PARENT CLASS TO NAV MENU ITEMS WITH SUBMENUS
*************************************************************/

	jQuery(document).ready(function($) {
		var $subMenus = $('.sub-menu');
		$subMenus.each(function(index) {
			var $this = $(this);
			$this.closest('li').addClass('nav-parent');
		});

	});



/*************************************************************
MAIN.JS
*************************************************************/


	jQuery(document).ready(function($) {

		// Parent-Nav Hover	
		$("li.nav-parent").hover(function(){
			$(this).addClass("hover");

		}, function(){
		    $(this).removeClass("hover");
		});
  
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
TOGGLE
*************************************************************/

	jQuery(document).ready(function($){

		if ($('.toggle-btn').size() > 0) {

			// toggle	  
			$('.toggle-btn').click(function(e){
				e.preventDefault();
				$(this).closest('li').find('.toggle-content').not(':animated').slideToggle();
				$(this).toggleClass("active");
			});
			
		}


	});


  


/*************************************************************
ACCORDION
*************************************************************/

	jQuery(document).ready(function($){

		if ($('.accordion-btn').size() > 0) {
			
			// initial states
			$('.accordion-content:not(.active)').hide();

			// accordion	  
			$('.accordion-btn').click(function(e){
				e.preventDefault();
				var $this = $(this);
				var $thisAccordionContent = $this.closest('li').find('.accordion-content');
				var currentStatus = "";
				if ($this.attr('class').indexOf('active') != -1) {
					currentStatus = "active";
				}
				//first close all and remove active class
				$this.closest('.accordion').find('li').each(function(index) {
					var $thisLi = $(this);
					$thisLi.find('.accordion-btn').removeClass('active');
					$thisLi.find('.accordion-content').slideUp('400', function() {
						$(this).removeClass('active');
					});
				});
				if (currentStatus != "active") {
					$thisAccordionContent.not(':animated').slideDown();
					$this.addClass('active');
					$thisAccordionContent.addClass('active');
				}
			});

		}
		
	});



/*************************************************************
EVEN HEIGHT

by: Michael Bregnbak
Use: apply even-height class to any container and add data-even_height_group with group name. Now all containers with even-height class and same group name will be even height. Recalculates on window resize for responsiveness.
*************************************************************/

	jQuery(document).ready(function($){

		// EVEN HEIGHT SCRIPT
		if ($('.even-height').size() > 0) {
			
			// first get even height groups
			var $evenHeightDivs = $('.even-height');
			var evenHeightGroupsArray = [];
			$evenHeightDivs.each(function(index, element) {
				var $this = $(this);
				evenHeightGroupsArray.push($this.data('even_height_group'));
			});
			var evenHeightGroupsArrayUnique = [];
			$.each(evenHeightGroupsArray, function(index, element) {
			    if ($.inArray(element, evenHeightGroupsArrayUnique) === -1) evenHeightGroupsArrayUnique.push(element);
			});

			// make each group same height
			make_same_height(evenHeightGroupsArrayUnique);

			//recalculate on window resize
			$(window).resize(function () {
				$evenHeightDivs.css('height','auto');
				make_same_height(evenHeightGroupsArrayUnique);
			});

		}

		function make_same_height(evenHeightGroupsArrayUnique) {
				
			$.each(evenHeightGroupsArrayUnique, function(index, element) {
				var $thisEvenHeightGroup = $('.even-height[data-even_height_group="'+element+'"]');
				var heightsArray = [];
				$thisEvenHeightGroup.each(function(index, element) {
					var $this = $(this);
					heightsArray.push($this.height());
				});
				var tallest = 0;
				$.each(heightsArray, function(index, element) {
				    if (element > tallest) tallest = element;
				});
				$thisEvenHeightGroup.height(tallest);
					
			});
		}
		
	});


/*************************************************************
TIMELINE
*************************************************************/

	jQuery(document).ready(function($){


		/*************************************************************
		TIMELINE ASSIGN RIGHT LEFT
		*************************************************************/
				if ($('.timeline').size() > 0) {
				
					// init
					setTimeout(function(){
						
						var newContainerHeight = timelineSetSides();
						animateContainerHeight(newContainerHeight);
						fadeInNewLIs();

					}, parseInt(extDataTimeline.loadDelay));


					// on resize
					$( window ).resize(function() {
						timelineSetSides();
					});


				}	


				function timelineSetSides () {
					var $LIs = $('.timeline').find('li.milestone');
					var leftOffset = 0;
					var rightOffset = 0;
					var bottomMargin = 30;
					var timelineContainerTotalPadding = 40;
					var sideArray = [];
					var newContainerHeight = 0;

					//remove classes first
					$LIs.removeClass('tl_left tl_right');

					//make sidearray
					$LIs.each(function(index, el) {

						// console.log("leftOffset: "+leftOffset+ "// rightOffset: "+rightOffset );
						var $this = $(this);
						var thisHeight = $this.height();

						//var title = $this.find('h3').text();
						// console.log(title + " :"+thisHeight);

						if (rightOffset < leftOffset) {
							// assign right
							sideArray.push('tl_right')	
							rightOffset = (rightOffset + thisHeight + bottomMargin);
						} else {
							// assign left
							sideArray.push('tl_left')	
							leftOffset = (leftOffset + thisHeight + bottomMargin);
						}

					});

					//set height of timeline container
					if (rightOffset > leftOffset) {
						newContainerHeight = rightOffset+timelineContainerTotalPadding;
					} else {
						newContainerHeight = leftOffset+timelineContainerTotalPadding;
					}


					//assign classes
					$LIs.each(function(index, el) {
						var $this = $(this);
						$this.addClass(sideArray[index]);
					});

					return newContainerHeight;

				}

				function animateContainerHeight (newContainerHeight) {
					var newHeightAnimationSpeed = 1000;

					$('.timeline').animate({
						height: newContainerHeight,
					}, newHeightAnimationSpeed);

				}

				function fadeInNewLIs() {
					var offset = $('.timeline').attr('data-offset');
					var $newLIs = $('.timeline').find('li.milestone').slice(offset);
					var numLIs = $newLIs.length;
					var delayTime = 250;
					var fadeInTime	= 1000;
					var newHeightAnimationSpeed = 1000;

					$newLIs.each(function(index, el) {
						var $this = $(this);
						//now show
						$this.delay(delayTime*index).fadeIn(fadeInTime);
						// $this.show();
					});

					//final animation and release height to auto
					setTimeout(function(){

						var $timeline = $('.timeline');

						var currentHeight = $timeline.height();
						$('.timeline').css('height','auto');
						var autoHeight = $timeline.height();
						$timeline.height(currentHeight);

						$timeline.animate({
							height: autoHeight,
						}, newHeightAnimationSpeed, function () {
							$timeline.css('height', 'auto');
						});


					}, (numLIs*delayTime));
						
				}
		



		/*************************************************************
		TIMELINE LOAD MORE POSTS WITH AJAX

		ROADMAP:
		We get posts and try to get plus one post this determines if load more button is displayed.

		*************************************************************/


				$('.timeline_load_more').on('click', function () {
					var $timeline = $('.timeline');
					var offset = parseInt($timeline.attr('data-offset'));
					var newOffset = offset + parseInt(extDataTimeline.postsPerPage);
					var morePosts = false;

					$.ajax({
						type: 'post',
						dataType: 'html',
						url: extDataTimeline.ajaxUrl,
						data: {
							action: 'timeline_load_more',
							offset: offset,
							posts_per_page: parseInt(extDataTimeline.postsPerPage),
							category: extDataTimeline.category,
							order: extDataTimeline.order,
							exclude_string: extDataTimeline.excludeString,
							link_through:  extDataTimeline.linkThrough,
							display_content:  extDataTimeline.displayContent,
							default_excerpt_length:  parseInt(extDataTimeline.defaultExcerptLength),
							nonce: extDataTimeline.nonce,
						},
						beforeSend: function(response) {
						    $('.timeline_load_img').show();
						    $('.timeline_load_more').hide();
						},
						success: function(response) {
							$timeline.append(response);

							//determine if more posts
							var $newLIs = $timeline.find('li.milestone').slice(newOffset);
							var numNewLIs = $newLIs.size();
							if (numNewLIs > parseInt(extDataTimeline.postsPerPage)) {
								$newLIs.last().remove();	
		    					morePosts = true;
							} else {
								$('.timeline_load_more').hide();
								morePosts = false;
							}

							//set new offset
							$timeline.attr('data-offset', newOffset);

							//reinit libraries
							$(".outter-wrapper").fitVids();
							$('.fade').mosaic();
							$("a[href$='.jpg'],a[href$='.png'],a[href$='.gif']").attr('rel','gallery').addClass('fancybox');

							// order timeline after load delay
							setTimeout(function(){
								var newContainerHeight = timelineSetSides();
								animateContainerHeight(newContainerHeight);
								fadeInNewLIs();

								//toggle load more button again
								if (morePosts == true) {
								    $('.timeline_load_img').hide();
								    $('.timeline_load_more').fadeIn();
								} else {
								    $('.timeline_load_img').hide();
								}

							}, parseInt(extDataTimeline.loadDelay));
						},


					}); //end ajax

				});

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
					// console.log(newHeight);
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

		if ($('.countdown').size() > 0) {

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

		}



	});

/*************************************************************
PAGEBUILDER TOP HORIZONTAL RULER
*************************************************************/

	jQuery(document).ready(function($){

		if ($('.pb_hr').size() > 0) {

			var firstBlockClass = $('.pb_block').first().attr('class');

			//update this with blocks slugs
			var noHrBlocks = new Array(
				'pb_featured_img',
				'pb_featured_video',
				'pb_supporters',
				'pb_revslider',
				'pb_divider',
				'pb_no_top_hr'		// universal class
			);

			for (var i = 0; i < noHrBlocks.length; i++) {
				if (firstBlockClass.indexOf(noHrBlocks[i]) != -1) {
					$('.pb_hr').remove();
					
				}
			}

		}

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
				// console.log(thisZIndex);

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
STATUS OF SCROLL TO MENU ITEMS
*************************************************************/


	jQuery(document).ready(function($){

		var statusOfScrollToMenuItems = (typeof extData.canonOptionsFrame.status_of_scroll_to_menu_items != 'undefined') ? extData.canonOptionsFrame.status_of_scroll_to_menu_items : 'normal';

		if (statusOfScrollToMenuItems != 'normal') {

			var scrollToSelector = '#';
			var $aTags = $('.nav a');	// default is hide at all levels so get all level anchor tags

			// if hide active status only at top level
			if (statusOfScrollToMenuItems == 'hide_at_top_level') { $aTags = $('.nav > li > a'); }

			// the actual hiding
			$aTags.each(function (index) {
				var $this = $(this);
				var href= $this.attr('href');
				if (typeof href != "undefined") {
					if (href.indexOf(scrollToSelector) != -1) {
						var splitArray = href.split(scrollToSelector);
						href = splitArray[1];
						if (href != "") {
							$this.closest('li').removeClass('current-menu-item');
						}
					}
				}
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

		if (typeof scrollReveal != 'undefined') {
				
			// apply data-scroll-reveal attribute
			if (extData.canonOptionsAppearance['lazy_load_on_pagebuilder_blocks'] == 'checked') { $('.pb_block').attr('data-scroll-reveal', ''); }
			if (extData.canonOptionsAppearance['lazy_load_on_widgets'] == 'checked') { $('.widget').attr('data-scroll-reveal', ''); }
			if (extData.canonOptionsAppearance['lazy_load_on_blog'] == 'checked') { 
				$('.canon_blog .post').attr('data-scroll-reveal', ''); 
				$('.canon_archive .post').attr('data-scroll-reveal', ''); 
			}


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

		}


	});

/*************************************************************
MENU ANIMATION
*************************************************************/

	jQuery(document).ready(function($){

		if (extData.canonOptionsAppearance['anim_menus'] != 'anim_menus_off') {

			$(extData.canonOptionsAppearance['anim_menus']).each(function(index) {
				var $this_menu = $(this);
				$($this_menu.children('li').get().reverse()).each(function(index) {
					var $this_li = $(this);
					$this_li.delay(index*parseInt(extData.canonOptionsAppearance['anim_menus_delay'])).animate({
						'opacity': '1',
						'top': '0px',
						'right': '0px',
						'bottom': '0px',
						'left': '0px',
					}, parseInt(extData.canonOptionsAppearance['anim_menus_duration']));
					
				});
			});

		}

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

