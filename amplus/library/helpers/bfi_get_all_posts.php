<?php
/**
 */

/**
 * Gets all blog posts
 *
 * @package API\Utility
 * @global $wpdb
 * @return array All published blog posts
 */
function bfi_get_all_posts() {
    global $wpdb;
    
    $postsPerPage = $wpdb->get_var(
        "SELECT COUNT(ID) "
        . "FROM $wpdb->posts "
        . "WHERE post_type = 'post' "
        . "AND post_status = 'publish'"
    );
    
    return get_posts(array(
        'posts_per_page' => $postsPerPage,
        'orderby' => 'title', //'date',
        'order' => 'asc',
    ));
}