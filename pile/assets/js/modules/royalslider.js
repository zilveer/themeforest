/* --- Royal Slider Init --- */

function royalSliderInit($container) {
	$container = typeof $container !== 'undefined' ? $container : $('body');

	// Transform Wordpress Galleries to Sliders
	$container.find('.wp-gallery').each(function () {
		sliderMarkupGallery($(this));
	});

	// Find and initialize each slider
	$container.find('.js-pixslider').each(function () {

		var $slider = $(this);

		if ( $slider.children().length < 2 ) {
			return;
		}

		sliderInit($slider);

		var slider = $slider.data('royalSlider');

		var firstSlide 			= slider.slides[0],
			firstSlideContent 	= $(firstSlide.content),
			$video 				= firstSlideContent.hasClass('video') ? firstSlideContent : firstSlideContent.find('.video'),
			firstSlideAutoPlay 	= typeof $video.data('video_autoplay') !== "undefined";


		var lastSlide = slider.currSlideId;

		if ( $slider.closest('.js-hero').length ) {
			// autoplay the first slide
			firstSlide.holder.on('rsAfterContentSet', function () {
				if ( firstSlideAutoPlay ) {
					slider.playVideo();
				}
			});

			var $video = $(firstSlide.holder).find('video');
			if ($video.length) {
				$video.get(0).play();
			}

			slider.ev.on('rsBeforeAnimStart', function(event) {
				requestAnimationFrame(Parallax.initialize);

				$('.slider-arrows-header').addClass('is--inactive');
				setTimeout(function() {
					$('.slider-arrows-header').removeClass('is--inactive');
				}, 1000);

				var $slide = slider.currSlide.holder,
					slideWidth = $slide.width(),
					move = 300,
					direction = 1;

				$(slider.slides).each(function(i, obj) {
					$(obj.holder).css('z-index', 1);
				});

				$slide.css('z-index', 2);

				if (lastSlide == slider.currSlideId - 1 || (lastSlide == slider.slides.length - 1) && slider.currSlideId === 0) {
					direction = -1;
				}

				var $lastSlide = $(slider.slides[lastSlide].holder),
					$lastVideo = $lastSlide.find('video'),
					$video = $slide.find('video');

				if ( $video.length ) {
					if ( isiPhone ) {
						makeVideoPlayableInline( $video.get(0), /* hasAudio */ false);
					}
					$video.get(0).play();
				}

				TweenMax.to($slide.find('.hero-content'), 0, {x: 0, ease: Quart.easeInOut});
				TweenMax.fromTo($slide, 1, {x: slideWidth * direction * -1}, {x: 0, ease: Quart.easeInOut});
				TweenMax.fromTo($slide.children(), 1, {x: (slideWidth - move) * direction}, {x: 0, ease: Quart.easeInOut});

				TweenMax.fromTo($slide.find('.hero-content'), 1, {x: move * direction}, {x: 0, ease: Quart.easeInOut});

				TweenMax.to($slide.find('.hero-content'), 0, {opacity: 0, ease: Quad.easeOut});
				setTimeout(function() {
					TweenMax.to($slide.find('.hero-content'), .5, {opacity: 1, ease: Quad.easeOut});
				}, 900);

				TweenMax.to($lastSlide, 1, {x: move * direction, ease: Quart.easeInOut});
				TweenMax.fromTo($lastSlide.find('.hero-content'), 1, {x: 0}, {x: move * direction * -1, ease: Quart.easeInOut});

				lastSlide = slider.currSlideId;

				slider.stopVideo();
			});

			slider.ev.on('rsAfterSlideChange', function(event) {

				var $slide_content 		= $(slider.currSlide.content),
					$video 				= $slide_content.hasClass('video') ? $slide_content : $slide_content.find('.video'),
					rs_videoAutoPlay 	= typeof $video.data('video_autoplay') !== "undefined";

				//autoplay videos on slide change
				if ( rs_videoAutoPlay || ieMobile || iOS || android ) {
					slider.stopVideo();
					slider.playVideo();
				}
			});
		}

		// after destroying a video remove the autoplay class (this way the image gets visible)
		slider.ev.on('rsOnDestroyVideoElement', function(i ,el){

			var $slide_content 		= $( this.currSlide.content),
				$video 				= $slide_content.hasClass('video') ? $slide_content : $slide_content.find('.video');

			$video.removeClass('video_autoplay');

		});

	});

}

/*
 * Slider Initialization
 */
function sliderInit($slider) {
	if (globalDebug) {
		console.log("Royal Slider Init");
	}

	$slider.find('img').removeClass('invisible');

	var $children                   = $slider.children(),
		rs_arrows                   = typeof $slider.data('arrows') !== "undefined",
		rs_bullets                  = typeof $slider.data('bullets') !== "undefined" ? "bullets" : "none",
		rs_autoheight               = typeof $slider.data('autoheight') !== "undefined",
		rs_autoScaleSlider          = false,
		rs_autoScaleSliderWidth     = typeof $slider.data('autoscalesliderwidth') !== "undefined" && $slider.data('autoscalesliderwidth') != '' ? $slider.data('autoscalesliderwidth') : false,
		rs_autoScaleSliderHeight    = typeof $slider.data('autoscalesliderheight') !== "undefined" && $slider.data('autoscalesliderheight') != '' ? $slider.data('autoscalesliderheight') : false,
		rs_customArrows             = typeof $slider.data('customarrows') !== "undefined",
		rs_slidesSpacing            = typeof $slider.data('slidesspacing') !== "undefined" ? parseInt($slider.data('slidesspacing')) : 0,
		rs_keyboardNav              = typeof $slider.data('fullscreen') !== "undefined",
		rs_imageScale               = $slider.data('imagescale'),
		rs_visibleNearby            = typeof $slider.data('visiblenearby') !== "undefined",
		rs_imageAlignCenter         = typeof $slider.data('imagealigncenter') !== "undefined",
		//rs_imageAlignCenter = false,
		rs_transition               = typeof $slider.data('slidertransition') !== "undefined" ? $slider.data('slidertransition') : 'fade',
		rs_transitionSpeed          = 1000,
		rs_autoPlay                 = typeof $slider.data('sliderautoplay') !== "undefined",
		rs_delay                    = typeof $slider.data('sliderdelay') !== "undefined" && $slider.data('sliderdelay') != '' ? parseFloat($slider.data('sliderdelay')) * 1000 : '1000',
		rs_drag                     = true,
		rs_globalCaption            = typeof $slider.data('showcaptions') !== "undefined",
		is_headerSlider             = $slider.hasClass('hero-slider') ? true : false,
		hoverArrows                 = typeof $slider.data('hoverarrows') !== "undefined";

	if (rs_autoheight) {
		rs_autoScaleSlider = false;
		rs_imageScale = 'none';
		rs_imageAlignCenter = false;
	} else {
		rs_autoheight = false;
		rs_autoScaleSlider = true;
	}

	// Single slide case
	if ($children.length == 1) {
		rs_arrows = false;
		rs_bullets = 'none';
		rs_keyboardNav = false;
		rs_drag = false;
		rs_customArrows = false;
	}

	// make sure default arrows won't appear if customArrows is set
	if (rs_customArrows) rs_arrows = false;

	//the main params for Royal Slider
	var royalSliderParams = {
		autoHeight: rs_autoheight,
		autoScaleSlider: rs_autoScaleSlider,
		loop: true,
		navigateByClick: false,
		autoScaleSliderWidth: rs_autoScaleSliderWidth,
		autoScaleSliderHeight: rs_autoScaleSliderHeight,
		imageScaleMode: rs_imageScale,
		imageAlignCenter: rs_imageAlignCenter,
		slidesSpacing: rs_slidesSpacing,
		arrowsNav: rs_arrows,
		controlNavigation: rs_bullets,
		keyboardNavEnabled: rs_keyboardNav,
		arrowsNavAutoHide: false,
		sliderDrag: rs_drag,
		transitionType: rs_transition,
		transitionSpeed: rs_transitionSpeed,
		imageScalePadding: 0,
		autoPlay: {
			enabled: rs_autoPlay,
			stopAtAction: true,
			pauseOnHover: true,
			delay: rs_delay
		},
		globalCaption: rs_globalCaption,
		numImagesToPreload: 2,
		video: {
			// video options go here
			autoHideArrows: false,
			autoHideControlNav: false,
			autoHideBlocks: false
		}
	};

	if (rs_visibleNearby) {
		royalSliderParams['visibleNearby'] = {
			enabled: true,
			center: true,
			breakpoint: 0,
			//breakpointCenterArea: 0.64,
			navigateByCenterClick: false
		}
	}

	//lets fire it up
	$slider.royalSlider(royalSliderParams);

	var royalSlider = $slider.data('royalSlider' ),
		slidesNumber = royalSlider.numSlides;

	// create the markup for the customArrows
	//don't need it if we have only one slide
	if (royalSlider && rs_customArrows && slidesNumber > 1 ) {

		var classes = '';

		if (is_headerSlider) classes = 'slider-arrows-header';
		if (hoverArrows && !Modernizr.touch) classes += ' arrows--hover ';

		var $gallery_control = $(
			'<div class="' + classes + '">' +
			'<div class="rsArrow rsArrowLeft js-arrow-left" style="display: block;"><div class="rsArrowIcn"></div></div>' +
			'<div class="rsArrow rsArrowRight js-arrow-right" style="display: block;"><div class="rsArrowIcn"></div></div>' +
			'</div>'
		);

		if ($slider.data('customarrows') == "left") {
			$gallery_control.addClass('gallery-control--left');
		}

		$gallery_control.insertBefore($slider);

		$gallery_control.on('click', '.js-arrow-left', function (event) {
			event.preventDefault();
			royalSlider.prev();
		});

		$gallery_control.on('click', '.js-arrow-right', function (event) {
			event.preventDefault();
			royalSlider.next();
		});

		if (hoverArrows && !Modernizr.touch) {
			hoverArrow( $('.slider-arrows-header .rsArrow') );
		}
	}

	$slider.find('.rsNav').insertAfter($slider);

	setTimeout(function() {
		$slider.closest('.hero').addClass('slider--loaded');
	}, 10);
}

/*
 * Wordpress Galleries to Sliders
 * Create the markup for the slider from the gallery shortcode
 * take all the images and insert them in the .gallery <div>
 */
function sliderMarkupGallery($gallery) {
	var $old_gallery = $gallery,
		gallery_data = $gallery.data(),
		$images = $old_gallery.find('img'),
		$new_gallery = $('<div class="pixslider js-pixslider">');

	$images.prependTo($new_gallery).addClass('rsImg');

	//add the data attributes
	$.each(gallery_data, function (key, value) {
		$new_gallery.attr('data-' + key, value);
	});

	$old_gallery.replaceWith($new_gallery);
}

/*
 Get slider arrows to hover, following the cursor
 */

function hoverArrow($arrow) {
	var $mouseX = 0, $mouseY = 0;
	var $arrowH = 35, $arrowW = 35;

	$arrow.mouseenter(function (e) {
		$(this).addClass('visible');

		moveArrow($(this));
	});

	var $loop;

	function moveArrow($arrow) {
		var $mouseX;
		var $mouseY;

		$arrow.mousemove(function (e) {
			$mouseX = e.pageX - $arrow.offset().left - 40;
			$mouseY = e.pageY - $arrow.offset().top - 40;

			var $arrowIcn = $arrow.find('.rsArrowIcn');
			TweenMax.to($arrowIcn, 0, {x: $mouseX, y: $mouseY, z: 0.01});
		});

		$arrow.mouseleave(function (e) {
			$(this).removeClass('visible').removeClass('is--scrolled');
			clearInterval($loop);
		});

		$(window).scroll(function() {
			if($arrow.hasClass('visible')){

				$arrow.addClass('is--scrolled');

				clearTimeout($.data(this, 'scrollTimer'));
				$.data(this, 'scrollTimer', setTimeout(function() {
					$arrow.removeClass('is--scrolled');
				}, 100));
			}
		});
	}
}