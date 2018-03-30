<?php
/**
 * Title Push Up Overlay
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

// Get post title
$title = isset( $args['post_title'] ) ? $args['post_title'] : get_the_title();

// Output
echo '<div class="overlay-title-bottom theme-overlay textcenter"><span class="title">'. $title .'</span></div>';