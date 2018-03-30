<?php
/**
 * Title Excerpt Hover Overlay
 *
 * @package Total WordPress Theme
 * @subpackage Partials
 * @version 3.5.3
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Only used for inside position
if ( 'inside_link' != $position ) {
	return;
}

// Get excerpt length
$excerpt_length = isset( $args['overlay_excerpt_length'] ) ? $args['overlay_excerpt_length'] : 15;

// Generate Excerpt
$excerpt = wpex_get_excerpt( array(
	'length' => $excerpt_length,
) );

// Make sure excerpt isn't too long when custom
if ( '-1' != $excerpt_length && $excerpt && ( strlen( $excerpt ) > $excerpt_length ) ) {
	$excerpt = wp_trim_words( $excerpt, $excerpt_length );
}

// Get title
$title = isset( $args['post_title'] ) ? $args['post_title'] : get_the_title();

// Output overlay
$output = '<div class="overlay-title-excerpt-hover overlay-hide theme-overlay textcenter">';
	$output .= '<div class="overlay-table clr">';
		$output .= '<div class="overlay-table-cell clr">';
			$output .= '<div class="overlay-title">'. esc_html( $title ) .'</div>';
			if ( $excerpt ) {
				$output .= '<div class="overlay-excerpt">'. $excerpt .'</div>';
			}
		$output .= '</div>';
	$output .= '</div>';
$output .= '</div>';

echo $output;