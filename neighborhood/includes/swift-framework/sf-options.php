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
function add_another_section($sections){
    //$sections = array();
    $sections[] = array(
        'title' => __('A Section added by hook', "swiftframework"),
        'desc' => __('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', "swiftframework"),
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
    //$args['intro_text'] = __('<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', "swiftframework");

    // Add content after the form.
    //$args['footer_text'] = __('<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', "swiftframework");

    // Set footer/credit line.
    //$args['footer_credit'] = __('<p>This text is displayed in the options panel footer across from the WordPress version (where it normally says \'Thank you for creating with WordPress\'). This field accepts all HTML.</p>', "swiftframework");

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
    $args['opt_name'] = 'sf_neighborhood_options';

    // Set a custom menu icon.
    // Redux ships with the glyphicons free icon pack, included in the options folder.
    // Feel free to use them, add your own icons, or leave this blank for the default.
    //$args['menu_icon'] = '';

    // Set a custom title for the options page.
    // Default: Options
    $args['menu_title'] = __('Theme Options', "swiftframework");

    // Set a custom page title for the options page.
    // Default: Options
    $args['page_title'] = __('Theme Options', "swiftframework");
	
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
    $args['page_position'] = 58;

    // Set a custom page icon class (used to override the page icon next to heading)
    //$args['page_icon'] = 'icon-themes';

    // Disable the panel sections showing as submenu items.
    // Default: true
    //$args['allow_sub_menu'] = false;
        
    // Set ANY custom page help tabs, displayed using the new help tab API. Tabs are shown in order of definition.
    $args['help_tabs'][] = array(
        'id' => 'redux-opts-1',
        'title' => __('Theme Information 1', "swiftframework"),
        'content' => __('<p>This is the tab content, HTML is allowed.</p>', "swiftframework")
    );
    $args['help_tabs'][] = array(
        'id' => 'redux-opts-2',
        'title' => __('Theme Information 2', "swiftframework"),
        'content' => __('<p>This is the tab content, HTML is allowed.</p>', "swiftframework")
    );

    // Set the help sidebar for the options page.                                        
    $args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', "swiftframework");
	
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
    
    //$sections[] = array(
    //				'title' => __('Getting Started', "swiftframework"),
    //				'desc' => __('<p class="description">This is the description field for the Section. HTML is allowed</p>', "swiftframework"),
    				//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
    				//You dont have to though, leave it blank for default.
    //				'icon' => Redux_OPTIONS_URL.'img/glyphicons/glyphicons_062_attach.png'
    				//Lets leave this as a blank section, no options just some intro text set above.
    				//'fields' => array()
    //				);
    
    				
    $sections[] = array(
    				'icon' => 'cog',
    				'icon_class' => 'fa-lg',
    				'title' => __('General Options', "swiftframework"),
    				'desc' => __('<p class="description">These are the general options for the theme</p>', "swiftframework"),
    				'fields' => array(
    					array(
    						'id' => 'enable_maintenance',
    						'type' => 'button_set',
    						'title' => __('Enable Maintenance', "swiftframework"), 
    						'sub_desc' => __('Enable the themes maintenance mode.', "swiftframework"),
    						'desc' => '',
    						'options' => array('2' => 'On (Custom Page)', '1' => 'On (Standard)','0' => 'Off',),
    						'std' => '0'
    						),
    					array(
    						'id' => 'maintenance_mode_page',
    						'type' => 'pages_select',
    						'title' => __('Custom Maintenance Mode Page', "swiftframework"), 
    						'sub_desc' => __('Select the page that is your maintenance page, if you would like to show a custom page instead of the standard WordPress message. You should use the Holding Page template for this page.', "swiftframework"),
    						'desc' => '',
    						'std' => '',
    						'args' => array()
    						),
    					array(
    						'id' => 'enable_responsive',
    						'type' => 'button_set',
    						'title' => __('Enable Responsive', "swiftframework"), 
    						'sub_desc' => __('Enable/Disable the responsive behaviour of the theme', "swiftframework"),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '1'
    						),
    					array(
    						'id' => 'page_layout',
    						'type' => 'radio_img',
    						'title' => __('Page Layout', "swiftframework"), 
    						'sub_desc' => __('Select the page layout type', "swiftframework"),
    						'desc' => '',
    						'options' => array(
    										'boxed' => array('title' => 'Boxed', 'img' => Redux_OPTIONS_URL.'img/page-bordered.png'),
    										'fullwidth' => array('title' => 'Full Width', 'img' => Redux_OPTIONS_URL.'img/page-fullwidth.png')
    											),
    						'std' => 'fullwidth'
    						),			
    					array(
    						'id' => 'enable_page_shadow',
    						'type' => 'button_set',
    						'title' => __('Page shadow (boxed layout only)', "swiftframework"), 
    						'sub_desc' => __('Enable the shadow for the boxed layout', "swiftframework"),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '1'
    						),
    					array(
    						'id' => 'custom_favicon',
    						'type' => 'upload',
    						'title' => __('Custom favicon', "swiftframework"), 
    						'sub_desc' => __('Upload a 16px x 16px Png/Gif image that will represent your website favicon', "swiftframework"),
    						'desc' => ''
    						),
    					array(
    						'id' => 'rss_feed_url',
    						'type' => 'text',
    						'title' => __('RSS Feed URL', "swiftframework"),
    						'sub_desc' => __('The rss feed URL for your blog.', "swiftframework"),
    						'desc' => '',
    						'std' => '?feed=rss2'
    						),
    					array(
    						'id' => 'gmaps_api_key',
    						'type' => 'text',
    						'title' => __('Google Maps API Key', "swiftframework"),
    						'sub_desc' => __('This is needed to use the map functionality within the theme. You can get your key <a href="https://console.developers.google.com/flows/enableapi?apiid=maps_backend,geocoding_backend,directions_backend,distance_matrix_backend,elevation_backend&keyType=CLIENT_SIDE&reusekey=true" target="_blank">here</a>. Once you have generated it, copy and paste it into this option.', "swiftframework"),
    						'desc' => '',
    						'std' => ''
    						),
    					array(
    						'id' => 'custom_css',
    						'type' => 'textarea',
    						'title' => __('Custom CSS', "swiftframework"), 
    						'sub_desc' => __('Quickly add some CSS to your theme by adding it to this textarea.', "swiftframework"),
    						'desc' => '',
    						'std' => ''
    						),
    					array(
    						'id' => 'google_analytics',
    						'type' => 'textarea',
    						'title' => __('Tracking code', "swiftframework"), 
    						'sub_desc' => __('Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme. NOTE: Please include the script tag.', "swiftframework"),
    						'desc' => '',
    						'std' => ''
    						),
    					array(
    						'id' => 'custom_admin_login_logo',
    						'type' => 'upload',
    						'title' => __('Custom admin login logo', "swiftframework"), 
    						'sub_desc' => __('Upload a 254 x 95px image here to replace the admin login logo.', "swiftframework"),
    						'desc' => ''
    						),
    					array(
    						'id' => 'enable_styleswitcher',
    						'type' => 'button_set',
    						'title' => __('Enable Front End Style Switcher', "swiftframework"), 
    						'sub_desc' => __('Enable/Disable the front end styleswitcher.', "swiftframework"),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '0'
    						)
    					)
    				);
    $sections[] = array(
    				'icon' => 'dashboard',
    				'icon_class' => 'fa-lg',
    				'title' => __('Performance Options', "swiftframework"),
    				'desc' => __('<p class="description">These are the performance options for the theme</p>', "swiftframework"),
    				'fields' => array(	
    					array(
    						'id' => 'enable_min_scripts',
    						'type' => 'button_set',
    						'title' => __('Enable Performance', "swiftframework"), 
    						'sub_desc' => __('Enable this option to load pre-minified scripts, without the need for any plugins.', "swiftframework"),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '0'
    						),
    					)
    				);
    $sections[] = array(
    				'icon' => 'photo',
    				'icon_class' => 'fa-lg',
    				'title' => __('Background Options', "swiftframework"),
    				'desc' => __('<p class="description">These are the options for the background.</p>', "swiftframework"),
    				'fields' => array(
    					array(
    						'id' => 'use_bg_image',
    						'type' => 'button_set',
    						'title' => __('Use Background Image', "swiftframework"), 
    						'sub_desc' => __('Check this to use an image for the body background (boxed layout only).', "swiftframework"),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '1'
    						),
    					array(
    						'id' => 'custom_bg_image',
    						'type' => 'upload',
    						'title' => __('Upload Background Image', "swiftframework"), 
    						'sub_desc' => __('Either upload or provide a link to your own background here, or choose from the presets below.', "swiftframework"),
    						'desc' => ''
    						),
    					array(
    						'id' => 'bg_size',
    						'type' => 'button_set',
    						'title' => __('Background Size', "swiftframework"), 
    						'sub_desc' => __('If you are using an image rather than a pattern, select cover to make the image cover the background.', "swiftframework"),
    						'desc' => '',
    						'options' => array('cover' => 'Cover','auto' => 'Auto'),
    						'std' => 'auto'
    						),
    					array(
    						'id' => 'preset_bg_image',
    						'type' => 'radio_img_bg',
    						'title' => __('Preset body background image', "swiftframework"), 
    						'sub_desc' => __('Select a preset background image for the body background.', "swiftframework"),
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
    						'std' => $args['bg_image_path'] . 'grid_noise.png'
    						)
    					)
    				);
    $sections[] = array(
    				'icon_type' => 'image',
    				'icon' => Redux_OPTIONS_URL.'img/header.png',
    				'title' => __('Header Options', "swiftframework"),
    				'desc' => __('<p class="description">These are the options for the header.</p>', "swiftframework"),
    				'fields' => array(
    					array(
    						'id' => 'mobile_header_tabletland',
    						'type' => 'button_set',
    						'title' => __('Display Mobile Header on Tablet Landscape (< 1024px)', "swiftframework"), 
    						'sub_desc' => __('Choose if you would like to show the mobile header on tablet landscape, rather than the standard menu.', "swiftframework"),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '0'
    						),
    					array(
    						'id' => 'enable_tb',
    						'type' => 'button_set',
    						'title' => __('Enable Top Bar', "swiftframework"), 
    						'sub_desc' => __('If enabled, the top bar will show with the menu and social config.', "swiftframework"),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '1'
    						),
    					array(
    						'id' => 'tb_config',
    						'type' => 'select',
    						'title' => __('Top Bar Config', "swiftframework"),
    						'sub_desc' => "Choose the config for the Top Bar. This will define the options below for what you have on the left/right of the Top Bar.",
    						'options' => array(
    							'tb-1'	=> 'Text / Text',
    							'tb-2'	=> 'Alt Menu / Text',
    							'tb-3'	=> 'Text / Alt Menu',
    							'tb-4'	=> 'Welcome + Super Search / Links',
    							'tb-5'	=> 'Welcome + Super Search / Text',
    							'tb-6'	=> 'Welcome + Super Search / Alt Menu',
    							'tb-7'	=> 'Super Search / Text',
    							'tb-8'  => 'Super Search / Alt Menu',
    							'tb-9'  => 'Links / Text',
    							'tb-10'  => 'Text / Links',
    							),
    						'desc' => '',
    						'std' => 'tb-1'
    						),
    					array(
    						'id' => 'tb_left_text',
    						'type' => 'text',
    						'title' => __('Top Bar left text config', "swiftframework"),
    						'sub_desc' => "The text that is shown on the left of the Top Bar. You can use shortcodes in here if you like, (i.e. social). NOTE: Make sure you use single quotes (') for parameters with no spaces in between.",
    						'desc' => '',
    						'std' => "The premier destination for premium products"
    						),
    					array(
    						'id' => 'tb_right_text',
    						'type' => 'text',
    						'title' => __('Top Bar right text config', "swiftframework"),
    						'sub_desc' => "The text that is shown on the right of the Top Bar. You can use shortcodes in here if you like, (i.e. social). NOTE: Make sure you use single quotes (') for parameters with no spaces in between.",
    						'desc' => '',
    						'std' => "[social size='small' style='light' type='twitter,facebook,dribbble']"
    						),
    					array(
    						'id' => 'tb_search_text',
    						'type' => 'text',
    						'title' => __('Search text config', "swiftframework"),
    						'sub_desc' => "The text that is shown to the right of the search icon in the top bar / header.",
    						'desc' => '',
    						'std' => "Personal Shopper"
    						),
    					array(
    						'id' => 'show_sub',
    						'type' => 'button_set',
    						'title' => __('Show subscribe aux option', "swiftframework"), 
    						'sub_desc' => __('Check this to show the suscribe dropdown in the links output, allowing users to subscribe via inputting their email address. If you use this, be sure to enter a Mailchimp form action URL in the box below.', "swiftframework"),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '0'
    						),
    					array(
    						'id' => 'show_translation',
    						'type' => 'button_set',
    						'title' => __('Show translation aux option', "swiftframework"), 
    						'sub_desc' => __('Check this to show the translation dropdown in the links output.', "swiftframework"),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '0'
    						),
    					array(
    						'id' => 'show_account',
    						'type' => 'button_set',
    						'title' => __('Show account aux option', "swiftframework"), 
    						'sub_desc' => __('Check this to show the account sign in / my account in the links output.', "swiftframework"),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '1'
    						),
    					array(
    						'id' => 'show_cart',
    						'type' => 'button_set',
    						'title' => __('Show cart aux option', "swiftframework"), 
    						'sub_desc' => __('Check this to show the WooCommerce cart dropdown in the header.', "swiftframework"),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '0'
    						),
    					array(
    						'id' => 'show_cart_count',
    						'type' => 'button_set',
    						'title' => __('Cart aux item count', "swiftframework"),
    						'sub_desc' => __('Enable this to include the item count within the cart.', "swiftframework"),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '0'
    						),
    					array(
    						'id' => 'show_wishlist',
    						'type' => 'button_set',
    						'title' => __('Show wishlist aux option', "swiftframework"), 
    						'sub_desc' => __('Check this to show the WooCommerce wishlist dropdown in the header. NOTE: You will need the YITH Wishlist plugin to be enabled.', "swiftframework"),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '0'
    						),
    					array(
    						'id' => 'sub_code',
    						'type' => 'textarea',
    						'title' => __('Subscribe form code', "swiftframework"),
    						'sub_desc' => "Enter the form code (e.g. Mailchimp) that will be used for the subscribe dropdown.",
    						'desc' => '',
    						'std' => ""
    						),
       					array(
    						'id' => 'header_layout',
    						'type' => 'radio_img',
    						'title' => __('Header Layout', "swiftframework"), 
    						'sub_desc' => __('Select a header layout option from the examples.', "swiftframework"),
    						'desc' => '',
    						'options' => array(
								'header-1' => array('title' => '', 'img' => Redux_OPTIONS_URL.'img/nhood_header_type1_centre.jpg'),
								'header-2' => array('title' => '', 'img' => Redux_OPTIONS_URL.'img/nhood_header_type1_left.jpg'),
								'header-3' => array('title' => '', 'img' => Redux_OPTIONS_URL.'img/nhood_header_type1_right.jpg'),
								'header-4' => array('title' => '', 'img' => Redux_OPTIONS_URL.'img/nhood_header_type2_left.jpg'),
								'header-5' => array('title' => '', 'img' => Redux_OPTIONS_URL.'img/nhood_header_type2_right.jpg')
							),
    						'std' => 'header-1'
    						),
    					array(
    						'id' => 'logo_upload',
    						'type' => 'upload',
    						'title' => __('Logo', "swiftframework"), 
    						'sub_desc' => __('Upload your logo here (any size).', "swiftframework"),
    						'desc' => ''
    						),
    					array(
    						'id' => 'retina_logo_upload',
    						'type' => 'upload',
    						'title' => __('Retina Logo', "swiftframework"), 
    						'sub_desc' => __('Upload the retina version of your logo here.', "swiftframework"),
    						'desc' => ''
    						),
    					array(
    						'id' => 'logo_width',
    						'type' => 'text',
    						'title' => __('Logo Width', "swiftframework"),
    						'sub_desc' => __('Please enter the width of your logo here (standard size), so that it is restricted for the retina version. Numerical value (no px).', "swiftframework"),
    						'desc' => '',
    						'std' => '0',
    						'class' => 'mini'
    						),
    					array(
    						'id' => 'logo_height',
    						'type' => 'text',
    						'title' => __('Logo Height Override', "swiftframework"),
    						'sub_desc' => __('If you would like to override the logo height, please provide it here. Numerical value (no px).', "swiftframework"),
    						'desc' => '',
    						'std' => '',
    						'class' => 'mini'
    						),
    					array(
    						'id' => 'logo_padding',
    						'type' => 'text',
    						'title' => __('Logo Padding', "swiftframework"),
    						'sub_desc' => __('Please enter the desired value for padding above/below the logo. Default is 35. Numerical value (no px).', "swiftframework"),
    						'desc' => '',
    						'std' => '35',
    						'class' => 'mini'
    						),
       					array(
    						'id' => 'header_overlay',
    						'type' => 'button_set',
    						'title' => __('Enable Header Overlay', "swiftframework"), 
    						'sub_desc' => __('If enabled, the header will overlay the top of the page (page heading / page content).', "swiftframework"),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '0'
    						),
    					array(
    						'id' => 'header_opacity',
    						'type' => 'slider',
    						'title' => __('Header Opacity', "swiftframework"), 
    						'sub_desc' => __('Select the percentage opacity of the header.', "swiftframework"),
    						'desc' => '',
    						'from' => '0',
    						'to' => '100',
    						'step' => '5',
    						'unit' => '',
    						'std' => '100'
    						),
    					array(
    						'id' => 'enable_mini_header',
    						'type' => 'button_set',
    						'title' => __('Mini header', "swiftframework"), 
    						'sub_desc' => __('Enable the mini header when scrolling down the page.', "swiftframework"),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '1'
    						),
    					array(
    						'id' => 'enable_logo_fade',
    						'type' => 'button_set',
    						'title' => __('Logo hover fade', "swiftframework"), 
    						'sub_desc' => __('Enable the fade effect when you hover the logo.', "swiftframework"),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '1'
    						),
    					array(
    						'id' => 'enable_header_shadow',
    						'type' => 'button_set',
    						'title' => __('Header Shadow', "swiftframework"), 
    						'sub_desc' => __('Enable the shadow below the header.', "swiftframework"),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '1'
    						),
    					array(
    						'id' => 'header_search_pt',
    						'type' => 'button_set',
    						'title' => __('Header Search Post Type', "swiftframework"), 
    						'sub_desc' => __('Set whether you would like the site search limited to products, or all content.', "swiftframework"),
    						'desc' => '',
    						'options' => array('any' => 'All', 'product' => 'Products'),
    						'default' => 'any'
    						),
    					array(
    						'id' => 'disable_search',
    						'type' => 'button_set',
    						'title' => __('Disable Search', "swiftframework"), 
    						'sub_desc' => __('Enable this option to disable the search option in the header.', "swiftframework"),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '0'
    						),
    					array(
    						'id' => 'enable_mobile_translation',
    						'type' => 'button_set',
    						'title' => __('Enable Mobile Translation', "swiftframework"), 
    						'sub_desc' => __('If enabled, the menu dropdown will show langauge flags, if setup with WPML.', "swiftframework"),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '1'
    						),
    					)
    				);
    $sections[] = array(
    				'icon_type' => 'image',
    				'icon' => Redux_OPTIONS_URL.'img/footer.png',
    				'title' => __('Footer Options', "swiftframework"),
    				'desc' => __('<p class="description">These are the options for the footer.</p>', "swiftframework"),
    				'fields' => array(
    					array(
    						'id' => 'enable_footer',
    						'type' => 'button_set',
    						'title' => __('Enable Footer', "swiftframework"), 
    						'sub_desc' => __('Enable the footer widgets section.', "swiftframework"),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '1'
    						),
    					array(
    						'id' => 'enable_footer_divider',
    						'type' => 'button_set',
    						'title' => __('Footer Divider', "swiftframework"), 
    						'sub_desc' => __('Enable the footer divider above the footer.', "swiftframework"),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '1'
    						),
    					array(
    						'id' => 'footer_layout',
    						'type' => 'radio_img',
    						'title' => __('Footer Layout', "swiftframework"), 
    						'sub_desc' => __('Select the footer column layout.', "swiftframework"),
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
    						'title' => __('Enable Copyright', "swiftframework"), 
    						'sub_desc' => __('Enable the footer copyright section.', "swiftframework"),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '1'
    						),
    					array(
    						'id' => 'enable_copyright_divider',
    						'type' => 'button_set',
    						'title' => __('Copyright Divider', "swiftframework"), 
    						'sub_desc' => __('Enable the copyright divider above the copyright.', "swiftframework"),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '1'
    						),
    					array(
    						'id' => 'footer_copyright_text',
    						'type' => 'textarea',
    						'title' => __('Footer Copyright Text', "swiftframework"),
    						'sub_desc' => 'The copyright text that appears in the footer.',
    						'desc' => '',
    						'std' => "&copy;[the-year] Neighborhood &middot; Built with love by <a href='http://www.swiftideas.net'>Swift Ideas</a> using [wp-link]."
    						),
    					array(
    						'id' => 'show_backlink',
    						'type' => 'button_set',
    						'title' => __('Show Swift Ideas Backlink', "swiftframework"), 
    						'sub_desc' => __('If checked, a backlink to our site will be shown in the footer. This is not compulsory, but always appreciated :)', "swiftframework"),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '1'
    						),
    					array(
    						'id' => 'footer_gotop_text',
    						'type' => 'text',
    						'title' => __('Go To Top Button Text', "swiftframework"),
    						'sub_desc' => 'The text for the go to top button in the bottom right of the footer.',
    						'desc' => '',
    						'std' => ""
    						)
    					)
    				);
	
	$sections[] = array(
					'icon' => 'search',
					'icon_class' => 'fa-lg',
					'title' => __('Lightbox Options', "swiftframework"),
					'desc' => __('<p class="description">These are the fields that power the social shortcode. If you include a link/username here, then the icon will be included in the shortcodes output.</p>', "swiftframework"),
					'fields' => array(
						array(
							'id' => 'lightbox_nav',
							'type' => 'button_set',
							'title' => __('Lightbox Navigation', "swiftframework"), 
							'sub_desc' => __('Select the type of navigation you would like to use in the lightbox. The default option shows a section of the previous/next image to the left/right of the screen.', "swiftframework"),
							'desc' => '',
							'options' => array('default' => 'Default','arrows' => 'Arrows'),
							'std' => 'default'
							),
						array(
							'id' => 'lightbox_thumbs',
							'type' => 'button_set',
							'title' => __('Lightbox Thumbnails', "swiftframework"), 
							'sub_desc' => __('Select if you would like to display the gallery thumbnails in the lightbox or not.', "swiftframework"),
							'desc' => '',
							'options' => array('1' => 'Enabled','0' => 'Disabled'),
							'std' => '1'
							),
						array(
							'id' => 'lightbox_skin',
							'type' => 'button_set',
							'title' => __('Lightbox Skin', "swiftframework"), 
							'sub_desc' => __('Select the skin that you wish to use for the lightbox styling.', "swiftframework"),
							'desc' => '',
							'options' => array('light' => 'Light','dark' => 'Dark'),
							'std' => 'light'
							),
						array(
							'id' => 'lightbox_sharing',
							'type' => 'button_set',
							'title' => __('Lightbox Sharing', "swiftframework"), 
							'sub_desc' => __('Enable social sharing buttons on each lightbox image.', "swiftframework"),
							'desc' => '',
							'options' => array('1' => 'On','0' => 'Off'),
							'std' => '1'
							),
					)
				);
				
	$sections[] = array(
					'icon' => 'search-plus',
					'icon_class' => 'fa-lg',
					'title' => __('Super Search Options', "swiftframework"),
					'desc' => __('<p class="description">These are the options for the super search. There are 4 fields that you can set. If you leave any of the filters set to none, then that filter will be ignored.</p>', "swiftframework"),
					'fields' => array(
						array(
							'id' => 'ss_enable',
							'type' => 'button_set',
							'title' => __('Enable Super Search', "swiftframework"), 
							'sub_desc' => __('If enabled, the super search option will be included on the page. You will also need to choose the option below.', "swiftframework"),
							'desc' => '',
							'options' => array('1' => 'On','0' => 'Off'),
							'std' => '1'
							),
						array(
							'id' => 'ss_mobile',
							'type' => 'button_set',
							'title' => __('Enable Super Search on Mobile', "swiftframework"), 
							'sub_desc' => __('If enabled, the super search option will show at the top of the page on mobile devices.', "swiftframework"),
							'desc' => '',
							'options' => array('1' => 'On','0' => 'Off'),
							'std' => '1'
							),
						array(
							'id' => 'field1_text',
							'type' => 'text',
							'title' => __('Field 1 Text', "swiftframework"),
							'sub_desc' => 'The text that precedes the first dropdown select.',
							'desc' => '',
							'std' => "I'm looking for"
							),
						array(
							'id' => 'field1_filter',
							'type' => 'select',
							'title' => __('Field 1 Filter', "swiftframework"),
							'sub_desc' => "The first filter in the search text, shows after field 1 text.",
							'options' => get_woo_product_filters_array(),
							'desc' => '',
							'std' => 'product_cat'
							),
						array(
							'id' => 'field1_default_text',
							'type' => 'text',
							'title' => __('Field 1 Label', "swiftframework"),
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
							'title' => __('Field 2 Text', "swiftframework"),
							'sub_desc' => 'The text that precedes the second dropdown select.',
							'desc' => '',
							'std' => "in a size"
							),
						array(
							'id' => 'field2_filter',
							'type' => 'select',
							'title' => __('Field 2 Filter', "swiftframework"),
							'sub_desc' => "The second filter in the search text, shows after field 2 text.",
							'options' => get_woo_product_filters_array(),
							'desc' => '',
							'std' => 'product_cat'
							),
						array(
							'id' => 'field2_default_text',
							'type' => 'text',
							'title' => __('Field 2 Label', "swiftframework"),
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
							'title' => __('Field 3 Text', "swiftframework"),
							'sub_desc' => 'The text that precedes the third dropdown select.',
							'desc' => '',
							'std' => ". Show me the"
							),
						array(
							'id' => 'field3_filter',
							'type' => 'select',
							'title' => __('Field 3 Filter', "swiftframework"),
							'sub_desc' => "The third filter in the search text, shows after field 3 text.",
							'options' => get_woo_product_filters_array(),
							'desc' => '',
							'std' => 'product_cat'
							),
						array(
							'id' => 'field3_default_text',
							'type' => 'text',
							'title' => __('Field 3 Label', "swiftframework"),
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
							'title' => __('Field 4 Text', "swiftframework"),
							'sub_desc' => 'The text that precedes the fourth dropdown select.',
							'desc' => '',
							'std' => ""
							),
						array(
							'id' => 'field4_filter',
							'type' => 'select',
							'title' => __('Field 4 Filter', "swiftframework"),
							'sub_desc' => "The fourth filter in the search text, shows after field 4 text.",
							'options' => get_woo_product_filters_array(),
							'desc' => '',
							'std' => 'product_cat'
							),
						array(
							'id' => 'field4_default_text',
							'type' => 'text',
							'title' => __('Field 4 Label', "swiftframework"),
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
							'title' => __('Field 5 Text', "swiftframework"),
							'sub_desc' => 'The text that precedes the fifth dropdown select.',
							'desc' => '',
							'std' => ""
							),
						array(
							'id' => 'field5_filter',
							'type' => 'select',
							'title' => __('Field 5 Filter', "swiftframework"),
							'sub_desc' => "The fifth filter in the search text, shows after field 5 text.",
							'options' => get_woo_product_filters_array(),
							'desc' => '',
							'std' => 'product_cat'
							),
						array(
							'id' => 'field5_default_text',
							'type' => 'text',
							'title' => __('Field 5 Label', "swiftframework"),
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
							'title' => __('Field 6 Text', "swiftframework"),
							'sub_desc' => 'The text that precedes the sixth dropdown select.',
							'desc' => '',
							'std' => ""
							),
						array(
							'id' => 'field6_filter',
							'type' => 'select',
							'title' => __('Field 6 Filter', "swiftframework"),
							'sub_desc' => "The sixth filter in the search text, shows after field 6 text.",
							'options' => get_woo_product_filters_array(),
							'desc' => '',
							'std' => 'product_cat'
							),
						array(
							'id' => 'field6_default_text',
							'type' => 'text',
							'title' => __('Field 6 Label', "swiftframework"),
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
							'title' => __('Final Text', "swiftframework"),
							'sub_desc' => 'The text that appears after the last filter.',
							'desc' => '',
							'std' => "items."
							),
						array(
							'id' => 'ss_button_text',
							'type' => 'text',
							'title' => __('Super Search Button Text', "swiftframework"),
							'sub_desc' => 'The text for the super search button.',
							'desc' => '',
							'std' => "Super Search"
							),
						)
					);
	
    $sections[] = array(
    				'icon' => 'bullhorn',
    				'icon_class' => 'fa-lg',
    				'title' => __('Promo Bar Options', "swiftframework"),
    				'desc' => __('<p class="description">These are the promo bar options for the banner that appears below the header.</p>', "swiftframework"),
    				'fields' => array(
    					array(
    						'id' => 'enable_promo_bar',
    						'type' => 'button_set',
    						'title' => __('Enable Promo Bar', "swiftframework"), 
    						'sub_desc' => __('Enable the sitewide promo bar under the header', "swiftframework"),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '0'
    						),
    					array(
    						'id' => 'promo_bar_text',
    						'type' => 'text',
    						'title' => __('Promo Bar Text', "swiftframework"),
    						'sub_desc' => 'The text for the go to top button in the bottom right of the footer.',
    						'desc' => '',
    						'std' => 'Enter your feedback modal content here. (Text/HTML/Shortcodes accepted).'
    						)
    					)
    				);
        
    if ( sf_is_current_color_settings_empty() ){
    	   	
    	$sections[] = array(
    				'icon' => 'eye',
    				'icon_class' => 'fa-lg',
    				'title' => __('Colour Scheme Options', "swiftframework"),
    				'desc' => __('<p class="description">Create, import, and export color schemas.</p>', "swiftframework"),
    				'fields' => array(
    					array(
    						'id' => 'colour_scheme_select_scheme',
    						'type' => 'select',
    						'title' => __('Select an existing colour scheme to preview', "swiftframework"),
    						'sub_desc' => "",
    						'options' => sf_get_color_scheme_list(),
    						'desc' => '',
    						'std' => sf_get_current_color_scheme_id()
    						),
    					array(
    					    'id' => 'colour_scheme_import',
    					    'type' => 'upload_scheme',
    					    'title' => __('Import a Color Scheme', "swiftframework"), 
    					    'sub_desc' => __('File must be csv format.', "swiftframework")
    						),
    					array(
    					    'id' => 'colour_scheme_export',
    					    'type' => 'raw_html_narrow',
    					    'title' => __('Export Current Settings As Schema', "swiftframework"), 
    					    'sub_desc' => __('Export the CURRENT COLORS IN THE SCHEMA PREVIEW as a csv file.', "swiftframework"),
    					    'html' => sf_export_color_scheme_html()
    						),
    					array(
    					    'id' => 'colour_scheme_preview',
    					    'type' => 'raw_html_narrow',
    					    'title' => __('Color Scheme Preview', "swiftframework"), 
    					    'sub_desc' => __('<span id="scheme-preview-text">These colors are what currently exist in the WordPress theme customizer.</span>'
    					    				 .'<div class="scheme-buttons" id="scheme-buttons">'
    					    				 .'<input class="save-this-scheme-name" name="save-this-scheme-name" placeholder="Name This Scheme"   style="display:none;" />'					    				 
    					    				 .'<a class="save-this-scheme button-secondary"   style="display:none;">Save This Scheme</a>'
    					    				 .'<a class="delete-this-scheme button-secondary"  style="display:none;">Delete This Scheme</a>'
    					    				 .'<a class="use-this-scheme button-secondary"  style="display:none;">Use This Scheme</a>'
    					    				 .'</div>', "swiftframework"),
    					    'html' => sf_get_current_color_scheme_html_preview()
    						)
    					)
    
    				);
    	   	
       	} else {
       	
    	$sections[] = array(
				'icon' => 'eye',
				'icon_class' => 'fa-lg',
				'title' => __('Colour Scheme Options', "swiftframework"),
				'desc' => __('<p class="description">Create, import, and export color schemas.</p>', "swiftframework"),
				'fields' => array(
					array(
						'id' => 'colour_scheme_select_scheme',
						'type' => 'select',
						'title' => __('Select an existing colour scheme to preview', "swiftframework"),
						'sub_desc' => "",
						'options' => sf_get_color_scheme_list(),
						'desc' => '',
						'std' => sf_get_current_color_scheme_id()
						),
					array(
					    'id' => 'colour_scheme_import',
					    'type' => 'upload_scheme',
					    'title' => __('Import a Color Scheme', "swiftframework"), 
					    'sub_desc' => __('File must be csv format.', "swiftframework")
						),
					array(
					    'id' => 'colour_scheme_export',
					    'type' => 'raw_html_narrow',
					    'title' => __('Export Current Settings As Schema', "swiftframework"), 
					    'sub_desc' => __('Export the CURRENT COLORS IN THE SCHEMA PREVIEW as a csv file.', "swiftframework"),
					    'html' => sf_export_color_scheme_html()
						),
					array(
					    'id' => 'colour_scheme_preview',
					    'type' => 'raw_html_narrow',
					    'title' => __('Color Scheme Preview', "swiftframework"), 
					    'sub_desc' => __('<span id="scheme-preview-text">These colors are what currently exist in the WordPress theme customizer.</span>'
					    				 .'<div class="scheme-buttons" id="scheme-buttons">'
					    				 .'<input class="save-this-scheme-name" name="save-this-scheme-name" placeholder="Name This Scheme" />'					    				 
					    				 .'<a class="save-this-scheme button-secondary">Save This Scheme</a>'
					    				 .'<a class="delete-this-scheme button-secondary"  style="display:none;">Delete This Scheme</a>'
					    				 .'<a class="use-this-scheme button-secondary"  style="display:none;">Use This Scheme</a>'
					    				 .'</div>', "swiftframework"),
					    'html' => sf_get_current_color_scheme_html_preview()
						)
					)

				);	   	
    	   	
    }
    
    $sections[] = array(
    				'icon' => 'tasks',
    				'icon_class' => 'fa-lg',
    				'title' => __('Default Meta Options', "swiftframework"),
    				'desc' => __('<p class="description">These are the options to set the defaults for the meta options.</p>', "swiftframework"),
    				'fields' => array(
    					array(
    						'id' => 'default_show_page_heading',
    						'type' => 'button_set',
    						'title' => __('Default Show Page Heading', "swiftframework"), 
    						'sub_desc' => __('Choose the default state for the page heading, shown/hidden.', "swiftframework"),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '1'
    						),
    					array(
    						'id' => 'default_page_heading_bg_alt',
    						'type' => 'select',
    						'title' => __('Default Page Heading Background', "swiftframework"),
    						'sub_desc' => "Choose the default alt background configuration for the page heading.",
    						'options' => array(
    							'none'		=> 'None',
    							'alt-one'		=> 'Alt 1',
    							'alt-two'		=> 'Alt 2',
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
    						'id' => 'default_divide_0',
    						'type' => 'divide'
    						),
    					array(
    						'id' => 'default_sidebar_config',
    						'type' => 'select',
    						'title' => __('Default Sidebar Config', "swiftframework"),
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
    						'title' => __('Default Left Sidebar', "swiftframework"),
    						'sub_desc' => "Choose the default left sidebar for pages/posts",
    						'options' => sf_sidebars_array(),
    						'desc' => '',
    						'std' => 'Sidebar-1'
    						),
    					array(
    						'id' => 'default_right_sidebar',
    						'type' => 'select',
    						'title' => __('Default Right Sidebar', "swiftframework"),
    						'sub_desc' => "Choose the default right sidebar for pages/posts",
    						'options' => sf_sidebars_array(),
    						'desc' => '',
    						'std' => 'Sidebar-1'
    						)
    					)
    				);
	$sections[] = array(
				'icon' => 'paint-brush',
				'icon_class' => 'fa-lg',
				'title' => __('Asset Background Options', "swiftframework"),
				'desc' => __('<p class="description">These are the options for the alternative backgrounds that you can set for page headings / full width page builder assets.</p>', "swiftframework"),
				'fields' => array(
					array(
					    'id' => 'alt_one_bg_color',
					    'type' => 'color',
					    'title' => __('Alt 1 Background Color', "swiftframework"), 
					    'sub_desc' => __('The background color for the Alt-1 alternative background.', "swiftframework"),
					    'std' => '#FFFFFF'
						),
					array(
					    'id' => 'alt_one_text_color',
					    'type' => 'color',
					    'title' => __('Alt 1 Text Color', "swiftframework"), 
					    'sub_desc' => __('The text color for the Alt-1 alternative background.', "swiftframework"),
					    'std' => '#222222'
						),
					array(
						'id' => 'alt_one_bg_image',
						'type' => 'upload',
						'title' => __('Alt 1 Background Image', "swiftframework"), 
						'sub_desc' => __('Upload an image for the Alt-1 alternative background here.', "swiftframework"),
						'desc' => ''
						),
					array(
						'id' => 'alt_one_bg_image_size',
						'type' => 'button_set',
						'title' => __('Alt 1 Background Size', "swiftframework"), 
						'sub_desc' => __('If you are using an image rather than a pattern, select cover to make the image cover the background.', "swiftframework"),
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
					    'title' => __('Alt 2 Background Color', "swiftframework"), 
					    'sub_desc' => __('The background color for the Alt-2 alternative background.', "swiftframework"),
					    'std' => '#FFFFFF'
						),
					array(
					    'id' => 'alt_two_text_color',
					    'type' => 'color',
					    'title' => __('Alt 2 Text Color', "swiftframework"), 
					    'sub_desc' => __('The text color for the Alt-2 alternative background.', "swiftframework"),
					    'std' => '#222222'
						),
					array(
						'id' => 'alt_two_bg_image',
						'type' => 'upload',
						'title' => __('Alt 2 Background Image', "swiftframework"), 
						'sub_desc' => __('Upload an image for the Alt-2 alternative background here.', "swiftframework"),
						'desc' => ''
						),
					array(
						'id' => 'alt_two_bg_image_size',
						'type' => 'button_set',
						'title' => __('Alt 2 Background Size', "swiftframework"), 
						'sub_desc' => __('If you are using an image rather than a pattern, select cover to make the image cover the background.', "swiftframework"),
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
					    'title' => __('Alt 3 Background Color', "swiftframework"), 
					    'sub_desc' => __('The background color for the Alt-3 alternative background.', "swiftframework"),
					    'std' => '#FFFFFF'
						),
					array(
					    'id' => 'alt_three_text_color',
					    'type' => 'color',
					    'title' => __('Alt 3 Text Color', "swiftframework"), 
					    'sub_desc' => __('The text color for the Alt-3 alternative background.', "swiftframework"),
					    'std' => '#222222'
						),
					array(
						'id' => 'alt_three_bg_image',
						'type' => 'upload',
						'title' => __('Alt 3 Background Image', "swiftframework"), 
						'sub_desc' => __('Upload an image for the Alt-3 alternative background here.', "swiftframework"),
						'desc' => ''
						),
					array(
						'id' => 'alt_three_bg_image_size',
						'type' => 'button_set',
						'title' => __('Alt 3 Background Size', "swiftframework"), 
						'sub_desc' => __('If you are using an image rather than a pattern, select cover to make the image cover the background.', "swiftframework"),
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
					    'title' => __('Alt 4 Background Color', "swiftframework"), 
					    'sub_desc' => __('The background color for the Alt-4 alternative background.', "swiftframework"),
					    'std' => '#FFFFFF'
						),
					array(
					    'id' => 'alt_four_text_color',
					    'type' => 'color',
					    'title' => __('Alt 4 Text Color', "swiftframework"), 
					    'sub_desc' => __('The text color for the Alt-4 alternative background.', "swiftframework"),
					    'std' => '#222222'
						),
					array(
						'id' => 'alt_four_bg_image',
						'type' => 'upload',
						'title' => __('Alt 4 Background Image', "swiftframework"), 
						'sub_desc' => __('Upload an image for the Alt-4 alternative background here.', "swiftframework"),
						'desc' => ''
						),
					array(
						'id' => 'alt_four_bg_image_size',
						'type' => 'button_set',
						'title' => __('Alt 4 Background Size', "swiftframework"), 
						'sub_desc' => __('If you are using an image rather than a pattern, select cover to make the image cover the background.', "swiftframework"),
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
					    'title' => __('Alt 5 Background Color', "swiftframework"), 
					    'sub_desc' => __('The background color for the Alt-5 alternative background.', "swiftframework"),
					    'std' => '#FFFFFF'
						),
					array(
					    'id' => 'alt_five_text_color',
					    'type' => 'color',
					    'title' => __('Alt 5 Text Color', "swiftframework"), 
					    'sub_desc' => __('The text color for the Alt-5 alternative background.', "swiftframework"),
					    'std' => '#222222'
						),
					array(
						'id' => 'alt_five_bg_image',
						'type' => 'upload',
						'title' => __('Alt 5 Background Image', "swiftframework"), 
						'sub_desc' => __('Upload an image for the Alt-5 alternative background here.', "swiftframework"),
						'desc' => ''
						),
					array(
						'id' => 'alt_five_bg_image_size',
						'type' => 'button_set',
						'title' => __('Alt 5 Background Size', "swiftframework"), 
						'sub_desc' => __('If you are using an image rather than a pattern, select cover to make the image cover the background.', "swiftframework"),
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
					    'title' => __('Alt 6 Background Color', "swiftframework"), 
					    'sub_desc' => __('The background color for the Alt-6 alternative background.', "swiftframework"),
					    'std' => '#FFFFFF'
						),
					array(
					    'id' => 'alt_six_text_color',
					    'type' => 'color',
					    'title' => __('Alt 6 Text Color', "swiftframework"), 
					    'sub_desc' => __('The text color for the Alt-6 alternative background.', "swiftframework"),
					    'std' => '#222222'
						),
					array(
						'id' => 'alt_six_bg_image',
						'type' => 'upload',
						'title' => __('Alt 6 Background Image', "swiftframework"), 
						'sub_desc' => __('Upload an image for the Alt-6 alternative background here.', "swiftframework"),
						'desc' => ''
						),
					array(
						'id' => 'alt_six_bg_image_size',
						'type' => 'button_set',
						'title' => __('Alt 6 Background Size', "swiftframework"), 
						'sub_desc' => __('If you are using an image rather than a pattern, select cover to make the image cover the background.', "swiftframework"),
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
					    'title' => __('Alt 7 Background Color', "swiftframework"), 
					    'sub_desc' => __('The background color for the Alt-7 alternative background.', "swiftframework"),
					    'std' => '#FFFFFF'
						),
					array(
					    'id' => 'alt_seven_text_color',
					    'type' => 'color',
					    'title' => __('Alt 7 Text Color', "swiftframework"), 
					    'sub_desc' => __('The text color for the Alt-7 alternative background.', "swiftframework"),
					    'std' => '#222222'
						),
					array(
						'id' => 'alt_seven_bg_image',
						'type' => 'upload',
						'title' => __('Alt 7 Background Image', "swiftframework"), 
						'sub_desc' => __('Upload an image for the Alt-7 alternative background here.', "swiftframework"),
						'desc' => ''
						),
					array(
						'id' => 'alt_seven_bg_image_size',
						'type' => 'button_set',
						'title' => __('Alt 7 Background Size', "swiftframework"), 
						'sub_desc' => __('If you are using an image rather than a pattern, select cover to make the image cover the background.', "swiftframework"),
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
					    'title' => __('Alt 8 Background Color', "swiftframework"), 
					    'sub_desc' => __('The background color for the Alt-8 alternative background.', "swiftframework"),
					    'std' => '#FFFFFF'
						),
					array(
					    'id' => 'alt_eight_text_color',
					    'type' => 'color',
					    'title' => __('Alt 8 Text Color', "swiftframework"), 
					    'sub_desc' => __('The text color for the Alt-8 alternative background.', "swiftframework"),
					    'std' => '#222222'
						),
					array(
						'id' => 'alt_eight_bg_image',
						'type' => 'upload',
						'title' => __('Alt 8 Background Image', "swiftframework"), 
						'sub_desc' => __('Upload an image for the Alt-8 alternative background here.', "swiftframework"),
						'desc' => ''
						),
					array(
						'id' => 'alt_eight_bg_image_size',
						'type' => 'button_set',
						'title' => __('Alt 8 Background Size', "swiftframework"), 
						'sub_desc' => __('If you are using an image rather than a pattern, select cover to make the image cover the background.', "swiftframework"),
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
					    'title' => __('Alt 9 Background Color', "swiftframework"), 
					    'sub_desc' => __('The background color for the Alt-9 alternative background.', "swiftframework"),
					    'std' => '#FFFFFF'
						),
					array(
					    'id' => 'alt_nine_text_color',
					    'type' => 'color',
					    'title' => __('Alt 9 Text Color', "swiftframework"), 
					    'sub_desc' => __('The text color for the Alt-9 alternative background.', "swiftframework"),
					    'std' => '#222222'
						),
					array(
						'id' => 'alt_nine_bg_image',
						'type' => 'upload',
						'title' => __('Alt 9 Background Image', "swiftframework"), 
						'sub_desc' => __('Upload an image for the Alt-9 alternative background here.', "swiftframework"),
						'desc' => ''
						),
					array(
						'id' => 'alt_nine_bg_image_size',
						'type' => 'button_set',
						'title' => __('Alt 9 Background Size', "swiftframework"), 
						'sub_desc' => __('If you are using an image rather than a pattern, select cover to make the image cover the background.', "swiftframework"),
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
					    'title' => __('Alt 10 Background Color', "swiftframework"), 
					    'sub_desc' => __('The background color for the Alt-10 alternative background.', "swiftframework"),
					    'std' => '#FFFFFF'
						),
					array(
					    'id' => 'alt_ten_text_color',
					    'type' => 'color',
					    'title' => __('Alt 10 Text Color', "swiftframework"), 
					    'sub_desc' => __('The text color for the Alt-10 alternative background.', "swiftframework"),
					    'std' => '#222222'
						),
					array(
						'id' => 'alt_ten_bg_image',
						'type' => 'upload',
						'title' => __('Alt 10 Background Image', "swiftframework"), 
						'sub_desc' => __('Upload an image for the Alt-10 alternative background here.', "swiftframework"),
						'desc' => ''
						),
					array(
						'id' => 'alt_ten_bg_image_size',
						'type' => 'button_set',
						'title' => __('Alt 10 Background Size', "swiftframework"), 
						'sub_desc' => __('If you are using an image rather than a pattern, select cover to make the image cover the background.', "swiftframework"),
						'desc' => '',
						'options' => array('cover' => 'Cover','auto' => 'Auto'),
						'std' => 'auto'
						)
					)
				);
   	$sections[] = array(
   					'icon' => 'list',
   					'icon_class' => 'fa-lg',
   					'title' => __('Archive/Category Options', "swiftframework"),
   					'desc' => __('<p class="description">These are the options for the archive/category pages.</p>', "swiftframework"),
   					'fields' => array(
   						array(
   							'id' => 'archive_sidebar_config',
   							'type' => 'select',
   							'title' => __('Sidebar Config', "swiftframework"),
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
   							'title' => __('Left Sidebar', "swiftframework"),
   							'sub_desc' => "Choose the left sidebar for Left/Both sidebar configs.",
   							'options' => sf_sidebars_array(),
   							'desc' => '',
   							'std' => 'Sidebar-1'
   							),
   						array(
   							'id' => 'archive_sidebar_right',
   							'type' => 'select',
   							'title' => __('Right Sidebar', "swiftframework"),
   							'sub_desc' => "Choose the left sidebar for Right/Both sidebar configs.",
   							'options' => sf_sidebars_array(),
   							'desc' => '',
   							'std' => 'Sidebar-1'
   							),
   						array(
   							'id' => 'archive_display_type',
   							'type' => 'select',
   							'title' => __('Display Type', "swiftframework"),
   							'sub_desc' => "Select the display type.",
   							'options' => array(
   								'standard'		=> 'Standard',
   								'mini'			=> 'Mini',
   								'masonry'		=> 'Masonry'
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
   							'title' => __('Portfolio Archive Display Type', "swiftframework"),
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
   							'title' => __('Portfolio Archive Columns', "swiftframework"),
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
    				'title' => __('Font Options', "swiftframework"),
    				'desc' => __('<p class="description">These are the options for fonts used within the theme.</p>', "swiftframework"),
    				'fields' => array(
    					array(
    						'id' => 'google_font_subset',
    						'type' => 'multi_select',
    						'title' => __('Google Font Subset', "swiftframework"), 
    						'sub_desc' => __('If you are using Google Fonts, and need to use a subset, then please choose it here. Ensure that your chosen font(s) support this subset. NOTE: Hold CMD/CTRL and click to select multiple subsets.', "swiftframework"),
    						'desc' => '',
    						'options' => array('none' => 'None', 'latin' => 'Latin', 'latin-ext' => 'Latin Extended', 'greek' => 'Greek', 'greek-ext' => 'Greek Extended', 'cyrillic' => 'Cyrillic Extended'),
    						'std' => 'none'
    						),
    					array(
    						'id' => 'body_font_option',
    						'type' => 'button_set',
    						'title' => __('Body Font', "swiftframework"), 
    						'sub_desc' => __('Choose the type of font that you want to use for the body text.', "swiftframework"),
    						'desc' => '',
    						'options' => array('standard' => 'Standard','google' => 'Google'),
    						'std' => 'standard'
    						),
    					array(
    						'id' => 'web_body_font',
    						'type' => 'select',
    						'title' => __('Body Standard Font', "swiftframework"), 
    						'sub_desc' => __('The font that is used as the body text and other small text throughout the theme.', "swiftframework"),
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
    						'title' => __('Standard Google Font', "swiftframework"), 
    						'sub_desc' => __('The font that is used as the body text and other small text throughout the theme.', "swiftframework"),
    						'desc' => '',
    						'placeholder' => 'Default Font'
    						),
    					array(
    						'id' => 'font_divide_a',
    						'type' => 'divide'
    						),
    					array(
    						'id' => 'headings_font_option',
    						'type' => 'button_set',
    						'title' => __('Headings Font', "swiftframework"), 
    						'sub_desc' => __('Choose the type of font that you want to use for the body text.', "swiftframework"),
    						'desc' => '',
    						'options' => array('standard' => 'Standard','google' => 'Google'),
    						'std' => 'standard'
    						),
    					array(
    						'id' => 'web_heading_font',
    						'type' => 'select',
    						'title' => __('Heading Standard Font', "swiftframework"), 
    						'sub_desc' => __('The font that is used for the headings throughout the theme.', "swiftframework"),
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
    						'title' => __('Headings Google Font', "swiftframework"), 
    						'sub_desc' => __('The font that is used for the headings throughout the theme.', "swiftframework"),
    						'desc' => ''
    						),
    					array(
    						'id' => 'font_divide_b',
    						'type' => 'divide'
    						),
    					array(
    						'id' => 'menu_font_option',
    						'type' => 'button_set',
    						'title' => __('Menu Font', "swiftframework"), 
    						'sub_desc' => __('Choose the type of font that you want to use for the menu text.', "swiftframework"),
    						'desc' => '',
    						'options' => array('standard' => 'Standard','google' => 'Google'),
    						'std' => 'standard'
    						),
    					array(
    						'id' => 'web_menu_font',
    						'type' => 'select',
    						'title' => __('Menu Standard Font', "swiftframework"), 
    						'sub_desc' => __('The font that is used for the menu.', "swiftframework"),
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
    						'title' => __('Menu Google Font', "swiftframework"), 
    						'sub_desc' => __('The font that is used for the menu.', "swiftframework"),
    						'desc' => ''
    						),
    					)
    				);
    				
   	$sections[] = array(
   					'icon' => 'text-height',
   					'icon_class' => 'fa-lg',
   					'title' => __('Font Size Options', "swiftframework"),
   					'desc' => __('<p class="description">These are the options for fonts used within the theme.</p>', "swiftframework"),
   					'fields' => array(
   						array(
   							'id' => 'body_font_size',
   							'type' => 'slider',
   							'title' => __('Body Font Size', "swiftframework"), 
   							'sub_desc' => __('Select the size of the body font.', "swiftframework"),
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
   							'title' => __('Body Font Line Height', "swiftframework"), 
   							'sub_desc' => __('Select the line height of the body font.', "swiftframework"),
   							'desc' => '',
   							'from' => '10',
   							'to' => '80',
   							'step' => '1',
   							'unit' => 'px',
   							'std' => '22'
   							),
   						array(
   							'id' => 'font_divide_0',
   							'type' => 'divide'
   							),
   						array(
   							'id' => 'menu_font_size',
   							'type' => 'slider',
   							'title' => __('Menu Font Size', "swiftframework"), 
   							'sub_desc' => __('Select the size of the menu font.', "swiftframework"),
   							'desc' => '',
   							'from' => '10',
   							'to' => '28',
   							'step' => '1',
   							'unit' => 'px',
   							'std' => '14'
   							),
   						array(
   							'id' => 'font_divide_1',
   							'type' => 'divide'
   							),
   						array(
   							'id' => 'h1_font_size',
   							'type' => 'slider',
   							'title' => __('H1 Font Size', "swiftframework"), 
   							'sub_desc' => __('Select the size of the h1 font.', "swiftframework"),
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
   							'title' => __('H1 Font Line Height', "swiftframework"), 
   							'sub_desc' => __('Select the line height of the h1 font.', "swiftframework"),
   							'desc' => '',
   							'from' => '10',
   							'to' => '100',
   							'step' => '1',
   							'unit' => 'px',
   							'std' => '34'
   							),
   						array(
   							'id' => 'font_divide_2',
   							'type' => 'divide'
   							),
   						array(
   							'id' => 'h2_font_size',
   							'type' => 'slider',
   							'title' => __('H2 Font Size', "swiftframework"), 
   							'sub_desc' => __('Select the size of the h2 font.', "swiftframework"),
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
   							'title' => __('H2 Font Line Height', "swiftframework"), 
   							'sub_desc' => __('Select the line height of the h2 font.', "swiftframework"),
   							'desc' => '',
   							'from' => '10',
   							'to' => '100',
   							'step' => '1',
   							'unit' => 'px',
   							'std' => '30'
   							),
   						array(
   							'id' => 'font_divide_3',
   							'type' => 'divide'
   							),
   						array(
   							'id' => 'h3_font_size',
   							'type' => 'slider',
   							'title' => __('H3 Font Size', "swiftframework"), 
   							'sub_desc' => __('Select the size of the h3 font.', "swiftframework"),
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
   							'title' => __('H3 Font Line Height', "swiftframework"), 
   							'sub_desc' => __('Select the line height of the h3 font.', "swiftframework"),
   							'desc' => '',
   							'from' => '10',
   							'to' => '100',
   							'step' => '1',
   							'unit' => 'px',
   							'std' => '24'
   							),
   						array(
   							'id' => 'font_divide_4',
   							'type' => 'divide'
   							),
   						array(
   							'id' => 'h4_font_size',
   							'type' => 'slider',
   							'title' => __('H4 Font Size', "swiftframework"), 
   							'sub_desc' => __('Select the size of the h4 font.', "swiftframework"),
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
   							'title' => __('H4 Font Line Height', "swiftframework"), 
   							'sub_desc' => __('Select the line height of the h4 font.', "swiftframework"),
   							'desc' => '',
   							'from' => '10',
   							'to' => '100',
   							'step' => '1',
   							'unit' => 'px',
   							'std' => '20'
   							),
   						array(
   							'id' => 'font_divide_5',
   							'type' => 'divide'
   							),
   						array(
   							'id' => 'h5_font_size',
   							'type' => 'slider',
   							'title' => __('H5 Font Size', "swiftframework"), 
   							'sub_desc' => __('Select the size of the h5 font.', "swiftframework"),
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
   							'title' => __('H5 Font Line Height', "swiftframework"), 
   							'sub_desc' => __('Select the line height of the h5 font.', "swiftframework"),
   							'desc' => '',
   							'from' => '10',
   							'to' => '100',
   							'step' => '1',
   							'unit' => 'px',
   							'std' => '18'
   							),
   						array(
   							'id' => 'font_divide_5',
   							'type' => 'divide'
   							),
   						array(
   							'id' => 'h6_font_size',
   							'type' => 'slider',
   							'title' => __('H6 Font Size', "swiftframework"), 
   							'sub_desc' => __('Select the size of the h6 font.', "swiftframework"),
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
   							'title' => __('H6 Font Line Height', "swiftframework"), 
   							'sub_desc' => __('Select the line height of the h6 font.', "swiftframework"),
   							'desc' => '',
   							'from' => '10',
   							'to' => '100',
   							'step' => '1',
   							'unit' => 'px',
   							'std' => '16'
   							)
   					)
   				);
	$sections[] = array(
    				'icon' => 'quote-left',
    				'icon_class' => 'fa-lg',
    				'title' => __('Testimonials Options', "swiftframework"),
    				'desc' => __('<p class="description">These are the options for the Testimonials pages/assets.</p>', "swiftframework"),
    				'fields' => array(
    						array(
    							'id' => 'testimonial_page',
    							'type' => 'pages_select',
    							'title' => __('Testimonial Page', "swiftframework"), 
    							'sub_desc' => __('Select the page that is your testimonial index page. This is used to link to the page from various places.', "swiftframework"),
    							'desc' => '',
    							'std' => '',
    							'args' => array()
    							),
    					)
    				);
    $sections[] = array(
    				'icon' => 'user',
    				'icon_class' => 'fa-lg',
    				'title' => __('Jobs Options', "swiftframework"),
    				'desc' => __('<p class="description">These are the options for the Jobs pages/assets.</p>', "swiftframework"),
    				'fields' => array(
    						array(
    							'id' => 'jobs_page',
    							'type' => 'pages_select',
    							'title' => __('Jobs Page', "swiftframework"), 
    							'sub_desc' => __('Select the page that is your jobs index page. This is used to link to the page from various places. This setting does not display jobs, but will appear on the Jobs overview asset to link to all jobs.', "swiftframework"),
    							'desc' => '',
    							'std' => '',
    							'args' => array()
    							),
    					)
    				);
    $sections[] = array(
    				'icon' => 'shopping-cart',
    				'icon_class' => 'fa-lg',
    				'title' => __('WooCommerce Options', "swiftframework"),
    				'desc' => __('<p class="description">These are the options for the WooCommerce pages.</p>', "swiftframework"),
    				'fields' => array(
    						array(
    							'id' => 'enable_catalog_mode',
    							'type' => 'button_set',
    							'title' => __('Catalog Mode', "swiftframework"), 
    							'sub_desc' => __('Enable this setting to set the products into catalog mode, with no price or checkout process.', "swiftframework"),
    							'desc' => '',
    							'options' => array('1' => 'On','0' => 'Off'),
    							'std' => '0'
    							),
    						array(
    							'id' => 'product_overlay_transition',
    							'type' => 'button_set',
    							'title' => __('Product Overlay Transition', "swiftframework"), 
    							'sub_desc' => __('Choose whether you would like the product overlay transition to be enabled.', "swiftframework"),
    							'desc' => '',
    							'options' => array('1' => 'On','0' => 'Off'),
    							'std' => '1'
    							),
    						array(
    							'id' => 'overlay_transition_type',
    							'type' => 'button_set',
    							'title' => __('Product Overlay Transition Type', "swiftframework"), 
    							'sub_desc' => __('Choose what type of transition between product images on hover you would like.', "swiftframework"),
    							'desc' => '',
    							'options' => array('slideup' => 'Slide Up', 'slideleft' => 'Slide Left', 'fade' => 'Fade'),
    							'std' => 'slideup'
    							),
    						array(
    							'id' => 'enable_pb_product_pages',
    							'type' => 'button_set',
    							'title' => __('Page Builder on Product Pages', "swiftframework"), 
    							'sub_desc' => __('Choose whether you would like the page builder to be enabled on product pages or not. If it is enabled, then the description accordion will use the "Short Description" content, and the page builder content will appear below the images/details area.', "swiftframework"),
    							'desc' => '',
    							'options' => array('1' => 'On','0' => 'Off'),
    							'std' => '0'
    							),
    						array(
    							'id' => 'product_image_srcset',
    							'type' => 'button_set',
    							'title' => __('Use Latest srcset functionality', 'swiftframework'),
    							'sub_desc' => __('Enable this option to use the latest srcset functionality for responsive imagery.', 'swiftframework'),
    							'desc' => '',
    							'options' => array('1' => 'On','0' => 'Off'),
    							'default' => '0'
    							),
    						array(
    							'id' => 'product_imagewidth_override',
    							'type' => 'button_set',
    							'title' => __('Override Product Image Width', 'swiftframework'),
    							'sub_desc' => __('Enable this option to override the product image/summary width on the product detail page', 'swiftframework'),
    							'desc' => '',
    							'options' => array('1' => 'On','0' => 'Off'),
    							'default' => '0'
    							),
    						array(
    						    'id'        => 'productdetail_imagewidth',
    						    'type'      => 'slider',
    						    'title'     => __('Product Image Width', 'swiftframework'),
    						    'sub_desc'  => __('Set the width (in %) of the product image area, and the summary will be calculated to suit based on this. (Default is 48%).', 'swiftframework'),
    						    'from' => '30',
    						    'to' => '70',
    						    'step' => '1',
    						    'unit' => '',
    						    'std' => '48',
    						    'display_value' => 'label'
    						),
    						array(
    							'id' => 'enable_product_desc',
    							'type' => 'button_set',
    							'title' => __('Product Description on Shop Pages', "swiftframework"), 
    							'sub_desc' => __('Choose whether you would like to display the short description below each product on the shop page.', "swiftframework"),
    							'desc' => '',
    							'options' => array('1' => 'On','0' => 'Off'),
    							'std' => '0'
    							),
    						array(
    							'id' => 'enable_default_tabs',
    							'type' => 'button_set',
    							'title' => __('Product Description Tabs Mode', "swiftframework"), 
    							'sub_desc' => __('Enable this setting to revert to the default product description styling tabs - this will allow you to use extensions that add extra tabs to the product tabs.', "swiftframework"),
    							'desc' => '',
    							'options' => array('1' => 'On','0' => 'Off'),
    							'std' => '0'
    							),
    						array(
    							'id' => 'enable_product_zoom',
    							'type' => 'button_set',
    							'title' => __('Enable image zoom on product images', "swiftframework"), 
    							'sub_desc' => __('Choose whether you would like to enable product image zoom functionality on the product detail page images.', "swiftframework"),
    							'desc' => '',
    							'options' => array('1' => 'On','0' => 'Off'),
    							'std' => '0'
    							),
    						array(
    							'id' => 'woo_sidebar_config',
    							'type' => 'select',
    							'title' => __('WooCommerce Sidebar Config', "swiftframework"),
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
    							'title' => __('WooCommerce Left Sidebar', "swiftframework"),
    							'sub_desc' => "Choose the left sidebar for WooCommerce shop/category pages.",
    							'options' => sf_sidebars_array(),
    							'desc' => '',
    							'std' => 'woocommerce-sidebar'
    							),
    						array(
    							'id' => 'woo_right_sidebar',
    							'type' => 'select',
    							'title' => __('WooCommerce Right Sidebar', "swiftframework"),
    							'sub_desc' => "Choose the right sidebar for WooCommerce shop/category pages.",
    							'options' => sf_sidebars_array(),
    							'desc' => '',
    							'std' => 'woocommerce-sidebar'
    							),
    						array(
    							'id' => 'woo_page_heading_bg_alt',
    							'type' => 'select',
    							'title' => __('WooCommerce Page Heading Background', "swiftframework"),
    							'sub_desc' => "Choose the alt background configuration for the shop/category WooCommerce page headings.",
    							'options' => array(
    								'none'		=> 'None',
    								'alt-one'		=> 'Alt 1',
    								'alt-two'		=> 'Alt 2',
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
    							'id' => 'woo_divide_0',
    							'type' => 'divide'
    							),
    						array(
    							'id' => 'default_product_sidebar_config',
    							'type' => 'select',
    							'title' => __('Default Product Sidebar Config', "swiftframework"),
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
    							'title' => __('Default Product Left Sidebar', "swiftframework"),
    							'sub_desc' => "Choose the default left sidebar for WooCommerce product pages.",
    							'options' => sf_sidebars_array(),
    							'desc' => '',
    							'std' => 'woocommerce-sidebar'
    							),
    						array(
    							'id' => 'default_product_right_sidebar',
    							'type' => 'select',
    							'title' => __('Default Product Right Sidebar', "swiftframework"),
    							'sub_desc' => "Choose the default right sidebar for WooCommerce product pages.",
    							'options' => sf_sidebars_array(),
    							'desc' => '',
    							'std' => 'woocommerce-sidebar'
    							),
    						array(
    							'id' => 'woo_divide_1',
    							'type' => 'divide'
    							),
    						array(
    							'id' => 'checkout_new_account_text',
    							'type' => 'textarea',
    							'title' => __('New account text', "swiftframework"), 
    							'sub_desc' => __('This text appears in the sign in / sign up area of the checkout process.', "swiftframework"),
    							'desc' => '',
    							'std' => 'Creating an account with Neighborhood is quick and easy, and will allow you to move through our checkout quicker. You can also store multiple shipping addresses, gain access to your order history, and much more.'
    							),
    						array(
    							'id' => 'help_bar_text',
    							'type' => 'text',
    							'title' => __('Help Bar Text', "swiftframework"), 
    							'sub_desc' => __('This text appears in the help bar on account / checkout pages.', "swiftframework"),
    							'desc' => '',
    							'std' => 'Need help? Call customer services on 0800 123 4567.'
    							),
    						array(
    							'id' => 'email_modal',
    							'type' => 'textarea',
    							'title' => __('Email customer care modal', "swiftframework"), 
    							'sub_desc' => __('The content that appears in the modal box for the email customer care help link.', "swiftframework"),
    							'desc' => '',
    							'std' => 'Enter your contact details or email form shortcode here. (Text/HTML/Shortcodes accepted).'
    							),
    						array(
    							'id' => 'shipping_modal',
    							'type' => 'textarea',
    							'title' => __('Shipping information modal', "swiftframework"), 
    							'sub_desc' => __('The content that appears in the modal box for the shipping information help link.', "swiftframework"),
    							'desc' => '',
    							'std' => 'Enter your shipping information here. (Text/HTML/Shortcodes accepted).'
    							),
    						array(
    							'id' => 'returns_modal',
    							'type' => 'textarea',
    							'title' => __('Returns & exchange modal', "swiftframework"), 
    							'sub_desc' => __('The content that appears in the modal box for the returns & exchange help link.', "swiftframework"),
    							'desc' => '',
    							'std' => 'Enter your returns and exchange information here. (Text/HTML/Shortcodes accepted).'
    							),
    						array(
    							'id' => 'faqs_modal',
    							'type' => 'textarea',
    							'title' => __('FAQs modal', "swiftframework"), 
    							'sub_desc' => __('The content that appears in the modal box for the faqs help link.', "swiftframework"),
    							'desc' => '',
    							'std' => 'Enter your faqs here. (Text/HTML/Shortcodes accepted).'
    							),
    						array(
    							'id' => 'feedback_modal',
    							'type' => 'textarea',
    							'title' => __('Feedback modal', "swiftframework"), 
    							'sub_desc' => __('The content that appears in the modal box for the leave feedback link.', "swiftframework"),
    							'desc' => '',
    							'std' => 'Enter your feedback modal content here. (Text/HTML/Shortcodes accepted).'
    							),
    					)
    				);			
    $sections[] = array(
    				'icon' => 'twitter',
    				'icon_class' => 'fa-lg',
    				'title' => __('Social Profiles', "swiftframework"),
    				'desc' => __('<p class="description">These are the fields that power the social shortcode. If you include a link/username here, then the icon will be included in the shortcodes output.</p>', "swiftframework"),
    				'fields' => array(
    						array(
    							'id' => 'twitter_username',
    							'type' => 'text',
    							'title' => __('Twitter', "swiftframework"),
    							'sub_desc' => "Your Twitter username (no @).",
    							'desc' => '',
    							'std' => ''
    							),
    						array(
    							'id' => 'facebook_page_url',
    							'type' => 'text',
    							'title' => __('Facebook', "swiftframework"),
    							'sub_desc' => "Your facebook page/profile url",
    							'desc' => '',
    							'std' => ''
    							),
    						array(
    							'id' => 'dribbble_username',
    							'type' => 'text',
    							'title' => __('Dribbble', "swiftframework"),
    							'sub_desc' => "Your Dribbble username",
    							'desc' => '',
    							'std' => ''
    							),
    						array(
    							'id' => 'vimeo_username',
    							'type' => 'text',
    							'title' => __('Vimeo', "swiftframework"),
    							'sub_desc' => "Your Vimeo username",
    							'desc' => '',
    							'std' => ''
    							),
    						array(
    							'id' => 'tumblr_username',
    							'type' => 'text',
    							'title' => __('Tumblr', "swiftframework"),
    							'sub_desc' => "Your Tumblr username",
    							'desc' => '',
    							'std' => ''
    							),
    						array(
    							'id' => 'spotify_username',
    							'type' => 'text',
    							'title' => __('Spotify', "swiftframework"),
    							'sub_desc' => "Your Spotify username",
    							'desc' => '',
    							'std' => ''
    							),
    						array(
    							'id' => 'skype_username',
    							'type' => 'text',
    							'title' => __('Skype', "swiftframework"),
    							'sub_desc' => "Your Skype username",
    							'desc' => '',
    							'std' => ''
    							),
    						array(
    							'id' => 'linkedin_page_url',
    							'type' => 'text',
    							'title' => __('LinkedIn', "swiftframework"),
    							'sub_desc' => "Your LinkedIn page/profile url",
    							'desc' => '',
    							'std' => ''
    							),
    						array(
    							'id' => 'lastfm_username',
    							'type' => 'text',
    							'title' => __('Last.fm', "swiftframework"),
    							'sub_desc' => "Your Last.fm username",
    							'desc' => '',
    							'std' => ''
    							),
    						array(
    							'id' => 'googleplus_page_url',
    							'type' => 'text',
    							'title' => __('Google+', "swiftframework"),
    							'sub_desc' => "Your Google+ page/profile URL",
    							'desc' => '',
    							'std' => ''
    							),
    						array(
    							'id' => 'flickr_page_url',
    							'type' => 'text',
    							'title' => __('Flickr', "swiftframework"),
    							'sub_desc' => "Your Flickr page url",
    							'desc' => '',
    							'std' => ''
    							),
    						array(
    							'id' => 'youtube_username',
    							'type' => 'text',
    							'title' => __('YouTube', "swiftframework"),
    							'sub_desc' => "Your YouTube URL",
    							'desc' => '',
    							'std' => ''
    							),
    						array(
    							'id' => 'behance_username',
    							'type' => 'text',
    							'title' => __('Behance', "swiftframework"),
    							'sub_desc' => "Your Behance username",
    							'desc' => '',
    							'std' => ''
    							),
    						array(
    							'id' => 'pinterest_username',
    							'type' => 'text',
    							'title' => __('Pinterest', "swiftframework"),
    							'sub_desc' => "Your Pinterest username",
    							'desc' => '',
    							'std' => ''
    							),
    						array(
    							'id' => 'yelp_url',
    							'type' => 'text',
    							'title' => __('Yelp', "swiftframework"),
    							'sub_desc' => "Your Yelp URL",
    							'desc' => '',
    							'std' => ''
    							),
    						array(
    							'id' => 'instagram_username',
    							'type' => 'text',
    							'title' => __('Instagram', "swiftframework"),
    							'sub_desc' => "Your Instagram username",
    							'desc' => '',
    							'std' => ''
    							),
    						array(
    							'id' => 'xing_url',
    							'type' => 'text',
    							'title' => __('Xing', "swiftframework"),
    							'sub_desc' => "Your Xing URL",
    							'desc' => '',
    							'std' => ''
    							),
    						array(
    							'id' => 'vk_url',
    							'type' => 'text',
    							'title' => __('Vkontakte', "swiftframework"),
    							'sub_desc' => "Your Vkontakte URL",
    							'desc' => '',
    							'std' => ''
    							),
							array(
								'id' => 'twitch_url',
								'type' => 'text',
								'title' => __('Twitch', 'swiftframework'),
								'sub_desc' => "Your Twitch URL",
								'desc' => '',
								'std' => ''
								),
							array(
								'id' => 'snapchat_url',
								'type' => 'text',
								'title' => __('Snapchat', 'swiftframework'),
								'sub_desc' => "Your Snapchat URL",
								'desc' => '',
								'std' => ''
								),
							array(
								'id' => 'whatsapp_url',
								'type' => 'text',
								'title' => __('WhatsApp', 'swiftframework'),
								'sub_desc' => "Your WhatsApp URL",
								'desc' => '',
								'std' => ''
								),
							array(
								'id' => 'rss_url',
								'type' => 'text',
								'title' => __('RSS Feed', 'swiftframework'),
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
add_action('init', 'setup_framework_options', 0);

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