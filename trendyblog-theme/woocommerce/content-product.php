<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.6.1
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}


?>
<li <?php post_class( ); ?>>

	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

    <!-- Thumb -->
    <div class="item_thumb">
		<?php
			/**
			 * woocommerce_before_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_show_product_loop_sale_flash - 10
			 * @hooked woocommerce_template_loop_product_thumbnail - 10
			 */
			do_action( 'woocommerce_before_shop_loop_item_title' );
		?>
        <div class="thumb_icon">
            
        </div>
		<div class="thumb_hover">
			<a href="<?php the_permalink(); ?>">
				<?php echo woocommerce_get_product_thumbnail('shop_catalog', 500, 500); ?>
			</a>
		</div>
        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>


    </div><!-- End Thumb -->
    <!-- Info -->
    <div class="info">
		<?php
			/**
			 * woocommerce_after_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_template_loop_rating - 5
			 * @hooked woocommerce_template_loop_price - 10
			 */
			do_action( 'woocommerce_after_shop_loop_item_title' );
		?>
	</div><!-- End Info -->
	<?php

		/**
		 * woocommerce_after_shop_loop_item hook
		 *
		 * @hooked woocommerce_template_loop_add_to_cart - 10
		 */
		do_action( 'woocommerce_after_shop_loop_item' ); 

	?>


</li>
