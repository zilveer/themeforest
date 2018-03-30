<?php
/**
 */

/**
 * Gets the title for the current page/post, this is meant to be used inside
 * the HTML title tag, use this instead of WP's wp_title
 *
 * this function also works in conjunction with modules/bfi_seo.php
 *
 * @package API\WordPress Replacements
 * @param string $sep separator for the parts of the title
 * @param boolean $display if false, the title is returned, else it is echoed out. Default is false. Leave this as false
 * @param string $seplocation the location of the separator. Leave this as right
 * @return string the title of the current page
 */
function bfi_title($sep = '|', $display = false, $seplocation = 'right') {
    return wp_title($sep, $display, $seplocation);
}