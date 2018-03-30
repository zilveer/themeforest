<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Cheatin&#8217; uh?' );
}

// Make sure the plugin is active
if( ! defined( 'YOUXI_BUILDER_VERSION' ) ) {
	return;
}

/**
 * Disable enqueueing the default assets
 */
add_filter( 'youxi_builder_enable_container', '__return_false' );
