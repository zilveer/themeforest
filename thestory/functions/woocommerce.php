<?php
/* WooCommerce filters and related functions */

add_theme_support( 'woocommerce' );

//set the number of products per page
add_filter( 'loop_shop_per_page', 'pexeto_woo_show_per_page', 20 );
if(!function_exists('pexeto_woo_show_per_page')){
	function pexeto_woo_show_per_page($num){
		return intval(pexeto_option('woo_products_per_page'));
	}
}

//set the number of columns on the shop page
add_filter('loop_shop_columns', 'pexeto_woo_column_num');
if (!function_exists('pexeto_woo_column_num')) {
	function pexeto_woo_column_num() {
		$columns = 4;
		$page_id = wc_get_page_id('shop');
		if(!empty($page_id) && $page_id!=-1){
			$layout = pexeto_get_single_meta($page_id, 'layout');
			if($layout!='full'){
				$columns = 3;
			}
		}
		return $columns;
	}
}

//remove the page title from the content when a custom page title has been set
add_filter('woocommerce_show_page_title', 'pexeto_remove_woo_page_title');
if(!function_exists('pexeto_remove_woo_page_title')){
	function pexeto_remove_woo_page_title(){
		return function_exists('is_shop') && is_shop() ? false : true;
	}
}

if(!function_exists('pexeto_get_woo_header_settings')){
	/**
	 * Retrieves the header settings (background image and opacity)
	 * for the shop page. For all the other pages returns an empty result.
	 * @return [type] [description]
	 */
	function pexeto_get_woo_header_settings(){

		if(function_exists('is_shop') && is_shop()){
			$page_id = wc_get_page_id('shop');
			if(!empty($page_id) && $page_id!=-1){
				$meta_options = pexeto_get_post_meta($page_id, array('header_bg'));
				return $meta_options['header_bg'];
			}
		}
		return null;
	}
}

//unload the WooCommerce general CSS
add_filter( 'woocommerce_enqueue_styles', 'pexeto_dequeue_styles' );
if(!function_exists('pexeto_dequeue_styles')){
	function pexeto_dequeue_styles( $enqueue_styles ) {
		unset( $enqueue_styles['woocommerce-general'] );
		return $enqueue_styles;
	}
}

//change the default image dimensions on activation
global $pagenow;
if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ){
	add_action( 'init', 'pexeto_woocommerce_image_dimensions', 1 );
}
 
if(!function_exists('pexeto_woocommerce_image_dimensions')){
	/**
	* Define image sizes
	*/
	function pexeto_woocommerce_image_dimensions() {
		$catalog = array(
			'width' => '400',
			'height'	=> '400',
			'crop'	=> 1
		);
		 
		$single = array(
			'width' => '600',
			'height'	=> '600',
			'crop'	=> 1
		);
		 
		$thumbnail = array(
			'width' => '120',
			'height'	=> '120',
			'crop'	=> 1
		);
		 
		// Image sizes
		update_option( 'shop_catalog_image_size', $catalog ); // Product category thumbs
		update_option( 'shop_single_image_size', $single ); // Single product image
		update_option( 'shop_thumbnail_image_size', $thumbnail ); // Image gallery thumbs
	}
}


if(!function_exists('pexeto_print_woocommerce_cart_button')){
	/**
	 * Prints a WooCommerce mini cart with a button
	 */
	function pexeto_print_woocommerce_cart_button(){
		echo pexeto_get_woocommerce_cart_button_html();
	}
}

if(!function_exists('pexeto_get_woocommerce_cart_button_html')){
	/**
	 * Prints a WooCommerce mini cart with a button
	 */
	function pexeto_get_woocommerce_cart_button_html(){
		ob_start();
		
		if(function_exists('woocommerce_mini_cart')){ 
			$count = WC()->cart->get_cart_contents_count(); 
			$add_class = $count > 0 ? 'btn-visible' : '';
			?>
			<div class="pex-woo-cart-btn-wrap">
				<div class="pex-woo-cart-btn <?php echo $add_class; ?>">
					<div class="pex-woo-cart-num" data-num="<?php echo $count; ?>">
						<?php echo $count; ?>
					</div>
				</div>
				<div class="pex-woo-cart-holder">
					<div class="pex-woo-cart">
						<?php woocommerce_mini_cart(); ?>
					</div>
				</div>
			</div>
			<?php
		}
		
		$html = ob_get_clean();
		return $html;
	}
}

add_filter( 'woocommerce_add_to_cart_fragments', 'pexeto_woocommerce_add_to_cart_fragment' );

function pexeto_woocommerce_add_to_cart_fragment( $fragments ) {
	
	$fragments['div.pex-woo-cart-btn-wrap'] = pexeto_get_woocommerce_cart_button_html();
	
	return $fragments;
}

//unloads the WooCommerce PrettyPhoto srcipts and styles
add_action( 'wp_enqueue_scripts', 'pexeto_deregister_woo_pretty_photo', 99 );
if(!function_exists('pexeto_deregister_woo_pretty_photo')){
	function pexeto_deregister_woo_pretty_photo() {
		wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
		wp_dequeue_script( 'prettyPhoto' );
		wp_dequeue_script( 'prettyPhoto-init' );
	}
}

add_filter('pexeto_page_id', 'pexeto_set_shop_page_id');

if(!function_exists('pexeto_set_shop_page_id')){
	function pexeto_set_shop_page_id($page_id){
		if(function_exists('is_shop') && is_shop()){
			$shop_id = intval(wc_get_page_id('shop'));
			if($shop_id){
				return $shop_id;
			}
		}
		
		return $page_id;
	}
}

if(!function_exists('pexeto_add_to_cart_fragments')){
	/**
	 * @deprecated deprecated since version 1.8.3
	 */
	function pexeto_add_to_cart_fragments($fragments){
		global $woocommerce;
	
		$fragments['pex_number']=WC()->cart->get_cart_contents_count();
		
		return $fragments;
	}
}


add_filter('woocommerce_output_related_products_args', 'pexeto_woo_related_products_args');

if(!function_exists('pexeto_woo_related_products_args')){
	function pexeto_woo_related_products_args($args){
		$args['posts_per_page']=3;
		$args['columns']=3;
		return $args;
	}
}