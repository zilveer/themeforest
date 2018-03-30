(function($) {
    'use strict';

    var core = MK.core,
        path = core.path;

    MK.component.Tooltip = function(el) {
        var init = function() {
             $('.mk-tooltip').each(function() {
                $(this).find('.mk-tooltip--link').hover(function() {
                  $(this).siblings('.mk-tooltip--text').stop(true).animate({
                    'opacity': 1
                  }, 400);

                }, function() {
                  $(this).siblings('.mk-tooltip--text').stop(true).animate({
                    'opacity': 0
                  }, 400);
                });
              });
        };

        return {
            init: init
        };
    };

})(jQuery);
