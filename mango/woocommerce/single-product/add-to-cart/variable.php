<?php
/**
 * Variable product add to cart
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product, $post;
$attribute_keys = array_keys( $attributes );
?>

<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<form class="variations_form cart" method="post" enctype='multipart/form-data' data-product_id="<?php echo $post->ID; ?>" data-product_variations="<?php echo htmlspecialchars( json_encode( $available_variations ) ) ?>">
	<?php if ( ! empty( $available_variations ) ) :	?>

	<table class="variations table borderless table-responsive" cellspacing="0">
		<tbody>
			<?php foreach ( $attributes as $attribute_name => $options ) : ?>
				<tr>
					<td class="label">
						<label class="input-desc" for="<?php echo sanitize_title( $attribute_name ); ?>">
							<?php echo wc_attribute_label( $attribute_name ); ?>
						</label>
					</td>
					<td class="value">
						<?php
							$selected = isset( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] )
							? wc_clean( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) 
							:$product->get_variation_default_attribute( $attribute_name );
							
							wc_dropdown_variation_attribute_options(
							array( 'options' => $options, 'attribute' => $attribute_name, 'product' => $product, 'selected' => $selected )
							);
							
							echo end( $attribute_keys ) === $attribute_name ? '<a class="reset_variations" href="#">' . __( 'Clear selection', 'woocommerce' ) . '</a>' : '';
						?>
					</td>
				</tr>
		        <?php endforeach;?>
			</tbody>
		</table>
		<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
		<div class="single_variation_wrap" style="display:none;">
			<?php do_action( 'woocommerce_before_single_variation' ); ?>
			<div class="single_variation product-price-container"></div>
			<div class="variations_button">
				<?php woocommerce_quantity_input( array(
					'input_value' => ( isset( $_POST['quantity'] ) ? wc_stock_amount( $_POST['quantity'] ) : 1 )
				) ); ?>
				<button type="submit" class="btn btn-custom2 single_add_to_cart_button button alt"><?php echo $product->single_add_to_cart_text(); ?></button>
			</div>
			<input type="hidden" name="add-to-cart" value="<?php echo $product->id; ?>" />
			<input type="hidden" name="product_id" value="<?php echo esc_attr( $post->ID ); ?>" />
			<input type="hidden" name="variation_id" class="variation_id" value="" />
			<?php do_action( 'woocommerce_after_single_variation' ); ?>
		</div>
		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
	<?php else : ?>
		<p class="stock out-of-stock"><?php _e( 'This product is currently out of stock and unavailable.', 'woocommerce' ); ?></p>
	<?php endif; ?>
</form>
<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>