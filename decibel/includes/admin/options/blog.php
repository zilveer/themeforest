<?php
/**
 * Blog settings
 *
 * The layout options for the blog
 *
 * @package Decibel
 * @since Decibel 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$wolf_theme_options[] =  array(
	'type' => 'open',
	'label' =>__( 'Blog', 'wolf' )
);

	$wolf_theme_options[] =  array(
		'label' => __( 'Blog', 'wolf' ),
		'type' => 'section_open',
	);

	$wolf_theme_options[] =  array(
		'label' => __( 'Date format', 'wolf' ),
		'id' => 'date_format',
		'type' => 'select',
		'options' => array(
			'standard' => __( 'Standard', 'wolf' ),
			'human_diff' => __( 'Differential ( e.g: 10 days ago )', 'wolf' ),
		),
	);

	$wolf_theme_options[] =  array(
		'label' => __( 'Layout', 'wolf' ),
		'id' => 'blog_type',
		'type' => 'select',
		'options' => array(
			'large' => __( 'Large', 'wolf' ),
			'sided' => __( 'Medium Image', 'wolf' ),
			'sidebar' => __( 'Sidebar', 'wolf' ),
			'masonry' => __( 'Masonry', 'wolf' ),
			'grid' => __( 'Grid', 'wolf' ),
		),
		'desc' => sprintf( __( 'It can be overwritten in category options. For the grid layout, your images must be %s minimum', 'wolf' ), '960x960px' ),
	);

	$wolf_theme_options[] =  array(
		'label' => __( 'Default single post layout', 'wolf' ),
		'id' => 'single_blog_post_layout',
		'type' => 'select',
		'options' => array(
			'standard' => __( 'Full Width', 'wolf' ),
			'sidebar' => __( 'Sidebar', 'wolf' ),
			'split' => __( 'Splitted', 'wolf' ),
			'vc' => 'Visual Composer',
		),
		'desc' => __( 'It can be overwritten in category options and single post options', 'wolf' ),
	);

	$wolf_theme_options[] =  array(
		'label' => __( 'Default single post navigation type', 'wolf' ),
		'id' => 'post_nav_type',
		'type' => 'select',
		'options' => array(
			'navigation' => __( 'Previous/Next navigation', 'wolf' ),
			'related' => __( 'Related posts', 'wolf' ),
		),
		'desc' => __( 'It can be overwritten in category options and single post options', 'wolf' ),
	);

	$wolf_theme_options[] =  array(
		'label' => __( 'Excerpt', 'wolf' ),
		'desc' => sprintf( __( 'Use the <a href="%s" target="_blank">more tag</a> to split your post if you choose the manual exerpt', 'wolf' ), 'http://en.support.wordpress.com/splitting-content/more-tag/' ),
		'id' => 'excerpt_type',
		'type' => 'select',
		'options' => array(
			'auto' => __( 'Auto', 'wolf' ),
			'manual' => __( 'Manual', 'wolf' ),
		),
		'dependency' => array( 'element' => 'blog_type', 'value' => array( 'large', 'sidebar' ) ),
	);

	$wolf_theme_options[] =  array(
		'label' => __( 'Width', 'wolf' ),
		'id' => 'blog_width',
		'type' => 'select',
		'options' => array(
			'boxed' => __( 'Boxed', 'wolf' ),
			'wide' => __( 'Wide', 'wolf' ),
		),
		'dependency' => array( 'element' => 'blog_type', 'value' => array( 'masonry' ) ),
	);

	$wolf_theme_options[] =  array(
		'label' => __( 'Infinite scroll', 'wolf' ),
		'id' => 'blog_infinite_scroll',
		'type' => 'checkbox',
	);

	$wolf_theme_options[] =  array( 'label' => __( 'Trigger infinite scroll with a button', 'wolf' ),
		'desc' => __( 'If checked, the user will have to click the button to load more post', 'wolf' ),
		'id' => 'blog_infinite_scroll_trigger',
		'type' => 'checkbox',
	);

	// $wolf_theme_options[] =  array( 'label' => __( 'Display related posts', 'wolf' ),
	// 	'id' => 'display_related_posts',
	// 	'type' => 'checkbox',
	// );

	$wolf_theme_options[] =  array( 'label' => __( 'Display views', 'wolf' ),
		'id' => 'post_views',
		'type' => 'checkbox',
	);

	$wolf_theme_options[] =  array( 'label' => __( 'Display likes', 'wolf' ),
		'id' => 'post_likes',
		'type' => 'checkbox',
	);

	$wolf_theme_options[] = array(
		'label' => __( 'Share links', 'wolf' ),
		'desc' => __( 'Display "share" links below each single post ?', 'wolf' ),
		'id' => 'post_share',
		'type' => 'checkbox',
	);

	$wolf_theme_options[] =  array(
		'label' => __( 'Show author bio', 'wolf' ),
		'desc' => __( 'Show the author bio below each single blog post.', 'wolf' ),
		'id' => 'show_author_box',
		'type' => 'checkbox',
	);

	$wolf_theme_options[] =  array( 'type' => 'section_close' );

$wolf_theme_options[] =  array( 'type' => 'close' );
