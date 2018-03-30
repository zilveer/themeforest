<?php

//////////////////////////////////////////////////////////////////
// Customizer - Add Custom Styling
//////////////////////////////////////////////////////////////////
function solopine_customizer_style()
{
	wp_enqueue_style('customizer-css', get_stylesheet_directory_uri() . '/functions/customizer/css/customizer.css');
}
add_action('customize_controls_print_styles', 'solopine_customizer_style');

//////////////////////////////////////////////////////////////////
// Customizer - Add Settings
//////////////////////////////////////////////////////////////////
function solopine_register_theme_customizer( $wp_customize ) {
 	
	// Add Sections
	$wp_customize->add_section( 'solopine_new_section_custom_css' , array(
   		'title'      => 'Custom CSS',
   		'description'=> 'Add your custom CSS which will overwrite the theme CSS',
   		'priority'   => 103,
	) );
	$wp_customize->add_section( 'solopine_new_section_color_general' , array(
   		'title'      => 'Colors: General',
   		'description'=> '',
   		'priority'   => 102,
	) );
	$wp_customize->add_section( 'solopine_new_section_color_posts' , array(
   		'title'      => 'Colors: Posts',
   		'description'=> '',
   		'priority'   => 101,
	) );
	$wp_customize->add_section( 'solopine_new_section_color_sidebar' , array(
   		'title'      => 'Colors: Sidebar',
   		'description'=> '',
   		'priority'   => 100,
	) );
	$wp_customize->add_section( 'solopine_new_section_color_footer' , array(
   		'title'      => 'Colors: Footer',
   		'description'=> '',
   		'priority'   => 99,
	) );
	$wp_customize->add_section( 'solopine_new_section_color_topbar' , array(
   		'title'      => 'Colors: Top Bar',
   		'description'=> '',
   		'priority'   => 98,
	) );
	$wp_customize->add_section( 'solopine_new_section_footer' , array(
   		'title'      => 'Footer Settings',
   		'description'=> '',
   		'priority'   => 97,
	) );
	$wp_customize->add_section( 'solopine_new_section_social' , array(
   		'title'      => 'Social Media Settings',
   		'description'=> 'Enter your social media usernames. Icons will not show if left blank.',
   		'priority'   => 96,
	) );
	$wp_customize->add_section( 'solopine_new_section_page' , array(
   		'title'      => 'Page Settings',
   		'description'=> '',
   		'priority'   => 95,
	) );
	$wp_customize->add_section( 'solopine_new_section_post' , array(
   		'title'      => 'Post Settings',
   		'description'=> '',
   		'priority'   => 94,
	) );
	$wp_customize->add_section( 'solopine_new_section_featured' , array(
		'title'      => 'Featured Area Settings',
		'description'=> '',
		'priority'   => 93,
	) );
	$wp_customize->add_section( 'solopine_new_section_topbar' , array(
		'title'      => 'Top Bar Settings',
		'description'=> '',
		'priority'   => 92,
	) );
	$wp_customize->add_section( 'solopine_new_section_logo_header' , array(
   		'title'      => 'Logo and Header Settings',
   		'description'=> '',
   		'priority'   => 91,
	) );
	$wp_customize->add_section( 'solopine_new_section_general' , array(
   		'title'      => 'General Settings',
   		'description'=> '',
   		'priority'   => 90,
	) );
	
	
	
	// Add Setting
		
		// General
		$wp_customize->add_setting(
	        'sp_favicon'
	    );
		$wp_customize->add_setting(
	        'sp_home_layout',
	        array(
	            'default'     => 'full'
	        )
	    );
		$wp_customize->add_setting(
	        'sp_grid_title',
	        array(
	            'default'     => 'Latest Posts'
	        )
	    );
		$wp_customize->add_setting(
	        'sp_grid_sub',
	        array(
	            'default'     => 'Lorem ipsum dolor sit amet sed do eiusmod.'
	        )
	    );
		$wp_customize->add_setting(
	        'sp_archive_layout',
	        array(
	            'default'     => 'full'
	        )
	    );
		
		$wp_customize->add_setting(
	        'sp_sidebar_home',
	        array(
	            'default'     => false
	        )
	    );
		
		$wp_customize->add_setting(
	        'sp_sidebar_posts',
	        array(
	            'default'     => false
	        )
	    );
		
		$wp_customize->add_setting(
	        'sp_sidebar_archive',
	        array(
	            'default'     => false
	        )
	    );
		
		// Header and logo
		$wp_customize->add_setting(
	        'sp_logo'
	    );
		$wp_customize->add_setting(
	        'sp_logo_retina'
	    );
		
		$wp_customize->add_setting(
	        'sp_header_padding',
	        array(
	            'default'     => '40'
	        )
	    );
		
		// Top Bar
		$wp_customize->add_setting(
	        'sp_topbar_social_check',
	        array(
	            'default'     => false
	        )
	    );
		$wp_customize->add_setting(
	        'sp_topbar_search_check',
	        array(
	            'default'     => false
	        )
	    );
		
		// Featured area
		$wp_customize->add_setting(
	        'sp_featured_slider',
	        array(
	            'default'     => false
	        )
	    );
		$wp_customize->add_setting(
	        'sp_featured_cat'
	    );
		$wp_customize->add_setting(
	        'sp_featured_cat_hide',
	        array(
	            'default'     => false
	        )
	    );
		$wp_customize->add_setting(
	        'sp_featured_slider_slides',
	        array(
	            'default'     => '6'
	        )
	    );
		
		// Post Settings
		$wp_customize->add_setting(
	        'sp_post_tags',
	        array(
	            'default'     => false
	        )
	    );
		$wp_customize->add_setting(
	        'sp_post_author',
	        array(
	            'default'     => false
	        )
	    );
		$wp_customize->add_setting(
	        'sp_post_related',
	        array(
	            'default'     => false
	        )
	    );
		$wp_customize->add_setting(
	        'sp_post_share',
	        array(
	            'default'     => false
	        )
	    );
		$wp_customize->add_setting(
	        'sp_post_thumb',
	        array(
	            'default'     => false
	        )
	    );
		$wp_customize->add_setting(
	        'sp_post_nav',
	        array(
	            'default'     => false
	        )
	    );
		$wp_customize->add_setting(
	        'sp_post_date',
	        array(
	            'default'     => false
	        )
	    );
		$wp_customize->add_setting(
	        'sp_post_cat',
	        array(
	            'default'     => false
	        )
	    );
		$wp_customize->add_setting(
	        'sp_post_title_lowercase',
	        array(
	            'default'     => false
	        )
	    );
		
		// Page Settings
		$wp_customize->add_setting(
	        'sp_page_comments',
	        array(
	            'default'     => false
	        )
	    );
		$wp_customize->add_setting(
	        'sp_page_share',
	        array(
	            'default'     => false
	        )
	    );
		
		// Social Media
		
		$wp_customize->add_setting(
	        'sp_facebook',
	        array(
	            'default'     => 'solopinedesigns'
	        )
	    );
		$wp_customize->add_setting(
	        'sp_twitter',
	        array(
	            'default'     => 'solopinedesigns'
	        )
	    );
		$wp_customize->add_setting(
	        'sp_instagram',
	        array(
	            'default'     => 'solopine'
	        )
	    );
		$wp_customize->add_setting(
	        'sp_pinterest',
	        array(
	            'default'     => 'solopinedesigns'
	        )
	    );
		$wp_customize->add_setting(
	        'sp_tumblr',
	        array(
	            'default'     => ''
	        )
	    );
		$wp_customize->add_setting(
	        'sp_bloglovin',
	        array(
	            'default'     => ''
	        )
	    );
		$wp_customize->add_setting(
	        'sp_tumblr',
	        array(
	            'default'     => ''
	        )
	    );
		$wp_customize->add_setting(
	        'sp_google',
	        array(
	            'default'     => ''
	        )
	    );
		$wp_customize->add_setting(
	        'sp_youtube',
	        array(
	            'default'     => ''
	        )
	    );
		$wp_customize->add_setting(
	        'sp_linkedin',
	        array(
	            'default'     => ''
	        )
	    );
		$wp_customize->add_setting(
	        'sp_snapchat',
	        array(
	            'default'     => ''
	        )
	    );	    
		$wp_customize->add_setting(
	        'sp_rss',
	        array(
	            'default'     => ''
	        )
	    );
		
		// Footer Options

	    $wp_customize->add_setting(
	        'sp_footer_social',
	        array(
	            'default'     => false
	        )
	    );
		$wp_customize->add_setting(
	        'sp_footer_widget_area',
	        array(
	            'default'     => false
	        )
	    );
		$wp_customize->add_setting(
	        'sp_footer_logo_area',
	        array(
	            'default'     => false
	        )
	    );
		$wp_customize->add_setting(
	        'sp_footer_logo'
	    );
		$wp_customize->add_setting(
	        'sp_footer_logo_retina'
	    );
		$wp_customize->add_setting(
	        'sp_footer_text',
	        array(
	            'default'     => 'Made with <i class="fa fa-heart"></i> in Seattle'
	        )
	    );
		$wp_customize->add_setting(
	        'sp_footer_copyright',
	        array(
	            'default'     => '&copy; 2013 Solo Pine Designs, INC. All Rights Reserved.'
	        )
	    );
		
		// Color Options
		
			// Top bar
			$wp_customize->add_setting(
				'sp_topbar_bg',
				array(
					'default'     => '#171717'
				)
			);
			$wp_customize->add_setting(
				'sp_topbar_nav_color',
				array(
					'default'     => '#ffffff'
				)
			);
			$wp_customize->add_setting(
				'sp_topbar_nav_color_active',
				array(
					'default'     => '#999999'
				)
			);
			
			$wp_customize->add_setting(
				'sp_drop_bg',
				array(
					'default'     => '#171717'
				)
			);
			$wp_customize->add_setting(
				'sp_drop_border',
				array(
					'default'     => '#333333'
				)
			);
			$wp_customize->add_setting(
				'sp_drop_text_color',
				array(
					'default'     => '#999999'
				)
			);
			$wp_customize->add_setting(
				'sp_drop_text_hover_bg',
				array(
					'default'     => '#333333'
				)
			);
			$wp_customize->add_setting(
				'sp_drop_text_hover_color',
				array(
					'default'     => '#ffffff'
				)
			);
			
			$wp_customize->add_setting(
				'sp_topbar_social_color',
				array(
					'default'     => '#e6c55d'
				)
			);
			$wp_customize->add_setting(
				'sp_topbar_social_color_hover',
				array(
					'default'     => '#e6c55d'
				)
			);
			
			$wp_customize->add_setting(
				'sp_topbar_search_bg',
				array(
					'default'     => '#353535'
				)
			);
			$wp_customize->add_setting(
				'sp_topbar_search_magnify',
				array(
					'default'     => '#999999'
				)
			);
			$wp_customize->add_setting(
				'sp_topbar_search_bg_hover',
				array(
					'default'     => '#474747'
				)
			);
			$wp_customize->add_setting(
				'sp_topbar_search_magnify_hover',
				array(
					'default'     => '#cccccc'
				)
			);
			
			// Footer
			$wp_customize->add_setting(
				'sp_footer_widget_bg',
				array(
					'default'     => '#f2f2f2'
				)
			);
			$wp_customize->add_setting(
				'sp_footer_widget_color',
				array(
					'default'     => '#666666'
				)
			);
			$wp_customize->add_setting(
				'sp_footer_social_bg',
				array(
					'default'     => '#f2f2f2'
				)
			);
			$wp_customize->add_setting(
				'sp_footer_logo_bg',
				array(
					'default'     => '#171717'
				)
			);
			$wp_customize->add_setting(
				'sp_footer_logo_color',
				array(
					'default'     => '#777777'
				)
			);
			$wp_customize->add_setting(
				'sp_footer_copyright_bg',
				array(
					'default'     => '#f2f2f2'
				)
			);
			$wp_customize->add_setting(
				'sp_footer_copyright_color',
				array(
					'default'     => '#888888'
				)
			);
			
			// Sidebar color
			$wp_customize->add_setting(
				'sp_sidebar_bg',
				array(
					'default'     => '#f2f2f2'
				)
			);
			$wp_customize->add_setting(
				'sp_sidebar_color',
				array(
					'default'     => '#666666'
				)
			);
			$wp_customize->add_setting(
				'sp_sidebar_social_bg',
				array(
					'default'     => '#666666'
				)
			);
			$wp_customize->add_setting(
				'sp_sidebar_social_color',
				array(
					'default'     => '#ffffff'
				)
			);
			$wp_customize->add_setting(
				'sp_sidebar_social_bg_hover',
				array(
					'default'     => '#000000'
				)
			);
			$wp_customize->add_setting(
				'sp_sidebar_social_color_hover',
				array(
					'default'     => '#ffffff'
				)
			);
			
			// Posts color
			$wp_customize->add_setting(
				'sp_posts_title_color',
				array(
					'default'     => '#000000'
				)
			);
			$wp_customize->add_setting(
				'sp_posts_share_box_border',
				array(
					'default'     => '#e5e5e5'
				)
			);
			$wp_customize->add_setting(
				'sp_posts_share_box_bg',
				array(
					'default'     => '#ffffff'
				)
			);
			$wp_customize->add_setting(
				'sp_posts_share_box_color',
				array(
					'default'     => '#cea525'
				)
			);
			$wp_customize->add_setting(
				'sp_posts_share_box_border_hover',
				array(
					'default'     => '#171717'
				)
			);
			$wp_customize->add_setting(
				'sp_posts_share_box_bg_hover',
				array(
					'default'     => '#171717'
				)
			);
			$wp_customize->add_setting(
				'sp_posts_share_box_color_hover',
				array(
					'default'     => '#cea525'
				)
			);
			
			
			// Color general
			$wp_customize->add_setting(
				'sp_color_accent',
				array(
					'default'     => '#cea525'
				)
			);
			
			// Custom CSS
			$wp_customize->add_setting(
				'sp_custom_css'
			);


    // Add Control
		
		// General
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'upload_favicon',
				array(
					'label'      => 'Upload Favicon',
					'section'    => 'solopine_new_section_general',
					'settings'   => 'sp_favicon',
					'priority'	 => 1
				)
			)
		);
		
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'home_layout',
				array(
					'label'          => 'Homepage Layout',
					'section'        => 'solopine_new_section_general',
					'settings'       => 'sp_home_layout',
					'type'           => 'radio',
					'priority'	 => 2,
					'choices'        => array(
						'full'   => 'Full Posts',
						'grid'  => 'Grid Posts'
					)
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'grid_title',
				array(
					'label'      => 'Grid Layout: Heading',
					'section'    => 'solopine_new_section_general',
					'settings'   => 'sp_grid_title',
					'type'		 => 'text',
					'priority'	 => 3
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'grid_sub',
				array(
					'label'      => 'Grid Layout: Sub heading',
					'section'    => 'solopine_new_section_general',
					'settings'   => 'sp_grid_sub',
					'type'		 => 'text',
					'priority'	 => 4
				)
			)
		);
		
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'archive_layout',
				array(
					'label'          => 'Archive Layout',
					'section'        => 'solopine_new_section_general',
					'settings'       => 'sp_archive_layout',
					'type'           => 'radio',
					'priority'	 => 5,
					'choices'        => array(
						'full'   => 'Full Posts',
						'grid'  => 'Grid Posts'
					)
				)
			)
		);
		
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'sidebar_home',
				array(
					'label'      => 'Enable Sidebar on Homepage',
					'section'    => 'solopine_new_section_general',
					'settings'   => 'sp_sidebar_home',
					'type'		 => 'checkbox',
					'priority'	 => 6
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'sidebar_posts',
				array(
					'label'      => 'Enable Sidebar on Posts',
					'section'    => 'solopine_new_section_general',
					'settings'   => 'sp_sidebar_posts',
					'type'		 => 'checkbox',
					'priority'	 => 7
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'sidebar_archive',
				array(
					'label'      => 'Enable Sidebar on Archives',
					'section'    => 'solopine_new_section_general',
					'settings'   => 'sp_sidebar_archive',
					'type'		 => 'checkbox',
					'priority'	 => 8
				)
			)
		);
		
		// Header and Logo
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'upload_logo',
				array(
					'label'      => 'Upload Logo',
					'section'    => 'solopine_new_section_logo_header',
					'settings'   => 'sp_logo',
					'priority'	 => 20
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'upload_logo_retina',
				array(
					'label'      => 'Upload Logo (Retina Version)',
					'section'    => 'solopine_new_section_logo_header',
					'settings'   => 'sp_logo_retina',
					'priority'	 => 21
				)
			)
		);
		
		$wp_customize->add_control(
			new Customize_Number_Control(
				$wp_customize,
				'header_padding',
				array(
					'label'      => 'Top & Bottom Header Padding',
					'section'    => 'solopine_new_section_logo_header',
					'settings'   => 'sp_header_padding',
					'type'		 => 'number',
					'priority'	 => 22
				)
			)
		);
		
		// Top Bar
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'topbar_social_check',
				array(
					'label'      => 'Disable Top Bar Social Icons',
					'section'    => 'solopine_new_section_topbar',
					'settings'   => 'sp_topbar_social_check',
					'type'		 => 'checkbox',
					'priority'	 => 3
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'topbar_search_check',
				array(
					'label'      => 'Disable Top Bar Search',
					'section'    => 'solopine_new_section_topbar',
					'settings'   => 'sp_topbar_search_check',
					'type'		 => 'checkbox',
					'priority'	 => 4
				)
			)
		);
		
		// Featured area
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'featured_slider',
				array(
					'label'      => 'Enable Featured Slider',
					'section'    => 'solopine_new_section_featured',
					'settings'   => 'sp_featured_slider',
					'type'		 => 'checkbox',
					'priority'	 => 2
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Category_Control(
				$wp_customize,
				'featured_cat',
				array(
					'label'    => 'Select Featured Category',
					'settings' => 'sp_featured_cat',
					'section'  => 'solopine_new_section_featured',
					'priority'	 => 3
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'featured_cat_hide',
				array(
					'label'      => 'Hide Featured Category',
					'section'    => 'solopine_new_section_featured',
					'settings'   => 'sp_featured_cat_hide',
					'type'		 => 'checkbox',
					'priority'	 => 4
				)
			)
		);
		
		
		$wp_customize->add_control(
			new Customize_Number_Control(
				$wp_customize,
				'featured_slider_slides',
				array(
					'label'      => 'Amount of Slides',
					'section'    => 'solopine_new_section_featured',
					'settings'   => 'sp_featured_slider_slides',
					'type'		 => 'number',
					'priority'	 => 5
				)
			)
		);
		
		// Post Settings
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'post_cat',
				array(
					'label'      => 'Hide Category',
					'section'    => 'solopine_new_section_post',
					'settings'   => 'sp_post_cat',
					'type'		 => 'checkbox',
					'priority'	 => 1
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'post_date',
				array(
					'label'      => 'Hide Date',
					'section'    => 'solopine_new_section_post',
					'settings'   => 'sp_post_date',
					'type'		 => 'checkbox',
					'priority'	 => 2
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'post_tags',
				array(
					'label'      => 'Hide Tags',
					'section'    => 'solopine_new_section_post',
					'settings'   => 'sp_post_tags',
					'type'		 => 'checkbox',
					'priority'	 => 3
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'post_share',
				array(
					'label'      => 'Hide Share Buttons',
					'section'    => 'solopine_new_section_post',
					'settings'   => 'sp_post_share',
					'type'		 => 'checkbox',
					'priority'	 => 4
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'post_author',
				array(
					'label'      => 'Hide Author Box',
					'section'    => 'solopine_new_section_post',
					'settings'   => 'sp_post_author',
					'type'		 => 'checkbox',
					'priority'	 => 5
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'post_related',
				array(
					'label'      => 'Hide Related Posts Box',
					'section'    => 'solopine_new_section_post',
					'settings'   => 'sp_post_related',
					'type'		 => 'checkbox',
					'priority'	 => 6
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'post_thumb',
				array(
					'label'      => 'Hide Featured Image from top of Post',
					'section'    => 'solopine_new_section_post',
					'settings'   => 'sp_post_thumb',
					'type'		 => 'checkbox',
					'priority'	 => 7
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'post_nav',
				array(
					'label'      => 'Hide Next/Prev Post Navigation',
					'section'    => 'solopine_new_section_post',
					'settings'   => 'sp_post_nav',
					'type'		 => 'checkbox',
					'priority'	 => 8
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'post_title_lowercase',
				array(
					'label'      => 'Turn off uppercase in post title',
					'section'    => 'solopine_new_section_post',
					'settings'   => 'sp_post_title_lowercase',
					'type'		 => 'checkbox',
					'priority'	 => 9
				)
			)
		);
		
		// Page settings
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'page_comments',
				array(
					'label'      => 'Hide Comments',
					'section'    => 'solopine_new_section_page',
					'settings'   => 'sp_page_comments',
					'type'		 => 'checkbox',
					'priority'	 => 1
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'page_share',
				array(
					'label'      => 'Hide Share Buttons',
					'section'    => 'solopine_new_section_page',
					'settings'   => 'sp_page_share',
					'type'		 => 'checkbox',
					'priority'	 => 2
				)
			)
		);
		
		// Social Media
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'facebook',
				array(
					'label'      => 'Facebook',
					'section'    => 'solopine_new_section_social',
					'settings'   => 'sp_facebook',
					'type'		 => 'text',
					'priority'	 => 1
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'twitter',
				array(
					'label'      => 'Twitter',
					'section'    => 'solopine_new_section_social',
					'settings'   => 'sp_twitter',
					'type'		 => 'text',
					'priority'	 => 2
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'instagram',
				array(
					'label'      => 'Instagram',
					'section'    => 'solopine_new_section_social',
					'settings'   => 'sp_instagram',
					'type'		 => 'text',
					'priority'	 => 3
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'pinterest',
				array(
					'label'      => 'Pinterest',
					'section'    => 'solopine_new_section_social',
					'settings'   => 'sp_pinterest',
					'type'		 => 'text',
					'priority'	 => 4
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'bloglovin',
				array(
					'label'      => 'Bloglovin',
					'section'    => 'solopine_new_section_social',
					'settings'   => 'sp_bloglovin',
					'type'		 => 'text',
					'priority'	 => 5
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'google',
				array(
					'label'      => 'Google Plus',
					'section'    => 'solopine_new_section_social',
					'settings'   => 'sp_google',
					'type'		 => 'text',
					'priority'	 => 6
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'tumblr',
				array(
					'label'      => 'Tumblr',
					'section'    => 'solopine_new_section_social',
					'settings'   => 'sp_tumblr',
					'type'		 => 'text',
					'priority'	 => 7
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'youtube',
				array(
					'label'      => 'Youtube',
					'section'    => 'solopine_new_section_social',
					'settings'   => 'sp_youtube',
					'type'		 => 'text',
					'priority'	 => 8
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'linkedin',
				array(
					'label'      => 'Linkedin (Full URL to profile)',
					'section'    => 'solopine_new_section_social',
					'settings'   => 'sp_linkedin',
					'type'		 => 'text',
					'priority'	 => 9
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'snapchat',
				array(
					'label'      => 'Snapchat',
					'section'    => 'solopine_new_section_social',
					'settings'   => 'sp_snapchat',
					'type'		 => 'text',
					'priority'	 => 10
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'rss',
				array(
					'label'      => 'RSS Link',
					'section'    => 'solopine_new_section_social',
					'settings'   => 'sp_rss',
					'type'		 => 'text',
					'priority'	 => 11
				)
			)
		);
		
		// Footer Settings
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'footer_social',
				array(
					'label'      => 'Disable Footer Social',
					'section'    => 'solopine_new_section_footer',
					'settings'   => 'sp_footer_social',
					'type'		 => 'checkbox',
					'priority'	 => 1
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'footer_widget_area',
				array(
					'label'      => 'Disable Footer Widget Area',
					'section'    => 'solopine_new_section_footer',
					'settings'   => 'sp_footer_widget_area',
					'type'		 => 'checkbox',
					'priority'	 => 2
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'footer_logo_area',
				array(
					'label'      => 'Disable Footer Logo Area',
					'section'    => 'solopine_new_section_footer',
					'settings'   => 'sp_footer_logo_area',
					'type'		 => 'checkbox',
					'priority'	 => 3
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'footer_logo',
				array(
					'label'      => 'Upload Footer Logo',
					'section'    => 'solopine_new_section_footer',
					'settings'   => 'sp_footer_logo',
					'priority'	 => 4
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'footer_logo_retina',
				array(
					'label'      => 'Upload Footer Logo (Retina)',
					'section'    => 'solopine_new_section_footer',
					'settings'   => 'sp_footer_logo_retina',
					'priority'	 => 5
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'footer_text',
				array(
					'label'      => 'Footer Text',
					'section'    => 'solopine_new_section_footer',
					'settings'   => 'sp_footer_text',
					'type'		 => 'text',
					'priority'	 => 6
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'footer_copyright',
				array(
					'label'      => 'Footer Copyright Text',
					'section'    => 'solopine_new_section_footer',
					'settings'   => 'sp_footer_copyright',
					'type'		 => 'text',
					'priority'	 => 7
				)
			)
		);
		
		// Color Settings
		
		$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'topbar_bg',
					array(
						'label'      => 'Top Bar BG',
						'section'    => 'solopine_new_section_color_topbar',
						'settings'   => 'sp_topbar_bg',
						'priority'	 => 1
					)
				)
			);
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'topbar_nav_color',
					array(
						'label'      => 'Top Bar Menu Text Color',
						'section'    => 'solopine_new_section_color_topbar',
						'settings'   => 'sp_topbar_nav_color',
						'priority'	 => 2
					)
				)
			);
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'topbar_nav_color_active',
					array(
						'label'      => 'Top Bar Menu Text Hover Color',
						'section'    => 'solopine_new_section_color_topbar',
						'settings'   => 'sp_topbar_nav_color_active',
						'priority'	 => 3
					)
				)
			);
			
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'drop_bg',
					array(
						'label'      => 'Dropdown BG',
						'section'    => 'solopine_new_section_color_topbar',
						'settings'   => 'sp_drop_bg',
						'priority'	 => 4
					)
				)
			);
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'drop_border',
					array(
						'label'      => 'Dropdown Border Color',
						'section'    => 'solopine_new_section_color_topbar',
						'settings'   => 'sp_drop_border',
						'priority'	 => 5
					)
				)
			);
			
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'drop_text_color',
					array(
						'label'      => 'Dropdown Text Color',
						'section'    => 'solopine_new_section_color_topbar',
						'settings'   => 'sp_drop_text_color',
						'priority'	 => 6
					)
				)
			);
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'drop_text_hover_bg',
					array(
						'label'      => 'Dropdown Text Hover BG',
						'section'    => 'solopine_new_section_color_topbar',
						'settings'   => 'sp_drop_text_hover_bg',
						'priority'	 => 7
					)
				)
			);
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'drop_text_hover_color',
					array(
						'label'      => 'Dropdown Text Hover Color',
						'section'    => 'solopine_new_section_color_topbar',
						'settings'   => 'sp_drop_text_hover_color',
						'priority'	 => 8
					)
				)
			);
			
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'topbar_social_color',
					array(
						'label'      => 'Top Bar Social Icons',
						'section'    => 'solopine_new_section_color_topbar',
						'settings'   => 'sp_topbar_social_color',
						'priority'	 => 9
					)
				)
			);
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'topbar_social_color_hover',
					array(
						'label'      => 'Top Bar Social Icons Hover',
						'section'    => 'solopine_new_section_color_topbar',
						'settings'   => 'sp_topbar_social_color_hover',
						'priority'	 => 11
					)
				)
			);
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'topbar_search_bg',
					array(
						'label'      => 'Top Bar Search BG',
						'section'    => 'solopine_new_section_color_topbar',
						'settings'   => 'sp_topbar_search_bg',
						'priority'	 => 12
					)
				)
			);
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'topbar_search_magnify',
					array(
						'label'      => 'Top Bar Search Magnify Color',
						'section'    => 'solopine_new_section_color_topbar',
						'settings'   => 'sp_topbar_search_magnify',
						'priority'	 => 13
					)
				)
			);
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'topbar_search_bg_hover',
					array(
						'label'      => 'Top Bar Search BG Hover',
						'section'    => 'solopine_new_section_color_topbar',
						'settings'   => 'sp_topbar_search_bg_hover',
						'priority'	 => 14
					)
				)
			);
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'topbar_search_magnify_hover',
					array(
						'label'      => 'Top Bar Search Magnify Hover Color',
						'section'    => 'solopine_new_section_color_topbar',
						'settings'   => 'sp_topbar_search_magnify_hover',
						'priority'	 => 15
					)
				)
			);
			
			// Footer colors
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'footer_widget_bg',
					array(
						'label'      => 'Footer Widget Title BG',
						'section'    => 'solopine_new_section_color_footer',
						'settings'   => 'sp_footer_widget_bg',
						'priority'	 => 1
					)
				)
			);
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'footer_widget_color',
					array(
						'label'      => 'Footer Widget Title Text Color',
						'section'    => 'solopine_new_section_color_footer',
						'settings'   => 'sp_footer_widget_color',
						'priority'	 => 2
					)
				)
			);
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'footer_social_bg',
					array(
						'label'      => 'Footer Social Section BG',
						'section'    => 'solopine_new_section_color_footer',
						'settings'   => 'sp_footer_social_bg',
						'priority'	 => 3
					)
				)
			);
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'footer_logo_bg',
					array(
						'label'      => 'Footer Logo Section BG',
						'section'    => 'solopine_new_section_color_footer',
						'settings'   => 'sp_footer_logo_bg',
						'priority'	 => 4
					)
				)
			);
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'footer_logo_color',
					array(
						'label'      => 'Footer Logo Section Text color',
						'section'    => 'solopine_new_section_color_footer',
						'settings'   => 'sp_footer_logo_color',
						'priority'	 => 5
					)
				)
			);
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'footer_copyright_bg',
					array(
						'label'      => 'Footer Copyright Section BG',
						'section'    => 'solopine_new_section_color_footer',
						'settings'   => 'sp_footer_copyright_bg',
						'priority'	 => 6
					)
				)
			);
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'footer_copyright_color',
					array(
						'label'      => 'Footer Copyright Section Text Color',
						'section'    => 'solopine_new_section_color_footer',
						'settings'   => 'sp_footer_copyright_color',
						'priority'	 => 7
					)
				)
			);
			
			// Sidebar Color
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'sidebar_bg',
					array(
						'label'      => 'Sidebar Widget Heading BG',
						'section'    => 'solopine_new_section_color_sidebar',
						'settings'   => 'sp_sidebar_bg',
						'priority'	 => 1
					)
				)
			);
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'sidebar_color',
					array(
						'label'      => 'Sidebar Widget Heading Text Color',
						'section'    => 'solopine_new_section_color_sidebar',
						'settings'   => 'sp_sidebar_color',
						'priority'	 => 2
					)
				)
			);
			
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'sidebar_social_bg',
					array(
						'label'      => 'Sidebar Social Icons BG Color',
						'section'    => 'solopine_new_section_color_sidebar',
						'settings'   => 'sp_sidebar_social_bg',
						'priority'	 => 3
					)
				)
			);
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'sidebar_social_color',
					array(
						'label'      => 'Sidebar Social Icons Text Color',
						'section'    => 'solopine_new_section_color_sidebar',
						'settings'   => 'sp_sidebar_social_color',
						'priority'	 => 4
					)
				)
			);
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'sidebar_social_bg_hover',
					array(
						'label'      => 'Sidebar Social Icons BG Hover Color',
						'section'    => 'solopine_new_section_color_sidebar',
						'settings'   => 'sp_sidebar_social_bg_hover',
						'priority'	 => 4
					)
				)
			);
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'sidebar_social_color_hover',
					array(
						'label'      => 'Sidebar Social Icons Text Hover Color',
						'section'    => 'solopine_new_section_color_sidebar',
						'settings'   => 'sp_sidebar_social_color_hover',
						'priority'	 => 5
					)
				)
			);
			
			// Posts Color
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'posts_title_color',
					array(
						'label'      => 'Posts title color',
						'section'    => 'solopine_new_section_color_posts',
						'settings'   => 'sp_posts_title_color',
						'priority'	 => 1
					)
				)
			);
			
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'posts_share_box_border',
					array(
						'label'      => 'Share Box Border Color',
						'section'    => 'solopine_new_section_color_posts',
						'settings'   => 'sp_posts_share_box_border',
						'priority'	 => 2
					)
				)
			);
			
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'posts_share_box_bg',
					array(
						'label'      => 'Share Box Background Color',
						'section'    => 'solopine_new_section_color_posts',
						'settings'   => 'sp_posts_share_box_bg',
						'priority'	 => 3
					)
				)
			);
			
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'posts_share_box_color',
					array(
						'label'      => 'Share Box Icon Color',
						'section'    => 'solopine_new_section_color_posts',
						'settings'   => 'sp_posts_share_box_color',
						'priority'	 => 4
					)
				)
			);
			
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'posts_share_box_border_hover',
					array(
						'label'      => 'Share Box Border Hover Color',
						'section'    => 'solopine_new_section_color_posts',
						'settings'   => 'sp_posts_share_box_border_hover',
						'priority'	 => 5
					)
				)
			);
			
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'posts_share_box_bg_hover',
					array(
						'label'      => 'Share Box Background Hover Color',
						'section'    => 'solopine_new_section_color_posts',
						'settings'   => 'sp_posts_share_box_bg_hover',
						'priority'	 => 6
					)
				)
			);
			
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'posts_share_box_color_hover',
					array(
						'label'      => 'Share Box Icon Hover Color',
						'section'    => 'solopine_new_section_color_posts',
						'settings'   => 'sp_posts_share_box_color_hover',
						'priority'	 => 7
					)
				)
			);
			
			// Colors general
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'color_accent',
					array(
						'label'      => 'Accent',
						'section'    => 'solopine_new_section_color_general',
						'settings'   => 'sp_color_accent',
						'priority'	 => 1
					)
				)
			);
			
			$wp_customize->add_control(
			new Customize_CustomCss_Control(
				$wp_customize,
				'custom_css',
				array(
					'label'      => 'Custom CSS',
					'section'    => 'solopine_new_section_custom_css',
					'settings'   => 'sp_custom_css',
					'type'		 => 'custom_css',
					'priority'	 => 1
				)
			)
		);
		
	

	// Remove Sections
	$wp_customize->remove_section( 'title_tagline');
	$wp_customize->remove_section( 'nav');
	$wp_customize->remove_section( 'static_front_page');
	$wp_customize->remove_section( 'colors');
	$wp_customize->remove_section( 'background_image');
	
 
}
add_action( 'customize_register', 'solopine_register_theme_customizer' );
?>