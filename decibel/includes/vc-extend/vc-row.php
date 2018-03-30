<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Row
vc_add_param( 'vc_row', array(
	'type' => 'dropdown',
	'class' => '',
	'show_settings_on_create' => true,
	'heading' => __( 'Content type', 'wolf' ),
	'param_name' => 'content_type',
	'value' => array(
		sprintf( __( 'Standard width (%s centered)', 'wolf' ), '1140px' ) => 'standard',
		sprintf( __( 'Small width (%s centered)', 'wolf' ), '750px' ) => 'small',
		sprintf( __( 'Large width (%s centered)', 'wolf' ), '98%' ) => 'large',
		sprintf( __( 'Full width (%s)', 'wolf' ), '100%' ) => 'full',
	)
) );

vc_add_param( 'vc_row', array(
	'type' => 'textfield',
	'class' => '',
	'heading' => __( 'Anchor', 'wolf' ),
	'param_name' => 'anchor',
	'description' => __( 'example "about"', 'wolf' ),
	'value' => '',
) );

// vc_add_param( 'vc_row', array(
// 	'type' => 'checkbox',
// 	'class' => '',
// 	'show_settings_on_create' => true,
// 	'heading' => '',
// 	'param_name' => 'no_padding',
// 	'value' => array( __( 'No Padding', 'wolf' ) => true ),
// ) );

vc_add_param( 'vc_row', array(
	'type' => 'textfield',
	'class' => '',
	'heading' => __( 'Padding top', 'wolf' ),
	'param_name' => 'padding_top',
	'description' => '',
	'value' => '',
) );

vc_add_param( 'vc_row', array(
	'type' => 'textfield',
	'class' => '',
	'heading' => __( 'Padding bottom', 'wolf' ),
	'param_name' => 'padding_bottom',
	'description' => '',
	'value' => '',
) );


vc_add_param( 'vc_row', array(
	'type' => 'dropdown',
	'class' => '',
	'show_settings_on_create' => true,
	'heading' => __( 'Skin', 'wolf' ),
	'param_name' => 'font_type',
	'value' => array(
		__( 'Light', 'wolf' ) => 'dark',
		__( 'Dark', 'wolf' ) => 'light',
	),
) );

vc_add_param( 'vc_row', array(
	'type' => 'checkbox',
	'class' => '',
	'show_settings_on_create' => true,
	'heading' => '',
	'param_name' => 'full_screen',
	'value' => array( __( 'Full screen', 'wolf' ) => true ),
) );

vc_add_param( 'vc_row', array(
	'type' => 'dropdown',
	'class' => '',
	'show_settings_on_create' => true,
	'heading' => __( 'Background type', 'wolf' ),
	'param_name' => 'background_type',
	'value' => array(
		__( 'Image', 'wolf' ) => 'image',
		__( 'Video', 'wolf' ) => 'video',
	),
) );

vc_add_param( 'vc_row', array(
	'type' => 'colorpicker',
	'class' => '',
	'show_settings_on_create' => true,
	'heading' => __( 'Background color', 'wolf' ),
	'param_name' => 'background_color',
	'value' => '',
) );

vc_add_param( 'vc_row', array(
	'type' => 'single_image',
	'class' => '',
	'show_settings_on_create' => true,
	'heading' => __( 'Background image', 'wolf' ),
	'param_name' => 'background_image',
	'value' => '',
	'dependency' => array( 'element' => 'background_type', 'value' => array( 'image' ) ),
) );

vc_add_param( 'vc_row', array(
	'type' => 'dropdown',
	'class' => '',
	'show_settings_on_create' => true,
	'heading' => __( 'Background position', 'wolf' ),
	'param_name' => 'background_position',
	'value' => array(
		__( 'center center', 'wolf' ) => 'center center',
		__( 'center top', 'wolf' )  => 'center top',
		__( 'left top', 'wolf' ) => 'left top',
		__( 'right top', 'wolf' )  => 'right top',
		__( 'center bottom', 'wolf' )  => 'center bottom',
		__( 'left bottom', 'wolf' )  => 'left bottom',
		__( 'right bottom', 'wolf' ) => 'right bottom',
		__( 'left center', 'wolf' ) => 'left center',
		__( 'right center', 'wolf' ) => 'right center',
	),
	'dependency' => array( 'element' => 'background_type', 'value' => array( 'image' ) ),
) );

vc_add_param( 'vc_row', array(
	'type' => 'dropdown',
	'class' => '',
	'show_settings_on_create' => true,
	'heading' => __( 'Background repeat', 'wolf' ),
	'param_name' => 'background_repeat',
	'value' => array(
		__( 'no repeat', 'wolf' ) => 'no-repeat',
		__( 'repeat', 'wolf' ) => 'repeat',
		__( 'repeat-x', 'wolf' ) => 'repeat-x',
		__( 'repeat-y', 'wolf' ) => 'repeat-y',
	),
	'dependency' => array( 'element' => 'background_type', 'value' => array( 'image' ) ),
) );

// vc_add_param( 'vc_row', array(
// 	'type' => 'dropdown',
// 	'class' => '',
// 	'show_settings_on_create' => true,
// 	'heading' => __( 'Background Attachment', 'wolf' ),
// 	'param_name' => 'background_attachment',
// 	'value' => array(
// 		__( 'scroll', 'wolf' ) => 'scroll',
// 		__( 'fixed', 'wolf' ) => 'fixed',
// 	),
// 	'dependency' => array( 'element' => 'background_type', 'value' => array( 'image' ) ),
// ) );

vc_add_param( 'vc_row', array(
	'type' => 'dropdown',
	'class' => '',
	'show_settings_on_create' => true,
	'heading' => __( 'Background size', 'wolf' ),
	'param_name' => 'background_size',
	'value' => array(
		__( 'cover', 'wolf' ) => 'cover',
		__( 'default', 'wolf' ) => 'default',
		__( 'resize', 'wolf' ) => 'resize',
	),
	'dependency' => array( 'element' => 'background_type', 'value' => array( 'image' ) ),
) );

vc_add_param( 'vc_row', array(
	'type' => 'checkbox',
	'class' => '',
	'show_settings_on_create' => true,
	'heading' => '',
	'param_name' => 'parallax',
	'dependency' => array( 'element' => 'background_type', 'value' => array( 'image' ) ),
	'value' => array( 'Parallax' => true ),
) );

vc_add_param( 'vc_row', array(
	'type' => 'dropdown',
	'class' => '',
	'show_settings_on_create' => true,
	'heading' => __( 'Video Background type', 'wolf' ),
	'param_name' => 'video_bg_type',
	'value' => array(
		'Youtube' => 'youtube',
		__( 'Self hosted', 'wolf' ) => 'selfhosted',
	),
	'dependency' => array( 'element' => 'background_type', 'value' => array( 'video' ) ),
) );

vc_add_param( 'vc_row', array(
	'type' => 'textfield',
	'class' => '',
	'heading' => __( 'Youtube URL', 'wolf' ),
	'param_name' => 'video_bg_youtube_url',
	'description' => '',
	'value' => '',
	'dependency' => array( 
		'element' => 'background_type', 
		'value' => array( 'video' ) 
	),
) );


vc_add_param( 'vc_row', array(
	'type' => 'single_file',
	'class' => '',
	'heading' => __( 'Video background mp4', 'wolf' ),
	'param_name' => 'video_bg_mp4',
	'description' => '',
	'value' => '',
	'dependency' => array( 
		'element' => 'background_type', 
		'value' => array( 'video' ) 
	),
) );

vc_add_param( 'vc_row', array(
	'type' => 'single_file',
	'class' => '',
	'heading' => __( 'Video background webm', 'wolf' ),
	'param_name' => 'video_bg_webm',
	'description' => '',
	'value' => '',
	'dependency' => array( 'element' => 'background_type', 'value' => array( 'video' ) ),
) );

vc_add_param( 'vc_row', array(
	'type' => 'single_file',
	'class' => '',
	'heading' => __( 'Video background ogv/ogg', 'wolf' ),
	'param_name' => 'video_bg_ogv',
	'description' => '',
	'value' => '',
	'dependency' => array( 'element' => 'background_type', 'value' => array( 'video' ) ),
) );

vc_add_param( 'vc_row', array(
	'type' => 'single_image',
	'class' => '',
	'heading' => __( 'Video Image Fallback', 'wolf' ),
	'param_name' => 'video_bg_img',
	'description' => '',
	'value' => '',
	'dependency' => array( 
		'element' => 'background_type', 
		'value' => array( 'video' ) 
	),
) );

vc_add_param( 'vc_row', array(
	'type' => 'dropdown',
	'class' => '',
	'show_settings_on_create' => true,
	'heading' => __( 'Add overlay', 'wolf' ),
	'param_name' => 'overlay',
	'value' => array(
		__( 'No', 'wolf' ) => '',
		__( 'Yes', 'wolf' ) => 'yes',
	),
) );

vc_add_param( 'vc_row', array(
	'type' => 'colorpicker',
	'class' => '',
	'show_settings_on_create' => true,
	'heading' => __( 'Overlay color', 'wolf' ),
	'param_name' => 'overlay_color',
	'value' => '#000000',
	'dependency' => array( 'element' => 'overlay', 'value' => array( 'yes' ) ),
) );

vc_add_param( 'vc_row', array(
	'type' => 'single_image',
	'class' => '',
	'show_settings_on_create' => true,
	'heading' => __( 'Overlay pattern', 'wolf' ),
	'param_name' => 'overlay_image',
	'value' => '',
	'dependency' => array( 'element' => 'overlay', 'value' => array( 'yes' ) ),
) );

vc_add_param( 'vc_row', array(
	'type' => 'textfield',
	'class' => '',
	'heading' => __( 'Overlay opacity in percent', 'wolf' ),
	'param_name' => 'overlay_opacity',
	'description' => '',
	'value' => 40,
	'dependency' => array( 'element' => 'overlay', 'value' => array( 'yes' ) ),
) );

vc_add_param( 'vc_row', array(
	'type' => 'dropdown',
	'class' => '',
	'show_settings_on_create' => true,
	'heading' => __( 'Visibility for devices', 'wolf' ),
	'param_name' => 'hide_class',
	'value' => array(
		__( 'Always visible', 'wolf' ) => '',
		__( 'Hide on tablet and mobile', 'wolf' ) => 'hide-tablet',
		__( 'Hide on mobile', 'wolf' ) => 'hide-mobile',
		__( 'Show on tablet and mobile only', 'wolf' ) => 'show-tablet',
		__( 'Show on mobile only', 'wolf' ) => 'show-mobile',
	),
) );

// vc_add_param( 'vc_row', array(
// 	'type' => 'textfield',
// 	'class' => '',
// 	'heading' => __( 'Inline style', 'wolf' ),
// 	'param_name' => 'inline_style',
// 	'description' => '',
// 	'value' => '',
// ) );
