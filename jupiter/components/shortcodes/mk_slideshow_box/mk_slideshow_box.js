(function($) {
   if (window.addEventListener) {
      window.addEventListener('load', handleLoad, false);
    }
    else if (window.attachEvent) {
      window.attachEvent('onload', handleLoad);
    }

	function handleLoad() {
		$('.mk-slideshow-box').each(run);
	}

	function run() {
		var $slider = $(this);
		var $slides = $slider.find('.mk-slideshow-box-item');
		var $transition_time = $slider.data('transitionspeed');
		var $time_between_slides = $slider.data('slideshowspeed');

		$slider.find('.mk-slideshow-box-content').children('p').filter(function() {
			if ( $.trim($(this).text()) == '' ) {
				return true;
			}
		}).remove();

		// set active classes
		$slides.first().addClass('active').fadeIn($transition_time, function(){
			setTimeout(autoScroll, $time_between_slides);
		});

		// auto scroll
		function autoScroll(){
			if (isTest) return;
			var $i = $slider.find('.active').index();
			$slides.eq($i).removeClass('active').fadeOut($transition_time);
			if ($slides.length == $i + 1) $i = -1; // loop to start
			$slides.eq($i + 1).addClass('active').fadeIn($transition_time, function() {
				setTimeout(autoScroll, $time_between_slides);
			});
		}
	}
}(jQuery));