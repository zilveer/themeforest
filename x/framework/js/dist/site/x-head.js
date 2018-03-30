// =============================================================================
// JS/X-HEAD.JS
// -----------------------------------------------------------------------------
// Site specific functionality needed in <head> element.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Imports
// =============================================================================

// Imports
// =============================================================================
// =============================================================================
// JS/SRC/SITE/INC/X-HEAD-CUSTOM.JS
// -----------------------------------------------------------------------------
// Includes all miscellaneous, custom functionality to be output in the <head>.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Custom Functionality
// =============================================================================

// Custom Functionality
// =============================================================================

jQuery(document).ready(function($) {

  //
  // scrollBottom function.
  //

  $.fn.scrollBottom = function() {
    return $(document).height() - this.scrollTop() - this.height();
  };


  //
  // Prevent default behavior on various toggles.
  //

  $('.x-btn-navbar, .x-btn-navbar-search, .x-btn-widgetbar').click(function(e) {
    e.preventDefault();
  });


  //
  // YouTube z-index fix.
  //

  $('iframe[src*="youtube.com"]').each(function() {
    var url = $(this).attr('src');
    if ($(this).attr('src').indexOf('?') > 0) {
      $(this).attr({
        'src'   : url + '&wmode=transparent',
        'wmode' : 'Opaque'
      });
    } else {
      $(this).attr({
        'src'   : url + '?wmode=transparent',
        'wmode' : 'Opaque'
      });
    }
  });


  //
  // Resize isotope container if gallery navigation is clicked or if an arrow
  // key is pressed to ensure that elements are spaced out properly.
  //

  $('body').on('click', '.x-iso-container .flex-direction-nav a', function() {
    setTimeout(function() { $window.smartresize(); }, 750);
  });

  $('body.x-masonry-active').on('keyup', function(e) {
    if (e.which >= 37 && e.which <= 40) {
      setTimeout(function() { $window.smartresize(); }, 750);
    }
  });

});
// =============================================================================
// JS/SRC/SITE/INC/X-HEAD-DROPDOWNS.JS
// -----------------------------------------------------------------------------
// Includes all functionality pertaining to dropdown menus for both "desktop"
// and "mobile" navigation.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Dropdowns
// =============================================================================

// Dropdowns
// =============================================================================

jQuery(function($) {

  //
  // Desktop dropdown functionality.
  //

  var $desktopMenu   = $('.desktop .x-nav');
  var desktopTargets = 'li.menu-item-has-children';
  var mActiveClass   = 'x-active';
  var mActionData    = 'x-action';
  var timer          = {};

  function showDropdowns(element) {
    element.addClass(mActiveClass).siblings(desktopTargets).removeClass(mActiveClass);
    if ( Modernizr && Modernizr.touchevents ) {
      element.siblings(desktopTargets).data(mActionData, 0);
      element.find('.' + mActiveClass).removeClass(mActiveClass).data(mActionData, 0);
    }
  }

  function hideDropdowns(element) {
    element.find('.' + mActiveClass).removeClass(mActiveClass);
  }

  function hoverIn(e) {
    clearTimeout(timer.id);
    var $li = $(e.target).closest('li');
    if ( $li.hasClass('menu-item-has-children') ) {
      showDropdowns($li);
    }
  }

  function hoverOut(e) {
    clearTimeout(timer.id);
    var inMenu = $.contains(document.getElementsByClassName('x-nav-wrap desktop')[0], e.toElement);
    var ms     = ( inMenu ) ? 500 : 1000;
    var $ul    = $(this).closest('ul');
    timer.id = setTimeout(function() { hideDropdowns($ul); }, ms);
  }

  function touchIn(e) {
    var $li = $(e.target).closest('li');
    $li.data(mActionData, $li.data(mActionData) + 1);
    if ( $li.hasClass('menu-item-has-children') && $li.data(mActionData) === 1 ) {
      e.preventDefault();
      e.stopPropagation();
      showDropdowns($li);
    }
  }

  function touchOut(e) {
    $(desktopTargets).data(mActionData, 0);
    hideDropdowns($desktopMenu);
  }

  if ( Modernizr && Modernizr.touchevents ) {
    $(desktopTargets).data(mActionData, 0);
    $desktopMenu.on('touchstart click', desktopTargets, touchIn);
    $desktopMenu.on('touchstart click', function(e) { e.stopPropagation(); });
    $('body').on('touchstart click', touchOut);
  } else {
    $desktopMenu.hoverIntent({
      over     : hoverIn,
      out      : hoverOut,
      selector : desktopTargets
    });
    $desktopMenu.on('focusin', desktopTargets, hoverIn);
    $desktopMenu.on('focusout', desktopTargets, hoverOut);
  }


  //
  // Mobile dropdown functionality.
  //

  var $mobileMenu    = $('.mobile .x-nav');
  var $mobileTargets = $mobileMenu.find('li.menu-item-has-children > a');
  var $mobileSubs    = $mobileMenu.find('.sub-menu');

  $mobileTargets.each(function(i) {
    $(this).append('<div class="x-sub-toggle" data-toggle="collapse" data-target=".sub-menu.sm-' + i + '"><span><i class="x-icon-angle-double-down" data-x-icon="&#xf103;"></i></span></div>');
  });

  $mobileSubs.each(function(i) {
    $(this).addClass('sm-' + i + ' collapse');
  });

  $('.x-sub-toggle').on('click', function(e) {
    e.preventDefault();
    $(this).toggleClass(mActiveClass).closest('li').toggleClass(mActiveClass);
  });

});
// =============================================================================
// JS/SRC/SITE/INC/X-HEAD-NAVBAR-FIXED-TOP.JS
// -----------------------------------------------------------------------------
// Includes all functionality pertaining to fixed top navigation when in use.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Fixed Top Navbar
// =============================================================================

// Fixed Top Navbar
// =============================================================================

jQuery(function($) {

  var $body   = $('body');
  var $navbar = $('.x-navbar');

  if ( $body.hasClass('x-navbar-fixed-top-active') && $navbar.length > 0 ) {

    var boxedClasses = '';

    if ( $body.hasClass('x-boxed-layout-active') ) {
      boxedClasses = ' x-container max width';
    }

    $(window).scroll(function() {

      if ( $(this).scrollTop() >= navbarOffset() ) {
        $navbar.addClass('x-navbar-fixed-top' + boxedClasses);
      } else {
        $navbar.removeClass('x-navbar-fixed-top' + boxedClasses);
      }

    });

  }

  function navbarOffset() {
    return $('.x-navbar-wrap').offset().top - $('#wpadminbar').outerHeight();
  }

});
// =============================================================================
// JS/SRC/SITE/INC/X-HEAD-NAVBAR-SEARCH.JS
// -----------------------------------------------------------------------------
// Includes all functionality pertaining to the navbar search item.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Navbar Search
// =============================================================================

// Navbar Search
// =============================================================================

jQuery(function($) {

  var $trigger  = $('.x-btn-navbar-search');
  var $formWrap = $('.x-searchform-overlay');
  var $input    = $formWrap.find('.search-query');
  var escKey    = 27;

  function clearSearch() {
    $formWrap.toggleClass('in');
    setTimeout(function() { $input.val(''); }, 350);
  }

  $trigger.on('touchstart click', function(e) {
    e.preventDefault();
    $formWrap.toggleClass('in');
    $input.focus();
  });

  $formWrap.on('touchstart click', function(e) {
    if ( ! $(e.target).hasClass('search-query') ) {
      clearSearch();
    }
  });

  $(document).keydown(function(e) {
    if ( e.which === escKey ) {
      if ( $formWrap.hasClass('in') ) {
        clearSearch();
      }
    }
  });

});
