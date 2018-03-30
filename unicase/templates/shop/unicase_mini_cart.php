<?php
/**
 * Mini Cart
 *
 * @author  Transvelo
 * @package Unicase/Templates
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php if( apply_filters( 'unicase_is_catalog_mode_disabled', TRUE ) ) : ?>
<div id="unicase-mini-cart" class="unicase-mini-cart">
	
	<div class="dropdown dropdown-cart">
		<a href="#" data-toggle="dropdown" class="dropdown-toggle dropdown-trigger-cart" <?php if( apply_filters( 'unicase_top_cart_dropdown_trigger', 'hover' ) === 'hover' ) : ?>data-hover="dropdown"<?php endif; ?>>
		   	<div class="items-cart-inner">
			   	<div class="total-price-basket">
			   		<span class="cart-icon">
			   			<i class="icon fa fa-shopping-cart"></i>
			   			<span class="item-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
			   		</span>

			   		<span class="cart-info">
			   			<span class="label-name"><?php echo apply_filters( 'unicase_top_cart_text', esc_html__( 'Shopping Cart', 'unicase' ) ); ?></span>
			   			<span class="cart-count">
			   				<?php
				   				echo WC()->cart->get_cart_contents_count();
				   				echo esc_html__( ' Item(s)-', 'unicase' );
				   				echo WC()->cart->get_cart_subtotal();
			   				?>
			   			</span>
			   		</span>
			    </div>
			</div>
		</a>

		<div class="dropdown-menu <?php echo esc_attr( apply_filters( 'unicase_top_cart_dropdown_animation', 'animated fadeInUp' ) ); ?>">
			<div class="mini-cart-items"><?php woocommerce_mini_cart(); ?></div>
		</div>
	</div>
	
</div><!-- #mini-cart -->
<?php endif; ?>