<?php
/**
 * Custom Post Type Entry
 *
 * @package Total WordPress theme
 * @subpackage Partials
 * @version 3.3.2
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'cpt-entry', 'wpex-clr' ) ); ?>>
	<div class="cpt-entry-inner wpex-clr">
		<?php
		// Get layout blocks
		$blocks = wpex_entry_blocks();
		// Make sure blocks aren't empty or null
		if ( ! empty( $blocks ) ) :
			// Loop through blocks and get template part
			foreach ( $blocks as $block ) :
				get_template_part( 'partials/cpt/cpt-entry-'. $block, get_post_type() );
			endforeach;
		endif; ?>
	</div><!-- .cpt-entry-inner -->
</article><!-- .cpt-entry -->