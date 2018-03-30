<?php
/**
 */

/**
 * Gets all portfolio items
 *
 * @package API\Utility
 * @global $wpdb
 * @return array All published portfolio items
 */
function bfi_get_all_portfolio() {
    global $wpdb;
    
    $postsPerPage = $wpdb->get_var(
        "SELECT COUNT(ID) "
        . "FROM $wpdb->posts "
        . "WHERE post_type = '" . BFIPortfolioModel::POST_TYPE . "' "
        . "AND post_status = 'publish'"
    );
    
    return get_posts(array(
        'posts_per_page' => $postsPerPage,
        'orderby' => 'title', //'menu_order date',
        'post_type' => BFIPortfolioModel::POST_TYPE,
        'order' => 'asc',
    ));
}