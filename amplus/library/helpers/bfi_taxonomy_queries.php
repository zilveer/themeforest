<?php
/**
 */

/**
 * Gets the taxonomy slug from a category id, this is needed when using
 * categories with WP_Query or query_posts
 *
 * @package API\Utility
 * @param int $term_id a category id
 * @return string the taxonomy slug that can be used with WP_Query or query_posts
 */
function bfi_get_taxonomy_slug($term_id){
    global $wpdb;
    
    $res = $wpdb->get_results($wpdb->prepare("SELECT slug FROM $wpdb->terms WHERE term_id=%s LIMIT 1;", $term_id));
    $res=$res[0];
    return $res->slug;
}
