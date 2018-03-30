<?php
/**
 * Roots includes
 */
include( get_template_directory() . '/lib/init.php');            // Initial theme setup and constants
include( get_template_directory() . '/lib/wrapper.php');         // Theme wrapper class
include( get_template_directory() . '/lib/config.php');          // Configuration
include( get_template_directory() . '/lib/activation.php');      // Theme activation
include( get_template_directory() . '/lib/titles.php');          // Page titles
include( get_template_directory() . '/lib/cleanup.php');         // Cleanup
include( get_template_directory() . '/lib/nav.php');             // Custom nav modifications
include( get_template_directory() . '/lib/comments.php');        // Custom comments modifications
include( get_template_directory() . '/lib/widgets.php');         // Sidebars and widgets
include( get_template_directory() . '/lib/scripts.php');         // Scripts and stylesheets
include( get_template_directory() . '/lib/custom.php');          // Custom functions

// THEMOVATION CUSTOMIZATION
include( get_template_directory() . '/lib/class-tgm-plugin-activation.php');    // Bundled Plugins

// Activate Option Tree in the theme rather than as a plugin
add_filter( 'ot_theme_mode', '__return_true' );
add_filter( 'ot_show_pages', '__return_false' );
//add_filter( 'ot_show_pages', '__return_true' );

// Don't use Option Tree Meta Boxes for Pages.
if(isset($_GET['post']) && $_GET['post'] > ""){
    if(get_post_type($_GET['post']) == 'page'){
        add_filter('ot_meta_boxes', '__return_false' );
    }
}


include_once(get_template_directory() . '/option-tree/ot-loader.php');
include_once(get_template_directory() . '/option-tree/theme-options.php' ); // LOAD THEME SETTINGS
include_once(get_template_directory() . '/option-tree/theme-options-defaults.php'); // LOAD OT DEFAULTS
include_once(get_template_directory() . '/register-meta-boxes.php'); // LOAD OT DEFAULTS

// END Option Tree


// Display 24 products per page. Goes in functions.php
/*add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 6;' ), 20 );

add_filter ('woocommerce_add_to_cart_redirect', 'woo_redirect_to_checkout');

function woo_redirect_to_checkout() {
    $checkout_url = WC()->cart->get_cart_url();
    return $checkout_url;
}*/