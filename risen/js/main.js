/**
 * Main JavaScript
 */

// Document is loaded...
jQuery(document).ready(function($) {

	// Do not run JS for old versions of IE
	// See bottom of file for IE6/7 alert and redirect
	if (!bad_ie) {

		/******************************************
		 * LAYOUT
		 ******************************************/

		// Retina Logo
		// Set dimensions from normal image on retina logo element for proper sizing
		// CSS handles switching between two images with media queries
		// This method works best for Opera Mobile
		if ( $( '#logo-hidpi' ).length ) { // Retina version provided
			$( '<img>' ).attr( 'src', $( '#logo-regular' ).attr( 'src' ) ).load( function() {
				$( '#logo-hidpi' ).attr( 'width', this.width ).attr( 'height', this.height );
			} );
		}

		// Header Menu
		if ($('#header-menu-links').children().length > 0) { // menu is not empty

			// SelectNav.js converts menu to single <select> dropdown for small screens (mobile devices)
			if (!($.browser.mozilla && parseInt($.browser.version) <= 8)) { // FF8 and earlier fail, but that's okay since not mobile
				selectnav('header-menu-links', {
					label: risen_wp.mobile_menu_label,
					nested: true,
					indent: '&ndash;',
					autoselect: false
				});
			}

			// Superfish Dropdowns (for regular screens)
			activate_menu();

		}

		// Hide menu icons if they will cause a second line after resize
		var icons_inverval = setInterval(function() { // first page load (wait a moment for fonts to load)
			show_hide_menu_icons(); // in case menu changed size because of font
		}, 200); // keep trying to hide icons (font must be rendered for it to work)
		setTimeout(function() {
			clearInterval(icons_inverval);
		}, 3000); // stop trying to hide icons after a few seconds
		$(window).resize(function() { // check after resize
			show_hide_menu_icons();
		});

		// Fade in and out on hover
		if (!Modernizr.touch) { // touch devices cannot hover

			var fade_speed = fade_duration(350);
			var fade_opacity = 0.6;

			// Icons - fade in on hover
			if (!old_ie) {

				$('.single-icon')
					.fadeTo(fade_speed, fade_opacity) // first load, fade out
					.hover(function() { // hover in
						$(this).stop().fadeTo(fade_speed, 1);
					}, function() { // hover out
						$(this).stop().fadeTo(fade_speed, fade_opacity);
					});

				// Fade icon when hovering text label to right (like "<a class="single-icon">ICON</a><a class="icon-fade-prev"># Comments</a>")
				$('.risen-icon-label')
					.hover(function() { // hover in
						$(this).prev('.single-icon').stop().fadeTo(fade_speed, 1);
					}, function() { // hover out
						$(this).prev('.single-icon').stop().fadeTo(fade_speed, fade_opacity);
					});

			}

			// Images fade out on hover if linked
			$('.image-frame')
				.hover(function() { // hover in
					$('a img', this).stop().fadeTo(fade_speed, fade_opacity);
				}, function() { // hover out
					$('a img', this).stop().fadeTo(fade_speed, 1);
				});

		}

		// Fade header images in on load
		if (!Modernizr.touch) { // unless touch device (probably mobile), for performance (Chrome, Safari mobile sometimes images don't load)
			$('.page-header-image').each(function(index) {
				if ($(this).length) {
					var img_rand = '';
					if (old_ie) { // unique qstring appended to bust cache for IE8 (not others; Firebug serves up "inconsistent URL's warning")
						var img_rand = '?rand=' + new Date().getTime();
					}
					$(this).attr('src', $(this).attr('src') + img_rand).load(function() {
						$(this).hide().css('visibility', 'visible').fadeTo(fade_duration(1000), 1); // visibility hidden/visible makes img retain height to avoid "jump" before fade in
					});
				}
			});
		}

		/******************************************
		 * HOMEPAGE
		 ******************************************/

		// Homepage Slider
		if (risen_wp.is_home && risen_wp.slider_enabled && $('.flexslider').length) {

			// Load Flexslider
			// See options here: http://www.woothemes.com/flexslider/
			$(window).load(function() { // after images loaded

				// Enable or disable automatic slideshow based on theme options
				var enable_slideshow = risen_wp.slider_slideshow;

				// If only one slide, add a second slide; otherwise slider will not initialize and video will not work properly (controls will be hidden after initialization)
				var single_slide = false;
				if ($('.flexslider ul li').length == 1) {
					single_slide = true;
					enable_slideshow = false; // disable because only one slide (don't show hidden slide)
					$('.flexslider ul').append('<li></li>');
				}

				// Initialize slider
				$('.flexslider').flexslider({
					slideshow: enable_slideshow,					// Boolean: Animate slider slideshow
					slideshowSpeed: risen_wp.slider_speed,			// Integer: Set the speed of the slideshow cycling, in milliseconds
					directionNav: false,							// Boolean: Create navigation for previous/next navigation? (true/false)
					start: function(slider) { // when first slide loads

						// Hide controls if only one slide (see "if only only slide" above)
						if (single_slide) {
							$('.flex-control-nav').hide();
						}

						// Hover to lower opacity and fade in play button
						var fade_speed = fade_duration(350);
						var fade_opacity = 0.6;
						if (!Modernizr.touch) { // not for mobile devices that cannot hover
							$('.flex-video-slide')
								.hover(function() { // hover in

									// fade image and caption out, play button in
									if ($('.flex-image-container', this).is(':visible')) { // don't fade if it was hidden during video playback
										$('.flex-image-container img, .flex-caption', this).stop().fadeTo(fade_speed, fade_opacity);
										$('.flex-play-overlay', this).stop().fadeIn();
									}


									// fade caption in on hover and return to faded out on mouse out
									$('a.flex-caption', this) // only if it's linked somewhere other than video source
										.hover(function() { // hover in
											$(this).stop().fadeTo(fade_speed, 1);
										}, function() { // hover out
											$(this).stop().fadeTo(fade_speed, fade_opacity);
										});

								}, function() { // hover out

									// fade image and caption back in, play button out
									if ($('.flex-image-container', this).is(':visible')) { // don't fade if it was hidden during video playback
										$('.flex-image-container img, .flex-caption', this).stop().fadeTo(fade_speed, 1);
										$('.flex-play-overlay', this).stop().fadeOut();
									}

								});
						} else { // for mobile touch devices always show "Play" overlay since cannot hover
							$('.flex-play-overlay').stop().fadeTo(0, fade_opacity);
						}

						// Play video slide on click (regular)
						$('.flex-play-overlay').click(function(event) { // clicked image of video slide in order to play video

							event.preventDefault();

							var slide_element = $(this).parents('.flex-video-slide');
							var slide_id = slide_element.attr('id');
							var video_url = $(this).parent('a').attr('href');
							var video_html = '';

							// Vimeo
							if (video_url.indexOf('vimeo') > -1) {

								// Extract video ID from Vimeo URL and build HTML for player
								var match = video_url.match(/\d+/);
								if (match && match[0].length) {
									var vimeo_id = match[0];
									var video_html = '<iframe src="' + risen_wp.current_protocol + '://player.vimeo.com/video/' + vimeo_id + '?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff&amp;autoplay=1" width="960" height="350" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
								}

							}

							// YouTube
							else if (video_url.indexOf('youtu') > -1) { // match youtube.com or youtu.be

								// Get video ID from YouTube URL and build HTML for player
								// ID extraction from jeffreypriebe, Lasnv, WebDev and Chris Nolet at http://stackoverflow.com/a/8260383
								var match = video_url.match(/.*(?:youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=)([^#\&\?]*).*/);
								if (match && match[1].length == 11){
									var youtube_id = match[1];
									var video_html = '<iframe src="' + risen_wp.current_protocol + '://www.youtube.com/embed/' + youtube_id + '?wmode=transparent&amp;autoplay=1&amp;rel=0&amp;showinfo=0&amp;color=white&amp;modestbranding=1" width="960" height="350" frameborder="0" allowfullscreen></iframe>';
								}

							}

							// Show the video
							if (video_html) {

								// Pause slideshow
								slider.pause();

								// Hide slide image (contains "play" overlay) and caption
								$('.flex-image-container, .flex-caption', slide_element).hide();

								// Inject the video iframe
								$(slide_element).append(video_html);

							}

						});

					},
					before: function() { // Before slide changes

						// Destroy all video iframes
						$('.flex-video-slide iframe').remove();

						// Show image and caption again, make sure faded to 100% as well
						$('.flex-image-container, .flex-image-container img, .flex-caption').show().fadeTo(0, 1); // may be partially faded out from hover on video slide

						// Hide play button overlay
						if (!Modernizr.touch) { // except if we're using movile touch - no hover so want "play" overlay to show for clicking
							$('.flex-play-overlay').hide();
						}

					}
				});

			});

		}

		/******************************************
		 * MULTIMEDIA (Sermons)
		 ******************************************/

		// Audio Player (MediaElement.js)
		if ($('#multimedia-single-media-player .audio-container audio').length) {

			// Make player responsive
			$( "#multimedia-single-media-player .audio-container audio" ).css( 'max-width', '100%' );

			// Snap volume control back into place after resize
			$(window).bind('load debouncedresize', function() {
				$('.mejs-time-rail').width( $('.mejs-time-rail').width() - 2 );
			});

		}

		/******************************************
		 * GALLERY (Photos & Videos)
		 ******************************************/

		/* Thumbnail hover icons */
		if (!Modernizr.touch) { // touch devices cannot hover (icons simply show by default using Modernizr .touch class)
			$('.thumb-grid-item').hover(
				function() { // hover in
					$('.thumb-grid-buttons', this).stop().fadeIn(fade_duration());
				}, function() { // hover out
					$('.thumb-grid-buttons', this).stop().hide();
				}
			);
		}

		/* Click icon for details page */
		$('.thumb-grid-details-button').click(function(event) {

			// stop parent link or lightbox on thumbnail from firing
			event.preventDefault();
			event.stopPropagation();

			var url = $(this).attr('data-href');

			if (url) {
				window.location.href = url;
			}

		});

		/******************************************
		 * LIGHTBOX (prettyPhoto)
		 ******************************************/

		if ($("a[data-rel^='lightbox']").length) {

			// Prepare thumbnail grid for lightbox
			// Set thumbnail href as full-size image URL
			// URL is by default post permalink for search engines and JS-disabled browsers
			$(".thumb-grid a[data-rel^='lightbox']").each(function(index) {

				// Get image or video URL
				var media_url = $('.thumb-grid-lightbox-button', this).attr('data-href');

				// Set URL on thumb link
				$(this).attr('href', media_url);

			});

			// Open lightbox on thumbnail click
			// prettyPhoto (http://www.no-margin-for-errors.com/projects/prettyphoto-jquery-lightbox-clone/)
			var lightbox_opened;
			$("a[data-rel^='lightbox']").prettyPhoto({ // fire it up

				// lightbox config
				opacity: 0.8,
				default_width: 640, // default size mainly for videos
				default_height: 360,
				horizontal_padding: 0, // enough for border/shadow (makes for nicer transitions)
				slideshow: false, // too many buttons
				allow_resize: true, // enables auto-fit
				overlay_gallery: false, // unnecesary (sometimes buggy)
				deeplinking: false, // unreliable URLs if add/remove images
				social_tools: '', // requires deeplinking

				// custom lightbox container
				markup: '<div class="pp_pic_holder"> \
							<div class="pp_content_container"> \
								<div class="pp_content"> \
									<div class="pp_loaderIcon"></div> \
									<div class="pp_fade"> \
										<a href="#" class="pp_expand" title="' + risen_wp.lightbox_expand + '">' + risen_wp.lightbox_expand + '</a> \
										<div class="pp_hoverContainer"> \
											<a class="pp_next" href="#">' + risen_wp.lightbox_next + '</a> \
											<a class="pp_previous" href="#">' + risen_wp.lightbox_prev + '</a> \
										</div> \
										<div id="pp_full_res"></div> \
										<div class="pp_details"> \
											<div class="ppt">&nbsp;</div> \
											<div class="pp_nav"> \
												<!--<div class="currentTextHolder">0/0</div>--> \
												<a href="#" class="pp_arrow_previous">' + risen_wp.lightbox_prev + '</a> \
												<a href="#" class="pp_arrow_next">' + risen_wp.lightbox_next + '</a> \
												<a href="#" class="pp_close">' + risen_wp.lightbox_close + '</a> \
											</div> \
											<!--<p class="pp_description"></p>--> \
										</div> \
									</div> \
								</div> \
							</div> \
						</div> \
						<div class="pp_overlay"></div>',

				// after image/video changed
				changepicturecallback: function() {

					// show rounded corners (they are removed within modified jquery.prettyPhoto.js before transition for better performance)
					$('.pp_content').addClass('rounded_corners');

				}

			});

			// Resize lightbox after window resize
			$(window).resize(function() {

				if ($('.pp_overlay').length) { // only when lightbox is open

					var no_title = $('.ppt').css('visibility') =='hidden' ? true : false; // is title hidden because of media query?

					// hide title and nav when resizing
					$('.ppt').css('left', '-99999px');
					$('.pp_nav').css('visibility', 'hidden');

					// resize lightbox only every few milliseconds instead of continuously during resize
					$.doTimeout('resize', 400, function() {

						// reload current item
						$.prettyPhoto.changePage(set_position);

						// wait a moment for transition to finish
						$.doTimeout(500, function() {

							//scroll up/down to smooth out artifacts from drastic downsizing (Chrome at least)
							window.scrollBy(0, 1);
							window.scrollBy(0, -1);

							// re-show title and nav
							$('.pp_nav').css('visibility', 'visible');
							if (!no_title) { // dont show title if hidden by media query
								$('.ppt').css('left', '0px');
							}

						});

					});

				}

			});

		}

		/******************************************
		 * COMMENTS
		 ******************************************/

		// Scroll to comments when comments link at top of single page/post clicked
		if ($('a.scroll-to-comments').length) {
			$('a.scroll-to-comments').smoothScroll({
				easing: 'easeOutCirc',
				speed: 1200
			});
		}

		// Comment Validation using jQuery Validation Plugin by Jörn Zaefferer
		// http://bassistance.de/jquery-plugins/jquery-plugin-validation/
		if (jQuery().validate) { // if plugin loaded
			$('#commentform').validate({
				rules: {
					author: {
						required: risen_wp.comment_name_required != '' ? true : false // if WP configured to require
					},
					email: {
						required: risen_wp.comment_email_required != '' ? true : false, // if WP configured to require
						email: true // check validity
					},
					url: 'url', // optional but check validity
					comment: 'required'
				},
				messages: { // localized error strings
					author: risen_wp.comment_name_error_required,
					email: {
						required: risen_wp.comment_email_error_required,
						email: risen_wp.comment_email_error_invalid
					},
					url: risen_wp.comment_url_error_invalid,
					comment: risen_wp.comment_message_error_required
				}
			});
		}

		/**************************************
		 * CONTACT FORM
		 **************************************/

		// If contact= is used in query string, scroll down to the form
		if ($('#contact-form').length) { // we're on the contact page

			// scroll to contact form if ?contact=whatever is used in URL
			if (getParameterByName('contact')) {

				setTimeout(function() {

					$.smoothScroll({
						scrollTarget: '#contact-form',
						easing: 'easeOutCirc',
						speed: 1200
					});

				}, 1000);

			}

		}

		//  Enable Submit Button (which is really <a>)
		$('#contact-button').click(function(event) {

			// stop regular click action
			event.preventDefault();

			// submit form naturally
			$('#contact-form').submit();

		});

		// Process Contact Form Submission
		$('#contact-form').submit(function() {

			// post form data with AJAX
			$.ajax({
				type: 'POST',
				url: risen_wp.ajax_url, // WordPress's admin-ajax.php
				data: 'action=risen-contact-form-submit'
						+ '&nonce=' + risen_wp.contact_form_nonce
						+ '&' + $('#contact-form').serialize(), // send form data, nonce and action representing WordPress hook to fire
				dataType: 'script'
			});

			// reload recaptcha
			if (typeof grecaptcha != 'undefined') { // using reCAPTCHA
				grecaptcha.reset();
			}

			// stop regular submit action
			return false;

		});

		/**************************************
		 * SEARCH
		 **************************************/

		// Submit on link button click
		$('.search-button').click(function(event) {

			event.preventDefault();

			$(this).parent('form').submit();

		});


		/**************************************
		 * HASH SCROLLING
		 **************************************/

		// If #bob-smith is used in URL, smooth scroll to that ID
		// If #north-campus is used in URL, smooth scroll to that ID
		if ($('#staff-posts').length || $('#location-posts').length) { // we're on the staff or locations page

			// scroll to person if #bob-smith is used in URL
			if (location.hash) {

				setTimeout(function() {

					$.smoothScroll({
						scrollTarget: location.hash,
						easing: 'easeOutCirc',
						speed: 1200
					});

				}, 1000);

			}

		}

		/**************************************
		 * WIDGETS
		 **************************************/

		// Categories (Enhanced) Dropdown Redirect
		$('.dropdown-taxonomy-redirect').change(function() {

			var taxonomy = $(this).prev('input[name=taxonomy]').val();
			var taxonomy_id = $('option:selected', this).val();

			if (taxonomy && taxonomy_id) {
				location.href = risen_wp.home_url + '/?redirect_taxonomy=' + taxonomy + '&id=' + taxonomy_id;
			}

		});

		/**************************************
		 * TABBED CONTENT (Shortcode)
		 **************************************/

		var tab_active_class = 'tabber-active';

		// Loop each instance of tabbed content
		$('.tabber').each(function() {

			var tabs_wrapper = this;
			var tabs = $('> ul li', tabs_wrapper);

			// Make sure only one active tab is set
			var active_tab_set = false;
			$(tabs).each(function(index) {

				// Tab is active
				if ($(this).hasClass('tabber-active')) {

					// Another was already set
					if (active_tab_set) {

						// hide tab
						$(this).removeClass('tabber-active');

						// hide corresponding content
						$($('> div > div', tabs_wrapper).get(index)).removeClass('tabber-active');

					}

					// Make sure corresponding content is active
					else {
						$('> div > div', tabs_wrapper).removeClass('tabber-active'); // hide all
						$($('> div > div', tabs_wrapper).get(index)).addClass('tabber-active'); // show this
					}

					// Allow only one active tab
					active_tab_set = true;

				}

			});

			// Switch tabs on click
			tabs.click(function() {

				// if clicked tab was not self
				if (!$(this).hasClass(tab_active_class)) {

					// show clicked <li> as active
					tabs.removeClass(tab_active_class);
					$(this).addClass(tab_active_class);

					// show corresponding content
					var index = tabs.index($(this));
					$($('> div > div', tabs_wrapper).hide().get(index)).fadeTo(500, 1); // fadeTo looks better than fadeIn in IE7

				}

			});

		});

		// CSS fixes for IE8 which doesn't support :not or :last-child
		$('.tabber > div > div > :last-child').css('margin-bottom', '0');
		$('.tabber > div > div:not(.' + tab_active_class + ')').hide();

		/******************************************
		 * ACCORDION (Shortcode)
		 **************************************/

		var accordion_active_class = 'accordion-active';

		// Loop each instance
		$('.accordion').each(function() {

			var accordion_wrapper = this;
			var sections = $('> section', accordion_wrapper);

			// Make sure only one active section on load
			var active_section_set = false;
			$(sections).each(function(index) {

				// Section is active
				if ($(this).hasClass('accordion-active')) {

					// Another was already set
					if (active_section_set) {
						$(this).removeClass('accordion-active'); // hide section
					}

					// Allow only one active section
					active_section_set = true;

				}

			});

			// Click on section
			$('.accordion-section-title', sections).click(function() {

				var section = $(this).parent();

				// if clicked section was not self
				if (!$(section).hasClass(accordion_active_class)) {

					// hide all section content
					$('.accordion-content', sections).hide();

					// show current section content
					$('.accordion-content', section).hide().fadeTo(500, 1); // fadeTo looks better than fadeIn in IE7

					// move active class to new active section
					sections.removeClass(accordion_active_class);
					$(section).addClass(accordion_active_class);

				}

				// if it was self, close it
				else {
					$('.accordion-content', sections).hide();
					sections.removeClass(accordion_active_class);
				}

			});

		});

		// CSS fixes for IE8 which doesn't support :not or :last-child
		$('.accordion section .accordion-content > :last-child').css('margin-bottom', '0');
		$('.accordion section:not(.' + accordion_active_class + ') .accordion-content').hide();

		// Mysterious IE8 layout bug fix
		// http://stackoverflow.com/questions/3350441/dynamic-elements-are-not-appearing-in-ie8-until-there-is-a-mouse-click
		$('.accordion section').addClass('dummyclass').removeClass('dummyclass');

		/******************************************
		 * OTHER SHORTCODES
		 **************************************/

		// Columns IE7/8 CSS help
		$('.columns > div > .column-content > :last-child').css('margin-bottom', '0'); // :last-child not supported

		// Boxes IE7/8 CSS help
		$('.shortcode-box > :last-child, .risen-icon-message-content :last-child').css('margin-bottom', '0'); // :last-child not supported

		/**************************************
		 * RESPONSIVE EMBEDS
		 **************************************/

		// Remove <object> element from Blip.tv ( use iframe only ) - creates a gap w/FitVid
		$( "embed[src*='blip.tv']" ).remove();

		// Use FitVid for responsive videos and other embeds
		// YouTube and Vimeo work out of the box
		// Rdio and Spotify are correct when loading at final size ( browser resize is bad demo )
		$( 'body' ).fitVids( { // content and sidebar
			customSelector: [
				"iframe[src*='youtu.be']",
				"iframe[src*='blip.tv']",
				"iframe[src*='hulu.com']",
				"iframe[src*='dailymotion.com']",
				"iframe[src*='revision3.com']",
				"iframe[src*='slideshare.net']",
				"iframe[src*='scribed.com']",
				"iframe[src*='viddler.com']",
				"iframe[src*='rd.io']",
				"iframe[src*='rdio.com']",
				"iframe[src*='spotify.com']"
			]
		} );

		// Other embedded media only need max-width: 100% ( height is static ) - SoundCloud, MediaElement.js, etc.
		// Important: when done via stylesheet, MediaElement.js volume control flickers
		$( "iframe[src*='soundcloud.com'], iframe[src*='snd.sc'], .wp-video-shortcode, .wp-audio-shortcode" ).css( 'max-width', '100%' );

		/**************************************
		 * FEATURE DETECTION
		 **************************************/

		// If browser supports HTML5 placeholder input attribute then
		// add .placeholder class to doc so can detect in CSS
		if ('placeholder' in document.createElement('input')) {
			$('html').addClass('placeholder');
		}

	}

});

// Activate menu
function activate_menu() {

	// Initialize dropdowns
	jQuery('.sf-menu').supersubs({ // Superfish dropdowns
		minWidth: 11,	// minimum width of sub-menus in em units
		maxWidth: 14,	// maximum width of sub-menus in em units
		extraWidth: 1 	// extra width can ensure lines don't sometimes turn over due to slight rounding differences and font-family
	}).superfish({
		delay: 0,
		disableHI: false,
		speed: 350,
		animation: {	// fade in and slide down
			opacity: 'show',
			height: 'show'
		}
	});

}

// Hide menu bar's social icons if they will shown on second line
function show_hide_menu_icons() {

	// not necessary if mobile <select> menu is visible (social icons already hidden by CSS media query)
	if (jQuery('.selectnav').is(':visible')) {
		jQuery('#header-icons').hide(); // if resize is very fast sometimes media query misses, so this is a safety net
	} else {

		var header_menu_icons_visible = jQuery('#header-icons').is(':visible');
		var header_menu_inner_width = jQuery('#header-menu-inner').width();
		var header_menu_links_icons_width = jQuery('#header-menu-links').width() + jQuery('#header-icons').width() + 20; /* 20px pad for wider trigger zone */

		// if menu link and menu icon containers have same total width as their container, hide icons so they don't appear on second line
		if (header_menu_links_icons_width >= header_menu_inner_width) {
			if (header_menu_icons_visible) {
				jQuery('#header-icons').hide();
			}
		}

		// show icons if there is room again
		else if (!header_menu_icons_visible) {
			jQuery('#header-icons').show();
		}

	}

}

// Load a Google Map
function initMap(id, lat, lng, type, zoom) {

	jQuery(document).ready(function($) {

		// is map being used? have coordinates?
		if ($('#' + id).length && lat && lng) {

			// Location Latitude / Longitude
			var latlng = new google.maps.LatLng(lat, lng);

			// Map Type
			var map_type = google.maps.MapTypeId.HYBRID;
			if (type == 'ROADMAP') {
				map_type = google.maps.MapTypeId.ROADMAP;
			} else if (type == 'SATELLITE') {
				map_type = google.maps.MapTypeId.SATELLITE;
			} else if (type == 'TERRAIN') {
				map_type = google.maps.MapTypeId.TERRAIN;
			}

			// Zoom
			zoom = zoom ? zoom : 14; // default

			// Load the Map
			var map = new google.maps.Map(document.getElementById(id), {
				zoom: parseInt(zoom),
				mapTypeId: map_type, // ROADMAP, SATELLITE, HYBRID or TERRAIN
				disableDefaultUI: true, // remove map controls
				scrollwheel: false,
				draggable: false, // this can catch on mobile page touch-scrolling
				disableDoubleClickZoom: true,
				center: latlng,
				styles: [{ // hide business name labels
					featureType: "poi",
					stylers: [{
						visibility: "off"
					}]
				}]
			});

			// Custom Marker
			var image = new google.maps.MarkerImage(risen_wp.theme_uri + '/images/map-icon.png',
				new google.maps.Size(26, 26),
				new google.maps.Point(0,0),
				new google.maps.Point(13, 26));
			var shadow = new google.maps.MarkerImage(risen_wp.theme_uri + '/images/map-icon-shadow.png',
				new google.maps.Size(40, 26),
				new google.maps.Point(0,0),
				new google.maps.Point(13, 26));
			var marker = new google.maps.Marker({
				position: latlng,
				map: map,
				clickable: false,
				icon: image,
				shadow: shadow
			});

			// Keep marker centered on window resize
			google.maps.event.addDomListener(window, 'resize', function() {
				map.setCenter(latlng);
			});

			// Maps in hidden elements (Accordion, Tabs) must be re-initialized for correct size
			$($('#' + id)).parents('.tabber, .accordion').click(function() {
				initMap(id, lat, lng, type, zoom);
			});

		}

	});

}

// Old Versions Internet Explorer
var ie = false;
var old_ie = false;
var bad_ie = false;
if (jQuery.browser.msie) {

	// Get version
	ie = parseInt(jQuery.browser.version);

	// Disable certain effects for IE8
	if (ie == 8) {
		old_ie = true;
	}

	// Prompt Internet Explorer 6/7 users to upgrade
	else if (ie <= 7) {

		bad_ie = true;

		// Don't let anything show
		jQuery(document).ready(function($) {
			$('body').empty().css('background', 'none');
		});

		// Tell user to upgrade to a modern browser
		alert( risen_wp.ie_unsupported_message );

		// Redirect to a site with upgrade details
		window.location = risen_wp.ie_unsupported_redirect_url;

	}

}

// No fade effect for IE8 -  things get ugly
function fade_duration(duration) {

	if (!duration) {
		duration = 'fast';
	}

	if (old_ie) {
		duration = 0;
	}

	return duration;

}

// Get query string value by name by Jame Padolsey
// From http://stackoverflow.com/questions/901115/get-query-string-values-in-javascript/5158301#5158301
function getParameterByName(name) {
	var match = RegExp('[?&]' + name + '=([^&]*)').exec(window.location.search);
	return match ? decodeURIComponent(match[1].replace(/\+/g, ' ')) : null;
}

/*
 * jQuery doTimeout: Like setTimeout, but better! - v1.0 - 3/3/2010
 * http://benalman.com/projects/jquery-dotimeout-plugin/
 *
 * Copyright (c) 2010 "Cowboy" Ben Alman
 * Dual licensed under the MIT and GPL licenses.
 * http://benalman.com/about/license/
 */
(function($){var a={},c="doTimeout",d=Array.prototype.slice;$[c]=function(){return b.apply(window,[0].concat(d.call(arguments)))};$.fn[c]=function(){var f=d.call(arguments),e=b.apply(this,[c+f[0]].concat(f));return typeof f[0]==="number"||typeof f[1]==="number"?this:e};function b(l){var m=this,h,k={},g=l?$.fn:$,n=arguments,i=4,f=n[1],j=n[2],p=n[3];if(typeof f!=="string"){i--;f=l=0;j=n[1];p=n[2]}if(l){h=m.eq(0);h.data(l,k=h.data(l)||{})}else{if(f){k=a[f]||(a[f]={})}}k.id&&clearTimeout(k.id);delete k.id;function e(){if(l){h.removeData(l)}else{if(f){delete a[f]}}}function o(){k.id=setTimeout(function(){k.fn()},j)}if(p){k.fn=function(q){if(typeof p==="string"){p=g[p]}p.apply(m,d.call(n,i))===true&&!q?o():e()};o()}else{if(k.fn){j===undefined?e():k.fn(j===false);return true}else{e()}}}})(jQuery);
