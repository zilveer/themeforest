<?php

/*********** Shortcode: Dropcap Letter ************************************************************/

$ABdevDND_shortcodes['dropcap_dd'] = array(
	'hide_in_dnd' => true,
	'attributes' => array(
		'letter' => array(
			'description' => __('Dropcap letter', 'dnd-shortcodes'),
		),
		'class' => array(
			'description' => __('Class', 'dnd-shortcodes'),
			'info' => __('Additional custom classes for custom styling', 'dnd-shortcodes'),
		),
	),
	'description' => __('Dropcap Letter', 'dnd-shortcodes' )
);
function ABdevDND_dropcap_dd_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(ABdevDND_extract_attributes('dropcap_dd'), $attributes));
	return '<span class="dnd_dropcap '.$class.'">'.$letter.'</span>';
}
