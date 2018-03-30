(function ($) {
    'use strict';

    var shortcodes = {};

    mkdf.modules.shortcodes = shortcodes;

    shortcodes.mkdfInitTabs = mkdfInitTabs;
    shortcodes.mkdfCustomFontResize = mkdfCustomFontResize;
    shortcodes.mkdfBlockReveal = mkdfBlockReveal;
    shortcodes.mkdfLayoutFour = mkdfLayoutFour;
    shortcodes.mkdfBlockThree = mkdfBlockThree;
    shortcodes.mkdfBreakingNews = mkdfBreakingNews;
    shortcodes.mkdfPostClassicSlider = mkdfPostClassicSlider;
    shortcodes.mkdfPostWithThumbnailSlider = mkdfPostWithThumbnailSlider;
    shortcodes.mkdfPostCarousel = mkdfPostCarousel;
    shortcodes.mkdfPostCarouselSwipe = mkdfPostCarouselSwipe;
    shortcodes.mkdfInitStickyWidget = mkdfInitStickyWidget;
    shortcodes.mkdfShowGoogleMap = mkdfShowGoogleMap;

    $(document).ready(function () {
        mkdfIcon().init();
        mkdfInitTabs();
        mkdfButton().init();
        mkdfCustomFontResize();
        mkdfBlockReveal();
        mkdfLayoutFour();
        mkdfBlockThree();
        mkdfBlockThreeMobile();
        mkdfBreakingNews();
        mkdfPostClassicSlider();
        mkdfPostWithThumbnailSlider();
        mkdfPostCarousel();
        mkdfPostCarouselSwipe();
        mkdfSocialIconWidget().init();
        mkdfPostPagination().init();
        mkdfRecentCommentsHover();
        mkdfShowGoogleMap();
    });

    $(window).resize(function () {
        mkdfCustomFontResize();
        mkdfCarouselResize();
        mkdfInitStickyWidget();
        mkdfBlockThree();
        mkdfBlockThreeMobile();
    });

    $(window).load(function () {
        mkdfPostLayoutTabWidget().init();
        mkdfInitStickyWidget();
        mkdf.modules.common.mkdfInitParallax();
        mkdfPostTemplateAnimateExcerpt();
    });

    /**
     * Object that represents icon shortcode
     * @returns {{init: Function}} function that initializes icon's functionality
     */
    var mkdfIcon = mkdf.modules.shortcodes.mkdfIcon = function () {
        //get all icons on page
        var icons = $('.mkdf-icon-shortcode');

        /**
         * Function that triggers icon animation and icon animation delay
         */
        var iconAnimation = function (icon) {
            if (icon.hasClass('mkdf-icon-animation')) {
                icon.appear(function () {
                    icon.parent('.mkdf-icon-animation-holder').addClass('mkdf-icon-animation-show');
                }, {accX: 0, accY: mkdfGlobalVars.vars.mkdfElementAppearAmount});
            }
        };

        /**
         * Function that triggers icon hover color functionality
         */
        var iconHoverColor = function (icon) {
            if (typeof icon.data('hover-color') !== 'undefined') {
                var changeIconColor = function (event) {
                    event.data.icon.css('color', event.data.color);
                };

                var iconElement = icon.find('.mkdf-icon-element');
                var hoverColor = icon.data('hover-color');
                var originalColor = iconElement.css('color');

                if (hoverColor !== '') {
                    icon.on('mouseenter', {icon: iconElement, color: hoverColor}, changeIconColor);
                    icon.on('mouseleave', {icon: iconElement, color: originalColor}, changeIconColor);
                }
            }
        };

        /**
         * Function that triggers icon holder background color hover functionality
         */
        var iconHolderBackgroundHover = function (icon) {
            if (typeof icon.data('hover-background-color') !== 'undefined') {
                var changeIconBgColor = function (event) {
                    event.data.icon.css('background-color', event.data.color);
                };

                var hoverBackgroundColor = icon.data('hover-background-color');
                var originalBackgroundColor = icon.css('background-color');

                if (hoverBackgroundColor !== '') {
                    icon.on('mouseenter', {icon: icon, color: hoverBackgroundColor}, changeIconBgColor);
                    icon.on('mouseleave', {icon: icon, color: originalBackgroundColor}, changeIconBgColor);
                }
            }
        };

        /**
         * Function that initializes icon holder border hover functionality
         */
        var iconHolderBorderHover = function (icon) {
            if (typeof icon.data('hover-border-color') !== 'undefined') {
                var changeIconBorder = function (event) {
                    event.data.icon.css('border-color', event.data.color);
                };

                var hoverBorderColor = icon.data('hover-border-color');
                var originalBorderColor = icon.css('border-color');

                if (hoverBorderColor !== '') {
                    icon.on('mouseenter', {icon: icon, color: hoverBorderColor}, changeIconBorder);
                    icon.on('mouseleave', {icon: icon, color: originalBorderColor}, changeIconBorder);
                }
            }
        };

        return {
            init: function () {
                if (icons.length) {
                    icons.each(function () {
                        iconAnimation($(this));
                        iconHoverColor($(this));
                        iconHolderBackgroundHover($(this));
                        iconHolderBorderHover($(this));
                    });

                }
            }
        };
    };

    /**
     * Object that represents social icon widget
     * @returns {{init: Function}} function that initializes icon's functionality
     */
    var mkdfSocialIconWidget = mkdf.modules.shortcodes.mkdfSocialIconWidget = function () {
        //get all social icons on page
        var icons = $('.mkdf-social-icon-widget-holder');

        /**
         * Function that triggers icon hover color functionality
         */
        var socialIconHoverColor = function (icon) {
            if (typeof icon.data('hover-color') !== 'undefined') {
                var changeIconColor = function (event) {
                    event.data.icon.css('color', event.data.color);
                };

                var iconElement = icon;
                var hoverColor = icon.data('hover-color');
                var originalColor = iconElement.css('color');

                if (hoverColor !== '') {
                    icon.on('mouseenter', {icon: iconElement, color: hoverColor}, changeIconColor);
                    icon.on('mouseleave', {icon: iconElement, color: originalColor}, changeIconColor);
                }
            }
        };

        return {
            init: function () {
                if (icons.length) {
                    icons.each(function () {
                        socialIconHoverColor($(this));
                    });

                }
            }
        };
    };

    /*
     **	Init tabs shortcode
     */
    function mkdfInitTabs() {

        var tabs = $('.mkdf-tabs');
        if (tabs.length) {
            tabs.each(function () {
                var thisTabs = $(this);

                if (!thisTabs.hasClass('mkdf-ptw-holder')) {
                    thisTabs.children('.mkdf-tab-container').each(function (index) {
                        index = index + 1;

                        var that = $(this),
                            link = that.attr('id');

                        var navItem = -1;
                        if (that.parent().find('.mkdf-tabs-nav li').hasClass('mkdf-tabs-title-holder')) {
                            index = index + 1;

                            if (that.parent().find('.mkdf-tabs-nav li.mkdf-tabs-title-holder .mkdf-tabs-title-image').length) {
                                that.parent().find('.mkdf-tabs-nav li.mkdf-tabs-title-holder').children('.mkdf-tabs-title-image:first-child').addClass('mkdf-active-tab-image');
                            }
                        }
                        navItem = that.parent().find('.mkdf-tabs-nav li:nth-child(' + index + ') a');

                        var navLink = navItem.attr('href');

                        link = '#' + link;

                        if (link.indexOf(navLink) > -1) {
                            navItem.attr('href', link);
                        }
                    });
                }

                thisTabs.tabs({
                    activate: function () {
                        thisTabs.find('.mkdf-tabs-nav li').each(function () {
                            var thisTab = $(this);

                            if (thisTab.hasClass('ui-tabs-active')) {
                                var activeTab = thisTab.index();

                                if (thisTab.parent().find('.mkdf-tabs-title-image').length) {
                                    thisTab.parent().find('.mkdf-tabs-title-image').removeClass('mkdf-active-tab-image');
                                    thisTab.parent().find('.mkdf-tabs-title-image:nth-child(' + activeTab + ')').addClass('mkdf-active-tab-image');
                                }
                            }
                        });
                    }
                });
            });
        }
    }

    /**
     * Button object that initializes whole button functionality
     * @type {Function}
     */
    var mkdfButton = mkdf.modules.shortcodes.mkdfButton = function () {
        //all buttons on the page
        var buttons = $('.mkdf-btn');

        /**
         * Initializes button hover color
         * @param button current button
         */
        var buttonHoverColor = function (button) {
            if (typeof button.data('hover-color') !== 'undefined') {
                var changeButtonColor = function (event) {
                    event.data.button.css('color', event.data.color);
                };

                var originalColor = button.css('color');
                var hoverColor = button.data('hover-color');

                button.on('mouseenter', {button: button, color: hoverColor}, changeButtonColor);
                button.on('mouseleave', {button: button, color: originalColor}, changeButtonColor);
            }
        };


        /**
         * Initializes button hover background color
         * @param button current button
         */
        var buttonHoverBgColor = function (button) {
            if (typeof button.data('hover-bg-color') !== 'undefined') {
                var changeButtonBg = function (event) {
                    event.data.button.css('background-color', event.data.color);
                };

                var originalBgColor = button.css('background-color');
                var hoverBgColor = button.data('hover-bg-color');

                button.on('mouseenter', {button: button, color: hoverBgColor}, changeButtonBg);
                button.on('mouseleave', {button: button, color: originalBgColor}, changeButtonBg);
            }
        };

        /**
         * Initializes button icon hover background color
         * @param button current button
         */
        var buttonIconHoverBgColor = function (button) {
            if (!button.hasClass('mkdf-btn-outline') && (typeof button.data('icon-hover-bg-color') !== 'undefined' || typeof button.data('icon-hover-bg-color') !== 'undefined')) {
                if (typeof button.data('icon-bg-color') !== 'undefined') {
                    button.children('.mkdf-btn-icon-element').css('background-color', button.data('icon-bg-color'));
                }

                var changeButtonIconBg = function (event) {
                    event.data.button.children('.mkdf-btn-icon-element').css('background-color', event.data.color);
                };

                var originalIconBgColor = (typeof button.data('icon-bg-color') !== 'undefined') ? button.data('icon-bg-color') : 'transparent';
                var hoverIconBgColor = (typeof button.data('icon-hover-bg-color') !== 'undefined') ? button.data('icon-hover-bg-color') : 'transparent';

                button.on('mouseenter', {button: button, color: hoverIconBgColor}, changeButtonIconBg);
                button.on('mouseleave', {button: button, color: originalIconBgColor}, changeButtonIconBg);
            }
        };

        /**
         * Initializes button border color
         * @param button
         */
        var buttonHoverBorderColor = function (button) {
            if (typeof button.data('hover-border-color') !== 'undefined') {
                var changeBorderColor = function (event) {
                    event.data.button.css('border-color', event.data.color);
                };

                var originalBorderColor = button.css('border-color');
                var hoverBorderColor = button.data('hover-border-color');

                button.on('mouseenter', {button: button, color: hoverBorderColor}, changeBorderColor);
                button.on('mouseleave', {button: button, color: originalBorderColor}, changeBorderColor);
            }
        };

        return {
            init: function () {
                if (buttons.length) {
                    buttons.each(function () {
                        buttonHoverColor($(this));
                        buttonHoverBgColor($(this));
                        buttonHoverBorderColor($(this));
                        buttonIconHoverBgColor($(this));
                    });
                }
            }
        };
    };

    /*
     **	Custom Font resizing
     */
    function mkdfCustomFontResize() {
        var customFont = $('.mkdf-custom-font-holder');
        if (customFont.length) {
            customFont.each(function () {
                var thisCustomFont = $(this);
                var fontSize;
                var lineHeight;
                var coef1 = 1;
                var coef2 = 1;

                if (mkdf.windowWidth < 1200) {
                    coef1 = 0.8;
                }

                if (mkdf.windowWidth < 1000) {
                    coef1 = 0.7;
                }

                if (mkdf.windowWidth < 768) {
                    coef1 = 0.6;
                    coef2 = 0.7;
                }

                if (mkdf.windowWidth < 600) {
                    coef1 = 0.5;
                    coef2 = 0.6;
                }

                if (mkdf.windowWidth < 480) {
                    coef1 = 0.4;
                    coef2 = 0.5;
                }

                if (typeof thisCustomFont.data('font-size') !== 'undefined' && thisCustomFont.data('font-size') !== false) {
                    fontSize = parseInt(thisCustomFont.data('font-size'));

                    if (fontSize > 70) {
                        fontSize = Math.round(fontSize * coef1);
                    }
                    else if (fontSize > 35) {
                        fontSize = Math.round(fontSize * coef2);
                    }

                    thisCustomFont.css('font-size', fontSize + 'px');
                }

                if (typeof thisCustomFont.data('line-height') !== 'undefined' && thisCustomFont.data('line-height') !== false) {
                    lineHeight = parseInt(thisCustomFont.data('line-height'));

                    if (lineHeight > 70 && mkdf.windowWidth < 1200) {
                        lineHeight = '1.2em';
                    }
                    else if (lineHeight > 35 && mkdf.windowWidth < 768) {
                        lineHeight = '1.2em';
                    }
                    else {
                        lineHeight += 'px';
                    }

                    thisCustomFont.css('line-height', lineHeight);
                }
            });
        }
    }

    /*
     **  Init block revealing
     */
    function mkdfBlockReveal() {

        var blockHolder = $('.mkdf-block-revealing .mkdf-bnl-inner');

        if (blockHolder.length) {
            blockHolder.each(function () {
                var thisBlockHolder = $(this);
                var thisBlockNonFeaturedHolder = thisBlockHolder.find('.mkdf-pbr-non-featured');
                var thisBlockFeaturedHolder = thisBlockHolder.find('.mkdf-pbr-featured');
                var currentItemPosition = 1;
                var activeItemClass = 'mkdf-block-reveal-active-item';
                var activeNonFItemClass = 'mkdf-reveal-nonf-active';
                var thisFeaturedBlocks = thisBlockFeaturedHolder.find('.mkdf-post-block-part-inner');
                var currentItem;
                var itemInterval = 4000;
                var numberOfItems = thisBlockNonFeaturedHolder.find('.mkdf-pt-four-item').length;
                var isPaused = false;
                var loop;

                thisFeaturedBlocks.each(function (e) {
                    var thisFeatured = $(this);

                    if (thisFeatured.hasClass('mkdf-block-reveal-active-item')) {
                        currentItemPosition = e + 1;
                    }
                });

                thisBlockFeaturedHolder.children('.mkdf-post-block-part-inner:nth-child(' + currentItemPosition + ')').addClass(activeItemClass);
                thisBlockNonFeaturedHolder.find('.mkdf-pt-four-item:nth-child(' + currentItemPosition + ')').addClass(activeNonFItemClass);
                thisBlockFeaturedHolder.children('.mkdf-post-block-part-inner:nth-child(' + currentItemPosition + ')').fadeIn(200);

                thisBlockNonFeaturedHolder.find('a').click(function (e) {
                    e.preventDefault();

                    var thisItem = $(this).parents('.mkdf-pbr-non-featured .mkdf-pt-four-item');

                    currentItemPosition = $(this).parents('.mkdf-pbr-non-featured > .mkdf-pbr-non-featured-inner > .mkdf-post-item-outer > .mkdf-post-item').index() + 1; // +1 is because index start from 0 and list from 1
                    thisBlockFeaturedHolder.children('.mkdf-post-block-part-inner').removeClass(activeItemClass);
                    thisBlockNonFeaturedHolder.find('.mkdf-pt-four-item').removeClass(activeNonFItemClass);
                    thisBlockFeaturedHolder.children('.mkdf-post-block-part-inner:nth-child(' + currentItemPosition + ')').addClass(activeItemClass);
                    thisItem.addClass(activeNonFItemClass);

                    if ($(window).width() <= 1024) {
                        mkdfBlockThreeMobile();
                    }

                });

                mkdf.modules.common.mkdfInitParallax();
                showcaseLoop();

                thisBlockHolder.hover(function (e) {
                    isPaused = true;
                    clearInterval(loop);
                },function (e) {
                    isPaused = false;
                    showcaseLoop();
                });


                //loop through the items
                function showcaseLoop()  {
                    currentItem = 0; //start from the first item, index = 0

                    loop = setInterval(function(){
                         if (!isPaused) {
                            if (currentItemPosition == numberOfItems) {
                                currentItemPosition = 1;
                            } else {
                                currentItemPosition++;
                            }

                            thisBlockFeaturedHolder.children('.mkdf-post-block-part-inner').removeClass(activeItemClass);
                            thisBlockNonFeaturedHolder.find('.mkdf-pt-four-item').removeClass(activeNonFItemClass);
                            thisBlockFeaturedHolder.children('.mkdf-post-block-part-inner:nth-child(' + currentItemPosition + ')').addClass(activeItemClass);
                            thisBlockNonFeaturedHolder.find('.mkdf-pt-four-item:nth-child(' + currentItemPosition + ')').addClass(activeNonFItemClass);
                            thisBlockFeaturedHolder.children('.mkdf-post-block-part-inner:nth-child(' + currentItemPosition + ')');

                         }
                        else {
                             isPaused = false;
                         }
                    }, itemInterval);
                }

            });
        }
    }

    /*
     **  Layout 4 calculations
     */
    function mkdfLayoutFour() {
        var layoutHolder = $('header .widget .mkdf-pl-four-holder .mkdf-bnl-outer');

        if (layoutHolder.length) {
            layoutHolder.each(function () {
                var thisLayoutHolder = $(this);
                var thisLayoutItem = thisLayoutHolder.find('.mkdf-pt-four-item');
                var height = layoutHolder.innerHeight();

                thisLayoutItem.each(function () {
                    $(this).height(height);
                });
            });
        }
    }

    /*
     **  Block 3 calculations
     */
    function mkdfBlockThree() {

        if ($(window).width() > 1024) {

            var blockHolder = $('.mkdf-pb-three-holder .mkdf-bnl-inner');

            blockHolder.waitForImages(function () {

                if (blockHolder.length) {
                    blockHolder.each(function () {
                        var thisBlockHolder = $(this),
                            thisBlockFeaturedHolder = thisBlockHolder.find('.mkdf-pbr-featured'),
                            thisBlocks = thisBlockHolder.find('.mkdf-post-block-part-inner'),
                            minHeight = parseInt(thisBlockFeaturedHolder.height());

                        thisBlocks.each(function () {
                            var thisBlockHeight = parseInt($(this).height());
                            if (thisBlockHeight > minHeight) {
                                minHeight = thisBlockHeight;
                            }
                        });

                        thisBlockFeaturedHolder.css('height', minHeight);

                    });
                }
            });
        }
    }


    /*
     **  Block 3 mobile calculations
     */
    function mkdfBlockThreeMobile() {
        var blockThree = $('.mkdf-pb-three-holder');
        if (blockThree.length) {
            blockThree.each(function () {
                var activeItem = $(this).find('.mkdf-block-reveal-active-item img'),
                    activeItemImage = activeItem.attr('src');

                if ($(window).width() < 1024) {
                    activeItem.closest('.mkdf-bnl-outer').css({'background-image': 'url(' + activeItemImage + ')'});
                }
                else {
                    activeItem.closest('.mkdf-bnl-outer').css({'background-image': 'none'});
                }
            });
        }
    }


    /*
     **  Init breaking news
     */
    function mkdfBreakingNews() {

        var bnHolder = $('.mkdf-bn-holder');

        if (bnHolder.length) {

            bnHolder.each(function () {
                var thisBnHolder = $(this);

                thisBnHolder.css('display', 'inline-block');

                var slideshowSpeed = (thisBnHolder.data('slideshowSpeed') !== '' && thisBnHolder.data('slideshowSpeed') !== undefined) ? thisBnHolder.data('slideshowSpeed') : 3000;
                var animationSpeed = (thisBnHolder.data('animationSpeed') !== '' && thisBnHolder.data('animationSpeed') !== undefined) ? thisBnHolder.data('animationSpeed') : 400;

                thisBnHolder.flexslider({
                    selector: ".mkdf-bn-text",
                    animation: "fade",
                    controlNav: false,
                    directionNav: false,
                    maxItems: 1,
                    allowOneSlide: true,
                    slideshowSpeed: slideshowSpeed,
                    animationSpeed: animationSpeed
                });
            });
        }
    }

    /*
     **  Init classic slider
     */
    function mkdfPostClassicSlider() {

        var classicSlider = $('.mkdf-psc-holder');

        if (classicSlider.length) {
            classicSlider.each(function () {
                var thisSliderHolder = $(this),
                    control = false,
                    directionNav = false;

                if (thisSliderHolder.hasClass('mkdf-psc-full-screen')) {
                    var fullScreenHeight = function () {
                        var mkdfHeaderheight;
                        var topBar = $('.mkdf-top-bar');
                        var topBarHeight = topBar.is(':visible') ? topBar.height() : 0;
                        if (mkdf.windowWidth <= 1024) {
                            mkdfHeaderheight = mkdfGlobalVars.vars.mkdfMobileHeaderHeight + topBarHeight;
                        } else {
                            mkdfHeaderheight = mkdfPerPageVars.vars.mkdfHeaderHeight;
                        }
                        thisSliderHolder.find('.mkdf-psc-slide').height(mkdf.windowHeight - mkdfHeaderheight);
                    };
                    fullScreenHeight();
                    $(window).resize(function () {
                        fullScreenHeight();
                    });
                }

                directionNav = thisSliderHolder.data('display_navigation') == 'yes';
                control = thisSliderHolder.data('display_paging') == 'yes';

                thisSliderHolder.css('opacity', '1');

                thisSliderHolder.flexslider({
                    selector: ".mkdf-psc-slide",
                    animation: "fade",
                    controlNav: control,
                    customDirectionNav: "<span><b></b></span>",
                    directionNav: directionNav,
                    prevText: "<span class='ion-chevron-left'></span>",
                    nextText: "<span class='ion-chevron-right'></span>",
                    maxItems: 1,
                    slideshowSpeed: 4000,
                    animationSpeed: 500,
                    pauseOnHover: false,
                    easing: 'easeOutQuart',
                    start: function () {
                        mkdf.modules.common.mkdfInitParallax();
                        mkdfAnimatePSC();
                    },
                    after: function () {
                        mkdfAnimatePSC();
                    }
                });

                function mkdfAnimatePSC() {
                    thisSliderHolder.find('.flex-active-slide').addClass('mkdf-appeared');
                    thisSliderHolder.find(':not(.flex-active-slide)').removeClass('mkdf-appeared');
                }
            });
        }
    }

    /*
     **  Init with thumbnails slider
     */
    function mkdfPostWithThumbnailSlider() {

        var withThumbnailSlider = $('.mkdf-pswt-holder');

        if (withThumbnailSlider.length) {
            withThumbnailSlider.each(function () {
                var thisSliderHolder = $(this),
                    control = true,
                    directionNav = true,
                    thisSlider = thisSliderHolder.find('.mkdf-pswt-slider'),
                    thisSliderArrows;

                thisSlider.flexslider({
                    selector: ".mkdf-pswt-slides > .mkdf-pswt-slide",
                    animation: "slide",
                    controlNav: control,
                    animationLoop: true,
                    directionNav: directionNav,
                    maxItems: 1,
                    easeing: 'easeInOutSine',
                    slideshowSpeed: 4000,
                    animationSpeed: 800,
                    pauseOnHover: false,
                    prevText: "<span class='ion-chevron-left'></span>",
                    nextText: "<span class='ion-chevron-right'></span>",
                    manualControls: '.mkdf-pswt-slide-thumb',
                    start: function () {
                        mkdf.modules.common.mkdfInitParallax();
                        thisSliderArrows = thisSlider.find('.flex-direction-nav li');
                        thisSliderHolder.animate({opacity: 1}, 300, function () {
                            thisSliderHolder.find('.mkdf-pswt-slides-thumb').css('opacity', 1);
                        });
                        mkdfAddPositionForNavigation(thisSliderHolder);
                        mkdfAnimatePSWT();
                    },
                    after: function () {
                        mkdfAnimatePSWT();
                    }
                });

                function mkdfAnimatePSWT() {
                    thisSliderHolder.find('.flex-active-slide').addClass('mkdf-appeared');
                    thisSliderHolder.find(':not(.flex-active-slide)').removeClass('mkdf-appeared');
                }

            });
        }
    }


    /*
     **  Add position for navigation arrows witch depends of thumb size
     */
    function mkdfAddPositionForNavigation(thisSliderHolder) {

        var thumbnailHeight;

        if (thisSliderHolder.find('.mkdf-pswt-slide').length && thisSliderHolder.find('.mkdf-pswt-slides-thumb').length) {
            thumbnailHeight = thisSliderHolder.find('.mkdf-pswt-slides-thumb').height();
            thisSliderHolder.find('.flex-direction-nav > li').css('margin-top', thumbnailHeight / -2 + 'px');
        }
    }


    /*
     **  Init post carousel
     */
    function mkdfPostCarousel() {


        var carousels = $('.mkdf-pcs-holder');

        if (carousels.length) {
            carousels.each(function () {
                var thisCarouselHolder = $(this),
                    thisCarousel = thisCarouselHolder.find('.mkdf-bnl-inner'),
                    slidesToShow = mkdfCarouselNumberOfItems(thisCarouselHolder),
                    directionNav = thisCarouselHolder.data('display_navigation') == 'yes';

                thisCarousel.on('init', function (event, slick) {
                    thisCarousel.animate({opacity: 1}, 200);
                    mkdf.modules.common.mkdfInitParallax();
                });

                thisCarousel.slick({
                    arrows: directionNav,
                    prevArrow: "<span class='ion-chevron-left'></span>",
                    nextArrow: "<span class='ion-chevron-right'></span>",
                    autoplay: true,
                    autoplaySpeed: 4000,
                    infinite: true,
                    speed: 1100,
                    slidesToShow: slidesToShow,
                    slidesToScroll: 1,
                    responsive: [
                        {
                            breakpoint: 1025,
                            settings: {
                                slidesToShow: 2
                            }
                        },
                        {
                            breakpoint: 600,
                            settings: {
                                slidesToShow: 1
                            }
                        }
                    ]
                });
            });
        }
    }

    /*
     * Calculate number of elements for carousel
     */

    function mkdfCarouselNumberOfItems(carousel) {

        var maxItems = 2;

        if (carousel.hasClass('three-posts')) {
            maxItems = 3;
        }
        else if (carousel.hasClass('four-posts')) {
            maxItems = 4;
        }

        if (mkdf.windowWidth < 1025) {
            maxItems = 2;
        }

        return maxItems;
    }

    /*
     * Resizing carousel
     */

    function mkdfCarouselResize() {

        var carousels = $('.mkdf-pc-holder');

        if (carousels.length) {
            carousels.each(function () {
                var thisCarouselHolder = $(this),
                    thisCarousel = thisCarouselHolder.children('.mkdf-bnl-outer');

                var items = mkdfCarouselNumberOfItems(thisCarouselHolder);

                thisCarousel.data('flexslider').vars.minItems = items;
                thisCarousel.data('flexslider').vars.maxItems = items;
            });
        }
    }

    /*
     **  Init post carousel swipe
     */
    function mkdfPostCarouselSwipe() {

        var swipeCarousels = $('.mkdf-pcs-swipe-holder');

        if (swipeCarousels.length) {
            swipeCarousels.each(function () {
                var thisSwipeCarousel = $(this),
                    thisSwipe = thisSwipeCarousel.children('.mkdf-bnl-outer'),
                    slidesToShow = mkdfCarouselNumberOfItems(thisSwipeCarousel),
                    directionNav = thisSwipeCarousel.data('display_navigation') == 'yes';


                thisSwipe.on('init', function (event, slick) {
                    thisSwipe.animate({opacity: 1}, 200);
                    mkdf.modules.common.mkdfInitParallax();
                });

                thisSwipe.slick({
                    arrows: directionNav,
                    prevArrow: "<span class='ion-chevron-left'></span>",
                    nextArrow: "<span class='ion-chevron-right'></span>",
                    autoplay: true,
                    autoplaySpeed: 2500,
                    infinite: true,
                    pauseOnHover: false,
                    speed: 1100,
                    slidesToShow: slidesToShow,
                    slidesToScroll: 1,
                    responsive: [
                        {
                            breakpoint: 1025,
                            settings: {
                                slidesToShow: 2
                            }
                        },
                        {
                            breakpoint: 600,
                            settings: {
                                slidesToShow: 1
                            }
                        }
                    ]
                });


            });
        }
    }

    /*
     **  Init sticky sidebar widget
     */
    function mkdfInitStickyWidget() {

        var stickyHeader = $('.mkd-sticky-header'),
            mobileHeader = $('.mkd-mobile-header'),
            stickyWidgets = $('.mkdf-widget-sticky-sidebar');
        if (stickyWidgets.length && mkdf.windowWidth > 1024) {

            stickyWidgets.each(function () {
                var widget = $(this),
                    parent = '.mkdf-full-section-inner, .mkdf-section-inner, .mkdf-two-columns-75-25, .mkdf-two-columns-25-75, .mkdf-two-columns-66-33, .mkdf-two-columns-33-66',
                    stickyHeight = 0,
                    widgetOffset = widget.offset().top;


                if (widget.parent('.mkdf-sidebar').length) {
                    var sidebar = widget.parents('.mkdf-sidebar');
                } else if (widget.parents('.wpb_widgetised_column').length) {
                    var sidebar = widget.parents('.wpb_widgetised_column');
                    widget.closest('.wpb_column').css('position', 'static');
                }

                var sidebarOffset = sidebar.offset().top;
                if (mkdf.body.hasClass('mkdf-sticky-header-on-scroll-down-up')) {
                    stickyHeight = mkdfGlobalVars.vars.mkdfStickyHeaderHeight;
                } else {
                    stickyHeight = 0;
                }
                var offset = -(widgetOffset - sidebarOffset - stickyHeight - 10); //10 is to push down from browser top edge


                sidebar.stick_in_parent({
                    parent: parent,
                    sticky_class: 'mkdf-sticky-sidebar',
                    inner_scrolling: false,
                    offset_top: offset,
                }).on("sticky_kit:bottom", function () { //check if sticky sidebar have hit the bottom and use that class for pull it down when sticky header appears
                    sidebar.addClass('mkdf-sticky-sidebar-on-bottom');
                }).on("sticky_kit:unbottom", function () {
                    sidebar.removeClass('mkdf-sticky-sidebar-on-bottom');
                });

                $(window).scroll(function () {
                    if (mkdf.windowWidth >= 1024) {
                        if (stickyHeader.hasClass('header-appear') && mkdf.body.hasClass('mkdf-sticky-header-on-scroll-up') && sidebar.hasClass('mkdf-sticky-sidebar') && !sidebar.hasClass('mkdf-sticky-sidebar-on-bottom')) {
                            sidebar.css('-webkit-transform', 'translateY(' + mkdfGlobalVars.vars.mkdfStickyHeaderHeight + 'px)');
                            sidebar.css('transform', 'translateY(' + mkdfGlobalVars.vars.mkdfStickyHeaderHeight + 'px)');
                        } else {
                            sidebar.css('-webkit-transform', 'translateY(0px)');
                            sidebar.css('transform', 'translateY(0px)');
                        }
                    } else {
                        if (mobileHeader.hasClass('mobile-header-appear') && sidebar.hasClass('mkdf-sticky-sidebar') && !sidebar.hasClass('mkdf-sticky-sidebar-on-bottom')) {
                            sidebar.css('-webkit-transform', 'translateY(' + mkdfGlobalVars.vars.mkdfMobileHeaderHeight + 'px)');
                            sidebar.css('transform', 'translateY(' + mkdfGlobalVars.vars.mkdfMobileHeaderHeight + 'px)');
                        } else {
                            sidebar.css('-webkit-transform', 'translateY(0px)');
                            sidebar.css('transform', 'translateY(0px)');
                        }
                    }
                });

            });
        }

    }

    /**
     * Object that represents post pagination
     * @returns {{init: Function}} function that initializes post pagination functionality
     */
    var mkdfPostPagination = mkdf.modules.shortcodes.mkdfPostPagination = function () {

        // get all post with load more
        var blogBlockWithPaginationLoadMore = $('.mkdf-post-pag-load-more');
        var blogBlockWithPaginationPrevNext = $('.mkdf-post-pag-np-horizontal');
        var blogBlockWithPaginationInfinitive = $('.mkdf-post-pag-infinite');

        $('.mkdf-post-item').addClass('mkdf-active-post-page');

        /**
         * Function that triggers load more functionality
         */
        var mkdfPostLoadMoreEvent = function (thisBlock) {
            var thisBlockShowLoadMoreHolder = thisBlock.children('.mkdf-bnl-navigation-holder'),
                thisBlockShowLoadMore = thisBlockShowLoadMoreHolder.children('.mkdf-bnl-load-more'),
                thisBlockShowLoadMoreLoading = thisBlockShowLoadMoreHolder.children('.mkdf-bnl-load-more-loading'),
                thisBlockShowLoadMoreButton = thisBlockShowLoadMore.children(),
                blockData = mkdfPostData(thisBlock),
                blogBlockOuter = thisBlock.children('.mkdf-bnl-outer'),
                isBlockItem = isBlock(thisBlock);

            thisBlockShowLoadMoreButton.on('click', function (e) {
                e.preventDefault();
                e.stopPropagation();

                thisBlockShowLoadMore.hide();
                thisBlockShowLoadMoreLoading.css('display', 'inline-block');

                blockData.paged = blockData.next_page;

                $.ajax({
                    type: 'POST',
                    data: blockData,
                    url: mkdfGlobalVars.vars.mkdfAjaxUrl,
                    success: function (data) {
                        var response = $.parseJSON(data);
                        if (response.showNextPage === true) {
                            blockData.next_page++;


                            if (isBlockItem) {
                                blogBlockOuter.append(response.html);
                            }
                            else {
                                blogBlockOuter.children('.mkdf-bnl-inner').append(response.html);
                            } // Append the new content


                            thisBlock.waitForImages(function () {
                                postAjaxCallback(thisBlock);
                            });

                            if (blockData.max_pages > (blockData.paged)) {
                                thisBlockShowLoadMore.show();
                                thisBlockShowLoadMoreLoading.hide();
                            }
                            else {
                                thisBlockShowLoadMoreHolder.hide();
                            }
                        }
                    }
                });
            });
        };

        /**
         * Function that triggers next prev functionality
         */
        var mkdfPostNextPrevEvent = function (thisBlock) {
            var thisBlockPostPrevNextButton = thisBlock.children('.mkdf-bnl-navigation-holder').find('a'),
                thisBlockSliderPaging = thisBlock.find('.mkdf-bnl-slider-paging'),
                thisBlockAjaxPreloader = thisBlock.children('.mkdf-post-ajax-preloader'),
                blockData = mkdfPostData(thisBlock),
                blogBlockOuter = thisBlock.children('.mkdf-bnl-outer'),
                isBlockItem = isBlock(thisBlock);

            if (thisBlock.hasClass('mkdf-post-pag-np-horizontal')) {
                setActivePaging(thisBlockSliderPaging, blockData.paged);
            }

            thisBlockPostPrevNextButton.on('click', function (e) {
                e.preventDefault();
                e.stopPropagation();

                blockData.paged = getClickedButton($(this), blockData);
                if (blockData.paged === false) {
                    return;
                }

                if (!setAjaxLoading(thisBlock, true)) {
                    return;
                }

                if (thisBlock.hasClass('mkdf-post-pag-np-horizontal')) {
                    setActivePaging(thisBlockSliderPaging, blockData.paged);
                }

                thisBlockAjaxPreloader.show();

                if (!isBlockItem) {
                    blogBlockOuter.children('.mkdf-bnl-inner').find('.mkdf-post-item').addClass('mkdf-removed-post-page');
                }

                $.ajax({
                    type: 'POST',
                    data: blockData,
                    url: mkdfGlobalVars.vars.mkdfAjaxUrl,
                    success: function (data) {
                        var response = $.parseJSON(data);
                        if (response.showNextPage === true) {
                            blockData.next_page = blockData.paged + 1;
                            blockData.prev_page = blockData.paged - 1;


                            if (isBlockItem) {
                                blogBlockOuter.html(response.html);
                            }
                            else {
                                var postItems = thisBlock.hasClass('mkdf-pl-eight-holder') ? $(response.html).find('.mkdf-post-item') : response.html;
                                blogBlockOuter.children('.mkdf-bnl-inner').find('.mkdf-post-item:last').after(postItems);
                                thisBlock.find('.mkdf-removed-post-page').remove();
                            }// Append the new content

                            thisBlock.waitForImages(function () {

                                thisBlock.css('min-height', '');
                                thisBlockAjaxPreloader.hide();
                                setAjaxLoading(thisBlock, false);
                                postAjaxCallback(thisBlock);

                            });
                        }
                    }
                });
            });

            function setAjaxLoading(thisBlock, start) {
                if (start) {
                    if (!thisBlock.hasClass('mkdf-post-pag-active')) {
                        thisBlock.css('min-height', thisBlock.height());
                        thisBlock.addClass('mkdf-post-pag-active');
                        return true;
                    }
                    else {
                        return false;
                    }
                }

                else if (!start && thisBlock.hasClass('mkdf-post-pag-active')) {
                    thisBlock.removeClass('mkdf-post-pag-active');
                }

                return true;
            }

            function getClickedButton(thisButton, blockData) {
                if (thisButton.hasClass('mkdf-bnl-nav-next') && blockData.next_page <= blockData.max_pages) {
                    return blockData.paged = blockData.next_page;
                }
                else if (thisButton.hasClass('mkdf-bnl-nav-prev') && blockData.prev_page > 0) {
                    return blockData.paged = blockData.prev_page;
                }
                else if (thisButton.hasClass('mkdf-paging-button-holder')) {
                    return blockData.paged = thisBlockSliderPaging.children('a').index(thisButton) + 1;
                }
                else {
                    return false;
                }
            }

            function setActivePaging(pagingHolder, number) {
                pagingHolder.children('a').removeClass('mkdf-bnl-paging-active');
                pagingHolder.children('a:nth-child(' + number + ')').addClass('mkdf-bnl-paging-active');
            }
        };

        /**
         * Function that triggers load more functionality
         */
        var mkdfPostInfinitiveEvent = function (thisBlock) {
            var blogBlockOuter = thisBlock.children('.mkdf-bnl-outer'),
                blockData = mkdfPostData(thisBlock),
                isBlockItem = isBlock(thisBlock);

            mkdf.window.scroll(function () {

                if (!thisBlock.hasClass('mkdf-ajax-infinite-started') && (blockData.next_page <= blockData.max_pages) && ((mkdf.window.height() + mkdf.window.scrollTop()) > (blogBlockOuter.offset().top + blogBlockOuter.height()))) {

                    var preloaderHTML = '<div class="mkdf-inf-scroll-preloader mkdf-post-ajax-preloader"><div class="mkdf-cubes"><div class="mkdf-cube1"></div><div class="mkdf-cube2"></div></div></div>';

                    thisBlock.after(preloaderHTML);
                    thisBlock.addClass('mkdf-ajax-infinite-started');
                    blockData.paged = blockData.next_page;

                    setTimeout(function () {
                        $.ajax({
                            type: 'POST',
                            data: blockData,
                            url: mkdfGlobalVars.vars.mkdfAjaxUrl,
                            success: function (data) {
                                var response = $.parseJSON(data);
                                if (response.showNextPage === true) {
                                    blockData.next_page++;
                                    if (isBlockItem) {
                                        blogBlockOuter.append(response.html);
                                    }
                                    else {
                                        blogBlockOuter.children('.mkdf-bnl-inner').append(response.html);
                                    } // Append the new content


                                    thisBlock.waitForImages(function () {
                                        postAjaxCallback(thisBlock);
                                    });

                                    thisBlock.removeClass('mkdf-ajax-infinite-started');
                                    $('.mkdf-inf-scroll-preloader').remove();
                                }
                            }
                        });
                    }, 300); //show inf animation
                }
            });
        };

        function isBlock($thisblock) {
            return ($thisblock.hasClass("mkdf-pb-one-holder") || $thisblock.hasClass("mkdf-pb-two-holder"));
        }

        function postAjaxCallback(thisBlock) {

            thisBlock.find('.mkdf-post-item').addClass('mkdf-active-post-page');

            if (thisBlock.parent().hasClass('widget')) {
                mkdf.modules.header.mkdfDropDownMenu();
                thisBlock.parent().parent().css('height', '');
            }
            mkdfBlockReveal();
        }

        return {
            init: function () {
                if (blogBlockWithPaginationLoadMore.length) {
                    blogBlockWithPaginationLoadMore.each(function () {
                        mkdfPostLoadMoreEvent($(this));
                    });
                }
                if (blogBlockWithPaginationPrevNext.length) {
                    blogBlockWithPaginationPrevNext.each(function () {
                        mkdfPostNextPrevEvent($(this));
                    });
                }
                if (blogBlockWithPaginationInfinitive.length) {
                    blogBlockWithPaginationInfinitive.each(function () {
                        mkdfPostInfinitiveEvent($(this));
                    });
                }
            }
        };
    };

    /*
     * Init pagination - load more
     * @returns object with data parameters
     */

    function mkdfPostData(container) {

        var myObj = container.data();
        myObj.action = 'hashmag_mikado_list_ajax';

        return myObj;
    }

    /**
     * Object that represents post layout tabs widget
     * @returns {{init: Function}} function that initializes post layout tabs widget functionality
     */
    var mkdfPostLayoutTabWidget = mkdf.modules.shortcodes.mkdfPostLayoutTabWidget = function () {

        var layoutTabsWidget = $('.mkdf-plw-tabs');


        var mkdfPostLayoutTabWidgetEvent = function (thisWidget) {
            var plwTabsHolder = thisWidget.find('.mkdf-plw-tabs-tabs-holder');
            var plwTabsContent = thisWidget.find('.mkdf-plw-tabs-content-holder');
            var currentItemPosition = plwTabsHolder.children('.mkdf-plw-tabs-tab:first-child').index() + 1; // +1 is because index start from 0 and list from 1

            setActiveTab(plwTabsContent, plwTabsHolder, currentItemPosition);

            plwTabsHolder.find('a').mouseover(function (e) {
                e.preventDefault();

                currentItemPosition = $(this).parents('.mkdf-plw-tabs-tab').index() + 1; // +1 is because index start from 0 and list from 1

                setActiveTab(plwTabsContent, plwTabsHolder, currentItemPosition);
            });
        };

        function setActiveTab(plwTabsContent, plwTabsHolder, currentItemPosition) {
            var activeItemClass = 'mkdf-plw-tabs-active-item';

            plwTabsContent.children('.mkdf-plw-tabs-content').removeClass(activeItemClass);
            plwTabsHolder.children('.mkdf-plw-tabs-tab').removeClass(activeItemClass);

            var height = plwTabsContent.children('.mkdf-plw-tabs-content:nth-child(' + currentItemPosition + ')').addClass(activeItemClass).height();
            plwTabsContent.css('min-height', height + 'px');
            plwTabsHolder.children('.mkdf-plw-tabs-tab:nth-child(' + currentItemPosition + ')').addClass(activeItemClass);
        }

        return {
            init: function () {
                if (layoutTabsWidget.length) {
                    layoutTabsWidget.each(function () {
                        mkdfPostLayoutTabWidgetEvent($(this));
                    });
                }
            },

        };
    };

    /*
     * Recent comments hover
     */
    function mkdfRecentCommentsHover() {
        var link = $('footer .mkdf-rpc-link');
        if (link.length) {
            link.each(function () {
                var thisLink = $(this),
                    commentsNumber = thisLink.closest('li').find('.mkdf-rpc-number-holder');
                thisLink.mouseenter(function () {
                    commentsNumber.addClass('mkdf-hovered');
                });
                thisLink.mouseleave(function () {
                    commentsNumber.removeClass('mkdf-hovered');
                });

            });
        }
    }


    /*
     **	Show Google Map
     */
    function mkdfShowGoogleMap() {

        if ($('.mkdf-google-map').length) {
            $('.mkdf-google-map').each(function () {

                var element = $(this);

                var customMapStyle;
                if (typeof element.data('custom-map-style') !== 'undefined') {
                    customMapStyle = element.data('custom-map-style');
                }

                var colorOverlay;
                if (typeof element.data('color-overlay') !== 'undefined' && element.data('color-overlay') !== false) {
                    colorOverlay = element.data('color-overlay');
                }

                var saturation;
                if (typeof element.data('saturation') !== 'undefined' && element.data('saturation') !== false) {
                    saturation = element.data('saturation');
                }

                var lightness;
                if (typeof element.data('lightness') !== 'undefined' && element.data('lightness') !== false) {
                    lightness = element.data('lightness');
                }

                var zoom;
                if (typeof element.data('zoom') !== 'undefined' && element.data('zoom') !== false) {
                    zoom = element.data('zoom');
                }

                var pin;
                if (typeof element.data('pin') !== 'undefined' && element.data('pin') !== false) {
                    pin = element.data('pin');
                }

                var mapHeight;
                if (typeof element.data('height') !== 'undefined' && element.data('height') !== false) {
                    mapHeight = element.data('height');
                }

                var uniqueId;
                if (typeof element.data('unique-id') !== 'undefined' && element.data('unique-id') !== false) {
                    uniqueId = element.data('unique-id');
                }

                var scrollWheel;
                if (typeof element.data('scroll-wheel') !== 'undefined') {
                    scrollWheel = element.data('scroll-wheel');
                }
                var addresses;
                if (typeof element.data('addresses') !== 'undefined' && element.data('addresses') !== false) {
                    addresses = element.data('addresses');
                }

                var map = "map_" + uniqueId;
                var geocoder = "geocoder_" + uniqueId;
                var holderId = "mkdf-map-" + uniqueId;

                mkdfInitializeGoogleMap(customMapStyle, colorOverlay, saturation, lightness, scrollWheel, zoom, holderId, mapHeight, pin, map, geocoder, addresses);
            });
        }

    }

    /*
     **	Init Google Map
     */
    function mkdfInitializeGoogleMap(customMapStyle, color, saturation, lightness, wheel, zoom, holderId, height, pin, map, geocoder, data) {

        var mapStyles = [
            {
                stylers: [
                    {hue: color},
                    {saturation: saturation},
                    {lightness: lightness},
                    {gamma: 1}
                ]
            }
        ];

        var googleMapStyleId;

        if (customMapStyle) {
            googleMapStyleId = 'mkdf-style';
        } else {
            googleMapStyleId = google.maps.MapTypeId.ROADMAP;
        }

        var qoogleMapType = new google.maps.StyledMapType(mapStyles,
            {name: "Mikado Google Map"});

        geocoder = new google.maps.Geocoder();
        var latlng = new google.maps.LatLng(-34.397, 150.644);

        if (!isNaN(height)) {
            height = height + 'px';
        }

        var myOptions = {

            zoom: zoom,
            scrollwheel: wheel,
            center: latlng,
            zoomControl: true,
            zoomControlOptions: {
                style: google.maps.ZoomControlStyle.SMALL,
                position: google.maps.ControlPosition.RIGHT_CENTER
            },
            scaleControl: false,
            scaleControlOptions: {
                position: google.maps.ControlPosition.LEFT_CENTER
            },
            streetViewControl: false,
            streetViewControlOptions: {
                position: google.maps.ControlPosition.LEFT_CENTER
            },
            panControl: false,
            panControlOptions: {
                position: google.maps.ControlPosition.LEFT_CENTER
            },
            mapTypeControl: false,
            mapTypeControlOptions: {
                mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'mkdf-style'],
                style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
                position: google.maps.ControlPosition.LEFT_CENTER
            },
            mapTypeId: googleMapStyleId
        };

        map = new google.maps.Map(document.getElementById(holderId), myOptions);
        map.mapTypes.set('mkdf-style', qoogleMapType);

        var index;

        for (index = 0; index < data.length; ++index) {
            mkdfInitializeGoogleAddress(data[index], pin, map, geocoder);
        }

        var holderElement = document.getElementById(holderId);
        holderElement.style.height = height;
    }

    /*
     **	Init Google Map Addresses
     */
    function mkdfInitializeGoogleAddress(data, pin, map, geocoder) {
        if (data === '')
            return;
        var contentString = '<div id="content">' +
            '<div id="siteNotice">' +
            '</div>' +
            '<div id="bodyContent">' +
            '<p>' + data + '</p>' +
            '</div>' +
            '</div>';
        var infowindow = new google.maps.InfoWindow({
            content: contentString
        });
        geocoder.geocode({'address': data}, function (results, status) {
            if (status === google.maps.GeocoderStatus.OK) {
                map.setCenter(results[0].geometry.location);
                var marker = new google.maps.Marker({
                    map: map,
                    position: results[0].geometry.location,
                    icon: pin,
                    title: data['store_title']
                });
                google.maps.event.addListener(marker, 'click', function () {
                    infowindow.open(map, marker);
                });

                google.maps.event.addDomListener(window, 'resize', function () {
                    map.setCenter(results[0].geometry.location);
                });

            }
        });
    }

    /*
     * Post Template Animate Excerpt
     */
    function mkdfPostTemplateAnimateExcerpt() {
        var ptItems = $('body:not(.single) .mkdf-pt-five-item, .mkdf-pb-four-holder .mkdf-pt-seven-item');
        if (ptItems.length) {
            ptItems.each(function () {
                var ptItem = $(this),
                    excerpt = ptItem.find('div[class$="-excerpt"]'),
                    excerptHeight = excerpt.outerHeight();

                excerpt.css('visibility', 'visible');

                $(window).resize(function () {
                    excerptHeight = excerpt.find('p').outerHeight(); //recalc height
                });

                excerpt.css({'height': 0});

                ptItem.mouseenter(function () {
                    excerpt.css({'height': excerptHeight});
                });
                ptItem.mouseleave(function () {
                    excerpt.css({'height': 0});
                });
            });
        }
    }

})(jQuery);