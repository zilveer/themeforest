<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woothemes.com/document/template-structure/
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

$classes = array();

if(hue_mikado_product_has_gallery()) {
	$classes[] = 'mkd-woo-product-with-gallery';
}

?>
<li <?php post_class($classes); ?>>

	<?php do_action('woocommerce_before_shop_loop_item'); ?>
	<div class="mkd-woo-product-image-holder">
		<a href="<?php the_permalink(); ?>">
			<?php
			/**
			 * woocommerce_before_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_show_product_loop_sale_flash - 10
			 * @hooked woocommerce_template_loop_product_thumbnail - 10
			 */
			do_action('woocommerce_before_shop_loop_item_title');
			?>
		</a>

		<?php do_action('hue_mikado_woo_after_product_image_link'); ?>
	</div>

	<a class="mkd-woo-product-info-holder" href="<?php the_permalink(); ?>">
		<?php
		/**
		 * woocommerce_shop_loop_item_title hook
		 *
		 * @hooked woocommerce_template_loop_rating - 5
		 * @hooked woocommerce_template_loop_product_title - 10
		 */
		do_action('woocommerce_shop_loop_item_title');

		/**
		 * woocommerce_after_shop_loop_item_title hook
		 *
		 * @hooked woocommerce_template_loop_price - 10
		 */
		do_action('woocommerce_after_shop_loop_item_title');
		?>

	</a>

	<?php

	/**
	 * woocommerce_after_shop_loop_item hook
	 *
	 * @hooked woocommerce_template_loop_add_to_cart - 10
	 */
	do_action('woocommerce_after_shop_loop_item');

	?>

</li>
