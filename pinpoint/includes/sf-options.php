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
    //$args['dev_mode'] = true;

    // If you want to use Google Webfonts, you MUST define the api key.
    //$args['google_api_key'] = 'xxxx';

    // Define the starting tab for the option panel.
    // Default: '0';
    //$args['last_tab'] = '0';

    // Define the option panel stylesheet. Options are 'standard', 'custom', and 'none'
    // If only minor tweaks are needed, set to 'custom' and override the necessary styles through the included custom.css stylesheet.
    // If replacing the stylesheet, set to 'none' and don't forget to enqueue another stylesheet!
    // Default: 'standard'
    //$args['admin_stylesheet'] = 'standard';

    // Add HTML before the form.
    //$args['intro_text'] = __('<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', Redux_TEXT_DOMAIN);

    // Add content after the form.
    //$args['footer_text'] = __('<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', Redux_TEXT_DOMAIN);

    // Set footer/credit line.
    //$args['footer_credit'] = __('<p>This text is displayed in the options panel footer across from the WordPress version (where it normally says \'Thank you for creating with WordPress\'). This field accepts all HTML.</p>', Redux_TEXT_DOMAIN);

    // Setup custom links in the footer for share icons
    $args['share_icons']['twitter'] = array(
        'link' => 'http://twitter.com/swiftideas',
        'title' => 'Follow us on Twitter', 
        'img' => Redux_OPTIONS_URL . 'img/icons/glyphicons_322_twitter.png'
    );
//    $args['share_icons']['linked_in'] = array(
//        'link' => 'http://www.linkedin.com/profile/view?id=52559281',
//        'title' => 'Find me on LinkedIn', 
//        'img' => Redux_OPTIONS_URL . 'img/icons/glyphicons_337_linked_in.png'
//    );

    // Enable the import/export feature.
    // Default: true
    //$args['show_import_export'] = false;

    // Set a custom option name. Don't forget to replace spaces with underscores!
    $args['opt_name'] = 'sf_pinpoint_options';

    // Set a custom menu icon.
    // Redux ships with the glyphicons free icon pack, included in the options folder.
    // Feel free to use them, add your own icons, or leave this blank for the default.
    //$args['menu_icon'] = '';

    // Set a custom title for the options page.
    // Default: Options
    $args['menu_title'] = __('Pinpoint Options', Redux_TEXT_DOMAIN);

    // Set a custom page title for the options page.
    // Default: Options
    $args['page_title'] = __('Pinpoint Theme Options', Redux_TEXT_DOMAIN);

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
    				'icon' => Redux_OPTIONS_URL.'img/general.png',
    				'title' => __('General Options', Redux_TEXT_DOMAIN),
    				'desc' => __('<p class="description">These are the general options for the theme</p>', Redux_TEXT_DOMAIN),
    				'fields' => array(
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
    						'std' => 'boxed'
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
    						'id' => 'twitter_share_username',
    						'type' => 'text',
    						'title' => __('Twitter Share Username', Redux_TEXT_DOMAIN),
    						'sub_desc' => __('For the Twitter share button, enter your twitter username (no @).', Redux_TEXT_DOMAIN),
    						'desc' => '',
    						'std' => 'swiftideas'
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
    						'sub_desc' => __('Upload a 323px x 67px image here to replace the admin login logo.', Redux_TEXT_DOMAIN),
    						'desc' => ''
    						),
    					array(
    						'id' => 'enable_adv_rev_options',
    						'type' => 'button_set',
    						'title' => __('Enable advanced Revolution Slider options', Redux_TEXT_DOMAIN), 
    						'sub_desc' => __('Enables the responsive height/width options for sliders in the Rev Slider plugin.', Redux_TEXT_DOMAIN),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '0'
    						)
    					)
    				);
    $sections[] = array(
    				'icon' => Redux_OPTIONS_URL.'img/background.png',
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
    				'icon' => Redux_OPTIONS_URL.'img/header.png',
    				'title' => __('Header Options', Redux_TEXT_DOMAIN),
    				'desc' => __('<p class="description">These are the options for the header.</p>', Redux_TEXT_DOMAIN),
    				'fields' => array(
    					array(
    						'id' => 'logo_layout',
    						'type' => 'radio_img',
    						'title' => __('Logo Layout', Redux_TEXT_DOMAIN), 
    						'sub_desc' => __('Select the header/logo layout.', Redux_TEXT_DOMAIN),
    						'desc' => '',
    						'options' => array(
    										'logo-left' => array('title' => 'Left Logo', 'img' => Redux_OPTIONS_URL.'img/logo-left.png'),
    										'logo-center' => array('title' => 'Center Logo', 'img' => Redux_OPTIONS_URL.'img/logo-center.png'),
    										'logo-right' => array('title' => 'Right Logo', 'img' => Redux_OPTIONS_URL.'img/logo-right.png'),
    										'logo-full' => array('title' => 'Full Width Logo', 'img' => Redux_OPTIONS_URL.'img/logo-full.png')
    											),
    						'std' => 'logo-left'
    						),
    					array(
    						'id' => 'logo_upload',
    						'type' => 'upload',
    						'title' => __('Logo', Redux_TEXT_DOMAIN), 
    						'sub_desc' => __('Upload your logo here, ideally this should be 158px x 75px (Upload an image with size 316px x 150px for the logo to be retina).', Redux_TEXT_DOMAIN),
    						'desc' => ''
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
    						'id' => 'logo_right_spacing',
    						'type' => 'text',
    						'title' => __('Logo Right spacing', Redux_TEXT_DOMAIN),
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
    						'id' => 'logo_left_spacing',
    						'type' => 'text',
    						'title' => __('Logo Left spacing', Redux_TEXT_DOMAIN),
    						'sub_desc' => '',
    						'desc' => '',
    						'std' => '0',
    						'class' => 'mini'
    						),
    					array(
    						'id' => 'header_phone_number',
    						'type' => 'text',
    						'title' => __('Header Phone Number Text', Redux_TEXT_DOMAIN),
    						'sub_desc' => 'The phone number text that appears in the header',
    						'desc' => '',
    						'std' => 'Give us a call on +44 (0) 800 123 4567'
    						),
    					array(
    						'id' => 'header_social_icons',
    						'type' => 'button_set',
    						'title' => __('Show social icons in header', Redux_TEXT_DOMAIN), 
    						'sub_desc' => __('If checked, the social icons that you have provided usernames for in the social theme options will display in the header.', Redux_TEXT_DOMAIN),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '1'
    						),
    					array(
    						'id' => 'header_social_config',
    						'type' => 'text',
    						'title' => __('Social icon shortcode config', Redux_TEXT_DOMAIN),
    						'sub_desc' => "The shortcode to show the social icons, where you can customize the type of icons and order that they are shown. NOTE: Make sure you use single quotes (') for parameters with no spaces in between.",
    						'desc' => '',
    						'std' => "[social size='small' type='twitter,facebook,dribbble']"
    						),
    					array(
    						'id' => 'show_sub_icon',
    						'type' => 'button_set',
    						'title' => __('Show subscribe aux option', Redux_TEXT_DOMAIN), 
    						'sub_desc' => __('Check this to show the suscribe icon in the aux header, allowing users to subscribe via inputting their email address. If you use this, be sure to enter a Mailchimp form action URL in the box below.', Redux_TEXT_DOMAIN),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '1'
    						),
    					array(
    						'id' => 'show_search_icon',
    						'type' => 'button_set',
    						'title' => __('Show search aux option', Redux_TEXT_DOMAIN), 
    						'sub_desc' => __('Check this to show the search option in the aux header.', Redux_TEXT_DOMAIN),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '1'
    						),
    					array(
    						'id' => 'show_translation_icon',
    						'type' => 'button_set',
    						'title' => __('Show translation aux option', Redux_TEXT_DOMAIN), 
    						'sub_desc' => __('Check this to show the translation option in the aux header.', Redux_TEXT_DOMAIN),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '1'
    						),
    					array(
    						'id' => 'show_login_icon',
    						'type' => 'button_set',
    						'title' => __('Show login aux option', Redux_TEXT_DOMAIN), 
    						'sub_desc' => __('Check this to show the login option in the aux header.', Redux_TEXT_DOMAIN),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '1'
    						),
    					array(
    						'id' => 'sub_action_url',
    						'type' => 'text',
    						'title' => __('Subscribe form action URL', Redux_TEXT_DOMAIN),
    						'sub_desc' => "Enter a Mailchimp form action URL that will be used when people enter their email address into the subscribe form.",
    						'desc' => '',
    						'std' => ""
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
    						'title' => __('Nav arrow indiciator', Redux_TEXT_DOMAIN), 
    						'sub_desc' => __('Enable the arrow indictaor on the navigation.', Redux_TEXT_DOMAIN),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '1'
    						),
    					array(
    						'id' => 'enable_nav_shadow',
    						'type' => 'button_set',
    						'title' => __('Nav shadow', Redux_TEXT_DOMAIN), 
    						'sub_desc' => __('Enable the shadow underneath the navigation.', Redux_TEXT_DOMAIN),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '0'
    						),
    					array(
    						'id' => 'enable_menu_dividers',
    						'type' => 'button_set',
    						'title' => __('Menu dividers', Redux_TEXT_DOMAIN), 
    						'sub_desc' => __('Enable the menu dividers in the navigation.', Redux_TEXT_DOMAIN),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '0'
    						),
    					array(
    						'id' => 'enable_accent_bar',
    						'type' => 'button_set',
    						'title' => __('Header accent bar', Redux_TEXT_DOMAIN), 
    						'sub_desc' => __('Enable the accent bar above the navigation.', Redux_TEXT_DOMAIN),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '1'
    						)
    					)
    				);
    $sections[] = array(
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
    						'id' => 'footer_copyright_text',
    						'type' => 'text',
    						'title' => __('Footer Copyright Text', Redux_TEXT_DOMAIN),
    						'sub_desc' => 'The copyright text that appears in the footer.',
    						'desc' => '',
    						'std' => "Copyright [the-year] | Pinpoint by <a href='http://www.swiftideas.net'>Swift Ideas</a> | Powered by [wp-link]"
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
    						'std' => "Beam me up"
    						)
    					)
    				);
        $sections[] = array(
    				'icon' => Redux_OPTIONS_URL.'img/font.png',
    				'title' => __('Font Options', Redux_TEXT_DOMAIN),
    				'desc' => __('<p class="description">These are the options for fonts used within the theme.</p>', Redux_TEXT_DOMAIN),
    				'fields' => array(
    					array(
    						'id' => 'web_standard_font',
    						'type' => 'select',
    						'title' => __('Default Font', Redux_TEXT_DOMAIN), 
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
    						'id' => 'use_custom_font_one',
    						'type' => 'button_set',
    						'title' => __('Use Google Font (Default)', Redux_TEXT_DOMAIN), 
    						'sub_desc' => __('Select this if you wish to choose your own default font for the theme using the google font selector box below.', Redux_TEXT_DOMAIN),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '0'
    						),
    					array(
    						'id' => 'standard_font',
    						'type' => 'google_webfonts',//doesnt need to be called for callback fields
    						'title' => __('Default Google Font', Redux_TEXT_DOMAIN), 
    						'sub_desc' => __('The font that is used as the body text and other small text throughout the theme.', Redux_TEXT_DOMAIN),
    						'desc' => '',
    						'placeholder' => 'Default Font'
    						),
    					array(
    						'id' => 'web_heading_font',
    						'type' => 'select',
    						'title' => __('Headings Font', Redux_TEXT_DOMAIN), 
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
    						'id' => 'use_custom_font_two',
    						'type' => 'button_set',
    						'title' => __('Use Google Font (Headings)', Redux_TEXT_DOMAIN), 
    						'sub_desc' => __('Select this if you wish to choose your own heading font for the theme using the google font selector box below.', Redux_TEXT_DOMAIN),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '0'
    						),
    					array(
    						'id' => 'heading_font',
    						'type' => 'google_webfonts',//doesnt need to be called for callback fields
    						'title' => __('Headings Google Font', Redux_TEXT_DOMAIN), 
    						'sub_desc' => __('The font that is used for the headings throughout the theme.', Redux_TEXT_DOMAIN),
    						'desc' => ''
    						),
    					array(
    						'id' => 'use_custom_font_impact',
    						'type' => 'button_set',
    						'title' => __('Use Google Font (Impact)', Redux_TEXT_DOMAIN), 
    						'sub_desc' => __('Select this if you wish to choose a seperate Impact Text font for the theme using the google font selector box below.', Redux_TEXT_DOMAIN),
    						'desc' => '',
    						'options' => array('1' => 'On','0' => 'Off'),
    						'std' => '0'
    						),
    					array(
    						'id' => 'impact_font',
    						'type' => 'google_webfonts',//doesnt need to be called for callback fields
    						'title' => __('Default Google Font', Redux_TEXT_DOMAIN), 
    						'sub_desc' => __('The font that is used for the headings throughout the theme.', Redux_TEXT_DOMAIN),
    						'desc' => ''
    						)
    					)
    				);
    
    $sections[] = array(
    				'icon' => Redux_OPTIONS_URL.'img/icons/glyphicons_105_text_height.png',
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
    						'std' => '24'
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
    						'std' => '34'
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
    						'std' => '28'
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
    						'std' => '26'
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
    						'std' => '12'
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
    						'std' => '11'
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
    				'icon' => Redux_OPTIONS_URL.'img/icons/glyphicons_114_list.png',
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
    						'options' => array(
    							'Sidebar-1'		=> 'Sidebar 1',
    							'Sidebar-2'		=> 'Sidebar 2',
    							'Sidebar-3'		=> 'Sidebar 3',
    							'Sidebar-4'		=> 'Sidebar 4',
    							'Sidebar-5'		=> 'Sidebar 5',
    							'Sidebar-6'		=> 'Sidebar 6',
    							'Sidebar-7'		=> 'Sidebar 7',
    							'Sidebar-8'		=> 'Sidebar 8'
    							),
    						'desc' => '',
    						'std' => 'Sidebar-1'
    						),
    					array(
    						'id' => 'archive_sidebar_right',
    						'type' => 'select',
    						'title' => __('Right Sidebar', Redux_TEXT_DOMAIN),
    						'sub_desc' => "Choose the left sidebar for Right/Both sidebar configs.",
    						'options' => array(
    							'Sidebar-1'		=> 'Sidebar 1',
    							'Sidebar-2'		=> 'Sidebar 2',
    							'Sidebar-3'		=> 'Sidebar 3',
    							'Sidebar-4'		=> 'Sidebar 4',
    							'Sidebar-5'		=> 'Sidebar 5',
    							'Sidebar-6'		=> 'Sidebar 6',
    							'Sidebar-7'		=> 'Sidebar 7',
    							'Sidebar-8'		=> 'Sidebar 8'
    							),
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
    						'id' => 'portfolio_archive_type',
    						'type' => 'select',
    						'title' => __('Portfolio Archive Type', Redux_TEXT_DOMAIN),
    						'sub_desc' => "Select the display type.",
    						'options' => array(
    							'default'		=> 'Default',
    							'masonry'		=> 'Masonry'
    							),
    						'desc' => '',
    						'std' => 'masonry'
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
    						'std' => '3'
    						)
    					)
    				);
    $sections[] = array(
    				'icon' => Redux_OPTIONS_URL.'img/blog.png',
    				'title' => __('Blog Options', Redux_TEXT_DOMAIN),
    				'desc' => __('<p class="description">These are the options for the Blog pages/assets.</p>', Redux_TEXT_DOMAIN),
    				'fields' => array(
    						array(
    							'id' => 'blog_page',
    							'type' => 'pages_select',
    							'title' => __('Blog Page', Redux_TEXT_DOMAIN), 
    							'sub_desc' => __('Select the page that is your blog index page. This is used to link to the index from the pagination navigation.', Redux_TEXT_DOMAIN),
    							'desc' => '',
    							'std' => '',
    							'args' => array()
    							),
    					)
    				);
    $sections[] = array(
    				'icon' => Redux_OPTIONS_URL.'img/testimonials.png',
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
    				'icon' => Redux_OPTIONS_URL.'img/job.png',
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
    				'icon' => Redux_OPTIONS_URL.'img/social.png',
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
    							),
    						array(
    							'id' => 'rss_url',
    							'type' => 'text',
    							'title' => __('RSS URL', Redux_TEXT_DOMAIN),
    							'sub_desc' => "Your RSS URL",
    							'desc' => '',
    							'std' => ''
    							)
    					)
    				);		                
    $tabs = array();

    if (function_exists('wp_get_theme')){
        $theme_data = wp_get_theme();
        $item_uri = $theme_data->get('ThemeURI');
        $description = $theme_data->get('Description');
        $author = $theme_data->get('Author');
        $author_uri = $theme_data->get('AuthorURI');
        $version = $theme_data->get('Version');
        $tags = $theme_data->get('Tags');
    }else{
        $theme_data = get_theme_data(trailingslashit(get_stylesheet_directory()) . 'style.css');
        $item_uri = $theme_data['URI'];
        $description = $theme_data['Description'];
        $author = $theme_data['Author'];
        $author_uri = $theme_data['AuthorURI'];
        $version = $theme_data['Version'];
        $tags = $theme_data['Tags'];
     }
    
    $item_info = '<div class="redux-opts-section-desc">';
    $item_info .= '<p class="redux-opts-item-data description item-uri">' . __('<strong>Theme URL:</strong> ', Redux_TEXT_DOMAIN) . '<a href="' . $item_uri . '" target="_blank">' . $item_uri . '</a></p>';
    $item_info .= '<p class="redux-opts-item-data description item-author">' . __('<strong>Author:</strong> ', Redux_TEXT_DOMAIN) . ($author_uri ? '<a href="' . $author_uri . '" target="_blank">' . $author . '</a>' : $author) . '</p>';
    $item_info .= '<p class="redux-opts-item-data description item-version">' . __('<strong>Version:</strong> ', Redux_TEXT_DOMAIN) . $version . '</p>';
    $item_info .= '<p class="redux-opts-item-data description item-description">' . $description . '</p>';
    $item_info .= '<p class="redux-opts-item-data description item-tags">' . __('<strong>Tags:</strong> ', Redux_TEXT_DOMAIN) . implode(', ', $tags) . '</p>';
    $item_info .= '</div>';
    
    $tabs['documentation'] = array(
    				'icon' => Redux_OPTIONS_URL.'img/icons/glyphicons_071_book.png',
    				'title' => __('Documentation', Redux_TEXT_DOMAIN),
    				'content' => '<p>Documentation for Pinpoint is available here <a href="http://pinpoint.swiftideas.net/documentation/" target="_blank">here</a>.</p>'
    				);
    
    
    $tabs['support'] = array(
    				'icon' => Redux_OPTIONS_URL.'img/icons/glyphicons_280_settings.png',
    				'title' => __('Support', Redux_TEXT_DOMAIN),
    				'content' => '<p>If you need support for Pinpoint, please visit our support site <a href="http://support.swiftideas.net" target="_blank">here</a>.</p>'
    				);				
    
    $tabs['translation_plugin'] = array(
    				'icon' => Redux_OPTIONS_URL.'img/icons/glyphicons_060_compass.png',
    				'title' => __('Translation Plugin', Redux_TEXT_DOMAIN),
    				'content' => '<p>Pinpoint is 100% translation and multi-lingual ready, and we recommend that you use the very popular WPML plugin.</p>
    				<a href="http://wpml.org/?aid=27185&affiliate_key=PbyGf1bMfZHc" title="Turn your WordPress site multilingual"><img width="468" height="60" src="http://d2salfytceyqoe.cloudfront.net/wp-content/themes/sitepress/banners/images/wpml_banner_v1_468x60_en.jpeg" alt="Multilingual WordPress" /></a>
    				<p>To translate the static strings, if you are not using WPML then I recommend downloading PO Edit, from <a href="http://www.poedit.net/" target="_blank">http://www.poedit.net/</a>. Once you have installed please follow the steps below:</p>
    				<ol>
    					<li>Open the /pinpoint/languages/ folder and duplicate the en_US.po file, then rename it to your desired language code. For example; for German you need to re-name it as de_DE.po for Spanish es_ES.po for Turkish tr_TR.po etc. You can find all the codes from this link <a href="http://codex.wordpress.org/WordPress_in_Your_Language" target="_blank">http://codex.wordpress.org/WordPress_in_Your_Language</a></li>
    					<li>Then you will need to open the .po file in PO Edit. Once opened, you will see all strings that needs to be translated. Type the translation of a string into the "Translation" column. Do not delete or edit "Original string" part.</li>
    					<li>When you finish translating, save the file. This will create an .mo file in the same directory.</li>
    					<li>Upload the new files into the languages folder of the theme /wp-content/themes/pinpoint/languages/ and then follow this guide: <a href="http://codex.wordpress.org/Installing_WordPress_in_Your_Language#Single-Site_Installations" target="_blank">http://codex.wordpress.org/Installing_WordPress_in_Your_Language#Single-Site_Installations</a></li>
    				</ol>'
    				);

    $tabs['item_info'] = array(
        'icon' => Redux_OPTIONS_URL . 'img/icons/glyphicons_195_circle_info.png',
        'title' => __('Theme Information', Redux_TEXT_DOMAIN),
        'content' => $item_info
    );
    
    if(file_exists(trailingslashit(dirname(__FILE__)) . 'README.html')) {
        $tabs['docs'] = array(
            'icon' => Redux_OPTIONS_URL . 'img/icons/glyphicons_071_book.png',
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
