/*! jQuery AdaptText - v1.2.1 - 2014-09-06
* https://github.com/amazingSurge/jquery-adaptText
* Copyright (c) 2014 amazingSurge; Licensed MIT */
(function(window, document, $, undefined) {
    "use strict";

    var instances = [],
        viewportWidth = $(window).width();

    // Constructor
    var AdaptText = $.AdaptText = function(element, options) {
        this.element = element;
        this.$element = $(element);

        // options
        this.options = $.extend(true, {}, AdaptText.defaults, options, this.$element.data());

        this.width = this.$element.width();

        var self = this;
        $.extend(self, {
            init: function() {
                self.resize();

                if (self.options.scrollable) {
                    self.scrollOnHover();
                }
            },
            scrollOnHover: function() {
                self.$element.css({
                    'overflow': 'hidden',
                    'text-overflow': 'ellipsis',
                    'white-space': 'nowrap'
                });
                self.$element.hover(function() {
                    var distance = self.element.scrollWidth - self.$element.width();

                    if (distance > 0) {
                        var scrollSpeed = Math.sqrt(distance / self.width) * self.options.scrollSpeed;

                        self.$element.css('cursor', 'e-resize');
                        return self.$element.stop().animate({
                            "text-indent": -distance
                        }, scrollSpeed, function() {
                            return self.$element.css('cursor', 'text');
                        });
                    }
                }, function() {
                    return self.$element.stop().animate({
                        "text-indent": 0
                    }, self.options.scrollResetSpeed);
                });
            }
        });

        this.init();
        instances.push(this);
    };

    // Default options for the plugin as a simple object
    AdaptText.defaults = {
        compression: 10,
        max: Number.POSITIVE_INFINITY,
        min: Number.NEGATIVE_INFINITY,
        scrollable: false,
        scrollSpeed: 1000,
        scrollResetSpeed: 300,
        onResizeEvent: true
    };

    AdaptText.prototype = {
        constructor: AdaptText,

        resize: function() {
            this.width = this.$element.width();
            if (this.width === 0) {
                return;
            }

            this.$element.css('font-size', Math.floor(Math.max(
                Math.min(this.width / (this.options.compression), parseFloat(this.options.max)),
                parseFloat(this.options.min)
            )));
        },
    };

    AdaptText.resize = function(force) {
        if (!force && $(window).width() === viewportWidth) {
            return;
        }
        viewportWidth = $(window).width();

        $.each(instances, function() {
            if (this.options.onResizeEvent) {
                this.resize();
            }
        });
    };

    // Collection method.
    $.fn.adaptText = function(options) {
        if (typeof options === 'string') {
            var method = options;
            var method_arguments = Array.prototype.slice.call(arguments, 1);

            return this.each(function() {
                var api = $.data(this, 'adaptText');
                if (typeof api[method] === 'function') {
                    api[method].apply(api, method_arguments);
                }
            });
        } else {
            return this.each(function() {
                if (!$.data(this, 'adaptText')) {
                    $.data(this, 'adaptText', new AdaptText(this, options));
                }
            });
        }
    };

    var throttle = function(func, wait) {
        var _now = Date.now || function() {
            return new Date().getTime();
        };
        var context, args, result;
        var timeout = null;
        var previous = 0;
        var later = function() {
            previous = _now();
            timeout = null;
            result = func.apply(context, args);
            context = args = null;
        };
        return function() {
            var now = _now();
            var remaining = wait - (now - previous);
            context = this;
            args = arguments;
            if (remaining <= 0) {
                clearTimeout(timeout);
                timeout = null;
                previous = now;
                result = func.apply(context, args);
                context = args = null;
            } else if (!timeout) {
                timeout = setTimeout(later, remaining);
            }
            return result;
        };
    };

    if (window.addEventListener) {
        window.addEventListener("resize", throttle(AdaptText.resize, 200), false);
    } else if (window.attachEvent) {
        window.attachEvent("onresize", throttle(AdaptText.resize, 200));
    }
}(window, document, jQuery));
