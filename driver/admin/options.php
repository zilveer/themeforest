<?php
/*
 *
 * Set the text domain for the theme or plugin.
 *
 */

define('Redux_TEXT_DOMAIN', IRON_TEXT_DOMAIN);

if ( ! defined('Redux_ASSETS_URL') ) {
	define('Redux_ASSETS_URL', IRON_PARENT_URL . '/admin/assets/');
}

if ( ! defined('Redux_OPTIONS_URL') ) {
	define('Redux_OPTIONS_URL', IRON_PARENT_URL . '/admin/options/');
}

if ( ! defined('Redux_OPTIONS_DIR') ) {
	define('Redux_OPTIONS_DIR', IRON_PARENT_DIR . '/admin/options/');
}

$redux_args = $redux_sections = $redux_tabs = array();


/*
 *
 * Require the framework class before doing anything else, so we can use the defined URLs and directories.
 * If you are running on Windows you may have URL problems which can be fixed by defining the framework url first.
 *
 */

if ( ! class_exists('Redux_Options') ) {
	require_once(Redux_OPTIONS_DIR . 'defaults.php');
}


/*
 * Load custom reduc assets
 *
 */

function redux_custom_assets() {

	wp_enqueue_script('redux-custom', Redux_ASSETS_URL.'js/redux.custom.js', array('jquery'), null, true);
}
add_action( 'admin_enqueue_scripts', 'redux_custom_assets' );



/*
 *
 * Most of your editing will be done in this section.
 *
 * Here you can override default values, uncomment args and change their values.
 * No $redux_args are required, but they can be over ridden if needed.
 *
 */

function setup_framework_options() {
	global $redux_args, $redux_sections, $wp_version, $wpdb;

	$use_dashicons = floatval($wp_version) >= 3.8;

	// Setting dev mode to true allows you to view the class settings/info in the panel.
	// Default: true
	$redux_args['dev_mode'] = false;

	// Set the icon for the dev mode tab.
	// If $redux_args['icon_type'] = 'image', this should be the path to the icon.
	// If $redux_args['icon_type'] = 'iconfont', this should be the icon name.
	// Default: info-sign
	//$redux_args['dev_mode_icon'] = 'info-sign';


	// The defaults are set so it will preserve the old behavior.
	$redux_args['std_show'] = true; // If true, it shows the std value


	// Set the class for the dev mode tab icon.
	// This is ignored unless $redux_args['icon_type'] = 'iconfont'
	// Default: null
	$redux_args['dev_mode_icon_class'] = 'fa-lg';

	// If you want to use Google Webfonts, you MUST define the api key.
	$redux_args['google_api_key'] = 'AIzaSyCQdHHTp_ttcRUygzBKIpwa6b8iiCJyjqo';

	// Define the starting tab for the option panel.
	// Default: '0';
	//$redux_args['last_tab'] = '0';

	// Define the option panel stylesheet. Options are 'standard', 'custom', and 'none'
	// If only minor tweaks are needed, set to 'custom' and override the necessary styles through the included custom.css stylesheet.
	// If replacing the stylesheet, set to 'none' and don't forget to enqueue another stylesheet!
	// Default: 'standard'
	$redux_args['admin_stylesheet'] = 'custom';

	// Add HTML before the form.
	//$redux_args['intro_text'] = __('<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', IRON_TEXT_DOMAIN);

	// Add content after the form.
	$redux_args['footer_text'] = __('<p>Brought to you by <a target="_blank" href="http://irontemplates.com">IronTemplates</a></p>', IRON_TEXT_DOMAIN);

	// Set footer/credit line.
	//$redux_args['footer_credit'] = __('<p>This text is displayed in the options panel footer across from the WordPress version (where it normally says \'Thank you for creating with WordPress\'). This field accepts all HTML.</p>', IRON_TEXT_DOMAIN);

	// Setup custom links in the footer for share icons
	$redux_args['share_icons']['twitter'] = array(
		'link' => 'http://twitter.com/irontemplates',
		'title' => __('Follow us on Twitter', IRON_TEXT_DOMAIN),
		'img' => Redux_OPTIONS_URL . 'img/social/Twitter.png'
	);

	// Enable the import/export feature.
	// Default: true
	//$redux_args['show_import_export'] = false;

	// Set the icon for the import/export tab.
	// If $redux_args['icon_type'] = 'image', this should be the path to the icon.
	// If $redux_args['icon_type'] = 'iconfont', this should be the icon name.
	// Default: refresh
	//$redux_args['import_icon'] = 'refresh';

	// Set the class for the import/export tab icon.
	// This is ignored unless $redux_args['icon_type'] = 'iconfont'
	// Default: null
	$redux_args['import_icon_class'] = 'fa-lg';

	// Set a custom option name. Don't forget to replace spaces with underscores!
	$redux_args['opt_name'] = IRON_TEXT_DOMAIN;

	// Set a custom menu icon.
	
	if($use_dashicons)
		$redux_args['menu_icon'] = 'dashicons-admin-generic';

	// Set a custom title for the options page.
	// Default: Options
	$redux_args['menu_title'] = __('DRIVER', IRON_TEXT_DOMAIN);

	// Set a custom page title for the options page.
	// Default: Options
	$redux_args['page_title'] = __('DRIVER Options', IRON_TEXT_DOMAIN);

	// Set a custom page slug for options page (wp-admin/themes.php?page=***).
	// Default: redux_options
	$redux_args['page_slug'] = 'iron_options';

	// Set a custom page capability.
	// Default: manage_options
	$redux_args['page_cap'] = 'manage_options';

	$currently_in_options = !empty($_GET["page"]) && ($_GET["page"] == $redux_args['page_slug']);
	    
	// Set the menu type. Set to "menu" for a top level menu, or "submenu" to add below an existing item.
	// Default: menu
	//$redux_args['page_type'] = 'submenu';

	// Set the parent menu.
	// Default: themes.php
	// A list of available parent menus is available at http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
	//$redux_args['page_parent'] = 'options-general.php';

	// Set a custom page location. This allows you to place your menu where you want in the menu order.
	// Must be unique or it will override other items!
	// Default: null
	//$redux_args['page_position'] = null;

	// Set a custom page icon class (used to override the page icon next to heading)
	//$redux_args['page_icon'] = 'icon-themes';

	// Set the icon type. Set to "iconfont" for Font Awesome, or "image" for traditional.
	// Redux no longer ships with standard icons!
	// Default: iconfont
	//$redux_args['icon_type'] = 'image';
	//$redux_args['dev_mode_icon_type'] = 'image';
	//$redux_args['import_icon_type'] == 'image';

	// Disable the panel sections showing as submenu items.
	// Default: true
	//$redux_args['allow_sub_menu'] = false;

	// Set ANY custom page help tabs, displayed using the new help tab API. Tabs are shown in order of definition.
/*
	$redux_args['help_tabs'][] = array(
		'id' => 'redux-opts-1',
		'title' => __('Theme Information 1', IRON_TEXT_DOMAIN),
		'content' => __('<p>This is the tab content, HTML is allowed.</p>', IRON_TEXT_DOMAIN)
	);
	$redux_args['help_tabs'][] = array(
		'id' => 'redux-opts-2',
		'title' => __('Theme Information 2', IRON_TEXT_DOMAIN),
		'content' => __('<p>This is the tab content, HTML is allowed.</p>', IRON_TEXT_DOMAIN)
	);

	// Set the help sidebar for the options page.
	$redux_args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', IRON_TEXT_DOMAIN);
*/


	if(file_exists(IRON_PARENT_DIR . '/admin/inc/docs.php')) {

		ob_start();
		include IRON_PARENT_DIR . '/admin/inc/docs.php';
		$docs = ob_get_contents();
		ob_end_clean();

		$redux_sections[] = array(
			// Redux uses the Font Awesome iconfont to supply its default icons.
			// If $redux_args['icon_type'] = 'iconfont', this should be the icon name minus 'icon-'.
			// If $redux_args['icon_type'] = 'image', this should be the path to the icon.
			// Icons can also be overridden on a section-by-section basis by defining 'icon_type' => 'image'
			'icon' => 'book',
			'icon_class' => 'fa-lg',
			'title' => __('Getting Started', IRON_TEXT_DOMAIN),
			'desc' => '',
			'fields' => array(
				array(
					'id' => 'font_awesome_info',
					'type' => 'raw_html',
					'html' => $docs
				)
			)
		);
	}

	if(file_exists(IRON_PARENT_DIR . '/admin/inc/import.php')) {

		ob_start();
		include IRON_PARENT_DIR . '/admin/inc/import.php';
		$importData = ob_get_contents();
		ob_end_clean();

		$redux_sections[] = array(
			'icon' => 'cloud-download',
			'icon_class' => 'fa-lg',
			'title' => __('Import Default Data', IRON_TEXT_DOMAIN),
			'desc' => '<p class="description">' . __('Here you can clone our theme demo contents.', IRON_TEXT_DOMAIN) . '</p>',
			'fields' => array(
				array(
					'id' => 'import_default_data',
					'type' => 'raw_html',
					'title' => __('Import Default Data', IRON_TEXT_DOMAIN),
					'sub_desc' => '<p class="description">' . __('This will flush all your current data and clone our theme demo contents.<br><font color="red">Please note that this could take up to 3 minutes.</font>', IRON_TEXT_DOMAIN) . '</p>',
					'html' => $importData
				)
			)
		);

	}

	$redux_sections[] = array(
		'icon' => 'cogs',
		'icon_class' => 'fa-lg',
		'title' => __('General Settings', IRON_TEXT_DOMAIN),
		'desc' => '<p class="description">' . __('These are some general settings that you can edit.', IRON_TEXT_DOMAIN) . '</p>',
		'fields' => array(
			
			array(
				'id' => 'enable_nice_scroll',
				'type' => 'checkbox',
				'title' => __('Enable NiceScroll', IRON_TEXT_DOMAIN),
				'sub_desc' => '<p class="description">' . __('This will style the default scrollbar and will add a nice scrolling effect', IRON_TEXT_DOMAIN) . '</p>',
				'switch' => true,
				'std' => '1'
			),
			array(
				'id' => 'default_event_show_time',
				'type' => 'checkbox',
				'title' => __('Show the time on new events', IRON_TEXT_DOMAIN),
				'sub_desc' => '<small><em>(' . __('This setting may be overridden for individual events.', IRON_TEXT_DOMAIN) . ')</em></small>',
				'switch' => true,
				'std' => '0'
			),	
			array(
				'id' => 'events_show_countdown_rollover',
				'type' => 'checkbox',
				'title' => __('Show countdown on rollover', IRON_TEXT_DOMAIN),
				'sub_desc' => '<small><em>(' . __('This setting may be overridden for individual events.', IRON_TEXT_DOMAIN) . ')</em></small>',
				'switch' => true,
				'std' => '1'
			),
			array(
				'id' => 'hide_admin_bar',
				'type' => 'checkbox',
				'title' => __('Hide admin bar on the frontend', IRON_TEXT_DOMAIN),
				'switch' => true,
				'std' => '1'
			),
			
			array(			
				'id' => 'custom_js',
				'type' => 'textarea',
				'title' => __('Custom Javascript', IRON_TEXT_DOMAIN),
				'sub_desc' => __('This is for advanced users.<br>The code will be executed within jQuery(document).ready($);', IRON_TEXT_DOMAIN),
				'rows' => '20',
				'std' => '',
			)		
		)
	);

	$redux_sections[] = array(
		'icon' => 'forward',
		'icon_class' => 'fa-lg',
		'title' => __('Pagination Settings', IRON_TEXT_DOMAIN),
		'desc' => '<p class="description">' . __('You can control settings related to the reading and navigation of posts.', IRON_TEXT_DOMAIN) . '</p><p>' . __('Enter the number of posts per page for each content type to be displayed within archive page templates.', IRON_TEXT_DOMAIN) . '<br>' . __('You can control the number of posts for the Posts content type on the <a href="options-reading.php">Reading Settings</a> page.', IRON_TEXT_DOMAIN) . '</p>',
		'fields' => array(

			array(
				'id' => 'events_per_page',
				'type' => 'text',
				'title' => __('Events listings show at most', IRON_TEXT_DOMAIN),
				'std' => 10
			),
			array(
				'id' => 'videos_per_page',
				'type' => 'text',
				'title' => __('Videos listings show at most', IRON_TEXT_DOMAIN),
				'std' => 10
			),
			array(
				'id' => 'photo-albums_per_page',
				'type' => 'text',
				'title' => __('Photo Albums listings show at most', IRON_TEXT_DOMAIN),
				'std' => 10
			),
			array(
				'id' => 'paginate_method',
				'type' => 'radio',
				'title' => __('Pagination Style', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Choose how to provide "paged" navigation of posts, categories, and archive pages.', IRON_TEXT_DOMAIN) . '<br>' . __('You can set how many posts to list on each page on the <a href="options-reading.php">Reading Settings</a> page.', IRON_TEXT_DOMAIN),
				'options' => array(
					'posts_nav_link' => __('Displays links for next and previous pages', IRON_TEXT_DOMAIN) . ' (' . sprintf( _x('e.g. : %s', 'Abbreviation of Latin exemplī grātiā (“for example”).', IRON_TEXT_DOMAIN), __('« Previous Page — Next Page »', IRON_TEXT_DOMAIN) ) . ')',
					'paginate_links' => __('Displays a row of paginated links', IRON_TEXT_DOMAIN) . ' (' . sprintf( _x('e.g. : %s', 'Abbreviation of Latin exemplī grātiā (“for example”).', IRON_TEXT_DOMAIN), __('« Prev 1 … 3 4 5 6 7 … 9 Next »', IRON_TEXT_DOMAIN) ) . ')',
					'paginate_more' => __('Displays a single link to dynamically load more items', IRON_TEXT_DOMAIN) . ' (' . sprintf( _x('e.g. : %s', 'Abbreviation of Latin exemplī grātiā (“for example”).', IRON_TEXT_DOMAIN), __('« More Posts »', IRON_TEXT_DOMAIN) ) . ')',
					'paginate_scroll' => __('Dynamically load more items as you scroll down (infinite scrolling)', IRON_TEXT_DOMAIN)
				),
				'std' => 'posts_nav_link'
			)
		)
	);

	
	/**
	 * Default sidebars also set in /includes/setup.php:iron_import_default_data()
	 */

	$redux_sections[] = array(
		'icon'       => 'th-large',
		'icon_class' => 'fa-lg',
		'title'      => _x('Widgets Areas', 'Theme Options', IRON_TEXT_DOMAIN),
		'desc'       => '<p class="description">' . _x('Manage your WordPress Widget Areas and additional settings related to page templates and widgets.', 'Theme Options', IRON_TEXT_DOMAIN) . '</p>',
		'fields'     => array(
			array(
				'id'       => 'widget_areas',
				'type'     => 'group',
				'title'    => _x('Widget Areas', 'Theme Options', IRON_TEXT_DOMAIN),
				'sub_desc' => _x('Manage dynamic sidebars for your widgets.', 'Theme Options', IRON_TEXT_DOMAIN),
				'std'      => array(
					IRON_SIDEBAR_PREFIX . '0' => array(
						'sidebar_name' => 'Default Blog Sidebar',
						'sidebar_desc' => _x('Sidebar widget area found on Blog post-related page templates.', 'Theme Options', IRON_TEXT_DOMAIN),
						'sidebar_grid' => 1,
						'order_no'     => 1
					),
					IRON_SIDEBAR_PREFIX . '1' => array(
						'sidebar_name' => 'Default Video Sidebar',
						'sidebar_desc' => _x('Sidebar widget area found on Video-related page templates.', 'Theme Options', IRON_TEXT_DOMAIN),
						'sidebar_grid' => 1,
						'order_no'     => 2
					),
					IRON_SIDEBAR_PREFIX . '2' => array(
						'sidebar_name' => 'Default Footer',
						'sidebar_desc' => _x('Site footer widget area.', 'Theme Options', IRON_TEXT_DOMAIN),
						'sidebar_grid' => 1,
						'order_no'     => 3
					)
				),
				'options' => array(
					'group' => array(
						'name'      => _x('Widget Area', 'Theme Options', IRON_TEXT_DOMAIN),
						'title_key' => 'sidebar_name'
					),
					'fields' => array(
						array(
							'id'    => 'sidebar_name',
							'type'  => 'text',
							'title' => _x('Sidebar name', 'Theme Options', IRON_TEXT_DOMAIN)
						),
						array(
							'id'    => 'sidebar_desc',
							'type'  => 'textarea',
							'title' => _x('Sidebar description (optional)', 'Theme Options', IRON_TEXT_DOMAIN)
						)
					)
				)
			),
			array(
				'id'    => 'single_post_default_sidebar',
				'type'  => 'widget_area_select',
				'title' => __('Single Post Default Sidebar', IRON_TEXT_DOMAIN),
				'std'   => 'driver_sidebar_0'
			),
			array(
				'id'    => 'single_video_default_sidebar',
				'type'  => 'widget_area_select',
				'title' => __('Single Video Default Sidebar', IRON_TEXT_DOMAIN),
				'std'   => 'driver_sidebar_1'
			),
			array(
				'id'    => 'single_event_default_sidebar',
				'type'  => 'widget_area_select',
				'title' => __('Single Event Default Sidebar', IRON_TEXT_DOMAIN),
				'std'   => ''
			),	
			array(
				'id'    => 'single_discography_default_sidebar',
				'type'  => 'widget_area_select',
				'title' => __('Single Discography Default Sidebar', IRON_TEXT_DOMAIN),
				'std'   => ''
			),	
			array(
				'id'    => 'single_photo_album_default_sidebar',
				'type'  => 'widget_area_select',
				'title' => __('Single Photo Album Default Sidebar', IRON_TEXT_DOMAIN),
				'std'   => ''
			),			
		)
	);

	$redux_sections[] = array(
		'icon' => 'eye',
		'icon_class' => 'fa-lg',
		'title' => __('Look and feel', IRON_TEXT_DOMAIN),
		'desc' => '<p class="description">' . __('These are some look & feel options that you can edit. These options will override the selected preset.', IRON_TEXT_DOMAIN) . '</p>',
		'fields' => array(

			array(
				'id' => 'featured_color',
				'type' => 'color',
				'title' => __('Featured Color', IRON_TEXT_DOMAIN),
				'class' => 'greybg',
				'std' => '#e80e50'
			),
			array(
				'id' => 'primary_color_light',
				'type' => 'color',
				'title' => __('Primary Color 1', IRON_TEXT_DOMAIN),
				'class' => 'greybg',
				'std' => '#ffffff'
			),
			array(
				'id' => 'primary_color_dark',
				'type' => 'color',
				'title' => __('Primary Color 2', IRON_TEXT_DOMAIN),
				'class' => 'greybg',
				'std' => '#f7f7f7'
			),
			array(
				'id' => 'secondary_color_light',
				'type' => 'color',
				'title' => __('Secondary Color 1', IRON_TEXT_DOMAIN),
				'class' => 'greybg',
				'std' => '#353535'
			),
			array(
				'id' => 'secondary_color_dark',
				'type' => 'color',
				'title' => __('Secondary Color 2', IRON_TEXT_DOMAIN),
				'class' => 'greybg',
				'std' => '#2e2e2e'
			),
			array(
				'id' => 'text_color_light',
				'type' => 'color',
				'title' => __('Text Color 1', IRON_TEXT_DOMAIN),
				'class' => 'greybg',
				'std' => '#ffffff'
			),
			array(
				'id' => 'text_color_dark',
				'type' => 'color',
				'title' => __('Text Color 2', IRON_TEXT_DOMAIN),
				'class' => 'greybg',
				'std' => '#353535'
			),
	
			array(
				'id' => 'body_background',
				'type' => 'background',
				'title' => __('Body Background', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Body background options / Upload a custom background image', IRON_TEXT_DOMAIN),
				'class' => 'greybg',
				'hide' => array('attachment'),
				'std' => array(
					'color' => '#ffffff'
				)
			),
			array(
				'id' => 'content_background',
				'type' => 'background',
				'title' => __('Content Background', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Content background options / Upload a custom background image', IRON_TEXT_DOMAIN),
				'class' => 'greybg',
				'hide' => array('attachment'),
				'std' => array(
					'color' => '#ffffff'
				)			
			),	

			array(
				'id'    => 'page_title_divider_image',
				'type'  => 'upload',
				'title' => __('Page Title Divider Image', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Upload a custom divider', IRON_TEXT_DOMAIN),
				'std' => '',
				'class' => 'greybg'
			),
			array(
				'id'    => 'page_title_divider_color',
				'type'  => 'color',
				'title' => __('Page Title Divider Color', IRON_TEXT_DOMAIN),
				'std' => '#000000',
				'class' => 'greybg'
			),	
			array(
				'id'    => 'page_title_divider_margin_top',
				'type'  => 'text',
				'title' => __('Page Title Divider Margin Top', IRON_TEXT_DOMAIN),
				'sub_desc' => __('In Pixels', IRON_TEXT_DOMAIN),
				'std' => '',
			),	
			array(
				'id'    => 'page_title_divider_margin_bottom',
				'type'  => 'text',
				'title' => __('Page Title Divider Margin Bottom', IRON_TEXT_DOMAIN),
				'sub_desc' => __('In Pixels', IRON_TEXT_DOMAIN),
				'std' => '',
			),
			

			array(
				'id'    => 'widget_title_divider_image',
				'type'  => 'upload',
				'title' => __('Widget Title Divider Image', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Upload a custom divider', IRON_TEXT_DOMAIN),
				'std' => '',
				'class' => 'greybg'
			),
			array(
				'id'    => 'widget_title_divider_color',
				'type'  => 'color',
				'title' => __('Widget Title Divider Color', IRON_TEXT_DOMAIN),
				'std' => '#000000',
				'class' => 'greybg'
			),	
			array(
				'id'    => 'widget_title_divider_margin_top',
				'type'  => 'text',
				'title' => __('Widget Title Divider Margin Top', IRON_TEXT_DOMAIN),
				'sub_desc' => __('In Pixels', IRON_TEXT_DOMAIN),
				'std' => '',
			),	
			array(
				'id'    => 'widget_title_divider_margin_bottom',
				'type'  => 'text',
				'title' => __('Widget Title Divider Margin Bottom', IRON_TEXT_DOMAIN),
				'sub_desc' => __('In Pixels', IRON_TEXT_DOMAIN),
				'std' => '',
			),		
			

			array(
				'id' => 'custom_css',
				'type' => 'textarea',
				'title' => __('Custom CSS', IRON_TEXT_DOMAIN),
				'sub_desc' => __('This is for advanced users', IRON_TEXT_DOMAIN),
				'rows' => '20',
				'std' => ''
			),
	
						
		)
	);

	$redux_sections[] = array(
		'icon' => 'edit',
		'icon_class' => 'fa-lg',
		'title' => __('Typography', IRON_TEXT_DOMAIN),
		'desc' => '<p class="description">' . __('These are some typography options that you can edit. These options will override the selected preset.', IRON_TEXT_DOMAIN) . '</p>',
		'fields' => array(

			array(
				'id' => 'body_typography',
				'type' => 'typography',
				'title' => __('Body Typography', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Choose a font, font size and color', IRON_TEXT_DOMAIN),
				'std' => array()
			),
			array(
				'id' => 'call_to_action_typography',
				'type' => 'typography',
				'title' => __('Widget Call To Action Button Typography', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Choose a font, font size and color', IRON_TEXT_DOMAIN),
				'std' => ''
			),
			array(
				'id' => 'h1_typography',
				'type' => 'typography',
				'title' => __('Heading 1 Typography', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Choose a font, font size and color', IRON_TEXT_DOMAIN),
				'std' => array(
					'font' => "Open+Sans:600",
					'font_readable' => "Open Sans",
				)
			),
			array(
				'id' => 'h2_typography',
				'type' => 'typography',
				'title' => __('Heading 2 Typography', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Choose a font, font size and color', IRON_TEXT_DOMAIN),
				'std' => array(
					'font_readable' => "Open Sans",
					'font' => "Open+Sans:300",
					'weight' => '300'
				)
			),
			array(
				'id' => 'h3_typography',
				'type' => 'typography',
				'title' => __('Heading 3 Typography', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Choose a font, font size and color', IRON_TEXT_DOMAIN),
				'std' => array(
					'font_readable' => "Open Sans",
					'font' => "Open+Sans:300",
					'weight' => '300'
				)
			),
			array(
				'id' => 'h4_typography',
				'type' => 'typography',
				'title' => __('Heading 4 Typography', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Choose a font, font size and color', IRON_TEXT_DOMAIN),
				'std' => ''
			),
			array(
				'id' => 'h5_typography',
				'type' => 'typography',
				'title' => __('Heading 5 Typography', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Choose a font, font size and color', IRON_TEXT_DOMAIN),
				'std' => ''
			),
			array(
				'id' => 'h6_typography',
				'type' => 'typography',
				'title' => __('Heading 6 Typography', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Choose a font, font size and color', IRON_TEXT_DOMAIN),
				'std' => ''
			),
		)
	);

	$redux_sections[] = array(
		'icon' => 'chevron-up',
		'icon_class' => 'fa-lg',
		'title' => __('Header Options', IRON_TEXT_DOMAIN),
		'desc' => '<p class="description">' . __('These are some header options that you can edit.', IRON_TEXT_DOMAIN) . '</p>',
		'fields' => array(
			array(
				'id' => 'header_logo',
				'type' => 'upload',
				'title' => __('Header Logo', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Upload your logo', IRON_TEXT_DOMAIN),
				'std' => get_template_directory_uri().'/images/logo.png',
				'class' => 'greybg'
			),
			array(
				'id' => 'retina_header_logo',
				'type' => 'upload',
				'title' => __('Retina Header Logo', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Upload your retina logo (2x)', IRON_TEXT_DOMAIN),
				'std' => get_iron_option('header_logo'),
				'class' => 'greybg'
			),

			array(
				'id' => 'header_menu_toggle_enabled',
				'type' => 'radio',
				'title' => __('Display Main Menu Icon', IRON_TEXT_DOMAIN),
				'options' => array(
					'1' => __('Show', IRON_TEXT_DOMAIN),
					'2' => __('Show on mobile only', IRON_TEXT_DOMAIN),
					'0' => __('Hide', IRON_TEXT_DOMAIN),
				),
				'std' => '1'
			),
						
		)
	);

	
	$redux_sections[] = array(
		'icon' => 'chevron-down',
		'icon_class' => 'fa-lg',
		'title' => __('Footer Options', IRON_TEXT_DOMAIN),
		'desc' => '<p class="description">' . __('These are some footer options that you can edit.', IRON_TEXT_DOMAIN) . '</p>',
		'fields' => array(
			array(
				'id' => 1,
				'type' => 'info',
				'desc' => '<h4 class="title">' . __('Site Footer', IRON_TEXT_DOMAIN) . '</h4>'
			),
			array(
				'id'    => 'footer-area_id',
				'type'  => 'widget_area_select',
				'title' => __('Widget Area', IRON_TEXT_DOMAIN),
				'std'   => 'driver_sidebar_2'
			),
			array(
				'id' => 'footer_social_media_enabled',
				'type' => 'checkbox',
				'title' => __('Footer Social Media Enabled', IRON_TEXT_DOMAIN),
				'switch' => true,
				'std' => '1'
			),
			array(
				'id' => 'footer_back_to_top_enabled',
				'type' => 'checkbox',
				'title' => __('Back To Top Button', IRON_TEXT_DOMAIN),
				'switch' => true,
				'std' => '1'
			),			
			array(
				'id' => 3,
				'type' => 'info',
				'desc' => '<h4 class="title">' . __('Copyright & Notices', IRON_TEXT_DOMAIN) . '</h4>'
			),
			array(
				'id' => 'footer_bottom_logo',
				'type' => 'upload',
				'title' => __('Bottom Logo', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Upload a mini logo that will appear on the bottom. Could be a partner or a record label, for example.', IRON_TEXT_DOMAIN),
				'desc' => 'Maximum Size : 200 &times; 100 px',
				'std' => get_template_directory_uri().'/images/logo-irontemplates-footer.png',
				'class' => 'greybg'
			),
			array(
				'id' => 'footer_bottom_link',
				'type' => 'text',
				'title' => __('Bottom Logo URL', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Add a URL to the mini logo that will appear on the bottom. The link opens in a new window.', IRON_TEXT_DOMAIN),
				'std' => 'http://irontemplates.com/'
			),
			array(
				'id' => 'footer_copyright',
				'type' => 'editor',
				'title' => __('Footer Copyright Text', IRON_TEXT_DOMAIN),
				'sub_desc' => __('This is a little space under the field title which can be used for additonal info.', IRON_TEXT_DOMAIN),
				'std' => 'Copyright &copy; '.date('Y').' Iron Templates<br>All rights reserved'
			),
		)
	);



	$redux_sections[] = array(
		'icon' => 'bars',
		'icon_class' => 'fa-lg',
		'title' => __('Menu Options', IRON_TEXT_DOMAIN),
		'desc' => '<p class="description">' . __('These are some main menu options that you can edit.', IRON_TEXT_DOMAIN) . '</p>',
		'fields' => array(
			array(
				'id' => 'menu_type',
				'type' => 'select_hide_below',
				'title' => __('Menu Type', IRON_TEXT_DOMAIN),
				'options' => array(
					'push-menu' => __('Push Menu', IRON_TEXT_DOMAIN),
					'classic-menu' => __('Classic Menu', IRON_TEXT_DOMAIN),
				),
				'std' => 'push-menu'
			),
			
			
			// PUSH MENU
			array(
				'id' => 'enable_fixed_header',
				'class' => 'push-menu',
				'type' => 'checkbox',
				'title' => __('Enable Fixed Header', IRON_TEXT_DOMAIN),
				'sub_desc' => '<p class="description">' . __('This will make the header fixed on page scroll', IRON_TEXT_DOMAIN) . '</p>',
				'switch' => true,
				'std' => '1'
			),			
			array(
				'id' => 'menu_position',
				'type' => 'radio',
				'class' => 'push-menu',
				'title' => __('Menu Position', IRON_TEXT_DOMAIN),
				'options' => array(
					'lefttype' => __('Left', IRON_TEXT_DOMAIN),
					'righttype' => __('Right', IRON_TEXT_DOMAIN)
				),
				'std' => 'righttype'
			),	
			array(
				'id' => 'menu_transition',
				'class' => 'push-menu',
				'type' => 'radio',
				'title' => __('Menu Transition', IRON_TEXT_DOMAIN),
				'options' => array(
					'type1' => __('Push', IRON_TEXT_DOMAIN),
					'type2' => __('Rotate Pusher', IRON_TEXT_DOMAIN),
					'type3' => __('Scale & Rotate Pusher', IRON_TEXT_DOMAIN)
				),
				'std' => 'type1'
			),
			
			array(
				'id' => 'menu_logo',
				'class' => 'push-menu',
				'type' => 'upload',
				'title' => __('Menu Logo', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Upload your menu logo', IRON_TEXT_DOMAIN),
				'std' => get_template_directory_uri().'/images/menu-logo.png',
			),
			array(
				'id' => 'retina_menu_logo',
				'class' => 'push-menu',
				'type' => 'upload',
				'title' => __('Menu Retina Logo', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Upload your mobile version logo (2x)', IRON_TEXT_DOMAIN),
				'std' => get_iron_option('menu_logo'),
			),
							
			array(
				'id' => 'menu_background',
				'class' => 'push-menu',
				'type' => 'background',
				'title' => __('Menu Background', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Menu background options / Upload a custom background image', IRON_TEXT_DOMAIN),
				'hide' => array('size', 'attachment'),
				'std' => array(
					'color' => '#353535'
				)	
			),

			array(
				'id' => 'menu_open_icon_color',
				'class' => 'push-menu',
				'type' => 'color',
				'title' => __('Menu Open Icon Color', IRON_TEXT_DOMAIN),
				'std' => '#353535'
			),	
			array(
				'id' => 'menu_close_icon_color',
				'class' => 'push-menu',
				'type' => 'color',
				'title' => __('Menu Close Icon Color', IRON_TEXT_DOMAIN),
				'std' => '#ffffff'
			),	
			array(
				'id' => 'menu_typography',
				'class' => 'push-menu',
				'type' => 'typography',
				'title' => __('Menu Typography', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Choose a font, font size and color', IRON_TEXT_DOMAIN),
				'std' => array()
			),	
			array(
				'id' => 'menu_margin',
				'class' => 'push-menu',
				'type' => 'text',
				'title' => __('Menu Item Margin (px)', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Set a menu item margin', IRON_TEXT_DOMAIN),
				'std' => '0'
			),
			
			
			
			
			// CLASSIC MENU


			// GENERAL
			array(
				'id' => 'classic_menu_general_settings',
				'class' => 'classic-menu',
				'type' => 'info',
				'desc' => '<br><h4 class="title">' . __('General Options', IRON_TEXT_DOMAIN) . '</h4>'
			),
						
			array(
				'id' => 'classic_menu_width',
				'class' => 'classic-menu',
				'type' => 'radio',
				'title' => __('Menu Width', IRON_TEXT_DOMAIN),
				'options' => array(
					'fullwidth' => __('Full Width', IRON_TEXT_DOMAIN),
					'incontainer' => __('In Container', IRON_TEXT_DOMAIN)
				),
				'std' => 'fullwidth'
			),
						
			array(
				'id' => 'classic_menu_align',
				'class' => 'classic-menu',
				'type' => 'radio',
				'title' => __('Items Alignment', IRON_TEXT_DOMAIN),
				'options' => array(
					'pull-left' => __('Left', IRON_TEXT_DOMAIN),
					'pull-right' => __('Right', IRON_TEXT_DOMAIN),
					'pull-center' => __('Center', IRON_TEXT_DOMAIN)
				),
				'std' => 'pull-center'
			),

			array(
				'id' => 'classic_menu_position',
				'class' => 'classic-menu',
				'type' => 'select_hide_below',
				'title' => __('Menu Position', IRON_TEXT_DOMAIN),
				'options' => array(
					'absolute absolute_before' => __('Not Fixed', IRON_TEXT_DOMAIN),
					'fixed fixed_before' => __('Fixed', IRON_TEXT_DOMAIN),
				),
				'std' => 'absolute absolute_before'
			),
			
			array(
				'id' => 'classic_menu_effect',
				'class' => 'classic-menu',
				'type' => 'radio',
				'title' => __('Menu Effect On Scroll', IRON_TEXT_DOMAIN),
				'options' => array(
					'reset' => __('Default', IRON_TEXT_DOMAIN),
					'mini-active' => __('Mini', IRON_TEXT_DOMAIN),
					'mini-fullwidth-active' => __('Mini + Full Width', IRON_TEXT_DOMAIN),
				),
				'std' => 'reset'
			),
			array(
				'id' => 'header_logo_mini',
				'class' => 'classic-menu',
				'type' => 'upload',
				'title' => __('Header Logo On Mini', IRON_TEXT_DOMAIN),
				'sub_desc' => __('This will override default logo', IRON_TEXT_DOMAIN),
				'std' => '',
				'class' => 'greybg'
			),
			
			// LOGO
			array(
				'id' => 'classic_menu_logo_settings',
				'class' => 'classic-menu',
				'type' => 'info',
				'desc' => '<br><h4 class="title">' . __('Logo Options', IRON_TEXT_DOMAIN) . '</h4>'
			),

			array(
				'id' => 'classic_menu_logo_align',
				'class' => 'classic-menu',
				'type' => 'radio',
				'title' => __('Logo Alignment', IRON_TEXT_DOMAIN),
				'options' => array(
					'pull-left' => __('Left', IRON_TEXT_DOMAIN),
					'pull-right' => __('Right', IRON_TEXT_DOMAIN),
					'pull-center' => __('Center', IRON_TEXT_DOMAIN),
					'pull-top' => __('Center & Above items', IRON_TEXT_DOMAIN)
				),
				'std' => 'pull-center'
			),
			
			array(
				'id' => 'classic_menu_logo_padding_left',
				'class' => 'classic-menu',
				'type' => 'text',
				'title' => __('Menu Logo Padding Left (px)', IRON_TEXT_DOMAIN),
				'std' => '0px'
			),
			array(
				'id' => 'classic_menu_logo_padding_top',
				'class' => 'classic-menu',
				'type' => 'text',
				'title' => __('Menu Logo Padding Top (px)', IRON_TEXT_DOMAIN),
				'std' => '0px'
			),
			array(
				'id' => 'classic_menu_logo_padding_right',
				'class' => 'classic-menu',
				'type' => 'text',
				'title' => __('Menu Logo Padding Right (px)', IRON_TEXT_DOMAIN),
				'std' => '0px'
			),
			array(
				'id' => 'classic_menu_logo_padding_bottom',
				'class' => 'classic-menu',
				'type' => 'text',
				'title' => __('Menu Logo Padding Bottom (px)', IRON_TEXT_DOMAIN),
				'std' => '0px'
			),
			

			// CONTAINER
			array(
				'id' => 'classic_menu_container_settings',
				'class' => 'classic-menu',
				'type' => 'info',
				'desc' => '<br><h4 class="title">' . __('Menu Container', IRON_TEXT_DOMAIN) . '</h4>'
			),

			array(
				'id' => 'classic_menu_background',
				'class' => 'classic-menu',
				'type' => 'color',
				'title' => __('Menu Background', IRON_TEXT_DOMAIN),
				'std' => ''
			),
			array(
				'id' => 'classic_menu_background_mini',
				'class' => 'classic-menu',
				'type' => 'color',
				'title' => __('Menu Background When "On Scroll Mini" is activated', IRON_TEXT_DOMAIN),
				'std' => ''
			),

			array(
				'id' => 'classic_menu_inner_background',
				'class' => 'classic-menu',
				'type' => 'color',
				'title' => __('Menu Inner Background', IRON_TEXT_DOMAIN),
				'std' => ''
			),
				
									
			array(
				'id' => 'classic_menu_hmargin',
				'class' => 'classic-menu',
				'type' => 'text',
				'title' => __('Menu Container Horizontal Margin (px)', IRON_TEXT_DOMAIN),
				'std' => '0px'
			),
			array(
				'id' => 'classic_menu_top_margin',
				'class' => 'classic-menu',
				'type' => 'text',
				'title' => __('Menu Container Top Margin (px)', IRON_TEXT_DOMAIN),
				'std' => '8px'
			),
			array(
				'id' => 'classic_menu_bottom_margin',
				'class' => 'classic-menu',
				'type' => 'text',
				'title' => __('Menu Container Bottom Margin (px)', IRON_TEXT_DOMAIN),
				'std' => '8px'
			),

			array(
				'id' => 'classic_menu_hpadding',
				'class' => 'classic-menu',
				'type' => 'text',
				'title' => __('Menu Container Horizontal Padding (px)', IRON_TEXT_DOMAIN),
				'std' => '0px'
			),
			array(
				'id' => 'classic_menu_vpadding',
				'class' => 'classic-menu',
				'type' => 'text',
				'title' => __('Menu Container Vertical Padding (px)', IRON_TEXT_DOMAIN),
				'std' => '8px'
			),

			// ITEMS		
			
			array(
				'id' => 'classic_menu_item_settings',
				'class' => 'classic-menu',
				'type' => 'info',
				'desc' => '<br><h4 class="title">' . __('Items', IRON_TEXT_DOMAIN) . '</h4>'
			),
										
			array(
				'id' => 'classic_menu_item_hmargin',
				'class' => 'classic-menu',
				'type' => 'text',
				'title' => __('Menu Item Horizontal Margin (px)', IRON_TEXT_DOMAIN),
				'std' => '0px'
			),
			array(
				'id' => 'classic_menu_item_vmargin',
				'class' => 'classic-menu',
				'type' => 'text',
				'title' => __('Menu Item Vertical Margin (px)', IRON_TEXT_DOMAIN),
				'std' => '8px'
			),
			
			array(
				'id' => 'classic_menu_item_hpadding',
				'class' => 'classic-menu',
				'type' => 'text',
				'title' => __('Menu Item Horizontal Padding (px)', IRON_TEXT_DOMAIN),
				'std' => '6px'
			),
			array(
				'id' => 'classic_menu_item_vpadding',
				'class' => 'classic-menu',
				'type' => 'text',
				'title' => __('Menu Item Vertical Padding (px)', IRON_TEXT_DOMAIN),
				'std' => '15px'
			),

			

			array(
				'id' => 'classic_menu_letter_spacing',
				'class' => 'classic-menu',
				'type' => 'text',
				'title' => __('Menu Item Letter Spacing (px)', IRON_TEXT_DOMAIN),
				'std' => '1px'
			),				
			array(
				'id' => 'classic_menu_typography',
				'class' => 'classic-menu',
				'type' => 'typography',
				'title' => __('Main Item Typography', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Choose a font, font size and color', IRON_TEXT_DOMAIN),
				'std' => array()
			),		
			array(
				'id' => 'classic_menu_hover_bg_color',
				'class' => 'classic-menu',
				'type' => 'color',
				'title' => __('Main Item Hover Background Color', IRON_TEXT_DOMAIN),
				'std' => '#000'
			),
			array(
				'id' => 'classic_menu_hover_text_color',
				'class' => 'classic-menu',
				'type' => 'color',
				'title' => __('Main Item Hover Text Color', IRON_TEXT_DOMAIN),
				'std' => '#fff'
			),
			array(
				'id' => 'classic_menu_active_bg_color',
				'class' => 'classic-menu',
				'type' => 'color',
				'title' => __('Main Item Active Background Color', IRON_TEXT_DOMAIN),
				'std' => '#e80e50'
			),
			array(
				'id' => 'classic_menu_active_text_color',
				'class' => 'classic-menu',
				'type' => 'color',
				'title' => __('Main Item Active Text Color', IRON_TEXT_DOMAIN),
				'std' => '#fff'
			),
			
			
			// SUB ITEMS

			array(
				'id' => 'classic_menu_sub_item_settings',
				'class' => 'classic-menu',
				'type' => 'info',
				'desc' => '<br><h4 class="title">' . __('Sub Items', IRON_TEXT_DOMAIN) . '</h4>'
			),
						
			array(
				'id' => 'classic_sub_menu_typography',
				'class' => 'classic-menu',
				'type' => 'typography',
				'title' => __('Sub Item Typography', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Choose a font, font size and color', IRON_TEXT_DOMAIN),
				'std' => array(
					'color' => '#fff',
					'bgcolor' => 'rgba(0,0,0,0.7)'
				)
			),
			array(
				'id' => 'classic_sub_menu_hover_bg_color',
				'class' => 'classic-menu',
				'type' => 'color',
				'title' => __('Sub Item Hover Background Color', IRON_TEXT_DOMAIN),
				'std' => '#000'
			),
			array(
				'id' => 'classic_sub_menu_hover_text_color',
				'class' => 'classic-menu',
				'type' => 'color',
				'title' => __('Sub Item Hover Text Color', IRON_TEXT_DOMAIN),
				'std' => '#fff'
			),
			array(
				'id' => 'classic_sub_menu_active_bg_color',
				'class' => 'classic-menu',
				'type' => 'color',
				'title' => __('Sub Item Active Background Color', IRON_TEXT_DOMAIN),
				'std' => '#e80e50'
			),
			array(
				'id' => 'classic_sub_menu_active_text_color',
				'class' => 'classic-menu',
				'type' => 'color',
				'title' => __('Sub Item Active Text Color', IRON_TEXT_DOMAIN),
				'std' => '#fff'
			),
			
			
			
			
			// HOT LINKS
			
			array(
				'id' => 'classic_menu_hotlinks_settings',
				'class' => 'classic-menu push-menu',
				'type' => 'info',
				'desc' => '<br><h4 class="title">' . __('Hot Links', IRON_TEXT_DOMAIN) . '</h4>'
			),
			
			array(
				'id' => 'header_top_menu_enabled',
				'class' => 'classic-menu push-menu',
				'type' => 'checkbox',
				'title' => __('Hot Links', IRON_TEXT_DOMAIN),
				'switch' => true,
				'std' => '0'
			),	
			array(
				'id' => 'header_top_menu_hide_on_scroll',
				'class' => 'push-menu',
				'type' => 'checkbox',
				'title' => __('Hot Links Hide on scroll', IRON_TEXT_DOMAIN),
				'switch' => true,
				'std' => '1'
			),			
			array(
				'id'       => 'header_top_menu',
				'class' => 'classic-menu push-menu',
				'type'     => 'group',
				'title'    => _x('Hot Links Items', 'Theme Options', IRON_TEXT_DOMAIN),
				'std'      => array(
					0 => array(
						'menu_page_name' => '',
						'menu_page_is_menu' => '',
						'menu_page_url' => '',
						'pages_select' => '',
						'menu_page_external_url' => '',
						'menu_page_icon' => '',
						'order_no'     => 1
					),
				),
				'options' => array(
					'group' => array(
						'name'      => _x('Hot Links', 'Theme Options', IRON_TEXT_DOMAIN),
						'title_key' => 'menu_page_name'
					),
					'fields' => array(
						array(
							'id'    => 'menu_page_name',
							'type'  => 'text',
							'title' => _x('Hot Link Label', 'Theme Options', IRON_TEXT_DOMAIN)
						),
						array(
							'id'    => 'menu_hide_page_title',
							'type'  => 'checkbox',
							'title' => _x('Hide Label & Keep Icon Only', 'Theme Options', IRON_TEXT_DOMAIN),
							'sub_desc'=> '',
						),
						array(
							'id'    => 'menu_page_is_menu',
							'type'  => 'checkbox',
							'title' => _x('Is menu toggle', 'Theme Options', IRON_TEXT_DOMAIN),
							'sub_desc'=> '',
						),
						array(
							'id'    => 'menu_page_url',
							'type'  => 'pages_select',
							'title' => _x('Page URL', 'Theme Options', IRON_TEXT_DOMAIN),
							'sub_desc'=> '',
						),
						array(
							'id'    => 'menu_page_external_url',
							'type'  => 'text',
							'title' => _x('Page URL (External)', 'Theme Options', IRON_TEXT_DOMAIN),
							'sub_desc'=> '',
						),	
						array(
							'id'    => 'menu_page_url_target',
							'type'  => 'select',
							'title' => _x('Page URL Target)', 'Theme Options', IRON_TEXT_DOMAIN),
							'options' => array(
								'_self' => 'Same Window',
								'_blank' => 'New Window'
							),
							'sub_desc'=> '',
						),						
						array(
							'id'    => 'menu_page_icon',
							'type'  => 'fontawesome',
							'title' => _x('Page URL Icon Class', 'Theme Options', IRON_TEXT_DOMAIN)
						)
					)
				)
			),
			array(
				'id' => 'header_top_menu_background',
				'class' => 'push-menu',
				'type' => 'color',
				'title' => __('Hot Links Background', IRON_TEXT_DOMAIN),
				'std' => '#ffffff'
			),
			array(
				'id' => 'header_top_menu_typography',
				'class' => 'push-menu',
				'type' => 'typography',
				'title' => __('Hot Links Typography', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Choose a font, font size and color', IRON_TEXT_DOMAIN),
				'std' => ''
			),


																	
		)
	);
	
			
	$redux_sections[] = array(
		'icon' => 'file-o',
		'icon_class' => 'fa-lg',
		'title' => __('Posts Settings', IRON_TEXT_DOMAIN),
		'desc' => '<p class="description">' . __('These are some post options that you can edit.', IRON_TEXT_DOMAIN) . '</p>',
		'fields'     => array(
		
			array(
				'id' => 'post_archive_default_template',
				'type' => 'radio',
				'title' => __('Posts Archive Default Template', IRON_TEXT_DOMAIN),
				'options' => array(
					'index' => __('Blog List', IRON_TEXT_DOMAIN),
					'archive-posts-grid' => __('Blog Posts (Grid 2-Columns)', IRON_TEXT_DOMAIN),
					'archive-posts-grid3' => __('Blog Posts (Grid 3-Columns)', IRON_TEXT_DOMAIN),
					'archive-posts-grid4' => __('Blog Posts (Grid 4-Columns)', IRON_TEXT_DOMAIN)
				),
				'std' => 'index'
			),	
			array(
				'id' => 'single_post_featured_image',
				'type' => 'radio',
				'title' => __('Single Post Featured Image', IRON_TEXT_DOMAIN),
				'options' => array(
					'fullwidth' => __('Full Width', IRON_TEXT_DOMAIN),
					'original' => __('Original', IRON_TEXT_DOMAIN),
					'none' => __('None', IRON_TEXT_DOMAIN)
				),
				'std' => 'fullwidth'
			),	
			array(
				'id' => 'show_post_date',
				'type' => 'checkbox',
				'title' => __('Show post date in post archive and single posts', IRON_TEXT_DOMAIN),
				'switch' => true,
				'std' => '1'
			),
			array(
				'id' => 'show_post_author',
				'type' => 'checkbox',
				'title' => __('Show post author in single posts', IRON_TEXT_DOMAIN),
				'switch' => true,
				'std' => '1'
			),
			array(
				'id' => 'show_post_categories',
				'type' => 'checkbox',
				'title' => __('Show post categories in single posts', IRON_TEXT_DOMAIN),
				'switch' => true,
				'std' => '1'
			),	
			array(
				'id' => 'show_post_tags',
				'type' => 'checkbox',
				'title' => __('Show post tags in single posts', IRON_TEXT_DOMAIN),
				'switch' => true,
				'std' => '1'
			),
			array(
				'id' => 'single_post_settings',
				'type' => 'info',
				'desc' => '<br><h4 class="title">' . __('Single Posts Page Titles', IRON_TEXT_DOMAIN) . '</h4>'
			),
			array(
				'id' => 'single_post_page_title',
				'type' => 'text',
				'title' => __('Single Post Page Title', IRON_TEXT_DOMAIN),
				'std' => 'News'
			),
			array(
				'id' => 'single_event_page_title',
				'type' => 'text',
				'title' => __('Single Event Page Title', IRON_TEXT_DOMAIN),
				'std' => 'Events'
			),
			array(
				'id' => 'single_video_page_title',
				'type' => 'text',
				'title' => __('Single Video Page Title', IRON_TEXT_DOMAIN),
				'std' => 'Videos'
			),
			array(
				'id' => 'single_album_page_title',
				'type' => 'text',
				'title' => __('Single Discography Page Title', IRON_TEXT_DOMAIN),
				'std' => 'Discographies'
			),
			array(
				'id' => 'single_shop_page_title',
				'type' => 'text',
				'title' => __('Single Shop Page Title', IRON_TEXT_DOMAIN),
				'std' => 'Shop'
			),
		)
	);
				
			
	$redux_sections[] = array(
		'icon' => 'picture-o',
		'icon_class' => 'fa-lg',
		'title' => __('Photos Settings', IRON_TEXT_DOMAIN),
		'desc' => '<p class="description">' . __('Here you can set multiple photo sizes for the dynamic photo galleries.', IRON_TEXT_DOMAIN) . '</p>',
		'fields'     => array(
					
			array(
				'id'       => 'photo_sizes',
				'type'     => 'group',
				'title'    => _x('Photo Sizes', 'Theme Options', IRON_TEXT_DOMAIN),
				'sub_desc' => _x('Add / update photo sizes.', 'Theme Options', IRON_TEXT_DOMAIN),
				'std'      => array(
					0 => array(
						'size_name' => __('Small Square', IRON_TEXT_DOMAIN),
						'size_width' => 150,
						'size_height' => 150,
						'order_no'     => 1
					),
					1 => array(
						'size_name' => __('Small Portrait', IRON_TEXT_DOMAIN),
						'size_width' => 150,
						'size_height' => 300,
						'order_no'     => 1
					),
					2 => array(
						'size_name' => __('Small Landscape', IRON_TEXT_DOMAIN),
						'size_width' => 300,
						'size_height' => 150,
						'order_no'     => 1
					),
					3 => array(
						'size_name' => __('Medium Square', IRON_TEXT_DOMAIN),
						'size_width' => 300,
						'size_height' => 300,
						'order_no'     => 1
					),
					4 => array(
						'size_name' => __('Medium Portrait', IRON_TEXT_DOMAIN),
						'size_width' => 300,
						'size_height' => 600,
						'order_no'     => 1
					),
					5 => array(
						'size_name' => __('Medium Landscape', IRON_TEXT_DOMAIN),
						'size_width' => 600,
						'size_height' => 300,
						'order_no'     => 1
					),
					6 => array(
						'size_name' => __('Large Square', IRON_TEXT_DOMAIN),
						'size_width' => 450,
						'size_height' => 450,
						'order_no'     => 1
					),
					7 => array(
						'size_name' => __('Large Portrait', IRON_TEXT_DOMAIN),
						'size_width' => 450,
						'size_height' => 800,
						'order_no'     => 1
					),
					8 => array(
						'size_name' => __('Large Landscape', IRON_TEXT_DOMAIN),
						'size_width' => 800,
						'size_height' => 450,
						'order_no'     => 1
					),
				),
				
				'options' => array(
					'group' => array(
						'name'      => _x('Photo Sizes', 'Theme Options', IRON_TEXT_DOMAIN),
						'title_key' => 'size_name'
					),
					'fields' => array(
						array(
							'id'    => 'size_name',
							'type'  => 'text',
							'title' => _x('Size Name', 'Theme Options', IRON_TEXT_DOMAIN)
						),
						array(
							'id'    => 'size_width',
							'type'  => 'text',
							'title' => _x('Width', 'Theme Options', IRON_TEXT_DOMAIN)
						),
						array(
							'id'    => 'size_height',
							'type'  => 'text',
							'title' => _x('Height', 'Theme Options', IRON_TEXT_DOMAIN)
						)
					)
				)
			),
			array(
				'id' => 'lightbox-transition',
				'type' => 'select',
				'title' => __('Light Box Transition', IRON_TEXT_DOMAIN),
				'options' => array(
					'fade' => 'Fade',
					'elastic' => 'Elastic'
				),
				'std' => 'fade'
			),
		)
	);
	

	$redux_sections[] = array(
		'icon' => 'archive',
		'icon_class' => 'fa-lg',
		'title' => __('Portfolio Settings', IRON_TEXT_DOMAIN),
		'desc' => '<p class="description">' . __('Here you can set multiple photo sizes for the dynamic photo galleries.', IRON_TEXT_DOMAIN) . '</p>',
		'fields'     => array(
			array(
				'id' => 'portfolio_archive_page',
				'type' => 'pages_select',
				'title' => __('Portfolio Archive Page', IRON_TEXT_DOMAIN),
				'std' => ''
			),
			array(
				'id' => 'portfolio_slider_autoplay',
				'type' => 'checkbox',
				'title' => __('Slider: Auto Play', IRON_TEXT_DOMAIN),
				'switch' => true,
				'std' => '0'
			),	
			array(
				'id' => 'portfolio_slider_stop_hover',
				'type' => 'checkbox',
				'title' => __('Slider: Stop On Hover', IRON_TEXT_DOMAIN),
				'switch' => true,
				'std' => '1'
			),	
			array(
				'id' => 'portfolio_slider_arrows',
				'type' => 'checkbox',
				'title' => __('Slider: Show Arrows', IRON_TEXT_DOMAIN),
				'switch' => true,
				'std' => '1'
			),	
			array(
				'id' => 'portfolio_slider_slide_speed',
				'type' => 'text',
				'title' => __('Slider: Slide Speed  (ms)', IRON_TEXT_DOMAIN),
				'std' => 500
			),
			array(
				'id' => 'portfolio_slider_slide_speed',
				'type' => 'text',
				'title' => __('Slider: Pagination Speed (ms)', IRON_TEXT_DOMAIN),
				'std' => 1000
			),
		)
	);
						
							
	$redux_sections[] = array(
		'icon' => 'facebook',
		'icon_class' => 'fa-lg',
		'title' => __('Social Media', IRON_TEXT_DOMAIN),
		'desc' => '<p class="description">' . __('Here are some social settings that you can edit.', IRON_TEXT_DOMAIN) . '</p>',
		'fields'     => array(
			array(
				'id' => 'facebook_appid',
				'type' => 'text',
				'title' => __('Facebook App ID', IRON_TEXT_DOMAIN),
				'sub_desc' => __('When you <a target="_blank" href="https://developers.facebook.com/setup/">register your website as an app</a>, you can get detailed analytics about the demographics of your users and how users are sharing from your website with <a target="_blank" href="https://www.facebook.com/insights/">Insights</a>.', IRON_TEXT_DOMAIN),
				'std' => ''
			),
			array(
				'id' => 'custom_social_actions',
				'type' => 'textarea',
				'title' => __('Custom Social Buttons', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Add your favorite drop-in bookmarking and social link-sharing scripts.<br /><br />e.g., <a target="_blank" href="//sharethis.com/">ShareThis</a>, <a target="_blank" href="//www.addthis.com/">AddThis</a>', IRON_TEXT_DOMAIN),
				'rows' => '20',
				'std' => '
<!-- AddThis Button BEGIN -->
<div class="addthis_toolbox addthis_default_style ">
	<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
	<a class="addthis_button_tweet"></a>
	<a class="addthis_button_pinterest_pinit"></a>
	<a class="addthis_counter addthis_pill_style"></a>
</div>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js"></script>
<!-- AddThis Button END -->
'
			),					
			array(
				'id'       => 'social_icons',
				'type'     => 'group',
				'title'    => _x('Social Icons', 'Theme Options', IRON_TEXT_DOMAIN),
				'sub_desc' => _x('Add / update social media icons.', 'Theme Options', IRON_TEXT_DOMAIN),
				'std'      => array(
					0 => array(
						'social_media_name' => __('Facebook', IRON_TEXT_DOMAIN),
						'social_media_url' => 'https://facebook.com/envato',
						'social_media_icon_class' => 'facebook',
						'social_media_icon_url' => '',
						'order_no'     => 1
					),
					1 => array(
						'social_media_name' => __('Twitter', IRON_TEXT_DOMAIN),
						'social_media_url' => 'https://twitter.com/envato',
						'social_media_icon_class' => 'twitter',
						'social_media_icon_url' => '',
						'order_no'     => 1
					),
				),
				'options' => array(
					'group' => array(
						'name'      => _x('Social Media', 'Theme Options', IRON_TEXT_DOMAIN),
						'title_key' => 'social_media_name'
					),
					'fields' => array(
						array(
							'id'    => 'social_media_name',
							'type'  => 'text',
							'title' => _x('Social Media Name', 'Theme Options', IRON_TEXT_DOMAIN)
						),
						array(
							'id'    => 'social_media_url',
							'type'  => 'text',
							'title' => _x('Social Media URL', 'Theme Options', IRON_TEXT_DOMAIN),
							'sub_desc'=> 'Ex: http://www.facebook.com/IronTemplates<br>',
						),
						array(
							'id'    => 'social_media_icon_class',
							'type'  => 'fontawesome',
							'title' => _x('Social Media Icon Class', 'Theme Options', IRON_TEXT_DOMAIN)
						),
						array(
							'id'    => 'social_media_icon_url',
							'type'  => 'upload',
							'title' => _x('Social Media Icon Image', 'Theme Options', IRON_TEXT_DOMAIN)
						)
					)
				)
			)
		)
	);
		


	$redux_sections[] = array(
		'icon' => 'code',
		'icon_class' => 'fa-lg',
		'title' => __('Fav Icons & Metadata', IRON_TEXT_DOMAIN),
		'desc' => '<p class="description">' . __('These are some metadata options that you can edit, including favicons and a short title for mobile home screens.<br>You can use this online tool to easily generate your favicons. <a href="http://iconifier.net" target="_blank" />http://iconifier.net/</a>', IRON_TEXT_DOMAIN) . '</p>',
		'fields' => array(
			array(
				'id' => 'meta_favicon',
				'type' => 'upload',
				'title' => __('Favicon', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Upload your shortcut icon', IRON_TEXT_DOMAIN),
				'std' => get_template_directory_uri().'/images/icons/favicon.ico',
				'desc' => 'Icon Size: 32px &times; 32px',
				'class' => 'greybg'
			),
			array(
				'id' => 'meta_apple_touch_icon',
				'type' => 'upload',
				'title' => __('Apple Touch Icon (57×57)', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Upload your shortcut icon', IRON_TEXT_DOMAIN),
				'std' => get_template_directory_uri().'/images/icons/apple-touch-icon-57x57-precomposed.png',
				'desc' => 'Precomposed. Icon Size: 57px &times; 57px. For iPhone 3GS, 2011 iPod Touch and older Android devices.',
				'class' => 'greybg'
			),
			array(
				'id' => 'meta_apple_touch_icon_72x72',
				'type' => 'upload',
				'title' => __('Apple Touch Icon (72×72)', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Upload your shortcut icon', IRON_TEXT_DOMAIN),
				'std' => get_template_directory_uri().'/images/icons/apple-touch-icon-72x72-precomposed.png',
				'desc' => 'Precomposed. Icon Size: 72px &times; 72px. For 1st generation iPad, iPad 2 and iPad mini.',
				'class' => 'greybg'
			),
			array(
				'id' => 'meta_apple_touch_icon_114x114',
				'type' => 'upload',
				'title' => __('Apple Touch Icon (114×114)', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Upload your shortcut icon', IRON_TEXT_DOMAIN),
				'std' => get_template_directory_uri().'/images/icons/apple-touch-icon-114x114-precomposed.png',
				'desc' => 'Precomposed. Icon Size: 114px &times; 114px. For iPhone 4, 4S, 5 and 2012 iPod Touch.',
				'class' => 'greybg'
			),
			array(
				'id' => 'meta_apple_touch_icon_144x144',
				'type' => 'upload',
				'title' => __('Apple Touch Icon (144×144)', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Upload your shortcut icon', IRON_TEXT_DOMAIN),
				'std' => get_template_directory_uri().'/images/icons/apple-touch-icon-144x144-precomposed.png',
				'desc' => 'Precomposed. Icon Size: 144px &times; 144px. For iPad 3rd and 4th generation.',
				'class' => 'greybg'
			),
			array(
				'id' => 'meta_apple_mobile_web_app_title',
				'type' => 'text',
				'title' => __('Apple Mobile Web App Title', IRON_TEXT_DOMAIN),
				'desc' => '<br><br>Sets a different title for an iOS Home Screen icon. By default, Mobile Safari crops document titles to 13 characters.',
				'std' => ''
			),
		)
	);

		
	$redux_sections[] = array(
		'icon' => 'exclamation-triangle',
		'icon_class' => 'fa-lg',
		'title' => __('404 Error', IRON_TEXT_DOMAIN),
		'desc' => '<p class="description">' . __('Here you can edit the 404 error page content.', IRON_TEXT_DOMAIN) . '</p>',
		'fields' => array(
			array(
				'id' => '404_page_title',
				'type' => 'text',
				'title' => __('Page Title', IRON_TEXT_DOMAIN),
				'std' => 'Page not found'
			),
			array(
				'id' => '404_page_content',
				'type' => 'editor',
				'wpautop' => false,
				'title' => __('Page Content', IRON_TEXT_DOMAIN),
				'std' => '<p style="text-align: center;">Are you lost? The content you were looking for is not here.</p><p style="text-align: center;"><a href="'.home_url('/').'">Return to home page</a></p>'
			)
		)
	);
	
	
	
	if (function_exists('is_plugin_active') && is_plugin_active('woocommerce/woocommerce.php')) {

		$redux_sections[] = array(
			'icon' => 'shopping-cart ',
			'icon_class' => 'fa-lg',
			'title' => __('WooCommerce', IRON_TEXT_DOMAIN),
			'desc' => '<p class="description">' . __('Here are some WooCommerce settings that you can edit.', IRON_TEXT_DOMAIN) . '</p>',
			'fields' => array(
				array(
					'id' => 'woo_backgrounds',
					'type' => 'checkbox',
					'title' => __('Enable WooCommerce Backgrounds', IRON_TEXT_DOMAIN),
					'sub_desc' => __('This will add a background to product items and descriptions.<br><b>Primary Color 2</b> will be used for the background.', IRON_TEXT_DOMAIN),
					'switch' => true,
					'std' => '0'
				),
			)
		);
		
	}	

		
	if($redux_args['dev_mode']) {

		$redux_sections[] = array(
			'icon' => 'cog',
			'icon_class' => 'fa-lg',
			'title' => __('Developer Settings', IRON_TEXT_DOMAIN),
			'desc' => '<p class="description">' . __('Here are some developer settings that you can edit.', IRON_TEXT_DOMAIN) . '</p>',
			'fields' => array(
				array(
					'id' => 'acf_lite',
					'type' => 'checkbox',
					'title' => __('Enable ACF LITE Mode', IRON_TEXT_DOMAIN),
					'sub_desc' => __('<br>By default, ACF (Advanced Custom Fields) is running in LITE mode. <br>If you which to add your own custom fields using the ACF Admin Interface, you can turn off this option. <br><br><b>NB:</b><br> When ACF LITE is on, custom fields are loaded from the custom-fields.php file found in /includes/ <br>For more info on using ACF, visit <a target="_blank" href="http://www.advancedcustomfields.com/">www.advancedcustomfields.com</a>', IRON_TEXT_DOMAIN),
					'switch' => true,
					'std' => '1' // 1 = checked | 0 = unchecked
				)
			)
		);
	}



	$redux_tabs = array();

	if (function_exists('wp_get_theme')){

		$theme_data = wp_get_theme();
		$item_uri = $theme_data->get('ThemeURI');
		$name = $theme_data->get('Name');
		$description = $theme_data->get('Description');
		$author = $theme_data->get('Author');
		$author_uri = $theme_data->get('AuthorURI');
		$version = $theme_data->get('Version');
		$tags = $theme_data->get('Tags');


		$item_info = '<div class="redux-opts-section-desc">';
		$item_info .= '<p class="redux-opts-item-data description item-description"><h4>' . $name . '</h4>' . $description . '</p>';
		$item_info .= '<p class="redux-opts-item-data description item-uri">' . __('<strong>Theme URL:</strong> ', IRON_TEXT_DOMAIN) . '<a href="' . $item_uri . '" target="_blank">' . $item_uri . '</a></p>';
		$item_info .= '<p class="redux-opts-item-data description item-author">' . __('<strong>Author:</strong> ', IRON_TEXT_DOMAIN) . ($author_uri ? '<a href="' . $author_uri . '" target="_blank">' . $author . '</a>' : $author) . '</p>';
		$item_info .= '<p class="redux-opts-item-data description item-version">' . __('<strong>Version:</strong> ', IRON_TEXT_DOMAIN) . $version . '</p>';
		$item_info .= '<p class="redux-opts-item-data description item-tags">' . __('<strong>Tags:</strong> ', IRON_TEXT_DOMAIN) . implode(', ', $tags) . '</p>';
		$item_info .= '</div>';

		$redux_tabs['item_info'] = array(
			'icon' => 'info',
			'icon_class' => 'fa-lg',
			'title' => __('Theme Information', IRON_TEXT_DOMAIN),
			'content' => $item_info
		);

	}

	global $Redux_Options;
	$Redux_Options = new Redux_Options($redux_sections, $redux_args, $redux_tabs);

}

add_action('init', 'setup_framework_options');

/*
 *
 * Get Theme Option by ID
 *
 * Optinal Params:
 * $key, if value is an array get by array key
 */

function get_iron_option($id, $key = null, $default = null) {
	global $Redux_Options;

	if ( method_exists($Redux_Options, 'get') )
		$value = $Redux_Options->get($id, $default);

	else {
		global $redux_args, $redux_sections, $iron_option;

		if ( empty($iron_option) )
			$options = get_option(IRON_TEXT_DOMAIN);
		else
			$options = $iron_option;

		$options_defaults = null;

		if ( isset($options[$id]) )
			$value = $options[$id];

		else {
			if ( !empty($redux_args['std_show']) )
			{
				if ( is_null($options_defaults) ) // fill the cache
				{
					if( ! is_null($redux_sections) && is_null($options_defaults) )
					{
						foreach ( $redux_sections as $section )
						{
							if ( isset($section['fields']) ) {
								foreach ( $section['fields'] as $field ) {
									if ( isset($field['std']) )
										$options_defaults[ $field['id'] ] = $field['std'];
								}
							}
						}
					}
				}

				$default = array_key_exists($id, $options_defaults) ? $options_defaults[$id] : $default;
			}

			$value = $default;
		}
	}

	if ( $key && is_array($value) && isset($value[$key]) )
		$value = $value[$key];

	return $value;
}

/*
 *
 * Get Theme Options Array
 *
 */

function get_iron_options() {

	global $Redux_Options;
	return $Redux_Options->options;
}

/*
 *
 * Set Theme Option by ID
 *
 * Optinal Params:
 * $key, if value is an array get by array key
 */

function set_iron_option($id, $value = null) {
	global $Redux_Options;

	if ( null === $value )
		$value = $Redux_Options->_get_std($id);

	$Redux_Options->set($id, $value);
}

/*
 *
 * Reset Theme Option by ID
 *
 * Optinal Params:
 * $key, if value is an array get by array key
 */

function reset_iron_option($id) {
	global $Redux_Options;
	$value = $Redux_Options->_get_std($id);

	$Redux_Options->set($id, $value);
}

/*
 *
 * Get Theme Presets Array
 *
 */

function get_iron_presets() {

	$files = scandir(Redux_OPTIONS_DIR.'/presets');
	$presets = array();

	foreach($files as $file) {
		$ext = pathinfo($file, PATHINFO_EXTENSION);
		$id = str_replace(".".$ext, "", $file);
		$filename = ucFirst($id);

		if($ext == 'png' ) {
			$presets[$id] = array('title' => $filename, 'img' => Redux_OPTIONS_URL.'/presets/'.$file);
		}
	}

	return $presets;
}


function iron_page_for_content_update ( $option ) {

	set_transient(IRON_TEXT_DOMAIN . '_flush_rules', true);

}

add_action('update_option_' . IRON_TEXT_DOMAIN, 'iron_page_for_content_update', 10, 1);