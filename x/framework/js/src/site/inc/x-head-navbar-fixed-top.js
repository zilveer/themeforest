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