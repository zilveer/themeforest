<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$page_option = array(
	'' => __( '- Select -', 'wolf' ),
);
$pages = get_pages();

foreach ( $pages as $page ) {
	$page_option[ absint( $page->ID ) ] = sanitize_text_field( $page->post_title );
}

$wolf_theme_options[] =  array(
	'type' => 'open',
	'label' =>__( 'Discography', 'wolf' )
);

	$wolf_theme_options[] =  array(
		'label' => __( 'Discography', 'wolf' ),
		'type' => 'section_open',
	);

	$wolf_theme_options[] =array( 'label' => __( 'Discography page', 'wolf' ),
			'id' => 'release_page_id',
			'type' => 'select',
			'options' => $page_option,
		);

	$wolf_theme_options[] =array( 'label' => __( 'Number of posts to show by default', 'wolf' ),
		'desc' => __( 'leave empty to show all', 'wolf' ),
		'id' => 'release_posts_per_page',
		'type' => 'int',
	);

	$wolf_theme_options[] =array( 'label' => __( 'Layout', 'wolf' ),
		'id' => 'release_type',
		'type' => 'select',
		'options' => array(
			'full' => __( 'Full width', 'wolf' ),
			'sidebar' => __( 'Sidebar', 'wolf' ),
			'grid' => __( 'Grid', 'wolf' ),
		),
	);

	$wolf_theme_options[] =array( 'label' => __( 'Columns', 'wolf' ),
		'id' => 'release_cols',
		'type' => 'select',
		'options' => array(
			2, 3, 4, 5, 6
		),
		'dependency' => array( 'element' => 'release_type', 'value' => array( 'grid' ) ),
	);

	$wolf_theme_options[] =array( 'label' => __( 'Width', 'wolf' ),
		'id' => 'release_width',
		'type' => 'select',
		'options' => array(
			'boxed' => __( 'Boxed', 'wolf' ),
			'wide' => __( 'Wide', 'wolf' ),
		),
		'dependency' => array( 'element' => 'release_type', 'value' => array( 'grid' ) ),
	);

	$wolf_theme_options[] =array( 'label' => __( 'Space', 'wolf' ),
		'id' => 'release_padding',
		'type' => 'select',
		'options' => array(
			'padding' => __( 'Padding', 'wolf' ),
			'no-padding' => __( 'No padding', 'wolf' ),
		),
		'dependency' => array( 'element' => 'release_type', 'value' => array( 'grid' ) ),
	);

	$wolf_theme_options[] =  array( 'type' => 'section_close' );

$wolf_theme_options[] =  array( 'type' => 'close' );
