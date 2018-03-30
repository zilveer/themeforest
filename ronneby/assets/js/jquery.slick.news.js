(function($) {
	$(document).ready(function() {
		$('.dfd-scrolling-news-wrap').each(function() {
			var $self = $(this),
				slides_top = $self.data('slides-top'),
				slides_bottom = $self.data('slides-bottom'),
				$top_carousel = $('.dfd-news-top', $self),
				$bottom_carousel = $('.dfd-news-bottom', $self);
			$top_carousel.slick({
				infinite: false,
				slidesToShow: slides_top,
				slidesToScroll: 1,
				arrows: false,
				dots: false,
				autoplay: false,
				cssEase: 'ease-in',
				speed: 1500,
				responsive: [
					{
						breakpoint: 960,
						settings: {
							slidesToShow: 1,
							infinite: false,
							arrows: false
						}
					}
				]
			});
			$bottom_carousel.slick({
				infinite: false,
				slidesToShow: slides_bottom,
				slidesToScroll: 1,
				arrows: false,
				dots: false,
				autoplay: false,
				cssEase: 'ease-out',
				speed: 1200,
				responsive: [
					{
						breakpoint: 960,
						settings: {
							slidesToShow: 2,
							infinite: false,
							arrows: false
						}
					}
				]
			});
			$top_carousel.on('beforeChange', function(event, slick, currentSlide, nextSlide) {
				if(currentSlide > nextSlide) {
					$bottom_carousel.slickPrev();
				} else {
					$bottom_carousel.slickNext();
				}
			});
			$bottom_carousel.on('beforeChange', function(event, slick, currentSlide, nextSlide) {
				if(currentSlide > nextSlide) {
					$top_carousel.slickPrev();
				} else {
					$top_carousel.slickNext();
				}
			});
			$self.find('>.slider-controls .slider-control.prev').click(function(e) {
				e.preventDefault();
				$top_carousel.slickPrev();
			});
			$self.find('>.slider-controls .slider-control.next').click(function(e) {
				e.preventDefault();
				$top_carousel.slickNext();
			});
			var mousewheelevt = (/Firefox/i.test(navigator.userAgent)) ? 'DOMMouseScroll' : 'mousewheel';
			$self.find('.dfd-scrolling-news-container').bind(mousewheelevt, function(e){
				var ev = window.event || e;
				ev = ev.originalEvent ? ev.originalEvent : ev;
				var delta = ev.detail ? ev.detail*(-40) : ev.wheelDelta;
				if(delta > 0 && $top_carousel.find('.slick-slide.slick-active').first().prev('.slick-slide').length > 0) {
					ev.preventDefault();
					//$(window).scrollTo($self, {duration:'fast'});
					$top_carousel.slickPrev();
				} else if(delta < 0 && $top_carousel.find('.slick-slide.slick-active').last().next('.slick-slide').length > 0) {
					ev.preventDefault();
					$top_carousel.slickNext();
				}
			});
		});
	});
})(jQuery);