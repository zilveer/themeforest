<?php

return array(
	'title'  => __( 'Blog', 'BERG') ,
	'icon' 	 => 'el-icon-pencil',
	'fields' => array(
		array(
			'id' => 'blog_categories',
			'type' => 'select',
			'data' => 'categories',
			'multi'	=> true,
			'title'	=> __( 'Blog categories', 'BERG' ),
			'subtitle' => __( 'Choose posts categories to show on this page, if none selected theme will load all', 'BERG' ),
		),

		array(
			'id' => 'blog_post_per_page',
			'title' => __('Posts per page', 'BERG'),
			'type' => 'text',
		),
		array(
			'id' => 'blog_show_excerpt',
			'type' => 'switch',
			'title' => __('Show excerpt', 'BERG'),
			'on'		=> 'On',
			'off'		=> 'Off',
			'default' => true,
		),
		array(
			'id' => 'blog_excerpt_length',
			'title' => __('Excerpt length (words)', 'BERG'),
			'type' => 'text',
			'default' => 15,
			'required' => array('blog_show_excerpt','=', true),
			// 'desc' 	=> __( 'Write your custom excerpt length for Blog List, Blog Classic or Blog Squares', 'BERG'),
		),
		array(
			'id' => 'blog_show_author',
			'type' => 'switch',
			'title' => __('Show author', 'BERG'),
			'on'		=> 'On',
			'off'		=> 'Off',
			'default' => true,
		),
		array(
			'id' => 'blog_show_date',
			'type' => 'switch',
			'title' => __('Show date', 'BERG'),
			'on'		=> 'On',
			'off'		=> 'Off',
			'default' => true,
		),
		array(
			'id' => 'blog_show_cat',
			'type' => 'switch',
			'title' => __('Show categories', 'BERG'),
			'on'		=> 'On',
			'off'		=> 'Off',
			'default' => true,
		),
		array(
			'id' => 'blog_show_btn',
			'type' => 'switch',
			'title' => __('Show "read more" button', 'BERG'),
			'on'		=> 'On',
			'off'		=> 'Off',
			'default' => true,
		),
		array(
			'id'    	  => 'berg_blog_overlay',
			'type'  	  => 'color',
			'title'    	  => __( 'Overlay color on hover', 'BERG' ),
			'default' 	  => 'rgba(0,0,0,0.6)',
			'transparent' => true,
			'validate' 	  => '',
			'output'	  => array( 'background-color' => '#blog-list .post a.img-post .actions, #blog-squares .post a.img-post .actions, .blog .post a.img-post .actions, #blog-new-masonry .overlay-masonry'),
			'subtitle'  => __( 'Define the color and transparency level of the overlay background color on hover.', 'BERG' ),  
		),

		array(
			'id' => 'navigation_divide',
			'type' => 'divide',
			'title' => __('Navigation', 'BERG')
		),


		array(
			'id' => 'navigation_text_color',
			'type' => 'button_set',
			'title' => __( 'Navigation text color & logo version', 'BERG' ),
			'subtitle' => __('Select logo and color for links in navigation. Default value - if intro section is present it will take light colors.', 'BERG'),
			'options'  => array(
				'default' => __('Default', 'BERG'),
				'light' => __( 'Light', 'BERG' ),
				'dark' => __( 'Dark', 'BERG' ),
			),
			'default' => 'default',
			'required' => array('navigation_type', '=', '2')
		),

		array(
			'id' => 'nav_settings',
			'type' => 'button_set',
			'title' => __( 'Open / Close navigation', 'BERG' ),
			'options'  => array(
				'default' => __('Default', 'BERG'),
				'show' => __( 'Open', 'BERG' ),
				'close' => __( 'Close', 'BERG' ),
			),
			'default' => 'default',
			'required' => array('navigation_type', '=', '1')
		),

		// array(
		// 	'id' => 'nav_position',
		// 	'type' => 'button_set',
		// 	'title' => __('Navigation position', 'BERG'),
		// 	'options' => array(
		// 		'top' => __('Top', 'BERG'),
		// 		'center' => __('Center', 'BERG')
		// 	),
		// 	'default' => 'top',
		// 	'required' => array('navigation_type', '=', '1')
		// ),

		array(
			'id' => 'nav_transparent',
			'type' => 'select',
			'options' => array(
				'default' => __('Default', 'BERG'),
				'10' => '10',
				'20' => '20',
				'30' => '30',
				'40' => '40',
				'50' => '50',
				'60' => '60',
				'70' => '70',
				'80' => '80',
				'90' => '90',
				'100' => '100',
			),
			'title' => __('Navigation background opacity', 'BERG'),
			'subtitle' => __('(opacity 0 - solid color, opacity 100 - transparent)', 'BERG'),
			'required' => array('navigation_type', '=', '1'),
			'default' => 'default',
			'select2'  => array( 'allowClear' => false ),
		),


		array(
			'id' => 'intro_divide',
			'type' => 'divide',
			'title' => __('Intro section', 'BERG'),
		),

		array(
			'id' => 'section_intro',
			'type' => 'select',
			'options' => array(
				'default' => __('Default', 'BERG'),
				'section_intro_1' => __('No intro', 'BERG'),
				'section_intro_2' => __('Fullscreen intro', 'BERG'),
				'section_intro_3' => __('Half screen intro', 'BERG'),
				'section_intro_4' => __('Custom height', 'BERG'),
			),
			'title' => __('Intro type', 'BERG'),
			'default' => 'default',
			'select2'  => array( 'allowClear' => false ),
		),

		array(
			'id' => 'section_intro_custom_height',
			'type' => 'text',
			'title' => __('Intro height in px', 'BERG'),
			'default' => '300',
			'required' => array('section_intro', '=', 'section_intro_4'),
		),
		array(
			'id' => 'intro_opacity',
			'type' => 'select',
			'options' => array(
				'default' => __('Default', 'BERG'),
				'0' => '0',
				'10' => '10',
				'20' => '20',
				'30' => '30',
				'40' => '40',
				'50' => '50',
				'60' => '60',
				'70' => '70',
				'80' => '80',
				'90' => '90',
				'100' => '100',
			),
			'default' => 'default',
			'title' => __('Start opacity', 'BERG'),
			'subtitle' => __('(opacity 0 solid color - , opacity 100 - transparent)', 'BERG'),
			'select2'  => array( 'allowClear' => false ),
		),
		array(
			'id' => 'intro_opacity_end',
			'type' => 'select',
			'options' => array(
				'default' => __('Default', 'BERG'),
				'0' => '0',
				'10' => '10',
				'20' => '20',
				'30' => '30',
				'40' => '40',
				'50' => '50',
				'60' => '60',
				'70' => '70',
				'80' => '80',
				'90' => '90',
				'100' => '100',
			),
			'title' => __('End opacity', 'BERG'),
			'default' => 'default',
			'subtitle' => __('(opacity 0 - solid color, opacity 100 - transparent)', 'BERG'),
			'select2'  => array( 'allowClear' => false ),
		),
		array(
			'id' => 'intro_color',
			'type' => 'color',
			'title' => __('Intro overlay color', 'BERG'),
			'validate' => '',
			'transparent' => false,
			'default' => '#000',
		),
		array(
			'id' => 'intro_txt_position',
			'type' => 'select',
			'title' => __('Content alignment', 'BERG'),
			'options' => array(
				'default' => __('Default', 'BERG'),
				'left' => __('Left', 'BERG'),
				'center' => __('Center', 'BERG'),
				'right' => __('Right', 'BERG'),
			),
			'default' => 'default',
			'select2'  => array( 'allowClear' => false ),
		), 

		array(
			'id' => 'intro_settings',
			'type' => 'text',
			'title' => __('Intro title', 'BERG')
		),

		array(
			'id' => 'intro_content_settings',
			'type' => 'editor',
			'title' => __('Intro content', 'BERG'),
			'args' => $tinymceArgs,
		),

		array(
			'id' => 'footer_divide',
			'type' => 'divide',
			'title' => __('Footer', 'BERG'),
		),
		array(
			'id' => 'section_footer',
			'type' => 'button_set',
			'title' => __( 'Enable / Disable footer', 'BERG' ),
			'options'  => array(
				'default' => __('Default', 'BERG'),
				'enabled' => __( 'Enabled', 'BERG' ),
				'disabled' => __( 'Disabled', 'BERG' ),
			),
			'default' => 'default',
		),
	)
);