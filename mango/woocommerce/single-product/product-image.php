<?php
/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.6.4
 */

 if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $woocommerce, $product, $mango_settings;
$zoomerActive = $mango_settings['mango_zoomer_active'];
?>

<div class="col-md-7 col-sm-7">

<div class="images product-gallery-container">

    <div class="product-top">

	<?php
        woocommerce_show_product_sale_flash();

		if ( has_post_thumbnail() ) {

			$image_title 	= esc_attr( get_the_title( get_post_thumbnail_id() ) );

			$image_caption 	= get_post( get_post_thumbnail_id() )->post_excerpt;

			$image_link  	= wp_get_attachment_url( get_post_thumbnail_id() );

			$image       	= get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(

				'title'	=> $image_title,

				'alt'	=> $image_title

				) );

            $image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'shop_single' ); //single-product //

            $image = $image['0'];

            $zoom_img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );

            $zoom_img = $zoom_img['0'];
			
			
                echo apply_filters("woocommerce_single_product_image_html", sprintf('<img class="product-zoom" src="%s" data-zoom-image="%s" data-zoom-active="%s" alt="%s"/>',$image,$zoom_img,$zoomerActive,$image_title),$post->ID );

		} else {

    			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img class="product-zoom" src="%s"  data-zoom-image="%s"data-zoom-active="%s" alt="%s" />', wc_placeholder_img_src(),wc_placeholder_img_src(),$zoomerActive, __( 'Placeholder', 'woocommerce' ) ), $post->ID );
		}
	?>

    </div>

	<?php do_action( 'woocommerce_product_thumbnails' ); ?>

</div>

</div>