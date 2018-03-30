<?php

/*********** Shortcode: Pullquote ************************************************************/

$ABdevDND_shortcodes['pullquote_dd'] = array(
	'hide_in_dnd' => true,
	'attributes' => array(
		'span' => array(
			'default' => '3',
			'description' => __('Span 1-11', 'dnd-shortcodes'),
		),
		'align' => array(
			'default' => 'left',
			'description' => __('Align', 'dnd-shortcodes'),
			'type' => 'select',
			'values' => array(
				'left' => __('Left', 'dnd-shortcodes'),
				'right' => __('Right', 'dnd-shortcodes'),
			),
		),
	),
	'content' => array(
		'description' => __('Content', 'dnd-shortcodes'),
	),
	'description' => __('Pullquote', 'dnd-shortcodes' )
);
function ABdevDND_pullquote_dd_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(ABdevDND_extract_attributes('pullquote_dd'), $attributes));

	return '<span class="dnd_pullquote dnd_pullquote_'.$align.' dnd_column_dd_span'.$span.'">
		'.$content.'
	</span>';
}

