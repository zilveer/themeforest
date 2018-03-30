<?php
/**
 * Single variation cart button
 *
 * @see 	http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

global $product;
crazyblog_View::get_instance()->crazyblog_enqueue_scripts( array( 'df-bootstrap-number' ) );
?>
<div class="woocommerce-variation-add-to-cart variations_button">
	<?php if ( !$product->is_sold_individually() ) : ?>
		<div class="product-customization">
			<div class="qty">
				<?php
				if ( !$product->is_sold_individually() ) {
					esc_html_e( 'Qty:', 'crazyblog' );
					$min_value = apply_filters( 'woocommerce_quantity_input_min', 1, $product );
					$max_value = apply_filters( 'woocommerce_quantity_input_max', $product->backorders_allowed() ? '' : $product->get_stock_quantity(), $product );
					$input_value = ( isset( $_POST['quantity'] ) ? wc_stock_amount( $_POST['quantity'] ) : 1 );
					?>
					<input id="counter" class="form-control" type="number" value="<?php echo esc_attr( $input_value ) ?>" min="<?php echo esc_attr( $min_value ) ?>" max="<?php echo esc_attr( $max_value ) ?>" />
					<?php
				}
				?>
			</div>
		</div>
	<?php endif; ?>
	<div class="product-btns">
		<button type="submit" class="cart-btn"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>
	</div>
	<input type="hidden" name="add-to-cart" value="<?php echo absint( $product->id ); ?>" />
	<input type="hidden" name="product_id" value="<?php echo absint( $product->id ); ?>" />
	<input type="hidden" name="variation_id" class="variation_id" value="0" />

</div>
<?php
$custom_script = 'jQuery(document).ready(function ($) {
        $("#counter").bootstrapNumber();
    });';
    wp_add_inline_script('crazyblog_df-bootstrap-number', $custom_script);
?>