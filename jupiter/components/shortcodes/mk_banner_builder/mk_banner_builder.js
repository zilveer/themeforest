(function($) {
    'use strict';

    var core = MK.core,
    	path = MK.core.path;

    MK.component.BannerBuilder = function( el ) {
    	var init = function(){
            var $this = $(el),
                  data = $this.data( 'bannerbuilder-config' );

            MK.core.loadDependencies([ MK.core.path.plugins + 'jquery.flexslider.js' ], function() {
                $this.flexslider({
                        selector: '.mk-banner-slides > .mk-banner-slide',
                        animation: data.animation,
                        smoothHeight: false,
                        direction:'horizontal',
                        slideshow: true,
                        slideshowSpeed: data.slideshowSpeed,
                        animationSpeed: data.animationSpeed,
                        pauseOnHover: true,
                        directionNav: data.directionNav,
                        controlNav: false,
                        initDelay: 2000,
                        prevText: '',
                        nextText: '',
                        pauseText: '',
                        playText: ''
                });
            });
    	};

    	return {
    		init : init
    	};
    };

})(jQuery);







