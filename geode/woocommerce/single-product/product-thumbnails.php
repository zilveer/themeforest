<?php
/**
 * Single Product Thumbnails
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.6.3
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product, $woocommerce;

$attachment_ids = $product->get_gallery_attachment_ids();
$attachment_gals = array();
$attachment_vars = array();

if ( $attachment_ids ) {
	foreach ($attachment_ids as $key => $value) {
		if ( wp_get_attachment_image( $value, apply_filters( 'single_product_small_thumbnail_size', 'shop_catalog' ), '') != '' ) {
			$attachment_gals[$key] = $value;
		}
	}
} 
if ( $product->is_type( array( 'variable' ) ) ) {
	$available_variations = $product->get_available_variations();

	$loop = 0;
	foreach ( $available_variations as $variation ) {

		$image_link =  $variation['image_link'];

		if ( $image_link )
			$attachment_vars[$loop] = 'true'; //just to check if the variations has got some images

		$loop++;
	}
}

if ( (count($attachment_gals)>0) || count($attachment_vars)>0 ) {
	?>
	<div class="thumbnails" data-grid="<?php echo apply_filters('geode_isotope_thumbnail_layout', 'masonry'); ?>"><?php

		$loop = 0;

		if ( $product->is_type( array( 'variable' ) ) ) {
			$available_variations = $product->get_available_variations();

			foreach ( $available_variations as $variation ) {

				$classes = $loop == 0 ? array( 'selected' ) : array();
				$classes[] = 'nocolorbox';

				$image_class = esc_attr( implode( ' ', $classes ) );

				$image_link =  $variation['image_link'];
				$attachment_id = pix_attachment_meta_by_url($image_link);
				$attachment_id = $attachment_id['id'];

				$image_shop  = wp_get_attachment_image_src( $attachment_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) );

				if ( ! $image_link )
					continue;

				$props       = wc_get_product_attachment_props( $attachment_id, $post );

				if ( ! $props['url'] ) {
					continue;
				}

				echo apply_filters(
					'woocommerce_single_product_image_thumbnail_html',
					sprintf(
						'<span class="product-gallery-th"><a href="%s" class="%s" title="%s" data-href="%s">%s</a><span class="hidden"><a href="%s" data-rel="prettyPhoto"></a></span></span>',
						esc_url( $props['url'] ),
						esc_attr( $image_class ),
						esc_attr( $props['caption'] ),
						$image_shop[0],
						wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ), 0, $props ),
						$image_link
					),
					$attachment_id,
					$post->ID,
					esc_attr( $image_class )
				);

				$loop++;
			}
		} else {

			$first_classes = array( 'selected' );
			$first_classes[] = 'nocolorbox';
			$first_title 		= esc_attr( get_the_title( get_post_thumbnail_id() ) );
			$first_link  		= wp_get_attachment_url( get_post_thumbnail_id() );
			$first_shop  		= wp_get_attachment_image_src( get_post_thumbnail_id(), apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) );
			$first_class = esc_attr( implode( ' ', $first_classes ) );
			$first       		= get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_thumbnail' ), array(
				'title' => $first_title
				) );

			echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<span class="product-gallery-th"><a href="%s" class="%s" title="%s" data-href="%s">%s</a><span class="hidden"><a href="'.$first_link.'" data-rel="prettyPhoto"></a></span></span>', $first_link, $first_class, $first_title, $first_shop[0], $first ), get_post_thumbnail_id(), $post->ID, $first_class );

		}

		foreach ( $attachment_ids as $attachment_id ) {

			$classes = array( 'zoom' );
			$classes[] = 'nocolorbox';

			$image_link = wp_get_attachment_url( $attachment_id );

			if ( ! $image_link )
				continue;

			$image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ) );
			$image_shop  = wp_get_attachment_image_src( $attachment_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) );
			$image_title = esc_attr( get_the_title( $attachment_id ) );
			$image_class = esc_attr( implode( ' ', $classes ) );

			echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<span class="product-gallery-th"><a href="%s" class="%s" title="%s" data-href="%s">%s</a><span class="hidden"><a href="'.$image_link.'" data-rel="prettyPhoto"></a></span></span>', $image_link, $image_class, $image_title, $image_shop[0], $image ), $attachment_id, $post->ID, $image_class );
		}

	?></div>
	<?php
}