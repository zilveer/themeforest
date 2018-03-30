var $j = jQuery.noConflict();
var $scroll = 0;
var $scrollEnd = 0;
var $scroll_direction;
var $window_width = $j(window).width();
var $window_height = $j(window).height();
var logo_height;
var menu_dropdown_height_set = false;
var sticky_amount = 0;
var content_menu_position;
var content_menu_top;
var content_menu_top_add = 0;
var src;
var next_image;
var prev_image;
var $top_header_height;

if (typeof paspartu_width_init === "undefined") {
	var paspartu_width_init = 0.02;
}
var paspartu_width;



var min_w = 1500; // minimum video width allowed
var video_width_original = 1280;  // original video dimensions
var video_height_original = 720;
var vid_ratio = 1280/720;
var skrollr_slider;

if($j('.portfolio_single_sticky').length){
	var stickyInfoTopOffset;
	var stickyInfoHeight;
}



$j(document).ready(function() {
	"use strict";

	$j('.content').css('min-height',$j(window).height()-$j('header.page_header').height()-$j('footer').height());

	if($j('header').hasClass('regular')){
		content_menu_top = 0;
	}
	if($j('header').hasClass('fixed')){
		content_menu_top = min_header_height_scroll;
	}
	if($j('header').hasClass('stick') || $j('header').hasClass('stick_with_left_right_menu')){
		content_menu_top = 0;
	}
	if((!$j('header.page_header').hasClass('scroll_top')) && ($j('header.page_header').hasClass('has_top')) && ($j('header.page_header').hasClass('fixed'))){
		content_menu_top_add = 33;
	}
	if($j('body').hasClass('vertical_menu_enabled')){
		content_menu_top = 0;
		content_menu_top_add = 0;
		var min_header_height_sticky = 0;
	}

	//check paspartu width depending on window size
	paspartu_width = $window_width < 1024 ? 0.02 : paspartu_width_init;


	contentMinHeightWithPaspartu();

	setDropDownMenuPosition();
	initDropDownMenu();
	initVerticalMenuToggle();
	initVerticalMobileMenu();
	initQodeSlider();
	initSideMenu();
	initPopupMenu();
	initMessageHeight();
	initToCounter();
	initCounter();
	initCountdown();
	initProgressBars();
	initListAnimation();
	initPieChart();
	initPieChartWithIcon();
	initParallaxTitle();
	initSideAreaScroll();
	initVerticalAreaMenuScroll();
	loadMore();
	qodefPortfolioFullScreenSlider().init();
	prettyPhoto();
	initMobileMenu();
	initFlexSlider();
	fitVideo();
	fitAudio();
	initAccordion();
	initAccordionContentLink();
	initMessages();
	initProgressBarsIcon();
	initMoreFacts();
	placeholderReplace();
	backButtonShowHide();
	backToTop();
	initProgressBarsVertical();
	initElementsAnimation();
	updateShoppingCart();
	initHashClick();
	initImageHover();
	initIconWithTextAnimation();
	initVideoBackground();
	initCheckSafariBrowser();
	initCheckFirefoxMacBrowser();
	initSearchButton();
	initCoverBoxes();
	createContentMenu();
	contentMenuScrollTo();
	createSelectContentMenu();
	initButtonHover();
	initSocialIconHover();
	initIconHover();
	alterWPMLSwitcherHeaderBottom();
	intPortfolioOWLSlider();
	intCarouselOWLSlider();


	$j('.widget #searchform').mousedown(function(){$j(this).addClass('form_focus');}).focusout(function(){$j(this).removeClass('form_focus');});
	$scroll = $j(window).scrollTop();
	checkTitleToShowOrHide(); //this has to be after setting $scroll since function uses $scroll variable
	checkVerticalMenuTransparency(); //this has to be after setting $scroll since function uses $scroll variable

	/* set header and content menu position and appearance on page load - START */
	if($j(window).width() > 1000){
		headerSize($scroll);
	}else{
		logoSizeOnSmallScreens();
	}

	$j('header:not(.stick_with_left_right_menu) .q_logo a').css('visibility','visible');
	/* set header and content menu position and appearance on page load - END */

	if($j(window).width() > 768){
		contentMenuPosition();
	}
	contentMenuCheckLastSection();

	initFullScreenTemplate();
});

$j(window).load(function(){
	"use strict";

	$j('.touch .main_menu li:has(div.second)').doubleTapToGo(); // load script to close menu on touch devices
	setDropDownMenuPosition();
	initDropDownMenu();
	initPortfolio();
	initPortfolioZIndex();
	initPortfolioSingleInfo();
	initTestimonials();
	initTwitterShortcode();
	initVideoBackgroundSize();
	initBlog();
	initBlogMasonryFullWidth();
	initBlogChequered();
	initPortfolioMasonry();
	//initPortfolioMasonryFilter();
	initPortfolioSingleMasonry();
	initTabs();
	animatedTextIconHeight();
	countAnimatedTextIconPerRow();
	initTitleAreaAnimation();
	setContentBottomMargin();
	footerWidth();
	initPortfolioJustifiedGallery();


	if($j('nav.content_menu').length > 0){
		content_menu_position = $j('nav.content_menu').offset().top;
		contentMenuPosition();
	}
	contentMenuCheckLastSection();
	initQodeCarousel();
	initPortfolioSlider();
	setFooterHeight();

	stickyInfoPortfolioWidth();

	if($j('.portfolio_single_sticky').length){
		stickyInfoTopOffset = $j('.portfolio_single_sticky').offset().top;
		stickyInfoHeight = $j('.portfolio_single_sticky').height();
	}
	if($j(window).width() > 600){
		stickyInfoPortfolio($scroll, stickyInfoTopOffset, stickyInfoHeight);
	}
	removeStickyInfoPortfolioClass();



	$j('header.stick_with_left_right_menu .q_logo a').css('visibility','visible');

	if($j('.portfolio_justified_gallery').length) {
		$j('.portfolio_justified_gallery').css('opacity', '1');
	}

	setMargingsForLeftAndRightMenu();
	initImageGallerySliderNoSpace();
	initParallax(); //has to be here on last place since some function is interfering with parallax
	setTimeout(function(){
		checkAnchorOnScroll();
		checkAnchorOnLoad(); // it has to be after content top margin initialization to know where to scroll
	},700); //timeout is set because of some function that interferes with calculating
});

$j(window).scroll(function() {
	"use strict";

	$scroll = $j(window).scrollTop();
	if ($scroll > $scrollEnd) {
		$scroll_direction = 'down';
	}
	else {
		$scroll_direction = 'up';
	}
	$scrollEnd = $scroll;
	if($j(window).width() > 1000){
		headerSize($scroll);
	}

	if($j(window).width() > 768){
		contentMenuPosition();
	}
	contentMenuCheckLastSection();
	checkVerticalMenuTransparency();

	if($j(window).width() > 600){
		stickyInfoPortfolio($scroll, stickyInfoTopOffset, stickyInfoHeight);
	}

	$j('.touch .drop_down > ul > li').mouseleave();
	$j('.touch .drop_down > ul > li').blur();
});

$j(window).resize(function() {
	"use strict";

	$window_width = $j(window).width();
	$window_height = $j(window).height();

	//check paspartu width depending on window size
	paspartu_width = $window_width < 1024 ? 0.02 : paspartu_width_init;

	if($j(window).width() > 1000){
		headerSize($scroll);
	}else{
		logoSizeOnSmallScreens();
	}
	stickyInfoPortfolioWidth();
	if($j(window).width() > 600){
		stickyInfoHeight = $j('.portfolio_single_sticky').height();
		stickyInfoPortfolio($scroll, stickyInfoTopOffset, stickyInfoHeight);
	}
	removeStickyInfoPortfolioClass();
	intCarouselOWLSlider();
	initMessageHeight();
	initTestimonials();
	initTwitterShortcode();
	fitAudio();
	initBlog();
	initBlogMasonryFullWidth();
	initPortfolioSingleMasonry();
	initBlogChequered();
	animatedTextIconHeight();
	countAnimatedTextIconPerRow();
	initVideoBackgroundSize();
	setContentBottomMargin();
	footerWidth();
	setFooterHeight();
	calculateHeights();
});

/*
 **	Calculating header size on page load and page scroll
 */
var sticky_animate;
function headerSize($scroll){
	"use strict";

	if(($j('header.page_header').hasClass('scroll_top')) && ($j('header.page_header').hasClass('has_top')) && ($j('header.page_header').hasClass('fixed'))){
		if($scroll >= 0 && $scroll <= 33){
			$j('header.page_header').css('top',-$scroll);
			$j('header.page_header').css('margin-top',0);
			$j('.header_top').show();
		}else if($scroll > 33){
			$j('header.page_header').css('top','-33px');
			$j('header.page_header').css('margin-top',33);
			$j('.header_top').hide();
		}
	}

	//is scroll amount for sticky set on page?
	if(typeof page_scroll_amount_for_sticky !== 'undefined') {
		sticky_amount = page_scroll_amount_for_sticky;
	}
	//do we have slider on the page?
	else if($j('.carousel.full_screen').length) {
		sticky_amount = $j('.carousel').height();
	}

	//take value from theme options
	else {
		sticky_amount = scroll_amount_for_sticky;
	}

	if($j('header').hasClass('regular')){
		if(header_height - logo_height > 0){
			$j('.q_logo a').height(logo_height);
		}else{
			$j('.q_logo a').height(header_height);
		}

		$j('.q_logo a img').css('height','100%');
	}

	if($j('header.page_header').hasClass('fixed')){
		if($j('header.page_header').hasClass('scroll_top')){
			$top_header_height = 33;
		}else{
			$top_header_height = 0;
		}

		if((header_height - $scroll + $top_header_height >= min_header_height_scroll) && ($scroll >= $top_header_height)){
			$j('header.page_header').removeClass('scrolled');
			$j('header:not(.centered_logo.centered_logo_animate) nav.main_menu > ul > li > a').css('line-height', header_height - $scroll + $top_header_height+'px');
			$j('header:not(.centered_logo.centered_logo_animate) .side_menu_button').css('height', header_height - $scroll + $top_header_height+'px');
			$j('header:not(.centered_logo.centered_logo_animate) .shopping_cart_inner').css('height', header_height - $scroll + $top_header_height+'px');
			$j('header:not(.centered_logo.centered_logo_animate) .logo_wrapper').css('height', header_height - $scroll + $top_header_height +'px');
			if(header_height - logo_height > 0){
				$j('header:not(.centered_logo.centered_logo_animate) .q_logo a').css('height', logo_height +'px');
			}else{
				$j('header:not(.centered_logo.centered_logo_animate) .q_logo a').css('height', (header_height - $scroll + $top_header_height) +'px');
			}

		}else if($scroll < $top_header_height){
			$j('header.page_header').removeClass('scrolled');
			$j('header:not(.centered_logo.centered_logo_animate) nav.main_menu > ul > li > a').css('line-height', header_height+'px');
			$j('header:not(.centered_logo.centered_logo_animate) .side_menu_button').css('height', header_height+'px');
			$j('header:not(.centered_logo.centered_logo_animate) .shopping_cart_inner').css('height', header_height+'px');
			$j('header:not(.centered_logo.centered_logo_animate) .logo_wrapper').css('height', header_height+'px');
			if(header_height - logo_height > 0){
				$j('header:not(.centered_logo.centered_logo_animate) .q_logo a').css('height', logo_height +'px');
			}else{
				$j('header:not(.centered_logo.centered_logo_animate) .q_logo a').css('height', header_height +'px');
			}

		}else if((header_height - $scroll + $top_header_height) < min_header_height_scroll){
			$j('header.page_header').addClass('scrolled');
			$j('header:not(.centered_logo.centered_logo_animate) nav.main_menu > ul > li > a').css('line-height', min_header_height_scroll+'px');
			$j('header:not(.centered_logo.centered_logo_animate) .side_menu_button').css('height', min_header_height_scroll+'px');
			$j('header:not(.centered_logo.centered_logo_animate) .shopping_cart_inner').css('height', min_header_height_scroll+'px');
			$j('header:not(.centered_logo.centered_logo_animate) .logo_wrapper').css('height', min_header_height_scroll+'px');
			if(min_header_height_scroll - logo_height > 0){
				$j('header:not(.centered_logo.centered_logo_animate) .q_logo a').css('height', logo_height +'px');
			}else{
				$j('header:not(.centered_logo.centered_logo_animate) .q_logo a').css('height', min_header_height_scroll+'px');
			}
		}

		// logo part - start //

		if($j('header.page_header').hasClass('centered_logo') && $j('header.page_header').hasClass('centered_logo_animate')){
			if((header_height - $scroll + $top_header_height < logo_height) && (header_height - $scroll + $top_header_height >= min_header_height_scroll) && (logo_height > min_header_height_scroll) && ($scroll >= $top_header_height)){
				$j('.q_logo a').height(header_height - $scroll + $top_header_height);
			}else if((header_height - $scroll + $top_header_height < logo_height) && (header_height - $scroll + $top_header_height >= min_header_height_scroll) && (logo_height > min_header_height_scroll) && ($scroll < $top_header_height)){
				$j('.q_logo a').height(header_height);
			}else if((header_height - $scroll + $top_header_height < logo_height) && (header_height - $scroll + $top_header_height < min_header_height_scroll) && (logo_height > min_header_height_scroll)){
				$j('.q_logo a').height(min_header_height_scroll);
			}else if((header_height - $scroll + $top_header_height < logo_height) && (header_height - $scroll + $top_header_height < min_header_height_scroll) && (logo_height < min_header_height_scroll)){
				$j('.q_logo a').height(logo_height);
			}else if(($scroll + $top_header_height === 0) && (logo_height > header_height)){
				$j('.q_logo a').height(logo_height);
			}else{
				$j('.q_logo a').height(logo_height);
			}
		}else if($j('header.page_header').hasClass('centered_logo')) {
			$j('.q_logo a').height(logo_height);
			$j('.q_logo img').height('auto');
		}else{
			$j('.q_logo img').height('100%');
		}
		// logo part - end //
	}

	if($j('header.page_header').hasClass('fixed_hiding')){

		if($scroll < scroll_amount_for_fixed_hiding){
			$j('header.page_header').removeClass('scrolled');
		}else{
			$j('header.page_header').addClass('scrolled');
		}

		$j('.q_logo a').height(logo_height/2); //because of retina displays
		$j('.q_logo img').height('100%');
	}

	if($j('header.page_header').hasClass('stick') || $j('header.page_header').hasClass('stick_with_left_right_menu')){
		if($scroll > sticky_amount){
			if(!$j('header.page_header').hasClass('sticky')){
				if($j('header.page_header').hasClass('has_top')){
					$top_header_height = 33;
				}else{
					$top_header_height = 0;
				}
				var padding_top = $j('header.page_header').hasClass('centered_logo') ? $j('header.page_header').height() : header_height + $top_header_height;
				if($j('header.page_header').hasClass('menu_bottom')){
					padding_top = header_height + 60; //60 is menu height for Sticky Advance header type
				}
				$j('header.page_header').addClass('sticky');
				$j('.content').css('padding-top',padding_top);

				window.clearTimeout(sticky_animate);
				sticky_animate = window.setTimeout(function(){$j('header.page_header').addClass('sticky_animate');},100);

				if(min_header_height_sticky - logo_height > 0){
					$j('.q_logo a').height(logo_height);
				}else{
					$j('.q_logo a').height(min_header_height_sticky);
				}

				if($j('header.page_header').hasClass('menu_bottom')){
					initDropDownMenu(); //recalculate dropdown menu position
				}
			}

			if(min_header_height_sticky - logo_height > 0){
				$j('.q_logo a').height(logo_height);
			}else{
				$j('.q_logo a').height(min_header_height_sticky);
			}
			//  logo part - end //
		}else{
			if($j('header.page_header').hasClass('sticky')){
				$j('header').removeClass('sticky_animate');
				$j('header').removeClass('sticky');
				$j('.content').css('padding-top','0px');

				if($j('header.page_header').hasClass('menu_bottom')){
					initDropDownMenu(); //recalculate dropdown menu position
				}
			}

			setMargingsForLeftAndRightMenu();

			// logo part - start //
			if(!$j('header.page_header').hasClass('centered_logo')){
				if(header_height - logo_height > 0){
					$j('.q_logo a').height(logo_height);
				}else{
					$j('.q_logo a').height(header_height);
				}
			}else{
				$j('.q_logo a').height(logo_height);
				$j('.q_logo img').height('auto');
			}
			$j('.q_logo a img').css('height','100%');
			// logo part - end //
		}
	}
}

function setMargingsForLeftAndRightMenu(){
	"use strict";

	if($j('header.page_header').hasClass('stick_with_left_right_menu') && !$j('header.page_header').hasClass('left_right_margin_set')){
		var logo_width = $j('.q_logo a img').width()/2;
		if($scroll === 0 && logo_width !== 0){
			$j('header.page_header').addClass('left_right_margin_set');
		}
		$j('.logo_wrapper').width(logo_width*2);
		$j('nav.main_menu.left_side > ul > li:last-child').css('margin-right',logo_width);
		$j('nav.main_menu.right_side > ul > li:first-child').css('margin-left',logo_width);
	}
}

/*
 **	Calculating logo size on smaller screens
 */
function logoSizeOnSmallScreens(){
	"use strict";

	if(100 - logo_height > 0){
		$j('.q_logo a').height(logo_height);
	}else{
		$j('.q_logo a').height(100);
	}

	$j('.q_logo a img').css('height','100%');

	$j('header.page_header').removeClass('sticky_animate sticky');
	$j('.content').css('padding-top','0px');
}

/*
 **	Initialize Qode Slider
 */
var default_header_style;
function initQodeSlider(){
	"use strict";

	var image_regex = /url\(["']?([^'")]+)['"]?\)/;
	default_header_style = "";
	if($j('header.page_header').hasClass('light')){ default_header_style = 'light';}
	if($j('header.page_header').hasClass('dark')){ default_header_style = 'dark';}

	if($j('.carousel').length){
		$j('.carousel').each(function(){
			var $this = $j(this);
			var mobile_header;

			var paspartu_amount_with_top = $j('.paspartu_top').length > 0 ? Math.round($window_width*paspartu_width ) : 0;
			var paspartu_amount_with_bottom = $j('.paspartu_bottom').length > 0 ? Math.round($window_width*paspartu_width) : 0;

			if($this.hasClass('full_screen')){

				mobile_header = $j(window).width() < 1000 ? $j('header.page_header').height() - 6 : 0; // 6 is because of the display: inline-block
				$this.css({'height': ($j(window).height() - mobile_header - paspartu_amount_with_top - paspartu_amount_with_bottom) + 'px'});
				$this.find('.qode_slider_preloader').css({'height': ($j(window).height() - mobile_header - paspartu_amount_with_top - paspartu_amount_with_bottom) + 'px'});
				$this.find('.qode_slider_preloader .ajax_loader').css({'display': 'block'});
				$this.find('.item').css({'height': ($j(window).height() - mobile_header - paspartu_amount_with_top - paspartu_amount_with_bottom) + 'px'});
				$j(window).resize(function() {
					var mobile_header = $j(window).width() < 1000 ? $j('header.page_header').height() - 6 : 0; // 6 is because of the display: inline-block
					$this.css({'height': ($j(window).height() - mobile_header - paspartu_amount_with_top - paspartu_amount_with_bottom) + 'px'});
					$this.find('.item').css({'height': ($j(window).height() - mobile_header - paspartu_amount_with_top - paspartu_amount_with_bottom) + 'px'});
				});
			}else if($this.hasClass('responsive_height')){
				mobile_header = $j(window).width() < 1000 ? $j('header.page_header').height() - 6 : 0; // 6 is because of the display: inline-block
				var $def_height = $this.data('height');

				$this.find('.qode_slider_preloader').css({'height': ($this.height() - mobile_header - paspartu_amount_with_top - paspartu_amount_with_bottom) + 'px', 'display': 'block'});
				var slider_height = $def_height;
				if($window_width > 1600){
					var slider_height = $def_height;
				}else if($window_width <= 1600 && $window_width > 1300){
					var slider_height = $def_height * 0.8;
				}else if($window_width <= 1300 && $window_width > 1000){
					var slider_height = $def_height * 0.8;
				}else if($window_width <= 1000 && $window_width > 768){
					var slider_height = $def_height * 0.55;
				}else if($window_width <= 768){
					var slider_height = $def_height * 1;
				}

				$this.css({'height': (slider_height) + 'px'});
				$this.find('.qode_slider_preloader').css({'height': (slider_height) + 'px'});
				$this.find('.qode_slider_preloader .ajax_loader').css({'display': 'block'});
				$this.find('.item').css({'height': (slider_height) + 'px'});

				$j(window).resize(function() {

					if($window_width > 1600){
						var slider_height = $def_height;
					}else if($window_width <= 1600 && $window_width > 1300){
						var slider_height = $def_height * 0.8;
					}else if($window_width <= 1300 && $window_width > 1000){
						var slider_height = $def_height * 0.8;
					}else if($window_width <= 1000 && $window_width > 768){
						var slider_height = $def_height * 0.55;
					}else if($window_width <= 768){
						var slider_height = $def_height * 1;
					}

					$this.css({'height': (slider_height) + 'px'});
					$this.find('.item').css({'height': (slider_height) + 'px'});
				});
			}else {
				mobile_header = $j(window).width() < 1000 ? $j('header.page_header').height() - 6 : 0; // 6 is because of the display: inline-block
				$this.find('.qode_slider_preloader').css({'height': ($this.height() - mobile_header) + 'px', 'display': 'block'});
				$this.find('.qode_slider_preloader .ajax_loader').css({'display': 'block'});
			}

			if($j('body:not(.boxed):not(.vertical_menu_transparency)').hasClass('vertical_menu_enabled') && $j(window).width() > 1000){
				var paspartu_add = $j('body').hasClass('paspartu_enabled') ? 2*Math.round($window_width*paspartu_width) : 0; //2 times paspartu (left and right side)
				$this.find('.carousel-inner').width($window_width - 260 - paspartu_add);
				$j(window).resize(function() {
					if($j(window).width() > 1000){
						paspartu_add = $j('body').hasClass('paspartu_enabled') ? 2*Math.round($window_width*paspartu_width) : 0; //2 times paspartu (left and right side)
						$this.find('.carousel-inner').width($window_width - 260 - paspartu_add);
					} else {
						$this.find('.carousel-inner').css('width','100%');
					}
				});
			}

			$j(window).scroll(function() {
				if($scroll > $j(window).height() && $j(window).width() > 1000){
					$this.find('.carousel-inner, .carousel-indicators, button').hide();
				}else{
					$this.find('.carousel-inner, .carousel-indicators, button').show();
				}
			});

			var $slide_animation = $this.data('slide_animation');
			if($slide_animation === ""){
				$slide_animation = 6000;
			}

			// function for setting prev/next numbers on arrows
			var all_items_count = $j('div.item').length;
			function setPrevNextNumbers(curr_item, all_items_count){
				if(curr_item == 1){
					$this.find('.left.carousel-control .prev').html(all_items_count);
					$this.find('.right.carousel-control .next').html(curr_item + 1);
				}else if(curr_item == all_items_count){
					$this.find('.left.carousel-control .prev').html(curr_item - 1);
					$this.find('.right.carousel-control .next').html(1);
				}else{
					$this.find('.left.carousel-control .prev').html(curr_item - 1);
					$this.find('.right.carousel-control .next').html(curr_item + 1);
				}
			}

			function initSlider(){
				//set active class on first item
				$this.find('.carousel-inner .item:first-child').addClass('active');
				checkSliderForHeaderStyle($j('.carousel .active'), $this.hasClass('header_effect'));

				if($this.hasClass('slider_thumbs')){
					// initial state of prev/next numbers
					setPrevNextNumbers(1, all_items_count);

					//set prev and next thumb on load
					if($this.find('.active').next('div').find('.image').length){
						src = image_regex.exec($this.find('.active').next('div').find('.image').attr('style'));
						next_image = new Image();
						next_image.src = src[1];
					}else{
						next_image = $this.find('.active').next('div').find('> .video').clone();
						next_image.find('.video-overlay').remove();
						next_image.find('.video-wrap').width(170).height(95);
						next_image.find('.mejs-container').width(170).height(95);
						next_image.find('video').width(170).height(95);
					}
					$this.find('.right.carousel-control .img').html(next_image).find('img, div.video').addClass('old');

					if($this.find('.carousel-inner .item:last-child .image').length){
						src = image_regex.exec($this.find('.carousel-inner .item:last-child .image').attr('style'));
						prev_image = new Image();
						prev_image.src = src[1];
					}else{
						prev_image = $this.find('.carousel-inner .item:last-child > .video').clone();
						prev_image.find('.video-overlay').remove();
						prev_image.find('.video-wrap').width(170).height(95);
						prev_image.find('.mejs-container').width(170).height(95);
						prev_image.find('video').width(170).height(95);
					}
					$this.find('.left.carousel-control .img').html(prev_image).find('img, div.video').addClass('old');
				}

				if($this.hasClass('q_auto_start')){
					$this.carousel({
						interval: $slide_animation,
						pause: false
					});
				} else {
					$this.carousel({
						interval: 0,
						pause: false
					});
				}
				if($this.find('.item video').length){
					initVideoBackgroundSize();
				}
			}

			if($j('html').hasClass('touch')){
				if($this.find('.item:first-child .mobile-video-image').length > 0){
					src = image_regex.exec($this.find('.item:first-child .mobile-video-image').attr('style'));
					if (src) {
						var backImg = new Image();
						backImg.src = src[1];
						$j(backImg).load(function(){
							$j('.qode_slider_preloader').fadeOut(500);
							initSlider();
						});
					}
				}
				else{
					src = image_regex.exec($this.find('.item:first-child .image').attr('style'));
					if (src) {
						var backImg = new Image();
						backImg.src = src[1];
						$j(backImg).load(function(){
							$j('.qode_slider_preloader').fadeOut(500);
							initSlider();
						});
					}
				}
			} else {
				if($this.find('.item:first-child video').length > 0){
					$this.find('.item:first-child video').get(0).addEventListener('loadeddata',function(){
						$j('.qode_slider_preloader').fadeOut(500);
						initSlider();
					});
				}else{
					src = image_regex.exec($this.find('.item:first-child .image').attr('style'));
					if (src) {
						var backImg = new Image();
						backImg.src = src[1];
						$j(backImg).load(function(){
							$j('.qode_slider_preloader').fadeOut(500);
							initSlider();
						});
					}
				}
			}

			$this.on('slide.bs.carousel', function () {
				$this.addClass('in_progress');
				$this.find('.active .slider_content_outer').fadeTo(800,0);
			});
			$this.on('slid.bs.carousel', function () {
				$this.removeClass('in_progress');
				$this.find('.active .slider_content_outer').fadeTo(0,1);

				if($this.hasClass('slider_thumbs')){
					var curr_item = $j('div.item').index($j('div.item.active')[0]) + 1;
					setPrevNextNumbers(curr_item, all_items_count);

					// prev thumb
					if($this.find('.active').prev('div.item').length){
						if($this.find('.active').prev('div').find('.image').length){
							src = image_regex.exec($this.find('.active').prev('div').find('.image').attr('style'));
							prev_image = new Image();
							prev_image.src = src[1];
						}else{
							prev_image = $this.find('.active').prev('div').find('> .video').clone();
							prev_image.find('.video-overlay').remove();
							prev_image.find('.video-wrap').width(170).height(95);
							prev_image.find('.mejs-container').width(170).height(95);
							prev_image.find('video').width(170).height(95);
						}
						$this.find('.left.carousel-control .img .old').fadeOut(300,function(){
							$j(this).remove();
						});
						$this.find('.left.carousel-control .img').append(prev_image).find('img, div.video').fadeIn(300).addClass('old');

					}else{
						if($this.find('.carousel-inner .item:last-child .image').length){
							src = image_regex.exec($this.find('.carousel-inner .item:last-child .image').attr('style'));
							prev_image = new Image();
							prev_image.src = src[1];
						}else{
							prev_image = $this.find('.carousel-inner .item:last-child > .video').clone();
							prev_image.find('.video-overlay').remove();
							prev_image.find('.video-wrap').width(170).height(95);
							prev_image.find('.mejs-container').width(170).height(95);
							prev_image.find('video').width(170).height(95);
						}
						$this.find('.left.carousel-control .img .old').fadeOut(300,function(){
							$j(this).remove();
						});
						$this.find('.left.carousel-control .img').append(prev_image).find('img, div.video').fadeIn(300).addClass('old');
					}

					// next thumb
					if($this.find('.active').next('div.item').length){
						if($this.find('.active').next('div').find('.image').length){
							src = image_regex.exec($this.find('.active').next('div').find('.image').attr('style'));
							next_image = new Image();
							next_image.src = src[1];
						}else{
							next_image = $this.find('.active').next('div').find('> .video').clone();
							next_image.find('.video-overlay').remove();
							next_image.find('.video-wrap').width(170).height(95);
							next_image.find('.mejs-container').width(170).height(95);
							next_image.find('video').width(170).height(95);
						}

						$this.find('.right.carousel-control .img .old').fadeOut(300,function(){
							$j(this).remove();
						});
						$this.find('.right.carousel-control .img').append(next_image).find('img, div.video').fadeIn(300).addClass('old');

					}else{
						if($this.find('.carousel-inner .item:first-child .image').length){
							src = image_regex.exec($this.find('.carousel-inner .item:first-child .image').attr('style'));
							next_image = new Image();
							next_image.src = src[1];
						}else{
							next_image = $this.find('.carousel-inner .item:first-child > .video').clone();
							next_image.find('.video-overlay').remove();
							next_image.find('.video-wrap').width(170).height(95);
							next_image.find('.mejs-container').width(170).height(95);
							next_image.find('video').width(170).height(95);
						}
						$this.find('.right.carousel-control .img .old').fadeOut(300,function(){
							$j(this).remove();
						});
						$this.find('.right.carousel-control .img').append(next_image).find('img, div.video').fadeIn(300).addClass('old');
					}
				}
			});

			$this.swipe( {
				swipeLeft: function(event, direction, distance, duration, fingerCount){ $this.carousel('next'); },
				swipeRight: function(event, direction, distance, duration, fingerCount){ $this.carousel('prev'); },
				threshold:20
			});

		});

		if($j('.carousel').data('parallax') == 'yes'){
			if ($j('.no-touch .carousel').length) {
				skrollr_slider = skrollr.init({
					edgeStrategy: 'set',
					smoothScrolling: true,
					forceHeight: false
				});
				skrollr_slider.refresh();
			}
		}
	}
}

function checkSliderForHeaderStyle($this, header_effect){
	"use strict";

	var slide_header_style = "";
	if($this.hasClass('light')){ slide_header_style = 'light';}
	if($this.hasClass('dark')){ slide_header_style = 'dark';}

	if( slide_header_style !== ""){
		if(header_effect){
			$j('header.page_header').removeClass('dark light').addClass(slide_header_style);
			$j('aside.vertical_menu_area').removeClass('dark light').addClass(slide_header_style);
		}
		$j('.carousel .carousel-control, .carousel .carousel-indicators').removeClass('dark light').addClass(slide_header_style);
	}else{
		if(header_effect) {
			if(default_header_style !== '') {
				$j('header.page_header').removeClass('dark light').addClass(default_header_style);
				$j('aside.vertical_menu_area').removeClass('dark light').addClass(default_header_style);
			}
		}
		$j('.carousel .carousel-control, .carousel .carousel-indicators').removeClass('dark light').addClass(default_header_style);
	}
}

/*
 ** Set heights for qode carousel and portfolio slider
 */
function calculateHeights(){
	if($j('.portfolio_slides').length){
		$j('.portfolio_slides').each(function(){
			$j(this).parents('.caroufredsel_wrapper').css({'height' : ($j(this).find('li.item').outerHeight()-3) + 'px'}); //3 is because of the white line bellow the slider
		});
	}

	if($j('.qode_carousels .slides').length){
		$j('.qode_carousels .slides').each(function(){
			$j(this).parents('.caroufredsel_wrapper').css({'height' : ($j(this).find('li.item').outerHeight()) + 'px'});
		});
	}
}

/*
 ** Init Qode Carousel
 */
function initQodeCarousel(){
	"use strict";

	if($j('.qode_carousels:not(.carousel_owl)').length){
		$j('.qode_carousels:not(.carousel_owl)').each(function(){
			var instance = this;

			var number_of_items;
			var items_number_set;
			var fullWidth  = (!($j(this).parents('.grid_section').length == 1) && ($j(this).parents('.page-template-full_width').length == 1)) ? true : false;
			if(typeof $j(this).data('number_of_items') !== 'undefined') {
				number_of_items = $j(this).data('number_of_items');
				items_number_set = true;
			}
			else {
				number_of_items = 5;
				items_number_set = false;
			}

			var itemWidth = ($j(this).parents('.grid_section').length == 1) ? 216 : 380;

			var itemWidthTemp;

			if (fullWidth) {
				switch (number_of_items) {
					case 3:
						itemWidthTemp = 660;
						break;
					case 4:
						itemWidthTemp = 500;
						break;
					case 5:
						itemWidthTemp = 380;
						break;
					default:
						itemWidthTemp = 380;

						break;
				}
			}
			else {
				switch (number_of_items) {
					case 3:
						itemWidthTemp = 380;
						break;
					case 4:
						itemWidthTemp = 275;
						break;
					case 5:
						itemWidthTemp = 216;
						break;
					default:
						itemWidthTemp = 216;

						break;
				}
			}

			itemWidth = (items_number_set) ? itemWidthTemp : itemWidth;

			$j(this).find('.slides').carouFredSel({
				circular: true,
				responsive: true,
				scroll : {
					items           : 1,
					duration        : 1000,
					pauseOnHover    : false
				},
				prev : {
					button : function() {
						return $j(this).parent().siblings('.caroufredsel-direction-nav').find('.qode_carousel_prev');
					}
				},
				next : {
					button : function() {
						return $j(this).parent().siblings('.caroufredsel-direction-nav').find('.qode_carousel_next');
					}
				},
				items: {
					width: itemWidth,
					visible: {
						min: 1,
						max: number_of_items
					}
				},
				auto: true,
				mousewheel: false,
				swipe: {
					onMouse: true,
					onTouch: true
				}

			}).animate({'opacity': 1},1000);
		});
		calculateHeights();
	}
}


/*
 **	Init portfolio owl slider
 */
function intCarouselOWLSlider(){
	"use strict";

	if ($j('.qode_carousels.carousel_owl').length) {
		$j('.qode_carousels.carousel_owl').each(function () {
			$j(this).find('.slides').owlCarousel({
				center: true,
				loop: true,
				margin: 0,
				nav: false,
				video: true,
				autoplay:true,
				autoplayTimeout:5000,
				autoplaySpeed:1000,
				autoplayHoverPause:true,
				responsive: {
					0: {
						items: 1,
						stagePadding: 0
					},
					600: {
						items: 2,
						stagePadding: 50
					},
					1100: {
						items: 3,
						stagePadding: 100
					},
					1500: {
						items: 3,
						stagePadding: 200
					}
				}
			}).animate({'opacity': 1}, 600);
		});
	}
}

/*
 ** Init Portfolio Slider
 */
function initPortfolioSlider(){
	"use strict";

	if($j('.portfolio_slider').length){

		$j('.portfolio_slider').each(function(){
			var maxItems = ($j(this).parents('.grid_section').length == 1) ? 3 : 'auto';
			var itemWidth = ($j(this).parents('.grid_section').length == 1) ? 353 : 500;

			$j('.portfolio_slides').carouFredSel({
				circular: true,
				responsive: true,
				scroll: 1,
				prev : {
					button : function() {
						return $j(this).parent().siblings('.caroufredsel-direction-nav').find('#caroufredsel-prev');
					}
				},
				next : {
					button : function() {
						return $j(this).parent().siblings('.caroufredsel-direction-nav').find('#caroufredsel-next');
					}
				},
				items: {
					width: itemWidth,
					visible: {
						min: 1,
						max: maxItems
					}
				},
				auto: false,
				mousewheel: true,
				swipe: {
					onMouse: true,
					onTouch: true
				}
			}).animate({'opacity': 1},1000);
		});

		calculateHeights();

		$j('.portfolio_slider .flex-direction-nav a').click(function(e){
			e.preventDefault();
			e.stopImmediatePropagation();
			e.stopPropagation();
		});
	}
}

/*
 **	Opening side menu on "menu button" click
 */
var current_scroll;
function initSideMenu() {
	"use strict";


	if ($j('body').hasClass('side_area_uncovered')) {
		$j('.side_menu_button_wrapper a.side_menu_button_link,  a.close_side_menu,  a.close_side_menu_fold').click(function (e) {
			e.preventDefault();
			$j('.side_menu').css({'right': '0'});
			if (!$j('.side_menu_button_wrapper a.side_menu_button_link').hasClass('opened')) {
				$j('.side_menu').css({'visibility': 'visible'});
				$j(this).addClass('opened');
				$j('body').addClass('right_side_menu_opened');
				current_scroll = $j(window).scrollTop();

				$j(window).scroll(function () {
					if (Math.abs($scroll - current_scroll) > 400) {
						$j('body').removeClass('right_side_menu_opened');
						$j('.side_menu_button_wrapper a').removeClass('opened');
						var hide_side_menu = setTimeout(function () {
							$j('.side_menu').css({'visibility': 'hidden'});
							clearTimeout(hide_side_menu);
						}, 400);
					}
				});
			} else {
				$j('.side_menu_button_wrapper a.side_menu_button_link').removeClass('opened');
				$j('body').removeClass('right_side_menu_opened');
				var hide_side_menu = setTimeout(function () {
					$j('.side_menu').css({'visibility': 'hidden'});
					clearTimeout(hide_side_menu);
				}, 400);
			}
		});
	}

	if ($j('body').hasClass('side_area_over_content')) {

		$j('.wrapper').prepend('<div class="cover"/>');

		$j('.side_menu_button_wrapper a.side_menu_button_link,  a.close_side_menu,  a.close_side_menu_fold').click(function (e) {
			e.preventDefault();

			if (!$j('.side_menu_button_wrapper a.side_menu_button_link').hasClass('opened')) {
				$j(this).addClass('opened');
				$j('body').addClass('side_area_uncovered_opened');

				$j(' .wrapper .cover').click(function () {
					$j('.side_menu_button_wrapper a.side_menu_button_link').removeClass('opened');
					$j('body').removeClass('side_area_uncovered_opened');
					$j('.side_menu_button_wrapper a').removeClass('opened');
				});
				current_scroll = $j(window).scrollTop();
				$j(window).scroll(function () {
					if (Math.abs($scroll - current_scroll) > 400) {
						$j('body').removeClass('side_area_uncovered_opened');
						$j('.side_menu_button_wrapper a').removeClass('opened');
					}
				});
			} else {
				$j('.side_menu_button_wrapper a.side_menu_button_link').removeClass('opened');
				$j('body').removeClass('side_area_uncovered_opened');
			}
		});

	}

	if ($j('body').hasClass('side_area_slide_with_content')) {
		$j('.side_menu_button_wrapper a.side_menu_button_link,  a.close_side_menu,  a.close_side_menu_fold').click(function (e) {
			e.preventDefault();

			if(!$j('.side_menu_button_wrapper a.side_menu_button_link').hasClass('opened')){
				$j(this).addClass('opened');
				$j('body').addClass('side_menu_open');
				current_scroll = $j(window).scrollTop();
				$j(window).scroll(function() {

					if(Math.abs($scroll - current_scroll) > 400){
						$j('body').removeClass('side_menu_open');
						$j('.side_menu_button_wrapper a').removeClass('opened');
					}
				});
			}else{//hamburger icon has class open on its click
				$j('body').removeClass('side_menu_open');


				$j('.side_menu_button_wrapper a.side_menu_button_link').removeClass('opened');
				$j('body').removeClass('side_menu_open');

			}

			e.stopPropagation();
			$j('.wrapper').click(function() {
				e.preventDefault();
				$j('body').removeClass('side_menu_open');
				$j('.side_menu_button_wrapper a.side_menu_button_link').removeClass('opened');
				$j('body').removeClass('side_menu_open');
			});
		});
	}

}

function setDropDownMenuPosition(){
	"use strict";

	var menu_items = $j(".drop_down > ul > li.narrow");
	menu_items.each( function(i) {

		var browser_width = $j(window).width()-16; // 16 is width of scroll bar
		var boxed_layout = 1150; // boxed layout width
		var menu_item_position = $j(menu_items[i]).offset().left;
		var sub_menu_width = $j(menu_items[i]).find('.second .inner ul').width();
		var menu_item_from_left = 0;
		if($j('body').hasClass('boxed')){
			menu_item_from_left = boxed_layout - (menu_item_position - (browser_width - boxed_layout)/2) + 24; // 24 is right padding between menu elements
		} else {
			menu_item_from_left = browser_width - menu_item_position + 24; // 24 is right padding between menu elements
		}

		var sub_menu_from_left;

		if($j(menu_items[i]).find('li.sub').length > 0){
			sub_menu_from_left = menu_item_from_left - sub_menu_width;
		}

		if(menu_item_from_left < sub_menu_width || sub_menu_from_left < sub_menu_width){
			$j(menu_items[i]).find('.second').addClass('right');
			$j(menu_items[i]).find('.second .inner ul').addClass('right');
		}
	});
}

function initDropDownMenu(){
	"use strict";

	var menu_items = $j('.drop_down > ul > li');

	menu_items.each( function(i) {
		if ($j(menu_items[i]).find('.second').length > 0) {
			if($j(menu_items[i]).hasClass('wide')){
				var dropdown = $j(this).find('.inner > ul');
				var dropdownPadding = parseInt(dropdown.css('padding-left').slice(0, -2)) + parseInt(dropdown.css('padding-right').slice(0, -2));

				if(!$j(this).hasClass('left_position') && !$j(this).hasClass('right_position')){
					$j(this).find('.second').css('left',0);
				}

				var tallest = 0;
				$j(this).find('.second > .inner > ul > li').each(function() {
					var thisHeight = $j(this).height();
					if(thisHeight > tallest) {
						tallest = thisHeight;
					}
				});

				$j(this).find('.second > .inner > ul > li').height(tallest);

				var row_number;
				if($j(this).find('.second > .inner > ul > li').length > 4){
					row_number = 4;
				}else{
					row_number = $j(this).find('.second > .inner > ul > li').length;
				}

				var width = row_number*($j(this).find('.second > .inner > ul > li').outerWidth());
				$j(this).find('.second > .inner > ul').width(width);

				if(!$j(this).hasClass('left_position') && !$j(this).hasClass('right_position')){
					var left_position = ($j(window).width() - 2 * ($j(window).width()-$j(this).find('.second').offset().left))/2 + (width+dropdownPadding)/2;
					$j(this).find('.second').css('left',-left_position);
				}
			}

			if(!menu_dropdown_height_set){
				$j(menu_items[i]).data('original_height', $j(menu_items[i]).find('.second').height() + 'px');
				$j(menu_items[i]).find('.second').height(0);
			}

			if (navigator.userAgent.match(/(iPod|iPhone|iPad)/)) {
				$j(menu_items[i]).on("touchstart mouseenter",function(){
					$j(menu_items[i]).find('.second').css({'height': $j(menu_items[i]).data('original_height'), 'overflow': 'visible', 'visibility': 'visible', 'opacity': '1'});
				}).on("mouseleave", function(){
					$j(menu_items[i]).find('.second').css({'height': '0px','overflow': 'hidden', 'visivility': 'hidden', 'opacity': '0'});
				});

			}else{

				if($j('.drop_down.animate_height ').length){
					$j(menu_items[i]).mouseenter(function() {
						$j(menu_items[i]).find('.second').css({
							'visibility': 'visible',
							'height': '0px',
							'opacity': '0'
						});
						$j(menu_items[i]).find('.second').stop().animate({
							'height': $j(menu_items[i]).data('original_height'),
							opacity: 1
						}, 300, function() {
							$j(menu_items[i]).find('.second').css('overflow', 'visible');
						});

					}).mouseleave(function() {
						$j(menu_items[i]).find('.second').stop().animate({
							'height': '0px'
						}, 0, function() {
							$j(menu_items[i]).find('.second').css({
								'overflow': 'hidden',
								'visibility': 'hidden'
							});
						});
					});

				}else{
					var config = {
						interval: 0,
						over: function(){
							setTimeout(function() {
								$j(menu_items[i]).find('.second').addClass('drop_down_start');
								$j(menu_items[i]).find('.second').stop().css({'height': $j(menu_items[i]).data('original_height')});
							}, 150);
						},
						timeout: 150,
						out: function(){
							$j(menu_items[i]).find('.second').stop().css({'height': '0px'});
							$j(menu_items[i]).find('.second').removeClass('drop_down_start');
						}
					};
					$j(menu_items[i]).hoverIntent(config);
				}


			}
		}
	});
	$j('.drop_down ul li.wide ul li a').on('click',function(){
		var $this = $j(this);
		setTimeout(function() {
			$this.mouseleave();
		}, 500);

	});

	menu_dropdown_height_set = true;
}

/*
 **	Vertical menu toggle dropdown
 */
function initVerticalMenuToggle(){
	"use strict";

	if($j('.no-touch .vertical_menu').hasClass('vm_click_event')){
		//show dropdown on menu item click, no link available on menu item click if it has dropdown

		var menu_items = $j('.no-touch .vertical_menu_toggle > ul > li > a');
		var menu_items_2 = $j('.no-touch .vertical_menu_toggle ul li ul li a');

		menu_items.each( function(i) {
			if($j(menu_items[i]).parent().hasClass('has_sub')){
				var subitems_number = $j(menu_items[i]).find('.inner > ul > li').length;

				$j(menu_items[i]).on('click',function(e) {
					e.preventDefault();
					if(!$j(this).parent().hasClass('open') && !$j(this).parent().hasClass('current-menu-ancestor')) {

						$j('.no-touch .vertical_menu_toggle > ul > li').removeClass('open current-menu-ancestor');
						$j('.no-touch .vertical_menu_toggle > ul > li').find('.second').slideUp('fast');

						$j(this).parent().addClass('open');
						$j(this).parent().find('.second').slideDown('slow', function () {
							$j('.vertical_menu_area.with_scroll').getNiceScroll().resize();
						});
					}else{
						$j(this).parent().removeClass('open');
						$j(this).parent().find('.second').slideUp('fast', function () {
							$j(this).parent().removeClass('current-menu-ancestor');
							$j('.vertical_menu_area.with_scroll').getNiceScroll().resize();
						});
					}
					return false;
				});
			}
		});

		menu_items_2.each( function(i) {
			if($j(menu_items_2[i]).parent().hasClass('menu-item-has-children')){
				var subitems_number = $j(menu_items_2[i]).find('ul > li').length;
				$j(menu_items_2[i]).on('click',function(e) {
					e.preventDefault();
					if(!$j(this).parent().hasClass('open') && !$j(this).parent().hasClass('current_page_parent')) {
						$j('.no-touch .vertical_menu_toggle ul li ul li').removeClass('open current_page_parent');
						$j('.no-touch .vertical_menu_toggle ul li ul li').find('ul').slideUp('fast');

						$j(this).parent().addClass('open');
						$j(this).parent().find('ul').slideDown('slow', function () {
							$j('.vertical_menu_area.with_scroll').getNiceScroll().resize();
						});
					}else{
						$j(this).parent().removeClass('open');
						$j(this).parent().find('ul').slideUp('fast', function () {
							$j(this).parent().removeClass('current_page_parent');
							$j('.vertical_menu_area.with_scroll').getNiceScroll().resize();
						});
					}
					return false;
				});
			}
		});
	} else {
		var menu_items = $j('.no-touch .vertical_menu_toggle > ul > li');
		var menu_items_2 = $j('.no-touch .vertical_menu_toggle ul li ul li');

		menu_items.each( function(i) {
			if($j(menu_items[i]).hasClass('has_sub')){
				var subitems_number = $j(menu_items[i]).find('.inner > ul > li').length;
				$j(menu_items[i]).hoverIntent({
					over: function() {
						$j(menu_items[i]).addClass('open');
						$j(menu_items[i]).find('.second').slideDown(subitems_number*40, 'easeInOutSine', function(){
							$j('.vertical_menu_area.with_scroll').getNiceScroll().resize();
						});

					},
					out: function() {
						//if(!$j(menu_items[i]).hasClass('active')){
						$j(menu_items[i]).removeClass('open');
						$j(menu_items[i]).find('.second').slideUp(subitems_number*40, 'easeInOutSine');
						//}
					},
					timeout: 1000
				});
			}
		});

		menu_items_2.each( function(i) {
			if($j(menu_items_2[i]).hasClass('menu-item-has-children')){
				var subitems_number = $j(menu_items_2[i]).find('ul > li').length;
				$j(menu_items_2[i]).hoverIntent({
					over: function() {
						$j(menu_items_2[i]).addClass('open');
						$j(menu_items_2[i]).find('ul').slideDown(subitems_number*40, 'easeInOutSine', function(){
							$j('.vertical_menu_area.with_scroll').getNiceScroll().resize();
						});
					},
					out: function() {
						$j(menu_items_2[i]).removeClass('open');
						$j(menu_items_2[i]).find('ul').slideUp(subitems_number*40, 'easeInOutSine');
					},
					timeout: 1000
				});
			}
		});
	}
}

/*
 **	Show/Hide Vertical menu for mobile
 */
function initVerticalMobileMenu(){
	"use strict";

	//register tap / click event for main menu item plus icon
	$j('.touch .vertical_menu_toggle > ul > li.has_sub > a').on('tap click', function(e){
		//first prevent event propagation and it's default behavior
		e.stopPropagation();
		e.preventDefault();

		//is dropdown for clicked item visible?
		if($j(this).next('div.second').is(":visible")){
			//if it is remove 'open' class and slide it up
			$j(this).parents('.touch .vertical_menu_toggle > ul > li.has_sub').removeClass('open');
			$j(this).next('div.second').slideUp(200);
		} else {
			//if it's not visible add 'open' class and slide it down
			$j(this).parents('.touch .vertical_menu_toggle > ul > li.has_sub').addClass('open');
			$j(this).next('div.second').slideDown(200);
		}
	});

	//register tap / click event for second level main menu item plus icon
	$j('.touch .vertical_menu_toggle ul li ul li.sub > a').on('tap click', function(e){
		//first prevent event propagation and it's default behavior
		e.stopPropagation();
		e.preventDefault();

		//is dropdown for clicked item visible?
		if($j(this).next('ul').is(":visible")){
			//if it is remove 'open' class and slide it up
			$j(this).parents('.touch .vertical_menu_toggle ul li ul li').removeClass('open');
			$j(this).next('ul').slideUp(200);
		} else {
			//if it's not visible add 'open' class and slide it down
			$j(this).parents('.touch .vertical_menu_toggle ul li ul li').addClass('open');
			$j(this).next('ul').slideDown(200);
		}
	});
}

/*
 **	Set transparency for left menu area
 */
function checkVerticalMenuTransparency(){
	"use strict";

	if($scroll !== 0){
		$j('body.vertical_menu_transparency').removeClass('vertical_menu_transparency_on');
		$j('body.vertical_menu_transparency').addClass('vertical_menu_transparency_off');
	}else{
		$j('body.vertical_menu_transparency').addClass('vertical_menu_transparency_on');
		$j('body.vertical_menu_transparency').removeClass('vertical_menu_transparency_off');
	}
}

/*
 **	Plugin for counter shortcode
 */
(function($) {
	"use strict";

	$.fn.countTo = function(options) {
		// merge the default plugin settings with the custom options
		options = $.extend({}, $.fn.countTo.defaults, options || {});

		// how many times to update the value, and how much to increment the value on each update
		var loops = Math.ceil(options.speed / options.refreshInterval),
			increment = (options.to - options.from) / loops;

		return $(this).each(function() {
			var _this = this,
				loopCount = 0,
				value = options.from,
				interval = setInterval(updateTimer, options.refreshInterval);

			function updateTimer() {
				value += increment;
				loopCount++;
				$(_this).html(value.toFixed(options.decimals));

				if (typeof(options.onUpdate) === 'function') {
					options.onUpdate.call(_this, value);
				}

				if (loopCount >= loops) {
					clearInterval(interval);
					value = options.to;

					if (typeof(options.onComplete) === 'function') {
						options.onComplete.call(_this, value);
					}
				}
			}
		});
	};

	$.fn.countTo.defaults = {
		from: 0,  // the number the element should start at
		to: 100,  // the number the element should end at
		speed: 1000,  // how long it should take to count between the target numbers
		refreshInterval: 100,  // how often the element should be updated
		decimals: 0,  // the number of decimal places to show
		onUpdate: null,  // callback method for every time the element is updated,
		onComplete: null  // callback method for when the element finishes updating
	};
})(jQuery);

/*
 **	Counter from zero to defined number
 */
function initToCounter(){
	"use strict";

	if($j('.counter.zero').length){
		$j('.counter.zero').each(function() {
			if(!$j(this).hasClass('executed')){
				$j(this).addClass('executed');
				$j(this).appear(function() {
					$j(this).parent().css('opacity', '1');
					var $max = parseFloat($j(this).text());
					$j(this).countTo({
						from: 0,
						to: $max,
						speed: 1500,
						refreshInterval: 100
					});
				},{accX: 0, accY: -150});
			}
		});
	}
}

/*
 **	Counter with random effect
 */
function initCounter(){
	"use strict";

	if($j('.counter.random').length){
		$j('.counter.random').each(function() {
			if(!$j(this).hasClass('executed')){
				$j(this).addClass('executed');
				$j(this).appear(function() {
					$j(this).parent().css('opacity', '1');
					$j(this).absoluteCounter({
						speed: 2000,
						fadeInDelay: 1000
					});
				},{accX: 0, accY: -150});
			}
		});
	}
}

/*
 **	Countdown shortcode
 */
function initCountdown() {
	"use strict";

	var countdowns = $j('.qode-countdown'),
		year,
		month,
		day,
		hour,
		minute,
		timezone,
		monthLabel,
		dayLabel,
		hourLabel,
		minuteLabel,
		secondLabel;

	if (countdowns.length) {

		countdowns.each(function(){

			//Find countdown elements by id-s
			var countdownId = $j(this).attr('id'),
				countdown = $j('#'+countdownId),
				digitFontSize,
				labelFontSize,
				digitColor;

			//Get data for countdown
			year = countdown.data('year');
			month = countdown.data('month');
			day = countdown.data('day');
			hour = countdown.data('hour');
			minute = countdown.data('minute');
			timezone = countdown.data('timezone');
			monthLabel = countdown.data('month-label');
			dayLabel = countdown.data('day-label');
			hourLabel = countdown.data('hour-label');
			minuteLabel = countdown.data('minute-label');
			secondLabel = countdown.data('second-label');
			digitFontSize = countdown.data('digit-size');
			labelFontSize = countdown.data('label-size');
			digitColor = countdown.data('digit-color');


			//Initialize countdown
			countdown.countdown({
				until: new Date(year, month - 1, day, hour, minute, 44),
				labels: ['Years', monthLabel, 'Weeks', dayLabel, hourLabel, minuteLabel, secondLabel],
				format: 'ODHMS',
				timezone: timezone,
				padZeroes: true,
				onTick: setCountdownStyle
			});

			function setCountdownStyle() {
				countdown.find('.countdown-amount').css({
					'font-size' : digitFontSize+'px',
					'line-height' : digitFontSize+'px',
					'color' : digitColor
				});
				countdown.find('.countdown-period').css({
					'font-size' : labelFontSize+'px'
				});
			}

		});

	}

}

/*
 **	Horizontal progress bars shortcode
 */
function initProgressBars(){
	"use strict";

	if($j('.q_progress_bar').length){
		$j('.q_progress_bar').each(function() {
			$j(this).appear(function() {
				initToCounterHorizontalProgressBar($j(this));
				var percentage = $j(this).find('.progress_content').data('percentage');
				$j(this).find('.progress_content').css('width', '0%');
				$j(this).find('.progress_content').animate({'width': percentage+'%'}, 1500);
				$j(this).find('.progress_number_wrapper').css('width', '0%');
				$j(this).find('.progress_number_wrapper').animate({'width': percentage+'%'}, 1500);


			},{accX: 0, accY: -150});
		});
	}
}

/*
 **	Counter for horizontal progress bars percent from zero to defined percent
 */
function initToCounterHorizontalProgressBar($this){
	"use strict";

	var percentage = parseFloat($this.find('.progress_content').data('percentage'));
	if($this.find('.progress_number span').length) {
		$this.find('.progress_number span').each(function() {
			$j(this).parents('.progress_number_wrapper').css('opacity', '1');
			$j(this).countTo({
				from: 0,
				to: percentage,
				speed: 1500,
				refreshInterval: 50
			});
		});
	}
}

/*
 **	Unordered list animation effect
 */
function initListAnimation(){
	"use strict";

	if($j('.animate_list').length > 0 && $j('.no_animation_on_touch').length === 0){
		$j('.animate_list').each(function(){
			$j(this).appear(function() {
				$j(this).find("li").each(function (l) {
					var k = $j(this);
					setTimeout(function () {
						k.animate({
							opacity: 1,
							top: 0
						}, 1500);
					}, 100*l);
				});
			},{accX: 0, accY: -150});
		});
	}
}

/*
 **	Pie Chart shortcode
 */
function initPieChart(){
	"use strict";

	if($j('.q_percentage').length){
		$j('.q_percentage').each(function() {

			var $barColor = piechartcolor;
			var $size = 174;

			if($j(this).data('active') !== ""){
				$barColor = $j(this).data('active');
			}

			var $trackColor = '#fff';

			if($j(this).data('noactive') !== ""){
				$trackColor = $j(this).data('noactive');
			}

			var $line_width = 10;

			if($j(this).data('linewidth') !== ""){
				$line_width = $j(this).data('linewidth');
			}

			if($j(this).data('chartwidth') !== ""){
				$size = $j(this).data('chartwidth');
			}

			$j(this).appear(function() {
				initToCounterPieChart($j(this));
				$j(this).parent().css('opacity', '1');

				$j(this).easyPieChart({
					barColor: $barColor,
					trackColor: $trackColor,
					scaleColor: false,
					lineCap: 'butt',
					lineWidth: $line_width,
					animate: 1500,
					size: $size
				});
			},{accX: 0, accY: -150});
		});
	}
}

/*
 **	Pie Chart shortcode
 */
function initPieChartWithIcon(){
	"use strict";

	if($j('.q_percentage_with_icon').length){
		$j('.q_percentage_with_icon').each(function() {

			var $barColor = piechartcolor;
			var $size = 174;

			if($j(this).data('active') !== ""){
				$barColor = $j(this).data('active');
			}

			var $trackColor = '#fff';

			if($j(this).data('noactive') !== ""){
				$trackColor = $j(this).data('noactive');
			}

			var $line_width = 10;

			if($j(this).data('linewidth') !== ""){
				$line_width = $j(this).data('linewidth');
			}

			if($j(this).data('chartwidth') !== ""){
				$size = $j(this).data('chartwidth');
			}

			$j(this).appear(function() {
				$j(this).parent().css('opacity', '1');
				$j(this).css('opacity', '1');
				$j(this).easyPieChart({
					barColor: $barColor,
					trackColor: $trackColor,
					scaleColor: false,
					lineCap: 'butt',
					lineWidth: $line_width,
					animate: 1500,
					size: $size
				});
			},{accX: 0, accY: -150});
		});
	}
}

/*
 **	Counter for pie chart number from zero to defined number
 */
function initToCounterPieChart($this){
	"use strict";

	$j($this).css('opacity', '1');
	var $max = parseFloat($j($this).find('.tocounter').text());
	$j($this).find('.tocounter').countTo({
		from: 0,
		to: $max,
		speed: 1500,
		refreshInterval: 50
	});
}

/*
 **	Init Portfolio list and Portfolio Filter
 */
function initPortfolio(){
	"use strict";

	if($j('.projects_holder_outer:not(.masonry_with_space, .portfolio_justified_gallery)').length){
		$j('.projects_holder_outer').each(function(){

			$j('.filter_holder .filter').on('click',function(){
				var $this = $j(this).text();
				var dropLabels = $j('.filter_holder').find('.label span');
				dropLabels.each(function(){
					$j(this).text($this);
				});
			});

			$j(this).find('.projects_holder').mixitup({
				showOnLoad: 'all',
				transitionSpeed: 600,
				minHeight: 150
			});
		});
	}
}

/*
 **	Init z-index for portfolio items
 */
function initPortfolioZIndex(){
	"use strict";

	if($j('.projects_holder_outer.portfolio_no_space').length){
		$j('.no_space.hover_text article').each(function(i){
			$j(this).css('z-index', i +10);
		});
	}
}

function initPortfolioJustifiedGallery() {
	"use strict";

	if($j('.portfolio_justified_gallery').length) {
		var project_holder = $j('.projects_holder_outer.portfolio_justified_gallery');
		project_holder.each(function () {
			var filter_holder = $j(this).find('.filter_holder');

			filter_holder.find('li.filter').first().addClass('current');


			filter_holder.find('.filter').on('click', function () {
				var $this = $j(this).text();
				var dropLabels = filter_holder.find('.label span');
				dropLabels.each(function () {
					$j(this).text($this);
				});

				var selector = $j(this).attr('data-filter');
				var articles = the_gallery.find('article');
				var transition_duration = 500;
				articles.css('transition', 'all ' + transition_duration + 'ms ease');
				articles.not(selector).css({
					'transform': 'scale(0)'
				});

				setTimeout(function () {
					articles.filter(selector).css({
						'transform': ''
					});
					the_gallery.css('transition', 'height ' + transition_duration + 'ms ease').justifiedGallery({selector: '>article' + (selector != '*' ? selector : '')});
				}, 1.1 * transition_duration);
				setTimeout(function () {
					articles.css('transition', '');
					the_gallery.css('transition', '');
				}, 2.2 * transition_duration);

				$j(".filter").removeClass("current active");
				$j(this).addClass("current active");

				return false;
			});


			var the_gallery = $j(this).find('.projects_holder');
			var row_height = typeof the_gallery.data('row-height') !== 'undefined' ? the_gallery.data('row-height') : 200,
				spacing = typeof the_gallery.data('spacing') !== 'undefined' ? the_gallery.data('spacing') : 0,
				last_row = typeof the_gallery.data('last-row') !== 'undefined' ? the_gallery.data('last-row') : 'nojustify',
				justify_threshold = typeof the_gallery.data('justify-threshold') !== 'undefined' ? the_gallery.data('justify-threshold') : 0.75;
			the_gallery
				.justifiedGallery({
					captions: false,
					rowHeight: row_height,
					margins: spacing,
					border: 0,
					lastRow: last_row,
					justifyThreshold: justify_threshold,
					selector: '> article'
				})
				.on('jg.complete jg.rowflush', function() {
					$j(this).find('article').addClass('show').each(function() {
						$j(this).height(Math.round($j(this).height()));
					});
				});
		});
	}
}


function initPortfolioMasonry(){
	"use strict";

	if($j('.projects_masonry_holder, .masonry_with_space').length){

		$j('.projects_masonry_holder, .masonry_with_space .projects_holder').each(function(){
			var $window = jQuery(window);
			var $this = $j(this);
			$this.animate({opacity:1});
			if($j('.projects_masonry_holder').length){
				resizeMasonry($this);
			}
			$this.isotope({
				itemSelector: '.portfolio_masonry_item, .masonry_with_space .mix',
				layoutMode: 'masonry'
			});

			if($this.hasClass('appear_from_bottom')) {
				$this.find('article').each(function(l) {
					$j(this).appear(function() {
						var $this = $j(this);
						$this.addClass('show');
						setTimeout(function(){
							$this.addClass('shown');
						}, 1000);
					},{accX: 0, accY: 0});
				});
			}

			initPortfolioMasonryFilter($this);

			if($j('.projects_masonry_holder').length){
				setPortfolioMasZIndex();
				$window.resize(function() {resizeMasonry($this); setPortfolioMasZIndex();});
			}
			setPortfolioParallax($this);

			if($j('.parallax_section_holder').length) {
				initParallax();
			}
		});
	}
}

var portfolio_width;
function resizeMasonry(container){
	"use strict";

	var $window = jQuery(window);

	if($j('.full_width').length){
		if($j('body').hasClass('vertical_menu_enabled') && $window_width > 1000){
			portfolio_width = $window.innerWidth() - 260; // 260 is left menu area width
		} else {
			portfolio_width = $window.innerWidth();
		}

		if(container.hasClass('masonry_extended')) {
			portfolio_width = portfolio_width - 60;
		}

	}else{
		var closest_container =  container.closest('.container_inner');
		if(closest_container.has('.column_inner').length) {
			portfolio_width =  container.closest('.column_inner').innerWidth();
		} else {
			portfolio_width = closest_container.innerWidth();
		}

		if(container.hasClass('masonry_extended')) {
			portfolio_width = portfolio_width + 60;
		}
	}
	container.width(portfolio_width);

	var $cols = 5;
	if(portfolio_width > 1600){
		$cols = 5;
	}else if(portfolio_width <= 1600 && portfolio_width > 1300){
		$cols = 4;
	}else if(portfolio_width <= 1300 && portfolio_width > 1000){
		$cols = 3;
	}else if(portfolio_width <= 1000 && portfolio_width > 480){
		$cols = 2;
	}else if(portfolio_width <= 480){
		$cols = 1;
	}
	if(container.hasClass('masonry_extended')) {
		if(portfolio_width > 1600){
			$cols = 4;
		}else if(portfolio_width <= 1600 && portfolio_width > 964){
			$cols = 4;
		}else if(portfolio_width <= 964 && portfolio_width > 728){
			$cols = 3;
		}else if(portfolio_width <= 728 && portfolio_width > 540){
			$cols = 2;
		}else if(portfolio_width <= 540){
			$cols = 1;
		}
	}
	var largeItemHeight = container.find('article[class*="default"]:first img').height();
	var largeWidthItemHeight = container.find('article[class*="default"]:first img').height();
	var double = ($window.innerWidth() > 480) ? 2 : 1 ;
	if(container.hasClass('masonry_extended')) {
		largeItemHeight += 30;
		container.find('article[class*="large_width"] img').css('height',(largeWidthItemHeight));
	}
	container.find('article[class*="large_width_height"] img, article[class*="large_height"] img').css('height',(largeItemHeight*double));

	container.isotope({
		masonry: { columnWidth: portfolio_width / parseInt($cols)}
	});
}

(function( $ ){
	"use strict";

	var $window = $(window);
	$.fn.masonryParallax = function(speedFactor, outerHeight, startPosition) {
		var $this = $(this);
		var getHeight;
		var firstTop;
		var startPositionAdd = 0;

		//get the starting position of element to have parallax applied to it
		firstTop = $this.offset().top;

		//get the height element
		if (outerHeight) {
			getHeight = function(jqo) {
				return jqo.outerHeight(true);
			};
		} else {
			getHeight = function(jqo) {
				return jqo.height();
			};
		}

		//get type so elements could take it's initial position
		if(startPosition != 0){
			startPositionAdd = startPosition;
		}

		// setup defaults if arguments aren't specified
		if (arguments.length < 1 || speedFactor === null) speedFactor = 0.1;
		if (arguments.length < 2 || outerHeight === null) outerHeight = true;

		// function to be called whenever the window is scrolled or resized
		var top = $this.offset().top;
		var height = getHeight($this);
		function update(){
			// Check if totally above or totally below viewport
			if (top + height < $scroll || top > $scroll + $window_height) {
				return;
			}
			$this.css('transform', 'translate3d(0px, '+ (Math.round((firstTop - height - $scroll) * speedFactor + startPositionAdd)) +'px, 0px)');
		}

		$window.bind('scroll', update).resize(update);
		update();
	};
})(jQuery);

function setPortfolioParallax(container) {
	if(container.hasClass('masonry_extended')) {
		container.find('.portfolio_masonry_item.parallax_item').each(function(i){
			$j(this).masonryParallax(container.data('parallax_item_speed'), true, container.data('parallax_item_offset'));

		});
	}
}

function setPortfolioMasZIndex(){
	"use strict";

	var $elemXPos = {};
	var $elemZIndex = {};

	$j('.projects_masonry_holder article').each(function(){
		$elemXPos[$j(this).index()] = getPortfolioXPos($j(this).css('left'));
	});

	var $elemXPosArray = $j.map($elemXPos, function (value) { return value; });
	$elemXPosArray = cleanPortfolioMasXArray($elemXPosArray);
	$elemXPosArray.sort(function(x,y){return x-y});

	for(var i = 0; i < $elemXPosArray.length; i++){
		$elemZIndex[$elemXPosArray[i]] = i*10;
	}

	$j.each($elemXPos,function(key,val){

		var $zi;
		var $bgd = val;
		$j.each($elemZIndex,function(key,val){
			if($bgd == key) {
				$zi = val;
			}
		});

		$j('.projects_masonry_holder article:eq('+key+')').css('z-index',$zi);
	});
}

function getPortfolioXPos(css) {
	//return css.substr(7, css.length - 8).split(', ')[4];
	return css.substr(0, css.length - 2);
}

function initPortfolioMasonryFilter(masonry){
	"use strict";
	var filter = masonry.parent().find('.filter_outer .filter_holder .filter');
	masonry.parent().find('.filter:first').addClass('current');
	filter.click(function(){

		var selector = $j(this).attr('data-filter');
		$j(selector).each(function() {
			var item = $j(this);
			item.addClass('show shown');
		});
		masonry.isotope({ filter: selector });

		filter.removeClass("current");
		$j(this).addClass("current");

		setTimeout(setPortfolioMasZIndex(),700);

		return false;
	});

}

/*
 **	Load more portfolios
 */
function loadMore(){
	"use strict";

	var i = 1;

	$j('.load_more a').on('click', function(e)  {
		e.preventDefault();

		var link = $j(this).attr('href');
		var $content = '.projects_holder';
		var $anchor = '.portfolio_paging .load_more a';
		var $elem = '.mix';
		var $next_href = $j($anchor).attr('href'); // Get URL for the next set of posts
		var filler_num = $j('.projects_holder .filler').length;

		var load_more_holder = $j('.portfolio_paging');
		var loading_holder   = $j('.portfolio_paging_loading');

		load_more_holder.hide();
		loading_holder.show();

		$j.get(link+'', function(data){

			if (!$j($content).is('.justified-gallery')) {
				$j('.projects_holder .filler').slice(-filler_num).remove();

				var $new_content = $j($content, data).wrapInner('').html(); // Grab just the content
				$next_href = $j($anchor, data).attr('href'); // Get the new href

				$j($content, data).waitForImages(function() {

					$j('article.mix:last').after($new_content); // Append the new content




					if($j('.masonry_with_space').length){
						$j('.masonry_with_space .projects_holder').isotope('reloadItems').isotope();
					}else{
						var min_height = $j('article.mix:first').height();
						$j('article.mix').css('min-height',min_height);
						$j('.projects_holder').mixitup('remix','all');
					}
					prettyPhoto();
					if($j('.load_more').attr('rel') > i) {
						$j('.load_more a').attr('href', $next_href); // Change the next URL
					} else {
						$j('.load_more').remove();
					}
					$j('.projects_holder .portfolio_paging:last').remove(); // Remove the original navigation
					$j('article.mix').css('min-height',0);

					load_more_holder.show();
					loading_holder.hide();
					setTimeout(function(){
						$j('.projects_holder article').css('visibility','visible');
						$j('article:not(.show)').each(function(l){
							$j(this).addClass('show');
							setTimeout(function(){
								$j(this).addClass('shown');
							}, 1000);
						});
					}, 600);
				});

			} else {
				var $new_content = $j($content, data).wrapInner('').html(); // Grab just the content
				$next_href = $j($anchor, data).attr('href'); // Get the new href
				$j($content, data).waitForImages(function() {

					$j($content).find('article:last').after($new_content); // Append the new content

					$j($content).find('article').css('visibility','visible');
					$j($content).justifiedGallery('norewind');
					prettyPhoto();
					if($j('.load_more').attr('rel') > i) {
						$j('.load_more a').attr('href', $next_href); // Change the next URL
					} else {
						$j('.load_more').remove();
					}
					$j('.projects_holder .portfolio_paging:last').remove(); // Remove the original navigation

					load_more_holder.show();
					loading_holder.hide();
				});
			}

		});
		i++;
	});
}


/*
 **	Picture popup for portfolio lists and portfolio single
 */
function prettyPhoto(){
	"use strict";

	$j('a[data-rel]').each(function() {
		$j(this).attr('rel', $j(this).data('rel'));
	});

	$j("a[rel^='prettyPhoto']").prettyPhoto({
		animation_speed: 'normal', /* fast/slow/normal */
		slideshow: false, /* false OR interval time in ms */
		autoplay_slideshow: false, /* true/false */
		opacity: 0.80, /* Value between 0 and 1 */
		show_title: true, /* true/false */
		allow_resize: true, /* Resize the photos bigger than viewport. true/false */
		horizontal_padding: 0,
		default_width: 960,
		default_height: 540,
		counter_separator_label: '/', /* The separator for the gallery counter 1 "of" 2 */
		theme: 'pp_default', /* light_rounded / dark_rounded / light_square / dark_square / facebook */
		hideflash: false, /* Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto */
		wmode: 'opaque', /* Set the flash wmode attribute */
		autoplay: true, /* Automatically start videos: True/False */
		modal: false, /* If set to true, only the close button will close the window */
		overlay_gallery: false, /* If set to true, a gallery will overlay the fullscreen image on mouse over */
		keyboard_shortcuts: true, /* Set to false if you open forms inside prettyPhoto */
		deeplinking: false,
		social_tools: false
	});
}

function checkTitleToShowOrHide(){
	if($j('.title_outer.animate_title_area').length){
		var title_area_height = $j('.title_outer').data('height');
		if($scroll > $j('.title').height()){
			$j('.title_outer').css({'height':title_area_height, 'opacity':'1', 'overflow':'visible'});
		}
	}
}

/*
 **	Title area animation
 */
function initTitleAreaAnimation(){
	if($j('.title_outer.animate_title_area').length){

		var title_area_height = $j('.title_outer').data('height');
		if($j('.title_outer').hasClass('with_image')){
			title_area_height = $j('.image.responsive').height();
		}
		if($scroll < $j('.title').height()){
			$j('.title_outer').animate({ height: title_area_height, opacity: 1}, 500, function(){
				$j(this).css({'overflow':'visible'});
				initPortfolioSingleInfo();
				if($j('nav.content_menu').length > 0){
					content_menu_position = $j('nav.content_menu').offset().top;
					contentMenuPosition();
				}
			});
		}
	}
}

function cleanPortfolioMasXArray($elemXPosArray) {
	var i;
	var length = $elemXPosArray.length;
	var $elemXPosOutArray = [];
	var tmp = {};

	for (i = 0; i < length; i++) {
		tmp[$elemXPosArray[i]] = 0;
	}
	for (i in tmp) {
		$elemXPosOutArray.push(i);
	}
	return $elemXPosOutArray;
}

/*
 **	Title image with parallax effect
 */
function initParallaxTitle(){
	"use strict";

	if(($j('.title').length > 0) && ($j('.touch').length === 0)){

		if($j('.title.has_fixed_background').length){

			var $background_size_width = parseInt($j('.title.has_fixed_background').css('background-size').match(/\d+/));

			var title_holder_height = $j('.title.has_fixed_background').height();
			var title_rate = (title_holder_height / 10000) * 7;

			var title_distance = $scroll - $j('.title.has_fixed_background').offset().top;
			var title_bpos = -(title_distance * title_rate);
			$j('.title.has_fixed_background').css({'background-position': 'center '+ (0+add_for_admin_bar) +'px' });
			if($j('.title.has_fixed_background').hasClass('zoom_out')){
				$j('.title.has_fixed_background').css({'background-size': $background_size_width-$scroll + 'px auto'});
			}
		}

		$j(window).on('scroll', function() {
			if($j('.title.has_fixed_background').length){

				var title_distance = $scroll - $j('.title.has_fixed_background').offset().top;

				var title_bpos = -(title_distance * title_rate);
				$j('.title.has_fixed_background').css({'background-position': 'center ' + (title_bpos+add_for_admin_bar) + 'px' });
				if($j('.title.has_fixed_background').hasClass('zoom_out')){
					$j('.title.has_fixed_background').css({'background-size': $background_size_width-$scroll + 'px auto'});
				}
			}
		});
	}
}

/*
 Plugin: jQuery Parallax
 Version 1.1.3
 Author: Ian Lunn
 Twitter: @IanLunn
 Author URL: http://www.ianlunn.co.uk/
 Plugin URL: http://www.ianlunn.co.uk/plugins/jquery-parallax/

 Dual licensed under the MIT and GPL licenses:
 http://www.opensource.org/licenses/mit-license.php
 http://www.gnu.org/licenses/gpl.html
 */

(function( $ ){
	var $window = $(window);
	var windowHeight = $window.height();

	$window.resize(function () {
		windowHeight = $window.height();
	});

	$.fn.parallax = function(xpos, speedFactor, outerHeight) {
		var $this = $(this);
		var getHeight;
		var firstTop;
		var paddingTop = 0;

		//get the starting position of each element to have parallax applied to it
		$this.each(function(){
			firstTop = $this.offset().top;
		});

		if (outerHeight) {
			getHeight = function(jqo) {
				return jqo.outerHeight(true);
			};
		} else {
			getHeight = function(jqo) {
				return jqo.height();
			};
		}

		// setup defaults if arguments aren't specified
		if (arguments.length < 1 || xpos === null) xpos = "50%";
		if (arguments.length < 2 || speedFactor === null) speedFactor = 0.1;
		if (arguments.length < 3 || outerHeight === null) outerHeight = true;

		// function to be called whenever the window is scrolled or resized
		function update(){
			var pos = $window.scrollTop();

			$this.each(function(){
				var $element = $(this);
				var top = $element.offset().top;
				var height = getHeight($element);

				// Check if totally above or totally below viewport
				if (top + height < pos || top > pos + windowHeight) {
					return;
				}

				$this.css('backgroundPosition', xpos + " " + Math.round((firstTop - pos) * speedFactor) + "px");
			});
		}

		$window.bind('scroll', update).resize(update);
		update();
	};
})(jQuery);


/*
 **	Sections with parallax background image
 */
function initParallax(){
	"use strict";

	if($j('.parallax_section_holder').length){
		$j('.parallax_section_holder').each(function() {
			if($j(this).hasClass('full_screen_height_parallax')){ $j(this).height($window_height); $j(this).find('.parallax_content_outer').css('padding',0); }
			var speed = $j(this).data('speed')*0.4;
			$j(this).parallax("50%", speed);
		});
	}
}

/*
 **	Smooth scroll functionality for Side Area
 */
function initSideAreaScroll(){
	"use strict";

	if($j('.side_menu').length){
		$j(".side_menu").niceScroll({
			scrollspeed: 60,
			mousescrollstep: 40,
			cursorwidth: 0,
			cursorborder: 0,
			cursorborderradius: 0,
			cursorcolor: "transparent",
			autohidemode: false,
			horizrailenabled: false
		});
	}
}

/*
 **	Smooth scroll functionality for Vertical Menu Area Toogle style
 */
function initVerticalAreaMenuScroll(){
	"use strict";

	if($j('.vertical_menu_area.with_scroll').length){
		$j(".vertical_menu_area.with_scroll").niceScroll({
			scrollspeed: 60,
			mousescrollstep: 40,
			cursorwidth: 0,
			cursorborder: 0,
			cursorborderradius: 0,
			cursorcolor: "transparent",
			autohidemode: false,
			horizrailenabled: false
		});
	}
}

/*
 **	Show/Hide Mobile menu
 */
function initMobileMenu(){
	"use strict";

	$j(".mobile_menu_button span").on('tap click', function(e){
		e.preventDefault();

		if ($j(".mobile_menu > ul").is(":visible")){
			$j(".mobile_menu > ul").slideUp(200);
		} else {
			$j(".mobile_menu > ul").slideDown(200);
		}
	});

	$j(".mobile_menu > ul > li.has_sub > span.mobile_arrow, .mobile_menu > ul > li.has_sub > h3, .mobile_menu > ul > li.has_sub > a[href*='#']").on('tap click', function(e){
		e.preventDefault();

		if ($j(this).closest('li.has_sub').find("> ul.sub_menu").is(":visible")){
			$j(this).closest('li.has_sub').find("> ul.sub_menu").slideUp(200);
			$j(this).closest('li.has_sub').removeClass('open_sub');
		} else {
			$j(this).closest('li.has_sub').addClass('open_sub');
			$j(this).closest('li.has_sub').find("> ul.sub_menu").slideDown(200);
		}
	});

	$j(".mobile_menu > ul > li.has_sub > ul.sub_menu > li.has_sub > span.mobile_arrow, .mobile_menu > ul > li.has_sub > ul.sub_menu > li.has_sub > h3, .mobile_menu > ul > li.has_sub > ul.sub_menu > li.has_sub > a[href*='#']").on('tap click', function(e){
		e.preventDefault();

		if ($j(this).parent().find("ul.sub_menu").is(":visible")){
			$j(this).parent().find("ul.sub_menu").slideUp(200);
			$j(this).parent().removeClass('open_sub');
		} else {
			$j(this).parent().addClass('open_sub');
			$j(this).parent().find("ul.sub_menu").slideDown(200);
		}
	});

	$j(".mobile_menu ul li > a, .q_logo a").on('click', function(){

		if(($j(this).attr('href') !== "http://#") && ($j(this).attr('href') !== "#")){
			$j(".mobile_menu > ul").slideUp();
		}
	});
}


/*
 **	Init flexslider for portfolio single
 */
function initFlexSlider(){
	"use strict";
	$j('.flexslider').each(function(){
		var interval = 8000;
		if(typeof $j(this).data('interval') !== 'undefined' && $j(this).data('interval') !== false) {
			interval = parseFloat($j(this).data('interval')) * 1000;
		}

		var slideshow = true;
		if(interval === 0) {
			slideshow = false;
		}

		var animation = 'slide';
		if(typeof $j(this).data('flex_fx') !== 'undefined' && $j(this).data('flex_fx') !== false) {
			animation = $j(this).data('flex_fx');
		}

		$j(this).flexslider({
			animationLoop: true,
			controlNav: false,
			useCSS: false,
			pauseOnAction: true,
			pauseOnHover: true,
			slideshow: slideshow,
			animation: animation,
			prevText: "<span class='arrow_carrot-left'></span>",
			nextText: "<span class='arrow_carrot-right'></span>",
			animationSpeed: 600,
			slideshowSpeed: interval,
			start: function(){
				setTimeout(function(){$j(".flexslider").fitVids();},100);
			}
		});

		$j('.flex-direction-nav a').click(function(e){
			e.preventDefault();
			e.stopImmediatePropagation();
			e.stopPropagation();
		});
	});
}

/*
 **	Init fitVideo function for responsive video files
 */
function fitVideo(){
	"use strict";

	$j(".portfolio_images").fitVids();
	$j(".video_holder").fitVids();
	$j(".format-video .post_image").fitVids();
	$j(".format-video .q_masonry_blog_post_image").fitVids();
	$j(".portfolio_owl_slider").fitVids();
}

/*
 **	Function for follow portfolio single descripton
 */
var $scrollHeight;
function initPortfolioSingleInfo(){
	"use strict";

	var $sidebar = $j(".portfolio_single_follow");
	if($j(".portfolio_single_follow").length > 0){

		var offset = $sidebar.offset();
		$scrollHeight = $j(".portfolio_container").height();
		var $scrollOffset = $j(".portfolio_container").offset();
		var $window = $j(window);

		var $headerHeight = parseInt($j('header.page_header').css('height'), 10);

		var paspartuAdd = $j('body').hasClass('paspartu_enabled') ? $window_width*paspartu_width : 0;

		$window.scroll(function() {
			if($window.width() > 960){
				if ($window.scrollTop() + $headerHeight + paspartuAdd > offset.top) {
					if ($window.scrollTop() + $headerHeight + paspartuAdd + $sidebar.height() + 24 < $scrollOffset.top + $scrollHeight) {

						$sidebar.stop().animate({
							marginTop: $window.scrollTop() - offset.top + $headerHeight + paspartuAdd
						});
					} else {
						$sidebar.stop().animate({
							marginTop: $scrollHeight - $sidebar.height() - 24
						});
					}
				} else {
					$sidebar.stop().animate({
						marginTop: 0
					});
				}
			}else{
				$sidebar.css('margin-top',0);
			}
		});
	}
}



/**
 * Init Portfolio Full Screen Slider
 */
var qodefPortfolioFullScreenSlider = function() {

	var sliderHolder = $j('.qodef-full-screen-slider-holder');
	var content = $j('.wrapper .content');
	var sliders = $j('.qodef-portfolio-full-screen-slider');


	var qodefFullScreenSliderHeight = function() {
		if (sliderHolder.length) {

			var contentMargin = parseInt(content.css('margin-top'));
			var header_height = $j('.page_header').height();

			var paspartuAdd = $j('body').hasClass('paspartu_enabled') ? $window_width*paspartu_width*2 : 0;

			if($window_width > 1000) {
				if($j('header').hasClass('regular')){
					sliderHolder.css("height", $window_height - header_height - paspartuAdd);
				} else {
					sliderHolder.css("height", $window_height - paspartuAdd);
				}
			}
			else {
				sliderHolder.css("height", $window_height - header_height - paspartuAdd); // window height - mobile height
			}
		}
	}

	var qodefFullScreenOwlSlider = function() {

		if (sliderHolder.length) {

			sliders.each(function () {

				var slider = $j(this);
				slider.owlCarousel({
					items: 1,
					center: true,
					loop: true,
					margin: 0,
					animateOut: 'fadeOut',
					animateIn: 'fadeIn',
					dots: false,
					nav: true,
					video: true,
					navText: [
						"<span class='arrow_carrot-left'></span>",
						"<span class='arrow_carrot-right'></span>"
					]
				}).animate({'opacity': 1}, 600);

			});
		}

	}

	var qodefFullScreenSliderInfo = function() {

		if (sliderHolder.length) {

			var sliderContent = $j('.qodef-portfolio-slider-content');
			var close = $j('.qodef-control.qodef-close');
			var description = $j('.qodef-description');
			var info = $j('.qodef-portfolio-slider-content-info');

			sliderContent.on('click',function(e){
				if (!sliderContent.hasClass('opened')) {
					e.preventDefault();
					description.fadeOut(400, function() {
						sliderContent.addClass('opened');
						setTimeout(function(){
							info.fadeIn(400);
						}, 400);
						setTimeout(function(){
							$j(".qodef-portfolio-slider-content-info").niceScroll({
								scrollspeed: 60,
								mousescrollstep: 40,
								cursorwidth: 0,
								cursorborder: 0,
								cursorborderradius: 0,
								cursorcolor: "transparent",
								autohidemode: false,
								horizrailenabled: false
							});
						}, 800);
					});
				}
			});

			close.on('click',function(e){
				e.preventDefault();
				e.stopPropagation();
				info.fadeOut( 400, function() {
					sliderContent.removeClass('opened');
					setTimeout(function() {
						description.fadeIn(400);
					}, 400);
				});
			});

		}

	}
	return {
		init : function() {
			qodefFullScreenSliderHeight();
			qodefFullScreenOwlSlider();
			qodefFullScreenSliderInfo();

			$j(window).resize(function(){
				qodefFullScreenSliderHeight();
			});
		}
	};
}


/*
 **	Init portfolio owl slider
 */
function intPortfolioOWLSlider(){
	"use strict";

	$j('.portfolio_owl_slider').each(function(){
		$j(this).owlCarousel({
			items: 1,
			center: true,
			stagePadding: 140,
			loop:true,
			margin:0,
			nav:true,
			video:true,
			navText:[
				"<span class='arrow_carrot-left'></span>",
				"<span class='arrow_carrot-right'></span>"
			],
			responsive:{
				0:{
					stagePadding: 60
				},
				600:{
					stagePadding: 120
				},
				1000:{
					stagePadding: 160
				}
			}

		}).animate({'opacity': 1},600);
	});
}



/*
 **	Init tabs shortcodes
 */
function initTabs(){
	"use strict";
	if($j('.q_tabs').length){
		$j('.q_tabs').appear(function() {
			$j('.q_tabs').css('visibility', 'visible');
		},{accX: 0, accY: -100});
		var $tabsNav = $j('.tabs-nav');
		var $tabsNavLis = $tabsNav.children('li');
		$tabsNav.each(function() {
			var $this = $j(this);
			$this.next().children('.tab-content').stop(true,true).hide().first().show();
			$this.children('li').first().addClass('active').stop(true,true).show();
		});
		$tabsNavLis.on('click', function(e) {
			var $this = $j(this);
			$this.siblings().removeClass('active').end().addClass('active');
			$this.parent().next().children('.tab-content').stop(true,true).hide().siblings( $this.find('a').attr('href') ).fadeIn();
			e.preventDefault();
		});
	}
}

/*
 **	Init accordion and toogle shortcodes
 */
function initAccordion() {
	"use strict";

	if($j(".q_accordion_holder").length){
		$j(".q_accordion_holder").appear(function() {
			$j(".q_accordion_holder").css('visibility', 'visible');
		},{accX: 0, accY: -100});

		if ($j(".accordion").length) {
			$j(".accordion").accordion({
				animate: "swing",
				collapsible: true,
				active: false,
				icons: "",
				heightStyle: "content"
			});

			//define custom options for each accordion
			$j(".accordion").each(function() {
				var activeTab = parseInt($j(this).data('active-tab'));
				if(activeTab !== "") {
					activeTab = activeTab - 1; // - 1 because active tab is set in 0 index base
					$j(this).accordion('option', 'active', activeTab);
				}
				var borderRadius = parseInt($j(this).data('border-radius'));

				if(borderRadius !== "") {
					$j(this).find('.accordion_mark').css('border-radius', borderRadius+"px");
				}
				var collapsible = ($j(this).data('collapsible') == 'yes') ? true : false;
				$j(this).accordion('option', 'collapsible', collapsible);
				$j(this).accordion('option', 'collapsible', collapsible);
			});
		}
		$j(".toggle").addClass("accordion ui-accordion ui-accordion-icons ui-widget ui-helper-reset")
			.find(".title-holder")
			.addClass("ui-accordion-header ui-helper-reset ui-state-default ui-corner-top ui-corner-bottom")
			.hover(function() {
				$j(this).toggleClass("ui-state-hover");
			})
			.click(function() {
				$j(this)
					.toggleClass("ui-accordion-header-active ui-state-active ui-state-default ui-corner-bottom")
					.next().toggleClass("ui-accordion-content-active").slideToggle(400);
				return false;
			})
			.next()
			.addClass("ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom")
			.hide();

		$j(".toggle").each(function() {
			var activeTab = parseInt($j(this).data('active-tab'));

			var borderRadius = parseInt($j(this).data('border-radius'));

			if(borderRadius !== "") {
				$j(this).find('.accordion_mark').css('border-radius', borderRadius+"px");
			}

			if(activeTab !== "" && activeTab >= 1) {
				activeTab = activeTab - 1; // - 1 because active tab is set in 0 index base
				$j(this).find('.ui-accordion-content').eq(activeTab).show();
				$j(this).find('.ui-accordion-header').eq(activeTab).addClass('ui-state-active'); //set active accordion header
			}

		});
	}
}

/*
 **	Function to enable link in accordion
 */
function initAccordionContentLink(){
	"use strict";

	if($j(".accordion").length){
		$j('.accordion_holder .accordion_inner .accordion_content a').click(function(){
			if($j(this).attr('target') === '_blank'){
				window.open($j(this).attr('href'),'_blank');
			}else{
				window.open($j(this).attr('href'),'_self');
			}
			return false;
		});
	}
}

/*
 **	Init testimonials shortcode
 */
function initTestimonials(){
	"use strict";

	if($j('.testimonials_carousel').length){
		$j('.testimonials_carousel').each(function(){
			$j(this).appear(function() {
				$j(this).css('visibility','visible');
			},{accX: 0, accY: -100});

			var interval = 5000;
			if(typeof $j(this).data('auto-rotate-slides') !== 'undefined' && $j(this).data('auto-rotate-slides') !== false) {
				interval = parseFloat($j(this).data('auto-rotate-slides')) * 1000;
			}

			var slideshow = true;
			if(interval === 0) {
				slideshow = false;
			}

			var animation = 'fade';
			if(typeof $j(this).data('animation-type') !== 'undefined' && $j(this).data('animation-type') !== false) {
				animation = $j(this).data('animation-type');
			}

			var directionNav = true;
			if(typeof $j(this).data('show-navigation') !== 'undefined') {
				directionNav = $j(this).data('show-navigation') == 'no' ? false : true;
			}

			var animationSpeed = 600;
			if(typeof $j(this).data('animation-speed') !== 'undefined' && $j(this).data('animation-speed') !== false) {
				animationSpeed = $j(this).data('animation-speed');
			}

			$j(this).flexslider({
				animationLoop: true,
				controlNav: directionNav,
				directionNav: false,
				useCSS: false,
				pauseOnAction: true,
				pauseOnHover: false,
				slideshow: slideshow,
				animation: animation,
				itemMargin: 25,
				minItems: 1,
				maxItems: 1,
				animationSpeed: animationSpeed,
				slideshowSpeed: interval,
				start: function(slider){
					initParallax();
				}
			});
		});

	}
}

/*
 **	Function to close message shortcode
 */
function initMessages(){
	"use strict";

	if($j('.q_message').length){
		$j('.q_message').each(function(){
			$j(this).find('.close').click(function(e){
				e.preventDefault();
				$j(this).parent().parent().fadeOut(500);
			});
		});
	}
}
/*
 **	Init Element Animations
 */
function initElementsAnimation(){
	"use strict";

	if($j(".element_from_fade").length > 0 && $j('.no_animation_on_touch').length === 0){
		$j('.element_from_fade').each(function(){
			var $this = $j(this);

			$this.appear(function() {
				$this.addClass('element_from_fade_on');
			},{accX: 0, accY: -100});
		});
	}

	if($j(".element_from_left").length > 0 && $j('.no_animation_on_touch').length === 0){
		$j('.element_from_left').each(function(){
			var $this = $j(this);

			$this.appear(function() {
				$this.addClass('element_from_left_on');
			},{accX: 0, accY: -100});
		});
	}

	if($j(".element_from_right").length > 0 && $j('.no_animation_on_touch').length === 0){
		$j('.element_from_right').each(function(){
			var $this = $j(this);

			$this.appear(function() {
				$this.addClass('element_from_right_on');
			},{accX: 0, accY: -100});
		});
	}

	if($j(".element_from_top").length > 0 && $j('.no_animation_on_touch').length === 0){
		$j('.element_from_top').each(function(){
			var $this = $j(this);

			$this.appear(function() {
				$this.addClass('element_from_top_on');
			},{accX: 0, accY: -100});
		});
	}

	if($j(".element_from_bottom").length > 0 && $j('.no_animation_on_touch').length === 0){
		$j('.element_from_bottom').each(function(){
			var $this = $j(this);

			$this.appear(function() {
				$this.addClass('element_from_bottom_on');
			},{accX: 0, accY: -100});
		});
	}

	if($j(".element_transform").length > 0 && $j('.no_animation_on_touch').length === 0){
		$j('.element_transform').each(function(){
			var $this = $j(this);

			$this.appear(function() {
				$this.addClass('element_transform_on');
			},{accX: 0, accY: -100});
		});
	}
}

/*
 **	Init audio player for blog layout
 */
function fitAudio(){
	"use strict";

	$j('audio.blog_audio').mediaelementplayer({
		audioWidth: '100%'
	});
}

/*
 **	Init masonry layout for blog template
 */
function initBlog(){
	"use strict";

	if($j('.blog_holder.masonry').length){
		var width_blog = $j(this).closest('.container_inner').width();
		if($j('.blog_holder.masonry').closest(".column_inner").length) {
			width_blog = $j('.blog_holder.masonry').closest(".column_inner").width();
		}
		$j('.blog_holder.masonry').width(width_blog);
		var $container = $j('.blog_holder.masonry');
		var $cols = 3;

		if($container.width() < 420) {
			$cols = 1;
		} else if($container.width() <= 805) {
			$cols = 2;
		}

		$container.isotope({
			itemSelector: 'article',
			resizable: false,
			masonry: { columnWidth: $j('.blog_holder.masonry').width() / $cols }
		});


		$j('.filter').click(function(){
			var selector = $j(this).attr('data-filter');
			$container.isotope({ filter: selector });
			return false;
		});

		if( $container.hasClass('masonry_infinite_scroll')){
			$container.infinitescroll({
					navSelector  : '.blog_infinite_scroll_button span',
					nextSelector : '.blog_infinite_scroll_button span a',
					itemSelector : 'article',
					loading: {
						finishedMsg: finished_text,
						msgText  : loading_text
					}
				},
				// call Isotope as a callback
				function( newElements ) {
					$container.isotope( 'appended', $j( newElements ) );
					fitVideo();
					fitAudio();
					initFlexSlider();
					setTimeout(function(){
						$j('.blog_holder.masonry').isotope( 'layout');
					},400);


				}
			);
		}else if($container.hasClass('masonry_load_more')){

			var i = 1;
			$j('.blog_load_more_button a').on('click', function(e)  {
				e.preventDefault();

				var link = $j(this).attr('href');
				var $content = '.masonry_load_more';
				var $anchor = '.blog_load_more_button a';
				var $next_href = $j($anchor).attr('href');
				$j.get(link+'', function(data){
					var $new_content = $j($content, data).wrapInner('').html();
					$next_href = $j($anchor, data).attr('href');
					$container.append( $j( $new_content) ).isotope( 'reloadItems' ).isotope({ sortBy: 'original-order' });
					fitVideo();
					fitAudio();
					initFlexSlider();
					setTimeout(function(){
						$j('.blog_holder.masonry').isotope( 'layout');
					},400);
					if($j('.blog_load_more_button span').attr('rel') > i) {
						$j('.blog_load_more_button a').attr('href', $next_href); // Change the next URL
					} else {
						$j('.blog_load_more_button').remove();
					}

					setTimeout(function(){
						$j('article:not(.show)').each(function(l){
							$j(this).addClass('show');
						});
					}, 1000);

				});
				i++;

			});
		}

		$j(window).resize(function(){
			if($container.width() < 420) {
				$cols = 1;
			} else if($container.width() <= 785) {
				$cols = 2;
			} else {
				$cols = 3;
			}
		});

		if($j('.blog_appear_from_bottom').length){
			$j('.blog_holder').find('article').each(function(l) {
				$j(this).appear(function() {
					var $this = $j(this);
					$this.addClass('show');
				},{accX: 0, accY: -70});
			});
		}

		$j('.blog_holder.masonry, .blog_load_more_button_holder').animate({opacity: "1"}, 400, function(){
			$j('.blog_holder.masonry').isotope( 'layout');
		});
	}
}

/*
 **	Init full width masonry layout for blog template
 */
function initBlogMasonryFullWidth(){
	"use strict";

	if($j('.masonry_full_width').length){
		var width_blog = $j('.full_width_inner').width();

		$j('.masonry_full_width').width(width_blog);
		var $container = $j('.masonry_full_width');


		if($j('.masonry_full_width').hasClass('pinterest_full_width')) {
			var $cols = 4;

			if($container.width() < 480) {
				$cols = 1;
			} else if($container.width() <= 950) {
				$cols = 2;
			} else if($container.width() <= 1320) {
				$cols = 3;
			}


		} else {
			var $cols = 5;

			if($container.width() < 480) {
				$cols = 1;
			} else if($container.width() <= 703) {
				$cols = 2;
			} else if($container.width() <= 920) {
				$cols = 3;
			} else if($container.width() <= 1320) {
				$cols = 4;
			}
		}


		$j('.filter').click(function(){
			var selector = $j(this).attr('data-filter');
			$container.isotope({ filter: selector });
			return false;
		});
		if( $container.hasClass('masonry_infinite_scroll')){
			$container.infinitescroll({
					navSelector  : '.blog_infinite_scroll_button span',
					nextSelector : '.blog_infinite_scroll_button span a',
					itemSelector : 'article',
					loading: {
						finishedMsg: finished_text,
						msgText  : loading_text
					}
				},
				// call Isotope as a callback
				function( newElements ) {
					$container.isotope( 'appended', $j( newElements ) );
					fitVideo();
					fitAudio();
					initFlexSlider();
					setTimeout(function(){
						$j('.blog_holder.masonry_full_width').isotope( 'layout');
					},400);
				}
			);
		}else if($container.hasClass('masonry_load_more')){

			var i = 1;
			$j('.blog_load_more_button a').on('click', function(e)  {
				e.preventDefault();

				var link = $j(this).attr('href');
				var $content = '.masonry_load_more';
				var $anchor = '.blog_load_more_button a';
				var $next_href = $j($anchor).attr('href');
				$j.get(link+'', function(data){
					var $new_content = $j($content, data).wrapInner('').html();
					$next_href = $j($anchor, data).attr('href');
					$container.append( $j( $new_content) ).isotope( 'reloadItems' ).isotope({ sortBy: 'original-order' });
					fitVideo();
					fitAudio();
					initFlexSlider();
					setTimeout(function(){
						$j('.blog_holder.masonry_full_width').isotope( 'layout');
					},400);
					if($j('.blog_load_more_button span').attr('rel') > i) {
						$j('.blog_load_more_button a').attr('href', $next_href); // Change the next URL
					} else {
						$j('.blog_load_more_button').remove();
					}

					setTimeout(function(){
						$j('article:not(.show)').each(function(l){
							$j(this).addClass('show');
						});
					}, 1000);
				});
				i++;

			});
		}
		$container.isotope({
			itemSelector: 'article',
			resizable: false,
			masonry: { columnWidth: $j('.masonry_full_width').width() / $cols }
		});

		$j(window).resize(function(){
			if($container.width() < 480) {
				$cols = 1;
			} else if($container.width() <= 703) {
				$cols = 2;
			} else if($container.width() <= 920) {
				$cols = 3;
			} else if($container.width() <= 1320) {
				$cols = 4;
			} else {
				$cols = 5;
			}
		});

		if($j('.blog_appear_from_bottom').length){
			$j('.blog_holder').find('article').each(function(l) {
				$j(this).appear(function() {
					var $this = $j(this);
					$this.addClass('show');
				},{accX: 0, accY: -70});
			});
		}

		$j('.masonry_full_width, .blog_load_more_button_holder').animate({opacity: "1"}, 400, function(){
			$j('.blog_holder.masonry_full_width').isotope( 'layout');
		});
	}
}

/*
 **	Init full width masonry layout for blog template
 */
function initBlogChequered() {
	"use strict";
	var blogHolder = $j('.blog_holder.blog_chequered');
	var maxHeight = -1;
	if(blogHolder.length){
		var elements = blogHolder.find('article');
		elements.each(function() {
			maxHeight = maxHeight > $j(this).find('.qodef-post-content-inner').outerHeight() ? maxHeight : $j(this).find('.qodef-post-content-inner').outerHeight();
		});
		elements.each(function() {
			$j(this).find('.qodef-post-content').height(maxHeight);
			$j(this).css("opacity","1");
		});
	}
}



/*
 **	Init portfolio single masonry
 */
function initPortfolioSingleMasonry(){
	"use strict";

	if($j('.portfolio_single.masonry-gallery').length){

		var width = $j('.portfolio_single.masonry-gallery').width();
		$j('.portfolio_single .portfolio_masonry_gallery').width(width);

		var $container = $j('.portfolio_single .portfolio_masonry_gallery');
		var $cols = 4;

		if($container.width() < 420) {
			$cols = 1;
		} else if($container.width() <= 805) {
			$cols = 3;
		}

		$container.isotope({
			itemSelector: '.mix',
			resizable: false,
			masonry: { columnWidth: $j('.portfolio_single .portfolio_masonry_gallery').width() / $cols }
		});

		$j('.portfolio_single .portfolio_masonry_gallery').css("opacity", "1");


		$j(window).resize(function(){
			if($container.width() <= 420) {
				$cols = 1;
			} else if($container.width() <= 785) {
				$cols = 3;
			} else {
				$cols = 4;
			}
		});

	}
}

/*
 **	Init progress bar with icon
 */
var timeOuts = [];
function initProgressBarsIcon(){
	"use strict";

	if($j('.q_progress_bars_icons_holder').length){
		$j('.q_progress_bars_icons_holder').each(function() {
			var $this = $j(this);
			$this.appear(function() {
				$this.find('.q_progress_bars_icons').css('opacity','1');
				$this.find('.q_progress_bars_icons').each(function() {
					var number = $j(this).find('.q_progress_bars_icons_inner').data('number');
					var size = $j(this).find('.q_progress_bars_icons_inner').data('size');

					if(size !== ""){
						$j(this).find('.q_progress_bars_icons_inner.custom_size .bar').css({'width': size+'px','height':size+'px'});
						$j(this).find('.q_progress_bars_icons_inner.custom_size .bar .fa-stack').css({'font-size': size/2+'px'});
					}

					var bars = $j(this).find('.bar');

					bars.each(function(i){
						if(i < number){
							var time = (i + 1)*150;
							timeOuts[i] = setTimeout(function(){
								$j(bars[i]).addClass('active');
							},time);
						}
					});
				});
			},{accX: 0, accY: -150});
		});
	}
}

/*
 **	Init more facts shortcode
 */
function initMoreFacts(){
	"use strict";

	if($j('.more_facts_holder').length){
		$j('.more_facts_holder').each(function(){
			var $this = $j(this);

			var $more_label = 'More Facts';

			if($this.find('.more_facts_button').data('morefacts') !== ""){
				$more_label = $this.find('.more_facts_button').data('morefacts');
			}

			var $less_label = 'Less Facts';

			if($this.find('.more_facts_button').data('lessfacts') !== ""){
				$less_label = $this.find('.more_facts_button').data('lessfacts');
			}

			var height = $this.find('.more_facts_inner').height() + 70;

			var speed;
			if(height > 0 && height < 601){
				speed = 800;
			} else if(height > 600 && height < 1201){
				speed = 1500;
			} else{
				speed = 2100;
			}
			$this.find('.more_facts_outer').css({'height':'0px','display':'none','opacity':'0'});

			$this.find('.more_facts_button').on("mouseenter",function(){
				$j(this).css('color',$j(this).data('hovercolor'));
			}).on("mouseleave",function() {
				if(!$this.find('.more_facts_outer').is(':visible')){
					$j(this).css('color',$j(this).data('color'));
				}
			});

			$this.find('.more_facts_button').click(function(){
				if(!$this.find('.more_facts_outer').is(':visible')){
					$this.find('.more_facts_fake_arrow').fadeIn(speed);
					$this.addClass('more_fact_opened');
					$j(this).parent().parent().find('.more_facts_outer').css({'display':'block','opacity':'1'}).stop().animate({'height': height+30}, speed, function() {
						if($j('.parallax_section_holder').length) {
							initParallax();
						}
					});
					$j(this).find('.more_facts_button_text').text($less_label);
					$j(this).find('.more_facts_button_arrow').addClass('rotate_arrow');
				} else {
					$this.find('.more_facts_fake_arrow').fadeOut(speed);
					$j(this).parent().parent().find('.more_facts_outer').stop().animate({'height': '0px'}, speed,function(){
						$j(this).css({'display':'none','opacity':'0'});

						if(!$this.find('.more_facts_button').is(":hover")){$this.find('.more_facts_button').css('color',$this.find('.more_facts_button').data('color'));}
						$this.removeClass('more_fact_opened');
						if($j('.parallax_section_holder').length) {
							initParallax();
						}
					});
					$j(this).find('.more_facts_button_text').text($more_label);
					$j(this).find('.more_facts_button_arrow').removeClass('rotate_arrow');
				}
			});
		});
	}
}

/*
 ** Calculating minimal height for content when paspartu is enabled
 */

function contentMinHeightWithPaspartu(){
	"use strict";

	if ($j('.paspartu_enabled').length) {
		var content_height;
		var paspartu_final_width_px = 0;
		var paspartu_width_px = $window_width*paspartu_width;
		var footer_height = $j('footer').height();

		paspartu_final_width_px = 2*paspartu_width_px;

		content_height = $window_height - header_height - paspartu_final_width_px - footer_height;

		if($j('.content').length){
			$j('.content').css('min-height',content_height);
		}
	}
}

/*
 **	Replace plceholder
 */
function placeholderReplace(){
	"use strict";

	$j('#contact-form [placeholder]').focus(function() {
		var input = $j(this);
		if (input.val() === input.attr('placeholder')) {
			if (this.originalType) {
				this.type = this.originalType;
				delete this.originalType;
			}
			input.val('');
			input.removeClass('placeholder');
		}
	}).blur(function() {
		var input = $j(this);
		if (input.val() === '') {
			if (this.type === 'password') {
				this.originalType = this.type;
				this.type = 'text';
			}
			input.addClass('placeholder');
			input.val(input.attr('placeholder'));
		}
	}).blur();

	$j('#contact-form [placeholder]').parents('form').submit(function () {
		$j(this).find('[placeholder]').each(function () {
			var input = $j(this);
			if (input.val() === input.attr('placeholder')) {
				input.val('');
			}
		});
	});
}

function totop_button(a) {
	"use strict";

	var b = $j("#back_to_top");
	b.removeClass("off on");
	if (a === "on") { b.addClass("on"); } else { b.addClass("off"); }
}

function backButtonShowHide(){
	"use strict";

	$j(window).scroll(function () {
		var b = $j(this).scrollTop();
		var c = $j(this).height();
		var d;
		if (b > 0) { d = b + c / 2; } else { d = 1; }
		if (d < 1e3) { totop_button("off"); } else { totop_button("on"); }
	});
}

function backToTop(){
	"use strict";

	$j(document).on('click','#back_to_top',function(e){
		e.preventDefault();

		$j('body,html').animate({scrollTop: 0}, $j(window).scrollTop()/3, 'linear');
	});
}

/*
 **	Init message height
 */
function initMessageHeight(){
	"use strict";
	if($j('.q_message.with_icon').length){
		$j('.q_message.with_icon').each(function(){
			if($j(this).find('.message_text_holder').height() > $j(this).find('.q_message_icon_holder').height()) {
				$j(this).find('.q_message_icon_holder').height($j(this).find('.message_text').height());
			} else {
				$j(this).find('.message_text').height($j(this).find('.q_message_icon_holder').height());
			}
		});
	}
}

/**
 * Init image hover
 */
function initImageHover() {
	"use strict";
	if($j('.image_hover').length){
		$j('.image_hover').each(function(){
			$j(this).appear(function() {

				var default_visible_time = 300;
				var transition_delay = $j(this).attr('data-transition-delay');
				var real_transition_delay = default_visible_time + parseFloat(transition_delay);
				var object = $j(this);

				//wait for other hovers to complete
				setTimeout(function() {
					object.addClass('show');
				}, parseFloat(transition_delay));

				//hold that image a little, than remove class
				setTimeout(function() {
					object.removeClass('show');
				}, real_transition_delay);

			},{accX: 0, accY: -200});
		});
	}
}

/*
 * Initializes vertical progress bars
 */
function initProgressBarsVertical(){
	"use strict";

	if($j('.q_progress_bars_vertical').length){
		$j('.q_progress_bars_vertical').each(function() {
			$j(this).appear(function() {
				initToCounterVerticalProgressBar($j(this));
				var percentage = $j(this).find('.progress_content').data('percentage');
				$j(this).find('.progress_content').css('height', '0%');
				$j(this).find('.progress_content').animate({
					height: percentage+'%'
				}, 1500);
			},{accX: 0, accY: -150});
		});
	}
}

/*
 * Initializes vertical progress bar count to max value
 */
function initToCounterVerticalProgressBar($this){
	"use strict";

	if($this.find('.progress_number span').length){
		$this.find('.progress_number span').each(function() {
			var $max = parseFloat($j(this).text());
			$j(this).countTo({
				from: 0,
				to: $max,
				speed: 1500,
				refreshInterval: 50
			});
		});
	}
}

/*
 *	Check if there is anchor on load and scroll to it
 */
function checkAnchorOnLoad(){
	"use strict";

	var hash = window.location.hash;
	var scrollToAmount;
	var top_header_height;
	var paspartuScrollAdd = $j('body').hasClass('paspartu_enabled') ? $window_width*paspartu_width : 0;
	if(hash !== "" && $j('[data-q_id="'+hash+'"]').length > 0){
		if($j('header.page_header').hasClass('fixed') && !$j('body').hasClass('vertical_menu_enabled')){
			if($j('header.page_header').hasClass('scroll_top')){
				top_header_height = 33;
			}else{
				top_header_height = 0;
			}

			if(!$j('header.page_header').hasClass('transparent') || $j('header.page_header').hasClass('scrolled_not_transparent')) {
				if(header_height - ($j('[data-q_id="' + hash + '"]').offset().top + top_header_height)/4 >= min_header_height_scroll){
					var diff_of_header_and_section = $j('[data-q_id="' + hash + '"]').offset().top -  header_height - paspartuScrollAdd;
					scrollToAmount = diff_of_header_and_section + (diff_of_header_and_section/4) + (diff_of_header_and_section/16) + (diff_of_header_and_section/64) + 1; //several times od dividing to minimize the error, because fixed header is shrinking while scroll, 1 is just to ensure
				}else{
					if($j('header.page_header').hasClass('centered_logo')){
						scrollToAmount = $j('[data-q_id="' + hash + '"]').offset().top - min_header_height_scroll - logo_height - 20 - paspartuScrollAdd; //20 is top margin of logo
					} else {
						scrollToAmount = $j('[data-q_id="' + hash + '"]').offset().top - min_header_height_scroll - paspartuScrollAdd;
					}
				}
			}else{
				scrollToAmount = $j('[data-q_id="' + hash + '"]').offset().top - paspartuScrollAdd;
			}
		} else if($j('header.page_header').hasClass('fixed_hiding') && !$j('body').hasClass('vertical_menu_enabled')){
			if(!$j('header.page_header').hasClass('transparent') || $j('header.page_header').hasClass('scrolled_not_transparent')) {
				if ($j('[data-q_id="' + hash + '"]').offset().top - (header_height + logo_height / 2 + 40) <= scroll_amount_for_fixed_hiding) {
					scrollToAmount = $j('[data-q_id="' + hash + '"]').offset().top - header_height - logo_height / 2 - 40 - paspartuScrollAdd; //40 is top/bottom margin of logo
				} else {
					scrollToAmount = $j('[data-q_id="' + hash + '"]').offset().top - min_header_height_fixed_hidden - 40 - paspartuScrollAdd; //40 is top/bottom margin of logo
				}
			}else{
				scrollToAmount = $j('[data-q_id="' + hash + '"]').offset().top - paspartuScrollAdd;
			}
		}else if($j('header.page_header').hasClass('stick') || $j('header.page_header').hasClass('stick_with_left_right_menu') && !$j('body').hasClass('vertical_menu_enabled')) {
			if(!$j('header.page_header').hasClass('transparent') || $j('header.page_header').hasClass('scrolled_not_transparent')) {
				if (sticky_amount >= $j('[data-q_id="' + hash + '"]').offset().top) {
					scrollToAmount = $j('[data-q_id="' + hash + '"]').offset().top + 1 - paspartuScrollAdd; // 1 is to show sticky menu
				} else {
					scrollToAmount = $j('[data-q_id="' + hash + '"]').offset().top - min_header_height_sticky - paspartuScrollAdd;
				}
			}else{
				scrollToAmount = $j('[data-q_id="' + hash + '"]').offset().top - paspartuScrollAdd;
			}
		} else{
			scrollToAmount = $j('[data-q_id="' + hash + '"]').offset().top - paspartuScrollAdd;
		}
		$j('html, body').animate({
			scrollTop: Math.round(scrollToAmount)
		}, 1500, function() {});
	}

	//remove active state on anchors if section is not visible
	$j(".main_menu a, .vertical_menu a, .mobile_menu a").each(function(){
		var i = $j(this).prop("hash");
		if(i !== "" && ($j('[data-q_id="' + i + '"]').length > 0) && ($j('[data-q_id="' + i + '"]').offset().top >= $window_height) && $scroll === 0){
			$j(this).parent().removeClass('active');
			$j(this).removeClass('current');
		}
	});
}

/*
 *	Check active state of anchor links on scroll
 */
function changeActiveState(id){
	"use strict";

	if($j(".main_menu a[href*='#']").length) {
		$j('.main_menu a').parent().removeClass('active');
	}

	$j(".main_menu a").each(function(){
		var i = $j(this).prop("hash");
		if(i === id){
			if($j(this).closest('.second').length === 0){
				$j(this).parent().addClass('active');
			}else{
				$j(this).closest('.second').parent().addClass('active');
			}
			$j('.main_menu a').removeClass('current');
			$j(this).addClass('current');
		}
	});

	if($j(".vertical_menu a[href*='#']").length) {
		$j('.vertical_menu a').parent().removeClass('active');
	}

	$j(".vertical_menu a").each(function(){
		var i = $j(this).prop("hash");
		if(i === id){
			if($j(this).closest('.second').length === 0){
				$j(this).parent().addClass('active');
			}else{
				$j(this).closest('.second').parent().addClass('active');
			}
			$j('.vertical_menu a').removeClass('current');
			$j(this).addClass('current');
		}
	});

	if($j(".mobile_menu a[href*='#']").length) {
		$j('.mobile_menu a').parent().removeClass('active');
	}

	$j(".mobile_menu a").each(function(){
		var i = $j(this).prop("hash");
		if(i === id){
			if($j(this).closest('.sub_menu').length === 0){
				$j(this).parent().addClass('active');
			}else{
				$j(this).closest('.sub_menu').parent().addClass('active');
			}
			$j('.mobile_menu a').removeClass('current');
			$j(this).addClass('current');
		}
	});
}

/*
 *	Check active state of anchor links on scroll
 */
function checkAnchorOnScroll(){
	"use strict";

	if($j('[data-q_id]').length && !$j('header.page_header').hasClass('regular')){
		$j('[data-q_id]').waypoint( function(direction) {
			if(direction === 'down') {
				changeActiveState($j(this).data("q_id"));
			}
		}, { offset: '50%' });

		$j('[data-q_id]').waypoint( function(direction) {
			if(direction === 'up') {
				changeActiveState($j(this).data("q_id"));
			}
		}, { offset: function(){
			return -($j(this).outerHeight() - 150);
		} });
	}
}

/*
 *	Init scroll to section link if that link has hash value
 */
function initHashClick(){
	"use strict";

	var $doc = $j('html, body');
	var scrollToAmount;
	var paspartuScrollAdd = $j('body').hasClass('paspartu_enabled') ? $window_width*paspartu_width : 0;

	$j(document).on( "click", ".main_menu a, .vertical_menu a, .qbutton:not(.contact_form_button), .anchor, .widget li.anchor a", function(){
		var $this = $j(this);
		var hash = $j(this).prop("hash");
		var top_header_height;
		if((hash !== "" && $j(this).attr('href').split('#')[0] === "") || (hash !== "" && $j(this).attr('href').split('#')[0] !== "" && hash === window.location.hash) || (hash !== "" && $j(this).attr('href').split('#')[0] === window.location.href.split('#')[0])){ //in third condition 'hash !== ""' stays to prevent reload of page when link is active and ajax enabled
			if($j('header.page_header').hasClass('fixed') && !$j('body').hasClass('vertical_menu_enabled')){
				if($j('header.page_header').hasClass('scroll_top')){
					top_header_height = 33;
				}else{
					top_header_height = 0;
				}

				if(!$j('header.page_header').hasClass('transparent') || $j('header.page_header').hasClass('scrolled_not_transparent')) {
					if (header_height - ($j('[data-q_id="' + hash + '"]').offset().top + top_header_height) / 4 >= min_header_height_scroll) {
						var diff_of_header_and_section = $j('[data-q_id="' + hash + '"]').offset().top - header_height - paspartuScrollAdd;
						scrollToAmount = diff_of_header_and_section + (diff_of_header_and_section / 4) + (diff_of_header_and_section / 16) + (diff_of_header_and_section / 64) + 1; //several times od dividing to minimize the error, because fixed header is shrinking while scroll, 1 is just to ensure
					} else {
						if($j('header.page_header').hasClass('centered_logo')){
							scrollToAmount = $j('[data-q_id="' + hash + '"]').offset().top - min_header_height_scroll - logo_height - 20 - paspartuScrollAdd; //20 is top margin of logo
						} else {
							scrollToAmount = $j('[data-q_id="' + hash + '"]').offset().top - min_header_height_scroll - paspartuScrollAdd;
						}
					}
				}else{
					scrollToAmount = $j('[data-q_id="' + hash + '"]').offset().top - paspartuScrollAdd;
				}
			} else if($j('header.page_header').hasClass('fixed_hiding') && !$j('body').hasClass('vertical_menu_enabled')){
				if(!$j('header.page_header').hasClass('transparent') || $j('header.page_header').hasClass('scrolled_not_transparent')) {
					if ($j('[data-q_id="' + hash + '"]').offset().top - (header_height + logo_height / 2 + 40) <= scroll_amount_for_fixed_hiding) {
						scrollToAmount = $j('[data-q_id="' + hash + '"]').offset().top - header_height - logo_height / 2 - 40 - paspartuScrollAdd; //20 is top/bottom margin of logo
					} else {
						scrollToAmount = $j('[data-q_id="' + hash + '"]').offset().top - min_header_height_fixed_hidden - 40 - paspartuScrollAdd; //20 is top/bottom margin of logo
					}
				}else{
					scrollToAmount = $j('[data-q_id="' + hash + '"]').offset().top - paspartuScrollAdd;
				}
			}else if($j('header.page_header').hasClass('stick') || $j('header.page_header').hasClass('stick_with_left_right_menu') && !$j('body').hasClass('vertical_menu_enabled')) {
				if(!$j('header.page_header').hasClass('transparent') || $j('header.page_header').hasClass('scrolled_not_transparent')) {
					if (sticky_amount >= $j('[data-q_id="' + hash + '"]').offset().top) {
						if($j('[data-q_id="' + hash + '"]').offset().top != 0) {
							scrollToAmount = $j('[data-q_id="' + hash + '"]').offset().top + 1 - paspartuScrollAdd; // 1 is to show sticky menu
						}
						else {
							scrollToAmount = $j('[data-q_id="' + hash + '"]').offset().top - paspartuScrollAdd; // if scrolled top to first section, don't add 1px as empty space remains bellow section if it is fullscreen slider
						}
					} else {
						scrollToAmount = $j('[data-q_id="' + hash + '"]').offset().top - min_header_height_sticky - paspartuScrollAdd;
					}
				}else{
					scrollToAmount = $j('[data-q_id="' + hash + '"]').offset().top - paspartuScrollAdd;
				}
			} else{
				scrollToAmount = $j('[data-q_id="' + hash + '"]').offset().top - paspartuScrollAdd;
			}

			if($j('[data-q_id="'+hash+'"]').length > 0){
				$doc.stop().animate({
					scrollTop: Math.round(scrollToAmount)
				}, 1500, function() {
					anchorActiveState($this);
				});
			}

			if(history.pushState) {
				history.pushState(null, null, hash);
			}
			return false;
		}
	});

	$j(document).on( "click", ".mobile_menu a", function(){
		var $this = $j(this);
		var hash = $j(this).prop("hash");
		if((hash !== "" && $j(this).attr('href').split('#')[0] === "") || (hash !== "" && $j(this).attr('href').split('#')[0] !== "" && hash === window.location.hash) || (hash !== "" && $j(this).attr('href').split('#')[0] === window.location.href.split('#')[0])){ //in third condition 'hash !== ""' stays to prevent reload of page when link is active and ajax enabled

			if($j('[data-q_id="'+hash+'"]').length > 0){
				$doc.animate({
					scrollTop: Math.round($j('[data-q_id="'+hash+'"]').offset().top - $j('.mobile_menu').height())
				}, 500,function(){
					anchorActiveState($this);
				});
			}
			if(history.pushState) {
				history.pushState(null, null, hash);
			}
			return false;
		}
	});
}

/*
 **	Calculate height for animated text icon shortcode
 */
function animatedTextIconHeight(){
	"use strict";

	if($j('.animated_icons_with_text').length){
		var $icons = $j('.animated_icons_with_text');
		var maxHeight;

		$icons.find('.animated_text p').each(function() {
			maxHeight = maxHeight > $j(this).height() ? maxHeight : $j(this).height();
		});

		if(maxHeight < 155) {
			maxHeight = 155;

		}
		$icons.find('.animated_icon_with_text_inner').height(maxHeight);
	}
}

/*
 **	Add class to items in last row in animated text icon shortcode
 */
function countAnimatedTextIconPerRow(){
	"use strict";

	if($j('.animated_icons_with_text').length){
		$j('.animated_icons_with_text').each(function() {
			var $icons = $j(this);
			var qode_icons_height = $icons.height();
			var qode_icons_width = $icons.width();
			var maxHeightIcons;
			var iconWidth = $icons.find('.animated_icon_with_text_holder').width() + 1; // 1px because safari round on smaller number
			var countIcons = $icons.find('.animated_icon_with_text_holder').length;
			$icons.find('.animated_icon_with_text_holder').each(function() {
				maxHeightIcons = maxHeightIcons > $j(this).height() ? maxHeightIcons : $j(this).height();
			});
			maxHeightIcons = maxHeightIcons + 30; //margin for client is 30
			var numberOfIconsPerRow =  Math.ceil((qode_icons_width/iconWidth));
			var numberOffullRows = Math.floor(countIcons / numberOfIconsPerRow);
			var numberOfIconsInLastRow = countIcons - (numberOfIconsPerRow * numberOffullRows);
			if(numberOfIconsInLastRow === 0){
				numberOfIconsInLastRow = numberOfIconsPerRow;
			}
			$icons.find( ".animated_icon_with_text_holder" ).removeClass('border-bottom-none');
			var item_start_from = countIcons - numberOfIconsInLastRow - 1;
			$icons.find( ".animated_icon_with_text_holder:gt("+ item_start_from +")" ).addClass('border-bottom-none');
		});
	}
}

/*
 *	Set active state in maim menu on anchor click
 */
function anchorActiveState(me){
	if(me.closest('.main_menu').length > 0){
		$j('.main_menu a').parent().removeClass('active');
	}

	if(me.closest('.vertical_menu').length > 0){
		$j('.vertical_menu a').parent().removeClass('active');
	}

	if(me.closest('.second').length === 0){
		me.parent().addClass('active');
	}else{
		me.closest('.second').parent().addClass('active');
	}
	if(me.closest('.mobile_menu').length > 0){
		$j('.mobile_menu a').parent().removeClass('active');
		me.parent().addClass('active');
	}

	$j('.mobile_menu a, .main_menu a, .vertical_menu a').removeClass('current');
	me.addClass('current');
}

/*
 **	Video background initialization
 */
function initVideoBackground(){
	"use strict";

	$j('.video-wrap .video').mediaelementplayer({
		enableKeyboard: false,
		iPadUseNativeControls: false,
		pauseOtherPlayers: false,
		// force iPhone's native controls
		iPhoneUseNativeControls: false,
		// force Android's native controls
		AndroidUseNativeControls: false
	});

	//mobile check
	if(navigator.userAgent.match(/(Android|iPod|iPhone|iPad|IEMobile|Opera Mini)/)){
		initVideoBackgroundSize();
		$j('.mobile-video-image').show();
		$j('.video-wrap').remove();
	}
}

/*
 **	Calculate video background size
 */
function initVideoBackgroundSize(){
	"use strict";

	$j('.section .video-wrap').each(function(i){

		var $sectionWidth = $j(this).closest('.section').outerWidth();
		$j(this).width($sectionWidth);

		var $sectionHeight = $j(this).closest('.section').outerHeight();
		min_w = vid_ratio * ($sectionHeight+20);
		$j(this).height($sectionHeight);

		var scale_h = $sectionWidth / video_width_original;
		var scale_v = ($sectionHeight - header_height) / video_height_original;
		var scale =  scale_v;
		if (scale_h > scale_v)
			scale =  scale_h;
		if (scale * video_width_original < min_w) {scale = min_w / video_width_original;}

		$j(this).find('video, .mejs-overlay, .mejs-poster').width(Math.ceil(scale * video_width_original +2));
		$j(this).find('video, .mejs-overlay, .mejs-poster').height(Math.ceil(scale * video_height_original +2));
		$j(this).scrollLeft(($j(this).find('video').width() - $sectionWidth) / 2);
		$j(this).find('.mejs-overlay, .mejs-poster').scrollTop(($j(this).find('video').height() - ($sectionHeight)) / 2);
		$j(this).scrollTop(($j(this).find('video').height() - ($sectionHeight)) / 2);
	});

	$j('.carousel .item .video .video-wrap').each(function(i){

		var $slideWidth = $j(window).width();
		$j(this).width($slideWidth);

		var mob_header = $j(window).width() < 1000 ? $j('header.page_header').height() - 6 : 0; // 6 is because of the display: inline-block
		var $slideHeight = $j(this).closest('.carousel.slide').height() - mob_header;

		min_w = vid_ratio * ($slideHeight+20);
		$j(this).height($slideHeight);

		var scale_h = $slideWidth / video_width_original;
		var scale_v = ($slideHeight - header_height) / video_height_original;
		var scale =  scale_v;
		if (scale_h > scale_v)
			scale =  scale_h;
		if (scale * video_width_original < min_w) {scale = min_w / video_width_original;}

		$j(this).find('video, .mejs-overlay, .mejs-poster').width(Math.ceil(scale * video_width_original +2));
		$j(this).find('video, .mejs-overlay, .mejs-poster').height(Math.ceil(scale * video_height_original +2));
		$j(this).scrollLeft(($j(this).find('video').width() - $slideWidth) / 2);
		$j(this).find('.mejs-overlay, .mejs-poster').scrollTop(($j(this).find('video').height() - ($slideHeight)) / 2);
		$j(this).scrollTop(($j(this).find('video').height() - ($slideHeight)) / 2);
	});

	$j('.portfolio_single .video .video-wrap, .blog_holder .video .video-wrap').each(function(i){

		var $this = $j(this);

		var $videoWidth = $j(this).closest('.video').outerWidth();
		$j(this).width($videoWidth);
		var $videoHeight = ($videoWidth*9)/16;

		if(navigator.userAgent.match(/(Android|iPod|iPhone|iPad|IEMobile|Opera Mini)/)){
			$this.parent().width($videoWidth);
			$this.parent().height($videoHeight);
		}

		min_w = vid_ratio * ($videoHeight+20);
		$j(this).height($videoHeight);

		var scale_h = $videoWidth / video_width_original;
		var scale_v = ($videoHeight - header_height) / video_height_original;
		var scale =  scale_v;
		if (scale_h > scale_v)
			scale =  scale_h;
		if (scale * video_width_original < min_w) {scale = min_w / video_width_original;}

		$j(this).find('video, .mejs-overlay, .mejs-poster').width(Math.ceil(scale * video_width_original +2));
		$j(this).find('video, .mejs-overlay, .mejs-poster').height(Math.ceil(scale * video_height_original +2));
		$j(this).scrollLeft(($j(this).find('video').width() - $videoWidth) / 2);
		$j(this).find('.mejs-overlay, .mejs-poster').scrollTop(($j(this).find('video').height() - ($videoHeight)) / 2);
		$j(this).scrollTop(($j(this).find('video').height() - ($videoHeight)) / 2);
	});

}

/*
 **	Icon With Text animation effect
 */
function initIconWithTextAnimation(){
	"use strict";
	if($j('.q_icon_animation').length > 0 && $j('.no_animation_on_touch').length === 0){
		$j('.q_icon_animation').each(function(){
			$j(this).appear(function() {
				$j(this).addClass('q_show_animation');
			},{accX: 0, accY: -100});
		});
	}
}

/*
 **	Add class on body if browser is Safari
 */
function initCheckSafariBrowser(){
	"use strict";

	if (navigator.userAgent.indexOf('Safari') !== -1 && navigator.userAgent.indexOf('Chrome') === -1) {
		$j('body').addClass('safari_browser');
	}
}

/*
 **	Add class on body if browser is Firefox Mac
 */
function initCheckFirefoxMacBrowser(){
	"use strict";

	var browser = navigator.userAgent.toLowerCase();
	var os = navigator.appVersion.toLowerCase();

	if (browser.indexOf('firefox') > -1 && os.indexOf("mac") > -1) {
		$j('body').addClass('firefox_mac_browser');
	}
}




/*
 **	Initialize Qode search form
 */
function initSearchButton(){

	if($j('.search_button.from_window_top').length){
		$j('.search_button.from_window_top').click(function(e){
			e.preventDefault();

			if($j('html').hasClass('touch')){
				if ($j('.qode_search_form').height() == "0") {
					$j('.qode_search_form input[type="text"]').onfocus = function () {
						window.scrollTo(0, 0);
						document.body.scrollTop = 0;
					};
					$j('.qode_search_form input[type="text"]').onclick = function () {
						window.scrollTo(0, 0);
						document.body.scrollTop = 0;
					};
					$j('.header_top_bottom_holder').css('top',search_header_height+"px");
					$j('.qode_search_form').css('height',search_header_height+"px");
					$j('.content_inner').css('margin-top',search_header_height+"px");
					if($scroll < 34){ $j('header.page_header').css('top','0'); }
				} else {
					$j('.qode_search_form').css('height','0');
					$j('.header_top_bottom_holder').css('top','0');
					$j('.content_inner').css('margin-top','0');
					if($scroll < 34){ $j('header.page_header').css('top',-$scroll);}
				}

				$j(window).scroll(function() {
					if ($j('.qode_search_form').height() != "0" && $scroll > 50) {
						$j('.qode_search_form').css('height','0');
						$j('.header_top_bottom_holder').css('top','0');
						$j('.content_inner').css('margin-top','0');
					}
				});

				$j('.qode_search_close').click(function(e){
					e.preventDefault();
					$j('.qode_search_form').css('height','0');
					$j('.header_top_bottom_holder').css('top','0');
					$j('.content_inner').css('margin-top','0');
					if($scroll < 34){ $j('header.page_header').css('top',-$scroll);}
				});

			} else {
				if($j('.title').hasClass('has_fixed_background')){
					var yPos = parseInt($j('.title.has_fixed_background').css('backgroundPosition').split(" ")[1]);
				}else {
					var yPos = 0;
				}
				if ($j('.qode_search_form').height() == "0") {
					$j('.qode_search_form input[type="text"]').focus();
					$j('.header_top_bottom_holder').stop().animate({top:search_header_height+"px"},150);
					$j('.qode_search_form').stop().animate({height:search_header_height+"px"},150);
					$j('.content_inner').stop().animate({marginTop:search_header_height+"px"},150);
					if($scroll < 34){ $j('header.page_header').stop().animate({top:0},150); }
					$j('.title.has_fixed_background').animate({
						'background-position-y': (yPos + 50)+'px'
					}, 150);
				} else {
					$j('.qode_search_form').stop().animate({height:"0"},150);
					$j('.header_top_bottom_holder').stop().animate({top:"0px"},150);
					$j('.content_inner').stop().animate({marginTop:"0"},150);
					if($scroll < 34){ $j('header.page_header').stop().animate({top:-$scroll},150);}
					$j('.title.has_fixed_background').animate({
						'background-position-y': (yPos - 50)+'px'
					}, 150);
				}

				$j(window).scroll(function() {
					if ($j('.qode_search_form').height() != "0" && $scroll > 50) {
						$j('.qode_search_form').stop().animate({height:"0"},150);
						$j('.header_top_bottom_holder').stop().animate({top:"0px"},150);
						$j('.content_inner').stop().animate({marginTop:"0"},150);
						$j('.title.has_fixed_background').css('backgroundPosition', 'center '+(yPos)+'px');
					}
				});

				$j('.qode_search_close').click(function(e){
					e.preventDefault();
					$j('.qode_search_form').stop().animate({height:"0"},150);
					$j('.content_inner').stop().animate({marginTop:"0"},150);
					$j('.header_top_bottom_holder').stop().animate({top:"0px"},150);
					if($scroll < 34){ $j('header.page_header').stop().animate({top:-$scroll},150);}
					$j('.title.has_fixed_background').animate({
						'background-position-y': (yPos)+'px'
					}, 150);
				});
			}
		});
	}

	//search type - fullscreen search
	if($j(".fullscreen_search").length){
		$j('.fullscreen_search').on('click',function(e){
			e.preventDefault();
			if($j('.fullscreen_search_holder').hasClass('animate')) {
				$j('body').removeClass('fullscreen_search_opened');
				$j('.fullscreen_search_holder').removeClass('animate');
				$j('body').removeClass('search_fade_out');
				$j('body').removeClass('search_fade_in');
				if(!$j('body').hasClass('page-template-full_screen-php')){
					qodeEnableScroll();
				}
			} else {
				$j('body').addClass('fullscreen_search_opened');
				$j('body').removeClass('search_fade_out');
				$j('body').addClass('search_fade_in');
				$j('.fullscreen_search_holder').addClass('animate');
				if(!$j('body').hasClass('page-template-full_screen-php')){
					qodeDisableScroll();
				}
			}
		});
		$j('.fullscreen_search_close').on('click',function(e){
			e.preventDefault();
			$j('body').removeClass('fullscreen_search_opened');
			$j('.fullscreen_search_holder').removeClass('animate');
			$j('body').removeClass('search_fade_in');
			$j('body').addClass('search_fade_out');
			if(!$j('body').hasClass('page-template-full_screen-php')){
				qodeEnableScroll();
			}
		});
	}

}

/*
 **	Init update Shopping Cart
 */
function updateShoppingCart(){
	"use strict";

	$j('body').bind('added_to_cart', add_to_cart);
	function add_to_cart(event, parts, hash) {
		var miniCart = $j('.shopping_cart_header');
		if ( parts['div.widget_shopping_cart_content'] ) {
			var $cartContent = jQuery(parts['div.widget_shopping_cart_content']),
				$itemsList = $cartContent .find('.cart_list'),
				$total = $cartContent.find('.total').contents(':not(strong)').text();
			miniCart.find('.shopping_cart_dropdown_inner').html('').append($itemsList);
			miniCart.find('.total span').html('').append($total);
		}
	}
}

/*
 **	Set content bottom margin because of the uncovering footer
 */
function setContentBottomMargin(){
	if($j('.uncover').length){
		$j('.content').css('margin-bottom', $j('footer').height());
	}
}

/*
 **	Set footer uncover with vertical area
 */
function footerWidth(){
	"use strict";

	if($j('.uncover').length && $j('body').hasClass('vertical_menu_enabled') && $window_width > 1000){
		$j('.uncover').width($window_width -  $j('.vertical_menu_area').width());
	} else{
		$j('.uncover').css('width','100%');
	}
}

/*
 **	Init footer height for left border line
 */
function setFooterHeight(){
	"use strict";

	if($window_width > 600){
		$j('.footer_top > div').innerHeight();
		$j(".footer_top .qode_column").css('min-height', 0).css('min-height', $j('.footer_top > div').innerHeight());
	}
}

/*
 **	Boxes which reveal text on hover
 */
function initCoverBoxes(){
	if($j('.cover_boxes').length) {
		$j('.cover_boxes').each(function(){
			var active_element = 0;
			var data_active_element = 1;
			if(typeof $j(this).data('active-element') !== 'undefined' && $j(this).data('active-element') !== false) {
				data_active_element = parseFloat($j(this).data('active-element'));
				active_element = data_active_element - 1;
			}

			var number_of_columns = 3;

			//validate active element
			active_element = data_active_element > number_of_columns ? 0 : active_element;

			$j(this).find('li').eq(active_element).addClass('act');
			var cover_boxed = $j(this);
			$j(this).find('li').each(function(){
				$j(this).hover(function() {
					$j(cover_boxed).find('li').removeClass('act');
					$j(this).addClass('act');
				});

			});
		});
	}
}

/*
 **	Create content menu from selected rows
 */
function createContentMenu(){
	"use strict";

	var content_menu = $j(".content_menu");
	content_menu.each(function(){
		if($j(this).find('ul').length === 0){

			if($j(this).css('background-color') !== ""){
				var background_color = $j(this).css('background-color');
			}

			var content_menu_ul = $j("<ul class='menu'></ul>");
			content_menu_ul.appendTo($j(this));

			var sections = $j(this).siblings('.in_content_menu');

			if(sections.length){
				sections.each(function(){
					var section_href = $j(this).data("q_id");
					var section_title = $j(this).data('q_title');
					var section_icon = $j(this).data('q_icon');

					var li = $j("<li />");
					var icon = $j("<i />", {"class": section_icon});
					var link = $j("<a />", {"href": section_href, "html": "<span>" + section_title + "</span>"});
					var arrow;
					if(background_color !== ""){
						arrow = $j("<div />", {"class": 'arrow', "style": 'border-color: '+background_color+' transparent transparent transparent'});
					} else {
						arrow = $j("<div />", {"class": 'arrow'});
					}
					icon.prependTo(link);
					link.appendTo(li);
					arrow.appendTo(li);
					li.appendTo(content_menu_ul);

				});
			}
		}
	});
}

/*
 **	Create content menu (select menu for responsiveness)from selected rows
 */
function createSelectContentMenu(){
	"use strict";

	var content_menu = $j(".content_menu");
	content_menu.each(function(){

		var $this = $j(this);

		var $menu_select = $j("<ul></ul>");
		$menu_select.appendTo($j(this).find('.nav_select_menu'));


		$j(this).find("ul.menu li a").each(function(){

			var menu_url = $j(this).attr("href");
			var menu_text = $j(this).text();
			var menu_icon = $j(this).find('i').clone();

			if ($j(this).parents("li").length === 2) { menu_text = "&nbsp;&nbsp;&nbsp;" + menu_text; }
			if ($j(this).parents("li").length === 3) { menu_text = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" + menu_text; }
			if ($j(this).parents("li").length > 3) { menu_text = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" + menu_text; }

			var li = $j("<li />");
			var link = $j("<a />", {"href": menu_url, "html": menu_text});
			menu_icon.prependTo(link);
			link.appendTo(li);
			li.appendTo($menu_select);
		});


		$this.find(".nav_select_button").on('click', function() {
			if ($this.find('.nav_select_menu ul').is(":visible")){
				$this.find('.nav_select_menu ul').slideUp();
			} else {
				$this.find('.nav_select_menu ul').slideDown();
			}
			return false;
		});

		$this.find(".nav_select_menu ul li a").on('click',function () {
			$this.find('.nav_select_menu ul').slideUp();
			var $link = $j(this);

			var $target = $link.attr("href");
			var targetOffset = $j("div.wpb_row[data-q_id='" + $target + "'],section.parallax_section_holder[data-q_id='" + $target + "']").offset().top;

			$j('html,body').stop().animate({scrollTop: targetOffset }, 500, 'swing', function(){
				$j('nav.content_menu ul li').removeClass('active');
				$link.parent().addClass('active');
			});

			return false;
		});
	});
}

/*
 **	Calculate content menu position and fix it when needed
 */
function contentMenuPosition(){
	"use strict";

	if($j('nav.content_menu').length){

		if(content_menu_position > sticky_amount){
			var x = min_header_height_sticky;
		}else{
			var x = 0;
		}

		if(content_menu_position - x - content_menu_top_add - $scroll <= 0 && ($j('header').hasClass('stick') || $j('header').hasClass('stick_with_left_right_menu'))){

			if(content_menu_position < sticky_amount){
				if($scroll > sticky_amount){
					$j('nav.content_menu').css({'position': 'fixed', 'top': min_header_height_sticky + content_menu_top_add}).addClass('fixed');

				}else{
					$j('nav.content_menu').css({'position': 'fixed', 'top': 0, transition:'none'}).addClass('fixed');
				}
			}else{
				$j('nav.content_menu').css({'position': 'fixed', 'top': min_header_height_sticky + content_menu_top_add}).addClass('fixed');
			}
			$j('header.sticky').addClass('no_shadow');
			$j('.content > .content_inner > .container > .container_inner').css('margin-top',content_line_height);
			$j('.content > .content_inner > .full_width').css('margin-top',content_line_height);

		} else if(content_menu_position - content_menu_top - content_menu_top_add - $scroll <= 0 && !($j('header').hasClass('stick'))) {
			$j('nav.content_menu').css({'position': 'fixed', 'top': content_menu_top + content_menu_top_add}).addClass('fixed');
			$j('.content > .content_inner > .container > .container_inner').css('margin-top',content_line_height);
			$j('.content > .content_inner > .full_width').css('margin-top',content_line_height);
		} else {
			$j('nav.content_menu').css({'position': 'relative', 'top': '0px'}).removeClass('fixed');
			$j('header.sticky').removeClass('no_shadow');
			$j('.content > .content_inner > .container > .container_inner').css('margin-top','0px');
			$j('.content > .content_inner > .full_width').css('margin-top','0px');
		}

		$j('.content .in_content_menu').waypoint( function(direction) {
			var $active = $j(this);
			var id = $active.data("q_id");

			$j("nav.content_menu.fixed li a").each(function(){
				var i = $j(this).attr("href");
				if(i === id){
					$j(this).parent().addClass('active');
				}else{
					$j(this).parent().removeClass('active');
				}
			});
		}, { offset: '150' });
	}
}

/*
 **	Check first and last content menu included rows for active state in content menu
 */
function contentMenuCheckLastSection(){
	"use strict";

	if($j('nav.content_menu').length){

		if($j('.content .in_content_menu').length){
			var last_from_top = $j('.content .in_content_menu:last').offset().top + $j('.content .in_content_menu:last').height();
			var first_from_top = $j('.content .in_content_menu:first').offset().top - content_menu_top - content_menu_top_add - 72; //72 is height of content menu
			if(last_from_top < $scroll){
				$j("nav.content_menu.fixed li").removeClass('active');
			}
			if(first_from_top > $scroll){
				$j('nav.content_menu li:first, nav.content_menu ul.menu li:first').removeClass('active');

			}
		}
	}
}

/*
 **	Scroll to section when item in content menu is clicked
 */
function contentMenuScrollTo(){
	"use strict";

	if($j('nav.content_menu').length){

		$j("nav.content_menu ul.menu li a").on('click', function(e){
			e.preventDefault();
			var $this = $j(this);

			if($j(this).parent().hasClass('active')){
				return false;
			}

			var $target = $this.attr("href");
			var targetOffset = $j("div.wpb_row[data-q_id='" + $target + "'],section.parallax_section_holder[data-q_id='" + $target + "']").offset().top - content_line_height - content_menu_top - content_menu_top_add;

			$j('html,body').stop().animate({scrollTop: targetOffset }, 500, 'swing', function(){
				$j('nav.content_menu ul li').removeClass('active');
				$this.parent().addClass('active');
			});

			return false;
		});
	}
}

function initButtonHover() {
	"use strict";

	if($j('.qbutton').length) {
		$j('.qbutton').each(function() {

			//hover background color
			if(typeof $j(this).data('hover-background-color') !== 'undefined' && $j(this).data('hover-background-color') !== false) {
				var hover_background_color = $j(this).data('hover-background-color');
				var initial_background_color = $j(this).css('background-color');
				$j(this).hover(
					function() {
						$j(this).css('background-color', hover_background_color);
					},
					function() {
						$j(this).css('background-color', initial_background_color);
					});
			}

			//hover border color
			if(typeof $j(this).data('hover-border-color') !== 'undefined' && $j(this).data('hover-border-color') !== false) {
				var hover_border_color = $j(this).data('hover-border-color');
				var initial_border_color = $j(this).css('border-top-color');
				$j(this).hover(
					function() {
						$j(this).css('border-color', hover_border_color);
					},
					function() {
						$j(this).css('border-color', initial_border_color);
					});
			}

			//hover color
			if(typeof $j(this).data('hover-color') !== 'undefined' && $j(this).data('hover-color') !== false) {
				var hover_color = $j(this).data('hover-color');
				var initial_color = $j(this).css('color');
				$j(this).hover(
					function() {
						$j(this).css('color', hover_color);
					},
					function() {
						$j(this).css('color', initial_color);
					});
			}
		});
	}
}

function initSocialIconHover() {
	"use strict";

	if($j('.q_social_icon_holder').length) {
		$j('.q_social_icon_holder').each(function() {

			var hover_style   = '';
			var initial_style = '';

			//hover background color
			if(typeof $j(this).data('hover-background-color') !== 'undefined' && $j(this).data('hover-background-color') !== false && $j(this).find('.simple_social').length === 0) {
				var hover_background_color = $j(this).data('hover-background-color');
				hover_style += 'background-color: '+ hover_background_color + '!important;';
			}

			if($j(this).find('.simple_social').length === 0){
				var initial_background_color = $j(this).find('.fa-stack').css('background-color');
				initial_style += 'background-color: '+ initial_background_color + '!important;';
			}

			//hover border color
			if(typeof $j(this).data('hover-border-color') !== 'undefined' && $j(this).data('hover-border-color') !== false && $j(this).find('.simple_social').length === 0) {
				var hover_border_color = $j(this).data('hover-border-color');
				hover_style += 'border-color: '+ hover_border_color + '!important;';
			}

			if($j(this).find('.simple_social').length === 0){
				var initial_border_color = $j(this).find('.fa-stack').css('border-color');
				initial_style += 'border-color: '+ initial_border_color + '!important;';
			}

			//hover color
			if(typeof $j(this).data('hover-color') !== 'undefined' && $j(this).data('hover-color') !== false) {
				var hover_color = $j(this).data('hover-color');
				hover_style += 'color: '+ hover_color + '!important;';
			}

			var initial_color = $j(this).css('color');

			if($j(this).find('.fa-stack .social_icon').length) {
				initial_color = $j(this).find('.fa-stack').css('color');
			} else if($j(this).find('.simple_social').length) {
				initial_color = $j(this).find('.simple_social').css('color');
			}

			initial_style += 'color: '+ initial_color + '!important;';

			if(hover_style !== ""){
				if($j(this).find('.fa-stack .social_icon').length) {
					$j(this).find('.fa-stack').hover(
						function() {
							$j(this).attr('style', function() { return hover_style; });
						},
						function() {
							$j(this).attr('style', function() { return initial_style; });
						});
				} else if($j(this).find('.simple_social').length) {
					$j(this).find('.simple_social').hover(
						function() {
							$j(this).attr('style', function() { return hover_style; });
						},
						function() {
							$j(this).attr('style', function() { return initial_style; });
						});
				}
			}
		});
	}
}

function initIconHover() {
	"use strict";

	if($j('.q_icon_shortcode').length) {
		$j('.q_icon_shortcode').each(function() {

			var hover_background_style, hover_border_style, hover_color_style = '';
			var initial_background_style, initial_border_style, initial_color_style = '';
			var hover_link_style = '';
			var initial_link_style = '';

			//hover background color
			if(typeof $j(this).data('hover-background-color') !== 'undefined' && $j(this).data('hover-background-color') !== false && $j(this).hasClass('normal') === false) {
				hover_background_style = $j(this).data('hover-background-color');
			}

			if(!$j(this).hasClass('normal')){
				initial_background_style = $j(this).css('background-color');
			}

			//hover border color
			if(typeof $j(this).data('hover-border-color') !== 'undefined' && $j(this).data('hover-border-color') !== false && $j(this).hasClass('normal') === false) {
				hover_border_style = $j(this).data('hover-border-color');
			}

			if($j(this).hasClass('normal') === false){
				initial_border_style = $j(this).css('border-color');
			}

			//hover color
			if(typeof $j(this).data('hover-color') !== 'undefined' && $j(this).data('hover-color') !== false) {
				hover_color_style = $j(this).data('hover-color');
				hover_link_style += 'color: '+ hover_color_style + ';';
			}

			initial_color_style = $j(this).css('color');
			initial_link_style += 'color: '+ initial_color_style + ';';


			if(hover_background_style !== "" || hover_border_style !== "" || hover_color_style !== "") {
				$j(this).hover(
					function () {
						if(hover_background_style !== "")
							$j(this).css("background-color", hover_background_style);
						if(hover_border_style !== "")
							$j(this).css("border-color", hover_border_style);
						if(hover_color_style !== "")
							$j(this).css("color", hover_color_style);
						$j(this).find('a').attr('style', function () {
							return hover_link_style;
						});
					},
					function () {
						if(hover_background_style !== "")
							$j(this).css("background-color", initial_background_style);
						if(hover_border_style !== "")
							$j(this).css("border-color", initial_border_style);
						if(hover_color_style !== "")
							$j(this).css("color", initial_color_style);
						$j(this).find('a').attr('style', function () {
							return initial_link_style;
						});
					}
				);
			}
		});
	}
}

/*
 **	Popup menu initialization
 */
function initPopupMenu(){
	"use strict";

	if($j('a.popup_menu').length){
		//var body_top;

		//set height of popup holder and initialize nicescroll
		$j(".popup_menu_holder_outer").height($window_height).niceScroll({
			scrollspeed: 30,
			mousescrollstep: 20,
			cursorwidth: 0,
			cursorborder: 0,
			cursorborderradius: 0,
			cursorcolor: "transparent",
			autohidemode: false,
			horizrailenabled: false
		}); //200 is top and bottom padding of holder

		//set height of popup holder on resize
		$j(window).resize(function() {
			$j(".popup_menu_holder_outer").height($window_height);
		});

		// Open popup menu
		$j('a.popup_menu').on('click',function(e){
			e.preventDefault();

			if(!$j(this).hasClass('opened')){
				$j(this).addClass('opened');
				$j('body').addClass('popup_menu_opened');
				if(!$j('body').hasClass('page-template-full_screen-php')){
					qodeDisableScroll();
				}
			}else{
				$j(this).removeClass('opened');
				$j('body').removeClass('popup_menu_opened');

				if(!$j('body').hasClass('page-template-full_screen-php')){
					qodeEnableScroll();
				}

				setTimeout(function(){
					$j("nav.popup_menu ul.sub_menu").slideUp(200, function(){
						$j('nav.popup_menu').getNiceScroll().resize();
					});
				},400);

			}
		});

		//logic for open sub menus in popup menu
		$j(".popup_menu > ul > li.has_sub > a, .popup_menu > ul > li.has_sub > h6").on('tap click', function (e) {
			e.preventDefault();

			if ($j(this).closest('li.has_sub').find("> ul.sub_menu").is(":visible")){
				$j(this).closest('li.has_sub').find("> ul.sub_menu").slideUp(200, function(){
					$j('.popup_menu_holder_outer').getNiceScroll().resize();
				});
				$j(this).closest('li.has_sub').removeClass('open_sub');
			} else {
				$j(this).closest('li.has_sub').addClass('open_sub');
				$j(this).closest('li.has_sub').find("> ul.sub_menu").slideDown(200, function(){
					$j('.popup_menu_holder_outer').getNiceScroll().resize();
				});
			}

			return false;
		});

		//if link has no submenu and if it's not dead, than open that link
		$j(".popup_menu ul li:not(.has_sub) a").click(function () {
			if(($j(this).attr('href') !== "http://#") && ($j(this).attr('href') !== "#")){
				$j('a.popup_menu').removeClass('opened');
				$j('body').removeClass('popup_menu_opened').css('overflow','visible');
				$j("nav.popup_menu ul.sub_menu").slideUp(200, function(){
					$j('nav.popup_menu').getNiceScroll().resize();
				});
				qodeEnableScroll();
			}else{
				return false;
			}
		});
	}
}

/*
 **	Image Gallery Slider with no space initialization
 */
function initImageGallerySliderNoSpace(){
	"use strict";

	if($j('.qode_image_gallery_no_space').length){
		$j('.qode_image_gallery_no_space').each(function(){
			$j(this).animate({'opacity': 1},1000);
			$j(this).find('.qode_image_gallery_holder').lemmonSlider({infinite: true});
		});

		//disable click on non active image


		if (!$j(".qode_image_gallery_no_space").hasClass("link_all")) {
			$j('.qode_image_gallery_no_space').on('click', 'li:not(.active) a', function () {
				if (window.innerWidth > 800) {
					return false;
				}
				else {
					return true;
				}
			});
		}
	}
}

function initFullScreenTemplate(){
	"use strict";

	if($j('.full_screen_section_slide').length){
		$j('.full_screen_section_slide').closest('.full_screen_section').addClass('full_screen_section_slides');
	}

	if($j('.full_screen_holder').length && $window_width > 600){

		$j('.full_screen_preloader').css('height', ($window_height));

		$j('#up_fs_button').on('click', function() {
			$j.fn.fullpage.moveSectionUp();
			return false;
		});

		$j('#down_fs_button').on('click', function() {
			$j.fn.fullpage.moveSectionDown();
			return false;
		});

		var $header_height = 0;
		if($j('header.page_header').length){
			if($window_width > 1400){
				$header_height = $j('header.page_header').height() + 45; //45 is default distance
			} else {
				$header_height = $j('header.page_header').height() + 10; //10 is distance for responsive
			}
		}

		$j('.full_screen_navigation_holder.up_arrow').css('top',$header_height);

		var section_number = $j('.full_screen_inner > .full_screen_section').length;
		$j('.full_screen_inner').fullpage({
			sectionSelector: '.full_screen_section',
			slideSelector: '.full_screen_section_slide',
			scrollOverflow: true,
			afterLoad: function(anchorLink, index){
				checkActiveArrowsOnFullScrrenTemplate(section_number, index);
			},
			afterRender: function(){
				checkActiveArrowsOnFullScrrenTemplate(section_number, 1);
				$j('.full_screen_holder').find('.full_screen_navigation_holder').css('visibility','visible');
				$j('.full_screen_holder').find('.full_screen_inner').css('visibility','visible');
				$j('.full_screen_preloader').hide();
				if($j('.full_screen_holder video.full_screen_sections_video').length){
					$j('.full_screen_holder video.full_screen_sections_video').each(function(){
						$j(this).get(0).play();
					});
				}
			}
		});
	}
}

function checkActiveArrowsOnFullScrrenTemplate(section_number, index){
	"use strict";

	if(index == '1'){
		$j('.full_screen_navigation_holder.up_arrow').hide();
		$j('.full_screen_navigation_holder.down_arrow').hide();
		if(index != section_number){
			$j('.full_screen_navigation_holder.down_arrow').show();
		}
	}else if(index == section_number){
		$j('.full_screen_navigation_holder.down_arrow').hide();
		if(section_number == '2'){
			$j('.full_screen_navigation_holder.up_arrow').show();
		}
	}else{
		$j('.full_screen_navigation_holder.up_arrow').show();
		$j('.full_screen_navigation_holder.down_arrow').show();
	}
}

function alterWPMLSwitcherHeaderBottom() {
	"use strict";

	if($j('.header_bottom li.menu-item-language').length) {
		var langDropdown = $j('.header_bottom .menu-item-language').find('.submenu-languages');

		if(typeof langDropdown !== 'undefined') {
			langDropdown.parent('li').addClass('narrow');
			langDropdown.wrap('<div class="second"><div class="inner"></div></div>');
			langDropdown.show();
		}


	}
}

/*
 **	Init testimonials shortcode
 */
function initTwitterShortcode(){
	"use strict";

	if($j('.qode_twitter_shortcode').length){
		$j('.qode_twitter_shortcode').each(function(){
			$j(this).appear(function() {
				$j(this).css('visibility','visible');
			},{accX: 0, accY: -100});

			var interval = 5000;
			if(typeof $j(this).data('auto-rotate-slides') !== 'undefined' && $j(this).data('auto-rotate-slides') !== false) {
				interval = parseFloat($j(this).data('auto-rotate-slides')) * 1000;
			}

			var slideshow = true;
			if(interval === 0) {
				slideshow = false;
			}

			var animation = 'fade';
			if(typeof $j(this).data('animation-type') !== 'undefined' && $j(this).data('animation-type') !== false) {
				animation = $j(this).data('animation-type');
			}

			var controlNav = true;
			if(typeof $j(this).data('show-navigation') !== 'undefined') {
				controlNav = $j(this).data('show-navigation') == 'no' ? false : true;
			}

			var directionNav = true;
			if(typeof $j(this).data('show-arrows') !== 'undefined') {
				directionNav = $j(this).data('show-arrows') == 'no' ? false : true;
			}

			var animationSpeed = 600;
			if(typeof $j(this).data('animation-speed') !== 'undefined' && $j(this).data('animation-speed') !== false) {
				animationSpeed = $j(this).data('animation-speed');
			}

			$j(this).flexslider({
				animationLoop: true,
				controlNav: controlNav,
				directionNav: directionNav,
				prevText: "<span class='arrow_carrot-left'></span>",
				nextText: "<span class='arrow_carrot-right'></span>",
				useCSS: false,
				pauseOnAction: true,
				pauseOnHover: false,
				slideshow: slideshow,
				animation: animation,
				itemMargin: 25,
				minItems: 1,
				maxItems: 1,
				animationSpeed: animationSpeed,
				slideshowSpeed: interval,
				start: function(slider){
					initParallax();
				}
			});
		});

	}
}

/*
 ** Sticky info on portfolio single
 */
var headerOffset = 0;
function stickyInfoPortfolio($scroll, stickyInfoTopOffset, stickyInfoHeight){
	"use strict";

	if($j('.portfolio_single_sticky').length){

		if($j('.portfolio_single.fixed-left').length){
			var info_width = $j('.portfolio_single_sticky').parent().innerWidth();
		}

		if($j('header.page_header').hasClass('regular') || $j(window).width() <= 1000){
			headerOffset =0;
		}else if($j('header.page_header').hasClass('fixed_top_header')){
			headerOffset = $j('header.page_header .top_header').height();
		}else if($j('header.page_header').hasClass('stick') || $j('header.page_header').hasClass('stick_with_left_right_menu')) {
			if(sticky_amount > stickyInfoTopOffset) {
				if (sticky_amount >= $scroll) {
					headerOffset = 0;
					// check if scroll is going up or down because timeout removes class as soon as it is added
					if ($scroll_direction == 'down'){
						$j('.portfolio_single_sticky').removeClass('portfolio_single_sticky_animate_top');
					} else {
						setTimeout(function () {
							$j('.portfolio_single_sticky').removeClass('portfolio_single_sticky_animate_top');
						}, 330); //because this needs delay until animation in css is finished (0.2s)
					}

				} else {
					headerOffset = $j('header.page_header').height();
					$j('.portfolio_single_sticky').addClass('portfolio_single_sticky_animate_top');

				}
			}else {
				headerOffset = $j('header.page_header').height();
			}
		} else{
			headerOffset = $j('header.page_header').height();
		}

		var containerInnerPadding = parseInt($j('.content .container .container_inner.default_template_holder').css('padding-top'));
		if($scroll >= stickyInfoTopOffset - headerOffset - containerInnerPadding){
			var infoPosition= headerOffset + containerInnerPadding; //is for container top padding  for top padding
			$j('.portfolio_single_sticky').addClass('stick');
			$j('.portfolio_single_sticky.stick').css('top',infoPosition + 'px');

			if($j('.portfolio_single.fixed-left').length){
				$j('.portfolio_single.fixed-left .column2').css('padding-left',info_width + 'px');
			}

			//move sidebar up when hits the footer

			var footer_in_viewport =0;
			var uncover_footer=0;
			if($j('.uncover').length && (($j('.no-touch').length && $j(window).width() > 1000) || ($j('.touch').length && $j(window).width() > 1300))){
				uncover_footer = parseInt($j('.content').css('margin-bottom'));
				footer_in_viewport = $j(document).height() - $window_height - uncover_footer;
			}else{
				footer_in_viewport = $j('footer').offset().top - $window_height;
			}

			var info_from_bottom_of_screen = $window_height - (stickyInfoHeight + infoPosition + 130); // 130 is for bottom margin and navigation

			if($scroll - footer_in_viewport > info_from_bottom_of_screen){
				$j('.portfolio_single_sticky.stick').css('margin-top', -($scroll - footer_in_viewport - info_from_bottom_of_screen));
			}else{
				$j('.portfolio_single_sticky.stick').css('margin-top',0);
			}

		} else{
			$j('.portfolio_single_sticky').removeClass('stick');
			$j('.portfolio_single_sticky').css('top','0');
			if($j('.portfolio_single.fixed-left').length){
				$j('.portfolio_single.fixed-left .column2').css('padding-left','0');
			}
			$j('.portfolio_single_sticky').css('margin-top',0);
		}
	}
}

/*
 ** Sticky portfolio info  width
 */

function stickyInfoPortfolioWidth(){
	"use strict";
	if($j('.portfolio_single_sticky').length){
		var info_width = $j('.portfolio_single_sticky').parent().width();
		$j('.portfolio_single_sticky').css('width',info_width + 'px');
	}
}

function removeStickyInfoPortfolioClass(){
	"use strict";
	if($j('.portfolio_single_sticky').length){
		if($j(window).width() <= 600){
			if($j('.portfolio_single_sticky').hasClass('stick')){
				$j('.portfolio_single_sticky').removeClass('stick portfolio_single_sticky_animate_top');
				$j('.portfolio_single_sticky').css('width','auto');
				$j('.portfolio_single_sticky').css('top','auto');
				$j('.portfolio_single_sticky').css('margin-top',0);
				if($j('.portfolio_single.fixed-left').length){
					$j('.portfolio_single.fixed-left .column2').css('padding-left','0');
				}
			}
		}
	}
}

// disabling scroll function
// left: 37, up: 38, right: 39, down: 40,
// spacebar: 32, pageup: 33, pagedown: 34, end: 35, home: 36
var keys = [37, 38, 39, 40];

function preventDefaultValue(e) {
	"use strict";
	e = e || window.event;
	if (e.preventDefault)
		e.preventDefault();
	e.returnValue = false;
}


function disableKeydown(e) {
	"use strict";
	for (var i = keys.length; i--;) {
		if (e.keyCode === keys[i]) {
			preventDefaultValue(e);
			return;
		}
	}
}

function disableWheel(e) {
	"use strict";
	preventDefaultValue(e);
}

function qodeDisableScroll() {
	"use strict";
	if (window.addEventListener) {
		window.addEventListener('DOMMouseScroll', disableWheel, false);
	}

	window.onmousewheel = document.onmousewheel = disableWheel;
	document.onkeydown = disableKeydown;

	if($j('body').hasClass('smooth_scroll')){
		window.removeEventListener('mousedown', mousedown, false);
		window.removeEventListener('mousewheel', wheel, false);
	}
}

function qodeEnableScroll() {
	"use strict";
	if (window.removeEventListener) {
		window.removeEventListener('DOMMouseScroll', disableWheel, false);
	}
	window.onmousewheel = document.onmousewheel = document.onkeydown = null;

	if($j('body').hasClass('smooth_scroll')){
		window.addEventListener('mousedown', mousedown, false);
		window.addEventListener('mousewheel', wheel, false);
	}
}