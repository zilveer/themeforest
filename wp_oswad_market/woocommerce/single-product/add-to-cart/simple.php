<?php
/**
 * Simple product add to cart
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $product, $smof_data;
$catalog_mode = (isset($smof_data['wd_enable_catalog_mod']) && $smof_data['wd_enable_catalog_mod'] == 1)?true:false;

if ( ! $product->is_purchasable() ) return;
?>

<?php
	// Availability
	$availability = $product->get_availability();

	if ($availability['availability']) :
		echo apply_filters( 'woocommerce_stock_html', '<p class="stock ' . esc_attr( $availability['class'] ) . '">' . esc_html( $availability['availability'] ) . '</p>', $availability['availability'] );
    endif;
?>

<?php if ( $product->is_in_stock() ) : ?>
	
	<?php do_action('woocommerce_before_add_to_cart_form'); ?>

	<form class="cart product_detail" method="post" enctype='multipart/form-data'>
		<div class="clear"></div>
		<div class="single_add_to_cart_wrapper">
			<?php if( !$catalog_mode ): ?>
				<?php do_action('woocommerce_before_add_to_cart_button'); ?>
				<span class="quantity-text"><?php _e('Quantity','wpdance'); ?></span>
			<?php endif; ?>
			<?php
				if ( ! $product->is_sold_individually() && !$catalog_mode )
					woocommerce_quantity_input( array(
						'min_value' => apply_filters( 'woocommerce_quantity_input_min', 1, $product ),
						'max_value' => apply_filters( 'woocommerce_quantity_input_max', $product->backorders_allowed() ? '' : $product->get_stock_quantity(), $product )
					) );
				global $smof_data;
				if( $smof_data['wd_prod_price'] )
					woocommerce_template_single_price();
			?>
			<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->id ); ?>" />
			<?php if( !$catalog_mode ): ?>
				<button type="submit" class="single_add_to_cart_button button alt "><?php echo apply_filters('single_add_to_cart_text', __( 'Add to cart', 'wpdance' ), $product->product_type); ?></button>
				<?php do_action('woocommerce_after_add_to_cart_button'); ?>
			<?php endif; ?>
		</div>
		<div class="clear"></div>
	</form>

	<?php do_action('woocommerce_after_add_to_cart_form'); ?>
<?php endif; ?>