<?php

$sections[] = array(
	'title' => __('Blog Settings', "orangeidea"),
	'header' => '',
	'desc' => '',
	'icon_class' => 'icon-large',
    'icon' => 'el el-font',
    // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
	'fields' => array(
	array(
		'id'       => 'oi_blog_settings',
		'type'     => 'select',
		'title'    => __('Blog Layout', 'redux-framework-demo'), 
		'desc'     => __('', 'redux-framework-demo'),
		'options'  => array(
			'oi_blog_rs' => 'Standard: Right Sidebar',
			'oi_blog_ls' => 'Standard: Left Sidebar',
			'oi_blog_chess' => 'Chess Style',
			'oi_blog_chess_rs' => 'Chess Style: Right Sidebar',
			'oi_blog_chess_ls' => 'Chess Style: Left Sidebar',
			'oi_blog_mini_rs' => 'Mini Images: Right Sidebar',
			'oi_blog_mini_ls' => 'Mini Images: Left Sidebar',
			'oi_blog_masonry_2col' => 'Masonry 2 Columns',
			'oi_blog_masonry_3col' => 'Masonry 3 Columns',
			'oi_blog_masonry_rs' => 'Masonry: Right Sidebar',
			'oi_blog_masonry_ls' => 'Masonry: Left Sidebar',
		),
		'default'  => 'oi_blog_rs',
	),
)
);