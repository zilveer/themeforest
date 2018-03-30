(function($) { "use strict";
jQuery(document).ready(function ($) {
    var pageloaded = function(){
        var $loader = $('#cs_loader'),
        $wrapper = $('#wrapper');
        $wrapper.removeClass('cs_hidden');
        $loader.css({
            position: 'relative'
        });
        setTimeout(function () {
            $loader.css({
                height: 0
            });

        }, 10);
    }
    $(window).bind('load', function () {
        pageloaded();
    });
    setTimeout(function(){
        pageloaded();
    },10000);
});
})(jQuery);
