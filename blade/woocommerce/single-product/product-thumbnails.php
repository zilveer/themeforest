<?php
/**
 * Single Product Thumbnails
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.6.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product, $woocommerce;

$attachment_ids = $product->get_gallery_attachment_ids();


//Classes
$product_gallery_classes = array( 'thumbnails' );

if ( 'yes' != get_option( 'woocommerce_enable_lightbox', '' ) && 'popup' == blade_grve_option( 'product_gallery_mode', 'popup' ) ) {
	$product_gallery_classes[] = 'grve-gallery-popup';
}

if ( $attachment_ids ) {
	$loop 		= 0;
	$columns 	= apply_filters( 'woocommerce_product_thumbnails_columns', 3 );
	$product_gallery_classes[] = 'columns-' . $columns;
	
	$product_gallery_class_string = implode( ' ', $product_gallery_classes );
	
	?>
	<div class="<?php echo esc_attr( $product_gallery_class_string ); ?>"><?php

		foreach ( $attachment_ids as $attachment_id ) {

			$classes = array( 'zoom' );

			if ( $loop === 0 || $loop % $columns === 0 ) {
				$classes[] = 'first';
			}

			if ( ( $loop + 1 ) % $columns === 0 ) {
				$classes[] = 'last';
			}

			$image_link = wp_get_attachment_url( $attachment_id );

			if ( ! $image_link )
				continue;

			$image_title 	= esc_attr( get_the_title( $attachment_id ) );
			$image_caption 	= esc_attr( get_post_field( 'post_excerpt', $attachment_id ) );

			$image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ), 0, $attr = array(
				'title'	=> $image_title,
				'alt'	=> $image_title
				) );

			$image_class = esc_attr( implode( ' ', $classes ) );

			echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<a href="%s" class="%s" title="%s" data-rel="prettyPhoto[product-gallery]">%s</a>', $image_link, $image_class, $image_caption, $image ), $attachment_id, $post->ID, $image_class );

			$loop++;
		}

	?></div>
	<?php
}
	
//Omit closing PHP tag to avoid accidental whitespace output errors.
