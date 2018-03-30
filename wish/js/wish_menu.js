( function( $ ) {
    "use strict";


    // Sticky Header
    $( window ).scroll( function() {
        var wishHeader = $( '.wish-header-fixed-wrapper' );
        var scrollTop = $( this ).scrollTop();
        var wishHeaderHeight = $( '.header' ).height() + 100;

        if ( scrollTop > wishHeaderHeight ) {
            if ( !wishHeader.hasClass( 'wish-is-fixed' ) ) {
                wishHeader.stop().addClass( 'wish-is-fixed' );
            }
        } else {
            if ( wishHeader.hasClass( 'wish-is-fixed' ) ) {
                wishHeader.stop().removeClass( 'wish-is-fixed' );
            }
        }
    } );


    // Main Menu -> Wish
    $.fn.wish_primary_menu = function( options ) {
        var methods = {
            wishshowmenuChildren: function( el ) {
                el.fadeIn( 100 ).css( {
                    display: 'list-item',
                    listStyle: 'none'
                } ).find( 'li' ).css( { listStyle: 'none' } );
            },
            wishcalcColumns: function( el ) {
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

                var wishmenuheaderWidth = $( '.wish-wp-menu-wrapper' ).outerWidth();
                var headerLeft = $( '.wish-wp-menu-wrapper' ).offset().left;
                var dropdownOffset = el.offset().left - headerLeft;
                var dropdownRight = wishmenuheaderWidth - ( dropdownOffset + dropdownWidth );

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
            if ( !$( this ).hasClass(
                    'open-by-click' ) || ( !settings.openByClick && $( this ).
                    hasClass( 'open-by-click' ) ) ) {
                if ( settings.openByClick ) {
                    $( '.open-by-click.current' ).find( '>a' ).click();
                    $( this ).find( '>a' ).unbind( 'click' );
                }
                var dropdown = $( this ).find( '> .wish-submenu-ddown' );
                methods.wishshowmenuChildren( dropdown );

                if ( settings.type == 'columns' ) {
                    methods.wishcalcColumns( dropdown );
                }
            } else {
                $( this ).find( '>a' ).unbind( 'click' );
                $( this ).find( '>a' ).bind( 'click', function( e ) {
                    methods.openOnClick( $( this ), e );
                } );
            }
        }, function() {
            if ( !$( this ).hasClass(
                    'open-by-click' ) || ( !settings.openByClick && $( this ).
                    hasClass( 'open-by-click' ) ) ) {
                $( this ).find( '> .wish-submenu-ddown' ).fadeOut( 100 ).
                        attr( 'style', '' );
            }
        } );

        return this;
    };

    $( '.wish-primary-menu .menu' ).wish_primary_menu( {
        type: "default"
    } );

    $( '.wish-header-fixed .menu' ).wish_primary_menu( {
        openByClick: false
    } );


    //  Mean menu
    // var large_menu = jQuery("li.wish-menu-depth-0").length / 2;
    // var menu_screen_size = "1100";
    // if(large_menu > 6){
    //     menu_screen_size = "2000";
    //     $(".wish-rkt-main-menu").hide();
    // }


    $( '#mobile-menu' ).meanmenu( {
        meanMenuContainer: '#load-mobile-menu',
        meanScreenWidth: "1100",
        meanMenuClose: "<span></span><span></span><span></span>"
    } );


   

    // Vertical center texts in banners
    $.fn.vAlign = function() {
        return this.each( function() {
            var d = $( this ).outerHeight();
            $( this ).css( 'margin-bottom', -d / 2 );
        } );
    };
    $( '.wish-strip .valign-center' ).vAlign();


    // Close anon function.
}( jQuery ) );
