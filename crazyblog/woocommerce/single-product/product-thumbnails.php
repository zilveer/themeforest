<?php
/**
 * Single Product Thumbnails
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-thumbnails.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.6.3
 */
if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product, $woocommerce;

$attachment_ids = ($product->get_gallery_attachment_ids()) ? $product->get_gallery_attachment_ids() : array( get_post_thumbnail_id() );
crazyblog_View::get_instance()->crazyblog_enqueue_scripts( array( 'df-owl' ) );
if ( $attachment_ids ) {
	$loop = 0;

	foreach ( $attachment_ids as $attachment_id ) {

		$image_link = wp_get_attachment_url( $attachment_id );

		if ( !$image_link )
			continue;

		$image_title = esc_attr( get_the_title( $attachment_id ) );
		$image_caption = esc_attr( get_post_field( 'post_excerpt', $attachment_id ) );

		$image = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'crazyblog_200x200' ), 0, $attr = array(
			'title' => $image_title,
			'alt' => $image_title
				) );

		$image_class = '';

		echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<a href="#img%d" title="%s">%s</a>', $loop, $image_caption, $image ), $attachment_id, $post->ID, $image_class );

		$loop++;
	}
	?>
	<?php
}
?>
<?php 
    $custom_script = 'jQuery(document).ready(function ($) {
        $(".single-product-images").owlCarousel({
            autoplay: true,
            autoplayTimeout: 2500,
            smartSpeed: 2000,
            autoplayHoverPause: true,
            loop: false,
            dots: false,
            nav: false,
            margin: 0,
            mouseDrag: true,
            singleItem: true,
            URLhashListener: true,
            startPosition: "URLHash",
            autoHeight: true,
            items: 1,
            animateIn: "fadeIn",
            animateOut: "fadeOut"
        });
        $(".single-product-thumbs").owlCarousel({
            autoplay: true,
            autoplayTimeout: 2500,
            smartSpeed: 2000,
            autoplayHoverPause: true,
            loop: false,
            dots: false,
            nav: false,
            margin: 10,
            mouseDrag: true,
            autoHeight: true,
            items: 4
        });
    });';
   
    wp_add_inline_script('crazyblog_df-owl', $custom_script);