<?php

/*********** Shortcode: Text Box ************************************************************/

$tcvpb_elements['text_tc'] = array(
	'name' => esc_html__('Text Box', 'ABdev_aeron' ),
	'description' => esc_html__('You can place any HTML content in this box and animate it.', 'ABdev_aeron' ),
	'type' => 'block',
	'icon' => 'pi-text',
	'category' => esc_html__('Content', 'ABdev_aeron' ),
	'attributes' => array(
		'dummy' => array(
			'type' => 'hidden'
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
		'members' => array(
			'description' => esc_html__( 'Hide Content Only to Members', 'ABdev_aeron' ),
			'default' => '0',
			'type' => 'checkbox',
			'tab' => esc_html__('Hide', 'ABdev_aeron'),
		),
		'non_members' => array(
			'description' => esc_html__( 'Hide Content Only to Non Members', 'ABdev_aeron' ),
			'default' => '0',
			'type' => 'checkbox',
			'tab' => esc_html__('Hide', 'ABdev_aeron'),
		),
		'desktop' => array(
			'description' => esc_html__( 'Hide on Desktop', 'ABdev_aeron' ),
			'default' => '0',
			'type' => 'checkbox',
			'tab' => esc_html__('Hide', 'ABdev_aeron'),
		),
		'tablet' => array(
			'description' => esc_html__( 'Hide on Tablet', 'ABdev_aeron' ),
			'default' => '0',
			'type' => 'checkbox',
			'tab' => esc_html__('Hide', 'ABdev_aeron'),
		),
		'phablet' => array(
			'description' => esc_html__( 'Hide on Phablet', 'ABdev_aeron' ),
			'default' => '0',
			'type' => 'checkbox',
			'tab' => esc_html__('Hide', 'ABdev_aeron'),
		),
		'phone' => array(
			'description' => esc_html__( 'Hide on Phone', 'ABdev_aeron' ),
			'default' => '0',
			'type' => 'checkbox',
			'tab' => esc_html__('Hide', 'ABdev_aeron'),
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
		'description' => esc_html__('Content', 'ABdev_aeron'),
	)
);
function tcvpb_text_tc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(tcvpb_extract_attributes('text_tc'), $attributes));

	$classes=array();

	$animation_classes='';
	$animation_out='';
	if($animation!=''){
		$animation_classes = 'tcvpb-animo '.esc_attr($animation).'';
		$animation_out = ' data-trigger_pt="'.esc_attr($trigger_pt).'" data-duration="'.esc_attr($duration).'" data-delay="'.esc_attr($delay).'"';
	}

	if($class!=''){
		$classes[] = $class;
	}

	if($desktop==1){
		$classes[] = 'hidden-desktop';
	}

	if($tablet==1){
		$classes[] = 'hidden-tablet';
	}

	if($phablet==1){
		$classes[] = 'hidden-phablet';
	}

	if($phone==1){
		$classes[] = 'hidden-phone';
	}

	$classes = implode(' ', $classes);

	$id_out = ($id!='') ? 'id='.$id.'' : '';

	if ( ($members==1 && is_user_logged_in() && !is_null( $content ) && !is_feed()) || ($non_members==1 && !is_user_logged_in() && !is_null( $content ) && !is_feed()) ){
		return '';
	}
	else{
		return '<div '.esc_attr($id_out).' class="'.esc_attr($classes).' '.$animation_classes.'" '.$animation_out.'>'.do_shortcode($content).'</div>';
	}

}
