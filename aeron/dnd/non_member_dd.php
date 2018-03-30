<?php

/*********** Shortcode: Not Member only content ************************************************************/

$ABdevDND_shortcodes['non_member_dd'] = array(
	'content' => array(
		'description' => __('Content', 'dnd-shortcodes'),
	),
	'info' => __('Content in this shortcode will be visible to non-registered visitors only', 'dnd-shortcodes'),
	'description' => __('Non Members Only Content ', 'dnd-shortcodes' )
);
function ABdevDND_non_member_dd_shortcode( $attributes, $content = null ) {  
	if ( !is_user_logged_in() && !is_null( $content ) && !is_feed() )  
		return do_shortcode($content);  
	return '';  
}

