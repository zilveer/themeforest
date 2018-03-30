/* --- Parallax Init --- */

var Parallax = (function() {

    var detectIE = false;

    var selector = '.js-hero',
        $covers = $(),
        amount = 0,
        initialized = false,
        bleed = 20;


    function initialize() {
        if (globalDebug) {console.group("parallax::initialize");}

        $covers = $();

        $(selector).each(function (i, hero) {

            $('#djaxHero').css('height', '');

            var $hero = $(hero),
                $target, $image, $slider, amount, distance, heroHeight, heroOffset, newHeight;

            amount          = computeAmountValue($hero);
            heroHeight      = $hero.outerHeight();
            heroOffset      = $hero.offset();
            newHeight       = heroHeight + (windowHeight - heroHeight) * amount;
            distance        = (windowHeight + heroHeight) * amount;

            $target         = $hero.children('.hero-slider');

            $covers         = $covers.add($hero);

            if ( Modernizr.touchevents ) {
                $('#djaxHero').height(heroHeight);
            }

            $target.removeAttr('style');

            $target.css('height', newHeight);
            $target.find('.hero').css('height', heroHeight);
            $target.css('top', (heroHeight - newHeight) * 0.5);
            $target.find('.hero').css('top', (heroHeight - newHeight) * -0.5);

            // prepare image / slider timeline
            var parallax = {
                start:      heroOffset.top - windowHeight,
                end:        heroOffset.top + heroHeight,
                distance:   distance,
                target:     $target
            };

            scaleImage($target.find('.hero-bg--image, .hero-bg--video'), amount);

            $hero.data('parallax', parallax);
        });

        initialized = true;
        update();

        if (globalDebug) {console.groupEnd();}
    }

    function update() {
        if ( ! initialized ) return;

        $covers.each(function (i, hero) {
            var $hero = $(hero),
                parallax = $(hero).data('parallax'),
                progress;


            if ( typeof parallax == "undefined" ) return;
            progress = (latestKnownScrollY - parallax.start) / (parallax.end - parallax.start);
            if (0 <= progress && 1 >= progress) {
                var travel = Math.round(parallax.distance * progress - parallax.distance * 0.5) + 'px';
                TweenMax.to($hero.find('.hero-bg--image, .hero-bg--map, .hero-bg--video'), 0, {y: travel});
            }
        });

    }

    function computeAmountValue($hero) {
        var myAmount = 0.5,
            speeds = {
                static: 0,
                slow:   0.25,
                medium: 0.5,
                fast:   0.75,
                fixed:  1
            };

        // let's see if the user wants different speed for different whateva'
        if (typeof parallax_speeds !== "undefined") {
            $.each(speeds, function(speed, value) {
                if (typeof parallax_speeds[speed] !== "undefined") {
                    if ($hero.is(parallax_speeds[speed])) {
                        myAmount = value;

                    }
                }
            });
        }

        return myAmount;
    }

    return {
        initialize: initialize,
        update: update
    }

})();
