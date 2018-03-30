<?php
/**
 * Other actions (Compare, Wishlist)
 *
 * @author        WooThemes
 * @package       WooCommerce/Templates
 * @version       1.6.4
 */

global $product, $woocommerce_loop;

$actions = array();

if ( get_option( 'yith_woocompare_compare_button_in_product_page' ) == 'yes' ) {
    $actions['compare']  = shortcode_exists( 'yith_compare_button' ) ? '<div class="action compare">' . do_shortcode('[yith_compare_button type="link"]') . '</div>' : '';
}

$actions['wishlist'] = '<div class="action wishlist">' . do_shortcode('[yith_wcwl_add_to_wishlist]') . '</div>';

if ( ! defined( 'YITH_WCWL' ) || get_option( 'yith_wcwl_enabled' ) != 'yes' || empty( $actions['wishlist'] ) ) { unset( $actions['wishlist'] ); }


foreach ( array( 'wishlist' ) as $button ) {

    if ( is_product() && yit_get_option('shop-single-show-'.$button) == 'no' ||
        empty( $actions[$button] )
    ) {
        unset( $actions[$button] );
    }
}



if ( empty( $actions ) ) return;

// add first class in the first item
$actions = array_values( array_filter( $actions ) );
$has_actions = sizeof( $actions ) > 0 && false === empty( $actions[0] );
if(!$has_actions) return ;
$actions[0] = str_replace( '<div class="action ', '<div class="action first ', $actions[0] );
?>
<div class="clearfix product-actions<?php if( isset( $woocommerce_loop ) ) echo "-loop"; ?> buttons_<?php echo count( $actions ); ?> group">
    <?php echo implode( array_values( $actions ), '' ); ?>
</div>
<div class="clear"></div>
