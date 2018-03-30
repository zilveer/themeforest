// =============================================================================
// JS/ADMIN/X-WIDGETS.JS
// -----------------------------------------------------------------------------
// Widget functionality.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Widget Functionality
// =============================================================================

// Widget Functionality
// =============================================================================

jQuery(document).ready(function($) {

  var classes   = $('body').attr('class').match(/x-(?:header|footer)-widgets-[0-4]/g);
  var headerNum = getNum(classes[0]);
  var footerNum = getNum(classes[1]);

  function getNum( input ) {
    return parseInt(input.split('-').pop());
  }

  function addWidgetsHolderWrapClass( loc ) {

    $('#widgets-right [id^="' + loc + '-"]').each(function() {

      var $this   = $(this);
      var thisNum = getNum($this.attr('id'));
      var thatNum = loc === 'header' ? headerNum : footerNum;

      if ( thisNum > thatNum ) {
        $this.closest('.widgets-holder-wrap').addClass('inactive');
      }

    });

  }

  $('#widgets-right .sidebar-name').click(function() {

    parentWrap = $(this).closest('.widgets-holder-wrap');

    if ( parentWrap.hasClass('inactive') ) {
      parentWrap.addClass('closed');
    }
    
  });

  addWidgetsHolderWrapClass('header');
  addWidgetsHolderWrapClass('footer');

});