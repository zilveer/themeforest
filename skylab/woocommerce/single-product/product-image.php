<?php
/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.14
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $woocommerce, $product;

?>
<div class="images">

	<?php
		if ( has_post_thumbnail() ) {
	?>
		<div id="slider" class="flexslider">
			<ul class="slides">
				<?php
				$image_title 		= esc_attr( get_the_title( get_post_thumbnail_id() ) );
				$image_link  		= wp_get_attachment_url( get_post_thumbnail_id() );
				$image       		= get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
					'title' => $image_title
					) );
					
				$thumbnail_id = get_post_thumbnail_id();
				$thumbnail_image_link = wp_get_attachment_image_src( $thumbnail_id, 'shop_thumbnail', true );
				
				$attachment_count   = count( $product->get_gallery_attachment_ids() );

				if ( $attachment_count > 0 ) {
					$gallery = '[product-gallery]';
				} else {
					$gallery = '';
				}

				echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<li><a href="%s" itemprop="image" class="woocommerce-main-image fresco" data-fresco-group="fresco-group' . $gallery . '" data-fresco-options="thumbnail: &#39;%s&#39;, loop: true, thumbnails: &#39;vertical&#39;, overflow: &#39;y&#39;">%s</a></li>', $image_link, $thumbnail_image_link[0], $image ), $post->ID );
				
				$attachment_ids = $product->get_gallery_attachment_ids();
				$loop = 0;
				foreach ( $attachment_ids as $attachment_id ) {

					$image_link = wp_get_attachment_url( $attachment_id );
					
					$thumbnail_image_link = wp_get_attachment_image_src( $attachment_id, 'shop_thumbnail', true );

					if ( ! $image_link )
						continue;

					$classes[] = 'image-'.$attachment_id;

					$image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) );
					$image_class = esc_attr( implode( ' ', $classes ) );
					$image_title = esc_attr( get_the_title( $attachment_id ) );

					echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<li><a href="%s" itemprop="image" class="woocommerce-main-image fresco" data-fresco-group="fresco-group' . $gallery . '" data-fresco-options="thumbnail: &#39;%s&#39;, loop: true, thumbnails: &#39;vertical&#39;, overflow: &#39;y&#39;">%s</a></li>', $image_link, $thumbnail_image_link[0], $image ), $post->ID );

					$loop++;
				}
				?>
			</ul>
		</div>
			
		<?php
		} else {

			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="Placeholder" />', woocommerce_placeholder_img_src() ), $post->ID );

		}
	?>

	<?php do_action( 'woocommerce_product_thumbnails' ); ?>
</div>
