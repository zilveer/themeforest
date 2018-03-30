<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

// Extra post classes
$classes = array();

//Second Product Image
$attachment_ids = $product->get_gallery_attachment_ids();
if ( $attachment_ids ) {
	$loop = 0;
	foreach ( $attachment_ids as $attachment_id ) {
		$image_link = wp_get_attachment_url( $attachment_id );
		if (!$image_link) {
			continue;
		}
		$loop++;
		$product_thumb_second = wp_get_attachment_image_src($attachment_id, 'shop_catalog');
		$product_thumb_second_alt = get_post_meta( $attachment_id, '_wp_attachment_image_alt', true );
		if ($loop == 1) {
			break;
		}
	}
}

$grve_product_overview_image_effect = blade_grve_option( 'product_overview_image_effect', 'second' );

if ( 'second' == $grve_product_overview_image_effect && isset( $product_thumb_second[0] ) ) {
	$classes[] = 'grve-with-second-image';
}

//Remove Actions
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title' , 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );

//Add Actions
add_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_title', 9);

?>
<li <?php post_class( $classes ); ?>>

	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
	
	<div class="grve-product-item">
		<div class="grve-product-media grve-image-hover">	

			<a href="<?php echo esc_url( get_permalink() ); ?>">

				<?php
					/**
					 * woocommerce_before_shop_loop_item_title hook
					 *
					 * @hooked woocommerce_show_product_loop_sale_flash - 10
					 * @hooked woocommerce_template_loop_product_thumb_secondnail - 10
					 */
					do_action( 'woocommerce_before_shop_loop_item_title' );
					
					if ( 'second' == $grve_product_overview_image_effect && isset( $product_thumb_second[0] ) ) {
				?>
						<img class="grve-product-thumbnail-second" alt="<?php echo esc_attr( $product_thumb_second_alt ); ?>" src="<?php echo esc_url( $product_thumb_second[0] ); ?>" width="<?php echo esc_attr( $product_thumb_second[1] ); ?>" height="<?php echo esc_attr( $product_thumb_second[2] ); ?>" />
				<?php
					}			

					/**
					 * woocommerce_shop_loop_item_title hook
					 *
					 * @hooked woocommerce_template_loop_product_title - 10
					 */
					do_action( 'woocommerce_shop_loop_item_title' );

					/**
					 * woocommerce_after_shop_loop_item_title hook
					 *
					 * @hooked woocommerce_template_loop_rating - 5
					 * @hooked woocommerce_template_loop_price - 10
					 */
					do_action( 'woocommerce_after_shop_loop_item_title' );
				?>

			</a>
			
			<?php woocommerce_template_loop_rating(); ?>
			<div class="grve-product-content">
				<div class="grve-product-switcher">
					<div class="grve-product-price grve-link-text">
						<?php woocommerce_template_loop_price(); ?>
					</div>
					<div class="grve-add-to-cart-btn grve-link-text">
						<?php woocommerce_template_loop_add_to_cart(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php

		/**
		 * woocommerce_after_shop_loop_item hook
		 *
		 * @hooked woocommerce_template_loop_add_to_cart - 10
		 */
		do_action( 'woocommerce_after_shop_loop_item' );

	?>

</li>
