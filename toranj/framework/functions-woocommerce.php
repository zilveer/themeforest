<?php
/**
 *  functions and hooks for Woocommerce Plugin
 * 
 * @package Toranj
 * @author owwwlab (Alireza Jahandideh & Ehsan Dalvand @owwwlab)
 */


/**
 * ----------------------------------------------------------------------------------------
 * Ensure cart contents update when products are added to the cart via AJAX
 * ----------------------------------------------------------------------------------------
 */
if ( ! function_exists('owlab_header_add_to_cart_fragment')){
	function owlab_header_add_to_cart_fragment ($fragments){
		global $woocommerce;
		
		ob_start();
		
		?>
		<a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'toranj'); ?>">  
			<?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'toranj'), $woocommerce->cart->cart_contents_count);?> - <?php echo $woocommerce->cart->get_cart_total(); ?>
		</a>
		<?php
		
		$fragments['a.cart-contents'] = ob_get_clean();
		
		return $fragments;
	
	}

	add_filter('add_to_cart_fragments', 'owlab_header_add_to_cart_fragment');
}


 

/**
 * ----------------------------------------------------------------------------------------
 * Change number or products per row to 3
 * ----------------------------------------------------------------------------------------
 */
if ( ! function_exists('owlab_loop_columns')){
	function owlab_loop_columns (){
		return ot_get_option('shop_column_number',3); // 3 products per row
	}
	add_filter('loop_shop_columns', 'owlab_loop_columns');
}


/**
 * ----------------------------------------------------------------------------------------
 * hooks to woocommerce 
 * ----------------------------------------------------------------------------------------
 */

remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 11 );

remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 9 );


remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 7 );

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 12 );

remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );

/**
 * ----------------------------------------------------------------------------------------
 * overwrite woocommerce functions
 * ----------------------------------------------------------------------------------------
 */

function woocommerce_get_product_thumbnail( $size = 'shop_catalog', $placeholder_width = 0, $placeholder_height = 0  ) {
	global $post;

	if ( has_post_thumbnail() )
		return '<a href="'.get_the_permalink().'">'.get_the_post_thumbnail( $post->ID, $size ).'</a>';
	elseif ( wc_placeholder_img_src() )
		return '<a href="'.get_the_permalink().'">'.wc_placeholder_img( $size ).'</a>';
}


/**
 * ----------------------------------------------------------------------------------------
 * Add calsses for columns
 * ----------------------------------------------------------------------------------------
 */
add_filter( 'body_class','owlab_wc_body_classes' );

if (!function_exists("owlab_wc_body_classes")){
	function owlab_wc_body_classes( $classes ) {
 
		if ( is_shop() ) {
			// columns count 
			$cc = ot_get_option('shop_column_number',3);
			$classes[] = 'tj-shop-col-'.$cc;
		 
		}

		return $classes;

	}
}






