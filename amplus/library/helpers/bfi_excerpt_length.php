<?php
/**
 */
 
/**
 * Changes the excerpt length to the specified number of characters
 *
 * @deprecated
 * @ignore
 * @param int $length The number of characters to display as an excerpt
 * @return null
 */
function bfi_set_excerpt_length($length) {
    global $bfi_excerpt_length;
    $bfi_excerpt_length = $length;
}

/**
 * This is a WP hook for bfi_set_excerpt_length
 *
 * @ignore This is a WP hook for bfi_set_excerpt_length
 * @param int $length The number of characters to display as an excerpt
 * @return int The new excerpt length
 */
function bfi_new_excerpt_length($length) {
    global $bfi_excerpt_length;
    return isset($bfi_excerpt_length) ? $bfi_excerpt_length : 50;
}
add_filter('excerpt_length', 'bfi_new_excerpt_length');