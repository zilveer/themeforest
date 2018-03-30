<?php
/**
 * All functions and hooks for jigoshop plugin
 *
 * @package WordPress
 * @subpackage YIW Themes
 * @since 1.4
 */

// global flag to know that woocommerce is active
$yiw_is_woocommerce = true;

/* fix 2.1 */
global $woo_shop_folder;

if ( ! defined( 'YIT_DEBUG' ) || ! YIT_DEBUG ) {
    $message = get_option( 'woocommerce_admin_notices', array() );
    $message = array_diff( $message, array( 'template_files' ));
    update_option( 'woocommerce_admin_notices', $message );
}

if ( version_compare( $woocommerce->version, '2.1', '<' ) ) {
    add_filter( 'woocommerce_template_url', create_function( "", "return 'woocommerce_2.0.x/';" ) );
    add_action( 'wp_enqueue_scripts', 'yit_enqueue_woocommerce_styles', 11 );
    //add_action( 'woocommerce_single_product_summary', 'yit_rating_singleproduct', 10 );
    $woo_shop_folder = 'shop';

    // price filter
    global $woocommerce;
    if(version_compare( $woocommerce->version, '2.0.0' ) < 0 ) add_action('init', 'woocommerce_price_filter_init');
    add_filter('loop_shop_post_in', 'woocommerce_price_filter');
}
else {

    /* woocommerce 2.1.x */
    if ( version_compare( preg_replace( '/-beta-([0-9]+)/', '', $woocommerce->version ), '2.2', '<' ) ) {
        add_filter( 'WC_TEMPLATE_PATH', create_function( '', "return 'woocommerce_2.1.x/';" ) );
    }/* woocommerce 2.2.x */
    else if ( version_compare( preg_replace( '/-beta-([0-9]+)/', '', $woocommerce->version ), '2.3', '<' ) ) {
        add_filter( 'woocommerce_template_path', create_function( '', "return 'woocommerce_2.2.x/';" ) );
    }/* woocommerce 2.3.x and grather */
    else {
        add_action( 'wp_enqueue_scripts', 'yiw_enqueue_woocommerce_assets' );

        if ( version_compare( $woocommerce->version , '2.4', '<' ) ) {
            add_filter( 'woocommerce_template_path', create_function( '', "return 'woocommerce_2.3.x/';" ) );
        } else if ( version_compare( $woocommerce->version , '2.5', '<' ) ) {
            add_filter( 'woocommerce_template_path', create_function( '', "return 'woocommerce_2.4.x/';" ) );
        } else if ( version_compare( $woocommerce->version , '2.5', '<' ) ) {
            add_filter( 'woocommerce_template_path', create_function( '', "return 'woocommerce_2.4.x/';" ) );
        }  else if ( version_compare( $woocommerce->version , '2.6', '<' ) ) {
            add_filter( 'woocommerce_template_path', create_function( '', "return 'woocommerce_2.5.x/';" ) );
        } else {   // wc 2.6

            add_filter( 'post_class', 'yiw_wc_product_post_class', 30, 3 );


            yiw_wc_2_6_removed_unused_template();

        }
        
    }

    add_filter( 'woocommerce_enqueue_styles', 'yit_enqueue_wc_styles' );
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
    $woo_shop_folder = 'global';
    add_action( 'admin_init', 'yit_check_version', 8 );

    // price filter
    if ( ! is_active_widget( false, false, 'woocommerce_price_filter', true ) && version_compare( $woocommerce->version , '2.6', '<' ) ) {
        add_filter( 'loop_shop_post_in', array( WC()->query, 'price_filter' ) );
    }
}

/** 2.5 action */
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );

add_action( 'woocommerce_shop_loop_item_title', 'yiw_shop_page_product_title', 10 );


/********
 * SHOP PAGE
 **********/

if ( !function_exists( 'yiw_shop_page_product_title' ) ) {
    /**
     * Add product title to main shop page
     *
     * @return void
     * @since  1.0.0
     * @author Andrea Frascaspata <andrea.frascaspata@yithemes.com>
     */
    function yiw_shop_page_product_title() {

        if ( yiw_get_option( 'shop_show_name' ) ) {

            global $woocommerce_loop;
            if ( isset( $woocommerce_loop['style'] ) )
                $style = $woocommerce_loop['style'];
            else
                $style = yiw_get_option( 'shop_products_style', 'ribbon' );

            $title_position = yiw_get_option( 'shop_title_position' );
            if ( $style == 'ribbon' )
                $title_position = 'below-thumb';

            echo '<strong class="'.$title_position.'">'.get_the_title().'</strong>';

        }
    }

}

/**
 * For WooCommerce 2.5.x
 */
if( ! function_exists('yiw_woocommerce_shop_loop_subcategory_title') ) {

    function yiw_woocommerce_shop_loop_subcategory_title( $category ) {

        ?>
        <h3 class="<?php echo yiw_get_option('shop_title_position_categories_page') ?>">
            <?php echo $category->name; ?>
            <?php if ( $category->count > 0 ) : ?>
                <?php echo apply_filters( 'woocommerce_subcategory_count_html', ' <mark class="count">(' . $category->count . ')</mark>', $category ); ?>
            <?php endif; ?>
        </h3>
    <?php
    }

    remove_action( 'woocommerce_shop_loop_subcategory_title', 'woocommerce_template_loop_category_title', 10 );
    add_action( 'woocommerce_shop_loop_subcategory_title' , 'yiw_woocommerce_shop_loop_subcategory_title' , 10 , 2 );

}

function yit_check_version() {
    if ( get_option( 'yit_theme_version_2.4.0' ) || ! isset( $_GET['do_update_woocommerce'] ) ) {
        return;
    }
    clear_menu_from_old_woo_pages();
    update_option( 'yit_theme_version_2.4.0', true );
}

function clear_menu_from_old_woo_pages() {
    $locations = get_nav_menu_locations();
    $logout    = get_page_by_path( 'my-account/logout' );
    $parent    = get_page_by_path( 'my-account' );
    $permalink = get_option( 'permalink_structure' );

    $pages_deleted = array(
        intval( get_option( 'woocommerce_pay_page_id' ) ),
        intval( get_option( 'woocommerce_thanks_page_id' ) ),
        intval( get_option( 'woocommerce_view_order_page_id' ) ),
        intval( get_option( 'woocommerce_view_order_page_id' ) ),
        intval( get_option( 'woocommerce_change_password_page_id' ) ),
        intval( get_option( 'woocommerce_edit_address_page_id' ) ),
        intval( get_option( 'woocommerce_lost_password_page_id' ) )
    );

    foreach ( (array) $locations as $name => $menu_ID ) {
        $items = wp_get_nav_menu_items( $menu_ID );
        foreach ( (array) $items as $item ) {

            if ( ! is_null( $logout ) && ! is_null( $parent ) && $item->object_id == $logout->ID ) {
                update_post_meta( $item->ID, '_menu_item_object', 'custom' );
                update_post_meta( $item->ID, '_menu_item_type', 'custom' );
                if ( $permalink == '' ) {
                    $new_url = get_permalink( $parent->ID ) . '&customer-logout';
                }
                else {
                    wp_update_post( array(
                            'ID'        => $logout->ID,
                            'post_name' => 'customer-logout', )
                    );
                    $new_url = get_permalink( $logout->ID );
                }
                update_post_meta( $item->ID, '_menu_item_url', $new_url );
                wp_update_post( array(
                        'ID'         => $item->ID,
                        'post_title' => $logout->post_title, )
                );
            }

            if ( in_array( $item->object_id, $pages_deleted ) && $item->object == 'page' ) {

                wp_delete_post( $item->ID );

            }
        }

    }
}

/* end fix 2.1 */

include 'shortcodes-woocommerce.php';

remove_action( 'woocommerce_pagination', 'woocommerce_catalog_ordering', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
function yiw_woocommerce_ordering() {
    if ( ! is_single() && yiw_get_option( 'shop_show_woocommerce_ordering' ) ) woocommerce_catalog_ordering();

}
add_action( 'woocommerce_before_main_content' , 'yiw_woocommerce_ordering' );

// Add woocommerce support
add_theme_support('woocommerce');

// add the sale icon inside the product detail image container
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);
add_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_sale_flash');

// add body class
add_filter( 'body_class', create_function( '$classes', '$classes[] = "shop-".yiw_get_option( "shop_products_style", "ribbon" ); return $classes;' ) );

// remove the add to cart option
function yiw_remove_add_to_cart() {
    if ( yiw_get_option('shop_show_button_add_to_cart_single_page') ) return;
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
}
add_action('init', 'yiw_remove_add_to_cart');

// remove the add to cart option
function yiw_add_category_item_class($classes) {
    $classes[] = 'category';

    return $classes;
}
add_action('product_cat_class', 'yiw_add_category_item_class');

// since woocommerce 1.6 - add the style to <ul> products list
function yiw_add_style_products_list( $content ) {
    return str_replace( '<ul class="products">', '<ul class="products ' . yiw_get_option( 'shop_products_style', 'ribbon' ) . '">', $content );
}
add_filter( 'the_content', 'yiw_add_style_products_list', 99 );

//add image size for the product categories in woocommerce api
//add_filter( 'woocommerce_get_image_size_shop_category_image_width',  create_function( '', 'return get_option("woocommerce_category_image_width");' ) );

if ( version_compare( preg_replace( '/-beta-([0-9]+)/', '', $woocommerce->version ), '2.1', '<=' ) ) {
    add_filter( 'woocommerce_get_image_size_shop_category', 'yiw_shop_category_image' );
}
else {
    if ( ! has_action( 'woocommerce_admin_field_yit_wc_image_width' ) ) {
        add_action( 'woocommerce_admin_field_yit_wc_image_width', 'admin_fields_yit_wc_image_width' );
    }
}

function yiw_shop_category_image( $size ) {
    return yiw_get_option_size( 'shop_category_image_size' );
}

function yiw_set_posts_per_page( $cols ) {
    $items = yiw_get_option( 'shop_products_per_page', $cols );
    return $items == 0 ? -1 : $items;
}
add_filter('loop_shop_per_page', 'yiw_set_posts_per_page');

function yiw_add_style_woocommerce() {
    global $pagenow;
    if( $pagenow != 'widgets.php' ) {
        wp_enqueue_style( 'jquery-ui-style', (is_ssl()) ? 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css' : 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css' );
    }
}
add_action( 'init', 'yiw_add_style_woocommerce' );

function yiw_add_to_cart_success_ajax( $datas ) {
    global $woocommerce;


    // quantity
    $qty = 0;
    if (sizeof($woocommerce->cart->get_cart())>0) : foreach ($woocommerce->cart->get_cart() as $item_id => $values) :

        $qty += $values['quantity'];

    endforeach; endif;

    ob_start();
    echo '<ul class="cart_list product_list_widget hide_cart_widget_if_empty">';
    if (sizeof($woocommerce->cart->get_cart())>0) :
        foreach ($woocommerce->cart->get_cart() as $cart_item_key => $cart_item) :
            $_product = $cart_item['data'];
            if ($_product->exists() && $cart_item['quantity']>0) :
                echo '<li><a href="'.get_permalink($cart_item['product_id']).'">';

                echo $_product->get_image();

                echo apply_filters('woocommerce_cart_widget_product_title', $_product->get_title(), $_product).'</a>';

                echo $woocommerce->cart->get_item_data( $cart_item );

                echo '<span class="quantity">' .$cart_item['quantity'].' &times; '.apply_filters('woocommerce_cart_item_price_html', woocommerce_price( $_product->price ), $values, $cart_item_key ).'</span></li>';
            endif;
        endforeach;
    else:
        echo '<li class="empty">'.__('No products in the cart.', 'yiw' ).'</li>';
    endif;
    echo '</ul>';
    if ($qty == 1) :

        $get_checkout_url = function_exists('wc_get_checkout_url') ? wc_get_checkout_url() : $woocommerce->cart->get_checkout_url();

        echo '<p class="total"><strong>' . __('Subtotal', 'yiw' ) . ':</strong> '. $woocommerce->cart->get_cart_total() . '</p>';

        do_action( 'woocommerce_widget_shopping_cart_before_buttons' );

        echo '<p class="buttons"><a href="'.$woocommerce->cart->get_cart_url().'" class="button">'.__('View Cart &rarr;', 'yiw' ).'</a> <a href="'.$get_checkout_url .'" class="button checkout">'.__('Checkout &rarr;', 'yiw' ).'</a></p>';
    endif;
    $widget = ob_get_clean();

    $datas['.quick-cart .widget_shopping_cart .cart_list'] = $widget;
    $datas['.widget_shopping_cart .total .amount'] = $woocommerce->cart->get_cart_total();
    $datas['#cart'] = '<div id="cart">' . yiw_minicart(false) . '</div>';

    return $datas;
}
add_filter( 'add_to_cart_fragments', 'yiw_add_to_cart_success_ajax' );

function yiw_woocommerce_javascript_scripts() {
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function($){
            $('body').bind('added_to_cart', function(){
                $('.add_to_cart_button.added').text('<?php echo apply_filters( 'yiw_added_to_cart_text', __( 'ADDED', 'yiw' ) ); ?>');
            });
        });
    </script>
<?php
}
add_action( 'wp_head', 'yiw_woocommerce_javascript_scripts' );

function yit_woocommerce_compare_link() {
    if(function_exists('woo_add_compare_button')) echo str_replace( 'button ', 'button alt ', woo_add_compare_button() ), '<a class="woo_compare_button_go"></a>';
}
add_action( 'woocommerce_single_product_summary', 'yit_woocommerce_compare_link', 35 );


/** SHOP
-------------------------------------------------------------------- */

// decide the layout for the shop pages
function yiw_shop_layouts( $default_layout ) {
    $is_shop_page = ( get_option('woocommerce_shop_page_id') != false ) ? is_page( get_option('woocommerce_shop_page_id') ) : false;
    if ( is_tax('product_cat') || is_post_type_archive('product') || $is_shop_page )
        return YIW_DEFAULT_LAYOUT_PAGE_SHOP;
    else
        return $default_layout;
}
add_filter( 'yiw_layout_page', 'yiw_shop_layouts' );

// generate the main width for content and sidebar
function yiw_layout_widths() {
    global $content_width, $post;

    $sidebar = YIW_SIDEBAR_WIDTH;

    $post_id = isset( $post->ID ) ? $post->ID : 0;

    if ( ! is_search() && get_post_type() == 'product' || get_post_meta( $post_id, '_sidebar_choose_page', true ) == 'Shop Sidebar' )
        $sidebar = YIW_SIDEBAR_SHOP_WIDTH;

    $content_width = YIW_MAIN_WIDTH - ( $sidebar + 40 );

    ?>
    #content { width:<?php echo $content_width ?>px; }
    #sidebar { width:<?php echo $sidebar ?>px; }
    #sidebar.shop { width:<?php echo YIW_SIDEBAR_SHOP_WIDTH ?>px; }
<?php
}
//add_action( 'yiw_custom_styles', 'yiw_layout_widths' );

function yiw_minicart( $echo = true ) {

    global $woocommerce;

    ob_start();

    // quantity
    $qty = 0;
    if (sizeof($woocommerce->cart->get_cart())>0) : foreach ($woocommerce->cart->get_cart() as $item_id => $values) :

        $qty += $values['quantity'];

    endforeach; endif;

    if ( version_compare( preg_replace( '/-beta-([0-9]+)/', '', $woocommerce->version ), '2.1', '<' ) ) {
        $price_filter = 'woocommerce_cart_item_price_html';
    } else {
        $price_filter = 'woocommerce_cart_item_price';
    }

    $label = _n( 'Item', 'Items',$qty, 'yiw' );

    ?>

    <a class="widget_shopping_cart trigger" href="<?php echo $woocommerce->cart->get_cart_url() ?>">
        <span class="minicart"><?php echo $qty ?> <?php echo $label ?> </span>
    </a>

    <?php if ( yiw_get_option('topbar_cart_ribbon_hover') ) : ?>
        <div class="quick-cart">
        <ul class="cart_list product_list_widget"><?php

            if (sizeof($woocommerce->cart->get_cart())>0) :
                foreach ($woocommerce->cart->get_cart() as $cart_item_key => $cart_item) :
                    $_product = $cart_item['data'];
                    if ($_product->exists() && $cart_item['quantity']>0) : ?>
                        <li>
                        <a href="<?php echo get_permalink($cart_item['product_id']) ?>"><?php echo apply_filters('woocommerce_cart_widget_product_title', $_product->get_title(), $_product) ?></a>
                        <span class="price"><?php echo apply_filters($price_filter, woocommerce_price( $_product->price ), $values, $cart_item_key ); ?></span>
                        </li><?php
                    endif;
                endforeach;
            else : ?>
                <li class="empty"><?php _e('No products in the cart.', 'yiw' ) ?></li><?php
            endif;

            if (sizeof($woocommerce->cart->get_cart())>0) : ?>
                <li class="totals"><?php _e( 'Subtotal', 'yiw' ) ?><span class="price"><?php echo $woocommerce->cart->get_cart_total(); ?></span></li><?php
            endif; ?>

            <li class="view-cart-button"><a class="view-cart-button" href="<?php echo $woocommerce->cart->get_cart_url(); ?>"><?php echo apply_filters( 'yiw_topbar_minicart_view_cart', __( 'View cart', 'yiw' ) ) ?></a></li>

        </ul>

        </div><?php
    endif;

    $html = ob_get_clean();

    if ( $echo )
        echo $html;
    else
        return $html;
}

// Decide if show the price and/or the button add to cart, on the product detail page
function yiw_remove_ecommerce() {
    if ( ! yiw_get_option( 'shop_show_button_add_to_cart_single_page', 1 ) )
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
    if ( ! yiw_get_option( 'shop_show_price_single_page', 1 ) )
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
}
add_action( 'wp_head', 'yiw_remove_ecommerce', 1 );

// give the ability to change the text of add to cart button
if ( ! function_exists( 'yit_change_add_to_cart_text' ) ) {
    function yit_change_add_to_cart_text( $text, $product ) {

        if ( $product->product_type != 'simple' || ! $product->is_purchasable() || ! $product->is_in_stock() ) {
            return $text;
        }

        return yit_icl_translate( 'theme', 'yiw', 'shop-button-addtocart-label', yiw_get_option( 'shop_button_addtocart_label', $text ) );

    }
    add_filter( 'woocommerce_product_add_to_cart_text', 'yit_change_add_to_cart_text', 10, 2 );
}
/**
 * LAYOUT
 */
function yiw_shop_layout_pages_before() {
    $layout = yiw_layout_page();
    if ( get_post_type() == 'product' && is_tax( 'product-category' ) )
        $layout = 'sidebar-no';
    elseif ( get_post_type() == 'product' && is_single() )
        $layout = yiw_get_option( 'shop_layout_page_single', 'sidebar-no' );
    elseif ( is_shop() || is_product_category() )
        $layout = ( $l=get_post_meta( get_option( 'woocommerce_shop_page_id' ), '_layout_page', true )) ? $l : YIW_DEFAULT_LAYOUT_PAGE;
    ?><div id="primary" class="layout-<?php echo $layout ?> group">
    <div class="inner group"><?php

    if ( $layout == 'sidebar-no' ) {
        remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
        add_filter('loop_shop_columns', create_function('$columns', 'return $columns+1;'));
    }
}

function yiw_shop_layout_pages_after() {
    ?></div></div><?php
}

add_action( 'woocommerce_before_main_content', 'yiw_shop_layout_pages_before', 1 );
add_action( 'woocommerce_sidebar', 'yiw_shop_layout_pages_after', 99 );

/**
 * SIZES
 */

// shop small
if ( version_compare( preg_replace( '/-beta-([0-9]+)/', '', $woocommerce->version ), '2.1', '<' ) ) {
    function yiw_shop_small_w() { global $woocommerce; $size = $woocommerce->get_image_size('shop_catalog'); return $size['width']; }
    function yiw_shop_small_h() { global $woocommerce; $size = $woocommerce->get_image_size('shop_catalog'); return $size['height']; }
    // shop thumbnail
    function yiw_shop_thumbnail_w() { global $woocommerce; $size = $woocommerce->get_image_size('shop_thumbnail'); return $size['width']; }
    function yiw_shop_thumbnail_h() { global $woocommerce; $size = $woocommerce->get_image_size('shop_thumbnail'); return $size['height']; }
    // shop large
    function yiw_shop_large_w() { global $woocommerce; $size = $woocommerce->get_image_size('shop_single'); return $size['width']; }
    function yiw_shop_large_h() { global $woocommerce; $size = $woocommerce->get_image_size('shop_single'); return $size['height']; }
    // shop category
    function yiw_shop_category_w() { global $woocommerce; $size = $woocommerce->get_image_size('shop_category'); return $size['width']; }
    function yiw_shop_category_h() { global $woocommerce; $size = $woocommerce->get_image_size('shop_category'); return $size['height']; }
    function yiw_shop_category_crop() { global $woocommerce; $size = $woocommerce->get_image_size('shop_category'); return $size['crop']; }

} else {
    function yiw_shop_small_w() { $size = wc_get_image_size('shop_catalog'); return $size['width']; }
    function yiw_shop_small_h() { $size = wc_get_image_size('shop_catalog'); return $size['height']; }
    // shop thumbnail
    function yiw_shop_thumbnail_w() { $size = wc_get_image_size('shop_thumbnail'); return $size['width']; }
    function yiw_shop_thumbnail_h() { $size = wc_get_image_size('shop_thumbnail'); return $size['height']; }
    // shop large
    function yiw_shop_large_w() { $size = wc_get_image_size('shop_single'); return $size['width']; }
    function yiw_shop_large_h() { $size = wc_get_image_size('shop_single'); return $size['height']; }
    // shop category
    function yiw_shop_category_w() { $size = yiw_get_option_size('shop_category_image_size'); return $size['width']; }
    function yiw_shop_category_h() { $size = yiw_get_option_size('shop_category_image_size'); return $size['height']; }
    function yiw_shop_category_crop() { $size = yiw_get_option_size('shop_category_image_size'); return $size['crop']; }
}

/**
 * Init images
 */
function yiw_image_sizes() {

    $size = yiw_get_option_size( 'shop_category_image_size' );

    add_image_size( 'shop_category', $size['width'], $size['height'], $size['crop'] );
}
add_action( 'woocommerce_init', 'yiw_image_sizes' );

// print style for small thumb size
function yiw_size_images_style() {
    ?>
    .shop-traditional .products li { width:<?php echo yiw_shop_small_w() + ( yiw_get_option( 'shop_border_thumbnail' ) ? 14 : 0 ) ?>px !important; }
    .shop-traditional .products li img { width:<?php echo yiw_shop_small_w() ?>px; }
    .shop-traditional .products li.category img { width:<?php echo yiw_shop_category_w() ?>px; }
    .shop-ribbon .products li { width:<?php echo yiw_shop_small_w() + 5 ?>px !important; }
    .shop-ribbon .products li.category { width: auto !important; }
    .products li a strong { width:<?php echo yiw_shop_small_w() - 30 ?>px !important; }
    /*..shop-traditional .products li a img { width:<?php echo yiw_shop_small_w() ?>px !important; }  removed for the category images */
    div.product div.images { width:<?php echo ( yiw_shop_large_w() + 14 ) / 720 * 100 ?>%; }
    .layout-sidebar-no div.product div.images { width:<?php echo ( yiw_shop_large_w() + 14 ) / 960 * 100 ?>%; }
    div.product div.images img { width:<?php echo yiw_shop_large_w() ?>px; }
    .layout-sidebar-no div.product div.summary { width:<?php echo ( 960 - ( yiw_shop_large_w() + 14 ) - 20 ) / 960 * 100 ?>%; }
    .layout-sidebar-right div.product div.summary, .layout-sidebar-left div.product div.summary { width:<?php echo ( 720 - ( yiw_shop_large_w() + 14 ) - 20 ) / 720 * 100 ?>%; }
    .layout-sidebar-no .product.hentry > span.onsale { right:<?php echo 960 - ( yiw_shop_large_w() + 14 ) - 10 ?>px; left:auto; }
    .layout-sidebar-right .product.hentry > span.onsale, .layout-sidebar-left .product.hentry > span.onsale { right:<?php echo 720 - ( yiw_shop_large_w() + 14 ) - 10 ?>px; left:auto; }
<?php
}
add_action( 'yiw_custom_styles', 'yiw_size_images_style' );

/**
 * PRODUCT PAGE
 */
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
add_action( 'woocommerce_single_product_summary', 'woocommerce_output_product_data_tabs', 60);

if ( !function_exists('woocommerce_output_related_products') ) {
    function woocommerce_output_related_products() {
        global $woocommerce;

        echo '<div id="related-products">';
        echo '<h3>', apply_filters( 'yiw_related_products_text', __( 'Related Products', 'yiw' ) ), '</h3>';

        $cols = $prod = yiw_layout_page() == 'sidebar-no' ? 5 : 4;

        if ( yiw_get_option('shop_show_related_single_product') ) {
            $prod = apply_filters('related_products_posts_per_page', yiw_get_option( 'shop_number_related_single_product' ) );
            $cols = apply_filters('related_products_columns', yiw_get_option( 'shop_columns_related_single_product' ) );
        }

        if ( ! version_compare( preg_replace( '/-beta-([0-9]+)/', '', $woocommerce->version ), '2.1', '<' ) ) {
            $args = array(
                'posts_per_page' => $prod,
                'columns' => $cols,
                'orderby' => 'rand'
            );

            woocommerce_related_products( apply_filters( 'woocommerce_output_related_products_args', $args ) );
        } else {
            woocommerce_related_products( $prod, $cols );
        }

        echo '</div>';
    }
}
// number of products
function yiw_items_list_pruducts() {
    return 8;
}
//add_filter( 'loop_shop_per_page', 'yiw_items_list_pruducts' );



/** NAV MENU
-------------------------------------------------------------------- */

add_action('admin_init', array('yiwProductsPricesFilter', 'admin_init'));

class yiwProductsPricesFilter {
    // We cannot call #add_meta_box yet as it has not been defined,
    // therefore we will call it in the admin_init hook
    static function admin_init() {
        global $woocommerce;
        if ( ! isset( $woocommerce ) || basename($_SERVER['PHP_SELF']) != 'nav-menus.php' )
            return;

        wp_enqueue_script('nav-menu-query', get_template_directory_uri() . '/inc/admin_scripts/metabox_nav_menu.js', 'nav-menu', false, true);
        add_meta_box('products-by-prices', 'Prices Filter', array(__CLASS__, 'nav_menu_meta_box'), 'nav-menus', 'side', 'low');
    }

    function nav_menu_meta_box() { ?>
        <div class="prices">
            <input type="hidden" name="woocommerce_currency" id="woocommerce_currency" value="<?php echo get_woocommerce_currency_symbol( get_option('woocommerce_currency') ) ?>" />
            <input type="hidden" name="woocommerce_shop_url" id="woocommerce_shop_url" value="<?php echo get_option('permalink_structure') == '' ? site_url() . '/?post_type=product' : get_permalink( get_option('woocommerce_shop_page_id') ) ?>" />
            <input type="hidden" name="menu-item[-1][menu-item-url]" value="" />
            <input type="hidden" name="menu-item[-1][menu-item-title]" value="" />
            <input type="hidden" name="menu-item[-1][menu-item-type]" value="custom" />

            <p>
                <?php _e( sprintf( 'The values are already expressed in %s', get_woocommerce_currency_symbol( get_option('woocommerce_currency') ) ), 'yiw' ) ?>
            </p>

            <p>
                <label class="howto" for="prices_filter_from">
                    <span><?php _e('From'); ?></span>
                    <input id="prices_filter_from" name="prices_filter_from" type="text" class="regular-text menu-item-textbox input-with-default-title" title="<?php esc_attr_e('From'); ?>" />
                </label>
            </p>

            <p style="display: block; margin: 1em 0; clear: both;">
                <label class="howto" for="prices_filter_to">
                    <span><?php _e('To'); ?></span>
                    <input id="prices_filter_to" name="prices_filter_to" type="text" class="regular-text menu-item-textbox input-with-default-title" title="<?php esc_attr_e('To'); ?>" />
                </label>
            </p>

            <p class="button-controls">
			<span class="add-to-menu">
				<img class="waiting" style="display: none;" src="<?php echo esc_url( admin_url( 'images/wpspin_light.gif' ) ); ?>" alt="" />
				<input type="submit" class="button-secondary submit-add-to-menu" value="<?php esc_attr_e('Add to Menu'); ?>" name="add-custom-menu-item" />
			</span>
            </p>

        </div>
    <?php
    }
}

/**
 * Add 'On Sale Filter to Product list in Admin
 */
add_filter( 'parse_query', 'on_sale_filter' );
function on_sale_filter( $query ) {
    global $pagenow, $typenow, $wp_query;

    if ( $typenow=='product' && isset($_GET['onsale_check']) && $_GET['onsale_check'] ) :

        if ( $_GET['onsale_check'] == 'yes' ) :
            $query->query_vars['meta_compare']  =  '>';
            $query->query_vars['meta_value']    =  0;
            $query->query_vars['meta_key']      =  '_sale_price';
        endif;

        if ( $_GET['onsale_check'] == 'no' ) :
            $query->query_vars['meta_value']    = '';
            $query->query_vars['meta_key']      =  '_sale_price';
        endif;

    endif;
}

add_action('restrict_manage_posts','woocommerce_products_by_on_sale');
function woocommerce_products_by_on_sale() {
    global $typenow, $wp_query;
    if ( $typenow=='product' ) :

        $onsale_check_yes = '';
        $onsale_check_no  = '';

        if ( isset( $_GET['onsale_check'] ) && $_GET['onsale_check'] == 'yes' ) :
            $onsale_check_yes = ' selected="selected"';
        endif;

        if ( isset( $_GET['onsale_check'] ) && $_GET['onsale_check'] == 'no' ) :
            $onsale_check_no = ' selected="selected"';
        endif;

        $output  = "<select name='onsale_check' id='dropdown_onsale_check'>";
        $output .= '<option value="">'.__('Show all products (Sale Filter)', 'woothemes').'</option>';
        $output .= '<option value="yes"'.$onsale_check_yes.'>'.__('Show products on sale', 'woothemes').'</option>';
        $output .= '<option value="no"'.$onsale_check_no.'>'.__('Show products not on sale', 'woothemes').'</option>';
        $output .= '</select>';

        echo $output;

    endif;
}

function woocommerce_subcategory_thumbnail( $category  ) {
    global $woocommerce;

    $small_thumbnail_size  = apply_filters( 'single_product_small_thumbnail_size', 'shop_category' );
    //$image_width     = yiw_shop_category_w();
    //$image_height    = yiw_shop_category_h();

    $image_size            = yiw_get_option_size( 'shop_category_image_size' );

    $thumbnail_id          = get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true  );

    if ( $thumbnail_id ) {
        $image = wp_get_attachment_image_src( $thumbnail_id, $small_thumbnail_size  );
        $image = $image[0];
    } else {
        $image = function_exists('wc_placeholder_img_src') ? wc_placeholder_img_src() : woocommerce_placeholder_img_src();
    }

    $height_attribute = '';
    if(isset($image_size['crop']) && $image_size['crop']) $height_attribute = 'height="' . $image_size['height'].'"';

    echo '<img src="' . $image . '" alt="' . $category->name . '" width="' . $image_size['width'] . '" '.$height_attribute. '/>';
}


if( !function_exists( 'yiw_out_of_stock_flash' ) ) :
    function yiw_out_of_stock_flash() {
        yith_wc_get_template( 'loop/out-of-stock-flash.php' );
    }
endif;
add_action( 'woocommerce_before_shop_loop_item_title', 'yiw_out_of_stock_flash', 10 );

if( !function_exists( 'yiw_out_of_stock_flash_single_product' ) ) :
    function yiw_out_of_stock_flash_single_product() {
        yith_wc_get_template( 'single-product/out-of-stock-flash.php' );
    }
endif;
add_action( 'woocommerce_product_thumbnails', 'yiw_out_of_stock_flash_single_product', 10 );

function yiw_star_rating() {

    global $woocommerce,$post, $wpdb;
    echo do_shortcode( '[rating id="' . $post->ID . '"]' );
}

/**
 * Update woocommerce options after update from 1.6 to 2.0
 */
function yiw_woocommerce_update() {
    global $woocommerce;

    $field = 'yiw_woocommerce_update_' . get_template();

    if( get_option($field) == false && version_compare($woocommerce->version,"2.0.0",'>=') ) {
        update_option($field, time());

        //woocommerce 2.0
        update_option(
            'shop_thumbnail_image_size',
            array(
                'width' => get_option('woocommerce_thumbnail_image_width', 90 ),
                'height' => get_option('woocommerce_thumbnail_image_height', 90 ),
                'crop' => get_option('woocommerce_thumbnail_image_crop', 1)
            )
        );

        update_option(
            'shop_single_image_size',
            array(
                'width' => get_option('woocommerce_single_image_width', 500 ),
                'height' => get_option('woocommerce_single_image_height', 380 ),
                'crop' => get_option('woocommerce_single_image_crop', 1)
            )
        );

        update_option(
            'shop_catalog_image_size',
            array(
                'width' => get_option('woocommerce_catalog_image_width', 150 ),
                'height' => get_option('woocommerce_catalog_image_height', 150 ),
                'crop' => get_option('woocommerce_catalog_image_crop', 1)
            )
        );

    }
}
add_action( 'admin_init', 'yiw_woocommerce_update' ); //update image names after woocommerce update

// Restore position of country field in the checkout
function woocommerce_restore_billing_fields_order( $fields ) {
    global $woocommerce;

    /* FIX WOO 2.1.x */
    if ( version_compare( preg_replace( '/-beta-([0-9]+)/', '', $woocommerce->version ), '2.1', '>=' ) ) {
        $fields['billing_country']['class'][0] = 'form-row-wide';
    }

    $country = $fields['billing_country'];
    unset( $fields['billing_country'] );
    yiw_array_splice_assoc( $fields, array('billing_country' => $country), 'billing_city' );

    return $fields;
}
add_filter( 'woocommerce_billing_fields' , 'woocommerce_restore_billing_fields_order' );

function woocommerce_restore_shipping_fields_order( $fields ) {
    global $woocommerce;

    /* FIX WOO 2.1.x */
    if ( version_compare( preg_replace( '/-beta-([0-9]+)/', '', $woocommerce->version ), '2.1', '>=' ) ) {
        $fields['shipping_country']['class'][0] = 'form-row-wide';
    }

    $country = $fields['shipping_country'];
    unset( $fields['shipping_country'] );
    yiw_array_splice_assoc( $fields, array('shipping_country' => $country), 'shipping_city' );

    return $fields;
}
add_filter( 'woocommerce_shipping_fields' , 'woocommerce_restore_shipping_fields_order' );


add_action( 'admin_init', 'yiw_woocommerce_update' ); //update image names after woocommerce update

add_filter( 'yiw_sample_data_tables',  'yit_save_woocommerce_tables' );
add_filter( 'yiw_sample_data_options', 'yit_save_woocommerce_options' );
add_filter( 'yiw_sample_data_options', 'yit_save_wishlist_options' );
add_filter( 'yiw_sample_data_options', 'yit_add_plugins_options' );

/**
 * @author Andrea Frascaspata
 */
function yiw_wc_2_6_removed_unused_template () {

    if( function_exists( 'yiw_theme_remove_unused_template' ) ) {

        $option = 'yit_wc_2_6_template_remove';

        $files = array( 'myaccount/form-login.php' ,  'single-product/review.php' );

        yiw_theme_remove_unused_template( 'woocommerce' , $option , $files );

    }

}

function yiw_wc_product_post_class( $classes, $class = '', $post_id = '' ) {

    if ( !$post_id || 'product' !== get_post_type( $post_id ) ) {
        return $classes;
    }

    $product = wc_get_product( $post_id );

    if ( $product ) {

       global $woocommerce_loop;

        // Store loop count we're currently on
        if ( empty( $woocommerce_loop['loop'] ) ) {
            $woocommerce_loop['loop'] = 0;
        }

        // Store column count for displaying the grid
        if ( empty( $woocommerce_loop['columns'] ) ) {
            $woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
        }

        // Ensure visibility
        if ( !$product || !$product->is_visible() ) {
            return;
        }
        

        if ( isset( $woocommerce_loop['style'] ) ) {
            $style = $woocommerce_loop['style'];
        }
        else {
            $style = yiw_get_option( 'shop_products_style', 'ribbon' );
        }

        if ( !yiw_get_option( 'shop_show_price' ) ) {
            $classes[] = 'hide-price';
        }

        if ( $style == 'traditional' ) {
            if ( yiw_get_option( 'shop_border_thumbnail' ) ) {
                $classes[] = 'border';
            }
            if ( yiw_get_option( 'shop_shadow_thumbnail' ) ) {
                $classes[] = 'shadow';
            }
            if ( !yiw_get_option( 'shop_show_button_details' ) ) {
                $classes[] = 'hide-details-button';
            }
        }

        if ( !yiw_get_option( 'shop_show_button_add_to_cart' ) ) {
            $classes[] = 'hide-add-to-cart-button';
        }

    }

    return $classes;

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

/* compare */
global $yith_woocompare;
if ( isset($yith_woocompare) ) {
    remove_action( 'woocommerce_after_shop_loop_item', array( $yith_woocompare->obj, 'add_compare_link' ), 20 );
    if ( get_option( 'yith_woocompare_compare_button_in_products_list' ) == 'yes' ) add_action( 'woocommerce_after_shop_loop_item_title', array( $yith_woocompare->obj, 'add_compare_link' ), 20 );
}


/* Function to add compatibility with WC 2.1 */
function yit_woocommerce_primary_start() {
    global $woo_shop_folder;
    yith_wc_get_template( $woo_shop_folder . '/primary-start.php' );
}

/*function yit_rating_singleproduct() {
    yith_wc_get_template( 'single-product/rating.php' );
}*/

function yit_woocommerce_primary_end() {
    global $woo_shop_folder;
    yith_wc_get_template( $woo_shop_folder . '/primary-end.php' );
}


if ( ! function_exists( 'yith_wc_get_page_id' ) ) {

    function yith_wc_get_page_id( $page ) {

        global $woocommerce;

        if ( version_compare( preg_replace( '/-beta-([0-9]+)/', '', $woocommerce->version ), '2.1', '<' ) ) {
            return function_exists('wc_get_page_id') ? wc_get_page_id( $page ) : woocommerce_get_page_id( $page );
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

function yit_enqueue_woocommerce_styles() {
    wp_deregister_style( 'woocommerce_frontend_styles' );
    wp_enqueue_style( 'woocommerce_frontend_styles', get_stylesheet_directory_uri() . '/woocommerce_2.0.x/style.css' );
}

function yit_enqueue_wc_styles( $styles ) {

    global $woocommerce;

    unset( $styles['woocommerce-layout'], $styles['woocommerce-smallscreen'], $styles['woocommerce-general'] );

    $style_version = '';
    if ( version_compare( preg_replace( '/-beta-([0-9]+)/', '', $woocommerce->version ), '2.6', '<' ) ) {
        $style_version = '_' . substr( $woocommerce->version, 0, 3 ) . '.x';
    }

    $styles ['yit-layout'] = array(
        'src'     => get_stylesheet_directory_uri() . '/woocommerce' . $style_version . '/style.css',
        'deps'    => '',
        'version' => '1.0',
        'media'   => ''
    );
    return $styles;
}

if( ! function_exists('admin_fields_yit_wc_image_width') ) {
    /**
     * Create new Woocommerce admin field: yit_wc_image_width
     *
     * @access public
     * @param array $value
     * @return void
     * @since 1.1.3
     */
    function admin_fields_yit_wc_image_width( $value ){
        $width 	= WC_Admin_Settings::get_option( $value['id'] . '[width]', $value['default']['width'] );
        $height = WC_Admin_Settings::get_option( $value['id'] . '[height]', $value['default']['height'] );
        $crop   = WC_Admin_Settings::get_option( $value['id'] . '[crop]' );
        $crop   = ( $crop == 'on' || $crop == '1' ) ? 1 : 0;
        $crop 	= checked( 1, $crop, false );

        ?><tr valign="top">
        <th scope="row" class="titledesc"><?php echo esc_html( $value['title'] ) ?> <?php echo $value['desc'] ?></th>
        <td class="forminp image_width_settings">

            <input name="<?php echo esc_attr( $value['id'] ); ?>[width]" id="<?php echo esc_attr( $value['id'] ); ?>-width" type="text" size="3"
                   value="<?php echo $width; ?>" /> &times; <input name="<?php echo esc_attr( $value['id'] ); ?>[height]" id="<?php echo esc_attr( $value['id'] );
            ?>-height" type="text" size="3" value="<?php echo $height; ?>" />px

            <label><input name="<?php echo esc_attr( $value['id'] ); ?>[crop]" id="<?php echo esc_attr( $value['id'] ); ?>-crop" type="checkbox"
                    <?php echo $crop; ?> /> <?php _e( 'Hard Crop?', 'yiw' ); ?></label>

        </td>
        </tr><?php
    }
}

function yiw_enqueue_woocommerce_assets() {
    wp_enqueue_script( 'yiw-woocommerce', get_template_directory_uri() . '/js/woocommerce.js',array( 'jquery', 'jquery-cookie' ), '1.0', true );
}

//cross sell
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
add_action( 'woocommerce_after_cart' , 'woocommerce_cross_sell_display');

if( defined('YITH_YWAR_PREMIUM') ) {

    add_filter( 'yith_advanced_reviews_loader_gif', 'yiw_get_ajax_loader_gif_url' );

}


if( ! function_exists( 'yiw_woocommerce_object' ) ) {

    function yiw_woocommerce_object() {

        wp_localize_script( 'jquery', 'yiw', array(
            'version' => WC()->version,
            'loader' => yiw_get_ajax_loader_gif_url()
        ));

    }

}

/* quick view compatibility */

function yith_load_product_quick_view() {
    if ( function_exists( 'YITH_WCQV_Frontend' ) && get_option( 'yith-wcqv-enable' ) == 'yes' ) {

        $quick_view = YITH_WCQV_Frontend();
        $position   = isset( $quick_view->position ) ? $quick_view->position : 'add-cart';


        if ( $position == 'add-cart' ) {

            remove_action( 'woocommerce_after_shop_loop_item', array( $quick_view, 'yith_add_quick_view_button' ), 15 );

            /* force quick view position inside thumb with ribbon product layout */
            if ( yiw_get_option( 'shop_products_style' ) == 'ribbon' ) {
                $quick_view->position = 'image';
                add_action( 'woocommerce_before_shop_loop_item_title', array( $quick_view, 'yith_add_quick_view_button' ), 15 );
            }

        }

        add_filter( 'yith_quick_view_loader_gif', 'yiw_get_ajax_loader_gif_url' );

        remove_action( 'yith_wcqv_product_image', 'woocommerce_show_product_sale_flash', 10 );

    }
}

add_action( 'after_setup_theme', 'yith_load_product_quick_view' );


if ( ! function_exists( 'is_quick_view' ) ) {

    function is_quick_view() {
        return ( function_exists( 'YITH_WCQV_Frontend' ) && (( defined('DOING_AJAX') && DOING_AJAX && isset( $_REQUEST['action'] ) && $_REQUEST['action'] == 'yith_load_product_quick_view' )) );
    }
}

if( is_quick_view() && class_exists('WooCommerce_Product_Vendors') ){
    global $wc_product_vendors;
    remove_filter( 'request', array( $wc_product_vendors, 'restrict_media_library' ), 10, 1 );
    remove_filter( 'request', array( $wc_product_vendors, 'filter_booking_list' ) );
    remove_filter( 'request', array( $wc_product_vendors, 'filter_product_list' ) );
}

/* end quick view compatibility */


add_filter ('woocommerce_single_product_image_thumbnail_html' , 'yiw_check_single_product_enable_lightbox' );

if ( ! function_exists( 'yiw_check_single_product_enable_lightbox' ) ) {

    function yiw_check_single_product_enable_lightbox( $html ) {

        if ( get_option( 'woocommerce_enable_lightbox' ) != 'yes' ) {
            $strip_data_rel =  str_replace( 'data-rel="prettyPhoto[product-gallery]"', '', $html );
            $strip_zoom = str_replace('"zoom ' ,'"', $strip_data_rel);
            $strip_zoom = str_replace('"zoom' ,'"', $strip_zoom);

            $html =  $strip_zoom;
        }

        return $html;
    }

}

/*================ Colors and Label Variations Premium ==================*/

if( defined( 'YITH_WCCL_PREMIUM' ) && function_exists( 'YITH_WCCL_Frontend' ) ) {
    remove_filter( 'woocommerce_loop_add_to_cart_link', array( YITH_WCCL_Frontend(), 'add_select_options' ), 99, 2 );
    add_action( 'woocommerce_after_shop_loop_item', array( YITH_WCCL_Frontend(), 'print_select_options'  ) , 2);
}




