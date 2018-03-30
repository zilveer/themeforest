/**
 * Frontend Scripts
 * SmartFood WordPress Theme
 * themesdepot.org
 *
 * @copyright   Copyright (c) 2014, Alessandro Tesoro
*/
jQuery(document).ready(function ($) {
	"use strict";

	var jQueryscrollTop = jQuery(window).scrollTop();
	var jQuerywindowHeight, jQuerypageHeight, jQueryfooterHeight, jQueryctaHeight;

	var pxWrapper 	  = $('#intro-wrap'),
		pxContainer   = $('#intro'),
		pxImg         = $('.intro-item'),
		pxImgCaption  = pxContainer.find('.caption'),
		loaderIntro = '<div class="landing landing-slider"><div class="spinner"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div></div>',
        loader = '<div class="landing landing-els"><div class="spinner"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div></div>',
        loaderLightbox = '<div class="landing landing-els lightbox"><div class="spinner"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div></div>';

	/**
	 * Settings screen JS
	 */
	var TDP_Theme = {

		init : function() {
			this.general();
			tdp_set_footer_height();
			this.lightbox();
            this.counter_shortcode();
            this.progress_bar_shortcode();
            this.pie_chart_shortcode();
            this.cover_boxes_shortcode();
            this.tabs();
            this.accordion();
            this.toggle();
            this.sections();
            this.instagram_feed();
            this.go_to_the_top();
            this.sticky_header();
            this.initIntro();
            this.responsive_menu();
            this.static_homepage_section();
		},

		// General Theme Scripts/Settings
		general : function() {

			// Responsive videos
			jQuery("body").fitVids();

			//Page Loader
			if(js_settings.display_page_loader == 1) {
				NProgress.start();
			}

			//Menu
			jQuery('ul.sf-menu').superfish();

			//Subheader background image for pages
			if( jQuery('body').hasClass('page-header-image') && !jQuery('body').hasClass('page-template-homepage') && !jQuery('body').hasClass('page-template-homepage-page-builder') ) {
				var header_bg = jQuery('#subheader').data('img');
				if(header_bg) {
					jQuery("body > .row header").backstretch( header_bg );
				}
			}

			if(js_settings.display_page_loader == 1) {
				jQuery(window).on("backstretch.show", function (e, instance) {
				    NProgress.done();
				});
			}

			/* Set background image to footer if specific layout */
			if( jQuery('body').hasClass('footer-has-bg') ) {
			var footer_bg = jQuery('#booking-about').data('bg');
				jQuery("#booking-about").backstretch( footer_bg );
			}

			/* Media hover icon animation */
			jQuery(".media").hover(function () {
				jQuery(this).find(".hovercover").stop().fadeTo(200, 1);
				jQuery(this).find(".on-hover").stop().fadeTo(200, 1, 'easeOutQuad');
				jQuery(this).find(".hovericon").stop().animate({'top' : '50%', 'opacity' : 1}, 250, 'easeOutBack');
			},function () {
				jQuery(this).find(".hovercover").stop().fadeTo(200, 0);
				jQuery(this).find(".on-hover").stop().fadeTo(200, 0, 'easeOutQuad');
				jQuery(this).find(".hovericon").stop().animate({'top' : '65%', 'opacity' : 0}, 150, 'easeOutSine');
			});

			/* Flexslider */
			jQuery('.flexslider').flexslider({
		    	prevText: "",
				nextText: "",
		    });
			
		},

		/* Lightbox and galleries */
		lightbox : function() {

			jQuery('.lightbox, .gallery').each(function() { // the containers for all your galleries should have the class gallery
	            jQuery(this).magnificPopup({
	                delegate: 'a', // the container for each your gallery items
	                type: 'image',
	                gallery:{enabled:true},
	                removalDelay: 500, //delay removal by X to allow out-animation
	                closeOnContentClick: true
	            });
	        });

		},

        /* Counter Shortcode Script */
        counter_shortcode : function() {

            if(jQuery('.counter.zero').length){
                jQuery('.counter.zero').each(function() {
                    if(!jQuery(this).hasClass('executed')){
                        jQuery(this).addClass('executed');
                        jQuery(this).appear(function() {
                            jQuery(this).parent().css('opacity', '1');
                            var $max = parseFloat(jQuery(this).text());
                            jQuery(this).countTo({
                                from: 0,
                                to: $max,
                                speed: 1500,
                                refreshInterval: 100
                            });
                        },{accX: 0, accY: -200});
                    }   
                });
            }

        },

        /* progress bar shortcode script */
        progress_bar_shortcode : function() {

            if(jQuery('.tdp_progress_bar').length){
                jQuery('.tdp_progress_bar').each(function() {
                    jQuery(this).appear(function() {
                        TDP_Theme.counter_for_progress_bars(jQuery(this));
                        var percentage = jQuery(this).find('.progress_content').data('percentage');
                        jQuery(this).find('.progress_content').css('width', '0%');
                        jQuery(this).find('.progress_content').animate({'width': percentage+'%'}, 1500);
                        jQuery(this).find('.progress_number_wrapper').css('width', '0%');
                        jQuery(this).find('.progress_number_wrapper').animate({'width': percentage+'%'}, 1500);
                        
                        
                    },{accX: 0, accY: -200});
                });
            }

        },
        /* progress bar shortcode script */
        counter_for_progress_bars : function($this) {
            var percentage = parseFloat($this.find('.progress_content').data('percentage'));
            if($this.find('.progress_number span').length) {
                $this.find('.progress_number span').each(function() {
                    jQuery(this).parents('.progress_number_wrapper').css('opacity', '1');
                    jQuery(this).countTo({
                        from: 0,
                        to: percentage,
                        speed: 1500,
                        refreshInterval: 50
                    });
                });
            }
        },
        /* Pie chart shortcode */
        pie_chart_shortcode : function() {
        	if(jQuery('.tdp_percentage').length){
				jQuery('.tdp_percentage').each(function() {

					var $barColor = '#b39964';

					if(jQuery(this).data('active') !== ""){
						$barColor = jQuery(this).data('active');
					}

					var $trackColor = '#f6f6f6';

					if(jQuery(this).data('noactive') !== ""){
						$trackColor = jQuery(this).data('noactive');
					}

					var $line_width = 10;

					if(jQuery(this).data('linewidth') !== ""){
						$line_width = jQuery(this).data('linewidth');
					}
					
					var $size = 174;

					jQuery(this).appear(function() {
						TDP_Theme.run_percentage_counter(jQuery(this));
						jQuery(this).parent().css('opacity', '1');
						
						jQuery(this).easyPieChart({
							barColor: $barColor,
							trackColor: $trackColor,
							scaleColor: false,
							lineCap: 'butt',
							lineWidth: $line_width,
							animate: 1500,
							size: $size
						}); 
					},{accX: 0, accY: -200});
				});
			}
        },
        /* Pie chart percentage counter script */
        run_percentage_counter : function($this) {
        	jQuery($this).css('opacity', '1');
			var $max = parseFloat(jQuery($this).find('.tdp_counter').text());
			jQuery($this).find('.tdp_counter').countTo({
				from: 0,
				to: $max,
				speed: 1500,
				refreshInterval: 50
			});
        },
        /* Cover Boxes Shortcode */
        cover_boxes_shortcode : function() {
        	if(jQuery('.cover_boxes').length && jQuery(window).width() > 640 ) {
		        jQuery('.cover_boxes').each(function(){
		            var active_element = 0;
		            var data_active_element = 1;
		            if(typeof jQuery(this).data('active-element') !== 'undefined' && jQuery(this).data('active-element') !== false) {
		                data_active_element = parseFloat(jQuery(this).data('active-element'));
		                active_element = data_active_element - 1;
		            }

		            var number_of_columns = 3;

		            //validate active element
		            active_element = data_active_element > number_of_columns ? 0 : active_element;

		            jQuery(this).find('li').eq(active_element).addClass('active_box');
		            var cover_boxed = jQuery(this);
		            jQuery(this).find('li').each(function(){
		                jQuery(this).hover(function() {
		                    jQuery(cover_boxed).find('li').removeClass('active_box');
		                    jQuery(this).addClass('active_box');
		                });

		            });
		        });
		    }
        },
        /* jQuery Ui tabs */
        tabs : function() {
        	if(jQuery().tabs) {
        		jQuery( ".tdp-tabs" ).tabs();
        	}
        },
        accordion : function() {
        	if(jQuery().accordion) {
	        	jQuery(".tdp-accordion").accordion({
	        			heightStyle: "content"
	        	});
        	}
        },
        toggle : function() {
        	jQuery("h3.tdp-toggle-trigger").click(function(){
        		jQuery(this).toggleClass("active").next().slideToggle("fast");
        		return false;
        	});
        },
        sections : function() {

        	jQuery('.block-with-image-noparallax').each(function(){
        		var section_bg = jQuery(this).data('img');
				jQuery(this).backstretch( section_bg );
        	});

        },
        instagram_feed : function() {
        	if(jQuery('.instafeed').length){
				jQuery.fn.spectragram.accessData = {
					accessToken: '1595841254.111a57c.d36f6fcdfd38495c8c8974661e5471e4',
					clientID: '111a57c812e246cd9ea1e541a73924e5'
				};
				jQuery('.instafeed').each(function () {
			        jQuery(this).children('ul').spectragram('getUserFeed', {
			            query: jQuery(this).attr('data-user-name')
			        });
			    });
			}
        },
        go_to_the_top : function() {
        	if( jQuery('#to-top').length > 0 && jQuery(window).width() > 1020) {
				if(jQueryscrollTop > 350){
					jQuery(window).bind('scroll',TDP_Theme.hideToTop);
				}
				else {
					jQuery(window).bind('scroll',TDP_Theme.showToTop);
				}
			}
			//to top color
			if( jQuery('#to-top').length > 0 ) {
				var jQuerywindowHeight, jQuerypageHeight, jQueryfooterHeight, jQueryctaHeight;
				//calc on scroll
				jQuery(window).scroll(TDP_Theme.calcToTopColor);
				//calc on resize
				jQuery(window).resize(TDP_Theme.calcToTopColor);

			}
			//scroll up event
			jQuery('#to-top, .gototop').click(function(){
				jQuery('body,html').stop().animate({
					scrollTop:0
				},800,'easeOutCubic')
				return false;
			});
        },
        showToTop : function(){
			if( jQueryscrollTop > 350 ){
				jQuery('#to-top').stop(true,true).animate({
					'bottom' : '17px'
				},350,'easeInOutCubic');	
				jQuery(window).unbind('scroll',TDP_Theme.showToTop);
				jQuery(window).bind('scroll',TDP_Theme.hideToTop);
			}
		},
		hideToTop : function(){
			if( jQueryscrollTop < 350 ){
				jQuery('#to-top').stop(true,true).animate({
					'bottom' : '-30px'
				},350,'easeInOutCubic');	
				jQuery(window).unbind('scroll',TDP_Theme.hideToTop);
				jQuery(window).bind('scroll',TDP_Theme.showToTop);	
				
			}
		},
		calcToTopColor : function(){
			jQueryscrollTop = jQuery(window).scrollTop();
			jQuerywindowHeight = jQuery(window).height();
			jQuerypageHeight = jQuery('body').height();
			jQueryfooterHeight = jQuery('footer').height();
			jQueryctaHeight = (jQuery('#call-to-action').length > 0) ? jQuery('#call-to-action').height() : 0;
			if( (jQueryscrollTop-35 + jQuerywindowHeight) >= (jQuerypageHeight - jQueryfooterHeight) && jQuery('#boxed').length == 0){
				jQuery('#to-top').addClass('dark');
			}
			else {
				jQuery('#to-top').removeClass('dark');
			}
		},
		sticky_header : function() {
			jQuery(window).scroll(function(){
				var h = jQuery('body').height();
				var y = jQuery(window).scrollTop();
				if( y > (h*.15) && y < (h*.85) ){
					jQuery("#header-dropin").fadeIn('fast');
				} else {
					jQuery('#header-dropin').fadeOut('fast');
					
				}
				if( y > (h*.25) && y < (h*.95) ){
					jQuery(".reservations-tab").show();
					jQuery(".reservations-tab").addClass('set-fade');
				} else {
					jQuery(".reservations-tab").removeClass('set-fade');
					jQuery(".reservations-tab").fadeOut('fast');
				}
			});
		},
		initIntro : function() {
			var $this = pxContainer;

	        $this.append(loaderIntro);

	        $this.addClass(function () {
	            return $this.find('.intro-item').length > 1 ? "big-slider" : "";
	        });

	        $this.waitForImages({

	            finished: function () {

	                // console.log('All images have loaded.');
	                $('.landing-slider').remove();

	                if ($this.hasClass('big-slider')) {

	                    var autoplay = $this.data('autoplay'),
	                        navigation = $this.data('navigation'),
	                        pagination = $this.data('pagination'),
	                        transition = $this.data('transition');

	                    $this.owlCarousel({
	                        singleItem: true,
	                        autoPlay: autoplay || false, // || = if data- is empty or if it does not exists
	                        transitionStyle: transition || false,
	                        stopOnHover: true,
	                        responsiveBaseWidth: ".slider",
	                        responsiveRefreshRate: 0,
	                        addClassActive: true,
	                        navigation: navigation || false,
	                        navigationText: [
	                            "<i class='fa fa-angle-left'></i>",
	                            "<i class='fa fa-angle-right'></i>"
	                        ],
	                        pagination: pagination || false,
	                        rewindSpeed: 2000,
	                    });

	                }

	                $this.removeClass('preload');

	                if (pxWrapper.length && $this.hasClass('more-button') && $this.attr('data-pagination') !== 'true') {
	                    $this.append(moreBtnIcon);
	                    smoothScroll();
	                }

	            },
	            waitForAll: true
	        });
		},

		responsive_menu : function() {
			jQuery('.display-menu').on('click', function(e) {
				jQuery('.display-menu i').toggleClass("fa-list fa-times");
		    	jQuery('#responsive-menu').toggleClass("menu-hidden"); //you can list several class names 
		    	e.preventDefault();
		    });

		    jQuery('#js-menu li.menu-item-has-children > a').append('<i class="nested-list fa fa-plus">');

		    jQuery.each(jQuery('#js-menu li.menu-item-has-children > a'), function() { 
			    jQuery(this).on('click', function(e) {
			    	jQuery(this).next('ul').toggleClass('show-sub-menu');
			    	e.preventDefault();
			    });
			});

		},

		static_homepage_section : function() {

			//Subheader background image for pages
			if( jQuery('body').hasClass('homepage-static-section') ) {
				var header_bg = jQuery('#static-image-section').data('img');
				if(header_bg) {
					jQuery("#static-image-section").backstretch( header_bg );
				}
			}

		}
	}
	
	TDP_Theme.init();

});

/**
 * Update elements on window resize
 */
jQuery(window).resize(function ($) {
	"use strict";
	if(jQuery(window).width() > 1025) {
		tdp_set_footer_height();
	}
	if(jQuery(window).width() < 800) {
		jQuery('#booking-about').insertAfter('#booking-area');
	}
});


/**
 * Function to set footer height based on browser window
 */
function tdp_set_footer_height(){

	if(jQuery(window).width() < 800) {
		jQuery('#booking-about').insertAfter('#booking-area');
	}

	if(jQuery(window).width() > 1025) {
		var winHeight = jQuery(window).height();
		jQuery('#footer-booking, #booking-about, #booking-widgets-area').css({'height': winHeight});
	}

}