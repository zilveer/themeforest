<?php
/**
 *	Laborator 1 Click Demo Content Importer
 *
 *	Version: 1.1
 *
 *	Developed by: Arlind Nushi
 *	URL: www.laborator.co
 */

define( 'LAB_1CL_DEMO_INSTALLER_PATH', str_replace( ABSPATH, '', dirname( __FILE__ ) . '/' ) );
define( 'LAB_1CL_DEMO_INSTALLER_STYLESHEET', THEMEURL . 'inc/lib/laborator/laborator-demo-content-importer/demo-content-importer.css' );

# Get Demo Content Packs
function lab_1cl_demo_installer_get_packs()
{
	return array(
		array(
			# Pack Info
			'name'           => 'Fashion Store',
			'desc'           => 'This will install Aurum fashion store demo content. It includes all theme features. All images are grey (takes 1-3 mins to install).',

			# Pack Data
			'thumb'          => 'demo-content/fashion-store/screenshot.png',
			'file'           => 'demo-content/fashion-store/content.xml',
			'options'        => 'demo-content/fashion-store/options.json',
			'layerslider'    => 'demo-content/fashion-store/layerslider.zip',
			'custom_css'     => '',
			'widgets'     	 => 'demo-content/fashion-store/widgets.wie',			
			
			'frontpage'		 => 328,
			'postspage'		 => 325,
			'menus'			 => array( 'main-menu' => 'Main Menu' ),
		),

		array(
			# Pack Info
			'name'           => 'Jewelry Store',
			'desc'           => 'This will install Aurum jewelry store demo content. Has only basic features.',

			# Pack Data
			'thumb'          => 'demo-content/jewelry-store/screenshot.png',
			'file'           => 'demo-content/jewelry-store/content.xml',
			'options'        => 'demo-content/jewelry-store/options.json',
			'layerslider'    => '',
			'custom_css'     => 'demo-content/jewelry-store/css.json',
			'widgets'     	 => 'demo-content/jewelry-store/widgets.wie',			
			
			'frontpage'		 => 2,
			'postspage'		 => 0,
			'menus'			 => array( 'main-menu' => 'Main Menu' ),
		),

		array(
			# Pack Info
			'name'           => 'Tech Store',
			'desc'           => 'This will install Aurum technology store demo content. Has only basic features.',

			# Pack Data
			'thumb'          => 'demo-content/tech-store/screenshot.png',
			'file'           => 'demo-content/tech-store/content.xml',
			'options'        => 'demo-content/tech-store/options.json',
			'layerslider'    => 'demo-content/tech-store/layerslider.zip',
			'custom_css'     => 'demo-content/tech-store/css.json',
			'widgets'     	 => 'demo-content/tech-store/widgets.wie',			
			
			'frontpage'		 => 2,
			'postspage'		 => 0,
			'menus'			 => array( 'main-menu' => 'Main Menu' ),
		),
		array(
			# Pack Info
			'name'           => 'Bookshop',
			'desc'           => 'This will install Aurum book store demo content. Has only basic features and contains custom CSS.',

			# Pack Data
			'thumb'          => 'demo-content/book-store/screenshot.png',
			'file'           => 'demo-content/book-store/content.xml',
			'options'        => 'demo-content/book-store/options.json',
			'layerslider'    => 'demo-content/book-store/layerslider.zip',
			'custom_css'     => 'demo-content/book-store/css.json',
			'widgets'     	 => 'demo-content/book-store/widgets.wie',			
			
			'frontpage'		 => 49,
			'postspage'		 => 53,
			'menus'			 => array( 'main-menu' => 'Main Menu' ),
		),
		array(
			# Pack Info
			'name'           => 'Multilingual Site',
			'desc'           => 'This will install multilingual demo content. The content is available in 4 languages.',

			# Pack Data
			'thumb'          => 'demo-content/multilingual-site/screenshot.png',
			'file'           => 'demo-content/multilingual-site/content.xml',
			'options'        => 'demo-content/multilingual-site/options.json',
			'layerslider'    => 'demo-content/multilingual-site/layerslider.zip',
			'custom_css'     => '',
			'widgets'     	 => 'demo-content/multilingual-store/widgets.wie',			
			
			'frontpage'		 => 328,
			'postspage'		 => 325,
			'menus'			 => array( 'main-menu' => 'Main Menu' ),
		),
	);
}


# Importer Page
add_action('admin_menu', 'lab_1cl_demo_installer_menu');

function lab_1cl_demo_installer_menu()
{
	wp_register_style('lab-1cl-demo-installer', LAB_1CL_DEMO_INSTALLER_STYLESHEET);
	wp_enqueue_style('lab-1cl-demo-installer');
	
	add_submenu_page('laborator_options', '1-Click Demo Content Installer', 'Demo Content Install', 'edit_theme_options', 'laborator_demo_content_installer', 'lab_1cl_demo_installer_page');
}

function lab_1cl_demo_installer_page()
{
	
	# Change Media Download Status
	if(isset($_POST['lab_change_media_status']))
	{
		update_option('lab_1cl_demo_installer_download_media', post('lab_1cl_demo_installer_download_media') ? true : false);
	}

	$lab_demo_content_url = site_url(str_replace(ABSPATH, '', dirname(__FILE__)) . '/');
	$lab_demo_content_url  = THEMEURL . 'inc/lib/laborator/laborator-demo-content-importer/';

	wp_enqueue_script('thickbox');
	wp_enqueue_style('thickbox');

	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

	include 'demo-content-page.php';
}


function lab_1cl_demo_installer_get_pack($name)
{
	foreach(lab_1cl_demo_installer_get_packs() as $pack)
	{
		if(sanitize_title($pack['name']) == $name)
		{
			return $pack;
		}
	}

	return null;
}


# Import Content Pack
add_action('admin_init', 'lab_1cl_demo_installer_admin_init');

function lab_1cl_demo_installer_admin_init()
{
	if(lab_get('page') == 'laborator_demo_content_installer' && ($pack_name = lab_get('install-pack')))
	{
		$pack = lab_1cl_demo_installer_get_pack($pack_name);

		if($pack)
		{
			if(is_plugin_active('wordpress-importer/wordpress-importer.php'))
			{
				deactivate_plugins(array('wordpress-importer/wordpress-importer.php'));
				update_option('lab_should_activate_wp_importer', true);

				wp_redirect(admin_url('admin.php?page=laborator_demo_content_installer&install-pack="' . sanitize_title($pack_name)));
				exit;
			}

			require 'demo-content-install-pack.php';

			die();
		}
	}
}


# Save Custom CSS Options
function lab_1cl_demo_installer_custom_css_save($custom_css_vars)
{
	foreach($custom_css_vars as $var_name => $value)
	{
		update_option($var_name, $value);
	}
}


# Get Packpage Contents to Install
function lab_1cl_demo_installer_pack_content_types($pack)
{
	$active_plugins = apply_filters('active_plugins', get_option('active_plugins'));
	
	$full_path = ABSPATH . LAB_1CL_DEMO_INSTALLER_PATH;
	$content_packs = array();
	
	# WP Content
	if(isset($pack['file']) && $pack['file'])
	{
		$xml_file_size = '';
		
		$file_content_pack = array(
			'type'           => 'xml-wp-content',
			'title'          => 'WordPress Content',
			'description'    => 'This will import posts, pages, comments, custom fields, terms, navigation menus and custom posts.',
			'checked'		 => isset($pack['file_checked']) ? $pack['file_checked'] : true,
			'requires'		 => array(),
			'size'           => size_format($xml_file_size, 2)
		);
		
		if(isset($pack['requires']) && is_array($pack['requires']) && count($pack['requires']))
		{
			# Portfolio Post Type Plugin
			if(in_array('portfolio-post-type', $pack['requires']))
			{
				if( ! in_array('portfolio-post-type/portfolio-post-type.php', $active_plugins))
				{
					$file_content_pack['checked'] = false;
					$file_content_pack['disabled'] = true;
					$file_content_pack['requires']['portfolio-post-type'] = 'This content pack includes portfolio items which requires Portfolio Post Type plugin, to install it go to <a href="'.esc_url(admin_url("themes.php?page=tgmpa-install-plugins")).'" target="_blank">Appearance &raquo; Install Plugins</a> and then refresh this page.';
				}
			}
		}
		
		$content_packs[] = $file_content_pack;
		
		# Download Media Attachments
		if( ! isset($file_content_pack['disabled']))
		{
			$content_packs[] = array(
				'type'           => 'xml-wp-download-media',
				'title'          => 'Media Files',
				'description'    => 'This will download all media files presented in this demo content pack. Note: Images are in grey format.',
				'checked'		 => $file_content_pack['checked'],
				'requires'		 => array(),
				'size'           => ''
			);
		}
	}
	
	# Widgets
	if(isset($pack['widgets']) && $pack['widgets'])
	{	
		$content_packs[] = array(
			'type'           => 'widgets',
			'title'          => 'Widgets',
			'description'    => 'This will import default widgets presented in demo site of this content package.',
			'checked'		 => isset($pack['widgets_checked']) ? $pack['widgets_checked'] : true,
			'disabled'		 => false,
			'requires'		 => array(),
			'size'           => 0
		);
	}
	
	# WooCommerce Products
	if(isset($pack['products']) && $pack['products'])
	{
		$products_content_pack = array(
			'type'           => 'xml-products',
			'title'          => 'WooCommerce Products',
			'description'    => 'This will import default WooCommerce shop products and categories.',
			'checked'		 => isset($pack['products_checked']) ? $pack['products_checked'] : false,
			'requires'		 => array(),
			'size'           => ''
		);
		
		if( ! in_array('woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option('active_plugins'))) )
		{
			$products_content_pack['disabled'] = true;
			$products_content_pack['checked'] = false;
			$products_content_pack['requires']['woocommerce'] = 'This content pack includes shop products which requires WooCommerce plugin, to install it go to <a href="'.esc_url(admin_url("themes.php?page=tgmpa-install-plugins")).'" target="_blank">Appearance &raquo; Install Plugins</a> and then refresh this page.';
		}
		
		$content_packs[] = $products_content_pack;
	}
	
	# Theme Options
	if(isset($pack['options']) && $pack['options'])
	{
		$theme_options_size = '';
		
		$content_packs[] = array(
			'type'           => 'theme-options',
			'title'          => 'Theme Options',
			'description'    => 'This will import theme options and will rewrite all current settings in Appearance &raquo; Theme Options.',
			'checked'		 => isset($pack['options_checked']) ? $pack['options_checked'] : true,
			'requires'		 => array(),
			'size'           => size_format($theme_options_size, 2)
		);
	}
	
	# Custom CSS
	if(isset($pack['custom_css']) && $pack['custom_css'])
	{
		$custom_css_size = '';
		
		$content_packs[] = array(
			'type'           => 'custom-css',
			'title'          => 'Custom CSS',
			'description'    => 'This content pack contains custom styling which can be later accessed in <a href="'.esc_url(admin_url("admin.php?page=laborator_custom_css")).'" target="_blank">Custom CSS</a>.',
			'checked'		 => isset($pack['custom_css_checked']) ? $pack['custom_css_checked'] : true,
			'requires'		 => array(),
			'size'           => size_format($custom_css_size, 2)
		);
	}
	
	# Revolution Slider
	if(isset($pack['revslider']) && $pack['revslider'])
	{
		$revslider_size = '';
		$revslider_activated = in_array('revslider/revslider.php', $active_plugins);
		
		$content_packs[] = array(
			'type'           => 'revslider',
			'title'          => 'Revolution Slider',
			'description'    => 'This will import all sliders presented in demo site of this content package.',
			'checked'		 => $revslider_activated ? (isset($pack['revslider_checked']) ? $pack['revslider_checked'] : true) : false,
			'disabled'		 => ! $revslider_activated,
			'requires'		 => array(
				'revslider' => 'To import Revolution Slider content you must install and activate this plugin in <a href="'.esc_url(admin_url("themes.php?page=tgmpa-install-plugins")).'" target="_blank">Appearance &raquo; Install Plugins</a> and then refresh this page.'
			),
			'size'           => size_format($revslider_size, 2)
		);
	}
	
	# Layer Slider
	if(isset($pack['layerslider']) && $pack['layerslider'])
	{
		$layerslider_size = '';
		$layerslider_activated = in_array('LayerSlider/layerslider.php', $active_plugins);
		
		$content_packs[] = array(
			'type'           => 'layerslider',
			'title'          => 'Layer Slider',
			'description'    => 'This will import all sliders presented in demo site of this content package.',
			'checked'		 => $layerslider_activated ? (isset($pack['layerslider_checked']) ? $pack['layerslider_checked'] : true) : false,
			'disabled'		 => ! $layerslider_activated,
			'requires'		 => array(
				'layerslider' => 'To import Layer Slider content you must install and activate this plugin in <a href="'.esc_url(admin_url("themes.php?page=tgmpa-install-plugins")).'" target="_blank">Appearance &raquo; Install Plugins</a> and then refresh this page.'
			),
			'size'           => size_format($layerslider_size, 2)
		);
	}
	
	return $content_packs;
}


# Import Content Pack
add_action('wp_ajax_lab_1cl_demo_install_package_content', 'lab_1cl_demo_install_package_content');

function lab_1cl_demo_install_package_content()
{
	$resp = array(
		'success' => false,
		'errorMsg' => ''
	);
	
	$pack_name = $_POST['pack'];
	$source_details = $_POST['contentSourceDetails'];
	
	$pack = lab_1cl_demo_installer_get_pack($pack_name);
	
	# Content Source Install by Type
	switch($source_details['type'])
	{		
		case "xml-wp-content":
		case "xml-products":
		
			# Run wordpress importer independently
			if( ! defined("WP_LOAD_IMPORTERS"))
			{
				define("WP_LOAD_IMPORTERS", true);
				require dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'wordpress-importer/wordpress-importer.php';
			}
			
			# Demo Content File (XML)
			if( $source_details['type'] == 'xml-products' ) {
				$xml_file = dirname( __FILE__ ) . DIRECTORY_SEPARATOR . $pack['products'];
			} else {
				$xml_file = dirname( __FILE__ ) . DIRECTORY_SEPARATOR . $pack['file'];
			}

			try {			
				@set_time_limit(0);
	
				$wp_importer = new WP_Import();
				
				$wp_importer->fetch_attachments = isset($source_details['downloadMedia']) && $source_details['downloadMedia'];
				$wp_importer->id = sanitize_title($pack['name']);
				
				# Download Shop Attachments by Default
				if( $source_details['type'] == 'xml-products' ) {
					$wp_importer->fetch_attachments = true;
				}
				
				ob_start();
				$wp_importer->import($xml_file);
				$content = ob_get_clean();
				
				$resp['imp'] = $wp_importer;
				$resp['success'] = true;
				
				# Small but important stuff to setup
				if( $source_details['type'] == 'xml-wp-content' ) {
					
					# Set Frontpage and Posts page
					if( isset( $pack['frontpage'] ) || isset( $pack['postspage'] ) ) {
						update_option( 'show_on_front', 'page' );
						
						if( isset( $pack['frontpage'] ) ) {
							update_option( 'page_on_front', $pack['frontpage'] );
						}
						
						if( isset( $pack['postspage'] ) ) {
							update_option( 'page_for_posts', $pack['postspage'] );
						}
					}
				
					# Menus
					if( isset( $pack['menus'] ) && is_array( $pack['menus'] ) ) {
						$nav_menus = wp_get_nav_menus();
						
						foreach( $pack['menus'] as $menu_location => $menu_name ) {
						
							if( is_array( $nav_menus ) ) {
		
								foreach( $nav_menus as $term ) {
									
									if( strtolower( $menu_name ) == strtolower( $term->name ) ) {
										$nav_menu_locations = get_theme_mod( 'nav_menu_locations' );
										
										if( ! is_array( $nav_menu_locations ) ) {
											$nav_menu_locations = array();
										}
										
										$nav_menu_locations[$menu_location] = $term->term_id;
										set_theme_mod( 'nav_menu_locations', $nav_menu_locations );
									}
								}
							}
						}
					}
					
					# Flush rewrite rules
					flush_rewrite_rules();
				}
			}
			catch(Exception $e)
			{
				$resp['errorMsg'] = $e;
			}
			
			break;
		
		case "theme-options":
			
			$theme_options = dirname(__FILE__) . DIRECTORY_SEPARATOR . $pack['options'];
			
			try
			{
				if($theme_options = file_get_contents($theme_options))
				{
					$smof_data = unserialize(base64_decode($theme_options));
					
					# Backup Nav Locations
					$nav_menu_locations = get_theme_mod( 'nav_menu_locations' );
					
					# Save Theme Options
					of_save_options( apply_filters( 'of_options_before_save', $smof_data ) );
					
					# Restore Nav Locations
					set_theme_mod( 'nav_menu_locations', $nav_menu_locations );
					
					$resp['success'] = true;
				}
				else
				{
					$resp['errorMsg'] = 'Invalid data serialization for Theme Options. Required format: Base64 Encoded';
				}
			}
			catch(Exception $e)
			{
				$resp['errorMsg'] = $e;
			}
			
			break;
		
		case "custom-css":
			
			$custom_css = $pack['custom_css'];
			
			if($custom_css)
			{
				$custom_css = dirname(__FILE__) . DIRECTORY_SEPARATOR . $custom_css;
			
				try {
					
					if($custom_css = file_get_contents($custom_css))
					{
						$custom_css_options = json_decode(base64_decode($custom_css));
						
						lab_1cl_demo_installer_custom_css_save($custom_css_options);
						
						$resp['success'] = true;
					}
				}
				catch(Exception $e)
				{
					$resp['errorMsg'] = $e;
				}
			}
			
			break;
		
		case "widgets":
			
			$widgets = dirname(__FILE__) . DIRECTORY_SEPARATOR . $pack['widgets'];
			
			if( ! class_exists( 'Widget_Importer_Exporter' ) ) {
				require dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'widget-importer-exporter/widget-importer-exporter.php';
			}
			
			try
			{
				wie_process_import_file( $widgets );
				$resp['success'] = true;
			}
			catch(Exception $e)
			{
				$resp['errorMsg'] = $e;
			}
			
			break;
		
		case "revslider":
		
			try
			{
				# Import Revolution Slider
				if($pack['revslider'] && class_exists('RevSlider'))
				{
					$revslider = dirname(__FILE__) . DIRECTORY_SEPARATOR . $pack['revslider'];
					
					$rev = new RevSlider();
					
					ob_start();
					$rev->importSliderFromPost(true, true, $revslider);
					$content = ob_get_clean();
					
					$resp['success'] = true;
				}
				else
				{
					$resp['errorMsg'] = 'Revolution Slider is not installed/activated and thus this content source couldn\'t be imported!';
				}
			}
			catch(Exception $e)
			{
				$resp['errorMsg'] = $e;
			}
			
			break;
		
		case "layerslider":
		
			try
			{
				# Import Layer Slider
				if($pack['layerslider'] && function_exists('ls_import_sliders'))
				{
					$layerslider = dirname(__FILE__) . DIRECTORY_SEPARATOR . $pack['layerslider'];
				
					include LS_ROOT_PATH . '/classes/class.ls.importutil.php';
				
					$import = new LS_ImportUtil($layerslider, basename($layerslider));
					
					$resp['success'] = true;
				}
				else
				{
					$resp['errorMsg'] = 'Layer Slider is not installed/activated and thus this content source couldn\'t be imported!';
				}
			}
			catch(Exception $e)
			{
				$resp['errorMsg'] = $e;
			}
			
			break;
	}
	
	
	echo json_encode($resp);
	die();
}