<?php
/**
 */

/**
 * Gets the contents for the loop and cleans it up. The functions strips out blank p tags, repeting br tags, double clearfix tags, etc.
 *
 * This function should be used instead of WP's get_contents()
 *
 * @package API\WordPress Replacements
 * @return The contents of the page
 */
function bfi_get_contents($prepend = "", $append = "") {
    $content = get_the_content(null, 0);
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);
    return bfi_strip_stuff($prepend.$content.$append);
}
 
/**
 * Gets the names of all supported Cufon fonts
 *
 * @ignore This is an alias for bfi_get_contents()
 * @deprecated Use bfi_get_contents() instead
 */
function bfi_get_contents_stripped($prepend = "", $append = "") {
    return bfi_get_contents($prepend, $append);
}
