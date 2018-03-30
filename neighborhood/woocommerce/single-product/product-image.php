<?php
/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.6.3
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $woocommerce, $product;

$product_image_width = apply_filters('sf_product_image_width', 800);
$attachment_ids = array();

$options = get_option('sf_neighborhood_options');
$product_image_srcset = false;
if ( isset($options['product_image_srcset']) ) {
	$product_image_srcset = $options['product_image_srcset'];
}

?>
<div class="images">
	
	<?php
	
		if (is_out_of_stock()) {
				
			echo '<span class="out-of-stock-badge">' . __( 'Out of Stock', 'swiftframework' ) . '</span>';
		
		} else if ($product->is_on_sale()) {
				
			echo apply_filters('woocommerce_sale_flash', '<span class="onsale">'.__( 'Sale!', 'swiftframework' ).'</span>', $post, $product);
				
		} else if (!$product->get_price()) {
			
			echo '<span class="free-badge">' . __( 'Free', 'swiftframework' ) . '</span>';
		
		} else {
		
			$postdate 		= get_the_time( 'Y-m-d' );			// Post date
			$postdatestamp 	= strtotime( $postdate );			// Timestamped post date
			$newness 		= 7; 	// Newness in days

			if ( ( time() - ( 60 * 60 * 24 * $newness ) ) < $postdatestamp ) { // If the product was published within the newness time frame display the new badge
				echo '<span class="wc-new-badge">' . __( 'New', 'swiftframework' ) . '</span>';
			}
			
		}
	?>
	
	<div id="product-img-slider" class="flexslider">
		<ul class="slides">
			<?php
				$video_url = get_post_meta( $post->ID, '_video_url', true );
				if ( $video_url != "" ) {
					echo '<li><div class="video-wrap">' . apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), __( 'Placeholder', 'woocommerce' ) ), $post->ID ) . '</div></li>';
				} else if ( has_post_thumbnail() ) {
					
					$image_id			= get_post_thumbnail_id();
					$image_object		= get_the_post_thumbnail( $post->ID, 'full' );
					$image_meta 		= sf_get_attachment_meta( $image_id );

					$caption_html = $image_caption = $image_alt = $image_title = "";
					if ( isset($image_meta) ) {
						$image_caption 		= esc_attr( $image_meta['caption'] );
						$image_title 		= esc_attr( $image_meta['title'] );
						$image_alt 			= esc_attr( $image_meta['alt'] );
					}

					$image_link  		= wp_get_attachment_url( get_post_thumbnail_id() );
					
					$thumb_image = wp_get_attachment_url( $image_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ) );
					
					if ( $image_caption != "" ) {
						$caption_html = '<div class="img-caption">' . $image_caption . '</div>';
					}
					
					if ( $product_image_srcset ) {
						$image         = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
										'title'	=> get_the_title( get_post_thumbnail_id() )
									) );
						echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<li itemprop="image" data-thumb="%s">%s%s<a href="%s" itemprop="image" class="woocommerce-main-image zoom lightbox" data-rel="ilightbox[product]" data-caption="%s" title="%s" alt="%s"><i class="fa-search-plus"></i></a></li>', $thumb_image, $image_html, $caption_html, $image_link, $image_caption, $image_title, $image_alt ), $post->ID );						
					} else {
						$image = aq_resize( $image_link, 800, NULL, true, false);
						if ($image) {
							$image_html = '<img class="product-slider-image" data-zoom-image="'.$image_link.'" src="'.$image[0].'" width="'.$image[1].'" height="'.$image[2].'" alt="'.$image_alt.'" title="'.$image_title.'" />';
							
							echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<li itemprop="image" data-thumb="%s">%s%s<a href="%s" itemprop="image" class="woocommerce-main-image zoom lightbox" data-rel="ilightbox[product]" data-caption="%s" title="%s" alt="%s"><i class="fa-search-plus"></i></a></li>', $thumb_image, $image_html, $caption_html, $image_link, $image_caption, $image_title, $image_alt ), $post->ID );	
						}	
					}
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
			
						$image_link = wp_get_attachment_url( $attachment_id );
			
						if ( ! $image_link )
							continue;
						
						$thumb_image = wp_get_attachment_url( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ) );
						
						$image_class = esc_attr( implode( ' ', $classes ) );
						$image_meta  = sf_get_attachment_meta( $attachment_id );			
						$image_caption = $image_alt = $image_title = $caption_html = "";
						if ( isset($image_meta) ) {
							$image_caption 		= esc_attr( $image_meta['caption'] );
							$image_title 		= esc_attr( $image_meta['title'] );
							$image_alt 			= esc_attr( $image_meta['alt'] );
						}

						if ( $image_caption != "" ) {
							$caption_html = '<div class="img-caption">' . $image_caption . '</div>';
						}
						
						
						if ( $product_image_srcset ) {
							$image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ), 0, $attr = array(
											'title'	=> $image_title,
											'alt'	=> $image_title
											) );
							echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<li data-thumb="%s">%s%s<a href="%s" class="%s lightbox" data-rel="ilightbox[product]" data-caption="%s" title="%s" alt="%s"><i class="fa-search-plus"></i></a></li>', $thumb_image, $image_html, $caption_html, $image_link, $image_class, $image_caption, $image_title, $image_alt ), $attachment_id, $post->ID, $image_class );					
						} else {
							$image = aq_resize( $image_link, $product_image_width, NULL, true, false);
							if ($image) {												
								$image_html = '<img class="product-slider-image" data-zoom-image="'.$image_link.'" src="'.$image[0].'" width="'.$image[1].'" height="'.$image[2].'" alt="'.$image_alt.'" title="'.$image_title.'" />';
		
								echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<li data-thumb="%s">%s%s<a href="%s" class="%s lightbox" data-rel="ilightbox[product]" data-caption="%s" title="%s" alt="%s"><i class="fa-search-plus"></i></a></li>', $thumb_image, $image_html, $caption_html, $image_link, $image_class, $image_caption, $image_title, $image_alt ), $attachment_id, $post->ID, $image_class );
							
							}
													
						}
						
						$loop++;
					}
				
				}
			?>
		</ul>
	</div>

</div>