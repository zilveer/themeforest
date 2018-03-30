<?php

/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $woocommerce, $product;

// Get wide image
if(flatsome_option('product_layout') == 'gallery-wide'){
	wc_get_template_part( 'single-product/product-image', 'wide' );
	return;
}

// Get vertical gallery styøe
if(flatsome_option('product_image_style') == 'vertical'){
	wc_get_template_part( 'single-product/product-image', 'vertical' );
	return;
}

$attachment_ids = $product->get_gallery_attachment_ids();

$slider_classes = array('slider','slider-nav-small','mb-half');

// Image Zoom
if(get_theme_mod('product_zoom')){
  	$slider_classes[] = 'has-image-zoom';
}

$rtl = 'false';
if(is_rtl()) $rtl = 'true';

$image_size = 'shop_single';

?>

<?php do_action('flatsome_before_product_images'); ?>
<div class="product-images images relative has-hover">

		<?php do_action('flatsome_sale_flash'); ?>

		<div class="image-tools absolute top show-on-hover right z-3">
			<?php do_action('flatsome_product_image_tools_top'); ?>
		</div>
		
		<div class="product-gallery-slider <?php echo implode(' ', $slider_classes); ?>"
				data-flickity-options='{ 
		            "cellAlign": "center",
		            "wrapAround": true,
		            "autoPlay": false,
		            "prevNextButtons":true,
		            "adaptiveHeight": true,
		            "percentPosition": true,
		            "imagesLoaded": true,
		            "lazyLoad": 1,
		            "dragThreshold" : 15,
		            "pageDots": false,
		            "rightToLeft": <?php echo $rtl; ?>
		        }'>

		<?php
			if ( has_post_thumbnail() ) {

				$image_title 	= esc_attr( get_the_title( get_post_thumbnail_id() ) );
				$image_caption 	= get_post( get_post_thumbnail_id() )->post_excerpt;
				$image_link  	= wp_get_attachment_url( get_post_thumbnail_id() );
				$image       	= get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', $image_size), array(
					'title'	=> $image_title,
					'alt'	=> $image_title
					) );

				$attachment_count = count( $product->get_gallery_attachment_ids() );

				if ( $attachment_count > 0 ) {
					$gallery = '[product-gallery]';
				} else {
					$gallery = '';
				}

				echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<div class="slide first"><a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s" data-rel="prettyPhoto' . $gallery . '">%s</a></div>', $image_link, $image_caption, $image ), $post->ID );

				// Add additional images
				do_action('flatsome_single_product_images');
				
			} else {

				echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), __( 'Placeholder', 'woocommerce' ) ), $post->ID );

			}
		?>

		</div><!-- .product-gallery-slider -->


		<div class="image-tools absolute bottom left z-3">
			<?php do_action('flatsome_product_image_tools_bottom'); ?>
		</div>

</div><!-- .product-images -->
<?php do_action('flatsome_after_product_images'); ?>

<?php do_action( 'woocommerce_product_thumbnails' ); ?>
