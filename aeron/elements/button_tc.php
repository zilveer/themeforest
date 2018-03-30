<?php

/*********** Shortcode: Buttons ************************************************************/

$tcvpb_elements['button_tc'] = array(
	'name' => esc_html__('Button', 'ABdev_aeron' ),
	'type' => 'block',
	'icon' => 'pi-button',
	'category' => esc_html__('Navigation', 'ABdev_aeron' ),
	'attributes' => array(
		'text' => array(
			'description' => esc_html__( 'Button Text', 'ABdev_aeron' ),
			'default' => esc_html__( 'Click Here', 'ABdev_aeron' ),
		),
		'icon' => array(
			'description' => esc_html__('Icon', 'ABdev_aeron'),
			'info' => esc_html__('Optional icon after button text', 'ABdev_aeron'),
			'type' => 'icon',
		),
		'url' => array(
			'description' => esc_html__( 'URL', 'ABdev_aeron' ),
			'type' => 'url',
		),
		'target' => array(
			'description' => esc_html__( 'Target', 'ABdev_aeron' ),
			'default' => '_self',
			'type' => 'select',
			'values' => array(
				'_self' =>  esc_html__( 'Self', 'ABdev_aeron' ),
				'_blank' => esc_html__( 'Blank', 'ABdev_aeron' ),
			),
			'divider' => 'true',
		),
		'style' => array(
			'description' => esc_html__( 'Style', 'ABdev_aeron' ),
			'default' => 'ghost',
			'type' => 'select',
			'values' => array(
				'regular' =>  esc_html__( 'Regular', 'ABdev_aeron' ),
				'stroke' =>  esc_html__( 'Stroke', 'ABdev_aeron' ),
				'striped' =>  esc_html__( 'Striped', 'ABdev_aeron' ),
			),
		),
		'color' => array(
			'description' => esc_html__( 'Color', 'ABdev_aeron' ),
			'default' => 'dark',
			'type' => 'select',
			'values' => array(
				'main' =>  esc_html__( 'Main', 'ABdev_aeron' ),
				'light' =>  esc_html__( 'Light', 'ABdev_aeron' ),
				'accent' =>  esc_html__( 'Accent', 'ABdev_aeron' ),
				'dark' =>  esc_html__( 'Dark', 'ABdev_aeron' ),
				'white' =>  esc_html__( 'White', 'ABdev_aeron' ),
				'green' =>  esc_html__( 'Green', 'ABdev_aeron' ),
				'orange' =>  esc_html__( 'Orange', 'ABdev_aeron' ),
				'red' =>  esc_html__( 'Red', 'ABdev_aeron' ),
			),
		),
		'size' => array(
			'description' => esc_html__( 'Size', 'ABdev_aeron' ),
			'info' => esc_html__( 'Small and Full Width Sizes do not affect Stripped Style', 'ABdev_aeron' ),
			'default' => 'normal',
			'type' => 'select',
			'values' => array(
				'small' =>  esc_html__( 'Small', 'ABdev_aeron' ),
				'normal' => esc_html__( 'Normal', 'ABdev_aeron' ),
				'fullwidth' => esc_html__( 'Fullwidth', 'ABdev_aeron' ),
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

function tcvpb_button_tc_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( tcvpb_extract_attributes('button_tc'), $atts ) );
	$id_out = ($id!='') ? 'id='.$id.'' : '';

	$animation_classes='';
	$animation_out='';
	if($animation!=''){
		$animation_classes = 'tcvpb-animo '.esc_attr($animation).'';
		$animation_out = ' data-trigger_pt="'.esc_attr($trigger_pt).'" data-duration="'.esc_attr($duration).'" data-delay="'.esc_attr($delay).'"';
	}

	$class_out = 'tcvpb-button';
	$class_out .= ' tcvpb-button_'.$style;
	$class_out .= ' tcvpb-button_'.$size;
	$class_out .= ' tcvpb-button_'.$color;
	$class_out .= ' '.$class;

	$url = ($url!='') ? ''.$url.'' : '#';
	$icon_out = ($icon!='') ? '<i class="'.esc_attr($icon).'"></i>' : '';

	return '<div class="tcvpb-button-wrapper"><a '.esc_attr($id_out).' href="'.esc_url($url).'" class="'.esc_attr($class_out).' '.$animation_classes.'" target="'.esc_attr($target).'" '.$animation_out.'>' . esc_html($text) . $icon_out . '</a></div>';
}


