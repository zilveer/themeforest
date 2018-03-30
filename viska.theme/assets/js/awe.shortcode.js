;(function($, document, window)
{
	"use strict";

	$(document).ready(function()
	{
		/*
        *--------------------------------
            if has been tab shortcode 
        *--------------------------------
        */
        if ($(".awe_tabs").length > 0)
        {
            $(".awe_tabs").tabs();
        }

        if ($(".awe_accordion").length > 0)
        {
            $(".awe_accordion").accordion();
        }

	})

})(jQuery, document, window)