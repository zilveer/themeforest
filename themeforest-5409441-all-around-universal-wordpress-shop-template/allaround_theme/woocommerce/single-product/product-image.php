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

$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'products-500');
?>

<div class="sidebar_wrapper product_page">

	<?php
		if ( has_post_thumbnail() ) {

			$image       		= get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) );
			$image_title 		= esc_attr( get_the_title( get_post_thumbnail_id() ) );
			$image_link  		= wp_get_attachment_url( get_post_thumbnail_id() );
			$attachment_count   = count( $product->get_gallery_attachment_ids() );
			
			if ( $attachment_count > 0 ) {
				$gallery = '[product-gallery]';
		} else {
			$gallery = '';
		}
?>
	<div class="image_wrapper zoom">
		<div class="zoom_wrap_mask"><img src="<?php echo get_template_directory_uri(); ?>/images/products/zoom_mask.png" alt="" class="zoom_wrap_mask_png" /></div><!-- zoom_wrap_mask -->
		<div class="zoom_wrap images"><img src="<?php echo $large_image_url[0]; ?>" alt="image" class="content_image" /></div><!-- zoom_wrap -->
		<div class="image_more_info big">
			<a href="<?php echo $large_image_url[0]; ?>" rel="prettyPhoto[gallery-product]"><img src="<?php echo get_template_directory_uri(); ?>/images/home/more.png" class="customColorBg" alt="" /></a>
		</div><!-- image_more_info -->
		</div><!-- image_wrapper -->			
<?php	
		} else {
			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="Placeholder" />', woocommerce_placeholder_img_src() ), $post->ID );
		}
	?>

	<?php do_action( 'woocommerce_product_thumbnails' ); ?>

</div>
