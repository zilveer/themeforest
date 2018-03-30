(function($) {
    "use strict";

    /*===================================================================================*/
    /*  OWL CAROUSEL
    /*===================================================================================*/
    $(document).ready(function () {


        var is_rtl;

        if( unicase.is_rtl == '1' ) {
            is_rtl = true;
        } else {
            is_rtl = false;
        }

        $('#owl-single-product').owlCarousel({
            items: 1,
            nav: false,
            dots: false,
            rtl:is_rtl,
        });

        var $single_gallery = $('.images .thumbnails');
        if( $single_gallery.hasClass( "slider" ) !== true ) {
            $single_gallery.owlCarousel({
                items: 4,
                dots: false,
                navRewind: true,
                nav: true,
                rtl:is_rtl,
                navText: ["<i class='icon fa fa-angle-left'></i>", "<i class='icon fa fa-angle-right'></i>"],
                margin: 10,
                responsive : {
                    0 : {
                        items : 3,
                    },
                    479 : {
                        items : 3,
                    },
                    768 : {
                        items : 3,
                    },
                    1024 : {
                        items : 4,
                    }
                },
            });
        }


        $('.single-product-slider').owlCarousel({
            autoplayHoverPause: true,
            navRewind: true,
            items: 1,
            dots: false,
            nav: false,
            onTranslate : function(){
                echo.render();
            }
        });

        $( '.dropdown-trigger-cart[data-hover="dropdown"]' ).parent().on( 'mouseenter', function() {
            $( this ).toggleClass( 'open' );
        });

        $( '.dropdown-trigger-cart[data-hover="dropdown"]' ).parent().on( 'mouseleave', function() {
            $( this ).toggleClass( 'open' );
        });


        $(".slider-next").on( 'click', function () {
            var owl = $($(this).data('target'));
            owl.trigger('next.owl.carousel');
            return false;
        });

        $(".slider-prev").on( 'click', function () {
            var owl = $($(this).data('target'));
            owl.trigger('prev.owl.carousel');
            return false;
        });

        $('.thumbnails .horizontal-thumb').on( 'click', function(){
            var $this = $(this), owl = $($this.data('target')), slideTo = $this.data('slide');
            owl.trigger('to.owl.carousel', [slideTo, 300, true]);
            $this.addClass('active').parent().siblings().find('.active').removeClass('active');
            return false;
        });
    });

    /*===================================================================================*/
    /*  ADD TO CART ANIMATION
    /*===================================================================================*/

    $('body').on('added_to_cart', function(){
        $('.product-item').unblock(); // Unblock the product item
        return false;
    });

    $('body').on('adding_to_cart', function( e, $btn, data){
        $btn.parents('.product-item').block({message: null, overlayCSS: {background: '#fff url(' + unicase.ajax_loader_url + ') no-repeat center', backgroundSize: '16px 16px', opacity: 0.6}});
    });

    /*===================================================================================*/
    /*  ECHO RENDER ON TAB SWITCH
    /*===================================================================================*/

    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        if( typeof echo != "undefined" ) { 
            echo.render();
        }
    });

    /*===================================================================================*/
    /*  Quick View
    /*===================================================================================*/

    $( document ).on( 'click', '.product_quick_view', function(e) {
        var product_id = $(this).data('product_id');

        $.blockUI({message: null, overlayCSS: {background: '#fff url(' + unicase.ajax_loader_url + ') no-repeat center', backgroundSize: '16px 16px', opacity: 0.6}});
        
        $.ajax({
            url : unicase.ajax_url,
            type : 'post',
            data : {
                action : 'product_quick_view',
                product_id : product_id
            },
            success : function( response ) {                
                $('#modal-quick-view-ajax-content').html( response );
                $('#quick-view').modal('show');
                $.unblockUI();

                // Variation Form
                var form_variation = $('#quick-view').find( '.variations_form' );

                form_variation.wc_variation_form();
                form_variation.trigger( 'check_variations' );

                // Init prettyPhoto
                if( typeof $.fn.prettyPhoto !== 'undefined' ) {
                    $('#quick-view').find("a[data-rel^='prettyPhoto'], a.zoom").prettyPhoto({
                        hook              : 'data-rel',
                        social_tools      : false,
                        theme             : 'pp_woocommerce',
                        horizontal_padding: 20,
                        opacity           : 0.8,
                        deeplinking       : false
                    });
                }
            }
        });

        return false;
    });

    $( '#quick-view' ).on( 'shown.bs.modal', function() {
        if( typeof echo != "undefined" ) { 
            echo.render();
        }

        if ( typeof wc_add_to_cart_variation_params === 'undefined' )
            return false;
        
        $( '.variations_form' ).wc_variation_form();
        $( '.variations_form .variations select' ).change();
    });

    $('#quick-view').on( 'hide.bs.modal', function (event) {
        $(this).find('#modal-quick-view-ajax-content').empty();
    });

    $( document ).ready( function() {
        
        /*===================================================================================*/
        /*  WOW 
        /*===================================================================================*/

        new WOW().init();

        /*===================================================================================*/
        /*  LAZY LOAD
        /*===================================================================================*/

        if( typeof echo != "undefined" ) {
            echo.init({
                offset: 100,
                throttle: 250,
                unload: false,
                callback: function (element, op) {                  
                    $(element).closest( '.product-cover' ).css('background-image', 'none');
                }
            });
        } else {
            setImageSize();
        }

        /*===================================================================================*/
        /*  STICKY NAVIGATION
        /*===================================================================================*/

        if( unicase.enable_sticky_header == '1' ) {
            var sticky_header = new Waypoint.Sticky({
                element: $('#site-navigation')[0]
            });
        }

        /*===================================================================================*/
        /*  SET IMAGE SIZE
        /*===================================================================================*/

        function setImageSize() {
            $('.product-cover > img').each( function(){
                var height = $(this).height();
                $(this).closest( '.product-image-actions' ).height( height );
            });
        }

        /*===================================================================================*/
        /*  REMEMBER USER SHOP VIEW
        /*===================================================================================*/

        $('.view-switcher > .nav-tabs > li > a').on( 'click', function(){
            var href = $(this).attr('href');
            eraseCookie( 'user_shop_view' );
            if( href == '#grid-view' ) {
                createCookie( 'user_shop_view', 'grid', 300 );
            } else {
                createCookie( 'user_shop_view', 'list', 300 );
            }
        });

        /*===================================================================================*/
        /*  YITH WOOCOMPARE 
        /*===================================================================================*/

        if (typeof yith_woocompare !== 'undefined') {
            $(document).off('click', '.product a.compare.added');
            $('.yith-woocompare-open a, a.yith-woocompare-open').off('click');
            $('.yith-woocompare-widget').off('click');

            // Remove auto open trigger
            if ( yith_woocompare.auto_open == 'yes') {
                yith_woocompare.auto_open = 'no';
            }
        }

        /*===================================================================================*/
        /*  Woocommerce Cart
        /*===================================================================================*/
        
        $('select.styled').customSelect();
        $( '.shipping-calculator-form' ).show();
        $('.shipping-calculator-button').off('click');

        $( 'form.login' ).show();

        /*===================================================================================*/
        /*  Woocommerce Checkout
        /*===================================================================================*/

        $('a.showlogin').closest( '.woocommerce-info' ).addClass('logintoggle');
        $( document.body ).on( 'click', '.woocommerce-info.logintoggle', function() {
            $( 'form.login' ).slideToggle();
            return false;
        } );

        $('a.showcoupon').closest( '.woocommerce-info' ).addClass('coupontoggle');
        $( document.body ).on( 'click', '.woocommerce-info.coupontoggle', function() {
            $( '.checkout_coupon' ).slideToggle( 400, function() {
                $( '.checkout_coupon' ).find( ':input:eq(0)' ).focus();
            });
            return false;
        } );

        /*===================================================================================*/
        /*  PRODUCT CATEGORIES TOGGLE
        /*===================================================================================*/

        $('.cat-parent > a').each(function(){
            var $childIndicator = $('<span class="child-indicator"><i class="fa fa-plus-square-o"></i></span>');
            
            $(this).siblings('.children').hide();
            $('.current-cat > .children').show();
            $('.current-cat-parent > .children').show();
            if($(this).siblings('.children').is(':visible')){
                $childIndicator.addClass( 'open' );
                $childIndicator.html('<i class="fa fa-minus-square-o"></i>');
            }
            
            $childIndicator.on( 'click', function(){
                $(this).parent().siblings('.children').toggle( 'fast', function(){
                    if($(this).is(':visible')){
                        $childIndicator.addClass( 'open' );
                        $childIndicator.html('<i class="fa fa-minus-square-o"></i>');
                    }else{
                        $childIndicator.removeClass( 'open' );
                        $childIndicator.html('<i class="fa fa-plus-square-o"></i>');
                    }
                });
                return false;
            });
            $(this).append($childIndicator);
        });

        /*===================================================================================*/
        /*  SEARCH AREA CUSTOM SELECT
        /*===================================================================================*/

        if( $( '.search-area select' ).length > 0 ) {
            $( '.search-area select' ).customSelect({
                customClass: 'search-area-select'
            });
        }


        /*===================================================================================*/
        /*  Products LIVE Search
        /*===================================================================================*/

        if( unicase.enable_live_search == '1' ) {

            if ( unicase.ajax_url.indexOf( '?' ) > 1 ) {
                var prefetch_url    = unicase.ajax_url + '&action=products_live_search&fn=get_ajax_search';
                var remote_url      = unicase.ajax_url + '&action=products_live_search&fn=get_ajax_search&terms=%QUERY';
            } else {
                var prefetch_url    = unicase.ajax_url + '?action=products_live_search&fn=get_ajax_search';
                var remote_url      = unicase.ajax_url + '?action=products_live_search&fn=get_ajax_search&terms=%QUERY';
            }

            var searchProducts = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                prefetch: prefetch_url,
                remote: {
                    url: remote_url,
                    wildcard: '%QUERY',
                },
                identify: function(obj) {
                    return obj.id;
                }
            });

            searchProducts.initialize();

            $( '.product-search-area .search-field' ).typeahead(
                {
                    hint: true,
                    highlight: true
                },
                {
                    name: 'search',
                    source: searchProducts.ttAdapter(),
                    displayKey: 'value',
                    templates: {
                        empty : [
                            '<div class="empty-message">',
                            unicase.live_search_empty_msg,
                            '</div>'
                        ].join('\n'),
                        suggestion: Handlebars.compile( unicase.live_search_template )
                    }
                }
            );
        }

    });

    /*===================================================================================*/
    /*  Visual Composer Row Behavior
    /*===================================================================================*/

    window.vc_rowBehaviour = function () {
        var $ = window.jQuery;
        var local_function = function () {
            var $elements = $( '[data-vc-full-width="true"]' );
            var is_rtl = $('body,html').hasClass('rtl');
            $.each( $elements, function ( key, item ) {
                var $el = $( this );
                var $el_full = $el.next( '.vc_row-full-width' );
                var $el_wrapper = $( '#page.wrapper' );
                var el_margin_left = parseInt( $el.css( 'margin-left' ), 10 );
                var el_margin_right = parseInt( $el.css( 'margin-right' ), 10 );
                var offset = 0 - $el_full.offset().left - el_margin_left + $el_wrapper.offset().left;
                var width = $el_wrapper.width();
                if( is_rtl ){
                    $el.css( {
                        'position': 'relative',
                        'right': offset,
                        'box-sizing': 'border-box',
                        'width': $el_wrapper.width()
                    } );
                } else {
                    $el.css( {
                        'position': 'relative',
                        'left': offset,
                        'box-sizing': 'border-box',
                        'width': $el_wrapper.width()
                    } );
                }
                
                if ( ! $el.data( 'vcStretchContent' ) ) {
                    var padding = (- 1 * offset);
                    if ( padding < 0 ) {
                        padding = 0;
                    }
                    var paddingRight = width - padding - $el_full.width() + el_margin_left + el_margin_right;
                    if ( paddingRight < 0 ) {
                        paddingRight = 0;
                    }
                    $el.css( { 'padding-left': padding + 'px', 'padding-right': paddingRight + 'px' } );
                }
                $el.attr( "data-vc-full-width-init", "true" );
            } );
        };
        /**
         * @todo refactor as plugin.
         * @returns {*}
         */
        var parallaxRow = function () {
            var vcSkrollrOptions,
                callSkrollInit = false;
            if ( vcParallaxSkroll ) {
                vcParallaxSkroll.destroy();
            }
            $( '.vc_parallax-inner' ).remove();
            $( '[data-5p-top-bottom]' ).removeAttr( 'data-5p-top-bottom data-30p-top-bottom' );
            $( '[data-vc-parallax]' ).each( function () {
                var skrollrSpeed,
                    skrollrSize,
                    skrollrStart,
                    skrollrEnd,
                    $parallaxElement,
                    parallaxImage;
                callSkrollInit = true; // Enable skrollinit;
                if ( $( this ).data( 'vcParallaxOFade' ) == 'on' ) {
                    $( this ).children().attr( 'data-5p-top-bottom', 'opacity:0;' ).attr( 'data-30p-top-bottom',
                        'opacity:1;' );
                }

                skrollrSize = $( this ).data( 'vcParallax' ) * 100;
                $parallaxElement = $( '<div />' ).addClass( 'vc_parallax-inner' ).appendTo( $( this ) );
                $parallaxElement.height( skrollrSize + '%' );

                parallaxImage = $( this ).data( 'vcParallaxImage' );

                if ( parallaxImage !== undefined ) {
                    $parallaxElement.css( 'background-image', 'url(' + parallaxImage + ')' );
                }

                skrollrSpeed = skrollrSize - 100;
                skrollrStart = - skrollrSpeed;
                skrollrEnd = 0;

                $parallaxElement.attr( 'data-bottom-top', 'top: ' + skrollrStart + '%;' ).attr( 'data-top-bottom',
                    'top: ' + skrollrEnd + '%;' );
            } );

            if ( callSkrollInit && window.skrollr ) {
                vcSkrollrOptions = {
                    forceHeight: false,
                    smoothScrolling: false,
                    mobileCheck: function () {
                        return false;
                    }
                };
                vcParallaxSkroll = skrollr.init( vcSkrollrOptions );
                return vcParallaxSkroll;
            }
            return false;
        };
        $( window ).unbind( 'resize.vcRowBehaviour' ).bind( 'resize.vcRowBehaviour', local_function );
        local_function();
        parallaxRow();
    }

    /*===================================================================================*/
    /*  COOKIE FUNCTIONS
    /*===================================================================================*/

    function createCookie(name, value, days) {
        var expires;

        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toGMTString();
        } else {
            expires = "";
        }
        document.cookie = escape(name) + "=" + escape(value) + expires + "; path=/";
    }

    function readCookie(name) {
        var nameEQ = escape(name) + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) === ' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) === 0) return unescape(c.substring(nameEQ.length, c.length));
        }
        return null;
    }

    function eraseCookie(name) {
        createCookie(name, "", -1);
    }

})(jQuery);
