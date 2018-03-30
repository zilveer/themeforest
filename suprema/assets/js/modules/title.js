(function($) {
    "use strict";

    var title = {};
    qodef.modules.title = title;

    title.qodefParallaxTitle = qodefParallaxTitle;

    title.qodefOnDocumentReady = qodefOnDocumentReady;
    title.qodefOnWindowLoad = qodefOnWindowLoad;
    title.qodefOnWindowResize = qodefOnWindowResize;
    title.qodefOnWindowScroll = qodefOnWindowScroll;

    $(document).ready(qodefOnDocumentReady);
    $(window).load(qodefOnWindowLoad);
    $(window).resize(qodefOnWindowResize);
    $(window).scroll(qodefOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function qodefOnDocumentReady() {
        qodefParallaxTitle();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function qodefOnWindowLoad() {

    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function qodefOnWindowResize() {

    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function qodefOnWindowScroll() {

    }
    

    /*
     **	Title image with parallax effect
     */
    function qodefParallaxTitle(){
        if($('.qodef-title.qodef-has-parallax-background').length > 0 && $('.touch').length === 0){

            var parallaxBackground = $('.qodef-title.qodef-has-parallax-background');
            var parallaxBackgroundWithZoomOut = $('.qodef-title.qodef-has-parallax-background.qodef-zoom-out');

            var backgroundSizeWidth = parseInt(parallaxBackground.data('background-width').match(/\d+/));
            var titleHolderHeight = parallaxBackground.data('height');
            var titleRate = (titleHolderHeight / 10000) * 7;
            var titleYPos = -(qodef.scroll * titleRate);

            //set position of background on doc ready
            parallaxBackground.css({'background-position': 'center '+ (titleYPos+qodefGlobalVars.vars.qodefAddForAdminBar) +'px' });
            parallaxBackgroundWithZoomOut.css({'background-size': backgroundSizeWidth-qodef.scroll + 'px auto'});

            //set position of background on window scroll
            $(window).scroll(function() {
                titleYPos = -(qodef.scroll * titleRate);
                parallaxBackground.css({'background-position': 'center ' + (titleYPos+qodefGlobalVars.vars.qodefAddForAdminBar) + 'px' });
                parallaxBackgroundWithZoomOut.css({'background-size': backgroundSizeWidth-qodef.scroll + 'px auto'});
            });

        }
    }

})(jQuery);
