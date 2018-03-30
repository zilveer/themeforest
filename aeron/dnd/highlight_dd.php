<?php

/*********** Shortcode: Highlight Color ************************************************************/

$ABdevDND_shortcodes['highlight_dd'] = array(
	'hide_in_dnd' => true,
	'attributes' => array(
		'color' => array(
			'default' => '#FFFF44',
			'type' => 'color',
			'description' => __('Highlight Color', 'dnd-shortcodes'),
		),
		'text_color' => array(
			'default' => '#666',
			'type' => 'color',
			'description' => __('Text Color', 'dnd-shortcodes'),
		),
	),
	'content' => array(
		'description' => __('Highlighted Content', 'dnd-shortcodes'),
	),
	'description' => __('Highlighted text', 'dnd-shortcodes' )
);
function ABdevDND_highlight_dd_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(ABdevDND_extract_attributes('highlight_dd'), $attributes));
	$text_color_out = ($text_color != '') ? ' color:'.$text_color : '';
	return '<span style="background-color:'.$color.';'.$text_color_out.'">' . do_shortcode( $content ) . '</span>';
}


