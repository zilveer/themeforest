<?php
/**
 * Slide Up Title White Overlay
 *
 * @package Total WordPress Theme
 * @subpackage Partials
 * @version 3.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Only used for inside position
if ( 'inside_link' != $position ) {
	return;
}

// Get post data
$title = isset( $args['post_title'] ) ? $args['post_title'] : get_the_title();

// Output overlay
$output = '<div class="overlay-slideup-title overlay-hide white clr theme-overlay">';
	$output .= '<span class="title">';
		if ( 'staff' == get_post_type() ) {
			$output .= get_post_meta( get_the_ID(), 'wpex_staff_position', true );
		} else {
			$output .= $title;
		}
	$output .= '</span>';
$output .= '</div>';

echo $output;