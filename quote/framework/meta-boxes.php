<?php

add_filter( 'rwmb_meta_boxes', 'distinctivethemes_register_meta_boxes' );

/**
 * Register meta boxes
 *
 * @return void
 */
function distinctivethemes_register_meta_boxes( $meta_boxes ) {

$themeurl = get_template_directory_uri() . '/framework/customizer/';
$prefix = 'distinctivethemes_';

// Slider
$meta_boxes[] = array(
	'id' => 'layoutmetas',
	'title' => __( 'Layout Options', 'quote' ),
	'pages' => array( 'post' , 'page' , 'dt_portfolio_cpt'),
	'context' => 'normal',
	'priority' => 'high',
	'autosave' => true,
	'fields' => array(
				array(
					'id'       => "layout",
					'name'     => __( 'Layout', 'quote' ),
					'type'     => 'image_select',
					// Array of 'value' => 'Image Source' pairs
					'options'  => array(
						'full'  => $themeurl . 'images/portfolio-a.png',
						'leftsb' => $themeurl . 'images/portfolio-left-sb.png',
						'rightsb'  => $themeurl . 'images/portfolio-right-sb.png',
					),
					'std'  => 'rightsb',
				),   
	)
);

$meta_boxes[] = array(
	'id' => 'gallerymetas',
	'title' => __( 'Gallery Format Options', 'quote' ),
	'pages' => array( 'post', 'dt_portfolio_cpt'),
	'context' => 'normal',
	'priority' => 'high',
	'autosave' => true,
	'fields' => array(   
		array(
			'name'             => __( 'Slider Images (Minimum Size 800 x 300)', 'quote' ),
			'id'               => "additonal_images",
			'type'             => 'image_advanced',
			'max_file_uploads' => 40,
		),
	)
);

$meta_boxes[] = array(
	'id' => 'gallerymetaspage',
	'title' => __( 'Page Background Images', 'quote' ),
	'pages' => array('page'),
	'context' => 'normal',
	'priority' => 'high',
	'autosave' => true,
	'fields' => array(   
		array(
			'name'             => __( 'Slider Images (Minimum Size 800 x 300)', 'quote' ),
			'id'               => "additonal_images",
			'type'             => 'image_advanced',
			'max_file_uploads' => 40,
		),
	)
);

$meta_boxes[] = array(
		'id' => 'relatedposts',
		'title' => __( 'Related Posts', 'so-related-posts' ),
		'pages' => array( 'post' ),
		'context' => 'normal',
		'priority' => 'low',
		'autosave' => true,
		'fields' => array(
			/**
			 * add checkbox to show Related Posts or not
			 * @since 2014.03.21
			 */
			array(
				'name' => __( 'Tick the box to show Related Posts', 'so-related-posts' ),
				'id'   => "showrelated",
				'type' => 'checkbox',
				// Value can be 0 or 1
				'std'  => 0,
			),
			array(
				'name' => __( 'Choose one or more Related Post(s) you want to show.', 'so-related-posts' ),
				'id' => "related_posts",
				'type' => 'post',
				'post_type' => 'post',
				'field_type' => 'select_advanced',
				/**
				 * add placeholder text
				 * @since 2014.01.07
				 */
				'placeholder' => __( 'Please select...', 'so-related-posts' ),
				'query_args' => array(
					'post_status' => 'publish',
					'posts_per_page' => '999',
				),
				'clone' => true
			)
		)
	);

$meta_boxes[] = array(
		'id' => 'portfoliorelatedposts',
		'title' => __( 'Related Projects', 'so-related-posts' ),
		'pages' => array( 'dt_portfolio_cpt' ),
		'context' => 'normal',
		'priority' => 'low',
		'autosave' => true,
		'fields' => array(
			/**
			 * add checkbox to show Related Posts or not
			 * @since 2014.03.21
			 */
			array(
				'name' => __( 'Tick the box to show Related Posts', 'so-related-posts' ),
				'id'   => "showrelated",
				'type' => 'checkbox',
				// Value can be 0 or 1
				'std'  => 0,
			),
			array(
				'name' => __( 'Choose one or more Related Project(s) you want to show.', 'so-related-posts' ),
				'id' => "related_posts",
				'type' => 'post',
				'post_type' => 'dt_portfolio_cpt',
				'field_type' => 'select_advanced',
				/**
				 * add placeholder text
				 * @since 2014.01.07
				 */
				'placeholder' => __( 'Please select...', 'so-related-posts' ),
				'query_args' => array(
					'post_status' => 'publish',
					'posts_per_page' => '999',
				),
				'clone' => true
			)
		)
	);

	return $meta_boxes;
}


