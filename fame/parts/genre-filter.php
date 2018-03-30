<?php
/**
 * Displays works genre filter
 *
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

global $apollo13;

$genre_template = defined('A13_GENRE_TEMPLATE');

if($genre_template !== true){
    $is_works_list      = defined('A13_WORKS_LIST_PAGE');
    $is_galleries_list  = defined('A13_GALLERIES_LIST_PAGE');

    $terms = array();

    //prepare filter
    if( defined('A13_WORKS_LIST_PAGE') ){
        $terms = get_terms(A13_CPT_WORK_TAXONOMY, 'hide_empty=1');
        $is_filter_open = $apollo13->get_option('cpt_work', 'filter_open') === 'on';
    }
    elseif(defined('A13_GALLERIES_LIST_PAGE')){
        $terms = get_terms(A13_CPT_GALLERY_TAXONOMY, 'hide_empty=1');
        $is_filter_open = $apollo13->get_option('cpt_gallery', 'filter_open') === 'on';
    }

    if( count( $terms ) ):
        echo '<ul class="genre-filter clearfix'.($is_filter_open? ' open' : '').'">';

        echo '<li class="label"><i class="fa fa-bars"></i>'.__( 'Filter', 'fame' ).'</li>';
        echo '<li class="selected" data-filter="__all"><a href="' . a13_current_url() . '">' . __( 'All', 'fame' ) . '</a></li>';
        foreach($terms as $term) {
            echo '<li data-filter="'.$term->term_id.'"><a href="'.esc_url(get_term_link($term)).'">' . $term->name . '</a></li>';
        }

        echo '</ul>';
    endif;
}