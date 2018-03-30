/*!
 * Main Theme methods
 *
 */
/* jshint -W062 */
var WolfThemeParams =  WolfThemeParams || {},
	WolfThemeUi = WolfThemeUi || {},
	WOW = WOW || {},
	Modernizr = Modernizr || {},
	MediaElementPlayer = MediaElementPlayer || {},
	console = console || {};

WolfThemeUi = function( $ ) {

	'use strict';

	return {
		doParallax : true,
		doAnimation : true,
		body : $( 'body' ),
		isMobile : ( navigator.userAgent.match( /(iPad)|(iPhone)|(iPod)|(Android)|(PlayBook)|(BB10)|(BlackBerry)|(Opera Mini)|(IEMobile)|(webOS)|(MeeGo)/i ) ) ? true : false,
		isTouch : $( 'html' ).hasClass( 'touch' ),
		noTouch : $( 'html' ).hasClass( 'no-touch' ),
		supportSVG : !! document.createElementNS && !! document.createElementNS( 'http://www.w3.org/2000/svg', 'svg').createSVGRect,
		overlay : $( '#loading-overlay' ),
		loader : $( '#loader' ),
		clock : 0,
		timer : null,
		menuHeight : 100,
		parallaxSpeed : 3,
		videoBgOptions : {
			loop: true,
			features: [],
			enableKeyboard: false,
			pauseOtherPlayers: false
		},

		isIE : function () {
			var ua = window.navigator.userAgent,
				msie = ua.indexOf( 'MSIE ' ),
				trident = ua.indexOf( 'Trident/' );

			if ( msie > 0 ) {
				return true;
			}

			if ( trident > 0 ) {
				// IE 11 (or newer) => return version number
				return true;
			}

			// other browser
			return false;
		},

		/**
		 * Init UI
		 */
		init : function () {

			if ( this.supportSVG ) {
				$( 'html' ).addClass( 'svg' );
			}

			if ( this.isIE() ) {
				$( 'html' ).addClass( 'is-ie' );
			}

			this.doParallax = ( ! this.isMobile && 'wide' === WolfThemeParams.layout ) || ( this.isMobile && WolfThemeParams.enableParallaxOnMobile );
			this.doAnimation = ( ! this.isMobile ) || ( this.isMobile && WolfThemeParams.enableAnimationOnMobile );

			// console.log( 'no touch = ' + this.noTouch );
			// console.log( 'touch = ' + this.isTouch );
			// console.log( 'is mobile = ' + this.isMobile );
			// console.log( 'do animation = ' + this.doAnimation );

			var _this = this;

			if ( ! this.isIE() ) {
				$( window ).trigger( 'resize' ); // trigger resize event to force all window size related calculation
				$( window ).trigger( 'scroll' ); // trigger scroll event to force all window scroll related calculation
			}

			this.loaderOverlay();

			if ( this.isMobile ) {
				this.body.addClass( 'is-mobile' );
			}

			this.breakPoint();
			this.getToolBarOffset();
			//this.topBarMobileMenuFixed();
			this.setHomeHeaderDimensions();
			this.fullWindowElement();
			this.videoBackground();
			this.headerVideoBackground();
			this.fitText();
			this.sectionVideoBackground();
			this.windowSate();
			this.parallax();
			this.fluidVideos();
			this.youtubeWmode();
			this.removeVimeoTitle();
			this.smoothScroll();
			this.tabletSlider();
			this.laptopSlider();
			this.desktopSlider();
			this.mobileSlider();
			this.mailchimpPlaceholder();
			this.additionalFixes();
			this.toggleMenu();
			this.searchFormToggle();
			this.wowAnimate();
			this.lightbox();
			//this.wrapSecondWordInTitle();
			this.animateNumber();
			this.closeAlertMessage();
			this.footerUncover();
			this.lastPostMasonry();
			this.hoverEffect();
			this.videoGridHoverEffect();
			this.pageTransition();
			this.mailchimpSubscribe();
			this.processShortcode();
			this.setMinHeight();
			this.singleVideoFunctions();
			this.commentForm();
			this.postBg();
			this.singlePostNavBg();
			this.updateCart();
			this.megaMenuBg();
			this.doZoom();
			this.fixedSideMenu();
			this.fixedMobileMenu();
			this.videoShortcode();
			this.singlePostMarginTop();

			/**
			 * Resize event
			 */
			$( window ).resize( function() {
				_this.setMinHeight();
				_this.breakPoint();
				_this.getToolBarOffset();
				_this.menuheight = _this.getMenuHeight();
				//_this.topBarMobileMenuFixed();
				_this.setHomeHeaderDimensions();
				_this.fullWindowElement();
				_this.doZoom();
				_this.videoBackground();
				_this.windowSate();
				_this.parallax();
				_this.bigScreenSafariClass();
				_this.tabletSlider();
				_this.laptopSlider();
				_this.desktopSlider();
				_this.fixedSideMenu();
				_this.fixedMobileMenu();
				_this.leftMenuTransparency();
				_this.videoShortcode();
				_this.videoGridHoverEffect();
				_this.singlePostMarginTop();
			} ).resize();

			/**
			 * Scroll event
			 */
			$( window ).scroll( function() {
				var scrollTop = $( window ).scrollTop();
				//_this.topBarMobileMenuFixed( scrollTop );
				_this.stickyMenu( scrollTop );
				_this.topLinkAnimation( scrollTop );
				_this.transitionParallax( scrollTop );
				_this.animatePageTitle( scrollTop );
				_this.fixedSideMenu( scrollTop );
				_this.fixedMobileMenu( scrollTop );
				_this.leftMenuTransparency( scrollTop );
			} );
		},

		/**
		 * Loader
		 */
		loaderOverlay : function () {

			var _this = this;

			// timer to display the loader if loading last more than 1 sec
			_this.timer = setInterval( function() {

				_this.clock++;
				if ( _this.clock === 1 ) {
					$( '#loader' ).fadeIn();
				}

				/**
				 * If the loading time last more than 2 sec, we hide the overlay anyway
				 * An iframe such as a video or a google map probably takes too much time to load
				 * So let's show the page
				 */
				if ( _this.clock === 2 ) {
					_this.hideOverlay();
				}

			}, 1000 );
		},

		/**
		 * Get the menu height
		 */
		getMenuHeight : function () {

			var height;

			if ( this.body.hasClass( '.breakpoint' ) ) {
				height = $( '#mobile-bar' ).height();
			} else {
				height = $( '#navbar-container' ).height();
			}

			return height;
		},

		/**
		 * Get the menu breakpoint from theme options
		 */
		getBreakpoint : function () {

			return WolfThemeParams.breakPoint;
		},

		/**
		 * Get the height of the top admin bar and/or menu
		 */
		getToolBarOffset : function () {

			var offset = 0;

			if ( this.body.is( '.admin-bar' ) ) {

				if ( 782 < $( window ).width() ) {
					offset = 32;
				} else {
					offset = 46;
				}
			}

			if ( WolfThemeParams.isTopbar && ! $( 'body').hasClass( 'breakpoint' ) ) {
				offset = offset + $( '#top-bar' ).outerHeight();
			}

			if ( $( '#wolf-message-bar' ).length && $( '#wolf-message-bar' ).is( ':visible' ) ) {
				offset = offset + $( '#wolf-message-bar-container' ).outerHeight();
			}

			if ( 'plain' === WolfThemeParams.menuStyle ) {
				offset = offset + this.menuHeight;
			}

			return offset;
		},

		/**
		 * Set the mobile menu offset top if the top bar is displayed
		 *  No used
		 */
		topBarMobileMenuFixed : function ( scrollTop ) {

			if ( WolfThemeParams.isTopbar ) {

				//scrollTop = scrollTop || 0;

				var winWidth = window.innerWidth ? window.innerWidth : $( window ).width(),
					targetOffsetTop = $( '#top-bar' ).offset().top + $( '#top-bar' ).outerHeight(),
					adminbarOffset = 0,
					plusAdditionalTop = 900 > winWidth ? 5 : 20;

				if ( this.body.is( '.admin-bar' ) ) {
					if ( 782 < $( window ).width() ) {
						adminbarOffset = 32;
					} else {
						adminbarOffset = 46;
					}
				}

				if ( $( '#wolf-message-bar' ).length && $( '#wolf-message-bar' ).is( ':visible' ) ) {
					adminbarOffset = adminbarOffset + $( '#wolf-message-bar-container' ).outerHeight();
				}

				if ( targetOffsetTop - adminbarOffset > scrollTop ) {
					targetOffsetTop = targetOffsetTop - scrollTop;
					//console.log( 'not sticky' );
				} else {
					targetOffsetTop = adminbarOffset;
					//console.log( 'sticky' );
				}

				$( '#mobile-bar, #navbar-mobile' ).css( { 'top' : targetOffsetTop } );
				$( '#side-menu-toggle' ).css( { 'top' : targetOffsetTop + plusAdditionalTop } );
			}
		},

		/**
		 * Sticky Menu
		 */
		stickyMenu : function ( scrollTop ) {

			if ( WolfThemeParams.isStickyMenu || this.body.hasClass( 'breakpoint' ) ) {

				scrollTop = scrollTop || 0;

				var ceilingOffset = ( $( '#ceiling' ).length ) ? $( '#ceiling' ).offset().top : 0,
					scrollPoint = ceilingOffset;

				if ( 5 > ceilingOffset ) {
					scrollPoint = 5;
				}

				if ( scrollPoint < scrollTop ) {
					this.body.addClass( 'sticky-menu' );
				} else {
					this.body.removeClass( 'sticky-menu' );
				}
			}
		},

		/**
		 * Add a custom class for safari on big screen as it doesn't handle CSS transform transition smoothly (for the menu animation).
		 * It is dirty, but it works.
		 * Why Safary ? please, stahp
		 */
		bigScreenSafariClass : function () {

			var winWidth = $( window ).width(),
				isSafari = navigator.userAgent.indexOf( 'Safari' ) !== -1 && navigator.userAgent.indexOf( 'Chrome' ) === -1,
				SafariBreakPoint = 1200;

			if ( isSafari ) {
				if ( SafariBreakPoint < winWidth ) {
					this.body.removeClass( 'do-transform' )
						.addClass( 'do-animate' );
				} else {
					this.body.removeClass( 'do-animate' )
						.addClass( 'do-transform' );
				}
			}
		},

		/**
		 *  Add a breakpoint class
		 */
		breakPoint : function () {

			var breakpoint = this.getBreakpoint();

			if ( breakpoint > $( window ).width() ) {
				this.body.addClass( 'breakpoint' );

				if ( 'left' === WolfThemeParams.menuPosition ) {
					this.body.removeClass( 'menu-left' );
				}
			} else {
				this.body.removeClass( 'breakpoint' );

				if ( 'left' === WolfThemeParams.menuPosition ) {
					this.body.addClass( 'menu-left' );
				}
			}
		},

		/**
		 * Home Header Size
		 */
		setHomeHeaderDimensions : function () {

			if ( this.body.hasClass( 'is-home-header' ) ) {

				var winHeight = Math.floor( ( $( window ).height() * WolfThemeParams.headerPercent / 100 ) - this.getToolBarOffset() ),
					winWidth = ( this.body.hasClass( 'boxed-layout' ) ) ? $( '#page-content' ).width() : $( window ).width(),
					header = $( '.header-inner' ),
					homeSlider = header.find( $( '#home-slider' ) ),
					wolfSlider = $( '#masthead' ).find( $( '.wolf-slider-container' ) ),
					topBarHeight,
					newCss;

				if ( this.body.hasClass( 'full-window-header' ) ) {
					winHeight = $( window ).height() - this.getToolBarOffset();
				}

				if ( this.body.hasClass( 'has-header-image' ) ) {
					winHeight = $( '.page-header-container' ).height();
				}

				if ( WolfThemeParams.isHomeSlider ) {
					winHeight = 'auto';
				}

				if ( 'center' === WolfThemeParams.menuPosition && ! this.body.hasClass( 'full-window-header' ) ) {
					winHeight = winHeight + 60;
				}

				if ( 'left' === WolfThemeParams.menuPosition && ! this.body.hasClass( 'breakpoint' ) ) {
					winWidth = winWidth - 280;
				}

				if ( 'center' === WolfThemeParams.menuPosition ) {

					$( '#hero' ).css( {
						'height' : winHeight - 70,
						'margin-top' : 70
					} );
				}

				if ( 'wolf-slider' === WolfThemeParams.homeHeaderType || 'featured-slider' === WolfThemeParams.homeHeaderType ) {
					winWidth = $( '#page-content' ).width();
				}

				if ( $( '#hero-content .wrap' ).height() + this.getToolBarOffset() + 200 > winHeight ) {
					winHeight = 'auto';
					$( '#hero-content .wrap' ).addClass( 'add-padding' );
					$( '#scroll-down' ).addClass( 'hide' );
				} else {
					$( '#hero-content .wrap' ).removeClass( 'add-padding' );
					$( '#scroll-down' ).removeClass( 'hide' );
				}

				// If top bar
				if ( WolfThemeParams.isTopbar && ! $( 'body' ).hasClass( 'breakpoint' ) ) {
					topBarHeight =  $( '#top-bar' ).height();
					//if ( this.body.is( '.admin-bar' ) ) {
					//	topBarHeight = topBarHeight + $( '#wpadminbar' ).height();
					//}
					//winHeight = winHeight - topBarHeight;
					//console.log( topBarHeight );
					$( '.parallax-inner' ).css( { 'top' : '-' + topBarHeight + 'px', height : $( '.parallax-inner' ).height() + topBarHeight } );
				}

				newCss = {
					width : winWidth,
					height : winHeight
				};

				if ( homeSlider.length ) {
					homeSlider.css( newCss );
					homeSlider.find( $( '.slide' ) ).css( newCss );
				}

				if ( wolfSlider.length ) {
					wolfSlider.css( newCss );
					wolfSlider.find( $( '.slide' ) ).css( newCss );
				}

				header.css( { 'height' : winHeight } );

				// fix hero content overflow for firefox
				$( '#hero-content .wrap' ).css( { 'width' : winWidth - 10 } );
			}
		},

		/**
		 * Full Window function
		 */
		fullWindowElement : function () {

			var _this = this;

			$( '.section-full-screen, .full-height, .page-header-full .page-header-container' ).each( function() {

				$( this ).css( { 'height' : $( window ).height() - _this.getToolBarOffset() } );
			} );
		},

		/**
		 * Check if the window dimension allow zoom effect
		 */
		doZoom : function () {

			var containerHeight = $( '#masthead' ).height();

			$( '.bg' ).each( function() {
				var $this = $( this ),
					img = $this.find( 'img' ),
					imgHeight = img.height();

				if ( containerHeight < imgHeight ) {
					$this.addClass( 'do-zoom' );
				} else {
					$this.removeClass( 'do-zoom' );
				}
			} );
		},

		/**
		 * Home Header Animation
		 */
		transitionParallax : function ( scrollTop ) {

			if ( this.doParallax && ( WolfThemeParams.heroParallax || 'wolf-slider' === WolfThemeParams.homeHeaderType || 'featured-slider' === WolfThemeParams.homeHeaderType  ) ) {

				var _this = this,
					$el = $( '.parallax-inner' );

				$el.each( function() {
					$el.css( {
						'transform': 'translate3d(0,-' + Math.floor( scrollTop/_this.parallaxSpeed ) + 'px,0)',
						'-webkit-transform': 'translate3d(0,-' + Math.floor( scrollTop/_this.parallaxSpeed ) + 'px,0)'
					} );
				} );
			}
		},

		/**
		 * Animate page title while scrolling
		 */
		animatePageTitle : function ( scrollTop ) {

			if ( this.doParallax && WolfThemeParams.heroFadeWhileScroll ) {

				var ratio = 0.5;

				$( '#hero, .intro' ).css( {
					'opacity': 1 - scrollTop/400
				} );

				$( '#hero' ).css( {
					'transform': 'translate3d(0,' + Math.floor( scrollTop * ratio ) + 'px,0)',
					'-webkit-transform': 'translate3d(0,' + Math.floor( scrollTop * ratio ) + 'px,0)'
				} );

				$( '.wolf-slide-caption-container, .wolf-slide-mute-button, .wolf-slide-play-button' ).css( {
					'opacity': 1 - scrollTop/400,
					'transform': 'translate3d(0,' + Math.floor( scrollTop * ratio ) + 'px,0)',
					'-webkit-transform': 'translate3d(0,' + Math.floor( scrollTop * ratio ) + 'px,0)'
				} );
			}
		},

		/**
		 * Video Background
		 */
		videoBackground : function () {

			$( '.video-bg-container').each( function () {
				var videoContainer = $( this ),
					containerWidth = videoContainer.width(),
					containerHeight = videoContainer.height(),
					ratioWidth = 640,
					ratioHeight = 360,
					video = videoContainer.find( 'video' ),
					newHeight,
					newWidth,
					newMarginLeft,
					newMarginTop,
					newCss;

				if ( videoContainer.hasClass( 'youtube-video-bg-container' ) ) {
					video = videoContainer.find( 'iframe' );
					ratioWidth = 560;
					ratioHeight = 315;

				} else {
					if ( this.isMobile && 800 > $( window ).width() ) {
						// console.log( this.isTouch );
						videoContainer.find( '.video-bg-fallback' ).css( { 'z-index' : 1 } );
						video.remove();
						return;
					}
				}

				if ( ( containerWidth / containerHeight ) >= 1.8 ) {
					newWidth = containerWidth;

					//console.log( containerWidth / containerHeight );

					newHeight = Math.floor( ( containerWidth/ratioWidth ) * ratioHeight ) + 2;
					newMarginTop =  - ( Math.floor( ( newHeight - containerHeight  ) ) / 2 );
					newMarginLeft =  - ( Math.floor( ( newWidth - containerWidth  ) ) / 2 );

					newCss = {
						width : newWidth,
						height : newHeight,
						marginTop :  newMarginTop,
						marginLeft : newMarginLeft
					};

					video.css( newCss );

				} else {
					newHeight = containerHeight;
					newWidth = Math.floor( ( containerHeight/ratioHeight ) * ratioWidth );
					newMarginLeft =  - ( Math.floor( ( newWidth - containerWidth  ) ) / 2 );

					newCss = {
						width : newWidth,
						height : newHeight,
						marginLeft :  newMarginLeft,
						marginTop : 0
					};

					video.css( newCss );
				}
			} );
		},

		/**
		 * Header Background
		 */
		headerVideoBackground : function () {

			var headerVideoPlayer,
				videoContainer = $( '#masthead .video-bg-container' );
			
			if ( videoContainer.length && ! videoContainer.hasClass( 'youtube-video-bg-container' ) ) {

				headerVideoPlayer = new MediaElementPlayer( '#masthead .video-container video', this.videoBgOptions );
				// Clean controls
				videoContainer.find( '.mejs-layers, .mejs-controls, .mejs-clear' ).remove();

				headerVideoPlayer.play();
			}
		},

		/**
		 * Section Video Background
		 */
		sectionVideoBackground : function () {

			var _this = this;
			$( '.wolf-row' ).find( '.selfhosted-video-bg' ).each( function() {
				var video = $( this ).find( 'video' );

				video = new MediaElementPlayer( video, _this.videoBgOptions );
				// Clean controls
				$( this ).find( '.mejs-layers, .mejs-controls, .mejs-clear' ).remove();

				video.play();
			} );
		},

		/**
		 * Get window state: layout or portrait
		 */
		windowSate : function () {

			if ( $( window ).width() > $( window ).height() ) {
				this.body.removeClass( 'portrait' );
				this.body.addClass( 'landscape' );
			} else {
				this.body.addClass( 'portrait' );
				this.body.removeClass( 'landscape' );
			}
		},

		/**
		 * Fluid Video wrapper
		 */
		fluidVideos : function ( container ) {

			container = container || $( '#page' );

			var videoSelectors = [
				'iframe[src*="player.vimeo.com"]',
				'iframe[src*="youtube.com"]',
				'iframe[src*="youtube-nocookie.com"]',
				'iframe[src*="youtu.be"]',
				'iframe[src*="kickstarter.com"][src*="video.html"]',
				'iframe[src*="screenr.com"]',
				'iframe[src*="blip.tv"]',
				'iframe[src*="dailymotion.com"]',
				'iframe[src*="viddler.com"]',
				'iframe[src*="qik.com"]',
				'iframe[src*="revision3.com"]',
				'iframe[src*="hulu.com"]',
				'iframe[src*="funnyordie.com"]',
				'iframe[src*="flickr.com"]',
				'embed[src*="v.wordpress.com"]'
			];

			container.find( videoSelectors.join( ',' ) ).wrap( '<span class="fluid-video" />' );
			$( '.youtube-video-bg' ).find( videoSelectors.join( ',' ) ).unwrap(); // disabled for youtube video background
			$( '.rev_slider_wrapper' ).find( videoSelectors.join( ',' ) ).unwrap(); // disabled for revslider videos
			$( '.wpb_video_wrapper' ).find( videoSelectors.join( ',' ) ).unwrap(); // disabled for visual composer videos
			$( '.fluid-video' ).parent().addClass( 'fluid-video-container' );
		},

		/**
		 * Fix z-index bug with youtube videos
		 */
		youtubeWmode : function() {

			var iframes, $iframes,
				youtubeSelector = [
					'iframe[src*="youtube.com"]',
					'iframe[src*="youtu.be"]',
					'iframe[src*="youtube-nocookie.com"]'
				];

			iframes = youtubeSelector.join( ',' );
			$iframes = $( iframes );

			if ( $iframes.length ) {

				$iframes.each(function(){

					var url = $( this ).attr( 'src' );

					if ( url  ) {

						if ( url.indexOf( '?' ) !== -1) {

							$( this ).attr( 'src', url + '&wmode=transparent' );

						} else {

							$( this ).attr( 'src', url + '?wmode=transparent' );
						}
					}
				} );
			}
		},

		/**
		 * Remove title from vimeo videos
		 */
		removeVimeoTitle : function() {

			var iframes, $iframes,
				vimeoSelector = [
					'iframe[src*="player.vimeo.com"]'
				];

			iframes = vimeoSelector.join( ',' );
			$iframes = $( iframes );

			if ( $iframes.length ) {

				$iframes.each(function(){

					var url = $( this ).attr( 'src' );

					if ( url ) {

						if ( url.indexOf( '?' ) !== -1) {

							$( this ).attr( 'src', url + '&title=0&byline=0&portrait=0' );

						} else {

							$( this ).attr( 'src', url + '?title=0&byline=0&portrait=0' );
						}
					}
				} );
			}
		},

		/**
		 * Smooth scroll
		 */
		smoothScroll : function () {
			var _this = this;

			$( '.scroll, .woocommerce-review-link' ).on( 'click', function( event ) {

				var scrollOffset = _this.getToolBarOffset(),
					menuHeight = 0,
					$this = $( this ),
					href = $this.attr( 'href' ),
					hash;

				// if it's a one page web site and we're not on the main page
				if ( _this.body.hasClass( 'one-paged' ) && $this.parent().hasClass( 'menu-item' ) && WolfThemeParams.isOnePageOtherPage ) {
					//console.log( 'yep' );
					return true;
				}

				event.preventDefault();
				event.stopPropagation();

				if ( _this.body.hasClass( 'is-sticky-menu' ) ) {
					if ( _this.body.hasClass( 'breakpoint' ) ) {
						menuHeight = 50;
					} else if ( _this.body.hasClass( 'menu-logo-centered' ) ) {
						menuHeight = 80;
					} else {
						menuHeight = 60;
					}

                                        if ( _this.body.hasClass( 'is-top-bar' ) && !  _this.body.hasClass( 'breakpoint' ) ) {
                                                menuHeight = menuHeight - 40;
                                        }
				}

				if ( _this.body.hasClass( 'menu-left' ) ) {
					menuHeight = 0;
				}

				scrollOffset = scrollOffset + menuHeight - 3;

				if ( href.indexOf( '#' ) !== -1 ) {
					hash = href.substring( href.indexOf( '#' ) + 1 );

					if ( $( '#' + hash ).length ) {
						$( 'html, body' ).stop().animate( {
							scrollTop: $( '#' + hash ).offset().top - scrollOffset
						}, 1E3, 'swing', function() {
							if ( _this.body.hasClass( 'toggled-on' ) ) {
								_this.body.removeClass( 'toggled-on' );
							}

							if ( _this.body.hasClass( 'toggled-side-on' ) ) {
								_this.body.removeClass( 'toggled-side-on' );
								$( '#navbar-container-right' ).css( { 'z-index' : -1 } );
								setTimeout( function() {
									$( '#navbar-container-right' ).hide();
								}, 450 );
							}
						} );
					}
				}
			} );
		},

		/**
		 * Slider with Tablet Background
		 */
		tabletSlider : function () {

			if ( $( '.slider-background-tablet' ).length ) {

				$( '.slider-background-tablet' ).each( function() {

					var tabletSliderContainer = $( this ),
						tabletSliderContainerWidth = tabletSliderContainer.width(),
						maxWidth = 625,
						defaultPaddingTop = 101,
						defaultPaddingLeft = 102,
						defaultPaddingRight = 95,
						defaultPaddingBottom = 0,
						newPaddingTop,
						newPaddingLeft,
						newPaddingRight,
						newPaddingBottom,
						newCss,

						colContainer = tabletSliderContainer.parent( '[class*="wolf_col_"]' );

					colContainer.css( { marginBottom : 0 } );

					if ( 822 > tabletSliderContainerWidth ) {

						newPaddingTop = Math.floor( ( tabletSliderContainerWidth / maxWidth ) * defaultPaddingTop );
						newPaddingLeft = Math.floor( ( tabletSliderContainerWidth / maxWidth ) * defaultPaddingLeft );
						newPaddingRight = Math.floor( ( tabletSliderContainerWidth / maxWidth ) * defaultPaddingRight );
						newPaddingBottom = Math.floor( ( tabletSliderContainerWidth / maxWidth ) * defaultPaddingBottom );

						newCss = {

							paddingTop : newPaddingTop,
							paddingLeft : newPaddingLeft,
							paddingRight : newPaddingRight,
							paddingBottom : newPaddingBottom

						};

						$( this ).css( newCss );
					}
				} );
			}
		},

		/**
		 * Slider with Laptop Background
		 */
		laptopSlider : function () {

			if ( $( '.slider-background-laptop' ).length ) {

				$( '.slider-background-laptop' ).each( function() {

					var laptopSliderContainer = $( this ),
						laptopSliderContainerWidth = laptopSliderContainer.width(),
						maxWidth = 676,
						defaultPaddingTop = 40,
						defaultPaddingLeft = 116,
						defaultPaddingRight = 120,
						defaultPaddingBottom = 73,
						newPaddingTop,
						newPaddingLeft,
						newPaddingRight,
						newPaddingBottom,
						newCss;

					if ( 912 > laptopSliderContainerWidth ) {

						newPaddingTop = Math.floor( ( laptopSliderContainerWidth / maxWidth ) * defaultPaddingTop );
						newPaddingBottom = Math.floor( ( laptopSliderContainerWidth / maxWidth ) * defaultPaddingBottom );
						newPaddingLeft = Math.floor( ( laptopSliderContainerWidth / maxWidth ) * defaultPaddingLeft );
						newPaddingRight = Math.floor( ( laptopSliderContainerWidth / maxWidth ) * defaultPaddingRight );

						newCss = {

							paddingTop : newPaddingTop,
							paddingLeft : newPaddingLeft,
							paddingRight : newPaddingRight,
							paddingBottom : newPaddingBottom

						};

						$( this ).css( newCss );
					}
				} );
			}
		},

		/**
		 * Slider with desktop Background
		 */
		desktopSlider : function () {

			if ( $( '.slider-background-desktop' ).length ) {

				$( '.slider-background-desktop' ).each( function() {

					var desktopSliderContainer = $( this ),
						desktopSliderContainerWidth = desktopSliderContainer.width(),
						maxWidth = 922,
						defaultPaddingTop = 41,
						defaultPaddingLeft = 42,
						defaultPaddingRight = 44,
						defaultPaddingBottom = 330,
						newPaddingTop,
						newPaddingLeft,
						newPaddingRight,
						newPaddingBottom,
						newCss;

					if ( 1007 > desktopSliderContainerWidth ) {

						newPaddingTop = Math.floor( ( desktopSliderContainerWidth / maxWidth ) * defaultPaddingTop );
						newPaddingBottom = Math.floor( ( desktopSliderContainerWidth / maxWidth ) * defaultPaddingBottom );
						newPaddingLeft = Math.floor( ( desktopSliderContainerWidth / maxWidth ) * defaultPaddingLeft );
						newPaddingRight = Math.floor( ( desktopSliderContainerWidth / maxWidth ) * defaultPaddingRight );

						newCss = {

							paddingTop : newPaddingTop,
							paddingLeft : newPaddingLeft,
							paddingRight : newPaddingRight,
							paddingBottom : newPaddingBottom

						};

						$( this ).css( newCss );
					}
				} );
			}
		},

		/**
		 * Slider with mobile Background
		 */
		mobileSlider : function () {

			if ( $( '.slider-background-mobile' ).length ) {

				$( '.slider-background-mobile' ).each( function() {

					var mobileSliderContainer = $( this ),
						mobileSliderContainerWidth = mobileSliderContainer.width(),
						maxWidth = 277,
						defaultPaddingTop = 95,
						defaultPaddingLeft = 38,
						defaultPaddingRight = 37,
						defaultPaddingBottom = 103,
						newPaddingTop,
						newPaddingLeft,
						newPaddingRight,
						newPaddingBottom,
						newCss;

					if ( 350 > mobileSliderContainerWidth ) {

						newPaddingTop = Math.floor( ( mobileSliderContainerWidth / maxWidth ) * defaultPaddingTop );
						newPaddingBottom = Math.floor( ( mobileSliderContainerWidth / maxWidth ) * defaultPaddingBottom );
						newPaddingLeft = Math.floor( ( mobileSliderContainerWidth / maxWidth ) * defaultPaddingLeft );
						newPaddingRight = Math.floor( ( mobileSliderContainerWidth / maxWidth ) * defaultPaddingRight );

						newCss = {

							paddingTop : newPaddingTop,
							paddingLeft : newPaddingLeft,
							paddingRight : newPaddingRight,
							paddingBottom : newPaddingBottom

						};

						$( this ).css( newCss );
					}
				} );
			}
		},

		/**
		 * Back to the top link animation
		 */
		topLinkAnimation : function( scrollTop ){

			if ( WolfThemeParams.doBackToTopAnimation ) {
				if ( scrollTop >= 550 ) {
					$( 'a#top-arrow' ).show();
				} else {
					$( 'a#top-arrow' ).hide();
				}
			}
		},

		/**
		 * Share Links Popup
		 */
		shareLinkPopup : function () {

			var _this = this;

			$( '.share-link, .share-link-video' ).click( function() {

				if ( $( this ).data( 'popup' ) === true && ! _this.isMobile ){

					var $link = $( this ),
						url = $link.attr( 'href' ),
						height = $link.data( 'height' ) || 250,
						width = $link.data( 'width' ) || 500,
						popup = window.open( url,'null', 'height=' + height + ',width=' + width + ', top=150, left=150' );

					if ( window.focus ) {
						popup.focus();
					}

					return false;
				}
			} );
		},

		/**
		 * Hide Overlay
		 */
		hideOverlay : function () {

			if ( ! this.isIE() ) {
				var _this = this;
				_this.overlay.fadeOut( 'slow', function() {
					_this.body.addClass( 'loaded' );
					clearInterval( _this.timer );
				} );
			}
		},

		/**
		 * Move mailchimp label in placeholder attribute
		 */
		mailchimpPlaceholder : function () {

			var input = $( '#mc_mv_EMAIL' );

			input.each( function() {
				if ( '' === $( this ).attr( 'placeholder' ) ) {
					$( this ).attr( 'placeholder', WolfThemeParams.newsletterPlaceholder );
				}
			} );
		},

		/**
		 * Additional lil hacks
		 */
		additionalFixes : function () {

			$( '[id*="more-"]' ).parent( 'p' ).css( { marginTop : 0, marginBottom : 0 } ); // no margin for the "more" anchor p parent tag
			$( '.products li').removeClass( 'first' ).removeClass( 'last' ); // remove woocommerce products "first" and "last" class
			$( '.blog-grid .is-instagram' ).find( 'a' ).attr( 'target', '_blank' );
			$( '.not-linked > a:first-child' ).attr( 'href', '#' ).click( function ( event ) { event.preventDefault(); } ); // menu not linked
			$( '.holder, .wolf-images-gallery.carousel-mosaic-gallery' ).parents( '.wolf-row-inner' ).addClass( 'no-padding' );
			$( '.holder, .wolf-images-gallery.carousel-mosaic-gallery' ).parents( '.wolf-row' ).addClass( 'wolf-row-full-width' );
			$( '.holder, .wolf-images-gallery.carousel-mosaic-gallery' ).parents( '.wolf-row' ).removeClass( 'wolf-row-standard-width content-light-font content-dark-font' );
			$( '.wolf-row' ).find( '.wolf-row' ).removeClass( 'wolf-row-standard-width content-light-font content-dark-font' );

			$( '.col, .col-1, .col-10, .col-11, .col-12, .col-2, .col-3, .col-4, .col-5, .col-6, .col-7, .col-8, .col-9' ).removeClass( 'wpb_column vc_column_container' );

			//$( '[class*="wp-image-"]' ).parents( 'div' ).addClass( 'wolf-attachment' ); // full width image parent p tag
			$( '.alignnone, .aligncenter' ).parents( 'p' ).addClass( 'full-width-attachment' );

			// caption
			$( '.wp-caption.alignleft, .wp-caption.alignleft + p' ).wrapAll( '<div class="float-attachment-container" />' );
			//$( 'p ~ .wp-caption.alignright' ).wrapAll( '<div class="float-attachment-container" />' );

			$( '.single .entry-media' ).find( '.rev_slider_wrapper' ).wrap( '<div class="wolf-revslider-container" />' );

			// cols
			$( '.wolf-row-inner .wrap' ).find( '[class^="col-"]:first-of-type' ).addClass( 'alpha' );
			//$( '.wolf-row-inner .wrap [class^="col-"]:last-child, .wolf-row-inner .wrap [class*="col-"]:last-child').addClass( 'omega' );
		
			//$( '.product-caption-container' ).unwrap();
		},

		/**
		 * Toggle menu for mobile
		 */
		toggleMenu : function () {

			var _this = this,
				nav,
				button = $( '.menu-toggle' ),
				menu,
				dropDown,
				toggleClass,
				overlay;

			if ( ! WolfThemeParams.modernMenu ) {
				nav = $( '#site-navigation-primary-mobile' ),
					dropDown = $( '.dropdown li.menu-item-has-children a, .dropdown li.page_item_has_children a' ),
					menu = nav.find( '#mobile-menu' );
			} else {
				nav = $( '#site-navigation-primary-modern' ),
					menu = nav.find( '#modern-menu' ),
					overlay = $( '#modern-menu-overlay' );
			}

			if ( ! nav || ! button ) {
				return;
			}

			// Hide button if menu is missing or empty.
			if ( ! menu || ! menu.children().length ) {
				button.hide();
				return;
			}

			button.on( 'click', function( event ) {
				event.preventDefault();
				if ( $( 'body' ).hasClass( 'toggled-on' ) ) {

					// close other toggle menu
					$( 'body' ).removeClass( 'toggled-on' );
					$( 'body' ).removeClass( 'toggled-side-on' );

					if ( WolfThemeParams.modernMenu ) {
						overlay.fadeOut( 'fast' );
						$( window ).trigger( 'resize' );
						$( '.parallax-inner' ).css( { 'position' : 'fixed' } );

					}
				} else {

					// close other toggle menu
					$( 'body' ).addClass( 'toggled-on' );
					$( 'body' ).removeClass( 'toggled-side-on' );
					$( '#navbar-container-right' ).css( { 'z-index' : 0 } );

					if ( WolfThemeParams.modernMenu ) {
						overlay.fadeIn( 'fast' );
						$( '.parallax-inner' ).css( { 'position' : 'absolute' } );
					}
				}
			} );

			toggleClass = 'toggled-' + WolfThemeParams.addMenuType + '-on';

			$( '#navbar-container-right' ).hide();

			$( '.toggle-add-menu' ).on( 'click', function( event ) {
				event.preventDefault();

				if ( $( 'body' ).hasClass( toggleClass ) ) {

					if ( 'side' === WolfThemeParams.addMenuType  ) {
						$( '#navbar-container-right' ).css( { 'z-index' : -1 } );
						setTimeout( function() {
							$( '#navbar-container-right' ).hide();
						}, 450 );
					}

					$( 'body' ).removeClass( toggleClass );

				} else {
					$( 'body' ).removeClass( 'toggled-on' );
					$( 'body' ).addClass( toggleClass );
					$( '#navbar-container-right' ).show();

					if ( 'side' === WolfThemeParams.addMenuType  ) {
						setTimeout( function() {
							$( '#navbar-container-right' ).css( { 'z-index' : 100 } );
						}, 450 );
					}
				}
			} );

			$( '#close-overlay-menu' ).on( 'click', function( event ) {
				event.preventDefault();
				$( 'body' ).removeClass( toggleClass );
			} );

			$( '#close-side-panel' ).on( 'click', function( event ) {
				event.preventDefault();
				$( 'body' ).removeClass( toggleClass );
			} );

			$( '#page' ).on( 'click', function( event ) {

				var target = $( event.target ),
					targetId = event.target.id,
					isLink = target.is( 'a' );

				if ( ! isLink && targetId !== 'navbar' && _this.body.hasClass( 'toggled-on' ) ) {
					_this.body.removeClass( 'toggled-on' );
					if ( WolfThemeParams.modernMenu ) {
						overlay.fadeOut( 'fast' );
					}
				}
			} );

			$( '#page' ).on( 'click', function( event ) {

				var target = $( event.target ),
					targetId = event.target.id,
					isLink = target.is( 'a' );

				if ( ! isLink && targetId !== 'navbar-container-right' && _this.body.hasClass( 'toggled-add-menu-on' ) ) {
					_this.body.removeClass( 'toggled-add-menu-on' );
				}
			} );

			if ( ! WolfThemeParams.modernMenu ) {

				dropDown.each( function() {
					var $link = $( this );

					if ( $link.parent().find( 'ul:first' ).length ) {

						$link.toggle( function( event ) {

							event.preventDefault();

							$link.parent().find( 'ul:first' ).slideDown();

						}, function() {

							$link.parent().find( 'ul:first' ).slideUp();
						} );
					}
				} );
			}
		},

		/**
		 * Top Search form toggle
		 */
		searchFormToggle : function () {

			var searchBar = $( '#top-search-form-container' );

			searchBar.append( '<span id="close-search" />' );

			$( '.search-menu-item-link' ).click( function( event ) {
				event.preventDefault();

				if ( ! searchBar.is( ':visible' ) ) {
					searchBar.fadeIn( 'fast' );
					searchBar.find( 'input' ).focus();
				}
			} );

			$( '#close-search' ).click( function() {

				if ( searchBar.is( ':visible' ) ) {
					searchBar.fadeOut( 'fast' );
				}
			} );
		},

		/**
		 * Set lightbox depending on user's theme options
		 */
		lightbox : function() {

			var _this = this,
				videoItem = $( '.video-item-container' ),
				postId,
				data;

			if ( WolfThemeParams.doWoocommerceLightbox ) {
				$( 'a[data-rel^="prettyPhoto"]' ).each( function() {
					//console.log( $( this ).data( 'rel' ) );
					$( this ).attr( 'rel', $( this ).data( 'rel' ) );
				} );
			}

			if ( $.isFunction( $.swipebox ) && 'swipebox' === WolfThemeParams.lightbox ) {

				$( '.lightbox, .wolf-show-flyer, .wolf-show-flyer-single, .last-photos-thumbnails, .zoom, a[data-rel^="prettyPhoto"]' ).swipebox();

				if ( null !== WolfThemeParams.videoLightbox ) {

					$( '.video-item-container .entry-link, .lightbox-video' ).swipebox( {
						hideBarsDelay : 0,
						vimeoColor : WolfThemeParams.accentColor,
						afterOpen : function () {

							_this.removeVimeoTitle();

							$( '#swipebox-close' ).css( {
								'right' : 'auto',
								'left' : 0
							} );
						}
					} );
				}

			} else if ( $.isFunction( $.fancybox ) && 'fancybox' === WolfThemeParams.lightbox ) {

				$( '.lightbox, .wolf-show-flyer, .wolf-show-flyer-single, .last-photos-thumbnails, .zoom, a[data-rel^="prettyPhoto"]' ).fancybox();

				if ( null !== WolfThemeParams.videoLightbox ) {
					$( '.video-item-container .entry-link, .lightbox-video' ).fancybox( {
						padding : 0,
						nextEffect : 'none',
						prevEffect : 'none',
						openEffect  : 'none',
						closeEffect : 'none',
						helpers : {
							media : {},
							title : {
								type : 'outside'
							},
							overlay : {
								opacity: 0.9
							}
						}
					} );
				}
			}

			/**
			 * Add replace entry link by video link
			 */
			if ( $( '.video-item-container' ).length && WolfThemeParams.videoLightbox !== null && WolfThemeParams.lightbox !== 'none' ) {

				videoItem.each( function() {

					var _this = $( this );

					postId = _this.attr( 'id' ).replace( 'post-', '' );

					data = {
						action: 'wolf_ajax_get_video_url_from_post_id',
						id : postId
					};

					$.post( WolfThemeParams.ajaxUrl , data, function(response){

						//console.log( response );
						if ( response ) {
							_this.find( '.entry-link' ).attr( 'href', response );
						}

					} );
				} );

				$( '.video-item-container .entry-link' ).each( function(){ $( this ).attr( 'rel','video-gallery' ); } );
			}

			$( '.gallery .lightbox' ).each( function(){ $( this ).attr( 'rel', 'gallery' ); } );
		},

		/**
		 *  Parallax Background
		 */
		parallax : function () {

			if ( this.doParallax ) {

				if ( this.isIE() ) {
					// Use another parallax plugin for IE
					$( '.section-parallax' ).parallax( '50%', 0.1 );
				} else {
					$( '.section-parallax' ).haParallax();
				}
			}
		},

		/**
		 * Show overlay on link click
		 */
		pageTransition : function() {

			if ( WolfThemeParams.doPageTransition ) {

				var $links, href,
					target,
					selectors = [
						'.transition-link',
						'.work-thumbnail a',
						'.pagination a',
						'.woocommerce-pagination a',
						'.menu',
						'.nav-menu li a:not(.toggle-add-menu, .search-menu-item-link, .external, .not-linked, .scroll)',
						'.secondary-nav-menu li a:not(.toggle-add-menu, .search-menu-item-link, .external, .not-linked, .scroll)',
						'.wolf-wpml-flag',
						'.mask-link:not(.entry-link)',
						'.in-site',
						'.breadcrumb a',
						'.more-link',
						'.logo a',
						'.widget_nav_menu a',
						'.home-blog-grid .entry-thumbnail',
						'.nav-single a',
						'.entry-meta a:not(.lightbox, .scroll)',
						'.widget_recent_entries a',
						'.widget_archive a',
						'.widget_tag_cloud a',
						'.widget_recent_comments a',
						'.widget_categories a',
						'.widget_last_themes a',
						'.widget_last_demos a',
						'.widget.woocommerce a',
						'.archives-list a',
						'.tag-list a',
						'.comment-navigation a',
						'.release-navigation a',
						'.wolf-show-entry-link',
						'.widget_last_release a',
						'.related-post a',
						'.wolf_widget_recent_posts a',
						'.wolf_widget_recent_comments a',
						'.product_meta a',
						'.wolf-linked-image a'
					];

				if ( null !== WolfThemeParams.videoLightbox ) {
					selectors.push( '.entry-link:not(.video-item-container .entry-link)' );
				} else {
					selectors.push( '.entry-link' );
				}

				$links = $( selectors.join( ',' ) );

				$links.on( 'click', function( event ) {
					href = $( this ).attr( 'href' );
					target = $( this ).attr( 'target' );
					//console.log( target );
                                        if ( '_blank' !== target ) {
                                                if ( 1 === event.which && '#' !== href && href.indexOf( '#' ) === -1 ) {
                                                        $( '#loading-overlay' ).fadeIn( 'slow' );
                                                }
                                        }
				} );
			}
		},

		/**
		 * FlexSlider
		 */
		flexSlider : function() {

			if ( $.isFunction( $.flexslider ) ) {

				var defaultTransition = ( Modernizr.isTouch ) ? 'slide' : 'fade';

				/* Last Posts Slider */
				$( '.last-posts-slider .flexslider' ).each( function() {
					var $slider = $( this ),
						transition,
						dataAutoplay = $slider.data( 'autoplay' ),
						dataSpeed = $slider.data( 'slideshow-speed' ),
						dataPauseonHover = $slider.data( 'pause-on-hover' ),
						dataTransition = $slider.data( 'transition' );

					transition = ( 'auto' === dataTransition ) ? defaultTransition : dataTransition;

					$slider.flexslider( {
						animation: transition,
						slideshow : dataAutoplay,
						pauseOnHover: dataPauseonHover,
						slideshowSpeed : dataSpeed,
						smoothHeight: true,
						directionNav : true,
						controlNav : true
					} );
				} );

				/* Image Slider */
				$( '.wolf-images-slider' ).each( function () {
					var $slider = $( this ),
						transition,
						dataAutoplay = $slider.data( 'autoplay' ),
						dataSpeed = $slider.data( 'slideshow-speed' ),
						dataPauseonHover = $slider.data( 'pause-on-hover' ),
						dataTransition = $slider.data( 'transition' ),
						dataNavbullets = $slider.data( 'nav-bullets' ),
						dataArrows = $slider.data( 'nav-arrows' );

					transition = ( 'auto' === dataTransition ) ? defaultTransition : dataTransition;

					$slider.flexslider( {
						animation: transition,
						slideshow : dataAutoplay,
						pauseOnHover: dataPauseonHover,
						slideshowSpeed : dataSpeed,
						smoothHeight: true,
						directionNav : dataArrows,
						controlNav : dataNavbullets
					} );
				} );

				/* Gallery header slider */
				$( '.wolf-wp-gallery-slider' ).flexslider( {
					animation: defaultTransition,
					slideshow : true,
					controlNav : true,
					directionNav : true,
					slideshowSpeed : 4000
				} );

				/* Gallery header slider */
				$( '#gallery-header-slider' ).flexslider( {
					animation: 'fade',
					slideshow : true,
					controlNav : false,
					directionNav : false,
					slideshowSpeed : 4000
				} );

				/* Gallery header slider */
				$( '.post-gallery-slider' ).flexslider( {
					animation: defaultTransition,
					slideshow : true,
					controlNav : true,
					directionNav : true,
					slideshowSpeed : 4000,
					smoothHeight : true
				} );
			}
		},

		/**
		 * Use Wow plugin to reveal animation on page scroll
		 */
		wowAnimate : function () {
			if ( this.doAnimation ) {
				var wowAnimate = new WOW( { offset : 50 } ); // init wow for CSS animation
				wowAnimate.init();
			}
		},

		/**
		 * Counter
		 */
		animateNumber : function () {

			$( '.counter' ).counterUp( {
				delay: 100,
				time: 1000
			} );
		},

		/**
		 * Make the second word of a given title bolder
		 */
		wrapSecondWordInTitle : function () {
			$( '.video-title' ).html( function( i, v ) {
				return v.replace( /\s(.*?)\s/, ' <strong>$1</strong> ' );
			} );
		},

		/**
		 * Close alert message
		 */
		closeAlertMessage : function () {

			$( '.wolf-alert-close' ).click( function() {
				$( this ).parent().slideUp();
			} );
		},

		/**
		 * Last Post shortcode Masonry
		 */
		lastPostMasonry : function () {
			var $container = $( '.last-posts-masonry' );
			$container.imagesLoaded( function() {
				$container.isotope( {
					itemSelector : '.post'
				} );
			} );
		},

		/**
		 * Over effect when custom colors are set
		 */
		hoverEffect : function () {
			$( '.wolf-button-custom-style, .wolf-icon-custom-style, .wolf-social-custom-style' ).each( function() {
				var $button = $( this ),
					originbgColor = $button.css( 'background-color' ),
					originfontColor = $button.css( 'color' ),
					originborderColor = $button.css( 'border-color' ),
					bgColor = $button.data( 'hover-bg-color' ) || $button.css( 'background-color' ),
					fontColor = $button.data( 'hover-font-color' ) || $button.css( 'color' ),
					borderColor = $button.data( 'hover-border-color' ) || $button.css( 'border-color' );

				$button.hover(
					function() {
						$button.css( {
							'background-color' : bgColor,
							'color' : fontColor,
							'border-color' : borderColor
						} );
					},
					function() {
						$button.css( {
							'background-color' : originbgColor,
							'color' : originfontColor,
							'border-color' : originborderColor
						} );
					}
				);
			} );
		},

		/**
		 * Video grid hover effect
		 */
		videoGridHoverEffect : function () {
			if ( this.noTouch ) {

				$( '.effect-lily' ).each( function() {
					var $this = $( this ),
						$img = $this.find( 'img' ),
						offset = $this.find( '.entry-title' ).height() + 15;

					//console.log( offset );

					$this.hover(
						function() {
							$img.css( {
								'-webkit-transform' : 'translate3d(0,-' + offset + 'px,0)',
								'transform' : 'translate3d(0,-' + offset + 'px,0)'
							} );
						},
						function() {
							$img.css( {
								'transform' : 'translate3d( 0,0,0 )',
								'-webkit-transform' : 'translate3d( 0,0,0 )'
							} );
						}
					);
				} );
			}
		},

		/**
		 * Uncover footer effect
		 */
		footerUncover : function () {
			if ( WolfThemeParams.footerUncover ) {
				$( '#colophon' ).addClass( 'uncover' );
				$( '#main' ).css( {
					'margin-bottom' : $( '#colophon' ).height()
				} );
			}
		},

		/**
		 * Fittext
		 */
		fitText : function () {
			$( '.fittext' ).each( function() {
				var maxFontSize = $( this ).data( 'max-font-size' ) || 60;
				$( this ).fitText( 1.2, { minFontSize: '14px', maxFontSize: maxFontSize + 'px' } );
			} );
		},

		/**
		 * Mailchimp subscription
		 */
		mailchimpSubscribe : function () {

			$( '.wolf-mailchimp-submit' ).on( 'click', function( event ) {
				event.preventDefault();

				var $submit = $( this ),
					$form = $submit.parents( '.wolf-mailchimp-form' ),
					$result = $form.find( '.wolf-mailchimp-result' ),
					list_id = $form.find( '.wolf-mailchimp-list' ).val(),
					email = $form.find( '.wolf-mailchimp-email' ).val(),
					data = {

						action : 'wolf_mailchimp_ajax',
						list_id : list_id,
						email : email
					};

				$result.animate( { 'opacity' : 0 } );

				$.post( WolfThemeParams.ajaxUrl, data, function( response ) {
					$result.html( response ).animate( { 'opacity' : 1 } );
					setTimeout( function() {
						$result.animate( { 'opacity' : 0 } );
					}, 4000 );
				} );
			} );
		},

		/**
		 * Set background to process icon for the line effect
		 */
		processShortcode : function () {

			if ( $( '.process-container' ).length ) {
				$( '.process-container' ).each( function() {
					var $section = $( this ).parents( '.wolf-row' ),
					sectionBgColor = $section.css( 'background-color' ),
					sectionBgImg = $section.css( 'background-image' ),
					dataParallax = $section.data( 'section-index' ),
					$circle = $section.find( '.fa-stack' );

					if ( 'none' === sectionBgImg && ! dataParallax ) {

						$circle.css( { 'background-color' : sectionBgColor } );

					} else {

						$( this ).addClass( 'no-line' );
					}
				} );
			}
		},

		/**
		 * Set a minimum height for the page content
		 */
		setMinHeight : function () {
			var offset = this.getToolBarOffset(), minHeight;

			if ( $( '#colophon' ).length ) {
				offset = offset + $( '#colophon' ).outerHeight();
			}

			minHeight = $( window ).height() - offset;

			$( '#main' ).css( { 'min-height' : minHeight } );
		},

		/**
		 * Youtube style video single page
		 */
		singleVideoFunctions : function () {
			$( '.video-tabs-menu a' ).click(function(event) {
				event.preventDefault();
				$( this ).parent().addClass( 'current' );
				$( this ).parent().siblings().removeClass( 'current' );
				var tab = $( this ).attr( 'href' );
				$( '.video-tab-content' ).not( tab ).hide();
				$( tab ).show();
			} );

			$( '.video-meta input' ).on( 'click', function () {
				$( this ).select();
			} );

			$( '.item-share, .close-share-panel' ).on( 'click', function () {
				$( '.video-meta' ).toggle();
			} );

			$( '.video-read-more' ).click( function() {
				$( '.video-excerpt' ).hide();
				$( '.video-content' ).show();
			} );

			$( '.video-read-less' ).click( function() {
				$( '.video-excerpt' ).show();
				$( '.video-content' ).hide();
			} );
		},

		/**
		 * Commentform placeholder
		 */
		commentForm : function () {

			$( '#comment' ).attr( 'placeholder', WolfThemeParams.replyTitle );

			$( '#comment' ).on( 'focus', function() {
				$( this ).attr( 'placeholder', '' );
				//$( '.form-submit' ).show();
			} );

			$( '#respond' ).on( 'focusout', function() {
				$( '#comment' ).attr( 'placeholder', WolfThemeParams.replyTitle );
				//$( '.form-submit' ).hide();
			} );
		},

		/**
		 * Special post background for quote, link, and status post format
		 */
		postBg : function () {
			$( '[data-bg]' ).each( function() {
				var style, $this = $( this ),
					imgUrl = $this.data( 'bg' );

				//console.log( imgUrl );

				if ( '' !== imgUrl ) {
					if ( $this.hasClass( 'format-quote' ) || $this.hasClass( 'format-link' ) || $this.hasClass( 'format-aside' ) ) {
						style = 'background-color:transparent;background-image:url(' + imgUrl + ');background-repeat:no-repeat;background-position:center center;background-size:100%;background-size:cover;-webkit-background-size:100%;-webkit-background-size:cover;';
						$this.find( '.entry-content' )
							.attr( 'style', style )
							.addClass( 'has-bg' );
					}
				}
			} );
		},

		/**
		 * Add featured image backgrounds to post navigation
		 */
		singlePostNavBg : function () {
			$( '.nav-single' ).find( '[data-bg]' ).each( function() {

				var style, $this = $( this ),
					imgUrl = $this.data( 'bg' );

				// console.log( imgUrl );

				if ( '' !== imgUrl ) {
					style = 'background-color:transparent;background-image:url(' + imgUrl + ');background-repeat:no-repeat;background-position:center center;background-size:100%;background-size:cover;-webkit-background-size:100%;-webkit-background-size:cover;';
					$this.addClass( 'nav-has-bg' )
						.prepend( '<span class="nav-bg-overlay" />' );

					$this.find( '.nav-bg-overlay' ).attr( 'style', style );
				}
			} );
		},

		/**
		 * Update WooCommerce menu cart on page load to avoid issue with cache plugins
		 */
		updateCart : function () {

			//alert('test');
			if ( $( '.cart-menu-item' ).length ) {

				var cartPanel = $( '.cart-menu-item' ),
					bubble = cartPanel.find( '.product-count' ),
					panelCount = cartPanel.find( '.panel-product-count' ),
					amount = cartPanel.find( '.amount' );

				if ( $.cookie( 'wolf_woocommerce_items_in_cart' ) ) {
					bubble.html( $.cookie( 'wolf_woocommerce_items_in_cart' ) );
					panelCount.html( $.cookie( 'wolf_woocommerce_items_in_cart' ) );
				}

				if ( $.cookie( 'wolf_woocommerce_cart_total' ) ) {
					amount.html( $.cookie( 'wolf_woocommerce_cart_total' ) );
				}
			}
		},

		/**
		 * Set mega menu background
		 */
		megaMenuBg : function () {

			$( '.mega-menu' ).each( function() {
				var $this = $( this ),
					bg = $this.data( 'mega-menu-bg' ),
					bgRepeat = 'repeat' === $this.data( 'mega-menu-bg-repeat' );

				if ( bg ) {
					$this.find( '.sub-menu' ).css( {
						'background-image' : 'url('+ bg +')'
					} );

					if ( bgRepeat ) {
						$this.find( '.sub-menu' ).addClass( 'mega-menu-bg-repeat' );
					}
				}
			} );
		},

		/**
		 * Allow scrolling if right side menu iheight is too high
		 */
		fixedMobileMenu : function ( scrollTop ) {

			if ( this.body.hasClass( 'breakpoint' ) ) {

				var _this = this,
					adminbar = 0,
					menuTopPos = 0,
					offset = 0,
					winHeight = $( window ).height(),
					winWidth = $( window ).width(),
					panel = $( '#navbar-mobile' ),
					panelheight = $( '#mobile-bar' ).outerHeight() + $( '#mobile-menu' ).outerHeight();

				if ( _this.body.hasClass( 'admin-bar' ) ) {
					if ( 782 > winWidth ) {
						adminbar = 46;
					} else {
						adminbar = 32;
					}
				}

				if ( winHeight < panelheight ) {

					menuTopPos = adminbar - scrollTop;
					offset = panelheight - winHeight;

					// console.log( offset );

					if ( menuTopPos > - offset ) {
						$( '#mobile-bar' ).css( {
							//'position' :'absolute',
							'top' : menuTopPos
						} );
						$( '#mobile-menu' ).css( {
							'position' :'absolute',
							'top' : menuTopPos
						} );
					} else {
						// $( '#mobile-bar' ).removeAttr( 'style' );
						// $( '#mobile-menu' ).removeAttr( 'style' );
					}
				}
			}
		},

		/**
		 * Allow scrolling if right side menu iheight is too high
		 */
		fixedSideMenu : function ( scrollTop ) {

			if ( ( $( '#navbar-container-right' ).length && this.body.hasClass( 'toggled-side-on' ) ) || $( '#navbar-container-left' ).length ) {

				var _this = this,
					adminbar = 0,
					menuTopPos = 0,
					offset = 0,
					winHeight = $( window ).height(),
					winWidth = $( window ).width(),
					panel = $( '#navbar-container-right' ),
					panelheight = panel.outerHeight();

				if ( $( '#navbar-container-left' ).length ) {
					panel = $( '#navbar-container-left' );
					panelheight = $( '#navbar-container-left' ).outerHeight();
				}

				if ( _this.body.hasClass( 'admin-bar' ) ) {
					if ( 782 > winWidth ) {
						adminbar = 46;
					} else {
						adminbar = 32;
					}
				}

				if ( winHeight < panelheight ) {

					menuTopPos = adminbar - scrollTop;
					offset = panelheight - winHeight;

					if ( menuTopPos > - offset ) {
						panel.css( {
							'top' : menuTopPos
						} );
					}
				}
			}
		},

		/**
		 * Side Menu transparency
		 */
		leftMenuTransparency : function ( scrollTop ) {

			if ( WolfThemeParams.leftMenuTransparency ) {
				scrollTop = scrollTop || 0;
				if ( this.body.hasClass( 'is-home-header' ) && this.body.hasClass( 'full-window-header' ) ) {

					$( '#navbar-container-left' ).addClass( 'transparency' );

					if ( 100 > scrollTop ) {
						$( '#navbar-container-left' ).addClass( 'transparency' );
					} else {
						$( '#navbar-container-left' ).removeClass( 'transparency' );
					}
				}
			}
		},

		/**
		 * Make WP video shortcode responsive
		 */
		videoShortcode : function () {

			$( '.wp-video' ).each( function() {
				var $this = $( this ),
					width = $this.parent().width(),
					height = Math.floor( ( width/16 ) * 9 );

				$this.css( {
					'width' : width,
					'height' : height
				} );
			} );
		},

		/**
		 * Add margin to single portfolio image format if the image is smaller that the window width
		 */
		singlePostMarginTop : function () {

			var winWidth = $( '.site-wrapper' ).width(),
				postItem, postFeaturedMedia,
				workItem, workFeaturedMedia;

			if ( this.body.hasClass( 'single-work' ) ) {
				if ( $( 'article.type-work' ).length && $( 'article.type-work' ).hasClass( 'work-standard-layout' ) ) {

					if ( $( 'article.type-work' ).hasClass( 'format-image' ) || $( 'article.type-work' ).hasClass( 'format-standard' ) || $( 'article.type-work' ).hasClass( 'format-video' ) ) {
						workItem = $( 'article.type-work' );
						workFeaturedMedia = workItem.find( '.entry-media img' );

						if ( $( 'article.type-work' ).hasClass( 'format-video' ) ) {

							workFeaturedMedia = workItem.find( '.entry-media .fluid-video' );

							if ( ! workFeaturedMedia.length ) {
								workFeaturedMedia = workItem.find( '.entry-media .wp-video' );
							}
						}

						if ( workFeaturedMedia.length ) {
							if ( workFeaturedMedia.width() < winWidth ) {
								workItem.addClass( 'work-has-margin-top' );
							} else {
								workItem.removeClass( 'work-has-margin-top' );
							}
						}
					}
				}
			}

			if ( this.body.hasClass( 'single-post' ) ) {
				if ( $( 'article.type-post' ).length && $( 'article.type-post' ).hasClass( 'post-standard-layout' ) ) {

					if ( $( 'article.type-post' ).hasClass( 'format-image' ) || $( 'article.type-post' ).hasClass( 'format-standard' ) || $( 'article.type-post' ).hasClass( 'format-video' ) ) {
						postItem = $( 'article.type-post' );
						postFeaturedMedia = postItem.find( '.entry-media img' );

						if ( $( 'article.type-post' ).hasClass( 'format-video' ) ) {

							postFeaturedMedia = postItem.find( '.entry-media .fluid-video' );

							if ( ! postFeaturedMedia.length ) {
								postFeaturedMedia = postItem.find( '.entry-media .wp-video' );
							}
						}

						if ( postFeaturedMedia.length ) {
							if ( postFeaturedMedia.width() < winWidth ) {
								postItem.addClass( 'post-has-margin-top' );
							} else {
								postItem.removeClass( 'post-has-margin-top' );
							}
						}
					}
				}
			}
		},

		/**
		 * Trick to customize the embed tweet
		 */
		loadTwitter : function() {

			var tweet = $( '.twitter-tweet-rendered' ),
				tweetItems = $( '.post.is-tweet' );

			setTimeout( function() {
				if ( tweet.length ) {
					tweet.each( function() {
						$( this ).removeAttr( 'style' )
						.attr( 'height' , 'auto' )
						.animate( { 'opacity' : 1 } );
					} );
				}

				if ( tweetItems.length ) {
					tweetItems.each( function() {
						$( this ).animate( { 'opacity' : 1} );
					} );
				}
			}, 500 );
		},

		/**
		 * Instagrams fade in
		 */
		loadInstagram : function() {
			var instagramItems = $( '.post-item.is-instagram' );

			if ( instagramItems.length ) {
				instagramItems.each( function() {
					$( this ).animate( { 'opacity' : 1} );
				} );
			}
		},

		/**
		 * Function to fire on page load
		 */
		pageLoad : function () {

			this.flexSlider();

			if ( ! this.isIE() ) {
				$( window ).trigger('resize'); // trigger resize event to force all window size related calculation
				$( window ).trigger('scroll'); // trigger scroll event to force all window scroll related calculation
			}

			// Hide loader overlay if visible
			if ( this.overlay.is( ':visible' ) ) {

				this.hideOverlay();

			} else {

				if ( ! this.body.hasClass( 'loaded' ) ) {
					this.body.addClass( 'loaded' );
				}
			}

			this.videoShortcode();

			if ( ! this.isIE() ) {
				this.parallax();
				this.loadInstagram();
				this.loadTwitter();
				$( 'a#scroll-down' ).addClass( 'animated bounce' ); // home scroll down animation
			}
		}
	};

}( jQuery );

( function( $ ) {

	'use strict';

	$( document ).ready( function() {
		WolfThemeUi.init();
	} );

	$( window ).load( function() {
		WolfThemeUi.pageLoad();
	} );

} )( jQuery );
