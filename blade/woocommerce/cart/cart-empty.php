<?php
/**
 * Empty cart page
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

wc_print_notices();

?>

<?php do_action( 'woocommerce_cart_is_empty' ); ?>

<div class="grve-empty-cart cart-empty">
	<div class="grve-empty-icon-wrapper">
		<i class="grve-icon-close-sm grve-text-primary-1"></i>
		<i class="grve-icon-cart"></i>
	</div>
	<div class="grve-h6"><?php esc_html_e( 'No products in the cart.', 'woocommerce' ); ?></div>
	<?php if ( wc_get_page_id( 'shop' ) > 0 ) : ?>
	<a class="grve-link-text grve-text-primary-1 grve-text-hover-black" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>"><?php esc_html_e( 'Return To Shop', 'woocommerce' ) ?></a>
	<?php endif; ?>
</div>
