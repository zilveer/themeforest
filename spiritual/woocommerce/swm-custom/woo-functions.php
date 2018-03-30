<?php

remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);

//sort featured products
add_action('woocommerce_before_shop_loop', 'swm_woocommerce_catalog_ordering', 30);
if(!function_exists('swm_woocommerce_catalog_ordering')) {
	function swm_woocommerce_catalog_ordering() {	

		parse_str($_SERVER['QUERY_STRING'], $params);	

		$swm_products_per_page = (get_option('swm_show_product_per_page') <> '') ? esc_attr(get_option('swm_show_product_per_page')) : 12;

		$product_order['default'] 		= __("Default Order",'swmtranslate');
		$product_order['name'] 			= __("Name",'swmtranslate');
		$product_order['price'] 		= __("Price",'swmtranslate');
		$product_order['date'] 			= __("Date",'swmtranslate');
		$product_order['rating'] 		= __("Rating",'swmtranslate');
		$product_order['popularity'] 	= __("Popularity",'swmtranslate');
		$product_sort['asc'] 			= __("Sort Ascending",  'swmtranslate');
		$product_sort['desc'] 			= __("Sort Descending",  'swmtranslate');
		$swm_p_items_per_page 				= __("Products",'swmtranslate');

		$swm_pob = !empty($params['product_orderby']) ? $params['product_orderby'] : 'default';
		$swm_po = !empty($params['product_order'])  ? $params['product_order'] : 'asc';
		$swm_pc = !empty($params['product_count']) ? $params['product_count'] : $swm_products_per_page;	

		$output = '';
		$output .= '<div class="swm-woo-sort-order">';
		$output .= '<div class="left">';

		$output .= '<ul class="sortBy swm-sort-menu">';
		$output .= '<li>';	
		$output .= "<span class='current-select'>".__('Sort by','swmtranslate')." ".ucfirst($swm_pob)." </span>";
		$output .= '<ul>';
		$output .= '<li '.swm_woo_current_class($swm_pob, 'default').'><a href="'.swm_woo_url_parameter($params, 'product_orderby', 'default').'">'.$product_order['default'].'</a></li>';
		$output .= '<li '.swm_woo_current_class($swm_pob, 'name').'><a href="'.swm_woo_url_parameter($params, 'product_orderby', 'name').'">'.$product_order['name'].'</a></li>';
		$output .= '<li '.swm_woo_current_class($swm_pob, 'price').'><a href="'.swm_woo_url_parameter($params, 'product_orderby', 'price').'">'.$product_order['price'].'</a></li>';
		$output .= '<li '.swm_woo_current_class($swm_pob, 'date').'><a href="'.swm_woo_url_parameter($params, 'product_orderby', 'date').'">'.$product_order['date'].'</a></li>';	
		$output .= '<li '.swm_woo_current_class($swm_pob, 'popularity').'><a href="'.swm_woo_url_parameter($params, 'product_orderby', 'popularity').'">'.$product_order['popularity'].'</a></li>';
		$output .= '<li '.swm_woo_current_class($swm_pob, 'rating').'><a href="'.swm_woo_url_parameter($params, 'product_orderby', 'rating').'">'.$product_order['rating'].'</a></li>';
		$output .= '</ul>';
		$output .= '</li>';
		$output .= '</ul>';

		$output .= '<ul class="ascDesc">';		
		if($swm_po == 'desc') {
			$output .= '<li class="desc"><a class="tipUp" title="'.$product_sort['asc'].'" href="'.swm_woo_url_parameter($params, 'product_order', 'asc').'"><i class="fa fa-arrow-up"></i></a></li>';
		}
		if($swm_po == 'asc') { 
			$output .= '<li class="asc"><a class="tipUp" title="'.$product_sort['desc'].'" href="'.swm_woo_url_parameter($params, 'product_order', 'desc').'"><i class="fa fa-arrow-down"></i></a></li>';
		}
		$output .= '</ul>';

		$output .= '</div>';

		$output .= '<ul class="sort-count swm-sort-menu">';
		$output .= '<li>';		
		$output .= "<span class='current-select'>".__('Show','swmtranslate')." ".$swm_pc." ".$swm_p_items_per_page."</span>";
		$output .= '<ul>';
		$output .= "<li ".swm_woo_current_class($swm_pc, $swm_products_per_page)."><a href='".swm_woo_url_parameter($params, 'product_count', $swm_products_per_page)."'>".$swm_products_per_page." ".$swm_p_items_per_page."</a></li>";
		$output .= "<li ".swm_woo_current_class($swm_pc, $swm_products_per_page*2)."><a href='".swm_woo_url_parameter($params, 'product_count', $swm_products_per_page * 2)."'>".($swm_products_per_page * 2)." ".$swm_p_items_per_page."</a></li>";
		$output .= "<li ".swm_woo_current_class($swm_pc, $swm_products_per_page*3)."><a href='".swm_woo_url_parameter($params, 'product_count', $swm_products_per_page * 3)."'>".($swm_products_per_page * 3)." ".$swm_p_items_per_page."</a></li>";
		$output .= '</ul>';
		$output .= '</li>';
		$output .= '</ul>';
		$output .= '</div>';

		echo $output;
	}
}

//Set active class for list item
if(!function_exists('swm_woo_current_class')) {
	function swm_woo_current_class($key1, $key2) {
		if($key1 == $key2) {return "class='current'";} 
		else { return " "; }
	}
}

//create url as per query
if(!function_exists('swm_woo_url_parameter')) {
	function swm_woo_url_parameter($params = array(), $overwrite_key, $overwrite_value)	{
		$params[$overwrite_key] = $overwrite_value;
		$paged = (array_key_exists('product_count', $params)) ? 'paged=1&' : '';
		return "?" . $paged . http_build_query($params);
	}
}

// catalog order
add_action('woocommerce_get_catalog_ordering_args', 'swm_woocommerce_get_catalog_ordering_args', 20);
if(!function_exists('swm_woocommerce_get_catalog_ordering_args')) {
	function swm_woocommerce_get_catalog_ordering_args($args) {
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
			case 'rating':
				$orderby = 'rating';
				$order = 'desc';
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
}

// set products per page
add_filter('loop_shop_per_page', 'swm_loop_shop_per_page');
if(!function_exists('swm_loop_shop_per_page')) {
	function swm_loop_shop_per_page() {	
		parse_str($_SERVER['QUERY_STRING'], $params);
		$per_page = (get_option('swm_show_product_per_page') <> '') ? esc_attr(get_option('swm_show_product_per_page')) : 12;	
		$products_per_page = !empty($params['product_count']) ? $params['product_count'] : $per_page;
		return $products_per_page;
	}
}

//featured image
add_action('woocommerce_before_shop_loop_item_title', 'swm_woocommerce_thumbnail', 10);
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
if(!function_exists('swm_woocommerce_thumbnail')) {
	function swm_woocommerce_thumbnail() {
		global $product, $woocommerce;

		$rating = $product->get_rating_html();
		$items_in_cart = array();

		if($woocommerce->cart->get_cart() && is_array($woocommerce->cart->get_cart())) {
			foreach($woocommerce->cart->get_cart() as $cart) {
				$items_in_cart[] = $cart['product_id'];
			}
		}

		$id = swm_get_id();
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
			$classes = 'standard-featured-image';
		}

		echo '<div class="'.$classes.'">';
		echo $attachment_image;
		echo $thumb_image;

		if ( get_option('woocommerce_enable_review_rating') == 'yes' ) {
			if(!empty($rating)) {
				echo "<div class='rating-wrap'><div class='rating_container'>".$rating."</div></div>";
			}		
		}

		if($in_cart) {
			echo '<span class="cart-loading"><i class="fa fa-check"></i></span>';
		} else {
			echo '<span class="cart-loading"><i class="fa fa-spinner"></i></span>';
		}
		echo '</div>';
	}
}

// Remove Lightbox options from WooCommerce plugin pages
add_filter('woocommerce_general_settings','swm_woocommerce_general_settings_filter');
add_filter('woocommerce_page_settings','swm_woocommerce_general_settings_filter');
add_filter('woocommerce_catalog_settings','swm_woocommerce_general_settings_filter');
add_filter('woocommerce_inventory_settings','swm_woocommerce_general_settings_filter');
add_filter('woocommerce_shipping_settings','swm_woocommerce_general_settings_filter');
add_filter('woocommerce_tax_settings','swm_woocommerce_general_settings_filter');

if(!function_exists('swm_woocommerce_general_settings_filter')) {
	function swm_woocommerce_general_settings_filter($options) {  
		$remove   = array('woocommerce_enable_lightbox', 'woocommerce_frontend_css');		

		foreach ($options as $key => $option) {
			if( isset($option['id']) && in_array($option['id'], $remove) ) {  
				unset($options[$key]); 
			}
		}

		return $options;
	}
}

//Breadcrumbs
if(!function_exists('my_woocommerce_breadcrumbs')) {
	function my_woocommerce_breadcrumbs() {
	    return array(
	            'delimiter'   => '<span class="breadcrumb_seperator">/</span>',
	            'wrap_before' => '<nav class="swm_woo_breadcrumbs" itemprop="breadcrumb">',
	            'wrap_after'  => '</nav>',
	            'before'      => '<span>',
	            'after'       => '</span>',
	            'show_posts_page' => true,
	            'home'        => _x( 'Home', 'breadcrumb', 'woocommerce' ),
	        );
	}
} 
add_filter( 'woocommerce_breadcrumb_defaults', 'my_woocommerce_breadcrumbs' );

//related products column and numbers
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products',20);
remove_action( 'woocommerce_after_single_product', 'woocommerce_output_related_products',10);
add_action( 'woocommerce_after_single_product_summary', 'swm_woocommerce_output_related_products', 20);

if(!function_exists('swm_woocommerce_output_related_products')) {
	function swm_woocommerce_output_related_products() {
		
		$output = "";

		$swm_woo_related_p_column = (get_option('swm_woo_related_p_column') <> '') ? esc_attr(get_option('swm_woo_related_p_column')) : 4;
		$swm_woo_related_p_nos = (get_option('swm_woo_related_p_nos') <> '') ? esc_attr(get_option('swm_woo_related_p_nos')) : 12;	

		$atts = array(
			'posts_per_page' => $swm_woo_related_p_nos,
			'columns' 	     => $swm_woo_related_p_column,
			'orderby'        => 'rand',
		);			
		
		ob_start();
		woocommerce_related_products($atts); // no. of products, no. of columns
		$content = ob_get_clean();
		if($content) {
			$output .= "<div class='product_column shop-column-".$swm_woo_related_p_column."'>";		
			$output .= $content;
			$output .= "</div>";
		}

		echo $output;

	}
}

// Shop page pagination
remove_action('woocommerce_pagination', 'woocommerce_pagination', 10);
if(!function_exists('woocommerce_pagination')) {
	function woocommerce_pagination() {
	   	
		global $wp_query;
		$output = '';
	   	$prevPage = __( 'Prev', 'swmtranslate' );
		$nextPage = __( 'Next', 'swmtranslate' );

		$output .= '<nav class="woocommerce-pagination swm_text_color">';
			
		$output .= paginate_links( apply_filters( 'woocommerce_pagination_args', array(
					'base' 			=> str_replace( 999999999, '%#%', get_pagenum_link( 999999999 ) ),
					'format' 		=> '',
					'current' 		=> max( 1, get_query_var('paged') ),
					'total' 		=> $wp_query->max_num_pages,
					'prev_text' 	=> "<i class='fa fa-angle-left'></i>",
					'next_text' 	=> "<i class='fa fa-angle-right'></i>",
					'type'			=> 'plain',
					"add_args" 		=> false,
					'end_size'		=> 3,
					'mid_size'		=> 3
				) ) );
			
		$output .= '</nav>';

		echo $output;	
	}
}
add_action( 'woocommerce_pagination', 'woocommerce_pagination', 10);

//gallery thumbnail count
add_filter ( 'woocommerce_product_thumbnails_columns', 'swm_woo_product_thumbnails_columns' );
if(!function_exists('swm_woo_product_thumbnails_columns')) {
	function swm_woo_product_thumbnails_columns() {
	 	$single_page_gallery_thumbnails = (get_option('swm_woo_single_page_gallery_thumbnails') <> '') ? esc_attr(get_option('swm_woo_single_page_gallery_thumbnails')) : 5;
	     return $single_page_gallery_thumbnails;
	}
}

// gallery thumbnail columns
add_filter( 'woocommerce_single_product_image_thumbnail_html', 'swm_woocommerce_single_product_image_thumbnail_html', 15, 4 );
if(!function_exists('swm_woocommerce_single_product_image_thumbnail_html')) {
	function swm_woocommerce_single_product_image_thumbnail_html( $html, $attachment_id, $post_ID, $image_class ) {
	    $single_page_gallery_thumbnails = (get_option('swm_woo_single_page_gallery_thumbnails') <> '') ? esc_attr(get_option('swm_woo_single_page_gallery_thumbnails')) : 5;
	    $newclass = 'class="t-col-'.$single_page_gallery_thumbnails.' ';
	    $watermarked = str_replace( 'class="', $newclass, $html );
	    return $watermarked;
	}
}

// product single page bredcrumbs and next previous links


remove_action('woocommerce_single_product_summary','woocommerce_template_single_title',5);
add_action('woocommerce_single_product_summary', 'swm_woocommerce_single_product_summary',5);
if ( ! function_exists( 'swm_woocommerce_single_product_summary' ) ) {
	function swm_woocommerce_single_product_summary() {

	    $swm_woo_next_prev_links_options = get_option('swm_woo_next_prev_links_options'); 

		if ( $swm_woo_next_prev_links_options == 'yes' ) { ?>										
				<div class="swm_woo_next_prev">	
					<span class="swm_woo_prev"> <?php previous_post_link('%link',''); ?></span>
					<span class="swm_woo_next">	<?php next_post_link('%link',''); ?></span>
				</div>
						
		<?php
		} ?>

		<h3 itemprop="name" class="product_title entry-title"><?php the_title(); ?></h3>
		<div class="clear"></div>	 <?php
	}
}

// product categories list
add_action( 'woocommerce_before_subcategory', 'swm_woo_category_before' );
if ( ! function_exists( 'swm_woo_category_before' ) ) {
	function swm_woo_category_before() {
		echo '<div class="swm-featured-product-block p_category">';
	}
}

add_action( 'woocommerce_after_subcategory', 'swm_woo_category_after' );
	if ( ! function_exists( 'swm_woo_category_after' ) ) {
	function swm_woo_category_after() {
		echo '</div>';
	}
}

add_action( 'woocommerce_before_subcategory_title', 'swm_woo_category_title_before' );
	if ( ! function_exists( 'swm_woo_category_title_before' ) ) {
	function swm_woo_category_title_before() {
		echo '<div class="swm-product-details">';
	}
}

add_action( 'woocommerce_before_subcategory_title', 'swm_woo_category_title_after' );
	if ( ! function_exists( 'swm_woo_category_title_after' ) ) {
	function swm_woo_category_title_after() {
		echo '</div>';
	}
}

//Tag Cloud Font size
function swm_woocommerce_product_tag_cloud_widget_args($args) {
	$args['largest'] = 11; //largest tag
	$args['smallest'] = 11; //smallest tag
	$args['unit'] = 'px'; //tag font unit
	return $args;
}
add_filter( 'woocommerce_product_tag_cloud_widget_args', 'swm_woocommerce_product_tag_cloud_widget_args' );

// enable ajax mode for cart icon dropdown menu
add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');

if ( ! function_exists( 'woocommerce_header_add_to_cart_fragment' ) ) { 
	function woocommerce_header_add_to_cart_fragment( $fragments ) {
		global $woocommerce;	
		ob_start();	
		?>
		<a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>"><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?> - <?php echo $woocommerce->cart->get_cart_total(); ?></a>
		<?php	
		$fragments['a.cart-contents'] = ob_get_clean();	
		return $fragments;	
	}
}


remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
add_action( 'woocommerce_after_single_product_summary', 'swm_woocommerce_output_upsells', 15 );
 
if(!function_exists('swm_woocommerce_output_upsells')) {
	function swm_woocommerce_output_upsells() {
		
		$output = "";

		$swm_woo_upsells_p_column = (get_option('swm_woo_upsells_p_column') <> '') ? esc_attr(get_option('swm_woo_upsells_p_column')) : 4;
		$swm_woo_upsells_p_nos = (get_option('swm_woo_upsells_p_nos') <> '') ? esc_attr(get_option('swm_woo_upsells_p_nos')) : 12;		
		
		ob_start();
		woocommerce_upsell_display($swm_woo_upsells_p_nos,$swm_woo_upsells_p_column); // no. of products, no. of columns
		$content = ob_get_clean();
		if($content) {
			$output .= "<div class='product_column shop-column-".$swm_woo_upsells_p_column."'>";		
			$output .= $content;
			$output .= "</div>";
		}

		echo $output;
	}
}

// move Cross-Sells products below cart
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
add_action( 'woocommerce_after_cart', 'swm_woocommerce_cross_sell_display' , 10);


if(!function_exists('swm_woocommerce_cross_sell_display')) {
	function swm_woocommerce_cross_sell_display() {
		
		$output = "";

		$swm_woo_cross_sells_p_column = (get_option('swm_woo_cross_sells_p_column') <> '') ? esc_attr(get_option('swm_woo_cross_sells_p_column')) : 4;
		$swm_woo_cross_sells_p_nos = (get_option('swm_woo_cross_sells_p_nos') <> '') ? esc_attr(get_option('swm_woo_cross_sells_p_nos')) : 12;			
		
		ob_start();
		woocommerce_cross_sell_display($swm_woo_cross_sells_p_nos,$swm_woo_cross_sells_p_column,'rand'); // no. of products, no. of columns
		$content = ob_get_clean();
		if($content) {
			$output .= "<div class='clear'></div>";
			$output .= "<div class='product_column shop-column-".$swm_woo_cross_sells_p_column." swm_cross_sales_p'>";		
			$output .= $content;
			$output .= "</div>";
		}

		echo $output;
	}
}


if ( ! function_exists( 'swm_display_swm_woo_ajax_cart' ) ) {
	function swm_display_swm_woo_ajax_cart() { ?>
		<div class="main_hover_cart_menu">
			<div class="swm_woo_cart_menu">
				<a class="my-cart-link" href="<?php echo get_permalink(get_option('woocommerce_cart_page_id')); ?>">
					<i class="fa fa-shopping-cart"></i><?php _e('Cart','swmtranslate'); ?>
				</a>
			</div>		
			
			<div class="swm_woo_cart_hover_menu">
				<div class="widget_shopping_cart_content"></div>			
			</div>	
		</div>		
		<?php
	}
}


// widget product search
if ( ! function_exists( 'woo_custom_product_searchform' ) ) {
	function woo_custom_product_searchform( $form ) {
		$form = '
		<div id="widget_search_form">
			<form role="search" method="get" id="searchform" action="' . esc_url( home_url( '/' ) ) . '">
				<div>		
					<input type="submit" class="button" id="searchsubmit" value="&#xf002;" />
					<input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="' . __( 'Search Products', 'woocommerce' ) . '" />
					<input type="hidden" name="post_type" value="product" />
				</div>
			</form>
		</div>';
		return $form;
	}
}

add_filter( 'get_product_search_form' , 'woo_custom_product_searchform' ); 
