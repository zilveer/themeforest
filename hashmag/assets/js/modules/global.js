(function($) {
    "use strict";

    window.mkdf = {};
    mkdf.modules = {};

    mkdf.scroll = 0;
    mkdf.window = $(window);
    mkdf.document = $(document);
    mkdf.windowWidth = $(window).width();
    mkdf.windowHeight = $(window).height();
    mkdf.body = $('body');
    mkdf.html = $('html, body');
    mkdf.menuDropdownHeightSet = false;
    mkdf.defaultHeaderStyle = '';
    mkdf.minVideoWidth = 1500;
    mkdf.videoWidthOriginal = 1280;
    mkdf.videoHeightOriginal = 720;
    mkdf.videoRatio = 1.61; // golden ration for video
    mkdf.boxedLayoutWidth = 1280;
    
    $(document).ready(function(){
        mkdf.scroll = $(window).scrollTop();
    });


    $(window).resize(function() {
        mkdf.windowWidth = $(window).width();
        mkdf.windowHeight = $(window).height();
    });


    $(window).scroll(function(){
        mkdf.scroll = $(window).scrollTop();
    });

})(jQuery);