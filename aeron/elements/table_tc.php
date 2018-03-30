<?php

/*********** Shortcode: Table ************************************************************/

$tcvpb_elements['table_tc'] = array(
	'name' => esc_html__('Table', 'ABdev_aeron' ),
	'type' => 'block',
	'icon' => 'pi-table',
	'category' =>  esc_html__('Content', 'ABdev_aeron'),
	'attributes' => array(
		'dummy' => array(
			'type' => 'hidden',
		),
		'alternative_style' => array(
			'default' => '0',
			'description' => esc_html__('Alternative Styling', 'ABdev_aeron'),
			'type' => 'checkbox',
			'tab' => esc_html__('Style', 'ABdev_aeron'),
		),
		'hover' => array(
			'default' => '0',
			'description' => esc_html__('Rows with Hover', 'ABdev_aeron'),
			'type' => 'checkbox',
			'tab' => esc_html__('Style', 'ABdev_aeron'),
		),
		'striped' => array(
			'default' => '0',
			'description' => esc_html__('Striped Rows', 'ABdev_aeron'),
			'type' => 'checkbox',
			'tab' => esc_html__('Style', 'ABdev_aeron'),
		),
		'condensed' => array(
			'default' => '0',
			'description' => esc_html__('Condensed Table', 'ABdev_aeron'),
			'type' => 'checkbox',
			'tab' => esc_html__('Style', 'ABdev_aeron'),
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
	),
	'content' => array(
		'default' => 'HTML table source here',
		'description' => esc_html__('Content', 'ABdev_aeron'),
	)
);
function tcvpb_table_tc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(tcvpb_extract_attributes('table_tc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';

	$animation_classes='';
	$animation_out='';
	if($animation!=''){
		$animation_classes = 'tcvpb-animo '.esc_attr($animation).'';
		$animation_out = ' data-trigger_pt="'.esc_attr($trigger_pt).'" data-duration="'.esc_attr($duration).'" data-delay="'.esc_attr($delay).'"';
	}

	$classes[] = 'tcvpb-table';

	if($alternative_style==1){
		$classes[] = 'tcvpb-table-alternative';
	}
	if($hover==1){
		$classes[] = 'tcvpb-table-hover';
	}
	if($striped==1){
		$classes[] = 'tcvpb-table-striped';
	}
	if($condensed==1){
		$classes[] = 'tcvpb-table-condensed';
	}
	$classes = implode(' ', $classes).' '.$class;

	return '<div '.esc_attr($id_out).' class="'.esc_attr($classes).' '.$animation_classes.'" '.$animation_out.'>'.do_shortcode($content).'</div>';
}


