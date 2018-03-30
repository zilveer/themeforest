<?php

// =============================================================================
// WOOCOMMERCE/SINGLE-PRODUCT/PRODUCT-IMAGE.PHP
// -----------------------------------------------------------------------------
// @version 2.6.3
// =============================================================================

// Template Changes
// ----------------
// 01. Add product sale flash.
// 02. Add classes to linked image (.x-img, .x-img-link, .x-img-thumbnail,
//     and .man).
// 03. Add class to image (.x-img-thumbnail) and update text domain.

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post, $product;
?>
<div class="images">
	<?php
	  woocommerce_show_product_sale_flash(); // 01
		if ( has_post_thumbnail() ) {
			$attachment_count = count( $product->get_gallery_attachment_ids() );
			$gallery          = $attachment_count > 0 ? '[product-gallery]' : '';
			$props            = wc_get_product_attachment_props( get_post_thumbnail_id(), $post );
			$image            = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
				'title'	 => $props['title'],
				'alt'    => $props['alt'],
			) );
			echo apply_filters(
				'woocommerce_single_product_image_html',
				sprintf(
					'<a href="%s" itemprop="image" class="woocommerce-main-image zoom x-img x-img-link x-img-thumbnail man" title="%s" data-rel="prettyPhoto%s">%s</a>', // 02
					esc_url( $props['url'] ),
					esc_attr( $props['caption'] ),
					$gallery,
					$image
				),
				$post->ID
			);
		} else {
			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" class="x-img-thumbnail" alt="%s" />', wc_placeholder_img_src(), __( 'Placeholder', '__x__' ) ), $post->ID ); // 03
		}

		do_action( 'woocommerce_product_thumbnails' );
	?>
</div>