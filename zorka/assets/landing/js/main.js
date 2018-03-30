(function($) {
    "use strict";
    var Landing = {
        initialized : false,
        initialize : function() {
            if (this.initialized) return;
            this.initialized = true;

            this.build();
            this.events();
        },
        build : function() {
            Landing.isotope_init();
            Landing.stellar();
            Landing.scrollReveal();
        },
        events : function() {
            Landing.tab_click();
        },
        tab_click : function() {
            $('a','.tab-home-page').click(function(even) {
                even.preventDefault();
                if ($(this).hasClass('active')) return;
                $('a','.tab-home-page').removeClass('active');
                $(this).addClass('active');


                var filter = $(this).data('filter');
                console.log(filter);

                var $container = $('.list-home-page  .row').isotope({ filter: filter});
                $container.imagesLoaded( function() {
                    $container.isotope('layout');
                });
            })
        },
        isotope_init : function() {
            var $container = $('.list-home-page .row');
            $container.imagesLoaded( function() {
                $container.isotope();
            });
        },
        stellar : function() {
            $.stellar({
                horizontalScrolling: false,
                scrollProperty: 'scroll',
                positionProperty: 'position'
            });
        },
        scrollReveal : function() {
            window.sr = new scrollReveal({
                reset: false,
                move: '50px',
                over: '1s',
                easing: 'hustle',
                scale: {direction: 'up', power: '5%'},
                mobile: true
            });
        }
    }
    $(document).ready(function(){
        Landing.initialize();
    });
})(jQuery);