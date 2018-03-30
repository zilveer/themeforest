<?php
/**
 * External product add to cart
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

<div class="form_cart_actions">
<p class="cart">
	<a href="<?php echo esc_url( $product_url ); ?>" rel="nofollow" class="single_add_to_cart_button button alt"><?php echo dh_print_string($button_text); ?></a>
	<?php DH_Woocommerce::instance()->yith_wishlist_do_shortcode() ?>
</p>
</div>

<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
