<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
$file = basename(__FILE__, '.php');

$row_params[] = array(
	'type' => 'gradient',
	'class' => '',
	'heading' => __('Gradient Type', 'dfd'),						
	'param_name' => 'dfd_bg_grad',
	'dependency' => array('element' => 'dfd_bg_style','value' => array($file)),
	'group' => esc_attr__('Background options', 'dfd')
);
$row_params[] = array(
	'type' => 'ult_switch',
	'class' => '',
	'heading' => __('Enable gradient animation', 'dfd'),						
	'param_name' => 'dfd_bg_grad_animate',
	'value' => 'off',
	'options'    => array(
		'on' => array(
			'label' => esc_html__( 'Enable gradient animation', 'dfd' ),
			'on'    => esc_html__( 'Yes', 'dfd' ),
			'off'   => esc_html__( 'No', 'dfd' ),
		),
	),
	'dependency' => array('element' => 'dfd_bg_style','value' => array($file)),
	'group' => esc_attr__('Background options', 'dfd')
);
$row_params[] = array(
	'type'       => 'number',
	'heading'    => esc_html__( 'Animation duration', 'dfd' ),
	'param_name' => 'dfd_bg_grad_anim_duration',
	'value'      => '3000',
	'min'        => '100',
	'max'        => '10000',
	'step'       => '100',
	'suffix'     => 'ms',
	'dependency' => array('element' => 'dfd_bg_grad_animate','value' => array('on')),
	'group' => esc_attr__('Background options', 'dfd')
);
