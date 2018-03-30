<?php
/**
 * Single Product Thumbnails
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product;
?>

<div class="thumbnails">
<?php
    /*
    $attachments = get_posts( array(
    	'post_type' 	=> 'attachment',
    	'numberposts' 	=> -1,
    	'post_status' 	=> null,
    	'post_parent' 	=> $post->ID,
    	//'post__not_in'	=> array( get_post_thumbnail_id() ),
    	'post_mime_type'=> 'image',
    	'orderby'		=> 'menu_order',
    	'order'			=> 'ASC'
    ) );
    */


$attachment_ids = $product->get_gallery_attachment_ids();

// add featured image
/*
if ( ! empty( $attachment_ids ) &&
     ! in_array( get_post_thumbnail_id(), $attachment_ids ) &&
     ! apply_filters( 'yit_remove_featured_from_gallery', false )
)
{ array_unshift( $attachment_ids, get_post_thumbnail_id() ); } */

if ($attachment_ids) {

		$loop = 0;
		$columns = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );

		foreach ( $attachment_ids as $id ) {

			if ( get_post_meta( $id, '_woocommerce_exclude_image', true ) == 1 )
				continue;

			$classes = array( 'zoom' );

			if ( $loop == 0 || $loop % $columns == 0 )
				$classes[] = 'first';

			if ( ( $loop + 1 ) % $columns == 0 )
				$classes[] = 'last';

            $the_image = wp_get_attachment_image_src( $id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ) );

            $style = ( $the_image[2] < yit_shop_thumbnail_h() ) ? array ( 'style' => 'padding-top:' . ( ( int ) ( yit_shop_thumbnail_h() - $the_image[2] ) / 2 ) . 'px' ) : array() ;

			if( get_option( 'woocommerce_enable_lightbox' ) == 'yes' ) {
                printf( '<a href="%s" title="%s" data-rel="prettyPhoto[product-gallery]" class="%s">%s</a>', wp_get_attachment_url( $id ), esc_attr( get_the_title( $id ) ), implode(' ', $classes), wp_get_attachment_image( $id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ), 0, $style ) );
            } else {
                printf( '%s', wp_get_attachment_image( $id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ), 0, $style ) );
            }

			$loop++;

		}

	}
?></div>