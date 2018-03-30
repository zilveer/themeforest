<?php
/**
 */

/**
 * Returns true if the current page is a page
 *
 * @return boolean true if the current page is a page, false if not
 */
function bfi_is_page() {
    global $post;
    return $post != null && $post->post_type == "page";
}
