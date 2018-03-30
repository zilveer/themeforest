
jQuery(function($){
    "use strict";

    setTimeout( function(){
        $('#preloader').fadeOut('slow',function(){$(this).remove();});
    },2200);

    if($("#owl-banner").length > 0){
        $("#owl-banner").owlCarousel({
            autoPlay: 4000,
            slideSpeed: 4000,
            navigation: false,
            pagination: false,
            singleItem: true,
            transitionStyle: "fade",
            beforeInit: function(elem){
                var base = this;
                var transition = elem.attr("data-transition");
                var speed = elem.attr("data-speed");
                base.options.transitionStyle = transition;
                base.options.slideSpeed = speed;
                base.options.autoPlay = speed;
            }
        });
    }

    $('#button-menu').click(function () {
        $('#nav-menu, #nav-menu ul').toggleClass('nav-menu-ef');
        $(this).toggleClass('active');
    })
    $('#close-menu, .menu-nav li a').click(function () {
        $('#nav-menu, #nav-menu ul').removeClass('nav-menu-ef');
        $('#button-menu').removeClass('active');
    });

    // SLIDER BLOG LIST
    if($("#owl-blog-list").length > 0){
        $("#owl-blog-list").owlCarousel({
            autoPlay: 4000,
            slideSpeed: 1000,
            navigation: true,
            navigationText: ["", ""],
            pagination: false,
            singleItem: true
        });
    }

    if ($(window).height() < $('.menu-nav').height() + 100) {
    $('#nav-menu').css('overflow-y', 'scroll');
    } else {
        $('#nav-menu').css('overflow-y', 'visible');
    }
    $('#scroll-top').click(function () {
        $("html, body").animate({ scrollTop: 0 }, 1000);
    });

    // Sticky
    $("#header").sticky({
        topSpacing: 0,
        className: 'header-sticky',
        wrapperClassName: ''
    });

});