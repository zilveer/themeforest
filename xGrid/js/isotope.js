/*
 * debouncedresize: special jQuery event that happens once after a window resize
 *
 * latest version and complete README available on Github:
 * https://github.com/louisremi/jquery-smartresize
 *
 * Copyright 2012 @louis_remi
 * Licensed under the MIT license.
 *
 * This saved you an hour of work?
 * Send me music http://www.amazon.co.uk/wishlist/HNTU0468LQON
 */
(function($) {

    var $event = $.event,
        $special,
        resizeTimeout;

    $special = $event.special.debouncedresize = {
        setup: function() {
            $( this ).on( "resize", $special.handler );
        },
        teardown: function() {
            $( this ).off( "resize", $special.handler );
        },
        handler: function( event, execAsap ) {
            // Save the context
            var context = this,
                args = arguments,
                dispatch = function() {
                    // set correct event type
                    event.type = "debouncedresize";
                    $event.dispatch.apply( context, args );
                };

            if ( resizeTimeout ) {
                clearTimeout( resizeTimeout );
            }

            execAsap ?
                dispatch() :
                resizeTimeout = setTimeout( dispatch, $special.threshold );
        },
        threshold: 150
    };

})(jQuery);


(function ($) {

    //#container-grid
    //.isotope-item
    var $container      = jQuery( '#container-grid' ),
        filters = {},
        items_count     = jQuery( ".isotope-item" ).size();

    isotopego = function () {

        setColumnWidth();

        $container.isotope({

            itemSelector        : '.isotope-item',
            hiddenClass         : 'isotope-hidden',
            resizable           : true,
            transformsEnabled   : false,
            layoutMode          : 'masonry',
            masonry             :
            {
                columnWidth     : columnWidth(),
                gutterWidth     : 30
            }
        });
    }


    function getNumColumns(){

        var $bdWarp = jQuery('#container-grid').data('cols');

        if( $bdWarp == '1col') {
            var winWidth                = jQuery("#container-grid").width();
            var column                  = 1;
            return column;
        }

        if( $bdWarp == '2cols') {
            var winWidth                = jQuery("#container-grid").width();
            var column                  = 2;
            if ( winWidth<380 ) column  = 1;
            return column;
        }

        else if ( $bdWarp == '3cols' ) {
            var winWidth                = jQuery("#container-grid").width();
            var column                  = 3;
            if ( winWidth<380 ) column  = 1;
            else if( winWidth>=380 && winWidth<788 )  column = 2;
            else if( winWidth>=788 && winWidth<1160 )  column = 3;
            else if( winWidth>=1160 ) column = 3;
            return column;
        }

        else if ($bdWarp == '4cols') {
            var winWidth                = jQuery("#container-grid").width();
            var column                  = 4;
            if ( winWidth<380) column   = 1;
            else if( winWidth>=380 && winWidth<788 )  column = 2;
            else if( winWidth>=788 && winWidth<1160 )  column = 3;
            else if( winWidth>=1160 ) column = 4;
            return column;
        }

    }

    function setColumnWidth(){

        var columns         = getNumColumns();
        var containerWidth  = jQuery("#container-grid").width();
        var postWidth       = containerWidth/columns;

        postWidth = Math.floor(postWidth)-30;

        jQuery(".isotope-item").each(function(index){
            jQuery(this).css({"width":postWidth+"px"});
        });
    }

    function columnWidth() {

        var columns             = getNumColumns();
        var containerWidth      = jQuery("#container-grid").width();
        var postWidth           = containerWidth/columns;

        postWidth = Math.floor(postWidth);
        return postWidth;
    }

    function arrange(){

        isotopego();
        setColumnWidth();
        //$container.isotope('reLayout');
    }

    jQuery(window).on("debouncedresize", function( event ) {
        arrange();
        jQuery(window).resize();
    });
    isotopego();

    jQuery(window).load(function () {

        //$container.isotope('reLayout');
        var delay = 0;

        jQuery('.isotope-item').each(function () {
            jQuery(this).find('.posts-loading').delay(delay).animate({
                width: 0 + '%'
            }, {
                duration: 0,
                specialEasing: {
                    width: "linear",
                    height: "easeOutBounce"
                }
            });
            delay += 400;
        });
        jQuery(window).resize();
    });

    // Filter projects
    jQuery('.filter a').click(function(){

        var $this = jQuery(this).parent('span');
        // don't proceed if already active
        if ( $this.hasClass('active') ) {
            return;
        }

        var $optionSet = $this.parents('.filter');
        // change active class
        $optionSet.find('.active').removeClass('active');
        $this.addClass('active');

        var selector = jQuery(this).attr('data-filter');
        $container.isotope({ filter: selector });

        var hiddenItems = 0,
            showenItems = 0;

        jQuery(".isotope-item").each(function(){
            if ( jQuery(this).hasClass('isotope-hidden') ) {
                hiddenItems++;
            };
        });
        return false;
    });

}(jQuery));