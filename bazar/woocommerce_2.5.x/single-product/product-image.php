<?php
/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.14
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

global $post, $woocommerce, $product;

?>
<div class="images">

    <?php
    if ( has_post_thumbnail() ) {

        $image_title = esc_attr( get_the_title( get_post_thumbnail_id() ) );
        $image_link  = wp_get_attachment_url( get_post_thumbnail_id() );
        $image       = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
            'title' => $image_title
        ) );

        $attachment_count = count( $product->get_gallery_attachment_ids() );

        if ( $attachment_count > 0 ) {
            $gallery = '[product-gallery]';
        }
        else {
            $gallery = '';
        }

        echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s"  data-rel="prettyPhoto' . $gallery . '">%s</a>', $image_link, $image_title, $image ), $post->ID );

    }   else {

        echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), __( 'Placeholder', 'yit' ) ), $post->ID );

    }
    ?>

	<?php do_action('woocommerce_product_thumbnails'); ?>

</div>

<script>

    /* -------------- *
     * Temporary fix! *
     * -------------- */

    jQuery(document).ready(function($){

        var yith_wcmg = $('.images');
        var yith_wcmg_zoom  = $('.woocommerce-main-image');
        var yith_wcmg_image = $('.woocommerce-main-image img.wp-post-image');
        var yith_wcmg_default_zoom = yith_wcmg.find('.woocommerce-main-image').attr('href');
        var yith_wcmg_default_image = yith_wcmg.find('.woocommerce-main-image img.wp-post-image').attr('src');
        var yith_wcmg_default_title = yith_wcmg.find('.woocommerce-main-image').attr('title');

        $( document ).on( 'found_variation', 'form.variations_form', function( event, variation ) {

            var image_magnifier = variation.image_link ? variation.image_link : yith_wcmg_default_zoom;
            var image_src       = variation.image_src ? variation.image_src : yith_wcmg_default_image;
            var image_title      = variation.image_title ? variation.image_title : yith_wcmg_default_title;
            yith_wcmg_zoom.attr('href', image_magnifier);
            yith_wcmg_image.attr('src', image_src);
            yith_wcmg_image.attr('alt', image_title);
            yith_wcmg_zoom.attr('title', image_title);

        }).on( 'reset_image', function( event ) {

                yith_wcmg_zoom.attr('href', yith_wcmg_default_zoom);
                yith_wcmg_image.attr('src', yith_wcmg_default_image);
                yith_wcmg_image.attr('alt', yith_wcmg_default_title);
                yith_wcmg_zoom.attr('title', yith_wcmg_default_title);

        });

        $( 'form.variations_form .variations select').trigger('change');

    });

</script>