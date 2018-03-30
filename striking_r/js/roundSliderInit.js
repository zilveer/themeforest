jQuery(document).ready(function($) {
    function getRoundRatio() {
        var winW = window.innerWidth;
        var ratio = 1;
        if (winW <= 1024 && winW > 768) {
            ratio = 0.85;
        } else if (winW <= 768 && winW > 567) {
            ratio = 0.64;
        } else if (winW <= 567 && winW > 480) {
            ratio = 0.55;
        } else if (winW <= 480 && winW > 320) {
            ratio = 0.4;
        } else if (winW <= 320) {
            ratio = 0.27;
        }
        return ratio;
    }
    var $feature = $('#feature .inner');

    function setRoundLayout($slider, ratio) {

        var sliderW = $slider.width() * ratio;
        var sliderH = $slider.height() * ratio;
        var width = $feature.width();

        if (sliderW > width) {
            $slider.css('margin-left', -((sliderW - width) / 2));
        } else {
            $slider.css('margin-left', (width - sliderW) / 2);
        }

        var $sliderItem = $slider.find('.roundabout-item');

        $slider.width(sliderW);
        $slider.height(sliderH);

        $sliderItem.each(function() {
            var $item = $(this);
            var roundabout = $item.data('roundabout');
            var itemW = 0;
            var itemH = 0;
            if (roundabout === undefined) {
                itemW = $item.width() * ratio;
                itemH = $item.height() * ratio;
            } else {
                itemW = roundabout.startWidth * ratio;
                itemH = roundabout.startHeight * ratio;
            }
            $item.width(itemW);
            $item.height(itemH);
        });

    }
    $('.roundabout-caption.is-center').wrap('<div class="roundabout-caption-wrap"><div class="roundabout-caption-helper"/></div>');

    $('.roundabout-list').each(function() {
        var $slider = $(this);
        var opts = $slider.data('options');

        var pagerCallback = function() {
            if (opts.navi) {
                var $pagers = $slider.siblings('.roundabout-navi').find('.roundabout-page');
                $pagers.removeClass('active');
                var index = $(this).data('roundabout').childInFocus;
                $pagers.eq(index).addClass('active');
            }
        };
        var params = {
            btnNext: '.roundabout-next',
            btnPrev: '.roundabout-prev',
            shape: opts.shape,
            tilt: opts.tilt,
            easing: opts.easing,
            reflect: opts.reflect,
            minz: opts.minz,
            max: opts.maxz,
            minOpacity: parseFloat(opts.minOpacity),
            maxOpacity: parseFloat(opts.maxOpacity),
            minScale: parseFloat(opts.minScale),
            maxScale: parseFloat(opts.maxScale),
            autoplay: opts.autoplay,
            autoplayInitialDelay: parseInt(opts.autoplayInitialDelay, 10),
            /*autoplayDuration : parseInt(opts.autoplayDuration,10),*/
            autoplayDuration: parseInt(opts.autoplayDuration, 10),
            autoplayPauseOnHover: opts.autoplayPauseOnHover,
            clickToFocusCallback: pagerCallback,
            btnNextCallback: pagerCallback,
            btnPrevCallback: pagerCallback,
            btnStartAutoplay: '.roundabout-start',
            btnStopAutoplay: '.roundabout-stop',
            responsive: false
        };
        $slider.data('params', params);

        var ratio = getRoundRatio();
        $slider.data('ratio', ratio);

        setRoundLayout($slider, ratio);

        $slider.roundabout(params);

        $slider.on('autoplayStart', function() {
            $(this).siblings('.roundabout-navi').addClass('is-autoplay');
        });
        $slider.on('autoplayStop', function() {
            $(this).siblings('.roundabout-navi').removeClass('is-autoplay');
        });

        if (opts.navi) {
            var $pagers = $slider.siblings('.roundabout-navi').find('.roundabout-page');
            $pagers.each(function(i) {
                $(this).bind('click', function() {
                    $slider.roundabout('animateToChild', i, pagerCallback);
                });
            });

            $slider.bind('animationEnd', pagerCallback);
        }
        $('.roundabout-list li').each(function(index,value) {
            $(value).css('display', '');
        });
				

    });
    if ($('body').hasClass('responsive')) {
        $(window).resize(function() {
            $('.roundabout-list').each(function() {

                var $slider = $(this);
                var defaultRatio = $slider.data('ratio');
                var ratio = getRoundRatio();

                if (defaultRatio !== ratio) {
                    $slider.data('ratio', ratio);
                    setRoundLayout($slider, ratio / defaultRatio);
                    var params = $slider.data('params');
                    var data = $slider.data('roundabout');
                    $slider.unbind(".roundabout").children('li').unbind(".roundabout");
                    clearInterval(data.autoplayInterval);
                    if (data.autoplayIsRunning) {
                        $slider.roundabout('init', params, function() {
                            $slider.roundabout('startAutoplay');
                        }, false);
                    } else {
                        $slider.roundabout('init', params, null, false);
                    }

                }
            });
        });
    }
});
