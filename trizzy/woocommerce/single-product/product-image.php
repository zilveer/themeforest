<?php
/**
 * Single Product Image
 *
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     2.0.14
* @modified    purethemes
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
global $post, $product, $woocommerce;
$gallerytype = ot_get_option('pp_product_default_gallery','off');



$layout         = get_post_meta($post->ID, 'pp_sidebar_layout', TRUE);
if(empty($layout)) { $layout = 'full-width'; }
$sliderstyle    = get_post_meta($post->ID, 'pp_woo_thumbnail_style', TRUE);

if($gallerytype == 'on') { ?>
<?php echo $layout != 'full-width' ? '<div class="six columns alpha">' : '<div class="eight columns">'; ?>
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
                } else {
                    $gallery = '';
                }

                echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s" data-rel="prettyPhoto' . $gallery . '">%s</a>', $image_link, $image_title, $image ), $post->ID );

            } else {

                echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), __( 'Placeholder', 'trizzy' ) ), $post->ID );

            }
        ?>

        <?php do_action( 'woocommerce_product_thumbnails' ); ?>

    </div>
</div>
<?php } else { ?>
<?php echo $layout != 'full-width' ? '<div class="six columns alpha">' : '<div class="eight columns">'; ?>
    <div class="slider-padding ">

        <?php
        if ( has_post_thumbnail() ) {

            $image_title        = esc_attr( get_the_title( get_post_thumbnail_id() ) );
            $image_link         = wp_get_attachment_url( get_post_thumbnail_id() );

            $image              = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'shop_single' );
            $imageRSthumb       = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'shop-small-thumb' );
            $attachment_ids     = $product->get_gallery_attachment_ids();
            $attachment_count   = count( $product->get_gallery_attachment_ids() );
            $output = '';

            if ( $attachment_count > 0 ) { // many images, use flexslider
     
            $output .='<div id="'.($sliderstyle == 'horizontal' ? 'product-slider' : 'product-slider-vertical').'" class="royalSlider rsDefault">';
                 //first, get the main thumbnail
                $output .='<a href="'.$image_link.'" itemprop="image" class="mfp-gallery" title="'.$image_title.'">
                               <img src="'.$image[0].'" class="rsImg" data-rsTmb="'.$imageRSthumb[0].'" />
                           </a><!-- Main THumbnails -->';
                //2nd, get the hover image if exists
                $hover = get_post_meta($post->ID, 'pp_featured_hover', TRUE);
                if($hover) {
                    $hoverimage = wp_get_attachment_image_src($hover, 'shop_single');
                    $image_hover_title    = esc_attr( get_the_title( $hover ) );
                    $hoverimagefull = wp_get_attachment_image_src($hover, 'full');
                    $hoverimageRSthumb = wp_get_attachment_image_src($hover, 'shop-small-thumb');
                    $output .= '<a href="'.$hoverimagefull[0].'" class="mfp-gallery" title="'.$image_hover_title.'"><img class="rsImg" src="'.$hoverimage[0].'"  data-rsTmb="'.$hoverimageRSthumb[0].'" alt="'.$image_hover_title.'"/></a><!-- hover image THumbnails -->';
                }
                //get rest of images
                foreach ( $attachment_ids as $attachment_id ) {
                    $image          = wp_get_attachment_image_src( $attachment_id, 'shop_single');
                    $imageRSthumb   = wp_get_attachment_image_src( $attachment_id, 'shop-small-thumb' );
                    $image_title    = esc_attr( get_the_title( $attachment_id ) );
                    $output .= '<a href="'.$image[0].'" class="mfp-gallery" title="'.$image_title.'"><img class="rsImg" src="'.$image[0].'" data-rsTmb="'.$imageRSthumb[0].'" /></a><!-- rest of images -->';
                }
            $output .='</div> <!-- eof royal -->';

            } else { // just one image

            $hover = get_post_meta($post->ID, 'pp_featured_hover', TRUE);
            $image_hover_title    = esc_attr( get_the_title( $hover ) );
                if($hover) {
                    $output .='<div id="'.($sliderstyle == 'horizontal' ? 'product-slider' : 'product-slider-vertical').'" class="royalSlider rsDefault images">';
                    $output .='<a href="'.$image_link.'" itemprop="image" class="mfp-gallery" title="'.$image_title.'"><img src="'.$image[0].'" class="rsImg" alt="'.$image_title.'" data-rsTmb="'.$imageRSthumb[0].'" /></a><!-- singel main THumbnails -->';
                } else {
                    $output .='<div id="product-slider-no-thumbs" class="royalSlider rsDefault">';
                    $output .='<a href="'.$image_link.'" itemprop="image" title="'.$image_title.'"><img src="'.$image[0].'" class="rsImg" alt="'.$image_title.'"  /></a>';
                }
                if($hover) {
                    $hoverimage = wp_get_attachment_image_src($hover, 'shop_single');
                    $hoverimagefull = wp_get_attachment_image_src($hover, 'full');

                    $hoverimageRSthumb = wp_get_attachment_image_src($hover, 'shop-small-thumb');
                    $output .= '<a href="'.$hoverimagefull[0].'" class="mfp-gallery" title="'.$image_hover_title.'" ><img class="rsImg" src="'.$hoverimage[0].'"  data-rsTmb="'.$hoverimageRSthumb[0].'" alt="'.$image_hover_title.'" /></a><!-- Hover single with main THumbnails -->';
                }
            $output .='</div>';
            }
        } else {
              $output .= apply_filters( 'woocommerce_single_product_image_html', sprintf( '<div class="single-product-image"><img src="%s" alt="Placeholder" /></div>', woocommerce_placeholder_img_src() ), $post->ID );
        }
        echo  $output;
        //do_action('woocommerce_product_thumbnails');
        ?>


        <div class="clearfix"></div>
    </div>
</div>
<?php } //eof else standard gallery ?>