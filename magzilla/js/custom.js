var Magzilla_Theme = (function($) {
    "use strict";

    return {

        init: function() {

            this.sticky_nav();
            this.sticky_sidebar();
            this.visual_composer_stretch_row();
            this.mobile_nav();
            this.magzilla_widgets();
            this.magzilla_video();
            this.video_playlist();
            this.magzilla_loadmore();
            this.magzilla_infinite_scroll();
            this.header_search();
            this.magzillaPopup();
            this.magzilla_megamenu();
            this.magzilla_comments();
            this.magzilla_breadcrumb();
            this.magzilla_animation();

        }, //end init


        /*
        *  Sticky Nav
        * *************************************** */

        sticky_nav: function(){

            var nav = $('.mobile-menu, .magazilla-main-nav '),
                main_nav = $('.magazilla-main-nav'),
                container_w = $('.container').width(),
                sticky_inner = $('.sticky_inner'),
                win_width = $( window ).width(),
                nav_top = nav.offset().top,
                admin_nav = $('#wpadminbar').height() + 'px';

                if( container_w == null ) {
                    container_w = $('.container-fluid').width();
                }

            var sticky = function () {

                if (!nav.data('sticky')) {
                    return;
                }
                $(window).bind('resize', function () {
                    container_w = $('.container').width();
                    if( container_w == null ) {
                        container_w = $('.container-fluid').width();
                    }
                    win_width = $( window ).width();
                    admin_nav = $('#wpadminbar').height() + 'px';
                });

                var final_width = win_width - container_w;
                var margin_left = final_width / 2;
                    margin_left = margin_left + 1;

                // make it sticky when viewport is scrolled beyond the navigation
                if ($(window).scrollTop() > nav_top) {

                    if (!nav.hasClass('sticky-nav')) {
                        nav.addClass('sticky-nav');
                        $('body').addClass('magzilla-sticky-active');
                        main_nav.css({
                            'width': container_w
                        });
                        nav.css('top', admin_nav);
                        sticky_inner.css({
                            'width':win_width,
                            'margin-left': '-'+margin_left+'px',
                            'background': '#fff',
                            'margin-bottom': '-1px',
                            'border-bottom': '5px solid #E3E3E3'
                        });
                        $('.header-1 .sticky-nav .sticky_inner ul#main-nav, .header-2 .sticky-nav .sticky_inner ul#main-nav, .header-6 .sticky-nav .sticky_inner ul#main-nav').css({
                           'margin-left': margin_left-1+'px'
                        });
                        /*$('.header-1 .sticky-nav .sticky_inner .navbar-search, .header-2 .sticky-nav .sticky_inner .navbar-search, .header-6 .sticky-nav .sticky_inner .navbar-search').css({
                            'margin-right': margin_left+1+'px'
                        });*/
                    }

                } else {
                    nav.removeClass('sticky-nav');
                    $('body').removeClass('magzilla-sticky-active');
                    nav.removeAttr("style");
                    sticky_inner.removeAttr("style");
                    $('.header-1 .sticky_inner ul#main-nav, .header-1 .sticky_inner .navbar-search, .header-2 .sticky_inner ul#main-nav, .header-2 .sticky_inner .navbar-search, .header-6 .sticky_inner ul#main-nav, .header-6 .sticky_inner .navbar-search').removeAttr("style");
                }
            };

            sticky();

            $(window).scroll(function () {
                sticky();
            });

            $(window).bind('resize', function () {
                    if (!nav.data('sticky')) {
                        return;
                    }
                    if ($(window).scrollTop() > nav_top) {

                        var container_w = $('.container').width(),
                            win_width = $(window).width(),
                        //sticky_inner = $('.sticky_inner'),
                            admin_nav = $('#wpadminbar').height() + 'px';

                        if (container_w == null) {
                            container_w = $('.container-fluid').width();
                        }

                        var final_width = win_width - container_w;
                        var margin_left = final_width / 2;
                            margin_left = margin_left + 1;

                        sticky_inner.removeAttr("style");
                        $('.header-1 .sticky_inner ul#main-nav, .header-1 .sticky_inner .navbar-search, .header-2 .sticky_inner ul#main-nav, .header-2 .sticky_inner .navbar-search').removeAttr("style");

                        sticky_inner.css({
                            'width': win_width,
                            'margin-left': '-' + margin_left + 'px',
                            'background': '#fff',
                            'margin-bottom': '-1px',
                            'border-bottom': '5px solid #E3E3E3',
                        });
                        $('.header-1 .sticky-nav .sticky_inner ul#main-nav, .header-2 .sticky-nav .sticky_inner ul#main-nav, .header-6 .sticky-nav .sticky_inner ul#main-nav').css({
                            'margin-left': margin_left - 1 + 'px',
                        });
                        /*$('.header-1 .sticky-nav .sticky_inner .navbar-search, .header-2 .sticky-nav .sticky_inner .navbar-search, .header-6 .sticky-nav .sticky_inner .navbar-search').css({
                            'margin-right': margin_left + 1 + 'px',
                        });*/


                        $('.magazilla-main-nav').removeAttr("style");
                        $('.magazilla-main-nav.sticky-nav').width(container_w);
                        $('.magazilla-main-nav.sticky-nav, .mobile-menu.sticky-nav').css('top', admin_nav);
                    }

            });

        },

        /*
         *  Sticky Sidebar
         * *************************************** */

        sticky_sidebar: function() {

            $('.magzilla-main-wrap .magzilla_sticky').theiaStickySidebar({ additionalMarginTop:90, minWidth: 768, updateSidebarHeight: false });
        },

        /*
         *  Visual Composer Stretch row
         * *************************************** */

        visual_composer_stretch_row: function() {

            var $elements = $( '[data-vc-full-width="true"]' );
            $.each( $elements, function ( key, item ) {
                var $el = $( this );
                $el.addClass( 'vc_hidden' );

                var $el_full = $el.next( '.vc_row-full-width' );
                var el_margin_left = parseInt( $el.css( 'margin-left' ), 10 );
                var el_margin_right = parseInt( $el.css( 'margin-right' ), 10 );
                var offset = 0 - $el_full.offset().left - el_margin_left;
                var width = $( window ).width();
                $el.css( {
                    'position': 'relative',
                    'left': offset,
                    'right':offset,
                    'box-sizing': 'border-box',
                    'width': $( window ).width()
                } );
                if ( ! $el.data( 'vcStretchContent' ) ) {
                    var padding = (- 1 * offset);
                    if ( 0 > padding ) {
                        padding = 0;
                    }
                    var paddingRight = width - padding - $el_full.width() + el_margin_left + el_margin_right;
                    if ( 0 > paddingRight ) {
                        paddingRight = 0;
                    }
                    $el.css( { 'padding-left': padding + 'px', 'padding-right': paddingRight + 'px' } );
                }
                $el.attr( "data-vc-full-width-init", "true" );
                $el.removeClass( 'vc_hidden' );
            } );
        },

        /*
         *  Mobile Nav
         * *************************************** */

        mobile_nav: function() {
            $('ul.dropdown-menu [data-toggle=dropdown]').on('click', function(event) {
                event.preventDefault();
                event.stopPropagation();
                $(this).parent().siblings().removeClass('open');
                $(this).parent().toggleClass('open');
            });

            $('.mobile-menu-btn, .mobile-search-btn').click(function(){
                if(!$(".navbar-collapse").hasClass(".in")){
                    $(".mobile-menu-layer").toggleClass("visible");
                }
            });
        },

        /*
         *  Widgets
         * *************************************** */

        magzilla_widgets: function() {
            $( "h3.widget-title" ).wrap( '<div class="widget-top"></div>' );

            $('.widget_archive ul, .widget_categories > ul, .widget_nav_menu ul.menu, .widget_meta ul, .widget_recent_comments ul, .widget_recent_entries ul, .widget_text .textwidget, .widget_pages ul, .tagcloud, #calendar_wrap').wrap('<div class="widget-body"><div class="module-body"></div></div>');
            $('table#wp-calendar').addClass('table calendar');
            $('.widget_magazilla_latest_comments .latest-comment img').addClass('img-circle');
            $('.button.submit').addClass('btn btn-theme');
        },

        /*
         *  Fluid Width Video
         * *************************************** */

        magzilla_video: function() {
            if ( $().fitVids ){
                $('.magazilla_featured_video_wrapper').fitVids();
                $('.magazilla_video_wrapper').fitVids();
                $('.entry-content').fitVids();
            }
        },

        /*
         *  Video playlist
         * *************************************** */

        video_playlist: function() {
            var htmlUpdateSize = function (){
                $('.scroll-pane').jScrollPane();
            };
            $(document).ready(htmlUpdateSize);    // When the page first loads
            $(window).resize(htmlUpdateSize);     // When the browser changes size
        },

        /*
         *  Load More
         * *************************************** */

        magzilla_loadmore: function() {
            var fave_load_ajax_new_count = 0;

            $("body").on('click', '.fave-load-more a', function(e) {
                e.preventDefault();
                var $link = $(this);
                var page_url = $link.attr("href");
                $link.addClass('fave-loader');
                $("<div>").load(page_url, function() {
                    var n = fave_load_ajax_new_count.toString();
                    var $wrap = $link.closest('.main-box-for-load-more').find('.fave-loop-wrap');
                    var $new = $(this).find('.main-box-for-load-more .fave-post').addClass('fave-post-new-'+n);

                    $new.hide().appendTo($wrap).fadeIn(400);


                    if ($(this).find('.fave-load-more').length) {
                        $link.closest('.main-box-for-load-more').find('.fave-load-more').html($(this).find('.fave-load-more').html());
                    } else {
                        $link.closest('.main-box-for-load-more').find('.fave-load-more').fadeOut('fast').remove();
                    }

                    if (page_url != window.location) {
                        window.history.pushState({
                            path: page_url
                        }, '', page_url);
                    }

                    fave_load_ajax_new_count++;

                    return false;

                });

            });
        },


        /*
         *  Infinite scroll
         * *************************************** */

        magzilla_infinite_scroll: function() {

            if ($('.fave-infinite-scroll').length) {
                $(window).scroll(function() {
                    if ($(this).scrollTop() > ($('.fave-infinite-scroll').offset().top - 700)) {
                        var $link = $('.fave-infinite-scroll a');
                        var page_url = $link.attr("href");
                        $link.addClass('fave-loader');

                        if (page_url != undefined) {

                            $link.parent().animate({
                                opacity: 1,
                                height: 32
                            }, 300).css('padding', '20px');

                            $("<div>").load(page_url, function() {
                                var n = fave_load_ajax_new_count.toString();
                                var $wrap = $link.closest('.main-box-for-load-more').find('.fave-loop-wrap');
                                var $new = $(this).find('.fave-loop-wrap .fave-post').addClass('fave-new-'+n);

                                $new.hide().appendTo($wrap).fadeIn(400);

                                if ($(this).find('.fave-infinite-scroll').length) {
                                    $link.closest('.main-box-for-load-more').find('.fave-infinite-scroll').html($(this).find('.fave-infinite-scroll').html()).animate({
                                        opacity: 0,
                                        height: 0
                                    }, 300).css('padding', '0px');
                                } else {
                                    $link.closest('.main-box-for-load-more').find('.fave-infinite-scroll').fadeOut('fast').remove();
                                }


                                if (page_url != window.location) {
                                    window.history.pushState({
                                        path: page_url
                                    }, '', page_url);
                                }

                                fave_load_ajax_new_count++;

                                return false;

                            });
                        }
                    }
                });
            }
        },

        /*
         *  Header Search
         * *************************************** */

        header_search: function() {
            $('.form_submit_btn').click(
                function(event) {
                    event.preventDefault();
                    $('.form-group input').toggleClass('open');
                }
            );
        },


        /*
         *  Magzilla Popup
         * *************************************** */

        magzillaPopup: function() {
            $('.magzilla-popup').magnificPopup({
                type: 'image',
                closeOnContentClick: true,
                gallery:{
                    enabled:true
                }
            });
        },


        /*
         *  Magzilla Mega Menu
         * *************************************** */

        magzilla_megamenu: function() {
            $('.favethemes-links-megamenu > ul > li > ul').removeClass('dropdown-menu');

            $('.favethemes-links-megamenu > ul').each(function(index, element) {

                if ($(element).children().length === 4 ) {
                    $(this).addClass('megamenu-links-4-cols');
                } else if ($(element).children().length === 3 ) {
                    $(this).addClass('megamenu-links-3-cols');
                } else {
                    $(this).addClass('megamenu-links-4-cols');
                }
            });
        },


        /*
         *  Magzilla Comments
         * *************************************** */

        magzilla_comments: function() {
            $( ".post-comments-form p.form-submit" ).wrap( '<div class="module-body"><div class="row"><div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><div class="form-group"></div></div></div></div>' );
            $('.post-comments-form p.form-submit input[type="submit"]').addClass('btn btn-theme');
            $('.comment-body .media-left a img').addClass('media-object img-circle comment-avatar');
            $('.comment-reply-link, .comment-edit-link').addClass('reply');
        },

        /*
         *  Magzilla BreadCrumb
         * *************************************** */

        magzilla_breadcrumb: function() {
            $( ".single-post .post-pagination .pagination ul.list-inline a, .favethemes_bbpress_breadcrumb a" ).wrap( "<li></li>" );
        },

        /*
         *  Magzilla Animation
         * *************************************** */

        magzilla_animation: function() {
            $('.featured-image-wrap img, .slider-with-animation img, .post-author-for-archive img').addClass('wow fadeIn');
            $('.magazilla-main-nav img, .magazilla-top-nav-v2 img').removeClass('wow fadeIn');
        }


    }// end return


})(jQuery);

// load when ready
jQuery(function($) {

    Magzilla_Theme.init();

});

// Wow animation
wow = new WOW(
    {
        animateClass: 'animated',
        offset:       100,
        callback:     function(box) {
            console.log("WOW: animating <" + box.tagName.toLowerCase() + ">")
        }
    }
);
wow.init();