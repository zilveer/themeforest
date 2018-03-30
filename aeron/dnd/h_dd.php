<?php

/*********** Shortcode: H1 - H6 headings ************************************************************/

$ABdevDND_shortcodes['h_dd'] = array(
	'attributes' => array(
		'type' => array(
			'default' => '3',
			'type' => 'select',
			'values' => array(
				'1' => 'H1',
				'2' => 'H2',
				'3' => 'H3',
				'4' => 'H4',
				'5' => 'H5',
				'6' => 'H6',
			),
			'description' => __('Type', 'dnd-shortcodes'),
		),
		'class' => array(
			'description' => __('Custom class', 'dnd-shortcodes'),
			'info' => __('Additional custom classes for custom styling', 'dnd-shortcodes'),
		),
	),
	'content' => array(
		'description' => __('Title', 'dnd-shortcodes'),
	),
	'description' => __('H1-H6 Headings', 'dnd-shortcodes' )
);
function ABdevDND_h_dd_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(ABdevDND_extract_attributes('h_dd'), $attributes));
	$class_out = (isset($class) && $class!='') ? ' class="'.$class.'"' : '';
    return '<h' . $type . $class_out . '><span>' . do_shortcode($content) . '</span></h' . $type . '>';
}
