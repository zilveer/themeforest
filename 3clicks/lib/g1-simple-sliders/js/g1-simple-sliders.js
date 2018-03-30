/* global jQuery */
/* global G1 */
/* global Galleria */

(function ($, globalContext, themeContext) {
    "use strict";

    var helpers = {};
    var handlers = {};
    var classes = {};
    var factoryMethods = {};

    $(window).load(function () {
        $('.g1-simple-slider, .g1-mediabox--slider').each(function() {
            var $slider = $(this);
            var configObj = $slider.metadata( { type: 'attr', name: 'data-config' });
            var sliderHandlerFuncName = configObj.layout + 'Slider';

            var handler = helpers.getSliderHandler(sliderHandlerFuncName);

            if (handler) {
                handler($slider, configObj);
            } else {
                throw 'Handler "'+ sliderHandlerFuncName +'" does not exist!';
            }
        });
    });

    helpers.getSliderHandler = function (funcName) {
        var customHandlers = themeContext.simpleSliders.customHandlers;

        if (customHandlers && customHandlers[funcName]) {
            var customHandler = customHandlers[funcName];

            switch (typeof customHandler) {
                case 'function':
                    return customHandler;

                case 'string':
                    funcName = customHandler;
                    break;
            }
        }

        if (handlers[funcName]) {
            return handlers[funcName];
        }

        return null;
    };

    factoryMethods.createCoinNav = function (type, $sliderContainer, options) {
        // standard nav will be displayed as thumbs, style will be applied via css instrad of building coins via js
        if (type === 'standard') {
            type = 'thumbs';
        }

        var navClassName = type + 'CoinNav';

        if (typeof classes[navClassName] !== 'undefined') {
            var args = {
                'sliderContainer': $sliderContainer,
                'containerClass': 'g1-nav-coin',
                'selectedItemClass': 'g1-selected'
            };

            if (typeof options.container !== 'undefined') {
                args.container = options.container;
            }

            if (typeof options.itemSelectionHandler !== 'undefined') {
                args.itemSelectionHandler = options.itemSelectionHandler;
            }

            return classes[navClassName](args);
        }

        return null;
    };

    factoryMethods.createDirectionNav = function (type, $sliderContainer) {
        var navClassName = type + 'DirectionNav';

        if (typeof classes[navClassName] !== 'undefined') {
            var args = {
                'sliderContainer': $sliderContainer,
                'containerClass': 'g1-nav-direction',
                'prevClass': 'g1-nav-direction__prev',
                'nextClass': 'g1-nav-direction__next',
                'selectedItemClass': 'g1-selected'
            };

            return classes[navClassName](args);
        }

        return null;
    };

    factoryMethods.createFullscreenButton = function (type, $sliderContainer) {
        var fullscreenClassName = type + 'FullscreenButton';

        if (typeof classes[fullscreenClassName] !== 'undefined') {
            var args = {
                'sliderContainer': $sliderContainer,
                'containerClass': 'g1-fullscreen',
                'buttonLabel': 'Enter fullscreen'
            };

            return classes[fullscreenClassName](args);
        }

        return null;
    };

    factoryMethods.createProgressBar = function (type, $sliderContainer) {
        var className = type + 'ProgressBar';

        if (typeof classes[className] !== 'undefined') {
            var args = {
                'sliderContainer': $sliderContainer,
                'containerClass': 'g1-progress'
            };

            return classes[className](args);
        }

        return null;
    };

    factoryMethods.createSlider = function ($context, config, options) {
        var args = {
            'context': $context,
            'config': config,
            'selector': '.g1-slides',
            'slideSelector': 'li',
            'selectedSlideSelector': '.g1-selected',
            'options': options ? options : {}
        };

        return classes.slider(args);
    };

    classes.standardFullscreenButton = function (args) {
        // private
        var that = {};
        var $container;
        var $button;
        var offset;

        var init = function () {
            offset = 0;
            buildButton();
            handleClickEvent();
        };

        var handleClickEvent = function () {
            $button.click(function(e) {
                e.preventDefault();

                var data = [];

                var $slides = args.sliderContainer.find('li');

                $slides.each(function() {
                    var imagePath = $(this).find('img').attr('src');
                    var title = $(this).find('figcaption p').html();
                    var caption = $(this).find('figcaption div').html();

                    if (imagePath) {
                        data.push({
                            'image': imagePath,
                            'title': title ? title : '',
                            'description': caption ? caption : ''
                        });
                    }
                });

                if (data.length > 0) {
                    Galleria.configure({
                        wait: true
                    });

                    $('#galleria').remove();
                    var $wrapper = $('<div id="galleria" style="height: '+ $(window).height() +'px;">');
                    $('body').prepend($wrapper);

                    data = addOffset(data, getOffset());

                    Galleria.run('#galleria', {
                        dataSource: data
                    });

                    Galleria.ready(function() {
                        var gallery = this;

                        gallery.addElement('exit').appendChild('container','exit');

                        var btn = this.$('exit').html('<a href="#" class="galleria-exit-button"></a>');

                        btn.click(function(e) {
                            e.preventDefault();
                            gallery.exitFullscreen();
                            $wrapper.hide();
                        });
                    });

                    var galleria = $('#galleria').data('galleria');

                    galleria.bind('fullscreen_exit', function() {
                        $wrapper.hide();
                    });

                    galleria.enterFullscreen();
                }
            });
        };

        var addOffset = function (data, offset) {
            var i,temp;

            if (offset !== 0) {
                if (offset > 0) {
                    for (i = 0; i < offset; i++) {
                        temp = data.pop();
                        data.unshift(temp);
                    }
                } else {
                    offset *= -1;

                    for (i = 0; i < offset; i++) {
                        temp = data.shift();
                        data.push(temp);
                    }
                }
            }

            return data;
        };

        var buildButton = function () {
            $container = $('<div>').addClass(args.containerClass);
            $button = $('<a>').text(args.buttonLabel);
            $container.append($button);
        };

        var getContainer = function () {
            return $container;
        };

        var getOffset = function () {
            return offset;
        };

        var setOffset = function (value) {
            offset = value;
        };

        var getType = function () {
            return 'standard';
        };

        init();

        // public
        that.getType = getType;
        that.getContainer = getContainer;
        that.getOffset = getOffset;
        that.setOffset = setOffset;

        return that;
    };

    classes.noneFullscreenButton = function () {
        // private
        var that = {};

        that.getType = function () { return 'none'; };
        that.getContainer = function () { return $(); };
        that.getOffset = function () { return 0; };
        that.setOffset = function () {};

        return that;
    };

    classes.standardProgressBar = function (args) {
        // private
        var that = {};
        var $container;
        var $progressBar;

        var init = function () {
            buildProgressBar();
        };

        var buildProgressBar = function () {
            $container = $('<div>').addClass(args.containerClass);
            $progressBar = $('<div>');
            $container.append($('<div>').append($progressBar));
        };

        var getContainer = function () {
            return $container;
        };

        var update = function (percentage) {
            $progressBar.css('width', percentage + '%');
        };

        var getType = function () {
            return 'standard';
        };

        init();

        // public
        that.getType = getType;
        that.getContainer = getContainer;
        that.update = update;

        return that;
    };

    classes.noneProgressBar = function () {
        // private
        var that = {};

        // public
        that.getType = function () { return 'none'; };
        that.getContainer = function () { return $(); };
        that.update = function () {};

        return that;
    };

    classes.slider = function (args) {
        // private
        var that = {};
        var $context;
        var config;
        var $container;
        var coinNavigation;
        var directionNavigation;
        var fullscreen;
        var progressBar;
        var slidesOffset;

        var init = function () {


            $context = args.context;
            config = args.config;
            slidesOffset = typeof args.options.slidesOffset !== 'undefined' ? args.options.slidesOffset : 0;

            $container = $(args.selector, $context);

            assignIndexToEachSlide();
            storeOriginalSlider();

            buildSlider();
            handleSliderPauseOnMouseHover();
            handleSlideLightboxLinkingMethod();
        };

        var storeOriginalSlider = function () {
            $context.data('g1_original_slider', $context.clone(true, true));
        };

        var getOriginalSlider = function () {
            return $context.data('g1_original_slider');
        };

        var buildSlider = function () {
            directionNavigation = createDirectionNavigation();
            coinNavigation = createCoinNavigation();
            fullscreen = createFullscreenButton();
            progressBar = createProgressBar();

            var $toolbar = $('<div class="g1-toolbar" />');

            $toolbar.append(directionNavigation.getContainer());
            $toolbar.append(coinNavigation.getContainer());
            $toolbar.append(fullscreen.getContainer());
            $toolbar.append(progressBar.getContainer());

            $container.after($toolbar.wrapInner('<div class="g1-inner" />'));

            $context.toggleClass('g1-slider-ready g1-slider-not-ready');
        };

        var assignIndexToEachSlide = function () {
            getSlides().each(function(i) {
                $(this).data('index', i);
            });
        };

        var handleSliderPauseOnMouseHover = function () {
            getSlides().mouseover(function () {
                var stopImmediately = false;
                var resumeTimeoutCounting = true;

                getContainer().trigger('pause', [stopImmediately, resumeTimeoutCounting]);
            });

            getSlides().mouseout(function () {
                getContainer().trigger('resume');
            });
        };

        var handleSlideLightboxLinkingMethod = function () {
            var $slides = getSlides().filter('[data-g1-linking="lightbox"]');
            var buildLighboxItem = function (link, title) {
                var item;
                var isVideo = (link.indexOf('youtube') !== -1) || (link.indexOf('youtube') !== -1);

                if (isVideo) {
                    item = {
                        src: link,
                        type: 'iframe'
                    };
                } else { // image
                    item = {
                        src: link,
                        type: 'image'
                    };
                }

                if (title && title.length > 0) {
                    item.title = title;
                }

                return item;
            };

            $slides.click(function (e) {
                e.preventDefault();

                var lightboxItems = [];
                var index = 0;

                $slides.each(function(i) {
                    if ($(this).is('.g1-selected')) {
                        index = i;
                    }

                    var link = $(this).find('a').attr('href');
                    var title = $(this).find('figcaption > div:first').html();

                    lightboxItems.push(buildLighboxItem(link, title));
                });

                if (lightboxItems.length > 0) {
                    $.magnificPopup.open({
                        'items': lightboxItems,
                        gallery: {
                            enabled: true
                        },
                        type: 'image'
                    }, index);
                }
            });
        };

        var createCoinNavigation = function () {
            var options = {};
            var $container = $context.find('.g1-nav-coin');

            // coin nav was found in markup
            if ($container.length > 0) {
                options.container = $container;
            }

            if (typeof args.options.coinNavigationItemSelectionHandler !== 'undefined') {
                options.itemSelectionHandler = args.options.coinNavigationItemSelectionHandler;
            }

            coinNavigation = factoryMethods.createCoinNav(config.coinNavigation, getContainer(), options);
            coinNavigation.setOffset(getSlidesOffset());

            return coinNavigation;
        };

        var createDirectionNavigation = function () {
            directionNavigation = factoryMethods.createDirectionNav(config.directionNavigation, getContainer());

            return directionNavigation;
        };

        var createFullscreenButton = function () {
            fullscreen = factoryMethods.createFullscreenButton(config.fullscreen, getContainer());
            fullscreen.setOffset(getSlidesOffset());

            return fullscreen;
        };

        var createProgressBar = function () {
            progressBar = factoryMethods.createProgressBar(config.progressBar, getContainer());

            return progressBar;
        };

        var isFullyVisible = function (width) {
            var threshold = parseInt(config.width_in_px, 10);

            width = width || $(window).width();

            return width > threshold;
        };

        var getContainer = function () {
            return $container;
        };

        var getSlides = function () {
            return getContainer().find(args.slideSelector);
        };

        var getSelectedSlide = function () {
            return getSlides().filter(args.selectedSlideSelector);
        };

        var getCoinNavigation = function () {
            return coinNavigation;
        };

        var getDirectionNavigation = function () {
            return directionNavigation;
        };

        var getFullscreen = function () {
            return fullscreen;
        };

        var getProgressBar = function () {
            return progressBar;
        };

        var getSlidesOffset = function () {
            return slidesOffset;
        };

        var getConfig = function () {
            return config;
        };

        var getContext = function () {
            return $context;
        };

        init();

        // public
        that.getContext = getContext;
        that.getContainer = getContainer;
        that.getConfig = getConfig;
        that.getSlides = getSlides;
        that.getSelectedSlide = getSelectedSlide;
        that.getCoinNavigation = getCoinNavigation;
        that.getDirectionNavigation = getDirectionNavigation;
        that.getFullscreen = getFullscreen;
        that.getProgressBar = getProgressBar;
        that.getSlidesOffset = getSlidesOffset;
        that.getOriginalSlider = getOriginalSlider;
        that.isFullyVisible = isFullyVisible;

        return that;
    };

    classes.thumbsCoinNav = function (args) {
        // private
        var that = {};
        var $container;
        var offset;
        var itemSelectionHandler;

        // pseud constructor
        var init = function () {
            if (typeof args.container !== 'undefined') {
                $container = args.container;
            }

            // item selection handler
            if (typeof args.itemSelectionHandler !== 'undefined') {
                itemSelectionHandler = args.itemSelectionHandler;
            }

            offset = 0;

            buildNav();
        };

        var buildNav = function () {
            if (!$container) {
                $container = $('<ol>').addClass(args.containerClass);

                args.sliderContainer.find('img').each(function() {
                    var $img = $(this).clone();

                    var $navItem = $('<li>');
                    $navItem.append($('<a>').append($img));

                    $container.append($navItem);
                });
            }

            assignIndexToEachItem();
            handleItemSelection();
        };

        var assignIndexToEachItem = function () {
            getItems().each(function (i) {
                $(this).data('index', i);
            });
        };

        var handleItemSelection = function () {
            var $items = getItems();

            $items.each(function() {
                $(this).click(function(e) {
                    e.preventDefault();

                    if (itemSelectionHandler) {
                        itemSelectionHandler({
                            sliderContainer: args.sliderContainer,
                            slideTo: getOffset() + $items.index($(this))
                        });
                    } else {
                        args.sliderContainer.trigger('slideTo', getOffset() + $items.index($(this)));
                    }
                });
            });
        };

        var getContainer = function () {
            return $container;
        };

        var getItems = function () {
            return getContainer().find('li');
        };

        var getItem = function (index) {
            return getItems().eq(index);
        };

        /**
         * @param item  Item index or jQuery object
         */
        var selectItem = function (item) {
            var selectedClassName = args.selectedItemClass;

            getItems().removeClass(selectedClassName);
            var $item = item;

            if (typeof $item === 'number') {
                $item = getItem(item);
            }

            $item.addClass(selectedClassName);
        };

        var setOffset = function (value) {
            offset = value;
        };

        var getOffset = function () {
            return offset;
        };

        var getType = function () {
            return 'thumbs';
        };

        init();

        // public
        that.getType = getType;
        that.getContainer = getContainer;
        that.getItems = getItems;
        that.getItem = getItem;
        that.selectItem = selectItem;
        that.getOffset = getOffset;
        that.setOffset = setOffset;

        return that;
    };

    classes.standardCoinNav = function (args) {
        // private
        var that = {};
        var $container;
        var offset;
        var itemSelectionHandler;

        // pseud constructor
        var init = function () {
            if (typeof args.itemSelectionHandler !== 'undefined') {
                itemSelectionHandler = args.itemSelectionHandler;
            }

            offset = 0;

            buildNav();
        };

        var buildNav = function () {
            $container = $('<ol>').addClass(args.containerClass);

            args.sliderContainer.find('img').each(function(i) {
                var $navItem = $('<li>');
                $navItem.data('index', i);
                $navItem.append($('<a>').text(i + 1));

                $container.append($navItem);
            });

            handleItemSelection();
        };

        var handleItemSelection = function () {
            var $items = getItems();

            $items.each(function() {
                $(this).click(function(e) {
                    e.preventDefault();

                    if (itemSelectionHandler) {
                        itemSelectionHandler({
                            sliderContainer: args.sliderContainer,
                            slideTo: getOffset() + $items.index($(this))
                        });
                    } else {
                        args.sliderContainer.trigger('slideTo', getOffset() + $items.index($(this)));
                    }
                });
            });
        };

        var getContainer = function () {
            return $container;
        };

        var getItems = function () {
            return getContainer().find('li');
        };

        var getItem = function (index) {
            return getItems().eq(index);
        };

        /**
         * @param item  Item index or jQuery object
         */
        var selectItem = function (item) {
            var selectedClassName = args.selectedItemClass;

            getItems().removeClass(selectedClassName);
            var $item = item;

            if (typeof $item === 'number') {
                $item = getItem(item);
            }

            $item.addClass(selectedClassName);
        };

        var setOffset = function (value) {
            offset = value;
        };

        var getOffset = function () {
            return offset;
        };

        var getType = function () {
            return 'standard';
        };

        init();

        // public
        that.getType = getType;
        that.getContainer = getContainer;
        that.getItems = getItems;
        that.getItem = getItem;
        that.selectItem = selectItem;
        that.getOffset = getOffset;
        that.setOffset = setOffset;

        return that;
    };

    classes.noneCoinNav = function () {
        // private
        var that = {};

        // public
        that.getType = function () { return 'none'; };
        that.getContainer = function () { return $(); };
        that.getItems = function () { return $(); };
        that.getItem = function () { return $(); };
        that.selectItem = function () {};
        that.getOffset = function () { return 0; };
        that.setOffset = function () {};

        return that;
    };

    classes.standardDirectionNav = function (args) {
        // private
        var that = {};
        var $container;
        var $prev;
        var $next;

        // pseud constructor
        var init = function () {
            buildNav();
        };

        var buildNav = function () {
            $container = $('<div>').addClass(args.containerClass);

            $prev = $('<a href="#">prev</a>').addClass(args.prevClass);
            $next = $('<a href="#">next</a>').addClass(args.nextClass);

            $container.
                append($prev).
                append($next);
        };

        var getContainer = function () {
            return $container;
        };

        var getPrev = function () {
            return $prev;
        };

        var getNext = function () {
            return $next;
        };

        var getPrevKey = function () {
            return 'left';
        };

        var getNextKey = function () {
            return 'right';
        };

        var getType = function () {
            return 'standard';
        };

        init();

        // public
        that.getType = getType;
        that.getContainer = getContainer;
        that.getPrev = getPrev;
        that.getNext = getNext;
        that.getPrevKey = getPrevKey;
        that.getNextKey = getNextKey;

        return that;
    };

    classes.noneDirectionNav = function () {
        // private
        var that = {};

        // public
        that.getType = function () { return 'none'; };
        that.getContainer = function () { return $(); };
        that.getPrev = function () { return $(); };
        that.getNext = function () { return $(); };
        that.getPrevKey = function () { return null; };
        that.getNextKey = function () { return null; };

        return that;
    };

    classes.carouFredSelConfig = function (args) {
        // private
        var that = {};
        var config;
        var sliderConfig;
        var slider;
        var coinNav;
        var directionNav;
        var progressBar;
        var selectedSlideIndex;

        var init = function () {
            slider =  args.slider;
            sliderConfig =  slider.getConfig();
            coinNav = slider.getCoinNavigation();
            directionNav = slider.getDirectionNavigation();
            progressBar = slider.getProgressBar();
            selectedSlideIndex = 0 - slider.getSlidesOffset();

            buildConfig();
        };

        var doAction = function (actionName, data, options) {
            if (typeof config[actionName] === 'function') {
                config[actionName](data, options);
            }
        };

        var getCurrentSlide = function (data, selectedSlideIndex) {
            if (typeof data.items.visible[selectedSlideIndex] !== 'undefined') {
                return data.items.visible.eq(selectedSlideIndex);
            } else {
                return data.items.visible;
            }
        };

        var buildConfig = function () {
            config = {
                responsive: true,
                width:'100%',
                height:'variable',
                items: {
                    visible: 1,
                    start: slider.getSlidesOffset()
                },
                swipe: {
                    onTouch     : true,
                    onMouse     : false
                },
                scroll: {
                    items: 1,
                    onBefore: function (data) {
                        var options = {
                            'selectedSlideIndex': selectedSlideIndex
                        };

                        doAction('scroll_onBefore_start', data, options);

                        slider.getContext().addClass('g1-transition');

                        var $currentSlide = getCurrentSlide(data, selectedSlideIndex);

                        if ($currentSlide.length > 0) {
                            slider.getSlides().removeClass('g1-selected');
                            $currentSlide.addClass('g1-selected');

                            coinNav.selectItem($currentSlide.data('index'));
                        }

                        doAction('scroll_onBefore_end', data, options);
                    },
                    onAfter: function (data) {
                        var options = {
                            'selectedSlideIndex': selectedSlideIndex
                        };

                        doAction('scroll_onAfter_start', data, options);

                        slider.getContext().removeClass('g1-transition');

                        doAction('scroll_onAfter_end', data, options);
                    }
                },
                prev: {
                    button: directionNav.getPrev(),
                    key: directionNav.getPrevKey()
                },
                next: {
                    button: directionNav.getNext(),
                    key: directionNav.getNextKey()
                },
                onCreate: function (data) {
                    doAction('onCreate_start', data);
                    coinNav.selectItem(0);
                    doAction('onCreate_end', data);
                }
            };

            setUpAutoParam();                   // pause time
            setUpDirectionAndScrollFxParam();   // transition
            setUpScrollDurationParam();         // transition speed
        };

        var setUpAutoParam = function () {
            config.auto = {
                play: (sliderConfig.autoplay !== 'none'),
                timeoutDuration: sliderConfig.slideshowSpeed ? parseInt(sliderConfig.slideshowSpeed, 10): 0
            };

            if (sliderConfig.progressBar !== 'none') {
                config.auto.progress = {
                    'bar':      progressBar.getContainer(),
                    'updater':  progressBar.update,
                    'interval': 50
                };
            }
        };

        var setUpDirectionAndScrollFxParam = function () {
            var animation = sliderConfig.animation ? sliderConfig.animation : 'fade';

            switch (animation) {
                case 'fade':
                    config.scroll.fx = 'crossfade';
                    break;

                case 'slide_up':
                    config.direction = 'up';
                    config.scroll.fx = 'scroll';
                    break;

                case 'slide_down':
                    config.direction = 'down';
                    config.scroll.fx = 'scroll';
                    break;

                case 'slide_left':
                    config.direction = 'left';
                    config.scroll.fx = 'scroll';
                    break;

                case 'slide_right':
                    config.direction = 'right';
                    config.scroll.fx = 'scroll';
                    break;
            }
        };

        var setUpScrollDurationParam = function () {
            config.scroll.duration = sliderConfig.animationDuration ? parseInt(sliderConfig.animationDuration, 10) : 0;
        };

        var getJson = function () {
            return config;
        };

        init();

        // public
        that.getJson = getJson;

        return that;
    };

    handlers.simpleSlider = function ($slider, configObj) {
        var slider = factoryMethods.createSlider($slider, configObj);
        var $sliderContainer = slider.getContainer();

        var config = classes.carouFredSelConfig({
            'slider': slider
        });

        var mainSliderConfig = config.getJson();

        var $firstImg = slider.getSlides().find('img:first');
        var width = $firstImg.prop('width');
        var height = $firstImg.prop('height');
        height = Math.round(height/width * 100) + '%';

        mainSliderConfig.items.width = width;
        mainSliderConfig.items.height = height;
        mainSliderConfig.scroll.easing = 'easeInOutExpo';

        var pluginOptions = {
            wrapper: {
                element: 'div',
                classname:'g1-carousel'
            }
        };

        // store data in DOM element
        $slider.data('g1_simple_slider', slider);

        // handle main slider
        $sliderContainer.carouFredSel(mainSliderConfig, pluginOptions);

        slider.getContainer().after(slider.getDirectionNavigation().getContainer(), slider.getProgressBar().getContainer());
    };

    handlers.relaySlider = function ($slider, configObj) {
        var options = {
            coinNavigationItemSelectionHandler: coinNavSelectItem
        };

        var slider = factoryMethods.createSlider($slider, configObj, options);
        var $sliderContainer = slider.getContainer();

        var $leftSlider = $slider.find('.g1-slides').clone();
        var $rightSlider = $slider.find('.g1-slides').clone();

        $leftSlider.prependTo($slider.find('> .g1-inner'));
        $rightSlider.appendTo($slider.find('> .g1-inner'));


        var config = classes.carouFredSelConfig({
            'slider': slider
        });

        /* ===============
         * main slider
         /* =============== */
        var mainSliderConfig = config.getJson();

        // change config
        mainSliderConfig.auto.play = false;
        mainSliderConfig.next = null;
        mainSliderConfig.prev = null;

        mainSliderConfig.scroll.duration = mainSliderConfig.scroll.duration/2;

        var leftEasing = 'linear';
        var centerEasing = 'linear';
        var rightEasing = 'linear';

        mainSliderConfig.auto.easing = centerEasing;
        mainSliderConfig.scroll.easing = centerEasing;


        // synchronise carousels
        var carouselDelay = mainSliderConfig.scroll.duration/2;

        var $prev = slider.getDirectionNavigation().getPrev();
        var $next = slider.getDirectionNavigation().getNext();

        $prev.click(function (e) {
            e.preventDefault();

            $leftSlider.trigger('prev');

            setTimeout(function() {
                $sliderContainer.trigger('prev');
            }, carouselDelay);

            setTimeout(function() {
                $rightSlider.trigger('prev');
            }, 2 * carouselDelay);
        });

        $next.click(function (e) {
            e.preventDefault();

            $rightSlider.trigger('next');

            setTimeout(function() {
                $sliderContainer.trigger('next');
            }, carouselDelay);

            setTimeout(function() {
                $leftSlider.trigger('next');
            }, 2 * carouselDelay);
        });

        var pluginOptions = {
            wrapper: {
                element: 'div',
                classname:'g1-carousel'
            }
        };

        // store data in DOM element
        $slider.data('g1_simple_slider', slider);

        $sliderContainer.carouFredSel(mainSliderConfig, pluginOptions);
        slider.getContainer().after(slider.getDirectionNavigation().getContainer(), slider.getProgressBar().getContainer());
        $sliderContainer.parent().wrap('<div class="g1-carousel-center"></div>');

        // coin nav selection
        function coinNavSelectItem (args) {
            var nextSlide = args.slideTo;

            $rightSlider.trigger('slideTo', nextSlide);

            setTimeout(function() {
                $sliderContainer.trigger('slideTo', nextSlide);
            }, carouselDelay);

            setTimeout(function() {
                $leftSlider.trigger('slideTo', nextSlide);
            }, 2 * carouselDelay);
        }

        // auto play
        var autoplay = configObj.autoplay === 'standard';
        var pause = false;

        $sliderContainer.mouseover(function () {
            pause = true;
        });

        $sliderContainer.mouseout(function () {
            pause = false;
        });

        if (autoplay) {
            var slideshowSpeed = parseInt(configObj.slideshowSpeed, 10);

            var showNextSlide = function() {
                var isScrolling;
                $sliderContainer.trigger('isScrolling', function(scrolling) { isScrolling = scrolling; });

                if (!isScrolling && !pause) {
                    $next.trigger('click');

                    var $progressBarContainer = slider.getProgressBar().getContainer();
                    var progressBar = $progressBarContainer.find('> div > div');
                    progressBar.css('width', '0');
                    progressBar.animate({
                        width: '100%'
                    }, slideshowSpeed - 10, 'linear');
                }

                setTimeout(showNextSlide, slideshowSpeed);
            };

            setTimeout(showNextSlide, slideshowSpeed);
        }

        /* ===============
         * left slider
         /* =============== */
        $leftSlider.find('> li:last').prependTo($leftSlider);

        var leftSliderConfig = {
            responsive:true,
            width:'80%',
            height:'variable',
            auto: {
                play: false,
                easing: leftEasing
            },
            direction: mainSliderConfig.direction,
            scroll: {
                //fx: mainSliderConfig.scroll.fx,
                fx: 'cover',
                easing: leftEasing,
                duration: mainSliderConfig.scroll.duration
            }
        };

        $leftSlider.carouFredSel(leftSliderConfig, pluginOptions);
        $leftSlider.parent().wrap('<div class="g1-carousel-left"></div>');

        /* ===============
         * right slider
         /* =============== */
        $rightSlider.find('> li:first').appendTo($rightSlider);

        var rightSliderConfig = {
            responsive: true,
            width:'80%',
            height:'variable',
            auto: {
                play: false,
                easing: rightEasing
            },
            direction: mainSliderConfig.direction,
            scroll: {
                //fx: mainSliderConfig.scroll.fx,
                fx: 'uncover',
                easing: rightEasing,
                duration: mainSliderConfig.scroll.duration
            }
        };

        $rightSlider.carouFredSel(rightSliderConfig, pluginOptions);
        $rightSlider.parent().wrap('<div class="g1-carousel-right"></div>');
    };

    handlers.viewportSlider = function ($slider, configObj) {
        var options = {
            'slidesOffset': -1
        };
        var log = function (content) { if (typeof console !== 'undefined') { console.log(content); } };
        var slider = factoryMethods.createSlider($slider, configObj, options);
        var $sliderContainer = slider.getContainer();
        var config = classes.carouFredSelConfig({
            'slider':       slider
        });

        var mainSliderConfig = config.getJson();

        mainSliderConfig.items.visible = 3;
        mainSliderConfig.scroll.easing = 'easeInOutExpo';
        mainSliderConfig.responsive = false;

        // store data in DOM element
        $slider.data('g1_simple_slider', slider);

        var pluginOptions = {
            wrapper: {
                element: 'div',
                classname:'g1-carousel'
            }
        };

        // store data in DOM element
        $slider.data('g1_simple_slider', slider);

        // handle main slider
        $sliderContainer.carouFredSel(mainSliderConfig, pluginOptions);
        log(mainSliderConfig);
        log(pluginOptions);

        // move direction nav after slides container
        slider.getContainer().after(slider.getDirectionNavigation().getContainer(), slider.getProgressBar().getContainer());
    };

    handlers.standoutSlider = function ($slider, configObj) {
        var options = {
            'slidesOffset': -1
        };

        var slider = factoryMethods.createSlider($slider, configObj, options);
        var $sliderContainer = slider.getContainer();

        var config = classes.carouFredSelConfig({
            'slider':       slider
        });

        var mainSliderConfig = config.getJson();

        var $firstImg = slider.getSlides().find('img:first');
        var width = $firstImg.width();
        var height = $firstImg.height();
        var scale = 2;

        var marginVertical = Math.round((height - height/scale)/2);

        var defaultCss = {
            'width': Math.round(width/scale),
            'height': Math.round(height/scale),
            marginTop:marginVertical,
            marginRight:0,
            marginLeft:0,
            opacity: 0.5
        };
        var selectedCss = {
            'width': width,
            'height': height,
            marginTop: 0,
            marginRight:0,
            marginLeft:0,
            opacity: 1
        };
        var aniOpts = {
            queue: false,
            duration: 1000, // tyle samo co czas transition
            easing: 'easeInOutCirc'
        };

        $sliderContainer.find('img:gt(0)').css('zIndex', 1).css( defaultCss );
        $sliderContainer.find('img:eq(0)').css('zIndex', 2).css( selectedCss );

        mainSliderConfig.items.visible = 3;
        mainSliderConfig.scroll.easing = 'easeInOutCirc';
        mainSliderConfig.responsive = false;

        // store data in DOM element
        $slider.data('g1_simple_slider', slider);

        mainSliderConfig.scroll_onBefore_start = function( data ) {
            data.items.old.eq(1).find('img').css('zIndex', 1).animate( defaultCss, aniOpts );
            data.items.visible.eq(1).find('img').css('zIndex', 2).animate( selectedCss, aniOpts );
        };

        mainSliderConfig.scroll_onAfter_start = function() {
            //$sliderContainer.trigger('updateSizes');
        };

        var pluginOptions = {
            wrapper: {
                element: 'div',
                classname:'g1-carousel'
            }
        };

        mainSliderConfig.height = 'auto';

        // handle main slider
        $sliderContainer.carouFredSel(mainSliderConfig, pluginOptions);
        slider.getContainer().after(slider.getDirectionNavigation().getContainer(), slider.getProgressBar().getContainer());
    };

    handlers.kenburnsSlider = function ($slider, configObj) {
        var slider = factoryMethods.createSlider($slider, configObj);
        var $sliderContainer = slider.getContainer();

        var config = classes.carouFredSelConfig({
            'slider':       slider
        });

        var mainSliderConfig = config.getJson();

        var $firstImg = slider.getSlides().find('img:first');
        var width = $firstImg.prop('width');
        var height = $firstImg.prop('height');
        height = Math.round(height/width * 100) + '%';

        mainSliderConfig.items.width = width;
        mainSliderConfig.items.height = height;

        var dur = mainSliderConfig.scroll.duration;
        var pDur = 3 * dur;

        mainSliderConfig.scroll_onBefore_start = function( data ) {
            animate( data.items.visible, pDur + ( dur * 3 ) );
        };

        mainSliderConfig.scroll_onAfter_start = function( data ) {
            data.items.old.find( 'img' ).each(function(){
                var $this = $(this);

                $this.stop();
                $this.css({
                    width:'auto',
                    height:'auto',
                    marginTop: 0,
                    marginLeft: 0
                });
            });
        };

        mainSliderConfig.onCreate_start = function( data ) {
            animate( data.items, pDur + ( dur *2 ) );
        };

        var pluginOptions = {
            wrapper: {
                element: 'div',
                classname:'g1-carousel'
            }
        };

        // handle main slider
        $sliderContainer.carouFredSel(mainSliderConfig, pluginOptions);
        slider.getContainer().after(slider.getDirectionNavigation().getContainer(), slider.getProgressBar().getContainer());

        function animate( item, dur ) {
            var $img = item.find('img');
            var width = $img.prop('width');
            var height = $img.prop('height');

            var obj = {
                width:width * 1.2,
                height:height * 1.2
            };
            switch( Math.ceil( Math.random() * 2 ) ) {
                case 1:
                    obj.marginTop = 0;
                    break;
                case 2:
                    obj.marginTop = -height * 0.2;
                    break;
            }
            switch( Math.ceil( Math.random() * 2 ) ) {
                case 1:
                    obj.marginLeft = 0;
                    break;
                case 2:
                    obj.marginLeft = -width * 0.2;
                    break;
            }
            item.find( 'img' ).animate(obj, dur, 'linear' );
        }
    };

    // expose to public scope
    if (typeof themeContext.simpleSliders === 'undefined') {
        themeContext.simpleSliders = {};
    }

    themeContext.simpleSliders.handlers = handlers;
    themeContext.simpleSliders.helpers = helpers;
})(jQuery, window, G1.theme);
