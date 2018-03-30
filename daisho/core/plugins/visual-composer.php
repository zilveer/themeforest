<?php
/**
 * Force Visual Composer to initialize as "built into the theme".
 * This will hide certain tabs on Settings > Visual Composer page.
 */
function flow_vc_before_init() {
	vc_set_as_theme();
}
add_action( 'vc_before_init', 'flow_vc_before_init' );
