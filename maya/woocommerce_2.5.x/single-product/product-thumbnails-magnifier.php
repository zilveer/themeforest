<?php
/**
 * Single Product Image
 *
 * @author 		YIThemes
 * @package 	YITH_Magnifier/Templates
 * @version     1.0.0
 */

global $post, $product, $woocommerce;

$columns = apply_filters( 'woocommerce_product_thumbnails_columns', get_option('yith_wcmg_slider_items',floor( yiw_shop_large_w() / ( yiw_shop_thumbnail_w() + 18 ) )) );


$attachment_ids = $product->get_gallery_attachment_ids();

// add featured image
if ( ! empty( $attachment_ids ) ) array_unshift( $attachment_ids, get_post_thumbnail_id() );

$enable_slider = (bool) ( get_option('yith_wcmg_enableslider') == 'yes' && ( count( $attachment_ids ) + 1 ) > $columns );


if ( empty( $attachment_ids ) ) return;

?>
<div class="thumbnails<?php echo $enable_slider ? ' slider' : ' noslider' ?>"><?php

	echo '<ul class="yith_magnifier_gallery">';


	$loop = 0;
	foreach ( $attachment_ids as $attachment_id ) {

		$classes = array();

		if ( $loop == 0 || $loop % $columns == 0 ) {
			$classes[] = 'first';
		}
		if ( ( $loop + 1 ) % $columns == 0 ) {
			$classes[] = 'last';
		}

		$attachment_url = wp_get_attachment_url( $attachment_id );

		if ( ! $attachment_url ) {
			continue;
		}

		if( ! apply_filters( 'yit_fix_wordpress_external_image_issue', false ) ) {
			$img_full       = yit_image( 'size=shop_magnifier&output=url&id=' . $attachment_id, false );
			$data_small     = yit_image( 'size=shop_single&output=url&id='    . $attachment_id, false );
			$shop_thumbnail = yit_image( 'size=shop_thumbnail&id='            . $attachment_id, false );
		} else {
			$shop_thumbnail_size = get_option('shop_thumbnail_image_size');
			$shop_single_size    = get_option('shop_single_image_size');

			// Get Info about the file
			$thumb_info = pathinfo( $attachment_url );
			extract( $thumb_info );

			$data_small     = ( $dirname . '/' . $filename ) . '-' . $shop_single_size['width']    . 'x' . $shop_single_size['height']    . '.' . $extension;
			$thumbnail_src  = ( $dirname . '/' . $filename ) . '-' . $shop_thumbnail_size['width'] . 'x' . $shop_thumbnail_size['height'] . '.' . $extension;
			// Create string version of the shop thumbnail
			$shop_thumbnail = '<img src="' . $thumbnail_src . '" width="' . $shop_thumbnail_size['width'] . '" height="' . $shop_thumbnail_size['height'] . '" />';
		}

		list( $thumbnail_url, $thumbnail_width, $thumbnail_height ) = yit_image( "id=$attachment_id&size=shop_single&output=array" );
		list( $magnifier_url, $magnifier_width, $magnifier_height ) = yit_image( "id=$attachment_id&size=shop_magnifier&output=array" );

		printf( '<li><a href="%s" title="%s" rel="thumbnails" class="%s" data-small="%s">%s</a></li>', $img_full, esc_attr( '' ), implode(' ', $classes), $data_small, $shop_thumbnail );

		$loop++;

	}

	echo '</ul>';
?>

<?php if ( $enable_slider ) : ?>
<div id="slider-prev"></div>
<div id="slider-next"></div>
<?php endif; ?>
</div>