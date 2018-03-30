<?php

/*********** Shortcode: Spacer ************************************************************/

$ABdevDND_shortcodes['spacer_dd'] = array(
	'attributes' => array(
		'pixels' => array(
			'default' => '15',
			'description' => __('Height in Pixels', 'dnd-shortcodes'),
		),
	),
	'description' => __('Spacer', 'dnd-shortcodes'),
	'info' => __('This shortcode will add additional vertical space between elements', 'dnd-shortcodes')
);
function ABdevDND_spacer_dd_shortcode( $attributes ) {
    extract(shortcode_atts(ABdevDND_extract_attributes('spacer_dd'), $attributes));
    return '<span class="clear" style="height:'.$pixels.'px;display:block;"></span>';
}


