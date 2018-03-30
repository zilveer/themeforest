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

$attachment_ids = $product->get_gallery_attachment_ids(); ?>
<div class="images">
	<?php
	//first the big images
	if ( ! empty( $attachment_ids ) ) {
		// since we removed the sale-flash from his hood, add it back here inside the image wrapper
		wc_get_template( 'single-product/sale-flash.php' );

		//what would we do without a wrapper - all hope would be lost
		echo '<div class="big-images">' . PHP_EOL;

		//output markup for each gallery image so we can work with Responsive Images properly
		$loop = 0;
		foreach ( $attachment_ids as $attachment_id ) {
			$image_caption 			= get_post( $attachment_id )->post_excerpt;
			$image_link    			= wp_get_attachment_url( $attachment_id );
			$image         			= wp_get_attachment_image ( $attachment_id, 'full-size', array(
				'title'	=> get_the_title( $attachment_id )
			));

			$classes = array( 'woocommerce-main-image' );

			//at first, the first image is the current one
			if ( $loop == 0 ) {
				$classes[] = 'current';
			}

			$image_class = esc_attr( implode( ' ', $classes ) );

			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<div class="%s">%s</div>', $image_class, $image ), $post->ID ) . PHP_EOL;

			$loop++;
		}

		echo '</div><!-- .big-images -->' . PHP_EOL;

	} else {

		echo '<div class="big-images">' . apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), __( 'Placeholder', 'woocommerce' ) ), $post->ID ) . '</div><!-- .big-images -->' . PHP_EOL;

	}
	
	//now the thumbnails
	do_action( 'woocommerce_product_thumbnails' ); ?>

</div><!-- .images -->
