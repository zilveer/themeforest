
/*
 Plugin Name: 	BrowserSelector
 Written by: 	Okler Themes - (http://www.okler.net)
 Version: 		4.9.1
 */

(function($) {
    $.extend({

        browserSelector: function() {

            // jQuery.browser.mobile (http://detectmobilebrowser.com/)
            (function(a){(jQuery.browser=jQuery.browser||{}).mobile=/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))})(navigator.userAgent||navigator.vendor||window.opera);

            // Touch
            var hasTouch = 'ontouchstart' in window || navigator.msMaxTouchPoints;

            var u = navigator.userAgent,
                ua = u.toLowerCase(),
                is = function (t) {
                    return ua.indexOf(t) > -1;
                },
                g = 'gecko',
                w = 'webkit',
                s = 'safari',
                o = 'opera',
                h = document.documentElement,
                b = [(!(/opera|webtv/i.test(ua)) && /msie\s(\d)/.test(ua)) ? ('ie ie' + parseFloat(navigator.appVersion.split("MSIE")[1])) : is('firefox/2') ? g + ' ff2' : is('firefox/3.5') ? g + ' ff3 ff3_5' : is('firefox/3') ? g + ' ff3' : is('gecko/') ? g : is('opera') ? o + (/version\/(\d+)/.test(ua) ? ' ' + o + RegExp.jQuery1 : (/opera(\s|\/)(\d+)/.test(ua) ? ' ' + o + RegExp.jQuery2 : '')) : is('konqueror') ? 'konqueror' : is('chrome') ? w + ' chrome' : is('iron') ? w + ' iron' : is('applewebkit/') ? w + ' ' + s + (/version\/(\d+)/.test(ua) ? ' ' + s + RegExp.jQuery1 : '') : is('mozilla/') ? g : '', is('j2me') ? 'mobile' : is('iphone') ? 'iphone' : is('ipod') ? 'ipod' : is('mac') ? 'mac' : is('darwin') ? 'mac' : is('webtv') ? 'webtv' : is('win') ? 'win' : is('freebsd') ? 'freebsd' : (is('x11') || is('linux')) ? 'linux' : '', 'js'];

            c = b.join(' ');

            if ($.browser.mobile) {
                c += ' mobile';
            }

            if (hasTouch) {
                c += ' touch';
            }

            h.className += ' ' + c;

            // IE11 Detect
            var isIE11 = !(window.ActiveXObject) && "ActiveXObject" in window;

            if (isIE11) {
                $('html').removeClass('gecko').addClass('ie ie11');
                return;
            }
        }

    });

    $.browserSelector();

})(jQuery);

/*
 Plugin Name: 	waitForImages
 Written by: 	https://github.com/alexanderdickson/waitForImages
 */

/*! waitForImages jQuery Plugin - v2.0.2 - 2015-05-05
 * https://github.com/alexanderdickson/waitForImages
 * Copyright (c) 2015 Alex Dickson; Licensed MIT */
;(function (factory) {
    if (typeof define === 'function' && define.amd) {
        // AMD. Register as an anonymous module.
        define(['jquery'], factory);
    } else if (typeof exports === 'object') {
        // CommonJS / nodejs module
        module.exports = factory(require('jquery'));
    } else {
        // Browser globals
        factory(jQuery);
    }
}(function ($) {
    // Namespace all events.
    var eventNamespace = 'waitForImages';

    // CSS properties which contain references to images.
    $.waitForImages = {
        hasImageProperties: [
            'backgroundImage',
            'listStyleImage',
            'borderImage',
            'borderCornerImage',
            'cursor'
        ],
        hasImageAttributes: ['srcset']
    };

    // Custom selector to find `img` elements that have a valid `src`
    // attribute and have not already loaded.
    $.expr[':'].uncached = function (obj) {
        // Ensure we are dealing with an `img` element with a valid
        // `src` attribute.
        if (!$(obj).is('img[src][src!=""]')) {
            return false;
        }

        return !obj.complete;
    };

    $.fn.waitForImages = function () {

        var allImgsLength = 0;
        var allImgsLoaded = 0;
        var deferred = $.Deferred();

        var finishedCallback;
        var eachCallback;
        var waitForAll;

        // Handle options object (if passed).
        if ($.isPlainObject(arguments[0])) {

            waitForAll = arguments[0].waitForAll;
            eachCallback = arguments[0].each;
            finishedCallback = arguments[0].finished;

        } else {

            // Handle if using deferred object and only one param was passed in.
            if (arguments.length === 1 && $.type(arguments[0]) === 'boolean') {
                waitForAll = arguments[0];
            } else {
                finishedCallback = arguments[0];
                eachCallback = arguments[1];
                waitForAll = arguments[2];
            }

        }

        // Handle missing callbacks.
        finishedCallback = finishedCallback || $.noop;
        eachCallback = eachCallback || $.noop;

        // Convert waitForAll to Boolean
        waitForAll = !! waitForAll;

        // Ensure callbacks are functions.
        if (!$.isFunction(finishedCallback) || !$.isFunction(eachCallback)) {
            throw new TypeError('An invalid callback was supplied.');
        }

        this.each(function () {
            // Build a list of all imgs, dependent on what images will
            // be considered.
            var obj = $(this);
            var allImgs = [];
            // CSS properties which may contain an image.
            var hasImgProperties = $.waitForImages.hasImageProperties || [];
            // Element attributes which may contain an image.
            var hasImageAttributes = $.waitForImages.hasImageAttributes || [];
            // To match `url()` references.
            // Spec: http://www.w3.org/TR/CSS2/syndata.html#value-def-uri
            var matchUrl = /url\(\s*(['"]?)(.*?)\1\s*\)/g;

            if (waitForAll) {

                // Get all elements (including the original), as any one of
                // them could have a background image.
                obj.find('*').addBack().each(function () {
                    var element = $(this);

                    // If an `img` element, add it. But keep iterating in
                    // case it has a background image too.
                    if (element.is('img:uncached')) {
                        allImgs.push({
                            src: element.attr('src'),
                            element: element[0]
                        });
                    }

                    $.each(hasImgProperties, function (i, property) {
                        var propertyValue = element.css(property);
                        var match;

                        // If it doesn't contain this property, skip.
                        if (!propertyValue) {
                            return true;
                        }

                        // Get all url() of this element.
                        while (match = matchUrl.exec(propertyValue)) {
                            allImgs.push({
                                src: match[2],
                                element: element[0]
                            });
                        }
                    });

                    $.each(hasImageAttributes, function (i, attribute) {
                        var attributeValue = element.attr(attribute);
                        var attributeValues;

                        // If it doesn't contain this property, skip.
                        if (!attributeValue) {
                            return true;
                        }

                        // Check for multiple comma separated images
                        attributeValues = attributeValue.split(',');

                        $.each(attributeValues, function(i, value) {
                            // Trim value and get string before first
                            // whitespace (for use with srcset).
                            value = $.trim(value).split(' ')[0];
                            allImgs.push({
                                src: value,
                                element: element[0]
                            });
                        });
                    });
                });
            } else {
                // For images only, the task is simpler.
                obj.find('img:uncached')
                    .each(function () {
                        allImgs.push({
                            src: this.src,
                            element: this
                        });
                    });
            }

            allImgsLength = allImgs.length;
            allImgsLoaded = 0;

            // If no images found, don't bother.
            if (allImgsLength === 0) {
                finishedCallback.call(obj[0]);
                deferred.resolveWith(obj[0]);
            }

            $.each(allImgs, function (i, img) {

                var image = new Image();
                var events =
                    'load.' + eventNamespace + ' error.' + eventNamespace;

                // Handle the image loading and error with the same callback.
                $(image).one(events, function me (event) {
                    // If an error occurred with loading the image, set the
                    // third argument accordingly.
                    var eachArguments = [
                        allImgsLoaded,
                        allImgsLength,
                        event.type == 'load'
                    ];
                    allImgsLoaded++;

                    eachCallback.apply(img.element, eachArguments);
                    deferred.notifyWith(img.element, eachArguments);

                    // Unbind the event listeners. I use this in addition to
                    // `one` as one of those events won't be called (either
                    // 'load' or 'error' will be called).
                    $(this).off(events, me);

                    if (allImgsLoaded == allImgsLength) {
                        finishedCallback.call(obj[0]);
                        deferred.resolveWith(obj[0]);
                        return false;
                    }

                });

                image.src = img.src;
            });
        });

        return deferred.promise();

    };
}));

/*!
 * Lightweight URL manipulation with JavaScript
 * This library is independent of any other libraries and has pretty simple
 * interface and lightweight code-base.
 * Some ideas of query string parsing had been taken from Jan Wolter
 * @see http://unixpapa.com/js/querystring.html
 *
 * @license MIT
 * @author Mykhailo Stadnyk <mikhus@gmail.com>
 */
(function (ns) {
    'use strict';

    // mapping between what we want and <a> element properties
    var map = {
        protocol: 'protocol',
        host: 'hostname',
        port: 'port',
        path: 'pathname',
        query: 'search',
        hash: 'hash'
    };

    // jscs: disable
    /**
     * default ports as defined by http://url.spec.whatwg.org/#default-port
     * We need them to fix IE behavior, @see https://github.com/Mikhus/jsurl/issues/2
     */
    // jscs: enable
    var defaultPorts = {
        ftp: 21,
        gopher: 70,
        http: 80,
        https: 443,
        ws: 80,
        wss: 443
    };

    function parse (self, url) {
        var currUrl, link, i, auth;

        if (typeof document === 'undefined' && typeof require === 'function') {
            currUrl = 'file://' +
                (process.platform.match(/^win/i) ? '/' : '') +
                require('fs').realpathSync('.');

            if (url && url.charAt(0) !== '/' && !url.match(/^\w+:\/\//)) {
                url = currUrl + require('path').sep + url;
            }

            link = require('url').parse(url || currUrl);
        }

        else {
            currUrl = document.location.href;
            link = document.createElement('a');
            link.href = url || currUrl;
        }

        auth = (url || currUrl).match(/\/\/(.*?)(?::(.*?))?@/) || [];

        for (i in map) {
            self[i] = link[map[i]] || '';
        }

        // fix-up some parts
        self.protocol = self.protocol.replace(/:$/, '');
        self.query = self.query.replace(/^\?/, '');
        self.hash = decode(self.hash.replace(/^#/, ''));
        self.user = decode(auth[1] || '');
        self.pass = decode(auth[2] || '');
        self.port = (
            // loosely compare because port can be a string
            defaultPorts[self.protocol] == self.port || self.port == 0
            ) ? '' : self.port; // IE fix, Android browser fix

        if (!self.protocol && !/^([a-z]+:)?\/\/\/?/.test(url)) {
            // is IE and path is relative
            var base = new Url(currUrl.match(/(.*\/)/)[0]);
            var basePath = base.path.split('/');
            var selfPath = self.path.split('/');
            var props = ['protocol', 'user', 'pass', 'host', 'port'];
            var s = props.length;

            basePath.pop();

            for (i = 0; i < s; i++) {
                self[props[i]] = base[props[i]];
            }

            while (selfPath[0] == '..') { // skip all "../
                basePath.pop();
                selfPath.shift();
            }

            self.path =
                (url.charAt(0) != '/' ? basePath.join('/') : '') +
                    '/' + selfPath.join('/')
            ;
        }

        else {
            // fix absolute URL's path in IE
            self.path = self.path.replace(/^\/?/, '/');
        }

        self.paths((self.path.charAt(0) == '/' ?
            self.path.slice(1) : self.path).split('/')
        );

        self.query = new QueryString(self.query);
    }

    function encode (s) {
        return encodeURIComponent(s).replace(/'/g, '%27');
    }

    function decode (s) {
        s = s.replace(/\+/g, ' ');

        s = s.replace(/%([ef][0-9a-f])%([89ab][0-9a-f])%([89ab][0-9a-f])/gi,
            function (code, hex1, hex2, hex3) {
                var n1 = parseInt(hex1, 16) - 0xE0;
                var n2 = parseInt(hex2, 16) - 0x80;

                if (n1 === 0 && n2 < 32) {
                    return code;
                }

                var n3 = parseInt(hex3, 16) - 0x80;
                var n = (n1 << 12) + (n2 << 6) + n3;

                if (n > 0xFFFF) {
                    return code;
                }

                return String.fromCharCode(n);
            }
        );

        s = s.replace(/%([cd][0-9a-f])%([89ab][0-9a-f])/gi,
            function (code, hex1, hex2) {
                var n1 = parseInt(hex1, 16) - 0xC0;

                if (n1 < 2) {
                    return code;
                }

                var n2 = parseInt(hex2, 16) - 0x80;

                return String.fromCharCode((n1 << 6) + n2);
            }
        );

        return s.replace(/%([0-7][0-9a-f])/gi,
            function (code, hex) {
                return String.fromCharCode(parseInt(hex, 16));
            }
        );
    }

    /**
     * Class QueryString
     *
     * @param {string} qs - string representation of QueryString
     * @constructor
     */
    function QueryString (qs) {
        var re = /([^=&]+)(=([^&]*))?/g;
        var match;

        while ((match = re.exec(qs))) {
            var key = decodeURIComponent(match[1].replace(/\+/g, ' '));
            var value = match[3] ? decode(match[3]) : '';

            if (!(this[key] === undefined || this[key] === null)) {
                if (!(this[key] instanceof Array)) {
                    this[key] = [this[key]];
                }

                this[key].push(value);
            }

            else {
                this[key] = value;
            }
        }
    }

    /**
     * Converts QueryString object back to string representation
     *
     * @returns {string}
     */
    QueryString.prototype.toString = function () {
        var s = '';
        var e = encode;
        var i, ii;

        for (i in this) {
            if (this[i] instanceof Function || this[i] === null) {
                continue;
            }

            if (this[i] instanceof Array) {
                var len = this[i].length;

                if (len) {
                    for (ii = 0; ii < len; ii++) {
                        s += s ? '&' : '';
                        s += e(i) + '=' + e(this[i][ii]);
                    }
                }

                else {
                    // parameter is an empty array, so treat as
                    // an empty argument
                    s += (s ? '&' : '') + e(i) + '=';
                }
            }

            else {
                s += s ? '&' : '';
                s += e(i) + '=' + e(this[i]);
            }
        }

        return s;
    };

    /**
     * Class Url
     *
     * @param {string} [url] - string URL representation
     * @constructor
     */
    function Url (url) {
        parse(this, url);
    }

    /**
     * Clears QueryString, making it contain no params at all
     *
     * @returns {Url}
     */
    Url.prototype.clearQuery = function () {
        for (var key in this.query) {
            if (!(this.query[key] instanceof Function)) {
                delete this.query[key];
            }
        }

        return this;
    };

    /**
     * Returns total number of parameters in QueryString
     *
     * @returns {number}
     */
    Url.prototype.queryLength = function () {
        var count = 0;
        var key;

        for (key in this) {
            if (!(this[key] instanceof Function)) {
                count++;
            }
        }

        return count;
    };

    /**
     * Returns true if QueryString contains no parameters, false otherwise
     *
     * @returns {boolean}
     */
    Url.prototype.isEmptyQuery = function () {
        return this.queryLength() === 0;
    };

    /**
     *
     * @param {Array} [paths] - an array pf path parts (if given will modify
     *                          Url.path property
     * @returns {Array} - an array representation of the Url.path property
     */
    Url.prototype.paths = function (paths) {
        var prefix = '';
        var i = 0;
        var s;

        if (paths && paths.length && paths + '' !== paths) {
            if (this.isAbsolute()) {
                prefix = '/';
            }

            for (s = paths.length; i < s; i++) {
                paths[i] = !i && paths[i].match(/^\w:$/) ? paths[i] :
                    encode(paths[i]);
            }

            this.path = prefix + paths.join('/');
        }

        paths = (this.path.charAt(0) === '/' ?
            this.path.slice(1) : this.path).split('/');

        for (i = 0, s = paths.length; i < s; i++) {
            paths[i] = decode(paths[i]);
        }

        return paths;
    };

    /**
     * Performs URL-specific encoding of the given string
     *
     * @method Url#encode
     * @param {string} s - string to encode
     * @returns {string}
     */
    Url.prototype.encode = encode;

    /**
     * Performs URL-specific decoding of the given encoded string
     *
     * @method Url#decode
     * @param {string} s - string to decode
     * @returns {string}
     */
    Url.prototype.decode = decode;

    /**
     * Checks if current URL is an absolute resource locator (globally absolute
     * or absolute path to current server)
     *
     * @returns {boolean}
     */
    Url.prototype.isAbsolute = function () {
        return this.protocol || this.path.charAt(0) === '/';
    };

    /**
     * Returns string representation of current Url object
     *
     * @returns {string}
     */
    Url.prototype.toString = function () {
        return (
            (this.protocol && (this.protocol + '://')) +
                (this.user && (
                    encode(this.user) + (this.pass && (':' + encode(this.pass))
                        ) + '@')) +
                (this.host && this.host) +
                (this.port && (':' + this.port)) +
                (this.path && this.path) +
                (this.query.toString() && ('?' + this.query)) +
                (this.hash && ('#' + encode(this.hash)))
            );
    };

    ns[ns.exports ? 'exports' : 'Url'] = Url;
}(typeof module !== 'undefined' && module.exports ? module : window));

// check browser language
var RtlDetectLib = {

    // Private functions - star
    _escapeRegExpPattern: function (str) {
        if (typeof str !== 'string') {
            return str;
        }
        return str.replace(/([\.\*\+\^\$\[\]\\\(\)\|\{\}\,\-\:\?])/g, '\\$1');
    },
    _toLowerCase: function (str, reserveReturnValue) {
        if (typeof str !== 'string') {
            return reserveReturnValue && str;
        }
        return str.toLowerCase();
    },
    _toUpperCase: function (str, reserveReturnValue) {
        if (typeof str !== 'string') {
            return reserveReturnValue && str;
        }
        return str.toUpperCase();
    },
    _trim: function (str, delimiter, reserveReturnValue) {
        var patterns = [],
            self = this,
            regexp,
            addPatterns = function (pattern) {
                // Build trim RegExp pattern and push it to patterns array
                patterns.push('^' + pattern + '+|' + pattern + '+$');
            };

        // fix reserveReturnValue value
        if (typeof delimiter === 'boolean') {
            reserveReturnValue = delimiter;
            delimiter = null;
        }

        if (typeof str !== 'string') {
            return reserveReturnValue && str;
        }

        // Trim based on delimiter array values
        if (Array.isArray(delimiter)) {
            // Loop through delimiter array
            delimiter.map(function(item) {
                // Escape delimiter to be valid RegExp Pattern
                var pattern = self._escapeRegExpPattern(item);
                // Push pattern to patterns array
                addPatterns(pattern);
            });
        }

        // Trim based on delimiter string value
        if (typeof delimiter === 'string') {
            // Escape delimiter to be valid RegExp Pattern
            var patternDelimiter = self._escapeRegExpPattern(delimiter);
            // push pattern to patterns array
            addPatterns(patternDelimiter);
        }

        // If delimiter  is not defined, Trim white spaces
        if (!delimiter) {
            // Push white space pattern to patterns array
            addPatterns('\\s');
        }

        // Build RegExp pattern
        var pattern = '(' + patterns.join('|') + ')';
        // Build RegExp object
        regexp = new RegExp(pattern, 'g');

        // trim string for all patterns
        while(str.match(regexp)) {
            str = str.replace(regexp, '');
        }

        // Return trim string
        return str;
    },

    _parseLocale : function (strLocale) {
        // parse locale regex object
        var self = this,
            regex = /^([a-zA-Z]*)([_\-a-zA-Z]*)$/,
            matches =  regex.exec(strLocale), // exec regex
            parsedLocale,
            lang,
            countryCode;

        if (!strLocale || !matches) {
            return;
        }

        // fix countryCode string by trimming '-' and '_'
        matches[2] = self._trim(matches[2], ['-', '_']);

        lang = self._toLowerCase(matches[1]);
        countryCode = self._toUpperCase(matches[2]) || countryCode;

        // object with lang, countryCode properties
        parsedLocale = {
            lang: lang,
            countryCode: countryCode
        };

        // return parsed locale object
        return parsedLocale;
    },
    // Private functions - End

    // Public functions - star
    isRtlLang: function (strLocale) {
        var self = this, objLocale = self._parseLocale(strLocale);
        if (!objLocale) {
            return;
        }
        // return true if the intel string lang exists in the BID RTL LANGS array else return false
        return (self._BIDI_RTL_LANGS.indexOf(objLocale.lang) >= 0);
    },

    getLangDir: function (strLocale) {
        var self = this;
        // return 'rtl' if the intel string lang exists in the BID RTL LANGS array else return 'ltr'
        return self.isRtlLang(strLocale) ? 'rtl' : 'ltr';
    }

    // Public functions - End
};

// Const BIDI_RTL_LANGS Array
// BIDI_RTL_LANGS ref: http://en.wikipedia.org/wiki/Right-to-left
Object.defineProperty(RtlDetectLib, '_BIDI_RTL_LANGS', {
    value: [
        'ar', /* 'العربية', Arabic */
        'arc', /* Aramaic */
        'bcc', /* 'بلوچی مکرانی', Southern Balochi */
        'bqi', /* 'بختياري', Bakthiari */
        'ckb', /* 'Soranî / کوردی', Sorani */
        'dv', /* Dhivehi */
        'fa', /* 'فارسی', Persian */
        'glk', /* 'گیلکی', Gilaki */
        'he', /* 'עברית', Hebrew */
        'ku', /* 'Kurdî / كوردی', Kurdish */
        'mzn', /* 'مازِرونی', Mazanderani */
        'pnb', /* 'پنجابی', Western Punjabi */
        'ps', /* 'پښتو', Pashto, */
        'sd', /* 'سنڌي', Sindhi */
        'ug', /* 'Uyghurche / ئۇيغۇرچە', Uyghur */
        'ur', /* 'اردو', Urdu */
        'yi' /* 'ייִדיש', Yiddish */
    ],
    writable: false,
    enumerable: true,
    configurable: false
});

(function($) {
    if (RtlDetectLib.isRtlLang(window.navigator.userLanguage || window.navigator.language)) {
        $('html').addClass('browser-rtl');
    }
}).apply(this, [jQuery]);


/*
 Name: Porto Theme Javascript
 Writtern By: SW-THEMES
 Javascript Version: 1.2
 */

// Theme
window.theme = {};

// Configuration
(function(theme, $) {

    theme = theme || {};

    $.extend(theme, {

        rtl: js_porto_vars.rtl == '1' ? true : false,
        rtl_browser: $('html').hasClass('browser-rtl'),

        ajax_url: js_porto_vars.ajax_url,
        request_error: js_porto_vars.request_error,

        change_logo: js_porto_vars.change_logo == '1' ? true : false,

        show_sticky_header: js_porto_vars.show_sticky_header == '1' ? true : false,
        show_sticky_header_tablet: js_porto_vars.show_sticky_header_tablet == '1' ? true : false,
        show_sticky_header_mobile: js_porto_vars.show_sticky_header_mobile == '1' ? true : false,

        category_ajax: js_porto_vars.category_ajax == '1' ? true : false,
        prdctfltr_ajax: js_porto_vars.prdctfltr_ajax == '1' ? true : false,
        show_minicart: js_porto_vars.show_minicart == '1' ? true : false,

        container_width: parseInt(js_porto_vars.container_width),
        grid_gutter_width: parseInt(js_porto_vars.grid_gutter_width),
        screen_lg: parseInt(js_porto_vars.screen_lg),
        slider_loop: js_porto_vars.slider_loop == '1' ? true : false,
        slider_autoplay: js_porto_vars.slider_autoplay == '1' ? true : false,
        slider_autoheight: js_porto_vars.slider_autoheight == '1' ? true : false,
        slider_speed: js_porto_vars.slider_speed ? js_porto_vars.slider_speed : 5000,
        slider_nav: js_porto_vars.slider_nav == '1' ? true : false,
        slider_nav_hover: js_porto_vars.slider_nav_hover == '1' ? true : false,
        slider_margin: js_porto_vars.slider_margin == '1' ? 40 : 0,
        slider_dots: js_porto_vars.slider_dots == '1' ? true : false,
        slider_animatein: js_porto_vars.slider_animatein ? js_porto_vars.slider_animatein : '',
        slider_animateout: js_porto_vars.slider_animateout ? js_porto_vars.slider_animateout : '',
        product_thumbs_count: js_porto_vars.product_thumbs_count ? js_porto_vars.product_thumbs_count : 4,
        product_zoom: js_porto_vars.product_zoom == '1' ? true : false,
        product_zoom_mobile: js_porto_vars.product_zoom_mobile == '1' ? true : false,
        product_image_popup: js_porto_vars.product_image_popup == '1' ? 'fadeOut' : false,

        hoverIntentConfig: {
            sensitivity: 2,
            interval: 0,
            timeout: 0
        },

        owlConfig: {
            rtl: js_porto_vars.rtl == '1' ? true : false,
            loop : js_porto_vars.slider_loop == '1' ? true : false,
            autoplay : js_porto_vars.slider_autoplay == '1' ? true : false,
            autoHeight : js_porto_vars.slider_autoheight == '1' ? true : false,
            autoplayTimeout: js_porto_vars.slider_speed ? js_porto_vars.slider_speed : 5000,
            autoplayHoverPause : true,
            lazyLoad: true,
            nav: js_porto_vars.slider_nav == '1' ? true : false,
            navText: ["", ""],
            dots: js_porto_vars.slider_dots == '1' ? true : false,
            stagePadding: (js_porto_vars.slider_nav_hover != '1' && js_porto_vars.slider_margin == '1') ? 40 : 0,
            animateOut: js_porto_vars.slider_animateout ? js_porto_vars.slider_animateout : '',
            animateIn: js_porto_vars.slider_animatein ? js_porto_vars.slider_animatein : ''
        },

        mfpConfig: {
            tClose: js_porto_vars.popup_close,
            tLoading: '<div class="porto-ajax-loading"></div>',
            gallery: {
                tPrev: js_porto_vars.popup_prev,
                tNext: js_porto_vars.popup_next,
                tCounter: js_porto_vars.mfp_counter
            },
            image: {
                tError: js_porto_vars.mfp_img_error
            },
            ajax: {
                tError: js_porto_vars.mfp_ajax_error
            },
            callbacks: {
                open: function() {
                    $('body').addClass('lightbox-opened');
                    var fixed = this.st.fixedContentPos;
                    if (fixed) {
                        $('#header.sticky-header .header-main.sticky, #header.sticky-header .main-menu-wrap, .fixed-header #header.sticky-header .header-main, .fixed-header #header.sticky-header .main-menu-wrap').css(theme.rtl_browser?'left':'right', theme.getScrollbarWidth());
                    }
                },
                close: function() {
                    $('body').removeClass('lightbox-opened');
                    var fixed = this.st.fixedContentPos;
                    if (fixed) {
                        $('#header.sticky-header .header-main.sticky, #header.sticky-header .main-menu-wrap, .fixed-header #header.sticky-header .header-main, .fixed-header #header.sticky-header .main-menu-wrap').css(theme.rtl_browser?'left':'right', '');
                    }
                    $('.owl-carousel .owl-stage').each(function() {
                        var $this = $(this),
                            w = $this.width() + parseInt($this.css('padding-left')) + parseInt($this.css('padding-right'));

                        $this.css({'width': w + 200});
                        setTimeout(function() {
                            $this.css({'width': w});
                        }, 0);
                    });
                }
            }
        },

        infiniteConfig: {
            navSelector  : "div.pagination",
            nextSelector : "div.pagination a.next",
            loading      : {
                finishedMsg: "",
                msgText: "<em class='infinite-loading'></em>",
                img: "data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
            }
        },

        sticky_nav_height: 0,

        getScrollbarWidth: function() {
            // thx David
            if (this.scrollbarSize === undefined) {
                var scrollDiv = document.createElement("div");
                scrollDiv.style.cssText = 'width: 99px; height: 99px; overflow: scroll; position: absolute; top: -9999px;';
                document.body.appendChild(scrollDiv);
                this.scrollbarSize = scrollDiv.offsetWidth - scrollDiv.clientWidth;
                document.body.removeChild(scrollDiv);
            }
            return this.scrollbarSize;
        },

        isTablet: function() {
            if ($(window).width() < 992 - theme.getScrollbarWidth())
                return true;
            return false;
        },

        isMobile: function() {
            if ($(window).width() <= 480 - theme.getScrollbarWidth())
                return true;
            return false;
        },

        refreshVCContent: function($elements) {
            if ($elements) {
//                var panel = $elements,
//                    $pie_charts = panel.find( '.vc_pie_chart:not(.vc_ready)' ),
//                    $round_charts = panel.find( '.vc_round-chart' ),
//                    $line_charts = panel.find( '.vc_line-chart' ),
//                    $carousel = panel.find( '[data-ride="vc_carousel"]' ),
//                    $stats = panel.find( '.stats-block' ),
//                    $ui_panel, $google_maps;
//
//                if ( 'function' === typeof(window[ 'vc_carouselBehaviour' ]) ) {
//                    vc_carouselBehaviour();
//                }
//                if ( 'function' === typeof(window[ 'vc_plugin_flexslider' ]) ) {
//                    vc_plugin_flexslider( panel );
//                }
//                if ( panel.find( '.vc_masonry_media_grid, .vc_masonry_grid' ).length ) {
//                    panel.find( '.vc_masonry_media_grid, .vc_masonry_grid' ).each( function () {
//                        var grid = $( this ).data( 'vcGrid' );
//                        grid && grid.gridBuilder && grid.gridBuilder.setMasonry && grid.gridBuilder.setMasonry();
//                    } );
//                }
//                $pie_charts.length && $.fn.vcChat && $pie_charts.vcChat();
//                $round_charts.length && $.fn.vcRoundChart && $round_charts.vcRoundChart( { reload: false } );
//                $line_charts.length && $.fn.vcLineChart && $line_charts.vcLineChart( { reload: false } );
//                $carousel.length && $.fn.carousel && $carousel.carousel( 'resizeAction' );
//                $ui_panel = panel.find( '.isotope, .wpb_image_grid_ul' ); // why var name '$ui_panel'?
//                $google_maps = panel.find( '.wpb_gmaps_widget' );
//                if ( 0 < $ui_panel.length ) {
//                    $ui_panel.isotope( "layout" );
//                }
//                if ( $google_maps.length && ! $google_maps.is( '.map_ready' ) ) {
//                    var $frame = $google_maps.find( 'iframe' );
//                    $frame.attr( 'src', $frame.attr( 'src' ) );
//                    $google_maps.addClass( 'map_ready' );
//                }
//                if ( panel.parents( '.isotope' ).length ) {
//                    panel.parents( '.isotope' ).each( function () {
//                        $( this ).isotope( "layout" );
//                    } );
//                }
                var $stats = $elements.find( '.stats-block' );
                $stats.each(function() {
                    $(this).appear(function() {
                        var endNum = parseFloat($(this).find('.stats-number').data('counter-value'));
                        var Num = ($(this).find('.stats-number').data('counter-value'))+' ';
                        var speed = parseInt($(this).find('.stats-number').data('speed'));
                        var ID = $(this).find('.stats-number').data('id');
                        var sep = $(this).find('.stats-number').data('separator');
                        var dec = $(this).find('.stats-number').data('decimal');
                        var dec_count = Num.split(".");
                        if(dec_count[1]){
                            dec_count = dec_count[1].length-1;
                        } else {
                            dec_count = 0;
                        }
                        var grouping = true;
                        if(dec == "none"){
                            dec = "";
                        }
                        if(sep == "none"){
                            grouping = false;
                        } else {
                            grouping = true;
                        }
                        var settings = {
                            useEasing : true,
                            useGrouping : grouping,
                            separator : sep,
                            decimal : dec
                        }
                        var counter = new countUp(ID, 0, endNum, dec_count, speed, settings);
                        counter.start();
                    }, {
                        accX: 0,
                        accY: -150
                    });
                });
            }
            theme.refreshStickySidebar(true);

            if (typeof window.vc_js == 'function')
                window.vc_js();

//            if ("undefined" != typeof $.fn.waypoint) {
//                if (typeof window.vc_waypoints == 'function')
//                    window.vc_waypoints();
//                if (typeof window.vc_progress_bar == 'function')
//                    window.vc_progress_bar();
//            }
        },

        adminBarHeight: function() {
            var $admin_bar = $('#wpadminbar'),
                adminbar_height = 0;

            if ($admin_bar.get(0)) {
                adminbar_height = $('#wpadminbar').css('position') == 'fixed' ? $('#wpadminbar').height() : 0;
            }

            return parseInt(adminbar_height);
        },

        refreshStickySidebar: function(timeout) {
            var $sticky_sidebar = $('.sidebar [data-plugin-sticky]');
            if ($sticky_sidebar.get(0)) {
                if (timeout) {
                    setTimeout(function() {
                        $sticky_sidebar.trigger('recalc.pin');
                    }, 400);
                } else {
                    $sticky_sidebar.trigger('recalc.pin');
                }
            }
        },

        scrolltoContainer: function( $container ) {
            if ($container.get(0)) {
                var winWidth = $(window).width();
                if (winWidth <= 991 - theme.getScrollbarWidth()) {
                    $('.sidebar-overlay').click();
                }
                $('html, body').stop().animate({
                    scrollTop: $container.offset().top - theme.StickyHeader.sticky_height - theme.adminBarHeight() - theme.sticky_nav_height - 18
                }, 600, 'easeOutQuad');
            }
        }
    });

}).apply(this, [window.theme, jQuery]);


// Theme Functions
function portoCalcSliderMargin($parent, padding) {
    $parent.css({
        'margin-left': '-' + padding,
        'margin-right': '-' + padding
    });
}

function portoCalcSliderButtonsPosition($parent, padding) {
    var $buttons = $parent.find('.show-nav-title .owl-nav');
    if ($buttons.length) {
        if (window.theme.rtl) {
            $buttons.css('left', padding);
        } else {
            $buttons.css('right', padding);
        }
    }
}

function portoCalcSliderTitleLine($parent) {
    var c_w = $parent.width();
    var $title = $parent.parent().find('.slider-title');
    if (!$title.length) return;

    var $l = $title.find('.line');
    var $t = $title.find('.inline-title');

    if (!$t.length || !$l.length) return;

    var title_w = $title.width();
    var t_w = $t.width();
    if (title_w > t_w + 200) {
        if (window.theme.rtl) {
            $l.css({
                display: 'block',
                right: t_w + 20,
                width: title_w - t_w - 75
            });
        } else {
            $l.css({
                display: 'block',
                left: t_w + 20,
                width: title_w - t_w - 75
            });
        }
    } else {
        $l.css({
            display: 'none'
        });
    }
}



// Accordion
(function(theme, $) {

    theme = theme || {};

    var instanceName = '__accordion';

    var Accordion = function($el, opts) {
        return this.initialize($el, opts);
    };

    Accordion.defaults = {

    };

    Accordion.prototype = {
        initialize: function($el, opts) {
            if ($el.data(instanceName)) {
                return this;
            }

            this.$el = $el;

            this
                .setData()
                .setOptions(opts)
                .build();

            return this;
        },

        setData: function() {
            this.$el.data(instanceName, this);

            return this;
        },

        setOptions: function(opts) {
            this.options = $.extend(true, {}, Accordion.defaults, opts, {
                wrapper: this.$el
            });

            return this;
        },

        build: function() {
            if (!($.isFunction($.fn.collapse))) {
                return this;
            }

            var self = this,
                $el = this.options.wrapper,
                $collapse = $el.find('.collapse'),
                collapsible = $el.data('collapsible'),
                active_num = $el.data('active-tab');

            if ( $collapse.length > 0 ) {
                if ( collapsible == 'yes' ) {
                    $collapse.collapse({toggle: false, parent: '#' + $el.attr('id')});
                } else if ( !isNaN(active_num) && active_num == parseInt(active_num) && $el.find('.collapse').length > active_num ) {
                    $el.find('.collapse').collapse({toggle: false, parent: '#' + $el.attr('id')});
                    $el.find('.collapse').eq(active_num-1).collapse('toggle');
                } else {
                    $el.find('.collapse').collapse({parent: '#' + $el.attr('id')});
                }
            }

            return this;
        }
    };

    // expose to scope
    $.extend(theme, {
        Accordion: Accordion
    });

    // jquery plugin
    $.fn.themeAccordion = function(opts) {
        return this.map(function() {
            var $this = $(this);

            if ($this.data(instanceName)) {
                return $this.data(instanceName);
            } else {
                return new theme.Accordion($this, opts);
            }

        });
    }

}).apply(this, [window.theme, jQuery]);


// Accordion Menu
(function(theme, $) {

    theme = theme || {};

    var instanceName = '__accordionMenu';

    var AccordionMenu = function($el, opts) {
        return this.initialize($el, opts);
    };

    AccordionMenu.defaults = {

    };

    AccordionMenu.prototype = {
        initialize: function($el, opts) {
            if ($el.data(instanceName)) {
                return this;
            }

            this.$el = $el;

            this
                .setData()
                .setOptions(opts)
                .build();

            return this;
        },

        setData: function() {
            this.$el.data(instanceName, this);

            return this;
        },

        setOptions: function(opts) {
            this.options = $.extend(true, {}, AccordionMenu.defaults, opts, {
                wrapper: this.$el
            });

            return this;
        },

        build: function() {
            var self = this,
                $el = this.options.wrapper;

            $el.find('li.menu-item.active').each(function() {
                var $this = $(this);

                if ($this.find('> .arrow').get(0))
                    $this.find('> .arrow').click();
            });

            $el.find('.arrow').click(function() {
                var $this = $(this),
                    $parent = $this.closest('li');

                $this.next().stop().slideToggle();
                if ($parent.hasClass('open')) {
                    $parent.removeClass('open');
                } else {
                    $parent.addClass('open');
                }
            });

            return this;
        }
    };

    // expose to scope
    $.extend(theme, {
        AccordionMenu: AccordionMenu
    });

    // jquery plugin
    $.fn.themeAccordionMenu = function(opts) {
        return this.map(function() {
            var $this = $(this);

            if ($this.data(instanceName)) {
                return $this.data(instanceName);
            } else {
                return new theme.AccordionMenu($this, opts);
            }

        });
    }

}).apply(this, [window.theme, jQuery]);


// Animate
(function(theme, $) {

    theme = theme || {};

    var instanceName = '__animate';

    var Animate = function($el, opts) {
        return this.initialize($el, opts);
    };

    Animate.defaults = {
        accX: 0,
        accY: -150,
        delay: 1,
        duration: 1000
    };

    Animate.prototype = {
        initialize: function($el, opts) {
            if ($el.data(instanceName)) {
                return this;
            }

            this.$el = $el;

            this
                .setData()
                .setOptions(opts)
                .build();

            return this;
        },

        setData: function() {
            this.$el.data(instanceName, this);

            return this;
        },

        setOptions: function(opts) {
            this.options = $.extend(true, {}, Animate.defaults, opts, {
                wrapper: this.$el
            });

            return this;
        },

        build: function() {
            var self = this,
                $el = this.options.wrapper,
                delay = 0,
                duration = 0;

            $el.addClass('appear-animation');

            if (!$('html').hasClass('no-csstransitions') && $(window).width() > (767 - theme.getScrollbarWidth()) && $.isFunction($.fn.appear)) {

                $el.appear(function() {

                    delay = Math.abs($el.attr('data-appear-animation-delay') ? $el.attr('data-appear-animation-delay') : self.options.delay);
                    if (delay > 1) {
                        $el.css('animation-delay', delay + 'ms');
                    }

                    duration = Math.abs($el.attr('data-appear-animation-duration') ? $el.attr('data-appear-animation-duration') : self.options.duration);
                    if (duration != 1000) {
                        $el.css('animation-duration', duration + 'ms');
                    }

                    $el.addClass($el.attr('data-appear-animation'));

                    setTimeout(function() {
                        $el.addClass('appear-animation-visible');
                    }, delay);

                }, {
                    accX: self.options.accX,
                    accY: self.options.accY
                });

            } else {

                $el.addClass('appear-animation-visible');

            }

            return this;
        }
    };

    // expose to scope
    $.extend(theme, {
        Animate: Animate
    });

    // jquery plugin
    $.fn.themeAnimate = function(opts) {
        return this.map(function() {
            var $this = $(this);

            if ($this.data(instanceName)) {
                return $this.data(instanceName);
            } else {
                return new theme.Animate($this, opts);
            }

        });
    };

}).apply(this, [window.theme, jQuery]);


// Carousel
(function(theme, $) {

    theme = theme || {};

    var instanceName = '__carousel';

    var Carousel = function($el, opts) {
        return this.initialize($el, opts);
    };

    Carousel.defaults = $.extend({}, {
        loop: true,
        navText: [],
        themeConfig: false,
        lazyLoad: true,
        lg: 0,
        md: 0,
        sm: 0,
        xs: 0,
        responsive: {},
        single: false,
        rtl: theme.rtl
    });

    // Add default responsive options
    var scrollWidth = theme.getScrollbarWidth(),
        w_sm = 481 - scrollWidth,
        w_md = 768 - scrollWidth,
        w_lg = 992 - scrollWidth,
        w_xl = theme.screen_lg - scrollWidth;

    Carousel.defaults.responsive[0] = {items: 1};
    Carousel.defaults.responsive[w_sm] = {items: 1, mergeFit: false};
    Carousel.defaults.responsive[w_md] = {items: 1, mergeFit: false};
    Carousel.defaults.responsive[w_lg] = {items: 1, mergeFit: false};
    Carousel.defaults.responsive[w_xl] = {items: 1, mergeFit: false};

    Carousel.prototype = {
        initialize: function($el, opts) {
            if ($el.data(instanceName)) {
                return this;
            }

            this.$el = $el;

            this
                .setData()
                .setOptions(opts)
                .build();

            return this;
        },

        setData: function() {
            this.$el.data(instanceName, this);

            return this;
        },

        setOptions: function(opts) {
            if ((opts && opts.themeConfig) || !opts) {
                this.options = $.extend(true, {}, Carousel.defaults, theme.owlConfig, opts, {
                    wrapper: this.$el,
                    themeConfig: true
                });
            } else {
                this.options = $.extend(true, {}, Carousel.defaults, opts, {
                    wrapper: this.$el
                });
            }

            return this;
        },

        build: function() {
            if (!($.isFunction($.fn.owlCarousel))) {
                return this;
            }

            var self = this,
                $el = this.options.wrapper,
                loop = this.options.loop,
                lg = this.options.lg ? this.options.lg : this.options.items,
                md = this.options.md ? this.options.md : this.options.items,
                sm = this.options.sm ? this.options.sm : this.options.items,
                xs = this.options.xs ? this.options.xs : this.options.items,
                single = this.options.single,
                zoom = $el.find('.zoom').get(0),
                responsive = {},
                items,
                count = $el.find('> *').length;

            if (single) {
                items = 1;
            } else {
                items = this.options.items ? this.options.items : (lg ? lg : 1);
                responsive[w_xl] = { items: items, loop: (loop && count > items) ? true : false, mergeFit: this.options.mergeFit };
                if (lg) responsive[w_lg] = { items: lg, loop: (loop && count > lg) ? true : false, mergeFit: this.options.mergeFit_lg };
                if (md) responsive[w_md] = { items: md, loop: (loop && count > md) ? true : false, mergeFit: this.options.mergeFit_md };
                if (sm) responsive[w_sm] = { items: sm, loop: (loop && count > sm) ? true : false, mergeFit: this.options.mergeFit_sm };
                if (xs) responsive[0] = { items: xs, loop: (loop && count > xs) ? true : false, mergeFit: this.options.mergeFit_xs };
            }

            if (!$el.hasClass('show-nav-title') && this.options.themeConfig && theme.slider_nav_hover)
                $el.addClass('show-nav-hover');

            this.options = $.extend(true, {}, this.options, {
                items: items,
                loop: (loop && count > items) ? true : false,
                responsive: responsive,
                onInitialized: function() {
                    $el.find('.owl-stage-outer').css({
                        'margin-left': this.options.stagePadding,
                        'margin-right': this.options.stagePadding
                    })
                },
                touchDrag: (count == 1) ? false : true,
                mouseDrag: (count == 1) ? false : true
            });

            // Auto Height Fixes
            if (this.options.autoHeight) {
                function calcOwlHeight() {
                    var h = 0;
                    $el.find('.owl-item.active').each(function() {
                        if (h < $(this).height())
                            h = $(this).height();
                    });
                    $el.find('.owl-stage-outer').height( h );
                }
                $(window).on('resize', function() {
                    calcOwlHeight();
                });

                $(window).on('load', function() {
                    calcOwlHeight();
                });
            }

            if (zoom) {
                var links = [],
                    i = 0;

                $el.find('.zoom').each(function() {
                    var slide = {},
                        $zoom = $(this);

                    slide.src = $zoom.data('src');
                    slide.title = $zoom.data('title');
                    links[i] = slide;
                    $zoom.data('index', i);
                    i++;
                });
            }

            if ($el.hasClass('show-nav-title')) {
                this.options.stagePadding = 0;
            } else {
                if (this.options.themeConfig && theme.slider_nav_hover)
                    $el.addClass('show-nav-hover');
                if (this.options.themeConfig && !theme.slider_nav_hover && theme.slider_margin)
                    $el.addClass('stage-margin');
            }

            $el.owlCarousel(this.options);

            if (zoom && links) {
                $el.on('click', '.zoom', function(e) {
                    e.preventDefault();
                    $.magnificPopup.close();
                    $.magnificPopup.open($.extend(true, {}, theme.mfpConfig, {
                        items: links,
                        gallery: {
                            enabled: true
                        },
                        type: 'image'
                    }), $(this).data('index'));
                    return false;
                });
            }

            return this;
        }
    };

    // expose to scope
    $.extend(theme, {
        Carousel: Carousel
    });

    // jquery plugin
    $.fn.themeCarousel = function(opts, zoom) {
        return this.map(function() {
            var $this = $(this);

            if ($this.data(instanceName)) {
                return $this.data(instanceName);
            } else {
                return new theme.Carousel($this, opts, zoom);
            }

        });
    }

}).apply(this, [window.theme, jQuery]);


// Chart Circular
(function(theme, $) {

    theme = theme || {};

    var instanceName = '__chartCircular';

    var ChartCircular = function($el, opts) {
        return this.initialize($el, opts);
    };

    ChartCircular.defaults = {
        accX: 0,
        accY: -150,
        delay: 1,
        barColor: '#0088CC',
        trackColor: '#f2f2f2',
        scaleColor: false,
        scaleLength: 5,
        lineCap: 'round',
        lineWidth: 13,
        size: 175,
        rotate: 0,
        animate: ({
            duration: 2500,
            enabled: true
        })
    };

    ChartCircular.prototype = {
        initialize: function($el, opts) {
            if ($el.data(instanceName)) {
                return this;
            }

            this.$el = $el;

            this
                .setData()
                .setOptions(opts)
                .build();

            return this;
        },

        setData: function() {
            this.$el.data(instanceName, this);

            return this;
        },

        setOptions: function(opts) {
            this.options = $.extend(true, {}, ChartCircular.defaults, opts, {
                wrapper: this.$el
            });

            return this;
        },

        build: function() {
            if (!($.isFunction($.fn.appear)) || !($.isFunction($.fn.easyPieChart))) {
                return this;
            }

            var self = this,
                $el = this.options.wrapper,
                value = ($el.attr('data-percent') ? $el.attr('data-percent') : 0),
                percentEl = $el.find('.percent');

            if (!value) value = 1;
            var labelValue = this.options.labelValue ? this.options.labelValue : value;

            $.extend(true, self.options, {
                onStep: function(from, to, currentValue) {
                    percentEl.html(parseInt(labelValue * currentValue / value));
                }
            });

            $el.attr('data-percent', 0);

            $el.appear(function() {

                $el.easyPieChart(self.options);

                setTimeout(function() {

                    $el.data('easyPieChart').update(value);
                    $el.attr('data-percent', value);

                }, self.options.delay);

            }, {
                accX: self.options.accX,
                accY: self.options.accY
            });

            return this;
        }
    };

    // expose to scope
    $.extend(theme, {
        ChartCircular: ChartCircular
    });

    // jquery plugin
    $.fn.themeChartCircular = function(opts) {
        return this.map(function() {
            var $this = $(this);

            if ($this.data(instanceName)) {
                return $this.data(instanceName);
            } else {
                return new theme.ChartCircular($this, opts);
            }

        });
    }

}).apply(this, [window.theme, jQuery]);


// Fit Video
(function(theme, $) {

    theme = theme || {};

    var instanceName = '__fitVideo';

    var FitVideo = function($el, opts) {
        return this.initialize($el, opts);
    };

    FitVideo.defaults = {

    };

    FitVideo.prototype = {
        initialize: function($el, opts) {
            if ($el.data(instanceName)) {
                return this;
            }

            this.$el = $el;

            this
                .setData()
                .setOptions(opts)
                .build();

            return this;
        },

        setData: function() {
            this.$el.data(instanceName, this);

            return this;
        },

        setOptions: function(opts) {
            this.options = $.extend(true, {}, FitVideo.defaults, opts, {
                wrapper: this.$el
            });

            return this;
        },

        build: function() {
            if (!($.isFunction($.fn.fitVids))) {
                return this;
            }

            var self = this,
                $el = this.options.wrapper;

            $el.fitVids();
            $(window).on('resize', function() {
                $el.fitVids();
            });

            return this;
        }
    };

    // expose to scope
    $.extend(theme, {
        FitVideo: FitVideo
    });

    // jquery plugin
    $.fn.themeFitVideo = function(opts) {
        return this.map(function() {
            var $this = $(this);

            if ($this.data(instanceName)) {
                return $this.data(instanceName);
            } else {
                return new theme.FitVideo($this, opts);
            }

        });
    }

}).apply(this, [window.theme, jQuery]);


// Flickr Zoom
(function(theme, $) {

    theme = theme || {};

    var instanceName = '__flickrZoom';

    var FlickrZoom = function($el, opts) {
        return this.initialize($el, opts);
    };

    FlickrZoom.defaults = {

    };

    FlickrZoom.prototype = {
        initialize: function($el, opts) {
            if ($el.data(instanceName)) {
                return this;
            }

            this.$el = $el;

            this
                .setData()
                .setOptions(opts)
                .build();

            return this;
        },

        setData: function() {
            this.$el.data(instanceName, this);

            return this;
        },

        setOptions: function(opts) {
            this.options = $.extend(true, {}, FlickrZoom.defaults, opts, {
                wrapper: this.$el
            });

            return this;
        },

        build: function() {
            var self = this,
                $el = this.options.wrapper,
                links = [],
                i = 0,
                $flickr_links = $el.find('.flickr_badge_image > a');

            $flickr_links.each(function() {
                var slide = {},
                    $image = $(this).find('> img');

                slide.src = $image.attr('src').replace('_s.', '_b.');
                slide.title = $image.attr('title');
                links[i] = slide;
                i++;
            });

            $flickr_links.click(function(e) {
                e.preventDefault();
                $.magnificPopup.close();
                $.magnificPopup.open($.extend(true, {}, theme.mfpConfig, {
                    items: links,
                    gallery: {
                        enabled: true
                    },
                    type: 'image'
                }), $flickr_links.index($(this)));
            });

            return this;
        }
    };

    // expose to scope
    $.extend(theme, {
        FlickrZoom: FlickrZoom
    });

    // jquery plugin
    $.fn.themeFlickrZoom = function(opts) {
        return this.map(function() {
            var $this = $(this);

            if ($this.data(instanceName)) {
                return $this.data(instanceName);
            } else {
                return new theme.FlickrZoom($this, opts);
            }

        });
    }

}).apply(this, [window.theme, jQuery]);


// Lightbox
(function(theme, $) {

    theme = theme || {};

    var instanceName = '__lightbox';

    var Lightbox = function($el, opts) {
        return this.initialize($el, opts);
    };

    Lightbox.defaults = {
        callbacks: {
            open: function() {
                $('body').addClass('lightbox-opened');
            },
            close: function() {
                $('body').removeClass('lightbox-opened');
            }
        }
    };

    Lightbox.prototype = {
        initialize: function($el, opts) {
            if ($el.data(instanceName)) {
                return this;
            }

            this.$el = $el;

            this
                .setData()
                .setOptions(opts)
                .build();

            return this;
        },

        setData: function() {
            this.$el.data(instanceName, this);

            return this;
        },

        setOptions: function(opts) {
            this.options = $.extend(true, {}, Lightbox.defaults, theme.mfpConfig, opts, {
                wrapper: this.$el
            });

            return this;
        },

        build: function() {
            if (!($.isFunction($.fn.magnificPopup))) {
                return this;
            }

            this.options.wrapper.magnificPopup(this.options);

            return this;
        }
    };

    // expose to scope
    $.extend(theme, {
        Lightbox: Lightbox
    });

    // jquery plugin
    $.fn.themeLightbox = function(opts) {
        return this.map(function() {
            var $this = $(this);

            if ($this.data(instanceName)) {
                return $this.data(instanceName);
            } else {
                return new theme.Lightbox($this, opts);
            }

        });
    }

}).apply(this, [window.theme, jQuery]);


// Loading Overlay
(function(theme, $) {

    'use strict';

    theme = theme || {};

    var loadingOverlayTemplate = [
        '<div class="loading-overlay">',
        '<div class="loader"></div>',
        '</div>'
    ].join('');

    var LoadingOverlay = function( $wrapper, options ) {
        return this.initialize( $wrapper, options );
    };

    LoadingOverlay.prototype = {

        options: {
            css: {}
        },

        initialize: function( $wrapper, options ) {
            this.$wrapper = $wrapper;

            this
                .setVars()
                .setOptions( options )
                .build()
                .events();

            this.$wrapper.data( 'loadingOverlay', this );
        },

        setVars: function() {
            this.$overlay = this.$wrapper.find('.loading-overlay');

            return this;
        },

        setOptions: function( options ) {
            if ( !this.$overlay.get(0) ) {
                this.matchProperties();
            }
            this.options     = $.extend( true, {}, this.options, options );
            this.loaderClass = this.getLoaderClass( this.options.css.backgroundColor );

            return this;
        },

        build: function() {
            if ( !this.$overlay.closest(document.documentElement).get(0) ) {
                if ( !this.$cachedOverlay ) {
                    this.$overlay = $( loadingOverlayTemplate ).clone();

                    if ( this.options.css ) {
                        this.$overlay.css( this.options.css );
                        this.$overlay.find( '.loader' ).addClass( this.loaderClass );
                    }
                } else {
                    this.$overlay = this.$cachedOverlay.clone();
                }

                this.$wrapper.append( this.$overlay );
            }

            if ( !this.$cachedOverlay ) {
                this.$cachedOverlay = this.$overlay.clone();
            }

            return this;
        },

        events: function() {
            var _self = this;

            if ( this.options.startShowing ) {
                _self.show();
            }

            if ( this.$wrapper.is('body') || this.options.hideOnWindowLoad ) {
                $( window ).on( 'load error', function() {
                    _self.hide();
                });
            }

            if ( this.options.listenOn ) {
                $( this.options.listenOn )
                    .on( 'loading-overlay:show beforeSend.ic', function( e ) {
                        e.stopPropagation();
                        _self.show();
                    })
                    .on( 'loading-overlay:hide complete.ic', function( e ) {
                        e.stopPropagation();
                        _self.hide();
                    });
            }

            this.$wrapper
                .on( 'loading-overlay:show beforeSend.ic', function( e ) {
                    e.stopPropagation();
                    _self.show();
                })
                .on( 'loading-overlay:hide complete.ic', function( e ) {
                    e.stopPropagation();
                    _self.hide();
                });

            return this;
        },

        show: function() {
            this.build();

            this.position = this.$wrapper.css( 'position' ).toLowerCase();
            if ( this.position != 'relative' || this.position != 'absolute' || this.position != 'fixed' ) {
                this.$wrapper.css({
                    position: 'relative'
                });
            }
            this.$wrapper.addClass( 'loading-overlay-showing' );
        },

        hide: function() {
            var _self = this;

            this.$wrapper.removeClass( 'loading-overlay-showing' );
            setTimeout(function() {
                if ( this.position != 'relative' || this.position != 'absolute' || this.position != 'fixed' ) {
                    _self.$wrapper.css({ position: '' });
                }
            }, 500);
        },

        matchProperties: function() {
            var i,
                l,
                properties;

            properties = [
                'backgroundColor',
                'borderRadius'
            ];

            l = properties.length;

            for( i = 0; i < l; i++ ) {
                var obj = {};
                obj[ properties[ i ] ] = this.$wrapper.css( properties[ i ] );

                $.extend( this.options.css, obj );
            }
        },

        getLoaderClass: function( backgroundColor ) {
            if ( !backgroundColor || backgroundColor === 'transparent' || backgroundColor === 'inherit' ) {
                return 'black';
            }

            var hexColor,
                r,
                g,
                b,
                yiq;

            var colorToHex = function( color ){
                var hex,
                    rgb;

                if( color.indexOf('#') >- 1 ){
                    hex = color.replace('#', '');
                } else {
                    rgb = color.match(/\d+/g);
                    hex = ('0' + parseInt(rgb[0], 10).toString(16)).slice(-2) + ('0' + parseInt(rgb[1], 10).toString(16)).slice(-2) + ('0' + parseInt(rgb[2], 10).toString(16)).slice(-2);
                }

                if ( hex.length === 3 ) {
                    hex = hex + hex;
                }

                return hex;
            };

            hexColor = colorToHex( backgroundColor );

            r = parseInt( hexColor.substr( 0, 2), 16 );
            g = parseInt( hexColor.substr( 2, 2), 16 );
            b = parseInt( hexColor.substr( 4, 2), 16 );
            yiq = ((r * 299) + (g * 587) + (b * 114)) / 1000;

            return ( yiq >= 128 ) ? 'black' : 'white';
        }

    };

    // expose to scope
    $.extend(theme, {
        LoadingOverlay: LoadingOverlay
    });

    // expose as a jquery plugin
    $.fn.loadingOverlay = function( opts ) {
        return this.each(function() {
            var $this = $( this );

            var loadingOverlay = $this.data( 'loadingOverlay' );
            if ( loadingOverlay ) {
                return loadingOverlay;
            } else {
                var options = opts || $this.data( 'loading-overlay-options' ) || {};
                return new LoadingOverlay( $this, options );
            }
        });
    }

    // auto init
    $(function() {
        $('[data-loading-overlay]').loadingOverlay();
    });

}).apply(this, [window.theme, jQuery]);


// Masonry
(function(theme, $) {

    theme = theme || {};

    var instanceName = '__masonry';

    var Masonry = function($el, opts) {
        return this.initialize($el, opts);
    };

    Masonry.defaults = {
        itemSelector: 'li',
        isOriginLeft : !theme.rtl
    };

    Masonry.prototype = {
        initialize: function($el, opts) {
            if ($el.data(instanceName)) {
                return this;
            }

            this.$el = $el;

            this
                .setData()
                .setOptions(opts)
                .build();

            return this;
        },

        setData: function() {
            this.$el.data(instanceName, this);

            return this;
        },

        setOptions: function(opts) {
            this.options = $.extend(true, {}, Masonry.defaults, opts, {
                wrapper: this.$el
            });

            return this;
        },

        build: function() {
            if (!($.isFunction($.fn.isotope))) {
                return this;
            }

            var self = this,
                $el = this.options.wrapper;

            $el.isotope(this.options);
            if (this.options.callback) {
                $el.isotope('on', 'layoutComplete', this.options.callback);
            }
            $el.isotope('layout');
            self.resize();
            $(window).on('resize', function() {
                self.resize()
            });

            return this;
        },

        resize: function() {
            var self = this,
                $el = this.options.wrapper;

            if (self.resizeTimer)
                clearTimeout(self.resizeTimer);

            self.resizeTimer = setTimeout(function() {
                if ($el.data('isotope')) {
                    $el.isotope('layout');
                }
                delete self.resizeTimer;
            }, 600);
        }
    };

    // expose to scope
    $.extend(theme, {
        Masonry: Masonry
    });

    // jquery plugin
    $.fn.themeMasonry = function(opts) {
        return this.map(function() {
            var $this = $(this);

            $this.waitForImages(function() {
                if ($this.data(instanceName)) {
                    return $this.data(instanceName);
                } else {
                    return new theme.Masonry($this, opts);
                }
            });

        });
    }

}).apply(this, [window.theme, jQuery]);


// Preview Image
(function(theme, $) {

    theme = theme || {};

    var instanceName = '__previewImage';

    var PreviewImage = function($el, opts) {
        return this.initialize($el, opts);
    };

    PreviewImage.defaults = {

    };

    PreviewImage.prototype = {
        initialize: function($el, opts) {
            if ($el.data(instanceName)) {
                return this;
            }

            this.$el = $el;

            this
                .setData()
                .setOptions(opts)
                .build();

            return this;
        },

        setData: function() {
            this.$el.data(instanceName, this);

            return this;
        },

        setOptions: function(opts) {
            this.options = $.extend(true, {}, PreviewImage.defaults, opts, {
                wrapper: this.$el
            });

            return this;
        },

        build: function() {
            var self = this,
                $el = this.options.wrapper,
                image = $el.data('image');

            if (image) {
                $el.css('background-image', 'url(' + image + ')');
            }

            return this;
        }
    };

    // expose to scope
    $.extend(theme, {
        PreviewImage: PreviewImage
    });

    // jquery plugin
    $.fn.themePreviewImage = function(opts) {
        return this.map(function() {
            var $this = $(this);

            if ($this.data(instanceName)) {
                return $this.data(instanceName);
            } else {
                return new theme.PreviewImage($this, opts);
            }

        });
    }

}).apply(this, [window.theme, jQuery]);


// Refresh Video Sizes
(function(theme, $) {

    theme = theme || {};

    var instanceName = '__refreshVideoSize';

    var RefreshVideoSize = function($el, opts) {
        return this.initialize($el, opts);
    };

    RefreshVideoSize.defaults = {

    };

    RefreshVideoSize.prototype = {
        initialize: function($el, opts) {
            if ($el.data(instanceName)) {
                return this;
            }

            this.$el = $el;

            this
                .setData()
                .setOptions(opts)
                .build();

            return this;
        },

        setData: function() {
            this.$el.data(instanceName, this);

            return this;
        },

        setOptions: function(opts) {
            this.options = $.extend(true, {}, RefreshVideoSize.defaults, opts, {
                wrapper: this.$el
            });

            return this;
        },

        build: function() {
            var self = this;

            setTimeout(function() {
                self.refresh();
            }, 100);

            $(window).on('resize', function() {
                setTimeout(function() {
                    self.refresh();
                }, 100);
            });

            return this;
        },

        refresh: function() {
            var self = this,
                $el = this.options.wrapper,
                $video = $el.find('video'),
                w = $el.width(),
                h = $el.height();

            if (!$video.get(0)) {
                return;
            }

            $video.css('width', '100%').css('height', 'auto');

            var vw = $video.width(), vh = $video.height();

            if (vh < h) {
                $video.css('height', h);
                $video.css('width', h / vh * 100 + '%');
            }

            return this;
        }
    };

    // expose to scope
    $.extend(theme, {
        RefreshVideoSize: RefreshVideoSize
    });

    // jquery plugin
    $.fn.themeRefreshVideoSize = function(opts) {
        return this.map(function() {
            var $this = $(this);

            if ($this.data(instanceName)) {
                return $this.data(instanceName);
            } else {
                return new theme.RefreshVideoSize($this, opts);
            }

        });
    }

}).apply(this, [window.theme, jQuery]);


// Toggle
(function(theme, $) {

    theme = theme || {};

    var instanceName = '__toggle';

    var Toggle = function($el, opts) {
        return this.initialize($el, opts);
    };

    Toggle.defaults = {

    };

    Toggle.prototype = {
        initialize: function($el, opts) {
            if ($el.data(instanceName)) {
                return this;
            }

            this.$el = $el;

            this
                .setData()
                .setOptions(opts)
                .build();

            return this;
        },

        setData: function() {
            this.$el.data(instanceName, this);

            return this;
        },

        setOptions: function(opts) {
            this.options = $.extend(true, {}, Toggle.defaults, opts, {
                wrapper: this.$el
            });

            return this;
        },

        build: function() {
            var self = this,
                $el = this.options.wrapper;

            if ($el.hasClass('active'))
                $el.find("> div.toggle-content").stop().slideDown(350, function() {
                    $(this).attr('style', '').show();
                });

            $el.on('click', "> label", function(e) {
                var parentSection = $(this).parent(),
                    parentWrapper = $(this).closest("div.toogle"),
                    parentToggles = $(this).closest(".porto-toggles"),
                    isAccordion = parentWrapper.hasClass("toogle-accordion"),
                    toggleContent = parentSection.find("> div.toggle-content");

                if (isAccordion && typeof(e.originalEvent) != "undefined") {
                    parentWrapper.find("section.toggle.active > label").trigger("click");
                }

                // Preview Paragraph
                if(!parentSection.hasClass("active")) {
                    if (parentToggles.length) {
                        if (parentToggles.data('view') == 'one-toggle') {
                            parentToggles.find('.toggle').each(function() {
                                $(this).removeClass('active');
                                $(this).find("> div.toggle-content").stop().slideUp(350, function() {
                                    $(this).attr('style', '').hide();
                                });
                            });
                        }
                    }
                    toggleContent.stop().slideDown(350, function() {
                        $(this).attr('style', '').show();
                        theme.refreshVCContent(toggleContent);
                    });
                    parentSection.addClass("active");
                } else {
                    if (!parentToggles.length || parentToggles.data('view') != 'one-toggle') {
                        toggleContent.stop().slideUp(350, function() {
                            $(this).attr('style', '').hide();
                        });
                        parentSection.removeClass("active");
                    }
                }
            });

            return this;
        }
    };

    // expose to scope
    $.extend(theme, {
        Toggle: Toggle
    });

    // jquery plugin
    $.fn.themeToggle = function(opts) {
        return this.map(function() {
            var $this = $(this);

            if ($this.data(instanceName)) {
                return $this.data(instanceName);
            } else {
                return new theme.Toggle($this, opts);
            }

        });
    }

}).apply(this, [window.theme, jQuery]);


// Parallax
(function(theme, $) {

    theme = theme || {};

    var instanceName = '__parallax';

    var Parallax = function($el, opts) {
        return this.initialize($el, opts);
    };

    Parallax.defaults = {
        speed: 1.5,
        horizontalPosition: '50%',
        offset: 0
    };

    Parallax.prototype = {
        initialize: function($el, opts) {
            if ($el.data(instanceName)) {
                return this;
            }

            this.$el = $el;

            this
                .setData()
                .setOptions(opts)
                .build();

            return this;
        },

        setData: function() {
            this.$el.data(instanceName, this);

            return this;
        },

        setOptions: function(opts) {
            this.options = $.extend(true, {}, Parallax.defaults, opts, {
                wrapper: this.$el
            });

            return this;
        },

        build: function() {
            var self = this,
                $window = $(window),
                offset,
                yPos,
                bgpos;

            self.options.wrapper.removeAttr('style');
            if (typeof self.options.wrapper.data('image-src') != 'undefined')
                self.options.wrapper.css('background-image', 'url(' + self.options.wrapper.data('image-src') + ')');

            if (!$.browser.mobile) {

                $window.on('scroll resize', function() {
                    offset = self.options.wrapper.offset();
                    yPos = -($window.scrollTop() - offset.top) / self.options.speed + (self.options.offset);
                    bgpos = self.options.horizontalPosition + ' ' + yPos + 'px';
                    self.options.wrapper.css('background-position', bgpos);
                });

                $window.trigger('scroll');

            } else {
                self.options.wrapper.addClass('parallax-disabled');
            }

            return this;
        }
    };

    // expose to scope
    $.extend(theme, {
        Parallax: Parallax
    });

    // jquery plugin
    $.fn.themeParallax = function(opts) {
        return this.map(function() {
            var $this = $(this);

            if ($this.data(instanceName)) {
                return $this.data(instanceName);
            } else {
                return new theme.Parallax($this, opts);
            }

        });
    }

}).apply(this, [window.theme, jQuery]);


// Visual Composer Image Zoom

// VcImageZoom
(function(theme, $) {

    theme = theme || {};

    var instanceName = '__toggle';

    var VcImageZoom = function($el, opts) {
        return this.initialize($el, opts);
    };

    VcImageZoom.defaults = {

    };

    VcImageZoom.prototype = {
        initialize: function($el, opts) {
            if ($el.data(instanceName)) {
                return this;
            }

            this.$el = $el;

            this
                .setData()
                .setOptions(opts)
                .build();

            return this;
        },

        setData: function() {
            this.$el.data(instanceName, this);

            return this;
        },

        setOptions: function(opts) {
            this.options = $.extend(true, {}, VcImageZoom.defaults, opts, {
                wrapper: this.$el
            });

            return this;
        },

        build: function() {
            var self = this,
                $el = this.options.wrapper;

            $el.click(function(e) {
                e.preventDefault();

                var $this = $(this),
                    gallery = $this.attr('data-gallery'),
                    links = [],
                    i = 0, index = 0,
                    options;

                if (gallery == 'true') {
                    var container = 'vc_row';

                    if ($this.attr('data-container'))
                        container = $this.attr('data-container');

                    var $parent = $($this.closest('.' + container).get(0));

                    $parent.find('.porto-vc-zoom').each(function() {
                        var slide = {};
                        slide.src = $(this).attr('href');
                        slide.title = $(this).attr('data-title');
                        links[i] = slide;
                        i++;
                    });
                    index = $parent.find('.porto-vc-zoom').index($this);
                } else {
                    var slide = {};
                    slide.src = $(this).attr('href');
                    slide.title = $(this).attr('data-title');
                    links[i] = slide;
                    options = {index: 0, event: e};
                }
                $.magnificPopup.close();
                $.magnificPopup.open($.extend(true, {}, theme.mfpConfig, {
                    items: links,
                    gallery: {
                        enabled: true
                    },
                    type: 'image'
                }), index);

                return false;
            });

            return this;
        }
    };

    // expose to scope
    $.extend(theme, {
        VcImageZoom: VcImageZoom
    });

    // jquery plugin
    $.fn.themeVcImageZoom = function(opts) {
        return this.map(function() {
            var $this = $(this);

            if ($this.data(instanceName)) {
                return $this.data(instanceName);
            } else {
                return new theme.VcImageZoom($this, opts);
            }

        });
    }

}).apply(this, [window.theme, jQuery]);


// Sticky
(function(theme, $) {

    // jQuery Pin plugin
    $.fn.themePin = function (options) {
        var scrollY = 0, elements = [], disabled = false, $window = $(window);

        options = options || {};

        var recalculateLimits = function () {
            for (var i=0, len=elements.length; i<len; i++) {
                var $this = elements[i];

                if (options.minWidth && $window.width() <= options.minWidth) {
                    if ($this.parent().is(".pin-wrapper")) { $this.unwrap(); }
                    $this.css({width: "", left: "", top: "", position: ""});
                    if (options.activeClass) { $this.removeClass(options.activeClass); }
                    $this.removeClass('sticky-transition');
                    $this.removeClass('sticky-absolute');
                    disabled = true;
                    continue;
                } else {
                    disabled = false;
                }

                var $container = options.containerSelector ? $this.closest(options.containerSelector) : $(document.body);
                var offset = $this.offset();
                var containerOffset = $container.offset();

                if (typeof containerOffset == 'undefined') {
                    continue;
                }

                var parentOffset = $this.parent().offset();

                if (!$this.parent().is(".pin-wrapper")) {
                    $this.wrap("<div class='pin-wrapper'>");
                }

                var pad = $.extend({
                    top: 0,
                    bottom: 0
                }, options.padding || {});

                var pt = parseInt($this.parent().parent().css('padding-top')), pb = parseInt($this.parent().parent().css('padding-bottom'));

                if (options.autoInit) {
                    pad.top = theme.StickyHeader.sticky_height + theme.adminBarHeight() + 18;
                    pad.bottom = 0;
                }

                var bb = $this.css('border-bottom'), h = $this.outerHeight();
                $this.css('border-bottom', '1px solid transparent');
                var o_h = $this.outerHeight() - h - 1;
                $this.css('border-bottom', bb);

                $this.css({width: $this.outerWidth()});
                $this.parent().css("height", $this.outerHeight() + o_h);

                var c_h = $container.height()

                $this.data("themePin", {
                    pad: pad,
                    from: (options.containerSelector ? containerOffset.top : offset.top) - pad.top + pt,
                    to: containerOffset.top + c_h - $this.outerHeight() - pad.bottom - pb,
                    end: containerOffset.top + c_h,
                    parentTop: parentOffset.top - pt,
                    offset: o_h
                });
            }
        };

        var onScroll = function () {
            if (disabled) { return; }

            scrollY = $window.scrollTop();

            for (var i=0, len=elements.length; i<len; i++) {
                var $this = $(elements[i]),
                    data  = $this.data("themePin");

                if (!data) { // Removed element
                    continue;
                }

                var from = data.from - data.pad.bottom,
                    to = data.to - data.pad.top - data.offset;

                if (from + $this.outerHeight() > data.end || from >= to) {
                    $this.css({position: "", top: "", left: ""});
                    if (options.activeClass) { $this.removeClass(options.activeClass); }
                    $this.removeClass('sticky-transition');
                    $this.removeClass('sticky-absolute');
                    continue;
                }

                if (scrollY > from && scrollY < to) {
                    !($this.css("position") == "fixed") && $this.css({
                        left: $this.offset().left,
                        top: data.pad.top
                    }).css("position", "fixed");
                    if (options.activeClass) { $this.addClass(options.activeClass); }
                    $this.removeClass('sticky-transition');
                    $this.removeClass('sticky-absolute');
                } else if (scrollY >= to) {
                    $this.css({
                        left: "",
                        top: to - data.parentTop + data.pad.top
                    }).css("position", "absolute");
                    if (options.activeClass) { $this.addClass(options.activeClass); }
                    if ($this.hasClass('sticky-absolute')) $this.addClass('sticky-transition');
                    $this.addClass('sticky-absolute');
                } else {
                    $this.css({position: "", top: "", left: ""});
                    if (options.activeClass) { $this.removeClass(options.activeClass); }
                    $this.removeClass('sticky-transition');
                    $this.removeClass('sticky-absolute');
                }
            }
        };

        var update = function () { recalculateLimits(); onScroll(); };

        this.each(function () {
            var $this = $(this),
                data  = $(this).data('themePin') || {};

            if (data && data.update) { return; }
            elements.push($this);
            $("img", this).one("load", recalculateLimits);
            data.update = update;
            $(this).data('themePin', data);
        });

        $(window).on('resize', function() {
            recalculateLimits();
            onScroll();
        });

        $(window).on('scroll', function() {
            onScroll();
        });
        recalculateLimits();

        $window.load(update);

        $(this).bind('recalc.pin', function() {
            recalculateLimits();
            onScroll();
        });

        return this;
    };

    theme = theme || {};

    var instanceName = '__sticky';

    var Sticky = function($el, opts) {
        return this.initialize($el, opts);
    };

    Sticky.defaults = {
        autoInit: false,
        minWidth: 767,
        activeClass: 'sticky-active',
        padding: {
            top: 0,
            bottom: 0
        },
        offsetTop: 0,
        offsetBottom: 0
    };

    Sticky.prototype = {
        initialize: function($el, opts) {
            if ($el.data(instanceName)) {
                return this;
            }

            this.$el = $el;

            this
                .setData()
                .setOptions(opts)
                .build();

            return this;
        },

        setData: function() {
            this.$el.data(instanceName, this);

            return this;
        },

        setOptions: function(opts) {
            this.options = $.extend(true, {}, Sticky.defaults, opts, {
                wrapper: this.$el
            });

            return this;
        },

        build: function() {
            if (!($.isFunction($.fn.themePin))) {
                return this;
            }

            var self = this,
                $el = this.options.wrapper;

            this.options.minWidth -= theme.getScrollbarWidth();

            if ($el.hasClass('porto-sticky-nav')) {
                this.options.padding.top = theme.StickyHeader.sticky_height + theme.adminBarHeight();
                this.options.activeClass = 'sticky-active';
                this.options.containerSelector = '.main-content-wrap';
                theme.sticky_nav_height = $el.outerHeight();
                if (this.options.minWidth > $(window).width())
                    theme.sticky_nav_height = 0;
            }

            $el.themePin(this.options);

            $(window).on('resize', function() {
                setTimeout(function() {
                    $el.trigger('recalc.pin');
                }, 800);

                var $parent = $el.parent();

                $el.width($parent.width());
                if ($el.css('position') == 'fixed') {
                    $el.css('left', $parent.offset().left);
                }

                if ($el.hasClass('porto-sticky-nav')) {
                    theme.sticky_nav_height = $el.outerHeight();
                    if (self.options.minWidth > $(window).width())
                        theme.sticky_nav_height = 0;
                }
            });

            return this;
        }
    };

    // expose to scope
    $.extend(theme, {
        Sticky: Sticky
    });

    // jquery plugin
    $.fn.themeSticky = function(opts) {
        return this.map(function() {
            var $this = $(this);

            if ($this.data(instanceName)) {
                $this.trigger('recalc.pin');
                setTimeout(function() {
                    $this.trigger('recalc.pin');
                }, 800);
                return $this.data(instanceName);
            } else {
                return new theme.Sticky($this, opts);
            }

        });
    }

}).apply(this, [window.theme, jQuery]);


// Woocommerce Widget Toggle
(function(theme, $) {

    theme = theme || {};

    var instanceName = '__wooWidgetToggle';

    var WooWidgetToggle = function($el, opts) {
        return this.initialize($el, opts);
    };

    WooWidgetToggle.defaults = {

    };

    WooWidgetToggle.prototype = {
        initialize: function($el, opts) {
            if ($el.data(instanceName)) {
                return this;
            }

            this.$el = $el;

            this
                .setData()
                .setOptions(opts)
                .build();

            return this;
        },

        setData: function() {
            this.$el.data(instanceName, this);

            return this;
        },

        setOptions: function(opts) {
            this.options = $.extend(true, {}, WooWidgetToggle.defaults, opts, {
                wrapper: this.$el
            });

            return this;
        },

        build: function() {
            var self = this,
                $el = this.options.wrapper;

            $el.parent().removeClass('closed');
            if (!$el.find('.toggle').length) {
                $el.append('<span class="toggle"></span>');
            }
            $el.find('.toggle').click(function() {
                if ($el.next().is(":visible")){
                    $el.parent().addClass('closed');
                } else {
                    $el.parent().removeClass('closed');
                }
                $el.next().stop().slideToggle(200);
                theme.refreshVCContent();
            });

            return this;
        }
    };

    // expose to scope
    $.extend(theme, {
        WooWidgetToggle: WooWidgetToggle
    });

    // jquery plugin
    $.fn.themeWooWidgetToggle = function(opts) {
        return this.map(function() {
            var $this = $(this);

            if ($this.data(instanceName)) {
                return $this.data(instanceName);
            } else {
                return new theme.WooWidgetToggle($this, opts);
            }

        });
    }

}).apply(this, [window.theme, jQuery]);


// Woocommerce Widget Accordion
(function(theme, $) {

    theme = theme || {};

    var instanceName = '__wooWidgetAccordion';

    var WooWidgetAccordion = function($el, opts) {
        return this.initialize($el, opts);
    };

    WooWidgetAccordion.defaults = {

    };

    WooWidgetAccordion.prototype = {
        initialize: function($el, opts) {
            if ($el.data(instanceName)) {
                return this;
            }

            this.$el = $el;

            this
                .setData()
                .setOptions(opts)
                .build();

            return this;
        },

        setData: function() {
            this.$el.data(instanceName, this);

            return this;
        },

        setOptions: function(opts) {
            this.options = $.extend(true, {}, WooWidgetAccordion.defaults, opts, {
                wrapper: this.$el
            });

            return this;
        },

        build: function() {
            var self = this,
                $el = this.options.wrapper;

            $el.find('ul.children').each(function() {
                var $this = $(this);
                if (!$this.prev().hasClass('toggle')) {
                    $this.before(
                        $('<span class="toggle"></span>').click(function() {
                            var $that = $(this);
                            if ($that.next().is(":visible")) {
                                $that.parent().removeClass('open').addClass('closed');
                            } else {
                                $that.parent().addClass('open').removeClass('closed');
                            }
                            $that.next().stop().slideToggle(200);
                            theme.refreshVCContent();
                        })
                    );
                }
            });
            $el.find('li[class*="current-"]').addClass('current');

            return this;
        }
    };

    // expose to scope
    $.extend(theme, {
        WooWidgetAccordion: WooWidgetAccordion
    });

    // jquery plugin
    $.fn.themeWooWidgetAccordion = function(opts) {
        return this.map(function() {
            var $this = $(this);

            if ($this.data(instanceName)) {
                return $this.data(instanceName);
            } else {
                return new theme.WooWidgetAccordion($this, opts);
            }

        });
    }

}).apply(this, [window.theme, jQuery]);


// Woocommerce Products Slider

// Woocommerce Widget Toggle
(function(theme, $) {

    theme = theme || {};

    var instanceName = '__wooProductsSlider';

    var WooProductsSlider = function($el, opts) {
        return this.initialize($el, opts);
    };

    WooProductsSlider.defaults = {
        rtl: theme.rtl,
        autoplay : theme.slider_autoplay == '1' ? true : false,
        autoplayTimeout: theme.slider_speed ? theme.slider_speed : 5000,
        loop: theme.slider_loop,
        nav: false,
        navText: ["", ""],
        dots: false,
        autoplayHoverPause : true,
        items : 1,
        responsive : {},
        autoHeight : true,
        lazyLoad: true
    };

    WooProductsSlider.prototype = {
        initialize: function($el, opts) {
            if ($el.data(instanceName)) {
                return this;
            }

            this.$el = $el;

            this
                .setData()
                .setOptions(opts)
                .build();

            return this;
        },

        setData: function() {
            this.$el.data(instanceName, this);

            return this;
        },

        setOptions: function(opts) {
            this.options = $.extend(true, {}, WooProductsSlider.defaults, opts, {
                wrapper: this.$el
            });

            return this;
        },

        build: function() {
            var self = this,
                $el = this.options.wrapper,
                lg = this.options.lg,
                md = this.options.md,
                xs = this.options.xs,
                ls = this.options.ls,
                $slider_wrapper = $el.closest('.slider-wrapper'),
                single = this.options.single,
                dots = this.options.dots,
                nav = this.options.nav,
                responsive = {},
                items,
                scrollWidth = theme.getScrollbarWidth(),
                count = $el.find('> *').length,
                w_xs = 481 - scrollWidth,
                w_md = 768 - scrollWidth,
                w_lg = 992 - scrollWidth;

            if ($el.find('.product').get(0)) {
                portoCalcSliderMargin($slider_wrapper, $el.find('.product').css('padding-left'));
                portoCalcSliderButtonsPosition($slider_wrapper, $el.find('.product').css('padding-left'));
            } else if ($el.find('.product-category').get(0)) {
                portoCalcSliderMargin($slider_wrapper, $el.find('.product-category').css('padding-left'));
                portoCalcSliderButtonsPosition($slider_wrapper, $el.find('.product-category').css('padding-left'));
            }
            portoCalcSliderTitleLine($slider_wrapper);

            if (single) {
                items = 1;
            } else {
                items = lg ? lg : 1;
                if (lg) responsive[w_lg] = { items: lg, loop: (this.options.loop && count > lg) ? true : false };
                if (md) responsive[w_md] = { items: md, loop: (this.options.loop && count > md) ? true : false };
                if (xs) responsive[w_xs] = { items: xs, loop: (this.options.loop && count > xs) ? true : false };
                if (ls) responsive[0] = { items: ls, loop: (this.options.loop && count > ls) ? true : false };
            }

            this.options = $.extend(true, {}, this.options, {
                loop: (this.options.loop && count > items) ? true : false,
                items : items,
                responsive : responsive,
                onRefresh: function() {
                    if ($el.find('.product').get(0)) {
                        portoCalcSliderMargin($slider_wrapper, $el.find('.product').css('padding-left'));
                        portoCalcSliderButtonsPosition($slider_wrapper, $el.find('.product').css('padding-left'));
                    } else if ($el.find('.product-category').get(0)) {
                        portoCalcSliderMargin($slider_wrapper, $el.find('.product-category').css('padding-left'));
                        portoCalcSliderButtonsPosition($slider_wrapper, $el.find('.product-category').css('padding-left'));
                    }
                    portoCalcSliderTitleLine($slider_wrapper);
                },
                onInitialized: function() {
                    if ($el.find('.product').get(0)) {
                        portoCalcSliderButtonsPosition($slider_wrapper, $el.find('.product').css('padding-left'));
                    } else if ($el.find('.product-category').get(0)) {
                        portoCalcSliderButtonsPosition($slider_wrapper, $el.find('.product-category').css('padding-left'));
                    }
                },
                touchDrag: (count == 1) ? false : true,
                mouseDrag: (count == 1) ? false : true
            });

            // Auto Height Fixes
            if (this.options.autoHeight) {
                function calcOwlHeight() {
                    var h = 0;
                    $el.find('.owl-item.active').each(function() {
                        if (h < $(this).height())
                            h = $(this).height();
                    });
                    $el.find('.owl-stage-outer').height( h );
                }
                $(window).on('resize', function() {
                    calcOwlHeight();
                });

                $(window).on('load', function() {
                    calcOwlHeight();
                });
            }

            $el.owlCarousel(this.options);

            return this;
        }
    };

    // expose to scope
    $.extend(theme, {
        WooProductsSlider: WooProductsSlider
    });

    // jquery plugin
    $.fn.themeWooProductsSlider = function(opts) {
        return this.map(function() {
            var $this = $(this);

            if ($this.data(instanceName)) {
                return $this.data(instanceName);
            } else {
                return new theme.WooProductsSlider($this, opts);
            }

        });
    }

}).apply(this, [window.theme, jQuery]);


// Mobile Panel
(function(theme, $) {

    $(function() {
        $('.mobile-toggle').click(function(e) {
            if ($('html').hasClass('panel-opened')) {
                $('html').removeClass('panel-opened');
                $('.panel-overlay').removeClass('active');
            } else {
                $('html').addClass('panel-opened');
                $('.panel-overlay').addClass('active');
            }
        });

        $('.panel-overlay').click(function() {
            $('html').removeClass('panel-opened');
            $(this).removeClass('active');
        });

        $('#nav-panel-close').click(function() {
            $('.panel-overlay').click();
        });

        $(window).on('resize', function() {
            if ($(window).width() > 991 - theme.getScrollbarWidth()) {
                $('.panel-overlay').click();
            }
        });
    });

}).apply(this, [window.theme, jQuery]);


// Portfolio Like
(function(theme, $) {

    $(function() {
        $(document).on('click', '.portfolio-like', function(e) {
            e.preventDefault();
            var $this = $(this),
                $parent = $this.parent(),
                portfolio_id = $this.attr('data-id');

            $.post(
                theme.ajax_url, {
                    portfolio_id: portfolio_id,
                    action: 'porto_portfolio-like'
                },
                function(data) {
                    if (data) {
                        $this.remove();
                        $parent.html(data);
                        $parent.find("data-tooltip").tooltip();
                    }
                }
            );
        });
    });

}).apply(this, [window.theme, jQuery]);


// Scroll to Top
(function(theme, $) {

    theme = theme || {};

    $.extend(theme, {

        ScrollToTop: {

            defaults: {
                html: '<i class="fa fa-chevron-up"></i>',
                offsetx: 10,
                offsety: 0
            },

            initialize: function(html, offsetx, offsety) {
                this.html = (html || this.defaults.html);
                this.offsetx = (offsetx || this.defaults.offsetx);
                this.offsety = (offsety || this.defaults.offsety);

                this.build();

                return this;
            },

            build: function() {
                var self = this;

                if (typeof scrolltotop !== 'undefined') {
                    // scroll top control
                    scrolltotop.controlHTML = self.html;
                    scrolltotop.controlattrs = {offsetx: self.offsetx, offsety: self.offsety};
                    scrolltotop.init();
                }

                return self;
            }
        }

    });

}).apply(this, [window.theme, jQuery]);


// Mega Menu
(function(theme, $) {

    theme = theme || {};

    $.extend(theme, {

        MegaMenu: {

            defaults: {
                menu: $('.mega-menu')
            },

            initialize: function($menu) {
                this.$menu = ($menu || this.defaults.menu);

                this.build()
                    .events();

                return this;
            },

            popupWidth: function() {
                var winWidth = $(window).width() + theme.getScrollbarWidth();
                var popupWidth = $(window).width() - theme.grid_gutter_width * 2;
                if (!$('body').hasClass('wide')) {
                    if (winWidth >= theme.container_width + theme.grid_gutter_width - 1)
                        popupWidth = theme.container_width - theme.grid_gutter_width;
                    else if (winWidth >= 992)
                        popupWidth = 960 - theme.grid_gutter_width;
                    else if (winWidth >= 768)
                        popupWidth = 720 - theme.grid_gutter_width;
                }
                return popupWidth;
            },

            build: function() {
                var self = this;

                self.$menu.each( function() {
                    var $menu = $(this);
                    var $menu_container = $menu.closest('.container');
                    var container_width = self.popupWidth();
                    var offset = 0;

                    if ($menu_container.length) {
                        if (theme.rtl) {
                            offset = ($menu_container.offset().left + $menu_container.width()) - ($menu.offset().left + $menu.width()) + parseInt($menu_container.css('padding-right'));
                        } else {
                            offset = $menu.offset().left - $menu_container.offset().left - parseInt($menu_container.css('padding-left'));
                        }
                        offset = (offset == 1) ? 0 : offset;
                    }

                    var $menu_items = $menu.find('> li');

                    $menu_items.each( function() {
                        var $menu_item = $(this);
                        var $popup = $menu_item.find('> .popup');
                        if ($popup.length > 0) {
                            $popup.css('display', 'block');
                            if ($menu_item.hasClass('wide')) {
                                $popup.css('left', 0);
                                var padding = parseInt($popup.css('padding-left')) + parseInt($popup.css('padding-right')) +
                                    parseInt($popup.find('> .inner').css('padding-left')) + parseInt($popup.find('> .inner').css('padding-right'));

                                var row_number = 4;

                                if ($menu_item.hasClass('col-2')) row_number = 2;
                                if ($menu_item.hasClass('col-3')) row_number = 3;
                                if ($menu_item.hasClass('col-4')) row_number = 4;
                                if ($menu_item.hasClass('col-5')) row_number = 5;
                                if ($menu_item.hasClass('col-6')) row_number = 6;

                                if ($(window).width() < 992 - theme.scrollbarWidth)
                                    row_number = 1;

                                var col_length = 0;
                                $popup.find('> .inner > ul > li').each(function() {
                                    var cols = parseFloat($(this).attr('data-cols'));
                                    if (cols <= 0)
                                        cols = 1;

                                    if (cols > row_number)
                                        cols = row_number;

                                    col_length += cols;
                                });

                                if (col_length > row_number) col_length = row_number;

                                var popup_max_width = $popup.find('.inner').css('max-width');
                                var col_width = container_width / row_number;
                                if ('none' !== popup_max_width && popup_max_width < container_width) {
                                    col_width = parseInt(popup_max_width) / row_number;
                                }

                                $popup.find('> .inner > ul > li').each(function() {
                                    var cols = parseFloat($(this).attr('data-cols'));
                                    if (cols <= 0)
                                        cols = 1;

                                    if (cols > row_number)
                                        cols = row_number;

                                    if ($menu_item.hasClass('pos-center') || $menu_item.hasClass('pos-left') || $menu_item.hasClass('pos-right'))
                                        $(this).css('width', (100 / col_length * cols) + '%');
                                    else
                                        $(this).css('width', (100 / row_number * cols) + '%');
                                });

                                if ($menu_item.hasClass('pos-center')) { // position center
                                    $popup.find('> .inner > ul').width(col_width * col_length - padding);
                                    var left_position = $popup.offset().left - ($(window).width() - col_width * col_length) / 2;
                                    $popup.css({
                                        'left': -left_position
                                    });
                                } else if ($menu_item.hasClass('pos-left')) { // position left
                                    $popup.find('> .inner > ul').width(col_width * col_length - padding);
                                    $popup.css({
                                        'left': 0
                                    });
                                } else if ($menu_item.hasClass('pos-right')) { // position right
                                    $popup.find('> .inner > ul').width(col_width * col_length - padding);
                                    $popup.css({
                                        'left': 'auto',
                                        'right': 0
                                    });
                                } else { // position justify
                                    $popup.find('> .inner > ul').width(container_width - padding);
                                    if (theme.rtl) {
                                        $popup.css({
                                            'right': 0,
                                            'left': 'auto'
                                        });
                                        var right_position = ($popup.offset().left + $popup.width()) - ($menu.offset().left + $menu.width()) - offset;
                                        $popup.css({
                                            'right': right_position,
                                            'left': 'auto'
                                        });
                                    } else {
                                        $popup.css({
                                            'left': 0,
                                            'right': 'auto'
                                        });
                                        var left_position = $popup.offset().left - $menu.offset().left + offset;
                                        $popup.css({
                                            'left': -left_position,
                                            'right': 'auto'
                                        });
                                    }
                                }
                            }
                            if (!($menu.hasClass('effect-down')))
                                $popup.css('display', 'none');

                            $menu_item.hoverIntent(
                                $.extend({}, theme.hoverIntentConfig, {
                                    over: function(){
                                        if (!($menu.hasClass('effect-down')))
                                            $menu_items.find('.popup').hide();
                                        $popup.show();
                                    },
                                    out: function(){
                                        if (!($menu.hasClass('effect-down')))
                                            $popup.hide();
                                    }
                                })
                            );
                        }
                    });
                });

                return self;
            },

            events: function() {
                var self = this;

                $(window).on('resize', function() {
                    self.build();
                });

                setTimeout(function() {
                    self.build();
                }, 400);

                return self;
            }
        }

    });

}).apply(this, [window.theme, jQuery]);


// Sidebar Menu
(function(theme, $) {

    theme = theme || {};

    $.extend(theme, {

        SidebarMenu: {

            defaults: {
                menu: $('.sidebar-menu'),
                toggle: $('.widget_sidebar_menu .widget-title .toggle'),
                menu_toggle: $('#main-toggle-menu .menu-title')
            },

            rtl: theme.rtl,

            initialize: function($menu, $toggle, $menu_toggle) {
                this.$menu = ($menu || this.defaults.menu);
                this.$toggle = ($toggle || this.defaults.toggle);
                this.$menu_toggle = ($menu_toggle || this.defaults.menu_toggle);

                this.build()
                    .events();

                return this;
            },

            isRightSidebar: function($menu) {
                var flag = false;
                if (this.rtl) {
                    flag = !($('#main').hasClass('column2-right-sidebar') || $('#main').hasClass('column2-wide-right-sidebar'));
                } else {
                    flag = $('#main').hasClass('column2-right-sidebar') || $('#main').hasClass('column2-wide-right-sidebar');
                }

                if ($menu.closest('#main-toggle-menu').length) {
                    if (this.rtl) {
                        flag = true;
                    } else {
                        flag = false;
                    }
                }

                if ($header_wrapper = $menu.closest('.header-wrapper')) {
                    if ($header_wrapper.length && $header_wrapper.hasClass('header-side-nav')) {
                        if (this.rtl) {
                            flag = true;
                        } else {
                            flag = false;
                        }
                    }
                }

                return flag;
            },

            popupWidth: function() {
                var winWidth = $(window).width() + theme.getScrollbarWidth();
                var popupWidth = $(window).width() - theme.grid_gutter_width * 2;
                if (!$('body').hasClass('wide')) {
                    if (winWidth >= theme.container_width + theme.grid_gutter_width - 1)
                        popupWidth = theme.container_width - theme.grid_gutter_width;
                    else if (winWidth >= 992)
                        popupWidth = 960 - theme.grid_gutter_width;
                    else if (winWidth >= 768)
                        popupWidth = 720 - theme.grid_gutter_width;
                }
                return popupWidth;
            },

            build: function() {
                var self = this;

                self.$menu.each( function() {
                    var $menu = $(this);
                    var $menu_container = $menu.closest('.container');
                    var container_width;
                    if ($(window).width() < 992 - theme.getScrollbarWidth())
                        container_width = self.popupWidth();
                    else
                        container_width = self.popupWidth() - $menu.width() - 45;

                    var is_right_sidebar = self.isRightSidebar($menu);

                    var $menu_items = $menu.find('> li');

                    $menu_items.each( function() {
                        var $menu_item = $(this);
                        var $popup = $menu_item.find('> .popup');
                        if ($popup.length > 0) {
                            $popup.css('display', 'block');
                            if ($menu_item.hasClass('wide')) {
                                $popup.css('left', 0);
                                var padding = parseInt($popup.css('padding-left')) + parseInt($popup.css('padding-right')) +
                                    parseInt($popup.find('> .inner').css('padding-left')) + parseInt($popup.find('> .inner').css('padding-right'));

                                var row_number = 4;

                                if ($menu_item.hasClass('col-2')) row_number = 2;
                                if ($menu_item.hasClass('col-3')) row_number = 3;
                                if ($menu_item.hasClass('col-4')) row_number = 4;
                                if ($menu_item.hasClass('col-5')) row_number = 5;
                                if ($menu_item.hasClass('col-6')) row_number = 6;

                                if ($(window).width() < 992 - theme.getScrollbarWidth())
                                    row_number = 1;

                                var col_length = 0;
                                $popup.find('> .inner > ul > li').each(function() {
                                    var cols = parseFloat($(this).attr('data-cols'));
                                    if (cols <= 0)
                                        cols = 1;

                                    if (cols > row_number)
                                        cols = row_number;

                                    col_length += cols;
                                });

                                if (col_length > row_number) col_length = row_number;

                                var popup_max_width = $popup.find('.inner').css('max-width');
                                var col_width = container_width / row_number;
                                if ('none' !== popup_max_width && popup_max_width < container_width) {
                                    col_width = parseInt(popup_max_width) / row_number;
                                }

                                $popup.find('> .inner > ul > li').each(function() {
                                    var cols = parseFloat($(this).attr('data-cols'));
                                    if (cols <= 0)
                                        cols = 1;

                                    if (cols > row_number)
                                        cols = row_number;

                                    if ($menu_item.hasClass('pos-center') || $menu_item.hasClass('pos-left') || $menu_item.hasClass('pos-right'))
                                        $(this).css('width', (100 / col_length * cols) + '%');
                                    else
                                        $(this).css('width', (100 / row_number * cols) + '%');
                                });

                                $popup.find('> .inner > ul').width(col_width * col_length + 1);
                                if (is_right_sidebar) {
                                    $popup.css({
                                        'left': 'auto',
                                        'right': $(this).width()
                                    });
                                } else {
                                    $popup.css({
                                        'left': $(this).width(),
                                        'right': 'auto'
                                    });
                                }
                            }
                            if (!($menu.hasClass('subeffect-down')))
                                $popup.css('display', 'none');

                            $menu_item.hoverIntent(
                                $.extend({}, theme.hoverIntentConfig, {
                                    over: function(){
                                        if (!($menu.hasClass('subeffect-down')))
                                            $menu_items.find('.popup').hide();
                                        $popup.show();
                                        $popup.parent().addClass('open');
                                    },
                                    out: function(){
                                        if (!($menu.hasClass('subeffect-down')))
                                            $popup.hide();
                                        $popup.parent().removeClass('open');
                                    }
                                })
                            );
                        }
                    });
                });

                return self;
            },

            events: function() {
                var self = this;

                self.$toggle.click(function() {
                    var $widget = $(this).parent().parent();
                    var $this = $(this);
                    if ($this.hasClass('closed')) {
                        $this.removeClass('closed');
                        $widget.removeClass('closed');
                        $widget.find('.sidebar-menu-wrap').stop().slideDown(400, function() {
                            $(this).attr('style', '').show();
                            self.build();
                        });
                    } else {
                        $this.addClass('closed');
                        $widget.addClass('closed');
                        $widget.find('.sidebar-menu-wrap').stop().slideUp(400, function() {
                            $(this).attr('style', '').hide();
                        });
                    }
                });

                this.$menu_toggle.click(function() {
                    var $toggle_menu = $(this).parent();
                    var $this = $(this);
                    if ($this.hasClass('closed')) {
                        $this.removeClass('closed');
                        $toggle_menu.removeClass('closed');
                        $toggle_menu.find('.toggle-menu-wrap').stop().slideDown(400, function() {
                            $(this).attr('style', '').show();
                        });

                        self.build();

                    } else {
                        $this.addClass('closed');
                        $toggle_menu.addClass('closed');
                        $toggle_menu.find('.toggle-menu-wrap').stop().slideUp(400, function() {
                            $(this).attr('style', '').hide();
                        });
                    }
                });

                $(window).on('resize', function() {
                    self.build();
                });

                setTimeout(function() {
                    self.build();
                }, 400);

                return self;
            }
        }

    });

}).apply(this, [window.theme, jQuery]);

// Sticky Header
(function(theme, $) {

    theme = theme || {};

    $.extend(theme, {

        StickyHeader: {

            defaults: {
                header: $('#header')
            },

            initialize: function($header) {
                this.$header = ($header || this.defaults.header);
                this.sticky_height = 0;
                this.sticky_offset = 0;
                this.sticky_pos = 0;
                this.change_logo = theme.change_logo;

                if (!theme.show_sticky_header || !this.$header.length)
                    return this;

                var self = this;

                var $header_top = self.$header.find('> .header-top');
                if ($header_top.length) {
                    self.$header_top = $header_top;
                    self.top_height = $header_top.height();
                } else {
                    self.$header_top = false;
                }

                var $menu_wrap = self.$header.find('> .main-menu-wrap');
                if ($menu_wrap.length) {
                    self.$menu_wrap = $menu_wrap;
                    self.menu_height = $menu_wrap.height();
                } else {
                    self.$menu_wrap = false;
                }

                self.$header_main = self.$header.find('.header-main');

                self.reveal = self.$header.parents('.header-wrapper').hasClass('header-reveal');

                self.is_sticky = false;

                self.reset()
                    .build()
                    .events();

                return self;
            },

            build: function() {
                var self = this;

                if (!self.is_sticky && ($(window).height() + self.header_height + theme.adminBarHeight() + parseInt(self.$header.css('border-top-width')) >= $(document).height())) {
                    return self;
                }

                if ($(window).height() > $('body').height())
                    window.scrollTo(0, 0);

                var scroll_top = $(window).scrollTop();

                if (self.$menu_wrap && !theme.isTablet()) {

                    self.$header_main.stop().css('top', 0);

                    if (self.$header.parent().hasClass('fixed-header'))
                        self.$header.parent().attr('style', '');

                    if (scroll_top > self.sticky_pos) {
                        if (!self.$header.hasClass('sticky-header')) {
                            self.$header.addClass('sticky-header');
                            self.$header.css('padding-bottom', self.menu_height);
                            self.$menu_wrap.stop().css('top', theme.adminBarHeight());

                            var selectric = self.$header.find('.header-main .searchform select').data('selectric');
                            if (selectric)
                                selectric.close();

                            if (self.$header.parent().hasClass('fixed-header')) {
                                self.$header_main.hide();
                                self.$header.css('padding-bottom', 0);
                            }

                            if (!self.init_toggle_menu) {
                                self.init_toggle_menu = true;
                                theme.MegaMenu.build();
                                if ($('#main-toggle-menu').length) {
                                    if ($('#main-toggle-menu').hasClass('show-always')) {
                                        $('#main-toggle-menu').data('show-always', true);
                                        $('#main-toggle-menu').removeClass('show-always');
                                    }
                                    $('#main-toggle-menu').addClass('closed');
                                    $('#main-toggle-menu .menu-title').addClass('closed');
                                    $('#main-toggle-menu .toggle-menu-wrap').attr('style', '');
                                }
                            }
                            self.is_sticky = true;
                        }
                    } else {
                        if (self.$header.hasClass('sticky-header')) {
                            self.$header.removeClass('sticky-header');
                            self.$header.css('padding-bottom', 0);
                            self.$menu_wrap.stop().css('top', 0);
                            self.$header_main.show();

                            var selectric = self.$header.find('.main-menu-wrap .searchform select').data('selectric');
                            if (selectric)
                                selectric.close();

                            if (self.init_toggle_menu) {
                                self.init_toggle_menu = false;
                                theme.MegaMenu.build();
                                if ($('#main-toggle-menu').length) {
                                    if ($('#main-toggle-menu').data('show-always')) {
                                        $('#main-toggle-menu').addClass('show-always');
                                        $('#main-toggle-menu').removeClass('closed');
                                        $('#main-toggle-menu .menu-title').removeClass('closed');
                                        $('#main-toggle-menu .toggle-menu-wrap').attr('style', '');
                                    }
                                }
                            }
                            self.is_sticky = false;
                        }
                    }
                } else {
                    self.$header_main.show();
                    if (self.$header.parent().hasClass('fixed-header') && $('#wpadminbar').length && $('#wpadminbar').css('position') == 'absolute') {
                        self.$header.parent().css('top', ($('#wpadminbar').height() - scroll_top) < 0 ? -$('#wpadminbar').height() : -scroll_top);
                    } else if (self.$header.parent().hasClass('fixed-header')) {
                        self.$header.parent().attr('style', '');
                    } else {
                        if (self.$header.parent().hasClass('fixed-header'))
                            self.$header.parent().attr('style', '');
                    }
                    if (self.$header.hasClass('sticky-menu-header') && !theme.isTablet()) {
                        self.$header_main.stop().css('top', 0);
                        if (self.change_logo) self.$header_main.removeClass('change-logo');
                        self.$header_main.removeClass('sticky');
                        self.$header.removeClass('sticky-header');
                        self.is_sticky = false;
                        self.sticky_height = 0;
                        self.sticky_offset = 0;
                    } else {
                        if (self.$menu_wrap)
                            self.$menu_wrap.stop().css('top', 0);
                        if (scroll_top > self.sticky_pos && (!theme.isTablet() || (theme.isTablet() && (!theme.isMobile() && theme.show_sticky_header_tablet) || (theme.isMobile() && theme.show_sticky_header_tablet && theme.show_sticky_header_mobile)))) {
                            if (!self.$header.hasClass('sticky-header')) {
                                self.$header.addClass('sticky-header');
                                self.$header.css('padding-bottom', self.main_height);
                                self.$header_main.addClass('sticky');
                                if (self.change_logo) self.$header_main.addClass('change-logo');
                                self.$header_main.stop().css('top', theme.adminBarHeight());

                                if (!self.init_toggle_menu) {
                                    self.init_toggle_menu = true;
                                    theme.MegaMenu.build();
                                    if ($('#main-toggle-menu').length) {
                                        if ($('#main-toggle-menu').hasClass('show-always')) {
                                            $('#main-toggle-menu').data('show-always', true);
                                            $('#main-toggle-menu').removeClass('show-always');
                                        }
                                        $('#main-toggle-menu').addClass('closed');
                                        $('#main-toggle-menu .menu-title').addClass('closed');
                                        $('#main-toggle-menu .toggle-menu-wrap').attr('style', '');
                                    }
                                }
                                self.is_sticky = true;
                            }
                        } else {
                            if (self.$header.hasClass('sticky-header')) {
                                if (self.change_logo) self.$header_main.removeClass('change-logo');
                                self.$header_main.removeClass('sticky');
                                self.$header.removeClass('sticky-header');
                                self.$header.css('padding-bottom', 0);
                                self.$header_main.stop().css('top', 0);

                                if (self.init_toggle_menu) {
                                    self.init_toggle_menu = false;
                                    theme.MegaMenu.build();
                                    if ($('#main-toggle-menu').length) {
                                        if ($('#main-toggle-menu').data('show-always')) {
                                            $('#main-toggle-menu').addClass('show-always');
                                            $('#main-toggle-menu').removeClass('closed');
                                            $('#main-toggle-menu .menu-title').removeClass('closed');
                                            $('#main-toggle-menu .toggle-menu-wrap').attr('style', '');
                                        }
                                    }
                                }
                                self.is_sticky = false;
                            }
                        }
                    }
                }

                if (!self.$header.hasClass('header-loaded'))
                    self.$header.addClass('header-loaded');

                if (!self.$header.find('.logo').hasClass('logo-transition'))
                    self.$header.find('.logo').addClass('logo-transition');

                if (self.$header.find('.overlay-logo').get(0) && !self.$header.find('.overlay-logo').hasClass('overlay-logo-transition'))
                    self.$header.find('.overlay-logo').addClass('overlay-logo-transition');

                return self;
            },

            reset: function() {
                var self = this;

                if (self.$header.find('.logo').hasClass('logo-transition'))
                    self.$header.find('.logo').removeClass('logo-transition');

                if (self.$header.find('.overlay-logo').get(0) && self.$header.find('.overlay-logo').hasClass('overlay-logo-transition'))
                    self.$header.find('.overlay-logo').removeClass('overlay-logo-transition');

                if (self.$menu_wrap && !theme.isTablet()) {
                    // show main menu
                    self.$header.addClass('sticky-header sticky-header-calc');
                    self.$header_main.addClass('sticky');
                    if (self.change_logo) self.$header_main.addClass('change-logo');

                    self.sticky_height = self.$menu_wrap.height() + parseInt(self.$menu_wrap.css('padding-top')) + parseInt(self.$menu_wrap.css('padding-bottom'));
                    self.sticky_offset = parseInt(self.$menu_wrap.css('padding-top')) + parseInt(self.$menu_wrap.css('padding-bottom'));

                    if (self.change_logo) self.$header_main.removeClass('change-logo');
                    self.$header_main.removeClass('sticky');
                    self.$header.removeClass('sticky-header sticky-header-calc');
                    self.header_height = self.$header.height() + parseInt(self.$header.css('margin-top'));
                    self.menu_height = self.$menu_wrap.height() + parseInt(self.$menu_wrap.css('padding-top')) + parseInt(self.$menu_wrap.css('padding-bottom'));
                    self.sticky_pos = (self.header_height - self.sticky_height) + $('.banner-before-header').height() + parseInt($('body').css('padding-top')) + parseInt(self.$header.css('border-top-width'));

                    if (self.reveal) {
                        self.sticky_pos += self.menu_height + 30;
                    }
                } else {
                    // show header main
                    self.$header.addClass('sticky-header sticky-header-calc');
                    self.$header_main.addClass('sticky');
                    if (self.change_logo) self.$header_main.addClass('change-logo');
                    self.sticky_main_height = self.$header_main.height();

                    if (self.change_logo) self.$header_main.removeClass('change-logo');
                    self.$header_main.removeClass('sticky');
                    self.$header.removeClass('sticky-header sticky-header-calc');
                    self.header_height = self.$header.height() + parseInt(self.$header.css('margin-top'));
                    self.main_height = self.$header_main.height();

                    self.sticky_height = self.sticky_main_height;
                    self.sticky_offset = self.main_height - self.sticky_main_height;

                    if (!(!theme.isTablet() || (theme.isTablet() && (!theme.isMobile() && theme.show_sticky_header_tablet) || (theme.isMobile() && theme.show_sticky_header_tablet && theme.show_sticky_header_mobile)))) {
                        self.sticky_height = 0;
                        self.sticky_offset = 0;
                    }

                    self.sticky_pos = (self.header_height - self.sticky_main_height) + $('.banner-before-header').height() + parseInt($('body').css('padding-top')) + parseInt(self.$header.css('border-top-width'));

                    if (self.reveal) {
                        self.sticky_pos += self.main_height + 30;
                    }
                }

                self.init_toggle_menu = false;

                self.$header_main.removeAttr('style');
                self.$header.removeAttr('style');

                return self;
            },

            events: function() {
                var self = this, win_width = 0;

                $(window).on('resize', function() {
                    if (win_width != $(window).width()) {
                        self.reset()
                            .build();
                        win_width = $(window).width();
                    }
                });

                $(window).on('scroll', function() {
                    self.build();
                });

                return self;
            }
        }

    });

}).apply(this, [window.theme, jQuery]);

// Side Nav
(function(theme, $) {

    theme = theme || {};

    $.extend(theme, {

        SideNav: {

            defaults: {
                side_nav: $('.header-side-nav #header')
            },

            bc_pos_top: 0,

            initialize: function($side_nav) {
                this.$side_nav = ($side_nav || this.defaults.side_nav);

                if (!this.$side_nav.length)
                    return this;

                var self = this;

                self.$side_nav.addClass("initialize");

                self.reset()
                    .build()
                    .events();

                return self;
            },

            build: function() {
                var self = this;

                $page_top = $('.page-top');
                $main = $('#main');

                if (theme.isTablet()) {
                    self.$side_nav.removeClass("fixed-bottom");
                    $page_top.removeClass("fixed-pos");
                    $page_top.attr('style', '');
                    $main.attr('style', '');
                } else {
                    var side_height = self.$side_nav.innerHeight();
                    var window_height = $(window).height();
                    var scroll_top = $(window).scrollTop();

                    if (side_height - window_height + theme.adminBarHeight() <= scroll_top) {
                        if (!self.$side_nav.hasClass("fixed-bottom"))
                            self.$side_nav.addClass("fixed-bottom");
                    } else {
                        if (self.$side_nav.hasClass("fixed-bottom"))
                            self.$side_nav.removeClass("fixed-bottom");
                    }

                    if ($page_top.length) {
                        if (self.page_top_offset == theme.adminBarHeight() || self.page_top_offset <= scroll_top) {
                            if (!$page_top.hasClass("fixed-pos")) {
                                $page_top.addClass("fixed-pos");
                                $page_top.css('top', theme.adminBarHeight());
                                $main.css('padding-top', $page_top.outerHeight());
                            }
                        } else {
                            if ($page_top.hasClass("fixed-pos")) {
                                $page_top.removeClass("fixed-pos");
                                $page_top.attr('style', '');
                                $main.attr('style', '');
                            }
                        }
                    }
                }

                return self;
            },

            reset: function() {
                var self = this;

                if (theme.isTablet()) {

                    self.$side_nav.attr('style', '');

                } else {

                    var w_h = $(window).height();

                    $side_bottom = self.$side_nav.find('.side-bottom');

                    self.$side_nav.css({
                        'min-height': w_h - theme.adminBarHeight(),
                        'padding-bottom': $side_bottom.height() + parseInt($side_bottom.css('margin-top')) + parseInt($side_bottom.css('margin-bottom'))
                    });

                    var appVersion			= navigator.appVersion;
                    var webkitVersion_positionStart	= appVersion.indexOf("AppleWebKit/") + 12;
                    var webkitVersion_positionEnd	= webkitVersion_positionStart + 3;
                    var webkitVersion		= appVersion.slice(webkitVersion_positionStart,webkitVersion_positionEnd);
                    if (webkitVersion  < 537) {
                        self.$side_nav.css('-webkit-backface-visibility', 'hidden');
                        self.$side_nav.css('-webkit-perspective', '1000');
                    }
                }

                $page_top = $('.page-top');
                $main = $('#main');

                if ($page_top.length) {
                    $page_top.removeClass("fixed-pos");
                    $page_top.attr('style', '');
                    $main.attr('style', '');
                    self.page_top_offset = $page_top.offset().top;
                }

                return self;
            },

            events: function() {
                var self = this;

                $(window).on('resize', function() {
                    self.reset()
                        .build();
                });

                $(window).on('scroll', function() {
                    self.build();
                });

                return self;
            }
        }

    });

}).apply(this, [window.theme, jQuery]);


// Search
(function(theme, $) {

    theme = theme || {};

    $.extend(theme, {

        Search: {

            defaults: {
                popup: $('.searchform-popup'),
                form: $('.searchform')
            },

            initialize: function($popup, $form) {
                this.$popup = ($popup || this.defaults.popup);
                this.$form = ($form || this.defaults.form);

                this.build()
                    .events();

                return this;
            },

            build: function() {
                var self = this;

                /* Change search form values */
                var $search_form_texts = self.$form.find('.text input'),
                    $search_form_cats = self.$form.find('.cat');

                if ($('.header-wrapper .searchform .cat').get(0) && $.fn.selectric) {
                    $('.header-wrapper .searchform .cat').selectric({
                        arrowButtonMarkup: '',
                        expandToItemText: true,
                        maxHeight: 240
                    });
                }

                $search_form_texts.on('change', function() {
                    var $this = $(this),
                        val = $this.val();

                    $search_form_texts.each(function() {
                        if ($this != $(this)) $(this).val(val);
                    });
                });

                $search_form_cats.on('change', function() {
                    var $this = $(this),
                        val = $this.val();

                    $search_form_cats.each(function() {
                        if ($this != $(this)) $(this).val(val);
                    });
                });

                return this;
            },

            events: function() {
                var self = this;

                self.$popup.click(function(e) {
                    e.stopPropagation();
                });
                self.$popup.find('.search-toggle').click(function(e) {
                    $(this).next().toggle();
                    e.stopPropagation();
                });

                if (!('ontouchstart' in document)) {
                    $('html,body').click(function() {
                        self.removeFormStyle();
                    });

                    $(window).on('resize', function() {
                        self.removeFormStyle();
                    });
                }

                return self;
            },

            removeFormStyle: function() {
                this.$form.removeAttr('style');
            }
        }

    });

}).apply(this, [window.theme, jQuery]);


// Hash Scroll
(function(theme, $) {

    theme = theme || {};

    $.extend(theme, {

        HashScroll: {

            initialize: function() {

                this.build()
                    .events();

                return this;
            },

            build: function() {
                var self = this;

                try {
                    var hash = window.location.hash;
                    var target = $(hash);
                    if (target.length && !(hash == '#review_form' || hash == '#reviews' || hash.indexOf('#comment-') != -1)) {
                        setTimeout(function() {
                            $('html, body').stop().animate({
                                scrollTop: target.offset().top - theme.StickyHeader.sticky_height - theme.adminBarHeight() - theme.sticky_nav_height
                            }, 600, 'easeOutQuad', function() {
                                self.activeMenuItem();
                            });
                        }, 400);
                    }

                    return self;
                } catch (err) {
                    return self;
                }
            },

            activeMenuItem: function() {
                var self = this;

                var scroll_pos = $(window).scrollTop();

                var $menu_items = $('.menu-item > a[href*="#"], .porto-sticky-nav .nav > li > a[href*="#"]');
                if ($menu_items.length) {
                    $menu_items.each(function() {
                        var $this = $(this);
                        var href = $this.attr('href');
                        var target;

                        if (href.indexOf('#') == 0) {
                            target = $(href);
                        } else {
                            var url = window.location.href;
                            url = url.substring(url.indexOf('://') + 3);
                            if (url.indexOf('#') != -1)
                                url = url.substring(0, url.indexOf('#'));
                            href = href.substring(href.indexOf('://') + 3);
                            href = href.substring(href.indexOf(url) + url.length);
                            if (href.indexOf('#') == 0) {
                                target = $(href);
                            }
                        }
                        if (target && target.get(0)) {
                            var scroll_to = target.offset().top - theme.StickyHeader.sticky_height - theme.adminBarHeight() - theme.sticky_nav_height + 1;
                            if (scroll_to <= theme.StickyHeader.sticky_pos + theme.sticky_nav_height) {
                                scroll_to = theme.StickyHeader.sticky_pos + theme.sticky_nav_height + 1;
                            }
                            var $parent = $this.parent();
                            if (scroll_to <= scroll_pos + 5) {
                                $parent.siblings().removeClass('active');
                                $parent.addClass('active');
                            } else {
                                $parent.removeClass('active');
                            }
                        }
                    });
                }

                return self;
            },

            events: function() {
                var self = this;

                $('.menu-item > a[href*="#"], .porto-sticky-nav .nav > li > a[href*="#"], a[href*="#"].hash-scroll, .hash-scroll-wrap a[href*="#"]').on('click', function(e) {
                    e.preventDefault();

                    var $this = $(this);
                    var href = $this.attr('href');
                    var target;

                    if (href.indexOf('#') == 0) {
                        target = $(href);
                    } else {
                        var url = window.location.href;
                        url = url.substring(url.indexOf('://') + 3);
                        if (url.indexOf('#') != -1)
                            url = url.substring(0, url.indexOf('#'));
                        href = href.substring(href.indexOf('://') + 3);
                        href = href.substring(href.indexOf(url) + url.length);
                        if (href.indexOf('#') == 0) {
                            target = $(href);
                        }
                    }

                    if (target && target.get(0)) {
                        var $parent = $this.parent();

                        var scroll_to = target.offset().top - theme.StickyHeader.sticky_height - theme.adminBarHeight() - theme.sticky_nav_height + 1;
                        if (scroll_to <= theme.StickyHeader.sticky_pos + theme.sticky_nav_height) {
                            scroll_to = theme.StickyHeader.sticky_pos + theme.sticky_nav_height + 1;
                        }
                        $('html, body').stop().animate({
                            scrollTop: scroll_to
                        }, 600, 'easeOutQuad', function() {
                            self.activeMenuItem();
                            $parent.siblings().removeClass('active');
                            $parent.addClass('active');
                        });
                    } else {
                        window.location.href = $this.attr('href');
                    }
                });

                $(window).on('scroll', function() {
                    self.activeMenuItem();
                });

                return self;
            }
        }

    });

}).apply(this, [window.theme, jQuery]);


// FAQs Infinite
(function(theme, $) {

    theme = theme || {};

    $.extend(theme, {

        FaqsInfinite: {

            defaults: {
                elements: '.faqs-infinite',
                itemSelector: '.faqs-infinite .faq'
            },

            initialize: function($elements, itemSelector) {
                this.$elements = ($elements || $(this.defaults.elements));
                this.itemSelector = (itemSelector || this.defaults.itemSelector);

                this.build();

                return this;
            },

            build: function() {
                var self = this;

                self.$elements.each(function() {
                    var $this = $(this),
                        curr_page = $this.attr('data-pagenum'),
                        max_page = $this.attr('data-pagemaxnum'),
                        page_path = $this.attr('data-path');
                    $this.infinitescroll($.extend(theme.infiniteConfig, {
                        itemSelector : self.itemSelector,
                        state : {
                            currPage: curr_page
                        },
                        maxPage: max_page,
                        pathParse : function(a, b) {
                            return [page_path, '/'];
                        }
                    }), function(posts) {
                        var $posts = $(posts);
                        theme.refreshVCContent($posts);
                        porto_init();

                        var $parent = $this.closest('.page-faqs');

                        var selected = 0;
                        if ($parent.find('.faq-filter').length) {
                            var selector = $parent.find('.faq-filter .active').attr('data-filter'), easing = "easeInOutQuart", timeout = 300;
                            $posts.each(function() {
                                var $that = $(this);
                                if (selector == '*') {
                                    if ($that.css('display') == 'none') $that.stop().slideDown(timeout, easing, function() {
                                        $(this).attr('style', '').show();
                                    });
                                    selected++;
                                } else {
                                    if ($that.hasClass(selector)) {
                                        if ($that.css('display') == 'none') $that.stop().slideDown(timeout, easing, function() {
                                            $(this).attr('style', '').show();
                                        });
                                        selected++;
                                    } else {
                                        $that.stop().hide();
                                    }
                                }
                            });
                        }
                        if (!selected && $parent.find('.faqs-infinite').length) {
                            $parent.find('.faqs-infinite').infinitescroll('retrieve');
                        }
                    });
                });

                return self;
            }
        }

    });

}).apply(this, [window.theme, jQuery]);


// FAQ Filter
(function(theme, $) {

    theme = theme || {};

    $.extend(theme, {

        FaqFilter: {

            defaults: {
                elements: '.faq-filter'
            },

            initialize: function($elements) {
                this.$elements = ($elements || $(this.defaults.elements));

                this.build();

                return this;
            },

            build: function() {
                var self = this;

                self.$elements.each(function() {
                    var $this = $(this);
                    $this.find('li').on('click', function(e) {
                        e.preventDefault();

                        var selector = $(this).attr('data-filter'),
                            position = $this.data('position'),
                            $parent;

                        $this.find('.active').removeClass('active');

                        if (position == 'sidebar') {
                            $parent = $('.main-content .page-faqs');
                            theme.scrolltoContainer($parent);
                            $('.sidebar-overlay').click();
                        } else if (position == 'global') {
                            $parent = $('.main-content .page-faqs');
                        } else {
                            $parent = $(this).closest('.page-faqs');
                        }

                        var selected = 0;
                        $parent.find('.faq').each(function() {
                            var $that = $(this), easing = "easeInOutQuart", timeout = 300;
                            if (selector == '*') {
                                if ($that.css('display') == 'none') $that.stop(true).slideDown(timeout, easing, function() {
                                    $(this).attr('style', '').show();
                                });
                                selected++;
                            } else {
                                if ($that.hasClass(selector)) {
                                    if ($that.css('display') == 'none') $that.stop(true).slideDown(timeout, easing, function() {
                                        $(this).attr('style', '').show();
                                    });
                                    selected++;
                                } else {
                                    if ($that.css('display') != 'none') $that.stop(true).slideUp(timeout, easing, function() {
                                        $(this).attr('style', '').hide();
                                    });
                                }
                            }
                        });

                        if (!selected && $parent.find('.faqs-infinite').length) {
                            $parent.find('.faqs-infinite').infinitescroll('retrieve');
                        }

                        $(this).addClass('active');

                        if (position == 'sidebar') {
                            self.$elements.each(function() {
                                var $that = $(this);

                                if ($that == $this && $that.data('position') != 'sidebar') return;
                                $that.find('li').removeClass('active');
                                $that.find('li[data-filter="' + selector + '"]').addClass('active');
                            });
                        }

                        window.location.hash = '#' + selector;
                        theme.refreshVCContent();
                    });
                });

                function hashchange() {
                    var $filter = $(self.$elements.get(0)), hash = window.location.hash;

                    if (hash) {
                        $filter.find('li[data-filter="' + hash.replace('#', '') + '"]').click();
                    }
                }

                $(window).on('hashchange', hashchange);
                hashchange();

                return self;
            }
        }

    });

}).apply(this, [window.theme, jQuery]);


// Filter Zoom
(function(theme, $) {

    theme = theme || {};

    $.extend(theme, {

        FilterZoom: {

            defaults: {
                elements: null
            },

            initialize: function($elements) {
                this.$elements = ($elements || this.defaults.elements);

                this.build();

                return this;
            },

            build: function() {
                var self = this;

                self.$elements.each(function() {
                    var $this = $(this),
                        zoom = $this.find('.zoom, .thumb-info-zoom').get(0);

                    if (!zoom) return;

                    $this.find('.zoom, .thumb-info-zoom').unbind('click');
                    var links = [];
                    var i = 0;
                    $this.find('article').each(function() {
                        var $that = $(this);
                        if ($that.css('display') != 'none') {
                            var $zoom = $that.find('.zoom, .thumb-info-zoom'),
                                slide,
                                src = $zoom.data('src'),
                                title = $zoom.data('title');

                            $zoom.data('index', i);
                            if ($.isArray(src)) {
                                $.each(src, function(index, value) {
                                    slide = {};
                                    slide.src = value;
                                    slide.title = title[index];
                                    links[i] = slide;
                                    i++;
                                });
                            } else {
                                slide = {};
                                slide.src = src;
                                slide.title = title;
                                links[i] = slide;
                                i++;
                            }
                        }
                    });
                    $this.find('article').each(function() {
                        var $that = $(this);
                        if ($that.css('display') != 'none') {
                            $that.off('click', '.zoom, .thumb-info-zoom').on('click', '.zoom, .thumb-info-zoom', function(e) {
                                var $zoom = $(this), $parent = $zoom.parents('.thumb-info'), offset = 0;
                                if ($parent.get(0)) {
                                    var $slider = $parent.find('.porto-carousel');
                                    if ($slider.get(0)) {
                                        offset = $slider.data('owl.carousel').current() - $slider.find('.cloned').length / 2;
                                    }
                                }
                                e.preventDefault();
                                $.magnificPopup.close();
                                $.magnificPopup.open($.extend(true, {}, theme.mfpConfig, {
                                    items: links,
                                    gallery: {
                                        enabled: true
                                    },
                                    type: 'image'
                                }), $zoom.data('index') + offset);
                                return false;
                            });
                        }
                    });
                });

                return self;
            }
        }

    });

}).apply(this, [window.theme, jQuery]);


// Posts Infinite
(function(theme, $) {

    theme = theme || {};

    $.extend(theme, {

        PostsInfinite: {

            defaults: {
                elements: '.posts-infinite',
                itemSelector: '.posts-infinite .post, .posts-infinite .timeline-date'
            },

            initialize: function($elements, itemSelector) {
                this.$elements = ($elements || $(this.defaults.elements));
                this.itemSelector = (itemSelector || this.defaults.itemSelector);

                this.build()
                    .events();

                return this;
            },

            build: function() {
                var self = this;

                self.$elements.each(function() {
                    var $this = $(this),
                        curr_page = $this.attr('data-pagenum'),
                        max_page = $this.attr('data-pagemaxnum'),
                        page_path = $this.attr('data-path');
                    $this.infinitescroll($.extend(theme.infiniteConfig, {
                        itemSelector : self.itemSelector,
                        state : {
                            currPage: curr_page
                        },
                        maxPage: max_page,
                        pathParse : function(a, b) {
                            return [page_path, '/'];
                        }
                    }), function(posts) {

                        var $posts = $(posts);
                        theme.refreshVCContent($posts);
                        porto_init();

                        if ($this.closest('.blog-posts').hasClass('blog-posts-related')) {
                            theme.FilterZoom.initialize($this.closest('.blog-posts'));
                        }

                        if ($().isotope) {
                            if ($this.hasClass('grid')) {
                                if ($this.data('isotope')) {
                                    $this.isotope('appended', $posts).isotope('layout');
                                }
                                $posts.waitForImages(function() {
                                    self.resize();
                                });
                            }
                        }
                    });
                });

                self.resize();

                return self;
            },

            resize: function() {
                var self = this;

                if (self.resizeTimer)
                    clearTimeout(self.resizeTimer);
                self.resizeTimer = setTimeout(function() {
                    self.$elements.each(function() {
                        var $this = $(this);
                        if ($().isotope) {
                            if ($this.data('isotope')) {
                                $this.isotope('layout');
                            }
                        }
                    });
                    delete self.resizeTimer;
                }, 800);

                return self;
            },

            events: function() {
                var self = this;

                $(window).on('resize', function() {
                    self.resize();
                });

                return self;
            }
        }

    });

}).apply(this, [window.theme, jQuery]);


// Portfolio Ajax on Page
(function(theme, $) {

    theme = theme || {};

    var activePortfolioAjaxOnPage;

    $.extend(theme, {

        PortfolioAjaxPage: {

            defaults: {
                elements: '.page-portfolios'
            },

            initialize: function($elements) {
                this.$elements = ($elements || $(this.defaults.elements));

                this.build();

                return this;
            },

            build: function() {
                var self = this;

                self.$elements.each(function() {

                    var $this = $(this);

                    if (!$this.find('#portfolioAjaxBox').get(0))
                        return;

                    var $container = $(this),
                        portfolioAjaxOnPage = {

                            $wrapper: $container,
                            pages: [],
                            currentPage: 0,
                            total: 0,
                            $ajaxBox: $this.find('#portfolioAjaxBox'),
                            $ajaxBoxContent: $this.find('#portfolioAjaxBoxContent'),

                            build: function() {
                                var self = this;

                                self.pages = [];
                                self.total = 0;

                                $this.find('a[data-ajax-on-page]').each(function() {
                                    self.add($(this));
                                });

                                $this.off('mousedown', 'a[data-ajax-on-page]').on('mousedown', 'a[data-ajax-on-page]', function (ev) {
                                    if (ev.which == 2) {
                                        ev.preventDefault();
                                        return false;
                                    }
                                });
                            },

                            add: function($el) {

                                var self = this,
                                    href = $el.attr('href');

                                self.pages.push(href);
                                self.total++;

                                $el.off('click').on('click', function(e) {
                                    e.preventDefault();
                                    self.show(self.pages.indexOf(href));
                                    return false;
                                });

                            },

                            events: function() {
                                var self = this;

                                // Close
                                $this.off('click', 'a[data-ajax-portfolio-close]').on('click', 'a[data-ajax-portfolio-close]', function(e) {
                                    e.preventDefault();
                                    self.close();
                                    return false;
                                });

                                if (self.total <= 1) {
                                    $('a[data-ajax-portfolio-prev], a[data-ajax-portfolio-next]').remove();
                                } else {
                                    // Prev
                                    $this.off('click', 'a[data-ajax-portfolio-prev]').on('click', 'a[data-ajax-portfolio-prev]', function(e) {
                                        e.preventDefault();
                                        self.prev();
                                        return false;
                                    });
                                    // Next
                                    $this.off('click', 'a[data-ajax-portfolio-next]').on('click', 'a[data-ajax-portfolio-next]', function(e) {
                                        e.preventDefault();
                                        self.next();
                                        return false;
                                    });
                                }
                            },

                            close: function() {
                                var self = this;

                                if (self.$ajaxBoxContent.find('.rev_slider').get(0)) {
                                    try {self.$ajaxBoxContent.find('.rev_slider').revkill();} catch(err) {}
                                }
                                self.$ajaxBoxContent.empty();
                                self.$ajaxBox.removeClass('ajax-box-init').removeClass('ajax-box-loading');
                            },

                            next: function() {
                                var self = this;
                                if(self.currentPage + 1 < self.total) {
                                    self.show(self.currentPage + 1);
                                } else {
                                    self.show(0);
                                }
                            },

                            prev: function() {
                                var self = this;

                                if((self.currentPage - 1) >= 0) {
                                    self.show(self.currentPage - 1);
                                } else {
                                    self.show(self.total - 1);
                                }
                            },

                            show: function(i) {
                                var self = this;

                                activePortfolioAjaxOnPage = null;

                                if (self.$ajaxBoxContent.find('.rev_slider').get(0)) {
                                    try {self.$ajaxBoxContent.find('.rev_slider').revkill();} catch(err) {}
                                }
                                self.$ajaxBoxContent.empty();
                                self.$ajaxBox.removeClass('ajax-box-init').addClass('ajax-box-loading');

                                theme.scrolltoContainer(self.$ajaxBox);

                                self.currentPage = i;

                                if (i < 0 || i > (self.total-1)) {
                                    self.close();
                                    return false;
                                }

                                // Ajax
                                $.ajax({
                                    url: self.pages[i],
                                    complete: function(data) {
                                        var $response = $(data.responseText),
                                            $portfolio = $response.find('#content article.portfolio'),
                                            $vc_css = $response.filter('style[data-type]:not("")'),
                                            vc_css = '';

                                        $vc_css.each(function() {
                                            vc_css += $(this).text();
                                        });

                                        if ($('#portfolioAjaxCSS').get(0)) {
                                            $('#portfolioAjaxCSS').text(vc_css);
                                        } else {
                                            $('<style id="portfolioAjaxCSS">' + vc_css + '</style>').appendTo( "head" )
                                        }

                                        $portfolio.find('.portfolio-nav-all').html('<a href="#" data-ajax-portfolio-close data-tooltip data-original-title="' + js_porto_vars.popup_close + '"><i class="fa fa-th"></i></a>');
                                        $portfolio.find('.portfolio-nav').html('<a href="#" data-ajax-portfolio-prev class="portfolio-nav-prev" data-tooltip data-original-title="' + js_porto_vars.popup_prev + '"><i class="fa"></i></a><a href="#" data-toggle="tooltip" data-ajax-portfolio-next class="portfolio-nav-next" data-tooltip data-original-title="' + js_porto_vars.popup_next + '"><i class="fa"></i></a>');
                                        self.$ajaxBoxContent.html($portfolio.html()).append('<div class="row"><div class="col-md-12"><hr class="tall"></div></div>');
                                        self.$ajaxBox.removeClass('ajax-box-loading');
                                        $(window).trigger('resize');
                                        porto_init();
                                        theme.refreshVCContent(self.$ajaxBoxContent);
                                        self.events();
                                        activePortfolioAjaxOnPage = self;
                                    }
                                });
                            }
                        };

                    portfolioAjaxOnPage.build();

                    $this.data('portfolioAjaxOnPage', portfolioAjaxOnPage);
                });

                return self;
            }
        }

    });

    // Key Press
    $(document.documentElement).on('keyup', function(e) {
        try {
            if (!activePortfolioAjaxOnPage) return;
            // Next
            if (e.keyCode == 39) {
                activePortfolioAjaxOnPage.next();
            }
            // Prev
            if (e.keyCode == 37) {
                activePortfolioAjaxOnPage.prev();
            }
        } catch(err) {}
    });

}).apply(this, [window.theme, jQuery]);


// Portfolio Ajax on Modal
(function(theme, $) {

    theme = theme || {};

    var $rev_sliders;

    $.extend(theme, {

        PortfolioAjaxModal: {

            defaults: {
                elements: '.page-portfolios'
            },

            initialize: function($elements) {
                this.$elements = ($elements || $(this.defaults.elements));

                this.build();

                return this;
            },

            build: function() {
                var self = this;

                self.$elements.each(function() {

                    var $this = $(this);

                    if (!$this.find('a[data-ajax-on-modal]').get(0))
                        return;

                    var $container = $(this),
                        portfolioAjaxOnModal = {

                            $wrapper: $container,
                            modals: [],
                            currentModal: 0,
                            total: 0,

                            build: function() {
                                var self = this;

                                self.modals = [];
                                self.total = 0;

                                $this.find('a[data-ajax-on-modal]').each(function() {
                                    self.add($(this));
                                });

                                $this.off('mousedown', 'a[data-ajax-on-modal]').on('mousedown', 'a[data-ajax-on-modal]', function (ev) {
                                    if (ev.which == 2) {
                                        ev.preventDefault();
                                        return false;
                                    }
                                });
                            },

                            add: function($el) {

                                var self = this,
                                    href = $el.attr('href'),
                                    index = self.total;

                                self.modals.push({src: href});
                                self.total++;

                                $el.off('click').on('click', function(e) {
                                    e.preventDefault();
                                    self.show(index);
                                    return false;
                                });

                            },

                            next: function() {
                                var self = this;
                                if(self.currentModal + 1 < self.total) {
                                    self.show(self.currentModal + 1);
                                } else {
                                    self.show(0);
                                }
                            },

                            prev: function() {
                                var self = this;

                                if((self.currentModal - 1) >= 0) {
                                    self.show(self.currentModal - 1);
                                } else {
                                    self.show(self.total - 1);
                                }
                            },

                            show: function(i) {
                                var self = this;

                                self.currentModal = i;

                                if (i < 0 || i > (self.total-1)) {
                                    return false;
                                }

                                $.magnificPopup.close();
                                $.magnificPopup.open($.extend(true, {}, theme.mfpConfig, {
                                    type: 'ajax',
                                    items: self.modals,
                                    gallery: {
                                        enabled: true
                                    },
                                    ajax: {
                                        settings: {
                                            type: 'post',
                                            data: {
                                                ajax_action: 'portfolio_ajax_modal'
                                            }
                                        }
                                    },
                                    mainClass: 'portfolio-ajax-modal',
                                    callbacks: {
                                        parseAjax: function(mfpResponse) {
                                            var $response = $(mfpResponse.data),
                                                $portfolio = $response.find('#content article.portfolio'),
                                                $vc_css = $response.filter('style[data-type]:not("")'),
                                                vc_css = '';

                                            $vc_css.each(function() {
                                                vc_css += $(this).text();
                                            });

                                            if ($('#portfolioAjaxCSS').get(0)) {
                                                $('#portfolioAjaxCSS').text(vc_css);
                                            } else {
                                                $('<style id="portfolioAjaxCSS">' + vc_css + '</style>').appendTo( "head" )
                                            }

                                            $portfolio.find('.portfolio-nav-all').html('<a href="#" data-ajax-portfolio-close data-tooltip data-original-title="' + js_porto_vars.popup_close + '" data-placement="bottom"><i class="fa fa-th"></i></a>');
                                            $portfolio.find('.portfolio-nav').html('<a href="#" data-ajax-portfolio-prev class="portfolio-nav-prev" data-tooltip data-original-title="' + js_porto_vars.popup_prev + '" data-placement="bottom"><i class="fa"></i></a><a href="#" data-toggle="tooltip" data-ajax-portfolio-next class="portfolio-nav-next" data-tooltip data-original-title="' + js_porto_vars.popup_next + '" data-placement="bottom"><i class="fa"></i></a>');
                                            mfpResponse.data = '<div class="ajax-container">' + $portfolio.html() + '</div>';
                                        },
                                        ajaxContentAdded: function() {
                                            // Wrapper
                                            var $wrapper = $('.portfolio-ajax-modal');

                                            // Close
                                            $wrapper.find('a[data-ajax-portfolio-close]').on('click', function(e) {
                                                e.preventDefault();
                                                $.magnificPopup.close();
                                                return false;
                                            });

                                            $rev_sliders = $wrapper.find('.rev_slider');

                                            // Remove Next and Close
                                            if(self.modals.length <= 1) {
                                                $wrapper.find('a[data-ajax-portfolio-prev], a[data-ajax-portfolio-next]').remove();
                                            } else {
                                                // Prev
                                                $wrapper.find('a[data-ajax-portfolio-prev]').on('click', function(e) {
                                                    e.preventDefault();
                                                    if ($rev_sliders && $rev_sliders.get(0)) {
                                                        try {$rev_sliders.revkill();} catch(err) {}
                                                    }
                                                    $wrapper.find('.mfp-arrow-left').trigger('click');
                                                    return false;
                                                });
                                                // Next
                                                $wrapper.find('a[data-ajax-portfolio-next]').on('click', function(e) {
                                                    e.preventDefault();
                                                    if ($rev_sliders && $rev_sliders.get(0)) {
                                                        try {$rev_sliders.revkill();} catch(err) {}
                                                    }
                                                    $wrapper.find('.mfp-arrow-right').trigger('click');
                                                    return false;
                                                });
                                            }
                                            $(window).trigger('resize');
                                            porto_init();
                                            theme.refreshVCContent($wrapper);
                                            setTimeout(function() {
                                                var videos = $wrapper.find('video');
                                                if (videos.get(0)) {
                                                    videos.each(function() {
                                                        $(this)[0].play();
                                                        $(this).parent().parent().parent().find('.video-controls').attr('data-action','play');
                                                        $(this).parent().parent().parent().find('.video-controls').html('<i class="ult-vid-cntrlpause"></i>');
                                                    });
                                                }
                                            }, 600);
                                            $wrapper.off('scroll').on('scroll', function() {
                                                $.fn.appear.run();
                                            });
                                        },
                                        change: function() {
                                            $('.mfp-wrap .ajax-container').click();
                                        },
                                        beforeClose: function() {
                                            if ($rev_sliders && $rev_sliders.get(0)) {
                                                try {$rev_sliders.revkill();} catch(err) {}
                                            }
                                            // Wrapper
                                            var $wrapper = $('.portfolio-ajax-modal');
                                            $wrapper.off('scroll');
                                        }
                                    }
                                }), i);
                            }
                        };

                    portfolioAjaxOnModal.build();

                    $this.data('portfolioAjaxOnModal', portfolioAjaxOnModal);
                });

                return self;
            }
        }

    });

    // Key Press
    $(document.documentElement).on('keydown', function(e) {
        try {
            if (e.keyCode == 37 || e.keyCode == 39) {
                if ($rev_sliders && $rev_sliders.get(0)) {
                    $rev_sliders.revkill();
                }
            }
        } catch(err) {}
    });

}).apply(this, [window.theme, jQuery]);


// Portfolios Infinite
(function(theme, $) {

    theme = theme || {};

    $.extend(theme, {

        PortfoliosInfinite: {

            defaults: {
                elements: '.portfolios-infinite',
                itemSelector: '.portfolios-infinite .portfolio, .portfolios-infinite .timeline-date'
            },

            initialize: function($elements, itemSelector) {
                this.$elements = ($elements || $(this.defaults.elements));
                this.itemSelector = (itemSelector || this.defaults.itemSelector);

                this.build()
                    .events();

                return this;
            },

            build: function() {
                var self = this;

                self.$elements.each(function() {
                    var $this = $(this),
                        curr_page = $this.attr('data-pagenum'),
                        max_page = $this.attr('data-pagemaxnum'),
                        page_path = $this.attr('data-path');
                    $this.infinitescroll($.extend(theme.infiniteConfig, {
                        itemSelector : self.itemSelector,
                        state : {
                            currPage: curr_page
                        },
                        maxPage: max_page,
                        pathParse : function(a, b) {
                            return [page_path, '/'];
                        }
                    }), function(posts) {
                        var $posts = $(posts);
                        theme.refreshVCContent($posts);
                        porto_init();

                        var $parent = $this.closest('.page-portfolios');

                        if ($parent.hasClass('portfolios-timeline')) {
                            var selected = 0;
                            if ($parent.find('.portfolio-filter').length) {
                                var selector = $parent.find('.portfolio-filter .active').attr('data-filter'), easing = "easeInOutQuart", timeout = 300;
                                $posts.each(function() {
                                    var $that = $(this);
                                    if (selector == '*') {
                                        if ($that.css('display') == 'none') $that.stop().slideDown(timeout, easing, function() {
                                            $(this).attr('style', '').show();
                                        });
                                        selected++;
                                    } else {
                                        if ($that.hasClass(selector)) {
                                            if ($that.css('display') == 'none') $that.stop().slideDown(timeout, easing, function() {
                                                $(this).attr('style', '').show();
                                            });
                                            selected++;
                                        } else {
                                            $that.stop().hide();
                                        }
                                    }
                                });
                            }
                            if (!selected && $parent.find('.portfolios-infinite').length) {
                                $parent.find('.portfolios-infinite').infinitescroll('retrieve');
                            }
                            theme.FilterZoom.initialize($parent);
                        } else {
                            if ($().isotope) {
                                if ($this.data('isotope')) {
                                    $this.isotope('appended', $posts).isotope('layout');
                                }
                                $posts.waitForImages(function() {
                                    self.resize();
                                });
                            }
                        }

                        if ($parent.data('portfolioAjaxOnPage')) {
                            $parent.data('portfolioAjaxOnPage').build();
                        }
                        if ($parent.data('portfolioAjaxOnModal')) {
                            $parent.data('portfolioAjaxOnModal').build();
                        }
                    });
                });

                self.resize();

                return self;
            },

            resize: function() {
                var self = this;

                if (self.resizeTimer)
                    clearTimeout(self.resizeTimer);
                self.resizeTimer = setTimeout(function() {
                    self.$elements.each(function() {
                        var $this = $(this);
                        if ($().isotope) {
                            if ($this.data('isotope')) {
                                $this.isotope('layout');
                            }
                        }
                    });
                    delete self.resizeTimer;
                }, 800);

                return self;
            },

            events: function() {
                var self = this;

                $(window).on('resize', function() {
                    self.resize();
                });

                return self;
            }
        }

    });

}).apply(this, [window.theme, jQuery]);


// Portfolio Filter
(function(theme, $) {

    theme = theme || {};

    $.extend(theme, {

        PortfolioFilter: {

            defaults: {
                elements: '.portfolio-filter'
            },

            initialize: function($elements) {
                this.$elements = ($elements || $(this.defaults.elements));

                this.build();

                return this;
            },

            build: function() {
                var self = this;

                self.$elements.each(function() {
                    var $this = $(this);
                    $this.find('li').on('click', function(e) {
                        e.preventDefault();

                        var selector = $(this).attr('data-filter'),
                            position = $this.data('position'),
                            $parent;

                        $this.find('.active').removeClass('active');

                        if (position == 'sidebar') {
                            $parent = $('.main-content .page-portfolios');
                            theme.scrolltoContainer($parent);
                            $('.sidebar-overlay').click();
                        } else if (position == 'global') {
                            $parent = $('.main-content .page-portfolios');
                        } else {
                            $parent = $(this).closest('.page-portfolios');
                        }

                        if ($parent.hasClass('portfolios-timeline')) {
                            var selected = 0;
                            $parent.find('.portfolio').each(function() {
                                var $that = $(this), easing = "easeInOutQuart", timeout = 300;
                                if (selector == '*') {
                                    if ($that.css('display') == 'none') $that.stop(true).slideDown(timeout, easing, function() {
                                        $(this).attr('style', '').show();
                                    });
                                    selected++;
                                } else {
                                    if ($that.hasClass(selector)) {
                                        if ($that.css('display') == 'none') $that.stop(true).slideDown(timeout, easing, function() {
                                            $(this).attr('style', '').show();
                                        });
                                        selected++;
                                    } else {
                                        if ($that.css('display') != 'none') $that.stop(true).slideUp(timeout, easing, function() {
                                            $(this).attr('style', '').hide();
                                        });
                                    }
                                }
                            });
                            if (!selected && $parent.find('.portfolios-infinite').length) {
                                $parent.find('.portfolios-infinite').infinitescroll('retrieve');
                            }
                            setTimeout(function() {
                                theme.FilterZoom.initialize($parent);
                            }, 400);
                        } else {
                            $parent.find('.portfolio-row').isotope({
                                filter: selector == '*' ? selector : '.' + selector
                            });
                        }

                        $(this).addClass('active');

                        if (position == 'sidebar') {
                            self.$elements.each(function() {
                                var $that = $(this);

                                if ($that == $this && $that.data('position') != 'sidebar') return;
                                $that.find('li').removeClass('active');
                                $that.find('li[data-filter="' + selector + '"]').addClass('active');
                            });
                        }

                        window.location.hash = '#' + selector;
                        theme.refreshVCContent();
                    });
                });

                function hashchange() {
                    var $filter = $(self.$elements.get(0)), hash = window.location.hash;

                    if (hash) {
                        $filter.find('li[data-filter="' + hash.replace('#', '') + '"]').click();
                    }
                }

                $(window).on('hashchange', hashchange);
                hashchange();

                return self;
            }
        }

    });

}).apply(this, [window.theme, jQuery]);


// Member Ajax on Page
(function(theme, $) {

    theme = theme || {};

    var activeMemberAjaxOnPage;

    $.extend(theme, {

        MemberAjaxPage: {

            defaults: {
                elements: '.page-members'
            },

            initialize: function($elements) {
                this.$elements = ($elements || $(this.defaults.elements));

                this.build();

                return this;
            },

            build: function() {
                var self = this;

                self.$elements.each(function() {

                    var $this = $(this);

                    if (!$this.find('#memberAjaxBox').get(0))
                        return;

                    var $container = $(this),
                        memberAjaxOnPage = {

                            $wrapper: $container,
                            pages: [],
                            currentPage: 0,
                            total: 0,
                            $ajaxBox: $this.find('#memberAjaxBox'),
                            $ajaxBoxContent: $this.find('#memberAjaxBoxContent'),

                            build: function() {
                                var self = this;

                                self.pages = [];
                                self.total = 0;

                                $this.find('a[data-ajax-on-page]').each(function() {
                                    self.add($(this));
                                });

                                $this.off('mousedown', 'a[data-ajax-on-page]').on('mousedown', 'a[data-ajax-on-page]', function (ev) {
                                    if (ev.which == 2) {
                                        ev.preventDefault();
                                        return false;
                                    }
                                });
                            },

                            add: function($el) {

                                var self = this,
                                    href = $el.attr('href');

                                self.pages.push(href);
                                self.total++;

                                $el.off('click').on('click', function(e) {
                                    e.preventDefault();
                                    self.show(self.pages.indexOf(href));
                                    return false;
                                });

                            },

                            next: function() {
                                var self = this;
                                if(self.currentPage + 1 < self.total) {
                                    self.show(self.currentPage + 1);
                                } else {
                                    self.show(0);
                                }
                            },

                            prev: function() {
                                var self = this;

                                if((self.currentPage - 1) >= 0) {
                                    self.show(self.currentPage - 1);
                                } else {
                                    self.show(self.total - 1);
                                }
                            },

                            show: function(i) {
                                var self = this;

                                activeMemberAjaxOnPage = null;

                                if (self.$ajaxBoxContent.find('.rev_slider').get(0)) {
                                    try {self.$ajaxBoxContent.find('.rev_slider').revkill();} catch(err) {}
                                }
                                self.$ajaxBoxContent.empty();
                                self.$ajaxBox.removeClass('ajax-box-init').addClass('ajax-box-loading');

                                theme.scrolltoContainer(self.$ajaxBox);

                                self.currentPage = i;

                                if (i < 0 || i > (self.total-1)) {
                                    self.close();
                                    return false;
                                }

                                // Ajax
                                $.ajax({
                                    url: self.pages[i],
                                    complete: function(data) {
                                        var $response = $(data.responseText),
                                            $member = $response.find('#content article.member'),
                                            $vc_css = $response.filter('style[data-type]:not("")'),
                                            vc_css = '';

                                        $vc_css.each(function() {
                                            vc_css += $(this).text();
                                        });

                                        if ($('#memberAjaxCSS').get(0)) {
                                            $('#memberAjaxCSS').text(vc_css);
                                        } else {
                                            $('<style id="memberAjaxCSS">' + vc_css + '</style>').appendTo( "head" )
                                        }

                                        var $append = self.$ajaxBox.find('.ajax-content-append'), html = '';
                                        if ($append.length) html = $append.html();
                                        self.$ajaxBoxContent.html($member.html()).prepend('<div class="row"><div class="col-md-12"><hr class="tall m-t-none"></div></div>').append('<div class="row"><div class="col-md-12"><hr class="m-t-md"></div></div>' + html);

                                        self.$ajaxBox.removeClass('ajax-box-loading');
                                        $(window).trigger('resize');
                                        porto_init();
                                        theme.refreshVCContent(self.$ajaxBoxContent);
                                        activeMemberAjaxOnPage = self;
                                    }
                                });
                            }
                        };

                    memberAjaxOnPage.build();

                    $this.data('memberAjaxOnPage', memberAjaxOnPage);
                });

                return self;
            }
        }

    });

    // Key Press
    $(document.documentElement).on('keyup', function(e) {
        try {
            if (!activeMemberAjaxOnPage) return;
            // Next
            if (e.keyCode == 39) {
                activeMemberAjaxOnPage.next();
            }
            // Prev
            if (e.keyCode == 37) {
                activeMemberAjaxOnPage.prev();
            }
        } catch(err) {}
    });

}).apply(this, [window.theme, jQuery]);


// Members Infinite
(function(theme, $) {

    theme = theme || {};

    $.extend(theme, {

        MembersInfinite: {

            defaults: {
                elements: '.members-infinite',
                itemSelector: '.members-infinite .member'
            },

            initialize: function($elements, itemSelector) {
                this.$elements = ($elements || $(this.defaults.elements));
                this.itemSelector = (itemSelector || this.defaults.itemSelector);

                this.build()
                    .events();

                return this;
            },

            build: function() {
                var self = this;

                self.$elements.each(function() {
                    var $this = $(this),
                        curr_page = $this.attr('data-pagenum'),
                        max_page = $this.attr('data-pagemaxnum'),
                        page_path = $this.attr('data-path');
                    $this.infinitescroll($.extend(theme.infiniteConfig, {
                        itemSelector : self.itemSelector,
                        state : {
                            currPage: curr_page
                        },
                        maxPage: max_page,
                        pathParse : function(a, b) {
                            return [page_path, '/'];
                        }
                    }), function(posts) {

                        var $posts = $(posts);
                        theme.refreshVCContent($posts);
                        porto_init();

                        if ($().isotope) {
                            if ($this.data('isotope')) {
                                $this.isotope('appended', $posts).isotope('layout');
                            }
                            $posts.waitForImages(function() {
                                self.resize();
                            });
                        }
                    });
                });
                self.resize();

                return self;
            },

            resize: function() {
                var self = this;

                if (self.resizeTimer)
                    clearTimeout(self.resizeTimer);
                self.resizeTimer = setTimeout(function() {
                    self.$elements.each(function() {
                        var $this = $(this);
                        if ($().isotope) {
                            if ($this.data('isotope')) {
                                $this.isotope('layout');
                            }
                        }
                    });
                    delete self.resizeTimer;
                }, 800);

                return self;
            },

            events: function() {
                var self = this;

                $(window).on('resize', function() {
                    self.resize();
                });

                return self;
            }
        }

    });

}).apply(this, [window.theme, jQuery]);


// Member Filter
(function(theme, $) {

    theme = theme || {};

    $.extend(theme, {

        MemberFilter: {

            defaults: {
                elements: '.member-filter'
            },

            initialize: function($elements) {
                this.$elements = ($elements || $(this.defaults.elements));

                this.build();

                return this;
            },

            build: function() {
                var self = this;

                self.$elements.each(function() {
                    var $this = $(this);
                    $this.find('li').on('click', function(e) {
                        e.preventDefault();

                        var selector = $(this).attr('data-filter'),
                            position = $this.data('position'),
                            $parent;

                        $this.find('.active').removeClass('active');

                        if (position == 'sidebar') {
                            $parent = $('.main-content .page-members');
                            theme.scrolltoContainer($parent);
                            $('.sidebar-overlay').click();
                        } else if (position == 'global') {
                            $parent = $('.main-content .page-members');
                        } else {
                            $parent = $(this).closest('.page-members');
                        }

                        $parent.find('.member-row').isotope({
                            filter: selector == '*' ? selector : '.' + selector
                        });

                        $(this).addClass('active');

                        if (position == 'sidebar') {
                            self.$elements.each(function() {
                                var $that = $(this);

                                if ($that == $this && $that.data('position') != 'sidebar') return;
                                $that.find('li').removeClass('active');
                                $that.find('li[data-filter="' + selector + '"]').addClass('active');
                            });
                        }

                        window.location.hash = '#' + selector;
                        theme.refreshVCContent();
                    });
                });

                function hashchange() {
                    var $filter = $(self.$elements.get(0)), hash = window.location.hash;

                    if (hash) {
                        $filter.find('li[data-filter="' + hash.replace('#', '') + '"]').click();
                    }
                }

                $(window).on('hashchange', hashchange);
                hashchange();

                return self;
            }
        }

    });

}).apply(this, [window.theme, jQuery]);


// Sort Filter
(function(theme, $) {

    theme = theme || {};

    $.extend(theme, {

        SortFilter: {

            defaults: {
                filters: '.porto-sort-filters ul',
                elements: '.porto-sort-container .row'
            },

            initialize: function($elements, $filters) {
                this.$elements = ($elements || $(this.defaults.elements));
                this.$filters = ($filters || $(this.defaults.filters));

                this.build();

                return this;
            },

            build: function() {
                var self = this;

                self.$elements.each(function() {
                    var $this = $(this);
                    $this.isotope({
                        itemSelector: '.porto-sort-item',
                        layoutMode: 'masonry',
                        getSortData: {
                            popular: '[data-popular] parseInt'
                        },
                        sortBy: 'popular',
                        isOriginLeft : !theme.rtl
                    });
                    $this.waitForImages(function() {
                        if ($this.data('isotope')) {
                            $this.isotope('layout');
                        }
                    });
                });

                self.$filters.each(function() {
                    var $this = $(this);
                    var id = $this.attr('data-sort-id');
                    var $container = $('#' + id);
                    if ($container.length) {
                        $this.on('click', 'li', function(e) {
                            e.preventDefault();

                            var $that = $(this);
                            $this.find('li').removeClass('active');
                            $that.addClass("active");

                            var sortByValue = $that.attr('data-sort-by');
                            $container.isotope({sortBy: sortByValue});

                            var filterByValue = $that.attr('data-filter-by');
                            if (filterByValue) {
                                $container.isotope({filter: filterByValue});
                            } else {
                                $container.isotope({filter: '.porto-sort-item'});
                            }
                            theme.refreshVCContent();
                        });

                        $this.find('li[data-active]').click();
                    }
                });

                return self;
            }
        }

    });

}).apply(this, [window.theme, jQuery]);


// Woocommerce Shop ToolBar Events
(function(theme, $) {

    $(function() {
        $(document).on('click', '#grid', function(e) {
            e.preventDefault();
            $(this).addClass('active');
            $('#list').removeClass('active');
            if (($.cookie && $.cookie('gridcookie') == 'list') || !$.cookie) {
                var $toggle = $('.gridlist-toggle');
                if ($toggle.length) {
                    var $parent = $toggle.parent().parent();
                    var $products = $parent.find('ul.products');
                    $products.fadeOut(300, function() {
                        $products.addClass('grid').removeClass('list').fadeIn(300);
                        theme.refreshVCContent();
                    });
                }
            }
            if ($.cookie)
                $.cookie('gridcookie', 'grid', { path: '/' });
            return false;
        });

        $(document).on('click', '#list', function(e) {
            e.preventDefault();
            $(this).addClass('active');
            $('#grid').removeClass('active');
            if (($.cookie && $.cookie('gridcookie') == 'grid') || !$.cookie) {
                var $toggle = $('.gridlist-toggle');
                if ($toggle.length) {
                    var $parent = $toggle.parent().parent();
                    var $products = $parent.find('ul.products');
                    $products.fadeOut(300, function() {
                        $products.addClass('list').removeClass('grid').fadeIn(300);
                        theme.refreshVCContent();
                    });
                }
            }
            if ($.cookie)
                $.cookie('gridcookie', 'list', { path: '/' });
            return false;
        });
    });

}).apply(this, [window.theme, jQuery]);


// Woocommerce Add to Cart, View Cart Events
(function(theme, $) {

    var $supports_html5_storage;
    try {
        $supports_html5_storage = ( 'sessionStorage' in window && window.sessionStorage !== null );

        window.sessionStorage.setItem( 'wc', 'test' );
        window.sessionStorage.removeItem( 'wc' );
    } catch( err ) {
        $supports_html5_storage = false;
    }

    var setCartCreationTimestamp = function() {
        if ( $supports_html5_storage ) {
            sessionStorage.setItem( 'wc_cart_created', ( new Date() ).getTime() );
        }
    };

    var setCartHash = function(cart_hash) {
        if ( $supports_html5_storage ) {
            localStorage.setItem( 'wc_cart_hash', cart_hash );
            sessionStorage.setItem( 'wc_cart_hash', cart_hash );
        }
    };

    var initAjaxRemoveCartItem = function() {
        $('#mini-cart .cart_list').scrollbar();
        $(document).off('click', '.widget_shopping_cart .remove-product, .shop_table.cart .remove-product').on('click', '.widget_shopping_cart .remove-product, .shop_table.cart .remove-product', function(e){
            e.preventDefault();
            var $this = $(this);
            var cart_id = $this.data("cart_id");
            var product_id = $this.data("product_id");
            $this.closest('li').find('.ajax-loading').show();

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: theme.ajax_url,
                data: {
                    action: "porto_cart_item_remove",
                    cart_id: cart_id
                },
                success: function( response ) {
                    var this_page = window.location.toString(),
                        item_count = $(response.fragments['div.widget_shopping_cart_content']).find('.mini_cart_item').length;

                    this_page = this_page.replace( 'add-to-cart', 'added-to-cart' );
                    updateCartFragment(response);
                    $( document.body ).trigger( 'wc_fragments_refreshed' );
                    $('.viewcart-' + product_id).removeClass('added');
                    $('.porto_cart_item_' + cart_id).remove();

                    // Block widgets and fragments
                    if ( item_count == 0 && ($('body').hasClass('woocommerce-cart') || $('body').hasClass('woocommerce-checkout')) ) {
                        $( '.page-content' ).fadeTo( '400', '0.8' ).block({
                            message: null,
                            overlayCSS: {
                                opacity: 0.6
                            }
                        });
                    } else {
                        $( '.shop_table.cart, .shop_table.review-order, .updating, .cart_totals' ).fadeTo( '400', '0.8' ).block({
                            message: null,
                            overlayCSS: {
                                opacity: 0.6
                            }
                        });
                    }

                    // Unblock
                    $( '.widget_shopping_cart, .updating' ).stop( true ).css( 'opacity', '1' ).unblock();

                    // Cart page elements
                    if ( item_count == 0 && ($('body').hasClass('woocommerce-cart') || $('body').hasClass('woocommerce-checkout')) ) {
                        $( '.page-content' ).load( this_page + ' .page-content:eq(0) > *', function() {
                            $( '.page-content' ).stop( true ).css( 'opacity', '1' ).unblock();
                        });
                    } else {
                        $( '.shop_table.cart' ).load( this_page + ' .shop_table.cart:eq(0) > *', function() {
                            $( '.shop_table.cart' ).stop( true ).css( 'opacity', '1' ).unblock();
                        });

                        $( '.cart_totals' ).load( this_page + ' .cart_totals:eq(0) > *', function() {
                            $( '.cart_totals' ).stop( true ).css( 'opacity', '1' ).unblock();
                        });

                        // Checkout page elements
                        $( '.shop_table.review-order' ).load( this_page + ' .shop_table.review-order:eq(0) > *', function() {
                            $( '.shop_table.review-order' ).stop( true ).css( 'opacity', '1' ).unblock();
                        });
                    }
                }
            });

            return false;
        });
    };

    var refreshCartFragment = function() {
        initAjaxRemoveCartItem();
        if ( $.cookie( 'woocommerce_items_in_cart' ) > 0 ) {
            $( '.hide_cart_widget_if_empty' ).closest( '.widget_shopping_cart' ).show();
        } else {
            $( '.hide_cart_widget_if_empty' ).closest( '.widget_shopping_cart' ).hide();
        }
    };

    var updateCartFragment = function(data) {
        if (data && data.fragments) {
            var fragments = data.fragments,
                cart_hash = data.cart_hash;

            $.each(fragments, function(key, value) {
                $(key).replaceWith(value);
            });
            if ( typeof wc_cart_fragments_params === 'undefined' ) {
                return;
            }
            /* Storage Handling */
            if ( $supports_html5_storage ) {
                var prev_cart_hash = sessionStorage.getItem( 'wc_cart_hash' );

                if ( prev_cart_hash === null || prev_cart_hash === undefined || prev_cart_hash === '' ) {
                    setCartCreationTimestamp();
                }
                sessionStorage.setItem( wc_cart_fragments_params.fragment_name, JSON.stringify( fragments ) );
                setCartHash( cart_hash );
            }
        }
    };

    $(function() {

        refreshCartFragment();

        // add ajax cart loading
        $(document).on('click', '.add_to_cart_button', function(e) {
            var $this = $(this);
            if ( $this.is('.product_type_simple') ) {
                if ( $this.attr('data-product_id') ) {
                    $this.addClass('product-adding');
                }
            }
        });

        // add to cart action
        $(document).on('click', 'span.add_to_cart_button', function(e) {
            var $this = $(this);
            if ( $this.is('.product_type_simple') ) {
                if ( !$this.attr('data-product_id') ) {
                    window.location.href = $this.attr('href');
                }
            } else {
                window.location.href = $this.attr('href');
            }
        });

        $('body').bind('added_to_cart', function() {
            $('ul.products li.product .added_to_cart').remove();
            initAjaxRemoveCartItem();
        });

        $(document.body).bind('wc_fragments_refreshed wc_fragments_loaded', function() {
            refreshCartFragment();
        });

        $(document).on( 'click', '.product-image .viewcart', function( e ){
            var link = $(this).attr('data-link');
            window.location.href = link;
            e.preventDefault();
        });

        $( document ).on( 'added_to_cart', 'body', function(event) {
            $('.add_to_cart_button.product-adding').each(function() {
                var $link = $(this);
                $link.removeClass('product-adding');
                $link.closest('.product').find('.viewcart').addClass('added');
            });
        });
    });

}).apply(this, [window.theme, jQuery]);


// Woocommerce Category Filter
(function(theme, $) {

    /**
     Copyright (c) 2010, All Right Reserved, Wong Shek Hei @ shekhei@gmail.com
     License: GNU Lesser General Public License (http://www.gnu.org/licenses/lgpl.html)
     **/
    var expr = /[.#\w].([\S]*)/g, classexpr = /(?!(\[))(\.)[^.#[]*/g, idexpr = /(#)[^.#[]*/, tagexpr = /^[\w]+/, varexpr = /(\w+?)=(['"])([^\2$]*?)\2/, simpleselector = /^[\w]+$/, parseSelector = function (d) {
        for (var c = {sel: [], val: []}, a = [], j = !1, h = "", e = [], f = 0, m = d.length; f < m; f++) {
            var g = d.charAt(f);
            if (j)if ("\\" === g && f + 1 < d.length)e.push(d.charAt(++f)); else if (h === g)h = "", e.push(g); else if (("'" === g || '"' === g) && "" === h)h = g, e.push(g); else if ("]" === g && "" === h)c.val.push(e.join("")), e = [], j = !1; else {
                if ("]" !== g || "" !== h)"" === h && "," === g ? (c.val.push(e.join("")),
                    e = []) : e.push(g)
            } else"\\" === g && f + 1 < d.length ? j && e.push(d.charAt(++f)) : "[" === g && "" === h ? j = !0 : " " === g || "+" === g ? (c.sel = c.sel.join(""), a.push(c), "+" === g && a.push({sel: "+", val: ""}), c = {sel: [], val: []}) : " " !== g && "]" !== g && c.sel.push(g)
        }
        if (0 != c.sel.length || 0 != c.val.length)c.sel = c.sel.join(""), a.push(c);
        for (f = 0; f < a.length; f++) {
            c = a[f].sel;
            if ("+" === c)b.tag = c; else {
                var b = [];
                b.tag = tagexpr.exec(c);
                b.id = idexpr.exec(c);
                b.id && $.isArray(b.id) && (b.id = b.id[0].substr(1));
                b.tag || (b.tag = "div");
                b.vars = [];
                for (d = 0; d < a[f].val.length; d++)h =
                    a[f].val[d].indexOf("="), j = a[f].val[d].substr(0, h), h = a[f].val[d].substr(h + 1), h = h.replace(/^[\s]*[\"\']*|[\"\']*[\s]*$/g, ""), "text" === j ? b.text = h : b.vars.push([j, h]);
                c = c.match(classexpr);
                j = [];
                if (c) {
                    for (d = 0; d < c.length; d++)j.push(c[d].substr(1));
                    b.className = j.join(" ")
                }
            }
            a[f] = b
        }
        return a
    }, rmFromParent = function (d) {
        var c = d.parentNode, a = d.nextSibling;
        c.removeChild(d);
        return a ? function () {
            c.insertBefore(d, a)
        } : function () {
            c.appendChild(d)
        }
    }, nonArrVer = function (d, c) {
        var a = [], a = simpleselector.test(d) ? [
                {tag: d}
            ] : parseSelector(d),
            j = [];
        "undefined" === typeof c && (c = 1);
        for (var h = [], e = [], f = [], m = document.createElement("div"), g = 0, b = 0; b < a.length; b++) {
            if ("+" == a[b].tag)e = f.slice(), --g; else {
                for (var l = 0; l < c; l++)if ("input" == a[b].tag) {
                    var k = [];
                    k.push("<" + a[b].tag);
                    a[b].id && k.push("id='" + a[b].id + "'");
                    a[b].className && (k.push("class='" + a[b].className), b + 1 === a.length && k.push(lastClass), k.push("'"));
                    if (a[b].vars)for (var n = 0; n < a[b].vars.length; n++)k.push(a[b].vars[n][0] + "='" + a[b].vars[n][1] + "'");
                    a[b].text && k.push("value='" + a[b].text + "'");
                    k.push("/>");
                    f[l] = e[l];
                    e[l] ? (e[l].innerHTML += k.join(" "), e[l] = e[l].lastChild) : (m.innerHTML = k.join(" "), e[l] = m.removeChild(m.firstChild))
                } else {
                    k = document.createElement(a[b].tag);
                    if (a[b].vars)for (n = 0; n < a[b].vars.length; n++)k.setAttribute(a[b].vars[n][0], a[b].vars[n][1]);
                    a[b].id && (k.id = a[b].id);
                    a[b].className && (k.className = a[b].className);
                    a[b].text && k.appendChild(document.createTextNode(a[b].text));
                    f[l] = e[l];
                    e[l] = e[l] ? e[l].appendChild(k) : k
                }
                g++ || Array.prototype.push.apply(h, e)
            }
            j =
                $.merge(j, e)
        }
        return $(h)
    }, arrVer = function (d, c, a) {
        for (var j = d.match(/%[^%]*%/g) || [], h = [], e = 0; e < c.length; e++) {
            for (var f = d, m = 0; m < j.length; m++)var g = j[m].substr(1, j[m].length - 2), f = f.replace(j[m], c[e][g]);
            h = $.merge(h, nonArrVer(f, a))
        }
        return $(h)
    };

    $.porto_jseldom = function (d) {
        if (2 == arguments.length && $.isPlainObject(arguments[1]))return arrVer.apply(this, [arguments[0], [arguments[1]]]);
        if (1 == arguments.length || 2 == arguments.length && !$.isArray(arguments[1]))return nonArrVer.apply(this, arguments);
        if (2 == arguments.length)return arrVer.apply(this, arguments)
    };

    var refreshPriceSlider = function() {

        var $price_slider = $('.price_slider');

        if ($price_slider.length) {
            // woocommerce_price_slider_params is required to continue, ensure the object exists
            if ( typeof woocommerce_price_slider_params === 'undefined' ) {
                return false;
            }

            // Get markup ready for slider
            $( 'input#min_price, input#max_price' ).hide();
            $( '.price_slider, .price_label' ).show();

            // Price slider uses jquery ui
            var min_price = $( '.price_slider_amount #min_price' ).data( 'min' ),
                max_price = $( '.price_slider_amount #max_price' ).data( 'max' ),
                current_min_price = parseInt( $( '.price_slider_amount #min_price').val() ? $( '.price_slider_amount #min_price').val() : min_price, 10 ),
                current_max_price = parseInt( $( '.price_slider_amount #max_price').val() ? $( '.price_slider_amount #max_price').val() : max_price, 10 );

            $( '.price_slider' ).slider({
                range: true,
                animate: true,
                min: min_price,
                max: max_price,
                values: [ current_min_price, current_max_price ],
                create: function() {

                    $( '.price_slider_amount #min_price' ).val( current_min_price );
                    $( '.price_slider_amount #max_price' ).val( current_max_price );

                    $( document.body ).trigger( 'price_slider_create', [ current_min_price, current_max_price ] );
                },
                slide: function( event, ui ) {

                    $( 'input#min_price' ).val( ui.values[0] );
                    $( 'input#max_price' ).val( ui.values[1] );

                    $( document.body ).trigger( 'price_slider_slide', [ ui.values[0], ui.values[1] ] );
                },
                change: function( event, ui ) {

                    $( document.body ).trigger( 'price_slider_change', [ ui.values[0], ui.values[1] ] );
                }
            });
        }

        // remove filter loading
        $('.yith-woo-ajax-navigation, .yith-wcan-list-price-filter').removeClass('loading');
    };

    var categoryAjaxProcess = function(href) {
        var shop_before = '.shop-loop-before',
            shop_after = '.shop-loop-after',
            shop_container = '.archive-products .products',
            shop_info = '.archive-products .woocommerce-info',
            $shop_parent = $(shop_before).parent(),
            $sticky_sidebar = $('.sidebar [data-plugin-sticky]'),
            show_toolbar = $(shop_before).data('show');

        if (show_toolbar)
            $(shop_before + ',' + shop_after).stop(true).fadeTo('400','0.8').block({message: null, overlayCSS: {opacity: 0.6}});
        if ($(shop_container).length)
            $(shop_container).html('').addClass('yith-wcan-loading');
        else
            $(shop_info).html('').addClass('yith-wcan-loading products');

        if ($sticky_sidebar.get(0)) {
            $shop_parent.css('min-height', $sticky_sidebar.height());
            theme.refreshStickySidebar(false);
        }

        theme.scrolltoContainer(show_toolbar ? $(shop_before) : $(shop_container));

        $('.yith-woo-ajax-navigation, .yith-wcan-list-price-filter').addClass('loading');

        var cart_content, widget_cart;

        if (widget_cart = $('.sidebar-content .widget_shopping_cart').get(0)) {
            cart_content = $(widget_cart).html();
        }

        $.ajax({
            url    : href,
            success: function (response) {
                var $parent = $(shop_container).parent(),
                    $response = $(response);

                if ($sticky_sidebar.get(0))
                    $shop_parent.css('min-height', 0);

                // products container
                if ($response.find(shop_container).length) {
                    $parent.html($response.find(shop_container));
                } else {
                    $parent.html($response.find('.woocommerce-info'));
                    $parent.find('.woocommerce-info').addClass('products');
                }

                if ($(shop_before + ',' + shop_after).get(0))
                    $(shop_before + ',' + shop_after).stop(true).css('opacity', '1').unblock();

                // top toolbar
                if ($response.find(shop_before).length) {
                    if ($(shop_before).length == 0) {
                        $.porto_jseldom(shop_before).insertAfter($(shop_container));
                    }

                    $(shop_before)
                        .html($response.find(shop_before).html())
                        .show();
                } else {
                    $(shop_before).empty();
                }

                // bottom toolbar
                if ($response.find(shop_after).length) {
                    $(shop_after).html($response.find(shop_after).html()).show();
                } else {
                    $(shop_after).empty();
                }

                $('.sidebar-content').each(function(index) {
                    var $this = $(this),
                        $that = $($response.find('.sidebar-content').get(index));

                    $this.html($that.html());
                });

                var $script = $response.filter('script:contains("var woocommerce_price_slider_params")').first();
                if ($script) {
                    eval($script.text());
                    window.woocommerce_price_slider_params = woocommerce_price_slider_params;
                } else {
                    window.woocommerce_price_slider_params = undefined;
                }

                //update browser history (IE doesn't support it)
                if (!navigator.userAgent.match(/msie/i)) {
                    window.history.pushState({"pageTitle": response.pageTitle}, "", href);
                }

                //trigger ready event
                $(document).trigger("yith-wcan-ajax-filtered");

                if (widget_cart = $('.sidebar-content .widget_shopping_cart').get(0)) {
                    $('.sidebar-content .widget_shopping_cart').html(cart_content);
                    if ( $.cookie( 'woocommerce_items_in_cart' ) > 0 ) {
                        $( '.hide_cart_widget_if_empty' ).closest( '.widget_shopping_cart' ).show();
                    } else {
                        $( '.hide_cart_widget_if_empty' ).closest( '.widget_shopping_cart' ).hide();
                    }
                }
            }
        });
    };

    var categoryAjax = function () {
        // add class in price filter widget
        $('.widget_price_filter').addClass('yith-wcan-list-price-filter');

        if (theme.category_ajax) {

            // order by ajax
            $( '.woocommerce-ordering' ).off( 'change', 'select.orderby' ).on( 'change', 'select.orderby', function(e) {
                e.preventDefault();

                var $this = $(this),
                    $form = $this.closest('form'),
                    href = '?' + $form.serialize();

                categoryAjaxProcess(href);
            });

            // view ajax
            $( '.woocommerce-viewing' ).off( 'change', 'select.count' ).on( 'change', 'select.count', function(e) {
                e.preventDefault();

                var $this = $(this),
                    $form = $this.closest('form'),
                    href = '?' + $form.serialize();

                categoryAjaxProcess(href);
            });

            // pagination ajax
            $( '.woocommerce-pagination' ).off( 'click', 'a.page-numbers' ).on( 'click', 'a.page-numbers', function(e) {
                e.preventDefault();

                var href = this.href;

                categoryAjaxProcess(href);
            });

            // yith filter
            $(document).off('click', '.yith-wcan a').on('click', '.yith-wcan a', function (e) {
                $(this).yith_wcan_ajax_filters(e, this);
            });

            // price filter ajax
            $( '.widget_price_filter .price_slider_wrapper').off( 'click', '.button').on( 'click', '.button', function(e) {
                e.preventDefault();

                var $this = $(this),
                    $form = $this.closest('form'),
                    action = $form.attr('action'),
                    href = action + '?' + $form.serialize(),
                    $count = $('.woocommerce-viewing select.count');

                if ($count.length) {
                    var count = $('.woocommerce-viewing select.count').val();
                    if (count != $count.find('option:not([disabled]):first').val()) {
                        href += '&count=' + count;
                    }
                }

                $('.widget_price_filter').removeClass('yith-wcan-list-price-filter');

                categoryAjaxProcess(href);
            });

            // layerd nav filter
            $('.widget_layered_nav, .widget_rating_filter, .widget_layered_nav_filters').off('click', 'a').on('click', 'a', function(e) {
                if ($(this).hasClass('yit-wcan-select-open'))
                    return;

                e.preventDefault();

                var $this = $(this),
                    href = $this.attr('href'),
                    $count = $('.woocommerce-viewing select.count');

                if ($count.length) {
                    var count = $('.woocommerce-viewing select.count').val();
                    if (count != $count.find('option:not([disabled]):first').val()) {
                        href += '&count=' + count;
                    }
                }

                var yith_select = $this.closest('.yith-wcan-select');
                if (yith_select.get(0)) {
                    yith_select.parent().css({"opacity":0, "z-index":-1});
                }

                categoryAjaxProcess(href);

                return false;
            });
            $('.widget_layered_nav select').off('change').on('change', function(e) {
                e.preventDefault();

                var $this = $(this),
                    name = $this.attr('class').replace('dropdown_layered_nav_', ''),
                    slug = $this.val(),
                    href,
                    $count = $('.woocommerce-viewing select.count');

                href = window.location.href;
                href = href.replace(/\/page\/\d+/, "").replace("&amp;", '&').replace("%2C", ',');

                var u = new Url(href);

                u.query['filtering'] = 1;
                u.query['filter_' + name] = slug;

                if ($count.length) {
                    var count = $('.woocommerce-viewing select.count').val();
                    if (count != $count.find('option:not([disabled]):first').val()) {
                        u.query['count'] = count;
                    }
                }

                href = u.toString();
                categoryAjaxProcess(href);

                return false;
            });
        } else {
            $(document).on('change', '.woocommerce-viewing select.count', function() {
                $(this).closest('form').submit();
            });
        }
    };

    var ajaxFiltered = function() {
        var shop_before = '.shop-loop-before',
            shop_after = '.shop-loop-after',
            shop_container = '.archive-products .products',
            $shop_parent = $(shop_before).parent(),
            $sticky_sidebar = $('.sidebar [data-plugin-sticky]');

        if ($sticky_sidebar.get(0)) {
            $shop_parent.css('min-height', 0);
        }

        if ($(shop_before + ',' + shop_after).get(0))
            $(shop_before + ',' + shop_after).stop(true).fadeTo('400','1').unblock();
        if ($(shop_container).find('.product').get(0)) {
            $(shop_before + ',' + shop_after).show().data('show', true);
        } else {
            $(shop_before + ',' + shop_after).hide().data('show', false);
        }

        porto_init();

        $( '.woocommerce-ordering' ).off( 'change', 'select.orderby' ).on( 'change', 'select.orderby', function() {
            $( this ).closest( 'form' ).submit();
        });

        // category ajax
        refreshPriceSlider();
        categoryAjax();
    };

    $(function() {
        // yith woo ajax filter events
        if (typeof yith_wcan != 'undefined') {
            yith_wcan.container = '.archive-products .products';
            yith_wcan.pagination = '.shop-loop-before';
            yith_wcan.result_count = '.shop-loop-after';
        }

        $(document).on('click', '.yith-wcan a', function(e){
            // add price filter loading
            var shop_before = '.shop-loop-before',
                shop_after = '.shop-loop-after',
                shop_container = '.archive-products .products',
                shop_info = '.archive-products .woocommerce-info',
                $shop_parent = $(shop_before).parent(),
                $sticky_sidebar = $('.sidebar [data-plugin-sticky]'),
                show_toolbar = $(shop_before).data('show');

            if (show_toolbar)
                $(shop_before + ',' + shop_after).stop(true).show().fadeTo('400','0.8').block({message: null, overlayCSS: {opacity: 0.6}});
            if ($(shop_container).length)
                $(shop_container).html('').addClass('yith-wcan-loading');
            else
                $(shop_info).html('').addClass('yith-wcan-loading products');

            if ($sticky_sidebar.get(0)) {
                $shop_parent.css('min-height', $sticky_sidebar.height());
                theme.refreshStickySidebar(false);
            }
            $('.yith-woo-ajax-navigation, .yith-wcan-list-price-filter').addClass('loading');
            theme.scrolltoContainer(show_toolbar ? $(shop_before) : $(shop_container));
        });

        $(document).ready(function() {
            ajaxFiltered();
        });

        $(document).on('yith-wcan-ajax-filtered', function() {
            ajaxFiltered();
        });

        categoryAjax();

        // product filter ajax
        if (theme.prdctfltr_ajax) {
            // select count
            $(document).on( 'change', '.woocommerce-viewing select.count', function() {
                $( this ).closest( 'form' ).submit();
            });
            // page number
            $(document).on( 'click', '.woocommerce-pagination a.page-numbers', function(e) {
                theme.scrolltoContainer($('.shop-loop-before'));
            });
        }
    });

}).apply(this, [window.theme, jQuery]);


// Woocommerce Product Image Slider
(function(theme, $) {

    theme = theme || {};

    var duration = 300,
        flag = false,
        thumbs_count = theme.product_thumbs_count;

    if (theme.product_zoom && (!('ontouchstart' in document) || (('ontouchstart' in document) && theme.product_zoom_mobile))) {
        var zoomConfig = {
            responsive: true,
            zoomWindowFadeIn: 200,
            zoomWindowFadeOut: 100,
            zoomType: js_porto_vars.zoom_type,
            cursor: 'grab'
        };

        if (js_porto_vars.zoom_type == 'lens') {
            zoomConfig.scrollZoom = js_porto_vars.zoom_scroll;
            zoomConfig.lensSize = js_porto_vars.zoom_lens_size;
            zoomConfig.lensShape = js_porto_vars.zoom_lens_shape;
            zoomConfig.containLensZoom = js_porto_vars.zoom_contain_lens;
            zoomConfig.lensBorder = js_porto_vars.zoom_lens_border;
            zoomConfig.borderColour = js_porto_vars.zoom_border_color;
        }

        if (js_porto_vars.zoom_type == 'inner') {
            zoomConfig.borderSize = 0;
        } else {
            zoomConfig.borderSize = js_porto_vars.zoom_border;
        }
    }

    $.extend(theme, {

        WooProductImageSlider: {

            defaults: {
                elements: '.product-image-slider'
            },

            initialize: function($elements) {
                this.$elements = ($elements || $(this.defaults.elements));

                this.build();

                return this;
            },

            build: function() {
                var self = this;

                self.$elements.each(function() {
                    var $this = $(this),
                        $product = $this.closest('.product'),
                        $thumbs_slider = $product.find('.product-thumbs-slider'),
                        currentSlide = 0,
                        count = $this.find('> *').length;

                    $this.find('> *:first-child').waitForImages(true).done(function() {

                        $thumbs_slider.owlCarousel({
                            rtl: theme.rtl,
                            loop : false,
                            autoplay : false,
                            items : thumbs_count,
                            nav: false,
                            navText: ["", ""],
                            dots: false,
                            rewind: true,
                            margin: 7,
                            stagePadding: 1,
                            onInitialized: function() {
                                self.selectThumb(null, $thumbs_slider, 0);
                                if ($thumbs_slider.find('.owl-item').length >= thumbs_count)
                                    $thumbs_slider.append('<div class="thumb-nav"><div class="thumb-prev"></div><div class="thumb-next"></div></div>');
                            }
                        }).on('click', '.owl-item', function() {
                            self.selectThumb($this, $thumbs_slider, $(this).index());
                        });

                        $thumbs_slider.on('click', '.thumb-prev', function(e) {
                            var currentThumb = $thumbs_slider.data('currentThumb');
                            self.selectThumb($this, $thumbs_slider, --currentThumb);
                        });
                        $thumbs_slider.on('click', '.thumb-next', function(e) {
                            var currentThumb = $thumbs_slider.data('currentThumb');
                            self.selectThumb($this, $thumbs_slider, ++currentThumb);
                        });

                        if (theme.product_image_popup) {
                            var links = [], i = 0;
                            $this.find('img').each(function() {
                                var slide = {};

                                slide.src = $(this).attr('href');
                                slide.title = $(this).attr('alt');

                                links[i] = slide;
                                i++;
                            });
                        }

                        $this.owlCarousel({
                            rtl: theme.rtl,
                            loop : (count > 1) ? true : false,
                            autoplay : false,
                            items : 1,
                            autoHeight : true,
                            nav: true,
                            navText: ["", ""],
                            dots: false,
                            rewind: true,
                            onInitialized : function() {
                                if (theme.product_zoom && (!('ontouchstart' in document) || (('ontouchstart' in document) && theme.product_zoom_mobile))) {
                                    $this.find('img').each(function() {
                                        var $this = $(this);
                                        zoomConfig.zoomContainer = $this.parent();
                                        $this.elevateZoom(zoomConfig);
                                    });
                                }
                            },
                            onTranslate : function(event) {
                                currentSlide = event.item.index - $this.find('.cloned').length / 2;
                                self.selectThumb(null, $thumbs_slider, currentSlide);
                            },
                            onRefreshed: function() {
                                if (theme.product_zoom && (!('ontouchstart' in document) || (('ontouchstart' in document) && theme.product_zoom_mobile))) {
                                    $this.find('img').each(function() {
                                        var $this = $(this),
                                            src = $this.attr('src'),
                                            elevateZoom = $this.data('elevateZoom');
                                        if (typeof elevateZoom != 'undefined') {
                                            elevateZoom.startZoom();
                                            elevateZoom.swaptheimage(src, src);
                                        }
                                    });
                                }
                            }
                        });

                        $this.data('links', links);

                        if (theme.product_image_popup) {
                            var $zoom_buttons = $this.next();
                            $zoom_buttons.off('click').on('click', function(e) {
                                e.preventDefault();
                                var options = {index: currentSlide, event: e};
                                $.magnificPopup.close();
                                $.magnificPopup.open($.extend(true, {}, theme.mfpConfig, {
                                    items: $this.data('links'),
                                    gallery: {
                                        enabled: true
                                    },
                                    type: 'image'
                                }), currentSlide);
                            });
                        }
                    });
                });

                return self;
            },

            selectThumb: function($image_slider, $thumbs_slider, index) {
                if (flag) return;

                flag = true;
                var len = $thumbs_slider.find('.owl-item').length,
                    actives = [],
                    i = 0;

                index = (index + len) % len;
                if ($image_slider) {
                    $image_slider.trigger('to.owl.carousel', [index, duration, true]);
                }
                $thumbs_slider.find('.owl-item').removeClass('selected');
                $thumbs_slider.find('.owl-item:eq(' + index + ')').addClass('selected');
                $thumbs_slider.data('currentThumb', index);
                $thumbs_slider.find('.owl-item.active').each(function() {
                    actives[i++] = $(this).index();
                });
                if ($.inArray(index, actives) == -1) {
                    if (Math.abs(index - actives[0]) > Math.abs(index - actives[actives.length - 1])) {
                        $thumbs_slider.trigger('to.owl.carousel', [(index - actives.length + 1) % len, duration, true]);
                    } else {
                        $thumbs_slider.trigger('to.owl.carousel', [index % len, duration, true]);
                    }
                }
                flag = false;
            }
        }

    });

}).apply(this, [window.theme, jQuery]);


// Woocommerce Quick View
(function(theme, $) {

    theme = theme || {};

    $.extend(theme, {

        WooQuickView: {

            initialize: function() {

                this.events();

                return this;
            },

            events: function() {
                var self = this;

                $(document).on('click', '.quickview', function(e) {
                    e.preventDefault();

                    var pid = $(this).attr('data-id');

                    $.fancybox({
                        href : theme.ajax_url,
                        ajax : {
                            data: {
                                action: 'porto_product_quickview',
                                pid: pid
                            }
                        },
                        type : 'ajax',
                        helpers : {
                            overlay: {
                                locked: true,
                                fixed: true
                            }
                        },
                        tpl: {
                            error    : '<p class="fancybox-error">' + theme.request_error + '</p>',
                            closeBtn : '<a title="' + js_porto_vars.popup_close + '" class="fancybox-item fancybox-close" href="javascript:;"></a>',
                            next     : '<a title="' + js_porto_vars.popup_next + '" class="fancybox-nav fancybox-next" href="javascript:;"><span></span></a>',
                            prev     : '<a title="' + js_porto_vars.popup_prev + '" class="fancybox-nav fancybox-prev" href="javascript:;"><span></span></a>'
                        },
                        autoSize: true,
                        autoWidth : true,
                        afterShow : function() {
                            setTimeout(function() {
                                porto_init();
                                theme.WooProductImageSlider.initialize($('.quickview-wrap-' + pid).find('.product-image-slider'));
                            }, 200);
                        },
                        onUpdate : function() {
                            setTimeout(function() {
                                porto_init();
                                var $slider = $('.quickview-wrap-' + pid).find('.product-image-slider');
                                if (typeof $slider.data('owl.carousel') != 'undefined' && typeof $slider.data('owl.carousel')._invalidated != 'undefined')
                                    $slider.data('owl.carousel')._invalidated.width = true;
                                $slider.trigger('refresh.owl.carousel');
                            }, 300);
                        }
                    });
                    return false;
                });

                return self;
            }
        }

    });

}).apply(this, [window.theme, jQuery]);


// Woocommerce Qty Field
(function(theme, $) {

    theme = theme || {};

    $.extend(theme, {

        WooQtyField: {

            initialize: function() {

                this.build()
                    .events();

                return this;
            },

            build: function() {
                var self = this;

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

                return self;
            },

            events: function() {
                var self = this;

                $(document).ajaxComplete(function(event, xhr, options) {
                    self.build();
                });

                return self;
            }
        }

    });

}).apply(this, [window.theme, jQuery]);


// Woocommerce Variation Form
(function(theme, $) {

    theme = theme || {};

    var duration = 300;

    $.extend(theme, {

        WooVariationForm: {

            initialize: function() {

                this.events();

                return this;
            },

            events: function() {
                var self = this;

                $('.variations_form').each(function() {
                    var $variation_form = $( this ),
                        $reset_variations = $variation_form.find( '.reset_variations' );

                    if ($reset_variations.css('visibility') == 'hidden')
                        $reset_variations.hide();
                });

                $( document ).on( 'check_variations', '.variations_form', function( event, exclude, focus ) {
                    var $variation_form = $( this ),
                        $reset_variations = $variation_form.find( '.reset_variations' );

                    if ($reset_variations.css('visibility') == 'hidden')
                        $reset_variations.hide();
                });

                $( document ).on( 'reset_image', '.variations_form', function(event) {
                    var $product        = $(this).closest( '.product' );
                    var $product_img    = $product.find( 'div.product-images .woocommerce-main-image' );
                    var o_src           = $product_img.attr('data-o_src');
                    var o_title         = $product_img.attr('data-o_title');
                    var o_href          = $product_img.attr('data-o_href');
                    var $thumb_img      = $product.find( '.woocommerce-main-thumb' );
                    var o_thumb_src     = $thumb_img.attr('data-o_src');

                    var $image_slider = $product.find('.product-image-slider');
                    var $thumbs_slider = $product.find('.product-thumbs-slider');

                    if ($image_slider.length) {
                        $image_slider.trigger('to.owl.carousel', [0, duration, true]);
                    }
                    if ($thumbs_slider.length) {
                        $thumbs_slider.trigger('to.owl.carousel', [0, duration, true]);
                        $thumbs_slider.find('.owl-item:eq(0)').click();
                    }

                    var links = $image_slider.data('links');

                    if ( o_src ) {
                        $product_img
                            .attr( 'src', o_src )
                            .attr( 'srcset', '' )
                            .attr( 'alt', o_title )
                            .attr( 'href', o_href );

                        $product_img.each(function() {
                            var elevateZoom = $(this).data('elevateZoom');
                            if (typeof elevateZoom != 'undefined') {
                                elevateZoom.swaptheimage($(this).attr( 'src' ), $(this).attr( 'src' ));
                            }
                        });

                        if (typeof links != 'undefined') {
                            links[0].src = o_href;
                            links[0].title = o_title;
                        }
                    }
                    if (o_thumb_src) {
                        $thumb_img.attr( 'src', o_thumb_src );
                    }
                });

                $( document ).on( 'found_variation', '.variations_form', function(event, variation) {

                    if (typeof variation == 'undefined') {
                        return;
                    }

                    var $product              = $(this).closest( '.product' );

                    var $image_slider = $product.find('.product-image-slider');
                    var $thumbs_slider = $product.find('.product-thumbs-slider');

                    if ($image_slider.length) {
                        $image_slider.trigger('to.owl.carousel', [0, duration, true]);
                    }
                    if ($thumbs_slider.length) {
                        $thumbs_slider.trigger('to.owl.carousel', [0, duration, true]);
                        $thumbs_slider.find('.owl-item:eq(0)').click();
                    }

                    var links = $image_slider.data('links');

                    var $shop_single_image    = $product.find( 'div.product-images .woocommerce-main-image' );
                    var productimage           =  $shop_single_image.attr('data-o_src');
                    var imagetitle             =  $shop_single_image.attr('data-o_title');
                    var imagehref              =  $shop_single_image.attr('data-o_href');

                    var $shop_thumb_image = $product.find( '.woocommerce-main-thumb');
                    var thumbimage   =  $shop_thumb_image.attr('data-o_src');

                    var variation_image = variation.image_src;
                    var variation_link = variation.image_link;
                    var variation_title = variation.image_title;
                    var variation_thumb = variation.image_thumb;

                    if ( ! productimage ) {
                        productimage = ( ! $shop_single_image.attr('src') ) ? '' : $shop_single_image.attr('src');
                        $shop_single_image.attr('data-o_src', productimage );
                    }

                    if ( ! imagehref ) {
                        imagehref = ( ! $shop_single_image.attr('href') ) ? '' : $shop_single_image.attr('href');
                        $shop_single_image.attr('data-o_href', imagehref );
                    }

                    if ( ! imagetitle ) {
                        imagetitle = ( ! $shop_single_image.attr('alt') ) ? '' : $shop_single_image.attr('alt');
                        $shop_single_image.attr('data-o_title', imagetitle );
                    }

                    if ( ! thumbimage ) {
                        thumbimage = ( ! $shop_thumb_image.attr('src') ) ? '' : $shop_thumb_image.attr('src');
                        $shop_thumb_image.attr('data-o_src', thumbimage );
                    }

                    if ( variation_image ) {
                        $shop_single_image.attr( 'src', variation_image )
                        $shop_single_image.attr( 'srcset', '' )
                        $shop_single_image.attr( 'alt', variation_title )
                        $shop_single_image.attr( 'href', variation_link );
                        $shop_thumb_image.attr( 'src', variation_thumb );
                        if (typeof links != 'undefined') {
                            links[0].src = variation_link;
                            links[0].title = variation_title;
                        }
                    } else {
                        $shop_single_image.attr( 'src', productimage )
                        $shop_single_image.attr( 'srcset', '' )
                        $shop_single_image.attr( 'alt', imagetitle )
                        $shop_single_image.attr( 'href', imagehref );
                        $shop_thumb_image.attr( 'src', thumbimage );
                        if (typeof links != 'undefined') {
                            links[0].src = imagehref;
                            links[0].title = imagetitle;
                        }
                    }
                    $shop_single_image.each(function() {
                        var elevateZoom = $(this).data('elevateZoom');
                        if (typeof elevateZoom != 'undefined') {
                            elevateZoom.swaptheimage($(this).attr( 'src' ), $(this).attr( 'src' ));
                        }
                    });
                });

                return self;
            }
        }

    });

}).apply(this, [window.theme, jQuery]);


// Woocommerce Events
(function(theme, $) {

    theme = theme || {};

    $.extend(theme, {

        WooEvents: {

            initialize: function() {

                this.events();

                return this;
            },

            events: function() {
                var self = this;

                // wcml currency switcher
                $('.wcml-switcher li').on('click', function(){
                    if ($(this).parent().attr('disabled') == 'disabled')
                        return;
                    var currency = $(this).attr('rel');
                    self.loadCurrency(currency);
                });

                // woocommerce currency switcher
                $('.woocs-switcher li').on('click', function(){
                    if ($(this).parent().attr('disabled') == 'disabled')
                        return;
                    var currency = $(this).attr('rel');
                    self.loadWoocsCurrency(currency);
                });

                return self;
            },

            loadCurrency : function(currency) {
                $('.wcml-switcher').attr('disabled', 'disabled');
                $('.wcml-switcher').append('<li class="loading"></li>');
                var data = {action: 'wcml_switch_currency', currency: currency}
                $.ajax({
                    type : 'post',
                    url : theme.ajax_url,
                    data : {
                        action: 'wcml_switch_currency',
                        currency : currency
                    },
                    success: function(response) {
                        $('.wcml-switcher').removeAttr('disabled');
                        $('.wcml-switcher').find('.loading').remove();
                        window.location = window.location.href;
                    }
                });
            },

            loadWoocsCurrency : function(currency) {
                $('.woocs-switcher').attr('disabled', 'disabled');
                $('.woocs-switcher').append('<li class="loading"></li>');
                var l = window.location.href;
                l = l.split('?');
                l = l[0];
                var string_of_get = '?';
                woocs_array_of_get.currency = currency;
                
                if (Object.keys(woocs_array_of_get).length > 0) {
                    jQuery.each(woocs_array_of_get, function (index, value) {
                        string_of_get = string_of_get + "&" + index + "=" + value;
                    });
                }
                window.location = l + string_of_get;
            },

            removeParameterFromUrl : function(url, parameter) {
                return url
                    .replace(new RegExp('[?&]' + parameter + '=[^&#]*(#.*)?$'), '$1')
                    .replace(new RegExp('([?&])' + parameter + '=[^&]*&'), '$1');
            }
        }

    });

}).apply(this, [window.theme, jQuery]);


// Init Theme

function porto_init() {
    // Accordion
    (function($) {

        'use strict';

        if ($.isFunction($.fn['themeAccordion'])) {

            $(function() {
                $('.panel-group:not(.manual)').each(function() {
                    var $this = $(this),
                        opts;

                    var pluginOptions = $this.data('plugin-options');
                    if (pluginOptions)
                        opts = pluginOptions;

                    $this.themeAccordion(opts);
                });
            });

        }

    }).apply(this, [jQuery]);

    // Accordion Menu
    (function($) {

        'use strict';

        if ($.isFunction($.fn['themeAccordionMenu'])) {

            $(function() {
                $('.accordion-menu:not(.manual)').each(function() {
                    var $this = $(this),
                        opts;

                    var pluginOptions = $this.data('plugin-options');
                    if (pluginOptions)
                        opts = pluginOptions;

                    $this.themeAccordionMenu(opts);
                });
            });

        }

    }).apply(this, [jQuery]);

    // Animate
    (function($) {

        'use strict';

        if ($.isFunction($.fn['themeAnimate'])) {

            $(function() {
                $('[data-plugin-animate], [data-appear-animation]').each(function() {
                    var $this = $(this),
                        opts;

                    var pluginOptions = $this.data('plugin-options');
                    if (pluginOptions)
                        opts = pluginOptions;

                    $this.themeAnimate(opts);
                });
            });

        }

    }).apply(this, [jQuery]);

    // Carousel
    (function($) {

        'use strict';

        if ($.isFunction($.fn['themeCarousel'])) {

            $(function() {
                $('[data-plugin-carousel]:not(.manual), .porto-carousel:not(.manual)').each(function() {
                    var $this = $(this),
                        opts;

                    var pluginOptions = $this.data('plugin-options');
                    if (pluginOptions)
                        opts = pluginOptions;

                    $this.themeCarousel(opts);
                });
            });

        }

    }).apply(this, [jQuery]);

    // Chart.Circular
    (function($) {

        'use strict';

        if ($.isFunction($.fn['themeChartCircular'])) {

            $(function() {
                $('[data-plugin-chart-circular]:not(.manual), .circular-bar-chart:not(.manual)').each(function() {
                    var $this = $(this),
                        opts;

                    var pluginOptions = $this.data('plugin-options');
                    if (pluginOptions)
                        opts = pluginOptions;

                    $this.themeChartCircular(opts);
                });
            });

        }

    }).apply(this, [jQuery]);

    // Fit Video
    (function($) {

        'use strict';

        if ($.isFunction($.fn['themeFitVideo'])) {

            $(function() {
                $('.fit-video:not(.manual)').each(function() {
                    var $this = $(this),
                        opts;

                    var pluginOptions = $this.data('plugin-options');
                    if (pluginOptions)
                        opts = pluginOptions;

                    $this.themeFitVideo(opts);
                });
            });

        }

    }).apply(this, [jQuery]);

    // Flickr Zoom
    (function($) {

        'use strict';

        if ($.isFunction($.fn['themeFlickrZoom'])) {

            $(function() {
                $('.wpb_flickr_widget:not(.manual)').each(function() {
                    var $this = $(this),
                        opts;

                    var pluginOptions = $this.data('plugin-options');
                    if (pluginOptions)
                        opts = pluginOptions;

                    $this.themeFlickrZoom(opts);
                });
            });

        }

    }).apply(this, [jQuery]);

    // Lightbox
    (function($) {

        'use strict';

        if ($.isFunction($.fn['themeLightbox'])) {

            $(function() {
                $('[data-plugin-lightbox]:not(.manual), .lightbox:not(.manual)').each(function() {
                    var $this = $(this),
                        opts;

                    var pluginOptions = $this.data('plugin-options');
                    if (pluginOptions)
                        opts = pluginOptions;

                    $this.themeLightbox(opts);
                });
            });

        }

    }).apply(this, [jQuery]);

    // Masonry
    (function($) {

        'use strict';

        if ($.isFunction($.fn['themeMasonry'])) {

            $(function() {
                $('[data-plugin-masonry]:not(.manual)').each(function() {
                    var $this = $(this),
                        opts;

                    var pluginOptions = $this.data('plugin-options');
                    if (pluginOptions)
                        opts = pluginOptions;

                    $this.themeMasonry(opts);
                });
                $('.posts-grid .grid:not(.manual)').each(function() {
                    $(this).themeMasonry({
                        itemSelector: '.post'
                    });
                });
                $('.page-portfolios .portfolio-row:not(.manual)').each(function() {
                    var $parent = $(this).parent(), layoutMode = 'masonry';

                    if ($parent.hasClass('portfolios-grid'))
                        layoutMode = 'fitRows';
                    $(this).themeMasonry({
                        itemSelector: '.portfolio',
                        layoutMode: layoutMode,
                        callback: function() {
                            setTimeout(function() {
                                theme.FilterZoom.initialize($('.page-portfolios'));
                            }, 400);
                        }
                    });
                });
                $('.page-members .member-row:not(.manual)').each(function() {
                    $(this).themeMasonry({
                        itemSelector: '.member',
                        layoutMode: 'fitRows',
                        callback: function() {
                            setTimeout(function() {
                                theme.FilterZoom.initialize($('.page-members'));
                            }, 400);
                        }
                    });
                });
            });

        }

    }).apply(this, [jQuery]);

    // Preview Image
    (function($) {

        'use strict';

        if ($.isFunction($.fn['themePreviewImage'])) {

            $(function() {
                $('.thumb-info-preview .thumb-info-image:not(.manual)').each(function() {
                    var $this = $(this),
                        opts;

                    var pluginOptions = $this.data('plugin-options');
                    if (pluginOptions)
                        opts = pluginOptions;

                    $this.themePreviewImage(opts);
                });
            });

        }

    }).apply(this, [jQuery]);

    // Refresh Video Size
    (function($) {

        'use strict';

        if ($.isFunction($.fn['themeRefreshVideoSize'])) {

            $(function() {
                $('.video-cover:not(.manual) .upb_video-bg').each(function() {
                    var $this = $(this),
                        opts;

                    var pluginOptions = $this.data('plugin-options');
                    if (pluginOptions)
                        opts = pluginOptions;

                    $this.themeRefreshVideoSize(opts);
                });
            });

        }

    }).apply(this, [jQuery]);

    // Toggle
    (function($) {

        'use strict';

        if ($.isFunction($.fn['themeToggle'])) {

            $(function() {
                $('section.toggle:not(.manual)').each(function() {
                    var $this = $(this),
                        opts;

                    var pluginOptions = $this.data('plugin-options');
                    if (pluginOptions)
                        opts = pluginOptions;

                    $this.themeToggle(opts);
                });
            });

        }

    }).apply(this, [jQuery]);

    // Parallax
    (function($) {

        'use strict';

        if ($.isFunction($.fn['themeParallax'])) {

            $(function() {
                $('[data-plugin-parallax]:not(.manual)').each(function() {
                    var $this = $(this),
                        opts;

                    var pluginOptions = $this.data('plugin-options');
                    if (pluginOptions)
                        opts = pluginOptions;

                    $this.themeParallax(opts);
                });
            });

        }

    }).apply(this, [jQuery]);

    // Visual Composer Image Zoom
    (function($) {

        'use strict';

        if ($.isFunction($.fn['themeVcImageZoom'])) {

            $(function() {
                $('.porto-vc-zoom:not(.manual)').each(function() {
                    var $this = $(this),
                        opts;

                    var pluginOptions = $this.data('plugin-options');
                    if (pluginOptions)
                        opts = pluginOptions;

                    $this.themeVcImageZoom(opts);
                });
            });

        }

    }).apply(this, [jQuery]);

    // Sticky
    (function($) {

        'use strict';

        if ($.isFunction($.fn['themeSticky'])) {

            $(function() {
                $('[data-plugin-sticky]:not(.manual), .porto-sticky:not(.manual), .porto-sticky-nav:not(.manual)').each(function() {
                    var $this = $(this),
                        opts;

                    var pluginOptions = $this.data('plugin-options');
                    if (pluginOptions)
                        opts = pluginOptions;

                    $this.themeSticky(opts);
                });
            });

        }

    }).apply(this, [jQuery]);

    // Woo Widget Toggle
    (function($) {

        'use strict';

        if ($.isFunction($.fn['themeWooWidgetToggle'])) {

            $(function() {
                $('.widget_product_categories, .widget_price_filter, .widget_layered_nav, .widget_layered_nav_filters, .widget_rating_filter').find('.widget-title').each(function() {
                    var $this = $(this),
                        opts;

                    var pluginOptions = $this.data('plugin-options');
                    if (pluginOptions)
                        opts = pluginOptions;

                    $this.themeWooWidgetToggle(opts);
                });
            });

        }

    }).apply(this, [jQuery]);

    // Woo Widget Accordion
    (function($) {

        'use strict';

        if ($.isFunction($.fn['themeWooWidgetAccordion'])) {

            $(function() {
                $('.widget_product_categories, .widget_price_filter, .widget_layered_nav, .widget_layered_nav_filters, .widget_rating_filter').each(function() {
                    var $this = $(this),
                        opts;

                    var pluginOptions = $this.data('plugin-options');
                    if (pluginOptions)
                        opts = pluginOptions;

                    $this.themeWooWidgetAccordion(opts);
                });
            });

        }

    }).apply(this, [jQuery]);

    // Woo Products Slider
    (function($) {

        'use strict';

        if ($.isFunction($.fn['themeWooProductsSlider'])) {

            $(function() {
                $('.products-slider:not(.manual)').each(function() {
                    var $this = $(this),
                        opts;

                    var pluginOptions = $this.data('plugin-options');
                    if (pluginOptions)
                        opts = pluginOptions;

                    $this.themeWooProductsSlider(opts);
                });
            });

        }

    }).apply(this, [jQuery]);

    // Common
    (function($) {

        'use strict';

        // Tooltip
        if ($.isFunction($.fn['tooltip'])) {
            $("[data-tooltip]:not(.manual), [data-toggle='tooltip']:not(.manual), .star-rating:not(.manual)").tooltip();
        }

        // bootstrap dropdown hover
        $('[data-toggle="dropdown"]').dropdownHover();

        // bootstrap popover
        $("[data-toggle='popover']").popover();

        if($().waypoint) {
            // Progress bar tooltip
            $('.vc_progress_bar').each(function() {
                var $tooltips = $(this).find('.progress-bar-tooltip');
                $($tooltips.get(0)).waypoint(function() {
                    var delay = 200;
                    $tooltips.each(function(index) {
                        var $tooltip = $(this);
                        setTimeout(function() {
                            $tooltip.animate({
                                opacity: 1
                            });
                        }, 200 + delay * index);
                    });
                }, {
                    offset: '85%'
                });
            });
        }

        // Fixed video
        $('.video-fixed').each(function() {
            var $this = $(this),
                $video = $this.find('video, iframe');

            if ($video.length) {
                $(window).on('scroll', function() {
                    var offset = $(window).scrollTop() - $this.position().top + theme.adminBarHeight();
                    $video.css("cssText", "top: " + offset + "px !important;");
                });
            }
        });

        // Popup with video or map
        $('.porto-popup-iframe').magnificPopup($.extend(true, {}, theme.mfpConfig, {
            disableOn: 700,
            type: 'iframe',
            mainClass: 'mfp-fade',
            removalDelay: 160,
            preloader: false,
            fixedContentPos: false
        }));

        // Popup with video or map
        $('.porto-popup-iframe').magnificPopup($.extend(true, {}, theme.mfpConfig, {
            disableOn: 700,
            type: 'iframe',
            mainClass: 'mfp-fade',
            removalDelay: 160,
            preloader: false,
            fixedContentPos: false
        }));

        // Popup with ajax
        $('.porto-popup-ajax').magnificPopup($.extend(true, {}, theme.mfpConfig, {
            type: 'ajax'
        }));

        // Popup with content
        $('.porto-popup-content').each(function() {
            var animation = $(this).attr('data-animation');
            $(this).magnificPopup($.extend(true, {}, theme.mfpConfig, {
                type: 'inline',
                fixedContentPos: false,
                fixedBgPos: true,
                overflowY: 'auto',
                closeBtnInside: true,
                preloader: false,
                midClick: true,
                removalDelay: 300,
                mainClass: animation
            }));
        });

        // Thumb Gallery
        $('.thumb-gallery-thumbs').each(function() {
            var $thumbs = $(this),
                $detail = $thumbs.parent().find('.thumb-gallery-detail'),
                flag = false,
                duration = 300;

            if ($thumbs.data('initThumbs'))
                return;

            $detail.on('changed.owl.carousel', function(e) {
                if (!flag) {
                    flag = true;
                    var len = $detail.find('.owl-item').length,
                        cloned = $detail.find('.cloned').length;
                    if (len) {
                        $thumbs.trigger('to.owl.carousel', [(e.item.index - cloned / 2 - 1) % len, duration, true]);
                    }
                    flag = false;
                }
            });

            $thumbs.on('changed.owl.carousel', function(e) {
                if (!flag) {
                    flag = true;
                    var len = $thumbs.find('.owl-item').length,
                        cloned = $thumbs.find('.cloned').length;
                    if (len) {
                        $detail.trigger('to.owl.carousel', [(e.item.index - cloned / 2) % len, duration, true]);
                    }
                    flag = false;
                }
            }).on('click', '.owl-item', function() {
                if (!flag) {
                    flag = true;
                    var len = $thumbs.find('.owl-item').length,
                        cloned = $thumbs.find('.cloned').length;
                    if (len) {
                        $detail.trigger('to.owl.carousel', [($(this).index() - cloned / 2) % len, duration, true]);
                    }
                    flag = false;
                }
            }).data('initThumbs', true);
        });
    }).apply(this, [jQuery]);

    // Woocommerce Grid/List Toggle
    (function($) {

        'use strict';

        if ($.cookie && $.cookie('gridcookie')) {
            var $toggle = $('.gridlist-toggle');
            if ($toggle.get(0)) {
                var $parent = $toggle.parent().parent();
                if ($parent.find('ul.products').hasClass('grid')) {
                    $.cookie('gridcookie', 'grid', { path: '/' });
                } else if ($parent.find('ul.products').hasClass('list')) {
                    $.cookie('gridcookie', 'list', { path: '/' });
                } else {
                    $parent.find('ul.products').addClass($.cookie('gridcookie'));
                }
            }
        }

        if ($.cookie && $.cookie('gridcookie') == 'grid') {
            $('.gridlist-toggle #grid').addClass('active');
            $('.gridlist-toggle #list').removeClass('active');
        }

        if ($.cookie && $.cookie('gridcookie') == 'list') {
            $('.gridlist-toggle #list').addClass('active');
            $('.gridlist-toggle #grid').removeClass('active');
        }

        if ($.cookie && $.cookie('gridcookie') == null) {
            var $toggle = $('.gridlist-toggle');
            if ($toggle.get(0)) {
                var $parent = $toggle.parent().parent();
                $parent.find('ul.products').addClass('grid');
            }
            $('.gridlist-toggle #grid').addClass('active');
            if ($.cookie)
                $.cookie('gridcookie', 'grid', { path: '/' });
        }

    }).apply(this, [jQuery]);
}

(function(theme, $) {

    'use strict';

    $(document).ready(function() {
        // Init Porto Theme
        porto_init();

        // Scroll to Top
        if (typeof theme.ScrollToTop !== 'undefined') {
            theme.ScrollToTop.initialize();
        }

        // Mega Menu
        if (typeof theme.MegaMenu !== 'undefined') {
            theme.MegaMenu.initialize();
        }

        // Sidebar Menu
        if (typeof theme.SidebarMenu !== 'undefined') {
            theme.SidebarMenu.initialize();
        }

        // Side Navigation
        if (typeof theme.SideNav !== 'undefined') {
            theme.SideNav.initialize();
        }

        // Sticky Header
        if (typeof theme.StickyHeader !== 'undefined') {
            theme.StickyHeader.initialize();
        }

        // Search
        if (typeof theme.Search !== 'undefined') {
            theme.Search.initialize();
        }

        // Hash Scroll
        if (typeof theme.HashScroll !== 'undefined') {
            theme.HashScroll.initialize();
        }

        // Posts Infinite
        if (typeof theme.PostsInfinite !== 'undefined') {
            theme.PostsInfinite.initialize();
        }

        // Portfolio Ajax on Page
        if (typeof theme.PortfolioAjaxPage !== 'undefined') {
            theme.PortfolioAjaxPage.initialize();
        }

        // Portfolio Ajax on Modal
        if (typeof theme.PortfolioAjaxModal !== 'undefined') {
            theme.PortfolioAjaxModal.initialize();
        }

        // Portfolios Infinite
        if (typeof theme.PortfoliosInfinite !== 'undefined') {
            theme.PortfoliosInfinite.initialize();
        }

        // Portfolio Filter
        if (typeof theme.PortfolioFilter !== 'undefined') {
            theme.PortfolioFilter.initialize();
        }

        // Member Ajax on Page
        if (typeof theme.MemberAjaxPage !== 'undefined') {
            theme.MemberAjaxPage.initialize();
        }

        // Members Infinite
        if (typeof theme.MembersInfinite !== 'undefined') {
            theme.MembersInfinite.initialize();
        }

        // Member Filter
        if (typeof theme.MemberFilter !== 'undefined') {
            theme.MemberFilter.initialize();
        }

        // FAQs Infinite
        if (typeof theme.FaqsInfinite !== 'undefined') {
            theme.FaqsInfinite.initialize();
        }

        // FAQ Filter
        if (typeof theme.FaqFilter !== 'undefined') {
            theme.FaqFilter.initialize();
        }

        // Filter Zooms
        if (typeof theme.FilterZoom !== 'undefined') {
            // Portfolio Filter Zoom
            theme.FilterZoom.initialize($('.page-portfolios'));
            // Member Filter Zoom
            theme.FilterZoom.initialize($('.page-members'));
            // Posts Related Style Filter Zoom
            theme.FilterZoom.initialize($('.blog-posts-related'));
        }

        // Sort Filter
        if (typeof theme.SortFilter !== 'undefined') {
            theme.SortFilter.initialize();
        }

        // Woocommerce Qty Field
        if (typeof theme.WooQtyField !== 'undefined') {
            theme.WooQtyField.initialize();
        }

        // Woocommerce Quick View
        if (typeof theme.WooQuickView !== 'undefined') {
            theme.WooQuickView.initialize();
        }

        // Woocommerce Events
        if (typeof theme.WooEvents !== 'undefined') {
            theme.WooEvents.initialize();
        }

        // Mobile Sidebar
        // filter popup events
        $('.sidebar-toggle').click(function(e) {
            var $html = $('html');
            if ($html.hasClass('sidebar-opened')) {
                $html.removeClass('sidebar-opened');
                $('.sidebar-overlay').removeClass('active');
            } else {
                $html.addClass('sidebar-opened');
                $('.sidebar-overlay').addClass('active');
            }
        });

        $('.sidebar-overlay').click(function() {
            $('html').removeClass('sidebar-opened');
            $(this).removeClass('active');
        });

        $(window).on('resize', function() {
            if ($(window).width() > 991 - theme.getScrollbarWidth()) {
                $('.sidebar-overlay').click();
            }
        });

        // Common
        // disable drop down
        if (!('ontouchstart' in document)) {
            $('.mini-cart').on('hide.bs.dropdown', function () {
                return false;
            });
        }

        // Match Height
        if ($.isFunction($.fn['matchHeight'])) {
            $('.tabs-simple .featured-box .box-content').matchHeight();
            $('.porto-content-box .featured-box .box-content').matchHeight();
            $('.vc_general.vc_cta3').matchHeight();
            $('.match-height').matchHeight();
            $('.fdm-section .fdm-item').matchHeight();
        }

        // WhatsApp Sharing
        if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
            $('.share-whatsapp').css('display', 'inline-block');
        }
        $(document).ajaxComplete(function(event, xhr, options) {
            if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
                $('.share-whatsapp').css('display', 'inline-block');
            }
        });

        // Add Ege Browser Class
        var ua = window.navigator.userAgent,
            ie12 = ua.indexOf('Edge/') > 0;
        if (ie12) $('html').addClass('ie12');

        // Add wishlist popup
        if ( !$( '#yith-wcwl-popup-message' ).get(0) ) {
            var message_div = $( '<div>' )
                    .attr( 'id', 'yith-wcwl-message' ),
                popup_div = $( '<div>' )
                    .attr( 'id', 'yith-wcwl-popup-message' )
                    .html( message_div )
                    .hide();

            $( 'body' ).prepend( popup_div );
        }

        // Portfolios Shortcode Pagination
        $(document).on('click', '.porto-portfolios .pagination a', function(e) {
            var $this = $(this),
                url = $this.attr('href'),
                shortcode_id = $this.closest('.porto-portfolios').find('.shortcode-id').val(),
                $container = $this.closest('.porto-portfolios' + shortcode_id);

            if (url) {
                e.preventDefault();
                $container.addClass('porto-ajax-loading');

                setTimeout(function() {
                    $('html, body').stop().animate({
                        scrollTop: $container.offset().top - theme.StickyHeader.sticky_height - theme.adminBarHeight() - theme.sticky_nav_height - 14
                    }, 600, 'easeOutQuad');
                }, 200);

                $.ajax({
                    type : 'post',
                    url : url,
                    success: function(response) {
                        var $response_container = $('<div>' + response + '</div>').find('.porto-portfolios'+shortcode_id);
                        $container.html($response_container.html());
                        theme.PortfolioAjaxPage.initialize($container.find('.page-portfolios'));
                        theme.PortfolioAjaxModal.initialize($container.find('.page-portfolios'));
                        porto_init();
                        theme.PortfolioFilter.initialize($container.find('.portfolio-filter'));
                    }
                }).always(function() {
                        $container.removeClass('porto-ajax-loading');
                    });

                return false;
            }
        });

        // Members Shortcode Pagination
        $(document).on('click', '.porto-members .pagination a', function(e) {
            var $this = $(this),
                url = $this.attr('href'),
                shortcode_id = $this.closest('.porto-members').find('.shortcode-id').val(),
                $container = $this.closest('.porto-members' + shortcode_id);

            if (url) {
                e.preventDefault();
                $container.addClass('porto-ajax-loading');

                setTimeout(function() {
                    $('html, body').stop().animate({
                        scrollTop: $container.offset().top - theme.StickyHeader.sticky_height - theme.adminBarHeight() - theme.sticky_nav_height - 14
                    }, 600, 'easeOutQuad');
                }, 200);

                $.ajax({
                    type : 'post',
                    url : url,
                    success: function(response) {
                        var $response_container = $('<div>' + response + '</div>').find('.porto-members'+shortcode_id);
                        $container.html($response_container.html());
                        theme.MemberAjaxPage.initialize($container.find('.page-members'));
                        porto_init();
                        theme.MemberFilter.initialize($container.find('.member-filter'));
                    }
                }).always(function() {
                        $container.removeClass('porto-ajax-loading');
                    });

                return false;
            }
        });

        // FAQs Shortcode Pagination
        $(document).on('click', '.porto-faqs .pagination a', function(e) {
            var $this = $(this),
                url = $this.attr('href'),
                shortcode_id = $this.closest('.porto-faqs').find('.shortcode-id').val(),
                $container = $this.closest('.porto-faqs' + shortcode_id);

            if (url) {
                e.preventDefault();
                $container.addClass('porto-ajax-loading');

                setTimeout(function() {
                    $('html, body').stop().animate({
                        scrollTop: $container.offset().top - theme.StickyHeader.sticky_height - theme.adminBarHeight() - theme.sticky_nav_height - 14
                    }, 600, 'easeOutQuad');
                }, 200);

                $.ajax({
                    type : 'post',
                    url : url,
                    success: function(response) {
                        var $response_container = $('<div>' + response + '</div>').find('.porto-faqs'+shortcode_id);
                        $container.html($response_container.html());
                        porto_init();
                        theme.FaqFilter.initialize($container.find('.faq-filter'));
                    }
                }).always(function() {
                        $container.removeClass('porto-ajax-loading');
                    });

                return false;
            }
        });

        // refresh wpb content
        $(document).on('shown.bs.collapse', '.collapse', function() {
            var panel = $(this);
            theme.refreshVCContent(panel);
        });
        $(document).on('shown.bs.tab', 'a[data-toggle="tab"]', function(e) {
            var panel = $($(e.target).attr('href'));
            theme.refreshVCContent(panel);
        });
        $(document).on('tabactivate', '.woocommerce-tabs', function(e, ui) {
            var label = $(ui).attr('aria-controls');
            var panel = $('[aria-labelledby="' + label + '"');
            theme.refreshVCContent(panel);
        });

        // porto tooltip for header, footer
        $(".porto-tooltip .tooltip-icon").click(function(){
            if($(this).parent().children(".tooltip-popup").css("display")=="none"){
                $(this).parent().children(".tooltip-popup").fadeIn(200);
            }else{
                $(this).parent().children(".tooltip-popup").fadeOut(200);
            }
        });
        $(".porto-tooltip .tooltip-close").click(function(){
            $(this).parent().fadeOut(200);
        });
    });

}).apply(this, [window.theme, jQuery]);

(function (theme, $, undefined) {
    "use strict";

    // Woocommerce Variation Form
    if (typeof theme.WooVariationForm !== 'undefined') {
        theme.WooVariationForm.initialize();
    }

    // Woocommerce Product Image Slider
    if (typeof theme.WooProductImageSlider !== 'undefined') {
        theme.WooProductImageSlider.initialize();
    }

    $(document).ready(function(){
        $(window).bind('vc_reload', function() {
            porto_init();
            $('.type-product').addClass('product');
            $('.type-post').addClass('post');
            $('.type-portfolio').addClass('portfolio');
            $('.type-member').addClass('member');
            $('.type-block').addClass('block');
        });
    });

    if (theme.rtl) {
        $(document).bind('vc-full-width-row', function() {
            $('[data-vc-full-width="true"]').each(function() {
                var $this = $(this),
                    left = $this.css('left');

                $this.css('right', left);
                $this.css('left', 'auto');
            });
        });
    }

})( window.theme, jQuery );


