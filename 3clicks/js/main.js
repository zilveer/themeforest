/* global jQuery */
/* global skrollr */
/* global Modernizr */

/* -------------------------------------------
 * 
 * 3Clicks javascript code is splitted into 2 sections:
 * 1) core functions ("G1 Core" section) - you shouldn't modify them
 * 2) theme related functions ("G1 Main" section)
 * 
 * If you want to start modyfing our code, you should
 * look at "G1 Main" section. Some functions are invoked
 * when document is ready and some need to be launched
 * later, when all window elements are loaded.
 *
 * If you want to add your custom functions, please
 * add theme using our "modifications.js" script.
 * It's located in 3clicks-child-theme folder.
 * 
 --------------------------------------------- */

/* =================== */
/* G1 core */
/* =================== */
/*jshint unused:false, undef:false */


/* =================================== */
/* G1 JavaScript additional functions */
/* =================================== */

// ====== global functions extending language capabilities ====== //
/**
 *  is_string
 */
if (typeof is_string !== 'function') {
    var is_string = function(value) {
        "use strict";

        return typeof value === 'string';
    };
}

/**
 * is_array
 */
if (typeof is_array !== 'function') {
    var is_array = function(value) {
        "use strict";

        return value &&
            typeof value === 'object' &&
            typeof value.length === 'number' &&
            typeof value.splice === 'function' &&
            !(value.propertyIsEnumerable('length'));
    };
}

/**
 * create_cookie
 */
if (typeof create_cookie !== 'function') {
    var create_cookie = function(name,value,days) {
        "use strict";

        var expires;

        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days*24*60*60*1000));
            expires = '; expires=' + date.toGMTString();
        }
        else {
            expires = '';
        }

        document.cookie = name + '=' + value + expires + '; path=/';
    };
}

/**
 * read_cookie
 */
if (typeof read_cookie !== 'function') {
    var read_cookie = function(name) {
        "use strict";

        var nameEQ = name + '=';
        var ca = document.cookie.split(';');

        for(var i = 0; i < ca.length; i += 1) {
            var c = ca[i];
            while (c.charAt(0) === ' ') {
                c = c.substring(1,c.length);
            }

            if (c.indexOf(nameEQ) === 0) {
                return c.substring(nameEQ.length,c.length);
            }
        }

        return null;
    };
}

/**
 * rgb2hex
 */
if (typeof rgb2hex !== 'function') {
    var rgb2hex = function (rgb) {
        "use strict";

        if (  rgb.search("rgb") === -1 ) {
            return rgb;
        } else {
            rgb = rgb.match(/^rgba?\((\d+),\s*(\d+),\s*(\d+)(?:,\s*(\d+))?\)$/);
            var hex = function (x) {
                return ("0" + parseInt(x, 10).toString(16)).slice(-2);
            };
            return "#" + hex(rgb[1]) + hex(rgb[2]) + hex(rgb[3]);
        }
    };
}

/**
 * strpad
 */
if (typeof strpad !== 'function') {
    var strpad = function(input, padLength, padString, padType) {
        "use strict";

        padString = typeof padString !== 'undefined' ? padString : ' ';
        padType = typeof padType !== 'undefined' ? padType : 'right';

        if (padLength > input.length) {
            for (var i = 0; i < (padLength - input.length); i += 1) {
                switch (padType) {
                    case 'left':
                        input = padString + input;
                        break;
                    default:
                        input = input + padString;
                }

            }
        }

        return input;
    };
}

/* ======== */
/* G1 core */
/* ======== */

/* ===== G1 namespace ===== */
var G1 = {
    isIOS: navigator.userAgent.match(/(iPad|iPhone|iPod)/g) !== null,
    isIE: navigator.userAgent.match(/msie/ig) !== null
};

(function() {
    "use strict";

    /* ===== G1 init ===== */
    G1.init = function() {
        var i, callbacks = [];

        callbacks = G1.getFilter().apply('g1_init', callbacks, null);

        for (i = 0; i < callbacks.length; i += 1) {
            var context = callbacks[i].context;
            var method = callbacks[i].method;

            if (typeof context[method] === 'function') {
                context[method]();
            }
        }
    };

    G1.hooks = {};

    /* ===== G1 Filter hook ===== */
    G1.hooks.filter = function () {
        // private scope
        var that = {};
        var filters = {};

        var add = function(name, callback, priority) {
            if (typeof filters[name] === 'undefined') {
                filters[name] = [];
            }

            if (typeof filters[name][priority] === 'undefined') {
                filters[name][priority] = [];
            }

            filters[name][priority].push(callback);
        };

        var apply = function(name, value, params) {
            if (typeof filters[name] !== 'undefined') {
                for (var priority in filters[name]) {
                    if (filters[name].hasOwnProperty(priority)) {
                        for (var index in filters[name][priority]) {
                            if (filters[name][priority].hasOwnProperty(index)) {
                                var filter = filters[name][priority][index];
                                var context;
                                var funcName;

                                if (is_string(filter)) {
                                    context = window;
                                    funcName = filter;
                                } else if (is_array(filter)) {
                                    context = filter[0];
                                    funcName = filter[1];
                                } else {
                                    throw {
                                        name: 'TypeError',
                                        message: 'callback needs to be a string of an object'
                                    };
                                }

                                value = context[funcName](value, params);
                            }
                        }
                    }
                }
            }

            return value;
        };

        var remove = function() {
            // not implemented
        };

        var has = function() {
            // not implemented
        };

        // public scope
        that.add = add;
        that.apply = apply;
        that.remove = remove;
        that.has = has;

        return that;
    };

    G1.getFilter = function() {
        if (typeof this.filter === 'undefined') {
            this.filter = this.hooks.filter();
        }

        return this.filter;
    };
})();

/* ===================== */
/* G1 core public api */
/* ===================== */

/**
 * @param name      filter name
 * @param callback  context and function which will be used for filtering
 * @param priority  order in which the functions associated with a particular filter are executed
 */
var g1_add_filter = function(name, callback, priority) {
    "use strict";

    G1.getFilter().add(name, callback, priority);
};

/**
 * @param name      filter name
 * @param value     filtered value
 * @param params    object holds all parameters passed to the filter
 */
var g1_apply_filters = function(name, value, params) {
    "use strict";

    return G1.getFilter().apply(name, value, params);
};


/* =========== */
/* G1 jQuery  */
/* =========== */
(function() {
    "use strict";

    G1.jQuery = {};

    /* ===================================
     * g1BoxHeight
     * package: G1 jQuery
     *
     * Returns computed box height
     * (content + borders + margins + paddings)
     * =================================== */
    (function($) {
        $.fn.g1BoxHeight = function () {
            var $this = $(this);

            var height =
                parseInt($this.css('margin-top'), 10) +
                parseInt($this.css('padding-top'), 10) +
                parseInt($this.css('border-top-width'), 10) +
                parseInt($this.height(), 10) +
                parseInt($this.css('border-bottom-width'), 10) +
                parseInt($this.css('padding-bottom'), 10) +
                parseInt($this.css('margin-bottom'), 10);

            return height;
        };
    })(jQuery);

    /* ===================================
     * g1Toggle
     * package: G1 jQuery
     *
     * Adds/removes class on element
     * =================================== */
    G1.jQuery.g1Toggle = {};
    G1.jQuery.g1Toggle.config = {
        'target_active_class_name':'g1-toggle-on',
        'target_class_name':'g1-toggle-ui',
        'target_attr_name': 'data-g1-toggle-target',
        'action_attr_name': 'data-g1-toggle-action',
        'default_action':   'toggle'
    };

    (function($) {
        // Toggle class definition
        var g1Toggle = function(element, options) {
            // private
            var that = {};
            var $element = $(element);
            var activeClassName = options.active_class_name;
            var className = options.class_name;

            var init = function() {
                $element.addClass(className);
            };

            var triggerEvent = function(name, params) {
                $element.trigger(name, params);
            };

            var show = function () {
                $element.addClass(activeClassName);
                triggerEvent('g1_toggle.after_show');
            };

            var hide = function () {
                $element.removeClass(activeClassName);
                triggerEvent('g1_toggle.after_hide');
            };

            var toggle = function() {
                if ($element.hasClass(activeClassName)) {
                    hide();
                } else {
                    show();
                }
            };

            // public
            that.show = show;
            that.hide = hide;
            that.toggle = toggle;

            init();

            return that;
        };

        // Toggle plugin definition
        $.fn.g1Toggle = function (action, options) {
            return this.each(function () {
                var $this = $(this);
                var instance = $this.data('g1_toggle');

                action = typeof action === 'string' ? action : G1.jQuery.g1Toggle.config.default_action;
                options = typeof options === 'object' ? options : {};
                options = $.extend({
                    'active_class_name': G1.jQuery.g1Toggle.config.target_active_class_name,
                    'class_name': G1.jQuery.g1Toggle.config.target_class_name
                }, options);

                // create instance
                if (!instance) {
                    instance = g1Toggle(this, options);
                    $this.data('g1_toggle', instance);
                }

                // invoke the method
                instance[action]();

                return this;
            });
        };
    })(jQuery);

    /* ================================
     * g1Tabs
     * package: G1 jQuery
     *
     * Handles tabbed content
     * ================================ */
    G1.jQuery.g1Tabs = {};
    G1.jQuery.g1Tabs.defaults = {
        event:                  'click',
        cssSelectorTitle:       '.g1-tab-title',
        cssSelectorContent:     '.g1-tab-content'
    };

    (function($) {
        var g1Tabs = function() {
            // private
            var that = {};

            var init = function( options ) {
                return this.each(function(){
                    options = options || {};

                    var $this = $(this);
                    var data = $this.data('g1Tabs');

                    /* If the plugin hasn't been initialized yet */
                    if ( !data ) {

                        /* support metadata plugin (v1.0 and v2.0) */
                        options = $.extend({}, $.fn.g1Tabs.defaults, options, $.metadata ? $this.metadata() : $.meta ? $this.data() : {});

                        $this.data('g1Tabs', {
                            'target'   : $this,
                            'options'  : options
                        });

                        var $navigation = $('<ul class="g1-tabs-nav"></ul>');
                        var $viewport = $('<div class="g1-tabs-viewport"></div>');

                        var index = 0;
                        var tabsContent = $this.find(options.cssSelectorContent);

                        $this.find( options.cssSelectorTitle ).each(function(){
                            var $div = $('<div class="g1-tabs-viewport-item"></div>' );
                            var $tabContent = $(this).next( options.cssSelectorContent );

                            if ( $tabContent.length === 0 && typeof tabsContent[index] !== 'undefined') {
                                $tabContent = $(tabsContent[index]).html();
                            }

                            $div.append( $tabContent );

                            var $li = $('<li class="g1-tabs-nav-item"></li>');
                            $li.append( $(this).detach() );

                            $navigation.append( $li );
                            $viewport.append( $div );

                            var eventType = '';
                            var classes = $this.attr('class');
                            var matches = classes.match(/g1-type-[^\s]+/gi);

                            if ( matches && matches.length > 0) {
                                eventType = matches[0].replace('g1-type--', '');
                            }

                            var event = eventType || options.event;

                            $li.bind(event, function() {
                                $this.find('.g1-tabs-nav-item').removeClass('g1-tabs-nav-current-item');
                                $(this).addClass('g1-tabs-nav-current-item');
                                $this.find('.g1-tabs-viewport-item').hide();
                                $div.show();

                                $('body').trigger('g1ContentElementVisible', [$div]);
                            });

                            index += 1;
                        });

                        $this.find('*').remove();

                        if ( $this.is( '.g1-tabs--bottom' ) ) {
                            $this.prepend( $navigation );
                            $this.prepend( $viewport );
                        } else {
                            $this.prepend( $viewport );
                            $this.prepend( $navigation );
                        }

                        $this.wrapInner('<div/>');

                        var hash = window.location.hash;
                        var tabSelector = '.g1-tabs-nav-item:first';

                        if (hash) {
                            var selector = hash;
                            var $tab = $this.find(selector);
                            var validTab = ($tab.length > 0 && $tab.hasClass('g1-tab-title'));

                            if (validTab) {
                                tabSelector = selector;
                            }
                        }

                        selectTab.apply(this, [tabSelector]);

                        $(window).bind( 'load', function(){
                            $this.g1Tabs( 'adjustHeight' );
                        });
                    }
                });
            };

            var adjustHeight = function() {
                return this.each(function(){
                    var $this = $(this);

                    if ( $this.g1Tabs( 'isPositionVertical') ) {
                        if ( $this.find( '.g1-tabs-nav').height() > $this.find( '.g1-tabs-viewport').height() ) {


                            $this.find( '.g1-tabs-viewport' ).css( 'min-height', $this.find( '.g1-tabs-nav' ).height() );
                        }
                    }
                });

            };

            var isPositionHorizontal = function() {
                if ( $(this).is( '.position-top-left, .position-top-center, .position-top-right, .position-bottom-left, .position-bottom-center, .position-bottom-right' ) ) {
                    return true;
                } else {
                    return false;
                }
            };

            var isPositionVertical = function() {
                return !( $(this).g1Tabs( 'isPositionHorizontal') );
            };

            var next = function( ) {
            };

            var prev = function() {
            };

            var select = function() {
            };

            var selectTab = function(selector) {
                var $this = $(this);

                var $elem = $this.find(selector);
                if (!$elem.is('.g1-tabs-nav-item')) {
                    $elem = $elem.parents('.g1-tabs-nav-item');
                }

                var elemIndex = $elem.index();

                $elem.addClass('g1-tabs-nav-current-item');
                $this.find('.g1-tabs-viewport-item').hide();
                $this.find('.g1-tabs-viewport-item').eq(elemIndex).show();


            };

            var destroy = function() {
            };

            that.init = init;
            that.adjustHeight = adjustHeight;
            that.isPositionHorizontal = isPositionHorizontal;
            that.isPositionVertical = isPositionVertical;
            that.next = next;
            that.prev = prev;
            that.select = select;
            that.selectTab = selectTab;
            that.destroy = destroy;

            return that;
        };


        // Tabs plugin definition
        $.fn.g1Tabs = function (method) {
            var $this = $(this);
            var instance = $this.data('g1_tabs');

            // create instance
            if (!instance) {
                instance = g1Tabs();
                $this.data('g1_tabs', instance);
            }

            // method calling logic
            if ( instance[method] ) {
                return instance[method].apply(this, Array.prototype.slice.call( arguments, 1));
            } else if (typeof method === 'object' || !method) {
                var options = Array.prototype.slice.call( arguments, 1);

                return instance.init.apply(this, options);
            } else {
                $.error('Method ' +  method + ' does not exist on G1.jQuery.tabs');
            }
        };

        $.fn.g1Tabs.defaults = G1.jQuery.g1Tabs.defaults;
    })(jQuery);

    /* ===============================
     * g1CollapseMenu
     * package: G1 jQuery
     *
     * Replaces list menu to select
     * =============================== */
    (function($){
        var g1CollapseMenu = function($element) {
            var that = {};
            var oldMenu, newMenu;

            var init = function() {
                oldMenu = $element;
                newMenu = createMenu();
            };

            var createMenu = function() {
                var $select = $("<select />");

                var $menu = $element.clone();
                $menu.find( 'li li > a' ).prepend( '- ');
                $menu.find( 'li li li > a' ).prepend( '- ');

                var isMenuItemSelected = function ($item) {
                    return $item.attr('class').match(/current/g);
                };

                /* Populate dropdown with menu items */
                var $selected = null;
                $menu.find( 'a').each(function() {
                    var el = $(this);

                    var $option = $("<option />", {
                        "value"   : el.attr("href"),
                        "text"    : el.clone().find('i').remove().end().text()
                    });

                    if (isMenuItemSelected(el.parent('.menu-item'))) {
                        $selected = $option;
                    }

                    $option.appendTo($select);


                });

                if ($selected) {
                    $selected.prop('selected', 'selected');
                }

                $menu = null;

                return $select;
            };

            var getOldMenu = function() {
                return oldMenu;
            };

            var getNewMenu = function() {
                return newMenu;
            };

            init();

            that.getOldMenu = getOldMenu;
            that.getNewMenu = getNewMenu;

            return that;
        };

        $.fn.g1CollapseMenu = function() {
            var instance = g1CollapseMenu($(this));

            return instance.getNewMenu();
        };
    })(jQuery);

    /* ===================================================================================================
     * g1PreventScale
     * package: G1 jQuery
     *
     * Preventing the page to scale larger than 1.0, when changing the device to landscape orientation
     * Based on: http://adactio.com/journal/4470/
     * ================================================================================================== */
    (function($) {
        $.fn.g1PreventScale = function() {
            if ( G1.isIOS ) {
                $('meta[name="viewport"]').each(function(){
                    var $this = $(this);

                    $this.prop('content', 'width=device-width, minimum-scale=1.0, maximum-scale=1.0');

                    $('body').bind( 'gesturestart', function() {
                        $this.prop('content', 'width=device-width, minimum-scale=0.25, maximum-scale=1.6');
                    });
                });
            }
        };
    })(jQuery);

    /* ===================================================================================================
     * g1ScrollTop
     * package: G1 jQuery
     *
     * Smooth scrolling to the top of the page
     * ================================================================================================== */
    (function($) {
        $.extend( {
            g1ScrollTop: function() {
                var multipier = 200;
                var durationRange = {
                    min: 200,
                    max: 1000
                };

                var winHeight = $(window).height();
                var docHeight = $(document).height();
                var proportion = Math.floor(docHeight / winHeight);

                var duration = proportion * multipier;

                if (duration < durationRange.min) {
                    duration = durationRange.min;
                }

                if (duration > durationRange.max) {
                    duration = durationRange.max;
                }

                $('html, body').animate({
                    scrollTop: $("#page").offset().top
                }, duration);
            }
        });
    })(jQuery);

    /* ===================================================================================================
     * g1IsVisibleInViewport
     * package: G1 jQuery
     *
     * Checks if element is fully visible in the browser viewport
     * ================================================================================================== */
    (function($) {
        var g1IsVisibleInViewport = function (elem, offset) {
            offset = offset || 0;

            var doc_view_top = $(window).scrollTop() + offset;
            var doc_view_bottom = doc_view_top + $(window).height() - offset;

            var elem_top = $(elem).offset().top;
            var elem_bottom = elem_top + $(elem).height() + parseInt($(elem).css('padding-top'), 10) + parseInt($(elem).css('padding-bottom'), 10);

            return (( elem_bottom >= doc_view_top ) && ( elem_top <= doc_view_bottom ));
        };

        $.fn.g1IsVisibleInViewport = function (offset) {
            return g1IsVisibleInViewport($(this), offset);
        };
    })(jQuery);

    /* ==========================================
     * g1Numbers
     * package: G1 jQuery
     *
     * Animated numbers
     * ========================================== */
    (function($) {
        // class
        var g1Numbers = function (element, options) {
            // private
            var that = {},
                $element = $(element),
            // options
                start = options.start,                                          // initial value
                stop = options.stop,                                            // final value
                step = 1,                                                       // change unit
                delay = 0,                                                      // time to start animation
                duration = 1000,                                                // animation duration
                ticks,                                                          // how many animation frames
                tickTime;                                                       // one animation frame duration

            var options = {
                'duration': 1000
            };

            if (typeof g1NumbersAnimationDuration !== 'undefined') {
                duration = g1NumbersAnimationDuration;
            }

            var refreshViewport = function () {
                // count up
                if ( start <= stop ) {
                    if (start + step < stop) {

                        start += step;

                        setTimeout(refreshViewport, tickTime);
                    } else {
                        start = stop;
                    }
                // count down
                } else {
                    if (start - step > stop) {

                        start -= step;

                        setTimeout(refreshViewport, tickTime);
                    } else {
                        start = stop;
                    }
                }

                $element.html(formatNumber(Math.round(start), '<span class="g1-thousands-separator"></span>'));
            };

            var init = function () {
                ticks = 20;
                step = Math.abs(stop - start) / ticks;
                tickTime = Math.round(duration / ticks);
                $element.html(formatNumber(start, '<span class="g1-thousands-separator"></span>'));
            };

            var run = function () {
                setTimeout(refreshViewport, delay);
            };

            var formatNumber = function (numberString, separator) {
                numberString += '';
                var x = numberString.split('.');
                var x1 = x[0];
                var x2 = x.length > 1 ? '.' + x[1] : '';
                var rgx = /(\d+)(\d{3})/;
                while (rgx.test(x1)) {
                    x1 = x1.replace(rgx, '$1' + separator + '$2');
                }

                return x1 + x2;
            };

            // pseudo constructor
            init();

            // public
            that.run = run;

            return that;
        };

        // jQuery plugin
        $.fn.g1Numbers = function (globalOptions) {
            return this.each(function () {
                var $this = $(this);
                var instance = $this.data('g1_numbers');

                if (!instance) {
                    var options = {};
                    var elems = ['start', 'stop', 'step', 'duration', 'delay'];

                    for (var i in elems) {
                        if (elems.hasOwnProperty(i)) {
                            var elem = elems[i];
                            var value = $this.attr('data-g1-' + elem);

                            if (typeof value !== 'undefined' && value !== '') {
                                options[elem] = parseInt(value, 10);
                            }
                        }
                    }

                    options = $.extend(globalOptions, options);

                    if ( typeof options.start === 'undefined' || typeof options.stop === 'undefined') {
                        return;
                    }

                    instance = g1Numbers($('span', $this), options);
                    $this.data('g1_numbers', instance);
                }

                return this;
            });
        };
    })(jQuery);

    /* ==========================================
     * g1Duplicator
     * package: G1 jQuery
     *
     * Duplicate elements
     * ========================================== */
    (function($) {
        // class
        var g1Duplicator = function (element, options) {
            // private
            var that = {},
                isIE,
                $element = $(element),
                html,
                $wrapper,
            // options
                start = options.start,                                              // initial value
                stop = options.stop,                                                // stop animation at this elements
                max = options.max,                                                  // max elements to show
                step = options.step || 1,                                           // change unit
                delay = options.delay || 0,                                         // time to start animation
                duration = options.duration || 1000,                                // value change duration (time between two ticks)
                animate = options.animate || function( $item ) { return $item;},    // animate duplicated element
                ticks,                                                              // how many animation frames
                tickTime,
                htmlElements = [],
                duplicates = [];                                                           // one animation frame duration

            var createDuplicate = function (i, $html) {
                var $duplicate = $('<div></div>').addClass('g1-duplicate g1-duplicate--inactive').append($html);

                duplicates[i] = $duplicate;
                htmlElements[i] = $html;

                return $duplicate;
            };

            var addDuplicate = function ($duplicate) {
                $wrapper.append($duplicate);
            };

            var refreshViewport = function () {
                var initState = start;
                var refresh = true;

                if (start + step < stop) {
                start += step;
                } else {
                start = stop;
                refresh = false;
                }

                for (initState; initState < start; initState++) {
                    duplicates[initState].addClass('g1-duplicate--active');

                    if (isIE || G1.isPhone) {
                        var $i = htmlElements[initState];
                        var $clone = $i.clone();
                        $i.replaceWith($clone);
                    }
                }

                if (refresh) {
                    setTimeout(refreshViewport, tickTime);
                }
            };

            var init = function () {
                isIE = false;

                if (G1.isIE) {
                    var ieVersion = navigator.userAgent.match(/msie [\d\.]+/ig);

                    if (ieVersion !== null) {
                        ieVersion = parseInt(ieVersion[0].toLowerCase().replace('msie ', ''), 10);

                        if (ieVersion < 9) {
                            isIE = true;
                        }
                    }
                }

                ticks = Math.round((stop - start) / step);
                tickTime = Math.round(duration / ticks);

                html = $element.html();
                $wrapper = $('<span>').addClass('g1-duplicates-wrapper');

                for (var i = 0; i < max; i++) {
                    var $duplicate = createDuplicate(i, $(html));

                    if (i < start) {
                        $duplicate.addClass('g1-duplicate--active g1-shown-on-start');
                    }

                    addDuplicate($duplicate);
                }

                $element.html($wrapper);
            };

            var run = function () {
                setTimeout(refreshViewport, delay);
            };

            // pseudo constructor
            init();

            // public
            that.run = run;

            return that;
        };

        // jQuery plugin
        $.fn.g1Duplicator = function (globalOptions) {
            return this.each(function () {
                var $this = $(this);
                var instance = $this.data('g1_duplicator');

                if (!instance) {
                    var options = {};
                    var elems = ['start', 'stop', 'max', 'step', 'duration', 'delay'];

                    for (var i in elems) {
                        if (elems.hasOwnProperty(i)) {
                            var elem = elems[i];
                            var value = $this.attr('data-g1-' + elem);

                            if (typeof value !== 'undefined' && value !== '') {
                                options[elem] = parseInt(value, 10);
                            }
                        }
                    }

                    options = $.extend(globalOptions, options);

                    if ( typeof options.start === 'undefined' || typeof options.stop === 'undefined') {
                        return;
                    }

                    instance = g1Duplicator($this, options);
                    $this.data('g1_duplicator', instance);
                }

                return this;
            });
        };
    })(jQuery);
})();

/* ===================== */
/* G1 jQuery public api */
/* ===================== */
(function() {
    "use strict";

    /* ===============================
     * g1Toggle
     * package: G1 jQuery API
     * =============================== */
    (function($) {
        // G1 Toggle markup api
        G1.jQuery.g1Toggle.loadApi = function() {
            var targetAttrName = G1.jQuery.g1Toggle.config.target_attr_name;
            var actionAttrName = G1.jQuery.g1Toggle.config.action_attr_name;

            $('body').on('click.g1Toggle', '[' + targetAttrName + ']', function () {
                var $this = $(this);
                var target = $this.attr(targetAttrName);
                var action = $this.attr(actionAttrName);

                $(target).g1Toggle(action);
            });
        };
    })(jQuery);

    /* ================================
     * isotope
     * package: G1 jQuery API
     * ================================ */
    (function($) {
        G1.jQuery.isotope = {};
        G1.jQuery.isotope.loadApi = function() {
            if ( $.fn.isotope ) {
                $('.g1-isotope-wrapper').each(function(){
                    var $this = $(this);
                    var $container = $('.g1-collection ul:eq(0)', $this);
                    var filters = {};

                    $container.isotope({
                        resizable: false,
                        containerStyle: { position: 'relative', overflow: 'visible' },
                        itemSelector : '.g1-collection__item',
                        layoutMode : 'fitRows'
                    });

                    $('.g1-isotope-filters a', $this).click(function(){
                        var $this = $(this);
                        // don't proceed if already selected
                        if ( $this.parent().hasClass('g1-isotope-filter--current') ) {
                            return;
                        }

                        var $optionSet = $this.parents('.option-set');
                        // change selected class
                        $optionSet.find('.g1-isotope-filter--current').removeClass('g1-isotope-filter--current');
                        $this.parent().addClass('g1-isotope-filter--current');

                        // store filter value in object
                        // i.e. filters.color = 'red'
                        var group = $optionSet.attr('data-isotope-filter-group');
                        filters[ group ] = $this.attr('data-isotope-filter-value');

                        // convert object into array
                        var isoFilters = [];
                        for ( var prop in filters ) {
                            if (filters.hasOwnProperty(prop)) {
                                isoFilters.push( filters[ prop ] );
                            }
                        }

                        var selector = isoFilters.join('');
                        $container.isotope({ filter: selector });

                        return false;
                    });
                });

                /* smartresize */
                $(window).smartresize(function(){
                    /* Leave it empty so that column width can be controlled from CSS  */
                    $('.g1-isotope-wrapper .g1-collection ul:eq(0)').isotope({

                    });
                });
            }
        };
    })(jQuery);

    /* ================================
     * jPlayer
     * package: G1 jQuery API
     * ================================ */
    (function($) {
        G1.jQuery.jPlayer = {};
        G1.jQuery.jPlayer.loadApi = function() {
            if ( $.fn.jPlayer ) {
                /* Build jPlayer */
                var jPlayerMarkup = new Array(
                    '<div id="__id__" class="jp-jplayer"></div>',
                    '<div id="__selector__" class="jp-audio">',
                    '<div class="jp-type-single">',
                    '__title__',
                    '<div class="jp-gui jp-interface">',
                    '<ul class="jp-controls">',
                    '<li><a href="javascript:;" class="jp-play" tabindex="1">play</a></li>',
                    '<li><a href="javascript:;" class="jp-pause" tabindex="1">pause</a></li>',
                    '<li><a href="javascript:;" class="jp-mute" tabindex="1" title="mute">mute</a></li>',
                    '<li><a href="javascript:;" class="jp-unmute" tabindex="1" title="unmute">unmute</a></li>',
                    '</ul>',
                    '<div class="jp-progress">',
                    '<div class="jp-seek-bar">',
                    '<div class="jp-play-bar"></div>',
                    '</div>',
                    '</div>',
                    '<div class="jp-volume-bar">',
                    '<div class="jp-volume-bar-value"></div>',
                    '</div>',
                    '<div class="jp-current-time"></div>',
                    '<div class="jp-duration"></div>',
                    '</div>',
                    '<div class="jp-no-solution">',
                    '<span>Update Required</span>',
                    'To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.',
                    '</div>',
                    '</div>',
                    '</div>'
                ).join("\n");

                var loadPlayer = function ($this) {
                    var player = jPlayerMarkup;

                    var id			= $this.attr( 'id' ) + '-1';
                    var selector	= $this.attr( 'id' ) + '-2';
                    var title       = $this.find( 'figcaption' ).text();

                    var source      = $this.find('audio').attr( 'src' );

                    title = title.length ? '<div class="jp-title"><ul><li>' + title + '</li></ul></div>' : '';

                    /* Fill in the id and selector */
                    player = player.replace( '__id__', id );
                    player = player.replace( '__selector__', selector );

                    /* Fill in the title */
                    player = player.replace( '__title__', title );

                    /* Remove all elements inside */
                    $this.empty();

                    /* Append player markup */
                    $this.append( player );

                    /* Compose configuration */
                    var config = [];
                    config.ready                = function() { $(this).jPlayer("setMedia", { mp3: source }); };
                    config.play                 = function() { $(this).jPlayer( 'pauseOthers' ); };
                    config.cssSelectorAncestor  = '#' + selector;
                    config.swfPath              = g1Theme.uri + '/js/jquery.jplayer/Jplayer.swf';
                    config.supplied             = 'mp3';
                    config.wmode                = 'window';

                    /* Init player */
                    $this.find( '#' + id ).jPlayer( config );
                };

                $( 'figure.media-audio' ).each( function() {
                    loadPlayer($(this));
                });

                $( 'figure.media-audio').live('loadPlayer', function () {
                    loadPlayer($(this));
                });
            }
        };
    })(jQuery);

    /* ================================
     * g1ScrollTop
     * package: G1 jQuery API
     * ================================ */
    (function($) {
        G1.jQuery.g1ScrollTop = {};
        G1.jQuery.g1ScrollTop.loadApi = function() {
            $('#g1-back-to-top').click(function(event) {
                event.preventDefault();
                $.g1ScrollTop();
            });
        };
    })(jQuery);
})();

/* ===================
 *
 * G1 main
 *
 * =================== */
G1.theme = {
    DESKTOP_MIN_WIDTH: 769,
    getWindowWidth: function () {
        if (typeof window.innerWidth !== 'undefined') {
            return window.innerWidth;
        }

        return jQuery(window).width();
    }
};

(function($) {
    "use strict";

    // document ready
    $(document).ready(function() {
        G1.isPhone =  G1.theme.getWindowWidth() <= 767;
        G1.isTablet =  G1.theme.getWindowWidth() > 767 && G1.theme.getWindowWidth() <= 1024;
        G1.isDesktop =  !G1.isPhone && !G1.isTablet;
        G1.isAndroid =  navigator.userAgent.indexOf('Android') !== -1;

        if (G1.isDesktop) {
            G1.theme.showSubmenuOnRightForLowerRes();
        }

        G1.theme.relocateDOMElements();
        G1.theme.setUpSecondaryNav();
        G1.theme.setUpBreakpoints();

        if (typeof G1.theme.loadDemoSwitcher === 'function') {
            G1.theme.loadDemoSwitcher();
        }

        G1.theme.setUpLogo();
        G1.theme.setUpPrimaryNav();

        // core
        $.fn.g1PreventScale();
        G1.jQuery.g1Toggle.loadApi();
        G1.jQuery.jPlayer.loadApi();
        G1.jQuery.g1ScrollTop.loadApi();

        // theme
        if (G1.isPhone) {
            G1.theme.disableGridDelay();
        }

        G1.theme.enableProgressBar();
        G1.theme.enableNumbers();
        G1.theme.enableDuplicator();
        G1.theme.enableProgressPieChart();

        G1.theme.setUpSectionsScroll();

        if (!G1.isPhone) {
            G1.theme.handleGridDelay();
            G1.theme.enableSkrollr();
        }

        G1.theme.setUpScrollToTop();
        G1.theme.setUpWoocommerce();
        G1.theme.enableTabs();
        G1.theme.enableCountdown();
        G1.theme.enableToggle();
        G1.theme.enableBeforeAfterEffect();
        //G1.theme.replaceButtonsToLinks();
        G1.theme.enableOpeningLinksInNewWindow();
        
        G1.theme.enableBackgroundScroll();
        G1.theme.handleSearchBoxFocus();
        G1.theme.handleIEIframeHover();
        G1.theme.handleHoverState();

        // lightbox
        G1.theme.lightbox.enableForPostFormatGalleryCollectionItem();
        G1.theme.lightbox.enableForCollectionItems();
        G1.theme.lightbox.enableForShortcodes();
        G1.theme.lightbox.enableForMediabox();
        G1.theme.lightbox.enableForIFrame();
        G1.theme.lightbox.enableForHtmlContent();
    });

    // window loaded
    $(window).load(function() {
        G1.theme.enableSliderForPostFormatGallerySingleItem();
        G1.theme.enableSliderForPostFormatGalleryCollectionItem();
        G1.theme.enableHtmlRotator();
        G1.theme.rotateTwitterItems();
        G1.theme.handleStickyHeader();

        G1.jQuery.isotope.loadApi();

        if ( $.fn.isotope ) {
            $('.g1-masonry-wrapper').each(function(){
                var $this = $(this);
                var $container = $('.g1-collection ul:eq(0)', $this);

                var pluginConfig = {
                    resizable: false,
                    containerStyle: {
                        position:'relative',
                        overflow:'visible'
                    },
                    itemSelector:'.g1-collection__item',
                    layoutMode:'masonry'
                };

                $container.isotope(pluginConfig);
            });

            /* smartresize */
            $(window).smartresize(function(){
                /* Leave it empty so that column width can be controlled from CSS  */
                $('.g1-masonry-wrapper .g1-collection ul:eq(0)').isotope({

                });
            });
        }

        if (G1.theme.SKROLLR_ENABLED && typeof skrollr !== 'undefined') {
            skrollr.init({
                forceHeight: false,
                easing: 'linear'
            });
        }
    });

})(jQuery);

/* =========================
 *
 * THEME CUSTOM FUNCTIONS
 *
 * ========================= */
(function($) {
"use strict";

$.fn.g1ListenOn = function (eventName, callback) {
    var $this = $(this);

    // tell others that they can trigger 'fire' event on this element
    $this.attr('data-g1-listen', eventName);

    // run when 'fire' event caught
    $this.on(eventName, function() {
        if (typeof callback === 'function') {
            callback();
        }
    });

    // 'Progress Bar' isn't placed inside delayed element so we can
    // run animation when bottom of the element hit the bottom of the viewport
    if ($this.parents('.g1-column[data-g1-delay]').length === 0) {
        $this.waypoint(function () {
            $this.trigger(eventName);
        }, {
            offset: function() {
                return $(window).height() - $(this).height();
            }
        });
    }
};

G1.theme.setUpSectionsScroll = function () {
    $('.g1-section--scroll').each(function() {
        var $this = $(this);
        var bgPos = $this.css('background-position').split(' ');
        var bgPosX = bgPos[0];
        var bgPosY = bgPos[1];

        var bgPosYStartInPx = '0px';
        var bgPosYStopInPx = -400;

	    // 100% means pos-y set to bottom
	    if (bgPosY === '100%') {
	        bgPosYStopInPx *= -1; // change direction
	    }

        $this.attr('data-bottom-top', 'background-position:'+ bgPosX +' '+ bgPosYStartInPx +';');
        $this.attr('data-top-bottom', 'background-position:'+ bgPosX +' '+ bgPosYStopInPx +';');
    });
};

G1.theme.showSubmenuOnRightForLowerRes = function () {
    $("#g1-primary-nav-menu li li").mouseover(function(){
	if($(this).children('ul').length === 1) {
        var parent = $(this);
            var child_menu = $(this).children('ul');

        if( $(parent).offset().left + $(parent).width() + $(child_menu).width() > G1.theme.getWindowWidth() ){
        $(child_menu).css('left', '-' + $(parent).width() + 'px');
        } else {
            $(child_menu).css('left', $(parent).width() + 'px');
        }
	}
    });
};

G1.theme.handleHoverState = function () {
    var $lastHoveredElement = null;

    $('.g1-collection.g1-collection--gallery article, .g1-collection:not(.g1-collection--gallery) .entry-featured-media').each(function(e) {
        var $this = $(this);
        var isGallery = $this.parents('.g1-collection').hasClass('g1-collection--gallery');

        $this.on('mouseover', function() {
            if (G1.isDesktop) {
                $this.addClass('g1-on--mouse');
            }
        });

        $this.on('mouseout', function() {
            if (G1.isDesktop) {
                $this.removeClass('g1-on--mouse');
            }
        });

        $this.on('click', function(e) {
            if (!G1.isDesktop) {
                if (!$this.hasClass('g1-on--finger')) {
                    if (isGallery) {
                        e.preventDefault();
                    }

                    $this.addClass('g1-on--finger');
                    $lastHoveredElement = $this;
                }
            }
        });
    });

    $(document).on( 'click touchstart MSPointerDown', function(e) {
        var resetItem = true;
        var parents = $(e.target).parents();

        for( var i = 0; i < parents.length; i++ ) {
            if( $lastHoveredElement !== null && parents[i] === $lastHoveredElement[0] ) {
                resetItem = false;
            }
        }

        if( resetItem ) {
            if ($lastHoveredElement !== null) {
                $lastHoveredElement.removeClass('g1-on--finger');
            }

            $lastHoveredElement = null;
        }
    });
};

G1.theme.handleIEIframeHover = function () {
    if(G1.isIE){
        $('article iframe').live('hover',function() {
            $(this).parents("article").addClass('g1-on--mouse');
        });

        $('article iframe').live('mouseleave',function() {
            $(this).parents("article").removeClass('g1-on--mouse');
        });
    }
};

G1.theme.handleSearchBoxFocus = function () {
    $('.g1-searchbox__switch').click(function () {
        var $form = $(this).next('#searchform');
        var $input = $form.find('input#s');

        if ($input.hasClass('g1-focus')) {
            $input.blur();
            $input.removeClass('g1-focus');
        } else {
            $input.focus();
            $input.addClass('g1-focus');
        }
    });
};

G1.theme.relocatePrimaryNavBeforeLogo = function () {
    $('body.g1-header-comp-left-top, body.g1-header-comp-center-top, body.g1-header-comp-right-top').
        find('#g1-primary-nav').prependTo('#g1-primary-bar');
};

G1.theme.relocatePrimaryNavAfterLogo = function () {
    $('body.g1-header-comp-left-top, body.g1-header-comp-center-top, body.g1-header-comp-right-top').
        find('#g1-primary-nav').appendTo('#g1-primary-bar');
};

G1.theme.relocatePrimaryNav = function () {
    if (G1.theme.getWindowWidth() > 1024) {
        G1.theme.relocatePrimaryNavBeforeLogo();
    } else {
        G1.theme.relocatePrimaryNavAfterLogo();
    }
};

G1.theme.changePrimaryNavClass = function () {
    if (G1.theme.getWindowWidth() > 1024) {
        $('#g1-primary-nav').
            addClass('g1-nav--collapsed').
            removeClass('g1-nav--expanded');
    }
};

G1.theme.setUpSecondaryNav = function () {
    var $secondaryNav = $('#g1-secondary-nav');

    if (G1.theme.getWindowWidth() > 1024) {
        $secondaryNav.removeClass('g1-nav--mobile');
    } else {
        $secondaryNav.addClass('g1-nav--mobile');
    }
};

G1.theme.relocateDOMElements = function () {

    G1.theme.relocatePreheaderElements();

    if (G1.theme.getWindowWidth() > 1024) {
        G1.theme.relocatePrimaryNavBeforeLogo();
    }

    $('#g1-primary-bar .g1-searchbox, #g1-preheader-bar .g1-searchbox').each(function(){
        var $this = $(this);

        // Default state
        $this.addClass('g1-searchbox--off');

        $this.find('.g1-searchbox__switch:eq(0)').click(function(event){
            event.preventDefault();
            $this.toggleClass('g1-searchbox--off g1-searchbox--on');
        });
    });

    $('#g1-primary-bar .g1-cartbox, #g1-preheader-bar .g1-cartbox').each(function(){
        var $this = $(this);

        // Default state
        $this.addClass('g1-cartbox--off');

        $this.find('.g1-cartbox__switch:eq(0)').click(function(event){
            event.preventDefault();
            $this.toggleClass('g1-cartbox--off g1-cartbox--on');
        });
    });

    // Precontent
    var moveToPrecontent = [
        'article.g1-complete > .entry-header:first',
        'article#post-0 .entry-header:first',
        '.archive-header:first',
        '.page-header:first',
        '.g1-move-to-precontent'
    ];
    moveToPrecontent = moveToPrecontent.join(',');

    $('#content').find(moveToPrecontent)
        .detach()
        .addClass('g1-layout-inner')
        .appendTo($('#g1-precontent')
    );


    $('#g1-primary-nav').each(function(){
        var $body = $('body');
        var $this = $(this);

        $body.addClass('g1-primary-nav--collapsed');
        $this.addClass('g1-nav--collapsed');

        $('#g1-primary-nav-switch:eq(0)', $this).click(function(e){
            e.preventDefault();

            $body.toggleClass('g1-primary-nav--collapsed g1-primary-nav--expanded');
            $this.toggleClass('g1-nav--collapsed g1-nav--expanded');
        });
    });

    $('#g1-secondary-nav').each(function(){
        var $this = $(this);

        $this.addClass('g1-nav--collapsed');

        $('#g1-secondary-nav-switch:eq(0)', $this).click(function(e){
            e.preventDefault();

            $this.toggleClass('g1-nav--collapsed g1-nav--expanded');
        });
    });
};

G1.theme.enableSkrollr = function () {
    G1.theme.SKROLLR_ENABLED = true;
};

G1.theme.enableProgressPieChart = function () {
    $('.g1-progress-circle').each(function () {
        var $this = $(this);
        var $colorScheme = $(this).find('.g1-color-scheme').eq(0);

        var configObj = $this.metadata( { type: 'attr', name: 'data-config' });

        var trackColor = $colorScheme.css('borderTopColor');
        var scaleColor = $colorScheme.css('borderTopColor');
        var barColor = $colorScheme.css('outlineColor');
        var bgColor = $colorScheme.css('backgroundColor');

        if ( typeof configObj.barColor !== 'undefined' ) {
            barColor = configObj.barColor;
        }

        if ( typeof configObj.bgColor !== 'undefined' ) {
            bgColor = configObj.bgColor;
        }

        // Adjust settings based on style
        if ( $this.hasClass( 'g1-progress-circle--simple' ) ) {
            bgColor = false;
        } else if ( $this.hasClass( 'g1-progress-circle--solid' ) ) {
            trackColor = false;
        }

        var dataPercent = $this.attr('data-percent');
        $this.attr('data-percent', 0);

        $this.easyPieChart({
            animate:1000,
            lineWidth:4,
            barColor:barColor,
            trackColor:trackColor,
            scaleColor:false,
            bgColor:bgColor,
            lineCap:'square',
            size: 138
        });

        $this.g1ListenOn('fire', function() {
            $this.data('easyPieChart').update(dataPercent);
        });
    });
};

G1.theme.enableBackgroundScroll = function () {
    if (!G1.theme.SKROLLR_ENABLED) {
	return;
    }

    $('body.g1-top-background-scroll').each(function () {
	var $target = $('#g1-top > .g1-background');

        if ($target.css('background-image') !== 'none') {
            $target.attr('data-0', 'background-position: 0px 0px;');
            $target.attr('data-1000', 'background-position: 0 500px;');
        }
    });

    $('body.g1-background-scroll').each(function () {
        var $target = $('body');

        if ($target.css('background-image') !== 'none') {
            $target.attr('data-0', 'background-position: 0px 0px;');
            $target.attr('data-10000', 'background-position: 0 5000px;');
        }
    });
};

G1.theme.enableHtmlRotator = function (parentSelector) {
    parentSelector = typeof parentSelector !== 'undefined' ? parentSelector + ' ' : '';

    var handler = function ($this) {
        var $content = $('.g1-carousel-content', $this);
        var $coinNav = $('.g1-nav-coin', $this);
        var $directionNav = $('.g1-nav-direction', $this);
        var $autoplay = $this.hasClass('g1-autoplay');
        var $prev = $('.g1-nav-direction__prev', $directionNav);
        var $next = $('.g1-nav-direction__next', $directionNav);

        var itemsToRotate = parseInt($this.attr('data-g1-rotate-items'), 10);
        var timeout = parseInt($this.attr('data-g1-timeout'), 10);

        if (itemsToRotate <= 0) {
            return;
        }

        var $itemList = $content.find('.g1-carousel-item');
        var $carouselItems = $content.find('.g1-carousel-items');

        var allItems = $itemList.length;
        var coinNavElemsCount = Math.ceil( allItems / itemsToRotate );

        var slideTo = function () {
            $carouselItems.trigger('slideTo', $(this).data('first_slide_index'));
        };

        for (var i = 0; i < coinNavElemsCount; i += 1) {
            var $coinNavItem = $('<li>').append($('<a>').text( i + 1 ));
            $coinNavItem.data('first_slide_index', i * itemsToRotate);

            $coinNavItem.appendTo($coinNav);
            $coinNavItem.click(slideTo);
        }

        $itemList.each(function (index) {
            $(this).data('index', index);
        });

        var customConfig = {
            'timeout': timeout
        };

        if ( typeof G1.theme.htmlRotatorCustomConfig === 'function' ) {
            G1.theme.htmlRotatorCustomConfig(customConfig);
        }

        var pluginConfig = {
            responsive:true,
            width:'100%',
            height:'variable',
            items: {
                visible: itemsToRotate
            },
            scroll: {
                items: itemsToRotate,
                pauseOnHover: 'resume',
                fx: 'scroll',
                easing:'easeInOutExpo',
                duration:2000,
                onBefore: function (data) {
                    var $firstVisibleItem = $(data.items.visible[0]);
                    var index = Math.floor(parseInt($firstVisibleItem.data('index'), 10) / itemsToRotate);

                    $coinNav.find('.g1-selected').removeClass('g1-selected');
                    $coinNav.children(':eq(' + index + ')').addClass('g1-selected');
                }
            },
            auto: {
                play: $autoplay,
                timeoutDuration: customConfig.timeout
            },
            prev: {
                button: $prev
            },
            next: {
                button: $next
            },
            swipe: {
                onTouch: true,
                onMouse: false
            },
            onCreate: function () {
                $coinNav.children(':first').addClass('g1-selected');
            }
        };

        var pluginOptions = {
            wrapper: {
                element: 'div',
                classname:'g1-carousel'
            }
        };

        $carouselItems.carouFredSel(pluginConfig, pluginOptions);
    };

    $(parentSelector + '.g1-html-rotator:visible').each(function () {
        var $this = $(this);

        if ($this.find('.g1-carousel').length > 0) {
            return;
        }

        handler($this);
    });

    $('body').on('g1ContentElementVisible', function (event, $element) {
        var $this = $element.find('.g1-html-rotator');

        if ($this.length === 0) {
            return;
        }

        if ($this.find('.g1-carousel').length > 0) {
            $this.find('.g1-carousel-items').trigger('resume');
            return;
        }

        handler($this);
    });
};

G1.theme.rotateTwitterItems = function (parentSelector) {
    parentSelector = typeof parentSelector !== 'undefined' ? parentSelector + ' ' : '';

    $(parentSelector + '.g1-twitter--carousel:visible').each(function () {
        var $this = $(this);

        if ($this.find('.g1-carousel').length > 0) {
            return;
        }

        var $directionNav = $('<div class="g1-nav-direction"></div>');
        var $prev = $('<a class="g1-nav-direction__prev" href="#"></a>');
        var $next = $('<a class="g1-nav-direction__next" href="#"></a>');

        $directionNav
            .append( $prev )
            .append( $next )
        ;
        $this.append($directionNav);

        var autoPlay = $this.is('.g1-autoplay-on');

        var pluginConfig = {
            width:'100%',
            height:'variable',
            responsive: true,
            items: {
                visible: 1
            },
            scroll: {
                items: 1,
                pauseOnHover: true,
                fx: 'fade',
                duration: 800
            },
            auto: {
                play: autoPlay
            },
            prev: {
                button: $prev
            },
            next: {
                button: $next
            },
            swipe: {
                onTouch: true,
                onMouse: false
            }
        };

        var pluginOptions = {
            wrapper: {
                element: 'div',
                classname:'g1-carousel'
            }
        };

        $this.find('.g1-twitter__items').carouFredSel(pluginConfig, pluginOptions);
    });
};

G1.theme.setUpScrollToTop = function () {
    // divider top
    $('.g1-divider-top').click(function(event) {
        event.preventDefault();
        $.g1ScrollTop();
    });

    var scrollToTop = $('#g1-back-to-top');

    var hideShowScrollToTop = function (scrollTop) {
        if (scrollTop > 0) {
            scrollToTop.addClass('g1--on').removeClass('g1--off');
        } else {
            scrollToTop.addClass('g1--off').removeClass('g1--on');
        }
    };

    $(window).scroll(function() {
        hideShowScrollToTop($(window).scrollTop());
    });

    hideShowScrollToTop($(window).scrollTop());
};

G1.theme.setUpLogo = function () {
    var width = G1.theme.getWindowWidth();
    var pixelRatio = 1;

    if ( typeof window.devicePixelRatio !== 'undefined' ) {
        pixelRatio = window.devicePixelRatio;
    }

    var $logo = $('#g1-logo');
    var $mobileLogo = $('#g1-mobile-logo');
    var desktopLogoPath = $logo.attr('data-g1-src-desktop');

    var retina = pixelRatio > 1;
    var isDesktop =     width > 1024 && !retina;
    var isDesktopHDPI = width > 1024 && retina;
    var isMobile =      width <= 1024 && !retina;
    var isMobileHDPI =  width <= 1024 && retina;

    var hasLogo = function (type) {
        var typeLogoPath = $logo.attr('data-g1-src-' + type);

        return typeLogoPath !== desktopLogoPath;
    };

    var hasMobileLogo = function (type) {
        var typeLogoPath = $mobileLogo.attr('data-g1-src-' + type);

        return typeLogoPath !== desktopLogoPath;
    };

    var useLogo = function (type) {
        $logo.attr('src', $logo.attr('data-g1-src-' + type));
    };

    var useMobileLogo = function (type) {
        $mobileLogo.attr('src', $mobileLogo.attr('data-g1-src-' + type));
    };

    if ( isDesktop ) {
        useLogo('desktop');
        return;
    }

    if ( isDesktopHDPI ) {
        useLogo('desktop-hdpi');
        return;
    }

    if ( isMobile ) {
        useMobileLogo('mobile');
        return;
    }

    if ( isMobileHDPI ) {
        if ( hasMobileLogo('mobile-hdpi') ) {
            useMobileLogo('mobile-hdpi');
            return;
        }

        if ( hasMobileLogo('mobile') ) {
            useMobileLogo('mobile');
            return;
        }

        if ( hasLogo('desktop-hdpi') ) {
            useLogo('desktop-hdpi');
            return;
        }

        useLogo('desktop');
        return;
    }
};

G1.theme.setUpPrimaryNav = function () {
    $('#g1-primary-nav-menu li.menu-parent-item').each(function () {
        var $item = $(this).addClass('g1-nav-item--collapsed');
        var $switch = $('<div>').addClass('g1-nav-item__switch');

        $item.prepend($switch);

        $switch.on('click', function (e) {
            $item.toggleClass('g1-nav-item--collapsed g1-nav-item--expanded');
        });
    });
};

G1.theme.simpleSliders = {
    'customHandlers': {
        'viewportSlider': function ($slider, configObj) {
            var breakpointThreshold = parseInt(configObj.width_in_px, 10);

            var size = G1.theme.getWindowWidth() < breakpointThreshold ? 'simple' : 'viewport';
            var handlerName = size + 'Slider';

            var handler = G1.theme.simpleSliders.handlers[handlerName];

            if (typeof handler === 'function') {
                handler($slider, configObj);
            } else {
                throw 'Handler "'+ handlerName +'" does not exist!';
            }
        },
        'standoutSlider': function ($slider, configObj) {
            var breakpointThreshold = parseInt(configObj.width_in_px, 10);

            var size = G1.theme.getWindowWidth() < breakpointThreshold ? 'simple' : 'standout';
            var handlerName = size + 'Slider';

            var handler = G1.theme.simpleSliders.handlers[handlerName];

            if (typeof handler === 'function') {
                handler($slider, configObj);
            } else {
                throw 'Handler "'+ handlerName +'" does not exist!';
            }
        },
        'relaySlider': function ($slider, configObj) {
            var breakpointThreshold = parseInt(configObj.width_in_px, 10);

            var size = G1.theme.getWindowWidth() < breakpointThreshold ? 'simple' : 'relay';
            var handlerName = size + 'Slider';

            var handler = G1.theme.simpleSliders.handlers[handlerName];

            if (typeof handler === 'function') {
                handler($slider, configObj);
            } else {
                throw 'Handler "'+ handlerName +'" does not exist!';
            }
        }
    }
};

G1.theme.setUpBreakpoints = function () {
    if (typeof $.fn.setBreakpoints === 'undefined') {
        return;
    }

    var breakpoints = [1, G1.theme.DESKTOP_MIN_WIDTH, 968, 1024, 1136];

    $(window).setBreakpoints({
        'breakpoints': breakpoints
    });

    var makeEnterBreakpoint = function (width) {
        $(window).bind('enterBreakpoint' + width,function() {
            G1.theme.reloadSlider('viewport', width);
            G1.theme.reloadSlider('standout', width);
            G1.theme.reloadSlider('relay', width);
            G1.theme.setUpSecondaryNav();
            G1.theme.setUpLogo();
        });
    };

    var makeExitBreakpoint = function (width) {
        $(window).bind('exitBreakpoint' + width,function() {
            G1.theme.reloadSlider('viewport', width);
            G1.theme.reloadSlider('standout', width);
            G1.theme.reloadSlider('relay', width);
            G1.theme.setUpSecondaryNav();
            G1.theme.setUpLogo();
        });
    };

    for (var i = 0; i < breakpoints.length; i += 1) {
        var breakpoint = breakpoints[i];

        if (breakpoint === 1 || breakpoint === G1.theme.DESKTOP_MIN_WIDTH) {
            continue;
        }

        makeEnterBreakpoint(breakpoint);
        makeExitBreakpoint(breakpoint);
    }

    // change primary nav location
    $(window).bind('enterBreakpoint1024', function() {
        G1.theme.relocatePrimaryNav();
        G1.theme.changePrimaryNavClass();
    });

    $(window).bind('exitBreakpoint1024', function() {
        G1.theme.relocatePrimaryNav();
        G1.theme.changePrimaryNavClass();
    });

    $(window).resize();
};

G1.theme.reloadSlider = function (layout, width) {
    $('.g1-simple-slider').each(function() {
        var $slider = $(this);
        var slider = $slider.data('g1_simple_slider');

        if (!slider) {
            return;
        }

        var $sliderContainer = slider.getContainer();
        var sliderConfig = slider.getConfig();

        if (sliderConfig.layout !== layout) {
            return;
        }

        var selectedSlideIndex = slider.getSelectedSlide().data('index');

        $sliderContainer.trigger('destroy');

        var $originalSlider = slider.getOriginalSlider();

        $slider.replaceWith($originalSlider);

        // move old selected slide to first position
        var $slides = $originalSlider.find('.g1-slides');

        while ($slides.find('li:first').data('index') !== selectedSlideIndex) {
            $slides.find('li:first').appendTo($slides);
        }

        $slides.find('li.g1-selected').removeClass('g1-selected');
        $slides.find('li:first').addClass('g1-selected');

        var sliderClass = G1.theme.simpleSliders.helpers.getSliderHandler(layout + 'Slider');

        if (sliderClass) {
            sliderClass($originalSlider, sliderConfig);
        }
    });
};

G1.theme.disableGridDelay = function () {
    $('.g1-column[data-g1-delay]').removeAttr('data-g1-delay');
};

G1.theme.handleGridDelay = function () {
    $('.g1-grid').has('.g1-column[data-g1-delay]').each(function() {
        var config = {
            'fadeAnimationTime': 1000,
            'animationDuration': 1500
        };

        if (typeof g1GridAnimationConfig !== 'undefined') {
            config = g1GridAnimationConfig(config);
        }

        var $wrapper = $(this);
        var columns = [];
        var delay = 0;
        var fadeAnimationTime = config.fadeAnimationTime;
        var delayOffset = fadeAnimationTime;
        var $elementsListenOnFire = $wrapper.find('[data-g1-listen="fire"]');

        if ($elementsListenOnFire.length === 0) {
            delayOffset = fadeAnimationTime;
        }

        $wrapper.find('.g1-column[data-g1-delay]').each(function() {
            var $column = $(this);
            columns.push({'elem': $column, 'delay': delay});
            delay += delayOffset;

            var $animatedElement = $column.find('[data-g1-listen="fire"]');

            if ($animatedElement.length > 0) {
                //var duration = parseInt($animatedElement.attr('data-g1-duration'), 10);

                var duration = config.animationDuration;

                delay += duration;
            }
        });

        $wrapper.waypoint(function() {
            $(columns).each(function(index, value) {
                setTimeout(function () {
                    if (Modernizr.csstransitions) {
                        value.elem.addClass('g1-start-animation');
                    } else {
                        value.elem.animate({
                            'opacity': 1.0
                        }, fadeAnimationTime);
                    }

                    // send 'fire' event to elements inside column
                    setTimeout(function(){
                            value.elem.find('[data-g1-listen="fire"]').trigger('fire');
                    }, fadeAnimationTime);
                }, value.delay);
            });
        }, {
            offset: function() {
                // bottom of the element hit the bottom of the viewport
                return $(window).height() - $(this).height();
            }
        });
    });
};

G1.theme.handleStickyHeader = function () {
    $('body').on('g1PreheaderWidgetAreaChanged', function () {
        $.waypoints('refresh');
    });

    $('body.g1-header-position-fixed').each(function() {
        var $headerWaypoint = $('#g1-header-waypoint');

        if ($headerWaypoint.length > 0) {
            var $header = $('#g1-header');
            var height = $headerWaypoint.g1BoxHeight();
	        $headerWaypoint.css('height', height + 'px');

            $headerWaypoint.waypoint(function() {
                if ($header.hasClass('g1-fixed')) {
                    $header.removeClass('g1-fixed');
                } else {
                    $header.addClass('g1-fixed');
                }
            });
        }
    });
};

G1.theme.enableSliderForPostFormatGallerySingleItem = function () {
    $('.g1-gallery').each(function() {
        var $wrapper = $(this);
        var $items   = $('.g1-gallery-items', $wrapper);
        var $thumbs  = $('.g1-gallery-thumbs li', $wrapper);
        var $toolbar = $('.g1-gallery-toolbar', $wrapper);
        var $counter = $('<span>').addClass('g1-gallery-counter');
        var $prev = $('<a href="#">prev</a>').addClass('g1-gallery-prev');
        var $next = $('<a href="#">next</a>').addClass('g1-gallery-next');

        // build toolbar
        $toolbar.
            append($counter).
            append($prev).
            append($next);

        $items.find('li').each(function(i) {
            $(this).data('index', i);
        });

        var selectItem = function (index) {
            $thumbs.removeClass('g1-selected');
            $thumbs.eq(index).addClass('g1-selected');

            $counter.html((index + 1) + '/' + $thumbs.length);
        };

        var pluginConfig = {
            auto: false,
            responsive: true,
            width:'100%',
            height:'variable',
            items: {
                visible:1
            },
            scroll: {
                fx: 'crossfade',
                items:1,
                onAfter: function (data) {
                    var $currentItem = data.items.visible;

                    if ($currentItem.length > 0) {
                        selectItem($currentItem.data('index'));
                    }
                }
            },
            prev: {
                button: $prev,
                key: 'left'
            },
            next: {
                button: $next,
                key: 'right'
            },
            swipe: {
                onTouch: true,
                onMouse: false
            },
            onCreate: function () {
                selectItem(0);
            }
        };

        var pluginOptions = {
            wrapper: {
                element: 'div',
                classname:'g1-carousel'
            }
        };

        $items.carouFredSel(pluginConfig, pluginOptions);

        // handle thumbs nav
        $thumbs.each(function() {
            $(this).click(function(e) {
                e.preventDefault();

                $items.trigger('slideTo', $thumbs.index($(this)));
            });
        });
    });
};

G1.theme.enableSliderForPostFormatGalleryCollectionItem = function () {
    $('.g1-collection .format-gallery .entry-featured-media').each(function () {
        var $media = $(this);
        var $galleryItems = $media.find('.g1-gallery-items');

        // direction nav
        var $directionNav = $('<div>').addClass('g1-nav-direction');
        var $prev = $('<a>').attr('href', '#').addClass('g1-nav-direction__prev').text('prev');
        var $next = $('<a>').attr('href', '#').addClass('g1-nav-direction__next').text('next');
        $directionNav.append($prev);
        $directionNav.append($next);
        $directionNav.insertAfter($galleryItems);

        $galleryItems.find('li').each(function(i) {
            $(this).data('index', i);
        });


        var pluginConfig = {
            auto: false,
            responsive: true,
            width:'100%',
            height:'variable',
            items: {
                visible:1
            },
            scroll: {
                fx: 'slider-left',
                items:1
            },
            prev: {
                button: $prev
            },
            next: {
                button: $next
            },
            swipe: {
                onTouch: false,
                onMouse: false
            }
        };

        var pluginOptions = {
            wrapper: {
                element: 'div',
                classname:'g1-carousel'
            }
        };

        $galleryItems.carouFredSel(pluginConfig, pluginOptions);
    });
};

G1.theme.enableProgressBar = function () {
    $('.g1-progress-bar').each(function() {
        var $this = $(this);

        $this.g1ListenOn('fire', function() {
            $this.addClass('g1-animate');
        });
    });
};

G1.theme.enableNumbers = function () {
    $('.g1-numbers').each(function() {
        var $this = $(this);

        $this.g1Numbers();

        var numbers = $this.data('g1_numbers');

        $this.g1ListenOn('fire', function() {
            numbers.run();
        });
    });
};

G1.theme.enableDuplicator = function () {
    $('.g1-duplicator').each(function() {
        var $this = $(this);

        $this.g1Duplicator();

        var duplicator = $this.data('g1_duplicator');

        $this.g1ListenOn('fire', function() {
            duplicator.run();
        });
    });
};

G1.theme.setUpWoocommerce = function () {
    // prevents submit button replacing
    $('.woocommerce #commentform #submit').addClass('g1-no-replace');

    $('.g1-cartbox .widget_shopping_cart_content').each(function () {
        var $this = $(this);

        if ($this.text().length === 0) {
            var info = $this.next('.g1-cartbox__empty');

            if (info && info.length > 0) {
                $this.html(info);
            }
        }
    });

    // converts markup to use theme native tabs
    $('.woocommerce-tabs').each(function () {
        var $tabs = $(this);

        $tabs.addClass('g1-tabs g1-tabs--simple g1-type--click g1-tabs--horizontal g1-tabs--top g1-align-left');
        $tabs.find('.tabs > li > a').each(function() {
            var $a = $(this);
            var tabId = $a.attr('href').replace('#', '');

            $a.replaceWith($('<div id="'+ tabId +'" class="g1-tab-title" />').html($a.html()));
        });
        $tabs.find('.panel.entry-content').addClass('g1-tab-content');
    });
};

G1.theme.enableTabs = function() {
    $('.g1-tabs').g1Tabs();
};

G1.theme.enableCountdown = function () {
    if(jQuery.countdown){
        jQuery('.g1-countdown').each(function(){
            var countdownHandler = this;
            var countdownMetadata = jQuery('.g1-metadata', this).metadata();

            var untilDate  = new Date(
                parseInt(countdownMetadata.until_year,10),
                parseInt(countdownMetadata.until_month,10) - 1,
                parseInt(countdownMetadata.until_day,10),
                parseInt(countdownMetadata.until_hours,10),
                parseInt(countdownMetadata.until_minutes,10),
                parseInt(countdownMetadata.until_seconds,10)
            );

            /* If there is some expiry text, show it and hide countdown sections */
            var onExpiryFunction = function() {
                jQuery('.g1-countdown-expiry-text', countdownHandler).each(function() {
                    jQuery(this).show();
                    jQuery('.g1-countdown-inner', countdownHandler).remove();
                });
            };
            /* By default expiry text is hidden */
            jQuery('.g1-countdown-expiry-text', this).hide();

            /* Start countdown */
            jQuery('.g1-countdown-inner', this).countdown({
                until:          untilDate,
                alwaysExpire:   true,
                onExpiry:       onExpiryFunction
            });

        });
    }
};

G1.theme.enableToggle = function() {


    $( '.g1-toggle' ).each( function(){

        var $this = $(this);
        var $title = $this.find('.g1-toggle__title');
        var $helper = $('<span class="g1-toggle__switch"></span>');
        $helper.prepend($title.find('i[class*="fa-"]'));
        $title.prepend($helper);

        var $content = $this.find('.g1-toggle__content');

        if ( $this.hasClass( 'g1-toggle--off' ) ) {
            $content.hide();
        }

        $title.click(function() {
            // Switch toggle (from 'off' to 'on' or from 'on' to 'off' ) on mouseclick
            $this.toggleClass('g1-toggle--on g1-toggle--off');
            // Show or hide content
            $content.slideToggle();
        });
    });
};

G1.theme.enableSmoothBeforeAfterEffect = function() {
    var pointerMoveOverBeforeAndAfter = function (e) {
        e.preventDefault();

        var $this = $(this);
        var touchX = e.originalEvent.touches && e.originalEvent.touches[0] && e.originalEvent.touches[0].pageX;
        var offset = $this.offset();
        var posX = (touchX || e.pageX) - offset.left;
        posX = Math.round(posX);

        $('.g1-banda__after, .g1-banda__handle', $this).css('left', posX + 'px');
        $('.g1-banda__after img', $this).css('right', posX + 'px');
    };

    var pointerLeaveBeforeAndAfter = function () {
        var $this = $(this);
        var centerPosition = $this.width() / 2;
        var delayBeforeMoveToTheCenter = 100;
        var moveToTheCenterDuration = 200;

        $('.g1-banda__after, .g1-banda__handle', $this).
            delay(delayBeforeMoveToTheCenter).
            animate({
                'left': centerPosition
            }, moveToTheCenterDuration);

        $('.g1-banda__after img', $this).
            delay(delayBeforeMoveToTheCenter).
            animate({
                'right': centerPosition
            }, moveToTheCenterDuration);
    };

    $( '.g1-banda--smooth > .g1-fluid-wrapper > div')
        .on('mousemove touchmove touchstart', pointerMoveOverBeforeAndAfter)
        .on('mouseleave touchend', pointerLeaveBeforeAndAfter);
};

G1.theme.enableFlipBeforeAfterEffect = function() {
    $('.g1-banda--flip').each(function () {
        var $this = $(this);

        // initial state
        $this.addClass('g1-banda--before');

        $this.click(function () {
            $this.addClass('g1-banda--activated');
            $this.toggleClass('g1-banda--before g1-banda--after');
        });
    });
};

G1.theme.enableHoverBeforeAfterEffect = function() {
    $('.g1-banda--hover').each(function () {
        var $this = $(this);

        // initial state
        $this.addClass('g1-banda--before');

        $this.mouseover(function () {
            $this.toggleClass('g1-banda--before g1-banda--after');
        });

        $this.mouseout(function () {
            $this.toggleClass('g1-banda--before g1-banda--after');
        });
    });
};

G1.theme.enableBeforeAfterEffect = function() {
    G1.theme.enableSmoothBeforeAfterEffect();
    G1.theme.enableFlipBeforeAfterEffect();
    G1.theme.enableHoverBeforeAfterEffect();
};


G1.theme.relocatePreheaderElements = function() {
    var $preheader = $( '#g1-preheader' );
    var $header = $( '#g1-header' );
    var $wrapper = $( '#g1-top' );
    var $preheaderWidgetArea = $('#g1-preheader-widget-area');

    if ( $preheader.length ) {
        /**
         * The HTML code of the preheader is placed after the content and before the prefooter for SEO reasons.
         * The visual order should be different.
         */
        var openOnStartup = $('body').hasClass('g1-preheader-open-on-startup');
        var openOnStartupCookie = read_cookie('g1_preheader_open_on_startup');

        if (openOnStartupCookie !== null) {
            openOnStartup = 'true' === openOnStartupCookie;
        } else  {
            create_cookie('g1_preheader_open_on_startup', openOnStartup);
        }

        $wrapper.prepend( $preheader.detach() );
        $header.addClass( 'g1-after-preheader' );

        $preheader.show();

        /* By default preheader is collapsed */
        if(window.location.href.indexOf('preheader=on') === -1){
            if (openOnStartup) {
                $( 'body' ).addClass('g1-preheader-expanded');
            } else {
                $( 'body' ).addClass('g1-preheader-collapsed');
            }
            /* But you can expand it by adding 'preheader=on' to the query string */
        } else {

            $( 'body' ).addClass('g1-preheader-expanded');
        }

        $preheaderWidgetArea = $preheader.find( '#g1-preheader-widget-area');

        if ( $preheaderWidgetArea.length > 0 ) {
            var overlayOpenType = $('body').hasClass('g1-preheader-open-overlay');
            var $toggleButton = $('<a href="#" id="g1-preheader__switch"></a>');

            if ($('body').hasClass('g1-preheader-collapsed')) {
                $preheaderWidgetArea.hide();
            }

            $toggleButton.click(function(e){
                e.preventDefault();

                var preheaderHeight =
                    parseInt($preheader.css('margin-top'), 10) +
                    parseInt($preheader.css('padding-top'), 10) +
                    parseInt($preheader.css('border-top-width'), 10) +
                    parseInt($preheader.height(), 10) +
                    parseInt($preheader.css('border-bottom-width'), 10) +
                    parseInt($preheader.css('padding-bottom'), 10) +
                    parseInt($preheader.css('margin-bottom'), 10);

                var $emptyGap = $('<div>').attr('id', 'g1-empty-wrapper').css('height', preheaderHeight + 'px');

                var isExpanded = $('body').hasClass('g1-preheader-expanded');

                if (!isExpanded) {
                    $( 'body' ).toggleClass('g1-preheader-expanded g1-preheader-collapsed');
                    if (overlayOpenType) {
                        $preheader.after($emptyGap);
                    }
                    $preheaderWidgetArea.slideDown({
                        'easing': 'easeInOutExpo',
                        'complete': function () {
                            $('body').trigger('g1PreheaderWidgetAreaChanged');
                        }
                    });

                    create_cookie('g1_preheader_open_on_startup', $('body').hasClass('g1-preheader-expanded'));

                    G1.theme.rotateTwitterItems('#g1-preheader');
                } else {
                    $preheaderWidgetArea.slideUp({
                        'easing': 'easeInOutExpo',
                        'complete': function () {
                            $('#g1-empty-wrapper').remove();
                            $( 'body' ).toggleClass('g1-preheader-expanded g1-preheader-collapsed');
                            create_cookie('g1_preheader_open_on_startup', $('body').hasClass('g1-preheader-expanded'));
                            $('body').trigger('g1PreheaderWidgetAreaChanged');
                        }
                    });
                }

                return false;
            });

            $preheader.find('#g1-preheader-bar').prepend( $toggleButton);
        }
    }
};

G1.theme.replaceButtonsToLinks = function($scope) {
    $scope = $scope || $('#page');

    /* REPLACE SUBMIT BUTTONS WITH SOMETHING EASIER TO STYLE:) */
    $( 'input[type=submit]:not(.g1-no-replace)', $scope ).each( function() {
        var $this = $( this );

        var $a = $( '<a class="g1-button g1-button--solid g1-button--small"><span><span>' + $this.val() + '</span></span></a>' );

        $this.before( $a );
        /* Don't remove a submit button, just hide it  */
        $this.hide();

        /* Bind "click" event  */
        $a.click( function( event ) {
            event.preventDefault();

            $this.trigger( 'click' );
        });
    });
};

G1.theme.enableOpeningLinksInNewWindow = function() {
    var selectors = [
        'a[class~=g1-new-window]'
    ];
    selectors = selectors.join(',');

    $( selectors ).attr('target', '_blank');
};

/* Lightbox functions */
G1.theme.lightbox = {};

G1.theme.lightbox.enableForShortcodes = function () {
    var $items = $('a[data-g1-lightbox]');

    if ($items.length === 0) {
        return;
    }

    var buildLighboxItemFromLink = function (link, title) {
        title = title || '';

        var item;
        var isIFrame =
            (link.indexOf('youtube') !== -1) ||
            (link.indexOf('vimeo') !== -1) ||
            (link.indexOf('maps') !== -1);

        if (isIFrame) {
            item = {
                src: link,
                type: 'iframe'
            };
        } else { // image
            item = {
                src: link,
                type: 'image',
                'title': title
            };
        }

        return item;
    };

    $items.each(function() {
        var $item = $(this);
        var groupName = $item.attr('data-g1-lightbox');
        var isSingle = groupName === '' || groupName === 'single';

        $item.click(function(e) {
            e.preventDefault();

            var index = 0;
            var lightboxItems = [];

            if (isSingle) {
                var link = $item.attr('href');
                var title = $item.attr('title');

                if (!title) {
                    // check for wp gallery caption
                    var $caption = $item.parent().next('.gallery-caption');

                    if ($caption.length > 0) {
                        title = $caption.html();
                    }
                }

                if (link.length === 0) {
                    return;
                }

                lightboxItems.push(buildLighboxItemFromLink(link, title));
            } else {
                var $itemsInGroup = $('a[data-g1-lightbox="'+ groupName +'"]');

                $itemsInGroup.each(function(i) {
                    if ($(this).is($item)) {
                        index = i;
                    }

                    var link = $(this).attr('href');
                    var title = $(this).attr('title');

                    if (!title) {
                        // check for wp gallery caption
                        var $caption = $(this).parent().next('.gallery-caption');

                        if ($caption.length > 0) {
                            title = $caption.html();
                        }
                    }

                    lightboxItems.push(buildLighboxItemFromLink(link, title));
                });
            }

            G1.theme.lightbox.openLightbox(lightboxItems, index);
        });
    });
};

G1.theme.lightbox.enableForCollectionItems = function () {
    var index = 0;
    var lightboxItems = [];

    var openCollectionItemsInLightbox = function (index) {
        lightboxItems = G1.theme.lightbox.convertEmbeddedItems(lightboxItems);
        G1.theme.lightbox.openLightbox(lightboxItems, index);
    };

    $('.g1-collection article').each(function () {
        var $this = $(this);
        var isGallery = $this.parents('.g1-collection').hasClass('g1-collection--gallery');

        if (!$this.is('.format-image') && !$this.is('.format-gallery') && !$this.is('.format-audio') && !$this.is('.format-video')) {
            return;
        }

        var $media = $this.find('.entry-featured-media');

        // image
        if ($this.is('.format-image')) {
            var $link = $media.find('> a');
            var href = $link.attr('href');
            var alt = $link.find('img').attr('alt');

            // title is not set by user, image name was used instread
            if (href.indexOf(alt) !== -1) {
                alt = '';
            }

            if ($link.length > 0) {
                lightboxItems.push({
                    'src': href,
                    'type': 'image',
                    'title': alt
                });
            }
        }

        // gallery
        if ($this.is('.format-gallery')) {
            var $firstGalleryItem = $media.find('.g1-gallery-data li:first a');

            if ($firstGalleryItem.length > 0) {
                lightboxItems.push({
                    src: $firstGalleryItem.attr('href'),
                    type: 'image'
                });
            }
        }

        // audio
        if ($this.is('.format-audio')) {
            var $audioScript = $media.find('script.g1-var');

            if ($audioScript.length > 0) {
                var $audio = G1.theme.lightbox.extractHtmlCodeFromVar($audioScript.attr('id'));
                $audio.attr('id', 'lightbox-' + $audio.attr('id'));

                if ($audio !== null) {
                    lightboxItems.push({
                        src: $audio,
                        type: 'inline'
                    });
                }
            }
        }

        // video
        if ($this.is('.format-video')) {
            var $script = $media.find('script.g1-var');

            if ($script.length > 0) {
                var $video = G1.theme.lightbox.extractHtmlCodeFromVar($script.attr('id'));

                if ($video !== null) {
                    lightboxItems.push({
                        src: $video,
                        type: 'inline'
                    });
                }
            }
        }

        // open lighbox only for image, video and audio. Gallery has its own lighbox
        if (!$this.is('.format-gallery')) {
            (function (i) {
                $media.click(function (e) {
                    e.preventDefault();

                    var isDesktop = G1.isDesktop;
                    var isMobileGrid = !G1.isDesktop && !isGallery;
                    var isMobileGalleryOpened = !G1.isDesktop && isGallery && $this.hasClass('g1-on--finger');

                    if (isDesktop || isMobileGrid || isMobileGalleryOpened) {
                        openCollectionItemsInLightbox(i);
                    }
                });
            })(index);
        }

        index += 1;
    });
};

G1.theme.lightbox.enableForPostFormatGalleryCollectionItem = function () {
    $('.g1-collection .format-gallery .entry-featured-media .g1-gallery-items li, .g1-collection .format-gallery .entry-featured-media > a').click(function (e) {
        e.preventDefault();

        var $this = $(this);
        var $article = $this.parents('article');
        var isGallery = $this.parents('.g1-collection').hasClass('g1-collection--gallery');
        var wasTapped;

        if (isGallery) {
            wasTapped = $this.parents('article').hasClass('g1-on--finger');
        } else {
            wasTapped = $this.parents('.entry-featured-media').hasClass('g1-on--finger');
        }

        var isDesktop = G1.isDesktop;
        var isMobileGrid = !G1.isDesktop && !isGallery;
        var isMobileGalleryOpened = !G1.isDesktop && isGallery && wasTapped;

        if (!(isDesktop || isMobileGrid || isMobileGalleryOpened)) {
            return;
        }

        var index = $this.data('index');
        var $media = $this.parents('.entry-featured-media');
        var $lightboxItems = $media.find('.g1-gallery-data li a');

        if ($lightboxItems.length === 0) {
            return;
        }

        var items = [];

        $lightboxItems.each(function () {
            var item = {
                src: $(this).attr('href')
            };

            items.push(item);
        });

        G1.theme.lightbox.openLightbox(items, index);
    });
};

G1.theme.lightbox.enableForMediabox = function () {
    var buildLightboxItems = function ($items) {
        var items = [];

        $items.each(function () {
            var $item = $(this);

            // audio, video
            var $script = $item.find('> script.g1-var');
            if ($script.length > 0) {
                var $htmlCode = G1.theme.lightbox.extractHtmlCodeFromVar($script.attr('id'));

                if ($htmlCode.length > 0) {
                    items.push({
                        src: $htmlCode,
                        type: 'inline'
                    });
                    return;
                }
            }

            // images
            var $link = $item.find('> a');
            if ($link.length > 0) {
                items.push({
                    src: $link.attr('href'),
                    type: 'image'
                });
                return;
            }

            // other items
            items.push({
                src: $item.html(),
                type: 'inline'
            });
        });

        return items;
    };

    var mediaboxLightbox = function ($container, clickableItemsSelector) {
        var $clickableItems = $container.find(clickableItemsSelector);
        var $lightboxItems = $container.find('.g1-lightbox-data > li');

        $clickableItems.each(function (i) {
            var $clickableItem = $(this);

            (function (index) {
                $clickableItem.click(function (e) {
                    e.preventDefault();

                    var items = buildLightboxItems($lightboxItems);

                    if (items.length > 0) {
                        items = G1.theme.lightbox.convertEmbeddedItems(items);

                        G1.theme.lightbox.openLightbox(items, index);
                    }
                });
            })(i);
        });
    };

    // mediabox: slider
    $('.g1-mediabox.g1-type-simple-slider').each(function () {
        mediaboxLightbox($(this), '.g1-slides > li');
    });

    // mediabox: list
    $('.g1-mediabox.g1-type-list').each(function () {
        mediaboxLightbox($(this), '.g1-mediabox-items > li');
    });
};

G1.theme.lightbox.enableForIFrame = function () {
    $('a.g1-iframe').each(function () {
        var $this = $(this);

        $this.on('click', function(e) {
            e.stopImmediatePropagation();

            $.magnificPopup.open({
                'items': {
                    src: $this.attr('href')
                },
                type: 'iframe'
            });

            return false;
        });
    });
};

G1.theme.lightbox.enableForHtmlContent = function () {
    $('.g1-html-popup').each(function () {
        var $this = $(this);

        var contentId = $(this).attr('id').replace('for-', '');
        var $content = $('#' + contentId);

        if ($content.length > 0) {
            var $detached = $content.detach();

            $this.on('click', function (e) {
                e.stopImmediatePropagation();

                $.magnificPopup.open({
                    items: {
                        src: $detached[0].outerHTML,
                        type: 'inline'
                    }
                });

                return false;
            });
        }
    });
};

G1.theme.lightbox.convertEmbeddedItems = function (items) {
    var prepareHiddenContainer = function () {
        var $hiddenContainer = $('body').find('.g1-lightbox-hidden-container');

        if ($hiddenContainer.length === 0) {
            $hiddenContainer = $('<div>').addClass('g1-lightbox-hidden-container').css('display', 'none');
            $hiddenContainer.appendTo('body');
        }

        $hiddenContainer.empty();

        return $hiddenContainer;
    };

    var $hiddenContainer = prepareHiddenContainer();

    for (var i = 0; i < items.length; i += 1) {
        var item = items[i];

        if (typeof item.src === 'object' && item.src instanceof jQuery) {
            var $obj = item.src;

            // jPlayer audio
            if ($obj.hasClass('media-audio')) {
                $obj.appendTo($hiddenContainer);
                $obj.trigger('loadPlayer');

                items[i].src = $obj.find('.jp-audio');
            }
        }
    }

    return items;
};

G1.theme.lightbox.extractHtmlCodeFromVar = function (varId) {
    var varObject = typeof window[varId] !== 'undefined' ? window[varId] : null;

    if (varObject === null) {
        return null;
    }

    var $obj = $(varObject.html_code);

    return $obj;
};

G1.theme.lightbox.openLightbox = function (items, index) {
    if (!$.fn.magnificPopup) {
        return;
    }

    index = index || 0;

    $.magnificPopup.open({
        'items': items,
        gallery: {
            enabled: true
        },
        type: 'image'
    }, index);
};
})(jQuery);
