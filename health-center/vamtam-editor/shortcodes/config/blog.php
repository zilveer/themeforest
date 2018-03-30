<?php

/**
 * Blog shortcode options
 *
 * @package wpv
 * @subpackage editor
 */


return array(
	'name' => 'Blog',
	'desc' => __('Please note that this element shows already created blog posts. To create one go to the Posts tab in the WordPress main navigation menu on the left - add new. You do not have to go to Settings - Reading to set the blog listing page.' , 'health-center'),
	'icon' => array(
		'char' => WPV_Editor::get_icon('blog'),
		'size' => '30px',
		'lheight' => '45px',
		'family' => 'vamtam-editor-icomoon',
	),
	'value' => 'blog',
	'controls' => 'size name clone edit delete',
	'options' => array(

		array(
			'name' => __('Layout', 'health-center'),
			'desc' => __('Big images - this is the standard layout in one column. <br>
				Small images, Small Images - Scrollable, Small images - Masonry - the posts in these layouts come in boxes with image on top and text below. They come in 2,3,4 columns.', 'health-center') ,
			'id' => 'layout',
			'type' => 'select',
			'default' => 'normal',
			'options' => array(
				'normal' => __('Big Images', 'health-center'),
				'small' => __('Small Images - Normal', 'health-center'),
				'scroll-x' => __('Small Images - Scrollable', 'health-center'),
				'masonry' => __('Small Images - Masonry', 'health-center'),
			),
			'field_filter' => 'fbs',
		),
		array(
			'name' => __('Columns', 'health-center') ,
			'desc' => __('Number of posts to show per row.', 'health-center') ,
			'id' => 'column',
			'default' => 2,
			'min' => 2,
			'max' => 4,
			'type' => 'range',
			'class' => 'fbs fbs-small fbs-scroll-x fbs-masonry',
		) ,
		array(
			'name' => __('Limit', 'health-center') ,
			'desc' => __('Number of posts to show per page.', 'health-center') ,
			'id' => 'count',
			'default' => 3,
			'min' => 1,
			'max' => 50,
			'type' => 'range',
		) ,

		array(
			'name' => __('Display Post Content', 'health-center') ,
			'id' => 'show_content',
			'desc' => __('Big Images Layout: If the option is on, it will display the content of the post, otherwise it will display the excerpt.<br>
				Small Images - Normal, Scrollable, Masonry: If the option is on, the post excerpt will be shown, otherwise no content will be shown.', 'health-center') ,
			'default' => false,
			'type' => 'toggle',
		) ,
		array(
			'name' => __('Nopaging', 'health-center') ,
			'id' => 'nopaging',
			'desc' => __('If the option is on, it will disable pagination. You can set the type of pagination in General Settings - Posts - Pagination Type. ', 'health-center') ,
			'default' => true,
			'type' => 'toggle',
			'class' => 'fbs fbs-normal fbs-small fbs-masonry',
		) ,
		array(
			'name' => __('Category (optional)', 'health-center') ,
			'desc' => __('All categories will be shown if none are selected. Please note that if you do not see categories, there are none created most probably. You can use ctr + click to select multiple categories', 'health-center') ,
			'id' => 'cat',
			'default' => array() ,
			'target' => 'cat',
			'type' => 'multiselect',
			'layout' => 'checkbox',
		) ,
		array(
			'name' => __('Posts (optional)', 'health-center') ,
			'desc' => __('All posts will be shown if none are selected. If you select any posts here, this option will override the category option above. You can use ctr + click to select multiple posts.', 'health-center') ,
			'id' => 'posts',
			'default' => array() ,
			'target' => 'post',
			'type' => 'multiselect',
		) ,


		array(
			'name' => __('Title (optional)', 'health-center') ,
			'desc' => __('The title is placed just above the element.', 'health-center'),
			'id' => 'column_title',
			'default' => '',
			'type' => 'text'
		) ,
		array(
			'name' => __('Title Type (optional)', 'health-center') ,
			'id' => 'column_title_type',
			'default' => 'single',
			'type' => 'select',
			'options' => array(
				'single' => __('Title with divider next to it', 'health-center'),
				'double' => __('Title with divider below', 'health-center'),
				'no-divider' => __('No Divider', 'health-center'),
			),
		) ,
		array(
			'name' => __('Element Animation (optional)', 'health-center') ,
			'id' => 'column_animation',
			'default' => 'none',
			'type' => 'select',
			'options' => array(
				'none' => __('No animation', 'health-center'),
				'from-left' => __('Appear from left', 'health-center'),
				'from-right' => __('Appear from right', 'health-center'),
				'fade-in' => __('Fade in', 'health-center'),
				'zoom-in' => __('Zoom in', 'health-center'),
			),
		) ,
	) ,
);



