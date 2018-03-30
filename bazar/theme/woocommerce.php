<?php
/**
 * All functions and hooks for woocommerce plugin
 *
 * @package    WordPress
 * @subpackage YIThemes
 */

global $woocommerce;
global $woo_shop_folder;

define( 'WC_LATEST_VERSION', '2.6' );

include( "woocommerce_braintree.php" );

if ( ! defined( 'YIT_DEBUG' ) || ! YIT_DEBUG ) {
    $message = get_option( 'woocommerce_admin_notices', array() );
    $message = array_diff( $message, array( 'template_files' ) );
    update_option( 'woocommerce_admin_notices', $message );
    update_option( 'woocommerce_admin_notices', $message );
}

/* woocommerce 2.0.x */
if ( version_compare( preg_replace( '/-beta-([0-9]+)/', '', $woocommerce->version ), '2.1', '<' ) ) {
    add_filter( 'woocommerce_template_url', create_function( "", "return 'woocommerce_2.0.x/';" ) );
    add_action( 'wp_enqueue_scripts', 'yit_enqueue_woocommerce_styles', 11 );
    add_action( 'woocommerce_single_product_summary', 'yit_rating_singleproduct', 10 );
    $woo_shop_folder = 'shop';
}
else {

    /* woocommerce 2.1.x */
    if ( version_compare( $woocommerce->version, '2.2', '<' ) ) {
        add_filter( 'WC_TEMPLATE_PATH', create_function( "", "return 'woocommerce_2.1.x/';" ) );
    }
    /* woocommerce 2.2.x */
    else if ( version_compare( $woocommerce->version, '2.3', '<' ) ) {
        add_filter( 'woocommerce_template_path', create_function( "", "return 'woocommerce_2.2.x/';" ) );
    }/* woocommerce 2.3.x */
    else if ( version_compare( $woocommerce->version, '2.4', '<' ) ) {
        add_filter( 'woocommerce_template_path', create_function( "", "return 'woocommerce_2.3.x/';" ) );
    }/* woocommerce 2.4.x */
    else if ( version_compare( $woocommerce->version, '2.5', '<' ) ) {
        add_filter( 'woocommerce_template_path', create_function( "", "return 'woocommerce_2.4.x/';" ) );
    }/* woocommerce 2.5.x */
    else if ( version_compare( $woocommerce->version , '2.6', '<' ) ) {
        add_filter( 'woocommerce_template_path', create_function( "", "return 'woocommerce_2.5.x/';" ) );
    }/* woocommerce 2.6 .x */

    if ( version_compare( $woocommerce->version, '2.2', '>' ) ) {
        add_action( 'wp_enqueue_scripts', 'yit_enqueue_woocommerce_2_3_assets' );
    }

    add_filter( 'woocommerce_enqueue_styles', 'yit_enqueue_wc_styles' );

    $woo_shop_folder = 'global';

    if ( version_compare( $woocommerce->version, '2.6', '<' ) ) {
        if ( ! is_active_widget( false, false, 'woocommerce_price_filter', true ) ) {
            add_filter( 'loop_shop_post_in', array( WC()->query, 'price_filter' ) );
        }
    } else { // WC 2.6

        // Loop

        add_filter( 'post_class', 'yit_wc_product_post_class', 30, 3 );

        add_filter( 'product_cat_class', 'yit_wc_product_product_cat_class', 30, 3 );

        yit_wc_2_6_removed_unused_template();

    }

    add_filter( 'woocommerce_show_page_title', create_function( "", "return false;" ) );

}

// global flag to know that woocommerce is active
$yiw_is_woocommerce = true;

/* === GENERAL SETTINGS === */
add_theme_support( 'woocommerce' );
register_sidebar( yit_sidebar_args( 'Shop Sidebar' ) );


/* === HOOKS === */
add_action( 'wp_enqueue_scripts', 'yit_enqueue_woocommerce_assets' );
add_action( 'woocommerce_before_main_content', 'yit_shop_page_meta' );
add_action( 'shop_page_meta', 'yit_woocommerce_list_or_grid' );
add_action( 'yit_shop_breadcrumb', 'woocommerce_breadcrumb' );
add_action( 'shop_page_meta', 'yit_woocommerce_catalog_ordering' );
add_filter( 'woocommerce_page_settings', 'yit_woocommerce_deactive_logout_link' );
add_action( 'wp_head', 'yit_size_images_style' );
add_filter( 'loop_shop_per_page', 'yit_set_posts_per_page' );

add_filter( 'yith_wcwl_button_label', 'yit_change_wishlist_label' );
add_filter( 'yith-wcwl-browse-wishlist-label', 'yit_change_browse_wishlist_label' );
add_action( 'get_footer', 'yit_woocp_footer_script', 20 );
add_action( 'yit_activated', 'yit_woocommerce_default_image_dimensions' );
add_action( 'admin_init', 'yit_woocommerce_update' ); //update image names after woocommerce update

add_filter( 'yit_sample_data_tables', 'yit_save_woocommerce_tables' );
add_filter( 'yit_sample_data_options', 'yit_save_woocommerce_options' );
add_filter( 'yit_sample_data_options', 'yit_save_wishlist_options' );
add_filter( 'yit_sample_data_options', 'yit_add_plugins_options' );

add_filter( 'yit_add_image_size', 'yit_add_featured_image_size' );

add_action( 'after_setup_theme', 'yit_woocommerce_hooks' );

function yit_woocommerce_hooks() {

    global $woocommerce;

    if( version_compare( preg_replace( '/-beta-([0-9]+)/', '', $woocommerce->version ), '2.4', '<' ) ) {
        add_filter( 'add_to_cart_fragments', 'yit_add_to_cart_success_ajax' );
    }
    else {
        add_filter( 'woocommerce_add_to_cart_fragments', 'yit_add_to_cart_success_ajax' );
    }
}

/* shop */
add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
remove_action( 'woocommerce_pagination', 'woocommerce_catalog_ordering', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
add_filter( 'woocommerce_star_rating_size', 'yit_product_rate_size' );
add_filter( 'woocommerce_star_rating_size_shop_loop', 'yit_product_rate_size' );
add_filter( 'woocommerce_star_rating_size_sidebar', 'yit_product_rate_size' );
add_filter( 'woocommerce_star_rating_size_size_recent_reviews', 'yit_product_rate_size' );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
add_filter( 'yith-wcan-frontend-args', 'yit_wcan_change_pagination_class' );

/** 2.5 action */
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );

add_action( 'woocommerce_shop_loop_item_title', 'yit_shop_page_product_title', 10 );

if(is_catalog_mode_installed()){
    // disable the remove action of the plugin
    add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 999 );
    // delete add to cart button of the plugin
    add_filter("catalog_visibility_alternate_add_to_cart_link",create_function( '', '' ),999);
}

add_action( 'init', 'yit_plugins_support' );

/* quick view compatibility */

if ( function_exists( 'YITH_WCQV_Frontend' ) ) {

    $quick_view = YITH_WCQV_Frontend();
    $position = isset($quick_view->position) ? $quick_view->position : 'add-cart';

    if ( $position == 'add-cart') {
        remove_action( 'woocommerce_after_shop_loop_item', array( $quick_view, 'yith_add_quick_view_button' ), 15 );
    }

    add_action( 'yith_quick_view_custom_style_scripts' , 'yit_quick_view_add_selectbox_js' );

    add_filter( 'yith_quick_view_loader_gif', 'yit_get_ajax_loader_gif_url' );

    remove_action( 'yith_wcqv_product_image', 'woocommerce_show_product_sale_flash', 10 );
}

if ( ! function_exists( 'is_quick_view' ) ) {

    function is_quick_view() {
        return ( function_exists( 'YITH_WCQV_Frontend' ) && (( defined('DOING_AJAX') && DOING_AJAX && isset( $_REQUEST['action'] ) && $_REQUEST['action'] == 'yith_load_product_quick_view' )) );
    }
}

if ( ! function_exists( 'yit_quick_view_add_selectbox_js' ) ) {
    function yit_quick_view_add_selectbox_js() {
        wp_enqueue_script( 'yit-select-box-quick-view', yit_remove_protocol_url( YIT_THEME_ASSETS_URL ) . '/js/jquery.selectbox.js', array( 'jquery', 'jquery-cookie' ), '1.0', true );
    }
}

if( is_quick_view() && class_exists('WooCommerce_Product_Vendors') ){
    global $wc_product_vendors;
    remove_filter( 'request', array( $wc_product_vendors, 'restrict_media_library' ), 10, 1 );
    remove_filter( 'request', array( $wc_product_vendors, 'filter_booking_list' ) );
    remove_filter( 'request', array( $wc_product_vendors, 'filter_product_list' ) );
}

/* single */
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
add_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_sale_flash', 10 );
if ( yit_product_form_position_is( 'in-sidebar' ) ) {
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
}
if ( yit_product_form_position_is( 'in-sidebar' ) ) {
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
}
if ( yit_product_form_position_is( 'in-sidebar' ) && yit_get_option( 'shop-detail-show-price' ) ) {
    add_action( 'yit_product_box', 'woocommerce_template_single_price', 10 );
}
if ( yit_product_form_position_is( 'in-sidebar' ) && yit_get_option( 'shop-detail-add-to-cart' ) ) {
    add_action( 'yit_product_box', 'woocommerce_template_single_add_to_cart', 20 );
}
// move product tabs and related products under sidebar
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

add_action( 'woocommerce_after_sidebar', 'woocommerce_output_product_data_tabs', 20 );
add_action( 'woocommerce_after_sidebar', 'woocommerce_upsell_display', 25 );
add_action( 'woocommerce_after_sidebar', 'woocommerce_output_related_products', 35 );

//cross sell
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
add_action( 'woocommerce_after_cart' , 'woocommerce_cross_sell_display');



if ( yit_get_option( 'shop-show-related' ) ) {
    add_action( 'woocommerce_related_products_args', 'yit_related_posts_per_page' );
} else {
    remove_action( 'woocommerce_after_sidebar', 'woocommerce_output_related_products', 35 );
}

function yit_related_posts_per_page() {
    global $product;
    $related = $product->get_related( yit_get_option( 'shop-number-related' ) );
    return array(
        'posts_per_page'      => yit_get_option( 'shop-number-related' ),
        'post_type'           => 'product',
        'ignore_sticky_posts' => 1,
        'no_found_rows'       => 1,
        'post__in'            => $related
    );
}

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 30 );

if ( ! yit_get_option( 'shop-show-metas' ) ) {
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
}

/* tabs */
add_action( 'woocommerce_product_tabs', 'yit_woocommerce_add_tabs' ); // Woo 2
//add_action( 'woocommerce_product_tabs', 'yit_woocommerce_add_info_tab', 40 );
add_action( 'woocommerce_product_tab_panels', 'yit_woocommerce_add_info_panel', 40 );
//add_action( 'woocommerce_product_tabs', 'yit_woocommerce_add_custom_tab', 50 );
add_action( 'woocommerce_product_tab_panels', 'yit_woocommerce_add_custom_panel', 50 );

/* admin */
add_action( 'woocommerce_product_options_general_product_data', 'yit_woocommerce_admin_product_ribbon_onsale' );
add_action( 'woocommerce_process_product_meta', 'yit_woocommerce_process_product_meta', 2, 2 );


// active the price filter
if ( version_compare( $woocommerce->version, "2.0.0", '<' ) ) {
    add_action( 'init', 'woocommerce_price_filter_init' );
}


// Check for preorder plugin
function yit_is_preorder_active() {
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    return is_plugin_active( 'woocommerce-pre-orders/woocommerce-pre-orders.php' );
}

//add to cart button
add_filter( 'single_add_to_cart_text', 'yit_add_to_cart_text' );
add_filter( 'add_to_cart_text', 'yit_add_to_cart_text' );
function yit_add_to_cart_text( $text ) {
    global $product;

    $preorder_enabled = get_post_meta( $product->id, '_wc_pre_orders_enabled', true );
    if ( ( $preorder_enabled == "yes" ) && yit_is_preorder_active() ) {
        $text = get_option( 'wc_pre_orders_add_to_cart_button_text' );
    }
    else {
        if ( $product->product_type != 'external' ) {
            $text = yit_icl_translate( "theme", "yit", "add_to_cart_text", yit_get_option( 'add-to-cart-text' ) );
        }
    }

    return $text;
}

// details text
add_filter( 'yit_details_button', 'yit_details_button_text' );
function yit_details_button_text( $text ) {
    return __( yit_get_option( 'details-text' ), 'yit' );
}

/* compare button */
global $yith_woocompare;
if ( isset( $yith_woocompare ) ) {
    remove_action( 'woocommerce_after_shop_loop_item', array( $yith_woocompare->obj, 'add_compare_link' ), 20 );
    remove_action( 'woocommerce_single_product_summary', array( $yith_woocompare->obj, 'add_compare_link' ), 35 );
}

/* === FUNCTIONS === */


/********
 * SHOP PAGE
 **********/

if ( !function_exists( 'yit_shop_page_product_title' ) ) {
    /**
     * Add product title to main shop page
     *
     * @return void
     * @since  1.0.0
     * @author Francesco Licandro <francesco.licandro@yithemes.com>
     */
    function yit_shop_page_product_title() {

        $show_title = yit_get_option( 'shop-view-show-title' );

        if ( $show_title || $show_title == 'yes' ) {

            // title classes
            $title_class = array();
            if ( !yit_get_option('shop-view-show-title') ) $title_class[] = 'hide';
            if (  yit_get_option('shop-title-uppercase') ) $title_class[] = 'upper';
            $title_class = empty( $title_class ) ? '' : ' class="' . implode( ' ', $title_class ) . '"';

            $html = '<h3 '.$title_class.'>';
            $html .= get_the_title();
            $html .= '</h3>';

            echo $html;

        }
    }

}

/**
 * For WooCommerce 2.5.x
 */
if( ! function_exists('yit_woocommerce_shop_loop_subcategory_title') ) {

    function yit_woocommerce_shop_loop_subcategory_title( $category , $show_counter = 1 ) {

        ?>

            <h3>
                <?php echo $category->name; ?>
                <?php if ( $category->count > 0 ) :
                    echo apply_filters( 'woocommerce_subcategory_count_html', ' <mark class="count">(' . $category->count . ')</mark>', $category );
                endif; ?>
            </h3>
        <?php
    }
    remove_action( 'woocommerce_shop_loop_subcategory_title', 'woocommerce_template_loop_category_title', 10 );
    add_action( 'woocommerce_shop_loop_subcategory_title' , 'yit_woocommerce_shop_loop_subcategory_title' , 10 , 2 );
}

function yit_enqueue_woocommerce_assets() {
    wp_enqueue_script( 'yit-woocommerce', yit_remove_protocol_url(YIT_THEME_ASSETS_URL) . '/js/woocommerce.js', array( 'jquery', 'jquery-cookie' ), '1.0', true );
}

function yit_enqueue_woocommerce_2_3_assets() {
    wp_enqueue_script( 'yit-woocommerce-2-3', yit_remove_protocol_url(YIT_THEME_ASSETS_URL) . '/js/woocommerce_2.3.js', array( 'jquery', 'jquery-cookie' ), '1.0', true );
}

function yit_woocommerce_catalog_ordering() {
    if ( ! is_single() ) {
        woocommerce_catalog_ordering();
    }
}

function yit_set_posts_per_page( $cols ) {
    $items = yit_get_option( 'shop-products-per-page', $cols );
    return $items == 0 ? - 1 : $items;
}

function yit_woocommerce_list_or_grid() {

    global $woo_shop_folder;
    yith_wc_get_template( $woo_shop_folder . '/list-or-grid.php' );
}

function yit_woocommerce_added_button() {
    yith_wc_get_template( 'loop/added.php' );

}

function yit_shop_page_meta() {
    global $woo_shop_folder;
    yith_wc_get_template( $woo_shop_folder . '/page-meta.php' );
}


function yit_woocommerce_show_product_thumbnails() {
    yith_wc_get_template( 'single-product/thumbs.php' );
}

function yit_wcan_change_pagination_class( $args ) {
    $args['pagination'] = '.general-pagination';
    return $args;
}

/* Woo >= 2 */
function yit_woocommerce_add_tabs( $tabs ) {
    global $post;

    $use_ask_info = yit_get_post_meta( $post->ID, '_use_ask_info' );
    if ( $use_ask_info == 1 || $use_ask_info == '' ) {
        $tabs['info'] = array(
            'title'    => apply_filters( 'yit_ask_info_label', __( 'Product Inquiry', 'yit' ) ),
            'priority' => 30,
            'callback' => 'yit_woocommerce_add_info_panel'
        );
    }

    $custom_tabs = yit_get_post_meta( $post->ID, '_custom_tabs' );
    if ( ! empty( $custom_tabs ) ) {
        foreach ( $custom_tabs as $tab ) {
            $tabs['custom' . $tab["position"]] = array(
                'title'      => $tab["name"],
                'priority'   => 30,
                'callback'   => 'yit_woocommerce_add_custom_panel',
                'custom_tab' => $tab
            );
        }
    }

    return $tabs;
}

/* custom and info tabs Woo 2 < */
function yit_woocommerce_add_info_tab() {
    yith_wc_get_template( 'single-product/tabs/tab-info.php' );
}

function yit_woocommerce_add_info_panel() {
    yith_wc_get_template( 'single-product/tabs/info.php' );
}

function yit_woocommerce_add_custom_tab() {
    yith_wc_get_template( 'single-product/tabs/tab-custom.php' );
}

function yit_woocommerce_add_custom_panel( $key, $tab ) {
    yith_wc_get_template( 'single-product/tabs/custom.php', array( 'key' => $key, 'tab' => $tab ) );
}

function woocommerce_template_loop_product_thumbnail() {
    global $product;

    echo '<a href="' . apply_filters( 'woocommerce_loop_thumbnail_url', get_permalink() ) . '" class="thumb">' . woocommerce_get_product_thumbnail();

    if ( yit_get_option( 'shop-use-second-image', 1 ) ) {
        // add another image for hover
        $attachments = $product->get_gallery_attachment_ids();
        if ( ! empty( $attachments ) && isset( $attachments[0] ) ) {
            yit_image( "id=$attachments[0]&size=shop_catalog&class=image-hover" );
        }
    }

    echo  '</a>';
}

function yit_product_form_position_is( $check = '' ) {
    $layout = yit_get_option( 'shop-products-details-meta-position', 'in-sidebar' );

    if(is_quick_view()) $layout = 'in-content';

    if ( empty( $check ) ) {
        return $layout;
    }
    else {
        return (bool) ( $check == $layout );
    }
}

function yit_product_single_boxmeta() {
    yith_wc_get_template( 'single-product/box-meta.php' );
}

function yit_product_rate_size() {
    return 13;
}

function yit_woocommerce_sharethis() {
    if ( is_product() ) {
        return;
    }
    do_action( 'woocommerce_share' );
}

function yit_add_sharethis_button_js( $print_button = true ) {
    global $woocommerce, $product, $post, $yit_sharethis;

    if ( ! isset( $woocommerce->integrations->integrations['sharethis'] ) ||
        empty( $woocommerce->integrations->integrations['sharethis']->publisher_id ) ||
        ( ! yit_get_option( 'shop-view-show-share' ) && ! is_product() ) ||
        ( yit_get_option( 'shop-layout', 'with-hover' ) == 'classic' && is_product() )
    ) {
        return;
    }

    if ( ! is_product() && ! isset( $yit_sharethis ) ) {
        $sharethis = ( is_ssl() ) ? 'https://ws.sharethis.com/button/buttons.js' : 'http://w.sharethis.com/button/buttons.js';
        echo '<script type="text/javascript">var switchTo5x=true;</script><script type="text/javascript" src="' . $sharethis . '"></script>';
        echo '<script type="text/javascript">stLight.options({publisher:"' . $woocommerce->integrations->integrations['sharethis']->publisher_id . '" });</script>';
    }

    if ( $print_button ) {
        printf( '<script type="text/javascript">
        stLight.options({
                onhover:false
        });
        stWidget.addEntry({
            	"service" : "sharethis",
            	"element" : document.getElementById("%s"),
            	"url"     : "%s",
            	"title"   : "%s",
            	"type"    : "large",
            	"text"    : "%s",
            	"image"   : "%s",
            	"summary" : "%s"
            }, {button:true});
        </script>', "share_$product->id", get_permalink( $product->id ), get_the_title(), get_the_title(), yit_image( "output=url", false ), str_replace( array( "\r", "\n" ), ' ', esc_attr( strip_tags( $post->post_content ) ) ) );
    }

    $yit_sharethis = true;
}

/* share */
function yit_woocommerce_share() {
    if ( ! yit_get_option( 'shop-share' ) ) {
        return;
    }

    echo do_shortcode( '[share class="product-share" title="' . yit_get_option( 'shop-share-title' ) . '" socials="' . yit_get_option( 'shop-share-socials' ) . '"]' );
}

/* logout link */
function yit_woocommerce_deactive_logout_link( $options ) {
    foreach ( $options as $option ) {
        if ( isset( $option['id'] ) && $option['id'] != 'yit_woocommerce_deactive_logout_link' ) {
            continue;
        }

        $option['std'] = 'no';
        break;
    }

    return $options;
}

/* checkout */
add_filter( 'wp_redirect', 'yit_woocommerce_checkout_registration_redirect' );
function yit_woocommerce_checkout_registration_redirect( $location ) {
    if ( isset( $_POST['register'] ) && $_POST['register'] && isset( $_POST['yit_checkout'] ) && $location == get_permalink( yith_wc_get_page_id( 'myaccount' ) ) ) {
        $location = get_permalink( yith_wc_get_page_id( 'checkout' ) );
    }

    return $location;
}

function yit_change_wishlist_label() {
    return __( 'Wishlist', 'yit' );
}

function yit_change_browse_wishlist_label() {
    return __( 'View Wishlist', 'yit' );
}


/* admin */
function yit_woocommerce_admin_product_ribbon_onsale() {
    yith_wc_get_template( 'admin/custom-onsale.php' );
}

function yit_woocommerce_process_product_meta( $post_id, $post ) {

    $active = ( isset( $_POST['_active_custom_onsale'] ) ) ? 'yes' : 'no';
    update_post_meta( $post_id, '_active_custom_onsale', esc_attr( $active ) );

    if ( isset( $_POST['_preset_onsale_icon'] ) ) {
        update_post_meta( $post_id, '_preset_onsale_icon', esc_attr( $_POST['_preset_onsale_icon'] ) );
    }
    if ( isset( $_POST['_custom_onsale_icon'] ) ) {
        update_post_meta( $post_id, '_custom_onsale_icon', esc_attr( $_POST['_custom_onsale_icon'] ) );
    }
}


/**
 * SIZES
 */

// shop small
if ( ! function_exists( 'yit_shop_small_w' ) ) {
    function yit_shop_small_w() {
        global $woocommerce;
        if ( function_exists( 'wc_get_image_size' ) ) {
            $size = wc_get_image_size( 'shop_catalog' );
        }
        else {
            $size = $woocommerce->get_image_size( 'shop_catalog' );
        }
        return $size['width'];
    }
}
if ( ! function_exists( 'yit_shop_small_h' ) ) {
    function yit_shop_small_h() {
        global $woocommerce;
        if ( function_exists( 'wc_get_image_size' ) ) {
            $size = wc_get_image_size( 'shop_catalog' );
        }
        else {
            $size = $woocommerce->get_image_size( 'shop_catalog' );
        }

        return $size['height'];
    }
}
// shop thumbnail
if ( ! function_exists( 'yit_shop_thumbnail_w' ) ) {
    function yit_shop_thumbnail_w() {
        global $woocommerce;
        if ( function_exists( 'wc_get_image_size' ) ) {
            $size = wc_get_image_size( 'shop_thumbnail' );
        }
        else {
            $size = $woocommerce->get_image_size( 'shop_thumbnail' );
        }

        return $size['width'];
    }
}
if ( ! function_exists( 'yit_shop_thumbnail_h' ) ) {
    function yit_shop_thumbnail_h() {
        global $woocommerce;
        if ( function_exists( 'wc_get_image_size' ) ) {
            $size = wc_get_image_size( 'shop_thumbnail' );
        }
        else {
            $size = $woocommerce->get_image_size( 'shop_thumbnail' );
        }


        return $size['height'];
    }
}
// shop large
if ( ! function_exists( 'yit_shop_large_w' ) ) {
    function yit_shop_large_w() {
        global $woocommerce;
        if ( function_exists( 'wc_get_image_size' ) ) {
            $size = wc_get_image_size( 'shop_single' );
        }
        else {
            $size = $woocommerce->get_image_size( 'shop_single' );
        }

        return $size['width'];
    }
}
if ( ! function_exists( 'yit_shop_large_h' ) ) {
    function yit_shop_large_h() {
        global $woocommerce;
        if ( function_exists( 'wc_get_image_size' ) ) {
            $size = wc_get_image_size( 'shop_single' );
        }
        else {
            $size = $woocommerce->get_image_size( 'shop_single' );
        }
        return $size['height'];
    }
}

// print style for small thumb size
function yit_size_images_style() {
    $content_width = yit_get_sidebar_layout() == 'sidebar-no' ? 1170 : 870;
    ?>
    <style type="text/css">
        ul.products li.product.list {
            padding-left: <?php echo yit_shop_small_w() + 30 + 7 + 2; ?>px
        }

        ul.products li.product.list .product-thumbnail {
            margin-left: -<?php echo yit_shop_small_w() + 30 + 7 + 2; ?>px
        }

        .widget.widget_onsale li,
        .widget.widget_best_sellers li,
        .widget.widget_recent_reviews li,
        .widget.widget_recent_products li,
        .widget.widget_random_products li,
        .widget.widget_featured_products li,
        .widget.widget_top_rated_products li,
        .widget.widget_recently_viewed_products li {
            min-height: <?php echo yit_shop_thumbnail_h() ?>px
        }

        .widget.widget_onsale li .star-rating,
        .widget.widget_best_sellers li .star-rating,
        .widget.widget_recent_reviews li .star-rating,
        .widget.widget_recent_products li .star-rating,
        .widget.widget_random_products li .star-rating,
        .widget.widget_featured_products li .star-rating,
        .widget.widget_top_rated_products li .star-rating,
        .widget.widget_recently_viewed_products li .star-rating {
            margin-left: <?php echo yit_shop_thumbnail_w() + 15 ?>px
        }

            /* IE8, Portrait tablet to landscape and desktop till 1024px */
        .single-product div.images {
            width: <?php echo ( yit_shop_large_w() - 20 ) / 870 * 100 ?>%;
        }

        .single-product div.summary {
            width: <?php echo 96 - ( ( yit_shop_large_w() + 2 ) / 870 * 100 ) ?>%;
        }

            /* WooCommerce standard images */
        .single-product .images .thumbnails > a {
            width: <?php echo min( yit_shop_thumbnail_w(), 80 ) ?>px !important;
            height: <?php echo min( yit_shop_thumbnail_h(), 80 ) ?>px !important;
        }

            /* Slider images */
        .single-product .images .thumbnails li img {
            max-width: <?php echo min( yit_shop_thumbnail_w(), 80 ) ?>px !important;
        }

            /* Desktop above 1200px */
        @media (min-width:1200px) {
        <?php
        $single_product_image = get_option( 'shop_single_image_size' );
        $hard_crop_sp_image = $single_product_image['crop'];

        if( $hard_crop_sp_image ) :
        ?>
            .single-product div.images .yith_magnifier_zoom_wrap a img,
            .single-product div.images > a img {
                width: <?php echo yit_shop_large_w() ?>px;
                height: <?php echo yit_shop_large_h() ?>px;
            }

        <?php
        endif;
        ?>
            /* WooCommerce standard images */
            .single-product .images .thumbnails > a {
                width: <?php echo min( yit_shop_thumbnail_w(), 100 ) ?>px !important;
                height: <?php echo min( yit_shop_thumbnail_h(), 100 ) ?>px !important;
            }

            /* Slider images */
            .single-product .images .thumbnails li img {
                max-width: <?php echo min( yit_shop_thumbnail_w(), 100 ) ?>px !important;
            }
        }

            /* Desktop above 1200px */
        @media (max-width: 979px) and (min-width: 768px) {
            /* WooCommerce standard images */
            .single-product .images .thumbnails > a {
                width: <?php echo min( yit_shop_thumbnail_w(), 63 ) ?>px !important;
                height: <?php echo min( yit_shop_thumbnail_h(), 63 ) ?>px !important;
            }

            /* Slider images */
            .single-product .images .thumbnails li img {
                max-width: <?php echo min( yit_shop_thumbnail_w(), 63 ) ?>px !important;
            }
        }

        <?php if( yit_get_option( 'responsive-enabled' ) ) : ?>
            /* Below 767px, mobiles included */
        @media (max-width: 767px) {
            .single-product div.images,
            .single-product div.summary {
                float: none;
                margin-left: 0px !important;
                width: 100% !important;
            }

            .single-product div.images {
                margin-bottom: 20px;
            }

            /* WooCommerce standard images */
            .single-product .images .thumbnails > a {
                width: <?php echo min( yit_shop_thumbnail_w(), 65 ) ?>px !important;
                height: <?php echo min( yit_shop_thumbnail_h(), 65 ) ?>px !important;
            }

            /* Slider images */
            .single-product .images .thumbnails li img {
                max-width: <?php echo min( yit_shop_thumbnail_w(), 65 ) ?>px !important;
            }
        }

        <?php endif ?>
    </style>
<?php
}

function yit_add_featured_image_size($images) {

    $element = yit_get_option('shop-featured-image-size');

    if ( ! is_array( $element ) ) {
        $element['width']   = "160";
        $element['height'] = "160";
        $element['crop']    = 1;
    }

    $image_sizes = array(
        'shop_featured_image_size' => array( intval( $element['width'] ), intval( $element['height'] ), ( isset($element['crop']) && $element['crop'] ? true : false ) ),
    );

    return array_merge( $image_sizes , $images );
}

/** NAV MENU
-------------------------------------------------------------------- */

add_action( 'admin_init', array( 'yitProductsPricesFilter', 'admin_init' ) );

class yitProductsPricesFilter {
    // We cannot call #add_meta_box yet as it has not been defined,
    // therefore we will call it in the admin_init hook
    static function admin_init() {
        global $woocommerce;
        if ( ! is_plugin_active( 'woocommerce/woocommerce.php' ) || ! isset( $woocommerce ) || basename( $_SERVER['PHP_SELF'] ) != 'nav-menus.php' ) {
            return;
        }

        wp_enqueue_script( 'nav-menu-query', YIT_THEME_ASSETS_URL . '/js/metabox_nav_menu.js', 'nav-menu', false, true );
        add_meta_box( 'products-by-prices', 'Prices Filter', array( __CLASS__, 'nav_menu_meta_box' ), 'nav-menus', 'side', 'low' );
    }

    function nav_menu_meta_box() {
        ?>
        <div class="prices">
            <input type="hidden" name="woocommerce_currency" id="woocommerce_currency" value="<?php echo get_woocommerce_currency_symbol( get_option( 'woocommerce_currency' ) ) ?>" />
            <input type="hidden" name="woocommerce_shop_url" id="woocommerce_shop_url" value="<?php echo get_option( 'permalink_structure' ) == '' ? YIT_SITE_URL . '/?post_type=product' : get_permalink( get_option( 'woocommerce_shop_page_id' ) ) ?>" />
            <input type="hidden" name="menu-item[-1][menu-item-url]" value="" />
            <input type="hidden" name="menu-item[-1][menu-item-title]" value="" />
            <input type="hidden" name="menu-item[-1][menu-item-type]" value="custom" />

            <p>
                <?php _e( sprintf( 'The values are already expressed in %s', get_woocommerce_currency_symbol( get_option( 'woocommerce_currency' ) ) ), 'yit' ) ?>
            </p>

            <p>
                <label class="howto" for="prices_filter_from">
                    <span><?php _e( 'From', 'yit' ); ?></span>
                    <input id="prices_filter_from" name="prices_filter_from" type="text" class="regular-text menu-item-textbox input-with-default-title" title="<?php esc_attr_e( 'From', 'yit' ); ?>" />
                </label>
            </p>

            <p style="display: block; margin: 1em 0; clear: both;">
                <label class="howto" for="prices_filter_to">
                    <span><?php _e( 'To', 'yit' ); ?></span>
                    <input id="prices_filter_to" name="prices_filter_to" type="text" class="regular-text menu-item-textbox input-with-default-title" title="<?php esc_attr_e( 'To' ); ?>" />
                </label>
            </p>

            <p class="button-controls">
			<span class="add-to-menu">
				<img class="waiting" src="<?php echo esc_url( admin_url( 'images/wpspin_light.gif' ) ); ?>" alt="" style="display: none;" />
				<input type="submit" class="button-secondary submit-add-to-menu" value="<?php esc_attr_e( 'Add to Menu' ); ?>" name="add-custom-menu-item" />
			</span>
            </p>

        </div>
    <?php
    }
}


if ( yit_get_option( 'shop-customer-vat' ) && yit_get_option( 'shop-customer-ssn' ) ) {

    add_filter( 'woocommerce_billing_fields', 'woocommerce_add_billing_fields' );
    function woocommerce_add_billing_fields( $fields ) {
        //$fields['billing_country']['clear'] = true;
        $field = array( 'billing_ssn' => array(
            'label'       => apply_filters( 'yit_ssn_label', __( 'SSN', 'yit' ) ),
            'placeholder' => apply_filters( 'yit_ssn_label_x', _x( 'SSN', 'placeholder', 'yit' ) ),
            'required'    => false,
            'class'       => array( 'form-row-first' ),
            'clear'       => false
        ) );

        yit_array_splice_assoc( $fields, $field, 'billing_address_1' );

        $field = array( 'billing_vat' => array(
            'label'       => apply_filters( 'yit_vatssn_label', __( 'VAT', 'yit' ) ),
            'placeholder' => apply_filters( 'yit_vatssn_label_x', _x( 'VAT', 'placeholder', 'yit' ) ),
            'required'    => false,
            'class'       => array( 'form-row-last' ),
            'clear'       => true
        ) );

        yit_array_splice_assoc( $fields, $field, 'billing_address_1' );

        return $fields;
    }


    add_filter( 'woocommerce_shipping_fields', 'woocommerce_add_shipping_fields' );
    function woocommerce_add_shipping_fields( $fields ) {
        $field = array( 'shipping_ssn' => array(
            'label'       => apply_filters( 'yit_ssn_label', __( 'SSN', 'yit' ) ),
            'placeholder' => apply_filters( 'yit_ssn_label_x', _x( 'SSN', 'placeholder', 'yit' ) ),
            'required'    => false,
            'class'       => array( 'form-row-first' ),
            'clear'       => false
        ) );

        yit_array_splice_assoc( $fields, $field, 'shipping_address_1' );

        $field = array( 'shipping_vat' => array(
            'label'       => apply_filters( 'yit_vatssn_label', __( 'VAT', 'yit' ) ),
            'placeholder' => apply_filters( 'yit_vatssn_label_x', _x( 'VAT', 'placeholder', 'yit' ) ),
            'required'    => false,
            'class'       => array( 'form-row-last' ),
            'clear'       => true
        ) );

        yit_array_splice_assoc( $fields, $field, 'shipping_address_1' );
        return $fields;
    }


    add_filter( 'woocommerce_admin_billing_fields', 'woocommerce_add_billing_shipping_fields_admin' );
    add_filter( 'woocommerce_admin_shipping_fields', 'woocommerce_add_billing_shipping_fields_admin' );
    function woocommerce_add_billing_shipping_fields_admin( $fields ) {
        $fields['vat'] = array(
            'label' => apply_filters( 'yit_vatssn_label', __( 'VAT', 'yit' ) )
        );
        $fields['ssn'] = array(
            'label' => apply_filters( 'yit_ssn_label', __( 'SSN', 'yit' ) )
        );

        return $fields;
    }

    add_filter( 'woocommerce_load_order_data', 'woocommerce_add_var_load_order_data' );
    function woocommerce_add_var_load_order_data( $fields ) {
        $fields['billing_vat']  = '';
        $fields['shipping_vat'] = '';
        $fields['billing_ssn']  = '';
        $fields['shipping_ssn'] = '';
        return $fields;
    }


}
elseif ( yit_get_option( 'shop-customer-vat' ) ) {
    add_filter( 'woocommerce_billing_fields', 'woocommerce_add_billing_fields' );
    function woocommerce_add_billing_fields( $fields ) {
        $fields['billing_company']['class'] = array( 'form-row-first' );
        $fields['billing_company']['clear'] = false;
        //$fields['billing_country']['clear'] = true;
        $field = array( 'billing_vat' => array(
            'label'       => apply_filters( 'yit_vatssn_label', __( 'VAT/SSN', 'yit' ) ),
            'placeholder' => apply_filters( 'yit_vatssn_label_x', _x( 'VAT or SSN', 'placeholder', 'yit' ) ),
            'required'    => false,
            'class'       => array( 'form-row-last' ),
            'clear'       => true
        ) );

        yit_array_splice_assoc( $fields, $field, 'billing_address_1' );
        return $fields;
    }

    add_filter( 'woocommerce_shipping_fields', 'woocommerce_add_shipping_fields' );
    function woocommerce_add_shipping_fields( $fields ) {
        $fields['shipping_company']['class'] = array( 'form-row-first' );
        $fields['shipping_company']['clear'] = false;
        //$fields['shipping_country']['clear'] = true;
        $field = array( 'shipping_vat' => array(
            'label'       => apply_filters( 'yit_vatssn_label', __( 'VAT/SSN', 'yit' ) ),
            'placeholder' => apply_filters( 'yit_vatssn_label_x', _x( 'VAT or SSN', 'placeholder', 'yit' ) ),
            'required'    => false,
            'class'       => array( 'form-row-last' ),
            'clear'       => true
        ) );

        yit_array_splice_assoc( $fields, $field, 'shipping_address_1' );
        return $fields;
    }

    add_filter( 'woocommerce_admin_billing_fields', 'woocommerce_add_billing_shipping_fields_admin' );
    add_filter( 'woocommerce_admin_shipping_fields', 'woocommerce_add_billing_shipping_fields_admin' );
    function woocommerce_add_billing_shipping_fields_admin( $fields ) {
        $fields['vat'] = array(
            'label' => apply_filters( 'yit_vatssn_label', __( 'VAT/SSN', 'yit' ) )
        );

        return $fields;
    }

    add_filter( 'woocommerce_load_order_data', 'woocommerce_add_var_load_order_data' );
    function woocommerce_add_var_load_order_data( $fields ) {
        $fields['billing_vat']  = '';
        $fields['shipping_vat'] = '';
        return $fields;
    }
}
elseif ( yit_get_option( 'shop-customer-ssn' ) ) {
    add_filter( 'woocommerce_billing_fields', 'woocommerce_add_billing_ssn_fields' );
    function woocommerce_add_billing_ssn_fields( $fields ) {
        $fields['billing_company']['class'] = array( 'form-row-first' );
        $fields['billing_company']['clear'] = false;
        $field                              = array( 'billing_ssn' => array(
            'label'       => apply_filters( 'yit_ssn_label', __( 'SSN', 'yit' ) ),
            'placeholder' => apply_filters( 'yit_ssn_label_x', _x( 'SSN', 'placeholder', 'yit' ) ),
            'required'    => false,
            'class'       => array( 'form-row-last' ),
            'clear'       => true
        ) );

        yit_array_splice_assoc( $fields, $field, 'billing_address_1' );
        return $fields;
    }

    add_filter( 'woocommerce_shipping_fields', 'woocommerce_add_shipping_ssn_fields' );
    function woocommerce_add_shipping_ssn_fields( $fields ) {
        $fields['shipping_company']['class'] = array( 'form-row-first' );
        $fields['shipping_company']['clear'] = false;
        $field                               = array( 'shipping_ssn' => array(
            'label'       => apply_filters( 'yit_ssn_label', __( 'SSN', 'yit' ) ),
            'placeholder' => apply_filters( 'yit_ssn_label_x', _x( 'SSN', 'placeholder', 'yit' ) ),
            'required'    => false,
            'class'       => array( 'form-row-last' ),
            'clear'       => true
        ) );

        yit_array_splice_assoc( $fields, $field, 'shipping_address_1' );
        return $fields;
    }

    add_filter( 'woocommerce_admin_billing_fields', 'woocommerce_add_billing_shipping_ssn_fields_admin' );
    add_filter( 'woocommerce_admin_shipping_fields', 'woocommerce_add_billing_shipping_ssn_fields_admin' );
    function woocommerce_add_billing_shipping_ssn_fields_admin( $fields ) {
        $fields['ssn'] = array(
            'label' => apply_filters( 'yit_ssn_label', __( 'SSN', 'yit' ) )
        );

        return $fields;
    }

    add_filter( 'woocommerce_load_order_data', 'woocommerce_add_var_load_order_ssn_data' );
    function woocommerce_add_var_load_order_ssn_data( $fields ) {
        $fields['billing_ssn']  = '';
        $fields['shipping_ssn'] = '';
        return $fields;
    }
}


if ( yit_get_option( 'shop-fields-order' ) ) {
    add_filter( 'woocommerce_billing_fields', 'woocommerce_restore_billing_fields_order' );
    function woocommerce_restore_billing_fields_order( $fields ) {
        $fields['billing_city']['class'][0]      = 'form-row-last';
        $fields['billing_country']['class'][0]   = 'form-row-first';
        $fields['billing_address_1']['class'][0] = 'form-row-first';
        $fields['billing_address_2']['class'][0] = 'form-row-last';

        $country = $fields['billing_country'];
        unset( $fields['billing_country'] );
        yit_array_splice_assoc( $fields, array( 'billing_country' => $country ), 'billing_state' );

        return $fields;
    }

    add_filter( 'woocommerce_shipping_fields', 'woocommerce_restore_shipping_fields_order' );
    function woocommerce_restore_shipping_fields_order( $fields ) {
        $fields['shipping_city']['class'][0]      = 'form-row-last';
        $fields['shipping_country']['class'][0]   = 'form-row-first';
        $fields['shipping_address_1']['class'][0] = 'form-row-first';
        $fields['shipping_address_2']['class'][0] = 'form-row-last';

        $country = $fields['shipping_country'];
        unset( $fields['shipping_country'] );
        yit_array_splice_assoc( $fields, array( 'shipping_country' => $country ), 'shipping_state' );

        return $fields;
    }
}


/* is image responsive enabled? */
function yit_print_image_responsive_enabled_variables() {
    global $woocommerce_loop, $yit_is_feature_tab;

    $content_width = yit_get_sidebar_layout() == 'sidebar-no' ? 1170 : 870;
    if ( isset( $yit_is_feature_tab ) && $yit_is_feature_tab ) {
        $content_width -= 300;
    }
    $product_width = yit_shop_small_w() + 10 + 2; // 10 = padding & 2 = border
    $is_span       = false;
    if ( get_option( 'woocommerce_responsive_images' , 'yes' ) == 'yes' ) {
        $is_span = true;
        if ( yit_get_sidebar_layout() == 'sidebar-no' ) {
            if ( $product_width >= 0 && $product_width < 120 ) {
                $woocommerce_loop['li_class'][] = 'span1';
                $woocommerce_loop['columns']    = 12;
            }
            elseif ( $product_width >= 120 && $product_width < 220 ) {
                $woocommerce_loop['li_class'][] = 'span2';
                $woocommerce_loop['columns']    = 6;
            }
            elseif ( $product_width >= 220 && $product_width < 320 ) {
                $woocommerce_loop['li_class'][] = 'span3';
                $woocommerce_loop['columns']    = 4;
            }
            elseif ( $product_width >= 320 && $product_width < 470 ) {
                $woocommerce_loop['li_class'][] = 'span4';
                $woocommerce_loop['columns']    = 3;
            }
            elseif ( $product_width >= 470 && $product_width < 620 ) {
                $woocommerce_loop['li_class'][] = 'span6';
                $woocommerce_loop['columns']    = 2;
            }
            else {
                $is_span = false;
            }

        }
        else {
            if ( $product_width >= 0 && $product_width < 150 ) {
                $woocommerce_loop['li_class'][] = 'span1';
                $woocommerce_loop['columns']    = 12;
            }
            elseif ( $product_width >= 150 && $product_width < 620 ) {
                $woocommerce_loop['li_class'][] = 'span3';
                $woocommerce_loop['columns']    = 3;
            }
            else {
                $is_span = false;
            }

        }

    }
    else {
        $grid                           = yit_get_span_from_width( $product_width );
        $woocommerce_loop['li_class'][] = 'span' . $grid;
        $product_width                  = yit_width_of_span( $grid );
    }
    if ( $yit_is_feature_tab || ! $is_span ) {
        $woocommerce_loop['columns'] = floor( ( $content_width + 30 ) / ( $product_width + 30 ) );
    }
    ?>
    <script type="text/javascript">
        var elastislide_defaults = {
            imageW              : <?php echo get_option( 'woocommerce_responsive_images' , 'yes' ) == 'no' || ! get_option( 'woocommerce_responsive_images' , 'yes' ) ? yit_shop_small_w() + 10 + 2 : '"100%"'; ?>,
            border              : 0,
            margin              : 0,
            preventDefaultEvents: false,
            infinite            : true,
            slideshowSpeed      : 3500
        };

        var carouFredSelOptions_defaults = {
            responsive: false,
            auto      : true,
            items     : <?php echo empty( $woocommerce_loop['columns'] ) ? 0 : $woocommerce_loop['columns'] ?>,
            circular  : true,
            infinite  : true,
            debug     : false,
            prev      : '.es-nav .es-nav-prev',
            next      : '.es-nav .es-nav-next',
            swipe     : {
                onTouch: false
            },
            scroll    : {
                items       : 1,
                pauseOnHover: true
            }
        };


    </script>
<?php
}

add_action( 'wp_footer', 'yit_print_image_responsive_enabled_variables', 1 );
add_action( 'yit_after_import', create_function( '', 'update_option("woocommerce_responsive_images", "yes");' ) );


/**
 * Return the following cart info:
 *    - items
 *  - subtotal
 *  - currency
 *
 * @return array
 */
function yit_get_current_cart_info() {
    global $woocommerce;

    if ( get_option( 'woocommerce_tax_display_cart' ) == 'excl' || $woocommerce->customer->is_vat_exempt() ) {
        $subtotal = $woocommerce->cart->subtotal_ex_tax;
    }
    else {
        $subtotal = $woocommerce->cart->subtotal;
    }

    $items = 0;

    if ( yit_get_option( 'minicart-total-items' ) ) {
        foreach ( $woocommerce->cart->get_cart() as $item ) {
            $items += $item['quantity'];
        }
    }
    else {
        $items = count( $woocommerce->cart->get_cart() );
    }

    return array(
        $items,
        $subtotal,
        get_woocommerce_currency_symbol()
    );
}

function yit_format_cart_subtotal( $price ) {
    $num_decimals = (int) get_option( 'woocommerce_price_num_decimals' );

    $price = apply_filters( 'raw_woocommerce_price', (double) $price );
    $price = number_format( $price, $num_decimals, stripslashes( get_option( 'woocommerce_price_decimal_sep' ) ), stripslashes( get_option( 'woocommerce_price_thousand_sep' ) ) );

    return explode( get_option( 'woocommerce_price_decimal_sep' ), $price );
}

function wpml_cart_fix_sts( &$datas ) {

    global $sitepress;

    list( $cart_items, $cart_subtotal, $cart_currency ) = yit_get_current_cart_info();

    if ( $sitepress == '' || empty( $sitepress ) || ! isset( $sitepress ) ) {

        $string = ( $cart_items != 1 ? __( 'Items', 'yit' ) : __( 'Item', 'yit' ) );

    }
    else {

        if($cart_items != 1)  {

            $string = yit_icl_translate( 'theme', 'yit', 'cart-items-label', __( 'Items', 'yit' ) );

        }
        else{

            $string = yit_icl_translate( 'theme', 'yit', 'cart-item-label', __( 'Item', 'yit' ) );

        }

    }

    $datas['#header-cart-search .cart-items-number'] = '<span class="cart-items-number">' . $cart_items . '</span>';
    $datas['#header-cart-search .cart-items-label']  = '<span class="cart-items-label">' . $string . '</span>';

}

function yit_add_to_cart_success_ajax( $datas ) {

    if( defined( 'DOING_AJAX' ) && DOING_AJAX )  {

        list( $cart_items, $cart_subtotal, $cart_currency ) = yit_get_current_cart_info();

        wpml_cart_fix_sts( $datas );

        list( $cart_integer, $cart_decimal ) = yit_format_cart_subtotal( $cart_subtotal );

        $datas['#header-cart-search .cart-subtotal-integer']  = '<span class="cart-subtotal-integer">' . $cart_integer . '</span>';
        $datas['#header-cart-search .cart-subtotal-decimal']  = '<span class="cart-subtotal-decimal">' . $cart_decimal . '</span>';
        $datas['#header-cart-search .cart-subtotal-currency'] = '<span class="cart-subtotal-currency">' . $cart_currency . '</span>';

    }

    return $datas;
}

/* COMPARE */

function yit_woocp_footer_script() {
    $woocp_compare_events = wp_create_nonce( "woocp-compare-events" );
// 	$woocp_compare_popup = wp_create_nonce("woocp-compare-popup");
// 	$comparable_settings = get_option('woo_comparable_settings');
// 	if (trim($comparable_settings['popup_width']) != '') $popup_width = $comparable_settings['popup_width'];
// 	else $popup_width = 1000;
//
// 	if (trim($comparable_settings['popup_height']) != '') $popup_height = $comparable_settings['popup_height'];
// 	else $popup_height = 650;

    $script_add_on = '';
    $script_add_on .= '<script type="text/javascript">
			jQuery(document).ready(function($){';
    $script_add_on .= '
					woo_update_total_compare_list = function(){
						var data = {
							action: 		"woocp_update_total_compare",
							security: 		"' . $woocp_compare_events . '"
						};
						$.post( ajax_url, data, function(response) {
							total_compare = $.parseJSON( response );
							$("#total_compare_product").html("("+total_compare+")");
                            $(".woo_compare_button_go").trigger("click");';
// 	if (trim($comparable_settings['popup_type']) == 'lightbox') {
//         $script_add_on .= '
//                             $.lightbox(ajax_url+"?action=woocp_get_popup&security='.$woocp_compare_popup.'", {
//                                 "width"       : '.$popup_width.',
//                                 "height"      : '.$popup_height.'
//                             });';
// 	}else {
//         $script_add_on .= '
//     						$.fancybox({
//     							href: ajax_url+"?action=woocp_get_popup&security='.$woocp_compare_popup.'",
//     							title: "Compare Products",
//     							maxWidth: '.$popup_width.',
//     							maxHeight: '.$popup_height.',
//     							openEffect	: "none",
//     							closeEffect	: "none"
//     						});';
// 	}

    $script_add_on .= '
    					});
					};

				});
			</script>';
    echo $script_add_on;
}


/**
 * Add default images dimensions to woocommerce options
 *
 */
function yit_woocommerce_default_image_dimensions() {
    $field = 'yit_woocommerce_image_dimensions_' . get_template();

    if ( get_option( $field ) == false ) {
        update_option( $field, time() );

        //woocommerce 1.6.6
        update_option( 'woocommerce_thumbnail_image_width', '100' );
        update_option( 'woocommerce_thumbnail_image_height', '80' );
        update_option( 'woocommerce_single_image_width', '462' );
        update_option( 'woocommerce_single_image_height', '392' );
        update_option( 'woocommerce_catalog_image_width', '254' );
        update_option( 'woocommerce_catalog_image_height', '203' );
        update_option( 'woocommerce_magnifier_image_width', '924' );
        update_option( 'woocommerce_magnifier_image_height', '784' );
        update_option( 'woocommerce_featured_products_slider_image_width', '160' );
        update_option( 'woocommerce_featured_products_slider_image_height', '160' );

        update_option( 'woocommerce_thumbnail_image_crop', 1 );
        update_option( 'woocommerce_single_image_crop', 1 );
        update_option( 'woocommerce_catalog_image_crop', 1 );
        update_option( 'woocommerce_magnifier_image_crop', 1 );
        update_option( 'woocommerce_featured_products_slider_image_crop', 1 );

        //woocommerce 2.0
        update_option( 'shop_thumbnail_image_size', array( 'width' => 100, 'height' => 80, 'crop' => true ) );
        update_option( 'shop_single_image_size', array( 'width' => 462, 'height' => 392, 'crop' => true ) );
        update_option( 'shop_catalog_image_size', array( 'width' => 254, 'height' => 203, 'crop' => true ) );
        update_option( 'woocommerce_magnifier_image', array( 'width' => 924, 'height' => 784, 'crop' => true ) );
        update_option( 'woocommerce_featured_products_slider_image', array( 'width' => 160, 'height' => 160, 'crop' => true ) );
    }
}


/**
 * Backup woocoomerce options when create the export gz
 *
 */
function yit_save_woocommerce_tables( $tables ) {
    $tables[] = 'woocommerce_termmeta';
    $tables[] = 'woocommerce_attribute_taxonomies';
    return $tables;
}

/**
 * Backup woocoomerce options when create the export gz
 *
 */
function yit_save_woocommerce_options( $options ) {
    $options[] = 'woocommerce\_%';
    $options[] = '_wc_needs_pages';
    return $options;
}

/**
 * Backup woocoomerce wishlist when create the export gz
 *
 */
function yit_save_wishlist_options( $options ) {
    $options[] = 'yith\_wcwl\_%';
    $options[] = 'yith-wcwl-%';
    return $options;
}

/**
 * Backup options of plugins when create the export gz
 *
 */
function yit_add_plugins_options( $options ) {
    $options[] = 'yith_woocompare_%';
    $options[] = 'yith_wcmg_%';

    return $options;
}

/**
 * Update woocommerce options after update from 1.6 to 2.0
 */
function yit_woocommerce_update() {
    global $woocommerce;

    $field = 'yit_woocommerce_update_' . get_template();

    if ( get_option( $field ) == false && version_compare( $woocommerce->version, "2.0.0", '>=' ) ) {
        update_option( $field, time() );

        //woocommerce 2.0
        update_option(
            'shop_thumbnail_image_size',
            array(
                'width'  => get_option( 'woocommerce_thumbnail_image_width', 100 ),
                'height' => get_option( 'woocommerce_thumbnail_image_height', 80 ),
                'crop'   => get_option( 'woocommerce_thumbnail_image_crop', 1 )
            )
        );

        update_option(
            'shop_single_image_size',
            array(
                'width'  => get_option( 'woocommerce_single_image_width', 462 ),
                'height' => get_option( 'woocommerce_single_image_height', 392 ),
                'crop'   => get_option( 'woocommerce_single_image_crop', 1 )
            )
        );

        update_option(
            'shop_catalog_image_size',
            array(
                'width'  => get_option( 'woocommerce_catalog_image_width', 254 ),
                'height' => get_option( 'woocommerce_catalog_image_height', 203 ),
                'crop'   => get_option( 'woocommerce_catalog_image_crop', 1 )
            )
        );

        update_option(
            'woocommerce_magnifier_image',
            array(
                'width'  => get_option( 'woocommerce_magnifier_image_width', 924 ),
                'height' => get_option( 'woocommerce_magnifier_image_height', 784 ),
                'crop'   => get_option( 'woocommerce_magnifier_image_crop', 1 )
            )
        );

        update_option(
            'woocommerce_featured_products_slider_image',
            array(
                'width'  => get_option( 'woocommerce_featured_products_slider_image_width', 160 ),
                'height' => get_option( 'woocommerce_featured_products_slider_image_height', 160 ),
                'crop'   => get_option( 'woocommerce_featured_products_slider_image_crop', 1 )
            )
        );
    }
}

function woocommerce_taxonomy_archive_description() {
    if ( get_query_var( 'paged' ) == 0 && false === is_shop() ) {
        global $wp_query;

        $cat          = $wp_query->get_queried_object();
        $thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
        $image        = wp_get_attachment_image_src( $thumbnail_id, 'full' );

        $description = apply_filters( 'the_content', term_description() );
        if ( $description ) {
            echo '<div class="term-description">' . $description . '</div>';
        }
    }
}

function woocommerce_show_product_outofstock_flash() {
    yith_wc_get_template( 'loop/outofstock-flash.php' );
}

add_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_outofstock_flash' );
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_outofstock_flash' );

/* Function to add compatibility with WC 2.1 */
function yit_woocommerce_primary_start() {
    global $woo_shop_folder;
    yith_wc_get_template( $woo_shop_folder . '/primary-start.php' );
}

function yit_rating_singleproduct() {
    yith_wc_get_template( 'single-product/rating.php' );
}

function yit_woocommerce_primary_end() {
    global $woo_shop_folder;
    yith_wc_get_template( $woo_shop_folder . '/primary-end.php' );
}

function yit_enqueue_woocommerce_styles() {
    wp_deregister_style( 'woocommerce_frontend_styles' );
    wp_enqueue_style( 'woocommerce_frontend_styles', get_stylesheet_directory_uri() . '/woocommerce_2.0.x/style.css' );
}

if ( !function_exists( 'yit_enqueue_wc_styles' ) ) {
    /**
     * Remove Woocommerce Styles add custom Yit Woocommerce style
     *
     * @param $styles
     *
     * @return array list of style files
     * @since    2.0.0
     */
    function yit_enqueue_wc_styles( $styles ) {

        $path    = 'woocommerce';
        $version = WC()->version;

        if ( version_compare( preg_replace( '/-beta-([0-9]+)/', '', $version ), WC_LATEST_VERSION, '<' ) ) {
            $path = 'woocommerce_' . substr( $version, 0, 3 ) . '.x';
        }

        /* 2.3 and grather add select2 on cart page*/
        if ( version_compare( preg_replace( '/-beta-([0-9]+)/', '', $version ), '2.2', '>' ) ){
            if(is_cart()){
                wp_enqueue_script( 'select2' );
                wp_enqueue_style( 'select2', WC()->plugin_url() . '/assets/css/select2.css' );
            }
        }

        unset( $styles['woocommerce-general'], $styles['woocommerce-layout'], $styles['woocommerce-smallscreen'] );

        $styles ['yit-layout'] = array(
            'src'     => get_stylesheet_directory_uri() . '/' . $path . '/style.css',
            'deps'    => '',
            'version' => '1.0',
            'media'   => ''
        );
        return $styles;
    }
}

if ( ! function_exists( 'yith_wc_get_template' ) ) {
    function yith_wc_get_template( $template_name, $args = array(), $template_path = '', $default_path = '' ) {
        if ( function_exists( 'wc_get_template' ) ) {
            wc_get_template( $template_name, $args, $template_path, $default_path );
        }
        else {
            woocommerce_get_template( $template_name, $args, $template_path, $default_path );
        }
    }
}


if ( ! function_exists( 'yith_wc_get_page_id' ) ) {

    function yith_wc_get_page_id( $page ) {

        global $woocommerce;

        if ( version_compare( preg_replace( '/-beta-([0-9]+)/', '', $woocommerce->version ), '2.1', '<' ) ) {
            return woocommerce_get_page_id( $page );
        }
        else {

            if ( $page == 'pay' || $page == 'thanks' ) {
                $wc_order = new WC_Order();
                $page     = $wc_order->get_checkout_order_received_url();
            }
            return wc_get_page_id( $page );
        }

    }
}

if ( ! function_exists( 'yit_get_product_slider_items' ) ) {
    function yit_get_product_slider_items() {

        $product_width = yit_shop_small_w() + 10 + 2;


            if ( yit_get_sidebar_layout() == 'sidebar-no' ) {
                if ( $product_width >= 0 && $product_width < 120 ) {
                    return 12;
                }
                elseif ( $product_width >= 120 && $product_width < 220 ) {
                    return 6;
                }
                elseif ( $product_width >= 220 && $product_width < 320 ) {
                    return 4;
                }
                elseif ( $product_width >= 320 && $product_width < 470 ) {
                    return 3;
                }
                elseif ( $product_width >= 470 && $product_width < 620 ) {
                    return 2;
                }
                else {
                    return 1;
                }

            }
            else {
                if ( $product_width >= 0 && $product_width < 150 ) {
                    return 9;
                }
                elseif ( $product_width >= 150 && $product_width < 200 ) {
                    return 4;
                }
                elseif ( $product_width >= 200 && $product_width < 620 ) {
                    return 3;
                }
                else {
                    $is_span = false;
                }
            }
    }
}


/* ADD FEATURE IMAGE TO CATEGORY */

add_action( 'product_cat_edit_form_fields', 'yit_render_edit_product_category_fields' );

if ( ! function_exists( 'yit_render_edit_product_category_fields' ) ) {

    function yit_render_edit_product_category_fields( $term ) {

        $banner_id = absint( get_woocommerce_term_meta( $term->term_id, 'banner_id', true ) );

        if ( $banner_id ) {
            $image = wp_get_attachment_image_src( $banner_id, 'thumbnail' );
            if ( ! empty( $image ) ) {
                $image_url = $image[0];
            }
        }
        else {
            $banner_id = '';
            $image_url = wc_placeholder_img_src();
        }
        ?>
        <tr class="formfield" id="banner_image">
            <th scope="row" valign="top"><label><?php _e( 'Banner image', 'woocommerce' ); ?></label></th>
            <td>

                <div id="product_cat_banner" style="float:left;margin-right:10px;">
                    <img src="<?php echo $image_url; ?>" width="60px" height="60px" /></div>
                <div style="line-height:60px;">
                    <input type="hidden" id="product_cat_banner_id" name="product_cat_banner_id" value="<?php echo $banner_id ?>">
                    <button type="button" class="upload_banner_image_button button"><?php _e( 'Upload/Add image', 'yit' ); ?></button>
                    <button type="button" class="remove_banner_image_button button"><?php _e( 'Remove image', 'yit' ); ?></button>
                </div>
                <script type="text/javascript">

                    var banner_image = jQuery('#banner_image');
                    // Only show the "remove image" button when needed
                    if (!banner_image.find('#product_cat_banner_id').val())
                        banner_image.find('.remove_banner_image_button').hide();

                    // Uploading files
                    var file_frame_;

                    jQuery(document).on('click', '.upload_banner_image_button', function (event) {

                        event.preventDefault();

                        // If the media frame already exists, reopen it.
                        if (file_frame_) {
                            file_frame_.open();
                            return;
                        }

                        // Create the media frame.
                        file_frame_ = wp.media.frames.downloadable_file = wp.media({
                            title   : '<?php _e( 'Choose an image', 'yit' ); ?>',
                            button  : {
                                text: '<?php _e( 'Use image', 'yit' ); ?>',
                            },
                            multiple: false
                        });

                        // When an image is selected, run a callback.
                        file_frame_.on('select', function () {
                            attachment = file_frame_.state().get('selection').first().toJSON();

                            jQuery('#product_cat_banner_id').val(attachment.id);
                            jQuery('#product_cat_banner img').attr('src', attachment.url);
                            jQuery('.remove_banner_image_button').show();
                        });

                        // Finally, open the modal.
                        file_frame_.open();
                    });

                    jQuery(document).on('click', '.remove_banner_image_button', function (event) {
                        jQuery('#product_cat_banner').find('img').attr('src', '<?php echo wc_placeholder_img_src(); ?>');
                        jQuery('#product_cat_banner_id').val('');
                        jQuery('.remove_banner_image_button').hide();
                        return false;
                    });

                </script>
                <div class="clear"></div>
            </td>
        </tr>
    <?php
    }
}

if ( ! function_exists( 'yit_save_edit_product_category_fields' ) ) {

    function yit_save_edit_product_category_fields( $term_id ) {
        if ( isset( $_POST['product_cat_banner_id'] ) ) {
            update_woocommerce_term_meta( $term_id, 'banner_id', absint( $_POST['product_cat_banner_id'] ) );
        }
    }

}
add_action( 'edited_product_cat', 'yit_save_edit_product_category_fields', 10, 2 );
add_action( 'create_product_cat', 'yit_save_edit_product_category_fields', 10, 2 );


if ( ! function_exists( 'yit_custom_tax_image' ) ) {
    function yit_custom_tax_image( $image_banner ) {

        global $wp_query;
        // get the query object
        $cat_obj = $wp_query->get_queried_object();
        if ( ! is_post_type_archive( 'product' ) ) {
            $banner_id = get_woocommerce_term_meta( $cat_obj->term_id, 'banner_id', true );
            $image     = wp_get_attachment_image_src( $banner_id, 'full' );
            if ( ! empty( $image ) ) {
                $image_banner = $image[0];
            }
        }

        return $image_banner;
    }

    add_filter( 'yit_static_image', 'yit_custom_tax_image' );
}

function is_category_shop_page() {
    global $wp_query;
    $cat_obj = $wp_query->get_queried_object();
    if ( ! is_post_type_archive( 'product' ) && yit_get_option( 'shop-category-banner' ) ) {
        return $cat_obj->term_id;
    }
    else {
        return false;
    }
}

add_filter( 'is_category_shop_page', 'is_category_shop_page' );


function yit_woocommerce_object() {

    wp_localize_script( 'jquery', 'yit_woocommerce', array(
        'woocommerce_ship_to_billing' =>  yit_woocommerce_default_shiptobilling(),
        'load_gif' => yit_get_ajax_loader_gif_url(),
        'version' => WC()->version,
    ));

}

if ( ! function_exists( 'yit_woocommerce_default_shiptobilling' ) ) {

    function yit_woocommerce_default_shiptobilling() {
        return ( get_option( 'woocommerce_ship_to_destination' ) == 'billing' || get_option( 'woocommerce_ship_to_destination' ) == 'billing_only' );
    }

}

if ( ! function_exists( 'yit_woocommerce_default_shiptoaddress' ) ) {

    function yit_woocommerce_default_shiptoaddress() {
        return ( get_option( 'woocommerce_ship_to_destination' ) == 'shipping' );
    }
}

if ( ! function_exists( 'yit_woocommerce_shiptobilling_only' ) ) {

    function yit_woocommerce_shiptobilling_only() {
        return ( get_option( 'woocommerce_ship_to_destination' ) == 'billing_only' );
    }
}


// ====== WC 2.6 ======== /

function yit_wc_product_post_class( $classes, $class = '', $post_id = '' ) {

    if ( ! $post_id || 'product' !== get_post_type( $post_id ) ) {
        return $classes;
    }

    $product = wc_get_product( $post_id );

    if ( $product ) {

        global $woocommerce_loop;
        // Extra post classes
        //$classes = array();

        if( ! isset( $woocommerce_loop['name'] ) && ! isset( $woocommerce_loop['view'] ) ) {
            return $classes;
        }

        global  $yit_is_feature_tab;

        // width of each product for the grid
        $content_width = yit_get_sidebar_layout() == 'sidebar-no' ? 1170 : 870;
        if ( isset( $yit_is_feature_tab ) && $yit_is_feature_tab ) $content_width -= 300;
        $product_width = yit_shop_small_w() + 10 + 2;  // 10 = padding & 2 = border
        $is_span = false;

        if ( get_option( 'woocommerce_responsive_images' , 'yes' ) ) {
            $is_span = true;
            if ( yit_get_sidebar_layout() == 'sidebar-no' ) {
                if ( $product_width >= 0   && $product_width < 120 ) { $classes[] = 'span1'; $woocommerce_loop['columns'] = 12; }
                elseif ( $product_width >= 120 && $product_width < 220 ) { $classes[] = 'span2'; $woocommerce_loop['columns'] = 6;  }
                elseif ( $product_width >= 220 && $product_width < 320 ) { $classes[] = 'span3'; $woocommerce_loop['columns'] = 4;  }
                elseif ( $product_width >= 320 && $product_width < 470 ) { $classes[] = 'span4'; $woocommerce_loop['columns'] = 3;  }
                elseif ( $product_width >= 470 && $product_width < 620 ) { $classes[] = 'span6'; $woocommerce_loop['columns'] = 2;  }
                else $is_span = false;

            } else {
                if ( $product_width >= 0   && $product_width < 150 ) { $classes[] = 'span1'; $woocommerce_loop['columns'] = 9; }
                elseif ( $product_width >= 150 && $product_width < 620 ) { $classes[] = 'span3'; $woocommerce_loop['columns'] = 3;  }
                else $is_span = false;

            }

        } else {
            $grid = yit_get_span_from_width( $product_width );
            $classes[] = 'span' . $grid;
            $product_width = yit_width_of_span( $grid );
        }
        if ( $yit_is_feature_tab || ! $is_span ) $woocommerce_loop['columns'] = floor( ( $content_width + 30 ) / ( $product_width + 30 ) );

        $woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', $woocommerce_loop['columns'] );

        // add product id
        $classes[] = 'product-' . $product->id;

        if ( !( isset( $woocommerce_loop['layout'] ) && ! empty( $woocommerce_loop['layout'] ) ) )
            $woocommerce_loop['layout'] = yit_get_option( 'shop-layout', 'with-hover' );

        if ( !( isset( $woocommerce_loop['view'] ) && ! empty( $woocommerce_loop['view'] ) ) )
            $woocommerce_loop['view'] = yit_get_option( 'shop-view', 'grid' );


        // li classes
        $classes[] = 'product';
        $classes[] = 'group';
        $classes[] = $woocommerce_loop['view'];
        $classes[] = $woocommerce_loop['layout'];
        if ( yit_get_option('shop-view-show-border') ) {
            $classes[] = 'with-border';
        }

        // if css3
        if ( yit_ie_version() == -1 || yit_ie_version() > 9 ) $classes[] = 'css3';

        // force open hover
        if ( yit_get_option( 'shop-open-hover' ) ) $classes[] = 'force-open-hover';

        // open the hover on mobile
        if ( yit_get_option( 'responsive-open-hover' ) ) $classes[] = 'open-on-mobile';

        // open the hover on mobile
        if ( yit_get_option( 'responsive-force-classic' ) && $woocommerce_loop['layout'] == 'with-hover' ) $classes[] = 'force-classic-on-mobile';

    }

    return $classes;

}

function yit_wc_product_product_cat_class( $classes, $class, $category ) {

    global $woocommerce_loop, $yit_is_feature_tab;

    // Store loop count we're currently on.
    if ( empty( $woocommerce_loop['loop'] ) ) {
        $woocommerce_loop['loop'] = 0;
    }

    // Store column count for displaying the grid.
    if ( empty( $woocommerce_loop['columns'] ) ) {
        $woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
    }


    if( ! isset( $columns ) ) {
        $columns = 0;
    }

    if ( ! ( isset( $woocommerce_loop['layout'] ) && ! empty( $woocommerce_loop['layout'] ) ) ) {
        $woocommerce_loop['layout'] = yit_get_option( 'shop-layout', 'with-hover' );
    }

    if ( ! ( isset( $woocommerce_loop['view'] ) && ! empty( $woocommerce_loop['view'] ) ) ) {
        $woocommerce_loop['view'] = yit_get_option( 'shop-view', 'grid' );
    }

    $classes[] = 'product';
    $classes[] = 'category';
    $classes[] = 'group';
    $classes[] = $woocommerce_loop['view'];
    $classes[] = $woocommerce_loop['layout'];

    if ( yit_get_option( 'shop-view-show-border' ) ) {
        $classes[] = 'with-border';
    }

    // width of each product for the grid
    $content_width = yit_get_sidebar_layout() == 'sidebar-no' ? 1170 : 870;
    if ( isset( $yit_is_feature_tab ) && $yit_is_feature_tab ) {
        $content_width -= 300;
    }

    $product_width = yit_shop_small_w() + 10 + 2; // 10 = padding & 2 = border
    $is_span       = false;

    if ( get_option( 'woocommerce_responsive_images' , 'yes' ) == 'yes' && $columns == 0 ) {
        $is_span = true;
        if ( yit_get_sidebar_layout() == 'sidebar-no' ) {
            if ( $product_width >= 0 && $product_width < 120 ) {
                $classes[] = 'span1';
                $woocommerce_loop['columns']    = 12;
            }
            elseif ( $product_width >= 120 && $product_width < 220 ) {
                $classes[] = 'span2';
                $woocommerce_loop['columns']    = 6;
            }
            elseif ( $product_width >= 220 && $product_width < 320 ) {
                $classes[] = 'span3';
                $woocommerce_loop['columns']    = 4;
            }
            elseif ( $product_width >= 320 && $product_width < 470 ) {
                $classes[] = 'span4';
                $woocommerce_loop['columns']    = 3;
            }
            elseif ( $product_width >= 470 && $product_width < 620 ) {
                $classes[] = 'span6';
                $woocommerce_loop['columns']    = 2;
            }
            else {
                $is_span = false;
            }

        }
        else {
            if ( $product_width >= 0 && $product_width < 150 ) {
                $classes[] = 'span1';
                $woocommerce_loop['columns']    = 12;
            }
            elseif ( $product_width >= 150 && $product_width < 620 ) {
                $classes[] = 'span3';
                $woocommerce_loop['columns']    = 3;
            }
            else {
                $is_span = false;
            }

        }

    }
    elseif ( $columns == 0 ) {
        $grid                           = yit_get_span_from_width( $product_width );
        $classes[] = 'span' . $grid;
        $product_width                  = yit_width_of_span( $grid );
    }
    if ( ( isset( $yit_is_feature_tab ) && $yit_is_feature_tab ) || ! $is_span && $columns == 0 ) {
        $woocommerce_loop['columns'] = floor( ( $content_width + 30 ) / ( $product_width + 30 ) );
    }

    return $classes;

}

/**
 * @author Andrea Frascaspata
 */
function yit_wc_2_6_removed_unused_template () {

    if( function_exists( 'yit_theme_remove_unused_template' ) ) {

        $option = 'yit_wc_2_6_template_remove';

        $files = array( 'myaccount/form-login.php' , 'myaccount/my-account.php' , 'single-product/review.php' );

        yit_theme_remove_unused_template( 'woocommerce' , $option , $files );

    }

}


//-------------------------------------------------------------------------


if ( ! function_exists( 'yit_plugins_support' ) ) {
    /**
     * YITH Plugins support
     *
     * @return string
     * @since 1.0
     */
    function yit_plugins_support() {

        /* Wishlist */

        if(defined('YITH_WCWL_PREMIUM')) {

            add_filter('yith_wcwl_before_wishlist_widget' , 'yit_add_wishlist_widget_before_border_style');

            add_filter('yith_wcwl_after_wishlist_widget' , 'yit_add_wishlist_widget_after_border_style');

            function yit_add_wishlist_widget_before_border_style( $before ) {
                return $before . '<div class="border">';
            }

            function yit_add_wishlist_widget_after_border_style( $after ) {
                return $after . '</div>';
            }

        }

        /* Advanced Reviews */

        if( defined('YITH_YWAR_PREMIUM') ) {

            add_filter( 'yith_advanced_reviews_loader_gif', 'yit_get_ajax_loader_gif_url' );
        }

        /* Request a Quote */

        if ( defined( 'YITH_YWRAQ_VERSION' ) ) {

            $yith_request_quote = YITH_Request_Quote();

            if ( yit_get_option( 'shop-layout', 'with-hover' ) == 'with-hover' ) {

                if ( method_exists( $yith_request_quote, 'add_button_shop' ) ) {
                    remove_action( 'woocommerce_after_shop_loop_item', array( $yith_request_quote, 'add_button_shop' ), 15 );
                }
            }

            if ( function_exists( 'YITH_YWRAQ_Frontend' ) ) {
                $yith_request_quote_frontend = YITH_YWRAQ_Frontend();

                remove_action( 'woocommerce_single_product_summary', array( $yith_request_quote_frontend, 'add_button_single_page' ), 35 );
            }

            add_filter( 'ywraq_product_in_list', 'yit_ywraq_change_product_in_list_message' );

            function yit_ywraq_change_product_in_list_message() {
                return __( 'In your quote list', 'yit' );
            }

            add_filter( 'ywraq_product_added_view_browse_list', 'yit_ywraq_product_added_view_browse_list_message' );

            function yit_ywraq_product_added_view_browse_list_message() {
                return __( 'view list', 'yit' );
            }

            function yit_ywraq_change_button_label() {
                return __( 'quote', 'yit' );
            }

        }

        function yit_ywraq_print_button() {

            if ( defined( 'YITH_YWRAQ_VERSION' ) ) {

                if ( yit_get_option( 'shop-layout', 'with-hover' ) == 'with-hover' ) {

                    $yith_request_quote = YITH_Request_Quote();

                    if ( method_exists( $yith_request_quote, 'add_button_shop' ) ) {
                        add_filter( 'ywraq_product_add_to_quote', 'yit_ywraq_change_button_label' );
                        ob_start();
                        $yith_request_quote->add_button_shop();
                        return ob_get_clean();
                    }
                }

            }
            return '';
        }

        function yit_ywraq_print_button_single_page() {

            if ( defined( 'YITH_YWRAQ_VERSION' ) ) {

                $yith_request_quote = YITH_YWRAQ_Frontend();

                if ( method_exists( $yith_request_quote, 'add_button_single_page' ) ) {
                    ob_start();
                    $yith_request_quote->add_button_single_page();
                    return ob_get_clean();
                }


            }
            return '';
        }

        /* Catalog Mode */

        if ( defined( 'YWCTM_PREMIUM' ) ) {

            global $YITH_WC_Catalog_Mode;
            if ( isset( $YITH_WC_Catalog_Mode ) && yit_product_form_position_is( 'in-sidebar' ) ) {
                if( method_exists( $YITH_WC_Catalog_Mode, 'check_add_to_cart_single' ) && $YITH_WC_Catalog_Mode->check_add_to_cart_single() ) {
                    remove_action( 'yit_product_box', 'woocommerce_template_single_add_to_cart', 20 );
                }
            }

        }

        function yit_ywctm_hide_cart_page() {

            $ywctm_hide_cart_page = false;
            global $YITH_WC_Catalog_Mode;
            if ( isset( $YITH_WC_Catalog_Mode ) ) {
                $ywctm_hide_cart_page = method_exists( $YITH_WC_Catalog_Mode, 'check_hide_cart_checkout_pages' ) && $YITH_WC_Catalog_Mode->check_hide_cart_checkout_pages();
            }

            return $ywctm_hide_cart_page;
        }

        add_filter( 'ywctm_modify_woocommerce_after_shop_loop_item' , 'yit_ywctm_modify_woocommerce_after_shop_loop_item' );

        function yit_ywctm_modify_woocommerce_after_shop_loop_item() {
            return false;
        }

        /* === YITH WooCommerce Multi Vendor */

        $is_vendor_installed =  function_exists( 'YITH_Vendors' );
        $is_vendor_premium_installed = class_exists( 'YITH_Vendors_Frontend_Premium' );

        if( $is_vendor_premium_installed &&  $is_vendor_installed ){
            $obj = YITH_Vendors()->frontend;
            remove_action( 'woocommerce_archive_description', array( $obj, 'add_store_page_header' ) );
            add_action( 'yith_before_shop_page_meta', array( $obj, 'add_store_page_header' ) );
            //add_filter( 'yith_wpv_quick_info_button_class', 'yith_multi_vendor_button_class' );
            //add_filter( 'yith_wpv_report_abuse_button_class', 'yith_multi_vendor_button_class' );
        }

        if ( ! function_exists( 'yith_multi_vendor_quick_info_button_class' ) ) {

            /**
             * YITH Plugins support -> Multi Vendor widgets submit button
             *
             * @param string $class
             * @return string
             * @since 1.0
             */
            function yith_multi_vendor_button_class( $class ) {
                return 'btn btn-flat-red alignright';
            }
        }

        if (  $is_vendor_installed ) {

            if( ! function_exists( 'yit_contact_form_to_vendor' ) ) {
                function yit_contact_form_to_vendor( $to ){
                    $vendor_email = false;
                    if( ! empty( $_POST['yit_contact']['product_id'] ) && yit_get_option( 'send-email-to-vendor' ) ){
                        $vendor = yith_get_vendor( $_POST['yit_contact']['product_id'], 'product' );
                        if( $vendor->is_valid() ){
                            $vendor_email = $vendor->store_email;
                            if( empty( $vendor_email ) ){
                                $vendor_owner = get_user_by( 'id', absint( $vendor->get_owner() ) );
                                $vendor_email = $vendor_owner instanceof WP_User ? $vendor_owner->user_email : false;
                            }
                        }
                    }
                    return $vendor_email ? $vendor_email : $to;
                }
            }

            add_filter( 'yit_contact_form_email_to', 'yit_contact_form_to_vendor' );
        }

        /* ============================= */

        /* YITH WOOCOMMERCE BRANDS */

        if( function_exists( 'YITH_WCBR_Premium' ) ){
            remove_action( 'woocommerce_archive_description', array( YITH_WCBR_Premium(), 'add_archive_brand_template' ) );
        }
        elseif( function_exists( 'YITH_WCBR' ) ){
            remove_action( 'woocommerce_archive_description', array( YITH_WCBR(), 'add_archive_brand_template' ) );
        }

        /* ============================= */

    }

}
