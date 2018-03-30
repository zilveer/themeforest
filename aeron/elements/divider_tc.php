<?php

/*********** Shortcode: Content Divider ************************************************************/

$tcvpb_elements['divider_tc'] = array(
	'name' => esc_html__('Content Divider', 'ABdev_aeron' ),
	'type' => 'block',
	'icon' => 'pi-divider',
	'category' =>  esc_html__('Content', 'ABdev_aeron'),
	'attributes' => array(
		'style' => array(
			'default' => 'fat',
			'description' => esc_html__('Divider Style', 'ABdev_aeron'),
			'type' => 'select',
			'values' => array(
				'solid' => 'Solid Line',
				'dashed' => 'Dashed Line',
				'double' => 'Double Line',
				'dotted' => 'Dotted Line',
				'fat' => 'Default',
			),
		),
		'color' => array(
			'description' => esc_html__('Override Color', 'ABdev_aeron'),
			'type' => 'color',
		),
		'position' => array(
			'default' => 'center',
			'description' => esc_html__('Divider Position', 'ABdev_aeron'),
			'type' => 'select',
			'values' => array(
				'center' => 'Center',
				'left' => 'Left',
				'right' => 'Right',
			),
		),
		'animation' => array(
			'default'     => '',
			'description' => esc_html__('Entrance Animation', 'ABdev_aeron'),
			'type'        => 'select',
			'tab'         => esc_html__('Animation', 'ABdev_aeron'),
			'values'      => array(
				''                  => esc_html__('None', 'ABdev_aeron'),
				'animate_fade'      => esc_html__('Fade', 'ABdev_aeron'),
				'animate_afc'       => esc_html__('Zoom', 'ABdev_aeron'),
				'animate_afl'       => esc_html__('Fade to Right', 'ABdev_aeron'),
				'animate_afr'       => esc_html__('Fade to Left', 'ABdev_aeron'),
				'animate_aft'       => esc_html__('Fade Down', 'ABdev_aeron'),
				'animate_afb'       => esc_html__('Fade Up', 'ABdev_aeron'),
			),
		),
		'trigger_pt' => array(
			'description' => esc_html__('Trigger Point (in px)', 'ABdev_aeron'),
			'info'        => esc_html__('Amount of pixels from bottom to start animation', 'ABdev_aeron'),
			'default'     => '0',
			'tab'         => esc_html__('Animation', 'ABdev_aeron'),
		),
		'duration' => array(
			'description' => esc_html__('Animation Duration (in ms)', 'ABdev_aeron'),
			'default'     => '1000',
			'tab'         => esc_html__('Animation', 'ABdev_aeron'),
		),
		'delay' => array(
			'description' => esc_html__('Animation Delay (in ms)', 'ABdev_aeron'),
			'default'     => '0',
			'tab'         => esc_html__('Animation', 'ABdev_aeron'),
		),
		'id' => array(
			'description' => esc_html__('ID', 'ABdev_aeron'),
			'info' => esc_html__('Additional custom ID', 'ABdev_aeron'),
			'tab' => esc_html__('Advanced', 'ABdev_aeron'),
		),
		'class' => array(
			'description' => esc_html__('Class', 'ABdev_aeron'),
			'info' => esc_html__('Additional custom classes for custom styling', 'ABdev_aeron'),
			'tab' => esc_html__('Advanced', 'ABdev_aeron'),
		),
	)
);
function tcvpb_divider_tc_shortcode( $attributes ) {
    extract(shortcode_atts(tcvpb_extract_attributes('divider_tc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';

	$animation_classes='';
	$animation_out='';
	if($animation!=''){
		$animation_classes = 'tcvpb-animo '.esc_attr($animation).'';
		$animation_out = ' data-trigger_pt="'.esc_attr($trigger_pt).'" data-duration="'.esc_attr($duration).'" data-delay="'.esc_attr($delay).'"';
	}

	$divider_style = ($style != '') ? 'tcvpb_divider_'.esc_attr($style).'' : '';
	$divider_position = ($position != '') ? 'tcvpb_divider_'.esc_attr($position).'' : '';
	$color = ($color != '') ? 'border-top-color: '.esc_attr($color).';' : '';

	return '<div '.esc_attr($id_out).' class="tcvpb_divider '.$divider_style.' '.$divider_position.' '.esc_attr($class).' '.$animation_classes.'" style="'.esc_attr($color).'" '.$animation_out.'></div>';
}
