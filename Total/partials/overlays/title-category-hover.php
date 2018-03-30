<?php
/**
 * Title Category Hover Overlay
 *
 * @package Total WordPress Theme
 * @subpackage Partials
 * @version 3.5.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Only used for inside position
if ( 'inside_link' != $position ) {
	return;
}

// Get category taxonomy for current post type
$taxonomy = wpex_get_post_type_cat_tax();

// Get terms
if ( $taxonomy ) {
	$terms = wpex_list_post_terms( $taxonomy, $show_links = false, $echo = false );
}

// Get post title
$title = isset( $args['post_title'] ) ? $args['post_title'] : get_the_title();

$output = '<div class="overlay-title-category-hover overlay-hide theme-overlay textcenter">';
	$output .= '<div class="overlay-table clr">';
		$output .= '<div class="overlay-table-cell clr">';
			$output .= '<div class="overlay-title">'. esc_html( $title ) .'</div>';
			if ( ! empty( $terms ) ) {
				$output .= '<div class="overlay-terms">'. $terms .'</div>';
			}
		$output .= '</div>';
	$output .= '</div>';
$output .= '</div>';

echo $output;