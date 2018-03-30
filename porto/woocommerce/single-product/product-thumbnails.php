<?php
/**
 * Single Product Thumbnails
 *
 * @version     2.6.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post, $woocommerce, $product;

$attachment_ids = $product->get_gallery_attachment_ids();

?>
<div class="product-thumbnails thumbnails">
    <?php
    $html = '<div class="product-thumbs-slider owl-carousel">';

    if ( has_post_thumbnail() ) {

        $attachment_id = get_post_thumbnail_id();
        $image_title = esc_attr( get_the_title( $attachment_id ) ); if (!$image_title) $image_title = '';
        $image_thumb_link = wp_get_attachment_image_src($attachment_id, 'shop_thumbnail');

        $html .= '<div class="img-thumbnail">';
        $html .= apply_filters( 'woocommerce_single_product_image_thumbnail_html', '<img class="woocommerce-main-thumb img-responsive" alt="' . $image_title . '" src="' . $image_thumb_link[0] . '" />', $attachment_id, $post->ID, '');
        $html .= '</div>';

    } else {

        $image_thumb_link = wc_placeholder_img_src();
        $html .= '<div class="img-thumbnail"><div class="inner">';
        $html .= apply_filters( 'woocommerce_single_product_image_thumbnail_html', '<img class="woocommerce-main-thumb img-responsive" alt="" src="' . $image_thumb_link . '" />', false, $post->ID, '');
        $html .= '</div></div>';
    }

    if ( $attachment_ids ) {
        foreach ( $attachment_ids as $attachment_id ) {

            $image_link = wp_get_attachment_url( $attachment_id );

            if ( ! $image_link )
                continue;

            $image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ) );
            $image_thumb_link = wp_get_attachment_image_src($attachment_id, 'shop_thumbnail');
            $image_title = esc_attr( get_the_title( $attachment_id ) ); if (!$image_title) $image_title = '';

            $html .= '<div class="img-thumbnail">';
            $html .= apply_filters( 'woocommerce_single_product_image_thumbnail_html', '<img class="img-responsive" alt="' . $image_title . '" src="' . $image_thumb_link[0] . '" />', $attachment_id, $post->ID, '');
            $html .= '</div>';

        }
    }

    $html .= '</div>';

    echo $html;

    ?>
</div>
