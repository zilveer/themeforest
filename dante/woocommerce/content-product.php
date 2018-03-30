<?php
	/**
	 * The template for displaying product content within loops.
	 *
	 * Override this template by copying it to yourtheme/woocommerce/content-product.php
	 *
	 * @author 		WooThemes
	 * @package 	WooCommerce/Templates
	 * @version     2.6.1
	 */
	
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	
	global $woocommerce, $product, $woocommerce_loop, $sf_catalog_mode, $sf_sidebar_config;
	
	$options = get_option('sf_dante_options');
		
	$product_overlay_transition = $options['product_overlay_transition'];
	$overlay_transition_type = "";
	
	if (isset($options['overlay_transition_type'])) {
		$overlay_transition_type = $options['overlay_transition_type'];
	}
	
	if (is_singular('portfolio')) {
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
	}
	
	$classes = array();
		
	if ( version_compare( WOOCOMMERCE_VERSION, "2.6.0" ) < 0 ) {
		
		// Store loop count we're currently on
		if ( empty( $woocommerce_loop['loop'] ) ) {
			$woocommerce_loop['loop'] = 0;
		}
			
		// Increase loop count
		$woocommerce_loop['loop']++;
		
		// Extra post classes
		if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] )
			$classes[] = 'first';
		if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] )
			$classes[] = 'last';
	}
	
?>
<li <?php post_class( $classes ); ?>>

	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
		
	<?php if ($product_overlay_transition) {
		if ($overlay_transition_type == "slideleft") { ?>
		<figure class="product-transition-alt">	
	<?php } else if ($overlay_transition_type == "fade") { ?>
		<figure class="product-transition-fade">	
	<?php } else { ?>
		<figure class="product-transition">					
	<?php }
	?>
	<?php } else { ?>
	<figure class="no-transition">
	<?php } ?>
	
		<?php
			
			$image_html = "";
			
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
			
			if ( has_post_thumbnail() ) {
				$image_html = wp_get_attachment_image( get_post_thumbnail_id(), 'shop_catalog' );					
			}
		?>
				
		<a href="<?php the_permalink(); ?>">
			
			<?php
				
				if ( version_compare( WOOCOMMERCE_VERSION, "2.0.0" ) >= 0 ) {
				
					$attachment_ids = $product->get_gallery_attachment_ids();
					
					$img_count = 0;
					
					if ($attachment_ids) {
						
						echo '<div class="product-image">'.$image_html.'</div>';	
						
						foreach ( $attachment_ids as $attachment_id ) {
							
							if ( sf_get_post_meta( $attachment_id, '_woocommerce_exclude_image', true ) )
								continue;
							
							echo '<div class="product-image second-image">'.wp_get_attachment_image( $attachment_id, 'shop_catalog' ).'</div>';	
							
							$img_count++;
							
							if ($img_count == 1) break;
				
						}
									
					} else {
					
						echo '<div class="product-image">'.$image_html.'</div>';					
						echo '<div class="product-image second-image">'.$image_html.'</div>';
						
					}
				
				} else {
					
					$attachments = get_posts( array(
						'post_type' 	=> 'attachment',
						'numberposts' 	=> -1,
						'post_status' 	=> null,
						'post_parent' 	=> $post->ID,
						'post__not_in'	=> array( get_post_thumbnail_id() ),
						'post_mime_type'=> 'image',
						'orderby'		=> 'menu_order',
						'order'			=> 'ASC'
					) );
					
					$img_count = 0;
				
					if ($attachments) {
				
						$loop = 0;
						$columns = apply_filters( 'woocommerce_product_thumbnails_columns', 3 );
				
						foreach ( $attachments as $key => $attachment ) {
				
							if ( sf_get_post_meta( $attachment->ID, '_woocommerce_exclude_image', true ) == 1 )
								continue;
				
							echo '<div class="product-image second-image">'.wp_get_attachment_image( $attachment->ID, 'shop_catalog' ).'</div>';	
							
							$img_count++;
							
							if ($img_count == 1) break;
				
						}
				
					} else {
					
						echo '<div class="product-image">'.$image_html.'</div>';					
						echo '<div class="product-image second-image">'.$image_html.'</div>';
						
					}
					
				}
			?>			
		</a> 
		<?php if (!$sf_catalog_mode) { ?>
		<figcaption>
			<div class="shop-actions clearfix">
			<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
			</div>
		</figcaption>
		<?php } ?>
	</figure>
	
	<div class="product-details">
		<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<?php
			$size = sizeof( get_the_terms( $post->ID, 'product_cat' ) );
			echo $product->get_categories( ', ', '<span class="posted_in">' . _n( '', '', $size, 'swiftframework' ) . ' ', '</span>' );
		?>
	</div>
	
	<?php
		/**
		 * woocommerce_after_shop_loop_item_title hook
		 *
		 * @hooked woocommerce_template_loop_price - 10
		 */
		do_action( 'woocommerce_after_shop_loop_item_title' );
	?>
	
</li>