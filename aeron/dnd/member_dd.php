<?php

/*********** Shortcode: Member only content ************************************************************/

$ABdevDND_shortcodes['member_dd'] = array(
	'content' => array(
		'description' => __('Content', 'dnd-shortcodes'),
	),
	'info' => __('Content in this shortcode will be vissible to registered users only', 'dnd-shortcodes'),
	'description' => __('Members Only Content ', 'dnd-shortcodes' )
);
function ABdevDND_member_dd_shortcode( $attributes, $content = null ) {  
	if ( is_user_logged_in() && !is_null( $content ) && !is_feed() )  
		return do_shortcode($content);  
	return '';  
}

