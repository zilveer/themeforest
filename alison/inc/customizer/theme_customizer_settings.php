<?php 
// Prevent loading this file directly
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Customizer - Add Custom Styling

function gorilla_customizer_style()
{	
	$gorilla_template_uri = get_template_directory_uri();
	wp_enqueue_style('customizer', $gorilla_template_uri . '/inc/customizer/css/customizer.css');
	wp_enqueue_media();
}
add_action('customize_controls_print_styles', 'gorilla_customizer_style');

function gorilla_customizer_scripts(){
	$gorilla_template_uri = get_template_directory_uri();
	wp_enqueue_script('gorilla-theme-customizer', $gorilla_template_uri.'/inc/admin/assets/js/theme-customizer.js', '', '', true);
}
add_action('customize_controls_enqueue_scripts', 'gorilla_customizer_scripts',20);

// Customizer - Add Settings

function gorilla_register_theme_customizer( $wp_customize ) {
 	
/*------------------------------------------------------------
	SECTIONS
------------------------------------------------------------ */
	
	$wp_customize->add_section( 'gorilla_customize_section_general' , array(
   		'title'      => 'General Settings',
   		'description'=> '',
   		'priority'   => 88,
	) );

	$wp_customize->add_section( 'gorilla_customize_section_logo_header' , array(
   		'title'      => 'Logo and Header Settings',
   		'description'=> '',
   		'priority'   => 89,
	) );

	$wp_customize->add_section( 'gorilla_customize_section_home_intro' , array(
		'title'      => 'Header Intro Area Settings',
		'description'=> '',
		'priority'   => 90,
	) );

	$wp_customize->add_section( 'gorilla_customize_section_fonts' , array(
   		'title'      => 'Fonts Settings',
   		'description'=> '',
   		'priority'   => 91,
	) );

	$wp_customize->add_section( 'gorilla_customize_section_topbar' , array(
		'title'      => 'Top Bar Settings',
		'description'=> '',
		'priority'   => 92,
	) );

	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	if (is_plugin_active('alison-featured-slider/featured.php')) {
		$wp_customize->add_section( 'gorilla_customize_section_featured' , array(
			'title'      => 'Featured Slider Settings',
			'description'=> '',
			'priority'   => 93,
		) );
	}

	$wp_customize->add_section( 'gorilla_customize_section_featured_post_area' , array(
   		'title'      => 'Featured Post Area Settings',
   		'description'=> '',
   		'priority'   => 94,
	) );
	
	$wp_customize->add_section( 'gorilla_customize_section_post' , array(
   		'title'      => 'Post Settings',
   		'description'=> '',
   		'priority'   => 95,
	) );

	$wp_customize->add_section( 'gorilla_customize_section_page' , array(
   		'title'      => 'Page Settings',
   		'description'=> '',
   		'priority'   => 96,
	) );

	$wp_customize->add_section( 'gorilla_customize_section_social' , array(
   		'title'      => 'Social Media Settings',
   		'description'=> 'Please enter your social media link.',
   		'priority'   => 97,
	) );

	$wp_customize->add_section( 'gorilla_customize_section_footer' , array(
   		'title'      => 'Footer Settings',
   		'description'=> '',
   		'priority'   => 98,
	) );

	$wp_customize->add_section( 'gorilla_customize_section_color_general' , array(
   		'title'      => 'General Color Settings',
   		'description'=> '',
   		'priority'   => 99,
	) );

	$wp_customize->add_section( 'gorilla_customize_section_color_topbar' , array(
   		'title'      => 'Header & Menu Color Settings',
   		'description'=> '',
   		'priority'   => 100,
	) );

	$wp_customize->add_section( 'gorilla_customize_section_color_sidebar' , array(
   		'title'      => 'Sidebar Color Settings',
   		'description'=> '',
   		'priority'   => 101,
	) );

	$wp_customize->add_section( 'gorilla_customize_section_color_footer' , array(
   		'title'      => 'Footer Color Settings',
   		'description'=> '',
   		'priority'   => 102,
	) );	
	
	
/*------------------------------------------------------------
	DEFAULT VALUES
------------------------------------------------------------ */
		
		// General
		
		$wp_customize->add_setting(
			'gorilla_body_bg_color',
			array(
				'default'     => '#fff',
	        	'sanitize_callback' => 'sanitize_hex_color'
			)
		);

		$wp_customize->add_setting(
	        'gorilla_upload_body_bg_image',
	        array(
	        	'default' => '',
	        	'sanitize_callback' => 'esc_url_raw'
	    	)
	    );
	    
	    $wp_customize->add_setting(
	        'gorilla_body_bg_repeat',
	        array(
	            'default'     => 'no-repeat',
	        	'sanitize_callback' => 'esc_html'
	        )
	    );

		$wp_customize->add_setting(
	        'gorilla_body_bg_attachment',
	        array(
	            'default'     => 'scroll',
	        	'sanitize_callback' => 'esc_html'
	        )
	    );

		$wp_customize->add_setting(
	        'gorilla_upload_favicon',
	        array(
	        	'default' => '',
	        	'sanitize_callback' => 'esc_url_raw'
	    	)
	    );

		$wp_customize->add_setting(
	        'gorilla_home_layout',
	        array(
	            'default'     => 'full',
	        	'sanitize_callback' => 'esc_html'
	        )
	    );

		$wp_customize->add_setting(
	        'gorilla_archive_layout',
	        array(
	            'default'     => 'full',
	        	'sanitize_callback' => 'esc_html'
	        )
	    );

	    $wp_customize->add_setting(
	        'gorilla_pagination_type',
	        array(
	            'default'     => 'classic',
	        	'sanitize_callback' => 'esc_html'
	        )
	    );
		
		$wp_customize->add_setting(
	        'gorilla_sidebar_home',
	        array(
	            'default'     => true,
	        	'sanitize_callback' => 'esc_html'
	        )
	    );
		
		$wp_customize->add_setting(
	        'gorilla_sidebar_posts',
	        array(
	            'default'     => true,
	        	'sanitize_callback' => 'esc_html'
	        )
	    );


		$wp_customize->add_setting(
	        'gorilla_sidebar_page',
	        array(
	            'default'     => false,
	        	'sanitize_callback' => 'esc_html'
	        )
	    );
		
		$wp_customize->add_setting(
	        'gorilla_sidebar_archive',
	        array(
	            'default'     => false,
	        	'sanitize_callback' => 'esc_html'
	        )
	    );

	    $wp_customize->add_setting(
	        'gorilla_enable_smoothscrolling',
	        array(
	            'default'     => false,
	        	'sanitize_callback' => 'esc_html'
	        )
	    );

	    $wp_customize->add_setting(
	        'gorilla_enable_stickynav',
	        array(
	            'default'     => true,
	        	'sanitize_callback' => 'esc_html'
	        )
	    );

	    $wp_customize->add_setting(
	        'gorilla_enable_stickysidebar',
	        array(
	            'default'     => true,
	        	'sanitize_callback' => 'esc_html'
	        )
	    );

/*------------------------------------------------------------ */


		// Header and logo
		$wp_customize->add_setting(
	        'gorilla_logo',
	        array(
	        	'default' => '',
	        	'sanitize_callback' => 'esc_url_raw'
	    	)
	    );

	    $wp_customize->add_setting(
	        'gorilla_logo_width',
	        array(
	        	'default' => '',
	        	'sanitize_callback' => 'esc_attr'
	    	)
	    );

	    $wp_customize->add_setting(
	        'gorilla_logo_height',
	        array(
	        	'default' => '',
	        	'sanitize_callback' => 'esc_attr'
	    	)
	    );

		$wp_customize->add_setting(
	        'gorilla_header_padding',
	        array(
	            'default'     => '60',
	        	'sanitize_callback' => 'esc_html'
	        )
	    );


/*------------------------------------------------------------*/
		
		//Fonts
		$wp_customize->add_setting(
	        'gorilla_content_font',
	        array(
	            'default'     => "0",
	        	'sanitize_callback' => 'esc_html'
	        )
	    );

	    $wp_customize->add_setting(
	        'gorilla_headings_font',
	        array(
	            'default'     => "0",
	        	'sanitize_callback' => 'esc_html'
	        )
	    );

	    $wp_customize->add_setting(
	        'gorilla_navigation_font',
	        array(
	            'default'     => "0",
	        	'sanitize_callback' => 'esc_html'
	        )
	    );
			

/*------------------------------------------------------------ */
		
		// Top Bar
		$wp_customize->add_setting(
	        'gorilla_topbar_social_check',
	        array(
	            'default'     => true,
	        	'sanitize_callback' => 'esc_html'
	        )
	    );

		$wp_customize->add_setting(
	        'gorilla_topbar_search_check',
	        array(
	            'default'     => true,
	        	'sanitize_callback' => 'esc_html'
	        )
	    );

/*------------------------------------------------------------ */
		
		// Featured slider
		$wp_customize->add_setting(
	        'gorilla_featured_area',
	        array(
	            'default'     => true,
	        	'sanitize_callback' => 'esc_html'
	        )
	    );

	    $wp_customize->add_setting(
	        'gorilla_featured_area_width',
	        array(
	            'default'     => "boxed",
	        	'sanitize_callback' => 'esc_html'
	        )
	    );

	    $wp_customize->add_setting(
	        'gorilla_featured_area_transition',
	        array(
	            'default'     => "slide",
	        	'sanitize_callback' => 'esc_html'
	        )
	    );

	    $wp_customize->add_setting(
	        'gorilla_featured_area_autoplay_enabled',
	        array(
	            'default'     => "true",
	        	'sanitize_callback' => 'esc_html'
	        )
	    );

		$wp_customize->add_setting(
	        'gorilla_featured_cat_hide',
	        array(
	            'default'     => false,
	        	'sanitize_callback' => 'esc_html'
	        )
	    );

	    $wp_customize->add_setting(
	        'gorilla_featured_date_hide',
	        array(
	            'default'     => false,
	        	'sanitize_callback' => 'esc_html'
	        )
	    );

	    $wp_customize->add_setting(
	        'gorilla_featured_author_hide',
	        array(
	            'default'     => false,
	        	'sanitize_callback' => 'esc_html'
	        )
	    );

		$wp_customize->add_setting(
	        'gorilla_featured_area_slides',
	        array(
	            'default'     => '4',
	        	'sanitize_callback' => 'esc_html'
	        )
	    );
	    

/*------------------------------------------------------------ */

		// Header Intro Area
		$wp_customize->add_setting(
	        'gorilla_layout_enable_home_intro',
	        array(
	            'default'     => false,
	        	'sanitize_callback' => 'esc_html'
	        )
	    );

		$wp_customize->add_setting(
	        'gorilla_layout_title',
	        array(
	            'default'     => '',
	        	'sanitize_callback' => 'gorilla_sanitize_wpkses_layout'
	        )
	    );
	    
		$wp_customize->add_setting(
	        'gorilla_layout_sub',
	        array(
	            'default'     => '',
	        	'sanitize_callback' => 'gorilla_sanitize_wpkses_layout'
	        )
	    );

	    $wp_customize->add_setting(
	        'gorilla_layout_text',
	        array(
	            'default'     => '',
	        	'sanitize_callback' => 'gorilla_sanitize_wpkses_layout'
	        )
	    );

		$wp_customize->add_setting(
			'gorilla_layout_text_color',
			array(
				'default'     => '#111',
	        	'sanitize_callback' => 'sanitize_hex_color'
			)
		);


/*------------------------------------------------------------ */

		// Featured Post Area Settings
		$wp_customize->add_setting(
	        'gorilla_enable_featured_post_area',
	        array(
	            'default'     => false,
	        	'sanitize_callback' => 'esc_html'
	        )
	    );

		$wp_customize->add_setting(
	        'gorilla_select_featured_post_area_category',
	        array(
	            'default'     => "",
	        	'sanitize_callback' => 'esc_html'
	        )
	    );

	    $wp_customize->add_setting(
	        'gorilla_featured_post_area_cat_hide',
	        array(
	            'default'     => false,
	        	'sanitize_callback' => 'esc_html'
	        )
	    );

	    $wp_customize->add_setting(
	        'gorilla_featured_post_area_date_hide',
	        array(
	            'default'     => false,
	        	'sanitize_callback' => 'esc_html'
	        )
	    );
		

/*------------------------------------------------------------ */
		

		// Post Settings
		$wp_customize->add_setting(
	        'gorilla_post_tags',
	        array(
	            'default'     => false,
	        	'sanitize_callback' => 'esc_html'
	        )
	    );

		$wp_customize->add_setting(
	        'gorilla_post_author',
	        array(
	            'default'     => false,
	        	'sanitize_callback' => 'esc_html'
	        )
	    );

		$wp_customize->add_setting(
	        'gorilla_post_author_box',
	        array(
	            'default'     => false,
	        	'sanitize_callback' => 'esc_html'
	        )
	    );

		$wp_customize->add_setting(
	        'gorilla_post_related',
	        array(
	            'default'     => false,
	        	'sanitize_callback' => 'esc_html'
	        )
	    );

		$wp_customize->add_setting(
	        'gorilla_post_share',
	        array(
	            'default'     => false,
	        	'sanitize_callback' => 'esc_html'
	        )
	    );

		$wp_customize->add_setting(
	        'gorilla_post_nav',
	        array(
	            'default'     => false,
	        	'sanitize_callback' => 'esc_html'
	        )
	    );

		$wp_customize->add_setting(
	        'gorilla_post_date',
	        array(
	            'default'     => false,
	        	'sanitize_callback' => 'esc_html'
	        )
	    );

		$wp_customize->add_setting(
	        'gorilla_post_cat',
	        array(
	            'default'     => false,
	        	'sanitize_callback' => 'esc_html'
	        )
	    );


/*------------------------------------------------------------ */
		
		// Page Settings
		$wp_customize->add_setting(
	        'gorilla_page_comments',
	        array(
	            'default'     => false,
	        	'sanitize_callback' => 'esc_html'
	        )
	    );

/*------------------------------------------------------------ */

		// Social Media
		$wp_customize->add_setting(
	        'gorilla_facebook',
	        array(
	            'default'     => '#',
	            'sanitize_callback' => 'esc_url_raw'
	        )
	    );

		$wp_customize->add_setting(
	        'gorilla_twitter',
	        array(
	            'default'     => '#',
	            'sanitize_callback' => 'esc_url_raw'
	        )
	    );

		$wp_customize->add_setting(
	        'gorilla_instagram',
	        array(
	            'default'     => '#',
	            'sanitize_callback' => 'esc_url_raw'
	        )
	    );

		$wp_customize->add_setting(
	        'gorilla_pinterest',
	        array(
	            'default'     => '#',
	            'sanitize_callback' => 'esc_url_raw'
	        )
	    );

		$wp_customize->add_setting(
	        'gorilla_linkedin',
	        array(
	            'default'     => '',
	            'sanitize_callback' => 'esc_url_raw'
	        )
	    );

		$wp_customize->add_setting(
	        'gorilla_tumblr',
	        array(
	            'default'     => '',
	            'sanitize_callback' => 'esc_url_raw'
	        )
	    );

		$wp_customize->add_setting(
	        'gorilla_google',
	        array(
	            'default'     => '',
	            'sanitize_callback' => 'esc_url_raw'
	        )
	    );

		$wp_customize->add_setting(
	        'gorilla_youtube',
	        array(
	            'default'     => '',
	            'sanitize_callback' => 'esc_url_raw'
	        )
	    );

	    $wp_customize->add_setting(
	        'gorilla_bloglovin',
	        array(
	            'default'     => '',
	            'sanitize_callback' => 'esc_url_raw'
	        )
	    );

/*------------------------------------------------------------ */
		
		// Footer Options
	    $wp_customize->add_setting(
	        'gorilla_after_content_area_width',
	        array(
	            'default'     => "full",
	        	'sanitize_callback' => 'esc_html'
	        )
	    );

		$wp_customize->add_setting(
	        'gorilla_footer_widget_area',
	        array(
	            'default'     => true,
	        	'sanitize_callback' => 'esc_html'
	        )
	    );

	    $wp_customize->add_setting(
	        'gorilla_footer_image_bg',
	        array(
	            'default'     => '',
	            'sanitize_callback' => 'esc_url_raw'
	        )
	    );

	    $wp_customize->add_setting(
	        'gorilla_footer_widget_column_number',
	        array(
	            'default'     => false,
	        	'sanitize_callback' => 'esc_html'
	        )
	    );

	    $wp_customize->add_setting(
	        'gorilla_footer_navigation',
	        array(
	            'default'     => false,
	        	'sanitize_callback' => 'esc_html'
	        )
	    );

		$wp_customize->add_setting(
	        'gorilla_footer_copyright',
	        array(
	            'default'     => 'Alison is a creative soft blog theme made with <i class="fa fa-heart"></i> by angrygorilla.',
	        	'sanitize_callback' => 'gorilla_sanitize_wpkses_layout'
	        )
	    );

/*------------------------------------------------------------ */
		
		// Color Options

			// Color general
			$wp_customize->add_setting(
				'gorilla_color_accent',
				array(
					'default'     => '#E87A55',
	            	'sanitize_callback' => 'sanitize_hex_color'
				)
			);

			$wp_customize->add_setting(
				'gorilla_text_color',
				array(
					'default'     => '#222',
	            	'sanitize_callback' => 'sanitize_hex_color'
				)
			);

			$wp_customize->add_setting(
				'gorilla_headings_color',
				array(
					'default'     => '#111',
	            	'sanitize_callback' => 'sanitize_hex_color'
				)
			);

		
			// Top bar

			$wp_customize->add_setting(
				'gorilla_topbar_bg',
				array(
					'default'     => '#fff',
	            	'sanitize_callback' => 'sanitize_hex_color'
				)
			);

			$wp_customize->add_setting(
				'gorilla_topbar_nav_color',
				array(
					'default'     => '#111',
	            	'sanitize_callback' => 'sanitize_hex_color'
				)
			);

			$wp_customize->add_setting(
				'gorilla_topbar_nav_color_active',
				array(
					'default'     => '#E87A55',
	            	'sanitize_callback' => 'sanitize_hex_color'
				)
			);
			
			$wp_customize->add_setting(
				'gorilla_drop_bg',
				array(
					'default'     => '#fff',
	            	'sanitize_callback' => 'sanitize_hex_color'
				)
			);

			$wp_customize->add_setting(
				'gorilla_drop_border',
				array(
					'default'     => "#fff",
	            	'sanitize_callback' => 'sanitize_hex_color'
				)
			);

			$wp_customize->add_setting(
				'gorilla_drop_text_color',
				array(
					'default'     => '#111',
	            	'sanitize_callback' => 'sanitize_hex_color'
				)
			);

			$wp_customize->add_setting(
				'gorilla_drop_text_hover_color',
				array(
					'default'     => '#e87a55',
	            	'sanitize_callback' => 'sanitize_hex_color'
				)
			);
			
			// Footer
			$wp_customize->add_setting(
				'gorilla_footer_widget_area_bg_color',
				array(
					'default'     => '#191919',
	            	'sanitize_callback' => 'sanitize_hex_color'
				)
			);

			$wp_customize->add_setting(
				'gorilla_footer_widget_color',
				array(
					'default'     => '#fff',
	            	'sanitize_callback' => 'sanitize_hex_color'
				)
			);

			$wp_customize->add_setting(
				'gorilla_footer_widget_text_color',
				array(
					'default'     => '#fff',
	            	'sanitize_callback' => 'sanitize_hex_color'
				)
			);


			$wp_customize->add_setting(
				'gorilla_footer_widget_text_secondary_color',
				array(
					'default'     => '#999',
	            	'sanitize_callback' => 'sanitize_hex_color'
				)
			);

			$wp_customize->add_setting(
				'gorilla_footer_widget_links_hover_color',
				array(
					'default'     => '',
	            	'sanitize_callback' => 'sanitize_hex_color'
				)
			);


			$wp_customize->add_setting(
				'gorilla_footer_text_bg_color',
				array(
					'default'     => '#222',
	            	'sanitize_callback' => 'sanitize_hex_color'
				)
			);

			$wp_customize->add_setting(
				'gorilla_footer_tag_text_color',
				array(
					'default'     => '#fff',
	            	'sanitize_callback' => 'sanitize_hex_color'
				)
			);


			$wp_customize->add_setting(
				'gorilla_footer_copyright_bg',
				array(
					'default'     => '#fff',
	            	'sanitize_callback' => 'sanitize_hex_color'
				)
			);

			$wp_customize->add_setting(
				'gorilla_footer_copyright_color',
				array(
					'default'     => '#777',
	            	'sanitize_callback' => 'sanitize_hex_color'
				)
			);
			
			// Sidebar color
			$wp_customize->add_setting(
				'gorilla_sidebar_bg_color',
				array(
					'default'     => '#fff',
	            	'sanitize_callback' => 'sanitize_hex_color'
				)
			);
			$wp_customize->add_setting(
				'gorilla_sidebar_color',
				array(
					'default'     => '#111',
	            	'sanitize_callback' => 'sanitize_hex_color'
				)
			);


/*------------------------------------------------------------ */


function gorilla_sanitize_wpkses_layout( $value ) {
    $value = wp_kses($value, wp_kses_allowed_html( 'post' ));
    return $value;
}



/*------------------------------------------------------------
	GENERAL SETTINGS
------------------------------------------------------------ */

		// Site Background Options
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'body_bg_color',
				array(
					'label'      => 'Body Background Color',
					'section'    => 'gorilla_customize_section_general',
					'settings'   => 'gorilla_body_bg_color',
					'priority'	 => 1
				)
			)
		);

		// Body Bg Image
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'upload_body_bg_image',
				array(
					'label'      => 'Body Background Image',
					'section'    => 'gorilla_customize_section_general',
					'settings'   => 'gorilla_upload_body_bg_image',
					'priority'	 => 1
				)
			)
		);


		// Body Bg Repeat
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'body_bg_repeat',
				array(
					'label'      => 'Body Background Image Repeat',
					'section'    => 'gorilla_customize_section_general',
					'settings'   => 'gorilla_body_bg_repeat',
					'type'		 => 'select',
					'priority'	 => 2,
					'choices'        => array(
						'no-repeat'   => 'No Repeat',
						'repeat'  => 'Repeat'
					)
				)
			)
		);

		// Bodg Image Fıxed/Scroll
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'body_bg_attachment',
				array(
					'label'      => 'Body Background Style',
					'section'    => 'gorilla_customize_section_general',
					'settings'   => 'gorilla_body_bg_attachment',
					'type'		 => 'select',
					'priority'	 => 2,
					'choices'        => array(
						'scroll'   => 'Normal',
						'fixed'  => 'Fixed'
					)
				)
			)
		);

		// Favicon
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'upload_favicon',
				array(
					'label'      => 'Favicon',
					'section'    => 'gorilla_customize_section_general',
					'settings'   => 'gorilla_upload_favicon',
					'priority'	 => 7
				)
			)
		);

		// Archive Page Layouts
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'archive_layout',
				array(
					'label'          => 'Archive Pages Layout',
					'section'        => 'gorilla_customize_section_general',
					'settings'       => 'gorilla_archive_layout',
					'type'           => 'radio',
					'priority'	 => 13,
					'choices'        => array(
						'full'   => 'Full Posts',
						'masonry'  => 'Masonry Posts',
						'list'  => 'List Posts'
					)
				)
			)
		);

		// Pageniation System
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'pagination_type',
				array(
					'label'          => 'Pagination Type',
					'section'        => 'gorilla_customize_section_general',
					'settings'       => 'gorilla_pagination_type',
					'type'           => 'radio',
					'priority'	 => 14,
					'choices'        => array(
						'classic'   => 'Classic',
						'load-more'  => 'Load More'
					)
				)
			)
		);

		// Home Page Layout
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'home_layout',
				array(
					'label'          => 'Homepage Layout',
					'section'        => 'gorilla_customize_section_general',
					'settings'       => 'gorilla_home_layout',
					'type'           => 'radio',
					'priority'	 => 8,
					'choices'        => array(
						'full'   => 'Full Posts',
						'masonry'  => 'Masonry Posts',
						'list'  => 'List Posts'
					)
				)
			)
		);
		
		// Sidebar @HomePage
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'sidebar_home',
				array(
					'label'      => 'Enable Sidebar on Homepage',
					'section'    => 'gorilla_customize_section_general',
					'settings'   => 'gorilla_sidebar_home',
					'type'		 => 'checkbox',
					'priority'	 => 15
				)
			)
		);

		// Sidebar @Posts
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'sidebar_posts',
				array(
					'label'      => 'Enable Sidebar on Posts',
					'section'    => 'gorilla_customize_section_general',
					'settings'   => 'gorilla_sidebar_posts',
					'type'		 => 'checkbox',
					'priority'	 => 16
				)
			)
		);

		// Sidebar @Page
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'sidebar_page',
				array(
					'label'      => 'Enable Sidebar on Pages',
					'section'    => 'gorilla_customize_section_general',
					'settings'   => 'gorilla_sidebar_page',
					'type'		 => 'checkbox',
					'priority'	 => 16
				)
			)
		);

		// Sidebar @Archives
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'sidebar_archive',
				array(
					'label'      => 'Enable Sidebar on Archives',
					'section'    => 'gorilla_customize_section_general',
					'settings'   => 'gorilla_sidebar_archive',
					'type'		 => 'checkbox',
					'priority'	 => 17
				)
			)
		);

		// Smooth Scrolling
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'enable_smoothscrolling',
				array(
					'label'      => 'Enable Smooth Scrolling',
					'section'    => 'gorilla_customize_section_general',
					'settings'   => 'gorilla_enable_smoothscrolling',
					'type'		 => 'checkbox',
					'priority'	 => 18
				)
			)
		);

		// Sticky Nav
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'enable_stickynav',
				array(
					'label'      => 'Enable Sticky Navigation',
					'section'    => 'gorilla_customize_section_general',
					'settings'   => 'gorilla_enable_stickynav',
					'type'		 => 'checkbox',
					'priority'	 => 18
				)
			)
		);

		// Sticky Sidebar
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'enable_stickysidebar',
				array(
					'label'      => 'Enable Sticky Sidebar',
					'section'    => 'gorilla_customize_section_general',
					'settings'   => 'gorilla_enable_stickysidebar',
					'type'		 => 'checkbox',
					'priority'	 => 18
				)
			)
		);


/*------------------------------------------------------------
	LOGO & HEADER SETTINGS
------------------------------------------------------------ */		
		
		// Header Logo
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'upload_logo',
				array(
					'label'      => 'Upload Logo',
					'section'    => 'gorilla_customize_section_logo_header',
					'settings'   => 'gorilla_logo',
					'priority'	 => 20
				)
			)
		);

		// Header Logo Width
		$wp_customize->add_control(
			new Customize_Number_Control(
				$wp_customize,
				'logo_width',
				array(
					'label'      => 'Logo Width',
					'section'    => 'gorilla_customize_section_logo_header',
					'settings'   => 'gorilla_logo_width',
					'type'		 => 'number',
					'priority'	 => 22
				)
			)
		);

		// Header Logo Height
		$wp_customize->add_control(
			new Customize_Number_Control(
				$wp_customize,
				'logo_height',
				array(
					'label'      => 'Logo Height',
					'section'    => 'gorilla_customize_section_logo_header',
					'settings'   => 'gorilla_logo_height',
					'type'		 => 'number',
					'priority'	 => 22
				)
			)
		);
		
		// Header Padding
		$wp_customize->add_control(
			new Customize_Number_Control(
				$wp_customize,
				'header_padding',
				array(
					'label'      => 'Top & Bottom Header Padding',
					'section'    => 'gorilla_customize_section_logo_header',
					'settings'   => 'gorilla_header_padding',
					'type'		 => 'number',
					'priority'	 => 22
				)
			)
		);
		
		// Top Bar Social Icons
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'topbar_social_check',
				array(
					'label'      => 'Enable Header Social Icons',
					'section'    => 'gorilla_customize_section_topbar',
					'settings'   => 'gorilla_topbar_social_check',
					'type'		 => 'checkbox',
					'priority'	 => 3
				)
			)
		);

		// Search @Topbar
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'topbar_search_check',
				array(
					'label'      => 'Enable Header Search',
					'section'    => 'gorilla_customize_section_topbar',
					'settings'   => 'gorilla_topbar_search_check',
					'type'		 => 'checkbox',
					'priority'	 => 4
				)
			)
		);


/*------------------------------------------------------------
	FONT SETTINGS
------------------------------------------------------------ */
		
		// Content Font 
		$wp_customize->add_control(
			new Google_Font_Dropdown_Custom_Control(
				$wp_customize,
				'content_font',
				array(
					'label'      => 'Content Font',
					'section'    => 'gorilla_customize_section_fonts',
					'settings'   => 'gorilla_content_font',
					'priority'	 => 20
				)
			)
		);

		// Headings Font 
		$wp_customize->add_control(
			new Google_Font_Dropdown_Custom_Control(
				$wp_customize,
				'headings_font',
				array(
					'label'      => 'Headings Font',
					'section'    => 'gorilla_customize_section_fonts',
					'settings'   => 'gorilla_headings_font',
					'priority'	 => 21
				)
			)
		);

		// Navigation Font
		$wp_customize->add_control(
			new Google_Font_Dropdown_Custom_Control(
				$wp_customize,
				'navigation_font',
				array(
					'label'      => 'Navigation Font',
					'section'    => 'gorilla_customize_section_fonts',
					'settings'   => 'gorilla_navigation_font',
					'priority'	 => 21
				)
			)
		);


/*------------------------------------------------------------
	FEATURED SLIDER
------------------------------------------------------------ */
		
	if (is_plugin_active('alison-featured-slider/featured.php')) {
		// Enable Featured Slider
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'featured_area',
				array(
					'label'      => 'Enable Featured Slider',
					'section'    => 'gorilla_customize_section_featured',
					'settings'   => 'gorilla_featured_area',
					'type'		 => 'checkbox',
					'priority'	 => 1
				)
			)
		);

		// Featured Slider Width
		$wp_customize->add_control(
			'featured_area_width', 
			array(
				'label'    => 'Featured Slider Width',
				'section'  => 'gorilla_customize_section_featured',
				'settings' => 'gorilla_featured_area_width',
				'type'     => 'radio',
				'choices'  => array(
					'full'  => 'Full',
					'boxed' => 'Boxed',
				),
				'priority'	 => 3
			)
		);

		// Featured Slider Transition
		$wp_customize->add_control(
			'featured_area_transition', 
			array(
				'label'    => 'Slider Transition',
				'section'  => 'gorilla_customize_section_featured',
				'settings' => 'gorilla_featured_area_transition',
				'type'     => 'select',
				'choices'  => array(
					'fade'  => 'Fade',
					'slide' => 'Slide'
				),
				'priority'	 => 4
			)
		);

		// Featured Slider Autoplay?
		$wp_customize->add_control(
			'featured_area_autoplay_enabled', 
			array(
				'label'    => 'Autoplay Enabled?',
				'section'  => 'gorilla_customize_section_featured',
				'settings' => 'gorilla_featured_area_autoplay_enabled',
				'type'     => 'checkbox',
				'priority'	 => 5
			)
		);
		
		// Hide Category from Featured Slider
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'featured_cat_hide',
				array(
					'label'      => 'Hide Featured Category',
					'section'    => 'gorilla_customize_section_featured',
					'settings'   => 'gorilla_featured_cat_hide',
					'type'		 => 'checkbox',
					'priority'	 => 6
				)
			)
		);

		// Hide Date from Featured Slider
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'featured_date_hide',
				array(
					'label'      => 'Hide Featured Date',
					'section'    => 'gorilla_customize_section_featured',
					'settings'   => 'gorilla_featured_date_hide',
					'type'		 => 'checkbox',
					'priority'	 => 7
				)
			)
		);

		// Hide Author from Featured Slider
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'featured_author_hide',
				array(
					'label'      => 'Hide Featured Author',
					'section'    => 'gorilla_customize_section_featured',
					'settings'   => 'gorilla_featured_author_hide',
					'type'		 => 'checkbox',
					'priority'	 => 8
				)
			)
		);
		
		// Slide Amount
		$wp_customize->add_control(
			new Customize_Number_Control(
				$wp_customize,
				'featured_area_slides',
				array(
					'label'      => 'Amount of Slides',
					'section'    => 'gorilla_customize_section_featured',
					'settings'   => 'gorilla_featured_area_slides',
					'type'		 => 'number',
					'priority'	 => 9
				)
			)
		);
	}


/*------------------------------------------------------------
	HEADER INTRO AREA
------------------------------------------------------------ */

		// Enable Header Intro Area
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'layout_enable_home_intro',
				array(
					'label'      => 'Enable Header Intro Area',
					'section'    => 'gorilla_customize_section_home_intro',
					'settings'   => 'gorilla_layout_enable_home_intro',
					'type'		 => 'checkbox',
					'priority'	 => 0
				)
			)
		);

		// Header Heading
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'layout_title',
				array(
					'label'      => 'Header Intro: Heading',
					'section'    => 'gorilla_customize_section_home_intro',
					'settings'   => 'gorilla_layout_title',
					'type'		 => 'text',
					'priority'	 => 2
				)
			)
		);

		// Header Sub Heading
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'layout_sub',
				array(
					'label'      => 'Header Intro: Sub heading',
					'section'    => 'gorilla_customize_section_home_intro',
					'settings'   => 'gorilla_layout_sub',
					'type'		 => 'text',
					'priority'	 => 3
				)
			)
		);

		// Header Text
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'layout_text',
				array(
					'label'      => 'Header Intro: Text',
					'section'    => 'gorilla_customize_section_home_intro',
					'settings'   => 'gorilla_layout_text',
					'type'		 => 'textarea',
					'priority'	 => 4
				)
			)
		);

		// Header General Text Color
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'layout_color',
				array(
					'label'      => 'Header Intro: Text Color',
					'section'    => 'gorilla_customize_section_home_intro',
					'settings'   => 'gorilla_layout_text_color',
					'priority'	 => 5
				)
			)
		);

/*------------------------------------------------------------
	FEATURED POST AREA SETTINGS
------------------------------------------------------------ */

		// Hide Featured Post Area
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'enable_featured_post_area',
				array(
					'label'      => 'Enable Featured Post Area',
					'section'    => 'gorilla_customize_section_featured_post_area',
					'settings'   => 'gorilla_enable_featured_post_area',
					'type'		 => 'checkbox',
					'priority'	 => 1
				)
			)
		);

		// Select Category From Featured Post Area
		$wp_customize->add_control(
			new Customize_MultipleCategorySelect_Control(
				$wp_customize,
				'select_featured_post_area_category',
				array(
					'label'      => 'Featured Post Area Category',
					'description' => 'If you don\'t select any category, all categories will be used.',
					'section'    => 'gorilla_customize_section_featured_post_area',
					'settings'   => 'gorilla_select_featured_post_area_category',
					'priority'	 => 1
				)
			)
		);

		// Hide Category from Featured Post Area
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'featured_post_area_cat_hide',
				array(
					'label'      => 'Hide Category',
					'section'    => 'gorilla_customize_section_featured_post_area',
					'settings'   => 'gorilla_featured_post_area_cat_hide',
					'type'		 => 'checkbox',
					'priority'	 => 2
				)
			)
		);

		// Hide Date from Featured Post Area
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'featured_post_area_date_hide',
				array(
					'label'      => 'Hide Date',
					'section'    => 'gorilla_customize_section_featured_post_area',
					'settings'   => 'gorilla_featured_post_area_date_hide',
					'type'		 => 'checkbox',
					'priority'	 => 3
				)
			)
		);

/*------------------------------------------------------------
	POST SETTINGS
------------------------------------------------------------ */

		// Hide Category From Posts
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'post_cat',
				array(
					'label'      => 'Hide Category',
					'section'    => 'gorilla_customize_section_post',
					'settings'   => 'gorilla_post_cat',
					'type'		 => 'checkbox',
					'priority'	 => 1
				)
			)
		);

		// Hide Category From Posts
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'post_date',
				array(
					'label'      => 'Hide Date',
					'section'    => 'gorilla_customize_section_post',
					'settings'   => 'gorilla_post_date',
					'type'		 => 'checkbox',
					'priority'	 => 2
				)
			)
		);

		// Hide Author From Posts
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'post_author',
				array(
					'label'      => 'Hide Author',
					'section'    => 'gorilla_customize_section_post',
					'settings'   => 'gorilla_post_author',
					'type'		 => 'checkbox',
					'priority'	 => 3
				)
			)
		);

		// Hide Tags From Posts
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'post_tags',
				array(
					'label'      => 'Hide Tags',
					'section'    => 'gorilla_customize_section_post',
					'settings'   => 'gorilla_post_tags',
					'type'		 => 'checkbox',
					'priority'	 => 4
				)
			)
		);

		// Hide Share Buttons From Posts
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'post_share',
				array(
					'label'      => 'Hide Share Buttons',
					'section'    => 'gorilla_customize_section_post',
					'settings'   => 'gorilla_post_share',
					'type'		 => 'checkbox',
					'priority'	 => 5
				)
			)
		);

		// Hide Author Box 
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'post_author_box',
				array(
					'label'      => 'Hide Author Box',
					'section'    => 'gorilla_customize_section_post',
					'settings'   => 'gorilla_post_author_box',
					'type'		 => 'checkbox',
					'priority'	 => 6
				)
			)
		);

		// Hide Related Posts Box
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'post_related',
				array(
					'label'      => 'Hide Related Posts Box',
					'section'    => 'gorilla_customize_section_post',
					'settings'   => 'gorilla_post_related',
					'type'		 => 'checkbox',
					'priority'	 => 7
				)
			)
		);

		// Hide Related Posts Box ???
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'post_nav',
				array(
					'label'      => 'Hide Next/Prev Post Navigation',
					'section'    => 'gorilla_customize_section_post',
					'settings'   => 'gorilla_post_nav',
					'type'		 => 'checkbox',
					'priority'	 => 9
				)
			)
		);
		

/*------------------------------------------------------------
	PAGE SETTINGS
------------------------------------------------------------ */

		// Hide Comments
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'page_comments',
				array(
					'label'      => 'Hide Comments',
					'section'    => 'gorilla_customize_section_page',
					'settings'   => 'gorilla_page_comments',
					'type'		 => 'checkbox',
					'priority'	 => 1
				)
			)
		);
		

/*------------------------------------------------------------
	SOCIAL MEDIA LINKS
------------------------------------------------------------ */


		// Facebook
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'facebook',
				array(
					'label'      => 'Facebook',
					'section'    => 'gorilla_customize_section_social',
					'settings'   => 'gorilla_facebook',
					'type'		 => 'text',
					'priority'	 => 1
				)
			)
		);

		// Twitter
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'twitter',
				array(
					'label'      => 'Twitter',
					'section'    => 'gorilla_customize_section_social',
					'settings'   => 'gorilla_twitter',
					'type'		 => 'text',
					'priority'	 => 2
				)
			)
		);

		// Instagram
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'instagram',
				array(
					'label'      => 'Instagram',
					'section'    => 'gorilla_customize_section_social',
					'settings'   => 'gorilla_instagram',
					'type'		 => 'text',
					'priority'	 => 3
				)
			)
		);

		// Pinterest
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'pinterest',
				array(
					'label'      => 'Pinterest',
					'section'    => 'gorilla_customize_section_social',
					'settings'   => 'gorilla_pinterest',
					'type'		 => 'text',
					'priority'	 => 4
				)
			)
		);

		// Linkedin
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'linkedin',
				array(
					'label'      => 'Linkedin',
					'section'    => 'gorilla_customize_section_social',
					'settings'   => 'gorilla_linkedin',
					'type'		 => 'text',
					'priority'	 => 5
				)
			)
		);

		// Google Plus
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'google',
				array(
					'label'      => 'Google Plus',
					'section'    => 'gorilla_customize_section_social',
					'settings'   => 'gorilla_google',
					'type'		 => 'text',
					'priority'	 => 6
				)
			)
		);

		// Tumblr
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'tumblr',
				array(
					'label'      => 'Tumblr',
					'section'    => 'gorilla_customize_section_social',
					'settings'   => 'gorilla_tumblr',
					'type'		 => 'text',
					'priority'	 => 7
				)
			)
		);

		// Youtube
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'youtube',
				array(
					'label'      => 'Youtube',
					'section'    => 'gorilla_customize_section_social',
					'settings'   => 'gorilla_youtube',
					'type'		 => 'text',
					'priority'	 => 8
				)
			)
		);

		// BlogLovin
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'bloglovin',
				array(
					'label'      => 'Bloglovin',
					'section'    => 'gorilla_customize_section_social',
					'settings'   => 'gorilla_bloglovin',
					'type'		 => 'text',
					'priority'	 => 9
				)
			)
		);

		

/*------------------------------------------------------------
	FOOTER SETTINGS
------------------------------------------------------------ */

		// After Content Widget Area Width
		$wp_customize->add_control(
			'after_content_area_width', 
			array(
				'label'    => 'After Content Widget Area Width',
				'section'  => 'gorilla_customize_section_footer',
				'settings' => 'gorilla_after_content_area_width',
				'type'     => 'radio',
				'choices'  => array(
					'full'  => 'Full',
					'boxed' => 'Boxed',
				),
				'priority'	 => 1
			)
		);
		
		// Enable Footer Widget Area
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'footer_widget_area',
				array(
					'label'      => 'Enable Footer Widget Area',
					'section'    => 'gorilla_customize_section_footer',
					'settings'   => 'gorilla_footer_widget_area',
					'type'		 => 'checkbox',
					'priority'	 => 1
				)
			)
		);

		// Footer Bg Image
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'footer_image_bg',
				array(
					'label'      => 'Footer Bg Image',
					'section'    => 'gorilla_customize_section_footer',
					'settings'   => 'gorilla_footer_image_bg',
					'priority'	 => 1
				)
			)
		);

		// Enable Footer Widget Area
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'footer_widget_area_column_number',
				array(
					'label'      => 'Use 4 Column Footer',
					'section'    => 'gorilla_customize_section_footer',
					'settings'   => 'gorilla_footer_widget_column_number',
					'type'		 => 'checkbox',
					'priority'	 => 2
				)
			)
		);

		// Enable Footer Navigation
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'footer_navigation',
				array(
					'label'      => 'Enable Footer Navigation',
					'section'    => 'gorilla_customize_section_footer',
					'settings'   => 'gorilla_footer_navigation',
					'type'		 => 'checkbox',
					'priority'	 => 3
				)
			)
		);

		// Footer Text
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'footer_copyright',
				array(
					'label'      => 'Footer Copyright Text',
					'section'    => 'gorilla_customize_section_footer',
					'settings'   => 'gorilla_footer_copyright',
					'type'		 => 'text',
					'priority'	 => 4
				)
			)
		);


/*------------------------------------------------------------
	COLOR SETTINGS
------------------------------------------------------------ */
		
		// Colors general
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'color_accent',
				array(
					'label'      => 'Accent',
					'section'    => 'gorilla_customize_section_color_general',
					'settings'   => 'gorilla_color_accent',
					'priority'	 => 1
				)
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'text_color',
				array(
					'label'      => 'General Text Color',
					'section'    => 'gorilla_customize_section_color_general',
					'settings'   => 'gorilla_text_color',
					'priority'	 => 2
				)
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'headings_color',
				array(
					'label'      => 'Headings Color',
					'section'    => 'gorilla_customize_section_color_general',
					'settings'   => 'gorilla_headings_color',
					'priority'	 => 3
				)
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'topbar_bg',
				array(
					'label'      => 'Menu BG',
					'section'    => 'gorilla_customize_section_color_topbar',
					'settings'   => 'gorilla_topbar_bg',
					'priority'	 => 1
				)
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'topbar_nav_color',
				array(
					'label'      => 'Menu Text Color',
					'section'    => 'gorilla_customize_section_color_topbar',
					'settings'   => 'gorilla_topbar_nav_color',
					'priority'	 => 2
				)
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'topbar_nav_color_active',
				array(
					'label'      => 'Menu Text Hover Color',
					'section'    => 'gorilla_customize_section_color_topbar',
					'settings'   => 'gorilla_topbar_nav_color_active',
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
					'section'    => 'gorilla_customize_section_color_topbar',
					'settings'   => 'gorilla_drop_bg',
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
					'section'    => 'gorilla_customize_section_color_topbar',
					'settings'   => 'gorilla_drop_border',
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
					'section'    => 'gorilla_customize_section_color_topbar',
					'settings'   => 'gorilla_drop_text_color',
					'priority'	 => 6
				)
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'drop_text_hover_color',
				array(
					'label'      => 'Dropdown Text Hover Color',
					'section'    => 'gorilla_customize_section_color_topbar',
					'settings'   => 'gorilla_drop_text_hover_color',
					'priority'	 => 8
				)
			)
		);
		
		// Footer colors
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'footer_widget_area_bg_color',
				array(
					'label'      => 'Footer Widget Area Bg Color',
					'section'    => 'gorilla_customize_section_color_footer',
					'settings'   => 'gorilla_footer_widget_area_bg_color',
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
					'section'    => 'gorilla_customize_section_color_footer',
					'settings'   => 'gorilla_footer_widget_color',
					'priority'	 => 2
				)
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'footer_widget_text_color',
				array(
					'label'      => 'Footer Widget Text/Link Color',
					'section'    => 'gorilla_customize_section_color_footer',
					'settings'   => 'gorilla_footer_widget_text_color',
					'priority'	 => 3
				)
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'footer_widget_text_secondary_color',
				array(
					'label'      => 'Footer Widget Text Secondary Color',
					'section'    => 'gorilla_customize_section_color_footer',
					'settings'   => 'gorilla_footer_widget_text_secondary_color',
					'priority'	 => 3
				)
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'footer_widget_links_hover_color',
				array(
					'label'      => 'Footer Widget Links Hover Color',
					'section'    => 'gorilla_customize_section_color_footer',
					'settings'   => 'gorilla_footer_widget_links_hover_color',
					'priority'	 => 3
				)
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'footer_footer_tag_text_color',
				array(
					'label'      => 'Footer Tag Cloud Text Color',
					'section'    => 'gorilla_customize_section_color_footer',
					'settings'   => 'gorilla_footer_tag_text_color',
					'priority'	 => 3
				)
			)
		);


		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'footer_text_bg_color',
				array(
					'label'      => 'Footer Tag Cloud-Social Links Bg Color',
					'section'    => 'gorilla_customize_section_color_footer',
					'settings'   => 'gorilla_footer_text_bg_color',
					'priority'	 => 3
				)
			)
		);


		

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'footer_copyright_bg',
				array(
					'label'      => 'Footer Copyright Section BG',
					'section'    => 'gorilla_customize_section_color_footer',
					'settings'   => 'gorilla_footer_copyright_bg',
					'priority'	 => 4
				)
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'footer_copyright_color',
				array(
					'label'      => 'Footer Copyright Section Text Color',
					'section'    => 'gorilla_customize_section_color_footer',
					'settings'   => 'gorilla_footer_copyright_color',
					'priority'	 => 5
				)
			)
		);
		
		// Sidebar Color
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'sidebar_bg_color',
				array(
					'label'      => 'Sidebar Widget Heading Bg Color',
					'section'    => 'gorilla_customize_section_color_sidebar',
					'settings'   => 'gorilla_sidebar_bg_color',
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
					'section'    => 'gorilla_customize_section_color_sidebar',
					'settings'   => 'gorilla_sidebar_color',
					'priority'	 => 2
				)
			)
		);
		

/*------------------------------------------------------------ */

	// Removed Sections
	$wp_customize->remove_section( 'title_tagline');
	$wp_customize->remove_section( 'nav');
	$wp_customize->remove_section( 'static_front_page');
	$wp_customize->remove_section( 'colors');
	$wp_customize->remove_section( 'background_image');
}

add_action( 'customize_register', 'gorilla_register_theme_customizer' );
?>