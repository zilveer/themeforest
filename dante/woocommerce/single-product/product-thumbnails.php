<?php
/**
 * Single Product Thumbnails
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product, $woocommerce;

$attachment_ids = array();

if ( version_compare( WOOCOMMERCE_VERSION, "2.0.0" ) >= 0 ) {

$attachment_ids = $product->get_gallery_attachment_ids();

} else {

$attachment_ids = get_posts( array(
	'post_type' 	=> 'attachment',
	'numberposts' 	=> -1,
	'post_status' 	=> null,
	'post_parent' 	=> $post->ID,
	'post_mime_type'=> 'image',
	'orderby'		=> 'menu_order',
	'order'			=> 'ASC'
) );

}

if ( $attachment_ids ) {
	?>
	<?php

		$loop = 0;
		$columns = apply_filters( 'woocommerce_product_thumbnails_columns', 3 );

		foreach ( $attachment_ids as $attachment_id ) {

			$classes = array( 'zoom' );

			if ( $loop == 0 || $loop % $columns == 0 )
				$classes[] = 'first';

			if ( ( $loop + 1 ) % $columns == 0 )
				$classes[] = 'last';

			$image_link = wp_get_attachment_url( $attachment_id );

			if ( ! $image_link )
				continue;

			$image = wp_get_attachment_image_src( $attachment_id, 'shop_thumbnail' );

			$image_class = esc_attr( implode( ' ', $classes ) );
			$image_title = esc_attr( get_the_title( $attachment_id ) );
			$image_alt = esc_attr( sf_get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true) );

			if ($image) {

				$image_html = '<img src="'.$image[0].'" width="'.$image[1].'" height="'.$image[2].'" alt="'.$image_alt.'" title="'.$image_title.'" />';

				echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '%s', $image_html ), $attachment_id, $post->ID, $image_class );

			}

			$loop++;
		}

	?>
	<?php
} ?>