;(function($) {

    "use strict";

    var etTheme = {
        init: function() {
            this.nanoScroll();
            this.fragmentsRefresh();
            this.affixJSInit();
            this.onePageMenu();
            this.configureHeightAndWidth();
            this.breadcrumbs();
            this.fixedHeader();
            this.mediaelementplayer();
            this.windowsPhoneFix();
            this.popup();
            this.searchPopup();
            this.imagesLightbox();
            this.loadInView();
            this.cleanSpaces();
            this.contentProdImages();
            this.wishlist();
            this.mainNavigation();
            this.backToTop();
            this.portfolio();
            this.isotope();
            this.testimonials();
            this.woocommerce();
            this.productsViewMode();
            this.checkViewMode();
            this.ajaxAddToCartInit();
            this.quickView();
            this.searchform();
            this.tabs();
            this.categoriesAccordion();
            this.toggles();
            this.closeParentBtn();
            this.contactForm();
            this.commentsForm();
            this.mobileMenu();
        },

        newJqueryMethods: function() {
            // **********************************************************************//
            // ! Force Full width element
            // **********************************************************************//
            jQuery.fn.etFullWidth = function ( options ) {
                //var settings = $.extend({
                //    type: "default"
                //}, options );

                var $this = jQuery(this);

                var extraPadding = 15;
                var extraMargin = 0;

                if(jQuery('body').hasClass('header-vertical-enable') && jQuery(window).width() > 979) {
                    extraMargin = jQuery('.header-type-vertical').outerWidth();
                }

                $this.css({
                    'left': -jQuery('.header > .container').offset().left-extraPadding+extraMargin,
                    'width': jQuery(window).width()-extraMargin,
                    'visibility': 'visible'
                });

                jQuery(window).resize(function(){
                    if(jQuery(window).width() < 980) {
                        extraMargin = 0;
                    }
                    $this.css({
                        'left': -jQuery('.header > .container').offset().left-extraPadding+extraMargin,
                        'width': jQuery(window).width()-extraMargin,
                        'visibility': 'visible'
                    });
                });

                return this;
            }

            // **********************************************************************//
            // ! Force 100% heigh element
            // **********************************************************************//
            jQuery.fn.etFullHeight = function ( options ) {
                //var settings = $.extend({
                //    type: "default"
                //}, options );

                var $this = jQuery(this);


                $this.css({
                    'min-height': jQuery(window).height()
                });

                jQuery(window).resize(function(){
                    $this.css({
                        'min-height': jQuery(window).height()
                    });
                });

                return this;
            }

        },

        nanoScroll: function() {
            var scrollWidget = $('.shop-filters-area .sidebar-widget');
            scrollWidget.each(function() {
                var content = $(this).find('> ul, > div, > form');
                if(content.height() > 260) {
                    $(this).addClass('nano-scroll-apply');
                    content.addClass('widget-content');
                    $(this).nanoScroller({
                        contentClass: 'widget-content',
                        preventPageScrolling: true
                    });
                }
            });
        },

        fragmentsRefresh: function() {
            // **********************************************************************//
            // ! Update cart fragments
            // **********************************************************************//
            $.ajax( {
                url: etConfig.ajaxurl,
                type: 'POST',
                data: { action: 'et_refreshed_fragments' },
                success: function( data ) {
                    if ( data && data.fragments ) {
                        $.each( data.fragments, function( key, value ) {
                            $( "." + key ).replaceWith( value );
                        });
                    }
                }
            } );
        },
        affixJSInit: function() {
            etTheme.affixJS();

        },




        affixJS: function() {

            if($(window).width() < 992) return;

            $('.fixed-product-block').each(function() {
              var el = $(this),
                  parent = el.parent(),
                  heightOffsetEl = $('.product-images'),
                  parentHeight = heightOffsetEl.outerHeight();

                  if( parent.outerHeight() > parentHeight) return;
                  
                  $(window).resize(function() {
                    parentHeight = heightOffsetEl.outerHeight();
                    el.css('max-width', parent.width());
                    parent.height(parentHeight);
                  });

              $(window).resize();

              $(this).stick_in_parent();

            });
        },

        onePageMenu: function() {
            // **********************************************************************//
            // ! One page hash navigation
            // **********************************************************************//

            // Click on menu item with hash
            var menu = $('.menu');
            menu.each(function() {
                var that = $(this);
                var links = $(this).find('a');
                if(!that.parent().hasClass('one-page-menu')) return;
                links.click(function(e){
                    if($(this).attr('href').split('#')[0] == window.location.href.split('#')[0]) {
                        e.preventDefault();
                        var hash = $(this).attr('href').split('#')[1];

                        changeActiveItem(hash);
                        scrollToId(hash);
                    }
                });
            });

            $('[data-scroll-to]').click(function() {
                var hash = $(this).attr('data-scroll-to');
                changeActiveItem(hash);
                scrollToId(hash);
            });

            // if loaded page with hash
            var windowHash = window.location.hash.split('#')[1];

            if(window.location.hash.length > 1) {
                setTimeout(function(){
                    scrollToId(windowHash);
                }, 600);
            }

            function scrollToId(id){
                var offset = 130;
                var position = 0;

                if(id != 'top'){
                    if($('[data-anchor="'+id+'"]').length < 1) {
                        return;
                    }
                    position = $('[data-anchor="'+id+'"]').offset().top - offset;
                }


                if($(window).width() < 992) {
                    $('body').removeClass('show-nav');
                }

                $('html, body').stop().animate({
                    scrollTop: position
                }, 1000, function() {
                    changeActiveItem(id);
                });
            }

            function changeActiveItem(hash) {
                var itemId;
                var menu = $('.menu');
                if(!menu.parent().hasClass('one-page-menu')) return;

                menu.find('.current-menu-item').removeClass('current-menu-item');

                if(hash == 'top') {
                    menu.each(function() {
                        $(this).find('li').first().addClass('current-menu-item');
                    });
                    return;
                }

                menu.find('li').each(function() {
                    if($(this).find('>a').attr('href')) {
                        var thisHash = $(this).find('>a').attr('href').split('#')[1];
                        if(thisHash == hash) {
                            itemId = $(this).attr('id');
                        }
                    }
                });

                $('.'+itemId).addClass('current-menu-item');
            }


            $(window).scroll(function() {
                if($(window).scrollTop() < 200) {
                    changeActiveItem('top');
                }
            });

            // change active link on scroll
            $('[data-anchor]').waypoint(function() {
                var id = $(this).attr('data-anchor');
                changeActiveItem(id);
            }, { offset: 150 });

        },
        configureHeightAndWidth: function() {
            // **********************************************************************//
            // ! 100% height
            // **********************************************************************//
            $('.full-height').etFullHeight();
            $('.st-pusher').etFullHeight();

            $(window).resize(function() {
                $('.copyright-bottom').css({
                    'marginTop': -$('.copyright-bottom').height(),
                    'marginBottom': 0
                }).prev().css({
                    'paddingBottom': $('.copyright-bottom').height()+20
                });
            });

            $('.cta-block.style-fullwidth').etFullWidth();
            $('.element-full-width').etFullWidth();
        },
        breadcrumbs: function() {
            // **********************************************************************//
            // ! Breadcrumbs
            // **********************************************************************//

            /*$('.bc-type-8').css({
                'marginTop': - $('.header-wrapper').outerHeight()
            });*/


            // **********************************************************************//
            // ! Parallax Breadcrumbs
            // **********************************************************************//
            if($(window).width() > 1200) {
                $(function() {
                    var data0 = 'opacity:1;-webkit-transform: scale(1);-moz-transform: scale(1);transform: scale(1);';
                    var data300 = 'opacity:0.3;-webkit-transform: scale(0.8);-moz-transform: scale(0.8);transform: scale(0.8);';
                    $('.bc-type-7, .bc-type-8').find('.container').attr('data-0', data0).attr('data-300', data300);
                    var s = skrollr.init();
                });
            };

        },

        headerHeight: function(action) {
            // **********************************************************************//
            // ! Page wrapper offset for fixed header
            // **********************************************************************//

            if(action == 'unset') {
                $('.fixNav-enabled .page-wrapper').attr('style', '');
                $('.fixNav-enabled .header-wrapper').attr('style', '');
                return;
            }

            $('.fixNav-enabled .page-wrapper').css('padding-top', $('.header-wrapper').height());
            $('.fixNav-enabled .header-wrapper').css('position', 'absolute');

            $(function() {
                $('.fixNav-enabled.breadcrumbs-type-7 .page-wrapper').css('padding-top', $('.header-wrapper').height());
            });
        },

        fixedHeader: function() {

            // **********************************************************************//
            // ! Fixed header
            // **********************************************************************//

            if($(window).width() > 1200) {
                var fixedHeader = (function() {

                    if(!$('body').hasClass('fixNav-enabled')) return;

                    var docElem = document.documentElement,
                        wrapper = document.querySelector( '.template-content' ),
                        didScroll = false,
                        changeHeaderOn = $('.header-wrapper').height()+100;

                    if($('.header-wrapper').hasClass('header-vertical')) {
                        changeHeaderOn = 300;
                    }
                    if($('.home .header-wrapper').hasClass('header-type-9')) {
                        changeHeaderOn = $(window).height();
                    }

                    function init() {
                        window.addEventListener( 'scroll', function( event ) {
                            if( !didScroll ) {
                                didScroll = true;
                                setTimeout( scrollPage, 250 );
                            }
                        }, false );
                    }

                    function scrollPage() {
                        var sy = scrollY();                      

                        if ( sy >= changeHeaderOn ) {
                            if(!$('.template-content').hasClass('fixed-active') && (!$('.header-wrapper').hasClass('slider-overlap') || $('body').hasClass('breadcrumbs-type-9') || $('body').hasClass('breadcrumbs-type-default')) )
                            etTheme.headerHeight('set');
                            classie.add( wrapper, 'fixed-active' );
                            setTimeout( function() {
                                classie.add( wrapper, 'fixed-active-animate' );
                            },250);
                        }
                        else {
                            classie.remove( wrapper, 'fixed-active' );
                            classie.remove( wrapper, 'fixed-active-animate' );
                            etTheme.headerHeight('unset');
                        }
                        didScroll = false;
                    }

                    function scrollY() {
                        return window.pageYOffset || docElem.scrollTop;
                    }

                    init();

                })();

                $(function() {
                     if ($('.home .header-wrapper').hasClass('header-vertical')  || $('.home .header-wrapper').hasClass('header-type-9') ) {
                     $('.page-wrapper').css('padding-top', 0);
                     }
                });
                $(function() {
                    $('.fixed-icon').click(function() {
                        $('.template-content').toggleClass('show-fixed');
                        return false;
                    });
                });
                $(document).click(function(e) {
                    var target = e.target;
                    if (!$(target).is('.header-wrapper') && !$(target).parents().is('.header-wrapper')) {
                        $('.template-content').removeClass('show-fixed');
                    }
                });
            }

        },
        mediaelementplayer: function() {
            // **********************************************************************//
            // ! Media Elements with JS
            // **********************************************************************//

            $('video:not(.et-section-video, .tp-caption video)').mediaelementplayer({
                success: function(player, node) {
                    $('#' + node.id + '-mode').html('mode: ' + player.pluginType);
                }
            });
        },
        windowsPhoneFix: function() {
            // **********************************************************************//
            // ! Windows Phone Responsive Fix
            // **********************************************************************//
            if ("-ms-user-select" in document.documentElement.style && navigator.userAgent.match(/IEMobile\/10\.0/)) {
                var msViewportStyle = document.createElement("style");
                msViewportStyle.appendChild(
                    document.createTextNode("@-ms-viewport{width:auto!important}")
                );
                document.getElementsByTagName("head")[0].appendChild(msViewportStyle);
            }
        },
        popup: function() {
            var et_popup_closed = $.cookie('etheme_popup_closed');
            $('.etheme-popup').magnificPopup({
                items: {
                  src: '#etheme-popup',
                  type: 'inline'
                },
                removalDelay: 300, //delay removal by X to allow out-animation
                callbacks: {
                    beforeOpen: function() {
                        this.st.mainClass = 'my-mfp-slide-bottom';
                    },
                    beforeClose: function() {
                    if($('#showagain:checked').val() == 'do-not-show')
                        $.cookie('etheme_popup_closed', 'do-not-show', { expires: 1, path: '/' } );
                    },
                }
              // (optionally) other options
            });

            if(et_popup_closed != 'do-not-show' && $('.etheme-popup').length > 0 && $('body').hasClass('open-popup')) {
                $('.etheme-popup').magnificPopup('open');
            }
        },
        searchPopup: function() {
            // **********************************************************************//
            // ! Search popup
            // **********************************************************************//
            $('.popup-with-form').magnificPopup({
                type: 'inline',
                closeBtnInside: true,
                preloader: false,
                midClick: true,
                removalDelay: 300,
                focus: '#Modalsearch',
                mainClass: 'my-mfp-slide-bottom effect-delay2',
                callbacks: {
                    beforeOpen: function() {
                        if($(window).width() < 700) {
                            this.st.focus = false;
                        } else {
                            this.st.focus = '#Modalsearch';
                        }
                    },
                    open: function() {
                        $('#searchModal').addClass('');
                    }
                }
            });

            // focus on search input for dropdown type
            $('.search-with-form').on('mouseover', function() {
                $(this).find('input').focus();
            }).on('touchstart click', '.popup-with-form', function() {
                $('.search-with-form').find('input').focus();
            });


            $('.popup-btn').magnificPopup({
                type:'inline',
                midClick: true // Allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source in href.
            });
        },
        imagesLightbox: function() {
            // **********************************************************************//
            // ! Images lightbox
            // **********************************************************************//
            $("a[rel^='lightboxGall']").magnificPopup({
                type:'image',
                gallery:{
                    enabled:true
                }
            });


            $('.images-popups-gallery').each(function() { // the containers for all your galleries
                $(this).magnificPopup({
                    delegate: "a[data-rel^='gallery']", // the selector for gallery item
                    type: 'image',
                    image: {
                        verticalFit: false
                    },
                    gallery: {
                      enabled:true
                    },
                    titleSrc: 'title'
                });
            });

            $("a[rel='lightbox'], a[rel='pphoto']").magnificPopup({
                type:'image',
                closeBtnInside: true,
                preloader: false,
                midClick: true,
                removalDelay: 300,
                callbacks: {
                    beforeOpen: function() {
                        this.st.mainClass = 'my-mfp-slide-bottom effect-delay2';
                    }
                }
            });
        },
        animateCounter: function(el) {
            // **********************************************************************//
            // ! Animated Counters
            // **********************************************************************//
            var initVal = parseInt(el.text());
            var finalVal = el.data('value');
            if(finalVal <= initVal) return;
            var intervalTime = 1;
            var time = 200;
            var step = parseInt((finalVal - initVal)/time.toFixed());
            if(step < 1) {
                step = 1;
                time = finalVal - initVal;
            }
            var firstAdd = (finalVal - initVal)/step - time;
            var counter = parseInt((firstAdd*step).toFixed()) + initVal;
            var i = 0;
            var interval = setInterval(function(){
                i++;
                counter = counter + step;
                el.text(counter);
                if(i == time) {
                    clearInterval(interval);
                }
            }, intervalTime);
        },
        loadInView: function() {
            // **********************************************************************//
            // ! Load in view
            // **********************************************************************//

            var counters = $('.animated-counter');

            counters.each(function(){
                $(this).waypoint(function(){
                    etTheme.animateCounter($(this));
                }, { offset: '100%' });
            });

            var progressBars = $('.progress-bars');
                progressBars.waypoint(function() {
                    i = 0;
                    $(this).find('.progress-bar').each(function () {
                        i++;

                        var el = $(this);
                        var width = $(this).data('width');
                        setTimeout(function(){
                            el.find('div').animate({
                                'width' : width + '%'
                            },400);
                            el.find('span').css({
                                'opacity' : 1
                            });
                        },i*300, "easeOutCirc");

                    });
                }, { offset: '85%' });
        },
        cleanSpaces: function() {
            // **********************************************************************//
            // ! Remove some br and p
            // **********************************************************************//
            $('.toggle-element ~ br').remove();
            $('.toggle-element ~ p').remove();
            $('.block-with-ico h5').next('p').remove();
            $('.tab-content .row-fluid').next('p').remove();
            $('.tab-content .row-fluid').prev('p').remove();
        },
        contentProdImages: function() {
            // **********************************************************************//
            // ! Products grid images slider
            // **********************************************************************//
            $('.hover-effect-slider').each(function() {
                var slider = $(this);
                var index = 0;
                var autoSlide;
                var imageLink = slider.find('.product-content-image');
                var imagesList = imageLink.data('images');
                imagesList = imagesList.split(",");
                var arrowsHTML = '<div class="sm-arrow arrow-left">left</div><div class="sm-arrow arrow-right">right</div>';
                var counterHTML = '<div class="slider-counter"><span class="current-index">1</span>/<span class="slides-count">' + imagesList.length + '</span></div>';

                if(imagesList.length > 1) {
                    slider.prepend(arrowsHTML);
                    //slider.prepend(counterHTML);

                    // Previous image on click on left arrow
                    slider.find('.arrow-left').click(function(event) {
                        if(index > 0) {
                            index--;
                        } else {
                            index = imagesList.length-1; // if the first item set it to last
                        }
                        imageLink.find('img').attr('src', imagesList[index]).attr('srcset', imagesList[index]); // change image src
                        slider.find('.current-index').text(index + 1); // update slider counter
                    });

                    // Next image on click on left arrow
                    slider.find('.arrow-right').click(function(event) {
                        if(index < imagesList.length - 1) {
                            index++;
                        } else {
                            index = 0; // if the last image set it to first
                        }
                        imageLink.find('img').attr('src', imagesList[index]).attr('srcset', imagesList[index]);// change image src
                        slider.find('.current-index').text(index + 1);// update slider counter
                    });


                }

            });
        },
        wishlist: function() {
            // **********************************************************************//
            // ! Wishlist
            // **********************************************************************//
            $('.yith-wcwl-add-button.show').each(function(){
                var wishListText = $(this).find('a').text();
                $(this).find('a').attr('data-hover',wishListText);
            });
        },
        mainNavigation: function() {
            // **********************************************************************//
            // ! Main Navigation plugin
            // **********************************************************************//
            $.fn.et_menu = function ( options ) {
                var methods = {
                    init: function(el) {
                        methods.el = el;

                        $(window).resize(function() {
                            methods.setOffsets();
                            methods.sideMenu();
                        });

                        methods.setOffsets();

                        el.find('a').has('.nav-item-tooltip').hover(function() {
                            var newContent = '';
                            var tooltip = $(this).find('.nav-item-tooltip');
                            var src = tooltip.find('>div').first().attr('data-src');
                            if(src.length > 10) {
                                newContent = '<img src="' + src + '" />';
                                tooltip.html(newContent);
                            }
                        });

                    },
                    setOffsets: function() {

                        if($('body').hasClass('rtl')) return;

                        methods.el.find('.item-design-full-width > .nav-sublist-dropdown').each(function() {
                            var boxed = ($('body').hasClass('boxed') || $('body').hasClass('framed'));
                            var extraBoxedOffset = 0;
                            if(boxed) {
                                extraBoxedOffset = $('.page-wrapper').offset().left;
                            }

                            var li = $(this).parent();
                            var liOffset = li.offset().left - extraBoxedOffset;
                            var liOffsetTop = li.offset().top;
                            var liWidth = $(this).parent().width();
                            var dropdowntMarginLeft = liWidth/2;
                            var dropdownWidth = $(this).outerWidth();
                            var dropdowntLeft = liOffset - dropdownWidth/2;
                            var dropdownBottom = liOffsetTop - $(window).scrollTop() + $(this).outerHeight();

                            var fitHeight = false;

                            if(dropdowntLeft < 0) {
                                var left = liOffset - 10;
                                dropdowntMarginLeft = 0;
                            } else {
                                var left = dropdownWidth/2;

                            }

                            $(this).css({
                                'left': - left,
                                'marginLeft': dropdowntMarginLeft
                            });

                            var dropdownRight = ($(window).width() - extraBoxedOffset*2) - (liOffset - left + dropdownWidth + dropdowntMarginLeft);

                            if(dropdownRight < 0) {
                                $(this).css({
                                    'left': 'auto',
                                    'right': - ($(window).width() - liOffset - liWidth - 10) + extraBoxedOffset*2
                                });
                            }

                            if(fitHeight && dropdownBottom > $(window).height()) {
                                $(this).css({
                                    'top': 'auto',
                                    'bottom': - ($(window).height() - (liOffsetTop - $(window).scrollTop() + li.outerHeight())) + 15
                                });
                            }

                        });
                    },
                    sideMenu: function() {
                        if($(window).height() < 800) {
                            $('.header-wrapper').addClass('header-scrolling');
                        } else {
                            $('.header-wrapper').removeClass('header-scrolling');
                        }
                    }
                };

                var settings = $.extend({
                    type: "default"
                }, options );

                methods.init(this);


                return this;
            }

            // First Type of column Menu
            $('.menu-main-container .menu:not(.header-type-vertical .menu)').et_menu({
                type: "default"
            });

        },
        backToTop: function() {
            // **********************************************************************//
            // ! "Top" button
            // **********************************************************************//

            var scroll_timer;
            var displayed = false;
            var $message = $('.back-top');

            $(window).scroll(function () {
                window.clearTimeout(scroll_timer);
                scroll_timer = window.setTimeout(function () {
                if($(window).scrollTop() <= 0) {
                    displayed = false;
                    $message.addClass('bounceOut').removeClass('bounceIn');
                }
                else if(displayed == false) {
                    displayed = true;
                    $message.stop(true, true).removeClass('bounceOut').addClass('bounceIn').click(function () { $message.addClass('bounceOut').removeClass('bounceIn'); });
                }
                }, 400);
            });

            $('.back-top').click(function(e) {
                    $('html, body').animate({scrollTop:0}, 600);
                    return false;
            });
        },
        portfolio: function() {
            // **********************************************************************//
            // ! Portfolio
            // **********************************************************************//

            var $portfolio = $('.portfolio');

            $portfolio.imagesLoaded( function() {
              if ($('.portfolio-item')[0]) {

                var portfolioGrid = $(this);
                portfolioGrid.isotope({
                    itemSelector: '.portfolio-item'
                });
                $(window).smartresize(function(){
                    portfolioGrid.isotope({
                        itemSelector: '.portfolio-item'
                    });
                });

                portfolioGrid.parent().find('.portfolio-filters a').click(function(){
                    var selector = $(this).attr('data-filter');
                    portfolioGrid.parent().find('.portfolio-filters a').removeClass('active');
                    if(!$(this).hasClass('active')) {
                        $(this).addClass('active');
                    }
                    portfolioGrid.isotope({ filter: selector });
                    return false;
                });
              }
            });



            setTimeout(function(){
                $('.portfolio').addClass('with-transition');
                $('.portfolio-item').addClass('with-transition');
                $(window).resize();
            },500);
        },
        isotope: function() {
            // **********************************************************************//
            // ! Blog isotope
            // **********************************************************************//

            var $blog = $('.blog-masonry');

            $blog.isotope({
                itemSelector: '.post-grid'
            });


            $(window).smartresize(function(){
                $blog.isotope({
                    itemSelector: '.post-grid'
                });
            });


            // **********************************************************************//
            // ! Other elements isotope
            // **********************************************************************//

            var $container = $('.isotope-container');

            var $isotope = $('.et_isotope');

            $isotope.each(function() {
                var isotope = $(this);
                isotope.isotope({
                    itemSelector: '.et_isotope-item'
                });

               $(window).smartresize(function(){
                    isotope.isotope({
                        itemSelector: '.et_isotope-item'
                    });
                });

                setTimeout(function(){
                    isotope.addClass('with-transition');
                    isotope.find('.et_isotope-item').addClass('with-transition');;
                },500);
            });

            $container.each(function() {
                var container = $(this);
                var isotope = container.find('.et_isotope');
                container.find('.et_categories_filter a').data('isotope', isotope).click(function(e){
                    e.preventDefault();
                    var isotope = $(this).data('isotope');
                    $(this).parent().parent().find('.active').removeClass('active');
                    $(this).addClass('active');
                    isotope.isotope({filter: $(this).attr('data-filter')});
                });
            });
        },
        testimonials: function() {
            // **********************************************************************//
            // ! Testimonials Gallery
            // **********************************************************************//

            $(".testimonials-slider").each(function() {
                var navigation = ($(this).data('navigation') == 1),
                    interval = $(this).data('interval');

                $(this).owlCarousel({
                    items:1,
                    lazyLoad : true,
                    autoPlay: interval,
                    navigation: navigation,
                    navigationText:false,
                    rewindNav: true,
                    itemsCustom: [[0, 1], [479,1], [619,1], [768,1],  [1200, 1], [1600, 1]]
                });
            });
        },
        woocommerce: function() {
            // **********************************************************************//
            // ! WooCommerce
            // **********************************************************************//

            $('.woocommerce-review-link').click(function() {
                $('#tab_reviews').click();
            });

            // **********************************************************************//
            // ! Product variations images
            // **********************************************************************//

            $('form.variations_form').on( 'found_variation', function( event, variation ) {
                var $variation_form = $(this);
                var $product        = $(this).closest( '.product' );
                var $product_img    = $product.find( '.woocommerce-main-image img:eq(0)' );
                var $product_link   = $product.find( '.woocommerce-main-image' );
                var $lighbox_link   = $product.find( '.product-lightbox-btn' ).first();

                var o_src           = $product_img.attr('data-o_src');
                var o_title         = $product_img.attr('data-o_title');
                var o_href          = $product_link.attr('data-o_href');

                var variation_image = variation.image_src;
                var variation_link = variation.image_link;
                var variation_title = variation.image_title;

                $product_link.attr('href', variation_image);

                if ($('.main-images').hasClass('zoom-enabled')) {
                    if($(window).width() > 768 && variation_image.length > 5 && variation_link.length > 5){
                        $product_link.swinxyzoom('load', variation_image,  variation_link);
                    }
                    $product_link.attr('href', variation_link);
                } else{

                    $product_link.attr('href', variation_link);
                }
                if( variation_link.length > 5 ) {
                    $lighbox_link.attr('href', variation_link);
                }

                var owlMain = $(".main-images").data('owlCarousel');
                if( typeof owlMain != 'undefined') {
                    owlMain.goTo(0);
                }

            })
            // Reset product image
            .on( 'reset_image', function( event ) {


                var $product        = $(this).closest( '.product' );
                var $product_img    = $product.find( '.woocommerce-main-image img:eq(0)' );
                var $product_link   = $product.find( '.woocommerce-main-image' );
                var $lighbox_link   = $product.find( '.product-lightbox-btn' ).first();


                var o_src           = $product_img.attr('data-o_src');
                var o_href          = $product_link.attr('data-o_href');

                $product_link.attr('href', o_href);

                if ($('.main-images').hasClass('zoom-enabled')) {
                    if($(window).width() > 768 && typeof $product_img.attr('data-o_src') != 'undefined' && o_src.length > 5 && o_href.length > 5){
                        $product_link.swinxyzoom('load', o_src,  o_href);
                    }

                    $product_link.attr('href', o_href);
                } else{
                    $product_link.attr('href', o_href);
                }
                $lighbox_link.attr('href', o_href);

                var owlMain = $(".main-images").data('owlCarousel');
                if( typeof owlMain != 'undefined') {
                    owlMain.goTo(0);
                }

            } );

            $( '.variations_form .variations select' ).change();
        },
        productsViewMode: function() {
            // **********************************************************************//
            // ! Products view switcher
            // **********************************************************************//
            var activeClass = 'switcher-active';
            var gridClass = 'products-grid';
            var listClass = 'products-list';
            $('.switchToList').click(function(){
                if(!$.cookie('products_page') || $.cookie('products_page') == 'grid'){
                    switchToList();
                }
            });
            $('.switchToGrid').click(function(){
                if(!$.cookie('products_page') || $.cookie('products_page') == 'list'){
                    switchToGrid();
                }
            });

            function switchToList(){
                $('.switchToList').addClass(activeClass);
                $('.switchToGrid').removeClass(activeClass);
                $('.main-products-loop .products-loop').fadeOut(300,function(){
                    $(this).removeClass(gridClass).addClass(listClass).fadeIn(300);
                    $.cookie('products_page', 'list', { expires: 3, path: '/' });
                });
            }

            function switchToGrid(){
                $('.switchToGrid').addClass(activeClass);
                $('.switchToList').removeClass(activeClass);
                $('.main-products-loop .products-loop').fadeOut(300,function(){
                    $(this).removeClass(listClass).addClass(gridClass).fadeIn(300);
                    $.cookie('products_page', 'grid', { expires: 3, path: '/' });
                });
            }
        },
        checkViewMode: function() {
            var activeClass = 'switcher-active';
            if($.cookie('products_page') == 'grid') {
                $('.main-products-loop .products-loop').removeClass('products-list').addClass('products-grid');
                $('.switchToGrid').addClass(activeClass);
            }else if($.cookie('products_page') == 'list') {
                $('.main-products-loop .products-loop').removeClass('products-grid').addClass('products-list');
                $('.switchToList').addClass(activeClass);
            }else{
                if(etConfig.view_mode_default == 'list_grid' || etConfig.view_mode_default == 'list') {
                    $('.switchToList').addClass(activeClass);
                }else{
                    $('.switchToGrid').addClass(activeClass);
                }
            }
        },

        isIE: function  () {
            if (navigator.userAgent.indexOf('MSIE') !== -1 || navigator.appVersion.indexOf('Trident/') > 0) {
               return true;
            }
            return false;
        },

        addToCart: function(data, $thisbutton, showEmodal) {
            var modalWindow = $('.etheme-simple-product').eModal();

            if(showEmodal) {
                modalWindow.eModal('showModal');
            }

            if ( etTheme.isIE() ) {
                $thisbutton.addClass('adding-to-cart');
            }

            // Ajax action
            $.post( etConfig.ajaxurl, data, function( response ) {

                if(showEmodal) {

                    var productImageSrc;

                    if($('.images img, .product-images img').length > 0) {
                        productImageSrc = $('.images img, .product-images img').first().attr('src');
                    } else {
                        productImageSrc = $('.product-thumbnails img').first().attr('src');
                    }

                    var productName = $('.product_title').first().text();

                    var addText = etConfig.successfullyAdded

                    if (response.error == true) {addText = etConfig.warningAdded};

                    modalWindow.eModal('endLoading')
                         .eModal('setTitle',productName)
                         .eModal('addImage', productImageSrc)
                         .eModal('addText', addText)
                         .eModal('addBtn',{
                                title: etConfig.contBtn,
                                href: 'javascript:void(0);',
                                cssClass: 'btn filled',
                                hideOnClick: true
                            })
                         .eModal('addBtn',{
                                title: etConfig.checkBtn,
                                href: etConfig.checkoutUrl,
                                cssClass: 'btn filled active'
                            });
                }

                if ( ! response )
                    return false;

                var this_page = window.location.toString();

                this_page = this_page.replace( 'add-to-cart', 'added-to-cart' );

                if ( response.error && response.product_url ) {
                    window.location = response.product_url;
                    return false;
                }

                // Redirect to cart option
                if ( woocommerce_params.cart_redirect_after_add == 'yes' ) {

                    window.location = woocommerce_params.cart_url;
                    return false;

                } else {

                    $thisbutton.parent().find('#floatingCirclesG').remove();

                    var fragments = response.fragments;
                    var cart_hash = response.cart_hash;

                    if ( etTheme.isIE() ) {
                        $thisbutton.removeClass('adding-to-cart');
                    }

                    setTimeout(function() {
                        $thisbutton.parent().parent().removeClass('loading');
                        $thisbutton.removeClass('added');
                    }, 3000)

                    // Cart widget load
                    $('#cartModal').replaceWith(fragments.cart_modal);
                    $('.widget_shopping_cart').replaceWith($(fragments.top_cart).find('.widget_shopping_cart'));
                    $('.shopping-container').replaceWith(fragments.top_cart);

                    $('body').trigger('cart_widget_refreshed');

                    // Unblock
                    $( '.widget_shopping_cart, .updating' ).stop( true ).css( 'opacity', '1' ).unblock();

                    // Cart page elements
                    $( '.shop_table.cart' ).load( this_page + ' .shop_table.cart:eq(0) > *', function() {

                        $( '.shop_table.cart' ).stop( true ).css( 'opacity', '1' ).unblock();

                        $( 'body' ).trigger( 'cart_page_refreshed' );
                    });

                    $( '.cart_totals' ).load( this_page + ' .cart_totals:eq(0) > *', function() {
                        $( '.cart_totals' ).stop( true ).css( 'opacity', '1' ).unblock();
                    });

                    // Trigger event so themes can refresh other areas
                    $('body').trigger( 'added_to_cart', [ fragments, cart_hash ] );
                    return true;
                }
            });
        },
        ajaxAddToCartInit: function() {

            $('.etheme-simple-product, .ajax-cart-enable .variations_form .single_add_to_cart_button').live('click', function(e) {
                e.preventDefault();
                // AJAX add to cart request
                var $thisbutton = $(this);

                if($thisbutton.hasClass('wc-variation-selection-needed')) return;

                if ($thisbutton.is('.single_add_to_cart_button, .etheme-simple-product, .product_type_downloadable, .product_type_virtual') ) {

                    $('#top-cart').addClass('updating');

                    var form = $('form.cart');

                    var formAction = form.attr('action');

                    var variation = {};
                    form.find('select').each(function() {
                        var key = $(this).attr('name');
                        var value = $(this).val();
                        variation[key] = value;
                    });

                    var data = {
                        action:         'et_woocommerce_add_to_cart',
                        product_id:     form.find('[name="add-to-cart"]').val(),
                        quantity:       form.find('.qty').val(),
                        variation_id:   form.find('[name="variation_id"]').val(),
                        variation:      variation
                    };

                    etTheme.addToCart(data, $thisbutton, true);

                    return false;

                } else {
                    return true;
                }

            });

            if ( !etTheme.isIE() ) {
                [].slice.call( document.querySelectorAll( '.progress-button' ) ).forEach( function( bttn ) {
                    new ProgressButton( bttn, {
                        callback : function( instance ) {
                            var progress = 0,
                                interval = setInterval( function() {
                                    progress = Math.min( progress + Math.random() * 0.01, 1 );
                                    instance._setProgress( progress );

                                    if( progress === 1 ) {
                                        instance._stop(1);
                                        clearInterval( interval );
                                    }
                                }, 5 );
                        }
                    } );
                } );
            }

            // Ajax add to cart (on list page)
            $('.etheme_add_to_cart_button').live('click', function() {

                // AJAX add to cart request
                var $thisbutton = $(this);

                if ($thisbutton.is('.product_type_simple, .product_type_downloadable, .product_type_virtual')) {

                    if (!$thisbutton.attr('data-product_id')) return true;

                    var data = {
                        action:         'et_woocommerce_add_to_cart',
                        product_id:     $thisbutton.attr('data-product_id'),
                        quantity:       $thisbutton.attr('data-quantity')
                    };

                    etTheme.addToCart(data, $thisbutton, false);

                    return false;

                } else {
                    return true;
                }

            });
        },
        quickView: function() {
            // **********************************************************************//
            // ! AJAX Quick View
            // **********************************************************************//
            $(document.body).on('click', '.show-quickly, .show-quickly-btn', (function() {
                var $thisbutton = $(this);
                var $productCont = $(this).parent().parent().parent();
                var prodid = $thisbutton.data('prodid');
                var magnificPopup;
                $.ajax({
                    url: etConfig.ajaxurl,
                    method: 'POST',
                    data: {
                        'action': 'et_product_quick_view',
                        'prodid': prodid
                    },
                    dataType: 'html',
                    beforeSend: function() {
                        $productCont.addClass('loading');
                        $productCont.append('<div id="floatingCirclesG"><div class="f_circleG" id="frotateG_01"></div><div class="f_circleG" id="frotateG_02"></div><div class="f_circleG" id="frotateG_03"></div><div class="f_circleG" id="frotateG_04"></div><div class="f_circleG" id="frotateG_05"></div><div class="f_circleG" id="frotateG_06"></div><div class="f_circleG" id="frotateG_07"></div><div class="f_circleG" id="frotateG_08"></div></div>');
                    },
                    complete: function() {
                        $productCont.find('#floatingCirclesG').remove();
                        $productCont.removeClass('loading');
                    },
                    success: function(response){

                        $.magnificPopup.open({
                            items: { src: '<div class="quick-view-popup mfp-with-anim"><div class="doubled-border">' + response + '</div></div>' },
                            type: 'inline',
                            removalDelay: 300, //delay removal by X to allow out-animation
                            callbacks: {
                                beforeOpen: function() {
                                    this.st.mainClass = 'my-mfp-slide-bottom';
                                }
                            }
                        }, 0);

                        $(function() {
                            $('.variations_form').wc_variation_form();
                            $('.variations_form .variations select').change();
                        });
                        $('.images').addClass('shown');
                    },
                    error: function() {
                        $.magnificPopup.open({
                            items: {
                                src: '<div class="quick-view-popup mfp-with-anim"><div class="doubled-border">Error with AJAX request</div></div>'
                            },
                            type: 'inline',
                            removalDelay: 500, //delay removal by X to allow out-animation
                            callbacks: {
                                beforeOpen: function() {
                                    this.st.mainClass = 'mfp-zoom-in-to-left-out';
                                }
                            }
                        }, 0);
                    }
                });

            }));
        },
        searchform: function() {
            // **********************************************************************//
            // ! Search form
            // **********************************************************************//

            var searchBlock = $('.search.hide-input');
            var searchForm = searchBlock.find('#searchform');
            var searchBtn = searchForm.find('.button');
            var searchInput = searchForm.find('input[type="text"]');

            searchBtn.click(function(e) {
                e.preventDefault();
                searchInput.fadeIn(200).focus();
                $('body').addClass('search-input-shown');

                // Hide search input on click
                $(document).click(function(e) {
                    var target = e.target;
                    if (!$(target).is('.search.hide-input') && !$(target).parents().is('.search.hide-input')) {
                        searchInput.fadeOut(200);
                        $('body').removeClass('search-input-shown');
                    }
                });

            });
        },
        tabs: function() {
            // **********************************************************************//
            // ! Tabs
            // **********************************************************************//

            var tabs = $('.tabs');
            $('.tabs > p > a').unwrap('p');

            var leftTabs = $('.left-bar, .right-bar');
            var newTitles;

            leftTabs.each(function(){
                var currTab = $(this);
                //currTab.find('> a.tab-title').each(function(){
                    newTitles = currTab.find('> a.tab-title').clone().removeClass('tab-title').addClass('tab-title-left');
                //});

                newTitles.first().addClass('opened');


                var tabNewTitles = $('<div class="left-titles"></div>').prependTo(currTab);
                tabNewTitles.html(newTitles);

                currTab.find('.tab-content').css({
                    'minHeight' : tabNewTitles.height()
                });
            });


            tabs.each(function(){
                var currTab = $(this);

                currTab.find('.tab-title').first().addClass('opened').next().show();

                currTab.find('.tab-title, .tab-title-left').click(function(e){

                    e.preventDefault();

                    var tabId = $(this).attr('id');
                    var time = 250;

                    if($(this).hasClass('opened')){
                        if(currTab.hasClass('accordion') || ($(window).width() < 767 && !currTab.hasClass('products-tabs'))){
                            $(this).removeClass('opened');
                            $('#content_'+tabId).slideUp(time);
                        }
                    }else{
                        currTab.find('.tab-title, .tab-title-left').each(function(){
                            var tabId = $(this).attr('id');
                            $(this).removeClass('opened');
                            if(currTab.hasClass('accordion') || ($(window).width() < 767 && !currTab.hasClass('products-tabs'))) {
                                $('#content_'+tabId).slideUp(time);
                            } else {
                                $('#content_'+tabId).hide();
                            }
                        });


                        if(currTab.hasClass('accordion') || ($(window).width() < 767 && !currTab.hasClass('products-tabs'))){
                            setTimeout(function(){
                                $('#content_'+tabId).addClass('tab-content').slideDown(time); // Fix it
                            },1);
                        } else {
                            $('#content_'+tabId).show();
                        }
                        $(this).addClass('opened');
                    }
                });
            });
        },
        categoriesAccordion: function() {
            // **********************************************************************//
            // ! Categories Accordion
            // **********************************************************************//

            $.fn.etAccordionMenu = function ( options ) {
                //var settings = $.extend({
                //    type: "default"
                //}, options );

                var $this = $(this);

                var plusIcon = '+';
                var minusIcon = '&ndash;';

                var etCats = $('.product-categories');
                $this.addClass('with-accordion')
                var openerHTML = '<div class="open-this">'+plusIcon+'</div>';

                $this.find('li').has('.children, .nav-sublist-dropdown').has('li').addClass('parent-level0').prepend(openerHTML);

                if($this.find('.current-cat.parent-level0, .current-cat, .current-cat-parent').length > 0) {
                    $this.find('.current-cat.parent-level0, .current-cat-parent').find('.open-this').html(minusIcon).parent().addClass('opened').find('ul.children').show();
                } else {
                    $this.find('>li').first().find('.open-this').html(minusIcon).parent().addClass('opened').find('ul.children').show();
                }

                $this.find('.open-this').click(function() {
                    if($(this).parent().hasClass('opened')) {
                        $(this).html(plusIcon).parent().removeClass('opened').find('> ul, > div.nav-sublist-dropdown').slideUp(200);
                    }else {
                        $(this).html(minusIcon).parent().addClass('opened').find('> ul, > div.nav-sublist-dropdown').slideDown(200);
                    }
                });

                return this;
            }

            if(etConfig.catsAccordion) {
                $('.product-categories').etAccordionMenu();
            }
        },
        toggles: function() {
            // **********************************************************************//
            // ! Toggle elements
            // **********************************************************************//

            var etoggle = $('.toggle-block');
            var etoggleEl = etoggle.find('.toggle-element');

            var plusIcon = '+';
            var minusIcon = '&ndash;';

            //etoggleEl.first().addClass('opened').find('.open-this').html(minusIcon).parent().parent().find('.toggle-content').show();

            etoggleEl.click(function(e) {
                e.preventDefault();
                if($(this).hasClass('opened')) {
                    $(this).removeClass('opened').find('.open-this').html(plusIcon).parent().parent().find('.toggle-content').slideUp(200);
                }else {
                    if($(this).parent().hasClass('noMultiple')){
                        $(this).parent().find('.toggle-element').removeClass('opened').find('.open-this').html(plusIcon).parent().parent().find('.toggle-content').slideUp(200);
                    }
                    $(this).addClass('opened').find('.open-this').html(minusIcon).parent().parent().find('.toggle-content').slideDown(200);
                }
            });
        },
        closeParentBtn: function() {
            // **********************************************************************//
            // ! Alerts
            // **********************************************************************//
            var closeParentBtn = $('.close-parent');

            closeParentBtn.click(function(e){
                closeParent(this);
            });

            function closeParent(el) {
                $(el).parent().slideUp(100);
            }
        },
        contactForm: function() {
            // **********************************************************************//
            // ! Contact Form ajax
            // **********************************************************************//

            var eForm = $('#contact-form');
            var spinner = $('.spinner');

            $('.required-field').focus(function(){
                $(this).removeClass('validation-failed');
            });

            eForm.on('click', '#submit', function(e){
                e.preventDefault();
                $('#contactsMsgs').html('');
                spinner.show();
                var errmsg;
                errmsg = '';

                eForm.find('.required-field').each(function(){
                    if($(this).val() == '') {
                        $(this).addClass('validation-failed');
                    }
                });

                if(errmsg){
                    $('#contactsMsgs').html('<p class="error">' + errmsg + '</p>');
                    spinner.hide();
                }else{

                    var url = eForm.attr('action');
                    var data = eForm.serialize();

                    data += '&action=et_send_msg_action';

                    $.ajax({
                        url: etConfig.ajaxurl,
                        method: 'GET',
                        data: data,
                        error: function(data) {
                            $('#contactsMsgs').html('<p class="error">Error while ajax request<span class="close-parent"></span></p>');
                            spinner.hide();
                        },
                        success : function(data){
                            if (data.status == 'success') {
                                $('#contactsMsgs').html('<p class="success">' + data.msg + '<span class="close-parent"></span></p>');
                                eForm.find("input[type=text], textarea").val("");
                            }else{
                                $('#contactsMsgs').html('<p class="error">' + data.msg + '<span class="close-parent"></span></p>');
                            }
                            spinner.hide();
                            etTheme.closeParentBtn();
                        }
                    });

                }

            });
        },
        commentsForm: function() {
            // **********************************************************************//
            // ! Custom Comment Form Validation
            // **********************************************************************//
            var commentForm = $('#commentform');

            commentForm.on('click', '#submit', function(e){
                $('#commentsMsgs').html('');

                commentForm.find('.required-field').each(function(){
                    if($(this).val() == '') {
                        $(this).addClass('validation-failed');
                        e.preventDefault();
                    }
                });

            });
        },
        mobileMenu: function() {
            // **********************************************************************//
            // ! Mobile Menu
            // **********************************************************************//
            $('.navbar-toggle').toggle(function(){
                $('.mobile-menu-wrapper').slideDown(200);
            },function(){
                $('.mobile-menu-wrapper').slideUp(200);
            });

            var navList = $('.mobile-menu-wrapper .menu');
            var opener = '<span class="open-child">(open)</span>';

            navList.find('li:has(ul)',this).each(function() {
                $(this).prepend(opener);
            });

            navList.on('click', '.open-child', function(){
                if ($(this).parent().hasClass('over')) {
                    $(this).parent().removeClass('over').find('>ul').slideUp(200);
                }else{
                    $(this).parent().parent().find('>li.over').removeClass('over').find('>ul').slideUp(200);
                    $(this).parent().addClass('over').find('>ul').slideDown(200);
                }
            });

            $(function() {
                $('.navbar-toggle').click(function() {
                    $(this).toggleClass('show-nav');
                    return false;
                });
            });
        },
    };

    etTheme.newJqueryMethods();

    $(document).ready(function(){
        etTheme.init();
    });

    $( document.body ).on( 'updated_wc_div', function() {
        etTheme.fragmentsRefresh();
    } );



})(jQuery);

