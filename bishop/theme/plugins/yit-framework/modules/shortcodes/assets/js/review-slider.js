jQuery(function ($) {
    var anim = $.browser.msie || $.browser.opera ? 'fade' : 'slide';
    $('.comment-flexslider').flexslider({
        animation     : anim,
        slideshowSpeed: yit_review_slider_params.slideshowSpeed,
        animationSpeed: yit_review_slider_params.animationSpeed,
        touch         : false,
        controlNav    : false,
        directionNav  : true
    });
});