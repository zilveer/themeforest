/**
 * Remove preloading animation after entire page is loaded.
 */
(function ($) {
    "use strict";
    $(document).ready(function () {
        $("body").imagesLoaded({ background: true }, function(){
            // Trigger before classes added
            $("body").trigger("pre_tl_page_loaded");

            setTimeout(function () {
                if($("html").hasClass("ie8") || $("html").hasClass("ie9")){
                    $(".tl-loader-wrapper").fadeOut(1200);
                }else if($("html").hasClass("mobile")){ // mobile devices
                    $(".tl-loader-wrapper").css("display", "none");
                }else{ //desktop
                    $(".tl-loader-wrapper").addClass("animated fadeOut");
                    setTimeout(function(){
                        $(".tl-loader-wrapper").css("display", "none");
                    },600);
                }
                $("body").trigger("tl_page_loaded")
            }, 500);
        });
    });
}(jQuery));