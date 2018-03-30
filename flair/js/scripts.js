jQuery(document).ready(function ($) {
	
	/**
	 * Disable AJAX
	 */
	if( 1 == wp_data.disable_ajax ){
		jQuery('.cbp-singlePage').click(function(){
			window.location = jQuery(this).attr('href');
			return false;
		});
	}
	
	/**
	 * Mobile Detection
	 */
	if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
		jQuery('body').addClass('mobile');
	}
	
	/**
	 * WordPress Stuff
	 */
	jQuery('p:empty').remove();
	
	var firstId = jQuery('section.page-section').eq(0).attr('id'),
		headerOffset = 78,
		$header = jQuery('#header');
	
	if( firstId ){
		jQuery('#down-link').attr({
			'href' : '#' + firstId
		});
	}
	
	/**
	 * Background Colour Fade
	 * Uses CSS Classes to generate the background colours.
	 */
	if( jQuery('body').hasClass('fade-header') )
		startfade();
	
	/*
	 * Tooltips
	 */
	jQuery("[rel=tooltip]").tooltip();
	jQuery("[data-rel=tooltip]").tooltip();
	jQuery('#bottom').tooltip();

	/*
	 * Center Content
	 */
    jQuery(window).on('resize', function resize()  {
        jQuery(window).off('resize', resize);
        setTimeout(function () {
            var content = jQuery('#content');
            var top = (window.innerHeight - content.height()) / 2;
            content.css('top', Math.max(0, top) + 'px');
            jQuery(window).on('resize', resize);
        }, 50);
    }).resize();

	/**
	 * Clients Carousel
	 */
	jQuery(".clients-carousel").owlCarousel({
		autoPlay: 3000, //Set AutoPlay to 3 seconds
		items : 4,
		itemsDesktop : [1199,3],
		itemsDesktopSmall : [979,3]
	});
	
	jQuery(".testimonials").owlCarousel({
		singleItem:true
	});
	
	jQuery("#big").owlCarousel({
		navigation : false, 
		slideSpeed : 300,
		paginationSpeed : 400,
		lazyLoad : true,
		singleItem:true,
	});
	
	
	/**
	 * Background Video
	 */
	jQuery(".wallpapered").wallpaper();
	
	if( jQuery('.fullplate').length > 0 ){
		jQuery('.fullplate').flicker();
	}
	
	/**
	 * Header Reveal
	 */
    jQuery(window).scroll(function () {
	var scaleBg = -jQuery(window).scrollTop() / 4;
		if (jQuery(window).scrollTop() > 1) {
            $header.addClass('show-header');
        } else {
            $header.removeClass('show-header');
        }
	});
	
	/**
	 * Header Scroll
	 */
	if( jQuery('body').hasClass('admin-bar') )
		headerOffset = headerOffset + 32;
		
    jQuery('#menu a[href^="#"], #down-link, .ebor-scroll').smoothScroll({
        offset:-headerOffset,
        speed: 800
    });
    
    /**
     * Window Scroll Functions
     */
    $(window).scroll(function(){	
    	$('#menu a[href^="#"]').each(function(){
    		var scrollHref = $(this).attr('href');
    		if( $(scrollHref).length > 0 ){
	    		if( $(window).scrollTop() > $(scrollHref).offset().top - 130 ) {
	    			$('#menu a[href^="#"]').removeClass('active');
	    			$(this).addClass('active');
	    		}
    		}
    	});
    });
    
    $(window).trigger('scroll');
     
	/**
	 * Mobile Menu
	 */
	jQuery('#nav-toggle').click(function () {
		if ($header.hasClass('responsive-menu')){
		    $header.removeClass('responsive-menu');
		} else {
		    $header.addClass('responsive-menu');
		}
	});
	jQuery('#menu li a').click(function () {
        if ($header.hasClass('responsive-menu')) {
            $header.removeClass('responsive-menu');
        }
    });
    
    /**
     * Slideshow
     */
    jQuery('.top-slider').flexslider({
    	animation: "fade",
    	directionNav:false,
    	controlNav: false, 
    	slideshowSpeed: 5000,
    	animationSpeed: 600,
    	initDelay: 0,         
    	useCSS: true
    });
    
    jQuery(".rotate").show();
    
});

jQuery(window).load(function(){
	
	jQuery(".rotate").textrotator({
		animation: "dissolve",
		separator: "*",
		speed: 3200
	});
	
	wow = new WOW({ animateClass: 'animated', mobile:false });
	wow.init();
	
});