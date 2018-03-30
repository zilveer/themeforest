<?php
/**
 * Variable product add to cart
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $product, $post;
$uniqid = uniqid('product-select-');
?>

<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<form class="variations_form cart" method="post" enctype='multipart/form-data' data-product_id="<?php echo $post->ID; ?>" data-product_variations="<?php echo esc_attr( json_encode( $available_variations ) ) ?>">
	<?php do_action( 'woocommerce_before_variations_form' ); ?>
	<?php if ( empty( $available_variations ) && false !== $available_variations ) : ?>
		<p class="stock out-of-stock"><?php _e( 'This product is currently out of stock and unavailable.', 'dfd' ); ?></p>
	<?php else : ?>
		<table class="variations" cellspacing="0">
			<tbody>
				<tr>
					<?php $loop = 0; foreach ( $attributes as $attribute_name => $options ) : $loop++; ?>
						<?php /*<td class="label"><label for="<?php echo sanitize_title($name); ?>"><?php echo wc_attribute_label( $name ); ?>:</label></td>*/ ?>
						<td class="value <?php echo ($loop % 2 == 0) ? 'even' : 'odd' ?>">
							<?php
								$selected = isset( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ? wc_clean( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) : $product->get_variation_default_attribute( $attribute_name );
								wc_dropdown_variation_attribute_options( array( 'options' => $options, 'attribute' => $attribute_name, 'product' => $product, 'selected' => $selected ) );
							?>
						</td>
						<?php if ( $loop % 2 == 0 && sizeof($attributes) != $loop ): ?>
							</tr>
							<tr class="sep">
								<td></td>
								<td></td>
							</tr>
							<tr>
						<?php endif; ?>
						<?php if ( sizeof($attributes) == $loop ): ?>
							</tr>
							<tr class="sep">
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td class="hide"></td>
								<td class="clear-section">

									<?php
										echo '<a class="reset_variations" href="#">' . __( 'Clear selection', 'woocommerce' ) . '</a>';
									?>

								</td>
						<?php endif; ?>
					<?php endforeach;?>
				</tr>
			</tbody>
		</table>
		<?php /*
		 * Was in use before 2.4 version, temporary kept just for any case :)
		 * 
		<div class="single_variation_wrap" style="display:none;">
			<?php do_action( 'woocommerce_before_single_variation' ); ?>

			<div class="single_variation"></div>

			<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
			<div class="variations_button">
				<?php woocommerce_quantity_input(); ?>
				<button type="submit" class="single_add_to_cart_button button alt"><?php echo $product->single_add_to_cart_text(); ?></button>
				<?php if(function_exists('dfd_woocommerce_wishlist_size_quide')) {
					dfd_woocommerce_wishlist_size_quide();
				} ?>
			</div>

			<input type="hidden" name="add-to-cart" value="<?php echo $product->id; ?>" />
			<input type="hidden" name="product_id" value="<?php echo esc_attr( $post->ID ); ?>" />
			<input type="hidden" name="variation_id" value="" />
			<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>

			<?php do_action( 'woocommerce_after_single_variation' ); ?>
		</div>
		*/ ?>
		<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
			<div class="single_variation_wrap" style="display:none;">
				<?php
					/**
					 * woocommerce_before_single_variation Hook
					 */
					do_action( 'woocommerce_before_single_variation' );

					/**
					 * woocommerce_single_variation hook. Used to output the cart button and placeholder for variation data.
					 * @since 2.4.0
					 * @hooked woocommerce_single_variation - 10 Empty div for variation data.
					 * @hooked woocommerce_single_variation_add_to_cart_button - 20 Qty and cart button.
					 */
					do_action( 'woocommerce_single_variation' );

					/**
					 * woocommerce_after_single_variation Hook
					 */
					do_action( 'woocommerce_after_single_variation' );
				?>
			</div>
		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
	<?php endif; ?>
	
	<?php do_action( 'woocommerce_after_variations_form' ); ?>
	
</form>

<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>
