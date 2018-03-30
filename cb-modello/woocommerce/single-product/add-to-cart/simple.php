<?php
/**
 * Simple product add to cart
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $product,$post;

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



<div class="cart_add">


	<form action="<?php echo esc_url( $product->add_to_cart_url() ); ?>"
		class="cart cart_add_button" method="post"
		enctype='multipart/form-data'>

		<?php do_action('woocommerce_before_add_to_cart_button'); ?>
		<div class="cart_options">
			<div class="cl"></div>
			<div class="opt_lab"><?php _e('Quantity','cb-modello');?></div>
			<?php
			if ( ! $product->is_sold_individually() )
			woocommerce_quantity_input( array(
	 				'min_value' => apply_filters( 'woocommerce_quantity_input_min', 1, $product ),
	 				'max_value' => apply_filters( 'woocommerce_quantity_input_max', $product->backorders_allowed() ? '' : $product->get_stock_quantity(), $product )
			) );
	 	?>
			<div class="cl"></div>
		</div>


        <div class="buttons-holder">
            <div class="add-cart-holder">
                <button type="submit" class="md-button full-width">
                    <?php echo apply_filters('single_add_to_cart_text', __( 'Add to cart', 'woocommerce' ), $product->product_type); ?>
                </button>

            </div>
        </div>



		<?php do_action('woocommerce_after_add_to_cart_button'); ?>

	</form>

</div>

		<?php do_action('woocommerce_after_add_to_cart_form'); ?>

<?php endif; ?>