<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
$file = basename(__FILE__, '.php');

$row_params[] = array(
	'type' => 'dropdown',
	'class' => '',
	'heading' => __('Parallax Style','dfd'),
	'param_name' => 'dfd_parallax_style',
	'value' => array(
		__('Simple Background Image','dfd') => 'dfd_simple_image',
		__('Auto Moving Background','dfd') => 'dfd_animated_bg',
		__('Vertical Parallax On Scroll','dfd') => 'dfd_vertical_parallax',
		__('Horizontal Parallax On Scroll','dfd') => 'dfd_horizontal_parallax',
		__('Interactive Parallax On Mouse Move','dfd') => 'dfd_mousemove_parallax',
		__('Multilayer Vertical Parallax','dfd') => 'dfd_multi_parallax',
	), 
	'description' => __('Select the kind of style you like for the background.','dfd'),
	'dependency' => array('element' => 'dfd_bg_style','value' => array($file)),
	'group' => esc_attr__('Background options', 'dfd')
);
$row_params[] = array(
	'type' => 'attach_image',
	'class' => '',
	'heading' => __('Background Image', 'dfd'),
	'param_name' => 'dfd_bg_image_new',
	'value' => '',
	'description' => __('Upload or select background image from media gallery.', 'dfd'),
	'dependency' => array('element' => 'dfd_parallax_style','value' => array('dfd_simple_image','dfd_animated_bg','dfd_vertical_parallax','dfd_horizontal_parallax',)),
	'group' => esc_attr__('Background options', 'dfd')
);
$row_params[] = array(
	'type' => 'attach_images',
	'class' => '',
	'heading' => __('Layer Images', 'dfd'),
	'param_name' => 'dfd_layer_image',
	'value' => '',
	'description' => __('Upload or select background images from media gallery.', 'dfd'),
	'dependency' => array('element' => 'dfd_parallax_style','value' => array('dfd_mousemove_parallax','dfd_multi_parallax')),
	'group' => esc_attr__('Background options', 'dfd')
);
$row_params[] = array(
	'type' => 'dropdown',
	'class' => '',
	'heading' => __('Parallax Direction', 'dfd'),
	'param_name' => 'dfd_multi_parallax_direction',
	'value' => array(
			__('Vertical', 'dfd') => 'vertical',
			__('Horizontal', 'dfd') => 'horizontal',

		),
	'dependency' => Array('element' => 'dfd_parallax_style','value' => array('dfd_multi_parallax')),
	'group' => esc_attr__('Background options', 'dfd')
);
$row_params[] = array(
	'type' => 'dropdown',
	'class' => '',
	'heading' => __('Background Image Repeat', 'dfd'),
	'param_name' => 'dfd_bg_image_repeat',
	'value' => array(
			__('Repeat', 'dfd') => 'repeat',
			__('Repeat X', 'dfd') => 'repeat-x',
			__('Repeat Y', 'dfd') => 'repeat-y',
			__('No Repeat', 'dfd') => 'no-repeat',
		),
	'description' => __('Options to control repeatation of the background image. Learn on <a href="http://www.w3schools.com/cssref/playit.asp?filename=playcss_background-repeat" target="_blank">W3School</a>', 'dfd'),
	'dependency' => Array('element' => 'dfd_parallax_style','value' => array('dfd_simple_image','dfd_vertical_parallax','dfd_horizontal_parallax')),
	'group' => esc_attr__('Background options', 'dfd')
);
$row_params[] = array(
	'type' => 'dropdown',
	'class' => '',
	'heading' => __('Background Image Size', 'dfd'),
	'param_name' => 'dfd_bg_image_size',
	'value' => array(
			__('Cover - Image to be as large as possible', 'dfd') => 'cover',
			__('Contain - Image will try to fit inside the container area', 'dfd') => 'contain',
			__('Initial', 'dfd') => 'initial',
			/*__('Automatic', 'dfd') => 'automatic', */
		),
	'description' => __('Options to control size of the background image. Learn on <a href="http://www.w3schools.com/cssref/playit.asp?filename=playcss_background-size&preval=50%25" target="_blank">W3School</a>', 'dfd'),
	'dependency' => Array('element' => 'dfd_parallax_style','value' => array('dfd_simple_image','dfd_animated_bg','dfd_vertical_parallax','dfd_horizontal_parallax')),
	'group' => esc_attr__('Background options', 'dfd')
);
$row_params[] = array(
	'type' => 'colorpicker',
	'heading' => __('Background color', 'dfd'),
	'param_name' => 'dfd_image_bg_color',
	'value' => '',
	'group' => esc_attr__('Background options', 'dfd'),
	'dependency' => array('element' => 'dfd_bg_style','value' => array($file)),
	'description' => __('Select RGBA values or opacity will be set to 20% by default.','dfd')
);
$row_params[] = array(
	'type' => 'dropdown',
	'class' => '',
	'heading' => __('Scroll Effect', 'dfd'),
	'param_name' => 'dfd_bg_img_attach',
	'value' => array(
			__('Move with the content', 'dfd') => 'scroll',
			__('Fixed at its position', 'dfd') => 'fixed',								
		),
	'description' => __('Options to set whether a background image is fixed or scroll with the rest of the page.', 'dfd'),
	'dependency' => Array('element' => 'dfd_parallax_style','value' => array('dfd_simple_image','dfd_animated_bg','dfd_horizontal_parallax','dfd_vertical_parallax')),
	'group' => esc_attr__('Background options', 'dfd')
);
$row_params[] = array(
	'type' => 'number',
	'class' => '',
	'heading' => __('Parallax Speed', 'dfd'),
	'param_name' => 'dfd_parallax_sense',
	'value' =>'30',
	'min'=>'1',
	'max'=>'100',
	'description' => __('Control speed of parallax. Enter value between 1 to 100', 'dfd'),
	'dependency' => Array('element' => 'dfd_parallax_style','value' => array('dfd_animated_bg', 'dfd_vertical_parallax','dfd_horizontal_parallax','dfd_mousemove_parallax','dfd_multi_parallax')),
	'group' => esc_attr__('Background options', 'dfd')
);
$row_params[] = array(
	'type' => 'number',
	'class' => '',
	'heading' => __('Parallax Offset', 'dfd'),
	'param_name' => 'dfd_parallax_offset',
	'value' =>'',
	'min'=>'-500',
	'max'=>'500',
	'description' => __('Parallax start offset value. Enter value between -500 to 500', 'dfd'),
	'dependency' => Array('element' => 'dfd_parallax_style','value' => array('dfd_vertical_parallax')),
	'group' => esc_attr__('Background options', 'dfd')
);
$row_params[] = array(
	'type' => 'textfield',
	'class' => '',
	'heading' => __('Background Image Posiiton', 'dfd'),
	'param_name' => 'dfd_bg_image_position',
	'value' =>'',	
	'description' => __('You can use any number with px, em, %, etc. Example- 100px 100px.', 'dfd'),
	'dependency' => Array('element' => 'dfd_parallax_style','value' => array('dfd_simple_image')),
	'group' => esc_attr__('Background options', 'dfd')
);
$row_params[] = array(
	'type' => 'dropdown',
	'class' => '',
	'heading' => __('Animation Direction', 'dfd'),
	'param_name' => 'dfd_animation_direction',
	'value' => array(
			__('None', 'dfd') => '',
			__('Left to Right', 'dfd') => 'right',
			__('Right to Left', 'dfd') => 'left',
			__('Top to Bottom', 'dfd') => 'bottom',
			__('Bottom to Top', 'dfd') => 'top',

		),
	'dependency' => Array('element' => 'dfd_parallax_style','value' => array('dfd_animated_bg')),
	'group' => esc_attr__('Background options', 'dfd')
);
$row_params[] = array(
	'type' => 'ult_switch',
	'heading' => __('Enable on Mobile devices', 'dfd'),
	'param_name' => 'dfd_mobile_enable',
	//'value' => array(esc_attr__('Yes, please','dfd') => 'yes'),
	'value' => 'yes',
	'options' => array(
		'yes' => array(
				'label' => esc_html__('Yes, please','dfd'),
				'on' => 'Yes',
				'off' => 'No',
			),
		),
	'dependency' => array('element' => 'dfd_bg_style','value' => array($file)),
	'group' => esc_attr__('Background options', 'dfd'),
);