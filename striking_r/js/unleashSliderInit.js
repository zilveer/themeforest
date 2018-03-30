jQuery(document).ready(function($) {
    function unleashInit() {
        $('.unleash-slider-list').each(function() {

            var opts = $(this).data('options');

            var slide_width = parseInt(opts.slide_width, 10);
            var slide_height = parseInt(opts.slide_height, 10);

            var container_width = $(this).parents('.unleash-slider-wrap').width();

            if (opts.max_width < container_width) {
                container_width = parseInt(opts.max_width, 10);
            } else {
                var ratio = container_width / opts.max_width;
                slide_width = parseInt(slide_width, 10) * ratio;
                slide_height = parseInt(slide_height, 10) * ratio;
            }

            $(this).unleash({
                slide_height: slide_height,
                slide_width: slide_width,
                max_width: container_width,
                full_screen: false,
                rtl: opts.rtl,
                Event: opts.Event,
                duration: parseInt(opts.duration, 10),
                slide_duration: parseInt(opts.slide_duration, 10),
                initially_open_slide: parseInt(opts.initially_open_slide, 10),
                collapse_on_mouseout: opts.collapse_on_mouseout,
                easing: opts.easing,
                container_class: '.unleash-slider-wrap',
                captionClassName: '.unleash-slider-detail',
                caption_animation: opts.caption_animation,
                slideshow: opts.slideshow,
                hide_controls: opts.hide_controls,
                pause_onmouseover: opts.pause_onmouseover,
                caption_animation_easing: opts.caption_animation_easing
            });
        });
		$('.unleash-slider-item').each(function(index,value) {
            $(value).css('display', '');
        });		
		$('.unleash-slider-detail').each(function(index,value) {
            $(value).css('display', '');
        });
    }
    unleashInit();

});
