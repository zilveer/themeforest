jQuery(document).ready(function($){
    $('.images-slider-sc').flexslider({
        animation: yit_images_slider_params.effect,
        slideshowSpeed: yit_images_slider_params.speed,
        direction: yit_images_slider_params.direction,

        directionNav: true,
        controlNav: false,
        pauseOnAction: false,
        keyboardNav: false,

        prevText: "",
        nextText: "",

        selectors: ".slides > li"
    });
});