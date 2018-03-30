<?php
/**
 * Single Product Thumbnails
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product, $woocommerce;

$attachment_ids = $product->get_gallery_attachment_ids();
if(has_post_thumbnail()){
    if(empty($attachment_ids)){
        $attachment_ids[] = get_post_thumbnail_id($post->ID);
    }else{
        array_unshift ( $attachment_ids ,  get_post_thumbnail_id($post->ID) );
    }
}

if ( $attachment_ids ) {
	$loop 		= 0;
	$columns 	= apply_filters( 'woocommerce_product_thumbnails_columns', 3 );
	?>
	<div class="product-gallery-wrapper thumbnails <?php echo 'columns-' . $columns; ?>">
    <div class="owl-carousel product-gallery">
        <?php

		foreach ( $attachment_ids as $attachment_id ) {

/*			$classes = array( 'zoom' );

			if ( $loop == 0 || $loop % $columns == 0 )
				$classes[] = 'first';

			if ( ( $loop + 1 ) % $columns == 0 )
				$classes[] = 'last';
*/

			//if ( ! $image_link )
			//	continue;
			$image        = wp_get_attachment_image_src( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_single' ) );
            $image_zoom   = wp_get_attachment_image_src( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'full' ) );
			$image_class = 'product-gallery-item';
			$image_title = esc_attr( get_the_title( $attachment_id ) );
			echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<a href="#" data-image="%s" data-zoom-image="%s" class="%s" title="%s"><img src="%s" alt="%s"/></a>', $image[0],$image_zoom[0],$image_class, $image_title, $image[0],$image_title), $attachment_id, $post->ID, $image_class );
			$loop++;
		}

	?></div>
    </div>
	<?php
}