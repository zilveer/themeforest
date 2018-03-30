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

$admin_options[] = array (
	'slug'        => 'general_pb_settings',
	'parent'      => 'pb_layouts',
	"name"        => __( "PageBuilder Smart Areas on GENERAL PAGES", 'zn_framework' ),
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
				'options' => $pb_general_options
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
				'options' => $pb_general_options
			),

		)
	),
	// 'class' => 'zn_full'
);

$allowed_post_types = apply_filters( 'znpb_allowed_post_type_templates', array(
	'post' => array(
		'nice_name' => 'BLOG'
	),
	'portfolio' => array(
		'nice_name' => 'PORTFOLIO'
	),
	'product' => array(
		'nice_name' => 'SHOP'
	),
));
$pb_post_type_options = array( '' => '-- Use general smart area --') + $pb_general_options;
foreach ( $allowed_post_types as $key => $value ) {
	$admin_options[] = array (
		'slug'        => 'single_pages_settings',
		'parent'      => 'pb_layouts',
		"name"        => sprintf( __( 'PageBuilder Smart Area on SINGLE %1$s PAGES', 'zn_framework' ), $value['nice_name'] ),
		"description" => __( "Using these options you can replace some of the site areas with pagebuilder smart area.", 'zn_framework' ),
		"id"          => 'pbtmpl_'.$key,
		"type"        => 'group_select',
		"config"     => array (
			'size' => 'zn_span6',
			'options'  => array(
				array(
					'name' => 'Smart Area location on SUBHEADER',
					'id' => 'subheader_location',
					'options' => array(
						'' => '-- Use general setting --',
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
					'name' => 'Smart Area location on FOOTER',
					'id' => 'footer_location',
					'options' => array(
						'' => '-- Use general setting --',
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
}


// Archive pages
$allowed_taxonomies = apply_filters( 'znpb_allowed_taxonomies_templates', array(
	'category' => array(
		'nice_name' => 'BLOG ARCHIVE (Category)'
	),
	'product_cat' => array(
		'nice_name' => 'SHOP ARCHIVE (Category)'
	),
));
$pb_post_type_options = array( '' => '-- Use general smart area --') + $pb_general_options;
foreach ( $allowed_taxonomies as $key => $value ) {
	$admin_options[] = array (
		'slug'        => 'archive_pages_settings',
		'parent'      => 'pb_layouts',
		"name"        => sprintf( __( 'PageBuilder Smart Area on %1$s PAGES', 'zn_framework' ), $value['nice_name'] ),
		"description" => __( "Using these options you can replace some of the site areas with pagebuilder smart area.", 'zn_framework' ),
		"id"          => 'pbtmpl_'.$key,
		"type"        => 'group_select',
		"config"     => array (
			'size' => 'zn_span6',
			'options'  => array(
				array(
					'name' => 'Smart Area location on SUBHEADER',
					'id' => 'subheader_location',
					'options' => array(
						'' => '-- Use general setting --',
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
					'name' => 'Smart Area location on FOOTER',
					'id' => 'footer_location',
					'options' => array(
						'' => '-- Use general setting --',
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
}


// $all_options = zget_option( '', '', true);
// unset( $all_options['pb_layouts'] );
// update_option( ZN()->theme_data['options_prefix'], $all_options );


$admin_options[] = array (
	'slug'        => 'general_pb_settings',
	'parent'      => 'pb_layouts',
    "name"        => __( '<span class="dashicons dashicons-editor-help"></span> HELP:', 'zn_framework' ),
    "description" => __( 'Below you can find quick access to documentation, video documentation or our support forum.', 'zn_framework' ),
    "id"          => "lto_title",
    "type"        => "zn_title",
    "class"       => "zn_full zn-custom-title-md zn-top-separator zn-sep-dark"
);

$admin_options[] = zn_options_doc_link_option( 'http://support.hogash.com/documentation/page-builder-smart-areas/', array(
    'slug'        => 'general_pb_settings',
	'parent'      => 'pb_layouts',
));

$admin_options[] = wp_parse_args( znpb_general_help_option( 'zn-admin-helplink' ), array(
    'slug'        => 'general_pb_settings',
	'parent'      => 'pb_layouts',
));