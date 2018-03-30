function KowloonBaySetup ($, param) {
	"use strict";



	/*
	 * Utility function for checking if a script is required
	 */

	function checkRequiredScript (s) {
		return (param.requiredScripts.indexOf(s)>0);
	}



	/*
	 * Remove empty p tags and br tags
	 */

	$('p:empty').remove();
	$('.no-br').find('br').remove();



	/*
	 * Global variable for WOW.js
	 */

	var wow;



	/*
	 * Setup Menus
	 */

	var $header = $('body>.container>header'),
	$logo = $header.find('.logo'),
	$menu = $header.find('.multi-level-menu'),
	$mobileMenu = $('<select/>').attr('class', 'mobile-menu'),
	$mobileMenuWrapper = $('<div/>').addClass('mobile-menu-wrapper').append($mobileMenu).insertAfter($menu);

	function setupMobileMenu () {
		createMobileMenuOptions($menu, $mobileMenu, '');
		$mobileMenu.on('change', function () {
			window.location.href = $(this).val();
		});
	}

	function createMobileMenuOptions ($s, $t, prefix) {
		// $s: original multi-level menu
		// $t: target mobile menu

		$s.children().each(function(index, el) {
			var $el = $(el),
			$a = $el.children('a'),
			$subMenu = $el.children('ul');

			var $option = $('<option />')
			.attr('value', $a.attr('href'))
			.html(prefix + $a.html());

			if ($a.hasClass('active')) {
				$option.attr('selected', 'selected');
			}

			$option.appendTo($t);

			if ($subMenu.length === 1){
				createMobileMenuOptions($subMenu, $t, '&nbsp;&nbsp;&nbsp;' + prefix);
			}
		});
	}

	setupMobileMenu();

	function toggleHeaderMobileMenu () {
		if ($header.width() < $logo.width() + $menu.width() || $(window).width() < 768) {
			$header.addClass('show-mobile-menu');
			$mobileMenu.css('max-width', $header.width() - $logo.width() - 20);
		} else if (!Modernizr.touch){
			$header.removeClass('show-mobile-menu');
		}
	}

	// Multi-Level Menu
	if (checkRequiredScript('multi-level-menu')){
		$('.multi-level-menu').multiLevelMenu();
	}


	if (checkRequiredScript('modernizr')){
		if (Modernizr.touch){
			$header.addClass('show-mobile-menu');
		}
	}

	$(window).on('resize load', function () {
		toggleHeaderMobileMenu();
	});



	/*
	 * Add form control styling
	 */

	$('input[type=text], input[type=search], input[type=email], textarea').addClass('form-input-style');
	$('input[type=submit]').addClass('btn btn-default letter-spacing');
	$('input[type=text], input[type=search], input[type=email], textarea').on('change', function () {
		var $this = $(this),
		$next = $this.next();

		if ($next.hasClass('wpcf7-not-valid-tip')){
			if ($this.val() === ''){
				$next.show();
			} else{
				$next.hide();
			}
		}
	});
	$('.comment-reply-link').addClass('btn btn-default btn-sm');



	/*
	 * General Setup
	 */

	// Background Image Cover
	if (checkRequiredScript('img-bg-cover')){
		$('.img-bg-cover').imgBgCover();
	}

	// Set equal column height
	if (checkRequiredScript('eq-col-height')){
		$('.eq-col-height').eqColHeight();
	}

	// Clickable Blocks
	if (checkRequiredScript('clickable-block')){
		$('.clickable-block').clickableBlock();
	}

	// Accordian
	$('.collapse').collapse({'toggle': false});
	$('.accordian-expand').on('click', function () {
		$('.collapse').collapse('show');
	});
	$('.accordian-collapse').on('click', function () {
		$('.collapse').collapse('hide');
	});

	// Animate.css
	var $secHeading = $('.section-heading'),
	$sectionDesc = $('.section-heading').find('p.section-desc'),
	$headingH2 = $('.section-heading').children('h2'),
	$headingH2Span = $headingH2.children('span'),
	$headingH2Link = $headingH2.children('a');

	if (param.animationSectionDescApplyToLetter){
		$sectionDesc.lettering();
		if (param.animationSectionDesc !== 'no-animation')
			$sectionDesc.children('span').addClass('wow').addClass(param.animationSectionDesc);
	} else{
		if (param.animationSectionDesc !== 'no-animation')
			$sectionDesc.addClass('wow').addClass(param.animationSectionDesc);
	}

	if ($headingH2Link.length > 0){
		if (param.animationSectionHeading !== 'no-animation')
			$headingH2Link.addClass('wow').addClass(param.animationSectionHeading);
	} else{
		if (param.animationSectionHeading !== 'no-animation')
			$headingH2Span.addClass('wow').addClass(param.animationSectionHeading);
	}

	// skrollr
	var s;
	if (checkRequiredScript('skrollr')){
		s = skrollr.init({
			forceHeight: false,
			smoothScrolling: false,
			mobileDeceleration: 0.004,
			mobileCheck: function () {
				return false;
			}
		});
	}



	/*
	 * Owl Carousel
	 */

	if (checkRequiredScript('owl-carousel')){
		$('.carousel-single-item').owlCarousel({
			animateOut: param.animationPortfolioSlider,
			stagePadding: 0,
			center:true,
			items:1,
			loop: param.carouselSingleItemCount > 1,
			dots: param.carouselSingleItemCount > 1,
			margin:0,
			nav:false,
			autoplay:true,
			autoplayTimeout: param.durationCarouselSingleItemAutoplayTimeout,
			smartSpeed: 500,
			autoplayHoverPause:true,
			video:false,
		});

		$('.carousel-single-item-video').owlCarousel({
			animateOut: param.animationPortfolioSlider,
			stagePadding: 0,
			center:true,
			items:1,
			loop: param.carouselSingleItemVideoCount > 1,
			dots: param.carouselSingleItemVideoCount > 1,
			margin:0,
			nav:false,
			autoplay:false,
			smartSpeed: 500,
			video:true,
		});

		$('.carousel-multiple-items').owlCarousel({
			center:false,
			margin:0,
			nav:false,
			autoplay:true,
			autoplayTimeout: param.durationCarouselMultipleItemsAutoplayTimeout,
			smartSpeed: 500,
			responsive:{
				0:{
					items: 1,
					loop: param.carouselMultipleItemsCount > 1,
					dots: param.carouselMultipleItemsCount > 1,
				},
				768:{
					items: (param.carouselMultipleItemsCount>=1 && param.carouselMultipleItemsCount<=param.teamMaxCol) ? param.carouselMultipleItemsCount : param.teamMaxCol,
					loop: param.carouselMultipleItemsCount > 1,
					dots: (param.carouselMultipleItemsCount > param.teamMaxCol) ? true : false,
				},
			}
		});

		$('.carousel-related-items').owlCarousel({
			margin:0,
			nav:false,
			autoplayTimeout: param.durationCarouselRelatedItemsAutoplayTimeout,
			smartSpeed: 500,
			responsive:{
				0:{
					center: false,
					items: 1,
					loop: false,
					dots: param.carouselRelatedItemsCount > 1,
					autoplay: param.carouselRelatedItemsCount > 1,
				},
				600:{
					center: false,
					items: (param.carouselRelatedItemsCount>=1 && param.carouselRelatedItemsCount<=2) ? param.carouselRelatedItemsCount : 2,
					loop: param.carouselRelatedItemsCount > 2,
					dots: param.carouselRelatedItemsCount > 2,
					autoplay: param.carouselRelatedItemsCount > 2,
				},
				768:{
					center: param.carouselRelatedItemsCount > 3,
					items: (param.carouselRelatedItemsCount>=1 && param.carouselRelatedItemsCount<=3) ? param.carouselRelatedItemsCount : 3,
					loop: param.carouselRelatedItemsCount > 1,
					dots: param.carouselRelatedItemsCount > 3,
					autoplay: param.carouselRelatedItemsCount > 3,
				},
			}
		});

		// Use high resolution YouTube thumbnails
		$('.owl-carousel .owl-video-tn').each(function(index, el) {
			var $el = $(el),
				defaultImgPath = $el.css('background-image');

			defaultImgPath = defaultImgPath.substring(4, defaultImgPath.length-1);
			defaultImgPath = defaultImgPath.replace(/"/g, '');

			var highResImgPath = defaultImgPath.replace('hqdefault','maxresdefault'),
				highResImg = new Image();
			
			highResImg.onload = function () {
				$el.css('background-image', 'url("'+this.src+'")');
			};
			highResImg.onerror = function () {
				// High resolution thumbnail does not exist
				console.log('No high resolution thumbnail available.');
			};

			highResImg.src = highResImgPath;
		});
	}



	/*
	 * Activations
	 */

	// WOW array
	function activateWowArray ($scope) {
		if ($scope === undefined) $scope = $('body');
		$scope.find('.wow-array').each(function(index, el) {
			var $el = $(el),
				animation = $el.data('wow-array-animation'),
				offset = $el.data('wow-array-offset');

			if (animation === undefined) animation = param.animationItemArray;
			if (animation === 'no-animation') return;
			if (offset === undefined) offset = '0';
			
			$el.children().each(function(i, e) {
				var $e = $(e);
				$e.addClass('wow').addClass(animation)
					.attr('data-wow-delay', 0.1*i + 's')
					.attr('data-wow-offset', offset);
			});
		});
	}

	// Parallax
	function activateParallax ($scope) {
		if ($scope === undefined) $scope = $('body');
		$scope.find('.parallax').attr({
			'data-top-bottom': param.animationParallaxInitial,
			'data-bottom-top': param.animationParallaxFinal
		});
		s.refresh();
	}

	// Magnific Popup
	$('.popup-img').magnificPopup({
		type: 'image',
		closeOnContentClick: true,
		mainClass: 'mfp-img-mobile',
		image: {
			verticalFit: true
		}
	});

	$('.popup-iframe').magnificPopup({
		disableOn: 700,
		type: 'iframe',
		mainClass: 'mfp-fade',
		removalDelay: 160,
		preloader: false,
		fixedContentPos: false
	});
	
	function activateMfpGalleryImgs ($scope) {
		if ($scope === undefined) $scope = $('body');

		if (checkRequiredScript('magnific-popup')){
			$scope.find('.mfpGalleryImgs').each(function(index, el) {
				var $el = $(el),
				imgs = $el.data('mfp-imgs'),
				items = [];

				imgs = imgs.split(',');

				$.each(imgs, function(index, val) {
					if (val !== ''){
						items.push({src: val});
					}
				});

				$el.magnificPopup({
					items: items,
					gallery: {
						enabled: true
					},
					type: 'image',
				});
			});
		}
	}
	
	function activateMfpGalleryVideos ($scope) {
		if ($scope === undefined) $scope = $('body');

		if (checkRequiredScript('magnific-popup')){
			$scope.find('.mfpGalleryVideos').each(function(index, el) {
				var $el = $(el),
				videos = $el.data('mfp-videos'),
				items = [];

				videos = videos.split(',');

				$.each(videos, function(index, val) {
					if (val !== ''){
						items.push({src: val});
					}
				});

				$el.magnificPopup({
					items: items,
					gallery: {
						enabled: true
					},
					type: 'iframe'
				});
			});
		}
	}

	function activateBlogGalleries ($scope) {
		if ($scope === undefined) $scope = $('body');

		if (checkRequiredScript('owl-carousel')){
			$scope.find('.carousel-blog-gallery').owlCarousel({
				stagePadding: 0,
				center:true,
				items:1,
				loop:true,
				margin:0,
				nav:true,
				dots:false,
				autoplay:true,
				autoplayTimeout: param.durationCarouselBlogGalleryAutoplayTimeout,
				smartSpeed: 500,
				autoplayHoverPause:true,
				video:true,
			});
		}
	}

	function activateEmbeddedVideos ($scope) {
		if ($scope ===  undefined) $scope = $('body');

		if (checkRequiredScript('tube')){
			$scope.find('.embed-youtube').each(function(index, el) {
				var $el = $(el),
					videoURL = $el.data('video-url'),
					i = videoURL.indexOf('v=');

				if (i === -1) return;

				videoURL = videoURL.substring(i+2);
				if (videoURL === '') return;

				var j = videoURL.indexOf('&');
				if (j > -1) videoURL = videoURL.substring(0, j);

				$el.tubeplayer({
					width: 600, // the width of the player
					height: 450, // the height of the player
					allowFullScreen: "true", // true by default, allow user to go full screen
					initialVideo: videoURL, // the video that is loaded into the player
					preferredQuality: "default",// preferred quality: default, small, medium, large, hd720
					onPlayerPlaying: embedOnPlay,
					onPlayerEnded: embedOnEnd,
					showControls: false,
					iframed: true,
				});
			});
		}

		if (checkRequiredScript('vimeo-api')){
			$scope.find('.embed-vimeo iframe').on('play', embedOnPlay).on('finish', embedOnEnd);
		}
	}



	/*
	 * Google Maps
	 */

	if (checkRequiredScript('color') && checkRequiredScript('gmaps-api') && checkRequiredScript('google-maps')){
		var primaryColor = $.Color($('.section-heading h2+p').css('color'));

		var googleMapsSettings = {
			styled: param.styled,
			latitude: param.latitude,
			longitude: param.longitude,
			zoom: param.zoom,
			gamma: param.gamma,
			saturation: param.saturation,
			lightness: param.lightness,
			invertLightness: param.invertLightness,
			infoWindowContentString: param.infoWindowContentString,
			disableDefaultUI: param.disableDefaultUI,
			scrollwheel: param.scrollwheel,
			hue: primaryColor.toRgbaString(),
			markerIcon: param.markerIcon,
			markerAnimation: param.markerAnimation
		};

		var mapCanvas = $('#map-canvas');
		if (mapCanvas.length > 0){
			mapCanvas.googleMaps(googleMapsSettings);
		}
	}

	



	/*
	 * Portfolio
	 */

	var $portfolioList = $('.portfolio-list');

	if (checkRequiredScript('isotope')){
		$portfolioList.isotope({
			iitemSelector: 'li',
			layoutMode: 'masonry',
			masonry: {
				columnWidth: 'li:not(.width-two-fourths):not(.width-three-fourths):not(.width-two-thirds):not(.full-width)',
			}
		});

		$('.portfolio-cats').on( 'click', 'a', function(e) {
			var $this = $(this),
			filterValue = $this.attr('data-filter');

			e.preventDefault();
			$portfolioList.isotope({ filter: filterValue });
			$('.portfolio-cats a').removeClass('current') ;
			$this.addClass('current');
		});
	}

	if (Modernizr.touch){
		$('.hover-effect-move-right a').each(function(index, el) {
			var $el = $(el);
			$el.on('click', function (e) {
				e.preventDefault();
			});

			var tapLink = new Hammer(el);
			tapLink.on('tap', function (e) {
				if (!$el.hasClass('mfpGalleryImgs') && !$el.hasClass('mfpGalleryVideos')){
					setTimeout(function () {
						window.location.href = $el.attr('href');
					}, 1000);
				}
			});
		});
	}



	/*
	 * Blog
	 */

	// Blog list
	var $blogList = $('.blog-list');

	if (checkRequiredScript('isotope')){
		$blogList.isotope({
			iitemSelector: '.blog-item',
			layoutMode: 'masonry',
			masonry: {
				"gutter": 23,
			}
		});
	}

	// Handling Embedded YouTube Videos
	function embedOnPlay () {
		var $postWrapper = $(this).parents('.post-wrapper'),
			$embed = $postWrapper.find('.embed-responsive'),
			$postInfoDate = $postWrapper.find('.post-info-date');

		$embed.addClass('playing');
		$postInfoDate.fadeOut();
	}

	function embedOnEnd () {
		var $postWrapper = $(this).parents('.post-wrapper'),
			$embed = $postWrapper.find('.embed-responsive'),
			$postInfoDate = $postWrapper.find('.post-info-date');

		$embed.removeClass('playing');
		$postInfoDate.fadeIn();
	}



	/*
	 * Refresh isotope after several seconds
	 */

	function refreshIsotope () {
		if (checkRequiredScript('isotope')){
			setTimeout(function () {
				$portfolioList.isotope('reloadItems').isotope();
				$blogList.isotope('reloadItems').isotope();
			}, 3000);
		}
	}



	/*
	 * jScroll: infinite scrolling for portfolio and blog
	 */

	if (checkRequiredScript('jscroll')){
		$('.infinite-scroll').jscroll({
			autoTrigger: true,
			loadingHtml: '<p style="position:relative;height:0;text-align:center;"><i class="fa '+ param.miscLoadingFaIcon +' fa-spin fa-custom-lg" style="position:relative;top:10px;"></i></p>',
			padding: 20,
			nextSelector: 'a.jscroll-next:last',
			contentSelector: '.jscroll-to-add',
			callback: function () {
				var $jScrollAdded = $('.jscroll-added');
				$jScrollAdded.find('.img-bg-cover').imgBgCover();
				$jScrollAdded.find('.clickable-block').clickableBlock();
				activateEmbeddedVideos($jScrollAdded);
				activateBlogGalleries($jScrollAdded);
				activateMfpGalleryImgs($jScrollAdded);
				activateMfpGalleryVideos($jScrollAdded);
				activateWowArray($jScrollAdded);
				activateParallax($jScrollAdded);
				wow.sync();

				if ($blogList.length > 0){
					var $itemAdded = $jScrollAdded.find('.blog-item').appendTo($blogList);
					$blogList.isotope( 'insert', $itemAdded );
					refreshIsotope();
				}
				else if ($portfolioList.length > 0){
					var $liAdded = $jScrollAdded.find('li').appendTo($portfolioList);
					$portfolioList.isotope( 'insert', $liAdded );
				}

				$jScrollAdded.find('ul').remove();
			}
		});
	}



	/*
	 * Custom JS
	 */
	param.customJS();

	function startAnimations () {
		// Wow.js
		if (checkRequiredScript('wow')){
			wow = new WOW(
			{
				animateClass: 'animated',
			}
			);
			wow.init();
		}

		// Counter-Up
		if (checkRequiredScript('waypoints') && checkRequiredScript('counterup')){
			$('.counter').counterUp({
				delay: 10,
				time: 1000
			});
		}
	}

	setTimeout(function () {
		activateWowArray();
		activateParallax();
		activateMfpGalleryImgs();
		activateMfpGalleryVideos();
		activateBlogGalleries();
		activateEmbeddedVideos();
		refreshIsotope();

		var $preloader = $('.preloader');
		if ($preloader.length > 0){
			$preloader.fadeOut('default', function () {
				startAnimations();
			});
		} else{
			startAnimations();
		}
		
	}, 200);
}