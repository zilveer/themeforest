  (function($){
    "use strict";
    $(document).ready(function(){

        try {
    // variable is undefined
        

      
    $(".royalSlider").royalSlider({
        autoPlay: {
            enabled: true,
            pauseOnHover: true,
            delay: cpslidervars.delay
        },
        arrowsNav: cpslidervars.arrowsNav,
        fadeinLoadedSlide: cpslidervars.fadeinLoadedSlide,
        controlNavigationSpacing: 0,
        controlNavigation: 'thumbnails',
        globalCaption:true,
        thumbs: {
            autoCenter: false,
            fitInViewport: true,
            orientation: 'vertical',
            spacing: 0,
            paddingBottom: 0
        },
        keyboardNavEnabled: cpslidervars.keyboardNavEnabled,
        imageScaleMode: cpslidervars.imageScaleMode,
        imageAlignCenter:true,
        slidesSpacing: 0,
        slidesOrientation: cpslidervars.slidesOrientation,
        transitionType: cpslidervars.transitionType,
        transitionSpeed: cpslidervars.transitionSpeed,
        loop: false,
        loopRewind: true,
        numImagesToPreload: 3,
    });

} catch(e) { /* ignore */ }
/* ------------------ End Document ------------------ */
});

})(this.jQuery);
