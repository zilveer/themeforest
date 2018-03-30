<?php

return array(
	'icon'   => 'el el-th',
	'title'  => __( 'Portfolio', 'BERG' ),
	'fields' => array(
		array(
			'id' => 'berg_images_per_page',
			'type' => 'text',
			'title' => __('Items per page', 'BERG'),
			'default' => 9
		),
		array(
			'id' => 'berg_single_portfolio',
			'type' => 'select',
			'title' => __('Single portfolio version', 'BERG'),
			'subtitle' => __('Define how your single portfolio looks like', 'BERG'),
			'options' => array(
				'open_overlay' => __('Overlay', 'BERG'),
				'open_post' => __('Single post', 'BERG'),
			),
			'default' => 'open_overlay',
			'select2' => array( 'allowClear' => false )
  		),
  		array(
			'id' => 'berg_single_portfolio_desc',
			'type' => 'switch',
			'title' => __('Single portfolio description', 'BERG'),
			'on'		=> 'On',
			'off'		=> 'Off',
			'default' => true,
			// 'required' => array('berg_single_portfolio','!=', ''),
  		),
  		array(
  			'id' => 'berg_portfolio_filters',
			'type' => 'switch',
			'title' => __('Filters', 'BERG'),
			'on'		=> 'On',
			'off'		=> 'Off',
			'default' => true,
			'class'    => 'hidden',	
  		),
  		array(
  			'id' => 'berg_portfolio_categories',
			'type' => 'switch',
			'title' => __('Categories', 'BERG'),
			'on'		=> 'On',
			'off'		=> 'Off',
			'default' => true,
			'class'    => 'hidden',	
  		),
  		array(
			'id'    	  => 'berg_portfolio_overlay',
			'type'  	  => 'color',
			'title'    	  => __( 'Overlay color', 'BERG' ),
			'default' 	  => 'rgba(0,0,0,0.6)',
			'transparent' => true,
			'validate' 	  => '',
			'subtitle'  => __( 'Define the color and transparency level of the overlay background color on hover.', 'BERG' ),  
			'class'    => 'hidden',	
		),
		array(
			'id'    	  => 'berg_portfolio_txt_color',
			'type'  	  => 'color',
			'title'    	  => __( 'Hover text color', 'BERG' ),
			'default' 	  => 'rgba(255,255,255,1)',
			'transparent' => false,
			'validate' 	  => '',
			'output'	=> array('color' => '.portfolio-content .entry-title, .gallery-content .portfolio-content .portfolio-categories li a, #gallery2 .portfolio-categories li a, .portfolio-content .dot-separator', 'border-color' => '.portfolio-content .wavy-separator span, .portfolio-content .wavy-separator span:after'),
			'subtitle'  => __( 'Define the text color on hover.', 'BERG' ),  
			'class'    => 'hidden',	
		),
		array(
		    'id'   =>'berg_portfolio_grid_divide',
		    'title' => __('Portfolio grid template', 'BERG'),
		    'type' => 'divide',
		    'class'    => 'hidden',	
		),
		array(
			'id' => 'berg_column_count',
			'title'   => __( 'Number of columns', 'BERG' ),
			'type' 	  => 'select',
			'options' => array(
				'two-columns' 	 => '2',
				'three-columns' => '3',
				'four-columns'  => '4',
			),
			'class'    => 'hidden',	
			// 'desc' => __('applies ONLY to page with Portfolio Grid Template assigned to it', 'BERG'),
			'default' => 'three-columns',
			'select2' => array( 'allowClear' => false )
		),
		array(
		    'id'   =>'berg_portfolio_masonry_divide',
		    'title' => __('Portfolio masonry template', 'BERG'),
		    'class'    => 'hidden',	
		    'type' => 'divide'
		),
		array(
			'id' => 'berg_masonry_layout',
			'type' => 'textarea',
			'desc' 	=> __( 'Write your custom layout loop. Use values: 1 - square, 2 - wide rectangle, 3 - tall rectangle, 4 - large square. Separate values with comma, i.e. 1,1,2,1,1,3', 'BERG'),
			'title' => __('Masonry layout', 'BERG'),
			'default' => "",
			'class'    => 'hidden',	
		),
	)
);