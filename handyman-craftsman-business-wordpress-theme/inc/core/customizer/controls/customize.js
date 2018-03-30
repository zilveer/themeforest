jQuery(function ($) {
    "use strict";

   var api = wp.customize;

    api.bind('ready', function() {

        /**
         *  After an user picks a color scheme, set all color pickers to appropriate values
         */
        $(".color-scheme").on("click", function(e){
            e.preventDefault();
            var id = $(this).data('cs');

            $.each(CS[id], function($k, $v){
                var control = api.control.instance($k);
                var picker = control.container.find('#' + $k);
                control.setting.set($v);
                control.container.find("a").css("background-color", $v);
                picker.val( control.setting() );
            });
            return;
        });

        /**
         * Fix for the "layers-select-images" control
         */

        var $imgs = $(".customize-control-layers-select-images img[data-src]");
        $imgs.each(function(){
            $(this).attr("src", $(this).data("src"));
        });
    });
}(jQuery));