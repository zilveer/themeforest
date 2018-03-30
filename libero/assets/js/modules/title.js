(function($) {
    "use strict";

    var title = {};
    mkd.modules.title = title;

    title.mkdParallaxTitle = mkdParallaxTitle;

    $(document).ready(function() {
        mkdParallaxTitle();
        mkdTitleAnimation();
    });

    $(window).load(function() {
        
    });

    $(window).resize(function() {

    });

    /*
     **	Title image with parallax effect
     */
    function mkdParallaxTitle(){
        if($('.mkd-title.mkd-has-parallax-background').length > 0 && $('.touch').length === 0){

            var parallaxBackground = $('.mkd-title.mkd-has-parallax-background');
            var parallaxBackgroundWithZoomOut = $('.mkd-title.mkd-has-parallax-background.mkd-zoom-out');

            var backgroundSizeWidth = parseInt(parallaxBackground.data('background-width').match(/\d+/));
            var titleHolderHeight = parallaxBackground.data('height');
            var titleRate = (titleHolderHeight / 10000) * 7;
            var titleYPos = -(mkd.scroll * titleRate);

            //set position of background on doc ready
            parallaxBackground.css({'background-position': 'center '+ (titleYPos+mkdGlobalVars.vars.mkdAddForAdminBar) +'px' });
            parallaxBackgroundWithZoomOut.css({'background-size': backgroundSizeWidth-mkd.scroll + 'px auto'});

            //set position of background on window scroll
            $(window).scroll(function() {
                titleYPos = -(mkd.scroll * titleRate);
                parallaxBackground.css({'background-position': 'center ' + (titleYPos+mkdGlobalVars.vars.mkdAddForAdminBar) + 'px' });
                parallaxBackgroundWithZoomOut.css({'background-size': backgroundSizeWidth-mkd.scroll + 'px auto'});
            });

        }
    }

    /*
     ** Animation on load
     */
    function mkdTitleAnimation(){
        if($('.mkd-title.mkd-title-animation').length > 0){
            var titleArea = $('.mkd-title.mkd-title-animation');

            $('.mkd-title.mkd-title-animation').waitForImages({
                waitForAll: true,
                finished: function() {
                    titleArea.addClass('appeared');
                }
            });

        }
    }

})(jQuery);
