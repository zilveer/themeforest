<?php
/**
 */

/**
 * Gets all pages
 *
 * @package API\Utility
 * @global $wpdb
 * @return array All published pages
 */
function bfi_get_all_pages() {
    global $wpdb;
    
    $postsPerPage = $wpdb->get_var(
        "SELECT COUNT(ID) "
        . "FROM $wpdb->posts "
        . "WHERE post_type = 'page' "
        . "AND post_status = 'publish'"
    );
        
    return get_posts(array(
        'posts_per_page' => $postsPerPage,
        'orderby' => 'title',
        'post_type' => 'page',
        'order' => 'asc',
    ));
}