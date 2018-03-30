<?php
/*
 *
 * Require the framework class before doing anything else, so we can use the defined URLs and directories.
 * If you are running on Windows you may have URL problems which can be fixed by defining the framework url first.
 *
 */
//define('Redux_OPTIONS_URL', site_url('path the options folder'));
if(!class_exists('Redux_Options')){
    require_once(dirname(__FILE__) . '/options/defaults.php');
}

/*
 *
 * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
 * Simply include this function in the child themes functions.php file.
 *
 * NOTE: the defined constansts for URLs, and directories will NOT be available at this point in a child theme,
 * so you must use get_template_directory_uri() if you want to use any of the built in icons
 *
 */
function add_another_section($sections) {
    //$sections = array();
    $sections[] = array(
        'title' => __('A Section added by hook', 'swift-framework-admin'),
        'desc' => __('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'swift-framework-admin'),
        // Redux ships with the glyphicons free icon pack, included in the options folder.
        // Feel free to use them, add your own icons, or leave this blank for the default.
        'icon' => trailingslashit(get_template_directory_uri()) . 'options/img/icons/glyphicons_062_attach.png',
        // Leave this as a blank section, no options just some intro text set above.
        'fields' => array()
    );

    return $sections;
}
//add_filter('redux-opts-sections-twenty_eleven', 'add_another_section');


/*
 * 
 * Custom function for filtering the args array given by a theme, good for child themes to override or add to the args array.
 *
 */
function change_framework_args($args){
    //$args['dev_mode'] = false;
    
    return $args;
}
//add_filter('redux-opts-args-twenty_eleven', 'change_framework_args');


/*
 *
 * Most of your editing will be done in this section.
 *
 * Here you can override default values, uncomment args and change their values.
 * No $args are required, but they can be over ridden if needed.
 *
 */
function setup_framework_options(){
    $args = array();

    // Setting dev mode to true allows you to view the class settings/info in the panel.
    // Default: false
    $args['dev_mode'] = false;

    // If you want to use Google Webfonts, you MUST define the api key.
    $args['google_api_key'] = 'AIzaSyCWA2ZOS0NolFoVBu1iMwij_oWy4L2AJYY';

    // Define the starting tab for the option panel.
    // Default: '0';
    //$args['last_tab'] = '0';

    // Define the option panel stylesheet. Options are 'standard', 'custom', and 'none'
    // If only minor tweaks are needed, set to 'custom' and override the necessary styles through the included custom.css stylesheet.
    // If replacing the stylesheet, set to 'none' and don't forget to enqueue another stylesheet!
    // Default: 'standard'
    $args['admin_stylesheet'] = 'custom';

    // Add HTML before the form.
    //$args['intro_text'] = __('<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'swift-framework-admin');

    // Add content after the form.
    //$args['footer_text'] = __('<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', 'swift-framework-admin');

    // Set footer/credit line.
    //$args['footer_credit'] = __('<p>This text is displayed in the options panel footer across from the WordPress version (where it normally says \'Thank you for creating with WordPress\'). This field accepts all HTML.</p>', 'swift-framework-admin');

    // Setup custom links in the footer for share icons
//    $args['share_icons']['twitter'] = array(
//        'link' => 'http://twitter.com/swiftideas',
//        'title' => 'Follow us on Twitter', 
//        'img' => Redux_OPTIONS_URL . 'img/social/Twitter.png'
//    );

    // Enable the import/export feature.
    // Default: true
    //$args['show_import_export'] = false;

    // Set a custom option name. Don't forget to replace spaces with underscores!
    $args['opt_name'] = 'sf_dante_options';

    // Set a custom menu icon.
    // Redux ships with the glyphicons free icon pack, included in the options folder.
    // Feel free to use them, add your own icons, or leave this blank for the default.
    //$args['menu_icon'] = '';

    // Set a custom title for the options page.
    // Default: Options
    $args['menu_title'] = __('Theme Options', 'swift-framework-admin');

    // Set a custom page title for the options page.
    // Default: Options
    $args['page_title'] = __('Theme Options', 'swift-framework-admin');
	
	// Set the class for the import/export tab icon.
	$args['import_icon_type'] = 'iconfont';
	$args['import_icon_class'] = 'fa-lg';

	// Set the class for the dev mode tab icon.	
	$args['dev_mode_icon_type'] = 'iconfont';
	
    // Set a custom page slug for options page (wp-admin/themes.php?page=***).
    // Default: redux_options
    $args['page_slug'] = 'sf_theme_options';

    // Set a custom page capability.
    // Default: manage_options
    //$args['page_cap'] = 'manage_options';

    // Set the menu type. Set to "menu" for a top level menu, or "submenu" to add below an existing item.
    // Default: menu
    //$args['page_type'] = 'submenu';

    // Set the parent menu.
    // Default: themes.php
    // A list of available parent menus is available at http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
    //$args['page_parent'] = 'options_general.php';

    // Set a custom page location. This allows you to place your menu where you want in the menu order.
    // Must be unique or it will override other items!
    // Default: null
    $args['page_position'] = 61;

    // Set a custom page icon class (used to override the page icon next to heading)
    //$args['page_icon'] = 'icon-themes';

    // Disable the panel sections showing as submenu items.
    // Default: true
    //$args['allow_sub_menu'] = false;
        
    // Set ANY custom page help tabs, displayed using the new help tab API. Tabs are shown in order of definition.
    $args['help_tabs'][] = array(
        'id' => 'redux-opts-1',
        'title' => __('Theme Information 1', 'swift-framework-admin'),
        'content' => __('<p>This is the tab content, HTML is allowed.</p>', 'swift-framework-admin')
    );
    $args['help_tabs'][] = array(
        'id' => 'redux-opts-2',
        'title' => __('Theme Information 2', 'swift-framework-admin'),
        'content' => __('<p>This is the tab content, HTML is allowed.</p>', 'swift-framework-admin')
    );

    // Set the help sidebar for the options page.                                        
    $args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', 'swift-framework-admin');
	
	$args['bg_image_path'] = get_template_directory_uri() . '/images/preset-backgrounds/'; // change this to where you store your bg images
	
	// Portfolio Background Images Reader
	$body_bg_images_path = get_stylesheet_directory() . '/images/preset-backgrounds/'; // change this to where you store your bg images
	$body_bg_images_url = get_template_directory_uri() .'/images/preset-backgrounds/'; // change this to where you store your bg images
	$body_bg_images = array();
	
	if ( is_dir($body_bg_images_path) ) {
	    if ($body_bg_images_dir = opendir($body_bg_images_path) ) { 
	        while ( ($body_bg_images_file = readdir($body_bg_images_dir)) !== false ) {
	            if(stristr($body_bg_images_file, ".png") !== false || stristr($body_bg_images_file, ".jpg") !== false) {
	                $body_bg_images[] = $body_bg_images_url . $body_bg_images_file;
	            }
	        }    
	    }
	}
	
    $sections = array();
    				
    $sections[] = array(
    				'icon' => 'cog',
    				'icon_class' => 'fa-lg',
    				'title' => __('General Options', 'swift-framework-admin'),
    				'desc' => __('<p class="description">These are the general options for the theme</p>', 'swift-framework-admin'),
    				'fields' => array(	
    					array(
    						'id' => 'enable_maintenance',
    						'type' => 'button_set',
    						'title' => __('Enable Maintenance', 'swift-framework-admin'), 
    						'sub_desc' => __('Enable the themes maintenance mode.', 'swift-framework-admin'),
    						'desc' => '',
    						'options' => array('2' => 'On (Custom Page)', '1' => 'On (Standard)','0' => 'Off',),
    						'std' => '0'
    						),
    					array(
    						'id' => 'maintenance_mode_page',
    						'type' => 'pages_select',
    						'title' => __('Custom Maintenance Mode Page', 'swift-framework-admin'), 
    						'sub_desc' => __('Select the page that is your maintenance page, if you would like to show a custom page instead of the standard WordPress message. You should use the Holding Page template for this page.', 'swift-framework-admin'),
    						'desc' => '',
    						'std' => '',
    						'args' => array()
    						),
    					array(
    						'id' => 'disable_spb',
    						'type' => 'button_set',
    						'title' => __('Disable Swift Page Builder', 'swift-framework-admin'), 
    						'sub_desc' => __('Enable this option to disable the Swift Page Builder within the theme.', 'swift-framework-admin'),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '0'
    						),
    					array(
    						'id' => 'enable_responsive',
    						'type' => 'button_set',
    						'title' => __('Enable Responsive', 'swift-framework-admin'), 
    						'sub_desc' => __('Enable/Disable the responsive behaviour of the theme', 'swift-framework-admin'),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '1'
    						),
    					array(
    						'id' => 'site_maxwidth',
    						'type' => 'button_set',
    						'title' => __('Site Max-Width', 'swift-framework-admin'), 
    						'sub_desc' => __("Set the maximum width for the site, at it's largest. By default this is 1170px.", 'swift-framework-admin'),
    						'desc' => '',
    						'options' => array('1170' => '1170px', '940' => '940px'),
    						'std' => '1170'
    						),
    					array(
    						'id' => 'page_layout',
    						'type' => 'radio_img',
    						'title' => __('Page Layout', 'swift-framework-admin'), 
    						'sub_desc' => __('Select the page layout type', 'swift-framework-admin'),
    						'desc' => '',
    						'options' => array(
    										'boxed' => array('title' => 'Boxed', 'img' => Redux_OPTIONS_URL.'img/page-bordered.png'),
    										'fullwidth' => array('title' => 'Full Width', 'img' => Redux_OPTIONS_URL.'img/page-fullwidth.png')
    											),
    						'std' => 'fullwidth'
    						),
    					array(
    					    'id'       => 'sidebar_width',
    					    'type'     => 'button_set',
    					    'title'    => __( 'Sidebar Width', 'swift-framework-admin' ),
    					    'sub_desc' => __( "Set the ratio of the sidebar's width on a page/post.", 'swift-framework-admin' ),
    					    'desc'     => '',
    					    'options'  => array( 'standard' => 'Standard (1/3)', 'reduced' => 'Reduced (1/4)' ),
    					    'std'  => 'standard'
    					),
    					array(
    						'id' => 'enable_page_shadow',
    						'type' => 'button_set',
    						'title' => __('Page shadow (boxed layout only)', 'swift-framework-admin'), 
    						'sub_desc' => __('Enable the shadow for the boxed layout', 'swift-framework-admin'),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '1'
    						),
    					array(
    						'id' => 'enable_backtotop',
    						'type' => 'button_set',
    						'title' => __('Enable Back To Top', 'swift-framework-admin'), 
    						'sub_desc' => __('Enable the back to top button that appears in the bottom right corner of the screen.', 'swift-framework-admin'),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '1'
    						),
    					array(
    						'id' => 'enable_stickysidebars',
    						'type' => 'button_set',
    						'title' => __('Enable Sticky Sidebars', 'swift-framework-admin'), 
    						'sub_desc' => __('Enable the sidebars to be sticky on desktop when the sidebar is small enough to display completely while scrolling.', 'swift-framework-admin'),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '0'
    						),
    					array(
    						'id' => 'disable_loveit',
    						'type' => 'button_set',
    						'title' => __('Disable Love It', 'swift-framework-admin'), 
    						'sub_desc' => __('Enable this option to disable the love it functionality within the theme.', 'swift-framework-admin'),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '0'
    						),
    					array(
    						'id' => 'disable_sfgallery',
    						'type' => 'button_set',
    						'title' => __('Disable Gallery Shortcode Override', 'swift-framework-admin'), 
    						'sub_desc' => __('If you enable this option, then our WordPress gallery shortcode override will be disabled.', 'swift-framework-admin'),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '0'
    						),
    					array(
    						'id' => 'disable_megamenu',
    						'type' => 'button_set',
    						'title' => __('Disable Mega Menu Functionality', 'swift-framework-admin'), 
    						'sub_desc' => __("If you enable this option, then the theme's Mega Menu functionality will be disabled.", 'swift-framework-admin'),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '0'
    						),
    					array(
    						'id' => 'disable_pagecomments',
    						'type' => 'button_set',
    						'title' => __('Disable Page Comments', 'swift-framework-admin'), 
    						'sub_desc' => __('If you enable this option, then page comments will be disabled globally.', 'swift-framework-admin'),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '0'
    						),
    					array(
    						'id' => 'same_category_navigation',
    						'type' => 'button_set',
    						'title' => __('Same Category Navigation', 'swift-framework-admin'), 
    						'sub_desc' => __('If you enable this option, then pagination on single article pages will only go between same category items. This is for all post types.', 'swift-framework-admin'),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '0'
    						),
    					array(
    						'id' => 'custom_favicon',
    						'type' => 'upload',
    						'title' => __('Custom favicon', 'swift-framework-admin'), 
    						'sub_desc' => __('Upload a 16px x 16px Png/Gif image that will represent your website favicon', 'swift-framework-admin'),
    						'desc' => ''
    						),
    					array(
    						'id' => 'custom_ios_title',
    						'type' => 'text',
    						'title' => __('Custom iOS Bookmark Title', 'swift-framework-admin'),
    						'sub_desc' => __('Enter a custom title for your site for when it is added as an iOS bookmark.', 'swift-framework-admin'),
    						'desc' => '',
    						'std' => ''
    						),
    					array(
    						'id' => 'custom_ios_icon57',
    						'type' => 'upload',
    						'title' => __('Custom iOS 57x57', 'swift-framework-admin'), 
    						'sub_desc' => __('Upload a 57px x 57px Png image that will be your website bookmark on non-retina iOS devices.', 'swift-framework-admin'),
    						'desc' => ''
    						),
    					array(
    						'id' => 'custom_ios_icon72',
    						'type' => 'upload',
    						'title' => __('Custom iOS 72x72', 'swift-framework-admin'), 
    						'sub_desc' => __('Upload a 72px x 72px Png image that will be your website bookmark on non-retina iOS devices.', 'swift-framework-admin'),
    						'desc' => ''
    						),
    					array(
    						'id' => 'custom_ios_icon114',
    						'type' => 'upload',
    						'title' => __('Custom iOS 114x114', 'swift-framework-admin'), 
    						'sub_desc' => __('Upload a 114px x 114px Png image that will be your website bookmark on retina iOS devices.', 'swift-framework-admin'),
    						'desc' => ''
    						),
    					array(
    						'id' => 'custom_ios_icon144',
    						'type' => 'upload',
    						'title' => __('Custom iOS 144x144', 'swift-framework-admin'), 
    						'sub_desc' => __('Upload a 144px x 144px Png image that will be your website bookmark on retina iOS devices.', 'swift-framework-admin'),
    						'desc' => ''
    						),
    					array(
    						'id' => 'rss_feed_url',
    						'type' => 'text',
    						'title' => __('RSS Feed URL', 'swift-framework-admin'),
    						'sub_desc' => __('The rss feed URL for your blog.', 'swift-framework-admin'),
    						'desc' => '',
    						'std' => '?feed=rss2'
    						),
    					array(
    						'id' => 'gmaps_api_key',
    						'type' => 'text',
    						'title' => __('Google Maps API Key', 'swift-framework-admin'),
    						'sub_desc' => __('This is needed to use the map functionality within the theme. You can get your key <a href="https://console.developers.google.com/flows/enableapi?apiid=maps_backend,geocoding_backend,directions_backend,distance_matrix_backend,elevation_backend&keyType=CLIENT_SIDE&reusekey=true" target="_blank">here</a>. Once you have generated it, copy and paste it into this option.', 'swift-framework-admin'),
    						'desc' => '',
    						'std' => ''
    						),
    					array(
    						'id' => 'google_analytics',
    						'type' => 'textarea',
    						'title' => __('Tracking code', 'swift-framework-admin'), 
    						'sub_desc' => __('Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme. NOTE: Please include the script tag.', 'swift-framework-admin'),
    						'desc' => '',
    						'std' => ''
    						),
    					array(
    						'id' => 'custom_admin_login_logo',
    						'type' => 'upload',
    						'title' => __('Custom admin login logo', 'swift-framework-admin'), 
    						'sub_desc' => __('Upload a 254 x 95px image here to replace the admin login logo.', 'swift-framework-admin'),
    						'desc' => ''
    						),
    					array(
    						'id' => 'overlay_opacity',
    						'type' => 'slider',
    						'title' => __('Hover Overlay Opacity', 'swift-framework-admin'), 
    						'sub_desc' => __('Select the percentage opacity of the hover overlay.', 'swift-framework-admin'),
    						'desc' => '',
    						'from' => '0',
    						'to' => '100',
    						'step' => '5',
    						'unit' => '',
    						'std' => '100'
    						),
    					array(
    						'id' => 'enable_swipe_indicators',
    						'type' => 'button_set',
    						'title' => __('Enable Swipe Indicators', 'swift-framework-admin'), 
    						'sub_desc' => __('Enable the swipe indicators which appear on carousels when they are visible on mobile/tablet devices.', 'swift-framework-admin'),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '1'
    						),
    					array(
    						'id' => 'enable_styleswitcher',
    						'type' => 'button_set',
    						'title' => __('Enable Front End Style Switcher', 'swift-framework-admin'), 
    						'sub_desc' => __('Enable/Disable the front end styleswitcher.', 'swift-framework-admin'),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '0'
    						)
    					)
    				);
//    $sections[] = array(
//    				'icon' => 'dashboard',
//    				'icon_class' => 'fa-lg',
//    				'title' => __('Performance Options', "swiftframework"),
//    				'desc' => __('<p class="description">These are the performance options for the theme</p>', "swiftframework"),
//    				'fields' => array(	
//    					array(
//    						'id' => 'enable_min_scripts',
//    						'type' => 'button_set',
//    						'title' => __('Enable Performance', "swiftframework"), 
//    						'sub_desc' => __('Enable this option to load pre-minified scripts, without the need for any plugins.', "swiftframework"),
//    						'desc' => '',
//    						'options' => array('1' => 'On','0' => 'Off'),
//    						'std' => '0'
//    						),
//    					)
//    				);
   	$sections[] = array(
   					'icon' => 'code',
   					'icon_class' => 'fa-lg',
   					'title' => __('Custom CSS/JS', 'swift-framework-admin'),
   					'desc' => __('<p class="description">Add your custom css/js code to the boxes below.</p>', 'swift-framework-admin'),
   					'fields' => array(
   							array(
   								'id' => 'custom_css',
   								'type' => 'textarea',
   								'title' => __('Custom CSS', 'swift-framework-admin'), 
   								'sub_desc' => __('Add some CSS to your theme by adding it to this textarea.', 'swift-framework-admin'),
   								'desc' => '',
   								'std' => ''
   								),
   							array(
   								'id' => 'custom_js',
   								'type' => 'textarea',
   								'title' => __('Custom JS', 'swift-framework-admin'), 
   								'sub_desc' => __('Add some custom JavaScript to your theme by adding it to this textarea.', 'swift-framework-admin'),
   								'desc' => '',
   								'std' => ''
   								)
   						)
   					);
    $sections[] = array(
    				'icon' => 'picture-o',
    				'icon_class' => 'fa-lg',
    				'title' => __('Background Options', 'swift-framework-admin'),
    				'desc' => __('<p class="description">These are the options for the background.</p>', 'swift-framework-admin'),
    				'fields' => array(
    					array(
    						'id' => 'use_bg_image',
    						'type' => 'button_set',
    						'title' => __('Use Background Image', 'swift-framework-admin'), 
    						'sub_desc' => __('Check this to use an image for the body background (boxed layout only).', 'swift-framework-admin'),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '1'
    						),
    					array(
    						'id' => 'custom_bg_image',
    						'type' => 'upload',
    						'title' => __('Upload Background Image', 'swift-framework-admin'), 
    						'sub_desc' => __('Either upload or provide a link to your own background here, or choose from the presets below.', 'swift-framework-admin'),
    						'desc' => ''
    						),
    					array(
    						'id' => 'bg_size',
    						'type' => 'button_set',
    						'title' => __('Background Size', 'swift-framework-admin'), 
    						'sub_desc' => __('If you are using an image rather than a pattern, select cover to make the image cover the background.', 'swift-framework-admin'),
    						'desc' => '',
    						'options' => array('cover' => 'Cover','auto' => 'Auto'),
    						'std' => 'auto'
    						),
    					array(
    						'id' => 'preset_bg_image',
    						'type' => 'radio_img_bg',
    						'title' => __('Preset body background image', 'swift-framework-admin'), 
    						'sub_desc' => __('Select a preset background image for the body background.', 'swift-framework-admin'),
    						'desc' => '',
    						'options' => array(
    										$args['bg_image_path'] . '45degree_fabric.png' => $args['bg_image_path'] . '45degree_fabric.png',
    										$args['bg_image_path'] . 'argyle.png' => $args['bg_image_path'] . 'argyle.png',
    										$args['bg_image_path'] . 'beige_paper.png' => $args['bg_image_path'] . 'beige_paper.png',
    										$args['bg_image_path'] . 'bgnoise_lg.png' => $args['bg_image_path'] . 'bgnoise_lg.png',
    										$args['bg_image_path'] . 'black_denim.png' => $args['bg_image_path'] . 'black_denim.png',
    										$args['bg_image_path'] . 'black_linen_v2.png' => $args['bg_image_path'] . 'black_linen_v2.png',
    										$args['bg_image_path'] . 'black_paper.png' => $args['bg_image_path'] . 'black_paper.png',
    										$args['bg_image_path'] . 'black-Linen.png' => $args['bg_image_path'] . 'black-Linen.png',
    										$args['bg_image_path'] . 'blackmamba.png' => $args['bg_image_path'] . 'blackmamba.png',
    										$args['bg_image_path'] . 'blu_stripes.png' => $args['bg_image_path'] . 'blu_stripes.png',
    										$args['bg_image_path'] . 'bright_squares.png' => $args['bg_image_path'] . 'bright_squares.png',
    										$args['bg_image_path'] . 'brushed_alu_dark.png' => $args['bg_image_path'] . 'brushed_alu_dark.png',
    										$args['bg_image_path'] . 'brushed_alu.png' => $args['bg_image_path'] . 'brushed_alu.png',
    										$args['bg_image_path'] . 'candyhole.png' => $args['bg_image_path'] . 'candyhole.png',
    										$args['bg_image_path'] . 'checkered_pattern.png' => $args['bg_image_path'] . 'checkered_pattern.png',
    										$args['bg_image_path'] . 'classy_fabric.png' => $args['bg_image_path'] . 'classy_fabric.png',
    										$args['bg_image_path'] . 'concrete_wall_3.png' => $args['bg_image_path'] . 'concrete_wall_3.png',
    										$args['bg_image_path'] . 'connect.png' => $args['bg_image_path'] . 'connect.png',
    										$args['bg_image_path'] . 'cork_1.png' => $args['bg_image_path'] . 'cork_1.png',
    										$args['bg_image_path'] . 'crissXcross.png' => $args['bg_image_path'] . 'crissXcross.png',
    										$args['bg_image_path'] . 'dark_brick_wall.png' => $args['bg_image_path'] . 'dark_brick_wall.png',
    										$args['bg_image_path'] . 'dark_dotted.png' => $args['bg_image_path'] . 'dark_dotted.png',
    										$args['bg_image_path'] . 'dark_geometric.png' => $args['bg_image_path'] . 'dark_geometric.png',
    										$args['bg_image_path'] . 'dark_leather.png' => $args['bg_image_path'] . 'dark_leather.png',
    										$args['bg_image_path'] . 'dark_mosaic.png' => $args['bg_image_path'] . 'dark_mosaic.png',
    										$args['bg_image_path'] . 'dark_wood.png' => $args['bg_image_path'] . 'dark_wood.png',
    										$args['bg_image_path'] . 'detailed.png' => $args['bg_image_path'] . 'detailed.png',
    										$args['bg_image_path'] . 'diagonal-noise.png' => $args['bg_image_path'] . 'diagonal-noise.png',
    										$args['bg_image_path'] . 'fabric_1.png' => $args['bg_image_path'] . 'fabric_1.png',
    										$args['bg_image_path'] . 'fake_luxury.png' => $args['bg_image_path'] . 'fake_luxury.png',
    										$args['bg_image_path'] . 'felt.png' => $args['bg_image_path'] . 'felt.png',
    										$args['bg_image_path'] . 'flowers.png' => $args['bg_image_path'] . 'flowers.png',
    										$args['bg_image_path'] . 'foggy_birds.png' => $args['bg_image_path'] . 'foggy_birds.png',
    										$args['bg_image_path'] . 'graphy.png' => $args['bg_image_path'] . 'graphy.png',
    										$args['bg_image_path'] . 'gray_sand.png' => $args['bg_image_path'] . 'gray_sand.png',
    										$args['bg_image_path'] . 'green_gobbler.png' => $args['bg_image_path'] . 'green_gobbler.png',
    										$args['bg_image_path'] . 'green-fibers.png' => $args['bg_image_path'] . 'green-fibers.png',
    										$args['bg_image_path'] . 'grid_noise.png' => $args['bg_image_path'] . 'grid_noise.png',
    										$args['bg_image_path'] . 'gridme.png' => $args['bg_image_path'] . 'gridme.png',
    										$args['bg_image_path'] . 'grilled.png' => $args['bg_image_path'] . 'grilled.png',
    										$args['bg_image_path'] . 'grunge_wall.png' => $args['bg_image_path'] . 'grunge_wall.png',
    										$args['bg_image_path'] . 'handmadepaper.png' => $args['bg_image_path'] . 'handmadepaper.png',
    										$args['bg_image_path'] . 'inflicted.png' => $args['bg_image_path'] . 'inflicted.png',
    										$args['bg_image_path'] . 'irongrip.png' => $args['bg_image_path'] . 'irongrip.png',
    										$args['bg_image_path'] . 'knitted-netting.png' => $args['bg_image_path'] . 'knitted-netting.png',
    										$args['bg_image_path'] . 'leather_1.png' => $args['bg_image_path'] . 'leather_1.png',
    										$args['bg_image_path'] . 'light_alu.png' => $args['bg_image_path'] . 'light_alu.png',
    										$args['bg_image_path'] . 'light_checkered_tiles.png' => $args['bg_image_path'] . 'light_checkered_tiles.png',
    										$args['bg_image_path'] . 'light_honeycomb.png' => $args['bg_image_path'] . 'light_honeycomb.png',
    										$args['bg_image_path'] . 'lined_paper.png' => $args['bg_image_path'] . 'lined_paper.png',
    										$args['bg_image_path'] . 'little_pluses.png' => $args['bg_image_path'] . 'little_pluses.png',
    										$args['bg_image_path'] . 'mirrored_squares.png' => $args['bg_image_path'] . 'mirrored_squares.png',
    										$args['bg_image_path'] . 'noise_pattern_with_crosslines.png' => $args['bg_image_path'] . 'noise_pattern_with_crosslines.png',
    										$args['bg_image_path'] . 'noisy.png' => $args['bg_image_path'] . 'noisy.png',
    										$args['bg_image_path'] . 'old_mathematics.png' => $args['bg_image_path'] . 'old_mathematics.png',
    										$args['bg_image_path'] . 'padded.png' => $args['bg_image_path'] . 'padded.png',
    										$args['bg_image_path'] . 'paper_1.png' => $args['bg_image_path'] . 'paper_1.png',
    										$args['bg_image_path'] . 'paper_2.png' => $args['bg_image_path'] . 'paper_2.png',
    										$args['bg_image_path'] . 'paper_3.png' => $args['bg_image_path'] . 'paper_3.png',
    										$args['bg_image_path'] . 'pineapplecut.png' => $args['bg_image_path'] . 'pineapplecut.png',
    										$args['bg_image_path'] . 'pinstriped_suit.png' => $args['bg_image_path'] . 'pinstriped_suit.png',
    										$args['bg_image_path'] . 'plaid.png' => $args['bg_image_path'] . 'plaid.png',
    										$args['bg_image_path'] . 'project_papper.png' => $args['bg_image_path'] . 'project_papper.png',
    										$args['bg_image_path'] . 'px_by_Gre3g.png' => $args['bg_image_path'] . 'px_by_Gre3g.png',
    										$args['bg_image_path'] . 'quilt.png' => $args['bg_image_path'] . 'quilt.png',
    										$args['bg_image_path'] . 'random_grey_variations.png' => $args['bg_image_path'] . 'random_grey_variations.png',
    										$args['bg_image_path'] . 'ravenna.png' => $args['bg_image_path'] . 'ravenna.png',
    										$args['bg_image_path'] . 'real_cf.png' => $args['bg_image_path'] . 'real_cf.png',
    										$args['bg_image_path'] . 'robots.png' => $args['bg_image_path'] . 'robots.png',
    										$args['bg_image_path'] . 'rockywall.png' => $args['bg_image_path'] . 'rockywall.png',
    										$args['bg_image_path'] . 'roughcloth.png' => $args['bg_image_path'] . 'roughcloth.png',
    										$args['bg_image_path'] . 'small-crackle-bright.png' => $args['bg_image_path'] . 'small-crackle-bright.png',
    										$args['bg_image_path'] . 'smooth_wall.png' => $args['bg_image_path'] . 'smooth_wall.png',
    										$args['bg_image_path'] . 'snow.png' => $args['bg_image_path'] . 'snow.png',
    										$args['bg_image_path'] . 'soft_kill.png' => $args['bg_image_path'] . 'soft_kill.png',
    										$args['bg_image_path'] . 'square_bg.png' => $args['bg_image_path'] . 'square_bg.png',
    										$args['bg_image_path'] . 'starring.png' => $args['bg_image_path'] . 'starring.png',
    										$args['bg_image_path'] . 'stucco.png' => $args['bg_image_path'] . 'stucco.png',
    										$args['bg_image_path'] . 'subtle_freckles.png' => $args['bg_image_path'] . 'subtle_freckles.png',
    										$args['bg_image_path'] . 'subtle_orange_emboss.png' => $args['bg_image_path'] . 'subtle_orange_emboss.png',
    										$args['bg_image_path'] . 'subtle_zebra_3d.png' => $args['bg_image_path'] . 'subtle_zebra_3d.png',
    										$args['bg_image_path'] . 'tileable_wood_texture.png' => $args['bg_image_path'] . 'tileable_wood_texture.png',
    										$args['bg_image_path'] . 'type.png' => $args['bg_image_path'] . 'type.png',
    										$args['bg_image_path'] . 'vichy.png' => $args['bg_image_path'] . 'vichy.png',
    										$args['bg_image_path'] . 'washi.png' => $args['bg_image_path'] . 'washi.png',
    										$args['bg_image_path'] . 'white_sand.png' => $args['bg_image_path'] . 'white_sand.png',
    										$args['bg_image_path'] . 'white_texture.png' => $args['bg_image_path'] . 'white_texture.png',
    										$args['bg_image_path'] . 'whitediamond.png' => $args['bg_image_path'] . 'whitediamond.png',
    										$args['bg_image_path'] . 'whitey.png' => $args['bg_image_path'] . 'whitey.png',
    										$args['bg_image_path'] . 'woven.png' => $args['bg_image_path'] . 'woven.png',
    										$args['bg_image_path'] . 'xv.png' => $args['bg_image_path'] . 'xv.png'
    										),
    						'std' => ''
    						)
    					)
    				);
    $sections[] = array(
    				'icon_type' => 'image',
    				'icon' => Redux_OPTIONS_URL.'img/header.png',
    				'title' => __('Header Options', 'swift-framework-admin'),
    				'desc' => __('<p class="description">These are the options for the header.</p>', 'swift-framework-admin'),
    				'fields' => array(
    					array(
    						'id' => 'enable_tb',
    						'type' => 'button_set',
    						'title' => __('Enable Top Bar', 'swift-framework-admin'), 
    						'sub_desc' => __('If enabled, the top bar will show with the menu and social config.', 'swift-framework-admin'),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '1'
    						),
    					array(
    						'id' => 'tb_config',
    						'type' => 'select',
    						'title' => __('Top Bar Config', 'swift-framework-admin'),
    						'sub_desc' => "Choose the config for the Top Bar. This will define the options below for what you have on the left/right of the Top Bar.",
    						'options' => array(
    							'tb-1'	=> 'Text / Text',
    							'tb-2'	=> 'Alt Menu / Text',
    							'tb-3'	=> 'Text / Alt Menu',
    							'tb-4'	=> 'Welcome + Super Search / Links',
    							'tb-5'	=> 'Welcome + Super Search / Text',
    							'tb-6'	=> 'Welcome + Super Search / Alt Menu',
    							'tb-7'	=> 'Super Search / Text',
    							'tb-8'  => 'Super Search / Alt Menu',
    							'tb-9'	=> 'Text / Links',
    							'tb-10'	=> 'Links / Text',
    							),
    						'desc' => '',
    						'std' => 'tb-5'
    						),
    					array(
    						'id' => 'tb_left_text',
    						'type' => 'text',
    						'title' => __('Top Bar left text config', 'swift-framework-admin'),
    						'sub_desc' => "The text that is shown on the left of the Top Bar. You can use shortcodes in here if you like, (i.e. social). NOTE: Make sure you use single quotes (') for parameters with no spaces in between.",
    						'desc' => '',
    						'std' => "Contact us on 0800 123 4567 or info@dante.com"
    						),
    					array(
    						'id' => 'tb_right_text',
    						'type' => 'text',
    						'title' => __('Top Bar right text config', 'swift-framework-admin'),
    						'sub_desc' => "The text that is shown on the right of the Top Bar. You can use shortcodes in here if you like, (i.e. social). NOTE: Make sure you use single quotes (') for parameters with no spaces in between.",
    						'desc' => '',
    						'std' => "[social size='small' style='light' type='twitter,facebook,dribbble']"
    						),
    					array(
    						'id' => 'tb_search_text',
    						'type' => 'text',
    						'title' => __('Search text config', 'swift-framework-admin'),
    						'sub_desc' => "The text that is shown to the right of the search icon in the top bar / header.",
    						'desc' => '',
    						'std' => "Personal Shopper"
    						),
    					array(
    						'id' => 'show_sub',
    						'type' => 'button_set',
    						'title' => __('Show subscribe aux option', 'swift-framework-admin'), 
    						'sub_desc' => __('Check this to show the suscribe dropdown in the links output, allowing users to subscribe via inputting their email address. If you use this, be sure to enter a Mailchimp form action URL in the box below.', 'swift-framework-admin'),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '0'
    						),
    					array(
    						'id' => 'show_translation',
    						'type' => 'button_set',
    						'title' => __('Show translation aux option', 'swift-framework-admin'), 
    						'sub_desc' => __('Check this to show the translation dropdown in the links output.', 'swift-framework-admin'),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '0'
    						),
    					array(
    						'id' => 'show_account',
    						'type' => 'button_set',
    						'title' => __('Show account aux option', 'swift-framework-admin'), 
    						'sub_desc' => __('Check this to show the account sign in / my account in the links output.', 'swift-framework-admin'),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '1'
    						),
    					array(
    						'id' => 'show_cart',
    						'type' => 'button_set',
    						'title' => __('Show cart aux option', 'swift-framework-admin'), 
    						'sub_desc' => __('Check this to show the WooCommerce cart dropdown in the header.', 'swift-framework-admin'),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '0'
    						),
    					array(
    						'id' => 'show_cart_count',
    						'type' => 'button_set',
    						'title' => __('Cart aux item count', 'swift-framework-admin'), 
    						'sub_desc' => __('Enable this to include the item count within the cart.', 'swift-framework-admin'),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '0'
    						),
    					array(
    						'id' => 'show_wishlist',
    						'type' => 'button_set',
    						'title' => __('Show wishlist aux option', 'swift-framework-admin'), 
    						'sub_desc' => __('Check this to show the WooCommerce wishlist dropdown in the header. NOTE: You will need the YITH Wishlist plugin to be enabled.', 'swift-framework-admin'),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '0'
    						),
    					array(
    						'id' => 'sub_code',
    						'type' => 'textarea',
    						'title' => __('Subscribe form code', 'swift-framework-admin'),
    						'sub_desc' => "Enter the form code (e.g. Mailchimp) that will be used for the subscribe dropdown.",
    						'desc' => '',
    						'std' => ""
    						),
       					array(
    						'id' => 'header_layout',
    						'type' => 'radio_img',
    						'title' => __('Header Layout', 'swift-framework-admin'), 
    						'sub_desc' => __('Select a header layout option from the examples.', 'swift-framework-admin'),
    						'desc' => '',
    						'options' => array(
								'header-1' => array('title' => '', 'img' => Redux_OPTIONS_URL.'img/Dante_Header_over_under_centre.jpg'),
								'header-2' => array('title' => '', 'img' => Redux_OPTIONS_URL.'img/Dante_Header_over_under_left.jpg'),
								'header-3' => array('title' => '', 'img' => Redux_OPTIONS_URL.'img/Dante_Header_tab.jpg'),
								'header-4' => array('title' => '', 'img' => Redux_OPTIONS_URL.'img/Dante_Header_tab_topbar.jpg'),
								'header-5' => array('title' => '', 'img' => Redux_OPTIONS_URL.'img/Dante_Header_float.jpg'),
								'header-6' => array('title' => '', 'img' => Redux_OPTIONS_URL.'img/Dante_Header_wide_no_top.jpg'),
								'header-7' => array('title' => '', 'img' => Redux_OPTIONS_URL.'img/Dante_Header_kitchen_sink.jpg')
							),
    						'std' => 'header-7'
    						),
    					array(
    						'id' => 'header_left_text',
    						'type' => 'text',
    						'title' => __('Header left text config', 'swift-framework-admin'),
    						'sub_desc' => "The text that is shown on the left of header on header type 1 and type 4.",
    						'desc' => '',
    						'std' => "Contact us on 0800 123 4567 or info@dante.com"
    						),
    					array(
    						'id' => 'logo_upload',
    						'type' => 'upload',
    						'title' => __('Logo', 'swift-framework-admin'), 
    						'sub_desc' => __('Upload your logo here (any size).', 'swift-framework-admin'),
    						'desc' => ''
    						),
    					array(
    						'id' => 'retina_logo_upload',
    						'type' => 'upload',
    						'title' => __('Retina Logo', 'swift-framework-admin'), 
    						'sub_desc' => __('Upload the retina version of your logo here.', 'swift-framework-admin'),
    						'desc' => ''
    						),
    					array(
    						'id' => 'light_logo_upload',
    						'type' => 'upload',
    						'title' => __('Light Logo', 'swift-framework-admin'), 
    						'sub_desc' => __('Upload the light version of your logo here (for naked header setting).', 'swift-framework-admin'),
    						'desc' => ''
    						),
    					array(
    						'id' => 'dark_logo_upload',
    						'type' => 'upload',
    						'title' => __('Dark Logo', 'swift-framework-admin'), 
    						'sub_desc' => __('Upload the dark version of your logo here (for naked header setting).', 'swift-framework-admin'),
    						'desc' => ''
    						),
    					array(
    						'id' => 'logo_width',
    						'type' => 'text',
    						'title' => __('Logo Width', 'swift-framework-admin'),
    						'sub_desc' => __('Please enter the width of your logo here (standard size), so that it is restricted for the retina version. Numerical value (no px).', 'swift-framework-admin'),
    						'desc' => '',
    						'std' => '0',
    						'class' => 'mini'
    						),
    					array(
    						'id' => 'logo_height',
    						'type' => 'text',
    						'title' => __('Logo Height', 'swift-framework-admin'),
    						'sub_desc' => __('Please enter the height of your logo here (standard size). This is optional, and if you do not provide anything here then the logo area height will be restricted to 42px. Numerical value (no px).', 'swift-framework-admin'),
    						'desc' => '',
    						'std' => '',
    						'class' => 'mini'
    						),
    					array(
    						'id' => 'logo_resized_width',
    						'type' => 'text',
    						'title' => __('Logo Resized Width', 'swift-framework-admin'),
    						'sub_desc' => __('Please enter the width you would like your logo to be when the sticky header resizes. Only works when logo width is set above. Numerical value (no px).', 'swift-framework-admin'),
    						'desc' => '',
    						'std' => '',
    						'class' => 'mini'
    						),
    					array(
    						'id' => 'logo_resized_height',
    						'type' => 'text',
    						'title' => __('Logo Resized Height', 'swift-framework-admin'),
    						'sub_desc' => __('Please enter the height you would like your logo to be when the sticky header resizes. Only works when logo height is set above. Numerical value (no px).', 'swift-framework-admin'),
    						'desc' => '',
    						'std' => '',
    						'class' => 'mini'
    						),
    					array(
    						'id' => 'logo_top_spacing',
    						'type' => 'text',
    						'title' => __('Logo Top spacing', 'swift-framework-admin'),
    						'sub_desc' => '',
    						'desc' => '',
    						'std' => '0',
    						'class' => 'mini'
    						),
    					array(
    						'id' => 'logo_bottom_spacing',
    						'type' => 'text',
    						'title' => __('Logo Bottom spacing', 'swift-framework-admin'),
    						'sub_desc' => '',
    						'desc' => '',
    						'std' => '0',
    						'class' => 'mini'
    						),
    					array(
    						'id' => 'header_opacity',
    						'type' => 'slider',
    						'title' => __('Header Opacity', 'swift-framework-admin'), 
    						'sub_desc' => __('Select the percentage opacity of the header. NOTE: This is only for Headers 3/4/5.', 'swift-framework-admin'),
    						'desc' => '',
    						'from' => '0',
    						'to' => '100',
    						'step' => '5',
    						'unit' => '',
    						'std' => '100'
    						),
    					array(
    						'id' => 'nav_top_spacing',
    						'type' => 'text',
    						'title' => __('Main Nav Top spacing', 'swift-framework-admin'),
    						'sub_desc' => 'Add spacing here if you need extra spacing above the main navigation (i.e. if you have a large logo). Numerical value (no px).',
    						'desc' => '',
    						'std' => '0',
    						'class' => 'mini'
    						),
    					array(
    						'id' => 'enable_fw_header',
    						'type' => 'button_set',
    						'title' => __('Full Width Header', 'swift-framework-admin'), 
    						'sub_desc' => __('Enable the header to be full width (edge to edge).', 'swift-framework-admin'),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '0'
    						),
    					array(
    						'id' => 'enable_mini_header',
    						'type' => 'button_set',
    						'title' => __('Sticky header', 'swift-framework-admin'), 
    						'sub_desc' => __('Enable the sticky header when scrolling down the page.', 'swift-framework-admin'),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '1'
    						),
    					array(
    						'id' => 'sticky_header_mobile',
    						'type' => 'button_set',
    						'title' => __('Sticky header on mobile/tablet', 'swift-framework-admin'), 
    						'sub_desc' => __('Enable the sticky header for mobile and tablets.', 'swift-framework-admin'),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '0'
    						),
    					array(
    						'id' => 'enable_logo_fade',
    						'type' => 'button_set',
    						'title' => __('Logo hover fade', 'swift-framework-admin'), 
    						'sub_desc' => __('Enable the fade effect when you hover the logo.', 'swift-framework-admin'),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '1'
    						),
    					array(
    						'id' => 'enable_header_shadow',
    						'type' => 'button_set',
    						'title' => __('Header Shadow', 'swift-framework-admin'), 
    						'sub_desc' => __('Enable the shadow below the header.', 'swift-framework-admin'),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '1'
    						),
    					array(
    						'id' => 'header_search_type',
    						'type' => 'button_set',
    						'title' => __('Header Search', 'swift-framework-admin'), 
    						'sub_desc' => __('Enable the search icon in the header menu.', 'swift-framework-admin'),
    						'desc' => '',
    						'options' => array('search-1' => 'Standard (Fancy)','search-2' => 'Overlay with AJAX', 'search-off' => 'Search disabled'),
    						'std' => 'search-1'
    						)
    					)
    				);
    $sections[] = array(
    				'icon_type' => 'image',
    				'icon' => Redux_OPTIONS_URL.'img/footer.png',
    				'title' => __('Footer Options', 'swift-framework-admin'),
    				'desc' => __('<p class="description">These are the options for the footer.</p>', 'swift-framework-admin'),
    				'fields' => array(
    					array(
    						'id' => 'enable_footer',
    						'type' => 'button_set',
    						'title' => __('Enable Footer', 'swift-framework-admin'), 
    						'sub_desc' => __('Enable the footer widgets section.', 'swift-framework-admin'),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '1'
    						),
    					array(
    						'id' => 'enable_footer_divider',
    						'type' => 'button_set',
    						'title' => __('Footer Divider', 'swift-framework-admin'), 
    						'sub_desc' => __('Enable the footer divider above the footer.', 'swift-framework-admin'),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '1'
    						),
    					array(
    						'id' => 'footer_layout',
    						'type' => 'radio_img',
    						'title' => __('Footer Layout', 'swift-framework-admin'), 
    						'sub_desc' => __('Select the footer column layout.', 'swift-framework-admin'),
    						'desc' => '',
    						'options' => array(
    										'footer-1' => array('title' => '', 'img' => Redux_OPTIONS_URL.'img/footer-1.png'),
    										'footer-2' => array('title' => '', 'img' => Redux_OPTIONS_URL.'img/footer-2.png'),
    										'footer-3' => array('title' => '', 'img' => Redux_OPTIONS_URL.'img/footer-3.png'),
    										'footer-4' => array('title' => '', 'img' => Redux_OPTIONS_URL.'img/footer-4.png'),
    										'footer-5' => array('title' => '', 'img' => Redux_OPTIONS_URL.'img/footer-5.png'),
    										'footer-6' => array('title' => '', 'img' => Redux_OPTIONS_URL.'img/footer-6.png'),
    										'footer-7' => array('title' => '', 'img' => Redux_OPTIONS_URL.'img/footer-7.png'),
    										'footer-8' => array('title' => '', 'img' => Redux_OPTIONS_URL.'img/footer-8.png'),
    										'footer-9' => array('title' => '', 'img' => Redux_OPTIONS_URL.'img/footer-9.png'),
    											),
    						'std' => 'footer-1'
    						),
    					array(
    						'id' => 'enable_copyright',
    						'type' => 'button_set',
    						'title' => __('Enable Copyright', 'swift-framework-admin'), 
    						'sub_desc' => __('Enable the footer copyright section.', 'swift-framework-admin'),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '1'
    						),
    					array(
    						'id' => 'enable_copyright_divider',
    						'type' => 'button_set',
    						'title' => __('Copyright Divider', 'swift-framework-admin'), 
    						'sub_desc' => __('Enable the copyright divider above the copyright.', 'swift-framework-admin'),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '1'
    						),
    					array(
    						'id' => 'footer_copyright_text',
    						'type' => 'textarea',
    						'title' => __('Footer Copyright Text', 'swift-framework-admin'),
    						'sub_desc' => 'The copyright text that appears in the footer.',
    						'desc' => '',
    						'std' => "&copy;[the-year] Dante &middot; Built with love by <a href='http://www.swiftideas.net'>Swift Ideas</a> using [wp-link]."
    						),
    					array(
    						'id' => 'show_backlink',
    						'type' => 'button_set',
    						'title' => __('Show Swift Ideas Backlink', 'swift-framework-admin'), 
    						'sub_desc' => __('If checked, a backlink to our site will be shown in the footer. This is not compulsory, but always appreciated :)', 'swift-framework-admin'),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '1'
    						)
    					)
    				);
	
	$sections[] = array(
					'icon' => 'search-plus',
					'icon_class' => 'fa-lg',
					'title' => __('Super Search Options', 'swift-framework-admin'),
					'desc' => __('<p class="description">These are the options for the super search. There are 4 fields that you can set. If you leave any of the filters set to none, then that filter will be ignored.</p>', 'swift-framework-admin'),
					'fields' => array(
						array(
							'id' => 'ss_enable',
							'type' => 'button_set',
							'title' => __('Enable Super Search', 'swift-framework-admin'), 
							'sub_desc' => __('If enabled, the super search option will be included on the page. You will also need to choose the option below.', 'swift-framework-admin'),
							'desc' => '',
							'options' => array('1' => 'On','0' => 'Off'),
							'std' => '1'
							),
						array(
							'id' => 'ss_mobile',
							'type' => 'button_set',
							'title' => __('Enable Super Search on Mobile', 'swift-framework-admin'), 
							'sub_desc' => __('If enabled, the super search option will show at the top of the page on mobile devices.', 'swift-framework-admin'),
							'desc' => '',
							'options' => array('1' => 'On','0' => 'Off'),
							'std' => '1'
							),
						array(
							'id' => 'field1_text',
							'type' => 'text',
							'title' => __('Field 1 Text', 'swift-framework-admin'),
							'sub_desc' => 'The text that precedes the first dropdown select.',
							'desc' => '',
							'std' => "I'm looking for"
							),
						array(
							'id' => 'field1_filter',
							'type' => 'select',
							'title' => __('Field 1 Filter', 'swift-framework-admin'),
							'sub_desc' => "The first filter in the search text, shows after field 1 text.",
							'options' => sf_get_woo_product_filters_array(),
							'desc' => '',
							'std' => 'product_cat'
							),
						array(
							'id' => 'field1_default_text',
							'type' => 'text',
							'title' => __('Field 1 Label', 'swift-framework-admin'),
							'sub_desc' => 'The default label text for the field 1 filter.',
							'desc' => '',
							'std' => "product"
							),
						array(
							'id' => 'ss_divide_0',
							'type' => 'divide'
							),
						array(
							'id' => 'field2_text',
							'type' => 'text',
							'title' => __('Field 2 Text', 'swift-framework-admin'),
							'sub_desc' => 'The text that precedes the second dropdown select.',
							'desc' => '',
							'std' => "in a size"
							),
						array(
							'id' => 'field2_filter',
							'type' => 'select',
							'title' => __('Field 2 Filter', 'swift-framework-admin'),
							'sub_desc' => "The second filter in the search text, shows after field 2 text.",
							'options' => sf_get_woo_product_filters_array(),
							'desc' => '',
							'std' => 'product_cat'
							),
						array(
							'id' => 'field2_default_text',
							'type' => 'text',
							'title' => __('Field 2 Label', 'swift-framework-admin'),
							'sub_desc' => 'The default label text for the field 2 filter.',
							'desc' => '',
							'std' => "size"
							),
						array(
							'id' => 'ss_divide_1',
							'type' => 'divide'
							),
						array(
							'id' => 'field3_text',
							'type' => 'text',
							'title' => __('Field 3 Text', 'swift-framework-admin'),
							'sub_desc' => 'The text that precedes the third dropdown select.',
							'desc' => '',
							'std' => ". Show me the"
							),
						array(
							'id' => 'field3_filter',
							'type' => 'select',
							'title' => __('Field 3 Filter', 'swift-framework-admin'),
							'sub_desc' => "The third filter in the search text, shows after field 3 text.",
							'options' => sf_get_woo_product_filters_array(),
							'desc' => '',
							'std' => 'product_cat'
							),
						array(
							'id' => 'field3_default_text',
							'type' => 'text',
							'title' => __('Field 3 Label', 'swift-framework-admin'),
							'sub_desc' => 'The default label text for the field 3 filter.',
							'desc' => '',
							'std' => "colour"
							),
						array(
							'id' => 'ss_divide_2',
							'type' => 'divide'
							),
						array(
							'id' => 'field4_text',
							'type' => 'text',
							'title' => __('Field 4 Text', 'swift-framework-admin'),
							'sub_desc' => 'The text that precedes the fourth dropdown select.',
							'desc' => '',
							'std' => ""
							),
						array(
							'id' => 'field4_filter',
							'type' => 'select',
							'title' => __('Field 4 Filter', 'swift-framework-admin'),
							'sub_desc' => "The fourth filter in the search text, shows after field 4 text.",
							'options' => sf_get_woo_product_filters_array(),
							'desc' => '',
							'std' => 'product_cat'
							),
						array(
							'id' => 'field4_default_text',
							'type' => 'text',
							'title' => __('Field 4 Label', 'swift-framework-admin'),
							'sub_desc' => 'The default label text for the field 4 filter.',
							'desc' => '',
							'std' => ""
							),
						array(
							'id' => 'ss_divide_3',
							'type' => 'divide'
							),
						array(
							'id' => 'field5_text',
							'type' => 'text',
							'title' => __('Field 5 Text', 'swift-framework-admin'),
							'sub_desc' => 'The text that precedes the fifth dropdown select.',
							'desc' => '',
							'std' => ""
							),
						array(
							'id' => 'field5_filter',
							'type' => 'select',
							'title' => __('Field 5 Filter', 'swift-framework-admin'),
							'sub_desc' => "The fifth filter in the search text, shows after field 5 text.",
							'options' => sf_get_woo_product_filters_array(),
							'desc' => '',
							'std' => 'product_cat'
							),
						array(
							'id' => 'field5_default_text',
							'type' => 'text',
							'title' => __('Field 5 Label', 'swift-framework-admin'),
							'sub_desc' => 'The default label text for the field 5 filter.',
							'desc' => '',
							'std' => ""
							),
						array(
							'id' => 'ss_divide_4',
							'type' => 'divide'
							),
						array(
							'id' => 'field6_text',
							'type' => 'text',
							'title' => __('Field 6 Text', 'swift-framework-admin'),
							'sub_desc' => 'The text that precedes the sixth dropdown select.',
							'desc' => '',
							'std' => ""
							),
						array(
							'id' => 'field6_filter',
							'type' => 'select',
							'title' => __('Field 6 Filter', 'swift-framework-admin'),
							'sub_desc' => "The sixth filter in the search text, shows after field 6 text.",
							'options' => sf_get_woo_product_filters_array(),
							'desc' => '',
							'std' => 'product_cat'
							),
						array(
							'id' => 'field6_default_text',
							'type' => 'text',
							'title' => __('Field 6 Label', 'swift-framework-admin'),
							'sub_desc' => 'The default label text for the field 6 filter.',
							'desc' => '',
							'std' => ""
							),
						array(
							'id' => 'ss_divide_5',
							'type' => 'divide'
							),
						array(
							'id' => 'ss_final_text',
							'type' => 'text',
							'title' => __('Final Text', 'swift-framework-admin'),
							'sub_desc' => 'The text that appears after the last filter.',
							'desc' => '',
							'std' => "items."
							),
						array(
							'id' => 'ss_button_text',
							'type' => 'text',
							'title' => __('Super Search Button Text', 'swift-framework-admin'),
							'sub_desc' => 'The text for the super search button.',
							'desc' => '',
							'std' => "Super Search"
							),
						)
					);
	
    $sections[] = array(
    				'icon' => 'bullhorn',
    				'icon_class' => 'fa-lg',
    				'title' => __('Promo Bar Options', 'swift-framework-admin'),
    				'desc' => __('<p class="description">These are the promo bar options for the banner that appears at the bottom of the page.</p>', 'swift-framework-admin'),
    				'fields' => array(
    					array(
    						'id' => 'enable_footer_promo_bar',
    						'type' => 'button_set',
    						'title' => __('Enable Promo Bar', 'swift-framework-admin'), 
    						'sub_desc' => __('Enable the sitewide promo bar at the bottom of the page.', 'swift-framework-admin'),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '0'
    						),
    					array(
    						'id' => 'footer_promo_bar_type',
    						'type' => 'button_set',
    						'title' => __('Promo Bar Type', 'swift-framework-admin'), 
    						'sub_desc' => __('Select the type for the promo bar.', 'swift-framework-admin'),
    						'desc' => '',
    						'options' => array('button' => 'Text + Button','arrow' => 'Text + Arrow (Full Bar Link)', 'text' => 'Text Only (Full Bar Link)'),
    						'std' => 'button'
    						),
    					array(
    						'id' => 'footer_promo_bar_text',
    						'type' => 'text',
    						'title' => __('Promo Bar Text', 'swift-framework-admin'),
    						'sub_desc' => 'Enter the text for the promo bar here.',
    						'desc' => '',
    						'std' => 'Enter your promo bar text here.'
    						),
    					array(
    						'id' => 'footer_promo_bar_button_color',
    						'type' => 'select',
    						'title' => __('Promo Bar Button Color', 'swift-framework-admin'),
    						'sub_desc' => "Choose the color for the promo bar button.",
    						'options' => array(
    							'accent'	=> 'Accent',
    							'black'	=> 'Black',
    							'white'	=> 'White',
    							'grey'	=> 'Grey',
    							'lightgrey'	=> 'Light Grey',
    							'gold'	=> 'Gold',
    							'lightblue'	=> 'Light Blue',
    							'green'	=> 'Green',
    							'gold'	=> 'Gold',
    							'turquoise'	=> 'Turquoise',
    							'pink'	=> 'Pink',
    							'orange'	=> 'Orange',
    							'turquoise'	=> 'Turquoise',
    							'transparent-light'	=> 'Transparent - Light',
    							'transparent-dark'	=> 'Transparent - Dark',
    							),
    						'desc' => '',
    						'std' => 'accent'
    						),
    					array(
    						'id' => 'footer_promo_bar_button_text',
    						'type' => 'text',
    						'title' => __('Promo Bar Button Text', 'swift-framework-admin'),
    						'sub_desc' => 'Enter the text for the promo bar button here, if you have the Text + Button type selected.',
    						'desc' => '',
    						'std' => 'Button Text.'
    						),
    					array(
    						'id' => 'footer_promo_bar_button_link',
    						'type' => 'text',
    						'title' => __('Promo Bar Button Link', 'swift-framework-admin'),
    						'sub_desc' => 'Enter the link for the promo bar button here, if you have the Text + Button or Text + Arrow Button type selected.',
    						'desc' => '',
    						'std' => 'http://'
    						),
    					array(
    						'id' => 'footer_promo_bar_button_target',
    						'type' => 'button_set',
    						'title' => __('Promo Bar Button Target', 'swift-framework-admin'), 
    						'sub_desc' => __('Select the target for the promo bar link.', 'swift-framework-admin'),
    						'desc' => '',
    						'options' => array('_self' => 'Same Window', '_blank' => 'New Window'),
    						'std' => '_self'
    						),
    					)
    				);
        
    if ( sf_is_current_color_settings_empty() ){
    	   	
    	$sections[] = array(
    				'icon' => 'pencil',
    				'icon_class' => 'fa-lg',
    				'title' => __('Colour Scheme Options', 'swift-framework-admin'),
    				'desc' => __('<p class="description">Create, import, and export color schemas.</p>', 'swift-framework-admin'),
    				'fields' => array(
    					array(
    						'id' => 'colour_scheme_select_scheme',
    						'type' => 'select',
    						'title' => __('Select an existing colour scheme to preview', 'swift-framework-admin'),
    						'sub_desc' => "",
    						'options' => sf_get_color_scheme_list(),
    						'desc' => '',
    						'std' => sf_get_current_color_scheme_id()
    						),
    					array(
    					    'id' => 'colour_scheme_import',
    					    'type' => 'upload_scheme',
    					    'title' => __('Import a Color Scheme', 'swift-framework-admin'), 
    					    'sub_desc' => __('File must be csv format.', 'swift-framework-admin')
    						),
    					array(
    					    'id' => 'colour_scheme_export',
    					    'type' => 'raw_html_narrow',
    					    'title' => __('Export Current Settings As Schema', 'swift-framework-admin'), 
    					    'sub_desc' => __('Export the CURRENT COLORS IN THE SCHEMA PREVIEW as a csv file.', 'swift-framework-admin'),
    					    'html' => sf_export_color_scheme_html()
    						),
    					array(
    					    'id' => 'colour_scheme_preview',
    					    'type' => 'raw_html_narrow',
    					    'title' => __('Color Scheme Preview', 'swift-framework-admin'), 
    					    'sub_desc' => __('<span id="scheme-preview-text">These colors are what currently exist in the WordPress theme customizer.</span>'
    					    				 .'<div class="scheme-buttons" id="scheme-buttons">'
    					    				 .'<input class="save-this-scheme-name" name="save-this-scheme-name" placeholder="Name This Scheme"   style="display:none;" />'					    				 
    					    				 .'<a class="save-this-scheme button-secondary"   style="display:none;">Save This Scheme</a>'
    					    				 .'<a class="delete-this-scheme button-secondary"  style="display:none;">Delete This Scheme</a>'
    					    				 .'<a class="use-this-scheme button-secondary"  style="display:none;">Use This Scheme</a>'
    					    				 .'</div>', 'swift-framework-admin'),
    					    'html' => sf_get_current_color_scheme_html_preview()
    						)
    					)
    
    				);
    	   	
       	} else {
       	
    	$sections[] = array(
				'icon' => 'pencil',
				'icon_class' => 'fa-lg',
				'title' => __('Colour Scheme Options', 'swift-framework-admin'),
				'desc' => __('<p class="description">Create, import, and export color schemas.</p>', 'swift-framework-admin'),
				'fields' => array(
					array(
						'id' => 'colour_scheme_select_scheme',
						'type' => 'select',
						'title' => __('Select an existing colour scheme to preview', 'swift-framework-admin'),
						'sub_desc' => "",
						'options' => sf_get_color_scheme_list(),
						'desc' => '',
						'std' => sf_get_current_color_scheme_id()
						),
					array(
					    'id' => 'colour_scheme_import',
					    'type' => 'upload_scheme',
					    'title' => __('Import a Color Scheme', 'swift-framework-admin'), 
					    'sub_desc' => __('File must be csv format.', 'swift-framework-admin')
						),
					array(
					    'id' => 'colour_scheme_export',
					    'type' => 'raw_html_narrow',
					    'title' => __('Export Current Settings As Schema', 'swift-framework-admin'), 
					    'sub_desc' => __('Export the CURRENT COLORS IN THE SCHEMA PREVIEW as a csv file.', 'swift-framework-admin'),
					    'html' => sf_export_color_scheme_html()
						),
					array(
					    'id' => 'colour_scheme_preview',
					    'type' => 'raw_html_narrow',
					    'title' => __('Color Scheme Preview', 'swift-framework-admin'), 
					    'sub_desc' => __('<span id="scheme-preview-text">These colors are what currently exist in the WordPress theme customizer.</span>'
					    				 .'<div class="scheme-buttons" id="scheme-buttons">'
					    				 .'<input class="save-this-scheme-name" name="save-this-scheme-name" placeholder="Name This Scheme" />'					    				 
					    				 .'<a class="save-this-scheme button-secondary">Save This Scheme</a>'
					    				 .'<a class="delete-this-scheme button-secondary"  style="display:none;">Delete This Scheme</a>'
					    				 .'<a class="use-this-scheme button-secondary"  style="display:none;">Use This Scheme</a>'
					    				 .'</div>', 'swift-framework-admin'),
					    'html' => sf_get_current_color_scheme_html_preview()
						)
					)

				);	   	
    	   	
    }
    
    $sections[] = array(
    				'icon' => 'tasks',
    				'icon_class' => 'fa-lg',
    				'title' => __('Default Meta Options', 'swift-framework-admin'),
    				'desc' => __('<p class="description">These are the options to set the defaults for the meta options.</p>', 'swift-framework-admin'),
    				'fields' => array(
    					array(
    						'id' => 'default_show_page_heading',
    						'type' => 'button_set',
    						'title' => __('Default Show Page Heading', 'swift-framework-admin'), 
    						'sub_desc' => __('Choose the default state for the page heading, shown/hidden.', 'swift-framework-admin'),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '1'
    						),
    					array(
    						'id' => 'default_page_heading_bg_alt',
    						'type' => 'select',
    						'title' => __('Default Page Heading Background', 'swift-framework-admin'),
    						'sub_desc' => "Choose the default alt background configuration for the page heading.",
    						'options' => array(
    							'none'		=> 'None',
    							'alt-one'		=> 'Alt 1',
    							'alt-two'		=> 'Alt 2',
    							'alt-three'		=> 'Alt 3',
    							'alt-four'		=> 'Alt 4',
    							'alt-five'		=> 'Alt 5',
    							'alt-six'		=> 'Alt 6',
    							'alt-seven'		=> 'Alt 7',
    							'alt-eight'		=> 'Alt 8',
    							'alt-nine'		=> 'Alt 9',
    							'alt-ten'		=> 'Alt 10'
    							),
    						'desc' => '',
    						'std' => 'none'
    						),
    					array(
    						'id' => 'default_include_author_info',
    						'type' => 'button_set',
    						'title' => __('Default Include Author Info', 'swift-framework-admin'), 
    						'sub_desc' => __('Choose the default state for including author info on each post.', 'swift-framework-admin'),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '1'
    						),
    					array(
    						'id' => 'default_divide_0',
    						'type' => 'divide'
    						),
    					array(
    						'id' => 'default_sidebar_config',
    						'type' => 'select',
    						'title' => __('Default Sidebar Config', 'swift-framework-admin'),
    						'sub_desc' => "Choose the default sidebar config for pages/posts",
    						'options' => array(
    							'no-sidebars'		=> 'No Sidebars',
    							'left-sidebar'		=> 'Left Sidebar',
    							'right-sidebar'		=> 'Right Sidebar',
    							'both-sidebars'		=> 'Both Sidebars'
    						),
    						'desc' => '',
    						'std' => 'no-sidebars'
    						),
    					array(
    						'id' => 'default_left_sidebar',
    						'type' => 'select',
    						'title' => __('Default Left Sidebar', 'swift-framework-admin'),
    						'sub_desc' => "Choose the default left sidebar for pages/posts",
    						'options' => sf_sidebars_array(),
    						'desc' => '',
    						'std' => 'Sidebar-1'
    						),
    					array(
    						'id' => 'default_right_sidebar',
    						'type' => 'select',
    						'title' => __('Default Right Sidebar', 'swift-framework-admin'),
    						'sub_desc' => "Choose the default right sidebar for pages/posts",
    						'options' => sf_sidebars_array(),
    						'desc' => '',
    						'std' => 'Sidebar-1'
    						)
    					)
    				);
	$sections[] = array(
				'icon' => 'eye',
				'icon_class' => 'fa-lg',
				'title' => __('Asset Background Options', 'swift-framework-admin'),
				'desc' => __('<p class="description">These are the options for the alternative backgrounds that you can set for page headings / full width page builder assets.</p>', 'swift-framework-admin'),
				'fields' => array(
					array(
						'id' => 'filter_wrap_bg',
						'type' => 'select',
						'title' => __('Filter Wrap Alt Background', 'swift-framework-admin'),
						'sub_desc' => "Choose the alt background configuration for the filter wrap that appears within portfolio/blog page builder elements.",
						'options' => array(
							'none'		=> 'None',
							'alt-one'		=> 'Alt 1',
							'alt-two'		=> 'Alt 2',
							'alt-three'		=> 'Alt 3',
							'alt-four'		=> 'Alt 4',
							'alt-five'		=> 'Alt 5',
							'alt-six'		=> 'Alt 6',
							'alt-seven'		=> 'Alt 7',
							'alt-eight'		=> 'Alt 8',
							'alt-nine'		=> 'Alt 9',
							'alt-ten'		=> 'Alt 10'
							),
						'desc' => '',
						'std' => 'none'
						),
					array(
						'id' => 'alt_divide_0',
						'type' => 'divide'
						),
					array(
					    'id' => 'alt_one_bg_color',
					    'type' => 'color',
					    'title' => __('Alt 1 Background Color', 'swift-framework-admin'), 
					    'sub_desc' => __('The background color for the Alt-1 alternative background.', 'swift-framework-admin'),
					    'std' => '#FFFFFF'
						),
					array(
					    'id' => 'alt_one_text_color',
					    'type' => 'color',
					    'title' => __('Alt 1 Text Color', 'swift-framework-admin'), 
					    'sub_desc' => __('The text color for the Alt-1 alternative background.', 'swift-framework-admin'),
					    'std' => '#222222'
						),
					array(
						'id' => 'alt_one_bg_image',
						'type' => 'upload',
						'title' => __('Alt 1 Background Image', 'swift-framework-admin'), 
						'sub_desc' => __('Upload an image for the Alt-1 alternative background here.', 'swift-framework-admin'),
						'desc' => ''
						),
					array(
						'id' => 'alt_one_bg_image_size',
						'type' => 'button_set',
						'title' => __('Alt 1 Background Size', 'swift-framework-admin'), 
						'sub_desc' => __('If you are using an image rather than a pattern, select cover to make the image cover the background.', 'swift-framework-admin'),
						'desc' => '',
						'options' => array('cover' => 'Cover','auto' => 'Auto'),
						'std' => 'auto'
						),
					array(
						'id' => 'alt_divide_1',
						'type' => 'divide'
						),
					array(
					    'id' => 'alt_two_bg_color',
					    'type' => 'color',
					    'title' => __('Alt 2 Background Color', 'swift-framework-admin'), 
					    'sub_desc' => __('The background color for the Alt-2 alternative background.', 'swift-framework-admin'),
					    'std' => '#FFFFFF'
						),
					array(
					    'id' => 'alt_two_text_color',
					    'type' => 'color',
					    'title' => __('Alt 2 Text Color', 'swift-framework-admin'), 
					    'sub_desc' => __('The text color for the Alt-2 alternative background.', 'swift-framework-admin'),
					    'std' => '#222222'
						),
					array(
						'id' => 'alt_two_bg_image',
						'type' => 'upload',
						'title' => __('Alt 2 Background Image', 'swift-framework-admin'), 
						'sub_desc' => __('Upload an image for the Alt-2 alternative background here.', 'swift-framework-admin'),
						'desc' => ''
						),
					array(
						'id' => 'alt_two_bg_image_size',
						'type' => 'button_set',
						'title' => __('Alt 2 Background Size', 'swift-framework-admin'), 
						'sub_desc' => __('If you are using an image rather than a pattern, select cover to make the image cover the background.', 'swift-framework-admin'),
						'desc' => '',
						'options' => array('cover' => 'Cover','auto' => 'Auto'),
						'std' => 'auto'
						),
					array(
						'id' => 'alt_divide_2',
						'type' => 'divide'
						),
					array(
					    'id' => 'alt_three_bg_color',
					    'type' => 'color',
					    'title' => __('Alt 3 Background Color', 'swift-framework-admin'), 
					    'sub_desc' => __('The background color for the Alt-3 alternative background.', 'swift-framework-admin'),
					    'std' => '#FFFFFF'
						),
					array(
					    'id' => 'alt_three_text_color',
					    'type' => 'color',
					    'title' => __('Alt 3 Text Color', 'swift-framework-admin'), 
					    'sub_desc' => __('The text color for the Alt-3 alternative background.', 'swift-framework-admin'),
					    'std' => '#222222'
						),
					array(
						'id' => 'alt_three_bg_image',
						'type' => 'upload',
						'title' => __('Alt 3 Background Image', 'swift-framework-admin'), 
						'sub_desc' => __('Upload an image for the Alt-3 alternative background here.', 'swift-framework-admin'),
						'desc' => ''
						),
					array(
						'id' => 'alt_three_bg_image_size',
						'type' => 'button_set',
						'title' => __('Alt 3 Background Size', 'swift-framework-admin'), 
						'sub_desc' => __('If you are using an image rather than a pattern, select cover to make the image cover the background.', 'swift-framework-admin'),
						'desc' => '',
						'options' => array('cover' => 'Cover','auto' => 'Auto'),
						'std' => 'auto'
						),
					array(
						'id' => 'alt_divide_3',
						'type' => 'divide'
						),
					array(
					    'id' => 'alt_four_bg_color',
					    'type' => 'color',
					    'title' => __('Alt 4 Background Color', 'swift-framework-admin'), 
					    'sub_desc' => __('The background color for the Alt-4 alternative background.', 'swift-framework-admin'),
					    'std' => '#FFFFFF'
						),
					array(
					    'id' => 'alt_four_text_color',
					    'type' => 'color',
					    'title' => __('Alt 4 Text Color', 'swift-framework-admin'), 
					    'sub_desc' => __('The text color for the Alt-4 alternative background.', 'swift-framework-admin'),
					    'std' => '#222222'
						),
					array(
						'id' => 'alt_four_bg_image',
						'type' => 'upload',
						'title' => __('Alt 4 Background Image', 'swift-framework-admin'), 
						'sub_desc' => __('Upload an image for the Alt-4 alternative background here.', 'swift-framework-admin'),
						'desc' => ''
						),
					array(
						'id' => 'alt_four_bg_image_size',
						'type' => 'button_set',
						'title' => __('Alt 4 Background Size', 'swift-framework-admin'), 
						'sub_desc' => __('If you are using an image rather than a pattern, select cover to make the image cover the background.', 'swift-framework-admin'),
						'desc' => '',
						'options' => array('cover' => 'Cover','auto' => 'Auto'),
						'std' => 'auto'
						),
					array(
						'id' => 'alt_divide_4',
						'type' => 'divide'
						),
					array(
					    'id' => 'alt_five_bg_color',
					    'type' => 'color',
					    'title' => __('Alt 5 Background Color', 'swift-framework-admin'), 
					    'sub_desc' => __('The background color for the Alt-5 alternative background.', 'swift-framework-admin'),
					    'std' => '#FFFFFF'
						),
					array(
					    'id' => 'alt_five_text_color',
					    'type' => 'color',
					    'title' => __('Alt 5 Text Color', 'swift-framework-admin'), 
					    'sub_desc' => __('The text color for the Alt-5 alternative background.', 'swift-framework-admin'),
					    'std' => '#222222'
						),
					array(
						'id' => 'alt_five_bg_image',
						'type' => 'upload',
						'title' => __('Alt 5 Background Image', 'swift-framework-admin'), 
						'sub_desc' => __('Upload an image for the Alt-5 alternative background here.', 'swift-framework-admin'),
						'desc' => ''
						),
					array(
						'id' => 'alt_five_bg_image_size',
						'type' => 'button_set',
						'title' => __('Alt 5 Background Size', 'swift-framework-admin'), 
						'sub_desc' => __('If you are using an image rather than a pattern, select cover to make the image cover the background.', 'swift-framework-admin'),
						'desc' => '',
						'options' => array('cover' => 'Cover','auto' => 'Auto'),
						'std' => 'auto'
						),
					array(
						'id' => 'alt_divide_5',
						'type' => 'divide'
						),
					array(
					    'id' => 'alt_six_bg_color',
					    'type' => 'color',
					    'title' => __('Alt 6 Background Color', 'swift-framework-admin'), 
					    'sub_desc' => __('The background color for the Alt-6 alternative background.', 'swift-framework-admin'),
					    'std' => '#FFFFFF'
						),
					array(
					    'id' => 'alt_six_text_color',
					    'type' => 'color',
					    'title' => __('Alt 6 Text Color', 'swift-framework-admin'), 
					    'sub_desc' => __('The text color for the Alt-6 alternative background.', 'swift-framework-admin'),
					    'std' => '#222222'
						),
					array(
						'id' => 'alt_six_bg_image',
						'type' => 'upload',
						'title' => __('Alt 6 Background Image', 'swift-framework-admin'), 
						'sub_desc' => __('Upload an image for the Alt-6 alternative background here.', 'swift-framework-admin'),
						'desc' => ''
						),
					array(
						'id' => 'alt_six_bg_image_size',
						'type' => 'button_set',
						'title' => __('Alt 6 Background Size', 'swift-framework-admin'), 
						'sub_desc' => __('If you are using an image rather than a pattern, select cover to make the image cover the background.', 'swift-framework-admin'),
						'desc' => '',
						'options' => array('cover' => 'Cover','auto' => 'Auto'),
						'std' => 'auto'
						),
					array(
						'id' => 'alt_divide_6',
						'type' => 'divide'
						),
					array(
					    'id' => 'alt_seven_bg_color',
					    'type' => 'color',
					    'title' => __('Alt 7 Background Color', 'swift-framework-admin'), 
					    'sub_desc' => __('The background color for the Alt-7 alternative background.', 'swift-framework-admin'),
					    'std' => '#FFFFFF'
						),
					array(
					    'id' => 'alt_seven_text_color',
					    'type' => 'color',
					    'title' => __('Alt 7 Text Color', 'swift-framework-admin'), 
					    'sub_desc' => __('The text color for the Alt-7 alternative background.', 'swift-framework-admin'),
					    'std' => '#222222'
						),
					array(
						'id' => 'alt_seven_bg_image',
						'type' => 'upload',
						'title' => __('Alt 7 Background Image', 'swift-framework-admin'), 
						'sub_desc' => __('Upload an image for the Alt-7 alternative background here.', 'swift-framework-admin'),
						'desc' => ''
						),
					array(
						'id' => 'alt_seven_bg_image_size',
						'type' => 'button_set',
						'title' => __('Alt 7 Background Size', 'swift-framework-admin'), 
						'sub_desc' => __('If you are using an image rather than a pattern, select cover to make the image cover the background.', 'swift-framework-admin'),
						'desc' => '',
						'options' => array('cover' => 'Cover','auto' => 'Auto'),
						'std' => 'auto'
						),
					array(
						'id' => 'alt_divide_7',
						'type' => 'divide'
						),
					array(
					    'id' => 'alt_eight_bg_color',
					    'type' => 'color',
					    'title' => __('Alt 8 Background Color', 'swift-framework-admin'), 
					    'sub_desc' => __('The background color for the Alt-8 alternative background.', 'swift-framework-admin'),
					    'std' => '#FFFFFF'
						),
					array(
					    'id' => 'alt_eight_text_color',
					    'type' => 'color',
					    'title' => __('Alt 8 Text Color', 'swift-framework-admin'), 
					    'sub_desc' => __('The text color for the Alt-8 alternative background.', 'swift-framework-admin'),
					    'std' => '#222222'
						),
					array(
						'id' => 'alt_eight_bg_image',
						'type' => 'upload',
						'title' => __('Alt 8 Background Image', 'swift-framework-admin'), 
						'sub_desc' => __('Upload an image for the Alt-8 alternative background here.', 'swift-framework-admin'),
						'desc' => ''
						),
					array(
						'id' => 'alt_eight_bg_image_size',
						'type' => 'button_set',
						'title' => __('Alt 8 Background Size', 'swift-framework-admin'), 
						'sub_desc' => __('If you are using an image rather than a pattern, select cover to make the image cover the background.', 'swift-framework-admin'),
						'desc' => '',
						'options' => array('cover' => 'Cover','auto' => 'Auto'),
						'std' => 'auto'
						),
					array(
						'id' => 'alt_divide_8',
						'type' => 'divide'
						),
					array(
					    'id' => 'alt_nine_bg_color',
					    'type' => 'color',
					    'title' => __('Alt 9 Background Color', 'swift-framework-admin'), 
					    'sub_desc' => __('The background color for the Alt-9 alternative background.', 'swift-framework-admin'),
					    'std' => '#FFFFFF'
						),
					array(
					    'id' => 'alt_nine_text_color',
					    'type' => 'color',
					    'title' => __('Alt 9 Text Color', 'swift-framework-admin'), 
					    'sub_desc' => __('The text color for the Alt-9 alternative background.', 'swift-framework-admin'),
					    'std' => '#222222'
						),
					array(
						'id' => 'alt_nine_bg_image',
						'type' => 'upload',
						'title' => __('Alt 9 Background Image', 'swift-framework-admin'), 
						'sub_desc' => __('Upload an image for the Alt-9 alternative background here.', 'swift-framework-admin'),
						'desc' => ''
						),
					array(
						'id' => 'alt_nine_bg_image_size',
						'type' => 'button_set',
						'title' => __('Alt 9 Background Size', 'swift-framework-admin'), 
						'sub_desc' => __('If you are using an image rather than a pattern, select cover to make the image cover the background.', 'swift-framework-admin'),
						'desc' => '',
						'options' => array('cover' => 'Cover','auto' => 'Auto'),
						'std' => 'auto'
						),
					array(
						'id' => 'alt_divide_9',
						'type' => 'divide'
						),
					array(
					    'id' => 'alt_ten_bg_color',
					    'type' => 'color',
					    'title' => __('Alt 10 Background Color', 'swift-framework-admin'), 
					    'sub_desc' => __('The background color for the Alt-10 alternative background.', 'swift-framework-admin'),
					    'std' => '#FFFFFF'
						),
					array(
					    'id' => 'alt_ten_text_color',
					    'type' => 'color',
					    'title' => __('Alt 10 Text Color', 'swift-framework-admin'), 
					    'sub_desc' => __('The text color for the Alt-10 alternative background.', 'swift-framework-admin'),
					    'std' => '#222222'
						),
					array(
						'id' => 'alt_ten_bg_image',
						'type' => 'upload',
						'title' => __('Alt 10 Background Image', 'swift-framework-admin'), 
						'sub_desc' => __('Upload an image for the Alt-10 alternative background here.', 'swift-framework-admin'),
						'desc' => ''
						),
					array(
						'id' => 'alt_ten_bg_image_size',
						'type' => 'button_set',
						'title' => __('Alt 10 Background Size', 'swift-framework-admin'), 
						'sub_desc' => __('If you are using an image rather than a pattern, select cover to make the image cover the background.', 'swift-framework-admin'),
						'desc' => '',
						'options' => array('cover' => 'Cover','auto' => 'Auto'),
						'std' => 'auto'
						)
					)
				);
   	$sections[] = array(
   					'icon' => 'list',
   					'icon_class' => 'fa-lg',
   					'title' => __('Archive/Category Options', 'swift-framework-admin'),
   					'desc' => __('<p class="description">These are the options for the archive/category pages.</p>', 'swift-framework-admin'),
   					'fields' => array(
   						array(
   							'id' => 'archive_sidebar_config',
   							'type' => 'select',
   							'title' => __('Sidebar Config', 'swift-framework-admin'),
   							'sub_desc' => "Choose the sidebar configuration for the archive/category pages.",
   							'options' => array(
   								'no-sidebars'		=> 'No Sidebars',
   								'left-sidebar'		=> 'Left Sidebar',
   								'right-sidebar'		=> 'Right Sidebar',
   								'both-sidebars'		=> 'Both Sidebars'
   								),
   							'desc' => '',
   							'std' => 'right-sidebar'
   							),
   						array(
   							'id' => 'archive_sidebar_left',
   							'type' => 'select',
   							'title' => __('Left Sidebar', 'swift-framework-admin'),
   							'sub_desc' => "Choose the left sidebar for Left/Both sidebar configs.",
   							'options' => sf_sidebars_array(),
   							'desc' => '',
   							'std' => 'Sidebar-1'
   							),
   						array(
   							'id' => 'archive_sidebar_right',
   							'type' => 'select',
   							'title' => __('Right Sidebar', 'swift-framework-admin'),
   							'sub_desc' => "Choose the left sidebar for Right/Both sidebar configs.",
   							'options' => sf_sidebars_array(),
   							'desc' => '',
   							'std' => 'Sidebar-1'
   							),
   						array(
   							'id' => 'archive_display_type',
   							'type' => 'select',
   							'title' => __('Display Type', 'swift-framework-admin'),
   							'sub_desc' => "Select the display type. Note: Masonry (Full Width) is only available when the sidebar config is set to no sidebars.",
   							'options' => array(
   								'standard'		=> 'Standard',
   								'mini'			=> 'Mini',
   								'masonry'		=> 'Masonry',
   								'masonry-fw'	=> 'Masonry (Full Width)'
   								),
   							'desc' => '',
   							'std' => 'masonry'
   							),
   						array(
   							'id' => 'archive_divide_a',
   							'type' => 'divide'
   							),
   						array(
   							'id' => 'portfolio_archive_display_type',
   							'type' => 'select',
   							'title' => __('Portfolio Archive Display Type', 'swift-framework-admin'),
   							'sub_desc' => "Select the display type.",
   							'options' => array(
   								'standard'		=> 'Standard',
   								'gallery'		=> 'Gallery'
   								),
   							'desc' => '',
   							'std' => 'standard'
   							),
   						array(
   							'id' => 'portfolio_archive_columns',
   							'type' => 'select',
   							'title' => __('Portfolio Archive Columns', 'swift-framework-admin'),
   							'sub_desc' => "Select the number of columns for the portfolio archive.",
   							'options' => array(
   								'1'		=> '1',
   								'2'		=> '2',
   								'3'		=> '3',
   								'4'		=> '4'
   								),
   							'desc' => '',
   							'std' => '4'
   							)
   						)
   					);
    $sections[] = array(
    				'icon' => 'font',
    				'icon_class' => 'fa-lg',
    				'title' => __('Font Options', 'swift-framework-admin'),
    				'desc' => __('<p class="description">These are the options for fonts used within the theme. At the bottom of the panel you will find the Typography preview.</p>', 'swift-framework-admin'),
    				'fields' => array(
    					array(
    						'id' => 'google_font_subset',
    						'type' => 'multi_select',
    						'title' => __('Google Font Subset', 'swift-framework-admin'), 
    						'sub_desc' => __('If you are using Google Fonts, and need to use a subset, then please choose it here. Ensure that your chosen font(s) support this subset. NOTE: Hold CMD/CTRL and click to select multiple subsets.', 'swift-framework-admin'),
    						'desc' => '',
    						'options' => array('none' => 'None', 'latin' => 'Latin', 'latin-ext' => 'Latin Extended', 'greek' => 'Greek', 'greek-ext' => 'Greek Extended', 'cyrillic' => 'Cyrillic Extended'),
    						'std' => 'none'
    						),
    					array(
    						'id' => 'body_font_option',
    						'type' => 'button_set',
    						'title' => __('Body Font', 'swift-framework-admin'), 
    						'sub_desc' => __('Choose the type of font that you want to use for the body text.', 'swift-framework-admin'),
    						'desc' => '',
    						'options' => array('default' => 'Default', 'standard' => 'Standard','google' => 'Google', 'fontdeck' => 'FontDeck'),
    						'std' => 'default'
    						),
    					array(
    						'id' => 'web_body_font',
    						'type' => 'select',
    						'title' => __('Body Standard Font', 'swift-framework-admin'), 
    						'sub_desc' => __('The font that is used as the body text and other small text throughout the theme.', 'swift-framework-admin'),
    						'desc' => '',
    						'options' => array(
    										'Arial' => 'Arial',
    										'Courier New' => 'Courier New',
    										'Georgia' => 'Georgia',
    										'Helvetica' => 'Helvetica',
    										'Lucida Sans' => 'Lucida Sans',
    										'Lucida Sans Unicode' => 'Lucida Sans Unicode',
    										'Myriad Pro' => 'Myriad Pro',
    										'Palatino Linotype' => 'Palatino Linotype',
    										'Tahoma' => 'Tahoma',
    										'Times New Roman' => 'Times New Roman',
    										'Trebuchet MS' => 'Trebuchet MS',
    										'Verdana' => 'Verdana'
    										),
    						'std' => 'Helvetica'
    						),
    					array(
    						'id' => 'google_standard_font',
    						'type' => 'google_webfonts',
    						'title' => __('Standard Google Font', 'swift-framework-admin'), 
    						'sub_desc' => __('The font that is used as the body text and other small text throughout the theme.', 'swift-framework-admin'),
    						'desc' => '',
    						'placeholder' => 'Default Font'
    						),
    					array(
    						'id' => 'fontdeck_standard_font',
    						'type' => 'textarea',
    						'title' => __('Standard FontDeck Font', 'swift-framework-admin'), 
    						'sub_desc' => __('Paste the css here that can be found from step 2 of the FontDeck instructions (<a href="http://dante.swiftideas.net/img/fontdeck_step2.png" class="view" target="_blank">view</a>). NOTE: Make sure you provide the JS code in the box at the bottom for this/all FontDeck fonts you want to use.', 'swift-framework-admin'),
    						'desc' => '',
    						'std' => ''
    						),
    					array(
    						'id' => 'body_font_size',
    						'type' => 'slider',
    						'title' => __('Body Font Size', 'swift-framework-admin'), 
    						'sub_desc' => __('Select the size of the body font.', 'swift-framework-admin'),
    						'desc' => '',
    						'from' => '10',
    						'to' => '100',
    						'step' => '1',
    						'unit' => 'px',
    						'std' => '14'
    						),
    					array(
    						'id' => 'body_font_line_height',
    						'type' => 'slider',
    						'title' => __('Body Font Line Height', 'swift-framework-admin'), 
    						'sub_desc' => __('Select the line height of the body font.', 'swift-framework-admin'),
    						'desc' => '',
    						'from' => '10',
    						'to' => '80',
    						'step' => '1',
    						'unit' => 'px',
    						'std' => '22'
    						),
    					array(
    						'id' => 'font_divide_a',
    						'type' => 'divide'
    						),
    					array(
    						'id' => 'headings_font_option',
    						'type' => 'button_set',
    						'title' => __('Headings Font', 'swift-framework-admin'), 
    						'sub_desc' => __('Choose the type of font that you want to use for the body text.', 'swift-framework-admin'),
    						'desc' => '',
    						'options' => array('default' => 'Default', 'standard' => 'Standard','google' => 'Google', 'fontdeck' => 'FontDeck'),
    						'std' => 'default'
    						),
    					array(
    						'id' => 'web_heading_font',
    						'type' => 'select',
    						'title' => __('Heading Standard Font', 'swift-framework-admin'), 
    						'sub_desc' => __('The font that is used for the headings throughout the theme.', 'swift-framework-admin'),
    						'desc' => '',
    						'options' => array(
    										'Arial' => 'Arial',
    										'Courier New' => 'Courier New',
    										'Georgia' => 'Georgia',
    										'Helvetica' => 'Helvetica',
    										'Lucida Sans' => 'Lucida Sans',
    										'Lucida Sans Unicode' => 'Lucida Sans Unicode',
    										'Myriad Pro' => 'Myriad Pro',
    										'Palatino Linotype' => 'Palatino Linotype',
    										'Tahoma' => 'Tahoma',
    										'Times New Roman' => 'Times New Roman',
    										'Trebuchet MS' => 'Trebuchet MS',
    										'Verdana' => 'Verdana'
    										),
    						'std' => 'Helvetica'
    						),
    					array(
    						'id' => 'google_heading_font',
    						'type' => 'google_webfonts',//doesnt need to be called for callback fields
    						'title' => __('Headings Google Font', 'swift-framework-admin'), 
    						'sub_desc' => __('The font that is used for the headings throughout the theme.', 'swift-framework-admin'),
    						'desc' => ''
    						),
    					array(
    						'id' => 'fontdeck_heading_font',
    						'type' => 'textarea',
    						'title' => __('Heading FontDeck Font', 'swift-framework-admin'), 
    						'sub_desc' => __('Paste the css here that can be found from step 2 of the FontDeck instructions (<a href="http://dante.swiftideas.net/img/fontdeck_step2.png" class="view" target="_blank">view</a>). NOTE: Make sure you provide the JS code in the box at the bottom for this/all FontDeck fonts you want to use.', 'swift-framework-admin'),
    						'desc' => '',
    						'std' => ''
    						),
    					array(
    						'id' => 'h1_font_size',
    						'type' => 'slider',
    						'title' => __('H1 Font Size', 'swift-framework-admin'), 
    						'sub_desc' => __('Select the size of the h1 font.', 'swift-framework-admin'),
    						'desc' => '',
    						'from' => '10',
    						'to' => '60',
    						'step' => '1',
    						'unit' => 'px',
    						'std' => '24'
    						),
    					array(
    						'id' => 'h1_font_line_height',
    						'type' => 'slider',
    						'title' => __('H1 Font Line Height', 'swift-framework-admin'), 
    						'sub_desc' => __('Select the line height of the h1 font.', 'swift-framework-admin'),
    						'desc' => '',
    						'from' => '10',
    						'to' => '100',
    						'step' => '1',
    						'unit' => 'px',
    						'std' => '34'
    						),
    					array(
    						'id' => 'h2_font_size',
    						'type' => 'slider',
    						'title' => __('H2 Font Size', 'swift-framework-admin'), 
    						'sub_desc' => __('Select the size of the h2 font.', 'swift-framework-admin'),
    						'desc' => '',
    						'from' => '10',
    						'to' => '60',
    						'step' => '1',
    						'unit' => 'px',
    						'std' => '20'
    						),
    					array(
    						'id' => 'h2_font_line_height',
    						'type' => 'slider',
    						'title' => __('H2 Font Line Height', 'swift-framework-admin'), 
    						'sub_desc' => __('Select the line height of the h2 font.', 'swift-framework-admin'),
    						'desc' => '',
    						'from' => '10',
    						'to' => '100',
    						'step' => '1',
    						'unit' => 'px',
    						'std' => '30'
    						),
    					array(
    						'id' => 'h3_font_size',
    						'type' => 'slider',
    						'title' => __('H3 Font Size', 'swift-framework-admin'), 
    						'sub_desc' => __('Select the size of the h3 font.', 'swift-framework-admin'),
    						'desc' => '',
    						'from' => '10',
    						'to' => '60',
    						'step' => '1',
    						'unit' => 'px',
    						'std' => '18'
    						),
    					array(
    						'id' => 'h3_font_line_height',
    						'type' => 'slider',
    						'title' => __('H3 Font Line Height', 'swift-framework-admin'), 
    						'sub_desc' => __('Select the line height of the h3 font.', 'swift-framework-admin'),
    						'desc' => '',
    						'from' => '10',
    						'to' => '100',
    						'step' => '1',
    						'unit' => 'px',
    						'std' => '24'
    						),
    					array(
    						'id' => 'h4_font_size',
    						'type' => 'slider',
    						'title' => __('H4 Font Size', 'swift-framework-admin'), 
    						'sub_desc' => __('Select the size of the h4 font.', 'swift-framework-admin'),
    						'desc' => '',
    						'from' => '10',
    						'to' => '60',
    						'step' => '1',
    						'unit' => 'px',
    						'std' => '16'
    						),
    					array(
    						'id' => 'h4_font_line_height',
    						'type' => 'slider',
    						'title' => __('H4 Font Line Height', 'swift-framework-admin'), 
    						'sub_desc' => __('Select the line height of the h4 font.', 'swift-framework-admin'),
    						'desc' => '',
    						'from' => '10',
    						'to' => '100',
    						'step' => '1',
    						'unit' => 'px',
    						'std' => '20'
    						),
    					array(
    						'id' => 'h5_font_size',
    						'type' => 'slider',
    						'title' => __('H5 Font Size', 'swift-framework-admin'), 
    						'sub_desc' => __('Select the size of the h5 font.', 'swift-framework-admin'),
    						'desc' => '',
    						'from' => '10',
    						'to' => '60',
    						'step' => '1',
    						'unit' => 'px',
    						'std' => '14'
    						),
    					array(
    						'id' => 'h5_font_line_height',
    						'type' => 'slider',
    						'title' => __('H5 Font Line Height', 'swift-framework-admin'), 
    						'sub_desc' => __('Select the line height of the h5 font.', 'swift-framework-admin'),
    						'desc' => '',
    						'from' => '10',
    						'to' => '100',
    						'step' => '1',
    						'unit' => 'px',
    						'std' => '18'
    						),
    					array(
    						'id' => 'h6_font_size',
    						'type' => 'slider',
    						'title' => __('H6 Font Size', 'swift-framework-admin'), 
    						'sub_desc' => __('Select the size of the h6 font.', 'swift-framework-admin'),
    						'desc' => '',
    						'from' => '10',
    						'to' => '60',
    						'step' => '1',
    						'unit' => 'px',
    						'std' => '12'
    						),
    					array(
    						'id' => 'h6_font_line_height',
    						'type' => 'slider',
    						'title' => __('H6 Font Line Height', 'swift-framework-admin'), 
    						'sub_desc' => __('Select the line height of the h6 font.', 'swift-framework-admin'),
    						'desc' => '',
    						'from' => '10',
    						'to' => '100',
    						'step' => '1',
    						'unit' => 'px',
    						'std' => '16'
    						),
    					array(
    						'id' => 'font_preview',
    						'type' => 'font_preview',
    						),
    					array(
    						'id' => 'font_divide_b',
    						'type' => 'divide'
    						),
    					array(
    						'id' => 'menu_font_option',
    						'type' => 'button_set',
    						'title' => __('Menu Font', 'swift-framework-admin'), 
    						'sub_desc' => __('Choose the type of font that you want to use for the menu text.', 'swift-framework-admin'),
    						'desc' => '',
    						'options' => array('default' => 'Default', 'standard' => 'Standard','google' => 'Google', 'fontdeck' => 'FontDeck'),
    						'std' => 'default'
    						),
    					array(
    						'id' => 'web_menu_font',
    						'type' => 'select',
    						'title' => __('Menu Standard Font', 'swift-framework-admin'), 
    						'sub_desc' => __('The font that is used for the menu.', 'swift-framework-admin'),
    						'desc' => '',
    						'options' => array(
    										'Arial' => 'Arial',
    										'Courier New' => 'Courier New',
    										'Georgia' => 'Georgia',
    										'Helvetica' => 'Helvetica',
    										'Lucida Sans' => 'Lucida Sans',
    										'Lucida Sans Unicode' => 'Lucida Sans Unicode',
    										'Myriad Pro' => 'Myriad Pro',
    										'Palatino Linotype' => 'Palatino Linotype',
    										'Tahoma' => 'Tahoma',
    										'Times New Roman' => 'Times New Roman',
    										'Trebuchet MS' => 'Trebuchet MS',
    										'Verdana' => 'Verdana'
    										),
    						'std' => 'Helvetica'
    						),
    					array(
    						'id' => 'google_menu_font',
    						'type' => 'google_webfonts',//doesnt need to be called for callback fields
    						'title' => __('Menu Google Font', 'swift-framework-admin'), 
    						'sub_desc' => __('The font that is used for the menu.', 'swift-framework-admin'),
    						'desc' => ''
    						),
    					array(
    						'id' => 'fontdeck_menu_font',
    						'type' => 'textarea',
    						'title' => __('Menu FontDeck Font', 'swift-framework-admin'), 
    						'sub_desc' => __('Paste the css here that can be found from step 2 of the FontDeck instructions (<a href="http://dante.swiftideas.net/img/fontdeck_step2.png" class="view" target="_blank">view</a>). NOTE: Make sure you provide the JS code in the box at the bottom for this/all FontDeck fonts you want to use.', 'swift-framework-admin'),
    						'desc' => '',
    						'std' => ''
    						),
    					array(
    						'id' => 'menu_font_size',
    						'type' => 'slider',
    						'title' => __('Menu Font Size', 'swift-framework-admin'), 
    						'sub_desc' => __('Select the size of the menu font.', 'swift-framework-admin'),
    						'desc' => '',
    						'from' => '10',
    						'to' => '28',
    						'step' => '1',
    						'unit' => 'px',
    						'std' => '14'
    						),
    					array(
    						'id' => 'fontdeck_js',
    						'type' => 'textarea',
    						'title' => __('FontDeck JS Code', 'swift-framework-admin'), 
    						'sub_desc' => __('Paste the js code here that can be found from step 1 of the FontDeck instructions (<a href="http://dante.swiftideas.net/img/fontdeck_step1.png" class="view" target="_blank">view</a>).', 'swift-framework-admin'),
    						'desc' => '',
    						'std' => ''
    						)
    					)
    				);

   	$sections[] = array(
   					'icon' => 'th',
   					'icon_class' => 'fa-bold',
   					'title' => __('Blog Options', 'swift-framework-admin'),
   					'desc' => __('<p class="description">These are the options for the Blog pages/assets.</p>', 'swift-framework-admin'),
   					'fields' => array(
   							array(
   								'id' => 'single_author',
   								'type' => 'button_set',
   								'title' => __('Single Author Blog', 'swift-framework-admin'), 
   								'sub_desc' => __('If enabled, the author name will be hidden from the blog/post details in the page builder assets and single details line.', 'swift-framework-admin'),
   								'desc' => '',
   								'options' => array('1' => 'On','0' => 'Off'),
   								'std' => '0'
   								),
   							array(
   								'id' => 'remove_dates',
   								'type' => 'button_set',
   								'title' => __('Remove Dates', 'swift-framework-admin'), 
   								'sub_desc' => __('If enabled, the date will not be included with the post details.', 'swift-framework-admin'),
   								'desc' => '',
   								'options' => array('1' => 'On','0' => 'Off'),
   								'std' => '0'
   								),
   							array(
								'id' => 'related_article_thumb_width',
								'type' => 'text',
								'title' => __('Related Article Thumb Width', 'swift-framework-admin'),
								'sub_desc' => __('Override the width for the related article thumb image here (numeric, no px).', 'swift-framework-admin'),
								'desc' => '',
								'std' => '300',
								'class' => 'mini'
								),
   							array(
   								'id' => 'related_article_thumb_height',
   								'type' => 'text',
   								'title' => __('Related Article Thumb Height', 'swift-framework-admin'),
   								'sub_desc' => __('Override the height for the related article thumb image here (numeric, no px).', 'swift-framework-admin'),
   								'desc' => '',
   								'std' => '225',
   								'class' => 'mini'
   								),
   						)
   					);
   	$sections[] = array(
   					'icon' => 'th',
   					'icon_class' => 'fa-lg',
   					'title' => __('Portfolio Options', 'swift-framework-admin'),
   					'desc' => __('<p class="description">These are the options for the Portfolio pages/assets.</p>', 'swift-framework-admin'),
   					'fields' => array(
   							array(
   								'id' => 'portfolio_page',
   								'type' => 'pages_select',
   								'title' => __('Portfolio Page', 'swift-framework-admin'), 
   								'sub_desc' => __('Select the page that is your portfolio index page. This is used to link to the page from the portfolio detail page.', 'swift-framework-admin'),
   								'desc' => '',
   								'std' => '',
   								'args' => array()
   								),
   							array(
								'id' => 'enable_portfolio_gallery',
								'type' => 'button_set',
								'title' => __('Enable Portfolio Gallery Navigation', 'swift-framework-admin'), 
								'sub_desc' => __('Enable this if you use multiple thumbnail link to lightbox options on your portfolio thumbnails, and would like to browse between the items with left/right navigation.', 'swift-framework-admin'),
								'desc' => '',
								'options' => array('1' => 'On','0' => 'Off'),
								'std' => '0'
								),
   							array(
   								'id' => 'enable_portfolio_stickydetails',
   								'type' => 'button_set',
   								'title' => __('Enable Sticky Item Details', 'swift-framework-admin'), 
   								'sub_desc' => __('Enable the item details to be sticky on desktop when the sidebar is small enough to display completely while scrolling. Only enabled on Full Width Media / Standard portfolio display types.', 'swift-framework-admin'),
   								'desc' => '',
   								'options' => array('1' => 'On','0' => 'Off'),
   								'std' => '0'
   								),
   						)
   					);
	$sections[] = array(
    				'icon' => 'quote-left',
    				'icon_class' => 'fa-lg',
    				'title' => __('Testimonials Options', 'swift-framework-admin'),
    				'desc' => __('<p class="description">These are the options for the Testimonials pages/assets.</p>', 'swift-framework-admin'),
    				'fields' => array(
    						array(
    							'id' => 'testimonial_page',
    							'type' => 'pages_select',
    							'title' => __('Testimonial Page', 'swift-framework-admin'), 
    							'sub_desc' => __('Select the page that is your testimonial index page. This is used to link to the page from various places.', 'swift-framework-admin'),
    							'desc' => '',
    							'std' => '',
    							'args' => array()
    							),
    					)
    				);
    $sections[] = array(
    				'icon' => 'user',
    				'icon_class' => 'fa-lg',
    				'title' => __('Jobs Options', 'swift-framework-admin'),
    				'desc' => __('<p class="description">These are the options for the Jobs pages/assets.</p>', 'swift-framework-admin'),
    				'fields' => array(
    						array(
    							'id' => 'jobs_page',
    							'type' => 'pages_select',
    							'title' => __('Jobs Page', 'swift-framework-admin'), 
    							'sub_desc' => __('Select the page that is your jobs index page. This is used to link to the page from various places.', 'swift-framework-admin'),
    							'desc' => '',
    							'std' => '',
    							'args' => array()
    							),
    					)
    				);
    $sections[] = array(
    				'icon' => 'shopping-cart',
    				'icon_class' => 'fa-lg',
    				'title' => __('WooCommerce Options', 'swift-framework-admin'),
    				'desc' => __('<p class="description">These are the options for the WooCommerce pages.</p>', 'swift-framework-admin'),
    				'fields' => array(
    						array(
    							'id' => 'product_overlay_transition',
    							'type' => 'button_set',
    							'title' => __('Product Overlay Transition', 'swift-framework-admin'), 
    							'sub_desc' => __('Choose whether you would like the product overlay transition to be enabled.', 'swift-framework-admin'),
    							'desc' => '',
    							'options' => array('1' => 'On','0' => 'Off'),
    							'std' => '1'
    							),
    						array(
    							'id' => 'overlay_transition_type',
    							'type' => 'button_set',
    							'title' => __('Product Overlay Transition Type', 'swift-framework-admin'), 
    							'sub_desc' => __('Choose what type of transition between product images on hover you would like.', 'swift-framework-admin'),
    							'desc' => '',
    							'options' => array('slideup' => 'Slide Up', 'slideleft' => 'Slide Left', 'fade' => 'Fade'),
    							'std' => 'slideup'
    							),
    						array(
    							'id' => 'enable_pb_product_pages',
    							'type' => 'button_set',
    							'title' => __('Page Builder on Product Pages', 'swift-framework-admin'), 
    							'sub_desc' => __('Choose whether you would like the page builder to be enabled on product pages or not. If it is enabled, then the description accordion will use the "Short Description" content, and the page builder content will appear below the images/details area.', 'swift-framework-admin'),
    							'desc' => '',
    							'options' => array('1' => 'On','0' => 'Off'),
    							'std' => '0'
    							),
    						array(
    							'id' => 'enable_catalog_mode',
    							'type' => 'button_set',
    							'title' => __('Catalog Mode', 'swift-framework-admin'), 
    							'sub_desc' => __('Enable this setting to set the products into catalog mode, with no cart or checkout process.', 'swift-framework-admin'),
    							'desc' => '',
    							'options' => array('1' => 'On','0' => 'Off'),
    							'std' => '0'
    							),
    						array(
    						    'id'        => 'new_badge',
    						    'type'      => 'text',
    						    'title'     => __('New Badge', 'redux-framework-demo'),
    						    'sub_desc'  => __('The amount of time in days that the "New" badge will display on products. Set this to 0 to disable the badge.', 'redux-framework-demo'),
    						    'std'   => '7',
    						),
    						array(
    							'id' => 'enable_default_tabs',
    							'type' => 'button_set',
    							'title' => __('Product Description Tabs Mode', 'swift-framework-admin'), 
    							'sub_desc' => __('Enable this setting to revert to the default product description styling tabs - this will allow you to use extensions that add extra tabs to the product tabs.', 'swift-framework-admin'),
    							'desc' => '',
    							'options' => array('1' => 'On','0' => 'Off'),
    							'std' => '0'
    							),
    						array(
    							'id' => 'enable_product_zoom',
    							'type' => 'button_set',
    							'title' => __('Enable image zoom on product images', 'swift-framework-admin'), 
    							'sub_desc' => __('Choose whether you would like to enable product image zoom functionality on the product detail page images.', 'swift-framework-admin'),
    							'desc' => '',
    							'options' => array('1' => 'On','0' => 'Off'),
    							'std' => '0'
    							),
    						array(
    							'id' => 'woo_sidebar_config',
    							'type' => 'select',
    							'title' => __('WooCommerce Sidebar Config', 'swift-framework-admin'),
    							'sub_desc' => "Choose the sidebar config for WooCommerce shop/category pages.",
    							'options' => array(
    								'no-sidebars'		=> 'No Sidebars',
    								'left-sidebar'		=> 'Left Sidebar',
    								'right-sidebar'		=> 'Right Sidebar',
    								'both-sidebars'		=> 'Both Sidebars'
    							),
    							'desc' => '',
    							'std' => 'no-sidebars'
    							),
    						array(
    							'id' => 'woo_left_sidebar',
    							'type' => 'select',
    							'title' => __('WooCommerce Left Sidebar', 'swift-framework-admin'),
    							'sub_desc' => "Choose the left sidebar for WooCommerce shop/category pages.",
    							'options' => sf_sidebars_array(),
    							'desc' => '',
    							'std' => 'woocommerce-sidebar'
    							),
    						array(
    							'id' => 'woo_right_sidebar',
    							'type' => 'select',
    							'title' => __('WooCommerce Right Sidebar', 'swift-framework-admin'),
    							'sub_desc' => "Choose the right sidebar for WooCommerce shop/category pages.",
    							'options' => sf_sidebars_array(),
    							'desc' => '',
    							'std' => 'woocommerce-sidebar'
    							),
    						array(
    							'id' => 'woo_divide_0',
    							'type' => 'divide'
    							),
    						array(
    							'id' => 'woo_show_page_heading',
    							'type' => 'button_set',
    							'title' => __('Default Show Page Heading', 'swift-framework-admin'), 
    							'sub_desc' => __('Show page title on shop/category WooCommerce page.', 'swift-framework-admin'),
    							'desc' => '',
    							'options' => array('1' => 'On','0' => 'Off'),
    							'std' => '1'
    							),
    						array(
    							'id' => 'woo_page_heading_style',
    							'type' => 'select',
    							'title' => __('WooCommerce Page Heading Style', 'swift-framework-admin'),
    							'sub_desc' => "Choose the page heading style for the shop/category WooCommerce pages.",
    							'options' => array(
    								'standard'		=> 'Standard',
    								'fancy'		=> 'Fancy'
    								),
    							'desc' => '',
    							'std' => 'standard'
    							),
    						array(
    							'id' => 'woo_page_heading_bg_alt',
    							'type' => 'select',
    							'title' => __('WooCommerce Page Heading Background', 'swift-framework-admin'),
    							'sub_desc' => "Choose the alt background configuration for the shop/category WooCommerce page headings.",
    							'options' => array(
    								'none'		=> 'None',
    								'alt-one'		=> 'Alt 1',
    								'alt-two'		=> 'Alt 2',
    								'alt-three'		=> 'Alt 3',
    								'alt-four'		=> 'Alt 4',
    								'alt-five'		=> 'Alt 5',
    								'alt-six'		=> 'Alt 6',
    								'alt-seven'		=> 'Alt 7',
    								'alt-eight'		=> 'Alt 8',
    								'alt-nine'		=> 'Alt 9',
    								'alt-ten'		=> 'Alt 10'
    								),
    							'desc' => '',
    							'std' => 'none'
    							),
    						array(
    							'id' => 'woo_page_heading_image',
    							'type' => 'upload',
    							'title' => __('WooCommerce Fancy Heading Background Image', 'swift-framework-admin'), 
    							'sub_desc' => __('Upload the fancy heading background image for WooCommerce page heading (Fancy Heading Only).', 'swift-framework-admin'),
    							'desc' => ''
    							),
    						array(
    							'id' => 'woo_page_heading_text_style',
    							'type' => 'select',
    							'title' => __('WooCommerce Fancy Heading Text Style', 'swift-framework-admin'),
    							'sub_desc' => "Choose the text style for the WooCommerce page heading (Fancy Heading Only).",
    							'options' => array(
    								'light'		=> 'Light',
    								'dark'		=> 'Dark'
    								),
    							'desc' => '',
    							'std' => 'light'
    							),
    						array(
    							'id' => 'woo_divide_1',
    							'type' => 'divide'
    							),
    						array(
    							'id' => 'default_product_sidebar_config',
    							'type' => 'select',
    							'title' => __('Default Product Sidebar Config', 'swift-framework-admin'),
    							'sub_desc' => "Choose the sidebar config for WooCommerce shop/category pages.",
    							'options' => array(
    								'no-sidebars'		=> 'No Sidebars',
    								'left-sidebar'		=> 'Left Sidebar',
    								'right-sidebar'		=> 'Right Sidebar',
    								'both-sidebars'		=> 'Both Sidebars'
    							),
    							'desc' => '',
    							'std' => 'no-sidebars'
    							),
    						array(
    							'id' => 'default_product_left_sidebar',
    							'type' => 'select',
    							'title' => __('Default Product Left Sidebar', 'swift-framework-admin'),
    							'sub_desc' => "Choose the default left sidebar for WooCommerce product pages.",
    							'options' => sf_sidebars_array(),
    							'desc' => '',
    							'std' => 'woocommerce-sidebar'
    							),
    						array(
    							'id' => 'default_product_right_sidebar',
    							'type' => 'select',
    							'title' => __('Default Product Right Sidebar', 'swift-framework-admin'),
    							'sub_desc' => "Choose the default right sidebar for WooCommerce product pages.",
    							'options' => sf_sidebars_array(),
    							'desc' => '',
    							'std' => 'woocommerce-sidebar'
    							),
    						array(
    							'id' => 'woo_divide_2',
    							'type' => 'divide'
    							),
    						array(
    							'id' => 'checkout_new_account_text',
    							'type' => 'textarea',
    							'title' => __('New account text', 'swift-framework-admin'), 
    							'sub_desc' => __('This text appears in the sign in / sign up area of the checkout process.', 'swift-framework-admin'),
    							'desc' => '',
    							'std' => 'Creating an account with Dante is quick and easy, and will allow you to move through our checkout quicker. You can also store multiple shipping addresses, gain access to your order history, and much more.'
    							),
    						array(
    							'id' => 'help_bar_text',
    							'type' => 'text',
    							'title' => __('Help Bar Text', 'swift-framework-admin'), 
    							'sub_desc' => __('This text appears in the help bar on account / checkout pages.', 'swift-framework-admin'),
    							'desc' => '',
    							'std' => 'Need help? Call customer services on 0800 123 4567.'
    							),
    						array(
    							'id' => 'email_modal',
    							'type' => 'textarea',
    							'title' => __('Email customer care modal', 'swift-framework-admin'), 
    							'sub_desc' => __('The content that appears in the modal box for the email customer care help link.', 'swift-framework-admin'),
    							'desc' => '',
    							'std' => 'Enter your contact details or email form shortcode here. (Text/HTML/Shortcodes accepted).'
    							),
    						array(
    							'id' => 'shipping_modal',
    							'type' => 'textarea',
    							'title' => __('Shipping information modal', 'swift-framework-admin'), 
    							'sub_desc' => __('The content that appears in the modal box for the shipping information help link.', 'swift-framework-admin'),
    							'desc' => '',
    							'std' => 'Enter your shipping information here. (Text/HTML/Shortcodes accepted).'
    							),
    						array(
    							'id' => 'returns_modal',
    							'type' => 'textarea',
    							'title' => __('Returns & exchange modal', 'swift-framework-admin'),
    							'sub_desc' => __('The content that appears in the modal box for the returns & exchange help link.', 'swift-framework-admin'),
    							'desc' => '',
    							'std' => 'Enter your returns and exchange information here. (Text/HTML/Shortcodes accepted).'
    							),
    						array(
    							'id' => 'faqs_modal',
    							'type' => 'textarea',
    							'title' => __('FAQs modal', 'swift-framework-admin'), 
    							'sub_desc' => __('The content that appears in the modal box for the faqs help link.', 'swift-framework-admin'),
    							'desc' => '',
    							'std' => 'Enter your faqs here. (Text/HTML/Shortcodes accepted).'
    							),
    						array(
    							'id' => 'feedback_modal',
    							'type' => 'textarea',
    							'title' => __('Feedback modal', 'swift-framework-admin'), 
    							'sub_desc' => __('The content that appears in the modal box for the leave feedback link.', 'swift-framework-admin'),
    							'desc' => '',
    							'std' => 'Enter your feedback modal content here. (Text/HTML/Shortcodes accepted).'
    							),
    					)
    				);			
    $sections[] = array(
    				'icon' => 'bolt',
    				'icon_class' => 'fa-lg',
    				'title' => __('Slider Options', 'swift-framework-admin'),
    				'desc' => __('<p class="description">These are the options for the slider assets.</p>', 'swift-framework-admin'),
    				'fields' => array(
    						array(
    							'id' => 'slider_slideshowSpeed',
    							'type' => 'slider',
    							'title' => __('Slideshow Speed (ms)', 'swift-framework-admin'),
    							'sub_desc' => "The speed at which the slider rotates. Default value: 7000",
    							'from' => '0',
    							'to' => '12000',
    							'step' => '50',
    							'unit' => '',
    							'std' => '6000'
    							),
    						array(
    						    'id' => 'slider_animationSpeed',
    						    'type' => 'slider',
    						    'title' => __('Slider Animation Speed (ms)', 'redux-framework-demo'),
    						    'sub_desc' => __('The speed in which the transition animation takes. Default value: 600', 'redux-framework-demo'),
    						    'from' => '0',
    						    'to' => '2000',
    						    'step' => '50',
    						    'unit' => '',
    						    'std' => '500'
    						),
    						array(
    							'id' => 'slider_autoplay',
    							'type' => 'button_set',
    							'title' => __('Auto play', 'swift-framework-admin'), 
    							'sub_desc' => __("If you enable this option, then the sliders will auto rotate.", 'swift-framework-admin'),
    							'desc' => '',
    							'options' => array('1' => 'On','0' => 'Off'),
    							'default' => '0'
    						),
    					)
    				);	
    $sections[] = array(
    				'icon' => 'twitter',
    				'icon_class' => 'fa-lg',
    				'title' => __('Social Profiles', 'swift-framework-admin'),
    				'desc' => __('<p class="description">These are the fields that power the social shortcode. If you include a link/username here, then the icon will be included in the shortcodes output.</p>', 'swift-framework-admin'),
    				'fields' => array(
    						array(
    							'id' => 'twitter_username',
    							'type' => 'text',
    							'title' => __('Twitter', 'swift-framework-admin'),
    							'sub_desc' => "Your Twitter username (no @).",
    							'desc' => '',
    							'std' => ''
    							),
    						array(
    							'id' => 'facebook_page_url',
    							'type' => 'text',
    							'title' => __('Facebook', 'swift-framework-admin'),
    							'sub_desc' => "Your facebook page/profile url",
    							'desc' => '',
    							'std' => ''
    							),
    						array(
    							'id' => 'dribbble_username',
    							'type' => 'text',
    							'title' => __('Dribbble', 'swift-framework-admin'),
    							'sub_desc' => "Your Dribbble username",
    							'desc' => '',
    							'std' => ''
    							),
    						array(
    							'id' => 'vimeo_username',
    							'type' => 'text',
    							'title' => __('Vimeo', 'swift-framework-admin'),
    							'sub_desc' => "Your Vimeo username",
    							'desc' => '',
    							'std' => ''
    							),
    						array(
    							'id' => 'tumblr_username',
    							'type' => 'text',
    							'title' => __('Tumblr', 'swift-framework-admin'),
    							'sub_desc' => "Your Tumblr username",
    							'desc' => '',
    							'std' => ''
    							),
    						array(
    							'id' => 'skype_username',
    							'type' => 'text',
    							'title' => __('Skype', 'swift-framework-admin'),
    							'sub_desc' => "Your Skype username",
    							'desc' => '',
    							'std' => ''
    							),
    						array(
    							'id' => 'linkedin_page_url',
    							'type' => 'text',
    							'title' => __('LinkedIn', 'swift-framework-admin'),
    							'sub_desc' => "Your LinkedIn page/profile url",
    							'desc' => '',
    							'std' => ''
    							),
    						array(
    							'id' => 'googleplus_page_url',
    							'type' => 'text',
    							'title' => __('Google+', 'swift-framework-admin'),
    							'sub_desc' => "Your Google+ page/profile URL",
    							'desc' => '',
    							'std' => ''
    							),
    						array(
    							'id' => 'flickr_page_url',
    							'type' => 'text',
    							'title' => __('Flickr', 'swift-framework-admin'),
    							'sub_desc' => "Your Flickr page url",
    							'desc' => '',
    							'std' => ''
    							),
    						array(
    							'id' => 'youtube_url',
    							'type' => 'text',
    							'title' => __('YouTube', 'swift-framework-admin'),
    							'sub_desc' => "Your YouTube URL",
    							'desc' => '',
    							'std' => ''
    							),
    						array(
    							'id' => 'pinterest_username',
    							'type' => 'text',
    							'title' => __('Pinterest', 'swift-framework-admin'),
    							'sub_desc' => "Your Pinterest username",
    							'desc' => '',
    							'std' => ''
    							),
    						array(
    							'id' => 'foursquare_url',
    							'type' => 'text',
    							'title' => __('Foursquare', 'swift-framework-admin'),
    							'sub_desc' => "Your Foursqaure URL",
    							'desc' => '',
    							'std' => ''
    							),
    						array(
    							'id' => 'instagram_username',
    							'type' => 'text',
    							'title' => __('Instagram', 'swift-framework-admin'),
    							'sub_desc' => "Your Instagram username",
    							'desc' => '',
    							'std' => ''
    							),
    						array(
    							'id' => 'github_url',
    							'type' => 'text',
    							'title' => __('GitHub', 'swift-framework-admin'),
    							'sub_desc' => "Your GitHub URL",
    							'desc' => '',
    							'std' => ''
    							),
    						array(
    							'id' => 'xing_url',
    							'type' => 'text',
    							'title' => __('Xing', 'swift-framework-admin'),
    							'sub_desc' => "Your Xing URL",
    							'desc' => '',
    							'std' => ''
    							),
    						array(
    							'id' => 'behance_url',
    							'type' => 'text',
    							'title' => __('Behance', 'swift-framework-admin'),
    							'sub_desc' => "Your Behance URL",
    							'desc' => '',
    							'std' => ''
    							),
    						array(
    							'id' => 'deviantart_url',
    							'type' => 'text',
    							'title' => __('Deviantart', 'swift-framework-admin'),
    							'sub_desc' => "Your Deviantart URL",
    							'desc' => '',
    							'std' => ''
    							),
    						array(
    							'id' => 'soundcloud_url',
    							'type' => 'text',
    							'title' => __('SoundCloud', 'swift-framework-admin'),
    							'sub_desc' => "Your SoundCloud URL",
    							'desc' => '',
    							'std' => ''
    							),
    						array(
    							'id' => 'rss_url',
    							'type' => 'text',
    							'title' => __('RSS Feed', 'swift-framework-admin'),
    							'sub_desc' => "Your RSS Feed URL",
    							'desc' => '',
    							'std' => ''
    							)
    						
    					)
    				);	
    		                
    $tabs = array();

    if (function_exists('wp_get_theme')) {
        $theme_data = wp_get_theme();
        $item_uri = $theme_data->get('ThemeURI');
        $description = $theme_data->get('Description');
        $author = $theme_data->get('Author');
        $author_uri = $theme_data->get('AuthorURI');
        $version = $theme_data->get('Version');
        $tags = $theme_data->get('Tags');
    }

    global $Redux_Options;
    $Redux_Options = new Redux_Options($sections, $args, $tabs);
}
add_action('init', 'setup_framework_options', 5);

/*
 * 
 * Custom function for the callback referenced above
 *
 */
function my_custom_field($field, $value) {
    print_r($field);
    print_r($value);
}

/*
 * 
 * Custom function for the callback validation referenced above
 *
 */
function validate_callback_function($field, $value, $existing_value) {
    $error = false;
    $value =  'just testing';
    /*
    do your validation
    
    if(something) {
        $value = $value;
    } elseif(somthing else) {
        $error = true;
        $value = $existing_value;
        $field['msg'] = 'your custom error message';
    }
    */
    
    $return['value'] = $value;
    if($error == true) {
        $return['error'] = $field;
    }
    return $return;
}