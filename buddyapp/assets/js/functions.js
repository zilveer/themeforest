/*-----------------------------------------------------------------------------------

 Theme Name: BuddyApp
 Theme URI: http://themeforest.net/user/SeventhQueen
 Description: First Mobile Private Community Premium WordPress theme
 Author: SeventhQueen
 Author URI: http://themeforest.net/user/SeventhQueen
 Javascript theme logic v1.0.0

 == Table of contents ==
 1. General functions
 2. Header functions
 3. BuddyPress functions

 -----------------------------------------------------------------------------------*/



/* -----------------------------------------
 requestAnimationFrame polyfill by Erik Möller. fixes from Paul Irish and Tino Zijdel
 MIT license
 ----------------------------------------- */
(function () {
    var lastTime = 0;
    var vendors = ['ms', 'moz', 'webkit', 'o'];
    for (var x = 0; x < vendors.length && !window.requestAnimationFrame; ++x) {
        window.requestAnimationFrame = window[vendors[x] + 'RequestAnimationFrame'];
        window.cancelAnimationFrame = window[vendors[x] + 'CancelAnimationFrame']
            || window[vendors[x] + 'CancelRequestAnimationFrame'];
    }

    if (!window.requestAnimationFrame)
        window.requestAnimationFrame = function (callback, element) {
            var currTime = new Date().getTime();
            var timeToCall = Math.max(0, 16 - (currTime - lastTime));
            var id = window.setTimeout(function () {
                    callback(currTime + timeToCall);
                },
                timeToCall);
            lastTime = currTime + timeToCall;
            return id;
        };

    if (!window.cancelAnimationFrame)
        window.cancelAnimationFrame = function (id) {
            clearTimeout(id);
        };
}());



var KLEO = KLEO || {};
(function ($) {

    // USE STRICT
    "use strict";

    KLEO.isMobile = {
        Android: function () {
            return navigator.userAgent.match(/Android/i);
        },
        BlackBerry: function () {
            return navigator.userAgent.match(/BlackBerry/i);
        },
        iOS: function () {
            return navigator.userAgent.match(/iPhone|iPad|iPod/i);
        },
        Opera: function () {
            return navigator.userAgent.match(/Opera Mini/i);
        },
        Windows: function () {
            return navigator.userAgent.match(/IEMobile/i);
        },
        mobileWidth: function () {
            if (window.matchMedia) {
                return window.matchMedia('(max-width: 480px)').matches;
            } else {
                return $(window).innerWidth() < 465;
            }

        },
        tabletWidth: function () {
            if (window.matchMedia) {
                return window.matchMedia('(max-width: 768px)').matches;
            } else {
                return $(window).innerWidth() < 753;
            }
        },
        any: function () {
            return (KLEO.isMobile.Android() || KLEO.isMobile.BlackBerry() || KLEO.isMobile.iOS() || KLEO.isMobile.Opera() || KLEO.isMobile.Windows());
        }
    };

    KLEO.isHighDensity = function () {
        return ((window.matchMedia && (window.matchMedia('only screen and (min-resolution: 124dpi), only screen and (min-resolution: 1.3dppx), only screen and (min-resolution: 48.8dpcm)').matches || window.matchMedia('only screen and (-webkit-min-device-pixel-ratio: 1.3), only screen and (-o-min-device-pixel-ratio: 2.6/2), only screen and (min--moz-device-pixel-ratio: 1.3), only screen and (min-device-pixel-ratio: 1.3)').matches)) || (window.devicePixelRatio && window.devicePixelRatio > 1.3));
    };

    /* -----------------------------------------
     1. General functions
     ----------------------------------------- */
    KLEO.main = {

        init: function () {
            KLEO.main.responsiveClasses();
            KLEO.main.pageTransition();
            KLEO.main.imageFade();
            KLEO.main.animations();
            KLEO.main.toggles();
            KLEO.main.accordions();
            KLEO.main.linkScroll();

            KLEO.main.lightBox();
            KLEO.main.resizeVideos();
            $body.on('lightBoxAjaxAdded', function () {
                KLEO.main.resizeVideos();
            });
            KLEO.main.loadFlexSlider();

            KLEO.main.applyRetina();
            KLEO.main.ajaxLogin();
            KLEO.main.ajaxLostPass();
            KLEO.main.menuWidget();

            KLEO.main.charts();

            /* Ajax search functionality */
            if ($('.kleo_ajax_results').length) {
                KLEO.main.toggleAjaxSearch();
                KLEO.main.doAjaxSearch();
            }

            if (KLEO.isMobile.any()) {
                $body.addClass('device-touch');
            }

            KLEO.main.onScroll();
        },

        onLoad: function () {
            KLEO.main.kleoIsotope();
        },

        onResize: function () {

            //

        },

        onScroll: function () {

            $window.on('scroll', function () {

                //
            });

        },

        setCookie: function (cname, cvalue, path, exdays) {
            if (typeof path === 'undefined') {
                path = '/';
            }
            var d = new Date();
            d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
            var expires = "expires=" + d.toUTCString();
            document.cookie = cname + "=" + cvalue + "; " + expires + "; path=" + path;
        },

        // Sidebar menu toggle
        menuWidget: function () {
            var submenuParent = jQuery(".widget_nav_menu ul.sub-menu").parent('li');
            submenuParent.addClass('parent');
            submenuParent.children("a").after('<span class="menu-arrow"></span>');
            submenuParent.find(".menu-arrow").click(function () {
                jQuery(this).closest(".parent").children('.sub-menu').stop(true, true).slideToggle('fast');
                jQuery(this).toggleClass('active');
                return false;
            });

            var pagesParent = jQuery(".widget_pages ul.children").parent('li');
            pagesParent.addClass('parent');
            pagesParent.children("a").after('<span class="menu-arrow"></span>');
            pagesParent.find(".menu-arrow").click(function () {
                jQuery(this).closest(".parent").children('.children').stop(true, true).slideToggle('fast');
                jQuery(this).toggleClass('active');
                return false;
            });
            if (pagesParent.find('.current_page_item').length) {
                $('.widget_pages ul.children .current_page_item').closest('.children').stop(true, true).slideToggle('fast')
            }

            /* If tho submenus on the same level then move the last as the children to the first one */
            if ($(".submenu").next(".submenu").length) {
                $(".submenu").next(".submenu").each(function () {
                    $(this).prev(".submenu").append($(this).html());
                    $(this).remove();
                });
            }

        },

        /* Add classes based on the device viewport */
        responsiveClasses: function () {
            var jRes = jRespond([
                {
                    label: 'small-mobile',
                    enter: 0,
                    exit: 479
                }, {
                    label: 'mobile',
                    enter: 480,
                    exit: 767
                }, {
                    label: 'tablet',
                    enter: 768,
                    exit: 991
                }, {
                    label: 'desktop',
                    enter: 992,
                    exit: 1199
                }, {
                    label: 'large-desktop',
                    enter: 1200,
                    exit: 10000
                }
            ]);
            jRes.addFunc([
                {
                    breakpoint: 'large-desktop',
                    enter: function () {
                        $body.addClass('device-lg');
                    },
                    exit: function () {
                        $body.removeClass('device-lg');
                    }
                }, {
                    breakpoint: 'desktop',
                    enter: function () {
                        $body.addClass('device-md');
                    },
                    exit: function () {
                        $body.removeClass('device-md');
                    }
                }, {
                    breakpoint: 'tablet',
                    enter: function () {
                        $body.addClass('device-sm');
                    },
                    exit: function () {
                        $body.removeClass('device-sm');
                    }
                }, {
                    breakpoint: 'mobile',
                    enter: function () {
                        $body.addClass('device-xs');
                    },
                    exit: function () {
                        $body.removeClass('device-xs');
                    }
                }, {
                    breakpoint: 'small-mobile',
                    enter: function () {
                        $body.addClass('device-xxs');
                    },
                    exit: function () {
                        $body.removeClass('device-xxs');
                    }
                }
            ]);
        },

        /* Preload images */
        imagePreload: function (selector, parameters) {
            var params = {
                delay: 250,
                transition: 400,
                easing: 'linear'
            };
            $.extend(params, parameters);

            $(selector).each(function () {
                var image = $(this);
                image.css({visibility: 'hidden', opacity: 0, display: 'block'});
                image.wrap('<span class="preloader" />');
                image.one("load", function (evt) {
                    $(this).delay(params.delay).css({visibility: 'visible'}).animate({opacity: 1}, params.transition, params.easing, function () {
                        $(this).unwrap('<span class="preloader" />');
                    });
                }).each(function () {
                    if (this.complete) $(this).trigger("load");
                });
            });
        },

        /* Nice page transitions */
        pageTransition: function () {
            if ($('html').hasClass('js') && $body.hasClass('page-transition')) {
                var animationIn = $body.attr('data-animation-in'),
                    animationOut = $body.attr('data-animation-out'),
                    durationIn = $body.attr('data-speed-in'),
                    durationOut = $body.attr('data-speed-out'),
                    loaderStyle = $body.attr('data-loader'),
                    loaderStyleHtml = '<div class="css3-spinner-bounce1"></div><div class="css3-spinner-bounce2"></div><div class="css3-spinner-bounce3"></div>';

                if (!animationIn) {
                    animationIn = 'fadeIn';
                }
                if (!animationOut) {
                    animationOut = 'fadeOut';
                }
                if (!durationIn) {
                    durationIn = 1500;
                }
                if (!durationOut) {
                    durationOut = 800;
                }

                if (loaderStyle == '2') {
                    loaderStyleHtml = '<div class="css3-spinner-flipper"></div>';
                } else if (loaderStyle == '3') {
                    loaderStyleHtml = '<div class="css3-spinner-double-bounce1"></div><div class="css3-spinner-double-bounce2"></div>';
                } else if (loaderStyle == '4') {
                    loaderStyleHtml = '<div class="css3-spinner-rect1"></div><div class="css3-spinner-rect2"></div><div class="css3-spinner-rect3"></div><div class="css3-spinner-rect4"></div><div class="css3-spinner-rect5"></div>';
                } else if (loaderStyle == '5') {
                    loaderStyleHtml = '<div class="css3-spinner-cube1"></div><div class="css3-spinner-cube2"></div>';
                } else if (loaderStyle == '6') {
                    loaderStyleHtml = '<div class="css3-spinner-scaler"></div>';
                }

                $wrapper.animsition({
                    inClass: animationIn,
                    outClass: animationOut,
                    inDuration: Number(durationIn),
                    outDuration: Number(durationOut),
                    linkElement: '#primary-menu ul li a:not([target="_blank"]):not([href^=#])',
                    loading: true,
                    loadingParentElement: 'body',
                    loadingClass: 'css3-spinner',
                    loadingHtml: loaderStyleHtml,
                    unSupportCss: [
                        'animation-duration',
                        '-webkit-animation-duration',
                        '-o-animation-duration'
                    ],
                    overlay: false,
                    overlayClass: 'animsition-overlay-slide',
                    overlayParentElement: 'body'
                });
            }
        },

        /* Image fade on Hover */
        imageFade: function () {
            $('.image_fade').hover(function () {
                $(this).filter(':not(:animated)').animate({opacity: 0.8}, 400);
            }, function () {
                $(this).animate({opacity: 1}, 400);
            });
        },

        animations: function () {
            var $dataAnimateEl = $('[data-animate]');
            if ($dataAnimateEl.length > 0) {
                if ($body.hasClass('device-lg') || $body.hasClass('device-md') || $body.hasClass('device-sm')) {
                    $dataAnimateEl.each(function () {
                        var element = $(this),
                            animationDelay = element.attr('data-delay'),
                            animationDelayTime = 0;

                        if (animationDelay) {
                            animationDelayTime = Number(animationDelay) + 500;
                        } else {
                            animationDelayTime = 500;
                        }

                        if (!element.hasClass('animated')) {
                            element.addClass('not-animated');
                            var elementAnimation = element.attr('data-animate');
                            element.appear(function () {
                                setTimeout(function () {
                                    element.removeClass('not-animated').addClass(elementAnimation + ' animated');
                                }, animationDelayTime);
                            }, {accX: 0, accY: -120}, 'easeInCubic');
                        }
                    });
                }
            }
        },


        /* Calculate Top page offset */
        topScrollOffset: function () {
            var topOffsetScroll = 0;

            return topOffsetScroll;
        },


        linkScroll: function () {
            $("a[data-scrollto]").click(function () {
                var element = $(this),
                    divScrollToAnchor = element.attr('data-scrollto'),
                    divScrollSpeed = element.attr('data-speed'),
                    divScrollOffset = element.attr('data-offset'),
                    divScrollEasing = element.attr('data-easing');

                if (!divScrollSpeed) {
                    divScrollSpeed = 750;
                }
                if (!divScrollOffset) {
                    divScrollOffset = KLEO.main.topScrollOffset();
                }
                if (!divScrollEasing) {
                    divScrollEasing = 'easeOutQuad';
                }

                $('html,body').stop(true).animate({
                    'scrollTop': $(divScrollToAnchor).offset().top - Number(divScrollOffset)
                }, Number(divScrollSpeed), divScrollEasing);

                return false;
            });
        },

        toggles: function () {
            var $toggle = $('.toggle');
            if ($toggle.length > 0) {
                $toggle.each(function () {
                    var element = $(this),
                        elementState = element.attr('data-state');

                    if (elementState != 'open') {
                        element.find('.togglec').hide();
                    } else {
                        element.find('.togglet').addClass("toggleta");
                    }

                    element.find('.togglet').click(function () {
                        $(this).toggleClass('toggleta').next('.togglec').slideToggle(300);
                        return true;
                    });
                });
            }
        },

        accordions: function () {
            var $accordionEl = $('.accordion');
            if ($accordionEl.length > 0) {
                $accordionEl.each(function () {
                    var element = $(this),
                        elementState = element.attr('data-state'),
                        accordionActive = element.attr('data-active');

                    if (!accordionActive) {
                        accordionActive = 0;
                    } else {
                        accordionActive = accordionActive - 1;
                    }

                    element.find('.acc_content').hide();

                    if (elementState != 'closed') {
                        element.find('.acctitle:eq(' + Number(accordionActive) + ')').addClass('acctitlec').next().show();
                    }

                    element.find('.acctitle').click(function () {

                        if ($(this).next().is(':visible')) {
                            $(this).removeClass('acctitlec').next().slideUp("normal");
                        }else{
                            $(this).addClass('acctitlec').next().slideDown("normal");
                        }

                        return false;
                    });
                });
            }
        },

        lightBox: function () {
            var $lightboxImageEl = $('[data-lightbox="image"]'),
                $lightboxGalleryEl = $('[data-lightbox="gallery"]'),
                $lightboxIframeEl = $('[data-lightbox="iframe"]'),
                $lightboxAjaxEl = $('[data-lightbox="ajax"]'),
                $lightboxAjaxGalleryEl = $('[data-lightbox="ajax-gallery"]');

            if ($lightboxImageEl.length > 0) {
                $lightboxImageEl.magnificPopup({
                    type: 'image',
                    closeOnContentClick: true,
                    closeBtnInside: false,
                    fixedContentPos: true,
                    mainClass: 'mfp-no-margins mfp-fade', // class to remove default margin from left and right side
                    image: {
                        verticalFit: true
                    }
                });
            }

            if ($lightboxGalleryEl.length > 0) {
                $lightboxGalleryEl.each(function () {
                    var element = $(this);

                    if (element.find('a[data-lightbox="gallery-item"]').parent('.clone').hasClass('clone')) {
                        element.find('a[data-lightbox="gallery-item"]').parent('.clone').find('a[data-lightbox="gallery-item"]').attr('data-lightbox', '');
                    }

                    element.magnificPopup({
                        delegate: 'a[data-lightbox="gallery-item"]',
                        type: 'image',
                        closeOnContentClick: true,
                        closeBtnInside: false,
                        fixedContentPos: true,
                        mainClass: 'mfp-no-margins mfp-fade', // class to remove default margin from left and right side
                        image: {
                            verticalFit: true
                        },
                        gallery: {
                            enabled: true,
                            navigateByImgClick: true,
                            preload: [0, 1] // Will preload 0 - before current, and 1 after the current image
                        }
                    });
                });
            }

            if ($lightboxIframeEl.length > 0) {
                $lightboxIframeEl.magnificPopup({
                    disableOn: 600,
                    type: 'iframe',
                    removalDelay: 160,
                    preloader: false,
                    fixedContentPos: false
                });
            }

            if ($lightboxAjaxEl.length > 0) {
                $lightboxAjaxEl.magnificPopup({
                    type: 'ajax',
                    closeBtnInside: false,
                    callbacks: {
                        ajaxContentAdded: function (mfpResponse) {
                            $body.trigger("lightBoxAjaxAdded");
                        },
                        open: function () {
                            $body.addClass('ohidden');
                        },
                        close: function () {
                            $body.removeClass('ohidden');
                        }
                    }
                });
            }

            if ($lightboxAjaxGalleryEl.length > 0) {
                $lightboxAjaxGalleryEl.magnificPopup({
                    delegate: 'a[data-lightbox="ajax-gallery-item"]',
                    type: 'ajax',
                    closeBtnInside: false,
                    gallery: {
                        enabled: true,
                        preload: 0,
                        navigateByImgClick: false
                    },
                    callbacks: {
                        ajaxContentAdded: function (mfpResponse) {
                            $body.trigger("lightBoxAjaxAdded");
                        },
                        open: function () {
                            $body.addClass('ohidden');
                        },
                        close: function () {
                            $body.removeClass('ohidden');
                        }
                    }
                });
            }
        },
        loadFlexSlider: function () {
            $('.fslider').addClass('preloader2');
            var $flexSliderEl = $('.fslider').find('.flexslider');
            if ($flexSliderEl.length > 0) {
                $flexSliderEl.each(function () {
                    var $flexsSlider = $(this),
                        flexsAnimation = $flexsSlider.parent('.fslider').attr('data-animation'),
                        flexsEasing = $flexsSlider.parent('.fslider').attr('data-easing'),
                        flexsDirection = $flexsSlider.parent('.fslider').attr('data-direction'),
                        flexsSlideshow = $flexsSlider.parent('.fslider').attr('data-slideshow'),
                        flexsPause = $flexsSlider.parent('.fslider').attr('data-pause'),
                        flexsSpeed = $flexsSlider.parent('.fslider').attr('data-speed'),
                        flexsVideo = $flexsSlider.parent('.fslider').attr('data-video'),
                        flexsPagi = $flexsSlider.parent('.fslider').attr('data-pagi'),
                        flexsArrows = $flexsSlider.parent('.fslider').attr('data-arrows'),
                        flexsThumbs = $flexsSlider.parent('.fslider').attr('data-thumbs'),
                        flexsHover = $flexsSlider.parent('.fslider').attr('data-hover'),
                        flexsSheight = true,
                        flexsUseCSS = false;

                    if (!flexsAnimation) {
                        flexsAnimation = 'slide';
                    }
                    if (!flexsEasing || flexsEasing == 'swing') {
                        flexsEasing = 'swing';
                        flexsUseCSS = true;
                    }
                    if (!flexsDirection) {
                        flexsDirection = 'horizontal';
                    }
                    if (!flexsSlideshow) {
                        flexsSlideshow = true;
                    } else {
                        flexsSlideshow = false;
                    }
                    if (!flexsPause) {
                        flexsPause = 5000;
                    }
                    if (!flexsSpeed) {
                        flexsSpeed = 600;
                    }
                    if (!flexsVideo) {
                        flexsVideo = false;
                    }
                    if (flexsDirection == 'vertical') {
                        flexsSheight = false;
                    }
                    if (flexsPagi == 'false') {
                        flexsPagi = false;
                    } else {
                        flexsPagi = true;
                    }
                    if (flexsThumbs == 'true') {
                        flexsPagi = 'thumbnails';
                    } else {
                        flexsPagi = flexsPagi;
                    }
                    if (flexsArrows == 'false') {
                        flexsArrows = false;
                    } else {
                        flexsArrows = true;
                    }
                    if (flexsHover == 'false') {
                        flexsHover = false;
                    } else {
                        flexsHover = true;
                    }

                    $flexsSlider.flexslider({
                        selector: ".slider-wrap > .slide",
                        animation: flexsAnimation,
                        easing: flexsEasing,
                        direction: flexsDirection,
                        slideshow: flexsSlideshow,
                        slideshowSpeed: Number(flexsPause),
                        animationSpeed: Number(flexsSpeed),
                        pauseOnHover: flexsHover,
                        video: flexsVideo,
                        controlNav: flexsPagi,
                        directionNav: flexsArrows,
                        smoothHeight: flexsSheight,
                        useCSS: flexsUseCSS,
                        start: function (slider) {
                            KLEO.main.animations();

                            slider.parent().removeClass('preloader2');
                            var t = setTimeout(function () {
                                $('#portfolio.portfolio-masonry,#portfolio.portfolio-full,#posts.post-masonry').isotope('layout');
                            }, 1200);
                            KLEO.main.lightBox();
                            $('.flex-prev').html('<i class="icon-angle-left"></i>');
                            $('.flex-next').html('<i class="icon-angle-right"></i>');
                        }
                    });
                });
            }
        },

        resizeVideos: function () {
            if ($().fitVids) {
                $("#content, .entry-content, .activity-inner").fitVids({
                    ignore: '.no-fv'
                });
            }
        },

        toggleAjaxSearch: function () {
            $('.search-trigger').click(function () {
                if ($('#ajax_search_container').hasClass('searchHidden')) {
                    $('#ajax_search_container').removeClass('searchHidden').addClass('show_search_pop');
                    $(this).next().find(".ajax_s").focus();
                }
                return false;
            });
        },

        doAjaxSearch: function (options) {
            var defaults = {
                delay: 350,                //delay in ms for typing
                minChars: 3,               //no. of characters after we start the search
                scope: 'body'
            }

            this.options = $.extend({}, defaults, options);
            this.scope = $(this.options.scope);
            this.body = $("body");
            this.timer = false;
            this.doingSearch = false;
            this.lastVal = "";
            this.request = "";
            this.bind_ev = function () {
                this.scope.on('keyup', '.ajax_s', $.proxy(this.test_search, this));
                this.body.on('mousedown', $.proxy(this.hide_search, this));

                /* Show the results on input click */
                $(".ajax_s").on('click focus', function () {

                    if ($(this).hasClass('ui-autocomplete-input') === true) {
                        return false;
                    }

                    if ($('body').hasClass('device-xs') === true) {
                        return false;
                    }

                    var res = $(this).closest(".kleo-search-form").find(".kleo_ajax_results");

                    if (!res.is(":empty") && $.trim($(this).val()) != '') {
                        res.slideDown('slow');
                    }
                    res.css("opacity", "1");
                    $("body").addClass("header-submenu-open");
                });

                /* Hide the results on outside click */
                this.body.on('mousedown', function (e) {
                    var element = $(e.target);
                    if (!element.is('.kleo_ajax_results, .ajax_s') && element.closest('.kleo_ajax_results').length == 0) {
                        $(".kleo-search-form .kleo_ajax_results").css("opacity", "0.5").slideUp('slow');
                    }
                });

            };
            this.test_search = function (e) {
                clearTimeout(this.timer);
                if ($.trim(e.currentTarget.value) == '' || $.trim(e.currentTarget.value.length) >= this.options.minChars) {
                    this.timer = setTimeout($.proxy(this.search, this, e), this.options.delay);
                }
            };
            this.hide_search = function (e) {
                var element = $(e.target);
                if (!element.is('#ajax_search_container') && element.parents('#ajax_search_container').length == 0) {
                    $('#ajax_search_container').addClass('searchHidden').removeClass('show_search_pop');
                }
            };
            this.search = function (e) {

                var element = e.currentTarget;

                if ($(element).hasClass('ui-autocomplete-input') === true) {
                    return false;
                }

                if ($('body').hasClass('device-xs') === true) {
                    return false;
                }

                var $this = this,
                    form = $(element).closest("form"),
                    results = form.find(".kleo_ajax_results"),
                    loading = form.children("button"),
                    values = form.serialize();

                values += "&action=kleo_ajax_search";

                if (form.data('context')) {
                    values += "&context=" + form.data('context');
                }

                //if it is not ajax search, bail out
                if (!results.length) {
                    return;
                }

                //if it is another search in place
                if ($this.doingSearch === true) {
                    //return;
                    this.request.abort();
                }

                //if current valuer matches last search value
                if (this.lastVal == $.trim(element.value)) {
                    results.slideDown();
                    return;
                }

                //if current value is blank
                if ($.trim(element.value) == '') {
                    results.slideUp('fast');
                    return;
                }


                this.lastVal = $.trim(element.value);

                this.request = $.ajax({
                    url: ajaxurl,
                    type: "POST",
                    data: values,
                    beforeSend: function () {
                        loading.addClass('animate-spin');
                        $this.doingSearch = true;
                    },
                    success: function (response) {
                        if (response == 0) {
                            response = "";
                        }
                        ;
                        if (results.is(":empty")) {
                            results.hide().html(response).slideDown('slow');
                        } else {
                            results.html(response).slideDown('slow');
                        }
                    },
                    complete: function () {
                        loading.removeClass('animate-spin');
                        $this.doingSearch = false;
                        clearTimeout($this.timer);
                    }
                });
            };

            //do search...
            this.bind_ev();
        },
        applyRetina: function () {
            if (!KLEO.isHighDensity()) {
                return;
            }

            $('[data-retina]').each(function () {
                if ($(this).data("retina") != '') {
                    $(this).find('img').attr('src', $(this).data('retina'));
                }
            });

        },
        ajaxLogin: function () {
            
            $("#kleo-login-modal.mfp-hide .username").removeAttr("name");
            
            if ($("#kleo-login-modal .kleo-login-wrap").length) {

                $('.show-login, .kleo-show-login, .bp-menu.bp-login-nav a, .must-log-in > a').magnificPopup({
                    items: {
                        src: '#kleo-login-modal',
                        type: 'inline',
                        focus: '.username'
                    },
                    preloader: false,
                    mainClass: 'kleo-mfp-zoom',

                    // When element is focused, some mobile browsers in some cases zoom in
                    // It looks not nice, so we disable it:
                    callbacks: {
                        beforeOpen: function () {
                            $("#kleo-login-modal .username").attr("name", "log");
                            
                            if ($(window).width() < 700) {
                                this.st.focus = false;
                            } else {
                                this.st.focus = '.username';
                            }
                        },
                        open: function() {
                            
                        }
                        
                    }
                });
                
            } else {
                $('.show-login, .kleo-show-login, .bp-menu.bp-login-nav a, .must-log-in > a').on('click', function () {
                    $.magnificPopup.close();
                })

            }

            $('form.sq-login-form').on('submit', function (e) {

                var theForm = $(this);
                var resultEl = theForm.find(".kleo-login-result");

                var values = $(this).serialize();
                values += "&action=kleoajaxlogin";


                resultEl.show().html(KLEO.loadingMessage);
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: KLEO.loginUrl,
                    data: values,
                    success: function (data) {
                        resultEl.html(data.message);
                        if (data.loggedin == true) {
                            if (data.redirecturl == null || data.redirecturl == false) {
                                document.location.reload();
                            }
                            else {
                                document.location.href = data.redirecturl;
                            }
                        }
                    },
                    complete: function () {

                    },
                    error: function () {
                        theForm.off('submit');
                        theForm.submit();
                    }
                });
                e.preventDefault();
            })
        },

        ajaxLostPass: function () {

            /* Lost Pass modal */
            $('.show-lostpass').magnificPopup({
                items: {
                    src: '#kleo-lostpass-modal',
                    type: 'inline',
                    focus: 'input'
                },
                preloader: false,
                mainClass: 'kleo-mfp-zoom',

                // When elemened is focused, some mobile browsers in some cases zoom in
                // It looks not nice, so we disable it:
                callbacks: {
                    beforeOpen: function () {
                        if ($(window).width() < 700) {
                            this.st.focus = false;
                        } else {
                            this.st.focus = '#forgot-email';
                        }
                    }
                }
            });

            $(".sq-forgot-form").on("submit", function () {

                var theForm = $(this);
                var resultEl = theForm.find(".kleo-lost-result");

                resultEl.show().html(KLEO.loadingMessage);
                $.ajax({
                    url: KLEO.ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'kleo_lost_password',
                        user_login: $("#forgot-email").val(),
                        security_lost_pass: $("#security-lost-pass").val()
                    },
                    success: function (data) {
                        resultEl.html(data);
                    },
                    error: function () {
                        resultEl.html(KLEO.errorMessage).css('color', 'red');
                    }

                });
                return false;
            });
        },
        kleoIsotope: function () {
            $('.row-masonry-enabled').isotope({
                // options
                itemSelector: '.vc_column_container',
            });
        },
        charts: function () {
            if (typeof google != 'undefined' && $.isFunction(google.setOnLoadCallback)) {
                google.setOnLoadCallback(function () {
                    KLEO.main.kleoIsotope();
                });
            }
        }

    };

    /* -----------------------------------------
     2. Header functions
     ----------------------------------------- */
    KLEO.header = {
        init: function () {
            KLEO.header.adminBarScrollClass();

            // Sidemenu trigger
            $('.sidemenu-trigger').on("click touchstart",function () {

                // close the dropdowns
                $(".menu-list .active .submenu").stop(true, true).slideUp(200);
                $(".menu-list li").removeClass("open");
                
                /* Mobile and tablet specific logic for saved sidemenu state */
                if($('body').hasClass('force-close-sidemenu')) {
                    $('body').removeClass('force-close-sidemenu');

                    if ($('body').hasClass("device-md") || $('body').hasClass("device-lg")) {
                        $('body').toggleClass('sidemenu-is-open');
                    }
                } else {
                    $('body').toggleClass('sidemenu-is-open');
                }

                setTimeout(function () {
                    KLEO.bp.bpIsotope();
                    KLEO.main.kleoIsotope();
                    //trigger the sidemenu-open event
                    $("body").trigger( "sidemenu-moving" );
                }, 300);

                /* Remember left sidemenu open state */
                if ( $('body').hasClass("device-md") || $('body').hasClass("device-lg")) {
                    if ($('body').hasClass('sidemenu-is-open')) {
                        KLEO.main.setCookie('kleo-side', 'open', '/', 30);
                    } else {
                        KLEO.main.setCookie('kleo-side', '', '/', -1);
                    }
                }

                return false;
            });

            // Secondmenu trigger
            $('.second-menu-trigger').on("click touchstart",function () {
                $('body').toggleClass('second-menu-is-open');
                return false;
            });

            // SideMenu list dropdown
            $('.menu-list .has-submenu > .menu-arrow').click(function () {
                var el = $(this);

                if ($('body').hasClass('device-xxs') || $('body').hasClass('device-xs')) {
                    //for mobile
                } else if ($('body').hasClass('device-sm')) {

                    // for Tablet
                    if (! $('body').hasClass('sidemenu-is-open')) {
                        $('body').addClass('sidemenu-is-open');
                    }

                } else {

                    // for Desktop
                    if ($('body').hasClass('sidemenu-is-open')) {
                        $('body').removeClass('sidemenu-is-open');
                    }
                }
            });

            // Search expand on tablet

            $('#main-search').on("focus", function () {
                if ($('body').hasClass("device-sm")) {
                    $("#searchform").addClass("expand");
                }
            }).on("blur", function () {
                if ($('body').hasClass("device-sm")) {
                    $("#searchform").removeClass("expand");
                }
            });

            /* Open menu if submenu item is active */
            if ($(".menu-list .current_page_item").parents(".current-menu-ancestor").length) {
                $(".menu-list .current_page_item").parents(".current-menu-ancestor").addClass("open");
            }

            // dropdown functionality for specific class
            $("body").on('click', ".open-submenu", function (e) {

                KLEO.header.menuDropdown(this);
                e.stopImmediatePropagation();

                return false;
            });

            // header icons dropdown only when click action is set on theme options - header
            $("body").on('click', ".click-menu .header-icons .has-submenu > a", function (e) {

                KLEO.header.menuDropdown(this);
                e.stopImmediatePropagation();

                return false;
            });

            //general dropdown functionality
            $("body").on('click', ".has-submenu .menu-arrow, .has-submenu > a[href='#']", function (e) {

                //enable only on mobile devices or on click menus
                if ( ! $(this).closest("li").parent(".basic-menu").length || $(this).closest('.click-menu').length || KLEO.isMobile.tabletWidth() || KLEO.isMobile.any() ) {
                    KLEO.header.menuDropdown(this);
                }
                e.stopImmediatePropagation();

                return false;
            });

            /* Close the opened submenus when clicking outside */
            $('body').on('click', function (e) {
                var element = $(e.target);
                if (!element.is('.submenu') && element.closest('.submenu').length == 0) {

                    $(".basic-menu .has-submenu.open").removeClass("open");

                    if ( !element.is('.ajax_s') ) {
                        $("body").removeClass("header-submenu-open");
                    }
                }

            });


            KLEO.header.onScroll();
        },

        onScroll: function () {

            $window.on('scroll touchmove', function () {

                KLEO.header.adminBarScrollClass();
            });

        },

        onLoad: function () {

        },

        onResize: function () {

            /* Remove sidemenu-is-open class if it was set by cookie */
            /*if( $('body').hasClass('sidemenu-saved') && ! $('body').hasClass('device-lg') && ! $('body').hasClass('device-md') ) {
             $('body').removeClass('sidemenu-is-open');
             }*/

        },

        menuDropdown: function(e) {
            var hasSubmenuParents = $(e).parents(".has-submenu").length;
            var parent = $(e).closest(".has-submenu");
            if(hasSubmenuParents > 1 ) {
                if(parent.hasClass('open')) {
                    parent.siblings(".has-submenu").removeClass("open");
                    parent.removeClass('open');
                    $("body").removeClass("header-submenu-open");
                } else {
                    parent.addClass('open');
                    $("body").addClass("header-submenu-open");
                }
            } else {
                if(parent.hasClass('open')) {
                    parent.removeClass('open');
                    $(".basic-menu .has-submenu").removeClass("open");
                    $("body").removeClass("header-submenu-open");
                } else {
                    parent.removeClass('open');
                    $(".basic-menu .has-submenu").removeClass("open");
                    parent.addClass('open');
                    $("body").addClass("header-submenu-open");
                }
            }
        },
        /* Admin bar fix on small-mobile & mobile */
        /* Add a class when header is scrolled just for max window width 600px */
        adminBarScrollClass: function () {
            if ($(window).width() < 601) {
                $('html').toggleClass('header-scrolled', $(document).scrollTop() > 0);
            } else {
                $('html').removeClass('header-scrolled');
            }
        }
    };

    /* -----------------------------------------
     3. BuddyPress functions
     ----------------------------------------- */
    KLEO.bp = {
        init: function () {

            //Enable masonry isotope
            $("body").on('gridLoaded', function () {
                KLEO.bp.bpIsotope();
            });

            if ($(".kleo-notifications-nav").length) {
                $("#header").on("click", ".kleo-notifications-nav a.mark-as-read", function (e) {
                    KLEO.bp.notificationsRead($(this));
                    e.preventDefault();
                });
            }
            if ($(".kleo-notifications-nav").length || $(".kleo-messages-nav").length) {
                if (KLEO.hasOwnProperty('bpAjaxRefresh') && KLEO.bpAjaxRefresh != '0') {
                    KLEO.bp.ajaxCalls();
                }
            }
        },
        bpIsotope: function () {
            $(".main-content #members-list, .main-content #member-list, .main-content .groups-dir-list #groups-list, .groups #groups-list").isotope({
                //options
                itemSelector: "li"
            })
        },
        ajaxCalls: function () {

            if ($body.hasClass('customize-preview')) {
                return false;
            }

            KLEO.bp.rehreshID = setInterval(function () {

                var values = 'action=kleo_bp_ajax_call';
                if ($(".kleo-notifications-nav").length) {
                    values += '&current_notifications=' + $(".kleo-notifications b").first().text();
                }
                if ($(".kleo-messages-nav").length) {
                    values += '&current_messages=' + $(".kleo-messages-nav b").first().text();
                }

                $.ajax({
                    url: KLEO.ajaxurl,
                    type: "GET",
                    dataType: "json",
                    data: values,
                    success: function (response) {
                        if (response === null) {
                            return;
                        }
                        if (response.statusNotif == 'success') {
                            if (response.countNotif == '0') {
                                $('.kleo-notifications-nav .footer-item').hide();
                                $(".kleo-notifications-nav b").removeClass("new-alert").addClass("no-alert");
                                $(".kleo-notifications-nav .submenu").removeClass("has-notif");
                            } else {
                                $('.kleo-notifications-nav').addClass("kleo-loading");
                                $(".kleo-notifications-nav b").removeClass("no-alert").addClass("new-alert");
                                $(".kleo-notifications-nav .submenu").addClass("has-notif");
                                $('.kleo-notifications-nav .footer-item').show();
                            }

                            $(".kleo-notifications-nav b").text(response.countNotif);
                            $('.kleo-notifications-nav .kleo-submenu-item').remove();
                            $('.kleo-notifications-nav .submenu').prepend(response.dataNotif);
                        } else {
                            //
                        }

                        if (response.statusMessages == 'success') {
                            if (response.countMessagew == '0') {
                                $('.kleo-messages-nav .footer-item').hide();
                                $(".kleo-messages-nav b").removeClass("new-alert").addClass("no-alert");
                                $(".kleo-messages-nav .submenu").removeClass("has-notif");
                            } else {
                                $('.kleo-messages-nav').addClass("kleo-loading");
                                $(".kleo-messages-nav b").removeClass("no-alert").addClass("new-alert");
                                $(".kleo-messages-nav .submenu").addClass("has-notif");
                                $('.kleo-messages-nav .footer-item').show();
                            }

                            $(".kleo-messages-nav b").text(response.countMessages);
                            $('.kleo-messages-nav .kleo-submenu-item').remove();
                            $('.kleo-messages-nav .submenu').prepend(response.dataMessages);
                        } else {
                            //
                        }

                    }
                });

            }, KLEO.bpAjaxRefresh);


        },

        notificationsRead: function (e) {

            var values = {action: "kleo_bp_notification_mark_read"};

            $.ajax({
                url: KLEO.ajaxurl,
                type: "GET",
                dataType: "json",
                data: values,
                beforeSend: function () {
                    $(".kleo-notifications-nav").addClass("kleo-loading");
                },
                success: function (response) {
                    if (response.status == 'success') {
                        if (response.count == '0') {
                            $('.kleo-notifications-nav .kleo-submenu-item').remove();
                            $('.kleo-notifications-nav .submenu').prepend(response.empty);
                            $('.kleo-notifications-nav .footer-item').hide();
                            $(".kleo-notifications-nav b").removeClass("new-alert").addClass("no-alert");
                            $(".kleo-notifications-nav .submenu").removeClass("has-notif");
                        } else {
                            $(".kleo-notifications-nav b").removeClass("no-alert").addClass("new-alert");
                            $(".kleo-notifications-nav .submenu").addClass("has-notif");
                            $('.kleo-notifications-nav .footer-item').show();
                        }
                        $(".kleo-notifications-nav b").text(response.count);
                    } else {
                        //
                    }

                },
                complete: function () {
                    $(".kleo-notifications-nav").removeClass("kleo-loading");
                }
            });

        }
    }

    /* Some extra useful functions */
    $.fn.inlineStyle = function (prop) {
        return this.prop("style")[$.camelCase(prop)];
    };
    $.fn.doOnce = function (func) {
        this.length && func.apply(this);
        return this;
    };


    var $window = $(window),
        $body = $('body'),
        $wrapper = $('#page-wrapper');


    $(document).ready(function () {
        KLEO.main.init();
        KLEO.header.init();
        KLEO.bp.init();
    });

    $window.load(function () {
        KLEO.main.onLoad();
        KLEO.header.onLoad();
        /* Isotope */
        KLEO.bp.bpIsotope();
    });

    $window.on('resize', function () {
        KLEO.main.onResize();
        KLEO.header.onResize();
    });

})(jQuery);


/*	jQuery.flexMenu 1.2
 https://github.com/352Media/flexMenu
 Description: If a list is too long for all items to fit on one line, display a popup menu instead.
 Dependencies: jQuery, Modernizr (optional). Without Modernizr, the menu can only be shown on click (not hover). */

(function ($) {
    $.fn.flexMenu = function (options) {

        var checkFlexObject,
            s = $.extend({
                'threshold' : 2, // [integer] If there are this many items or fewer in the list, we will not display a "View More" link and will instead let the list break to the next line. This is useful in cases where adding a "view more" link would actually cause more things to break  to the next line.
                'cutoff' : 2, // [integer] If there is space for this many or fewer items outside our "more" popup, just move everything into the more menu. In that case, also use linkTextAll and linkTitleAll instead of linkText and linkTitle. To disable this feature, just set this value to 0.
                'linkText' : '&#xe8c0;', // [string] What text should we display on the "view more" link?
                'linkTitle' : '&#xe8c0;', // [string] What should the title of the "view more" button be?
                'linkTextAll' : '&#xe8c0;', // [string] If we hit the cutoff, what text should we display on the "view more" link?
                'linkTitleAll' : 'Open/Close Menu', // [string] If we hit the cutoff, what should the title of the "view more" button be?
                'showOnHover' : true, // [boolean] Should we we show the menu on hover? If not, we'll require a click. If we're on a touch device - or if Modernizr is not available - we'll ignore this setting and only show the menu on click. The reason for this is that touch devices emulate hover events in unpredictable ways, causing some taps to do nothing.
                'popupAbsolute' : true, // [boolean] Should we absolutely position the popup? Usually this is a good idea. That way, the popup can appear over other content and spill outside a parent that has overflow: hidden set. If you want to do something different from this in CSS, just set this option to false.
                'undo' : false // [boolean] Move the list items back to where they were before, and remove the "View More" link.
            }, options);
        this.options = s; // Set options on object
        checkFlexObject = $.inArray(this, flexObjects); // Checks if this object is already in the flexObjects array
        if (checkFlexObject >= 0) {
            flexObjects.splice(checkFlexObject, 1); // Remove this object if found
        } else {
            flexObjects.push(this); // Add this object to the flexObjects array
        }
        return this.each(function () {
            var $this = $(this),
                $items = $this.find('> li'),
                $self = $this,
                $firstItem = $items.first(),
                $lastItem = $items.last(),
                numItems = $this.find('li').length,
                firstItemTop = Math.floor($firstItem.offset().top),
                firstItemHeight = Math.floor($firstItem.outerHeight(true)),
                $lastChild,
                keepLooking,
                $moreItem,
                $moreLink,
                numToRemove,
                allInPopup = false,
                $menu,
                i;
            function needsMenu($itemOfInterest) {
                var result = (Math.ceil($itemOfInterest.offset().top) >= (firstItemTop + firstItemHeight)) ? true : false;
                // Values may be calculated from em and give us something other than round numbers. Browsers may round these inconsistently. So, let's round numbers to make it easier to trigger flexMenu.
                return result;
            }

            if (needsMenu($lastItem) && numItems > s.threshold && !s.undo && $this.is(':visible') && ! KLEO.isMobile.tabletWidth() ) {
                var $popup = $('<ul class="flexMenu-popup submenu" style="' + ((s.popupAbsolute) ? ' position: absolute;' : '') + '"></ul>'),
                // Move all list items after the first to this new popup ul
                    firstItemOffset = $firstItem.offset().top;
                for (i = numItems; i > 1; i--) {
                    // Find all of the list items that have been pushed below the first item. Put those items into the popup menu. Put one additional item into the popup menu to cover situations where the last item is shorter than the "more" text.
                    $lastChild = $this.find('> li:last-child');
                    keepLooking = (needsMenu($lastChild));
                    $lastChild.appendTo($popup);
                    // If there only a few items left in the navigation bar, move them all to the popup menu.
                    if ((i - 1) <= s.cutoff) { // We've removed the ith item, so i - 1 gives us the number of items remaining.
                        $($this.children().get().reverse()).appendTo($popup);
                        allInPopup = true;
                        break;
                    }
                    if (!keepLooking) {
                        break;
                    }
                }
                if (allInPopup) {
                    $this.append('<li class="more-wrapper flexMenu-allInPopup has-submenu"><a class="more" href="#" title="' + s.linkTitleAll + '">' + s.linkTextAll + '</a></li>');
                } else {
                    $this.append('<li class="more-wrapper has-submenu"><a href="#" class="more" title="' + s.linkTitle + '">' + s.linkText + '</a></li>');
                }
                $moreItem = $this.find('> li.more-wrapper');
                /// Check to see whether the more link has been pushed down. This might happen if the link immediately before it is especially wide.
                if (needsMenu($moreItem)) {
                    $this.find('> li:nth-last-child(2)').appendTo($popup);
                }
                // Our popup menu is currently in reverse order. Let's fix that.
                $popup.children().each(function (i, li) {
                    $popup.prepend(li);
                });
                $moreItem.append($popup);
                $moreLink = $this.find('> li.more-wrapper > a');
                /*$moreLink.click(function (e) {
                 // Collapsing any other open flexMenu
                 collapseAllExcept($moreItem);
                 //Open and Set active the one being interacted with.
                 $popup.toggle();
                 $moreItem.toggleClass('active');
                 e.preventDefault();
                 });*/
                if (s.showOnHover && (typeof Modernizr !== 'undefined') && !Modernizr.touch) { // If requireClick is false AND touch is unsupported, then show the menu on hover. If Modernizr is not available, assume that touch is unsupported. Through the magic of lazy evaluation, we can check for Modernizr and start using it in the same if statement. Reversing the order of these variables would produce an error.
                    $moreItem.hover(
                        function () {
                            $popup.show();
                            $(this).addClass('active');
                        },
                        function () {
                            $popup.hide();
                            $(this).removeClass('active');
                        });
                }
            } else if (s.undo && $this.find('ul.flexMenu-popup')) {
                $menu = $this.find('ul.flexMenu-popup');
                numToRemove = $menu.find('li').length;
                for (i = 1; i <= numToRemove; i++) {
                    $menu.find('> li:first-child').appendTo($this);
                }
                $menu.remove();
                $this.find('> li.more-wrapper').remove();
            }
        });
    };

    $(document).ready(function(){
        if ( $('.header-menu > li').length > 1 ) {
            $('.header-menu').flexMenu({
                /*showOnHover: function () {
                    return !KLEO.isMobile.tabletWidth();
                },*/
                showOnHover: false,
                popupAbsolute : false
            });
        }

        if ( $('.header-icons > li').length > 1 ) {
            $('.header-icons').flexMenu({
                /*showOnHover: function () {
                    return !KLEO.isMobile.tabletWidth();
                }*/
                showOnHover: false,
                popupAbsolute : false
            });
        }

        $("body").on( "sidemenu-moving", function() {
            adjustFlexMenu();
        });
    });

    var flexObjects = [], // Array of all flexMenu objects
        resizeTimeout;
    // When the page is resized, adjust the flexMenus.
    function adjustFlexMenu() {
        $(flexObjects).each(function () {
            $(this).flexMenu({
                'undo' : true
            }).flexMenu(this.options);
        });
    }

    function collapseAllExcept($menuToAvoid) {
        var $activeMenus,
            $menusToCollapse;
        $activeMenus = $('li.more-wrapper.active');
        $menusToCollapse = $activeMenus.not($menuToAvoid);
        $menusToCollapse.removeClass('active').find('> ul').hide();
    }
    $(window).resize(function () {
        clearTimeout(resizeTimeout);

        resizeTimeout = setTimeout(function () {
            adjustFlexMenu();
        }, 200);
    });
})(jQuery);























