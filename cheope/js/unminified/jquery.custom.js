function isIE8() {
    return jQuery.browser.msie && jQuery.browser.version == '8.0';
}

function isIE10() {
    return jQuery.browser.msie && jQuery.browser.version == '10.0';
}

function isViewportBetween( high, low ) {
    if( low == 'undefinied' )
    { low = 0; }

    if( !low )
    { return jQuery( window ).width() < high; }
    else
    { return jQuery( window ).width() < high && jQuery( window ).width() > low; }
}

function isLowResMonitor() {
    return jQuery( window ).width() < 1200;
}

function isTablet() {
    var device = jQuery( 'body' ).hasClass( 'responsive' ) || jQuery( 'body' ).hasClass( 'iPad' ) || jQuery( 'body' ).hasClass( 'Blakberrytablet' ) || jQuery( 'body' ).hasClass( 'isAndroidtablet' ) || jQuery( 'body' ).hasClass( 'isPalm' );
    var size   = jQuery( window ).width() <= 1024 && jQuery( window ).width() >= 768;

    return device && size ;
}

function isPhone() {
    var device = jQuery( 'body' ).hasClass( 'responsive' ) || jQuery( 'body' ).hasClass( 'isIphone' ) || jQuery( 'body' ).hasClass( 'isWindowsphone' ) || jQuery( 'body' ).hasClass( 'isAndroid' ) || jQuery( 'body' ).hasClass( 'isBlackberry' );
    var size   = jQuery( window ).width() <= 480 && jQuery( window ).width() >= 320;

    return device && size ;
}

function isMobile() {
    return isTablet() || isPhone();
}

// In case we forget to take out console statements. IE becomes very unhappy when we forget. Let's not make IE unhappy
if(typeof(console) === 'undefined') {
    var console = {}
    console.log = console.error = console.info = console.debug = console.warn = console.trace = console.dir = console.dirxml = console.group = console.groupEnd = console.time = console.timeEnd = console.assert = console.profile = function() {};
}

(function($) {
    jQuery( document ).ready( function( $ ) {
        $('body').removeClass('no_js').addClass('yes_js');


        if ( isIE8() ) {
            $('*:last-child').addClass('last-child');
        }

        if( isIE10() ) {
            $( 'html' ).attr( 'id', 'ie10' ).addClass( 'ie' );
        }

        //placeholder support
        $('input[placeholder], textarea[placeholder]').placeholder();
        $('input[placeholder], textarea[placeholder]').each(function(){
            $(this).focus(function(){
                $(this).data('placeholder', $(this).attr('placeholder'));
                $(this).attr('placeholder', '');
            }).blur(function(){
                    $(this).attr('placeholder', $(this).data('placeholder'));
                });
        });

        //iPad, iPhone hack
        $('.ch-item').bind('hover', function(e){});

        //Form fields shadow
        $( 'form input[type="text"], form textarea' ).focus(function() {

            //Hide label
            $( this ).parent().find( 'label.hide-label' ).hide();
        });

        $( 'form input[type="text"], form textarea' ).blur(function() {
            //Show label
            if( $( this ).val() == '' )
            { $( this ).parent().find( 'label.hide-label' ).show(); }
        });

        $( 'form input[type="text"], form textarea' ).each( function() {
            //Show label

            if( $( this ).val() != '' && $( this ).parents( 'li' ).find( 'label.hide-label' ).is( ':visible' ) )
            { $( this ).parent().find( 'label.hide-label' ).hide(); }
        } );

        //Contact form labels
        $( '.contact-form [type="text"], .contact-form textarea' ).focus( function() {
            //Hide label
            $( this ).parents( 'li' ).find( 'label.hide-label' ).hide();
        } );

        $( '.contact-form [type="text"], .contact-form textarea' ).blur( function() {
            //Show label
            if( $( this ).val() == '' )
            { $( this ).parents( 'li' ).find( 'label.hide-label' ).show(); }
        } );



//    //Sticky Footer
//    if( $( '#footer' ).length )
//        { $( '#footer' ).stickyFooter(); }
//    else
//        { $( '#copyright' ).stickyFooter(); }

        //Map handler
        $( '#map-handler a' ).click( function() {
            $( '#map iframe' ).slideToggle( 400, function() {
                if( $( '#map iframe' ).is( ':visible' ) ) {
                    $( '#map-handler a' ).text( l10n_handler.map_close );
                } else {
                    $( '#map-handler a' ).text( l10n_handler.map_open );
                }
            });
        } );

        //social icon
        $('div.fade-socials a, div.fade-socials-small a').hide();
        $('div.fade-socials, div.fade-socials-small').hover(function(){
                $(this).children('a').fadeIn('slow');
            },
            function(){
                $(this).children('a').fadeOut('slow');
            });

        var show_dropdown = function()
        {
            var options;

            containerWidth = $('#header').width();
            marginRight = $('#nav ul.level-1 > li').css('margin-right');
            submenuWidth = $(this).find('ul.sub-menu').outerWidth();
            offsetMenuRight = $(this).position().left + submenuWidth;
            leftPos = -18;

            if ( offsetMenuRight > containerWidth )
                options = { left:leftPos - ( offsetMenuRight - containerWidth ) };
            else
                options = {};

            $('ul.sub-menu:not(ul.sub-menu li > ul.sub-menu), ul.children:not(ul.children li > ul.children)', this).css(options).stop(true, true).fadeIn(300);
        }

        var hide_dropdown = function()
        {
            $('ul.sub-menu:not(ul.sub-menu li > ul.sub-menu), ul.children:not(ul.children li > ul.children)', this).fadeOut(300);
        }

        $('#nav ul > li').hover( show_dropdown, hide_dropdown );

        $('#nav ul > li').each(function(){
            if( $('ul', this).length > 0 )
                $(this).children('a').append('<span class="sf-sub-indicator"> &raquo;</span>').css({ paddingRight:parseInt($(this).children('a').css('padding-right'))+16 });
        });

        $('#nav li:not(.megamenu) ul.sub-menu li, #nav li:not(.megamenu) ul.children li').hover(
            function()
            {
                if ( $(this).closest('.megamenu').length > 0 )
                    return;

                var options;

                containerWidth = $('#header').width();
                containerOffsetRight = $('#header').offset().left + containerWidth;
                submenuWidth = $('ul.sub-menu, ul.children', this).parent().width();
                offsetMenuRight = $(this).offset().left + submenuWidth * 2;
                leftPos = -10;

                if ( offsetMenuRight > containerOffsetRight )
                    $(this).addClass('left');

                $('> ul.sub-menu, > ul.children', this).stop(true, true).fadeIn(300);
            },

            function()
            {
                if ( $(this).closest('.megamenu').length > 0 )
                    return;

                $('ul.sub-menu, ul.children', this).fadeOut(300);
            }
        );

        /* megamenu check position */
        $('#nav .megamenu').mouseover(function(){

            var main_container_width = $('.container').width();
            var main_container_offset = $('.container').offset();
            var parent = $(this);
            var megamenu = $(this).children('ul.sub-menu');
            var width_megamenu = megamenu.outerWidth();
            var position_megamenu = megamenu.offset();
            var position_parent = parent.position();

            var position_right_megamenu = position_parent.left + width_megamenu;

            // adjust if the right position of megamenu is out of container
            if ( position_right_megamenu > main_container_width ) {
                megamenu.offset( { top:position_megamenu.top, left:main_container_offset.left + ( main_container_width - width_megamenu ) } );
            }
        });

        if ( $('body').hasClass('isMobile') && ! $('body').hasClass('iphone') && ! $('body').hasClass('ipad') ) {
            $('.sf-sub-indicator').parent().click(function(){
                $(this).parent().toggle( show_dropdown, function(){ document.location = $(this).children('a').attr('href') } )
            });
        }

        // remove margin from the slider, if the page is empty
        if ( $('.slider').length != 0 && $.trim( $('#primary *, #page-meta').text() ) == '' ) {
            $('.slider').attr('style', 'margin-bottom:0 !important;');
            $('#primary').remove();
        }

        //play, zoom on image hover
        var yit_lightbox;
        (yit_lightbox = function(){
            jQuery('a.thumb.video, a.thumb.img, img.thumb.img, img.thumb.project, .work-thumbnail a, .three-columns li a, .onlytitle, .overlay_a img, .nozoom img').hover(
                function()
                {
                    jQuery(this).next('.overlay').fadeIn(500);
                    jQuery(this).next('.overlay').children('.lightbox, .details, .lightbox-video').animate({
                        bottom:'40%'
                    }, 300);

                    jQuery(this).next('.overlay').children('.title').animate({
                        top:'30%'
                    }, 300);
                }
            );

            // image lightbox
            $('a.thumb.video, a.thumb.img, a.thumb.videos, a.thumb.imgs, a.related_detail, a.related_proj, a.related_video, a.related_title, a.project, a.onlytitle').hover(function(){
                    $('<a class="zoom"></a>').appendTo(this).css({
                        dispay:'block',
                        opacity:0,
                        height:$(this).children('img').height(),
                        width:$(this).children('img').width(),
                        'top': $(this).parents('.portfolio-filterable').length ? '-1px' : $(this).css('padding-top'),
                        'left':$(this).parents('.portfolio-filterable').length ? '-1px' : $(this).css('padding-left'),
                        padding:0}).append('<span class="title">' + $(this).attr('title') + '</span>')
                        .append('<span class="subtitle">' + $(this).attr('data-subtitle') + '</span>').animate({opacity:0.7}, 500);
                },
                function(){
                    $('.zoom').fadeOut(500, function(){$(this).remove()});
                }
            );

            $('.zoom').live('click', function(){
                if( $.browser.msie ) {
                    $(this).attr('href', $(this).parent().attr('href'));
                }
            });

            if ( $.colorbox ) {
                if( jQuery( 'body' ).hasClass( 'isMobile' ) ) {
                    jQuery("a.thumb.img, .overlay_img, .section .related_proj, a.ch-info-lightbox").colorbox({
                        transition:'elastic',
                        rel:'lightbox',
                        fixed:true,
                        maxWidth: '100%',
                        maxHeight: '100%',
                        opacity : 0.7
                    });

                    jQuery(".section .related_lightbox").colorbox({
                        transition:'elastic',
                        rel:'lightbox2',
                        fixed:true,
                        maxWidth: '100%',
                        maxHeight: '100%',
                        opacity : 0.7
                    });
                } else {
                    jQuery("a.thumb.img, .overlay_img, .section.portfolio .related_proj, a.ch-info-lightbox, a.ch-info-lightbox").colorbox({
                        transition:'elastic',
                        rel:'lightbox',
                        fixed:true,
                        maxWidth: '80%',
                        maxHeight: '80%',
                        opacity : 0.7
                    });

                    jQuery(".section.portfolio .related_lightbox").colorbox({
                        transition:'elastic',
                        rel:'lightbox2',
                        fixed:true,
                        maxWidth: '80%',
                        maxHeight: '80%',
                        opacity : 0.7
                    });
                }

                jQuery("a.thumb.video, .overlay_video, .section.portfolio .related_video, a.ch-info-lightbox-video").colorbox({
                    transition:'elastic',
                    rel:'lightbox',
                    fixed:true,
                    maxWidth: '60%',
                    maxHeight: '80%',
                    innerWidth: '60%',
                    innerHeight: '80%',
                    opacity : 0.7,
                    iframe: true,
                    onOpen: function() { $( '#cBoxContent' ).css({ "-webkit-overflow-scrolling": "touch" }) }
                });
                jQuery(".section.portfolio .lightbox_related_video").colorbox({
                    transition:'elastic',
                    rel:'lightbox2',
                    fixed:true,
                    maxWidth: '60%',
                    maxHeight: '80%',
                    innerWidth: '60%',
                    innerHeight: '80%',
                    opacity : 0.7,
                    iframe: true,
                    onOpen: function() { $( '#cBoxContent' ).css({ "-webkit-overflow-scrolling": "touch" }) }
                });
            }
        })();


        //FILTERABLE
        if( $('.portfolio-filterable').length > 0 ) {
            $('.gallery-categories-disabled, .portfolio-categories-disabled').addClass('gallery-categories-quicksand');
        }


        $(".gallery-wrap .internal_page_item .overlay, .section .related_project .overlay").css({opacity:0});
        $(".gallery-wrap .internal_page_item, .section .related_project > div").live( 'mouseover mouseout', function(event){
            if ( event.type == 'mouseover' ) $('.overlay', this).show().stop(true,false).animate({ opacity: .7 }, "fast");
            if ( event.type == 'mouseout' )  $('.overlay', this).animate({ opacity: 0 }, "fast", function(){ $(this).hide() });
        });

        $('.picture_overlay').hover(function(){

            var width = $(this).find('.overlay div').innerWidth();
            var height =  $(this).find('.overlay div').innerHeight();
            var div = $(this).find('.overlay div').css({
                'margin-top' : - height / 2,
                'margin-left' : - width / 2
            });

            if(isIE8()) {
                $(this).find('.overlay > div').show();
            }
        }, function(){

            if(isIE8()) {
                $(this).find('.overlay > div').hide();
            }
        }).each(function(){
                var width = $(this).find('.overlay div').innerWidth();
                var height =  $(this).find('.overlay div').innerHeight();
                var div = $(this).find('.overlay div').css({
                    'margin-top' : - height / 2,
                    'margin-left' : - width / 2
                });
            });


        //masonry pinterest blog style
        if ( $.fn.masonry ) {
            var container = $('#pinterest-container');
            container.imagesLoaded( function(){
                container.masonry({
                    itemSelector: '.post'
                });
            });

            $(window).resize(function(){
                $('#pinterest-container').masonry({
                    itemSelector: '.post'
                });
            });

            $(document).on( 'load resize yith_infs_adding_elem', function(){
                if ( $.fn.imagesLoaded && $.fn.masonry ) {
                    var $container = $( '#pinterest-container' );
                    $container.imagesLoaded( function(){
                        $container.masonry('reloadItems');
                    });
                }
            });

            var page_meta_height = $( '#page-meta').outerHeight();
            $( '#pinterest-container .post').each( function( i ) {
                if( i > 2 ) { return; }

                $( this ).css( 'margin-top', page_meta_height + 20 + 'px' ); //20px margin
                i++;
            });
        }

        $( '.yit_toggle_menu ul.menu.open_first > li:first-child, .yit_toggle_menu ul.menu.open_all .dropdown, .yit_toggle_menu ul.menu.open_active > li.current-menu-parent' ).addClass( 'opened' );

        //toggle menu widget
        $( '.yit_toggle_menu ul li.dropdown > a' ).click( function( e ) {
            e.preventDefault();
            var dropdown = $( this ).next( 'ul' );
            var dropdown_parent = dropdown.parent( '.dropdown' );

            dropdown.width( dropdown_parent.width() );
            dropdown_parent.width( dropdown_parent.parent().width() );

            if( dropdown_parent.hasClass( 'opened' ) )
            { dropdown_parent.removeClass( 'opened' ); }
            else
            { dropdown_parent.addClass( 'opened' ); }

            dropdown.slideToggle();
        });

        // shop hover in grid
        $('ul.products li.product.classic a.thumb').on({
            mouseenter: function() { $(this).find('img').animate( {opacity:0.75}, 500 ); },
            mouseleave: function() { $(this).find('img').stop().animate( {opacity:1}, 500 ); }
        });
        $( document ).on( 'hover', 'ul.products li.product.grid:not(.classic), ul.products li.product.list .thumbnail-wrapper', function(e) {
            if(e.type == 'mouseenter') {
                var $this_product = $(this);
                if ( $this_product.hasClass('thumbnail-wrapper') ) $this_product = $this_product.parents('li');

                var this_width  = $this_product.find('.thumbnail-wrapper').width();
                var this_height = $this_product.find('.thumbnail-wrapper').height();
                var title_height = $this_product.find('.product-meta').height();
                var this_padding_w = parseInt( $this_product.find('.product-thumbnail').css("padding-left").replace("px", "") ) * 2;
                var this_padding_h = parseInt( $this_product.find('.product-thumbnail').css("padding-top").replace("px", "") ) * 2;

                $this_product.removeClass('no-transition');
                $this_product.find('img').css( 'box-shadow', '#000 0em 0em 0em' ).animate( {opacity:0.48}, 500 ); // box-shadow fix bug in firefox with the opacity in image scaled, that moved
                $this_product.filter('.grid').find('.thumbnail-wrapper div.product-actions').fadeIn(500);
                $this_product.filter('.grid').not('.added').find('div.product-meta').fadeIn(500);

                //$('li').width(this_width).height(this_height).addClass('product temp').insertBefore( $this_product );
                //$this_product.css({ 'position':'absolute', left:post_left, top:post_top });
                $this_product.filter('.grid').css({ width:this_width + this_padding_w + 2, height:this_height + this_padding_h + 1, 'overflow':'visible' });
                $this_product.find('.thumbnail-wrapper .product-actions').css({ height:this_height });
                $this_product.filter('.grid').not('.added').find('.product-thumbnail').css({ 'position':'absolute', width:this_width, height:this_height + title_height, 'z-index':'15' });
                $this_product.filter('.grid').find('.onsale').css({ right:-1, top:-1 });
            } else if(e.type =='mouseleave') {
                var $this_product = $(this);
                if ( $this_product.hasClass('thumbnail-wrapper') ) $this_product = $this_product.parents('li');

                var this_padding_h = parseInt( $this_product.find('.product-thumbnail').css("padding-top").replace("px", "") ) * 2;

                $this_product.find('img').stop().animate( {opacity:1}, 500 );
                $this_product.find('.thumbnail-wrapper div.product-actions').stop().fadeOut(500);
                $this_product.filter('.grid').not('.added').find('div.product-meta').stop().fadeOut(500);
                $this_product.filter('.grid').not('.added').find('.product-thumbnail').css({ height:$this_product.find('.thumbnail-wrapper').height(), 'z-index':'1' });
            }
        });

        $(window).resize(function(){
            $('ul.products li.product.grid:not(.classic), ul.products li.product.list .thumbnail-wrapper').each(function(){
                var $this_product = $(this);
                if ( $this_product.hasClass('thumbnail-wrapper') ) $this_product = $this_product.parents('li');

                $this_product.addClass('no-transition').css({ height:'auto', width:'' });
                $this_product.find('.product-thumbnail').css({ height:'auto', width:'auto', position:'static' });
            });
        });

        var $add_to_cart_clicked = false;

        // add to cart click
        $('ul.products li.product:not(.classic) .add_to_cart_button').live( 'click', function(){
            var $this_product = $(this).parents('li.product');
            var this_padding_h = parseInt( $this_product.find('.product-thumbnail').css("padding-top").replace("px", "") ) * 2;

            //$this_product.filter('.grid').find('.product-thumbnail').block({message: null, overlayCSS: {background: '#fff url(' + woocommerce_params.plugin_url + '/assets/images/ajax-loader.gif) no-repeat center', opacity: 0.3, cursor:'none'}});
            $add_to_cart_clicked = $(this);

            $this_product.filter('.grid').find('div.product-meta').stop().fadeOut(500);
            $this_product.filter('.grid').find('.product-thumbnail').css({ height:$this_product.height() - this_padding_h - 2, 'z-index':'1' });
        });
        $('ul.products li.product.classic .add_to_cart_button').live( 'click', function(){
            $add_to_cart_clicked = $(this);
        });
        $('body').on( 'added_to_cart', function(){
            //$('html, body').delay(500).animate({scrollTop:0}, 'slow');

            if ( $add_to_cart_clicked != false ) {
                var $this_product = $add_to_cart_clicked.parents('li.product');

                if ( ! $this_product.hasClass('classic') ) {
                    var $product_meta = $this_product.filter('.grid').find('.product-meta');
                    var this_padding_w = parseInt( $this_product.find('.product-thumbnail').css("padding-left").replace("px", "") ) * 2;
                    var this_padding_h = parseInt( $this_product.find('.product-thumbnail').css("padding-top").replace("px", "") ) * 2;

                    $this_product.find('.product-thumbnail').unblock();

                    $product_meta.find('.added').show().css('display', 'inline-block');
                    $product_meta.find('h3, .price').hide();

                    var this_width  = $this_product.find('.thumbnail-wrapper').width();
                    var this_height = $this_product.find('.thumbnail-wrapper').height();
                    var title_height = $product_meta.height() - 2;

                    //$product_meta.fadeIn(500).css('text-align', 'right');
                    $this_product.find('.product-actions .add_to_cart_button').removeClass('added');
                    $this_product.addClass('added').filter('.grid').css({ width:this_width + this_padding_w + 2, height:this_height + this_padding_h + 2, 'overflow':'visible' });
                    $this_product.find('.product-actions').css({ height:this_height });
                    $this_product.filter('.grid').find('.product-thumbnail').css({ 'position':'absolute', width:this_width, height:this_height + title_height + 2, 'z-index':'15' });
                    $this_product.filter('.grid').find('.onsale').css({ right:-1, top:-1 });
                    $this_product.find('.added').fadeIn(500);

                } else {
                    // for classic layout
                    $this_product = $add_to_cart_clicked.parents('li.product.classic');
                    $this_product.find('.added').fadeIn(500);
                }
            }
        } );

        // shop style switcher
        $('.list-or-grid a').on( 'click', function(){
            var actual_view = $(this).attr('class').replace( '-view', '' );

            if( isIE8() ) {
                actual_view = actual_view.replace( ' last-child', '' );
            }

            $('#content-shop ul.products li:not(.category)').removeClass('list grid').addClass( actual_view );
            $(this).parent().find('a').removeClass('active');
            $(this).addClass('active');

            switch ( actual_view ) {
                case 'list' :
                    $('#content-shop ul.products li').css({ width:'auto', height:'auto' });
                    $('#content-shop ul.products li .product-thumbnail').css({ width:'auto', height:'auto', position:'static' });
                    $('#content-shop ul.products li .product-thumbnail .onsale').css({ right:0, top:0 });
                    $('#content-shop ul.products li .product-meta').css({ display:'block' });
                    $('#content-shop ul.products li.added').find('h3, .price').css({ display:'block' });
                    break;

                case 'grid' :
                    $('ul.products li').css({ width:'', height:'' });
                    $('ul.products li:not(.classic) .product-meta').css({ display:'none' });
                    $('ul.products li.added:not(.classic)').find('h3, .price').css({ display:'none' });
                    break;
            }

            $.cookie(yit_shop_view_cookie, actual_view);

            return false;
        });

        //product slider
        $(window).load(function(){
            if( $.elastislide ) {
                $('.products-slider-wrapper:visible').elastislide( elastislide_defaults );
            }
        });

        $(document).on('feature_tab_opened', function(){
            if( $.elastislide ) {
                $('.products-slider-wrapper:visible').elastislide( elastislide_defaults );
            }
        });

        // replace type="number" in opera
        $('.opera .quantity input.input-text.qty').replaceWith(function() {
            $(this).attr('value')
            return '<input type="text" class="input-text qty text" name="quantity" value="' + $(this).attr('value') + '" />';
        });

        // hide #back-top first
        $("#back-top").hide();

        // fade in #back-top
        $(function () {
            $(window).scroll(function () {
                if ($(this).scrollTop() > 100) {
                    $('#back-top').fadeIn();
                } else {
                    $('#back-top').fadeOut();
                }
            });

            // scroll body to 0px on click
            $('#back-top a').click(function () {
                $('body,html').animate({
                    scrollTop: 0
                }, 800);
                return false;
            });
        });



        // compare button click
        var product_compare, open_window = false;
        $('.product .woo_bt_compare_this').on( 'click', function(){
            open_window = true;
            product_compare = $(this).parents('.product');
            if (yit_woocommerce.load_gif != 'undefined') {
                product_compare.block({message: null, overlayCSS: {background: '#fff url(' + yit_woocommerce.load_gif + ') no-repeat center', opacity: 0.6, cursor: 'none'}});
            }
            else {
                product_compare.block({message: null, overlayCSS: {background: '#fff url(' + woocommerce_params.plugin_url + '/assets/images/ajax-loader.gif) no-repeat center', opacity: 0.6, cursor:'none'}});
            }
        });


        $('body').on( 'woo_update_total_compare_list', function(){
            product_compare.unblock();

            var compare_url = $('a.woo_bt_view_compare_link').attr('href');
            window.open(compare_url, "'.__('Product_Comparison', 'woo_cp').'", "scrollbars=1, width=980, height=650");
        });

        //emulate jquery live to preserve jQuery.live() call
        if( typeof jQuery.fn.live == 'undefined' ) {
            jQuery.fn.live = function( types, data, fn ) {
                jQuery( this.context ).on( types, this.selector, data, fn );
                return this;
            };
        }
    });

})(jQuery);

// sticky footer plugin
(function($){
    var footer;

    $.fn.extend({
        stickyFooter: function(options) {
            footer = this;

            positionFooter();

            $(window)
                .scroll(positionFooter)
                .resize(positionFooter);

            function positionFooter() {
                var docHeight = $(document.body).height() - $("#sticky-footer-push").height();
                if(docHeight < $(window).height()){
                    var diff = $(window).height() - docHeight;
                    if (!$("#sticky-footer-push").length > 0) {
                        $(footer).before('<div id="sticky-footer-push"></div>');
                    }
                    $("#sticky-footer-push").height(diff);
                }
            }
        }
    });
})(jQuery);



(function($){
    $("#header-sidebar li.dropdown").hover(
        function(){ $('ul',this).fadeIn(); },
        function(){ $('ul',this).fadeOut(); }
    );
})(jQuery);

jQuery(document).ready(function($){
    $('#form-login').submit(function(e){

        var a = $('#reg_password').val();
        var b = $('#reg_password_retype').val();

        if(!(a==b)){
            $('#reg_password_retype').addClass('invalid');
            return false;
        }else{
            $('#reg_password_retype').removeClass('invalid');
            return true;
        }

    });

    if( $( 'body').hasClass( 'single-product' ) ) {

        setTimeout( function() {

            if( $.trim( $( '.usermessagea').html() ) != '' || $.trim( $( '.contact-form div.msg-error' ).text() ) != '' ) {

                $( '.woocommerce-tabs .tabs li' ).removeClass( 'active' );
                $( '.woocommerce-tabs .panel').css( 'display', 'none' );
                $( '.woocommerce-tabs .tabs li.info_tab' ).addClass( 'active' );
                $( '#tab-info').css( 'display', 'block' );
            }
        }, 200 );
    }


});