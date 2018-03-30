<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$params = array(

	array(
		'type' => 'textfield',
		'class' => '',
		'heading' => __( 'Count', 'wolf' ),
		'param_name' => 'count',
		'description' => '',
		'value' => '',
	),

	array(
		'type' => 'textfield',
		'holder' => 'div',
		'class' => '',
		'heading' => __( 'Category', 'wolf' ),
		'param_name' => 'category',
		'description' => __( 'Include only one or several categories. Paste category slug(s) separated by a comma', 'wolf' ),
		'value' => '',
	),

	array(
		'type' => 'textfield',
		'holder' => 'div',
		'class' => '',
		'heading' => __( 'Tag', 'wolf' ),
		'param_name' => 'tag',
		'description' => __( 'Include only one or several tags. Paste category slug(s) separated by a comma', 'wolf' ),
		'value' => '',
	),

	array(
		'type' => 'checkbox',
		'holder' => 'div',
		'class' => '',
		//'heading' => __( 'Hide Cover', 'wolf' ),
		'param_name' => 'hide_category',
		'description' => '',
		'value' => array( __( 'Hide category', 'wolf' ) => true ),
	),

	array(
		'type' => 'checkbox',
		'holder' => 'div',
		'class' => '',
		//'heading' => __( 'Hide Cover', 'wolf' ),
		'param_name' => 'hide_tag',
		'description' => '',
		'value' => array( __( 'Hide tag', 'wolf' ) => true ),
	),

	array(
		'type' => 'checkbox',
		'holder' => 'div',
		'class' => '',
		//'heading' => __( 'Hide Cover', 'wolf' ),
		'param_name' => 'hide_date',
		'description' => '',
		'value' => array( __( 'Hide date', 'wolf' ) => true ),
	),

	array(
		'type' => 'checkbox',
		'holder' => 'div',
		'class' => '',
		//'heading' => __( 'Hide Cover', 'wolf' ),
		'param_name' => 'hide_author',
		'description' => '',
		'value' => array( __( 'Hide author', 'wolf' ) => true ),
	),

	array(
		'type' => 'textfield',
		'holder' => 'div',
		'class' => '',
		'heading' => __( 'Inline style', 'wolf' ),
		'param_name' => 'inline_style',
		'description' => __( 'Additional inline CSS style', 'wolf' ),
		'value' => '',
	),

	array(
		'type' => 'textfield',
		'holder' => 'div',
		'class' => '',
		'heading' => __( 'Extra class', 'wolf' ),
		'param_name' => 'class',
		'description' => __( 'Optional additional CSS class to add to the element', 'wolf' ),
		'value' => '',
	),
);

// Post Grid
$args = array(
	'name' => __( 'Post grid', 'wolf' ),
	'base' => 'wolf_last_posts_grid',
	'category' => 'by WolfThemes',
	'icon' => 'wolf-vc-icon wolf-vc-posts-grid',
	'allowed_container_element' => 'vc_row',
	'params' => $params
);
vc_map( $args );

// Post Slider
$args = array(
	'name' => __( 'Post slider', 'wolf' ),
	'base' => 'wolf_last_posts_slider',
	'category' => 'by WolfThemes',
	'icon' => 'wolf-vc-icon wolf-vc-posts-slider',
	'allowed_container_element' => 'vc_row',
	'params' => $params
);

global $slider_settings;
vc_map( wolf_inject_vc_params( $slider_settings, $args ) );

// Post Masonry
$args = array(
	'name' => __( 'Post masonry', 'wolf' ),
	'base' => 'wolf_last_posts_masonry',
	'category' => 'by WolfThemes',
	'icon' => 'wolf-vc-icon wolf-vc-posts-masonry',
	'allowed_container_element' => 'vc_row',
	'params' => $params
);
vc_map( $args );

// Post Columns
$args = array(
	'name' => __( 'Post columns', 'wolf' ),
	'base' => 'wolf_last_posts_columns',
	'category' => 'by WolfThemes',
	'icon' => 'wolf-vc-icon wolf-vc-posts-columns',
	'allowed_container_element' => 'vc_row',
	'params' => $params
);
vc_map( $args );

// Post Carousel
$args = array(
	'name' => __( 'Post carousel', 'wolf' ),
	'base' => 'wolf_last_posts_carousel',
	'category' => 'by WolfThemes',
	'icon' => 'wolf-vc-icon wolf-vc-posts-carousel',
	'allowed_container_element' => 'vc_row',
	'params' => $params
);
vc_map( $args );


// Post Preview
$params[] = array(
	'type' => 'dropdown',
	'holder' => 'div',
	'class' => '',
	'heading' => __( 'Animation', 'wolf' ),
	'description' => '',
	'param_name' => 'animation',
	'value' => $animations,
	'description' => '',
);
$args = array(
	'name' => __( 'Post preview', 'wolf' ),
	'base' => 'wolf_last_posts_preview',
	'category' => 'by WolfThemes',
	'icon' => 'wolf-vc-icon wolf-vc-posts-preview',
	'allowed_container_element' => 'vc_row',
	'params' => $params
);
vc_map( $args );
