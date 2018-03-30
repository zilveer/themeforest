<?php
/*
 *
 * Require the framework class before doing anything else, so we can use the defined URLs and directories.
 * If you are running on Windows you may have URL problems which can be fixed by defining the framework url first.
 *
 */
if(!class_exists('Redux_Options')){
    require_once(dirname(__FILE__) . '/options/defaults.php');
}

/*
 *
 * Most of your editing will be done in this section.
 *
 * Here you can override default values, uncomment args and change their values.
 * No $args are required, but they can be over ridden if needed.
 *
 */
function setup_redux_framework_options(){
    $args = array();

    // Setting dev mode to true allows you to view the class settings/info in the panel.
    // Default: true
    $args['dev_mode'] = false;

	// Set the icon for the dev mode tab.
	// If $args['icon_type'] = 'image', this should be the path to the icon.
	// If $args['icon_type'] = 'iconfont', this should be the icon name.
	// Default: info-sign
	//$args['dev_mode_icon'] = 'info-sign';

	// Set the class for the dev mode tab icon.
	// This is ignored unless $args['icon_type'] = 'iconfont'
	// Default: null
	$args['dev_mode_icon_class'] = 'icon-large';

    // If you want to use Google Webfonts, you MUST define the api key.
    $args['google_api_key'] = 'AIzaSyARJV95W1bhfrtQ2trA9FUxMGKHqpYkLS0';

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
    $args['share_icons']['twitter'] = array(
        'link' => 'http://twitter.com/bringthepixel',
        'title' => 'Follow us on Twitter',
        'img' => Redux_OPTIONS_URL . 'img/social/Twitter.png'
    );
    $args['share_icons']['facebook'] = array(
        'link' => 'http://www.facebook.com/bringthepixel',
        'title' => 'Find us on Facebook',
        'img' => Redux_OPTIONS_URL . 'img/social/Facebook.png'
    );

    // Enable the import/export feature.
    // Default: true
    $args['show_import_export'] = true;

	// Set the icon for the import/export tab.
	// If $args['icon_type'] = 'image', this should be the path to the icon.
	// If $args['icon_type'] = 'iconfont', this should be the icon name.
	// Default: refresh
	$args['import_icon'] = 'download';

	// Set the class for the import/export tab icon.
	// This is ignored unless $args['icon_type'] = 'iconfont'
	// Default: null
	$args['import_icon_class'] = 'icon-large';

    // Set a custom option name. Don't forget to replace spaces with underscores!
    $args['opt_name'] = G1_Theme()->get_id();
    $args['sections_filter_name'] = '3clicks';
    $args['skin_options'] = array(
        'style_ui_corners',
        'style_background',
        'style_background_switch',
        'style_background_image',
        'style_background_image_hdpi',
        'style_background_repeat',
        'style_background_position',
        'style_background_attachment',
        'style_background_scroll',
        'style_top_background',
        'style_top_background_switch',
        'style_top_background_image',
        'style_top_background_image_hdpi',
        'style_top_background_repeat',
        'style_top_background_position',
        'style_top_background_attachment',
        'style_top_background_scroll',
        'style_fonts_regular_type',
        'style_fonts_regular_google_font',
        'style_fonts_regular_size',
        'style_fonts_meta_type',
        'style_fonts_meta_google_font',
        'style_fonts_important_type',
        'style_fonts_important_google_font',
        'style_fonts_important_size',
        'style_fonts_primary_nav_type',
        'style_fonts_primary_nav_google_font',
        'style_fonts_primary_nav_size',
        'style_fonts_primary_nav_padding_top',
        'style_fonts_primary_nav_padding_bottom',
        'ta_preheader_open_type',
        'ta_preheader_open_on_startup',
        'ta_preheader_space',
        'ta_preheader_top_divider_switch',
        'ta_preheader_top_divider_color',
        'ta_preheader_top_divider_width',
        'ta_preheader_bottom_divider_switch',
        'ta_preheader_bottom_divider_color',
        'ta_preheader_bottom_divider_width',
        'ta_preheader_layout',
        'ta_preheader_composition',
        'ta_preheader_g1_social_icons',
        'ta_preheader_searchform',
        'ta_preheader_cs_1_background',
        'ta_preheader_cs_1_background_opacity',
        'ta_preheader_cs_1_background_switch',
        'ta_preheader_cs_1_background_image',
        'ta_preheader_cs_1_background_image_hdpi',
        'ta_preheader_cs_1_background_repeat',
        'ta_preheader_cs_1_background_position',
        'ta_preheader_cs_1_background_attachment',
        'ta_preheader_cs_1_text1',
        'ta_preheader_cs_1_text2',
        'ta_preheader_cs_1_text3',
        'ta_preheader_cs_1_link',
        'ta_preheader_cs_1_link_hover',
        'ta_preheader_cs_2_background',
        'ta_preheader_cs_2_text1',
        'ta_header_position',
        'ta_header_space',
        'ta_header_top_divider_switch',
        'ta_header_top_divider_color',
        'ta_header_top_divider_width',
        'ta_header_bottom_divider_switch',
        'ta_header_bottom_divider_color',
        'ta_header_bottom_divider_width',
        'ta_header_layout',
        'ta_header_composition',
        'ta_header_id_margin_top',
        'ta_header_id_margin_bottom',
        'ta_header_primary_nav_margin_top',
        'ta_header_primary_nav_margin_bottom',
        'ta_header_tagline',
        'ta_header_searchform',
        'ta_header_primary_nav_style',
        'ta_header_cs_1_background',
        'ta_header_cs_1_background_opacity',
        'ta_header_cs_1_background_switch',
        'ta_header_cs_1_background_image',
        'ta_header_cs_1_background_image_hdpi',
        'ta_header_cs_1_background_repeat',
        'ta_header_cs_1_background_position',
        'ta_header_cs_1_background_attachment',
        'ta_header_cs_1_text1',
        'ta_header_cs_1_text2',
        'ta_header_cs_1_text3',
        'ta_header_cs_1_link',
        'ta_header_cs_1_link_hover',
        'ta_header_cs_2_background',
        'ta_header_cs_2_text1',
        'ta_precontent_space',
        'ta_precontent_top_divider_switch',
        'ta_precontent_top_divider_color',
        'ta_precontent_top_divider_width',
        'ta_precontent_bottom_divider_switch',
        'ta_precontent_bottom_divider_color',
        'ta_precontent_bottom_divider_width',
        'ta_precontent_layout',
        'ta_precontent_cs_1_background',
        'ta_precontent_cs_1_background_opacity',
        'ta_precontent_cs_1_background_switch',
        'ta_precontent_cs_1_background_image',
        'ta_precontent_cs_1_background_image_hdpi',
        'ta_precontent_cs_1_background_repeat',
        'ta_precontent_cs_1_background_position',
        'ta_precontent_cs_1_background_attachment',
        'ta_precontent_cs_1_text1',
        'ta_precontent_cs_1_text2',
        'ta_precontent_cs_1_text3',
        'ta_precontent_cs_1_link',
        'ta_precontent_cs_1_link_hover',
        'ta_precontent_cs_2_background',
        'ta_precontent_cs_2_text1',
        'ta_content_space',
        'ta_content_top_divider_switch',
        'ta_content_top_divider_color',
        'ta_content_top_divider_width',
        'ta_content_bottom_divider_switch',
        'ta_content_bottom_divider_color',
        'ta_content_bottom_divider_width',
        'ta_content_layout',
        'ta_content_cs_1_background',
        'ta_content_cs_1_background_opacity',
        'ta_content_cs_1_background_switch',
        'ta_content_cs_1_background_image',
        'ta_content_cs_1_background_image_hdpi',
        'ta_content_cs_1_background_repeat',
        'ta_content_cs_1_background_position',
        'ta_content_cs_1_background_attachment',
        'ta_content_cs_1_text1',
        'ta_content_cs_1_text2',
        'ta_content_cs_1_text3',
        'ta_content_cs_1_link',
        'ta_content_cs_1_link_hover',
        'ta_content_cs_2_background',
        'ta_content_cs_2_text1',
        'ta_prefooter_space',
        'ta_prefooter_top_divider_switch',
        'ta_prefooter_top_divider_color',
        'ta_prefooter_top_divider_width',
        'ta_prefooter_bottom_divider_switch',
        'ta_prefooter_bottom_divider_color',
        'ta_prefooter_bottom_divider_width',
        'ta_prefooter_layout',
        'ta_prefooter_composition',
        'ta_prefooter_twitter_toolbar',
        'ta_prefooter_gmap',
        'ta_prefooter_cs_1_background',
        'ta_prefooter_cs_1_background_opacity',
        'ta_prefooter_cs_1_background_switch',
        'ta_prefooter_cs_1_background_image',
        'ta_prefooter_cs_1_background_image_hdpi',
        'ta_prefooter_cs_1_background_repeat',
        'ta_prefooter_cs_1_background_position',
        'ta_prefooter_cs_1_background_attachment',
        'ta_prefooter_cs_1_text1',
        'ta_prefooter_cs_1_text2',
        'ta_prefooter_cs_1_text3',
        'ta_prefooter_cs_1_link',
        'ta_prefooter_cs_1_link_hover',
        'ta_prefooter_cs_2_background',
        'ta_prefooter_cs_2_text1',
        'ta_footer_space',
        'ta_footer_top_divider_switch',
        'ta_footer_top_divider_color',
        'ta_footer_top_divider_width',
        'ta_footer_bottom_divider_switch',
        'ta_footer_bottom_divider_color',
        'ta_footer_bottom_divider_width',
        'ta_footer_layout',
        'ta_footer_composition',
        'ta_footer_cs_1_background',
        'ta_footer_cs_1_background_opacity',
        'ta_footer_cs_1_background_switch',
        'ta_footer_cs_1_background_image',
        'ta_footer_cs_1_background_image_hdpi',
        'ta_footer_cs_1_background_repeat',
        'ta_footer_cs_1_background_position',
        'ta_footer_cs_1_background_attachment',
        'ta_footer_cs_1_text1',
        'ta_footer_cs_1_text2',
        'ta_footer_cs_1_text3',
        'ta_footer_cs_1_link',
        'ta_footer_cs_1_link_hover',
        'ta_footer_cs_2_background',
        'ta_footer_cs_2_text1',
        'map_color',
        'map_invert_lightness',
    );

    // Set a custom menu icon.
    //$args['menu_icon'] = '';

    // Set a custom title for the options page.
    // Default: Options
    $args['menu_title'] = __('Theme Options', Redux_TEXT_DOMAIN);

    // Set a custom page title for the options page.
    // Default: Options
    $args['page_title'] = __('Theme Options', Redux_TEXT_DOMAIN);

    // Set a custom page slug for options page (wp-admin/themes.php?page=***).
    // Default: redux_options
    $args['page_slug'] = 'g1_theme_options';

    // Register theme options page under 'Appearance'
    $args['page_type'] = 'submenu';
    $args['page_parent'] = 'themes.php';

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
    //$args['page_position'] = null;

    // Set a custom page icon class (used to override the page icon next to heading)
    //$args['page_icon'] = 'icon-themes';

	// Set the icon type. Set to "iconfont" for Font Awesome, or "image" for traditional.
	// Redux no longer ships with standard icons!
	// Default: iconfont
	//$args['icon_type'] = 'image';

    // Disable the panel sections showing as submenu items.
    // Default: true
    //$args['allow_sub_menu'] = false;
        
    // Set ANY custom page help tabs, displayed using the new help tab API. Tabs are shown in order of definition.
    //$args['help_tabs'][] = array(
    //    'id' => 'redux-opts-1',
    //    'title' => __('Theme Information 1', Redux_TEXT_DOMAIN),
    //    'content' => __('<p>This is the tab content, HTML is allowed.</p>', Redux_TEXT_DOMAIN)
    //);
    //$args['help_tabs'][] = array(
    //    'id' => 'redux-opts-2',
    //    'title' => __('Theme Information 2', Redux_TEXT_DOMAIN),
    //    'content' => __('<p>This is the tab content, HTML is allowed.</p>', Redux_TEXT_DOMAIN)
    //);

    // Set the help sidebar for the options page.                                        
    //$args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', Redux_TEXT_DOMAIN);

    $sections = array();

    $tabs = array();

    add_filter(get_redux_opts_sections_filter_name(), 'g1_theme_options_sort_sections_and_fields', 9999);

    global $Redux_Options;
    $Redux_Options = new Redux_Options($sections, $args, $tabs);

}
add_action('wp_loaded', 'setup_redux_framework_options', 9999);
add_action('init', 'enqueue_redux_framework_scripts');

function enqueue_redux_framework_scripts () {
    $parent_uri = trailingslashit( get_template_directory_uri() );

    if( is_admin() ) {
        wp_enqueue_script( 'redux_options_panel', $parent_uri . 'g1-framework/admin/js/redux-options-panel.js', array( 'jquery', 'redux-opts-js' ) );
    }
}

function g1_theme_options_sort_sections_and_fields ( $sections ) {
    uasort( $sections, 'g1_theme_options_priority_asc_sort' );

    foreach ( $sections as $key => $section ) {
        if ( !empty( $sections[$key]['fields'] ) ) {
            uasort( $sections[$key]['fields'], 'g1_theme_options_priority_asc_sort' );
        }
    }

    return $sections;
}

function g1_theme_options_priority_asc_sort ( $item1, $item2 ) {
    $priority1 = !empty( $item1['priority'] ) ? (int)$item1['priority'] : 10;
    $priority2 = !empty( $item2['priority'] ) ? (int)$item2['priority'] : 10;

    if ( $priority1 === $priority2 ) {
        return 0;
    }

    return ( $priority1 < $priority2 ) ? -1 : 1;
}

add_action('wp_ajax_g1_force_update_checking',          'g1_ajax_force_update_checking' );

function g1_ajax_force_update_checking () {
    delete_site_transient( 'update_themes' );
    wp_update_themes();

    $themes = get_theme_updates();

    if ( !empty( $themes ) && isset( $themes[ G1_Theme::NAME ] ) ) {
        echo 'update available';
    } else {
        echo 'no updates';
    }

    exit;
}