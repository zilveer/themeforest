<?php
/**
 * Categories + Title Bottom Visible
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
if ( 'outside_link' != $position ) {
	return;
}

// Get category taxonomy for current post type
$taxonomy = wpex_get_post_type_cat_tax();

// Get terms
if ( $taxonomy ) {
	$terms = wpex_list_post_terms( $taxonomy, $show_links = true, $echo = false );
}

// Get post title
$title = isset( $args['post_title'] ) ? $args['post_title'] : get_the_title();

// Output overlay
$output = '<div class="overlay-cats-title-btm-v theme-overlay">';
	if ( ! empty( $terms ) ) {
		$output .= '<div class="overlay-cats-title-btm-v-cats clr">'. $terms .'</div>';
	}
	$output .= '<a href="'. get_permalink() .'" title="'. esc_attr( $title ) .'" class="overlay-cats-title-btm-v-title entry-title">'. esc_html( $title ) .'</a>';
$output .= '</div>';

echo $output;