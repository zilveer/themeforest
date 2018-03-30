(function($) {
    "use strict";

    var title = {};
    eltd.modules.title = title;

    title.eltdParallaxTitle = eltdParallaxTitle;

    title.eltdOnDocumentReady = eltdOnDocumentReady;
    title.eltdOnWindowLoad = eltdOnWindowLoad;
    title.eltdOnWindowResize = eltdOnWindowResize;
    title.eltdOnWindowScroll = eltdOnWindowScroll;

    $(document).ready(eltdOnDocumentReady);
    $(window).load(eltdOnWindowLoad);
    $(window).resize(eltdOnWindowResize);
    $(window).scroll(eltdOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function eltdOnDocumentReady() {
        eltdParallaxTitle();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function eltdOnWindowLoad() {

    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function eltdOnWindowResize() {

    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function eltdOnWindowScroll() {

    }
    

    /*
     **	Title image with parallax effect
     */
    function eltdParallaxTitle(){
        if($('.eltd-title.eltd-has-parallax-background').length > 0 && $('.touch').length === 0){

            var parallaxBackground = $('.eltd-title.eltd-has-parallax-background');
            var parallaxBackgroundWithZoomOut = $('.eltd-title.eltd-has-parallax-background.eltd-zoom-out');

            var backgroundSizeWidth = parseInt(parallaxBackground.data('background-width').match(/\d+/));
            var titleHolderHeight = parallaxBackground.data('height');
            var titleRate = (titleHolderHeight / 10000) * 7;
            var titleYPos = -(eltd.scroll * titleRate);

            //set position of background on doc ready
            parallaxBackground.css({'background-position': 'center '+ (titleYPos+eltdGlobalVars.vars.eltdAddForAdminBar) +'px' });
            parallaxBackgroundWithZoomOut.css({'background-size': backgroundSizeWidth-eltd.scroll + 'px auto'});

            //set position of background on window scroll
            $(window).scroll(function() {
                titleYPos = -(eltd.scroll * titleRate);
                parallaxBackground.css({'background-position': 'center ' + (titleYPos+eltdGlobalVars.vars.eltdAddForAdminBar) + 'px' });
                parallaxBackgroundWithZoomOut.css({'background-size': backgroundSizeWidth-eltd.scroll + 'px auto'});
            });

        }
    }

})(jQuery);
