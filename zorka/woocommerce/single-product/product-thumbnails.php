<?php
/**
 * Single Product Thumbnails
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product, $woocommerce;

$index = 0;
$attachment_ids = $product->get_gallery_attachment_ids();
if ($product->product_type == 'variable') {
    $available_variations = $product->get_available_variations();
    $selected_attributes = $product->get_variation_default_attributes();
}
?>
<div id="sync2" class="owl-carousel manual">
    <?php
        if (has_post_thumbnail()) {
        $image_title 	= esc_attr( get_the_title( get_post_thumbnail_id() ) );
        $image_caption 	= get_post( get_post_thumbnail_id() )->post_excerpt;
        $image_link  	= wp_get_attachment_url( get_post_thumbnail_id() );
        $image       	= get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ), array(
            'title'	=> $image_title,
            'alt'	=> $image_title
        ) );

        echo '<div class="thumbnail-image">';
        echo  apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-thumbnail-image" title="%s" data-index="%s">%s</a>', $image_link, $image_caption,$index , $image), $post->ID );
        echo '</div>';
        $index++;
        }

        if (isset($available_variations)){
            foreach ($available_variations as $available_variation){
                $variation_id = $available_variation['variation_id'];
                if (has_post_thumbnail($variation_id)) {

                    $image_title 	= esc_attr( get_the_title( $variation_id ) );
                    $image_caption 	= get_post( $variation_id )->post_excerpt;
                    $image_link  	= wp_get_attachment_url( get_post_thumbnail_id($variation_id));

                    $image       	= get_the_post_thumbnail( $variation_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ), array(
                        'title'	=> $image_title,
                        'alt'	=> $image_title
                    ) );


                    echo '<div class="thumbnail-image">';
                    echo  apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-thumbnail-image" title="%s" data-variation_id="%s" data-index="%s">%s</a>', $image_link, $image_caption,$variation_id,$index,  $image ), $post->ID );
                    echo '</div>';
                    $index++;
                }
            }
        }

        if($attachment_ids) {
            foreach ( $attachment_ids as $attachment_id ) {
                $image_link = wp_get_attachment_url( $attachment_id );
                if ( ! $image_link ) {
                    continue;
                }

                $image_title 	= esc_attr( get_the_title( $attachment_id ) );
                $image_caption 	= get_post( $attachment_id )->post_excerpt;

                $image       	= wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ), array(
                    'title'	=> $image_title,
                    'alt'	=> $image_title
                ) );

                echo '<div class="thumbnail-image">';
                echo  apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-thumbnail-image" title="%s" data-index="%s">%s</a>', $image_link, $image_caption,$index, $image ), $post->ID );
                echo '</div>';
                $index++;

            }
        }
    ?>
</div>


