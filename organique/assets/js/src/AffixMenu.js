/**
 * Affix menu, using the Bootstrap Affix JS plugin and scrollSpy
 */
define(['jquery', 'underscore', 'bootstrapAffix', 'bootstrapScrollspy'], function ($, _) {
  /**
   * Init of the class, setting up the options
   */
  var AffixMenu = function(options) {
    this.defaults = $.extend({}, AffixMenu.DEFAULTS, options);
  };

  /**
   * Default options for the AffixMenu, can be overridden
   */
  AffixMenu.DEFAULTS = {
    menuElm:         '',
    footerElm:       '',
    eventsNamespace: 'AffixMenu',
    topOffset:       50
  };


  AffixMenu.prototype.init = function() {
    if ( this.defaults.menuElm.length < 1 ) {
      return;
    }

    this.defaults.menuElm   = $(this.defaults.menuElm);
    this.defaults.footerElm = $(this.defaults.footerElm);
    this
      .setWidth(this.defaults.menuElm.width())
      .setAffix()
      .smoothScrolling();


    $(window)
      .on('resize.'+this.defaults.eventsNamespace, $.proxy(this.recaulculateWidthOnResize, this));

    $(window)
      .on('scroll.'+this.defaults.eventsNamespace, $.proxy(this.checkIfShownOrHidden, this));

    $( 'body' ).scrollspy({
      target: this.defaults.menuElm.selector
    });

    return this;
  };

  AffixMenu.prototype.destroy = function () {
    setTimeout( $.proxy( function () {
      this.unsetAffix();
      $(window)
        .off('resize.'+this.defaults.eventsNamespace)
        .off('scroll.'+this.defaults.eventsNamespace);
      this.defaults.menuElm
        .off('click.'+this.defaults.eventsNamespace, 'a');

      this.defaults.menuElm.width('auto');
    }, this), 201);
    return this;
  };

  /**
   * Set the with with inline CSS to the menu element.
   * Needed for the fixed position.
   * @param integer width
   */
  AffixMenu.prototype.setWidth = function (width) {
    this.defaults.menuElm.width(width);
    return this;
  };

  AffixMenu.prototype.setAffix = function () {
    this.defaults.menuElm.affix({
      offset: {
        top: this.defaults.menuElm.offset().top - this.defaults.topOffset
      }
    });
    return this;
  };

  AffixMenu.prototype.unsetAffix = function () {
    $(window).off('.affix');
    this.defaults.menuElm
      .removeData('bs.affix')
      .removeClass('affix affix-top affix-bottom fade in out');
    return this;
  };

  // smooth scrolling
  AffixMenu.prototype.smoothScrolling = function () {
    this.defaults.menuElm.on('click.'+this.defaults.eventsNamespace, 'a', function(ev) {
      ev.preventDefault();
      var $this = $(this);
      $("html, body").animate({
        scrollTop: $($this.attr("href")).offset().top
      }, 500);
    });
  };

  /**
   * When the window is resized the behaviour changes
   */
  AffixMenu.prototype.recaulculateWidthOnResize = _.debounce(function () {
    if (
      this.defaults.menuElm.hasClass('affix') ||
      this.defaults.menuElm.hasClass('affix-top') ||
      this.defaults.menuElm.hasClass('affix-bottom')
    ) {
      var classes = this.defaults.menuElm.attr('class');
        currentWidth = this.defaults.menuElm
          .removeClass('affix affix-top affix-bottom')
          .width('auto')
          .width();

      this.defaults.menuElm
        .width(currentWidth)
        .addClass(classes);

      this.resetTopOffset();
    }
  }, 200);


  AffixMenu.prototype.getBottomOfMenuFromTop = function () {
    return $(window).scrollTop() + this.defaults.topOffset + this.defaults.menuElm.outerHeight(true);
  };


  AffixMenu.prototype.getTopOfFooterFromTop = function () {
    return $(document).height() - this.defaults.footerElm.outerHeight(true);
  };


  AffixMenu.prototype.showAffixMenu = function () {
    this.defaults.menuElm
      .removeClass('fade out')
      .addClass('fade in');
  };


  AffixMenu.prototype.hideAffixMenu = function () {
    this.defaults.menuElm
      .removeClass('fade in')
      .addClass('fade out');
  };

  /**
   * Watching if the menu is overlapping the footer element and should hide or show it properly
   */
  AffixMenu.prototype.checkIfShownOrHidden = _.throttle(function () {
    if ( this.getBottomOfMenuFromTop() > this.getTopOfFooterFromTop() ) {
      this.hideAffixMenu();
    } else {
      this.showAffixMenu();
    }
  }, 100);


  AffixMenu.prototype.resetTopOffset = function () {
    this.unsetAffix();
    this.setAffix();
    return this;
  };



  return AffixMenu;
});