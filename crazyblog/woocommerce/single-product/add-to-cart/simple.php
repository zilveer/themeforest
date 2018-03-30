<?php
/**
 * Simple product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/simple.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */
if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

if ( !$product->is_purchasable() ) {
	return;
}
?>

<?php
// Availability
$availability = $product->get_availability();
$availability_html = empty( $availability['availability'] ) ? '' : '<p class="stock ' . esc_attr( $availability['class'] ) . '">' . esc_html( $availability['availability'] ) . '</p>';
crazyblog_View::get_instance()->crazyblog_enqueue_scripts( array( 'df-bootstrap-number' ) );
echo apply_filters( 'woocommerce_stock_html', $availability_html, $availability['availability'], $product );
?>

<?php if ( $product->is_in_stock() ) : ?>

	<?php //do_action( 'woocommerce_before_add_to_cart_form' ); ?>

	<form class="cart" method="post" enctype='multipart/form-data'>


		<?php //do_action( 'woocommerce_before_add_to_cart_button' ); ?>
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
		<div class="product-btns">
			<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->id ); ?>" />

			<button type="submit" class="cart-btn"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>

			<?php //do_action( 'woocommerce_after_add_to_cart_button' );  ?>
		</div>
	</form>

	<?php //do_action( 'woocommerce_after_add_to_cart_form' );  ?>

<?php endif; ?>

<?php
    $custom_script = 'jQuery(document).ready(function ($) {
        $("#counter").bootstrapNumber();
    });';
    wp_add_inline_script('crazyblog_df-bootstrap-number', $custom_script);
