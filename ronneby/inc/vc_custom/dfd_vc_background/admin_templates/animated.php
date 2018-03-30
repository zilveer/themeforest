<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
$file = basename(__FILE__, '.php');

$row_params[] = array(
	'type'        => 'param_group',
	'heading'     => esc_html__( 'Color values', 'dfd' ),
	'param_name'  => 'dfd_bg_colors',
	'params'      => array(
		array(
			'type'             => 'colorpicker',
			'heading'          => __( 'Color', 'dfd' ),
			'param_name'       => 'dfd_bg_single_color',
			'admin_label'      => true,
		),
	),
	'dependency' => array('element' => 'dfd_bg_style','value' => array($file)),
	'group' => esc_attr__('Background options', 'dfd')
);
$row_params[] = array(
	'type'       => 'number',
	'heading'    => esc_html__( 'Animation duration', 'dfd' ),
	'param_name' => 'dfd_anim_bg_duration',
	'value'      => '3000',
	'min'        => '100',
	'max'        => '10000',
	'step'       => '100',
	'suffix'     => 'ms',
	'dependency' => array('element' => 'dfd_bg_style','value' => array($file)),
	'group' => esc_attr__('Background options', 'dfd')
);