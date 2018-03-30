<?php
/*
 * Sets content_width value. 
 *
 * @see http://core.trac.wordpress.org/ticket/5777 for the purpose of $content_width.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 1120;
}

/**
 * Adjusts content_width value for WordPress embeds like videos.
 *
 * @return void
 */
function flow_content_width() {
	global $content_width;

	if ( is_singular( 'post' ) ) {
		$content_width = 900;
	}
}
add_action( 'template_redirect', 'flow_content_width' );
