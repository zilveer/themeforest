<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.6.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post, $product;
?>
<div class="images col-sm-6">
	<div class="kleo-images-wrapper">
	<?php
		if ( has_post_thumbnail() ) {
			$attachment_count   = count( $product->get_gallery_attachment_ids() );
			$gallery            = $attachment_count > 0 ? '[product-gallery]' : '';
			$image_title 		= esc_attr( get_the_title( get_post_thumbnail_id() ) );
			$image_link  		= wp_get_attachment_url( get_post_thumbnail_id() );

			add_filter( 'wp_get_attachment_image_attributes', 'sq_remove_img_srcset');

			$image       		= get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
				'title' => $image_title
			) );

			remove_filter( 'wp_get_attachment_image_attributes', 'sq_remove_img_srcset');

			echo apply_filters(
				'woocommerce_single_product_image_html',
				sprintf(
					'<a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s">%s</a>',
					$image_link,
					$image_title,
					$image
				),
				$post->ID
			);

		} else {
			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), __( 'Placeholder', 'woocommerce' ) ), $post->ID );
		}

		echo '<div class="woo-main-image-nav"><a class="kleo-woo-prev" href="#"><i class="icon-angle-left"></i></a>'
				. '<a class="kleo-woo-next" href="#"><i class="icon-angle-right"></i></a></div>';

		do_action( 'woocommerce_product_thumbnails' );
	?>
	</div>
</div>