(function ($, window, document) {
    "use strict";

    var $window   = $(window),
        $body     = $(document.body),

        header    = document.getElementById('header'),
        nav       = document.getElementById('nav'),
        primary   = document.getElementById('primary'),
        footer    = document.getElementById('footer'),
        copyright = document.getElementById('copyright'),

        $header    = $( header ),
        $nav       = $( '.nav' ),
        $primary   = $( primary ),
        $footer    = $( footer ),
        $copyright = $( copyright );
    
    /*************************
     * Back to top
     *************************/

    $.yit_backToTop = function() {
        var $backToTop = $( document.getElementById("back-top") );

        if ( $backToTop.length ) {
            // hide #back-top first
            $backToTop.hide();

            // fade in #back-top
            $(window).on( 'scroll', function () {
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
    }

    /*************************
     * Big Menu
     *************************/

    $.fn.yit_bigmenu = function () {
        var $this = $(this);
        //add custom image as background
        $this.find('.bigmenu').each( function () {

            var bigmenu = $(this),

                custom_image  =  bigmenu.find('.custom-item-yitimage'),
                col_width = 190, //width of a column
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

            var cal_width = col_width * col + col*20 +10;

            if ( custom_image.length > 0 ) {

                var image_item = custom_image.find('img').attr('src'),
                    height     = custom_image.find('img').attr('height'),
                    width      = custom_image.find('img').attr('width');

                if( cal_width < width ) cal_width = width;

                /* added by Andrea Frascaspata rtl fix */
                var background_position = ( yit.isRtl ) ? "left bottom" : "right bottom";
                //------------------------------------------------

                custom_image.next('.submenu').children('ul.sub-menu').css({
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

                bigmenu.find('.sub-menu').css({
                    'min-height'    : '150px',
                    'height'        : 'auto',
                    'padding-right' : paddingright + 'px',
                    'padding-bottom': paddingbottom + 'px',
                    'width'         : cal_width + 'px'
                });
            }
        });

        var fixBigMenuPosition = function() {

            $this.find('li.bigmenu').each(function () {
                var bigmenu = $(this),
                    bm_pos = bigmenu.offset(),
                    navleft = $this.position(),
                    bm_left = bm_pos.left,

                    submenu = bigmenu.children('.submenu').find('ul.sub-menu').first(),
                    container = bigmenu.closest('.container'),

                    ww = $(window).width(),
                    wc_gap = ( ww - container.width() ) / 2,
                    submenuOffset = bm_left + submenu.outerWidth() + wc_gap - 20;



                if ( submenuOffset > ww ) {
                    submenu.css('left', ww - submenuOffset );
                }

            });

        };

        _onresize( fixBigMenuPosition );
        fixBigMenuPosition();
    }

    /*************************
     * Big Menu Custom
     *************************/

    $.fn.yit_bigmenu_custom = function () {
        var $this = $(this);
        //add custom image as background
        $this.find('.bigmenu').each( function () {

            var bigmenu = $(this),

                custom_image  =  bigmenu.find('.custom-item-yitimage'),
                col_width = 170, //width of a column
                maxcol = 3,      //max columns in a row
                col = 1,         //min num of column

            cal_width = col_width * col + col*10 + 10;

            if ( custom_image.length > 0 ) {

                var image_item = custom_image.find('img').attr('src'),
                    height     = custom_image.find('img').attr('height'),
                    width      = parseInt( custom_image.find('img').attr('width') ) ;

                width += 5;
                if( cal_width < width ) cal_width = width;

                /* added by Andrea Frascaspata rtl fix */
                var background_position = ( yit.isRtl ) ? "left bottom" : "right bottom";
                //------------------------------------------------

                custom_image.next('.submenu').css({
                    'height'         : height + 'px',
                    'background-image'   : 'url(' + image_item + ')',
                    'background-repeat'  : 'no-repeat',
                    'background-position': background_position,
                    'width'              : cal_width + 'px'
                });

                custom_image.remove();
            }
           /* else if ( nchild > 0 ) {
                bigmenu.children('.submenu').css({
                    'min-height'    : '150px',
                    'height'        : 'auto',
                    'padding-right' : paddingright + 'px',
                    'padding-bottom': paddingbottom + 'px',
                    'width'         : cal_width + 'px'
                });
            }*/
        });

        var fixBigMenuPosition = function() {

            $this.find('li.bigmenu').each(function () {

                var bigmenu = $(this),
                    bm_pos = bigmenu.offset(),
                    navleft = $this.position(),
                    bm_left = bm_pos.left + navleft.left,
                    submenu = bigmenu.find('.submenu > ul-sub-menu'),
                    container = bigmenu.closest('.container'),

                    ww = $(window).width(),
                    wc_gap = ( ww - container.width() ) / 2,
                    submenuOffset = bm_left + submenu.outerWidth() - wc_gap;


                if ( submenuOffset > ww ) {
                    submenu.css('margin-left', ww - submenuOffset );
                }

            });

        };

        _onresize( fixBigMenuPosition );
        fixBigMenuPosition();
    }

    /*************************
     * PostFormat Gallery
     *************************/

     $.fn.yit_gallery_post_format = function () {
        var gallery_sliders = new Array();

        $(this).each(function () {

            var t               = $(this),
                height          = t.data('height'),
                width           = t.data('width'),
                view            = t.data('view'),
                postID          = t.data('postid'),
                sliderContainer = 'galleryslider-' + postID;

            gallery_sliders[ postID ] = new MasterSlider();
            gallery_sliders[ postID ].control('arrows');

            gallery_sliders[ postID ].setup(sliderContainer, {
                width       : width,     // slider standard width
                height      : height,    // slider standard height
                view        : view,      //slider view
                heightLimit : false,
                swipe       : true,
                autoplay    : true,
                loop        : true
            });
        });
    }


    /*************************
     * Testimonial Slider Widget
     *************************/

    $.testimonial_slider_widget = function () {
        var sliders = $('.yes-js .widget.testimonial-widget').find('.slides'),
            windowsize = $(window).width();

        sliders.each(function () {
            var autoplay = false,
                nav = false,
                slider = $(this),
                id = slider.attr('id'),
                mslider = new MasterSlider();


            autoplay = slider.data('autoplay');
            if( autoplay == 'true' ){
                autoplay = slider.data('paginationspeed');
            }

            nav = slider.data('navigation');

            if( nav == true ){
                mslider.control('arrows' , {autohide:false});
            }

            mslider.setup(id, {
                layout    : 'fillwidth',
                //height    : 350,
                space     : 10,
                autoplay  : autoplay,
                hideLayers: true,
                autoHeight: true,
                smoothHeight: false,
                view      : "basic"
            });

        }).fadeIn('fast');
    }

    /*************************
     * Blog Share
     *************************/

    $.yit_blog_share = function () {
        var morph_button = document.querySelector( '.morph-button' );
        if( morph_button != null ) {
            var share_button = new UIMorphingButton( document.querySelector( '.morph-button' ) );
        }
    }

    /*************************
     * Fullwidth Section
     *************************/

    $.yit_fullwidth_section = function () {
        var $selectors = $('.section_fullwidth'),
            windowsize = $body.hasClass('boxed-layout') ? $('#wrapper').outerWidth() : $(window).width();

            $selectors.each(function(){
                var $selector = $(this),
                c = $selector.closest('.slider');

                if ( c.length == 0 ){
                    if(yit.isRtl)    {
                        $selector.css({
                            right: -( windowsize / 2 ),
                            width: windowsize
                        });
                    }
                    else{
                        $selector.css({
                            left: -( windowsize / 2 ),
                            width: windowsize
                        });
                    }
                }

            });
    }



    /*************************
     * PARALLAX
     *************************/


    $.fn.yit_parallax = function() {
        this.each(function() {

            var container = $(this),
                $window = $(window),
                $wrapper = $('#wrapper'),
                video = container.find('video'),
                in_slider = container.closest('.slider').length,
                vc = ( container.height() - container.find('.vertical_center').height() )/2,

                onLoadMetaData = function(e) {
                    resizeVideo(e.target);
                },

                resizeVideo = function(videoObject) {

                    var percentWidth = videoObject.clientWidth * 100 / videoObject.videoWidth;
                    var videoHeight = videoObject.videoHeight * percentWidth / 100;
                    video.height(videoHeight);
                };

            container.find('.vertical_center').css({top: vc+'px', marginBottom: 'auto'});

            video.on("loadedmetadata", onLoadMetaData);

            var parallaxvideofix = function(){
                if( in_slider == 0 ){
                    var windowsize = ! $('body').hasClass( 'boxed-layout' ) ? $window.width() : $wrapper.outerWidth();

                    $(".stretched-layout #primary .parallaxeos_outer, .header-parallax .parallaxeos_outer").css({
                        left: -( windowsize / 2 ),
                        width: windowsize
                    });

                    $(".slider .parallaxeos_outer").css({
                        left: "auto",
                        width: windowsize
                    });

                    // fix video size
                    resizeVideo(video);
                }

            };

            _onresize( parallaxvideofix );
            parallaxvideofix();
        });
    };


    $.fn.yit_parallax_onscroll = function() {
        var parallax_items = $(this);
        parallax_items.each(function(){

            var speed = 5,
                $this = $(this),
                is_video = $this.hasClass('video-parallaxeos') ? true : false,
                $container = $this.closest('.parallaxeos_outer'),
                $content = $container.find('.parallaxeos_content'),
                headerHeight = $header.hasClass('sticky-header') ? $header.height() + $header.position().top : 0,
                winScroll = $(window).scrollTop(),
                elScrollViewport = $container.offset().top - winScroll,
                yPos = -( elScrollViewport + ( winScroll - $container.offset().top ) / speed );

            if ( ! is_video ) {
                $this.css({ backgroundPosition: '50% ' + yPos + 'px' });
            } else {
                $this.translate3d({ y: yPos });
            }

            // center the text
            if ( ! $this.closest('#primary').length ) {
                var ratio = Math.abs( winScroll / ( $this.height() + headerHeight ) );

                $this.css({ height: '' });

                $content.translate3d({
                    y: winScroll * ratio
                }).css({
                    opacity: 1 - ratio
                });
            }

        });
    };

    /*********************
     * SHARE MODAL SHORTCODE
     **********************/

    $('.yit_share').on('click', function(e){
        e.preventDefault();

        var share = $(this).parents('.share-modal').find('.share-container');

        var template = '<div class="popupOverlay share"></div>' +
            '<div id="popupWrap" class="popupWrap share">' +
            '<div class="product-share">' +
            share.html() +
            '</div>' +
            '<i class="fa fa-times close-popup"></i>' +
            '</div>';

        $('body').append(template);

        $('#popupWrap').center() ;
        $('.popupOverlay').css( { display: 'block', opacity:0 } ).animate( { opacity:0.7 }, 500 );
        $('#popupWrap').css( { display: 'block', opacity:0 } ).animate( { opacity:1 }, 500 );

        /** Close popup function **/
        var close_popup = function() {
            $('.popupOverlay').animate( {opacity:0}, 200);
            $('.popupOverlay').remove();
            $('.popupWrap').animate( {opacity:0}, 200);
            $('.popupWrap').remove();
        }

        /**
         *	Close popup on:
         *	- 'X button' click
         *   - wrapper click
         *   - esc key pressed
         **/
        $('.close-popup, .popupOverlay').click(function(){
            close_popup();
        });

        $(document).bind('keydown', function(e) {
            if (e.which == 27) {
                if($('.popupOverlay')) {
                    close_popup();
                }
            }
        });

        /** Center popup on windows resize **/
        $(window).resize(function(){
            $('#popupWrap').center();
        });
    });


    /*************************
     * WAYPOINT
     *************************/

    $.fn.yit_waypoint = function() {
        var $this = $(this);

        if (typeof jQuery.fn.waypoint !== 'undefined') {
            $this.waypoint(function() {
                var delay = $this.data('delay'),
                    animation = $this.data('animate');

                if( typeof animation != 'undefined' && ! $this.hasClass('animated') ){
                    $this.removeClass(animation);
                }

                $this.delay(delay).queue(function(next){
                    if( typeof animation != 'undefined' ){
                        $this.addClass('animated '+ animation );
                    }else{
                        $this.addClass('animated');
                    }
                    $this.css('opacity','1');
                    next();
                });

            }, {offset: '98%'});
        }
    };

    /*************************
     * CENTER
     *************************/

    $.fn.center = function () {
        this.css("position","fixed");
        this.css("top", Math.max(0, (( jQuery( window ).height() - this.outerHeight() ) / 2 ) ) + "px" );
        this.css("left", Math.max(0, (( jQuery( window ).width() - this.outerWidth() ) / 2 ) ) + "px" );
        return this;
    };

    /*************************
     * YIT FAQ
     *************************/

    $.yit_faq = function( options, element ) {
        this.element = $( element );
        this._init( options );
    };

    $.yit_faq.defaults  = {
        elements : {
            items: $('.faq-wrapper'),
            header: '.faq-title',
            content: '.faq-item',
            filters: $('.filters li a, .faq-filters a')
        }
    };

    $.yit_faq.prototype = {
        _init : function( options ) {

            this.options = $.extend( true, {}, $.yit_faq.defaults, options );

            this._initSizes();
            this._initEvents();
        },

        _initSizes : function() {
            $(this.options.elements.content, this.element).each(function(){
                var parentWidth = $(this).parent().width();
                $(this).width(parentWidth);
            })
        },

        _initEvents : function() {
            var elements = this.options.elements;
            var self = this;

            //filters
            elements.filters.on('click.yit', function(e){
                e.preventDefault();

                if( !$(this).hasClass('active') ) {
                    elements.filters.removeClass('active').filter(this).addClass('active');

                    self._closeAll();
                    self._filterItems( $(this).data('option-value') );
                }
            });

            //single items
            elements.items.on('click.yit', elements.header, function(e){

                e.preventDefault();
                self._toggle( $(this) );
            });

            $(window).resize(function(e){
                self._initSizes();
            });

            self.element.resize(function(){
                $(window).trigger('sticky');
            });
        },

        _filterItems : function( selector ) {
            var self = this;
            var items = this.options.elements.items;

            items.filter(':visible').fadeOut('slow', function(){
                items.filter(selector).fadeIn({
                    'complete': function(){
                        $(window).trigger('sticky');
                    }
                });
            });
        },

        _toggle : function( selector ) {
            if( selector.next().is(':visible') ) {
                this._close( selector );
            } else {
                this._open( selector );
            }
        },

        _open : function( selector ) {
            this._closeAll();
            selector.toggleClass('active').find(':first-child').toggleClass('plus').toggleClass('minus');
            selector.siblings( this.options.elements.content ).slideDown({
                'complete': function(){
                    $(window).trigger('sticky');
                }
            });
        },

        _close : function( selector, animation ) {
            selector.toggleClass('active').find(':first-child').toggleClass('plus').toggleClass('minus');
            selector.siblings( this.options.elements.content ).slideUp({
                'complete': function(){
                    $(window).trigger('sticky');
                }
            });
        },

        _closeAll : function() {
            var headers = $( this.options.elements.header ).filter('.active');
            var self = this;

            headers.each(function(){
                self._close( $(this) );
            });
        }

    };

    $.fn.yit_faq = function( options ) {

        if ( typeof options === 'string' ) {
            var args = Array.prototype.slice.call( arguments, 1 );

            this.each(function() {
                var instance = $.data( this, 'yit_faq' );
                if ( !instance ) {
                    console.error( "cannot call methods on yit_checkout prior to initialization; " +
                        "attempted to call method '" + options + "'" );
                    return;
                }
                if ( !$.isFunction( instance[options] ) || options.charAt(0) === "_" ) {
                    console.error( "no such method '" + options + "' for yit_faq instance" );
                    return;
                }
                instance[ options ].apply( instance, args );
            });
        }
        else {
            this.each(function() {
                var instance = $.data( this, 'yit_faq' );
                if ( !instance ) {
                    $.data( this, 'yit_faq', new $.yit_faq( options, this ) );
                }
            });
        }
        return this;
    };

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

    /*************************
     * MOBILE MENU
     *************************/

    /**
     * sidebarEffects.js v1.0.0
     * http://www.codrops.com
     *
     * Licensed under the MIT license.
     * http://www.opensource.org/licenses/mit-license.php
     *
     * Copyright 2013, Codrops
     * http://www.codrops.com
     */
    var SidebarMenuEffects = (function() {

        function hasParentClass( e, classname ) {
            if(e === document) return false;
            if( classie.has( e, classname ) ) {
                return true;
            }
            return e.parentNode && hasParentClass( e.parentNode, classname );
        }

        function mobilecheck() {
            var check = false;
            (function(a){if(/(android|ipad|playbook|silk|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4)))check = true})(navigator.userAgent||navigator.vendor||window.opera);
            return check;
        }

        function initMarkup() {
            var $wrapper = $('#wrapper'),
                nav = $('.mobile-nav').length ? $('.mobile-nav').removeClass('hidden') : $('#nav').clone(true, true).attr('id', '').addClass('mobile-nav').removeClass('nav dropdown'),
                sidebar = $('.mobile-sidebar').length ? $('.mobile-sidebar').removeClass('hidden') : '',
                search = $('div.widget_search_mini').clone(true, true);

            search.find('#yith-s').attr('id', '').attr('placeholder', '');

            $wrapper.wrap('<div id="st-container" class="st-container" />');
            $wrapper.wrap('<div class="st-pusher" />');
            $wrapper.wrap('<div class="st-content" />');
            $wrapper.wrap('<div class="st-content-inner" />');

            $('#st-container').prepend('<nav class="st-menu st-effect-4" id="menu-1" />');

            // remove categories select from search
            search.find( 'select.search_categories, #sbHolder_' + search.find('select.search_categories').attr('sb')).remove();

            // change .nav class to .mobile-nav
            if ( sidebar ) sidebar.find('.nav').removeClass('nav').addClass('mobile-nav');

            $('nav.st-menu').append( search ).append( nav ).append( sidebar );
        }

        function init() {

            initMarkup();

            var container = document.getElementById( 'st-container' ),
                buttons = Array.prototype.slice.call( document.querySelectorAll( '#mobile-menu-trigger > a' ) ),
            // event type (if mobile use touch events)
                eventtype = 'click touchstart MSPointerDown',
                addListenerMulti = function(el, s, fn) {
                    var evts = s.split(' ');
                    for (var i=0, iLen=evts.length; i<iLen; i++) {
                        el.addEventListener(evts[i], fn, false);
                    }
                },
                resetMenu = function() {
                    classie.remove( container, 'st-menu-open' );
                },
                bodyClickFn = function(evt) {
                    if( !hasParentClass( evt.target, 'st-menu' ) ) {
                        resetMenu();
                        addListenerMulti( document, eventtype, bodyClickFn );
                        //document.removeEventListener( eventtype, bodyClickFn );
                    }
                };

            buttons.forEach( function( el, i ) {
                var effect = el.getAttribute( 'data-effect' );

                addListenerMulti( el, eventtype, function( ev ) {console.log(ev);
                    ev.stopPropagation();
                    ev.preventDefault();
                    container.className = 'st-container'; // clear
                    classie.add( container, effect );
                    setTimeout( function() {
                        classie.add( container, 'st-menu-open' );
                    }, 25 );
                    addListenerMulti( document, eventtype, bodyClickFn );
                    //document.addEventListener( eventtype, bodyClickFn );
                } );
            } );

        }

        init();

    })();

})( jQuery, window, document );