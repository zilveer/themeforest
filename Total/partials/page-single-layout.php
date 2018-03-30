<?php
/**
 * Single Page Layout
 *
 * @package Total WordPress theme
 * @subpackage Partials
 * @version 3.5.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<article class="single-page-article wpex-clr"><?php
	// Get single layout blocks
	$blocks = wpex_single_blocks();
	// Make sure we have blocks
	if ( ! empty( $blocks ) ) :
		// Loop through blocks
		foreach ( $blocks as $block ) :
			// Get block template part
			get_template_part( 'partials/page-single-'. $block );
		endforeach;
	endif;
?></article>