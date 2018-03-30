<?php
/**
 * Theme Name: proStore
 * Theme URI: http://themeforest.net/user/gnrocks/portfolio
 * Theme demo : http://rchour.net/prostore
 * Description: A WordPress premium theme exclusively for sale on ThemeForest
 *
 * Author: gnrocks
 * Author URI: http://themeforest.net/user/gnrocks
 * License : http://codex.wordpress.org/GPL & http://wiki.envato.com/support/legal-terms/licensing-terms/
 *
 *
 * @package 	proStore/woocommerce/single-product/add-to-cart/simple.php
 * @sub-package WooCommerce/Templates/single-product/add-to-cart/simple.php
 * @file		1.0
 * @file(Woo)	1.6.4
 */
?>
<?php global $woocommerce, $product; ?>

<?php
if ( ! $product->is_purchasable() ) return;
?>

	<?php do_action('woocommerce_before_add_to_cart_form'); ?>

	<?php if ( $product->is_in_stock() ) : ?>

	<form action="<?php echo esc_url( $product->add_to_cart_url() ); ?>" class="cart" method="post" enctype='multipart/form-data'>

	 	<?php do_action('woocommerce_before_add_to_cart_button'); ?>

		<?php
	 		if ( ! $product->is_sold_individually() )
	 			woocommerce_quantity_input( array( 'min_value' => 1, 'max_value' => $product->backorders_allowed() ? '' : $product->get_stock_quantity() ) );
	 	?>

	 	<button type="submit" class="single_add_to_cart_button button alt"><?php echo apply_filters('single_add_to_cart_text', __('Add to cart', 'woocommerce'), $product->product_type); ?></button>

	 	<?php do_action('woocommerce_after_add_to_cart_button'); ?>
	
		<?php echo '<div class="separator"></div>'; ?>
					
	</form>

	<?php endif; ?>

	<?php do_action('woocommerce_after_add_to_cart_form'); ?>