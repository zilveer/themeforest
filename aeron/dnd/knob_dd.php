<?php

/*********** Shortcode: Knob ************************************************************/

$ABdevDND_shortcodes['knob_dd'] = array(
	'attributes' => array(
		'number' => array(
			'description' => __('Knob Number', 'dnd-shortcodes'),
		),
		'hide_number' => array(
			'description' => __('Hide Number', 'dnd-shortcodes'),
			'type' => 'checkbox',
			'default' => false,
		),
		'angle_offset' => array(
			'description' => __('Angle Offset', 'dnd-shortcodes'),
			'info' => __('Starting angle in degrees, default=0', 'dnd-shortcodes'),
		),
		'angle_arc' => array(
			'description' => __('Angle Arc', 'dnd-shortcodes'),
			'info' => __('Arc size in degrees, default=360', 'dnd-shortcodes'),
		),
		'thickness' => array(
			'description' => __('Arc Thickness', 'dnd-shortcodes'),
			'info' => __('Percent of arc out of circle, 1 very thick, 100 full circle', 'dnd-shortcodes'),
		),
		'ending' => array(
			'description' => __('Arc Stroke Ending', 'dnd-shortcodes'),
			'type' => 'select',
			'default' => 'default',
			'values' => array(
				'default' => __('Default', 'dnd-shortcodes'),
				'round' => __('Rounded', 'dnd-shortcodes'),
			),
		),
		'full_color' => array(
			'description' => __('Full Color', 'dnd-shortcodes'),
			'type' => 'color',
			'default' => '#999',
		),
		'empty_color' => array(
			'description' => __('Empty Color', 'dnd-shortcodes'),
			'type' => 'color',
		),
		'inner_color' => array(
			'description' => __('Inner Circle Color', 'dnd-shortcodes'),
			'type' => 'color',
		),
		'number_color' => array(
			'description' => __('Number Color', 'dnd-shortcodes'),
			'type' => 'color',
			'default' => '#656565',
		),
		'inner_circle_distance' => array(
			'description' => __('Inner Circle Distance', 'dnd-shortcodes'),
			'info' => __('Distance of inner circle from arc, only if Inner Circle Color is defined; value in px', 'dnd-shortcodes'),
		),
		'label' => array(
			'description' => __('Knob Label', 'dnd-shortcodes'),
		),
		'class' => array(
			'description' => __('Class', 'dnd-shortcodes'),
			'info' => __('Additional custom classes for custom styling', 'dnd-shortcodes'),
		),
	),
	'description' => __('Knob', 'dnd-shortcodes')
);
function ABdevDND_knob_dd_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(ABdevDND_extract_attributes('knob_dd'), $attributes));

	$thickness_out = ($thickness!='') ? $thickness/100 : '';

	$out ='<div class="dnd_knob_wrapper '.$class.'">';
	$out .= '<div class="dnd_knob_inner_wrap">';
	$out .= (!$hide_number) ? '<div class="dnd_knob_number_sign" style="color:'.$number_color.';"><span class="dnd_knob_number">0</span>%</div>' :'';
	$out .= '<input type="text" class="dnd_knob" value="'.$number.'" data-width="100%"  data-number="'.$number.'" data-fgColor="'.$full_color.'" data-bgColor="'.$empty_color.'" data-innerColor="'.$inner_color.'" data-lineCap="'.$ending.'" data-thickness="'.$thickness_out.'" data-angleArc="'.$angle_arc.'" data-angleOffset="'.$angle_offset.'" data-hideNumber="'.$hide_number.'" data-innerCircleDistance="'.$inner_circle_distance.'">';
	$out .= '</div>';
	$out .= ($label!='')?'<h3>'.$label.'</h3>':'';
	$out .= '</div>';
	return $out;
}


