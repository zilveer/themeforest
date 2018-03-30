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

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) ) {
	$woocommerce_loop['loop'] = 0;
}

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) ) {
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
}

// Ensure visibility
if ( ! $product || ! $product->is_visible() ) {
	return;
}

// Extra post classes
$classes = array( 'pile-item', 'pile-item--archive', 'one-whole', 'lap-one-half', 'desk-one-third', 'pile-item--product' );

$aspect_ratio_class = '';
$aspect_ratio = pile_option( 'products_archive_thumbnails_aspect_ratio' );

if ( ! empty( $aspect_ratio ) && $aspect_ratio !== 'original' ) {
	$aspect_ratio_class = 'pile-aspect-ratio--' . $aspect_ratio;
	$classes[] = $aspect_ratio_class;
}

// Increase loop count
$woocommerce_loop['loop']++;

//if this product has a featured image, we need to determine if it has a portrait aspect ratio
$image_is_portrait = false;
if ( has_post_thumbnail() ) {
	//we need to get the 'full' size since other sizes can get screwed by Jetpack (they return 0 sizes)
	$attachment = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
	if ( $attachment[2] >= $attachment[1] ) {
		$image_is_portrait = true;
	}
} else {
	$classes[] = 'no-image';
} ?>

<div <?php post_class( $classes ); ?>>

	<div class="pile-item-even-spacing">
	<div class="pile-item-negative-spacing">

		<?php if ( $image_is_portrait ) : ?>
		<div class="pile-item-portrait-spacing">
		<?php endif; ?>
		<div class="pile-item-wrap">

		<?php
		/**
		 * woocommerce_before_shop_loop_item hook.
		 *
		 * @hooked woocommerce_template_loop_product_link_open - 10
		 */
		do_action( 'woocommerce_before_shop_loop_item' ); ?>

			<?php if ( has_post_thumbnail() ) {
				$id = get_post_thumbnail_id( get_the_ID() );
				$markup = '';

				//just use a decent sized image
				$image_full_size = wp_get_attachment_image_src( $id, 'full-size' );
				$image_markup = '<img src="' . esc_url( $image_full_size[0] ) . '" alt="' . esc_attr( pile_get_img_alt( $id ) ) . '">';
				$image_meta = get_post_meta( $id, '_wp_attachment_metadata', true );
				$markup .= wp_image_add_srcset_and_sizes( $image_markup, $image_meta, $id ) . PHP_EOL;

				echo $markup;
			} ?>

			<?php
			/**
			 * woocommerce_before_shop_loop_item_title hook.
			 *
			 * @hooked woocommerce_show_product_loop_sale_flash - 10
			 * @hooked woocommerce_template_loop_product_thumbnail - 10
			 */
			do_action( 'woocommerce_before_shop_loop_item_title' ); ?>

			<div class="pile-item-content">
				<?php the_title('<h2 class="pile-item-title">', '</h2>'); ?>
				<div class="pile-item-link">
					<?php
					/**
					 * woocommerce_after_shop_loop_item_title hook.
					 *
					 * @hooked woocommerce_template_loop_rating - 5
					 * @hooked woocommerce_template_loop_price - 10
					 */
					do_action( 'woocommerce_after_shop_loop_item_title' ); ?>
				</div>
			</div>
			<div class="pile-item-bg"></div>
			<div class="pile-item-border" style="border-color: #333;"></div>
		<?php
		/**
		 * woocommerce_after_shop_loop_item hook.
		 *
		 * @hooked woocommerce_template_loop_product_link_close - 5
		 * @hooked woocommerce_template_loop_add_to_cart - 10
		 */
		do_action( 'woocommerce_after_shop_loop_item' ); ?>
		</div><!-- .pile-item-wrap -->
		<?php if ( $image_is_portrait ) : ?>
		</div><!-- .pile-item-portrait-spacing -->
		<?php endif; ?>

	</div><!-- .pile-item-even-spacing -->
	</div><!-- .pile-item-negative-spacing -->

</div><!-- .pile-item.pile-item-archive -->