<?php

// Don't need the sidebar
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

// Don't need the breadcrumb
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

// Show page title
if( !function_exists( 'berger_woocommerce_show_page_title' ) ){
	
	function berger_woocommerce_show_page_title(){

		return false;
	}

	add_filter( 'woocommerce_show_page_title', 'berger_woocommerce_show_page_title', 10, true );
}

// customize the beginning of the shop loop
if( !function_exists( 'berger_woocommerce_before_shop_loop' ) ){
	
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
	
	function berger_woocommerce_before_shop_loop(){
		
		woocommerce_result_count();

		global $clapat_bg_theme_options;
		
		echo '<!-- Shop Wrapper -->';                
        echo '<div id="shop-wrapper" data-col="' . $clapat_bg_theme_options['clapat_bg_shop_columns'] . '">';
	}
	
	add_action( 'woocommerce_before_shop_loop', 'berger_woocommerce_before_shop_loop', 20 );
	
}

// customize the end of the shop loop
if( !function_exists( 'berger_woocommerce_after_shop_loop' ) ){
	
	remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );
	
	function berger_woocommerce_after_shop_loop(){
		
		echo '<!-- /Shop Wrapper -->';                
        echo '</div>';
        
        woocommerce_pagination();
        
	}
	
	add_action( 'woocommerce_after_shop_loop', 'berger_woocommerce_after_shop_loop', 10 );
	
}

// customize the sale flash
if( !function_exists( 'berger_woocommerce_sale_flash' ) ){

	function berger_woocommerce_sale_flash( $output, $post, $product ){
		
		$output = '<span class="onsale monospace">' . __('Sale', THEME_LANGUAGE_DOMAIN) . '</span>';

		return $output;
	}
	
	add_filter( 'woocommerce_sale_flash', 'berger_woocommerce_sale_flash', 10, 3 );
}

// customize the beginning of the product
if( !function_exists( 'berger_woocommerce_before_shop_loop_item_title' ) ){
	
	remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
	remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );	
	
	function berger_woocommerce_before_shop_loop_item_title(){
		
		woocommerce_show_product_loop_sale_flash();
		
		woocommerce_template_loop_product_thumbnail();
		
		echo '<div class="product_overlay">';
		 
		woocommerce_template_loop_price();
	}
	
	add_action( 'woocommerce_before_shop_loop_item_title', 'berger_woocommerce_before_shop_loop_item_title', 10 );
}

// customize the end of the product
if( !function_exists( 'berger_woocommerce_after_shop_loop_item_title' ) ){
	
	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
		
	function berger_woocommerce_after_shop_loop_item_title(){
		
		echo '</div>'; //product_overlay
	}
	
	add_action( 'woocommerce_after_shop_loop_item_title', 'berger_woocommerce_after_shop_loop_item_title', 10 );
}

//customize single product summary
if( !function_exists( 'berger_woocommerce_single_product_summary' ) ){
	
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
			
	function berger_woocommerce_single_product_summary(){
		
		woocommerce_template_single_title();
		woocommerce_template_single_rating();
		echo '<br>';
		woocommerce_template_single_price();
		woocommerce_template_single_excerpt();
		echo '<br>';
		woocommerce_template_single_add_to_cart();
		woocommerce_template_single_meta();
		woocommerce_template_single_sharing();
	}
	
	add_action( 'woocommerce_single_product_summary', 'berger_woocommerce_single_product_summary', 5 );
}

// Product description heading
if( !function_exists( 'berger_wwoocommerce_product_description_heading' ) ){
	
	function berger_woocommerce_product_description_heading( $heading ){

		return '';
	}

	add_filter( 'woocommerce_product_description_heading', 'berger_woocommerce_product_description_heading', 10 );
}

// Before and after add to cart button - single product page
if( !function_exists( 'berger_woocommerce_before_add_to_cart_form' ) ){
	
	function berger_woocommerce_before_add_to_cart_form(){
		
		echo '<div class="variations_button">';
	}
	
	add_action( 'woocommerce_before_add_to_cart_form', 'berger_woocommerce_before_add_to_cart_form', 10 );
}

if( !function_exists( 'berger_woocommerce_after_add_to_cart_form' ) ){
	
	function berger_woocommerce_after_add_to_cart_form(){
		
		echo '</div>';
	}
	
	add_action( 'woocommerce_after_add_to_cart_form', 'berger_woocommerce_after_add_to_cart_form', 10 );
}

// customize the product_price
if( !function_exists( 'berger_woocommerce_sale_flash' ) ){

	function berger_woocommerce_sale_flash( $output, $post, $product ){
		
		$output = '<span class="onsale monospace">' . __('Sale', THEME_LANGUAGE_DOMAIN) . '</span>';

		return $output;
	}
	
	add_filter( 'woocommerce_sale_flash', berger_woocommerce_sale_flash, 10, 3 );
}

// set the number of columns for products in shop page
if( !function_exists( 'berger_loop_shop_columns' ) ) {

	function berger_loop_shop_columns() {
		
		global $clapat_bg_theme_options;
		
		return $clapat_bg_theme_options['clapat_bg_shop_columns'];
	}
	
	add_filter('loop_shop_columns', 'berger_loop_shop_columns');
} 

// hack to allow price filter widget displayed into the page. Original WC_Query::price_filter_init()
if( !function_exists( 'berger_price_filter_init' ) ) {
	

	function berger_price_filter_init() {
	
		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
	
		wp_register_script( 'wc-jquery-ui-touchpunch', WC()->plugin_url() . '/assets/js/frontend/jquery-ui-touch-punch' . $suffix . '.js', array( 'jquery-ui-slider' ), WC_VERSION, true );
		wp_register_script( 'wc-price-slider', WC()->plugin_url() . '/assets/js/frontend/price-slider' . $suffix . '.js', array( 'jquery-ui-slider', 'wc-jquery-ui-touchpunch' ), WC_VERSION, true );
	
		wp_localize_script( 'wc-price-slider', 'woocommerce_price_slider_params', array(
			'currency_symbol' 	=> get_woocommerce_currency_symbol(),
			'currency_pos'      => get_option( 'woocommerce_currency_pos' ),
			'min_price'			=> isset( $_GET['min_price'] ) ? esc_attr( $_GET['min_price'] ) : '',
			'max_price'			=> isset( $_GET['max_price'] ) ? esc_attr( $_GET['max_price'] ) : ''
		) );
	
		add_filter( 'loop_shop_post_in', 'berger_price_filter' );
	
	}
	add_action( 'init', 'berger_price_filter_init' );
	
	function berger_price_filter( $filtered_posts = array() ) {
		    
		global $wpdb;
	
		if ( isset( $_GET['max_price'] ) || isset( $_GET['min_price'] ) ) {
	
			$matched_products = array();
			$min              = isset( $_GET['min_price'] ) ? floatval( $_GET['min_price'] ) : 0;
			$max              = isset( $_GET['max_price'] ) ? floatval( $_GET['max_price'] ) : 9999999999;
	
		    $matched_products_query = apply_filters( 'woocommerce_price_filter_results', $wpdb->get_results( $wpdb->prepare( '
		        	SELECT DISTINCT ID, post_parent, post_type FROM %1$s
					INNER JOIN %2$s ON ID = post_id
					WHERE post_type IN ( "product", "product_variation" )
					AND post_status = "publish"
					AND meta_key IN ("' . implode( '","', apply_filters( 'woocommerce_price_filter_meta_keys', array( '_price' ) ) ) . '")
					AND meta_value BETWEEN %3$d AND %4$d
				', $wpdb->posts, $wpdb->postmeta, $min, $max ), OBJECT_K ), $min, $max );
	
		    if ( $matched_products_query ) {
		    	foreach ( $matched_products_query as $product ) {
		        	if ( $product->post_type == 'product' ) {
		            	$matched_products[] = $product->ID;
		            }
		            if ( $product->post_parent > 0 && ! in_array( $product->post_parent, $matched_products ) ) {
		                 $matched_products[] = $product->post_parent;
		            }
		        }
		   	}
	
		   	// Filter the id's
		   	if ( 0 === sizeof( $filtered_posts ) ) {
				$filtered_posts = $matched_products;
		   	} else {
				$filtered_posts = array_intersect( $filtered_posts, $matched_products );
	
		    }
		    $filtered_posts[] = 0;
		}
	
		return (array) $filtered_posts;
	}
	
}

?>