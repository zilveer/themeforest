jQuery(window).load(function() {
	'use strict';

	jQuery('.flexslider').flexslider({
		smoothHeight: true,
		directionNav: false,
		slideshow: Boolean(ThemeOption.slider_auto),
		after: function(slider){
			var currentSlide = slider.slides.eq(slider.currentSlide);
			currentSlide.siblings().each(function() {
				var src = jQuery(this).find('iframe').attr('src');
				jQuery(this).find('iframe').attr('src',src);
			})
		}
	});

	// EqualHeights Init
	if (jQuery('.listing').length) {
		jQuery('.listing').equalHeights();
	}

	if (jQuery('.latest-media-generate').length) {
		jQuery('.latest-media-generate').equalHeights();
	}
	jQuery('.socials-top').height(jQuery('.logo-container').height());

});

jQuery(document).ready(function($) {


	// Main navigation
	$('ul.sf-menu').superfish({ 
		delay:       1000,
		animation:   { opacity:'show' },
		speed:       'fast',
		dropShadows: false
	});
	
	// Tracklisting
	if ($('.track-listen').length) {
		$('.track-listen').click(function(){
			var target 		= $(this).siblings('.track-audio');
			var siblings	= $(this).parents('.track').siblings().children('.track-audio');
			siblings.slideUp('fast');
			target.slideToggle('fast');
			return false;
		});
	}


	// Responsive videos
	$("body").fitVids();

	// Lightbox
	if ($("a[data-rel^='prettyPhoto']").length) {
		$("a[data-rel^='prettyPhoto']").prettyPhoto({
			show_title: false,
			hook: 'data-rel',
			social_tools: false,
			theme: 'pp_woocommerce',
			horizontal_padding: 20,
			opacity: 0.8,
			deeplinking: false
		});
	}

	if ($("a[data-rel^='pp_video']").length) {
		$("a[data-rel^='pp_video']").prettyPhoto({
			show_title: false,
			default_width: 480,
			default_height: 360,
			hook: 'data-rel',
			social_tools: false,
			theme: 'pp_woocommerce',
			horizontal_padding: 20,
			opacity: 0.8,
			deeplinking: false,
			changepicturecallback: function() {
				$('video:visible').mediaelementplayer();
			}
		});
	}

	
	$(".media-block").hover(
		function () {
			$(this).find('.media-act').fadeIn('fast');
		}, 
		function () {
			$(this).find('.media-act').fadeOut('fast');
		}
	);


	/* -----------------------------------------
	 Responsive Menus Init with jPanelMenu
	 ----------------------------------------- */
	var jPM = $.jPanelMenu({
		menu: '#navigation',
		trigger: '.menu-trigger',
		excludedPanelContent: "style, script, #wpadminbar"
	});

	var jRes = jRespond([
		{
			label: 'mobile',
			enter: 0,
			exit: 959
		}
	]);

	jRes.addFunc({
		breakpoint: 'mobile',
		enter: function() {
			jPM.on();
		},
		exit: function() {
			jPM.off();
		}
	});

	/* -----------------------------------------
	 SoundManager2 Init
	 ----------------------------------------- */
	soundManager.setup({
		url: ThemeOption.swfPath
	});

});