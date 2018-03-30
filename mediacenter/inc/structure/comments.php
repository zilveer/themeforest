<?php
/**
 * Template functions used for the site comments.
 *
 * @package mediacenter
 */

/**
 * MediaCenter display comments
 * 
 * @return void
 */
if ( ! function_exists( 'mc_display_comments' ) ) {
	function mc_display_comments() {
		// If comments are open or we have at least one comment, load up the comment template
		if ( comments_open() || '0' != get_comments_number() ) :
			comments_template();
		endif;
	}
}