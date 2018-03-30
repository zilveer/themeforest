<?php
/**
 * Empty cart page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

/* Note: This file has been altered by Laborator */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

# start: modified by Arlind Nushi
#wc_print_notices();
# end: modified by Arlind Nushi

?>
<div class="shop-empty-cart-page cart-empty">

	<div class="container">
		<div class="col-sm-12 text-center">

			<div class="cart-bag-env">
				<div class="cart-smiley">
					<i></i>
					<i class="cart-smiley-hands"></i>
				</div>
				<div class="cart-bag"></div>
			</div>

			<div class="cart-empty-title">
				<h1><?php _e('Cart Empty', 'aurum'); ?></h1>

				<p class="return-to-shop">
					<a class="button wc-backward" href="<?php echo apply_filters( 'woocommerce_return_to_shop_redirect', get_permalink( wc_get_page_id( 'shop' ) ) ); ?>">
						<?php _e( 'Browse our products &amp; fill the cart!', 'aurum' ) ?>
					</a>
				</p>
			</div>

			<script type="text/javascript">
				jQuery(document).ready(function($)
				{
					$(".cart-smiley").addClass('shown');
				});
			</script>

		</div>
	</div>

</div>

<?php return; ?>

<p class="cart-empty"><?php _e( 'Your cart is currently empty.', 'aurum' ) ?></p>

<?php do_action( 'woocommerce_cart_is_empty' ); ?>

<p class="return-to-shop"><a class="button wc-backward" href="<?php echo apply_filters( 'woocommerce_return_to_shop_redirect', get_permalink( wc_get_page_id( 'shop' ) ) ); ?>"><?php _e( 'Browse our products &amp; fill the cart!', 'aurum' ) ?></a></p>