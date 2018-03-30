<?php

/*********** Shortcode: Clear ************************************************************/

$ABdevDND_shortcodes['clear_dd'] = array(
	'description' => __('Clear', 'dnd-shortcodes'),
	'info' => __('This shortcode generates clear:both div element', 'dnd-shortcodes' )
);
function ABdevDND_clear_dd_shortcode( $attributes ) {
	return '<div class="dnd_clear"></div>';
}
