<?php
/**
 * Single Product Image
 *
 * @author 		YIThemes
 * @package 	YITH_Magnifier/Templates
 * @version     1.0.0
 */
          
global $post, $product, $woocommerce;

$columns = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );

$attachment_ids = $product->get_gallery_attachment_ids();

// add featured image
if ( ! empty( $attachment_ids ) && !in_array( get_post_thumbnail_id(), $attachment_ids ) ) array_unshift( $attachment_ids, get_post_thumbnail_id() );

?>
<div class="thumbnails"><?php
	
	if ( $attachment_ids ) {
		echo '<ul class="yith_magnifier_gallery">';


		$loop = 0;

		foreach ( $attachment_ids as $attachment_id ) {

			$classes = array();

			if ( $loop == 0 || $loop % $columns == 0 )
				$classes[] = 'first';

			if ( ( $loop + 1 ) % $columns == 0 )
				$classes[] = 'last';

			$attachment_url = wp_get_attachment_url( $attachment_id );

			if ( ! $attachment_url )
				continue;

            $attachment_title = esc_attr( get_the_title( $attachment_id ) );
            $attachment_alt   = esc_attr( get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ) );

			list( $thumbnail_url, $thumbnail_width, $thumbnail_height ) = yit_image( "id=$attachment_id&size=shop_single&output=array" );
			list( $magnifier_url, $magnifier_width, $magnifier_height ) = yit_image( "id=$attachment_id&size=shop_magnifier&output=array" );

            $args = array(
                'size' => 'shop_thumbnail',
                'id' => $attachment_id,
                'alt' => $attachment_alt,
                'title' => $attachment_title
            );

			printf( '<li><a href="%s" title="%s" rel="thumbnails" class="%s" data-small="%s">%s</a></li>', yit_image( 'size=shop_magnifier&output=url&id=' . $attachment_id, false ), $attachment_title, implode(' ', $classes), yit_image( 'size=shop_single&output=url&id=' . $attachment_id, false ), yit_image( $args, false ) );

			$loop++;

		}

		echo '</ul>';
	}
?>

<div id="slider-prev"></div>
<div id="slider-next"></div>
</div>