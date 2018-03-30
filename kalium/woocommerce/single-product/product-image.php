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

// start: modified by Arlind
$shop_single_product_images_layout = get_data( 'shop_single_product_images_layout' );
// end: modified by Arlind

?>
<div class="<?php echo esc_attr( 'images images-layout-type-' . $shop_single_product_images_layout ); ?>">
	
	<div class="product-images-carousel nivo<?php echo in_array( $shop_single_product_images_layout, array( 'plain', 'plain-sticky' ) ) ? ' plain' : ''; echo $shop_single_product_images_layout == 'plain-sticky' ? ' sticky' : ''; ?>">
	<?php
		if ( has_post_thumbnail() ) {
			// start: modified by Arlind
			$attachment_ids = $product->get_gallery_attachment_ids();
			// end: modified by Arlind
			
			$attachment_count = count( $attachment_ids );
			$gallery          = $attachment_count > 0 ? '[product-gallery]' : '';
			$props            = wc_get_product_attachment_props( get_post_thumbnail_id(), $post );
			$image            = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
				'title'	 => $props['title'],
				'alt'    => $props['alt'],
			) );
			
			// start: modified by Arlind
			$image_class = array();
			
			if ( 'default' != $shop_single_product_images_layout ) {
				$image = get_laborator_show_image_placeholder( get_post_thumbnail_id(), apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) );
			}
			// end: modified by Arlind
			
			echo apply_filters(
				'woocommerce_single_product_image_html',
				sprintf(
					'<a href="%s" itemprop="image" class="woocommerce-main-image zoom %s" title="%s" data-rel="prettyPhoto%s">%s</a>',
					esc_url( $props['url'] ),
					implode( ' ', $image_class ),
					esc_attr( $props['caption'] ),
					$gallery,
					$image
				),
				$post->ID
			);
			
			// start: modified by Arlind
			$attachment_ids = $product->get_gallery_attachment_ids();
			
			// Remove Featured Image from the list
			if ( ( $key = array_search( get_post_thumbnail_id(), $attachment_ids ) ) !== false ) {
			    unset( $attachment_ids[ $key ] );
			}
			
			foreach ( $attachment_ids as $attachment_id ) {
				$props = wc_get_product_attachment_props( $attachment_id, $post );
				$image = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), 0, array(
					'title'	 => $props['title'],
					'alt'    => $props['alt'],
				) );
					
				$image_class = array();
					
				if ( 'default' != $shop_single_product_images_layout ) {
					$image = get_laborator_show_image_placeholder( $attachment_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) );
				} else {
					$image_class[] = 'hidden';
				}
								
				echo apply_filters(
					'woocommerce_single_product_image_html',
					sprintf(
						'<a href="%s" itemprop="image" class="woocommerce-main-image zoom %s" title="%s" data-rel="prettyPhoto%s">%s</a>',
						esc_url( $props['url'] ),
						implode( ' ', $image_class ),
						esc_attr( $props['caption'] ),
						$gallery,
						$image
					),
					$post->ID
				);
			}
			// end: modified by Arlind
			
		} else {
			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), __( 'Placeholder', 'woocommerce' ) ), $post->ID );
		}
	?>
	</div>
	
	<?php do_action( 'woocommerce_product_thumbnails' ); ?>
	
</div>
