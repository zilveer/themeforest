(function($) {
    'use strict';

    var woocommerce = {};
    qodef.modules.woocommerce = woocommerce;

    woocommerce.qodefInitQuantityButtons = qodefInitQuantityButtons;
    woocommerce.qodefInitSelect2 = qodefInitSelect2;
    woocommerce.qodefInitSingleProductSlider = qodefInitSingleProductSlider;
    woocommerce.qodefInitProductListSlider = qodefInitProductListSlider;
    woocommerce.initWishlistProgressImage = initWishlistProgressImage;
    woocommerce.qodefInitcheckout = qodefInitcheckout;
    woocommerce.qodefReInitSelect2CartAjax = qodefReInitSelect2CartAjax;

    woocommerce.qodefOnDocumentReady = qodefOnDocumentReady;
    woocommerce.qodefOnWindowLoad = qodefOnWindowLoad;
    woocommerce.qodefOnWindowResize = qodefOnWindowResize;
    woocommerce.qodefOnWindowScroll = qodefOnWindowScroll;

    $(document).ready(qodefOnDocumentReady);
    $(window).load(qodefOnWindowLoad);
    $(window).resize(qodefOnWindowResize);
    $(window).scroll(qodefOnWindowScroll);
    
    /* 
        All functions to be called on $(document).ready() should be in this function
    */
    function qodefOnDocumentReady() {
        qodefInitQuantityButtons();
        qodefInitSelect2();
        initWishlistProgressImage();
        qodefAddToCart();
        qodefInitcheckout();
        qodefReInitSelect2CartAjax();
    }

    /* 
        All functions to be called on $(window).load() should be in this function
    */
    function qodefOnWindowLoad() {
        qodefInitSingleProductSlider();
        qodefInitProductListSlider();
    }

    /* 
        All functions to be called on $(window).resize() should be in this function
    */
    function qodefOnWindowResize() {

    }

    /* 
        All functions to be called on $(window).scroll() should be in this function
    */
    function qodefOnWindowScroll() {

    }
    

    function qodefInitQuantityButtons() {

        $(document).on( 'click', '.qodef-quantity-minus, .qodef-quantity-plus', function(e) {
            e.stopPropagation();

            var button = $(this),
                inputField = button.parent().siblings('.qodef-quantity-input'),
                step = parseFloat(inputField.attr('step')),
                max = parseFloat(inputField.attr('max')),
                minus = false,
                inputValue = parseFloat(inputField.val()),
                newInputValue;

            if (button.hasClass('qodef-quantity-minus')) {
                minus = true;
            }

            if (minus) {
                newInputValue = inputValue - step;
                if (newInputValue >= 1) {
                    inputField.val(newInputValue);
                } else {
                    inputField.val(0);
                }
            } else {
                newInputValue = inputValue + step;
                if ( max === undefined ) {
                    inputField.val(newInputValue);
                } else {
                    if ( newInputValue >= max ) {
                        inputField.val(max);
                    } else {
                        inputField.val(newInputValue);
                    }
                }
            }

            inputField.trigger( 'change' );

        });

    }

    function qodefInitSelect2() {

        if ($('.woocommerce-ordering .orderby').length) {

            $('.woocommerce-ordering .orderby').select2({
                minimumResultsForSearch: Infinity
            });
        }

        if($('select#calc_shipping_country').length) {
            $('select#calc_shipping_country').select2();
        }

        if($('select#calc_shipping_state').length) {
            $('select#calc_shipping_state').select2();
        }

        if($('table.variations').length > 0) {
            $('table.variations').find('td.value').each(function() {
               $(this).find('select').select2({
                   minimumResultsForSearch: -1
               }).on("select2-opening", function() { $(this).trigger('focusin'); });
            });
        }

        if($('.qodef-cart-totals').length > 0) {
            $( document.body ).on('updated_shipping_method', function() {
                var select = $('.qodef-cart-totals').find('select#calc_shipping_country');
                if(select.length) {
                    select.select2({});
                }
                var selectState = $('.qodef-cart-totals').find('select#calc_shipping_state');
                if(selectState.length) {
                    selectState.select2({});
                }
            });
        }
    }

    /*
     ** Re Init select2 script for select html dropdowns
     */
    function qodefReInitSelect2CartAjax() {

        $(document).ajaxComplete(function() {
            if ($('select#calc_shipping_country').length) {
                $('select#calc_shipping_country').select2();
            }
            if ($('select#calc_shipping_state').length) {
                $('select#calc_shipping_state').select2();
            }
        });
    }

    function qodefInitcheckout() {
        var checkoutHolder  = $('.woocommerce-checkout-review-order');
        if(checkoutHolder.length > 0) {
            checkoutHolder.on('click', 'input[name="payment_method"]', function(){
                if ( $( '.payment_methods input.input-radio' ).length > 1 ) {
                    $('.payment_methods input.input-radio').removeClass("checked");
                    if ( $( this ).is( ':checked' )) {
                        $(this).addClass("checked");
                    }
                }
            });
        }

        var loginHolder = $('#customer_login'); {
            if(loginHolder.length > 0) {
                var checkBox = loginHolder.find('#rememberme');
                checkBox.on('click', function() {
                    if($(this).is(':checked')) {
                        $(this).addClass("checked");
                        $(this).parents('label').addClass("checked");
                    }
                    else {
                        $(this).removeClass("checked");
                        $(this).parents('label').removeClass("checked");
                    }
                });
            }
        }

        $('.input-checkbox').on('click', function() {
            if($(this).is(':checked')) {
                $(this).addClass("checked");
                $(this).siblings('label').addClass("checked");
            }
            else {
                $(this).removeClass("checked");
                $(this).siblings('label').removeClass("checked");
            }
        });
    }

    function qodefInitSingleProductSlider() {
        if($('.qodef-single-product-info-top').length) {
            var sliderHolder = $('.qodef-single-product-slider');
            var sliderThumbnails = $('.qodef-single-product-thumbnails');
            var variableProductsHolder = $('.qodef-variation-images');
            var productImage, thumbImage;

            sliderHolder.on('init', function(slick){
                sliderHolder.css("opacity", 1);
            });
            sliderThumbnails.on('init', function(slick){
                sliderThumbnails.css("opacity", 1);
                productImage = sliderHolder.find( 'img:eq(0)' );
                thumbImage = sliderThumbnails.find('.qodef-thumbnail-holder[data-slick-index=0]');
            });

            if(sliderHolder.length > 0) {
                sliderHolder.slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false,
                    fade: true,
                    draggable: false
                });
            }

            if(sliderThumbnails.length > 0) {
                sliderThumbnails.slick({
                    slidesToShow: 5,
                    slidesToScroll: 1,
                    asNavFor: sliderHolder,
                    dots: false,
                    arrows: false,
                    vertical: true,
                    verticalSwiping: true,
                    draggable: true,
                    focusOnSelect: true,
                    responsive: [
                        {
                            breakpoint: 1024,
                            settings: {
                                slidesToShow: 4
                            }
                        },
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 3
                            }
                        },
                        {
                            breakpoint: 600,
                            settings: {
                                slidesToShow: 2
                            }
                        }
                    ]
                });
            }

            if(typeof productImage !== 'undefined') {
                productImage.on('load', function () {
                    updateSliderImages(productImage, thumbImage);
                });
            }
        }

        function updateSliderImages(productImage, thumbImage) {
            if(variableProductsHolder.length) {
                if(typeof thumbImage !== 'undefined') {
                    var originalSrc = productImage.parent().attr('href');
                    var variableProductsImages = variableProductsHolder.find('.qodef-variation-image');
                    if(variableProductsImages.length) {
                        variableProductsImages.each(function() {
                            if($(this).attr('data-original-image') == originalSrc) {
                                thumbImage.find('img').attr('src', $(this).attr('data-thumb-image'));
                                var siblingVal = thumbImage.attr('aria-describedby');
                                var sibling = sliderThumbnails.find("[aria-describedby='"+siblingVal+"']");
                                sibling.find('img').attr('src', $(this).attr('data-thumb-image'));
                            }
                        });
                    }
                }
            }
        }
    }

    function qodefInitProductListSlider() {
        var sliderHolders = $('.qodef-product-list-slider');
        
        if(sliderHolders.length > 0) {

            sliderHolders.each(function() {
                var sliderHolder = $(this);

                var slidesToShow = sliderHolder.data('items-visible');
                var arrows = sliderHolder.data('navigation') == 'yes';

                sliderHolder.on('init', function(slick){
                    recalculateArrowHeight(sliderHolder);
                    sliderHolder.css("opacity", 1);
                });

                sliderHolder.on('setPosition', function(slick){
                    recalculateArrowHeight(sliderHolder);
                });

                /* Responsive breakpoints start */
                var responsive = [];
                if( !sliderHolder.parents().hasClass('qodef-section-inner') &&
                    !sliderHolder.parents().hasClass('qodef-container-inner')) {
                    if (slidesToShow == 6) {
                        var limit65 = {
                            'breakpoint': 1601,
                            'settings': {
                                'slidesToShow': 5
                            }
                        };
                        var limit64 = {
                            'breakpoint': 1201,
                            'settings': {
                                'slidesToShow': 4
                            }
                        };
                        responsive.push(limit65);
                        responsive.push(limit64);
                    }
                    if (slidesToShow == 5) {
                        var limit54 = {
                            'breakpoint': 1201,
                            'settings': {
                                'slidesToShow': 4
                            }
                        };
                        responsive.push(limit54);
                    }

                    if (slidesToShow > 3) {
                        var limit43 = {
                            'breakpoint': 1025,
                            'settings': {
                                'slidesToShow': 3
                            }
                        };
                        var limit42 = {
                            'breakpoint': 769,
                            'settings': {
                                'slidesToShow': 2
                            }
                        };
                        var limit41 = {
                            'breakpoint': 601,
                            'settings': {
                                'slidesToShow': 1
                            }
                        };
                        responsive.push(limit43);
                        responsive.push(limit42);
                        responsive.push(limit41);
                    }
                    else {
                        var limit32 = {
                            'breakpoint': 769,
                            'settings': {
                                'slidesToShow': 2
                            }
                        };
                        var limit31 = {
                            'breakpoint': 601,
                            'settings': {
                                'slidesToShow': 1
                            }
                        };
                        responsive.push(limit32);
                        responsive.push(limit31);
                    }
                }
                else {
                    if (slidesToShow > 3) {
                        var limit43grid = {
                            'breakpoint': 1201,
                            'settings': {
                                'slidesToShow': 3
                            }
                        };
                        var limit42grid = {
                            'breakpoint': 769,
                            'settings': {
                                'slidesToShow': 2
                            }
                        };
                        var limit41grid = {
                            'breakpoint': 601,
                            'settings': {
                                'slidesToShow': 1
                            }
                        };
                        responsive.push(limit43grid);
                        responsive.push(limit42grid);
                        responsive.push(limit41grid);
                    }
                    else {
                        var limit32grid = {
                            'breakpoint': 769,
                            'settings': {
                                'slidesToShow': 2
                            }
                        };
                        var limit31grid = {
                            'breakpoint': 601,
                            'settings': {
                                'slidesToShow': 1
                            }
                        };
                        responsive.push(limit32grid);
                        responsive.push(limit31grid);
                    }
                }

                /* Responsive breakpoints end */

                sliderHolder.slick({
                    slidesToShow: slidesToShow,
                    slidesToScroll: 1,
                    speed: 600,
                    easing:'easeOutQuint',
                    arrows: arrows,
                    draggable: true,
                    prevArrow: '<span class="qodef-slick-slider-nav-left"><span class="lnr lnr-chevron-left"></span></span>',
                    nextArrow: '<span class="qodef-slick-slider-nav-right"><span class="lnr lnr-chevron-right"></span></span>',
                    responsive: responsive
                });

            });
        }

        function recalculateArrowHeight(sliderHolder) {
            if(sliderHolder.hasClass('standard')) {
                sliderHolder.waitForImages(function(){
                    var height = sliderHolder.find('li:eq(0) .qodef-product-standard-image-holder').outerHeight();
                    sliderHolder.find('.slick-arrow').css('height',height+'px');
                });

            }
        }
    }

    function initWishlistProgressImage() {
        if($('.yith-wcwl-add-to-wishlist').length) {
            var holder = $('.yith-wcwl-add-to-wishlist');
            var addToWishlist = holder.find('.add_to_wishlist');
            addToWishlist.on('click', function () {
                holder.addClass('qodef-custom-loader');
            });
        }
    }

    /*
    * Add to Cart animation
    */
    function qodefAddToCart() {
        var addToCartButtons = $('.add_to_cart_button');
        if (addToCartButtons.length) {
            addToCartButtons.each(function(){
                var addToCartButton = $(this);
                addToCartButton.click(function(){
                    var label = addToCartButton.find('.qodef-btn-text');
                    if (label.text() == 'Add to cart') {
                        addToCartButton.animate({'opacity':0},500,'easeInOutSine');
                    }
                });

            });
        }
    }


})(jQuery);