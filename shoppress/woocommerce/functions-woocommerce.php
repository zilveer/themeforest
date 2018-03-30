<?php

/////////////////////////////////////// Enqueue Styles ///////////////////////////////////////

if ( version_compare( WOOCOMMERCE_VERSION, "2.1" ) >= 0 ) {
	add_filter( 'woocommerce_enqueue_styles', '__return_false' );
} else {
	define( 'WOOCOMMERCE_USE_CSS', false );
}

if(!is_admin()) { 
	if ( ! function_exists( 'gp_woocommerce_styles' ) ) {
		function gp_woocommerce_styles() { 	
			wp_enqueue_style('gp-woocommerce-css', get_template_directory_uri().'/woocommerce/woocommerce.css');
		}
	}
	add_action('wp_enqueue_scripts', 'gp_woocommerce_styles');
}
	
			
/////////////////////////////////////// Enqueue Scripts ///////////////////////////////////////

if(!is_admin()) {
	if ( ! function_exists( 'gp_woocommerce_scripts' ) ) {
		function gp_woocommerce_scripts() {	
			wp_enqueue_script('gp-woocommerce-js', get_template_directory_uri().'/woocommerce/woocommerce.js', array('jquery'), '', true);
		}
	}
	add_action('wp_enqueue_scripts', 'gp_woocommerce_scripts');	
}

					
/////////////////////////////////////// Number of products per row ///////////////////////////////////////

if(!is_admin()) { 

	require(gp_inc . 'options.php'); global $gp_settings, $woocommerce_loop;

	if($gp_settings['iphone']) {

		$woocommerce_loop['columns'] = 1;
		$gp_settings['product_columns_class'] = " shop-columns-1";	
	
	} else { // Other Devices

		if(get_option($dirname.'_product_cat_columns') == "1") { 
			$woocommerce_loop['columns'] = 1;
			$gp_settings['product_columns_class'] = " shop-columns-1";	
		} elseif(get_option($dirname.'_product_cat_columns') == "2") { 
			$woocommerce_loop['columns'] = 2;
			$gp_settings['product_columns_class'] = " shop-columns-2";
		} elseif(get_option($dirname.'_product_cat_columns') == "3") { 
			$woocommerce_loop['columns'] = 3;
			$gp_settings['product_columns_class'] = " shop-columns-3";
		} elseif(get_option($dirname.'_product_cat_columns') == "4") { 
			$woocommerce_loop['columns'] = 4;
			$gp_settings['product_columns_class'] = " shop-columns-4";
		} else { 
			$woocommerce_loop['columns'] = 5;
			$gp_settings['product_columns_class'] = "";
		}
			
	}
	
}


/////////////////////////////////////// Number of related products ///////////////////////////////////////

if ( ! function_exists( 'woocommerce_output_related_products' ) ) {
	function woocommerce_output_related_products() {
		$args = array(
			'posts_per_page' => 5,
			'columns'        => 5
		);
		woocommerce_related_products( $args ); // Display 4 products in rows of 4
	}
}


/////////////////////////////////////// Number of upsell products ///////////////////////////////////////

remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
if ( ! function_exists( 'woocommerce_output_upsells' ) ) {
	function woocommerce_output_upsells() {
	    woocommerce_upsell_display(5,5); // Display 5 products in rows of 5
	}
}
add_action('woocommerce_after_single_product_summary', 'woocommerce_output_upsells', 15);


/////////////////////////////////////// Replace WooCommerce Pagination ///////////////////////////////////////

if(!is_admin()) { 	
	remove_action('woocommerce_pagination', 'woocommerce_pagination', 10);
	if ( ! function_exists( 'woocommerce_pagination' ) ) {
		function woocommerce_pagination() {
			gp_pagination();
		}
	}
	add_action('woocommerce_pagination', 'woocommerce_pagination', 10);
}

/////////////////////////////////////// Dropdown Cart ///////////////////////////////////////

/*
Plugin Name: Woocommerce Dropdown Cart Widget
Plugin URI: http://www.chromeorange.co.uk/
Description: Subtly modifies the Woocommerce Cart Widget and makes it dropdown - nice in the header see :) If you need any support with this plugin (but not CSS support) please email plugins@chromeorange.co.uk (NOTE : this plugin requires WooCommerce to work!)
Version: 1.1
Author: Andrew Benbow
Author URI: http://www.chromeorange.co.uk
*/

if ( ! function_exists( 'gp_dropdown_plugin_installed' ) ) {
	function gp_dropdown_plugin_installed() {
	
		if(function_exists('dropdowncart_scripts')) { ?>
	
			<div class="error"><p><?php _e('Woocommerce Dropdown Cart Widget is already built into this theme, please deactivate this plugin.', 'gp_lang'); ?></p></div>
		
		<?php }
	}
}	
add_action('admin_notices', 'gp_dropdown_plugin_installed');
		
if ( ! function_exists( 'gp_dropdown_cart' ) ) {					
	function gp_dropdown_cart() {
		global $woocommerce;

		if (is_cart()) return; ?>
	
		<div class="dropdowncart">
	
			<a title="<?php _e('View your shopping cart', 'gp_lang'); ?>" class="cart-link"><?php echo $woocommerce->cart->get_cart_total(); ?>  (<?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'gp_lang'), $woocommerce->cart->cart_contents_count);?>)</a>
	
			<div class="dropdowncart-contents">
	
				<ul class="cart_list">

					<?php if (sizeof($woocommerce->cart->cart_contents)>0) : 
					$i = 0;					
					foreach ($woocommerce->cart->cart_contents as $cart_item_key => $cart_item) :
					
						$i++;
						if ($i == 1) :				
							$rowclass = ' class="cart_oddrow"';			
						else :
							$rowclass = ' class="cart_evenrow"';
							$i = 0;
						endif;
			
						$_product = $cart_item['data'];
					
						if ($_product->exists() && $cart_item['quantity']>0) :
							echo '<li'.$rowclass.'>';
						
							echo '<div class="dropdowncartimage">';
							echo '<a href="'.get_permalink($cart_item['product_id']).'">';				
							if (has_post_thumbnail($cart_item['product_id'])) :					
								echo get_the_post_thumbnail($cart_item['product_id'], 'shop_thumbnail'); 
							else :					 
								$placeholder = wc_get_image_size( 'shop_thumbnail' );
								echo '<img src="' . $woocommerce->plugin_url() . '/assets/images/placeholder.png" alt="Placeholder" width="' . $placeholder['width'] . '" height="' . $placeholder['height'] . '" />'; 						
							endif;				
							echo '</a>';
							echo '</div>';
						
							echo '<div class="dropdowncartproduct">';
							echo '<a href="'.get_permalink($cart_item['product_id']).'">';				
							echo apply_filters('woocommerce_cart_widget_product_title', $_product->get_title(), $_product).'</a>';				
							if ($_product instanceof woocommerce_product_variation && is_array($cart_item['variation'])) :
								echo woocommerce_get_formatted_variation($cart_item['variation']);
							endif;
							echo '</a>';
							echo '</div>';
						
							echo '<div class="dropdowncartquantity">';				
							echo '<span class="quantity">' .$cart_item['quantity'].' &times; '.woocommerce_price($_product->get_price()).'</span>';
							echo '</div>';
							echo '<div class="clear"></div>';
						
							echo '</li>';
							
							endif;
						endforeach; 
					else: 
						echo '<li class="empty">'.__('No products in the cart.', 'gp_lang').'</li>'; 
					endif; ?>
				
				</ul>
				
				<?php if (sizeof($woocommerce->cart->cart_contents)>0) :
				
					echo '<p class="total"><strong>';
					
					if (get_option('js_prices_include_tax')=='yes') :
						_e('Total', 'gp_lang');
					else :
						_e('Subtotal', 'gp_lang');
					endif;
			
					echo ':</strong> '.$woocommerce->cart->get_cart_total();
					
					echo '</p>';
					
					do_action('woocommerce_widget_shopping_cart_before_buttons');
					
					echo '<p class="buttons">
						  <a href="'.$woocommerce->cart->get_cart_url().'" class="dropdownbutton">'.__('View Cart &rarr;', 'gp_lang').'</a> 
						  <a href="'.$woocommerce->cart->get_checkout_url().'" class="dropdownbutton checkout">'.__('Checkout &rarr;', 'gp_lang').'</a>
						  </p>';
				endif; ?>
			
			</div>
		
		</div>
	
	<?php }
}


/////////////////////////////////////// Ajaxify cart details ///////////////////////////////////////

if ( ! function_exists( 'woocommerce_header_add_to_cart_fragment' ) ) {
	function woocommerce_header_add_to_cart_fragment($fragments) {
	
		global $woocommerce; ob_start(); ?>
	
				<a title="<?php _e('View your shopping cart', 'gp_lang'); ?>" class="cart-link"><?php echo $woocommerce->cart->get_cart_total(); ?>  (<?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'gp_lang'), $woocommerce->cart->cart_contents_count);?>)</a>
	
	
		<?php $fragments['a.cart-link'] = ob_get_clean();

		return $fragments;

	}
}
add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');


/////////////////////////////////////// Ajaxify cart contents ///////////////////////////////////////

if ( ! function_exists( 'woocommerce_header_dropdown_fragment' ) ) {
	function woocommerce_header_dropdown_fragment($fragments) {
	
		global $woocommerce; ob_start(); ?>
	
	
			<div class="dropdowncart-contents">
	
				<ul class="cart_list">

					<?php if (sizeof($woocommerce->cart->cart_contents)>0) : 
					$i = 0;					
					foreach ($woocommerce->cart->cart_contents as $cart_item_key => $cart_item) :
					
						$i++;
						if ($i == 1) :				
							$rowclass = ' class="cart_oddrow"';			
						else :
							$rowclass = ' class="cart_evenrow"';
							$i = 0;
						endif;
			
						$_product = $cart_item['data'];
					
						if ($_product->exists() && $cart_item['quantity']>0) :
							echo '<li'.$rowclass.'>';
						
							echo '<div class="dropdowncartimage">';
							echo '<a href="'.get_permalink($cart_item['product_id']).'">';				
							if (has_post_thumbnail($cart_item['product_id'])) :					
								echo get_the_post_thumbnail($cart_item['product_id'], 'shop_thumbnail'); 
							else :					 
								$placeholder = wc_get_image_size( 'shop_thumbnail' );
								echo '<img src="' . $woocommerce->plugin_url() . '/assets/images/placeholder.png" alt="Placeholder" width="' . $placeholder['width'] . '" height="' . $placeholder['height'] . '" />'; 					
							endif;				
							echo '</a>';
							echo '</div>';
						
							echo '<div class="dropdowncartproduct">';
							echo '<a href="'.get_permalink($cart_item['product_id']).'">';				
							echo apply_filters('woocommerce_cart_widget_product_title', $_product->get_title(), $_product).'</a>';				
							if ($_product instanceof woocommerce_product_variation && is_array($cart_item['variation'])) :
								echo woocommerce_get_formatted_variation($cart_item['variation']);
							endif;
							echo '</a>';
							echo '</div>';
						
							echo '<div class="dropdowncartquantity">';				
							echo '<span class="quantity">' .$cart_item['quantity'].' &times; '.woocommerce_price($_product->get_price()).'</span>';
							echo '</div>';
							echo '<div class="clear"></div>';
						
							echo '</li>';
							
							endif;
						endforeach; 
					else: 
						echo '<li class="empty">'.__('No products in the cart.', 'gp_lang').'</li>'; 
					endif; ?>
				
				</ul>
				
				<?php if (sizeof($woocommerce->cart->cart_contents)>0) :
				
					echo '<p class="total"><strong>';
					
					if (get_option('js_prices_include_tax')=='yes') :
						_e('Total', 'gp_lang');
					else :
						_e('Subtotal', 'gp_lang');
					endif;
			
					echo ':</strong> '.$woocommerce->cart->get_cart_total();
					
					echo '</p>';
					
					do_action('woocommerce_widget_shopping_cart_before_buttons');
					
					echo '<p class="buttons">
						  <a href="'.$woocommerce->cart->get_cart_url().'" class="dropdownbutton">'.__('View Cart &rarr;', 'gp_lang').'</a> 
						  <a href="'.$woocommerce->cart->get_checkout_url().'" class="dropdownbutton checkout">'.__('Checkout &rarr;', 'gp_lang').'</a>
						  </p>';
				endif; ?>
			
			</div>

		<?php $fragments['.dropdowncart-contents'] = ob_get_clean();

		return $fragments;

	}
}
add_filter('add_to_cart_fragments', 'woocommerce_header_dropdown_fragment');


/////////////////////////////////////// Cloud Zoom Image ///////////////////////////////////////


/*
Plugin Name: WooCommerce Cloud Zoom Image Plugin
Plugin URI: http://mrova.com
Description: Zoom Image on mouse hover
Version: 0.1
Author: mRova
Author URI: http://www.mrova.com
 */

if ( ! function_exists( 'gp_cloud_plugin_installed' ) ) {
	function gp_cloud_plugin_installed() {
	
		if ( function_exists( 'wcz_add_defaults' ) ) { ?>
	
			<div class="error"><p><?php _e('WooCommerce Cloud Zoom Image Plugin is already built into this theme, please deactivate this plugin.', 'gp-lang'); ?></p></div>
		
		<?php }
	}
}
add_action('admin_notices', 'gp_cloud_plugin_installed');

if ( ! function_exists( 'gp_wc_requires_wordpress_version' ) ) {
	function gp_wc_requires_wordpress_version() {
		global $wp_version;
		$plugin = plugin_basename(__FILE__);
		$plugin_data = get_plugin_data(__FILE__, false);

		if (version_compare($wp_version, "3.3", "<")) {
			if(is_plugin_active($plugin)) {
				deactivate_plugins($plugin);
				wp_die("'".$plugin_data['Name']."' requires WordPress 3.3 or higher, and has been deactivated! Please upgrade WordPress and try again.<br /><br />Back to <a href='".admin_url()."'>WordPress admin</a>.");
			}
		}
	}
}
register_activation_hook(__FILE__, 'gp_wc_add_defaults');
add_action('admin_init', 'gp_wc_requires_wordpress_version');
add_action('wp_footer', 'gp_wc_head',30);

if ( ! function_exists( 'gp_wc_get_defaults' ) ) {
	function gp_wc_get_defaults(){
		return array(
		"zoomWidth" => "auto",
		"zoomHeight" => "auto",
		"position" => "right",
		"adjustX" => "0",
		"adjustY" => "0",
		"tint" => "false",
		"tintOpacity" => "0.5",
		"lensOpacity" => "0.5",
		"softFocus" => "false",
		"smoothMove" => "3",
		"showTitle" => "false",
		"titleOpacity" => "0.5",
		);
	}
}

if ( ! function_exists( 'gp_wc_add_defaults' ) ) {
	function gp_wc_add_defaults() {
		$tmp = get_option('gp_wc_options');
		if(($tmp['chk_default_options_db']=='1')||(!is_array($tmp))) {
			delete_option('gp_wc_options'); // so we don't have to reset all the 'off' checkboxes too! (don't think this is needed but leave for now)
			$arr = gp_wc_get_defaults();
			update_option('gp_wc_options', $arr);
		}
	}
}

if ( ! function_exists( 'gp_wc_head' ) ) {
	function gp_wc_head() {

		global $gp_settings;

		if(function_exists('woocommerce_content')) { 
   
			if(is_product()) {

				$defaults = gp_wc_get_defaults();
				$options = get_option('gp_wc_options');
			
				$zoomWidth = ($options['zoomWidth']=="")?$defaults['zoomWidth']:$options['zoomWidth'];
				$zoomHeight = ($options['zoomHeight']=="")?$defaults['zoomHeight']:$options['zoomHeight'];
				$position = ($options['position']=="")?$defaults['position']:$options['position'];
				$adjustX = ($options['adjustX']=="")?$defaults['adjustX']:$options['adjustX'];
				$adjustY = ($options['adjustY']=="")?$defaults['adjustY']:$options['adjustY'];
				$tint = ($options['tint']=="")?$defaults['tint']:$options['tint'];
				$tintOpacity = ($options['tintOpacity']=="")?$defaults['tintOpacity']:$options['tintOpacity'];
				$lensOpacity = ($options['lensOpacity']=="")?$defaults['lensOpacity']:$options['lensOpacity'];
				$softFocus = ($options['softFocus']=="")?$defaults['softFocus']:$options['softFocus'];
				$smoothMove = ($options['smoothMove']=="")?$defaults['smoothMove']:$options['smoothMove'];
				$showTitle = ($options['showTitle']=="")?$defaults['showTitle']:$options['showTitle'];
				$titleOpacity = ($options['titleOpacity']=="")?$defaults['titleOpacity']:$options['titleOpacity']; ?>

			
				<?php if($gp_settings['image_effect'] == "Zoom") { ?>
				
					<script type="text/javascript">
				
					jQuery(document).ready(function($){
						$('a.czoom').unbind('click.fb');
						$thumbnailsContainer = $('.product .thumbnails');
						$thumbnails = $('a', $thumbnailsContainer);
						$productImages = $('.product .images>a');
						addCloudZoom = function(onWhat){
		
							onWhat.addClass('cloud-zoom').attr('rel', "zoomWidth:'<?php echo $zoomWidth ?>',zoomHeight: '<?php echo $zoomHeight ?>',position:'<?php echo $position ?>',adjustX:<?php echo $adjustX ?>,adjustY:<?php echo $adjustY ?>,tint:'<?php echo $tint ?>',tintOpacity:<?php echo $tintOpacity ?>,lensOpacity:<?php echo $lensOpacity ?>,softFocus:<?php echo $softFocus ?>,smoothMove:<?php echo $smoothMove ?>,showTitle:<?php echo $showTitle ?>,titleOpacity:<?php echo $titleOpacity ?>").CloudZoom();
		
						}
						if($thumbnails.length){
						 //   $cloneProductImage = $productImages.clone(false);
						   // $thumbnailsContainer.append($cloneProductImage);
							$thumbnails.bind('click',function(){
								$image = $(this).clone(false);
								$image.insertAfter($productImages);
								$productImages.remove();
								$productImages = $image;
								$('.mousetrap').remove();
								addCloudZoom($productImages);
		
								return false;
		
							})
		
						}
						addCloudZoom($productImages);
					
						$('form.variations_form').on( 'found_variation', function( event, variation ) {
						   addCloudZoom($productImages);
						});

					});
					</script>
			
				<?php
			
				}
			}
		}
	}
}

if ( ! function_exists( 'gp_catalog_thumbnail' ) ) {
	function gp_catalog_thumbnail(){
		$return = 'shop_single';
		return $return;
	}
}
add_filter('single_product_small_thumbnail_size', 'gp_catalog_thumbnail',10,2) ;

if ( ! function_exists( 'gp_wc_add_product_thumb' ) ) {
	function gp_wc_add_product_thumb(){
		if(function_exists('woocommerce_content')) { 
			if(is_product()){
				return 0;
			}
		}
	}
}
	
?>