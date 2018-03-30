var Videos = (function() {
	var $hero = $('.js-hero'),
		$mejs, $video,
		videoWidth, videoHeight, headerWidth, headerHeight;

	function init() {
		$video 			= $hero.find('video');

    	if ( ! $video.length ) return;

	    videoWidth      = $video.outerWidth();
	    videoHeight     = $video.outerHeight();
	    headerWidth     = $hero.outerWidth();
	    headerHeight    = $hero.outerHeight();

        $video.prop('muted', true);

    	stretch();
    	setTimeout(function(){
			$video.get(0).play();
    	}, 100);

        $window.on('debouncedresize', function() {
            headerWidth     = $hero.outerWidth();
            headerHeight    = $hero.outerHeight();
            stretch();
        });

	}

	function stretch() {

		var newWidth, newHeight;

		if ( (videoWidth/videoHeight) > (headerWidth/headerHeight) ) {
			newHeight = headerHeight;
			newWidth = newHeight * videoWidth / videoHeight;
		} else {
			newWidth = headerWidth;
			newHeight = newWidth * videoHeight / videoWidth;
		}

		$video.css({
			width: newWidth,
			height: newHeight
		});
	}

	return {
		init: init
	}
})();