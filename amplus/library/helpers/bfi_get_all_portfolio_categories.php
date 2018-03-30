<?php
/**
 */

/**
 * Gets all created portfolio categories
 *
 * @package API\Utility
 * @return array portfolio categories defined in the admin
 */
function bfi_get_all_portfolio_categories(){
    global $wpdb;
    
    $res = $wpdb->get_results($wpdb->prepare("SELECT t.term_id as cat_ID, t.name, t.slug, t.*, tt.* FROM $wpdb->terms as t LEFT JOIN $wpdb->term_taxonomy tt ON t.term_id=tt.term_id WHERE tt.taxonomy=%s ORDER BY t.name ASC;", BFIPortfolioModel::TAXONOMY_ID));
    
    // add the links
    foreach ($res as $k => $v) {
        $res[$k]->link = get_term_link($v->slug, BFIPortfolioModel::TAXONOMY_ID);
    }
    return $res;
}