<?php

/*********** Shortcode: Stats Excerpt ************************************************************/

$tcvpb_elements['stats_excerpt_tc'] = array(
	'name' => esc_html__('Stats Excerpt', 'ABdev_aeron' ),
	'type' => 'block',
	'icon' => 'pi-stats',
	'category' =>  esc_html__('Content', 'ABdev_aeron'),
	'attributes' => array(
		'background_color' => array(
			'description' => esc_html__('Background Color', 'ABdev_aeron'),
			'type' => 'coloralpha',
			'divider' => 'true',
		),
		'icon' => array(
			'description' => esc_html__('Icon', 'ABdev_aeron'),
			'type' => 'icon',
		),
		'icon_color' => array(
			'description' => esc_html__('Icon Color', 'ABdev_aeron'),
			'type' => 'color',
			'divider' => 'true',
		),
		'number' => array(
			'description' => esc_html__('Stats Number', 'ABdev_aeron'),
		),
		'number_color' => array(
			'description' => esc_html__('Stats Number Color', 'ABdev_aeron'),
			'type' => 'color',
		),
		'number_sign' => array(
			'description' => esc_html__('Stats Number Sign', 'ABdev_aeron'),
		),
		'number_sign_color' => array(
			'description' => esc_html__('Stats Number Sign Color', 'ABdev_aeron'),
			'type' => 'color',
			'divider' => 'true',
		),
		'duration' => array(
			'default' => '1500',
			'description' => esc_html__('Animation duration (ms)', 'ABdev_aeron'),
			'divider' => 'true',
		),
		'trigger_pt' => array(
			'description' => esc_html__('Trigger Point (in px)', 'ABdev_aeron'),
			'info' => esc_html__('Amount of pixels from bottom to start animation', 'ABdev_aeron'),
			'default' => '0',
			'divider' => 'true',
		),
		'description' => array(
			'description' => esc_html__('Description', 'ABdev_aeron'),
		),
		'description_color' => array(
			'description' => esc_html__('Description Color', 'ABdev_aeron'),
			'type' => 'color',
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
function tcvpb_stats_excerpt_tc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(tcvpb_extract_attributes('stats_excerpt_tc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';

	$animation_classes='';
	$animation_out='';
	if($animation!=''){
		$animation_classes = 'tcvpb-animo '.esc_attr($animation).'';
		$animation_out = ' data-trigger_pt="'.esc_attr($trigger_pt).'" data-duration="'.esc_attr($duration).'" data-delay="'.esc_attr($delay).'"';
	}

	$icon_out = ($icon!='') ? '<i class="'.esc_attr($icon).'" style="color:'.esc_attr($icon_color).';"></i>' : '';
	$number_sign_out = ($number_sign!='') ? '<span class="tcvpb_stats_number_sign" style="color:'.esc_attr($number_sign_color).';">'.esc_html($number_sign).'</span>' : '';

	return '
		<div '.esc_attr($id_out).' class="tcvpb_stats_excerpt '.esc_attr($class).' '.$animation_classes.'" style="color:'.esc_attr($background_color).';" '.$animation_out.'>
			'.$icon_out.'
			<span class="tcvpb_stats_number" data-number="'.esc_attr($number).'" data-duration="'.esc_attr($duration).'" style="color:'.esc_attr($number_color).';" data-trigger_pt="'.esc_attr($trigger_pt).'"></span>
			'.$number_sign_out.'
			<p style="color:'.esc_attr($description_color).';">'.do_shortcode($description).'</p>
		</div>';
}


