// commercegurus js source. 

;
( function( $ ) {
    "use strict";


    // Wishlist icon
    $( ".yith-wcwl-wishlistexistsbrowse" ).prepend(
            '<div class=\"icon cg-icon-heart-2-1\"></div>' );
    $( ".yith-wcwl-add-button" ).prepend(
            '<div class=\"icon cg-icon-heart-2-1\"></div>' );
    $( ".yith-wcwl-wishlistaddedbrowse" ).prepend(
            '<div class=\"icon cg-icon-heart-2-1\"></div>' );


    // Block Name: Sticky Header
    $( window ).scroll( function() {
        var capstickyHeader = $( '.cg-header-fixed-wrapper' );
        var scrollTop = $( this ).scrollTop();
        var capstickyHeaderHeight = $( '.header' ).height() + 200;

        if ( scrollTop > capstickyHeaderHeight ) {
            if ( ! capstickyHeader.hasClass( 'cg-is-fixed' ) ) {
                capstickyHeader.stop().addClass( 'cg-is-fixed' );
            }
        } else {
            if ( capstickyHeader.hasClass( 'cg-is-fixed' ) ) {
                capstickyHeader.stop().removeClass( 'cg-is-fixed' );
            }
        }
    } );


    // Block Name: Main Menu
    $.fn.cg_primary_menu = function( options ) {
        var methods = {
            capshowmenuChildren: function( el ) {
                el.fadeIn( 100 ).css( {
                    display: 'list-item',
                    listStyle: 'none'
                } ).find( 'li' ).css( { listStyle: 'none' } );
            },
            capcalcColumns: function( el ) {
                var columnsCount = el.find(
                        '.container > ul > li.menu-item-has-children' ).length;
                var dropdownWidth = el.find( '.container > ul > li' ).
                        outerWidth();
                var padding = 20;
                if ( columnsCount > 1 ) {
                    dropdownWidth = dropdownWidth * columnsCount + padding;
                    el.css( {
                        'width': dropdownWidth
                    } );
                }

                var capmenuheaderWidth = $( '.cg-wp-menu-wrapper' ).
                        outerWidth();
                var headerLeft = $( '.cg-wp-menu-wrapper' ).offset().left;
                var dropdownOffset = el.offset().left - headerLeft;
                var dropdownRight = capmenuheaderWidth - ( dropdownOffset + dropdownWidth );

                if ( dropdownRight < 0 ) {
                    el.css( {
                        'left': 'auto',
                        'right': 0
                    } );
                }
            },
            openOnClick: function( el, e ) {
                var timeOutTime = 0;
                var openedClass = "current";
                var header = $( '.header-wrapper' );
                var $this = el;

                if ( $this.parent().hasClass( openedClass ) ) {
                    e.preventDefault();
                    $this.parent().removeClass( openedClass );
                    $this.next().stop().slideUp( settings.animTime );
                    header.stop().animate( { 'paddingBottom': 0 },
                    settings.animTime );
                } else {

                    if ( $this.parent().find( '>div' ).length < 1 ) {
                        return;
                    }

                    e.preventDefault();

                    if ( $this.parent().parent().find(
                            '.' + openedClass ).length > 0 ) {
                        timeOutTime = settings.animTime;
                        header.stop().animate( { 'paddingBottom': 0 },
                        settings.animTime );
                    }

                    $this.parent().parent().find( '.' + openedClass ).
                            removeClass( openedClass ).find( '>div' ).stop().
                            slideUp( settings.animTime );

                    setTimeout( function() {
                        $this.parent().addClass( openedClass );
                        header.stop().animate( { 'paddingBottom': $this.next().
                                    height() + 50 }, settings.animTime );
                        $this.next().stop().slideDown( settings.animTime );
                    }, timeOutTime );
                }
            }
        };

        var settings = $.extend( {
            type: "default",
            animTime: 250,
            openByClick: true
        }, options );

        this.find( '>li' ).hover( function() {
            if ( ! $( this ).hasClass(
                    'open-by-click' ) || ( ! settings.openByClick && $( this ).
                    hasClass( 'open-by-click' ) ) ) {
                if ( settings.openByClick ) {
                    $( '.open-by-click.current' ).find( '>a' ).click();
                    $( this ).find( '>a' ).unbind( 'click' );
                }
                var dropdown = $( this ).find( '> .cg-submenu-ddown' );
                methods.capshowmenuChildren( dropdown );

                if ( settings.type == 'columns' ) {
                    methods.capcalcColumns( dropdown );
                }
            } else {
                $( this ).find( '>a' ).unbind( 'click' );
                $( this ).find( '>a' ).bind( 'click', function( e ) {
                    methods.openOnClick( $( this ), e );
                } );
            }
        }, function() {
            if ( ! $( this ).hasClass(
                    'open-by-click' ) || ( ! settings.openByClick && $( this ).
                    hasClass( 'open-by-click' ) ) ) {
                $( this ).find( '> .cg-submenu-ddown' ).fadeOut( 100 ).
                        attr( 'style', '' );
            }
        } );

        return this;
    };

    $( '.cg-primary-menu .menu' ).cg_primary_menu( {
        type: "default"
    } );

    $( '.cg-header-fixed .menu' ).cg_primary_menu( {
        openByClick: false
    } );

    $( window ).load( function() {
        $( ".product-cat-meta" ).addClass( "show animate" );
    } );


    // Block Name: Flexslider - Showcase
    $( '#showcaseimg .flexslider' ).flexslider( {
        controlNav: false,
        animation: "fade",
        slideshow: true,
        touch: true,
        slideshowSpeed: 4500,
        animationSpeed: 1600,
        pauseOnAction: true,
        pauseOnHover: false,
        start: function( slider ) {
            $( slider ).delay( 200 ).fadeTo( 600, 1 );
            $( '.scase' ).removeClass( 'preloading' );
        }
    } );


    // Block Name: Mean menu
    $( '#mobile-menu' ).meanmenu( {
        meanMenuContainer: '#load-mobile-menu',
        meanScreenWidth: "1100",
        meanMenuClose: "<span></span><span></span><span></span>"
    } );


    // Skrollr
    $( function() {
        if ( ! ( /Android|iPhone|iPad|iPod|BlackBerry|Windows Phone/i ).test(
                navigator.userAgent || navigator.vendor || window.opera ) )
        {
            var skr = skrollr.init( { forceHeight: false } );
            skr.refresh( $( '.cg_parallax' ) );
        }
    } );


    // Hide video on mobile/tablets
    if ( navigator.userAgent.match(
            /(Android|iPod|iPhone|iPad|IEMobile|Opera Mini)/ ) ) {
        $( '.cg-video' ).remove();
    }


    // Block Name: CSS3 Animations
    if ( ! ( /iPhone|iPad|iPod|Android|webOS|BlackBerry|Opera Mini|IEMobile/i.test(
            navigator.userAgent ) ) ) {
        $( ".animate" ).waypoint( function( direction ) {
            var animation = jQuery( this ).attr( "data-animate" );
            if ( direction == 'down' ) {
                jQuery( this ).addClass( animation );
                jQuery( this ).addClass( 'animated' );
            }
            else {
                jQuery( this ).removeClass( animation );
                jQuery( this ).removeClass( 'animated' );
            }
        }, { offset: '100%' } );
    }


    // Block Name: Product List/Grid Toggle 
    function productToggle() {
        var activeClass = 'toggle-active';
        var gridClass = 'grid-layout';
        var listClass = 'list-layout';
        $( '.toggleList' ).click( function() {
            if ( ! $.cookie( 'product_layout' ) || $.cookie(
                    'product_layout' ) == 'grid' ) {
                toggleList();
            }
        } );
        $( '.toggleGrid' ).click( function() {
            if ( ! $.cookie( 'product_layout' ) || $.cookie(
                    'product_layout' ) == 'list' ) {
                toggleGrid();
            }
        } );

        function toggleList() {
            $( '.toggleList' ).addClass( activeClass );
            $( '.toggleGrid' ).removeClass( activeClass );
            $( '.products' ).fadeOut( 300, function() {
                $( this ).removeClass( gridClass ).addClass( listClass ).
                        fadeIn( 300 );
                $.cookie( 'product_layout', 'list',
                        { expires: 3, path: '/' } );
            } );
        }

        function toggleGrid() {
            $( '.toggleGrid' ).addClass( activeClass );
            $( '.toggleList' ).removeClass( activeClass );
            $( '.products' ).fadeOut( 300, function() {
                $( this ).removeClass( listClass ).addClass( gridClass ).
                        fadeIn( 300 );
                $.cookie( 'product_layout', 'grid',
                        { expires: 3, path: '/' } );
            } );
        }
    }

    function setToggleOnLoad() {
        var activeClass = 'toggle-active';
        if ( $.cookie( 'product_layout' ) == 'grid' ) {
            $( '.products' ).removeClass( 'list-layout' ).addClass(
                    'grid-layout' );
            $( '.toggleGrid' ).addClass( activeClass );
        } else if ( $.cookie( 'product_layout' ) == 'list' ) {
            $( '.products' ).removeClass( 'grid-layout' ).addClass(
                    'list-layout' );
            $( '.toggleList' ).addClass( activeClass );
        } else {
            $( '.toggleGrid' ).addClass( activeClass );
        }
    }

    productToggle();
    setToggleOnLoad();


    // Block Name: Vertical center texts in banners
    $.fn.vAlign = function() {
        return this.each( function() {
            var d = $( this ).outerHeight();
            $( this ).css( 'margin-bottom', - d / 2 );
        } );
    };
    $( '.cg-strip .valign-center' ).vAlign();


    // Block Name: qTip for upsells
    $( '.product-tooltip' ).each( function() {
        $( this ).qtip( {
            content: {
                text: $( this ).next( '.tooltiptext' )
            },
            position: {
                my: 'bottom center',
                at: 'top center',
                container: $( 'div.product-tooltip' ),
                adjust: {
                    x: 39,
                    //y: 10 
                }
            },
            style: {
                classes: 'qtip-blue'
            }
        } );
    } );

    // Block Name: Popup for size guide
    $( '.cg-size-guide' ).magnificPopup( {
        delegate: 'a',
        type: 'image',
        tLoading: 'Loading....',
        mainClass: 'magnific-open',
        removalDelay: 200,
        closeOnContentClick: true,
        gallery: {
            enabled: false,
            navigateByImgClick: false,
            preload: [0, 1
            ]
        },
        image: {
            verticalFit: false,
            tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
        }
    } );


    // Block Name: jRespond breakpoints
    var jRes = jRespond( [{
            label: 'small',
            enter: 0,
            exit: 768
        }, {
            label: 'medium',
            enter: 768,
            exit: 980
        }, {
            label: 'large',
            enter: 980,
            exit: 10000
        }] );


    // Block Name: Accordion
    $( '.accordionButton' ).click( function() {
        $( '.accordionButton' ).removeClass( 'on' );
        $( '.accordionContent' ).slideUp( 'normal' );
        if ( $( this ).next().is( ':hidden' ) === true ) {
            $( this ).addClass( 'on' );
            $( this ).next().slideDown( 'normal' );
        }
    } );
    $( '.accordionContent' ).hide();


    // Block Name: Set banner position
    function scrollBanner() {
        $( document ).scroll( function() {
            var scrollPos = $( this ).scrollTop();
            $( '.banner-text' ).css( {
                'top': ( scrollPos / 3 ) + 'px',
                'opacity': 1 - ( scrollPos / 510 )
            } );
            $( '.category-wrapper' ).css( {
                'background-position': 'center ' + ( - scrollPos / 2 ) + 'px'
            } );
        } );
    }
    scrollBanner();


    // Block Name: Default bootstrap select 
    $( '.selectpicker' ).selectpicker();


    // Block Name: Flip effect
    $( document ).ready( function() {
        $( '.hover' ).hover( function() {
            $( this ).addClass( 'flip' );
        }, function() {
            $( this ).removeClass( 'flip' );
        } );
    } );


    // Block Name: Shipping block bg position
    $( window ).scroll( function() {
        var top = $( this ).scrollTop();
        if ( top > 550 ) {
            $( '.shipping-block' ).css( "background-position", parseInt( $(
                    this ).scrollTop() - 2000 * 0.20 ) );
        }
    } );


    // Block Name: Back to top
    $( document ).ready( function() {
        // browser window scroll (in pixels) after which the "back to top" link is shown
        var offset = 300,
                //browser window scroll (in pixels) after which the "back to top" link opacity is reduced
                offset_opacity = 1200,
                //duration of the top scrolling animation (in ms)
                scroll_top_duration = 700,
                //grab the "back to top" link
                $back_to_top = $( '.cd-top' );

        //hide or show the "back to top" link
        $( window ).scroll( function() {
            ( $( this ).scrollTop() > offset ) ? $back_to_top.addClass(
                    'cd-is-visible' ) : $back_to_top.removeClass(
                    'cd-is-visible cd-fade-out' );
            if ( $( this ).scrollTop() > offset_opacity ) {
                $back_to_top.addClass( 'cd-fade-out' );
            }
        } );

        //smooth scroll to top
        $back_to_top.on( 'click', function( event ) {
            event.preventDefault();
            $( 'body,html' ).animate( {
                scrollTop: 0,
            }, scroll_top_duration
                    );
        } );

    } );


    // Block name: Ticker
    $( document ).ready( function() {
        $( '.cg-show-announcements' ).css( "display", "block" );
        $( '.cg-show-announcements' ).inewsticker( {
            speed: 4000,
            effect: 'fade',
            delay_after: 2000
        } );
    } );

    // Equal height - product image and product thumbnail containers
    $( window ).load( function() {
        var cgEqualHeight = $('.product-nocols .cg-product-gallery-img'); /* cache the selector */
        $('.product-nocols .cg-prod-gallery-thumbs').css({ height: cgEqualHeight.height() });
    });


    // Close anon function.
}( jQuery ) );
