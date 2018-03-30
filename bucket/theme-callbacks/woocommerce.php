<?php
/**
 * Woocommerce support
 * If woocommerce is active and is required woo support then load tehm all
 */
if ( !in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) return;

add_theme_support( 'woocommerce' );

/**
 * Assets
 */
function wpgrade_callback_load_woocommerce_assets(){
	global $woocommerce;

	if ( !wpgrade::option('enable_woocommerce_support', '0') ) return;
	wp_enqueue_style('wpgrade-woocommerce', get_template_directory_uri() . '/theme-content/css/woocommerce.css', array('woocommerce-general'), wpgrade::cachebust_string(wpgrade::themefilepath('theme-content/css/woocommerce.css')) );
	wp_enqueue_script('wpgrade-woocommerce', get_template_directory_uri() . '/theme-content/js/woocommerce.js', array('jquery'), wpgrade::cachebust_string(wpgrade::themefilepath('theme-content/js/woocommerce.js')), true );


//	global $woocommerce;
//	$woocommerce_params = array(
//		'l10n_item_label' => __('Item2 ', 'bucket'),
//		'l10n_remove_msg' => __(' 2has been removed!', 'bucket'),
//	);

//	$woocommerce_params = apply_filters( 'woocommerce_params', $woocommerce_params );

//	$woocommerce_params['locale'] = json_encode( $woocommerce->countries->get_country_locale() );
//	wp_localize_script( 'wpgrade-woocommerce', 'woopix_params',  $woocommerce_params);


}
add_action('wp_enqueue_scripts','wpgrade_callback_load_woocommerce_assets',1);

add_action('wp_ajax_woopix_remove_from_cart', 'woopix_remove_from_cart');

// Ensure cart contents update when products are added to the cart via AJAX
add_filter('add_to_cart_fragments', 'woopgrade_header_add_to_cart_fragment');
function woopgrade_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;

	ob_start(); ?>
	<a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>">
		<?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?> - <?php echo $woocommerce->cart->get_cart_total(); ?>
	</a>
	<?php $fragments['a.cart-contents'] = ob_get_clean();

	return $fragments;

}

add_filter( 'wc_add_to_cart_message', 'wpgrade_add_to_cart_button', 999);
function wpgrade_add_to_cart_button( $message )
{
	// Here you should modify $message as you want, and then return it.
	$newButtonString = 'View cart';
	$replaceString = '<p><a$1class="btn ">' . $newButtonString .'</a>';
	$message = preg_replace('#<a(.*?)class="button wc-forward">(.*?)</a>#', $replaceString, $message);
	return $message.'</p>';
}

function custom_woo_before_shop_link() {
	// add_filter('woocommerce_loop_add_to_cart_link', 'custom_woo_loop_add_to_cart_link', 10, 3);
	add_action('woocommerce_after_shop_loop', 'custom_woo_after_shop_loop');
}
add_action('woocommerce_before_shop_loop', 'custom_woo_before_shop_link');

function custom_woo_after_shop_loop() {

}

/**
 * customise Add to Cart link/button for product loop
 * @param string $button
 * @param object $product
 * @param array $link
 * @return string
 */
function custom_woo_loop_add_to_cart_link($button, $product, $link) {
	// not for variable, grouped or external products
	if (!in_array($product->product_type, array('variable', 'grouped', 'external'))) {
		// only if can be purchased
		if ($product->is_purchasable()) {
			// show qty +/- with button
			ob_start();
			woocommerce_simple_add_to_cart();
			$button = ob_get_clean();

			// modify button so that AJAX add-to-cart script finds it
			$replacement = sprintf('data-product_id="%d" data-quantity="1" $1 add_to_cart_button product_type_simple ', $product->id);
			$button = preg_replace('/(class="single_add_to_cart_button)/', $replacement, $button);
		}
	}

	return $button;
}

/* This snippet removes the action that inserts thumbnails to products in teh loop
 * and re-adds the function customized with our wrapper in it.
 * It applies to all archives with products.
 *
 * @original plugin: WooCommerce
 * @author of snippet: Brian Krogsard
 */

/**
 * WooCommerce Loop Product Thumbs
 **/


/**
 * WooCommerce Product Thumbnail
 **/
 if ( ! function_exists( 'woocommerce_get_product_thumbnail' ) ) {

	 function woocommerce_get_product_thumbnail( $size = 'shop_catalog', $placeholder_width = 0, $placeholder_height = 0  ) {
		 global $post;
		 if ( has_post_thumbnail() ) {
			 return get_the_post_thumbnail( $post->ID, $size );
		 } else {
			 return '<img src="'. woocommerce_placeholder_img_src() .'" alt="Placeholder"/>';
		 }
	 }
 }

add_action('wp_ajax_nopriv_woopix_remove_from_cart', 'woopix_remove_from_cart');
function woopix_remove_from_cart() {
	global $woocommerce;
	$result = array('success' => false);
	check_ajax_referer( 'woo_remove_' . $_POST['remove_item'], 'remove_nonce' );

	$woocommerce->cart->set_quantity( $_POST['remove_item'], 0 );
	$result['success'] = true;
	$result['removed_item'] = $_POST['remove_item'];
	echo json_encode($result);

	die();
}

add_action('wp_ajax_woopix_update_cart', 'woopix_update_cart');
add_action('wp_ajax_nopriv_woopix_update_cart', 'woopix_update_cart');
function woopix_update_cart() {
	global $woocommerce;
	$result = array('success' => false);
//	check_ajax_referer( 'woo_remove_' . $_POST['remove_item'], 'remove_nonce' );

	$woocommerce->cart->set_quantity( $_POST['remove_item'], $_POST['qty'] );
	ob_start();

	if ( sizeof( $woocommerce->cart->get_cart() ) > 0 ) {
		foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $values ) {
			$_product = $values['data'];
			if ( $_product->exists() && $values['quantity'] > 0 ) {
				?>
				<tr class = "<?php echo esc_attr( apply_filters('woocommerce_cart_table_item_class', 'cart_table_item', $values, $cart_item_key ) ); ?>">

					<!-- The thumbnail -->
					<td class="product-thumbnail">
						<?php
						$thumbnail = apply_filters( 'woocommerce_in_cart_product_thumbnail', $_product->get_image(), $values, $cart_item_key );

						if ( ! $_product->is_visible() || ( ! empty( $_product->variation_id ) && ! $_product->parent_is_visible() ) )
							echo $thumbnail;
						else
							printf('<a href="%s">%s</a>', esc_url( get_permalink( apply_filters('woocommerce_in_cart_product_id', $values['product_id'] ) ) ), $thumbnail );
						?>
					</td>

					<!-- Product Name -->
					<td class="product-name">
						<?php
						if ( ! $_product->is_visible() || ( ! empty( $_product->variation_id ) && ! $_product->parent_is_visible() ) )
							echo apply_filters( 'woocommerce_in_cart_product_title', $_product->get_title(), $values, $cart_item_key );
						else
							printf('<a href="%s">%s</a>', esc_url( get_permalink( apply_filters('woocommerce_in_cart_product_id', $values['product_id'] ) ) ), apply_filters('woocommerce_in_cart_product_title', $_product->get_title(), $values, $cart_item_key ) );

						// Meta data
						echo $woocommerce->cart->get_item_data( $values );

						// Backorder notification
						if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $values['quantity'] ) )
							echo '<p class="backorder_notification">' . __( 'Available on backorder', 'bucket' ) . '</p>';
						?>
					</td>

					<!-- Quantity inputs -->
					<td class="product-quantity">
						<div class="flexbox">
							<div class="flexbox__item">
						<?php
						if ( $_product->is_sold_individually() ) {
							$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
						} else {

							$step	= apply_filters( 'woocommerce_quantity_input_step', '1', $_product );
							$min 	= apply_filters( 'woocommerce_quantity_input_min', '', $_product );
							$max 	= apply_filters( 'woocommerce_quantity_input_max', $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(), $_product );

							$product_quantity = sprintf( '<div class="pix-quantity"><input type="text" name="cart[%s][qty]" step="%s" min="%s" max="%s" value="%s" size="4" title="' . _x( 'Qty', 'Product quantity input tooltip', 'bucket' ) . '" class="input-text qty text" maxlength="12" data-item_key="%s" /></div>', $cart_item_key, $step, $min, $max, esc_attr( $values['quantity'] ), $cart_item_key );
						}

						echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key );
						?>
							</div>
						</div>						
					</td>

					<!-- Product subtotal -->
					<td class="product-subtotal">
						<?php
						echo apply_filters( 'woocommerce_cart_item_subtotal', $woocommerce->cart->get_product_subtotal( $_product, $values['quantity'] ), $values, $cart_item_key );
						?>
					</td>

					<!-- Remove from cart link -->
					<td class="product-remove">
						<?php
						echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove no_djax" title="%s" data-item_key="%s", data-remove_nonce="%s">&times;</a>', esc_url( $woocommerce->cart->get_remove_url( $cart_item_key ) ), __( 'Remove this item', 'bucket' ), $cart_item_key, wp_create_nonce("woo_remove_".$cart_item_key) ), $cart_item_key );
						?>
					</td>
				</tr>
			<?php
			}
		}
	} /* ?>
		<tr>
			<td colspan="6" class="actions">

				<?php if ( $woocommerce->cart->coupons_enabled() ) { ?>
					<div class="coupon"  style="display:none;">

						<label for="coupon_code"><?php _e( 'Coupon', 'bucket' ); ?>:</label> <input name="coupon_code" class="input-text" id="coupon_code" value="" /> <input type="submit" class="btn " name="apply_coupon" value="<?php _e( 'Apply Coupon', 'bucket' ); ?>" />

						<?php do_action('woocommerce_cart_coupon'); ?>

					</div>
				<?php } ?>

				<?php if ( !wpgrade::option('use_ajax_loading') ) { ?>
					<input type="submit" class="btn " name="update_cart" value="<?php _e( 'Update Cart', 'bucket' ); ?>" />
				<?php } ?>

				<?php do_action('woocommerce_proceed_to_checkout'); ?>

				<?php $woocommerce->nonce_field('cart') ?>
			</td>
		</tr>
	<?php */
	$result['cart_items'] = ob_get_clean();

	ob_start();

	if ( ! defined('WOOCOMMERCE_CART') ) define( 'WOOCOMMERCE_CART', true );

	if ( isset( $_POST['shipping_method'] ) )
		$woocommerce->session->chosen_shipping_method = $_POST['shipping_method'];

	$woocommerce->cart->calculate_totals();

	get_template_part('woocommerce/cart/totals');

	$result['totals'] = ob_get_clean();
	$result['success'] = true;
	echo json_encode($result);
	die();
}


add_filter('term_links-product_cat', 'wpgrade_filter_product_categories', 10, 1);

function wpgrade_filter_product_categories($term_links){

	if ( !empty($term_links) ) {
		foreach($term_links as &$link){
			$link = str_replace('<a ', '<a class="btn  btn--small  btn--tertiary" ', $link);
		}
	}

	return $term_links;

}

add_filter('term_links-product_tag', 'wpgrade_filter_product_tags', 10, 1);

function wpgrade_filter_product_tags($term_links){

	if ( !empty($term_links) ) {
		foreach($term_links as &$link){
			$link = str_replace('<a ', '<a class="btn  btn--small  btn--tertiary" ', $link);
		}
	}

	return $term_links;

}

function woo_related_products_limit() {
  global $product;
	
	$args = array(
		'post_type'        		=> 'product',
		'no_found_rows'    		=> 1,
		'posts_per_page'   		=> 4,
		'ignore_sticky_posts' 	=> 1,
		'post__not_in'        	=> array($product->id)
	);
	return $args;
}
add_filter( 'woocommerce_related_products_args', 'woo_related_products_limit' );
