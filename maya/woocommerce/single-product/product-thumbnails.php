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
?>
<div class="thumbnails"><?php

    $attachment_ids = $product->get_gallery_attachment_ids();

    if ( $attachment_ids ) {

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

            if( ! apply_filters( 'yit_fix_wordpress_external_image_issue', false ) ) {
                $image = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ) );
            } else {
                $shop_thumbnail_size = wc_get_image_size( 'shop_thumbnail' );
                // Get Info about the file
                $thumb_info = pathinfo( $image_link );
                extract( $thumb_info );

                $thumbnail_src  = ( $dirname . '/' . $filename ) . '-' . $shop_thumbnail_size['width'] . 'x' . $shop_thumbnail_size['height'] . '.' . $extension;
                $image          = '<img src="' . $thumbnail_src . '" width="' . $shop_thumbnail_size['width'] . '" height="' . $shop_thumbnail_size['width'] . '" />';
            }

            $image_class = esc_attr( implode( ' ', $classes ) );
            $image_title = esc_attr( get_the_title( $attachment_id ) );

            echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<a href="%s" class="%s" title="%s" data-rel="prettyPhoto[product-gallery]">%s</a>', $image_link, $image_class, $image_title, $image ), $attachment_id, $post->ID, $image_class );

            $loop++;
        }

    }
    ?></div>