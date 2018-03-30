<?php
/**
 * Simple product add to cart
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $product;

if ( ! $product->is_purchasable() ) return;
$ajax_addtocart = etheme_get_option('ajax_addtocart');
?>

<div class="addto-container">

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
	
		 	<button type="submit" class="button big active <?php if($ajax_addtocart==1){?> etheme-simple-product <?php } ?>"><span><?php echo $product->single_add_to_cart_text(); ?></span></button>
	
			<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
		</form>
	
		<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>
	
	<?php endif; ?>
</div>
<div class="clear"></div>
<hr/>