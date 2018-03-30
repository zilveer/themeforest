jQuery(function($){
    var slider = jQuery('#main-slider');
    slider.flexslider({
        directionNav: false
    });
    slider.find(".flex-direction-nav a").bind('click', function(e){
        e.preventDefault();
        if(jQuery(this).hasClass('flex-next')){
            slider.flexslider("next");
        }else{
            slider.flexslider("prev");
        }
    })
});