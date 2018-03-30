<?php
/**
 * Footer Builder Content
 *
 * @package Total WordPress Theme
 * @subpackage Partials
 * @version 3.5.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get page ID
$page_id = wpex_global_obj( 'header_builder' );

// Display footer builder
if ( $page_id ) :

	// Live builder
	if ( wpex_vc_is_inline() && is_page( $page_id ) ) :

		// Start loop
		while ( have_posts() ) : the_post();

			the_content();

		endwhile;

	// Front end
	else :

		echo do_shortcode( get_post_field( 'post_content', $page_id ) );

	endif;

endif;