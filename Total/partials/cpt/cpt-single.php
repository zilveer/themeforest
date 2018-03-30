<?php
/**
 * Single Custom Post Type Layout
 *
 * To alter the layout for any custom post type single post use the
 * wpex_{post_type}_single_blocks filter instead of tweaking this file
 * see partials/core.php - or for full control create your own single-{post_type}.php file
 * in your child theme.
 *
 * @package Total WordPress theme
 * @subpackage Partials
 * @version 3.5.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get layout blocks
$blocks = wpex_single_blocks();

// Make sure we have blocks
if ( ! empty( $blocks ) ) :

	// Loop through blocks and get template part
	foreach ( $blocks as $block ) :
		if ( 'media' == $block && get_post_meta( get_the_ID(), 'wpex_post_media_position', true ) ) {
			continue;
		}
		get_template_part( 'partials/cpt/cpt-single-'. $block, get_post_type() );
	endforeach;

endif;