<?php
/**
 * Other actions (Compare, Wishlist, Share)
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

global $product;

$actions = array();

$actions['wishlist'] = '<div class="action wishlist">' . do_shortcode('[yith_wcwl_add_to_wishlist]') . '</div>';

if ( ( get_option( 'yith_woocompare_compare_button_in_products_list' ) == 'yes' && !is_product() ) ||
    ( get_option( 'yith_woocompare_compare_button_in_product_page' ) == 'yes' && is_product() ) ) {
    $actions['compare']  = shortcode_exists( 'yith_compare_button' ) ? '<div class="action compare">' . do_shortcode('[yith_compare_button type="link"]') . '</div>' : '';
}

if ( ! defined( 'YITH_WCWL' ) || get_option( 'yith_wcwl_enabled' ) != 'yes' || empty( $actions['wishlist'] ) ) { unset( $actions['wishlist'] ); }

// add share for single product
global $woocommerce_loop;

if ( empty( $actions ) ) return;

// add first class in the first item
$actions = array_values( $actions );
$actions[0] = str_replace( '<div class="action ', '<div class="action first ', $actions[0] );
?>

    <div class="product-actions buttons_<?php echo count( $actions ); ?> group">
        <?php echo implode( array_values( $actions ), ' / ' ); ?>
    </div>

<?php if( !yiw_get_option( 'shop_show_button_add_to_cart' ) && ! isset( $woocommerce_loop ) ) : ?><div class="clear"></div><?php endif ?>