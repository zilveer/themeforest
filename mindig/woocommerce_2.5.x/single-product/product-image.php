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

$size = yit_image_content_single_width();

if ( is_quick_view() ) {
    $size['image']=50;
}

?>
<div class="images" style="width:<?php echo $size['image'] ?>%;">

    <?php
    if ( has_post_thumbnail() ) {

        $image_title 		= esc_attr( get_the_title( get_post_thumbnail_id() ) );
        $image_link  		= wp_get_attachment_url( get_post_thumbnail_id() );
        $image       		= get_the_post_thumbnail( $post->ID, 'shop_single', array(
            'title' => $image_title
        ) );
        $attachment_count   = count( $product->get_gallery_attachment_ids() );

        if ( $attachment_count > 0 ) {
            $gallery = '[product-gallery]';
        } else {
            $gallery = '';
        }

        echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s" data-rel="prettyPhoto' . $gallery . '">%s</a>', $image_link, $image_title, $image ), $post->ID );

    } else {

			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), __( 'Placeholder', 'yit' ) ), $post->ID );

    }

    if ( is_quick_view() ) {
        remove_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20 );
    }

    ?>

    <?php do_action( 'woocommerce_product_thumbnails' ); ?>

</div>
