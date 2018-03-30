<?php
if ( !class_exists( 'ReduxFramework' ) ) {
	return;
}

if ( !class_exists( "Media_Center_Theme_Options" ) ) {

	class Media_Center_Theme_Options {
		
		public function __construct( ) {
			// Base Config for Media Center
			add_action( 'after_setup_theme', array($this, 'load_config') );
		}

		public function load_config() {

			$entranceAnimations = array(
				'none'				=> __( 'No Animation', 'mediacenter' ),
		        'bounceIn'			=> __( 'BounceIn', 'mediacenter' ),
		        'bounceInDown'		=> __( 'BounceInDown', 'mediacenter' ),
		        'bounceInLeft'		=> __( 'BounceInLeft', 'mediacenter' ),
		        'bounceInRight'		=> __( 'BounceInRight', 'mediacenter' ),
		        'bounceInUp'		=> __( 'BounceInUp', 'mediacenter' ),
				'fadeIn'			=> __( 'FadeIn', 'mediacenter' ),
				'fadeInDown'		=> __( 'FadeInDown', 'mediacenter' ),
				'fadeInDownBig'		=> __( 'FadeInDown Big', 'mediacenter' ),
				'fadeInLeft'		=> __( 'FadeInLeft', 'mediacenter' ),
				'fadeInLeftBig'		=> __( 'FadeInLeft Big', 'mediacenter' ),
				'fadeInRight'		=> __( 'FadeInRight', 'mediacenter' ),
				'fadeInRightBig'	=> __( 'FadeInRight Big', 'mediacenter' ),
				'fadeInUp'			=> __( 'FadeInUp', 'mediacenter' ),
				'fadeInUpBig'		=> __( 'FadeInUp Big', 'mediacenter' ),
				'flipInX'			=> __( 'FlipInX', 'mediacenter' ),
				'flipInY'			=> __( 'FlipInY', 'mediacenter' ),
				'lightSpeedIn'		=> __( 'LightSpeedIn', 'mediacenter' ),
				'rotateIn' 			=> __( 'RotateIn', 'mediacenter' ),
				'rotateInDownLeft' 	=> __( 'RotateInDown Left', 'mediacenter' ),
				'rotateInDownRight' => __( 'RotateInDown Right', 'mediacenter' ),
				'rotateInUpLeft' 	=> __( 'RotateInUp Left', 'mediacenter' ),
				'rotateInUpRight' 	=> __( 'RotateInUp Right', 'mediacenter' ),
				'roleIn'			=> __( 'RoleIn', 'mediacenter' ),
		        'zoomIn'			=> __( 'ZoomIn', 'mediacenter' ),
				'zoomInDown'		=> __( 'ZoomInDown', 'mediacenter' ),
				'zoomInLeft'		=> __( 'ZoomInLeft', 'mediacenter' ),
				'zoomInRight'		=> __( 'ZoomInRight', 'mediacenter' ),
				'zoomInUp'			=> __( 'ZoomInUp', 'mediacenter' ),
			);

			$social_media_fields = redux_get_social_media_fields();

			$sections = array(

				array(
					'title' => __('General', 'mediacenter'),
					'icon' 	=> 'fa fa-dot-circle-o',
					'fields' => array(
						array(
							'title' => __('Favicon', 'mediacenter'),
							'subtitle' => __('<em>Upload your custom Favicon image. <br>.ico or .png file required.</em>', 'mediacenter'),
							'id' => 'favicon',
							'type' => 'media',
							'default' => array(
								'url' => get_template_directory_uri() . '/favicon.ico',
							),
						),
						
						array(
							'title' => __('Your Logo', 'mediacenter'),
							'subtitle' => __('<em>Upload your logo image. Recommended dimension : 233x54 pixels</em>', 'mediacenter'),
							'id' => 'site_logo',
							'type' => 'media',
						),
						
						array(
							'title' => __('Use text instead of logo ?', 'mediacenter'),
							'id' => 'use_text_logo',
							'type' => 'checkbox',
							'default' => '0',
						),
						
						array(
							'title' => __('Logo Text', 'mediacenter'),
							'subtitle' => __('<em>Will be displayed only if use text logo is checked.</em>', 'mediacenter'),
							'id' => 'logo_text',
							'type' => 'text',
							'default' => 'Media Center',
							'required' => array(
								0 => 'use_text_logo',
								1 => '=',
								2 => 1,
							),
						),

						array(
							'title' => __('Scroll to Top', 'mediacenter'),
							'id' => 'scroll_to_top',
							'on' => __('Enabled', 'mediacenter'),
							'off' => __('Disabled', 'mediacenter'),
							'type' => 'switch',
							'default' => 1,
						),

						array(
                            'title' => __('Hide Product Title in Breadcrumb ?', 'mediacenter'),
                            'subtitle'    => __( 'Click Yes if you have longer product titles and the breadcrumb is overflowing.', 'mediacenter' ),
                            'id' => 'breadcrumb_ignore_title',
                            'on' => __('Yes', 'mediacenter'),
                            'off' => __('No', 'mediacenter'),
                            'type' => 'switch',
                            'default' => 1,
                        ),
					),
				),

				array(
					'title' => __('Header', 'mediacenter'),
					'icon' 	=> 'fa fa-arrow-circle-o-up',
					'fields' => array(
						array(
							'id'		=> 'header_style',
							'type' 		=> 'radio',
							'title'		=> __( 'Header Style', 'mediacenter' ),
							'options' => array(
								'header-style-1' => __( 'Header 1', 'mediacenter' ),
								'header-style-2' => __( 'Header 2', 'mediacenter' )
							),
							'default' => 'header-style-1',
						),
						array(
							'id' => 'top_bar_info',
							'icon' => true,
							'type' => 'info',
							'raw' => __('<h3 style="margin: 0;">Top Bar</h3>', 'mediacenter'),
						),
						array(
							'title' => __('Top Bar', 'mediacenter'),
							'subtitle' => __('<em>Enable / Disable the Top Bar.</em>', 'mediacenter'),
							'id' => 'top_bar_switch',
							'on' => __('Enabled', 'mediacenter'),
							'off' => __('Disabled', 'mediacenter'),
							'type' => 'switch',
							'default' => 1,
						),
						array(
							'title' => __('Top Bar Left', 'mediacenter'),
							'subtitle' => __('<em>Enable / Disable the Top Bar Left Navigation.</em>', 'mediacenter'),
							'id' => 'top_bar_left_switch',
							'on' => __('Enabled', 'mediacenter'),
							'off' => __('Disabled', 'mediacenter'),
							'type' => 'switch',
							'default' => 1,
						),
						array(
							'title' => __('Top Bar Right', 'mediacenter'),
							'subtitle' => __('<em>Enable / Disable the Top Bar Right Navigation.</em>', 'mediacenter'),
							'id' => 'top_bar_right_switch',
							'on' => __('Enabled', 'mediacenter'),
							'off' => __('Disabled', 'mediacenter'),
							'type' => 'switch',
							'default' => 1,
						),
						array(
							'title'			=> __( 'Hide Top Bar in mobile', 'mediacenter' ),
							'id'			=> 'hide_top_bar_on_mobile',
							'on'			=> __( 'Yes', 'mediacenter' ),
							'off'			=> __( 'No', 'mediacenter' ),
							'type'			=> 'switch',
							'default'		=> 0
						),

						array(
							'id' => 'main_header_info',
							'icon' => true,
							'type' => 'info',
							'raw' => '<h3 style="margin: 0;">Main Header</h3>',
						),

						array(
							'title' => __('Sticky Header', 'mediacenter'),
							'subtitle' => __('<em>Enable / Disable the Sticky Header. Available only for Header Style 2</em>', 'mediacenter'),
							'id' => 'sticky_header',
							'on' => __('Enabled', 'mediacenter'),
							'off' => __('Disabled', 'mediacenter'),
							'type' => 'switch',
							'default' => 0,
						),

						array(
							'title' => __('Support Phone Number', 'mediacenter'),
							'id' => 'header_support_phone',
							'type' => 'text',
							'default' => '(+800) 123 456 7890',
						),

						array(
							'title' => __( 'Support Email Address', 'mediacenter' ),
							'id' => 'header_support_email',
							'type' => 'text',
							'default' => 'contact@support.com',
						),

						array(
							'id' 	=> 'search_bar_info',
							'icon' 	=> true,
							'type' 	=> 'info',
							'raw' 	=> __('<h3 style="margin: 0;">Search Bar</h3>', 'mediacenter'),
						),

						array(
							'title' 	=> __( 'Live Search', 'mediacenter' ),
							'id'		=> 'live_search',
							'type'		=> 'switch',
							'default'	=> 1,
							'on'		=> __( 'Enabled', 'mediacenter' ),
							'off'		=> __( 'Disabled', 'mediacenter' )
						),

						array(
							'title' 	=> __( 'Search Result Template', 'mediacenter' ),
							'id'		=> 'live_search_template',
							'type' 		=> 'ace_editor',
							'mode' 		=> 'html',
							'required' 	=> array( 'live_search', 'equals', 1 ),
							'default'	=> '<a href="{{url}}" class="media live-search-media"><img src="{{image}}" class="pull-left flip" height="60" width="60"><div class="media-body"><p>{{{value}}}</p></div></a>',
							'desc'		=> __( 'Available parameters : {{value}}, {{url}}, {{image}}, {{brand}} and {{{price}}}', 'mediacenter')
						),

						array(
							'title' 	=> __( 'Show Categories Filter', 'mediacenter' ),
							'id'		=> 'display_search_categories_filter',
							'type'		=> 'switch',
							'default'	=> 1,
							'on'		=> __( 'Yes', 'mediacenter' ),
							'off'		=> __( 'No', 'mediacenter' )
						),

						array(
							'title' 	=> __( 'Search Category Dropdown', 'mediacenter' ),
							'id' 		=> 'header_search_dropdown',
							'type' 		=> 'radio',
							'options' 	=> array(
								'hsd0' 	=> __( 'Include only top level categories', 'mediacenter' ),
								'hsd1' 	=> __( 'Include all categories', 'mediacenter' )
							),
							'default' 	=> 'hsd0',
							'required' 	=> array( 'display_search_categories_filter', 'equals', 1 )
						),
					),
				),

				array(
					'title'				=> __( 'Navigation', 'mediacenter' ),
					'icon'				=> 'fa fa-navicon',
					'fields'			=> array(
						array(
							'id' 		=> 'top_bar_left_info',
							'icon' 		=> true,
							'type' 		=> 'info',
							'raw' 		=> '<h3 style="margin: 0;">Top Bar Left Menu</h3>',
						),
						array(
							'title'		=> __( 'Dropdown Trigger', 'mediacenter' ),
							'id'		=> 'top_bar_left_menu_dropdown_trigger',
							'type'		=> 'select',
							'options'	=> array(
								'click'	=> __( 'Click', 'mediacenter' ),
								'hover'	=> __( 'Hover', 'mediacenter' ),
							),
							'default'	=> 'click',
						),
						array(
							'title'		=> __( 'Dropdown Animation', 'mediacenter' ),
							'id'		=> 'top_bar_left_menu_dropdown_animation',
							'type'		=> 'select',
							'options'	=> $entranceAnimations,
							'default'	=> 'fadeInUp',
						),

						array(
							'id' 		=> 'top_bar_right_info',
							'icon' 		=> true,
							'type' 		=> 'info',
							'raw' 		=> '<h3 style="margin: 0;">Top Bar Right Menu</h3>',
						),
						array(
							'title'		=> __( 'Dropdown Trigger', 'mediacenter' ),
							'id'		=> 'top_bar_right_menu_dropdown_trigger',
							'type'		=> 'select',
							'options'	=> array(
								'click'	=> __( 'Click', 'mediacenter' ),
								'hover'	=> __( 'Hover', 'mediacenter' ),
							),
							'default'	=> 'click',
						),
						array(
							'title'		=> __( 'Dropdown Animation', 'mediacenter' ),
							'id'		=> 'top_bar_right_menu_dropdown_animation',
							'type'		=> 'select',
							'options'	=> $entranceAnimations,
							'default'	=> 'fadeInUp',
						),

						array(
							'id' 		=> 'main_navigation_info',
							'icon' 		=> true,
							'type' 		=> 'info',
							'raw' 		=> '<h3 style="margin: 0;">Main Navigation Menu</h3>',
						),
						array(
							'title'		=> __( 'Dropdown Trigger', 'mediacenter' ),
							'id'		=> 'main_navigation_menu_dropdown_trigger',
							'type'		=> 'select',
							'options'	=> array(
								'click'	=> __( 'Click', 'mediacenter' ),
								'hover'	=> __( 'Hover', 'mediacenter' ),
							),
							'default'	=> 'click',
						),
						array(
							'title'		=> __( 'Dropdown Animation', 'mediacenter' ),
							'id'		=> 'main_navigation_menu_dropdown_animation',
							'type'		=> 'select',
							'options'	=> $entranceAnimations,
							'default'	=> 'fadeInUp',
						),

						array(
							'id' 		=> 'shop_by_departments_info',
							'icon' 		=> true,
							'type' 		=> 'info',
							'raw' 		=> '<h3 style="margin: 0;">Shop By Departments Menu</h3>',
						),

						array(
							'title'		=> __( 'Dropdown Trigger', 'mediacenter' ),
							'id'		=> 'shop_by_departments_menu_dropdown_trigger',
							'type'		=> 'select',
							'options'	=> array(
								'click'	=> __( 'Click', 'mediacenter' ),
								'hover'	=> __( 'Hover', 'mediacenter' ),
							),
							'default'	=> 'click',
						),
						array(
							'title'		=> __( 'Dropdown Animation', 'mediacenter' ),
							'id'		=> 'shop_by_departments_menu_dropdown_animation',
							'type'		=> 'select',
							'options'	=> $entranceAnimations,
							'default'	=> 'fadeInUp',
						),

						array(
							'id' 		=> 'wpml_info',
							'icon' 		=> true,
							'type' 		=> 'info',
							'raw' 		=> '<h3 style="margin: 0;">Language and Currency Switcher</h3>',
						),

						array(
							'title'		=> __( 'Language Switcher', 'mediacenter' ),
							'id'		=> 'enable_language_switcher',
							'type'		=> 'switch',
							'on'		=> __( 'Enabled', 'mediacenter' ),
							'off'		=> __( 'Disabled', 'mediacenter' ),
							'subtitle'	=> __( '<em>Available only if WPML Plugin is enabled</em>', 'mediacenter' ),
							'default'	=> 1,
						),

						array(
							'title'		=> __( 'Language Switcher Position', 'mediacenter' ),
							'id'		=> 'language_switcher_position',
							'type'		=> 'select',
							'options'	=>  array(
								'top_bar_left'	=> __( 'Top Bar Left Menu', 'mediacenter' ),
								'top_bar_right'	=> __( 'Top Bar Right Menu', 'mediacenter' ),
							),
							'default'	=> 'top_bar_right',
						),
						array(
							'title'		=> __( 'Currency Switcher', 'mediacenter' ),
							'id'		=> 'enable_currency_switcher',
							'type'		=> 'switch',
							'on'		=> __( 'Enabled', 'mediacenter' ),
							'off'		=> __( 'Disabled', 'mediacenter' ),
							'subtitle'	=> __( '<em>Available only if WPML Plugin and WooCommerce Multilingual is enabled</em>', 'mediacenter' ),
							'default'	=> 1,
						),
						array(
							'title'		=> __( 'Currency Switcher Position', 'mediacenter' ),
							'id'		=> 'currency_switcher_position',
							'type'		=> 'select',
							'options'	=>  array(
								'top_bar_left'	=> __( 'Top Bar Left Menu', 'mediacenter' ),
								'top_bar_right'	=> __( 'Top Bar Right Menu', 'mediacenter' ),
							),
							'default'	=> 'top_bar_right',
						),
					)
				),

				array(
					'title' => __('Footer', 'mediacenter'),
					'icon' 	=> 'fa fa-arrow-circle-o-down',
					'fields' => array(
						array(
							'title' => __('Footer Contact Info Text', 'mediacenter'),
							'id' => 'footer_contact_info_text',
							'type' => 'textarea',
							'default' => __('Feel free to contact us via phone,email or just send us mail.', 'mediacenter'),
						),

						array(
							'title' => __('Footer Contact Info Address', 'mediacenter'),
							'id' => 'footer_contact_info_address',
							'type' => 'textarea',
							'default' => '17 Princess Road, London, Greater London NW1 8JR, UK 1-888-8MEDIA (1-888-892-9953)',
						),

						array(
							'title' => __('Footer Payment Images', 'mediacenter'),
							'subtitle' => __('<em>Upload your payment images. Preferred dimension for each image 40x29 px.</em>', 'mediacenter'),
							'id' => 'credit_card_icons_gallery',
							'type' => 'gallery',
						),

						array(
							'title' => __('Footer Copyright Text', 'mediacenter'),
							'subtitle' => __('<em>Enter your copyright information here.</em>', 'mediacenter'),
							'id' => 'footer_copyright_text',
							'type' => 'textarea',
							'default' => '&copy; <a href="#">Media Center</a> - All Rights Reserved',
						),
					),
				),

				array(

					'title' 	=> __('Shop', 'mediacenter'),
					'icon' 		=> 'fa fa-shopping-cart',
					'fields' 	=> array(
						
						array(
							'id' 	=> 'shop_general_info',
							'icon' 	=> true,
							'type' 	=> 'info',
							'raw' 	=> '<h3 style="margin: 0;">General</h3>',
						),

						array(
							'title' 	=> __('Catalog Mode', 'mediacenter'),
							'subtitle' 	=> __('<em>Enable / Disable the Catalog Mode.</em>', 'mediacenter'),
							'desc'		=> __('<em>When enabled, the feature Turns Off the shopping functionality of WooCommerce.</em>', 'mediacenter'),
							'id' 		=> 'catalog_mode',
							'on' 		=> __('Enabled', 'mediacenter'),
							'off' 		=> __('Disabled', 'mediacenter'),
							'type' 		=> 'switch',
							'default'	=> 0
						),

						array(
							'title' 	=> __('Default View', 'mediacenter'),
							'subtitle' 	=> __('<em>Choose a default view between grid and list views.</em>', 'mediacenter'),
							'id' 		=> 'shop_default_view',
							'type'		=> 'select',
							'options'	=> array(
								'grid-view'	=> __( 'Grid View', 'mediacenter' ),
								'list-view' => __( 'List View', 'mediacenter' ),
							),
							'default'	=> 'grid-view',
						),

						array(
							'title' 	=> __('Remember User View ?', 'mediacenter' ),
							'desc'		=> __( 'When user switches a view, should we maintain the view in all pages ?', 'mediacenter' ),
							'id' 		=> 'remember_user_view',
							'type'		=> 'switch',
							'on'		=> __( 'Yes', 'mediacenter' ),
							'off'		=> __( 'No', 'mediacenter' ),
							'default'	=> 0
						),

						array(
							'title'			=> __( 'Product Columns', 'mediacenter' ),
							'desc'			=> __( 'No. of products should appear per row in grid view', 'mediacenter' ),
							'id'			=> 'product_loop_columns',
							'type'			=> 'slider',
							'min'			=> '1',
							'max'			=> '6',
							'step'			=> '1',
							'display_value'	=> 'label',
							'default'		=> '3'
						),

						array(
							'title' 		=> __('Number of Products per Page', 'mediacenter'),
							'subtitle' 		=> __('<em>Drag the slider to set the number of products per page <br />to be listed on the shop page and catalog pages.</em>', 'mediacenter'),
							'id' 			=> 'products_per_page',
							'min' 			=> '3',
							'step' 			=> '1',
							'max' 			=> '48',
							'type' 			=> 'slider',
							'default' 		=> '15',
							'display_value' => 'label'
						),

						array(
							'id' 	=> 'shop_product_item',
							'icon' 	=> true,
							'type' 	=> 'info',
							'raw' 	=> '<h3 style="margin: 0;">Product Item Settings</h3>',
						),

						array(
							'title' 	=> __('Product Item Animation', 'mediacenter'),
							'subtitle' 	=> __('<em>A list of all the product animations.</em>', 'mediacenter'),
							'id' 		=> 'products_animation',
							'type' 		=> 'select',
							'options' 	=> $entranceAnimations,
							'default' 	=> 'fadeIn',
						),

						array(
							'title' 	=> __('Echo Lazy loading', 'mediacenter'),
							'subtitle' 	=> __( '<em>Lazy load product images. Product images will not be loaded until scrolled into view.</em>', 'mediacenter' ),
							'id' 		=> 'lazy_loading',
							'on' 		=> __('Enabled', 'mediacenter'),
							'off' 		=> __('Disabled', 'mediacenter'),
							'type' 		=> 'switch',
							'default' 	=> 1,
						),

						array(
							'title'		=> __( 'Show rating in Grid View ?', 'mediacenter' ),
							'type'		=> 'switch',
							'on'		=> __( 'Yes', 'mediacenter' ),
							'off'		=> __( 'No', 'mediacenter' ),
							'id'		=> 'show_rating_in_grid',
							'default'	=> 0,
						),

						array(
							'id' => 'shop_page_settings',
							'icon' => true,
							'type' => 'info',
							'raw' => '<h3 style="margin: 0;">Shop Page Settings</h3>',
						),

						array(
							'id'      => 'shop_page_layout',
							'title'   => __( 'Shop Page Layout', 'mediacenter' ),
							'type'	  => 'select',
							'options' => array(
								'full-width' 	=> __( 'Full-width', 'mediacenter' ),
								'sidebar-left'  => __( 'Left Sidebar', 'mediacenter' ),
								'sidebar-right' => __( 'Right Sidebar', 'mediacenter' ),
							),
							'default' => 'sidebar-left'
						),

						array(
							'id'      => 'single_product_layout',
							'title'   => __( 'Single Product Page Layout', 'mediacenter' ),
							'type'	  => 'select',
							'options' => array(
								'full-width' 	=> __( 'Full-width', 'mediacenter' ),
								'sidebar-left'  => __( 'Left Sidebar', 'mediacenter' ),
								'sidebar-right' => __( 'Right Sidebar', 'mediacenter' ),
							),
							'default' => 'full-width'
						),

						array(
							'title'		=> __( 'Product Comparision Page', 'mediacenter' ),
							'subtitle'	=> __( 'This sets the product comparison page for your shop', 'mediacenter' ),
							'type'		=> 'select',
							'data'		=> 'pages',
							'id'		=> 'product_comparison_page'
						),
					),
				),

				array(
					'title' => __('Blog', 'mediacenter'),
					'icon' 	=> 'fa fa-list-alt',
					'fields' => array(
						array(
							'title' 	=> __('Blog Layout', 'mediacenter'),
							'subtitle' 	=> __('<em>Select the layout for the Blog Listing. <br />The second option will enable the Blog Listing Sidebar.</em>', 'mediacenter'),
							'id' 		=> 'blog_layout',
							'type' 		=> 'image_select',
							'options' 	=> array(
								'sidebar_right' 	=> get_template_directory_uri() . '/assets/images/theme_options/icons/blog_right_sidebar.png',
								'without_sidebar' 	=> get_template_directory_uri() . '/assets/images/theme_options/icons/blog_no_sidebar.png',
								'sidebar_left' 		=> get_template_directory_uri() . '/assets/images/theme_options/icons/blog_left_sidebar.png',
							),
							'default' 	=> 'sidebar_right',
						),
						array(
							'title' 	=> __('Blog Style', 'mediacenter'),
							'subtitle' 	=> __('<em>Select the layout style for the Blog Listing.</em>', 'mediacenter'),
							'id' 		=> 'blog_style',
							'type' 		=> 'select',
							'options' 	=> array(
								'normal' 		=> __( 'Normal', 'mediacenter' ),
								'list-view' 	=> __( 'List View', 'mediacenter' ),
								'grid-view'		=> __( 'Grid View', 'mediacenter' )
							),
							'default' 	=> 'normal',
						),
						array(
							'title' 	=> __( 'Full width Density', 'mediacenter' ),
							'subtitle'  => __( 'Applicable only if you choose <em>without sidebar</em> option for blog layout', 'mediacenter' ),
							'id' 		=> 'full_width_density',
							'type' 		=> 'radio',
							'options'	=> array(
								'wide' 			=> __( 'Wide', 'mediacenter' ),
								'narrow' => __( 'Narrow', 'mediacenter' )
							),
							'default' 	=> 'narrow',
						),
						array(
							'title'		=> __( 'Force Excerpt', 'mediacenter' ),
							'subtitle'  => __( 'Show only excerpt instead of blog content in archive pages', 'mediacenter' ),
							'id'		=> 'force_excerpt',
							'on' 		=> __('Yes', 'mediacenter'),
							'off' 		=> __('No', 'mediacenter'),
							'type' 		=> 'switch',
							'default' 	=> 0,		
						),
						array(
							'title'		=> __( 'Excerpt Length', 'mediacenter' ),
							'id'		=> 'excerpt_length',
							'type'		=> 'text',
							'default'	=> 75,
							'required'	=> array( 'force_excerpt', 'equals', 1 )		
						),
					),
				),

				array(
					'title' => __('Styling', 'mediacenter'),
					'icon' 	=> 'fa fa-pencil-square-o',
					'fields' => array(
						array(
							'title' 	=> __( 'Use a predefined color scheme', 'mediacenter' ),
							'on' 		=> __('Yes', 'mediacenter'),
							'off' 		=> __('No', 'mediacenter'),
							'type' 		=> 'switch',
							'default' 	=> 1,
							'id' 		=> 'use_predefined_color'
						),
						array(
							'title' 	=> __('Main Theme Color', 'mediacenter'),
							'subtitle' 	=> __('<em>The main color of the site.</em>', 'mediacenter'),
							'id' 		=> 'main_color',
							'type' 		=> 'select',
							'options' 	=> array(
								'green' 	 => __( 'Green', 'mediacenter' ) ,
								'blue' 		 => __( 'Blue', 'mediacenter' ) ,
								'red' 		 => __( 'Red', 'mediacenter' ) ,
								'orange' 	 => __( 'Orange', 'mediacenter' ) ,
								'navy' 		 => __( 'Navy', 'mediacenter' ) ,
								'dark-green' => __( 'Dark-green', 'mediacenter' ) ,
							),
							'default' 	=> 'green',
							'required' 	=> array( 'use_predefined_color', 'equals', 1 ),
						),
						array(
							'id' 		=> 'main_custom_color',
							'icon' 		=> true,
							'type' 		=> 'info',
							'raw'   	=> '<h3>'. __( 'Using a Custom theme Color', 'mediacenter' ). '</h3>' .
										   '<p>' . __( 'Using a custom color is simple but it requires a few extra steps.', 'mediacenter' ) . '</p>' .
										   '<ol>' .
										   '<li>'. __( 'Navigate to <em>assets/sass/custom-color.less</em> file.', 'mediacenter' ) . '</li>'.
										   '<li>'. __( 'On line 7, set <mark>$primary-color</mark> to the color of your choice.', 'mediacenter' ) . '</li>'.
										   '<li>'. __( 'Compile <em>assets/sass/custom-color.sass</em> file to <em>mediacenter-child/assets/css/custom-color.css</em>', 'mediacenter' ) . '</li>'.
										   '<li>'. __( 'You can also use <a href="http://sassmeister.com/" target="_blank">sassmeister.com/</a> to compile the SASS file and copy the output to <em>mediacenter-child/assets/css/custom-color.css</em>', 'mediacenter' ) . '</li>'.
										   '<li>'. __( 'If you are using an online compiler make sure you paste contents from assets/sass/_variables.scss as well', 'mediacenter' ) . '</li>'.
										   '<li>'. __( 'Once you have compiled and got custom-color.css, you will have to enqueue it by pasting the code given here : <a href="https://gist.github.com/ibndawood/a54e30fa73da53fe00e1" target="_blank">https://gist.github.com/ibndawood/a54e30fa73da53fe00e1</a> in your child theme\'s functions.php.', 'mediacenter' ) . '</li>'.
										   '</ol>',
							'required' 	=> array( 'use_predefined_color', 'equals', 0 )
						),
					),
				),

				array(
					'title' => __('Typography', 'mediacenter'),
					'icon' => 'fa fa-font',
					'fields' => array(
						array(
							'title' 	=> __( 'Use default font settings ?', 'mediacenter' ),
							'subtitle'	=> __( '<em>Toggle No if you want to override with your own fonts</em>', 'mediacenter' ),
							'id'		=> 'use_default_font',
							'type'		=> 'switch',
							'on'		=> __( 'Yes', 'mediacenter' ),
							'off'		=> __( 'No', 'mediacenter' ),
							'default'   => 1
						),
						array(
							'title' 		=> __('Default Font Family', 'mediacenter'),
							'subtitle' 		=> __('<em>Pick the default font family for your site.</em>', 'mediacenter'),
							'id' 			=> 'default_font',
							'type' 			=> 'typography',
							'line-height' 	=> false,
							'text-align' 	=> false,
							'font-style' 	=> false,
							'font-weight' 	=> false,
							'font-size' 	=> false,
							'color' 		=> false,
							'required'		=> array( 'use_default_font', 'equals', 0 ),
							'default' 		=> array(
								'font-family' 	=> 'Open Sans',
								'subsets' 		=> '',
							),
						),

						array(
							'title' 		=> __('Title Font Family', 'mediacenter'),
							'subtitle' 		=> __('<em>Pick the font family for titles for your site.</em>', 'mediacenter'),
							'id' 			=> 'title_font',
							'type' 			=> 'typography',
							'line-height' 	=> false,
							'text-align' 	=> false,
							'font-style' 	=> false,
							'font-weight' 	=> false,
							'font-size' 	=> false,
							'color' 		=> false,
							'default' 		=> array(
								'font-family' 	=> 'Open Sans',
								'subsets' 		=> '',
							),
							'required'		=> array( 'use_default_font', 'equals', 0 ),
						),
					),
				),

				array(
					'title' 	=> __('Social Media', 'mediacenter'),
					'icon' 		=> 'fa fa-share-square-o',
					'desc'		=> __( 'Please make sure to enter the complete URL of your social media profile.', 'mediacenter' ),
					'fields' 	=> $social_media_fields
				),

				array(
					'title' => __('Custom Code', 'mediacenter'),
					'icon' => 'fa fa-code',
					'fields' => array(

						array(
							'title' => __('Custom CSS', 'mediacenter'),
							'subtitle' => __('<em>Paste your custom CSS code here.</em>', 'mediacenter'),
							'id' => 'custom_css',
							'type' => 'ace_editor',
							'mode' => 'css',
						),

						array(
							'title' => __('Header JavaScript Code', 'mediacenter'),
							'subtitle' => __('<em>Paste your custom JS code here. The code will be added to the header of your site.</em>', 'mediacenter'),
							'id' => 'header_js',
							'type' => 'ace_editor',
							'mode' => 'javascript',
						),

						array(
							'title' => __('Footer JavaScript Code', 'mediacenter'),
							'subtitle' => __('<em>Here is the place to paste your Google Analytics code or any other JS code you might want to add to be loaded in the footer of your website.</em>', 'mediacenter'),
							'id' => 'footer_js',
							'type' => 'ace_editor',
							'mode' => 'javascript',
						),
					),
				),
			);

			// Change your opt_name to match where you want the data saved.
			$args = array(
				'opt_name' => 'media_center_theme_options',
				'menu_title' => __( 'MC Options', 'mediacenter' ),
				'page_priority' => 3,
				'allow_sub_menu' => false,
				'dev_mode'	=> false,
				'intro_text' => '',
				'footer_credit' => '&nbsp;',
				'page_slug' => 'theme_options',
				'google_api_key' => 'AIzaSyDDZJO4F0d17RnFoi1F2qtw4wn6Wcaqxao',
			);

			// Use this section if this is for a theme. Replace with plugin specific data if it is for a plugin.
			$theme = wp_get_theme();
			$args['display_name'] = $theme->get('Name');
			$args['display_version'] = $theme->get('Version');

			$ReduxFramework = new ReduxFramework($sections, $args);
		}	
	}
	new Media_Center_Theme_Options();
}