<?php
/**
 * Single Product Image
 * Display Single Product Images using OWL Carousel
 * @ver 1.2.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $woocommerce, $product;

?>
<div class="single-product-images">
	
			<?php
				$attachment_ids = $product->get_gallery_attachment_ids();
					if ( $attachment_ids ) {
						$slider_id    = 'single-img-' . rand(1,9999);
			?>
						<div class="shop-thumb-slide">
							<div id="<?php echo esc_attr($slider_id); ?>" class="single-img single-img-slider">
								<?php
									$thumb_size = 'shop_single';
									$product_layout = get_post_meta( get_the_ID(), '_sama_post_layout', true );
									if( $product_layout == 'leftsidebar2col' || $product_layout == 'rightsidebar2col' ) {
										$thumb_size = 'majesty-thumb-555';
									}
									foreach ( $attachment_ids as $attachment_id ) {
										$image_title 	= esc_attr( get_the_title( $attachment_id ) );
										$image_caption 	= get_post( $attachment_id )->post_excerpt;
										$image_link  	= wp_get_attachment_url( $attachment_id );
											
										$image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_large_thumbnail_size', $thumb_size ), 0, $attr = array(
											'title'	=> $image_title,
											'alt'	=> $image_title
											) );


										$attachment_count = count( $product->get_gallery_attachment_ids() );

										if ( $attachment_count > 0 ) {
											$gallery = '[product-gallery]';
										} else {
											$gallery = '';
										}

										echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<div class="item"><a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s" data-rel="prettyPhoto' . $gallery . '">%s</a></div>', esc_url($image_link), esc_attr($image_caption), wp_kses_post($image) , $post->ID ));

									} ?>
							</div>
							
							<!-- Thumbnails -->
							<?php
								$loop 		= 0;
								//$columns 	= apply_filters( 'woocommerce_product_thumbnails_columns', 3 );
								$carousel_id = 'thumb-img-' . rand(1,9999);
							
							?>
							<div id="<?php echo esc_attr( $carousel_id );?>" class="thumb-img thumb-img-slider">
							<?php
								foreach ( $attachment_ids as $attachment_id ) {

									$classes = array( 'zoom' );
									$image_link = wp_get_attachment_url( $attachment_id );

									if ( ! $image_link )
										continue;
									$image_title 	= esc_attr( get_the_title( $attachment_id ) );
									$image_caption 	= esc_attr( get_post_field( 'post_excerpt', $attachment_id ) );

									$image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ), 0, $attr = array(
										'title'	=> $image_title,
										'alt'	=> $image_title
										) );

									$image_class = esc_attr( implode( ' ', $classes ) );

									echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<div class="item"><a href="%s" class="%s" title="%s" >%s</a></div>', esc_url($image_link), esc_attr($image_class), esc_attr($image_caption), wp_kses_post($image)), $attachment_id, $post->ID, $image_class );

									$loop++;
								}
							?>
							</div>
							<!-- End OF Thumnails -->
							
						</div>	
						
					<?php
					} else {
						echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), esc_html__( 'Placeholder', 'theme-majesty' ) ), $post->ID );
					}
			?>
</div>
