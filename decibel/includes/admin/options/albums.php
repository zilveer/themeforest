<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$page_option = array(
	'' => __( '- Select -', 'wolf' ),
);
$pages = get_pages();

foreach ( $pages as $page ) {
	$page_option[ absint( $page->ID ) ] = sanitize_text_field( $page->post_title );
}

$wolf_theme_options[] = array( 'type' => 'open' ,  'label' => __( 'Photo Albums', 'wolf'  ) );

	$wolf_theme_options[] = array( 'label' => __( 'Albums', 'wolf' ),
		'type' => 'section_open',
	);

	$wolf_theme_options[] = array( 'label' => __( 'Galleries page', 'wolf' ),
		'id' => 'gallery_page_id',
		'type' => 'select',
		'options' => $page_option,
	);

	$wolf_theme_options[] =array( 'label' => __( 'Number of posts to show by default', 'wolf' ),
		'desc' => __( 'leave empty to show all', 'wolf' ),
		'id' => 'gallery_posts_per_page',
		'type' => 'int',
	);

	$wolf_theme_options[] =array( 'label' => __( 'Layout', 'wolf' ),
		'id' => 'gallery_type',
		'type' => 'select',
		'options' => array(
			'grid' => __( 'Grid', 'wolf' ),
			'vertical' => __( 'Vertical carousel', 'wolf' ),
			'modern' => __( 'Horizontal', 'wolf' ),
		),
	);

	$wolf_theme_options[] =array( 'label' => __( 'Columns', 'wolf' ),
		'id' => 'gallery_cols',
		'type' => 'select',
		'options' => array(
			2, 3, 4, 5, 6
		),
		'dependency' => array( 'element' => 'gallery_type', 'value' => array( 'grid' ) ),
	);

	$wolf_theme_options[] =array( 'label' => __( 'Width', 'wolf' ),
		'id' => 'gallery_width',
		'type' => 'select',
		'options' => array(
			'boxed' => __( 'Boxed', 'wolf' ),
			'wide' => __( 'Wide', 'wolf' ),
		),
		'dependency' => array( 'element' => 'gallery_type', 'value' => array( 'grid' ) ),
	);

	$wolf_theme_options[] =array( 'label' => __( 'Space', 'wolf' ),
		'id' => 'gallery_padding',
		'type' => 'select',
		'options' => array(
			'padding' => __( 'Padding', 'wolf' ),
			'no-padding' => __( 'No padding', 'wolf' ),
		),
		'dependency' => array( 'element' => 'gallery_type', 'value' => array( 'grid' ) ),
	);

	$wolf_theme_options[] =array( 'label' => __( 'Isotope filter', 'wolf' ),
		'id' => 'gallery_isotope',
		'type' => 'checkbox',
		'dependency' => array( 'element' => 'gallery_type', 'value' => array( 'grid' ) ),
	);

	$wolf_theme_options[] =array( 'label' => __( 'Infinite scroll', 'wolf' ),
		'id' => 'gallery_infinite_scroll',
		'type' => 'checkbox',
		'dependency' => array( 'element' => 'gallery_type', 'value' => array( 'grid' ) ),
	);

	$wolf_theme_options[] =array( 'label' => __( 'Trigger infinite scroll with a button', 'wolf' ),
		'desc' => __( 'If checked, the user will have to click the button to load more post', 'wolf' ),
		'id' => 'gallery_infinite_scroll_trigger',
		'type' => 'checkbox',
		'dependency' => array( 'element' => 'gallery_type', 'value' => array( 'grid' ) ),
	);

	$wolf_theme_options[] =array( 'label' => __( 'Enable re-order by drag and drop', 'wolf' ),
		'id' => 'gallery_reorder',
		'type' => 'checkbox',
		'desc' => sprintf(  __( 'set your post order in %s -> re-order', 'wolf' ), 'Galleries' ),
	);

	// $wolf_theme_options[] =array( 'label' => __( 'Display views', 'wolf' ),
	// 	'id' => 'gallery_views',
	// 	'type' => 'checkbox',
	// );

	// $wolf_theme_options[] =array( 'label' => __( 'Display likes', 'wolf' ),
	// 	'id' => 'gallery_likes',
	// 	'type' => 'checkbox',
	// );

	$wolf_theme_options[] =array( 'label' => __( 'Enable comments', 'wolf' ),
		'id' => 'gallery_comments',
		'type' => 'checkbox',
	);

	$wolf_theme_options[] = array(
		'label' => __( 'Share links', 'wolf' ),
		'desc' => __( 'Display "share" links below each single post ?', 'wolf' ),
		'id' => 'gallery_share',
		'type' => 'checkbox',
	);

	$wolf_theme_options[] = array( 'type' => 'section_close' );


$wolf_theme_options[] = array( 'type' => 'close' );
