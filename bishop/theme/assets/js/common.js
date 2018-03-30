(function ($, window, document) {
    "use strict";

    $(document).on( 'ready', function(){
        var $window   = $(window),
            $body     = $(document.body),

            header    = document.getElementById('header'),
            nav       = document.getElementById('nav'),
            primary   = document.getElementById('primary'),
            footer    = document.getElementById('footer'),
            copyright = document.getElementById('copyright'),

            $header    = $( header ),
            $nav       = $( nav ),
            $primary   = $( primary ),
            $footer    = $( footer ),
            $copyright = $( copyright ),

            onScrollEnd,

            detectDevice = function(){
                if ( YIT_Browser.isViewportBetween( 1024 ) ) {
                    $body.addClass('isMobile');
                    $("#animate-css").attr("disabled", "disabled");
                }
                else {
                    $body.removeClass('isMobile');
                    $("#animate-css").attr("disabled", false);
                }

                if ( YIT_Browser.isViewportBetween( 1024, 768 ) ) {
                    $body.addClass('isIpad');
                }
                else {
                    $body.removeClass('isIpad');
                }

                if ( YIT_Browser.isViewportBetween( 767 ) ) {
                    $body.addClass('isIphone');
                }
                else {
                    $body.removeClass('isIphone');
                }
            },

            fix_menu = function (){

                /* fix logo */
                if ( $('#logo').find('img').height() > 87 ){
                    var mmh = $('#menu-main-menu').children('li').outerHeight();
                    $('.skin1').find('#nav, #header-sidebar').css('margin-top', ( $('#header-container').height()  - mmh ) / 2+'px');
                }
            };

        /*************************
         * MISC
         *************************/

        if ( YIT_Browser.isIE8() ) {
            $('*:last-child').addClass('last-child');
        }

        if( YIT_Browser.isIE10() ) {
            $( 'html' ).attr( 'id', 'ie10' ).addClass( 'ie' );
        }

        // placeholder support
        if($.fn.placeholder) {
            $('input[placeholder], textarea[placeholder]').placeholder();
        }

        // detect device and add the class to body
        _onresize( detectDevice );
        detectDevice();

//        $window.on('scroll', function(){
//            $(".owl-carousel").each(function(){
//                var owl = $(this).data('owlCarousel');
//
//                if ( typeof owl != 'undefined' ) {
//                    if ( onScrollEnd ) clearTimeout( onScrollEnd );
//
//                    onScrollEnd = setTimeout(function(){
//                        owl.play();
//                    }, 500 );
//
//                    owl.stop();
//                }
//            });
//        });

        /*************************
         * Smooth Scroll Onepage
         *************************/
        $.fn.yit_onepage = function(){
            var nav = $(this);

            //smooth scrolling
            nav.on( 'click', 'a[href*="#"]:not([href="#"])', function() {
                if ( location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname ) {
                    var target = $(this.hash),
                        offsetSize = 34,
                        nearHeader = $header.next('div');

                    target = target.length ? target : $('[name=' + this.hash.slice(1) +']');

                    if( $header.hasClass('sticky-header') && ! $body.hasClass('force-sticky-header') ){
                        offsetSize += $header.height();

                        if( nearHeader.attr('id') == 'primary' && nearHeader.find('.blog_big').length == 0 && nearHeader.find('.portfolio').length == 0 && nearHeader.find('.title_bar_single_product').length == 0  ){
                            offsetSize += 38;
                        }
                    }

                    if ( $body.hasClass('admin-bar') ) {
                        offsetSize += $('#wpadminbar').height();
                    }

                    if ( target.length ) {
                        $('html,body').animate({
                            scrollTop: target.offset().top - offsetSize
                        }, 1000, 'easeOutCirc');

                        return false;
                    }
                }
            });
        };

        $nav.yit_onepage();

        /*************************
         * Custom select
         *************************/

        var custom_select_style = function(){
            if ( $.fn.selectbox ) {
                /*fix wc 2.3 */
                var wc_version = 2.2;
                if (typeof yit_woocommerce != 'undefined') wc_version = parseFloat(yit_woocommerce.version);
                var calculate_shipping_select = '';
                if(wc_version < 2.3) calculate_shipping_select = '.woocommerce table.shop_table.shipping p select,';
                var custom_selects = $('.woocommerce-ordering select, .faq-filters select, '+calculate_shipping_select+' .widget_product_categories select, .widget.widget_archive select, .widget.widget_categories #cat, #buddypress div.item-list-tabs ul li.last select, #buddypress select#whats-new-post-in, select#bbp_stick_topic_select, select#bbp_topic_status_select, select#message-type-select, select#display_name, select#bbp_destination_topic, select#bbp_forum_id, #dropdown_layered_nav_color, .wcml_currency_switcher,.search_categories.selectbox');
                if ( custom_selects.length > 0 ) {
                    custom_selects.selectbox({
                        effect: 'fade'
                    });
                }
            }
        };
        $(document).on('yit_quick_view_loaded');
        custom_select_style();

        /*************************
         * Sticky Footer
         *************************/

        if ( $.fn.imagesLoaded ) {
            $primary.imagesLoaded(function () {
                if ( $footer.length > 0) {
                    $footer.stickyFooter();
                }
                else {
                    $copyright.stickyFooter();
                }
            });
        }

        /*************************
         * Replace type="number" in opera
         *************************/

        $('.opera').find('.quantity input.input-text.qty').replaceWith(function() {
            return '<input type="text" class="input-text qty text" name="quantity" value="' + $(this).attr('value') + '" />';
        });

        /*************************
         * Back to top
         *************************/

        var $backToTop = $( document.getElementById("back-top") );

        if ( $backToTop.length ) {
            // hide #back-top first
            $backToTop.hide();

            // fade in #back-top
            $window.on( 'scroll', function () {
                if ( $window.scrollTop() > 100 ) {
                    $backToTop.fadeIn();
                } else {
                    $backToTop.fadeOut();
                }
            });

            // scroll body to 0px on click
            $backToTop.on( 'click', 'a', function (e) {
                e.preventDefault();

                $('body,html').animate({
                    scrollTop: 0
                }, 800);
            });
        }

        /*************************
         * YIT Share
         *************************/

        var yit_share_init = function(){

            $( '.single-post .blog .share' ).add( '.single-post .blog .yit_post_meta .share').off('click').on('click', function(){
                var t       = $(this),
                    social  = t.find('.socials-container');

                if( social.is(':visible') ) {
                    social.slideUp('slow');
                } else {
                    social.slideDown('slow');
                }
            });
        };

        $body.on( 'yit_share_init', yit_share_init).trigger('yit_share_init');

        /*************************
         * dropdown ajax navigation
         *************************/

        var ywan_titles = $('.widget.yith-woo-ajax-navigation').find('h3');

        if ( ywan_titles.length ) {
            var dropdown_widget_nav = function() {

                $('.widget.yith-woo-ajax-navigation').find('h3').each(function () {

                    var header = $(this),
                        widget = header.parent(),
                        ul = widget.find('> ul.yith-wcan');

                    if ( ul.length ) {

                        header.css('cursor', 'pointer' );

                        //init widget
                        if ( widget.hasClass('closed') ) {
                            ul.hide();
                            header.append('<i class="fa fa-plus"></i>');
                        }
                        else if ( widget.hasClass('opened') ) {
                            header.append('<i class="fa fa-minus"></i>');
                        }
                        else {
                            widget.addClass('opened');
                            header.append('<i class="fa fa-minus"></i>');
                        }

                        // on click
                        header.on('click', function () {

                            ul.slideToggle('slow');

                            if ( widget.hasClass('closed') ) {
                                widget.removeClass('closed').addClass('opened');
                                header.find('i').removeClass('fa-plus').addClass('fa-minus');
                            }
                            else {
                                widget.removeClass('opened').addClass('closed');
                                header.find('i').removeClass('fa-minus').addClass('fa-plus');
                            }
                        });

                    }
                });
            };

            $(document).on('yith-wcan-ajax-filtered' , dropdown_widget_nav );

            dropdown_widget_nav();
        }

        /*************************
         * FIX HEADER POSITION
         *************************/

        var fixHeaderPosition = function(){
            var header_height = $header.height(),
                nearHeader = $header.next('div');

            if( $header.hasClass('sticky-header') && ! $body.hasClass('force-sticky-header') ){

                $('#header.sticky-header').addClass('fixed-header');
                if( $header.hasClass('sticky-header') ) {
                    $body.addClass('sticky-header');
                }

                if( nearHeader.attr('id') == 'primary' && nearHeader.find('.blog_big').length == 0 && nearHeader.find('.portfolio').length == 0 && nearHeader.find('.title_bar_single_product').length == 0  ){
                    header_height += 38;
                }

                nearHeader.not('.header-parallax').css( 'margin-top', header_height);
            } else {
                if( nearHeader.attr('id') == 'primary' && ( nearHeader.find('.blog_big').length != 0 || nearHeader.find('.portfolio').length != 0 || nearHeader.find('.title_bar_single_product').length != 0 ) ){
                    $('#primary').css({'margin-top': 0})
                }
            }
        };

        _onresize( fixHeaderPosition );
        fixHeaderPosition();

        /*************************
         * MENU
         *************************/

        var show_dropdown = function (t) {

                var options,
                    marginRight,
                    submenuWidth,
                    offsetMenuRight,
                    leftPos = 0,
                    containerWidth = $header.width(),
                    dropdown = $(t);

                if ( dropdown.is('#lang_sel ul > li') ) {
                    marginRight = dropdown.css('margin-right');
                    submenuWidth = dropdown.find('ul').outerWidth();
                    offsetMenuRight = dropdown.position().left + submenuWidth;

                    if ( offsetMenuRight > containerWidth )
                        options = { left: leftPos - ( offsetMenuRight - containerWidth ) };
                    else
                        options = {};

                    dropdown.find('ul li').parent().css(options).stop(true, true).fadeIn(300);

                } else if ( dropdown.hasClass('megamenu') ) {
                    dropdown.find('ul.sub-menu:not(ul.sub-menu li > div.submenu > ul.sub-menu), ul.children:not(ul.children li > div.submenu > ul.children)').parent().stop(true, true).fadeIn(500);

                } else if ( dropdown.hasClass('bigmenu') ) {
                    dropdown.find('ul.sub-menu:not(ul.sub-menu li > div.submenu > ul.sub-menu), ul.children:not(ul.children li > div.submenu > ul.children)').parent().stop(true, true).fadeIn(500);

                } else if ( dropdown.hasClass('login-menu') ) {
                    submenuWidth = dropdown.find('ul.sub-menu').outerWidth();
                    offsetMenuRight = dropdown.position().left + submenuWidth;

                    if (offsetMenuRight > containerWidth)
                        options = { left: leftPos - ( offsetMenuRight - containerWidth ) };
                    else
                        options = {};

                    dropdown.find('.login-box').parent().css(options).stop(true, true).fadeIn(300);
                } else {
                    submenuWidth = dropdown.find('div.submenu').outerWidth();
                    offsetMenuRight = dropdown.position().left + submenuWidth;

                    if (offsetMenuRight > containerWidth)
                        options = { left: leftPos - ( offsetMenuRight - containerWidth ) };
                    else
                        options = {};

                    dropdown.find('ul.sub-menu:not(ul.sub-menu li > div.submenu > ul.sub-menu), ul.children:not(ul.children li > div.submenu > ul.children)').parent().css(options).stop(true, true).fadeIn(300);
                }

            },

            hide_dropdown = function (t) {
                var dropdown = $(t);

                dropdown.find('ul.sub-menu:not(ul.sub-menu li > div.submenu > ul.sub-menu), ul.children:not(ul.children li > div.submenu > ul.children)').parent().fadeOut(300);
                $('.login-box').parent().fadeOut(300);
            };

        $('.nav').on( 'mouseenter mouseleave', 'ul:not(.woocommerce-error) > li', function(e){
            if ( e.type == 'mouseenter' ) show_dropdown( this );
            else if ( e.type == 'mouseleave' ) hide_dropdown( this );
        });

        //add icon home
        //$nav.find('li.icon-home a, li.icon-home-responsive a').html('<span class="glyphicon glyphicon-home"></span>');

        //add class to li with submenu
        $nav.find('ul:not(.sub-menu) > li:not(.megamenu) div.submenu').each(function () {
            $(this).closest('li').addClass('dropdown');
        });

        $('.nav ul > li').each(function () {
            var $this_item = $(this);
            if ( $this_item.find('ul').length > 0 ) {
                var $items_a = $this_item.children('a');
                    $items_a.append('<span class="sf-sub-indicator"> +</span>');

                    var add_padding = function () {
                        $items_a.css('padding-right', '').css({ paddingRight: parseInt($items_a.css('padding-right')) + 3 });
                    };

                    _onresize( add_padding );
                    add_padding();


            }
        });

        $('#lang_sel').on('click', '.lang_sel_sel', function(e){
            e.preventDefault();
            $(this).next('ul').toggle();
        });

        $nav.on( 'mouseenter mouseleave', 'li:not(.megamenu) ul.sub-menu li, li:not(.megamenu) ul.children li, li:not(.bigmenu) ul.sub-menu li, li:not(.bigmenu) ul.children li', function(e){
            var $this = $(this);

            if ( e.type == 'mouseenter' ) {
                if ( $this.closest('.megamenu').length > 0 ) {
                    return;
                }
                var containerWidth = $header.width(),
                    containerOffsetRight = $header.offset().left + containerWidth,
                    submenuWidth = $this.find('ul.sub-menu, ul.children').parent().width(),
                    offsetMenuRight = $this.offset().left + submenuWidth * 2,
                    leftPos = -10;

                if (offsetMenuRight > containerOffsetRight)
                    $this.addClass('left');

                $this.find('ul.sub-menu, ul.children').parent().stop(true, true).fadeIn(300);
            }
            else if ( e.type == 'mouseleave' ) {
                if ( $this.closest('.megamenu').length > 0 || ( $this.closest('.bigmenu').length > 0 && ! $this.prev().hasClass('.bigmenu') ))
                    return;

                $this.find('ul.sub-menu, ul.children').parent().fadeOut(300);
            }
        });


        $(".isMobile li.menu-item-has-children > a").click(function( event ){
            event.preventDefault();
        });

        /*************************
         * HEADER RESPONSIVE
         *************************/

        if ( $nav.find('li.icon-home').length || $nav.find('li.icon-home-responsive').length ) {
            var mobile_menu_header = function () {

                if (  $(window).width() < 991 ) {
                    $nav.find('li.icon-home').addClass('icon-home-responsive').removeClass('icon-home');
                } else {
                    $nav.find('li.icon-home-responsive').addClass('icon-home').removeClass('icon-home-responsive');
                }

            };

            _onresize( mobile_menu_header );
            mobile_menu_header();
        }

        var fixHeaderResponsive = function(){
            var header_sidebar = $('#header-sidebar'),
                setIcons = function() {
                    if ( $(window).width() < 768 ) {
                        header_sidebar.find('a.menu-trigger').addClass('fa fa-bars');
                        header_sidebar.find('a.search_mini_button').addClass('fa fa-search');
                        header_sidebar.find('div#welcome-menu > ul > li, div#welcome-menu-login > ul > li').addClass('fa fa-user');
                    } else {
                        header_sidebar.find('a.menu-trigger').removeClass('fa fa-bars');
                        header_sidebar.find('a.search_mini_button').removeClass('fa fa-search');
                        header_sidebar.find('div#welcome-menu > ul > li, div#welcome-menu-login > ul > li').removeClass('fa fa-user');
                    }
                };

            if ( $(window).width() < 768 && $('#logo.mobile-clone').length == 0 ) {
                var logo = $('#logo:not(.mobile-clone)').clone(true, true);
                logo.addClass('mobile-clone').appendTo('#header-container > .container');
            }

            if ( $(window).width() < 768 && $('.nav.mobile-clone').length == 0 ) {
                var nav  = $('#nav:not(.mobile-clone)').clone(true, true).attr('id', '').addClass('main-nav'),
                    main_nav;

                main_nav = nav.addClass('mobile-clone').prependTo('#header-sidebar');

                main_nav.prepend( '<a href="#" class="menu-trigger" />');
                main_nav.find('img').parent().remove();
                //main_nav.children('ul').prepend( '<li class="menu-close menu-item" />');
                //main_nav.find('.menu-close').prepend( '<a href="#">x ' + yit.responsive_menu_close + '</a>' );

            }

            setIcons();
        };

        _onresize( fixHeaderResponsive );
        fixHeaderResponsive();

        /*************************
         * MOBILE MENU
         *************************/

        $header
            // menu opening
            .on('click', 'a.menu-trigger', function(e){
                e.preventDefault();

                var trigger = $(this),
                    menu = trigger.siblings('ul');

                menu.toggle();
            })

            // my account
            .on('click', 'li.login-menu a', function(e){
                e.preventDefault();

                $(this).unbind('mouseenter mouseleave');

                document.location = $(this).attr('href');
            });

        /*************************
         * SEARCH AUTOCOMPLETE
         *************************/

        if( $('#yith-s').length ){
            var search_autocomplete = function(){
                var search = $('#yith-s'),
                    a = search.outerWidth()+ 1,
                    new_left = search.offset().left,
                    search_skin1 = $('.skin1 .widget_search_mini .autocomplete-suggestions'),
                    search_skin2 = $('.skin2 .widget_search_mini .autocomplete-suggestions');

                if ( search_skin1.length >0 ){
                    search_skin1.css({
                        left: new_left,
                        width: a +'px !important'
                    });
                }
                else if( search_skin2.length >0 ) {
                    search_skin2.css({
                        left: 32
                    });
                }
            };

            $(document).on( 'yit_ajax_search_init', search_autocomplete );
            _onresize( search_autocomplete );
        }

        /*************************
         * SEARCH MINI BUTTON
         *************************/

        $header.filter('.skin1').on('click', '.search_mini_button', function(e){
            e.preventDefault();

            var search_container = $(this).next();

            search_container.stop(true,true).slideToggle('slow', function(){
                search_container.trigger('yit_ajax_search_init');
            });
        });

        $header.filter('.skin2').on('click', '.search_mini_button', function(e){
            e.preventDefault();

            var search_container = $(this).next();

            search_container.stop(true,true).toggleClass('animated');
            search_container.trigger('yit_ajax_search_init');
        });

        /*************************
         * NAV SUBINDICATOR
         *************************/

        if ( $body.hasClass('isMobile') && ! $body.hasClass('isPhone') && ! $body.hasClass('isPad')) {
            $nav.find('.sf-sub-indicator').parent().on( 'click', function () {
                var item = $(this).parent();
                item.toggle( show_dropdown, function () {
                    document.location = item.children('a').attr('href');
                })
            });
        }

        /*************************
         * MEGAMENU
         *************************/

        if ( $nav.find('li.megamenu') ) {

            //add grid to megamenu
            $nav.find('li.megamenu > div > ul.sub-menu').each(function () {
                var nchild = $(this).children('li').length;
                $(this).addClass('container');
                $(this).children('li').addClass('col-sm-' + parseInt(12 / nchild));
            });

            //add custom image as background
            $nav.find('li.megamenu > div > ul.sub-menu li .custom-item-yitimage').each(function () {
                var custom_image = $(this);
                if (typeof custom_image != 'undefined') {
                    var image_item = custom_image.find('img').attr('src');
                    var height = custom_image.find('img').height();

                    /* added by Andrea Frascaspata rtl fix */
                    var background_position = ( yit.isRtl ) ? "left bottom" : "right bottom";
                    //------------------------------------------------

                    //custom_image.closest('li').css({'background': 'url(' + image_item + ') no-repeat '+background_position, 'height': height });
                    custom_image.closest('li').css({'background': 'url(' + image_item + ') no-repeat '+background_position });
                    custom_image.remove();
                }
            });


            var fixmegamenu = function(){
                var headh = $header.height(),
                    infobar_h = $('#infobar').outerHeight();

                if ( $header.hasClass('with-infobar') ) {
                    headh -= infobar_h;
                }

                $nav.find('li.megamenu div.submenu').css( 'top', headh+'px' );

                fix_menu();
            };

            _onresize( fixmegamenu );
            $window.on( 'load', fixmegamenu );

        }

        /*************************
         * BIGMENU
         *************************/

        if ( $nav.find('li.bigmenu').length ) {

            //add custom image as background
            $nav.find('.bigmenu').each( function () {

                var bigmenu = $(this),

                    custom_image  =  bigmenu.find('.custom-item-yitimage'),
                    col_width = 220, //width of a column
                    maxcol = 3,      //max columns in a row
                    col = 1,         //min num of column

                    paddingright = 0,
                    paddingbottom = 0;

                if( bigmenu.is("[class*='padding-bottom-']") || bigmenu.is("[class*='padding-right-']") ){
                    var classes = bigmenu.attr('class').split(" ");

                    $.each( classes, function( i, val ) {
                        if( val.indexOf('padding-bottom-') != -1 ){
                            paddingbottom = val.replace('padding-bottom-', '');
                        }
                        if( val.indexOf('padding-right-') != -1 ){
                            paddingright = val.replace('padding-right-', '');
                        }
                    });
                }

                var nchild = bigmenu.find('.submenu > ul.sub-menu').children('li.menu-item-has-children').length;

                if ( Math.ceil(nchild / maxcol) > 1 ) {
                    col = 3;
                } else {
                    col = nchild;
                }

                var cal_width = col_width * col + col*10 +10;

                if ( custom_image.length > 0 ) {

                    var image_item = custom_image.find('img').attr('src'),
                        height     = custom_image.find('img').attr('height'),
                        width      = custom_image.find('img').attr('width');

                    if( cal_width < width ) cal_width = width;

                    /* added by Andrea Frascaspata rtl fix */
                    var background_position = ( yit.isRtl ) ? "left bottom" : "right bottom";
                    //------------------------------------------------

                    custom_image.next('.submenu').css({
                        'min-height'         : height + 'px',
                        'background-image'   : 'url(' + image_item + ')',
                        'background-repeat'  : 'no-repeat',
                        'background-position': background_position,
                        'padding-right'      : paddingright + 'px',
                        'padding-bottom'     : paddingbottom + 'px',
                        'width'              : cal_width + 'px'
                    });

                    custom_image.remove();
                }
                else if ( nchild > 0 ) {
                    bigmenu.children('.submenu').css({
                        'min-height'    : '150px',
                        'height'        : 'auto',
                        'padding-right' : paddingright + 'px',
                        'padding-bottom': paddingbottom + 'px',
                        'width'         : cal_width + 'px'
                    });
                }
            });

            var fixBigMenuPosition = function() {

                $nav.find('li.bigmenu').each(function () {

                    var bigmenu = $(this),
                        bm_pos = bigmenu.offset(),

                        navleft = $nav.position(),
                        bm_left = bm_pos.left + navleft.left,
                        submenu = bigmenu.children('.submenu'),
                        container = bigmenu.closest('.container'),

                        ww = $(window).width(),
                        wc_gap = ( ww - container.width() ) / 2,
                        submenuOffset = bm_left + submenu.width() - wc_gap;

                    if ( submenuOffset > ww ) {
                        submenu.css('margin-left', ww - submenuOffset );
                    }

                });

            };

            _onresize( fixBigMenuPosition );
            fixBigMenuPosition();
        }

        /*************************
         * PARALLAX
         *************************/

        var parallax_items = $('.parallaxeos, .video-parallaxeos');

        if ( parallax_items.length ) {

            if ( YIT_Browser.isMobile() ) {
                parallax_items.css({ backgroundPosition: '' }).translate3d({ y: 0 });
                $('.parallaxeos_outer').find('.parallaxeos_content').css({ opacity: '' }).translate3d({ y: 0 });
                return;
            }

            var parallax = function() {
                parallax_items.each(function(){

                    var speed = 5,
                        $this = $(this),
                        is_video = $this.hasClass('video-parallaxeos') ? true : false,
                        $container = $this.closest('.parallaxeos_outer'),
                        $content = $container.find('.parallaxeos_content'),
                        headerHeight = $body.hasClass('sticky-header') ? $header.height() + $header.position().top : 0,
                        winScroll = $(window).scrollTop() + headerHeight,
                        elScrollViewport = $container.offset().top - winScroll,
                        yPos = -( elScrollViewport + ( winScroll - $container.offset().top ) / speed );

                    if ( ! is_video ) {
                        $this.css({ backgroundPosition: '50% ' + yPos + 'px', height: $(window).height() });
                    } else {
                        $this.translate3d({ y: yPos });
                    }

                    // center the text
                    if ( ! $this.closest('#primary').length ) {
                        var ratio = elScrollViewport > 0 ? 0 : Math.abs( elScrollViewport / $this.height() );

                        $this.css({ height: '' });

                        $content.translate3d({
                            y: elScrollViewport > 0 ? 0 : yPos
                        }).css({
                            opacity: 1 - ratio
                        });
                    }

                });
            };

            $(window).on( 'scroll', parallax );
            _onresize( parallax );
            parallax();

        }

        /*************************
         * MASONRY
         *************************/

        var add_masonry = function(){

            if ( $.fn.imagesLoaded && $.fn.masonry ) {
                $('.masonry').each( function(){
                    var container = $(this),
                        item = container.data('item');

                    if( item === 'undefined' ){
                        item = '.masonry_item';
                    }

                    container.imagesLoaded( function(){
                        container.masonry({
                            itemSelector: item,
                            isAnimated: true,
                            isRTL: yit.isRtl
                        });
                    });
                });
            }

        };

        $(window).on( 'load resize', add_masonry );

        $(document).on( 'load resize yith_infs_adding_elem', function(){
            if ( $.fn.imagesLoaded && $.fn.masonry ) {
                var $container = $( ' ul.products.masonry' );
                $container.imagesLoaded( function(){
                    $container.masonry('reloadItems');
                });
            }
        });

        /*************************
         * WIDGETS
         *************************/

        $('.yit_toggle_menu ul.menu').each(function(){
            var menu = $(this);

            menu.filter('.open_first').find("> li:first-child").addClass("opened");
            menu.filter('.open_all').find("> li").addClass("opened");

            menu.filter('.open_active').find('li').filter('.current-menu-ancestor').addClass("opened");
            menu.filter('.open_active').find('li').filter('.current-menu-parent').addClass("opened");
            menu.filter('.open_active').find('li.current-menu-item').addClass("opened");

            menu.find('> li > ul').hide();
            menu.find('> li.opened > ul').show();

            menu.on( 'click', '> li > a', function (e) {
                e.preventDefault();

                var submenu = $(this).next("ul"),
                    li = submenu.parent("li");

                li.hasClass("opened") ? li.removeClass("opened") : li.addClass("opened");

                submenu.slideToggle('slow');
            });
        });

        if ( $.fn.owlCarousel ) {

            $( '.slides-reviews-widget').each( function(){
                var slider = $(this);

                slider.owlCarousel({
                    singleItem     : true,
                    nav     : true,
                    slideSpeed     : slider.data('slidespeed'),
                    navigationText : ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
                    autoplay       : slider.data('autoplay') ,
                    rtl: yit.isRtl == true

                });
            });

            if ( $.fn.imagesLoaded ) {

                $('.logos-slides').imagesLoaded( function(){
                    var t       = $('.logos-slides'),
                        speed   = t.data( 'speed'),
                        elementsNum  = t.find('li').size(),
                        itemsNum = 5,
                        shownav = ( elementsNum <= itemsNum ) ? false : true,
                        owl     = t.owlCarousel({
                            items: itemsNum,
                            responsiveClass:true,
                            responsive:{
                                0 : {
                                    items: 1
                                },
                                479 : {
                                    items: 3
                                },
                                767 : {
                                    items: 4
                                },
                                992 : {
                                    items: itemsNum
                                }
                            },
                            autoplay: true,
                            paginationSpeed: speed,
                            autoplayTimeout: 4000,
                            autoplayHoverPause: true,
                            loop : true ,
                            rtl: yit.isRtl == true
                        });

                    // Custom Navigation Events
                    if( shownav ){
                        t.closest('.logos-slider').on('click', '.next', function(e){

                            e.preventDefault();
                            owl.trigger('next.owl.carousel');
                        });

                        t.closest('.logos-slider').on('click', '.prev', function(e){
                            e.preventDefault();
                            owl.trigger('prev.owl.carousel');
                        });
                    }else{
                        t.closest('.logos-slider').find('.nav').css('display','none');
                    }

                });
            }

        }

        /*************************
         * PORTFOLIO QUICK VIEW
         *************************/
        if ($.fn.yit_quick_view ) {
            $('div.portfolio-filterable li.quick-view a.trigger-item.quick-view').yit_quick_view({
                item_container: 'li',
                loader: 'div.portfolio_small_image div.portfolio.single',

                before: function( trigger, item ) {

                    if( typeof yit.load_gif != 'undefined' ) {
                        trigger.closest('li').block({message: null, overlayCSS: {background: '#fff url(' + yit.load_gif +  ') no-repeat center', opacity: 0.3, cursor: 'none'}});
                    }
                    else {
                        trigger.closest('li').block({message: null, overlayCSS: {background: '#fff url(' + woocommerce_params.ajax_loader_url.substring(0, woocommerce_params.ajax_loader_url.length - 7) + '.gif) no-repeat center', opacity: 0.3, cursor: 'none'}});
                    }
                    // add loading in the button

                },

                completed: function( trigger, item, html, overlay ) {

                    var data = $('<div>' + html + '</div>'),
                        title = data.find('h2.portfolio-title a').html(),
                        container = document.getElementById( 'wrapper' ),
                        wrapper = $(overlay).find('.main .container'),
                        content = wrapper.find('.portfolio_content');

                    // head
                    $('<h4 />').html(title).prependTo( wrapper.find('.head') );
                    $(overlay).addClass('portfolio_small_image');
                },

                openDialog: function( trigger, item ) {
                    trigger.closest('li').unblock();
                },

                action: 'yit_load_portfolio_quick_view'
            });
        }
    });

    /*************************
     * Smooth Scroll
     *************************/

    $.yit_smoothScroll = function() {
        if ( $.srSmoothscroll && navigator.userAgent.indexOf('Mac') == -1 && $.browser.webkit ) {

            $.srSmoothscroll({
                step  : 160,
                speed : 380,
                ease  : "easeOutCirc"
            });

        }
    }
    $.yit_smoothScroll();

    /*************************
     * WPML LANG MENU FIX
     *************************/

    $.yit_wpml_lang_fix = function(){
        var switcher = $('#lang_sel_click');

        if ( typeof switcher !== 'undefined' ) {
            switcher.attr( 'id', 'lang_sel' );

            switcher.find( 'ul li > a.lang_sel_sel' ).click( function() {
                $('ul', this).css({
                    'display' : block
                });
            } );
        }
    }

    $.yit_wpml_lang_fix();
    /*************************
     * QUICK VIEW PLUGIN
     *************************/

    if ( typeof Modernizr != 'undefined' && $('.quick-view-overlay').length ) {
        $.fn.yit_quick_view = function(options) {

            $(this).each(function(){
                var trigger = $(this),
                    $window = $(window),

                    settings = $.extend({
                        item_container: 'li',
                        completed: function() {},
                        before: function() {},
                        openDialog: function() {},
                        action: 'yit_load_quick_view',
                        loader: '.main-content',
                        assets: null,
                        loadPage: false
                    }, options ),

                    trigger_id = trigger.attr('id'),
                    item = trigger.closest( settings.item_container ),
                    container = document.getElementById( 'wrapper' ),
                    triggerBttn = document.getElementById( trigger_id ),
                    overlay = document.querySelector( 'div.quick-view-overlay' ),
                    closeBttn = overlay.querySelector( 'a.overlay-close'),
                    transEndEventNames = {
                        'WebkitTransition': 'webkitTransitionEnd',
                        'MozTransition': 'transitionend',
                        'OTransition': 'oTransitionEnd',
                        'msTransition': 'MSTransitionEnd',
                        'transition': 'transitionend'
                    },
                    transEndEventName = transEndEventNames[ Modernizr.prefixed( 'transition' ) ],
                    support = { transitions : Modernizr.csstransitions },

                    openQuickView = function(e) {
                        e.preventDefault();

                        var completed = function( data, html ) {

                            // load css assets
                            data.find('link').each(function(){
                                if ( $('#cache-dynamics-css').length ) {
                                    $(this).insertBefore( $('#cache-dynamics-css') );
                                } else {
                                    $(this).appendTo('head');
                                }
                            });

                            // load js scripts for the single product content
                            if ( settings.assets != null ) {
                                $.each(settings.assets, function (index, value) {
                                    $.ajax({
                                        type    : "GET",
                                        url     : value,
                                        dataType: "script"
                                    });
                                });
                            }


                            settings.completed( trigger, item, html, overlay );

                            // open effect
                            $(overlay).imagesLoaded(function () {
                                settings.openDialog( trigger, item );

                                classie.add(overlay, 'open');
                                classie.add(container, 'overlay-open');

                                // set scrollbar for the quick view
                                var wrapper_scroll = $window.scrollTop();
                                $('#wrapper').css({ height:$window.height(), overflow: 'hidden' }).scrollTop(wrapper_scroll).data('scrolltop', wrapper_scroll);
                                $(overlay).css('overflow-y', 'scroll');
                                $('body').off('mousewheel');
                            });

                            $(document).trigger('yit_quick_view_loaded');
                        };

                        if (!classie.has(overlay, 'close')) {
                            settings.before( trigger, item );

                            if ( settings.loadPage ) {
                                var href = trigger.attr('href');

                                $.get( href, { popup: true }, function(html){

                                    var data = $('<div>' + html + '</div>'),
                                        product_html = data.find( settings.loader ).wrap('<div/>').parent().html();

                                    // main content
                                    $(overlay).find('.main .container').find('.head').after(product_html);

                                    completed( data, html );

                                });
                            }
                            else {
                                $.post(yit.ajaxurl, { action: settings.action, item_id: trigger.data('item_id') }, function (html) {

                                    var data = $('<div>' + html + '</div>'),
                                        product_html = data.find( settings.loader ).wrap('<div/>').parent().html();

                                    // main content
                                    $(overlay).find('.main .container').find('.head').after(product_html);

                                    completed( data, html );

                                });
                            }
                        }
                    },

                    closeQuickView = function (e) {
                        e.preventDefault();

                        if (classie.has(overlay, 'open')) {
                            classie.remove(overlay, 'open');
                            classie.remove(container, 'overlay-open');
                            classie.add(overlay, 'close');

                            // set scrollbar for the quick view
                            $('#wrapper').css({ height:'', overflow: '' });
                            $window.scrollTop( $('#wrapper').data('scrolltop') );
                            $(overlay).css('overflow-y', '');
                            $.yit_smoothScroll();

                            var onEndTransitionFn = function (ev) {
                                if (support.transitions) {
                                    if (ev.propertyName !== 'visibility') return;
                                    this.removeEventListener(transEndEventName, onEndTransitionFn);
                                }
                                classie.remove(overlay, 'close');
                            };
                            if (support.transitions) {
                                overlay.addEventListener(transEndEventName, onEndTransitionFn);
                            }
                            else {
                                onEndTransitionFn();
                            }

                            var close_button = $(overlay).find('.overlay-close');
                            /* ie fix */
                            var close_button_inner_text = close_button.html();

                            var wrapper = $(overlay).find('.main .container');

                            wrapper.find('.head').html('').append(close_button);
                            /* ie fix */
                            close_button.html(close_button_inner_text);

                            wrapper.find('.head').next().remove();

                        }
                    };

                if(triggerBttn!=null) {
                    triggerBttn.addEventListener( 'click', openQuickView );
                }

                closeBttn.addEventListener( 'click', closeQuickView );
            });
        };
    }


    /*************************
     * COMMENT VALIDATION
     *************************/

        // scroll body to 0px on click
    $('body').on( 'click', '#respond #submit', function (e) {

        var validate = true;
        var fields = $( this).parent().parent().find('input, textarea');

        fields.each(function( index ) {
           if( ( typeof $( this ).attr('required') != 'undefined' || (typeof $( this ).attr('aria-required') != 'undefined' && $( this ).attr('aria-required')=='true' ) ) && $( this ).val().length==0) {
               validate = false;
               $( this).focus();
               return false;
           }
        });

        if(!validate) return false;

    });


})( jQuery, window, document );