<?php
/* * **********remove and add custom style woocommerce************** */
add_filter( 'woocommerce_enqueue_styles', 'jk_dequeue_styles' );
// WooCommerce
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
function jk_dequeue_styles( $enqueue_styles ) {
	unset( $enqueue_styles['woocommerce-smallscreen'] );
 	return $enqueue_styles;
}
// Override WooCommerce function
if ( ! function_exists( 'woocommerce_template_loop_product_thumbnail' ) ) {
	function woocommerce_template_loop_product_thumbnail() {
		
		global $product;
		
		$ievent_data =  ievent_globals();
		
		$attachment_ids = $product->get_gallery_attachment_ids();
		$image          = "";
		if ( isset( $attachment_ids[0] ) ) {
			$image = wp_get_attachment_image( $attachment_ids[0], apply_filters( 'shop_catalog', 'shop_catalog' ) );
		}
		
		switch ($ievent_data['woo_image_hover']){
		
			case 'stat':
				echo woocommerce_get_product_thumbnail();
				if ( $image != "" ) {
					echo '<div class="product-change-images">' . $image . '</div>';
				}
			break; 
		
			case 'flip':
				echo '<div class="thumb flip">';
				echo '<span class="face">' . woocommerce_get_product_thumbnail() . '</span>';
				if ( $image != "" ) {
					echo '<span class="face back">' . $image . '</span>';
				} else {
					echo '<span class="face back">' . woocommerce_get_product_thumbnail() . '</span>';
				}
				echo '</div>';
			break;
			
		}
	
	}
}

function ievent_get_current_cart_info() {
	global $woocommerce;
	$items = count( $woocommerce->cart->get_cart() );
	return array(
		$items,
		get_woocommerce_currency_symbol()
	);
}
function ievent_add_to_cart_success_ajax( $count_cat_product ) {
	global $woocommerce;
	list( $cart_items ) = ievent_get_current_cart_info();
	if ( $cart_items > 0 ) {
		$cart_items = '('.$cart_items . ')';
	} else {
		$cart_items = '';
	}
	$cat_total                                                  = $woocommerce->cart->get_cart_subtotal();
	$count_cat_product['#header-mini-cart #cart-items-number']  = '<span id="cart-items-number">' . $cart_items . '</span>';
	$count_cat_product['#header-mini-cart #cart-total .amount'] = $cat_total;
	return $count_cat_product;
}
add_filter( 'add_to_cart_fragments', 'ievent_add_to_cart_success_ajax' );
// add button compare before button wishlist
global $yith_woocompare;
if ( isset( $yith_woocompare ) ) {
	remove_action( 'woocommerce_single_product_summary', array( $yith_woocompare->obj, 'add_compare_link' ), 35 );
	add_action( 'woocommerce_single_product_summary', array( $yith_woocompare->obj, 'add_compare_link' ), 30 );
}
add_filter( 'loop_shop_per_page', 'ievent_loop_shop_per_page' );
function ievent_loop_shop_per_page() {
	$ievent_data =  ievent_globals();
 	parse_str( $_SERVER['QUERY_STRING'], $params );
	if ( isset($ievent_data['woo_number_per_page']) && $ievent_data['woo_number_per_page'] ) {
		$per_page = $ievent_data['woo_number_per_page'];
	} else {
		$per_page = 12;
	}
	$pc = ! empty( $params['product_count'] ) ? $params['product_count'] : $per_page;
	return $pc;
}
function tf_addURLParameter( $url, $paramName, $paramValue ) {
	$url_data = parse_url( $url );
	if ( ! isset( $url_data["query"] ) ) {
		$url_data["query"] = "";
	}
	$params = array();
	parse_str( $url_data['query'], $params );
	$params[$paramName] = $paramValue;
	$url_data['query']  = http_build_query( $params );
	return tf_build_url( $url_data );
}
function tf_build_url( $url_data ) {
	$url = "";
	if ( isset( $url_data['host'] ) ) {
		$url .= $url_data['scheme'] . '://';
		if ( isset( $url_data['user'] ) ) {
			$url .= $url_data['user'];
			if ( isset( $url_data['pass'] ) ) {
				$url .= ':' . $url_data['pass'];
			}
			$url .= '@';
		}
		$url .= $url_data['host'];
		if ( isset( $url_data['port'] ) ) {
			$url .= ':' . $url_data['port'];
		}
	}
	if ( isset( $url_data['path'] ) ) {
		$url .= $url_data['path'];
	}
	if ( isset( $url_data['query'] ) ) {
		$url .= '?' . $url_data['query'];
	}
	if ( isset( $url_data['fragment'] ) ) {
		$url .= '#' . $url_data['fragment'];
	}
 	return $url;
}
if ( ! function_exists( 'woocommerce_breadcrumb' ) ) {
	/**
	 * Output the WooCommerce Breadcrumb
	 *
	 * @access public
	 * @return void
	 */
	function woocommerce_breadcrumb( $args = array() ) {
		$defaults = apply_filters( 'woocommerce_breadcrumb_defaults', array(
			'delimiter'   => ' &#47; ',
			'wrap_before' => '<div class="breadcrumb" ' . ( is_single() ? 'itemprop="breadcrumb"' : '' ) . '>',
			'wrap_after'  => '</div>',
			'before'      => '',
			'after'       => '',
			'home'        => _x( 'Home', 'breadcrumb', 'ievent' ),
		) );
		$args = wp_parse_args( $args, $defaults );
		wc_get_template( 'global/breadcrumb.php', $args );
	}
}
