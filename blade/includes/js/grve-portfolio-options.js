jQuery(document).ready(function($) {

	"use strict";

	$('#grve-portfolio-media-selection').change(function() {

		$('.grve-portfolio-media-item').hide();

		switch($(this).val())
		{
			case "gallery":
				$('#grve-portfolio-media-slider').stop( true, true ).fadeIn(500);
				$('#grve-slider-container').stop( true, true ).fadeIn(500);
			break;
			case "gallery-vertical":
				$('.grve-portfolio-media-image-mode').stop( true, true ).fadeIn(500);
				$('#grve-portfolio-media-slider').stop( true, true ).fadeIn(500);
				$('#grve-slider-container').stop( true, true ).fadeIn(500);
			break;
			case "slider":
				$('.grve-portfolio-media-image-mode').stop( true, true ).fadeIn(500);
				$('#grve-portfolio-media-slider').stop( true, true ).fadeIn(500);
				$('#grve-portfolio-media-slider-speed').stop( true, true ).fadeIn(500);
				$('#grve-portfolio-media-slider-direction-nav').stop( true, true ).fadeIn(500);
				$('#grve-portfolio-media-slider-direction-nav-color').stop( true, true ).fadeIn(500);
				$('#grve-slider-container').stop( true, true ).fadeIn(500);
			break;
			case "video":
				$('.grve-portfolio-video-embed').stop( true, true ).fadeIn(500);
			break;
			case "video-html5":
				$('.grve-portfolio-video-html5').stop( true, true ).fadeIn(500);
			break;
			default:
			break;
		}
	});

	$('#grve-portfolio-link-mode').change(function() {
		switch($(this).val())
		{
			case "link":
				$('.grve-portfolio-custom-link-mode').stop( true, true ).fadeIn(500);
			break;
			default:
				$('.grve-portfolio-custom-link-mode').hide();
			break;
		}
	});

	$(window).load(function(){
		$('#grve-portfolio-media-selection').change();
		$('#grve-portfolio-link-mode').change();
	});

});