(function($) {
    "use strict";

    var title = {};
    qodef.modules.title = title;

    title.qodefParallaxTitle = qodefParallaxTitle;

    $(document).ready(function() {
        qodefParallaxTitle();
    });

    $(window).load(function() {


    });

    $(window).resize(function() {

    });

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
