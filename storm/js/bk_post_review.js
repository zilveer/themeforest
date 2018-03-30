(function($){"use strict";

  /**
   * Copyright 2012, Digital Fusion
   * Licensed under the MIT license.
   * http://teamdf.com/jquery-plugins/license/
   *
   * @author Sam Sehnert
   * @desc A small plugin that checks whether elements are within
   *     the user visible viewport of a web browser.
   *     only accounts for vertical position, not horizontal.
   */

  $.fn.visible = function(partial) { 
    
      var $t            = $(this),
          $w            = $(window),
          viewTop       = $w.scrollTop(),
          viewBottom    = viewTop + $w.height(),
          _top          = $t.offset().top,
          _bottom       = _top + $t.height(),
          compareTop    = partial === true ? _bottom : _top,
          compareBottom = partial === true ? _top : _bottom;
    
    return ((compareBottom <= viewBottom) && (compareTop >= viewTop));

  };
    
})(jQuery);

jQuery(document).ready(function($) {
    
    var bkWindow = $(window),
    bkRatingBars = $('.bk-overlay').find('.bk-zero-trigger');
    
    jQuery.each(bkRatingBars, function(i, value) {
        
        var bkValue = $(value);
        if ( bkValue.visible(true) ) {
            
            bkValue.removeClass('bk-zero-trigger'); 
            bkValue.addClass('bk-bar-ani'); 
       
        } 
    });
            
    bkWindow.scroll(function(event) {
      
        jQuery.each(bkRatingBars, function(i, value) {
              
            var bkValue = $(value);
            if ( ( bkValue.visible(true) ) && ( bkValue.hasClass('bk-zero-trigger') ) ) {

              bkValue.removeClass('bk-zero-trigger'); 
              bkValue.addClass('bk-bar-ani'); 
            } 
        });
                
    });
});