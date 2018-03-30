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

<!-- Product Gallery -->
<div class="shop-product-gallery animate-onscroll">
	
	<div class="main-image  images image_preview_container">

		<?php if ( $product->is_on_sale() ) : ?>

			<?php echo '<div class="shop-ribbon-sale"></div>'; ?>

		<?php endif; ?>
		
		<?php
		if ( has_post_thumbnail() ) {

			$image_title = esc_attr( get_the_title( get_post_thumbnail_id() ) );
			$image_link  = wp_get_attachment_url( get_post_thumbnail_id() );
			$props            = wc_get_product_attachment_props( get_post_thumbnail_id(), $post );
			$atts_image_single = array(
				'title' => $props['title'],
				'data-large' => $image_link,
				'class' => 'cloud-zoom-image',
				'srcset' => ' ',
				'alt'    => $props['alt']
			);
			
			$image = get_the_post_thumbnail( $post->ID, 'shop_single', $atts_image_single );

			if (!$image) {
				if ( wc_placeholder_img_src() ) {
					$image = wc_placeholder_img( 'shop_single' );
				}
			}

			$string = sprintf( '%s', $image );

			echo apply_filters( 'woocommerce_single_product_image_html', $string, $post->ID );

			?>
			
			
			<a itemprop="image" data-group="shop-jackbox" class="fullscreen-button woocommerce-main-image zoom jackbox" href="<?php echo $image_link; ?>" >
			
			<div class="fullscreen-icon">
			<i class="icons icon-resize-full"></i>
			</div>
			
			</a>
			<?php
			
			
		} else {

			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '%s', wc_placeholder_img( 'shop_single' ) ), $post->ID );

		}
		?>
		
		
	</div>
	
	
	<?php do_action( 'woocommerce_product_thumbnails' ); ?>
	
	
</div>
<!-- /Product Gallery -->
