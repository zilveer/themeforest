"use strict";

/*************************************************************
SCRIPTS INDEX

ISOTOPE: INIT
ISOTOPE: GALLERY FILTER MENU
FLEXSLIDER INIT
FANCYBOX INIT
MINOR PLUGINS INIT
		// EMBED SCROLL PROTECT
MAIN.JS
ADD NAV-PARENT CLASS TO NAV MENU ITEMS WITH SUBMENUS
SLIDER NAVIGATION ON HOVER ONLY
TOGGLE
ACCORDION
HIGHLIGHT LAST MENU ITEM
EVEN HEIGHT
TIMELINE
AJAX MULTIPOST PAGINATION
STICKY HEADER
COUNTDOWN
PAGEBUILDER TOP HORIZONTAL RULER
CLICKABLE BACKGROUND
COMMENTS FORM FIX

*************************************************************/


/*************************************************************
ISOTOPE: INIT
*************************************************************/


	jQuery(window).load(function($) {

		$=jQuery;

		if ($('#thumb-gallery').size() > 0) {
			$('#thumb-gallery').isotope({
				itemSelector: '.gallery_item',
				layoutMode: 'fitRows'
			});
		}

		//$('#thumb-gallery').isotope('reLayout');

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
				$('#thumb-gallery').isotope({ filter: filterVar});

				//recalculate last item
				var $filteredItems = $('.gallery_item:not(.isotope-hidden)');
				if ($filteredItems.size() > 0) {
					var	numColumns = 3;

					$filteredItems.each(function(index, e) {
						$this = $(this);
						$this.removeClass('last');
						if (((index+1) % numColumns) === 0) $this.addClass('last');
					});

				$('.images_container').isotope('reLayout');
						
				}
			});

		}
	});


/*************************************************************
FLEXSLIDER INIT
*************************************************************/

	jQuery(window).load(function($){
		$ = jQuery;

		$('.flexslider').each(function (index) {
			
			var $this = $(this);

			var isQuoteSlider = ($this.hasClass('flexslider-quote') || $this.hasClass('sc_flexslider-quote')) ? true : false ;

			if (isQuoteSlider) {
					
				var canonAnimQuoteSliderSlidershow = (extData.canonOptionsAppearance['anim_quote_slider_slideshow'] == 'checked') ? true : false;

				$this.flexslider({
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

			} else {
					
				var canonAnimImgSliderSlidershow = (extData.canonOptionsAppearance['anim_img_slider_slideshow'] == 'checked') ? true : false;

				$this.flexslider({
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
		});

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

                openEffect  : 'fade',   //fade, elastic, none
                closeEffect : 'fade',
                openSpeed   : 'normal', //slow, normal, fast or ms
                closeSpeed  : 'fast',

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
MINOR PLUGINS INIT
*************************************************************/


	jQuery(document).ready(function($) {

		// EMBED SCROLL PROTECT
		$('.embed-scroll-protect').mbEmbedScrollProtect();

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

		// Responsive Menu.js
		$('#nav-wrap').prepend('<div id="menu-icon"><span><img src="'+ extData.templateURI +'/img/hamburger@2x.png"/></span>Menu</div>');
		$("#menu-icon").on("click", function(){
			$("#nav").slideToggle('medium', function() {
			    if ($('#nav').is(':visible'))
			        $('#nav').css('display','block');
			    if ($('#nav').is(':hidden'))
			        $('#nav').css('display','');    
			});
			
			$(this).toggleClass("active");
		});
  	
		// Parent-Nav Hover	
		$("li.nav-parent").hover(function(){
			$(this).addClass("hover");

		}, function(){
		    $(this).removeClass("hover");
		});
  
		// FitVid.js
		$(".outter-wrapper").fitVids();
 
		// Mosaic.js		 
		$('.fade').mosaic();
	 
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
  	
	  	// Stellar-Paralax.js
	  	$(window).stellar({
	  		horizontalScrolling: false,
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
HIGHLIGHT LAST MENU ITEM
*************************************************************/

	jQuery(document).ready(function($){

		if (extData.canonOptions['highlight_last_menu_item'] == "checked") {

			if (extData.canonOptions['highlight_as_button'] == "checked") {
				$('#nav-wrap #nav li').last().addClass('donate donate_btn');
			} else {
				$('#nav-wrap #nav li').last().addClass('donate');
			}
			

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
STICKY HEADER
*************************************************************/

	jQuery(document).ready(function($){

		if (extData.canonOptions['use_sticky_header'] == "checked") {

			if ($('.outter-wrapper.header-container').size() === 0) return;

			// init
			setStickyState();

			// on window resize
			$(window).resize(function () {
				setStickyState();
			});

		}

		function setStickyState () {

			var $header = $('.outter-wrapper.header-container');
			var headerHeight = $header.height();
			var $stickyHeaderWrapper = $('.sticky-header-wrapper');
			var originalOffsetTop = $stickyHeaderWrapper.offset().top;

			var windowWidth = $(window).width();
			var turnOffWidth = (typeof extData.canonOptions['sticky_turn_off_width'] != "undefined") ? extData.canonOptions['sticky_turn_off_width'] : 768;

			// console.log("window width: " + windowWidth);
			// console.log("turn off width: " + turnOffWidth);
			// console.log("offsettop: " + originalOffsetTop);
     		
     		if (windowWidth < turnOffWidth) {

				$header.css({
				    "position": "static",
				    "top": "auto",
				    "z-index": "auto",
				});

 				//maintain height
				$stickyHeaderWrapper.css({
					"display": "block",
					"height": "auto",
				});

    		} else {

				$header.css({
				    "position": "fixed",
				    "top": originalOffsetTop,
				    "z-index": "999",
				});
				
				//maintain height
				$stickyHeaderWrapper.css({
					"display": "block",
					"height": headerHeight,
				});

     		}

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


				//handle vars
				if (useCompact == "checked") { var useCompactBool = true; } else { var useCompactBool = false; }
				if (datetimeString == "") { datetimeString = "" }

				// set labels
				$.countdown.regional['da'] = {
					labels: [labelYears, labelMonths, labelWeeks, labelDays, labelHours, labelMinutes, labelSeconds],
					labels1: [labelYear, labelMonth, labelWeek, labelDay, labelHour, labelMinute, labelSecond],
					compactLabels: [labelY, labelM, labelW, labelD],
					windowhichLabels: null,
					digits: ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'],
					timeSeparator: ':', isRTL: false};
				$.countdown.setDefaults($.countdown.regional['da']);

				// set date
				var countdownDatetime = new Date(); 
				// countdownDatetime = new Date(2013, 11, 31, 23, 59, 59, 100);
				countdownDatetime = new Date(datetimeString);

				$this.countdown({
					until: countdownDatetime,
					timezone: parseInt(gmtOffset),
					format: format,
					compact: useCompactBool,					
					description: description,
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
				'pb_no_top_hr'
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
COMMENTS FORM FIX
*************************************************************/
  
	jQuery(document).ready(function($){

		//bouncer
		if ($('#commentform').size() === 0) { return; }

		var $commentFormSubmit = $('#commentform p.form-submit');
		var $commentNotesAfter = $('#commentform .comment-notes-after');
		$commentNotesAfter.insertBefore($commentFormSubmit);

	});

