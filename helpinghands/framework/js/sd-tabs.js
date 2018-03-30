/*jslint browser: true*/
/*global $, jQuery*/
jQuery(document).ready(function ($) {

    "use strict";

/* ------------------------------------------------------------------------ */
/* Tabs                                                                     */
/* ------------------------------------------------------------------------ */

    $(function () {
        $(".sd-tabs").tabs({
            active: false,
            collapsible: true,
            hide: {
                effect: "fade",
                duration: 300
            },
            show: {
                effect: "fade",
                duration: 300
            }
        }).css('visibility', 'visible').removeClass('no-js');
		
	    $('.sd-tabs').tabs("option", "active", 0).tabs("option", "collapsible", false).fadeIn('fast')
	});
});
/* ------------------------------------------------------------------------ */
/* EOF                                                                      */
/* ------------------------------------------------------------------------ */