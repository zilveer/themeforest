<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.6.3
 */
if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $woocommerce, $product;
?>
<div class="single-product-gallery">
	<div class="single-product-images">
		<?php
		$attachment_ids = ($product->get_gallery_attachment_ids()) ? $product->get_gallery_attachment_ids() : array( get_post_thumbnail_id() );
		$loop = 0;
		foreach ( $attachment_ids as $attachment_id ) {

			$image_link = wp_get_attachment_url( $attachment_id );

			if ( !$image_link )
				continue;

			$image_title = esc_attr( get_the_title( $attachment_id ) );
			$image_caption = esc_attr( get_post_field( 'post_excerpt', $attachment_id ) );

			$image = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'crazyblog_470x540' ), 0, $attr = array(
				'title' => $image_title,
				'alt' => $image_title
					) );

			$image_class = '';

			echo apply_filters( 'woocommerce_single_product_image_big_html', sprintf( '<div data-hash="img%d" class="product-image">%s</div>', $loop, $image ), $attachment_id, $post->ID, $image_class );

			$loop++;
		}
		?>
	</div>
	<div class="single-product-thumbs">
		<?php do_action( 'woocommerce_product_thumbnails' ); ?>
	</div>
</div>
