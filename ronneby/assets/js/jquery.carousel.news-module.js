(function($){
	"use strict";
	$('.dfd-blog-module.posts_slider').each(function() {
		var $carouselWrap = $(this),
			$carousel = $('.posts-list', $carouselWrap),
			$window = $(window),
			windowWidth,
			slides_to_show = $carouselWrap.data('show-slides'),
			slides_to_scroll = $carouselWrap.data('scroll-slides'),
			enable_dots = $carouselWrap.data('dots'),
			auto_slideshow = $carouselWrap.data('autoplay'),
			slideshow_speed = $carouselWrap.data('slideshow-speed'),
			responsive_brekpoint_first = $carouselWrap.data('resp-width-first'),
			responsive_brekpoint_second = $carouselWrap.data('resp-width-second'),
			responsive_brekpoint_third = $carouselWrap.data('resp-width-third');
			
			if(!slides_to_show) slides_to_show = 4;
			if(!slides_to_scroll) slides_to_scroll = 1;
			if(!enable_dots) enable_dots = false;
			if(!auto_slideshow) auto_slideshow = false;
			if(!slideshow_speed) slideshow_speed = 3000;
			if(!responsive_brekpoint_first) responsive_brekpoint_first = 1280;
			if(!responsive_brekpoint_second) responsive_brekpoint_second = 4;
			if(!responsive_brekpoint_third) responsive_brekpoint_third = 4;
			var breakpoint_first = slides_to_show > 3 ? 3 : slides_to_show,
			breakpoint_second = slides_to_show > 2 ? 2 : slides_to_show;
			
		var postsCarouselFilter = function() {
			windowWidth = $window.width();
			if(windowWidth < 1600) {
				$carousel.slick('slickFilter','.post:not(.format-quote)');
			} else {
				$carousel.slick('slickUnfilter');
			}
		};
		$(document).ready(function(){
			$carousel.slick({
				infinite: true,
				slidesToShow: slides_to_show,
				slidesToScroll: slides_to_scroll,
				arrows: false,
				dots: enable_dots,
				autoplay: auto_slideshow,
				autoplaySpeed: slideshow_speed,
				responsive: [
					{
						breakpoint: responsive_brekpoint_first,
						settings: {
							slidesToShow: breakpoint_first,
							infinite: true,
							arrows: false
						}
					},
					{
						breakpoint: responsive_brekpoint_second,
						settings: {
							slidesToShow: breakpoint_second,
							infinite: true,
							arrows: false,
						}
					},
					{
						breakpoint: responsive_brekpoint_third,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1,
							arrows: false,
						}
					}
				]
			});
			postsCarouselFilter();
		});
		$window.on('load resize', postsCarouselFilter);
		$carouselWrap.find(".next").click(function(e) {
			$carousel.slickNext();

			e.preventDefault();
		});

		$carouselWrap.find(".prev").click(function(e) {
			$carousel.slickPrev();

			e.preventDefault();
		});
		$(".item", $carouselWrap).on("mousedown select",(function(e){
			e.preventDefault();
		}));
	});
})(jQuery);