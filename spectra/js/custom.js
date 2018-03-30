
// When DOM is fully loaded
jQuery(document).ready(function($) {


	/* Enable Strict Mode
	 ---------------------------------------------------------------------- */
	"use strict";


	/* Main Settings
	 ---------------------------------------------------------------------- */
	if ( theme_vars.content_animations == 'on' ) {
		theme_vars.content_animations = true;
	} else {
		theme_vars.content_animations = false;
	}
	if ( theme_vars.mobile_animations == 'on' ) {
		theme_vars.mobile_animations = true;
	} else {
		theme_vars.mobile_animations = false;
	}

	if ( Modernizr.touch && ! theme_vars.mobile_animations ) {
		theme_vars.content_animations = false; 
	}

	var settings = {
		// Navigation height 
		nav_height: $( '.nav-container' ).css( 'height' ).replace( 'px', '' ),
		content_animation : theme_vars.content_animations, 
		// Text intro
		text_pasue_time : 3000, // Pause between next text
		one_loop : true // Play only one
	};


	/* Remove / Update plugins after page loaded
	 ---------------------------------------------------------------------- */
	(function() {

		// OWL
		$( '#ajax-container #intro-slider' ).each( function(){

			var id = $( this ).attr( 'id' );

			if ( id == undefined ) return;

			// Destroy carousel if exists
			if ( $( '#' + id ).data( 'owlCarousel') != undefined ) {
				$( '#' + id ).data( 'owlCarousel' ).destroy();
			}
		});

		$.waypoints('refresh');
		$.waypoints( 'destroy' );

		// Isotope
		if ( $.fn.isotope ) {
			if ( $( '.masonry' ).data( 'isotope') ) {
				$( '.masonry' ).isotope( 'destroy' );
			}
			if ( $( '.items' ).data( 'isotope') ) {
				$( '.items' ).isotope( 'destroy' );
			}
			if ( $( '.masonry-events' ).data( 'isotope') ) {
				$( '.masonry-events' ).isotope( 'destroy' );
			}
		}
		
		
		/* UPDATE Scamp player content and events
		 ---------------------------------------------------------------------- */
		if ( typeof scamp_player !== 'undefined' && scamp_player != null ) {
			scamp_player.update_content();
			scamp_player.update_events( 'body' );
		}

	})();


	/* Intro Slider
	 ---------------------------------------------------------------------- */
	(function() {


 		if ( $( '#intro-slider' ).length <= 0 ) return;

		function afterUpdate() {

			var slider = $( this.$elem );

			// Zoom
			if ( zoom ) {
				$('.owl-item:eq('+this.owl.currentItem+')', slider ).find( '.slide-image' ).addClass( 'zoom' );
			}

			// Animations
			$('.owl-item:eq('+this.owl.currentItem+')', slider ).find( '.anim-css' ).addClass( 'active' );

  		}

  		function afterMove(){
			
			var slider = $( this.$elem ),
				prev = $('.owl-item:eq('+this.owl.prevItem+')', slider );

			// Zoom
			if ( zoom ) $('.owl-item:eq('+this.owl.currentItem+')', slider ).find( '.image' ).addClass( 'zoom' );

			// Animations
			$('.owl-item:eq('+this.owl.currentItem+')', slider ).find( '.anim-css' ).addClass( 'active' );
			

			window.setTimeout(function () {
				if ( zoom ) prev.find( '.image' ).removeClass( 'zoom' );
       			prev.find( '.anim-css' ).removeClass( 'active' );
    		}, 1000)

		}

		// Carousel slider
		var zoom = false,
			intro_slider = $( '#intro-slider' ),
			navigation = intro_slider.data( 'slider-nav' ),
			pagination = intro_slider.data( 'slider-pagination' ),
			speed = intro_slider.data( 'slider-speed' ),
			pause_time = intro_slider.data( 'slider-pause-time' );

		intro_slider.owlCarousel({
		    navigation : navigation,
		    pagination : pagination,
		    slideSpeed : speed,
		    autoPlay : pause_time,
		    transitionStyle : 'fade',
		   	navigationText: [
		      "<i class='icon icon-arrow-left2'></i>",
		      "<i class='icon icon-arrow-right2'></i>"
		    ],
		    singleItem : true,
		    afterMove : afterMove,
		    afterUpdate : afterUpdate
  		});

		// Set startup animations
  		if ( $( '#intro-slider' ).hasClass( 'zoom' ) ) {
  			zoom = true;
  			$( '#intro-slider' ).find( '.owl-item:eq(0) .image' ).addClass( 'zoom' );
  		}
  		$( '#intro-slider' ).find( '.owl-item:eq(0) .anim-css' ).addClass( 'active' );

  	})();


  	/* Content Slider
	 ---------------------------------------------------------------------- */
	(function() {


 		if ( $( '.content-slider' ).length <= 0 ) return;

		$( '.content-slider' ).each( function() {

			// Carousel slider
			var 
				content_slider = $( this ),
				id = '#' + $( this ).attr( 'id' ),
				navigation = content_slider.data( 'slider-nav' ),
				pagination = content_slider.data( 'slider-pagination' ),
				speed = content_slider.data( 'slider-speed' ),
				pause_time = content_slider.data( 'slider-pause-time' );

			$( id ).owlCarousel({
			    navigation : navigation,
			    pagination : pagination,
			    slideSpeed : speed,
			    autoPlay : pause_time,
			   	navigationText: [
			      "<i class='icon icon-arrow-left2'></i>",
			      "<i class='icon icon-arrow-right2'></i>"
			    ],
			    singleItem : true
	  		});


		});
		

  	})();


  	/* Carousel slider
	 ---------------------------------------------------------------------- */
	(function() {
		$( '.slider' ).each( function(){

			var id = $( this ).attr( 'id' ),
				effect = $( this ).data( 'effect' ),
				nav = $( this ).data( 'nav' ),
				autoplay = $( this ).data( 'autoplay' ),
				pagination = $( this ).data( 'pagination' ),
				items = $( this ).data( 'items' ),
				single_item = true;

			if ( items != undefined && items > 1 ) {
				single_item = false;
			}

			if ( id == undefined ) return;
			
			$( '#' + id ).owlCarousel({
			    navigation : nav,
			    pagination : pagination,
			    navigationText: [
			      "<i class='icon icon-arrow-left2'></i>",
			      "<i class='icon icon-arrow-right2'></i>"
			    ],
			    singleItem : single_item,
			    items : items,
			    autoPlay : autoplay,
			     //Basic Speeds
			    slideSpeed : 400,
			    paginationSpeed : 800,
			    rewindSpeed : 1000
	  		});
	  	});
	})();


	/* Magnific popup
 	 ---------------------------------------------------------------------- */
	(function() {
	 
	 	// Media
		$( '.videobox' ).magnificPopup( { type:'iframe' } );

		// Image
		$( '.imagebox' ).magnificPopup( { type:'image' } );

		// WP Gallery
		$( '.gallery' ).each(function() {

			var gallery = $( this ),
				id = $( this ).attr( 'id' );

			$( 'a[href*="uploads"]', gallery ).each( function(){
				$( this ).attr( 'data-group', id );
				if ( $( this ).parents( '.gallery-item' ).find( '.gallery-caption' ).length ) {
					var caption = $( this ).parents( '.gallery-item' ).find( '.gallery-caption' ).text();
					$( this ).attr( 'title', caption );
				}	

			});

			$( this ).magnificPopup({
				delegate: 'a', 
		        type: 'image',
		        gallery: {
		          enabled:true
		        }
		    });

		});

		// WP Gallery
		$( '#gallery-images' ).magnificPopup({
			delegate: 'a', 
	        type: 'image',
	        gallery: {
	          enabled:true
	        }
	    });


	})();


	/* Google Maps
 	 	 ---------------------------------------------------------------------- */
		(function() {
			if ( $.fn.gmap3 ) {

				var styles = [{
				      featureType: "administrative",
				      elementType: "geometry",
				      stylers: [{
				        color: "#a7a7a7"
				      }]
				    }, {
				      featureType: "administrative",
				      elementType: "labels.text.fill",
				      stylers: [{
				        visibility: "on"
				      }, {
				        color: "#737373"
				      }]
				    }, {
				      featureType: "landscape",
				      elementType: "geometry.fill",
				      stylers: [{
				        visibility: "on"
				      }, {
				        color: "#efefef"
				      }]
				    }, {
				      featureType: "poi",
				      elementType: "geometry.fill",
				      stylers: [{
				        visibility: "on"
				      }, {
				        color: "#dadada"
				      }]
				    }, {
				      featureType: "poi",
				      elementType: "labels",
				      stylers: [{
				        visibility: "off"
				      }]
				    }, {
				      featureType: "poi",
				      elementType: "labels.icon",
				      stylers: [{
				        visibility: "off"
				      }]
				    }, {
				      featureType: "road",
				      elementType: "labels.text.fill",
				      stylers: [{
				        color: "#696969"
				      }]
				    }, {
				      featureType: "road",
				      elementType: "labels.icon",
				      stylers: [{
				        visibility: "off"
				      }]
				    }, {
				      featureType: "road.highway",
				      elementType: "geometry.fill",
				      stylers: [{
				        color: "#ffffff"
				      }]
				    }, {
				      featureType: "road.highway",
				      elementType: "geometry.stroke",
				      stylers: [{
				        visibility: "on"
				      }, {
				        color: "#b3b3b3"
				      }]
				    }, {
				      featureType: "road.arterial",
				      elementType: "geometry.fill",
				      stylers: [{
				        color: "#ffffff"
				      }]
				    }, {
				      featureType: "road.arterial",
				      elementType: "geometry.stroke",
				      stylers: [{
				        color: "#d6d6d6"
				      }]
				    }, {
				      featureType: "road.local",
				      elementType: "geometry.fill",
				      stylers: [{
				        visibility: "on"
				      }, {
				        color: "#ffffff"
				      }, {
				        weight: 1.8
				      }]
				    }, {
				      featureType: "road.local",
				      elementType: "geometry.stroke",
				      stylers: [{
				        color: "#d7d7d7"
				      }]
				    }, {
				      featureType: "transit",
				      elementType: "all",
				      stylers: [{
				        visibility: "on"
				      }]
				    }, {
				      featureType: "water",
				      elementType: "geometry.fill",
				      stylers: [{
				        color: "#d3d3d3"
				      }]
				    }]

				$( '.gmap' ).each( function(){

					// Get Marker
					var marker = '';
					if ( theme_vars.map_marker !== '' ) {
						marker = theme_vars.map_marker;
					} else {
						marker = theme_vars.theme_uri + '/images/map-marker.png';
					}

					var 
						gmap = $( this ),
						address = gmap.data( 'address' ), // Google map address e.g 'Level 13, 2 Elizabeth St, Melbourne Victoria 3000 Australia'
						zoom = gmap.data( 'zoom' ), // Map zoom value. Default: 16
						zoom_control, // Use map zoom. Default: true
						scrollwheel; // Enable mouse scroll whell for map zooming: Default: false

					if ( gmap.data( 'zoom_control' ) == 'true' ) {
						zoom_control = true;
					} else {
						zoom_control = false;
					}

					if ( gmap.data( 'scrollwheel' ) == 'true' ) {
						scrollwheel = true;
					} else {
						scrollwheel = false;
					}

					gmap.gmap3({
						address: address,
						zoom: zoom,
						zoomControl: zoom_control, // Use map zoom. Default: true
						scrollwheel: scrollwheel, // Enable mouse scroll whell for map zooming: Default: false
						mapTypeId : google.maps.MapTypeId.ROADMAP,
						mapTypeControlOptions: {
				          mapTypeIds: [google.maps.MapTypeId.ROADMAP, "style1"]
				        }
					}).marker({
						address: address,
				        icon: marker
				    });

				});
			}
		})();


	/* Parallax
	 ---------------------------------------------------------------------- */
	(function() {

		var images;
		
		function init() {
			images = [].slice.call( $('.parallax, .vc-parallax') );
			if(!images.length) { return }
			
			$( window ).on( 'scroll', doParallax );
			$( window ).on( 'resize', doParallax );
			doParallax();
		}
		
		function getViewportHeight() {
			var a = document.documentElement.clientHeight, b = window.innerHeight;
			return a < b ? b : a;
		}
		
		function getViewportScroll() {
			if(typeof window.scrollY != 'undefined') {
				return window.scrollY;
			}
			if(typeof pageYOffset != 'undefined') {
				return pageYOffset;
			}
			var doc = document.documentElement;
			doc = doc.clientHeight ? doc : document.body;
			return doc.scrollTop;
		}
		
		function doParallax() {
			var el, elOffset, elHeight,
				offset = getViewportScroll(),
				vHeight = getViewportHeight();
			
			for(var i in images) {
				el = images[i];
				if ( $( el ).css( 'background-image' ) != 'none') {
					elOffset = el.offsetTop;
					elHeight = el.offsetHeight;
					
					if((elOffset > offset + vHeight) || (elOffset + elHeight < offset)) { continue; }
					
					el.style.backgroundPosition = '50% '+Math.round((elOffset - offset)*3/8)+'px';
				}
			}
		}

		init()
	})();


	/* Small Scripts
	 ---------------------------------------------------------------------- */
	(function() {


		/* Parallax settings
	 	 ------------------------- */
		/* .parallax(xPosition, speedFactor, outerHeight) options:
		   xPosition - Horizontal position of the element
		   inertia - speed to move relative to vertical scroll. Example: 0.1 is one tenth the speed of scrolling, 2 is twice the speed of scrolling
		   outerHeight (true/false) - Whether or not jQuery should use it's outerHeight option to determine when a section is in the viewport
		*/
		// if ( $.fn.parallax != 'undefined' ) {
		// 	$( '.parallax, .vc-parallax' ).each( function(){
		// 		$( this ).parallax( '50%', 0.2, false );
		// 	});
		// }



		/* Resonsive videos
	 	 ------------------------- */
		if ( $.fn.ResVid ) {
			$( 'body' ).ResVid();
		}


		/* Waypoints Magic
		 ------------------------- */

		// Animated Intro Elements
		$( '.intro:not(#intro-slider) .anim-css' ).waypoint( function() {

			if ( $( this ).hasClass( 'done' ) ) return false;

			$( this ).addClass( 'active' ).addClass( 'done' )
			
		}, {
			offset : '80%'
		});

		// Animated Content
		if ( settings.content_animation ) {
			// $( '#page .anim-css, #upcoming-event .anim-css' ).css( 'visibility', 'hidden' );
			$( '#page .anim-css, #upcoming-event .anim-css' ).waypoint( function() {

				if ( $( this ).hasClass( 'done' ) ) return false;

				var d = $( this ).data( 'delay' );

				if ( d == undefined || d == '' ) d = 0;

				$( this ).css( 'visibility', 'visible' ).transition({
					opacity: 1,
					delay : d,
					y: 0,
					duration: settings.animation_duration,
					easing: 'ease',
					complete: function() { $( this ).addClass( 'done' ).removeClass( 'anim-css' ); }
				});
			}, {
				offset : '90%'
			});
		} else {
			$( '#page .anim-css, #upcoming-event .anim-css' ).removeClass( 'anim-css' );
		}
	
		
		/* Masonry and events
		 ------------------------- */

		// Boxes
		if ( $( '.masonry' ).length || $( '.masonry-events' ).length ) {
			$( '.masonry' ).isotope({
				itemSelector : '.masonry-item'
			});

			// Events
			$( '.masonry-events' ).isotope( {
				containerStyle: { position: 'relative', overflow: 'visible' }
			});

			var masonry_layout = function(){
				setTimeout( function(){
					if ( $( '.masonry' ).length || $( '.masonry-events' ).length ) {
						$( '.masonry' ).isotope( 'layout' );
						$( '.masonry-events' ).isotope( 'layout' );
					}
				}, 1000);
				
			}
			masonry_layout();
			$( window ).on( 'resize', masonry_layout );

		}


		/* Frame BOX
	 	 ------------------------- */

		$( '.frame-box' ).append( '<span class="line1"></span><span class="line2"></span><span class="line3"></span><span class="line4"></span>' );


		/* Countdown
	 	 ------------------------- */
		if ( $.fn.countdown ) {
			$( '.countdown' ).each( function(e) {
				var date = $( this ).data( 'event-date' );

		        $( this ).countdown( date, function( event ) {
		            var $this = $( this );

		            switch( event.type ) {
		                case "seconds":
		                case "minutes":
		                case "hours":
		                case "days":
		                case "weeks":
		                case "daysLeft":
		                    $this.find( '.' + event.type ).html( event.value );
		                    break;

		                case "finished":
		              
		                    break;
		            }
		        });
		    });
	    }

	    /* Youtube Video
	 	 ------------------------- */
		if ( ! Modernizr.touch ) {
		 	if ( $( '#YTAPI' ).length ) {
		 		$( '#YTAPI, #www-widgetapi-script' ).remove();
		 	}

		 	if ( $( '#intro-youtube' ).length ) {
		 		$( '#intro-youtube .image' ).css( 'background', 'transparent' );
				var intro_YT = $( '.player' ).YTPlayer();
			}	
		}


		/* Toggle content
	 	 ------------------------- */
		$( '.toggle' ).each(function() {		  
			
			/* Init */
			$('.active-toggle', this).next().show();

			/* List variables */
			var toggle = $(this);
			
			/* Click on Toggle Heading */
			$('h4.toggle-title', this).click(function () {
				if ($(this).is('.active-toggle')) {
					$(this).removeClass('active-toggle');
					$('.toggle-content', toggle).slideUp(400);
				} else {
					$(this).addClass('active-toggle');
					$('.toggle-content', toggle).slideDown(400);
				}
				return false;
			});
			
		});


		/* Tabs
	 	 ------------------------- */
		$( '.tabs-wrap' ).each(function() {		  
			
			/* List variables */
			var tabs = $(this);
			
			/* Init */
			$('.tab-content', this).hide();
			$('.tab-content:first', this).css('display', 'block');
			$('ul.tabs li:first a', this).addClass('active-tab');
			
			/* Click on Tab */
			$('ul.tabs li', this).click(function () {
				if (!$(this).is('tab-active')) {
					var current = $(this).index();
					$('ul.tabs li a', tabs).removeClass('active-tab');
					$('a', this).addClass('active-tab');
					$('.tab-content:not(:eq(' + current + '))', tabs).css('display', 'none');
					$('.tab-content:eq(' + current + ')', tabs).css('display', 'block');
				}
				return false;
			});
			
		});

	

	})();


	/* Intro section
	 ---------------------------------------------------------------------- */
	(function() {

		var intro_resize = function(){
			var 
			 	resize_image = $( '.intro-resize, .intro-resize .image, .intro-resize .slide' ),
				win_width = $( window ).width(),
				win_height = $( window ).height(),
				resize_image_height = win_height;

			resize_image.css({
				height: resize_image_height+'px'
			});

		}

		// Init resize_image
		intro_resize();

		$( window ).on( 'resize', intro_resize );


		/* Show Header
	 	 ------------------------- */

	 	// Grab the initial top offset of the intro section
	 	if ( $( '#ajax-content > .intro' ).length <= 0 ) {
	 		$( '#header' ).removeClass( 'hide-navigation' );
	 		return;
	 	}
	 	if ( $( '#header' ).hasClass( 'show-navigation' ) ) {
	 		return;
	 	}
	 	$( '#header' ).addClass( 'hide-navigation' );
		var 
			header = $( '#header' ),
			intro = $( '#ajax-content > .intro' ),
			intro_offset_top = 20,
			hiddenNav = false;
	
		var intro = function(){

			var scroll_top = $(window).scrollTop(); // our current vertical position from the top

			// if we've scrolled more than the navigation, change its position to fixed to stick to top, otherwise change it back to relative
			if ( scroll_top > intro_offset_top ) { 
				if ( header.hasClass( 'hide-navigation' ) ) {
					header.removeClass( 'hide-navigation' );
				}
			} else {
				if ( ! header.hasClass( 'hide-navigation' ) ) {
					header.addClass( 'hide-navigation' );
				}
			}   
		};
	
		// and run it again every time you scroll
		$( window ).scroll(function() {

			if ( header.hasClass( 'show-navigation' ) ) return;
			intro();
		});

		intro();

	})();


	/* Stats
	 ---------------------------------------------------------------------- */
	(function() {

		$('ul.stats').each(function(){

			// Variables
			var
				$max_el       = 6,
				$stats        = $(this),
				$stats_values = [],
				$stats_names  = [],
				$timer        = $stats.data('timer'),
				$stats_length;

			// Get all stats and convert to array
			// Set length variable
			$('li', $stats).each(function(i){
				$stats_values[i] = $('.stat-value', this).text();
				$stats_names[i] = $('.stat-name', this).text();
			});
			$stats_length = $stats_names.length;

			// Clear list
			$stats.html('');

			// Init
			display_stats();

			// Set $timer
			var init = setInterval(function(){
				display_stats();
			},$timer);

			// Generate new random array
			function randsort(c,l,m) {
    			var o = new Array();
		    	for (var i = 0; i < m; i++) {
		        	var n = Math.floor(Math.random()*l);
		        	var index = jQuery.inArray(n, o);
		        	if (index >= 0) i--;
		       		else o.push(n);
		    	}
		    	return o;
			}

			// Display stats
			function display_stats(){
				var random_list = randsort($stats_names, $stats_length, $max_el);
				var i = 0;

				// First run
				if ($('li', $stats).size() == 0) {
					for (var e = 0; e < random_list.length; e++) {
						$($stats).append('<li><span class="stat-value"></span><span class="stat-name"></span></li>');
					}
				}
				// small CSS fix for IE8
				if ($('html').hasClass('lt-ie9')) {
					$('li:nth-child(3n+3)', $stats).addClass('last');
					$('li:nth-child(odd)', $stats).addClass('odd');
				}

				var _display = setInterval(function(){

					var num = random_list[i],
						stat_name = $('li', $stats).eq(i).find('.stat-name');
					stat_name.animate({bottom : '-40px', opacity : 0}, 400, 'easeOutQuart', function(){
						$(this).text($stats_names[num]);
						$(this).css({bottom : '-40px', opacity : 1});
						$(this).animate({ bottom : 0}, 400, 'easeOutQuart');
					});
						
					var stat_value = $('li', $stats).eq(i).find('.stat-value');
					display_val(stat_value, num);
					i++;
					if (i == random_list.length)
						clearInterval(_display);
				},600);
			}

			// Display value
			function display_val(val, num) {
				var 
					val_length = $stats_values[num].length,
					val_int = parseInt($stats_values[num]),
					counter = 10,
					delta = 10,
					new_val;

				// Delta
				if (val_int <= 50) delta = 1;
				else if (val_int > 50 && val_int <= 100) delta = 3;
				else if (val_int > 100 && val_int <= 1000) delta = 50;
				else if (val_int > 1000 && val_int <= 2000) delta = 100
				else if (val_int > 2000 && val_int <= 3000) delta = 150;
				else if (val_int > 3000 && val_int <= 4000) delta = 200;
				else delta = 250;

				var _display = setInterval(function(){
					
					counter = counter+delta;
					new_val = counter;
					val.text(new_val);
					if (new_val >= val_int) {
						clearInterval(_display);
						val.text($stats_values[num]);
					}
						
				},40);
				
			}

		});

	})();


	/* Portfolio
	 ---------------------------------------------------------------------- */
	(function() {

		if ( ! $.fn.isotope ) return;
		if ( $( '.items' ).length <= 0 ) return;

		var $container = $( '.items' ),
			$win = $(window);

		if ( $container.length <= 0 ) return;

		// Add filter event
		function _items_filter($el, $data) {

			// Add all filter class
			$el.addClass('item-filter');

			// Add categories to item classes
			$('.item', $container).each(function(i) {
				var 
					$this = $(this);
					$this.addClass($this.attr($data));
			});

			$el.on('click', 'a', function(e){
				var 
					$this   = $(this),
					$option = $this.attr($data);

				// Add active filter class
				$('.item-filter').removeClass('active-filter');
				$el.addClass('active-filter');
				$('.item-filter:not(.active-filter) li a').removeClass('active');
				$('.item-filter:not(.active-filter) li:first-child a').addClass('active');

				// Add/remove active class for this filter
				$el.find('a').removeClass('active');
				$this.addClass('active');

				if ($option) {
					if ($option !== '*') $option = $option.replace($option, '.' + $option)
					$container.isotope({ filter : $option });
				}

				setTimeout( function(){ $container.isotope( 'layout' ) }, 1000 );

				e.preventDefault();

			});

			$el.find('a').first().addClass('active');
		}

		// Portfolio init
		var init = function() {
			$container.isotope({
				portfolioelector : '.item',
				layoutMode: 'fitRows'
			});
			setTimeout( function(){ $container.isotope( 'layout' ) }, 3000 );

			// Init filters
			if ( $('.dd-filter-list').length ) _items_filter( $('.dd-filter-list'), 'data-categories' );
			if ( $('.filter-list').length ) _items_filter( $('.filter-list'), 'data-categories' );
		}

		if ( $( 'body' ).hasClass( 'wp-ajax-loader' ) ) {
			init();
		} else {
			$( window ).on( 'load', init )
		}
		

	})();


});