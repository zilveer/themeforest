<?php
/**
 * Portfolio single layout
 *
 * @package Total WordPress theme
 * @subpackage Partials
 * @version 3.3.2
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Single layout blocks
$blocks = wpex_portfolio_post_blocks();

// Make sure we have blocks
if ( ! empty( $blocks ) ) :

	// Loop through blocks and get template part
	foreach ( $blocks as $block ) :
		get_template_part( 'partials/portfolio/portfolio-single-'. $block );
	endforeach;

endif;