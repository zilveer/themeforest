<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $theretailer_theme_options;

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

$attachment_ids = $product->get_gallery_attachment_ids();

?>

	<li class="product_item">
		
		<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

		<div class="product_item_inner">
		
		<?php if ( (!isset($theretailer_theme_options['catalog_mode'])) || ($theretailer_theme_options['catalog_mode'] == 0) ) : ?>
			<?php woocommerce_get_template( 'loop/sale-flash.php' ); ?>
		<?php endif; ?>
		
		<?php if ( (!isset($theretailer_theme_options['catalog_mode'])) || ($theretailer_theme_options['catalog_mode'] == 0) ) : ?>
			
			<?php            
			if (isset($theretailer_theme_options['out_of_stock_text'])) {
				$out_of_stock_text = __($theretailer_theme_options['out_of_stock_text'], 'woocommerce');
			} else {
				$out_of_stock_text = __('Out of stock', 'woocommerce');
			}
			?>
		
			<?php if ( !$product->is_in_stock() ) : ?>            
				<div class="out_of_stock_badge_loop <?php if (!$product->is_on_sale()) : ?>first_position<?php endif; ?>"><?php echo $out_of_stock_text; ?></div>            
			<?php endif; ?>
			
		<?php endif; ?>
	
		<div class="image_container">
			<a href="<?php the_permalink(); ?>">

				<div class="loop_products_thumbnail_img_wrapper front"><?php echo get_the_post_thumbnail( $post->ID, 'shop_catalog') ?></div>
				
				<?php if ( (!$theretailer_theme_options['flip_product']) || ($theretailer_theme_options['flip_product'] == 0) ) { ?>
				
				<?php

					if ( $attachment_ids ) {
				
						$loop = 0;				
						
						foreach ( $attachment_ids as $attachment_id ) {
				
							$image_link = wp_get_attachment_url( $attachment_id );
				
							if ( ! $image_link )
								continue;
							
							$loop++;
							
							printf( '<div class="loop_products_additional_img_wrapper back">%s</div>', wp_get_attachment_image( $attachment_id, 'shop_catalog' ) );
							
							if ($loop == 1) break;
						
						}
				
					} else {
					
					?>
					
					<div class="loop_products_additional_img_wrapper back"><?php echo get_the_post_thumbnail( $post->ID, 'shop_catalog') ?></div>
					
					<?php
						
					}
				?>
				
				<?php } ?>
				
			</a>
		   
			<div class="clr"></div>
			<?php if ( (!$theretailer_theme_options['catalog_mode']) || ($theretailer_theme_options['catalog_mode'] == 0) ) { ?>
			<div class="product_button"><?php do_action( 'woocommerce_after_shop_loop_item' ); ?></div>
			<?php } ?>
			
			<?php if (class_exists('YITH_WCWL')) : ?>
			<?php echo do_shortcode('[yith_wcwl_add_to_wishlist]'); ?>
			<?php endif; ?>
			
		</div>
		
		<?php if ( (!$theretailer_theme_options['category_listing']) || ($theretailer_theme_options['category_listing'] == 0) ) { ?>
		<!-- Show only the first category-->
		<?php $gbtr_product_cats = strip_tags($product->get_categories('|||', '', '')); //Categories without links separeted by ||| ?>
		<h3><a href="<?php the_permalink(); ?>"><?php list($firstpart) = explode('|||', $gbtr_product_cats); echo $firstpart; ?></a></h3>
		<?php } ?>
		
		<p class="product-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
		
		<?php
			/**
			 * woocommerce_after_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_template_loop_price - 10
			 */
			 
			do_action( 'woocommerce_after_shop_loop_item_title' );
		?>
		
		</div><!--.product_item_inner-->
	</li>
