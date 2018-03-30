(function ($, window, document) {
    "use strict";

    $(document).on( 'ready', function(){
        var $body = $('body'),
            $topbar = $( document.getElementById('topbar') ),
            $products_sliders = $('.products-slider-wrapper, .categories-slider-wrapper');

        /*************************
         * SHOP STYLE SWITCHER
         *************************/

        $('#list-or-grid').on( 'click', 'a', function(){

            var trigger = $(this),
                view = trigger.attr( 'class' ).replace('-view', '');

            $( '.content ul.products li' ).removeClass( 'list grid' ).addClass( view );
            trigger.parent().find( 'a' ).removeClass( 'active' );
            trigger.addClass( 'active' );

            $.cookie( yit_shop_view_cookie, view );

            return false;

        });

        /*************************
         * Fix Product Name and Price
         *************************/

        var padding_nameprice = function () {
            $('li.product .product-wrapper .info-product.slideup').each(function () {
                $(this).find('h3').css( 'padding-' + ( ! yit.isRtl ? 'right' : 'left' ), $(this).find('span.price').width() + 10 );
            });
        };

        if( $(window).width() > 1199 ){
            padding_nameprice();
        }

        $(document).on('yith-wcan-ajax-filtered', padding_nameprice );

        /*************************
         * ADD TO CART
         *************************/
        var product, product_onsale;

        var add_to_cart = function() {

            $('ul.products').on('click', 'li.product .add_to_cart_button', function () {
                product = $(this).parents('li.product');
                product_onsale = product.find('.product-wrapper > .onsale');


                if( typeof yit.load_gif != 'undefined' ) {
                    product.find('.thumb-wrapper').block({message: null, overlayCSS: {background: '#fff url(' + yit.load_gif + ') no-repeat center', opacity: 0.3, cursor: 'none'}});
                }
                else{
                    product.find('.thumb-wrapper').block({message: null, overlayCSS: {background: '#fff url(' + woocommerce_params.ajax_loader_url.substring(0, woocommerce_params.ajax_loader_url.length - 7) + '.gif) no-repeat center', opacity: 0.3, cursor: 'none'}});
                }

            });
        }

        add_to_cart();
        $(document).on('yith-wcan-ajax-filtered', add_to_cart );

        $body.on('added_to_cart', function () {

            if( typeof product_onsale === 'undefined' && typeof product === 'undefined' ) return;

            $( '.products-slider.swiper .swiper-slide .opacity .swiper-product-informations span.product-add-to-cart a.added_to_cart.wc-forward')
                    .addClass( 'btn btn-flat' )
                    .prev('a').remove();

                if ( product_onsale.length ) {
                    product_onsale.remove();
                }

                product.find('.thumb-wrapper').append('<div class="added_to_cart_box"><div class="added_to_cart_label">' + yit.added_to_cart + '</div></div>');
                product.find('.added_to_cart_label').append(product.find('a.added_to_cart'));
                product.find('.product-wrapper div:first-child').addClass('nohover');

                setTimeout( function(){
                    product.find('.added_to_cart_box').fadeOut(2000, function(){ $(this).remove(); });
                    product.find('.product-wrapper div:first-child').removeClass('nohover');
                }, 3000 );

                if (product.find('.product-wrapper > .added_to_cart_ico').length == 0) {
                    setTimeout(function() {
                        product.find('.product-wrapper').append('<span class="added_to_cart_ico">' + yit.added_to_cart_ico + '</span>');
                    }, 4000);
                }
                product.find('.thumb-wrapper').unblock();
        });


        /*************************
         * PRODUCTS SLIDER
         *************************/

        if( $.fn.owlCarousel && $.fn.imagesLoaded && $products_sliders.length ) {

            var product_slider = function(t) {

                t.imagesLoaded(function(){
                    var cols = t.data('columns') ? t.data('columns') : 4;
                    var autoplay = (t.attr('data-autoplay')=='true') ? 3000 : false;

                    var owl = t.find('.products').owlCarousel({
                        items             : cols,
                        responsiveClass   : true,
                        responsive:{
                            0 : {
                                items: 2
                            },
                            479 : {
                                items: 3
                            },
                            767 : {
                                items: 4
                            },
                            992 : {
                                items: cols
                            }
                        },
                        autoplay          : autoplay,
                        autoplayTimeout   : 2000,
                        autoplayHoverPause: true,
                        loop              : true,
                        rtl: yit.isRtl == true
                    });

                    // Custom Navigation Events
                    t.on('click', '.es-nav-next', function () {
                        owl.trigger('next.owl.carousel');
                    });

                    t.on('click', '.es-nav-prev', function () {
                        owl.trigger('prev.owl.carousel');
                    });

                });
            };

            // initialize slider in only visible tabs
            $products_sliders.each(function(){
                var t = $(this);
                if( ! t.closest('.panel.group').length || t.closest('.panel.group').hasClass('showing')  ){
                    product_slider( t );
                }
            });

            $('.tabs-container').on( 'yit_tabopened', function( e, tab ) {
                product_slider( tab.find( $products_sliders ) );
            });
        }

        /*************************
         * VARIATIONS SELECT
         *************************/

        var variations_select = function(){
            // variations select
            if( $.fn.selectbox ) {
                var form = $('form.variations_form');
                var select = form.find('select:not(.yith_wccl_custom)');

                if( form.data('wccl') ) {
                    select = select.filter(function(){
                        return $(this).data('type') == 'select'
                    });
                }

                select.selectbox({
                    effect: 'fade',
                    onOpen: function() {
                        //$('.variations select').trigger('focusin');
                    }
                });

                var update_select = function(event){  // console.log(event);
                    select.selectbox("detach");
                    select.selectbox("attach");
                };

                // fix variations select
                form.on( 'woocommerce_update_variation_values', update_select);
                form.find('.reset_variations').on('click.yit', update_select);
            }
        };
        variations_select();

        /*************************
         * TOPBAR INDICATORS
         *************************/

        $topbar.find('#lang_sel .lang_sel_sel').append('<span class="sf-sub-indicator"> +</span>');
        $topbar.find('#wcml_currency_switcher > ul > li a.sbSelector').append('<span class="sf-sub-indicator"> +</span>');

        /*************************
         * PRODUCT TABS
         *************************/

        $('.single-product-tabs.vertical').on('click', 'ul.tabs li .tab_name', function () {
            var tab_trigger = $(this),
                panel = tab_trigger.siblings('.panel'),
                container = tab_trigger.closest('.single-product-tabs');

            if ( ! tab_trigger.hasClass('active') ) {

                //remove opened tab
                container.find('.tab_name.active').siblings('div.panel').slideToggle('slow');
                container.find('.tab_name.active').removeClass('active');

                //open tab
                tab_trigger.addClass('active');
            } else {
                tab_trigger.removeClass('active');
            }

            panel.slideToggle('slow');

        });

        /*************************
         * INQUIRY FORM
         *************************/

        var inquiry_form = function(){
            if ( $('#inquiry-form .product-inquiry').length ) {
                $(document).on('click', '#inquiry-form .product-inquiry', function(event){
                    event.stopImmediatePropagation('click');
                    $(this).next('form.contact-form').slideToggle('slow');
                });
            }
        };

        inquiry_form();
        $(document).on('yit_quick_view_loaded', inquiry_form);

        if( $( 'body').hasClass( 'single-product' ) ) {
            setTimeout( function() {
                if( $.trim( $( 'div.user-message').html() ) != '' || $.trim( $( '.contact-form li div.msg-error' ).text() ) != '' ) {
                    $('form.contact-form').slideToggle('slow');
                }
            }, 200 );
        }

        /*************************
         * Wishlist
         *************************/

        var wishlist_share = function() {
            if ( $('#wishlist-share div.share-text').length ) {
                $(document).on('click', '#wishlist-share div.share-text', function(){
                    $(this).next('div.share-link-container').slideToggle('slow');
                });
            }
        };

        wishlist_share();
        $(document).on('yit_quick_view_loaded', wishlist_share);

        /*************************
         * Update Calculate Shipping Select
         *************************/
        var wc_version = 2.2;
        if (typeof yit_woocommerce != 'undefined') wc_version = parseFloat(yit_woocommerce.version);
        if ( wc_version < 2.3 && $.fn.selectbox ) {
            $('#calc_shipping_state').next('.sbHolder').addClass('stateHolder');
            $body.on('country_to_state_changing', function(){
                $('.stateHolder').remove();
                $('#calc_shipping_state').show().attr('sb', '');

                $('select#calc_shipping_state').selectbox({
                    effect: 'fade',
                    classHolder: 'stateHolder sbHolder'
                });
            });
        }

        /*************************
         * Login Form
         *************************/

//        $('#login-form').on('submit', function(){
//            var a = $('#reg_password').val();
//            var b = $('#reg_password_retype').val();
//            if(!(a==b)){
//                $('#reg_password_retype').addClass('invalid');
//                return false;
//            }else{
//                $('#reg_password_retype').removeClass('invalid');
//                return true;
//            }
//        });

        /*************************
         * PRODUCT QUICK VIEW
         *************************/

        function quick_view_trigger() {

            $('div.quick-view a.trigger').yit_quick_view({
                item_container: 'li.product',
                loader        : 'div.single-product.woocommerce',
                assets        : yit_quick_view.assets,
                before        : function (trigger, item) {

                    // add loading in the button
                    if( typeof yit.load_gif != 'undefined' ) {
                        trigger.parent().block({message: null, overlayCSS: {background: '#fff url(' + yit.load_gif + ') no-repeat center', opacity: 0.3, cursor: 'none'}});
                    }
                    else{
                        trigger.parent().block({message: null, overlayCSS: {background: '#fff url(' + woocommerce_params.ajax_loader_url.substring(0, woocommerce_params.ajax_loader_url.length - 7) + '.gif) no-repeat center', opacity: 0.3, cursor: 'none'}});
                    }

                    item.find('.thumb-wrapper').addClass('hover');

                },
                openDialog    : function (trigger, item) {

                    // remove loading from button
                    trigger.parent().unblock();
                    item.find('.thumb-wrapper').removeClass('hover');

                },
                completed     : function (trigger, item, html, overlay) {

                    var data = $('<div>' + html + '</div>'),
                        title = data.find('h1.product_title').html(),
                        price = data.find('p.price').html(),
                        rating = data.find('div.star-rating').html(),
                        container = document.getElementById('wrapper'),
                        wrapper = $(overlay).find('.main .container');

                    // add main class to dialog container
                    $(overlay).addClass('product-quick-view');

                    // head
                    $('<p />').addClass('price').html(price).prependTo(wrapper.find('.head'));
                    $('<div />').addClass('star-rating').html(rating).prependTo(wrapper.find('.head'));
                    $('<h4 />').html(title).prependTo(wrapper.find('.head'));

                    //prettyPhoto
                    if ( typeof $.prettyPhoto != 'undefined' ) {
                        data.find( "a[rel^='thumbnails'], a.zoom" ).prettyPhoto({
                            social_tools      : false,
                            theme             : 'pp_woocommerce',
                            horizontal_padding: 40,
                            opacity           : 0.9,
                            deeplinking       : false
                        });
                    }

                    // quantity fields
                    $('div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)').addClass('buttons_added').append('<input type="button" value="+" class="plus" />').prepend('<input type="button" value="-" class="minus" />');

                    variations_select();

                    // add to cart
                    $('form.cart', overlay).on('submit', function (e) {
                        e.preventDefault();

                        var form = $(this),
                            button = form.find('button'),
                            product_url = item.find('a.thumb').attr('href');

                        if( typeof yit.load_gif != 'undefined' ) {
                            button.block({message: null, overlayCSS: {background: '#fff url(' + yit.load_gif + ') no-repeat center', opacity: 0.3, cursor: 'none'}});
                        }
                        else if (typeof( woocommerce_params.plugin_url ) != 'undefined') {
                            button.block({message: null, overlayCSS: {background: '#fff url(' + woocommerce_params.plugin_url + '/assets/images/ajax-loader.gif) no-repeat center', opacity: 0.3, cursor: 'none'}});
                        }
                        else {
                            button.block({message: null, overlayCSS: {background: '#fff url(' + woocommerce_params.ajax_loader_url.substring(0, woocommerce_params.ajax_loader_url.length - 7) + '.gif) no-repeat center', opacity: 0.3, cursor: 'none'}});
                        }

                        $.post(product_url, form.serialize() + '&_wp_http_referer=' + product_url, function (result) {
                            var message = $( '.woocommerce-message', result ),
                                cart_dropdown = $( '#header .yit_cart_widget', result);

                            if( typeof wc_cart_fragments_params != 'undefined') {
                                // update fragments
                                var $supports_html5_storage;

                                try {
                                    $supports_html5_storage = ( 'sessionStorage' in window && window.sessionStorage !== null );

                                    window.sessionStorage.setItem('wc', 'test');
                                    window.sessionStorage.removeItem('wc');
                                } catch (err) {
                                    $supports_html5_storage = false;
                                }

                                $.ajax({
                                    url    : wc_cart_fragments_params.wc_ajax_url.toString().replace('%%endpoint%%', 'get_refreshed_fragments'),
                                    type   : 'POST',
                                    success: function (data) {

                                        if (data && data.fragments) {

                                            $.each(data.fragments, function (key, value) {
                                                $(key).replaceWith(value);
                                            });

                                            if ($supports_html5_storage) {
                                                sessionStorage.setItem(wc_cart_fragments_params.fragment_name, JSON.stringify(data.fragments));
                                                sessionStorage.setItem('wc_cart_hash', data.cart_hash);
                                            }

                                            $(document.body).trigger('wc_fragments_refreshed');
                                        }
                                    }
                                });
                            }

                            // add message
                            $('div.product', overlay).before(message);

                            // remove loading
                            button.unblock();
                        });
                    });

                    // others
                    $('#wishlist-share').find('.share-link-container').hide();
                    $('#inquiry-form').find('form.contact-form').hide();

                },
                action        : 'yit_load_product_quick_view'
            });

        }

        if ($.fn.yit_quick_view && typeof yit_quick_view != 'undefined') {

            quick_view_trigger();
            $(document).on('yith-wcan-ajax-filtered', quick_view_trigger);

        }

        /*************************
         * WISHLIST LABEL
         *************************/

        $( '.yith-wcwl-add-button .add_to_wishlist').on( 'click', function() {

            var feedback = $(this).closest('.yith-wcwl-add-to-wishlist').find('.yith-wcwl-wishlistaddedbrowse span.feedback');

            feedback.fadeIn();

            setTimeout( function(){
                feedback.fadeOut('slow');
            }, 4000 );
        });

        /*************************
         * Widget Woo Price Filter
         *************************/

        if( yit.price_filter_slider == 'no' || typeof yit.price_filter_slider == 'undefined' ) {
            var removePriceFilterSlider = function() {
                $( 'input#min_price, input#max_price' ).show();
                $('form > div.price_slider_wrapper').find( 'div.price_slider, div.price_label' ).hide();
            };

            removePriceFilterSlider();
        }

        /*****************************
         * TERMS AND CONDITIONS POPUP
         *****************************/

        if ($.fn.yit_quick_view ) {
            var term_popup = function() {
                $('p.terms a').yit_quick_view({
                    item_container: 'p.terms',
                    loader: '#primary .content',
                    loadPage: true,

                    before: function( trigger, item ) {

                        // add loading in the button
                        if( typeof yit.load_gif != 'undefined' ) {
                            item.block({message: null, overlayCSS: {background: '#fff url(' + yit.load_gif + ') no-repeat center', opacity: 0.3, cursor: 'none'}});
                        } else {
                            item.block({message: null, overlayCSS: {background: '#fff url(' + woocommerce_params.ajax_loader_url.substring(0, woocommerce_params.ajax_loader_url.length - 7) + '.gif) no-repeat center', opacity: 0.3, cursor: 'none'}});
                        }


                    },

                    completed: function( trigger, item, html, overlay ) {

                        var data = $('<div>' + html + '</div>'),
                            title = trigger.text(),
                            container = document.getElementById( 'wrapper' ),
                            wrapper = $(overlay).find('.main .container');

                        // head
                        $('<h4 />').html(title).prependTo( wrapper.find('.head') );
                        $(overlay).addClass('terms-popup');
                        $(overlay).find('.content').removeClass('col-sm-12 col-sm-9');
                    },

                    openDialog: function( trigger, item ) {
                        item.unblock();
                    }
                });
            };

            $body.on('updated_checkout', term_popup);
            term_popup();
        }

        $(document).on( 'click' , '.cart_totals .cart_update_checkout input[type="submit"]' , function() {
            $('.woocommerce > form input[name="update_cart"]').click();

        } );

    });

})( jQuery, window, document );