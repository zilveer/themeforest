<?php
/*
 *
 * Set the text domain for the theme or plugin.
 *
 */
define('Redux_TEXT_DOMAIN', 'sf-options');

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
        'title' => __('A Section added by hook', Redux_TEXT_DOMAIN),
        'desc' => __('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', Redux_TEXT_DOMAIN),
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
    //$args['intro_text'] = __('<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', Redux_TEXT_DOMAIN);

    // Add content after the form.
    //$args['footer_text'] = __('<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', Redux_TEXT_DOMAIN);

    // Set footer/credit line.
    //$args['footer_credit'] = __('<p>This text is displayed in the options panel footer across from the WordPress version (where it normally says \'Thank you for creating with WordPress\'). This field accepts all HTML.</p>', Redux_TEXT_DOMAIN);

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
    $args['opt_name'] = 'sf_flexform_options';

    // Set a custom menu icon.
    // Redux ships with the glyphicons free icon pack, included in the options folder.
    // Feel free to use them, add your own icons, or leave this blank for the default.
    //$args['menu_icon'] = '';

    // Set a custom title for the options page.
    // Default: Options
    $args['menu_title'] = __('Theme Options', Redux_TEXT_DOMAIN);

    // Set a custom page title for the options page.
    // Default: Options
    $args['page_title'] = __('Theme Options', Redux_TEXT_DOMAIN);
	
	// Set the class for the import/export tab icon.
	$args['import_icon_type'] = 'iconfont';
	$args['import_icon_class'] = 'icon-large';

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
        'title' => __('Theme Information 1', Redux_TEXT_DOMAIN),
        'content' => __('<p>This is the tab content, HTML is allowed.</p>', Redux_TEXT_DOMAIN)
    );
    $args['help_tabs'][] = array(
        'id' => 'redux-opts-2',
        'title' => __('Theme Information 2', Redux_TEXT_DOMAIN),
        'content' => __('<p>This is the tab content, HTML is allowed.</p>', Redux_TEXT_DOMAIN)
    );

    // Set the help sidebar for the options page.                                        
    $args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', Redux_TEXT_DOMAIN);
	
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
    //				'title' => __('Getting Started', Redux_TEXT_DOMAIN),
    //				'desc' => __('<p class="description">This is the description field for the Section. HTML is allowed</p>', Redux_TEXT_DOMAIN),
    				//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
    				//You dont have to though, leave it blank for default.
    //				'icon' => Redux_OPTIONS_URL.'img/glyphicons/glyphicons_062_attach.png'
    				//Lets leave this as a blank section, no options just some intro text set above.
    				//'fields' => array()
    //				);
    
    				
    $sections[] = array(
    				'icon' => 'cog',
    				'icon_class' => 'icon-large',
    				'title' => __('General Options', Redux_TEXT_DOMAIN),
    				'desc' => __('<p class="description">These are the general options for the theme</p>', Redux_TEXT_DOMAIN),
    				'fields' => array(
    					array(
    						'id' => 'enable_maintenance',
    						'type' => 'button_set',
    						'title' => __('Enable Maintenance', Redux_TEXT_DOMAIN), 
    						'sub_desc' => __('Enable the themes maintenance mode.', Redux_TEXT_DOMAIN),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '0'
    						),
    					array(
    						'id' => 'enable_responsive',
    						'type' => 'button_set',
    						'title' => __('Enable Responsive', Redux_TEXT_DOMAIN), 
    						'sub_desc' => __('Enable/Disable the responsive behaviour of the theme', Redux_TEXT_DOMAIN),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '1'
    						),
    					array(
    						'id' => 'page_layout',
    						'type' => 'radio_img',
    						'title' => __('Page Layout', Redux_TEXT_DOMAIN), 
    						'sub_desc' => __('Select the page layout type', Redux_TEXT_DOMAIN),
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
    						'title' => __('Page shadow (boxed layout only)', Redux_TEXT_DOMAIN), 
    						'sub_desc' => __('Enable the shadow for the boxed layout', Redux_TEXT_DOMAIN),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '1'
    						),
    					array(
    						'id' => 'custom_favicon',
    						'type' => 'upload',
    						'title' => __('Custom favicon', Redux_TEXT_DOMAIN), 
    						'sub_desc' => __('Upload a 16px x 16px Png/Gif image that will represent your website favicon', Redux_TEXT_DOMAIN),
    						'desc' => ''
    						),
    					array(
    						'id' => 'rss_feed_url',
    						'type' => 'text',
    						'title' => __('RSS Feed URL', Redux_TEXT_DOMAIN),
    						'sub_desc' => __('The rss feed URL for your blog.', Redux_TEXT_DOMAIN),
    						'desc' => '',
    						'std' => '?feed=rss2'
    						),
    					array(
    						'id' => 'custom_css',
    						'type' => 'textarea',
    						'title' => __('Custom CSS', Redux_TEXT_DOMAIN), 
    						'sub_desc' => __('Quickly add some CSS to your theme by adding it to this textarea.', Redux_TEXT_DOMAIN),
    						'desc' => '',
    						'std' => ''
    						),
    					array(
    						'id' => 'google_analytics',
    						'type' => 'textarea',
    						'title' => __('Tracking code', Redux_TEXT_DOMAIN), 
    						'sub_desc' => __('Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme. NOTE: Please include the script tag.', Redux_TEXT_DOMAIN),
    						'desc' => '',
    						'std' => ''
    						),
    					array(
    						'id' => 'custom_admin_login_logo',
    						'type' => 'upload',
    						'title' => __('Custom admin login logo', Redux_TEXT_DOMAIN), 
    						'sub_desc' => __('Upload a 254 x 95px image here to replace the admin login logo.', Redux_TEXT_DOMAIN),
    						'desc' => ''
    						)
    					)
    				);
    $sections[] = array(
    				'icon' => 'picture',
    				'icon_class' => 'icon-large',
    				'title' => __('Background Options', Redux_TEXT_DOMAIN),
    				'desc' => __('<p class="description">These are the options for the background.</p>', Redux_TEXT_DOMAIN),
    				'fields' => array(
    					array(
    						'id' => 'use_bg_image',
    						'type' => 'button_set',
    						'title' => __('Use Background Image', Redux_TEXT_DOMAIN), 
    						'sub_desc' => __('Check this to use an image for the body background (boxed layout only).', Redux_TEXT_DOMAIN),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '1'
    						),
    					array(
    						'id' => 'custom_bg_image',
    						'type' => 'upload',
    						'title' => __('Upload Background Image', Redux_TEXT_DOMAIN), 
    						'sub_desc' => __('Either upload or provide a link to your own background here, or choose from the presets below.', Redux_TEXT_DOMAIN),
    						'desc' => ''
    						),
    					array(
    						'id' => 'bg_size',
    						'type' => 'button_set',
    						'title' => __('Background Size', Redux_TEXT_DOMAIN), 
    						'sub_desc' => __('If you are using an image rather than a pattern, select cover to make the image cover the background.', Redux_TEXT_DOMAIN),
    						'desc' => '',
    						'options' => array('cover' => 'Cover','auto' => 'Auto'),
    						'std' => 'auto'
    						),
    					array(
    						'id' => 'preset_bg_image',
    						'type' => 'radio_img_bg',
    						'title' => __('Preset body background image', Redux_TEXT_DOMAIN), 
    						'sub_desc' => __('Select a preset background image for the body background.', Redux_TEXT_DOMAIN),
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
    				'title' => __('Header Options', Redux_TEXT_DOMAIN),
    				'desc' => __('<p class="description">These are the options for the header.</p>', Redux_TEXT_DOMAIN),
    				'fields' => array(
    					array(
    						'id' => 'enable_top_bar',
    						'type' => 'button_set',
    						'title' => __('Enable Top Bar', Redux_TEXT_DOMAIN), 
    						'sub_desc' => __('If enabled, the top bar will show with the menu and social config.', Redux_TEXT_DOMAIN),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '1'
    						),
    					array(
    						'id' => 'top_bar_menu',
    						'type' => 'button_set',
    						'title' => __('Top Bar Menu Location', Redux_TEXT_DOMAIN), 
    						'sub_desc' => __('Choose whether you would like the top bar menu to show on the left or right.', Redux_TEXT_DOMAIN),
    						'desc' => '',
    						'options' => array('1' => 'Left','0' => 'Right'),
    						'std' => '0'
    						),
    					array(
    						'id' => 'top_bar_social_icons',
    						'type' => 'text',
    						'title' => __('Top bar social icon config', Redux_TEXT_DOMAIN),
    						'sub_desc' => "The shortcode to show the social icons in the top bar, where you can customize the type of icons and order that they are shown. NOTE: Make sure you use single quotes (') for parameters with no spaces in between.",
    						'desc' => '',
    						'std' => "[social size='small' style='dark' type='twitter,facebook,dribbble']"
    						),
    					array(
    						'id' => 'show_sub',
    						'type' => 'button_set',
    						'title' => __('Show subscribe aux option', Redux_TEXT_DOMAIN), 
    						'sub_desc' => __('Check this to show the suscribe dropdown in the top bar, allowing users to subscribe via inputting their email address. If you use this, be sure to enter a Mailchimp form action URL in the box below.', Redux_TEXT_DOMAIN),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '0'
    						),
    					array(
    						'id' => 'show_translation',
    						'type' => 'button_set',
    						'title' => __('Show translation aux option', Redux_TEXT_DOMAIN), 
    						'sub_desc' => __('Check this to show the translation dropdown in the top bar.', Redux_TEXT_DOMAIN),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '0'
    						),
    					array(
    						'id' => 'show_account',
    						'type' => 'button_set',
    						'title' => __('Show account aux option', Redux_TEXT_DOMAIN), 
    						'sub_desc' => __('Check this to show the account dropdown in the top bar.', Redux_TEXT_DOMAIN),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '1'
    						),
    					array(
    						'id' => 'show_cart',
    						'type' => 'button_set',
    						'title' => __('Show cart aux option', Redux_TEXT_DOMAIN), 
    						'sub_desc' => __('Check this to show the WooCommerce cart dropdown in the top bar.', Redux_TEXT_DOMAIN),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '0'
    						),
    					array(
    						'id' => 'sub_code',
    						'type' => 'textarea',
    						'title' => __('Subscribe form code', Redux_TEXT_DOMAIN),
    						'sub_desc' => "Enter the form code (e.g. Mailchimp) that will be used for the subscribe dropdown.",
    						'desc' => '',
    						'std' => ""
    						),
    					array(
    						'id' => 'logo_layout',
    						'type' => 'radio_img',
    						'title' => __('Logo Layout', Redux_TEXT_DOMAIN), 
    						'sub_desc' => __('Select the header/logo layout.', Redux_TEXT_DOMAIN),
    						'desc' => '',
    						'options' => array(
    										'logo-left' => array('title' => 'Left Logo', 'img' => Redux_OPTIONS_URL.'img/logo-left.png'),
    										'logo-right' => array('title' => 'Right Logo', 'img' => Redux_OPTIONS_URL.'img/logo-right.png')
    											),
    						'std' => 'logo-left'
    						),
    					array(
    						'id' => 'logo_upload',
    						'type' => 'upload',
    						'title' => __('Logo', Redux_TEXT_DOMAIN), 
    						'sub_desc' => __('Upload your logo here (any size).', Redux_TEXT_DOMAIN),
    						'desc' => ''
    						),
    					array(
    						'id' => 'retina_logo_upload',
    						'type' => 'upload',
    						'title' => __('Retina Logo', Redux_TEXT_DOMAIN), 
    						'sub_desc' => __('Upload the retina version of your logo here.', Redux_TEXT_DOMAIN),
    						'desc' => ''
    						),
    					array(
    						'id' => 'logo_width',
    						'type' => 'text',
    						'title' => __('Logo Width', Redux_TEXT_DOMAIN),
    						'sub_desc' => __('Please enter the width of your logo here (standard size), so that it is restricted for the retina version. Numerical value (no px).', Redux_TEXT_DOMAIN),
    						'desc' => '',
    						'std' => '0',
    						'class' => 'mini'
    						),
    					array(
    						'id' => 'logo_top_spacing',
    						'type' => 'text',
    						'title' => __('Logo Top spacing', Redux_TEXT_DOMAIN),
    						'sub_desc' => '',
    						'desc' => '',
    						'std' => '0',
    						'class' => 'mini'
    						),
    					array(
    						'id' => 'logo_bottom_spacing',
    						'type' => 'text',
    						'title' => __('Logo Bottom spacing', Redux_TEXT_DOMAIN),
    						'sub_desc' => '',
    						'desc' => '',
    						'std' => '0',
    						'class' => 'mini'
    						),
    					array(
    						'id' => 'nav_top_spacing',
    						'type' => 'text',
    						'title' => __('Main Nav Top spacing', Redux_TEXT_DOMAIN),
    						'sub_desc' => 'Add spacing here if you need extra spacing above the main navigation (i.e. if you have a large logo). Numerical value (no px).',
    						'desc' => '',
    						'std' => '0',
    						'class' => 'mini'
    						),
    					array(
    						'id' => 'enable_nav_search',
    						'type' => 'button_set',
    						'title' => __('Enable Nav Search', Redux_TEXT_DOMAIN), 
    						'sub_desc' => __('Enable the search box next to the navigation.', Redux_TEXT_DOMAIN),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '1'
    						),
    					array(
    						'id' => 'enable_mini_header',
    						'type' => 'button_set',
    						'title' => __('Mini header', Redux_TEXT_DOMAIN), 
    						'sub_desc' => __('Enable the mini header when scrolling down the page.', Redux_TEXT_DOMAIN),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '1'
    						),
    					array(
    						'id' => 'enable_logo_fade',
    						'type' => 'button_set',
    						'title' => __('Logo hover fade', Redux_TEXT_DOMAIN), 
    						'sub_desc' => __('Enable the fade effect when you hover the logo.', Redux_TEXT_DOMAIN),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '1'
    						),
    					array(
    						'id' => 'enable_nav_indicator',
    						'type' => 'button_set',
    						'title' => __('Nav line indiciator', Redux_TEXT_DOMAIN), 
    						'sub_desc' => __('Enable the line indictaor on the navigation.', Redux_TEXT_DOMAIN),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '1'
    						),
    					array(
    						'id' => 'enable_header_shadow',
    						'type' => 'button_set',
    						'title' => __('Header Shadow', Redux_TEXT_DOMAIN), 
    						'sub_desc' => __('Enable the shadow below the header.', Redux_TEXT_DOMAIN),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '1'
    						)
    					)
    				);
    $sections[] = array(
    				'icon_type' => 'image',
    				'icon' => Redux_OPTIONS_URL.'img/footer.png',
    				'title' => __('Footer Options', Redux_TEXT_DOMAIN),
    				'desc' => __('<p class="description">These are the options for the footer.</p>', Redux_TEXT_DOMAIN),
    				'fields' => array(
    					array(
    						'id' => 'enable_footer',
    						'type' => 'button_set',
    						'title' => __('Enable Footer', Redux_TEXT_DOMAIN), 
    						'sub_desc' => __('Enable the footer widgets section.', Redux_TEXT_DOMAIN),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '1'
    						),
    					array(
    						'id' => 'enable_footer_divider',
    						'type' => 'button_set',
    						'title' => __('Footer Divider', Redux_TEXT_DOMAIN), 
    						'sub_desc' => __('Enable the footer divider above the footer.', Redux_TEXT_DOMAIN),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '1'
    						),
    					array(
    						'id' => 'footer_layout',
    						'type' => 'radio_img',
    						'title' => __('Footer Layout', Redux_TEXT_DOMAIN), 
    						'sub_desc' => __('Select the footer column layout.', Redux_TEXT_DOMAIN),
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
    						'title' => __('Enable Copyright', Redux_TEXT_DOMAIN), 
    						'sub_desc' => __('Enable the footer copyright section.', Redux_TEXT_DOMAIN),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '1'
    						),
    					array(
    						'id' => 'enable_copyright_divider',
    						'type' => 'button_set',
    						'title' => __('Copyright Divider', Redux_TEXT_DOMAIN), 
    						'sub_desc' => __('Enable the copyright divider above the copyright.', Redux_TEXT_DOMAIN),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '1'
    						),
    					array(
    						'id' => 'footer_copyright_text',
    						'type' => 'textarea',
    						'title' => __('Footer Copyright Text', Redux_TEXT_DOMAIN),
    						'sub_desc' => 'The copyright text that appears in the footer.',
    						'desc' => '',
    						'std' => "&copy;[the-year] Flexform &middot; Built by <a href='http://www.swiftideas.net'>Swift Ideas</a> &middot; Powered by [wp-link]"
    						),
    					array(
    						'id' => 'show_backlink',
    						'type' => 'button_set',
    						'title' => __('Show Swift Ideas Backlink', Redux_TEXT_DOMAIN), 
    						'sub_desc' => __('If checked, a backlink to our site will be shown in the footer. This is not compulsory, but always appreciated :)', Redux_TEXT_DOMAIN),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '1'
    						),
    					array(
    						'id' => 'footer_gotop_text',
    						'type' => 'text',
    						'title' => __('Go To Top Button Text', Redux_TEXT_DOMAIN),
    						'sub_desc' => 'The text for the go to top button in the bottom right of the footer.',
    						'desc' => '',
    						'std' => ""
    						)
    					)
    				);
    $sections[] = array(
    				'icon' => 'tasks',
    				'icon_class' => 'icon-large',
    				'title' => __('Default Meta Options', Redux_TEXT_DOMAIN),
    				'desc' => __('<p class="description">These are the options to set the defaults for the meta options.</p>', Redux_TEXT_DOMAIN),
    				'fields' => array(
    					array(
    						'id' => 'default_show_page_heading',
    						'type' => 'button_set',
    						'title' => __('Default Show Page Heading', Redux_TEXT_DOMAIN), 
    						'sub_desc' => __('Choose the default state for the page heading, shown/hidden.', Redux_TEXT_DOMAIN),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '1'
    						),
    					array(
    						'id' => 'default_page_heading_bg_alt',
    						'type' => 'select',
    						'title' => __('Default Page Heading Background', Redux_TEXT_DOMAIN),
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
    						'title' => __('Default Sidebar Config', Redux_TEXT_DOMAIN),
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
    						'title' => __('Default Left Sidebar', Redux_TEXT_DOMAIN),
    						'sub_desc' => "Choose the default left sidebar for pages/posts",
    						'options' => sf_sidebars_array(),
    						'desc' => '',
    						'std' => 'Sidebar-1'
    						),
    					array(
    						'id' => 'default_right_sidebar',
    						'type' => 'select',
    						'title' => __('Default Right Sidebar', Redux_TEXT_DOMAIN),
    						'sub_desc' => "Choose the default right sidebar for pages/posts",
    						'options' => sf_sidebars_array(),
    						'desc' => '',
    						'std' => 'Sidebar-1'
    						)
    					)
    				);
	$sections[] = array(
				'icon' => 'eye-open',
				'icon_class' => 'icon-large',
				'title' => __('Asset Background Options', Redux_TEXT_DOMAIN),
				'desc' => __('<p class="description">These are the options for the alternative backgrounds that you can set for page headings / full width page builder assets.</p>', Redux_TEXT_DOMAIN),
				'fields' => array(
					array(
						'id' => 'filter_wrap_bg',
						'type' => 'select',
						'title' => __('Filter Wrap Alt Background', Redux_TEXT_DOMAIN),
						'sub_desc' => "Choose the alt background configuration for the filter wrap that appears within portfolio/blog page builder elements.",
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
						'id' => 'alt_divide_0',
						'type' => 'divide'
						),
					array(
					    'id' => 'alt_one_bg_color',
					    'type' => 'color',
					    'title' => __('Alt 1 Background Color', Redux_TEXT_DOMAIN), 
					    'sub_desc' => __('The background color for the Alt-1 alternative background.', Redux_TEXT_DOMAIN),
					    'std' => '#FFFFFF'
						),
					array(
					    'id' => 'alt_one_text_color',
					    'type' => 'color',
					    'title' => __('Alt 1 Text Color', Redux_TEXT_DOMAIN), 
					    'sub_desc' => __('The text color for the Alt-1 alternative background.', Redux_TEXT_DOMAIN),
					    'std' => '#222222'
						),
					array(
						'id' => 'alt_one_bg_image',
						'type' => 'upload',
						'title' => __('Alt 1 Background Image', Redux_TEXT_DOMAIN), 
						'sub_desc' => __('Upload an image for the Alt-1 alternative background here.', Redux_TEXT_DOMAIN),
						'desc' => ''
						),
					array(
						'id' => 'alt_one_bg_image_size',
						'type' => 'button_set',
						'title' => __('Alt 1 Background Size', Redux_TEXT_DOMAIN), 
						'sub_desc' => __('If you are using an image rather than a pattern, select cover to make the image cover the background.', Redux_TEXT_DOMAIN),
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
					    'title' => __('Alt 2 Background Color', Redux_TEXT_DOMAIN), 
					    'sub_desc' => __('The background color for the Alt-2 alternative background.', Redux_TEXT_DOMAIN),
					    'std' => '#FFFFFF'
						),
					array(
					    'id' => 'alt_two_text_color',
					    'type' => 'color',
					    'title' => __('Alt 2 Text Color', Redux_TEXT_DOMAIN), 
					    'sub_desc' => __('The text color for the Alt-2 alternative background.', Redux_TEXT_DOMAIN),
					    'std' => '#222222'
						),
					array(
						'id' => 'alt_two_bg_image',
						'type' => 'upload',
						'title' => __('Alt 2 Background Image', Redux_TEXT_DOMAIN), 
						'sub_desc' => __('Upload an image for the Alt-2 alternative background here.', Redux_TEXT_DOMAIN),
						'desc' => ''
						),
					array(
						'id' => 'alt_two_bg_image_size',
						'type' => 'button_set',
						'title' => __('Alt 2 Background Size', Redux_TEXT_DOMAIN), 
						'sub_desc' => __('If you are using an image rather than a pattern, select cover to make the image cover the background.', Redux_TEXT_DOMAIN),
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
					    'title' => __('Alt 3 Background Color', Redux_TEXT_DOMAIN), 
					    'sub_desc' => __('The background color for the Alt-3 alternative background.', Redux_TEXT_DOMAIN),
					    'std' => '#FFFFFF'
						),
					array(
					    'id' => 'alt_three_text_color',
					    'type' => 'color',
					    'title' => __('Alt 3 Text Color', Redux_TEXT_DOMAIN), 
					    'sub_desc' => __('The text color for the Alt-3 alternative background.', Redux_TEXT_DOMAIN),
					    'std' => '#222222'
						),
					array(
						'id' => 'alt_three_bg_image',
						'type' => 'upload',
						'title' => __('Alt 3 Background Image', Redux_TEXT_DOMAIN), 
						'sub_desc' => __('Upload an image for the Alt-3 alternative background here.', Redux_TEXT_DOMAIN),
						'desc' => ''
						),
					array(
						'id' => 'alt_three_bg_image_size',
						'type' => 'button_set',
						'title' => __('Alt 3 Background Size', Redux_TEXT_DOMAIN), 
						'sub_desc' => __('If you are using an image rather than a pattern, select cover to make the image cover the background.', Redux_TEXT_DOMAIN),
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
					    'title' => __('Alt 4 Background Color', Redux_TEXT_DOMAIN), 
					    'sub_desc' => __('The background color for the Alt-4 alternative background.', Redux_TEXT_DOMAIN),
					    'std' => '#FFFFFF'
						),
					array(
					    'id' => 'alt_four_text_color',
					    'type' => 'color',
					    'title' => __('Alt 4 Text Color', Redux_TEXT_DOMAIN), 
					    'sub_desc' => __('The text color for the Alt-4 alternative background.', Redux_TEXT_DOMAIN),
					    'std' => '#222222'
						),
					array(
						'id' => 'alt_four_bg_image',
						'type' => 'upload',
						'title' => __('Alt 4 Background Image', Redux_TEXT_DOMAIN), 
						'sub_desc' => __('Upload an image for the Alt-4 alternative background here.', Redux_TEXT_DOMAIN),
						'desc' => ''
						),
					array(
						'id' => 'alt_four_bg_image_size',
						'type' => 'button_set',
						'title' => __('Alt 4 Background Size', Redux_TEXT_DOMAIN), 
						'sub_desc' => __('If you are using an image rather than a pattern, select cover to make the image cover the background.', Redux_TEXT_DOMAIN),
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
					    'title' => __('Alt 5 Background Color', Redux_TEXT_DOMAIN), 
					    'sub_desc' => __('The background color for the Alt-5 alternative background.', Redux_TEXT_DOMAIN),
					    'std' => '#FFFFFF'
						),
					array(
					    'id' => 'alt_five_text_color',
					    'type' => 'color',
					    'title' => __('Alt 5 Text Color', Redux_TEXT_DOMAIN), 
					    'sub_desc' => __('The text color for the Alt-5 alternative background.', Redux_TEXT_DOMAIN),
					    'std' => '#222222'
						),
					array(
						'id' => 'alt_five_bg_image',
						'type' => 'upload',
						'title' => __('Alt 5 Background Image', Redux_TEXT_DOMAIN), 
						'sub_desc' => __('Upload an image for the Alt-5 alternative background here.', Redux_TEXT_DOMAIN),
						'desc' => ''
						),
					array(
						'id' => 'alt_five_bg_image_size',
						'type' => 'button_set',
						'title' => __('Alt 5 Background Size', Redux_TEXT_DOMAIN), 
						'sub_desc' => __('If you are using an image rather than a pattern, select cover to make the image cover the background.', Redux_TEXT_DOMAIN),
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
					    'title' => __('Alt 6 Background Color', Redux_TEXT_DOMAIN), 
					    'sub_desc' => __('The background color for the Alt-6 alternative background.', Redux_TEXT_DOMAIN),
					    'std' => '#FFFFFF'
						),
					array(
					    'id' => 'alt_six_text_color',
					    'type' => 'color',
					    'title' => __('Alt 6 Text Color', Redux_TEXT_DOMAIN), 
					    'sub_desc' => __('The text color for the Alt-6 alternative background.', Redux_TEXT_DOMAIN),
					    'std' => '#222222'
						),
					array(
						'id' => 'alt_six_bg_image',
						'type' => 'upload',
						'title' => __('Alt 6 Background Image', Redux_TEXT_DOMAIN), 
						'sub_desc' => __('Upload an image for the Alt-6 alternative background here.', Redux_TEXT_DOMAIN),
						'desc' => ''
						),
					array(
						'id' => 'alt_six_bg_image_size',
						'type' => 'button_set',
						'title' => __('Alt 6 Background Size', Redux_TEXT_DOMAIN), 
						'sub_desc' => __('If you are using an image rather than a pattern, select cover to make the image cover the background.', Redux_TEXT_DOMAIN),
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
					    'title' => __('Alt 7 Background Color', Redux_TEXT_DOMAIN), 
					    'sub_desc' => __('The background color for the Alt-7 alternative background.', Redux_TEXT_DOMAIN),
					    'std' => '#FFFFFF'
						),
					array(
					    'id' => 'alt_seven_text_color',
					    'type' => 'color',
					    'title' => __('Alt 7 Text Color', Redux_TEXT_DOMAIN), 
					    'sub_desc' => __('The text color for the Alt-7 alternative background.', Redux_TEXT_DOMAIN),
					    'std' => '#222222'
						),
					array(
						'id' => 'alt_seven_bg_image',
						'type' => 'upload',
						'title' => __('Alt 7 Background Image', Redux_TEXT_DOMAIN), 
						'sub_desc' => __('Upload an image for the Alt-7 alternative background here.', Redux_TEXT_DOMAIN),
						'desc' => ''
						),
					array(
						'id' => 'alt_seven_bg_image_size',
						'type' => 'button_set',
						'title' => __('Alt 7 Background Size', Redux_TEXT_DOMAIN), 
						'sub_desc' => __('If you are using an image rather than a pattern, select cover to make the image cover the background.', Redux_TEXT_DOMAIN),
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
					    'title' => __('Alt 8 Background Color', Redux_TEXT_DOMAIN), 
					    'sub_desc' => __('The background color for the Alt-8 alternative background.', Redux_TEXT_DOMAIN),
					    'std' => '#FFFFFF'
						),
					array(
					    'id' => 'alt_eight_text_color',
					    'type' => 'color',
					    'title' => __('Alt 8 Text Color', Redux_TEXT_DOMAIN), 
					    'sub_desc' => __('The text color for the Alt-8 alternative background.', Redux_TEXT_DOMAIN),
					    'std' => '#222222'
						),
					array(
						'id' => 'alt_eight_bg_image',
						'type' => 'upload',
						'title' => __('Alt 8 Background Image', Redux_TEXT_DOMAIN), 
						'sub_desc' => __('Upload an image for the Alt-8 alternative background here.', Redux_TEXT_DOMAIN),
						'desc' => ''
						),
					array(
						'id' => 'alt_eight_bg_image_size',
						'type' => 'button_set',
						'title' => __('Alt 8 Background Size', Redux_TEXT_DOMAIN), 
						'sub_desc' => __('If you are using an image rather than a pattern, select cover to make the image cover the background.', Redux_TEXT_DOMAIN),
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
					    'title' => __('Alt 9 Background Color', Redux_TEXT_DOMAIN), 
					    'sub_desc' => __('The background color for the Alt-9 alternative background.', Redux_TEXT_DOMAIN),
					    'std' => '#FFFFFF'
						),
					array(
					    'id' => 'alt_nine_text_color',
					    'type' => 'color',
					    'title' => __('Alt 9 Text Color', Redux_TEXT_DOMAIN), 
					    'sub_desc' => __('The text color for the Alt-9 alternative background.', Redux_TEXT_DOMAIN),
					    'std' => '#222222'
						),
					array(
						'id' => 'alt_nine_bg_image',
						'type' => 'upload',
						'title' => __('Alt 9 Background Image', Redux_TEXT_DOMAIN), 
						'sub_desc' => __('Upload an image for the Alt-9 alternative background here.', Redux_TEXT_DOMAIN),
						'desc' => ''
						),
					array(
						'id' => 'alt_nine_bg_image_size',
						'type' => 'button_set',
						'title' => __('Alt 9 Background Size', Redux_TEXT_DOMAIN), 
						'sub_desc' => __('If you are using an image rather than a pattern, select cover to make the image cover the background.', Redux_TEXT_DOMAIN),
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
					    'title' => __('Alt 10 Background Color', Redux_TEXT_DOMAIN), 
					    'sub_desc' => __('The background color for the Alt-10 alternative background.', Redux_TEXT_DOMAIN),
					    'std' => '#FFFFFF'
						),
					array(
					    'id' => 'alt_ten_text_color',
					    'type' => 'color',
					    'title' => __('Alt 10 Text Color', Redux_TEXT_DOMAIN), 
					    'sub_desc' => __('The text color for the Alt-10 alternative background.', Redux_TEXT_DOMAIN),
					    'std' => '#222222'
						),
					array(
						'id' => 'alt_ten_bg_image',
						'type' => 'upload',
						'title' => __('Alt 10 Background Image', Redux_TEXT_DOMAIN), 
						'sub_desc' => __('Upload an image for the Alt-10 alternative background here.', Redux_TEXT_DOMAIN),
						'desc' => ''
						),
					array(
						'id' => 'alt_ten_bg_image_size',
						'type' => 'button_set',
						'title' => __('Alt 10 Background Size', Redux_TEXT_DOMAIN), 
						'sub_desc' => __('If you are using an image rather than a pattern, select cover to make the image cover the background.', Redux_TEXT_DOMAIN),
						'desc' => '',
						'options' => array('cover' => 'Cover','auto' => 'Auto'),
						'std' => 'auto'
						)
					)
				);
   	$sections[] = array(
   					'icon' => 'list',
   					'icon_class' => 'icon-large',
   					'title' => __('Archive/Category Options', Redux_TEXT_DOMAIN),
   					'desc' => __('<p class="description">These are the options for the archive/category pages.</p>', Redux_TEXT_DOMAIN),
   					'fields' => array(
   						array(
   							'id' => 'archive_sidebar_config',
   							'type' => 'select',
   							'title' => __('Sidebar Config', Redux_TEXT_DOMAIN),
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
   							'title' => __('Left Sidebar', Redux_TEXT_DOMAIN),
   							'sub_desc' => "Choose the left sidebar for Left/Both sidebar configs.",
   							'options' => sf_sidebars_array(),
   							'desc' => '',
   							'std' => 'Sidebar-1'
   							),
   						array(
   							'id' => 'archive_sidebar_right',
   							'type' => 'select',
   							'title' => __('Right Sidebar', Redux_TEXT_DOMAIN),
   							'sub_desc' => "Choose the left sidebar for Right/Both sidebar configs.",
   							'options' => sf_sidebars_array(),
   							'desc' => '',
   							'std' => 'Sidebar-1'
   							),
   						array(
   							'id' => 'archive_display_type',
   							'type' => 'select',
   							'title' => __('Display Type', Redux_TEXT_DOMAIN),
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
   							'title' => __('Portfolio Archive Display Type', Redux_TEXT_DOMAIN),
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
   							'title' => __('Portfolio Archive Columns', Redux_TEXT_DOMAIN),
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
    				'icon_class' => 'icon-large',
    				'title' => __('Font Options', Redux_TEXT_DOMAIN),
    				'desc' => __('<p class="description">These are the options for fonts used within the theme.</p>', Redux_TEXT_DOMAIN),
    				'fields' => array(
    					array(
    						'id' => 'body_font_option',
    						'type' => 'button_set',
    						'title' => __('Body Font', Redux_TEXT_DOMAIN), 
    						'sub_desc' => __('Choose the type of font that you want to use for the body text.', Redux_TEXT_DOMAIN),
    						'desc' => '',
    						'options' => array('standard' => 'Standard','google' => 'Google', 'fontdeck' => 'FontDeck'),
    						'std' => 'standard'
    						),
    					array(
    						'id' => 'web_body_font',
    						'type' => 'select',
    						'title' => __('Body Standard Font', Redux_TEXT_DOMAIN), 
    						'sub_desc' => __('The font that is used as the body text and other small text throughout the theme.', Redux_TEXT_DOMAIN),
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
    						'title' => __('Standard Google Font', Redux_TEXT_DOMAIN), 
    						'sub_desc' => __('The font that is used as the body text and other small text throughout the theme.', Redux_TEXT_DOMAIN),
    						'desc' => '',
    						'placeholder' => 'Default Font'
    						),
    					array(
    						'id' => 'fontdeck_standard_font',
    						'type' => 'textarea',
    						'title' => __('Standard FontDeck Font', Redux_TEXT_DOMAIN), 
    						'sub_desc' => __('Paste the css here that can be found from step 2 of the FontDeck instructions (<a href="http://flexform.swiftideas.net/img/fontdeck_step2.png" class="view" target="_blank">view</a>). NOTE: Make sure you provide the JS code in the box at the bottom for this/all FontDeck fonts you want to use.', Redux_TEXT_DOMAIN),
    						'desc' => '',
    						'std' => ''
    						),
    					array(
    						'id' => 'font_divide_a',
    						'type' => 'divide'
    						),
    					array(
    						'id' => 'headings_font_option',
    						'type' => 'button_set',
    						'title' => __('Headings Font', Redux_TEXT_DOMAIN), 
    						'sub_desc' => __('Choose the type of font that you want to use for the body text.', Redux_TEXT_DOMAIN),
    						'desc' => '',
    						'options' => array('standard' => 'Standard','google' => 'Google', 'fontdeck' => 'FontDeck'),
    						'std' => 'standard'
    						),
    					array(
    						'id' => 'web_heading_font',
    						'type' => 'select',
    						'title' => __('Heading Standard Font', Redux_TEXT_DOMAIN), 
    						'sub_desc' => __('The font that is used for the headings throughout the theme.', Redux_TEXT_DOMAIN),
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
    						'title' => __('Headings Google Font', Redux_TEXT_DOMAIN), 
    						'sub_desc' => __('The font that is used for the headings throughout the theme.', Redux_TEXT_DOMAIN),
    						'desc' => ''
    						),
    					array(
    						'id' => 'fontdeck_heading_font',
    						'type' => 'textarea',
    						'title' => __('Heading FontDeck Font', Redux_TEXT_DOMAIN), 
    						'sub_desc' => __('Paste the css here that can be found from step 2 of the FontDeck instructions (<a href="http://flexform.swiftideas.net/img/fontdeck_step2.png" class="view" target="_blank">view</a>). NOTE: Make sure you provide the JS code in the box at the bottom for this/all FontDeck fonts you want to use.', Redux_TEXT_DOMAIN),
    						'desc' => '',
    						'std' => ''
    						),
    					array(
    						'id' => 'font_divide_b',
    						'type' => 'divide'
    						),
    					array(
    						'id' => 'menu_font_option',
    						'type' => 'button_set',
    						'title' => __('Menu Font', Redux_TEXT_DOMAIN), 
    						'sub_desc' => __('Choose the type of font that you want to use for the menu text.', Redux_TEXT_DOMAIN),
    						'desc' => '',
    						'options' => array('standard' => 'Standard','google' => 'Google', 'fontdeck' => 'FontDeck'),
    						'std' => 'standard'
    						),
    					array(
    						'id' => 'web_menu_font',
    						'type' => 'select',
    						'title' => __('Menu Standard Font', Redux_TEXT_DOMAIN), 
    						'sub_desc' => __('The font that is used for the menu.', Redux_TEXT_DOMAIN),
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
    						'title' => __('Menu Google Font', Redux_TEXT_DOMAIN), 
    						'sub_desc' => __('The font that is used for the menu.', Redux_TEXT_DOMAIN),
    						'desc' => ''
    						),
    					array(
    						'id' => 'fontdeck_menu_font',
    						'type' => 'textarea',
    						'title' => __('Menu FontDeck Font', Redux_TEXT_DOMAIN), 
    						'sub_desc' => __('Paste the css here that can be found from step 2 of the FontDeck instructions (<a href="http://flexform.swiftideas.net/img/fontdeck_step2.png" class="view" target="_blank">view</a>). NOTE: Make sure you provide the JS code in the box at the bottom for this/all FontDeck fonts you want to use.', Redux_TEXT_DOMAIN),
    						'desc' => '',
    						'std' => ''
    						),
    					array(
    						'id' => 'font_divide_c',
    						'type' => 'divide'
    						),
    					array(
    						'id' => 'fontdeck_js',
    						'type' => 'textarea',
    						'title' => __('FontDeck JS Code', Redux_TEXT_DOMAIN), 
    						'sub_desc' => __('Paste the js code here that can be found from step 1 of the FontDeck instructions (<a href="http://flexform.swiftideas.net/img/fontdeck_step1.png" class="view" target="_blank">view</a>).', Redux_TEXT_DOMAIN),
    						'desc' => '',
    						'std' => ''
    						),
    					)
    				);
    				
   	$sections[] = array(
   					'icon' => 'text-height',
   					'icon_class' => 'icon-large',
   					'title' => __('Font Size Options', Redux_TEXT_DOMAIN),
   					'desc' => __('<p class="description">These are the options for fonts used within the theme.</p>', Redux_TEXT_DOMAIN),
   					'fields' => array(
   						array(
   							'id' => 'body_font_size',
   							'type' => 'slider',
   							'title' => __('Body Font Size', Redux_TEXT_DOMAIN), 
   							'sub_desc' => __('Select the size of the body font.', Redux_TEXT_DOMAIN),
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
   							'title' => __('Body Font Line Height', Redux_TEXT_DOMAIN), 
   							'sub_desc' => __('Select the line height of the body font.', Redux_TEXT_DOMAIN),
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
   							'title' => __('Menu Font Size', Redux_TEXT_DOMAIN), 
   							'sub_desc' => __('Select the size of the menu font.', Redux_TEXT_DOMAIN),
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
   							'title' => __('H1 Font Size', Redux_TEXT_DOMAIN), 
   							'sub_desc' => __('Select the size of the h1 font.', Redux_TEXT_DOMAIN),
   							'desc' => '',
   							'from' => '10',
   							'to' => '60',
   							'step' => '1',
   							'unit' => 'px',
   							'std' => '30'
   							),
   						array(
   							'id' => 'h1_font_line_height',
   							'type' => 'slider',
   							'title' => __('H1 Font Line Height', Redux_TEXT_DOMAIN), 
   							'sub_desc' => __('Select the line height of the h1 font.', Redux_TEXT_DOMAIN),
   							'desc' => '',
   							'from' => '10',
   							'to' => '100',
   							'step' => '1',
   							'unit' => 'px',
   							'std' => '42'
   							),
   						array(
   							'id' => 'font_divide_2',
   							'type' => 'divide'
   							),
   						array(
   							'id' => 'h2_font_size',
   							'type' => 'slider',
   							'title' => __('H2 Font Size', Redux_TEXT_DOMAIN), 
   							'sub_desc' => __('Select the size of the h2 font.', Redux_TEXT_DOMAIN),
   							'desc' => '',
   							'from' => '10',
   							'to' => '60',
   							'step' => '1',
   							'unit' => 'px',
   							'std' => '24'
   							),
   						array(
   							'id' => 'h2_font_line_height',
   							'type' => 'slider',
   							'title' => __('H2 Font Line Height', Redux_TEXT_DOMAIN), 
   							'sub_desc' => __('Select the line height of the h2 font.', Redux_TEXT_DOMAIN),
   							'desc' => '',
   							'from' => '10',
   							'to' => '100',
   							'step' => '1',
   							'unit' => 'px',
   							'std' => '32'
   							),
   						array(
   							'id' => 'font_divide_3',
   							'type' => 'divide'
   							),
   						array(
   							'id' => 'h3_font_size',
   							'type' => 'slider',
   							'title' => __('H3 Font Size', Redux_TEXT_DOMAIN), 
   							'sub_desc' => __('Select the size of the h3 font.', Redux_TEXT_DOMAIN),
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
   							'title' => __('H3 Font Line Height', Redux_TEXT_DOMAIN), 
   							'sub_desc' => __('Select the line height of the h3 font.', Redux_TEXT_DOMAIN),
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
   							'title' => __('H4 Font Size', Redux_TEXT_DOMAIN), 
   							'sub_desc' => __('Select the size of the h4 font.', Redux_TEXT_DOMAIN),
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
   							'title' => __('H4 Font Line Height', Redux_TEXT_DOMAIN), 
   							'sub_desc' => __('Select the line height of the h4 font.', Redux_TEXT_DOMAIN),
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
   							'title' => __('H5 Font Size', Redux_TEXT_DOMAIN), 
   							'sub_desc' => __('Select the size of the h5 font.', Redux_TEXT_DOMAIN),
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
   							'title' => __('H5 Font Line Height', Redux_TEXT_DOMAIN), 
   							'sub_desc' => __('Select the line height of the h5 font.', Redux_TEXT_DOMAIN),
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
   							'title' => __('H6 Font Size', Redux_TEXT_DOMAIN), 
   							'sub_desc' => __('Select the size of the h6 font.', Redux_TEXT_DOMAIN),
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
   							'title' => __('H6 Font Line Height', Redux_TEXT_DOMAIN), 
   							'sub_desc' => __('Select the line height of the h6 font.', Redux_TEXT_DOMAIN),
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
    				'icon_class' => 'icon-large',
    				'title' => __('Testimonials Options', Redux_TEXT_DOMAIN),
    				'desc' => __('<p class="description">These are the options for the Testimonials pages/assets.</p>', Redux_TEXT_DOMAIN),
    				'fields' => array(
    						array(
    							'id' => 'testimonial_page',
    							'type' => 'pages_select',
    							'title' => __('Testimonial Page', Redux_TEXT_DOMAIN), 
    							'sub_desc' => __('Select the page that is your testimonial index page. This is used to link to the page from various places.', Redux_TEXT_DOMAIN),
    							'desc' => '',
    							'std' => '',
    							'args' => array()
    							),
    					)
    				);
    $sections[] = array(
    				'icon' => 'user',
    				'icon_class' => 'icon-large',
    				'title' => __('Jobs Options', Redux_TEXT_DOMAIN),
    				'desc' => __('<p class="description">These are the options for the Jobs pages/assets.</p>', Redux_TEXT_DOMAIN),
    				'fields' => array(
    						array(
    							'id' => 'jobs_page',
    							'type' => 'pages_select',
    							'title' => __('Jobs Page', Redux_TEXT_DOMAIN), 
    							'sub_desc' => __('Select the page that is your jobs index page. This is used to link to the page from various places.', Redux_TEXT_DOMAIN),
    							'desc' => '',
    							'std' => '',
    							'args' => array()
    							),
    					)
    				);
    $sections[] = array(
    				'icon' => 'shopping-cart',
    				'icon_class' => 'icon-large',
    				'title' => __('WooCommerce Options', Redux_TEXT_DOMAIN),
    				'desc' => __('<p class="description">These are the options for the WooCommerce Shop/Category pages.</p>', Redux_TEXT_DOMAIN),
    				'fields' => array(
    						array(
    							'id' => 'woo_sidebar_config',
    							'type' => 'select',
    							'title' => __('WooCommerce Sidebar Config', Redux_TEXT_DOMAIN),
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
    							'title' => __('WooCommerce Left Sidebar', Redux_TEXT_DOMAIN),
    							'sub_desc' => "Choose the left sidebar for WooCommerce shop/category pages.",
    							'options' => sf_sidebars_array(),
    							'desc' => '',
    							'std' => 'woocommerce-sidebar'
    							),
    						array(
    							'id' => 'woo_right_sidebar',
    							'type' => 'select',
    							'title' => __('WooCommerce Right Sidebar', Redux_TEXT_DOMAIN),
    							'sub_desc' => "Choose the right sidebar for WooCommerce shop/category pages.",
    							'options' => sf_sidebars_array(),
    							'desc' => '',
    							'std' => 'woocommerce-sidebar'
    							),
    						array(
    							'id' => 'woo_page_heading_bg_alt',
    							'type' => 'select',
    							'title' => __('WooCommerce Page Heading Background', Redux_TEXT_DOMAIN),
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
    							'id' => 'enable_pb_product_pages',
    							'type' => 'button_set',
    							'title' => __('Page Builder on Product Pages', Redux_TEXT_DOMAIN), 
    							'sub_desc' => __('Choose whether you would like the page builder to be enabled on product pages or not. If it is enabled, then the description accordion will use the "Short Description" content, and the page builder content will appear below the images/details area.', Redux_TEXT_DOMAIN),
    							'desc' => '',
    							'options' => array('1' => 'On','0' => 'Off'),
    							'std' => '0'
    							),
    						array(
    							'id' => 'default_product_sidebar_config',
    							'type' => 'select',
    							'title' => __('Default Product Sidebar Config', Redux_TEXT_DOMAIN),
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
    							'title' => __('Default Product Left Sidebar', Redux_TEXT_DOMAIN),
    							'sub_desc' => "Choose the default left sidebar for WooCommerce product pages.",
    							'options' => sf_sidebars_array(),
    							'desc' => '',
    							'std' => 'woocommerce-sidebar'
    							),
    						array(
    							'id' => 'default_product_right_sidebar',
    							'type' => 'select',
    							'title' => __('Default Product Right Sidebar', Redux_TEXT_DOMAIN),
    							'sub_desc' => "Choose the default right sidebar for WooCommerce product pages.",
    							'options' => sf_sidebars_array(),
    							'desc' => '',
    							'std' => 'woocommerce-sidebar'
    							),
    						
    					)
    				);			
    $sections[] = array(
    				'icon' => 'twitter',
    				'icon_class' => 'icon-large',
    				'title' => __('Social Profiles', Redux_TEXT_DOMAIN),
    				'desc' => __('<p class="description">These are the fields that power the social shortcode. If you include a link/username here, then the icon will be included in the shortcodes output.</p>', Redux_TEXT_DOMAIN),
    				'fields' => array(
    						array(
    							'id' => 'twitter_username',
    							'type' => 'text',
    							'title' => __('Twitter', Redux_TEXT_DOMAIN),
    							'sub_desc' => "Your Twitter username (no @).",
    							'desc' => '',
    							'std' => ''
    							),
    						array(
    							'id' => 'facebook_page_url',
    							'type' => 'text',
    							'title' => __('Facebook', Redux_TEXT_DOMAIN),
    							'sub_desc' => "Your facebook page/profile url",
    							'desc' => '',
    							'std' => ''
    							),
    						array(
    							'id' => 'dribbble_username',
    							'type' => 'text',
    							'title' => __('Dribbble', Redux_TEXT_DOMAIN),
    							'sub_desc' => "Your Dribbble username",
    							'desc' => '',
    							'std' => ''
    							),
    						array(
    							'id' => 'vimeo_username',
    							'type' => 'text',
    							'title' => __('Vimeo', Redux_TEXT_DOMAIN),
    							'sub_desc' => "Your Vimeo username",
    							'desc' => '',
    							'std' => ''
    							),
    						array(
    							'id' => 'tumblr_username',
    							'type' => 'text',
    							'title' => __('Tumblr', Redux_TEXT_DOMAIN),
    							'sub_desc' => "Your Tumblr username",
    							'desc' => '',
    							'std' => ''
    							),
    						array(
    							'id' => 'spotify_username',
    							'type' => 'text',
    							'title' => __('Spotify', Redux_TEXT_DOMAIN),
    							'sub_desc' => "Your Spotify username",
    							'desc' => '',
    							'std' => ''
    							),
    						array(
    							'id' => 'skype_username',
    							'type' => 'text',
    							'title' => __('Skype', Redux_TEXT_DOMAIN),
    							'sub_desc' => "Your Skype username",
    							'desc' => '',
    							'std' => ''
    							),
    						array(
    							'id' => 'linkedin_page_url',
    							'type' => 'text',
    							'title' => __('LinkedIn', Redux_TEXT_DOMAIN),
    							'sub_desc' => "Your LinkedIn page/profile url",
    							'desc' => '',
    							'std' => ''
    							),
    						array(
    							'id' => 'lastfm_username',
    							'type' => 'text',
    							'title' => __('Last.fm', Redux_TEXT_DOMAIN),
    							'sub_desc' => "Your Last.fm username",
    							'desc' => '',
    							'std' => ''
    							),
    						array(
    							'id' => 'googleplus_page_url',
    							'type' => 'text',
    							'title' => __('Google+', Redux_TEXT_DOMAIN),
    							'sub_desc' => "Your Google+ page/profile URL",
    							'desc' => '',
    							'std' => ''
    							),
    						array(
    							'id' => 'flickr_page_url',
    							'type' => 'text',
    							'title' => __('Flickr', Redux_TEXT_DOMAIN),
    							'sub_desc' => "Your Flickr page url",
    							'desc' => '',
    							'std' => ''
    							),
    						array(
    							'id' => 'youtube_username',
    							'type' => 'text',
    							'title' => __('YouTube', Redux_TEXT_DOMAIN),
    							'sub_desc' => "Your YouTube username",
    							'desc' => '',
    							'std' => ''
    							),
    						array(
    							'id' => 'behance_username',
    							'type' => 'text',
    							'title' => __('Behance', Redux_TEXT_DOMAIN),
    							'sub_desc' => "Your Behance username",
    							'desc' => '',
    							'std' => ''
    							),
    						array(
    							'id' => 'pinterest_username',
    							'type' => 'text',
    							'title' => __('Pinterest', Redux_TEXT_DOMAIN),
    							'sub_desc' => "Your Pinterest username",
    							'desc' => '',
    							'std' => ''
    							),
    						array(
    							'id' => 'yelp_url',
    							'type' => 'text',
    							'title' => __('Yelp', Redux_TEXT_DOMAIN),
    							'sub_desc' => "Your Yelp URL",
    							'desc' => '',
    							'std' => ''
    							),
    						array(
    							'id' => 'instagram_username',
    							'type' => 'text',
    							'title' => __('Instagram', Redux_TEXT_DOMAIN),
    							'sub_desc' => "Your Instagram username",
    							'desc' => '',
    							'std' => ''
    							)
    					)
    				);		                
    $tabs = array();

    if(file_exists(trailingslashit(dirname(__FILE__)) . 'README.html')) {
        $tabs['docs'] = array(
            'icon' => 'book',
            'icon_class' => 'icon-large',
            'title' => __('Documentation', Redux_TEXT_DOMAIN),
            'content' => nl2br(file_get_contents(trailingslashit(dirname(__FILE__)) . 'README.html'))
        );
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
