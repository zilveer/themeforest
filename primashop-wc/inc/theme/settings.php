<?php
/**
 * Setup theme specific settings
 *
 * WARNING: This file is part of the PrimaShop parent theme.
 * Please do all modifications in the form of a child theme.
 *
 * @category   PrimaShop
 * @package    Setup
 * @subpackage Setting
 * @author     PrimaThemes
 * @link       http://www.primathemes.com
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Add Layout tab for Theme Settings page.
 *
 * @since PrimaShop 1.0
 */
add_filter( 'prima_theme_settings_args', 'prima_theme_settings_args_layout_tab' );
function prima_theme_settings_args_layout_tab( $settings ) {
	$settings["tab_layout"] = array( 
		"name" => __('Layout', 'primathemes'),
		"id" => "layout",
		"type" => "tab",
		);
	return $settings;
}

/**
 * Add Default Setting section of Layout tab for Theme Settings page.
 *
 * @since PrimaShop 1.0
 */
add_filter( 'prima_theme_settings_args', 'prima_theme_settings_args_layout_default' );
function prima_theme_settings_args_layout_default( $settings ) {
	global $prima_default_layout, $prima_registered_sidebar_areas;
	$layouts = prima_list_layout();
	$sidebars_opt = prima_list_sidebar();

	$settings["section_layout_default"] = array( 
		"tab" => "layout",
		"type" => "section",
		"name" => __('Default Setting', 'primathemes'),
		"id" => "layout_default",
		);
	$settings["style"] = array( 
		"section" => "layout_default",
		"name" => __('Style Layout', 'primathemes'),
		"id" => "style",
		"desc" => __('"Custom" style layout is useful when you plan to highly customize theme style.', 'primathemes'),
		"default" => "full",
		"type" => "select",
		"options" => array(
			'full' => __('Full', 'primathemes'),
			'boxed' => __('Boxed', 'primathemes'),
			'custom' => __('Custom', 'primathemes'),
			),
		);
	$settings["responsive"] = array( 
		"section" => "layout_default",
		"name" => __('Responsive Layout', 'primathemes'),
		"id" => "responsive",
		"desc" => __('Users now use mobile phones, small notebooks, tablet devices such as iPad or Playbook to access the web. The layout needs is automatically adjusted to fit all display resolution and devices.', 'primathemes'),
		"default" => "yes",
		"type" => "select",
		"options" => array(
			'yes' => __('Yes', 'primathemes'),
			'no' => __('No', 'primathemes')
			),
		);
	if ( 0 != count( $layouts ) ) {
		$settings["layout_default"] = array( 
			"section" => "layout_default",
			"name" => __('Default Layout', 'primathemes'),
			"id" => "layout_default",
			"desc" => "",
			"default" => $prima_default_layout['id'],
			"type" => "images",
			"options" => $layouts,
		);
	}
	$settings["content_layout"] = array( 
		"section" => "layout_default",
		"name" => __('Default Content Layout', 'primathemes'),
		"id" => "content_layout",
		"desc" => __('It will be used for archives page (default homepage, post category, post tag, archive, and search result page).', 'primathemes'),
		"default" => 'featured',
		"type" => "select",
		"options" => array ( 
			'' => __('Full Text', 'primathemes'),
			'excerpt' => __('Summary', 'primathemes'),
			'featuredfull' => __('Featured Image + Full Text', 'primathemes'),
			'featured' => __('Featured Image + Summary', 'primathemes'),
			'thumbnailleft' => __('Left Thumbnail + Summary', 'primathemes'),
			'thumbnailright' => __('Right Thumbnail + Summary', 'primathemes'),
			),
		);
	$settings["content_navigation"] = array( 
		"section" => "layout_default",
		"name" => __('Default Content Navigation', 'primathemes'),
		"id" => "content_navigation",
		"desc" => "",
		"default" => 'numeric',
		"type" => "select",
		"options" => array ( 
			'prevnext' => __('Previous Page - Next Page', 'primathemes'),
			'oldernewer' => __('Older Posts - Newer Posts', 'primathemes'),
			'numeric' => __('Numeric Navigation', 'primathemes'),
			), 
		);
	$settings["breadcrumb_hide_archives"] = array( 
		"section" => "layout_default",
		"name" => __('Breadcrumb', 'primathemes'),
		"id" => "breadcrumb_hide_archives",
		"desc" => __('Hide breadcrumb on archives page (default homepage, post category, post tag, archive, and search result page.', 'primathemes'),
		"default" => "",
		"type" => "checkbox",
		);
	return $settings;
}

/**
 * Add Page Setting section of Layout tab for Theme Settings page.
 *
 * @since PrimaShop 1.0
 */
add_filter( 'prima_theme_settings_args', 'prima_theme_settings_args_layout_page' );
function prima_theme_settings_args_layout_page( $settings ) {
	global $prima_default_layout, $prima_registered_sidebar_areas;
	$layouts = prima_list_layout( true );
	$sidebars_opt = prima_list_sidebar();

	$settings["section_layout_page"] = array( 
		"tab" => "layout",
		"type" => "section",
		"name" => __('Page Setting', 'primathemes'),
		"id" => "layout_page",
		);
	$settings["layout_page_info"] = array( 
		"section" => "layout_page",
		"name" => __('Info', 'primathemes'),
		"id" => "layout_page_info",
		"desc" => __('You can control default layout and sidebars for "page". Layout and sidebars can also be changed when adding or editing a page.', 'primathemes'),
		"default" => "",
		"type" => "info",
		);
		
	if ( 0 != count( $layouts ) ) {
		$settings["layout_page"] = array( 
			"section" => "layout_page",
			"name" => __('Default Layout', 'primathemes'),
			"id" => "layout_page",
			"desc" => "",
			"default" => "",
			"type" => "images",
			"options" => $layouts,
			);
	}
	if ( !empty( $prima_registered_sidebar_areas ) ) {
		foreach ( $prima_registered_sidebar_areas as $sidebar_area ) {
			$settings["{$sidebar_area['id']}_page"] = array( 
				"section" => "layout_page",
				"name" => $sidebar_area['label'],
				"id" => "{$sidebar_area['id']}_page",
				"desc" => '<a href="'.add_query_arg( array( 'page' => 'primathemes-sidebars' ), admin_url( 'themes.php' ) ).'">'.__( 'Manage Sidebars', 'primathemes' ).'</a> &middot; <a href="'.admin_url('widgets.php').'">'.__( 'Manage Widgets', 'primathemes' ).'</a>',
				"default" => '',
				"type" => "select",
				"options" => $sidebars_opt,
				);
		}
	}
	$settings["breadcrumb_hide_page"] = array( 
		"section" => "layout_page",
		"name" => __('Breadcrumb', 'primathemes'),
		"id" => "breadcrumb_hide_page",
		"desc" => __('Hide breadcrumb on Page.', 'primathemes'),
		"default" => "",
		"type" => "checkbox",
		);
	$settings["featured_image_page"] = array( 
		"section" => "layout_page",
		"name" => __('Featured Image', 'primathemes'),
		"id" => "featured_image_page",
		"desc" => __('Show featured image on Page.', 'primathemes'),
		"default" => "",
		"type" => "checkbox",
		);
	return $settings;
}

/**
 * Add Single Post Setting section of Layout tab for Theme Settings page.
 *
 * @since PrimaShop 1.0
 */
add_filter( 'prima_theme_settings_args', 'prima_theme_settings_args_layout_post' );
function prima_theme_settings_args_layout_post( $settings ) {
	global $prima_default_layout, $prima_registered_sidebar_areas;
	$layouts = prima_list_layout( true );
	$sidebars_opt = prima_list_sidebar();

	$settings["section_layout_post"] = array( 
		"tab" => "layout",
		"type" => "section",
		"name" => __('Single Post Setting', 'primathemes'),
		"id" => "layout_post",
		);
	$settings["layout_post_info"] = array( 
		"section" => "layout_post",
		"name" => __('Info', 'primathemes'),
		"id" => "layout_post_info",
		"desc" => __('You can control default layout and sidebars for "single post" page. Layout and sidebars can also be changed when adding or editing a post.', 'primathemes'),
		"default" => "",
		"type" => "info",
		);
		
	if ( 0 != count( $layouts ) ) {
		$settings["layout_post"] = array( 
			"section" => "layout_post",
			"name" => __('Default Layout', 'primathemes'),
			"id" => "layout_post",
			"desc" => "",
			"default" => "",
			"type" => "images",
			"options" => $layouts,
			);
	}
	if ( !empty( $prima_registered_sidebar_areas ) ) {
		foreach ( $prima_registered_sidebar_areas as $sidebar_area ) {
			$settings["{$sidebar_area['id']}_post"] = array( 
				"section" => "layout_post",
				"name" => $sidebar_area['label'],
				"id" => "{$sidebar_area['id']}_post",
				"desc" => '<a href="'.add_query_arg( array( 'page' => 'primathemes-sidebars' ), admin_url( 'themes.php' ) ).'">'.__( 'Manage Sidebars', 'primathemes' ).'</a> &middot; <a href="'.admin_url('widgets.php').'">'.__( 'Manage Widgets', 'primathemes' ).'</a>',
				"default" => '',
				"type" => "select",
				"options" => $sidebars_opt,
				);
		}
	}
	$settings["breadcrumb_hide_post"] = array( 
		"section" => "layout_post",
		"name" => __('Breadcrumb', 'primathemes'),
		"id" => "breadcrumb_hide_post",
		"desc" => __('Hide breadcrumb on single post page.', 'primathemes'),
		"default" => "",
		"type" => "checkbox",
		);
	$settings["featured_image_post"] = array( 
		"section" => "layout_post",
		"name" => __('Featured Image', 'primathemes'),
		"id" => "featured_image_post",
		"desc" => __('Show featured image on single post page.', 'primathemes'),
		"default" => "",
		"type" => "checkbox",
		);
	$settings["meta_post"] = array( 
		"section" => "layout_post",
		"name" => __('Post Meta on Blog page', 'primathemes'),
		"id" => "meta_post",
		"desc" => __( 'Useful Shortcodes:', 'primathemes' ).'<code>[post-date]</code>, <code>[post-author]</code>, <code>[post-comments-link]</code>, <code>[post-edit-link]</code>, <code>[post-shortlink]</code>, <code>[post-terms taxonomy="category"]</code>',
		"default" => __( 'Posted on [post-date] by [post-author] / [post-comments-link] [post-edit-link before="/ "]', 'primathemes' ),
		"type" => "text",
		);
	$settings["meta_single_post"] = array( 
		"section" => "layout_post",
		"name" => __('Post Meta on single post page', 'primathemes'),
		"id" => "meta_single_post",
		"desc" => __( 'Useful Shortcodes:', 'primathemes' ).'<code>[post-date]</code>, <code>[post-author]</code>, <code>[post-comments-link]</code>, <code>[post-edit-link]</code>, <code>[post-shortlink]</code>, <code>[post-terms taxonomy="category"]</code>',
		"default" => __( 'Posted on [post-date] by [post-author]. [post-edit-link]', 'primathemes' ),
		"type" => "text",
		);
	$settings["post_navigation_hide"] = array( 
		"section" => "layout_post",
		"name" => __('Post navigation', 'primathemes'),
		"id" => "post_navigation_hide",
		"desc" => __('Hide post navigation on single post page.', 'primathemes'),
		"default" => "",
		"type" => "checkbox",
		);
	return $settings;
}

/**
 * Add Shop Page Setting section of Layout tab for Theme Settings page.
 *
 * @since PrimaShop 1.0
 */
add_filter( 'prima_theme_settings_args', 'prima_theme_settings_args_layout_shop' );
function prima_theme_settings_args_layout_shop( $settings ) {
	global $prima_default_layout, $prima_registered_sidebar_areas;
	$layouts = prima_list_layout( true );
	$sidebars_opt = prima_list_sidebar();

	$settings["section_layout_shop"] = array( 
		"tab" => "layout",
		"type" => "section",
		"name" => __('Shop Page Setting', 'primathemes'),
		"id" => "layout_shop",
		);
	$settings["layout_shop_info"] = array( 
		"section" => "layout_shop",
		"name" => __('Info', 'primathemes'),
		"id" => "layout_shop_info",
		"desc" => __('You can control layout and sidebars for "shop" page, including archive page for product categories, product tags, and product attributes.', 'primathemes'),
		"default" => "",
		"type" => "info",
		);
		
	if ( 0 != count( $layouts ) ) {
		$settings["layout_shop"] = array( 
			"section" => "layout_shop",
			"name" => __('Default Layout', 'primathemes'),
			"id" => "layout_shop",
			"desc" => "",
			"default" => "",
			"type" => "images",
			"options" => $layouts,
			);
	}
	if ( !empty( $prima_registered_sidebar_areas ) ) {
		foreach ( $prima_registered_sidebar_areas as $sidebar_area ) {
			$settings["{$sidebar_area['id']}_shop"] = array( 
				"section" => "layout_shop",
				"name" => $sidebar_area['label'],
				"id" => "{$sidebar_area['id']}_shop",
				"desc" => '<a href="'.add_query_arg( array( 'page' => 'primathemes-sidebars' ), admin_url( 'themes.php' ) ).'">'.__( 'Manage Sidebars', 'primathemes' ).'</a> &middot; <a href="'.admin_url('widgets.php').'">'.__( 'Manage Widgets', 'primathemes' ).'</a>',
				"default" => '',
				"type" => "select",
				"options" => $sidebars_opt,
				);
		}
	}
	$settings["breadcrumb_hide_shop"] = array( 
		"section" => "layout_shop",
		"name" => __('Breadcrumb', 'primathemes'),
		"id" => "breadcrumb_hide_shop",
		"desc" => __('Hide breadcrumb on shop page.', 'primathemes'),
		"default" => "",
		"type" => "checkbox",
		);
	return $settings;
}

/**
 * Add Single Product Page Setting section of Layout tab for Theme Settings page.
 *
 * @since PrimaShop 1.0
 */
add_filter( 'prima_theme_settings_args', 'prima_theme_settings_args_layout_product' );
function prima_theme_settings_args_layout_product( $settings ) {
	global $prima_default_layout, $prima_registered_sidebar_areas;
	$layouts = prima_list_layout( true );
	$sidebars_opt = prima_list_sidebar();

	$settings["section_layout_product"] = array( 
		"tab" => "layout",
		"type" => "section",
		"name" => __('Single Product Page Setting', 'primathemes'),
		"id" => "layout_product",
		);
	$settings["layout_product_info"] = array( 
		"section" => "layout_product",
		"name" => __('Info', 'primathemes'),
		"id" => "layout_product_info",
		"desc" => __('You can control default layout and sidebars for "single product" page. Layout and sidebars can also be changed when adding or editing a product.', 'primathemes'),
		"default" => "",
		"type" => "info",
		);
		
	if ( 0 != count( $layouts ) ) {
		$settings["layout_product"] = array( 
			"section" => "layout_product",
			"name" => __('Default Layout', 'primathemes'),
			"id" => "layout_product",
			"desc" => "",
			"default" => "",
			"type" => "images",
			"options" => $layouts,
			);
	}
	if ( !empty( $prima_registered_sidebar_areas ) ) {
		foreach ( $prima_registered_sidebar_areas as $sidebar_area ) {
			$settings["{$sidebar_area['id']}_product"] = array( 
				"section" => "layout_product",
				"name" => $sidebar_area['label'],
				"id" => "{$sidebar_area['id']}_product",
				"desc" => '<a href="'.add_query_arg( array( 'page' => 'primathemes-sidebars' ), admin_url( 'themes.php' ) ).'">'.__( 'Manage Sidebars', 'primathemes' ).'</a> &middot; <a href="'.admin_url('widgets.php').'">'.__( 'Manage Widgets', 'primathemes' ).'</a>',
				"default" => '',
				"type" => "select",
				"options" => $sidebars_opt,
				);
		}
	}
	$settings["breadcrumb_hide_product"] = array( 
		"section" => "layout_product",
		"name" => __('Breadcrumb', 'primathemes'),
		"id" => "breadcrumb_hide_product",
		"desc" => __('Hide breadcrumb on single product page.', 'primathemes'),
		"default" => "",
		"type" => "checkbox",
		);
	return $settings;
}

/**
 * Add Header tab for Theme Settings page.
 *
 * @since PrimaShop 1.0
 */
add_filter( 'prima_theme_settings_args', 'prima_theme_settings_args_header_tab' );
function prima_theme_settings_args_header_tab( $settings ) {
	$settings["tab_header"] = array( 
		"name" => __('Header', 'primathemes'),
		"id" => "header",
		"type" => "tab",
		);
	return $settings;
}

/**
 * Add Top Navigation section of Header tab for Theme Settings page.
 *
 * @since PrimaShop 1.0
 */
add_filter( 'prima_theme_settings_args', 'prima_theme_settings_args_header_topnav' );
function prima_theme_settings_args_header_topnav( $settings ) {
	$settings["section_header_topnav"] = array( 
		"tab" => "header",
		"type" => "section",
		"name" => __('Top Navigation', 'primathemes'),
		"id" => "header_topnav",
		);
	$settings["topnav"] = array( 
		"section" => "header_topnav",
		"name" => __('Top Navigation', 'primathemes'),
		"id" => "topnav",
		"desc" => __('Enable top navigation area', 'primathemes'),
		"default" => "true",
		"type" => "checkbox",
		);
	$settings["topnav_message"] = array( 
		"section" => "header_topnav",
		"name" => __('Welcome message for visitor', 'primathemes'),
		"id" => "topnav_message",
		"desc" => '',
		"default" => __('Default welcome message to get attention!', 'primathemes'),
		"type" => "text",
		);    
	$settings["topnav_myaccount"] = array( 
		"section" => "header_topnav",
		"name" => __('My account link', 'primathemes'),
		"id" => "topnav_myaccount",
		"desc" => __('Show "My Account" link at top navigation.', 'primathemes'),
		"default" => "true",
		"type" => "checkbox",
		);
	$settings["topnav_login"] = array( 
		"section" => "header_topnav",
		"name" => __('Login/Logout link', 'primathemes'),
		"id" => "topnav_login",
		"desc" => __('Show "Login/Logout" link at top navigation.', 'primathemes'),
		"default" => "true",
		"type" => "checkbox",
		);
	$settings["topnav_cart"] = array( 
		"section" => "header_topnav",
		"name" => __('Cart link', 'primathemes'),
		"id" => "topnav_cart",
		"desc" => __('Show cart link at top navigation.', 'primathemes'),
		"default" => "true",
		"type" => "checkbox",
		);
	$settings["topnav_cart_text"] = array( 
		"section" => "header_topnav",
		"name" => __('Custom text for cart link', 'primathemes'),
		"id" => "topnav_cart_text",
		"desc" => __( 'Available Shortcodes:', 'primathemes' ).'<code>[cartcount]</code>, <code>[carttotal]</code>',
		"default" => '',
		"type" => "text",
		);    
	$settings["topnav_minicart"] = array( 
		"section" => "header_topnav",
		"name" => __('Minicart', 'primathemes'),
		"id" => "topnav_minicart",
		"desc" => __('Show minicart below top cart at top navigation.', 'primathemes'),
		"default" => "true",
		"type" => "checkbox",
		);
	$settings["topnav_productsearch"] = array( 
		"section" => "header_topnav",
		"name" => __('Product search form', 'primathemes'),
		"id" => "topnav_productsearch",
		"desc" => __('Show product search form at top navigation.', 'primathemes'),
		"default" => "true",
		"type" => "checkbox",
		);
						
	return $settings;
}

/**
 * Add Header Content section of Header tab for Theme Settings page.
 *
 * @since PrimaShop 1.0
 */
add_filter( 'prima_theme_settings_args', 'prima_theme_settings_args_header_content' );
function prima_theme_settings_args_header_content( $settings ) {
	$settings["section_header_content"] = array( 
		"tab" => "header",
		"type" => "section",
		"name" => __('Header Content (Logo+Menu)', 'primathemes'),
		"id" => "header_content",
		);
	$settings["header_sticky"] = array( 
		"section" => "header_content",
		"name" => __('Sticky Header', 'primathemes'),
		"id" => "header_sticky",
		"desc" => __('Enable sticky header in desktop view.', 'primathemes'),
		"default" => "no",
		"type" => "select",
		"options" => array(
			'no' => __('No', 'primathemes'),
			'yes' => __('Yes', 'primathemes')
			),
		);
	$settings["header_logo"] = array( 
		"section" => "header_content",
		"name" => __('Logo Image URL', 'primathemes'),
		"desc" => __('recommended size:', 'primathemes') . ' 400x100 pixels ' . __('(png, jpg or gif)', 'primathemes'), 
		"id" => "header_logo",
		"default" => PRIMA_URI.'/images/logo.png',
		"type" => "upload",
		);    
	$settings["header_logo_width"] = array( 
		"section" => "header_content",
		"name" => __('Logo Image HTML width', 'primathemes'),
		"id" => "header_logo_width",
		"desc" => __('recommended size:', 'primathemes') . ' 200 pixels ' . __('(50% of your real logo width)', 'primathemes'), 
		"default" => '200',
		"type" => "text",
		);    
	$settings["header_menu_info"] = array( 
		"section" => "header_content",
		"name" => __('Header Menu', 'primathemes'),
		"id" => "header_menu_info",
		"desc" => sprintf(__('Visit your <a href="%1$s">Appearance - Menus</a> page to configure your Header Menu.', 'primathemes'), admin_url('nav-menus.php')),
		"default" => "",
		"type" => "info",
		);
						
	return $settings;
}

/**
 * Add Header Featured section of Header tab for Theme Settings page.
 *
 * @since PrimaShop 1.0
 */
add_filter( 'prima_theme_settings_args', 'prima_theme_settings_args_header_featured' );
function prima_theme_settings_args_header_featured( $settings ) {
	$settings["section_header_featured"] = array( 
		"tab" => "header",
		"type" => "section",
		"name" => __('Header Featured', 'primathemes'),
		"id" => "header_featured",
		);
	$settings["header_image_info"] = array( 
		"section" => "header_featured",
		"name" => __('Default Header Image', 'primathemes'),
		"id" => "header_image_info",
		"desc" => sprintf(__('Visit your <a href="%1$s">Appearance - Header</a> page to upload the default header image.', 'primathemes'), add_query_arg( array( 'autofocus[control]' => 'header_image' ), admin_url( 'customize.php' ) ) ),
		"default" => "",
		"type" => "info",
		);
	$settings["header_featured_nopadding"] = array( 
		"section" => "header_featured",
		"name" => __('Default Header Image Padding', 'primathemes'),
		"id" => "header_featured_nopadding",
		"desc" => __('Remove padding (top,left,bottom,right space) on default header image', 'primathemes'),
		"default" => "false",
		"type" => "checkbox",
		);
	$settings["header_featured_fullscreen"] = array( 
		"section" => "header_featured",
		"name" => __('Default Header Image Full Screen Mode', 'primathemes'),
		"id" => "header_featured_fullscreen",
		"desc" => __('This will enable full screen mode for default header image.', 'primathemes'),
		"default" => "false",
		"type" => "checkbox",
		);
	$settings["header_featured_slider_numbers"] = array( 
		"section" => "header_featured",
		"name" => __('Maximum Slider Images', 'primathemes'),
		"id" => "header_featured_slider_numbers",
		"desc" => __('Number of maximum slider images to show on Header Settings when editing a page', 'primathemes'),
		"default" => '',
		"type" => "text",
		);    
						
	return $settings;
}

/**
 * Add Header Call To Action section of Header tab for Theme Settings page.
 *
 * @since PrimaShop 1.0
 */
add_filter( 'prima_theme_settings_args', 'prima_theme_settings_args_header_action' );
function prima_theme_settings_args_header_action( $settings ) {
	$settings["section_header_action"] = array( 
		"tab" => "header",
		"type" => "section",
		"name" => __('Header Call To Action', 'primathemes'),
		"id" => "header_action",
		);
	$settings["calltoaction"] = array( 
		"section" => "header_action",
		"name" => __('Call To Action', 'primathemes'),
		"id" => "calltoaction",
		"desc" => __('Enable call to action area', 'primathemes'),
		"default" => "true",
		"type" => "checkbox",
		);
	$settings["calltoaction_text"] = array( 
		"section" => "header_action",
		"name" => __('Call to action text', 'primathemes'),
		"id" => "calltoaction_text",
		"desc" => '',
		"default" => __('Use <strong>PrimaThemes</strong> coupon code to save you 15% off on your order.', 'primathemes'),
		"type" => "text",
		);    
	$settings["calltoaction_button"] = array( 
		"section" => "header_action",
		"name" => __('Call to action button text', 'primathemes'),
		"id" => "calltoaction_button",
		"desc" => '',
		"default" => __('Shop Now!', 'primathemes'),
		"type" => "text",
		);    
	$settings["calltoaction_url"] = array( 
		"section" => "header_action",
		"name" => __('Call to action button url', 'primathemes'),
		"id" => "calltoaction_url",
		"desc" => '',
		"default" => '',
		"type" => "text",
		"class" => "noborder",
		);    
	$settings["calltoaction_target"] = array( 
		"section" => "header_action",
		"name" => "",
		"id" => "calltoaction_target",
		"desc" => __('Open link in new window', 'primathemes'),
		"default" => "",
		"type" => "checkbox",
		);
		
	return $settings;
}

/**
 * Add Footer tab for Theme Settings page.
 *
 * @since PrimaShop 1.0
 */
add_filter( 'prima_theme_settings_args', 'prima_theme_settings_args_footer_tab' );
function prima_theme_settings_args_footer_tab( $settings ) {
	$settings["tab_footer"] = array( 
		"name" => __('Footer', 'primathemes'),
		"id" => "footer",
		"type" => "tab",
		);
	return $settings;
}

/**
 * Add Footer Widgets section of Footer tab for Theme Settings page.
 *
 * @since PrimaShop 1.0
 */
add_filter( 'prima_theme_settings_args', 'prima_theme_settings_args_footer_widgets' );
function prima_theme_settings_args_footer_widgets( $settings ) {
	$settings["section_footer_widgets"] = array( 
		"tab" => "footer",
		"type" => "section",
		"name" => __('Footer Widgets', 'primathemes'),
		"id" => "footer_widgets",
		);
	$settings["footer_widgets"] = array( 
		"section" => "footer_widgets",
		"name" => __('Footer Widgets Layout', 'primathemes'),
		"id" => "footer_widgets",
		"desc" => "",
		"default" => '0',
		"type" => "images",
		"options" => array(
			'0' => trailingslashit(PRIMA_CUSTOM_URI).'theme/images/layout-footer-0.png',
			'10' => trailingslashit(PRIMA_CUSTOM_URI).'theme/images/layout-footer-10.png',
			'20' => trailingslashit(PRIMA_CUSTOM_URI).'theme/images/layout-footer-20.png',
			'21' => trailingslashit(PRIMA_CUSTOM_URI).'theme/images/layout-footer-21.png',
			'22' => trailingslashit(PRIMA_CUSTOM_URI).'theme/images/layout-footer-22.png',
			'30' => trailingslashit(PRIMA_CUSTOM_URI).'theme/images/layout-footer-30.png',
			'31' => trailingslashit(PRIMA_CUSTOM_URI).'theme/images/layout-footer-31.png',
			'32' => trailingslashit(PRIMA_CUSTOM_URI).'theme/images/layout-footer-32.png',
			'40' => trailingslashit(PRIMA_CUSTOM_URI).'theme/images/layout-footer-40.png',
			),
		);
	return $settings;
}

/**
 * Add Footer Content section of Footer tab for Theme Settings page.
 *
 * @since PrimaShop 1.0
 */
add_filter( 'prima_theme_settings_args', 'prima_theme_settings_args_footer_content' );
function prima_theme_settings_args_footer_content( $settings ) {
	$settings["section_footer_content"] = array( 
		"tab" => "footer",
		"type" => "section",
		"name" => __('Footer Content', 'primathemes'),
		"id" => "footer_content",
		);
	$settings["footer_content"] = array( 
		"section" => "footer_content",
		"name" => __('Footer Copyright', 'primathemes'),
		"id" => "footer_content",
		"desc" => __( 'Useful Shortcodes:', 'primathemes' ).'<code>[year]</code>, <code>[site-link]</code>, <code>[wp-link]</code>, <code>[theme-link]</code>, <code>[loginout-link]</code>, <code>[query-counter]</code>',
		"default" => __( '&#169; [year] [site-link]. Powered by [theme-link] and [wp-link].', 'primathemes' ),
		"type" => "textarea",
		);
	$settings["footer_menu"] = array( 
		"section" => "footer_content",
		"name" => __('Footer Menu', 'primathemes'),
		"id" => "footer_menu",
		"desc" => sprintf(__('Visit your <a href="%1$s">Appearance - Menus</a> page to configure your Footer Menu.', 'primathemes'), admin_url('nav-menus.php')),
		"default" => "",
		"type" => "info",
		);
	return $settings;
}

/**
 * Add Footer Script section of Footer tab for Theme Settings page.
 *
 * @since PrimaShop 1.3
 */
add_filter( 'prima_theme_settings_args', 'prima_theme_settings_args_footer_script' );
function prima_theme_settings_args_footer_script( $settings ) {
	$settings["section_footer_script"] = array( 
		"tab" => "footer",
		"type" => "section",
		"name" => __('Footer Script', 'primathemes'),
		"id" => "footer_script",
		);
	$settings["footer_script_code"] = array( 
		"section" => "footer_script",
		"name" => __('Footer Script Code', 'primathemes'),
		"id" => "footer_script_code",
		"desc" => __( 'Put your custom footer script code here. Useful for analytics / tracking code.', 'primathemes' ),
		"type" => "textarea",
		);
	return $settings;
}

/**
 * Add Additional Footer section of Footer tab for Theme Settings page.
 *
 * @since PrimaShop 1.0
 */
add_filter( 'prima_theme_settings_args', 'prima_theme_settings_args_footer_additional' );
function prima_theme_settings_args_footer_additional( $settings ) {
	$settings["section_footer_additional"] = array( 
		"tab" => "footer",
		"type" => "section",
		"name" => __('Additional Footer', 'primathemes'),
		"id" => "footer_additional",
		);
	$settings["footer_query"] = array( 
		"section" => "footer_additional",
		"name" => __('Query Counter', 'primathemes'),
		"id" => "footer_query",
		"desc" => __('Show query counter for user with administrator level.', 'primathemes'),
		"default" => false,
		"type" => "checkbox",
		);
	return $settings;
}

/**
 * Add Branding tab for Theme Settings page.
 *
 * @since PrimaShop 1.0
 */
add_filter( 'prima_theme_settings_args', 'prima_theme_settings_args_branding_tab' );
function prima_theme_settings_args_branding_tab( $settings ) {
	$settings["tab_branding"] = array( 
		"name" => __('Branding', 'primathemes'),
		"id" => "branding",
		"type" => "tab",
		);
	return $settings;
}

/**
 * Add Favicon section of Branding tab for Theme Settings page.
 *
 * @since PrimaShop 1.0
 */
add_filter( 'prima_theme_settings_args', 'prima_theme_settings_args_branding_favicon' );
function prima_theme_settings_args_branding_favicon( $settings ) {
	$settings["section_branding_favicon"] = array( 
		"tab" => "branding",
		"type" => "section",
		"name" => __('Favicon', 'primathemes'),
		"id" => "branding_favicon",
		);
	$settings["favicon_url"] = array( 
		"section" => "branding_favicon",
		"name" => __('Favicon URL', 'primathemes'),
		"desc" => __('recommended size:', 'primathemes') . ' 32x32 pixels ' . __('(ico)', 'primathemes'), 
		"id" => "favicon_url",
		"default" => PRIMA_URI.'/images/favicon.ico',
		"type" => "upload",
		);    
						
	return $settings;
}

/**
 * Add Login Logo section of Branding tab for Theme Settings page.
 *
 * @since PrimaShop 1.0
 */
add_filter( 'prima_theme_settings_args', 'prima_theme_settings_args_branding_loginlogo' );
function prima_theme_settings_args_branding_loginlogo( $settings ) {
	$settings["section_branding_loginlogo"] = array( 
		"tab" => "branding",
		"type" => "section",
		"name" => __('Login Logo', 'primathemes'),
		"id" => "branding_loginlogo",
		);
	$settings["loginlogo_url"] = array( 
		"section" => "branding_loginlogo",
		"name" => __('Login Logo URL', 'primathemes'),
		"desc" => __('recommended size:', 'primathemes') . ' 640x160 pixels ' . __('(png, jpg or gif)', 'primathemes'), 
		"id" => "loginlogo_url",
		"default" => PRIMA_URI.'/images/logo-login.png',
		"type" => "upload",
		);    
	$settings["loginlogo_width"] = array( 
		"section" => "branding_loginlogo",
		"name" => __('Login Logo HTML Width', 'primathemes'),
		"id" => "loginlogo_width",
		"desc" => __('recommended size:', 'primathemes') . ' 320 pixels ' . __('(50% of your real logo width)', 'primathemes'), 
		"default" => '320',
		"type" => "text",
		);    
	$settings["loginlogo_height"] = array( 
		"section" => "branding_loginlogo",
		"name" => __('Login Logo HTML Height', 'primathemes'),
		"id" => "loginlogo_height",
		"desc" => __('recommended size:', 'primathemes') . ' 80 pixels ' . __('(50% of your real logo height)', 'primathemes'), 
		"default" => '80',
		"type" => "text",
		);    
						
	return $settings;
}

/**
 * Add Admin Logo section of Branding tab for Theme Settings page.
 *
 * @since PrimaShop 1.0
 */
add_filter( 'prima_theme_settings_args', 'prima_theme_settings_args_branding_adminlogo' );
function prima_theme_settings_args_branding_adminlogo( $settings ) {
	$settings["section_branding_adminlogo"] = array( 
		"tab" => "branding",
		"type" => "section",
		"name" => __('Admin Logo', 'primathemes'),
		"id" => "branding_adminlogo",
		);
	$settings["adminlogo_url"] = array( 
		"section" => "branding_adminlogo",
		"name" => __('Admin Logo URL', 'primathemes'),
		"desc" => __('recommended size:', 'primathemes') . ' 20x20 pixels ' . __('(png, jpg or gif)', 'primathemes'), 
		"id" => "adminlogo_url",
		"default" => PRIMA_URI.'/images/logo-admin.png',
		"type" => "upload",
		);    
						
	return $settings;
}

/**
 * Add Admin Footer section of Branding tab for Theme Settings page.
 *
 * @since PrimaShop 1.0
 */
add_filter( 'prima_theme_settings_args', 'prima_theme_settings_args_branding_adminfooter' );
function prima_theme_settings_args_branding_adminfooter( $settings ) {
	$settings["section_branding_adminfooter"] = array( 
		"tab" => "branding",
		"type" => "section",
		"name" => __('Admin Footer', 'primathemes'),
		"id" => "branding_adminfooter",
		);
	$settings["adminfooter"] = array( 
		"section" => "branding_adminfooter",
		"name" => __('Admin Footer Text', 'primathemes'),
		"id" => "adminfooter",
		"desc" => __( 'Available Shortcodes:', 'primathemes' ).'<code>[year]</code>, <code>[site-link]</code>, <code>[wp-link]</code>, <code>[theme-link]</code>, <code>[loginout-link]</code>, <code>[query-counter]</code>',
		"default" => __( '&#169; [year] [site-link]. Powered by [theme-link] and [wp-link].', 'primathemes' ),
		"type" => "text",
		);
						
	return $settings;
}

/**
 * Add Social tab for Theme Settings page.
 *
 * @since PrimaShop 1.5
 */
add_filter( 'prima_theme_settings_args', 'prima_theme_settings_args_social_tab' );
function prima_theme_settings_args_social_tab( $settings ) {
	$settings["tab_social"] = array( 
		"name" => __('Social', 'primathemes'),
		"id" => "social",
		"type" => "tab",
		);
	return $settings;
}

/**
 * Add Social Shares section of Social tab for Theme Settings page.
 *
 * @since PrimaShop 1.5
 */
add_filter( 'prima_theme_settings_args', 'prima_theme_settings_args_social_share' );
function prima_theme_settings_args_social_share( $settings ) {
	$settings["section_social_share"] = array( 
		"tab" => "social",
		"type" => "section",
		"name" => __('Social Sharing Buttons', 'primathemes'),
		"id" => "social_share",
		);
	$settings["socialite_product"] = array( 
		"section" => "social_share",
		"name" => __('Single Product Page', 'primathemes'),
		"id" => "socialite_product",
		"desc" => __('Show social sharing buttons at the bottom of product summary', 'primathemes'),
		"default" => false,
		"type" => "checkbox",
		);
	$settings["socialite_post"] = array( 
		"section" => "social_share",
		"name" => __('Single Post Page', 'primathemes'),
		"id" => "socialite_post",
		"desc" => __('Show social sharing buttons at the bottom of single post content', 'primathemes'),
		"default" => false,
		"type" => "checkbox",
		);
	$settings["socialite_page"] = array( 
		"section" => "social_share",
		"name" => __('Reguler Page', 'primathemes'),
		"id" => "socialite_page",
		"desc" => __('Show social sharing buttons at the bottom of regular pages', 'primathemes'),
		"default" => false,
		"type" => "checkbox",
		);
	$settings["socialite_size"] = array( 
		"section" => "social_share",
		"name" => __('Social Sharing Buttons Size', 'primathemes'),
		"id" => "socialite_size",
		"desc" => null,
		"default" => 'small',
		"type" => "select",
		"options" => array ( 'small'=>__('Small', 'primathemes'), 'big'=>__('Big', 'primathemes') ),
		);
	$social = array(
		'' => '',
		'twitter' => 'Twitter',
		'google-plus' => 'Google+',
		'facebook' => 'Facebook',
		'pinterest' => 'Pinterest',
		'linkedin' => 'Linkedin',
	);
	for ($i = 1; $i <= 5; $i++) {
		$settings["socialite_button_{$i}"] = array( 
			"section" => "social_share",
			"name" => sprintf ( __("Social Sharing #%d", 'primathemes'), $i ),
			"id" => "socialite_button_{$i}",
			"desc" => null,
			"default" => '',
			"type" => "select",
			"options" => $social,
			);
	}
	return $settings;
}

/**
 * Add Footer Social Icons section of Social tab for Theme Settings page.
 *
 * @since PrimaShop 1.5
 */
add_filter( 'prima_theme_settings_args', 'prima_theme_settings_args_social_footer' );
function prima_theme_settings_args_social_footer( $settings ) {
	$settings["section_social_footer"] = array( 
		"tab" => "social",
		"type" => "section",
		"name" => __('Footer Social Icons', 'primathemes'),
		"id" => "social_footer",
		);
	$number = array();
	for ($i = 0; $i <= 24; $i++) {
		$number[$i] = $i;
	}
	$settings["footer_social"] = array( 
		"section" => "social_footer",
		"name" => __('Footer Social Icons', 'primathemes'),
		"id" => "footer_social",
		"desc" => __('Number of social icons to show.', 'primathemes'),
		"default" => '0',
		"type" => "select",
		"options" => $number,
		);
	$social = array(
		'rss' => 'RSS',
		'facebook' => 'Facebook',
		'twitter' => 'Twitter',
		'google-plus' => 'Google+',
		'linkedin' => 'Linkedin',
		'pinterest' => 'Pinterest',
		'foursquare' => 'Foursuare',
		'instagram' => 'Instagram',
		'skype' => 'Skype',
		'youtube' => 'Youtube',
		'vimeo-square' => 'Vimeo',
		'flickr' => 'Flickr',
		'tumblr' => 'Tumblr',
		'wordpress' => 'WordPress',
		'dribbble' => 'Dribble',
		'behance' => 'Behance',
		'github' => 'Github',
		'digg' => 'Digg',
		'stumbleupon' => 'Stumble Upon',
		'reddit' => 'Reddit',
		'delicious' => 'Delicious',
	);
	if ( prima_get_setting( 'footer_social' ) > 0 ) {
		for ($i = 1; $i <= prima_get_setting( 'footer_social' ); $i++) {
			$settings["footer_social_{$i}"] = array( 
				"section" => "social_footer",
				"name" => sprintf ( __("Social Icon #%d", 'primathemes'), $i ),
				"id" => "footer_social_{$i}",
				"desc" => null,
				"default" => '',
				"type" => "select",
				"options" => $social,
				);
			$settings["footer_social_{$i}_url"] = array( 
				"section" => "social_footer",
				"name" => sprintf ( __("Social Icon #%d URL", 'primathemes'), $i ),
				"id" => "footer_social_{$i}_url",
				"desc" => null,
				"default" => '',
				"type" => "text",
				);
		}
	}
	return $settings;
}

/**
 * Add Ecommerce tab for Theme Settings page.
 *
 * @since PrimaShop 1.0
 */
add_filter( 'prima_theme_settings_args', 'prima_theme_settings_args_ecommerce_tab' );
function prima_theme_settings_args_ecommerce_tab( $settings ) {
	$settings["tab_ecommerce"] = array( 
		"name" => __('Ecommerce', 'primathemes'),
		"id" => "ecommerce",
		"type" => "tab",
		);
	return $settings;
}

/**
 * Add Shop Page Settings section of Footer tab for Theme Settings page.
 *
 * @since PrimaShop 1.0
 */
add_filter( 'prima_theme_settings_args', 'prima_theme_settings_args_ecommerce_shop' );
function prima_theme_settings_args_ecommerce_shop( $settings ) {
	$settings["section_ecommerce_shop"] = array( 
		"tab" => "ecommerce",
		"type" => "section",
		"name" => __('Shop Page Settings', 'primathemes'),
		"id" => "ecommerce_shop",
		);
	$settings["shop_perpage"] = array( 
		"section" => "ecommerce_shop",
		"name" => __('Products Per Page', 'primathemes'),
		"id" => "shop_perpage",
		"desc" => null,
		"default" => '12',
		"type" => "text",
		);
	$settings["shop_columns"] = array( 
		"section" => "ecommerce_shop",
		"name" => __('Products Columns Per Row', 'primathemes'),
		"id" => "shop_columns",
		"desc" => null,
		"default" => '4',
		"type" => "select",
		"options" => array ( '1'=>'1', '2'=>'2', '3'=>'3', '4'=>'4', '5'=>'5', '6'=>'6' ),
		);
	$settings["shop_pagetitle_hide"] = array( 
		"section" => "ecommerce_shop",
		"name" => __('Shop Page Title', 'primathemes'),
		"id" => "shop_pagetitle_hide",
		"desc" => __('Hide shop page title on main shop page.', 'primathemes'),
		"default" => false,
		"type" => "checkbox",
		);
	$settings["shop_catcount_hide"] = array( 
		"section" => "ecommerce_shop",
		"name" => __('Product Category Count', 'primathemes'),
		"id" => "shop_catcount_hide",
		"desc" => __('Hide product category count.', 'primathemes'),
		"default" => false,
		"type" => "checkbox",
		);
	$settings["shop_sale_hide"] = array( 
		"section" => "ecommerce_shop",
		"name" => __('Products Sale Flash', 'primathemes'),
		"id" => "shop_sale_hide",
		"desc" => __('Hide products sale flash.', 'primathemes'),
		"default" => false,
		"type" => "checkbox",
		);
	$settings["shop_title_hide"] = array( 
		"section" => "ecommerce_shop",
		"name" => __('Products Title', 'primathemes'),
		"id" => "shop_title_hide",
		"desc" => __('Hide products title.', 'primathemes'),
		"default" => false,
		"type" => "checkbox",
		);
	$settings["shop_rating_hide"] = array( 
		"section" => "ecommerce_shop",
		"name" => __('Products Rating', 'primathemes'),
		"id" => "shop_rating_hide",
		"desc" => __('Hide products rating below product title.', 'primathemes'),
		"default" => false,
		"type" => "checkbox",
		);
	$settings["shop_price_hide"] = array( 
		"section" => "ecommerce_shop",
		"name" => __('Products Price', 'primathemes'),
		"id" => "shop_price_hide",
		"desc" => __('Hide products price below product title.', 'primathemes'),
		"default" => false,
		"type" => "checkbox",
		);
	$settings["shop_excerpt_show"] = array( 
		"section" => "ecommerce_shop",
		"name" => __('Products Excerpt', 'primathemes'),
		"id" => "shop_excerpt_show",
		"desc" => __('Show product excerpt (short summaries)', 'primathemes'),
		"default" => false,
		"type" => "checkbox",
		);
	$settings["shop_addtocart_hide"] = array( 
		"section" => "ecommerce_shop",
		"name" => __('Products &quot;Add To Cart&quot; Button', 'primathemes'),
		"id" => "shop_addtocart_hide",
		"desc" => __('Hide &quot;Add To Cart&quot; button', 'primathemes'),
		"default" => false,
		"type" => "checkbox",
		);
	$settings["shop_resultcount_hide"] = array( 
		"section" => "ecommerce_shop",
		"name" => __('Result Count', 'primathemes'),
		"id" => "shop_resultcount_hide",
		"desc" => __('Hide result count message', 'primathemes'),
		"default" => false,
		"type" => "checkbox",
		);
	$settings["shop_catalogordering_hide"] = array( 
		"section" => "ecommerce_shop",
		"name" => __('Catalog Ordering', 'primathemes'),
		"id" => "shop_catalogordering_hide",
		"desc" => __('Hide catalog ordering dropdown', 'primathemes'),
		"default" => false,
		"type" => "checkbox",
		);
	return $settings;
}

/**
 * Add Single Product Page Settings section of Footer tab for Theme Settings page.
 *
 * @since PrimaShop 1.0
 */
add_filter( 'prima_theme_settings_args', 'prima_theme_settings_args_ecommerce_product' );
function prima_theme_settings_args_ecommerce_product( $settings ) {
	$settings["section_ecommerce_product"] = array( 
		"tab" => "ecommerce",
		"type" => "section",
		"name" => __('Single Product Page Settings', 'primathemes'),
		"id" => "ecommerce_product",
		);
	$settings["product_sale_hide"] = array( 
		"section" => "ecommerce_product",
		"name" => __('Product Sale Flash', 'primathemes'),
		"id" => "product_sale_hide",
		"desc" => __('Hide product sale flash.', 'primathemes'),
		"default" => false,
		"type" => "checkbox",
		);
	$settings["product_rating_hide"] = array( 
		"section" => "ecommerce_product",
		"name" => __('Product Price', 'primathemes'),
		"id" => "product_rating_hide",
		"desc" => __('Hide product rating.', 'primathemes'),
		"default" => false,
		"type" => "checkbox",
		);
	$settings["product_price_hide"] = array( 
		"section" => "ecommerce_product",
		"name" => __('Product Price', 'primathemes'),
		"id" => "product_price_hide",
		"desc" => __('Hide product price.', 'primathemes'),
		"default" => false,
		"type" => "checkbox",
		);
	$settings["product_excerpt_hide"] = array( 
		"section" => "ecommerce_product",
		"name" => __('Product Excerpt', 'primathemes'),
		"id" => "product_excerpt_hide",
		"desc" => __('Hide product excerpt / summaries / short description.', 'primathemes'),
		"default" => false,
		"type" => "checkbox",
		);
	$settings["product_addtocart_hide"] = array( 
		"section" => "ecommerce_product",
		"name" => __('Product &quot;Add To Cart&quot; Button', 'primathemes'),
		"id" => "product_addtocart_hide",
		"desc" => __('Hide &quot;Add To Cart&quot; button.', 'primathemes'),
		"default" => false,
		"type" => "checkbox",
		);
	$settings["product_meta_hide"] = array( 
		"section" => "ecommerce_product",
		"name" => __('Product Meta (Categories/Tags)', 'primathemes'),
		"id" => "product_meta_hide",
		"desc" => __('Hide product meta (categories/tags).', 'primathemes'),
		"default" => false,
		"type" => "checkbox",
		);
	$settings["product_datatabs"] = array( 
		"section" => "ecommerce_product",
		"name" => __('Product Data Tabs Position', 'primathemes'),
		"id" => "product_datatabs",
		"desc" => null,
		"default" => 'bottom',
		"type" => "select",
		"options" => array ( 'bottom'=>__('Bottom (default)', 'primathemes'), 'right'=>__('Right Column', 'primathemes') ),
		);
	return $settings;
}

/**
 * Add Related Products Settings section of Footer tab for Theme Settings page.
 *
 * @since PrimaShop 1.0
 */
add_filter( 'prima_theme_settings_args', 'prima_theme_settings_args_ecommerce_related' );
function prima_theme_settings_args_ecommerce_related( $settings ) {
	$settings["section_ecommerce_related"] = array( 
		"tab" => "ecommerce",
		"type" => "section",
		"name" => __('Related Products Settings', 'primathemes'),
		"id" => "ecommerce_related",
		);
	$settings["ecommerce_related_info"] = array( 
		"section" => "ecommerce_related",
		"name" => __('Info', 'primathemes'),
		"id" => "ecommerce_related_info",
		"desc" => __('Related products are found from category and tag in random order.', 'primathemes'),
		"default" => "",
		"type" => "info",
		);
	$settings["shop_related_hide"] = array( 
		"section" => "ecommerce_related",
		"name" => __('Related Products', 'primathemes'),
		"id" => "shop_related_hide",
		"desc" => __('Hide related products on single product page', 'primathemes'),
		"default" => false,
		"type" => "checkbox",
		);
	$settings["shop_related_perpage"] = array( 
		"section" => "ecommerce_related",
		"name" => __('Number of Related Products', 'primathemes'),
		"id" => "shop_related_perpage",
		"desc" => null,
		"default" => '3',
		"type" => "select",
		"options" => array ( '1'=>'1', '2'=>'2', '3'=>'3', '4'=>'4', '5'=>'5', '6'=>'6', '7'=>'7', '8'=>'8', '9'=>'9', '10'=>'10', '11'=>'11', '12'=>'12' ),
		);
	$settings["shop_related_columns"] = array( 
		"section" => "ecommerce_related",
		"name" => __('Related Products Columns Per Row', 'primathemes'),
		"id" => "shop_related_columns",
		"desc" => null,
		"default" => '3',
		"type" => "select",
		"options" => array ( '1'=>'1', '2'=>'2', '3'=>'3', '4'=>'4', '5'=>'5', '6'=>'6' ),
		);
	return $settings;
}

/**
 * Add Up-Sells Settings section of Footer tab for Theme Settings page.
 *
 * @since PrimaShop 1.0
 */
add_filter( 'prima_theme_settings_args', 'prima_theme_settings_args_ecommerce_upsells' );
function prima_theme_settings_args_ecommerce_upsells( $settings ) {
	$settings["section_ecommerce_upsells"] = array( 
		"tab" => "ecommerce",
		"type" => "section",
		"name" => __('Up-Sells Settings', 'primathemes'),
		"id" => "ecommerce_upsells",
		);
	$settings["ecommerce_upsells_info"] = array( 
		"section" => "ecommerce_upsells",
		"name" => __('Info', 'primathemes'),
		"id" => "ecommerce_upsells_info",
		"desc" => __('Up-sells are products which you recommend instead of the currently viewed product, for example, products that are more profitable or better quality or more expensive. You can edit up sells when editing your products.', 'primathemes'),
		"default" => "",
		"type" => "info",
		);
	$settings["shop_upsells_hide"] = array( 
		"section" => "ecommerce_upsells",
		"name" => __('Up-Sells', 'primathemes'),
		"id" => "shop_upsells_hide",
		"desc" => __('Hide up-sells products on single product page', 'primathemes'),
		"default" => false,
		"type" => "checkbox",
		);
	$settings["shop_upsells_perpage"] = array( 
		"section" => "ecommerce_upsells",
		"name" => __('Number of Up-Sells Products', 'primathemes'),
		"id" => "shop_upsells_perpage",
		"desc" => null,
		"default" => '3',
		"type" => "select",
		"options" => array ( '1'=>'1', '2'=>'2', '3'=>'3', '4'=>'4', '5'=>'5', '6'=>'6', '7'=>'7', '8'=>'8', '9'=>'9', '10'=>'10', '11'=>'11', '12'=>'12' ),
		);
	$settings["shop_upsells_columns"] = array( 
		"section" => "ecommerce_upsells",
		"name" => __('Up-Sells Columns Per Row', 'primathemes'),
		"id" => "shop_upsells_columns",
		"desc" => null,
		"default" => '3',
		"type" => "select",
		"options" => array ( '1'=>'1', '2'=>'2', '3'=>'3', '4'=>'4', '5'=>'5', '6'=>'6' ),
		);
	return $settings;
}

/**
 * Add Cross-Sells Settings section of Footer tab for Theme Settings page.
 *
 * @since PrimaShop 1.0
 */
add_filter( 'prima_theme_settings_args', 'prima_theme_settings_args_ecommerce_crosssells' );
function prima_theme_settings_args_ecommerce_crosssells( $settings ) {
	$settings["section_ecommerce_crosssells"] = array( 
		"tab" => "ecommerce",
		"type" => "section",
		"name" => __('Cross-Sells Settings', 'primathemes'),
		"id" => "ecommerce_crosssells",
		);
	$settings["ecommerce_crosssells_info"] = array( 
		"section" => "ecommerce_crosssells",
		"name" => __('Info', 'primathemes'),
		"id" => "ecommerce_crosssells_info",
		"desc" => __('Cross-sells are products which you promote in the cart, based on the current product. You can edit cross sells when editing your products.', 'primathemes'),
		"default" => "",
		"type" => "info",
		);
	$settings["shop_crosssells_hide"] = array( 
		"section" => "ecommerce_crosssells",
		"name" => __('Cross-Sells', 'primathemes'),
		"id" => "shop_crosssells_hide",
		"desc" => __('Hide cross-sells products on cart page', 'primathemes'),
		"default" => false,
		"type" => "checkbox",
		);
	$settings["shop_crosssells_perpage"] = array( 
		"section" => "ecommerce_crosssells",
		"name" => __('Number of Cross-Sells Products', 'primathemes'),
		"id" => "shop_crosssells_perpage",
		"desc" => null,
		"default" => '2',
		"type" => "select",
		"options" => array ( '1'=>'1', '2'=>'2', '3'=>'3', '4'=>'4', '5'=>'5', '6'=>'6' ),
		);
	return $settings;
}

/**
 * Add Fonts tab for Theme Settings page.
 *
 * @since PrimaShop 1.0
 */
add_filter( 'prima_theme_settings_args', 'prima_theme_settings_args_fonts_tab' );
function prima_theme_settings_args_fonts_tab( $settings ) {
	$settings["tab_fonts"] = array( 
		"name" => __('Fonts', 'primathemes'),
		"id" => "fonts",
		"type" => "tab",
		);
	return $settings;
}

/**
 * Add Google Fonts Introduction section of Fonts tab for Theme Settings page.
 *
 * @since PrimaShop 1.0
 */
add_filter( 'prima_theme_settings_args', 'prima_theme_settings_args_fonts_intro' );
function prima_theme_settings_args_fonts_intro( $settings ) {
	$settings["section_fonts_intro"] = array( 
		"tab" => "fonts",
		"type" => "section",
		"name" => __('Google Fonts Introduction', 'primathemes'),
		"id" => "fonts_intro",
		);
	$settings["fonts_intro_info"] = array( 
		"section" => "fonts_intro",
		"name" => __('Introduction', 'primathemes'),
		"id" => "fonts_intro_info",
		"desc" => __('We do not include 600+ Google fonts on this theme. Please check the impact of the Google font on your website page load time because using some Google font styles can slow down your webpage. Please only select the font styles that you actually need on your webpage.', 'primathemes').'<br/><br/><a href="ht'.'tp://www.google.com/fonts/" target="_blank">'.__('Visit Google Fonts page', 'primathemes').'</a><br/><br/><img src="'.trailingslashit(PRIMA_CUSTOM_URI).'theme/images/googlefonts.gif">',
		"default" => "",
		"type" => "info",
		);
	return $settings;
}

/**
 * Add Google Fonts #1 section of Fonts tab for Theme Settings page.
 *
 * @since PrimaShop 1.0
 */
add_filter( 'prima_theme_settings_args', 'prima_theme_settings_args_fonts_1' );
function prima_theme_settings_args_fonts_1( $settings ) {
	$settings["section_fonts_1"] = array( 
		"tab" => "fonts",
		"type" => "section",
		"name" => __('Google Fonts #1', 'primathemes'),
		"id" => "fonts_1",
		);
	$settings["fonts_1_name"] = array( 
		"section" => "fonts_1",
		"name" => __('Font Name', 'primathemes'),
		"id" => "fonts_1_name",
		"desc" => "",
		"default" => "Open Sans",
		"type" => "text",
		);
	$settings["fonts_1_url"] = array( 
		"section" => "fonts_1",
		"name" => __('Font Url', 'primathemes'),
		"id" => "fonts_1_url",
		"desc" => "",
		"default" => "http://fonts.googleapis.com/css?family=Open+Sans",
		"type" => "text",
		);    
	$settings["fonts_1_family"] = array( 
		"section" => "fonts_1",
		"name" => __('Font Family', 'primathemes'),
		"id" => "fonts_1_family",
		"desc" => '',
		"default" => "'Open Sans', sans-serif",
		"type" => "text",
		);    
	return $settings;
}

/**
 * Add Google Fonts #2 section of Fonts tab for Theme Settings page.
 *
 * @since PrimaShop 1.0
 */
add_filter( 'prima_theme_settings_args', 'prima_theme_settings_args_fonts_2' );
function prima_theme_settings_args_fonts_2( $settings ) {
	$settings["section_fonts_2"] = array( 
		"tab" => "fonts",
		"type" => "section",
		"name" => __('Google Fonts #2', 'primathemes'),
		"id" => "fonts_2",
		);
	$settings["fonts_2_name"] = array( 
		"section" => "fonts_2",
		"name" => __('Font Name', 'primathemes'),
		"id" => "fonts_2_name",
		"desc" => "",
		"default" => "Droid Sans",
		"type" => "text",
		);
	$settings["fonts_2_url"] = array( 
		"section" => "fonts_2",
		"name" => __('Font Url', 'primathemes'),
		"id" => "fonts_2_url",
		"desc" => "",
		"default" => "http://fonts.googleapis.com/css?family=Droid+Sans",
		"type" => "text",
		);    
	$settings["fonts_2_family"] = array( 
		"section" => "fonts_2",
		"name" => __('Font Family', 'primathemes'),
		"id" => "fonts_2_family",
		"desc" => '',
		"default" => "'Droid Sans', sans-serif",
		"type" => "text",
		);    
	return $settings;
}

/**
 * Add Google Fonts #3 section of Fonts tab for Theme Settings page.
 *
 * @since PrimaShop 1.0
 */
add_filter( 'prima_theme_settings_args', 'prima_theme_settings_args_fonts_3' );
function prima_theme_settings_args_fonts_3( $settings ) {
	$settings["section_fonts_3"] = array( 
		"tab" => "fonts",
		"type" => "section",
		"name" => __('Google Fonts #3', 'primathemes'),
		"id" => "fonts_3",
		);
	$settings["fonts_3_name"] = array( 
		"section" => "fonts_3",
		"name" => __('Font Name', 'primathemes'),
		"id" => "fonts_3_name",
		"desc" => "",
		"default" => "",
		"type" => "text",
		);
	$settings["fonts_3_url"] = array( 
		"section" => "fonts_3",
		"name" => __('Font Url', 'primathemes'),
		"id" => "fonts_3_url",
		"desc" => "",
		"default" => "",
		"type" => "text",
		);    
	$settings["fonts_3_family"] = array( 
		"section" => "fonts_3",
		"name" => __('Font Family', 'primathemes'),
		"id" => "fonts_3_family",
		"desc" => '',
		"default" => "",
		"type" => "text",
		);    
	return $settings;
}

/**
 * Add Google Fonts #4 section of Fonts tab for Theme Settings page.
 *
 * @since PrimaShop 1.0
 */
add_filter( 'prima_theme_settings_args', 'prima_theme_settings_args_fonts_4' );
function prima_theme_settings_args_fonts_4( $settings ) {
	$settings["section_fonts_4"] = array( 
		"tab" => "fonts",
		"type" => "section",
		"name" => __('Google Fonts #4', 'primathemes'),
		"id" => "fonts_4",
		);
	$settings["fonts_4_name"] = array( 
		"section" => "fonts_4",
		"name" => __('Font Name', 'primathemes'),
		"id" => "fonts_4_name",
		"desc" => "",
		"default" => "",
		"type" => "text",
		);
	$settings["fonts_4_url"] = array( 
		"section" => "fonts_4",
		"name" => __('Font Url', 'primathemes'),
		"id" => "fonts_4_url",
		"desc" => "",
		"default" => "",
		"type" => "text",
		);    
	$settings["fonts_4_family"] = array( 
		"section" => "fonts_4",
		"name" => __('Font Family', 'primathemes'),
		"id" => "fonts_4_family",
		"desc" => '',
		"default" => "",
		"type" => "text",
		);    
	return $settings;
}
