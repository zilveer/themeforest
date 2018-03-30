<?php

/*********** Shortcode: Tooltip ************************************************************/

$ABdevDND_shortcodes['tooltip_dd'] = array(
	'hide_in_dnd' => true,
	'attributes' => array(
		'text' => array(
			'description' => __('Text', 'dnd-shortcodes'),
		),
		'link' => array(
			'description' => __('Link', 'dnd-shortcodes'),
		),
		'target' => array(
			'description' => __('Target', 'dnd-shortcodes'),
			'default' => '_self',
			'type' => 'select',
			'values' => array(
				'_self' =>  __('Self', 'dnd-shortcodes'),
				'_blank' => __('Blank', 'dnd-shortcodes'),
			),
		),
		'gravity' => array(
			'description' => __('Tooltip Gravity', 'dnd-shortcodes'),
			'default' => 's',
			'type' => 'select',
			'values' => array(
				's' =>  __('South', 'dnd-shortcodes'),
				'n' => __('North', 'dnd-shortcodes'),
				'e' => __('East', 'dnd-shortcodes'),
				'w' => __('West', 'dnd-shortcodes'),
				'nw' =>  __('Northwest', 'dnd-shortcodes'),
				'ne' => __('Northeast', 'dnd-shortcodes'),
				'sw' => __('Southwest', 'dnd-shortcodes'),
				'se' => __('Southeast', 'dnd-shortcodes'),
			),
		),
	),
	'content' => array(
		'description' => __('Tooltip Content', 'dnd-shortcodes'),
	),
	'description' => __('Tooltip', 'dnd-shortcodes' )
);
function ABdevDND_tooltip_dd_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(ABdevDND_extract_attributes('tooltip_dd'), $attributes));

	$link_output=($link!='')?' href="'.$link.'"':'';
	$target_output=($target!='')?' target="'.$target.'"':'';

	return '<a'.$link_output.' class="dnd_tooltip" data-gravity="'.$gravity.'" title="'.$text.'"'.$target_output.'>'.$content.'</a>';
}



