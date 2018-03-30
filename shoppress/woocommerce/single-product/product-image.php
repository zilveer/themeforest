<?php
/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.14
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $woocommerce, $product, $gp_settings, $dirname;

?>
<div class="images">

	<?php
		if ( has_post_thumbnail() ) {

			$image_title 		= esc_attr( get_the_title( get_post_thumbnail_id() ) );
			
			if(get_post_meta(get_post_thumbnail_id(), '_'.$dirname.'_lightbox_url', true)) {
				$image_link = 'file='.get_post_meta(get_post_thumbnail_id(), '_'.$dirname.'_lightbox_url', true);
			} else {
				$image_link = wp_get_attachment_url( get_post_thumbnail_id() );
			}
			
			$image       		= get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
				'title' => $image_title
				) );
			$attachment_count   = count( $product->get_gallery_attachment_ids() );

			if($gp_settings['image_effect'] == "Zoom") {
				$classes =  ' czoom';
			} else {	
				$classes = '';
			}
						
	

			if ( $attachment_count != 1 ) {
				$gallery = '[product-gallery]';
			} else {
				$gallery = '';
			}
		
			if($gp_settings['image_effect'] == "Lightbox") {
				$pi_lightbox = 'rel="prettyPhoto'.$gallery.'"';
			} else {
				$pi_lightbox = '';
			}
		
			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image zoom'.$classes.'" title="%s" '.$pi_lightbox.'>%s</a>', $image_link, $image_title, $image ), $post->ID );

		} else {

			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="Placeholder" />', woocommerce_placeholder_img_src() ), $post->ID );

		}
	?>

	<?php do_action( 'woocommerce_product_thumbnails' ); ?>

</div>