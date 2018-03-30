<?php
/**
 * Title Center
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

// Echo overlay
echo '<div class="overlay-title-center theme-overlay textcenter"><div class="overlay-table"><div class="overlay-table-cell"><span class="title">'. $title .'</span></div></div></div>';