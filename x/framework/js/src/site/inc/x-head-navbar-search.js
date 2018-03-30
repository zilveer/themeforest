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