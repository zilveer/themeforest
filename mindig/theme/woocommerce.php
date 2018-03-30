<?php
/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

define( 'WC_LATEST_VERSION', '2.6' );

/* === HOOKS === */
function yit_woocommerce_hooks() {

    global $yith_woocompare;

    if ( ! defined( 'YIT_DEBUG' ) || ! YIT_DEBUG ) {
        $message = get_option( 'woocommerce_admin_notices', array() );
        $message = array_diff( $message, array( 'template_files' ) );
        update_option( 'woocommerce_admin_notices', $message );
    }

    add_action( 'yit_activated', 'yit_woocommerce_default_image_dimensions' );
    add_filter( 'woocommerce_enqueue_styles', 'yit_enqueue_wc_styles' );
    add_filter( 'woocommerce_template_path', 'yit_set_wc_template_path' );
    if( yit_is_old_ie() ) {
        add_action( 'wp_head', 'yit_add_wc_styles_to_assets', 0 );
    }
    add_action( 'wp_head', 'yit_size_images_style' );
    add_action( 'woocommerce_before_main_content', 'yit_shop_page_meta' );

    // Ajax search loading
    add_filter( 'yith_wcas_ajax_search_icon', 'yit_loading_search_icon' );

    // Use WC 2.0 variable price format, now include sale price strikeout
    add_filter( 'woocommerce_variable_sale_price_html', 'wc_wc20_variation_price_format', 10, 2 );
    add_filter( 'woocommerce_variable_price_html', 'wc_wc20_variation_price_format', 10, 2 );

    // Add to cart button text
    add_filter( 'add_to_cart_text', 'yit_add_to_cart_text' );

    // View details button text
    add_filter( 'view_details_text', 'yit_view_details_text' );

    // Custom Pagination
    add_filter( 'woocommerce_pagination_args', 'yit_pagination_shop_args' );


    /*============= SHOP PAGE ===============*/

    remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
    remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
    remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

    add_filter( 'loop_shop_per_page', 'yit_products_per_page' );
    add_action( 'shop-page-meta', 'yit_wc_catalog_ordering' );
    if ( yit_get_option( 'shop-view-type' ) != 'masonry' ) {
        add_action( 'shop-page-meta', 'yit_wc_list_or_grid' );
    }
    add_action( 'shop-page-meta', 'yit_wc_num_of_products' );

    if( yit_get_option( 'shop-product-rating' ) == 'yes' ) {
        add_action( 'woocommerce_after_shop_loop_item', 'yit_shop_rating', 1 );
    }
    add_action( 'woocommerce_after_shop_loop_item', 'yit_shop_product_description', 18 );
    add_action( 'woocommerce_after_shop_loop_item', 'yit_shop_other_actions', 20 );
    add_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_sale_flash' );

    if ( yit_get_option('shop-enable') == 'no' || yit_get_option( 'shop-product-price' ) == 'no' ) {
        remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price' );
    }

    /** 2.5 action */
    remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );

    add_action( 'woocommerce_shop_loop_item_title', 'yit_shop_page_product_title', 10 );

    if ( version_compare( preg_replace( '/-beta-([0-9]+)/', '', WC()->version ), '2.6', '>=' ) ) {

        // My Account

        add_filter( 'woocommerce_account_menu_items' , 'yit_woocommerce_account_menu_items' );
        
        // Loop

        add_filter( 'post_class', 'yit_wc_product_post_class', 30, 3 );

        add_filter( 'product_cat_class', 'yit_wc_product_product_cat_class', 30, 3 );

        // Review

        add_action( 'woocommerce_review_meta', 'yit_woocommerce_review_display_meta', 15 );


        // Single product

        add_action( 'woocommerce_share' , 'yit_theme_woocommerce_share' );

        // remove unused template

        yit_wc_2_6_removed_unused_template() ;

        
    }

    /*======== SINGLE PRODUCT PAGE =========*/

    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
    add_action( 'yit_single_page_breadcrumb', 'woocommerce_breadcrumb', 20, 0 );


    remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );

    /* remove standard compare button */
    if ( isset( $yith_woocompare ) ) {
        remove_action( 'woocommerce_single_product_summary', array( $yith_woocompare->obj, 'add_compare_link' ), 35 );
    }

    add_action( 'yit_single_page_nav_links', 'yit_single_page_nav_links' );
    add_action( 'woocommerce_single_product_summary', 'yit_product_modal_window', 25 );

    if ( yit_get_option('shop-single-product-name') == 'no' ) remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
    if ( yit_get_option( 'shop-single-metas' ) == 'no' ) remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

    /* related products */
    if ( yit_get_option( 'shop-show-related' ) == 'no' ) remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
    if ( yit_get_option( 'shop-show-custom-related' ) == 'yes' ) add_action( 'woocommerce_related_products_args', 'yit_related_posts_per_page' );

    /* tabs */
    if ( yit_get_option( 'shop-remove-reviews' ) == 'yes' ){
        add_filter( 'woocommerce_product_tabs', 'yit_remove_reviews_tab', 98 );
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
    }
    add_filter( 'woocommerce_product_tabs', 'yit_woocommerce_add_tabs' );


    /*============== CART ============*/

    remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
    add_action( 'woocommerce_after_cart', 'woocommerce_cross_sell_display' );

    /*============= CHECKOUT =========== */

    if( yit_get_option( 'shop-checkout-coupon-setting' ) == 'no' ) {
        remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form' );
    }

    /*============== ADMIN  ==============*/

    add_action( 'woocommerce_product_options_general_product_data', 'yit_woocommerce_admin_product_ribbon_onsale' );
    add_action( 'woocommerce_process_product_meta', 'yit_woocommerce_process_product_meta', 2, 2 );

    /*===== MANAGE VAT AND SSN FIELDS =====*/

    if ( yit_get_option( 'shop-enable-vat' ) == 'yes' && yit_get_option( 'shop-enable-ssn' ) == 'yes' ) {
        add_filter( 'woocommerce_billing_fields', 'yit_woocommerce_add_billing_ssn_vat' );
        add_filter( 'woocommerce_shipping_fields', 'yit_woocommerce_add_shipping_ssn_vat' );
        add_filter( 'woocommerce_admin_billing_fields', 'woocommerce_add_billing_shipping_fields_admin' );
        add_filter( 'woocommerce_admin_shipping_fields', 'woocommerce_add_billing_shipping_fields_admin' );
    }
    elseif ( yit_get_option( 'shop-enable-vat' ) == 'yes' ) {
        add_filter( 'woocommerce_billing_fields', 'yit_woocommerce_add_billing_vat' );
        add_filter( 'woocommerce_shipping_fields', 'yit_woocommerce_add_shipping_vat' );
        add_filter( 'woocommerce_admin_billing_fields', 'woocommerce_add_billing_shipping_vat_admin' );
        add_filter( 'woocommerce_admin_shipping_fields', 'woocommerce_add_billing_shipping_vat_admin' );
        add_filter( 'woocommerce_load_order_data', 'woocommerce_add_var_load_order_data_vat' );
    }
    elseif ( yit_get_option( 'shop-enable-ssn' ) == 'yes') {
        add_filter( 'woocommerce_billing_fields', 'yit_woocommerce_add_billing_ssn' );
        add_filter( 'woocommerce_shipping_fields', 'yit_woocommerce_add_shipping_ssn' );
        add_filter( 'woocommerce_admin_billing_fields', 'woocommerce_add_billing_shipping_ssn_fields_admin' );
        add_filter( 'woocommerce_admin_shipping_fields', 'woocommerce_add_billing_shipping_ssn_fields_admin' );
        add_filter( 'woocommerce_load_order_data', 'woocommerce_add_var_load_order_data_ssn' );
    }

    /*================ QUICK VIEW ==================*/

    add_action( 'yit_load_quick_view', 'yit_woocommerce_quick_view' );
    if ( is_quick_view() ) add_filter( 'woocommerce_single_product_image_html', 'yit_product_image_slider_quick_view' );

    /*================ REVIEW ==================*/
    add_filter( 'comments_open', 'yit_woocommerce_show_review', 11, 2);

    if ( defined( 'YITH_YWAR_VERSION' ) ) {

        global $YWAR_AdvancedReview;

        remove_action( 'yith_advanced_reviews_before_reviews', array( $YWAR_AdvancedReview, 'load_reviews_summary' ) );

        add_action( 'yith_advanced_reviews_before_review_list', array( $YWAR_AdvancedReview, 'load_reviews_summary' ) );
    }

    /*================ Colors and Label Variations Premium ==================*/

    if( defined( 'YITH_WCCL_PREMIUM' ) && function_exists( 'YITH_WCCL_Frontend' ) ) {
        remove_filter( 'woocommerce_loop_add_to_cart_link', array( YITH_WCCL_Frontend(), 'add_select_options' ), 99, 2 );
        add_action( 'woocommerce_after_shop_loop_item', array( YITH_WCCL_Frontend(), 'print_select_options'  ) , 2);
    }

    /*======== Support to YITH Plugins =========*/

    add_action( 'init', 'yit_plugins_support' );

}
add_action( 'after_setup_theme', 'yit_woocommerce_hooks' );

// USeful for opening cart in header
function yit_remove_add_to_cart_redirect() {
    return false;
}
add_filter( yit_get_add_to_cart_redirect_filter_name(), 'yit_remove_add_to_cart_redirect' );


    /**
     * Get add to cart redirect filter name
     *
     *
     * @return string
     * @since  2.0.0
     * @author Andrea Frascaspata <andrea.frascaspata@yithemes.com>
     */
    function yit_get_add_to_cart_redirect_filter_name(){

        $add_to_cart_redirect_filter = 'woocommerce_add_to_cart_redirect';

        //wc 2.2.x fix
        if ( version_compare( preg_replace( '/-beta-([0-9]+)/', '', WC()->version ), '2.3', '<' ) ) {
            $add_to_cart_redirect_filter = 'add_to_cart_redirect';
        }

        return  $add_to_cart_redirect_filter;
    }

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

        if ( yit_get_option( 'shop-product-title' ) == 'yes' ) {

            $html = '<h3 class="product-name">';
            $html .= '<a href="' . get_permalink() . '">' . get_the_title() . '</a>';
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

        if ( ( isset( $show_counter ) && $show_counter == 1 ) && $category->count > 0 ) : ?>

        <div class="category-count">
            <div class="category-count-content">
                <?php
                echo apply_filters( 'woocommerce_subcategory_count_html', ' <span class="count">' . $category->count . _n( " product", " products", $category->count, "yit" ) . '</span>', $category );
                ?>
            </div>
        </div>
        <?php endif; ?>
        </div>

        <div class="category-name">
            <h4>
                <?php echo $category->name; ?>
            </h4>
        </div>

    <?php
    }
    remove_action( 'woocommerce_shop_loop_subcategory_title', 'woocommerce_template_loop_category_title', 10 );
    add_action( 'woocommerce_shop_loop_subcategory_title' , 'yit_woocommerce_shop_loop_subcategory_title' , 10 , 2 );
}


/********
 * SIZES
 **********/

// shop small

if ( ! function_exists( 'yit_shop_catalog_w' ) ) : function yit_shop_catalog_w() {
    $size = wc_get_image_size( 'shop_catalog' );
    return $size['width'];
} endif;
if ( ! function_exists( 'yit_shop_catalog_h' ) ) : function yit_shop_catalog_h() {
    $size = wc_get_image_size( 'shop_catalog' );
    return $size['height'];
} endif;
if ( ! function_exists( 'yit_shop_catalog_c' ) ) : function yit_shop_catalog_c() {
    $size = wc_get_image_size( 'shop_catalog' );
    return $size['crop'];
} endif;

// shop thumbnail

if ( ! function_exists( 'yit_shop_thumbnail_w' ) ) : function yit_shop_thumbnail_w() {
    $size = wc_get_image_size( 'shop_thumbnail' );
    return $size['width'];
} endif;
if ( ! function_exists( 'yit_shop_thumbnail_h' ) ) : function yit_shop_thumbnail_h() {
    $size = wc_get_image_size( 'shop_thumbnail' );
    return $size['height'];
} endif;
if ( ! function_exists( 'yit_shop_thumbnail_c' ) ) : function yit_shop_thumbnail_c() {
    $size = wc_get_image_size( 'shop_thumbnail' );
    return $size['crop'];
} endif;

//shop large

if ( ! function_exists( 'yit_shop_single_w' ) ) : function yit_shop_single_w() {
    $size = wc_get_image_size( 'shop_single' );
    return $size['width'];
} endif;
if ( ! function_exists( 'yit_shop_single_h' ) ) : function yit_shop_single_h() {
    $size = wc_get_image_size( 'shop_single' );
    return $size['height'];
} endif;
if ( ! function_exists( 'yit_shop_single_c' ) ) : function yit_shop_single_c() {
    $size = wc_get_image_size( 'shop_single' );
    return $size['crop'];
} endif;



if ( ! function_exists( 'yit_add_to_cart_text' ) ) {
    /**
     * Set Add to Cart label from Theme Options
     *
     * @return string
     *
     * @since 1.0.0
     */
    function yit_add_to_cart_text() {
        global $product;

        if ( $product->product_type != 'external' ) {
            $text = __( yit_get_option( 'shop-add-to-cart-text' ), 'yit' );
        }
        return $text;
    }
}

if ( ! function_exists( 'yit_view_details_text' ) ) {
    /**
     * Set view details label from Theme Options
     *
     * @return string
     *
     * @since 1.0.0
     */
    function yit_view_details_text() {
        $text = __( yit_get_option( 'shop-view-details-text' ), 'yit' );

        return $text;
    }
}

if ( ! function_exists( 'yit_enqueue_wc_styles' ) ) {
    /**
     * Remove Woocommerce Styles add custom Yit Woocommerce style
     *
     * @param $styles
     *
     * @return array list of style files
     * @since    2.0.0
     */
    function yit_enqueue_wc_styles( $styles ) {

        $path = 'woocommerce';
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

if( ! function_exists( 'yit_add_wc_styles_to_assets' ) ){
    function yit_add_wc_styles_to_assets(){

        $path = 'woocommerce';
        $version = WC()->version;

        if ( version_compare( preg_replace( '/-beta-([0-9]+)/', '', $version ), WC_LATEST_VERSION, '<' ) ) {
            $path = 'woocommerce_' . substr( $version, 0, 3 ) . '.x';
        }

        $stylepicker_css = array(
            'src'     => get_stylesheet_directory_uri() . '/' . $path . '/style.css',
            'enqueue'   => true,
            'media'     => 'all'
        );

        if( function_exists( 'YIT_Asset' ) ){
            YIT_Asset()->set( 'style', 'yit-woocommerce', $stylepicker_css, 'after', 'theme-stylesheet' );
        }

    }
}

if ( ! function_exists( 'yit_set_wc_template_path' ) ) {
    /**
     * Return the folder of custom woocommerce templates
     *
     * @param $path
     *
     * @return string template folder
     *
     * @since    2.0.0
     */
    function yit_set_wc_template_path( $path ) {

        $version = WC()->version;

        if ( version_compare( preg_replace( '/-beta-([0-9]+)/', '', WC()->version ), WC_LATEST_VERSION, '<' ) ) {
            $path = 'woocommerce_' . substr( $version, 0, 3 ) . '.x/';
        }

        return $path;
    }
}

function woocommerce_template_loop_product_thumbnail() {

    global $product, $woocommerce_loop;

    $i = 0;
    $attachments = array();

    $attachments[] = get_post_thumbnail_id();
    $attachments = array_merge( $attachments, $product->get_gallery_attachment_ids() );

    $original_size = wc_get_image_size( 'shop_catalog' );

    if ( $woocommerce_loop['view'] == 'masonry_item' ) {
        $size = $original_size;
        $size['height'] = 0;
        YIT_Registry::get_instance()->image->set_size('shop_catalog', $size );
    }

    switch  ( $woocommerce_loop['products_layout'] ) {

        case 'zoom':
            if( isset( $attachments[1] ) ) {
                echo '<a href="' . get_permalink() . '" class="thumb">' . woocommerce_get_product_thumbnail() . '</a>';
                echo '<div class="attachments-thumbnail">';
                while( $i < 3 ){
                    if( ! isset( $attachments[ $i ] ) ) break;
                    $src = wp_get_attachment_image_src( $attachments[ $i ], 'shop_catalog' );
                    $active = ( $i == 0 ) ? 'active' : '';
                    echo '<div class="single-attachment-thumbnail ' . $active . '" data-img="' . $src[0] . '">';
                    yit_image( "id=$attachments[$i]&size=shop_thumbnail&class=image-hover" );
                    echo '</div>';
                    $i++;
                }
                echo '</div>';
            }
            else {
                echo '<a href="' . get_permalink() . '" class="thumb">' . woocommerce_get_product_thumbnail() . '</a>';
            }
            break;

        case 'flip':
            if( isset( $attachments[1] ) ) {
                echo '<a href="' . get_permalink() . '" class="thumb backface"><span class="face">' . woocommerce_get_product_thumbnail() . '</span>';
                echo '<span class="face back">';
                yit_image( "id=$attachments[1]&size=shop_catalog&class=image-hover" );
                echo '</span></a>';
            }
            else {
                echo '<a href="' . get_permalink() . '" class="thumb"><span class="face">' . woocommerce_get_product_thumbnail() . '</span></a>';
            }
            break;
    }

    if ( $woocommerce_loop['view'] == 'masonry_item' ) {
        YIT_Registry::get_instance()->image->set_size('shop_catalog', $original_size );
    }
}

if ( ! function_exists( 'yit_shop_rating' ) ) {
    function yit_shop_rating() {
        global $product;
        if ( yit_get_option( 'shop-product-rating' ) == 'yes' ) {
            echo '<div class="woocommerce-product-rating"><div class="star-rating"><span style="width:' . ( ( $product->get_average_rating() / 5 ) * 100 ) . '%"></span></div></div>';
        }
    }
}


if( ! function_exists( 'yit_shop_other_action' ) ){

    function yit_shop_other_actions() {
        wc_get_template( 'loop/other-actions.php' );
    }
}

if ( ! function_exists( 'yit_get_current_cart_info' ) ) {
    /**
     * Remove Woocommerce Styles add custom Yit Woocommerce style
     *
     * @internal param $styles
     *
     * @return array list of style files
     * @since    2.0.0
     */
    function yit_get_current_cart_info() {

        $subtotal  = WC()->cart->get_cart_subtotal();
        $items     = yit_get_option( 'shop-mini-cart-total-items' ) ? WC()->cart->get_cart_contents_count() : count( WC()->cart->get_cart() );
        $cart_icon = yit_get_option( 'shop-mini-cart-icon' );

        return array(
            $items,
            $subtotal,
            $cart_icon,
            get_woocommerce_currency_symbol(),
        );
    }
}

if ( ! function_exists( 'yit_shop_product_description' ) ) {
    /**
     * Add short product description in shop
     *
     */
    function yit_shop_product_description() {

        global $product;

        $excerpt = $product->post->post_excerpt;

        $show_in_grid =  ( yit_get_option( 'shop-product-description' ) == 'yes' ) ? 'show-in-grid' : '';

        if ( $excerpt != "" ) :
            echo '<div class="product-description ' . $show_in_grid . '"><p>';
            echo wp_trim_words( $excerpt );
            echo '</p></div>';
        endif;

    }
}

function yit_woocommerce_admin_product_ribbon_onsale() {
    wc_get_template( 'admin/custom-onsale.php' );
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

if ( ! function_exists( 'yit_add_to_cart_success_ajax' ) ) {

    function yit_add_to_cart_success_ajax( $datas ) {

        list( $cart_items, $cart_subtotal, $cart_icon, $cart_currency ) = yit_get_current_cart_info();

        $datas['.yit_cart_widget .cart_label .cart-items .yit-mini-cart-background .yit-mini-cart-icon'] = '<span class="yit-mini-cart-icon"><span class="cart-items-number">' . $cart_items . '</span></span>';
        $datas['.yit_cart_widget .cart_label .cart-items .yit-mini-cart-subtotal .amount'] = '<span class="amount">' . $cart_subtotal . '</span>';
        return $datas;
    }

    if( version_compare( preg_replace( '/-beta-([0-9]+)/', '', WC()->version ), '2.4', '<' ) ) {
        add_filter( 'add_to_cart_fragments', 'yit_add_to_cart_success_ajax' );
    }
    else {
        add_filter( 'woocommerce_add_to_cart_fragments', 'yit_add_to_cart_success_ajax' );
    }
}


if ( ! function_exists( 'yit_size_images_style' ) ) {

    function yit_size_images_style() {

        $content_width      = $GLOBALS['content_width'];
        $shop_catalog_w     = ( 100 * yit_shop_catalog_w() ) / $content_width;
        $info_product_width = 100 - $shop_catalog_w;
        ?>
        <style type="text/css">
            .woocommerce ul.products li.product.list .product-wrapper .thumb-wrapper {
                width: <?php echo $shop_catalog_w ?>%;
                height: auto;
            }
            .woocommerce ul.products li.product.list .product-wrapper .product-actions-wrapper,
            .woocommerce ul.products li.product.list .product-wrapper .product-meta,
            .woocommerce .products li.product.list .product-actions-wrapper .product-other-action {
                width: <?php echo $info_product_width -2?>%;
            }

        </style>
    <?php
    }
}

if ( ! function_exists( 'yit_wc_list_or_grid' ) ) {
    /*
     * Add list/grid switch
     */
    function yit_wc_list_or_grid() {
        wc_get_template( '/global/list-or-grid.php' );
    }
}

if ( ! function_exists( 'yit_wc_num_of_products' ) ) {
    /*
     * Custom number of products switch
     */
    function yit_wc_num_of_products() {
        wc_get_template( '/global/number-of-products.php' );
    }
}

if ( ! function_exists( 'yit_products_per_page' ) ) {
    /*
     * Custom number of product per page
     */
    function yit_products_per_page() {

        $num_prod = ( isset( $_GET['products-per-page'] ) ) ? $_GET['products-per-page'] : yit_get_option( 'shop-products-per-page' ) ;

        if ( $num_prod == 'all' ) {
            $num_prod = wp_count_posts( 'product' )->publish;
        }

        return $num_prod;
    }
}

if ( ! function_exists( 'yit_shop_page_meta' ) ) {
    /*
     * Page meta for shop page
     */
    function yit_shop_page_meta() {
        if ( is_single() ) {
            return;
        }
        wc_get_template( '/global/page-meta.php' );
    }
}

if ( ! function_exists( 'yit_wc_catalog_ordering' ) ) {

    function yit_wc_catalog_ordering() {
        if ( ! is_single() && have_posts() ) {
            woocommerce_catalog_ordering();
        }
    }
}

if( ! function_exists( 'yit_single_page_nav_links' ) ) {

    function yit_single_page_nav_links() {
        wc_get_template( 'single-product/nav-links.php' );
    }
}

if ( ! function_exists( 'yit_related_posts_per_page' ) ) {

    function yit_related_posts_per_page() {
        global $product;
        $related = $product->get_related( yit_get_option( 'shop-number-related' ) );
        return array(
            'posts_per_page'      => - 1,
            'post_type'           => 'product',
            'ignore_sticky_posts' => 1,
            'no_found_rows'       => 1,
            'post__in'            => $related
        );
    }
}

if( ! function_exists( 'yit_single_product_other_actions' ) ) {
    /*
     * Add wishlist and compare to single product page
     */
    function yit_single_product_other_actions() {
        wc_get_template( 'single-product/single-other-actions.php' );
    }
}


/* variation price format */
function wc_wc20_variation_price_format( $price, $product ) {
    // Main Price
    $prices = array( $product->get_variation_price( 'min', true ), $product->get_variation_price( 'max', true ) );
    $price  = $prices[0] !== $prices[1] ? sprintf( __( '<span class="from">From: </span>%1$s', 'yit' ), wc_price( $prices[0] ) ) : wc_price( $prices[0] );
    // Sale Price
    $prices = array( $product->get_variation_regular_price( 'min', true ), $product->get_variation_regular_price( 'max', true ) );
    sort( $prices );
    $saleprice = $prices[0] !== $prices[1] ? sprintf( __( '<span class="from">From: </span>%1$s', 'yit' ), wc_price( $prices[0] ) ) : wc_price( $prices[0] );

    if ( $price !== $saleprice ) {
        $price = '<del>' . $saleprice . '</del> <ins>' . $price . '</ins>';
    }
    return $price;
}

if( ! function_exists( 'yit_remove_reviews_tab' ) ){

    function yit_remove_reviews_tab ( $tabs ) {

        unset( $tabs[ 'reviews' ] );
        return $tabs;
    }
}

/* CUSTOM TABS */

function yit_woocommerce_add_tabs( $tabs = array() ) {

    global $post;

    $custom_tabs = yit_get_post_meta( $post->ID, '_custom_tab' );

    if ( ! empty( $custom_tabs ) ) {
        foreach ( $custom_tabs as $tab ) {

            yit_wpml_register_string( 'mindig-theme' , 'custom_tab_'.sanitize_title( $tab["name"] ) , $tab["name"] );
            $tab["name"] = yit_wpml_string_translate( 'mindig-theme' , 'custom_tab_'.sanitize_title( $tab["name"] ) , $tab["name"] );
            yit_wpml_register_string( 'mindig-theme' , 'custom_tab_'.sanitize_title( $tab["value"] ) , $tab["value"] );
            $tab["value"] = yit_wpml_string_translate( 'mindig-theme' , 'custom_tab_'.sanitize_title( $tab["value"] ) , $tab["value"] );

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

function yit_woocommerce_add_custom_panel( $key, $tab ) {
    wc_get_template( 'single-product/tabs/custom.php', array( 'key' => $key, 'tab' => $tab ) );
}

function yit_product_single_boxmeta() {
    if( ! is_product() ||  yit_get_option( 'shop-single-layout-page' ) != 'creative' || YIT_Mobile()->isMobile() ) return;

    wc_get_template( 'single-product/box-meta.php' );
}
add_action( 'yit_product_single_boxmeta', 'yit_product_single_boxmeta');

/*******************
 * MY ACCOUNT
 *******************/

function yit_add_my_account_endpoint() {
    if ( function_exists( 'WC' ) ) {
        WC()->query->query_vars['recent-downloads'] = 'recent-downloads';
        WC()->query->query_vars['myaccount-wishlist']         = 'myaccount-wishlist';
    }
}
add_action( 'after_setup_theme', 'yit_add_my_account_endpoint' );

//redirect to current wishlist page after add-to-cart
if( ! function_exists( 'yit_wcwl_add_to_cart_redirect_url' ) ) {

    function yit_wcwl_add_to_cart_redirect_url( $link ){

        return wc_get_endpoint_url( 'myaccount-wishlist', '',  get_permalink( wc_get_page_id( 'myaccount' ) ) );
    }
}
if( wc_get_endpoint_url( 'myaccount-wishlist', '',  get_permalink( wc_get_page_id( 'myaccount' ) ) ) === wp_get_referer() ) {

    add_filter( 'yit_wcwl_add_to_cart_redirect_url', 'yit_wcwl_add_to_cart_redirect_url' );
}

if ( ! function_exists( 'yit_my_account_template' ) ) {
    /**
     * Add custom template form my-account page
     *
     * @return   void
     * @since    2.0.0
     * @author   Francesco Licandro <francesco.licandro@yithemes.com>
     */
    function yit_my_account_template() {

        if ( ! function_exists( 'WC' ) || ! is_page( wc_get_page_id( 'myaccount' ) ) ) {
            return;
        }

        global $wp;

        if ( is_user_logged_in() ){

            echo '<div class="row">';

            if( ! is_rtl() ) {
                echo '<div class="col-sm-3" id="my-account-sidebar">';
                wc_get_template( '/myaccount/my-account-menu.php' );
                echo '</div>';
            }

            echo '<div class="col-sm-9" id="my-account-content">';

            wc_print_notices();

            if ( isset( $wp->query_vars['view-order'] ) && empty( $wp->query_vars['view-order'] ) ) {
                wc_get_template( 'myaccount/my-orders.php', array( 'order_count' => -1 ) );
            }
            elseif ( isset( $wp->query_vars['recent-downloads'] ) ) {
                wc_get_template( 'myaccount/my-downloads.php' );
            }
            elseif ( isset( $wp->query_vars['myaccount-wishlist'] ) ) {
                echo do_shortcode( '[yith_wcwl_wishlist]' );
            }
            else {
                yit_content_loop();
            }
            echo '</div>';

            if( is_rtl() ) {
                echo '<div class="col-sm-3" id="my-account-sidebar">';
                wc_get_template( '/myaccount/my-account-menu.php' );
                echo '</div>';
            }

            echo '</div>';

        }
        else {
            echo '<div id="my-account-content">';
            if( isset( $wp->query_vars['lost-password'] ) ) {
                WC_Shortcode_My_Account::lost_password();
            } else {
                wc_get_template( 'myaccount/form-login.php' );
            }
            echo '</div>';
        }
    }
}

if ( ! function_exists( 'yit_loading_search_icon' ) ) {

    function yit_loading_search_icon() {
        return '"' . YIT_THEME_ASSETS_URL . '/images/search.gif"';
    }
}

if ( ! function_exists( 'yit_add_inquiry_form_action' ) ) {
    /**
     * Add meta for inquiry form in edit product
     *
     */
    function yit_add_inquiry_form_action(){

        if( ! function_exists('YIT_Contact_Form') ){
            return;
        }
        $args = array(
            'info_form' => array(
                'label' => __( 'Show inquiry form?', 'yit' ),
                'desc'  => __( 'Set YES if you want a section with the inquiry form. Set options in Theme Options->Shop->Single Product Page', 'yit' ),
                'type'  => 'onoff',
                'std'   => 'no',
            )
        );
        $meta_prod = YIT_Metabox( 'yit-product-setting' );
        $meta_prod->add_field( 'settings', $args, 'before', 'modal_window' );
    }
}

add_action( 'after_setup_theme', 'yit_add_inquiry_form_action', 40 );

if ( ! function_exists( 'yit_woocommerce_add_inquiry_form' ) ) {
    /**
     * Get Template for inquiry form
     */
    function yit_woocommerce_add_inquiry_form() {
        wc_get_template( 'single-product/inquiry-form.php' );
    }
}

if ( ! function_exists( 'yit_product_modal_window' ) ){
    /**
     * Get template for modal in single product page
     */
    function yit_product_modal_window(){
        wc_get_template( 'single-product/modal-window.php');
    }
}

if ( ! function_exists( 'yit_pagination_shop_args' ) ) {
    /**
     * Custom pagination for shop page
     *
     * @return array
     * @since 1.0.0
     */
    function yit_pagination_shop_args(){

        global $wp_query;

        $args = array(
            'base'         => str_replace( 999999999, '%#%', get_pagenum_link( 999999999 ) ),
            'format'       => '',
            'current'      => max( 1, yit_get_post_current_page() ),
            'total'        => $wp_query->max_num_pages,
            'type'         => 'list',
            'prev_next'    => true,
            'prev_text' => __('&lt;&lt; PREV', 'yit'),
            'next_text' => __('NEXT &gt;&gt;', 'yit'),
            'end_size'     => 3,
            'mid_size'     => 3,
            'add_fragment' => '',
            'before_page_number' => '',
            'after_page_number' => ' /'
        );

        return $args;
    }
}

/*===== VAT SSN FIELDS =====*/

function yit_woocommerce_add_billing_ssn_vat( $fields ) {
    $fields['billing_vat'] = array(
        'label'       => apply_filters( 'yit_vat_label', __( 'VAT', 'yit' ) ),
        'placeholder' => '',
        'required'    => false,
        'class'       => array( 'form-row-first' ),
        'clear'       => false
    );

    $fields['billing_ssn'] = array(
        'label'       => apply_filters( 'yit_ssn_label', __( 'SSN', 'yit' ) ),
        'placeholder' => '',
        'required'    => false,
        'class'       => array( 'form-row-last' ),
        'clear'       => true
    );

    return $fields;
}
function yit_woocommerce_add_shipping_ssn_vat( $fields ) {
    $fields['shipping_vat'] = array(
        'label'       => apply_filters( 'yit_vat_label', __( 'VAT', 'yit' ) ),
        'placeholder' => '',
        'required'    => false,
        'class'       => array( 'form-row-first' ),
        'clear'       => false
    );

    $fields['shipping_ssn'] = array(
        'label'       => apply_filters( 'yit_ssn_label', __( 'SSN', 'yit' ) ),
        'placeholder' => '',
        'required'    => false,
        'class'       => array( 'form-row-last' ),
        'clear'       => true
    );

    return $fields;
}
function woocommerce_add_billing_shipping_fields_admin( $fields ) {
    $fields['vat'] = array(
        'label' => apply_filters( 'yit_vatssn_label', __( 'VAT', 'yit' ) )
    );
    $fields['ssn'] = array(
        'label' => apply_filters( 'yit_ssn_label', __( 'SSN', 'yit' ) )
    );

    return $fields;
}
function yit_woocommerce_add_billing_vat( $fields ) {
    $fields['billing_vat'] = array(
        'label'       => apply_filters( 'yit_vatssn_label', __( 'VAT / SSN', 'yit' ) ),
        'placeholder' => '',
        'required'    => false,
        'class'       => array( 'form-row-wide' ),
        'clear'       => true
    );

    return $fields;
}
function yit_woocommerce_add_shipping_vat( $fields ) {
    $fields['shipping_vat'] = array(
        'label'       => apply_filters( 'yit_vatssn_label', __( 'VAT / SSN', 'yit' ) ),
        'placeholder' => '',
        'required'    => false,
        'class'       => array( 'form-row-wide' ),
        'clear'       => true
    );

    return $fields;
}
function woocommerce_add_billing_shipping_vat_admin( $fields ) {
    $fields['vat'] = array(
        'label' => apply_filters( 'yit_vatssn_label', __( 'VAT/SSN', 'yit' ) )
    );

    return $fields;
}
function woocommerce_add_var_load_order_data_vat( $fields ) {
    $fields['billing_vat']  = '';
    $fields['shipping_vat'] = '';
    return $fields;
}
function yit_woocommerce_add_billing_ssn( $fields ) {
    $fields['billing_ssn'] = array(
        'label'       => apply_filters( 'yit_ssn_label', __( 'SSN', 'yit' ) ),
        'placeholder' => '',
        'required'    => false,
        'class'       => array( 'form-row-wide' ),
        'clear'       => true
    );

    return $fields;
}

function yit_woocommerce_add_shipping_ssn( $fields ) {
    $fields['shipping_ssn'] = array(
        'label'       => apply_filters( 'yit_ssn_label', __( 'SSN', 'yit' ) ),
        'placeholder' => '',
        'required'    => false,
        'class'       => array( 'form-row-wide' ),
        'clear'       => true
    );

    return $fields;
}
function woocommerce_add_billing_shipping_ssn_fields_admin( $fields ) {
    $fields['ssn'] = array(
        'label' => apply_filters( 'yit_ssn_label', __( 'SSN', 'yit' ) )
    );

    return $fields;
}
function woocommerce_add_var_load_order_data_ssn( $fields ) {
    $fields['billing_ssn']  = '';
    $fields['shipping_ssn'] = '';
    return $fields;
}

// SET LAYOUT FOR SHOP PAGE

function yit_sidebar_shop_page( $value, $key, $id ) {

    $new_layout = ( isset( $_GET['layout-shop'] ) ) ? $_GET['layout-shop'] : '';

    if( isset( $value['layout'] ) && $new_layout != '' && $key == 'sidebars' ) {

        $value['layout'] = $new_layout;

        if( $value['sidebar-left'] == -1 ){
            $value['sidebar-left'] = $value['sidebar-right'];
        }
        elseif( $value['sidebar-right'] == -1 ){
            $value['sidebar-right'] = $value['sidebar-left'];
        }
    }

    return $value;
}
add_filter( 'yit_get_option_layout', 'yit_sidebar_shop_page', 10, 3 );

remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );

add_action( 'yith_before_shop_page_meta', 'woocommerce_taxonomy_archive_description', 10 );


// add image for product category page

function woocommerce_taxonomy_archive_description() {

    if ( is_tax( array( 'product_cat', 'product_tag' ) ) && get_query_var( 'paged' ) == 0 ) {

        global $wp_query;

        $cat          = $wp_query->get_queried_object();
        $thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
        $image        = wp_get_attachment_image_src( $thumbnail_id, 'full' );

        $description = apply_filters( 'the_content', term_description() );

        if ( $image && yit_get_option( 'shop-category-show-page-image' ) == 'yes' ) {
            echo '<div class="term-header-image"><img src="' . $image[0] . '" width="' . $image[1] . '" height="' . $image[1] . '" alt="' . $cat->name . '" /></div>';
        }

        if ( $description && yit_get_option( 'shop-category-show-page-description' ) == 'yes' ) {
            echo '<div class="term-description">' . $description . '</div>';
        }
    }
}



if ( ! function_exists( 'yit_image_content_single_width' ) ) {
    /**
     * Set image and content width for single product image
     *
     * @return array
     * @since 1.0.0
     * @author Francesco Licando <francesco.licandro@yithemes.it>
     */
    function yit_image_content_single_width() {

        $img_size = wc_get_image_size( 'shop_single' );
        $sidebars = yit_get_sidebars();
        $mobile   = is_quick_view() ? false : YIT_Mobile()->isMobile() ;

        $size = array();

        if ( intval( $img_size['width'] ) < $GLOBALS['content_width'] ) {

            $size['image'] = ( intval( $img_size['width'] ) * 100 ) / $GLOBALS['content_width'];

            if ( yit_get_option( 'shop-single-layout-page' ) === 'creative' && $sidebars['layout'] === 'sidebar-no' && ! $mobile ) {
                $size['image'] += 15;
            }
        }
        else {
            $size['image'] = 100;
        }

        $size['content'] = 100 - ( $size['image'] );

        if ( $size['content'] < 20 ) {
            $size['content'] = 100;
        }

        return $size;

    }
}

function yit_remove_unused_wishlist_options( $options ){
    unset( $options['general_settings'][5] );

    return $options;
}
add_filter( 'yith_wcwl_tab_options', 'yit_remove_unused_wishlist_options' );

function yit_remove_unused_woocompare_options( $options ){
    unset( $options['general'][3] );
    unset( $options['general'][4] );

    return $options;
}
add_filter( 'yith_woocompare_tab_options', 'yit_remove_unused_woocompare_options' );


/* CHECK IF IS PRODUCT QUICK VIEW */

function is_quick_view() {
    return ( defined('DOING_AJAX') && DOING_AJAX && isset( $_REQUEST['action'] ) && $_REQUEST['action'] == 'yit_load_product_quick_view' ) ? true : false;
}

/* QUICK VIEW */

function yit_woocommerce_quick_view() {

    if ( ! function_exists('WC') || 'no' == yit_get_option('shop-quick-view-enable') ) {
        return false;
    }

    wp_enqueue_script( 'wc-add-to-cart-variation' );
    wp_enqueue_style( 'yith_wccl_frontend' );

    // change position of woocommerce.js
    $queue = $GLOBALS['wp_scripts']->queue;
    $k = array_search( 'yit_woocommerce', $queue );
    $queue[] = $queue[ $k ];
    unset( $queue[ $k ] );
    $GLOBALS['wp_scripts']->queue = array_values( $queue );

    $registered = $GLOBALS['wp_scripts']->registered;

    wp_localize_script( 'yit_woocommerce', 'yit_quick_view', array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'loading' => __( 'Loading', 'yit' ),
        'assets' => array(
            $registered['wc-add-to-cart-variation']->src,
            isset( $registered['yith_wccl_frontend'] ) ? $registered['yith_wccl_frontend']->src : false
        ) ,
    ) );

    return true;
}


function yit_load_product_quick_view_ajax() {

    if ( ! isset( $_REQUEST['item_id'] ) ) {
        die();
    }

    $product_id = intval( $_REQUEST['item_id'] );

    // set the main wp query for the product
    wp( 'p=' . $product_id . '&post_type=product' );

    // remove parts from single product page
    remove_action( 'woocommerce_before_single_product', 'yit_single_page_nav_links' );

    remove_action( 'woocommerce_single_product_summary', 'yit_product_modal_window', 25 );
    remove_action( 'woocommerce_single_product_summary', 'yit_woocommerce_add_inquiry_form', 32 );
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta',    40 );
    remove_action( 'woocommerce_single_product_summary', 'yit_shop_wishlist_action', 45 );

    remove_all_actions( 'woocommerce_after_single_product_summary' );

    // change template for variable products
    if ( isset( $GLOBALS['yith_wccl'] ) ) {
        $GLOBALS['yith_wccl']->obj = new YITH_WCCL_Frontend( YITH_WCCL_VERSION );
        $GLOBALS['yith_wccl']->obj->override();
    }

    //wp_head();

    while ( have_posts() ) : the_post(); ?>

        <div class="single-product woocommerce">

            <?php wc_get_template_part( 'content', 'single-product' ); ?>

        </div>

    <?php endwhile; // end of the loop.

    //wp_footer();

    die();
}
add_action( 'wp_ajax_yit_load_product_quick_view', 'yit_load_product_quick_view_ajax' );
add_action( 'wp_ajax_nopriv_yit_load_product_quick_view', 'yit_load_product_quick_view_ajax' );


/* IMAGE PRODUCT SLIDER IN QUICK VIEW */

function yit_product_image_slider_quick_view() {

    global $post, $product;

    echo '<div class="slider-quick-view-container"><div class="slider-quick-view">';

    $image = get_the_post_thumbnail( $post->ID, 'shop_single' );

    $attachments = $product->get_gallery_attachment_ids();

    echo $image;

    foreach ( $attachments as $attachment ) {
        echo wp_get_attachment_image( $attachment, 'shop_single' );
    }

    echo '</div>';

    if ( ! empty( $attachments ) ) {
        echo '<div class="es-nav">';
        echo '<div class="es-nav-prev fa fa-chevron-left"></div>';
        echo '<div class="es-nav-next fa fa-chevron-right"></div>';
        echo '</div>';
    }

    echo '</div>';
}


if( ! function_exists( 'yit_woocommerce_show_review' ) ) {
    /**
     * hide or show reviews
     *
     * @param string $open the product
     *
     * @param string $post_id the post ID
     *
     * @return bool
     * @since  2.0.0
     * @author Emanuela Castorina <emanuela.castorina@yithemes.com>
     */
    function yit_woocommerce_show_review( $open, $post_id ) {
        $post = get_post( $post_id );
        if ( $post->post_type != 'product' ) {
            return $open;
        }
        else {
            if(isset($post)) {
                $open = $post->comment_status;
            }
            else if ( ! isset( $post_id ) ) {
                global $product;
                $open = get_post( $product->id )->comment_status;
            }
        }
        return ( yit_get_option( 'shop-remove-reviews' ) == 'no' ) ? ( 'open' == $open ) : false;
    }
}

if( ! function_exists( 'yit_woocommerce_object' ) ) {

    function yit_woocommerce_object() {

        wp_localize_script( 'jquery', 'yit_woocommerce', array(
            'version' => WC()->version,
            'yit_product_slider_col_0' => apply_filters( 'yit_product_slider_col_0' , 1 ),
            'product_slider_col_479' =>  apply_filters( 'yit_product_slider_col_479' , 3 ),
            'product_slider_col_767' => apply_filters( 'yit_product_slider_col_767' , 4 ),
        ));

    }

}

function yit_check_single_product_layout() {

    $is_quick_view = is_quick_view();

    if ( yit_get_option( 'shop-single-layout-page' ) == 'creative' && !$is_quick_view && !YIT_Mobile()->isMobile()) {

        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );

        /* fix yith catalog mode */
        $ywctm_hide_add_to_cart_single = false;
        $ywctm_hide_price              = false;
        global $YITH_WC_Catalog_Mode;
        if ( isset( $YITH_WC_Catalog_Mode ) ) {
            $ywctm_hide_price              = method_exists( $YITH_WC_Catalog_Mode, 'check_product_price_single' ) && $YITH_WC_Catalog_Mode->check_product_price_single();
            $ywctm_hide_add_to_cart_single = method_exists( $YITH_WC_Catalog_Mode, 'check_add_to_cart_single' ) && $YITH_WC_Catalog_Mode->check_add_to_cart_single();
        }

        if ( yit_get_option('shop-enable') == 'yes' && yit_get_option('shop-single-product-price') == 'yes' && !$ywctm_hide_price ) add_action( 'yit_product_box', 'woocommerce_template_single_price', 10 );
        if ( yit_get_option('shop-enable') == 'yes' && yit_get_option('shop-single-add-to-cart') == 'yes' && !$ywctm_hide_add_to_cart_single ) add_action( 'yit_product_box', 'woocommerce_template_single_add_to_cart', 20 );
        add_action( 'yit_product_box', 'yit_woocommerce_add_inquiry_form', 30 );
        add_action( 'yit_product_box', 'yit_single_product_other_actions', 40 );
    }
    else {

        if ( yit_get_option('shop-enable') == 'no' || yit_get_option('shop-single-product-price') == 'no' ) remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
        if ( yit_get_option('shop-enable') == 'no' || yit_get_option('shop-single-add-to-cart') == 'no' ) remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );

        if(!$is_quick_view) {
            add_action( 'woocommerce_single_product_summary', 'yit_woocommerce_add_inquiry_form', 32 );
        }

        add_action( 'woocommerce_single_product_summary', 'yit_single_product_other_actions', 35 );
    }
}

    add_action( 'yit_check_single_product_layout', 'yit_check_single_product_layout' );

if ( ! function_exists( 'yit_woocommerce_account_menu_items' ) ) {
    /**
     * @author Andrea Frascaspata
     */
    function yit_woocommerce_account_menu_items( $menu_list ) {

        unset( $menu_list['customer-logout'] );

        $menu_list['orders']       = __( 'My Orders', 'yit' );
        $menu_list['downloads']    = __( 'My Downloads', 'yit' );
        $menu_list['edit-address'] = __( 'Edit Address', 'yit' );
        $menu_list['edit-account'] = __( 'Edit Account', 'yit' );

        if ( defined( 'YITH_WCWL' ) ) {
            $menu_list['myaccount-wishlist'] = __( 'My Wishlist', 'yit' );
        }


        return $menu_list;

    }
}

if ( ! function_exists( 'yit_get_myaccount_menu_icon' ) ) {

    /**
     * @param $endpoint
     * @return mixed|string
     * @author Andrea Frascaspata
     */
    function yit_get_myaccount_menu_icon( $endpoint ) {

        $icon_list = apply_filters( 'yit_get_myaccount_menu_icon_list_fa' , array(
                'dashboard'       => 'fa-book',
                'orders'          => 'fa-folder-open',
                'downloads'       => 'fa-download',
                'edit-address'    => 'fa-pencil-square-o',
                'payment-methods' => 'fa-credit-card',
                'edit-account'    => 'fa-pencil-square-o',
                'myaccount-wishlist'    => 'fa-heart-o', )
        );

        if( isset( $icon_list[ $endpoint ] ) ) {
            return $icon_list[ $endpoint ];
        } else {
            return '';
        }

    }

}


if ( ! function_exists( 'yit_wc_product_post_class' ) ) {
    /**
     * @param        $classes
     * @param string $class
     * @param string $post_id
     *
     * @return array
     */
    function yit_wc_product_post_class( $classes, $class = '', $post_id = '' ) {

        if ( !$post_id || 'product' !== get_post_type( $post_id ) ) {
            return $classes;
        }

        $product = wc_get_product( $post_id );

        if ( $product ) {

            global $woocommerce_loop;

            // Extra post classes

            if ( ( !isset( $woocommerce_loop['name'] ) || empty( $woocommerce_loop['name'] ) ) && !isset( $woocommerce_loop['view'] ) ) {
                return $classes;
            }

            // check if is mobile
            $isMobile = YIT_Mobile()->isMobile();

            if ( !isset( $woocommerce_loop['view'] ) ) {
                $woocommerce_loop['view'] = yit_get_option( 'shop-view-type', 'grid' );
            }

            $classes[] = $woocommerce_loop['view'];

            // Set column
            if ( ( is_shop() || is_product_category() || is_product_taxonomy() ) && ! $isMobile ) {
                $classes[] = 'col-sm-' . intval( 12/ intval( yit_get_option( 'shop-num-column' ) ) );
                $woocommerce_loop['columns'] = intval( yit_get_option( 'shop-num-column' ) );
            }
            else if ( isset( $woocommerce_loop['product_in_a_row'] ) ){
                $product_in_a_row =  $woocommerce_loop['product_in_a_row'];
                $classes[] = 'col-sm-' . intval( 12 / intval( $product_in_a_row ) ) . ' col-xs-6';
                $woocommerce_loop['columns']    = intval( $product_in_a_row );
            }
            else {

                $sidebar = yit_get_sidebars();

                if ( $sidebar['layout'] == 'sidebar-double' ) {
                    $classes[] = 'col-sm-6 col-xs-6';
                    $woocommerce_loop['columns']    = '2';
                }
                elseif ( $sidebar['layout'] == 'sidebar-right' || $sidebar['layout'] == 'sidebar-left' ) {
                    $classes[] = 'col-sm-4 col-xs-6';
                    $woocommerce_loop['columns']    = '3';
                }
                else {
                    $classes[] = 'col-sm-3 col-xs-6';
                    $woocommerce_loop['columns']    = '4';
                }
            }

        }

        return $classes;

    }
    
}


if ( ! function_exists( 'yit_wc_product_product_cat_class' ) ) {

    /**
     * @param $classes
     * @param $class
     * @param $category
     *
     * @return array
     */
    function yit_wc_product_product_cat_class( $classes, $class, $category ) {

        global  $woocommerce_loop;

        //standard li class
        $classes[] = 'product-category product';

        $sidebar = yit_get_sidebars();

        if ( isset( $woocommerce_loop['product_in_a_row'] ) ){
            $product_in_a_row = $woocommerce_loop['product_in_a_row'];
            $classes[] = 'col-sm-' . intval( 12 / intval( $product_in_a_row ) ) . ' col-xs-4';
            $woocommerce_loop['columns']    = intval( $product_in_a_row );
        }
        else if ( $sidebar['layout'] == 'sidebar-double' ) {
            $classes[] = 'col-sm-6';
            $woocommerce_loop['columns']    = '2';
        }
        elseif ( $sidebar['layout'] == 'sidebar-right' || $sidebar['layout'] == 'sidebar-left' ) {
            $classes[] = 'col-sm-4';
            $woocommerce_loop['columns']    = '3';
        }
        else {
            $classes[] = 'col-sm-3';
            $woocommerce_loop['columns']    = '4';
        }

        return $classes;

    }

}


/**
 * @param $comment
 * author Andrea Frascaspata
 */
function yit_woocommerce_review_display_meta( $comment ) {

    $rating = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) );

    ?>

    <div class="woocommerce-product-rating" itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating" title="<?php echo sprintf( __( 'Rated %d out of 5', 'yit' ), $rating ) ?>">
        <div class="star-rating">
            <span style="width:<?php echo ( ( $rating / 5 ) * 100 ) ?>%"></span>
        </div>
        <meta itemprop="ratingValue" content="<?php echo $rating; ?>" />
    </div>

    <?php

}

/**
 * @author Andre Frascaspata
 */
function yit_wc_2_6_removed_unused_template () {

    if( function_exists( 'yit_remove_unused_template' ) ) {

        $option = 'yit_wc_2_6_3_template_remove';

        $files = array( 'checkout/form-shipping.php'  , 'myaccount/form-login.php' , 'myaccount/my-account.php' , 'myaccount/my-account-menu.php', 'single-product/review.php' , 'single-product/share.php' );

        yit_remove_unused_template( 'woocommerce' , $option , $files );

    }

}


/* === PLUGIN SUPPORT === */


if ( ! function_exists( 'yit_plugins_support' ) ) {
    /**
     * YITH Plugins support
     *
     * @return string
     * @since 1.0
     */
    function yit_plugins_support() {

        /* YITH WOOCOMMERCE ADVANCED REVIEWS */

        if( defined('YITH_YWAR_PREMIUM') ) {

            add_filter( 'yith_advanced_reviews_loader_gif', 'yit_loading_search_icon' );

            add_filter( 'yith_advanced_reviews_review_content_elements', 'yith_ywar_change_review_content_elements' , 10 , 6 );


            function yith_ywar_change_review_content_elements( $review_content, $review_title, $review_post_content, $thumbnail_div, $div_yes_not, $actions_section ) {
                return  $thumbnail_div . $div_yes_not . $actions_section;
            }
        } else if( defined( 'YITH_YWAR_VERSION' ) ) {

            add_filter( 'yith_advanced_reviews_review_content_elements', 'yith_ywar_change_review_content_elements' , 10 , 4 );


            function yith_ywar_change_review_content_elements( $review_content, $review_title, $review_post_content, $thumbnail_div ) {
                return  $thumbnail_div ;
            }

        }

        /* FIX WPML ENDPOINT*/

        function yit_wpml_endpoint_hack_for_after() {
            global $yit_wpml_hack_endpoint;
            $yit_wpml_hack_endpoint = WC()->query->query_vars;
            // add the options
            foreach ( $yit_wpml_hack_endpoint as $endpoint => $value ) {
                add_option( 'woocommerce_myaccount_'.$endpoint.'_endpoint', $value );
            }
        }
        add_action( 'after_setup_theme', 'yit_wpml_endpoint_hack_for_after', 11 );

        function yit_wpml_my_account_endpoint() {
            global $woocommerce_wpml, $yit_wpml_hack_endpoint;

            if ( ! isset( $woocommerce_wpml->endpoints ) ) {
                return;
            }

            $endpoints = array(
                'recent-downloads',
                'myaccount-wishlist',
            );

            $wc_vars = WC()->query->query_vars;

            foreach ( $endpoints as $endpoint ) {
                if ( ! isset( $yit_wpml_hack_endpoint[ $endpoint ] ) ) {
                    return;
                }

                $wc_vars_endpoint = isset( $wc_vars[ $endpoint ] ) ? $wc_vars[ $endpoint ] : $endpoint;
                WC()->query->query_vars[$endpoint] = $woocommerce_wpml->endpoints->get_endpoint_translation( $yit_wpml_hack_endpoint[$endpoint] , $wc_vars_endpoint );
            }

            unset( $yit_wpml_hack_endpoint );
        }

        add_action( 'init', 'yit_wpml_my_account_endpoint', 3 );

        /* ===== MULTI VENDOR ====== */

        if ( function_exists( 'YITH_Vendors' ) ) {

            if( ! function_exists( 'yit_contact_form_to_vendor' ) ) {
                function yit_contact_form_to_vendor( $to ){
                    $vendor_email = false;
                    if( ! empty( $_POST['yit_contact']['product_id'] ) && yit_get_option( 'send-email-to-vendor' ) == 'yes' ){
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

        /* =============================' */

        /* ===== WISHLIST ====== */

        if( defined( 'YITH_WCWL' ) ) {

            add_action( 'woocommerce_account_myaccount-wishlist_endpoint' , 'yit_wishlist_content' );

            function yit_wishlist_content() {
                echo do_shortcode( '[yith_wcwl_wishlist]' );
            }

        }

        /* ===================== */
    }

}

/**
 * @author Andrea Frascaspata
 */
function yit_theme_woocommerce_share() {

    if ( yit_get_option('shop-single-share') == 'yes' ) {

        echo '<div class="product-share"><span>'. __( "Share on: ","yit"). '</span>';
        yit_get_social_share( 'text' );
        echo '</div><div class="clearfix"></div>';
    }

}