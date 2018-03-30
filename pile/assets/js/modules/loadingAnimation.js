
var loadingAnimation = (function() {
    var timeline,
        initialized = false;

    function init() {
        initialized = true;
    }

    function play() {

        if ( ! initialized ) return;

        TweenMax.to($('.border-logo-fill'), .3, {
            x: 0,
            onComplete: function() {
                $('.border-logo').css('opacity', 0);
            },
            ease: Circ.easeIn
        });

        TweenMax.to($('.border-logo-bgscale'), .3, {
            scaleY: 0,
            delay: .3,
            ease: Quad.easeInOut
        });

        TweenMax.fromTo($('.js-border'), 0.6, {
            borderWidth: windowHeight/2 + ' ' + windowWidth/2
        }, {
            background: 'none',
            borderWidth: 0,
            delay: .5,
            ease: Quart.easeInOut
        });

        TweenMax.fromTo('.hero-content', .4, { opacity: 0, y: 50 }, { opacity: 1, y: 0, ease: Quad.easeOut, delay: .7 });
        TweenMax.fromTo('.hero-slider', .4, { scale: 1.2 }, { scale: 1, ease: Quad.easeOut, delay: .7 });
    }

    return {
        init: init,
        play: play
    }
})();