<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
global $product, $etheme_global, $post;

$zoom = etheme_get_option('zoom_effect');
if( class_exists( 'YITH_WCWL_Init' ) ) {
	add_action( 'woocommerce_single_product_summary', create_function( '', 'echo do_shortcode( "[yith_wcwl_add_to_wishlist]" );' ), 31 );
}
remove_all_actions( 'woocommerce_product_thumbnails' );

$etheme_global['zoom'] = 'disable';

?>

    <div class="row">
        <div class="col-md-12 col-sm-12 product-content">
            <div class="row">
	        
	            <?php if (etheme_get_option('quick_images') != 'none'): ?>
	                <div class="col-lg-6 col-sm-6 product-images">
		                <?php if (etheme_get_option('quick_images') == 'slider'): ?>
		                	<?php
		                		/**
		                		 * woocommerce_before_single_product_summary hook
		                		 *
		                		 * @hooked woocommerce_show_product_sale_flash - 10
		                		 * @hooked woocommerce_show_product_images - 20
		                		 */
		                		do_action( 'woocommerce_before_single_product_summary' );
		                	?>
		                <?php else: ?>
		                	<?php the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' )); ?>
		                <?php endif; ?>
	                </div><!-- Product images/ END -->
				<?php endif; ?>
                
                <div class="col-lg-<?php if (etheme_get_option('quick_images') != 'none'): ?>6<?php else: ?>12<?php endif; ?> col-sm-6 product-information">
                    <div class="product-navigation clearfix">
						<h4 class="zlarge-h meta-title"><span><?php _e('Product Description', ETHEME_DOMAIN); ?></span></h4>
					</div>
                    
					<?php if (etheme_get_option('quick_product_name')): ?>
						<h3 class="product-name test-triggers"><?php the_title(); ?></h3>
					<?php endif ?>
			
					<?php if (etheme_get_option('quick_rating')): ?>
						<?php woocommerce_template_loop_rating(); ?>
					<?php endif ?>
			
					<?php if (etheme_get_option('quick_price')): ?>
						<?php woocommerce_template_single_price(); ?>
					<?php endif; ?>
					
					<?php if (etheme_get_option('quick_descr')): ?>
						<?php woocommerce_template_single_excerpt(); ?>
					<?php endif; ?>
			
					<?php if (etheme_get_option('quick_add_to_cart')): ?>
						<?php woocommerce_template_single_add_to_cart(); ?>
					<?php endif; ?>
			        
					<?php if (etheme_get_option('quick_share')): ?>
			        	<?php if(etheme_get_option('share_icons')) echo do_shortcode('[share]'); ?>
					<?php endif; ?>
			        
					<?php if (etheme_get_option('product_link')): ?>
			        	<a href="<?php the_permalink(); ?>" class="show-full-details"><?php _e('Show full details', ETHEME_DOMAIN); ?></a>
					<?php endif; ?>
                    
                </div><!-- Product information/ END -->
            </div>
            
        </div> <!-- CONTENT/ END -->
    </div>