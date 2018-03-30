<?php
/**
 * Variable product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/variable.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $woocommerce, $product, $post;
$attribute_keys = array_keys( $attributes );
$sidebar_position = get_post_meta($post->ID,'mm_sidebar_product_meta_box',true); 
?>

<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>


<div class="variations_view">

<form class="variations_form cart" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->id ); ?>" data-product_variations="<?php echo htmlspecialchars( json_encode( $available_variations ) ) ?>">
	
	<?php do_action( 'woocommerce_before_variations_form' ); ?>
	
	
	<?php if ( empty( $available_variations ) && false !== $available_variations ) : ?>
		<p class="stock out-of-stock"><?php _e( 'This product is currently out of stock and unavailable.', 'homeshop' ); ?></p>
	<?php else : ?>
	
		<table class="variations product-actions-single" cellspacing="0"
		<?php if( $sidebar_position == 'full' ) { ?>
		style="float: left;"
		<?php } ?>
		>
			<tbody>
				<?php foreach ( $attributes as $attribute_name => $options ) : ?>
					<tr>
						<td class="label"><label for="<?php echo sanitize_title( $attribute_name ); ?>"><?php echo wc_attribute_label( $attribute_name ); ?></label></td>
						<td class="value">
							<?php
								$selected = isset( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ? wc_clean( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) : $product->get_variation_default_attribute( $attribute_name );
								wc_dropdown_variation_attribute_options( array( 'options' => $options, 'class' => 'chosen-select', 'attribute' => $attribute_name, 'product' => $product, 'selected' => $selected ) );
								echo end( $attribute_keys ) === $attribute_name ? apply_filters( 'woocommerce_reset_variations_link', '<a class="reset_variations" href="#">' . __( 'Clear', 'homeshop' ) . '</a>' ) : '';
							?>
						</td>
					</tr>
		        <?php endforeach;?>
			</tbody>

		</table>

		<!-- compare -->
		<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>


		
		<div class="single_variation_wrap" style="display:none;
		
		<?php if( $sidebar_position == 'full' ) { ?>
		float: left; margin-top: 30px;
		<?php } ?>
		">
		
		<?php 
		/**
		 * woocommerce_before_single_variation Hook.
		 */
		do_action( 'woocommerce_before_single_variation' );
		?>
		
		
		
		<?php 
		/**
		 * woocommerce_single_variation hook. Used to output the cart button and placeholder for variation data.
		 * @since 2.4.0
		 * @hooked woocommerce_single_variation - 10 Empty div for variation data.
		 * @hooked woocommerce_single_variation_add_to_cart_button - 20 Qty and cart button.
		 */
		remove_action('woocommerce_single_variation', 'woocommerce_single_variation_add_to_cart_button', 20);
		do_action( 'woocommerce_single_variation' ); 

		
		?>

		<table class="product-actions-single" >
			<tr>
				<td><?php _e( 'Quantity', 'homeshop' ); ?>:</td>
				<td>
				
					<?php woocommerce_quantity_input(); ?>
					
					<button type="submit" class="single_add_to_cart_button button alt">
						<span class="add-to-cart">
							<span class="action-wrapper">
								<i class="icons icon-basket-2"></i>
								<span class="action-name"><?php echo $product->single_add_to_cart_text(); ?></span>
							</span >
						</span>
					</button>
					<input type="hidden" name="add-to-cart" value="<?php echo $product->id; ?>" />
					<input type="hidden" name="product_id" value="<?php echo esc_attr( $post->ID ); ?>" />
					<input type="hidden" name="variation_id" value="" />
				</td>
			</tr>
		</table>
		
		
		<?php do_action( 'woocommerce_after_single_variation' ); ?>
		
	</div>
		
		<div class="clearfix"></div>

		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>

	<?php endif; ?>

	<?php do_action( 'woocommerce_after_variations_form' ); ?>
</form>

</div>

	
<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>
