<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
$file = basename(__FILE__, '.php');

$row_params[] = array(
	'type' => 'dropdown',
	'class' => '',
	'admin_label' => true,
	'heading' => esc_html__('Background Style', 'dfd'),
	'param_name' => 'dfd_canvas_style',
	'value' => array(
		esc_attr__('Style 1','dfd') => 'style_1',
		esc_attr__('Style 2','dfd') => 'style_2',
		esc_attr__('Style 3','dfd') => 'style_3',
		//esc_attr__('Style 4','dfd') => 'style_4',
	),
	'description' => __('', 'dfd'),
	'dependency' => array('element' => 'dfd_bg_style','value' => array($file)),
	'group' => esc_attr__('Background options', 'dfd')
);
$row_params[] = array(
	'type' => 'dropdown',
	'class' => '',
	'admin_label' => true,
	'heading' => __('Apply animation size to:', 'dfd'),
	'param_name' => 'dfd_canvas_size',
	'value' => array(
		__('Row size','dfd') => 'parent',
		__('Window size','dfd') => 'window',
	),
	'description' => __('', 'dfd'),
	'dependency' => array('element' => 'dfd_bg_style','value' => array($file)),
	'group' => esc_attr__('Background options', 'dfd')
);
$row_params[] = array(
	'type' => 'colorpicker',
	'class' => '',
	'heading' => __('Background Color', 'dfd'),						
	'param_name' => 'dfd_bg_color_value',
	'dependency' => array('element' => 'dfd_bg_style','value' => array($file)),
	'group' => esc_attr__('Background options', 'dfd')
);
$row_params[] = array(
	'type' => 'colorpicker',
	'class' => '',
	'heading' => __('Animated lines color', 'dfd'),						
	'param_name' => 'dfd_canvas_color',
	'dependency' => array('element' => 'dfd_canvas_style','value' => array('style_2', 'style_4')),
	'group' => esc_attr__('Background options', 'dfd')
);
$row_params[] = array(
	'type' => 'attach_image',
	'class' => '',
	'heading' => __('Background Image', 'dfd'),
	'param_name' => 'dfd_bg_image_canvas',
	'value' => '',
	'description' => __('Upload or select background image from media gallery.', 'dfd'),
	'dependency' => array('element' => 'dfd_bg_style','value' => array($file)),
	'group' => esc_attr__('Background options', 'dfd')
);
$row_params[] = array(
	'type' => 'dropdown',
	'class' => '',
	'heading' => __('Background Image Repeat', 'dfd'),
	'param_name' => 'dfd_bg_image_repeat_canvas',
	'value' => array(
			__('Repeat', 'dfd') => 'repeat',
			__('Repeat X', 'dfd') => 'repeat-x',
			__('Repeat Y', 'dfd') => 'repeat-y',
			__('No Repeat', 'dfd') => 'no-repeat',
		),
	'description' => __('Options to control repeatation of the background image. Learn on <a href="http://www.w3schools.com/cssref/playit.asp?filename=playcss_background-repeat" target="_blank">W3School</a>', 'dfd'),
	'dependency' => array('element' => 'dfd_bg_style','value' => array($file)),
	'group' => esc_attr__('Background options', 'dfd')
);
$row_params[] = array(
	'type' => 'dropdown',
	'class' => '',
	'heading' => __('Background Image Size', 'dfd'),
	'param_name' => 'dfd_bg_image_size_canvas',
	'value' => array(
			__('Cover - Image to be as large as possible', 'dfd') => 'cover',
			__('Contain - Image will try to fit inside the container area', 'dfd') => 'contain',
			__('Initial', 'dfd') => 'initial',
			/*__('Automatic', 'dfd') => 'automatic', */
		),
	'description' => __('Options to control size of the background image. Learn on <a href="http://www.w3schools.com/cssref/playit.asp?filename=playcss_background-size&preval=50%25" target="_blank">W3School</a>', 'dfd'),
	'dependency' => array('element' => 'dfd_bg_style','value' => array($file)),
	'group' => esc_attr__('Background options', 'dfd')
);