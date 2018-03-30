<?php

add_filter( 'rwmb_meta_boxes', 'swm_register_custom_meta_boxes' );

/**
 * Register meta boxes
 *
 * @return void
 */
function swm_register_custom_meta_boxes( $meta_boxes )
{
	
	$prefix = 'swm_';

	// Background Repeat
	$swm_background_repeat = array(
		"repeat" => __( 'Repeat', 'swmtranslate' ),
		"no-repeat" => __( 'No-Repeat', 'swmtranslate' ),
		"repeat-x" => __( 'Repeat-X', 'swmtranslate' ),
		"repeat-y" => __( 'Repeat-Y', 'swmtranslate' )		
	);

	// Background Position
	$swm_alignment = array(
		"left-top" 		=> __( 'Left Top', 'swmtranslate' ),
		"left-center" 	=> __( 'Left Center', 'swmtranslate' ),
		"left-bottom" 	=> __( 'Left Bottom', 'swmtranslate' ),
		"right-top" 	=> __( 'Right Top', 'swmtranslate' ),
		"right-center" 	=> __( 'Right Center', 'swmtranslate' ),
		"right-bottom" 	=> __( 'Right Bottom', 'swmtranslate' ),
		"center-top" 	=> __( 'Center Top', 'swmtranslate' ),
		"center-center" => __( 'Center Center', 'swmtranslate' ),
		"center-bottom" => __( 'Center Bottom', 'swmtranslate' )
	);

	// Page Layout
	$swm_page_layout = array(
		"layout-sidebar-right" => __( 'Sidebar Right', 'swmtranslate' ),
		"layout-sidebar-left" => __( 'Sidebar Left', 'swmtranslate' ),
		"layout-full-width" => __( 'Full Width', 'swmtranslate' )
	);	

	// Page Layout
	$swm_background_attachment = array(
		"scroll" => __( 'Scroll', 'swmtranslate' ),
		"fixed" => __( 'Fixed', 'swmtranslate' )	
	);



/* *********************************************************
	PORTFOLIO PAGE OPTIONS
********************************************************** */

	$meta_boxes[] = array(
		'id' => 'swm_portfolio_page_image_header',	
		'title' => __('Portfolio Page Options', 'swmtranslate'),	
		'pages' => array(		
			'page'
		),
		'context' => 'normal',	
		'priority' => 'high',
		'autosave' => true,	
		'fields' => array(	
			array(
					'name' => __('Portfolio Type', 'swmtranslate'),
					'desc' => __('Select Portfolio type', 'swmtranslate'),
					'id' => "{$prefix}portfolio_page_type",
					'type' => 'select',			
					'std' => 'Sortable_Portfolio_with_Hover_Text',
					'options'  => array(
						'Sortable_Portfolio' => __('Sortable Portfolio', 'swmtranslate'),					
						'Classic_Portfolio' => __('Classic Portfolio', 'swmtranslate'),					
					),				
				),		
			array(
				'name' => __('Portfolio Column', 'swmtranslate'),
				'desc' => __('Select portfolio display column', 'swmtranslate'),
				'id' => "{$prefix}pf_display_column",
				'type' => 'select',			
				'std' => '4',
				'options'  => array(
					'2' => __('2 Column Portfolio', 'swmtranslate'),
					'3' => __('3 Column Portfolio', 'swmtranslate'),
					'4' => __('4 Column Portfolio', 'swmtranslate'),				
				),				
			),
			array(
				'name' => __('Exclude Portfolio Categories', 'swmtranslate'),
				'desc' => __('Checked categories will be excluded from page display.', 'swmtranslate'),		
				'id' => "{$prefix}exclude_pf_categories",
				'type' => 'taxonomy',			
				'options' => array(
					'taxonomy' => 'portfolio-categories',			
					'type' => 'checkbox_tree',					
					'args' => array()					
				)		
			),		
			array( 
				'name' => __('Display Portfolio Title Section', 'swmtranslate'),
				'desc' => __('Enable portfolio item title and excerpt/categories section.', 'swmtranslate'),
				'id' => "{$prefix}onoff_page_title_section",
				'std' => "1",
				"type" => "checkbox",
			),
			array( 
				'name' => __('Portfolio Item Title Font Size', 'swmtranslate'),
				'desc' => __('Enter portfolio title text font size <br />( only enter number e.g. 14  ) ', 'swmtranslate'),
				'id' => "{$prefix}pf_title_font_size",
				'std' => "14",			
				"type" => "text"
			),
			array(
				'name' => __('Portfolio Item Title Font Weight', 'swmtranslate'),
				'desc' => __('Select portfolio display column', 'swmtranslate'),
				'id' => "{$prefix}pf_title_font_weight",
				'type' => 'select',			
				'std' => 'standard',
				'options'  => array(
					"normal" => __( 'Normal', 'swmtranslate' ),
				    "bold" => __( 'Bold', 'swmtranslate' )	
				),				
			),
			array( 
				'name' => __('Add link on Portfolio Title Text', 'swmtranslate'),
				'desc' => __('Enable permalink on portfolio title text', 'swmtranslate'),
				'id' => "{$prefix}pf_item_title_link",
				'std' => "1",
				"type" => "checkbox",
			),	
			array(
				'name' => __('Display Excerpt or Category Names', 'swmtranslate'),
				'desc' => __('Select portfolio sort description text type or hide it', 'swmtranslate'),
				'id' => "{$prefix}pf_display_excerpt_category",
				'type' => 'select',			
				'std' => 'Display_Expert',
				'options'  => array(
					'Display_Excerpt' => __('Display Excerpt Text', 'swmtranslate'),
					'Display_Category_Names' => __('Display Category Names', 'swmtranslate'),					
					'Hide_Excerpt' => __('Hide Excerpt Text or Category Names', 'swmtranslate'),
				),				
			),
			array( 
				'name' => __('Portfolio Item Excerpt Font Size', 'swmtranslate'),
				'desc' => __('Enter portfolio sort description text font size <br />( only enter number e.g. 11  ) ', 'swmtranslate'),
				'id' => "{$prefix}pf_excerpt_font_size",
				'std' => "12",			
				"type" => "text"
			),	
			array( 
				'name' => __('Display Read more link', 'swmtranslate'),
				'desc' => __('Enable read more link', 'swmtranslate'),
				'id' => "{$prefix}onoff_pf_readmore",
				'std' => "1",
				"type" => "checkbox",
			),					
			array( 
				'name' => __('Display Images/Videos on Lightbox', 'swmtranslate'),
				'desc' => __('Enable lightbox feature (open large image in popup). If disable then link image to portfolio single page', 'swmtranslate'),
				'id' => "{$prefix}onoff_pf_prettyphoto",
				'std' => "1",
				"type" => "checkbox",
			),
			array(
				'name' => __('Pagination Style Column', 'swmtranslate'),
				'desc' => __('Select portfolio display column', 'swmtranslate'),
				'id' => "{$prefix}pf_pagination_style",
				'type' => 'select',			
				'std' => 'standard',
				'options'  => array(
					"standard" => __( 'Standard', 'swmtranslate' ),
				    "next-prev" => __( 'Next - Previous', 'swmtranslate' ),        
				    "infinite-scroll" => __( 'Infinite Scroll', 'swmtranslate' )	
				),				
			),		
			array( 
				'name' => __('Pagination', 'swmtranslate'),
				'desc' => __('Add number to display portfolio items per page e.g. 12', 'swmtranslate'),
				'id' => "{$prefix}pf_items_pagination",
				'std' => "12",			
				"type" => "text",
			)		
		)

	);


/* *********************************************************
	TESTIMONIALS PAGE
********************************************************** */

	$meta_boxes[] = array(
		'id' => 'swm_testimonials_page',
		'title' => __('Testimonials Page Options', 'swmtranslate'),
		'pages' => array(		
			'page'
		),	
		'context' => 'normal',	
		'autosave' => true,
		'priority' => 'high',	
		'fields' => array(	
			array(
				'name'     => __('Testimonials Display Column', 'swmtranslate'),
				'desc' => __('Select Testimonials Style', 'swmtranslate'),
				'id'       => "{$prefix}testimonial_column",
				'type'     => 'select',
				'my_class' => 'swm_divider_line',
				'std' => 'one_third',			
				'options'  => array(
					"1" => __('1 Column', 'swmtranslate'),
					"2" => __('2 Column', 'swmtranslate'),
					"3" => __('3 Column', 'swmtranslate'),
					"4" => __('4 Column', 'swmtranslate')
				),
			),	
			array(
				'name' => __('Pagination Style', 'swmtranslate'),
				'id' => "{$prefix}testimonials_pagination_style",
				'type' => 'select',			
				'std' => 'standard',
				'options'  => array(
					"standard" => __( 'Standard', 'swmtranslate' ),
				    "next-prev" => __( 'Next - Previous', 'swmtranslate' ),        
				    "infinite-scroll" => __( 'Infinite Scroll', 'swmtranslate' )	
				),				
			),					
			array(
				'name' => __('Display Testimonials per page', 'swmtranslate'),
				'desc' => __('Add number to display testimonials items per page e.g. 12', 'swmtranslate'),
				'id' => "{$prefix}testimonials_pagination",
				'type' => 'text',
				'std' => '6'
			),
			array(
				'name' => __('Exclude Testimonials Categories', 'swmtranslate'),
				'desc' => __('Checked categories will be excluded from page display.', 'swmtranslate'),		
				'id' => "{$prefix}exclude_testimonials_categories",
				'type' => 'taxonomy',			
				'options' => array(
					'taxonomy' => 'testimonials-categories',			
					'type' => 'checkbox_tree',					
					'args' => array()					
				)		
			),
			array( 
					'name' => __('Display Sortable Horizontal Menu', 'swmtranslate'),
					'desc' => __('Enable Sortable Menu', 'swmtranslate'),
					'id' => "{$prefix}enable_testimonials_h_menu",
					'std' => "1",
					"type" => "checkbox",
				),	
		)

	);



/* *********************************************************
	ARCHIVES PAGE
********************************************************** */

	$meta_boxes[] = array(
		'id' => 'swm_archives_page',
		'autosave' => true,	
		'title' => __('Archives Page Options', 'swmtranslate'),
		'pages' => array(		
			'page'
		),	
		'context' => 'normal',	
		'priority' => 'high',
		
		'fields' => array(	
			array(
				'name' => __('Display Latest Posts', 'swmtranslate'),
				'desc' => __('Add number to display latest blog posts in the table e.g. 12', 'swmtranslate'),
				'id' => "{$prefix}archives_pagination",
				'type' => 'text',
				'std' => '12'
			),
			array( 
				'name' => __('Display Archives by Month', 'swmtranslate'),
				'desc' => __('Enable archives by months list.', 'swmtranslate'),
				'id' => "{$prefix}onoff_archives_month",
				'std' => "1",
				"type" => "checkbox",
			),			
			array( 
				'name' => __('Display Archives by Categories', 'swmtranslate'),
				'desc' => __('Enable archives by categories list.', 'swmtranslate'),
				'id' => "{$prefix}onoff_archives_categories",
				'std' => "1",
				"type" => "checkbox",
			)
		)

	);


/* *********************************************************
	CAUSE PAGE OPTIONS
********************************************************** */

	$meta_boxes[] = array(
		'id' => 'swm_cause_page',	
		'title' => __('Cause Page Options', 'swmtranslate'),	
		'pages' => array(		
			'page'
		),
		'context' => 'normal',	
		'priority' => 'high',
		'autosave' => true,	
		'fields' => array(			
			array(
				'name' => __('Cause List Style', 'swmtranslate'),
				'desc' => __('Select cause display style', 'swmtranslate'),
				'id' => "{$prefix}cause_display_style",
				'type' => 'select',			
				'std' => 'cause_grid',
				'options'  => array(
					'cause_grid' => __('Grid List', 'swmtranslate'),
					'cause_horizontal' => __('Horizontal List', 'swmtranslate')							
				),				
			),
			array(
				'name' => __('Exclude Cause Categories', 'swmtranslate'),
				'desc' => __('Checked categories will be excluded from page display.', 'swmtranslate'),		
				'id' => "{$prefix}exclude_cause_categories",
				'type' => 'taxonomy',			
				'options' => array(
					'taxonomy' => 'cause-categories',			
					'type' => 'checkbox_tree',					
					'args' => array()					
				)		
			),
			array( 
				'name' => __('Display Sortable Menu', 'swmtranslate'),
				'desc' => __('Enable sortable horizontal menu', 'swmtranslate'),
				'id' => "{$prefix}onoff_cause_sortable_menu",
				'std' => "1",
				"type" => "checkbox",
			),				
			array( 
				'name' => __('Display Read more link', 'swmtranslate'),
				'desc' => __('Enable read more link', 'swmtranslate'),
				'id' => "{$prefix}onoff_cause_readmore",
				'std' => "1",
				"type" => "checkbox",
			),			
			array(
				'name' => __('Pagination Style', 'swmtranslate'),				
				'id' => "{$prefix}cause_pagination_style",
				'type' => 'select',			
				'std' => 'standard',
				'options'  => array(
					"standard" => __( 'Standard', 'swmtranslate' ),
				    "next-prev" => __( 'Next - Previous', 'swmtranslate' ),        
				    "infinite-scroll" => __( 'Infinite Scroll', 'swmtranslate' )	
				),				
			),		
			array( 
				'name' => __('Pagination', 'swmtranslate'),
				'desc' => __('Add number to display Cause items per page e.g. 12', 'swmtranslate'),
				'id' => "{$prefix}cause_items_pagination",
				'std' => "12",			
				"type" => "text",
			)		
		)

	);

/* *********************************************************
	SERMONS PAGE OPTIONS
********************************************************** */

	$meta_boxes[] = array(
		'id' => 'swm_sermons_page',	
		'title' => __('Sermons Page Options', 'swmtranslate'),	
		'pages' => array(		
			'page'
		),
		'context' => 'normal',	
		'priority' => 'high',
		'autosave' => true,	
		'fields' => array(			
			array(
				'name' => __('Exclude Sermons Categories', 'swmtranslate'),
				'desc' => __('Checked categories will be excluded from page display.', 'swmtranslate'),		
				'id' => "{$prefix}exclude_sermons_categories",
				'type' => 'taxonomy',			
				'options' => array(
					'taxonomy' => 'sermons-categories',			
					'type' => 'checkbox_tree',					
					'args' => array()					
				)		
			),
			array( 
				'name' => __('Display Sortable Menu', 'swmtranslate'),
				'desc' => __('Enable sortable horizontal menu', 'swmtranslate'),
				'id' => "{$prefix}onoff_sermons_sortable_menu",
				'std' => "1",
				"type" => "checkbox",
			),				
			array( 
				'name' => __('Display Read more link', 'swmtranslate'),
				'desc' => __('Enable read more link', 'swmtranslate'),
				'id' => "{$prefix}onoff_sermons_readmore",
				'std' => "1",
				"type" => "checkbox",
			),			
			array(
				'name' => __('Pagination Style', 'swmtranslate'),				
				'id' => "{$prefix}sermons_pagination_style",
				'type' => 'select',			
				'std' => 'standard',
				'options'  => array(
					"standard" => __( 'Standard', 'swmtranslate' ),
				    "next-prev" => __( 'Next - Previous', 'swmtranslate' ),        
				    "infinite-scroll" => __( 'Infinite Scroll', 'swmtranslate' )	
				),				
			),		
			array( 
				'name' => __('Pagination', 'swmtranslate'),
				'desc' => __('Add number to display Sermons items per page e.g. 12', 'swmtranslate'),
				'id' => "{$prefix}sermons_items_pagination",
				'std' => "12",			
				"type" => "text",
			)		
		)

	);



/* *********************************************************
	POST OPTIONS
********************************************************** */

	$meta_boxes[] = array(
		'id' => 'swm-post-meta-box',
		'title' =>  __('Post Options', 'swmtranslate'),
		'pages' => array('post'),	
		'context' => 'normal',	
		'priority' => 'high',	
		'autosave' => true,	
		'fields' => array(					
			array( "name" => __('Add YouTube/Vimeo video embed or embedded code','swmtranslate'),
					'desc' => __('Default embed video width - 616', 'swmtranslate'),
					"id" => "{$prefix}meta_video",
					"type" => "textarea",
					'my_class' => 'swm_divider_line',
					"std" => ''
			)
		)
	);

	$meta_boxes[] = array(		
		'id' => 'swm-page-meta-box',		
		'title' => __('Page Options', 'swmtranslate'),				
		'pages' => array( 'page','post','portfolio','product','tribe_events','cause','sermons' ),		
		'context' => 'normal',		
		'priority' => 'high',
		'autosave' => true,		
		'fields' => array(	
			array(
				"name" => __('Site Layout', 'swmtranslate'),				
				"id" => "{$prefix}meta_site_layout",
				"std" => "default",
				"type" => "select",				
				"options" => array(		
					"default" => __('Select Site Layout', 'swmtranslate'),
					"wide" => __('Wide (Full Width)', 'swmtranslate'),
					"boxed" => __('Boxed', 'swmtranslate'),					
				),				
			),				
			array( 
				'name' => __('Breadcrumbs', 'swmtranslate'),
				'desc' => __('Enable Breadcrumbs', 'swmtranslate'),
				'id' => "{$prefix}meta_breadcrumbs_onoff",
				'std' => "1",
				"type" => "checkbox",
			),
			array(
				'type' => 'heading',
				'name' => __('Page Content', 'swmtranslate'),
				'id'   => "{$prefix}page_page_content_heading",
			),
			array(
				"name" => __('Content Layout', 'swmtranslate'),				
				"id" => "{$prefix}meta_page_layout",
				"std" => "sidebar-right",
				"type" => "select",				
				"options" => $swm_page_layout,				
			),
			array( 
				'name' => __('Page Content Top Padding', 'swmtranslate'),
				'desc' => __('Enter content top padding value in pixels or em( Example: 20px, 30px, 1em, 2em). Leave it empty for default value.', 'swmtranslate'),		
				'id' => "{$prefix}meta_page_content_top_padding",
				'std' => '50px',			
				"type" => "text"
			),
			array( 
				'name' => __('Page Content Bottom Padding', 'swmtranslate'),				
				'desc' => __('Enter content bottom padding value in pixels or em( Example: 20px, 30px, 1em, 2em). Leave it empty for default value.', 'swmtranslate'),
				'id' => "{$prefix}meta_page_content_bottom_padding",
				'std' => '80px',			
				"type" => "text"
			),		
			
			array(
				'type' => 'heading',
				'name' => __('Page Title', 'swmtranslate'),
				'id'   => "{$prefix}page_title_heading",
			),
			array( 
				'name' => __('Page Title', 'swmtranslate'),
				'desc' => __('Enable Page title', 'swmtranslate'),
				'id' => "{$prefix}meta_page_title_onoff",
				'std' => "1",
				"type" => "checkbox",
			),
			array(
				"name" => __('Page Title Color', 'swmtranslate'),							
				"id" => "{$prefix}meta_page_title_color",
				"std" => '',
				"type" => "color",				
			),					
			array(
				'type' => 'heading',
				'name' => __('Header Style', 'swmtranslate'),
				'id'   => "{$prefix}page_header_options",
			),
			array(
				"name" => __('Header Style', 'swmtranslate'),				
				"id" => "{$prefix}meta_header_style",
				"std" => "default",
				"type" => "select",
				"options" => array(						
					"standard" => __('Standard - Title with Background', 'swmtranslate'),		
					"revolution_slider" => __('Revolution Slider', 'swmtranslate'),	
					"google_map" => __('Google Map', 'swmtranslate')
				),				
			),
			array(
				"name" => __('Header Background Color', 'swmtranslate'),
				"desc" => __('If you do not want to upload background image then add background color value', 'swmtranslate'),						
				"id" => "{$prefix}meta_header_bg_color",
				"std" => '',
				"type" => "color",				
			),
			array(
				'name' => __('Header Background Image', 'swmtranslate'),
				'desc' => __('Upload background image to display in this page (recommended size : <strong>1920x1280</strong>)<br /> <strong>Note:</strong> Only upload/add single image', 'swmtranslate'),
				'id'  => "{$prefix}meta_header_bg_image",
				'type'  => 'thickbox_image',
			),
			array(
				"name" => __('Header Background Position', 'swmtranslate'),				
				"id" => "{$prefix}meta_header_bg_position",
				"std" => "center",
				"type" => "select",
				"options" => $swm_alignment,				
			),
			array(
				"name" => __('Header Background Repeat', 'swmtranslate'),				
				"id" => "{$prefix}meta_header_bg_repeat",
				"std" => "no-repeat",
				"type" => "select",				
				"options" => $swm_background_repeat,				
			),
			array(
				"name" => __('Header Background Attachment', 'swmtranslate'),				
				"id" => "{$prefix}meta_header_bg_attachment",
				"std" => "fixed",
				"type" => "select",				
				"options" => $swm_background_attachment,				
			),	
			array( 
				'name' => __('100% Header Background Image Width', 'swmtranslate'),				
				'id' => "{$prefix}meta_header_bg_stretch",
				'std' => "0",
				"type" => "checkbox",
			),			
			array( 
				'name' => __('Parallax Scrolling', 'swmtranslate'),				
				'id' => "{$prefix}meta_enable_parallax_effect",
				'std' => "0",
				"type" => "checkbox"
			),			
			array(
				'name' => __( 'Background Image Scroll Speed', 'swmtranslate' ),
				'id'   => "{$prefix}meta_header_parallax_speed",
				'type' => 'slider',
				'std'  => '2.5',
				'js_options' => array(
					'min'   => -10.0,
					'max'   => 10.0,
					'step'  => 0.1,
				),
			),
			array( 
				'name' => __('Header Height', 'swmtranslate'),				
				'id' => "{$prefix}meta_header_height",
				'std' => 300,			
				"type" => "text",
				'desc' => __('Enter header height in <strong>number</strong> Example: 300,500,800', 'swmtranslate'),
			),			
			array( 
				'name' => __('Add Revolution Slider Shortcode', 'swmtranslate'),
				'desc' => __('Add revolution slider shortcode e.g. [rev_slider revolution]<br /> You have to install revolution slider plugin and generate shortcode ', 'swmtranslate'),
				'id' => "{$prefix}meta_rev_slider_shortcode",
				'std' => "",			
				"type" => "text"
			),
			array( 
				'name' => __('Google Map Link', 'swmtranslate'),
				'desc' => __( '<a href="https://www.youtube.com/watch?v=HjZHkEWTCYg" target="_blank">Video tutorial to get google map embed code</a>', 'swmtranslate' ),
				'id' => "{$prefix}header_google_map_link",
				'std' => "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3024.313975261218!2d-74.00583600840093!3d40.71110418241921!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew+York%2C+NY%2C+USA!5e0!3m2!1sen!2sin!4v1440259795109",	
				"type" => "textarea"
			),
			array(
				'type' => 'heading',
				'name' => __('Body Background', 'swmtranslate'),
				'id'   => "{$prefix}page_background_options",
			),
			array(
				'name' => __('Body Background Image', 'swmtranslate'),
				'desc' => __('Upload background image to display in this page (recommended size : <strong>1920x1280</strong>)<br /> <strong>Note:</strong> Only upload/add single image', 'swmtranslate'),
				'id'  => "{$prefix}meta_body_bg_image",
				'type'  => 'thickbox_image',
			),
			array(
				"name" => __('Body Background Position', 'swmtranslate'),				
				"id" => "{$prefix}meta_body_bg_image_position",
				"std" => "center",
				"type" => "select",
				"options" => $swm_alignment,				
			),
			array(
				"name" => __('Body Background Repeat', 'swmtranslate'),				
				"id" => "{$prefix}meta_body_bg_image_repeat",
				"std" => "no-repeat",
				"type" => "select",				
				"options" => $swm_background_repeat,				
			),
			array(
				"name" => __('Body Background Attachment', 'swmtranslate'),				
				"id" => "{$prefix}meta_body_bg_image_attachment",
				"std" => "fixed",
				"type" => "select",				
				"options" => $swm_background_attachment,
				
			),
			array( 
				'name' => __('100% Body Background Image Width', 'swmtranslate'),				
				'id' => "{$prefix}meta_body_bg_image_stretch",
				'std' => "0",
				"type" => "checkbox",
			),	
			array(
				"name" => __('Body Background Color', 'swmtranslate'),
				"desc" => __('If you do not want to upload background image then add background color value', 'swmtranslate'),						
				"id" => "{$prefix}meta_body_bg_color",
				"std" => '',
				"type" => "color",				
			)
		)
	);	

	return $meta_boxes;
}