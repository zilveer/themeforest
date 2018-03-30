<?php
/**
 * Include the TGM_Plugin_Activation class.
 */
require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'trizzy_register_required_plugins' );

function trizzy_register_required_plugins() {

/**
 * Array of plugin arrays. Required keys are name and slug.
 * If the source is NOT from the .org repo, then source is also required.
 */
$plugins = array(

    array(
        'name'                  => 'Revolution Slider',
        'slug'                  => 'revslider',
        'source'                => get_template_directory() . '/plugins/revslider.zip',
        'version'               => '5.2.5',
        'required'              => true,
    ),
    array(
        'name'                  => 'WPBakery Visual Composer', // The plugin name
        'slug'                  => 'js_composer', // The plugin slug (typically the folder name)
        'source'                => get_template_directory() . '/plugins/js_composer.zip', // The plugin source
        'required'              => true, // If false, the plugin is only 'recommended' instead of required
        'version'               => '4.11.2.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
    ),
    array(
        'name'                  => 'Purethemes.net Shortcodes',
        'slug'                  => 'purethemes-shortcodes',
        'source'                => get_template_directory() . '/plugins/purethemes-shortcodes.zip',
        'version'               => '2.2',
        'required'              => true,
    ),
    array(
        'name'                  => 'Web Fonts Social Icons WP',
        'slug'                  => 'web-font-social-icons',
        'source'                => get_template_directory() . '/plugins/web-font-social-icons.zip',
        'version'               => '1.3',
        'required'              => false,
    ),
    array(
        'name'                  => 'Contact Form 7', // The plugin name
        'slug'                  => 'contact-form-7', // The plugin slug (typically the folder name)
        'required'              => false, // If false, the plugin is only 'recommended' instead of required
    ),
    array(
        'name'                  => 'MailChimp for WordPress',
        'slug'                  => 'mailchimp-for-wp',
        'required'              => false,
    ),
    array(
        'name'                  => 'WP-PageNavi', // The plugin name
        'slug'                  => 'wp-pagenavi', // The plugin slug (typically the folder name)
        'required'              => false, // If false, the plugin is only 'recommended' instead of required
    ),
    array(
        'name'                  => 'WooCommerce', // The plugin name
        'slug'                  => 'woocommerce', // The plugin slug (typically the folder name)
        'required'              => false, // If false, the plugin is only 'recommended' instead of required
    ),
    array(
        'name'                  => 'YITH WooCommerce Wishlist', // The plugin name
        'slug'                  => 'yith-woocommerce-wishlist', // The plugin slug (typically the folder name)
        'required'              => false, // If false, the plugin is only 'recommended' instead of required
    ),

);
    $config = array(
        'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to bundled plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'parent_slug'  => 'themes.php',            // Parent menu slug.
        'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.

    );

    tgmpa( $plugins, $config );
}
