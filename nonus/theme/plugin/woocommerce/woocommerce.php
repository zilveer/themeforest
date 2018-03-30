<?php
/**
 * Woocommerce custom modifications
 */

if (!defined('CT_WOOCOMMERCE_PLUGIN_PATH')){
	define ('CT_WOOCOMMERCE_PLUGIN_PATH', CT_THEME_SETTINGS_MAIN_DIR . '/plugin/woocommerce');
}

add_theme_support('woocommerce');


if (!function_exists('ct_is_woocommerce_active')) {
    function ct_is_woocommerce_active()
    {
        return class_exists('WooCommerce');
    }
}

if (!ct_is_woocommerce_active()) {
    return;
}

add_filter('roots-nice-search', '__return_false');








/**
 *
 *WP roots issue with - fix
 *http://wordpress.stackexchange.com/questions/95293/wp-enqueue-style-will-not-let-me-enforce-screen-only
 *    'media'   => 'only screen and (max-width: ' . apply_filters( 'woocommerce_style_smallscreen_breakpoint', $breakpoint = '768px' ) . ')'
 *
 **/
remove_filter('style_loader_tag', 'roots_clean_style_tag');




/**
 *
 *redirect to page on login
 *
 **/
if (!function_exists('ct_ras_login_redirect')) {
    function ct_ras_login_redirect($redirect_to)
    {
        $redirect_to = home_url('/');
        return $redirect_to;
    }
}
add_filter('woocommerce_login_redirect', 'ct_ras_login_redirect');




/**
 *
 *Remove woocommerce title
 *
 **/
add_filter('woocommerce_show_page_title', '__return_false');




/**
 *
 *Display 9 products per page
 *
 **/
$itemCount = ct_get_context_option('ct_shop_item_count');
add_filter('loop_shop_per_page', create_function('$cols', 'return '.$itemCount.';'), 20);



/**
 *
 *Change number or products per row to 3
 *
 **/
if (!function_exists('ct_loop_columns')) {
    function ct_loop_columns()
    {
        return 4; // 3 products per row
    }
}
add_filter('loop_shop_columns', 'ct_loop_columns');


/**
 *
 *Overwrite default woocommerce cart widget
 *
 **/
if (!function_exists('ct_override_woocommerce_widgets')) {
    function ct_override_woocommerce_widgets()
    {
        if (class_exists('WC_Widget_Cart')) {
            unregister_widget('WC_Widget_Cart');
            include_once(CT_WOOCOMMERCE_PLUGIN_PATH . '/widgets/class-wc-widget-cart.php');
            register_widget('Custom_WooCommerce_Widget_Cart');
        }
    }
}
add_action('widgets_init', 'ct_override_woocommerce_widgets', 15);

/**
 *
 * Add responsive wrapper to Woocommerce tables
 *
 */
if (!function_exists('ct_wrapper_woo_tables')) {
    function ct_wrapper_woo_tables()
    {
        echo '<div class="table-responsive">';
    }
}
if (!function_exists('ct_wrapper_woo_tables_end')) {
    function ct_wrapper_woo_tables_end()
    {
        echo '</div>';
    }
}
add_action('woocommerce_before_cart_table', 'ct_wrapper_woo_tables', 10);
add_action('woocommerce_after_cart_table', 'ct_wrapper_woo_tables_end', 10);
add_action('yith_wcwl_before_wishlist', 'ct_wrapper_woo_tables', 10);
add_action('yith_wcwl_after_wishlist', 'ct_wrapper_woo_tables_end', 10);



if (!function_exists('ct_woocommerce_breadcrumbs')) {
    //draw breadcrumbs for shop (needs ctBreadcrumbs class)
    function ct_woocommerce_breadcrumbs()
    {
        if (class_exists('ctBreadcrumbs')) {
            $breadcrumbs = new ctBreadcrumbs;
            echo $breadcrumbs->display(); //no escape required
        }
    }
}
add_action('ct_custom_breadcrumb', 'ct_woocommerce_breadcrumbs');

