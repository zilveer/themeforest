(function($){
    "use strict";

/* -----------------------------------------------------------------------------

	PLUGINS

----------------------------------------------------------------------------- */

	/* -------------------------------------------------------------------------
		ACCORDION
	------------------------------------------------------------------------- */

	if ( ! $.fn.lsvrAccordion ) {
		$.fn.lsvrAccordion = function(){

			var $this = $(this),
			isToggle = $this.hasClass( 'm-toggle' ) ? true : false,
			items = $this.find( '> li' );
			//items.filter( '.m-active' ).find( '.accordion-content' ).slideDown( 300 );

			$this.find( '.accordion-title' ).click(function(){
				if ( ! $(this).parent().hasClass( 'm-active' ) ) {
					if ( ! isToggle ) {
						items.filter( '.m-active' ).find( '.accordion-content' ).slideUp(150, function(){
							items.filter( '.m-active' ).removeClass( 'm-active' );
						});
					}
					$(this).parent().find( '.accordion-content' ).slideDown(150, function(){
						$(this).parent().addClass( 'm-active' );
					});

				}
				else {
					$(this).parent().find( '.accordion-content' ).slideUp(150, function(){
						$(this).parent().removeClass( 'm-active' );
					});

				}
			});

			// RADIO GROUP
			if ( $this.hasClass( 'm-radio-group' ) ) {
				items.removeClass( 'm-active' );
				$this.find( '.accordion-content' ).hide();
				$this.find( 'input[type="radio"]:checked' ).parent().addClass( 'm-active' ).find( '.accordion-content' ).slideDown( 300 );
			}

		};
	}

	/* -------------------------------------------------------------------------
		ALERT MESSAGE
	------------------------------------------------------------------------- */

	if ( ! $.fn.lsvrAlertMessage ) {
		$.fn.lsvrAlertMessage = function(){

			// CLOSE
			var $this = $(this);
			$this.find( '.alert-close' ).click(function(){
				$this.slideUp( 300 );
			});

		};
	}

	/* -------------------------------------------------------------------------
		CAROUSEL
	------------------------------------------------------------------------- */

	if ( ! $.fn.lsvrCarousel ) {
		$.fn.lsvrCarousel = function() {
		// REQUIRED PLUGINS
		if ( $.fn.owlCarousel ) {

			var $this = $(this),
				itemList = $this.find( '.c-carousel-items' ),
				itemCount = itemList.children().length,
				items = $this.data( 'items' ) ? parseInt( $this.data( 'items' ) ) : 4,
				itemsDesktop = $this.data( 'items-desktop' ) ? parseInt( $this.data( 'items-desktop' ) ) : 4,
				itemsDesktopSmall = $this.data( 'items-desktop-small' ) ? parseInt( $this.data( 'items-desktop-small' ) ) : 3,
				itemsTablet = $this.data( 'items-tablet' ) ? parseInt( $this.data( 'items-tablet' ) ) : 2,
				itemsMobile = $this.data( 'items-mobile' ) ? parseInt( $this.data( 'items-mobile' ) ) : 1,
				loop = $this.attr( 'data-loop' ) && $this.attr( 'data-loop' ) === 'true' && itemCount > 1 ? true : false,
				autoplay = $this.data( 'autoplay' ) && parseInt( $this.data( 'autoplay' ) ) > 0 && itemCount > 1 ? true : false,
				autoplayTimeout = $this.data( 'autoplay' ) && parseInt( $this.data( 'autoplay' ) ) > 0 ? parseInt( $this.data( 'autoplay' ) ) : 0,
				rtl = $( 'html' ).attr( 'dir' ) && $( 'html' ).attr( 'dir' ) == 'rtl' ? true : false,
				margin = $this.attr( 'data-margin' ) ? parseInt( $this.data( 'margin' ) ) : 20;

			// CAROUSEL
			itemList.owlCarousel({
				rtl: rtl,
				loop: loop,
				margin: margin,
				nav: false,
				dots: true,
				autoplay: autoplay,
				autoplayTimeout: autoplayTimeout,
				autoplayHoverPause: true,
				onTranslate: function() {
					itemList.find( '.owl-dots' ).removeAttr( 'style' );
				},
				onTranslated: function(){
					itemList.find( '.owl-dots' ).removeAttr( 'style' );
					if ( itemList.find( '.owl-item:last-child' ).hasClass( 'active' )
						&& ! itemList.find( '.owl-dot:last-child' ).hasClass( 'active' ) ) {
						itemList.find( '.owl-dot.active' ).removeClass( 'active' );
						itemList.find( '.owl-dot:last-child' ).addClass( 'active' );
					}
				},
				onResized: function() {
					itemList.find( '.owl-dots' ).removeAttr( 'style' );
					itemList.find( '.owl-stage' ).width( itemList.find( '.owl-stage' ).width() + 1 );
				},
				onInitialized: function(){
					itemList.find( '.owl-stage' ).width( itemList.find( '.owl-stage' ).width() + 1 );
				},
				responsive:{
					0: {
						items: itemsMobile
					},
					480: {
						items: itemsTablet
					},
					767: {
						items: itemsDesktopSmall
					},
					991: {
						items: itemsDesktop
					},
					1199: {
						items: items
					}
				},
			});
			itemList.find( '.owl-dots' ).removeAttr( 'style' );

			// DOT ALTER CLASS
			itemList.find( '.owl-dot' ).each(function(){
				$(this).addClass( 'dot-page' );
			});

			// DOT CLICK
			itemList.find( '.owl-dot' ).each(function(){
				$(this).click(function(){
					itemList.find( '.owl-dot.active' ).removeClass( 'active' );
					$(this).addClass( 'active' );
				});
			});

			// DOT HIDDEN CLASSES
			if ( items >= itemCount ) {
				itemList.find( '.owl-dots' ).addClass( 'hidden-lg' );
			}
			if ( itemsDesktop >= itemCount ) {
				itemList.find( '.owl-dots' ).addClass( 'hidden-md' );
			}
			if ( itemsDesktopSmall >= itemCount ) {
				itemList.find( '.owl-dots' ).addClass( 'hidden-sm' );
			}

			// HOVER
			$this.hover(function(){
				$this.addClass( 'm-hover' );
			}, function(){
				$this.removeClass( 'm-hover' );
			});

		}};
	}

	/* -------------------------------------------------------------------------
		DATEPICKER INPUT
	------------------------------------------------------------------------- */

	if ( ! $.fn.lsvrDatepickerInput ) {
		$.fn.lsvrDatepickerInput = function(){
			if ( $.fn.datepicker ) {

				var $self = $(this),
				input = $self.find( 'input' ),
				firstDay = $self.data( 'first-day' ) ? $self.data( 'first-day' ) : 0,
				dateFormat = $self.data( 'date-format' ) ? $self.data( 'date-format' ) : 'mm/dd/yy';

				if ( typeof lsvr_datepicker_strings !== 'undefined' ) {
					$.datepicker.setDefaults( lsvr_datepicker_strings );
				}

				// INIT
				input.datepicker({
					dateFormat: dateFormat,
					minDate: 0,
					firstDay: firstDay,
					//beforeShowDay: $.datepicker.noWeekends, // disable weekends
					beforeShow: function( input, inst ){
						$( '#ui-datepicker-div' ).appendTo( $self );
					}
				});

			}
		};
	}

	/* -------------------------------------------------------------------------
		FIELD VALIDATION
	------------------------------------------------------------------------- */

	if ( ! $.fn.lsvrIsFieldValid ) {
		$.fn.lsvrIsFieldValid = function(){

			var field = $(this),
			value = field.val(),
			placeholder = field.data( 'placeholder' ) ? field.data( 'placeholder' ) : false,
			valid = false,
			emailValid = function( email ) {
				var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
				return re.test(email);
			};

			if ( value.trim() !== '' && ! ( placeholder && value === placeholder ) ) {

				// EMAIL FIELDS
				if ( field.hasClass( 'm-email' ) ) {
					if ( ! emailValid( value ) ) {
						field.addClass( 'm-error' );
					}
					else {
						field.removeClass( 'm-error' );
						valid = true;
					}
				}

				// SELECT FIELD
				else if ( field.prop( 'tagName' ).toLowerCase() === 'select' ) {
					if ( value === null ) {
						field.addClass( 'm-error' );
					}
					else {
						field.removeClass( 'm-error' );
						valid = true;
					}
				}

				// DEFAULT FIELD
				else {
					field.removeClass( 'm-error' );
					valid = true;
				}

			}
			else {
				field.addClass( 'm-error' );
			}

			return valid;

		};
	}

	/* -------------------------------------------------------------------------
		FLICKR FEED
	------------------------------------------------------------------------- */

	if ( ! $.fn.lsvrFlickrFeed ) {
		$.fn.lsvrFlickrFeed = function() {
		// REQUIRED PLUGINS
		if ( $.fn.lsvrImagesLoaded ) {

			if ( $(this).find( '.widget-feed' ).length < 1 ) {
				$(this).append( '<div class="widget-feed"></div>' );
			}
			var $self = $(this),
			feed = $(this).find( '.widget-feed' ),
			feedId = $(this).find( '.flickr-feed-inner' ).data( 'id' ),
			feedLimit = $(this).find( '.flickr-feed-inner' ).data( 'limit' );

			if ( isNaN( feedLimit ) || feedLimit < 1 ) {
				feedLimit = 1;
			}
			feed.html( '<ul class="image-list clearfix"></ul>' );

			// GET THE FEED
			$.getJSON( 'http://api.flickr.com/services/feeds/photos_public.gne?id=' + feedId + '&lang=en-us&format=json&jsoncallback=?', function(data){

				// get number of images to be shown
				var numberOfImages = feedLimit;
				if ( data.items.length < feedLimit ) {
					numberOfImages = data.items.length;
				}

				// INSERT ITEMS
				var i;
				for ( i = 0; i < numberOfImages; i++ ){
					feed.find( 'ul' ).append( '<li><a href="' + data.items[i].link + '" style="background-image: url(' + data.items[i].media.m + ');" rel="external"><img class="image-list-thumb" src="' + data.items[i].media.m + '" alt="' + data.items[i].title + '" style="display: none;"></a></li>' );
				}

				// IMAGES LOADED
				$self.lsvrImagesLoaded(function(){
					$self.find( '.c-loading-anim' ).fadeOut( 300, function(){
						$self.find( '.widget-feed' ).fadeIn( 300, function(){
							$self.removeClass( 'loading' );
							$self.find( '.image-list > li' ).each(function(){
								var item = $(this),
								itemIndex = $(this).index();
								setTimeout( function(){
									item.fadeIn( 300 );
								}, itemIndex * 100 );
							});
						});
					});
				});

			});

		}};
	}

	/* -------------------------------------------------------------------------
		FLUID VIDEOS
	------------------------------------------------------------------------- */

	if ( ! $.fn.lsvrFluidEmbedVideo ) {
		$.fn.lsvrFluidEmbedVideo = function(){

			var $self = $(this),
			allVideos;

			var reloadFluidVideos = function(){
				// Resize all videos according to their own aspect ratio
				allVideos.each(function() {
					var el = $(this),
					elContainer = el.parent(),
					newWidth = elContainer.width();
					el.width( newWidth ).height( newWidth * el.attr( 'data-aspect-ratio' ) );
				});
			};

			var generateFluidVideos = function(){
				// Find all videos
				allVideos = $self.find( '.embed-video iframe, .embed-video embed, article .various-content iframe, article .various-content embed' );
				// The element that is fluid width
				//$fluidEl = $('.embed-video').first();
				// Figure out and save aspect ratio for each video
				allVideos.each(function() {
					$(this).attr( 'data-aspect-ratio', this.height / this.width )
						// and remove the hard coded width/height
						.removeAttr( 'height' )
						.removeAttr( 'width' );
				});
				reloadFluidVideos();
			};

			if ( $self.find( '.embed-video' ).length > 0 || $( 'article .various-content iframe' ).length > 0 || $( 'article .various-content embed' ).length > 0 ) {
				generateFluidVideos();
				$(window).resize(function(){
					reloadFluidVideos();
				});
			}

		};
	}

	/* -------------------------------------------------------------------------
		FORM VALIDATION
	------------------------------------------------------------------------- */

	if ( ! $.fn.lsvrIsFormValid ) {
		$.fn.lsvrIsFormValid = function() {
		// REQUIRED PLUGINS
		if ( $.fn.lsvrIsFieldValid ) {

			// TRIM FIX FOR IE
			if ( typeof String.prototype.trim !== 'function' ) {
				String.prototype.trim = function() {
					return this.replace(/^\s+|\s+$/g, '');
				};
			}

			var form = $(this),
			formValid = true;

			// CHECK REQUIRED FIELDS
			form.find( 'input.m-required, textarea.m-required, select.m-required, *[required="required"]' ).each(function(){
				formValid = ! $(this).lsvrIsFieldValid() ? false : formValid;
			});

			// CHECK REQUIRED ONE FIELDS
			var requireOneValid = false;
			form.find( 'input.m-required-one, textarea.m-required-one, select.m-required-one' ).each(function(){
				if ( $(this).lsvrIsFieldValid() ) {
					requireOneValid = true;
					form.find( 'input.m-required-one, textarea.m-required-one, select.m-required-one' ).removeClass( 'm-error' );
				}
			});
			if ( form.find( '.m-require-one' ).length > 0 && ! requireOneValid ) {
				formValid = false;
			}
			if ( formValid ) {
				form.find( 'input.m-required-one, textarea.m-required-one, select.m-required-one' ).removeClass( 'm-error' );
			}

			form.find( '.m-error' ).first().focus();

			return formValid;

		}};
	}

	/* -------------------------------------------------------------------------
		GOOGLE MAP
	------------------------------------------------------------------------- */

	if ( ! $.fn.lsvrGoogleMap ) {
		$.fn.lsvrGoogleMap = function( latitude, longitude ) {

			var $this = $(this),
				zoom = $this.data( 'zoom' ) ? $this.data( 'zoom' ) : 10,
				enableMouseWheel = $this.data( 'enable-mousewheel' ) && String( $this.data( 'enable-mousewheel' ) ) === 'true' ? true : false,
				mapType = $this.data( 'maptype' ) ? $this.data( 'maptype' ) : 'SATELLITE',
				latLng = new google.maps.LatLng( latitude, longitude ),
				elementId = $this.attr( 'id' );

			switch ( mapType ) {
				case 'roadmap':
					mapType = google.maps.MapTypeId.ROADMAP;
					break;
				case 'terrain':
					mapType = google.maps.MapTypeId.TERRAIN;
					break;
				case 'hybrid':
					mapType = google.maps.MapTypeId.HYBRID;
					break;
				default:
					mapType = google.maps.MapTypeId.SATELLITE;
			}

			var mapOptions = {
				center: latLng,
				zoom: zoom,
				mapTypeId: mapType,
				scrollwheel: enableMouseWheel,
			};

			var map = new google.maps.Map(document.getElementById( elementId ),
				mapOptions );

			var marker = new google.maps.Marker({
				position: latLng,
				map: map
			});

		};
	}

	if ( ! $.fn.lsvrGoogleMapsLoaded ) {
		$.fn.lsvrGoogleMapsLoaded = function( element ) {
			if ( typeof element == 'undefined' ) {
				element = 'body';
			}
			$( element + ' .c-gmap' ).each(function(){

				// OPTIONS
				var $this = $(this),
					latitude = $this.data( 'latitude' ) ? $this.data( 'latitude' ) : false,
					longitude = $this.data( 'longitude' ) ? $this.data( 'longitude' ) : false,
					address = $this.data( 'address' ) ? $this.data( 'address' ) : false,
					elementIndex = $this.index( '.c-gmap' );

				// ADD UNIQUE ID
				$this.attr( 'id', 'google-map-' + elementIndex );

				// GET LATITUDE AND LONGITUDE FROM ADDRESS
				if ( address ) {

					var geocoder = new google.maps.Geocoder();
					geocoder.geocode( { 'address': address }, function( results, status ) {
						if ( status == google.maps.GeocoderStatus.OK ) {
							latitude = results[0].geometry.location.lat();
							longitude = results[0].geometry.location.lng();
							$this.lsvrGoogleMap( latitude, longitude );
						}
						else if ( latitude && longitude ) {
							$this.lsvrGoogleMap( latitude, longitude );
						}
					});

				}
				// OR USE LATITUDE & LANGITUDE FROM ATTRIBUTES
				else if ( latitude && longitude ) {
					$this.lsvrGoogleMap( latitude, longitude );
				}

			});
		};
	}

	if ( ! $.fn.lsvrLoadGoogleMaps ) {
		// REQUIRED PLUGINS
		if ( $.fn.lsvrGoogleMapsLoaded && $.fn.lsvrGoogleMap ) {
			$.fn.lsvrLoadGoogleMaps = function() {

				// INSERT GOOGLE API JS
				var script = document.createElement( 'script' ),
					apiKey = typeof lsvrGmapApiKey !== 'undefined' ? lsvrGmapApiKey : false;

				if ( apiKey !== false ) {
					script.type = 'text/javascript';
					script.src = 'https://maps.googleapis.com/maps/api/js?key=' + apiKey + '&callback=jQuery.fn.lsvrGoogleMapsLoaded';
					document.body.appendChild( script );
				}

			};
		}
	}

	/* -------------------------------------------------------------------------
		CHECKBOX INPUT
	------------------------------------------------------------------------- */

	if ( ! $.fn.lsvrCheckboxInput ) {
		$.fn.lsvrCheckboxInput = function(){

			var input = $(this).removeClass( 'checkbox-input' ).hide(),
			wrapped = false,
			$this, label;

			if ( input.parent().is( 'label' ) ) {
				label = input.parent();
				label.wrap( '<span class="checkbox-input"></span>' );
				$this = label.parent();
			}
			else {
				input.wrap( '<span class="checkbox-input"></span>' );
				$this = input.parent();
				label = $this.next( 'label' ).length > 0 ? $this.next( 'label' ) : $this.prev( 'label' );
				label.appendTo( $this );
			}

			// INIT
			if ( input.is( ':checked' ) ) {
				$this.addClass( 'm-checked' );
			}

			// CLICK
			input.click(function(){

				// RADIO
				if ( input.attr( 'type' ) === 'radio' && input.attr( 'name' ) && input.attr( 'name' ) !== '' ) {

					$( 'input[name="' + input.attr( 'name' ) + '"]' ).each(function(){
						$(this).parents( '.checkbox-input' ).removeClass( 'm-checked' );
					});
					$this.addClass( 'm-checked' );

				}
				// CHECKBOX
				else {
					$this.toggleClass( 'm-checked' );
					input.trigger( 'change' );
				}

			});

		};
	}

	/* -------------------------------------------------------------------------
		IMAGES LOADED
	------------------------------------------------------------------------- */

	if ( ! $.fn.lsvrImagesLoaded ) {
		$.fn.lsvrImagesLoaded = function( func ) {
			if ( $.isFunction( func ) ) {

				var images = $(this).find( 'img' ),
				loadedImages = 0,
				count = images.length;

				if ( count > 0 ) {
					images.one( 'load', function(){
						loadedImages++;
						if ( loadedImages === count ){
							func.call();
						}
					}).each(function() {
						if ( this.complete ) { $(this).load(); }
					});
				}
				else {
					func.call();
				}

			}
		};
	}

	/* ---------------------------------------------------------------------
		INVIEW ANIMATIONS
	--------------------------------------------------------------------- */

	if ( ! $.fn.lsvrAnimateOnInview ) {
		$.fn.lsvrAnimateOnInview = function() {

			var $this = $(this),
			animation = $(this).data( 'inview-anim' );
			$this.one( 'inview', function(){
				$this.removeClass( 'visibility-hidden' );
				$this.addClass( 'animated ' + animation );
			});

		};
	}

	/* -------------------------------------------------------------------------
		LIGHTBOX
	------------------------------------------------------------------------- */

	// LIGHTBOX SETUP
	if ( $.fn.magnificPopup ) {
		$.extend( true, $.magnificPopup.defaults, {
			tClose: 'Close (Esc)',
			tLoading: 'Loading...',
			gallery: {
				tPrev: 'Previous (Left arrow key)', // Alt text on left arrow
				tNext: 'Next (Right arrow key)', // Alt text on right arrow
				tCounter: '%curr% / %total%' // Markup for "1 of 7" counter
			},
			image: {
				tError: '<a href="%url%">The image</a> could not be loaded.', // Error message when image could not be loaded
				titleSrc: function( item ){
					if ( item.el.next( '.item-title' ).length > 0 ) {
						return item.el.next( '.item-title' ).html();
					}
					else if ( item.el.attr( 'title' ) ) {
						return item.el.attr( 'title' );
					}
					else {
						return '';
					}
				},
			},
			ajax: {
				tError: '<a href="%url%">The content</a> could not be loaded.' // Error message when ajax request failed
			},
		});
	}

	// FUNCTION
	if ( ! $.fn.lsvrInitLightboxes ) {
		$.fn.lsvrInitLightboxes = function() {
		// REQUIRED PLUGINS
		if ( $.fn.magnificPopup ) {

			$(this).find( 'a.lightbox' ).magnificPopup({
				type: 'image',
				removalDelay: 300,
				mainClass: 'mfp-fade',
				gallery: {
					enabled: true
				}
			});

		}};
	}

	/* -------------------------------------------------------------------------
		LOAD HIRES IMAGES
	------------------------------------------------------------------------- */

	if ( ! $.fn.lsvrLoadHiresImages ) {
		$.fn.lsvrLoadHiresImages = function() {
			if ( window.devicePixelRatio > 1 ) {
				$(this).find( 'img[data-hires]' ).each(function(){
					$(this).attr( 'src', $(this).data( 'hires' ) );
				});
			}
		};
	}

	/* -------------------------------------------------------------------------
		MAILCHIMP SUBSCRIBE FORM
	------------------------------------------------------------------------- */

	if ( ! $.fn.lsvrMailchimpSubscribeForm ) {
		$.fn.lsvrMailchimpSubscribeForm = function(){
		// REQUIRED PLUGINS
		if ( $.fn.lsvrIsFormValid ) {

			var form = $(this).find( 'form' ),
			submitBtn = form.find( '.submit-btn' );

			form.submit(function(e){
				e.preventDefault();
				if ( ! form.hasClass( 'm-loading' ) ) {

					// FORM IS VALID
					if ( form.lsvrIsFormValid() ) {

						form.find( 'p.c-alert-message.m-warning.m-validation-error' ).slideUp(300);
						form.addClass( 'm-loading' );
						submitBtn.attr( 'data-label', submitBtn.text() ).text( submitBtn.data( 'loading-label' ) );

						// SEND AJAX REQUEST
						$.ajax({
							type: form.attr( 'method' ),
							url: form.attr( 'action' ),
							data: form.serialize(),
							cache : false,
							dataType : 'json',
							contentType: "application/json; charset=utf-8",
							// WAIT FOR RESPONSE
							success: function( data ){

								if ( data.result === 'success' ) {
									form.find( '.c-alert-message' ).hide();
									form.find( '.c-alert-message.m-success' ).append( '<br>' + data.msg ).slideDown(300);
									form.find( '.form-fields' ).slideUp(300);
								}
								else {
									form.find( '.c-alert-message.m-validation-error' ).slideUp(300);
									form.find( '.c-alert-message.m-request-error' ).slideDown(300);
								}

								form.removeClass( 'm-loading' );
								submitBtn.text( submitBtn.attr( 'data-label' ) );

							},
							error: function(){

								form.find( '.m-alert-message.m-validation-error' ).slideUp(300);
								form.find( '.m-alert-message.m-request-error' ).slideDown(300);
								form.removeClass( 'loading' );
								submitBtn.text( submitBtn.attr( 'data-label' ) );

							}
						});

					}

					//  FORM IS INVALID
					else {
						form.find( 'p.c-alert-message.m-warning.m-validation-error' ).slideDown(300);
						return false;
					}

				}
			});

		}};
	}

	/* -------------------------------------------------------------------------
		MEDIA QUERY BREAKPOINT
	------------------------------------------------------------------------- */

	if ( ! $.fn.lsvrGetMediaQueryBreakpoint ) {
		$.fn.lsvrGetMediaQueryBreakpoint = function() {

			if ( $( '#media-query-breakpoint' ).length < 1 ) {
				$( 'body' ).append( '<span id="media-query-breakpoint" style="display: none;"></span>' );
			}
			var value = $( '#media-query-breakpoint' ).css( 'font-family' );
			if ( typeof value !== 'undefined' ) {
				value = value.replace( "\"", "" ).replace( "\"", "" ).replace( "\'", "" ).replace( "\'", "" );
			}
			if ( isNaN( value ) ) {
				return $(window).width();
			}
			else {
				return parseInt( value );
			}

		};
	}

	/* -------------------------------------------------------------------------
		PROGRESS BAR
	------------------------------------------------------------------------- */

	if ( ! $.fn.lsvrProgressBar ) {
		$.fn.lsvrProgressBar = function(){

			var $this = $(this),
			percentage = $this.data( 'percentage' ) ? parseInt( $this.data( 'percentage' ) ) : 100,
			inner = $this.find( '> span' );
			$this.one( 'inview', function(){
				inner.css( 'width', percentage + '%' );
			});

		};
	}

	/* -------------------------------------------------------------------------
		RELATIVE TIME
		http://stackoverflow.com/questions/6108819/javascript-timestamp-to-relative-time-eg-2-seconds-ago-one-week-ago-etc-best
	------------------------------------------------------------------------- */

	if ( ! $.fn.lsvrRelativeTime ) {
		$.fn.lsvrRelativeTime = function( current, previous, lang ) {
			if ( typeof lsvrSprintf == 'function' ) {

				current = new Date( Date.parse( current.toUTCString() ) );
				if ( isNaN( new Date( Date.parse( previous ) ) ) ) {

					var v = previous.split(' ');
					previous = new Date(Date.parse(v[1]+" "+v[2]+", "+v[5]+" "+v[3]+" UTC"));

				}
				else {
					previous = new Date( Date.parse( previous ) );
					previous = new Date( Date.parse( previous.toUTCString() ) );
				}

				var msPerMinute = 60 * 1000,
				msPerHour = msPerMinute * 60,
				msPerDay = msPerHour * 24,
				msPerMonth = msPerDay * 30,
				msPerYear = msPerDay * 365,
				elapsed = current - previous;

				if ( elapsed < msPerMinute ) {
					return lsvrSprintf( lang.seconds_ago, Math.round( elapsed/1000 ) );
				}
				else if ( elapsed < msPerHour ) {
					return lsvrSprintf( lang.minutes_ago, Math.round( elapsed/msPerMinute ) );
				}
				else if ( elapsed < msPerDay ) {
					return lsvrSprintf( lang.hours_ago, Math.round( elapsed/msPerHour ) );
				}
				else if ( elapsed < msPerMonth ) {
					return lsvrSprintf( lang.days_ago, Math.round( elapsed/msPerDay ) );
				}
				else if (elapsed < msPerYear) {
					return lsvrSprintf( lang.months_ago, Math.round( elapsed/msPerMonth ) );
				}
				else {
					return lsvrSprintf( lang.years_ago, Math.round( elapsed/msPerYear ) );
				}

			}
		};
	}

	/* -------------------------------------------------------------------------
		SELECTBOX INPUT
	------------------------------------------------------------------------- */

	if ( ! $.fn.lsvrSelectboxInput ) {
		$.fn.lsvrSelectboxInput = function(){

			var $this = $(this);
			$this.wrap( '<div class="selectbox-input"></div>' );
			$this = $this.parent();
			var input = $this.find( 'select' ),
			fakeSelectHtml = '';
			input.removeClass( 'selectbox-input' );
			var value = input.val();
			var defaultValue = input.find( 'option[value="' + value + '"]' ).text() ? input.find( 'option[value="' + value + '"]' ).text() : input.find( 'option' ).first().text();

			// COPY CLASSES
			if ( input.hasClass( 'm-small' ) ) {
				$this.addClass( 'm-small' );
			}
			if ( input.hasClass( 'm-type-2' ) ) {
				$this.addClass( 'm-type-2' );
			}

			// CREATE ELEMENTS
			$this.append( '<button type="button" class="toggle"><span>' + defaultValue + '</span></button>' );
			fakeSelectHtml = '<ul class="fake-selectbox" style="display: none;">';
			input.find( 'option' ).each(function(){
				fakeSelectHtml += '<li data-value="' + $(this).attr( 'value' ) + '">' + $(this).text() + '</li>';
			});
			fakeSelectHtml += '</ul>';
			$this.append( fakeSelectHtml );
			var toggle = $this.find( '.toggle' ),
			fakeSelect = $this.find( '.fake-selectbox' );

			// TOGGLE
			toggle.click(function(){
				fakeSelect.slideToggle(150);
				toggle.toggleClass( 'm-active' );
				$this.unbind( 'clickoutside' );
				if ( toggle.hasClass( 'm-active' ) ) {
					$this.bind( 'clickoutside', function(event){
						fakeSelect.slideUp(150);
						toggle.removeClass( 'm-active' );
						$this.unbind( 'clickoutside' );
					});
				}
			});

			// FAKE SELECTBOX CLICK
			fakeSelect.find( 'li' ).each(function(){
				$(this).click(function(){
					toggle.removeClass( 'm-active' ).find( 'span' ).text( $(this).text() );
					fakeSelect.slideUp(150);
					input.val( $(this).attr( 'data-value' ) );
					input.trigger( 'change' );
				});
			});

		};
	}

	/* -------------------------------------------------------------------------
		SLIDER
	------------------------------------------------------------------------- */

	if ( ! $.fn.lsvrSlider ) {
		$.fn.lsvrSlider = function() {
		// REQUIRED PLUGINS
		if ( $.fn.owlCarousel ) {

			var slider = $(this),
			slideList = slider.find( '.slide-list' ),
			slideCount = slideList.find( '> .slide' ).length,
			slides = slideList.find( '> .slide' ),
			autoplay = slider.data( 'interval' ) && parseInt( slider.data( 'interval' ) ) > 0 ? true : false,
			autoplayTimeout = slider.data( 'interval' ) && parseInt( slider.data( 'interval' ) ) > 0 ? parseInt( slider.data( 'interval' ) ) : 0,
			rtl = $( 'html' ).attr( 'dir' ) && $( 'html' ).attr( 'dir' ) == 'rtl' ? true : false;

			if ( slideCount > 1 ) {

				// CREATE CAROUSEL
				slideList.owlCarousel({
					rtl: rtl,
					loop: true,
					nav: false,
					navRewind: true,
					dots: false,
					autoplay: autoplay,
					autoplayTimeout: autoplayTimeout,
					autoplayHoverPause: true,
					responsive:{
						0: {
							items: 1
						}
					},
					onTranslated: function(){

						// REFRESH INDICATOR
						if ( autoplay ) {
							slider.find( '.slider-indicator > span' ).stop( 0, 0 );
						}
						if ( autoplay && mediaQueryBreakpoint > 991 ) {
							slider.find( '.slider-indicator > span' ).css( 'width', 0 );
							if ( ! slider.hasClass( 'm-paused' ) ) {
								slider.find( '.slider-indicator > span' ).stop( 0, 0 ).animate({ width : "100%" }, autoplayTimeout );
							}
						}

						// CHANGE NAV
						var activeIndex = parseInt( slideList.find( '.owl-item.active .slide' ).attr( 'data-index' ) );
						slider.find( '.slider-nav ul > li.m-active' ).removeClass( 'm-active' );
						slider.find( '.slider-nav ul > li:eq(' + activeIndex + ')' ).addClass( 'm-active' );

					}
				});

				// CREATE NAVIGATION
				var label,
					nav = '<div class="slider-nav">';
				nav += slider.hasClass( 'm-fullsize' ) ? '<div class="container">' : '';
				nav += '<ul>';
				for ( var i = 0; i < slideCount; i++ ) {
					if ( slides.eq( i ).data( 'label' ) ) {
						label = slides.eq( i ).data( 'label' );
					}
					else {
						label = i;
					}
					nav += '<li><button>' + label + '</button></li>';
				}
				nav += '</ul>';
				nav += slider.hasClass( 'm-fullsize' ) ? '</div>' : '';
				nav += '</div>';
				slideList.append( nav );
				var sliderNav = slider.find( '.slider-nav' );
				sliderNav.find( 'ul > li:first-child' ).addClass( 'm-active' );

				// NAVIGATION CLICK
				sliderNav.find( 'button' ).each(function(){
					var $this = $(this),
						thisIndex = $this.parent().index();
					$this.click(function(){
						if ( ! $(this).parent().hasClass( 'm-active' ) ) {
							sliderNav.find( '.m-active' ).removeClass( 'm-active' );
							$(this).parent().addClass( 'm-active' );
							slideList.trigger( 'to.owl.carousel', [thisIndex, 300, true] );
						}
					});
				});

				// AUTO SLIDE INDICATOR
				if ( autoplay ) {

					// CREATE
					slider.addClass( 'm-has-indicator' );
					slider.append( '<div class="slider-indicator"><span></span></div>' );

					// INITIAL ANIMATION
					slider.find( '.slider-indicator > span' ).animate({
						width : "100%"
					}, autoplayTimeout, 'linear' );

					// PAUSE
					var sliderPause = function(){
						slider.addClass( 'm-paused' );
						slider.find( '.slider-indicator > span' ).stop( 0, 0 );
					};
					var sliderResume = function(){
						slider.removeClass( 'm-paused' );
						slider.find( '.slider-indicator > span' ).stop( 0, 0 ).animate({
							width : "100%"
						}, autoplayTimeout, 'linear' );
					};

					slider.hover(function(){
						sliderPause();
					}, function(){
						sliderResume();
					});

					// STOP ON SMALLER RESOLUTIONS
					$( document ).on( 'screenTransition', function(){
						if ( mediaQueryBreakpoint <= 991 ) {
							sliderPause();
						}
					});
					if ( mediaQueryBreakpoint <= 991 ) {
						sliderPause();
					}

				}

			}

		}};
	}

	/* -------------------------------------------------------------------------
		TABS
	------------------------------------------------------------------------- */

	if ( ! $.fn.lsvrTabbed ) {
		$.fn.lsvrTabbed = function(){

			var $this = $(this),
			tabs = $this.find( '.tab-list > li' ),
			contents = $this.find( '.content-list > li' );

			tabs.click(function(){
				if ( ! $(this).hasClass( 'm-active' ) ) {

					var index = $(this).index();
					tabs.filter( '.m-active' ).removeClass( 'm-active' );
					$(this).addClass( 'm-active' );
					contents.filter( ':visible' ).slideUp( 300, function(){
						$(this).removeClass( 'm-active' );
					});
					contents.filter( ':eq(' + index + ')' ).slideDown(300).addClass( 'm-active' );

					if ( document.createEvent ) {
						window.dispatchEvent( new Event( 'resize' ) );
					}
					else {
						document.body.fireEvent( 'onresize' );
					}

				}
			});

		};
	}


/* -----------------------------------------------------------------------------

	EVENTS

----------------------------------------------------------------------------- */

	/* -------------------------------------------------------------------------
		SCREEN SIZE TRANSITION
	------------------------------------------------------------------------- */

	if ( $.fn.lsvrGetMediaQueryBreakpoint ) {
		var mediaQueryBreakpoint = $.fn.lsvrGetMediaQueryBreakpoint();
		$(window).resize(function(){
			if ( $.fn.lsvrGetMediaQueryBreakpoint() !== mediaQueryBreakpoint ) {
				mediaQueryBreakpoint = $.fn.lsvrGetMediaQueryBreakpoint();
				$.event.trigger({
					type: 'screenTransition',
					message: 'Screen transition completed.',
					time: new Date()
				});
			}
		});
	}

})(jQuery);