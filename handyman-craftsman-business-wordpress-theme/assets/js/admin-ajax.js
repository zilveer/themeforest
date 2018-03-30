var TL_AdminLib;
(function($) {
    "use strict";
    /**
     * Admin ajax library
     */
     TL_AdminLib = {

        /**
         * Create Ajax request to WP
         *
         * @param data A plain object or string that is sent to the server with the request.
         * @param data_type The type of data expected from the server.
         *                  Default: Intelligent Guess (xml, json, script, text, html)
         * @param on_success_hadler A callback function that is executed if the request succeeds.
         *                          Required if dataType is provided, but can be null in that case
         */
        do_admin_ajax: function(data, data_type, on_success_hadler){

            var data_defaults = {
                action: TL_ADMIN.ajax_default_action,
                _ajax_nonce : TL_ADMIN.ajax_nonce
            };
            data = jQuery.extend({}, data_defaults, data);

            if(!data_type) data_type = "json";
            if(!on_success_hadler) on_success_hadler = null;

            var $r = null;

            jQuery.post(
                TL_ADMIN.ajax_url,
                data,
                on_success_hadler,
                data_type
            );
            return $r;
        }
    };
})(jQuery);