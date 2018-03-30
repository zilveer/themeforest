// =============================================================================
// JS/SRC/SITE/INC/X-BODY-SCROLLSPY.JS
// -----------------------------------------------------------------------------
// A modified version of the Bootstrap ScrollSpy plugin. More information can
// be found here: http://getbootstrap.com/javascript/#scrollspy
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. ScrollSpy Plugin
//   02. Setup ScrollSpy Functionality
// =============================================================================

// ScrollSpy Plugin
// =============================================================================

+function ($) { "use strict";

  // SCROLLSPY CLASS DEFINITION
  // ==========================

  function ScrollSpy(element, options) {
    var href
    var process  = $.proxy(this.process, this)

    this.$element       = $(element).is('body') ? $(window) : $(element)
    this.$body          = $('body')
    this.$scrollElement = this.$element.on('scroll.bs.scroll-spy.data-api', process)
    this.options        = $.extend({}, ScrollSpy.DEFAULTS, options)
    this.selector       = (this.options.target
      || ((href = $(element).attr('href')) && href.replace(/.*(?=#[^\s]+$)/, '')) //strip for ie7
      || '') + ' .x-nav li > a'
    this.offsets        = $([])
    this.targets        = $([])
    this.activeTarget   = null

    this.refresh()
    this.process()
  }

  ScrollSpy.DEFAULTS = {
    offset: 10
  }

  ScrollSpy.prototype.refresh = function () {
    var offsetMethod = this.$element[0] == window ? 'offset' : 'position'

    this.offsets = $([])
    this.targets = $([])

    var self     = this
    var $targets = this.$body
      .find(this.selector)
      .map(function () {
        var $el   = $(this)
        var href  = $el.data('target') || $el.attr('href')
        var $href = /^#\w/.test(href) && $(href)

        return ($href
          && $href.length
          && [[ $href[offsetMethod]().top + (!$.isWindow(self.$scrollElement.get(0)) && self.$scrollElement.scrollTop()), href ]]) || null
      })
      .sort(function (a, b) { return a[0] - b[0] })
      .each(function () {
        self.offsets.push(this[0])
        self.targets.push(this[1])
      })
  }

  ScrollSpy.prototype.process = function () {
    var scrollTop    = this.$scrollElement.scrollTop() + this.options.offset
    var scrollHeight = this.$scrollElement[0].scrollHeight || this.$body[0].scrollHeight
    var maxScroll    = scrollHeight - this.$scrollElement.height()
    var offsets      = this.offsets
    var targets      = this.targets
    var activeTarget = this.activeTarget
    var i

    if (scrollTop >= maxScroll) {
      return activeTarget != (i = targets.last()[0]) && this.activate(i)
    }

    for (i = offsets.length; i--;) {
      activeTarget != targets[i]
        && scrollTop >= offsets[i]
        && (!offsets[i + 1] || scrollTop <= offsets[i + 1])
        && this.activate( targets[i] )
    }
  }

  ScrollSpy.prototype.activate = function (target) {
    this.activeTarget = target

    $(this.selector)
      .parents('.current-menu-item')
      .removeClass('current-menu-item')

    var selector = this.selector
      + '[data-target="' + target + '"],'
      + this.selector + '[href="' + target + '"]'

    var active = $(selector)
      .parents('li')
      .addClass('current-menu-item')

    if (active.parent('.dropdown-menu').length)  {
      active = active
        .closest('li.dropdown')
        .addClass('current-menu-item')
    }

    active.trigger('activate.bs.scrollspy')
  }


  // SCROLLSPY PLUGIN DEFINITION
  // ===========================

  var old = $.fn.scrollspy

  $.fn.scrollspy = function (option) {
    return this.each(function () {
      var $this   = $(this)
      var data    = $this.data('bs.scrollspy')
      var options = typeof option == 'object' && option

      if (!data) $this.data('bs.scrollspy', (data = new ScrollSpy(this, options)))
      if (typeof option == 'string') data[option]()
    })
  }

  $.fn.scrollspy.Constructor = ScrollSpy


  // SCROLLSPY NO CONFLICT
  // =====================

  $.fn.scrollspy.noConflict = function () {
    $.fn.scrollspy = old
    return this
  }


  // SCROLLSPY DATA-API
  // ==================

  $(window).on('load', function () {
    $('[data-spy="scroll"]').each(function () {
      var $spy = $(this)
      $spy.scrollspy($spy.data())
    })
  })

}(jQuery);



// Setup ScrollSpy Functionality
// =============================================================================

jQuery(document).ready(function($) {

  var $body                = $('body');
  var bodyHeight           = $body.outerHeight();
  var adminbarHeight       = $('#wpadminbar').outerHeight();
  var navbarFixedTopHeight = $('.x-navbar-fixed-top-active .x-navbar').outerHeight();
  var locHref              = location.href;
  var locHashIndex         = locHref.indexOf('#');
  var locHash              = locHref.substr(locHashIndex);
  var dragging             = false;
  
  $body.on('touchmove', function() {
	  dragging = true;
  } );
  
  $body.on('touchstart', function() {
	  dragging = false;
  } );


  //
  // Calculate the offset height for various elements and remove it from
  // the element's top offset so that fixed elements don't cover it up.
  //

  function animateOffset( element, ms, easing ) {
    $('html, body').animate({
      scrollTop: $(element).offset().top - adminbarHeight - navbarFixedTopHeight + 1
    }, ms, easing);
  }


  //
  // Page load offset (if necessary).
  //

  $(window).load(function() {
    if ( locHashIndex !== -1 && $(locHash).length ) {
      animateOffset(locHash, 1, 'linear');
    }
  });


  //
  // Scroll trigger.
  //

  $('a[href*="#"]').on('touchend click', function(e) {
    href        = $(this).attr('href');
    notComments = href.indexOf('#comments') === -1;
    if ( href !== '#' && notComments ) {
      var theId = href.split('#').pop();
      var $el   = $('#' + theId);
      if ( $el.length > 0 ) {
        e.preventDefault();
        
        if (dragging) {
	        return;
        }
        
        animateOffset($el, 850, 'easeInOutExpo');
      }
    }
  });


  //
  // Initialize scrollspy.
  //

  if ( $body.hasClass('x-one-page-navigation-active') ) {

    $body.scrollspy({
      target : '.x-nav-wrap.desktop',
      offset : adminbarHeight + navbarFixedTopHeight
    });


    //
    // Refresh scrollspy as needed.
    //

    $(window).resize(function() {
      $body.scrollspy('refresh');
    });

    var timesRun = 0;
    var interval = setInterval(function() {
      timesRun += 1;
      var newBodyHeight = $body.outerHeight();
      if ( newBodyHeight !== bodyHeight ) {
        $body.scrollspy('refresh');
      }
      if ( timesRun === 10 ) {
        clearInterval(interval);
      }
    }, 500);

  }

});