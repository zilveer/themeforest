(function($) {
    "use strict";

    window.addEventListener("resize", function() {
        jQuery( "nav li").unbind( "touchstart" );
        different_mobile_menu();
        jQuery('li').removeClass('df-opend');

    }, false);


        

    $(document).ready(function(){
        different_mobile_menu();

        // Responsive top navigation
        $(".top_navigation_toggle").on( "click", function() {
            $(".top_navigation ul").toggle();
        });

        // Responsive site navigation
        $(".site_navigation_toggle").on( "click", function() {
            $(".site_navigation ul").toggle();
        });


        // Sticky menu
        if ($(window).width() > 993) {
           if(jQuery("#header_main.sticky").length) {
                jQuery("#header_main.sticky").wrap("<div class='header_main-parent'></div>").attr("rel", jQuery("#header_main.sticky").offset().top).parent().height(jQuery("#header_main.sticky").height());
            }
        };



        // Accordions
        $(".accordion_content").accordion({
            collapsible: true,
            heightStyle: "content",
            icons: false,
            active: false,
            animate: false
        });

        // Review animated
        $('.review_footer span').viewportChecker({
            classToAdd: 'visible animated',
            classToRemove: 'hidden', 
            offset: 0
        });

        // Images animated
        $("img:not(.content_slider img, .post .entry_media img, .layout_post_3 .item_thumb img,.tb_widget_overlay_list .item .item_thumb img,.tb_widget_border_list .item .item_thumb img)").viewportChecker({
            classToAdd: 'visible animated',
            classToRemove: 'hidden', 
            offset: 0
        });

        // Content slider
        $(".content_slider ul").bxSlider({
            adaptiveHeight: true,
            mode: "horizontal",
            auto: true,
            controls: true,
            pager: false,
            captions: false,
            prevText: "&#xf053;",
            nextText: "&#xf054;"
        });

        // Wide slider
        $(".wide_slider ul").bxSlider({
            adaptiveHeight: true,
            mode: "fade",
            auto: true,
            controls: true,
            captions: false,
            prevText: "&#xf053;",
            nextText: "&#xf054;",
            pagerCustom: "#wide_slider_pager"
        });

        // Popup images
        $(".popup_link").magnificPopup({
            type: "image",
            mainClass: "mfp-with-zoom",
            zoom: {
                enabled: true,
                duration: 300,
                easing: 'ease-in-out',
                opener: function (openerElement) {
                    return openerElement.is("img") ? openerElement : openerElement.find("img");
                }
            }
        });

        // Tabs
        $(".tab_content").tabs();

        // Fitvids
        $(".container").fitVids();
        
        // Gallery single
        jQuery("#gallery_single ul").bxSlider({
            adaptiveHeight: true,
            mode: "fade",
            auto: false,
            controls: true,
            captions: false,
            prevText: "&#xf053;",
            nextText: "&#xf054;",
            pagerCustom: "#gallery_pager"
        });
       
        // Content carousel
        $(".col_9_of_12 .content_carousel ul", "#wrapper").not(".col_9_of_12 .col_12_of_12 .content_carousel ul").bxSlider({
            minSlides: 1,
            maxSlides: 3,
            adaptiveHeight: true,
            slideWidth: 420,
            slideMargin: 10,
            mode: "horizontal",
            auto: true,
            controls: true,
            pager: false,
            captions: false,
            prevText: "&#xf053;",
            nextText: "&#xf054;"
        });

        // Content carousel
        $(".col_12_of_12 .content_carousel ul", "#wrapper").not(".col_9_of_12 .col_12_of_12 .content_carousel ul").bxSlider({
            minSlides: 1,
            maxSlides: 3,
            adaptiveHeight: true,
            slideWidth: 370,
            slideMargin: 10,
            mode: "horizontal",
            auto: true,
            controls: true,
            pager: false,
            captions: false,
            prevText: "&#xf053;",
            nextText: "&#xf054;"
        });

        // Content carousel
        $(".col_9_of_12 .col_12_of_12 .content_carousel ul", "#wrapper").bxSlider({
            minSlides: 1,
            maxSlides: 2,
            adaptiveHeight: true,
            slideWidth: 400,
            slideMargin: 10,
            mode: "horizontal",
            auto: true,
            controls: true,
            pager: false,
            captions: false,
            prevText: "&#xf053;",
            nextText: "&#xf054;"
        });

        // Content carousel
        $(".col_6_of_12 .content_carousel ul", "#wrapper").bxSlider({
            minSlides: 1,
            maxSlides: 2,
            adaptiveHeight: true,
            slideWidth: 272,
            slideMargin: 10,
            mode: "horizontal",
            auto: true,
            controls: true,
            pager: false,
            captions: false,
            prevText: "&#xf053;",
            nextText: "&#xf054;"
        });


        // Back to top
        $("#back_to_top").hide();
        
        $(window).scroll(function () {
            if ($(this).scrollTop() > 100) {
                $("#back_to_top").fadeIn();
            } else {
                $("#back_to_top").fadeOut();
            }
        });
        $("#back_to_top a").on("click", function () {
            $("body,html").animate({
                scrollTop: 0
            }, 800);
            return false;
        });
        
        // Sticky sidebar
        $(".sidebar_area").theiaStickySidebar({
              additionalMarginTop: $(".sidebar_area").data('top'),
        });


    });
    
    // Sticky menu
    $(window).scroll(function () {
        var mainmenu = jQuery("#header_main.sticky");
        if (parseInt(mainmenu.attr("rel"),10) < Math.abs(parseInt(jQuery(window).scrollTop()),10)) {
            mainmenu.addClass("fixed");
        } else {
            mainmenu.removeClass("fixed");
        }
    });
    
    // Center caption in wide slider
    $(window).resize(function () {
        centerTopLeft();
        centerLeft();
    });
    $(window).load(function () {
        centerTopLeft();
        centerLeft();
    });
    function centerTopLeft()
    {
        var container = $(".wide_slider");
        var content = $(".wide_slider .slider_caption");
        content.css("left", (container.width() - content.width()) / 2);
        content.css("top", (container.height() - content.height()) / 2);
    }
    function centerLeft()
    {
        var container = $(".wide_slider");
        var content = $("#wide_slider_pager");
        content.css("left", (container.width() - content.width()) / 2);
        content.css("bottom", "0");
    }
    
    function different_mobile_menu() {
        // Touch mobile for menus
        if ( jQuery(window).width() > 992 ) {

            jQuery("nav li").on('touchstart', function(e) {
                if(jQuery(this).hasClass("df-dropdown") && !jQuery(this).hasClass("df-opend")) {
                    if(!jQuery(this).hasClass("df-opend")) {
                        jQuery(this).addClass("df-opend");
                        console.log('false '+jQuery(this).attr('id'));
                        return false;
                    }
                } else {
                    if(jQuery(this).hasClass("df-opend")){
                        jQuery(this).removeClass("df-opend");
                    }
                    console.log('true '+jQuery(this).attr('id'));
                }

            });
        }
    }
    
})(jQuery);



