/*-----------------------------------------------------------------------------------*/
/*  WordPress
/*-----------------------------------------------------------------------------------*/
jQuery(document).ready(function() { 
	
	/**
	 * Mega Menu Stuff
	 */
	jQuery('nav .wpb_column').unwrap().parent().removeClass('subnav').addClass('mega-menu');
	jQuery('.mega-menu h4').each(function(){
		var $text = jQuery(this).text();
		jQuery(this).next().find('ul').prepend('<li><span class="title">'+ $text +'</span></li>')
		jQuery(this).remove();
	});
	jQuery('.mega-menu ul').removeClass('menu').unwrap().unwrap().unwrap().wrap('<li />');
	jQuery('.mega-menu > div > li').unwrap();
	
	/**
	 * Forms
	 */
	jQuery('.custom-forms .wpcf7-checkbox .wpcf7-list-item, .custom-forms .gfield_checkbox > li').addClass('checkbox-option').prepend('<div class="inner" />');
	jQuery('.custom-forms .wpcf7-radio .wpcf7-list-item, .custom-forms .gfield_radio > li').addClass('radio-option').prepend('<div class="inner" />');
	
	/**
	 * Single post stuff
	 */
	jQuery('.feed-item .more-link').parent('p').remove();
	
	/**
	 * Select items
	 */
	jQuery('select').wrap('<div class="select-option" />').parent().prepend('<i class="ti-angle-down"></i>');
	
	jQuery('.blog-carousel').owlCarousel({
		nav: false,
		dots: false,
		loop: true,
		responsive:{
	        0:{
	            items:1
	        },
	        700:{
	            items:2
	        },
	        1100:{
	            items:3
	        },
	        1600:{
	            items:4
	        }
	    }
	});
	
	jQuery('a[rel*="attachment"]').attr('data-lightbox', 'true');
	
});
/*-----------------------------------------------------------------------------------*/
/*	Document Ready Stuff
/*-----------------------------------------------------------------------------------*/
var mr_firstSectionHeight,
    mr_nav,
    mr_navOuterHeight,
    mr_navScrolled = false,
    mr_navFixed = false,
    mr_outOfSight = false,
    mr_floatingProjectSections,
    mr_scrollTop = 0;

jQuery(document).ready(function() { 
    "use strict";
    
    //Cache Selectors
    var $window = jQuery(window);
    var mobileNavHeight = jQuery('nav.fixed').outerHeight();

    // Smooth scroll to inner links
    if (jQuery(window).width() > 991) {
	    jQuery('nav a[href^="#"]:not(a[href="#"]), .back-to-top, a.btn[href^="#"], .hero-header a[href^="#"]').smoothScroll({
	        offset: -55,
	        speed: 800
	    });
	} else {
		jQuery('nav a[href^="#"]:not(a[href="#"]), .back-to-top, a.btn[href^="#"], .hero-header a[href^="#"]').smoothScroll({
	        offset: -mobileNavHeight,
	        speed: 800
	    });
	}
    
    //WooCommerce VC Element Fixes
    jQuery('.woocommerce.columns-2 .col-sm-4').addClass('col-sm-6').removeClass('col-sm-4');
    jQuery('.woocommerce.columns-2 .col-md-4').addClass('col-md-6').removeClass('col-md-4');
    jQuery('.woocommerce.columns-4 .col-sm-4').addClass('col-sm-3').removeClass('col-sm-4');
    jQuery('.woocommerce.columns-4 .col-md-4').addClass('col-md-3').removeClass('col-md-4');

    // Update scroll variable for scrolling functions
    addEventListener('scroll', function() {
        mr_scrollTop = window.pageYOffset;
    }, false);

    // Append .background-image-holder <img>'s as CSS backgrounds
    jQuery('.background-image-holder').each(function() {
        var imgSrc = jQuery(this).children('img').attr('src');
        jQuery(this).css('background-image', 'url("' + imgSrc + '")');
        jQuery(this).children('img').hide();
        jQuery(this).css('background-position', 'initial');
    });

    // Fade in background images
    setTimeout(function() {
        jQuery('.background-image-holder').each(function() {
            jQuery(this).addClass('fadeIn');
        });
    }, 200);

    // Initialize Tooltips
    jQuery('[data-toggle="tooltip"]').tooltip();
    
    // Icon bulleted lists
	jQuery('ul[data-bullet]').each(function(){
	   var bullet = jQuery(this).attr('data-bullet');
	   jQuery(this).find('li').prepend('<i class="'+bullet+'"></i>');
	});

    // Checkboxes
    jQuery('body').on('click', '.checkbox-option', function(){
        jQuery(this).toggleClass('checked');
		var checkbox = jQuery(this).find('input');
		if (checkbox.prop('checked') === false) {
		    checkbox.prop('checked', true);
		} else {
		    checkbox.prop('checked', false);
		}
    });

    // Radio Buttons
    jQuery('body').on('click', '.radio-option', function(){
		var checked = jQuery(this).hasClass('checked'); // Get the current status of the radio
		
		var name = jQuery(this).find('input').attr('name'); // Get the name of the input clicked
		
		if (!checked) {
		
		    jQuery('input[name="' + name + '"]').parent().removeClass('checked');
		
		    jQuery(this).addClass('checked');
		
		    jQuery(this).find('input').prop('checked', true);
		
		}
    });

    // Accordions
    jQuery('.accordion').not('.team-member .accordion').each(function(){
    	jQuery('li', this).eq(0).addClass('active');
    });
    
    jQuery('.accordion li').click(function() {
        if (jQuery(this).closest('.accordion').hasClass('one-open')) {
            jQuery(this).closest('.accordion').find('li').removeClass('active');
            jQuery(this).addClass('active');
        } else {
            jQuery(this).toggleClass('active');
        }
		if(typeof window.mr_parallax !== "undefined"){
		    setTimeout(mr_parallax.windowLoad, 500);
		}
    });

    // Tabbed Content
    jQuery('.tabbed-content').each(function() {
    	jQuery('li', this).eq(0).addClass('active');
        jQuery(this).append('<ul class="content"></ul>');
    });

    jQuery('.tabs li').each(function() {
        var originalTab = jQuery(this),
            activeClass = "";
        if (originalTab.is('.tabs > li:first-child')) {
            activeClass = ' class="active"';
        }
        var tabContent = originalTab.find('.tab-content').detach().wrap('<li' + activeClass + '></li>').parent();
        originalTab.closest('.tabbed-content').find('.content').append(tabContent);
    });

    jQuery('.tabs li').click(function() {
        jQuery(this).closest('.tabs').find('li').removeClass('active');
        jQuery(this).addClass('active');
        var liIndex = jQuery(this).index() + 1;
        jQuery(this).closest('.tabbed-content').find('.content>li').removeClass('active');
        jQuery(this).closest('.tabbed-content').find('.content>li:nth-of-type(' + liIndex + ')').addClass('active');
    });

    // Progress Bars
    jQuery('.progress-bar').each(function() {
        jQuery(this).css('width', jQuery(this).attr('data-progress') + '%');
    });
    
    if( jQuery('body').hasClass('perm-fixed-nav') ){
    	jQuery('nav').addClass('absolute');
    }

    // Navigation
    if (!jQuery('nav').hasClass('fixed') && !jQuery('nav').hasClass('absolute')) {

        // Make nav container height of nav
        jQuery('.nav-container').css('min-height', jQuery('nav').outerHeight(true));

        jQuery(window).resize(function() {
            jQuery('.nav-container').css('min-height', jQuery('nav').outerHeight(true));
        });

        // Compensate the height of parallax element for inline nav
        if (jQuery(window).width() > 768) {
            jQuery('.parallax:nth-of-type(1) .background-image-holder').css('top', -(jQuery('nav').outerHeight(true)));
        }

        // Adjust fullscreen elements
        if (jQuery(window).width() > 768) {
            jQuery('section.fullscreen:nth-of-type(1)').css('height', (jQuery(window).height() - jQuery('nav').outerHeight(true)));
        }

    } else {
        jQuery('body').addClass('nav-is-overlay');
        
        // Compensate the height of parallax element for inline nav
        if (jQuery(window).width() > 768) {
        	if(jQuery('body').hasClass('admin-bar')){
            	jQuery('.parallax:nth-of-type(1) .background-image-holder').css('top', -32);
        	} else {
        		jQuery('.parallax:nth-of-type(1) .background-image-holder').css('top', 0);	
        	}
        }
    }

    if (jQuery('nav').hasClass('bg-dark')) {
        jQuery('.nav-container').addClass('bg-dark');
    }
	
	jQuery('.perm-fixed-nav').css('padding-top', jQuery('.nav-container nav').outerHeight());

    // Fix nav to top while scrolling
    mr_nav = jQuery('body .nav-container nav:first');
    mr_navOuterHeight = jQuery('body .nav-container nav:first').outerHeight();
    window.addEventListener("scroll", updateNav, false);

    // Menu dropdown positioning
    jQuery('.menu > li > ul').each(function() {
        var menu = jQuery(this).offset();
        var farRight = menu.left + jQuery(this).outerWidth(true);
        if (farRight > jQuery(window).width() && !jQuery(this).hasClass('mega-menu')) {
            jQuery(this).addClass('make-right');
        } else if (farRight > jQuery(window).width() && jQuery(this).hasClass('mega-menu')) {
            var isOnScreen = jQuery(window).width() - menu.left;
            var difference = jQuery(this).outerWidth(true) - isOnScreen;
            jQuery(this).css('margin-left', -(difference));
        }
    });

    // Mobile Menu
    jQuery('.mobile-toggle').click(function() {
        jQuery('.nav-bar').toggleClass('nav-open');
        jQuery(this).toggleClass('active');
    });

    jQuery('.menu li').click(function(e) {
        if (!e) e = window.event;
        e.stopPropagation();
        if (jQuery(this).find('ul').length) {
            jQuery(this).toggleClass('toggle-sub');
        } else {
            jQuery(this).parents('.toggle-sub').removeClass('toggle-sub');
        }
    });
	
	jQuery('.menu li a[href^="#"]:not(a[href="#"])').click(function() {
		jQuery(this).closest('.nav-bar').removeClass('nav-open');
	});
	
    jQuery('.module.widget-handle').click(function() {
        jQuery(this).toggleClass('toggle-widget-handle');
    });
    
    jQuery('.search-widget-handle .search-form input').click(function(e){
        if (!e) e = window.event;
        e.stopPropagation();
    });
    
    // Offscreen Nav
	if(jQuery('.offscreen-toggle').length){
		jQuery('body').addClass('has-offscreen-nav');
	} else{
        jQuery('body').removeClass('has-offscreen-nav');
    }
	
	jQuery('.offscreen-toggle').click(function(){
		jQuery('.main-container').toggleClass('reveal-nav');
		jQuery('nav').toggleClass('reveal-nav');
		jQuery('.offscreen-container').toggleClass('reveal-nav');
	});
	
	jQuery('.main-container').click(function(){
		if(jQuery(this).hasClass('reveal-nav')){
			jQuery(this).removeClass('reveal-nav');
			jQuery('.offscreen-container').removeClass('reveal-nav');
			jQuery('nav').removeClass('reveal-nav');
		}
	});
	
	jQuery('.offscreen-container a').click(function(){
		jQuery('.offscreen-container').removeClass('reveal-nav');
		jQuery('.main-container').removeClass('reveal-nav');
		jQuery('nav').removeClass('reveal-nav');
	});
	
	if( false == wp_data.all_title || 'undefined' == wp_data.all_title || '' == wp_data.all_title ){
		wp_data.all_title = 'All';	
	}

    // Populate filters
    jQuery('.projects').each(function() {

        var filters = "";

        jQuery(this).find('.project').each(function() {

            var filterTags = jQuery(this).attr('data-filter').split(',');

            filterTags.forEach(function(tagName) {
                if (filters.indexOf(tagName) == -1) {
                    filters += '<li data-filter="' + tagName + '">' + capitaliseFirstLetter(tagName) + '</li>';
                }
            });
            
            jQuery(this).closest('.projects').find('ul.filters').empty().append('<li data-filter="all" class="active">' + wp_data.all_title + '</li>').append(filters);
            
        });
        
    });

    jQuery('.filters li').click(function() {
        var filter = jQuery(this).attr('data-filter');
        jQuery(this).closest('.filters').find('li').removeClass('active');
        jQuery(this).addClass('active');

        jQuery(this).closest('.projects').find('.project').each(function() {
            var filters = jQuery(this).data('filter');

            if (filters.indexOf(filter) == -1) {
                jQuery(this).addClass('inactive');
            } else {
                jQuery(this).removeClass('inactive');
            }
        });

        if (filter == 'all') {
            jQuery(this).closest('.projects').find('.project').removeClass('inactive');
        }
    });

    // Twitter Feed
    jQuery('.tweets-feed').each(function(index) {
        jQuery(this).attr('id', 'tweets-' + index);
    }).each(function(index) {
    	
    	if(!( '' == jQuery('#tweets-' + index).attr('data-user-name') || undefined == jQuery('#tweets-' + index).attr('data-user-name') )){
    		
    		var TweetConfig = {
    			"profile": {"screenName": jQuery('#tweets-' + index).attr('data-user-name')},
    			"domId": '',
    			"maxTweets": jQuery('#tweets-' + index).attr('data-amount'),
    			"enableLinks": true,
    			"showUser": true,
    			"showTime": true,
    			"dateFunction": '',
    			"showRetweet": false,
    			"customCallback": handleTweets
    		};
    		
    	} else {
    	
	    	var TweetConfig = {
	    		"id": jQuery('#tweets-' + index).attr('data-widget-id'),
	    		"domId": '',
	    		"maxTweets": jQuery('#tweets-' + index).attr('data-amount'),
	    		"enableLinks": true,
	    		"showUser": true,
	    		"showTime": true,
	    		"dateFunction": '',
	    		"showRetweet": false,
	    		"customCallback": handleTweets
	    	};
    	
    	}

        function handleTweets(tweets) {
            var x = tweets.length;
            var n = 0;
            var element = document.getElementById('tweets-' + index);
            var html = '<ul class="slides">';
            while (n < x) {
                html += '<li>' + tweets[n] + '</li>';
                n++;
            }
            html += '</ul>';
            element.innerHTML = html;
            return html;
        }

        twitterFetcher.fetch(TweetConfig);

    });

    // Instagram Feed
    if( jQuery('.instafeed').length && wp_data.access_token && wp_data.client_id ){
    	jQuery.fn.spectragram.accessData = {
			accessToken: wp_data.access_token,
			clientID: wp_data.client_id
		};	
		
		jQuery('.instafeed').each(function() {
			var method = ( jQuery(this).attr('data-method') ) ? jQuery(this).attr('data-method') : 'getUserFeed';
		    jQuery(this).children('ul').spectragram( method, {
		        query: jQuery(this).attr('data-user-name'),
		        max: jQuery(this).attr('data-max')
		    });
		});
    }   
    
    // Flickr Feeds
	if(jQuery('.flickr-feed').length){
	   jQuery('.flickr-feed').each(function(){
	   	
	   		var flickrThis = jQuery(this),
	   			userID = flickrThis.attr('data-user-id'),
	   			albumID = flickrThis.attr('data-album-id');
	   			
	       flickrThis.flickrPhotoStream({ id: userID, setId: albumID, container: '<li class="masonry-item" />' }).done(function(){
	       		jQuery(window).load(function(){
	       			flickrThis.masonry();
	       		});
	       });  
	         
	   });
	}
	
	var foundryAutoplay = ( wp_data.hero_autoplay == 'false' ) ? false : true;

    // Image Sliders
	jQuery('.slider-all-controls').flexslider({
	    start: function(slider){
	        if(slider.find('.slides li:first-child').find('.fs-vid-background video').length){
	          slider.find('.slides li:first-child').find('.fs-vid-background video').get(0).play(); 
	        }
	    },
	    after: function(slider){
	        if(slider.find('.fs-vid-background video').length){
	           if(slider.find('li:not(.flex-active-slide)').find('.fs-vid-background video').length){
	                slider.find('li:not(.flex-active-slide)').find('.fs-vid-background video').get(0).pause();
	            }
	            if(slider.find('.flex-active-slide').find('.fs-vid-background video').length){
	                slider.find('.flex-active-slide').find('.fs-vid-background video').get(0).play();
	            }
	        }
	    },
	    animation: wp_data.hero_animation,
	    slideshow: foundryAutoplay,
	    slideshowSpeed: wp_data.hero_timer
	});
    jQuery('.slider-paging-controls').flexslider({
        animation: "slide",
        directionNav: false
    });
    jQuery('.slider-arrow-controls').flexslider({
        controlNav: false
    });
    jQuery('.slider-thumb-controls .slides li').each(function() {
        var imgSrc = jQuery(this).find('img').attr('src');
        jQuery(this).attr('data-thumb', imgSrc);
    });
    jQuery('.slider-thumb-controls').flexslider({
        animation: "slide",
        controlNav: "thumbnails",
        directionNav: true
    });
    
    if( jQuery(window).width() < 491 ){
    	jQuery('.logo-carousel').flexslider({
    	    minItems: 1,
    	    maxItems: 1,
    	    move: 1,
    	    itemWidth: 200,
    	    itemMargin: 0,
    	    animation: "slide",
    	    slideshow: true,
    	    slideshowSpeed: 3000,
    	    directionNav: false,
    	    controlNav: false
    	});
    } else {
	    jQuery('.logo-carousel').flexslider({
	        minItems: 1,
	        maxItems: 4,
	        move: 1,
	        itemWidth: 200,
	        itemMargin: 0,
	        animation: "slide",
	        slideshow: true,
	        slideshowSpeed: 3000,
	        directionNav: false,
	        controlNav: false
	    });
    }
    
    // Lightbox gallery titles
    jQuery('.lightbox-grid li a').each(function(){
    	var galleryTitle = jQuery(this).closest('.lightbox-grid').attr('data-gallery-title');
    	jQuery(this).attr('data-lightbox', galleryTitle);
    });
    
	// Multipurpose Modals
	if(jQuery('.foundry_modal').length){
		var modalScreen = jQuery('<div class="modal-screen">').appendTo('body');
	}
	
	jQuery(document).on('wheel mousewheel scroll', '.foundry_modal, .modal-screen', function(evt){
		jQuery(this).get(0).scrollTop += (evt.originalEvent.deltaY); 
		return false;
	});
	
	jQuery('.modal-container').each(function(index) {
	  if(jQuery(this).find('iframe[src]').length){
	  	jQuery(this).find('.foundry_modal').addClass('iframe-modal');
	  	jQuery('iframe', this).appendTo('.iframe-modal');
	  	jQuery('.iframe-modal > div', this).remove();
	  	jQuery(this).find('.foundry_modal').clone().appendTo('body');
	  }
	});
	
	jQuery('.btn-modal').click(function(){
		var linkedModal = jQuery('section').closest('body').find('.foundry_modal[modal-link="' + jQuery(this).attr('modal-link') + '"]');
	  jQuery('.modal-screen').toggleClass('reveal-modal');
	  if(linkedModal.find('iframe').length){
      	linkedModal.find('iframe').attr('src', linkedModal.find('iframe').attr('data-src'));
      }
	  linkedModal.toggleClass('reveal-modal');
	  return false;
	});
	
	// Autoshow modals
	jQuery('.foundry_modal[modal-link][data-time-delay]').each(function(){
		var modal = jQuery(this);
		var delay = modal.attr('data-time-delay');
		modal.prepend(jQuery('<i class="ti-close close-modal">'));
		if(typeof modal.attr('data-cookie') != "undefined"){
	  	if(!mr_cookies.hasItem(modal.attr('data-cookie'))){
	          setTimeout(function(){
	  			modal.addClass('reveal-modal');
	  			jQuery('.modal-screen').addClass('reveal-modal');
	  		},delay);
	      }
	  }else{
	      setTimeout(function(){
	      	  jQuery('.foundry_modal').removeClass('reveal-modal');
	      	  jQuery('.modal-screen').removeClass('reveal-modal');
	          modal.addClass('reveal-modal');
	          jQuery('.modal-screen').addClass('reveal-modal');
	      }, delay);
	  }
	});
	
	jQuery('.close-modal:not(.modal-strip .close-modal)').click(function(){
		var modal = jQuery(this).closest('.foundry_modal');
		modal.toggleClass('reveal-modal');
		if(typeof modal.attr('data-cookie') != "undefined"){
			mr_cookies.setItem(modal.attr('data-cookie'), "true", Infinity);
		}
		jQuery('.modal-screen').toggleClass('reveal-modal');
		modal.find('iframe').attr('data-src', modal.find('iframe').attr('src'));
		modal.find('iframe').attr('src', '');
	});
	
	jQuery('.modal-screen').click(function(){
		jQuery('.foundry_modal.reveal-modal').toggleClass('reveal-modal');
		jQuery(this).toggleClass('reveal-modal');
	});
	
	jQuery(document).keyup(function(e) {
		 if (e.keyCode == 27) { // escape key maps to keycode `27`
			jQuery('.foundry_modal').removeClass('reveal-modal');
			jQuery('.modal-screen').removeClass('reveal-modal');
		}
	});
	
	// Modal Strips
	jQuery('.modal-strip').each(function(){
		if(!jQuery(this).find('.close-modal').length){
			jQuery(this).append(jQuery('<i class="ti-close close-modal">'));
		}
		var modal = jQuery(this);
	
	  if(typeof modal.attr('data-cookie') != "undefined"){
	     
	      if(!mr_cookies.hasItem(modal.attr('data-cookie'))){
	      	setTimeout(function(){
	      		modal.addClass('reveal-modal');
	      	},1000);
	      }
	  }else{
	      setTimeout(function(){
	              modal.addClass('reveal-modal');
	      },1000);
	  }
	});
	
	jQuery('.modal-strip .close-modal').click(function(){
	  var modal = jQuery(this).closest('.modal-strip');
	  if(typeof modal.attr('data-cookie') != "undefined"){
	      mr_cookies.setItem(modal.attr('data-cookie'), "true", Infinity);
	  }
		jQuery(this).closest('.modal-strip').removeClass('reveal-modal');
		return false;
	});


    // Video Modals
    jQuery('section').closest('body').find('.modal-video[video-link]').remove();

    jQuery('.modal-video-container').each(function(index) {
        jQuery(this).find('.play-button').attr('video-link', index);
        jQuery(this).find('.modal-video').clone().appendTo('body').attr('video-link', index);
    });

    jQuery('.modal-video-container .play-button').click(function() {
        var linkedVideo = jQuery('section').closest('body').find('.modal-video[video-link="' + jQuery(this).attr('video-link') + '"]'),
        	iFrame = linkedVideo.find('iframe');
        	
        iFrame.attr('src', iFrame.prev('.src-holder').attr('data-src'));
        	
        linkedVideo.toggleClass('reveal-modal');

        if (linkedVideo.find('video').length) {
            linkedVideo.find('video').get(0).play();
        }
    });

    jQuery('section').closest('body').find('.modal-video').click(function() {
        jQuery(this).closest('.modal-video').toggleClass('reveal-modal');
        
        var $iframe = jQuery('iframe', this),
        	$src = $iframe.attr('src');
        	
        $iframe.before('<div class="src-holder" data-src="'+ $src +'" />');
        $iframe.attr('src','');
        
        if(jQuery(this).siblings('video').length){
        	jQuery(this).siblings('video').get(0).pause();
        }
    });

    // Local Videos
    jQuery('section').closest('body').find('.local-video-container .play-button').click(function() {
        jQuery(this).siblings('.background-image-holder').removeClass('fadeIn');
        jQuery(this).siblings('.background-image-holder').css('z-index', -1);
        jQuery(this).css('opacity', 0);
        jQuery(this).siblings('video').get(0).play();
    });

    // Youtube Videos
	jQuery('section').closest('body').find('.player').each(function() {
	    var section = jQuery(this).closest('section');
	    section.find('.container').addClass('fadeOut');
	    var src = jQuery(this).attr('data-video-id');
	    var startat = jQuery(this).attr('data-start-at');
	    jQuery(this).attr('data-property', "{videoURL:'http://youtu.be/" + src + "',containment:'self',autoPlay:true, mute:true, startAt:" + startat + ", opacity:1, showControls:false}");
	});
	
	if(jQuery('.player').length){
	    jQuery('.player').each(function(){
	
	        var section = jQuery(this).closest('section');
	        var player = section.find('.player');
	        player.YTPlayer();
	        player.on("YTPStart",function(e){
	            section.find('.container').removeClass('fadeOut');
	            section.find('.masonry-loader').addClass('fadeOut');
	        });
	
	    });
	}

    // Interact with Map once the user has clicked (to prevent scrolling the page = zooming the map
    jQuery('.map-holder').click(function() {
        jQuery(this).addClass('interact');
    });
	
	if(jQuery('.map-holder').length){
	    $window.scroll(function() {
	        if (jQuery('.map-holder.interact').length) {
	            jQuery('.map-holder.interact').removeClass('interact');
	        }
	    });
	}

    // Countdown Timers
    if (jQuery('.countdown').length) {
        jQuery('.countdown').each(function() {
            var date = jQuery(this).attr('data-date');
            jQuery(this).countdown(date, function(event) {
                jQuery(this).text(
                    event.strftime('%D days %H:%M:%S')
                );
            });
        });
    }

    // Disable parallax on mobile
    if ((/Android|iPhone|iPad|iPod|BlackBerry|Windows Phone/i).test(navigator.userAgent || navigator.vendor || window.opera)) {
        jQuery('section').removeClass('parallax');
        jQuery('.vid-bg .player, .vid-bg .masonry-loader').css('display', 'none');
        jQuery('.vid-bg .background-image-holder').css('display', 'block');
    }
    
    if(jQuery('.counter').length){
    	jQuery('.counter').counterUp();
    }
    
    $window.trigger('resize');

    // BACK TO TOP
    jQuery("a[href='#top']").click(function(e) {
        e.preventDefault();
        jQuery("html, body").animate({ scrollTop: 0 }, "slow");
        return false;
    });

}); 
/*-----------------------------------------------------------------------------------*/
/*	Window Load Stuff
/*-----------------------------------------------------------------------------------*/
jQuery(window).load(function() { 
    "use strict";
    
    var $window = jQuery(window);

    // Initialize Masonry
    if (jQuery('.masonry').length) {
        var container = document.querySelector('.masonry');
        var msnry = new Masonry(container, {
            itemSelector: '.masonry-item'
        });

        msnry.on('layoutComplete', function() {

            mr_firstSectionHeight = jQuery('.main-container section:nth-of-type(1)').outerHeight(true);
            if( 0 == jQuery('section').length || 1 == jQuery('section').length ){
            	mr_firstSectionHeight = 300;	
            }

            // Fix floating project filters to bottom of projects container
            if (jQuery('.filters.floating').length) {
                setupFloatingProjectFilters();
                updateFloatingFilters();
                window.addEventListener("scroll", updateFloatingFilters, false);
            }

            jQuery('.masonry').addClass('fadeIn');
            jQuery('.masonry-loader').addClass('fadeOut');
            if (jQuery('.masonryFlyIn').length) {
                masonryFlyIn();
            }
        });

        msnry.layout();
    }

    // Initialize twitter feed
    var setUpTweets = setInterval(function() {
        if (jQuery('.tweets-slider').find('li.flex-active-slide').length) {
            clearInterval(setUpTweets);
            return;
        } else {
            if (jQuery('.tweets-slider').length) {
                jQuery('.tweets-slider').flexslider({
                    directionNav: false,
                    controlNav: false
                });
            }
        }
    }, 500);

    mr_firstSectionHeight = jQuery('.main-container section:nth-of-type(1)').outerHeight(true);
    if( 0 == jQuery('section').length || 1 == jQuery('section').length ){
    	mr_firstSectionHeight = 300;	
    }
	
	$window.trigger('resize');
	
	setTimeout(function(){
		$window.trigger('resize');
	}, 2500);
	
	jQuery('.perm-fixed-nav').css('padding-top', jQuery('.nav-container nav').outerHeight());
	
    if(typeof window.mr_parallax !== "undefined"){
        setTimeout(mr_parallax.windowLoad, 500);
    }

    jQuery('.clone a').attr('data-lightbox', 'false');

}); 
/*-----------------------------------------------------------------------------------*/
/*	Custom Functions
/*-----------------------------------------------------------------------------------*/
function updateNav() {

    var scrollY = mr_scrollTop;

    if (scrollY <= 0) {
        if (mr_navFixed) {
            mr_navFixed = false;
            mr_nav.removeClass('fixed');
        }
        if (mr_outOfSight) {
            mr_outOfSight = false;
            mr_nav.removeClass('outOfSight');
        }
        if (mr_navScrolled) {
            mr_navScrolled = false;
            mr_nav.removeClass('scrolled');
        }
        return;
    }

    if (scrollY > mr_firstSectionHeight) {
        if (!mr_navScrolled) {
            mr_nav.addClass('scrolled');
            mr_navScrolled = true;
            return;
        }
    } else {
        if (scrollY > mr_navOuterHeight) {
            if (!mr_navFixed) {
                mr_nav.addClass('fixed');
                mr_navFixed = true;
            }

            if (scrollY > mr_navOuterHeight * 2) {
                if (!mr_outOfSight) {
                    mr_nav.addClass('outOfSight');
                    mr_outOfSight = true;
                }
            } else {
                if (mr_outOfSight) {
                    mr_outOfSight = false;
                    mr_nav.removeClass('outOfSight');
                }
            }
        } else {
            if (mr_navFixed) {
                mr_navFixed = false;
                mr_nav.removeClass('fixed');
            }
            if (mr_outOfSight) {
                mr_outOfSight = false;
                mr_nav.removeClass('outOfSight');
            }
        }

        if (mr_navScrolled) {
            mr_navScrolled = false;
            mr_nav.removeClass('scrolled');
        }

    }
}
function capitaliseFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}
function masonryFlyIn() {
    var $items = jQuery('.masonryFlyIn .masonry-item');
    var time = 0;

    $items.each(function() {
        var item = jQuery(this);
        setTimeout(function() {
            item.addClass('fadeIn');
        }, time);
        time += 170;
    });
}
function setupFloatingProjectFilters() {
    mr_floatingProjectSections = [];
    jQuery('.filters.floating').closest('section').each(function() {
        var section = jQuery(this);

        mr_floatingProjectSections.push({
            section: section.get(0),
            outerHeight: section.outerHeight(),
            elemTop: section.offset().top,
            elemBottom: section.offset().top + section.outerHeight(),
            filters: section.find('.filters.floating'),
            filersHeight: section.find('.filters.floating').outerHeight(true)
        });
    });
}
function updateFloatingFilters() {
    var l = mr_floatingProjectSections.length,
    navHeight = wp_data.nav_height - 7;
    
    if( jQuery('body').hasClass('admin-bar') ){
    	navHeight = navHeight + 32;	
    }
    
    while (l--) {
        var section = mr_floatingProjectSections[l];

        if ((section.elemTop < mr_scrollTop) && typeof window.mr_variant == "undefined" ) {
            section.filters.css({
                position: 'fixed',
                top: '16px',
                bottom: 'auto'
            });
            if (mr_navScrolled) {
                section.filters.css({
                    transform: 'translate3d(0,'+ navHeight +'px,0)'
                });
            }
            if (mr_scrollTop > (section.elemBottom - 70)) {
                section.filters.css({
                    position: 'absolute',
                    bottom: '16px',
                    top: 'auto'
                });
                section.filters.css({
                    transform: 'translate3d(0,0,0)'
                });
            }
        } else {
            section.filters.css({
                position: 'absolute',
                transform: 'translate3d(0,0,0)'
            });
        }
    }
}
var mr_cookies = {
getItem: function (sKey) {
  if (!sKey) { return null; }
  return decodeURIComponent(document.cookie.replace(new RegExp("(?:(?:^|.*;)\\s*" + encodeURIComponent(sKey).replace(/[\-\.\+\*]/g, "\\$&") + "\\s*\\=\\s*([^;]*).*$)|^.*$"), "$1")) || null;
},
setItem: function (sKey, sValue, vEnd, sPath, sDomain, bSecure) {
  if (!sKey || /^(?:expires|max\-age|path|domain|secure)$/i.test(sKey)) { return false; }
  var sExpires = "";
  if (vEnd) {
    switch (vEnd.constructor) {
      case Number:
        sExpires = vEnd === Infinity ? "; expires=Fri, 31 Dec 9999 23:59:59 GMT" : "; max-age=" + vEnd;
        break;
      case String:
        sExpires = "; expires=" + vEnd;
        break;
      case Date:
        sExpires = "; expires=" + vEnd.toUTCString();
        break;
    }
  }
  document.cookie = encodeURIComponent(sKey) + "=" + encodeURIComponent(sValue) + sExpires + (sDomain ? "; domain=" + sDomain : "") + (sPath ? "; path=" + sPath : "") + (bSecure ? "; secure" : "");
  return true;
},
removeItem: function (sKey, sPath, sDomain) {
  if (!this.hasItem(sKey)) { return false; }
  document.cookie = encodeURIComponent(sKey) + "=; expires=Thu, 01 Jan 1970 00:00:00 GMT" + (sDomain ? "; domain=" + sDomain : "") + (sPath ? "; path=" + sPath : "");
  return true;
},
hasItem: function (sKey) {
  if (!sKey) { return false; }
  return (new RegExp("(?:^|;\\s*)" + encodeURIComponent(sKey).replace(/[\-\.\+\*]/g, "\\$&") + "\\s*\\=")).test(document.cookie);
},
keys: function () {
  var aKeys = document.cookie.replace(/((?:^|\s*;)[^\=]+)(?=;|$)|^\s*|\s*(?:\=[^;]*)?(?:\1|$)/g, "").split(/\s*(?:\=[^;]*)?;\s*/);
  for (var nLen = aKeys.length, nIdx = 0; nIdx < nLen; nIdx++) { aKeys[nIdx] = decodeURIComponent(aKeys[nIdx]); }
  return aKeys;
}
};