<?php
/**
 * Custom Post Type Entry Content
 *
 * @package Total WordPress theme
 * @subpackage Partials
 * @version 3.3.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Should we check for the more tag?
$check_more_tag = apply_filters( 'wpex_check_more_tag', true ); ?>

<div class="cpt-entry-excerpt entry-excerpt wpex-clr">
	<?php
	// Check if post has a "more" tag
	if ( $check_more_tag && strpos( get_the_content(), 'more-link' ) ) :

		// Display entry content up to the more tag
		the_content( '', '&hellip;' );

	// Generate custom excerpt
	else :

		// Get excerpt length
		$excerpt_length = apply_filters( 'wpex_'. get_post_type() .'_entry_excerpt_length', '40' );

		// Output excerpt
		wpex_excerpt( array(
			'length' => $excerpt_length,
		) );

	endif; ?>
</div><!-- .cpt-entry-excerpt -->