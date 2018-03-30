/************************************************************************
* Theme's JS code
*************************************************************************/

(function($) {
    "use strict";

    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
        $('body').addClass('wbc907-mobile-device');
    } else {
        $('body').removeClass('wbc907-mobile-device');
    }
    
    //Carousel
    function initBannerCarouFred() {
        $('.wbc-carousel-banner').each(function() {
            var wbcCarousel     = $(this),
                wbcWidth        = (wbcCarousel.data('item-width') && $.isNumeric(wbcCarousel.data('item-width'))) ? wbcCarousel.data('item-width') : 400,
                wbcScroll       = (wbcCarousel.data('item-scroll') && $.isNumeric(wbcCarousel.data('item-scroll'))) ? wbcCarousel.data('item-scroll') : 1,
                wbcMin          = (wbcCarousel.data('item-min') && $.isNumeric(wbcCarousel.data('item-min'))) ? wbcCarousel.data('item-min') : 1,
                wbcMax          = (wbcCarousel.data('item-max') && $.isNumeric(wbcCarousel.data('item-max'))) ? wbcCarousel.data('item-max') : 6;

            wbcCarousel.imagesLoaded(function() {

                wbcCarousel.carouFredSel({
                    responsive: true,
                    width: '101%',
                    scroll: wbcScroll,
                    swipe: {
                        onMouse: true,
                        onTouch: true,
                    },
                    items: {
                        width: wbcWidth,
                        height: 'auto',
                        visible: {
                            min: wbcMin,
                            max: wbcMax
                        }
                    },
                    onCreate: function() {
                        wbcCarousel.css('opacity', 1);
                        initParallaxSections();
                    }
                });
            });

        });

    }

    function initWbcCharts() {

         var resize_charts = function(){
            $('.wbc-pie-chart .inited-chart').each(function() {
                if($(this).parents('.wbc-chart-wrap').width() < $(this).width()){
                    var chart_w = $(this).attr('data-orginal-width'),
                    back_w      = $(this).attr('data-backing-width'),
                    diff        = Math.floor((chart_w  - $(this).parents('.wbc-chart-wrap').width())/2) * 2;

                    $(this).find('.percent-backing').css({
                        'width' : back_w - diff,
                        'height': back_w - diff,
                    });

                    $(this).find('canvas').css({
                        'width' : chart_w - diff,
                        'height': chart_w - diff,
                    });

                    $(this).parents('.wbc-pie-chart').css({
                        'width' : chart_w - diff,
                        'height': chart_w - diff,
                    });
                }else if($(this).parents('.wbc-pie-chart').width() < $(this).attr('data-orginal-width') && $(this).parents('.wbc-chart-wrap').width() > $(this).attr('data-orginal-width')){
                    $(this).find('.percent-backing').css({
                        'width' : $(this).attr('data-backing-width'),
                        'height': $(this).attr('data-backing-width'),
                    });

                    $(this).find('canvas').css({
                        'width' : $(this).attr('data-orginal-width'),
                        'height': $(this).attr('data-orginal-width'),
                    });

                    $(this).parents('.wbc-pie-chart').css({
                        'width' : $(this).attr('data-orginal-width'),
                        'height': $(this).attr('data-orginal-width'),
                    });
                }
            });  
        },
        init_charts = function() {
            $('.wbc-pie-chart .chart-start').each(function() {

                var window_pos     = $(window).scrollTop(),
                    this_pos       = $(this).offset().top,
                    win_h          = $(window).height();

                $(this).attr('data-orginal-width',$(this).parents('.wbc-pie-chart').width());
                $(this).attr('data-backing-width',$(this).find('.percent-backing').width());
                    if(!$(this).hasClass('inited-chart')){
                        $(this).addClass('inited-chart');
                        resize_charts();
                    }
                if (window_pos + win_h / 2 > (this_pos - 200)) {
                    $(this).easyPieChart({
                        easing: 'easeOutBounce',
                        scaleColor: false,
                        onStep: function(from, to, percent) {
                            $(this.el).find('.percent').text(Math.round(percent));
                        }
                    }).removeClass('chart-start');
                }

            });
        };

        init_charts();
        $(window).bind('load scroll', init_charts);

        $(window).bind('resize', resize_charts);
    }


    function initWbcProgress() {
        var init_progress = function() {
            $('.wbc-progress-wrap.init-progress').each(function() {

                var window_pos     = $(window).scrollTop(),
                    this_pos       = $(this).offset().top,
                    win_h          = $(window).height();

                if (window_pos + win_h / 2 > (this_pos - 200)) {
                    var progress = ($(this).find('.wbc-progress').data('percent')) ? $(this).find('.wbc-progress').data('percent') : 0;
                    $(this).find('.wbc-progress').animate(
                        {
                            width : progress +'%'
                        },
                        {
                            duration: 'slow',
                            step: function (now, fx) {
                              $(this).parents('.wbc-progress-wrap').find('.wbc-progress-percent').html(parseInt(now) + '%');
                            }
                        }
                    );
                    
                    $(this).removeClass('init-progress');
                }

            });
        };
        init_progress();
        $(window).bind('load scroll', init_progress);
    }

    function initTestimonials() {
        $('.wbc-testimonail-carousel').each(function() {
            var wbcCarousel = $(this),
                wbcHeight = (wbcCarousel.data('item-height')) ? wbcCarousel.data('item-height') : 'variable',
                wbcScroll = (wbcCarousel.data('item-scroll') && $.isNumeric(wbcCarousel.data('item-scroll'))) ? wbcCarousel.data('item-scroll') : 1,
                wbcMin = (wbcCarousel.data('item-min') && $.isNumeric(wbcCarousel.data('item-min'))) ? wbcCarousel.data('item-min') : 1,
                wbcSpeed = (wbcCarousel.data('item-speed') && $.isNumeric(wbcCarousel.data('item-speed'))) ? wbcCarousel.data('item-speed') : 7000,
                wbcMax = (wbcCarousel.data('item-max') && $.isNumeric(wbcCarousel.data('item-max'))) ? wbcCarousel.data('item-max') : 1;

            wbcCarousel.imagesLoaded(function() {
                wbcCarousel.carouFredSel({
                    responsive: true,
                    height: wbcHeight,
                    width: '100%',
                    prev: wbcCarousel.parents('.wbc-testimonial-wrap').find('.carousel-prev'),
                    next: wbcCarousel.parents('.wbc-testimonial-wrap').find('.carousel-next'),
                    swipe: {
                        onMouse: true,
                        onTouch: true,
                    },
                    scroll: {
                        items: 1,
                        duration: 500
                    },
                    items: {
                        // width: wbcWidth,
                        // height: 'auto',
                        // visible: {
                        //     min: wbcMin,
                        //     max: wbcMax
                        // }
                    },
                    auto: {
                        timeoutDuration: wbcSpeed,
                    }

                });
            });

        });

    }

    function initClientLogos() {

            $('.wbc-logo-carousel').each(function() {
                var wbcCarousel = $(this),
                    wbcWidth = (wbcCarousel.data('item-width') && $.isNumeric(wbcCarousel.data('item-width'))) ? wbcCarousel.data('item-width') : 220,
                    wbcScroll = (wbcCarousel.data('item-scroll') && $.isNumeric(wbcCarousel.data('item-scroll'))) ? wbcCarousel.data('item-scroll') : 1,
                    wbcMin = (wbcCarousel.data('item-min') && $.isNumeric(wbcCarousel.data('item-min'))) ? wbcCarousel.data('item-min') : 1,
                    wbcMax = (wbcCarousel.data('item-max') && $.isNumeric(wbcCarousel.data('item-max'))) ? wbcCarousel.data('item-max') : 5;

                wbcCarousel.imagesLoaded(function() {

                    wbcCarousel.carouFredSel({
                        responsive: true,
                        width: '100%',
                        prev: wbcCarousel.parents('.wbc-logo-wrap').find('.logo-prev'),
                        next: wbcCarousel.parents('.wbc-logo-wrap').find('.logo-next'),
                        swipe: {
                            onMouse: true,
                            onTouch: true,
                        },
                        scroll: {
                            items: wbcScroll,
                            duration: 500
                        },
                        items: {
                            width: wbcWidth,
                            height: 'auto',
                            visible: {
                                min: wbcMin,
                                max: wbcMax
                            }
                        },
                        auto: {
                            timeoutDuration: 7000,
                        }

                    });
                });

            });

        }
        /**
         * Image MouseOver affect
         */
    function mouseOvers() {

        $(document).on('click', '.wbc907-mobile-device .wbc-image-wrap .item-link-overlay:not(.mobile-hover)', function(event){
            event.preventDefault();
            $('.wbc907-mobile-device .wbc-image-wrap .item-link-overlay').removeClass('mobile-hover');
            $(this).addClass('mobile-hover');
        });

        $('.wbc-image-wrap').hover(function() {

            /*Get Center for Parent vs Icon location*/
            var parent_h = $(this).parent().height() / 2 - ($(this).find('.wbc-extra-links').height() / 2);


            $(this).find('.item-link-overlay').stop().animate({
                'opacity': '0.6'
            });
            $(this).find('.wbc-extra-links').stop().animate({
                'top': parent_h
            });

        }, function() {

            $(this).find('.item-link-overlay').stop().animate({
                'opacity': '0'
            });
            $(this).find('.wbc-extra-links').stop().animate({
                'top': '-100%'
            });

        });

        $('.gallery-item a[href$=".jpg"],.gallery-item a[href$=".png"]').has('img').attr('rel', 'prettyPhoto');

        $('.wbc-image-wrap a').has('img').removeAttr('data-photo-up');

        $("a[data-photo-up^='prettyPhoto']").prettyPhoto();
    }

    /**
     * Parallax Sections
     */
    function initParallaxSections() {
        $('.parallax-section').each(function() {
            var parallaxID = $(this).attr('id'),
                parallaxSP = $(this).data('parallax-speed');

            if (parallaxSP !== 0) {
                // $('#'+parallaxID).css({
                //     'background-attachment':'scroll',
                //     'background-position':'center center'
                // });
                $('#' + parallaxID).parallax('50%', parallaxSP);
            }

        });

        $(window).bind('load', initParallaxSections);
    }

    /**
     * Portfolio Grids
     */
    function initPortfolioGrids() {


            var $portfolioContainers = [];
            var $filters = [];

            var clearHeight;

            var initPortfolios = function() {

                    $('.wbc-portfolio-grid').each(function() {
                        $portfolioContainers.push($(this));

                        var id = $(this).attr('id').replace('gal', 'filter'),
                            filter = $(document).find('#' + id);

                        if (filter.attr('id')) {
                            $filters.push(filter);
                        } else {
                            $filters.push(null);
                        }

                    });

                    $.each($filters, function(index, object) {

                        if (object === null) return;
                        var $optionLinks = object.find('a');

                        $optionLinks.click(function(event) {

                            var selector = $(this).data('filter-gallery'),
                                parent_filter = $(this).parents('.wbc-filter');

                            parent_filter.find('li a.button').removeClass('selected');
                            $(this).addClass('selected');

                            if (selector != "all") {
                                selector = '.' + selector;
                            } else {
                                selector = '*';
                            }

                            $portfolioContainers[index].isotope({
                                filter: selector
                            });

                            initParallaxSections();

                            return false;
                        });
                    });

                    $.each($portfolioContainers, function(j) {
                        var $container = this;


                        var colWidth = function() {
                                var w = $container.outerWidth(),
                                    columnNum = 1,
                                    columnWidth = 0;

                                if (w > 1200) {
                                    columnNum = ($container.data('x-large-screen') && $.isNumeric($container.data('x-large-screen'))) ? $container.data('x-large-screen') : 5;
                                } else if (w > 800) {
                                    columnNum = ($container.data('large-screen') && $.isNumeric($container.data('large-screen'))) ? $container.data('large-screen') : 4;
                                } else if (w > 600) {
                                    columnNum = ($container.data('small-screen') && $.isNumeric($container.data('small-screen'))) ? $container.data('small-screen') : 3;
                                } else if (w > 400) {
                                    columnNum = ($container.data('x-small-screen') && $.isNumeric($container.data('x-small-screen'))) ? $container.data('x-small-screen') : 2;
                                }

                                columnWidth = (w / columnNum); //Changed - 0.5;

                                $container.find('.portfolio-item').each(function() {
                                    var $item = $(this),
                                        width = columnWidth;

                                    if ($item.find('img').hasClass('attachment-landscape')  || $item.find('img').hasClass('attachment-dbl-square')) {
                                        width = (columnNum > 1) ? width * 2 : width;

                                    }

                                    $item.css({
                                        width: width
                                    });

                                });

                                if($container.data('layout-type') == 'brick'){
                                    
                                    if($container.find('.portfolio-image-square').length > 0){
                                        var sq_width = $container.find('.portfolio-image-square').width(),
                                        space = $container.find('.portfolio-image-square').innerWidth();

                                        $container.find('.portfolio-image-square').css({
                                            height:sq_width
                                        });
                                        $container.find('.portfolio-item').each(function() {
                                            var $item = $(this);

                                        if ($item.find('img').hasClass('attachment-landscape')) {
                                            $item.css({
                                                height: (columnNum > 1) ? sq_width : 'auto'
                                            });

                                        }

                                        if ($item.find('img').hasClass('attachment-portrait')) {
                                            $item.css({
                                                height: (sq_width * 2) + (space - sq_width) 
                                            });

                                            $item.find('img').css({
                                                height: (sq_width * 2) + (space - sq_width) 
                                            });

                                        }


                                        if ($item.find('img').hasClass('attachment-dbl-square')) {
                                            $item.css({
                                                height: (columnNum > 1) ? (sq_width * 2) + (space - sq_width) : 'auto'
                                            });

                                            $item.find('img').css({
                                                height: (columnNum > 1) ? ((sq_width * 2) + (space - sq_width)) + 1 : 'auto'
                                            });

                                        }

                                        

                                        });
                                    }
                                    
                                }

                                return columnWidth;
                            },
                            initIso = function() {
                                if ($container.find('.portfolio-item').length < 1) return;
                                var $layoutMode = ($container.data('layout-type') ) ? $container.data('layout-type') : 'masonry';
                                if($layoutMode == 'brick'){
                                    $layoutMode = 'masonry';
                                }
                                $container.imagesLoaded(function() {
                                    $container.css('opacity', 1);
                                    $container.parent('.wbc-portfolio-wrapper').removeClass('portfolio-loading').find('.wbc-content-loader').hide();
                                    $container.isotope({
                                        layoutMode: $layoutMode,
                                        resizable: false,
                                        animationEngine: 'best-available',
                                        itemSelector: '.portfolio-item',
                                        masonry: {
                                            columnWidth: colWidth()
                                        }
                                    });

                                    $container.isotope('on', 'layoutComplete', function() {

                                        clearTimeout(clearHeight);

                                        clearHeight = setTimeout(function() {
                                            $container.css('opacity', 1);
                                            $container.parent('.wbc-portfolio-wrapper').css('height', '');
                                            $(window).trigger('isoResized');
                                        }, 10);

                                    });
                                });

                            };


                        initIso();
                        //$(window).on("debouncedresize", initIso);
                        $(window).resize(initIso).trigger('resize');

                    });
                };

            initPortfolios();

            var destroyPortfolios = function() {
                $.each($portfolioContainers, function(j) {
                    $container = this;

                    $container.isotope('reloadItems');

                });
            };

            //////////////////////
            $("body").on('click','.wbc-portfolio-wrapper.ajaxed .wbc-pagination a', function(event) {
                
                event.preventDefault();

                var post_id = $(this).attr("href").replace('#038;', '&');

                var parentID = '#' + $(this).parents('.wbc-portfolio-wrapper').attr('id');
                $(parentID).find('.wbc-pagination li span').removeClass('current');
                $(this).addClass('current');

                $(parentID).css('height', $(parentID).innerHeight() + "px").addClass('portfolio-loading').find('.portfolio-item').css('opacity', '0');
                $(parentID).find('.wbc-content-loader').show();
                $("html, body").animate({
                    scrollTop: $(parentID).offset().top - 100
                }, 1000);
                $(parentID).load(post_id + " " + parentID + ">*", function() {
                    //destroyPortfolios();
                    initPortfolios();
                    mouseOvers();
                    $(window).trigger('resize').trigger('reloadPlayers');

                });
            });
        } //END PORTFOLIO

    //BLOG
    function initBlogLayout() {
            var $blogContainers = [];

            var initBlogs = function() {

                $('.blog-style-3 > article').addClass('masonry-item');

                $('.blog-style-3').each(function() {
                    $blogContainers.push($(this));

                });

                $.each($blogContainers, function(j) {
                    var $container = this;


                    var colWidth = function() {
                            var w = $container.outerWidth(),
                                columnNum = 1,
                                columnWidth = 0;

                            if (w > 1200) {
                                columnNum = ($container.data('x-large-screen') && $.isNumeric($container.data('x-large-screen'))) ? $container.data('x-large-screen') : 5;
                            } else if (w > 800) {
                                columnNum = ($container.data('large-screen') && $.isNumeric($container.data('large-screen'))) ? $container.data('large-screen') : 4;
                            } else if (w > 600) {
                                columnNum = ($container.data('small-screen') && $.isNumeric($container.data('small-screen'))) ? $container.data('small-screen') : 3;
                            } else if (w > 400) {
                                columnNum = ($container.data('x-small-screen') && $.isNumeric($container.data('x-small-screen'))) ? $container.data('x-small-screen') : 2;
                            }

                            columnWidth = (w / columnNum) - 0.5;

                            $container.find('.masonry-item').each(function() {
                                var $item = $(this),
                                    width = columnWidth;

                                $item.css({
                                    width: width
                                });

                            });

                            return columnWidth;
                        },
                        initIsoBlog = function() {
                            if ($container.find('.masonry-item').length < 1) return;
                            var $layoutMode = ($container.data('layout-type')) ? $container.data('layout-type') : 'masonry';

                            $container.imagesLoaded(function() {
                                $container.css('opacity', 1);
                                $('.blog-style-3').css('opacity', 1);
                                $container.parent('.wbc-blog-post-wrapper').find('.wbc-content-loader').hide();
                                $container.isotope({
                                    layoutMode: $layoutMode,
                                    resizable: false,
                                    itemSelector: '.masonry-item',
                                    animationEngine: 'best-available',
                                    masonry: {
                                        columnWidth: colWidth()
                                    }
                                });

                                $container.isotope('on', 'layoutComplete', function() {

                                    // initParallaxSections();

                                });
                            });
                        };


                    initIsoBlog();
                    $(window).resize(initIsoBlog).trigger('resize');
                    // $(window).on("debouncedresize", initIsoBlog);

                });

                $('.flexslider').flexslider({
                    animation: "fade",
                    controlNav: false,
                    pauseOnHover: true
                });
            };

            initBlogs();

            var destroyBlogs = function() {
                $.each($blogContainers, function(j) {
                    $container = this;

                    $container.isotope('reloadItems');

                });
            };
            $('.wbc-blog-post-wrapper').find('.wbc-content-loader').hide();

            $("body").on("click",'.wbc-blog-post-wrapper.ajaxed .wbc-pagination a', function(event) {
                event.preventDefault();


                var post_id = $(this).attr("href").replace('#038;', '&');

                var parentID = '#' + $(this).parents('.wbc-blog-post-wrapper').attr('id');


                $(parentID).find('.wbc-content-loader').show();

                $("html, body").animate({
                    scrollTop: $(parentID).offset().top - 100
                }, 1000);

                $(parentID).find('.posts').css('opacity', 0);

                $(parentID).find('.wbc-content-loader').show();

                $(parentID).load(post_id + " " + parentID + ">*", function() {
                    //destroyBlogs();
                    $(parentID).find('.wbc-content-loader').hide();

                    initBlogs();

                    $('.flexslider').flexslider({
                        animation: "fade",
                        controlNav: false,
                        pauseOnHover: true
                    });

                    mouseOvers();
                    initParallaxSections();

                    $(parentID).find('.posts').css('opacity', 1);
                });
            });
            
            //LOAD MORE
            $("body").on("click",'.wbc-blog-post-wrapper.ajaxed .load-more a', function(event) {
                event.preventDefault();
                
                var post_id = $(this).attr("href").replace('#038;', '&');
                $(this).html('<i class="fa fa-spinner fa-spin"></i>');

                var parentID = '#' + $(this).parents('.wbc-blog-post-wrapper').attr('id');

                var $html = $('<div>'),
                $items;

                $html.load(post_id + " " + parentID + ">*", function() {

                    $items = $html.find('article');

                    $html.imagesLoaded(function(){
                        $html.remove();
                        var indexed = parentID.match(/[0-9 -()+]+$/);

                        if(indexed[0] && $(parentID).find('.posts').hasClass('blog-style-3')){
                            $blogContainers[indexed[0]].append($items).isotope('appended', $items).trigger('resize');
                            $(parentID).find('.load-more').html($html.find('.load-more a.button'));
                        }else{
                            $(parentID).find('.posts').append($items).trigger('resize');
                            $(parentID).find('.load-more').html($html.find('.load-more a.button'));
                        }
                        // initBlogs();
                        

                        $('.flexslider').flexslider({
                            animation: "fade",
                            controlNav: false,
                            pauseOnHover: true
                        });

                        mouseOvers();
                        initParallaxSections();

                        $(parentID).find('.posts').css('opacity', 1);
                    });
                });
            });


            $('.wbc-blog-post-wrapper.ajaxed').each(function() {
                var postWrap = $(this);
                postWrap.imagesLoaded(function() {
                    postWrap.find('.posts').css('opacity', 1);

                });
            });
        }
        //END BLOG
        $('.wbc-featured-sc .wbc-video-wrap').has('.wp-video').each(function(){
            var el    = $(this),
            vidWidth  = el.outerWidth(),
            vidHeight = el.outerHeight();

            el.find('video').attr('width','100%').attr('height','100%');
            
            el.find('.wp-video,.mejs-container').css({
                'width' : vidWidth,
                'height': vidHeight
            });
        
    });

    function initWbcPlayers(){

        var htmlMarkup = '<div class="wbc-video-container">{HTMLFRAME}</div><div class="wbc-video-overlay"></div><div class="wbc-video-loading"><i class="fa fa-spin fa-spinner"></i></div>';

        if($('.video-atts').length > 0  && !$('body').hasClass('wbc907-mobile-device') ){

            $('.wbc-image-wrap').has('.video-atts').addClass('wbc-video-atts');
            
            $('.wbc-image-wrap.wbc-video-atts').each(function(){
                if(!$(this).hasClass('wbc-init-player')){

                    var vidAtts = $(this).find('.video-atts'),
                    videoType   = vidAtts.attr('data-type'),
                    videoURL    = vidAtts.attr('data-url'),
                    videoID     = vidAtts.attr('data-id'),
                    videoMp4    = vidAtts.attr('data-mp4-url'),
                    videoWebm   = vidAtts.attr('data-webm-url'),
                    videoOgv    = vidAtts.attr('data-ogv-url');
                    
                    switch(videoType){
                        case 'vimeo':

                            var iframeHTML  = '<iframe id="{id}" src="https://player.vimeo.com/video/{video_url}?api=1&player_id={id}&badge=0&byline=0&title=0&portrait=0&loop=1" frameborder="0" class="wbc-video-player-frame" width="1200" height="720" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
                
                        break;

                        case 'youtube':

                            var iframeHTML  = '<iframe class="wbc-video-player-frame" width="1200" height="720" frameborder="0"  id="{id}" allowfullscreen="1" title="YouTube video player" src="https://www.youtube.com/embed/{video_url}?loop=1&rel=0&wmode=transparent&enablejsapi=1&showinfo=0&controls=0&html5=1" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';

                        break;

                        case 'HTML5':

                            var iframeHTML  = '<video id="{id}" class="wbc-video-player-frame" width="1200" height="720" preload="auto" loop>';
                            var hasUrl = false;
                            


                            if(videoMp4){
                                hasUrl = true;

                                iframeHTML  += '<source src="'+videoMp4+'" type="video/mp4">';
                            }

                            if(videoWebm){
                                hasUrl = true;

                                iframeHTML  += '<source src="'+videoWebm+'" type="video/webm">';
                            }

                            if(videoOgv){
                                hasUrl = true;

                                iframeHTML  += '<source src="'+videoOgv+'" type="video/ogg">';
                            }
                            if(hasUrl){
                                iframeHTML  += '</video>';
                            }else{
                                iframeHTML = "undefined";
                            }

                        break;
                    }

                    if( typeof iframeHTML === "undefined" ){
                        return true;
                    }

                    var playerHTML = iframeHTML.replace('{id}',videoID).replace('{id}',videoID).replace('{video_url}',videoURL);

                    var hold = htmlMarkup.replace('{HTMLFRAME}',playerHTML);

                    $(this).addClass('wbc-init-player '+videoType+'-bg').prepend(hold).trigger('resize');

                }
            });
        }

    }
    initWbcPlayers();

    $(window).bind('reloadPlayers',initWbcPlayers);
    $(window).bind('reloadPlayers',initPlayerState);

    function initPlayerState(){

        //YouTube
        var player,
        players = [];
        $('.wbc-image-wrap.youtube-bg').each(function(){
            var currentIframeID = $(this).find('iframe').attr('id');
            players[currentIframeID] = new YT.Player(currentIframeID);
        });

        $('.wbc-image-wrap.youtube-bg').hoverIntent({
            over: function(){
                var currentI = $(this).find('iframe').attr('id'),
                el = $(this);
                players[currentI].playVideo();
                players[currentI].addEventListener('onStateChange', function(state,id){
                    if(state.data == 1){
                        el.trigger('is_playing');
                    }

                    if(state.data == 0){
                        players[currentI].seekTo(0);
                    }
                });
            },
            out: function(){
                var currentI = $(this).find('iframe').attr('id');
                players[currentI].pauseVideo();

                $(this).trigger('is_paused');
            },
            interval: 200,
            sensitivity: 1
        });
        //Vimeo
        $('.wbc-image-wrap.vimeo-bg').hoverIntent({
            over: function(){
                var player = $(this).find('iframe'),
                el = $(this),
                froogaloop = $f(player[0].id);

                froogaloop.addEvent('ready', function() {
                    froogaloop.api('play');
                    froogaloop.addEvent('playProgress',function(data,id){
                        if(data.seconds > 0.2){
                            el.trigger('is_playing');
                            froogaloop.removeEvent('playProgress');
                        }
                    });
                });

            },
            out: function(){
                var player = $(this).find('.wbc-video-player-frame'),
                el = $(this),
                froogaloop = $f(player[0].id);
                froogaloop.api('pause');
                froogaloop.removeEvent('playProgress');

                el.trigger('is_paused');
            },
            interval: 200,
            sensitivity: 1
        });

        //HTML5
        $('.wbc-image-wrap.HTML5-bg').hoverIntent({
            over: function(){

                var htmlPlayer = $(this).find('video.wbc-video-player-frame'),
                html5Player = htmlPlayer.get(0),
                el = $(this);

                html5Player.play();
                el.trigger('is_playing');
                // html5Player.addEventListener('timeupdate', function(){
                //     if(html5Player.currentTime > .2){
                //         el.trigger('is_playing');
                //     }
                // });

            },
            out: function(){
                var htmlPlayer = $(this).find('video.wbc-video-player-frame'),
                html5Player = htmlPlayer.get(0),
                el = $(this);

                html5Player.pause();
                // html5Player.removeEventListener('timeupdate');

                el.trigger('is_paused');
            },
            interval: 200,
            sensitivity: 1
        });

        $('.wbc-portfolio-grid .wbc-image-wrap').on('is_playing',function(){
            $(this).parents('.portfolio-item').addClass('active-playing');
        });

        $('.wbc-portfolio-grid .wbc-image-wrap').on('is_paused',function(){
            $(this).parents('.portfolio-item').removeClass('active-playing');
        });
    }

    $(window).load(function(){
        initPlayerState();
    });

    // Resize Players
    function resizeit(){
        $('.wbc-image-wrap.wbc-init-player').each(function(){
            var $wbcPlayer = ($(this).hasClass('HTML5-bg')) ? $(this).find('video') : $(this).find('iframe');
            var win = {};
            win.width = $(this).outerWidth();
            win.height = $(this).outerHeight();
            var margin = 24;
            var extendSize = 90;
            var currentPlayer = {};
            currentPlayer.width = win.width + ( ( win.width * margin ) / 100 );
            currentPlayer.height = Math.ceil( ( 9 * win.width ) / 16 );
            currentPlayer.marginTop = -( ( currentPlayer.height - win.height ) / 2 );
            currentPlayer.marginLeft = -( ( win.width * ( margin / 2 ) ) / 100 );
            if( currentPlayer.height < win.height ) {
                    currentPlayer.height = win.height + ( ( win.height * margin ) / 100 );
                    currentPlayer.width = Math.floor( ( 16 * win.height ) / 9 );
                    currentPlayer.marginTop = -( ( win.height * ( margin / 2 ) ) / 100 );
                    currentPlayer.marginLeft = -( ( currentPlayer.width - win.width ) / 2 );
            }
            currentPlayer.width += extendSize;
            currentPlayer.height += extendSize;
            currentPlayer.marginTop -= extendSize / 2;
            currentPlayer.marginLeft -= extendSize / 2;
            $wbcPlayer.width(currentPlayer.width).height(currentPlayer.height).css({left: currentPlayer.marginLeft, top: currentPlayer.marginTop});
        });

    }
    resizeit();
    $(window).bind('resize isoResized',resizeit);

    //END VIDEO PORTFOLIO

    function initElasticMenu() {

        var initElastic = function() {

            var shrinkTo = $(".header-bar").data('scroll-height'),
                menuHeight = $(".header-bar").data('menu-height');


            if ($(".header-bar").hasClass('elastic-enabled')) {

                if (($(".large-header .menu-bar-wrapper").hasClass('is-sticky') && $(window).scrollTop() > 100) || ($(".large-header.bottom-fixed-menu .menu-bar-wrapper").length > 0 && $(".large-header.bottom-fixed-menu .menu-bar-wrapper").hasClass('is-sticky')) || ($(".large-header.standard-menu .menu-bar-wrapper").length > 0 && $(".large-header.standard-menu .menu-bar-wrapper").hasClass('is-sticky'))) {
                    $('.elastic-enabled .header-inner').stop().animate({
                        'min-height': shrinkTo
                    }, 200);

                    $('.elastic-enabled .site-logo-title:not(.has-logo), .elastic-enabled .primary-menu .wbc_menu > li').stop().animate({
                        'line-height': shrinkTo
                    }, 200);

                    $('.elastic-enabled .site-logo-title.has-logo').stop().animate({
                        'height': shrinkTo
                    }, 200);

                    $(".header-bar").removeClass('large-header').addClass('small-header');

                } else if (($(window).scrollTop() < 100 && $(".header-bar.elastic-enabled.small-header") && !$(".menu-bar-wrapper").hasClass('is-sticky')) || ($(".small-header.bottom-fixed-menu .menu-bar-wrapper,.small-header.standard-menu .menu-bar-wrapper").length > 0 && !$(".small-header.standard-menu .menu-bar-wrapper,.small-header.bottom-fixed-menu .menu-bar-wrapper").hasClass('is-sticky'))) {

                    $('.elastic-enabled .header-inner').stop().animate({
                        'min-height': menuHeight
                    }, 100);

                    $('.elastic-enabled .site-logo-title:not(.has-logo), .elastic-enabled .primary-menu .wbc_menu > li').stop().animate({
                        'line-height': menuHeight
                    }, 100);

                    $('.elastic-enabled .site-logo-title.has-logo').stop().animate({
                        'height': menuHeight
                    }, 100);

                    $(".header-bar").removeClass('small-header').addClass('large-header');

                }
            }
            initSticky();
        };

        initElastic();
        $(window).scroll(initElastic);
        $(window).bind('resize', initElastic);
    }

    /**
     * [initSticky description]
     * @return {[type]} [description]
     */
    function initSticky() {

        if ($('.bottom-fixed-menu').hasClass('elastic-enabled') && $('.menu-bar-wrapper').hasClass('is-sticky')) {

            if ($('.menu-bar-wrapper').offset().top == $(window).scrollTop() && ($(window).scrollTop() - $(window).height()) < -100) {
                if ($('.menu-bar-wrapper.is-sticky').css('position') == 'fixed') {
                    // $('.menu-bar-wrapper.is-sticky').attr('style','');
                }
            }
        }

    }

    function updateMenus() {

        var updateMenu = function() {
            if ($('.bottom-fixed-menu').length > 0 && !$('.bottom-fixed-menu').hasClass('wbc-sticky')) {
                $('.bottom-fixed-menu').addClass('no-sticky');

                if (($('.bottom-fixed-menu.no-sticky').offset().top - 100) < $(window).scrollTop()) {
                    $('.bottom-fixed-menu.no-sticky').addClass('wbc-menu-down');
                } else {
                    $('.bottom-fixed-menu.no-sticky').removeClass('wbc-menu-down');
                }
            }
        };

        updateMenu();
        $(window).scroll(updateMenu);
        $(window).resize(updateMenu);
    }

    function initCounters() {

        var init_counts = function() {
            $('.wbc-countup.count-start').each(function() {

                var window_pos = $(window).scrollTop(),
                    this_pos = $(this).offset().top,
                    win_h = $(window).height(),
                    delime = $(this).data('delimiter');

                if (window_pos + win_h / 2 > (this_pos - 200)) {
                    $(this).removeClass('count-start').countTo({
                        formatter: function(value, options) {

                            value = value.toFixed(options.decimals);

                            if (typeof delime != 'undefined') {
                                value = value.replace(/\B(?=(\d{3})+(?!\d))/g, delime);
                            }

                            return value;
                        }
                    });
                }

            });
        };

        $(window).bind('load scroll', init_counts);
    }

    /**
     * Hover colors
     */
    function wbc_color_hover() {
        var parent_team_row;
        $('.wbc-team-box').hover(function() {
            parent_team_row = $(this).parents('.wpb_row');
            $(this).addClass('member-hovered');
            parent_team_row.find('.wbc-team-box:not(.member-hovered)').stop().animate({
                'opacity': '0.5'
            });

        }, function() {

            $(this).removeClass('member-hovered');
            parent_team_row.find('.wbc-team-box').stop().animate({
                'opacity': '1'
            });

        });

        var btn_style;
        $('.wbc-button').hover(function() {
            var hover_color = $(this).data('hover-bg'),
                hover_border_color = $(this).data('hover-border'),
                hover_text_color = $(this).data('hover-text');

            btn_style = $(this).attr('style');

            if (!btn_style) {
                btn_style = '';
            }
            $(this).css({
                'background-color': hover_color,
                'border-color': hover_border_color,
            });

            if (hover_text_color) {
                $(this).attr('style', $(this).attr('style') + 'color:' + hover_text_color + ' !important');
            }

        }, function() {

            $(this).attr('style', btn_style);


        });

        //VC FrontEnd Editor
        if( window.location.href.match(/vc_editable=true/) ){
            window.wbcFrontEditor = function(){
                initTestimonials();
                initClientLogos();
                initPortfolioGrids();
                mouseOvers();
                wbc_color_hover();
                initCounters();
                initParallaxSections();
                initBannerCarouFred();
                initBlogLayout();
                initWbcCharts();
                wbcEqHeight();
                initWbcProgress();
            };
        }   


        var wrapper_style,
            icon_style;
        $('.wbc-icon-wrapper[data-custom-hover="1"]').hover(function() {
            var hover_outline_color = $(this).data('hover-outline-color');

            wrapper_style = $(this).attr('style');

            if (!wrapper_style) {
                wrapper_style = '';
            }
            $(this).css({
                'border-color': hover_outline_color,
            });

            var icon_holder        = $(this).find('.wbc-icon'),
                color_hover        = icon_holder.data('hover-color'),
                bg_color_hover     = icon_holder.data('hover-bg-color'),
                border_color_hover = icon_holder.data('hover-border-color');

            icon_style = icon_holder.attr('style');

            if (!icon_style) {
                icon_style = '';
            }
            icon_holder.css({
                'color': color_hover,
                'background-color': bg_color_hover,
                'border-color' : border_color_hover
            });

        }, function() {

            $(this).attr('style', wrapper_style);
           
            $(this).find('.wbc-icon').attr('style', icon_style);


        });


        
    }

    function wbcEqHeight(){
        $('.wbc-eq-height').each(function() {
            $(this).children('.wpb_column').matchHeight({
                byRow: false
            }).addClass('eq-height-column');
        });

        $('.wbc-eq-height .row-inner').each(function() {
            $(this).children('.wpb_column').matchHeight({
                byRow: false
            }).addClass('eq-height-column');
        });
    }

    if ($(".header-bar").data('menu-height') < $('.menu-bar-wrapper').height()) {
        $(".header-bar").data('menu-height', $('.menu-bar-wrapper').height());
    }

    initTestimonials();
    initClientLogos();
    initSticky();
    initPortfolioGrids();
    mouseOvers();
    wbc_color_hover();
    initCounters();
    initParallaxSections();
    initBannerCarouFred();
    initBlogLayout();
    initElasticMenu();
    initWbcCharts();
    wbcEqHeight();
    initWbcProgress();

    if(typeof WOW != 'undefined'){
        new WOW().init();
    }else{
        $(window).bind('load',function(){
            if(typeof WOW != 'undefined'){
                new WOW().init();
            }
        });
    }

    $('a:has(.wbc-icon)').each(function() {
        var URL = $(this).attr('href');

        var checkURL = URL.match(/#([^\/]+)$/i);

        if (checkURL && $(checkURL[0] + '.anchor-link').length > 0) {
            $(this).addClass('scrollable');
        }

    });

    $(window).load(function() {
        if ($(".header-bar").data('menu-height') < $('.menu-bar-wrapper').height()) {
            $(".header-bar").data('menu-height', $('.menu-bar-wrapper').height());
            initElasticMenu();
        }

        var minW = 1400,
            vidW = 1280,
            vidH = 720,
            vidR = 1280 / 720;


        function nzsResizeVideoBG() {

            $('.video-section.self-hosted .wbc-video-bg').each(function() {


                var parentH = $(this).parents('.video-section').outerHeight();
                var parentW = $(this).parents('.video-section').outerWidth();

                $(this).width(parentW);
                $(this).height(parentH);

                var hScale = parentW / vidW;
                var yScale = (parentH - parentH) / vidH;
                var rScale = (hScale > yScale) ? hScale : yScale;

                minW = vidR * (parentH + 45);

                if (rScale * vidW < minW) rScale = minW / vidW;

                $(this).find('embed,video, .mejs-overlay, .mejs-poster,.mejs-video,.video-background').width(Math.ceil(rScale * vidW + 45));
                $(this).find('embed,video, .mejs-overlay, .mejs-poster,mejs-video,.video-background').height(Math.ceil(rScale * vidH + 45));

                $(this).scrollLeft(($(this).find('video').width() - parentW) / 2);
                $(this).scrollTop(($(this).find('video').height() - parentH) / 2);

                $(this).find('.mejs-overlay, .mejs-poster').scrollTop(($(this).find('video').height() - parentH) / 2);

                $(this).animate({
                    'opacity': '1'
                }, 800, 'easeInOutQuad');
            });
        }

        if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {

            $('.mobile-video-image').show();
            $('.wbc-video-bg').remove();

        } else {

            if ($('.video-section.self-hosted .wbc-video-bg').length > 0) {

                $('.self-hosted .mobile-video-image').remove();

                $('.self-hosted.wbc-video-bg .video-background').mediaelementplayer({
                    enableKeyboard: false,
                    iPadUseNativeControls: false,
                    pauseOtherPlayers: false,
                    iPhoneUseNativeControls: false,
                    AndroidUseNativeControls: false
                });

            }

            nzsResizeVideoBG();

            $(window).bind('load', nzsResizeVideoBG);
            $(window).bind('resize', nzsResizeVideoBG);
        }

        $('.flexslider').flexslider({
            animation: "fade",
            controlNav: false,
            pauseOnHover: true
        });


    });

    /************************************************************************
     * Maps
     *************************************************************************/

    $('.wpb_gmaps_widget iframe').each(function() {

        $('.wpb_gmaps_widget .wpb_wrapper').css('padding', 0);

        $(this).css({
            'margin': '-150px 0 -150px 0',
            'height':  $(this).height() + 300,
        }).parent().css({
            'position': 'relative',
            'overflow': 'hidden'
        }).prepend('<div class="map-click-fix"></div>');

        $(this).parent().find('.map-click-fix').css({
            'position': 'absolute',
            'top': 0,
            'left': 0,
            'width': '100%',
            'height': '100%',
            'background-color': 'transparent'

        });
    });

    $('.map-click-fix').click(function() {
        $(this).hide().parent().addClass('map-click-hidden');
    });


    /************************************************************************
     * Header Bar
     *************************************************************************/

    /**
     * INIT STICKY
     */
    $(".wbc-sticky .menu-bar-wrapper").sticky({
        topSpacing: 0,
        wrapperClassName: 'sticky-menu'
    });

    $('.elastic-enabled').addClass('large-header');


    updateMenus();

    /************************************************************************
     * New Menu 
     *************************************************************************/
    $('.menu-icon').click(function() {

        if ($('.mobile-menu .menu-icon').hasClass('menu-open')) {

            $('.primary-menu').removeAttr('style').hide();
            $('.mobile-menu .menu-icon').removeClass('menu-open');

        } else {

            $('.primary-menu').show();
            $('.mobile-menu .menu-icon').addClass('menu-open');



            if ($('.primary-menu').height() > $(window).height()) {
                var setHeight = $(window).height();

                if ($('.header-bar').hasClass('wbc-sticky') && !$('.menu-bar-wrapper').hasClass('is-sticky')) {
                    if ($('.header-bar').position().top > 0) {
                        setHeight = Math.round($(window).height() - (($('.header-bar').position().top - $(window).scrollTop()))); //($(window).scrollTop() - $(window).height()) - ($('.menu-bar-wrapper').height() -300);
                    } else {
                        setHeight = ($(window).height() - $('.menu-bar-wrapper').height()) + 100;
                    }
                }
                setHeight = setHeight - 100;

                $('.primary-menu').css({
                    height: setHeight,
                    'overflow-y': 'scroll',
                });

            } //IF Menu is taller than screen

        }

        return false;

    });

    $(window).resize(function() {


        if ($('.menu-icon').css('display') == 'block') {

            $('.primary-menu').addClass('mobile-show');
        } else {
            $('.primary-menu').removeClass('mobile-show');
        }

        if ($('.mobile-menu .menu-icon').css('display') == 'none') {

            $('.primary-menu').removeAttr('style');

            $('.mobile-menu .menu-icon').removeClass('menu-open');

        }

    });

    //END NEW MENU
    //
    $('.wbc_menu li a,a.scrollable,.wbc_footer_menu li a').click(function(e) {


        if ($('.mobile-menu .menu-icon').hasClass('menu-open')) {

            $('.primary-menu').hide();
            $('.mobile-menu .menu-icon').removeClass('menu-open');

        }

        var menuHeight = $('.header-bar .menu-bar-wrapper').height();
        var content = $(this).attr('href');
        var checkURL = content.match(/#([^\/]+)$/i);


        if ($('.header-bar').hasClass('elastic-enabled')) {
            menuHeight = $(".header-bar").data('scroll-height');
        }

        if (!$('.header-bar').hasClass('wbc-sticky')) {
            menuHeight = 0;
        }


        if (checkURL && $(checkURL[0] + '.anchor-link').length > 0) {
            // && $('body').hasClass('full-width-template') 
            e.preventDefault();
            var goPosition = $(checkURL[0]).offset().top - (menuHeight - 14);

            $('html,body').animate({
                scrollTop: goPosition
            }, 1000);

        }

    });


    var lastId, topMenu = $("#wbc9-main"),
        topMenuHeight = topMenu.outerHeight() + 200,
        menuItems = topMenu.find('a');

    var scrollItems = menuItems.map(function() {

        var content = $(this).attr("href");

        if (content) {
            var checkURL = content.match(/#([^\/]+)$/i);

            if (checkURL && checkURL[0].length > 2 && $(checkURL[0] + '.anchor-link').length > 0) {
                var item = $(checkURL[0]);
                if (item.length) return item;
            }
        }

    });


    $(window).scroll(function() {
        var fromTop = $(this).scrollTop() + topMenuHeight;
        var cur = scrollItems.map(function() {
            if ($(this).offset().top < fromTop) return this;
        });
        cur = cur[cur.length - 1];
        var id = cur && cur.length ? cur[0].id : "";
        if (lastId !== id) {
            lastId = id;
            if (!id) {
                menuItems.parent().removeClass("active");
            } else {
                menuItems.parent().removeClass("active").end().filter("[href*='#" + id + "']").parent().addClass("active");
            }

        }
    });


    $(window).load(function() {

        var menuHeight = $('.header-bar .menu-bar-wrapper').height();
        var content = window.location.href;
        var checkURL = content.match(/#([^\/]+)$/i);


        if ($('.header-bar').hasClass('elastic-enabled')) {
            menuHeight = $(".header-bar").data('scroll-height');
        }

        if (!$('.header-bar').hasClass('wbc-sticky')) {
            menuHeight = 0;
        }


        if (checkURL && $(checkURL[0] + '.anchor-link').length > 0) {

            setTimeout(function() {
                var goPosition = $(checkURL[0]).offset().top - (menuHeight - 14);

                $('html,body').animate({
                    scrollTop: goPosition
                }, 1000);

            }, 100);

        }
    });

    function resizeSection() {
        var w_height = $(window).height();
        $('.full-height').css({
            // 'height' : w_height+"px",
            'min-height': w_height + "px",
        }).attr('data-section-height', w_height + "px");

        $('.full-height .wbc-table-align').css({
            'min-height': $('.wbc-table-align').parents('.vc_row').attr('data-section-height'),
            'height': $('.wbc-table-align').parents('.vc_row').attr('data-section-height')
        });

    }

    resizeSection();

    $(window).bind('resize', resizeSection);
    $(window).bind('load', resizeSection);

    $(window).on('debouncedresize', initParallaxSections);


    $(window).load(function() {
        $(window).trigger('resize').trigger('scroll');
    });

})(jQuery);