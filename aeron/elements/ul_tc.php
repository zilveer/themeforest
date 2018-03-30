<?php

/*********** Shortcode: UL Wrapper ************************************************************/
$tcvpb_elements['ul_tc'] = array(
	'name' => esc_html__('Unordered List', 'ABdev_aeron' ),
	'type' => 'block',
	'icon' => 'pi-list',
	'category' =>  esc_html__('Content', 'ABdev_aeron'),
	'child' => 'li_tc',
	'child_title' => esc_html__('List Item', 'ABdev_aeron'),
	'child_button' => esc_html__('Add List Item', 'ABdev_aeron'),
	'attributes' => array(
		'dummy' => array(
			'type' => 'hidden',
		),
		'animation' => array(
			'default' => '',
			'description' => esc_html__('Entrance Animation', 'ABdev_aeron'),
			'type' => 'select',
			'values'      => array(
				''                  => esc_html__('None', 'ABdev_aeron'),
				'animate_fade'      => esc_html__('Fade', 'ABdev_aeron'),
				'animate_afc'       => esc_html__('Zoom', 'ABdev_aeron'),
				'animate_afl'       => esc_html__('Fade to Right', 'ABdev_aeron'),
				'animate_afr'       => esc_html__('Fade to Left', 'ABdev_aeron'),
				'animate_aft'       => esc_html__('Fade Down', 'ABdev_aeron'),
				'animate_afb'       => esc_html__('Fade Up', 'ABdev_aeron'),
			),
			'tab' => esc_html__('Animation', 'ABdev_aeron'),
		),
		'trigger_pt' => array(
			'description' => esc_html__('Trigger Point (in px)', 'ABdev_aeron'),
			'info'        => esc_html__('Amount of pixels from bottom to start animation', 'ABdev_aeron'),
			'default'     => '0',
			'tab'         => esc_html__('Animation', 'ABdev_aeron'),
		),
		'duration' => array(
			'description' => esc_html__('Animation Duration (ms)', 'ABdev_aeron'),
			'default' => '1100',
			'tab' => esc_html__('Animation', 'ABdev_aeron'),
		),
		'delay' => array(
			'description' => esc_html__('Inner Delay (ms)', 'ABdev_aeron'),
			'default' => '0',
			'tab' => esc_html__('Animation', 'ABdev_aeron'),
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
function tcvpb_ul_tc_shortcode( $attributes, $content = null ) {
	global $astir_ul_animation;
	extract(shortcode_atts(tcvpb_extract_attributes('ul_tc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';

	$classes=array();

	$astir_ul_animation = $animation;
	$animation_out='';
	if($animation!=''){
		$classes[] = 'tcvpb-animo-children';
		$duration = ($duration!='') ? $duration : '1000';
		$animation_out = 'data-trigger_pt="'.esc_attr($trigger_pt).'" data-duration="'.esc_attr($duration).'" data-delay="'.esc_attr($delay).'"';
	}


	if($class!=''){
		$classes[] = $class;
	}

	$classes = implode(' ', $classes);

	return '<ul '.esc_attr($id_out).' class="tcvpb_shortcode_ul '.esc_attr($classes).' '.$animation_out.'" '.$animation_out.'>'.do_shortcode($content).'</ul>';
}


$tcvpb_elements['li_tc'] = array(
	'name' => esc_html__('List Item', 'ABdev_aeron' ),
	'type' => 'child',
	'icon' => 'pi-customize',
	'attributes' => array(
		'icon' => array(
			'description' => esc_html__('Icon', 'ABdev_aeron'),
			'type' => 'icon',
		),
		'icon_color' => array(
			'type' => 'color',
			'description' => esc_html__('Icon Color', 'ABdev_aeron'),
		),
	),
	'content' => array(
		'description' => esc_html__('Item Content', 'ABdev_aeron'),
	)
);
function tcvpb_li_tc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(tcvpb_extract_attributes('li_tc'), $attributes));
	global $astir_ul_animation;

	$icon_color_out = ($icon_color!='') ? ' style="color:'.esc_attr($icon_color).';"' : '';
	$icon_out = ($icon!='') ? '<i class="'.esc_attr($icon).'"'.$icon_color_out.'></i> ' : '';
	return '<li class="'.$astir_ul_animation.'">'.$icon_out.do_shortcode($content).'</li>';
}
