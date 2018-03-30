<?php

/**********************/
/* Wordpress Importer */
/**********************/
$plugin = sys_theme_plugins.'/importer/importer.php';
include $plugin;

/****************************/
/* Multiple Featured Images */
/****************************/
$plugin = sys_theme_plugins.'/multiple-featured-images/multiple-featured-images.php';
include $plugin;

/****************************/
/* Include Posts Type Order */
/****************************/

$plugin = sys_theme_plugins.'/post-types-order/post-types-order.php';
if(isset($venedor_settings['posts-type-order']) && $venedor_settings['posts-type-order']) {
    include $plugin;
}

/******************************/
/* Include Sidebars Generator */
/******************************/
$plugin = sys_theme_plugins.'/sidebar-generator/sidebar_generator.php';
include $plugin;

/************************************/
/* Include Easy Bootstrap ShortCode */
/************************************/

// Filter for Custom options
function apply_ebs_custom_option( $prevent ) {
    return true;
}
add_filter( 'ebs_custom_option', 'apply_ebs_custom_option' );

// Filter for bootstrap_admin.css
//function apply_ebs_custom_bootstrap_admin_css( $prevent ) {
//    return true;
//}
//add_filter( 'ebs_custom_bootstrap_admin_css', 'apply_ebs_custom_bootstrap_admin_css' );

// Filter for bootstrap.min.js url this filter is only applicable if you selected js inclusion from plugin in EBS Settings
function apply_ebs_bootstrap_js_url( $url ) {
    $ebs_js_url='';// write your desired bootstrap.min.js url here
    return $ebs_js_url;
}
add_filter( 'ebs_bootstrap_js_url', 'apply_ebs_bootstrap_js_url' );

// Filter for bootstrap.min.js CDN path this filter is only applicable if you selected js inclusion from CDN in EBS Settings
function apply_ebs_bootstrap_js_cdn( $url ) {
    $ebs_cdn_url='';// write your bootstrap.min.js cdn path here
    return $ebs_cdn_url;
}
add_filter( 'ebs_bootstrap_js_cdn', 'apply_ebs_bootstrap_js_cdn' );

// Filter for bootstrap.min.css urlthis filter is only applicable if you selected css inclusion from plugin in EBS Settings
function apply_ebs_bootstrap_css_url( $url ) {
    $ebs_css_url='';// write your bootstrap.min.css  url here
    return $ebs_css_url;
}
add_filter( 'ebs_bootstrap_css_url', 'apply_ebs_bootstrap_css_url' );

// Filter for bootstrap-icon.min.css url this filter is only applicable if you selected css inclusion from plugin or theme in EBS Settings
function apply_ebs_bootstrap_icon_css_url( $url ) {
    $ebs_icon_url='';// write your bootstrap-icon.min.css url here
    return $ebs_icon_url;
}
add_filter( 'ebs_bootstrap_icon_css_url', 'apply_ebs_bootstrap_icon_css_url' );

// After adding this code user will not be able to change the files location for EBS plugin as user can't see the EBS  Settings link of LHS menu in admin panel
update_option( 'EBS_CUSTOM_OPTION', 1 );
update_option( 'EBS_BOOTSTRAP_JS_LOCATION', 2 );
update_option( 'EBS_BOOTSTRAP_CSS_LOCATION', 2 );

// To give use the custom css for icons
update_option( 'EBS_CUSTOM_BOOTSTRAP_ICON_CSS', 1 );

// To give use the custom css for admin
update_option( 'EBS_CUSTOM_BOOTSTRAP_ADMIN_CSS', 1 );

/******************************************/
/* Include Woocommerce Grid / List Toggle */
/******************************************/
$plugin = sys_theme_plugins.'/woocommerce-grid-list-toggle/grid-list-toggle.php';
include $plugin;

/*************************/
/* TGM Plugin Activation */
/*************************/
$plugin = sys_theme_plugins.'/tgm-plugin-activation/class-tgm-plugin-activation.php';
require_once $plugin;
add_action( 'tgmpa_register', 'venedor_register_required_plugins' );
function venedor_register_required_plugins() {

    // disable visual composer automatic update
    global $vc_manager;
    if ( $vc_manager ) {
        $vc_updater = $vc_manager->updater();
        if ($vc_updater) {
            remove_filter('upgrader_pre_download', array(&$vc_updater, 'upgradeFilterFromEnvato'));
            remove_filter('upgrader_pre_download', array(&$vc_updater, 'preUpgradeFilter'));
            remove_action('wp_ajax_nopriv_vc_check_license_key', array(&$vc_updater, 'checkLicenseKeyFromRemote'));
        }
    }

    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(

        array(
            'name'                     => 'WPBakery Visual Composer',
            'slug'                     => 'js_composer',
            'source'                   => sys_theme_plugins.'/js_composer.zip',
            'required'                 => true,
            'force_activation'         => false,
            'force_deactivation'       => false
        ),

        array(
            'name'                     => 'Easy Bootstrap Shortcodes',
            'slug'                     => 'easy-bootstrap-shortcodes',
            'required'                 => true
        ),

        array(
            'name'                     => 'LayerSlider',
            'slug'                     => 'LayerSlider',
            'source'                   => sys_theme_plugins.'/layerslider.zip',
            'required'                 => false,
            'force_activation'         => false,
            'force_deactivation'       => false
        ),

        array(
            'name'                     => 'Revolution Slider',
            'slug'                     => 'revslider',
            'source'                   => sys_theme_plugins.'/revslider.zip',
            'required'                 => false,
            'force_activation'         => false,
            'force_deactivation'       => false
        ),
        array(
            'name'                     => 'Addthis',
            'slug'                     => 'addthis',
            'required'                 => false
        ),
        array(
            'name'                     => 'Contact Form 7',
            'slug'                     => 'contact-form-7',
            'required'                 => false
        ),
        array(
            'name'                     => 'Really Simple CAPTCHA',
            'slug'                     => 'really-simple-captcha',
            'required'                 => false
        ),
        array(
            'name'                     => 'Regenerate Thumbnails',
            'slug'                     => 'regenerate-thumbnails',
            'required'                 => false
        ),
        array(
            'name'                     => 'Woocommerce',
            'slug'                     => 'woocommerce',
            'required'                 => true
        ),
        array(
            'name'                     => 'Yith Woocommerce Wishlist',
            'slug'                     => 'yith-woocommerce-wishlist',
            'required'                 => false
        ),
        array(
            'name'                     => 'Yith Woocommerce Compare',
            'slug'                     => 'yith-woocommerce-compare',
            'required'                 => false
        ),
        array(
            'name'                     => 'Yith Woocommerce Ajax Navigation',
            'slug'                     => 'yith-woocommerce-ajax-navigation',
            'required'                 => false
        ),
        array(
            'name'                     => 'Yith Woocommerce Ajax Search',
            'slug'                     => 'yith-woocommerce-ajax-search',
            'required'                 => false
        ),
        array(
            'name'                     => 'Envato Toolkit',
            'slug'                     => 'envato-wordpress-toolkit',
            'source'                   => sys_theme_plugins . '/envato-wordpress-toolkit.zip',
            'required'                 => false
        ),
        array(
            'name'                     => 'Subscribe2',
            'slug'                     => 'subscribe2',
            'required'                 => false
        ),
    );

    // Change this to your theme text domain, used for internationalising strings
    $theme_text_domain = 'venedor';

    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'domain'               => $theme_text_domain,             // Text domain - likely want to be the same as your theme.
        'default_path'         => '',                             // Default absolute path to pre-packaged plugins
        'menu'                 => 'install-required-plugins',     // Menu slug
        'has_notices'          => true,                           // Show admin notices or not
        'is_automatic'        => true,                           // Automatically activate plugins after installation or not
        'message'             => '',                            // Message to output right before the plugins table
        'strings'              => array(
            'page_title'                                   => __( 'Install Required Plugins', $theme_text_domain ),
            'menu_title'                                   => __( 'Install Plugins', $theme_text_domain ),
            'installing'                                   => __( 'Installing Plugin: %s', $theme_text_domain ), // %1$s = plugin name
            'oops'                                         => __( 'Something went wrong with the plugin API.', $theme_text_domain ),
            'notice_can_install_required'                 => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
            'notice_can_install_recommended'            => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_install'                      => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
            'notice_can_activate_required'                => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
            'notice_can_activate_recommended'            => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_activate'                     => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
            'notice_ask_to_update'                         => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_update'                         => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
            'install_link'                                   => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
            'activate_link'                               => _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
            'return'                                       => __( 'Return to Required Plugins Installer', $theme_text_domain ),
            'plugin_activated'                             => __( 'Plugin activated successfully.', $theme_text_domain ),
            'complete'                                     => __( 'All plugins installed and activated successfully. %s', $theme_text_domain ), // %1$s = dashboard link
            'nag_type'                                    => 'updated' // Determines admin notice type - can only be 'updated' or 'error'
        )
    );

    tgmpa( $plugins, $config );
}

/**
 * Force Visual Composer to initialize as "built into the theme". This will hide certain tabs under the Settings->Visual Composer page
 */
add_action( 'vc_before_init', 'venedor_vcSetAsTheme' );
function venedor_vcSetAsTheme() {
    // Set Visual Composer
    if (function_exists('vc_set_as_theme')) {
        vc_set_as_theme();
    }
}

// disable layer slider update
update_option('layerslider-authorized-site', true);

if ( class_exists('WooCommerce') ) :
    add_action( 'admin_init', 'venedor_include_woo_templates' );

    function venedor_include_woo_templates() {
        include_once( WC()->plugin_path() . '/includes/wc-template-functions.php' );
}
endif;
?>