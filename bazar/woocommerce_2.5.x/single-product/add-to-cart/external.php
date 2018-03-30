<?php
/**
 * External product add to cart
 *
 * @author        WooThemes
 * @package       WooCommerce/Templates
 * @version       2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

do_action( 'woocommerce_before_add_to_cart_button' );

$button_text = yit_icl_translate( "theme", "yit", "add_to_cart_text_external", $button_text );

?>

    <p class="cart">
        <a href="<?php echo esc_url( $product_url ); ?>" rel="nofollow" class="single_add_to_cart_button button alt"><?php echo apply_filters( 'single_add_to_cart_text', $button_text, $product->product_type); ?></a>
    </p>
    <div class="clear"></div>
<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>