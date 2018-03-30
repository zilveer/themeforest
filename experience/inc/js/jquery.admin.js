/*
 * jquery.admin.js
 * 
 * Custom scripts for Experience WordPress Theme by EugeneO.
 * 
 * Copyright 2014 EugeneO
 * http://eugeneo.com
 * http://themeforest.net/user/EugeneO/portfolio
 *
 */

// Show and hide necessary options.
function refreshOptions(optionsArray) {	
	jQuery.each(optionsArray, function (index, value) {		
		if (value !== null && typeof value === "object") {			
			var options = value;			
			for (var key in options) {			
				if (options.hasOwnProperty(key)) {				
					if (key == 'selector') {
						var selector = options[key];
					}					
					if (key == 'visible') {						
						if (options[key] === true) {
							if (jQuery(selector).is(":visible") === false) {
								jQuery(selector).fadeIn();
							}
						} else {							
							jQuery(selector).fadeOut();					
						}						
					}				
				}			
			}			
		}		
	});
};

	
jQuery(document).ready(function ($) {

	"use strict";	

/*----------------------------------------------------------------------------------
 Navigation Options
----------------------------------------------------------------------------------*/

	if (
		$('#post_type').val() === 'page'
		|| $('#post_type').val() === 'post'
		|| $('#post_type').val() === 'portfolio'
	) {
		
		// Transparent navigation trigger
		var navigationTrigger = $('#experience_transparent_nav_bg');		
		
		// Create background options array and set defaults
		var navigationOptions = {
			
			// Site Logo
			siteLogo : {
				selector	: ".cmb2-id-experience-alt-site-logo",
				visible		: false
			},
			
			// Navigation Bar Text
			navTextColor : {
				selector	: ".cmb2-id-experience-transparent-nav-text-color",
				visible		: false
			}
			
		};
		
		// Update option on page load
		if(navigationTrigger.is(':checked')) {		
			navigationOptions.navTextColor.visible		= true;
			navigationOptions.siteLogo.visible			= true;		
		} else {			
			navigationOptions.navTextColor.visible		= false;
			navigationOptions.siteLogo.visible			= false;		
		}		
		
		// Update visible options
		refreshOptions(navigationOptions);		
		
		// Update option on header type option change
		navigationTrigger.change( function() {
		
			if($(this).is(':checked')) {			
				navigationOptions.navTextColor.visible		= true;
				navigationOptions.siteLogo.visible			= true;			
			} else {				
				navigationOptions.navTextColor.visible		= false;
				navigationOptions.siteLogo.visible			= false;			
			}
			
			// Update visible options
			refreshOptions(navigationOptions);
		
		});
	
	}
	
	
/*----------------------------------------------------------------------------------
 Page Header Options
----------------------------------------------------------------------------------*/
	
	
	if ( $('#post_type').val() === 'page' ) {
		
		// ----------------- Header Type --------------------- //
		
		// Header option trigger
		var headerType = $('#experience_header_type');		
		
		// Transparent navigation trigger
		var parallaxTrigger = $('#experience_header_parallax');
		
		// Create background options array and set defaults
		var headerOptions = {
			
			// Label
			headerLabel: {
				selector	: ".cmb2-id-experience-page-label",
				visible		: false
			},
			
			// Title
			headerTitle: {
				selector	: ".cmb2-id-experience-page-title",
				visible		: false
			},
			
			// Intro
			headerIntro: {
				selector	: ".cmb2-id-experience-page-intro",
				visible		: false
			},
			
			// Header Colour Scheme
			headerColorScheme: {
				selector	: ".cmb2-id-experience-header-color-scheme",
				visible		: false
			},
			
			// Header Size
			headerFillScreen : {
				selector	: ".cmb2-id-experience-header-fill-screen",
				visible		: false
			},
			
			// Header Parallax
			headerBackgroundParallax : {
				selector	: ".cmb2-id-experience-header-parallax",
				visible		: false
			},
			
			// Header Parallax Speed
			headerBackgroundParallaxSpeed : {
				selector	: ".cmb2-id-experience-header-parallax-speed",
				visible		: false
			},
			
			// Header Background Image
			headerBackgroundImage : {
				selector	: ".cmb2-id-experience-header-bg-image",
				visible		: false
			},
			
			// Header Background Video
			headerBackgroundVideo : {
				selector	: ".cmb2-id-experience-header-bg-video",
				visible		: false
			},
			
			// Header Scroll Link
			headerScrollLink : {
				selector	: ".cmb2-id-experience-header-scroll-link",
				visible		: false
			},
			
			// Header slider Startat
			headerSliderStartAt : {
				selector	: ".cmb2-id-experience-header-slider-startat",
				visible		: false
			},
			
			// Header slider Slideshow Speed
			headerSliderSlideshowSpeed : {
				selector	: ".cmb2-id-experience-header-slider-slideshowspeed",
				visible		: false
			},
			
			// Header Slider Animation Speed
			headerSliderAnimationSpeed : {
				selector	: ".cmb2-id-experience-header-slider-animationspeed",
				visible		: false
			},
			
			// Header Slides
			headerSlides : {
				selector	: $("#experience_header_slides_repeat").parent().parent(),
				visible		: false
			}
			
			
		};
		
		// Update option on page load
		if(headerType.val() == 'slider') {
			headerOptions.headerLabel.visible					= false;
			headerOptions.headerTitle.visible					= false;
			headerOptions.headerIntro.visible					= false;
			headerOptions.headerColorScheme.visible				= true;
			headerOptions.headerFillScreen.visible				= false;
			headerOptions.headerBackgroundParallax.visible		= true;			
			headerOptions.headerBackgroundImage.visible			= false;
			headerOptions.headerBackgroundVideo.visible			= false;
			headerOptions.headerScrollLink.visible				= false;
			headerOptions.headerSliderStartAt.visible			= true;
			headerOptions.headerSliderSlideshowSpeed.visible	= true;
			headerOptions.headerSliderAnimationSpeed.visible	= true;
			headerOptions.headerSlides.visible					= true;			
		} else if(headerType.val() == 'none') {		
			headerOptions.headerLabel.visible					= false;
			headerOptions.headerTitle.visible					= false;
			headerOptions.headerIntro.visible					= false;
			headerOptions.headerColorScheme.visible				= false;
			headerOptions.headerFillScreen.visible				= false;
			headerOptions.headerBackgroundParallax.visible		= false;
			headerOptions.headerBackgroundImage.visible			= false;
			headerOptions.headerBackgroundVideo.visible			= false;
			headerOptions.headerScrollLink.visible				= false;
			headerOptions.headerSliderStartAt.visible			= false;
			headerOptions.headerSliderSlideshowSpeed.visible	= false;
			headerOptions.headerSliderAnimationSpeed.visible	= false;
			headerOptions.headerSlides.visible					= false;			
		} else {			
			headerOptions.headerLabel.visible					= true;
			headerOptions.headerTitle.visible					= true;
			headerOptions.headerIntro.visible					= true;
			headerOptions.headerColorScheme.visible				= true;
			headerOptions.headerFillScreen.visible				= true;
			headerOptions.headerBackgroundParallax.visible		= true;			
			headerOptions.headerBackgroundImage.visible			= true;
			headerOptions.headerScrollLink.visible				= true;
			headerOptions.headerSliderStartAt.visible			= false;
			headerOptions.headerSliderSlideshowSpeed.visible	= false;
			headerOptions.headerSliderAnimationSpeed.visible	= false;
			headerOptions.headerSlides.visible					= false;
			
			if(parallaxTrigger.is(':checked')) {
				headerOptions.headerBackgroundParallaxSpeed.visible	= true;
				headerOptions.headerBackgroundVideo.visible		= true;
			} else {
				headerOptions.headerBackgroundParallaxSpeed.visible		= false;
				headerOptions.headerBackgroundVideo.visible		= false;			
			}			
		}
		
		
		// Update visible options
		refreshOptions(headerOptions);
		
		
		// Update option on header type option change
		headerType.change( function() {
		
			if($(this).val() == 'slider') {
				headerOptions.headerLabel.visible					= false;
				headerOptions.headerTitle.visible					= false;
				headerOptions.headerIntro.visible					= false;
				headerOptions.headerColorScheme.visible				= true;
				headerOptions.headerFillScreen.visible				= false;
				headerOptions.headerBackgroundParallax.visible		= true;			
				headerOptions.headerBackgroundImage.visible			= false;
				headerOptions.headerBackgroundVideo.visible			= false;
				headerOptions.headerScrollLink.visible				= false;
				headerOptions.headerSliderStartAt.visible			= true;
				headerOptions.headerSliderSlideshowSpeed.visible	= true;
				headerOptions.headerSliderAnimationSpeed.visible	= true;
				headerOptions.headerSlides.visible					= true;			
			} else if($(this).val() == 'none') {
				headerOptions.headerLabel.visible					= false;
				headerOptions.headerTitle.visible					= false;
				headerOptions.headerIntro.visible					= false;
				headerOptions.headerColorScheme.visible				= false;
				headerOptions.headerFillScreen.visible				= false;
				headerOptions.headerBackgroundParallax.visible		= false;
				headerOptions.headerBackgroundImage.visible			= false;
				headerOptions.headerBackgroundVideo.visible			= false;
				headerOptions.headerScrollLink.visible				= false;
				headerOptions.headerSliderStartAt.visible			= false;
				headerOptions.headerSliderSlideshowSpeed.visible	= false;
				headerOptions.headerSliderAnimationSpeed.visible	= false;
				headerOptions.headerSlides.visible					= false;			
			} else {
				headerOptions.headerLabel.visible					= true;
				headerOptions.headerTitle.visible					= true;
				headerOptions.headerIntro.visible					= true;
				headerOptions.headerColorScheme.visible				= true;
				headerOptions.headerFillScreen.visible				= true;
				headerOptions.headerBackgroundParallax.visible		= true;
				headerOptions.headerBackgroundImage.visible			= true;
				headerOptions.headerScrollLink.visible				= true;
				headerOptions.headerSliderStartAt.visible			= false;
				headerOptions.headerSliderSlideshowSpeed.visible	= false;
				headerOptions.headerSliderAnimationSpeed.visible	= false;
				headerOptions.headerSlides.visible					= false;
				
				if(parallaxTrigger.is(':checked')) {
					headerOptions.headerBackgroundParallaxSpeed.visible = true;
					headerOptions.headerBackgroundVideo.visible		= true;
				} else {
					headerOptions.headerBackgroundParallaxSpeed.visible	= false;
					headerOptions.headerBackgroundVideo.visible		= false;			
				}
			}
			
			// Update visible options
			refreshOptions(headerOptions);
		
		});
	
	}
	
	
/*----------------------------------------------------------------------------------
 Post / Portfolio Header Options
----------------------------------------------------------------------------------*/

	if (
		$('#post_type').val() === 'post'
		|| $('#post_type').val() === 'portfolio'
	) {
		
		// ----------------- Header Type --------------------- //
		
		// Header option trigger
		var headerType = $('#experience_header_bg_type');		
		
		// Transparent navigation trigger
		var parallaxTrigger = $('#experience_header_parallax');
		
		// Create background options array and set defaults
		var headerOptions = {
			
			// Header Colour Scheme
			headerColorScheme: {
				selector	: ".cmb2-id-experience-header-color-scheme",
				visible		: false
			},
			
			// Header Parallax
			headerBackgroundParallax : {
				selector	: ".cmb2-id-experience-header-parallax",
				visible		: false
			},
			
			// Header Parallax Speed
			headerBackgroundParallaxSpeed : {
				selector	: ".cmb2-id-experience-header-parallax-speed",
				visible		: false
			},
			
			// Header Background Image
			headerBackgroundImage : {
				selector	: ".cmb2-id-experience-header-bg-image",
				visible		: false
			},
			
			// Header Background Video
			headerBackgroundVideo : {
				selector	: ".cmb2-id-experience-header-bg-video",
				visible		: false
			},			
			
			// Header Scroll Links
			headerScrollLink : {
				selector	: ".cmb2-id-experience-header-scroll-link",
				visible		: false
			}
			
			
		};
		
		
		// Update option on page load
		if(headerType.val() != 'none') {		
			headerOptions.headerColorScheme.visible				= true;
			headerOptions.headerBackgroundParallax.visible		= true;
			headerOptions.headerBackgroundImage.visible			= true;
			headerOptions.headerScrollLink.visible				= true;
			
			if(parallaxTrigger.is(':checked')) {
				headerOptions.headerBackgroundParallaxSpeed.visible	= true;
				headerOptions.headerBackgroundVideo.visible		= true;
			} else {
				headerOptions.headerBackgroundParallaxSpeed.visible	= false;
				headerOptions.headerBackgroundVideo.visible		= false;			
			}
			
		} else {			
			headerOptions.headerColorScheme.visible				= false;
			headerOptions.headerBackgroundParallax.visible		= false;
			headerOptions.headerBackgroundParallaxSpeed.visible	= false;
			headerOptions.headerBackgroundImage.visible			= false;
			headerOptions.headerBackgroundVideo.visible			= false;
			headerOptions.headerScrollLink.visible				= false;			
		}
		
		
		// Update visible options
		refreshOptions(headerOptions);
		
		
		// Update option on header type option change
		headerType.change( function() {
		
			if($(this).val() != 'none') {
				headerOptions.headerColorScheme.visible				= true;
				headerOptions.headerBackgroundParallax.visible		= true;
				headerOptions.headerBackgroundImage.visible			= true;
				headerOptions.headerScrollLink.visible				= true;
				
				if(parallaxTrigger.is(':checked')) {
					headerOptions.headerBackgroundParallaxSpeed.visible	= true;
					headerOptions.headerBackgroundVideo.visible		= true;
				} else {
					headerOptions.headerBackgroundParallaxSpeed.visible	= false;
					headerOptions.headerBackgroundVideo.visible		= false;			
				}

			} else {				
				headerOptions.headerColorScheme.visible				= false;
				headerOptions.headerBackgroundParallax.visible		= false;
				headerOptions.headerBackgroundParallaxSpeed.visible	= false;
				headerOptions.headerBackgroundImage.visible			= false;
				headerOptions.headerBackgroundVideo.visible			= false;
				headerOptions.headerScrollLink.visible				= false;			
			}
			
			// Update visible options
			refreshOptions(headerOptions);
		
		});
	
	}
	

/*----------------------------------------------------------------------------------
	Post / Portfolio Parallax Options
----------------------------------------------------------------------------------*/
	
	if ( $('#post_type').val() === 'post' || $('#post_type').val() === 'portfolio' ) {
		
		
		// Create background options array and set defaults
		var parallaxOptions = {
			
			// Parallax Speed
			headerBackgroundParallaxSpeed : {
				selector	: ".cmb2-id-experience-header-parallax-speed",
				visible		: false
			},
			
			// Background Video
			backgroundVideo : {
				selector	: ".cmb2-id-experience-header-bg-video",
				visible		: false
			}
			
		};
		
		// Update option on page load
		if(parallaxTrigger.is(':checked')) {
			if(headerType.val() != 'none') {
				parallaxOptions.headerBackgroundParallaxSpeed.visible = true;
				parallaxOptions.backgroundVideo.visible				= true;
			} else {			
				parallaxOptions.headerBackgroundParallaxSpeed.visible = false;
				parallaxOptions.backgroundVideo.visible				= false;	
			}		
		} else {			
				parallaxOptions.headerBackgroundParallaxSpeed.visible = false;
			parallaxOptions.backgroundVideo.visible					= false;			
		}
		
		// Update visible options
		refreshOptions(parallaxOptions);
		
		// Update option on header type option change
		parallaxTrigger.change( function() {			
			if($(this).is(':checked')) {				
				if(headerType.val() != 'none') {	
					parallaxOptions.headerBackgroundParallaxSpeed.visible = true;
					parallaxOptions.backgroundVideo.visible			= true;
				} else {			
					parallaxOptions.headerBackgroundParallaxSpeed.visible = false;
					parallaxOptions.backgroundVideo.visible			= false;	
				}			
			} else {				
				parallaxOptions.headerBackgroundParallaxSpeed.visible = false;
				parallaxOptions.backgroundVideo.visible				= false;				
			}
			
			// Update visible options
			refreshOptions(parallaxOptions);
		
		});
		
	}
	
/*----------------------------------------------------------------------------------
	Page Parallax Options
----------------------------------------------------------------------------------*/
	
	if ( $('#post_type').val() === 'page' && $('.cmb2-id-experience-header-bg-video').length ) {
		
		// Create background options array and set defaults
		var parallaxOptions = {
			
			// Parallax Speed
			headerBackgroundParallaxSpeed : {
				selector	: ".cmb2-id-experience-header-parallax-speed",
				visible		: false
			},
			
			// Background Video
			backgroundVideo : {
				selector	: ".cmb2-id-experience-header-bg-video",
				visible		: false
			},
			
			// Slider Background Video
			slideBackgroundVideo : {
				selector	: "[class*='cmb2-id-experience-header-slides-'][class*='-background-video']",
				visible		: false
			}
			
		};
		
		// Update option on page load
		if(parallaxTrigger.is(':checked')) {
			if(headerType.val() == 'slider') { 	
				parallaxOptions.headerBackgroundParallaxSpeed.visible 	= true;
				parallaxOptions.backgroundVideo.visible					= false;	
				parallaxOptions.slideBackgroundVideo.visible			= true;	
			} else if(headerType.val() == 'none' ) {
				parallaxOptions.headerBackgroundParallaxSpeed.visible 	= false;	
				parallaxOptions.backgroundVideo.visible					= false;
				parallaxOptions.slideBackgroundVideo.visible			= false;
			} else {
				parallaxOptions.headerBackgroundParallaxSpeed.visible 	= true;	
				parallaxOptions.backgroundVideo.visible					= true;
				parallaxOptions.slideBackgroundVideo.visible			= false;
			}
		} else {
			parallaxOptions.headerBackgroundParallaxSpeed.visible 	= false;	
			parallaxOptions.backgroundVideo.visible					= false;
			parallaxOptions.slideBackgroundVideo.visible			= false;			
		}
		
		// Update visible options
		refreshOptions(parallaxOptions);
		
		// Update option on header type option change
		parallaxTrigger.change( function() {	
			if($(this).is(':checked')) {				
				if(headerType.val() == 'slider') {
					parallaxOptions.headerBackgroundParallaxSpeed.visible 	= true;
					parallaxOptions.backgroundVideo.visible					= false;	
					parallaxOptions.slideBackgroundVideo.visible			= true;	
				} else if(headerType.val() == 'none' ) {
					parallaxOptions.headerBackgroundParallaxSpeed.visible 	= false;
					parallaxOptions.backgroundVideo.visible					= false;
					parallaxOptions.slideBackgroundVideo.visible			= false;
				} else {
					parallaxOptions.headerBackgroundParallaxSpeed.visible 	= true;
					parallaxOptions.backgroundVideo.visible					= true;			
					parallaxOptions.slideBackgroundVideo.visible			= false;			
				}			
			} else {
				parallaxOptions.headerBackgroundParallaxSpeed.visible 	= false;	
				parallaxOptions.backgroundVideo.visible					= false;			
				parallaxOptions.slideBackgroundVideo.visible			= false;			
			}
			
			// Update visible options
			refreshOptions(parallaxOptions);
		
		});
		
	}	
	
});