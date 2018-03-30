<?php
/**
 */
 
/**
 * Changes the excerpt readmore link
 *
 * @deprecated
 * @ignore
 * @param string $more The readmore label
 * @return null
 */
function bfi_set_excerpt_readmore($more) {
    global $bfi_excerpt_read_more;
    $bfi_excerpt_read_more = $more;
}

/**
 * Gets the excerpt readmore link
 *
 * @deprecated
 * @ignore
 * @return The readmore link
 */
function bfi_get_excerpt_readmore() {
    global $bfi_excerpt_read_more;
    return $bfi_excerpt_read_more;
}

/**
 * Changes the excerpt readmore link
 *
 * @deprecated
 * @ignore
 * @param string $more The readmore label
 * @return null
 */
function bfi_new_excerpt_readmore($more) {
    global $bfi_excerpt_read_more;
    return isset($bfi_excerpt_read_more) ? $bfi_excerpt_read_more : __("Read more", BFI_I18NDOMAIN);
}
add_filter('excerpt_more', 'bfi_new_excerpt_readmore');