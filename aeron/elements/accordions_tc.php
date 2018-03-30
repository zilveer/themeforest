<?php

/*********** Shortcode: Accordions ************************************************************/

$tcvpb_elements['accordions_tc'] = array(
	'name' => esc_html__('Accordion', 'ABdev_aeron' ),
	'type' => 'block',
	'icon' => 'pi-accordion',
	'category' => esc_html__('Content', 'ABdev_aeron' ),
	'child' => 'accordion_tc',
	'child_button' => esc_html__('New Accordion', 'ABdev_aeron'),
	'child_title' => esc_html__('Accordion Section', 'ABdev_aeron'),
	'attributes' => array(
		'expanded' => array(
			'description' => esc_html__('Expanded accordion no.', 'ABdev_aeron'),
			'info' => esc_html__('Which accordion section will be expanded on load, 0 for none', 'ABdev_aeron'),
			'default' => '1',
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
);
function tcvpb_accordions_tc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(tcvpb_extract_attributes('accordions_tc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';

	$animation_classes='';
	$animation_out='';
	if($animation!=''){
		$animation_classes = 'tcvpb-animo '.esc_attr($animation).'';
		$animation_out = ' data-trigger_pt="'.esc_attr($trigger_pt).'" data-duration="'.esc_attr($duration).'" data-delay="'.esc_attr($delay).'"';
	}

	return '<div '.esc_attr($id_out).' class="tcvpb-accordion '.esc_attr($class).' '.$animation_classes.'" data-expanded="'.esc_attr($expanded).'" '.$animation_out.'>'.do_shortcode($content).'</div>';
}

$tcvpb_elements['accordion_tc'] = array(
	'name' => esc_html__('Single accordion section', 'ABdev_aeron' ),
	'type' => 'child',
	'attributes' => array(
		'title' => array(
			'description' => esc_html__('Title', 'ABdev_aeron'),
		),
	),
	'content' => array(
		'description' => esc_html__('Content', 'ABdev_aeron'),
	),
);
function tcvpb_accordion_tc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(tcvpb_extract_attributes('accordion_tc'), $attributes));
	$return = '
		<h3>' . esc_html($title) . '</h3>
		<div class="tcvpb-accordion-body">
			' . do_shortcode($content) . '
		</div>';
  
	return $return;
}
