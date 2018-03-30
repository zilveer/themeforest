<?php
	/*	
	*	Goodlayers Woocommerce Support File
	*/
	
	add_theme_support( 'woocommerce' );
	// add_action('gdlr_top_left_menu', 'gdlr_get_woocommerce_nav', 4);
	if(!function_exists('gdlr_get_woocommerce_nav')){
		function gdlr_get_woocommerce_nav(){
			global $woocommerce;
			if(!empty($woocommerce)){
?>
<li class="gdlr-mega-menu">
	<a href="#"><i class="icon-shopping-cart"></i><?php echo __('My Cart' ,'gdlr_translate')?></a>
	<div class="sf-mega">
		<div class="sf-mega-section gdlr-woocommerce-cart">
			<div class="sub-menu-item">
				<?php 
					echo '<span class="head"><i class="icon-shopping-cart"></i>' . __('Items:', 'gdlr_translate') . ' </span>';
					echo '<span class="gdlr-cart-item-count">' . $woocommerce->cart->cart_contents_count . '</span>'; 
				?>
			</div>
			<div class="sub-menu-item">
				<?php
					echo '<span class="head"><i class="icon-money"></i>' . __('Subtotal:', 'gdlr_translate') . ' </span>';
					echo '<span class="gdlr-cart-sum-amount">' . $woocommerce->cart->get_cart_total() . '</span>';
				?>
			</div>
			<div class="sub-menu-item">
				<a class="gdlr-button" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" >
					<?php echo __('View Cart', 'gdlr_translate'); ?>
				</a>
				<a class="gdlr-button" href="<?php echo $woocommerce->cart->get_checkout_url(); ?>" >
					<?php echo __('Check Out', 'gdlr_translate'); ?>
				</a>
			</div>
		</div>
	</div>
</li>
<?php		
			}
		}
	}
	
	// filter for ajax content
	add_filter('add_to_cart_fragments', 'gdlr_woocommerce_cart_ajax');
	function gdlr_woocommerce_cart_ajax( $fragments ) {
		global $woocommerce;
		
		ob_start();
		$fragments['span.gdlr-cart-item-count'] = '<span class="gdlr-cart-item-count">' . $woocommerce->cart->cart_contents_count . '</span>'; 
		$fragments['span.gdlr-cart-sum-amount'] = '<span class="gdlr-cart-sum-amount">' . $woocommerce->cart->get_cart_total() . '</span>';
		ob_end_clean();
		
		return $fragments;
	}	
	
	// Change number or products per row to 3
	add_filter('loop_shop_columns', 'gdlr_woo_loop_columns');
	if (!function_exists('gdlr_woo_loop_columns')) {
		function gdlr_woo_loop_columns() {
			global $theme_option;
			return empty($theme_option['all-products-per-row'])? 3: $theme_option['all-products-per-row'];
		}
	}
	add_filter('post_class', 'gdlr_woo_column_class');
	if (!function_exists('gdlr_woo_column_class')) {
		function gdlr_woo_column_class($classes) {
			global $theme_option;
			$item_per_row = empty($theme_option['all-products-per-row'])? 3: $theme_option['all-products-per-row'];
			
			if( is_archive() && get_post_type() == 'product'){
				switch($item_per_row){
					case 1: $classes[] = 'gdlr-1-product-per-row'; break;
					case 2: $classes[] = 'gdlr-2-product-per-row'; break;
					case 3: $classes[] = 'gdlr-3-product-per-row'; break;
					case 4: $classes[] = 'gdlr-4-product-per-row'; break;
					case 5: $classes[] = 'gdlr-5-product-per-row'; break;
				}
			}
			return $classes;
		}
	}	
	
	// add action to enqueue woocommerce style
	add_filter('gdlr_enqueue_scripts', 'gdlr_regiser_woo_style');
	if( !function_exists('gdlr_regiser_woo_style') ){
		function gdlr_regiser_woo_style($array){	
			global $woocommerce;
			if( !empty($woocommerce) ){
				$array['style']['gdlr-woo-style'] = GDLR_PATH . '/stylesheet/gdlr-woocommerce.css';
			}
			return $array;
		}
	}
	
?>