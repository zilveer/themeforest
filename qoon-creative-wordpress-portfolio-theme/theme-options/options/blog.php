<?php

$sections[] = array(
	'title' => __('Blog', "qoon-creative-wordpress-portfolio-theme"),
	'header' => '',
	'desc' => '',
	'icon_class' => 'icon-small',
    'icon' => 'el el-website',

		'fields' => array(
			
			array(         
				'id'       => 'oi_blog_home',
				'type'     => 'background',
				'compiler'    => array('#oi_current_image'),
				'title'    => __('Left Side Background', 'qoon-creative-wordpress-portfolio-theme'),
				'subtitle' => __('Left Side background with image, color, etc.', 'qoon-creative-wordpress-portfolio-theme'),
				'required' => array('site-layout','=','left-menu'),
				'default'  => array(
					'background-color' => '#ddd',
				)
			),
		
			array(
				'id'       => 'blog_style',
				'type'     => 'select',
				'compiler' => true,
				'title'    => __('Blog Posts Style', 'qoon-creative-wordpress-portfolio-theme'), 
				'options'  => array(
					'creative' => 'creative',
					'standard' => 'standard',
					'masonry' => 'masonry',
				),
				'default'  => 'creative',
			),
			
			$fields = array(
			'id'             => 'oi_standrad-post-margin',
			'type'           => 'spacing',
			'compiler'         => array('.oi_layout_standard .oi_posts_ul li.oi_format_will_be_standard'),
			'mode'           => 'margin',
			'required' => array('blog_style','equals','standard'),
			'units'          => 'px',
			'units_extended' => 'false',
			'title'          => __('Posts Margin', 'qoon-creative-wordpress-portfolio-theme'),
			'default'            => array(
				'margin-top'     => '0px',
				'margin-right'   => '0px', 
				'margin-bottom'  => '0px', 
				'margin-left'    => '0px',
				'units'          => 'px', 
			)
		),
			
			
			
			$fields = array(
				'id'          => 'oi_blog-title-typography',
				'type'        => 'typography', 
				'title'       => __('Blog Post Title Typography', 'qoon-creative-wordpress-portfolio-theme'),
				'google'      => true, 
				'compiler'    => array('.blog_title_a'),
				'letter-spacing'=> true,
				'text-transform'=> true,
				'font-backup' => true,
				'units'       =>'px',
				'default'     => array(
					'color'       => '#000', 
					'font-style'  => '400', 
					'font-family' => 'Raleway', 
					'google'      => true,
					'font-size'   => '18px', 
					'line-height' => '24px',
					'letter-spacing'=> '0px'
				),
			),
			
		
		array(
			'id'       => 'oi_cats_show',
			'type'     => 'switch', 
			'title'    => __('Show Categories?', 'qoon-creative-wordpress-portfolio-theme'),
			'on'     => 'Yes', 
			'off'     => 'No', 
			'default'  => true,
		),
		array(
			'id'               => 'oi_cats-number',
			'type'             => 'text',
			'compiler'         => true,
			'title'            => __('Amount of categories', 'qoon-creative-wordpress-portfolio-theme'), 
			'default'          => '3',
		),
		
		$fields = array(
			'id'          => 'oi_cats-typography',
			'type'        => 'typography', 
			'title'       => __('Categories Typography', 'qoon-creative-wordpress-portfolio-theme'),
			'google'      => true, 
			'compiler'    => array('.oi_list_cats  li > a'),
			'letter-spacing'=> true,
			'text-transform'=> true,
			'font-backup' => true,
			'units'       =>'px',
			'default'     => array(
				'color'       => '#000', 
				'font-style'  => '400', 
				'font-family' => 'Lato', 
				'google'      => true,
				'font-size'   => '12px', 
				'line-height' => '22px',
				'letter-spacing'=> '1px'
			),
		),
		
		
		
		$fields = array(
			'id'             => 'oi_cats-menu-menu-padding',
			'type'           => 'spacing',
			'compiler'         => array('.oi_list_cats  li > a'),
			'mode'           => 'padding',
			'units'          => 'px',
			'units_extended' => 'false',
			'title'          => __('Categories Items Padding', 'qoon-creative-wordpress-portfolio-theme'),
			'default'            => array(
				'padding-top'     => '5px', 
				'padding-right'   => '10px', 
				'padding-bottom'  => '5px', 
				'padding-left'    => '10px',
				'units'          => 'px', 
			)
		),
		
		$fields = array(
			'id'             => 'oi_cats-menu-menu-margins',
			'type'           => 'spacing',
			'compiler'         => array('.oi_list_cats li > a'),
			'mode'           => 'margin',
			'units'          => 'px',
			'units_extended' => 'false',
			'title'          => __('Categories Items Margins', 'qoon-creative-wordpress-portfolio-theme'),
			'default'            => array(
				'margin-top'     => '0px',
				'margin-right'   => '10px', 
				'margin-bottom'  => '0px', 
				'margin-left'    => '10px',
				'units'          => 'px', 
			)
		),
				
		
		$fields = array(
			'id'       => 'oi_cats-menu-menu',
			'type'     => 'link_color',
			'compiler'         => array('.oi_list_cats li > a'),
			'title'    => __('Categories Items color', 'qoon-creative-wordpress-portfolio-theme'),
			'default'  => array(
				'regular'  => '#000',
				'hover'    => '#000',
				'active'   => '#000',
			)
		),
		
		$fields = array(
			'id'       => 'oi_cats-menu-menu-li-a-bg',
			'type'     => 'link_color',
			'compiler'         => true,
			'title'    => __('Categories Items background', 'qoon-creative-wordpress-portfolio-theme'),
			'default'  => array(
				'regular'  => '#fff',
				'hover'    => '#F1F1F1',
				'active'   => '#ffde00',
			)
		),
		
		$fields = array( 
			'id'       => 'oi_cats-menu-border-standard',
			'type'     => 'border',
			'all' => false,
			'title'    => __('Categories Item Border', 'qoon-creative-wordpress-portfolio-theme'),
			'compiler'         => array('.oi_list_cats li > a'),
			'default'  => array(
				'border-color'  => '#ffffff', 
				'border-style'  => 'none', 
				'border-top'    => '0px', 
				'border-right'  => '0px', 
				'border-bottom' => '0px', 
				'border-left'   => '0px'
			)
		),
		
		
		$fields = array( 
			'id'       => 'oi_cats-menu-border-hover',
			'type'     => 'border',
			'all' => false,
			'title'    => __('Border On Hover', 'qoon-creative-wordpress-portfolio-theme'),
			'compiler'         => true,
			'default'  => array(
				'border-color'  => '#ffffff', 
				'border-style'  => 'none', 
				'border-top'    => '0px', 
				'border-right'  => '0px', 
				'border-bottom' => '0px', 
				'border-left'   => '0px'
			)
		),
		
		$fields = array( 
			'id'       => 'oi_cats-menu-border-active',
			'type'     => 'border',
			'all' => false,
			'title'    => __('Border Active Element', 'qoon-creative-wordpress-portfolio-theme'),
			'compiler'         => true,
			'default'  => array(
				'border-color'  => '#ffffff', 
				'border-style'  => 'none', 
				'border-top'    => '0px', 
				'border-right'  => '0px', 
				'border-bottom' => '0px', 
				'border-left'   => '0px'
			)
		),
		
		
			
		array(
			'id'       => 'cats-position',
			'type'     => 'select',
			'compiler' => true,
			'title'    => __('Blog Categories Position', 'qoon-creative-wordpress-portfolio-theme'), 
			'options'  => array(
				'left' => 'left',
				'center' => 'center',
				'right' => 'right'
			),
			'default'  => 'center',
		),
		
		array(
			'id'               => 'oi_cats-marginss',
			'type'             => 'text',
			'compiler'         => true,
			'title'            => __('Space between Blog Categories and borderline', 'qoon-creative-wordpress-portfolio-theme'), 
			'default'          => '30px',
		),
		array(
			'id'               => 'oi_cats-width',
			'type'             => 'text',
			'compiler'         => true,
			'title'            => __('Blog Categories borderline width', 'qoon-creative-wordpress-portfolio-theme'), 
			'default'          => '60%',
		),
		array(
			'id'       => 'oi_cats-color',
			'type'     => 'color',
			'compiler'         => true,
			'title'    => __('Categories borderline color', 'qoon-creative-wordpress-portfolio-theme'), 
			'subtitle' => __('default: #ccc', 'qoon-creative-wordpress-portfolio-theme'),
			'default'  => '#ccc',
			'validate' => 'color',
		
		),
		
		array(
			'id'       => 'pagination-position',
			'type'     => 'select',
			'compiler' => true,
			'title'    => __('Paginations Position', 'qoon-creative-wordpress-portfolio-theme'), 
			'options'  => array(
				'left' => 'left',
				'center' => 'center',
				'right' => 'right'
			),
			'default'  => 'center',
		),
		
		array(
			'id'               => 'oi_pagination-marginss',
			'type'             => 'text',
			'compiler'         => true,
			'title'            => __('Space between Pagination and borderline', 'qoon-creative-wordpress-portfolio-theme'), 
			'default'          => '30px',
		),
		array(
			'id'               => 'oi_pagination-width',
			'type'             => 'text',
			'compiler'         => true,
			'title'            => __('Pagination borderline width', 'qoon-creative-wordpress-portfolio-theme'), 
			'default'          => '60%',
		),
		array(
			'id'       => 'oi_pagination-color',
			'type'     => 'color',
			'compiler'         => true,
			'title'    => __('Pagination borderline color', 'qoon-creative-wordpress-portfolio-theme'), 
			'subtitle' => __('default: #ccc', 'qoon-creative-wordpress-portfolio-theme'),
			'default'  => '#ccc',
			'validate' => 'color',
		
		),
		array(
			'id'       => 'oi_empty_pag',
			'type'     => 'switch',
			'compiler'    => true, 
			'title'    => __('Hide Emmty Pagination?', 'qoon-creative-wordpress-portfolio-theme'),
			'on'     => 'Yes', 
			'off'     => 'No', 
			'default'  => false,
		)	
			
			
			
				
	),	
);