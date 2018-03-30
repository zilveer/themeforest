<?php
/**
 * Staff single layout
 *
 * @package Total WordPress theme
 * @subpackage Partials
 * @version 3.3.2
 *
 * @todo Seperate title and position and add new layout block for position.
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Single layout blocks
$blocks = wpex_staff_post_blocks();

// Make sure we have blocks
if ( ! empty( $blocks ) ) :

	// Loop through blocks and get template part
	foreach ( $blocks as $block ) :
		get_template_part( 'partials/staff/staff-single-'. $block );
	endforeach;

endif;