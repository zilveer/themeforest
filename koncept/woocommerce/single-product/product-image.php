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

			$attachment_count = count( $product->get_gallery_attachment_ids() );

			if ( $attachment_count >= 1 ) {

				$gallery = '[gallery ids="';

				foreach ( $product->get_gallery_attachment_ids() as $item) {
					$gallery .= $item . ',';
				}

				$gallery .=  '" type="slider"]';

				echo do_shortcode( $gallery );

			} else {

				$img_title = esc_attr( get_the_title( get_post_thumbnail_id() ) );
				$img_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
				$retina = krown_retina();
				$img_obj = aq_resize( $img_url[0], $retina === 'true' ? 648 : 1296, null, false, false );
				echo '<img src="' . $img_obj[0] . '" width="' . $img_obj[1] . '" height="' . $img_obj[2] . '" alt="' . $img_title . '" />';

			}
			
			echo '<a class="zoom" href="#"></a>';

			//echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image zoom fancybox" title="%s"  data-fancybox-group="gallery' . $post->ID . '">%s</a>', $image_link, $image_title, $image ), $post->ID );

		} else {

			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="Placeholder" />', woocommerce_placeholder_img_src() ), $post->ID );

		}
	?>

	<?php do_action( 'woocommerce_product_thumbnails' ); ?>

</div>