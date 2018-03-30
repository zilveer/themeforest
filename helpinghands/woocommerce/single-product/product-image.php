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

?>
<div class="images sd-single-images">

	<?php if ( $product->is_on_sale() && $product->product_type == 'variable' ) : ?>
		<div class="sd-off-price">
			<div class="sd-off-circle">
				<span class="sd-margin-none"><?php _e( 'SALE', 'sd-framework' ); ?></span>
			</div>
			<!-- sd-off-circle -->
		</div>
		<!-- sd-off-price -->
	<?php elseif ( $product->is_on_sale() && $product->product_type == 'simple' ) : ?>
		<div class="sd-off-price">
			<div class="sd-off-circle">
				<?php
					$percentage = round( ( ( $product->regular_price - $product->sale_price ) / $product->regular_price ) * 100 );
					echo $percentage . '%';
				?>
				<span><?php _ex( 'off', '% of price', 'sd-framework' ); ?></span>
			</div>
			<!-- sd-off-circle -->
		</div>
		<!-- sd-off-price -->
	<?php endif; ?>

	<?php 
		$flexslider = 'flexslider';	
		$slides = 'slides';
		$var_thumb = false;
		
		if ( $product->product_type == 'variable' ) {
			
			$available_variations = $product->get_available_variations();
			
			if ( sd_is_empty( $available_variations ) == true ) {
				$flexslider = '';	
				$slides = '';
				$var_thumb = true;
			}
		}
	?>

	<div class="sd-single-product-slider <?php echo esc_attr( $flexslider ); ?>">
		<ul class="<?php echo esc_attr( $slides ); ?>">
			<?php
				if ( has_post_thumbnail() ) {
		
					$image_title = esc_attr( get_the_title( get_post_thumbnail_id() ) );
					$image_link  = wp_get_attachment_url( get_post_thumbnail_id() );
					$image       = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
						'title' => $image_title
						) );
		
					$attachment_count = count( $product->get_gallery_attachment_ids() );
					
					$attachment_ids = $product->get_gallery_attachment_ids();
		
					if ( $attachment_count > 0 ) {
						$gallery = '[product-gallery]';
					} else {
						$gallery = '';
					}
					
		
					echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<li><a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s" data-rel="prettyPhoto' . $gallery . '">%s</a></li>', $image_link, $image_title, $image ), $post->ID );
					
					if ( $var_thumb == false ) {
						foreach ( $attachment_ids as $attachment_id ) {
			
								$image_link = wp_get_attachment_url( $attachment_id );
				
								if ( ! $image_link )
									continue;
				
								$classes[] = 'image-'.$attachment_id;
				
								$image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) );
								$image_class = esc_attr( implode( ' ', $classes ) );
								$image_title = esc_attr( get_the_title( $attachment_id ) );
				
								echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<li><a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s"  data-rel="prettyPhoto' . $gallery . '">%s</a></li>', $image_link, $image_title, $image ), $post->ID );
						}
					}
		
				} else {
		
					echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), __( 'Placeholder', 'woocommerce' ) ), $post->ID );
		
				}
			?>
		</ul>
	</div>
	<!-- sd-single-product-slider -->
</div>
<!-- sd-single-images -->