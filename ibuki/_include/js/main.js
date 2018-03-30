jQuery(function($){

'use strict';

var IBUKI = window.IBUKI || {};

// Desktop Menu
IBUKI.listenerMenu = function(){
	if($('header.header-menu.header-left-button').length > 0 || $('header.header-menu.header-right-button').length > 0 ){
		
		$('#content').append('<div id="blocker"></div>');
	
		// Fixed the Menu
	    $('#desktop-nav').on('click', function(e){
	        $(this).toggleClass('open');
	        
	        // Animation Reverse
	        if($(this).hasClass('open')) {
	        	// Left Menu
	        	if($('header.header-menu.header-left-button').length > 0 ) {
	        		$('header.header-menu.header-left-button, .wrap_all').velocity({ left: 300 }, 550, 'easeOutExpo');
		        	$('#my-menu').velocity({ left: 0 }, 550, 'easeOutExpo');
	        	}

	        	// Right Menu
	        	if($('header.header-menu.header-right-button').length > 0 ) {
	        		$('header.header-menu.header-right-button, .wrap_all').velocity({ right: 300 }, 550, 'easeOutExpo');
		        	$('#my-menu').velocity({ right: 0 }, 550, 'easeOutExpo');
	        	}

		    } else {
		    	// Left Menu
	        	if($('header.header-menu.header-left-button').length > 0 ) {
	        		$('header.header-menu.header-left-button, .wrap_all').velocity({ left: 0 }, 450, 'easeOutExpo');
		    		$('#my-menu').velocity({ left: -300 }, 450, 'easeOutExpo');
	        	}

	        	// Right Menu
	        	if($('header.header-menu.header-right-button').length > 0 ) {
	        		$('header.header-menu.header-right-button, .wrap_all').velocity({ right: 0 }, 450, 'easeOutExpo');
		    		$('#my-menu').velocity({ right: -300 }, 450, 'easeOutExpo');
	        	}
		    }


		    $('#blocker').toggleClass('visible');
	        e.preventDefault();
	    });
		

		// Close Menu if Click on Body
	    $('#blocker').on('click', function(){
	    	$(this).removeClass('visible');
	    	$('#desktop-nav').removeClass('open');
	    	
	    	// Left Menu
	    	if($('header.header-menu.header-left-button').length > 0 ) {
	    		$('header.header-menu.header-left-button, .wrap_all').velocity({ left: 0 }, 450, 'easeOutExpo');
			    $('#my-menu').velocity({ left: -300 }, 450, 'easeOutExpo');
	    	}

	    	// Right Menu
	    	if($('header.header-menu.header-right-button').length > 0 ) {
	    		$('header.header-menu.header-right-button, .wrap_all').velocity({ right: 0 }, 450, 'easeOutExpo');
			    $('#my-menu').velocity({ right: -300 }, 450, 'easeOutExpo');
	    	}
	    });
	}

	if($('header.header-menu.header-normal').length > 0 || $('header.header-menu.header-fixed').length > 0 || $('header.header-menu.header-sticky').length > 0 ){
		$('.sf-menu').supersubs({
			minWidth: 12,
			//maxWidth: 27,
			extraWidth: 0 // set to 1 if lines turn over
		}).superfish({
			delay: 300,
			animation: {opacity:'show'},
			speed: 'fast',
			autoArrows: false,
			dropShadows: false
		}).supposition();
	}

	if($('header.header-menu.header-sticky').length > 0){
		$(window).scroll(function(){
	        var $this = $(this),
	            pos   = $this.scrollTop();
	        if (pos > 110){
	            $('header.header-menu.header-sticky').addClass('nav-small');
	        } else {
	            $('header.header-menu.header-sticky').removeClass('nav-small');
	        }
	    });
	}

	if($('header.header-menu.header-left-button').length > 0 || $('header.header-menu.header-left-opened').length > 0 || $('header.header-menu.header-right-opened').length > 0 || $('header.header-menu.header-right-button').length > 0 ){
	    // Add icon for sub-menu if exist
	    $('#my-menu li').each(function(){
			if($(this).find('> ul').length > 0) {
				$(this).addClass('has-ul').children('.sub-menu').hide();
				$(this).find('> a').append('<span class="cont"><i class="plus-icon"></i></span>');
			}
		});

		$('#my-menu li:has(">ul")').on('click', "a[href^='#']", function(){
			$(this).find('.cont').toggleClass('active');
			$(this).find('.cont').parent().parent().find('> ul').stop(true,true).slideToggle(350, 'easeOutExpo');
			return false;
		});

		$('#my-menu li:has(">ul") > a > .cont').click(function(){
			$(this).toggleClass('active');
			$(this).parent().parent().find('> ul').stop(true,true).slideToggle(350, 'easeOutExpo');
			return false;
		});
	}

	if($('header.header-menu.header-normal').length > 0 || $('header.header-menu.header-fixed').length > 0 || $('header.header-menu.header-sticky').length > 0 ){
		// Add icon for sub-menu if exist
		$('#my-menu ul .sub-menu li').not('#my-menu ul li.megamenu .sub-menu li').each(function(){
			if($(this).find('ul.sub-menu').length > 0) {
				 $(this).find('> a').append('<span class="cont-desk"><i class="font-icon-arrow-right-simple-thin-round"></i></span>');
			}
		});
	}

	// Mobile Menu Add icon for sub-menu if exist
	if($('#navigation-mobile').length > 0 ) {

		$('#navigation-mobile li').each(function(){
			if($(this).find('> ul').length > 0) {
				$(this).addClass('has-ul').children('.sub-menu').hide();
				$(this).find('> a').append('<span class="cont"><i class="plus-icon"></i></span>');
			}
		});

		$('#navigation-mobile li:has(">ul")').on('click', "a[href^='#']", function(){
			$(this).toggleClass('active');
			$(this).find('.cont').toggleClass('active');
			$(this).find('.cont').parent().parent().find('> ul').stop(true,true).slideToggle(350, 'easeOutExpo');
			return false;
		});

		$('#navigation-mobile li:has(">ul") > a > .cont').click(function(){
			$(this).toggleClass('active');
			$(this).parent().toggleClass('active');
			$(this).parent().parent().find('> ul').stop(true,true).slideToggle(350, 'easeOutExpo');
			return false;
		});

	}
};

// Mobile Menu
IBUKI.listenerMenuMobile = function(){
	$('#mobile-nav').on('click', function(e){
        $(this).toggleClass('open');
        $('#navigation-mobile').stop().slideToggle(350, 'easeOutExpo');
        e.preventDefault();
    });
};

IBUKI.mobileNavEvents = function(){
	var windowWidth = $(window).width();
	// Show Menu or Hide the Menu
	if( Modernizr.mq('(min-width: 320px) and (max-width: 1199px)') ) {
		/* Set Class */
		if ($('.wrap_all').hasClass('desktop-enabled')) {
			$('.wrap_all').removeClass('desktop-enabled');
			$('.wrap_all').addClass('mobile-enabled');
		}
		
		/* Remove Classes for Header Left/Right Button */
		if ($('#desktop-nav').hasClass('open')) {
			$('#desktop-nav').removeClass('open');
			/* Left Menu */
			$('.wrap_all.left-menu-button, .header-menu.header-left-button').css("left", 0);
			$('.header-menu.header-left-button #my-menu').css("left", -300);
			/* Right Menu */
			$('.wrap_all.right-menu-button, .header-menu.header-right-button').css("right", 0);
			$('.header-menu.header-right-button #my-menu').css("right", -300);
			/* Block Layer */
			$('#blocker').removeClass('visible');
		}
		
		/* Mobile Menu Classes */
		if (!$('#mobile-nav').hasClass('open')) {
			$('#navigation-mobile').css('display', 'none');
		}
		
	} else {
		/* Set Class */
		if ($('.wrap_all').hasClass('mobile-enabled')) {
			$('.wrap_all').removeClass('mobile-enabled');
			$('.wrap_all').addClass('desktop-enabled');
		}
		
		/* Mobile Menu Classes */	
		if ($('#mobile-nav').hasClass('open')) {
			$('#mobile-nav').removeClass('open');
		}
		$('#navigation-mobile').css('display', 'none');
		
	}
}

IBUKI.fullPageHeight = function(){
	var headerH = $('header.header-menu').outerHeight();
	var windowWidth = $(window).width();
	var num = 0;

	if( Modernizr.mq('(min-width: 320px) and (max-width: 1199px)') ) {
		num = headerH;
	} else {
		if ($('header.header-menu.header-normal').css("position") === "relative" || $('header.header-menu.header-fixed').css("position") === "fixed" || $('header.header-menu.header-sticky.no-transparent-enabled').css("position") === "fixed") {
	        num = headerH;
	    }

	    if($('.header.header-menu.header-sticky.header-transparent-enabled').length > 0 ){
	    	num = 0;
	    } 
	}

    $('.full-container').each(function(){
        var elem = $(this);
        var winH = window.innerHeight ? window.innerHeight:$(window).height();
        elem.css({'height': ( winH - num ) + 'px'});
    });

    $('.section-full-area').each(function(){
        var elem = $(this);
        var winH = window.innerHeight ? window.innerHeight:$(window).height();
        elem.css({'height': winH + 'px'});
    });

    // Control if exist full-container
    if ( $('.full-container').length > 0) {
    	// First Element
	    var elem = $('.section-full-area').slice(0,1);
	    var winH = window.innerHeight ? window.innerHeight:$(window).height();
	    elem.css({'height': winH + 'px'});
    } else {
    	// First Element
	    var elem = $('.section-full-area').slice(0,1);
	    var winH = window.innerHeight ? window.innerHeight:$(window).height();
	    elem.css({'height': (winH - num) + 'px'});
    }

};

IBUKI.normalToFull = function(){
	var headerH = $('header.header-menu').outerHeight();
	var oldHeight = $('.normal-container').attr('data-height');

	var num = '';
	if ($('header').css("position") === "relative") {
        num = headerH;
    } else {
    	num = 0;
    }

    var windowWidth = $(window).width();
    $('.normal-container.responsiveFull').each(function(){
        var elem = $(this);
        var winH = window.innerHeight ? window.innerHeight:$(window).height();
        if( Modernizr.mq('(min-width: 320px) and (max-width: 767px)') ) {
            elem.css({'height': (winH - num) + 'px'});
        } else {
            elem.css('height', oldHeight + 'px');
        }
    });
};

/* ==================================================
	MediaElements and Video Responsive
================================================== */

IBUKI.mediaElements = function(){

	$('audio, video').each(function(){
	    $(this).mediaelementplayer({
	    	autoRewind: false,
		    // if the <video width> is not specified, this is the default
		    defaultVideoWidth: 480,
		    // if the <video height> is not specified, this is the default
		    defaultVideoHeight: 270,
		    // if set, overrides <video width>
		    videoWidth: -1,
		    // if set, overrides <video height>
		    videoHeight: -1,
		    // width of audio player
		    audioWidth: 400,
		    // height of audio player
		    audioHeight: 50,
		    // initial volume when the player starts
		    startVolume: 0.8,
		    // path to Flash and Silverlight plugins
		    pluginPath: theme_objects.base + '/_include/js/mediaelement/',
		    // name of flash file
		    flashName: 'flashmediaelement.swf',
		    // name of silverlight file
		    silverlightName: 'silverlightmediaelement.xap',
		    // useful for <audio> player loops
		    loop: false,
		    // enables Flash and Silverlight to resize to content size
		    enableAutosize: true,
		    // the order of controls you want on the control bar (and other plugins below)
		    // Hide controls when playing and mouse is not over the video
		    alwaysShowControls: false,
		    // force iPad's native controls
		    iPadUseNativeControls: false,
		    // force iPhone's native controls
		    iPhoneUseNativeControls: false,
		    // force Android's native controls
		    AndroidUseNativeControls: false,
		    // forces the hour marker (##:00:00)
		    alwaysShowHours: false,
		    // show framecount in timecode (##:00:00:00)
		    showTimecodeFrameCount: false,
		    // used when showTimecodeFrameCount is set to true
		    framesPerSecond: 25,
		    // turns keyboard support on and off for this instance
		    enableKeyboard: true,
		    // when this player starts, it will pause other players
		    pauseOtherPlayers: false,
		    // array of keyboard commands
		    keyActions: []
	    });
	});

	$('.video-wrap video').each(function(){
	    $(this).mediaelementplayer({
	    	enableKeyboard: false,
	        iPadUseNativeControls: false,
	        pauseOtherPlayers: false,
	        iPhoneUseNativeControls: false,
	        AndroidUseNativeControls: false
	    });

	    if (navigator.userAgent.match(/(Android|iPod|iPhone|iPad|IEMobile|Opera Mini)/)) {
		    $(".video-section-container .mobile-video-image").show();
		    $(".video-section-container .video-wrap").remove()
		}
	});

	$(".video-section-container .video-wrap").each(function (b) {
		var min_w = 1500;
		var header_height = 0;
		var vid_w_orig = 1280;
		var vid_h_orig = 720;
	    
	    var f = $(this).closest(".video-section-container").outerWidth();
	    var e = $(this).closest(".video-section-container").outerHeight();
	    $(this).width(f);
	    $(this).height(e);
	    var a = f / vid_w_orig;
	    var d = (e - header_height) / vid_h_orig;
	    var c = a > d ? a : d;
	    min_w = 1280 / 720 * (e + 20);
	    if (c * vid_w_orig < min_w) {
	        c = min_w / vid_w_orig
	    }
	    $(this).find("video, .mejs-overlay, .mejs-poster").width(Math.ceil(c * vid_w_orig + 2));
	    $(this).find("video, .mejs-overlay, .mejs-poster").height(Math.ceil(c * vid_h_orig + 2));
	    $(this).scrollLeft(($(this).find("video").width() - f) / 2);
	    $(this).find(".mejs-overlay, .mejs-poster").scrollTop(($(this).find("video").height() - (e)) / 2);
	    $(this).scrollTop(($(this).find("video").height() - (e)) / 2);
	});

};

IBUKI.resizeMediaElements = function(){
	var entryAudioBlog = $('.audio-thumb');
	var entryVideoBlog = $('.video-thumb');

	entryAudioBlog.each(function() { 
		$(this).css("width", $('article').width() + "px"); 
	}); 

	entryVideoBlog.each(function() { 
		$(this).css("width", $('article').width() + "px"); 
	}); 
};

IBUKI.responsiveVideo = function(){
	$('.videoWrapper, .video-embed').fitVids();
};

/* ==================================================
	Accordion and Toggle
================================================== */

IBUKI.accordion = function(){
	if($('.accordion-builder').length > 0 ){
		$('.accordion h3').click(function(){
			
			if($(this).parents('.accordion').hasClass('open')) return false;
			
			$(this).parents('.accordions').find('.accordion > div').slideUp(300);
			$(this).parents('.accordions').find('.accordion').removeClass('open');
			
			$(this).parents('.accordion').find('> div').slideDown(300);
			$(this).parents('.accordion').addClass('open');
			
			return false;
		});
	}
};

IBUKI.toggle = function() {
	if($('.toggle-builder').length > 0 ){
		$('.toggle h3').click(function(){
			$(this).parents('.toggle').find('> div').slideToggle(300);
			$(this).parents('.toggle').toggleClass('open');
			return false;
		});
	}
};

IBUKI.tabs = function(){
	if($('.tabbable').length > 0 ){
	    $('.tabbable').each(function() {
	        $(this).find('li').first().addClass('active');
	        $(this).find('.tab-pane').first().addClass('active'); 
	    });
	
	    $('.tabbable .nav-tabs a').each(function(){
			var $uid = $(this).attr('href').split('#').join('');
			var $pos = $('.tabbable .nav-tabs a').index(this);

			$('.tabbable .tab-pane').eq($pos).attr('id', $uid);
		});
	}
};

/* ==================================================
	Google Maps Shortcodes
================================================== */

IBUKI.googleMaps = function(){
	if($('.az-map').length > 0) {

		$('.az-map').each(function(i,e){

			var $map = $(e);
			var $map_id = $map.attr('id');
			var $map_lat = $map.attr('data-map-lat');
			var $map_lon = $map.attr('data-map-lon');
			var $map_zoom = parseInt($map.attr('data-map-zoom'));
			var $map_title = $map.attr('data-map-title');
			var $map_marker_img = $map.attr('data-map-pin');
			var $map_info = $map.attr('data-map-info');

			var $map_hue = $map.attr('data-map-color');
			var $map_saturation = $map.attr('data-map-saturation');
			var $map_lightness = $map.attr('data-map-lightness');

			var $map_scroll = $map.data('map-scroll');
			var $map_drag 	= $map.data('map-drag');
			var $map_zoom_control = $map.data('map-zoom-control');
			var $map_disable_doubleclick = $map.data('map-double-click');
			var $map_disable_default_ui = $map.data('map-default');
			
			
			
			var latlng = new google.maps.LatLng($map_lat, $map_lon);			
			var options = { 
				scrollwheel: $map_scroll,
				draggable: $map_drag, 
				zoomControl: $map_zoom_control,
				disableDoubleClickZoom: $map_disable_doubleclick,
				disableDefaultUI: $map_disable_default_ui,
				zoom: $map_zoom,
				center: latlng,
				mapTypeId: google.maps.MapTypeId.ROADMAP
			};
			
			var styles = [ 
							{
								stylers: [
									{ hue: $map_hue }, // Inser Your Hue Color
								  	{ saturation: $map_saturation },
								  	{ lightness: $map_lightness }
								]
							  	},{
									featureType: "road",
									elementType: "geometry",
									stylers: [
										{ lightness: 50 },
								  		{ saturation: 0 },
								  		{ visibility: "simplified" }
									]
							  	},{
									featureType: "road",
									elementType: "labels",
									stylers: [
								  		{ visibility: "on" }
									]
								}
							];
			
			var styledMap = new google.maps.StyledMapType(styles,{name: "Styled Map"});
			
			var map = new google.maps.Map(document.getElementById($map_id), options);
		
			var image = $map_marker_img;
			var marker = new google.maps.Marker({
				position: latlng,
				map: map,
				title: $map_title,
				icon: image
			});
			
			map.mapTypes.set('map_style', styledMap);
  			map.setMapTypeId('map_style');
			
			var contentString = $map_info;
       
			var infowindow = new google.maps.InfoWindow({
				content: contentString
			});
			
			google.maps.event.addListener(marker, 'click', function() {
      			infowindow.open(map,marker);
    		});

		});
	}
};

/* ==================================================
	Custom Select
================================================== */

IBUKI.customSelect = function(){
	if($('.selectpicker').length > 0){
		$('.selectpicker').selectpicker();
	}
};

IBUKI.naviNone = function(){
    var f = $('.post-type-navi');
    var n = $('li.next');
    var m = $('li.prev');
    var o = $('div.prev-blog');
    var p = $('div.next-blog');
    var r = $('li.back-blog');
    var s = $('li.back-portfolio');
    if(r.length && r.html() == '') {
        f.addClass('no-back');                                                              
    } 
    if(s.length && s.html() == '') {
        f.addClass('no-back');                                                              
    }                                        
    if(n.length && n.html() == '') {
        f.addClass('mod-col');                                        
        n.addClass('none');
        m.addClass('single');                           
    }
    if(m.length && m.html() == '') {
        f.addClass('mod-col');                                        
        m.addClass('none');
        n.addClass('single');                          
    }
    if(o.length && o.html() == '') {
        f.addClass('mod-col');                                        
        o.addClass('none');                          
    }
    if(p.length && p.html() == '') {
        f.addClass('mod-col');                                        
        p.addClass('none');                          
    }
};

IBUKI.portfolio = function(){

if($('#portfolio-filter').length > 0){ 
	$('.dropmenu').on('click', function(e){
	    $(this).toggleClass('open');
	    
	    $('.dropmenu-active').stop().slideToggle(350, 'easeOutExpo');
	    
	    e.preventDefault();
	});

	// Dropdown
	$('.dropmenu-active a').on('click', function(e){
	    var dropdown = $(this).parents('.dropdown');
	    var selected = dropdown.find('.dropmenu .selected');
	    var newSelect = $(this).html();
	    
	    $('.dropmenu').removeClass('open');
	    $('.dropmenu-active').slideUp(350, 'easeOutExpo');
	    
	    selected.html(newSelect);
	    
	    e.preventDefault();
	});
}

if($('#portfolio-items.grid-portfolio').length > 0 || $('#portfolio-items.masonry-portfolio').length > 0 || $('#portfolio-items.listed-portfolio').length > 0 || $('#portfolio-items.masonry-block-portfolio').length > 0 ){       
    var $container = $('#portfolio-items');

    // Find it Filter has Elements
	$('#portfolio-filter ul.option-set li').each( function() {
		var filter = $(this),
			filterName = $(this).find('a').attr('class'),
			portfolioItems = $('#portfolio-items');
		
		portfolioItems.find('.single-portfolio').each( function() {
			if ( $(this).hasClass(filterName) ) {
				filter.addClass('has-items');
			}
		});
	});

    // filter items when filter link is clicked
    var $optionSets = $('#portfolio-filter .option-set'),
        $optionLinks = $optionSets.find('a');

      $optionLinks.click(function(){
        var $this = $(this);
        // don't proceed if already selected
        if ( $this.hasClass('selected') ) {
          return false;
        }
        var $optionSet = $this.parents('.option-set');
        $optionSet.find('.selected').removeClass('selected');
        $this.addClass('selected');

        // make option object dynamically, i.e. { filter: '.my-filter-class' }
        var options = {},
            key = $optionSet.attr('data-option-key'),
            value = $this.attr('data-option-value');
        // parse 'false' as false boolean
        value = value === 'false' ? false : value;
        options[ key ] = value;
        if ( key === 'layoutMode' && typeof changeLayoutMode === 'function' ) {
          // changes in layout modes need extra logic
          changeLayoutMode( $this, options );
        } else {
          // otherwise, apply new options
          $container.isotope( options );
        }

        return false;
    });
}

if($('#portfolio-items.grid-portfolio').length > 0 || $('#portfolio-items.listed-portfolio').length > 0 ) {
	
	if($('#portfolio-items.isotope.filter-animated').length > 0 ) {
		$container.imagesLoaded(function() {
	        $container.isotope({
	          	// options
	          	resizable: true,
				layoutMode: 'fitRows',
				itemSelector : '.single-portfolio'
	        });
	    }).done( function( instance ) {
	    	$container.velocity({ opacity: 1 }, 850, 'easeInOutExpo' );
	  	}).fail( function() {
	  		$container.velocity({ opacity: 1 }, 850, 'easeInOutExpo' );
	  	});
	} else {
		$container.imagesLoaded(function() {
	        $container.isotope({
	          	// options
	          	resizable: true,
				layoutMode: 'fitRows',
				itemSelector : '.single-portfolio',
	          	transitionDuration: 0
	        });
	    }).done( function( instance ) {
	    	$container.velocity({ opacity: 1 }, 850, 'easeInOutExpo' );
	  	}).fail( function() {
	  		$container.velocity({ opacity: 1 }, 850, 'easeInOutExpo' );
	  	});
	}
}

if($('#portfolio-items.masonry-portfolio').length > 0 ) {

	if($('#portfolio-items.isotope.filter-animated').length > 0 ) {
		$container.imagesLoaded(function() {
	        $container.isotope({
	          	// options
	          	resizable: false,
				layoutMode: 'masonry',
				itemSelector : '.single-portfolio'
	        });
	    }).done( function( instance ) {
	    	$container.velocity({ opacity: 1 }, 850, 'easeInOutExpo' );
	  	}).fail( function() {
	  		$container.velocity({ opacity: 1 }, 850, 'easeInOutExpo' );
	  	});
	} else {
		$container.imagesLoaded(function() {
	        $container.isotope({
	          	// options
	          	resizable: false,
				layoutMode: 'masonry',
				itemSelector : '.single-portfolio',
	          	transitionDuration: 0
	        });
	    }).done( function( instance ) {
	    	$container.velocity({ opacity: 1 }, 850, 'easeInOutExpo' );
	  	}).fail( function() {
	  		$container.velocity({ opacity: 1 }, 850, 'easeInOutExpo' );
	  	});
	}
}

if($('#portfolio-items.masonry-block-portfolio').length > 0 ) {

	if($('#portfolio-items.isotope.filter-animated').length > 0 ) {
		$container.imagesLoaded(function() {
	        $container.isotope({
	          	// options
	          	resizable: false,
				layoutMode: 'masonry',
				itemSelector : '.single-portfolio',
				masonry: {
					columnWidth: '.grid-sizer'
				}
	        });
	    }).done( function( instance ) {
	    	$container.velocity({ opacity: 1 }, 850, 'easeInOutExpo' );
	  	}).fail( function() {
	  		$container.velocity({ opacity: 1 }, 850, 'easeInOutExpo' );
	  	});
	} else {
		$container.imagesLoaded(function() {
	        $container.isotope({
	          	// options
	          	resizable: false,
				layoutMode: 'masonry',
				itemSelector : '.single-portfolio',
				masonry: {
					columnWidth: '.grid-sizer'
				},
	          	transitionDuration: 0
	        });
	    }).done( function( instance ) {
	    	$container.velocity({ opacity: 1 }, 850, 'easeInOutExpo' );
	  	}).fail( function() {
	  		$container.velocity({ opacity: 1 }, 850, 'easeInOutExpo' );
	  	});
	}
}

};

IBUKI.stripedPortfolio = function(){
	if($('#portfolio-items.striped-portfolio').length > 0 ) {
		var $container = $('#portfolio-items');
		var headerH = $('header.header-menu').outerHeight();
		var headerS = 60; /* header sticky height when you scroll - change this value if you has changed the height of the header when you scroll the page */

		$container.imagesLoaded().done( function( instance ) {
	    	$container.velocity({ opacity: 1 }, 850, 'easeInOutExpo' );
	  	}).fail( function() {
	  		$container.velocity({ opacity: 1 }, 850, 'easeInOutExpo' );
	  	});

	    if( Modernizr.mq('(min-width: 1200px)') ) {
	    	if ($('header.header-menu.header-normal').css("position") === "relative") {
		        $('.single-portfolio').each(function(){
			        var elem = $(this);
			        var winH = window.innerHeight ? window.innerHeight:$(window).height();
			        elem.css({'height': winH + 'px'});
			    });

		        // If Exist Page Header or Section first the Portfolio
		        if ($('#text-header, #image-header, #slider-header-revolution, section.main-content.no-first').length > 0 ) {
			        // reset the height of columns
		    	} else {
		    		// First Three Elements
		    		var elem = $('.single-portfolio').slice(0,3);
			        var winH = window.innerHeight ? window.innerHeight:$(window).height();
			        var result = winH - headerH;
			        elem.css({'height': result + 'px'});
		    	}
		    }
		    else if ($('header.header-menu.header-fixed').css("position") === "fixed") {
		    	$('.single-portfolio').each(function(){
			        var elem = $(this);
			        var winH = window.innerHeight ? window.innerHeight:$(window).height();
			        var result = winH - headerH;
			        elem.css({'height': result + 'px'});
			    });
		    }
		    else if ($('header.header-menu.header-sticky.no-transparent-enabled').css("position") === "fixed") {
		    	$('.single-portfolio').each(function(){
			        var elem = $(this);
			        var winH = window.innerHeight ? window.innerHeight:$(window).height();
			        var result = winH - headerS;
			        elem.css({'height': result + 'px'});
			    });

			    // If Exist Page Header or Section first the Portfolio
			    if ($('#text-header, #image-header, #slider-header-revolution, section.main-content.no-first').length > 0 ) {
			        // reset the height of columns
		    	} else {
		    		// First Three Elements
			    	var elem = $('.single-portfolio').slice(0,3);
			        var winH = window.innerHeight ? window.innerHeight:$(window).height();
			        var result = winH - headerH;
			        elem.css({'height': result + 'px'});
		    	}
		    }
		    else if($('header.header-menu.header-sticky.header-transparent-enabled').css("position") === "fixed"){
		    	$('.single-portfolio').each(function(){
			        var elem = $(this);
			        var winH = window.innerHeight ? window.innerHeight:$(window).height();
			        var result = winH - headerS;
			        elem.css({'height': result + 'px'});
			    });

			    // If Exist Page Header or Section first the Portfolio
			    if ($('#text-header, #image-header, #slider-header-revolution, section.main-content.no-first').length > 0 ) {
			        // reset the height of columns
		    	} else {
		    		// First Three Elements
			    	var elem = $('.single-portfolio').slice(0,3);
			        var winH = window.innerHeight ? window.innerHeight:$(window).height();
			        var result = winH;
			        elem.css({'height': result + 'px'});
		    	}
		    }
		    else {
		    	$('.single-portfolio').each(function(){
			        var elem = $(this);
			        var winH = window.innerHeight ? window.innerHeight:$(window).height();
			        elem.css({'height': winH + 'px'});
			    });
		    }
	    }

	    if( Modernizr.mq('(min-width: 768px) and (max-width: 1199px)') ) {
	        $('.single-portfolio').each(function(){
	            var elem = $(this);
	            var winH = window.innerHeight ? window.innerHeight:$(window).height();
	            elem.css({'height': winH / 2 + 'px'});
	        });

	        // If Exist Page Header or Section first the Portfolio
	        if ($('#text-header, #image-header, #slider-header-revolution, section.main-content.no-first').length > 0 ) {
			    // reset the height of columns
		    } else {
		    	// First Four Elements
		        var elem = $('.single-portfolio').slice(0,4);
		        var winH = window.innerHeight ? window.innerHeight:$(window).height();
		        var result = winH - headerH;
		        elem.css({'height': result / 2 + 'px'});
		    }
	    }

	    if( Modernizr.mq('(min-width: 320px) and (max-width: 767px)') ) {
	        $('.single-portfolio').each(function(){
	            var elem = $(this);
	            var winH = window.innerHeight ? window.innerHeight:$(window).height();
	            elem.css({'height': winH + 'px'});
	        });

	        // If Exist Page Header or Section first the Portfolio
	        if ($('#text-header, #image-header, #slider-header-revolution, section.main-content.no-first').length > 0 ) {
			    // reset the height of columns
		    } else {
		    	// First Element
		        var elem = $('.single-portfolio').slice(0,1);
		        var winH = window.innerHeight ? window.innerHeight:$(window).height();
		        var result = winH - headerH;
		        elem.css({'height': result + 'px'});
		    }
	    }

	}
};

IBUKI.scrollablePortfolio = function(){
	if($('#portfolio-items.scrollable-portfolio').length > 0 ) {
		IBUKI.scrollLeft();
		IBUKI.ulWidhtSize();

		var $container = $('#portfolio-items');
		var headerH = $('header.header-menu').outerHeight();

		$container.imagesLoaded().done( function( instance ) {
	    	$container.velocity({ opacity: 1 }, 850, 'easeInOutExpo' );
	  	}).fail( function() {
	  		$container.velocity({ opacity: 1 }, 850, 'easeInOutExpo' );
	  	});

	  	if( Modernizr.mq('(min-width: 1200px)') ) {
	    	if ($('header.header-menu.header-normal').css("position") === "relative") {
		        $('.single-portfolio').each(function(){
			        var elem = $(this);
			        var winH = window.innerHeight ? window.innerHeight:$(window).height();
			        var result = winH - headerH;
			        elem.css({'height': result + 'px'});
			    });
		    }
		    else if ($('header.header-menu.header-fixed').css("position") === "fixed") {
		    	$('.single-portfolio').each(function(){
			        var elem = $(this);
			        var winH = window.innerHeight ? window.innerHeight:$(window).height();
			        var result = winH - headerH;
			        elem.css({'height': result + 'px'});
			    });
		    }
		    else if ($('header.header-menu.header-sticky.no-transparent-enabled').css("position") === "fixed") {
		    	$('.single-portfolio').each(function(){
			        var elem = $(this);
			        var winH = window.innerHeight ? window.innerHeight:$(window).height();
			        var result = winH - headerH;
			        elem.css({'height': result + 'px'});
			    });
		    }
		    else if($('header.header-menu.header-sticky.header-transparent-enabled').css("position") === "fixed"){
		    	$('.single-portfolio').each(function(){
			        var elem = $(this);
			        var winH = window.innerHeight ? window.innerHeight:$(window).height();
			        var result = winH;
			        elem.css({'height': result + 'px'});
			    });
		    }
		    else {
		    	$('.single-portfolio').each(function(){
			        var elem = $(this);
			        var winH = window.innerHeight ? window.innerHeight:$(window).height();
			        elem.css({'height': winH + 'px'});
			    });
		    }
	    }

	    if( Modernizr.mq('(min-width: 768px) and (max-width: 1199px)') ) {
	        $('.single-portfolio').each(function(){
	            var elem = $(this);
	            var winH = window.innerHeight ? window.innerHeight:$(window).height();
	            elem.css({'height': winH / 2 + 'px'});
	        });

	    	// First Four Elements
	        var elem = $('.single-portfolio').slice(0,4);
	        var winH = window.innerHeight ? window.innerHeight:$(window).height();
	        var result = winH - headerH;
	        elem.css({'height': result / 2 + 'px'});
	    }

	    if( Modernizr.mq('(min-width: 320px) and (max-width: 767px)') ) {
	        $('.single-portfolio').each(function(){
	            var elem = $(this);
	            var winH = window.innerHeight ? window.innerHeight:$(window).height();
	            elem.css({'height': winH + 'px'});
	        });

	    	// First Element
	        var elem = $('.single-portfolio').slice(0,1);
	        var winH = window.innerHeight ? window.innerHeight:$(window).height();
	        var result = winH - headerH;
	        elem.css({'height': result + 'px'});
	        
	    }

	}
};

IBUKI.scrollLeft = function() {
	$('body, #content').css('overflow','visible');

	if( Modernizr.mq('(min-width: 1200px)') ) {
	    $("body, html").on('mousewheel', function(event, delta) {
	        if ($('body.opera').hasClass('osx')) {
	            this.scrollLeft -= (delta * 3);
	        }
	        else if ($('body.opera').hasClass('windows')) {
	            this.scrollLeft -= (delta * 120);
	        } else {
	            this.scrollLeft -= (delta * event.deltaFactor);
	        }
	        event.preventDefault();
	    });
	} else {
	    $("body, html").unmousewheel();
	}
};

IBUKI.ulWidhtSize = function(){
	var ul = $('#portfolio-items');

	var ulWidth = 0;
	$('#portfolio-items.scrollable-portfolio .col-scrollable-1').each(function(){
	    ulWidth = ulWidth + $(this).width();
	});

	if($('.header-right-button-enabled').length > 0 ) {
		$('#portfolio-items').css({'width' : ulWidth + 40 + 'px'});
	}
	else if($('.header-right-opened').length > 0 ) {
		$('#portfolio-items').css({'width' : ulWidth + 300 + 'px'});
	} else {
		$('#portfolio-items').css({'width' : ulWidth + 'px'});
	}
};

IBUKI.infiniteScrollPortfolio = function(){
	
    var method_scroll = '',
    	message_txt   = '',
    	finished_txt  = '';

	if($("#portfolio-items[data-method='twitter']").length>0) {
	 	method_scroll = 'twitter';
	 	message_txt = '';
	 	finished_txt = '';
	} else {
		method_scroll = 'manual';
		message_txt = '<div class="loading-spinner-infinite-scroll-wrap"><div class="loading-spinner-infinite-scroll"></div></div>';
		finished_txt = '';
	}
	

	$('#portfolio-items.infinite-scroll-enabled').infinitescroll({
    	loading: {
	    	finished: undefined,
		    finishedMsg: finished_txt,
		    //img: null,
		    msg: null,
		    msgText: message_txt,
		    selector: '.loader-infinite',
		    speed: 'fast',
		    start: undefined
	  	},
	  	state: {
	    	isDuringAjax: false,
	    	isInvalidPage: false,
	    	isDestroyed: false,
	    	isDone: false, // For when it goes all the way through the archive.
	    	isPaused: false,
	    	currPage: 1
	  	},
	  	behavior: method_scroll, // set manual if you want the automatic scroll
	  	binder: $(window), // used to cache the selector for the element that will be scrolling
	  	nextSelector: ".pagenavi li.next a",
	  	navSelector: ".pagenavi",
	  	contentSelector: "#portfolio-items", // rename to pageFragment
	  	extraScrollPx: 150,
	  	itemSelector: ".single-portfolio",
	  	animate: false,
	  	pathParse: undefined,
	  	dataType: 'html',
	  	appendCallback: true,
	  	bufferPx: 600,
	  	errorCallback: function () { },
	  	infid: 0, //Instance ID
	  	pixelsFromNavToBottom: undefined,
	  	path: undefined, // Can either be an array of URL parts (e.g. ["/page/", "/"]) or a function that accepts the page number and returns a URL
	  	maxPage:undefined // to manually control maximum page (when maxPage is undefined, maximum page limitation is not work)
    },	
        function( newElements ) {
			// initially hide new elements, and use imagesLoaded
			var $container = $('#portfolio-items');
			var $newElems = $(newElements).css({ opacity: 0 });

			$newElems.imagesLoaded(function(){
				$container.isotope( 'appended', $( newElements ) );
				$(newElements).css({ opacity: 0 }).addClass('ajax-loaded');
				
				$(newElements).each(function(i){
		        	$(this).delay(i*125).velocity({opacity:1},700, 'easeInOutExpo');
		        });
			});
		}
    );

};


/* ==================================================
   FancyBox
================================================== */

IBUKI.fancyBox = function(){
	if($('.fancybox-thumb').length > 0 || $('.fancybox-media').length > 0 || $('.fancybox-various').length > 0){
		
		$(".fancybox-thumb").fancybox({				
			padding : 0,
			openMethod: 'zoomIn',
            closeMethod: 'zoomOut',
            nextEasing: 'easeInQuad',
            prevEasing: 'easeInQuad',
			helpers : {
				title : { type: 'inside' }
			},
			afterLoad : function() {
                this.title = '<span class="counter-img">' + (this.index + 1) + ' / ' + this.group.length + '</span>' + (this.title ? '' + this.title : '');
            },
            beforeShow: function(){
			    $(window).on({
			      	'resize.fancybox' : function(){
			        	$.fancybox.update();
			      	}
			    });
			},
			afterClose: function(){
			    $(window).off('resize.fancybox');
			}
		});
			
		$('.fancybox-media').fancybox({
			padding : 0,
			helpers : {
				media : true
			},
			openMethod: 'zoomIn',
            closeMethod: 'zoomOut',
            nextEasing: 'easeInQuad',
            prevEasing: 'easeInQuad',
			width       : 800,
    		height      : 450,
    		aspectRatio : true,
    		scrolling   : 'no',
    		beforeShow: function(){
			    $(window).on({
			      	'resize.fancybox' : function(){
			        	$.fancybox.update();
			      	}
			    });
			},
			afterClose: function(){
			    $(window).off('resize.fancybox');
			}
		});
		
		$(".fancybox-various").fancybox({
			maxWidth	: 800,
			maxHeight	: 600,
			fitToView	: false,
			width		: '70%',
			height		: '70%',
			autoSize	: false,
			closeClick	: false,
			openMethod: 'zoomIn',
            closeMethod: 'zoomOut',
            nextEasing: 'easeInQuad',
            prevEasing: 'easeInQuad'
		});
	}
};

/* ==================================================
	Scroll Btn
================================================== */

IBUKI.scrollBtnFullArea = function(){
	$('.scroll-btn-full-area').on('click', function() {
	    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') 
	        || location.hostname == this.hostname) {

	        var target = $(this.hash);
	        target = target.length ? target : $('[name="' + this.hash.slice(1) +'"]');
	           if (target.length) {
	            $('html,body').animate({
	                 scrollTop: target.offset().top
	            }, 1000, 'easeOutExpo');
	            return false;
	        }
	    }
	});
};

IBUKI.scrollBtnHeaderPage = function(){
	$('.scroll-btn-full-area.metabox-header').on('click', function(e) {
		e.preventDefault();
		$('html,body').animate({scrollTop: $('.wrap_content').first().offset().top}, 850, 'easeOutExpo');
	});
};

/* ==================================================
   Tooltip
================================================== */

IBUKI.toolTip = function(){ 
    $('a[data-toggle=tooltip]').tooltip();
};

/* ==================================================
   Progress Bar Animated 
================================================== */

IBUKI.progressBar = function(){
	if($('.bar.animable').length > 0 ){
		$('.bar.animable').each(function() {
	        var percent = $(this).data('percent');
	        $(this).appear(function() {
	       		$(this).animate({width: percent+'%'},1000, 'easeOutExpo');
	       	});    
	    });
	}
};

/* ==================================================
   Circular Graph 
================================================== */

IBUKI.circularGraph = function(){
	if($('.chart').length > 0 ){
		var chart = $('.chart');
	
		$(chart).each(function() {
			$(this).appear(function() {
				var currentChart = $(this),
					currentSize = currentChart.attr('data-size'),
					currentLine = currentChart.attr('data-line'),
					currentBgColor = currentChart.attr('data-bgcolor'),
					currentTrackColor = currentChart.attr('data-trackcolor');
				currentChart.easyPieChart({
					animate: 1000,
					barColor: currentBgColor,
					trackColor: currentTrackColor,
					lineWidth: currentLine,
					size: currentSize,
					lineCap: 'round',
					scaleColor: false,
					onStep: function(value) {
		          		this.$el.find('.percentage').text(~~value);
		        	}
				});
			});
		});
	}	
};

/* ==================================================
   Count Number 
================================================== */

IBUKI.countNumber = function(){
	if($('.counter-number').length > 0 ){
		$('.output-number').each(function() {
			var delay = $(this).data('delay');
			$(this).appear(function() {
				$(this).delay(delay).queue(function(){
					$(this).find('.timer').countTo();
				});
	       	});
		});
	}
};

/* ==================================================
	Testimonial Sliders
================================================== */

IBUKI.testimonial = function(){
if($('.testimonial').length > 0 ){
	$(window).load(function() {
		$('.az-testimonials.flexslider').flexslider({
			animation:"horizontal",
			easing:"swing",
			controlNav: true, 
			reverse: false,
			smoothHeight: true,
			directionNav: false,
			animationSpeed: 400 
		});
	});
}
};

/* ==================================================
	Big Twitter Feeds Slider
================================================== */

IBUKI.bigTweetSlide = function(){
if($('#twitter-feed-slide .slides').length > 0 ){
	$('#twitter-feed-slide').flexslider({
		animation:"horizontal",
		easing:"swing",
		controlNav: false, 
		reverse: false,
		smoothHeight: true,
		directionNav: false, 
		controlsContainer: '#twitter-feed-slide',
		animationSpeed: 400
	});
}
};

/* ==================================================
	Buttons Hover
================================================== */

IBUKI.buttonHover = function(){
	
	// Custom Button Color
	$('.button-main.custom-button-color').mouseover(function(){
		$(this).css({
			'background-color' : 'transparent',
			'color' : $(this).data('hover-color')
		});
	}).mouseout(function(){
		$(this).css({
			'background-color' : $(this).data('color-button'),
			'color' : $(this).data('color-text')
		});
	});

	// Custom Button Color Inverted
	$('.button-main.custom-button-color.inverted').mouseover(function(){
		$(this).css({
			'background-color' : $(this).data('color-button'),
			'border-color' : $(this).data('color-button'),
			'color' : $(this).data('hover-color')
		});
	}).mouseout(function(){
		$(this).css({
			'background-color' : 'transparent',
			'border-color' : $(this).data('color-button'),
			'color' : $(this).data('color-text')
		});
	});
};


/* ==================================================
	Scroll to Top
================================================== */

IBUKI.scrollToTop = function(){
	var didScroll = false;
	var $arrow = $('#back-to-top');

	$(window).scroll(function() {
		didScroll = true;
	});

	if( $('.post-type-navi').length > 0 ) {
		$arrow.css({'bottom': 61 + 'px'});
	}

	setInterval(function() {
		if( didScroll ) {
			didScroll = false;

			if( $(window).scrollTop() > 1000 ) {
				$arrow.fadeIn(250, 'easeOutExpo');
			} else {
				$arrow.fadeOut(250, 'easeOutExpo');
			}
		}
	}, 250);

	$arrow.on('click', function(){
		$('body, html').animate({ scrollTop: "0" }, 750, 'easeOutExpo' );
		return false;
	});
};

/* ==================================================
	Social Share Button
================================================== */

IBUKI.socialShare = function(){
    function sharePopup(url){
        var width = 600;
        var height = 400;
       
        var leftPosition, topPosition;
        leftPosition = (window.screen.width / 2) - ((width / 2) + 10);
        topPosition = (window.screen.height / 2) - ((height / 2) + 50);
 
        var windowFeatures = "status=no,height=" + height + ",width=" + width + ",resizable=yes,left=" + leftPosition + ",top=" + topPosition + ",screenX=" + leftPosition + ",screenY=" + topPosition + ",toolbar=no,menubar=no,scrollbars=no,location=no,directories=no";
 
        window.open(url,'Social Share', windowFeatures);
    }
 
    $('#share-facebook').on('click', function(){
        var u = location.href;
        var t = document.title;
        sharePopup('http://www.facebook.com/sharer.php?u='+encodeURIComponent(u)+'&t='+encodeURIComponent(t));
        return false;
    });
 
 
    $('#share-twitter').on('click', function(){
        var u = location.href;
        var t = document.title+' - ';
        sharePopup('http://twitter.com/share?url='+encodeURIComponent(u)+'&text='+encodeURIComponent(t));
        return false;
    });
 
    $('#share-google').on('click', function(){
        var u = location.href;
        var t = document.title;
        sharePopup('https://plus.google.com/share?url='+encodeURIComponent(u)+'&text='+encodeURIComponent(t));
        return false;
    });

    $('#share-pinterest').on('click', function(){
        var u = location.href;
        var t = document.title;
        var bg_url = $('#content img').first().attr('src');
        sharePopup('http://www.pinterest.com/pin/create/button/?url='+encodeURIComponent(u)+'&description='+encodeURIComponent(t)+'&media='+encodeURIComponent(bg_url));
        return false;
    });
}

/* ==================================================
	Carousel
================================================== */

IBUKI.carousel = function(){

// Client Carosuel
if($('.az-clients.carousel-enabled').length > 0 ){
	$('.az-clients.carousel-enabled').each(function(){
    	var $items = $(this).data('items');
    	var $navigation  = Boolean($(this).data('navigation'));
    	var $pagination  = Boolean($(this).data('pagination'));
    	var $autoplay	 = Boolean($(this).data('autoplay'));

    	var $items_tablet = ($(this).data('items-tablet')) ? $(this).data('items-tablet') : 3;
    	var $items_mobile = ($(this).data('items-mobile')) ? $(this).data('items-mobile') : 1;

    	$(this).owlCarousel({
		    items 				: $items,
		    itemsDesktop 		: [1200, $items],
		    itemsDesktopSmall 	: [1200, $items],
		    itemsTablet 		: [1199, $items_tablet],
		    itemsMobile 		: [767, $items_mobile],
		    navigation 			: $navigation,
		    pagination 			: $pagination,
		    autoPlay			: $autoplay,
			autoHeight 			: true
    	});
    });
}

// Portfolio Carousel
if($('#portfolio-items.carousel-portfolio.carousel-enabled').length > 0 ){
	$('#portfolio-items.carousel-portfolio.carousel-enabled').each(function(){
    	var $items = $(this).data('items');
    	var $navigation  = Boolean($(this).data('navigation'));
    	var $pagination  = Boolean($(this).data('pagination'));
    	var $autoplay	 = Boolean($(this).data('autoplay'));

    	var $items_tablet = ($(this).data('items-tablet')) ? $(this).data('items-tablet') : 3;
    	var $items_mobile = ($(this).data('items-mobile')) ? $(this).data('items-mobile') : 1;

    	$(this).owlCarousel({
		    items 				: $items,
		    itemsDesktop 		: [1200, $items],
		    itemsDesktopSmall 	: [1200, $items],
		    itemsTablet 		: [1199, $items_tablet],
		    itemsMobile 		: [767, $items_mobile],
		    navigation 			: $navigation,
		    pagination 			: $pagination,
		    autoPlay			: $autoplay,
			autoHeight 			: true
    	});
    });
}

// Team Carousel
if($('#team-people.carousel-team.carousel-enabled').length > 0 ){
	$('#team-people.carousel-team.carousel-enabled').each(function(){
    	var $items = $(this).data('items');
    	var $navigation  = Boolean($(this).data('navigation'));
    	var $pagination  = Boolean($(this).data('pagination'));
    	var $autoplay	 = Boolean($(this).data('autoplay'));

    	var $items_tablet = ($(this).data('items-tablet')) ? $(this).data('items-tablet') : 3;
    	var $items_mobile = ($(this).data('items-mobile')) ? $(this).data('items-mobile') : 1;

    	$(this).owlCarousel({
		    items 				: $items,
		    itemsDesktop 		: [1200, $items],
		    itemsDesktopSmall 	: [1200, $items],
		    itemsTablet 		: [1199, $items_tablet],
		    itemsMobile 		: [767, $items_mobile],
		    navigation 			: $navigation,
		    pagination 			: $pagination,
		    autoPlay			: $autoplay,
			autoHeight 			: true
    	});
    });
}

// Gallery Carousel
if($('.gallery-az.carousel-enabled').length > 0 ){
	$('.gallery-az.carousel-enabled').each(function(){
    	var $items = $(this).data('items');
    	var $navigation  = Boolean($(this).data('navigation'));
    	var $pagination  = Boolean($(this).data('pagination'));
    	var $autoplay	 = Boolean($(this).data('autoplay'));

    	var $items_tablet = ($(this).data('items-tablet')) ? $(this).data('items-tablet') : 3;
    	var $items_mobile = ($(this).data('items-mobile')) ? $(this).data('items-mobile') : 1;

    	$(this).owlCarousel({
		    items 				: $items,
		    itemsDesktop 		: [1200, $items],
		    itemsDesktopSmall 	: [1200, $items],
		    itemsTablet 		: [1199, $items_tablet],
		    itemsMobile 		: [767, $items_mobile],
		    navigation 			: $navigation,
		    pagination 			: $pagination,
		    autoPlay			: $autoplay,
			autoHeight 			: true
    	});
    });
}

};

/* ==================================================
	Animations Module
================================================== */

IBUKI.animationsModule = function(){
	
	function elementViewed(element) {
		if (Modernizr.touch && $(document.documentElement).hasClass('no-animation-effects')) {
			return true;
		}
		var elem = element,
			window_top = $(window).scrollTop(),
			offset = $(elem).offset(),
			top = offset.top;
		if ($(elem).length > 0) {
			if (top + $(elem).height() >= window_top && top <= window_top + $(window).height()) {
				return true;
			} else {
				return false;
			}
		}
	};
	
	function onScrollInterval(){
		var didScroll = false;
		$(window).scroll(function(){
			didScroll = true;
		});
		
		setInterval(function(){
			if (didScroll) {
				didScroll = false;
			}
			
			if($('.animated-content').length > 0 ){
				$('.animated-content').each(function() {
					var currentObj = $(this);
					var delay = currentObj.data('delay');
					if (elementViewed(currentObj)) {
						currentObj.delay(delay).queue(function(){
							currentObj.addClass('animate');
						});
					}
				});
			}
		}, 250);
	};
	
	onScrollInterval();
};

/* ==================================================
	Menu Leave Page / Cache Back Button Reload
================================================== */

IBUKI.leavePage = function(){
	if($('.one-page-enabled').length > 0 ) {
		$('header #logo, #my-menu > .mm-panel li a.external, #navigation-mobile ul li a.external').not('#my-menu > .mm-panel li a[href$="#"], #my-menu > .mm-panel li a[href^="#"], #navigation-mobile ul li a[href$="#"], #navigation-mobile ul li a[href^="#"], #my-menu > .mm-panel li a[target="_blank"], #navigation-mobile ul li a[target="_blank"], .portfolio-pagination-wrap.infinite-scroll-enabled ul li a').click(function(event){
		
			event.preventDefault();
			var linkLocation = this.href;

			$('#loader-container').css({display:'block'});
			$(".top-bar").animate({ height: 100 + '%' }, 950, 'easeInOutExpo').delay(950).queue(function(){ 
				$('.wrap_all').css({display:'none'});
				window.location = linkLocation; 
			});  

		});
	}
	else {
		$('header #logo, #my-menu > .mm-panel li a, #navigation-mobile ul li a, .blog-navigation div a, .post-type-navi ul li a, .portfolio-photo.normal-mode, .team-photo, .blog-photo, #blog.center-blog .blog-post-thumb-center > a, .portfolio-pagination-wrap ul li a, .error-caption a, .woocommerce-page ul.products li.product a').not('#my-menu > .mm-panel li a[href$="#"], #navigation-mobile ul li a[href$="#"], .woocommerce .product-wrap a.button, #my-menu > .mm-panel li a[target="_blank"], #navigation-mobile ul li a[target="_blank"], .portfolio-pagination-wrap.infinite-scroll-enabled ul li a').click(function(event){
		
			event.preventDefault();
			var linkLocation = this.href;

			$('#loader-container').css({display:'block'});
			$(".top-bar").animate({ height: 100 + '%' }, 950, 'easeInOutExpo').delay(950).queue(function(){ 
				$('.wrap_all').css({display:'none'});
				window.location = linkLocation; 
			});  

		});
	}
};

IBUKI.reloader = function(){
	window.onpageshow = function(event) {
		if (event.persisted) {
			window.location.reload(); 
		}
	};	
};

/* ==================================================
	Preloader IE 10 Fix
================================================== */

IBUKI.preloaderIE10 = function(){
	// Fix IE 10 Preloader
	if (Function('/*@cc_on return document.documentMode===10@*/')()){
	    document.documentElement.className+=' ie';
	}
	if($('html').hasClass('ie')){
		if($('html.ie').hasClass('preloader-enabled')){
			$('html').removeClass('preloader-enabled');
			$('html').addClass('no-preloader');
		}
	}
};

/* ==================================================
	Page Loader
================================================== */

IBUKI.pageLoader = function() {
	//IBUKI.preloaderIE10();
	
    var $elements = $('.wrap_all').find('img[src]');
    $('.wrap_all [style]').each(function(){
        var src = $(this).css('background-image').replace(/^url\(["']?/, '').replace(/["']?\)$/, '');
        if(src && src != 'none') {
            $elements = $elements.add($('<img src="' + src + '"/>'));
        }
    });

    var $site_init = false;
    var $loading = $('#loader-container');
    var $loadPercentageLine = $('#loader-percentage-line');
    var $loadPercentageText = $('#loader-percentage');
    var $loadSpinner = $('.loading-spinner');
    var elementsLoaded = 0;
    var speed = 1000;

    function animatePercentage(e) {
        $loadPercentageText.text(parseInt(e));
    }

    function loading() {
        var percentage = 0;
        if ($elements.length) {
            percentage = parseInt((elementsLoaded / $elements.length) * 100);
        }
        $loading.stop().animate({
            percentage:percentage
        }, {
            duration: speed,
            step: animatePercentage 
        });
    }

    function loadingFinish() {

    	setTimeout(function(){
			if(!$site_init){
				$site_init = true;

				var percentage = 100;
		        $loading.stop().animate({
		            percentage:percentage
		        }, {
		            duration: (speed / 2),
		            step: animatePercentage
		        })
		        .css({opacity: 1}).animate({
		            opacity: 1
		        }, function(){
		        	$('.wrap_all').css({opacity:1});
		        	$('.loading-spinner, #loader-percentage, #logo-content').velocity({opacity: 0}, 500, 'easeInOutExpo', function(){
		        		$(".top-bar").velocity({ height: 0 }, 950, 'easeInOutExpo', function(){ 
			        		$loading.css({display:'none'}); 
			        		$loadPercentageText.css({display:'none'});
			        		$loadSpinner.css({display:'none'});
			        		$('#logo-content').css({display:'none'});

			        		IBUKI.animationsModule();
			        		IBUKI.progressBar();
							IBUKI.circularGraph();
							IBUKI.countNumber();
			        	});
		        	});
		        });

			}
		}, 500);
    }

    /*
    if($elements.length) {
        loading();

        $elements.load(function(){
            $(this).off('load');
            elementsLoaded++;
            loading();
        }).each(function() {
		    if(this.complete) {
		        $(this).load();
		    }
		});
    }
	*/

	if($elements.length) {
        loading();
    } else {
    	loading();
    }

    $(window).load(function(){
    	loadingFinish();
    });
	
};

/* ==================================================
	Fixed Modal
================================================== */

IBUKI.activeModal = function(){
	$('.search-menu-nav, .social-menu-nav').on('click', function(){
		$(this).addClass('active-modal');
		$('html').addClass('modal-block-scroll');
	});

	$('#myModalSearch, #myModalSocial').on('hidden.bs.modal', function () {
	    $('.search-menu-nav, .social-menu-nav').removeClass('active-modal');
	    $('html').removeClass('modal-block-scroll');
	});

	// Autofocus
	$('#myModalSearch.modal').on('shown.bs.modal', function() {
		$(this).find('#search_modal').focus();
	});

	// Fix Modal Z-Index
	$('.container, .container-fluid').find('.modal').appendTo("body");
};

/* ==================================================
	WindowsPhone Fix
================================================== */

IBUKI.windowsPhoneFix = function(){
    if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
        var msViewportStyle = document.createElement('style')
        msViewportStyle.appendChild(
            document.createTextNode(
                '@-ms-viewport{width:auto!important}'
            )
        )
        document.querySelector('head').appendChild(msViewportStyle)
    }
};

/* ==================================================
	Revolution Slider Fix
================================================== */
IBUKI.revSliderFixed = function(){
	var headerH = $('header.header-menu').outerHeight();
	var windowWidth = $(window).width();
	var winH = window.innerHeight ? window.innerHeight:$(window).height();
	var num = 0;
	
	if( Modernizr.mq('(min-width: 320px) and (max-width: 1199px)') ) {
		if($('#main.header-fixed-enabled').length > 0 || $('#main.header-sticky-enabled').length > 0 || $('#main.header-left-button-enabled').length > 0 || $('#main.header-left-opened-enabled').length > 0 || $('#main.header-right-button-enabled').length > 0 || $('#main.header-right-opened-enabled').length > 0 ){
	    	num = headerH;
	    	$('.rev_slider_wrapper.fullscreen-container').css({'margin-top': -num + 'px'});	
	    } 		
	} else {
		if($('#main.header-left-button-enabled').length > 0 || $('#main.header-left-opened-enabled').length > 0 || $('#main.header-right-button-enabled').length > 0 || $('#main.header-right-opened-enabled').length > 0 ){
	    	num = 0;
	    	$('.rev_slider_wrapper.fullscreen-container').css({'margin-top': -num + 'px'});	
	    } 
		else if($('#main.header-sticky-enabled.header-transparent-enabled').length > 0 ){
			num = 0;
			$('.rev_slider_wrapper.fullscreen-container').css({'margin-top': -num + 'px'});
		}
		else if($('#main.header-fixed-enabled').length > 0 || $('#main.header-sticky-enabled').length > 0 ){
			num = headerH;
			$('.rev_slider_wrapper.fullscreen-container').css({'margin-top': -num + 'px'});
		} 
	}
};

/* ==================================================
	Masonry Blog
================================================== */
IBUKI.masonryBlog = function(){
	if($('.masonry-container').length > 0 ) {
		var $container = $('.masonry-container');

	    $container.imagesLoaded(function() {
	        $container.isotope({
	          	// options
	          	resizable: false,
				layoutMode: 'masonry',
				itemSelector : '.single-post-masonry',
	          	transitionDuration: 0
	        });
	    }).done( function( instance ) {
	    	$container.velocity({ opacity: 1 }, 850, 'easeInOutExpo' );
	  	}).fail( function() {
	  		$container.velocity({ opacity: 1 }, 850, 'easeInOutExpo' );
	  	});
	}
};

/* ==================================================
	One Page Nav
================================================== */
IBUKI.onePage = function(){
	if($('.one-page-enabled').length > 0 ) {
		var headerH = $('header.header-menu').outerHeight();
		var windowWidth = $(window).width();
		var num = 0;

		if( Modernizr.mq('(min-width: 320px) and (max-width: 1199px)') ) {
			num = 0;
		} else {
		    if($('.header-sticky').length > 0 ){
		    	num = 60;
		    } 
		    else if($('.header-fixed').length > 0 ){
		    	num = headerH;
		    } 
		}

		$('.woo-cart.cart-contents').addClass('external');
		
		$('.desktop-menu, .mobile-menu').singlePageNav({
			offset: num,
			currentClass: 'current-one-page',
			easing: 'easeInOutExpo',
			speed: 750,
			updateHash : false,
			filter : ':not(.external)'
		});
	}
};

/* ==================================================
	Vimeo/YouTube Video Embed Background
================================================== */
IBUKI.backgroundVideoEmebed = function(){
	$(".video-section-container .video-embed-wrap").each(function (b) {
		var min_w = 1500;
		var header_height = 0;
		var vid_w_orig = 1280;
		var vid_h_orig = 720;
		var num = 0;
	    
	    var f = $(this).closest(".video-section-container").outerWidth();
	    var e = $(this).closest(".video-section-container").outerHeight();
	    $(this).width(f);
	    $(this).height(e);
	    var a = f / vid_w_orig;
	    var d = (e - header_height) / vid_h_orig;
	    var c = a > d ? a : d;
	    min_w = 1280 / 720 * (e + 20);
	    if (c * vid_w_orig < min_w) {
	        c = min_w / vid_w_orig
	    }

	    if( Modernizr.mq('(min-width: 320px) and (max-width: 1199px)') ) {
	    	$(this).find("iframe").width(Math.ceil(c * vid_w_orig + 0));
	    	$(this).find("iframe").height(Math.ceil(c * vid_h_orig + 0));
	    } else {
	    	num = -(f+2)/2;
	    	$(this).css({ 'margin-left' : num+'px' });

	    	$(this).find("iframe").width(Math.ceil(c * vid_w_orig + 2));
	    	$(this).find("iframe").height(Math.ceil(c * vid_h_orig + 200));
	    }
	    
	    $(this).scrollLeft(($(this).find("iframe").width() - f) / 2);
	    $(this).find(".video-embed-wrap").scrollTop(($(this).find("iframe").height() - (e)) / 2);
	    $(this).scrollTop(($(this).find("iframe").height() - (e)) / 2);
	});
};

/* ==================================================
	Disable Right Click
================================================== */

IBUKI.disableRightClick = function(){
	if($('.right-click-block-enabled').length > 0 ){
		$('html').bind('contextmenu', function(e) {
		    return false;
		});
	}
};

/* ==================================================
	Columns Equals Height
================================================== */

IBUKI.setEqualsColumnsHeight = function(){
	if( $('.equals-col-height').length > 0 ) {
        $('.equals-col-height').height('auto');
        var maxHeight = Math.max.apply(Math, $('.equals-col-height').map (
            function() {
                return $(this).height();
            }
        ));
        $('.equals-col-height').height(maxHeight);
    }
};

/* ==================================================
	Init
================================================== */

$(window).load(function(){
	if($('.preloader-enabled').length > 0 ){
		IBUKI.leavePage();
	}

	IBUKI.setEqualsColumnsHeight();
});

$(document).ready(function(){

	// Fancybox Bug when exist Portfolio Scrollable
	if($('#portfolio-items.scrollable-portfolio').length > 0 ) {
		$('body, html').addClass('scrollable-portfolio-enabled');
	} else {
		$('body, html').addClass('no-scrollable-portfolio-enabled');
	}

	if($('.preloader-enabled').length > 0 ){
		IBUKI.reloader();
		IBUKI.pageLoader();
	} else {
		IBUKI.animationsModule();
		IBUKI.progressBar();
		IBUKI.circularGraph();
		IBUKI.countNumber();
	}

	IBUKI.windowsPhoneFix();
	IBUKI.listenerMenu();
	IBUKI.listenerMenuMobile();
	IBUKI.fullPageHeight();
	IBUKI.normalToFull();
	IBUKI.mediaElements();
	IBUKI.resizeMediaElements();
	IBUKI.backgroundVideoEmebed();
	IBUKI.responsiveVideo();
	IBUKI.accordion();
	IBUKI.toggle();
	IBUKI.tabs();
	IBUKI.customSelect();
	IBUKI.naviNone();
	IBUKI.googleMaps();
	IBUKI.fancyBox();
	IBUKI.scrollBtnFullArea();
	IBUKI.scrollBtnHeaderPage();
	IBUKI.socialShare();
	IBUKI.toolTip();
	IBUKI.testimonial();
	IBUKI.bigTweetSlide();
	IBUKI.scrollToTop();
	IBUKI.buttonHover();
	IBUKI.carousel();
	IBUKI.portfolio();
	IBUKI.infiniteScrollPortfolio();
	IBUKI.stripedPortfolio();
	IBUKI.scrollablePortfolio();
	IBUKI.masonryBlog();
	IBUKI.activeModal();
	IBUKI.mobileNavEvents();
	IBUKI.revSliderFixed();
	IBUKI.onePage();
	IBUKI.disableRightClick();

	// Chrome Fix Back Button
	$('iframe[src]').each(function(){
		$(this).attr('src',$(this).attr('src'));
	});
});

$(window).resize(function(){
	IBUKI.mobileNavEvents();
	IBUKI.fullPageHeight();
	IBUKI.resizeMediaElements();
	IBUKI.backgroundVideoEmebed();
	IBUKI.normalToFull();
	IBUKI.revSliderFixed();
	IBUKI.onePage();
	IBUKI.stripedPortfolio();
	IBUKI.scrollablePortfolio();
	IBUKI.setEqualsColumnsHeight();

	// Resize Video Background
	$(".video-section-container .video-wrap").each(function (b) {
		var min_w = 1500;
		var header_height = 0;
		var vid_w_orig = 1280;
		var vid_h_orig = 720;
	    
	    var f = $(this).closest(".video-section-container").outerWidth();
	    var e = $(this).closest(".video-section-container").outerHeight();
	    $(this).width(f);
	    $(this).height(e);
	    var a = f / vid_w_orig;
	    var d = (e - header_height) / vid_h_orig;
	    var c = a > d ? a : d;
	    min_w = 1280 / 720 * (e + 20);
	    if (c * vid_w_orig < min_w) {
	        c = min_w / vid_w_orig
	    }
	    $(this).find("video, .mejs-overlay, .mejs-poster").width(Math.ceil(c * vid_w_orig + 2));
	    $(this).find("video, .mejs-overlay, .mejs-poster").height(Math.ceil(c * vid_h_orig + 2));
	    $(this).scrollLeft(($(this).find("video").width() - f) / 2);
	    $(this).find(".mejs-overlay, .mejs-poster").scrollTop(($(this).find("video").height() - (e)) / 2);
	    $(this).scrollTop(($(this).find("video").height() - (e)) / 2);
	});
});

});