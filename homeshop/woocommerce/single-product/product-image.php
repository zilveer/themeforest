<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.6.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post, $product;
?>



<div id="product-slider"  class="postImage images">
	<ul class="slides">
		<li>
		
		<?php
		if ( has_post_thumbnail() ) {

			$image_title 		= esc_attr( get_the_title( get_post_thumbnail_id() ) );
			$image_link  		= wp_get_attachment_url( get_post_thumbnail_id() );
			$props            = wc_get_product_attachment_props( get_post_thumbnail_id(), $post );
			$image       		= get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
				'title'	 => $props['title'],
				'alt'    => $props['alt'],
				) );
			$attachment_count   = count( $product->get_gallery_attachment_ids() );

			if ( $attachment_count > 0 ) {
				$gallery = '[product-gallery]';
			} else {
				$gallery = '';
			}
		
		$class_zoom = '';
		if(get_option('sense_thumb_zoom') != 'hide') {
			$class_zoom = 'cloud-zoom';
		}
		?>
		
		<img class="<?php echo $class_zoom; ?>" src="<?php echo $image_link; ?>"  alt="<?php echo $image_title; ?>" title="<?php echo $image_title; ?>" />
		<a itemprop="image" data-rel="prettyPhoto<?php echo $gallery; ?>" class="fullscreen-button woocommerce-main-image zoom" href="<?php echo $image_link; ?>" >
			
			<div class="product-fullscreen">
				<i class="icons icon-resize-full-1"></i>
			</div>
			
		</a>
		<?php	
		} else {
		?>
		<img class="<?php echo $class_zoom; ?>" src="<?php echo woocommerce_placeholder_img_src(); ?>" data-large="<?php echo woocommerce_placeholder_img_src(); ?>" alt="Placeholder" />
		<a class="fullscreen-button" href="<?php echo woocommerce_placeholder_img_src(); ?>">
			<div class="product-fullscreen">
				<i class="icons icon-resize-full-1"></i>
			</div>
		</a>
		
		<?php	//echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="Placeholder" />', wc_placeholder_img_src() ), $post->ID );

		}
	    ?>
		
		
		
		
		
			
		</li>
	</ul>
</div>



<?php do_action( 'woocommerce_product_thumbnails' ); ?>




