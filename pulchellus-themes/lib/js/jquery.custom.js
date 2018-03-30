jQuery(document).ready(function ($) {
	
	// Navigation and responsive menu
	$('#menu').superfish({
		disableHI: true	
	});
	$('#menu').mobileMenu({
		defaultText: 'Navigate to...',
		className: 'mobileMenu',
		subMenuDash: '&ndash;'
		
	});
	
	

		jQuery('#menu').supersubs({
			minWidth:    12,   // minimum width of submenus in em units
			maxWidth:    27,   // maximum width of submenus in em units
			extraWidth:  1     // extra width can ensure lines don't sometimes turn over
                               // due to slight rounding differences and font-family
		}).superfish();  // call supersubs first, then superfish, so that subs are
                         // not display:none when measuring. Call before initialising
                         // containing tabs for same reason.

	
	
	// Tabs
	$('.tab-container').easytabs({animationSpeed:"fast"});
	
	// Toggles
	$(".togglebox").hide();
	$("h4").click(function(){
	$(this).toggleClass("active").next(".togglebox").slideToggle("normal");
		return true;
	});
	
	// Hover images
	$(".hover-image").hover(function() {
		$(this).find("img").stop().animate({'opacity' : 0.2});
	}, function(){
		$(this).find("img").stop().animate({'opacity' : 1});
	});
	

	
	// FitVideos
	$(".embeded-container").fitVids();



	

	
	// Tooltips
	$('.tooltip').tooltipster({
		animation: 'fade',		// fade, grow, swing, slide, fall
		delay: 0,				// Delay how long it takes (in milliseconds) for the tooltip to start animating in.
		position: 'top',		// right, left, top, top-right, top-left, bottom, bottom-right, bottom-left
		speed: 350,				// Set the speed of the animation.
		timer: 0,				// How long the tooltip should be allowed to live before closing.
		trigger: 'hover'		// hover, click
	});
	
	// Fancybox
	$(".fancybox").fancybox();
	
	$('.homepage .sixteen:last').remove();
	

});