<?php
/**
 */

/**
 * Returns true if the current page is a (blog) post
 *
 * @return boolean true if the current page is a post, false if not
 */
function bfi_is_post() {
    global $post;
    return $post != null && $post->post_type == 'post';
}