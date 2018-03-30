<?php
/**
 */
 
/**
 * Gets the template assigned to a page that was saved in an option
 *
 * @package API\Utility
 * @param string $optionName the option name that has a page ID
 * @return string the name of the template used
 */
function bfi_get_template_from_option($optionName) {
    return bfi_get_post_meta(bfi_get_option($optionName), '_wp_page_template', true );
}