<?php
/**
 * Add to wishlist button template
 *
 * @author Your Inspiration Themes
 * @package YITH WooCommerce Wishlist
 * @version 2.0.0
 */
if(class_exists('YITH_WCWL')) {
	global $product, $yith_wcwl;
	?>

	<a href="<?php echo esc_url( $yith_wcwl->get_addtowishlist_url() ) ?>" data-product-id="<?php echo esc_attr($product->id) ?>" data-product-type="<?php echo esc_attr($product->product_type) ?>" class="add_to_wishlist" >
		<i class="dfd-icon-heart"></i>
		<span><?php esc_html_e('Add to wishlist','dfd') ?></span>
	</a>
	<?php /*<img src="<?php echo esc_url( admin_url( 'images/wpspin_light.gif' ) ) ?>" class="ajax-loading" alt="loading" width="16" height="16" style="visibility:hidden" /> */ ?>
	<?php
}