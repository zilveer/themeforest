<?php
/**
 * Custom functions, support, custom post types and more.
 *
 * @author Vedmant <vedmant@gmail.com>
 * @package Mental WP
 * @link http://azelab.com
 */

defined( 'ABSPATH' ) OR exit( 'restricted access' ); // Protect against direct call

/* ========================================================================= *\
   Include Modules/Files
\* ========================================================================= */


// Theme Settings
require_once( 'includes/settings/settings.php' ); // Theme options page

// General
require_once( 'includes/theme-setup.php' );

// Functions
require_once( 'includes/functions.php' );

// Custom Post Types
require_once( 'includes/custom_posts/gallery.php' );

// Custom Metaboxes
require_once( 'includes/metaboxes/metaboxes.php' );

// Ajax queries
require_once( 'includes/ajax.php' ); // Ajax requests handle

// Custom comments
require_once( 'includes/comments.php' ); // Comments

// Shortcodes
require_once( 'includes/shortcodes/helpers.php' );
require_once( 'includes/shortcodes/mental_gallery.php' );
require_once( 'includes/shortcodes/mental_blog.php' );
require_once( 'includes/shortcodes/mental_woo_gallery.php' );
require_once( 'includes/shortcodes/gallery.php' );
require_once( 'includes/shortcodes/html_shortcodes.php' ); // Other HTML layouts shortcodes

// Shortcodes Ultimate plugin support
require_once( 'includes/shortcode-ultimate.php' );

// Visual Composer support
if ( function_exists( 'vc_map' ) ) {
    require_once( 'includes/visual-composer.php' );
}

// Widgets
require_once( 'includes/widgets/recent_posts.php' );
require_once( 'includes/widgets/mental_flickr.php' );
require_once( 'includes/widgets/mental_twitter.php' );
require_once( 'includes/widgets/mental_facebook.php' );

// Menu Walkers
require_once( 'includes/menu-walkers.php' );

// Miscellaneous
require_once( 'includes/miscellaneous.php' );


// WooCommerce
if ( class_exists( 'WooCommerce' ) ) { require_once( 'includes/woocommerce.php' ); }

// One click demo data importer
require_once ( 'includes/importer/importer.php' );

// Disable Visual Composer front end edition
if (function_exists('vc_disable_frontend')){
    vc_disable_frontend();
}
// Disable Visual Composer registraiton requirements
setcookie('vchideactivationmsg', '1', strtotime('+3 years'), '/');
setcookie('vchideactivationmsg_vc11', (defined('WPB_VC_VERSION') ? WPB_VC_VERSION : '1'), strtotime('+3 years'), '/');


add_action('wp_head','products_ajaxurl');
function products_ajaxurl() {
    ?>
    <!--test-->
    <script type="text/javascript">
        var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
    </script>
    <?php
}

/* Get cart contents count */
function ms_get_cart_contents_count() {
    $cart_count = apply_filters( 'nm_cart_count', WC()->cart->cart_contents_count );
    return $cart_count;
}


/*  Popup cart - AJAX */
function ms_poput_cart_product() {
    $json_array['cart_count'] = ms_get_cart_contents_count();

    echo json_encode( $json_array );

    exit;
}
add_action( 'wp_ajax_ms_poput_cart_product' , 'ms_poput_cart_product' );
add_action( 'wp_ajax_nopriv_ms_poput_cart_product', 'ms_poput_cart_product' );

function ms_mini_cart_remove_product() {
    
    $json_array['cart_count'] = ms_get_cart_contents_count();

    echo json_encode( $json_array );

    exit;
}
add_action( 'wp_ajax_ms_mini_cart_remove_product' , 'ms_mini_cart_remove_product' );
add_action( 'wp_ajax_nopriv_ms_mini_cart_remove_product', 'ms_mini_cart_remove_product' );