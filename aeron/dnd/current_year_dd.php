<?php

/*********** Shortcode: Current Year ************************************************************/

$ABdevDND_shortcodes['current_year_dd'] = array(
	'hide_in_dnd' => true,
	'info' => __('This shortcode will generate current year, no matter when post was published', 'dnd-shortcodes'),
	'description' => __('Current Year', 'dnd-shortcodes' )
);
function ABdevDND_current_year_dd_shortcode(){
	return date('Y');
}

