<?php
/**
 * Theme options > Header Advanced Options
 */


$admin_options[] = array (
	'slug'        => 'head_adv_options',
	'parent'      => 'general_options',
	"name"        => __( 'HEADER CUSTOMIZATION OPTIONS', 'zn_framework' ),
	"description" => __( 'These are header advanced options for customisations.', 'zn_framework' ),
	"id"          => "info_title2",
	"type"        => "zn_title",
	"class"       => "zn_full zn-custom-title-large zn-toptabs-margin"
);


$admin_options[] = array (
	'slug'        => 'head_adv_options',
	'parent'      => 'general_options',
	"name"        => __( "Header over Subheader / Slideshow?", 'zn_framework' ),
	"description" => __( "This will basically toggle the header's css position, from 'absolute' to 'relative'. If this option is disabled, the subheader or slideshow will go after the header. Don't foget to style the background of the header.", 'zn_framework' ),
	"id"          => "head_position",
	"std"         => "1",
	"type"        => "zn_radio",
	"options"     => array (
		"1" => __( "Yes", 'zn_framework' ), // Absolute
		"0" => __( "No", 'zn_framework' )   // Relative
	),
	"class"        => "zn_radio--yesno",
);


// ==================================================================
//        STYLE OPTIONS
// ==================================================================

$admin_options[] = array (
				'slug'        => 'head_adv_options',
				'parent'      => 'general_options',
				"name"        => __( 'STYLES OPTIONS', 'zn_framework' ),
				"description" => __( 'These options are dedicated to customizing the header background and text colors.', 'zn_framework' ),
				"id"          => "hd_title1",
				"type"        => "zn_title",
				"class"       => "zn_full zn-custom-title-large zn-top-separator"
);

// HEADER STYLE
$admin_options[] = array (
	'slug'        => 'head_adv_options',
	'parent'      => 'general_options',
	"name"        => __( "Header Style", 'zn_framework' ),
	"description" => __( "Select the desired style for the header", 'zn_framework' ),
	"id"          => "header_style",
	"std"         => "default",
	"type"        => "zn_radio",
	"options"     => array (
		'default'     => __( "Default", 'zn_framework' ),
		'image_color' => __( 'Custom ( Background Image, Color, Font )', 'zn_framework' ),
	)
);

// HEADER IMAGE
$admin_options[] = array (
	'slug'        => 'head_adv_options',
	'parent'      => 'general_options',
	"name"        => __( "Header Background Image", 'zn_framework' ),
	"description" => __( "Please choose your desired image to be used as a background", 'zn_framework' ),
	"id"          => "header_style_image",
	"std"         => '',
	"options"     => array ( "repeat" => true, "position" => true, "attachment" => true ),
	"type"        => "background",
	'dependency'  => array ( 'element' => 'header_style', 'value' => array ( 'image_color' ) ),
);

// HEADER Color
$admin_options[] = array (
	'slug'        => 'head_adv_options',
	'parent'      => 'general_options',
	"name"        => __( "Background Color", 'zn_framework' ),
	"description" => __( "Please choose your desired background color for the header", 'zn_framework' ),
	"id"          => "header_style_color",
	"alpha"       => true,
	"std"         => '#000',
	"type"        => "colorpicker",
	'dependency'  => array ( 'element' => 'header_style', 'value' => array ( 'image_color' ) ),
);

// HEADER TEXT COLOR
$admin_options[] = array (
	'slug'        => 'head_adv_options',
	'parent'      => 'general_options',
	"name"        => __( "Header Text Color", 'zn_framework' ),
	"description" => __( "Please choose a text color scheme. This helps in case you add a dark background and you want light colors, or in case of light background - dark colors for the texts.", 'zn_framework' ),
	"id"          => "header_text_scheme",
	"std"         => 'default',
	"options"     => array (
		"default" => "Header style default",
		"light" => "Light color",
		"gray" => "Grayish colors",
		"dark" => "Darken colors"
	),
	"type"        => "select",
	'dependency'  => array ( 'element' => 'header_style', 'value' => array ( 'image_color' ) )
);


// HEADER TOP BAR STYLE
$admin_options[] = array (
	'slug'        => 'head_adv_options',
	'parent'      => 'general_options',
	"name"        => __( "Header's TOP Bar Style", 'zn_framework' ),
	"description" => __( "Select the desired style for the header's top bar.", 'zn_framework' ),
	"id"          => "topbar_style",
	"std"         => "default",
	"type"        => "zn_radio",
	"class"        => "zn-non-dependent",
	"options"     => array (
		'default'     => __( "Default", 'zn_framework' ),
		'custom' => __( 'Custom Size & Background Color', 'zn_framework' ),
	),
	'dependency'  => array ( 'element' => 'zn_header_layout', 'value' => array ( 'style7', 'style8', 'style9', 'style10', 'style11', 'style12', 'style13' ) ),

);

// HEADER Color
$admin_options[] = array (
	'slug'        => 'head_adv_options',
	'parent'      => 'general_options',
	"name"        => __( "Top Bar Width", 'zn_framework' ),
	"description" => __( "Please choose if you want the Top Bar to be full-width.", 'zn_framework' ),
	"id"          => "topbar_size",
	"std"         => 'default',
	"type"        => "select",
	"options"     => array (
		'default'     => __( "Header style default", 'zn_framework' ),
		'normal' => __( 'Normal', 'zn_framework' ),
		'full' => __( 'Full width', 'zn_framework' ),
	),
	'dependency'  => array (
		array( 'element' => 'topbar_style', 'value' => array ( 'custom' ) ),
		array( 'element' => 'zn_header_layout', 'value' => array ( 'style7', 'style8', 'style9', 'style10', 'style11', 'style12', 'style13' ) )
	),
);

// HEADER Color
$admin_options[] = array (
	'slug'        => 'head_adv_options',
	'parent'      => 'general_options',
	"name"        => __( "Top Bar - Background Color", 'zn_framework' ),
	"description" => __( "Please choose your desired background color for the header's Top Bar", 'zn_framework' ),
	"id"          => "topbar_bg_color",
	"alpha"       => true,
	"std"         => '',
	"type"        => "colorpicker",
	'dependency'  => array (
		array( 'element' => 'topbar_style', 'value' => array ( 'custom' ) ),
		array( 'element' => 'zn_header_layout', 'value' => array ( 'style7', 'style8', 'style9', 'style10', 'style11', 'style12', 'style13' ) )
	),
);

// HEADER TEXT COLOR
$admin_options[] = array (
	'slug'        => 'head_adv_options',
	'parent'      => 'general_options',
	"name"        => __( "Top Bar - Text Color", 'zn_framework' ),
	"description" => __( "Please choose a text color scheme. This helps in case you add a dark background and you want light colors, or in case of light background - dark colors for the texts.", 'zn_framework' ),
	"id"          => "topbar_text_scheme",
	"std"         => 'default',
	"options"     => array (
		"default" => "Header style default",
		"light" => "Light color",
		"gray" => "Grayish colors",
		"dark" => "Darken colors"
	),
	"type"        => "select",
	'dependency'  => array (
		array( 'element' => 'topbar_style', 'value' => array ( 'custom' ) ),
		array( 'element' => 'zn_header_layout', 'value' => array ( 'style7', 'style8', 'style9', 'style10', 'style11', 'style12', 'style13' ) )
	),
);

$admin_options[] = array (
	'slug'        => 'head_adv_options',
	'parent'      => 'general_options',
	"name"        => __( "Header Font", 'zn_framework' ),
	"description" => __( "Override the default font of the header.", 'zn_framework' ),
	"id"          => "topbar_font",
	"std"         => '',
	'supports'   => array( 'font' ),
	// 'supports'   => array( 'size', 'font', 'style', 'line', 'weight' ),
	"type"        => "font",
	'dependency'  => array (
		array( 'element' => 'topbar_style', 'value' => array ( 'custom' ) ),
		array( 'element' => 'zn_header_layout', 'value' => array ( 'style7', 'style8', 'style9', 'style10', 'style11', 'style12', 'style13' ) )
	),
);


// ==================================================================
//        STYLE OPTIONS
// ==================================================================

$admin_options[] = array (
				'slug'        => 'head_adv_options',
				'parent'      => 'general_options',
				"name"        => __( 'SIZE OPTIONS', 'zn_framework' ),
				"description" => __( 'These options are dedicated to customizing the header sizes.', 'zn_framework' ),
				"id"          => "hd_title1",
				"type"        => "zn_title",
				"class"       => "zn_full zn-custom-title-large zn-top-separator"
);

$admin_options[] = array (
	'slug'        => 'head_adv_options',
	'parent'      => 'general_options',
	'id'          => 'header_width_v2',
	'name'        => __( 'Header Width', 'zn_framework'),
	'description' => __( 'Choose the desired width for the header\'s container. It will be applied on Large breakpoints ( 1200px );', 'zn_framework' ),
	'type'        => 'smart_slider',
	'std'        => array(
		'breakpoints' => 1,
		'lg' => zget_option( 'header_width' , 'general_options', false, '1170' ),
		'unit_lg' => 'px',
		'md' => 100,
		'unit_md' => '%',
		'sm' => 100,
		'unit_sm' => '%',
		'xs' => 100,
		'unit_xs' => '%'
	),
	'supports' => array('breakpoints'),
	'units' => array('px','%'),
	'helpers'     => array(
		'min' => '20',
		'max' => '1900'
	),
);

// Header height
$zn_head_height = zget_option( 'zn_head_height' , 'general_options', false, '' );
$hh_def = empty( $zn_head_height ) ? 'default': 'custom';

$admin_options[] = array (
	'slug'        => 'head_adv_options',
	'parent'      => 'general_options',
	"name"        => __( "Header Height", 'zn_framework' ),
	"description" => __( "You can customize the header's height.", 'zn_framework' ),
	"id"          => "zn_head_height_enb",
	"std"         => $hh_def,
	"type"        => "zn_radio",
	"options"     => array (
		'default'     => __( "Default", 'zn_framework' ),
		'custom' => array(
			'title' => __( 'Custom Height', 'zn_framework' ),
			'tip' => __( 'It will maintain vertical ratio.', 'zn_framework' ),
		),
		'custom_rows' => array(
			'title' => __( 'Custom height per Rows', 'zn_framework' ),
			'tip' => __( 'Advanced options for full customisability.', 'zn_framework' ),
		)
	)
);
// Header height
$admin_options[] = array (
	'slug'        => 'head_adv_options',
	'parent'      => 'general_options',
	"name"        => __( "Header Height (in px)", 'zn_framework' ),
	"description" => __( "Header's height. By default it's 100px. <strong>Leave empty if you're not sure!</strong>", 'zn_framework' ),
	"id"          => "zn_head_height",
	"std"         => "",
	"type"        => "text",
	"placeholder" => "ex: 100px",
	'dependency'  => array ( 'element' => 'zn_head_height_enb', 'value' => array ( 'custom' ) ),
);


$admin_options[] = array (
	'slug'        => 'head_adv_options',
	'parent'      => 'general_options',
	"name"        => __( "Custom height per Rows", 'zn_framework' ),
	"description" => __( "You can customize any row of the header", 'zn_framework' ),
	"id"          => "zn_head_height_rows",
	'dependency'  => array ( 'element' => 'zn_head_height_enb', 'value' => array ( 'custom_rows' ) ),
	"type"        => "group_text",
	'std'  => array(
		'others' => '0',
	),
	"config"     => array (
		'size' => 'zn_span3',
		'options'  => array(
			array(
				'name' => 'TOP ROW',
				'id' => 'top',
				'placeholder' => 'eg: 50px'
			),
			array(
				'name' => 'MAIN ROW',
				'id' => 'main',
				'placeholder' => 'eg: 70px'
			),
			array(
				'name' => 'BOTTOM ROW',
				'id' => 'bottom',
				'placeholder' => 'eg: 50px'
			),
			array(
				'name' => 'OTHERS',
				'id' => 'others',
				'placeholder' => 'eg: 10px',
			),
		)
	),
	// 'class' => 'zn_full'
);


/**
 *************** HELP FIELDS FROM HERE
 */

$admin_options[] = array (
	'slug'        => 'head_adv_options',
	'parent'      => 'general_options',
	"name"        => __( '<span class="dashicons dashicons-editor-help"></span> HELP:', 'zn_framework' ),
	"description" => __( 'Below you can find quick access to documentation, video documentation or our support forum.', 'zn_framework' ),
	"id"          => "ho_title",
	"type"        => "zn_title",
	"class"       => "zn_full zn-custom-title-md zn-top-separator zn-sep-dark"
);

$admin_options[] = zn_options_video_link_option( 'http://support.hogash.com/kallyas-videos/#TuXcJu9jl7c', __( "Click here to access the video tutorial for this section's options.", 'zn_framework' ), array(
	'slug'        => 'head_adv_options',
	'parent'      => 'general_options'
));

$admin_options[] = wp_parse_args( znpb_general_help_option( 'zn-admin-helplink' ), array(
	'slug'        => 'head_adv_options',
	'parent'      => 'general_options',
));
