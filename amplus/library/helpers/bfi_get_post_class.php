<?php
/**
 */
 
/**
 * Gets the CSS classes for the current post, use this instead of WP's get_post_class()
 *
 * Use this to get the class names to be placed inside the 
 * class attribute of the page's body tag
 *
 * @package API\Post
 * @param string $class class names to include in the list
 * @param int $post_id the ID of the post
 * @return string space delimited class names
 */
function bfi_get_post_class($class, $post_id) {
    $classes = get_post_class($class, $post_id);
    if (is_array($classes)) {
        $ret = '';
        foreach ($classes as $class) {
            $ret .= $ret ? " " : "";
            $ret .= $class;
        }
        return $ret;
    }
    return "";
}