<?php


if ( ! defined( 'ABSPATH' ) ) exit;

if ( function_exists('WC') ) {
	add_action( 'after_setup_theme', 'boutique_woocommerce_support' );
	function boutique_woocommerce_support() {
		add_theme_support( 'woocommerce' );
	}

	add_filter( 'loop_shop_columns', 'boutique_loop_columns' );
	if ( ! function_exists( 'boutique_loop_columns' ) ) {
		function boutique_loop_columns() {
			return 4; // 3 products per row
		}
	}
	function boutique_woocommerce_column_class( $classes ) {
		if ( function_exists( 'is_woocommerce' ) && is_woocommerce() ) {
			$classes[] = 'columns-4';
		}

		return $classes;
	}

	add_filter( 'body_class', 'boutique_woocommerce_column_class' );


	add_filter( 'add_to_cart_text', 'woo_archive_custom_cart_button_text' );                        // < 2.1
	add_filter( 'woocommerce_product_add_to_cart_text', 'woo_archive_custom_cart_button_text' );    // 2.1 +
	add_filter( 'woocommerce_loop_add_to_cart_link', 'dtbaker_woocommerce_loop_add_to_cart_link', 10, 3 );
	add_filter( 'woocommerce_product_add_to_cart_url', 'dtbaker_woocommerce_product_add_to_cart_url', 10, 2 );
	add_filter( 'woocommerce_after_shop_loop_item_title', 'dtbaker_woocommerce_after_shop_loop_item_title', 1);
	//remove_filter( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
	//remove_filter( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
	remove_action( 'woocommerce_before_single_product', 'wc_print_notices', 10 );
	add_action( 'boutique_page_header_after', 'wc_print_notices', 100 );

	function dtbaker_woocommerce_after_shop_loop_item_title(){
		echo '<div class="boutique_product_category">';
		$categories = array();
		$terms = get_the_terms( get_the_ID(), 'product_cat', '', ', ', '' );
		if(is_array($terms)) {
			foreach ( $terms as $category ) {
				$categories[ $category->term_id ] = $category->name;
			}
		}
		echo implode(' &raquo; ',$categories);
		echo '</div>';
	}
	// hack for before/after title header.
	function dtbaker_woocommerce_show_page_title($tf){
		static $done = false;
		if($tf && !$done){
			$done = true;
			do_action('boutique_page_header_before');
		}
		return $tf;
	}
	function dtbaker_woocommerce_archive_description(){
		static $done = false;
		if(!$done){
			$done = true;
			do_action('boutique_page_header_after');
		}
	}
	add_filter('woocommerce_show_page_title', 'dtbaker_woocommerce_show_page_title', 10, 1);
	add_action('woocommerce_archive_description', 'dtbaker_woocommerce_archive_description');

	function woo_archive_custom_cart_button_text() {
        return __( 'Add', 'boutique-kids' );
	}

	function dtbaker_woocommerce_loop_add_to_cart_link($url, $product=array(), $link=array()){
		return preg_replace('#class="[^"]*"#','class="dtbaker_button_light"',$url);
	}
	function dtbaker_woocommerce_product_add_to_cart_url($url, $obj){
		if(isset($obj->id) && $obj->id > 0){
			$url = add_query_arg(array(
				'add-to-cart'=>$obj->id,
			),get_permalink($obj->id));
		}
		return $url;
	}

	// stop default pages from getting installed by woocommerce. we create these in our default options are.
    function dtbaker_woocommerce_stop_default_pages(){
	    return 0;
    }
	add_filter('pre_option__wc_needs_pages','dtbaker_woocommerce_stop_default_pages');

	// style success message
    function dtbaker_wc_add_to_cart_message($message, $product_id){
	    return str_replace('button wc-forward','dtbaker_button_light',$message);
    }
	add_filter('wc_add_to_cart_message','dtbaker_wc_add_to_cart_message', 10, 2);
    function dtbaker_woocommerce_single_product_image_html($message, $product_id){
	    $message = str_replace('woocommerce-main-image','woocommerce-main-image fancy_border',$message);
	    $message = preg_replace('#<img[^>]*>#','<div class="woo-image-wrap">$0</div>',$message);
	    return $message;
    }
	add_filter('woocommerce_single_product_image_html','dtbaker_woocommerce_single_product_image_html', 10, 2);


    //add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );

    // copied from woocommerce-template.php
    /*function woocommerce_get_product_thumbnail( $size = 'shop_catalog', $placeholder_width = 0, $placeholder_height = 0  ) {
		global $post;

		if ( has_post_thumbnail() )
			$d = get_the_post_thumbnail( $post->ID, $size );
		elseif ( woocommerce_placeholder_img_src() )
			$d = woocommerce_placeholder_img( $size );
        else
            $d = '';
        return '<div class="fancy_border">'.$d.'</div>';
	}*/

	add_filter( 'woocommerce_output_related_products_args', 'dtbaker_related_products_args' );
	  function dtbaker_related_products_args( $args ) {

		$args['posts_per_page'] = 4; // 4 related products
		$args['columns'] = 4; // arranged in 2 columns
		return $args;
	}

	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
	add_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_upsells', 15 );

	if ( ! function_exists( 'woocommerce_output_upsells' ) ) {
		function woocommerce_output_upsells() {
		    woocommerce_upsell_display( 4,4 ); // Display 3 products in rows of 3
		}
	}


}