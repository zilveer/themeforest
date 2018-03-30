<?php
/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     19.0.14
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $woocommerce, $product;

$attachment_ids = $product->get_gallery_attachment_ids();
?>
<div class="berg-product-carousel-wrapper gallery-top swiper-container">
	<?php if ( ! $product->is_in_stock() ) : ?>
	<span class="onsale out-of-stock-button"><span><?php echo apply_filters( 'out_of_stock_add_to_cart_text', __( 'Out of stock', 'woocommerce' ) ); ?></span></span>
	<?php else :?>
	<?php if ( $product->is_on_sale() ) : ?>
	<span class="onsale on-sale-button"><span><?php echo apply_filters( 'sale_add_to_cart_text', __( 'Sale!', 'woocommerce' ) ); ?></span></span>
	<?php endif;?>
	<?php endif;?>
	<div class="swiper-wrapper berg-product-carousel" id="product-carousel">
		<?php
			//if (count($attachment_ids) > 1) {
				/* Gallery Images */
				
				if (has_post_thumbnail()) {
					$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'blog_thumb');
					echo '<div class="swiper-slide"><figure><img src="'.$large_image_url[0].'" alt=""/></figure></div>';
				}
				$loop = 0;
				$columns = apply_filters( 'woocommerce_product_thumbnails_columns', 3 );

				foreach ($attachment_ids as $attachment_id) {

					$classes = array( 'zoom' );

					if ( $loop == 0 || $loop % $columns == 0 ) {
						$classes[] = 'first';
					}

					if ( ( $loop + 1 ) % $columns == 0 ) {
						$classes[] = 'last';
					}

					$image_link = wp_get_attachment_url( $attachment_id );

					if ( ! $image_link ) {
						continue;
					}

					$image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'blog_thumb' ) );
					$image_class = esc_attr( implode( ' ', $classes ) );
					$image_title = esc_attr( get_the_title( $attachment_id ) );

					echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<div class="swiper-slide"><figure>%s</figure></div>', $image ), $post->ID );
					$loop++;
				}
			//}
		?>
	</div>
	<div class="swiper-next"><i class="arrow-right-open"></i></div>
	<div class="swiper-prev"><i class="arrow-left-open"></i></div>
</div>