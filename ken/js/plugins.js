

(function(a) {
    a.fn.addBack = a.fn.addBack || a.fn.andSelf;
    a.fn.extend({
        actual: function(b, l) {
            if (!this[b]) {
                throw '$.actual => The jQuery method "' + b + '" you called does not exist';
            }
            var f = {
                absolute: false,
                clone: false,
                includeMargin: false
            };
            var i = a.extend(f, l);
            var e = this.eq(0);
            var h, j;
            if (i.clone === true) {
                h = function() {
                    var m = "position: absolute !important; top: -1000 !important; ";
                    e = e.clone().attr("style", m).appendTo("body")
                };
                j = function() {
                    e.remove()
                }
            } else {
                var g = [];
                var d = "";
                var c;
                h = function() {
                    c = e.parents().addBack().filter(":hidden");
                    d += "visibility: hidden !important; display: block !important; ";
                    if (i.absolute === true) {
                        d += "position: absolute !important; "
                    }
                    c.each(function() {
                        var m = a(this);
                        g.push(m.attr("style"));
                        m.attr("style", d)
                    })
                };
                j = function() {
                    c.each(function(m) {
                        var o = a(this);
                        var n = g[m];
                        if (n === undefined) {
                            o.removeAttr("style")
                        } else {
                            o.attr("style", n)
                        }
                    })
                }
            }
            h();
            var k = /(outer)/.test(b) ? e[b](i.includeMargin) : e[b]();
            j();
            return k
        }
    })
})(jQuery);

/*! matchMedia() polyfill - Test a CSS media type/query in JS. Authors & copyright (c) 2012: Scott Jehl, Paul Irish, Nicholas Zakas, David Knight. Dual MIT/BSD license */

window.matchMedia || (window.matchMedia = function() {
    "use strict";

    // For browsers that support matchMedium api such as IE 9 and webkit
    var styleMedia = (window.styleMedia || window.media);

    // For those that don't support matchMedium
    if (!styleMedia) {
        var style       = document.createElement('style'),
            script      = document.getElementsByTagName('script')[0],
            info        = null;

        style.type  = 'text/css';
        style.id    = 'matchmediajs-test';

        script.parentNode.insertBefore(style, script);

        // 'style.currentStyle' is used by IE <= 8 and 'window.getComputedStyle' for all other browsers
        info = ('getComputedStyle' in window) && window.getComputedStyle(style, null) || style.currentStyle;

        styleMedia = {
            matchMedium: function(media) {
                var text = '@media ' + media + '{ #matchmediajs-test { width: 1px; } }';

                // 'style.styleSheet' is used by IE <= 8 and 'style.textContent' for all other browsers
                if (style.styleSheet) {
                    style.styleSheet.cssText = text;
                } else {
                    style.textContent = text;
                }

                // Test if media query is true or false
                return info.width === '1px';
            }
        };
    }

    return function(media) {
        return {
            matches: styleMedia.matchMedium(media || 'all'),
            media: media || 'all'
        };
    };
}());

/*! matchMedia() polyfill addListener/removeListener extension. Author & copyright (c) 2012: Scott Jehl. Dual MIT/BSD license */
(function(){
    // Bail out for browsers that have addListener support
    if (window.matchMedia && window.matchMedia('all').addListener) {
        return false;
    }

    var localMatchMedia = window.matchMedia,
        hasMediaQueries = localMatchMedia('only all').matches,
        isListening     = false,
        timeoutID       = 0,    // setTimeout for debouncing 'handleChange'
        queries         = [],   // Contains each 'mql' and associated 'listeners' if 'addListener' is used
        handleChange    = function(evt) {
            // Debounce
            clearTimeout(timeoutID);

            timeoutID = setTimeout(function() {
                for (var i = 0, il = queries.length; i < il; i++) {
                    var mql         = queries[i].mql,
                        listeners   = queries[i].listeners || [],
                        matches     = localMatchMedia(mql.media).matches;

                    // Update mql.matches value and call listeners
                    // Fire listeners only if transitioning to or from matched state
                    if (matches !== mql.matches) {
                        mql.matches = matches;

                        for (var j = 0, jl = listeners.length; j < jl; j++) {
                            listeners[j].call(window, mql);
                        }
                    }
                }
            }, 30);
        };

    window.matchMedia = function(media) {
        var mql         = localMatchMedia(media),
            listeners   = [],
            index       = 0;

        mql.addListener = function(listener) {
            // Changes would not occur to css media type so return now (Affects IE <= 8)
            if (!hasMediaQueries) {
                return; 
            }

            // Set up 'resize' listener for browsers that support CSS3 media queries (Not for IE <= 8)
            // There should only ever be 1 resize listener running for performance
            if (!isListening) {
                isListening = true;
                window.addEventListener('resize', handleChange, true);
            }

            // Push object only if it has not been pushed already
            if (index === 0) {
                index = queries.push({
                    mql         : mql,
                    listeners   : listeners
                });
            }

            listeners.push(listener);
        };

        mql.removeListener = function(listener) {
            for (var i = 0, il = listeners.length; i < il; i++){
                if (listeners[i] === listener){
                    listeners.splice(i, 1);
                }
            }
        };

        return mql;
    };
}());

;
/**
 * fullPage 2.1.2
 * https://github.com/alvarotrigo/fullPage.js
 * MIT licensed
 *
 * Copyright (C) 2013 alvarotrigo.com - A project by Alvaro Trigo
 */
/**
 * fullPage 2.1.4
 * https://github.com/alvarotrigo/fullPage.js
 * MIT licensed
 *
 * Copyright (C) 2013 alvarotrigo.com - A project by Alvaro Trigo
 */

(function($) {
    $.fn.fullpage = function(options) {
        // Create some defaults, extending them with any options that were provided
        options = $.extend({
            "verticalCentered": true,
            'resize': true,
            'sectionsColor' : [],
            'anchors':[],
            'scrollingSpeed': 700,
            'easing': 'easeInQuart',
            'menu': false,
            'navigation': false,
            'navigationPosition': 'right',
            'navigationColor': '#000',
            'navigationTooltips': [],
            'slidesNavigation': false,
            'slidesNavPosition': 'bottom',
            'controlArrowColor': '#fff',
            'loopBottom': false,
            'loopTop': false,
            'loopHorizontal': true,
            'autoScrolling': true,
            'scrollOverflow': false,
            'css3': false,
            'paddingTop': 0,
            'paddingBottom': 0,
            'fixedElements': null,
            'normalScrollElements': null,
            'keyboardScrolling': true,
            'touchSensitivity': 5,
            'continuousVertical': false,
            'animateAnchor': true,
            'normalScrollElementTouchThreshold': 5,

            //events
            'afterLoad': null,
            'onLeave': null,
            'afterRender': null,
            'afterResize': null,
            'afterSlideLoad': null,
            'onSlideLeave': null
        }, options);

        // Disable mutually exclusive settings
        if (options.continuousVertical &&
            (options.loopTop || options.loopBottom)) {
            options.continuousVertical = false;
            console && console.log && console.log("Option loopTop/loopBottom is mutually exclusive with continuousVertical; continuousVertical disabled");
        }

        //Defines the delay to take place before being able to scroll to the next section
        //BE CAREFUL! Not recommened to change it under 400 for a good behavior in laptops and
        //Apple devices (laptops, mouses...)
        var scrollDelay = 600;

        $.fn.fullpage.setAutoScrolling = function(value){
            options.autoScrolling = value;

            var element = $('.section.active');

            if(options.autoScrolling){
                $('html, body').css({
                    'overflow' : 'hidden',
                    'height' : '100%'
                });

                if(element.length){
                    //moving the container up
                    silentScroll(element.position().top);
                }

            }else{
                $('html, body').css({
                    'overflow' : 'auto',
                    'height' : 'auto'
                });

                silentScroll(0);

                //scrolling the page to the section with no animation
                $('html, body').scrollTop(element.position().top);
            }

        };

        /**
        * Defines the scrolling speed
        */
        $.fn.fullpage.setScrollingSpeed = function(value){
           options.scrollingSpeed = value;
        };

        /**
        * Adds or remove the possiblity of scrolling through sections by using the mouse wheel or the trackpad.
        */
        $.fn.fullpage.setMouseWheelScrolling = function (value){
            if(value){
                addMouseWheelHandler();
            }else{
                removeMouseWheelHandler();
            }
        };

        /**
        * Adds or remove the possiblity of scrolling through sections by using the mouse wheel/trackpad or touch gestures.
        */
        $.fn.fullpage.setAllowScrolling = function (value){
            if(value){
                $.fn.fullpage.setMouseWheelScrolling(true);
                addTouchHandler();
            }else{
                $.fn.fullpage.setMouseWheelScrolling(false);
                removeTouchHandler();
            }
        };

        /**
        * Adds or remove the possiblity of scrolling through sections by using the keyboard arrow keys
        */
        $.fn.fullpage.setKeyboardScrolling = function (value){
            options.keyboardScrolling = value;
        };

        //flag to avoid very fast sliding for landscape sliders
        var slideMoving = false;

        var isTouchDevice = navigator.userAgent.match(/(iPhone|iPod|iPad|Android|BlackBerry|BB10|Windows Phone|Tizen|Bada)/);
        var container = $(this);
        var windowsHeight = $(window).height();
        var isMoving = false;
        var isResizing = false;
        var lastScrolledDestiny;
        var lastScrolledSlide;
        var wrapperSelector = 'fullpage-wrapper';

        $.fn.fullpage.setAllowScrolling(true);

        //if css3 is not supported, it will use jQuery animations
        if(options.css3){
            options.css3 = support3d();
        }

        if($(this).length){
            container.css({
                'height': '100%',
                'position': 'relative',
                '-ms-touch-action': 'none'
            });

            //adding a class to recognize the container internally in the code
            container.addClass(wrapperSelector);
        }

        //trying to use fullpage without a selector?
        else{
            console.error("Error! Fullpage.js needs to be initialized with a selector. For example: $('#myContainer').fullpage();");
        }

        //creating the navigation dots
        if (options.navigation) {
            $('body').append('<div id="fullPage-nav" class="fullPage-nav"></div>');
            var nav = $('#fullPage-nav');

            nav.css('color', options.navigationColor);
            nav.addClass(options.navigationPosition);
        }

        $('.section').each(function(index){
            var that = $(this);
            var slides = $(this).find('.slide');
            var numSlides = slides.length;

            //if no active section is defined, the 1st one will be the default one
            if(!index && $('.section.active').length === 0) {
                $(this).addClass('active');
            }

            $(this).css('height', windowsHeight + 'px');

            if(options.paddingTop || options.paddingBottom){
                $(this).css('padding', options.paddingTop  + ' 0 ' + options.paddingBottom + ' 0');
            }

            if (typeof options.sectionsColor[index] !==  'undefined') {
                $(this).css('background-color', options.sectionsColor[index]);
            }

            if (typeof options.anchors[index] !== 'undefined') {
                $(this).attr('data-anchor', options.anchors[index]);
            }

            if (options.navigation) {
                var link = '';
                if(options.anchors.length){
                    link = options.anchors[index];
                }
                var tooltip = options.navigationTooltips[index];
                if(typeof tooltip === 'undefined'){
                    tooltip = '';
                }

                nav.append('<span data-tooltip="' + tooltip + '"><a href="#' + link + '"></a></span>');
            }


            // if there's any slide
            if (numSlides > 1) {
                var sliderWidth = numSlides * 100;
                var slideWidth = 100 / numSlides;

                slides.wrapAll('<div class="slidesContainer" />');
                slides.parent().wrap('<div class="slides" />');

                $(this).find('.slidesContainer').css('width', sliderWidth + '%');
                $(this).find('.slides').after('<div class="controlArrow prev"></div><div class="controlArrow next"></div>');

                if(options.controlArrowColor!='#fff'){
                    $(this).find('.controlArrow.next').css('border-color', 'transparent transparent transparent '+options.controlArrowColor);
                    $(this).find('.controlArrow.prev').css('border-color', 'transparent '+ options.controlArrowColor + ' transparent transparent');
                }

                if(!options.loopHorizontal){
                    $(this).find('.controlArrow.prev').hide();
                }


                if(options.slidesNavigation){
                    addSlidesNavigation($(this), numSlides);
                }

                slides.each(function(index) {
                    //if the slide won#t be an starting point, the default will be the first one
                    if(!index && that.find('.slide.active').length == 0){
                        $(this).addClass('active');
                    }

                    $(this).css('width', slideWidth + '%');

                    if(options.verticalCentered){
                        addTableClass($(this));
                    }
                });
            }else{
                if(options.verticalCentered){
                    addTableClass($(this));
                }
            }




        }).promise().done(function(){
            $.fn.fullpage.setAutoScrolling(options.autoScrolling);

            //the starting point is a slide?
            var activeSlide = $('.section.active').find('.slide.active');
            if( activeSlide.length &&  ($('.section.active').index('.section') != 0 || ($('.section.active').index('.section') == 0 && activeSlide.index() != 0))){
                var prevScrollingSpeepd = options.scrollingSpeed;
                $.fn.fullpage.setScrollingSpeed (0);
                landscapeScroll($('.section.active').find('.slides'), activeSlide);
                $.fn.fullpage.setScrollingSpeed(prevScrollingSpeepd);
            }

            //fixed elements need to be moved out of the plugin container due to problems with CSS3.
            if(options.fixedElements && options.css3){
                $(options.fixedElements).appendTo('body');
            }

            //vertical centered of the navigation + first bullet active
            if(options.navigation){
                nav.css('margin-top', '-' + (nav.height()/2) + 'px');
                nav.find('span').eq($('.section.active').index('.section')).addClass('swiper-active-switch');
            }

            //moving the menu outside the main container if it is inside (avoid problems with fixed positions when using CSS3 tranforms)
            if(options.menu && options.css3 && $(options.menu).closest('.fullpage-wrapper').length){
                $(options.menu).appendTo('body');
            }

            if(options.scrollOverflow){
                if(container.hasClass('fullpage-used')){
                    createSlimScrollingHandler();
                }
                //after DOM and images are loaded
                $(window).on('load', createSlimScrollingHandler);
            }else{
                $.isFunction( options.afterRender ) && options.afterRender.call( this);
            }


            //getting the anchor link in the URL and deleting the `#`
            var value =  window.location.hash.replace('#', '').split('/');
            var destiny = value[0];

            if(destiny.length){
                var section = $('[data-anchor="'+destiny+'"]');

                if(!options.animateAnchor && section.length){
                    silentScroll(section.position().top);
                    $.isFunction( options.afterLoad ) && options.afterLoad.call( this, destiny, (section.index('.section') + 1));

                    //updating the active class
                    section.addClass('active').siblings().removeClass('active');
                }
            }


            $(window).on('load', function() {
                scrollToAnchor();
            });

        });

        function createSlimScrollingHandler(){
            $('.section').each(function(){
                var slides = $(this).find('.slide');

                if(slides.length){
                    slides.each(function(){
                        createSlimScrolling($(this));
                    });
                }else{
                    createSlimScrolling($(this));
                }

            });
            $.isFunction( options.afterRender ) && options.afterRender.call( this);
        }


        var scrollId;
        var isScrolling = false;

        //when scrolling...
        $(window).on('scroll', scrollHandler);

        function scrollHandler(){
            if(!options.autoScrolling){
                var currentScroll = $(window).scrollTop();

                var scrolledSections = $('.section').map(function(){
                    if ($(this).offset().top < (currentScroll + 100)){
                        return $(this);
                    }
                });

                //geting the last one, the current one on the screen
                var currentSection = scrolledSections[scrolledSections.length-1];

                //executing only once the first time we reach the section
                if(!currentSection.hasClass('active')){
                    var leavingSection = $('.section.active').index('.section') + 1;

                    isScrolling = true;

                    var yMovement = getYmovement(currentSection);

                    currentSection.addClass('active').siblings().removeClass('active');

                    var anchorLink  = currentSection.data('anchor');
                    $.isFunction( options.onLeave ) && options.onLeave.call( this, leavingSection, (currentSection.index('.section') + 1), yMovement);

                    $.isFunction( options.afterLoad ) && options.afterLoad.call( this, anchorLink, (currentSection.index('.section') + 1));

                    activateMenuElement(anchorLink);
                    activateNavDots(anchorLink, 0);


                    if(options.anchors.length && !isMoving){
                        //needed to enter in hashChange event when using the menu with anchor links
                        lastScrolledDestiny = anchorLink;

                        location.hash = anchorLink;
                    }

                    //small timeout in order to avoid entering in hashChange event when scrolling is not finished yet
                    clearTimeout(scrollId);
                    scrollId = setTimeout(function(){
                        isScrolling = false;
                    }, 100);
                }

            }
        }


        var touchStartY = 0;
        var touchStartX = 0;
        var touchEndY = 0;
        var touchEndX = 0;

        /* Detecting touch events

        * As we are changing the top property of the page on scrolling, we can not use the traditional way to detect it.
        * This way, the touchstart and the touch moves shows an small difference between them which is the
        * used one to determine the direction.
        */
        function touchMoveHandler(event){
            var e = event.originalEvent;

            if(options.autoScrolling){
                //preventing the easing on iOS devices
                event.preventDefault();
            }

            // additional: if one of the normalScrollElements isn't within options.normalScrollElementTouchThreshold hops up the DOM chain
            if (!checkParentForNormalScrollElement(event.target)) {

                var touchMoved = false;
                var activeSection = $('.section.active');
                var scrollable;

                if (!isMoving && !slideMoving) { //if theres any #
                    var touchEvents = getEventsPage(e);
                    touchEndY = touchEvents['y'];
                    touchEndX = touchEvents['x'];

                    //if movement in the X axys is greater than in the Y and the currect section has slides...
                    if (activeSection.find('.slides').length && Math.abs(touchStartX - touchEndX) > (Math.abs(touchStartY - touchEndY))) {

                        //is the movement greater than the minimum resistance to scroll?
                        if (Math.abs(touchStartX - touchEndX) > ($(window).width() / 100 * options.touchSensitivity)) {
                            if (touchStartX > touchEndX) {
                                $.fn.fullpage.moveSlideRight(); //next
                            } else {
                                $.fn.fullpage.moveSlideLeft(); //prev
                            }
                        }
                    }

                    //vertical scrolling (only when autoScrolling is enabled)
                    else if(options.autoScrolling){

                        //if there are landscape slides, we check if the scrolling bar is in the current one or not
                        if(activeSection.find('.slides').length){
                            scrollable= activeSection.find('.slide.active').find('.scrollable');
                        }else{
                            scrollable = activeSection.find('.scrollable');
                        }

                        //is the movement greater than the minimum resistance to scroll?
                        if (Math.abs(touchStartY - touchEndY) > ($(window).height() / 100 * options.touchSensitivity)) {
                            if (touchStartY > touchEndY) {
                                if(scrollable.length > 0 ){
                                    //is the scrollbar at the end of the scroll?
                                    if(isScrolled('bottom', scrollable)){
                                        $.fn.fullpage.moveSectionDown();
                                    }else{
                                        return true;
                                    }
                                }else{
                                    // moved down
                                    $.fn.fullpage.moveSectionDown();
                                }
                            } else if (touchEndY > touchStartY) {

                                if(scrollable.length > 0){
                                    //is the scrollbar at the start of the scroll?
                                    if(isScrolled('top', scrollable)){
                                        $.fn.fullpage.moveSectionUp();
                                    }
                                    else{
                                        return true;
                                    }
                                }else{
                                    // moved up
                                    $.fn.fullpage.moveSectionUp();
                                }
                            }
                        }
                    }
                }
            }

        }

        /**
         * recursive function to loop up the parent nodes to check if one of them exists in options.normalScrollElements
         * Currently works well for iOS - Android might need some testing
         * @param  {Element} el  target element / jquery selector (in subsequent nodes)
         * @param  {int}     hop current hop compared to options.normalScrollElementTouchThreshold
         * @return {boolean} true if there is a match to options.normalScrollElements
         */
        function checkParentForNormalScrollElement (el, hop) {
            hop = hop || 0;
            var parent = $(el).parent();

            if (hop < options.normalScrollElementTouchThreshold &&
                parent.is(options.normalScrollElements) ) {
                return true;
            } else if (hop == options.normalScrollElementTouchThreshold) {
                return false;
            } else {
                return checkParentForNormalScrollElement(parent, ++hop);
            }
        }

        function touchStartHandler(event){
            var e = event.originalEvent;
            var touchEvents = getEventsPage(e);
            touchStartY = touchEvents['y'];
            touchStartX = touchEvents['x'];
        }


        /**
         * Detecting mousewheel scrolling
         *
         * http://blogs.sitepointstatic.com/examples/tech/mouse-wheel/index.html
         * http://www.sitepoint.com/html5-javascript-mouse-wheel/
         */
        function MouseWheelHandler(e) {
            if(options.autoScrolling){
                // cross-browser wheel delta
                e = window.event || e;
                var delta = Math.max(-1, Math.min(1,
                        (e.wheelDelta || -e.deltaY || -e.detail)));
                var scrollable;
                var activeSection = $('.section.active');

                if (!isMoving) { //if theres any #

                    //if there are landscape slides, we check if the scrolling bar is in the current one or not
                    if(activeSection.find('.slides').length){
                        scrollable= activeSection.find('.slide.active').find('.scrollable');
                    }else{
                        scrollable = activeSection.find('.scrollable');
                    }

                    //scrolling down?
                    if (delta < 0) {
                        if(scrollable.length > 0 ){
                            //is the scrollbar at the end of the scroll?
                            if(isScrolled('bottom', scrollable)){
                                $.fn.fullpage.moveSectionDown();
                            }else{
                                return true; //normal scroll
                            }
                        }else{
                            $.fn.fullpage.moveSectionDown();
                        }
                    }

                    //scrolling up?
                    else {
                        if(scrollable.length > 0){
                            //is the scrollbar at the start of the scroll?
                            if(isScrolled('top', scrollable)){
                                $.fn.fullpage.moveSectionUp();
                            }else{
                                return true; //normal scroll
                            }
                        }else{
                            $.fn.fullpage.moveSectionUp();
                        }
                    }
                }

                return false;
            }
        }


        $.fn.fullpage.moveSectionUp = function(){
            var prev = $('.section.active').prev('.section');

            //looping to the bottom if there's no more sections above
            if (!prev.length && (options.loopTop || options.continuousVertical)) {
                prev = $('.section').last();
            }

            if (prev.length) {
                scrollPage(prev, null, true);
            }
        };

        $.fn.fullpage.moveSectionDown = function (){
            var next = $('.section.active').next('.section');

            //looping to the top if there's no more sections below
            if(!next.length &&
                (options.loopBottom || options.continuousVertical)){
                next = $('.section').first();
            }

            if(next.length > 0 ||
                (!next.length &&
                (options.loopBottom || options.continuousVertical))){
                scrollPage(next, null, false);
            }
        };

        $.fn.fullpage.moveTo = function (section, slide){
            var destiny = '';

            if(isNaN(section)){
                destiny = $('[data-anchor="'+section+'"]');
            }else{
                destiny = $('.section').eq( (section -1) );
            }

            if (typeof slide !== 'undefined'){
                scrollPageAndSlide(section, slide);
            }else if(destiny.length > 0){
                scrollPage(destiny);
            }
        };

        $.fn.fullpage.moveSlideRight = function(){
            moveSlide('next');
        };

        $.fn.fullpage.moveSlideLeft = function(){
            moveSlide('prev');
        };

        function moveSlide(direction){
            var activeSection = $('.section.active');
            var slides = activeSection.find('.slides');

            // more than one slide needed and nothing should be sliding
            if (!slides.length || slideMoving) {
                return;
            }

            var currentSlide = slides.find('.slide.active');
            var destiny = null;

            if(direction === 'prev'){
                destiny = currentSlide.prev('.slide');
            }else{
                destiny = currentSlide.next('.slide');
            }

            //isn't there a next slide in the secuence?
            if(!destiny.length){
                //respect loopHorizontal settin
                if (!options.loopHorizontal) return;

                if(direction === 'prev'){
                    destiny = currentSlide.siblings(':last');
                }else{
                    destiny = currentSlide.siblings(':first');
                }
            }

            slideMoving = true;

            landscapeScroll(slides, destiny);
        }

        function scrollPage(element, callback, isMovementUp){
            var scrollOptions = {}, scrolledElement;
            var dest = element.position();
            if(typeof dest === "undefined"){ return; } //there's no element to scroll, leaving the function
            var dtop = dest.top;
            var yMovement = getYmovement(element);
            var anchorLink  = element.data('anchor');
            var sectionIndex = element.index('.section');
            var activeSlide = element.find('.slide.active');
            var activeSection = $('.section.active');
            var leavingSection = activeSection.index('.section') + 1;

            //caching the value of isResizing at the momment the function is called
            //because it will be checked later inside a setTimeout and the value might change
            var localIsResizing = isResizing;

            if(activeSlide.length){
                var slideAnchorLink = activeSlide.data('anchor');
                var slideIndex = activeSlide.index();
            }

            // If continuousVertical && we need to wrap around
            if (options.autoScrolling && options.continuousVertical && typeof (isMovementUp) !== "undefined" &&
                ((!isMovementUp && yMovement == 'up') || // Intending to scroll down but about to go up or
                (isMovementUp && yMovement == 'down'))) { // intending to scroll up but about to go down

                // Scrolling down
                if (!isMovementUp) {
                    // Move all previous sections to after the active section
                    $(".section.active").after(activeSection.prevAll(".section").get().reverse());
                }
                else { // Scrolling up
                    // Move all next sections to before the active section
                    $(".section.active").before(activeSection.nextAll(".section"));
                }

                // Maintain the displayed position (now that we changed the element order)
                silentScroll($('.section.active').position().top);

                // save for later the elements that still need to be reordered
                var wrapAroundElements = activeSection;

                // Recalculate animation variables
                dest = element.position();
                dtop = dest.top;
                yMovement = getYmovement(element);
            }


            element.addClass('active').siblings().removeClass('active');

            //preventing from activating the MouseWheelHandler event
            //more than once if the page is scrolling
            isMoving = true;

            if(typeof anchorLink !== 'undefined'){
                setURLHash(slideIndex, slideAnchorLink, anchorLink);
            }

            if(options.autoScrolling){
                scrollOptions['top'] = -dtop;
                scrolledElement = '.'+wrapperSelector;
            }else{
                scrollOptions['scrollTop'] = dtop;
                scrolledElement = 'html, body';
            }

            // Fix section order after continuousVertical changes have been animated
            var continuousVerticalFixSectionOrder = function () {
                // If continuousVertical is in effect (and autoScrolling would also be in effect then),
                // finish moving the elements around so the direct navigation will function more simply
                if (!wrapAroundElements || !wrapAroundElements.length) {
                    return;
                }

                if (isMovementUp) {
                    $('.section:first').before(wrapAroundElements);
                }
                else {
                    $('.section:last').after(wrapAroundElements);
                }

                silentScroll($('.section.active').position().top);
            };


            // Use CSS3 translate functionality or...
            if (options.css3 && options.autoScrolling) {

                //callback (onLeave) if the site is not just resizing and readjusting the slides
                $.isFunction(options.onLeave) && !localIsResizing && options.onLeave.call(this, leavingSection, (sectionIndex + 1), yMovement);


                var translate3d = 'translate3d(0px, -' + dtop + 'px, 0px)';
                transformContainer(translate3d, true);

                setTimeout(function () {
                    //fix section order from continuousVertical
                    continuousVerticalFixSectionOrder();

                    //callback (afterLoad)  if the site is not just resizing and readjusting the slides
                    $.isFunction(options.afterLoad) && !localIsResizing && options.afterLoad.call(this, anchorLink, (sectionIndex + 1));

                    setTimeout(function () {
                        isMoving = false;
                        $.isFunction(callback) && callback.call(this);
                    }, scrollDelay);
                }, options.scrollingSpeed);
            } else { // ... use jQuery animate

                //callback (onLeave) if the site is not just resizing and readjusting the slides
                $.isFunction(options.onLeave) && !localIsResizing && options.onLeave.call(this, leavingSection, (sectionIndex + 1), yMovement);

                $(scrolledElement).animate(
                    scrollOptions
                , options.scrollingSpeed, options.easing, function () {
                    //fix section order from continuousVertical
                    continuousVerticalFixSectionOrder();

                    //callback (afterLoad) if the site is not just resizing and readjusting the slides
                    $.isFunction(options.afterLoad) && !localIsResizing && options.afterLoad.call(this, anchorLink, (sectionIndex + 1));

                    setTimeout(function () {
                        isMoving = false;
                        $.isFunction(callback) && callback.call(this);
                    }, scrollDelay);
                });
            }

            //flag to avoid callingn `scrollPage()` twice in case of using anchor links
            lastScrolledDestiny = anchorLink;

            //avoid firing it twice (as it does also on scroll)
            if(options.autoScrolling){
                activateMenuElement(anchorLink);
                activateNavDots(anchorLink, sectionIndex);
            }
        }

        function scrollToAnchor(){
            //getting the anchor link in the URL and deleting the `#`
            var value =  window.location.hash.replace('#', '').split('/');
            var section = value[0];
            var slide = value[1];

            if(section){  //if theres any #
                scrollPageAndSlide(section, slide);
            }
        }

        //detecting any change on the URL to scroll to the given anchor link
        //(a way to detect back history button as we play with the hashes on the URL)
        $(window).on('hashchange', hashChangeHandler);

        function hashChangeHandler(){
            if(!isScrolling){
                var value =  window.location.hash.replace('#', '').split('/');
                var section = value[0];
                var slide = value[1];

                //when moving to a slide in the first section for the first time (first time to add an anchor to the URL)
                var isFirstSlideMove =  (typeof lastScrolledDestiny === 'undefined');
                var isFirstScrollMove = (typeof lastScrolledDestiny === 'undefined' && typeof slide === 'undefined' && !slideMoving);

                /*in order to call scrollpage() only once for each destination at a time
                It is called twice for each scroll otherwise, as in case of using anchorlinks `hashChange`
                event is fired on every scroll too.*/
                if ((section && section !== lastScrolledDestiny) && !isFirstSlideMove || isFirstScrollMove || (!slideMoving && lastScrolledSlide != slide ))  {
                    scrollPageAndSlide(section, slide);
                }
            }
        }


        /**
         * Sliding with arrow keys, both, vertical and horizontal
         */
        $(document).keydown(function(e) {
            //Moving the main page with the keyboard arrows if keyboard scrolling is enabled
            if (options.keyboardScrolling && !isMoving) {
                switch (e.which) {
                    //up
                    case 38:
                    case 33:
                        $.fn.fullpage.moveSectionUp();
                        break;

                    //down
                    case 40:
                    case 34:
                        $.fn.fullpage.moveSectionDown();
                        break;

                    //Home
                    case 36:
                        $.fn.fullpage.moveTo(1);
                        break;

                    //End
                    case 35:
                        $.fn.fullpage.moveTo( $('.section').length );
                        break;

                    //left
                    case 37:
                        $.fn.fullpage.moveSlideLeft();
                        break;

                    //right
                    case 39:
                        $.fn.fullpage.moveSlideRight();
                        break;

                    default:
                        return; // exit this handler for other keys
                }
            }
        });

        //navigation action
        $(document).on('click', '#fullPage-nav a', function(e){
            e.preventDefault();
            var index = $(this).parent().index();
            scrollPage($('.section').eq(index));
        });

        //navigation tooltips
        $(document).on({
            mouseenter: function(){
                var tooltip = $(this).data('tooltip');
                $('<div class="fullPage-tooltip ' + options.navigationPosition +'">' + tooltip + '</div>').hide().appendTo($(this)).fadeIn(200);
            },
            mouseleave: function(){
                $(this).find('.fullPage-tooltip').fadeOut().remove();
            }
        }, '#fullPage-nav span');


        if(options.normalScrollElements){
            $(document).on('mouseover', options.normalScrollElements, function () {
                $.fn.fullpage.setMouseWheelScrolling(false);
            });

            $(document).on('mouseout', options.normalScrollElements, function(){
                $.fn.fullpage.setMouseWheelScrolling(true);
            });
        }

        /**
         * Scrolling horizontally when clicking on the slider controls.
         */
        $('.section').on('click', '.controlArrow', function() {
            if ($(this).hasClass('prev')) {
                $.fn.fullpage.moveSlideLeft();
            } else {
                $.fn.fullpage.moveSlideRight();
            }
        });


        /**
         * Scrolling horizontally when clicking on the slider controls.
         */
        $('.section').on('click', '.toSlide', function(e) {
            e.preventDefault();

            var slides = $(this).closest('.section').find('.slides');
            var currentSlide = slides.find('.slide.active');
            var destiny = null;

            destiny = slides.find('.slide').eq( ($(this).data('index') -1) );

            if(destiny.length > 0){
                landscapeScroll(slides, destiny);
            }
        });

        /**
        * Scrolls horizontal sliders.
        */
        function landscapeScroll(slides, destiny){
            var destinyPos = destiny.position();
            var slidesContainer = slides.find('.slidesContainer').parent();
            var slideIndex = destiny.index();
            var section = slides.closest('.section');
            var sectionIndex = section.index('.section');
            var anchorLink = section.data('anchor');
            var slidesNav = section.find('.fullPage-slidesNav');
            var slideAnchor = destiny.data('anchor');

            //caching the value of isResizing at the momment the function is called
            //because it will be checked later inside a setTimeout and the value might change
            var localIsResizing = isResizing;

            if(options.onSlideLeave){
                var prevSlideIndex = section.find('.slide.active').index();
                var xMovement = getXmovement(prevSlideIndex, slideIndex);

                //if the site is not just resizing and readjusting the slides
                if(!localIsResizing){
                    $.isFunction( options.onSlideLeave ) && options.onSlideLeave.call( this, anchorLink, (sectionIndex + 1), prevSlideIndex, xMovement);
                }
            }

            destiny.addClass('active').siblings().removeClass('active');


            if(typeof slideAnchor === 'undefined'){
                slideAnchor = slideIndex;
            }

            //only changing the URL if the slides are in the current section (not for resize re-adjusting)
            if(section.hasClass('active')){

                if(!options.loopHorizontal){
                    //hidding it for the fist slide, showing for the rest
                    section.find('.controlArrow.prev').toggle(slideIndex!=0);

                    //hidding it for the last slide, showing for the rest
                    section.find('.controlArrow.next').toggle(!destiny.is(':last-child'));
                }

                setURLHash(slideIndex, slideAnchor, anchorLink);
            }

            if(options.css3){
                var translate3d = 'translate3d(-' + destinyPos.left + 'px, 0px, 0px)';

                slides.find('.slidesContainer').toggleClass('easing', options.scrollingSpeed>0).css(getTransforms(translate3d));

                setTimeout(function(){
                    //if the site is not just resizing and readjusting the slides
                    if(!localIsResizing){
                        $.isFunction( options.afterSlideLoad ) && options.afterSlideLoad.call( this, anchorLink, (sectionIndex + 1), slideAnchor, slideIndex );
                    }

                    slideMoving = false;
                }, options.scrollingSpeed, options.easing);
            }else{
                slidesContainer.animate({
                    scrollLeft : destinyPos.left
                }, options.scrollingSpeed, options.easing, function() {

                    //if the site is not just resizing and readjusting the slides
                    if(!localIsResizing){
                        $.isFunction( options.afterSlideLoad ) && options.afterSlideLoad.call( this, anchorLink, (sectionIndex + 1), slideAnchor, slideIndex);
                    }
                    //letting them slide again
                    slideMoving = false;
                });
            }

            slidesNav.find('.active').removeClass('active');
            slidesNav.find('li').eq(slideIndex).find('a').addClass('active');
        }


        if (!isTouchDevice) {
            var resizeId;

            //when resizing the site, we adjust the heights of the sections
            $(window).resize(function() {
                //in order to call the functions only when the resize is finished
                //http://stackoverflow.com/questions/4298612/jquery-how-to-call-resize-event-only-once-its-finished-resizing
                clearTimeout(resizeId);
                resizeId = setTimeout($.fn.fullpage.reBuild, 500);
            });

        }


        var supportsOrientationChange = "onorientationchange" in window,
        orientationEvent = supportsOrientationChange ? "orientationchange" : "resize";

        $(window).bind(orientationEvent , function() {
            if(isTouchDevice){
                $.fn.fullpage.reBuild();
            }
        });


        /**
         * When resizing is finished, we adjust the slides sizes and positions
         */
        $.fn.fullpage.reBuild = function(){
            isResizing = true;

            var windowsWidth = $(window).width();
            windowsHeight = $(window).height();

            //text and images resizing
            if (options.resize) {
                resizeMe(windowsHeight, windowsWidth);
            }

            $('.section').each(function(){
                var scrollHeight = windowsHeight - parseInt($(this).css('padding-bottom')) - parseInt($(this).css('padding-top'));

                //adjusting the height of the table-cell for IE and Firefox
                if(options.verticalCentered){
                    $(this).find('.tableCell').css('height', getTableHeight($(this)) + 'px');
                }

                $(this).css('height', windowsHeight + 'px');

                //resizing the scrolling divs
                if(options.scrollOverflow){
                    var slides = $(this).find('.slide');

                    if(slides.length){
                        slides.each(function(){
                            createSlimScrolling($(this));
                        });
                    }else{
                        createSlimScrolling($(this));
                    }

                }

                //adjusting the position fo the FULL WIDTH slides...
                var slides = $(this).find('.slides');
                if (slides.length) {
                    landscapeScroll(slides, slides.find('.slide.active'));
                }
            });

            //adjusting the position for the current section
            var destinyPos = $('.section.active').position();

            var activeSection = $('.section.active');

            //isn't it the first section?
            if(activeSection.index('.section')){
                scrollPage(activeSection);
            }

            isResizing = false;
            $.isFunction( options.afterResize ) && options.afterResize.call( this);
        }

        /**
         * Resizing of the font size depending on the window size as well as some of the images on the site.
         */
        function resizeMe(displayHeight, displayWidth) {
            //Standard height, for which the body font size is correct
            var preferredHeight = 825;
            var windowSize = displayHeight;

            /* Problem to be solved

            if (displayHeight < 825) {
                var percentage = (windowSize * 100) / preferredHeight;
                var newFontSize = percentage.toFixed(2);

                $("img").each(function() {
                    var newWidth = ((80 * percentage) / 100).toFixed(2);
                    $(this).css("width", newWidth + '%');
                });
            } else {
                $("img").each(function() {
                    $(this).css("width", '');
                });
            }*/

            if (displayHeight < 825 || displayWidth < 900) {
                if (displayWidth < 900) {
                    windowSize = displayWidth;
                    preferredHeight = 900;
                }
                var percentage = (windowSize * 100) / preferredHeight;
                var newFontSize = percentage.toFixed(2);

                $("body").css("font-size", newFontSize + '%');
            } else {
                $("body").css("font-size", '100%');
            }
        }

        /**
         * Activating the website navigation dots according to the given slide name.
         */
        function activateNavDots(name, sectionIndex){
            if(options.navigation){
                $('#fullPage-nav').find('.swiper-active-switch').removeClass('swiper-active-switch');
                if(name){
                    $('#fullPage-nav').find('a[href="#' + name + '"]').parent().addClass('swiper-active-switch');
                }else{
                    $('#fullPage-nav').find('span').eq(sectionIndex).addClass('swiper-active-switch');
                }
            }
        }

        /**
         * Activating the website main menu elements according to the given slide name.
         */
        function activateMenuElement(name){
            if(options.menu){
                $(options.menu).find('.active').removeClass('active');
                $(options.menu).find('[data-menuanchor="'+name+'"]').addClass('active');
            }
        }

        /**
        * Return a boolean depending on whether the scrollable element is at the end or at the start of the scrolling
        * depending on the given type.
        */
        function isScrolled(type, scrollable){
            if(type === 'top'){
                return !scrollable.scrollTop();
            }else if(type === 'bottom'){
                return scrollable.scrollTop() + 1 + scrollable.innerHeight() >= scrollable[0].scrollHeight;
            }
        }

        /**
        * Retuns `up` or `down` depending on the scrolling movement to reach its destination
        * from the current section.
        */
        function getYmovement(destiny){
            var fromIndex = $('.section.active').index('.section');
            var toIndex = destiny.index('.section');

            if(fromIndex > toIndex){
                return 'up';
            }
            return 'down';
        }

        /**
        * Retuns `right` or `left` depending on the scrolling movement to reach its destination
        * from the current slide.
        */
        function getXmovement(fromIndex, toIndex){
            if( fromIndex == toIndex){
                return 'none'
            }
            if(fromIndex > toIndex){
                return 'left';
            }
            return 'right';
        }


        function createSlimScrolling(element){
            //needed to make `scrollHeight` work under Opera 12
            element.css('overflow', 'hidden');

            //in case element is a slide
            var section = element.closest('.section');
            var scrollable = element.find('.scrollable');

            //if there was scroll, the contentHeight will be the one in the scrollable section
            if(scrollable.length){
                var contentHeight = element.find('.scrollable').get(0).scrollHeight;
            }else{
                var contentHeight = element.get(0).scrollHeight;
                if(options.verticalCentered){
                    contentHeight = element.find('.tableCell').get(0).scrollHeight;
                }
            }

            var scrollHeight = windowsHeight - parseInt(section.css('padding-bottom')) - parseInt(section.css('padding-top'));

            //needs scroll?
            // if ( contentHeight > scrollHeight) {
            //     //was there already an scroll ? Updating it
            //     if(scrollable.length){
            //         scrollable.css('height', scrollHeight + 'px').parent().css('height', scrollHeight + 'px');
            //     }
            //     //creating the scrolling
            //     else{
            //         if(options.verticalCentered){
            //             element.find('.tableCell').wrapInner('<div class="scrollable" />');
            //         }else{
            //             element.wrapInner('<div class="scrollable" />');
            //         }


            //         // element.find('.scrollable').slimScroll({
            //         //     height: scrollHeight + 'px',
            //         //     size: '10px',
            //         //     alwaysVisible: true
            //         // });
            //     }
            // }

            // //removing the scrolling when it is not necessary anymore
            // else{
            //     removeSlimScroll(element);
            // }

            //undo
            element.css('overflow', '');
        }

        function removeSlimScroll(element){
            element.find('.scrollable').children().first().unwrap().unwrap();
            element.find('.slimScrollBar').remove();
            element.find('.slimScrollRail').remove();
        }

        function addTableClass(element){
            element.addClass('table').wrapInner('<div class="tableCell" style="height:' + getTableHeight(element) + 'px;" />');
        }

        function getTableHeight(element){
            var sectionHeight = windowsHeight;

            if(options.paddingTop || options.paddingBottom){
                var section = element;
                if(!section.hasClass('section')){
                    section = element.closest('.section');
                }

                var paddings = parseInt(section.css('padding-top')) + parseInt(section.css('padding-bottom'));
                sectionHeight = (windowsHeight - paddings);
            }

            return sectionHeight;
        }

        /**
        * Adds a css3 transform property to the container class with or without animation depending on the animated param.
        */
        function transformContainer(translate3d, animated){
            container.toggleClass('easing', animated);

            container.css(getTransforms(translate3d));
        }


        /**
        * Scrolls to the given section and slide
        */
        function scrollPageAndSlide(destiny, slide){
            if (typeof slide === 'undefined') {
                slide = 0;
            }

            if(isNaN(destiny)){
                var section = $('[data-anchor="'+destiny+'"]');
            }else{
                var section = $('.section').eq( (destiny -1) );
            }


            //we need to scroll to the section and then to the slide
            if (destiny !== lastScrolledDestiny && !section.hasClass('active')){
                scrollPage(section, function(){
                    scrollSlider(section, slide)
                });
            }
            //if we were already in the section
            else{
                scrollSlider(section, slide);
            }

        }

        /**
        * Scrolls the slider to the given slide destination for the given section
        */
        function scrollSlider(section, slide){
            if(typeof slide != 'undefined'){
                var slides = section.find('.slides');
                var destiny =  slides.find('[data-anchor="'+slide+'"]');

                if(!destiny.length){
                    destiny = slides.find('.slide').eq(slide);
                }

                if(destiny.length){
                    landscapeScroll(slides, destiny);
                }
            }
        }

        /**
        * Creates a landscape navigation bar with dots for horizontal sliders.
        */
        function addSlidesNavigation(section, numSlides){
            section.append('<div class="fullPage-slidesNav"><ul></ul></div>');
            var nav = section.find('.fullPage-slidesNav');

            //top or bottom
            nav.addClass(options.slidesNavPosition);

            for(var i=0; i< numSlides; i++){
                nav.find('ul').append('<li><a href="#"><span></span></a></li>');
            }

            //centering it
            nav.css('margin-left', '-' + (nav.width()/2) + 'px');

            nav.find('li').first().find('a').addClass('active');
        }


        /**
        * Sets the URL hash for a section with slides
        */
        function setURLHash(slideIndex, slideAnchor, anchorLink){
            var sectionHash = '';

            if(options.anchors.length){

                //isn't it the first slide?
                if(slideIndex){
                    if(typeof anchorLink !== 'undefined'){
                        sectionHash = anchorLink;
                    }

                    //slide without anchor link? We take the index instead.
                    if(typeof slideAnchor === 'undefined'){
                        slideAnchor = slideIndex;
                    }

                    lastScrolledSlide = slideAnchor;
                    location.hash = sectionHash + '/' + slideAnchor;

                //first slide won't have slide anchor, just the section one
                }else if(typeof slideIndex !== 'undefined'){
                    lastScrolledSlide = slideAnchor;
                    location.hash = anchorLink;
                }

                //section without slides
                else{
                    location.hash = anchorLink;
                }
            }
        }

        /**
        * Scrolls the slider to the given slide destination for the given section
        */
        $(document).on('click', '.fullPage-slidesNav a', function(e){
            e.preventDefault();
            var slides = $(this).closest('.section').find('.slides');
            var destiny = slides.find('.slide').eq($(this).closest('li').index());

            landscapeScroll(slides, destiny);
        });


        /**
        * Checks for translate3d support
        * @return boolean
        * http://stackoverflow.com/questions/5661671/detecting-transform-translate3d-support
        */
        function support3d() {
            var el = document.createElement('p'),
                has3d,
                transforms = {
                    'webkitTransform':'-webkit-transform',
                    'OTransform':'-o-transform',
                    'msTransform':'-ms-transform',
                    'MozTransform':'-moz-transform',
                    'transform':'transform'
                };

            // Add it to the body to get the computed style.
            document.body.insertBefore(el, null);

            for (var t in transforms) {
                if (el.style[t] !== undefined) {
                    el.style[t] = "translate3d(1px,1px,1px)";
                    has3d = window.getComputedStyle(el).getPropertyValue(transforms[t]);
                }
            }

            document.body.removeChild(el);

            return (has3d !== undefined && has3d.length > 0 && has3d !== "none");
        }



        /**
        * Removes the auto scrolling action fired by the mouse wheel and tackpad.
        * After this function is called, the mousewheel and trackpad movements won't scroll through sections.
        */
        function removeMouseWheelHandler(){
            if (document.addEventListener) {
                document.removeEventListener('mousewheel', MouseWheelHandler, false); //IE9, Chrome, Safari, Oper
                document.removeEventListener('wheel', MouseWheelHandler, false); //Firefox
            } else {
                document.detachEvent("onmousewheel", MouseWheelHandler); //IE 6/7/8
            }
        }


        /**
        * Adds the auto scrolling action for the mouse wheel and tackpad.
        * After this function is called, the mousewheel and trackpad movements will scroll through sections
        */
        function addMouseWheelHandler(){
            if (document.addEventListener) {
                document.addEventListener("mousewheel", MouseWheelHandler, false); //IE9, Chrome, Safari, Oper
                document.addEventListener("wheel", MouseWheelHandler, false); //Firefox
            } else {
                document.attachEvent("onmousewheel", MouseWheelHandler); //IE 6/7/8
            }
        }


        /**
        * Adds the possibility to auto scroll through sections on touch devices.
        */
        function addTouchHandler(){
            if(isTouchDevice){
                //Microsoft pointers
                MSPointer = getMSPointer();

                $(document).off('touchstart ' +  MSPointer.down).on('touchstart ' + MSPointer.down, touchStartHandler);
                $(document).off('touchmove ' + MSPointer.move).on('touchmove ' + MSPointer.move, touchMoveHandler);
            }
        }

        /**
        * Removes the auto scrolling for touch devices.
        */
        function removeTouchHandler(){
            if(isTouchDevice){
                //Microsoft pointers
                MSPointer = getMSPointer();

                $(document).off('touchstart ' + MSPointer.down);
                $(document).off('touchmove ' + MSPointer.move);
            }
        }


        /*
        * Returns and object with Microsoft pointers (for IE<11 and for IE >= 11)
        * http://msdn.microsoft.com/en-us/library/ie/dn304886(v=vs.85).aspx
        */
        function getMSPointer(){
            var pointer;

            //IE >= 11
            if(window.PointerEvent){
                pointer = { down: "pointerdown", move: "pointermove"};
            }

            //IE < 11
            else{
                pointer = { down: "MSPointerDown", move: "MSPointerMove"};
            }

            return pointer;
        }
        /**
        * Gets the pageX and pageY properties depending on the browser.
        * https://github.com/alvarotrigo/fullPage.js/issues/194#issuecomment-34069854
        */
        function getEventsPage(e){
            var events = new Array();
            if (window.navigator.msPointerEnabled){
                events['y'] = e.pageY;
                events['x'] = e.pageX;
            }else{
                events['y'] = e.touches[0].pageY;
                events['x'] =  e.touches[0].pageX;
            }

            return events;
        }

        function silentScroll(top){
            if (options.css3) {
                var translate3d = 'translate3d(0px, -' + top + 'px, 0px)';
                transformContainer(translate3d, false);
            }
            else {
                container.css("top", -top);
            }
        }

        function getTransforms(translate3d){
            return {
                '-webkit-transform': translate3d,
                '-moz-transform': translate3d,
                '-ms-transform':translate3d,
                'transform': translate3d
            };
        }


        /*
        * Destroys fullpage.js plugin events and optinally its html markup and styles
        */

        $('body').on('mk-opened-nav', function() {
            $.fn.fullpage.setAutoScrolling(false);
            $.fn.fullpage.setAllowScrolling(false);
            $.fn.fullpage.setKeyboardScrolling(false);

            $(window)
                .off('scroll', scrollHandler);
        });

        $('body').on('mk-closed-nav', function() {
            $.fn.fullpage.setAutoScrolling(true);
            $.fn.fullpage.setAllowScrolling(true);
            $.fn.fullpage.setKeyboardScrolling(true);

            $(window)
                .on('scroll', scrollHandler);
        });

        $.fn.fullpage.destroy = function(all){
            $.fn.fullpage.setAutoScrolling(false);
            $.fn.fullpage.setAllowScrolling(false);
            $.fn.fullpage.setKeyboardScrolling(false);


            $(window)
                .off('scroll', scrollHandler)
                .off('hashchange', hashChangeHandler);

            $(document)
                .off('click', '#fullPage-nav a')
                .off('mouseenter', '#fullPage-nav span')
                .off('mouseleave', '#fullPage-nav span')
                .off('click', '.fullPage-slidesNav a')
                .off('mouseover', options.normalScrollElements)
                .off('mouseout', options.normalScrollElements);

            $('.section')
                .off('click', '.controlArrow')
                .off('click', '.toSlide');

            //lets make a mess!
            if(all){
                destroyStructure();
            }
        };

        /*
        * Removes inline styles added by fullpage.js
        */
        function destroyStructure(){
            //reseting the `top` or `translate` properties to 0
            silentScroll(0);

            $('#fullPage-nav, .fullPage-slidesNav, .controlArrow').remove();

            //removing inline styles
            $('.section').css( {
                'height': '',
                'background-color' : '',
                'padding': ''
            });

            $('.slide').css( {
                'width': ''
            });

            container.css({
                'height': '',
                'position': '',
                '-ms-touch-action': ''
            });

            //removing added classes
            $('.section, .slide').each(function(){
                removeSlimScroll($(this));
                $(this).removeClass('table active');
            })

            container.find('.easing').removeClass('easing');

            //Unwrapping content
            container.find('.tableCell, .slidesContainer, .slides').each(function(){
                //unwrap not being use in case there's no child element inside and its just text
                $(this).replaceWith(this.childNodes);
            });

            //scrolling the page to the top with no animation
            $('html, body').scrollTop(0);

            //to know if the plugin was already used in case it is used in a future again
            container.addClass('fullpage-used');
        }

    };

})(jQuery);
;/*!
 * VERSION: 1.12.1
 * DATE: 2014-06-26
 * UPDATES AND DOCS AT: http://www.greensock.com
 * 
 * Includes all of the following: TweenLite, TweenMax, TimelineLite, TimelineMax, EasePack, CSSPlugin, RoundPropsPlugin, BezierPlugin, AttrPlugin, DirectionalRotationPlugin
 *
 * @license Copyright (c) 2008-2014, GreenSock. All rights reserved.
 * This work is subject to the terms at http://www.greensock.com/terms_of_use.html or for
 * Club GreenSock members, the software agreement that was issued with your membership.
 * 
 * @author: Jack Doyle, jack@greensock.com
 **/
(window._gsQueue||(window._gsQueue=[])).push(function(){"use strict";window._gsDefine("TweenMax",["core.Animation","core.SimpleTimeline","TweenLite"],function(t,e,i){var s=[].slice,r=function(t,e,s){i.call(this,t,e,s),this._cycle=0,this._yoyo=this.vars.yoyo===!0,this._repeat=this.vars.repeat||0,this._repeatDelay=this.vars.repeatDelay||0,this._dirty=!0,this.render=r.prototype.render},n=1e-10,a=i._internals,o=a.isSelector,h=a.isArray,l=r.prototype=i.to({},.1,{}),_=[];r.version="1.12.1",l.constructor=r,l.kill()._gc=!1,r.killTweensOf=r.killDelayedCallsTo=i.killTweensOf,r.getTweensOf=i.getTweensOf,r.lagSmoothing=i.lagSmoothing,r.ticker=i.ticker,r.render=i.render,l.invalidate=function(){return this._yoyo=this.vars.yoyo===!0,this._repeat=this.vars.repeat||0,this._repeatDelay=this.vars.repeatDelay||0,this._uncache(!0),i.prototype.invalidate.call(this)},l.updateTo=function(t,e){var s,r=this.ratio;e&&this._startTime<this._timeline._time&&(this._startTime=this._timeline._time,this._uncache(!1),this._gc?this._enabled(!0,!1):this._timeline.insert(this,this._startTime-this._delay));for(s in t)this.vars[s]=t[s];if(this._initted)if(e)this._initted=!1;else if(this._gc&&this._enabled(!0,!1),this._notifyPluginsOfEnabled&&this._firstPT&&i._onPluginEvent("_onDisable",this),this._time/this._duration>.998){var n=this._time;this.render(0,!0,!1),this._initted=!1,this.render(n,!0,!1)}else if(this._time>0){this._initted=!1,this._init();for(var a,o=1/(1-r),h=this._firstPT;h;)a=h.s+h.c,h.c*=o,h.s=a-h.c,h=h._next}return this},l.render=function(t,e,i){this._initted||0===this._duration&&this.vars.repeat&&this.invalidate();var s,r,o,h,l,u,p,f,c=this._dirty?this.totalDuration():this._totalDuration,m=this._time,d=this._totalTime,g=this._cycle,v=this._duration,y=this._rawPrevTime;if(t>=c?(this._totalTime=c,this._cycle=this._repeat,this._yoyo&&0!==(1&this._cycle)?(this._time=0,this.ratio=this._ease._calcEnd?this._ease.getRatio(0):0):(this._time=v,this.ratio=this._ease._calcEnd?this._ease.getRatio(1):1),this._reversed||(s=!0,r="onComplete"),0===v&&(this._initted||!this.vars.lazy||i)&&(this._startTime===this._timeline._duration&&(t=0),(0===t||0>y||y===n)&&y!==t&&(i=!0,y>n&&(r="onReverseComplete")),this._rawPrevTime=f=!e||t||y===t?t:n)):1e-7>t?(this._totalTime=this._time=this._cycle=0,this.ratio=this._ease._calcEnd?this._ease.getRatio(0):0,(0!==d||0===v&&y>0&&y!==n)&&(r="onReverseComplete",s=this._reversed),0>t?(this._active=!1,0===v&&(this._initted||!this.vars.lazy||i)&&(y>=0&&(i=!0),this._rawPrevTime=f=!e||t||y===t?t:n)):this._initted||(i=!0)):(this._totalTime=this._time=t,0!==this._repeat&&(h=v+this._repeatDelay,this._cycle=this._totalTime/h>>0,0!==this._cycle&&this._cycle===this._totalTime/h&&this._cycle--,this._time=this._totalTime-this._cycle*h,this._yoyo&&0!==(1&this._cycle)&&(this._time=v-this._time),this._time>v?this._time=v:0>this._time&&(this._time=0)),this._easeType?(l=this._time/v,u=this._easeType,p=this._easePower,(1===u||3===u&&l>=.5)&&(l=1-l),3===u&&(l*=2),1===p?l*=l:2===p?l*=l*l:3===p?l*=l*l*l:4===p&&(l*=l*l*l*l),this.ratio=1===u?1-l:2===u?l:.5>this._time/v?l/2:1-l/2):this.ratio=this._ease.getRatio(this._time/v)),m===this._time&&!i&&g===this._cycle)return d!==this._totalTime&&this._onUpdate&&(e||this._onUpdate.apply(this.vars.onUpdateScope||this,this.vars.onUpdateParams||_)),void 0;if(!this._initted){if(this._init(),!this._initted||this._gc)return;if(!i&&this._firstPT&&(this.vars.lazy!==!1&&this._duration||this.vars.lazy&&!this._duration))return this._time=m,this._totalTime=d,this._rawPrevTime=y,this._cycle=g,a.lazyTweens.push(this),this._lazy=t,void 0;this._time&&!s?this.ratio=this._ease.getRatio(this._time/v):s&&this._ease._calcEnd&&(this.ratio=this._ease.getRatio(0===this._time?0:1))}for(this._lazy!==!1&&(this._lazy=!1),this._active||!this._paused&&this._time!==m&&t>=0&&(this._active=!0),0===d&&(2===this._initted&&t>0&&this._init(),this._startAt&&(t>=0?this._startAt.render(t,e,i):r||(r="_dummyGS")),this.vars.onStart&&(0!==this._totalTime||0===v)&&(e||this.vars.onStart.apply(this.vars.onStartScope||this,this.vars.onStartParams||_))),o=this._firstPT;o;)o.f?o.t[o.p](o.c*this.ratio+o.s):o.t[o.p]=o.c*this.ratio+o.s,o=o._next;this._onUpdate&&(0>t&&this._startAt&&this._startTime&&this._startAt.render(t,e,i),e||(this._totalTime!==d||s)&&this._onUpdate.apply(this.vars.onUpdateScope||this,this.vars.onUpdateParams||_)),this._cycle!==g&&(e||this._gc||this.vars.onRepeat&&this.vars.onRepeat.apply(this.vars.onRepeatScope||this,this.vars.onRepeatParams||_)),r&&(this._gc||(0>t&&this._startAt&&!this._onUpdate&&this._startTime&&this._startAt.render(t,e,i),s&&(this._timeline.autoRemoveChildren&&this._enabled(!1,!1),this._active=!1),!e&&this.vars[r]&&this.vars[r].apply(this.vars[r+"Scope"]||this,this.vars[r+"Params"]||_),0===v&&this._rawPrevTime===n&&f!==n&&(this._rawPrevTime=0)))},r.to=function(t,e,i){return new r(t,e,i)},r.from=function(t,e,i){return i.runBackwards=!0,i.immediateRender=0!=i.immediateRender,new r(t,e,i)},r.fromTo=function(t,e,i,s){return s.startAt=i,s.immediateRender=0!=s.immediateRender&&0!=i.immediateRender,new r(t,e,s)},r.staggerTo=r.allTo=function(t,e,n,a,l,u,p){a=a||0;var f,c,m,d,g=n.delay||0,v=[],y=function(){n.onComplete&&n.onComplete.apply(n.onCompleteScope||this,arguments),l.apply(p||this,u||_)};for(h(t)||("string"==typeof t&&(t=i.selector(t)||t),o(t)&&(t=s.call(t,0))),f=t.length,m=0;f>m;m++){c={};for(d in n)c[d]=n[d];c.delay=g,m===f-1&&l&&(c.onComplete=y),v[m]=new r(t[m],e,c),g+=a}return v},r.staggerFrom=r.allFrom=function(t,e,i,s,n,a,o){return i.runBackwards=!0,i.immediateRender=0!=i.immediateRender,r.staggerTo(t,e,i,s,n,a,o)},r.staggerFromTo=r.allFromTo=function(t,e,i,s,n,a,o,h){return s.startAt=i,s.immediateRender=0!=s.immediateRender&&0!=i.immediateRender,r.staggerTo(t,e,s,n,a,o,h)},r.delayedCall=function(t,e,i,s,n){return new r(e,0,{delay:t,onComplete:e,onCompleteParams:i,onCompleteScope:s,onReverseComplete:e,onReverseCompleteParams:i,onReverseCompleteScope:s,immediateRender:!1,useFrames:n,overwrite:0})},r.set=function(t,e){return new r(t,0,e)},r.isTweening=function(t){return i.getTweensOf(t,!0).length>0};var u=function(t,e){for(var s=[],r=0,n=t._first;n;)n instanceof i?s[r++]=n:(e&&(s[r++]=n),s=s.concat(u(n,e)),r=s.length),n=n._next;return s},p=r.getAllTweens=function(e){return u(t._rootTimeline,e).concat(u(t._rootFramesTimeline,e))};r.killAll=function(t,i,s,r){null==i&&(i=!0),null==s&&(s=!0);var n,a,o,h=p(0!=r),l=h.length,_=i&&s&&r;for(o=0;l>o;o++)a=h[o],(_||a instanceof e||(n=a.target===a.vars.onComplete)&&s||i&&!n)&&(t?a.totalTime(a._reversed?0:a.totalDuration()):a._enabled(!1,!1))},r.killChildTweensOf=function(t,e){if(null!=t){var n,l,_,u,p,f=a.tweenLookup;if("string"==typeof t&&(t=i.selector(t)||t),o(t)&&(t=s.call(t,0)),h(t))for(u=t.length;--u>-1;)r.killChildTweensOf(t[u],e);else{n=[];for(_ in f)for(l=f[_].target.parentNode;l;)l===t&&(n=n.concat(f[_].tweens)),l=l.parentNode;for(p=n.length,u=0;p>u;u++)e&&n[u].totalTime(n[u].totalDuration()),n[u]._enabled(!1,!1)}}};var f=function(t,i,s,r){i=i!==!1,s=s!==!1,r=r!==!1;for(var n,a,o=p(r),h=i&&s&&r,l=o.length;--l>-1;)a=o[l],(h||a instanceof e||(n=a.target===a.vars.onComplete)&&s||i&&!n)&&a.paused(t)};return r.pauseAll=function(t,e,i){f(!0,t,e,i)},r.resumeAll=function(t,e,i){f(!1,t,e,i)},r.globalTimeScale=function(e){var s=t._rootTimeline,r=i.ticker.time;return arguments.length?(e=e||n,s._startTime=r-(r-s._startTime)*s._timeScale/e,s=t._rootFramesTimeline,r=i.ticker.frame,s._startTime=r-(r-s._startTime)*s._timeScale/e,s._timeScale=t._rootTimeline._timeScale=e,e):s._timeScale},l.progress=function(t){return arguments.length?this.totalTime(this.duration()*(this._yoyo&&0!==(1&this._cycle)?1-t:t)+this._cycle*(this._duration+this._repeatDelay),!1):this._time/this.duration()},l.totalProgress=function(t){return arguments.length?this.totalTime(this.totalDuration()*t,!1):this._totalTime/this.totalDuration()},l.time=function(t,e){return arguments.length?(this._dirty&&this.totalDuration(),t>this._duration&&(t=this._duration),this._yoyo&&0!==(1&this._cycle)?t=this._duration-t+this._cycle*(this._duration+this._repeatDelay):0!==this._repeat&&(t+=this._cycle*(this._duration+this._repeatDelay)),this.totalTime(t,e)):this._time},l.duration=function(e){return arguments.length?t.prototype.duration.call(this,e):this._duration},l.totalDuration=function(t){return arguments.length?-1===this._repeat?this:this.duration((t-this._repeat*this._repeatDelay)/(this._repeat+1)):(this._dirty&&(this._totalDuration=-1===this._repeat?999999999999:this._duration*(this._repeat+1)+this._repeatDelay*this._repeat,this._dirty=!1),this._totalDuration)},l.repeat=function(t){return arguments.length?(this._repeat=t,this._uncache(!0)):this._repeat},l.repeatDelay=function(t){return arguments.length?(this._repeatDelay=t,this._uncache(!0)):this._repeatDelay},l.yoyo=function(t){return arguments.length?(this._yoyo=t,this):this._yoyo},r},!0),window._gsDefine("TimelineLite",["core.Animation","core.SimpleTimeline","TweenLite"],function(t,e,i){var s=function(t){e.call(this,t),this._labels={},this.autoRemoveChildren=this.vars.autoRemoveChildren===!0,this.smoothChildTiming=this.vars.smoothChildTiming===!0,this._sortChildren=!0,this._onUpdate=this.vars.onUpdate;var i,s,r=this.vars;for(s in r)i=r[s],a(i)&&-1!==i.join("").indexOf("{self}")&&(r[s]=this._swapSelfInParams(i));a(r.tweens)&&this.add(r.tweens,0,r.align,r.stagger)},r=1e-10,n=i._internals.isSelector,a=i._internals.isArray,o=[],h=window._gsDefine.globals,l=function(t){var e,i={};for(e in t)i[e]=t[e];return i},_=function(t,e,i,s){t._timeline.pause(t._startTime),e&&e.apply(s||t._timeline,i||o)},u=o.slice,p=s.prototype=new e;return s.version="1.12.1",p.constructor=s,p.kill()._gc=!1,p.to=function(t,e,s,r){var n=s.repeat&&h.TweenMax||i;return e?this.add(new n(t,e,s),r):this.set(t,s,r)},p.from=function(t,e,s,r){return this.add((s.repeat&&h.TweenMax||i).from(t,e,s),r)},p.fromTo=function(t,e,s,r,n){var a=r.repeat&&h.TweenMax||i;return e?this.add(a.fromTo(t,e,s,r),n):this.set(t,r,n)},p.staggerTo=function(t,e,r,a,o,h,_,p){var f,c=new s({onComplete:h,onCompleteParams:_,onCompleteScope:p,smoothChildTiming:this.smoothChildTiming});for("string"==typeof t&&(t=i.selector(t)||t),n(t)&&(t=u.call(t,0)),a=a||0,f=0;t.length>f;f++)r.startAt&&(r.startAt=l(r.startAt)),c.to(t[f],e,l(r),f*a);return this.add(c,o)},p.staggerFrom=function(t,e,i,s,r,n,a,o){return i.immediateRender=0!=i.immediateRender,i.runBackwards=!0,this.staggerTo(t,e,i,s,r,n,a,o)},p.staggerFromTo=function(t,e,i,s,r,n,a,o,h){return s.startAt=i,s.immediateRender=0!=s.immediateRender&&0!=i.immediateRender,this.staggerTo(t,e,s,r,n,a,o,h)},p.call=function(t,e,s,r){return this.add(i.delayedCall(0,t,e,s),r)},p.set=function(t,e,s){return s=this._parseTimeOrLabel(s,0,!0),null==e.immediateRender&&(e.immediateRender=s===this._time&&!this._paused),this.add(new i(t,0,e),s)},s.exportRoot=function(t,e){t=t||{},null==t.smoothChildTiming&&(t.smoothChildTiming=!0);var r,n,a=new s(t),o=a._timeline;for(null==e&&(e=!0),o._remove(a,!0),a._startTime=0,a._rawPrevTime=a._time=a._totalTime=o._time,r=o._first;r;)n=r._next,e&&r instanceof i&&r.target===r.vars.onComplete||a.add(r,r._startTime-r._delay),r=n;return o.add(a,0),a},p.add=function(r,n,o,h){var l,_,u,p,f,c;if("number"!=typeof n&&(n=this._parseTimeOrLabel(n,0,!0,r)),!(r instanceof t)){if(r instanceof Array||r&&r.push&&a(r)){for(o=o||"normal",h=h||0,l=n,_=r.length,u=0;_>u;u++)a(p=r[u])&&(p=new s({tweens:p})),this.add(p,l),"string"!=typeof p&&"function"!=typeof p&&("sequence"===o?l=p._startTime+p.totalDuration()/p._timeScale:"start"===o&&(p._startTime-=p.delay())),l+=h;return this._uncache(!0)}if("string"==typeof r)return this.addLabel(r,n);if("function"!=typeof r)throw"Cannot add "+r+" into the timeline; it is not a tween, timeline, function, or string.";r=i.delayedCall(0,r)}if(e.prototype.add.call(this,r,n),(this._gc||this._time===this._duration)&&!this._paused&&this._duration<this.duration())for(f=this,c=f.rawTime()>r._startTime;f._timeline;)c&&f._timeline.smoothChildTiming?f.totalTime(f._totalTime,!0):f._gc&&f._enabled(!0,!1),f=f._timeline;return this},p.remove=function(e){if(e instanceof t)return this._remove(e,!1);if(e instanceof Array||e&&e.push&&a(e)){for(var i=e.length;--i>-1;)this.remove(e[i]);return this}return"string"==typeof e?this.removeLabel(e):this.kill(null,e)},p._remove=function(t,i){e.prototype._remove.call(this,t,i);var s=this._last;return s?this._time>s._startTime+s._totalDuration/s._timeScale&&(this._time=this.duration(),this._totalTime=this._totalDuration):this._time=this._totalTime=this._duration=this._totalDuration=0,this},p.append=function(t,e){return this.add(t,this._parseTimeOrLabel(null,e,!0,t))},p.insert=p.insertMultiple=function(t,e,i,s){return this.add(t,e||0,i,s)},p.appendMultiple=function(t,e,i,s){return this.add(t,this._parseTimeOrLabel(null,e,!0,t),i,s)},p.addLabel=function(t,e){return this._labels[t]=this._parseTimeOrLabel(e),this},p.addPause=function(t,e,i,s){return this.call(_,["{self}",e,i,s],this,t)},p.removeLabel=function(t){return delete this._labels[t],this},p.getLabelTime=function(t){return null!=this._labels[t]?this._labels[t]:-1},p._parseTimeOrLabel=function(e,i,s,r){var n;if(r instanceof t&&r.timeline===this)this.remove(r);else if(r&&(r instanceof Array||r.push&&a(r)))for(n=r.length;--n>-1;)r[n]instanceof t&&r[n].timeline===this&&this.remove(r[n]);if("string"==typeof i)return this._parseTimeOrLabel(i,s&&"number"==typeof e&&null==this._labels[i]?e-this.duration():0,s);if(i=i||0,"string"!=typeof e||!isNaN(e)&&null==this._labels[e])null==e&&(e=this.duration());else{if(n=e.indexOf("="),-1===n)return null==this._labels[e]?s?this._labels[e]=this.duration()+i:i:this._labels[e]+i;i=parseInt(e.charAt(n-1)+"1",10)*Number(e.substr(n+1)),e=n>1?this._parseTimeOrLabel(e.substr(0,n-1),0,s):this.duration()}return Number(e)+i},p.seek=function(t,e){return this.totalTime("number"==typeof t?t:this._parseTimeOrLabel(t),e!==!1)},p.stop=function(){return this.paused(!0)},p.gotoAndPlay=function(t,e){return this.play(t,e)},p.gotoAndStop=function(t,e){return this.pause(t,e)},p.render=function(t,e,i){this._gc&&this._enabled(!0,!1);var s,n,a,h,l,_=this._dirty?this.totalDuration():this._totalDuration,u=this._time,p=this._startTime,f=this._timeScale,c=this._paused;if(t>=_?(this._totalTime=this._time=_,this._reversed||this._hasPausedChild()||(n=!0,h="onComplete",0===this._duration&&(0===t||0>this._rawPrevTime||this._rawPrevTime===r)&&this._rawPrevTime!==t&&this._first&&(l=!0,this._rawPrevTime>r&&(h="onReverseComplete"))),this._rawPrevTime=this._duration||!e||t||this._rawPrevTime===t?t:r,t=_+1e-4):1e-7>t?(this._totalTime=this._time=0,(0!==u||0===this._duration&&this._rawPrevTime!==r&&(this._rawPrevTime>0||0>t&&this._rawPrevTime>=0))&&(h="onReverseComplete",n=this._reversed),0>t?(this._active=!1,0===this._duration&&this._rawPrevTime>=0&&this._first&&(l=!0),this._rawPrevTime=t):(this._rawPrevTime=this._duration||!e||t||this._rawPrevTime===t?t:r,t=0,this._initted||(l=!0))):this._totalTime=this._time=this._rawPrevTime=t,this._time!==u&&this._first||i||l){if(this._initted||(this._initted=!0),this._active||!this._paused&&this._time!==u&&t>0&&(this._active=!0),0===u&&this.vars.onStart&&0!==this._time&&(e||this.vars.onStart.apply(this.vars.onStartScope||this,this.vars.onStartParams||o)),this._time>=u)for(s=this._first;s&&(a=s._next,!this._paused||c);)(s._active||s._startTime<=this._time&&!s._paused&&!s._gc)&&(s._reversed?s.render((s._dirty?s.totalDuration():s._totalDuration)-(t-s._startTime)*s._timeScale,e,i):s.render((t-s._startTime)*s._timeScale,e,i)),s=a;else for(s=this._last;s&&(a=s._prev,!this._paused||c);)(s._active||u>=s._startTime&&!s._paused&&!s._gc)&&(s._reversed?s.render((s._dirty?s.totalDuration():s._totalDuration)-(t-s._startTime)*s._timeScale,e,i):s.render((t-s._startTime)*s._timeScale,e,i)),s=a;this._onUpdate&&(e||this._onUpdate.apply(this.vars.onUpdateScope||this,this.vars.onUpdateParams||o)),h&&(this._gc||(p===this._startTime||f!==this._timeScale)&&(0===this._time||_>=this.totalDuration())&&(n&&(this._timeline.autoRemoveChildren&&this._enabled(!1,!1),this._active=!1),!e&&this.vars[h]&&this.vars[h].apply(this.vars[h+"Scope"]||this,this.vars[h+"Params"]||o)))}},p._hasPausedChild=function(){for(var t=this._first;t;){if(t._paused||t instanceof s&&t._hasPausedChild())return!0;t=t._next}return!1},p.getChildren=function(t,e,s,r){r=r||-9999999999;for(var n=[],a=this._first,o=0;a;)r>a._startTime||(a instanceof i?e!==!1&&(n[o++]=a):(s!==!1&&(n[o++]=a),t!==!1&&(n=n.concat(a.getChildren(!0,e,s)),o=n.length))),a=a._next;return n},p.getTweensOf=function(t,e){var s,r,n=this._gc,a=[],o=0;for(n&&this._enabled(!0,!0),s=i.getTweensOf(t),r=s.length;--r>-1;)(s[r].timeline===this||e&&this._contains(s[r]))&&(a[o++]=s[r]);return n&&this._enabled(!1,!0),a},p._contains=function(t){for(var e=t.timeline;e;){if(e===this)return!0;e=e.timeline}return!1},p.shiftChildren=function(t,e,i){i=i||0;for(var s,r=this._first,n=this._labels;r;)r._startTime>=i&&(r._startTime+=t),r=r._next;if(e)for(s in n)n[s]>=i&&(n[s]+=t);return this._uncache(!0)},p._kill=function(t,e){if(!t&&!e)return this._enabled(!1,!1);for(var i=e?this.getTweensOf(e):this.getChildren(!0,!0,!1),s=i.length,r=!1;--s>-1;)i[s]._kill(t,e)&&(r=!0);return r},p.clear=function(t){var e=this.getChildren(!1,!0,!0),i=e.length;for(this._time=this._totalTime=0;--i>-1;)e[i]._enabled(!1,!1);return t!==!1&&(this._labels={}),this._uncache(!0)},p.invalidate=function(){for(var t=this._first;t;)t.invalidate(),t=t._next;return this},p._enabled=function(t,i){if(t===this._gc)for(var s=this._first;s;)s._enabled(t,!0),s=s._next;return e.prototype._enabled.call(this,t,i)},p.duration=function(t){return arguments.length?(0!==this.duration()&&0!==t&&this.timeScale(this._duration/t),this):(this._dirty&&this.totalDuration(),this._duration)},p.totalDuration=function(t){if(!arguments.length){if(this._dirty){for(var e,i,s=0,r=this._last,n=999999999999;r;)e=r._prev,r._dirty&&r.totalDuration(),r._startTime>n&&this._sortChildren&&!r._paused?this.add(r,r._startTime-r._delay):n=r._startTime,0>r._startTime&&!r._paused&&(s-=r._startTime,this._timeline.smoothChildTiming&&(this._startTime+=r._startTime/this._timeScale),this.shiftChildren(-r._startTime,!1,-9999999999),n=0),i=r._startTime+r._totalDuration/r._timeScale,i>s&&(s=i),r=e;this._duration=this._totalDuration=s,this._dirty=!1}return this._totalDuration}return 0!==this.totalDuration()&&0!==t&&this.timeScale(this._totalDuration/t),this},p.usesFrames=function(){for(var e=this._timeline;e._timeline;)e=e._timeline;return e===t._rootFramesTimeline},p.rawTime=function(){return this._paused?this._totalTime:(this._timeline.rawTime()-this._startTime)*this._timeScale},s},!0),window._gsDefine("TimelineMax",["TimelineLite","TweenLite","easing.Ease"],function(t,e,i){var s=function(e){t.call(this,e),this._repeat=this.vars.repeat||0,this._repeatDelay=this.vars.repeatDelay||0,this._cycle=0,this._yoyo=this.vars.yoyo===!0,this._dirty=!0},r=1e-10,n=[],a=new i(null,null,1,0),o=s.prototype=new t;return o.constructor=s,o.kill()._gc=!1,s.version="1.12.1",o.invalidate=function(){return this._yoyo=this.vars.yoyo===!0,this._repeat=this.vars.repeat||0,this._repeatDelay=this.vars.repeatDelay||0,this._uncache(!0),t.prototype.invalidate.call(this)},o.addCallback=function(t,i,s,r){return this.add(e.delayedCall(0,t,s,r),i)},o.removeCallback=function(t,e){if(t)if(null==e)this._kill(null,t);else for(var i=this.getTweensOf(t,!1),s=i.length,r=this._parseTimeOrLabel(e);--s>-1;)i[s]._startTime===r&&i[s]._enabled(!1,!1);return this},o.tweenTo=function(t,i){i=i||{};var s,r,o,h={ease:a,overwrite:i.delay?2:1,useFrames:this.usesFrames(),immediateRender:!1};for(r in i)h[r]=i[r];return h.time=this._parseTimeOrLabel(t),s=Math.abs(Number(h.time)-this._time)/this._timeScale||.001,o=new e(this,s,h),h.onStart=function(){o.target.paused(!0),o.vars.time!==o.target.time()&&s===o.duration()&&o.duration(Math.abs(o.vars.time-o.target.time())/o.target._timeScale),i.onStart&&i.onStart.apply(i.onStartScope||o,i.onStartParams||n)},o},o.tweenFromTo=function(t,e,i){i=i||{},t=this._parseTimeOrLabel(t),i.startAt={onComplete:this.seek,onCompleteParams:[t],onCompleteScope:this},i.immediateRender=i.immediateRender!==!1;var s=this.tweenTo(e,i);return s.duration(Math.abs(s.vars.time-t)/this._timeScale||.001)},o.render=function(t,e,i){this._gc&&this._enabled(!0,!1);var s,a,o,h,l,_,u=this._dirty?this.totalDuration():this._totalDuration,p=this._duration,f=this._time,c=this._totalTime,m=this._startTime,d=this._timeScale,g=this._rawPrevTime,v=this._paused,y=this._cycle;if(t>=u?(this._locked||(this._totalTime=u,this._cycle=this._repeat),this._reversed||this._hasPausedChild()||(a=!0,h="onComplete",0===this._duration&&(0===t||0>g||g===r)&&g!==t&&this._first&&(l=!0,g>r&&(h="onReverseComplete"))),this._rawPrevTime=this._duration||!e||t||this._rawPrevTime===t?t:r,this._yoyo&&0!==(1&this._cycle)?this._time=t=0:(this._time=p,t=p+1e-4)):1e-7>t?(this._locked||(this._totalTime=this._cycle=0),this._time=0,(0!==f||0===p&&g!==r&&(g>0||0>t&&g>=0)&&!this._locked)&&(h="onReverseComplete",a=this._reversed),0>t?(this._active=!1,0===p&&g>=0&&this._first&&(l=!0),this._rawPrevTime=t):(this._rawPrevTime=p||!e||t||this._rawPrevTime===t?t:r,t=0,this._initted||(l=!0))):(0===p&&0>g&&(l=!0),this._time=this._rawPrevTime=t,this._locked||(this._totalTime=t,0!==this._repeat&&(_=p+this._repeatDelay,this._cycle=this._totalTime/_>>0,0!==this._cycle&&this._cycle===this._totalTime/_&&this._cycle--,this._time=this._totalTime-this._cycle*_,this._yoyo&&0!==(1&this._cycle)&&(this._time=p-this._time),this._time>p?(this._time=p,t=p+1e-4):0>this._time?this._time=t=0:t=this._time))),this._cycle!==y&&!this._locked){var T=this._yoyo&&0!==(1&y),w=T===(this._yoyo&&0!==(1&this._cycle)),x=this._totalTime,b=this._cycle,P=this._rawPrevTime,S=this._time;if(this._totalTime=y*p,y>this._cycle?T=!T:this._totalTime+=p,this._time=f,this._rawPrevTime=0===p?g-1e-4:g,this._cycle=y,this._locked=!0,f=T?0:p,this.render(f,e,0===p),e||this._gc||this.vars.onRepeat&&this.vars.onRepeat.apply(this.vars.onRepeatScope||this,this.vars.onRepeatParams||n),w&&(f=T?p+1e-4:-1e-4,this.render(f,!0,!1)),this._locked=!1,this._paused&&!v)return;this._time=S,this._totalTime=x,this._cycle=b,this._rawPrevTime=P}if(!(this._time!==f&&this._first||i||l))return c!==this._totalTime&&this._onUpdate&&(e||this._onUpdate.apply(this.vars.onUpdateScope||this,this.vars.onUpdateParams||n)),void 0;if(this._initted||(this._initted=!0),this._active||!this._paused&&this._totalTime!==c&&t>0&&(this._active=!0),0===c&&this.vars.onStart&&0!==this._totalTime&&(e||this.vars.onStart.apply(this.vars.onStartScope||this,this.vars.onStartParams||n)),this._time>=f)for(s=this._first;s&&(o=s._next,!this._paused||v);)(s._active||s._startTime<=this._time&&!s._paused&&!s._gc)&&(s._reversed?s.render((s._dirty?s.totalDuration():s._totalDuration)-(t-s._startTime)*s._timeScale,e,i):s.render((t-s._startTime)*s._timeScale,e,i)),s=o;else for(s=this._last;s&&(o=s._prev,!this._paused||v);)(s._active||f>=s._startTime&&!s._paused&&!s._gc)&&(s._reversed?s.render((s._dirty?s.totalDuration():s._totalDuration)-(t-s._startTime)*s._timeScale,e,i):s.render((t-s._startTime)*s._timeScale,e,i)),s=o;this._onUpdate&&(e||this._onUpdate.apply(this.vars.onUpdateScope||this,this.vars.onUpdateParams||n)),h&&(this._locked||this._gc||(m===this._startTime||d!==this._timeScale)&&(0===this._time||u>=this.totalDuration())&&(a&&(this._timeline.autoRemoveChildren&&this._enabled(!1,!1),this._active=!1),!e&&this.vars[h]&&this.vars[h].apply(this.vars[h+"Scope"]||this,this.vars[h+"Params"]||n)))},o.getActive=function(t,e,i){null==t&&(t=!0),null==e&&(e=!0),null==i&&(i=!1);var s,r,n=[],a=this.getChildren(t,e,i),o=0,h=a.length;for(s=0;h>s;s++)r=a[s],r.isActive()&&(n[o++]=r);return n},o.getLabelAfter=function(t){t||0!==t&&(t=this._time);var e,i=this.getLabelsArray(),s=i.length;for(e=0;s>e;e++)if(i[e].time>t)return i[e].name;return null},o.getLabelBefore=function(t){null==t&&(t=this._time);for(var e=this.getLabelsArray(),i=e.length;--i>-1;)if(t>e[i].time)return e[i].name;return null},o.getLabelsArray=function(){var t,e=[],i=0;for(t in this._labels)e[i++]={time:this._labels[t],name:t};return e.sort(function(t,e){return t.time-e.time}),e},o.progress=function(t){return arguments.length?this.totalTime(this.duration()*(this._yoyo&&0!==(1&this._cycle)?1-t:t)+this._cycle*(this._duration+this._repeatDelay),!1):this._time/this.duration()},o.totalProgress=function(t){return arguments.length?this.totalTime(this.totalDuration()*t,!1):this._totalTime/this.totalDuration()},o.totalDuration=function(e){return arguments.length?-1===this._repeat?this:this.duration((e-this._repeat*this._repeatDelay)/(this._repeat+1)):(this._dirty&&(t.prototype.totalDuration.call(this),this._totalDuration=-1===this._repeat?999999999999:this._duration*(this._repeat+1)+this._repeatDelay*this._repeat),this._totalDuration)},o.time=function(t,e){return arguments.length?(this._dirty&&this.totalDuration(),t>this._duration&&(t=this._duration),this._yoyo&&0!==(1&this._cycle)?t=this._duration-t+this._cycle*(this._duration+this._repeatDelay):0!==this._repeat&&(t+=this._cycle*(this._duration+this._repeatDelay)),this.totalTime(t,e)):this._time},o.repeat=function(t){return arguments.length?(this._repeat=t,this._uncache(!0)):this._repeat},o.repeatDelay=function(t){return arguments.length?(this._repeatDelay=t,this._uncache(!0)):this._repeatDelay},o.yoyo=function(t){return arguments.length?(this._yoyo=t,this):this._yoyo},o.currentLabel=function(t){return arguments.length?this.seek(t,!0):this.getLabelBefore(this._time+1e-8)},s},!0),function(){var t=180/Math.PI,e=[],i=[],s=[],r={},n=function(t,e,i,s){this.a=t,this.b=e,this.c=i,this.d=s,this.da=s-t,this.ca=i-t,this.ba=e-t},a=",x,y,z,left,top,right,bottom,marginTop,marginLeft,marginRight,marginBottom,paddingLeft,paddingTop,paddingRight,paddingBottom,backgroundPosition,backgroundPosition_y,",o=function(t,e,i,s){var r={a:t},n={},a={},o={c:s},h=(t+e)/2,l=(e+i)/2,_=(i+s)/2,u=(h+l)/2,p=(l+_)/2,f=(p-u)/8;return r.b=h+(t-h)/4,n.b=u+f,r.c=n.a=(r.b+n.b)/2,n.c=a.a=(u+p)/2,a.b=p-f,o.b=_+(s-_)/4,a.c=o.a=(a.b+o.b)/2,[r,n,a,o]},h=function(t,r,n,a,h){var l,_,u,p,f,c,m,d,g,v,y,T,w,x=t.length-1,b=0,P=t[0].a;for(l=0;x>l;l++)f=t[b],_=f.a,u=f.d,p=t[b+1].d,h?(y=e[l],T=i[l],w=.25*(T+y)*r/(a?.5:s[l]||.5),c=u-(u-_)*(a?.5*r:0!==y?w/y:0),m=u+(p-u)*(a?.5*r:0!==T?w/T:0),d=u-(c+((m-c)*(3*y/(y+T)+.5)/4||0))):(c=u-.5*(u-_)*r,m=u+.5*(p-u)*r,d=u-(c+m)/2),c+=d,m+=d,f.c=g=c,f.b=0!==l?P:P=f.a+.6*(f.c-f.a),f.da=u-_,f.ca=g-_,f.ba=P-_,n?(v=o(_,P,g,u),t.splice(b,1,v[0],v[1],v[2],v[3]),b+=4):b++,P=m;f=t[b],f.b=P,f.c=P+.4*(f.d-P),f.da=f.d-f.a,f.ca=f.c-f.a,f.ba=P-f.a,n&&(v=o(f.a,P,f.c,f.d),t.splice(b,1,v[0],v[1],v[2],v[3]))},l=function(t,s,r,a){var o,h,l,_,u,p,f=[];if(a)for(t=[a].concat(t),h=t.length;--h>-1;)"string"==typeof(p=t[h][s])&&"="===p.charAt(1)&&(t[h][s]=a[s]+Number(p.charAt(0)+p.substr(2)));if(o=t.length-2,0>o)return f[0]=new n(t[0][s],0,0,t[-1>o?0:1][s]),f;for(h=0;o>h;h++)l=t[h][s],_=t[h+1][s],f[h]=new n(l,0,0,_),r&&(u=t[h+2][s],e[h]=(e[h]||0)+(_-l)*(_-l),i[h]=(i[h]||0)+(u-_)*(u-_));return f[h]=new n(t[h][s],0,0,t[h+1][s]),f},_=function(t,n,o,_,u,p){var f,c,m,d,g,v,y,T,w={},x=[],b=p||t[0];u="string"==typeof u?","+u+",":a,null==n&&(n=1);for(c in t[0])x.push(c);if(t.length>1){for(T=t[t.length-1],y=!0,f=x.length;--f>-1;)if(c=x[f],Math.abs(b[c]-T[c])>.05){y=!1;break}y&&(t=t.concat(),p&&t.unshift(p),t.push(t[1]),p=t[t.length-3])}for(e.length=i.length=s.length=0,f=x.length;--f>-1;)c=x[f],r[c]=-1!==u.indexOf(","+c+","),w[c]=l(t,c,r[c],p);for(f=e.length;--f>-1;)e[f]=Math.sqrt(e[f]),i[f]=Math.sqrt(i[f]);if(!_){for(f=x.length;--f>-1;)if(r[c])for(m=w[x[f]],v=m.length-1,d=0;v>d;d++)g=m[d+1].da/i[d]+m[d].da/e[d],s[d]=(s[d]||0)+g*g;for(f=s.length;--f>-1;)s[f]=Math.sqrt(s[f])}for(f=x.length,d=o?4:1;--f>-1;)c=x[f],m=w[c],h(m,n,o,_,r[c]),y&&(m.splice(0,d),m.splice(m.length-d,d));return w},u=function(t,e,i){e=e||"soft";var s,r,a,o,h,l,_,u,p,f,c,m={},d="cubic"===e?3:2,g="soft"===e,v=[];if(g&&i&&(t=[i].concat(t)),null==t||d+1>t.length)throw"invalid Bezier data";for(p in t[0])v.push(p);for(l=v.length;--l>-1;){for(p=v[l],m[p]=h=[],f=0,u=t.length,_=0;u>_;_++)s=null==i?t[_][p]:"string"==typeof(c=t[_][p])&&"="===c.charAt(1)?i[p]+Number(c.charAt(0)+c.substr(2)):Number(c),g&&_>1&&u-1>_&&(h[f++]=(s+h[f-2])/2),h[f++]=s;for(u=f-d+1,f=0,_=0;u>_;_+=d)s=h[_],r=h[_+1],a=h[_+2],o=2===d?0:h[_+3],h[f++]=c=3===d?new n(s,r,a,o):new n(s,(2*r+s)/3,(2*r+a)/3,a);h.length=f}return m},p=function(t,e,i){for(var s,r,n,a,o,h,l,_,u,p,f,c=1/i,m=t.length;--m>-1;)for(p=t[m],n=p.a,a=p.d-n,o=p.c-n,h=p.b-n,s=r=0,_=1;i>=_;_++)l=c*_,u=1-l,s=r-(r=(l*l*a+3*u*(l*o+u*h))*l),f=m*i+_-1,e[f]=(e[f]||0)+s*s},f=function(t,e){e=e>>0||6;var i,s,r,n,a=[],o=[],h=0,l=0,_=e-1,u=[],f=[];for(i in t)p(t[i],a,e);for(r=a.length,s=0;r>s;s++)h+=Math.sqrt(a[s]),n=s%e,f[n]=h,n===_&&(l+=h,n=s/e>>0,u[n]=f,o[n]=l,h=0,f=[]);return{length:l,lengths:o,segments:u}},c=window._gsDefine.plugin({propName:"bezier",priority:-1,version:"1.3.2",API:2,global:!0,init:function(t,e,i){this._target=t,e instanceof Array&&(e={values:e}),this._func={},this._round={},this._props=[],this._timeRes=null==e.timeResolution?6:parseInt(e.timeResolution,10);var s,r,n,a,o,h=e.values||[],l={},p=h[0],c=e.autoRotate||i.vars.orientToBezier;this._autoRotate=c?c instanceof Array?c:[["x","y","rotation",c===!0?0:Number(c)||0]]:null;for(s in p)this._props.push(s);for(n=this._props.length;--n>-1;)s=this._props[n],this._overwriteProps.push(s),r=this._func[s]="function"==typeof t[s],l[s]=r?t[s.indexOf("set")||"function"!=typeof t["get"+s.substr(3)]?s:"get"+s.substr(3)]():parseFloat(t[s]),o||l[s]!==h[0][s]&&(o=l);if(this._beziers="cubic"!==e.type&&"quadratic"!==e.type&&"soft"!==e.type?_(h,isNaN(e.curviness)?1:e.curviness,!1,"thruBasic"===e.type,e.correlate,o):u(h,e.type,l),this._segCount=this._beziers[s].length,this._timeRes){var m=f(this._beziers,this._timeRes);this._length=m.length,this._lengths=m.lengths,this._segments=m.segments,this._l1=this._li=this._s1=this._si=0,this._l2=this._lengths[0],this._curSeg=this._segments[0],this._s2=this._curSeg[0],this._prec=1/this._curSeg.length}if(c=this._autoRotate)for(this._initialRotations=[],c[0]instanceof Array||(this._autoRotate=c=[c]),n=c.length;--n>-1;){for(a=0;3>a;a++)s=c[n][a],this._func[s]="function"==typeof t[s]?t[s.indexOf("set")||"function"!=typeof t["get"+s.substr(3)]?s:"get"+s.substr(3)]:!1;s=c[n][2],this._initialRotations[n]=this._func[s]?this._func[s].call(this._target):this._target[s]}return this._startRatio=i.vars.runBackwards?1:0,!0},set:function(e){var i,s,r,n,a,o,h,l,_,u,p=this._segCount,f=this._func,c=this._target,m=e!==this._startRatio;if(this._timeRes){if(_=this._lengths,u=this._curSeg,e*=this._length,r=this._li,e>this._l2&&p-1>r){for(l=p-1;l>r&&e>=(this._l2=_[++r]););this._l1=_[r-1],this._li=r,this._curSeg=u=this._segments[r],this._s2=u[this._s1=this._si=0]}else if(this._l1>e&&r>0){for(;r>0&&(this._l1=_[--r])>=e;);0===r&&this._l1>e?this._l1=0:r++,this._l2=_[r],this._li=r,this._curSeg=u=this._segments[r],this._s1=u[(this._si=u.length-1)-1]||0,this._s2=u[this._si]}if(i=r,e-=this._l1,r=this._si,e>this._s2&&u.length-1>r){for(l=u.length-1;l>r&&e>=(this._s2=u[++r]););this._s1=u[r-1],this._si=r}else if(this._s1>e&&r>0){for(;r>0&&(this._s1=u[--r])>=e;);0===r&&this._s1>e?this._s1=0:r++,this._s2=u[r],this._si=r}o=(r+(e-this._s1)/(this._s2-this._s1))*this._prec}else i=0>e?0:e>=1?p-1:p*e>>0,o=(e-i*(1/p))*p;for(s=1-o,r=this._props.length;--r>-1;)n=this._props[r],a=this._beziers[n][i],h=(o*o*a.da+3*s*(o*a.ca+s*a.ba))*o+a.a,this._round[n]&&(h=Math.round(h)),f[n]?c[n](h):c[n]=h;if(this._autoRotate){var d,g,v,y,T,w,x,b=this._autoRotate;for(r=b.length;--r>-1;)n=b[r][2],w=b[r][3]||0,x=b[r][4]===!0?1:t,a=this._beziers[b[r][0]],d=this._beziers[b[r][1]],a&&d&&(a=a[i],d=d[i],g=a.a+(a.b-a.a)*o,y=a.b+(a.c-a.b)*o,g+=(y-g)*o,y+=(a.c+(a.d-a.c)*o-y)*o,v=d.a+(d.b-d.a)*o,T=d.b+(d.c-d.b)*o,v+=(T-v)*o,T+=(d.c+(d.d-d.c)*o-T)*o,h=m?Math.atan2(T-v,y-g)*x+w:this._initialRotations[r],f[n]?c[n](h):c[n]=h)
}}}),m=c.prototype;c.bezierThrough=_,c.cubicToQuadratic=o,c._autoCSS=!0,c.quadraticToCubic=function(t,e,i){return new n(t,(2*e+t)/3,(2*e+i)/3,i)},c._cssRegister=function(){var t=window._gsDefine.globals.CSSPlugin;if(t){var e=t._internals,i=e._parseToProxy,s=e._setPluginRatio,r=e.CSSPropTween;e._registerComplexSpecialProp("bezier",{parser:function(t,e,n,a,o,h){e instanceof Array&&(e={values:e}),h=new c;var l,_,u,p=e.values,f=p.length-1,m=[],d={};if(0>f)return o;for(l=0;f>=l;l++)u=i(t,p[l],a,o,h,f!==l),m[l]=u.end;for(_ in e)d[_]=e[_];return d.values=m,o=new r(t,"bezier",0,0,u.pt,2),o.data=u,o.plugin=h,o.setRatio=s,0===d.autoRotate&&(d.autoRotate=!0),!d.autoRotate||d.autoRotate instanceof Array||(l=d.autoRotate===!0?0:Number(d.autoRotate),d.autoRotate=null!=u.end.left?[["left","top","rotation",l,!1]]:null!=u.end.x?[["x","y","rotation",l,!1]]:!1),d.autoRotate&&(a._transform||a._enableTransforms(!1),u.autoRotate=a._target._gsTransform),h._onInitTween(u.proxy,d,a._tween),o}})}},m._roundProps=function(t,e){for(var i=this._overwriteProps,s=i.length;--s>-1;)(t[i[s]]||t.bezier||t.bezierThrough)&&(this._round[i[s]]=e)},m._kill=function(t){var e,i,s=this._props;for(e in this._beziers)if(e in t)for(delete this._beziers[e],delete this._func[e],i=s.length;--i>-1;)s[i]===e&&s.splice(i,1);return this._super._kill.call(this,t)}}(),window._gsDefine("plugins.CSSPlugin",["plugins.TweenPlugin","TweenLite"],function(t,e){var i,s,r,n,a=function(){t.call(this,"css"),this._overwriteProps.length=0,this.setRatio=a.prototype.setRatio},o={},h=a.prototype=new t("css");h.constructor=a,a.version="1.12.1",a.API=2,a.defaultTransformPerspective=0,a.defaultSkewType="compensated",h="px",a.suffixMap={top:h,right:h,bottom:h,left:h,width:h,height:h,fontSize:h,padding:h,margin:h,perspective:h,lineHeight:""};var l,_,u,p,f,c,m=/(?:\d|\-\d|\.\d|\-\.\d)+/g,d=/(?:\d|\-\d|\.\d|\-\.\d|\+=\d|\-=\d|\+=.\d|\-=\.\d)+/g,g=/(?:\+=|\-=|\-|\b)[\d\-\.]+[a-zA-Z0-9]*(?:%|\b)/gi,v=/[^\d\-\.]/g,y=/(?:\d|\-|\+|=|#|\.)*/g,T=/opacity *= *([^)]*)/i,w=/opacity:([^;]*)/i,x=/alpha\(opacity *=.+?\)/i,b=/^(rgb|hsl)/,P=/([A-Z])/g,S=/-([a-z])/gi,k=/(^(?:url\(\"|url\())|(?:(\"\))$|\)$)/gi,R=function(t,e){return e.toUpperCase()},A=/(?:Left|Right|Width)/i,C=/(M11|M12|M21|M22)=[\d\-\.e]+/gi,O=/progid\:DXImageTransform\.Microsoft\.Matrix\(.+?\)/i,D=/,(?=[^\)]*(?:\(|$))/gi,M=Math.PI/180,z=180/Math.PI,I={},E=document,L=E.createElement("div"),F=E.createElement("img"),N=a._internals={_specialProps:o},X=navigator.userAgent,U=function(){var t,e=X.indexOf("Android"),i=E.createElement("div");return u=-1!==X.indexOf("Safari")&&-1===X.indexOf("Chrome")&&(-1===e||Number(X.substr(e+8,1))>3),f=u&&6>Number(X.substr(X.indexOf("Version/")+8,1)),p=-1!==X.indexOf("Firefox"),/MSIE ([0-9]{1,}[\.0-9]{0,})/.exec(X)&&(c=parseFloat(RegExp.$1)),i.innerHTML="<a style='top:1px;opacity:.55;'>a</a>",t=i.getElementsByTagName("a")[0],t?/^0.55/.test(t.style.opacity):!1}(),Y=function(t){return T.test("string"==typeof t?t:(t.currentStyle?t.currentStyle.filter:t.style.filter)||"")?parseFloat(RegExp.$1)/100:1},j=function(t){window.console&&console.log(t)},B="",q="",V=function(t,e){e=e||L;var i,s,r=e.style;if(void 0!==r[t])return t;for(t=t.charAt(0).toUpperCase()+t.substr(1),i=["O","Moz","ms","Ms","Webkit"],s=5;--s>-1&&void 0===r[i[s]+t];);return s>=0?(q=3===s?"ms":i[s],B="-"+q.toLowerCase()+"-",q+t):null},W=E.defaultView?E.defaultView.getComputedStyle:function(){},G=a.getStyle=function(t,e,i,s,r){var n;return U||"opacity"!==e?(!s&&t.style[e]?n=t.style[e]:(i=i||W(t))?n=i[e]||i.getPropertyValue(e)||i.getPropertyValue(e.replace(P,"-$1").toLowerCase()):t.currentStyle&&(n=t.currentStyle[e]),null==r||n&&"none"!==n&&"auto"!==n&&"auto auto"!==n?n:r):Y(t)},$=N.convertToPixels=function(t,i,s,r,n){if("px"===r||!r)return s;if("auto"===r||!s)return 0;var o,h,l,_=A.test(i),u=t,p=L.style,f=0>s;if(f&&(s=-s),"%"===r&&-1!==i.indexOf("border"))o=s/100*(_?t.clientWidth:t.clientHeight);else{if(p.cssText="border:0 solid red;position:"+G(t,"position")+";line-height:0;","%"!==r&&u.appendChild)p[_?"borderLeftWidth":"borderTopWidth"]=s+r;else{if(u=t.parentNode||E.body,h=u._gsCache,l=e.ticker.frame,h&&_&&h.time===l)return h.width*s/100;p[_?"width":"height"]=s+r}u.appendChild(L),o=parseFloat(L[_?"offsetWidth":"offsetHeight"]),u.removeChild(L),_&&"%"===r&&a.cacheWidths!==!1&&(h=u._gsCache=u._gsCache||{},h.time=l,h.width=100*(o/s)),0!==o||n||(o=$(t,i,s,r,!0))}return f?-o:o},Z=N.calculateOffset=function(t,e,i){if("absolute"!==G(t,"position",i))return 0;var s="left"===e?"Left":"Top",r=G(t,"margin"+s,i);return t["offset"+s]-($(t,e,parseFloat(r),r.replace(y,""))||0)},Q=function(t,e){var i,s,r={};if(e=e||W(t,null))if(i=e.length)for(;--i>-1;)r[e[i].replace(S,R)]=e.getPropertyValue(e[i]);else for(i in e)r[i]=e[i];else if(e=t.currentStyle||t.style)for(i in e)"string"==typeof i&&void 0===r[i]&&(r[i.replace(S,R)]=e[i]);return U||(r.opacity=Y(t)),s=Pe(t,e,!1),r.rotation=s.rotation,r.skewX=s.skewX,r.scaleX=s.scaleX,r.scaleY=s.scaleY,r.x=s.x,r.y=s.y,xe&&(r.z=s.z,r.rotationX=s.rotationX,r.rotationY=s.rotationY,r.scaleZ=s.scaleZ),r.filters&&delete r.filters,r},H=function(t,e,i,s,r){var n,a,o,h={},l=t.style;for(a in i)"cssText"!==a&&"length"!==a&&isNaN(a)&&(e[a]!==(n=i[a])||r&&r[a])&&-1===a.indexOf("Origin")&&("number"==typeof n||"string"==typeof n)&&(h[a]="auto"!==n||"left"!==a&&"top"!==a?""!==n&&"auto"!==n&&"none"!==n||"string"!=typeof e[a]||""===e[a].replace(v,"")?n:0:Z(t,a),void 0!==l[a]&&(o=new ue(l,a,l[a],o)));if(s)for(a in s)"className"!==a&&(h[a]=s[a]);return{difs:h,firstMPT:o}},K={width:["Left","Right"],height:["Top","Bottom"]},J=["marginLeft","marginRight","marginTop","marginBottom"],te=function(t,e,i){var s=parseFloat("width"===e?t.offsetWidth:t.offsetHeight),r=K[e],n=r.length;for(i=i||W(t,null);--n>-1;)s-=parseFloat(G(t,"padding"+r[n],i,!0))||0,s-=parseFloat(G(t,"border"+r[n]+"Width",i,!0))||0;return s},ee=function(t,e){(null==t||""===t||"auto"===t||"auto auto"===t)&&(t="0 0");var i=t.split(" "),s=-1!==t.indexOf("left")?"0%":-1!==t.indexOf("right")?"100%":i[0],r=-1!==t.indexOf("top")?"0%":-1!==t.indexOf("bottom")?"100%":i[1];return null==r?r="0":"center"===r&&(r="50%"),("center"===s||isNaN(parseFloat(s))&&-1===(s+"").indexOf("="))&&(s="50%"),e&&(e.oxp=-1!==s.indexOf("%"),e.oyp=-1!==r.indexOf("%"),e.oxr="="===s.charAt(1),e.oyr="="===r.charAt(1),e.ox=parseFloat(s.replace(v,"")),e.oy=parseFloat(r.replace(v,""))),s+" "+r+(i.length>2?" "+i[2]:"")},ie=function(t,e){return"string"==typeof t&&"="===t.charAt(1)?parseInt(t.charAt(0)+"1",10)*parseFloat(t.substr(2)):parseFloat(t)-parseFloat(e)},se=function(t,e){return null==t?e:"string"==typeof t&&"="===t.charAt(1)?parseInt(t.charAt(0)+"1",10)*Number(t.substr(2))+e:parseFloat(t)},re=function(t,e,i,s){var r,n,a,o,h=1e-6;return null==t?o=e:"number"==typeof t?o=t:(r=360,n=t.split("_"),a=Number(n[0].replace(v,""))*(-1===t.indexOf("rad")?1:z)-("="===t.charAt(1)?0:e),n.length&&(s&&(s[i]=e+a),-1!==t.indexOf("short")&&(a%=r,a!==a%(r/2)&&(a=0>a?a+r:a-r)),-1!==t.indexOf("_cw")&&0>a?a=(a+9999999999*r)%r-(0|a/r)*r:-1!==t.indexOf("ccw")&&a>0&&(a=(a-9999999999*r)%r-(0|a/r)*r)),o=e+a),h>o&&o>-h&&(o=0),o},ne={aqua:[0,255,255],lime:[0,255,0],silver:[192,192,192],black:[0,0,0],maroon:[128,0,0],teal:[0,128,128],blue:[0,0,255],navy:[0,0,128],white:[255,255,255],fuchsia:[255,0,255],olive:[128,128,0],yellow:[255,255,0],orange:[255,165,0],gray:[128,128,128],purple:[128,0,128],green:[0,128,0],red:[255,0,0],pink:[255,192,203],cyan:[0,255,255],transparent:[255,255,255,0]},ae=function(t,e,i){return t=0>t?t+1:t>1?t-1:t,0|255*(1>6*t?e+6*(i-e)*t:.5>t?i:2>3*t?e+6*(i-e)*(2/3-t):e)+.5},oe=function(t){var e,i,s,r,n,a;return t&&""!==t?"number"==typeof t?[t>>16,255&t>>8,255&t]:(","===t.charAt(t.length-1)&&(t=t.substr(0,t.length-1)),ne[t]?ne[t]:"#"===t.charAt(0)?(4===t.length&&(e=t.charAt(1),i=t.charAt(2),s=t.charAt(3),t="#"+e+e+i+i+s+s),t=parseInt(t.substr(1),16),[t>>16,255&t>>8,255&t]):"hsl"===t.substr(0,3)?(t=t.match(m),r=Number(t[0])%360/360,n=Number(t[1])/100,a=Number(t[2])/100,i=.5>=a?a*(n+1):a+n-a*n,e=2*a-i,t.length>3&&(t[3]=Number(t[3])),t[0]=ae(r+1/3,e,i),t[1]=ae(r,e,i),t[2]=ae(r-1/3,e,i),t):(t=t.match(m)||ne.transparent,t[0]=Number(t[0]),t[1]=Number(t[1]),t[2]=Number(t[2]),t.length>3&&(t[3]=Number(t[3])),t)):ne.black},he="(?:\\b(?:(?:rgb|rgba|hsl|hsla)\\(.+?\\))|\\B#.+?\\b";for(h in ne)he+="|"+h+"\\b";he=RegExp(he+")","gi");var le=function(t,e,i,s){if(null==t)return function(t){return t};var r,n=e?(t.match(he)||[""])[0]:"",a=t.split(n).join("").match(g)||[],o=t.substr(0,t.indexOf(a[0])),h=")"===t.charAt(t.length-1)?")":"",l=-1!==t.indexOf(" ")?" ":",",_=a.length,u=_>0?a[0].replace(m,""):"";return _?r=e?function(t){var e,p,f,c;if("number"==typeof t)t+=u;else if(s&&D.test(t)){for(c=t.replace(D,"|").split("|"),f=0;c.length>f;f++)c[f]=r(c[f]);return c.join(",")}if(e=(t.match(he)||[n])[0],p=t.split(e).join("").match(g)||[],f=p.length,_>f--)for(;_>++f;)p[f]=i?p[0|(f-1)/2]:a[f];return o+p.join(l)+l+e+h+(-1!==t.indexOf("inset")?" inset":"")}:function(t){var e,n,p;if("number"==typeof t)t+=u;else if(s&&D.test(t)){for(n=t.replace(D,"|").split("|"),p=0;n.length>p;p++)n[p]=r(n[p]);return n.join(",")}if(e=t.match(g)||[],p=e.length,_>p--)for(;_>++p;)e[p]=i?e[0|(p-1)/2]:a[p];return o+e.join(l)+h}:function(t){return t}},_e=function(t){return t=t.split(","),function(e,i,s,r,n,a,o){var h,l=(i+"").split(" ");for(o={},h=0;4>h;h++)o[t[h]]=l[h]=l[h]||l[(h-1)/2>>0];return r.parse(e,o,n,a)}},ue=(N._setPluginRatio=function(t){this.plugin.setRatio(t);for(var e,i,s,r,n=this.data,a=n.proxy,o=n.firstMPT,h=1e-6;o;)e=a[o.v],o.r?e=Math.round(e):h>e&&e>-h&&(e=0),o.t[o.p]=e,o=o._next;if(n.autoRotate&&(n.autoRotate.rotation=a.rotation),1===t)for(o=n.firstMPT;o;){if(i=o.t,i.type){if(1===i.type){for(r=i.xs0+i.s+i.xs1,s=1;i.l>s;s++)r+=i["xn"+s]+i["xs"+(s+1)];i.e=r}}else i.e=i.s+i.xs0;o=o._next}},function(t,e,i,s,r){this.t=t,this.p=e,this.v=i,this.r=r,s&&(s._prev=this,this._next=s)}),pe=(N._parseToProxy=function(t,e,i,s,r,n){var a,o,h,l,_,u=s,p={},f={},c=i._transform,m=I;for(i._transform=null,I=e,s=_=i.parse(t,e,s,r),I=m,n&&(i._transform=c,u&&(u._prev=null,u._prev&&(u._prev._next=null)));s&&s!==u;){if(1>=s.type&&(o=s.p,f[o]=s.s+s.c,p[o]=s.s,n||(l=new ue(s,"s",o,l,s.r),s.c=0),1===s.type))for(a=s.l;--a>0;)h="xn"+a,o=s.p+"_"+h,f[o]=s.data[h],p[o]=s[h],n||(l=new ue(s,h,o,l,s.rxp[h]));s=s._next}return{proxy:p,end:f,firstMPT:l,pt:_}},N.CSSPropTween=function(t,e,s,r,a,o,h,l,_,u,p){this.t=t,this.p=e,this.s=s,this.c=r,this.n=h||e,t instanceof pe||n.push(this.n),this.r=l,this.type=o||0,_&&(this.pr=_,i=!0),this.b=void 0===u?s:u,this.e=void 0===p?s+r:p,a&&(this._next=a,a._prev=this)}),fe=a.parseComplex=function(t,e,i,s,r,n,a,o,h,_){i=i||n||"",a=new pe(t,e,0,0,a,_?2:1,null,!1,o,i,s),s+="";var u,p,f,c,g,v,y,T,w,x,P,S,k=i.split(", ").join(",").split(" "),R=s.split(", ").join(",").split(" "),A=k.length,C=l!==!1;for((-1!==s.indexOf(",")||-1!==i.indexOf(","))&&(k=k.join(" ").replace(D,", ").split(" "),R=R.join(" ").replace(D,", ").split(" "),A=k.length),A!==R.length&&(k=(n||"").split(" "),A=k.length),a.plugin=h,a.setRatio=_,u=0;A>u;u++)if(c=k[u],g=R[u],T=parseFloat(c),T||0===T)a.appendXtra("",T,ie(g,T),g.replace(d,""),C&&-1!==g.indexOf("px"),!0);else if(r&&("#"===c.charAt(0)||ne[c]||b.test(c)))S=","===g.charAt(g.length-1)?"),":")",c=oe(c),g=oe(g),w=c.length+g.length>6,w&&!U&&0===g[3]?(a["xs"+a.l]+=a.l?" transparent":"transparent",a.e=a.e.split(R[u]).join("transparent")):(U||(w=!1),a.appendXtra(w?"rgba(":"rgb(",c[0],g[0]-c[0],",",!0,!0).appendXtra("",c[1],g[1]-c[1],",",!0).appendXtra("",c[2],g[2]-c[2],w?",":S,!0),w&&(c=4>c.length?1:c[3],a.appendXtra("",c,(4>g.length?1:g[3])-c,S,!1)));else if(v=c.match(m)){if(y=g.match(d),!y||y.length!==v.length)return a;for(f=0,p=0;v.length>p;p++)P=v[p],x=c.indexOf(P,f),a.appendXtra(c.substr(f,x-f),Number(P),ie(y[p],P),"",C&&"px"===c.substr(x+P.length,2),0===p),f=x+P.length;a["xs"+a.l]+=c.substr(f)}else a["xs"+a.l]+=a.l?" "+c:c;if(-1!==s.indexOf("=")&&a.data){for(S=a.xs0+a.data.s,u=1;a.l>u;u++)S+=a["xs"+u]+a.data["xn"+u];a.e=S+a["xs"+u]}return a.l||(a.type=-1,a.xs0=a.e),a.xfirst||a},ce=9;for(h=pe.prototype,h.l=h.pr=0;--ce>0;)h["xn"+ce]=0,h["xs"+ce]="";h.xs0="",h._next=h._prev=h.xfirst=h.data=h.plugin=h.setRatio=h.rxp=null,h.appendXtra=function(t,e,i,s,r,n){var a=this,o=a.l;return a["xs"+o]+=n&&o?" "+t:t||"",i||0===o||a.plugin?(a.l++,a.type=a.setRatio?2:1,a["xs"+a.l]=s||"",o>0?(a.data["xn"+o]=e+i,a.rxp["xn"+o]=r,a["xn"+o]=e,a.plugin||(a.xfirst=new pe(a,"xn"+o,e,i,a.xfirst||a,0,a.n,r,a.pr),a.xfirst.xs0=0),a):(a.data={s:e+i},a.rxp={},a.s=e,a.c=i,a.r=r,a)):(a["xs"+o]+=e+(s||""),a)};var me=function(t,e){e=e||{},this.p=e.prefix?V(t)||t:t,o[t]=o[this.p]=this,this.format=e.formatter||le(e.defaultValue,e.color,e.collapsible,e.multi),e.parser&&(this.parse=e.parser),this.clrs=e.color,this.multi=e.multi,this.keyword=e.keyword,this.dflt=e.defaultValue,this.pr=e.priority||0},de=N._registerComplexSpecialProp=function(t,e,i){"object"!=typeof e&&(e={parser:i});var s,r,n=t.split(","),a=e.defaultValue;for(i=i||[a],s=0;n.length>s;s++)e.prefix=0===s&&e.prefix,e.defaultValue=i[s]||a,r=new me(n[s],e)},ge=function(t){if(!o[t]){var e=t.charAt(0).toUpperCase()+t.substr(1)+"Plugin";de(t,{parser:function(t,i,s,r,n,a,h){var l=(window.GreenSockGlobals||window).com.greensock.plugins[e];return l?(l._cssRegister(),o[s].parse(t,i,s,r,n,a,h)):(j("Error: "+e+" js file not loaded."),n)}})}};h=me.prototype,h.parseComplex=function(t,e,i,s,r,n){var a,o,h,l,_,u,p=this.keyword;if(this.multi&&(D.test(i)||D.test(e)?(o=e.replace(D,"|").split("|"),h=i.replace(D,"|").split("|")):p&&(o=[e],h=[i])),h){for(l=h.length>o.length?h.length:o.length,a=0;l>a;a++)e=o[a]=o[a]||this.dflt,i=h[a]=h[a]||this.dflt,p&&(_=e.indexOf(p),u=i.indexOf(p),_!==u&&(i=-1===u?h:o,i[a]+=" "+p));e=o.join(", "),i=h.join(", ")}return fe(t,this.p,e,i,this.clrs,this.dflt,s,this.pr,r,n)},h.parse=function(t,e,i,s,n,a){return this.parseComplex(t.style,this.format(G(t,this.p,r,!1,this.dflt)),this.format(e),n,a)},a.registerSpecialProp=function(t,e,i){de(t,{parser:function(t,s,r,n,a,o){var h=new pe(t,r,0,0,a,2,r,!1,i);return h.plugin=o,h.setRatio=e(t,s,n._tween,r),h},priority:i})};var ve="scaleX,scaleY,scaleZ,x,y,z,skewX,skewY,rotation,rotationX,rotationY,perspective".split(","),ye=V("transform"),Te=B+"transform",we=V("transformOrigin"),xe=null!==V("perspective"),be=N.Transform=function(){this.skewY=0},Pe=N.getTransform=function(t,e,i,s){if(t._gsTransform&&i&&!s)return t._gsTransform;var r,n,o,h,l,_,u,p,f,c,m,d,g,v=i?t._gsTransform||new be:new be,y=0>v.scaleX,T=2e-5,w=1e5,x=179.99,b=x*M,P=xe?parseFloat(G(t,we,e,!1,"0 0 0").split(" ")[2])||v.zOrigin||0:0;for(ye?r=G(t,Te,e,!0):t.currentStyle&&(r=t.currentStyle.filter.match(C),r=r&&4===r.length?[r[0].substr(4),Number(r[2].substr(4)),Number(r[1].substr(4)),r[3].substr(4),v.x||0,v.y||0].join(","):""),n=(r||"").match(/(?:\-|\b)[\d\-\.e]+\b/gi)||[],o=n.length;--o>-1;)h=Number(n[o]),n[o]=(l=h-(h|=0))?(0|l*w+(0>l?-.5:.5))/w+h:h;if(16===n.length){var S=n[8],k=n[9],R=n[10],A=n[12],O=n[13],D=n[14];if(v.zOrigin&&(D=-v.zOrigin,A=S*D-n[12],O=k*D-n[13],D=R*D+v.zOrigin-n[14]),!i||s||null==v.rotationX){var I,E,L,F,N,X,U,Y=n[0],j=n[1],B=n[2],q=n[3],V=n[4],W=n[5],$=n[6],Z=n[7],Q=n[11],H=Math.atan2($,R),K=-b>H||H>b;v.rotationX=H*z,H&&(F=Math.cos(-H),N=Math.sin(-H),I=V*F+S*N,E=W*F+k*N,L=$*F+R*N,S=V*-N+S*F,k=W*-N+k*F,R=$*-N+R*F,Q=Z*-N+Q*F,V=I,W=E,$=L),H=Math.atan2(S,Y),v.rotationY=H*z,H&&(X=-b>H||H>b,F=Math.cos(-H),N=Math.sin(-H),I=Y*F-S*N,E=j*F-k*N,L=B*F-R*N,k=j*N+k*F,R=B*N+R*F,Q=q*N+Q*F,Y=I,j=E,B=L),H=Math.atan2(j,W),v.rotation=H*z,H&&(U=-b>H||H>b,F=Math.cos(-H),N=Math.sin(-H),Y=Y*F+V*N,E=j*F+W*N,W=j*-N+W*F,$=B*-N+$*F,j=E),U&&K?v.rotation=v.rotationX=0:U&&X?v.rotation=v.rotationY=0:X&&K&&(v.rotationY=v.rotationX=0),v.scaleX=(0|Math.sqrt(Y*Y+j*j)*w+.5)/w,v.scaleY=(0|Math.sqrt(W*W+k*k)*w+.5)/w,v.scaleZ=(0|Math.sqrt($*$+R*R)*w+.5)/w,v.skewX=0,v.perspective=Q?1/(0>Q?-Q:Q):0,v.x=A,v.y=O,v.z=D}}else if(!(xe&&!s&&n.length&&v.x===n[4]&&v.y===n[5]&&(v.rotationX||v.rotationY)||void 0!==v.x&&"none"===G(t,"display",e))){var J=n.length>=6,te=J?n[0]:1,ee=n[1]||0,ie=n[2]||0,se=J?n[3]:1;v.x=n[4]||0,v.y=n[5]||0,_=Math.sqrt(te*te+ee*ee),u=Math.sqrt(se*se+ie*ie),p=te||ee?Math.atan2(ee,te)*z:v.rotation||0,f=ie||se?Math.atan2(ie,se)*z+p:v.skewX||0,c=_-Math.abs(v.scaleX||0),m=u-Math.abs(v.scaleY||0),Math.abs(f)>90&&270>Math.abs(f)&&(y?(_*=-1,f+=0>=p?180:-180,p+=0>=p?180:-180):(u*=-1,f+=0>=f?180:-180)),d=(p-v.rotation)%180,g=(f-v.skewX)%180,(void 0===v.skewX||c>T||-T>c||m>T||-T>m||d>-x&&x>d&&false|d*w||g>-x&&x>g&&false|g*w)&&(v.scaleX=_,v.scaleY=u,v.rotation=p,v.skewX=f),xe&&(v.rotationX=v.rotationY=v.z=0,v.perspective=parseFloat(a.defaultTransformPerspective)||0,v.scaleZ=1)}v.zOrigin=P;for(o in v)T>v[o]&&v[o]>-T&&(v[o]=0);return i&&(t._gsTransform=v),v},Se=function(t){var e,i,s=this.data,r=-s.rotation*M,n=r+s.skewX*M,a=1e5,o=(0|Math.cos(r)*s.scaleX*a)/a,h=(0|Math.sin(r)*s.scaleX*a)/a,l=(0|Math.sin(n)*-s.scaleY*a)/a,_=(0|Math.cos(n)*s.scaleY*a)/a,u=this.t.style,p=this.t.currentStyle;if(p){i=h,h=-l,l=-i,e=p.filter,u.filter="";var f,m,d=this.t.offsetWidth,g=this.t.offsetHeight,v="absolute"!==p.position,w="progid:DXImageTransform.Microsoft.Matrix(M11="+o+", M12="+h+", M21="+l+", M22="+_,x=s.x,b=s.y;if(null!=s.ox&&(f=(s.oxp?.01*d*s.ox:s.ox)-d/2,m=(s.oyp?.01*g*s.oy:s.oy)-g/2,x+=f-(f*o+m*h),b+=m-(f*l+m*_)),v?(f=d/2,m=g/2,w+=", Dx="+(f-(f*o+m*h)+x)+", Dy="+(m-(f*l+m*_)+b)+")"):w+=", sizingMethod='auto expand')",u.filter=-1!==e.indexOf("DXImageTransform.Microsoft.Matrix(")?e.replace(O,w):w+" "+e,(0===t||1===t)&&1===o&&0===h&&0===l&&1===_&&(v&&-1===w.indexOf("Dx=0, Dy=0")||T.test(e)&&100!==parseFloat(RegExp.$1)||-1===e.indexOf("gradient("&&e.indexOf("Alpha"))&&u.removeAttribute("filter")),!v){var P,S,k,R=8>c?1:-1;for(f=s.ieOffsetX||0,m=s.ieOffsetY||0,s.ieOffsetX=Math.round((d-((0>o?-o:o)*d+(0>h?-h:h)*g))/2+x),s.ieOffsetY=Math.round((g-((0>_?-_:_)*g+(0>l?-l:l)*d))/2+b),ce=0;4>ce;ce++)S=J[ce],P=p[S],i=-1!==P.indexOf("px")?parseFloat(P):$(this.t,S,parseFloat(P),P.replace(y,""))||0,k=i!==s[S]?2>ce?-s.ieOffsetX:-s.ieOffsetY:2>ce?f-s.ieOffsetX:m-s.ieOffsetY,u[S]=(s[S]=Math.round(i-k*(0===ce||2===ce?1:R)))+"px"}}},ke=N.set3DTransformRatio=function(t){var e,i,s,r,n,a,o,h,l,_,u,f,c,m,d,g,v,y,T,w,x,b,P,S=this.data,k=this.t.style,R=S.rotation*M,A=S.scaleX,C=S.scaleY,O=S.scaleZ,D=S.perspective;if(!(1!==t&&0!==t||"auto"!==S.force3D||S.rotationY||S.rotationX||1!==O||D||S.z))return Re.call(this,t),void 0;if(p){var z=1e-4;z>A&&A>-z&&(A=O=2e-5),z>C&&C>-z&&(C=O=2e-5),!D||S.z||S.rotationX||S.rotationY||(D=0)}if(R||S.skewX)y=Math.cos(R),T=Math.sin(R),e=y,n=T,S.skewX&&(R-=S.skewX*M,y=Math.cos(R),T=Math.sin(R),"simple"===S.skewType&&(w=Math.tan(S.skewX*M),w=Math.sqrt(1+w*w),y*=w,T*=w)),i=-T,a=y;else{if(!(S.rotationY||S.rotationX||1!==O||D))return k[ye]="translate3d("+S.x+"px,"+S.y+"px,"+S.z+"px)"+(1!==A||1!==C?" scale("+A+","+C+")":""),void 0;e=a=1,i=n=0}u=1,s=r=o=h=l=_=f=c=m=0,d=D?-1/D:0,g=S.zOrigin,v=1e5,R=S.rotationY*M,R&&(y=Math.cos(R),T=Math.sin(R),l=u*-T,c=d*-T,s=e*T,o=n*T,u*=y,d*=y,e*=y,n*=y),R=S.rotationX*M,R&&(y=Math.cos(R),T=Math.sin(R),w=i*y+s*T,x=a*y+o*T,b=_*y+u*T,P=m*y+d*T,s=i*-T+s*y,o=a*-T+o*y,u=_*-T+u*y,d=m*-T+d*y,i=w,a=x,_=b,m=P),1!==O&&(s*=O,o*=O,u*=O,d*=O),1!==C&&(i*=C,a*=C,_*=C,m*=C),1!==A&&(e*=A,n*=A,l*=A,c*=A),g&&(f-=g,r=s*f,h=o*f,f=u*f+g),r=(w=(r+=S.x)-(r|=0))?(0|w*v+(0>w?-.5:.5))/v+r:r,h=(w=(h+=S.y)-(h|=0))?(0|w*v+(0>w?-.5:.5))/v+h:h,f=(w=(f+=S.z)-(f|=0))?(0|w*v+(0>w?-.5:.5))/v+f:f,k[ye]="matrix3d("+[(0|e*v)/v,(0|n*v)/v,(0|l*v)/v,(0|c*v)/v,(0|i*v)/v,(0|a*v)/v,(0|_*v)/v,(0|m*v)/v,(0|s*v)/v,(0|o*v)/v,(0|u*v)/v,(0|d*v)/v,r,h,f,D?1+-f/D:1].join(",")+")"},Re=N.set2DTransformRatio=function(t){var e,i,s,r,n,a=this.data,o=this.t,h=o.style;return a.rotationX||a.rotationY||a.z||a.force3D===!0||"auto"===a.force3D&&1!==t&&0!==t?(this.setRatio=ke,ke.call(this,t),void 0):(a.rotation||a.skewX?(e=a.rotation*M,i=e-a.skewX*M,s=1e5,r=a.scaleX*s,n=a.scaleY*s,h[ye]="matrix("+(0|Math.cos(e)*r)/s+","+(0|Math.sin(e)*r)/s+","+(0|Math.sin(i)*-n)/s+","+(0|Math.cos(i)*n)/s+","+a.x+","+a.y+")"):h[ye]="matrix("+a.scaleX+",0,0,"+a.scaleY+","+a.x+","+a.y+")",void 0)};de("transform,scale,scaleX,scaleY,scaleZ,x,y,z,rotation,rotationX,rotationY,rotationZ,skewX,skewY,shortRotation,shortRotationX,shortRotationY,shortRotationZ,transformOrigin,transformPerspective,directionalRotation,parseTransform,force3D,skewType",{parser:function(t,e,i,s,n,o,h){if(s._transform)return n;var l,_,u,p,f,c,m,d=s._transform=Pe(t,r,!0,h.parseTransform),g=t.style,v=1e-6,y=ve.length,T=h,w={};if("string"==typeof T.transform&&ye)u=L.style,u[ye]=T.transform,u.display="block",u.position="absolute",E.body.appendChild(L),l=Pe(L,null,!1),E.body.removeChild(L);else if("object"==typeof T){if(l={scaleX:se(null!=T.scaleX?T.scaleX:T.scale,d.scaleX),scaleY:se(null!=T.scaleY?T.scaleY:T.scale,d.scaleY),scaleZ:se(T.scaleZ,d.scaleZ),x:se(T.x,d.x),y:se(T.y,d.y),z:se(T.z,d.z),perspective:se(T.transformPerspective,d.perspective)},m=T.directionalRotation,null!=m)if("object"==typeof m)for(u in m)T[u]=m[u];else T.rotation=m;l.rotation=re("rotation"in T?T.rotation:"shortRotation"in T?T.shortRotation+"_short":"rotationZ"in T?T.rotationZ:d.rotation,d.rotation,"rotation",w),xe&&(l.rotationX=re("rotationX"in T?T.rotationX:"shortRotationX"in T?T.shortRotationX+"_short":d.rotationX||0,d.rotationX,"rotationX",w),l.rotationY=re("rotationY"in T?T.rotationY:"shortRotationY"in T?T.shortRotationY+"_short":d.rotationY||0,d.rotationY,"rotationY",w)),l.skewX=null==T.skewX?d.skewX:re(T.skewX,d.skewX),l.skewY=null==T.skewY?d.skewY:re(T.skewY,d.skewY),(_=l.skewY-d.skewY)&&(l.skewX+=_,l.rotation+=_)}for(xe&&null!=T.force3D&&(d.force3D=T.force3D,c=!0),d.skewType=T.skewType||d.skewType||a.defaultSkewType,f=d.force3D||d.z||d.rotationX||d.rotationY||l.z||l.rotationX||l.rotationY||l.perspective,f||null==T.scale||(l.scaleZ=1);--y>-1;)i=ve[y],p=l[i]-d[i],(p>v||-v>p||null!=I[i])&&(c=!0,n=new pe(d,i,d[i],p,n),i in w&&(n.e=w[i]),n.xs0=0,n.plugin=o,s._overwriteProps.push(n.n));return p=T.transformOrigin,(p||xe&&f&&d.zOrigin)&&(ye?(c=!0,i=we,p=(p||G(t,i,r,!1,"50% 50%"))+"",n=new pe(g,i,0,0,n,-1,"transformOrigin"),n.b=g[i],n.plugin=o,xe?(u=d.zOrigin,p=p.split(" "),d.zOrigin=(p.length>2&&(0===u||"0px"!==p[2])?parseFloat(p[2]):u)||0,n.xs0=n.e=p[0]+" "+(p[1]||"50%")+" 0px",n=new pe(d,"zOrigin",0,0,n,-1,n.n),n.b=u,n.xs0=n.e=d.zOrigin):n.xs0=n.e=p):ee(p+"",d)),c&&(s._transformType=f||3===this._transformType?3:2),n},prefix:!0}),de("boxShadow",{defaultValue:"0px 0px 0px 0px #999",prefix:!0,color:!0,multi:!0,keyword:"inset"}),de("borderRadius",{defaultValue:"0px",parser:function(t,e,i,n,a){e=this.format(e);var o,h,l,_,u,p,f,c,m,d,g,v,y,T,w,x,b=["borderTopLeftRadius","borderTopRightRadius","borderBottomRightRadius","borderBottomLeftRadius"],P=t.style;for(m=parseFloat(t.offsetWidth),d=parseFloat(t.offsetHeight),o=e.split(" "),h=0;b.length>h;h++)this.p.indexOf("border")&&(b[h]=V(b[h])),u=_=G(t,b[h],r,!1,"0px"),-1!==u.indexOf(" ")&&(_=u.split(" "),u=_[0],_=_[1]),p=l=o[h],f=parseFloat(u),v=u.substr((f+"").length),y="="===p.charAt(1),y?(c=parseInt(p.charAt(0)+"1",10),p=p.substr(2),c*=parseFloat(p),g=p.substr((c+"").length-(0>c?1:0))||""):(c=parseFloat(p),g=p.substr((c+"").length)),""===g&&(g=s[i]||v),g!==v&&(T=$(t,"borderLeft",f,v),w=$(t,"borderTop",f,v),"%"===g?(u=100*(T/m)+"%",_=100*(w/d)+"%"):"em"===g?(x=$(t,"borderLeft",1,"em"),u=T/x+"em",_=w/x+"em"):(u=T+"px",_=w+"px"),y&&(p=parseFloat(u)+c+g,l=parseFloat(_)+c+g)),a=fe(P,b[h],u+" "+_,p+" "+l,!1,"0px",a);return a},prefix:!0,formatter:le("0px 0px 0px 0px",!1,!0)}),de("backgroundPosition",{defaultValue:"0 0",parser:function(t,e,i,s,n,a){var o,h,l,_,u,p,f="background-position",m=r||W(t,null),d=this.format((m?c?m.getPropertyValue(f+"-x")+" "+m.getPropertyValue(f+"-y"):m.getPropertyValue(f):t.currentStyle.backgroundPositionX+" "+t.currentStyle.backgroundPositionY)||"0 0"),g=this.format(e);if(-1!==d.indexOf("%")!=(-1!==g.indexOf("%"))&&(p=G(t,"backgroundImage").replace(k,""),p&&"none"!==p)){for(o=d.split(" "),h=g.split(" "),F.setAttribute("src",p),l=2;--l>-1;)d=o[l],_=-1!==d.indexOf("%"),_!==(-1!==h[l].indexOf("%"))&&(u=0===l?t.offsetWidth-F.width:t.offsetHeight-F.height,o[l]=_?parseFloat(d)/100*u+"px":100*(parseFloat(d)/u)+"%");d=o.join(" ")}return this.parseComplex(t.style,d,g,n,a)},formatter:ee}),de("backgroundSize",{defaultValue:"0 0",formatter:ee}),de("perspective",{defaultValue:"0px",prefix:!0}),de("perspectiveOrigin",{defaultValue:"50% 50%",prefix:!0}),de("transformStyle",{prefix:!0}),de("backfaceVisibility",{prefix:!0}),de("userSelect",{prefix:!0}),de("margin",{parser:_e("marginTop,marginRight,marginBottom,marginLeft")}),de("padding",{parser:_e("paddingTop,paddingRight,paddingBottom,paddingLeft")}),de("clip",{defaultValue:"rect(0px,0px,0px,0px)",parser:function(t,e,i,s,n,a){var o,h,l;return 9>c?(h=t.currentStyle,l=8>c?" ":",",o="rect("+h.clipTop+l+h.clipRight+l+h.clipBottom+l+h.clipLeft+")",e=this.format(e).split(",").join(l)):(o=this.format(G(t,this.p,r,!1,this.dflt)),e=this.format(e)),this.parseComplex(t.style,o,e,n,a)}}),de("textShadow",{defaultValue:"0px 0px 0px #999",color:!0,multi:!0}),de("autoRound,strictUnits",{parser:function(t,e,i,s,r){return r}}),de("border",{defaultValue:"0px solid #000",parser:function(t,e,i,s,n,a){return this.parseComplex(t.style,this.format(G(t,"borderTopWidth",r,!1,"0px")+" "+G(t,"borderTopStyle",r,!1,"solid")+" "+G(t,"borderTopColor",r,!1,"#000")),this.format(e),n,a)},color:!0,formatter:function(t){var e=t.split(" ");return e[0]+" "+(e[1]||"solid")+" "+(t.match(he)||["#000"])[0]}}),de("borderWidth",{parser:_e("borderTopWidth,borderRightWidth,borderBottomWidth,borderLeftWidth")}),de("float,cssFloat,styleFloat",{parser:function(t,e,i,s,r){var n=t.style,a="cssFloat"in n?"cssFloat":"styleFloat";return new pe(n,a,0,0,r,-1,i,!1,0,n[a],e)}});var Ae=function(t){var e,i=this.t,s=i.filter||G(this.data,"filter"),r=0|this.s+this.c*t;100===r&&(-1===s.indexOf("atrix(")&&-1===s.indexOf("radient(")&&-1===s.indexOf("oader(")?(i.removeAttribute("filter"),e=!G(this.data,"filter")):(i.filter=s.replace(x,""),e=!0)),e||(this.xn1&&(i.filter=s=s||"alpha(opacity="+r+")"),-1===s.indexOf("pacity")?0===r&&this.xn1||(i.filter=s+" alpha(opacity="+r+")"):i.filter=s.replace(T,"opacity="+r))};de("opacity,alpha,autoAlpha",{defaultValue:"1",parser:function(t,e,i,s,n,a){var o=parseFloat(G(t,"opacity",r,!1,"1")),h=t.style,l="autoAlpha"===i;return"string"==typeof e&&"="===e.charAt(1)&&(e=("-"===e.charAt(0)?-1:1)*parseFloat(e.substr(2))+o),l&&1===o&&"hidden"===G(t,"visibility",r)&&0!==e&&(o=0),U?n=new pe(h,"opacity",o,e-o,n):(n=new pe(h,"opacity",100*o,100*(e-o),n),n.xn1=l?1:0,h.zoom=1,n.type=2,n.b="alpha(opacity="+n.s+")",n.e="alpha(opacity="+(n.s+n.c)+")",n.data=t,n.plugin=a,n.setRatio=Ae),l&&(n=new pe(h,"visibility",0,0,n,-1,null,!1,0,0!==o?"inherit":"hidden",0===e?"hidden":"inherit"),n.xs0="inherit",s._overwriteProps.push(n.n),s._overwriteProps.push(i)),n}});var Ce=function(t,e){e&&(t.removeProperty?("ms"===e.substr(0,2)&&(e="M"+e.substr(1)),t.removeProperty(e.replace(P,"-$1").toLowerCase())):t.removeAttribute(e))},Oe=function(t){if(this.t._gsClassPT=this,1===t||0===t){this.t.setAttribute("class",0===t?this.b:this.e);for(var e=this.data,i=this.t.style;e;)e.v?i[e.p]=e.v:Ce(i,e.p),e=e._next;1===t&&this.t._gsClassPT===this&&(this.t._gsClassPT=null)}else this.t.getAttribute("class")!==this.e&&this.t.setAttribute("class",this.e)};de("className",{parser:function(t,e,s,n,a,o,h){var l,_,u,p,f,c=t.getAttribute("class")||"",m=t.style.cssText;if(a=n._classNamePT=new pe(t,s,0,0,a,2),a.setRatio=Oe,a.pr=-11,i=!0,a.b=c,_=Q(t,r),u=t._gsClassPT){for(p={},f=u.data;f;)p[f.p]=1,f=f._next;u.setRatio(1)}return t._gsClassPT=a,a.e="="!==e.charAt(1)?e:c.replace(RegExp("\\s*\\b"+e.substr(2)+"\\b"),"")+("+"===e.charAt(0)?" "+e.substr(2):""),n._tween._duration&&(t.setAttribute("class",a.e),l=H(t,_,Q(t),h,p),t.setAttribute("class",c),a.data=l.firstMPT,t.style.cssText=m,a=a.xfirst=n.parse(t,l.difs,a,o)),a}});var De=function(t){if((1===t||0===t)&&this.data._totalTime===this.data._totalDuration&&"isFromStart"!==this.data.data){var e,i,s,r,n=this.t.style,a=o.transform.parse;if("all"===this.e)n.cssText="",r=!0;else for(e=this.e.split(","),s=e.length;--s>-1;)i=e[s],o[i]&&(o[i].parse===a?r=!0:i="transformOrigin"===i?we:o[i].p),Ce(n,i);r&&(Ce(n,ye),this.t._gsTransform&&delete this.t._gsTransform)}};for(de("clearProps",{parser:function(t,e,s,r,n){return n=new pe(t,s,0,0,n,2),n.setRatio=De,n.e=e,n.pr=-10,n.data=r._tween,i=!0,n}}),h="bezier,throwProps,physicsProps,physics2D".split(","),ce=h.length;ce--;)ge(h[ce]);h=a.prototype,h._firstPT=null,h._onInitTween=function(t,e,o){if(!t.nodeType)return!1;this._target=t,this._tween=o,this._vars=e,l=e.autoRound,i=!1,s=e.suffixMap||a.suffixMap,r=W(t,""),n=this._overwriteProps;var h,p,c,m,d,g,v,y,T,x=t.style;if(_&&""===x.zIndex&&(h=G(t,"zIndex",r),("auto"===h||""===h)&&this._addLazySet(x,"zIndex",0)),"string"==typeof e&&(m=x.cssText,h=Q(t,r),x.cssText=m+";"+e,h=H(t,h,Q(t)).difs,!U&&w.test(e)&&(h.opacity=parseFloat(RegExp.$1)),e=h,x.cssText=m),this._firstPT=p=this.parse(t,e,null),this._transformType){for(T=3===this._transformType,ye?u&&(_=!0,""===x.zIndex&&(v=G(t,"zIndex",r),("auto"===v||""===v)&&this._addLazySet(x,"zIndex",0)),f&&this._addLazySet(x,"WebkitBackfaceVisibility",this._vars.WebkitBackfaceVisibility||(T?"visible":"hidden"))):x.zoom=1,c=p;c&&c._next;)c=c._next;y=new pe(t,"transform",0,0,null,2),this._linkCSSP(y,null,c),y.setRatio=T&&xe?ke:ye?Re:Se,y.data=this._transform||Pe(t,r,!0),n.pop()}if(i){for(;p;){for(g=p._next,c=m;c&&c.pr>p.pr;)c=c._next;(p._prev=c?c._prev:d)?p._prev._next=p:m=p,(p._next=c)?c._prev=p:d=p,p=g}this._firstPT=m}return!0},h.parse=function(t,e,i,n){var a,h,_,u,p,f,c,m,d,g,v=t.style;for(a in e)f=e[a],h=o[a],h?i=h.parse(t,f,a,this,i,n,e):(p=G(t,a,r)+"",d="string"==typeof f,"color"===a||"fill"===a||"stroke"===a||-1!==a.indexOf("Color")||d&&b.test(f)?(d||(f=oe(f),f=(f.length>3?"rgba(":"rgb(")+f.join(",")+")"),i=fe(v,a,p,f,!0,"transparent",i,0,n)):!d||-1===f.indexOf(" ")&&-1===f.indexOf(",")?(_=parseFloat(p),c=_||0===_?p.substr((_+"").length):"",(""===p||"auto"===p)&&("width"===a||"height"===a?(_=te(t,a,r),c="px"):"left"===a||"top"===a?(_=Z(t,a,r),c="px"):(_="opacity"!==a?0:1,c="")),g=d&&"="===f.charAt(1),g?(u=parseInt(f.charAt(0)+"1",10),f=f.substr(2),u*=parseFloat(f),m=f.replace(y,"")):(u=parseFloat(f),m=d?f.substr((u+"").length)||"":""),""===m&&(m=a in s?s[a]:c),f=u||0===u?(g?u+_:u)+m:e[a],c!==m&&""!==m&&(u||0===u)&&_&&(_=$(t,a,_,c),"%"===m?(_/=$(t,a,100,"%")/100,e.strictUnits!==!0&&(p=_+"%")):"em"===m?_/=$(t,a,1,"em"):"px"!==m&&(u=$(t,a,u,m),m="px"),g&&(u||0===u)&&(f=u+_+m)),g&&(u+=_),!_&&0!==_||!u&&0!==u?void 0!==v[a]&&(f||"NaN"!=f+""&&null!=f)?(i=new pe(v,a,u||_||0,0,i,-1,a,!1,0,p,f),i.xs0="none"!==f||"display"!==a&&-1===a.indexOf("Style")?f:p):j("invalid "+a+" tween value: "+e[a]):(i=new pe(v,a,_,u-_,i,0,a,l!==!1&&("px"===m||"zIndex"===a),0,p,f),i.xs0=m)):i=fe(v,a,p,f,!0,null,i,0,n)),n&&i&&!i.plugin&&(i.plugin=n);return i},h.setRatio=function(t){var e,i,s,r=this._firstPT,n=1e-6;if(1!==t||this._tween._time!==this._tween._duration&&0!==this._tween._time)if(t||this._tween._time!==this._tween._duration&&0!==this._tween._time||this._tween._rawPrevTime===-1e-6)for(;r;){if(e=r.c*t+r.s,r.r?e=Math.round(e):n>e&&e>-n&&(e=0),r.type)if(1===r.type)if(s=r.l,2===s)r.t[r.p]=r.xs0+e+r.xs1+r.xn1+r.xs2;else if(3===s)r.t[r.p]=r.xs0+e+r.xs1+r.xn1+r.xs2+r.xn2+r.xs3;else if(4===s)r.t[r.p]=r.xs0+e+r.xs1+r.xn1+r.xs2+r.xn2+r.xs3+r.xn3+r.xs4;else if(5===s)r.t[r.p]=r.xs0+e+r.xs1+r.xn1+r.xs2+r.xn2+r.xs3+r.xn3+r.xs4+r.xn4+r.xs5;else{for(i=r.xs0+e+r.xs1,s=1;r.l>s;s++)i+=r["xn"+s]+r["xs"+(s+1)];r.t[r.p]=i}else-1===r.type?r.t[r.p]=r.xs0:r.setRatio&&r.setRatio(t);else r.t[r.p]=e+r.xs0;r=r._next}else for(;r;)2!==r.type?r.t[r.p]=r.b:r.setRatio(t),r=r._next;else for(;r;)2!==r.type?r.t[r.p]=r.e:r.setRatio(t),r=r._next},h._enableTransforms=function(t){this._transformType=t||3===this._transformType?3:2,this._transform=this._transform||Pe(this._target,r,!0)};var Me=function(){this.t[this.p]=this.e,this.data._linkCSSP(this,this._next,null,!0)
};h._addLazySet=function(t,e,i){var s=this._firstPT=new pe(t,e,0,0,this._firstPT,2);s.e=i,s.setRatio=Me,s.data=this},h._linkCSSP=function(t,e,i,s){return t&&(e&&(e._prev=t),t._next&&(t._next._prev=t._prev),t._prev?t._prev._next=t._next:this._firstPT===t&&(this._firstPT=t._next,s=!0),i?i._next=t:s||null!==this._firstPT||(this._firstPT=t),t._next=e,t._prev=i),t},h._kill=function(e){var i,s,r,n=e;if(e.autoAlpha||e.alpha){n={};for(s in e)n[s]=e[s];n.opacity=1,n.autoAlpha&&(n.visibility=1)}return e.className&&(i=this._classNamePT)&&(r=i.xfirst,r&&r._prev?this._linkCSSP(r._prev,i._next,r._prev._prev):r===this._firstPT&&(this._firstPT=i._next),i._next&&this._linkCSSP(i._next,i._next._next,r._prev),this._classNamePT=null),t.prototype._kill.call(this,n)};var ze=function(t,e,i){var s,r,n,a;if(t.slice)for(r=t.length;--r>-1;)ze(t[r],e,i);else for(s=t.childNodes,r=s.length;--r>-1;)n=s[r],a=n.type,n.style&&(e.push(Q(n)),i&&i.push(n)),1!==a&&9!==a&&11!==a||!n.childNodes.length||ze(n,e,i)};return a.cascadeTo=function(t,i,s){var r,n,a,o=e.to(t,i,s),h=[o],l=[],_=[],u=[],p=e._internals.reservedProps;for(t=o._targets||o.target,ze(t,l,u),o.render(i,!0),ze(t,_),o.render(0,!0),o._enabled(!0),r=u.length;--r>-1;)if(n=H(u[r],l[r],_[r]),n.firstMPT){n=n.difs;for(a in s)p[a]&&(n[a]=s[a]);h.push(e.to(u[r],i,n))}return h},t.activate([a]),a},!0),function(){var t=window._gsDefine.plugin({propName:"roundProps",priority:-1,API:2,init:function(t,e,i){return this._tween=i,!0}}),e=t.prototype;e._onInitAllProps=function(){for(var t,e,i,s=this._tween,r=s.vars.roundProps instanceof Array?s.vars.roundProps:s.vars.roundProps.split(","),n=r.length,a={},o=s._propLookup.roundProps;--n>-1;)a[r[n]]=1;for(n=r.length;--n>-1;)for(t=r[n],e=s._firstPT;e;)i=e._next,e.pg?e.t._roundProps(a,!0):e.n===t&&(this._add(e.t,t,e.s,e.c),i&&(i._prev=e._prev),e._prev?e._prev._next=i:s._firstPT===e&&(s._firstPT=i),e._next=e._prev=null,s._propLookup[t]=o),e=i;return!1},e._add=function(t,e,i,s){this._addTween(t,e,i,i+s,e,!0),this._overwriteProps.push(e)}}(),window._gsDefine.plugin({propName:"attr",API:2,version:"0.3.2",init:function(t,e){var i,s,r;if("function"!=typeof t.setAttribute)return!1;this._target=t,this._proxy={},this._start={},this._end={};for(i in e)this._start[i]=this._proxy[i]=s=t.getAttribute(i),r=this._addTween(this._proxy,i,parseFloat(s),e[i],i),this._end[i]=r?r.s+r.c:e[i],this._overwriteProps.push(i);return!0},set:function(t){this._super.setRatio.call(this,t);for(var e,i=this._overwriteProps,s=i.length,r=1===t?this._end:t?this._proxy:this._start;--s>-1;)e=i[s],this._target.setAttribute(e,r[e]+"")}}),window._gsDefine.plugin({propName:"directionalRotation",API:2,version:"0.2.0",init:function(t,e){"object"!=typeof e&&(e={rotation:e}),this.finals={};var i,s,r,n,a,o,h=e.useRadians===!0?2*Math.PI:360,l=1e-6;for(i in e)"useRadians"!==i&&(o=(e[i]+"").split("_"),s=o[0],r=parseFloat("function"!=typeof t[i]?t[i]:t[i.indexOf("set")||"function"!=typeof t["get"+i.substr(3)]?i:"get"+i.substr(3)]()),n=this.finals[i]="string"==typeof s&&"="===s.charAt(1)?r+parseInt(s.charAt(0)+"1",10)*Number(s.substr(2)):Number(s)||0,a=n-r,o.length&&(s=o.join("_"),-1!==s.indexOf("short")&&(a%=h,a!==a%(h/2)&&(a=0>a?a+h:a-h)),-1!==s.indexOf("_cw")&&0>a?a=(a+9999999999*h)%h-(0|a/h)*h:-1!==s.indexOf("ccw")&&a>0&&(a=(a-9999999999*h)%h-(0|a/h)*h)),(a>l||-l>a)&&(this._addTween(t,i,r,r+a,i),this._overwriteProps.push(i)));return!0},set:function(t){var e;if(1!==t)this._super.setRatio.call(this,t);else for(e=this._firstPT;e;)e.f?e.t[e.p](this.finals[e.p]):e.t[e.p]=this.finals[e.p],e=e._next}})._autoCSS=!0,window._gsDefine("easing.Back",["easing.Ease"],function(t){var e,i,s,r=window.GreenSockGlobals||window,n=r.com.greensock,a=2*Math.PI,o=Math.PI/2,h=n._class,l=function(e,i){var s=h("easing."+e,function(){},!0),r=s.prototype=new t;return r.constructor=s,r.getRatio=i,s},_=t.register||function(){},u=function(t,e,i,s){var r=h("easing."+t,{easeOut:new e,easeIn:new i,easeInOut:new s},!0);return _(r,t),r},p=function(t,e,i){this.t=t,this.v=e,i&&(this.next=i,i.prev=this,this.c=i.v-e,this.gap=i.t-t)},f=function(e,i){var s=h("easing."+e,function(t){this._p1=t||0===t?t:1.70158,this._p2=1.525*this._p1},!0),r=s.prototype=new t;return r.constructor=s,r.getRatio=i,r.config=function(t){return new s(t)},s},c=u("Back",f("BackOut",function(t){return(t-=1)*t*((this._p1+1)*t+this._p1)+1}),f("BackIn",function(t){return t*t*((this._p1+1)*t-this._p1)}),f("BackInOut",function(t){return 1>(t*=2)?.5*t*t*((this._p2+1)*t-this._p2):.5*((t-=2)*t*((this._p2+1)*t+this._p2)+2)})),m=h("easing.SlowMo",function(t,e,i){e=e||0===e?e:.7,null==t?t=.7:t>1&&(t=1),this._p=1!==t?e:0,this._p1=(1-t)/2,this._p2=t,this._p3=this._p1+this._p2,this._calcEnd=i===!0},!0),d=m.prototype=new t;return d.constructor=m,d.getRatio=function(t){var e=t+(.5-t)*this._p;return this._p1>t?this._calcEnd?1-(t=1-t/this._p1)*t:e-(t=1-t/this._p1)*t*t*t*e:t>this._p3?this._calcEnd?1-(t=(t-this._p3)/this._p1)*t:e+(t-e)*(t=(t-this._p3)/this._p1)*t*t*t:this._calcEnd?1:e},m.ease=new m(.7,.7),d.config=m.config=function(t,e,i){return new m(t,e,i)},e=h("easing.SteppedEase",function(t){t=t||1,this._p1=1/t,this._p2=t+1},!0),d=e.prototype=new t,d.constructor=e,d.getRatio=function(t){return 0>t?t=0:t>=1&&(t=.999999999),(this._p2*t>>0)*this._p1},d.config=e.config=function(t){return new e(t)},i=h("easing.RoughEase",function(e){e=e||{};for(var i,s,r,n,a,o,h=e.taper||"none",l=[],_=0,u=0|(e.points||20),f=u,c=e.randomize!==!1,m=e.clamp===!0,d=e.template instanceof t?e.template:null,g="number"==typeof e.strength?.4*e.strength:.4;--f>-1;)i=c?Math.random():1/u*f,s=d?d.getRatio(i):i,"none"===h?r=g:"out"===h?(n=1-i,r=n*n*g):"in"===h?r=i*i*g:.5>i?(n=2*i,r=.5*n*n*g):(n=2*(1-i),r=.5*n*n*g),c?s+=Math.random()*r-.5*r:f%2?s+=.5*r:s-=.5*r,m&&(s>1?s=1:0>s&&(s=0)),l[_++]={x:i,y:s};for(l.sort(function(t,e){return t.x-e.x}),o=new p(1,1,null),f=u;--f>-1;)a=l[f],o=new p(a.x,a.y,o);this._prev=new p(0,0,0!==o.t?o:o.next)},!0),d=i.prototype=new t,d.constructor=i,d.getRatio=function(t){var e=this._prev;if(t>e.t){for(;e.next&&t>=e.t;)e=e.next;e=e.prev}else for(;e.prev&&e.t>=t;)e=e.prev;return this._prev=e,e.v+(t-e.t)/e.gap*e.c},d.config=function(t){return new i(t)},i.ease=new i,u("Bounce",l("BounceOut",function(t){return 1/2.75>t?7.5625*t*t:2/2.75>t?7.5625*(t-=1.5/2.75)*t+.75:2.5/2.75>t?7.5625*(t-=2.25/2.75)*t+.9375:7.5625*(t-=2.625/2.75)*t+.984375}),l("BounceIn",function(t){return 1/2.75>(t=1-t)?1-7.5625*t*t:2/2.75>t?1-(7.5625*(t-=1.5/2.75)*t+.75):2.5/2.75>t?1-(7.5625*(t-=2.25/2.75)*t+.9375):1-(7.5625*(t-=2.625/2.75)*t+.984375)}),l("BounceInOut",function(t){var e=.5>t;return t=e?1-2*t:2*t-1,t=1/2.75>t?7.5625*t*t:2/2.75>t?7.5625*(t-=1.5/2.75)*t+.75:2.5/2.75>t?7.5625*(t-=2.25/2.75)*t+.9375:7.5625*(t-=2.625/2.75)*t+.984375,e?.5*(1-t):.5*t+.5})),u("Circ",l("CircOut",function(t){return Math.sqrt(1-(t-=1)*t)}),l("CircIn",function(t){return-(Math.sqrt(1-t*t)-1)}),l("CircInOut",function(t){return 1>(t*=2)?-.5*(Math.sqrt(1-t*t)-1):.5*(Math.sqrt(1-(t-=2)*t)+1)})),s=function(e,i,s){var r=h("easing."+e,function(t,e){this._p1=t||1,this._p2=e||s,this._p3=this._p2/a*(Math.asin(1/this._p1)||0)},!0),n=r.prototype=new t;return n.constructor=r,n.getRatio=i,n.config=function(t,e){return new r(t,e)},r},u("Elastic",s("ElasticOut",function(t){return this._p1*Math.pow(2,-10*t)*Math.sin((t-this._p3)*a/this._p2)+1},.3),s("ElasticIn",function(t){return-(this._p1*Math.pow(2,10*(t-=1))*Math.sin((t-this._p3)*a/this._p2))},.3),s("ElasticInOut",function(t){return 1>(t*=2)?-.5*this._p1*Math.pow(2,10*(t-=1))*Math.sin((t-this._p3)*a/this._p2):.5*this._p1*Math.pow(2,-10*(t-=1))*Math.sin((t-this._p3)*a/this._p2)+1},.45)),u("Expo",l("ExpoOut",function(t){return 1-Math.pow(2,-10*t)}),l("ExpoIn",function(t){return Math.pow(2,10*(t-1))-.001}),l("ExpoInOut",function(t){return 1>(t*=2)?.5*Math.pow(2,10*(t-1)):.5*(2-Math.pow(2,-10*(t-1)))})),u("Sine",l("SineOut",function(t){return Math.sin(t*o)}),l("SineIn",function(t){return-Math.cos(t*o)+1}),l("SineInOut",function(t){return-.5*(Math.cos(Math.PI*t)-1)})),h("easing.EaseLookup",{find:function(e){return t.map[e]}},!0),_(r.SlowMo,"SlowMo","ease,"),_(i,"RoughEase","ease,"),_(e,"SteppedEase","ease,"),c},!0)}),function(t){"use strict";var e=t.GreenSockGlobals||t;if(!e.TweenLite){var i,s,r,n,a,o=function(t){var i,s=t.split("."),r=e;for(i=0;s.length>i;i++)r[s[i]]=r=r[s[i]]||{};return r},h=o("com.greensock"),l=1e-10,_=[].slice,u=function(){},p=function(){var t=Object.prototype.toString,e=t.call([]);return function(i){return null!=i&&(i instanceof Array||"object"==typeof i&&!!i.push&&t.call(i)===e)}}(),f={},c=function(i,s,r,n){this.sc=f[i]?f[i].sc:[],f[i]=this,this.gsClass=null,this.func=r;var a=[];this.check=function(h){for(var l,_,u,p,m=s.length,d=m;--m>-1;)(l=f[s[m]]||new c(s[m],[])).gsClass?(a[m]=l.gsClass,d--):h&&l.sc.push(this);if(0===d&&r)for(_=("com.greensock."+i).split("."),u=_.pop(),p=o(_.join("."))[u]=this.gsClass=r.apply(r,a),n&&(e[u]=p,"function"==typeof define&&define.amd?define((t.GreenSockAMDPath?t.GreenSockAMDPath+"/":"")+i.split(".").join("/"),[],function(){return p}):"undefined"!=typeof module&&module.exports&&(module.exports=p)),m=0;this.sc.length>m;m++)this.sc[m].check()},this.check(!0)},m=t._gsDefine=function(t,e,i,s){return new c(t,e,i,s)},d=h._class=function(t,e,i){return e=e||function(){},m(t,[],function(){return e},i),e};m.globals=e;var g=[0,0,1,1],v=[],y=d("easing.Ease",function(t,e,i,s){this._func=t,this._type=i||0,this._power=s||0,this._params=e?g.concat(e):g},!0),T=y.map={},w=y.register=function(t,e,i,s){for(var r,n,a,o,l=e.split(","),_=l.length,u=(i||"easeIn,easeOut,easeInOut").split(",");--_>-1;)for(n=l[_],r=s?d("easing."+n,null,!0):h.easing[n]||{},a=u.length;--a>-1;)o=u[a],T[n+"."+o]=T[o+n]=r[o]=t.getRatio?t:t[o]||new t};for(r=y.prototype,r._calcEnd=!1,r.getRatio=function(t){if(this._func)return this._params[0]=t,this._func.apply(null,this._params);var e=this._type,i=this._power,s=1===e?1-t:2===e?t:.5>t?2*t:2*(1-t);return 1===i?s*=s:2===i?s*=s*s:3===i?s*=s*s*s:4===i&&(s*=s*s*s*s),1===e?1-s:2===e?s:.5>t?s/2:1-s/2},i=["Linear","Quad","Cubic","Quart","Quint,Strong"],s=i.length;--s>-1;)r=i[s]+",Power"+s,w(new y(null,null,1,s),r,"easeOut",!0),w(new y(null,null,2,s),r,"easeIn"+(0===s?",easeNone":"")),w(new y(null,null,3,s),r,"easeInOut");T.linear=h.easing.Linear.easeIn,T.swing=h.easing.Quad.easeInOut;var x=d("events.EventDispatcher",function(t){this._listeners={},this._eventTarget=t||this});r=x.prototype,r.addEventListener=function(t,e,i,s,r){r=r||0;var o,h,l=this._listeners[t],_=0;for(null==l&&(this._listeners[t]=l=[]),h=l.length;--h>-1;)o=l[h],o.c===e&&o.s===i?l.splice(h,1):0===_&&r>o.pr&&(_=h+1);l.splice(_,0,{c:e,s:i,up:s,pr:r}),this!==n||a||n.wake()},r.removeEventListener=function(t,e){var i,s=this._listeners[t];if(s)for(i=s.length;--i>-1;)if(s[i].c===e)return s.splice(i,1),void 0},r.dispatchEvent=function(t){var e,i,s,r=this._listeners[t];if(r)for(e=r.length,i=this._eventTarget;--e>-1;)s=r[e],s.up?s.c.call(s.s||i,{type:t,target:i}):s.c.call(s.s||i)};var b=t.requestAnimationFrame,P=t.cancelAnimationFrame,S=Date.now||function(){return(new Date).getTime()},k=S();for(i=["ms","moz","webkit","o"],s=i.length;--s>-1&&!b;)b=t[i[s]+"RequestAnimationFrame"],P=t[i[s]+"CancelAnimationFrame"]||t[i[s]+"CancelRequestAnimationFrame"];d("Ticker",function(t,e){var i,s,r,o,h,_=this,p=S(),f=e!==!1&&b,c=500,m=33,d=function(t){var e,n,a=S()-k;a>c&&(p+=a-m),k+=a,_.time=(k-p)/1e3,e=_.time-h,(!i||e>0||t===!0)&&(_.frame++,h+=e+(e>=o?.004:o-e),n=!0),t!==!0&&(r=s(d)),n&&_.dispatchEvent("tick")};x.call(_),_.time=_.frame=0,_.tick=function(){d(!0)},_.lagSmoothing=function(t,e){c=t||1/l,m=Math.min(e,c,0)},_.sleep=function(){null!=r&&(f&&P?P(r):clearTimeout(r),s=u,r=null,_===n&&(a=!1))},_.wake=function(){null!==r?_.sleep():_.frame>10&&(k=S()-c+5),s=0===i?u:f&&b?b:function(t){return setTimeout(t,0|1e3*(h-_.time)+1)},_===n&&(a=!0),d(2)},_.fps=function(t){return arguments.length?(i=t,o=1/(i||60),h=this.time+o,_.wake(),void 0):i},_.useRAF=function(t){return arguments.length?(_.sleep(),f=t,_.fps(i),void 0):f},_.fps(t),setTimeout(function(){f&&(!r||5>_.frame)&&_.useRAF(!1)},1500)}),r=h.Ticker.prototype=new h.events.EventDispatcher,r.constructor=h.Ticker;var R=d("core.Animation",function(t,e){if(this.vars=e=e||{},this._duration=this._totalDuration=t||0,this._delay=Number(e.delay)||0,this._timeScale=1,this._active=e.immediateRender===!0,this.data=e.data,this._reversed=e.reversed===!0,j){a||n.wake();var i=this.vars.useFrames?Y:j;i.add(this,i._time),this.vars.paused&&this.paused(!0)}});n=R.ticker=new h.Ticker,r=R.prototype,r._dirty=r._gc=r._initted=r._paused=!1,r._totalTime=r._time=0,r._rawPrevTime=-1,r._next=r._last=r._onUpdate=r._timeline=r.timeline=null,r._paused=!1;var A=function(){a&&S()-k>2e3&&n.wake(),setTimeout(A,2e3)};A(),r.play=function(t,e){return null!=t&&this.seek(t,e),this.reversed(!1).paused(!1)},r.pause=function(t,e){return null!=t&&this.seek(t,e),this.paused(!0)},r.resume=function(t,e){return null!=t&&this.seek(t,e),this.paused(!1)},r.seek=function(t,e){return this.totalTime(Number(t),e!==!1)},r.restart=function(t,e){return this.reversed(!1).paused(!1).totalTime(t?-this._delay:0,e!==!1,!0)},r.reverse=function(t,e){return null!=t&&this.seek(t||this.totalDuration(),e),this.reversed(!0).paused(!1)},r.render=function(){},r.invalidate=function(){return this},r.isActive=function(){var t,e=this._timeline,i=this._startTime;return!e||!this._gc&&!this._paused&&e.isActive()&&(t=e.rawTime())>=i&&i+this.totalDuration()/this._timeScale>t},r._enabled=function(t,e){return a||n.wake(),this._gc=!t,this._active=this.isActive(),e!==!0&&(t&&!this.timeline?this._timeline.add(this,this._startTime-this._delay):!t&&this.timeline&&this._timeline._remove(this,!0)),!1},r._kill=function(){return this._enabled(!1,!1)},r.kill=function(t,e){return this._kill(t,e),this},r._uncache=function(t){for(var e=t?this:this.timeline;e;)e._dirty=!0,e=e.timeline;return this},r._swapSelfInParams=function(t){for(var e=t.length,i=t.concat();--e>-1;)"{self}"===t[e]&&(i[e]=this);return i},r.eventCallback=function(t,e,i,s){if("on"===(t||"").substr(0,2)){var r=this.vars;if(1===arguments.length)return r[t];null==e?delete r[t]:(r[t]=e,r[t+"Params"]=p(i)&&-1!==i.join("").indexOf("{self}")?this._swapSelfInParams(i):i,r[t+"Scope"]=s),"onUpdate"===t&&(this._onUpdate=e)}return this},r.delay=function(t){return arguments.length?(this._timeline.smoothChildTiming&&this.startTime(this._startTime+t-this._delay),this._delay=t,this):this._delay},r.duration=function(t){return arguments.length?(this._duration=this._totalDuration=t,this._uncache(!0),this._timeline.smoothChildTiming&&this._time>0&&this._time<this._duration&&0!==t&&this.totalTime(this._totalTime*(t/this._duration),!0),this):(this._dirty=!1,this._duration)},r.totalDuration=function(t){return this._dirty=!1,arguments.length?this.duration(t):this._totalDuration},r.time=function(t,e){return arguments.length?(this._dirty&&this.totalDuration(),this.totalTime(t>this._duration?this._duration:t,e)):this._time},r.totalTime=function(t,e,i){if(a||n.wake(),!arguments.length)return this._totalTime;if(this._timeline){if(0>t&&!i&&(t+=this.totalDuration()),this._timeline.smoothChildTiming){this._dirty&&this.totalDuration();var s=this._totalDuration,r=this._timeline;if(t>s&&!i&&(t=s),this._startTime=(this._paused?this._pauseTime:r._time)-(this._reversed?s-t:t)/this._timeScale,r._dirty||this._uncache(!1),r._timeline)for(;r._timeline;)r._timeline._time!==(r._startTime+r._totalTime)/r._timeScale&&r.totalTime(r._totalTime,!0),r=r._timeline}this._gc&&this._enabled(!0,!1),(this._totalTime!==t||0===this._duration)&&(this.render(t,e,!1),z.length&&B())}return this},r.progress=r.totalProgress=function(t,e){return arguments.length?this.totalTime(this.duration()*t,e):this._time/this.duration()},r.startTime=function(t){return arguments.length?(t!==this._startTime&&(this._startTime=t,this.timeline&&this.timeline._sortChildren&&this.timeline.add(this,t-this._delay)),this):this._startTime},r.timeScale=function(t){if(!arguments.length)return this._timeScale;if(t=t||l,this._timeline&&this._timeline.smoothChildTiming){var e=this._pauseTime,i=e||0===e?e:this._timeline.totalTime();this._startTime=i-(i-this._startTime)*this._timeScale/t}return this._timeScale=t,this._uncache(!1)},r.reversed=function(t){return arguments.length?(t!=this._reversed&&(this._reversed=t,this.totalTime(this._timeline&&!this._timeline.smoothChildTiming?this.totalDuration()-this._totalTime:this._totalTime,!0)),this):this._reversed},r.paused=function(t){if(!arguments.length)return this._paused;if(t!=this._paused&&this._timeline){a||t||n.wake();var e=this._timeline,i=e.rawTime(),s=i-this._pauseTime;!t&&e.smoothChildTiming&&(this._startTime+=s,this._uncache(!1)),this._pauseTime=t?i:null,this._paused=t,this._active=this.isActive(),!t&&0!==s&&this._initted&&this.duration()&&this.render(e.smoothChildTiming?this._totalTime:(i-this._startTime)/this._timeScale,!0,!0)}return this._gc&&!t&&this._enabled(!0,!1),this};var C=d("core.SimpleTimeline",function(t){R.call(this,0,t),this.autoRemoveChildren=this.smoothChildTiming=!0});r=C.prototype=new R,r.constructor=C,r.kill()._gc=!1,r._first=r._last=null,r._sortChildren=!1,r.add=r.insert=function(t,e){var i,s;if(t._startTime=Number(e||0)+t._delay,t._paused&&this!==t._timeline&&(t._pauseTime=t._startTime+(this.rawTime()-t._startTime)/t._timeScale),t.timeline&&t.timeline._remove(t,!0),t.timeline=t._timeline=this,t._gc&&t._enabled(!0,!0),i=this._last,this._sortChildren)for(s=t._startTime;i&&i._startTime>s;)i=i._prev;return i?(t._next=i._next,i._next=t):(t._next=this._first,this._first=t),t._next?t._next._prev=t:this._last=t,t._prev=i,this._timeline&&this._uncache(!0),this},r._remove=function(t,e){return t.timeline===this&&(e||t._enabled(!1,!0),t.timeline=null,t._prev?t._prev._next=t._next:this._first===t&&(this._first=t._next),t._next?t._next._prev=t._prev:this._last===t&&(this._last=t._prev),this._timeline&&this._uncache(!0)),this},r.render=function(t,e,i){var s,r=this._first;for(this._totalTime=this._time=this._rawPrevTime=t;r;)s=r._next,(r._active||t>=r._startTime&&!r._paused)&&(r._reversed?r.render((r._dirty?r.totalDuration():r._totalDuration)-(t-r._startTime)*r._timeScale,e,i):r.render((t-r._startTime)*r._timeScale,e,i)),r=s},r.rawTime=function(){return a||n.wake(),this._totalTime};var O=d("TweenLite",function(e,i,s){if(R.call(this,i,s),this.render=O.prototype.render,null==e)throw"Cannot tween a null target.";this.target=e="string"!=typeof e?e:O.selector(e)||e;var r,n,a,o=e.jquery||e.length&&e!==t&&e[0]&&(e[0]===t||e[0].nodeType&&e[0].style&&!e.nodeType),h=this.vars.overwrite;if(this._overwrite=h=null==h?U[O.defaultOverwrite]:"number"==typeof h?h>>0:U[h],(o||e instanceof Array||e.push&&p(e))&&"number"!=typeof e[0])for(this._targets=a=_.call(e,0),this._propLookup=[],this._siblings=[],r=0;a.length>r;r++)n=a[r],n?"string"!=typeof n?n.length&&n!==t&&n[0]&&(n[0]===t||n[0].nodeType&&n[0].style&&!n.nodeType)?(a.splice(r--,1),this._targets=a=a.concat(_.call(n,0))):(this._siblings[r]=q(n,this,!1),1===h&&this._siblings[r].length>1&&V(n,this,null,1,this._siblings[r])):(n=a[r--]=O.selector(n),"string"==typeof n&&a.splice(r+1,1)):a.splice(r--,1);else this._propLookup={},this._siblings=q(e,this,!1),1===h&&this._siblings.length>1&&V(e,this,null,1,this._siblings);(this.vars.immediateRender||0===i&&0===this._delay&&this.vars.immediateRender!==!1)&&(this._time=-l,this.render(-this._delay))},!0),D=function(e){return e.length&&e!==t&&e[0]&&(e[0]===t||e[0].nodeType&&e[0].style&&!e.nodeType)},M=function(t,e){var i,s={};for(i in t)X[i]||i in e&&"transform"!==i&&"x"!==i&&"y"!==i&&"width"!==i&&"height"!==i&&"className"!==i&&"border"!==i||!(!L[i]||L[i]&&L[i]._autoCSS)||(s[i]=t[i],delete t[i]);t.css=s};r=O.prototype=new R,r.constructor=O,r.kill()._gc=!1,r.ratio=0,r._firstPT=r._targets=r._overwrittenProps=r._startAt=null,r._notifyPluginsOfEnabled=r._lazy=!1,O.version="1.12.1",O.defaultEase=r._ease=new y(null,null,1,1),O.defaultOverwrite="auto",O.ticker=n,O.autoSleep=!0,O.lagSmoothing=function(t,e){n.lagSmoothing(t,e)},O.selector=t.$||t.jQuery||function(e){return t.$?(O.selector=t.$,t.$(e)):t.document?t.document.getElementById("#"===e.charAt(0)?e.substr(1):e):e};var z=[],I={},E=O._internals={isArray:p,isSelector:D,lazyTweens:z},L=O._plugins={},F=E.tweenLookup={},N=0,X=E.reservedProps={ease:1,delay:1,overwrite:1,onComplete:1,onCompleteParams:1,onCompleteScope:1,useFrames:1,runBackwards:1,startAt:1,onUpdate:1,onUpdateParams:1,onUpdateScope:1,onStart:1,onStartParams:1,onStartScope:1,onReverseComplete:1,onReverseCompleteParams:1,onReverseCompleteScope:1,onRepeat:1,onRepeatParams:1,onRepeatScope:1,easeParams:1,yoyo:1,immediateRender:1,repeat:1,repeatDelay:1,data:1,paused:1,reversed:1,autoCSS:1,lazy:1},U={none:0,all:1,auto:2,concurrent:3,allOnStart:4,preexisting:5,"true":1,"false":0},Y=R._rootFramesTimeline=new C,j=R._rootTimeline=new C,B=function(){var t=z.length;for(I={};--t>-1;)i=z[t],i&&i._lazy!==!1&&(i.render(i._lazy,!1,!0),i._lazy=!1);z.length=0};j._startTime=n.time,Y._startTime=n.frame,j._active=Y._active=!0,setTimeout(B,1),R._updateRoot=O.render=function(){var t,e,i;if(z.length&&B(),j.render((n.time-j._startTime)*j._timeScale,!1,!1),Y.render((n.frame-Y._startTime)*Y._timeScale,!1,!1),z.length&&B(),!(n.frame%120)){for(i in F){for(e=F[i].tweens,t=e.length;--t>-1;)e[t]._gc&&e.splice(t,1);0===e.length&&delete F[i]}if(i=j._first,(!i||i._paused)&&O.autoSleep&&!Y._first&&1===n._listeners.tick.length){for(;i&&i._paused;)i=i._next;i||n.sleep()}}},n.addEventListener("tick",R._updateRoot);var q=function(t,e,i){var s,r,n=t._gsTweenID;if(F[n||(t._gsTweenID=n="t"+N++)]||(F[n]={target:t,tweens:[]}),e&&(s=F[n].tweens,s[r=s.length]=e,i))for(;--r>-1;)s[r]===e&&s.splice(r,1);return F[n].tweens},V=function(t,e,i,s,r){var n,a,o,h;if(1===s||s>=4){for(h=r.length,n=0;h>n;n++)if((o=r[n])!==e)o._gc||o._enabled(!1,!1)&&(a=!0);else if(5===s)break;return a}var _,u=e._startTime+l,p=[],f=0,c=0===e._duration;for(n=r.length;--n>-1;)(o=r[n])===e||o._gc||o._paused||(o._timeline!==e._timeline?(_=_||W(e,0,c),0===W(o,_,c)&&(p[f++]=o)):u>=o._startTime&&o._startTime+o.totalDuration()/o._timeScale>u&&((c||!o._initted)&&2e-10>=u-o._startTime||(p[f++]=o)));for(n=f;--n>-1;)o=p[n],2===s&&o._kill(i,t)&&(a=!0),(2!==s||!o._firstPT&&o._initted)&&o._enabled(!1,!1)&&(a=!0);return a},W=function(t,e,i){for(var s=t._timeline,r=s._timeScale,n=t._startTime;s._timeline;){if(n+=s._startTime,r*=s._timeScale,s._paused)return-100;s=s._timeline}return n/=r,n>e?n-e:i&&n===e||!t._initted&&2*l>n-e?l:(n+=t.totalDuration()/t._timeScale/r)>e+l?0:n-e-l};r._init=function(){var t,e,i,s,r,n=this.vars,a=this._overwrittenProps,o=this._duration,h=!!n.immediateRender,l=n.ease;if(n.startAt){this._startAt&&(this._startAt.render(-1,!0),this._startAt.kill()),r={};for(s in n.startAt)r[s]=n.startAt[s];if(r.overwrite=!1,r.immediateRender=!0,r.lazy=h&&n.lazy!==!1,r.startAt=r.delay=null,this._startAt=O.to(this.target,0,r),h)if(this._time>0)this._startAt=null;else if(0!==o)return}else if(n.runBackwards&&0!==o)if(this._startAt)this._startAt.render(-1,!0),this._startAt.kill(),this._startAt=null;else{i={};for(s in n)X[s]&&"autoCSS"!==s||(i[s]=n[s]);if(i.overwrite=0,i.data="isFromStart",i.lazy=h&&n.lazy!==!1,i.immediateRender=h,this._startAt=O.to(this.target,0,i),h){if(0===this._time)return}else this._startAt._init(),this._startAt._enabled(!1)}if(this._ease=l?l instanceof y?n.easeParams instanceof Array?l.config.apply(l,n.easeParams):l:"function"==typeof l?new y(l,n.easeParams):T[l]||O.defaultEase:O.defaultEase,this._easeType=this._ease._type,this._easePower=this._ease._power,this._firstPT=null,this._targets)for(t=this._targets.length;--t>-1;)this._initProps(this._targets[t],this._propLookup[t]={},this._siblings[t],a?a[t]:null)&&(e=!0);else e=this._initProps(this.target,this._propLookup,this._siblings,a);if(e&&O._onPluginEvent("_onInitAllProps",this),a&&(this._firstPT||"function"!=typeof this.target&&this._enabled(!1,!1)),n.runBackwards)for(i=this._firstPT;i;)i.s+=i.c,i.c=-i.c,i=i._next;this._onUpdate=n.onUpdate,this._initted=!0},r._initProps=function(e,i,s,r){var n,a,o,h,l,_;if(null==e)return!1;I[e._gsTweenID]&&B(),this.vars.css||e.style&&e!==t&&e.nodeType&&L.css&&this.vars.autoCSS!==!1&&M(this.vars,e);for(n in this.vars){if(_=this.vars[n],X[n])_&&(_ instanceof Array||_.push&&p(_))&&-1!==_.join("").indexOf("{self}")&&(this.vars[n]=_=this._swapSelfInParams(_,this));else if(L[n]&&(h=new L[n])._onInitTween(e,this.vars[n],this)){for(this._firstPT=l={_next:this._firstPT,t:h,p:"setRatio",s:0,c:1,f:!0,n:n,pg:!0,pr:h._priority},a=h._overwriteProps.length;--a>-1;)i[h._overwriteProps[a]]=this._firstPT;(h._priority||h._onInitAllProps)&&(o=!0),(h._onDisable||h._onEnable)&&(this._notifyPluginsOfEnabled=!0)}else this._firstPT=i[n]=l={_next:this._firstPT,t:e,p:n,f:"function"==typeof e[n],n:n,pg:!1,pr:0},l.s=l.f?e[n.indexOf("set")||"function"!=typeof e["get"+n.substr(3)]?n:"get"+n.substr(3)]():parseFloat(e[n]),l.c="string"==typeof _&&"="===_.charAt(1)?parseInt(_.charAt(0)+"1",10)*Number(_.substr(2)):Number(_)-l.s||0;l&&l._next&&(l._next._prev=l)}return r&&this._kill(r,e)?this._initProps(e,i,s,r):this._overwrite>1&&this._firstPT&&s.length>1&&V(e,this,i,this._overwrite,s)?(this._kill(i,e),this._initProps(e,i,s,r)):(this._firstPT&&(this.vars.lazy!==!1&&this._duration||this.vars.lazy&&!this._duration)&&(I[e._gsTweenID]=!0),o)},r.render=function(t,e,i){var s,r,n,a,o=this._time,h=this._duration,_=this._rawPrevTime;if(t>=h)this._totalTime=this._time=h,this.ratio=this._ease._calcEnd?this._ease.getRatio(1):1,this._reversed||(s=!0,r="onComplete"),0===h&&(this._initted||!this.vars.lazy||i)&&(this._startTime===this._timeline._duration&&(t=0),(0===t||0>_||_===l)&&_!==t&&(i=!0,_>l&&(r="onReverseComplete")),this._rawPrevTime=a=!e||t||_===t?t:l);else if(1e-7>t)this._totalTime=this._time=0,this.ratio=this._ease._calcEnd?this._ease.getRatio(0):0,(0!==o||0===h&&_>0&&_!==l)&&(r="onReverseComplete",s=this._reversed),0>t?(this._active=!1,0===h&&(this._initted||!this.vars.lazy||i)&&(_>=0&&(i=!0),this._rawPrevTime=a=!e||t||_===t?t:l)):this._initted||(i=!0);else if(this._totalTime=this._time=t,this._easeType){var u=t/h,p=this._easeType,f=this._easePower;(1===p||3===p&&u>=.5)&&(u=1-u),3===p&&(u*=2),1===f?u*=u:2===f?u*=u*u:3===f?u*=u*u*u:4===f&&(u*=u*u*u*u),this.ratio=1===p?1-u:2===p?u:.5>t/h?u/2:1-u/2}else this.ratio=this._ease.getRatio(t/h);if(this._time!==o||i){if(!this._initted){if(this._init(),!this._initted||this._gc)return;if(!i&&this._firstPT&&(this.vars.lazy!==!1&&this._duration||this.vars.lazy&&!this._duration))return this._time=this._totalTime=o,this._rawPrevTime=_,z.push(this),this._lazy=t,void 0;this._time&&!s?this.ratio=this._ease.getRatio(this._time/h):s&&this._ease._calcEnd&&(this.ratio=this._ease.getRatio(0===this._time?0:1))}for(this._lazy!==!1&&(this._lazy=!1),this._active||!this._paused&&this._time!==o&&t>=0&&(this._active=!0),0===o&&(this._startAt&&(t>=0?this._startAt.render(t,e,i):r||(r="_dummyGS")),this.vars.onStart&&(0!==this._time||0===h)&&(e||this.vars.onStart.apply(this.vars.onStartScope||this,this.vars.onStartParams||v))),n=this._firstPT;n;)n.f?n.t[n.p](n.c*this.ratio+n.s):n.t[n.p]=n.c*this.ratio+n.s,n=n._next;this._onUpdate&&(0>t&&this._startAt&&this._startTime&&this._startAt.render(t,e,i),e||(this._time!==o||s)&&this._onUpdate.apply(this.vars.onUpdateScope||this,this.vars.onUpdateParams||v)),r&&(this._gc||(0>t&&this._startAt&&!this._onUpdate&&this._startTime&&this._startAt.render(t,e,i),s&&(this._timeline.autoRemoveChildren&&this._enabled(!1,!1),this._active=!1),!e&&this.vars[r]&&this.vars[r].apply(this.vars[r+"Scope"]||this,this.vars[r+"Params"]||v),0===h&&this._rawPrevTime===l&&a!==l&&(this._rawPrevTime=0)))}},r._kill=function(t,e){if("all"===t&&(t=null),null==t&&(null==e||e===this.target))return this._lazy=!1,this._enabled(!1,!1);e="string"!=typeof e?e||this._targets||this.target:O.selector(e)||e;var i,s,r,n,a,o,h,l;if((p(e)||D(e))&&"number"!=typeof e[0])for(i=e.length;--i>-1;)this._kill(t,e[i])&&(o=!0);else{if(this._targets){for(i=this._targets.length;--i>-1;)if(e===this._targets[i]){a=this._propLookup[i]||{},this._overwrittenProps=this._overwrittenProps||[],s=this._overwrittenProps[i]=t?this._overwrittenProps[i]||{}:"all";break}}else{if(e!==this.target)return!1;a=this._propLookup,s=this._overwrittenProps=t?this._overwrittenProps||{}:"all"}if(a){h=t||a,l=t!==s&&"all"!==s&&t!==a&&("object"!=typeof t||!t._tempKill);for(r in h)(n=a[r])&&(n.pg&&n.t._kill(h)&&(o=!0),n.pg&&0!==n.t._overwriteProps.length||(n._prev?n._prev._next=n._next:n===this._firstPT&&(this._firstPT=n._next),n._next&&(n._next._prev=n._prev),n._next=n._prev=null),delete a[r]),l&&(s[r]=1);!this._firstPT&&this._initted&&this._enabled(!1,!1)}}return o},r.invalidate=function(){return this._notifyPluginsOfEnabled&&O._onPluginEvent("_onDisable",this),this._firstPT=null,this._overwrittenProps=null,this._onUpdate=null,this._startAt=null,this._initted=this._active=this._notifyPluginsOfEnabled=this._lazy=!1,this._propLookup=this._targets?{}:[],this},r._enabled=function(t,e){if(a||n.wake(),t&&this._gc){var i,s=this._targets;if(s)for(i=s.length;--i>-1;)this._siblings[i]=q(s[i],this,!0);else this._siblings=q(this.target,this,!0)}return R.prototype._enabled.call(this,t,e),this._notifyPluginsOfEnabled&&this._firstPT?O._onPluginEvent(t?"_onEnable":"_onDisable",this):!1},O.to=function(t,e,i){return new O(t,e,i)},O.from=function(t,e,i){return i.runBackwards=!0,i.immediateRender=0!=i.immediateRender,new O(t,e,i)},O.fromTo=function(t,e,i,s){return s.startAt=i,s.immediateRender=0!=s.immediateRender&&0!=i.immediateRender,new O(t,e,s)},O.delayedCall=function(t,e,i,s,r){return new O(e,0,{delay:t,onComplete:e,onCompleteParams:i,onCompleteScope:s,onReverseComplete:e,onReverseCompleteParams:i,onReverseCompleteScope:s,immediateRender:!1,useFrames:r,overwrite:0})},O.set=function(t,e){return new O(t,0,e)},O.getTweensOf=function(t,e){if(null==t)return[];t="string"!=typeof t?t:O.selector(t)||t;var i,s,r,n;if((p(t)||D(t))&&"number"!=typeof t[0]){for(i=t.length,s=[];--i>-1;)s=s.concat(O.getTweensOf(t[i],e));for(i=s.length;--i>-1;)for(n=s[i],r=i;--r>-1;)n===s[r]&&s.splice(i,1)}else for(s=q(t).concat(),i=s.length;--i>-1;)(s[i]._gc||e&&!s[i].isActive())&&s.splice(i,1);return s},O.killTweensOf=O.killDelayedCallsTo=function(t,e,i){"object"==typeof e&&(i=e,e=!1);for(var s=O.getTweensOf(t,e),r=s.length;--r>-1;)s[r]._kill(i,t)};var G=d("plugins.TweenPlugin",function(t,e){this._overwriteProps=(t||"").split(","),this._propName=this._overwriteProps[0],this._priority=e||0,this._super=G.prototype},!0);if(r=G.prototype,G.version="1.10.1",G.API=2,r._firstPT=null,r._addTween=function(t,e,i,s,r,n){var a,o;return null!=s&&(a="number"==typeof s||"="!==s.charAt(1)?Number(s)-i:parseInt(s.charAt(0)+"1",10)*Number(s.substr(2)))?(this._firstPT=o={_next:this._firstPT,t:t,p:e,s:i,c:a,f:"function"==typeof t[e],n:r||e,r:n},o._next&&(o._next._prev=o),o):void 0},r.setRatio=function(t){for(var e,i=this._firstPT,s=1e-6;i;)e=i.c*t+i.s,i.r?e=Math.round(e):s>e&&e>-s&&(e=0),i.f?i.t[i.p](e):i.t[i.p]=e,i=i._next},r._kill=function(t){var e,i=this._overwriteProps,s=this._firstPT;if(null!=t[this._propName])this._overwriteProps=[];else for(e=i.length;--e>-1;)null!=t[i[e]]&&i.splice(e,1);for(;s;)null!=t[s.n]&&(s._next&&(s._next._prev=s._prev),s._prev?(s._prev._next=s._next,s._prev=null):this._firstPT===s&&(this._firstPT=s._next)),s=s._next;return!1},r._roundProps=function(t,e){for(var i=this._firstPT;i;)(t[this._propName]||null!=i.n&&t[i.n.split(this._propName+"_").join("")])&&(i.r=e),i=i._next},O._onPluginEvent=function(t,e){var i,s,r,n,a,o=e._firstPT;if("_onInitAllProps"===t){for(;o;){for(a=o._next,s=r;s&&s.pr>o.pr;)s=s._next;(o._prev=s?s._prev:n)?o._prev._next=o:r=o,(o._next=s)?s._prev=o:n=o,o=a}o=e._firstPT=r}for(;o;)o.pg&&"function"==typeof o.t[t]&&o.t[t]()&&(i=!0),o=o._next;return i},G.activate=function(t){for(var e=t.length;--e>-1;)t[e].API===G.API&&(L[(new t[e])._propName]=t[e]);return!0},m.plugin=function(t){if(!(t&&t.propName&&t.init&&t.API))throw"illegal plugin definition.";
var e,i=t.propName,s=t.priority||0,r=t.overwriteProps,n={init:"_onInitTween",set:"setRatio",kill:"_kill",round:"_roundProps",initAll:"_onInitAllProps"},a=d("plugins."+i.charAt(0).toUpperCase()+i.substr(1)+"Plugin",function(){G.call(this,i,s),this._overwriteProps=r||[]},t.global===!0),o=a.prototype=new G(i);o.constructor=a,a.API=t.API;for(e in n)"function"==typeof t[e]&&(o[n[e]]=t[e]);return a.version=t.version,G.activate([a]),a},i=t._gsQueue){for(s=0;i.length>s;s++)i[s]();for(r in f)f[r].func||t.console.log("GSAP encountered missing dependency: com.greensock."+r)}a=!1}}(window);

/*! SCROLL TO PLUGIN FOR GS
 * VERSION: beta 1.7.1
 * DATE: 2013-10-23
 * UPDATES AND DOCS AT: http://www.greensock.com
 *
 * @license Copyright (c) 2008-2013, GreenSock. All rights reserved.
 * This work is subject to the terms at http://www.greensock.com/terms_of_use.html or for
 * Club GreenSock members, the software agreement that was issued with your membership.
 * 
 * @author: Jack Doyle, jack@greensock.com
 **/
(window._gsQueue||(window._gsQueue=[])).push(function(){"use strict";var t=document.documentElement,e=window,i=function(i,s){var r="x"===s?"Width":"Height",n="scroll"+r,a="client"+r,o=document.body;return i===e||i===t||i===o?Math.max(t[n],o[n])-(e["inner"+r]||Math.max(t[a],o[a])):i[n]-i["offset"+r]},s=window._gsDefine.plugin({propName:"scrollTo",API:2,init:function(t,s,r){return this._wdw=t===e,this._target=t,this._tween=r,"object"!=typeof s&&(s={y:s}),this._autoKill=s.autoKill!==!1,this.x=this.xPrev=this.getX(),this.y=this.yPrev=this.getY(),null!=s.x?this._addTween(this,"x",this.x,"max"===s.x?i(t,"x"):s.x,"scrollTo_x",!0):this.skipX=!0,null!=s.y?this._addTween(this,"y",this.y,"max"===s.y?i(t,"y"):s.y,"scrollTo_y",!0):this.skipY=!0,!0},set:function(t){this._super.setRatio.call(this,t);var i=this._wdw||!this.skipX?this.getX():this.xPrev,s=this._wdw||!this.skipY?this.getY():this.yPrev,r=s-this.yPrev,n=i-this.xPrev;this._autoKill&&(!this.skipX&&(n>7||-7>n)&&(this.skipX=!0),!this.skipY&&(r>7||-7>r)&&(this.skipY=!0),this.skipX&&this.skipY&&this._tween.kill()),this._wdw?e.scrollTo(this.skipX?i:this.x,this.skipY?s:this.y):(this.skipY||(this._target.scrollTop=this.y),this.skipX||(this._target.scrollLeft=this.x)),this.xPrev=this.x,this.yPrev=this.y}}),r=s.prototype;s.max=i,r.getX=function(){return this._wdw?null!=e.pageXOffset?e.pageXOffset:null!=t.scrollLeft?t.scrollLeft:document.body.scrollLeft:this._target.scrollLeft},r.getY=function(){return this._wdw?null!=e.pageYOffset?e.pageYOffset:null!=t.scrollTop?t.scrollTop:document.body.scrollTop:this._target.scrollTop},r._kill=function(t){return t.scrollTo_x&&(this.skipX=!0),t.scrollTo_y&&(this.skipY=!0),this._super._kill.call(this,t)}}),window._gsDefine&&window._gsQueue.pop()();
;// The MIT License (MIT)

// Typed.js | Copyright (c) 2014 Matt Boldt | www.mattboldt.com

// Permission is hereby granted, free of charge, to any person obtaining a copy
// of this software and associated documentation files (the "Software"), to deal
// in the Software without restriction, including without limitation the rights
// to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
// copies of the Software, and to permit persons to whom the Software is
// furnished to do so, subject to the following conditions:

// The above copyright notice and this permission notice shall be included in
// all copies or substantial portions of the Software.

// THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
// IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
// FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
// AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
// LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
// OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
// THE SOFTWARE.




;(function($){

    "use strict";

    var Typed = function(el, options){

        // chosen element to manipulate text
        this.el = $(el);
        // options
        this.options = $.extend({}, $.fn.typed.defaults, options);

        // text content of element
        this.text = this.el.text();

        // typing speed
        this.typeSpeed = this.options.typeSpeed;

        // add a delay before typing starts
        this.startDelay = this.options.startDelay;

        // backspacing speed
        this.backSpeed = this.options.backSpeed;

        // amount of time to wait before backspacing
        this.backDelay = this.options.backDelay;

        // input strings of text
        this.strings = this.options.strings;

        // character number position of current string
        this.strPos = 0;

        // current array position
        this.arrayPos = 0;

        // current string based on current values[] array position
        this.string = this.strings[this.arrayPos];

        // number to stop backspacing on.
        // default 0, can change depending on how many chars
        // you want to remove at the time
        this.stopNum = 0;

        // Looping logic
        this.loop = this.options.loop;
        this.loopCount = this.options.loopCount;
        this.curLoop = 1;
        if (this.loop === false){
            // number in which to stop going through array
            // set to strings[] array (length - 1) to stop deleting after last string is typed
            this.stopArray = this.strings.length-1;
        }
        else{
            this.stopArray = this.strings.length;
        }

        // All systems go!
        this.build();
    }

        Typed.prototype =  {

            constructor: Typed

            , init: function(){
                // begin the loop w/ first current string (global self.string)
                // current string will be passed as an argument each time after this
                var self  = this;
                setTimeout(function() {
                    // Start typing
                    self.typewrite(self.string, self.strPos)
                }, self.startDelay);
            }

            , build: function(){
                // Insert cursor
                //this.el.after("<span id=\"typed-cursor\">|</span>");
                this.init();
            }

            // pass current string state to each function
            , typewrite: function(curString, curStrPos){

                // varying values for setTimeout during typing
                // can't be global since number changes each time loop is executed
                var humanize = Math.round(Math.random() * (100 - 30)) + this.typeSpeed;
                var self = this;

                // ------------- optional ------------- //
                // backpaces a certain string faster
                // ------------------------------------ //
                // if (self.arrayPos == 1){
                //  self.backDelay = 50;
                // }
                // else{ self.backDelay = 500; }

                // contain typing function in a timeout
                setTimeout(function() {

                    // make sure array position is less than array length
                    if (self.arrayPos < self.strings.length){

                        // check for an escape character before a pause value
                        if (curString.substr(curStrPos, 1) === "^") {
                            var charPauseEnd = curString.substr(curStrPos + 1).indexOf(" ");
                            var charPause = curString.substr(curStrPos + 1, charPauseEnd);
                            // strip out the escape character and pause value so they're not printed
                            curString = curString.replace("^" + charPause, "");
                        }
                        else {
                            var charPause = 0;
                        }

                        // timeout for any pause after a character
                        setTimeout(function() {

                            // start typing each new char into existing string
                            // curString is function arg
                            self.el.text(self.text + curString.substr(0, curStrPos));

                            // check if current character number is the string's length
                            // and if the current array position is less than the stopping point
                            // if so, backspace after backDelay setting
                            if (curStrPos > curString.length && self.arrayPos < self.stopArray){
                                clearTimeout(clear);
                                self.options.onStringTyped();
                                var clear = setTimeout(function(){
                                    self.backspace(curString, curStrPos);
                                }, self.backDelay);
                            }

                            // else, keep typing
                            else{
                                // add characters one by one
                                curStrPos++;
                                // loop the function
                                self.typewrite(curString, curStrPos);
                                // if the array position is at the stopping position
                                // finish code, on to next task
                                if (self.loop === false){
                                    if (self.arrayPos === self.stopArray && curStrPos === curString.length){
                                        // animation that occurs on the last typed string
                                        // fires callback function
                                        var clear = self.options.callback();
                                        clearTimeout(clear);
                                    }
                                }
                            }

                        // end of character pause
                        }, charPause);
                    }
                    // if the array position is greater than array length
                    // and looping is active, reset array pos and start over.
                    else if (self.loop === true && self.loopCount === false){
                        self.arrayPos = 0;
                        self.init();
                    }
                        else if(self.loopCount !== false && self.curLoop < self.loopCount){
                            self.arrayPos = 0;
                            self.curLoop = self.curLoop+1;
                            self.init();
                        }

                // humanized value for typing
                }, humanize);

            }

            , backspace: function(curString, curStrPos){

                // varying values for setTimeout during typing
                // can't be global since number changes each time loop is executed
                var humanize = Math.round(Math.random() * (100 - 30)) + this.backSpeed;
                var self = this;

                setTimeout(function() {

                    // ----- this part is optional ----- //
                    // check string array position
                    // on the first string, only delete one word
                    // the stopNum actually represents the amount of chars to
                    // keep in the current string. In my case it's 14.
                    // if (self.arrayPos == 1){
                    //  self.stopNum = 14;
                    // }
                    //every other time, delete the whole typed string
                    // else{
                    //  self.stopNum = 0;
                    // }

                    // ----- continue important stuff ----- //
                    // replace text with current text + typed characters
                    self.el.text(self.text + curString.substr(0, curStrPos));

                    // if the number (id of character in current string) is
                    // less than the stop number, keep going
                    if (curStrPos > self.stopNum){
                        // subtract characters one by one
                        curStrPos--;
                        // loop the function
                        self.backspace(curString, curStrPos);
                    }
                    // if the stop number has been reached, increase
                    // array position to next string
                    else if (curStrPos <= self.stopNum){
                        clearTimeout(clear);
                        var clear = self.arrayPos = self.arrayPos+1;
                        // must pass new array position in this instance
                        // instead of using global arrayPos
                        self.typewrite(self.strings[self.arrayPos], curStrPos);
                    }

                // humanized value for typing
                }, humanize);

            }

        }

    $.fn.typed = function (option) {
        return this.each(function () {
          var $this = $(this)
            , data = $this.data('typed')
            , options = typeof option == 'object' && option
          if (!data) $this.data('typed', (data = new Typed(this, options)))
          if (typeof option == 'string') data[option]()
        });
    }

    $.fn.typed.defaults = {
        strings: ["These are the default values...", "You know what you should do?", "Use your own!", "Have a great day!"],
        // typing speed
        typeSpeed: 0,
        // time before typing starts
        startDelay: 0,
        // backspacing speed
        backSpeed: 0,
        // time before backspacing
        backDelay: 500,
        // loop
        loop: false,
        // false = infinite
        loopCount: false,
        // ending callback function
        callback: function(){ null },
        //callback for every typed string
        onStringTyped: function(){ null }
    }


})(window.jQuery);


; /*
 * jQuery FlexSlider v2.1
 * http://www.woothemes.com/flexslider/
 *
 * Copyright 2012 WooThemes
 * Free to use under the GPLv2 license.
 * http://www.gnu.org/licenses/gpl-2.0.html
 *
 * Contributing author: Tyler Smith (@mbmufffin)
 */

;(function ($) {

  //FlexSlider: Object Instance
  $.flexslider = function(el, options) {
    var slider = $(el),
        vars = $.extend({}, $.flexslider.defaults, options),
        namespace = vars.namespace,
        touch = ("ontouchstart" in window) || window.DocumentTouch && document instanceof DocumentTouch,
        eventType = (touch) ? "touchend" : "click",
        vertical = vars.direction === "vertical",
        reverse = vars.reverse,
        carousel = (vars.itemWidth > 0),
        fade = vars.animation === "fade",
        asNav = vars.asNavFor !== "",
        methods = {};

    // Store a reference to the slider object
    $.data(el, "flexslider", slider);

    // Privat slider methods
    methods = {
      init: function() {
        slider.animating = false;
        slider.currentSlide = vars.startAt;
        slider.animatingTo = slider.currentSlide;
        slider.atEnd = (slider.currentSlide === 0 || slider.currentSlide === slider.last);
        slider.containerSelector = vars.selector.substr(0,vars.selector.search(' '));
        slider.slides = $(vars.selector, slider);
        slider.container = $(slider.containerSelector, slider);
        slider.count = slider.slides.length;
        // SYNC:
        slider.syncExists = $(vars.sync).length > 0;
        // SLIDE:
        if (vars.animation === "slide") vars.animation = "swing";
        slider.prop = (vertical) ? "top" : "marginLeft";
        slider.args = {};
        // SLIDESHOW:
        slider.manualPause = false;
        // TOUCH/USECSS:
        slider.transitions = !vars.video && !fade && vars.useCSS && (function() {
          var obj = document.createElement('div'),
              props = ['perspectiveProperty', 'WebkitPerspective', 'MozPerspective', 'OPerspective', 'msPerspective'];
          for (var i in props) {
            if ( obj.style[ props[i] ] !== undefined ) {
              slider.pfx = props[i].replace('Perspective','').toLowerCase();
              slider.prop = "-" + slider.pfx + "-transform";
              return true;
            }
          }
          return false;
        }());
        // CONTROLSCONTAINER:
        if (vars.controlsContainer !== "") slider.controlsContainer = $(vars.controlsContainer).length > 0 && $(vars.controlsContainer);
        // MANUAL:
        if (vars.manualControls !== "") slider.manualControls = $(vars.manualControls).length > 0 && $(vars.manualControls);

        // RANDOMIZE:
        if (vars.randomize) {
          slider.slides.sort(function() { return (Math.round(Math.random())-0.5); });
          slider.container.empty().append(slider.slides);
        }

        slider.doMath();

        // ASNAV:
        if (asNav) methods.asNav.setup();

        // INIT
        slider.setup("init");

        // CONTROLNAV:
        if (vars.controlNav) methods.controlNav.setup();

        // DIRECTIONNAV:
        if (vars.directionNav) methods.directionNav.setup();

        // KEYBOARD:
        if (vars.keyboard && ($(slider.containerSelector).length === 1 || vars.multipleKeyboard)) {
          $(document).bind('keyup', function(event) {
            var keycode = event.keyCode;
            if (!slider.animating && (keycode === 39 || keycode === 37)) {
              var target = (keycode === 39) ? slider.getTarget('next') :
                           (keycode === 37) ? slider.getTarget('prev') : false;
              slider.flexAnimate(target, vars.pauseOnAction);
            }
          });
        }
        // MOUSEWHEEL:
        if (vars.mousewheel) {
          slider.bind('mousewheel', function(event, delta, deltaX, deltaY) {
            event.preventDefault();
            var target = (delta < 0) ? slider.getTarget('next') : slider.getTarget('prev');
            slider.flexAnimate(target, vars.pauseOnAction);
          });
        }

        // PAUSEPLAY
        if (vars.pausePlay) methods.pausePlay.setup();

        // SLIDSESHOW
        if (vars.slideshow) {
          if (vars.pauseOnHover) {
            slider.hover(function() {
              if (!slider.manualPlay && !slider.manualPause) slider.pause();
            }, function() {
              if (!slider.manualPause && !slider.manualPlay) slider.play();
            });
          }
          // initialize animation
          (vars.initDelay > 0) ? setTimeout(slider.play, vars.initDelay) : slider.play();
        }

        // TOUCH
        if (touch && vars.touch) methods.touch();

        // FADE&&SMOOTHHEIGHT || SLIDE:
        if (!fade || (fade && vars.smoothHeight)) $(window).bind("resize focus", methods.resize);


        // API: start() Callback
        setTimeout(function(){
          vars.start(slider);
        }, 200);
      },
      asNav: {
        setup: function() {
          slider.asNav = true;
          slider.animatingTo = Math.floor(slider.currentSlide/slider.move);
          slider.currentItem = slider.currentSlide;
          slider.slides.removeClass(namespace + "active-slide").eq(slider.currentItem).addClass(namespace + "active-slide");
          slider.slides.click(function(e){
            e.preventDefault();
            var $slide = $(this),
                target = $slide.index();
            if (!$(vars.asNavFor).data('flexslider').animating && !$slide.hasClass('active')) {
              slider.direction = (slider.currentItem < target) ? "next" : "prev";
              slider.flexAnimate(target, vars.pauseOnAction, false, true, true);
            }
          });
        }
      },
      controlNav: {
        setup: function() {
          if (!slider.manualControls) {
            methods.controlNav.setupPaging();
          } else { // MANUALCONTROLS:
            methods.controlNav.setupManual();
          }
        },
        setupPaging: function() {
          var type = (vars.controlNav === "thumbnails") ? 'control-thumbs' : 'control-paging',
              j = 1,
              item;

          slider.controlNavScaffold = $('<ol class="'+ namespace + 'control-nav ' + namespace + type + '"></ol>');

          if (slider.pagingCount > 1) {
            for (var i = 0; i < slider.pagingCount; i++) {
              item = (vars.controlNav === "thumbnails") ? '<img src="' + slider.slides.eq(i).attr("data-thumb") + '"/>' : '<a><i class="mk-icon-circle"></i></a>';
              slider.controlNavScaffold.append('<li>' + item + '</li>');
              j++;
            }
          }

          // CONTROLSCONTAINER:
          (slider.controlsContainer) ? $(slider.controlsContainer).append(slider.controlNavScaffold) : slider.append(slider.controlNavScaffold);
          methods.controlNav.set();

          methods.controlNav.active();

          slider.controlNavScaffold.delegate('a, img', eventType, function(event) {
            event.preventDefault();
            var $this = $(this),
                target = slider.controlNav.index($this);

            if (!$this.hasClass(namespace + 'active')) {
              slider.direction = (target > slider.currentSlide) ? "next" : "prev";
              slider.flexAnimate(target, vars.pauseOnAction);
            }
          });
          // Prevent iOS click event bug
          if (touch) {
            slider.controlNavScaffold.delegate('a', "click touchstart", function(event) {
              event.preventDefault();
            });
          }
        },
        setupManual: function() {
          slider.controlNav = slider.manualControls;
          methods.controlNav.active();

          slider.controlNav.live(eventType, function(event) {
            event.preventDefault();
            var $this = $(this),
                target = slider.controlNav.index($this);

            if (!$this.hasClass(namespace + 'active')) {
              (target > slider.currentSlide) ? slider.direction = "next" : slider.direction = "prev";
              slider.flexAnimate(target, vars.pauseOnAction);
            }
          });
          // Prevent iOS click event bug
          if (touch) {
            slider.controlNav.live("click touchstart", function(event) {
              event.preventDefault();
            });
          }
        },
        set: function() {
          var selector = (vars.controlNav === "thumbnails") ? 'img' : 'a';
          slider.controlNav = $('.' + namespace + 'control-nav li ' + selector, (slider.controlsContainer) ? slider.controlsContainer : slider);
        },
        active: function() {
          slider.controlNav.removeClass(namespace + "active").eq(slider.animatingTo).addClass(namespace + "active");
        },
        update: function(action, pos) {
          if (slider.pagingCount > 1 && action === "add") {
            slider.controlNavScaffold.append($('<li><a>' + slider.count + '</a></li>'));
          } else if (slider.pagingCount === 1) {
            slider.controlNavScaffold.find('li').remove();
          } else {
            slider.controlNav.eq(pos).closest('li').remove();
          }
          methods.controlNav.set();
          (slider.pagingCount > 1 && slider.pagingCount !== slider.controlNav.length) ? slider.update(pos, action) : methods.controlNav.active();
        }
      },
      directionNav: {
        setup: function() {
          var directionNavScaffold = $('<ul class="' + namespace + 'direction-nav"><li><a class="' + namespace + 'prev" href="#">' + vars.directionNavArrowsLeft + vars.prevText + '</a></li><li><a class="' + namespace + 'next" href="#">' + vars.directionNavArrowsRight + vars.nextText + '</a></li></ul>');

          // CONTROLSCONTAINER:
          if (slider.controlsContainer) {
            $(slider.controlsContainer).append(directionNavScaffold);
            slider.directionNav = $('.' + namespace + 'direction-nav li a', slider.controlsContainer);
          } else {
            slider.append(directionNavScaffold);
            slider.directionNav = $('.' + namespace + 'direction-nav li a', slider);
          }

          methods.directionNav.update();

          slider.directionNav.bind(eventType, function(event) {
            event.preventDefault();
            var target = ($(this).hasClass(namespace + 'next')) ? slider.getTarget('next') : slider.getTarget('prev');
            slider.flexAnimate(target, vars.pauseOnAction);
          });
          // Prevent iOS click event bug
          if (touch) {
            slider.directionNav.bind("click touchstart", function(event) {
              event.preventDefault();
            });
          }
        },
        update: function() {
          var disabledClass = namespace + 'disabled';
          if (slider.pagingCount === 1) {
            slider.directionNav.addClass(disabledClass);
          } else if (!vars.animationLoop) {
            if (slider.animatingTo === 0) {
              slider.directionNav.removeClass(disabledClass).filter('.' + namespace + "prev").addClass(disabledClass);
            } else if (slider.animatingTo === slider.last) {
              slider.directionNav.removeClass(disabledClass).filter('.' + namespace + "next").addClass(disabledClass);
            } else {
              slider.directionNav.removeClass(disabledClass);
            }
          } else {
            slider.directionNav.removeClass(disabledClass);
          }
        }
      },
      pausePlay: {
        setup: function() {
          var pausePlayScaffold = $('<div class="' + namespace + 'pauseplay"><a></a></div>');

          // CONTROLSCONTAINER:
          if (slider.controlsContainer) {
            slider.controlsContainer.append(pausePlayScaffold);
            slider.pausePlay = $('.' + namespace + 'pauseplay a', slider.controlsContainer);
          } else {
            slider.append(pausePlayScaffold);
            slider.pausePlay = $('.' + namespace + 'pauseplay a', slider);
          }

          methods.pausePlay.update((vars.slideshow) ? namespace + 'pause' : namespace + 'play');

          slider.pausePlay.bind(eventType, function(event) {
            event.preventDefault();
            if ($(this).hasClass(namespace + 'pause')) {
              slider.manualPause = true;
              slider.manualPlay = false;
              slider.pause();
            } else {
              slider.manualPause = false;
              slider.manualPlay = true;
              slider.play();
            }
          });
          // Prevent iOS click event bug
          if (touch) {
            slider.pausePlay.bind("click touchstart", function(event) {
              event.preventDefault();
            });
          }
        },
        update: function(state) {
          (state === "play") ? slider.pausePlay.removeClass(namespace + 'pause').addClass(namespace + 'play').text(vars.playText) : slider.pausePlay.removeClass(namespace + 'play').addClass(namespace + 'pause').text(vars.pauseText);
        }
      },
      touch: function() {
        var startX,
          startY,
          offset,
          cwidth,
          dx,
          startT,
          scrolling = false;

        el.addEventListener('touchstart', onTouchStart, false);
        function onTouchStart(e) {
          if (slider.animating) {
            e.preventDefault();
          } else if (e.touches.length === 1) {
            slider.pause();
            // CAROUSEL:
            cwidth = (vertical) ? slider.h : slider. w;
            startT = Number(new Date());
            // CAROUSEL:
            offset = (carousel && reverse && slider.animatingTo === slider.last) ? 0 :
                     (carousel && reverse) ? slider.limit - (((slider.itemW + vars.itemMargin) * slider.move) * slider.animatingTo) :
                     (carousel && slider.currentSlide === slider.last) ? slider.limit :
                     (carousel) ? ((slider.itemW + vars.itemMargin) * slider.move) * slider.currentSlide :
                     (reverse) ? (slider.last - slider.currentSlide + slider.cloneOffset) * cwidth : (slider.currentSlide + slider.cloneOffset) * cwidth;
            startX = (vertical) ? e.touches[0].pageY : e.touches[0].pageX;
            startY = (vertical) ? e.touches[0].pageX : e.touches[0].pageY;

            el.addEventListener('touchmove', onTouchMove, false);
            el.addEventListener('touchend', onTouchEnd, false);
          }
        }

        function onTouchMove(e) {
          dx = (vertical) ? startX - e.touches[0].pageY : startX - e.touches[0].pageX;
          scrolling = (vertical) ? (Math.abs(dx) < Math.abs(e.touches[0].pageX - startY)) : (Math.abs(dx) < Math.abs(e.touches[0].pageY - startY));

          if (!scrolling || Number(new Date()) - startT > 500) {
            e.preventDefault();
            if (!fade && slider.transitions) {
              if (!vars.animationLoop) {
                dx = dx/((slider.currentSlide === 0 && dx < 0 || slider.currentSlide === slider.last && dx > 0) ? (Math.abs(dx)/cwidth+2) : 1);
              }
              slider.setProps(offset + dx, "setTouch");
            }
          }
        }

        function onTouchEnd(e) {
          // finish the touch by undoing the touch session
          el.removeEventListener('touchmove', onTouchMove, false);

          if (slider.animatingTo === slider.currentSlide && !scrolling && !(dx === null)) {
            var updateDx = (reverse) ? -dx : dx,
                target = (updateDx > 0) ? slider.getTarget('next') : slider.getTarget('prev');

            if (slider.canAdvance(target) && (Number(new Date()) - startT < 550 && Math.abs(updateDx) > 50 || Math.abs(updateDx) > cwidth/2)) {
              slider.flexAnimate(target, vars.pauseOnAction);
            } else {
              if (!fade) slider.flexAnimate(slider.currentSlide, vars.pauseOnAction, true);
            }
          }
          el.removeEventListener('touchend', onTouchEnd, false);
          startX = null;
          startY = null;
          dx = null;
          offset = null;
        }
      },
      resize: function() {
        if (!slider.animating && slider.is(':visible')) {
          if (!carousel) slider.doMath();

          if (fade) {
            // SMOOTH HEIGHT:
            methods.smoothHeight();
          } else if (carousel) { //CAROUSEL:
            slider.slides.width(slider.computedW);
            slider.update(slider.pagingCount);
            slider.setProps();
          }
          else if (vertical) { //VERTICAL:
            slider.viewport.height(slider.h);
            slider.setProps(slider.h, "setTotal");
          } else {
            // SMOOTH HEIGHT:
            if (vars.smoothHeight) methods.smoothHeight();
            slider.newSlides.width(slider.computedW);
            slider.setProps(slider.computedW, "setTotal");
          }
        }
      },
      smoothHeight: function(dur) {
        if (!vertical || fade) {
          var $obj = (fade) ? slider : slider.viewport;
          (dur) ? $obj.animate({"height": slider.slides.eq(slider.animatingTo).height()}, dur) : $obj.height(slider.slides.eq(slider.animatingTo).height());
        }
      },
      sync: function(action) {
        var $obj = $(vars.sync).data("flexslider"),
            target = slider.animatingTo;

        switch (action) {
          case "animate": $obj.flexAnimate(target, vars.pauseOnAction, false, true); break;
          case "play": if (!$obj.playing && !$obj.asNav) { $obj.play(); } break;
          case "pause": $obj.pause(); break;
        }
      }
    }

    // public methods
    slider.flexAnimate = function(target, pause, override, withSync, fromNav) {
      if (asNav && slider.pagingCount === 1) slider.direction = (slider.currentItem < target) ? "next" : "prev";

      if (!slider.animating && (slider.canAdvance(target, fromNav) || override) && slider.is(":visible")) {
        if (asNav && withSync) {
          var master = $(vars.asNavFor).data('flexslider');
          slider.atEnd = target === 0 || target === slider.count - 1;
          master.flexAnimate(target, true, false, true, fromNav);
          slider.direction = (slider.currentItem < target) ? "next" : "prev";
          master.direction = slider.direction;

          if (Math.ceil((target + 1)/slider.visible) - 1 !== slider.currentSlide && target !== 0) {
            slider.currentItem = target;
            slider.slides.removeClass(namespace + "active-slide").eq(target).addClass(namespace + "active-slide");
            target = Math.floor(target/slider.visible);
          } else {
            slider.currentItem = target;
            slider.slides.removeClass(namespace + "active-slide").eq(target).addClass(namespace + "active-slide");
            return false;
          }
        }

        slider.animating = true;
        slider.animatingTo = target;
        // API: before() animation Callback
        vars.before(slider);

        // SLIDESHOW:
        if (pause) slider.pause();

        // SYNC:
        if (slider.syncExists && !fromNav) methods.sync("animate");

        // CONTROLNAV
        if (vars.controlNav) methods.controlNav.active();

        // !CAROUSEL:
        // CANDIDATE: slide active class (for add/remove slide)
        if (!carousel) slider.slides.removeClass(namespace + 'active-slide').eq(target).addClass(namespace + 'active-slide');

        // INFINITE LOOP:
        // CANDIDATE: atEnd
        slider.atEnd = target === 0 || target === slider.last;

        // DIRECTIONNAV:
        if (vars.directionNav) methods.directionNav.update();

        if (target === slider.last) {
          // API: end() of cycle Callback
          vars.end(slider);
          // SLIDESHOW && !INFINITE LOOP:
          if (!vars.animationLoop) slider.pause();
        }

        // SLIDE:
        if (!fade) {
          var dimension = (vertical) ? slider.slides.filter(':first').height() : slider.computedW,
              margin, slideString, calcNext;

          // INFINITE LOOP / REVERSE:
          if (carousel) {
            margin = (vars.itemWidth > slider.w) ? vars.itemMargin * 2 : vars.itemMargin;
            calcNext = ((slider.itemW + margin) * slider.move) * slider.animatingTo;
            slideString = (calcNext > slider.limit && slider.visible !== 1) ? slider.limit : calcNext;
          } else if (slider.currentSlide === 0 && target === slider.count - 1 && vars.animationLoop && slider.direction !== "next") {
            slideString = (reverse) ? (slider.count + slider.cloneOffset) * dimension : 0;
          } else if (slider.currentSlide === slider.last && target === 0 && vars.animationLoop && slider.direction !== "prev") {
            slideString = (reverse) ? 0 : (slider.count + 1) * dimension;
          } else {
            slideString = (reverse) ? ((slider.count - 1) - target + slider.cloneOffset) * dimension : (target + slider.cloneOffset) * dimension;
          }
          slider.setProps(slideString, "", vars.animationSpeed);
          if (slider.transitions) {
            if (!vars.animationLoop || !slider.atEnd) {
              slider.animating = false;
              slider.currentSlide = slider.animatingTo;
            }
            slider.container.unbind("webkitTransitionEnd transitionend");
            slider.container.bind("webkitTransitionEnd transitionend", function() {
              slider.wrapup(dimension);
            });
          } else {
            slider.container.animate(slider.args, vars.animationSpeed, vars.easing, function(){
              slider.wrapup(dimension);
            });
          }
        } else { // FADE:
          if (!touch) {
            slider.slides.eq(slider.currentSlide).fadeOut(vars.animationSpeed, vars.easing);
            slider.slides.eq(target).fadeIn(vars.animationSpeed, vars.easing, slider.wrapup);
          } else {
            slider.slides.eq(slider.currentSlide).css({ "opacity": 0, "zIndex": 1 });
            slider.slides.eq(target).css({ "opacity": 1, "zIndex": 2 });
            slider.animating = false;
            slider.currentSlide = slider.animatingTo;
          }
        }
        // SMOOTH HEIGHT:
        if (vars.smoothHeight) methods.smoothHeight(vars.animationSpeed);
      }
    }
    slider.wrapup = function(dimension) {
      // SLIDE:
      if (!fade && !carousel) {
        if (slider.currentSlide === 0 && slider.animatingTo === slider.last && vars.animationLoop) {
          slider.setProps(dimension, "jumpEnd");
        } else if (slider.currentSlide === slider.last && slider.animatingTo === 0 && vars.animationLoop) {
          slider.setProps(dimension, "jumpStart");
        }
      }
      slider.animating = false;
      slider.currentSlide = slider.animatingTo;
      // API: after() animation Callback
      vars.after(slider);
    }

    // SLIDESHOW:
    slider.animateSlides = function() {
      if (!slider.animating) slider.flexAnimate(slider.getTarget("next"));
    }
    // SLIDESHOW:
    slider.pause = function() {
      clearInterval(slider.animatedSlides);
      slider.playing = false;
      // PAUSEPLAY:
      if (vars.pausePlay) methods.pausePlay.update("play");
      // SYNC:
      if (slider.syncExists) methods.sync("pause");
    }
    // SLIDESHOW:
    slider.play = function() {
      slider.animatedSlides = setInterval(slider.animateSlides, vars.slideshowSpeed);
      slider.playing = true;
      // PAUSEPLAY:
      if (vars.pausePlay) methods.pausePlay.update("pause");
      // SYNC:
      if (slider.syncExists) methods.sync("play");
    }
    slider.canAdvance = function(target, fromNav) {
      // ASNAV:
      var last = (asNav) ? slider.pagingCount - 1 : slider.last;
      return (fromNav) ? true :
             (asNav && slider.currentItem === slider.count - 1 && target === 0 && slider.direction === "prev") ? true :
             (asNav && slider.currentItem === 0 && target === slider.pagingCount - 1 && slider.direction !== "next") ? false :
             (target === slider.currentSlide && !asNav) ? false :
             (vars.animationLoop) ? true :
             (slider.atEnd && slider.currentSlide === 0 && target === last && slider.direction !== "next") ? false :
             (slider.atEnd && slider.currentSlide === last && target === 0 && slider.direction === "next") ? false :
             true;
    }
    slider.getTarget = function(dir) {
      slider.direction = dir;
      if (dir === "next") {
        return (slider.currentSlide === slider.last) ? 0 : slider.currentSlide + 1;
      } else {
        return (slider.currentSlide === 0) ? slider.last : slider.currentSlide - 1;
      }
    }

    // SLIDE:
    slider.setProps = function(pos, special, dur) {
      var target = (function() {
        var posCheck = (pos) ? pos : ((slider.itemW + vars.itemMargin) * slider.move) * slider.animatingTo,
            posCalc = (function() {
              if (carousel) {
                return (special === "setTouch") ? pos :
                       (reverse && slider.animatingTo === slider.last) ? 0 :
                       (reverse) ? slider.limit - (((slider.itemW + vars.itemMargin) * slider.move) * slider.animatingTo) :
                       (slider.animatingTo === slider.last) ? slider.limit : posCheck;
              } else {
                switch (special) {
                  case "setTotal": return (reverse) ? ((slider.count - 1) - slider.currentSlide + slider.cloneOffset) * pos : (slider.currentSlide + slider.cloneOffset) * pos;
                  case "setTouch": return (reverse) ? pos : pos;
                  case "jumpEnd": return (reverse) ? pos : slider.count * pos;
                  case "jumpStart": return (reverse) ? slider.count * pos : pos;
                  default: return pos;
                }
              }
            }());
            return (posCalc * -1) + "px";
          }());

      if (slider.transitions) {
        target = (vertical) ? "translate3d(0," + target + ",0)" : "translate3d(" + target + ",0,0)";
        dur = (dur !== undefined) ? (dur/1000) + "s" : "0s";
        slider.container.css("-" + slider.pfx + "-transition-duration", dur);
      }

      slider.args[slider.prop] = target;
      if (slider.transitions || dur === undefined) slider.container.css(slider.args);
    }

    slider.setup = function(type) {
      // SLIDE:
      if (!fade) {
        var sliderOffset, arr;

        if (type === "init") {
          slider.viewport = $('<div class="' + namespace + 'viewport"></div>').css({"overflow": "hidden", "position": "relative"}).appendTo(slider).append(slider.container);
          // INFINITE LOOP:
          slider.cloneCount = 0;
          slider.cloneOffset = 0;
          // REVERSE:
          if (reverse) {
            arr = $.makeArray(slider.slides).reverse();
            slider.slides = $(arr);
            slider.container.empty().append(slider.slides);
          }
        }
        // INFINITE LOOP && !CAROUSEL:
        if (vars.animationLoop && !carousel) {
          slider.cloneCount = 2;
          slider.cloneOffset = 1;
          // clear out old clones
          if (type !== "init") slider.container.find('.clone').remove();
          slider.container.append(slider.slides.first().clone().addClass('clone')).prepend(slider.slides.last().clone().addClass('clone'));
        }
        slider.newSlides = $(vars.selector, slider);

        sliderOffset = (reverse) ? slider.count - 1 - slider.currentSlide + slider.cloneOffset : slider.currentSlide + slider.cloneOffset;
        // VERTICAL:
        if (vertical && !carousel) {
          slider.container.height((slider.count + slider.cloneCount) * 200 + "%").css("position", "absolute").width("100%");
          setTimeout(function(){
            slider.newSlides.css({"display": "block"});
            slider.doMath();
            slider.viewport.height(slider.h);
            slider.setProps(sliderOffset * slider.h, "init");
          }, (type === "init") ? 100 : 0);
        } else {
          slider.container.width((slider.count + slider.cloneCount) * 200 + "%");
          slider.setProps(sliderOffset * slider.computedW, "init");
          setTimeout(function(){
            slider.doMath();
            slider.newSlides.css({"width": slider.computedW, "float": "left", "display": "block"});
            // SMOOTH HEIGHT:
            if (vars.smoothHeight) methods.smoothHeight();
          }, (type === "init") ? 100 : 0);
        }
      } else { // FADE:
        slider.slides.css({"width": "100%", "float": "left", "marginRight": "-100%", "position": "relative"});
        if (type === "init") {
          if (!touch) {
            slider.slides.eq(slider.currentSlide).fadeIn(vars.animationSpeed, vars.easing);
          } else {
            slider.slides.css({ "opacity": 0, "display": "block", "webkitTransition": "opacity " + vars.animationSpeed / 1000 + "s ease", "zIndex": 1 }).eq(slider.currentSlide).css({ "opacity": 1, "zIndex": 2});
          }
        }
        // SMOOTH HEIGHT:
        if (vars.smoothHeight) methods.smoothHeight();
      }
      // !CAROUSEL:
      // CANDIDATE: active slide
      if (!carousel) slider.slides.removeClass(namespace + "active-slide").eq(slider.currentSlide).addClass(namespace + "active-slide");
    }

    slider.doMath = function() {
      var slide = slider.slides.first(),
          slideMargin = vars.itemMargin,
          minItems = vars.minItems,
          maxItems = vars.maxItems;

      slider.w = slider.width();
      slider.h = slide.height();
      slider.boxPadding = slide.outerWidth() - slide.width();

      // CAROUSEL:
      if (carousel) {
        slider.itemT = vars.itemWidth + slideMargin;
        slider.minW = (minItems) ? minItems * slider.itemT : slider.w;
        slider.maxW = (maxItems) ? maxItems * slider.itemT : slider.w;
        slider.itemW = (slider.minW > slider.w) ? (slider.w - (slideMargin * minItems))/minItems :
                       (slider.maxW < slider.w) ? (slider.w - (slideMargin * maxItems))/maxItems :
                       (vars.itemWidth > slider.w) ? slider.w : vars.itemWidth;
        slider.visible = Math.floor(slider.w/(slider.itemW + slideMargin));
        slider.move = (vars.move > 0 && vars.move < slider.visible ) ? vars.move : slider.visible;
        slider.pagingCount = Math.ceil(((slider.count - slider.visible)/slider.move) + 1);
        slider.last =  slider.pagingCount - 1;
        slider.limit = (slider.pagingCount === 1) ? 0 :
                       (vars.itemWidth > slider.w) ? ((slider.itemW + (slideMargin * 2)) * slider.count) - slider.w - slideMargin : ((slider.itemW + slideMargin) * slider.count) - slider.w - slideMargin;
      } else {
        slider.itemW = slider.w;
        slider.pagingCount = slider.count;
        slider.last = slider.count - 1;
      }
      slider.computedW = slider.itemW - slider.boxPadding;
    }

    slider.update = function(pos, action) {
      slider.doMath();

      // update currentSlide and slider.animatingTo if necessary
      if (!carousel) {
        if (pos < slider.currentSlide) {
          slider.currentSlide += 1;
        } else if (pos <= slider.currentSlide && pos !== 0) {
          slider.currentSlide -= 1;
        }
        slider.animatingTo = slider.currentSlide;
      }

      // update controlNav
      if (vars.controlNav && !slider.manualControls) {
        if ((action === "add" && !carousel) || slider.pagingCount > slider.controlNav.length) {
          methods.controlNav.update("add");
        } else if ((action === "remove" && !carousel) || slider.pagingCount < slider.controlNav.length) {
          if (carousel && slider.currentSlide > slider.last) {
            slider.currentSlide -= 1;
            slider.animatingTo -= 1;
          }
          methods.controlNav.update("remove", slider.last);
        }
      }
      // update directionNav
      if (vars.directionNav) methods.directionNav.update();

    }

    slider.addSlide = function(obj, pos) {
      var $obj = $(obj);

      slider.count += 1;
      slider.last = slider.count - 1;

      // append new slide
      if (vertical && reverse) {
        (pos !== undefined) ? slider.slides.eq(slider.count - pos).after($obj) : slider.container.prepend($obj);
      } else {
        (pos !== undefined) ? slider.slides.eq(pos).before($obj) : slider.container.append($obj);
      }

      // update currentSlide, animatingTo, controlNav, and directionNav
      slider.update(pos, "add");

      // update slider.slides
      slider.slides = $(vars.selector + ':not(.clone)', slider);
      // re-setup the slider to accomdate new slide
      slider.setup();

      //FlexSlider: added() Callback
      vars.added(slider);
    }
    slider.removeSlide = function(obj) {
      var pos = (isNaN(obj)) ? slider.slides.index($(obj)) : obj;

      // update count
      slider.count -= 1;
      slider.last = slider.count - 1;

      // remove slide
      if (isNaN(obj)) {
        $(obj, slider.slides).remove();
      } else {
        (vertical && reverse) ? slider.slides.eq(slider.last).remove() : slider.slides.eq(obj).remove();
      }

      // update currentSlide, animatingTo, controlNav, and directionNav
      slider.doMath();
      slider.update(pos, "remove");

      // update slider.slides
      slider.slides = $(vars.selector + ':not(.clone)', slider);
      // re-setup the slider to accomdate new slide
      slider.setup();

      // FlexSlider: removed() Callback
      vars.removed(slider);
    }

    //FlexSlider: Initialize
    methods.init();
  }

  //FlexSlider: Default Settings
  $.flexslider.defaults = {
    namespace: "flex-",             //{NEW} String: Prefix string attached to the class of every element generated by the plugin
    selector: ".slides > li",       //{NEW} Selector: Must match a simple pattern. '{container} > {slide}' -- Ignore pattern at your own peril
    animation: "fade",              //String: Select your animation type, "fade" or "slide"
    easing: "swing",               //{NEW} String: Determines the easing method used in jQuery transitions. jQuery easing plugin is supported!
    direction: "horizontal",        //String: Select the sliding direction, "horizontal" or "vertical"
    reverse: false,                 //{NEW} Boolean: Reverse the animation direction
    animationLoop: true,             //Boolean: Should the animation loop? If false, directionNav will received "disable" classes at either end
    smoothHeight: false,            //{NEW} Boolean: Allow height of the slider to animate smoothly in horizontal mode
    startAt: 0,                     //Integer: The slide that the slider should start on. Array notation (0 = first slide)
    slideshow: true,                //Boolean: Animate slider automatically
    slideshowSpeed: 7000,           //Integer: Set the speed of the slideshow cycling, in milliseconds
    animationSpeed: 600,            //Integer: Set the speed of animations, in milliseconds
    initDelay: 0,                   //{NEW} Integer: Set an initialization delay, in milliseconds
    randomize: false,               //Boolean: Randomize slide order

    // Usability features
    pauseOnAction: true,            //Boolean: Pause the slideshow when interacting with control elements, highly recommended.
    pauseOnHover: false,            //Boolean: Pause the slideshow when hovering over slider, then resume when no longer hovering
    useCSS: true,                   //{NEW} Boolean: Slider will use CSS3 transitions if available
    touch: true,                    //{NEW} Boolean: Allow touch swipe navigation of the slider on touch-enabled devices
    video: false,                   //{NEW} Boolean: If using video in the slider, will prevent CSS3 3D Transforms to avoid graphical glitches

    // Primary Controls
    controlNav: true,               //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
    directionNav: true,             //Boolean: Create navigation for previous/next navigation? (true/false)
    prevText: "Previous",           //String: Set the text for the "previous" directionNav item
    nextText: "Next",               //String: Set the text for the "next" directionNav item
    directionNavArrowsLeft : '<i class="mk-theme-icon-prev-big"></i>',
    directionNavArrowsRight : '<i class="mk-theme-icon-next-big"></i>',

    // Secondary Navigation
    keyboard: true,                 //Boolean: Allow slider navigating via keyboard left/right keys
    multipleKeyboard: false,        //{NEW} Boolean: Allow keyboard navigation to affect multiple sliders. Default behavior cuts out keyboard navigation with more than one slider present.
    mousewheel: false,              //{UPDATED} Boolean: Requires jquery.mousewheel.js (https://github.com/brandonaaron/jquery-mousewheel) - Allows slider navigating via mousewheel
    pausePlay: false,               //Boolean: Create pause/play dynamic element
    pauseText: "Pause",             //String: Set the text for the "pause" pausePlay item
    playText: "Play",               //String: Set the text for the "play" pausePlay item

    // Special properties
    controlsContainer: "",          //{UPDATED} jQuery Object/Selector: Declare which container the navigation elements should be appended too. Default container is the FlexSlider element. Example use would be $(".flexslider-container"). Property is ignored if given element is not found.
    manualControls: "",             //{UPDATED} jQuery Object/Selector: Declare custom control navigation. Examples would be $(".flex-control-nav li") or "#tabs-nav li img", etc. The number of elements in your controlNav should match the number of slides/tabs.
    sync: "",                       //{NEW} Selector: Mirror the actions performed on this slider with another slider. Use with care.
    asNavFor: "",                   //{NEW} Selector: Internal property exposed for turning the slider into a thumbnail navigation for another slider

    // Carousel Options
    itemWidth: 0,                   //{NEW} Integer: Box-model width of individual carousel items, including horizontal borders and padding.
    itemMargin: 0,                  //{NEW} Integer: Margin between carousel items.
    minItems: 0,                    //{NEW} Integer: Minimum number of carousel items that should be visible. Items will resize fluidly when below this.
    maxItems: 0,                    //{NEW} Integer: Maxmimum number of carousel items that should be visible. Items will resize fluidly when above this limit.
    move: 0,                        //{NEW} Integer: Number of carousel items that should move on animation. If 0, slider will move all visible items.

    // Callback API
    start: function(){},            //Callback: function(slider) - Fires when the slider loads the first slide
    before: function(){},           //Callback: function(slider) - Fires asynchronously with each slider animation
    after: function(){},            //Callback: function(slider) - Fires after each slider animation completes
    end: function(){},              //Callback: function(slider) - Fires when the slider reaches the last slide (asynchronous)
    added: function(){},            //{NEW} Callback: function(slider) - Fires after a slide is added
    removed: function(){}           //{NEW} Callback: function(slider) - Fires after a slide is removed
  }


  //FlexSlider: Plugin Function
  $.fn.flexslider = function(options) {
    if (options === undefined) options = {};

    if (typeof options === "object") {
      return this.each(function() {
        var $this = $(this),
            selector = (options.selector) ? options.selector : ".slides > li",
            $slides = $this.find(selector);

        if ($slides.length === 1) {
          $slides.fadeIn(400);
          if (options.start) options.start($this);
        } else if ($this.data('flexslider') === undefined) {
          new $.flexslider(this, options);
        }
      });
    } else {
      // Helper strings to quickly perform functions on the slider
      var $slider = $(this).data('flexslider');
      switch (options) {
        case "play": $slider.play(); break;
        case "pause": $slider.pause(); break;
        case "next": $slider.flexAnimate($slider.getTarget("next"), true); break;
        case "prev":
        case "previous": $slider.flexAnimate($slider.getTarget("prev"), true); break;
        default: if (typeof options === "number") $slider.flexAnimate(options, true);
      }
    }
  }

})(jQuery);

;/*! waitForImages jQuery Plugin - v1.5.0 - 2013-07-20
 * https://github.com/alexanderdickson/waitForImages
 * Copyright (c) 2013 Alex Dickson; Licensed MIT */
(function($) {
    var o = 'waitForImages';
    $.waitForImages = {
        hasImageProperties: ['backgroundImage', 'listStyleImage', 'borderImage', 'borderCornerImage', 'cursor']
    };
    $.expr[':'].uncached = function(a) {
        if (!$(a).is('img[src!=""]')) {
            return false
        }
        var b = new Image();
        b.src = a.src;
        return !b.complete
    };
    $.fn.waitForImages = function(j, k, l) {
        var m = 0;
        var n = 0;
        if ($.isPlainObject(arguments[0])) {
            l = arguments[0].waitForAll;
            k = arguments[0].each;
            j = arguments[0].finished
        }
        j = j || $.noop;
        k = k || $.noop;
        l = !! l;
        if (!$.isFunction(j) || !$.isFunction(k)) {
            throw new TypeError('An invalid callback was supplied.');
        }
        return this.each(function() {
            var e = $(this);
            var f = [];
            var g = $.waitForImages.hasImageProperties || [];
            var h = /url\(\s*(['"]?)(.*?)\1\s*\)/g;
            if (l) {
                e.find('*').addBack().each(function() {
                    var d = $(this);
                    if (d.is('img:uncached')) {
                        f.push({
                            src: d.attr('src'),
                            element: d[0]
                        })
                    }
                    $.each(g, function(i, a) {
                        var b = d.css(a);
                        var c;
                        if (!b) {
                            return true
                        }
                        while (c = h.exec(b)) {
                            f.push({
                                src: c[2],
                                element: d[0]
                            })
                        }
                    })
                })
            } else {
                e.find('img:uncached').each(function() {
                    f.push({
                        src: this.src,
                        element: this
                    })
                })
            }
            m = f.length;
            n = 0;
            if (m === 0) {
                j.call(e[0])
            }
            $.each(f, function(i, b) {
                var c = new Image();
                $(c).on('load.' + o + ' error.' + o, function(a) {
                    n++;
                    k.call(b.element, n, m, a.type == 'load');
                    if (n == m) {
                        j.call(e[0]);
                        return false
                    }
                });
                c.src = b.src
            })
        })
    }
}(jQuery));



;/**
 * Isotope v1.5.19
 * An exquisite jQuery plugin for magical layouts
 * http://isotope.metafizzy.co
 *
 * Commercial use requires one-time license fee
 * http://metafizzy.co/#licenses
 *
 * Copyright 2012 David DeSandro / Metafizzy
 */
(function(a, b, c) {
    "use strict";
    var d = a.document,
        e = a.Modernizr,
        f = function(a) {
            return a.charAt(0).toUpperCase() + a.slice(1)
        },
        g = "Moz Webkit O Ms".split(" "),
        h = function(a) {
            var b = d.documentElement.style,
                c;
            if (typeof b[a] == "string") return a;
            a = f(a);
            for (var e = 0, h = g.length; e < h; e++) {
                c = g[e] + a;
                if (typeof b[c] == "string") return c
            }
        },
        i = h("transform"),
        j = h("transitionProperty"),
        k = {
            csstransforms: function() {
                return !!i
            },
            csstransforms3d: function() {
                var a = !!h("perspective");
                if (a) {
                    var c = " -o- -moz- -ms- -webkit- -khtml- ".split(" "),
                        d = "@media (" + c.join("transform-3d),(") + "modernizr)",
                        e = b("<style>" + d + "{#modernizr{height:3px}}" + "</style>").appendTo("head"),
                        f = b('<div id="modernizr" />').appendTo("html");
                    a = f.height() === 3, f.remove(), e.remove()
                }
                return a
            },
            csstransitions: function() {
                return !!j
            }
        },
        l;
    if (e)
        for (l in k) e.hasOwnProperty(l) || e.addTest(l, k[l]);
    else {
        e = a.Modernizr = {
            _version: "1.6ish: miniModernizr for Isotope"
        };
        var m = " ",
            n;
        for (l in k) n = k[l](), e[l] = n, m += " " + (n ? "" : "no-") + l;
        b("html").addClass(m)
    }
    if (e.csstransforms) {
        var o = e.csstransforms3d ? {
                translate: function(a) {
                    return "translate3d(" + a[0] + "px, " + a[1] + "px, 0) "
                },
                scale: function(a) {
                    return "scale3d(" + a + ", " + a + ", 1) "
                }
            } : {
                translate: function(a) {
                    return "translate(" + a[0] + "px, " + a[1] + "px) "
                },
                scale: function(a) {
                    return "scale(" + a + ") "
                }
            },
            p = function(a, c, d) {
                var e = b.data(a, "isoTransform") || {},
                    f = {},
                    g, h = {},
                    j;
                f[c] = d, b.extend(e, f);
                for (g in e) j = e[g], h[g] = o[g](j);
                var k = h.translate || "",
                    l = h.scale || "",
                    m = k + l;
                b.data(a, "isoTransform", e), a.style[i] = m
            };
        b.cssNumber.scale = !0, b.cssHooks.scale = {
            set: function(a, b) {
                p(a, "scale", b)
            },
            get: function(a, c) {
                var d = b.data(a, "isoTransform");
                return d && d.scale ? d.scale : 1
            }
        }, b.fx.step.scale = function(a) {
            b.cssHooks.scale.set(a.elem, a.now + a.unit)
        }, b.cssNumber.translate = !0, b.cssHooks.translate = {
            set: function(a, b) {
                p(a, "translate", b)
            },
            get: function(a, c) {
                var d = b.data(a, "isoTransform");
                return d && d.translate ? d.translate : [0, 0]
            }
        }
    }
    var q, r;
    e.csstransitions && (q = {
        WebkitTransitionProperty: "webkitTransitionEnd",
        MozTransitionProperty: "transitionend",
        OTransitionProperty: "oTransitionEnd",
        transitionProperty: "transitionEnd"
    }[j], r = h("transitionDuration"));
    var s = b.event,
        t;
    s.special.smartresize = {
        setup: function() {
            b(this).bind("resize", s.special.smartresize.handler)
        },
        teardown: function() {
            b(this).unbind("resize", s.special.smartresize.handler)
        },
        handler: function(a, b) {
            var c = this,
                d = arguments;
            a.type = "smartresize", t && clearTimeout(t), t = setTimeout(function() {
                jQuery.event.handle.apply(c, d)
            }, b === "execAsap" ? 0 : 100)
        }
    }, b.fn.smartresize = function(a) {
        return a ? this.bind("smartresize", a) : this.trigger("smartresize", ["execAsap"])
    }, b.Isotope = function(a, c, d) {
        this.element = b(c), this._create(a), this._init(d)
    };
    var u = ["width", "height"],
        v = b(a);
    b.Isotope.settings = {
        resizable: !0,
        layoutMode: "masonry",
        containerClass: "isotope",
        itemClass: "isotope-item",
        hiddenClass: "isotope-hidden",
        hiddenStyle: {
            opacity: 0,
            scale: .001
        },
        visibleStyle: {
            opacity: 1,
            scale: 1
        },
        containerStyle: {
            position: "relative",
            overflow: "hidden"
        },
        animationEngine: "best-available",
        animationOptions: {
            queue: !1,
            duration: 800
        },
        sortBy: "original-order",
        sortAscending: !0,
        resizesContainer: !0,
        transformsEnabled: !b.browser.opera,
        itemPositionDataEnabled: !1
    }, b.Isotope.prototype = {
        _create: function(a) {
            this.options = b.extend({}, b.Isotope.settings, a), this.styleQueue = [], this.elemCount = 0;
            var c = this.element[0].style;
            this.originalStyle = {};
            var d = u.slice(0);
            for (var e in this.options.containerStyle) d.push(e);
            for (var f = 0, g = d.length; f < g; f++) e = d[f], this.originalStyle[e] = c[e] || "";
            this.element.css(this.options.containerStyle), this._updateAnimationEngine(), this._updateUsingTransforms();
            var h = {
                "original-order": function(a, b) {
                    return b.elemCount++, b.elemCount
                },
                random: function() {
                    return Math.random()
                }
            };
            this.options.getSortData = b.extend(this.options.getSortData, h), this.reloadItems(), this.offset = {
                left: parseInt(this.element.css("padding-left") || 0, 10),
                top: parseInt(this.element.css("padding-top") || 0, 10)
            };
            var i = this;
            setTimeout(function() {
                i.element.addClass(i.options.containerClass)
            }, 0), this.options.resizable && v.bind("smartresize.isotope", function() {
                i.resize()
            }), this.element.delegate("." + this.options.hiddenClass, "click", function() {
                return !1
            })
        },
        _getAtoms: function(a) {
            var b = this.options.itemSelector,
                c = b ? a.filter(b).add(a.find(b)) : a,
                d = {
                    position: "absolute"
                };
            return this.usingTransforms && (d.left = 0, d.top = 0), c.css(d).addClass(this.options.itemClass), this.updateSortData(c, !0), c
        },
        _init: function(a) {
            this.$filteredAtoms = this._filter(this.$allAtoms), this._sort(), this.reLayout(a)
        },
        option: function(a) {
            if (b.isPlainObject(a)) {
                this.options = b.extend(!0, this.options, a);
                var c;
                for (var d in a) c = "_update" + f(d), this[c] && this[c]()
            }
        },
        _updateAnimationEngine: function() {
            var a = this.options.animationEngine.toLowerCase().replace(/[ _\-]/g, ""),
                b;
            switch (a) {
                case "css":
                case "none":
                    b = !1;
                    break;
                case "jquery":
                    b = !0;
                    break;
                default:
                    b = !e.csstransitions
            }
            this.isUsingJQueryAnimation = b, this._updateUsingTransforms()
        },
        _updateTransformsEnabled: function() {
            this._updateUsingTransforms()
        },
        _updateUsingTransforms: function() {
            var a = this.usingTransforms = this.options.transformsEnabled && e.csstransforms && e.csstransitions && !this.isUsingJQueryAnimation;
            a || (delete this.options.hiddenStyle.scale, delete this.options.visibleStyle.scale), this.getPositionStyles = a ? this._translate : this._positionAbs
        },
        _filter: function(a) {
            var b = this.options.filter === "" ? "*" : this.options.filter;
            if (!b) return a;
            var c = this.options.hiddenClass,
                d = "." + c,
                e = a.filter(d),
                f = e;
            if (b !== "*") {
                f = e.filter(b);
                var g = a.not(d).not(b).addClass(c);
                this.styleQueue.push({
                    $el: g,
                    style: this.options.hiddenStyle
                })
            }
            return this.styleQueue.push({
                $el: f,
                style: this.options.visibleStyle
            }), f.removeClass(c), a.filter(b)
        },
        updateSortData: function(a, c) {
            var d = this,
                e = this.options.getSortData,
                f, g;
            a.each(function() {
                f = b(this), g = {};
                for (var a in e) !c && a === "original-order" ? g[a] = b.data(this, "isotope-sort-data")[a] : g[a] = e[a](f, d);
                b.data(this, "isotope-sort-data", g)
            })
        },
        _sort: function() {
            var a = this.options.sortBy,
                b = this._getSorter,
                c = this.options.sortAscending ? 1 : -1,
                d = function(d, e) {
                    var f = b(d, a),
                        g = b(e, a);
                    return f === g && a !== "original-order" && (f = b(d, "original-order"), g = b(e, "original-order")), (f > g ? 1 : f < g ? -1 : 0) * c
                };
            this.$filteredAtoms.sort(d)
        },
        _getSorter: function(a, c) {
            return b.data(a, "isotope-sort-data")[c]
        },
        _translate: function(a, b) {
            return {
                translate: [a, b]
            }
        },
        _positionAbs: function(a, b) {
            return {
                left: a,
                top: b
            }
        },
        _pushPosition: function(a, b, c) {
            b = Math.round(b + this.offset.left), c = Math.round(c + this.offset.top);
            var d = this.getPositionStyles(b, c);
            this.styleQueue.push({
                $el: a,
                style: d
            }), this.options.itemPositionDataEnabled && a.data("isotope-item-position", {
                x: b,
                y: c
            })
        },
        layout: function(a, b) {
            var c = this.options.layoutMode;
            this["_" + c + "Layout"](a);
            if (this.options.resizesContainer) {
                var d = this["_" + c + "GetContainerSize"]();
                this.styleQueue.push({
                    $el: this.element,
                    style: d
                })
            }
            this._processStyleQueue(a, b), this.isLaidOut = !0
        },
        _processStyleQueue: function(a, c) {
            var d = this.isLaidOut ? this.isUsingJQueryAnimation ? "animate" : "css" : "css",
                f = this.options.animationOptions,
                g = this.options.onLayout,
                h, i, j, k;
            i = function(a, b) {
                b.$el[d](b.style, f)
            };
            if (this._isInserting && this.isUsingJQueryAnimation) i = function(a, b) {
                h = b.$el.hasClass("no-transition") ? "css" : d, b.$el[h](b.style, f)
            };
            else if (c || g || f.complete) {
                var l = !1,
                    m = [c, g, f.complete],
                    n = this;
                j = !0, k = function() {
                    if (l) return;
                    var b;
                    for (var c = 0, d = m.length; c < d; c++) b = m[c], typeof b == "function" && b.call(n.element, a, n);
                    l = !0
                };
                if (this.isUsingJQueryAnimation && d === "animate") f.complete = k, j = !1;
                else if (e.csstransitions) {
                    var o = 0,
                        p = this.styleQueue[0],
                        s = p && p.$el,
                        t;
                    while (!s || !s.length) {
                        t = this.styleQueue[o++];
                        if (!t) return;
                        s = t.$el
                    }
                    var u = parseFloat(getComputedStyle(s[0])[r]);
                    u > 0 && (i = function(a, b) {
                        b.$el[d](b.style, f).one(q, k)
                    }, j = !1)
                }
            }
            b.each(this.styleQueue, i), j && k(), this.styleQueue = []
        },
        resize: function() {
            this["_" + this.options.layoutMode + "ResizeChanged"]() && this.reLayout()
        },
        reLayout: function(a) {
            this["_" + this.options.layoutMode + "Reset"](), this.layout(this.$filteredAtoms, a)
        },
        addItems: function(a, b) {
            var c = this._getAtoms(a);
            this.$allAtoms = this.$allAtoms.add(c), b && b(c)
        },
        insert: function(a, b) {
            this.element.append(a);
            var c = this;
            this.addItems(a, function(a) {
                var d = c._filter(a);
                c._addHideAppended(d), c._sort(), c.reLayout(), c._revealAppended(d, b)
            })
        },
        appended: function(a, b) {
            var c = this;
            this.addItems(a, function(a) {
                c._addHideAppended(a), c.layout(a), c._revealAppended(a, b)
            })
        },
        _addHideAppended: function(a) {
            this.$filteredAtoms = this.$filteredAtoms.add(a), a.addClass("no-transition"), this._isInserting = !0, this.styleQueue.push({
                $el: a,
                style: this.options.hiddenStyle
            })
        },
        _revealAppended: function(a, b) {
            var c = this;
            setTimeout(function() {
                a.removeClass("no-transition"), c.styleQueue.push({
                    $el: a,
                    style: c.options.visibleStyle
                }), c._isInserting = !1, c._processStyleQueue(a, b)
            }, 10)
        },
        reloadItems: function() {
            this.$allAtoms = this._getAtoms(this.element.children())
        },
        remove: function(a, b) {
            var c = this,
                d = function() {
                    c.$allAtoms = c.$allAtoms.not(a), a.remove(), b && b.call(c.element)
                };
            a.filter(":not(." + this.options.hiddenClass + ")").length ? (this.styleQueue.push({
                $el: a,
                style: this.options.hiddenStyle
            }), this.$filteredAtoms = this.$filteredAtoms.not(a), this._sort(), this.reLayout(d)) : d()
        },
        shuffle: function(a) {
            this.updateSortData(this.$allAtoms), this.options.sortBy = "random", this._sort(), this.reLayout(a)
        },
        destroy: function() {
            var a = this.usingTransforms,
                b = this.options;
            this.$allAtoms.removeClass(b.hiddenClass + " " + b.itemClass).each(function() {
                var b = this.style;
                b.position = "", b.top = "", b.left = "", b.opacity = "", a && (b[i] = "")
            });
            var c = this.element[0].style;
            for (var d in this.originalStyle) c[d] = this.originalStyle[d];
            this.element.unbind(".isotope").undelegate("." + b.hiddenClass, "click").removeClass(b.containerClass).removeData("isotope"), v.unbind(".isotope")
        },
        _getSegments: function(a) {
            var b = this.options.layoutMode,
                c = a ? "rowHeight" : "columnWidth",
                d = a ? "height" : "width",
                e = a ? "rows" : "cols",
                g = this.element[d](),
                h, i = this.options[b] && this.options[b][c] || this.$filteredAtoms["outer" + f(d)](!0) || g;
            h = Math.floor(g / i), h = Math.max(h, 1), this[b][e] = h, this[b][c] = i
        },
        _checkIfSegmentsChanged: function(a) {
            var b = this.options.layoutMode,
                c = a ? "rows" : "cols",
                d = this[b][c];
            return this._getSegments(a), this[b][c] !== d
        },
        _masonryReset: function() {
            this.masonry = {}, this._getSegments();
            var a = this.masonry.cols;
            this.masonry.colYs = [];
            while (a--) this.masonry.colYs.push(0)
        },
        _masonryLayout: function(a) {
            var c = this,
                d = c.masonry;
            if(typeof a === 'undefined') return;
            a.each(function() {
                var a = b(this),
                    e = Math.ceil(a.outerWidth(!0) / d.columnWidth);
                e = Math.min(e, d.cols);
                if (e === 1) c._masonryPlaceBrick(a, d.colYs);
                else {
                    var f = d.cols + 1 - e,
                        g = [],
                        h, i;
                    for (i = 0; i < f; i++) h = d.colYs.slice(i, i + e), g[i] = Math.max.apply(Math, h);
                    c._masonryPlaceBrick(a, g)
                }
            })
        },
        _masonryPlaceBrick: function(a, b) {
            var c = Math.min.apply(Math, b),
                d = 0;
            for (var e = 0, f = b.length; e < f; e++)
                if (b[e] === c) {
                    d = e;
                    break
                }
            var g = this.masonry.columnWidth * d,
                h = c;
            this._pushPosition(a, g, h);
            var i = c + a.outerHeight(!0),
                j = this.masonry.cols + 1 - f;
            for (e = 0; e < j; e++) this.masonry.colYs[d + e] = i
        },
        _masonryGetContainerSize: function() {
            var a = Math.max.apply(Math, this.masonry.colYs);
            return {
                height: a
            }
        },
        _masonryResizeChanged: function() {
            return this._checkIfSegmentsChanged()
        },
        _fitRowsReset: function() {
            this.fitRows = {
                x: 0,
                y: 0,
                height: 0
            }
        },
        _fitRowsLayout: function(a) {
            var c = this,
                d = this.element.width(),
                e = this.fitRows;
            a.each(function() {
                var a = b(this),
                    f = a.outerWidth(!0),
                    g = a.outerHeight(!0);
                e.x !== 0 && f + e.x > d && (e.x = 0, e.y = e.height), c._pushPosition(a, e.x, e.y), e.height = Math.max(e.y + g, e.height), e.x += f
            })
        },
        _fitRowsGetContainerSize: function() {
            return {
                height: this.fitRows.height
            }
        },
        _fitRowsResizeChanged: function() {
            return !0
        },
        _cellsByRowReset: function() {
            this.cellsByRow = {
                index: 0
            }, this._getSegments(), this._getSegments(!0)
        },
        _cellsByRowLayout: function(a) {
            var c = this,
                d = this.cellsByRow;
            a.each(function() {
                var a = b(this),
                    e = d.index % d.cols,
                    f = Math.floor(d.index / d.cols),
                    g = (e + .5) * d.columnWidth - a.outerWidth(!0) / 2,
                    h = (f + .5) * d.rowHeight - a.outerHeight(!0) / 2;
                c._pushPosition(a, g, h), d.index++
            })
        },
        _cellsByRowGetContainerSize: function() {
            return {
                height: Math.ceil(this.$filteredAtoms.length / this.cellsByRow.cols) * this.cellsByRow.rowHeight + this.offset.top
            }
        },
        _cellsByRowResizeChanged: function() {
            return this._checkIfSegmentsChanged()
        },
        _straightDownReset: function() {
            this.straightDown = {
                y: 0
            }
        },
        _straightDownLayout: function(a) {
            var c = this;
            a.each(function(a) {
                var d = b(this);
                c._pushPosition(d, 0, c.straightDown.y), c.straightDown.y += d.outerHeight(!0)
            })
        },
        _straightDownGetContainerSize: function() {
            return {
                height: this.straightDown.y
            }
        },
        _straightDownResizeChanged: function() {
            return !0
        },
        _masonryHorizontalReset: function() {
            this.masonryHorizontal = {}, this._getSegments(!0);
            var a = this.masonryHorizontal.rows;
            this.masonryHorizontal.rowXs = [];
            while (a--) this.masonryHorizontal.rowXs.push(0)
        },
        _masonryHorizontalLayout: function(a) {
            var c = this,
                d = c.masonryHorizontal;
            a.each(function() {
                var a = b(this),
                    e = Math.ceil(a.outerHeight(!0) / d.rowHeight);
                e = Math.min(e, d.rows);
                if (e === 1) c._masonryHorizontalPlaceBrick(a, d.rowXs);
                else {
                    var f = d.rows + 1 - e,
                        g = [],
                        h, i;
                    for (i = 0; i < f; i++) h = d.rowXs.slice(i, i + e), g[i] = Math.max.apply(Math, h);
                    c._masonryHorizontalPlaceBrick(a, g)
                }
            })
        },
        _masonryHorizontalPlaceBrick: function(a, b) {
            var c = Math.min.apply(Math, b),
                d = 0;
            for (var e = 0, f = b.length; e < f; e++)
                if (b[e] === c) {
                    d = e;
                    break
                }
            var g = c,
                h = this.masonryHorizontal.rowHeight * d;
            this._pushPosition(a, g, h);
            var i = c + a.outerWidth(!0),
                j = this.masonryHorizontal.rows + 1 - f;
            for (e = 0; e < j; e++) this.masonryHorizontal.rowXs[d + e] = i
        },
        _masonryHorizontalGetContainerSize: function() {
            var a = Math.max.apply(Math, this.masonryHorizontal.rowXs);
            return {
                width: a
            }
        },
        _masonryHorizontalResizeChanged: function() {
            return this._checkIfSegmentsChanged(!0)
        },
        _fitColumnsReset: function() {
            this.fitColumns = {
                x: 0,
                y: 0,
                width: 0
            }
        },
        _fitColumnsLayout: function(a) {
            var c = this,
                d = this.element.height(),
                e = this.fitColumns;
            a.each(function() {
                var a = b(this),
                    f = a.outerWidth(!0),
                    g = a.outerHeight(!0);
                e.y !== 0 && g + e.y > d && (e.x = e.width, e.y = 0), c._pushPosition(a, e.x, e.y), e.width = Math.max(e.x + f, e.width), e.y += g
            })
        },
        _fitColumnsGetContainerSize: function() {
            return {
                width: this.fitColumns.width
            }
        },
        _fitColumnsResizeChanged: function() {
            return !0
        },
        _cellsByColumnReset: function() {
            this.cellsByColumn = {
                index: 0
            }, this._getSegments(), this._getSegments(!0)
        },
        _cellsByColumnLayout: function(a) {
            var c = this,
                d = this.cellsByColumn;
            a.each(function() {
                var a = b(this),
                    e = Math.floor(d.index / d.rows),
                    f = d.index % d.rows,
                    g = (e + .5) * d.columnWidth - a.outerWidth(!0) / 2,
                    h = (f + .5) * d.rowHeight - a.outerHeight(!0) / 2;
                c._pushPosition(a, g, h), d.index++
            })
        },
        _cellsByColumnGetContainerSize: function() {
            return {
                width: Math.ceil(this.$filteredAtoms.length / this.cellsByColumn.rows) * this.cellsByColumn.columnWidth
            }
        },
        _cellsByColumnResizeChanged: function() {
            return this._checkIfSegmentsChanged(!0)
        },
        _straightAcrossReset: function() {
            this.straightAcross = {
                x: 0
            }
        },
        _straightAcrossLayout: function(a) {
            var c = this;
            a.each(function(a) {
                var d = b(this);
                c._pushPosition(d, c.straightAcross.x, 0), c.straightAcross.x += d.outerWidth(!0)
            })
        },
        _straightAcrossGetContainerSize: function() {
            return {
                width: this.straightAcross.x
            }
        },
        _straightAcrossResizeChanged: function() {
            return !0
        }
    }, b.fn.imagesLoaded = function(a) {
        function h() {
            a.call(c, d)
        }

        function i(a) {
            var c = a.target;
            c.src !== f && b.inArray(c, g) === -1 && (g.push(c), --e <= 0 && (setTimeout(h), d.unbind(".imagesLoaded", i)))
        }
        var c = this,
            d = c.find("img").add(c.filter("img")),
            e = d.length,
            f = "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==",
            g = [];
        return e || h(), d.bind("load.imagesLoaded error.imagesLoaded", i).each(function() {
            var a = this.src;
            this.src = f, this.src = a
        }), c
    };
    var w = function(b) {
        a.console && a.console.error(b)
    };
    b.fn.isotope = function(a, c) {
        if (this instanceof Window) return;
        if (typeof a == "string") {
            var d = Array.prototype.slice.call(arguments, 1);
            this.each(function() {
                var c = b.data(this, "isotope");
                if (!c) {
                    w("cannot call methods on isotope prior to initialization; attempted to call method '" + a + "'");
                    return
                }
                if (!b.isFunction(c[a]) || a.charAt(0) === "_") {
                    w("no such method '" + a + "' for isotope instance");
                    return
                }
                c[a].apply(c, d)
            })
        } else this.each(function() {
            var d = b.data(this, "isotope");
            d ? (d.option(a), d._init(c)) : b.data(this, "isotope", new b.Isotope(a, this, c))
        });
        return this
    }
})(window, jQuery);

/*!
 * imagesLoaded PACKAGED v4.1.0
 * JavaScript is all like "You images are done yet or what?"
 * MIT License
 */

! function(t, e) {
    "function" == typeof define && define.amd ? define("ev-emitter/ev-emitter", e) : "object" == typeof module && module.exports ? module.exports = e() : t.EvEmitter = e()
}(this, function() {
    function t() {}
    var e = t.prototype;
    return e.on = function(t, e) {
        if (t && e) {
            var i = this._events = this._events || {},
                n = i[t] = i[t] || [];
            return -1 == n.indexOf(e) && n.push(e), this
        }
    }, e.once = function(t, e) {
        if (t && e) {
            this.on(t, e);
            var i = this._onceEvents = this._onceEvents || {},
                n = i[t] = i[t] || [];
            return n[e] = !0, this
        }
    }, e.off = function(t, e) {
        var i = this._events && this._events[t];
        if (i && i.length) {
            var n = i.indexOf(e);
            return -1 != n && i.splice(n, 1), this
        }
    }, e.emitEvent = function(t, e) {
        var i = this._events && this._events[t];
        if (i && i.length) {
            var n = 0,
                o = i[n];
            e = e || [];
            for (var r = this._onceEvents && this._onceEvents[t]; o;) {
                var s = r && r[o];
                s && (this.off(t, o), delete r[o]), o.apply(this, e), n += s ? 0 : 1, o = i[n]
            }
            return this
        }
    }, t
}),
function(t, e) {
    "use strict";
    "function" == typeof define && define.amd ? define(["ev-emitter/ev-emitter"], function(i) {
        return e(t, i)
    }) : "object" == typeof module && module.exports ? module.exports = e(t, require("ev-emitter")) : t.imagesLoaded = e(t, t.EvEmitter)
}(window, function(t, e) {
    function i(t, e) {
        for (var i in e) t[i] = e[i];
        return t
    }

    function n(t) {
        var e = [];
        if (Array.isArray(t)) e = t;
        else if ("number" == typeof t.length)
            for (var i = 0; i < t.length; i++) e.push(t[i]);
        else e.push(t);
        return e
    }

    function o(t, e, r) {
        return this instanceof o ? ("string" == typeof t && (t = document.querySelectorAll(t)), this.elements = n(t), this.options = i({}, this.options), "function" == typeof e ? r = e : i(this.options, e), r && this.on("always", r), this.getImages(), h && (this.jqDeferred = new h.Deferred), void setTimeout(function() {
            this.check()
        }.bind(this))) : new o(t, e, r)
    }

    function r(t) {
        this.img = t
    }

    function s(t, e) {
        this.url = t, this.element = e, this.img = new Image
    }
    var h = t.jQuery,
        a = t.console;
    o.prototype = Object.create(e.prototype), o.prototype.options = {}, o.prototype.getImages = function() {
        this.images = [], this.elements.forEach(this.addElementImages, this)
    }, o.prototype.addElementImages = function(t) {
        "IMG" == t.nodeName && this.addImage(t), this.options.background === !0 && this.addElementBackgroundImages(t);
        var e = t.nodeType;
        if (e && d[e]) {
            for (var i = t.querySelectorAll("img"), n = 0; n < i.length; n++) {
                var o = i[n];
                this.addImage(o)
            }
            if ("string" == typeof this.options.background) {
                var r = t.querySelectorAll(this.options.background);
                for (n = 0; n < r.length; n++) {
                    var s = r[n];
                    this.addElementBackgroundImages(s)
                }
            }
        }
    };
    var d = {
        1: !0,
        9: !0,
        11: !0
    };
    return o.prototype.addElementBackgroundImages = function(t) {
        var e = getComputedStyle(t);
        if (e)
            for (var i = /url\((['"])?(.*?)\1\)/gi, n = i.exec(e.backgroundImage); null !== n;) {
                var o = n && n[2];
                o && this.addBackground(o, t), n = i.exec(e.backgroundImage)
            }
    }, o.prototype.addImage = function(t) {
        var e = new r(t);
        this.images.push(e)
    }, o.prototype.addBackground = function(t, e) {
        var i = new s(t, e);
        this.images.push(i)
    }, o.prototype.check = function() {
        function t(t, i, n) {
            setTimeout(function() {
                e.progress(t, i, n)
            })
        }
        var e = this;
        return this.progressedCount = 0, this.hasAnyBroken = !1, this.images.length ? void this.images.forEach(function(e) {
            e.once("progress", t), e.check()
        }) : void this.complete()
    }, o.prototype.progress = function(t, e, i) {
        this.progressedCount++, this.hasAnyBroken = this.hasAnyBroken || !t.isLoaded, this.emitEvent("progress", [this, t, e]), this.jqDeferred && this.jqDeferred.notify && this.jqDeferred.notify(this, t), this.progressedCount == this.images.length && this.complete(), this.options.debug && a && a.log("progress: " + i, t, e)
    }, o.prototype.complete = function() {
        var t = this.hasAnyBroken ? "fail" : "done";
        if (this.isComplete = !0, this.emitEvent(t, [this]), this.emitEvent("always", [this]), this.jqDeferred) {
            var e = this.hasAnyBroken ? "reject" : "resolve";
            this.jqDeferred[e](this)
        }
    }, r.prototype = Object.create(e.prototype), r.prototype.check = function() {
        var t = this.getIsImageComplete();
        return t ? void this.confirm(0 !== this.img.naturalWidth, "naturalWidth") : (this.proxyImage = new Image, this.proxyImage.addEventListener("load", this), this.proxyImage.addEventListener("error", this), this.img.addEventListener("load", this), this.img.addEventListener("error", this), void(this.proxyImage.src = this.img.src))
    }, r.prototype.getIsImageComplete = function() {
        return this.img.complete && void 0 !== this.img.naturalWidth
    }, r.prototype.confirm = function(t, e) {
        this.isLoaded = t, this.emitEvent("progress", [this, this.img, e])
    }, r.prototype.handleEvent = function(t) {
        var e = "on" + t.type;
        this[e] && this[e](t)
    }, r.prototype.onload = function() {
        this.confirm(!0, "onload"), this.unbindEvents()
    }, r.prototype.onerror = function() {
        this.confirm(!1, "onerror"), this.unbindEvents()
    }, r.prototype.unbindEvents = function() {
        this.proxyImage.removeEventListener("load", this), this.proxyImage.removeEventListener("error", this), this.img.removeEventListener("load", this), this.img.removeEventListener("error", this)
    }, s.prototype = Object.create(r.prototype), s.prototype.check = function() {
        this.img.addEventListener("load", this), this.img.addEventListener("error", this), this.img.src = this.url;
        var t = this.getIsImageComplete();
        t && (this.confirm(0 !== this.img.naturalWidth, "naturalWidth"), this.unbindEvents())
    }, s.prototype.unbindEvents = function() {
        this.img.removeEventListener("load", this), this.img.removeEventListener("error", this)
    }, s.prototype.confirm = function(t, e) {
        this.isLoaded = t, this.emitEvent("progress", [this, this.element, e])
    }, o.makeJQueryPlugin = function(e) {
        e = e || t.jQuery, e && (h = e, h.fn.imagesLoaded = function(t, e) {
            var i = new o(this, t, e);
            return i.jqDeferred.promise(h(this))
        })
    }, o.makeJQueryPlugin(), o
});;/*!
 * jQuery Transit - CSS3 transitions and transformations
 * (c) 2011-2012 Rico Sta. Cruz <rico@ricostacruz.com>
 * MIT Licensed.
 *
 * http://ricostacruz.com/jquery.transit
 * http://github.com/rstacruz/jquery.transit
 */
(function($) {
    $.transit = {
        version: "0.9.9",
        propertyMap: {
            marginLeft: 'margin',
            marginRight: 'margin',
            marginBottom: 'margin',
            marginTop: 'margin',
            paddingLeft: 'padding',
            paddingRight: 'padding',
            paddingBottom: 'padding',
            paddingTop: 'padding'
        },
        enabled: true,
        useTransitionEnd: false
    };
    var u = document.createElement('div');
    var w = {};

    function getVendorPropertyName(a) {
        if (a in u.style) return a;
        var b = ['Moz', 'Webkit', 'O', 'ms'];
        var c = a.charAt(0).toUpperCase() + a.substr(1);
        if (a in u.style) {
            return a
        }
        for (var i = 0; i < b.length; ++i) {
            var d = b[i] + c;
            if (d in u.style) {
                return d
            }
        }
    }

    function checkTransform3dSupport() {
        u.style[w.transform] = '';
        u.style[w.transform] = 'rotateY(90deg)';
        return u.style[w.transform] !== ''
    }
    var z = navigator.userAgent.toLowerCase().indexOf('chrome') > -1;
    w.transition = getVendorPropertyName('transition');
    w.transitionDelay = getVendorPropertyName('transitionDelay');
    w.transform = getVendorPropertyName('transform');
    w.transformOrigin = getVendorPropertyName('transformOrigin');
    w.transform3d = checkTransform3dSupport();
    var A = {
        'transition': 'transitionEnd',
        'MozTransition': 'transitionend',
        'OTransition': 'oTransitionEnd',
        'WebkitTransition': 'webkitTransitionEnd',
        'msTransition': 'MSTransitionEnd'
    };
    var B = w.transitionEnd = A[w.transition] || null;
    for (var C in w) {
        if (w.hasOwnProperty(C) && typeof $.support[C] === 'undefined') {
            $.support[C] = w[C]
        }
    }
    u = null;
    $.cssEase = {
        '_default': 'ease',
        'in': 'ease-in',
        'out': 'ease-out',
        'in-out': 'ease-in-out',
        'snap': 'cubic-bezier(0,1,.5,1)',
        'easeOutCubic': 'cubic-bezier(.215,.61,.355,1)',
        'easeInOutCubic': 'cubic-bezier(.645,.045,.355,1)',
        'easeInCirc': 'cubic-bezier(.6,.04,.98,.335)',
        'easeOutCirc': 'cubic-bezier(.075,.82,.165,1)',
        'easeInOutCirc': 'cubic-bezier(.785,.135,.15,.86)',
        'easeInExpo': 'cubic-bezier(.95,.05,.795,.035)',
        'easeOutExpo': 'cubic-bezier(.19,1,.22,1)',
        'easeInOutExpo': 'cubic-bezier(1,0,0,1)',
        'easeInQuad': 'cubic-bezier(.55,.085,.68,.53)',
        'easeOutQuad': 'cubic-bezier(.25,.46,.45,.94)',
        'easeInOutQuad': 'cubic-bezier(.455,.03,.515,.955)',
        'easeInQuart': 'cubic-bezier(.895,.03,.685,.22)',
        'easeOutQuart': 'cubic-bezier(.165,.84,.44,1)',
        'easeInOutQuart': 'cubic-bezier(.77,0,.175,1)',
        'easeInQuint': 'cubic-bezier(.755,.05,.855,.06)',
        'easeOutQuint': 'cubic-bezier(.23,1,.32,1)',
        'easeInOutQuint': 'cubic-bezier(.86,0,.07,1)',
        'easeInSine': 'cubic-bezier(.47,0,.745,.715)',
        'easeOutSine': 'cubic-bezier(.39,.575,.565,1)',
        'easeInOutSine': 'cubic-bezier(.445,.05,.55,.95)',
        'easeInBack': 'cubic-bezier(.6,-.28,.735,.045)',
        'easeOutBack': 'cubic-bezier(.175, .885,.32,1.275)',
        'easeInOutBack': 'cubic-bezier(.68,-.55,.265,1.55)'
    };
    $.cssHooks['transit:transform'] = {
        get: function(a) {
            return $(a).data('transform') || new Transform()
        },
        set: function(a, v) {
            var b = v;
            if (!(b instanceof Transform)) {
                b = new Transform(b)
            }
            if (w.transform === 'WebkitTransform' && !z) {
                a.style[w.transform] = b.toString(true)
            } else {
                a.style[w.transform] = b.toString()
            }
            $(a).data('transform', b)
        }
    };
    $.cssHooks.transform = {
        set: $.cssHooks['transit:transform'].set
    };
    if ($.fn.jquery < "1.8") {
        $.cssHooks.transformOrigin = {
            get: function(a) {
                return a.style[w.transformOrigin]
            },
            set: function(a, b) {
                a.style[w.transformOrigin] = b
            }
        };
        $.cssHooks.transition = {
            get: function(a) {
                return a.style[w.transition]
            },
            set: function(a, b) {
                a.style[w.transition] = b
            }
        }
    }
    registerCssHook('scale');
    registerCssHook('translate');
    registerCssHook('rotate');
    registerCssHook('rotateX');
    registerCssHook('rotateY');
    registerCssHook('rotate3d');
    registerCssHook('perspective');
    registerCssHook('skewX');
    registerCssHook('skewY');
    registerCssHook('x', true);
    registerCssHook('y', true);

    function Transform(a) {
        if (typeof a === 'string') {
            this.parse(a)
        }
        return this
    }
    Transform.prototype = {
        setFromString: function(a, b) {
            var c = (typeof b === 'string') ? b.split(',') : (b.constructor === Array) ? b : [b];
            c.unshift(a);
            Transform.prototype.set.apply(this, c)
        },
        set: function(a) {
            var b = Array.prototype.slice.apply(arguments, [1]);
            if (this.setter[a]) {
                this.setter[a].apply(this, b)
            } else {
                this[a] = b.join(',')
            }
        },
        get: function(a) {
            if (this.getter[a]) {
                return this.getter[a].apply(this)
            } else {
                return this[a] || 0
            }
        },
        setter: {
            rotate: function(a) {
                this.rotate = unit(a, 'deg')
            },
            rotateX: function(a) {
                this.rotateX = unit(a, 'deg')
            },
            rotateY: function(a) {
                this.rotateY = unit(a, 'deg')
            },
            scale: function(x, y) {
                if (y === undefined) {
                    y = x
                }
                this.scale = x + "," + y
            },
            skewX: function(x) {
                this.skewX = unit(x, 'deg')
            },
            skewY: function(y) {
                this.skewY = unit(y, 'deg')
            },
            perspective: function(a) {
                this.perspective = unit(a, 'px')
            },
            x: function(x) {
                this.set('translate', x, null)
            },
            y: function(y) {
                this.set('translate', null, y)
            },
            translate: function(x, y) {
                if (this._translateX === undefined) {
                    this._translateX = 0
                }
                if (this._translateY === undefined) {
                    this._translateY = 0
                }
                if (x !== null && x !== undefined) {
                    this._translateX = unit(x, 'px')
                }
                if (y !== null && y !== undefined) {
                    this._translateY = unit(y, 'px')
                }
                this.translate = this._translateX + "," + this._translateY
            }
        },
        getter: {
            x: function() {
                return this._translateX || 0
            },
            y: function() {
                return this._translateY || 0
            },
            scale: function() {
                var s = (this.scale || "1,1").split(',');
                if (s[0]) {
                    s[0] = parseFloat(s[0])
                }
                if (s[1]) {
                    s[1] = parseFloat(s[1])
                }
                return (s[0] === s[1]) ? s[0] : s
            },
            rotate3d: function() {
                var s = (this.rotate3d || "0,0,0,0deg").split(',');
                for (var i = 0; i <= 3; ++i) {
                    if (s[i]) {
                        s[i] = parseFloat(s[i])
                    }
                }
                if (s[3]) {
                    s[3] = unit(s[3], 'deg')
                }
                return s
            }
        },
        parse: function(c) {
            var d = this;
            c.replace(/([a-zA-Z0-9]+)\((.*?)\)/g, function(x, a, b) {
                d.setFromString(a, b)
            })
        },
        toString: function(a) {
            var b = [];
            for (var i in this) {
                if (this.hasOwnProperty(i)) {
                    if ((!w.transform3d) && ((i === 'rotateX') || (i === 'rotateY') || (i === 'perspective') || (i === 'transformOrigin'))) {
                        continue
                    }
                    if (i[0] !== '_') {
                        if (a && (i === 'scale')) {
                            b.push(i + "3d(" + this[i] + ",1)")
                        } else if (a && (i === 'translate')) {
                            b.push(i + "3d(" + this[i] + ",0)")
                        } else {
                            b.push(i + "(" + this[i] + ")")
                        }
                    }
                }
            }
            return b.join(" ")
        }
    };

    function callOrQueue(a, b, c) {
        if (b === true) {
            a.queue(c)
        } else if (b) {
            a.queue(b, c)
        } else {
            c()
        }
    }

    function getProperties(b) {
        var c = [];
        $.each(b, function(a) {
            a = $.camelCase(a);
            a = $.transit.propertyMap[a] || $.cssProps[a] || a;
            a = uncamel(a);
            if ($.inArray(a, c) === -1) {
                c.push(a)
            }
        });
        return c
    }

    function getTransition(b, c, d, e) {
        var f = getProperties(b);
        if ($.cssEase[d]) {
            d = $.cssEase[d]
        }
        var g = '' + toMS(c) + ' ' + d;
        if (parseInt(e, 10) > 0) {
            g += ' ' + toMS(e)
        }
        var h = [];
        $.each(f, function(i, a) {
            h.push(a + ' ' + g)
        });
        return h.join(', ')
    }
    $.fn.transition = $.fn.transit = function(d, e, f, g) {
        var h = this;
        var j = 0;
        var k = true;
        var l = jQuery.extend(true, {}, d);
        if (typeof e === 'function') {
            g = e;
            e = undefined
        }
        if (typeof e === 'object') {
            f = e.easing;
            j = e.delay || 0;
            k = e.queue || true;
            g = e.complete;
            e = e.duration
        }
        if (typeof f === 'function') {
            g = f;
            f = undefined
        }
        if (typeof l.easing !== 'undefined') {
            f = l.easing;
            delete l.easing
        }
        if (typeof l.duration !== 'undefined') {
            e = l.duration;
            delete l.duration
        }
        if (typeof l.complete !== 'undefined') {
            g = l.complete;
            delete l.complete
        }
        if (typeof l.queue !== 'undefined') {
            k = l.queue;
            delete l.queue
        }
        if (typeof l.delay !== 'undefined') {
            j = l.delay;
            delete l.delay
        }
        if (typeof e === 'undefined') {
            e = $.fx.speeds._default
        }
        if (typeof f === 'undefined') {
            f = $.cssEase._default
        }
        e = toMS(e);
        var m = getTransition(l, e, f, j);
        var n = $.transit.enabled && w.transition;
        var i = n ? (parseInt(e, 10) + parseInt(j, 10)) : 0;
        if (i === 0) {
            var o = function(a) {
                h.css(l);
                if (g) {
                    g.apply(h)
                }
                if (a) {
                    a()
                }
            };
            callOrQueue(h, k, o);
            return h
        }
        var p = {};
        var q = function(a) {
            var b = false;
            var c = function() {
                if (b) {
                    h.unbind(B, c)
                }
                if (i > 0) {
                    h.each(function() {
                        this.style[w.transition] = (p[this] || null)
                    })
                }
                if (typeof g === 'function') {
                    g.apply(h)
                }
                if (typeof a === 'function') {
                    a()
                }
            };
            if ((i > 0) && (B) && ($.transit.useTransitionEnd)) {
                b = true;
                h.bind(B, c)
            } else {
                window.setTimeout(c, i)
            }
            h.each(function() {
                if (i > 0) {
                    this.style[w.transition] = m
                }
                $(this).css(d)
            })
        };
        var r = function(a) {
            this.offsetWidth;
            q(a)
        };
        callOrQueue(h, k, r);
        return this
    };

    function registerCssHook(c, d) {
        if (!d) {
            $.cssNumber[c] = true
        }
        $.transit.propertyMap[c] = w.transform;
        $.cssHooks[c] = {
            get: function(a) {
                var t = $(a).css('transit:transform');
                return t.get(c)
            },
            set: function(a, b) {
                var t = $(a).css('transit:transform');
                t.setFromString(c, b);
                $(a).css({
                    'transit:transform': t
                })
            }
        }
    }

    function uncamel(b) {
        return b.replace(/([A-Z])/g, function(a) {
            return '-' + a.toLowerCase()
        })
    }

    function unit(i, a) {
        if ((typeof i === "string") && (!i.match(/^[\-0-9\.]+$/))) {
            return i
        } else {
            return "" + i + a
        }
    }

    function toMS(a) {
        var i = a;
        if (typeof i === 'string' && (!i.match(/^[\-0-9\.]+/))) {
            i = $.fx.speeds[i] || $.fx.speeds._default
        }
        return unit(i, 'ms')
    }
    $.transit.getTransitionValue = getTransition
})(jQuery);
;/*

Infinite Scroll

*/

(function(o, i, k) {
    i.infinitescroll = function z(D, F, E) {
        this.element = i(E);
        if (!this._create(D, F)) {
            this.failed = true
        }
    };
    i.infinitescroll.defaults = {
        loading: {
            finished: k,
            finishedMsg: "<em>Congratulations, you've reached the end of the internet.</em>",
            img: "data:image/gif;base64,R0lGODlh3AATAPQeAPDy+MnQ6LW/4N3h8MzT6rjC4sTM5r/I5NHX7N7j8c7U6tvg8OLl8uXo9Ojr9b3G5MfP6Ovu9tPZ7PT1+vX2+tbb7vf4+8/W69jd7rC73vn5/O/x+K243ai02////wAAACH/C05FVFNDQVBFMi4wAwEAAAAh+QQECgD/ACwAAAAA3AATAAAF/6AnjmRpnmiqrmzrvnAsz3Rt33iu73zv/8CgcEj0BAScpHLJbDqf0Kh0Sq1ar9isdioItAKGw+MAKYMFhbF63CW438f0mg1R2O8EuXj/aOPtaHx7fn96goR4hmuId4qDdX95c4+RBIGCB4yAjpmQhZN0YGYGXitdZBIVGAsLoq4BBKQDswm1CQRkcG6ytrYKubq8vbfAcMK9v7q7EMO1ycrHvsW6zcTKsczNz8HZw9vG3cjTsMIYqQkCLBwHCgsMDQ4RDAYIqfYSFxDxEfz88/X38Onr16+Bp4ADCco7eC8hQYMAEe57yNCew4IVBU7EGNDiRn8Z831cGLHhSIgdFf9chIeBg7oA7gjaWUWTVQAGE3LqBDCTlc9WOHfm7PkTqNCh54rePDqB6M+lR536hCpUqs2gVZM+xbrTqtGoWqdy1emValeXKzggYBBB5y1acFNZmEvXAoN2cGfJrTv3bl69Ffj2xZt3L1+/fw3XRVw4sGDGcR0fJhxZsF3KtBTThZxZ8mLMgC3fRatCbYMNFCzwLEqLgE4NsDWs/tvqdezZf13Hvk2A9Szdu2X3pg18N+68xXn7rh1c+PLksI/Dhe6cuO3ow3NfV92bdArTqC2Ebd3A8vjf5QWfH6Bg7Nz17c2fj69+fnq+8N2Lty+fuP78/eV2X13neIcCeBRwxorbZrA1ANoCDGrgoG8RTshahQ9iSKEEzUmYIYfNWViUhheCGJyIP5E4oom7WWjgCeBFAJNv1DVV01MAdJhhjdkplWNzO/5oXI846njjVEIqR2OS2B1pE5PVscajkxhMycqLJghQSwT40PgfAl4GqNSXYdZXJn5gSkmmmmJu1aZYb14V51do+pTOCmA40AqVCIhG5IJ9PvYnhIFOxmdqhpaI6GeHCtpooisuutmg+Eg62KOMKuqoTaXgicQWoIYq6qiklmoqFV0UoeqqrLbq6quwxirrrLTWauutJ4QAACH5BAUKABwALAcABADOAAsAAAX/IPd0D2dyRCoUp/k8gpHOKtseR9yiSmGbuBykler9XLAhkbDavXTL5k2oqFqNOxzUZPU5YYZd1XsD72rZpBjbeh52mSNnMSC8lwblKZGwi+0QfIJ8CncnCoCDgoVnBHmKfByGJimPkIwtiAeBkH6ZHJaKmCeVnKKTHIihg5KNq4uoqmEtcRUtEREMBggtEr4QDrjCuRC8h7/BwxENeicSF8DKy82pyNLMOxzWygzFmdvD2L3P0dze4+Xh1Arkyepi7dfFvvTtLQkZBC0T/FX3CRgCMOBHsJ+EHYQY7OinAGECgQsB+Lu3AOK+CewcWjwxQeJBihtNGHSoQOE+iQ3//4XkwBBhRZMcUS6YSXOAwIL8PGqEaSJCiYt9SNoCmnJPAgUVLChdaoFBURN8MAzl2PQphwQLfDFd6lTowglHve6rKpbjhK7/pG5VinZP1qkiz1rl4+tr2LRwWU64cFEihwEtZgbgR1UiHaMVvxpOSwBA37kzGz9e8G+B5MIEKLutOGEsAH2ATQwYfTmuX8aETWdGPZmiZcccNSzeTCA1Sw0bdiitC7LBWgu8jQr8HRzqgpK6gX88QbrB14z/kF+ELpwB8eVQj/JkqdylAudji/+ts3039vEEfK8Vz2dlvxZKG0CmbkKDBvllRd6fCzDvBLKBDSCeffhRJEFebFk1k/Mv9jVIoIJZSeBggwUaNeB+Qk34IE0cXlihcfRxkOAJFFhwGmKlmWDiakZhUJtnLBpnWWcnKaAZcxI0piFGGLBm1mc90kajSCveeBVWKeYEoU2wqeaQi0PetoE+rr14EpVC7oAbAUHqhYExbn2XHHsVqbcVew9tx8+XJKk5AZsqqdlddGpqAKdbAYBn1pcczmSTdWvdmZ17c1b3FZ99vnTdCRFM8OEcAhLwm1NdXnWcBBSMRWmfkWZqVlsmLIiAp/o1gGV2vpS4lalGYsUOqXrddcKCmK61aZ8SjEpUpVFVoCpTj4r661Km7kBHjrDyc1RAIQAAIfkEBQoAGwAsBwAEAM4ACwAABf/gtmUCd4goQQgFKj6PYKi0yrrbc8i4ohQt12EHcal+MNSQiCP8gigdz7iCioaCIvUmZLp8QBzW0EN2vSlCuDtFKaq4RyHzQLEKZNdiQDhRDVooCwkbfm59EAmKi4SGIm+AjIsKjhsqB4mSjT2IOIOUnICeCaB/mZKFNTSRmqVpmJqklSqskq6PfYYCDwYHDC4REQwGCBLGxxIQDsHMwhAIX8bKzcENgSLGF9PU1j3Sy9zX2NrgzQziChLk1BHWxcjf7N046tvN82715czn9Pryz6Ilc4ACj4EBOCZM8KEnAYYADBRKnACAYUMFv1wotIhCEcaJCisqwJFgAUSQGyX/kCSVUUTIdKMwJlyo0oXHlhskwrTJciZHEXsgaqS4s6PJiCAr1uzYU8kBBSgnWFqpoMJMUjGtDmUwkmfVmVypakWhEKvXsS4nhLW5wNjVroJIoc05wSzTr0PtiigpYe4EC2vj4iWrFu5euWIMRBhacaVJhYQBEFjA9jHjyQ0xEABwGceGAZYjY0YBOrRLCxUp29QM+bRkx5s7ZyYgVbTqwwti2ybJ+vLtDYpycyZbYOlptxdx0kV+V7lC5iJAyyRrwYKxAdiz82ng0/jnAdMJFz0cPi104Ec1Vj9/M6F173vKL/feXv156dw11tlqeMMnv4V5Ap53GmjQQH97nFfg+IFiucfgRX5Z8KAgbUlQ4IULIlghhhdOSB6AgX0IVn8eReghen3NRIBsRgnH4l4LuEidZBjwRpt6NM5WGwoW0KSjCwX6yJSMab2GwwAPDXfaBCtWpluRTQqC5JM5oUZAjUNS+VeOLWpJEQ7VYQANW0INJSZVDFSnZphjSikfmzE5N4EEbQI1QJmnWXCmHulRp2edwDXF43txukenJwvI9xyg9Q26Z3MzGUcBYFEChZh6DVTq34AU8Iflh51Sd+CnKFYQ6mmZkhqfBKfSxZWqA9DZanWjxmhrWwi0qtCrt/43K6WqVjjpmhIqgEGvculaGKklKstAACEAACH5BAUKABwALAcABADOAAsAAAX/ICdyQmaMYyAUqPgIBiHPxNpy79kqRXH8wAPsRmDdXpAWgWdEIYm2llCHqjVHU+jjJkwqBTecwItShMXkEfNWSh8e1NGAcLgpDGlRgk7EJ/6Ae3VKfoF/fDuFhohVeDeCfXkcCQqDVQcQhn+VNDOYmpSWaoqBlUSfmowjEA+iEAEGDRGztAwGCDcXEA60tXEiCrq8vREMEBLIyRLCxMWSHMzExnbRvQ2Sy7vN0zvVtNfU2tLY3rPgLdnDvca4VQS/Cpk3ABwSLQkYAQwT/P309vcI7OvXr94jBQMJ/nskkGA/BQBRLNDncAIAiDcG6LsxAWOLiQzmeURBKWSLCQbv/1F0eDGinJUKR47YY1IEgQASKk7Yc7ACRwZm7mHweRJoz59BJUogisKCUaFMR0x4SlJBVBFTk8pZivTR0K73rN5wqlXEAq5Fy3IYgHbEzQ0nLy4QSoCjXLoom96VOJEeCosK5n4kkFfqXjl94wa+l1gvAcGICbewAOAxY8l/Ky/QhAGz4cUkGxu2HNozhwMGBnCUqUdBg9UuW9eUynqSwLHIBujePef1ZGQZXcM+OFuEBeBhi3OYgLyqcuaxbT9vLkf4SeqyWxSQpKGB2gQpm1KdWbu72rPRzR9Ne2Nu9Kzr/1Jqj0yD/fvqP4aXOt5sW/5qsXXVcv1Nsp8IBUAmgswGF3llGgeU1YVXXKTN1FlhWFXW3gIE+DVChApysACHHo7Q4A35lLichh+ROBmLKAzgYmYEYDAhCgxKGOOMn4WR4kkDaoBBOxJtdNKQxFmg5JIWIBnQc07GaORfUY4AEkdV6jHlCEISSZ5yTXpp1pbGZbkWmcuZmQCaE6iJ0FhjMaDjTMsgZaNEHFRAQVp3bqXnZED1qYcECOz5V6BhSWCoVJQIKuKQi2KFKEkEFAqoAo7uYSmO3jk61wUUMKmknJ4SGimBmAa0qVQBhAAAIfkEBQoAGwAsBwAEAM4ACwAABf/gJm5FmRlEqhJC+bywgK5pO4rHI0D3pii22+Mg6/0Ej96weCMAk7cDkXf7lZTTnrMl7eaYoy10JN0ZFdco0XAuvKI6qkgVFJXYNwjkIBcNBgR8TQoGfRsJCRuCYYQQiI+ICosiCoGOkIiKfSl8mJkHZ4U9kZMbKaI3pKGXmJKrngmug4WwkhA0lrCBWgYFCCMQFwoQDRHGxwwGCBLMzRLEx8iGzMMO0cYNeCMKzBDW19lnF9DXDIY/48Xg093f0Q3s1dcR8OLe8+Y91OTv5wrj7o7B+7VNQqABIoRVCMBggsOHE36kSoCBIcSH3EbFangxogJYFi8CkJhqQciLJEf/LDDJEeJIBT0GsOwYUYJGBS0fjpQAMidGmyVP6sx4Y6VQhzs9VUwkwqaCCh0tmKoFtSMDmBOf9phg4SrVrROuasRQAaxXpVUhdsU6IsECZlvX3kwLUWzRt0BHOLTbNlbZG3vZinArge5Dvn7wbqtQkSYAAgtKmnSsYKVKo2AfW048uaPmG386i4Q8EQMBAIAnfB7xBxBqvapJ9zX9WgRS2YMpnvYMGdPK3aMjt/3dUcNI4blpj7iwkMFWDXDvSmgAlijrt9RTR78+PS6z1uAJZIe93Q8g5zcsWCi/4Y+C8bah5zUv3vv89uft30QP23punGCx5954oBBwnwYaNCDY/wYrsYeggnM9B2Fpf8GG2CEUVWhbWAtGouEGDy7Y4IEJVrbSiXghqGKIo7z1IVcXIkKWWR361QOLWWnIhwERpLaaCCee5iMBGJQmJGyPFTnbkfHVZGRtIGrg5HALEJAZbu39BuUEUmq1JJQIPtZilY5hGeSWsSk52G9XqsmgljdIcABytq13HyIM6RcUA+r1qZ4EBF3WHWB29tBgAzRhEGhig8KmqKFv8SeCeo+mgsF7YFXa1qWSbkDpom/mqR1PmHCqJ3fwNRVXjC7S6CZhFVCQ2lWvZiirhQq42SACt25IK2hv8TprriUV1usGgeka7LFcNmCldMLi6qZMgFLgpw16Cipb7bC1knXsBiEAACH5BAUKABsALAcABADOAAsAAAX/4FZsJPkUmUGsLCEUTywXglFuSg7fW1xAvNWLF6sFFcPb42C8EZCj24EJdCp2yoegWsolS0Uu6fmamg8n8YYcLU2bXSiRaXMGvqV6/KAeJAh8VgZqCX+BexCFioWAYgqNi4qAR4ORhRuHY408jAeUhAmYYiuVlpiflqGZa5CWkzc5fKmbbhIpsAoQDRG8vQwQCBLCwxK6vb5qwhfGxxENahvCEA7NzskSy7vNzzzK09W/PNHF1NvX2dXcN8K55cfh69Luveol3vO8zwi4Yhj+AQwmCBw4IYclDAAJDlQggVOChAoLKkgFkSCAHDwWLKhIEOONARsDKryogFPIiAUb/95gJNIiw4wnI778GFPhzBKFOAq8qLJEhQpiNArjMcHCmlTCUDIouTKBhApELSxFWiGiVKY4E2CAekPgUphDu0742nRrVLJZnyrFSqKQ2ohoSYAMW6IoDpNJ4bLdILTnAj8KUF7UeENjAKuDyxIgOuGiOI0EBBMgLNew5AUrDTMGsFixwBIaNCQuAXJB57qNJ2OWm2Aj4skwCQCIyNkhhtMkdsIuodE0AN4LJDRgfLPtn5YDLdBlraAByuUbBgxQwICxMOnYpVOPej074OFdlfc0TqC62OIbcppHjV4o+LrieWhfT8JC/I/T6W8oCl29vQ0XjLdBaA3s1RcPBO7lFvpX8BVoG4O5jTXRQRDuJ6FDTzEWF1/BCZhgbyAKE9qICYLloQYOFtahVRsWYlZ4KQJHlwHS/IYaZ6sZd9tmu5HQm2xi1UaTbzxYwJk/wBF5g5EEYOBZeEfGZmNdFyFZmZIR4jikbLThlh5kUUVJGmRT7sekkziRWUIACABk3T4qCsedgO4xhgGcY7q5pHJ4klBBTQRJ0CeHcoYHHUh6wgfdn9uJdSdMiebGJ0zUPTcoS286FCkrZxnYoYYKWLkBowhQoBeaOlZAgVhLidrXqg2GiqpQpZ4apwSwRtjqrB3muoF9BboaXKmshlqWqsWiGt2wphJkQbAU5hoCACH5BAUKABsALAcABADOAAsAAAX/oGFw2WZuT5oZROsSQnGaKjRvilI893MItlNOJ5v5gDcFrHhKIWcEYu/xFEqNv6B1N62aclysF7fsZYe5aOx2yL5aAUGSaT1oTYMBwQ5VGCAJgYIJCnx1gIOBhXdwiIl7d0p2iYGQUAQBjoOFSQR/lIQHnZ+Ue6OagqYzSqSJi5eTpTxGcjcSChANEbu8DBAIEsHBChe5vL13G7fFuscRDcnKuM3H0La3EA7Oz8kKEsXazr7Cw9/Gztar5uHHvte47MjktznZ2w0G1+D3BgirAqJmJMAQgMGEgwgn5Ei0gKDBhBMALGRYEOJBb5QcWlQo4cbAihZz3GgIMqFEBSM1/4ZEOWPAgpIIJXYU+PIhRG8ja1qU6VHlzZknJNQ6UanCjQkWCIGSUGEjAwVLjc44+DTqUQtPPS5gejUrTa5TJ3g9sWCr1BNUWZI161StiQUDmLYdGfesibQ3XMq1OPYthrwuA2yU2LBs2cBHIypYQPPlYAKFD5cVvNPtW8eVGbdcQADATsiNO4cFAPkvHpedPzc8kUcPgNGgZ5RNDZG05reoE9s2vSEP79MEGiQGy1qP8LA4ZcdtsJE48ONoLTBtTV0B9LsTnPceoIDBDQvS7W7vfjVY3q3eZ4A339J4eaAmKqU/sV58HvJh2RcnIBsDUw0ABqhBA5aV5V9XUFGiHfVeAiWwoFgJJrIXRH1tEMiDFV4oHoAEGlaWhgIGSGBO2nFomYY3mKjVglidaNYJGJDkWW2xxTfbjCbVaOGNqoX2GloR8ZeTaECS9pthRGJH2g0b3Agbk6hNANtteHD2GJUucfajCQBy5OOTQ25ZgUPvaVVQmbKh9510/qQpwXx3SQdfk8tZJOd5b6JJFplT3ZnmmX3qd5l1eg5q00HrtUkUn0AKaiGjClSAgKLYZcgWXwocGRcCFGCKwSB6ceqphwmYRUFYT/1WKlOdUpipmxW0mlCqHjYkAaeoZlqrqZ4qd+upQKaapn/AmgAegZ8KUtYtFAQQAgAh+QQFCgAbACwHAAQAzgALAAAF/+C2PUcmiCiZGUTrEkKBis8jQEquKwU5HyXIbEPgyX7BYa5wTNmEMwWsSXsqFbEh8DYs9mrgGjdK6GkPY5GOeU6ryz7UFopSQEzygOGhJBjoIgMDBAcBM0V/CYqLCQqFOwobiYyKjn2TlI6GKC2YjJZknouaZAcQlJUHl6eooJwKooobqoewrJSEmyKdt59NhRKFMxLEEA4RyMkMEAjDEhfGycqAG8TQx9IRDRDE3d3R2ctD1RLg0ttKEnbY5wZD3+zJ6M7X2RHi9Oby7u/r9g38UFjTh2xZJBEBMDAboogAgwkQI07IMUORwocSJwCgWDFBAIwZOaJIsOBjRogKJP8wTODw5ESVHVtm3AhzpEeQElOuNDlTZ0ycEUWKWFASqEahGwYUPbnxoAgEdlYSqDBkgoUNClAlIHbSAoOsqCRQnQHxq1axVb06FWFxLIqyaze0Tft1JVqyE+pWXMD1pF6bYl3+HTqAWNW8cRUFzmih0ZAAB2oGKukSAAGGRHWJgLiR6AylBLpuHKKUMlMCngMpDSAa9QIUggZVVvDaJobLeC3XZpvgNgCmtPcuwP3WgmXSq4do0DC6o2/guzcseECtUoO0hmcsGKDgOt7ssBd07wqesAIGZC1YIBa7PQHvb1+SFo+++HrJSQfB33xfav3i5eX3Hnb4CTJgegEq8tH/YQEOcIJzbm2G2EoYRLgBXFpVmFYDcREV4HIcnmUhiGBRouEMJGJGzHIspqgdXxK0yCKHRNXoIX4uorCdTyjkyNtdPWrA4Up82EbAbzMRxxZRR54WXVLDIRmRcag5d2R6ugl3ZXzNhTecchpMhIGVAKAYpgJjjsSklBEd99maZoo535ZvdamjBEpusJyctg3h4X8XqodBMx0tiNeg/oGJaKGABpogS40KSqiaEgBqlQWLUtqoVQnytekEjzo0hHqhRorppOZt2p923M2AAV+oBtpAnnPNoB6HaU6mAAIU+IXmi3j2mtFXuUoHKwXpzVrsjcgGOauKEjQrwq157hitGq2NoWmjh7z6Wmxb0m5w66+2VRAuXN/yFUAIACH5BAUKABsALAcABADOAAsAAAX/4CZuRiaM45MZqBgIRbs9AqTcuFLE7VHLOh7KB5ERdjJaEaU4ClO/lgKWjKKcMiJQ8KgumcieVdQMD8cbBeuAkkC6LYLhOxoQ2PF5Ys9PKPBMen17f0CCg4VSh32JV4t8jSNqEIOEgJKPlkYBlJWRInKdiJdkmQlvKAsLBxdABA4RsbIMBggtEhcQsLKxDBC2TAS6vLENdJLDxMZAubu8vjIbzcQRtMzJz79S08oQEt/guNiyy7fcvMbh4OezdAvGrakLAQwyABsELQkY9BP+//ckyPDD4J9BfAMh1GsBoImMeQUN+lMgUJ9CiRMa5msxoB9Gh/o8GmxYMZXIgxtR/yQ46S/gQAURR0pDwYDfywoyLPip5AdnCwsMFPBU4BPFhKBDi444quCmDKZOfwZ9KEGpCKgcN1jdALSpPqIYsabS+nSqvqplvYqQYAeDPgwKwjaMtiDl0oaqUAyo+3TuWwUAMPpVCfee0cEjVBGQq2ABx7oTWmQk4FglZMGN9fGVDMCuiH2AOVOu/PmyxM630gwM0CCn6q8LjVJ8GXvpa5Uwn95OTC/nNxkda1/dLSK475IjCD6dHbK1ZOa4hXP9DXs5chJ00UpVm5xo2qRpoxptwF2E4/IbJpB/SDz9+q9b1aNfQH08+p4a8uvX8B53fLP+ycAfemjsRUBgp1H20K+BghHgVgt1GXZXZpZ5lt4ECjxYR4ScUWiShEtZqBiIInRGWnERNnjiBglw+JyGnxUmGowsyiiZg189lNtPGACjV2+S9UjbU0JWF6SPvEk3QZEqsZYTk3UAaRSUnznJI5LmESCdBVSyaOWUWLK4I5gDUYVeV1T9l+FZClCAUVA09uSmRHBCKAECFEhW51ht6rnmWBXkaR+NjuHpJ40D3DmnQXt2F+ihZxlqVKOfQRACACH5BAUKABwALAcABADOAAsAAAX/ICdyUCkUo/g8mUG8MCGkKgspeC6j6XEIEBpBUeCNfECaglBcOVfJFK7YQwZHQ6JRZBUqTrSuVEuD3nI45pYjFuWKvjjSkCoRaBUMWxkwBGgJCXspQ36Bh4EEB0oKhoiBgyNLjo8Ki4QElIiWfJqHnISNEI+Ql5J9o6SgkqKkgqYihamPkW6oNBgSfiMMDQkGCBLCwxIQDhHIyQwQCGMKxsnKVyPCF9DREQ3MxMPX0cu4wt7J2uHWx9jlKd3o39MiuefYEcvNkuLt5O8c1ePI2tyELXGQwoGDAQf+iEC2xByDCRAjTlAgIUWCBRgCPJQ4AQBFXAs0coT40WLIjRxL/47AcHLkxIomRXL0CHPERZkpa4q4iVKiyp0tR/7kwHMkTUBBJR5dOCEBAVcKKtCAyOHpowXCpk7goABqBZdcvWploACpBKkpIJI1q5OD2rIWE0R1uTZu1LFwbWL9OlKuWb4c6+o9i3dEgw0RCGDUG9KlRw56gDY2qmCByZBaASi+TACA0TucAaTteCcy0ZuOK3N2vJlx58+LRQyY3Xm0ZsgjZg+oPQLi7dUcNXi0LOJw1pgNtB7XG6CBy+U75SYfPTSQAgZTNUDnQHt67wnbZyvwLgKiMN3oCZB3C76tdewpLFgIP2C88rbi4Y+QT3+8S5USMICZXWj1pkEDeUU3lOYGB3alSoEiMIjgX4WlgNF2EibIwQIXauWXSRg2SAOHIU5IIIMoZkhhWiJaiFVbKo6AQEgQXrTAazO1JhkBrBG3Y2Y6EsUhaGn95hprSN0oWpFE7rhkeaQBchGOEWnwEmc0uKWZj0LeuNV3W4Y2lZHFlQCSRjTIl8uZ+kG5HU/3sRlnTG2ytyadytnD3HrmuRcSn+0h1dycexIK1KCjYaCnjCCVqOFFJTZ5GkUUjESWaUIKU2lgCmAKKQIUjHapXRKE+t2og1VgankNYnohqKJ2CmKplso6GKz7WYCgqxeuyoF8u9IQAgA7",
            msg: null,
            msgText: "<em>Loading the next set of posts...</em>",
            selector: null,
            speed: "fast",
            start: k
        },
        state: {
            isDuringAjax: false,
            isInvalidPage: false,
            isDestroyed: false,
            isDone: false,
            isPaused: false,
            currPage: 1
        },
        debug: false,
        behavior: k,
        binder: i(o),
        nextSelector: "div.navigation a:first",
        navSelector: "div.navigation",
        contentSelector: null,
        extraScrollPx: 150,
        itemSelector: "div.post",
        animate: false,
        pathParse: k,
        dataType: "html",
        appendCallback: true,
        bufferPx: 40,
        errorCallback: function() {},
        infid: 0,
        pixelsFromNavToBottom: k,
        path: k,
        prefill: false
    };
    i.infinitescroll.prototype = {
        _binding: function g(F) {
            var D = this,
                E = D.options;
            E.v = "2.0b2.120520";
            if ( !! E.behavior && this["_binding_" + E.behavior] !== k) {
                this["_binding_" + E.behavior].call(this);
                return
            }
            if (F !== "bind" && F !== "unbind") {
                this._debug("Binding value  " + F + " not valid");
                return false
            }
            if (F === "unbind") {
                (this.options.binder).unbind("smartscroll.infscr." + D.options.infid)
            } else {
                (this.options.binder)[F]("smartscroll.infscr." + D.options.infid, function() {
                    D.scroll()
                })
            }
            this._debug("Binding", F)
        },
        _create: function t(F, J) {
            var G = i.extend(true, {}, i.infinitescroll.defaults, F);
            this.options = G;
            var I = i(o);
            var D = this;
            if (!D._validate(F)) {
                return false
            }
            var H = i(G.nextSelector).attr("href");
            if (!H) {
                this._debug("Navigation selector not found");
                return false
            }
            G.path = G.path || this._determinepath(H);
            G.contentSelector = G.contentSelector || this.element;
            G.loading.selector = G.loading.selector || G.contentSelector;
            G.loading.msg = G.loading.msg || i('<div id="infscr-loading"><img alt="Loading..." src="' + G.loading.img + '" /><div>' + G.loading.msgText + "</div></div>");
            (new Image()).src = G.loading.img;
            if (G.pixelsFromNavToBottom === k) {
                G.pixelsFromNavToBottom = i(document).height() - i(G.navSelector).offset().top
            }
            var E = this;
            G.loading.start = G.loading.start || function() {
                i(G.navSelector).hide();
                G.loading.msg.appendTo(G.loading.selector).show(G.loading.speed, i.proxy(function() {
                    this.beginAjax(G)
                }, E))
            };
            G.loading.finished = G.loading.finished || function() {
                G.loading.msg.fadeOut(G.loading.speed)
            };
            G.callback = function(K, M, L) {
                if ( !! G.behavior && K["_callback_" + G.behavior] !== k) {
                    K["_callback_" + G.behavior].call(i(G.contentSelector)[0], M, L)
                }
                if (J) {
                    J.call(i(G.contentSelector)[0], M, G, L)
                }
                if (G.prefill) {
                    I.bind("resize.infinite-scroll", K._prefill)
                }
            };
            if (F.debug) {
                if (Function.prototype.bind && (typeof console === "object" || typeof console === "function") && typeof console.log === "object") {
                    ["log", "info", "warn", "error", "assert", "dir", "clear", "profile", "profileEnd"].forEach(function(K) {
                        console[K] = this.call(console[K], console)
                    }, Function.prototype.bind)
                }
            }
            this._setup();
            if (G.prefill) {
                this._prefill()
            }
            return true
        },
        _prefill: function n() {
            var D = this;
            var G = i(document);
            var F = i(o);

            function E() {
                return (G.height() <= F.height())
            }
            this._prefill = function() {
                if (E()) {
                    D.scroll()
                }
                F.bind("resize.infinite-scroll", function() {
                    if (E()) {
                        F.unbind("resize.infinite-scroll");
                        D.scroll()
                    }
                })
            };
            this._prefill()
        },
        _debug: function q() {
            if (true !== this.options.debug) {
                return
            }
            if (typeof console !== "undefined" && typeof console.log === "function") {
                if ((Array.prototype.slice.call(arguments)).length === 1 && typeof Array.prototype.slice.call(arguments)[0] === "string") {
                    console.log((Array.prototype.slice.call(arguments)).toString())
                } else {
                    console.log(Array.prototype.slice.call(arguments))
                }
            } else {
                if (!Function.prototype.bind && typeof console !== "undefined" && typeof console.log === "object") {
                    Function.prototype.call.call(console.log, console, Array.prototype.slice.call(arguments))
                }
            }
        },
        _determinepath: function A(E) {
            var D = this.options;
            if ( !! D.behavior && this["_determinepath_" + D.behavior] !== k) {
                return this["_determinepath_" + D.behavior].call(this, E)
            }
            if ( !! D.pathParse) {
                this._debug("pathParse manual");
                return D.pathParse(E, this.options.state.currPage + 1)
            } else {
                if (E.match(/^(.*?)\b2\b(.*?$)/)) {
                    E = E.match(/^(.*?)\b2\b(.*?$)/).slice(1)
                } else {
                    if (E.match(/^(.*?)2(.*?$)/)) {
                        if (E.match(/^(.*?page=)2(\/.*|$)/)) {
                            E = E.match(/^(.*?page=)2(\/.*|$)/).slice(1);
                            return E
                        }
                        E = E.match(/^(.*?)2(.*?$)/).slice(1)
                    } else {
                        if (E.match(/^(.*?page=)1(\/.*|$)/)) {
                            E = E.match(/^(.*?page=)1(\/.*|$)/).slice(1);
                            return E
                        } else {
                            this._debug("Sorry, we couldn't parse your Next (Previous Posts) URL. Verify your the css selector points to the correct A tag. If you still get this error: yell, scream, and kindly ask for help at infinite-scroll.com.");
                            D.state.isInvalidPage = true
                        }
                    }
                }
            }
            this._debug("determinePath", E);
            return E
        },
        _error: function v(E) {
            var D = this.options;
            if ( !! D.behavior && this["_error_" + D.behavior] !== k) {
                this["_error_" + D.behavior].call(this, E);
                return
            }
            if (E !== "destroy" && E !== "end") {
                E = "unknown"
            }
            this._debug("Error", E);
            if (E === "end") {
                this._showdonemsg()
            }
            D.state.isDone = true;
            D.state.currPage = 1;
            D.state.isPaused = false;
            this._binding("unbind")
        },
        _loadcallback: function c(H, G, E) {
            var D = this.options,
                J = this.options.callback,
                L = (D.state.isDone) ? "done" : (!D.appendCallback) ? "no-append" : "append",
                K;
            if ( !! D.behavior && this["_loadcallback_" + D.behavior] !== k) {
                this["_loadcallback_" + D.behavior].call(this, H, G);
                return
            }
            switch (L) {
                case "done":
                    this._showdonemsg();
                    return false;
                case "no-append":
                    if (D.dataType === "html") {
                        G = "<div>" + G + "</div>";
                        G = i(G).find(D.itemSelector)
                    }
                    break;
                case "append":
                    var F = H.children();
                    if (F.length === 0) {
                        return this._error("end")
                    }
                    K = document.createDocumentFragment();
                    while (H[0].firstChild) {
                        K.appendChild(H[0].firstChild)
                    }
                    this._debug("contentSelector", i(D.contentSelector)[0]);
                    i(D.contentSelector)[0].appendChild(K);
                    G = F.get();
                    break
            }
            D.loading.finished.call(i(D.contentSelector)[0], D);
            if (D.animate) {
                var I = i(o).scrollTop() + i("#infscr-loading").height() + D.extraScrollPx + "px";
                i("html,body").animate({
                    scrollTop: I
                }, 800, function() {
                    D.state.isDuringAjax = false
                })
            }
            if (!D.animate) {
                D.state.isDuringAjax = false
            }
            J(this, G, E);
            if (D.prefill) {
                this._prefill()
            }
        },
        _nearbottom: function u() {
            var E = this.options,
                D = 0 + i(document).height() - (E.binder.scrollTop()) - i(o).height();
            if ( !! E.behavior && this["_nearbottom_" + E.behavior] !== k) {
                return this["_nearbottom_" + E.behavior].call(this)
            }
            this._debug("math:", D, E.pixelsFromNavToBottom);
            return (D - E.bufferPx < E.pixelsFromNavToBottom)
        },
        _pausing: function l(E) {
            var D = this.options;
            if ( !! D.behavior && this["_pausing_" + D.behavior] !== k) {
                this["_pausing_" + D.behavior].call(this, E);
                return
            }
            if (E !== "pause" && E !== "resume" && E !== null) {
                this._debug("Invalid argument. Toggling pause value instead")
            }
            E = (E && (E === "pause" || E === "resume")) ? E : "toggle";
            switch (E) {
                case "pause":
                    D.state.isPaused = true;
                    break;
                case "resume":
                    D.state.isPaused = false;
                    break;
                case "toggle":
                    D.state.isPaused = !D.state.isPaused;
                    break
            }
            this._debug("Paused", D.state.isPaused);
            return false
        },
        _setup: function r() {
            var D = this.options;
            if ( !! D.behavior && this["_setup_" + D.behavior] !== k) {
                this["_setup_" + D.behavior].call(this);
                return
            }
            this._binding("bind");
            return false
        },
        _showdonemsg: function a() {
            var D = this.options;
            if ( !! D.behavior && this["_showdonemsg_" + D.behavior] !== k) {
                this["_showdonemsg_" + D.behavior].call(this);
                return
            }
            D.loading.msg.find("img").hide().parent().find("div").html(D.loading.finishedMsg).animate({
                opacity: 1
            }, 2000, function() {
                i(this).parent().fadeOut(D.loading.speed)
            });
            D.errorCallback.call(i(D.contentSelector)[0], "done")
        },
        _validate: function w(E) {
            for (var D in E) {
                if (D.indexOf && D.indexOf("Selector") > -1 && i(E[D]).length === 0) {
                    this._debug("Your " + D + " found no elements.");
                    return false
                }
            }
            return true
        },
        bind: function p() {
            this._binding("bind")
        },
        destroy: function C() {
            this.options.state.isDestroyed = true;
            return this._error("destroy")
        },
        pause: function e() {
            this._pausing("pause")
        },
        resume: function h() {
            this._pausing("resume")
        },
        beginAjax: function B(G) {
            var E = this,
                I = G.path,
                F, D, K, J;
            G.state.currPage++;
            F = i(G.contentSelector).is("table") ? i("<tbody/>") : i("<div/>");
            D = (typeof I === "function") ? I(G.state.currPage) : I.join(G.state.currPage);
            E._debug("heading into ajax", D);
            K = (G.dataType === "html" || G.dataType === "json") ? G.dataType : "html+callback";
            if (G.appendCallback && G.dataType === "html") {
                K += "+callback"
            }
            switch (K) {
                case "html+callback":
                    E._debug("Using HTML via .load() method");
                    F.load(D + " " + G.itemSelector, k, function H(L) {
                        E._loadcallback(F, L, D)
                    });
                    break;
                case "html":
                    E._debug("Using " + (K.toUpperCase()) + " via $.ajax() method");
                    i.ajax({
                        url: D,
                        dataType: G.dataType,
                        complete: function H(L, M) {
                            J = (typeof(L.isResolved) !== "undefined") ? (L.isResolved()) : (M === "success" || M === "notmodified");
                            if (J) {
                                E._loadcallback(F, L.responseText, D)
                            } else {
                                E._error("end")
                            }
                        }
                    });
                    break;
                case "json":
                    E._debug("Using " + (K.toUpperCase()) + " via $.ajax() method");
                    i.ajax({
                        dataType: "json",
                        type: "GET",
                        url: D,
                        success: function(N, O, M) {
                            J = (typeof(M.isResolved) !== "undefined") ? (M.isResolved()) : (O === "success" || O === "notmodified");
                            if (G.appendCallback) {
                                if (G.template !== k) {
                                    var L = G.template(N);
                                    F.append(L);
                                    if (J) {
                                        E._loadcallback(F, L)
                                    } else {
                                        E._error("end")
                                    }
                                } else {
                                    E._debug("template must be defined.");
                                    E._error("end")
                                }
                            } else {
                                if (J) {
                                    E._loadcallback(F, N, D)
                                } else {
                                    E._error("end")
                                }
                            }
                        },
                        error: function() {
                            E._debug("JSON ajax request failed.");
                            E._error("end")
                        }
                    });
                    break
            }
        },
        retrieve: function b(F) {
            F = F || null;
            var D = this,
                E = D.options;
            if ( !! E.behavior && this["retrieve_" + E.behavior] !== k) {
                this["retrieve_" + E.behavior].call(this, F);
                return
            }
            if (E.state.isDestroyed) {
                this._debug("Instance is destroyed");
                return false
            }
            E.state.isDuringAjax = true;
            E.loading.start.call(i(E.contentSelector)[0], E)
        },
        scroll: function f() {
            var D = this.options,
                E = D.state;
            if ( !! D.behavior && this["scroll_" + D.behavior] !== k) {
                this["scroll_" + D.behavior].call(this);
                return
            }
            if (E.isDuringAjax || E.isInvalidPage || E.isDone || E.isDestroyed || E.isPaused) {
                return
            }
            if (!this._nearbottom()) {
                return
            }
            this.retrieve()
        },
        toggle: function y() {
            this._pausing()
        },
        unbind: function m() {
            this._binding("unbind")
        },
        update: function j(D) {
            if (i.isPlainObject(D)) {
                this.options = i.extend(true, this.options, D)
            }
        }
    };
    i.fn.infinitescroll = function d(F, G) {
        var E = typeof F;
        switch (E) {
            case "string":
                var D = Array.prototype.slice.call(arguments, 1);
                this.each(function() {
                    var H = i.data(this, "infinitescroll");
                    if (!H) {
                        return false
                    }
                    if (!i.isFunction(H[F]) || F.charAt(0) === "_") {
                        return false
                    }
                    H[F].apply(H, D)
                });
                break;
            case "object":
                this.each(function() {
                    var H = i.data(this, "infinitescroll");
                    if (H) {
                        H.update(F)
                    } else {
                        H = new i.infinitescroll(F, G, this);
                        if (!H.failed) {
                            i.data(this, "infinitescroll", H)
                        }
                    }
                });
                break
        }
        return this
    };
    var x = i.event,
        s;
    x.special.smartscroll = {
        setup: function() {
            i(this).bind("scroll", x.special.smartscroll.handler)
        },
        teardown: function() {
            i(this).unbind("scroll", x.special.smartscroll.handler)
        },
        handler: function(G, D) {
            var F = this,
                E = arguments;
            G.type = "smartscroll";
            if (s) {
                clearTimeout(s)
            }
            s = setTimeout(function() {
                i.event.handle.apply(F, E)
            }, D === "execAsap" ? 0 : 100)
        }
    };
    i.fn.smartscroll = function(D) {
        return D ? this.bind("smartscroll", D) : this.trigger("smartscroll", ["execAsap"])
    }
})(window, jQuery);

;

/*
 * DC Mega Menu - jQuery mega menu
 * Copyright (c) 2011 Design Chemical
 *
 */
(function($) {

    //define the defaults for the plugin and how to call it 
    $.fn.dcMegaMenu = function(options) {
        //set default options  
        var defaults = {
            classParent: 'dc-mega',
            classContainer: 'sub-container',
            classSubParent: 'mega-hdr',
            classSubLink: 'mega-hdr',
            classWidget: 'dc-extra',
            rowItems: 6,
            speed: 'fast',
            effect: 'fade',
            event: 'hover',
            fullWidth: false,
            onLoad: function() {},
            beforeOpen: function() {},
            beforeClose: function() {}
        };


        //call in the default otions
        var mega_div_width = mk_grid_width - 30;
        var options = $.extend(defaults, options);
        var $dcMegaMenuObj = this;

        //act upon the element that is passed into the design    
        return $dcMegaMenuObj.each(function(options) {

            var clSubParent = defaults.classSubParent;
            var clSubLink = defaults.classSubLink;
            var clParent = defaults.classParent;
            var clContainer = defaults.classContainer;
            var clWidget = defaults.classWidget;
            //console.log(jQuery(this).parents('.mk-header-nav-container').width());

            megaSetup();

            function megaOver() {
                var subNav = $('.sub', this);
                $(this).addClass('mega-hover');
                if (defaults.effect === 'fade') {
                    $(subNav).fadeIn(defaults.speed);
                }
                if (defaults.effect === 'slide') {
                    $(subNav).show(defaults.speed);
                }
                // beforeOpen callback;
                defaults.beforeOpen.call(this);
            }

            function megaAction(obj) {
                var subNav = $('.sub', obj);
                $(obj).addClass('mega-hover');
                if (defaults.effect === 'fade') {
                    $(subNav).fadeIn(defaults.speed);
                }
                if (defaults.effect === 'slide') {
                    $(subNav).show(defaults.speed);
                }
                // beforeOpen callback;
                defaults.beforeOpen.call(this);
            }

            function megaOut() {
                var subNav = $('.sub', this);
                $(this).removeClass('mega-hover');
                $(subNav).hide();
                // beforeClose callback;
                defaults.beforeClose.call(this);
            }

            function megaActionClose(obj) {
                var subNav = $('.sub', obj);
                $(obj).removeClass('mega-hover');
                $(subNav).hide();
                // beforeClose callback;
                defaults.beforeClose.call(this);
            }

            function megaReset() {
                $('li', $dcMegaMenuObj).removeClass('mega-hover');
                $('.sub', $dcMegaMenuObj).hide();
            }

            function megaSetup() {
                //$arrow = '<span class="dc-mega-icon"></span>';
                var clParentLi = clParent + '-li';
                var menuWidth = $dcMegaMenuObj.outerWidth();
                $('> li', $dcMegaMenuObj).each(function() {
                    //Set Width of sub
                    var $mainSub = $('> ul', this);
                    var $primaryLink = $('> a', this);
                    if ($mainSub.length) {
                        //$primaryLink.addClass(clParent).append($arrow);
                        $mainSub.addClass('sub').wrap('<div class="' + clContainer + '" />');

                        var pos = $(this).position();
                        pl = pos.left;

                        // checks whether its a mega menu. editd by MK    
                        if ($('ul.mk_mega_menu', $mainSub).length) {
                            $(this).addClass(clParentLi);
                            $('.' + clContainer, this).addClass('mega');
                            $('> li', $mainSub).each(function() {
                                if (!$(this).hasClass(clWidget)) {
                                    $(this).addClass('mega-unit');
                                    if ($('> ul', this).length) {
                                        $(this).addClass(clSubParent);
                                        $('> a', this).addClass(clSubParent + '-a');
                                    } else {
                                        $(this).addClass(clSubLink);
                                        $('> a', this).addClass(clSubLink + '-a');
                                    }
                                }
                            });

                            // Create Rows
                            var hdrs = $('.mega-unit', this);
                            rowSize = parseInt(defaults.rowItems);
                            for (var i = 0; i < hdrs.length; i += rowSize) {
                                hdrs.slice(i, i + rowSize).wrapAll('<div class="row" />');
                            }

                            // Get Sub Dimensions & Set Row Height
                            $mainSub.show();

                            // Get Position of Parent Item
                            var pw = $(this).width();
                            var pr = pl + pw;

                            // Check available right margin
                            var mr = menuWidth - pr;

                            // // Calc Width of Sub Menu
                            var subw = $mainSub.outerWidth();
                            var totw = $mainSub.parent('.' + clContainer).outerWidth();
                            var cpad = totw - subw;

                            if (defaults.fullWidth === true) {
                                var fw = menuWidth - cpad;
                                $mainSub.parent('.' + clContainer).css({
                                    width: mega_div_width
                                });
                                $dcMegaMenuObj.addClass('full-width');
                            }
                            var iw = $('.mega-unit', $mainSub).outerWidth(true);
                            var rowItems = $('.row:eq(0) .mega-unit', $mainSub).length;
                            var inneriw = iw * rowItems;
                            var totiw = inneriw + cpad;

                            // Set mega header height
                            $('.row', this).each(function() {
                                $('.mega-unit:last', this).addClass('last');
                                var maxValue = undefined;
                                $('.mega-unit > a', this).each(function() {
                                    var val = parseInt($(this).height());
                                    if (maxValue === undefined || maxValue < val) {
                                        maxValue = val;
                                    }
                                });
                                $('.mega-unit > a', this).css('height', maxValue + 'px');
                                $(this).css('width', inneriw + 'px');
                            });

                            // Calc Required Left Margin incl additional required for right align

                           if(defaults.fullWidth == true){
                                params = {left: 0};
                            } else {
                                
                                var ml = mr < ml ? ml + ml - mr : (totiw - pw)/2;
                                var subLeft = pl - ml;

                                // If Left Position Is Negative Set To Left Margin
                                var params = {left: pl+'px', marginLeft: -ml+'px'};
                                
                                if(subLeft < 0){
                                    params = {left: 0};
                                }else if(mr < ml){
                                    params = {right: 0};
                                }
                            }
                            $('.'+clContainer,this).css(params);
                            
                            // Calculate Row Height
                            $('.row',$mainSub).each(function(){
                                var rh = $(this).height();
                                $('.mega-unit',this).css({height: rh+'px'});
                                $(this).parent('.row').css({height: rh+'px'});
                            });
                            $mainSub.hide();
                    
                        } else {

                            //var mkSubW = $mainSub.outerWidth();
                            //mega_div_width;   

                            //mkOffsetOut = menuWidth - mkSubW;


                            //console.log(pl + ' ' + mkSubW);

                            $('.'+clContainer,this).addClass('non-mega').css('left',pl+'px');
                        }
                        // MK edition
                        if (!$('ul', $mainSub).hasClass('mk_mega_menu')) {
                            $('.' + clContainer, this).addClass('mk-nested-sub');
                            //console.log($('.mk-nested-sub > ul',this).width());
                            $mk_nested_ul = $('.mk-nested-sub > ul', this);
                            $mk_nested_width = $mk_nested_ul.width();

                            $mk_nested_ul.find('ul').css('left', $mk_nested_width + 'px');
                            $mk_nested_ul.find('li').each(function() {
                                var $nested_sub = $('> ul', this);
                                if ($nested_sub.length) {
                                    jQuery(this).append('<i class="mk-mega-icon mk-theme-icon-next-small"></i>');
                                }
                                jQuery(this).hover(function() {
                                    jQuery(this).find('> ul').stop(true, true).delay(200).fadeIn(100);
                                }, function() {
                                    jQuery(this).find('> ul').stop(true, true).delay(200).fadeOut(100);
                                });
                            });

                        }
                    }
                });
                // Set position of mega dropdown to bottom of main menu
                var menuHeight = $('> li > a', $dcMegaMenuObj).outerHeight(true);
                $('.' + clContainer, $dcMegaMenuObj).css({
                    top: menuHeight + 'px'
                }).css('z-index', '1000');

                if (defaults.event == 'hover') {
                    // HoverIntent Configuration
                    var config = {
                        sensitivity: 1,
                        interval: 30,
                        over: megaOver,
                        timeout: 100,
                        out: megaOut
                    };
                    $('li', $dcMegaMenuObj).hoverIntent(config);
                }

                if (defaults.event == 'click') {

                    $('body').mouseup(function(e) {
                        if (!$(e.target).parents('.mega-hover').length) {
                            megaReset();
                        }
                    });

                    $('> li > a.' + clParent, $dcMegaMenuObj).click(function(e) {
                        var $parentLi = $(this).parent();
                        if ($parentLi.hasClass('mega-hover')) {
                            megaActionClose($parentLi);
                        } else {
                            megaAction($parentLi);
                        }
                        e.preventDefault();
                    });
                }

                // onLoad callback;
                defaults.onLoad.call(this);
            }
        });
    };
})(jQuery);

;


/**
 * @depends jquery
 * @name jquery.scrollto
 * @package jquery-scrollto {@link http://balupton.com/projects/jquery-scrollto}
 */

/**
 * jQuery Aliaser
 */
(function(window, undefined) {
    // Prepare
    var jQuery, $, ScrollTo;
    jQuery = $ = window.jQuery;

    /**
     * jQuery ScrollTo (balupton edition)
     * @version 1.2.0
     * @date July 9, 2012
     * @since 0.1.0, August 27, 2010
     * @package jquery-scrollto {@link http://balupton.com/projects/jquery-scrollto}
     * @author Benjamin "balupton" Lupton {@link http://balupton.com}
     * @copyright (c) 2010 Benjamin Arthur Lupton {@link http://balupton.com}
     * @license MIT License {@link http://creativecommons.org/licenses/MIT/}
     */
    ScrollTo = $.ScrollTo = $.ScrollTo || {
        /**
         * The Default Configuration
         */
        config: {
            duration: 400,
            easing: 'swing',
            callback: undefined,
            durationMode: 'each',
            offsetTop: 0,
            offsetLeft: 0
        },

        /**
         * Configure ScrollTo
         */
        configure: function(options) {
            // Apply Options to Config
            $.extend(ScrollTo.config, options || {});

            // Chain
            return this;
        },

        /**
         * Perform the Scroll Animation for the Collections
         * We use $inline here, so we can determine the actual offset start for each overflow:scroll item
         * Each collection is for each overflow:scroll item
         */
        scroll: function(collections, config) {
            // Prepare
            var collection, $container, container, $target, $inline, position,
                containerScrollTop, containerScrollLeft,
                containerScrollTopEnd, containerScrollLeftEnd,
                startOffsetTop, targetOffsetTop, targetOffsetTopAdjusted,
                startOffsetLeft, targetOffsetLeft, targetOffsetLeftAdjusted,
                scrollOptions,
                callback;

            // Determine the Scroll
            collection = collections.pop();
            $container = collection.$container;
            container = $container.get(0);
            $target = collection.$target;

            // Prepare the Inline Element of the Container
            $inline = $('<span/>').css({
                'position': 'absolute',
                'top': '0px',
                'left': '0px'
            });
            position = $container.css('position');

            // Insert the Inline Element of the Container
            $container.css('position', 'relative');
            $inline.appendTo($container);

            // Determine the top offset
            startOffsetTop = $inline.offset().top;
            targetOffsetTop = $target.offset().top;
            targetOffsetTopAdjusted = targetOffsetTop - startOffsetTop - parseInt(config.offsetTop, 10);

            // Determine the left offset
            startOffsetLeft = $inline.offset().left;
            targetOffsetLeft = $target.offset().left;
            targetOffsetLeftAdjusted = targetOffsetLeft - startOffsetLeft - parseInt(config.offsetLeft, 10);

            // Determine current scroll positions
            containerScrollTop = container.scrollTop;
            containerScrollLeft = container.scrollLeft;

            // Reset the Inline Element of the Container
            $inline.remove();
            $container.css('position', position);

            // Prepare the scroll options
            scrollOptions = {};

            // Prepare the callback
            callback = function(event) {
                // Check
                if (collections.length === 0) {
                    // Callback
                    if (typeof config.callback === 'function') {
                        config.callback.apply(this, [event]);
                    }
                } else {
                    // Recurse
                    ScrollTo.scroll(collections, config);
                }
                // Return true
                return true;
            };

            // Handle if we only want to scroll if we are outside the viewport
            if (config.onlyIfOutside) {
                // Determine current scroll positions
                containerScrollTopEnd = containerScrollTop + $container.height();
                containerScrollLeftEnd = containerScrollLeft + $container.width();

                // Check if we are in the range of the visible area of the container
                if (containerScrollTop < targetOffsetTopAdjusted && targetOffsetTopAdjusted < containerScrollTopEnd) {
                    targetOffsetTopAdjusted = containerScrollTop;
                }
                if (containerScrollLeft < targetOffsetLeftAdjusted && targetOffsetLeftAdjusted < containerScrollLeftEnd) {
                    targetOffsetLeftAdjusted = containerScrollLeft;
                }
            }

            // Determine the scroll options
            if (targetOffsetTopAdjusted !== containerScrollTop) {
                scrollOptions.scrollTop = targetOffsetTopAdjusted;
            }
            if (targetOffsetLeftAdjusted !== containerScrollLeft) {
                scrollOptions.scrollLeft = targetOffsetLeftAdjusted;
            }

            // Perform the scroll
            if ($.browser.safari && container === document.body) {
                window.scrollTo(scrollOptions.scrollLeft, scrollOptions.scrollTop);
                callback();
            } else if (scrollOptions.scrollTop || scrollOptions.scrollLeft) {
                $container.animate(scrollOptions, config.duration, config.easing, callback);
            } else {
                callback();
            }

            // Return true
            return true;
        },

        /**
         * ScrollTo the Element using the Options
         */
        fn: function(options) {
            // Prepare
            var collections, config, $container, container;
            collections = [];

            // Prepare
            var $target = $(this);
            if ($target.length === 0) {
                // Chain
                return this;
            }

            // Handle Options
            config = $.extend({}, ScrollTo.config, options);

            // Fetch
            $container = $target.parent();
            container = $container.get(0);

            // Cycle through the containers
            while (($container.length === 1) && (container !== document.body) && (container !== document)) {
                // Check Container for scroll differences
                var scrollTop, scrollLeft;
                scrollTop = $container.css('overflow-y') !== 'visible' && container.scrollHeight !== container.clientHeight;
                scrollLeft = $container.css('overflow-x') !== 'visible' && container.scrollWidth !== container.clientWidth;
                if (scrollTop || scrollLeft) {
                    // Push the Collection
                    collections.push({
                        '$container': $container,
                        '$target': $target
                    });
                    // Update the Target
                    $target = $container;
                }
                // Update the Container
                $container = $container.parent();
                container = $container.get(0);
            }

            // Add the final collection
            collections.push({
                '$container': $(
                    ($.browser.msie || $.browser.mozilla) ? 'html' : 'body'
                ),
                '$target': $target
            });

            // Adjust the Config
            if (config.durationMode === 'all') {
                config.duration /= collections.length;
            }

            // Handle
            ScrollTo.scroll(collections, config);

            // Chain
            return this;
        }
    };

    // Apply our jQuery Prototype Function
    $.fn.ScrollTo = $.ScrollTo.fn;

})(window);

;/*! Copyright (c) 2011 Brandon Aaron (http://brandonaaron.net)
 * Licensed under the MIT License (LICENSE.txt).
 *
 * Thanks to: http://adomas.org/javascript-mouse-wheel/ for some pointers.
 * Thanks to: Mathias Bank(http://www.mathias-bank.de) for a scope bug fix.
 * Thanks to: Seamus Leahy for adding deltaX and deltaY
 *
 * Version: 3.0.6
 *
 * Requires: 1.2.2+
 */

(function($) {

    var types = ['DOMMouseScroll', 'mousewheel'];

    if ($.event.fixHooks) {
        for (var i = types.length; i;) {
            $.event.fixHooks[types[--i]] = $.event.mouseHooks;
        }
    }

    $.event.special.mousewheel = {
        setup: function() {
            if (this.addEventListener) {
                for (var i = types.length; i;) {
                    this.addEventListener(types[--i], handler, false);
                }
            } else {
                this.onmousewheel = handler;
            }
        },

        teardown: function() {
            if (this.removeEventListener) {
                for (var i = types.length; i;) {
                    this.removeEventListener(types[--i], handler, false);
                }
            } else {
                this.onmousewheel = null;
            }
        }
    };

    $.fn.extend({
        mousewheel: function(fn) {
            return fn ? this.bind("mousewheel", fn) : this.trigger("mousewheel");
        },

        unmousewheel: function(fn) {
            return this.unbind("mousewheel", fn);
        }
    });


    function handler(event) {
        var orgEvent = event || window.event,
            args = [].slice.call(arguments, 1),
            delta = 0,
            returnValue = true,
            deltaX = 0,
            deltaY = 0;
        event = $.event.fix(orgEvent);
        event.type = "mousewheel";

        // Old school scrollwheel delta
        if (orgEvent.wheelDelta) {
            delta = orgEvent.wheelDelta / 120;
        }
        if (orgEvent.detail) {
            delta = -orgEvent.detail / 3;
        }

        // New school multidimensional scroll (touchpads) deltas
        deltaY = delta;

        // Gecko
        if (orgEvent.axis !== undefined && orgEvent.axis === orgEvent.HORIZONTAL_AXIS) {
            deltaY = 0;
            deltaX = -1 * delta;
        }

        // Webkit
        if (orgEvent.wheelDeltaY !== undefined) {
            deltaY = orgEvent.wheelDeltaY / 120;
        }
        if (orgEvent.wheelDeltaX !== undefined) {
            deltaX = -1 * orgEvent.wheelDeltaX / 120;
        }

        // Add event and delta to the front of the arguments
        args.unshift(event, delta, deltaX, deltaY);

        return ($.event.dispatch || $.event.handle).apply(this, args);
    }

})(jQuery);;// Generated by CoffeeScript 1.4.0
/*
Easy pie chart is a jquery plugin to display simple animated pie charts for only one value

Dual licensed under the MIT (http://www.opensource.org/licenses/mit-license.php)
and GPL (http://www.opensource.org/licenses/gpl-license.php) licenses.

Built on top of the jQuery library (http://jquery.com)

@source: http://github.com/rendro/easy-pie-chart/
@autor: Robert Fleischmann
@version: 1.1.0

Inspired by: http://dribbble.com/shots/631074-Simple-Pie-Charts-II?list=popular&offset=210
Thanks to Philip Thrasher for the jquery plugin boilerplate for coffee script
*/

(function($) {
    $.easyPieChart = function(el, options) {
        var addScaleLine, animateLine, drawLine, easeInOutQuad, rAF, renderBackground, renderScale, renderTrack,
            _this = this;
        this.el = el;
        this.$el = $(el);
        this.$el.data("easyPieChart", this);
        this.init = function() {
            var percent, scaleBy;
            _this.options = $.extend({}, $.easyPieChart.defaultOptions, options);
            percent = parseInt(_this.$el.data('percent'), 10);
            _this.percentage = 0;
            _this.canvas = $("<canvas width='" + _this.options.size + "' height='" + _this.options.size + "'></canvas>").get(0);
            _this.$el.append(_this.canvas);
            if (typeof G_vmlCanvasManager !== "undefined" && G_vmlCanvasManager !== null) {
                G_vmlCanvasManager.initElement(_this.canvas);
            }
            _this.ctx = _this.canvas.getContext('2d');
            if (window.devicePixelRatio > 1) {
                scaleBy = window.devicePixelRatio;
                $(_this.canvas).css({
                    width: _this.options.size,
                    height: _this.options.size
                });
                _this.canvas.width *= scaleBy;
                _this.canvas.height *= scaleBy;
                _this.ctx.scale(scaleBy, scaleBy);
            }
            _this.ctx.translate(_this.options.size / 2, _this.options.size / 2);
            _this.$el.addClass('easyPieChart');
            _this.$el.css({
                width: _this.options.size,
                height: _this.options.size,
                lineHeight: "" + _this.options.size + "px"
            });
            _this.update(percent);
            return _this;
        };
        this.update = function(percent) {
            percent = parseFloat(percent) || 0;
            if (_this.options.animate === false) {
                drawLine(percent);
            } else {
                animateLine(_this.percentage, percent);
            }
            return _this;
        };
        renderScale = function() {
            var i, _i, _results;
            _this.ctx.fillStyle = _this.options.scaleColor;
            _this.ctx.lineWidth = 1;
            _results = [];
            for (i = _i = 0; _i <= 24; i = ++_i) {
                _results.push(addScaleLine(i));
            }
            return _results;
        };
        addScaleLine = function(i) {
            var offset;
            offset = i % 6 === 0 ? 0 : _this.options.size * 0.017;
            _this.ctx.save();
            _this.ctx.rotate(i * Math.PI / 12);
            _this.ctx.fillRect(_this.options.size / 2 - offset, 0, -_this.options.size * 0.05 + offset, 1);
            _this.ctx.restore();
        };
        renderTrack = function() {
            var offset;
            offset = _this.options.size / 2 - _this.options.lineWidth / 2;
            if (_this.options.scaleColor !== false) {
                offset -= _this.options.size * 0.08;
            }
            _this.ctx.beginPath();
            _this.ctx.arc(0, 0, offset, 0, Math.PI * 2, true);
            _this.ctx.closePath();
            _this.ctx.strokeStyle = _this.options.trackColor;
            _this.ctx.lineWidth = _this.options.lineWidth;
            _this.ctx.stroke();
        };
        renderBackground = function() {
            if (_this.options.scaleColor !== false) {
                renderScale();
            }
            if (_this.options.trackColor !== false) {
                renderTrack();
            }
        };
        drawLine = function(percent) {
            var offset;
            renderBackground();
            _this.ctx.strokeStyle = $.isFunction(_this.options.barColor) ? _this.options.barColor(percent) : _this.options.barColor;
            _this.ctx.lineCap = _this.options.lineCap;
            _this.ctx.lineWidth = _this.options.lineWidth;
            offset = _this.options.size / 2 - _this.options.lineWidth / 2;
            if (_this.options.scaleColor !== false) {
                offset -= _this.options.size * 0.08;
            }
            _this.ctx.save();
            _this.ctx.rotate(-Math.PI / 2);
            _this.ctx.beginPath();
            _this.ctx.arc(0, 0, offset, 0, Math.PI * 2 * percent / 100, false);
            _this.ctx.stroke();
            _this.ctx.restore();
        };
        rAF = (function() {
            return window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame || function(callback) {
                return window.setTimeout(callback, 1000 / 60);
            };
        })();
        animateLine = function(from, to) {
            var anim, startTime;
            _this.options.onStart.call(_this);
            _this.percentage = to;
            startTime = Date.now();
            anim = function() {
                var currentValue, process;
                process = Date.now() - startTime;
                if (process < _this.options.animate) {
                    rAF(anim);
                }
                _this.ctx.clearRect(-_this.options.size / 2, -_this.options.size / 2, _this.options.size, _this.options.size);
                renderBackground.call(_this);
                currentValue = [easeInOutQuad(process, from, to - from, _this.options.animate)];
                _this.options.onStep.call(_this, currentValue);
                drawLine.call(_this, currentValue);
                if (process >= _this.options.animate) {
                    return _this.options.onStop.call(_this);
                }
            };
            rAF(anim);
        };
        easeInOutQuad = function(t, b, c, d) {
            var easeIn, easing;
            easeIn = function(t) {
                return Math.pow(t, 2);
            };
            easing = function(t) {
                if (t < 1) {
                    return easeIn(t);
                } else {
                    return 2 - easeIn((t / 2) * -2 + 2);
                }
            };
            t /= d / 2;
            return c / 2 * easing(t) + b;
        };
        return this.init();
    };
    $.easyPieChart.defaultOptions = {
        barColor: '#ef1e25',
        trackColor: '#f2f2f2',
        scaleColor: '#dfe0e0',
        lineCap: 'round',
        size: 110,
        lineWidth: 3,
        animate: false,
        onStart: $.noop,
        onStop: $.noop,
        onStep: $.noop
    };
    $.fn.easyPieChart = function(options) {
        return $.each(this, function(i, el) {
            var $el;
            $el = $(el);
            if (!$el.data('easyPieChart')) {
                return $el.data('easyPieChart', new $.easyPieChart(el, options));
            }
        });
    };
    return void 0;
})(jQuery);;/**
 * downCount: Simple Countdown clock with offset
 * Author: Sonny T. <hi@sonnyt.com>, sonnyt.com
 */

(function ($) {

    $.fn.downCount = function (options, callback) {
        var settings = $.extend({
                date: null,
                offset: null
            }, options);

        // Throw error if date is not set
        if (!settings.date) {
            $.error('Date is not defined.');
        }

        // Throw error if date is set incorectly
        if (!Date.parse(settings.date)) {
            $.error('Incorrect date format, it should look like this, 12/24/2012 12:00:00.');
        }

        // Save container
        var container = this;

        /**
         * Change client's local date to match offset timezone
         * @return {Object} Fixed Date object.
         */
        var currentDate = function () {
            // get client's current date
            var date = new Date();

            // turn date to utc
            var utc = date.getTime() + (date.getTimezoneOffset() * 60000);

            // set new Date object
            var new_date = new Date(utc + (3600000*settings.offset))

            return new_date;
        };

        /**
         * Main downCount function that calculates everything
         */
        function countdown () {
            var target_date = new Date(settings.date), // set target date
                current_date = currentDate(); // get fixed current date

            // difference of dates
            var difference = target_date - current_date;

            // if difference is negative than it's pass the target date
            if (difference < 0) {
                // stop timer
                clearInterval(interval);

                if (callback && typeof callback === 'function') callback();

                return;
            }

            // basic math variables
            var _second = 1000,
                _minute = _second * 60,
                _hour = _minute * 60,
                _day = _hour * 24;

            // calculate dates
            var days = Math.floor(difference / _day),
                hours = Math.floor((difference % _day) / _hour),
                minutes = Math.floor((difference % _hour) / _minute),
                seconds = Math.floor((difference % _minute) / _second);

                // fix dates so that it will show two digets
                days = (String(days).length >= 2) ? days : '0' + days;
                hours = (String(hours).length >= 2) ? hours : '0' + hours;
                minutes = (String(minutes).length >= 2) ? minutes : '0' + minutes;
                seconds = (String(seconds).length >= 2) ? seconds : '0' + seconds;

            // based on the date change the refrence wording
            var ref_days = (days === 1) ? 'day' : 'days',
                ref_hours = (hours === 1) ? 'hour' : 'hours',
                ref_minutes = (minutes === 1) ? 'minute' : 'minutes',
                ref_seconds = (seconds === 1) ? 'second' : 'seconds';

            // set to DOM
            container.find('.days').text(days);
            container.find('.hours').text(hours);
            container.find('.minutes').text(minutes);
            container.find('.seconds').text(seconds);

            container.find('.days_ref').text(ref_days);
            container.find('.hours_ref').text(ref_hours);
            container.find('.minutes_ref').text(ref_minutes);
            container.find('.seconds_ref').text(ref_seconds);
        };
        
        // start
        var interval = setInterval(countdown, 1000);
    };

})(jQuery);

;/*
 * debouncedresize: special jQuery event that happens once after a window resize
 *
 * latest version and complete README available on Github:
 * https://github.com/louisremi/jquery-smartresize
 *
 * Copyright 2012 @louis_remi
 * Licensed under the MIT license.
 *
 * This saved you an hour of work?
 * Send me music http://www.amazon.co.uk/wishlist/HNTU0468LQON
 */
(function($) {

    var $event = $.event,
        $special, resizeTimeout;

    $special = $event.special.debouncedresize = {
        setup: function() {
            $(this).on("resize", $special.handler);
        },
        teardown: function() {
            $(this).off("resize", $special.handler);
        },
        handler: function(event, execAsap) {
            // Save the context
            var context = this,
                args = arguments,
                dispatch = function() {
                    // set correct event type
                    event.type = "debouncedresize";
                    $event.dispatch.apply(context, args);
                };

            if (resizeTimeout) {
                clearTimeout(resizeTimeout);
            }

            execAsap ? dispatch() : resizeTimeout = setTimeout(dispatch, $special.threshold);
        },
        threshold: 150
    };

})(jQuery);;/*
Plugin: jQuery Parallax
Version 1.1.3
Author: Ian Lunn
Twitter: @IanLunn
Author URL: http://www.ianlunn.co.uk/
Plugin URL: http://www.ianlunn.co.uk/plugins/jquery-parallax/

Dual licensed under the MIT and GPL licenses:
http://www.opensource.org/licenses/mit-license.php
http://www.gnu.org/licenses/gpl.html
*/

// (function($) {
//    var $window = $(window);
//    var windowHeight = $window.height();
//    $window.resize(function() {
//        windowHeight = $window.height();
//    });
//    $.fn.parallaxScroll = function(xpos, speedFactor, direction, outerHeight) {
//        var $this = $(this).parent().parent();
//        var $parallaxLayer = $( this );
//        var getHeight;
//        var firstTop;
//        var paddingTop = 0;
//        //get the starting position of each element to have parallax applied to it      
//        $this.each(function() {
//            firstTop = $this.offset().top;
//        });
//        if (outerHeight) {
//            getHeight = function(jqo) {
//                return jqo.outerHeight(true);
//            };
//        } else {
//            getHeight = function(jqo) {
//                return jqo.height();
//            };
//        }
//        // setup defaults if arguments aren't specified
//        if (arguments.length < 1 || xpos === null) xpos = "50%";
//        if (arguments.length < 2 || speedFactor === null) speedFactor = 0.1;
//        if (arguments.length < 3 || outerHeight === null) outerHeight = false;
//        // function to be called whenever the window is scrolled or resized
//        function update() {
//            var pos = $window.scrollTop();
//            $this.each(function() {
//                var $element = $(this);
//                var top = $element.offset().top;
//                var height = getHeight($element);
//                // Check if totally above or totally below viewport
//                if (top + height < pos || top > pos + windowHeight) {
//                    return;
//                }
//                var fixedFix = ($parallaxLayer.data('attach') == 'fixed' || $parallaxLayer.attr('css-attach') == 'fixed') ? $parallaxLayer.height() : 0;
//                if (direction == 'horizontal') {
//                    $parallaxLayer.css('backgroundPosition', Math.round(((- pos) * speedFactor) - fixedFix) + "px" + " " + xpos);
//                } else {
//                    // var temporaryValue = Math.round((- pos) * speedFactor);
// -                    $parallaxLayer.css({
//                       'backgroundPosition': xpos + " " + Math.round((- pos * speedFactor) - fixedFix) + "px",
//                       'backgroundRepeat': 'repeat'
//                      })

//                    // $parallaxLayer.css('backgroundPosition', xpos + " calc(50% + " + temporaryValue + "px)");
//                }
//            });
//        }
//        $window.bind('scroll', update).resize(update);
//        //update();
//    };
// })(jQuery);;// jquery.events.frame.js
// 1.1 - lite
// Stephen Band
// 
// Project home:
// webdev.stephband.info/events/frame/
//
// Source:
// http://github.com/stephband/jquery.event.frame

(function(jQuery, undefined) {

    var timer;

    // Timer constructor
    // fn - callback to call on each frame, with context set to the timer object
    // fd - frame duration in milliseconds

    function Timer(fn, fd) {
        var self = this,
            clock;

        function update() {
            self.frameCount++;
            fn.call(self);
        }

        this.frameDuration = fd || 25;
        this.frameCount = -1;
        this.start = function() {
            update();
            clock = setInterval(update, this.frameDuration);
        };
        this.stop = function() {
            clearInterval(clock);
            clock = null;
        };
    }

    // callHandler() is the callback given to the timer object,
    // it makes the event object and calls the handler
    // context is the timer object

    function callHandler() {
        var fn = jQuery.event.special.frame.handler,
            event = jQuery.Event("frame"),
            array = this.array,
            l = array.length;

        // Give event object properties
        event.frameCount = this.frameCount;

        // Call handler on each elem in array
        while (l--) {
            fn.call(array[l], event);
        }
    }

    if (!jQuery.event.special.frame) {
        jQuery.event.special.frame = {
            // Fires the first time an event is bound per element
            setup: function(data, namespaces) {
                if (timer) {
                    timer.array.push(this);
                } else {
                    timer = new Timer(callHandler, data && data.frameDuration);
                    timer.array = [this];

                    // Queue timer to start as soon as this thread has finished
                    var t = setTimeout(function() {
                        timer.start();
                        clearTimeout(t);
                        t = null;
                    }, 0);
                }
                return;
            },
            // Fires last time event is unbound per element
            teardown: function(namespaces) {
                var array = timer.array,
                    l = array.length;

                // Remove element from list
                while (l--) {
                    if (array[l] === this) {
                        array.splice(l, 1);
                        break;
                    }
                }

                // Stop and remove timer when no elems left
                if (array.length === 0) {
                    timer.stop();
                    timer = undefined;
                }
                return;
            },
            handler: function(event) {
                // let jQuery handle the calling of event handlers
                jQuery.event.handle.apply(this, arguments);
            }
        };
    }

})(jQuery);;// jquery.parallax.js
// 2.0
// Stephen Band
//
// Project and documentation site:
// webdev.stephband.info/jparallax/
//
// Repository:
// github.com/stephband/jparallax

(function(jQuery, undefined) {
    // VAR
    var debug = true,
        
        options = {
            mouseport:     'body',  // jQuery object or selector of DOM node to use as mouseport
            xparallax:     true,    // boolean | 0-1 | 'npx' | 'n%'
            yparallax:     true,    //
            xorigin:       0.5,     // 0-1 - Sets default alignment. Only has effect when parallax values are something other than 1 (or true, or '100%')
            yorigin:       0.5,     //
            decay:         0.66,    // 0-1 (0 instant, 1 forever) - Sets rate of decay curve for catching up with target mouse position
            frameDuration: 30,      // Int (milliseconds)
            freezeClass:   'freeze' // String - Class added to layer when frozen
        },
    
        value = {
            left: 0,
            top: 0,
            middle: 0.5,
            center: 0.5,
            right: 1,
            bottom: 1
        },
    
        rpx = /^\d+\s?px$/,
        rpercent = /^\d+\s?%$/,
        
        win = jQuery(window),
        doc = jQuery(document),
        mouse = [0, 0];
    
    var Timer = (function(){
        var debug = false;
        
        // Shim for requestAnimationFrame, falling back to timer. See:
        // see http://paulirish.com/2011/requestanimationframe-for-smart-animating/
        var requestFrame = (function(){
                return (
                    window.requestAnimationFrame ||
                    window.webkitRequestAnimationFrame ||
                    window.mozRequestAnimationFrame ||
                    window.oRequestAnimationFrame ||
                    window.msRequestAnimationFrame ||
                    function(fn, node){
                        return window.setTimeout(function(){
                            fn();
                        }, 25);
                    }
                );
            })();
        
        function Timer() {
            var callbacks = [],
                nextFrame;
            
            function noop() {}
            
            function frame(){
                var cbs = callbacks.slice(0),
                    l = cbs.length,
                    i = -1;
                
                if (debug) { console.log('timer frame()', l); }
                
                while(++i < l) { cbs[i].call(this); }
                requestFrame(nextFrame);
            }
            
            function start() {
                if (debug) { console.log('timer start()'); }
                this.start = noop;
                this.stop = stop;
                nextFrame = frame;
                requestFrame(nextFrame);
            }
            
            function stop() {
                if (debug) { console.log('timer stop()'); }
                this.start = start;
                this.stop = noop;
                nextFrame = noop;
            }
            
            this.callbacks = callbacks;
            this.start = start;
            this.stop = stop;
        }

        Timer.prototype = {
            add: function(fn) {
                var callbacks = this.callbacks,
                    l = callbacks.length;
                
                // Check to see if this callback is already in the list.
                // Don't add it twice.
                while (l--) {
                    if (callbacks[l] === fn) { return; }
                }
                
                this.callbacks.push(fn);
                if (debug) { console.log('timer add()', this.callbacks.length); }
            },
        
            remove: function(fn) {
                var callbacks = this.callbacks,
                    l = callbacks.length;
                
                // Remove all instances of this callback.
                while (l--) {
                    if (callbacks[l] === fn) { callbacks.splice(l, 1); }
                }
                
                if (debug) { console.log('timer remove()', this.callbacks.length); }
                
                if (callbacks.length === 0) { this.stop(); }
            }
        };
        
        return Timer;
    })();
    
    function parseCoord(x) {
        return (rpercent.exec(x)) ? parseFloat(x)/100 : x;
    }
    
    function parseBool(x) {
        return typeof x === "boolean" ? x : !!( parseFloat(x) ) ;
    }
    
    function portData(port) {
        var events = {
                'mouseenter.parallax': mouseenter,
                'mouseleave.parallax': mouseleave
            },
            winEvents = {
                'resize.parallax': resize
            },
            data = {
                elem: port,
                events: events,
                winEvents: winEvents,
                timer: new Timer()
            },
            layers, size, offset;
        
        function updatePointer() {
            data.pointer = getPointer(mouse, [true, true], offset, size);
        }
        
        function resize() {
            size = getSize(port);
            offset = getOffset(port);
            data.threshold = getThreshold(size);
        }
        
        function mouseenter() {
            data.timer.add(updatePointer);
        }
        
        function mouseleave(e) {
            data.timer.remove(updatePointer);
            data.pointer = getPointer([e.pageX, e.pageY], [true, true], offset, size);
        }

        win.on(winEvents);
        port.on(events);
        
        resize();
        
        return data;
    }
    
    function getData(elem, name, fn) {
        var data = elem.data(name);
        
        if (!data) {
            data = fn ? fn(elem) : {} ;
            elem.data(name, data);
        }
        
        return data;
    }
    
    function getPointer(mouse, parallax, offset, size){
        var pointer = [],
            x = 2;
        
        while (x--) {
            pointer[x] = (mouse[x] - offset[x]) / size[x] ;
            pointer[x] = pointer[x] < 0 ? 0 : pointer[x] > 1 ? 1 : pointer[x] ;
        }
        
        return pointer;
    }
    
    function getSize(elem) {
        return [elem.width(), elem.height()];
    }
    
    function getOffset(elem) {
        var offset = elem.offset() || {left: 0, top: 0},
            borderLeft = elem.css('borderLeftStyle') === 'none' ? 0 : parseInt(elem.css('borderLeftWidth'), 10),
            borderTop = elem.css('borderTopStyle') === 'none' ? 0 : parseInt(elem.css('borderTopWidth'), 10),
            paddingLeft = parseInt(elem.css('paddingLeft'), 10),
            paddingTop = parseInt(elem.css('paddingTop'), 10);
        
        return [offset.left + borderLeft + paddingLeft, offset.top + borderTop + paddingTop];
    }
    
    function getThreshold(size) {
        return [1/size[0], 1/size[1]];
    }
    
    function layerSize(elem, x, y) {
        return [x || elem.outerWidth(), y || elem.outerHeight()];
    }
    
    function layerOrigin(xo, yo) {
        var o = [xo, yo],
            i = 2,
            origin = [];
        
        while (i--) {
            origin[i] = typeof o[i] === 'string' ?
                o[i] === undefined ?
                    1 :
                    value[origin[i]] || parseCoord(origin[i]) :
                o[i] ;
        }
        
        return origin;
    }
    
    function layerPx(xp, yp) {
        return [rpx.test(xp), rpx.test(yp)];
    }
    
    function layerParallax(xp, yp, px) {
        var p = [xp, yp],
            i = 2,
            parallax = [];
        
        while (i--) {
            parallax[i] = px[i] ?
                parseInt(p[i], 10) :
                parallax[i] = p[i] === true ? 1 : parseCoord(p[i]) ;
        }
        
        return parallax;
    }
    
    function layerOffset(parallax, px, origin, size) {
        var i = 2,
            offset = [];
        
        while (i--) {
            offset[i] = px[i] ?
                origin[i] * (size[i] - parallax[i]) :
                parallax[i] ? origin[i] * ( 1 - parallax[i] ) : 0 ;
        }
        
        return offset;
    }
    
    function layerPosition(px, origin) {
        var i = 2,
            position = [];
        
        while (i--) {
            if (px[i]) {
                // Set css position constant
                position[i] = origin[i] * 100 + '%';
            }
            else {
            
            }
        }
        
        return position;
    }
    
    function layerPointer(elem, parallax, px, offset, size) {
        var viewport = elem.offsetParent(),
            pos = elem.position(),
            position = [],
            pointer = [],
            i = 2;
        
        // Reverse calculate ratio from elem's current position
        while (i--) {
            position[i] = px[i] ?
                // TODO: reverse calculation for pixel case
                0 :
                pos[i === 0 ? 'left' : 'top'] / (viewport[i === 0 ? 'outerWidth' : 'outerHeight']() - size[i]) ;
            
            pointer[i] = (position[i] - offset[i]) / parallax[i] ;
        }
        
        return pointer;
    }
    
    function layerCss(parallax, px, offset, size, position, pointer) {
        var pos = [],
            cssPosition,
            cssMargin,
            x = 2,
            css = {};
        
        while (x--) {
            if (parallax[x]) {
                pos[x] = parallax[x] * pointer[x] + offset[x];
                
                // We're working in pixels
                if (px[x]) {
                    cssPosition = position[x];
                    cssMargin = pos[x] * -1;
                }
                // We're working by ratio
                else {
                    cssPosition = pos[x] * 100 + '%';
                    cssMargin = pos[x] * size[x] * -1;
                }
                
                // Fill in css object
                if (x === 0) {
                    css.left = cssPosition;
                    css.marginLeft = cssMargin;
                }
                else {
                    css.top = cssPosition;
                    css.marginTop = cssMargin;
                }
            }
        }
        
        return css;
    }
    
    function pointerOffTarget(targetPointer, prevPointer, threshold, decay, parallax, targetFn, updateFn) {
        var pointer, x;
        
        if ((!parallax[0] || Math.abs(targetPointer[0] - prevPointer[0]) < threshold[0]) &&
            (!parallax[1] || Math.abs(targetPointer[1] - prevPointer[1]) < threshold[1])) {
            // Pointer has hit the target
            if (targetFn) { targetFn(); }
            return updateFn(targetPointer);
        }
        
        // Pointer is nowhere near the target
        pointer = [];
        x = 2;
        
        while (x--) {
            if (parallax[x]) {
                pointer[x] = targetPointer[x] + decay * (prevPointer[x] - targetPointer[x]);
            }
        }
            
        return updateFn(pointer);
    }
    
    function pointerOnTarget(targetPointer, prevPointer, threshold, decay, parallax, targetFn, updateFn) {
        // Don't bother updating if the pointer hasn't changed.
        if (targetPointer[0] === prevPointer[0] && targetPointer[1] === prevPointer[1]) {
            return;
        }
        
        return updateFn(targetPointer);
    }
    
    function unport(elem, events, winEvents) {
        elem.off(events).removeData('parallax_port');
        win.off(winEvents);
    }
    
    function unparallax(node, port, events) {
        port.elem.off(events);
        
        // Remove this node from layers
        port.layers = port.layers.not(node);
        
        // If port.layers is empty, destroy the port
        if (port.layers.length === 0) {
            unport(port.elem, port.events, port.winEvents);
        }
    }
    
    function unstyle(parallax) {
        var css = {};
        
        if (parallax[0]) {
            css.left = '';
            css.marginLeft = '';
        }
        
        if (parallax[1]) {
            css.top = '';
            css.marginTop = '';
        }
        
        elem.css(css);
    }
    
    jQuery.fn.parallax = function(o){
        var options = jQuery.extend({}, jQuery.fn.parallax.options, o),
            args = arguments,
            elem = options.mouseport instanceof jQuery ?
                options.mouseport :
                jQuery(options.mouseport) ,
            port = getData(elem, 'parallax_port', portData),
            timer = port.timer;
        
        return this.each(function(i) {
            var node      = this,
                elem      = jQuery(this),
                opts      = args[i + 1] ? jQuery.extend({}, options, args[i + 1]) : options,
                decay     = opts.decay,
                size      = layerSize(elem, opts.width, opts.height),
                origin    = layerOrigin(opts.xorigin, opts.yorigin),
                px        = layerPx(opts.xparallax, opts.yparallax),
                parallax  = layerParallax(opts.xparallax, opts.yparallax, px),
                offset    = layerOffset(parallax, px, origin, size),
                position  = layerPosition(px, origin),
                pointer   = layerPointer(elem, parallax, px, offset, size),
                pointerFn = pointerOffTarget,
                targetFn  = targetInside,
                events = {
                    'mouseenter.parallax': function mouseenter(e) {
                        pointerFn = pointerOffTarget;
                        targetFn = targetInside;
                        timer.add(frame);
                        timer.start();
                    },
                    'mouseleave.parallax': function mouseleave(e) {
                        // Make the layer come to rest at it's limit with inertia
                        pointerFn = pointerOffTarget;
                        // Stop the timer when the the pointer hits target
                        targetFn = targetOutside;
                    }
                };
            
            function updateCss(newPointer) {
                var css = layerCss(parallax, px, offset, size, position, newPointer);
                elem.css(css);
                pointer = newPointer;
            }
            
            function frame() {
                pointerFn(port.pointer, pointer, port.threshold, decay, parallax, targetFn, updateCss);
            }
            
            function targetInside() {
                // Pointer hits the target pointer inside the port
                pointerFn = pointerOnTarget;
            }
            
            function targetOutside() {
                // Pointer hits the target pointer outside the port
                timer.remove(frame);
            }
            
            
            if (jQuery.data(node, 'parallax')) {
                elem.unparallax();
            }
            
            jQuery.data(node, 'parallax', {
                port: port,
                events: events,
                parallax: parallax
            });
            
            port.elem.on(events);
            port.layers = port.layers? port.layers.add(node): jQuery(node);
            
            /*function freeze() {
                freeze = true;
            }
            
            function unfreeze() {
                freeze = false;
            }*/
            
            /*jQuery.event.add(this, 'freeze.parallax', freeze);
            jQuery.event.add(this, 'unfreeze.parallax', unfreeze);*/
        });
    };
    
    jQuery.fn.unparallax = function(bool) {
        return this.each(function() {
            var data = jQuery.data(this, 'parallax');
            
            // This elem is not parallaxed
            if (!data) { return; }
            
            jQuery.removeData(this, 'parallax');
            unparallax(this, data.port, data.events);
            if (bool) { unstyle(data.parallax); }
        });
    };
    
    jQuery.fn.parallax.options = options;
    
    // Pick up and store mouse position on document: IE does not register
    // mousemove on window.
    doc.on('mousemove.parallax', function(e){
        mouse = [e.pageX, e.pageY];
    });
}(jQuery));;
/*
 
 jQuery Tools Validator 1.2.5 - HTML5 is here. Now use it.

 NO COPYRIGHTS OR LICENSES. DO WHAT YOU LIKE.

 http://flowplayer.org/tools/form/validator/

 Since: Mar 2010
 Date:    Wed Sep 22 06:02:10 2010 +0000 
*/
(function(e) {
    function t(a, b, c) {
        var k = a.offset().top,
            f = a.offset().left,
            l = c.position.split(/,?\s+/),
            p = l[0];
        l = l[1];
        k -= b.outerHeight() - c.offset[0];
        f += a.outerWidth() + c.offset[1];
        if (/iPad/i.test(navigator.userAgent)) k -= e(window).scrollTop();
        c = b.outerHeight() + a.outerHeight();
        if (p == "center") k += c / 2;
        if (p == "bottom") k += c;
        a = a.outerWidth();
        if (l == "center") f -= (a + b.outerWidth()) / 2;
        if (l == "left") f -= a;
        return {
            top: k,
            left: f
        }
    }

    function y(a) {
        function b() {
            return this.getAttribute("type") == a
        }
        b.key = "[type=" + a + "]";
        return b
    }

    function u(a,
        b, c) {
        function k(g, d, i) {
            if (!(!c.grouped && g.length)) {
                var j;
                if (i === false || e.isArray(i)) {
                    j = h.messages[d.key || d] || h.messages["*"];
                    j = j[c.lang] || h.messages["*"].en;
                    (d = j.match(/\$\d/g)) && e.isArray(i) && e.each(d, function(m) {
                        j = j.replace(this, i[m])
                    })
                } else j = i[c.lang] || i;
                g.push(j)
            }
        }
        var f = this,
            l = b.add(f);
        a = a.not(":button, :image, :reset, :submit");
        e.extend(f, {
            getConf: function() {
                return c
            },
            getForm: function() {
                return b
            },
            getInputs: function() {
                return a
            },
            reflow: function() {
                a.each(function() {
                    var g = e(this),
                        d = g.data("msg.el");
                    if (d) {
                        g = t(g, d, c);
                        d.css({
                            top: g.top,
                            left: g.left
                        })
                    }
                });
                return f
            },
            invalidate: function(g, d) {
                if (!d) {
                    var i = [];
                    e.each(g, function(j, m) {
                        j = a.filter("[name='" + j + "']");
                        if (j.length) {
                            j.trigger("OI", [m]);
                            i.push({
                                input: j,
                                messages: [m]
                            })
                        }
                    });
                    g = i;
                    d = e.Event()
                }
                d.type = "onFail";
                l.trigger(d, [g]);
                d.isDefaultPrevented() || q[c.effect][0].call(f, g, d);
                return f
            },
            reset: function(g) {
                g = g || a;
                g.removeClass(c.errorClass).each(function() {
                    var d = e(this).data("msg.el");
                    if (d) {
                        d.remove();
                        e(this).data("msg.el", null)
                    }
                }).unbind(c.errorInputEvent ||
                    "");
                return f
            },
            destroy: function() {
                b.unbind(c.formEvent + ".V").unbind("reset.V");
                a.unbind(c.inputEvent + ".V").unbind("change.V");
                return f.reset()
            },
            checkValidity: function(g, d) {
                g = g || a;
                g = g.not(":disabled");
                if (!g.length) return true;
                d = d || e.Event();
                d.type = "onBeforeValidate";
                l.trigger(d, [g]);
                if (d.isDefaultPrevented()) return d.result;
                var i = [];
                g.not(":radio:not(:checked)").each(function() {
                    var m = [],
                        n = e(this).data("messages", m),
                        v = r && n.is(":date") ? "onHide.v" : c.errorInputEvent + ".v";
                    n.unbind(v);
                    e.each(w, function() {
                        var o =
                            this,
                            s = o[0];
                        if (n.filter(s).length) {
                            o = o[1].call(f, n, n.val());
                            if (o !== true) {
                                d.type = "onBeforeFail";
                                l.trigger(d, [n, s]);
                                if (d.isDefaultPrevented()) return false;
                                var x = n.attr(c.messageAttr);
                                if (x) {
                                    m = [x];
                                    return false
                                } else k(m, s, o)
                            }
                        }
                    });
                    if (m.length) {
                        i.push({
                            input: n,
                            messages: m
                        });
                        n.trigger("OI", [m]);
                        c.errorInputEvent && n.bind(v, function(o) {
                            f.checkValidity(n, o)
                        })
                    }
                    if (c.singleError && i.length) return false
                });
                var j = q[c.effect];
                if (!j) throw 'Validator: cannot find effect "' + c.effect + '"';
                if (i.length) {
                    f.invalidate(i, d);
                    return false
                } else {
                    j[1].call(f,
                        g, d);
                    d.type = "onSuccess";
                    l.trigger(d, [g]);
                    g.unbind(c.errorInputEvent + ".v")
                }
                return true
            }
        });
        e.each("onBeforeValidate,onBeforeFail,onFail,onSuccess".split(","), function(g, d) {
            e.isFunction(c[d]) && e(f).bind(d, c[d]);
            f[d] = function(i) {
                i && e(f).bind(d, i);
                return f
            }
        });
        c.formEvent && b.bind(c.formEvent + ".V", function(g) {
            if (!f.checkValidity(null, g)) return g.preventDefault()
        });
        b.bind("reset.V", function() {
            f.reset()
        });
        a[0] && a[0].validity && a.each(function() {
            this.oninvalid = function() {
                return false
            }
        });
        if (b[0]) b[0].checkValidity =
            f.checkValidity;
        c.inputEvent && a.bind(c.inputEvent + ".V", function(g) {
            f.checkValidity(e(this), g)
        });
        a.filter(":checkbox, select").filter("[required]").bind("change.V", function(g) {
            var d = e(this);
            if (this.checked || d.is("select") && e(this).val()) q[c.effect][1].call(f, d, g)
        });
        var p = a.filter(":radio").change(function(g) {
            f.checkValidity(p, g)
        });
        e(window).resize(function() {
            f.reflow()
        })
    }
    e.tools = e.tools || {
        version: "1.2.5"
    };
    var z = /\[type=([a-z]+)\]/,
        A = /^-?[0-9]*(\.[0-9]+)?$/,
        r = e.tools.dateinput,
        B = /^([a-z0-9_\.\-\+]+)@([\da-z\.\-]+)\.([a-z\.]{2,6})$/i,
        C = /^(https?:\/\/)?[\da-z\.\-]+\.[a-z\.]{2,6}[#&+_\?\/\w \.\-=]*$/i,
        h;
    h = e.tools.validator = {
        conf: {
            grouped: false,
            effect: "default",
            errorClass: "invalid",
            inputEvent: null,
            errorInputEvent: "keyup",
            formEvent: "submit",
            lang: "en",
            message: "<div/>",
            messageAttr: "data-message",
            messageClass: "error",
            offset: [0, 0],
            position: "center right",
            singleError: false,
            speed: "normal"
        },
        messages: {
            "*": {
                en: "Please correct this value"
            }
        },
        localize: function(a, b) {
            e.each(b, function(c, k) {
                h.messages[c] = h.messages[c] || {};
                h.messages[c][a] = k
            })
        },
        localizeFn: function(a, b) {
            h.messages[a] = h.messages[a] || {};
            e.extend(h.messages[a], b)
        },
        fn: function(a, b, c) {
            if (e.isFunction(b)) c = b;
            else {
                if (typeof b == "string") b = {
                    en: b
                };
                this.messages[a.key || a] = b
            } if (b = z.exec(a)) a = y(b[1]);
            w.push([a, c])
        },
        addEffect: function(a, b, c) {
            q[a] = [b, c]
        }
    };
    var w = [],
        q = {
            "default": [
                function(a) {
                    var b = this.getConf();
                    e.each(a, function(c, k) {
                        c = k.input;
                        c.addClass(b.errorClass);
                        var f = c.data("msg.el");
                        if (!f) {
                            f = e(b.message).addClass(b.messageClass).appendTo(document.body);
                            c.data("msg.el", f)
                        }
                        f.css({
                            visibility: "hidden"
                        }).find("p").remove();
                        e.each(k.messages, function(l, p) {
                            e("<p/>").html(p).appendTo(f)
                        });
                        f.outerWidth() == f.parent().width() && f.add(f.find("p")).css({
                            display: "inline"
                        });
                        k = t(c, f, b);
                        f.css({
                            visibility: "visible",
                            position: "absolute",
                            top: k.top,
                            left: k.left
                        }).fadeIn(b.speed)
                    })
                },
                function(a) {
                    var b = this.getConf();
                    a.removeClass(b.errorClass).each(function() {
                        var c = e(this).data("msg.el");
                        c && c.css({
                            visibility: "hidden"
                        })
                    })
                }
            ]
        };
    e.each("email,url,number".split(","), function(a, b) {
        e.expr[":"][b] = function(c) {
            return c.getAttribute("type") === b
        }
    });
    e.fn.oninvalid = function(a) {
        return this[a ? "bind" : "trigger"]("OI", a)
    };
    h.fn(":email", "Please enter a valid email address", function(a, b) {
        return !b || B.test(b)
    });
    h.fn(":url", "Please enter a valid URL", function(a, b) {
        return !b || C.test(b)
    });
    h.fn(":number", "Please enter a numeric value.", function(a, b) {
        return A.test(b)
    });
    h.fn("[max]", "Please enter a value smaller than $1", function(a, b) {
        if (b === "" || r && a.is(":date")) return true;
        a = a.attr("max");
        return parseFloat(b) <= parseFloat(a) ? true : [a]
    });
    h.fn("[min]", "Please enter a value larger than $1",
        function(a, b) {
            if (b === "" || r && a.is(":date")) return true;
            a = a.attr("min");
            return parseFloat(b) >= parseFloat(a) ? true : [a]
        });
    h.fn("[required]", "Please complete this mandatory field.", function(a, b) {
        if (a.is(":checkbox")) return a.is(":checked");
        return !!b
    });
    h.fn("[pattern]", function(a) {
        var b = new RegExp("^" + a.attr("pattern") + "$");
        return b.test(a.val())
    });
    e.fn.validator = function(a) {
        var b = this.data("validator");
        if (b) {
            b.destroy();
            this.removeData("validator")
        }
        a = e.extend(true, {}, h.conf, a);
        if (this.is("form")) return this.each(function() {
            var c =
                e(this);
            b = new u(c.find(":input"), c, a);
            c.data("validator", b)
        });
        else {
            b = new u(this, this.eq(0).closest("form"), a);
            return this.data("validator", b)
        }
    }
})(jQuery);
;/**
 * author Christopher Blum
 *    - based on the idea of Remy Sharp, http://remysharp.com/2009/01/26/element-in-view-event-plugin/
 *    - forked from http://github.com/zuk/jquery.inview/
 */
(function ($) {
  var inviewObjects = {}, viewportSize, viewportOffset,
      d = document, w = window, documentElement = d.documentElement, expando = $.expando, timer;

  $.event.special.inview = {
    add: function(data) {
      inviewObjects[data.guid + "-" + this[expando]] = { data: data, $element: $(this) };

      // Use setInterval in order to also make sure this captures elements within
      // "overflow:scroll" elements or elements that appeared in the dom tree due to
      // dom manipulation and reflow
      // old: $(window).scroll(checkInView);
      //
      // By the way, iOS (iPad, iPhone, ...) seems to not execute, or at least delays
      // intervals while the user scrolls. Therefore the inview event might fire a bit late there
      // 
      // Don't waste cycles with an interval until we get at least one element that
      // has bound to the inview event.  
      if (!timer && !$.isEmptyObject(inviewObjects)) {
         timer = setInterval(checkInView, 250);
      }
    },

    remove: function(data) {
      try { delete inviewObjects[data.guid + "-" + this[expando]]; } catch(e) {}

      // Clear interval when we no longer have any elements listening
      if ($.isEmptyObject(inviewObjects)) {
         clearInterval(timer);
         timer = null;
      }
    }
  };

  function getViewportSize() {
    var mode, domObject, size = { height: w.innerHeight, width: w.innerWidth };

    // if this is correct then return it. iPad has compat Mode, so will
    // go into check clientHeight/clientWidth (which has the wrong value).
    if (!size.height) {
      mode = d.compatMode;
      if (mode || !$.support.boxModel) { // IE, Gecko
        domObject = mode === 'CSS1Compat' ?
          documentElement : // Standards
          d.body; // Quirks
        size = {
          height: domObject.clientHeight,
          width:  domObject.clientWidth
        };
      }
    }

    return size;
  }

  function getViewportOffset() {
    return {
      top:  w.pageYOffset || documentElement.scrollTop   || d.body.scrollTop,
      left: w.pageXOffset || documentElement.scrollLeft  || d.body.scrollLeft
    };
  }

  function checkInView() {
    var $elements = $(), elementsLength, i = 0;

    $.each(inviewObjects, function(i, inviewObject) {
      var selector  = inviewObject.data.selector,
          $element  = inviewObject.$element;
      $elements = $elements.add(selector ? $element.find(selector) : $element);
    });

    elementsLength = $elements.length;
    if (elementsLength) {
      viewportSize   = viewportSize   || getViewportSize();
      viewportOffset = viewportOffset || getViewportOffset();

      for (; i<elementsLength; i++) {
        // Ignore elements that are not in the DOM tree
        if (!$.contains(documentElement, $elements[i])) {
          continue;
        }

        var $element      = $($elements[i]),
            elementSize   = { height: $element.height(), width: $element.width() },
            elementOffset = $element.offset(),
            inView        = $element.data('inview'),
            visiblePartX,
            visiblePartY,
            visiblePartsMerged;
        
        // Don't ask me why because I haven't figured out yet:
        // viewportOffset and viewportSize are sometimes suddenly null in Firefox 5.
        // Even though it sounds weird:
        // It seems that the execution of this function is interferred by the onresize/onscroll event
        // where viewportOffset and viewportSize are unset
        if (!viewportOffset || !viewportSize) {
          return;
        }
        
        if (elementOffset.top + elementSize.height > viewportOffset.top &&
            elementOffset.top < viewportOffset.top + viewportSize.height &&
            elementOffset.left + elementSize.width > viewportOffset.left &&
            elementOffset.left < viewportOffset.left + viewportSize.width) {
          visiblePartX = (viewportOffset.left > elementOffset.left ?
            'right' : (viewportOffset.left + viewportSize.width) < (elementOffset.left + elementSize.width) ?
            'left' : 'both');
          visiblePartY = (viewportOffset.top > elementOffset.top ?
            'bottom' : (viewportOffset.top + viewportSize.height) < (elementOffset.top + elementSize.height) ?
            'top' : 'both');
          visiblePartsMerged = visiblePartX + "-" + visiblePartY;
          if (!inView || inView !== visiblePartsMerged) {
            $element.data('inview', visiblePartsMerged).trigger('inview', [true, visiblePartX, visiblePartY]);
          }
        } else if (inView) {
          $element.data('inview', false).trigger('inview', [false]);
        }
      }
    }
  }

  $(w).bind("scroll resize scrollstop", function() {
    viewportSize = viewportOffset = null;
  });
  
  // IE < 9 scrolls to focused elements without firing the "scroll" event
  if (!documentElement.addEventListener && documentElement.attachEvent) {
    documentElement.attachEvent("onfocusin", function() {
      viewportOffset = null;
    });
  }
})(jQuery);;
function ChopScroll (handler, timeout, name) {
  this.timeout = timeout;
  this.handler = handler;
  this.name = name || 'unnamed';
  this.isExecuteTime = true;
  this.interval = '';
  var _this = this;
  init();

  function init() {
    //reset the execute determiner
    jQuery(window).scroll(function () {
      _this.isExecuteTime = true;
    });

    //execute the handler based on the timeout user passed
    _this.interval = setInterval(function () {
      if (_this.isExecuteTime) {
        try {
          handler();
        } catch (err) {
          console.log(err);
        }
        //turn off the exec time until user scroll again
        _this.isExecuteTime = false;
      }
    }, _this.timeout);
  }

}
;/*!
 * hoverIntent r7 // 2013.03.11 // jQuery 1.9.1+
 * http://cherne.net/brian/resources/jquery.hoverIntent.html
 *
 * You may use hoverIntent under the terms of the MIT license.
 * Copyright 2007, 2013 Brian Cherne
 */
(function(e){e.fn.hoverIntent=function(t,n,r){var i={interval:100,sensitivity:7,timeout:0};if(typeof t==="object"){i=e.extend(i,t)}else if(e.isFunction(n)){i=e.extend(i,{over:t,out:n,selector:r})}else{i=e.extend(i,{over:t,out:t,selector:n})}var s,o,u,a;var f=function(e){s=e.pageX;o=e.pageY};var l=function(t,n){n.hoverIntent_t=clearTimeout(n.hoverIntent_t);if(Math.abs(u-s)+Math.abs(a-o)<i.sensitivity){e(n).off("mousemove.hoverIntent",f);n.hoverIntent_s=1;return i.over.apply(n,[t])}else{u=s;a=o;n.hoverIntent_t=setTimeout(function(){l(t,n)},i.interval)}};var c=function(e,t){t.hoverIntent_t=clearTimeout(t.hoverIntent_t);t.hoverIntent_s=0;return i.out.apply(t,[e])};var h=function(t){var n=jQuery.extend({},t);var r=this;if(r.hoverIntent_t){r.hoverIntent_t=clearTimeout(r.hoverIntent_t)}if(t.type=="mouseenter"){u=n.pageX;a=n.pageY;e(r).on("mousemove.hoverIntent",f);if(r.hoverIntent_s!=1){r.hoverIntent_t=setTimeout(function(){l(n,r)},i.interval)}}else{e(r).off("mousemove.hoverIntent",f);if(r.hoverIntent_s==1){r.hoverIntent_t=setTimeout(function(){c(n,r)},i.timeout)}}};return this.on({"mouseenter.hoverIntent":h,"mouseleave.hoverIntent":h},i.selector)}})(jQuery);

;/*
 * swiper 2.6.1
 * Mobile touch slider and framework with hardware accelerated transitions
 *
 * http://www.idangero.us/sliders/swiper/
 *
 * Copyright 2010-2014, Vladimir Kharlampidi
 * The iDangero.us
 * http://www.idangero.us/
 *
 * Licensed under GPL & MIT
 *
 * Released on: January 29, 2014
*/
var Swiper=function(e,t){"use strict";function r(e,t){if(document.querySelectorAll)return(t||document).querySelectorAll(e);else return jQuery(e,t)}function b(e){if(Object.prototype.toString.apply(e)==="[object Array]")return true;return false}function x(){var e=u-l;if(t.freeMode){e=u-l}if(t.slidesPerView>i.slides.length&&!t.centeredSlides){e=0}if(e<0)e=0;return e}function T(){function o(e){var n=new Image;n.onload=function(){if(i&&i.imagesLoaded!==undefined)i.imagesLoaded++;if(i.imagesLoaded===i.imagesToLoad.length){i.reInit();if(t.onImagesReady)i.fireCallback(t.onImagesReady,i)}};n.src=e}var e=i.h.addEventListener;var n=t.eventTarget==="wrapper"?i.wrapper:i.container;if(!(i.browser.ie10||i.browser.ie11)){if(i.support.touch){e(n,"touchstart",I);e(n,"touchmove",U);e(n,"touchend",z)}if(t.simulateTouch){e(n,"mousedown",I);e(document,"mousemove",U);e(document,"mouseup",z)}}else{e(n,i.touchEvents.touchStart,I);e(document,i.touchEvents.touchMove,U);e(document,i.touchEvents.touchEnd,z)}if(t.autoResize){e(window,"resize",i.resizeFix)}N();i._wheelEvent=false;if(t.mousewheelControl){if(document.onmousewheel!==undefined){i._wheelEvent="mousewheel"}if(!i._wheelEvent){try{new WheelEvent("wheel");i._wheelEvent="wheel"}catch(s){}}if(!i._wheelEvent){i._wheelEvent="DOMMouseScroll"}if(i._wheelEvent){e(i.container,i._wheelEvent,A)}}if(t.keyboardControl){e(document,"keydown",k)}if(t.updateOnImagesReady){i.imagesToLoad=r("img",i.container);for(var u=0;u<i.imagesToLoad.length;u++){o(i.imagesToLoad[u].getAttribute("src"))}}}function N(){var e=i.h.addEventListener,n;if(t.preventLinks){var s=r("a",i.container);for(n=0;n<s.length;n++){e(s[n],"click",P)}}if(t.releaseFormElements){var o=r("input, textarea, select",i.container);for(n=0;n<o.length;n++){e(o[n],i.touchEvents.touchStart,H,true)}}if(t.onSlideClick){for(n=0;n<i.slides.length;n++){e(i.slides[n],"click",M)}}if(t.onSlideTouch){for(n=0;n<i.slides.length;n++){e(i.slides[n],i.touchEvents.touchStart,_)}}}function C(){var e=i.h.removeEventListener,n;if(t.onSlideClick){for(n=0;n<i.slides.length;n++){e(i.slides[n],"click",M)}}if(t.onSlideTouch){for(n=0;n<i.slides.length;n++){e(i.slides[n],i.touchEvents.touchStart,_)}}if(t.releaseFormElements){var s=r("input, textarea, select",i.container);for(n=0;n<s.length;n++){e(s[n],i.touchEvents.touchStart,H,true)}}if(t.preventLinks){var o=r("a",i.container);for(n=0;n<o.length;n++){e(o[n],"click",P)}}}function k(e){var t=e.keyCode||e.charCode;if(e.shiftKey||e.altKey||e.ctrlKey||e.metaKey)return;if(t===37||t===39||t===38||t===40){var n=false;var r=i.h.getOffset(i.container);var s=i.h.windowScroll().left;var o=i.h.windowScroll().top;var u=i.h.windowWidth();var a=i.h.windowHeight();var f=[[r.left,r.top],[r.left+i.width,r.top],[r.left,r.top+i.height],[r.left+i.width,r.top+i.height]];for(var l=0;l<f.length;l++){var c=f[l];if(c[0]>=s&&c[0]<=s+u&&c[1]>=o&&c[1]<=o+a){n=true}}if(!n)return}if(d){if(t===37||t===39){if(e.preventDefault)e.preventDefault();else e.returnValue=false}if(t===39)i.swipeNext();if(t===37)i.swipePrev()}else{if(t===38||t===40){if(e.preventDefault)e.preventDefault();else e.returnValue=false}if(t===40)i.swipeNext();if(t===38)i.swipePrev()}}function A(e){var n=i._wheelEvent;var r=0;if(e.detail)r=-e.detail;else if(n==="mousewheel"){if(t.mousewheelControlForceToAxis){if(d){if(Math.abs(e.wheelDeltaX)>Math.abs(e.wheelDeltaY))r=e.wheelDeltaX;else return}else{if(Math.abs(e.wheelDeltaY)>Math.abs(e.wheelDeltaX))r=e.wheelDeltaY;else return}}else{r=e.wheelDelta}}else if(n==="DOMMouseScroll")r=-e.detail;else if(n==="wheel"){if(t.mousewheelControlForceToAxis){if(d){if(Math.abs(e.deltaX)>Math.abs(e.deltaY))r=-e.deltaX;else return}else{if(Math.abs(e.deltaY)>Math.abs(e.deltaX))r=-e.deltaY;else return}}else{r=Math.abs(e.deltaX)>Math.abs(e.deltaY)?-e.deltaX:-e.deltaY}}if(!t.freeMode){if((new Date).getTime()-L>60){if(r<0)i.swipeNext();else i.swipePrev()}L=(new Date).getTime()}else{var s=i.getWrapperTranslate()+r;if(s>0)s=0;if(s<-x())s=-x();i.setWrapperTransition(0);i.setWrapperTranslate(s);i.updateActiveSlide(s);if(s===0||s===-x())return}if(t.autoplay)i.stopAutoplay(true);if(e.preventDefault)e.preventDefault();else e.returnValue=false;return false}function M(e){if(i.allowSlideClick){D(e);i.fireCallback(t.onSlideClick,i,e)}}function _(e){D(e);i.fireCallback(t.onSlideTouch,i,e)}function D(e){if(!e.currentTarget){var n=e.srcElement;do{if(n.className.indexOf(t.slideClass)>-1){break}n=n.parentNode}while(n);i.clickedSlide=n}else{i.clickedSlide=e.currentTarget}i.clickedSlideIndex=i.slides.indexOf(i.clickedSlide);i.clickedSlideLoopIndex=i.clickedSlideIndex-(i.loopedSlides||0)}function P(e){if(!i.allowLinks){if(e.preventDefault)e.preventDefault();else e.returnValue=false;if(t.preventLinksPropagation&&"stopPropagation"in e){e.stopPropagation()}return false}}function H(e){if(e.stopPropagation)e.stopPropagation();else e.returnValue=false;return false}function I(e){if(t.preventLinks)i.allowLinks=true;if(i.isTouched||t.onlyExternal){return false}if(t.noSwiping&&(e.target||e.srcElement)&&W(e.target||e.srcElement))return false;F=false;i.isTouched=true;B=e.type==="touchstart";if(!B||e.targetTouches.length===1){i.callPlugins("onTouchStartBegin");if(!B&&!i.isAndroid){if(e.preventDefault)e.preventDefault();else e.returnValue=false}var n=B?e.targetTouches[0].pageX:e.pageX||e.clientX;var r=B?e.targetTouches[0].pageY:e.pageY||e.clientY;i.touches.startX=i.touches.currentX=n;i.touches.startY=i.touches.currentY=r;i.touches.start=i.touches.current=d?n:r;i.setWrapperTransition(0);i.positions.start=i.positions.current=i.getWrapperTranslate();i.setWrapperTranslate(i.positions.start);i.times.start=(new Date).getTime();f=undefined;if(t.moveStartThreshold>0){j=false}if(t.onTouchStart)i.fireCallback(t.onTouchStart,i,e);i.callPlugins("onTouchStartEnd")}}function U(e){if(!i.isTouched||t.onlyExternal)return;if(B&&e.type==="mousemove")return;var n=B?e.targetTouches[0].pageX:e.pageX||e.clientX;var r=B?e.targetTouches[0].pageY:e.pageY||e.clientY;if(typeof f==="undefined"&&d){f=!!(f||Math.abs(r-i.touches.startY)>Math.abs(n-i.touches.startX))}if(typeof f==="undefined"&&!d){f=!!(f||Math.abs(r-i.touches.startY)<Math.abs(n-i.touches.startX))}if(f){i.isTouched=false;return}if(e.assignedToSwiper){i.isTouched=false;return}e.assignedToSwiper=true;if(t.preventLinks){i.allowLinks=false}if(t.onSlideClick){i.allowSlideClick=false}if(t.autoplay){i.stopAutoplay(true)}if(!B||e.touches.length===1){if(!i.isMoved){i.callPlugins("onTouchMoveStart");if(t.loop){i.fixLoop();i.positions.start=i.getWrapperTranslate()}if(t.onTouchMoveStart)i.fireCallback(t.onTouchMoveStart,i)}i.isMoved=true;if(e.preventDefault)e.preventDefault();else e.returnValue=false;i.touches.current=d?n:r;i.positions.current=(i.touches.current-i.touches.start)*t.touchRatio+i.positions.start;if(i.positions.current>0&&t.onResistanceBefore){i.fireCallback(t.onResistanceBefore,i,i.positions.current)}if(i.positions.current<-x()&&t.onResistanceAfter){i.fireCallback(t.onResistanceAfter,i,Math.abs(i.positions.current+x()))}if(t.resistance&&t.resistance!=="100%"){var s;if(i.positions.current>0){s=1-i.positions.current/l/2;if(s<.5)i.positions.current=l/2;else i.positions.current=i.positions.current*s}if(i.positions.current<-x()){var o=(i.touches.current-i.touches.start)*t.touchRatio+(x()+i.positions.start);s=(l+o)/l;var u=i.positions.current-o*(1-s)/2;var a=-x()-l/2;if(u<a||s<=0)i.positions.current=a;else i.positions.current=u}}if(t.resistance&&t.resistance==="100%"){if(i.positions.current>0&&!(t.freeMode&&!t.freeModeFluid)){i.positions.current=0}if(i.positions.current<-x()&&!(t.freeMode&&!t.freeModeFluid)){i.positions.current=-x()}}if(!t.followFinger)return;if(!t.moveStartThreshold){i.setWrapperTranslate(i.positions.current)}else{if(Math.abs(i.touches.current-i.touches.start)>t.moveStartThreshold||j){if(!j){j=true;i.touches.start=i.touches.current;return}i.setWrapperTranslate(i.positions.current)}else{i.positions.current=i.positions.start}}if(t.freeMode||t.watchActiveIndex){i.updateActiveSlide(i.positions.current)}if(t.grabCursor){i.container.style.cursor="move";i.container.style.cursor="grabbing";i.container.style.cursor="-moz-grabbin";i.container.style.cursor="-webkit-grabbing"}if(!q)q=i.touches.current;if(!R)R=(new Date).getTime();i.velocity=(i.touches.current-q)/((new Date).getTime()-R)/2;if(Math.abs(i.touches.current-q)<2)i.velocity=0;q=i.touches.current;R=(new Date).getTime();i.callPlugins("onTouchMoveEnd");if(t.onTouchMove)i.fireCallback(t.onTouchMove,i,e);return false}}function z(e){if(f){i.swipeReset()}if(t.onlyExternal||!i.isTouched)return;i.isTouched=false;if(t.grabCursor){i.container.style.cursor="move";i.container.style.cursor="grab";i.container.style.cursor="-moz-grab";i.container.style.cursor="-webkit-grab"}if(!i.positions.current&&i.positions.current!==0){i.positions.current=i.positions.start}if(t.followFinger){i.setWrapperTranslate(i.positions.current)}i.times.end=(new Date).getTime();i.touches.diff=i.touches.current-i.touches.start;i.touches.abs=Math.abs(i.touches.diff);i.positions.diff=i.positions.current-i.positions.start;i.positions.abs=Math.abs(i.positions.diff);var n=i.positions.diff;var r=i.positions.abs;var s=i.times.end-i.times.start;if(r<5&&s<300&&i.allowLinks===false){if(!t.freeMode&&r!==0)i.swipeReset();if(t.preventLinks){i.allowLinks=true}if(t.onSlideClick){i.allowSlideClick=true}}setTimeout(function(){if(t.preventLinks){i.allowLinks=true}if(t.onSlideClick){i.allowSlideClick=true}},100);var u=x();if(!i.isMoved&&t.freeMode){i.isMoved=false;if(t.onTouchEnd)i.fireCallback(t.onTouchEnd,i,e);i.callPlugins("onTouchEnd");return}if(!i.isMoved||i.positions.current>0||i.positions.current<-u){i.swipeReset();if(t.onTouchEnd)i.fireCallback(t.onTouchEnd,i,e);i.callPlugins("onTouchEnd");return}i.isMoved=false;if(t.freeMode){if(t.freeModeFluid){var c=1e3*t.momentumRatio;var h=i.velocity*c;var p=i.positions.current+h;var v=false;var m;var g=Math.abs(i.velocity)*20*t.momentumBounceRatio;if(p<-u){if(t.momentumBounce&&i.support.transitions){if(p+u<-g)p=-u-g;m=-u;v=true;F=true}else p=-u}if(p>0){if(t.momentumBounce&&i.support.transitions){if(p>g)p=g;m=0;v=true;F=true}else p=0}if(i.velocity!==0)c=Math.abs((p-i.positions.current)/i.velocity);i.setWrapperTranslate(p);i.setWrapperTransition(c);if(t.momentumBounce&&v){i.wrapperTransitionEnd(function(){if(!F)return;if(t.onMomentumBounce)i.fireCallback(t.onMomentumBounce,i);i.callPlugins("onMomentumBounce");i.setWrapperTranslate(m);i.setWrapperTransition(300)})}i.updateActiveSlide(p)}if(!t.freeModeFluid||s>=300)i.updateActiveSlide(i.positions.current);if(t.onTouchEnd)i.fireCallback(t.onTouchEnd,i,e);i.callPlugins("onTouchEnd");return}a=n<0?"toNext":"toPrev";if(a==="toNext"&&s<=300){if(r<30||!t.shortSwipes)i.swipeReset();else i.swipeNext(true)}if(a==="toPrev"&&s<=300){if(r<30||!t.shortSwipes)i.swipeReset();else i.swipePrev(true)}var y=0;if(t.slidesPerView==="auto"){var b=Math.abs(i.getWrapperTranslate());var w=0;var E;for(var S=0;S<i.slides.length;S++){E=d?i.slides[S].getWidth(true,t.roundLengths):i.slides[S].getHeight(true,t.roundLengths);w+=E;if(w>b){y=E;break}}if(y>l)y=l}else{y=o*t.slidesPerView}if(a==="toNext"&&s>300){if(r>=y*t.longSwipesRatio){i.swipeNext(true)}else{i.swipeReset()}}if(a==="toPrev"&&s>300){if(r>=y*t.longSwipesRatio){i.swipePrev(true)}else{i.swipeReset()}}if(t.onTouchEnd)i.fireCallback(t.onTouchEnd,i,e);i.callPlugins("onTouchEnd")}function W(e){var n=false;do{if(e.className.indexOf(t.noSwipingClass)>-1){n=true}e=e.parentElement}while(!n&&e.parentElement&&e.className.indexOf(t.wrapperClass)===-1);if(!n&&e.className.indexOf(t.wrapperClass)>-1&&e.className.indexOf(t.noSwipingClass)>-1)n=true;return n}function X(e,t){var n=document.createElement("div");var r;n.innerHTML=t;r=n.firstChild;r.className+=" "+e;return r.outerHTML}function V(e,n,r){function u(){var s=+(new Date);var h=s-o;a+=f*h/(1e3/60);c=l==="toNext"?a>e:a<e;if(c){i.setWrapperTranslate(Math.ceil(a));i._DOMAnimating=true;window.setTimeout(function(){u()},1e3/60)}else{if(t.onSlideChangeEnd){if(n==="to"){if(r.runCallbacks===true)i.fireCallback(t.onSlideChangeEnd,i)}else{i.fireCallback(t.onSlideChangeEnd,i)}}i.setWrapperTranslate(e);i._DOMAnimating=false}}var s=n==="to"&&r.speed>=0?r.speed:t.speed;var o=+(new Date);if(i.support.transitions||!t.DOMAnimation){i.setWrapperTranslate(e);i.setWrapperTransition(s)}else{var a=i.getWrapperTranslate();var f=Math.ceil((e-a)/s*(1e3/60));var l=a>e?"toNext":"toPrev";var c=l==="toNext"?a>e:a<e;if(i._DOMAnimating)return;u()}i.updateActiveSlide(e);if(t.onSlideNext&&n==="next"){i.fireCallback(t.onSlideNext,i,e)}if(t.onSlidePrev&&n==="prev"){i.fireCallback(t.onSlidePrev,i,e)}if(t.onSlideReset&&n==="reset"){i.fireCallback(t.onSlideReset,i,e)}if(n==="next"||n==="prev"||n==="to"&&r.runCallbacks===true)$(n)}function $(e){i.callPlugins("onSlideChangeStart");if(t.onSlideChangeStart){if(t.queueStartCallbacks&&i.support.transitions){if(i._queueStartCallbacks)return;i._queueStartCallbacks=true;i.fireCallback(t.onSlideChangeStart,i,e);i.wrapperTransitionEnd(function(){i._queueStartCallbacks=false})}else i.fireCallback(t.onSlideChangeStart,i,e)}if(t.onSlideChangeEnd){if(i.support.transitions){if(t.queueEndCallbacks){if(i._queueEndCallbacks)return;i._queueEndCallbacks=true;i.wrapperTransitionEnd(function(n){i.fireCallback(t.onSlideChangeEnd,n,e)})}else{i.wrapperTransitionEnd(function(n){i.fireCallback(t.onSlideChangeEnd,n,e)})}}else{if(!t.DOMAnimation){setTimeout(function(){i.fireCallback(t.onSlideChangeEnd,i,e)},10)}}}}function J(){var e=i.paginationButtons;if(e){for(var t=0;t<e.length;t++){i.h.removeEventListener(e[t],"click",Q)}}}function K(){var e=i.paginationButtons;if(e){for(var t=0;t<e.length;t++){i.h.addEventListener(e[t],"click",Q)}}}function Q(e){var t;var n=e.target||e.srcElement;var r=i.paginationButtons;for(var s=0;s<r.length;s++){if(n===r[s])t=s}i.swipeTo(t)}function Z(){G=setTimeout(function(){if(t.loop){i.fixLoop();i.swipeNext(true)}else if(!i.swipeNext(true)){if(!t.autoplayStopOnLast)i.swipeTo(0);else{clearTimeout(G);G=undefined}}i.wrapperTransitionEnd(function(){if(typeof G!=="undefined")Z()})},t.autoplay)}function et(){i.calcSlides();if(t.loader.slides.length>0&&i.slides.length===0){i.loadSlides()}if(t.loop){i.createLoop()}i.init();T();if(t.pagination){i.createPagination(true)}if(t.loop||t.initialSlide>0){i.swipeTo(t.initialSlide,0,false)}else{i.updateActiveSlide(0)}if(t.autoplay){i.startAutoplay()}i.centerIndex=i.activeIndex;if(t.onSwiperCreated)i.fireCallback(t.onSwiperCreated,i);i.callPlugins("onSwiperCreated")}if(document.body.__defineGetter__){if(HTMLElement){var n=HTMLElement.prototype;if(n.__defineGetter__){n.__defineGetter__("outerHTML",function(){return(new XMLSerializer).serializeToString(this)})}}}if(!window.getComputedStyle){window.getComputedStyle=function(e,t){this.el=e;this.getPropertyValue=function(t){var n=/(\-([a-z]){1})/g;if(t==="float")t="styleFloat";if(n.test(t)){t=t.replace(n,function(){return arguments[2].toUpperCase()})}return e.currentStyle[t]?e.currentStyle[t]:null};return this}}if(!Array.prototype.indexOf){Array.prototype.indexOf=function(e,t){for(var n=t||0,r=this.length;n<r;n++){if(this[n]===e){return n}}return-1}}if(!document.querySelectorAll){if(!window.jQuery)return}if(typeof e==="undefined")return;if(!e.nodeType){if(r(e).length===0)return}var i=this;i.touches={start:0,startX:0,startY:0,current:0,currentX:0,currentY:0,diff:0,abs:0};i.positions={start:0,abs:0,diff:0,current:0};i.times={start:0,end:0};i.id=(new Date).getTime();i.container=e.nodeType?e:r(e)[0];i.isTouched=false;i.isMoved=false;i.activeIndex=0;i.centerIndex=0;i.activeLoaderIndex=0;i.activeLoopIndex=0;i.previousIndex=null;i.velocity=0;i.snapGrid=[];i.slidesGrid=[];i.imagesToLoad=[];i.imagesLoaded=0;i.wrapperLeft=0;i.wrapperRight=0;i.wrapperTop=0;i.wrapperBottom=0;i.isAndroid=navigator.userAgent.toLowerCase().indexOf("android")>=0;var s,o,u,a,f,l;var c={eventTarget:"wrapper",mode:"horizontal",touchRatio:1,speed:300,freeMode:false,freeModeFluid:false,momentumRatio:1,momentumBounce:true,momentumBounceRatio:1,slidesPerView:1,slidesPerGroup:1,slidesPerViewFit:true,simulateTouch:true,followFinger:true,shortSwipes:true,longSwipesRatio:.5,moveStartThreshold:false,onlyExternal:false,createPagination:true,pagination:false,paginationElement:"span",paginationClickable:false,paginationAsRange:true,resistance:true,scrollContainer:false,preventLinks:true,preventLinksPropagation:false,noSwiping:false,noSwipingClass:"swiper-no-swiping",initialSlide:0,keyboardControl:false,mousewheelControl:false,mousewheelControlForceToAxis:false,useCSS3Transforms:true,autoplay:false,autoplayDisableOnInteraction:true,autoplayStopOnLast:false,loop:false,loopAdditionalSlides:0,roundLengths:false,calculateHeight:false,cssWidthAndHeight:false,updateOnImagesReady:true,releaseFormElements:true,watchActiveIndex:false,visibilityFullFit:false,offsetPxBefore:0,offsetPxAfter:0,offsetSlidesBefore:0,offsetSlidesAfter:0,centeredSlides:false,queueStartCallbacks:false,queueEndCallbacks:false,autoResize:true,resizeReInit:false,DOMAnimation:true,loader:{slides:[],slidesHTMLType:"inner",surroundGroups:1,logic:"reload",loadAllSlides:false},slideElement:"div",slideClass:"swiper-slide",slideActiveClass:"swiper-slide-active",slideVisibleClass:"swiper-slide-visible",slideDuplicateClass:"swiper-slide-duplicate",wrapperClass:"mk-swiper-wrapper",paginationElementClass:"swiper-pagination-switch",paginationActiveClass:"swiper-active-switch",paginationVisibleClass:"swiper-visible-switch"};t=t||{};for(var h in c){if(h in t&&typeof t[h]==="object"){for(var p in c[h]){if(!(p in t[h])){t[h][p]=c[h][p]}}}else if(!(h in t)){t[h]=c[h]}}i.params=t;if(t.scrollContainer){t.freeMode=true;t.freeModeFluid=true}if(t.loop){t.resistance="100%"}var d=t.mode==="horizontal";var v=["mousedown","mousemove","mouseup"];if(i.browser.ie10)v=["MSPointerDown","MSPointerMove","MSPointerUp"];if(i.browser.ie11)v=["pointerdown","pointermove","pointerup"];i.touchEvents={touchStart:i.support.touch||!t.simulateTouch?"touchstart":v[0],touchMove:i.support.touch||!t.simulateTouch?"touchmove":v[1],touchEnd:i.support.touch||!t.simulateTouch?"touchend":v[2]};for(var m=i.container.childNodes.length-1;m>=0;m--){if(i.container.childNodes[m].className){var g=i.container.childNodes[m].className.split(/\s+/);for(var y=0;y<g.length;y++){if(g[y]===t.wrapperClass){s=i.container.childNodes[m]}}}}i.wrapper=s;i._extendSwiperSlide=function(e){e.append=function(){if(t.loop){e.insertAfter(i.slides.length-i.loopedSlides)}else{i.wrapper.appendChild(e);i.reInit()}return e};e.prepend=function(){if(t.loop){i.wrapper.insertBefore(e,i.slides[i.loopedSlides]);i.removeLoopedSlides();i.calcSlides();i.createLoop()}else{i.wrapper.insertBefore(e,i.wrapper.firstChild)}i.reInit();return e};e.insertAfter=function(n){if(typeof n==="undefined")return false;var r;if(t.loop){r=i.slides[n+1+i.loopedSlides];if(r){i.wrapper.insertBefore(e,r)}else{i.wrapper.appendChild(e)}i.removeLoopedSlides();i.calcSlides();i.createLoop()}else{r=i.slides[n+1];i.wrapper.insertBefore(e,r)}i.reInit();return e};e.clone=function(){return i._extendSwiperSlide(e.cloneNode(true))};e.remove=function(){i.wrapper.removeChild(e);i.reInit()};e.html=function(t){if(typeof t==="undefined"){return e.innerHTML}else{e.innerHTML=t;return e}};e.index=function(){var t;for(var n=i.slides.length-1;n>=0;n--){if(e===i.slides[n])t=n}return t};e.isActive=function(){if(e.index()===i.activeIndex)return true;else return false};if(!e.swiperSlideDataStorage)e.swiperSlideDataStorage={};e.getData=function(t){return e.swiperSlideDataStorage[t]};e.setData=function(t,n){e.swiperSlideDataStorage[t]=n;return e};e.data=function(t,n){if(typeof n==="undefined"){return e.getAttribute("data-"+t)}else{e.setAttribute("data-"+t,n);return e}};e.getWidth=function(t,n){return i.h.getWidth(e,t,n)};e.getHeight=function(t,n){return i.h.getHeight(e,t,n)};e.getOffset=function(){return i.h.getOffset(e)};return e};i.calcSlides=function(e){var n=i.slides?i.slides.length:false;i.slides=[];i.displaySlides=[];for(var r=0;r<i.wrapper.childNodes.length;r++){if(i.wrapper.childNodes[r].className){var s=i.wrapper.childNodes[r].className;var o=s.split(/\s+/);for(var u=0;u<o.length;u++){if(o[u]===t.slideClass){i.slides.push(i.wrapper.childNodes[r])}}}}for(r=i.slides.length-1;r>=0;r--){i._extendSwiperSlide(i.slides[r])}if(n===false)return;if(n!==i.slides.length||e){C();N();i.updateActiveSlide();if(i.params.pagination)i.createPagination();i.callPlugins("numberOfSlidesChanged")}};i.createSlide=function(e,n,r){n=n||i.params.slideClass;r=r||t.slideElement;var s=document.createElement(r);s.innerHTML=e||"";s.className=n;return i._extendSwiperSlide(s)};i.appendSlide=function(e,t,n){if(!e)return;if(e.nodeType){return i._extendSwiperSlide(e).append()}else{return i.createSlide(e,t,n).append()}};i.prependSlide=function(e,t,n){if(!e)return;if(e.nodeType){return i._extendSwiperSlide(e).prepend()}else{return i.createSlide(e,t,n).prepend()}};i.insertSlideAfter=function(e,t,n,r){if(typeof e==="undefined")return false;if(t.nodeType){return i._extendSwiperSlide(t).insertAfter(e)}else{return i.createSlide(t,n,r).insertAfter(e)}};i.removeSlide=function(e){if(i.slides[e]){if(t.loop){if(!i.slides[e+i.loopedSlides])return false;i.slides[e+i.loopedSlides].remove();i.removeLoopedSlides();i.calcSlides();i.createLoop()}else i.slides[e].remove();return true}else return false};i.removeLastSlide=function(){if(i.slides.length>0){if(t.loop){i.slides[i.slides.length-1-i.loopedSlides].remove();i.removeLoopedSlides();i.calcSlides();i.createLoop()}else i.slides[i.slides.length-1].remove();return true}else{return false}};i.removeAllSlides=function(){for(var e=i.slides.length-1;e>=0;e--){i.slides[e].remove()}};i.getSlide=function(e){return i.slides[e]};i.getLastSlide=function(){return i.slides[i.slides.length-1]};i.getFirstSlide=function(){return i.slides[0]};i.activeSlide=function(){return i.slides[i.activeIndex]};i.fireCallback=function(){var e=arguments[0];if(Object.prototype.toString.call(e)==="[object Array]"){for(var n=0;n<e.length;n++){if(typeof e[n]==="function"){e[n](arguments[1],arguments[2],arguments[3],arguments[4],arguments[5])}}}else if(Object.prototype.toString.call(e)==="[object String]"){if(t["on"+e])i.fireCallback(t["on"+e],arguments[1],arguments[2],arguments[3],arguments[4],arguments[5])}else{e(arguments[1],arguments[2],arguments[3],arguments[4],arguments[5])}};i.addCallback=function(e,t){var n=this,r;if(n.params["on"+e]){if(b(this.params["on"+e])){return this.params["on"+e].push(t)}else if(typeof this.params["on"+e]==="function"){r=this.params["on"+e];this.params["on"+e]=[];this.params["on"+e].push(r);return this.params["on"+e].push(t)}}else{this.params["on"+e]=[];return this.params["on"+e].push(t)}};i.removeCallbacks=function(e){if(i.params["on"+e]){i.params["on"+e]=null}};var w=[];for(var E in i.plugins){if(t[E]){var S=i.plugins[E](i,t[E]);if(S)w.push(S)}}i.callPlugins=function(e,t){if(!t)t={};for(var n=0;n<w.length;n++){if(e in w[n]){w[n][e](t)}}};if((i.browser.ie10||i.browser.ie11)&&!t.onlyExternal){i.wrapper.classList.add("swiper-wp8-"+(d?"horizontal":"vertical"))}if(t.freeMode){i.container.className+=" swiper-free-mode"}i.initialized=false;i.init=function(e,n){var r=i.h.getWidth(i.container,false,t.roundLengths);var s=i.h.getHeight(i.container,false,t.roundLengths);if(r===i.width&&s===i.height&&!e)return;i.width=r;i.height=s;var a,f,c,h,p,v;var m;l=d?r:s;var g=i.wrapper;if(e){i.calcSlides(n)}if(t.slidesPerView==="auto"){var y=0;var b=0;if(t.slidesOffset>0){g.style.paddingLeft="";g.style.paddingRight="";g.style.paddingTop="";g.style.paddingBottom=""}g.style.width="";g.style.height="";if(t.offsetPxBefore>0){if(d)i.wrapperLeft=t.offsetPxBefore;else i.wrapperTop=t.offsetPxBefore}if(t.offsetPxAfter>0){if(d)i.wrapperRight=t.offsetPxAfter;else i.wrapperBottom=t.offsetPxAfter}if(t.centeredSlides){if(d){i.wrapperLeft=(l-this.slides[0].getWidth(true,t.roundLengths))/2;i.wrapperRight=(l-i.slides[i.slides.length-1].getWidth(true,t.roundLengths))/2}else{i.wrapperTop=(l-i.slides[0].getHeight(true,t.roundLengths))/2;i.wrapperBottom=(l-i.slides[i.slides.length-1].getHeight(true,t.roundLengths))/2}}if(d){if(i.wrapperLeft>=0)g.style.paddingLeft=i.wrapperLeft+"px";if(i.wrapperRight>=0)g.style.paddingRight=i.wrapperRight+"px"}else{if(i.wrapperTop>=0)g.style.paddingTop=i.wrapperTop+"px";if(i.wrapperBottom>=0)g.style.paddingBottom=i.wrapperBottom+"px"}v=0;var w=0;i.snapGrid=[];i.slidesGrid=[];c=0;for(m=0;m<i.slides.length;m++){a=i.slides[m].getWidth(true,t.roundLengths);f=i.slides[m].getHeight(true,t.roundLengths);if(t.calculateHeight){c=Math.max(c,f)}var E=d?a:f;if(t.centeredSlides){var S=m===i.slides.length-1?0:i.slides[m+1].getWidth(true,t.roundLengths);var x=m===i.slides.length-1?0:i.slides[m+1].getHeight(true,t.roundLengths);var T=d?S:x;if(E>l){if(t.slidesPerViewFit){i.snapGrid.push(v+i.wrapperLeft);i.snapGrid.push(v+E-l+i.wrapperLeft)}else{for(var N=0;N<=Math.floor(E/(l+i.wrapperLeft));N++){if(N===0)i.snapGrid.push(v+i.wrapperLeft);else i.snapGrid.push(v+i.wrapperLeft+l*N)}}i.slidesGrid.push(v+i.wrapperLeft)}else{i.snapGrid.push(w);i.slidesGrid.push(w)}w+=E/2+T/2}else{if(E>l){if(t.slidesPerViewFit){i.snapGrid.push(v);i.snapGrid.push(v+E-l)}else{if(l!==0){for(var C=0;C<=Math.floor(E/l);C++){i.snapGrid.push(v+l*C)}}else{i.snapGrid.push(v)}}}else{i.snapGrid.push(v)}i.slidesGrid.push(v)}v+=E;y+=a;b+=f}if(t.calculateHeight)i.height=c;if(d){u=y+i.wrapperRight+i.wrapperLeft;g.style.width=y+"px";g.style.height=i.height+"px"}else{u=b+i.wrapperTop+i.wrapperBottom;g.style.width=i.width+"px";g.style.height=b+"px"}}else if(t.scrollContainer){g.style.width="";g.style.height="";h=i.slides[0].getWidth(true,t.roundLengths);p=i.slides[0].getHeight(true,t.roundLengths);u=d?h:p;g.style.width=h+"px";g.style.height=p+"px";o=d?h:p}else{if(t.calculateHeight){c=0;p=0;if(!d)i.container.style.height="";g.style.height="";for(m=0;m<i.slides.length;m++){i.slides[m].style.height="";c=Math.max(i.slides[m].getHeight(true),c);if(!d)p+=i.slides[m].getHeight(true)}f=c;i.height=f;if(d)p=f;else{l=f;i.container.style.height=l+"px"}}else{f=d?i.height:i.height/t.slidesPerView;if(t.roundLengths)f=Math.ceil(f);p=d?i.height:i.slides.length*f}a=d?i.width/t.slidesPerView:i.width;if(t.roundLengths)a=Math.ceil(a);h=d?i.slides.length*a:i.width;o=d?a:f;if(t.offsetSlidesBefore>0){if(d)i.wrapperLeft=o*t.offsetSlidesBefore;else i.wrapperTop=o*t.offsetSlidesBefore}if(t.offsetSlidesAfter>0){if(d)i.wrapperRight=o*t.offsetSlidesAfter;else i.wrapperBottom=o*t.offsetSlidesAfter}if(t.offsetPxBefore>0){if(d)i.wrapperLeft=t.offsetPxBefore;else i.wrapperTop=t.offsetPxBefore}if(t.offsetPxAfter>0){if(d)i.wrapperRight=t.offsetPxAfter;else i.wrapperBottom=t.offsetPxAfter}if(t.centeredSlides){if(d){i.wrapperLeft=(l-o)/2;i.wrapperRight=(l-o)/2}else{i.wrapperTop=(l-o)/2;i.wrapperBottom=(l-o)/2}}if(d){if(i.wrapperLeft>0)g.style.paddingLeft=i.wrapperLeft+"px";if(i.wrapperRight>0)g.style.paddingRight=i.wrapperRight+"px"}else{if(i.wrapperTop>0)g.style.paddingTop=i.wrapperTop+"px";if(i.wrapperBottom>0)g.style.paddingBottom=i.wrapperBottom+"px"}u=d?h+i.wrapperRight+i.wrapperLeft:p+i.wrapperTop+i.wrapperBottom;if(!t.cssWidthAndHeight){if(parseFloat(h)>0){g.style.width=h+"px"}if(parseFloat(p)>0){g.style.height=p+"px"}}v=0;i.snapGrid=[];i.slidesGrid=[];for(m=0;m<i.slides.length;m++){i.snapGrid.push(v);i.slidesGrid.push(v);v+=o;if(!t.cssWidthAndHeight){if(parseFloat(a)>0){i.slides[m].style.width=a+"px"}if(parseFloat(f)>0){i.slides[m].style.height=f+"px"}}}}if(!i.initialized){i.callPlugins("onFirstInit");if(t.onFirstInit)i.fireCallback(t.onFirstInit,i)}else{i.callPlugins("onInit");if(t.onInit)i.fireCallback(t.onInit,i)}i.initialized=true};i.reInit=function(e){i.init(true,e)};i.resizeFix=function(e){i.callPlugins("beforeResizeFix");i.init(t.resizeReInit||e);if(!t.freeMode){i.swipeTo(t.loop?i.activeLoopIndex:i.activeIndex,0,false);if(t.autoplay){if(i.support.transitions&&typeof G!=="undefined"){if(typeof G!=="undefined"){clearTimeout(G);G=undefined;i.startAutoplay()}}else{if(typeof Y!=="undefined"){clearInterval(Y);Y=undefined;i.startAutoplay()}}}}else if(i.getWrapperTranslate()<-x()){i.setWrapperTransition(0);i.setWrapperTranslate(-x())}i.callPlugins("afterResizeFix")};i.destroy=function(){var e=i.h.removeEventListener;var n=t.eventTarget==="wrapper"?i.wrapper:i.container;if(!(i.browser.ie10||i.browser.ie11)){if(i.support.touch){e(n,"touchstart",I);e(n,"touchmove",U);e(n,"touchend",z)}if(t.simulateTouch){e(n,"mousedown",I);e(document,"mousemove",U);e(document,"mouseup",z)}}else{e(n,i.touchEvents.touchStart,I);e(document,i.touchEvents.touchMove,U);e(document,i.touchEvents.touchEnd,z)}if(t.autoResize){e(window,"resize",i.resizeFix)}C();if(t.paginationClickable){J()}if(t.mousewheelControl&&i._wheelEvent){e(i.container,i._wheelEvent,A)}if(t.keyboardControl){e(document,"keydown",k)}if(t.autoplay){i.stopAutoplay()}i.callPlugins("onDestroy");i=null};i.disableKeyboardControl=function(){t.keyboardControl=false;i.h.removeEventListener(document,"keydown",k)};i.enableKeyboardControl=function(){t.keyboardControl=true;i.h.addEventListener(document,"keydown",k)};var L=(new Date).getTime();i.disableMousewheelControl=function(){if(!i._wheelEvent)return false;t.mousewheelControl=false;i.h.removeEventListener(i.container,i._wheelEvent,A);return true};i.enableMousewheelControl=function(){if(!i._wheelEvent)return false;t.mousewheelControl=true;i.h.addEventListener(i.container,i._wheelEvent,A);return true};if(t.grabCursor){var O=i.container.style;O.cursor="move";O.cursor="grab";O.cursor="-moz-grab";O.cursor="-webkit-grab"}i.allowSlideClick=true;i.allowLinks=true;var B=false;var j;var F=true;var q,R;i.swipeNext=function(e){if(!e&&t.loop)i.fixLoop();if(!e&&t.autoplay)i.stopAutoplay(true);i.callPlugins("onSwipeNext");var n=i.getWrapperTranslate();var r=n;if(t.slidesPerView==="auto"){for(var s=0;s<i.snapGrid.length;s++){if(-n>=i.snapGrid[s]&&-n<i.snapGrid[s+1]){r=-i.snapGrid[s+1];break}}}else{var u=o*t.slidesPerGroup;r=-(Math.floor(Math.abs(n)/Math.floor(u))*u+u)}if(r<-x()){r=-x()}if(r===n)return false;V(r,"next");return true};i.swipePrev=function(e){if(!e&&t.loop)i.fixLoop();if(!e&&t.autoplay)i.stopAutoplay(true);i.callPlugins("onSwipePrev");var n=Math.ceil(i.getWrapperTranslate());var r;if(t.slidesPerView==="auto"){r=0;for(var s=1;s<i.snapGrid.length;s++){if(-n===i.snapGrid[s]){r=-i.snapGrid[s-1];break}if(-n>i.snapGrid[s]&&-n<i.snapGrid[s+1]){r=-i.snapGrid[s];break}}}else{var u=o*t.slidesPerGroup;r=-(Math.ceil(-n/u)-1)*u}if(r>0)r=0;if(r===n)return false;V(r,"prev");return true};i.swipeReset=function(){i.callPlugins("onSwipeReset");var e=i.getWrapperTranslate();var n=o*t.slidesPerGroup;var r;var s=-x();if(t.slidesPerView==="auto"){r=0;for(var u=0;u<i.snapGrid.length;u++){if(-e===i.snapGrid[u])return;if(-e>=i.snapGrid[u]&&-e<i.snapGrid[u+1]){if(i.positions.diff>0)r=-i.snapGrid[u+1];else r=-i.snapGrid[u];break}}if(-e>=i.snapGrid[i.snapGrid.length-1])r=-i.snapGrid[i.snapGrid.length-1];if(e<=-x())r=-x()}else{r=e<0?Math.ceil(e/n)*n:0}if(t.scrollContainer){r=e<0?e:0}if(r<-x()){r=-x()}if(t.scrollContainer&&l>o){r=0}if(r===e)return false;V(r,"reset");return true};i.swipeTo=function(e,n,r){e=parseInt(e,10);i.callPlugins("onSwipeTo",{index:e,speed:n});if(t.loop)e=e+i.loopedSlides;var s=i.getWrapperTranslate();if(e>i.slides.length-1||e<0)return;var u;if(t.slidesPerView==="auto"){u=-i.slidesGrid[e]}else{u=-e*o}if(u<-x()){u=-x()}if(u===s)return false;r=r===false?false:true;V(u,"to",{index:e,speed:n,runCallbacks:r});return true};i._queueStartCallbacks=false;i._queueEndCallbacks=false;i.updateActiveSlide=function(e){if(!i.initialized)return;if(i.slides.length===0)return;i.previousIndex=i.activeIndex;if(typeof e==="undefined")e=i.getWrapperTranslate();if(e>0)e=0;var n;if(t.slidesPerView==="auto"){var r=0;i.activeIndex=i.slidesGrid.indexOf(-e);if(i.activeIndex<0){for(n=0;n<i.slidesGrid.length-1;n++){if(-e>i.slidesGrid[n]&&-e<i.slidesGrid[n+1]){break}}var s=Math.abs(i.slidesGrid[n]+e);var u=Math.abs(i.slidesGrid[n+1]+e);if(s<=u)i.activeIndex=n;else i.activeIndex=n+1}}else{i.activeIndex=Math[t.visibilityFullFit?"ceil":"round"](-e/o)}if(i.activeIndex===i.slides.length)i.activeIndex=i.slides.length-1;if(i.activeIndex<0)i.activeIndex=0;if(!i.slides[i.activeIndex])return;i.calcVisibleSlides(e);if(i.support.classList){var a;for(n=0;n<i.slides.length;n++){a=i.slides[n];a.classList.remove(t.slideActiveClass);if(i.visibleSlides.indexOf(a)>=0){a.classList.add(t.slideVisibleClass)}else{a.classList.remove(t.slideVisibleClass)}}i.slides[i.activeIndex].classList.add(t.slideActiveClass)}else{var f=new RegExp("\\s*"+t.slideActiveClass);var l=new RegExp("\\s*"+t.slideVisibleClass);for(n=0;n<i.slides.length;n++){i.slides[n].className=i.slides[n].className.replace(f,"").replace(l,"");if(i.visibleSlides.indexOf(i.slides[n])>=0){i.slides[n].className+=" "+t.slideVisibleClass}}i.slides[i.activeIndex].className+=" "+t.slideActiveClass}if(t.loop){var c=i.loopedSlides;i.activeLoopIndex=i.activeIndex-c;if(i.activeLoopIndex>=i.slides.length-c*2){i.activeLoopIndex=i.slides.length-c*2-i.activeLoopIndex}if(i.activeLoopIndex<0){i.activeLoopIndex=i.slides.length-c*2+i.activeLoopIndex}if(i.activeLoopIndex<0)i.activeLoopIndex=0}else{i.activeLoopIndex=i.activeIndex}if(t.pagination){i.updatePagination(e)}};i.createPagination=function(e){if(t.paginationClickable&&i.paginationButtons){J()}i.paginationContainer=t.pagination.nodeType?t.pagination:r(t.pagination)[0];if(t.createPagination){var n="";var s=i.slides.length;var o=s;if(t.loop)o-=i.loopedSlides*2;for(var u=0;u<o;u++){n+="<"+t.paginationElement+' class="'+t.paginationElementClass+'"></'+t.paginationElement+">"}i.paginationContainer.innerHTML=n}i.paginationButtons=r("."+t.paginationElementClass,i.paginationContainer);if(!e)i.updatePagination();i.callPlugins("onCreatePagination");if(t.paginationClickable){K()}};i.updatePagination=function(e){if(!t.pagination)return;if(i.slides.length<1)return;var n=r("."+t.paginationActiveClass,i.paginationContainer);if(!n)return;var s=i.paginationButtons;if(s.length===0)return;for(var o=0;o<s.length;o++){s[o].className=t.paginationElementClass}var u=t.loop?i.loopedSlides:0;if(t.paginationAsRange){if(!i.visibleSlides)i.calcVisibleSlides(e);var a=[];var f;for(f=0;f<i.visibleSlides.length;f++){var l=i.slides.indexOf(i.visibleSlides[f])-u;if(t.loop&&l<0){l=i.slides.length-i.loopedSlides*2+l}if(t.loop&&l>=i.slides.length-i.loopedSlides*2){l=i.slides.length-i.loopedSlides*2-l;l=Math.abs(l)}a.push(l)}for(f=0;f<a.length;f++){if(s[a[f]])s[a[f]].className+=" "+t.paginationVisibleClass}if(t.loop){if(s[i.activeLoopIndex]!==undefined){s[i.activeLoopIndex].className+=" "+t.paginationActiveClass}}else{s[i.activeIndex].className+=" "+t.paginationActiveClass}}else{if(t.loop){if(s[i.activeLoopIndex])s[i.activeLoopIndex].className+=" "+t.paginationActiveClass+" "+t.paginationVisibleClass}else{s[i.activeIndex].className+=" "+t.paginationActiveClass+" "+t.paginationVisibleClass}}};i.calcVisibleSlides=function(e){var n=[];var r=0,s=0,u=0;if(d&&i.wrapperLeft>0)e=e+i.wrapperLeft;if(!d&&i.wrapperTop>0)e=e+i.wrapperTop;for(var a=0;a<i.slides.length;a++){r+=s;if(t.slidesPerView==="auto")s=d?i.h.getWidth(i.slides[a],true,t.roundLengths):i.h.getHeight(i.slides[a],true,t.roundLengths);else s=o;u=r+s;var f=false;if(t.visibilityFullFit){if(r>=-e&&u<=-e+l)f=true;if(r<=-e&&u>=-e+l)f=true}else{if(u>-e&&u<=-e+l)f=true;if(r>=-e&&r<-e+l)f=true;if(r<-e&&u>-e+l)f=true}if(f)n.push(i.slides[a])}if(n.length===0)n=[i.slides[i.activeIndex]];i.visibleSlides=n};var G,Y;i.startAutoplay=function(){if(i.support.transitions){if(typeof G!=="undefined")return false;if(!t.autoplay)return;i.callPlugins("onAutoplayStart");if(t.onAutoplayStart)i.fireCallback(t.onAutoplayStart,i);Z()}else{if(typeof Y!=="undefined")return false;if(!t.autoplay)return;i.callPlugins("onAutoplayStart");if(t.onAutoplayStart)i.fireCallback(t.onAutoplayStart,i);Y=setInterval(function(){if(t.loop){i.fixLoop();i.swipeNext(true)}else if(!i.swipeNext(true)){if(!t.autoplayStopOnLast)i.swipeTo(0);else{clearInterval(Y);Y=undefined}}},t.autoplay)}};i.stopAutoplay=function(e){if(i.support.transitions){if(!G)return;if(G)clearTimeout(G);G=undefined;if(e&&!t.autoplayDisableOnInteraction){i.wrapperTransitionEnd(function(){Z()})}i.callPlugins("onAutoplayStop");if(t.onAutoplayStop)i.fireCallback(t.onAutoplayStop,i)}else{if(Y)clearInterval(Y);Y=undefined;i.callPlugins("onAutoplayStop");if(t.onAutoplayStop)i.fireCallback(t.onAutoplayStop,i)}};i.loopCreated=false;i.removeLoopedSlides=function(){if(i.loopCreated){for(var e=0;e<i.slides.length;e++){if(i.slides[e].getData("looped")===true)i.wrapper.removeChild(i.slides[e])}}};i.createLoop=function(){if(i.slides.length===0)return;if(t.slidesPerView==="auto"){i.loopedSlides=t.loopedSlides||1}else{i.loopedSlides=t.slidesPerView+t.loopAdditionalSlides}if(i.loopedSlides>i.slides.length){i.loopedSlides=i.slides.length}var e="",n="",r;var o="";var u=i.slides.length;var a=Math.floor(i.loopedSlides/u);var f=i.loopedSlides%u;for(r=0;r<a*u;r++){var l=r;if(r>=u){var c=Math.floor(r/u);l=r-u*c}o+=i.slides[l].outerHTML}for(r=0;r<f;r++){n+=X(t.slideDuplicateClass,i.slides[r].outerHTML)}for(r=u-f;r<u;r++){e+=X(t.slideDuplicateClass,i.slides[r].outerHTML)}var h=e+o+s.innerHTML+o+n;s.innerHTML=h;i.loopCreated=true;i.calcSlides();for(r=0;r<i.slides.length;r++){if(r<i.loopedSlides||r>=i.slides.length-i.loopedSlides)i.slides[r].setData("looped",true)}i.callPlugins("onCreateLoop")};i.fixLoop=function(){var e;if(i.activeIndex<i.loopedSlides){e=i.slides.length-i.loopedSlides*3+i.activeIndex;i.swipeTo(e,0,false)}else if(t.slidesPerView==="auto"&&i.activeIndex>=i.loopedSlides*2||i.activeIndex>i.slides.length-t.slidesPerView*2){e=-i.slides.length+i.activeIndex+i.loopedSlides;i.swipeTo(e,0,false)}};i.loadSlides=function(){var e="";i.activeLoaderIndex=0;var n=t.loader.slides;var r=t.loader.loadAllSlides?n.length:t.slidesPerView*(1+t.loader.surroundGroups);for(var s=0;s<r;s++){if(t.loader.slidesHTMLType==="outer")e+=n[s];else{e+="<"+t.slideElement+' class="'+t.slideClass+'" data-swiperindex="'+s+'">'+n[s]+"</"+t.slideElement+">"}}i.wrapper.innerHTML=e;i.calcSlides(true);if(!t.loader.loadAllSlides){i.wrapperTransitionEnd(i.reloadSlides,true)}};i.reloadSlides=function(){var e=t.loader.slides;var n=parseInt(i.activeSlide().data("swiperindex"),10);if(n<0||n>e.length-1)return;i.activeLoaderIndex=n;var r=Math.max(0,n-t.slidesPerView*t.loader.surroundGroups);var s=Math.min(n+t.slidesPerView*(1+t.loader.surroundGroups)-1,e.length-1);if(n>0){var u=-o*(n-r);i.setWrapperTranslate(u);i.setWrapperTransition(0)}var a;if(t.loader.logic==="reload"){i.wrapper.innerHTML="";var f="";for(a=r;a<=s;a++){f+=t.loader.slidesHTMLType==="outer"?e[a]:"<"+t.slideElement+' class="'+t.slideClass+'" data-swiperindex="'+a+'">'+e[a]+"</"+t.slideElement+">"}i.wrapper.innerHTML=f}else{var l=1e3;var c=0;for(a=0;a<i.slides.length;a++){var h=i.slides[a].data("swiperindex");if(h<r||h>s){i.wrapper.removeChild(i.slides[a])}else{l=Math.min(h,l);c=Math.max(h,c)}}for(a=r;a<=s;a++){var p;if(a<l){p=document.createElement(t.slideElement);p.className=t.slideClass;p.setAttribute("data-swiperindex",a);p.innerHTML=e[a];i.wrapper.insertBefore(p,i.wrapper.firstChild)}if(a>c){p=document.createElement(t.slideElement);p.className=t.slideClass;p.setAttribute("data-swiperindex",a);p.innerHTML=e[a];i.wrapper.appendChild(p)}}}i.reInit(true)};et()};Swiper.prototype={plugins:{},wrapperTransitionEnd:function(e,t){"use strict";function o(){e(n);if(n.params.queueEndCallbacks)n._queueEndCallbacks=false;if(!t){for(s=0;s<i.length;s++){n.h.removeEventListener(r,i[s],o)}}}var n=this,r=n.wrapper,i=["webkitTransitionEnd","transitionend","oTransitionEnd","MSTransitionEnd","msTransitionEnd"],s;if(e){for(s=0;s<i.length;s++){n.h.addEventListener(r,i[s],o)}}},getWrapperTranslate:function(e){"use strict";var t=this.wrapper,n,r,i,s;if(typeof e==="undefined"){e=this.params.mode==="horizontal"?"x":"y"}if(this.support.transforms&&this.params.useCSS3Transforms){i=window.getComputedStyle(t,null);if(window.WebKitCSSMatrix){s=new WebKitCSSMatrix(i.webkitTransform==="none"?"":i.webkitTransform)}else{s=i.MozTransform||i.OTransform||i.MsTransform||i.msTransform||i.transform||i.getPropertyValue("transform").replace("translate(","matrix(1, 0, 0, 1,");n=s.toString().split(",")}if(e==="x"){if(window.WebKitCSSMatrix)r=s.m41;else if(n.length===16)r=parseFloat(n[12]);else r=parseFloat(n[4])}if(e==="y"){if(window.WebKitCSSMatrix)r=s.m42;else if(n.length===16)r=parseFloat(n[13]);else r=parseFloat(n[5])}}else{if(e==="x")r=parseFloat(t.style.left,10)||0;if(e==="y")r=parseFloat(t.style.top,10)||0}return r||0},setWrapperTranslate:function(e,t,n){"use strict";var r=this.wrapper.style,i={x:0,y:0,z:0},s;if(arguments.length===3){i.x=e;i.y=t;i.z=n}else{if(typeof t==="undefined"){t=this.params.mode==="horizontal"?"x":"y"}i[t]=e}if(this.support.transforms&&this.params.useCSS3Transforms){s=this.support.transforms3d?"translate3d("+i.x+"px, "+i.y+"px, "+i.z+"px)":"translate("+i.x+"px, "+i.y+"px)";r.webkitTransform=r.MsTransform=r.msTransform=r.MozTransform=r.OTransform=r.transform=s}else{r.left=i.x+"px";r.top=i.y+"px"}this.callPlugins("onSetWrapperTransform",i);if(this.params.onSetWrapperTransform)this.fireCallback(this.params.onSetWrapperTransform,this,i)},setWrapperTransition:function(e){"use strict";var t=this.wrapper.style;t.webkitTransitionDuration=t.MsTransitionDuration=t.msTransitionDuration=t.MozTransitionDuration=t.OTransitionDuration=t.transitionDuration=e/1e3+"s";this.callPlugins("onSetWrapperTransition",{duration:e});if(this.params.onSetWrapperTransition)this.fireCallback(this.params.onSetWrapperTransition,this,e)},h:{getWidth:function(e,t,n){"use strict";var r=window.getComputedStyle(e,null).getPropertyValue("width");var i=parseFloat(r);if(isNaN(i)||r.indexOf("%")>0||i<0){i=e.offsetWidth-parseFloat(window.getComputedStyle(e,null).getPropertyValue("padding-left"))-parseFloat(window.getComputedStyle(e,null).getPropertyValue("padding-right"))}if(t)i+=parseFloat(window.getComputedStyle(e,null).getPropertyValue("padding-left"))+parseFloat(window.getComputedStyle(e,null).getPropertyValue("padding-right"));if(n)return Math.ceil(i);else return i},getHeight:function(e,t,n){"use strict";if(t)return e.offsetHeight;var r=window.getComputedStyle(e,null).getPropertyValue("height");var i=parseFloat(r);if(isNaN(i)||r.indexOf("%")>0||i<0){i=e.offsetHeight-parseFloat(window.getComputedStyle(e,null).getPropertyValue("padding-top"))-parseFloat(window.getComputedStyle(e,null).getPropertyValue("padding-bottom"))}if(t)i+=parseFloat(window.getComputedStyle(e,null).getPropertyValue("padding-top"))+parseFloat(window.getComputedStyle(e,null).getPropertyValue("padding-bottom"));if(n)return Math.ceil(i);else return i},getOffset:function(e){"use strict";var t=e.getBoundingClientRect();var n=document.body;var r=e.clientTop||n.clientTop||0;var i=e.clientLeft||n.clientLeft||0;var s=window.pageYOffset||e.scrollTop;var o=window.pageXOffset||e.scrollLeft;if(document.documentElement&&!window.pageYOffset){s=document.documentElement.scrollTop;o=document.documentElement.scrollLeft}return{top:t.top+s-r,left:t.left+o-i}},windowWidth:function(){"use strict";if(window.innerWidth)return window.innerWidth;else if(document.documentElement&&document.documentElement.clientWidth)return document.documentElement.clientWidth},windowHeight:function(){"use strict";if(window.innerHeight)return window.innerHeight;else if(document.documentElement&&document.documentElement.clientHeight)return document.documentElement.clientHeight},windowScroll:function(){"use strict";if(typeof pageYOffset!=="undefined"){return{left:window.pageXOffset,top:window.pageYOffset}}else if(document.documentElement){return{left:document.documentElement.scrollLeft,top:document.documentElement.scrollTop}}},addEventListener:function(e,t,n,r){"use strict";if(typeof r==="undefined"){r=false}if(e.addEventListener){e.addEventListener(t,n,r)}else if(e.attachEvent){e.attachEvent("on"+t,n)}},removeEventListener:function(e,t,n,r){"use strict";if(typeof r==="undefined"){r=false}if(e.removeEventListener){e.removeEventListener(t,n,r)}else if(e.detachEvent){e.detachEvent("on"+t,n)}}},setTransform:function(e,t){"use strict";var n=e.style;n.webkitTransform=n.MsTransform=n.msTransform=n.MozTransform=n.OTransform=n.transform=t},setTranslate:function(e,t){"use strict";var n=e.style;var r={x:t.x||0,y:t.y||0,z:t.z||0};var i=this.support.transforms3d?"translate3d("+r.x+"px,"+r.y+"px,"+r.z+"px)":"translate("+r.x+"px,"+r.y+"px)";n.webkitTransform=n.MsTransform=n.msTransform=n.MozTransform=n.OTransform=n.transform=i;if(!this.support.transforms){n.left=r.x+"px";n.top=r.y+"px"}},setTransition:function(e,t){"use strict";var n=e.style;n.webkitTransitionDuration=n.MsTransitionDuration=n.msTransitionDuration=n.MozTransitionDuration=n.OTransitionDuration=n.transitionDuration=t+"ms"},support:{touch:window.Modernizr&&Modernizr.touch===true||function(){"use strict";return!!("ontouchstart"in window||window.DocumentTouch&&document instanceof DocumentTouch)}(),transforms3d:window.Modernizr&&Modernizr.csstransforms3d===true||function(){"use strict";var e=document.createElement("div").style;return"webkitPerspective"in e||"MozPerspective"in e||"OPerspective"in e||"MsPerspective"in e||"perspective"in e}(),transforms:window.Modernizr&&Modernizr.csstransforms===true||function(){"use strict";var e=document.createElement("div").style;return"transform"in e||"WebkitTransform"in e||"MozTransform"in e||"msTransform"in e||"MsTransform"in e||"OTransform"in e}(),transitions:window.Modernizr&&Modernizr.csstransitions===true||function(){"use strict";var e=document.createElement("div").style;return"transition"in e||"WebkitTransition"in e||"MozTransition"in e||"msTransition"in e||"MsTransition"in e||"OTransition"in e}(),classList:function(){"use strict";var e=document.createElement("div").style;return"classList"in e}()},browser:{ie8:function(){"use strict";var e=-1;if(navigator.appName==="Microsoft Internet Explorer"){var t=navigator.userAgent;var n=new RegExp(/MSIE ([0-9]{1,}[\.0-9]{0,})/);if(n.exec(t)!==null)e=parseFloat(RegExp.$1)}return e!==-1&&e<9}(),ie10:window.navigator.msPointerEnabled,ie11:window.navigator.pointerEnabled}};if(window.jQuery||window.Zepto){(function(e){"use strict";e.fn.swiper=function(t){var n=new Swiper(e(this)[0],t);e(this).data("swiper",n);return n}})(window.jQuery||window.Zepto)}if(typeof module!=="undefined"){module.exports=Swiper}if(typeof define==="function"&&define.amd){define([],function(){"use strict";return Swiper})}


Swiper.prototype.plugins.progress = function (swiper, params) {
    'use strict';

    var isH = swiper.params.mode === 'horizontal';
    var wrapperMaxPosition;
    function initSlides() {
        for (var i = 0; i < swiper.slides.length; i++) {
            var slide = swiper.slides[i];
            slide.progressSlideSize = isH ? swiper.h.getWidth(slide) : swiper.h.getHeight(slide);
            if ('offsetLeft' in slide) {
                slide.progressSlideOffset = isH ? slide.offsetLeft : slide.offsetTop;
            }
            else {
                slide.progressSlideOffset = isH ? slide.getOffset().left - swiper.h.getOffset(swiper.container).left : slide.getOffset().top - swiper.h.getOffset(swiper.container).top;
            }
        }
        if (isH) {
            wrapperMaxPosition = swiper.h.getWidth(swiper.wrapper) + swiper.wrapperLeft + swiper.wrapperRight - swiper.width;
        }
        else {
            wrapperMaxPosition = swiper.h.getHeight(swiper.wrapper) + swiper.wrapperTop + swiper.wrapperBottom - swiper.height;
        }
    }
    function calcProgress(transform) {
        transform = transform || {x: 0, y: 0, z: 0};
        var offsetCenter;
        if (swiper.params.centeredSlides === true) offsetCenter = isH ? -transform.x + swiper.width / 2 : -transform.y + swiper.height / 2;
        else offsetCenter = isH ? -transform.x : -transform.y;
        //Each slide offset from offset center
        for (var i = 0; i < swiper.slides.length; i++) {
            var slide = swiper.slides[i];
            var slideCenterOffset = (swiper.params.centeredSlides === true) ? slide.progressSlideSize / 2 : 0;

            var offsetMultiplier = (offsetCenter - slide.progressSlideOffset - slideCenterOffset) / slide.progressSlideSize;
            slide.progress = offsetMultiplier;

        }
        // Global Swiper Progress
        swiper.progress = isH ? -transform.x / wrapperMaxPosition : -transform.y / wrapperMaxPosition;
        // Callback
        if (swiper.params.onProgressChange) swiper.fireCallback(swiper.params.onProgressChange, swiper);
    }

    //Plugin Hooks
    return {
        onFirstInit: function (args) {
            initSlides();
            calcProgress({
                x: swiper.getWrapperTranslate('x'),
                y: swiper.getWrapperTranslate('y')
            });
        },
        onInit: function (args) {
            initSlides();
        },
        onSetWrapperTransform: function (transform) {
            calcProgress(transform);
        }
    };
};
(function (Swiper) {

    Swiper.prototype.plugins.hashNav = function (swiper, params) {
        'use strict';
    
        var isH = swiper.params.mode === 'horizontal';
        if (!params) return;
    
        function updateHash(internal) {
            document.location.hash = swiper.activeSlide().getAttribute('data-hash') || '';
        }
    
        function swipeToHash(e) {
            var hash = document.location.hash.replace('#', '');
            if (!hash) return;
            var speed = e ? swiper.params.speed : 0;
            for (var i = 0, length = swiper.slides.length; i < length; i++) {
                var slide = swiper.slides[i];
                var slideHash = slide.getAttribute('data-hash');
                if (slideHash === hash && slide.getData('looped') !== true) {
                    var index = slide.index();
                    if (swiper.params.loop) index = index - swiper.loopedSlides;
                    swiper.swipeTo(index, speed);
                }
            }
        }
    
        //Plugin Hooks
        return {
            onSwiperCreated : function (args) {
                swipeToHash();
            },
            onSlideChangeStart: function () {
                updateHash(true);
            },
            onSwipeReset: function () {
                updateHash(true);
            }
        };
    };
    

})(Swiper);
;


/*
 * jQuery Easing v1.3 - http://gsgd.co.uk/sandbox/jquery/easing/
 *
 * Uses the built in easing capabilities added In jQuery 1.1
 * to offer multiple easing options
 *
 * TERMS OF USE - jQuery Easing
 * 
 * Open source under the BSD License. 
 * 
 * Copyright Â© 2008 George McGinley Smith
 * All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without modification, 
 * are permitted provided that the following conditions are met:
 * 
 * Redistributions of source code must retain the above copyright notice, this list of 
 * conditions and the following disclaimer.
 * Redistributions in binary form must reproduce the above copyright notice, this list 
 * of conditions and the following disclaimer in the documentation and/or other materials 
 * provided with the distribution.
 * 
 * Neither the name of the author nor the names of contributors may be used to endorse 
 * or promote products derived from this software without specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY 
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
 * MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 *  COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL,
 *  EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE
 *  GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED 
 * AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
 *  NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED 
 * OF THE POSSIBILITY OF SUCH DAMAGE. 
 *
*/

jQuery(document).ready(function() {

// t: current time, b: begInnIng value, c: change In value, d: duration
jQuery.easing['jswing'] = jQuery.easing['swing'];

jQuery.extend( jQuery.easing,
{
    def: 'easeOutQuad',
    swing: function (x, t, b, c, d) {
        //alert(jQuery.easing.default);
        return jQuery.easing[jQuery.easing.def](x, t, b, c, d);
    },
    easeInQuad: function (x, t, b, c, d) {
        return c*(t/=d)*t + b;
    },
    easeOutQuad: function (x, t, b, c, d) {
        return -c *(t/=d)*(t-2) + b;
    },
    easeInOutQuad: function (x, t, b, c, d) {
        if ((t/=d/2) < 1) return c/2*t*t + b;
        return -c/2 * ((--t)*(t-2) - 1) + b;
    },
    easeInCubic: function (x, t, b, c, d) {
        return c*(t/=d)*t*t + b;
    },
    easeOutCubic: function (x, t, b, c, d) {
        return c*((t=t/d-1)*t*t + 1) + b;
    },
    easeInOutCubic: function (x, t, b, c, d) {
        if ((t/=d/2) < 1) return c/2*t*t*t + b;
        return c/2*((t-=2)*t*t + 2) + b;
    },
    easeInQuart: function (x, t, b, c, d) {
        return c*(t/=d)*t*t*t + b;
    },
    easeOutQuart: function (x, t, b, c, d) {
        return -c * ((t=t/d-1)*t*t*t - 1) + b;
    },
    easeInOutQuart: function (x, t, b, c, d) {
        if ((t/=d/2) < 1) return c/2*t*t*t*t + b;
        return -c/2 * ((t-=2)*t*t*t - 2) + b;
    },
    easeInQuint: function (x, t, b, c, d) {
        return c*(t/=d)*t*t*t*t + b;
    },
    easeOutQuint: function (x, t, b, c, d) {
        return c*((t=t/d-1)*t*t*t*t + 1) + b;
    },
    easeInOutQuint: function (x, t, b, c, d) {
        if ((t/=d/2) < 1) return c/2*t*t*t*t*t + b;
        return c/2*((t-=2)*t*t*t*t + 2) + b;
    },
    easeInSine: function (x, t, b, c, d) {
        return -c * Math.cos(t/d * (Math.PI/2)) + c + b;
    },
    easeOutSine: function (x, t, b, c, d) {
        return c * Math.sin(t/d * (Math.PI/2)) + b;
    },
    easeInOutSine: function (x, t, b, c, d) {
        return -c/2 * (Math.cos(Math.PI*t/d) - 1) + b;
    },
    easeInExpo: function (x, t, b, c, d) {
        return (t==0) ? b : c * Math.pow(2, 10 * (t/d - 1)) + b;
    },
    easeOutExpo: function (x, t, b, c, d) {
        return (t==d) ? b+c : c * (-Math.pow(2, -10 * t/d) + 1) + b;
    },
    easeInOutExpo: function (x, t, b, c, d) {
        if (t==0) return b;
        if (t==d) return b+c;
        if ((t/=d/2) < 1) return c/2 * Math.pow(2, 10 * (t - 1)) + b;
        return c/2 * (-Math.pow(2, -10 * --t) + 2) + b;
    },
    easeInCirc: function (x, t, b, c, d) {
        return -c * (Math.sqrt(1 - (t/=d)*t) - 1) + b;
    },
    easeOutCirc: function (x, t, b, c, d) {
        return c * Math.sqrt(1 - (t=t/d-1)*t) + b;
    },
    easeInOutCirc: function (x, t, b, c, d) {
        if ((t/=d/2) < 1) return -c/2 * (Math.sqrt(1 - t*t) - 1) + b;
        return c/2 * (Math.sqrt(1 - (t-=2)*t) + 1) + b;
    },
    easeInElastic: function (x, t, b, c, d) {
        var s=1.70158;var p=0;var a=c;
        if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;
        if (a < Math.abs(c)) { a=c; var s=p/4; }
        else var s = p/(2*Math.PI) * Math.asin (c/a);
        return -(a*Math.pow(2,10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )) + b;
    },
    easeOutElastic: function (x, t, b, c, d) {
        var s=1.70158;var p=0;var a=c;
        if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;
        if (a < Math.abs(c)) { a=c; var s=p/4; }
        else var s = p/(2*Math.PI) * Math.asin (c/a);
        return a*Math.pow(2,-10*t) * Math.sin( (t*d-s)*(2*Math.PI)/p ) + c + b;
    },
    easeInOutElastic: function (x, t, b, c, d) {
        var s=1.70158;var p=0;var a=c;
        if (t==0) return b;  if ((t/=d/2)==2) return b+c;  if (!p) p=d*(.3*1.5);
        if (a < Math.abs(c)) { a=c; var s=p/4; }
        else var s = p/(2*Math.PI) * Math.asin (c/a);
        if (t < 1) return -.5*(a*Math.pow(2,10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )) + b;
        return a*Math.pow(2,-10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )*.5 + c + b;
    },
    easeInBack: function (x, t, b, c, d, s) {
        if (s == undefined) s = 1.70158;
        return c*(t/=d)*t*((s+1)*t - s) + b;
    },
    easeOutBack: function (x, t, b, c, d, s) {
        if (s == undefined) s = 1.70158;
        return c*((t=t/d-1)*t*((s+1)*t + s) + 1) + b;
    },
    easeInOutBack: function (x, t, b, c, d, s) {
        if (s == undefined) s = 1.70158; 
        if ((t/=d/2) < 1) return c/2*(t*t*(((s*=(1.525))+1)*t - s)) + b;
        return c/2*((t-=2)*t*(((s*=(1.525))+1)*t + s) + 2) + b;
    },
    easeInBounce: function (x, t, b, c, d) {
        return c - jQuery.easing.easeOutBounce (x, d-t, 0, c, d) + b;
    },
    easeOutBounce: function (x, t, b, c, d) {
        if ((t/=d) < (1/2.75)) {
            return c*(7.5625*t*t) + b;
        } else if (t < (2/2.75)) {
            return c*(7.5625*(t-=(1.5/2.75))*t + .75) + b;
        } else if (t < (2.5/2.75)) {
            return c*(7.5625*(t-=(2.25/2.75))*t + .9375) + b;
        } else {
            return c*(7.5625*(t-=(2.625/2.75))*t + .984375) + b;
        }
    },
    easeInOutBounce: function (x, t, b, c, d) {
        if (t < d/2) return jQuery.easing.easeInBounce (x, t*2, 0, c, d) * .5 + b;
        return jQuery.easing.easeOutBounce (x, t*2-d, 0, c, d) * .5 + c*.5 + b;
    }
});

});;
(function ($, window, document, undefined) {

  var pluginName = "MegaMenu",
    defaults = {
      propertyName: "value"
    };
  var DELAY = 250;

  // the list of menus
  var menus = [];

  function CustomMenu(element, options) {
    this.element = element;

    this.options = $.extend({}, defaults, options);

    this._defaults = defaults;
    this._name = pluginName;

    this.init(element);
  } 

  CustomMenu.prototype = {
    isOpen: false,
    timeout: null,
    init: function (element) {

      var that = this;
      var id = $(element).attr('id');

      $("#" + id).each(function(index, menu) {

        that.node = menu;
        that.addListeners(menu);

        $(menu).addClass("dropdownJavascript");
        menus.push(menu);

        $(menu).find('ul > li').each(function(index, submenu) {
          if ($(submenu).find('ul').length > 0 ) {
            $(submenu).addClass('with-menu');
          }
        });
      });
    },
    addListeners: function(menu) {
      var that = this;
      $(menu).mouseover(function(e) {
        that.handleMouseOver.call(that, e);
      }).mouseout(function(e) {
          that.handleMouseOut.call(that, e);
        });
    },
    handleMouseOver: function (e) {
      var that = this;
      // clear the timeout
      this.clearTimeout();

      // find the parent list item
      //var item = ('target' in e ? e.target : e.srcElement);
      var item = e.target || e.srcElement;
      while (item.nodeName != 'LI' && item != this.node) {
        item = item.parentNode;
      }

      // if the target is within a list item, set the timeout
      if (item.nodeName == 'LI') {
        this.toOpen = item;
        this.timeout = setTimeout(function() {
          that.open.call(that);
        }, this.options.delay);
      }

    },
    handleMouseOut: function () {
      var that = this;
      // clear the timeout
      this.clearTimeout();

      this.timeout = setTimeout(function() {
        that.close.call(that);
      }, this.options.delay);

    },
    clearTimeout: function () {

      // clear the timeout
      if (this.timeout) {
        clearTimeout(this.timeout);
        this.timeout = null;
      }

    },
    open: function () {

      var that = this;
      // store that the menu is open
      this.isOpen = true;

      // loop over the list items with the same parent
      var items = $(this.toOpen).parent().children('li');
      $(items).each(function(index, item) {
        $(item).find("ul").each(function(index, submenu) {
          if (item != that.toOpen) {
            // close the submenu
            $(item).removeClass("dropdownOpen");
            that.close(item);

          } else if (!$(item).hasClass('dropdownOpen')) {

            // open the submenu
            //if ( !$(item).parents('li').hasClass('has-mega-menu') ) {
              $(item).addClass("dropdownOpen");
            //}


            // determine the location of the edges of the submenu
            var left = 0;
            var node = submenu;
            while (node) {
              //abs is because when you make menus right to left
              //the offsetLeft would be negative
              left += Math.abs(node.offsetLeft);
              node = node.offsetParent;
            }
            var right = left + submenu.offsetWidth;


            //We should refactor this code to execute only when menu is vertical
            var menuHeight = $(submenu).outerHeight();
            var parentTop = $(submenu).offset().top - $(window).scrollTop();
            var totalHeight = menuHeight + parentTop;
            var windowHeight = window.innerHeight;

           /* if (totalHeight > windowHeight) {
              var bestTop = (windowHeight - totalHeight) - 20;
              $(submenu).css('margin-top', bestTop + "px");
            }*/

            //remove any previous classes
            $(item).removeClass('dropdownRightToLeft');

            // move the submenu to the right of the item if appropriate
            if (left < 0) $(item).addClass('dropdownLeftToRight');

            // move the submenu to the left of the item if appropriate
            if (right > document.body.clientWidth) {
              $(item).addClass('dropdownRightToLeft');
            }

          }
        });
      });

    },


    close: function (node) {

      // if no node was specified, close all menus
      if (!node) {
        this.isOpen = false;
        node = this.node;
      }

      // loop over the items, closing their submenus
      $(node).find('li').each(function(index, item) {
        $(item).removeClass('dropdownOpen');
      });

    }
  };

  $.fn[pluginName] = function (options) {
    return this.each(function () {
      if (!$.data(this, "plugin_" + pluginName)) {
        $.data(this, "plugin_" + pluginName,
          new CustomMenu(this, options));
      }
    });
  };

})(jQuery, window, document);
;;
(function($, window, undefined) {

	'use strict';

	// global
	var Modernizr = window.Modernizr,
		$body = $('body');

	$.DLMenu = function(options, element) {
		this.$el = $(element);
		this._init(options);
	};

	$.DLMenu.defaults = {
		animationClasses: {
			classin: 'mk-vm-animate-in-' + $('body').attr('data-vm-anim'),
			classout: 'mk-vm-animate-out-' + $('body').attr('data-vm-anim')
		},
		onLevelClick: function(el, name) {
			return false;
		},
		onLinkClick: function(el, ev) {
			return false;
		}
	};

	$.DLMenu.prototype = {
		_init: function(options) {

			this.options = $.extend(true, {}, $.DLMenu.defaults, options);
			this._config();

			var animEndEventNames = {
					'WebkitAnimation': 'webkitAnimationEnd',
					'OAnimation': 'oAnimationEnd',
					'msAnimation': 'MSAnimationEnd',
					'animation': 'animationend'
				},
				transEndEventNames = {
					'WebkitTransition': 'webkitTransitionEnd',
					'MozTransition': 'transitionend',
					'OTransition': 'oTransitionEnd',
					'msTransition': 'MSTransitionEnd',
					'transition': 'transitionend'
				};
			this.animEndEventName = animEndEventNames[Modernizr.prefixed('animation')] + '.dlmenu';
			this.transEndEventName = transEndEventNames[Modernizr.prefixed('transition')] + '.dlmenu',
			this.supportAnimations = Modernizr.cssanimations,
			this.supportTransitions = Modernizr.csstransitions;

			this._initEvents();

		},
		_config: function() {
			this.open = false;
			var $backText = $('body').attr('data-backText');
			this.$trigger = this.$el.children('.mk-vm-trigger');
			this.$menu = this.$el.children('ul.mk-vm-menu');
			this.$menuitems = this.$menu.find('li:not(.mk-vm-back)');
			this.$el.find('ul.sub-menu').prepend('<li class="mk-vm-back"><a href="#">' + $backText + '</a></li>');
			this.$back = this.$menu.find('li.mk-vm-back');
		},
		_initEvents: function() {

			var self = this;

			this.$trigger.on('click.dlmenu', function() {

				if (self.open) {
					self._closeMenu();
				} else {
					self._openMenu();
				}
				return false;

			});

			this.$menuitems.on('click.dlmenu', function(event) {

				event.stopPropagation();

				var $item = $(this),
					$submenu = $item.children('ul.sub-menu');

				if ($submenu.length > 0) {

					var $flyin = $submenu.clone().css('opacity', 0).insertAfter(self.$menu),
						onAnimationEndFn = function() {
							self.$menu.off(self.animEndEventName).removeClass(self.options.animationClasses.classout).addClass('mk-vm-subview');
							$item.addClass('mk-vm-subviewopen').parents('.mk-vm-subviewopen:first').removeClass('mk-vm-subviewopen').addClass('mk-vm-subview');
							$flyin.remove();
						};

					setTimeout(function() {
						$flyin.addClass(self.options.animationClasses.classin);
						self.$menu.addClass(self.options.animationClasses.classout);
						if (self.supportAnimations) {
							self.$menu.on(self.animEndEventName, onAnimationEndFn);
						} else {
							onAnimationEndFn.call();
						}

						self.options.onLevelClick($item, $item.children('a:first').text());
					});

					return false;

				} else {
					self.options.onLinkClick($item, event);
				}

			});

			this.$back.on('click.dlmenu', function(event) {

				var $this = $(this),
					$submenu = $this.parents('ul.sub-menu:first'),
					$item = $submenu.parent(),

					$flyin = $submenu.clone().insertAfter(self.$menu);

				var onAnimationEndFn = function() {
					self.$menu.off(self.animEndEventName).removeClass(self.options.animationClasses.classin);
					$flyin.remove();
				};

				setTimeout(function() {
					$flyin.addClass(self.options.animationClasses.classout);
					self.$menu.addClass(self.options.animationClasses.classin);
					if (self.supportAnimations) {
						self.$menu.on(self.animEndEventName, onAnimationEndFn);
					} else {
						onAnimationEndFn.call();
					}

					$item.removeClass('mk-vm-subviewopen');

					var $subview = $this.parents('.mk-vm-subview:first');
					if ($subview.is('li')) {
						$subview.addClass('mk-vm-subviewopen');
					}
					$subview.removeClass('mk-vm-subview');
				});

				return false;

			});

		},
		closeMenu: function() {
			if (this.open) {
				this._closeMenu();
			}
		},
		_closeMenu: function() {
			var self = this,
				onTransitionEndFn = function() {
					self.$menu.off(self.transEndEventName);
					self._resetMenu();
				};

			this.$menu.removeClass('mk-vm-menuopen');
			this.$menu.addClass('mk-vm-menu-toggle');
			this.$trigger.removeClass('mk-vm-active');

			if (this.supportTransitions) {
				this.$menu.on(this.transEndEventName, onTransitionEndFn);
			} else {
				onTransitionEndFn.call();
			}

			this.open = false;
		},
		openMenu: function() {
			if (!this.open) {
				this._openMenu();
			}
		},
		_openMenu: function() {
			var self = this;
			$body.off('click').on('click.dlmenu', function() {
				self._closeMenu();
			});
			this.$menu.addClass('mk-vm-menuopen mk-vm-menu-toggle').on(this.transEndEventName, function() {
				$(this).removeClass('mk-vm-menu-toggle');
			});
			this.$trigger.addClass('mk-vm-active');
			this.open = true;
		},
		_resetMenu: function() {
			this.$menu.removeClass('mk-vm-subview');
			this.$menuitems.removeClass('mk-vm-subview mk-vm-subviewopen');
		}
	};

	var logError = function(message) {
		if (window.console) {
			window.console.error(message);
		}
	};

	$.fn.dlmenu = function(options) {
		if (typeof options === 'string') {
			var args = Array.prototype.slice.call(arguments, 1);
			this.each(function() {
				var instance = $.data(this, 'dlmenu');
				if (!instance) {
					logError("cannot call methods on dlmenu prior to initialization; " +
						"attempted to call method '" + options + "'");
					return;
				}
				if (!$.isFunction(instance[options]) || options.charAt(0) === "_") {
					logError("no such method '" + options + "' for dlmenu instance");
					return;
				}
				instance[options].apply(instance, args);
			});
		} else {
			this.each(function() {
				var instance = $.data(this, 'dlmenu');
				if (instance) {
					instance._init();
				} else {
					instance = $.data(this, 'dlmenu', new $.DLMenu(options, this));
				}
			});
		}
		return this;
	};

})(jQuery, window);;;(function ($, window, document, undefined) {

  // Defaults
  var pluginName = "sectiontrans",
    defaults = {
      effect: "fade"
    };

  // The actual plugin constructor
  function Plugin(element, options) {
    this.element = element;

    //merge options and defaults
    this.options = $.extend({}, defaults, options);

    this._defaults = defaults;
    this._name = pluginName;

    this.effectClassName = 'intro-effect-' + this.options.effect;

    this.init();
  }

  Plugin.prototype = {

    init: function () {
      // refreshing the page...
      var pageScroll = this.scrollY();
      this.noscroll = pageScroll === 0;

      this.disable_scroll();

      $(this.element).addClass(this.effectClassName);

      if (pageScroll) {
        this.isRevealed = true;
        $(this.element).addClass('notrans');
        $(this.element).addClass('modify');
      }

      var that = this;

      window.addEventListener('scroll', function(e) {
        that.scrollPage.call(that, e);
      });
    },
    keys: [32, 37, 38, 39, 40],
    docElem: window.document.documentElement,
    scrollVal: 0,
    isRevealed: false,
    noscroll: false,
    isAnimating: false,
    trigger: $('button.trigger'),
    preventDefault: function (e) {
      e = e || window.event;
      if (e.preventDefault)
        e.preventDefault();
      e.returnValue = false;
    },
    ie: (function () {
      var undef, rv = -1; // Return value assumes failure.
      var ua = window.navigator.userAgent;
      var msie = ua.indexOf('MSIE ');
      var trident = ua.indexOf('Trident/');

      if (msie > 0) {
        // IE 10 or older => return version number
        rv = parseInt(ua.substring(msie + 5, ua.indexOf('.', msie)), 10);
      } else if (trident > 0) {
        // IE 11 (or newer) => return version number
        var rvNum = ua.indexOf('rv:');
        rv = parseInt(ua.substring(rvNum + 3, ua.indexOf('.', rvNum)), 10);
      }

      return ((rv > -1) ? rv : undef);
    }()),
    wheel: function (e) {
      if(!this.scrollY() && !this.isAnimating) {
        if (e.wheelDelta > 0 && this.isRevealed) this.toggle(0);
        else if (e.wheelDelta <= 0 && !this.isRevealed) this.toggle(1);
      }
      e.preventDefault();
    },
    disable_scroll: function () {
      window.onmousewheel = document.onmousewheel = this.wheel.bind(this);
    },
    enable_scroll: function () {
      window.onmousewheel = document.onmousewheel = document.onkeydown = document.body.ontouchmove = null;
    },
    scrollY: function () {
      return window.pageYOffset || this.docElem.scrollTop;
    },
    scrollPage: function () {
      this.scrollVal = this.scrollY();

      if (this.noscroll) {
        if (this.scrollVal < 0) return false;
        // keep it that way
        window.scrollTo(0, 0);
      }

      if ($(this.element).hasClass('notrans')) {
        $(this.element).removeClass('notrans');
        return false;
      }

      if (this.isAnimating) {
        return false;
      }

      if (this.scrollVal <= 0 && this.isRevealed) {
        this.toggle(0);
      }
      else if (this.scrollVal > 0 && !this.isRevealed) {
        this.toggle(1);
      }
    },
    toggle: function (reveal) {
      this.isAnimating = true;

      if (reveal) {
        $(this.element).addClass('mk-intro-triggered');
        $('.' + this.effectClassName).next().next().addClass('mk-intro-triggered' + ' ' + 'page-effect-'+this.options.effect);
        $('body').addClass('mk-intro-triggered').trigger('page_intro');
      }
      else {
        this.noscroll = true;
        this.disable_scroll();
        $(this.element).removeClass('mk-intro-triggered');
        $('.' + this.effectClassName).next().next().removeClass('mk-intro-triggered' + ' ' + 'page-effect-'+this.options.effect);
        $('body').removeClass('mk-intro-triggered').trigger('page_outro');
      }

      var that = this;
      // simulating the end of the transition:
      setTimeout(function () {
        that.isRevealed = !that.isRevealed;
        that.isAnimating = false;
        if (reveal) {
          that.noscroll = false;
          that.enable_scroll();
        }
      }, 1200);
    }

  };

  // A really lightweight plugin wrapper around the constructor,
  // preventing against multiple instantiations
  $.fn[pluginName] = function (options) {
    return this.each(function () {
      if (!$.data(this, "plugin_" + pluginName)) {
        $.data(this, "plugin_" + pluginName,
          new Plugin(this, options));
      }
    });
  };

})(jQuery, window, document);;//============================================================
//
// The MIT License
//
// Copyright (C) 2014 Matthew Wagerfield - @wagerfield
//
// Permission is hereby granted, free of charge, to any
// person obtaining a copy of this software and associated
// documentation files (the "Software"), to deal in the
// Software without restriction, including without limitation
// the rights to use, copy, modify, merge, publish, distribute,
// sublicense, and/or sell copies of the Software, and to
// permit persons to whom the Software is furnished to do
// so, subject to the following conditions:
//
// The above copyright notice and this permission notice
// shall be included in all copies or substantial portions
// of the Software.
//
// THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY
// OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT
// LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS
// FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO
// EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE
// FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN
// AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
// OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE
// OR OTHER DEALINGS IN THE SOFTWARE.
//
//============================================================

/**
 * Parallax.js
 * @author Matthew Wagerfield - @wagerfield
 * @description Creates a parallax effect between an array of layers,
 *              driving the motion from the gyroscope output of a smartdevice.
 *              If no gyroscope is available, the cursor position is used.
 */
;(function(window, document, undefined) {

  // Strict Mode
  'use strict';

  // Constants
  var NAME = 'Parallax';
  var MAGIC_NUMBER = 30;
  var DEFAULTS = {
    relativeInput: false,
    clipRelativeInput: false,
    calibrationThreshold: 100,
    calibrationDelay: 500,
    supportDelay: 500,
    calibrateX: false,
    calibrateY: true,
    invertX: true,
    invertY: true,
    limitX: false,
    limitY: false,
    scalarX: 10.0,
    scalarY: 10.0,
    frictionX: 0.1,
    frictionY: 0.1,
    originX: 0.5,
    originY: 0.5
  };

  function Parallax(element, options) {

    // DOM Context
    this.element = element;
    this.layers = element.getElementsByClassName('layer');

    // Data Extraction
    var data = {
      calibrateX: this.data(this.element, 'calibrate-x'),
      calibrateY: this.data(this.element, 'calibrate-y'),
      invertX: this.data(this.element, 'invert-x'),
      invertY: this.data(this.element, 'invert-y'),
      limitX: this.data(this.element, 'limit-x'),
      limitY: this.data(this.element, 'limit-y'),
      scalarX: this.data(this.element, 'scalar-x'),
      scalarY: this.data(this.element, 'scalar-y'),
      frictionX: this.data(this.element, 'friction-x'),
      frictionY: this.data(this.element, 'friction-y'),
      originX: this.data(this.element, 'origin-x'),
      originY: this.data(this.element, 'origin-y')
    };

    // Delete Null Data Values
    for (var key in data) {
      if (data[key] === null) delete data[key];
    }

    // Compose Settings Object
    this.extend(this, DEFAULTS, options, data);

    // States
    this.calibrationTimer = null;
    this.calibrationFlag = true;
    this.enabled = false;
    this.depths = [];
    this.raf = null;

    // Element Bounds
    this.bounds = null;
    this.ex = 0;
    this.ey = 0;
    this.ew = 0;
    this.eh = 0;

    // Element Center
    this.ecx = 0;
    this.ecy = 0;

    // Element Range
    this.erx = 0;
    this.ery = 0;

    // Calibration
    this.cx = 0;
    this.cy = 0;

    // Input
    this.ix = 0;
    this.iy = 0;

    // Motion
    this.mx = 0;
    this.my = 0;

    // Velocity
    this.vx = 0;
    this.vy = 0;

    // Callbacks
    this.onMouseMove = this.onMouseMove.bind(this);
    this.onDeviceOrientation = this.onDeviceOrientation.bind(this);
    this.onOrientationTimer = this.onOrientationTimer.bind(this);
    this.onCalibrationTimer = this.onCalibrationTimer.bind(this);
    this.onAnimationFrame = this.onAnimationFrame.bind(this);
    this.onWindowResize = this.onWindowResize.bind(this);

    // Initialise
    this.initialise();
  }

  Parallax.prototype.extend = function() {
    if (arguments.length > 1) {
      var master = arguments[0];
      for (var i = 1, l = arguments.length; i < l; i++) {
        var object = arguments[i];
        for (var key in object) {
          master[key] = object[key];
        }
      }
    }
  };

  Parallax.prototype.data = function(element, name) {
    return this.deserialize(element.getAttribute('data-'+name));
  };

  Parallax.prototype.deserialize = function(value) {
    if (value === "true") {
      return true;
    } else if (value === "false") {
      return false;
    } else if (value === "null") {
      return null;
    } else if (!isNaN(parseFloat(value)) && isFinite(value)) {
      return parseFloat(value);
    } else {
      return value;
    }
  };

  Parallax.prototype.camelCase = function(value) {
    return value.replace(/-+(.)?/g, function(match, character){
      return character ? character.toUpperCase() : '';
    });
  };

  Parallax.prototype.transformSupport = function(value) {
    var element = document.createElement('div');
    var propertySupport = false;
    var propertyValue = null;
    var featureSupport = false;
    var cssProperty = null;
    var jsProperty = null;
    for (var i = 0, l = this.vendors.length; i < l; i++) {
      if (this.vendors[i] !== null) {
        cssProperty = this.vendors[i][0] + 'transform';
        jsProperty = this.vendors[i][1] + 'Transform';
      } else {
        cssProperty = 'transform';
        jsProperty = 'transform';
      }
      if (element.style[jsProperty] !== undefined) {
        propertySupport = true;
        break;
      }
    }
    switch(value) {
      case '2D':
        featureSupport = propertySupport;
        break;
      case '3D':
        if (propertySupport) {
          var body = document.body || document.createElement('body');
          var documentElement = document.documentElement;
          var documentOverflow = documentElement.style.overflow;
          if (!document.body) {
            documentElement.style.overflow = 'hidden';
            documentElement.appendChild(body);
            body.style.overflow = 'hidden';
            body.style.background = '';
          }
          body.appendChild(element);
          element.style[jsProperty] = 'translate3d(1px,1px,1px)';
          propertyValue = window.getComputedStyle(element).getPropertyValue(cssProperty);
          featureSupport = propertyValue !== undefined && propertyValue.length > 0 && propertyValue !== "none";
          documentElement.style.overflow = documentOverflow;
          body.removeChild(element);
        }
        break;
    }
    return featureSupport;
  };

  Parallax.prototype.ww = null;
  Parallax.prototype.wh = null;
  Parallax.prototype.wcx = null;
  Parallax.prototype.wcy = null;
  Parallax.prototype.wrx = null;
  Parallax.prototype.wry = null;
  Parallax.prototype.portrait = null;
  Parallax.prototype.desktop = !navigator.userAgent.match(/(iPhone|iPod|iPad|Android|BlackBerry|BB10|mobi|tablet|opera mini|nexus 7)/i);
  Parallax.prototype.vendors = [null,['-webkit-','webkit'],['-moz-','Moz'],['-o-','O'],['-ms-','ms']];
  Parallax.prototype.motionSupport = !!window.DeviceMotionEvent;
  Parallax.prototype.orientationSupport = !!window.DeviceOrientationEvent;
  Parallax.prototype.orientationStatus = 0;
  Parallax.prototype.transform2DSupport = Parallax.prototype.transformSupport('2D');
  Parallax.prototype.transform3DSupport = Parallax.prototype.transformSupport('3D');
  Parallax.prototype.propertyCache = {};

  Parallax.prototype.initialise = function() {

    // Configure Context Styles
    if (this.transform3DSupport) this.accelerate(this.element);
    var style = window.getComputedStyle(this.element);
    if (style.getPropertyValue('position') === 'static') {
      this.element.style.position = 'relative';
    }

    // Setup
    this.updateLayers();
    this.updateDimensions();
    this.enable();
    this.queueCalibration(this.calibrationDelay);
  };

  Parallax.prototype.updateLayers = function() {

    // Cache Layer Elements
    this.layers = this.element.getElementsByClassName('layer');
    this.depths = [];

    // Configure Layer Styles
    for (var i = 0, l = this.layers.length; i < l; i++) {
      var layer = this.layers[i];
      if (this.transform3DSupport) this.accelerate(layer);
      layer.style.position = i ? 'absolute' : 'relative';
      layer.style.display = 'block';
      layer.style.left = 0;
      layer.style.top = 0;

      // Cache Layer Depth
      this.depths.push(this.data(layer, 'depth') || 0);
    }
  };

  Parallax.prototype.updateDimensions = function() {
    this.ww = window.innerWidth;
    this.wh = window.innerHeight;
    this.wcx = this.ww * this.originX;
    this.wcy = this.wh * this.originY;
    this.wrx = Math.max(this.wcx, this.ww - this.wcx);
    this.wry = Math.max(this.wcy, this.wh - this.wcy);
  };

  Parallax.prototype.updateBounds = function() {
    this.bounds = this.element.getBoundingClientRect();
    this.ex = this.bounds.left;
    this.ey = this.bounds.top;
    this.ew = this.bounds.width;
    this.eh = this.bounds.height;
    this.ecx = this.ew * this.originX;
    this.ecy = this.eh * this.originY;
    this.erx = Math.max(this.ecx, this.ew - this.ecx);
    this.ery = Math.max(this.ecy, this.eh - this.ecy);
  };

  Parallax.prototype.queueCalibration = function(delay) {
    clearTimeout(this.calibrationTimer);
    this.calibrationTimer = setTimeout(this.onCalibrationTimer, delay);
  };

  Parallax.prototype.enable = function() {
    if (!this.enabled) {
      this.enabled = true;
      if (this.orientationSupport) {
        this.portrait = null;
        window.addEventListener('deviceorientation', this.onDeviceOrientation);
        setTimeout(this.onOrientationTimer, this.supportDelay);
      } else {
        this.cx = 0;
        this.cy = 0;
        this.portrait = false;
        window.addEventListener('mousemove', this.onMouseMove);
      }
      window.addEventListener('resize', this.onWindowResize);
      this.raf = requestAnimationFrame(this.onAnimationFrame);
    }
  };

  Parallax.prototype.disable = function() {
    if (this.enabled) {
      this.enabled = false;
      if (this.orientationSupport) {
        window.removeEventListener('deviceorientation', this.onDeviceOrientation);
      } else {
        window.removeEventListener('mousemove', this.onMouseMove);
      }
      window.removeEventListener('resize', this.onWindowResize);
      cancelAnimationFrame(this.raf);
    }
  };

  Parallax.prototype.calibrate = function(x, y) {
    this.calibrateX = x === undefined ? this.calibrateX : x;
    this.calibrateY = y === undefined ? this.calibrateY : y;
  };

  Parallax.prototype.invert = function(x, y) {
    this.invertX = x === undefined ? this.invertX : x;
    this.invertY = y === undefined ? this.invertY : y;
  };

  Parallax.prototype.friction = function(x, y) {
    this.frictionX = x === undefined ? this.frictionX : x;
    this.frictionY = y === undefined ? this.frictionY : y;
  };

  Parallax.prototype.scalar = function(x, y) {
    this.scalarX = x === undefined ? this.scalarX : x;
    this.scalarY = y === undefined ? this.scalarY : y;
  };

  Parallax.prototype.limit = function(x, y) {
    this.limitX = x === undefined ? this.limitX : x;
    this.limitY = y === undefined ? this.limitY : y;
  };

  Parallax.prototype.origin = function(x, y) {
    this.originX = x === undefined ? this.originX : x;
    this.originY = y === undefined ? this.originY : y;
  };

  Parallax.prototype.clamp = function(value, min, max) {
    value = Math.max(value, min);
    value = Math.min(value, max);
    return value;
  };

  Parallax.prototype.css = function(element, property, value) {
    var jsProperty = this.propertyCache[property];
    if (!jsProperty) {
      for (var i = 0, l = this.vendors.length; i < l; i++) {
        if (this.vendors[i] !== null) {
          jsProperty = this.camelCase(this.vendors[i][1] + '-' + property);
        } else {
          jsProperty = property;
        }
        if (element.style[jsProperty] !== undefined) {
          this.propertyCache[property] = jsProperty;
          break;
        }
      }
    }
    element.style[jsProperty] = value;
  };

  Parallax.prototype.accelerate = function(element) {
    this.css(element, 'transform', 'translate3d(0,0,0)');
    this.css(element, 'transform-style', 'preserve-3d');
    this.css(element, 'backface-visibility', 'hidden');
  };

  Parallax.prototype.setPosition = function(element, x, y) {
    x += 'px';
    y += 'px';
    if (this.transform3DSupport) {
      this.css(element, 'transform', 'translate3d('+x+','+y+',0)');
    } else if (this.transform2DSupport) {
      this.css(element, 'transform', 'translate('+x+','+y+')');
    } else {
      element.style.left = x;
      element.style.top = y;
    }
  };

  Parallax.prototype.onOrientationTimer = function(event) {
    if (this.orientationSupport && this.orientationStatus === 0) {
      this.disable();
      this.orientationSupport = false;
      this.enable();
    }
  };

  Parallax.prototype.onCalibrationTimer = function(event) {
    this.calibrationFlag = true;
  };

  Parallax.prototype.onWindowResize = function(event) {
    this.updateDimensions();
  };

  Parallax.prototype.onAnimationFrame = function() {
    this.updateBounds();
    var dx = this.ix - this.cx;
    var dy = this.iy - this.cy;
    if ((Math.abs(dx) > this.calibrationThreshold) || (Math.abs(dy) > this.calibrationThreshold)) {
      this.queueCalibration(0);
    }
    if (this.portrait) {
      this.mx = this.calibrateX ? dy : this.iy;
      this.my = this.calibrateY ? dx : this.ix;
    } else {
      this.mx = this.calibrateX ? dx : this.ix;
      this.my = this.calibrateY ? dy : this.iy;
    }
    this.mx *= this.ew * (this.scalarX / 100);
    this.my *= this.eh * (this.scalarY / 100);
    if (!isNaN(parseFloat(this.limitX))) {
      this.mx = this.clamp(this.mx, -this.limitX, this.limitX);
    }
    if (!isNaN(parseFloat(this.limitY))) {
      this.my = this.clamp(this.my, -this.limitY, this.limitY);
    }
    this.vx += (this.mx - this.vx) * this.frictionX;
    this.vy += (this.my - this.vy) * this.frictionY;
    for (var i = 0, l = this.layers.length; i < l; i++) {
      var layer = this.layers[i];
      var depth = this.depths[i];
      var xOffset = this.vx * depth * (this.invertX ? -1 : 1);
      var yOffset = this.vy * depth * (this.invertY ? -1 : 1);
      this.setPosition(layer, xOffset, yOffset);
    }
    this.raf = requestAnimationFrame(this.onAnimationFrame);
  };

  Parallax.prototype.onDeviceOrientation = function(event) {

    // Validate environment and event properties.
    if (!this.desktop && event.beta !== null && event.gamma !== null) {

      // Set orientation status.
      this.orientationStatus = 1;

      // Extract Rotation
      var x = (event.beta  || 0) / MAGIC_NUMBER; //  -90 :: 90
      var y = (event.gamma || 0) / MAGIC_NUMBER; // -180 :: 180

      // Detect Orientation Change
      var portrait = this.wh > this.ww;
      if (this.portrait !== portrait) {
        this.portrait = portrait;
        this.calibrationFlag = true;
      }

      // Set Calibration
      if (this.calibrationFlag) {
        this.calibrationFlag = false;
        this.cx = x;
        this.cy = y;
      }

      // Set Input
      this.ix = x;
      this.iy = y;
    }
  };

  Parallax.prototype.onMouseMove = function(event) {

    // Cache mouse coordinates.
    var clientX = event.clientX;
    var clientY = event.clientY;

    // Calculate Mouse Input
    if (!this.orientationSupport && this.relativeInput) {

      // Clip mouse coordinates inside element bounds.
      if (this.clipRelativeInput) {
        clientX = Math.max(clientX, this.ex);
        clientX = Math.min(clientX, this.ex + this.ew);
        clientY = Math.max(clientY, this.ey);
        clientY = Math.min(clientY, this.ey + this.eh);
      }

      // Calculate input relative to the element.
      this.ix = (clientX - this.ex - this.ecx) / this.erx;
      this.iy = (clientY - this.ey - this.ecy) / this.ery;

    } else {

      // Calculate input relative to the window.
      this.ix = (clientX - this.wcx) / this.wrx;
      this.iy = (clientY - this.wcy) / this.wry;
    }
  };

  // Expose Parallax
  window[NAME] = Parallax;

})(window, document);

/**
 * Request Animation Frame Polyfill.
 * @author Tino Zijdel
 * @author Paul Irish
 * @see https://gist.github.com/paulirish/1579671
 */
;(function() {

  var lastTime = 0;
  var vendors = ['ms', 'moz', 'webkit', 'o'];

  for(var x = 0; x < vendors.length && !window.requestAnimationFrame; ++x) {
    window.requestAnimationFrame = window[vendors[x]+'RequestAnimationFrame'];
    window.cancelAnimationFrame = window[vendors[x]+'CancelAnimationFrame'] || window[vendors[x]+'CancelRequestAnimationFrame'];
  }

  if (!window.requestAnimationFrame) {
    window.requestAnimationFrame = function(callback, element) {
      var currTime = new Date().getTime();
      var timeToCall = Math.max(0, 16 - (currTime - lastTime));
      var id = window.setTimeout(function() { callback(currTime + timeToCall); },
        timeToCall);
      lastTime = currTime + timeToCall;
      return id;
    };
  }

  if (!window.cancelAnimationFrame) {
    window.cancelAnimationFrame = function(id) {
      clearTimeout(id);
    };
  }

}());
;/**
* Detect Element Resize
*
* https://github.com/sdecima/javascript-detect-element-resize
* Sebastian Decima
*
* version: 0.5.3
**/

(function () {
	var attachEvent = document.attachEvent,
		stylesCreated = false;
	
	if (!attachEvent) {
		var requestFrame = (function(){
			var raf = window.requestAnimationFrame || window.mozRequestAnimationFrame || window.webkitRequestAnimationFrame ||
								function(fn){ return window.setTimeout(fn, 20); };
			return function(fn){ return raf(fn); };
		})();
		
		var cancelFrame = (function(){
			var cancel = window.cancelAnimationFrame || window.mozCancelAnimationFrame || window.webkitCancelAnimationFrame ||
								   window.clearTimeout;
		  return function(id){ return cancel(id); };
		})();

		function resetTriggers(element){
			var triggers = element.__resizeTriggers__,
				expand = triggers.firstElementChild,
				contract = triggers.lastElementChild,
				expandChild = expand.firstElementChild;
			contract.scrollLeft = contract.scrollWidth;
			contract.scrollTop = contract.scrollHeight;
			expandChild.style.width = expand.offsetWidth + 1 + 'px';
			expandChild.style.height = expand.offsetHeight + 1 + 'px';
			expand.scrollLeft = expand.scrollWidth;
			expand.scrollTop = expand.scrollHeight;
		};

		function checkTriggers(element){
			return element.offsetWidth != element.__resizeLast__.width ||
						 element.offsetHeight != element.__resizeLast__.height;
		}
		
		function scrollListener(e){
			var element = this;
			resetTriggers(this);
			if (this.__resizeRAF__) cancelFrame(this.__resizeRAF__);
			this.__resizeRAF__ = requestFrame(function(){
				if (checkTriggers(element)) {
					element.__resizeLast__.width = element.offsetWidth;
					element.__resizeLast__.height = element.offsetHeight;
					element.__resizeListeners__.forEach(function(fn){
						fn.call(element, e);
					});
				}
			});
		};
		
		/* Detect CSS Animations support to detect element display/re-attach */
		var animation = false,
			animationstring = 'animation',
			keyframeprefix = '',
			animationstartevent = 'animationstart',
			domPrefixes = 'Webkit Moz O ms'.split(' '),
			startEvents = 'webkitAnimationStart animationstart oAnimationStart MSAnimationStart'.split(' '),
			pfx  = '';
		{
			var elm = document.createElement('fakeelement');
			if( elm.style.animationName !== undefined ) { animation = true; }    
			
			if( animation === false ) {
				for( var i = 0; i < domPrefixes.length; i++ ) {
					if( elm.style[ domPrefixes[i] + 'AnimationName' ] !== undefined ) {
						pfx = domPrefixes[ i ];
						animationstring = pfx + 'Animation';
						keyframeprefix = '-' + pfx.toLowerCase() + '-';
						animationstartevent = startEvents[ i ];
						animation = true;
						break;
					}
				}
			}
		}
		
		var animationName = 'resizeanim';
		var animationKeyframes = '@' + keyframeprefix + 'keyframes ' + animationName + ' { from { opacity: 0; } to { opacity: 0; } } ';
		var animationStyle = keyframeprefix + 'animation: 1ms ' + animationName + '; ';
	}
	
	function createStyles() {
		if (!stylesCreated) {
			//opacity:0 works around a chrome bug https://code.google.com/p/chromium/issues/detail?id=286360
			var css = (animationKeyframes ? animationKeyframes : '') +
					'.resize-triggers { ' + (animationStyle ? animationStyle : '') + 'visibility: hidden; opacity: 0; } ' +
					'.resize-triggers, .resize-triggers > div, .contract-trigger:before { content: \" \"; display: block; position: absolute; top: 0; left: 0; height: 100%; width: 100%; overflow: hidden; } .resize-triggers > div { background: #eee; overflow: auto; } .contract-trigger:before { width: 200%; height: 200%; }',
				head = document.head || document.getElementsByTagName('head')[0],
				style = document.createElement('style');
			
			style.type = 'text/css';
			if (style.styleSheet) {
				style.styleSheet.cssText = css;
			} else {
				style.appendChild(document.createTextNode(css));
			}

			head.appendChild(style);
			stylesCreated = true;
		}
	}
	
	window.addResizeListener = function(element, fn){
		if (attachEvent) element.attachEvent('onresize', fn);
		else {
			if (!element.__resizeTriggers__) {
				if (getComputedStyle(element).position == 'static') element.style.position = 'relative';
				createStyles();
				element.__resizeLast__ = {};
				element.__resizeListeners__ = [];
				(element.__resizeTriggers__ = document.createElement('div')).className = 'resize-triggers';
				element.__resizeTriggers__.innerHTML = '<div class="expand-trigger"><div></div></div>' +
																						'<div class="contract-trigger"></div>';
				element.appendChild(element.__resizeTriggers__);
				resetTriggers(element);
				element.addEventListener('scroll', scrollListener, true);
				
				/* Listen for a css animation to detect element display/re-attach */
				animationstartevent && element.__resizeTriggers__.addEventListener(animationstartevent, function(e) {
					if(e.animationName == animationName)
						resetTriggers(element);
				});
			}
			element.__resizeListeners__.push(fn);
		}
	};
	
	window.removeResizeListener = function(element, fn){
		if (attachEvent) element.detachEvent('onresize', fn);
		else {
			element.__resizeListeners__.splice(element.__resizeListeners__.indexOf(fn), 1);
			if (!element.__resizeListeners__.length) {
					element.removeEventListener('scroll', scrollListener);
					element.__resizeTriggers__ = !element.removeChild(element.__resizeTriggers__);
			}
		}
	}
})();