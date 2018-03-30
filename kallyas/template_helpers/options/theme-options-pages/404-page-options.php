<?php
/**
 * Theme options > General Options  > Favicon options
 */
global  $header_option;

if(!isset($header_option) || empty($header_option)){
	$header_option = WpkZn::getThemeHeaders(true);
}


$pb_templates_options = array('' => '-- Select a smart area --');
$all_pb_templates = get_posts( array (
	'post_type'      => 'znpb_template_mngr',
	'posts_per_page' => - 1,
	'post_status'    => 'publish',
) );

foreach ($all_pb_templates as $key => $value) {
	$pb_templates_options[$value->ID] = $value->post_title;
}

$admin_options[] = array (
	'slug'        => 'zn_404_options',
	'parent'      => 'zn_404_options',
	"name"        => __( "404 page type", 'zn_framework' ),
	"description" => __( "Select what type of content you want to display as a 404 page.", 'zn_framework' ),
	"id"          => "404_content_type",
	"std"         => '',
	"type"        => "select",
	"options"     => array(
		'' => __( "Standard ( will display header and 404 word )", 'zn_framework' ),
		'pb_template' => __( "Pagebuilder Smart Area", 'zn_framework' ),
	)
);


$admin_options[] = array (
	'slug'        => 'zn_404_options',
	'parent'      => 'zn_404_options',
	'id'          => '404_smart_area',
	'name'        => __( 'Select Pagebuilder Smart Area','zn_framework'),
	'description' => __( 'Using this option you can select a pre-built template made at Admin > Pagebuilder Smart Areas page.','zn_framework'),
	'type'        => 'select',
	'options'   => $pb_templates_options,
	'dependency'  => array (
		array(
			'element' => '404_content_type',
			'value' => array ( 'pb_template' )
		),
	),
);


$admin_options[] = array (
	'slug'        => 'zn_404_options',
	'parent'      => 'zn_404_options',
	"name"        => __( "Header Style", 'zn_framework' ),
	"description" => __( 'Select the background style you want to use.Please note that the styles can be created from the "Unlimited Headers" options in the theme admin\'s page.', 'zn_framework' ),
	"id"          => "404_header_style",
	"std"         => "",
	"type"        => "select",
	"options"     => $header_option,
	"class"       => "",
	'dependency'  => array (
		array(
			'element' => '404_content_type',
			'value' => array ( '' )
		),
	),
);

$admin_options[] = array (
	'slug'        => 'zn_404_options',
	'parent'      => 'zn_404_options',
	"name"        => __( '<span class="dashicons dashicons-editor-help"></span> HELP:', 'zn_framework' ),
	"description" => __( 'Below you can find quick access to documentation, video documentation or our support forum.', 'zn_framework' ),
	"id"          => "zn404_title",
	"type"        => "zn_title",
	"class"       => "zn_full zn-custom-title-md zn-top-separator zn-sep-dark"
);

$admin_options[] = wp_parse_args( znpb_general_help_option( 'zn-admin-helplink' ), array(
	'slug'        => 'zn_404_options',
	'parent'      => 'zn_404_options',
));