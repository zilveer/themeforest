<?php
/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.14
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $woocommerce, $product;

$options = get_option('sf_dante_options');

$attachment_ids = array();

?>
<div class="images">
	
	<?php
		
		$newdays = 7;
		
		if (isset($options['new_badge'])) {
			$newdays = $options['new_badge'];
		}
		
		$postdate 		= get_the_time( 'Y-m-d' );			// Post date
		$postdatestamp 	= strtotime( $postdate );			// Timestamped post date
		$newness 		= $newdays; 	// Newness in days
	
		if (sf_is_out_of_stock()) {
				
			echo '<span class="out-of-stock-badge">' . __( 'Out of Stock', 'swiftframework' ) . '</span>';
		
		} else if ($product->is_on_sale()) {
				
			echo apply_filters('woocommerce_sale_flash', '<span class="onsale">'.__( 'Sale!', 'swiftframework' ).'</span>', $post, $product);
				
		} else if ( ( time() - ( 60 * 60 * 24 * $newness ) ) < $postdatestamp ) {
			
			// If the product was published within the newness time frame display the new badge
			echo '<span class="wc-new-badge">' . __( 'New', 'swiftframework' ) . '</span>';
		
		} else if (!$product->get_price()) {
			
			echo '<span class="free-badge">' . __( 'Free', 'swiftframework' ) . '</span>';
			
		}
	?>
	
	<div id="product-img-slider" class="flexslider">
		<ul class="slides images">
			<?php
				if ( has_post_thumbnail() ) {
		
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
					
					$image = sf_aq_resize( $image_link, 562, NULL, true, false);
					
					if ( $image_caption != "" ) {
						$caption_html = '<div class="img-caption">' . $image_caption . '</div>';
					}
					
					if ($image) {
					
					$image_html = '<img class="product-slider-image" data-zoom-image="'.$image_link.'" src="'.$image[0].'" width="'.$image[1].'" height="'.$image[2].'" alt="'.$image_alt.'" title="'.$image_title.'" />';
					
					echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<li itemprop="image">%s%s<a href="%s" itemprop="image" class="woocommerce-main-image zoom lightbox" title="%s" alt="%s" data-rel="ilightbox[product]" data-caption="%s"><i class="ss-expand"></i></a></li>', $image_html, $caption_html, $image_link, $image_title, $image_alt, $image_caption ), $post->ID );	
					
					} else {
					
					$image = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
						'title' => $image_title,
						'class' => 'product-slider-image'
						) );
					
					
					echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<li itemprop="image"><a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s" data-rel="prettyPhoto' . $gallery . '">%s</a></li>', $image_link, $image_title, $image ), $post->ID );
					
					
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
						
						$image = sf_aq_resize( $image_link, 562, NULL, true, false);
						
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
						
						if ($image) {
						
							$image_html = '<img class="product-slider-image" data-zoom-image="'.$image_link.'" src="'.$image[0].'" width="'.$image[1].'" height="'.$image[2].'" alt="'.$image_alt.'" title="'.$image_title.'" />';
	
							echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<li>%s%s<a href="%s" class="%s lightbox" title="%s" alt="%s" data-rel="ilightbox[product]" data-caption="%s"><i class="ss-expand"></i></a></li>', $image_html, $caption_html, $image_link, $image_class, $image_title, $image_alt, $image_caption ), $attachment_id, $post->ID, $image_class );
						
						}
							
						$loop++;
					}
				
				}
			?>
		</ul>
	</div>
	
	<?php if ( $attachment_ids ) { ?>
	<div id="product-img-nav" class="flexslider">
		<ul class="slides thumbnails">
			<?php if ( has_post_thumbnail() ) { ?>
			<li itemprop="image"><?php echo get_the_post_thumbnail( $post->ID, 'shop_thumbnail' ); ?></li>
			<?php } ?>
			<?php do_action( 'woocommerce_product_thumbnails' ); ?>
		</ul>
	</div>
	
	<?php } ?>

</div>