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

$classes = array(
	'product-item',
	'mobile-two',
	'columns',
	ci_theme_get_columns_classes( apply_filters( 'loop_shop_columns', 4 ) ),
);

?>
<div <?php post_class( $classes ); ?>>

	<div class="group">

		<?php
		/**
		 * woocommerce_before_shop_loop_item hook.
		 *
		 * @hooked woocommerce_template_loop_product_link_open - 10 // Removed by theme.
		 * @hooked woocommerce_template_loop_product_thumbnail - 10 // Added by theme.
		 * @hooked woocommerce_template_loop_price - 10 // Added by theme.
		 */
		do_action( 'woocommerce_before_shop_loop_item' );
		?>

		<div class="product-info title-pair">

			<?php
			/**
			 * woocommerce_before_shop_loop_item_title hook.
			 *
			 * @hooked woocommerce_show_product_loop_sale_flash - 10
			 * @hooked woocommerce_template_loop_product_thumbnail - 10 // Removed by theme.
			 */
			do_action( 'woocommerce_before_shop_loop_item_title' );

			/**
			 * woocommerce_shop_loop_item_title hook.
			 *
			 * @hooked woocommerce_template_loop_product_title - 10
			 */
			do_action( 'woocommerce_shop_loop_item_title' );

			/**
			 * woocommerce_after_shop_loop_item_title hook.
			 *
			 * @hooked woocommerce_template_loop_rating - 5 // Removed by theme.
			 * @hooked woocommerce_template_loop_price - 10 // Removed by theme.
			 * @hooked ci_woocommerce_after_shop_loop_item_title_categories - 5 // Added by theme.
			 * @hooked woocommerce_template_loop_add_to_cart - 10 // Added by theme.
			 */
			do_action( 'woocommerce_after_shop_loop_item_title' );

			/**
			 * woocommerce_after_shop_loop_item hook.
			 *
			 * @hooked woocommerce_template_loop_product_link_close - 5 // Removed by theme.
			 * @hooked woocommerce_template_loop_add_to_cart - 10 // Removed by theme.
			 */
			do_action( 'woocommerce_after_shop_loop_item' );
			?>

		</div>

	</div>

</div>
