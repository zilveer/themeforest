<?php
// Load WooCommerce custom stylsheet
if (!is_admin()) {
	if (version_compare(WOOCOMMERCE_VERSION, "2.1") < 0) {
		define('WOOCOMMERCE_USE_CSS', false);
	}

	add_action('wp_enqueue_scripts', 'berg_load_woocommerce_css', 20);
}

if (!function_exists('berg_load_woocommerce_css')) {
	function berg_load_woocommerce_css() {
		wp_deregister_style('woocommerce-layout');
		wp_deregister_style('woocommerce-smallscreen');
		wp_deregister_style('woocommerce-general');
		wp_register_style('berg-woocommerce', get_template_directory_uri() . '/styles/css/woocommerce.css');
		wp_enqueue_style('berg-woocommerce');
	}
}

//de-register PrettyPhoto - we will use our own
add_action('wp_print_styles', 'berg_deregister_styles', 100);

function berg_deregister_styles() {
	wp_deregister_style('woocommerce_prettyPhoto_css');
	wp_dequeue_script('prettyPhoto');
	wp_dequeue_script('prettyPhoto-init');
}

if (!function_exists('checked_environment')) {
	add_action('plugins_loaded', 'checked_environment');

	function checked_environment() {
		if (!class_exists('woocommerce')) {
			wp_die('WooCommerce must be installed');
		}
	}
}

/* Admin scripts */
if (is_admin()) {

	add_filter('woocommerce_general_settings','berg_woocommerce_general_settings_filter');
	add_filter('woocommerce_page_settings','berg_woocommerce_general_settings_filter');
	add_filter('woocommerce_catalog_settings','berg_woocommerce_general_settings_filter');
	add_filter('woocommerce_inventory_settings','berg_woocommerce_general_settings_filter');
	add_filter('woocommerce_shipping_settings','berg_woocommerce_general_settings_filter');
	add_filter('woocommerce_tax_settings','berg_woocommerce_general_settings_filter');

	function berg_woocommerce_general_settings_filter($options) {
		$remove = array('woocommerce_enable_lightbox', 'woocommerce_frontend_css');

		foreach ($options as $key => $option) {
			if (isset($option['id']) && in_array($option['id'], $remove)) {
				unset($options[$key]);
			}
		}

		return $options;
	}
}

//Single product sharing
add_action('woocommerce_share', 'berg_social_share', 10);

// Number of products per page
// add_filter('loop_shop_per_page', create_function('$cols', 'return 1;'), 20);
if (!function_exists('berg_woo_product_per_page')) {
	/**
	 * Function that sets number of products per page. Default is 12
	 * @return int number of products to be shown per page
	 */
	function berg_woo_product_per_page() {
		// $redux = get_option('redux');
		$products_per_page = 10;
		// if (isset($redux['woo_products_per_page']) && $redux['woo_products_per_page']) {
		// 	$products_per_page = $redux['woo_products_per_page'];
		// }
		return $products_per_page;
	}
}

add_filter('loop_shop_per_page', 'berg_woo_product_per_page', 20);

remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

function berg_theme_wrapper_start() {
	echo '<div class="container main-content">';
}

function berg_theme_wrapper_end() {
	echo '</div>';
}

add_action('woocommerce_before_main_content', 'berg_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'berg_theme_wrapper_end', 10);

// Display Price For Variable Product With Same Variations Prices
add_filter('woocommerce_available_variation', 'berg_woocommerce_available_variation', 10, 3);

function berg_woocommerce_available_variation($value, $object = null, $variation = null) {
    if ($value['price_html'] == '') {
        $value['price_html'] = '<span class="price">' . $variation->get_price_html() . '</span>';
    }

    return $value;
}

// update the cart with ajax
function woocommerce_header_add_to_cart_fragment($fragments) { 
	global $woocommerce;
	
	$fragments['span.shipping-cart-count'] = '<span class="shipping-cart-count">'.$woocommerce->cart->cart_contents_count.'</span>';

	$cart_contents = '<ul class="show-cart">';
	
	if (sizeof($woocommerce->cart->cart_contents) == 0) {
		$cart_contents .= '<li class="product">'. __( 'Your cart is currently empty.', 'woocommerce' ).'</li>';
	} else {
		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
			$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

			if ($_product->is_sold_individually()) {
				$product_quantity = "1";
			} else {
				$product_quantity = $cart_item['quantity'];
			}



			$thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id($_product->id), 'menu_thumb' );
			
			if(empty($thumb_url)) {
				$thumb_url = THEME_DIR_URI.'/img/placeholder.png';
			} else {
				$thumb_url = $thumb_url[0];
			}
			$cart_contents .= '<li class="product">
				<a href="'.$_product->get_permalink().'" class="img-product">
					<figure><img src="'.$thumb_url.'" alt="" /></figure>
				</a>

				<div class="list-product">
					<a href="' . $_product->get_permalink() . '"><h5>' . $_product->get_title() . '</h5></a>
					<div class="quantity buttons_added header-font-family">' . $product_quantity . '</div>
					<div class="price-product header-font-family">' . strip_tags(WC()->cart->get_product_price( $_product )) . '</div>
					<a class="remove-product" title="'.__( 'Remove this item', 'woocommerce' ).'" href="'.esc_url( WC()->cart->get_remove_url( $cart_item_key ) ).'"><i class="icon-close"></i></a>
				</div>
			</li>';		
		}

		// subtotal
		$cart_url = $woocommerce->cart->get_cart_url();
		$checkout_url = $woocommerce->cart->get_checkout_url();

		$cart_contents .= '<li class="summation">
			<div class="summation-subtotal">
				<span>'.__('Subtotal', 'woocommerce').':</span>
				<span class="amount header-font-family">' . WC()->cart->get_cart_subtotal() . '</span>
			</div>
			<div class="btn-cart">
				<a class="btn btn-sm btn-default" href="'.$cart_url.'">'.__('View Cart', 'woocommerce').'</a>
				<a class="btn btn-sm btn-dark" href="'.$checkout_url.'">'.__('Checkout', 'woocommerce').'</a>
			</div>
		</li>';
	}

	$cart_contents .= '</ul>';
	
	$fragments['ul.show-cart'] = $cart_contents;

	return $fragments;
}

add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');

//change summary html markup to fit responsive
// add_action('woocommerce_before_single_product_summary', 'berg_summary_div', 35);
// add_action('woocommerce_after_single_product_summary', 'berg_close_div', 4);

function berg_summary_div() {
	echo "<div class='single-product-summary'>";
}

function berg_close_div() {
	echo "</div>";
}

// // Define image sizes 
function berg_woocommerce_image_dimensions() {
// 	$catalog = array(
// 		'width' => '292',
// 		'height' => '311',
// 		'crop' => 1 
// 	);

// 	$single = array(
// 		'width' => '600',
// 		'height' => '630',
// 		'crop' => 1
// 	);

	$thumbnail = array(
		'width' => '200',
		'height' => '200',
		'crop' => 1
	);

// 	update_option('shop_catalog_image_size', $catalog); // Product category thumbs
// 	update_option('shop_single_image_size', $single); // Single product image
	update_option('shop_thumbnail_image_size', $thumbnail); // Image gallery thumbs
}

// // Image sizes
// global $pagenow;

// if (is_admin() && isset($_GET['activated']) && $pagenow == 'themes.php') {
// 	add_action('init', 'berg_woocommerce_image_dimensions', 1);
// }

if (!function_exists('berg_social_share')) {
	function berg_social_share() {
	?>
<?php if(YSettings::g('woocommerce_show_social_share') == 1) : ?>
<div class="social-share">
	<ul>
		<?php if (YSettings::g('woo_share_on_facebook', '1') == '1') : ?>
		<li>
			<a onClick="shareThis('http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&amp;t=<?php the_title(); ?>')" title=""><i class="fa fa-facebook"></i></a>
		</li>
		<?php endif; ?>
		<?php if( YSettings::g( 'woo_share_on_twitter', '1') == '1' ) : ?>
		<li>
			<a onClick="shareThis('http://www.twitter.com/share?url=<?php the_permalink(); ?>')" title=""><i class="fa fa-twitter"></i></a>
		</li>
		<?php endif; ?>
		<?php if( YSettings::g( 'woo_share_on_google_plus', '1') == '1' ) : ?>
		<li>
			<a onClick="shareThis('https://plus.google.com/share?url=<?php the_permalink(); ?>')" title=""><i class="fa fa-google-plus"></i></a>
		</li>
		<?php endif; ?>
		<?php if( YSettings::g( 'woo_share_on_pinterest', '1') == '1' ) : ?>
		<li>
			<a onClick="shareThis('http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>')" title=""><i class="fa fa-pinterest"></i></a>
		</li>
		<?php endif; ?>
		<?php if( YSettings::g( 'woo_share_on_linkedin', '1') == '1' ) : ?>
		<li>
			<a onClick="shareThis('http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>')" target="_blank" title=""><i class="fa fa-linkedin"></i></a>
		</li>
		<?php endif; ?>
	</ul>
</div>	
<?php endif ; ?>

	<?php
	}
}
class Berg_Widget_Price_Filter extends WC_Widget_Price_Filter {
	public function widget( $args, $instance ) {
		global $_chosen_attributes, $wpdb, $wp;

		if ( ! is_post_type_archive( 'product' ) && ! is_tax( get_object_taxonomies( 'product' ) ) ) {
			return;
		}

		if ( sizeof( WC()->query->unfiltered_product_ids ) == 0 ) {
			return; // None shown - return
		}

		$min_price = isset( $_GET['min_price'] ) ? esc_attr( $_GET['min_price'] ) : '';
		$max_price = isset( $_GET['max_price'] ) ? esc_attr( $_GET['max_price'] ) : '';

		wp_enqueue_script( 'wc-price-slider' );

		// Remember current filters/search
		$fields = '';

		if ( get_search_query() ) {
			$fields .= '<input type="hidden" name="s" value="' . get_search_query() . '" />';
		}

		if ( ! empty( $_GET['post_type'] ) ) {
			$fields .= '<input type="hidden" name="post_type" value="' . esc_attr( $_GET['post_type'] ) . '" />';
		}

		if ( ! empty ( $_GET['product_cat'] ) ) {
			$fields .= '<input type="hidden" name="product_cat" value="' . esc_attr( $_GET['product_cat'] ) . '" />';
		}

		if ( ! empty( $_GET['product_tag'] ) ) {
			$fields .= '<input type="hidden" name="product_tag" value="' . esc_attr( $_GET['product_tag'] ) . '" />';
		}

		if ( ! empty( $_GET['orderby'] ) ) {
			$fields .= '<input type="hidden" name="orderby" value="' . esc_attr( $_GET['orderby'] ) . '" />';
		}

		if ( $_chosen_attributes ) {
			foreach ( $_chosen_attributes as $attribute => $data ) {
				$taxonomy_filter = 'filter_' . str_replace( 'pa_', '', $attribute );

				$fields .= '<input type="hidden" name="' . esc_attr( $taxonomy_filter ) . '" value="' . esc_attr( implode( ',', $data['terms'] ) ) . '" />';

				if ( 'or' == $data['query_type'] ) {
					$fields .= '<input type="hidden" name="' . esc_attr( str_replace( 'pa_', 'query_type_', $attribute ) ) . '" value="or" />';
				}
			}
		}

		if ( 0 === sizeof( WC()->query->layered_nav_product_ids ) ) {
			$min = floor( $wpdb->get_var(
				$wpdb->prepare('
					SELECT min(meta_value + 0)
					FROM %1$s
					LEFT JOIN %2$s ON %1$s.ID = %2$s.post_id
					WHERE meta_key IN ("' . implode( '","', apply_filters( 'woocommerce_price_filter_meta_keys', array( '_price', '_min_variation_price' ) ) ) . '")
					AND meta_value != ""
				', $wpdb->posts, $wpdb->postmeta )
			) );
			$max = ceil( $wpdb->get_var(
				$wpdb->prepare('
					SELECT max(meta_value + 0)
					FROM %1$s
					LEFT JOIN %2$s ON %1$s.ID = %2$s.post_id
					WHERE meta_key IN ("' . implode( '","', apply_filters( 'woocommerce_price_filter_meta_keys', array( '_price' ) ) ) . '")
				', $wpdb->posts, $wpdb->postmeta, '_price' )
			) );
		} else {
			$min = floor( $wpdb->get_var(
				$wpdb->prepare('
					SELECT min(meta_value + 0)
					FROM %1$s
					LEFT JOIN %2$s ON %1$s.ID = %2$s.post_id
					WHERE meta_key IN ("' . implode( '","', apply_filters( 'woocommerce_price_filter_meta_keys', array( '_price', '_min_variation_price' ) ) ) . '")
					AND meta_value != ""
					AND (
						%1$s.ID IN (' . implode( ',', array_map( 'absint', WC()->query->layered_nav_product_ids ) ) . ')
						OR (
							%1$s.post_parent IN (' . implode( ',', array_map( 'absint', WC()->query->layered_nav_product_ids ) ) . ')
							AND %1$s.post_parent != 0
						)
					)
				', $wpdb->posts, $wpdb->postmeta
			) ) );
			$max = ceil( $wpdb->get_var(
				$wpdb->prepare('
					SELECT max(meta_value + 0)
					FROM %1$s
					LEFT JOIN %2$s ON %1$s.ID = %2$s.post_id
					WHERE meta_key IN ("' . implode( '","', apply_filters( 'woocommerce_price_filter_meta_keys', array( '_price' ) ) ) . '")
					AND (
						%1$s.ID IN (' . implode( ',', array_map( 'absint', WC()->query->layered_nav_product_ids ) ) . ')
						OR (
							%1$s.post_parent IN (' . implode( ',', array_map( 'absint', WC()->query->layered_nav_product_ids ) ) . ')
							AND %1$s.post_parent != 0
						)
					)
				', $wpdb->posts, $wpdb->postmeta
			) ) );
		}

		if ( $min == $max ) {
			return;
		}

		$this->widget_start( $args, $instance );

		if ( '' == get_option( 'permalink_structure' ) ) {
			$form_action = remove_query_arg( array( 'page', 'paged' ), add_query_arg( $wp->query_string, '', home_url( $wp->request ) ) );
		} else {
			$form_action = preg_replace( '%\/page/[0-9]+%', '', home_url( trailingslashit( $wp->request ) ) );
		}

		echo '<form method="get" action="' . esc_url( $form_action ) . '">
			<div class="price_slider_wrapper">
				<div class="price_slider border-color" style="display:none;"></div>
				<div class="price_slider_amount">
					<input type="text" id="min_price" name="min_price" value="' . esc_attr( $min_price ) . '" data-min="' . esc_attr( apply_filters( 'woocommerce_price_filter_widget_amount', $min ) ) . '" placeholder="' . __('Min price', 'woocommerce' ) . '" />
					<input type="text" id="max_price" name="max_price" value="' . esc_attr( $max_price ) . '" data-max="' . esc_attr( apply_filters( 'woocommerce_price_filter_widget_amount', $max ) ) . '" placeholder="' . __( 'Max price', 'woocommerce' ) . '" />
					<button type="submit" class="btn btn-dark btn-sm pull-right">' . __( 'Filter', 'woocommerce' ) . '</button>
					<div class="price_label pull-left" style="display:none;">
						<p>' . __( 'Price:', 'woocommerce' ) . ' <span class="from"></span> &mdash; <span class="to"></span></p>
					</div>
					' . $fields . '
					<div class="clear"></div>
				</div>
			</div>
		</form>';

		$this->widget_end( $args );
	}
}

function woocommerce_widgets() {
  unregister_widget('WC_Widget_Price_Filter');
  unregister_widget('WC_Widget_Layered_Nav_Filters');
  // register_widget('Berg_Widget_Price_Filter');
}
add_action('widgets_init', 'woocommerce_widgets');
