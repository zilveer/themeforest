;(function ($, window, document, undefined) {

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
      // for IE
      //if( ie ) {
      //preventDefault(e);
      //}
    },
    disable_scroll: function () {
      window.onmousewheel = document.onmousewheel = this.wheel;
    },
    enable_scroll: function () {
      window.onmousewheel = document.onmousewheel = document.onkeydown = document.body.ontouchmove = null;
    },
    scrollY: function () {
      return window.pageYOffset || this.docElem.scrollTop;
    },
    scrollPage: function () {
      this.scrollVal = this.scrollY();

      if (this.noscroll && !this.ie) {
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

})(jQuery, window, document);