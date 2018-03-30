/* *********************************************************************************************************************
 * Main func
 */

jQuery(document).ready(function($) {

    // Enable last child detection for IE
    if (jQuery.browser.msie && parseInt(jQuery.browser.version, 10) <= 8) {
        jQuery('*:last-child').addClass('last-child');
    }

});