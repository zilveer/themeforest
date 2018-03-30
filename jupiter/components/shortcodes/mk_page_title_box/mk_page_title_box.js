(function($) {
	'use strict';

	function mk_page_title_parallax() {
	    if (!MK.utils.isMobile() && mk_smooth_scroll !== 'false') {

	        $('.mk-effect-wrapper').each(function() {
	            var $this = $(this),
                	progressVal,
                    currentPoint,
                    ticking = false,
                    scrollY = MK.val.scroll(),
                    $window = $(window),
                    windowHeight = $(window).height(),
                    parentHeight = $this.outerHeight(),
                    startPoint = 0,
                    endPoint = $this.offset().top + parentHeight,
                    effectLayer = $this.find('.mk-effect-bg-layer'),
                    gradientLayer = effectLayer.find('.mk-effect-gradient-layer'),
                    cntLayer = $this.find('.mk-page-title-box-content'),
                    animation = effectLayer.attr('data-effect'),
                    top = $this.offset().top,
                    height = $this.outerHeight();

                var parallaxSpeed = 0.7,
                    zoomFactor = 1.3;

                var parallaxTopGap = function() {
                    var gap = top * parallaxSpeed;

                    effectLayer.css({
                        height : height + gap + 'px',
                        top : (-gap) + 'px'
                    });
                };


                if (animation == ("parallax" || "parallaxZoomOut") ) {
                    parallaxTopGap();
                }

                var animationSet = function() {
                    scrollY = MK.val.scroll();

                    if (animation == "parallax") {
                        currentPoint = (startPoint + scrollY) * parallaxSpeed;
                        effectLayer.get(0).style.transform = 'translateY(' + currentPoint + 'px)';
                    }

                    if (animation == "parallaxZoomOut") {
                    	console.log(effectLayer);
                        currentPoint = (startPoint + scrollY) * parallaxSpeed;
                        progressVal = (1 / (endPoint - startPoint) * (scrollY - startPoint));
                        var zoomCalc = zoomFactor - ((zoomFactor - 1) * progressVal);

                        effectLayer.get(0).style.transform = 'translateY(' + currentPoint + 'px) scale(' + zoomCalc + ')';
                    }

                    if (animation == "gradient") {
                        progressVal = (1 / (endPoint - startPoint) * (scrollY - startPoint));
                        gradientLayer.css({
                            opacity: progressVal * 2
                        });
                    }

                    if (animation != "gradient") {
                        progressVal = (1 / (endPoint - startPoint) * (scrollY - startPoint));
                        cntLayer.css({
                            opacity: 1 - (progressVal * 4)
                        });
                    }

                    // Stop ticking
                    ticking = false;
                };
                animationSet();

                // This will limit the calculation of the background position to
                // 60fps as well as blocking it from running multiple times at once
                var requestTick = function() {
                    if (!ticking) {
                        window.requestAnimationFrame(animationSet);
                        ticking = true;
                    }
                };

                $window.off('scroll', requestTick);
                $window.on('scroll', requestTick);

	        });
	    }
	}


	var $window = $(window);
	var debounceResize = null;

	$window.on('load', mk_page_title_parallax);
    $window.on("resize", function() {
        if( debounceResize !== null ) { clearTimeout( debounceResize ); }
        debounceResize = setTimeout( mk_page_title_parallax, 300 );
    });

}(jQuery));