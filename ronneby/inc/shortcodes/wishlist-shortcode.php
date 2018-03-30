<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
function dfd_wishlist_button_shortcode($attr, $content=null) {
	global $product, $yith_wcwl;
	
	if ($yith_wcwl->is_product_in_wishlist( $product->id )) : ?>
		<a class="product-in-wishlist" href="<?php echo esc_url($yith_wcwl->get_wishlist_url()); ?>" target="_blank">
			<i class="dfd-icon-heart2"></i><span><?php _e('<span class="dfd-list-hide">Add to </span>wishlist','dfd'); ?></span>
		</a>
	<?php else : ?>
		<a class="add_to_wishlist" data-product-type="<?php echo esc_attr($product->product_type); ?>" data-product-id="<?php echo esc_attr($product->id); ?>" href="<?php echo esc_url( $yith_wcwl->get_addtowishlist_url() ); ?>">
			<i class="dfd-icon-heart2"></i><span><?php _e('<span class="dfd-list-hide">Add to </span>wishlist','dfd'); ?></span>
		</a>
		<?php 
		//woocommerce_get_template_part('add-to-wishlist-button');
	endif;
}

add_shortcode('dfd_wishlist_button_shortcode', 'dfd_wishlist_button_shortcode');

