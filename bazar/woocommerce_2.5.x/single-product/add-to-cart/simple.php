<?php
/**
 * Simple product add to cart
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version    2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $product;

if ( ! $product->is_purchasable() ) return;
?>

<?php
	// Availability
	$availability = $product->get_availability();

	if ($availability['availability']) :
		echo apply_filters( 'woocommerce_stock_html', '<p class="stock '.$availability['class'].'">'.$availability['availability'].'</p>', $availability['availability'] , $product);
    endif;
?>

<?php if ( $product->is_in_stock() && is_shop_enabled() ) : ?>

	<?php do_action('woocommerce_before_add_to_cart_form'); ?>

	<form class="cart" method="post" enctype='multipart/form-data'>

	 	<?php do_action('woocommerce_before_add_to_cart_button'); ?>

	 	<?php

	 		if ( ! $product->is_sold_individually() ){               
                ?><label><?php _e( 'Quantity', 'yit' ) ?></label><?php
	 			woocommerce_quantity_input( array(
	 				'min_value' => apply_filters( 'woocommerce_quantity_input_min', 1, $product ),
	 				'max_value' => apply_filters( 'woocommerce_quantity_input_max', $product->backorders_allowed() ? '' : $product->get_stock_quantity(), $product )
	 			) );
			}

            $label = apply_filters( 'single_add_to_cart_text', yit_icl_translate("theme","yit","add_to_cart_text",yit_get_option( 'add-to-cart-text' )) , $product->product_type );
	 	?>

        <input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->id ); ?>" />

	 	<button type="submit" class="single_add_to_cart_button button alt"><?php echo $label ?></button>

	 	<?php do_action('woocommerce_after_add_to_cart_button'); ?>

	</form>

    <div class="clear"></div>

	<?php do_action('woocommerce_after_add_to_cart_form'); ?>

<?php endif; ?>