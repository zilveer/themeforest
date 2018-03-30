jQuery(document).ready(function($) {
    function kenResizeThumb($elem) {

        var opts = $elem.data('options');

        if (typeof opts.showthumbmini !== "undefined" && opts.showthumbmini) {
            if ($(window).width() < 980) {
                $elem.addClass('minithumb');
            } else {
                $elem.removeClass('minithumb');
            }
        }
    }
    $('.ken-wrap').each(function() {
        var opts = $(this).data('options');
        $(this).kenburn({
            width: parseInt(opts.width, 10),
            height: parseInt(opts.height, 10),
            responsive: 'on',
            thumbWidth: parseInt(opts.thumbWidth, 10),
            thumbHeight: parseInt(opts.thumbHeight, 10),
            thumbAmount: parseInt(opts.thumbAmount, 10),
            thumbSpaces: 0,
            thumbStyle: opts.naviType,
            bulletXOffset: 0,
            bulletYOffset: 0,

            shadow: 'true',

            timerShow: "off",

            touchenabled: 'on',
            pauseOnRollOverThumbs: 'off',
            pauseOnRollOverMain: opts.pauseOnMain,
            preloadedSlides: 2,
            repairChromeBug: 'on',
            fixHeight: false,
            timer: 10,
            hCorrection: (typeof opts.border === 'undefined') ? 20 : parseInt(opts.border, 10) * 2
        });
        if ($('body').hasClass('responsive')) {
            kenResizeThumb($(this));
        }
    });

    if ($('body').hasClass('responsive')) {
        $(window).resize(function() {
            $('.ken-wrap').each(function() {
                kenResizeThumb($(this));
            });
        });
    }
    $('.kenburn-video-button').on('click', function() {
        $(this).parents('.ken-wrap').addClass('videoload');
    });
    $('.ken-wrap').on('click', '.video_kenburn .close', function() {
        $(this).parents('.ken-wrap').removeClass('videoload');
    });


});
