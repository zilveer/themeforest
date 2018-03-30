<?php

$pb_templates_options = array();
$all_pb_templates = get_posts( array (
	'post_type'      => 'znpb_template_mngr',
	'posts_per_page' => - 1,
	'post_status'    => 'publish',
) );

foreach ($all_pb_templates as $key => $value) {
	$pb_templates_options[$value->ID] = $value->post_title;
}
$pb_general_options = array( 'no_template' => '-- No smart-area --') + $pb_templates_options;
$pb_post_type_options = array( '' => '-- Use general settings --') + $pb_general_options;
$zn_term_meta[] = array (
	'taxonomy' 			=> array( 'product_cat'),
	"name"        => __( "PageBuilder Smart Area To Use", 'zn_framework' ),
	"description" => __( "Using these options you can replace some of the site areas with pagebuilder smart areas.", 'zn_framework' ),
	"id"          => "pbtmpl_general",
	"type"        => "group_select",
	"config"     => array (
		'size' => 'zn_span6',
		'options'  => array(
			array(
				'name' => 'Smart Area location on subheader',
				'id' => 'subheader_location',
				'options' => array(
					'before' => 'Before subheader',
					'after' => 'After subheader',
					'replace' => 'Replace subheader',
				)
			),
			array(
				'name' => 'Smart Area to use',
				'id' => 'subheader_template',
				'options' => $pb_post_type_options
			),

			array(
				'name' => 'Smart Area location on footer',
				'id' => 'footer_location',
				'options' => array(
					'before' => 'Before footer',
					'after' => 'After footer',
					'replace' => 'Replace footer',
				)
			),
			array(
				'name' => 'Smart Area to use',
				'id' => 'footer_template',
				'options' => $pb_post_type_options
			),

		)
	),
	// 'class' => 'zn_full'
);