<?php
/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.6.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $woocommerce, $product;

$grve_product_image_effect = blade_grve_option( 'product_image_effect', 'zoom' );

//Classes
$product_image_classes = array( 'grve-product-image' );
if ( 'zoom' == $grve_product_image_effect ) {
	$product_image_classes[] = 'easyzoom';
}
$product_image_class_string = implode( ' ', $product_image_classes );


?>
<div class="images">
	<div class="<?php echo esc_attr( $product_image_class_string ); ?>">
		<?php
			if ( has_post_thumbnail() ) {

				$image_title 	= esc_attr( get_the_title( get_post_thumbnail_id() ) );
				$image_caption 	= get_post( get_post_thumbnail_id() )->post_excerpt;
				$image_link  	= wp_get_attachment_url( get_post_thumbnail_id() );
				$image       	= get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
					'title'	=> $image_title,
					'alt'	=> $image_title
					) );

				$attachment_count = count( $product->get_gallery_attachment_ids() );

				if ( $attachment_count > 0 ) {
					$gallery = '[product-gallery]';
				} else {
					$gallery = '';
				}

				echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s" data-rel="prettyPhoto' . $gallery . '">%s</a>', $image_link, $image_caption, $image ), $post->ID );

			} else {

				echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), esc_html__( 'Placeholder', 'woocommerce' ) ), $post->ID );

			}
		?>
	</div>
	<?php do_action( 'woocommerce_product_thumbnails' ); ?>

</div>
