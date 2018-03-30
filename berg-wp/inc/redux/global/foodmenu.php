<?php

return array(
	'icon'   => 'el el-list-alt',
	'title'  => __( 'Food menu', 'BERG' ),
	'fields' => array(
		array(
  			'id' => 'berg_food_menu_filters',
			'type' => 'switch',
			'title' => __('Category filters', 'BERG'),
			'on'		=> 'On',
			'off'		=> 'Off',
			'default' => true,
  		),
		// array(
		// 	'id' 	 => 'woocommerce_display_image_section_start',
		// 	'type' 	 => 'section',
		// 	'indent' => true
		// ),
  		array(
			'id' => 'food_menu_sticky_category',
			'type' => 'switch',
			'title' => __('Sticky filters', 'BERG'),
			'on'		=> 'On',
			'off'		=> 'Off',
			'default' => false,
			'required' => array('berg_food_menu_filters','=', true),
			// 'htmlOptions' => array()
		),
		// array(
		// 	'id' 	 => 'woocommerce_display_image_section_end',
		// 	'type' 	 => 'section',
		// 	'indent' => false
		// ),
		array(
  			'id' => 'berg_food_menu_links',
			'type' => 'switch',
			'title' => __('Food title link', 'BERG'),
			'subtitle' => __('Food title links to a single product', 'BERG'),
			'on'		=> 'On',
			'off'		=> 'Off',
			'default' => true,
  		),
		// array(
		// 	'id' => 'berg_food_menu_categories',
		// 	'title' => __('Categories on single product page', 'BERG'),
		// 	'type' => 'switch',
		// 	'on'		=> 'On',
		// 	'off'		=> 'Off',
		// 	'default' => true,
		// ),
		array(
  			'id' => 'berg_food_menu_badge',
			'type' => 'switch',
			'title' => __('Icons & badges on archive', 'BERG'),
			'on'		=> 'On',
			'off'		=> 'Off',
			'default' => true,
  		),
		array(
			'id' => 'berg_food_menu_socials',
			'title' => __('Social share on single product page', 'BERG'),
			'type' => 'switch',
			'on'		=> 'On',
			'off'		=> 'Off',
			'default' => true,
		),
		array(
		    'id'   =>'berg_food_menu_list_divide',
		    'title' => __('List template', 'BERG'),
		    'type' => 'divide'
		),
		array(
			'id' => 'food_menu_show_items_full_text',
			'type' => 'switch',
			'title' => __('Full description on archive', 'BERG'),
			'subtitle' => __('Shows full product description instead of excerpt', 'BERG'),
			'on'		=> 'On',
			'off'		=> 'Off',
			'default' => false,
			// 'htmlOptions' => array()
		),
		array(
		    'id'   =>'berg_food_menu_squares_img_divide',
		    'title' => __('Squares with images template', 'BERG'),
		    'type' => 'divide'
		),
		array(
			'id' => 'berg_food_menu_squares_open',
			'type' => 'select',
			'title' => __('Click on image action', 'BERG'),
			// 'desc' => __('', 'BERG'),
			'options' => array(
				'open_overlay' => __('Open large image', 'BERG'),
				'open_post' => __('Open single product page', 'BERG'),
				'none' => __('Do nothing', 'BERG'),
			),
			'default' => 'open_overlay', 
			'select2' => array( 'allowClear' => false )
  		),
  		array(
			'id' => 'berg_food_menu_squares_columns',
			'type' => 'select',
			'title' => __('Number of columns', 'BERG'),
			'options' => array(
				'two_columns' => __('Two columns', 'BERG'),
				'three_columns' => __('Three columns', 'BERG'),
			),
			'default' => 'two_columns', 
			'select2' => array( 'allowClear' => false )
  		),
		// array(
		//     'id'   =>'berg_food_menu_squares_divide',
		//     'title' => __('Squares without images template', 'BERG'),
		//     'type' => 'divide'
		// ),
		
	)
);