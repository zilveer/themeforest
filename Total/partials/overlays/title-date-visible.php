<?php
/**
 * Title Date Visibile Overlay
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

// Get post data
$title = isset( $args['post_title'] ) ? $args['post_title'] : get_the_title();
$date  = isset( $args['post_date'] ) ? $args['post_date'] : get_the_date();

// Output overlay
$output = '<div class="overlay-title-date-visible theme-overlay textcenter">';
	$output .='<div class="overlay-table clr">';
		$output .='<div class="overlay-table-cell clr">';
			$output .='<div class="overlay-title">'. esc_html( $title ) .'</div>';
			$output .='<div class="overlay-date">'. esc_html( $date ) .'</div>';
		$output .='</div>';
	$output .='</div>';
$output .='</div>';

echo $output;