<?php

/*********** Shortcode: Date ************************************************************/

$ABdevDND_shortcodes['date_dd'] = array(
	'hide_in_dnd' => true,
	'attributes' => array(
		'format' => array(
			'default' => 'd.m.Y',
			'description' => __('PHP Date Format', 'dnd-shortcodes'),
		),
		'target' => array(
			'description' => __('Target Date', 'dnd-shortcodes'),
			'info' => __('PHP strtotime acceptable string, e.g. yesterday, last Monday, 2 days ago...', 'dnd-shortcodes'),
		),
	),
	'description' => __('Date', 'dnd-shortcodes' )
);
function ABdevDND_date_dd_shortcode($attributes, $content = null){
	extract(shortcode_atts(ABdevDND_extract_attributes('date_dd'), $attributes));
	
	if($target=='')
		return date($format);
	else 
		return date($format,strtotime($target));
}



