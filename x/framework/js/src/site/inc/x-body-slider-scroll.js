// =============================================================================
// JS/SRC/SITE/INC/X-BODY-SLIDER-SCROLL.JS
// -----------------------------------------------------------------------------
// Includes all functionality pertaining to the scroll bottom anchor for the
// sliders.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Slider Scroll Bottom Anchor
// =============================================================================

// Slider Scroll Bottom Anchor
// =============================================================================

jQuery(function($) {

  //
  // Slider above.
  //

  $('.x-slider-container.above .x-slider-scroll-bottom').on('touchstart click', function(e) {

    e.preventDefault();

    $('html, body').animate({
      scrollTop: $('.x-slider-container.above').outerHeight()
    }, 850, 'easeInOutExpo');

  });


  //
  // Slider below.
  //

  $('.x-slider-container.below .x-slider-scroll-bottom').on('touchstart click', function(e) {

    e.preventDefault();

    var mastheadHeight       = $('.masthead').outerHeight();
    var navbarFixedTopHeight = $('.x-navbar-fixed-top-active .x-navbar').outerHeight();
    var sliderAboveHeight    = $('.x-slider-container.above').outerHeight();
    var sliderBelowHeight    = $('.x-slider-container.below').outerHeight();
    var heightSum            = mastheadHeight + sliderAboveHeight + sliderBelowHeight - navbarFixedTopHeight;

    $('html, body').animate({
      scrollTop: heightSum
    }, 850, 'easeInOutExpo');

  });

});