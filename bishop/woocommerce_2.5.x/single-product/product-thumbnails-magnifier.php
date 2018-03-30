<?php
/**
 * Single Product Image
 *
 * @author 		YIThemes
 * @package 	YITH_Magnifier/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product, $woocommerce;

$columns = floor( ( yit_shop_single_w() + 16 ) / ( yit_shop_thumbnail_w() + 16 ) );

$attachment_ids = $product->get_gallery_attachment_ids();

// add featured image
if ( ! empty( $attachment_ids ) ) array_unshift( $attachment_ids, get_post_thumbnail_id() );

$enable_slider = (bool) ( get_option('yith_wcmg_enableslider') == 'yes' && ( count( $attachment_ids ) ) > $columns );

if ( $attachment_ids ) {
    ?>
    <div class="thumbnails <?php echo $enable_slider ? 'slider' : 'noslider' ?>">
        <ul class="clearfix yith_magnifier_gallery">
            <?php
            $loop = 0;
            $columns = apply_filters( 'woocommerce_product_thumbnails_columns', $columns );

            foreach ( $attachment_ids as $attachment_id ) {
                $classes = array( 'yith_magnifier_thumbnail' );

                if ( $loop == 0 || $loop % $columns == 0 ) {
                    $classes[] = 'first';
                }

                if ( ( $loop + 1 ) % $columns == 0 ) {
                    $classes[] = 'last';
                }

                $image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ) );
                $image_class = esc_attr( implode( ' ', $classes ) );
                $image_title = esc_attr( get_the_title( $attachment_id ) );

                list( $thumbnail_url, $thumbnail_width, $thumbnail_height ) = wp_get_attachment_image_src( $attachment_id, "shop_single" );
                list( $magnifier_url, $magnifier_width, $magnifier_height ) = wp_get_attachment_image_src( $attachment_id, "shop_magnifier" );

                echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<li class="%s"><a href="%s" class="%s" title="%s" data-small="%s" rel=%s"">%s</a></li>', $image_class, $magnifier_url, $image_class, $image_title, $thumbnail_url, 'thumbnails[product-gallery]', $image ), $attachment_id, $post->ID, $image_class );

                $loop++;
            }
            ?>
        </ul>

    </div>
<?php
}
?>