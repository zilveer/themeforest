<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$page_option = array(
	'' => __( '- Select -', 'wolf' ),
);
$pages = get_pages();

foreach ( $pages as $page ) {
	$page_option[ absint( $page->ID ) ] = sanitize_text_field( $page->post_title );
}

$wolf_theme_options[] = array( 'type' => 'open' ,  'label' => __( 'Videos', 'wolf'  ) );

	$wolf_theme_options[] = array( 'label' => __( 'Videos', 'wolf' ),
		'type' => 'section_open',
	);

		$wolf_theme_options[] =array( 'label' => __( 'Video page', 'wolf' ),
			'id' => 'video_page_id',
			'type' => 'select',
			'options' => $page_option,
		);

		$wolf_theme_options[] =array( 'label' => __( 'Number of posts to show by default', 'wolf' ),
			'desc' => __( 'leave empty to show all', 'wolf' ),
			'id' => 'video_posts_per_page',
			'type' => 'int',
		);

		$wolf_theme_options[] =array( 'label' => __( 'Layout', 'wolf' ),
			'id' => 'video_type',
			'type' => 'select',
			'options' => array(
				'grid' => __( 'Grid', 'wolf' ),
				'youtube' => __( 'Categories', 'wolf' ),
				'youtube-all' => __( 'All videos', 'wolf' )
			),
		);

		$wolf_theme_options[] =array( 'label' => __( 'Columns', 'wolf' ),
			'id' => 'video_cols',
			'type' => 'select',
			'options' => array(
				2, 3, 4, 5, 6
			),
			'dependency' => array( 'element' => 'video_type', 'value' => array( 'classic', 'grid' ) ),
		);

		$wolf_theme_options[] =array( 'label' => __( 'Open video in a lightbox', 'wolf' ),
			'id' => 'video_lightbox',
			'type' => 'checkbox',
			'dependency' => array( 'element' => 'video_type', 'value' => array( 'classic', 'grid' ) ),
		);

		$wolf_theme_options[] =array( 'label' => __( 'Width', 'wolf' ),
			'id' => 'video_width',
			'type' => 'select',
			'options' => array(
				'boxed' => __( 'Boxed', 'wolf' ),
				'wide' => __( 'Wide', 'wolf' ),
			),
			'dependency' => array( 'element' => 'video_type', 'value' => array( 'classic', 'grid' ) ),
		);

		$wolf_theme_options[] =array( 'label' => __( 'Space', 'wolf' ),
			'id' => 'video_padding',
			'type' => 'select',
			'options' => array(
				'padding' => __( 'Padding', 'wolf' ),
				'no-padding' => __( 'No Padding', 'wolf' ),
			),
			'dependency' => array( 'element' => 'video_type', 'value' => array( 'classic', 'grid' ) ),
		);

		$wolf_theme_options[] =array( 'label' => __( 'Isotope filter', 'wolf' ),
			'id' => 'video_isotope',
			'type' => 'checkbox',
			'dependency' => array( 'element' => 'video_type', 'value' => array( 'classic', 'grid' ) ),
		);

		$wolf_theme_options[] =array( 'label' => __( 'Infinite scroll', 'wolf' ),
			'id' => 'video_infinite_scroll',
			'type' => 'checkbox',
			'dependency' => array( 'element' => 'video_type', 'value' => array( 'classic', 'grid' ) ),
		);

		$wolf_theme_options[] =array( 'label' => __( 'Trigger infinite scroll with a button', 'wolf' ),
			'desc' => __( 'If checked, the user will have to click the button to load more post', 'wolf' ),
			'id' => 'video_infinite_scroll_trigger',
			'type' => 'checkbox',
			'dependency' => array( 'element' => 'video_type', 'value' => array( 'classic', 'grid' ) ),
		);

		$wolf_theme_options[] =array( 'label' => __( 'Display author', 'wolf' ),
			'id' => 'video_author',
			'type' => 'checkbox',
		);

		$wolf_theme_options[] =array( 'label' => __( 'Display views', 'wolf' ),
			'id' => 'video_views',
			'type' => 'checkbox',
		);

		$wolf_theme_options[] =array( 'label' => __( 'Display likes', 'wolf' ),
			'id' => 'video_likes',
			'type' => 'checkbox',
		);

		$wolf_theme_options[] =array( 'label' => __( 'Enable comments', 'wolf' ),
			'id' => 'video_comments',
			'type' => 'checkbox',
		);

		$wolf_theme_options[] = array(
			'label' => __( 'Allow share links', 'wolf' ),
			'id' => 'video_share',
			'type' => 'checkbox',
		);

		$wolf_theme_options[] = array(
			'label' => __( 'Allow embed', 'wolf' ),
			'id' => 'video_embed',
			'type' => 'checkbox',
		);

		$wolf_theme_options[] =array( 'label' => __( 'Enable re-order by drag and drop', 'wolf' ),
			'id' => 'video_reorder',
			'type' => 'checkbox',
			'desc' => sprintf(  __( 'set your post order in %s -> re-order', 'wolf' ), 'Videos' ),
		);

	$wolf_theme_options[] = array( 'type' => 'section_close' );

$wolf_theme_options[] = array( 'type' => 'close' );
