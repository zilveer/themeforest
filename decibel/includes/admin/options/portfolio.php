<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$page_option = array(
	'' => __( '- Select -', 'wolf' ),
);
$pages = get_pages();

foreach ( $pages as $page ) {
	$page_option[ absint( $page->ID ) ] = sanitize_text_field( $page->post_title );
}

$wolf_theme_options[] = array( 'type' => 'open' ,  'label' => __( 'Portfolio', 'wolf'  ) );

	$wolf_theme_options[] = array( 'label' => __( 'Portfolio', 'wolf' ),
		'type' => 'section_open',
	);

		$wolf_theme_options[] =array( 'label' => __( 'Portfolio page', 'wolf' ),
			'id' => 'work_page_id',
			'type' => 'select',
			'options' => $page_option,
		);

	$wolf_theme_options[] =array( 'label' => __( 'Number of posts to show by default', 'wolf' ),
		'desc' => __( 'leave empty to show all', 'wolf' ),
		'id' => 'work_posts_per_page',
		'type' => 'int',
	);

	$wolf_theme_options[] =array( 'label' => __( 'Layout', 'wolf' ),
		'id' => 'work_type',
		'type' => 'select',
		'options' => array(
			'classic' => __( 'Classic', 'wolf' ),
			'grid' => __( 'Grid', 'wolf' ),
			'grid-square' => __( 'Square grid', 'wolf' ),
			'masonry' => __( 'Masonry', 'wolf' ),
			'masonry-horizontal' => __( 'Modern masonry', 'wolf' ),
			'vertical' => __( 'Vertical carousel', 'wolf' ),
			'modern' => __( 'Horizontal', 'wolf' ),
		),
	);

	$wolf_theme_options[] =array( 'label' => __( 'Columns', 'wolf' ),
		'id' => 'work_cols',
		'type' => 'select',
		'options' => array(
			2, 3, 4, 5, 6
		),
		'dependency' => array( 'element' => 'work_type', 'value' => array( 'classic', 'grid' ) ),
	);

	$wolf_theme_options[] =array( 'label' => __( 'Width', 'wolf' ),
		'id' => 'work_width',
		'type' => 'select',
		'options' => array(
			'boxed' => __( 'Boxed', 'wolf' ),
			'wide' => __( 'Wide', 'wolf' ),
		),
		'dependency' => array( 'element' => 'work_type', 'value' => array( 'classic', 'grid', 'masonry' ) ),
	);

	$wolf_theme_options[] =array( 'label' => __( 'Space', 'wolf' ),
		'id' => 'work_padding',
		'type' => 'select',
		'options' => array(
			'padding' => __( 'Padding', 'wolf' ),
			'no-padding' => __( 'No padding', 'wolf' ),
		),
		'dependency' => array( 'element' => 'work_type', 'value' => array( 'classic', 'grid', 'masonry' ) ),
	);

	$wolf_theme_options[] =array( 'label' => __( 'Isotope filter', 'wolf' ),
		'id' => 'work_isotope',
		'type' => 'checkbox',
		'dependency' => array( 'element' => 'work_type', 'value' => array( 'classic', 'grid', 'masonry' ) ),
	);

	$wolf_theme_options[] =array( 'label' => __( 'Infinite scroll', 'wolf' ),
		'id' => 'work_infinite_scroll',
		'type' => 'checkbox',
		'dependency' => array( 'element' => 'work_type', 'value' => array( 'classic', 'grid', 'masonry' ) ),
	);

	$wolf_theme_options[] =array( 'label' => __( 'Trigger infinite scroll with a button', 'wolf' ),
		'desc' => __( 'If checked, the user will have to click the button to load more post', 'wolf' ),
		'id' => 'work_infinite_scroll_trigger',
		'type' => 'checkbox',
		'dependency' => array( 'element' => 'work_type', 'value' => array( 'classic', 'grid', 'masonry' ) ),
	);

	$wolf_theme_options[] =array( 'label' => __( 'Display date', 'wolf' ),
		'id' => 'work_date',
		'type' => 'checkbox',
	);

	$wolf_theme_options[] =array( 'label' => __( 'Display views', 'wolf' ),
		'id' => 'work_views',
		'type' => 'checkbox',
	);

	$wolf_theme_options[] =array( 'label' => __( 'Display likes', 'wolf' ),
		'id' => 'work_likes',
		'type' => 'checkbox',
	);

	$wolf_theme_options[] =array( 'label' => __( 'Enable comments', 'wolf' ),
		'id' => 'work_comments',
		'type' => 'checkbox',
	);

	$wolf_theme_options[] = array(
		'label' => __( 'Share links', 'wolf' ),
		'desc' => __( 'Display "share" links below each single post ?', 'wolf' ),
		'id' => 'work_share',
		'type' => 'checkbox',
	);

	$wolf_theme_options[] =array( 'label' => __( 'Enable re-order by drag and drop', 'wolf' ),
		'id' => 'work_reorder',
		'type' => 'checkbox',
		'desc' => sprintf(  __( 'set your post order in %s -> re-order', 'wolf' ), 'portfolio' ),
	);

	$wolf_theme_options[] = array( 'type' => 'section_close' );

$wolf_theme_options[] = array( 'type' => 'close' );
