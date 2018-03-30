
var page_reload = false;

if (typeof woocommerce_params !== 'undefined' && typeof woocommerce_params.ajax_loader_url == 'undefined')
    woocommerce_params.ajax_loader_url = js_venedor_vars.ajax_loader_url;

(function ($) {
    "use strict";

    // check mobile
    var venedorIsMobile = {
        Android: function() {
            return navigator.userAgent.match(/Android/i);
        },
        BlackBerry: function() {
            return navigator.userAgent.match(/BlackBerry/i);
        },
        iOS: function() {
            return navigator.userAgent.match(/iPhone|iPad|iPod/i);
        },
        Opera: function() {
            return navigator.userAgent.match(/Opera Mini/i);
        },
        Windows: function() {
            return navigator.userAgent.match(/IEMobile/i);
        },
        any: function() {
            return (venedorIsMobile.Android() || venedorIsMobile.BlackBerry() || venedorIsMobile.iOS() || venedorIsMobile.Opera() || venedorIsMobile.Windows());
        }
    };

    if (navigator.userAgent.search("Safari") >= 0 && navigator.userAgent.search("Chrome") < 0) {
        $('body').addClass('safari');
    }

    var menu_container_width = 0;

    function initMegaMenu() {

        var megamenu_len = $('.mega-menu').length;
        var i = 0;

        $('.mega-menu').each( function() {
            var $menu_container = $(this).parent('.container');
            var container_width = $menu_container.width();

            var $menu_items = $(this).find('> ul > li');

            if (js_venedor_vars.menu_item_padding == 'dynamic' && menu_container_width != container_width) {
                var menu_len = $menu_items.length;

                $menu_items.find('> a, > h5').css({
                    'padding-left': 0,
                    'padding-right': 0,
                    'transition': 'none'
                });
                var $menu_wrap = $(this).find('> ul');
                var menu_width = $menu_wrap.outerWidth();
                var menu_gap = container_width - menu_width;
                var menu_padding = menu_gap / menu_len / 2 - 0.1;

                $menu_items.find('> a, > h5').css({
                    'padding-left': menu_padding,
                    'padding-right': menu_padding,
                    'transition': 'none'
                });
            }

            $menu_items.each( function(i) {
                var $menu_item = $( $menu_items[i] );
                var $popup = $menu_item.find('.popup');
                if ($popup.length > 0) {
                    $popup.css('display', 'block');
                    if ($menu_item.hasClass('wide')) {
                        $popup.css('left', 0);

                        var row_number;
                        var col_length = 0;
                        $popup.find('> .inner > ul > li').each(function() {
                            var cols = parseInt($(this).attr('data-cols'));
                            if (cols < 1)
                                cols = 1;
                            col_length += cols;
                        })

                        if ($menu_item.hasClass('col-2')) row_number = 2;
                        if ($menu_item.hasClass('col-3')) row_number = 3;
                        if ($menu_item.hasClass('col-4')) row_number = 4;
                        if ($menu_item.hasClass('col-5')) row_number = 5;
                        if ($menu_item.hasClass('col-6')) row_number = 6;

                        if (col_length > row_number) col_length = row_number;

                        var col_width = container_width / row_number;

                        $popup.find('> .inner > ul > li').each(function() {
                            var cols = parseFloat($(this).attr('data-cols'));
                            if (cols < 1)
                                cols = 1;
                            $(this).css('width', col_width * cols + 'px');
                        });

                        if ($menu_item.hasClass('pos-center')) { // position center
                            $popup.find('> .inner > ul').width(col_width * col_length);
                            var left_position = $popup.offset().left - ($(window).width() - col_width * col_length) / 2;
                            $popup.css('left', -left_position);
                        } else if ($menu_item.hasClass('pos-left')) { // position left
                            $popup.find('> .inner > ul').width(col_width * col_length);
                            $popup.css('left', 0);
                        } else if ($menu_item.hasClass('pos-right')) { // position right
                            $popup.find('> .inner > ul').width(col_width * col_length);
                            $popup.css({
                                'left': 'auto',
                                'right': 0
                            });
                        } else { // position justify
                            $popup.find('> .inner > ul').width(container_width);
                            var left_position = $popup.offset().left - ($(window).width() - container_width) / 2;
                            $popup.css('left', -left_position);
                        }
                    }
                    $popup.css('display', 'none');

                    var config = {
                        over: function(){
                            $menu_items.find('.popup').hide();
                            $popup.stop(true, true).css({
                                'visibility': 'visible',
                                'overflow': 'visible'
                            }).show();
                        },
                        out: function(){
                            $popup.stop(true, true).css({
                                'overflow': 'hidden',
                                'visivility': 'hidden'
                            }).hide();
                        },
                        sensitivity: 2,
                        interval: 0,
                        timeout: 0
                    };
                    $menu_item.hoverIntent(config);
                }
            });

            i++;

            if (i == megamenu_len)
                menu_container_width = container_width;
        });
    }

    var sidebar_menu_container_width = 0;

    function initSidebarMenu() {

        var sidebarmenu_len = $('.sidebar-menu').length;
        var i = 0;

        $('.sidebar-menu').each( function() {
            var $this = $(this);
            var container_width = $('#main > .container').width() - $this.width();
            var is_left_sidebar = $('#main').hasClass('column2-left-sidebar');

            var $menu_items = $(this).find('> ul > li');

            $menu_items.each( function(i) {
                var $menu_item = $( $menu_items[i] );
                var $popup = $menu_item.find('.popup');
                if ($popup.length > 0) {
                    $popup.css('display', 'block');
                    if ($menu_item.hasClass('wide')) {
                        var row_number;
                        var col_length = 0;
                        $popup.find('> .inner > ul > li').each(function() {
                            var cols = parseInt($(this).attr('data-cols'));
                            if (cols < 1)
                                cols = 1;
                            col_length += cols;
                        })

                        if ($menu_item.hasClass('col-2')) row_number = 2;
                        if ($menu_item.hasClass('col-3')) row_number = 3;
                        if ($menu_item.hasClass('col-4')) row_number = 4;
                        if ($menu_item.hasClass('col-5')) row_number = 5;
                        if ($menu_item.hasClass('col-6')) row_number = 6;

                        if (col_length > row_number) col_length = row_number;

                        var col_width = container_width / row_number;

                        $popup.find('> .inner > ul > li').each(function() {
                            var cols = parseFloat($(this).attr('data-cols'));
                            if (cols < 1)
                                cols = 1;
                            $(this).css('width', col_width * cols + 'px');
                        });

                        $popup.find('> .inner > ul').width(col_width * col_length);
                        if (is_left_sidebar) {
                            $popup.css({
                                'left': $this.width(),
                                'right': 'auto'
                            });
                        } else {
                            $popup.css({
                                'left': 'auto',
                                'right': $this.width()
                            });
                        }
                    }
                    $popup.css('display', 'none');

                    var config = {
                        over: function(){
                            $menu_items.find('.popup').hide();
                            $popup.stop(true, true).css({
                                'visibility': 'visible',
                                'overflow': 'visible'
                            }).show();
                            $popup.parent().addClass('open');
                        },
                        out: function(){
                            $popup.stop(true, true).css({
                                'overflow': 'hidden',
                                'visivility': 'hidden'
                            }).hide();
                            $popup.parent().removeClass('open');
                        },
                        sensitivity: 2,
                        interval: 0,
                        timeout: 200
                    };
                    $menu_item.hoverIntent(config);
                }
            });
            $(this).find('ul li.wide ul li a').on('click',function(){
                var $this = $(this);
                setTimeout(function() {
                    $this.mouseleave();
                }, 500);
            });

            i++;

            if (i == sidebarmenu_len)
                sidebar_menu_container_width = container_width;
        });
    }

    function initAccordionMenu() {

        $("#main-mobile-toggle").unbind('click').click(function () {
            var top = $("#main-mobile-toggle").offset().top - $("#main-mobile-menu").parent().offset().top + $("#main-mobile-toggle").outerHeight( true );
            $(this).parent().find('.accordion-menu').css('top', top).slideToggle(400);
        });

        $(".accordion-menu, .widget_categories, .widget_pages, .widget_product_categories, .widget_brand_nav.widget_layered_nav").each(function() {
            $(this).find('> ul > li > ul.children').before(
                $('<span class="arrow"></span>').unbind('click').click(function() {
                    if ($(this).next().is(":visible")) {
                        $(this).parent().removeClass('open');
                    } else {
                        $(this).parent().addClass('open');
                    }
                    $(this).next().slideToggle(200, initScrollBar);
                })
            );
            $(this).find('> ul > li[class*="current-"]').addClass('open');
        });

        $(".accordion-menu ul li.has-sub > span.arrow").unbind('click').click(function () {
            if ($(this).parent().find("> ul.sub-menu").is(":visible")){
                $(this).parent().removeClass('open');
            } else {
                $(this).parent().addClass('open');
            }
            $(this).parent().find("> ul.sub-menu").slideToggle(200);
        });

        $('.widget_layered_nav h3, .widget_layered_nav_filters h3, .widget_price_filter h3, .widget_product_categories h3').each(function() {
            var $this = $(this);
            $this.parent().addClass('open');
            if (!$this.find('.toggle').length) {
                $this.append('<span class="toggle"></span>');
            }
            $this.find('.toggle').unbind('click').click(function() {
                if ($this.next().is(":visible")){
                    $this.parent().removeClass('open');
                } else {
                    $this.parent().addClass('open');
                }
                $this.next().slideToggle(200);
            });
        });

        $('.widget_sidebar_menu h3').each(function() {
            var $this = $(this);
            $this.parent().addClass('open');
            if (!$this.find('.toggle').length) {
                $this.append('<span class="toggle"></span>');
            }
            $this.find('.toggle').unbind('click').click(function() {
                if ($this.next().is(":visible")){
                    $this.parent().removeClass('open');
                } else {
                    $this.parent().addClass('open');
                }
                $this.next().slideToggle(200, function() {
                    initSidebarMenu();
                });
            });
        });
    }

    function initSearchForm() {
        var search_input_width = 200;

        $('.header').each(function() {
            var $header = $(this);
            var container_width = $header.find('.menu-wrapper > div').width();
            var $search_text = $header.find('.searchform input');
            if ((container_width >= 768 && container_width <= 940) || (container_width > 940 && $header.find('.search-popup').length)) {
                $search_text.stop().animate({
                    width: 0,
                    left: 2
                }, 400, function() {
                    $(this).hide();
                });
            } else {
                $search_text.show().stop().animate({
                    width: search_input_width,
                    left: -search_input_width
                }, 400);
            }
            $header.find('.searchform button').unbind('click').click(function() {
                var $search_text = $header.find('.searchform input');
                if ($search_text.css('display') == 'none') {
                    $search_text.show().stop().animate({
                        width: search_input_width,
                        left: -search_input_width
                    }, 400);
                    return false;
                }
                var container_width = $header.find('.menu-wrapper > div').width();
                if ((container_width >= 768 && container_width <= 940) || (container_width > 940 && $header.find('.search-popup').length)) {
                    if ($search_text.val() == '') {
                        $search_text.stop().animate({
                            width: 0,
                            left: 2
                        }, 400, function() {
                            $(this).hide();
                        });
                        return false;
                    }
                }
            });
        });
    }

    function initHeaderFixed() {
        if (!$('.sticky-header').length || page_reload)
            return;

        var container_width = $('.sticky-header .menu-wrapper > .container').width();
        if (container_width < 940) {
            $('.sticky-header').stop().animate({
                'top': -$('.sticky-header').outerHeight(true)
            }, 100, function() {
                $(this).css({
                    'visibility': 'hidden',
                    'overflow': 'hidden'
                });
            });
            $('.sticky-header .popup').css({
                'visibility': 'hidden',
                'overflow': 'hidden'
            });
            return;
        }

        var offset = $('.header-wrapper .menu-wrapper').offset();
        var offset_top = offset.top + $('.header-wrapper .menu-wrapper').outerHeight(true);// - $('.sticky-header').outerHeight(true);

        var scroll_top = $(window).scrollTop();

        if (scroll_top > offset_top) {
            var top = $('#wpadminbar').height() + $('.demo_store').height();
            $('.sticky-header').stop().animate({
                'top': top
            }).css({
                    'visibility': 'visible',
                    'overflow': 'visible'
                });
            return;
        } else {
            $('.sticky-header').stop().animate({
                'top': -$('.sticky-header').outerHeight(true)
            }, 100, function() {
                $(this).css({
                    'visibility': 'hidden',
                    'overflow': 'hidden'
                });
            });
            $('.sticky-header .popup').css({
                'visibility': 'hidden',
                'overflow': 'hidden'
            });
        }
    }

    function initCategoryHeight() {
        $('.products.grid.calc-height, .product-carousel.calc-height').each(function() {
            var $grid = $(this);
            $grid.find('.product-image > img').imagesLoaded(function() {
                var winWidth = $(window).width();
                var isWide = $grid.hasClass('products-wide');
                var cols = 1;
                if (winWidth >= 992) {
                    cols = isWide ? 4 : 3;
                } else if (winWidth < 992 && winWidth >= 768) {
                    cols = isWide ? 3 : 2;
                } else {
                    cols = 1;
                }
                var $inner = $grid.find('.inner');
                $inner.css('min-height', '0');
                setTimeout(function() {
                    var height = 0;
                    var size = $inner.length;
                    var index = 0;
                    var items = new Array();
                    $inner.each(function() {
                        index++;
                        var $t = $(this);
                        var h = $t.outerHeight(true);
                        if (height < h) height = h;
                        items.push(this);
                        if (index % cols == 0 || index == size) {
                            $.each(items, function(id, value) {
                                $(value).css({
                                    'min-height': height
                                });
                            });
                            height = 0;
                            items = new Array();
                        }
                    });
                }, 200);
            });
        })
    }

    function initCategoryToggle() {
        $('.gridlist-toggle > a').click(function() {
            setTimeout(initCategoryHeight, 500);
        });
    }

    function initTooltip() {
        $('.product_list_widget .star-rating').each(function() {
            var rating = $(this).find('.rating').html();
            if (parseFloat(rating))
                $(this).tooltip({title: rating});
        });
        $('.yith-wcwl-share li a').each(function(){
            if ($(this).hasClass('googleplus'))
                $(this).tooltip({title: js_venedor_vars.googleplus});
            if ($(this).hasClass('pinterest'))
                $(this).tooltip({title: js_venedor_vars.pinterest});
            if ($(this).hasClass('email'))
                $(this).tooltip({title: js_venedor_vars.email});
            $(this).attr('data-toggle', 'tooltip');
        });
        $("[data-toggle='tooltip']").tooltip();
    }

    function initSlider() {
        var win_width = $(window).width();
        var column;
        if ($('#main').hasClass('column1'))
            column = 'column1';
        else if ($('#main').hasClass('column2'))
            column = 'column2';
        else
            column = 'column3';

        $('.product-slider').each(function() {
            var temp = column;
            if (!$(this).parents('#main').length)
                temp = 'column1';

            var $wrap = $(this);
            var itemsCustom;
            if (temp == 'column1')
                itemsCustom = [[0, 1], [750, 3], [992, 4]];
            else if (temp == 'column2')
                itemsCustom = [[0, 1], [750, 2], [992, 3]];
            else
                itemsCustom = [[0, 1], [750, 1], [992, 2]];

            if ($wrap.hasClass('sidebar') || $(this).hasClass('single')) {
                $wrap.find('.product-carousel').owlCarousel({
                    autoPlay : 5000,
                    singleItem: true,
                    navigation: true,
                    navigationText: ["", ""],
                    pagination: false
                });
            } else {
                $wrap.find('.product-carousel').owlCarousel({
                    autoPlay : 5000,
                    itemsCustom: itemsCustom,
                    navigation: true,
                    navigationText: ["", ""],
                    pagination: false
                });
                $wrap.find('h1, h2').each(function() {
                    var $this = $(this);
                    if ($this.find('.inline-title').length) return;
                    var text = $this.html();
                    $this.html('<span class="inline-title">' + text + '</span><span class="line"></span>');
                    $this.find('.line').hide();
                });
            }
        });

        $('.related-slider').each(function() {
            var temp = column;
            if (!$(this).parents('#main').length)
                temp = 'column1';

            var $wrap = $(this);
            var itemsCustom;
            if (temp == 'column1')
                itemsCustom = [[0, 1], [750, 2], [992, 3]];
            else if (temp == 'column2')
                itemsCustom = [[0, 1], [750, 2], [992, 2]];
            else
                itemsCustom = [[0, 1], [750, 1], [992, 2]];

            if ($wrap.hasClass('sidebar') || $(this).hasClass('single')) {
                $wrap.find('.post-carousel').owlCarousel({
                    autoPlay : 5000,
                    singleItem: true,
                    navigation: true,
                    navigationText: ["", ""],
                    pagination: false
                });
            } else {
                $wrap.find('.post-carousel').owlCarousel({
                    autoPlay : 5000,
                    itemsCustom: itemsCustom,
                    navigation: true,
                    navigationText: ["", ""],
                    pagination: false
                });
                $wrap.find('h1, h2').each(function() {
                    var $this = $(this);
                    if ($this.find('.inline-title').length) return;
                    var text = $this.html();
                    $this.html('<span class="inline-title">' + text + '</span><span class="line"></span>');
                    $this.find('.line').hide();
                });
            }
        });

        $('#main .content-slider').each(function() {
            var $wrap = $(this);
            if ($(this).hasClass('single')) {
                $wrap.parent().find('h1, h2').each(function() {
                    var $this = $(this);
                    if ($this.find('.inline-title').length) return;
                    var text = $this.html();
                    $this.html('<span class="inline-title">' + text + '</span><span class="line"></span>');
                    $this.find('.line').hide();
                });
            } else {
                $wrap.parent().parent().find('h1, h2').each(function() {
                    var $this = $(this);
                    if ($this.find('.inline-title').length) return;
                    var text = $this.html();
                    $this.html('<span class="inline-title">' + text + '</span><span class="line"></span>');
                    $this.find('.line').hide();
                });
            }
        });

        $('.post-slider').each(function() {
            var temp = column;
            if (!$(this).parents('#main').length)
                temp = 'column1';

            var $wrap = $(this);
            var itemsCustom;
            if (temp == 'column1')
                itemsCustom = [[0, 1], [750, 3], [992, 4]];
            else if (temp == 'column2')
                itemsCustom = [[0, 1], [750, 2], [992, 3]];
            else
                itemsCustom = [[0, 1], [750, 1], [992, 2]];

            if ($wrap.hasClass('sidebar') || $(this).hasClass('single')) {
                $wrap.find('.post-carousel').owlCarousel({
                    autoPlay : 5000,
                    singleItem: true,
                    navigation: true,
                    navigationText: ["", ""],
                    pagination: false
                });
            } else {
                $wrap.find('.post-carousel').owlCarousel({
                    autoPlay : 5000,
                    itemsCustom: itemsCustom,
                    navigation: true,
                    navigationText: ["", ""],
                    pagination: false
                });
            }
        });

        $('.post-slideshow').each(function(){

            if (js_venedor_vars.post_slider_zoom != 0) {
                var $links = [];
                var i = 0;
                $(this).find('img').each(function() {
                    $links[i] = $(this).attr('data-image');
                    i++;
                })
                $(this).parent().find('.zoom-button').unbind('click').click(function(event) {
                    blueimp.Gallery($links);
                });
            }

            $(this).owlCarousel({
                autoPlay : 5000,
                stopOnHover : true,
                navigation : true,
                singleItem : true,
                autoHeight : true,
                navigationText: false
            });
        });

        $('.portfolio-slideshow').each(function(){
            if (js_venedor_vars.portfolio_slider_zoom != 0) {
                var $links = [];
                var i = 0;
                $(this).find('img').each(function() {
                    $links[i] = $(this).attr('data-image');
                    i++;
                })
                $(this).parent().find('.zoom-button').unbind('click').click(function(event) {
                    blueimp.Gallery($links);
                });
            }

            $(this).owlCarousel({
                autoPlay : 5000,
                stopOnHover : true,
                navigation : true,
                singleItem : true,
                autoHeight : true,
                navigationText: false
            });
        });

        $('.portfolio-wrapper, .entry-related .post-carousel').each(function(){
            if (js_venedor_vars.portfolio_slider_zoom != 0) {
                var $links = $(this).find('a.zoom-button');
                $links.unbind('click').click(function(event) {
                    var options = {index: $links.index($(this)), event: event};
                    blueimp.Gallery($links, options);
                });
            }
        });

        $('.recent-posts-slider, .recent-portfolios-slider').owlCarousel({
            autoPlay : 5000,
            stopOnHover : true,
            navigation : true,
            singleItem : true,
            autoHeight : true,
            navigationText: false,
            pagination: false
        });

        // calculate line width in post title
        resizeHeadingLine();
    }

    function initQuickView() {
        $('.quickview-button').unbind('click').click(function(e) {
            e.preventDefault();
            var pid = $(this).attr('data-id');

            var image_es;
            var zoom_timer;
            var win_width = 0;

            function resize_venedor_quickview() {
                clearTimeout(zoom_timer);
                zoom_timer = setTimeout(refresh_venedor_quickview, 400);
            };

            function refresh_venedor_quickview() {
                if (win_width != $(window).width()) {
                    if ($('#thumbnails-slider-' + pid + ' li').length > 4) {
                        if (image_es) {
                            image_es.destroy();
                        }
                        image_es = $('#thumbnails-slider-' + pid).elastislide({
                            orientation : 'vertical',
                            minItems: 4
                        });
                    }
                    win_width = $(window).width();
                }
                if (zoom_timer) clearTimeout(zoom_timer);
            }

            function init_venedor_quickview() {
                refresh_venedor_quickview();
                $(window).resize(resize_venedor_quickview);
                $( '.quickview-wrap form.variations_form .variations select').trigger('change');
            }

            function destroy_venedor_quickview() {
                $(window).unbind('resize', resize_venedor_quickview);
                $('.quickview-wrap .addthis_button_compact, .quickview-wrap .addthis_bubble_style').unbind('mousemove');
            }

            jQuery.fancybox({
                'href' : js_venedor_vars.ajax_url,
                'type' : 'ajax',
                ajax : {
					data: {
						action: 'venedor_product_quickview',
						pid: pid,
						context: 'frontend'
					}
				},
                helpers : {
                    overlay: {
                        locked: false
                    }
                },
				autoSize: false,
                autoWidth : true,
                'afterShow' : init_venedor_quickview,
                'afterClose' : destroy_venedor_quickview
            });
            return false;
        });

        $('.product-image .figcaption').show();
    }

    function resizeHeadingLine() {
        var win_width = $(window).width();
        $('#main h1, #main h2').each(function() {
            var $this = $(this);
            if ($this.find('.line').length) {
                $this.addClass('line-heading');
                $this.find('.line').css('width', $this.width() - $this.find('.inline-title').width() - 35);
                if ($this.parent().find('> .owl-theme .owl-controls').css('display') == 'none' || $this.next().find('> .owl-theme .owl-controls').css('display') == 'none' || $this.next().next().find('> .owl-theme .owl-controls').css('display') == 'none')
                    $this.find('.line').hide();
                else
                    $this.find('.line').css('display', 'inline-block');
            }
        });
    }

    function initFitVideos() {
        if ($(".fit-video").length)
            $(".fit-video").fitVids();
    }

    function initIsotope() {
        if ($(".grid-layout").length) {
            $('.grid-layout').each(function() {
                var $this = $(this);
                $this.find('.post-item').imagesLoaded(function() {
                    $this.isotope({
                        // options
                        itemSelector : '.post-item'
                    });
                    $this.isotope('layout');
                });
            });
        }
    }

    function initInfiniteScroll() {
        $(".posts-infinite").infinitescroll({
            navSelector  : "div.pagination", // selector for the paged navigation (it will be hidden)
            nextSelector : "a.next", // selector for the NEXT link (to page 2)
            itemSelector : ".posts-infinite div.post-item, .posts-infinite .timeline-date", // selector for all items you'll retrieve
            loading      : {
                finishedMsg: js_venedor_vars.infinte_blog_finished_msg,
                msgText: js_venedor_vars.infinte_blog_text
            },
            errorCallback: function() {
                if ($('.posts-infinite').hasClass('grid-layout'))
                    $('.posts-infinite').isotope('layout');
            }
        }, function(posts) {

            var f = false;

            if ($().isotope) {
                $(posts).css('top', 'auto').css('left', 'auto');

                //$(posts).hide();
                $(posts).imagesLoaded(function() {
                    //$(posts).fadeIn();
                    if ($('.posts-infinite').hasClass('grid-layout')) {
                        $('.posts-infinite').isotope('appended', $(posts));
                        $('.posts-infinite').isotope('layout');
                    }

                    $(posts).each(function() {
                        $(this).find('.fit-video').fitVids();
                    });

                    initSlider();
                    initHoverClass();

                    f = true;
                });
            }

            if (!f) {
                $(posts).each(function() {
                    $(this).find('.fit-video').fitVids();
                });

                initSlider();
                initHoverClass();
            }
        });
    }

    function initHoverClass() {
        // add hover class
        $('.products .product .inner').on("mouseenter",function(){
            $(this).addClass('hover');
        }).on("mouseleave", function(){
                $(this).removeClass('hover');
            });
    }

    function initWaypoints() {
        if($().waypoint) {
            // active parallax effect
            $('.sw-parallax').waypoint(function() {

                $(this).parallax(
                    "50%",
                    $(this).attr('data-velocity')
                );
            },{offset: '200%'});

            // progress
            $('.progress-bar').css('width', '60px');
            $('.progress').waypoint(function() {

                var percentage = $(this).find('.progress-bar').attr('aria-valuenow');
                $(this).find('.progress-bar').css({
                    width: percentage+'%'
                });
            }, {
                triggerOnce: true,
                offset: '85%'
            });

            // counter box
            $('.counter-box-wrapper').waypoint(function() {

                $(this).find('.display-percentage').each(function() {
                    var percentage = $(this).data('percentage');
                    $(this).countTo({from: 0, to: percentage, refreshInterval: 10, speed: 1000});
                });
            }, {
                triggerOnce: true,
                offset: '85%'
            });

            // counter circle
            $('.counter-circle-wrapper').waypoint(function() {

                $(this).each(function() {

                    var unfilledcolor = $(this).children(".counter-circle-content").attr('data-unfilledcolor');
                    var filledcolor = $(this).children(".counter-circle-content").attr('data-filledcolor');
                    var size = $(this).children(".counter-circle-content").attr('data-size');
                    var speed = $(this).children(".counter-circle-content").attr('data-speed');
                    var stroksize = $(this).children(".counter-circle-content").attr('data-strokesize');

                    $(this).children(".counter-circle-content").easyPieChart({
                        barColor: filledcolor,
                        trackColor: unfilledcolor,
                        scaleColor: false,
                        scaleLength: 5,
                        lineCap: "round",
                        lineWidth: stroksize,
                        size: size,
                        rotate: 0,
                        animate: {
                            duration: speed,
                            enabled: true
                        }
                    });
                });
            }, {
                triggerOnce: true,
                offset: '85%'
            });

            // animated
            $('.animated').waypoint(function() {

                // this code is executed for each appeared element
                var animation_type = $(this).attr('animation_type');
                var animation_duration = $(this).attr('animation_duration');
                var animation_delay = $(this).attr('animation_delay');
                var $this = $(this);

                $this.css('visibility', 'visible');
                $this.addClass(animation_type);

                if (animation_duration) {
                    $this.css('-moz-animation-duration', animation_duration+'s');
                    $this.css('-webkit-animation-duration', animation_duration+'s');
                    $this.css('-ms-animation-duration', animation_duration+'s');
                    $this.css('-o-animation-duration', animation_duration+'s');
                    $this.css('animation-duration', animation_duration+'s');
                }
                if (animation_delay) {
                    $this.css('-moz-animation-delay', animation_delay+'s');
                    $this.css('-webkit-animation-delay', animation_delay+'s');
                    $this.css('-ms-animation-delay', animation_delay+'s');
                    $this.css('-o-animation-delay', animation_delay+'s');
                    $this.css('animation-delay', animation_delay+'s');
                }
            }, {
                triggerOnce: true,
                offset: '85%'
            });
        }
    }

    function initFilters() {
        $('.portfolio-filter').each(function() {
            var $this = $(this);
            $this.find('a').on('click', function(e) {
                e.preventDefault();

                var selector = $(this).attr('data-filter');
                $this.find('.active').removeClass('active');

                $('.grid-layout').isotope({
                    filter: selector
                });

                $(this).addClass('active');
            });
        });

        jQuery('.faq-filter a').click(function(e){
            e.preventDefault();

            var selector = $(this).attr('data-filter');

            $('.faq-wrapper .post-item').stop().fadeOut();
            $('.faq-wrapper .post-item'+selector).stop().fadeIn();

            $(this).parents('ul').find('a').removeClass('active');
            $(this).addClass('active');
        });
    }

    function initScrollBar() {

        $('#mini-cart .cart-content > .cart_list_wrap').scrollbar();

        if (js_venedor_vars.sidebar_scroll == 1) {
            $('.widget_product_categories > ul, .widget_layered_nav > ul').each(function() {
                if ($(this).hasClass('yith-wcan-label') || $(this).hasClass('yith-wcan-color') || $(this).hasClass('yith-wcan-select')) {
                    return;
                }
                if (!$(this).find('.scrollwrap').length) {
                    $(this).wrap('<div><div class="scrollwrap scrollbar-rail"></div></div>');
                    $(this).parent().scrollbar();
                }
            });
        }
    }

    function initFileUpload() {
        if ($('#contact-file').length) {
            document.getElementById("contact-file").onchange = function () {
                document.getElementById("contact-file-upload").value = this.value;
            };
        }
    }

    function initFancybox() {
        $('.fancybox').fancybox({
            maxWidth	: 800,
            maxHeight	: 600,
            fitToView	: false,
            width		: '90%',
            height		: '70%',
            autoSize	: false,
            closeClick	: false,
            openEffect	: 'none',
            closeEffect	: 'none'
        });
    }

    function initVariationForm() {
        $( document ).on( 'reset_image found_variation', 'form.variations_form', function( event, variation ) {
            var $variations_form = $(this),
                $product = $variations_form.closest( '.product' ),
                $product_img = $product.find( 'div.images img:eq(0)' ),
                $product_link = $product.find( 'div.images a.zoom:eq(0)'),
                $product_thumb = $product.find( 'div.thumbnails img:eq(0)' );

            if ($product_img.length) {
                var img_src = $product_img.attr('src');
                var img_title = $product_img.attr('title');

                $product_img.attr('data-zoom-image', img_src);
                $product_img.attr('srcset', '');
                $product_img.data('zoomImage', img_src);
                var $product_zoom = $product_img.data('elevateZoom');
                if ($product_zoom) {
                    $product_zoom.imageSrc = img_src;
                    $product_zoom.currentImage = img_src;
                    if($product_zoom.options.zoomType == "lens" && $product_zoom.zoomLens) {
                        $product_zoom.zoomLens.css('background-image', 'url('+img_src+')');
                    }
                    if($product_zoom.options.zoomType == "window" && $product_zoom.zoomWindow) {
                        $product_zoom.zoomWindow.css('background-image', 'url('+img_src+')');
                    }
                    if($product_zoom.options.zoomType == "inner" && $product_zoom.zoomWindow) {
                        $product_zoom.zoomWindow.css('background-image', 'url('+img_src+')');
                    }
                }

                if ($product_thumb.length) {
                    $product_thumb.attr('src', img_src);
                    $product_thumb.parent().attr('data-zoom-image', img_src)
                        .attr('data-image', img_src)
                        .attr('title', img_title);
                    $product_thumb.parent().data('zoomImage', img_src);
                    $product_thumb.parent().data('image', img_src);
                }
            }
        });

        $('form.variations_form .variations select').trigger('change');
        $('form.variations_form .variations input:radio').trigger('change');
    }

    function initBGSlider() {
        var $bg_slider = $('#bg-slider .rev_slider');
        var $banner_slider = $('#banner-wrapper .rev_slider');
        var rev_bg = $bg_slider.revolution;
        var rev_banner = $banner_slider.revolution;
        if (rev_bg != undefined && rev_banner != undefined) {
            $banner_slider.bind('revolution.slide.onchange', function(e, data) {
                $bg_slider.revshowslide(data.slideIndex);
            });
        }
    }

    function initGridListToggle() {

        $('#grid').click(function() {
            $(this).addClass('active');
            $('#list').removeClass('active');
            if (($.cookie && $.cookie('gridcookie') == 'list') || !$.cookie) {
                var $toggle = $('.gridlist-toggle');
                if ($toggle.length) {
                    var $parent = $toggle.parents('#content');
                    var $products = $parent.find('ul.products');
                    $products.fadeOut(300, function() {
                        $products.addClass('grid').removeClass('list').fadeIn(300);
                    });
                }
            }
            if ($.cookie)
                $.cookie('gridcookie', 'grid', { path: '/' });
            return false;
        });

        $('#list').click(function() {
            $(this).addClass('active');
            $('#grid').removeClass('active');
            if (($.cookie && $.cookie('gridcookie') == 'grid') || !$.cookie) {
                var $toggle = $('.gridlist-toggle');
                if ($toggle.length) {
                    var $parent = $toggle.parents('#content');
                    var $products = $parent.find('ul.products');
                    $products.fadeOut(300, function() {
                        $products.addClass('list').removeClass('grid').fadeIn(300);
                    });
                }
            }
            if ($.cookie)
                $.cookie('gridcookie', 'list', { path: '/' });
            return false;
        });

        var $toggle = $('.gridlist-toggle');
        var view = '';
        if ($toggle.length)
            view = $toggle.data('view');

        if ($.cookie && $.cookie('gridcookie')) {
            if ($toggle.length) {
                var $parent = $toggle.parents('#content');
                if (!view)
                    $parent.find('ul.products').addClass($.cookie('gridcookie'));
            }
        }

        if (!view && $.cookie && $.cookie('gridcookie') == 'grid') {
            $('.gridlist-toggle #grid').addClass('active');
            $('.gridlist-toggle #list').removeClass('active');
        }

        if (!view && $.cookie && $.cookie('gridcookie') == 'list') {
            $('.gridlist-toggle #list').addClass('active');
            $('.gridlist-toggle #grid').removeClass('active');
        }

        if (!view && $.cookie && $.cookie('gridcookie') == null) {
            var $toggle = $('.gridlist-toggle');
            if ($toggle.length) {
                var $parent = $toggle.parents('#content');
                $parent.find('ul.products').addClass($.cookie('gridcookie'));
            }
            $('.gridlist-toggle #grid').addClass('active');
            if ($.cookie)
                $.cookie('gridcookie', 'grid', { path: '/' });
        }

        if (view) {
            if ($.cookie)
                $.cookie('gridcookie', view, { path: '/' });
        }
    }

    function initQtyField() {
        // Quantity buttons
        $( 'div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)' ).addClass( 'buttons_added' ).append( '<input type="button" value="+" class="plus" />' ).prepend( '<input type="button" value="-" class="minus" />' );

        // Target quantity inputs on product pages
        $( 'input.qty:not(.product-quantity input.qty)' ).each( function() {
            var min = parseFloat( $( this ).attr( 'min' ) );

            if ( min && min > 0 && parseFloat( $( this ).val() ) < min ) {
                $( this ).val( min );
            }
        });

        $( document ).off('click', '.plus, .minus').on( 'click', '.plus, .minus', function() {

            // Get values
            var $qty		= $( this ).closest( '.quantity' ).find( '.qty' ),
                currentVal	= parseFloat( $qty.val() ),
                max			= parseFloat( $qty.attr( 'max' ) ),
                min			= parseFloat( $qty.attr( 'min' ) ),
                step		= $qty.attr( 'step' );

            // Format values
            if ( ! currentVal || currentVal === '' || currentVal === 'NaN' ) currentVal = 0;
            if ( max === '' || max === 'NaN' ) max = '';
            if ( min === '' || min === 'NaN' ) min = 0;
            if ( step === 'any' || step === '' || step === undefined || parseFloat( step ) === 'NaN' ) step = 1;

            // Change the value
            if ( $( this ).is( '.plus' ) ) {

                if ( max && ( max == currentVal || currentVal > max ) ) {
                    $qty.val( max );
                } else {
                    $qty.val( currentVal + parseFloat( step ) );
                }

            } else {

                if ( min && ( min == currentVal || currentVal < min ) ) {
                    $qty.val( min );
                } else if ( currentVal > 0 ) {
                    $qty.val( currentVal - parseFloat( step ) );
                }

            }

            // Trigger change event
            $qty.trigger( 'change' );
        });
    }

    function initCategoryMobileFilter() {
        $('.filter-toggle').click(function(e) {
            var $html = $('html');
            if ($html.hasClass('filter-opened')) {
                $html.removeClass('filter-opened');
                $('.filter-overlay').removeClass('active');
            } else {
                $html.addClass('filter-opened');
                $('.filter-overlay').addClass('active');
            }
        });

        $('.filter-overlay').click(function() {
            var $html = $('html');
            $html.removeClass('filter-opened');
            $(this).removeClass('active');
        });

        $(window).on('resize', function() {
            var winWidth = $(window).width();
            if (winWidth > 991 - window.innerWidth + $(window).width()) {
                $('.filter-overlay').click();
            }
        });
    }

    function initAjaxRemoveItem() {
        $('#mini-cart .remove-product, .widget_shopping_cart .remove-product').unbind('click').click(function(){
            var $this = $(this);
            var cart_id = $this.data("cart_id");
            $this.parent().find('.ajax-loading').show();

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: js_venedor_vars.ajax_url,
                data: { action: "venedor_product_remove",
                    cart_id: cart_id
                },success: function( response ) {
                    var fragments = response.fragments;
                    var cart_hash = response.cart_hash;

                    if ( fragments ) {
                        $.each(fragments, function(key, value) {
                            $(key).replaceWith(value);
                        });
                    }

                    $('#mini-cart .cart-content > .cart_list_wrap').scrollbar();
                }
            });
            return false;
        });

        $('#mini-cart .cart-content > .cart_list_wrap').scrollbar();
    }

    function addAjaxCartClass() {
        $('.products a.cart-links.added').addClass('added-cart');
        $('.product-topslider .added_to_cart').addClass('btn btn-lg btn-inverse');
        $('.product-featured-slider .added_to_cart').addClass('btn btn-lg btn-inverse');
    }

    function venedor_ajax_complete() {
        initTooltip();
        initAjaxRemoveItem();
        addAjaxCartClass();
        initQtyField();
    }

    var venedor_timer;
    function venedor_resize() {

        initSearchForm();
        initHeaderFixed();
        initCategoryHeight();
        initFitVideos();
        initIsotope();
        initScrollBar();

        if (venedorIsMobile.any()) {
            $('body').addClass('mobile');
        } else {
            initMegaMenu();
        }

        initSidebarMenu();

        if ($("#main-mobile-toggle").length) {
            var top = $("#main-mobile-toggle").offset().top - $("#main-mobile-menu").parent().offset().top + $("#main-mobile-toggle").outerHeight( true );
            $('#main-mobile-toggle').parent().find('.accordion-menu').css('top', top);
        }

        // calculate line width in post title
        resizeHeadingLine();

        if (venedor_timer) clearTimeout(venedor_timer);
    }

    function venedor_init() {

        initAccordionMenu();
        initCategoryToggle();
        initTooltip();
        initFilters();
        initSlider();
        initQuickView();
        initInfiniteScroll();
        initHoverClass();
        initWaypoints();
        initFileUpload();
        initFancybox();
        initVariationForm();
        initBGSlider();
        initAjaxRemoveItem();
        initGridListToggle();
        initQtyField();
        initCategoryMobileFilter();

        // init addthis
        if (window.addthis) {
            addthis.init();
        }

        // bootstrap dropdown hover
        $('[data-toggle="dropdown"]').dropdownHover();

        // disable default hide dropdown popup
        if (!venedorIsMobile.any()) {
            $('.mini-cart').on('hide.bs.dropdown', function () {
                return false;
            });
        }

        // replace wishlist ajax-loading img tag
        $('.yith-wcwl-add-to-wishlist img.ajax-loading').replaceWith('<span class="ajax-loading"></span>');

        // scroll top control
        scrolltotop.controlHTML = '<div class="btn btn-special"><span class="fa fa-angle-up"></span></div>';
        scrolltotop.controlattrs = {offsetx:15, offsety:15};
        scrolltotop.init();

        $('body').on('click', function(e){
            if( !$(e.target).hasClass('yit-wcan-select-open') ) {
                $('div.yith-wcan-select-wrapper').css("z-index", "-1");
            }
        });

        venedor_resize();
    }

    $(document).ajaxComplete(function(event, xhr, settings) {
        venedor_ajax_complete();
    })

    $(window).resize(function() {
        clearTimeout(venedor_timer);
        venedor_timer = setTimeout(venedor_resize, 400);
    });

    $(document).ready(function(){
        venedor_init();
        $(window).scroll(function(){
            initHeaderFixed();
        });
    });

    $(window).bind('vc_reload', function() {
        venedor_init();
        $('.type-product').addClass('product');
        $('.type-post').addClass('post');
        $('.type-portfolio').addClass('portfolio');
        $('.type-block').addClass('block');
    });

    // Ajax Navigation Call back
    $(document).on('yith-wcan-ajax-filtered', initAjaxFilter);

    if (typeof yith_wcan != 'undefined') {
        yith_wcan.container = '#content .archive-products';
        yith_wcan.pagination = '.content-before';
        yith_wcan.result_count = '.content-after';
    }

    $(document).on('click', '.yith-wcan a', function(e){
        if (typeof yith_wcan != 'undefined') {
            var winWidth = $(window).width();
            if (winWidth <= 991 - window.innerWidth + $(window).width()) {
                $('.filter-overlay').click();
            }
            $('html, body').stop().animate({
                scrollTop: $(yith_wcan.pagination).offset().top - ($('.sticky-header').length && $(window).width() > 991 ? $('.sticky-header').height() + 30 : ($(window).width() > 767 ? 40 : 50))
            }, 600, 'easeOutQuad');
        }
    });

    function initAjaxFilter() {
        if (typeof yith_wcan != 'undefined') {
            if ($(yith_wcan.container).find('.product').length) {
                $(yith_wcan.pagination).show();
                $(yith_wcan.result_count).show();
            } else {
                $(yith_wcan.pagination).hide();
                $(yith_wcan.result_count).hide();
            }
            if (jQuery.cookie('gridcookie')) {
                $(yith_wcan.container).addClass($.cookie('gridcookie'));
            }
            $(yith_wcan.pagination).find('[data-toggle="dropdown"]').dropdownHover();
            $(yith_wcan.result_count).find('[data-toggle="dropdown"]').dropdownHover();
        }

        initCategoryHeight();
        initHoverClass();
        initQuickView();
        initAccordionMenu();
        initGridListToggle();
    }

}(jQuery));

var wpml_language_selector_click = {
    ls_click_flag: false,
    toggle: function(){
        var $sel = jQuery('.lang_sel_click').find('>ul>li>ul');
        if($sel.css('visibility') == 'visible'){
            $sel.css('visibility', 'hidden');
            document.removeEventListener('click', wpml_language_selector_click.close);
        }else{
            $sel.css('visibility', 'visible');
            document.addEventListener('click', wpml_language_selector_click.close);
            wpml_language_selector_click.ls_click_flag = true;
        }
        return false;
    },
    close: function(e){
        if(!wpml_language_selector_click.ls_click_flag){
            var $sel = jQuery('.lang_sel_click').find('>ul>li>ul');
            $sel.css('visibility', 'hidden');
        }
        wpml_language_selector_click.ls_click_flag = false;
    }
};