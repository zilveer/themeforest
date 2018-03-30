<?php
/**
 * Single Product Sale Flash
 *
 * @author        WooThemes
 * @package       WooCommerce/Templates
 * @version       1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

global $post, $product;
$regular_price     = get_post_meta( $product->id, '_regular_price', true );
$regular_price_var = get_post_meta( $product->id, '_min_variation_price', true );

if ( $product->is_on_sale() ) : ?>
    <?php echo apply_filters( 'woocommerce_sale_flash', '<span class="onsale">' . __( 'Sale!', 'yiw' ) . '</span>', $post, $product ); ?>
<?php endif; ?>