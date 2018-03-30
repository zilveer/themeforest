<?php
/**
 * Theme options > General Options  > Favicon options
 */


// BOXED LAYOUT
$admin_options[] = array (
	'slug'        => 'layout_options',
	'parent'      => 'layout_options',
	"name"        => __( "Choose Site Layout", 'zn_framework' ),
	"description" => __( "Choose the type of layout you want pages to display.", 'zn_framework' ),
	"id"          => "zn_boxed_layout",
	"std"         => "no",
	// "type"        => "zn_radio",
	// "options"     => array ( 'no' => __( 'No', 'zn_framework' ), 'yes' => __( 'Yes', 'zn_framework' ) ),
	"type"        => "radio_image",
	"class"       => "zn_full ri-2 ri-bg-hover",
	"options"     => array(
		array(
			'value' => 'no',
			'name'  => __( 'Full-Width', 'zn_framework' ),
			'image' => THEME_BASE_URI .'/images/admin/site-layout/fullwidth.svg'
		),
		array(
			'value' => 'yes',
			'name'  => __( 'Boxed', 'zn_framework' ),
			'image' => THEME_BASE_URI .'/images/admin/site-layout/boxed.svg'
		),
	)
);

// BACKGROUND IMAGE
$admin_options[] = array (
	'slug'        => 'layout_options',
	'parent'      => 'layout_options',
	"name"        => __( "Background Image", 'zn_framework' ),
	"description" => __( "Please choose your desired image to be used as a background", 'zn_framework' ),
	"id"          => "boxed_style_image",
	"std"         => '',
	"options"     => array ( "repeat" => true, "position" => true, "attachment" => true ),
	"type"        => "background",
	'dependency'  => array ( 'element' => 'zn_boxed_layout', 'value' => array ( 'yes' ) ),
);

// BACKGROUND COLOR
$admin_options[] = array (
	'slug'        => 'layout_options',
	'parent'      => 'layout_options',
	"name"        => __( "Background Color", 'zn_framework' ),
	"description" => __( "Please choose your desired background color", 'zn_framework' ),
	"id"          => "boxed_style_color",
	"std"         => '#fff',
	"type"        => "colorpicker",
	'dependency'  => array ( 'element' => 'zn_boxed_layout', 'value' => array ( 'yes' ) ),
);

// BOXED LAYOUT FOR HOMEPAGE
$admin_options[] = array (
	'slug'        => 'layout_options',
	'parent'      => 'layout_options',
	"name"        => __( "Homepage Boxed Layout", 'zn_framework' ),
	"description" => __( "Here you can choose a specific layout setting for the homepage that will override the
		setting from above.", 'zn_framework' ),
	"id"          => "zn_home_boxed_layout",
	"std"         => "def",
	"type"        => "zn_radio",
	"options"     => array (
		'def' => __( 'Default', 'zn_framework' ),
		'no'  => __( 'No', 'zn_framework' ),
		'yes' => __( 'Yes', 'zn_framework' )
	),
	"class"        => "zn_radio--yesno",
);

$admin_options[] = array (
	'slug'        => 'layout_options',
	'parent'      => 'layout_options',
	"name"        => __( "Content size", 'zn_framework' ),
	"description" => __( "Please choose the desired default size for the content.", 'zn_framework' ),
	"id"          => "zn_width",
	"std"         => "1170",
	"options"     => array(
		array(
			'value' => '1170',
			'name'  => __( '1170px', 'zn_framework' ),
			'image' => THEME_BASE_URI .'/images/admin/various-theme-options/layout-contentsize-1170.gif'
		),
		array(
			'value' => '960',
			'name'  => __( '960px', 'zn_framework' ),
			'image' => THEME_BASE_URI .'/images/admin/various-theme-options/layout-contentsize-960.gif'
		),
		array(
			'value' => 'custom',
			'name'  => __( 'Custom Width', 'zn_framework' ),
			'image' => THEME_BASE_URI .'/images/admin/various-theme-options/layout-contentsize-custom.gif'
		),
		array(
			'value' => 'custom_perc',
			'name'  => __( 'Custom Percentage Width', 'zn_framework' ),
			'image' => THEME_BASE_URI .'/images/admin/various-theme-options/layout-contentsize-custom-perc.gif'
		),
	),
	"type"        => "radio_image",
	"class"        => "ri-hover-line ri-4",
);

$admin_options[] = array (
	'slug'        => 'layout_options',
	'parent'      => 'layout_options',
	'id'          => 'custom_width',
	'name'        => __( 'Site Container Width (on Large breakpoints, 1200px)', 'zn_framework'),
	'description' => __( 'Choose the desired width for the site\'s container.', 'zn_framework' ),
	'type'        => 'slider',
	'std'        => '1170',
	'helpers'     => array(
		'min' => '1170',
		'max' => '1900'
	),
	'dependency' => array( 'element' => 'zn_width' , 'value'=> array('custom') )
);

$admin_options[] = array (
	'slug'        => 'layout_options',
	'parent'      => 'layout_options',
	'id'          => 'custom_perc_width',
	'name'        => __( 'Site Container Percentage % Width', 'zn_framework'),
	'description' => __( 'Choose the desired width for the site\'s container.', 'zn_framework' ),
	'type'        => 'smart_slider',
	'std'        => '100',
	'supports' => array('breakpoints'),
	'units' => array('%'),
	'helpers'     => array(
		'min' => '10',
		'max' => '100'
	),
	'dependency' => array( 'element' => 'zn_width' , 'value'=> array('custom_perc') )
);

$admin_options[] = array (
	'slug'        => 'layout_options',
	'parent'      => 'layout_options',
	"name"        => __( "Enable Element Entry Animations", 'zn_framework' ),
	"description" => __( "Choose yes if you want to enable elements entry/reveal animations on page scroll. Each element will have Animation options in the Misc. tab. Please remember that it affects website performance.", 'zn_framework' ),
	"id"          => "zn_animations",
	"std"         => "no",
	"type"        => "zn_radio",
	"options"     => array ( 'yes' => __( 'Yes', 'zn_framework' ), 'no' => __( 'No', 'zn_framework' ) ),
	"class"        => "zn_radio--yesno",
);


$admin_options[] = array (
	'slug'        => 'layout_options',
	'parent'      => 'layout_options',
	"name"        => __( '<span class="dashicons dashicons-editor-help"></span> HELP:', 'zn_framework' ),
	"description" => __( 'Below you can find quick access to documentation, video documentation or our support forum.', 'zn_framework' ),
	"id"          => "lto_title",
	"type"        => "zn_title",
	"class"       => "zn_full zn-custom-title-md zn-top-separator zn-sep-dark"
);

$admin_options[] = zn_options_video_link_option( 'http://support.hogash.com/kallyas-videos/#X6qGyb6Bmaw', __( "Click here to access the video tutorial for this section's options.", 'zn_framework' ), array(
	'slug'        => 'layout_options',
	'parent'      => 'layout_options'
));

$admin_options[] = wp_parse_args( znpb_general_help_option( 'zn-admin-helplink' ), array(
	'slug'        => 'layout_options',
	'parent'      => 'layout_options',
));
