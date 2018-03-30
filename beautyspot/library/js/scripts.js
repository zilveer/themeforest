/* -----------------------------------------------------------------------------

	TABLE OF CONTENTS

	1.) General
	2.) Components
	3.) Header
	4.) Main Slider
	5.) Core
	6.) Widgets
	7.) Footer
	8.) Reservation Form
	9.) Style Switcher
	10.) Various

----------------------------------------------------------------------------- */

(function($){ "use strict";
$(document).ready(function(){

/* -----------------------------------------------------------------------------

	1.) GENERAL

----------------------------------------------------------------------------- */

	/* -------------------------------------------------------------------------
		FLUID VIDEOS
	------------------------------------------------------------------------- */

	$( 'body' ).lsvrFluidEmbedVideo();

	/* -------------------------------------------------------------------------
		FORMS
	------------------------------------------------------------------------- */

	// DATEPICKER INPUTS
	if ( $.fn.lsvrDatepickerInput ) {
		$( '.datepicker-input' ).each(function(){
			$(this).lsvrDatepickerInput();
		});
	}

	// CHECKBOX INPUTS
	if ( $.fn.lsvrCheckboxInput ) {
		$( '.checkbox-input, #subscribe_comments, #subscribe_blog, .input-checkbox, #reservation-form .wpcf7-list-item input[type=checkbox], #reservation-form .wpcf7-list-item input[type=radio], #rememberme' ).each(function(){
			$(this).lsvrCheckboxInput();
		});
	}

	// SELECTBOX INPUTS
	if ( $.fn.lsvrSelectboxInput ) {
		$( '.selectbox-input, .wpcf7-select, .woocommerce-ordering select' ).each(function(){
			$(this).lsvrSelectboxInput();
		});
	}

	// VALIDATE FORMS
	if ( $.fn.lsvrIsFormValid ) {
		$( 'form.m-validate' ).each(function(){
			var $this = $(this);
			$this.submit(function(){
				if ( ! $this.lsvrIsFormValid() ) {
					$this.find( '.m-validation-error' ).slideDown( 300 );
					return false;
				}
			});
		});
	}

	/* -------------------------------------------------------------------------
		INPUT PLACEHOLDERS
	------------------------------------------------------------------------- */

	$( '*[data-placeholder]' ).each(function(){

		var $this = $(this),
		placeholder = $this.data( 'placeholder' );

		// RESET
		if ( $this.val() === '' ) {
			$this.val( placeholder );
		}
		// FOCUS
		$this.focus(function(){
			if ( $this.val() === placeholder ) {
				$this.val( '' );
			}
		});
		// BLUR
		$this.blur(function(){
			if ( $this.val() === '' ) {
				$this.val( placeholder );
			}
		});

	});

	/* -------------------------------------------------------------------------
		INVIEW ANIMATIONS
	------------------------------------------------------------------------- */

	if ( $.fn.lsvrAnimateOnInview ) {
		$( '[data-inview-anim]' ).each( function(){
			$(this).lsvrAnimateOnInview();
		});
	}

	/* -------------------------------------------------------------------------
		LIGHTBOXES
	------------------------------------------------------------------------- */

	if ( $.fn.lsvrInitLightboxes ) {
		$( 'body' ).lsvrInitLightboxes();
	}

	/* -------------------------------------------------------------------------
		LOAD HIRES IMAGES FOR HiDPI SCREENS
	------------------------------------------------------------------------- */

	if ( $.fn.lsvrLoadHiresImages ) {
		$( 'body' ).lsvrLoadHiresImages();
	}

	/* -------------------------------------------------------------------------
		MEDIA QUERY BREAKPOINT
	------------------------------------------------------------------------- */

	var mediaQueryBreakpoint;
	if ( $.fn.lsvrGetMediaQueryBreakpoint ) {
		mediaQueryBreakpoint = $.fn.lsvrGetMediaQueryBreakpoint();
		$( document ).on( 'screenTransition', function(){
			mediaQueryBreakpoint = $.fn.lsvrGetMediaQueryBreakpoint();
		});
	}
	else {
		mediaQueryBreakpoint = $(window).width();
	}

	/* -------------------------------------------------------------------------
		VARIOUS
	------------------------------------------------------------------------- */

	$( '.aq-template-wrapper' ).addClass( 'various-content' );


/* -----------------------------------------------------------------------------

	2.) COMPONENTS

----------------------------------------------------------------------------- */

	/* -------------------------------------------------------------------------
		ACCORDION
	------------------------------------------------------------------------- */

	if ( $.fn.lsvrAccordion ) {
		$( '.c-accordion' ).each(function(){
			$(this).lsvrAccordion();
		});
	}

	/* -------------------------------------------------------------------------
		ALERT MESSAGE
	------------------------------------------------------------------------- */

	if ( $.fn.lsvrAlertMessage ) {
		$( '.c-alert-message' ).each(function(){
			$(this).lsvrAlertMessage();
		});
	}

	/* -------------------------------------------------------------------------
		CAROUSEL
	------------------------------------------------------------------------- */

	if ( $.fn.lsvrCarousel ) {
		$( '.c-carousel' ).each(function(){
			$(this).lsvrCarousel();
		});
	}

	/* -------------------------------------------------------------------------
		GALLERY
	------------------------------------------------------------------------- */

	$( '.c-gallery img' ).each(function(){
		$(this).removeAttr( 'width' ).removeAttr( 'height' );
	});
	if ( $.fn.owlCarousel ) {
		$( '.c-gallery.m-paginated' ).each(function(){

			var $this = $(this)

			// CAROUSEL
			$this.lsvrCarousel();

			// HOVER
			$this.hover(function(){
				$this.addClass( 'm-hover' );
			}, function(){
				$this.removeClass( 'm-hover' );
			});

		});
	}

	/* -------------------------------------------------------------------------
		GALLERY (Visual Composer)
	------------------------------------------------------------------------- */

	if ( $.fn.lsvrCarousel ) {
		$( '.c-gallery-vc.m-carousel' ).each(function(){
			$(this).lsvrCarousel();
		});
	}

	/* -------------------------------------------------------------------------
		GOOGLE MAP
	------------------------------------------------------------------------- */

	if ( $.fn.lsvrLoadGoogleMaps && $( '.c-gmap' ).length > 0 ) {
		$.fn.lsvrLoadGoogleMaps();
	}

	/* -------------------------------------------------------------------------
		PROGRESS BAR
	------------------------------------------------------------------------- */

	if ( $.fn.lsvrProgressBar ) {
		$( '.c-progress-bar' ).each(function(){
			$(this).lsvrProgressBar();
		});
	}

	/* -------------------------------------------------------------------------
		SLIDER
	------------------------------------------------------------------------- */

	if ( $.fn.lsvrSlider ) {
		$( '.c-slider' ).each(function(){
			$(this).lsvrSlider();
		});
	}


	/* -------------------------------------------------------------------------
		TABS
	------------------------------------------------------------------------- */

	if ( $.fn.lsvrTabbed ) {
		$( '.c-tabs' ).each(function(){
			$(this).lsvrTabbed();
		});
	}


/* -----------------------------------------------------------------------------

	3.) HEADER

----------------------------------------------------------------------------- */

	/* -------------------------------------------------------------------------
		HEADER SUBMENU
	------------------------------------------------------------------------- */

	$( '#header .header-menu .sub-menu' ).each(function(){
		$(this).parent().each(function(){

			var $this = $(this),
			submenu = $(this).find( '> .sub-menu' );

			// SHOW SUBMENU ON HOVER
			$this.hover(function(){
				if ( mediaQueryBreakpoint > 1199 ) {
					$this.addClass( 'm-hover' );
					submenu.show().addClass( 'animated fadeInLeft' );
				}
			}, function(){
				if ( mediaQueryBreakpoint > 1199 ) {
					$this.removeClass( 'm-hover' );
					submenu.hide().removeClass( 'animated fadeInLeft' );
				}
			});

			// SUBMENU TOGGLE
			$this.addClass( 'm-has-submenu' ).append( '<button class="submenu-toggle" type="button"><i class="fa"></i></button>' );
			$this.find( '.submenu-toggle' ).click(function(){
				$(this).toggleClass( 'm-active' );
				if ( mediaQueryBreakpoint > 991 ) {
					if ( submenu.is( ':visible' ) ) {
						submenu.hide().removeClass( 'animated fadeInLeft' );
					}
					else {
						submenu.show().addClass( 'animated fadeInLeft' );
						$(this).unbind( 'clickoutside' );
						$(this).bind( 'clickoutside', function(){
							$(this).unbind( 'clickoutside' );
							submenu.hide().removeClass( 'animated fadeInLeft' );
							$(this).removeClass( 'm-active' );
						});
					}
				}
				else {
					$this.find( '> .sub-menu' ).slideToggle( 300 );
				}
			});
			$( document ).on( 'screenTransition', function(){
				$this.find( '.submenu-toggle' ).removeClass( 'm-active' );
				$this.find( '> .sub-menu' ).removeAttr( 'style' );
			});

		});
	});

	/* -------------------------------------------------------------------------
		HEADER MENU MOBILE
	------------------------------------------------------------------------- */

	$( '#header .header-menu' ).each(function(){

		var $this = $(this),
		toggle = $this.find( '.header-menu-toggle' ),
		inner = $this.find( '> ul' );

		toggle.click(function(){
			inner.slideToggle( 300 );
			toggle.toggleClass( 'm-active' );
			if ( mediaQueryBreakpoint <= 991 ) {
				$( '#header .header-search-inner:visible' ).slideUp( 300 );
			}
		});
		$( document ).on( 'screenTransition', function(){
			inner.removeAttr( 'style' );
			toggle.removeClass( 'm-active' );
		});

	});

	/* -------------------------------------------------------------------------
		HEADER SEARCH
	------------------------------------------------------------------------- */

	$( '#header .header-search' ).each(function(){

		var $this = $(this),
		toggle = $this.find( '.search-toggle' ),
		toggleMobile = $this.find( '.search-toggle-mobile' );

		// SEARCH TOGGLE
		toggle.click(function(){
			$this.addClass( 'm-active' );
			$this.find( '.search-input' ).focus();
			$this.bind( 'clickoutside', function(){
				$this.removeClass( 'm-active' );
			});
		});

		// SEARCH TOGGLE MOBILE
		toggleMobile.click(function(){
			$this.find( '.header-search-inner' ).slideToggle( 300 );
			toggleMobile.toggleClass( 'm-active' );
			if ( mediaQueryBreakpoint <= 991 ) {
				$( '#header .header-menu > ul:visible' ).slideUp( 300 );
			}
		});
		$( document ).on( 'screenTransition', function(){
			$this.find( '.header-search-inner' ).removeAttr( 'style' );
			toggleMobile.removeClass( 'm-active' );
		});

	});

	/* -------------------------------------------------------------------------
		HEADER PANEL
	------------------------------------------------------------------------- */

	$( '#header .header-panel' ).each(function(){

		var $this = $(this),
		toggle = $this.find( '.header-panel-toggle' ),
		reservation = $this.find( '.header-reservation' ),
		contact = $this.find( '.header-contact' ),
		social = $this.find( '.header-social' );

		// TOGGLE
		toggle.click(function(){

			contact.slideToggle( 300 );
			reservation.slideToggle( 300 );
			$( '#header' ).toggleClass( 'm-has-active-panel' );
			toggle.toggleClass( 'm-active' );

			if ( mediaQueryBreakpoint <= 991 ) {
				social.slideToggle( 300 );
			}

		});

		// RESET ON SCREEN TRANSITION
		$( document ).on( 'screenTransition', function(){
			toggle.removeClass( 'm-active' );
			$( '#header' ).removeClass( 'm-has-active-panel' );
			reservation.removeAttr( 'style' );
			contact.removeAttr( 'style' );
			social.removeAttr( 'style' );
		});

	});


/* -----------------------------------------------------------------------------

	5.) CORE

----------------------------------------------------------------------------- */

	/* -------------------------------------------------------------------------
		ARTICLE COMMENTS
	------------------------------------------------------------------------- */

	$( '#commentform' ).each(function(){

		var $form = $(this);
		$form.addClass( 'default-form' );

		// VALIDATE
		if ( $.fn.lsvrIsFormValid ) {
			$form.find( '.required' ).addClass( 'm-required' );
			$form.find( '.email' ).addClass( 'm-email' );
			$form.submit(function(){
				if ( ! $form.lsvrIsFormValid() ) {
					//$form.find( '.m-validation-error' ).slideDown( 300 );
					return false;
				}
			});
		}

		// EDIT SUBMIT BTN
		$form.find( '#submit' ).addClass( 'c-button m-medium' );

	});

	/* -------------------------------------------------------------------------
		PRODUCT DETAIL
	------------------------------------------------------------------------- */

	$( '.woocommerce-tabs #tab-description' ).addClass( 'various-content' );


/* -----------------------------------------------------------------------------

	6.) WIDGETS

----------------------------------------------------------------------------- */

	/* -------------------------------------------------------------------------
		FLICKR WIDGET
	------------------------------------------------------------------------- */

	if ( $.fn.lsvrFlickrFeed ) {
		$( '.widget.flickr-feed' ).each(function(){
			$(this).lsvrFlickrFeed();
		});
	}

	/* -------------------------------------------------------------------------
		NEWSLETTER SUBSCRIBE
	------------------------------------------------------------------------- */

	if ( $.fn.lsvrMailchimpSubscribeForm ) {
		$( '.widget.mailchimp-subscribe' ).each(function(){
			$(this).lsvrMailchimpSubscribeForm();
		});
	}


/* -----------------------------------------------------------------------------

	7.) FOOTER

----------------------------------------------------------------------------- */

	/* -------------------------------------------------------------------------
		FOOTER TWITTER
	------------------------------------------------------------------------- */

	// PARSE TWEETS
	var lsvrGetTwitterFeed = function( feed, response, username ){

		var tweets = '',
		json = $.parseJSON( response ),
		current_time = new Date();

		var date_lang = new Array( 'seconds_ago' );
		date_lang.seconds_ago = feed.data( 'seconds-ago' );
		date_lang.minutes_ago = feed.data( 'minutes-ago' );
		date_lang.hours_ago = feed.data( 'hours-ago' );
		date_lang.days_ago = feed.data( 'days-ago' );
		date_lang.months_ago = feed.data( 'months-ago' );
		date_lang.years_ago = feed.data( 'years-ago' );

		$.each( json, function( i, tweet ) {
			if ( tweet.text !== undefined ) {
				tweets += '<div class="tweet-item">';
				tweets += '<p class="tweet-text">' + twitterParse( tweet.text ) + '</p>';
				tweets += '<p class="tweet-date"><a href="https://twitter.com/' + username + '/status/' + tweet.id_str + '">' + $.fn.lsvrRelativeTime( current_time, tweet.created_at, date_lang ) + '</a></p>';
				tweets += '</div>';
			}
		});

		if ( tweets !== '' ) {
			feed.find( '.twitter-feed' ).removeClass( 'loading' ).html( '<div class="tweet-list">' + tweets + '</div>' );
		}

		// PAGINATED FEED
		if ( feed.find( '.tweet-list .tweet-item' ).length > 1 && feed.hasClass( 'm-paginated' ) && $.fn.owlCarousel ) {

			var autoplay = feed.find( '.tweet-list' ).data( 'interval' ) && parseInt( feed.find( '.tweet-list' ).data( 'interval' ) ) > 0 ? true : false,
				autoplayTimeout = feed.find( '.tweet-list' ).data( 'interval' ) && parseInt( feed.find( '.tweet-list' ).data( 'interval' ) ) > 0 ? parseInt( feed.find( '.tweet-list' ).data( 'interval' ) ) : 0,
				rtl = $( 'html' ).attr( 'dir' ) && $( 'html' ).attr( 'dir' ) == 'rtl' ? true : false;

			feed.find( '.tweet-list' ).owlCarousel({
				rtl: rtl,
				loop: true,
				nav: false,
				dots: false,
				autoplay: autoplay,
				autoplayTimeout: autoplayTimeout,
				autoplayHoverPause: true,
				responsive:{
					0: {
						items: 1
					}
				},
			});

			var carousel = feed.find( '.tweet-list' ).data( 'owlCarousel' );
			feed.append( '<button class="btn-prev" type="button"><i class="fa fa-chevron-left"></i></button><button class="btn-next" type="button"><i class="fa fa-chevron-right"></i></button>' );

			// PREV TWEET
			feed.find( '.btn-prev' ).click(function(){
				feed.find( '.tweet-list' ).trigger( 'prev.owl.carousel' );
			});

			// NEXT TWEET
			feed.find( '.btn-next' ).click(function(){
				feed.find( '.tweet-list' ).trigger( 'next.owl.carousel' );
			});

		}

	};

	// GET RESPONSE
	$( '.footer-twitter' ).each(function(){
		var twitterFeed = $(this),
		username = twitterFeed.data( 'id' ),
		data = { action: 'lsvr_twitter_feed' };

		$.post( lsvrMainScripts.ajaxurl, data, function( response ) {
			lsvrGetTwitterFeed( twitterFeed, response, username );
		});

	});


/* -----------------------------------------------------------------------------

	8.) RESERVATION FORM

----------------------------------------------------------------------------- */

var $reservationForm = $( '#reservation-form' );

// CLOSE FUNCTION
var lsvrCloseReservationModal = function(){

	$reservationForm.fadeOut( 300, function(){
		$reservationForm.find( '.modal-loading' ).show();
		$reservationForm.find( '.modal-box' ).removeClass( 'animated fadeInDown' ).unbind( 'clickoutside' ).hide();
		$( 'html' ).removeClass( 'm-modal-active' );
	});

	// TRIGGER modalClosed EVENT
	$.event.trigger({
		type: 'modalClosed',
		message: 'Modal is closed.',
		time: new Date()
	});

};

// SHOW MODAL
if ( $reservationForm.length > 0 ) {
	$( 'a[href="#reservation-form"]' ).each(function(){
		$(this).click(function(){

			// SHOW MODAL
			var modal = $reservationForm,
			modalLoading = $( '.c-modal .modal-loading' ),
			modalBox = $( '.c-modal .modal-box' ),
			modalBoxInner = $( '.c-modal .modal-box-inner' ),
			modalClose = $( '.c-modal .modal-close' );
			modal.fadeIn( 300 );
			$( 'html' ).addClass( 'm-modal-active' );

			// SHOW MODAL BOX
			modalLoading.fadeOut( 300 );
			modalBox.show().addClass( 'animated fadeInDown' );

			// CLICK ON CLOSE
			modalClose.click(function(){
				lsvrCloseReservationModal();
			});

			// iOS & Chrome BODY SCROLLING FIX
			$( 'body' ).on( 'touchmove', function (e) {
				if ( $( '.c-modal' ).is( ':visible' ) ) {
					if ( ! $( '.c-modal' ).has( $( e.target ) ).length ) {
						e.preventDefault();
					}
				}
			});
			$( 'body' ).on( 'mousewheel DOMMouseScroll', function (e) {
				if ( $( '.c-modal' ).is( ':visible' ) ) {
					if ( ! $( '.c-modal' ).has( $( e.target ) ).length ) {
						e.preventDefault();
					}
				}
			});

			// TRIGGER modalOpened EVENT
			$.event.trigger({
				type: 'modalOpened',
				message: 'Modal is opened.',
				time: new Date()
			});

			// DISABLE DEFAULT CLICK ACTION
			return false;

		});
	});
}


/* -----------------------------------------------------------------------------

	9.) STYLE SWITCHER

----------------------------------------------------------------------------- */

	if ( $( 'body' ).hasClass( 'm-has-style-switcher' ) ) {

		var templateDirectoryUri = $( 'head' ).data( 'template-uri' );

		// CREATE STYLE SWITCHER
		var style_switcher_html = '<div id="style-switcher"><button class="style-switcher-toggle"><i class="ico fa fa-tint"></i></button>';
		style_switcher_html += '<div class="style-switcher-content"><ul class="skin-list">';
		style_switcher_html += '<li><button class="skin-default m-active" data-skin="default"><span>Default</span></button></li>';
		style_switcher_html += '<li><button class="skin-mavericks" data-skin="mavericks"><span>Mavericks</span></button></li>';
		style_switcher_html += '<li><button class="skin-red-sunset" data-skin="red-sunset"><span>Red Sunset</span></button></li>';
		style_switcher_html += '<li><button class="skin-lime-breeze" data-skin="lime-breeze"><span>Lime Breeze</span></button></li>';
		style_switcher_html += '<li><button class="skin-sunrise" data-skin="sunrise"><span>Sunrise</span></button></li>';
		style_switcher_html += '<li><button class="skin-orient" data-skin="orient"><span>Orient</span></button></li>';
		style_switcher_html += '<li><button class="skin-coral" data-skin="coral"><span>Coral</span></button></li>';
		style_switcher_html += '<li><button class="skin-lavender" data-skin="lavender"><span>Lavender</span></button></li>';
		style_switcher_html += '</ul><ul class="switch-list">';
		style_switcher_html += '<li><button class="switch-animated-header m-active"><i class="ico fa fa-check-square-o"></i> Animated Header</button></li>';
		style_switcher_html += '</ul></div></div>';
		$( 'body' ).append( style_switcher_html );

		// INIT SWITCHER
		$( '#style-switcher' ).each(function(){

			var switcher = $(this),
			toggle = switcher.find( '.style-switcher-toggle' ),
			skins = switcher.find( '.skin-list button' ),
			switches = switcher.find( '.switch-list button' ),
			beautyspot_style_switcher_settings = {};

			//localStorage.clear();

			// SAVE SETTINGS
			var style_switcher_save = function(){
				if ( $( 'html' ).hasClass( 'localstorage' ) ) {
					localStorage.beautyspot_style_switcher_settings = JSON.stringify( beautyspot_style_switcher_settings );
				}
			};

			// LOAD SETTINGS
			if ( $( 'html' ).hasClass( 'localstorage' ) && localStorage.beautyspot_style_switcher_settings ) {

				beautyspot_style_switcher_settings = JSON.parse( localStorage.beautyspot_style_switcher_settings );

				// LOAD SAVED SKIN
				if ( typeof beautyspot_style_switcher_settings.skin !== 'undefined' ) {
					skins.filter( '.m-active' ).removeClass( 'm-active' );
					skins.filter( '[data-skin="' + beautyspot_style_switcher_settings.skin + '"]' ).addClass( 'm-active' );
					if ( $( 'head #skin-temp' ).length < 1 ) {
						$( 'head' ).append( '<link id="skin-temp" rel="stylesheet" type="text/css" href="' + templateDirectoryUri + '/library/css/skin/' + beautyspot_style_switcher_settings.skin + '.css">' );
					}
				}
				// LOAD ANIMATED HEADER SWITCH
				if ( typeof beautyspot_style_switcher_settings.animated_header !== 'undefined' ) {
					if ( beautyspot_style_switcher_settings.animated_header ) {
						switches.filter( '.switch-animated-header' ).addClass( 'm-active' );
						switches.filter( '.switch-animated-header' ).find( '.ico' ).removeClass( 'fa-square-o' ).addClass( 'fa-check-square-o' );
						$( '#header' ).addClass( 'm-animated' );
					}
					else {
						switches.filter( '.switch-animated-header' ).removeClass( 'm-active' );
						switches.filter( '.switch-animated-header' ).find( '.ico' ).removeClass( 'fa-check-square-o' ).addClass( 'fa-square-o' );
						$( '#header' ).removeClass( 'm-animated' );
					}
				}

			}

			// TOGGLE SWITCHER
			toggle.click(function(){
				switcher.toggleClass( 'm-active' );
			});
			/*toggle.hover(function(){
				toggle.find( 'i' ).addClass( 'fa-spin' );
			}, function(){
				toggle.find( 'i' ).removeClass( 'fa-spin' );
			});*/

			// SET SKIN
			skins.click(function(){
				skins.filter( '.m-active' ).removeClass( 'm-active' );
				$(this).toggleClass( 'm-active' );
				beautyspot_style_switcher_settings.skin = $(this).data( 'skin' );
				style_switcher_save();
				if ( $( 'head #skin-temp' ).length < 1 ) {
					$( 'head' ).append( '<link id="skin-temp" rel="stylesheet" type="text/css" href="' + templateDirectoryUri + '/library/css/skin/' + $(this).data( 'skin' ) + '.css">' );
				}
				else {
					$( '#skin-temp' ).attr( 'href', templateDirectoryUri + '/library/css/skin/' + $(this).data( 'skin' ) + '.css' );
				}

			});

			// SET SWITCHES
			switches.click(function(){

				var self = $(this),
				ico = self.find( '.ico' );
				self.toggleClass( 'm-active' );
				ico.toggleClass( 'fa-check-square-o fa-square-o' );

				// ANIMATED HEADER
				if ( self.hasClass( 'switch-animated-header' ) ) {
					$( '#header' ).toggleClass( 'm-animated' );
					beautyspot_style_switcher_settings.animated_header = self.hasClass( 'm-active' ) ? true : false;
				}

				style_switcher_save();

			});

		});

	}
	// STYLE SWITCHER END


/* -----------------------------------------------------------------------------

	10.) VARIOUS

----------------------------------------------------------------------------- */

	/* -------------------------------------------------------------------------
		GALLERY IMAGES FIX
	------------------------------------------------------------------------- */

	$( '.gallery .gallery-item img' ).removeAttr( 'height width' );

	/* -------------------------------------------------------------------------
		 CONTACT FORM 7 RESET FIX
	------------------------------------------------------------------------- */

	if ( $.fn.resetForm ) {
		$.fn.extend({
			resetForm: function() {
				$(this).find( '.checkbox-input.m-checked' ).each(function(){
					$(this).removeClass( 'm-checked' );
				});
				$(this).find( '.selectbox-input' ).each(function(){
					var defaultValue = $(this).find( 'select option:first-child' ).text();
					$(this).find( '.toggle span' ).text( defaultValue );
				});
				return this.each(function() {
					// guard against an input with the name of 'reset'
					// note that IE reports the reset function as an 'object'
					if (typeof this.reset == 'function' || (typeof this.reset == 'object' && !this.reset.nodeType)) {
						this.reset();
					}
				});
			}
		});
	}

/* END. */
});
})(jQuery);