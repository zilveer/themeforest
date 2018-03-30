<?php
/**
 * Category Tag v2
 *
 * @package Total WordPress Theme
 * @subpackage Partials
 * @version 3.5.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Only used for outside position
if ( 'outside_link' != $position ) {
	return;
}

// Get category taxonomy for current post type
$taxonomy = wpex_get_post_type_cat_tax();

// Get terms
if ( $taxonomy ) {

	// Get terms
	$terms = wp_get_post_terms( get_the_ID(), $taxonomy );

	// Display if we have terms
	if ( $terms ) {

		$output = '<div class="overlay-category-tag-two theme-overlay wpex-clr">';

			foreach ( $terms as $term ) {

				$output .= '<a href="'. esc_url( get_term_link( $term->term_id, $taxonomy ) ) .'" title="'. esc_attr( $term->name ) .'">'. $term->name .'</a>';
				
			}

		$output .= '</div>';

		echo $output;

	}

}