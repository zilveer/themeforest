
// ================================================================================== //

	// # Document on Ready
	// # Document on Resize
	// # Document on Scroll
	// # Document on Load

	// # Header
	// # Main Menu
	// # Feature Section
	// # Feature Content Animations
	// # Feature Parallax
	// # Page Title
	// # Resize Feature
	// # Page Settings
	// # Basic Elements
	// # Isotope
	// # Portfolio Auto Resize Headings
	// # Parallax Section
	// # Set Equal Columns Height
	// # Section Settings
	// # Social Bar For Post
	// # Related Post
	// # Scroll Direction
	// # Global Variables
	// # Scrollbar Width
	// # Full Page

	// # Sticky Section

// ================================================================================== //


var GRVE = GRVE || {};
var mobstickySidebar = false;
var spinner = '<div class="grve-spinner"></div>';
var addFeatureSpinner =  true;
var addFeatureSpinner =  true;
var deviceDoubleTap =  true;

(function($){

	"use strict";


	// # Document on Ready
	// ============================================================================= //
	GRVE.documentReady = {
		init: function(){
			GRVE.pageSettings.bodyLoader();
			GRVE.pageSettings.removeVideoBg();
			GRVE.header.init();
			GRVE.sectionSettings.init();
			GRVE.setColumnHeight.init();
			GRVE.mainMenu.init();
			GRVE.slideToggleMenu.init( '#grve-hidden-menu', '#grve-hidden-menu .grve-menu' );
			GRVE.slideToggleMenu.init( '#grve-main-header.grve-header-side', '#grve-main-menu.grve-vertical-menu .grve-menu' );
			GRVE.slideToggleMenu.init( '#grve-sidearea', '.widget_nav_menu' );
			if( $('#grve-feature-section').length > 0 ){
				GRVE.featureSection.init();
				GRVE.featureSize.init( '#grve-feature-section' );
				GRVE.featureParallax.init({ section: '#grve-feature-section.grve-bg-parallax', threshold : 350 });
			}
			if( $('.grve-page-title').length > 0 ){
				GRVE.featureSection.init({ section : '.grve-page-title' });
				GRVE.featureSize.init( '.grve-page-title' );
			}
			GRVE.parallaxSection.init('.grve-section.grve-bg-parallax');
			GRVE.pageSettings.init();
			GRVE.isotope.init();
			GRVE.isotope.noIsoFilters();
			GRVE.basicElements.init();
			GRVE.relatedPost.init();
			GRVE.fullPage.init();

		}
	};

	// # Document on Resize
	// ============================================================================= //
		GRVE.documentResize = {
		init: function(){
			if( $('#grve-feature-section').length > 0 ){
				GRVE.featureSize.init( '#grve-feature-section' );
			}
			if( $('.grve-page-title').length > 0 ){
				GRVE.featureSize.init( '.grve-page-title' );
			}
			GRVE.sectionSettings.init();
			GRVE.setColumnHeight.init();
			GRVE.relatedPost.itemWidth();
			GRVE.basicElements.imageText();
		}
	};

	// # Document on Scroll
	// ============================================================================= //
	GRVE.documentScroll = {
		init: function(){
			GRVE.header.stickyHeader();
			GRVE.header.stickyDevices();
			GRVE.featureSection.stopSlider();
			GRVE.socialBar.init();
			GRVE.pageSettings.onePageMenu();
			GRVE.pageSettings.stickySidebar();
			GRVE.pageSettings.anchorSticky();
		}
	};

	// # Document on Load
	// ============================================================================= //
	GRVE.documentLoad = {
		init: function(){
			GRVE.basicElements.iconBox();
			GRVE.socialBar.init();
			GRVE.pageSettings.fixedFooter();

			// Location Hash
			if (window.location.hash) {
				setTimeout(function() {
					var target = window.location.hash;
					$('html, body').scrollTop( $(target).offset().top );
				}, 0);
			}

		}
	};

	// # Header
	// ============================================================================= //
	GRVE.header = {
		init: function(){
			GRVE.header.stickyHeader();
			GRVE.header.stickyDevices();
		},
		calHeight: function(){
			var $mainHeader  = $('#grve-main-header'),
				headerHeight = $mainHeader.height();
			if( $('#grve-header').hasClass('hide') || $('#grve-header').data('sticky') == 'none'  ) {
				headerHeight = 0;
			}
			return headerHeight;
		},
		stickyHeader: function(){

			if( $(window).width() + scrollBarWidth < tabletPortrait || !$('#grve-header').length > 0 ) return;

			var $header      = $('#grve-header'),
				$mainHeader  = $('#grve-main-header'),
				stickyType   = $header.data('sticky'),
				scroll       = $(window).scrollTop(),
				topBarHeight = $('#grve-top-bar').length ? $('#grve-top-bar').height() : 0,
				offset       = topBarHeight + wpBarHeight,
				headerHeight = $mainHeader.height(),
				headerOffset = $header.offset().top;

			if( stickyType == 'none' ) {
				return;
			}

			if( offset === 0 && headerOffset === 0 ) {
				$header.addClass('grve-fixed');
			}

			if( scroll > headerOffset ) {
				if( !$header.hasClass('grve-fixed') ){
					$header.addClass('grve-fixed');
				}
				$header.addClass('grve-sticky-header');
				$header.addClass( 'grve-' + stickyType );
			} else {
				$header.removeClass( 'grve-' + stickyType );
				$header.removeClass('grve-sticky-header');
				if( headerOffset > 0 ){
					$header.removeClass('grve-fixed');
				}
			}

			var scrollOffset = 300;
			if( $('#grve-feature-section').length ) {
				scrollOffset = $('#grve-feature-section').height();
			}

			if( stickyType == 'advanced' && scroll > scrollOffset - $mainHeader.height() ) {
				var scrollDir = GRVE.scrollDir.init();
				if( scrollDir.direction == 'scrollDown'  ) {
					$header.addClass('hide');
				} else {
					$header.removeClass('hide');
				}
			}

		},
		stickyDevices: function(){

			if( !$('#grve-header').length > 0 ) {
				return;
			}

			var $header      = $('#grve-header'),
				$resHeader   = $('#grve-responsive-header'),
				stickyType   = $header.data('sticky'),
				stickyDevice = $header.data('devices-sticky'),
				scroll       = $(window).scrollTop(),
				topBarHeight = $('#grve-top-bar').length ? $('#grve-top-bar').height() : 0,
				offset       = topBarHeight + wpBarHeight,
				headerHeight = $header.height(),
				headerOffset = $resHeader.offset().top;

			if( stickyType == 'none' || !$header.length > 0 ) {
				return;
			}

			if( stickyDevice == 'no' && $(window).width() + scrollBarWidth < tabletPortrait ) {
				return;
			}

			if( offset === 0 && headerOffset === 0 ) {
				$resHeader.addClass('grve-fixed');
			}

			if( scroll > headerOffset ) {
				if( !$resHeader.hasClass('grve-fixed') ){
					$resHeader.addClass('grve-fixed');
				}
			} else {
				if( headerOffset > 0 ){
					$resHeader.removeClass('grve-fixed');
				}
			}

		}
	};
	// # Main Menu
	// ============================================================================= //
	GRVE.mainMenu = {
		init: function(){
			this.mainMenu();
		},
		mainMenu: function(){
			var $menu = $('#grve-main-menu.grve-horizontal-menu'),
				$item = $menu.find('li.menu-item'),
				$menuItem = $menu.find('li.menu-item-has-children'),
				target = '.menu-item-has-children',
				subMenu = '.sub-menu',
				mTimer;

			$menu
				.on('mouseenter', target, over)
				.on('mouseleave', target, out);

			function over(){
				var $this = $(this);
				if ($this.prop('hoverTimeout')) {
					$this.prop('hoverTimeout', clearTimeout($this.prop('hoverTimeout')));
				}
				$this.prop('hoverIntent', setTimeout(function() {
					$this.addClass('mHover');
					menuPosition( $this );
				}, 100));
			}
			function out(){
				var $this = $(this);
				if ($this.prop('hoverIntent')) {
					$this.prop('hoverIntent', clearTimeout($this.prop('hoverIntent')));
				}

				$this.prop('hoverTimeout', setTimeout(function() {
					$this.removeClass('mHover');
				}, 100));
			}

			if( isMobile.any() && $(window).width() > tabletPortrait ) {

				$menuItem.find(' > a').bind('touchstart touchend', function(e) {
					var $this = $(this);
					menuPosition( $this );
					$this.parent().siblings().removeClass('mHover');
					if( $this.attr('href') != '#' || $this.attr('href') === '#' ) {
						if( !$this.parent().hasClass('mHover') ) {
							e.preventDefault();
							$this.parent().addClass('mHover');
						}
					}

				});

				$(document).bind('touchstart touchend', function(e) {
					if ( !$menuItem.is(e.target) && $menuItem.has(e.target).length === 0 ) {
						$menuItem.removeClass('mHover').find('li').removeClass('mHover');
					}
				});

			}

			function menuPosition(item){
				var $item = item,
					$subMenu = $item.find(' > ul '),
					subMenuW = $subMenu.width(),
					subMenuP = $subMenu.offset().left,
					windowWidth = $(window).width();

				if ( (subMenuW + subMenuP) > windowWidth ) {
					$subMenu.addClass('grve-position-right');
				}
			}
		}
	}

	// # Menu Slide or Toggle
	// ============================================================================= //
	GRVE.slideToggleMenu = {

		init: function( parrent, element ){

			if( !$(element).length ) return;

			var $menu       = $(element),
				$menuParent = $(parrent),
				$menuItem   = $menu.find('li.menu-item-has-children > a'),
				menuType    = $menuParent.hasClass('grve-slide-menu') ? 'slide' : 'toggle',
				$arrow      = $('<i class="grve-arrow"></i>'),
				$goBack     = $('<li class="grve-goback"><a href="#"></a></li>');

			// Add Arrows
			$arrow.appendTo( $menuItem );

			if( menuType === 'slide' ) {
				// Add Go Back Button for Slide Menu
				$goBack.prependTo( $menuItem.parent().find('>ul') );
			}

			$menuItem.on('tap click',function(e){
				var $this = $(this),
					link  = $this.attr('href'),
					open  = false;

				if((link != '#' || link === '#') && menuType == 'toggle' ) {
					if( !$this.parent().hasClass('open') && !open ) {
						e.preventDefault();
						$this.parent().addClass('open');
						toggle( $this, open );
					} else {
						open = true;
						toggle( $this, open );
						$this.parent().removeClass('open');
					}
				} else {
					e.preventDefault();
					var listLevel  = $this.parents('ul').length,
						$firstItem = $this.parent().find('ul').first(),
						menuOffset = $menu.offset().top,
						offset     = $this.offset().top,
						title      = $this.html();

						appendTitle( title, $firstItem );

					$firstItem.addClass('show').css({ 'top' : - ( offset - menuOffset ) });
					var firstItemH = $firstItem.outerHeight();
					animLeftMenu( firstItemH, listLevel );
				}
			});

			$('li.grve-goback a').on('click', function(e) {
				var listLevel  = $(this).parents('ul ul').length - 1,
					$firstItem = $(this).closest('.sub-menu'),
					firstItemH = $firstItem.closest('.menu-item-has-children').closest('ul').height();

				setTimeout(function(){
					$firstItem.removeClass('show');
				},300);
				animLeftMenu( firstItemH, listLevel );
			});

			function toggle( $this, open ){
				var $subMenu = $this.parent().find('>ul');
				if( open ) {
					$subMenu.slideUp(200);
				} else {
					$subMenu.slideDown(200);
				}
			}

			function animLeftMenu( height, listLevel ) {
				$menu.parent().height(height);
				$menu.css('transform', 'translate3d(' + - listLevel * 100 + '%,0,0)');
			}

			function appendTitle( title, list ){
				if( list.find('.grve-goback .grve-item').length ) return;
				$(title).appendTo( list.find('> .grve-goback a') );
			}
		}

	};


	// # Set Feature Section Size
	// ============================================================================= //
	GRVE.featureSize = {
		init: function( section ){

			var featureHeight;

			if( $(section).hasClass('grve-fullscreen') ) {
				featureHeight = fullscreen();
			} else {
				featureHeight = customSize();
			}

			function fullscreen(){
				var windowHeight  = $(window).height(),
					headerHeight  = 0,
					topBarHeight  = $('#grve-top-bar').length ? $('#grve-top-bar').outerHeight() : 0;

				if( $('#grve-responsive-header').is(':visible') ) {
					if( !$('#grve-header').hasClass('grve-responsive-overlapping') ){
						headerHeight = $('#grve-responsive-header').outerHeight();
					}
				} else if ( !$('#grve-header').hasClass('grve-overlapping') && !$('#grve-theme-wrapper').hasClass('grve-header-side') ){
					headerHeight = $('#grve-main-header').outerHeight();
				}

				var sectionHeight = windowHeight - headerHeight - topBarHeight;

				$(section).find('.grve-wrapper').css( 'height', sectionHeight);

				return sectionHeight;
			}

			function customSize(){

				var initWidth  = tabletLandscape,
					initHeight = $(section).data('height'),
					minHeight  = parseInt( $(section).find('.grve-wrapper').css('min-height') ),
					newSize    = calSize( initWidth, initHeight );

				if( $(window).width() + scrollBarWidth >= initWidth ) {
					$(section).find('.grve-wrapper').css({ 'height': initHeight });
					return initHeight;
				} else {
					$(section).find('.grve-wrapper').css({ 'height': newSize.newHeight });
					if( newSize.newHeight < minHeight ){
						return minHeight
					} else {
						return newSize.newHeight;
					}
				}

				function calSize( initWidth, initHeight ){
					var ratio     = initHeight / initWidth,
						height    = $(window).width() * ratio;

					return {
						newHeight : parseInt(height)
					}
				}
			}

			return featureHeight;
		}
	};

	// # Feature Section
	// ============================================================================= //
	GRVE.featureSection = {

		animate: false,

		init: function( settings ){

			GRVE.featureSection.config = {
				section : '#grve-feature-section',
			},
			// allow overriding the default config
			$.extend(GRVE.featureSection.config, settings);

			var section = GRVE.featureSection.config.section;

			if( $(section).find('.grve-bg-image').length > 0 ) {
				loadFeatureImage();

				// Add Spinner
				if( addFeatureSpinner ) {
					GRVE.featureSection.addSpinner( section );
				}

			} else if( !$(section).find('.grve-bg-image').length > 0 && $(section).find('.grve-bg-video').length > 0 ){
				// Add Spinner
				if( addFeatureSpinner ) {
					GRVE.featureSection.addSpinner( section );
				}
			}else {
				GRVE.featureAnim.startAnim( $(section) );
			}

			function loadFeatureImage(){
				var $bgImage     = $(section).find('.grve-bg-image'),
					totalBgImage = $bgImage.length;

				var waitImgDone = function() {
					totalBgImage--;
					if (!totalBgImage) {

						if( $(section).hasClass('grve-with-slider') ) {

							// Feature Slider Init
							GRVE.featureSection.featureSlider();

						} else {
							// Remove Spinner
							if( addFeatureSpinner ) {
								setTimeout(function () {
									GRVE.featureSection.removeSpinner( section );
								}, 600);
							} else {
								GRVE.featureSection.showFeature( section );
							}
						}

					}
				};

				$bgImage.each(function () {
					function imageUrl(input) {
						return input.replace(/"/g,"").replace(/url\(|\)$/ig, "");
					}
					var image = new Image(),
						$that = $(this);
					image.src = imageUrl($that.css('background-image'));
					$(image).load(waitImgDone).error(waitImgDone);
				});
			}
		},
		addSpinner: function( section ){
			$(spinner).appendTo( $(section) );
			$(section).addClass('grve-with-spinner');
		},
		removeSpinner: function( section ){
			var $spinner  = $(section).find('.grve-spinner');
			$spinner.fadeOut(900,function(){
				$spinner.remove();
				GRVE.featureSection.showFeature( section );
			});
		},
		showFeature: function( section ){
			var $section   = $(section),
				$overlay   = $section.find('.grve-bg-overlay'),
				$content   = $section.find('.grve-content'),
				$bgImage   = $section.find('.grve-bg-image'),
				$bgVideo   = $section.find('.grve-bg-video');

				$bgImage.addClass('show');
				$bgVideo.addClass('show');
				$overlay.addClass('show');

				if( $section.hasClass('grve-with-slider') ) {
					GRVE.featureSection.animate = true;
				}
				GRVE.featureAnim.startAnim( $section );

		},
		featureSlider: function(){

			var $slider         = $('#grve-feature-slider'),
				pauseHover      = $slider.attr('data-slider-pause') == 'yes' ? true : '',
				sliderSpeed     = parseInt( $slider.attr('data-slider-speed') ) ? parseInt( $slider.attr('data-slider-speed') ) : 6000,
				transition      = $slider.attr('data-slider-transition') != 'slide' ? $slider.attr('data-slider-transition') : false,
				slidersLength   = $slider.find('.grve-slider-item ').length,
				autoHeight      = false;

				if( $(window).width() + scrollBarWidth <= mobileScreen ) {
					autoHeight = true;
				}

			customNav( $slider );

			// Init Slider
			$slider.owlCarousel({
				navigation      : false,
				pagination      : false,
				autoHeight      : autoHeight,
				slideSpeed      : 800,
				paginationSpeed : 800,
				afterAction     : sliderAction,
				singleItem      : true,
				autoPlay        : true,
				stopOnHover     : pauseHover,
				baseClass       : 'grve-slider',
				theme           : 'grve-theme',
				transitionStyle : transition
			});

			// Remove Spinner
			if( addFeatureSpinner ) {
				setTimeout(function () {
					GRVE.featureSection.removeSpinner( '#grve-feature-section' );
					$slider.trigger('owl.play',sliderSpeed);//Play Carousel
				}, 600);
			} else {
				GRVE.featureSection.showFeature( '#grve-feature-section' );
			}

			// Slider Navigation
			function customNav( element ){
				var $navWrapper = element.parent(),
					$navNext    = $navWrapper.find('.grve-carousel-next'),
					$navPrev    = $navWrapper.find('.grve-carousel-prev');

				$navNext.click(function(){
					element.trigger('owl.next');
				});
				$navPrev.click(function(){
					element.trigger('owl.prev');
				});

			}

			function sliderAction(){

				var curItem            = this.currentItem,
					preItem            = this.prevItem,
					$currentSlide      = this.$owlItems.eq( curItem ),
					$prevSlide         = this.$owlItems.eq( preItem ),
					$currentSliderItem = $currentSlide.find('.grve-slider-item'),
					sliderColor        = $currentSliderItem.attr('data-header-color'),
					color              = 'grve-' + sliderColor;

				if( !GRVE.featureSection.animate ) return;

				// Slider Animation
				GRVE.featureAnim.startAnim( $currentSliderItem );

				// Set Header Color
				if( !$('#grve-main-header').hasClass('grve-header-side') ) {
					$('#grve-main-header').removeClass('grve-light grve-dark').addClass(color);
				}

				// Set Navigation Color
				$('#grve-feature-section .grve-carousel-navigation').removeClass('grve-light grve-dark grve-default').addClass(color);
			}

		},
		stopSlider: function(){

			if( !GRVE.featureSection.animate ) return;

			var $scroll     = $(window).scrollTop(),
				$slider     = $('#grve-feature-slider'),
				sliderSpeed = parseInt( $slider.attr('data-slider-speed') ) ? parseInt( $slider.attr('data-slider-speed') ) : 6000;

			if( $scroll > 10 ){
				$slider.trigger('owl.stop');//Stop Carousel
			} else {
				$slider.trigger('owl.play',sliderSpeed);//Play Carousel
			}

		}
	};

	// # Resize Video
	// ============================================================================= //
	GRVE.resizeVideo = {
		init: function( $selector ){
			GRVE.resizeVideo.videoSettings( $selector );
			$(window).smartresize(function(){
				GRVE.resizeVideo.videoSettings( $selector );
			});
		},
		videoSettings: function( $selector ){
			var $video          = $selector.find('video'),
				containerWidth  = $selector.parent().outerWidth(),
				containerHeight = $selector.parent().outerHeight(),
				ratio           = 16 / 9,
				videoHeight     = containerHeight,
				videoWidth      = containerHeight * ratio;

				if( videoWidth < containerWidth ) {
					videoWidth   = containerWidth,
					videoHeight  = containerWidth * ratio;
				}

			$video.width( videoWidth ).height( videoHeight );

			if( $selector.parent().is( $('#grve-feature-section') ) ){
				// Remove Spinner
				if( addFeatureSpinner ) {
					setTimeout(function () {
						GRVE.featureSection.removeSpinner( '#grve-feature-section' );
					}, 600);
				} else {
					GRVE.featureSection.showFeature( '#grve-feature-section' );
				}
			}
		}
	};

	// # Feature Content Animations
	// ============================================================================= //
	GRVE.featureAnim = {
		settings: function( $section ){
			var animEffect   = $section.find('.grve-content').data('animation'),
				animDelay    = 200,
				contentItems = {
					graphic     : $section.find(' .grve-graphic '),
					subheading  : $section.find(' .grve-subheading '),
					title       : $section.find(' .grve-title '),
					description : $section.find(' .grve-description '),
					button1     : $section.find(' .grve-btn-1 '),
					button2     : $section.find(' .grve-btn-2 ')
				};

			return { items: contentItems, effect: animEffect, delay: animDelay };
		},
		startAnim: function( section ){

			var $section = section,
				settings = GRVE.featureAnim.settings( $section ),
				items    = settings.items,
				effect   = settings.effect,
				delay    = settings.delay,
				cnt      = 3;

			$section.find('.grve-content').addClass('show');

			$.each( items, function( key, item ) {
				cnt++;
				$(item).removeClass('animate-fade-in animate-fade-in-up animate-fade-in-down animate-fade-in-left animate-fade-in-right animate-zoom-in animate-zoom-out');

				addAnimClass( effect );
				function addAnimClass( effect ){
					setTimeout(function(){
						var itemClass = 'animate-' + effect;
						$(item).addClass( itemClass );
					},cnt * delay);
				}
			});

		}
	};

	// # Feature Parallax
	// ============================================================================= //
	GRVE.featureParallax = {

		init: function( settings ){

			this.config = {
				section : '#grve-feature-section.grve-bg-parallax',
				threshold : 250,
			},
			// allow overriding the default config
			$.extend(this.config, settings);

			if( !$(this.config.section).length )return;

			var section         = this.config.section,
				sectionLenght   = $(section).length,
				threshold       = this.config.threshold,
				$parallaxEl     = $(section).find('.grve-bg-image'),
				$content        = $(section).find('.grve-content');

			var sectionHeight, elementHeight, sectionTop, speed;

			function updateParam(){
				sectionHeight   = GRVE.featureSize.init( section ),
				elementHeight   = sectionHeight + threshold,
				sectionTop      = $(section).offset().top,
				sectionTop      = $(section).offset().top,
				speed           = ( sectionHeight + sectionTop ) / ( elementHeight - sectionHeight );
			}

			function update(){
				var windowScroll = $(window).scrollTop(),
					windowHeight = $(window).height();

				if(  sectionTop - windowScroll <= windowHeight && sectionTop - windowScroll + windowHeight >= windowHeight - sectionHeight  ) {
					var translate = ( windowScroll )/speed;
				} else {
					translate = 0;
				}
				var transform = 'translateY(' + - translate + 'px)',
					opacity   = 1- (2 * windowScroll / elementHeight);


				$parallaxEl.css({
					'height' : elementHeight,
					'-webkit-transform' : transform,
					'-moz-transform'    : transform,
					'-ms-transform'     : transform,
					'-o-transform'      : transform,
					'transform'         : transform
				});

				$content.css({
					'opacity' : opacity
				});
			}

			updateParam();
			update();
			$(window).on('scroll', function(){
				update();
			});

			if( isMobile.any() ) {
				$(window).on("orientationchange",function(){
					updateParam();
					update();
				});
			} else {
				$(window).smartresize(function(){
					updateParam();
					update();
				});
			}
		}
	};

	// # Page Settings
	// ============================================================================= //
	GRVE.pageSettings = {

		init: function(){
			this.grveModal();
			this.gotoFirstSection();
			this.bgLoader();
			this.imageLoader();
			this.fitVid();
			this.hiddenArea();
			this.backtoTop();
			this.animatedBg();
			this.hovers();
			this.onePageSettings();
			this.shoppingCart();
			this.anchorBar();
			this.socialShareLinks();
			this.lightBox();
		},
		bodyLoader: function(){
			var $overflow = $('#grve-loader-overflow'),
				$loader   = $('.grve-spinner');

			if( $overflow.length > 0 ){
				bodyLoader = true;
			} else {
				return;
			}

			var images = $('img, .grve-bg-image');
			$.each(images, function(){
				var el = $(this),
				image = el.css('background-image').replace(/"/g, '').replace(/url\(|\)$/ig, '');
				if(image && image !== '' && image !== 'none')
					images = images.add($('<img>').attr('src', image));
				if(el.is('img'))
					images = images.add(el);
			});

			images.imagesLoaded(function(){
				setTimeout(function () {
					$loader.fadeOut(500);
					$overflow.delay(500).fadeOut(700,function(){
						bodyLoader = false;
						GRVE.basicElements.animAppear();
						GRVE.basicElements.counter();
					});
				}, 600);
			});

		},
		removeVideoBg: function(){
			var videoBg = $('.grve-bg-video');
			if( isMobile.any() ) {
				videoBg.remove();
			} else {
				$('.grve-background-wrapper').each(function () {
					var bgImage = $(this).find('.grve-bg-image');
					var bgVideo = $(this).find('.grve-bg-video');
					if ( bgVideo.length ) {
						var videoElement = $(this).find('.grve-bg-video video');
						var canPlayVideo = false;
						$(this).find('.grve-bg-video source').each(function(){
							if ( videoElement.get(0).canPlayType( $(this).attr('type') ) ) {
								canPlayVideo = true;
							}
						});
						if(canPlayVideo) {
							bgImage.remove();
							// Resize Video
							GRVE.resizeVideo.init( $(this) );
						} else {
							bgVideo.remove();
						}
					}
				});
			}
		},
		grveModal: function(){

			var $button       = $('.grve-toggle-modal'),
				$overlay      = $('<div id="grve-modal-overlay" class="grve-body-overlay"></div>'),
				$closeBtn     = $('<div class="grve-close-btn grve-close-modal grve-close-line"><span></span><span></span></div>'),
				$themeWrapper = $('#grve-theme-wrapper'),
				content;

			$button.on('click',function(e){
				content = $(this).attr('href');
				if( content.indexOf("#") === 0 && $(content).length > 0 ) {
					e.preventDefault();

					// Append Overlay on body
					$overlay.appendTo( $themeWrapper );
					$closeBtn.appendTo( $(content) );

					$(content).addClass('prepare-anim');

					openModal();

					$closeBtn.on('click',function(e){
						e.preventDefault();
						closeModal();
					});

					$(content).on('click',function(e){
						if ( !$('.grve-modal-item').is(e.target) && $('.grve-modal-item').has(e.target).length === 0 ) {
							e.preventDefault();
							closeModal();
						}
					});
				}
			});

			// Open Modal
			function openModal() {
				$overlay.fadeIn(function(){
					$(content).addClass('animate');
				});
			}

			// Close Modal
			function closeModal() {
				$(content).removeClass('animate mobile');
				setTimeout(function(){
					$overlay.fadeOut(function(){
						$(content).removeClass('prepare-anim');
						$overlay.remove();
						$closeBtn.remove();
					})
				},600);
			}

			$(document).on('keyup',function(evt) {
				if (evt.keyCode == 27 && $(content).hasClass('animate') ) {
					closeModal();
				}
			});

		},
		gotoFirstSection: function(){
			var headerHeight    = $('#grve-header').data('sticky') != 'none' ? $('#grve-main-header').height() : 0,
				anchorBarHeight = $('.grve-anchor-menu').length ? $('.grve-anchor-menu').outerHeight() : 0,
				$selector    = $('#grve-feature-section #grve-goto-section'),
				$nextSection = $('#grve-content');

			$selector.on('click',function(){
				if ( $nextSection.length ) {
					$('html,body').animate({
						scrollTop: $nextSection.offset().top - headerHeight - anchorBarHeight + 1
					}, 1000);
					return false;
				}
			});
		},
		bgLoader: function() {

			var $selector = $('#grve-header .grve-bg-image, #grve-content .grve-bg-image, #grve-footer .grve-bg-image, #grve-related-post .grve-bg-image');
			$selector.each(function () {
				var $selector = $(this);
				if( $selector.data('loader') == 'yes' ){
					GRVE.pageSettings.addSpinner( $selector );
				}
				function imageUrl(input) {
					return input.replace(/"/g,"").replace(/url\(|\)$/ig, "");
				}
				var image = new Image(),
					$that = $(this);
				image.src = imageUrl($that.css('background-image'));
				image.onload = function () {
					if( $selector.data('loader') == 'yes' ){
						GRVE.pageSettings.removeSpinner( $selector );
					} else {
						$that.addClass('show');
					}
				};
			});
		},
		imageLoader: function(){
			var selectors  = {
				singleImage  : '.grve-image',
				media        : '.grve-media'
			};
			$.each(selectors, function(key, value){
				if( $(this).length ){
					var item     = $(this),
						imgLoad  = imagesLoaded( item );
					imgLoad.on( 'always', function() {
						$(value).find('img').animate({ 'opacity': 1 },1000);
					});
				}
			});
		},
		addSpinner: function( $selector ){
			var $section = $selector;
			$(spinner).appendTo( $section.parent() );
		},
		removeSpinner: function( $selector ){

			var $section   = $selector.parent(),
				$spinner   = $section.find('.grve-spinner');

			$spinner.fadeOut(600,function(){
				$selector.addClass('show');
				$spinner.remove();
			});
		},
		fitVid: function(){
			$('.grve-video, .grve-media').fitVids();
		},
		stickySidebar: function(){

			var $item    = $('#grve-sidebar.grve-fixed-sidebar'),
				$content = $('#grve-main-content');
			if( !$item.length ) {
				return;
			}
			var $itemWrapper    = $item.find('.grve-wrapper'),
				itemHeight      = $itemWrapper.outerHeight() + 80,
				itemWidth       = $item.outerWidth() - 1,
				headerHeight    = $('#grve-header').data('sticky') != 'none' ? $('#grve-main-header').outerHeight() : 0,
				anchorBarHeight = $('.grve-anchor-menu').length ? $('.grve-anchor-menu').outerHeight() : 0,
				offset          = headerHeight + anchorBarHeight + 80,
				windowHeight    = $(window).height();
			if( itemHeight > windowHeight ) {
				$itemWrapper.css({'position':'static', 'top':'auto' });
				return false;
			}

			if( ( isMobile.any() && !mobstickySidebar ) || $(window).width() + scrollBarWidth < tabletPortrait ) {
				$itemWrapper.css({'position':'', 'top': '', 'width' : '' });
				return;
			}

			var contentHeight = $content.outerHeight(),
				contentTop    = $content.offset().top,
				contentBottom = contentTop + contentHeight,
				initTop       = $item.css('top') != 'auto' ? parseInt($item.css('top')) : 0;

			if( ( $(window).scrollTop() > contentTop - offset + 80 ) && ( $(window).scrollTop() < contentBottom - ( offset + itemHeight ) )){
				$itemWrapper.css({'position':'fixed', 'width' : itemWidth, 'top': offset });
			}
			else if( $(window).scrollTop() > contentTop ){
				$itemWrapper.css({'position':'absolute', 'top': contentHeight - itemHeight - initTop });
			}
			else if( $(window).scrollTop() < contentTop + 80 ){
				$itemWrapper.css({'position':'static', 'top':'auto' });
			}
		},
		hiddenArea: function( section, btn ){
			var $btn          = $('.grve-toggle-hiddenarea'),
				$themeWrapper = $('#grve-theme-wrapper'),
				$closeBtn     = $('.grve-hidden-area').find('.grve-close-btn'),
				areaWidth     = 0,
				content,
				$overlay;

			// if( !$(content).length > 0 ) return;

			$btn.on('click',function(e){
				content = $(this).attr('href');
				if( content.indexOf("#") === 0 && $(content).length > 0 ) {
					e.preventDefault();
					var overlayId = content.replace('#','');

					$(content).addClass('prepare-anim');
					$overlay = $('<div id="' + overlayId + '-overlay" class="grve-body-overlay"></div>');

					// Append Overlay on body
					$overlay.appendTo( $themeWrapper );

					// Calculate Width
					areaWidth = hiddenAreaWidth( content );
					$(window).smartresize(function(){
						areaWidth = hiddenAreaWidth( content );
					});

					if( $(content).hasClass('open') ) {
						closeHiddenArea();
					} else {
						openHiddenArea();
					}

					// For One Page
					var $link = $(content).find('a[href*="#"]:not( [href="#"] )');
					$link.on('click',function(){
						var target = $(this.hash);
						if ( target.length && ( target.hasClass('grve-section') || target.hasClass('grve-bookmark') ) ) {
							closeHiddenArea();
						}
					});

				}
			});

			$closeBtn.on('click',function(){
				closeHiddenArea();
			});

			// Open Hidden Area
			function openHiddenArea() {
				$overlay.fadeIn(function(){
					$('body').scrollTop( 0 );
					$(content).addClass('open');
					$(this).on('click',function(){
						closeHiddenArea();
					});
				});
			}
			// Close Hidden Area
			function closeHiddenArea() {
				$themeWrapper.css({ 'height' : 'auto' });
				$(content).removeClass('open');
				$overlay.fadeOut(function(){
					$overlay.remove();
					$(content).removeClass('prepare-anim');
				});
			}

			// Calculate Area Width
			function hiddenAreaWidth( area ){
				var windowWidth  = $(window).width(),
					areaWidth    = windowWidth / 4,
					minWidth     = 500;
				if( $(window).width() + scrollBarWidth <= mobileScreen ) {
					areaWidth = windowWidth + 30;
				} else if( areaWidth < minWidth ) {
					areaWidth = minWidth;
				}

				$(area).css({ 'width' : areaWidth });
				return areaWidth;
			}

		},
		hiddenAreaHeight: function( area ){
			if( !$(area).length > 0 ) return;

			var windowWidth      = $(window).width(),
				windowHeight     = $(window).height(),
				hiddenAreaHeight = $(area).find('.grve-hiddenarea-content').outerHeight() + 200,
				$themeWrapper    = $('#grve-theme-wrapper'),
				$scroller        = $(area).find('.grve-scroller'),
				$buttonWrapper   = $(area).find('.grve-buttons-wrapper'),
				btnWrapperHeight = $buttonWrapper.length ? $buttonWrapper.height() : 0,
				sideHeight       = 0;

			if( hiddenAreaHeight > windowHeight ){
				sideHeight = hiddenAreaHeight;
			} else {
				sideHeight = windowHeight;
			}

			if( $(window).width() + scrollBarWidth <= mobileScreen ) {
				$scroller.css({ 'height' : 'auto' });
				$(area).css({ 'position' : 'absolute','height' : sideHeight });
				$themeWrapper.css({ 'height' : sideHeight, 'overflow' : 'hidden' });
			} else {
				$scroller.css({ 'height' : windowHeight - btnWrapperHeight - 150 });
				$themeWrapper.css({ 'height' : '', 'overflow' : '' });
			}
		},
		backtoTop: function() {


			var selectors  = {
				topBtn     : '.grve-back-top',
				dividerBtn : '.grve-divider-backtotop',
				topLink    : 'a[href="#grve-goto-header"]'
				},
				footerBarHeight = $('.grve-footer-bar').length ? $('.grve-footer-bar').outerHeight() : 0;

				if( $( selectors.topBtn ).length ) {

					$(window).on('scroll', function() {
						var scroll = $(this).scrollTop(),
							$topBtn = $( selectors.topBtn );

						if (scroll > 600) {
							$topBtn.addClass('show');
						} else {
							$topBtn.removeClass('show');
						}
						if( scroll + $(window).height() > $(document).height() - footerBarHeight ) {
							$topBtn.css({ 'transform': 'translate(0, ' + -( footerBarHeight + 70 ) + 'px)' });
						} else {
							$topBtn.css({ 'transform': '' });
						}
					});
				}


			$.each(selectors, function(key, value){
				$(value).on('click', function(e){
					e.preventDefault();
					$('html, body').animate({scrollTop: 0}, 900);
				});
			});

		},
		animatedBg: function(){
			var $section = $('.grve-section');

			$section.each(function(){
				var $this = $(this);

				if( $this.hasClass('grve-bg-animated') ) {
					zoomBg( $this );
				} else if( $this.hasClass('grve-bg-horizontal') ) {
					horizontalBg( $this );
				}
			});

			function zoomBg( $this ){
				$this.mouseenter(function() {
					$this.addClass('zoom');
				});
				$this.mouseleave(function() {
					$this.removeClass('zoom');
				});
			}

			function horizontalBg( $this ){
				var bgPosition = 0;
				setInterval(function(){
					bgPosition++;
					$this.find('.grve-bg-image').css({ 'background-position' : bgPosition+'px center', 'background-repeat' : 'repeat' });
				},75);
			}
		},
		hovers: function(){
			var $hoverItem = $('.grve-image-hover');
			if ( !isMobile.any() ) {
				$hoverItem.unbind('click');
				$hoverItem.unbind('mouseenter mouseleave').bind('mouseenter mouseleave', function() {
					$(this).toggleClass('hover');
				});
			} else {
				var touchevent = 'touchend';
				if( $hoverItem.parent().parent().hasClass('grve-carousel-item') ) {
					touchevent = 'touchstart';
				}
				$hoverItem.on(touchevent, function(e) {
					var $item = $(this);
					if ( $item.hasClass('hover') || !deviceDoubleTap ) {
						return true;
					} else {
						$item.addClass('hover');
						$hoverItem.not(this).removeClass('hover');
						e.preventDefault();
						return false;
					}
				});
				$(document).on('touchstart touchend', function(e) {
					if ( !$hoverItem.is(e.target) && $hoverItem.has(e.target).length === 0 ) {
						$hoverItem.removeClass('hover');
					}
				});
			}
		},
		shrinkHeaderHeight : function(){
			var headerHeight = 0,
				stickyType      = $('#grve-header').data('sticky'),
				diviceSticky    = $('#grve-header').data('devices-sticky');

			if( stickyType != 'none' && $(window).width() + scrollBarWidth > tabletPortrait && $('#grve-header').length > 0 ){
				if( stickyType == 'simple' ) {
					headerHeight = $('#grve-main-header').height();
				}
				if( stickyType == 'advanced' ) {
					headerHeight = 0;
				}
				if( stickyType == 'shrink' ) {
					headerHeight = $('#grve-header').data('sticky-height');
				}
			}

			if( diviceSticky == 'yes' && $(window).width() + scrollBarWidth < tabletPortrait && $('#grve-header').length > 0 ){
				headerHeight = $('#grve-responsive-header').height();
			}

			return headerHeight;
		},
		onePageSettings: function(){
			$('a[href*="#"]:not( [href="#"] )').click(function(e) {
				var headerHeight    = GRVE.pageSettings.shrinkHeaderHeight(),
					anchorBarHeight = $('.grve-anchor-menu').length ? $('.grve-anchor-menu').outerHeight() : 0,
					target          = $(this.hash);

				if ( target.length && ( target.hasClass('grve-section') || target.hasClass('grve-bookmark') ) ) {
					$('html,body').animate({
						scrollTop: target.offset().top - headerHeight - anchorBarHeight + 2
					}, 1000);
					return false;
				}
			});
		},
		onePageMenu: function(){
			var $section       = $('#grve-main-content .grve-section[id]');
			if (!$section.length > 0 ) return;

			var headerHeight   = GRVE.pageSettings.shrinkHeaderHeight(),
				anchorBarHeight = $('.grve-anchor-menu').length ? $('.grve-anchor-menu').outerHeight() : 0,
				offsetTop      = headerHeight + anchorBarHeight + wpBarHeight,
				scroll         = $(window).scrollTop();

			$section.each(function(){
				var $that         = $(this),
					currentId     = $that.attr('id'),
					sectionOffset = $that.offset().top - offsetTop;

				if (sectionOffset <= scroll && sectionOffset + $that.outerHeight() > scroll ) {
					$('a[href*="#' + currentId + '"]').parent().addClass('active');
				}
				else{
					$('a[href*="#' + currentId + '"]').parent().removeClass("active");
				}

			});
		},
		anchorSticky: function(){
			var $anchor  = $('.grve-anchor-menu'),
				$section = $('#grve-main-content .grve-section[id]');

			if( !$anchor.length > 0 || $(window).width() + scrollBarWidth <= tabletPortrait ) return;

			var $anchorWrapper = $anchor.find('.grve-anchor-wrapper'),
				headerHeight   = $('#grve-header').data('sticky') != 'none' ? $('#grve-main-header').height() : 0,
				anchorTop      = $anchor.offset().top,
				offset         = anchorTop - headerHeight,
				scroll         = $(window).scrollTop();

			if ( scroll >= offset ) {
				$anchorWrapper.addClass('grve-sticky').css({ 'top' : headerHeight });
			} else {
				$anchorWrapper.removeClass('grve-sticky').css({ 'top' : '' });
			}

			function findActive() {
				$section.each(function(){
					var actual = $(this),
						actualHeight = actual.outerHeight(),
						actualAnchor = $anchor.find('a[href="#'+actual.attr('id')+'"]').parent();
					if ( ( actual.offset().top - $anchor.height() <= $(window).scrollTop() ) && ( actual.offset().top + actualHeight - $anchor.height() > $(window).scrollTop() ) ) {
						actualAnchor.addClass('active');
					}else {
						actualAnchor.removeClass('active');
					}
				});
			}

		},
		anchorBar: function(){

			var $anchorBar  = $('.grve-anchor-menu'),
				$anchorMenu = $anchorBar.find('.grve-container > ul '),
				$menuItem   = $anchorBar.find('li.menu-item-has-children > a'),
				$anchorBtn  = $anchorBar.find('.grve-anchor-btn'),
				$arrow      = $('<i class="grve-arrow"></i>');

			// Add Arrows
			$arrow.appendTo( $menuItem );

			$menuItem.each(function(){
				var $that    = $(this),
					$parent  = $that.parent(),
					$subMenu = $parent.find(' > ul'),
					link     = $that.attr('href'),
					$item    = $that;

				if( link != '#') {
					$item = $that.find('.grve-arrow')
				}

				$item.on('tap click', function(e){
					e.preventDefault();
					$parent.toggleClass('open');

					if( $subMenu.is(':visible') ) {
						$subMenu.slideUp(200);
					} else {
						$subMenu.slideDown(200);
					}
				});
			});

			$anchorBtn.on('tap click', function(e){
				e.preventDefault();
				if( $anchorMenu.is(':visible') ) {
					$anchorMenu.slideUp(200);
				} else {
					$anchorMenu.slideDown(200);
				}
			});

			$(window).smartresize(function(){
				// Reset Sub Menu Style Style
				if( $(window).width() + scrollBarWidth > tabletPortrait ) {
					$anchorBar.find('ul.sub-menu').removeAttr('style').parent().removeClass('open');
					$anchorMenu.removeAttr('style');
					$('.grve-anchor-wrapper').removeClass('grve-sticky').removeAttr('style');
				}
			});

		},
		fixedFooter: function(){
			var $footer      = $('#grve-footer'),
				sticky       = $footer.data('sticky-footer'),
				prevSection  = $footer.prev(),
				prevMargin   = parseInt( prevSection.css('margin-bottom') );

			if( !$footer.length || sticky != 'yes' || isMobile.any() ) return;

			update()
			$(window).smartresize(function(){
				update();
			});

			function update(){
				var windowHeight = $(window).height(),
					footerHeight = $footer.outerHeight(),
					margin       = footerHeight + prevMargin;

				if( footerHeight > windowHeight ) {
					$footer.removeClass('grve-fixed-footer').prev().css( 'margin-bottom',0 );
				} else {
					$footer.addClass('grve-fixed-footer').prev().css( 'margin-bottom',margin );
				}

			}

		},
		shoppingCart: function(){
			var $button = $('.grve-toggle-cart'),
				$cart = $('.grve-shoppin-cart-content'),
				$cartList = $cart.find('.cart_list'),
				timer;

			$button.on('mouseover',function(){
				clearTimeout(timer);
				openCart();
			});

			$button.on('mouseout',function(){
				closeCart();
			});

			$cart.on('mouseover',function(){
				clearTimeout(timer);
			});

			$cart.on('mouseout',function(){
				closeCart();
			});

			function openCart(){
				$cart.addClass('open');
			}

			function closeCart(){
				timer = setTimeout(function(){
					$cart.removeClass('open');
				}, 300);
			}
		},
		lightBox: function(){
			//IMAGE
			$('.grve-image-popup').each(function() {
				$(this).magnificPopup({
					type: 'image',
					preloader: false,
					fixedBgPos: true,
					fixedContentPos: true,
					removalDelay: 200,
					closeMarkup: '<div class="mfp-close grve-close-btn grve-close-modal grve-close-line"></div>',
					closeOnBgClick: true,
					callbacks: {
						beforeOpen: function() {
							var mfpWrap = this.wrap;
							this.bgOverlay.fadeIn(200);
							addSpinner( mfpWrap );
						},
						imageLoadComplete: function() {
							var $spinner = this.wrap.find('.grve-spinner'),
								$content = this.container;
							removeSpinner( $spinner, $content );

						},
						beforeClose: function() {
							this.wrap.fadeOut(100);
							this.bgOverlay.fadeOut(100);
						},
					},
					image: {
						verticalFit: true,
						titleSrc: function(item) {
							var title   = item.el.data( 'title' ) ? item.el.data( 'title' ) : '',
								caption = item.el.data('desc') ? '<br><small>' + item.el.data('desc') + '</small>' : '';
							if ( '' === title ) {
								title   = item.el.find('.grve-title').html() ? item.el.find('.grve-title').html() : '';
							}
							if ( '' === caption ) {
								caption = item.el.find('.grve-caption').html() ? '<br><small>' + item.el.find('.grve-caption').html() + '</small>' : '';
							}
							return title + caption;
						}
					}
				});
			});
			$('.grve-gallery-popup, .grve-post-gallery-popup').each(function() {
				$(this).magnificPopup({
					delegate: 'a',
					type: 'image',
					preloader: false,
					fixedBgPos: true,
					fixedContentPos: true,
					removalDelay: 200,
					closeMarkup: '<div class="mfp-close grve-close-btn grve-close-modal grve-close-line"></div>',
					closeOnBgClick: true,
					callbacks: {
						beforeOpen: function() {
							var mfpWrap = this.wrap;
							this.bgOverlay.fadeIn(200);
							addSpinner( mfpWrap );
						},
						imageLoadComplete: function() {
							var $spinner = this.wrap.find('.grve-spinner'),
								$content = this.container;
							removeSpinner( $spinner, $content );

						},
						beforeClose: function() {
							this.wrap.fadeOut(100);
							this.bgOverlay.fadeOut(100);
						},
					},
					gallery: {
						enabled:true
					},
					image: {
						tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
						titleSrc: function(item) {
							var title   = item.el.data( 'title' ) ? item.el.data( 'title' ) : '',
								caption = item.el.data('desc') ? '<br><small>' + item.el.data('desc') + '</small>' : '';
							if ( '' === title ) {
								title   = item.el.find('.grve-title').html() ? item.el.find('.grve-title').html() : '';
							}
							if ( '' === caption ) {
								caption = item.el.find('.grve-caption').html() ? '<br><small>' + item.el.find('.grve-caption').html() + '</small>' : '';
							}
							return title + caption;
						}
					}
				});
			});

			if( 1 == grve_main_data.grve_wp_gallery_popup ) {
				$('.gallery').each(function() {
					$(this).magnificPopup({
						delegate: 'a',
						type: 'image',
						preloader: false,
						fixedBgPos: true,
						fixedContentPos: true,
						removalDelay: 200,
						closeMarkup: '<div class="mfp-close grve-close-btn grve-close-modal grve-close-line"></div>',
						closeOnBgClick: true,
						callbacks: {
							beforeOpen: function() {
								var mfpWrap = this.wrap;
								this.bgOverlay.fadeIn(200);
								addSpinner( mfpWrap );
							},
							imageLoadComplete: function() {
								var $spinner = this.wrap.find('.grve-spinner'),
									$content = this.container;
								removeSpinner( $spinner, $content );

							},
							beforeClose: function() {
								this.wrap.fadeOut(100);
								this.bgOverlay.fadeOut(100);
							},
						},
						gallery: {
							enabled:true
						},
						image: {
							tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
							titleSrc: function(item) {
								var title   = item.el.closest('.gallery-item').find('.gallery-caption').html() ? item.el.closest('.gallery-item').find('.gallery-caption').html() : '';
								return title;
							}
						}
					});
				});
			}
			//VIDEOS
			$('.grve-youtube-popup, .grve-vimeo-popup, .grve-video-popup, .grve-page-popup').each(function() {
				$(this).magnificPopup({
					disableOn: 0,
					type: 'iframe',
					preloader: false,
					fixedBgPos: true,
					fixedContentPos: true,
					removalDelay: 200,
					closeMarkup: '<div class="mfp-close grve-close-btn grve-close-modal grve-close-line"></div>',
					closeOnBgClick: true,
					callbacks: {
						beforeOpen: function() {
							var mfpWrap = this.wrap;
							this.bgOverlay.fadeIn(200);
							addSpinner( mfpWrap );
						},
						open: function() {
							var $spinner = this.wrap.find('.grve-spinner'),
								$content = this.container;
							removeSpinner( $spinner, $content );
						},
						beforeClose: function() {
							this.wrap.fadeOut(100);
							this.bgOverlay.fadeOut(100);
						},
					}
				});
			});

			function addSpinner( mfpWrap ){
				$(spinner).appendTo( mfpWrap );
			}

			function removeSpinner( spinner, content ){
				setTimeout(function(){
					spinner.fadeOut(1000, function(){
						content.animate({'opacity':1},600);
					});
				}, 700);
			}
		},
		socialShareLinks: function(){
			$('.grve-social-share-facebook').click(function (e) {
				e.preventDefault();
				window.open( 'https://www.facebook.com/sharer/sharer.php?u=' + $(this).attr('href'), "facebookWindow", "height=380,width=660,resizable=0,toolbar=0,menubar=0,status=0,location=0,scrollbars=0" );
				return false;
			});
			$('.grve-social-share-twitter').click(function (e) {
				e.preventDefault();
				window.open( 'http://twitter.com/intent/tweet?text=' + $(this).attr('title') + ' ' + $(this).attr('href'), "twitterWindow", "height=450,width=660,resizable=0,toolbar=0,menubar=0,status=0,location=0,scrollbars=0" );
				return false;
			});
			$('.grve-social-share-linkedin').click(function (e) {
				e.preventDefault();
				window.open( 'http://www.linkedin.com/shareArticle?mini=true&url=' + $(this).attr('href') + '&title=' + $(this).attr('title'), "linkedinWindow", "height=500,width=820,resizable=0,toolbar=0,menubar=0,status=0,location=0,scrollbars=0" );
				return false;
			});
			$('.grve-social-share-googleplus').click(function (e) {
				e.preventDefault();
				window.open( 'https://plus.google.com/share?url=' + $(this).attr('href'), "googleplusWindow", "height=600,width=600,resizable=0,toolbar=0,menubar=0,status=0,location=0,scrollbars=0" );
				return false;
			});
			$('.grve-social-share-pinterest').click(function (e) {
				e.preventDefault();
				window.open( 'http://pinterest.com/pin/create/button/?url=' + $(this).attr('href') + '&media=' + $(this).data('pin-img') + '&description=' + $(this).attr('title'), "pinterestWindow", "height=600,width=600,resizable=0,toolbar=0,menubar=0,status=0,location=0,scrollbars=0" );
				return false;
			});
			$('.grve-social-share-reddit').click(function (e) {
				e.preventDefault();
				window.open( '//www.reddit.com/submit?url=' + $(this).attr('href'), "redditWindow", "height=600,width=820,resizable=0,toolbar=0,menubar=0,status=0,location=0,scrollbars=1" );
				return false;
			});
			$('.grve-like-counter-link').click(function (e) {
				e.preventDefault();
				var link = $(this);
				var id = link.data('post-id'),
					counter = link.parent().find('.grve-like-counter');

				var ajaxurl = grve_main_data.ajaxurl;

				$.ajax({type: 'POST', url: ajaxurl, data: 'action=blade_grve_likes_callback&grve_likes_id=' + id, success: function(response) {
					if ( '-1' != response ) {
						if( 'active' == response.status ){
							link.addClass('active');
						} else {
							link.removeClass('active');
						}
						counter.html(response.likes);
					}
				}});
				return false;
			});
		}
	};

	// # Basic Elements
	// ============================================================================= //
	GRVE.basicElements = {
		init: function(){
			this.pieChart();
			this.progressBars();
			this.counter();
			this.slider();
			this.testimonial();
			this.flexibleCarousel();
			this.carousel();
			this.advancedPromo();
			this.imageText();
			this.messageBox();
			this.wooProduct();
			this.wooProductZoom();
			this.animAppear();
			this.vcAccordion();
			this.vcTab();
			this.productSocials();
			this.countdown();
		},
		pieChart: function(){

			$('.grve-chart-number').each(function() {
				var $element  = $(this),
					delay     = $element.parent().data('delay') !== '' ? parseInt( $element.parent().data('delay') ) : 0,
					size      = $element.data('pie-size'),
					chartSize = '130';
				if( size == 'small' ){
					chartSize = '100';
				}
				if( size == 'large' ){
					chartSize = '160';
				}

				$element.css({ 'width' : chartSize, 'height' : chartSize, 'line-height' : chartSize + 'px' });

				$element.appear(function() {
					setTimeout(function () {
						GRVE.basicElements.pieChartInit( $element, chartSize );
					}, delay);
				});
			});

		},
		pieChartInit: function( $element, size ){

			var activeColor = $element.data('pie-active-color') !== '' ? $element.data('pie-active-color') : 'rgba(0,0,0,1)',
				pieColor    = $element.data('pie-color') !== '' ? $element.data('pie-color') : 'rgba(0,0,0,0.1)',
				pieLineCap  = $element.data('pie-line-cap') !== '' ? $element.data('pie-line-cap') : 'round',
				lineSize    = $element.data('pie-line-size') !== '' ? $element.data('pie-line-size') : '6',
				chartSize   = size;


			$element.easyPieChart({
				barColor: activeColor,
				trackColor: pieColor,
				scaleColor: false,
				lineCap: pieLineCap,
				lineWidth: lineSize,
				animate: 1500,
				size: chartSize
			});
		},
		progressBars: function(){
			var selector = '.grve-progress-bar';
			$(selector).each(function() {
				$(this).appear(function() {

					var val         = $(this).attr('data-value'),
						percentage  = $('<span class="grve-percentage">'+ val + '%'+'</span>');

					$(this).find('.grve-bar-line').animate({ width: val + '%' }, 1600);
					if( $(this).parent().hasClass('grve-style-1') ) {
						percentage.appendTo($(this).find('.grve-bar')).animate({ left: val + '%' }, 1600);
					} else {
						percentage.appendTo($(this).find('.grve-bar-title'));
					}

				});
			});
		},
		counter: function(){
			if( bodyLoader === true ){
				return;
			}
			var selector = '.grve-counter-item span';
			$(selector).each(function(i){
				var elements = $(selector)[i],
					thousandsSeparator = $(this).attr('data-thousands-separator') !== '' ? $(this).attr('data-thousands-separator') : ',';
				$(elements).attr('id','grve-counter-' + i );
				var delay = $(this).parents('.grve-counter').attr('data-delay') !== '' ? parseInt( $(this).parents('.grve-counter').attr('data-delay') ) : 200,
					options = {
						useEasing    : true,
						useGrouping  : true,
						separator    : $(this).attr('data-thousands-separator-vis') !== 'yes' ? thousandsSeparator : '',
						decimal      : $(this).attr('data-decimal-separator') !== '' ? $(this).attr('data-decimal-separator') : '.',
						prefix       : $(this).attr('data-prefix') !== '' ? $(this).attr('data-prefix') : '',
						suffix       : $(this).attr('data-suffix') !== '' ? $(this).attr('data-suffix') : ''
					},
					counter = new CountUp( $(this).attr('id') , $(this).attr('data-start-val'), $(this).attr('data-end-val'), $(this).attr('data-decimal-points'), 2.5, options);
				$(this).appear(function() {
					setTimeout(function () {
						counter.start();
					}, delay);
				});
			});
		},
		slider: function( settings ){

			var $element = $('.grve-slider');

				$element.each(function(){
					var $that = $(this),
						carouselSettings = {
						sliderSpeed     : ( parseInt( $that.attr('data-slider-speed') ) ) ? parseInt( $that.attr('data-slider-speed') ) : 3000,
						paginationSpeed : ( parseInt( $that.attr('data-pagination-speed') ) ) ? parseInt( $that.attr('data-pagination-speed') ) : 400,
						autoHeight      : $that.attr('data-slider-autoheight') == 'yes' ? true : false,
						sliderPause     : $that.attr('data-slider-pause') == 'yes' ? true : false,
						autoPlay        : $that.attr('data-slider-autoplay') != 'no' ? true : false,
						baseClass       : 'grve-carousel',
						pagination      : $that.attr('data-slider-pagination') == 'yes' ? true : false,
					};

					carouselInit( $that, carouselSettings );
					customNav( $that );

				});

			// Init Slider
			function carouselInit( element, settings ){
				element.owlCarousel({
					navigation      : false,
					pagination      : settings.pagination,
					autoHeight      : settings.autoHeight,
					slideSpeed      : settings.paginationSpeed,
					paginationSpeed : settings.paginationSpeed,
					singleItem      : true,
					autoPlay        : settings.autoPlay,
					stopOnHover     : settings.sliderPause,
					baseClass       : 'owl-carousel',
					theme           : 'grve-theme'
				});
				// Carousel Element Speed
				if( settings.autoPlay == true ){
					element.trigger( 'owl.play', settings.sliderSpeed );
				}

				$element.css('visibility','visible');

				// Slider Navigation
				function customNav( element ){
					element.parent().find('.grve-carousel-next').click(function(){
						element.trigger('owl.next');
					});
					element.parent().find('.grve-carousel-prev').click(function(){
						element.trigger('owl.prev');
					});
				}
			}

			function customNav( element ){
				// Carousel Navigation
				element.parent().find('.grve-carousel-next').click(function(){
					element.trigger('owl.next');
				});
				element.parent().find('.grve-carousel-prev').click(function(){
					element.trigger('owl.prev');
				});
			}
		},
		testimonial: function(){

			var $testimonial = $('.grve-testimonial');

			$testimonial.each(function(){
				var $that = $(this),
					carouselSettings = {
						sliderSpeed : ( parseInt( $that.attr('data-slider-speed') ) ) ? parseInt( $that.attr('data-slider-speed') ) : 3000,
						paginationSpeed : ( parseInt( $that.attr('data-pagination-speed') ) ) ? parseInt( $that.attr('data-pagination-speed') ) : 400,
						pagination      : $that.attr('data-pagination') != 'no' ? true : false,
						autoHeight  : $that.attr('data-slider-autoheight') == 'yes' ? true : '',
						sliderPause : $that.attr('data-slider-pause') == 'yes' ? true : false,
						autoPlay    : $that.attr('data-slider-autoplay') != 'no' ? true : false,
						itemNum     : parseInt( $that.attr('data-items')),
						baseClass   : 'grve-testimonial'
					};

				carouselInit( $that, carouselSettings );

			});
			// Init Carousel
			function carouselInit( $element, settings ){
				$element.owlCarousel({
					navigation        : false,
					pagination        : settings.pagination,
					autoHeight        : settings.autoHeight,
					slideSpeed        : 400,
					paginationSpeed   : settings.paginationSpeed,
					singleItem        : true,
					autoPlay          : settings.autoPlay,
					stopOnHover       : settings.sliderPause,
					baseClass         : 'grve-testimonial-element',
					theme             : '',
				});

				// Carousel Element Speed
				if( settings.autoPlay === true ){
					$element.trigger('owl.play',settings.sliderSpeed);
				}
				$element.css('visibility','visible');
			}
		},
		flexibleCarousel: function(){

			var $flexibleCarousel = $('.grve-flexible-carousel');

			$flexibleCarousel.each(function(){
				var $that = $(this),
					carouselSettings = {
						sliderSpeed      : ( parseInt( $that.attr('data-slider-speed') ) ) ? parseInt( $that.attr('data-slider-speed') ) : 3000,
						paginationSpeed  : ( parseInt( $that.attr('data-pagination-speed') ) ) ? parseInt( $that.attr('data-pagination-speed') ) : 400,
						pagination       : $that.attr('data-pagination') != 'no' ? true : false,
						autoHeight       : $that.attr('data-slider-autoheight') == 'yes' ? true : '',
						sliderPause      : $that.attr('data-slider-pause') == 'yes' ? true : false,
						autoPlay         : $that.attr('data-slider-autoplay') != 'no' ? true : false,
						itemNum          : parseInt( $that.attr('data-items')),
						itemTabletL      : parseInt( $that.attr('data-tablet-landscape-items')),
						itemTabletP      : parseInt( $that.attr('data-tablet-portrait-items')),
						itemMobile       : parseInt( $that.attr('data-mobile-items')),
						baseClass        : 'grve-flexible-carousel'
					};

				carouselInit( $that, carouselSettings );
				customNav( $that );

			});
			// Init Carousel
			function carouselInit( $element, settings ){
				$element.owlCarousel({
					navigation        : false,
					pagination        : settings.pagination,
					autoHeight        : settings.autoHeight,
					slideSpeed        : 400,
					paginationSpeed   : settings.paginationSpeed,
					autoPlay          : settings.autoPlay,
					stopOnHover       : settings.sliderPause,
					baseClass         : 'grve-carousel-element',
					theme             : '',
					itemsCustom       : [[0, settings.itemMobile], [700, settings.itemTabletP], [1024, settings.itemTabletL], [1200, settings.itemNum]]
				});

				// Carousel Element Speed
				if( settings.autoPlay === true ){
					$element.trigger('owl.play',settings.sliderSpeed);
				}
				$element.css('visibility','visible');
			}

			// Carousel Navigation
			function customNav( $element ){
				$element.parent().find('.grve-carousel-next').click(function(){
					$element.trigger('owl.next');
				});
				$element.parent().find('.grve-carousel-prev').click(function(){
					$element.trigger('owl.prev');
				});
			}
		},
		carousel: function(){

			var $carousel = $('.grve-carousel');

			$carousel.each(function(){
				var $that = $(this),
					carouselSettings = {
						sliderSpeed : ( parseInt( $that.attr('data-slider-speed') ) ) ? parseInt( $that.attr('data-slider-speed') ) : 3000,
						paginationSpeed : ( parseInt( $that.attr('data-pagination-speed') ) ) ? parseInt( $that.attr('data-pagination-speed') ) : 400,
						pagination      : $that.attr('data-pagination') == 'yes' ? true : false,
						autoHeight  : $that.attr('data-slider-autoheight') == 'yes' ? true : '',
						sliderPause : $that.attr('data-slider-pause') == 'yes' ? true : false,
						autoPlay    : $that.attr('data-slider-autoplay') != 'no' ? true : false,
						itemNum     : parseInt( $that.attr('data-items')),
						itemsTablet : [768,2],
						baseClass   : 'grve-carousel',
						gap         : $that.parent().hasClass('grve-with-gap') && !isNaN( $that.data('gutter-size') ) ? Math.abs( $that.data('gutter-size') )/2 : 0,
					};

				carouselInit( $that, carouselSettings );
				customNav( $that );

			});
			// Init Carousel
			function carouselInit( $element, settings ){
				if( $element.hasClass('grve-blog-carousel') && $element.parent().hasClass('grve-with-gap')) {
					settings.gap = 20;
				}
				$element.css({ 'margin-left' : - settings.gap, 'margin-right' : - settings.gap });

				$element.owlCarousel({
					navigation        : false,
					pagination        : settings.pagination,
					autoHeight        : settings.autoHeight,
					slideSpeed        : 400,
					paginationSpeed   : settings.paginationSpeed,
					singleItem        : false,
					items             : settings.itemNum,
					autoPlay          : settings.autoPlay,
					stopOnHover       : settings.sliderPause,
					baseClass         : 'grve-carousel-element',
					theme             : '',
					itemsDesktop      : false,
					itemsDesktopSmall : false,
				 	itemsTablet       : settings.itemsTablet
				});

				// Carousel Element Speed
				if( settings.autoPlay === true ){
					$element.trigger('owl.play',settings.sliderSpeed);
				}
				$element.css('visibility','visible');
				$element.find('.owl-item').css({ 'padding-left' : settings.gap, 'padding-right' : settings.gap });
			}

			// Carousel Navigation
			function customNav( $element ){
				$element.parent().find('.grve-carousel-next').click(function(){
					$element.trigger('owl.next');
				});
				$element.parent().find('.grve-carousel-prev').click(function(){
					$element.trigger('owl.prev');
				});
			}
		},
		advancedPromo: function(){
			var $item = $('.grve-expandable-info');
			$item.each(function(){
				var $that         = $(this),
					$wrapper      = $that.parents('.grve-section'),
					$content      = $that.find('.grve-expandable-info-content'),
					paddingTop    = parseInt( $wrapper.css('padding-top') ),
					paddingBottom = parseInt( $wrapper.css('padding-bottom') );

				$wrapper.addClass('grve-pointer-cursor');
				$wrapper.on('click',function(){

					var headerHeight   = $('#grve-header').data('sticky') != 'none' ? $('#grve-main-header').outerHeight() : 0,
						fieldBarHeight = $('.grve-fields-bar').length ? $('.grve-fields-bar').outerHeight() : 0,
						offset         = $(this).offset().top,
						distance       = offset - ( headerHeight + fieldBarHeight );

					if( $content.is(":visible") ){
						$content.slideUp( 600, function(){
							$content.removeClass('show');
						});
					} else {

						$('html,body').animate({
							scrollTop: distance
						}, 600,function(){
							$content.slideDown( function(){
								$content.addClass('show');
								return;
							});
						});
					}
				});
				$wrapper.mouseenter(function() {
					$(this).css({ 'padding-top' : paddingTop + 40, 'padding-bottom' : paddingBottom + 40 });
				});
				$wrapper.mouseleave(function() {
					$(this).css({ 'padding-top' : paddingTop, 'padding-bottom' : paddingBottom });
				});
			});
		},
		imageText: function(){
			var $el = $('.grve-image-text');
			if( !$el.length > 0 ) return;
			$el.each(function(){
				var $that = $(this),
					$img = $that.find('img'),
					$cont = $that.find('.grve-content');
				$img.css({ 'padding-top' : '', 'padding-bottom' : '' });
				$cont.css({ 'padding-top' : '', 'padding-bottom' : '' });
				$that.css('visibility','hidden');
				$img.imagesLoaded( function() {
					var imgHeight = $img.height(),
						contHeight = $cont.height(),
						space = parseInt( (imgHeight - contHeight)/2 );
					if( $(window).width() + scrollBarWidth >= mobileScreen ) {
						if( imgHeight < contHeight ){
							space = parseInt( (contHeight - imgHeight)/2 );
							$img.css({ 'padding-top' : space, 'padding-bottom' : space });
						} else {
							$cont.css({ 'padding-top' : space, 'padding-bottom' : space });
						}
					}
					$that.css('visibility','visible');
				});

			});
		},
		iconBox: function(){
			var $parent   = $('.grve-row'),
				arrHeight = [];

			$parent.each(function(){
				var $iconBox  = $(this).find('.grve-box-icon.grve-advanced-hover');
				if( !$iconBox.length ) return;

				if( isMobile.any() ) {
					$iconBox.removeClass('grve-advanced-hover');
					return;
				}

				$iconBox.css({ 'height' : '', 'padding-top' : '' });
				$iconBox.each(function(){
					var $that          = $(this),
						$iconBoxHeigth = $that.height();

					arrHeight.push( $iconBoxHeigth );
				});

				var maxHeight   = Math.max.apply(Math,arrHeight) + 20,
					iconHeight  = $iconBox.find('.grve-wrapper-icon').height(),
					paddingTop  = ( maxHeight - iconHeight )/2;

				$iconBox.css({ 'height' : maxHeight, 'padding-top' : paddingTop });
				setTimeout(function() {
					$iconBox.addClass('active');
					// Fix Columns Height
					GRVE.setColumnHeight.init();
				}, 300);

				$iconBox.unbind('mouseenter mouseleave').bind('mouseenter mouseleave', function() {
					$(this).toggleClass('hover');
				});

			});
		},
		messageBox: function(){
			var infoMessage = $('.grve-message'),
			closeBtn = infoMessage.find($('.grve-close'));
			closeBtn.click(function () {
				$(this).parent().slideUp(150);
			});
		},
		wooProduct: function(){
			var $item   = $('.grve-product-item'),
				$addBtn = $item.find('.add_to_cart_button');
			$addBtn.on('click',function(){
				$(this).parents('.grve-product-switcher').addClass('product-added');
			});
		},
		wooProductZoom: function(){
			if( !isMobile.any() ){
				var $easyzoom = $('.easyzoom').easyZoom();
			}
		},
		animAppear: function(){
			if( bodyLoader === true ){
				return;
			}
			if(isMobile.any()) {
				$('.grve-animated-item').css('opacity',1);
			} else {
				$('.grve-animated-item').each(function() {
					var timeDelay = $(this).attr('data-delay');
					$(this).appear(function() {
					var $that = $(this);
						setTimeout(function () {
							$that.addClass('grve-animated');
						}, timeDelay);
					},{accX: 0, accY: -150});
				});
			}
		},
		vcAccordion: function(){
			var $target = $('.vc_tta-accordion').find('a[data-vc-accordion]'),
				$panel = $('.vc_tta-panel');
			if( $panel.find('.grve-isotope').length ) {
				setTimeout(function(){
					GRVE.isotope.init();
				},100);
			}
			$target.on('click',function(){
				if( $panel.find('.grve-isotope').length ) {
					setTimeout(function(){
						GRVE.isotope.init();
					},100);
				}
			});
		},
		vcTab: function(){
			var $target = $('.vc_tta-tabs').find('a[data-vc-tabs]'),
				$panel = $('.vc_tta-panel');
			if( $panel.find('.grve-isotope').length ) {
				setTimeout(function(){
					GRVE.isotope.init();
				},100);
			}
			$target.on('click',function(){
				if( $panel.find('.grve-isotope').length ) {
					setTimeout(function(){
						GRVE.isotope.init();
					},100);
				}
			});
		},
		productSocials: function(){
			var $socials = $('.grve-product-social'),
				$item    = $socials.find('li');
			if( !$socials.length ) return;

			$socials.appear(function() {
				$item.each(function(i,n){
					var $this = $(this);
					setTimeout(function(){
						$this.addClass('grve-animated');
					},150 * i);
				});
			},{accX: 0, accY: -50});
		},
		countdown: function(){
			$('.grve-countdown').each(function() {
				var $this        = $(this),
					finalDate    = $this.data('countdown'),
					numbersSize  = $this.data('numbers-size'),
					textSize     = $this.data('text-size'),
					numbersColor = $this.data('numbers-color'),
					textColor    = $this.data('text-color'),
					countdownItems = '',
					text = '',
					countdownFormat = $this.data('countdown-format').split('|');

				$.each( countdownFormat, function( index, value ) {
					switch (value) {
						case 'w':
							text = grve_main_data.grve_string_weeks;
							break;
						case 'D':
						case 'd':
						case 'n':
							text = grve_main_data.grve_string_days;
							break;
						case 'H':
							text = grve_main_data.grve_string_hours;
							break;
						case 'M':
							text = grve_main_data.grve_string_minutes;
							break;
						case 'S':
							text = grve_main_data.grve_string_seconds;
							break;
						default:
							text = '';
					}
					countdownItems += '<div class="grve-countdown-item">'
					countdownItems += '<div class="grve-number grve-' + numbersSize + ' grve-text-' + numbersColor + '">%' + value + '</div>';
					countdownItems += '<span class="grve-' + textSize + ' grve-text-' + textColor + '">' + text + '</span>';
					countdownItems += '</div>';

				});

				$this.countdown(finalDate, function(event) {
					$this = $(this).html(event.strftime( countdownItems ));
				});
			});
		}
	}

	// # Parallax Section
	// ============================================================================= //
	GRVE.parallaxSection = {

		init: function( section ){

			var $section        = $( section ),
				sectionLenght   = $section.length;

			function update(){
				var windowScroll = $(window).scrollTop(),
					windowHeight = $(window).height();

				for( var i = 0; i < sectionLenght; i ++ ){

					var element       = $section[i],
						$parallaxEl   = $(element).find('.grve-bg-image'),
						sectionHeight = $(element).outerHeight(),
						sectionWidth  = $(element).outerWidth(),
						threshold     = $(element).data('parallax-sensor'),
						elementHeight = sectionHeight + threshold,
						elementWidth  = sectionWidth + threshold,
						sectionTop    = $(element).offset().top,
						speed         = ( windowHeight + sectionHeight ) / ( elementHeight - sectionHeight ),
						transform;

					if( $(element).hasClass('grve-horizontal-parallax-lr') || $(element).hasClass('grve-horizontal-parallax-rl') ){
						speed = ( windowHeight + sectionHeight ) / ( elementWidth - sectionWidth );
					}

					if(  sectionTop - windowScroll <= windowHeight && sectionTop - windowScroll + windowHeight >= windowHeight - sectionHeight  ) {
						var translate = ( windowScroll + windowHeight - sectionTop )/speed;
					} else {
						translate = 0;
					}

					if( $(element).hasClass('grve-horizontal-parallax-lr') || $(element).hasClass('grve-horizontal-parallax-rl') ){
						if( $(element).hasClass('grve-horizontal-parallax-lr')) {
							transform = 'translateX(' + - translate + 'px)';
						}
						if( $(element).hasClass('grve-horizontal-parallax-rl')) {
							transform = 'translateX(' + -(threshold - translate) + 'px)';
						}

						$parallaxEl.css({'width' : elementWidth});
					} else {
						transform = 'translateY(' + - translate + 'px)';
						$parallaxEl.css({'height' : elementHeight});
					}


					$parallaxEl.css({
						'-webkit-transform' : transform,
						'-moz-transform'    : transform,
						'-ms-transform'     : transform,
						'-o-transform'      : transform,
						'transform'         : transform
					});

				}
			}

			update();
			$(window).on('scroll', function(){
				update();
			});

			if( isMobile.any() ) {
				$(window).on("orientationchange",function(){
					update();
				});
			} else {
				$(window).smartresize(function(){
					update();
				});
			}
		}
	};

	GRVE.parallaxSectionOld = {
		init: function(){
			var $selector    = $('.grve-section.grve-bg-parallax'),
				windowHeight = $(window).height(),
				scrollTop    = $(window).scrollTop();

			$selector.each(function(){
				var $that     = $(this),
					elTop     = $that.offset().top,
					elHeight  = $that.outerHeight(),
					bgSize    = Math.ceil( windowHeight * 0.4 ) + elHeight,
					posY      = ( scrollTop - ( elTop - windowHeight ) ) / ( ( elTop + elHeight ) - ( elTop - windowHeight ) ),
					translate = posY * ( elHeight - bgSize );

				if ( elTop + elHeight < scrollTop || elTop > scrollTop + windowHeight ) {
					return;
				}
				$that.find('.grve-bg-image').css({ 'transform': 'translate3d(0, ' + translate + 'px, 0)' , 'height': bgSize });

			});
		}
	};

	// # Set Equal Columns Height
	// ============================================================================= //
	GRVE.setColumnHeight = {
		init: function(){
			var section     = '.grve-section',
				windowWidth = $(window).width() + scrollBarWidth;

			$(section).each(function(){
				var $that   = $(this),
					$column = $that.find('.grve-row').first().children();

				if( $that.hasClass('grve-equal-column') ) {
					equalHeight( $that, $column, fullHeight );
				} else if( $that.hasClass('grve-middle-content') ) {
					middleContent( $that, $column, fullHeight );
				} else if( $that.hasClass('grve-fullheight') ) {
					fullHeight( $that );
				} else {
					return;
				}
			});

			function equalHeight( section, $column, callback ) {
				section.imagesLoaded('always',function(){
					$column.css({ 'min-height': '', 'padding-top': '', 'padding-bottom': '' });
					var maxHeight = GRVE.setColumnHeight.getMaxHeight( section );
					if( ( windowWidth <= tabletLandscape && $column.hasClass('grve-tablet-column-1') ) || windowWidth <= tabletPortrait ) {
						$column.css({ 'min-height': '', 'visibility': 'visible'  });
					} else {
						$column.css({ 'min-height': maxHeight, 'visibility': 'visible'  });
					}

					if( section.hasClass('grve-fullheight') ) {
						callback( section );
					}
				});
			}

			function middleContent( section, $column, callback ) {
				section.imagesLoaded('always',function(){
					$column.css({ 'min-height': '', 'padding-top': '', 'padding-bottom': '' });
					var maxHeight = GRVE.setColumnHeight.getMaxHeight( section );
					if( ( windowWidth <= tabletLandscape && $column.hasClass('grve-tablet-column-1') ) || windowWidth <= tabletPortrait ) {
						$column.css({ 'padding-top': '', 'padding-bottom': '', 'min-height': '', 'visibility': 'visible'  });
					} else {
						$column.each(function(){
							var columnHeigth = $(this).outerHeight();
							if( columnHeigth <= maxHeight ) {
								var space = ( maxHeight - columnHeigth ) / 2;
								$(this).css({ 'padding-top' : space, 'padding-bottom' : space });
							}
						});
						$column.css({ 'visibility': 'visible'  });
					}

					if( section.hasClass('grve-fullheight') ) {
						callback( section );
					}
				});
			}

			function fullHeight( section ) {
				section.imagesLoaded('always',function(){
					$(section).css({ 'min-height': '', 'padding-top': '', 'padding-bottom': '' });
					var windowHeight    = $(window).height(),
						$container      = section.find('.grve-container'),
						sectionHeight   = GRVE.setColumnHeight.getMaxHeight( $container ),
						headerHeight    = $('#grve-header').data('sticky') == 'none' ? $('#grve-main-header').outerHeight() : 0,
						topBarHeight    = $('#grve-top-bar').length ? $('#grve-top-bar').outerHeight() : 0,
						anchorBarHeight = $('.grve-anchor-menu').length ? $('.grve-anchor-menu').outerHeight() : 0,
						offset          = ( headerHeight + topBarHeight + anchorBarHeight + sectionHeight ),
						space           = ( windowHeight - offset )/2;

					if(sectionHeight > ( windowHeight - headerHeight )){
						section.css({'padding-top':40, 'padding-bottom': 40});
						$container.css({ 'visibility': 'visible' });
					} else {
						section.css({ 'padding-top':space, 'padding-bottom': space});
						$container.css({ 'visibility': 'visible' });
					}
					// Resize Video
					if( $(section).find('.grve-bg-video').length ) {
						GRVE.resizeVideo.init( $(section).find('.grve-background-wrapper') );
					}
				});
			}

		},
		getMaxHeight: function( section ){
			var $that         = section,
				sectionHeight = $that.height(),
				maxHeight     = sectionHeight;

			return maxHeight;
		}
	};

	// # Section Settings
	// ============================================================================= //
	GRVE.sectionSettings = {
		init: function(){

			if( !$('#grve-sidebar').length > 0 ) return;

			var section      = '#grve-content .grve-section',
				windowWidth  = $(window).width(),
				themeWidth   = $('#grve-theme-wrapper').width(),
				wrapperWidth = $('.grve-content-wrapper').width(),
				contentWidth = $('#grve-main-content').width(),
				sidebarWidth = $('#grve-sidebar').outerWidth(),
				space        = (themeWidth - wrapperWidth)/2,
				sidebarSpace = space + wrapperWidth - contentWidth;


			$(section).each(function(){
				var $section = $(this);
				if( $section.hasClass('grve-fullwidth-background') ){
					fullBg($section);
				}
				if( $section.hasClass('grve-fullwidth') ){
					fullElement($section);
				}

			});

			function fullBg( section ) {
				if( windowWidth + scrollBarWidth >= tabletPortrait ) {
					if( $('.grve-right-sidebar').length ) {
						section.css({ 'visibility': 'visible', 'padding-left':space, 'padding-right': sidebarSpace, 'margin-left': -space, 'margin-right': -sidebarSpace});
					}
					else {
						section.css({ 'visibility': 'visible', 'padding-left':sidebarSpace, 'padding-right': space, 'margin-left': -sidebarSpace, 'margin-right': -space});
					}
				} else {
					section.css({ 'visibility': 'visible', 'padding-left':'', 'padding-right': '', 'margin-left': '', 'margin-right': ''});
				}

			}

			function fullElement( section ) {
				if( windowWidth + scrollBarWidth >= tabletPortrait ) {
					if( $('.grve-right-sidebar').length ) {
						section.css({ 'visibility': 'visible', 'padding-left':0, 'padding-right': sidebarSpace, 'margin-left': -space, 'margin-right': -sidebarSpace});
					}
					else {
						section.css({ 'visibility': 'visible', 'padding-left':sidebarSpace, 'padding-right': 0, 'margin-left': -sidebarSpace, 'margin-right': -space});
					}
				} else {
					section.css({ 'visibility': 'visible', 'padding-left':'', 'padding-right': '', 'margin-left': '', 'margin-right': ''});
				}
			}
		}
	};

	// # Isotope
	// ============================================================================= //
	GRVE.isotope = {

		init: function(){
			var $selector = $('.grve-isotope');
			$selector.each(function(){
				var $this = $(this),
					$container   = $this.find('.grve-isotope-container'),
					$curCategory = $this.find('.grve-current-category'),
					dataSpinner  = $this.data('spinner');

				// Set Item Size
				itemSize( $this, $container, initIsotope );
				// Filters
				filter( $this, $container );
				// Add Spinner
				if( dataSpinner == 'yes' ) {
					addSpinner( $this );
				}

			});

			function filter( $this, $container ){
				$this.find('.grve-filter li').click(function(){
					var $filter      = $(this),
						selector     = $filter.attr('data-filter'),
						title        = $filter.html(),
						$curCategory = $this.find('.grve-current-category');

					if( $curCategory.length > 0 ){
						$curCategory.find('span').html( title );
					}

					$container.isotope({
						filter: selector
					});

					// Go tot top
					filterGoToTop( $filter )

					$(this).addClass('selected').siblings().removeClass('selected');
				});
			}

			function filterGoToTop( filter ){
				var $this = filter,
					filterTop    = $this.offset().top,
					headerHeight = $('#grve-header').data('sticky') != 'none' ? $('#grve-main-header').outerHeight() : 0,
					topBarHeight = $('#grve-top-bar').length ? $('#grve-top-bar').height() : 0,
					offset       = topBarHeight + wpBarHeight + headerHeight + 50;
				if( filterTop > 0 ){
					$('html, body').delay(300).animate({
						scrollTop: filterTop - offset
					}, 600);
					return false;
				}
			}

			function column( el ){
				var windowWidth = $(window).width() + scrollBarWidth,
					$element    = el,
					columns     = {
						desktop  : $element.data('columns'),
						tabletL  : $element.data('columns-tablet-landscape'),
						tabletP  : $element.data('columns-tablet-portrait'),
						mobille  : $element.data('columns-mobile')
					};

				if ( windowWidth > tabletLandscape ) {
					columns = columns.desktop;
				} else if ( windowWidth > tabletPortrait && windowWidth < tabletLandscape ) {
					columns = columns.tabletL;
				} else if ( windowWidth > mobileScreen && windowWidth < tabletPortrait ) {
					columns = columns.tabletP;
				} else {
					columns = columns.mobille;
				}
				return columns;
			}

			function itemSize( el, $container, callback ){
				var wrapperW     = el.innerWidth(),
					gap          = el.hasClass('grve-with-gap') && !isNaN( el.data('gutter-size') ) ? Math.abs( el.data('gutter-size') )/2 : 0,
					$isotopItem  = $container.find('.grve-isotope-item'),
					$slider      = $isotopItem.find('.grve-slider');

				if( el.hasClass('grve-blog') ){
					gap = 20;
				}

				var columns      = column( el ),
					offset       = el.parents('.grve-section').hasClass('grve-fullwidth') ? -(gap * 2) : gap * 2,
					columnW      = ( wrapperW + offset ) / columns,
					columnW      = (columnW % 1 !== 0) ? Math.ceil(columnW) : columnW,
					containerW   = columnW * columns;

				$container.css({'margin-left' : - gap, 'margin-right' : - gap, 'width' : containerW });
				$isotopItem.css({ 'padding-left' : gap, 'padding-right' : gap, 'margin-bottom' : gap*2, 'width' : columnW });

				if( el.hasClass('grve-with-gap') && $container.parents('.grve-section').hasClass('grve-fullwidth') ) {
					el.css({'padding-left' : gap*2, 'padding-right' : gap*2 });
				}

				// Item Width * 2
				if( columns != 1 ) {
					$container.find('.grve-image-large-square').css({ 'width': columnW * 2 });
					$container.find('.grve-image-landscape').css({ 'width': columnW * 2 }).find('.grve-media').css({ 'height': columnW - ( gap * 2 ) });
					$container.find('.grve-image-portrait').css({ 'width': columnW }).find('.grve-media').css({ 'height': ( columnW * 2 ) - ( gap * 2 ) });
				}

				// Item Column 2
				if( columns == 2 ) {
					$container.find('.grve-image-large-square').css({ 'width': columnW * 2 });
					$container.find('.grve-image-landscape').css({ 'width': columnW  }).find('.grve-media').css({ 'height': ( columnW / 2 ) - ( gap * 2 ) });
					$container.find('.grve-image-portrait').css({ 'width': columnW }).find('.grve-media').css({ 'height': ( columnW * 2 ) - ( gap * 2 ) });
				}

				// Item Column 1
				if( columns == 1 ) {
					$container.find('.grve-image-large-square').css({ 'width': columnW });
					$container.find('.grve-image-landscape').css({ 'width': columnW  }).find('.grve-media').css({ 'height': columnW });
					$container.find('.grve-image-portrait').css({ 'width': columnW }).find('.grve-media').css({ 'height': columnW });
				}

				if(callback) callback( el, $container );

			}

			function initIsotope( el, $container ){
				var layout = el.data('layout') !== '' ? el.data('layout') : 'fitRows',
					$slider = el.find('.grve-slider');

				$container.imagesLoaded( function() {
					$container.isotope({
						resizable: true,
						itemSelector: '.grve-isotope-item',
						layoutMode: layout,
						animationEngine : 'jquery'
					});
					relayout($container);

					// Spinner
					var dataSpinner = $container.parent().data('spinner');
					if( dataSpinner == 'yes' ) {
						setTimeout(function() {
							removeSpinner( $container );
						},2000);
					} else {
						$container.css({'opacity': 1});
						// Isotope Animation
						if( !isMobile.any() ){
							animation($container);
						} else {
							$container.find('.grve-isotope-item-inner').addClass('grve-animated');
						}
					}

					// Init Slider Again
					$slider.each(function(){
						var $that     = $(this),
							owlSlider = $that.data('owlCarousel');
						owlSlider.reinit();
					});

					setTimeout( function(){
						relayout($container);
						// Fix Columns Height
						GRVE.setColumnHeight.init();
					}, 300 );

					$(window).smartresize(function(){
						itemSize( el, $container );
						relayout($container);
					});

					// Auto Headings Resize
					if( layout == 'masonry' && el.hasClass('grve-auto-headings') ){
						GRVE.autoHeadingSize.init( '.grve-auto-headings' , '.grve-isotope-item', '.grve-title', '.grve-caption' );
					}

				});
			}

			function relayout($container){
				$container.isotope('layout');
			}

			function animation($container){
				var cnt = 1,
					itemAppeared = 1;
				$container.find('.grve-isotope-item').appear(function() {
					var $this = $(this),
						delay = 200 * cnt++;

					setTimeout(function () {
						itemAppeared++;
						if( itemAppeared == cnt ){
							cnt = 1;
						}
						$this.find('.grve-isotope-item-inner').addClass('grve-animated');
					}, delay);
				});
			}

			function addSpinner(el){
				var $spinner = $('<div class="grve-loader"></div>');
				$spinner.appendTo( el );
			}

			function removeSpinner($container){
				$container.parent().find('.grve-loader').fadeOut(600,function(){
					$container.css({'opacity': 1});
					animation($container);
				});
			}

		},
		noIsoFilters: function() {
			var $selector = $('.grve-non-isotope');
			$selector.each(function(){
				var $that = $(this);
				$that.find('.grve-filter li').click(function(){
					var selector = $(this).attr('data-filter');
					if ( '*' == selector ) {
						$that.find('.grve-non-isotope-item').fadeIn('1000');
					} else {
						$that.find('.grve-non-isotope-item').hide();
						$that.find(selector).fadeIn('1000');
					}
					$(this).addClass('selected').siblings().removeClass('selected');
				});
			});
		}
	};

	// # Portfolio Auto Resize Headings
	// ============================================================================= //
	GRVE.autoHeadingSize = {
		init : function( container, item, title, caption ){
			var $item = $(container).find( item ),
				$heading = $(container).find( title ),
				headingSize = parseInt( $heading.css('font-size') ),
				compressor = 20,
				itemLength = $item.length;

			updateParam();
			$(window).smartresize(function(){
				resetSize( updateParam );
			});

			function updateParam(){
				for( var i=0; i < itemLength; i++){
					var el = $item[i],
						elSize = $(el).width();
					$(el).find(title).css({ 'font-size': elSize / compressor  + 'px', 'line-height' : '1.2' });
					$(el).find(caption).css({ 'font-size': Math.max(Math.min( (elSize / compressor)*0.4, elSize), 13 ) + 'px', 'line-height' : '1.2' });
				}
			}

			function resetSize(callback){
				$heading.attr('style', '');
				callback();
			}

		}
	};

	// # Social Bar For Post
	// ============================================================================= //
	GRVE.socialBar = {
		init : function(){
			var $bar = $('#grve-socials-bar');
			if( !$bar.length > 0 ) {
				return;
			}
			if( isMobile.any() ) {
				$bar.addClass('grve-no-animation');
				return;
			}
			var posTop       = $bar.offset().top,
				scroll       = $(window).scrollTop(),
				windowHeight = $(window).height(),
				offset       = ( $bar.offset().top - windowHeight ) + 50;

			if( scroll > offset ) {
				this.showSocials();
			} else {
				this.hideSocials();
			}
		},
		showSocials : function(){
			var $item = $('#grve-socials-bar').find('ul.grve-socials li a'),
				i = 0;
			$item.each(function(){
				var $that = $(this);
				i++;
				setTimeout(function () {
					$that.addClass('show');
				}, i * 200 );
			});
		},
		hideSocials : function(){
			var $item = $('#grve-socials-bar').find('ul.grve-socials li a');
			$item.removeClass('show');
		}
	};

	// # Related Post
	// ============================================================================= //
	GRVE.relatedPost = {

		item  : '.grve-related-item',
		quota : 0.5,

		init: function(){

			var item        = GRVE.relatedPost.item,
				quota       = GRVE.relatedPost.quota,
				$itemParent  = $(item).parent(),
				itemsLength = $(item).length;

			if( itemsLength == 1 ){
				$itemParent.addClass('grve-related-column-1');
				return;
			}
			if( itemsLength == 2 ){
				$itemParent.addClass('grve-related-column-2');
				quota = 0.7;
			}
			function hoverEffect(){
				$(item).hover(function() {

					if( $(window).width() + scrollBarWidth < tabletPortrait || isMobile.any() ) return;

					var $that = $(this),
						parentWidth = $itemParent.width(),
						newWidth =  parseInt(( parentWidth * quota ),10),
						otherWidth = parseInt((( parentWidth - newWidth ) / ( itemsLength - 1) ),10);
					$that.stop(true).animate({ width: newWidth }, 300 );
					$itemParent.children().not(this).stop(true).animate({ width: otherWidth }, 300 );
				}, function() {

					if( $(window).width() + scrollBarWidth < tabletPortrait || isMobile.any() ) return;

					var $that = $(this);
					$that.parent().children().stop(true).animate({ width: $(this).data('standardWidth') }, 300 );
				});
			}

			hoverEffect();

			GRVE.relatedPost.itemWidth();
		},
		itemWidth: function(){
			var item = GRVE.relatedPost.item;
			$(item).each(function() {
				$(this).css( 'width', '' ).data('standardWidth', $(this).width());
			});
		}
	};

	// # Scroll Direction
	// ============================================================================= //
	GRVE.scrollDir = {
		init: function(){
			var scroll = $(window).scrollTop();
			if (scroll > lastScrollTop){
				lastScrollTop = scroll;
				return { direction : 'scrollDown'  }
			} else {
				lastScrollTop = scroll;
				return { direction : 'scrollUp'  }
			}

			lastScrollTop = scroll;
		}
	};

	// # Full Page
	// ============================================================================= //
	GRVE.fullPage = {
		init: function(){
			var $fPage = $('#grve-fullpage');
			if( !$fPage.length > 0 ) return;
				var $section = $fPage.find('.grve-section');
				var deviceNavigation = true;
				var deviceAutoScrolling = true;
				var deviceFullPageEnable = $fPage.data('device-scrolling') == 'yes' ? true : false;

				if( isMobile.any() && !deviceFullPageEnable ) {
					deviceNavigation = false;
					deviceAutoScrolling = false;
				}

				var navigationAnchorTooltips = $('[data-anchor-tooltip]').map(function(){
					return $(this).data('anchor-tooltip').toString();
				}).get();

			$fPage.fullpage({
				navigation: deviceNavigation,
				navigationPosition: 'right',
				navigationTooltips: navigationAnchorTooltips,
				sectionSelector: $section,
				css3: true,
				scrollingSpeed: 1000,
				autoScrolling : deviceAutoScrolling,
				lockAnchors : true,
				afterLoad: function(anchorLink, index){

					var sectionHeaderColor = $('[data-anchor="'+ anchorLink + '"]').attr('data-header-color');
					var color = 'grve-' + sectionHeaderColor;

					$section.find('.fp-tableCell').css('visibility','visible');

					// Set Header Color
					if( !$('#grve-main-header').hasClass('grve-header-side') ) {
						$('#grve-main-header').removeClass('grve-light grve-dark').addClass(color);
					}
					$('#fp-nav').removeClass('grve-light grve-dark').addClass(color);
				}
			});
		}
	};


	// # Global Variables
	// ============================================================================= //
	var bodyLoader = false;
	var largeScreen = 2048;
	var tabletLandscape = 1200;
	var tabletPortrait = 1023;
	var mobileScreen = 767;
	var lastScrollTop = 0;
	var wpBarHeight = $('#grve-body').hasClass('admin-bar') ? 32 : 0;
	var isMobile = {
		Android: function() {
			return navigator.userAgent.match(/Android/i);
		},
		BlackBerry: function() {
			return navigator.userAgent.match(/BlackBerry/i);
		},
		iOS: function() {
			return navigator.userAgent.match(/iPhone|iPad|iPod/i);
		},
		Opera: function() {
			return navigator.userAgent.match(/Opera Mini/i);
		},
		Windows: function() {
			return navigator.userAgent.match(/IEMobile/i);
		},
		any: function() {
			return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
		}
	};

	// # Scrollbar Width
	// ============================================================================= //
	var parent, child, scrollBarWidth;

	if( scrollBarWidth === undefined ) {
		parent          = $('<div style="width:50px;height:50px;overflow:auto"><div/></div>').appendTo('body');
		child           = parent.children();
		scrollBarWidth  = child.innerWidth()-child.height(99).innerWidth();
		parent.remove();
	};



	$(document).ready(function(){ GRVE.documentReady.init(); });
	$(window).smartresize(function(){ GRVE.documentResize.init(); });
	$(window).load(function(){ GRVE.documentLoad.init(); });
	$(window).on('scroll', function() { GRVE.documentScroll.init(); });

})(jQuery);