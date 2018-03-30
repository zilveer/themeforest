<?php

return array(
	'icon'   => 'el el-pencil',
	'title'  => __( 'Posts', 'BERG' ),
	'fields' => array(
		array(
			'id' => 'posts_show_author',
			'type' => 'checkbox',
			'title' => __('Show author', 'BERG'),
			'default' => '1',
		),
		array(
			'id' => 'posts_show_date',
			'type' => 'checkbox',
			'title' => __('Show date', 'BERG'),
			'default' => '1',
		),
		array(
			'id' => 'posts_show_cat',
			'type' => 'checkbox',
			'title' => __('Show categories', 'BERG'),
			'default' => '1',
		),
		array(
			'id' => 'posts_show_comments',
			'type' => 'checkbox',
			'title' => __('Show comments', 'BERG'),
			'default' => '1',
		),
		array(
			'id' => 'posts_show_tag',
			'type' => 'checkbox',
			'title' => __('Show tags', 'BERG'),
			'default' => '1',
		),
		array(
			'id' => 'berg_sharer_posts',
			'type' => 'checkbox',
			'title' => __('Show social share', 'BERG'),
			'default' => '1',
		),
		array(
			'id' => 'berg_post_template',
			'type' => 'select',
			'title' => __('Select post template', 'BERG'),
			'options' => array( 
				1 => __('Side by side', 'BERG'),
				2 => __('Image on top', 'BERG')
			),
			'default' => 1,
			'select2'  => array( 'allowClear' => false ),
		),
		array(
			'id' => 'berg_post_sidebar',
			'type' => 'select',
			'title' => __('Sidebar setting', 'BERG'),
			'options' => array( 
				1 => __('Disabled', 'BERG'),
				2 => __('Left', 'BERG'),
				3 => __('Right', 'BERG'),
			),
			'default' => 1,
			'select2'  => array( 'allowClear' => false ),
		),
		array(
			'id' => 'berg_post_content_width',
			'type' => 'select',
			'title' => __('Select content width', 'BERG'),
			'options' => array( 
				1 => __('Medium', 'BERG'),
				2 => __('Narrow', 'BERG'),
				3 => __('Wide', 'BERG')
			),
			'required' => array('berg_post_sidebar','=', 1),
			'default' => 1,
			'select2'  => array( 'allowClear' => false ),

		),

	)
);