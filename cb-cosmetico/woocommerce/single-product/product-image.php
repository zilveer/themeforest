<?php
/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.6.3
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $woocommerce;

?>
<div class="images">

<?php
if ( has_post_thumbnail() ) {

	$image       		= get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) );
	$image_title 		= esc_attr( get_the_title( get_post_thumbnail_id() ) );
	$image_link  		= wp_get_attachment_url( get_post_thumbnail_id() );
	$attachment_count   = count( get_children( array( 'post_parent' => $post->ID, 'post_mime_type' => 'image', 'post_type' => 'attachment' ) ) );

	if ( $attachment_count != 1 ) {
		$gallery = '[product-gallery]';
	} else {
		$gallery = '';
	}

	echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s"  rel="prettyPhoto' . $gallery . '">%s</a>', $image_link, $image_title, $image ), $post->ID );

} else {

	echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="Placeholder" />', woocommerce_placeholder_img_src() ), $post->ID );

}
?>
<?php
/**
 * Single Product Thumbnails
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.3
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product, $woocommerce;

$attachment_ids = $product->get_gallery_attachment_ids();
array_unshift($attachment_ids,get_post_thumbnail_id());
if ( $attachment_ids ) {
	?>
	<div class="thumbnails">
	<?php

	$loop = 0;
	$columns = apply_filters( 'woocommerce_product_thumbnails_columns', 6 );

	foreach ( $attachment_ids as $attachment_id ) {

		$classes = array( 'zoom' );

		if ( $loop == 0 || $loop % $columns == 0 )
		$classes[] = 'first';

		if ( ( $loop + 1 ) % $columns == 0 )
		$classes[] = 'last';

		$image_link = wp_get_attachment_url( $attachment_id );

		if ( ! $image_link )
		continue;

		$image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ) );
		$image_class = esc_attr( implode( ' ', $classes ) );
		$image_title = esc_attr( get_the_title( $attachment_id ) );

		echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<a href="%s" class="%s" title="%s"  rel="prettyPhoto[product-gallery]">%s</a>', $image_link, $image_class, $image_title, $image ), $attachment_id, $post->ID, $image_class );

		$loop++;
	}

	?>
		<div class="cl"></div>
	</div>
	<?php
}?>
</div>
