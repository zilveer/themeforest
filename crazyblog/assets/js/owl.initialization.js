jQuery(document).ready(function ($) {
    $('.carousel').owlCarousel({
        autoplay: true,
        autoplayTimeout: 2500,
        smartSpeed: 2000,
        autoplayHoverPause: true,
        loop: true ,
        dots: true,
        nav: false,
        margin: 0,
        mouseDrag: true,
        singleItem: true,
        items: 1,
        autoHeight: true
    });
});