<?php
/**
 * Simple product add to cart
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $product, $sf_options;

$loading_text = __( 'Adding...', 'swiftframework' );
$added_text = __( 'Item added', 'swiftframework' );
$button_class = "add_to_cart_button";
$ajax_enabled = true;
$minimum_allowed_quantity = 1;

if ( isset($sf_options['product_addtocart_ajax']) ) {
	$ajax_enabled = $sf_options['product_addtocart_ajax'];
}

if ( !$ajax_enabled ) {
	$button_class = "single_add_to_cart_button";
}

if ( ! $product->is_purchasable() ) return;
?>

<?php
	// Availability
	$availability = $product->get_availability();

	if ( $availability['availability'] )
		echo apply_filters( 'woocommerce_stock_html', '<p class="stock ' . esc_attr( $availability['class'] ) . '">' . esc_html( $availability['availability'] ) . '</p>', $availability['availability'] );
?>

<?php
	// WooCommerce Min/Max Quanties Plugin
	if ( class_exists( 'WC_Min_Max_Quantities_Addons' ) ) {
		$custom_min_qty = sf_get_post_meta( get_the_ID(), 'minimum_allowed_quantity', true );
		if ( $custom_min_qty != "" ) {
			$minimum_allowed_quantity = $custom_min_qty;
		}
	}
?>

<?php if ( $product->is_in_stock() ) : ?>

	<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>

	<form class="cart" method="post" enctype='multipart/form-data'>
	 	<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

	 	<?php
	 		if ( ! $product->is_sold_individually() )
	 			woocommerce_quantity_input( array(
	 				'min_value' => apply_filters( 'woocommerce_quantity_input_min', 1, $product ),
	 				'max_value' => apply_filters( 'woocommerce_quantity_input_max', $product->backorders_allowed() ? '' : $product->get_stock_quantity(), $product )
	 			) );
	 	?>

	 	<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->id ); ?>" />

	 	<button type="submit" data-product_id="<?php echo esc_attr($product->id); ?>" data-quantity="<?php echo esc_attr( $minimum_allowed_quantity ); ?>" data-default_text="<?php echo esc_attr($product->single_add_to_cart_text()); ?>" data-default_icon="sf-icon-add-to-cart" data-loading_text="<?php echo esc_attr($loading_text); ?>" data-added_text="<?php echo esc_attr($added_text); ?>" class="<?php echo $button_class; ?> ajax_add_to_cart product_type_simple button alt"><?php echo apply_filters('sf_add_to_cart_icon', '<i class="sf-icon-add-to-cart"></i>'); ?><span><?php echo esc_attr($product->single_add_to_cart_text()); ?></span></button>
	 	
		<?php echo sf_wishlist_button(); ?>

		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
	</form>

	<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

<?php else : ?>

<?php echo sf_wishlist_button('oos'); ?>

<?php endif; ?>