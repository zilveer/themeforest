/**
 * Project: Total WordPress Theme
 * Description: Initialize all scripts and add custom js
 * Author: WPExplorer
 * Theme URI: http://www.wpexplorer.com
 * Author URI: http://www.wpexplorer.com
 * License: Custom
 * License URI: http://themeforest.net/licenses
 * Version 3.5.3
 */

( function( $ ) {
	'use strict';

	var wpexTheme = {

		/**
		 * Main init function
		 *
		 * @since 2.0.0
		 */
		init : function() {
			this.config();
			this.bindEvents();
		},

		/**
		 * Define vars for caching
		 *
		 * @since 2.0.0
		 */
		config : function() {

			this.config = {

				// Main
				$window                 : $( window ),
				$document               : $( document ),
				$windowWidth            : $( window ).width(),
				$windowHeight           : $( window ).height(),
				$windowTop              : $( window ).scrollTop(),
				$body                   : $( 'body' ),
				$viewportWidth          : '',
				$wpAdminBar             : null,
				$isRetina               : false,
				$heightChanged          : false,
				$widthChanged           : false,
				$isRTL                  : false,

				// Mobile
				$isMobile               : false,
				$mobileMenuStyle        : null,
				$mobileMenuToggleStyle  : null,
				$mobileMenuBreakpoint   : 960,

				// Main
				$siteWrap               : null,
				$siteMain               : null,

				// Header
				$siteHeader             : null,
				$siteHeaderStyle        : null,
				$siteHeaderHeight       : 0,
				$siteHeaderTop          : 0,
				$siteHeaderBottom       : 0,
				$verticalHeaderActive   : false,
				$hasHeaderOverlay       : false,
				$hasStickyHeader        : false,
				$hasStickyMobileHeader  : false,
				$hasStickyNavbar        : false,

				// Logo
				$siteLogo               : null,
				$siteLogoHeight         : 0,
				$siteLogoSrc            : null,

				// Nav
				$siteNavWrap            : null,
				$siteNav                : null,
				$siteNavDropdowns       : null,

				// Local Scroll
				$localScrollTargets     : 'li.local-scroll a, a.local-scroll, .local-scroll-link, .local-scroll-link > a',
				$localScrollOffset      : 0,
				$localScrollSpeed       : 600,
				$localScrollEasing      : 'easeInOutCubic',
				$localScrollSections    : [],   

				// Topbar
				$hasTopBar              : false,
				$hasStickyTopBar        : false,
				$stickyTopBar           : null,
				$hasStickyTopBarMobile  : false,

				// Footer
				$hasFixedFooter         : false

			};

		},

		/**
		 * Bind Events
		 *
		 * @since 2.0.0
		 */
		bindEvents : function() {
			var self = this;

			// Run on document ready
			self.config.$document.on( 'ready', function() {

				// Triggers
				$( '.vcex-module' ).trigger( 'vcexModule' );

				// Update vars on init
				self.initUpdateConfig();

				// Main nav dropdowns
				if ( self.config.$siteNav && $.fn.superfish !== undefined ) {
					self.superfish();
				}

				// Calculate megamenu width
				self.megaMenusWidth();

				// Mobile menu
				self.mobileMenu();

				// Prevent menu item click
				self.navNoClick();

				// Hide/show post edit link
				self.hideEditLink();

				// Custom menu widget accordion
				self.customMenuWidgetAccordion();

				// Center Header 5 Logo
				self.inlineHeaderLogo();

				// Menu search toggle,overlay,header replace
				self.menuSearch();

				// Header cart
				self.headerCart();

				// Back to top link
				self.backTopLink();

				// Scroll to comments
				self.smoothCommentScroll();

				// Tooltips
				self.tipsyTooltips();

				// Responsive text
				self.responsiveText();

				// Custom color hovers using data-attr
				self.customHovers();

				// Togglebar
				self.toggleBar();

				// Local scrolling links
				self.localScrollLinks();

				// Custom selects
				self.customSelects();

				// Carousels
				self.owlCarousel();

				// Archive masonry grids
				self.archiveMasonryGrids();

				// Lightbox
				self.iLightbox();

				// Overlay Hovers
				self.overlayHovers();

				// Skillbar
				self.skillbar();

				// Milestones
				self.milestone();

				// Countdown
				self.countdown();

				// TypedText
				self.typedText();

				// Equal height elements => Must run before masonry
				self.equalHeights();

				// Isotope masonry grids
				self.isotopeGrids();

				// VC Edits
				if ( self.config.$body.hasClass( 'wpb-js-composer' ) ) {
					self.visualComposer();
				}

			} );

			// Run on Window Load
			self.config.$window.on( 'load', function() {
				
				// Add class to body tag
				self.config.$body.addClass( 'wpex-window-loaded' );

				// Update config on window load
				self.windowLoadUpdateConfig();

				// Get correct mega menu top position
				self.megaMenusTop();

				// Setup flush dropdowns
				self.flushDropdownsTop();

				// FadeIn elements
				self.fadeIn();

				// Parallax backgrounds
				self.parallax();

				// Re-position cart dropdown as needed
				self.cartSearchDropdownsRelocate();

				// Sliders
				self.sliderPro();

				// Sticky Topbar
				if ( self.config.$hasStickyTopBar ) {
					self.stickyTopBar();
				}

				// Sticky Header
				if ( self.config.$hasStickyHeader ) {
					var $stickyStyle = wpexLocalize.stickyHeaderStyle;
					if ( 'standard' == $stickyStyle
						|| 'shrink' == $stickyStyle
						|| 'shrink_animated' == $stickyStyle
					) {
						self.stickyHeader();
						self.shrinkStickyHeader();
					}
				}

				// Sticky Navbar
				if ( self.config.$hasStickyNavbar ) {
					self.stickyHeaderMenu();
				}

				// Sticky vcex navbar
				self.stickyVcexNavbar();

				// Footer Reveal => Must run before fixed footer!!!
				self.footerReveal();

				// Fixed Footer
				self.fixedFooter();

				// Title + Breadcrumbs fix
				if ( self.config.$body.hasClass( 'has-breadcrumbs' ) ) {
					self.titleBreadcrumbsFix();
				}

				// Infinite scroll
				if ( $.fn.infinitescroll !== undefined && $( 'div.infinite-scroll-nav' ).length ) {
					self.infiniteScrollInit();
				}

				// Scroll to hash
				window.setTimeout( function() {
					self.scrollToHash( self )
				}, 500 );

			} );

			// Run on Window Resize
			self.config.$window.resize( function() {

				// Reset
				self.config.$widthChanged  = false;
				self.config.$heightChanged = false;

				// Window width change
				if ( self.config.$window.width() != self.config.$windowWidth ) {
					self.config.$widthChanged = true;
					self.widthResizeUpdateConfig();
				}

				// Height changes
				if ( self.config.$window.height() != self.config.$windowHeight ) {
					self.config.$windowHeight  = self.config.$window.height(); // update height
					self.config.$heightChanged = true;
				}

			} );

			// Run on Scroll
			self.config.$window.scroll( function() {

				// Reset
				self.config.$hasScrolled = false;

				// Yes we actually scrolled
				if ( self.config.$window.scrollTop() != self.config.$windowTop ) {
					self.config.$hasScrolled = true;
					self.config.$windowTop = self.config.$window.scrollTop();
					self.localScrollHighlight();
				}

			} );

			// On orientation change
			self.config.$window.on( 'orientationchange',function() {
				self.widthResizeUpdateConfig();
				self.isotopeGrids();
				self.archiveMasonryGrids();
			} );

		},

		/**
		 * Updates config on doc ready
		 *
		 * @since 3.0.0
		 */
		initUpdateConfig: function() {
			var self = this;

			// Get Viewport width
			self.config.$viewportWidth = self.viewportWidth();

			// Check if retina
			self.config.$isRetina = self.retinaCheck();
			if ( self.config.$isRetina ) {
				self.config.$body.addClass( 'wpex-is-retina' );
			}

			// Mobile check & add mobile class to the header
			if ( self.mobileCheck() ) {
				self.config.$isMobile = true;
				self.config.$body.addClass( 'wpex-is-mobile-device' );
			}

			// Define Wp admin bar
			var $wpAdminBar = $( '#wpadminbar' );
			if ( $wpAdminBar.length ) {
				self.config.$wpAdminBar = $wpAdminBar;
			}

			// Define wrap
			var $siteWrap = $( '#wrap' );
			if ( $siteWrap ) {
				self.config.$siteWrap = $siteWrap;
			}

			// Define main
			var $siteMain = $( '#main' );
			if ( $siteMain ) {
				self.config.$siteMain = $siteMain;
			}

			// Define header
			var $siteHeader = $( '#site-header' );
			if ( $siteHeader.length && ! $siteHeader.hasClass( 'header-builder' ) ) {
				self.config.$siteHeaderStyle = wpexLocalize.siteHeaderStyle;
				self.config.$siteHeader = $( '#site-header' );
			}

			// Define logo
			var $siteLogo = $( '#site-logo img' );
			if ( $siteLogo.length ) {
				self.config.$siteLogo = $siteLogo;
				self.config.$siteLogoSrc = self.config.$siteLogo.attr( 'src' );
			}

			// Menu Stuff
			var $siteNavWrap = $( '#site-navigation-wrap' );
			if ( $siteNavWrap.length ) {

				// Define menu
				self.config.$siteNavWrap = $siteNavWrap;
				var $siteNav = $( '#site-navigation', $siteNavWrap );
				if ( $siteNav.length ) {
					self.config.$siteNav = $siteNav;
				}

				// Check if sticky menu is enabled
				if ( wpexLocalize.hasStickyNavbar ) {
					self.config.$hasStickyNavbar = true;
				}

				// Store dropdowns
				var $siteNavDropdowns = $( '.dropdown-menu > .menu-item-has-children > ul', $siteNavWrap );
				if ( $siteNavWrap.length ) {
					self.config.$siteNavDropdowns = $siteNavDropdowns;
				}

			}

			// Mobile menu settings
			if ( wpexLocalize.hasMobileMenu ) {
				self.config.$mobileMenuStyle       = wpexLocalize.mobileMenuStyle;
				self.config.$mobileMenuToggleStyle = wpexLocalize.mobileMenuToggleStyle;
				self.config.$mobileMenuBreakpoint  = wpexLocalize.mobileMenuBreakpoint;
			}

			// Check if fixed footer is enabled
			if ( self.config.$body.hasClass( 'wpex-has-fixed-footer' ) ) {
				self.config.$hasFixedFooter = true;
			}
			
			// Footer reveal
			self.config.$footerReveal = $( '.footer-reveal-visible' );
			if ( self.config.$footerReveal.length && self.config.$siteWrap && self.config.$siteMain ) {
				self.config.$hasFooterReveal = true;
			}

			// Header overlay
			if ( self.config.$siteHeader && self.config.$body.hasClass( 'has-overlay-header' ) ) {
				self.config.$hasHeaderOverlay = true;
			}

			// RTL
			if ( wpexLocalize.isRTL ) {
				self.config.$isRTL = true;
			}

			// Top bar enabled
			var $topBarWrap =  $( '#top-bar-wrap' );
			if ( $topBarWrap.length ) {
				self.config.$hasTopBar = true;
				if ( $topBarWrap.hasClass( 'wpex-top-bar-sticky' ) ) {
					self.config.$stickyTopBar = $topBarWrap;
					if ( self.config.$stickyTopBar.length ) {
						self.config.$hasStickyTopBar = true;
						self.config.$hasStickyTopBarMobile = wpexLocalize.hasStickyTopBarMobile;
					}
				}
			}

			// Sticky Header => Mobile Check (must check first)
			self.config.$hasStickyMobileHeader = wpexLocalize.hasStickyMobileHeader;

			// Check if sticky header is enabled
			if ( self.config.$siteHeader && wpexLocalize.hasStickyHeader ) {
				self.config.$hasStickyHeader = true;
			}

			// Vertical header
			if ( this.config.$body.hasClass( 'wpex-has-vertical-header' ) ) {
				self.config.$verticalHeaderActive = true;
			}

			// Sticky VCEX Navbar => Disable all other sticky elements
			if ( $( '.vcex-navbar-sticky' ).length ) {
				self.config.$hasStickyTopBar = false;
				self.config.$hasStickyHeader = false;
				self.config.$hasStickyNavbar = false;
			}

			// Local scroll speed
			if ( wpexLocalize.localScrollSpeed ) {
				self.config.$localScrollSpeed = parseInt( wpexLocalize.localScrollSpeed );
			}

			// Local scroll easing
			if ( wpexLocalize.localScrollEasing ) {
				self.config.$localScrollEasing = wpexLocalize.localScrollEasing;
				if ( 'false' == self.config.$localScrollEasing ) {
					self.config.$localScrollEasing = 'swing';
				}
			}

			// Get local scrolling sections
			self.config.$localScrollSections = self.localScrollSections();

		},

		/**
		 * Updates config on window load
		 *
		 * @since 3.0.0
		 */
		windowLoadUpdateConfig: function() {

			// Header bottom position
			if ( this.config.$siteHeader ) {
				var $siteHeaderTop = this.config.$siteHeader.offset().top;
				this.config.$windowHeight = this.config.$window.height();
				this.config.$siteHeaderHeight = this.config.$siteHeader.outerHeight();
				this.config.$siteHeaderBottom = $siteHeaderTop + this.config.$siteHeaderHeight;
				this.config.$siteHeaderTop = $siteHeaderTop;
				if ( this.config.$siteLogo ) {
					this.config.$siteLogoHeight = this.config.$siteLogo.height();
				}
			}

			// Set localScrollOffset after site is loaded to make sure it includes dynamic items
			this.config.$localScrollOffset = this.parseLocalScrollOffset();

		},

		/**
		 * Updates config whenever the window is resized
		 *
		 * @since 3.0.0
		 */
		widthResizeUpdateConfig: function() {

			// Update main configs
			this.config.$windowHeight  = this.config.$window.height();
			this.config.$windowWidth   = this.config.$window.width();
			this.config.$windowTop     = this.config.$window.scrollTop();
			this.config.$viewportWidth = this.viewportWidth();

			// Update header height
			if ( this.config.$siteHeader ) {
				this.config.$siteHeaderHeight = this.config.$siteHeader.outerHeight();
			}

			// Get logo height
			if ( this.config.$siteLogo ) {
				this.config.$siteLogoHeight = this.config.$siteLogo.height();
			}

			// Vertical Header
			if ( this.config.$windowWidth < 960 ) {
				this.config.$verticalHeaderActive = false;
			} else if ( this.config.$body.hasClass( 'wpex-has-vertical-header' ) ) {
				this.config.$verticalHeaderActive = true;
			}

			// Local scroll offset => update last
			this.config.$localScrollOffset = this.parseLocalScrollOffset();

			// Re-run functions
			this.megaMenusWidth();
			this.inlineHeaderLogo();
			this.cartSearchDropdownsRelocate();
			this.overlayHovers();
			this.responsiveText();

		},

		/**
		 * Retina Check
		 *
		 * @since 3.4.0
		 */
		retinaCheck: function() {
			var mediaQuery = '(-webkit-min-device-pixel-ratio: 1.5), (min--moz-device-pixel-ratio: 1.5), (-o-min-device-pixel-ratio: 3/2), (min-resolution: 1.5dppx)';
			if ( window.devicePixelRatio > 1 ) {
				return true;
			}
			if ( window.matchMedia && window.matchMedia( mediaQuery ).matches ) {
				return true;
			}
			return false;
		},

		/**
		 * Mobile Check
		 *
		 * @since 2.1.0
		 */
		mobileCheck: function() {
			if ( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test( navigator.userAgent ) ) {
				return true;
			}
		},

		/**
		 * Viewport width
		 *
		 * @since 3.4.0
		 */
		viewportWidth: function() {
			var e = window, a = 'inner';
			if ( ! ( 'innerWidth' in window ) ) {
				a = 'client';
				e = document.documentElement || document.body;
			}
			return e[ a+'Width' ];
		},

		/**
		 * Superfish menus
		 *
		 * @since 2.0.0
		 */
		superfish: function() {
			$( 'ul.sf-menu', this.config.$siteNav ).superfish( {
				delay     : wpexLocalize.superfishDelay,
				speed     : wpexLocalize.superfishSpeed,
				speedOut  : wpexLocalize.superfishSpeedOut,
				cssArrows : false,
				disableHI : false,
				animation   : {
					opacity : 'show'
				},
				animationOut : {
					opacity : 'hide'
				}
			} );
		},

		 /**
		 * MegaMenus Width
		 *
		 * @since 2.0.0
		 */
		megaMenusWidth: function() {

			if ( ! wpexLocalize.megaMenuJS
				|| 'one' != this.config.$siteHeaderStyle
				|| ! this.config.$siteNavDropdowns
				|| ! this.config.$siteNavWrap.is( ':visible' )
			) {
				return;
			}

			var $megamenu = $( '.megamenu > ul', this.config.$siteNavWrap );
			if ( ! $megamenu.length ) return; // Don't do anything if there isn't any megamenu

			var $headerContainerWidth       = this.config.$siteHeader.find( '.container' ).outerWidth();
			var $navWrapWidth               = this.config.$siteNavWrap.outerWidth();
			var $siteNavigationWrapPosition = this.config.$siteNavWrap.css( 'right' );
			var $siteNavigationWrapPosition = parseInt( $siteNavigationWrapPosition );

			if ( 'auto' == $siteNavigationWrapPosition ) {
				$siteNavigationWrapPosition = 0;
			}

			var $megaMenuNegativeMargin = $headerContainerWidth-$navWrapWidth-$siteNavigationWrapPosition;

			$megamenu.css( {
				'width'       : $headerContainerWidth,
				'margin-left' : -$megaMenuNegativeMargin
			} );

		},

		/**
		 * MegaMenus Top Position
		 *
		 * @since 2.0.0
		 */
		megaMenusTop: function() {
			var self = this
			if ( ! self.config.$siteNavDropdowns
				|| 'one' != self.config.$siteHeaderStyle
			) {
				return;
			}

			var $megamenu = $( '.megamenu > ul', self.config.$siteNavWrap );
			if ( ! $megamenu.length ) return; // Don't do anything if there isn't any megamenu

			function setPosition() {
				if ( self.config.$siteNavWrap.is( ':visible' ) ) {
					var $headerHeight = self.config.$siteHeader.outerHeight();
					var $navHeight    = self.config.$siteNavWrap.outerHeight();
					var $megaMenuTop  = $headerHeight - $navHeight;
					$megamenu.css( {
						'top' : $megaMenuTop/2 + $navHeight
					} );
				}
			}
			setPosition();

			// update on scroll
			this.config.$window.scroll( function() {
				setPosition();
			} );

			// Update on resize
			this.config.$window.resize( function() {
				setPosition();
			} );

			// Update on hover just incase
			$( '.megamenu > a', self.config.$siteNav ).hover( function() {
				setPosition();
			} );

		},

		/**
		 * FlushDropdowns top positioning
		 *
		 * @since 2.0.0
		 */
		flushDropdownsTop: function() {
			var self = this;
			if ( ! self.config.$siteNavDropdowns || ! self.config.$siteNavWrap.hasClass( 'wpex-flush-dropdowns' ) ) {
				return;
			}

			// Set position
			function setPosition() {
				if ( self.config.$siteNavWrap.is( ':visible' ) ) {
					var $headerHeight      = self.config.$siteHeader.outerHeight();
					var $siteNavWrapHeight = self.config.$siteNavWrap.outerHeight();
					var $dropTop           = $headerHeight - $siteNavWrapHeight;
					self.config.$siteNavDropdowns.css( 'top', $dropTop/2 + $siteNavWrapHeight );
				}
			}
			setPosition();

			// Update on scroll
			this.config.$window.scroll( function() {
				setPosition();
			} );

			// Update on resize
			this.config.$window.resize( function() {
				setPosition();
			} );

			// Update on hover
			$( '.wpex-flush-dropdowns li.menu-item-has-children > a' ).hover( function() {
				setPosition();
			} );

		},

		/**
		 * Mobile Menu
		 *
		 * @since 2.0.0
		 */
		mobileMenu: function( event ) {
			var self = this;

			/***** Sidr Mobile Menu ****/
			if ( 'sidr' == this.config.$mobileMenuStyle && typeof wpexLocalize.sidrSource !== 'undefined' ) {

				// Add dark overlay to content
				self.config.$body.append( '<div class="wpex-sidr-overlay wpex-hidden"></div>' );
				var $sidrOverlay = $( '.wpex-sidr-overlay' );

				// Add sidr
				$( 'a.mobile-menu-toggle, li.mobile-menu-toggle > a' ).sidr( {
					name     : 'sidr-main',
					source   : wpexLocalize.sidrSource,
					side     : wpexLocalize.sidrSide,
					displace : wpexLocalize.sidrDisplace,
					speed    : parseInt( wpexLocalize.sidrSpeed ),
					renaming : true,
					onOpen   : function() {

						// Add extra classname
						$( '#sidr-main' ).addClass( 'wpex-mobile-menu' );

						// Prevent body scroll
						if ( wpexLocalize.sidrBodyNoScroll ) {
							self.config.$body.addClass( 'wpex-noscroll' );
						}

						// Declare useful vars
						var $hasChildren = $( '.sidr-class-menu-item-has-children' );

						// Add dropdown toggle (arrow)
						$hasChildren.children( 'a' ).append( '<span class="sidr-class-dropdown-toggle"></span>' );

						// Toggle dropdowns
						var $sidrDropdownTarget = $( '.sidr-class-dropdown-toggle' );

						// Check localization
						if ( wpexLocalize.sidrDropdownTarget == 'li' ) {
							$sidrDropdownTarget = $( '.sidr-class-menu-item-has-children > a' );
						}

						// Add toggle click event
						$sidrDropdownTarget.on( 'click', function( event ) {

							// Define toggle vars
							if ( wpexLocalize.sidrDropdownTarget == 'li' ) {
								var $toggleParentLi = $( this ).parent( 'li' );
							} else {
								var $toggleParentLink = $( this ).parent( 'a' ),
									$toggleParentLi   = $toggleParentLink.parent( 'li' );
							}

							// Get parent items and dropdown
							var $allParentLis = $toggleParentLi.parents( 'li' ),
								$dropdown     = $toggleParentLi.children( 'ul' );

							// Toogle items
							if ( ! $toggleParentLi.hasClass( 'active' ) ) {
								$hasChildren.not( $allParentLis ).removeClass( 'active' ).children( 'ul' ).slideUp( 'fast' );
								$toggleParentLi.addClass( 'active' ).children( 'ul' ).slideDown( 'fast' );
							} else {
								$toggleParentLi.removeClass( 'active' ).children( 'ul' ).slideUp( 'fast' );
							}

							// Return false
							return false;

						} );

						// FadeIn Overlay
						$sidrOverlay.fadeIn( wpexLocalize.sidrSpeed );

						// Close sidr when clicking on overlay
						$( '.wpex-sidr-overlay' ).on( 'click', function( event ) {
							$.sidr( 'close', 'sidr-main' );
							return false;
						} );

						/* Bind scroll - buggy
						$( '#sidr-main' ).bind( 'mousewheel DOMMouseScroll', function ( e ) {
							var e0 = e.originalEvent,
								delta = e0.wheelDelta || -e0.detail;
							this.scrollTop += ( delta < 0 ? 1 : -1 ) * 30;
							e.preventDefault();
						} );*/

					},
					onClose : function() {

						// Remove body noscroll class
						if ( wpexLocalize.sidrBodyNoScroll ) {
							self.config.$body.removeClass( 'wpex-noscroll' );
						}

						// Remove active dropdowns
						$( '.sidr-class-menu-item-has-children.active' ).removeClass( 'active' ).children( 'ul' ).hide();
						
						// FadeOut overlay
						$sidrOverlay.fadeOut( wpexLocalize.sidrSpeed );
					}

				} );

				// Cache main sidebar var
				var $sidrMain = $( '#sidr-main' );

				// Re-name font Icons to correct classnames
				$( "[class*='sidr-class-fa']", $sidrMain ).attr( 'class',
					function( i, c ) {
					c = c.replace( 'sidr-class-fa', 'fa' );
					c = c.replace( 'sidr-class-fa-', 'fa-' );
					return c;
				} );

				// Close sidr when clicking toggle
				$( 'a.sidr-class-toggle-sidr-close', $sidrMain ).on( 'click', function( event ) {
					$.sidr( 'close', 'sidr-main' );
					return false;
				} );

				// Close on resize past mobile menu breakpoint
				self.config.$window.resize( function() {
					if ( self.config.$viewportWidth >= self.config.$mobileMenuBreakpoint ) {
						$.sidr( 'close', 'sidr-main' );
					}
				} );

				// Close sidr when clicking local scroll link
				$( 'li.sidr-class-local-scroll > a', $sidrMain ).click( function() {
					var $hash = this.hash;
					if ( $.inArray( $hash, self.config.$localScrollSections ) > -1 ) {
						$.sidr( 'close', 'sidr-main' );
						self.scrollTo( $hash );
						return false;
					}
				} );

			}

			/***** Toggle Mobile Menu ****/
			else if ( 'toggle' == self.config.$mobileMenuStyle && self.config.$siteNav ) {

				var $position = wpexLocalize.mobileToggleMenuPosition;
				var $classes  = 'mobile-toggle-nav wpex-mobile-menu wpex-clr wpex-position-'+ $position;

				// Insert nav in fixed_top mobile menu
				if ( 'fixed_top' == self.config.$mobileMenuToggleStyle ) {
					$( '#wpex-mobile-menu-fixed-top' ).append( '<nav class="'+ $classes +'"></nav>' );
				}

				// Absolute position
				else if ( 'absolute' == $position ) {
					if ( 'navbar' == self.config.$mobileMenuToggleStyle ) {
						$( '#wpex-mobile-menu-navbar' ).append( '<nav class="'+ $classes +'"></nav>' );
					} else {
						self.config.$siteHeader.append( '<nav class="'+ $classes +'"></nav>' );
					}
				}

				// Normal toggle insert
				else {
					$( '<nav class="'+ $classes +'"></nav>' ).insertAfter( self.config.$siteHeader );
				}

				// cache element
				var $mobileToggleNav = $( '.mobile-toggle-nav' );

				// Grab all content from menu and add into mobile-toggle-nav element
				if ( $( '#mobile-menu-alternative' ).length ) {
					var mobileMenuContents = $( '#mobile-menu-alternative .dropdown-menu' ).html();
				} else {
					var mobileMenuContents = $( '.dropdown-menu', self.config.$siteNav ).html();
				}
				$mobileToggleNav.html( '<ul class="mobile-toggle-nav-ul">' + mobileMenuContents + '</ul>' );

				// Remove all styles
				$( '.mobile-toggle-nav-ul, .mobile-toggle-nav-ul *' ).children().each( function() {
					var attributes = this.attributes;
					$( this ).removeAttr( 'style' );
				} );

				// Add classes where needed
				$( '.mobile-toggle-nav-ul' ).addClass( 'container' );

				// Show/Hide
				$( '.mobile-menu-toggle' ).on( 'click', function( event ) {
					if ( wpexLocalize.animateMobileToggle ) {
						$( '.mobile-toggle-nav' ).stop(true,true).slideToggle( 'fast' ).toggleClass( 'visible' );
					} else {
						$( '.mobile-toggle-nav' ).toggle().toggleClass( 'visible' );
					}
					return false;
				} );

				// Close on resize
				if ( $mobileToggleNav.length ) {
					self.config.$window.resize( function() {
						if ( self.config.$viewportWidth >= self.config.$mobileMenuBreakpoint ) {
							$mobileToggleNav.hide().removeClass( 'visible' );
						}
					} );
				}

				// Add search to toggle menu
				var $mobileSearch = $( '#mobile-menu-search' );
				if ( $mobileSearch.length ) {
					$mobileToggleNav.append( '<div class="mobile-toggle-nav-search container"></div>' );
					$( '.mobile-toggle-nav-search' ).append( $mobileSearch );
				}

			}

			/***** Full-Screen Overlay Mobile Menu ****/
			else if ( 'full_screen' == self.config.$mobileMenuStyle && self.config.$siteHeader ) {

				// Style
				var $style = wpexLocalize.fullScreenMobileMenuStyle ? wpexLocalize.fullScreenMobileMenuStyle : false;

				// Insert new nav
				self.config.$body.append( '<div class="full-screen-overlay-nav wpex-mobile-menu wpex-clr '+ $style +'"><span class="full-screen-overlay-nav-close"></span><nav class="full-screen-overlay-nav-ul-wrapper"><ul class="full-screen-overlay-nav-ul"></ul></nav></div>' );

				// Grab all content from menu and add into mobile-toggle-nav element
				if ( $( '#mobile-menu-alternative' ).length ) {
					var mobileMenuContents = $( '#mobile-menu-alternative .dropdown-menu' ).html();
				} else {
					var mobileMenuContents = $( '#site-navigation .dropdown-menu' ).html();
				}
				$( '.full-screen-overlay-nav-ul' ).html( mobileMenuContents );

				// Cache element
				var $fullScreenNav = $( '.full-screen-overlay-nav' );

				// Remove all styles
				$( '.full-screen-overlay-nav, .full-screen-overlay-nav *' ).children().each( function() {
					var attributes = this.attributes;
					$( this ).removeAttr( 'style' );
				} );

				// Show
				$( '.mobile-menu-toggle' ).on( 'click', function( event ) {
					$fullScreenNav.addClass( 'visible' );
					self.config.$body.addClass( 'wpex-noscroll' );
					return false;
				} );

				// Hide
				$( '.full-screen-overlay-nav-close' ).on( 'click', function( event ) {
					$fullScreenNav.removeClass( 'visible' );
					self.config.$body.removeClass( 'wpex-noscroll' );
					return false;
				} );

			}

		},

		/**
		 * Prevent clickin on links
		 *
		 * @since 2.0.0
		 */
		navNoClick: function() {
			$( 'li.nav-no-click > a, li.sidr-class-nav-no-click > a' ).on( 'click', function() {
				return false;
			} );
		},

		/**
		 * Header Search
		 *
		 * @since 2.0.0
		 */
		menuSearch: function() {
			var self = this;

			/**** Menu Search > Dropdown ****/
			if ( 'drop_down' == wpexLocalize.menuSearchStyle ) {

				var $searchDropdownToggle = $( 'a.search-dropdown-toggle' );
				var $searchDropdownForm   = $( '#searchform-dropdown' );

				$searchDropdownToggle.click( function( event ) {
					// Display search form
					$searchDropdownForm.toggleClass( 'show' );
					// Active menu item
					$( this ).parent( 'li' ).toggleClass( 'active' );
					// Focus
					var $transitionDuration = $searchDropdownForm.css( 'transition-duration' );
					$transitionDuration = $transitionDuration.replace( 's', '' ) * 1000;
					if ( $transitionDuration ) {
						setTimeout( function() {
							$searchDropdownForm.find( 'input[type="search"]' ).focus();
						}, $transitionDuration );
					}
					// Hide other things
					$( 'div#current-shop-items-dropdown' ).removeClass( 'show' );
					$( 'li.wcmenucart-toggle-dropdown' ).removeClass( 'active' );
					// Return false
					return false;
				} );

				// Close on doc click
				self.config.$document.on( 'click', function( event ) {
					if ( ! $( event.target ).closest( '#searchform-dropdown.show' ).length ) {
						$searchDropdownToggle.parent( 'li' ).removeClass( 'active' );
						$searchDropdownForm.removeClass( 'show' );
					}
				} );

			}

			/**** Menu Search > Overlay Modal ****/
			else if ( 'overlay' == wpexLocalize.menuSearchStyle ) {

				if ( ! $.fn.leanerModal ) {
					return;
				}

				var $searchOverlayToggle = $( 'a.search-overlay-toggle' );

				$searchOverlayToggle.leanerModal( {
					'id'      : '#searchform-overlay',
					'top'     : 100,
					'overlay' : 0.8
				} );

				$searchOverlayToggle.click( function() {
					$( '#site-searchform input' ).focus();
				} );

			}
			
			/**** Menu Search > Header Replace ****/
			else if ( 'header_replace' == wpexLocalize.menuSearchStyle ) {

				// Show
				var $headerReplace = $( '#searchform-header-replace' );
				$( 'a.search-header-replace-toggle' ).click( function( event ) {
					// Display search form
					$headerReplace.toggleClass( 'show' );
					// Focus
					var $transitionDuration =  $headerReplace.css( 'transition-duration' );
					$transitionDuration = $transitionDuration.replace( 's', '' ) * 1000;
					if ( $transitionDuration ) {
						setTimeout( function() {
							$headerReplace.find( 'input[type="search"]' ).focus();
						}, $transitionDuration );
					}
					// Return false
					return false;
				} );

				// Close on click
				$( '#searchform-header-replace-close' ).click( function() {
					$headerReplace.removeClass( 'show' );
					return false;
				} );

				// Close on doc click
				self.config.$document.on( 'click', function( event ) {
					if ( ! $( event.target ).closest( $( '#searchform-header-replace.show' ) ).length ) {
						$headerReplace.removeClass( 'show' );
					}
				} );
			}

		},

		/**
		 * Header Cart
		 *
		 * @since 2.0.0
		 */
		headerCart: function() {

			if ( $( 'a.wcmenucart' ).hasClass( 'go-to-shop' ) ) {
				return;
			}

			var $toggle = $( '.toggle-cart-widget' );
			if ( ! $toggle.length ) return;

			// Drop-down
			if ( 'drop_down' == wpexLocalize.wooCartStyle ) {

				var $dropdown = $( 'div#current-shop-items-dropdown' );
				if ( ! $dropdown.length ) return;

				// Display cart dropdown
				$toggle.click( function( event ) {
					$( '#searchform-dropdown' ).removeClass( 'show' );
					$( 'a.search-dropdown-toggle' ).parent( 'li' ).removeClass( 'active' );
					$dropdown.toggleClass( 'show' );
					$( this ).toggleClass( 'active' );
					return false;
				} );

				// Hide cart dropdown
				$dropdown.click( function( event ) {
					event.stopPropagation(); 
				} );
				this.config.$document.click( function() {
					$dropdown.removeClass( 'show' );
					$toggle.removeClass( 'active' );
				} );

				/* Prevent body scroll on current shop dropdown - seems buggy...
				$( '#current-shop-items-dropdown' ).bind( 'mousewheel DOMMouseScroll', function ( e ) {
					var e0 = e.originalEvent,
						delta = e0.wheelDelta || -e0.detail;
					this.scrollTop += ( delta < 0 ? 1 : -1 ) * 30;
					e.preventDefault();
				} );*/

			}

			// Modal
			else if ( 'overlay' == wpexLocalize.wooCartStyle && $.fn.leanerModal != undefined ) {

				$toggle.leanerModal( {
					id      : '#current-shop-items-overlay',
					top     : 100,
					overlay : 0.8
				} );

			}

		},

		/**
		 * Relocate the cart and search dropdowns for specific header styles
		 *
		 * @since 2.0.0
		 */
		cartSearchDropdownsRelocate: function() {

			// Validate first
			if ( this.config.$hasHeaderOverlay
				|| ! this.config.$siteHeader
				|| ! this.config.$siteHeader.hasClass( 'wpex-reposition-cart-search-drops' )
				|| ! this.config.$siteNav
				|| ! this.config.$siteNav.is( ':visible' )
			) {
				return;
			}

			// Get last menu item
			var $lastMenuItem = $( '.dropdown-menu > li:nth-last-child(1)', this.config.$siteNav );
			if ( ! $lastMenuItem.length ) return;

			// Define vars
			var $searchDrop         = $( '#searchform-dropdown' );
			var $shopDrop           = $( '#current-shop-items-dropdown' );
			var $lastMenuItemOffset = $lastMenuItem.position();

			// Position search dropdown
			if ( $searchDrop.length ) {
				$searchDrop.css( {
					'right' : 'auto',
					'left'  : $lastMenuItemOffset.left - $searchDrop.outerWidth() + $lastMenuItem.width()
				} );
			}

			// Position Woo dropdown
			if ( $shopDrop.length ) {
				$shopDrop.css( {
					'right' : 'auto',
					'left'  : $lastMenuItemOffset.left - $shopDrop.outerWidth() + $lastMenuItem.width()
				} );
			}

		},

		/**
		 * Hide post edit link
		 *
		 * @since 2.0.0
		 */
		hideEditLink: function() {
			$( 'a.hide-post-edit', $( '#content' ) ).click( function() {
				$( 'div.post-edit' ).hide();
				return false;
			} );
		},

		/**
		 * Custom menu widget toggles
		 *
		 * @since 2.0.0
		 */
		customMenuWidgetAccordion: function() {
			var self = this;

			// Open toggle for active page
			$( '.widget_nav_menu .current-menu-ancestor', self.config.$siteMain ).addClass( 'active' ).children( 'ul' ).show();

			// Toggle items
			$( '.widget_nav_menu', self.config.$siteMain ).each( function() {
				var $widgetMenu  = $( this );
				var $hasChildren = $( this ).find( '.menu-item-has-children' );
				var $allSubs     = $hasChildren.children( '.sub-menu' );
				$hasChildren.each( function() {
					$( this ).addClass( 'parent' );
					var $links = $( this ).children( 'a' );
					$links.on( 'click', function( event ) {
						var $linkParent = $( this ).parent( 'li' );
						var $allParents = $linkParent.parents( 'li' );
						if ( ! $linkParent.hasClass( 'active' ) ) {
							$hasChildren.not( $allParents ).removeClass( 'active' ).children( '.sub-menu' ).slideUp( 'fast' );
							$linkParent.addClass( 'active' ).children( '.sub-menu' ).stop( true, true ).slideDown( 'fast' );
						} else {
							$linkParent.removeClass( 'active' ).children( '.sub-menu' ).stop( true, true ).slideUp( 'fast' );
						}
						return false;
					} );
				} );
			} );

		},

		/**
		 * Header 5 - Inline Logo
		 *
		 * @since 2.0.0
		 */
		inlineHeaderLogo: function() {
			var self = this;

			// For header 5 only
			if ( 'five' != self.config.$siteHeaderStyle ) return;

			// Define vars
			var $headerLogo        = $( '#site-header-inner > .header-five-logo', self.config.$siteHeader );
			var $headerNav         = $( '.navbar-style-five', self.config.$siteHeader );
			var $navLiCount        = $headerNav.children( '#site-navigation' ).children( 'ul' ).children( 'li' ).size();
			var $navBeforeMiddleLi = Math.round( $navLiCount / 2 ) - parseInt( wpexLocalize.headerFiveSplitOffset );
			var $centeredLogo      = $( '.menu-item-logo .header-five-logo' );

			// Add logo into menu
			if ( this.config.$viewportWidth >= this.config.$mobileMenuBreakpoint && $headerLogo.length && $headerNav.length ) {
				$('<li class="menu-item-logo"></li>').insertAfter( $headerNav.find( '#site-navigation > ul > li:nth( '+ $navBeforeMiddleLi +' )' ) );
				$headerLogo.appendTo( $headerNav.find( '.menu-item-logo' ) );
			}

			// Remove logo from menu and add to header
			if ( this.config.$viewportWidth < this.config.$mobileMenuBreakpoint && $centeredLogo.length ) {
				$centeredLogo.prependTo( $( '#site-header-inner' ) );
				$( '.menu-item-logo' ).remove();
			}

			// Add display class to logo (hidden by default)
			$headerLogo.addClass( 'display' );

		},

		/**
		 * Back to top link
		 *
		 * @since 2.0.0
		 */
		backTopLink: function() {
			var self           = this;
			var $scrollTopLink = $( 'a#site-scroll-top' );

			if ( $scrollTopLink.length ) {

				var $speed = wpexLocalize.scrollTopSpeed ? parseInt( wpexLocalize.scrollTopSpeed ) : 1000;
				var $offset = wpexLocalize.scrollTopOffset ? parseInt( wpexLocalize.scrollTopOffset ) : 100;

				self.config.$window.scroll( function() {
					if ( $( this ).scrollTop() > $offset ) {
						$scrollTopLink.addClass( 'show' );
					} else {
						$scrollTopLink.removeClass( 'show' );
					}
				} );

				$scrollTopLink.on( 'click', function( event ) {
					$( 'html, body' ).stop(true,true).animate( {
						scrollTop : 0
					}, $speed, self.config.$localScrollEasing );
					return false;
				} );

			}

		},

		/**
		 * Smooth Comment Scroll
		 *
		 * @since 2.0.0
		 */
		smoothCommentScroll: function() {
			var self = this;
			$( '.single li.comment-scroll a' ).click( function( event ) {
				var $target = $( '#comments' );
				var $offset = $target.offset().top - self.config.$localScrollOffset - 20;
				self.scrollTo( $target, $offset );
				return false;
			} );
		},

		/**
		 * Tooltips
		 *
		 * @since 2.0.0
		 */
		tipsyTooltips: function() {

			$( 'a.tooltip-left' ).tipsy( {
				fade    : true,
				gravity : 'e'
			} );

			$( 'a.tooltip-right' ).tipsy( {
				fade    : true,
				gravity : 'w'
			} );

			$( 'a.tooltip-up' ).tipsy( {
				fade    : true,
				gravity : 's'
			} );

			$( 'a.tooltip-down' ).tipsy( {
				fade    : true,
				gravity : 'n'
			} );

		},


		/**
		 * Responsive Text
		 * Inspired by FlowType.JS
		 *
		 * @since 3.2.0
		 */
		responsiveText: function() {
			var self = this;
			var $responsiveText = $( '.wpex-responsive-txt' );
			$responsiveText.each( function() {
				var $this      = $( this );
				var $thisWidth = $this.width();
				var $data      = $this.data();
				var $minFont   = self.parseData( $data.minFontSize, 13 );
				var $maxMax    = self.parseData( $data.maxFontSize, 40 );
				var $ratio     = self.parseData( $data.responsiveTextRatio, 10 );
				var $fontBase  = $thisWidth / $ratio;
				var $fontSize   = $fontBase > $maxMax ? $maxMax : $fontBase < $minFont ? $minFont : $fontBase;
				$this.css( 'font-size', $fontSize + 'px' );
			} );
		},

		/**
		 * Custom hovers using data attributes
		 *
		 * @since 2.0.0
		 */
		customHovers: function() {

			$( '.wpex-data-hover' ).each( function() {

				var $this          = $( this );
				var $originalBg    = $( this ).css( 'backgroundColor' );
				var $originalColor = $( this ).css( 'color' );
				var $hoverBg       = $( this ).attr( 'data-hover-background' );
				var $hoverColor    = $( this ).attr( 'data-hover-color' );

				$this.hover( function () {
					if ( CSSStyleDeclaration.prototype.setProperty !== 'undefined' ) {
						if ( $hoverBg ) {
							this.style.setProperty( 'background-color', $hoverBg, 'important' );
						}
						if ( $hoverColor ) {
							this.style.setProperty( 'color', $hoverColor, 'important' );
						}
					} else {
						if ( $hoverBg ) {
							$this.css( 'background-color', $hoverBg );
						}
						if ( $hoverColor ) {
							$this.css( 'color', $hoverColor );
						}
					}
				}, function () {
					if ( CSSStyleDeclaration.prototype.setProperty !== 'undefined' ) {
						if ( $hoverBg ) {
							this.style.setProperty( 'background-color', $originalBg, 'important' );
						}
						if ( $hoverColor ) {
							this.style.setProperty( 'color', $originalColor, 'important' );
						}
					} else {
						if ( $hoverBg && $originalBg ) {
							$this.css( 'background-color', $originalBg );
						}
						if ( $hoverColor && $originalColor ) {
							$this.css( 'color', $originalColor );
						}
					}
				} );

			} );

		},


		/**
		 * Togglebar toggle
		 *
		 * @since 2.0.0
		 */
		toggleBar: function() {

			var self           = this;
			var $toggleBtn     = $( 'a.toggle-bar-btn, a.togglebar-toggle' );
			var $toggleBarWrap = $( '#toggle-bar-wrap' );

			if ( $toggleBtn.length && $toggleBarWrap.length ) {

				$toggleBtn.on( 'click', function( event ) {
					var $fa = $( '.toggle-bar-btn' ).find( '.fa' );
					if ( $fa.length ) {
						$fa.toggleClass( $toggleBtn.data( 'icon' ) );
						$fa.toggleClass( $toggleBtn.data( 'icon-hover' ) );
					}
					$toggleBarWrap.toggleClass( 'active-bar' );
					return false;
				} );

				// Close on doc click
				self.config.$document.on( 'click', function( event ) {
					if ( ! $( event.target ).closest( '#toggle-bar-wrap.active-bar' ).length ) {
						$toggleBarWrap.removeClass( 'active-bar' );
						var $fa = $toggleBtn.children( '.fa' );
						if ( $fa.length ) {
							$fa.removeClass( $toggleBtn.data( 'icon-hover' ) ).addClass( $toggleBtn.data( 'icon' ) );
						}
					}
				} );

			}

		},

		/**
		 * Skillbar
		 *
		 * @since 2.0.0
		 */
		skillbar: function() {
			$( '.vcex-skillbar' ).each( function() {
				var $this = $( this );
				$this.appear( function() {
					$this.find( '.vcex-skillbar-bar' ).animate( {
						width: $( this ).attr( 'data-percent' )
					}, 800 );
				} );
			}, {
				accX : 0,
				accY : 0
			} );
		},

		/**
		 * Milestones
		 *
		 * @since 2.0.0
		 */
		milestone: function() {
			$( '.vcex-milestone-time' ).each( function() {
				var $this       = $( this ),
					$data       = $this.data(),
					$startVal   = $data.startVal,
					$endVal     = $data.endVal,
					$decimals   = $data.decimals,
					$duration   = $data.duration;

				var options = {
					useEasing   : true,
					useGrouping : true,
					separator   : $data.separator,
					decimal     : $data.decimal,
					prefix      : '',
					suffix      : ''
				};
				var numAnim    = new CountUp( this, $startVal, $endVal, $decimals, $duration, options );
				$this.appear( function() {
					numAnim.start();
				} );
			} );
		},

		/**
		 * Countdown
		 *
		 * @since 2.0.0
		 */
		countdown: function() {
			if ( $.fn.countdown != undefined ) {
				$( '.vcex-countdown' ).each( function() {
					var $this    = $( this );
					var $endDate = $this.data( 'countdown' ),
						$days    = $this.data( 'days' ),
						$hours   = $this.data( 'hours' ),
						$minutes = $this.data( 'minutes' ),
						$seconds = $this.data( 'seconds' );
					if ( $endDate ) {
						$this.countdown( $endDate, function( event ) {
							$this.html( event.strftime( '<div>%D <small>' + $days + '</small></div> <div>%H <small>' + $hours + '</small> <div>%M <small></div>' + $minutes + '</small></div> <div>%S <small>' + $seconds + '</small></div>' ) );
						} );
					}
				} );
			}
		},

		/**
		 * Typed Text
		 *
		 * @since 2.0.0
		 */
		typedText: function() {
			if ( $.fn.typed != undefined ) {
				$( '.vcex-typed-text' ).each( function() {
					var $this     = $( this );
					var $settings = $this.data( 'settings' );
					$settings.typeSpeed = parseInt( $settings.typeSpeed );
					$settings.backDelay = parseInt( $settings.backDelay );
					$settings.backSpeed = parseInt( $settings.backSpeed );
					$settings.startDelay = parseInt( $settings.startDelay );
					$settings.strings = $this.data( 'strings' );
					$this.typed( $settings );
				} );
			}
		},

		/**
		 * Advanced Parallax
		 *
		 * @since 2.0.0
		 */
		parallax: function() {
			$( '.wpex-parallax-bg' ).each( function() {
				var $this = $( this );
				$this.scrolly2().trigger( 'scroll' );
				$this.css( {
					'opacity' : 1
				} );
			} );
		},

		/**
		 * Local Scroll Offset
		 *
		 * @since 2.0.0
		 */
		parseLocalScrollOffset: function() {
			var self    = this;
			var $offset = 0;

			// Return custom offset
			if ( wpexLocalize.localScrollOffset ) {
				return wpexLocalize.localScrollOffset;
			}

			// VCEX Navbar module
			if ( $( '.vcex-navbar-sticky' ).length ) {
				var $vcexNavbarSticky = $( '.vcex-navbar-sticky' );
				if ( $vcexNavbarSticky.is( ':visible' ) ) {
					$offset = parseInt( $offset ) + parseInt( $( '.vcex-navbar-sticky' ).outerHeight() );
					return $offset; // when active it's the only thing to offset
				}
			}

			// Fixed header
			if ( self.config.$hasStickyHeader ) {

				// Return 0 for small screens if mobile fixed header is disabled
				if ( ! self.config.$hasStickyMobileHeader && self.config.$windowWidth <= wpexLocalize.stickyHeaderBreakPoint ) {
					$offset = 0;
				}

				// Return header height
				else {

					// Shrink header
					if ( self.config.$siteHeader.hasClass( 'shrink-sticky-header' ) ) {
						$offset = wpexLocalize.shrinkHeaderHeight;
					}

					// Standard header
					else {
						$offset = self.config.$siteHeaderHeight;
					}

				}

			}

			// Fixed Nav
			if ( self.config.$hasStickyNavbar ) {
				if ( self.config.$viewportWidth >= wpexLocalize.stickyNavbarBreakPoint ) {
					$offset = parseInt( $offset ) + parseInt( self.config.$siteNavWrap.outerHeight() );
				}
			}

			// Fixed Mobile menu
			if ( 'fixed_top' == self.config.$mobileMenuToggleStyle ) {
				var $mmFixed = $( '#wpex-mobile-menu-fixed-top' );
				if ( $mmFixed.length && $mmFixed.is( ':visible' ) ) {
					$offset = parseInt( $offset ) + parseInt( $mmFixed.outerHeight() );
				}
			}

			// Add sticky topbar height offset
			if ( self.config.$stickyTopBar ) {
				$offset = parseInt( $offset ) + parseInt( self.config.$stickyTopBar.outerHeight() );
			}

			// Add wp toolbar
			if ( $( '#wpadminbar' ).length ) {
				$offset = parseInt( $offset ) +  parseInt( $( '#wpadminbar' ).outerHeight() );
			}

			// Add 1 extra decimal to prevent cross browser rounding issues - @todo Double test
			$offset = $offset ? $offset - 1 : 0;

			// Return offset
			return $offset;

		},

		/**
		 * Scroll to function
		 *
		 * @since 2.0.0
		 */
		scrollTo: function( hash, offset, callback ) {

			// Hash is required
			if ( ! hash ) {
				return;
			}

			// Define important vars
			var self          = this;
			var $target       = null;
			var $page         = $( 'html, body' );
			var $isLsDataLink = false;

			// Check for target in data attributes
			var $lsTarget = $( '[data-ls_id="'+ hash +'"]' );

			if ( $lsTarget.length ) {
				$target       = $lsTarget;
				$isLsDataLink = true;
			}

			// Check for straight up element with ID
			else {
				if ( typeof hash == 'string' ) {
					$target = $( hash );
				} else {
					$target = hash;
				}
			}

			// Target check
			if ( $target.length ) {

				// LocalScroll vars
				var $lsSpeed  = self.config.$localScrollSpeed ? parseInt( self.config.$localScrollSpeed ) : 1000
				var $lsOffset = self.config.$localScrollOffset;
				var $lsEasing = self.config.$localScrollEasing;

				// Sanitize offset
				offset = offset ? offset : $target.offset().top - $lsOffset;

				// Update hash
				if ( hash && $isLsDataLink && wpexLocalize.localScrollUpdateHash ) {
					window.location.hash = hash;
				}

				/* Remove hash on site top click
				if ( '#site_top' == hash && wpexLocalize.localScrollUpdateHash && window.location.hash ) {
					history.pushState('', document.title, window.location.pathname);
				}*/

				// Mobile toggle Menu needs it's own code
				var $mobileToggleNav = $( '.mobile-toggle-nav' );
				if ( $mobileToggleNav.length && $mobileToggleNav.is( ':visible' ) ) {

					if ( wpexLocalize.animateMobileToggle ) {
						$( '.mobile-toggle-nav' ).slideUp( 'fast', function() {
							$( '.mobile-toggle-nav' ).removeClass( 'visible' );
							$page.stop( true, true ).animate( {
								scrollTop: $target.offset().top - $lsOffset
							}, $lsSpeed );
						} );
					} else {
						$( '.mobile-toggle-nav' ).hide().removeClass( 'visible' );
						$page.stop( true, true ).animate( {
							scrollTop: $target.offset().top - $lsOffset
						}, $lsSpeed );
					}

				}

				// Scroll to target
				else {
					$page.stop( true, true ).animate( {
						scrollTop: offset
					}, $lsSpeed, $lsEasing );
				}

			}

		},

		/**
		 * Scroll to Hash
		 *
		 * @since 2.0.0
		 */
		scrollToHash: function( $this ) {

			// Declare function vars
			var self  = $this;
			var $hash = location.hash;

			// Hash needed
			if ( ! $hash ) {
				return;
			}

			// Scroll to comments
			if ( '#view_comments' == $hash || '#comments_reply' == $hash ) {
				var $target = $( '#comments' );
				var $offset = $target.offset().top - self.config.$localScrollOffset - 20;
				if ( $target.length ) {
					self.scrollTo( $target, $offset );
				}
				return;
			}

			// Scroll to hash for localscroll links
			if ( $hash.indexOf( 'localscroll-' ) != -1 ) {
				self.scrollTo( $hash.replace( 'localscroll-', '' ) );
				return;
			}

			// Check elements with data attributes
			if ( $( '[data-ls_id="'+ $hash +'"]' ).length ) {
				self.scrollTo( $hash );
				return;
			}

		},

		/**
		 * Local scroll links array
		 *
		 * @since 2.0.0
		 */
		localScrollSections: function() {
			var self = this;

			// Add local-scroll class to links in menu with localscroll- prefix (if on same page)
			// And add to $localScrollTargets
			// And add data-ls_linkto attr
			if ( self.config.$siteNav ) {
				var $navLinks    = $( 'a', this.config.$siteNav );
				var $location    = location;
				var $currentPage = $location.href;
				var $currentPage = $location.hash ? $currentPage.substr( 0, $currentPage.indexOf( '#' ) ) : $currentPage;
				$navLinks.each( function() {
					var $this = $( this );
					var $ref = $this.attr( 'href' );
						if ( $ref && $ref.indexOf( 'localscroll-' ) != -1 ) {
							$this.parent( 'li' ).addClass( 'local-scroll' );
							var $withoutHash = $ref.substr( 0, $ref.indexOf( '#' ) );
							if ( $withoutHash == $currentPage ) {
								var $hash = $ref.substring( $ref.indexOf( '#' ) + 1 );
								var $parseHash = $hash.replace( 'localscroll-', '' );
								$this.attr( 'data-ls_linkto', '#' + $parseHash );
							}
						}
				} );
			}

			// Define main vars
			var $array = [],
				$links = $( self.config.$localScrollTargets );

			// Loop through links
			for ( var i=0; i < $links.length; i++ ) {

				// Add to array and save hash
				var $link = $links[i],
					$linkDom = $( $link ),
					$href = $( $link ).attr( 'href' ),
					$hash = $href ? '#' + $href.replace( /^.*?(#|$)/, '' ) : null;

				// Hash required
				if ( $hash ) {

					// Add custom data attribute to each
					if ( ! $linkDom.attr( 'data-ls_linkto' ) ) {
						$linkDom.attr( 'data-ls_linkto', $hash );
					}

					// Data attribute targets
					if ( $( '[data-ls_id="'+ $hash +'"]' ).length ) {
						if ( $.inArray( $hash, $array ) == -1 ) {
							$array.push( $hash );
						}
					}

					// Standard ID targets
					else if ( $( $hash ).length ) {
						if ( $.inArray( $hash, $array ) == -1 ) {
							$array.push( $hash );
						}
					}

				}

			}

			// Return array of local scroll links
			return $array;

		},

		/**
		 * Local Scroll link
		 *
		 * @since 2.0.0
		 */
		localScrollLinks: function() {
			var self = this;

			// Local Scroll - Menus
			$( self.config.$localScrollTargets ).on( 'click', function() {
				var $hash = $( this ).attr( 'data-ls_linkto' );
				$hash = $hash ? $hash : this.hash; // Fallback
				if ( $.inArray( $hash, self.config.$localScrollSections ) > -1 ) {
					self.scrollTo( $hash );
					return false;
				}
			} );

			// LocalScroll Woocommerce Reviews
			$( 'a.woocommerce-review-link', $( 'body.single div.entry-summary' ) ).click( function() {
				var $target = $( '.woocommerce-tabs' );
				if ( $target.length ) {
					$( '.reviews_tab a' ).click();
					var $offset = $target.offset().top - self.config.$localScrollOffset;
					self.scrollTo( $target, $offset );
				}
				return false;
			} );

		},

		/**
		 * Local Scroll Highlight on scroll
		 *
		 * @since 2.0.0
		 */
		localScrollHighlight: function() {
			var self = this;

			// Get local scroll sections
			var $localScrollSections = self.config.$localScrollSections;

			// Return if there aren't any local scroll items
			if ( ! $localScrollSections.length ) {
				return;
			}

			// Define vars
			var $windowPos    = this.config.$window.scrollTop();
			var $windowHeight = this.config.$windowHeight;
			var $docHeight    = this.config.$document.height();

			// Highlight active items
			for ( var i=0; i < $localScrollSections.length; i++ ) {

				// Get section
				var $section = $localScrollSections[i];

				// Data attribute targets
				if ( $( '[data-ls_id="'+ $section +'"]' ).length ) {
					var $targetDiv     = $( '[data-ls_id="'+ $section +'"]' ),
						$divPos        = $targetDiv.offset().top - self.config.$localScrollOffset - 1,
						$divHeight     = $targetDiv.outerHeight(),
						$higlight_link = $( '[data-ls_linkto="'+ $section +'"]' );
				}

				// Standard element targets
				else if ( $( $section ).length ) {
					var $divPos        = $( $section ).offset().top - self.config.$localScrollOffset - 1,
						$divHeight     = $( $section ).outerHeight(),
						$higlight_link = $( '[data-ls_linkto="'+ $section +'"]' );
				}

				// Higlight items
				if ( $windowPos >= $divPos && $windowPos < ( $divPos + $divHeight ) ) {
						$higlight_link.addClass( 'active' );
						$higlight_link.parent( 'li' ).addClass( 'current-menu-item' );
				} else {
					$higlight_link.removeClass( 'active' );
					$higlight_link.parent( 'li' ).removeClass( 'current-menu-item' );
				}

			}

			/* @todo: Highlight last item if at bottom of page or last item clicked - needs major testing now.
			var $lastLink = $localScrollSections[$localScrollSections.length-1];
			if ( $windowPos + $windowHeight == $docHeight ) {
				$( '.local-scroll.current-menu-item' ).removeClass( 'current-menu-item' );
				$( "li.local-scroll a[href='" + $lastLink + "']" ).parent( 'li' ).addClass( 'current-menu-item' );
			}*/

		},

		/**
		 * Equal heights function => Must run before isotope method
		 *
		 * @since 2.0.0
		 */
		equalHeights: function() {

			if ( $.fn.wpexEqualHeights != undefined ) {

				// Add equal heights grid
				$( '.match-height-grid' ).wpexEqualHeights( {
					children : '.match-height-content'
				} );

				// Columns
				$( '.match-height-row' ).wpexEqualHeights( {
					children : '.match-height-content'
				} );

				// Feature Box
				$( '.vcex-feature-box-match-height' ).wpexEqualHeights( {
					children : '.vcex-match-height'
				} );

				// Blog entries
				$( '.blog-equal-heights' ).wpexEqualHeights( {
					children : '.blog-entry-inner'
				} );

				// Related entries
				$( '.related-posts' ).wpexEqualHeights( {
					children : '.related-post-content'
				} );

				// Rows
				$( '.wpex-vc-row-columns-match-height' ).wpexEqualHeights( {
					children : '.wpex-vc-column-wrapper'
				} );

				// Manual equal heights
				$( '.wpex-vc-columns-wrap' ).wpexEqualHeights( {
					children : '.equal-height-column'
				} );
				$( '.wpex-vc-columns-wrap' ).wpexEqualHeights( {
					children : '.equal-height-content'
				} );

			}

		},

		/**
		 * Footer Reveal Display on Load
		 *
		 * @since 2.0.0
		 */
		footerReveal: function() {
			var self = this;

			// Return if disabled
			if ( ! self.config.$hasFooterReveal ) {
				return;
			}

			// Footer reveal
			var $footerReveal = self.config.$footerReveal;

			function showHide() {

				// Disabled under 960
				if ( self.config.$viewportWidth < 960 ) {
					if ( $footerReveal.hasClass( 'footer-reveal' ) ) {
						$footerReveal.toggleClass( 'footer-reveal footer-reveal-visible' );
						self.config.$siteWrap.css( 'margin-bottom', '' );
					}
					return;
				}

				var $hideFooter         = false;
				var $footerRevealHeight = $footerReveal.outerHeight();
				var $windowHeight       = self.config.$windowHeight;

				if ( $footerReveal.hasClass( 'footer-reveal' ) ) {
					var $heightCheck = self.config.$siteWrap.outerHeight() + self.config.$localScrollOffset;
				} else {
					var $heightCheck = self.config.$siteWrap.outerHeight() + self.config.$localScrollOffset - $footerRevealHeight;
				}

				// Check window height
				if ( ( $windowHeight > $footerRevealHeight ) && ( $heightCheck  > $windowHeight ) ) {
					$hideFooter = true;
				}

				// Footer Reveal
				if ( $hideFooter && $footerReveal.hasClass( 'footer-reveal-visible' ) ) {
					self.config.$siteWrap.css( {
						'margin-bottom': $footerRevealHeight
					} );
					$footerReveal.removeClass( 'footer-reveal-visible' );
					$footerReveal.addClass( 'footer-reveal' );
				}

				// Visible Footer
				if ( ! $hideFooter && $footerReveal.hasClass( 'footer-reveal' ) ) {
					self.config.$siteWrap.css( 'margin-bottom', '' );
					$footerReveal.removeClass( 'footer-reveal' );
					$footerReveal.removeClass( 'wpex-visible' );
					$footerReveal.addClass( 'footer-reveal-visible' );
				}

			}

			function reveal() {
				if ( $footerReveal.hasClass( 'footer-reveal' ) ) {
					if ( self.scrolledToBottom( self.config.$siteMain ) ) {
						$footerReveal.addClass( 'wpex-visible' );
					} else {
						$footerReveal.removeClass( 'wpex-visible' );
					}
				}
			}

			// Fire on init
			showHide();

			// Fire onscroll event
			self.config.$window.scroll( function() {
				reveal();
			} );

			// Fire onResize
			self.config.$window.resize( function() {
				if ( self.config.$widthChanged || self.config.$heightChanged ) {
					showHide();
				}
			} );

		},

		/**
		 * Set min height on main container to prevent issue with extra space below footer
		 *
		 * @since 3.1.1
		 */
		fixedFooter: function() {
			var self = this;

			// Checks
			if ( ! self.config.$siteMain || ! self.config.$hasFixedFooter ) {
				return;
			}

			function run() {

				// Set main vars
				var $mainHeight = self.config.$siteMain.outerHeight();
				var $htmlHeight = $( 'html' ).height();

				// Generate min Height
				var $minHeight = $mainHeight + ( self.config.$window.height() - $htmlHeight );

				// Add min height
				self.config.$siteMain.css( 'min-height', $minHeight );

			}

			// Run on doc ready
			run();

			// Run on resize
			self.config.$window.resize( function() {
				if ( self.config.$widthChanged || self.config.$heightChanged ) {
					run();
				}
			} );

		},

		/**
		 * If title and breadcrumbs don't both fit in the header switch breadcrumb style
		 *
		 * @since 3.5.0
		 */
		titleBreadcrumbsFix: function() {

			var $pageHeader = $( '.page-header' );
			var $crumbs = $( '.site-breadcrumbs', $pageHeader );
			if ( ! $crumbs.length || ! $crumbs.hasClass( 'has-js-fix' ) ) {
				return;
			}

			var $crumbsTrail = $( '.breadcrumb-trail', $crumbs );
			if ( ! $crumbsTrail.length ) return;

			var $headerInner = $( '.page-header-inner', $pageHeader );
			if ( ! $headerInner.length ) return;

			var $title = $( '.page-header-title > span', $headerInner );
			if ( ! $title.length ) return;

			var self = this;

			function tweak_classes() {
				if ( ( $title.width() + $crumbsTrail.width() + 20 ) >= $headerInner.width() ) {
					if ( 'absolute' == $crumbs.css( 'position' ) ) {
						$crumbs.addClass( 'position-under-title' );
					}
				} else {
					$crumbs.removeClass( 'position-under-title' );
				}
			}
			tweak_classes();

			self.config.$window.resize( function() {
				tweak_classes();
			} );
			
		},

		/**
		 * Custom Selects
		 *
		 * @since 2.0.0
		 */
		customSelects: function() {

			// Custom selects based on wpexLocalize array
			$( wpexLocalize.customSelects ).customSelect( {
				customClass: 'theme-select'
			} );

			// WooCommerce
			if ( $.fn.select2 !== undefined ) {
				$( '#calc_shipping_country' ).select2();
			}

		},

		/**
		 * FadeIn Elements
		 *
		 * @since 2.0.0
		 */
		fadeIn: function() {
			$( '.fade-in-image, .wpex-show-on-load' ).addClass( 'no-opacity' );
		},

		/**
		 * OwlCarousel
		 *
		 * @since 2.0.0
		 */
		owlCarousel: function() {
			
			$( '.wpex-carousel' ).each( function() {

				var $this = $( this );
				var $data = $this.data();

				$this.owlCarousel( {
					animateIn          : false,
					animateOut         : false,
					lazyLoad           : false,
					smartSpeed         : $data.smartSpeed ? $data.smartSpeed : wpexLocalize.carouselSpeed,
					rtl                : wpexLocalize.isRTL ? true : false,
					dots               : $data.dots,
					nav                : $data.nav,
					items              : $data.items,
					slideBy            : $data.slideby,
					center             : $data.center,
					loop               : $data.loop,
					margin             : $data.margin,
					autoplay           : $data.autoplay,
					autoplayTimeout    : $data.autoplayTimeout,
					autoHeight         : $data.autoHeight,
					autoplayHoverPause : true,
					navText            : [ '<span class="fa fa-chevron-left"><span>', '<span class="fa fa-chevron-right"></span>' ],
					responsive         : {
						0: {
							items : $data.itemsMobilePortrait
						},
						480: {
							items : $data.itemsMobileLandscape
						},
						768: {
							items : $data.itemsTablet
						},
						960: {
							items : $data.items
						}
					}
				} );

			} );

		},

		/**
		 * SliderPro
		 *
		 * @since 2.0.0
		 */
		sliderPro: function( context ) {
			var self = this;

			// Loop through each slider
			$( '.wpex-slider', context ).each( function() {

				// Declare vars
				var $slider = $( this );
				var $data   = $slider.data();

				// Lets show things that were hidden to prevent flash
				$( '.wpex-slider-slide, .wpex-slider-thumbnails' ).css( {
					'opacity' : 1,
					'display' : 'block'
				} );

				// Get height based on first items to prevent animation on initial load
				var $preloader               = $( '.wpex-slider' ).prev( '.wpex-slider-preloaderimg' );
				var $height                  = $preloader.length ? $preloader.outerHeight() : null;
				var $heightAnimationDuration = self.parseData( $data.heightAnimationDuration, 600 );
				var $loop                    = self.parseData( $data.loop, false );
				var $autoplay                = self.parseData( $data.autoPlay, true );

				// Run slider
				$slider.sliderPro( {
					
					//supportedAnimation      : 'JavaScript', //(CSS3 2D, CSS3 3D or JavaScript)
					responsive              : true,
					width                   : '100%',
					height                  : $height,
					fade                    : self.parseData( $data.fade, 600 ),
					touchSwipe              : self.parseData( $data.touchSwipe, true ),
					fadeDuration            : self.parseData( $data.animationSpeed, 600 ),
					slideAnimationDuration  : self.parseData( $data.animationSpeed, 600 ),
					autoHeight              : self.parseData( $data.autoHeight, true ),
					heightAnimationDuration : parseInt( $heightAnimationDuration ),
					arrows                  : self.parseData( $data.arrows, true ),
					fadeArrows              : self.parseData( $data.fadeArrows, true ),
					autoplay                : $autoplay,
					autoplayDelay           : self.parseData( $data.autoPlayDelay, 5000 ),
					buttons                 : self.parseData( $data.buttons, true ),
					shuffle                 : self.parseData( $data.shuffle, false ),
					orientation             : self.parseData( $data.direction, 'horizontal' ),
					loop                    : $loop,
					keyboard                : false,
					fullScreen              : self.parseData( $data.fullscreen, false ),
					slideDistance           : self.parseData( $data.slideDistance, 0 ),
					thumbnailsPosition      : 'bottom',
					thumbnailHeight         : self.parseData( $data.thumbnailHeight, 70 ),
					thumbnailWidth          : self.parseData( $data.thumbnailWidth, 70 ),
					thumbnailPointer        : self.parseData( $data.thumbnailPointer, false ),
					updateHash              : self.parseData( $data.updateHash, false ),
					thumbnailArrows         : false,
					fadeThumbnailArrows     : false,
					thumbnailTouchSwipe     : true,
					fadeCaption             : self.parseData( $data.fadeCaption, true ),
					captionFadeDuration     : 600,
					waitForLayers           : true,
					autoScaleLayers         : true,
					forceSize               : 'none',
					reachVideoAction        : 'playVideo',
					leaveVideoAction        : 'pauseVideo',
					endVideoAction          : 'nextSlide',
					fadeOutPreviousSlide    : true, // If disabled testimonial/content slides are bad
					init: function( event ) {
						$slider.prev( '.wpex-slider-preloaderimg' ).remove();
						if ( $slider.parent( '.gallery-format-post-slider' ) && $( '.blog-masonry-grid' ).length ) {
							setTimeout( function() {
								$( '.blog-masonry-grid' ).isotope( 'layout' );
							}, $heightAnimationDuration + 1 );
						}
					},
					gotoSlide: function( event ) {
						if ( ! $loop && $autoplay && event.index === $slider.find( '.sp-slide' ).length - 1 ) {
							$slider.data( 'sliderPro' ).stopAutoplay();
						}
					},
					gotoSlideComplete: function( event ) {
						if ( $slider.parent( '.gallery-format-post-slider' ) && $( '.blog-masonry-grid' ).length ) {
							$( '.blog-masonry-grid' ).isotope( 'layout' );
						}
					}

				} );

			} );

			// WooCommerce: Prevent clicking on Woo entry slider
			$( '.woo-product-entry-slider' ).click( function() {
				return false;
			} );

		},

		/**
		 * Isotope Grids
		 *
		 * @since 2.0.0
		 */
		isotopeGrids: function() {
			var self = this;

			var $filterNavbar = $( '.vcex-filter-nav' );

			$filterNavbar.each( function() {

				var $this = $( this );
				var $filterGrid = $( '#' + $this.data( 'filter-grid' ) );

				if ( ! $filterGrid.hasClass( 'wpex-row' ) ) {
					$filterGrid = $filterGrid.find( '.wpex-row' );
				}

				if ( $filterGrid.length ) {

					// Remove isotope class
					$filterGrid.removeClass( 'vcex-isotope-grid' );

					// Run functions after images are loaded for grid
					$filterGrid.imagesLoaded( function() {

						// Add isotope
						if ( ! $filterGrid.hasClass( 'vcex-navbar-filter-grid' ) ) {

							$filterGrid.addClass( 'vcex-navbar-filter-grid' );

							var $grid = $filterGrid.isotope( {
								itemSelector       : '.col',
								transformsEnabled  : true,
								isOriginLeft       : self.config.$isRTL ? false : true,
								transitionDuration : $this.data( 'transition-duration' ) ? $this.data( 'transition-duration' ) + 's' : '0.4s',
								layoutMode         : $this.data( 'layout-mode' ) ? $this.data( 'layout-mode' ) : 'masonry'
							} );

						} else {

							var $grid = $filterGrid.isotope();

						}

						// Filter
						var $filterLinks = $this.find( 'a' );
						$filterLinks.click( function() {
							$grid.isotope( {
								filter : $( this ).attr( 'data-filter' )
							} );
							$( this ).parents( 'ul' ).find( 'li' ).removeClass( 'active' );
							$( this ).parent( 'li' ).addClass( 'active' );
							return false;
						} );

					} );

				}

			} );

			// Loop through isotope grids
			$( '.vcex-isotope-grid' ).each( function() {

				// Isotope layout
				var $container = $( this );

				// Run only once images have been loaded
				$container.imagesLoaded( function() {

					// Crete the isotope layout
					var $grid = $container.isotope( {
						itemSelector       : '.vcex-isotope-entry',
						transformsEnabled  : true,
						isOriginLeft       : self.config.$isRTL ? false : true,
						transitionDuration : $container.data( 'transition-duration' ) ? $container.data( 'transition-duration' ) + 's' : '0.4s',
						layoutMode         : $container.data( 'layout-mode' ) ? $container.data( 'layout-mode' ) : 'masonry',
						filter             : $container.data( 'filter' ) ? $container.data( 'filter' ) : ''
					} );

					// Filter links
					var $filter = $container.prev( 'ul.vcex-filter-links' );
					if ( $filter.length ) {
						var $filterLinks = $filter.find( 'a' );
						$filterLinks.click( function() {
							$grid.isotope( {
								filter : $( this ).attr( 'data-filter' )
							} );
							$( this ).parents( 'ul' ).find( 'li' ).removeClass( 'active' );
							$( this ).parent( 'li' ).addClass( 'active' );
							return false;
						} );
					}

				} );

			} );

		},

		/**
		 * Isotope Grids
		 *
		 * @since 2.0.0
		 */
		archiveMasonryGrids: function() {

			// Define main vars
			var self      = this,
				$archives = $( '.blog-masonry-grid,div.wpex-row.portfolio-masonry,div.wpex-row.portfolio-no-margins,div.wpex-row.staff-masonry,div.wpex-row.staff-no-margins' );

			// Loop through archives
			$archives.each( function() {

				var $this               = $( this ),
					$data               = $this.data(),
					$transitionDuration = self.parseData( $data.transitionDuration, '0.0' ),
					$layoutMode         = self.parseData( $data.layoutMode, 'masonry' );

				// Load isotope after images loaded
				$this.imagesLoaded( function() {
					$this.isotope( {
						itemSelector       : '.isotope-entry',
						transformsEnabled  : true,
						isOriginLeft       : self.config.$isRTL ? false : true,
						transitionDuration : $transitionDuration + 's'
					} );
				} );

			} );

		},

		/**
		 * iLightbox
		 *
		 * @since 2.0.0
		 */
		iLightbox: function( context ) {
			var self = this;

			// Auto lightbox
			if ( wpexLocalize.iLightbox.auto ) {
				var $iLightboxAutoExtensions = ['bmp', 'gif', 'jpeg', 'jpg', 'png', 'tiff', 'tif', 'jfif', 'jpe'];
				$( '.wpb_text_column a:has(img), body.no-composer .entry a:has(img)' ).each( function() {
					var $this = $( this );
					var $url  = $this.attr( 'href' );
					var $ext  = self.getUrlExtension( $url );
					if ( $iLightboxAutoExtensions.indexOf( $ext ) !== -1 ) {
						$this.addClass( 'wpex-lightbox' );
					}
				} );
			}

			// Lightbox Standard
			$( '.wpex-lightbox', context ).each( function() {

				var $this = $( this );

				if ( ! $this.hasClass( 'wpex-lightbox-group-item' ) ) {

					var $data = $this.data();

					$this.iLightBox( {
						skin: self.parseData( $data.skin, wpexLocalize.iLightbox.skin ),
						controls: {
							fullscreen : wpexLocalize.iLightbox.controls.fullscreen
						},
						show: {
							title: self.parseData( $data.show_title, wpexLocalize.iLightbox.show.title ),
							speed: parseInt( wpexLocalize.iLightbox.show.speed )
						},
						hide: {
							speed: parseInt( wpexLocalize.iLightbox.hide.speed )
						},
						effects: {
							reposition: true,
							repositionSpeed: 200,
							switchSpeed: 300,
							loadedFadeSpeed: wpexLocalize.iLightbox.effects.loadedFadeSpeed,
							fadeSpeed: wpexLocalize.iLightbox.effects.fadeSpeed
						},
						overlay: wpexLocalize.iLightbox.overlay,
						social: wpexLocalize.iLightbox.social
					} );

				}

			} );

			// Lightbox Galleries - @todo change lightbox-group class to .wpex-lightbox-group to prevent conflicts 
			$( '.lightbox-group', context ).each( function() {

				// Get lightbox data
				var $this     = $( this );
				var $item     = $this.find( 'a.wpex-lightbox-group-item' );
				var $data     = $this.data();
				var $itemData = $item.data();

				// Start up lightbox
				$item.iLightBox( {
					skin: self.parseData( $data.skin, wpexLocalize.iLightbox.skin ),
					path: self.parseData( $data.path, wpexLocalize.iLightbox.path ),
					infinite: self.parseData( $data.skin, wpexLocalize.iLightbox.infinite ),
					show: {
						title: self.parseData( $itemData.show_title, wpexLocalize.iLightbox.show.title ),
						speed: parseInt( wpexLocalize.iLightbox.show.speed )
					},
					hide: {
						speed: parseInt( wpexLocalize.iLightbox.hide.speed )
					},
					controls: {
						arrows: self.parseData( $data.arrows, wpexLocalize.iLightbox.controls.arrows ),
						thumbnail: self.parseData( $data.thumbnails, wpexLocalize.iLightbox.controls.thumbnail ),
						fullscreen: wpexLocalize.iLightbox.controls.fullscreen,
						mousewheel: wpexLocalize.iLightbox.controls.mousewheel
					},
					effects: {
						reposition: true,
						repositionSpeed: 200,
						switchSpeed: 300,
						loadedFadeSpeed: wpexLocalize.iLightbox.effects.loadedFadeSpeed,
						fadeSpeed: wpexLocalize.iLightbox.effects.fadeSpeed
					},
					overlay: wpexLocalize.iLightbox.overlay,
					social: wpexLocalize.iLightbox.social
				} );

			} );

			// Lightbox Gallery with custom imgs
			$( '.wpex-lightbox-gallery', context ).on( 'click', function( event ) {
				var $this       = $( this );
				var $data       = $this.data();
				var imagesArray = $this.data( 'gallery' ).split( ',' );
				if ( imagesArray ) {
					$.iLightBox( imagesArray, {
						skin: self.parseData( $data.skin, wpexLocalize.iLightbox.skin ),
						path: 'horizontal',
						infinite: self.parseData( $data.skin, wpexLocalize.iLightbox.infinite ),
						show: {
							//title: wpexLocalize.iLightbox.show.title,
							speed: parseInt( wpexLocalize.iLightbox.show.speed )
						},
						hide: {
							speed: parseInt( wpexLocalize.iLightbox.hide.speed )
						},
						controls: {
							arrows: wpexLocalize.iLightbox.controls.arrows,
							thumbnail: wpexLocalize.iLightbox.controls.thumbnail,
							fullscreen: wpexLocalize.iLightbox.controls.fullscreen,
							mousewheel: wpexLocalize.iLightbox.controls.mousewheel
						},
						effects: {
							reposition: true,
							repositionSpeed: 200,
							switchSpeed: 300,
							loadedFadeSpeed: wpexLocalize.iLightbox.effects.loadedFadeSpeed,
							fadeSpeed: wpexLocalize.iLightbox.effects.fadeSpeed
						},
						overlay: wpexLocalize.iLightbox.overlay,
						social : wpexLocalize.iLightbox.social
					} );
				}
				return false;
			} );

			// Custom Lightbox for Carousels
			$( '.wpex-carousel-lightbox', context ).each( function() {

				var $this          = $( this );
				var $owlItems      = $this.find( '.owl-item' );
				var $lightboxItems = $this.find( '.wpex-carousel-lightbox-item' );
				var $data          = $this.find( '.wpex-carousel-lightbox-item' ).data();
				var $imagesArray   = new Array();

				$owlItems.each( function() {
					if ( ! $( this ).hasClass( 'cloned' ) ) {
						var $image = $( this ).find( '.wpex-carousel-lightbox-item' );
						if ( $image.length > 0 ) {
							$imagesArray.push( {
								URL     : $image.attr( 'href' ),
								title   : $image.attr( 'data-title' ),
								caption : $image.attr( 'data-caption' )
							} );
						}
					}
				} );

				if ( $imagesArray.length > 0 ) {

					$lightboxItems.on( 'click', function( event ) {

						event.preventDefault();

						var $startFrom = $( this ).data( 'count' ) - 1,
							$startFrom = $startFrom ? $startFrom : 0;

						$.iLightBox( $imagesArray, {
							startFrom: parseInt( $startFrom ),
							path: 'horizontal',
							infinite: self.parseData( $data.infinite, wpexLocalize.iLightbox.infinite ),
							skin: self.parseData( $data.skin, wpexLocalize.iLightbox.skin ),
							show: {
								title: self.parseData( $data.show_title, wpexLocalize.iLightbox.show.title ),
								speed: parseInt( wpexLocalize.iLightbox.show.speed )
							},
							hide: {
								speed: parseInt( wpexLocalize.iLightbox.hide.speed )
							},
							controls: {
								arrows: wpexLocalize.iLightbox.controls.arrows,
								thumbnail: wpexLocalize.iLightbox.controls.thumbnail,
								fullscreen: wpexLocalize.iLightbox.controls.fullscreen,
								mousewheel: wpexLocalize.iLightbox.controls.mousewheel
							},
							effects: {
								reposition: true,
								repositionSpeed: 200,
								switchSpeed: 300,
								loadedFadeSpeed: wpexLocalize.iLightbox.effects.loadedFadeSpeed,
								fadeSpeed: wpexLocalize.iLightbox.effects.fadeSpeed
							},
							overlay: wpexLocalize.iLightbox.overlay,
							social: wpexLocalize.iLightbox.social
						} );

					} );

				}

			} );

			// Lightbox Videos => OLD SCHOOL STUFF, keep for old customers
			$( '.wpex-lightbox-video, .wpb_single_image.video-lightbox a, .wpex-lightbox-autodetect, .wpex-lightbox-autodetect a', context ).each( function() {

				var $this = $( this ),
					$data = $this.data();

				$this.iLightBox( {
					smartRecognition : true,
					skin             : self.parseData( $data.skin, wpexLocalize.iLightbox.skin ),
					path             : 'horizontal',
					controls         : {
						fullscreen : wpexLocalize.iLightbox.controls.fullscreen
					},
					show             : {
						title : self.parseData( $data.show_title, wpexLocalize.iLightbox.show.title ),
						speed : parseInt( wpexLocalize.iLightbox.show.speed )
					},
					hide             : {
						speed : parseInt( wpexLocalize.iLightbox.hide.speed )
					},
					effects          : {
						reposition      : true,
						repositionSpeed : 200,
						switchSpeed     : 300,
						loadedFadeSpeed : wpexLocalize.iLightbox.effects.loadedFadeSpeed,
						fadeSpeed       : wpexLocalize.iLightbox.effects.fadeSpeed
					},
					overlay : wpexLocalize.iLightbox.overlay,
					social  : wpexLocalize.iLightbox.social
				} );
			} );

		},

		/**
		 * Overlay Hovers
		 *
		 * @since 2.0.0
		 */
		overlayHovers: function() {

			$( '.overlay-parent-title-push-up' ).each( function() {

				// Define vars
				var $this        = $( this ),
					$title       = $this.find( '.overlay-title-push-up' ),
					$child       = $this.find( 'a' ),
					$img         = $child.find( 'img' ),
					$titleHeight = $title.outerHeight();

				// Create overlay after image is loaded to prevent issues
				$this.imagesLoaded( function() {

					// Position title
					$title.css( {
						'bottom' : - $titleHeight
					} );

					// Add height to child
					$child.css( {
						'height' : $img.outerHeight()
					} );

					// Position image
					$img.css( {
						'position' : 'absolute',
						'top'      : '0',
						'left'     : '0',
						'width'    : 'auto',
						'height'   : 'auto'
					} );

					// Animate image on hover
					$this.hover( function() {
						$img.css( {
							'top' : -20
						} );
						$title.css( {
							'bottom' : 0
						} );
					}, function() {
						$img.css( {
							'top' : '0'
						} );
						$title.css( {
							'bottom' : - $titleHeight
						} );
					} );

				} );

			} );

		},

		/**
		 * Sticky Topbar
		 *
		 * @since 3.4.0
		 */
		stickyTopBar: function() {
			var $isSticky     = false;
			var self          = this;
			var $window       = self.config.$window;
			var $stickyTopbar = self.config.$stickyTopBar;
			var $mobileMenu   = $( '#wpex-mobile-menu-fixed-top' );

			// Return if disabled
			if ( ! $stickyTopbar ) return;

			// Main vars
			var $mobileSupport = self.config.$hasStickyTopBarMobile;
			var $brkPoint      = wpexLocalize.stickyTopBarBreakPoint;

			// Add sticky wrapper
			var $stickyWrap = $( '<div id="top-bar-wrap-sticky-wrapper" class="wpex-sticky-top-bar-holder not-sticky"></div>' );
			$stickyTopbar.wrapAll( $stickyWrap );
			var $stickyWrap = $( '#top-bar-wrap-sticky-wrapper' );

			// Get offset
			function getOffset() {
				var $offset = 0;
				if ( self.config.$wpAdminBar ) {
					$offset = $offset + self.config.$wpAdminBar.outerHeight();
				}
				if ( $mobileMenu.is( ':visible' ) ) {
					$offset = $offset + $mobileMenu.outerHeight();
				}
				return $offset;
			}

			// Stick the TopBar
			function setSticky() {

				// Already stuck
				if ( $isSticky ) return;
				
				// Add wrap class and toggle sticky class
				$stickyWrap
					.css( 'height', $stickyTopbar.outerHeight() )
					.removeClass( 'not-sticky' )
					.addClass( 'is-sticky' );

				// Add CSS to topbar
				$stickyTopbar.css( {
					'top'   : getOffset(),
					'width' : $stickyWrap.width()
				} );

				// Set sticky to true
				$isSticky = true;

			}

			// Unstick the TopBar
			function destroySticky() {

				if ( ! $isSticky ) return;

				// Remove sticky wrap height and toggle sticky class
				$stickyWrap
					.css( 'height', '' )
					.removeClass( 'is-sticky' )
					.addClass( 'not-sticky' );

				// Remove topbar css
				$stickyTopbar.css( {
					'width' : '',
					'top'   : '',
				} );

				// Set sticky to false
				$isSticky = false;

			}

			// On load check
			function initSetSticky() {

				// Disable on mobile devices
				if ( ! $mobileSupport && ( self.config.$viewportWidth < $brkPoint ) ) {
					return;
				}

				// Offset
				var $offset = $stickyWrap.offset().top - getOffset();

				// Set or destroy sticky
				if ( self.config.$windowTop > $offset ) {
					setSticky();
				}

			}

			// On scroll actions for sticky topbar
			function stickyCheck() {

				// Disable on mobile devices
				if ( ! $mobileSupport && ( self.config.$viewportWidth < $brkPoint ) ) {
					return;
				}

				// Offset
				var $offset = $stickyWrap.offset().top - getOffset();

				// Destroy sticky at top
				if ( $isSticky && 0 == self.config.$windowTop ) {
					destroySticky();
					return;
				}

				// Set or destroy sticky based on offset
				if ( self.config.$windowTop >= $offset ) {
					setSticky();
				} else {
					destroySticky();
				}

			}

			// On resize actions for sticky topbar
			function onResize() {

				// Check if header is disabled on mobile if not destroy on resize
				if ( ! $mobileSupport && ( self.config.$viewportWidth < $brkPoint ) ) {
					destroySticky();
				} else {

					// Set correct width and top value
					if ( $isSticky ) {
						$stickyWrap.css( 'height', $stickyTopbar.outerHeight() );
						$stickyTopbar.css( {
							'top'   : getOffset(),
							'width' : $stickyWrap.width()
						} );
					} else {
						stickyCheck();
					}

				}

			}

			// Fire on init
			initSetSticky();

			// Fire onscroll event
			$window.scroll( function() {
				stickyCheck();
			} );

			// Fire onResize
			$window.resize( function() {
				onResize();
			} );

		},

		/**
		 * Get correct sticky header offset / Used for header and menu so keep outside
		 *
		 * @since 3.4.0
		 */
		stickyOffset: function() {
			var self          = this;
			var $offset       = 0;
			var $mobileMenu   = $( '#wpex-mobile-menu-fixed-top' );
			var $stickyTopbar = self.config.$stickyTopBar;

			// Offset sticky topbar
			if ( $stickyTopbar ) {
				if ( self.config.$hasStickyTopBarMobile
					|| self.config.$viewportWidth >= wpexLocalize.stickyTopBarBreakPoint
				) {
					$offset = $offset + $stickyTopbar.outerHeight();
				}
			}

			// Offset mobile menu
			if ( $mobileMenu.is( ':visible' ) ) {
				$offset = $offset + $mobileMenu.outerHeight();
			}

			// Offset adminbar
			if ( this.config.$wpAdminBar && this.config.$wpAdminBar.is( ':visible' ) ) {
				$offset = $offset + this.config.$wpAdminBar.outerHeight();
			}

			// Added offset via child theme
			if ( wpexLocalize.addStickyHeaderOffset ) {
				$offset = $offset + wpexLocalize.addStickyHeaderOffset;
			}

			// Return correct offset
			return $offset;

		},

		/**
		 * New Sticky Header
		 *
		 * @since 3.4.0
		 */
		stickyHeader: function() {
			var $isSticky = false;
			var self      = this;

			// Return if sticky is disabled
			if ( ! self.config.$hasStickyHeader ) {
				return;
			}

			// Define header vars
			var $header      = self.config.$siteHeader;
			var $headerStyle = self.config.$siteHeaderStyle;

			// Add sticky wrap
			var $stickyWrap = $( '<div id="site-header-sticky-wrapper" class="wpex-sticky-header-holder not-sticky"></div>' );
			$header.wrapAll( $stickyWrap );

			// Define main vars for sticky function
			var $window               = self.config.$window;
			var $brkPoint             = wpexLocalize.stickyHeaderBreakPoint;
			var $stickyWrap           = $( '#site-header-sticky-wrapper' );
			var $headerHeight         = self.config.$siteHeaderHeight;
			var $hasShrinkFixedHeader = $header.hasClass( 'shrink-sticky-header' );
			var $mobileSupport        = self.config.$hasStickyMobileHeader;

			// Custom shrink logo
			var $stickyLogo    = wpexLocalize.stickyheaderCustomLogo;
			var $headerLogo    = self.config.$siteLogo;
			var $headerLogoSrc = self.config.$siteLogoSrc;

			// Custom shrink logo retina
			if ( $stickyLogo
				&& wpexLocalize.stickyheaderCustomLogoRetina
				&& self.config.$isRetina
			) {
				$stickyLogo = wpexLocalize.stickyheaderCustomLogoRetina;
			}

			// Set sticky
			function setSticky() {

				// Already stuck
				if ( $isSticky ) {
					return;
				}

				// Custom Sticky logo
				if ( $stickyLogo && $headerLogo ) {
					$headerLogo.attr( 'src', $stickyLogo );
					self.config.$siteLogoHeight = self.config.$siteLogo.height();
				}

				// Add wrap class and toggle sticky class
				$stickyWrap
					.css( 'height', $headerHeight )
					.removeClass( 'not-sticky' )
					.addClass( 'is-sticky' );

				// Tweak header
				$header.removeClass( 'dyn-styles').css( {
					'top'   : self.stickyOffset(),
					'width' : $stickyWrap.width()
				} );

				// Set sticky to true
				$isSticky = true;

			}

			// Destroy sticky
			function destroySticky() {

				// Already unstuck
				if ( ! $isSticky ) {
					return;
				}

				// Reset logo
				if ( $stickyLogo && $headerLogo ) {
					$headerLogo.attr( 'src', $headerLogoSrc );
					self.config.$siteLogoHeight = self.config.$siteLogo.height();
				}

				// Remove sticky wrap height and toggle sticky class
				$stickyWrap.removeClass( 'is-sticky' ).addClass( 'not-sticky' );

				// Do not remove height on sticky header for shrink header incase animation isn't done yet
				if ( ! $header.hasClass( 'shrink-sticky-header' ) ) {
					$stickyWrap.css( 'height', '' );
				}

				// Reset header
				$header.addClass( 'dyn-styles').css( {
					'width' : '',
					'top'   : ''
				} );

				// Set sticky to false
				$isSticky = false;

			}

			// On load check
			function initResizeSetSticky() {

				// Disable on mobile devices
				if ( ! $mobileSupport && ( self.config.$viewportWidth < $brkPoint ) ) {
					return;
				}

				// Check position
				var $stickyWrapTop = $stickyWrap.offset().top;
				var $stickyOffset  = self.stickyOffset();
				var $setStickyPos  = $stickyWrapTop - $stickyOffset;

				// Add and remove sticky classes and sticky logo
				if ( self.config.$windowTop > $setStickyPos && 0 !== self.config.$windowTop ) {
					setSticky();
				}

			}

			// On scroll function
			function stickyCheck() {

				// Disable on mobile devices
				if ( ! $mobileSupport && ( self.config.$viewportWidth < $brkPoint ) ) {
					return;
				}

				// Destroy sticky at top
				if ( $isSticky && 0 == self.config.$windowTop ) {
					destroySticky();
					return;
				}

				// Check position
				var $stickyWrapTop = $stickyWrap.offset().top;
				var $stickyOffset  = self.stickyOffset();
				var $setStickyPos  = $stickyWrapTop - $stickyOffset;

				// Add and remove sticky classes and sticky logo
				if ( self.config.$windowTop >= $setStickyPos ) {
					setSticky();
				} else {
					destroySticky();
				}

			}

			// On resize function
			function onResize() {

				// Check if header is disabled on mobile if not destroy on resize
				if ( ! $mobileSupport && ( self.config.$viewportWidth < $brkPoint ) ) {
					destroySticky();
				} else {

					// Update sticky
					if ( $isSticky ) {

						// Update wrapper height
						if ( ! $header.hasClass( 'shrink-sticky-header' ) ) {
							$stickyWrap.css( 'height', self.config.$siteHeaderHeight );
						}

						// Update sticky width and top offset
						$header.css( {
							'top'   : self.stickyOffset(),
							'width' : $stickyWrap.width()
						} );

					}

					// Add sticky
					else {
						initResizeSetSticky();
					}

				}

			} // End onResize

			// Fire on init
			initResizeSetSticky();

			// Fire onscroll event
			$window.scroll( function() {
				if ( self.config.$hasScrolled ) {
					stickyCheck();
				}
			} );

			// Fire onResize
			$window.resize( function() {
				if ( self.config.$widthChanged || self.config.$heightChanged ) {
					onResize();
				}
			} );

		},

		/**
		 * New Shrink Sticky Header
		 *
		 * @since 3.4.0
		 */
		shrinkStickyHeader: function() {

			var $isShrunk = false;

			// Define header element
			var self     = this;
			var $header  = self.config.$siteHeader;
			var $enabled = $header.hasClass( 'shrink-sticky-header' );

			// Return if shrink header disabled
			if ( ! $enabled ) return;

			// Define window and sticky wrap
			var $window     = self.config.$window;
			var $brkPoint   = wpexLocalize.stickyHeaderBreakPoint;
			var $stickyWrap = $( '#site-header-sticky-wrapper' );
			if ( ! $stickyWrap.length ) return;

			// Get correct header offet
			var $headerHeight       = self.config.$siteHeaderHeight;
			var $stickyWrapTop      = $stickyWrap.offset().top;
			var $shrinkHeaderOffset = $stickyWrapTop + $headerHeight;

			// Mobile checks
			if ( self.config.$hasStickyMobileHeader && ( 'icon_buttons' == self.config.$mobileMenuToggleStyle || 'fixed_top' == self.config.$mobileMenuToggleStyle ) ) {
				var $hasShrinkHeaderOnMobile = true;
			} else {
				var $hasShrinkHeaderOnMobile = false;
			}

			// Shrink header function
			function shrinkHeader() {

				// Already shrunk or not sticky
				if ( $isShrunk || ! $stickyWrap.hasClass( 'is-sticky' ) ) return;

				// Add shrunk class
				$header.addClass( 'sticky-header-shrunk' );

				// Update shrunk var
				$isShrunk = true;

			}

			// Un-Shrink header function
			function unShrinkHeader() {

				// Not shrunk
				if ( ! $isShrunk ) return;

				// Remove shrunk class
				$header.removeClass( 'sticky-header-shrunk' );

				// Update shrunk var
				$isShrunk = false;

			}

			// On scroll function
			function shrinkCheck() {

				// Disable on mobile devices
				if ( ! $hasShrinkHeaderOnMobile && ( self.config.$viewportWidth < $brkPoint ) ) {
					return;
				}

				// Shrink sticky header
				if ( self.config.$windowTop >= $shrinkHeaderOffset ) {
					shrinkHeader();
				} else {
					unShrinkHeader();
				}

			}

			// On resize function
			function onResize() {

				// Check if header is disabled on mobile if not destroy
				if ( ! $hasShrinkHeaderOnMobile && ( self.config.$viewportWidth < $brkPoint ) ) {
					unShrinkHeader();
				} else {
					shrinkCheck();
				}

			}

			// Fire on init
			shrinkCheck();

			// Fire onscroll event
			$window.scroll( function() {
				if ( self.config.$hasScrolled ) {
					shrinkCheck();
				}
			} );

			// Fire onResize
			$window.resize( function() {
				if ( self.config.$widthChanged || self.config.$heightChanged ) {
					onResize();
				}
			} );

		},

		/**
		 * Sticky Header Menu
		 *
		 * @since 3.4.0
		 */
		stickyHeaderMenu: function() {
			var self           = this;
			var $navWrap       = self.config.$siteNavWrap;
			var $isSticky      = false;
			var $window        = self.config.$window;
			var $mobileSupport = wpexLocalize.hasStickyNavbarMobile;

			// Add sticky wrap
			var $stickyWrap = $( '<div id="site-navigation-sticky-wrapper" class="wpex-sticky-navigation-holder not-sticky"></div>' );
			$navWrap.wrapAll( $stickyWrap );
			$stickyWrap = $( '#site-navigation-sticky-wrapper' );

			// Add offsets
			var $stickyWrapTop = $stickyWrap.offset().top;
			var $stickyOffset  = self.stickyOffset();
			var $setStickyPos  = $stickyWrapTop - $stickyOffset;

			// Shrink header function
			function setSticky() {

				// Already sticky
				if ( $isSticky ) return;

				// Add wrap class and toggle sticky class
				$stickyWrap
					.css( 'height', self.config.$siteNavWrap.outerHeight() )
					.removeClass( 'not-sticky' )
					.addClass( 'is-sticky' );

				// Add CSS to topbar
				$navWrap.css( {
					'top'   : self.stickyOffset(),
					'width' : $stickyWrap.width()
				} );
				
				// Update shrunk var
				$isSticky = true;

			}

			// Un-Shrink header function
			function destroySticky() {

				// Not shrunk
				if ( ! $isSticky ) return;

				// Remove sticky wrap height and toggle sticky class
				$stickyWrap
					.css( 'height', '' )
					.removeClass( 'is-sticky' )
					.addClass( 'not-sticky' );

				// Remove navbar width
				$navWrap.css( {
					'width' : '',
					'top'   : ''
				} );

				// Update shrunk var
				$isSticky = false;

			}

			// On load check
			function initResizeSetSticky() {

				// Disable on mobile devices
				if ( self.config.$viewportWidth <= wpexLocalize.stickyNavbarBreakPoint ) {
					return;
				}

				// Sticky menu
				if ( self.config.$windowTop >= $setStickyPos && 0 !== self.config.$windowTop ) {
					setSticky();
				} else {
					destroySticky();
				}

			}

			// Sticky check / enable-disable
			function stickyCheck() {

				// Disable on mobile devices
				if ( self.config.$viewportWidth <= wpexLocalize.stickyNavbarBreakPoint ) {
					return;
				}

				// Destroy sticky at top
				if ( $isSticky && 0 == self.config.$windowTop ) {
					destroySticky();
					return;
				}

				// Sticky menu
				if ( self.config.$windowTop > $setStickyPos ) {
					setSticky();
				} else {
					destroySticky();
				}

			}

			// On resize function
			function onResize() {

				// Check if sticky is disabled on mobile if not destroy on resize
				if ( self.config.$viewportWidth <= wpexLocalize.stickyNavbarBreakPoint ) {
					destroySticky();
				}

				// Update width
				if ( $isSticky ) {
					$navWrap.css( 'width', $stickyWrap.width() );
				} else {
					initResizeSetSticky();
				}

			}

			// Fire on init
			initResizeSetSticky();

			// Fire onscroll event
			$window.scroll( function() {
				stickyCheck();
			} );

			// Fire onResize
			$window.resize( function() {
				onResize();
			} );

		},

		/**
		 * VCEX Navbar
		 *
		 * @since 3.3.2
		 */
		stickyVcexNavbar: function() {
			var self = this;
			var $nav = $( '.vcex-navbar-sticky' );
			if ( ! $nav.length ) return;

			$nav.each( function() {

				var $this     = $( this );
				var $isSticky = false;
				var $window   = self.config.$window;

				// Add sticky wrap
				var $stickyWrap = $( '<div class="vcex-navbar-sticky-wrapper not-sticky"></div>' );
				$this.wrapAll( $stickyWrap );
				$stickyWrap = $this.parent( '.vcex-navbar-sticky-wrapper' );

				// Shrink header function
				function setSticky() {

					// Not visible
					if ( ! $this.is( ':visible' ) ) {
						return;
					}

					// Already sticky
					if ( $isSticky ) {
						return;
					}

					// Add wrap class and toggle sticky class
					$stickyWrap
						.css( 'height', $this.outerHeight() )
						.removeClass( 'not-sticky' )
						.addClass( 'is-sticky' );

					// Add CSS to topbar
					$this.css( {
						'top'   : '0',
						'width' : $stickyWrap.width()
					} );
					
					// Update shrunk var
					$isSticky = true;

				}

				// Un-Shrink header function
				function destroySticky() {

					// Not shrunk
					if ( ! $isSticky ) return;

					// Remove sticky wrap height and toggle sticky class
					$stickyWrap
						.css( 'height', '' )
						.removeClass( 'is-sticky' )
						.addClass( 'not-sticky' );

					// Remove navbar width
					$this.css( {
						'width' : '',
						'top'   : ''
					} );

					// Update shrunk var
					$isSticky = false;

				}

				// On scroll function
				function stickyCheck() {
					if ( self.config.$windowTop > $stickyWrap.offset().top && 0 !== self.config.$windowTop ) {
						setSticky();
					} else {
						destroySticky();
					}
				}

				// On resize function
				function onResize() {
					if ( $isSticky ) {
						// Destroy if hidden
						if ( ! $this.is( ':visible' ) ) {
							destroySticky();
						}
						// Set correct height on wrapper
						$stickyWrap.css( 'height', $nav.outerHeight() );
						// Set correct width on sticky element
						$nav.css( 'width', $stickyWrap.width() );
					} else {
						stickyCheck();
					}
				}

				// Fire on init
				stickyCheck();

				// Fire onscroll event
				$window.scroll( function() {
					stickyCheck();
				} );

				// Fire onResize
				$window.resize( function() {
					onResize();
				} );

			} ); // End each loop

		},

		/**
		 * Visual Composer tweaks
		 *
		 * @since 3.5.0
		 */
		infiniteScrollInit: function() {
			var self = this;

			// Get infinite scroll container
			var $container = $( '#blog-entries' );

			// Start infinite sccroll
			$container.infinitescroll( {
				loading : {
					msg         : null,
					finishedMsg : null,
					msgText     : '<div class="infinite-scroll-loader">'+ wpexInfiniteScroll.msgText +'</div>',
				},
				navSelector  : 'div.infinite-scroll-nav',
				nextSelector : 'div.infinite-scroll-nav div.older-posts a',
				itemSelector : '.blog-entry',
			},

			// Callback function
			function( newElements ) {

				var $newElems = $( newElements ).css( 'opacity', 0 );

				$newElems.imagesLoaded( function() {

					// Isotope
					if ( $container.hasClass( 'blog-masonry-grid' ) ) {
						$container.isotope( 'appended', $newElems );
						$newElems.css( 'opacity', 0 );
					}

					// Animate new Items
					$newElems.animate( {
						opacity : 1
					} );

					// Add trigger
					$container.trigger( 'wpexinfiniteScrollLoaded' );

					// Re-run functions
					self.sliderPro( $newElems );
					self.iLightbox( $newElems );

					// Equal heights
					if ( $.fn.wpexEqualHeights !== undefined ) {
						$( '.blog-equal-heights' ).wpexEqualHeights( {
							children : '.blog-entry-inner'
						} );
					}

				} );

			} );

		},

		/**
		 * Visual Composer tweaks
		 *
		 * @since 3.3.5
		 */
		visualComposer: function() {
			var self = this;

			// On window Load
			self.config.$window.on( 'load', function() {

				// Re-trigger/update things when opening accordions.
				$( '.vc_tta-tabs' ).on( 'afterShow.vc.accordion', function( e ) {
					// Sliders
					$( this ).find( '.wpex-slider' ).each( function() {
						$( this ).sliderPro( 'update' );
					} );
					// Grids
					$( this ).find( '.vcex-isotope-grid' ).each( function() {
						$( this ).isotope( 'layout' );
					} );
				} );

				// Re-trigger slider on tabs change
				$( '.vc_tta-accordion' ).on( 'show.vc.accordion', function() {
					// Sliders
					$( this ).find( '.wpex-slider' ).each( function() {
						$( this ).sliderPro( 'update' );
					} );
					// Grids
					$( this ).find( '.vcex-isotope-grid' ).each( function() {
						$( this ).isotope( 'layout' );
					} );
				} );

			} );

		},

		/**
		 * Parses data to check if a value is defined in the data attribute and if not returns the fallback
		 *
		 * @since 2.0.0
		 */
		parseData: function( val, fallback ) {
			return ( typeof val !== 'undefined' ) ? val : fallback;
		},

		/**
		 * Returns extension from URL
		 */
		getUrlExtension: function( url ) {
			var ext = url.split( '.' ).pop().toLowerCase();
			var extra = ext.indexOf( '?' ) !== -1 ? ext.split( '?' ).pop() : '';
			return ext.replace( extra, '' );
		},

		/**
		 * Check if window has scrolled to bottom of element
		 */
		scrolledToBottom: function( elem ) {
			return this.config.$windowTop >= elem.offset().top + elem.outerHeight() - window.innerHeight;
		},

		/**
		 * Check if an element is currently in the window view
		 */
		isElementInWindowView: function( elem ) {
			var docViewTop    = this.config.$window.scrollTop();
			var docViewBottom = docViewTop + this.config.$windowHeight;
			var elemTop       = $(elem).offset().top;
			var elemBottom    = elemTop + $(elem).height();
			return ( ( elemBottom <= docViewBottom) && (elemTop >= docViewTop ) );
		}

	}; // END wpexTheme

	// Start things up
	wpexTheme.init();

} ) ( jQuery );