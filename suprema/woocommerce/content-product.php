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

//Get setting for product list style and create html structure based on type
$tag = suprema_qodef_options()->getOptionValue('qodef_products_list_style');

?>
<?php switch($tag) {
	case 'standard': ?>
		<li <?php post_class(); ?>>
			<div class="qodef-product-standard-image-holder">
					<?php
					/**
					 * woocommerce_before_shop_loop_item hook.
					 *
					 * @hooked woocommerce_template_loop_product_link_open - 10
					 */
					do_action( 'woocommerce_before_shop_loop_item' );
					?>
					<span class="qodef-original-image">
					<?php

					/**
					 * woocommerce_before_shop_loop_item_title hook.
					 *
					 * @hooked suprema_qodef_get_woocommerce_out_of_stock - 5
					 * @hooked woocommerce_show_product_loop_sale_flash - 10
					 * @hooked woocommerce_template_loop_product_thumbnail - 10
					 *
					 */
					do_action( 'woocommerce_before_shop_loop_item_title' );

					?>
					</span>
					<span class="qodef-hover-image">
					<?php

					/**
					 * woocommerce_before_shop_loop_item_title hook.
					 *
					 * @hooked suprema_qodef_woocommerce_shop_loop_hover_image - 10
					 *
					 */
					do_action('suprema_qodef_woocommerce_shop_loop_item_hover_image');

					?>
					</span>
					<?php

					/**
					 * woocommerce_before_shop_loop_item_title hook.
					 *
					 * @hooked woocommerce_template_loop_product_link_close - 15
					 *
					 */

					do_action('suprema_qodef_woocommerce_shop_loop_item_hover_link_close')

					?>

				<div class="qodef-product-standard-button-holder">
					<?php do_action('suprema_qodef_woocommerce_shop_loop_product_simple_button'); ?>
				</div>
			</div>
			<div class="qodef-product-standard-info-top">
				<?php

				/**
				 * suprema_qodef_woocommerce_shop_loop_item_categories hook.
				 *
				 * @hooked suprema_qodef_woocommerce_shop_loop_categories - 5
				 *
				 */
				do_action( 'suprema_qodef_woocommerce_shop_loop_item_categories' );

				/**
				 * woocommerce_shop_loop_item_title hook.
				 *
				 * @hooked woocommerce_template_loop_product_link_open - 5
				 * @hooked woocommerce_template_loop_product_title - 10
				 */
				do_action( 'woocommerce_shop_loop_item_title' );

				/**
				 * woocommerce_after_shop_loop_item_title hook.
				 *
				 * @hooked woocommerce_template_loop_rating - 5 - REMOVED
				 * @hooked woocommerce_template_loop_product_link_close - 5
				 * @hooked woocommerce_template_loop_price - 10
				 * @hooked suprema_qodef_woocommrece_template_loop_wishlist - 15
				 */
				do_action( 'woocommerce_after_shop_loop_item_title' );
				?>
			</div>
			<?php
			/**
			 * woocommerce_after_shop_loop_item hook.
			 *
			 * @hooked woocommerce_template_loop_product_link_close - 5 - REMOVED
			 * @hooked woocommerce_template_loop_add_to_cart - 10 - REMOVED			 *
			 */
			do_action( 'woocommerce_after_shop_loop_item' );
			?>
		</li>
	<?php
	break;
	case 'simple': ?>
		<li <?php post_class(); ?>>
			<div class="qodef-product-simple-holder">
				<?php
				/**
				 * woocommerce_before_shop_loop_item hook.
				 *
				 * @hooked woocommerce_template_loop_product_link_open - 10
				 */
				do_action( 'woocommerce_before_shop_loop_item' );

				/**
				 * woocommerce_before_shop_loop_item_title hook.
				 *
				 * @hooked suprema_qodef_get_woocommerce_out_of_stock - 5
				 * @hooked woocommerce_show_product_loop_sale_flash - 10
				 * @hooked woocommerce_template_loop_product_thumbnail - 10
				 * @hooked woocommerce_template_loop_product_link_close - 15
				 *
				 */
				do_action( 'woocommerce_before_shop_loop_item_title' );
				?>
				<div class="qodef-product-simple-overlay">
					<div class="qodef-product-simple-overlay-outer">
						<div class="qodef-product-simple-overlay-inner">
							<?php
							/**
							 * woocommerce_link_overlay hook.
							 *
							 * @hooked woocommerce_template_loop_product_link_open - 5
							 * @hooked woocommerce_template_loop_product_link_close - 10
							 */
							do_action( 'woocommerce_link_overlay');
							/**
							 * woocommerce_shop_loop_item_title hook.
							 *
							 * @hooked woocommerce_template_loop_product_link_open - 5
							 * @hooked woocommerce_template_loop_product_title - 10
							 */
							do_action( 'woocommerce_shop_loop_item_title' );

							/**
							 * woocommerce_after_shop_loop_item_title hook.
							 *
							 * @hooked woocommerce_template_loop_rating - 5 - REMOVED
							 * @hooked woocommerce_template_loop_product_link_close - 5
							 * @hooked suprema_qodef_woocommerce_shop_loop_categories - 5
							 * @hooked woocommerce_template_loop_price - 10
							 */
							do_action( 'woocommerce_after_shop_loop_item_title' );

							/**
							 * woocommerce_after_shop_loop_item hook.
							 *
							 * @hooked woocommerce_template_loop_product_link_close - 5 - REMOVED
							 * @hooked woocommerce_template_loop_add_to_cart - 10
							 */
							do_action( 'woocommerce_after_shop_loop_item' );
							?>
						</div>
					</div>
				</div>
			</div>
		</li>
	<?php
	break;
	case 'boxed': ?>
		<li <?php post_class(); ?>>
			<div class="qodef-product-boxed-holder">
				<?php
				/**
				 * woocommerce_before_shop_loop_item hook.
				 *
				 * @hooked woocommerce_template_loop_product_link_open - 10
				 */
				do_action( 'woocommerce_before_shop_loop_item' );

				/**
				 * woocommerce_before_shop_loop_item_title hook.
				 *
				 * @hooked suprema_qodef_get_woocommerce_out_of_stock - 5
				 * @hooked woocommerce_show_product_loop_sale_flash - 10
				 * @hooked woocommerce_template_loop_product_thumbnail - 10
				 * @hooked woocommerce_template_loop_product_link_close - 15
				 *
				 */
				do_action( 'woocommerce_before_shop_loop_item_title' );
				?>
				<div class="qodef-product-boxed-overlay">
					<div class="qodef-product-boxed-overlay-outer">
						<div class="qodef-product-boxed-overlay-inner">
							<?php
							/**
							 * woocommerce_link_overlay hook.
							 *
							 * @hooked woocommerce_template_loop_product_link_open - 5
							 * @hooked woocommerce_template_loop_product_link_close - 10
							 */
							do_action( 'woocommerce_link_overlay');

							/**
							 * woocommerce_shop_loop_item_title hook.
							 *
							 * @hooked suprema_qodef_woocommerce_shop_loop_categories - 5
							 * @hooked woocommerce_template_loop_product_link_open - 10
							 * @hooked woocommerce_template_loop_product_title - 15
							 */
							do_action( 'woocommerce_shop_loop_item_title' );

							/**
							 * woocommerce_after_shop_loop_item_title hook.
							 *
							 * @hooked woocommerce_template_loop_rating - 5 - REMOVED
							 * @hooked woocommerce_template_loop_product_link_close - 5
							 * @hooked woocommerce_template_loop_price - 10
							 */
							do_action( 'woocommerce_after_shop_loop_item_title' );

							/**
							 * woocommerce_after_shop_loop_item hook.
							 *
							 * @hooked woocommerce_template_loop_product_link_close - 5 - REMOVED
							 * @hooked woocommerce_template_loop_add_to_cart - 10 - REMOVED
							 */
							do_action( 'woocommerce_after_shop_loop_item' );
							?>
						</div>
					</div>
				</div>
			</div>
		</li>
	<?php
	break;
	default: ?>
		<li <?php post_class(); ?>>
			<div class="qodef-product-standard-image-holder">
				<?php
				/**
				 * woocommerce_before_shop_loop_item hook.
				 *
				 * @hooked woocommerce_template_loop_product_link_open - 10
				 */
				do_action( 'woocommerce_before_shop_loop_item' );

				/**
				 * woocommerce_before_shop_loop_item_title hook.
				 *
				 * @hooked suprema_qodef_get_woocommerce_out_of_stock - 5
				 * @hooked woocommerce_show_product_loop_sale_flash - 10
				 * @hooked woocommerce_template_loop_product_thumbnail - 10
				 * @hooked woocommerce_template_loop_product_link_close - 15
				 *
				 */
				do_action( 'woocommerce_before_shop_loop_item_title' );
				?>

				<div class="qodef-product-standard-button-holder">
					<?php
					do_action('suprema_qodef_woocommerce_shop_loop_product_simple_button');
					?>
				</div>
			</div>
			<div class="qodef-product-standard-info-top">
				<?php

				/**
				 * suprema_qodef_woocommerce_shop_loop_item_categories hook.
				 *
				 * @hooked suprema_qodef_woocommerce_shop_loop_categories - 5
				 *
				 */
				do_action( 'suprema_qodef_woocommerce_shop_loop_item_categories' );

				/**
				 * woocommerce_shop_loop_item_title hook.
				 *
				 * @hooked woocommerce_template_loop_product_link_open - 5
				 * @hooked woocommerce_template_loop_product_title - 10
				 */
				do_action( 'woocommerce_shop_loop_item_title' );

				/**
				 * woocommerce_after_shop_loop_item_title hook.
				 *
				 * @hooked woocommerce_template_loop_rating - 5 - REMOVED
				 * @hooked woocommerce_template_loop_product_link_close - 5
				 * @hooked woocommerce_template_loop_price - 10
				 */
				do_action( 'woocommerce_after_shop_loop_item_title' );
				?>
			</div>
			<?php
			/**
			 * woocommerce_after_shop_loop_item hook.
			 *
			 * @hooked woocommerce_template_loop_product_link_close - 5 - REMOVED
			 * @hooked woocommerce_template_loop_add_to_cart - 10 - REMOVED			 *
			 */
			do_action( 'woocommerce_after_shop_loop_item' );
			?>
		</li>
<?php } ?>