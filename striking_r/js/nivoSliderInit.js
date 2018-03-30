jQuery(document).ready(function($) {
    $('.nivoSlider').each(function() {
        var $slider = $(this);
        var opts = $slider.data('options');
        $slider.removeClass('nivoSlider-no-js').addClass('nivoSlider-js');
        $slider.nivoSlider({
            effect: opts.effects,
            slices: parseInt(opts.slices, 10),
            boxCols: parseInt(opts.boxCols, 10),
            boxRows: parseInt(opts.boxRows, 10),
            animSpeed: parseInt(opts.animSpeed, 10),
            pauseTime: parseInt(opts.pauseTime, 10),
            manualAdvance: !opts.autoplay,
            pauseOnHover: opts.pauseOnHover,
            randomStart: opts.randomStart,
            controlNav: opts.controlNav,
            directionNav: opts.directionNav,
            controlNavThumbs: false,
            afterLoad: function() { /*setNivoLayout();*/ },
            lastSlide: function() {
                if (opts.stopAtEnd) {
                    $slider.data('nivoslider').stop();
                }
            }
        });
    });
    $('.nivo-container').each(function(index,value) {
        $(value).css('display', '');
    });	
    // if ($('body').is('.responsive')) {
    //     function resizeShortcodeWrap() {
    //         $slider = $('.slide-shortcode-wrap');
    //         var parentWidth = $slider.parent().width();
    //         var width = $slider.width();
    //         $slider.find('.nivo-container').css('width', '100%');
    //         if (width > parentWidth) {
    //             $slider.css('width', '100%');
    //         } else {
    //             $slider.css('width', width);
    //         }
    //     }
    //     enquire.register("screen and (min-width: 980px)", {
    //         match: function() {
    //             resizeShortcodeWrap();
    //         }
    //     }).register("screen and (min-width: 768px) and (max-width: 979px)", {
    //         match: function() {
    //             resizeShortcodeWrap();
    //         }
    //     }).register("screen and (min-width: 568px) and (max-width: 767px)", {
    //         match: function() {
    //             resizeShortcodeWrap();
    //         }
    //     }).register("screen and (min-width: 480px) and (max-width: 567px)", {
    //         match: function() {
    //             resizeShortcodeWrap();
    //         }
    //     }).register("screen and (max-width: 479px)", {
    //         match: function() {
    //             resizeShortcodeWrap();
    //         }
    //     });
    // }
});
