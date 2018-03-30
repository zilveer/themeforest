<?php
// Woocommerce Support
add_theme_support('woocommerce');
if ( version_compare( WOOCOMMERCE_VERSION, "2.1" ) >= 0 ) {
	add_filter( 'woocommerce_enqueue_styles', '__return_false' );
} else {
	define( 'WOOCOMMERCE_USE_CSS', false );
}
// Register default function when plugin not activated
add_action('wp_head', 'plugins_loaded');
function plugins_loaded() {
	if(!function_exists('is_woocommerce')) {
		function is_woocommerce() { return false; }
	}
}
// Woocommerce Hooks
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
//remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);

//add_action('woocommerce_before_shop_loop', 'my_woocommerce_catalog_ordering', 30);
function my_woocommerce_catalog_ordering() {
	global $options_data;

	if(!empty($options_data['woocommerce_disable_sorting_options'])) return false;

	$product_order['default'] 	= __("Default",'richer');
	$product_order['name'] 	= __("Name",'woocommerce');
	$product_order['price'] 	= __("Price",'woocommerce');
	$product_order['date'] 		= __("Date",'woocommerce');
	$product_order['rating'] = __("Popularity",'richer');

	$product_sort['asc'] 		= __("Click to order products ascending",  'woocommerce');
	$product_sort['desc'] 		= __("Click to order products descending",  'woocommerce');

	parse_str($_SERVER['QUERY_STRING'], $params);

	$query_string = '?'.$_SERVER['QUERY_STRING'];

	// replace it with theme option
	if($options_data['woocommerce_items_per_page']) {
		$per_page = $options_data['woocommerce_items_per_page'];
	} else {
		$per_page = 12;
	}

	$pob = !empty($params['product_orderby']) ? $params['product_orderby'] : 'default';
	$po = !empty($params['product_order'])  ? $params['product_order'] : 'asc';
	$pc = !empty($params['product_count']) ? $params['product_count'] : $per_page;

	$html = '';
	$html .= '<div class="catalog-ordering clearfix">';

	$html .= '<ul class="orderby order-dropdown">';
	$html .= '<li>';
	$html .= '<span class="current-li"><a>'.__('Sort By', 'richer').': <strong>'.$product_order[$pob].'</strong></a></span>';
	$html .= '<ul>';
	$html .= '<li class="'.(($pob == 'default') ? 'current': '').'"><a href="'.woo_build_query_string($params, 'product_orderby', 'default').'">'.__('Sort By', 'richer').': <strong>'.__('Default', 'richer').'</strong></a></li>';
	$html .= '<li class="'.(($pob == 'name') ? 'current': '').'"><a href="'.woo_build_query_string($params, 'product_orderby', 'name').'">'.__('Sort By', 'richer').': <strong>'.__('Name', 'woocommerce').'</strong></a></li>';
	$html .= '<li class="'.(($pob == 'price') ? 'current': '').'"><a href="'.woo_build_query_string($params, 'product_orderby', 'price').'">'.__('Sort By', 'richer').': <strong>'.__('Price', 'woocommerce').'</strong></a></li>';
	$html .= '<li class="'.(($pob == 'date') ? 'current': '').'"><a href="'.woo_build_query_string($params, 'product_orderby', 'date').'">'.__('Sort By', 'richer').': <strong>'.__('Date', 'woocommerce').'</strong></a></li>';
	$html .= '<li class="'.(($pob == 'rating') ? 'current': '').'"><a href="'.woo_build_query_string($params, 'product_orderby', 'rating').'">'.__('Sort By', 'richer').': <strong>'.__('Popularity', 'richer').'</strong></a></li>';
	$html .= '</ul>';
	$html .= '</li>';
	$html .= '</ul>';

	$html .= '<ul class="sort-count order-dropdown">';
	$html .= '<li>';
	$html .= '<span class="current-li"><a>'.__('Showing', 'richer').': <strong>'.$pc.' '.__(' results', 'richer').'</strong></a></span>';
	$html .= '<ul>';
	$html .= '<li class="'.(($pc == $per_page) ? 'current': '').'"><a href="'.woo_build_query_string($params, 'product_count', $per_page).'">'.__('Showing', 'richer').': <strong>'.$per_page.' '.__('results', 'richer').'</strong></a></li>';
	$html .= '<li class="'.(($pc == $per_page*2) ? 'current': '').'"><a href="'.woo_build_query_string($params, 'product_count', $per_page*2).'">'.__('Showing', 'richer').': <strong>'.($per_page*2).' '.__('results', 'richer').'</strong></a></li>';
	$html .= '<li class="'.(($pc == $per_page*3) ? 'current': '').'"><a href="'.woo_build_query_string($params, 'product_count', $per_page*3).'">'.__('Showing', 'richer').': <strong>'.($per_page*3).' '.__('results', 'richer').'</strong></a></li>';
	$html .= '</ul>';
	$html .= '</li>';
	$html .= '</ul>';

	$html .= '<ul class="order">';
	if($po == 'desc'):
	$html .= '<li class="desc"><a href="'.woo_build_query_string($params, 'product_order', 'asc').'"><i class="fa fa-long-arrow-up"></i></a></li>';
	endif;
	if($po == 'asc'):
	$html .= '<li class="asc"><a href="'.woo_build_query_string($params, 'product_order', 'desc').'"><i class="fa fa-long-arrow-down"></i></a></li>';
	endif;
	$html .= '</ul>';
	$html .= '</div>';

	echo $html;
}

//helper function to build the query strings for the catalog ordering menu
if(!function_exists('woo_build_query_string'))
{
	function woo_build_query_string($params = array(), $overwrite_key, $overwrite_value)
	{
		$params[$overwrite_key] = $overwrite_value;
		return "?". http_build_query($params);
	}
}

//add_action('woocommerce_get_catalog_ordering_args', 'my_woocommerce_get_catalog_ordering_args', 20);
function my_woocommerce_get_catalog_ordering_args($args)
{
	parse_str($_SERVER['QUERY_STRING'], $params);

	$pob = !empty($params['product_orderby']) ? $params['product_orderby'] : 'default';
	$po = !empty($params['product_order'])  ? $params['product_order'] : 'asc';

	switch($pob) {
		case 'date':
			$orderby = 'date';
			$order = 'desc';
			$meta_key = ''; 
		break;
		case 'price':
			$orderby = 'meta_value_num';
			$order = 'asc';
			$meta_key = '_price';
		break;
		case 'popularity':
			$orderby = 'meta_value_num';
			$order = 'desc';
			$meta_key = 'total_sales';
		break;
		case 'title':
			$orderby = 'title';
			$order = 'asc';
			$meta_key = '';
		break;
		case 'default':
		default:
			$orderby = 'menu_order title';
			$order = 'asc';
			$meta_key = '';
		break;
	}

	switch($po) {
		case 'desc':
			$order = 'desc';
		break;
		case 'asc':
			$order = 'asc';
		break;
		default:
			$order = 'asc';
		break;
	}

	$args['orderby'] = $orderby;
	$args['order'] = $order;
	$args['meta_key'] = $meta_key;
	
	return $args;
}

add_filter('loop_shop_per_page', 'my_loop_shop_per_page');
function my_loop_shop_per_page()
{
	global $options_data;

	parse_str($_SERVER['QUERY_STRING'], $params);

	if($options_data['woocommerce_items_per_page']) {
		$per_page = $options_data['woocommerce_items_per_page'];
	} else {
		$per_page = 12;
	}

	$pc = !empty($params['product_count']) ? $params['product_count'] : $per_page;

	return $pc;
}

add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_thumbnail', 10);
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
function woocommerce_thumbnail() {
	global $product, $woocommerce;

	$items_in_cart = array();

	if(WC()->cart->get_cart() && is_array(WC()->cart->get_cart())) {
		foreach(WC()->cart->get_cart() as $cart) {
			$items_in_cart[] = $cart['product_id'];
		}
	}

	$id = get_the_ID();
	$in_cart = in_array($id, $items_in_cart);
	$size = 'shop_catalog';

	$gallery = get_post_meta($id, '_product_image_gallery', true);
	$attachment_image = '';
	if(!empty($gallery)) {
		$gallery = explode(',', $gallery);
		$first_image_id = $gallery[0];
		$attachment_image = wp_get_attachment_image($first_image_id , $size, false, array('class' => 'hover-image'));
	}
	$thumb_image = get_the_post_thumbnail($id , $size);

	if($attachment_image) {
		$classes = 'crossfade-images';
	} else {
		$classes = '';
	}

	echo '<span class="'.$classes.'">';
	echo $attachment_image;
	echo $thumb_image;
	if($in_cart) {
		echo '<span class="cart-loading"><i class="fa fa-check"></i></span>';
	} else {
		echo '<span class="cart-loading"><i class="fa fa-spinner"></i></span>';
	}
	echo '</span>';
}
add_filter('add_to_cart_fragments', 'woocommerce_topbar_add_to_cart_fragment');
function woocommerce_topbar_add_to_cart_fragment( $fragments ) {
	global $woocommerce;
	ob_start();
	?>
		<div class="cart-contents">
			<?php if(!WC()->cart->cart_contents_count) :?>
			<div class="cart-content empty">
				<a href="<?php echo get_permalink(get_option('woocommerce_shop_page_id')); ?>"><?php _e('No items in your cart', 'richer'); ?></a>
			</div>
			<?php else: ?>
			<?php foreach(WC()->cart->cart_contents as $cart_item): //var_dump($cart_item); ?>
			<div class="cart-content">
				<a href="<?php echo get_permalink($cart_item['product_id']); ?>">
				<?php echo get_the_post_thumbnail($cart_item['product_id'], 'shop_thumbnail'); ?>
				<div class="cart-desc">
					<span class="cart-title"><?php echo $cart_item['data']->post->post_title; ?></span>
					<span class="product-quantity"><?php echo $cart_item['quantity']; ?> &times; <?php echo WC()->cart->get_product_subtotal($cart_item['data'], $cart_item['quantity']); ?></span>
				</div>
				</a>
			</div>
			<?php endforeach; ?>
			<?php endif; ?>
			<div class='cart-subtotal'>
				<?php $cart_subtotal = WC()->cart->get_cart_subtotal();
				echo "<strong>".__('Subtotal:','richer')."</strong><span class='amount'>".$cart_subtotal."</span>"
				?>
			</div>
			<div class="cart-checkout">
				<div class="cart-link"><a href="<?php echo get_permalink(get_option('woocommerce_cart_page_id')); ?>"><?php _e('View Cart', 'richer'); ?></a></div>
				<div class="checkout-link"><a href="<?php echo get_permalink(get_option('woocommerce_checkout_page_id')); ?>"><?php _e('Checkout', 'richer'); ?></a></div>
			</div>
		</div>
	<?php
	$fragments['.cart-contents'] = ob_get_clean();
	return $fragments;
}
?>