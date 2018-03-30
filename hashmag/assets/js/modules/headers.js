(function ($) {
    "use strict";

    var header = {};
    mkdf.modules.header = header;

    header.isStickyVisible = false;
    header.stickyAppearAmount = 0;
    header.behaviour = "";
    header.mkdfInitMobileNavigation = mkdfInitMobileNavigation;
    header.mkdfMobileHeaderBehavior = mkdfMobileHeaderBehavior;
    header.mkdfSetDropDownMenuPosition = mkdfSetDropDownMenuPosition;
    header.mkdfSetWideMenuPosition = mkdfSetWideMenuPosition;
    header.mkdfSideArea = mkdfSideArea;
    header.mkdfSideAreaScroll = mkdfSideAreaScroll;
    header.mkdfDropDownMenu = mkdfDropDownMenu;
    header.mkdfSearch = mkdfSearch;

    $(document).ready(function () {
        mkdfHeaderBehaviour();
        mkdfInitMobileNavigation();
        mkdfMobileHeaderBehavior();
        mkdfSideArea();
        mkdfSideAreaScroll();
        mkdfSetDropDownMenuPosition();
        mkdfSetWideMenuPosition();
        mkdfSearch();
    });

    $(window).load(function () {
        mkdfDropDownMenu();
        mkdfSetDropDownMenuPosition();
    });

    $(window).resize(function () {
        mkdfSetWideMenuPosition();
        mkdfDropDownMenu();
    });

    /*
     **	Show/Hide sticky header on window scroll
     */
    function mkdfHeaderBehaviour() {

        var header = $('.mkdf-page-header');
        var stickyHeader = $('.mkdf-sticky-header');
        var stickyAppearAmount;
        var headerAppear;

        var fixedHeaderWrapper = $('.mkdf-fixed-wrapper');
        var headerMenuAreaOffset = $('.mkdf-page-header').find('.mkdf-fixed-wrapper').length ? $('.mkdf-page-header').find('.mkdf-fixed-wrapper').offset().top : null;

        switch (true) {
            // sticky header that will be shown when user scrolls up
            case mkdf.body.hasClass('mkdf-sticky-header-on-scroll-up'):
                mkdf.modules.header.behaviour = 'mkdf-sticky-header-on-scroll-up';
                var docYScroll1 = $(document).scrollTop();
                stickyAppearAmount = mkdfGlobalVars.vars.mkdfTopBarHeight + mkdfGlobalVars.vars.mkdfLogoAreaHeight + mkdfGlobalVars.vars.mkdfMenuAreaHeight + mkdfGlobalVars.vars.mkdfStickyHeaderHeight + 200; //200 is designer's whish

                headerAppear = function () {
                    var docYScroll2 = $(document).scrollTop();

                    if ((docYScroll2 > docYScroll1 && docYScroll2 > stickyAppearAmount) || (docYScroll2 < stickyAppearAmount)) {
                        mkdf.modules.header.isStickyVisible = false;
                        stickyHeader.removeClass('header-appear').find('.mkdf-main-menu .second').removeClass('mkdf-drop-down-start');
                    } else {
                        mkdf.modules.header.isStickyVisible = true;
                        stickyHeader.addClass('header-appear');
                    }

                    docYScroll1 = $(document).scrollTop();
                };
                headerAppear();

                $(window).scroll(function () {
                    headerAppear();
                });

                break;

            // sticky header that will be shown when user scrolls both up and down
            case mkdf.body.hasClass('mkdf-sticky-header-on-scroll-down-up'):
                mkdf.modules.header.behaviour = 'mkdf-sticky-header-on-scroll-down-up';
                stickyAppearAmount = mkdfPerPageVars.vars.mkdfStickyScrollAmount !== 0 ? mkdfPerPageVars.vars.mkdfStickyScrollAmount : mkdfGlobalVars.vars.mkdfTopBarHeight + mkdfGlobalVars.vars.mkdfLogoAreaHeight + mkdfGlobalVars.vars.mkdfMenuAreaHeight + 200; //200 is designer's whish
                mkdf.modules.header.stickyAppearAmount = stickyAppearAmount; //used in anchor logic

                headerAppear = function () {
                    if (mkdf.scroll < stickyAppearAmount) {
                        mkdf.modules.header.isStickyVisible = false;
                        stickyHeader.removeClass('header-appear').find('.mkdf-main-menu .second').removeClass('mkdf-drop-down-start');
                    } else {
                        mkdf.modules.header.isStickyVisible = true;
                        stickyHeader.addClass('header-appear');
                    }
                };

                headerAppear();

                $(window).scroll(function () {
                    headerAppear();
                });

                break;

            // on scroll down, when viewport hits header's top position it remains fixed
            case mkdf.body.hasClass('mkdf-fixed-on-scroll'):
                mkdf.modules.header.behaviour = 'mkdf-fixed-on-scroll';
                var headerFixed = function () {
                    if (mkdf.scroll < headerMenuAreaOffset) {
                        fixedHeaderWrapper.removeClass('fixed');
                        header.css('margin-bottom', 0);
                    }
                    else {
                        fixedHeaderWrapper.addClass('fixed');
                        header.css('margin-bottom', fixedHeaderWrapper.height());
                    }
                };

                headerFixed();

                $(window).scroll(function () {
                    headerFixed();
                });

                break;
        }
    }


    function mkdfInitMobileNavigation() {
        var navigationOpener = $('.mkdf-mobile-header .mkdf-mobile-menu-opener');
        var navigationHolder = $('.mkdf-mobile-header .mkdf-mobile-nav');
        var dropdownOpener = $('.mkdf-mobile-nav .mobile_arrow, .mkdf-mobile-nav h6, .mkdf-mobile-nav a[href*="#"]');
        var animationSpeed = 200;

        //whole mobile menu opening / closing
        if (navigationOpener.length && navigationHolder.length) {
            navigationOpener.on('tap click', function (e) {
                e.stopPropagation();
                e.preventDefault();

                if (navigationHolder.is(':visible')) {
                    navigationOpener.removeClass('opened');
                    navigationHolder.slideUp(animationSpeed);
                } else {
                    navigationOpener.addClass('opened');
                    navigationHolder.slideDown(animationSpeed);
                }
            });
        }

        //dropdown opening / closing
        if (dropdownOpener.length) {
            dropdownOpener.each(function () {
                $(this).on('tap click', function (e) {
                    e.preventDefault();
                    e.stopPropagation();

                    var dropdownToOpen = $(this).nextAll('ul').first();
                    var openerParent = $(this).parent('li');
                    if (dropdownToOpen.is(':visible')) {
                        dropdownToOpen.slideUp(animationSpeed);
                        openerParent.removeClass('mkdf-opened');
                    } else {
                        dropdownToOpen.slideDown(animationSpeed);
                        openerParent.addClass('mkdf-opened');
                    }
                });
            });
        }

        $('.mkdf-mobile-nav a, .mkdf-mobile-logo-wrapper a').on('click tap', function (e) {
            if ($(this).attr('href') !== 'http://#' && $(this).attr('href') !== '#') {
                navigationHolder.slideUp(animationSpeed);
            }
        });
    }

    function mkdfMobileHeaderBehavior() {
        if (mkdf.body.hasClass('mkdf-sticky-up-mobile-header')) {
            var stickyAppearAmount;
            var topBar = $('.mkdf-top-bar');
            var mobileHeader = $('.mkdf-mobile-header');
            var adminBar = $('#wpadminbar');
            var mobileHeaderHeight = mobileHeader.length ? mobileHeader.height() : 0;
            var topBarHeight = topBar.is(':visible') ? topBar.height() : 0;
            var adminBarHeight = adminBar.length ? adminBar.height() : 0;

            var docYScroll1 = $(document).scrollTop();
            stickyAppearAmount = topBarHeight + mobileHeaderHeight + adminBarHeight;

            $(window).scroll(function () {
                var docYScroll2 = $(document).scrollTop();

                if (docYScroll2 > stickyAppearAmount) {
                    mobileHeader.addClass('mkdf-animate-mobile-header');
                    mobileHeader.css('margin-bottom', mobileHeaderHeight);
                } else {
                    mobileHeader.removeClass('mkdf-animate-mobile-header');
                    mobileHeader.css('margin-bottom', 0);
                }

                if ((docYScroll2 > docYScroll1 && docYScroll2 > stickyAppearAmount) || (docYScroll2 < stickyAppearAmount)) {
                    mobileHeader.removeClass('mobile-header-appear');
                    if (adminBar.length) {
                        mobileHeader.find('.mkdf-mobile-header-inner').css('top', 0);
                    }
                } else {
                    mobileHeader.addClass('mobile-header-appear');

                }

                docYScroll1 = $(document).scrollTop();
            });
        }
    }

    /**
     * Set dropdown position
     */
    function mkdfSetDropDownMenuPosition() {

        var menuItems = $(".mkdf-drop-down > ul > li.mkdf-menu-narrow");
        menuItems.each(function (i) {

            var browserWidth = mkdf.windowWidth - 16; // 16 is width of scroll bar
            var menuItemPosition = $(this).offset().left;
            var dropdownMenuWidth = $(this).find('.mkdf-menu-second .mkdf-menu-inner ul').width();

            var menuItemFromLeft = 0;
            if (mkdf.body.hasClass('mkdf-boxed')) {
                menuItemFromLeft = mkdf.boxedLayoutWidth - (menuItemPosition - (browserWidth - mkdf.boxedLayoutWidth) / 2);
            } else {
                menuItemFromLeft = browserWidth - menuItemPosition;
            }

            var dropDownMenuFromLeft; //has to stay undefined beacuse 'dropDownMenuFromLeft < dropdownMenuWidth' condition will be true

            if ($(this).find('li.mkdf-menu-sub').length > 0) {
                dropDownMenuFromLeft = menuItemFromLeft - dropdownMenuWidth;
            }

            if (menuItemFromLeft < dropdownMenuWidth || dropDownMenuFromLeft < dropdownMenuWidth) {
                $(this).find('.mkdf-menu-second').addClass('right');
                $(this).find('.mkdf-menu-second .mkdf-menu-inner ul').addClass('right');
            } else {
                $(this).find('.mkdf-menu-second').removeClass('right');
                $(this).find('.mkdf-menu-second .mkdf-menu-inner ul').removeClass('right');
            }
        });
    }

    function mkdfSetWideMenuPosition() {

        var browserWidth = mkdf.windowWidth;
        var menu_items = $('.mkdf-drop-down > ul > li.mkdf-menu-wide');
        menu_items.each(function (i) {
            if ($(menu_items[i]).find('.mkdf-menu-second').length > 0) {

                var dropDownSecondDiv = $(menu_items[i]).find('.mkdf-menu-second');
                dropDownSecondDiv.css('left', '0'); //reinit left offset for fixed header transition

                if (browserWidth - 16 < 1440 && browserWidth - 16 > 1201) {

                    var headerWidth = Math.floor($('.mkdf-menu-area > .mkdf-grid')[0].getBoundingClientRect().width);

                    var tempWidth = headerWidth != '' ?  headerWidth : '';
                    $(this).find('.mkdf-menu-inner > ul').css('width', tempWidth+'px');
                }
                else {
                    $(this).find('.mkdf-menu-inner > ul').css('width', '');
                }
                
                var dropdown = $(this).find('.mkdf-menu-inner > ul');
                var dropdownWidth = Math.floor(dropdown[0].getBoundingClientRect().width);
                var dropdownPosition = dropdown.offset().left;
                var left_position = 0;


                if (!$(this).hasClass('mkdf-menu-left-position') && !$(this).hasClass('mkdf-menu-right-position')) {
                    left_position = dropdownPosition - (browserWidth - dropdownWidth) / 2;
                    dropDownSecondDiv.css('left', -left_position);
                    dropDownSecondDiv.css('width', dropdownWidth);
                }
            }
        });
    }

    function mkdfDropDownMenu() {

        var menu_items = $('.mkdf-drop-down > ul > li');

        menu_items.each(function (i) {
            if ($(menu_items[i]).find('.mkdf-menu-second').length > 0) {

                var dropDownSecondDiv = $(menu_items[i]).find('.mkdf-menu-second');

                if ($(menu_items[i]).hasClass('mkdf-menu-wide')) {
                    if ($(menu_items[i]).data('wide_background_image') !== '' && $(menu_items[i]).data('wide_background_image') !== undefined) {
                        var wideBackgroundImageSrc = $(menu_items[i]).data('wide_background_image');
                        dropDownSecondDiv.find('> .mkdf-menu-inner > ul').css('background-image', 'url(' + wideBackgroundImageSrc + ')');
                    }
                }

                if (!mkdf.menuDropdownHeightSet) {
                    $(menu_items[i]).data('original_height', dropDownSecondDiv.height() + 'px');
                    dropDownSecondDiv.height(0);
                }

                if (navigator.userAgent.match(/(iPod|iPhone|iPad)/)) {
                    $(menu_items[i]).on("touchstart mouseenter", function () {
                        dropDownSecondDiv.css({
                            'height': $(menu_items[i]).data('original_height'),
                            'overflow': 'visible',
                            'visibility': 'visible',
                            'opacity': '1'
                        });
                    }).on("mouseleave", function () {
                        dropDownSecondDiv.css({
                            'height': '0px',
                            'overflow': 'hidden',
                            'visibility': 'hidden',
                            'opacity': '0'
                        });
                    });

                } else {
                    $(menu_items[i]).mouseenter(function () {
                        dropDownSecondDiv.css({'opacity': '1', 'height': $(menu_items[i]).data('original_height')});
                        dropDownSecondDiv.addClass('mkdf-drop-down-start');
                    });
                    $(menu_items[i]).mouseleave(function () {
                        dropDownSecondDiv.css({'opacity': '0', 'height': '0'});
                        dropDownSecondDiv.removeClass('mkdf-drop-down-start');
                    });
                }
            }
        });

        $('.mkdf-drop-down ul li.mkdf-menu-wide ul li a').on('click', function (e) {
            if (e.which === 1) {
                var $this = $(this);
                setTimeout(function () {
                    $this.mouseleave();
                }, 500);
            }
        });
        mkdf.menuDropdownHeightSet = true;

    }

    /**
     * Show/hide side area
     */
    function mkdfSideArea() {

        var wrapper = $('.mkdf-wrapper'),
            sideMenu = $('.mkdf-side-menu'),
            sideMenuButtonOpen = $('a.mkdf-side-menu-button-opener'),
            cssClass,
        //Flags
            slideFromRight = false,
            slideWithContent = false,
            slideUncovered = false,
            slideOverContent = false;

        if (mkdf.body.hasClass('mkdf-side-menu-slide-from-right')) {
            $('.mkdf-cover').remove();
            cssClass = 'mkdf-right-side-menu-opened';
            wrapper.prepend('<div class="mkdf-cover"/>');
            slideFromRight = true;

        } else if (mkdf.body.hasClass('mkdf-side-menu-slide-with-content')) {

            cssClass = 'mkdf-side-menu-open';
            slideWithContent = true;

        } else if (mkdf.body.hasClass('mkdf-side-area-uncovered-from-content')) {

            cssClass = 'mkdf-right-side-menu-opened';
            slideUncovered = true;

        } else if (mkdf.body.hasClass('mkdf-side-menu-slide-over-content')) {

            cssClass = 'mkdf-side-menu-open';
            slideOverContent = true;

        }

        $('a.mkdf-side-menu-button-opener, a.mkdf-close-side-menu').click(function (e) {
            e.preventDefault();

            if (!sideMenuButtonOpen.hasClass('opened')) {

                sideMenuButtonOpen.addClass('opened');
                mkdf.body.addClass(cssClass);

                if (slideFromRight) {
                    $('.mkdf-wrapper .mkdf-cover').click(function () {
                        mkdf.body.removeClass('mkdf-right-side-menu-opened');
                        sideMenuButtonOpen.removeClass('opened');
                    });
                }

                if (slideUncovered) {
                    sideMenu.css({
                        'visibility': 'visible'
                    });
                }

                var currentScroll = $(window).scrollTop();
                $(window).scroll(function () {
                    if (Math.abs(mkdf.scroll - currentScroll) > 400) {
                        mkdf.body.removeClass(cssClass);
                        sideMenuButtonOpen.removeClass('opened');
                        if (slideUncovered) {
                            var hideSideMenu = setTimeout(function () {
                                sideMenu.css({'visibility': 'hidden'});
                                clearTimeout(hideSideMenu);
                            }, 400);
                        }
                    }
                });

            } else {

                sideMenuButtonOpen.removeClass('opened');
                mkdf.body.removeClass(cssClass);
                if (slideUncovered) {
                    var hideSideMenu = setTimeout(function () {
                        sideMenu.css({'visibility': 'hidden'});
                        clearTimeout(hideSideMenu);
                    }, 400);
                }

            }

            if (slideWithContent || slideOverContent) {

                e.stopPropagation();
                wrapper.click(function () {
                    e.preventDefault();
                    sideMenuButtonOpen.removeClass('opened');
                    mkdf.body.removeClass('mkdf-side-menu-open');
                });

            }

        });

    }

    /*
     **  Smooth scroll functionality for Side Area
     */
    function mkdfSideAreaScroll() {

        var sideMenu = $('.mkdf-side-menu');

        if (sideMenu.length) {
            sideMenu.niceScroll({
                scrollspeed: 60,
                mousescrollstep: 40,
                cursorwidth: 0,
                cursorborder: 0,
                cursorborderradius: 0,
                cursorcolor: "transparent",
                autohidemode: false,
                horizrailenabled: false
            });
        }
    }


    /**
     * Init Search Types
     */
    function mkdfSearch() {

        var searchOpener = $('header .mkdf-search-submit');

        searchOpener.each(function () {
            var opener = $(this),
                searchWidget = opener.parent().parent().find('.mkdf-search-field');

            //Search results
            if (mkdf.body.hasClass('search-results') || mkdf.body.hasClass('search-no-results')) {
                opener.addClass('mkdf-active');
                searchWidget.addClass('mkdf-active');
            }

            //Open / Close
            opener.on('click', function (e) {
                if (!opener.hasClass('mkdf-active')) {
                    e.preventDefault();
                    opener.addClass('mkdf-active');
                    searchWidget.addClass('mkdf-active');
                    searchWidget.focus();
                } else {
                    if (searchWidget.val() === '') {
                        e.preventDefault();
                        opener.removeClass('mkdf-active');
                        searchWidget.removeClass('mkdf-active');
                        searchWidget.blur();
                    }
                }
            });

            //Close on click away
            $(document).mouseup(function (e) {
                var container = $(".mkdf-search-menu-holder, .mkdf-search-opener");
                if (!container.is(e.target) && container.has(e.target).length === 0) {
                    e.preventDefault();
                    opener.removeClass('mkdf-active');
                    searchWidget.removeClass('mkdf-active');
                }
            });

            //Close on escape
            $(document).keyup(function (e) {
                if (e.keyCode == 27) { //KeyCode for ESC button is 27
                    e.preventDefault();
                    opener.removeClass('mkdf-active');
                    searchWidget.removeClass('mkdf-active');
                }
            });

        });

    }

})(jQuery);