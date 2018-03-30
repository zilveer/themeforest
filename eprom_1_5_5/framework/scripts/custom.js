
// When DOM is fully loaded
jQuery(document).ready(function($) {


	/* MPlayer - jQuery script for Soundmanager 2 
	 ---------------------------------------------------------------------- */
	(function() {
	 	
	 	if (!$.fn.MPlayer) return;

	 	// Init
	 	var
	 		$debug = theme_vars.debug;
	 		$volume = theme_vars.volume;

	 	$('.track').on( 'click', function(event){
	 		return false;
	 		event.preventDefault;
	 	});
		// Load music script
		$(window).load(function() {
			$('.track').MPlayer({
				sm: theme_vars.sm_path+'/soundmanager2-nodebug-jsmin.js',
				smOptions : { url: theme_vars.swf_path, flashVersion: 9, preferFlash: false, useHTML5Audio: true, allowScriptAccess: 'always', debugMode: $debug, debugFlash: $debug, useConsole: $debug },
				playlistSelector : '.playlist, #tracklist',
				volume : $volume,
				onReady : function() {
					// Callback function
					full_player()
				}
			});
		});


		/* Full player
		 ---------------------------------------------------------------------- */
		function full_player() {

			var 
				$player = $('#full-player-wrap .container'),
				$list = $('#tracklist', $player),
				$length = $('.track', $list).length-1,
				$display_playlist = $('#full-player-wrap').data('display-playlist'),
				$track_number = 0;

				if ( $list.data('autoplay') == true ) $('#fp-nav > .play').addClass('pause');

			// Update list
			var _update_list = function(){

				// Animate list
				$list.animate({top : $track_number*(-50)}, 400, 'easeOutQuart');

				// Tracklist navigation active class
				$('#tracklist-nav ul li', $player).removeClass('active');
				$('#tracklist-nav ul li:eq('+$track_number+')', $player).addClass('active');
			}

			// Build tracklist navigation
			$('#tracklist-nav', $player).append('<ul></ul>');
			$('li .track', $list).each(function(i){

				var 
					$track_name = $(this).text(),
					$num = i+1;

				$('#tracklist-nav ul', $player).append('<li><span class="track-num">'+$num+'</span>'+$track_name+'</li>');

				// Add click event
				$('#tracklist-nav ul li:eq('+i+')', $player).on('click', function(e){

					// Track number
					$track_number = i;
					var 
						$this_track = $('li:eq('+i+') .track', $list);

					if ($this_track.hasClass('playing')) {
						$this_track.MPlayer('pause');
					} else {
						$this_track.MPlayer('play');
					}
					_update_list();
					e.preventDefault();
				});
			});

			// Add active class to the first track
			$('#tracklist-nav ul li:eq(0)', $player).addClass('active');
		
			// Navigation
			// Play
			$('.play', $player).on('click', function(e){
				var 
					$this_track = $('li:eq('+$track_number+') .track', $list);

				if ($this_track.hasClass('playing')) {
					$this_track.MPlayer('pause');
				} else {
					$this_track.MPlayer('play');
				}
				e.preventDefault();
			});

			// Next
			$('.next', $player).on('click', function(e){
				if ($track_number < $length) {
					$track_number = $track_number + 1;
					$('li:eq('+$track_number+') .track', $list).MPlayer('play');
					_update_list();
				}
				e.preventDefault();
			});

			// Prev
			$('.prev', $player).on('click', function(e){
				if ($track_number > 0) {
					$track_number = $track_number - 1;
					$('li:eq('+$track_number+') .track', $list).MPlayer('play');
					_update_list();
				}
				e.preventDefault();
			});

			// Details
			if ($display_playlist == 'on') $('#tracklist-nav', $player).show();
			$('.details', $player).on('click', function(e){
				$('#tracklist-nav', $player).slideToggle(400);
				e.preventDefault();
			});


			// Add SM events
			$('#tracklist .track').bind('onfinish', function( event, sound ){
				$('.play', $player).removeClass('pause');
				if ($track_number < $length) {
					$track_number = $track_number + 1;
					_update_list();
				}
			});
			$('#tracklist .track').bind('onplay onloaded', function( event, sound ){
				$('.play', $player).addClass('pause');
			});
			$('#tracklist .track').bind('onpause onstop', function( event, sound ){
				$('.play', $player).removeClass('pause');
			});

		};
	})();


	/* Tooltip
	 ---------------------------------------------------------------------- */
	(function() {

		if (!$.fn.topTip) return;

		// Disable Thumb slide effect on touch devices
		if (Modernizr != 'undefined' && Modernizr.touch) return;

		// Init thumb slider
		$('.tip').topTip();

	})();


	/* Lazy load
	 ---------------------------------------------------------------------- */
	(function() {

		if (!$.fn.lazyload) return;

		// Init lazyload
		$('img.lazy').lazyload();

	})();


	/* Thumb slider
	 ---------------------------------------------------------------------- */
	(function() {

		if (!$.fn.thumbSlider) return;

		// Disable Thumb slide effect on touch devices
		if (Modernizr != 'undefined' && Modernizr.touch) return;

		// Init thumb slider
		$('.thumb-slide').thumbSlider();

	})();


	/* Widgets function
	 ---------------------------------------------------------------------- */
	(function() {

		// Add span tag to the widgets lists
		$('.widget_categories a, .widget_archive a, .widget_recent_entries a, .widget_meta a, .widget_nav_menu a, .widget_pages a, .widget_links a').append('<span></span>');

	})();


	/* Detect Touch Device
	 ---------------------------------------------------------------------- */
	(function() {
		if (Modernizr == 'undefined') return;

		if (Modernizr.touch) {

			$('body').addClass('touch-device');

		}

	})();


	/* Nivo Slider
	 ---------------------------------------------------------------------- */
	(function() {
		if ($.fn.nivoSlider == 'undefined') return;

		$(window).load(function() {
			// Add slider filter effect for touch devices
			var $nivo_effect = 'random';
			if (Modernizr != 'undefined' && Modernizr.touch) $nivo_effect = 'fade';

			$('.nivo-slider').each(function(i){
				if ($nivo_effect != 'fade') $nivo_effect = $(this).data('effect');
	        	$(this).nivoSlider({
	        		effect: $nivo_effect, // Specify sets like: 'fold,fade,sliceDown'
					slices: $(this).data('slices'), // For slice animations
					boxCols: $(this).data('boxcols'), // For box animations
					boxRows: $(this).data('boxrows'), // For box animations
					animSpeed: $(this).data('animspeed'), // Slide transition speed
					pauseTime: $(this).data('pausetime'), // How long each slide will show
					startSlide: 0, // Set starting Slide (0 index)
					directionNav: $(this).data('nav'), // Next & Prev navigation
					directionNavHide: false, // Only show on hover
					controlNav: false, // 1,2,3... navigation
					controlNavThumbs: false, // Use thumbnails for Control Nav
					pauseOnHover: true, // Stop animation while hovering
					manualAdvance: $(this).data('manual_advance'), // Force manual transitions
					prevText: 'Prev', // Prev directionNav text
					nextText: 'Next', // Next directionNav text
					randomStart: false, // Start on a random slide
					beforeChange: function(){}, // Triggers before a slide transition
					afterChange: function(){}, // Triggers after a slide transition
					slideshowEnd: function(){}, // Triggers after all slides have been shown
					lastSlide: function(){}, // Triggers when last slide is shown
					afterLoad: function(){} // Triggers when slider has loaded
	        	});
			});

    	});

	})();


	/* Fancybox (Lightbox)
	 ---------------------------------------------------------------------- */
	(function() {
		if ($.fn.fancybox == 'undefined') return;
		
		// Woocemmerce fix
		$('a[data-rel*="prettyPhoto[product-gallery]"]').each(function(){
      		$( this ).addClass('imagebox').attr('data-group', 'product-gallery');

		})
		// Add Fancybox only for images
		$('.imagebox').fancybox({
			overlayOpacity : .8,
			overlayColor: '#000'
		});

		// Add Fancybox only for media
		$('.mediabox').fancybox({

			type: 'iframe',
			centerOnScroll : true,
			autoScale : true,
			overlayOpacity : .8,
			overlayColor: '#000',
		
			onStart : function(e, selectedIndex) {
				var 
					$el = $(e[selectedIndex]);

				if ($el.data('width') != 'auto')
					this.width = $el.data('width');
				if ($el.data('height') != 'auto')
					this.height = $el.data('height');
        	}
		});

	})();


	/* Masonry boxes
	 ---------------------------------------------------------------------- */
	(function() {
		if (!$.fn.isotope) return;

		$(window).load(function() {

			$('.masonry-wrap').isotope({
				masonry : {
			        columnWidth : 1,
					gutterWidth: 2,
			    },
			    masonryHorizontal: {
			    	rowHeight: 3
			  	}
			});	
			
    	});

	})();


	/* Countdown
	 ---------------------------------------------------------------------- */
	(function() {
		if (!$.fn.countdown) return;

		$('.countdown, .header-countdown').each(function(e) {
			var date = $(this).data('event-date');

	        $(this).countdown(date, function(event) {
	            var $this = $(this);

	            switch(event.type) {
	                case "seconds":
	                case "minutes":
	                case "hours":
	                case "days":
	                case "weeks":
	                case "daysLeft":
	                    $this.find('.' + event.type).html(event.value);
	                    break;

	                case "finished":
	              
	                    break;
	            }
	        });
    	});

      // Helper function that add 0 before number
      function pad (str, max) {
  			return str.length < max ? pad('0' + str, max) : str;
		}
		
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

			// Check elements number 
			if ($('li', $stats).length < 6) return;

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

				var _display = setInterval(function(){

					var num = random_list[i];
						stat_name = $('li', $stats).eq(i).find('.stat-name');
						stat_name.animate({ opacity : 0}, 400, 'easeOutQuart', function(){
							$(this).text($stats_names[num]);
							$(this).css({left : '-100%', opacity : 1});
							$(this).animate({ left : 0}, 400, 'easeOutQuart');
						});
						
						stat_value = $('li', $stats).eq(i).find('.stat-value');
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


	/* Number counter
	 ---------------------------------------------------------------------- */
	(function() {

		function num_count(el) {
			var 
				el = $(el),
				num = parseInt(el.data('number')),
				counter = 1,
				delta = 1,
				new_num;

			el.text('');

			// Delta
			if (num <= 100) delta = 2;
			else if (num > 100 && num <= 500) delta = 12;
			else delta = 20;

			var _display = setInterval(function(){

				counter = counter+delta;
				new_num = counter;
				el.text(new_num);

				if (new_num >= num) {
					clearInterval(_display);
					el.text(num);
				}
				
			},40);
		}

		// Events count, 404
		num_count('.events-count, #error-404 span');
		
	})();


	/* Main Navigation
	 ---------------------------------------------------------------------- */
	(function() {

		var 
			$nav            = $('#main-nav').children('ul'),
			$responsive_nav = '<option value="" selected>'+theme_vars.navigate_text+'</option>',
			$top_nav            = $('#top-nav'),
			$responsive_top_nav = '<option value="" selected>'+theme_vars.navigate_text+'</option>';
		
		// Create main navigation
		$('li', $nav).on('mouseenter', function() {
			var 
				$this = $(this),
				$sub  = $this.children('ul');
			if ($sub.length) $this.addClass('active');
			$sub.hide().stop(true, true).fadeIn(200);
		}).on('mouseleave', function() {
			$(this).removeClass('active').children('ul').stop(true, true).fadeOut(50);
			if (typeof Cufon != 'undefined') Cufon.refresh();
		});

		// Responsive main navigation
		$nav.find('li').each(function() {
			var 
				$this   = $(this),
				$a      = $this.children('a'),
				$depth  = $this.parents('ul').length - 1,
				$indent = '';

			if ($depth) {
				while($depth > 0) {
					$indent += '--';
					$depth--;
				}
			}

			$responsive_nav += '<option value="' + $a.attr('href') + '">' + $indent + ' ' + $a.text() + '</option>';
		}).end()
		  .after('<select class="responsive-nav">' + $responsive_nav + '</select>');


		// Responsive top navigation
		$top_nav.find('li').each(function() {
			var 
				$this   = $(this),
				$a      = $this.children('a'),
				$depth  = $this.parents('ul').length - 1,
				$indent = '';

			if ($depth) {
				while($depth > 0) {
					$indent += '--';
					$depth--;
				}
			}

			$responsive_top_nav += '<option value="' + $a.attr('href') + '">' + $indent + ' ' + $a.text() + '</option>';
		}).end()
		  .after('<select class="responsive-nav">' + $responsive_top_nav + '</select>');

		$('.responsive-nav').on('change', function() {
			window.location = $(this).val();
		});



		// Grab the initial top offset of the intro section
	 	if ( theme_vars.sticky_header == 'on' ) {

			var 
				header = $( '#header' ),
				sticky_offset_top = 20;

			var sticky_header = function(){

				var scroll_top = $(window).scrollTop(); // our current vertical position from the top

				if ( scroll_top > sticky_offset_top ) { 
					header.addClass( 'fixed' );
				} else {
					header.removeClass( 'fixed' );
				}   
			};
		
			// and run it again every time you scroll
			$( window ).scroll( sticky_header );

			sticky_header();
		} 
		
	})();


	/* Items Filter
	 ---------------------------------------------------------------------- */

	(function() {

		if (!$.fn.isotope) return;

		var $container = $('.items');

		if ($container.length) {

			var 
				mouseOver;

			// Init Isotope
			$(window).on('load', function() {

				$container.isotope({
					itemSelector : 'article',
					layoutMode: 'fitRows'
				});

			});

			// Add filter event
			function _items_filter($el, $data) {

				// Add all filter class
				$el.addClass('item-filter');

				// Add categories to item classes
				$('article', $container).each(function(i) {
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

					if (typeof Cufon != 'undefined') Cufon.refresh();

					if ($option) {
						if ($option !== '*') $option = $option.replace($option, '.' + $option)
						$container.isotope({ filter : $option });
					}

					e.preventDefault();

				});

				$el.find('a').first().addClass('active');
			}

			// Init filters
			if ($('#cat-filter').length) _items_filter($('#cat-filter'), 'data-categories');
			if ($('#tag-filter').length) _items_filter($('#tag-filter'), 'data-tags');

		}


	})();


	/* Flexible videos
	 ---------------------------------------------------------------------- */
	if ($.fn.fitVids) $('.container').fitVids();


	/* Scroll to top
	 ---------------------------------------------------------------------- */
	(function() {
		if (theme_vars.top_button == 'off') return;
		var
			$title         = 'Back to Top',
			$displayHeight = 200,
			$speed         = 800,
			$fixedPos      = true;

		// Detect if mobile browser support fixed position
		if (/(iPhone|iPod|iPad)\sOS\s[0-4][_\d]+/i.test(navigator.userAgent))
			$fixedPos= false;
		if (/Android\s+([0-2][\.\d]+)/i.test(navigator.userAgent))
			$fixedPos = false;
		
		// Append scroll button
		$('body').append('<a href="#" id="scroll-button" title="' + $title + '" class="hidden">'+ $title + '</a>');

		$('#scroll-button').click(function(e){
				$('html, body').animate({ scrollTop : 0 }, $speed, 'easeOutExpo');

				e.preventDefault();
			});

		$(window).scroll(function() {
			var $pos = $(window).scrollTop();

			if (!$fixedPos) {
				$('#scroll-button').css({
					position : 'absolute',
					top      : $pos+20
				});
			}

			if ($pos > $displayHeight)
				$('#scroll-button').removeClass('hidden');
			else 
				$('#scroll-button').addClass('hidden');
		});

	})();


	/*	Sharee plugin
	 ---------------------------------------------------------------------- */
	(function() {
		if (!$.fn.sharrre) return;

		$('#share').sharrre({
			share: {
				googlePlus 	: true,
				facebook 	: true,
				twitter 	: true,
				digg 		: false,
				delicious 	: false
			},
			url: theme_vars.theme_uri,
			enableTracking	: true,
			urlCurl : '',
			buttons: {
				googlePlus	: {size: 'tall', annotation:'bubble'},
				facebook	: {layout: 'box_count'},
				twitter 	: {count: 'vertical'},
				digg 		: {type: 'DiggMedium'},
				delicious 	: {size: 'tall'}
			},
			hover : function(api, options){
				$(api.element).find('.buttons').show();
			},
			hide : function(api, options){
				$(api.element).find('.buttons').hide();
			}
		});

	})();


	/* Gmap
	 ---------------------------------------------------------------------- */
	(function() {
		if ( ! $.fn.gmap3 ) return;

		var $gmap = $('#gmap');

		if ($gmap.length) {
			$map_address = $gmap.data('address');
			$gmap.gmap3({
				address: $map_address,
				zoom: 16,
				zoomControl: true, // Use map zoom. Default: true
				scrollwheel: false, // Enable mouse scroll whell for map zooming: Default: false
				mapTypeId : google.maps.MapTypeId.ROADMAP,
				mapTypeControlOptions: {
		          mapTypeIds: [google.maps.MapTypeId.ROADMAP, "style1"]
		        }
			}).marker({
				address: $map_address
		    });

		}

	})();
	

	/* Contact Form
	 ---------------------------------------------------------------------- */
	(function() {

		var 
			$form   = $('.contact-form'),
			$ajax_loader = '<img src="'+theme_vars.skin_img_path+'/loader.gif" height="11" width="16" alt="Loading..." />';

		$form.append('<div id="ajax-message" class="hidden"></div>');
		var $ajax_message = $('#ajax-message');
		
		// Submit click event
		$form.on('click', 'input[type=submit]', function(e){

			$ajax_message.hide().html($ajax_loader).show();

			// Ajax request
			$.ajax({
			   type: 'POST',
		      async: true,
		      cache: false,
				global: false,
				dataType : 'html',
				url: ajax_action.ajaxurl,
				data: {
			      action: 'r_form',
					ajax_nonce : ajax_action.ajax_nonce,
					order: $form.serialize()
				},
				success: function(data) {
					// Show ajax-message
					$ajax_message.html(data);
					if (data.indexOf("success") != -1) {
						clear_form_elements($form);
					}
				},
				error: function(data) {
					console.log("Error: " + data);
				}
			});
			e.preventDefault();
		});

		function clear_form_elements(el) {

		    $(el).find(':input').each(function() {
		        switch(this.type) {
		            case 'password':
		            case 'select-multiple':
		            case 'select-one':
		            case 'text':
		            case 'email':
		            case 'textarea':
		                $(this).val('');
		                break;
		            case 'checkbox':
		            case 'radio':
		                this.checked = false;
		        }
		    });

		}

	})();

});