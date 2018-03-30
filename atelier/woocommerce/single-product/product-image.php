<?php
/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.6.3
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $woocommerce, $product, $sf_options;

$attachment_ids = array();
$product_layout = sf_get_post_meta($post->ID, 'sf_product_layout', true);
$product_image_width = apply_filters('sf_product_image_width', 700);

if ($product_layout == "fw-split") {
$product_image_width = apply_filters('sf_product_fw_image_width', 1200);
}
$disable_product_slider = false;
if ( isset( $sf_options['disable_product_slider'] ) ) {
	$disable_product_slider = $sf_options['disable_product_slider'];
}

?>
<div class="images">
	
	<?php if ( $disable_product_slider ) { ?>

	<div id="product-img-noslider" class="product-img-area">
		
	<?php } else { ?>
		
	<div id="product-img-slider" class="product-img-area flexslider">
		
	<?php } ?>
	
		<?php if ( $disable_product_slider == "2" ) { ?>
			
			<?php sf_woo_product_badge(); ?>
		
			<ul class="main-image">	
				<?php
					if ( has_post_thumbnail() ) {
			
						$image_title 	= esc_attr( get_the_title( get_post_thumbnail_id() ) );
						$image_caption 	= get_post( get_post_thumbnail_id() )->post_excerpt;
						$image_link  	= wp_get_attachment_url( get_post_thumbnail_id() );
						$image         = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
							'title'	=> $image_title,
							'alt'	=> $image_title,
							'class' => 'product-slider-image'
							) );
			
						$attachment_count = count( $product->get_gallery_attachment_ids() );
			
						if ( $attachment_count > 0 ) {
							$gallery = '[product-gallery]';
						} else {
							$gallery = '';
						}
			
						echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s" data-rel="prettyPhoto' . $gallery . '">%s</a>', $image_link, $image_caption, $image ), $post->ID );
									
					} else {
			
						echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), __( 'Placeholder', 'swiftframework' ) ), $post->ID );
			
					}
				?>
			</ul>
			
			<ul class="thumbnails">
				<?php do_action( 'woocommerce_product_thumbnails' ); ?>
			</ul>
			
		<?php } else { ?>

			<?php sf_woo_product_badge(); ?>

			<ul class="slides">
				<?php
					if ( has_post_thumbnail() ) {
						
						$image_caption = $image_alt = $image_title = $caption_html = "";
						$image_id			= get_post_thumbnail_id();
						$image_meta 		= sf_get_attachment_meta( $image_id );
						
						if ( isset($image_meta) ) {
							$image_caption 		= esc_attr( $image_meta['caption'] );
							$image_title 		= esc_attr( $image_meta['title'] );
							$image_alt 			= esc_attr( $image_meta['alt'] );
						}
						$image_link  		= wp_get_attachment_url( $image_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) );
						$image         		= get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
							'title'	=> $image_title,
							'alt'	=> $image_title,
							'class' => 'product-slider-image',
							'data-zoom-image' => $image_link
						) );							
	
						if ( $image_caption != "" ) {
							$caption_html = '<div class="img-caption">' . $image_caption . '</div>';
						}
						
						echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s" data-data-rel="ilightbox[product]">%s</a>', $image_link, $image_caption, $image ), $post->ID );
	
					}
	
					$loop = 0;
					$columns = apply_filters( 'woocommerce_product_thumbnails_columns', 3 );
	
					$attachment_ids = $product->get_gallery_attachment_ids();
	
					if ( $attachment_ids ) {
	
						foreach ( $attachment_ids as $attachment_id ) {
	
							$classes = array( 'zoom' );
	
							if ( $loop == 0 || $loop % $columns == 0 )
								$classes[] = 'first';
	
							if ( ( $loop + 1 ) % $columns == 0 )
								$classes[] = 'last';
	
							$image_link  		= wp_get_attachment_url( $attachment_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) );
	
							if ( ! $image_link )
								continue;
							
							$image_caption = $image_alt = $image_title = $caption_html = "";
							$image_id = $attachment_id;
							$image_meta = sf_get_attachment_meta( $image_id );
							
							if ( isset($image_meta) ) {
								$image_caption 		= esc_attr( $image_meta['caption'] );
								$image_title 		= esc_attr( $image_meta['title'] );
								$image_alt 			= esc_attr( $image_meta['alt'] );
							}
							
							$thumb_image = wp_get_attachment_url( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ) );
							$image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), false, array(
								'title'	=> $image_title,
								'alt'	=> $image_title,
								'class' => 'product-slider-image',
								'data-zoom-image' => $image_link
							) );
							$image_class = esc_attr( implode( ' ', $classes ) );						
		
							if ( $image_caption != "" ) {
								$caption_html = '<div class="img-caption">' . $image_caption . '</div>';
							}
		
							echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<li data-thumb="%s">%s%s<a href="%s" class="%s lightbox" data-rel="ilightbox[product]" data-caption="%s" title="%s" alt="%s"><i class="fa-search-plus"></i></a></li>', $thumb_image, $caption_html, $image, $image_link, $image_class, $image_caption, $image_title, $image_alt ), $attachment_id, $post->ID, $image_class );
	
							$loop++;
						}
	
					}
				?>
			</ul>
		
		<?php } ?>
		
	</div>

</div>