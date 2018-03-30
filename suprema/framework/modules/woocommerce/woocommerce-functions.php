<?php
/**
 * Woocommerce helper functions
 */

if(!function_exists('suprema_qodef_woocommerce_assets')) {
    /**
     * Function that includes all necessary scripts for WooCommerce if installed
     */
    function suprema_qodef_woocommerce_assets() {
        //is woocommerce installed?
        if(suprema_qodef_is_woocommerce_installed()) {
            if(suprema_qodef_load_woo_assets() || suprema_qodef_is_ajax_enabled()) {

                //include theme's woocommerce styles
                wp_enqueue_style('qode_woocommerce', QODE_ASSETS_ROOT.'/css/woocommerce.min.css');

                //is responsive option turned on?
                if(suprema_qodef_options()->getOptionValue('responsiveness') == 'yes') {
                    //include theme's woocommerce responsive styles
                    wp_enqueue_style('qode_woocommerce_responsive', QODE_ASSETS_ROOT.'/css/woocommerce-responsive.min.css');
                }
            }
        }
    }

    add_action('wp_enqueue_scripts', 'suprema_qodef_woocommerce_assets');
}

if (!function_exists('suprema_qodef_woocommerce_body_class')) {
	/**
	 * Function that adds class on body for Woocommerce
	 *
	 * @param $classes
	 * @return array
	 */
	function suprema_qodef_woocommerce_body_class( $classes ) {
		if(suprema_qodef_is_woocommerce_page() || suprema_qodef_has_woocommerce_shortcode()) {
			$classes[] = 'qodef-woocommerce-page';
			if (is_singular('product')) {
				$classes[] = 'qodef-woocommerce-single-page';
			}
		}
		return $classes;
	}

	add_filter('body_class', 'suprema_qodef_woocommerce_body_class');

}

if(!function_exists('suprema_qodef_woocommerce_columns_class')) {
	/**
	 * Function that adds number of columns class to header tag
	 *
	 * @param array array of classes from main filter
	 *
	 * @return array array of classes with added bottom header appearance class
	 */
	function suprema_qodef_woocommerce_columns_class($classes) {

		if(in_array('woocommerce', $classes) || in_array('woocommerce-cart', $classes)) {

			$products_list_number = suprema_qodef_options()->getOptionValue('qodef_woo_product_list_columns');
			$classes[] = $products_list_number;

		}

		return $classes;
	}

	add_filter('body_class', 'suprema_qodef_woocommerce_columns_class');
}

if(!function_exists('suprema_qodef_is_woocommerce_page')) {
	/**
	 * Function that checks if current page is woocommerce shop, product or product taxonomy
	 * @return bool
	 *
	 * @see is_woocommerce()
	 */
	function suprema_qodef_is_woocommerce_page() {
		if (function_exists('is_woocommerce') && is_woocommerce()) {
			return is_woocommerce();
		} elseif (function_exists('is_cart') && is_cart()) {
			return is_cart();
		} elseif (function_exists('is_checkout') && is_checkout()) {
			return is_checkout();
		} elseif (function_exists('is_account_page') && is_account_page()) {
			return is_account_page();
		}
	}
}

if(!function_exists('suprema_qodef_is_woocommerce_shop')) {
	/**
	 * Function that checks if current page is shop or product page
	 * @return bool
	 *
	 * @see is_shop()
	 */
	function suprema_qodef_is_woocommerce_shop() {
		return function_exists('is_shop') && (is_shop() || is_product());
	}
}

if(!function_exists('suprema_qodef_get_woo_shop_page_id')) {
	/**
	 * Function that returns shop page id that is set in WooCommerce settings page
	 * @return int id of shop page
	 */
	function suprema_qodef_get_woo_shop_page_id() {
		if(suprema_qodef_is_woocommerce_installed()) {
			return get_option('woocommerce_shop_page_id');
		}
	}
}

if(!function_exists('suprema_qodef_is_product_category')) {
	function suprema_qodef_is_product_category() {
		return function_exists('is_product_category') && is_product_category();
	}
}

if(!function_exists('suprema_qodef_is_product_tag')) {
	function suprema_qodef_is_product_tag() {
		return function_exists('is_product_tag') && is_product_tag();
	}
}

if(!function_exists('suprema_qodef_load_woo_assets')) {
	/**
	 * Function that checks whether WooCommerce assets needs to be loaded.
	 *
	 * @see suprema_qodef_is_woocommerce_page()
	 * @see suprema_qodef_has_woocommerce_shortcode()
	 * @see suprema_qodef_has_woocommerce_widgets()
	 * @return bool
	 */

	function suprema_qodef_load_woo_assets() {
		return suprema_qodef_is_woocommerce_installed() && (suprema_qodef_is_woocommerce_page() ||
			suprema_qodef_has_woocommerce_shortcode() || suprema_qodef_has_woocommerce_widgets());
	}
}

if(!function_exists('suprema_qodef_has_woocommerce_shortcode')) {
	/**
	 * Function that checks if current page has at least one of WooCommerce shortcodes added
	 * @return bool
	 */
	function suprema_qodef_has_woocommerce_shortcode() {
		$woocommerce_shortcodes = array(
			'woocommerce_order_tracking',
			'add_to_cart',
			'add_to_cart_url',
			'product',
			'products',
			'product_categories',
			'product_category',
			'recent_products',
			'featured_products',
			'product_page',
			'woocommerce_messages',
			'woocommerce_cart',
			'woocommerce_checkout',
			'woocommerce_order_tracking',
			'woocommerce_my_account',
			'woocommerce_edit_address',
			'woocommerce_change_password',
			'woocommerce_view_order',
			'woocommerce_pay',
			'woocommerce_thankyou',
			'sale_products',
			'best_selling_products',
			'top_rated_products',
			'product_attribute',
			'related_products',
			'qodef_product_list',
			'yith_wcwl_add_to_wishlist',
			'yith_wcwl_wishlist'
		);

		foreach($woocommerce_shortcodes as $woocommerce_shortcode) {
			$has_shortcode = suprema_qodef_has_shortcode($woocommerce_shortcode);

			if($has_shortcode) {
				return true;
			}
		}

		return false;
	}
}

if(!function_exists('suprema_qodef_has_woocommerce_address')) {
	/**
	 * Function that checks if current page has shortcodes that require woocommerce country select js files
	 */
	function suprema_qodef_has_woocommerce_address(){
		$woocommerce_shortcodes = array(
			'woocommerce_checkout'
		);
		foreach($woocommerce_shortcodes as $woocommerce_shortcode) {
			$has_shortcode = suprema_qodef_has_shortcode($woocommerce_shortcode);

			if($has_shortcode) {
				wp_enqueue_script( 'wc-country-select' );
				wp_enqueue_script( 'wc-address-i18n' );
			}
		}
	}
	add_action('wp_enqueue_scripts', 'suprema_qodef_has_woocommerce_address');
}

if(!function_exists('suprema_qodef_add_woocommerce_shortcode_class')) {
	/**
	 * Function that checks if current page has at least one of WooCommerce shortcodes added
	 * @return string
	 */
	function suprema_qodef_add_woocommerce_shortcode_class($classes){
		$woocommerce_shortcodes = array(
			'woocommerce_order_tracking',
			'woocommerce_my_account',
			'woocommerce_edit_address',
			'woocommerce_change_password',
			'woocommerce_view_order'
		);
		$body_class = '';
		foreach($woocommerce_shortcodes as $woocommerce_shortcode) {
			$has_shortcode = suprema_qodef_has_shortcode($woocommerce_shortcode);
			if($has_shortcode) {
				$classes[] = 'woocommerce-account';
			}
		}
		return $classes;
	}
	add_filter('body_class', 'suprema_qodef_add_woocommerce_shortcode_class');
}

if(!function_exists('suprema_qodef_has_woocommerce_widgets')) {
	/**
	 * Function that checks if current page has at least one of WooCommerce shortcodes added
	 * @return bool
	 */
	function suprema_qodef_has_woocommerce_widgets() {
		$widgets_array = array(
			'qodef_woocommerce_dropdown_cart',
			'qodef_woocommerce_dropdown_login',
			'woocommerce_widget_cart',
			'woocommerce_layered_nav',
			'woocommerce_layered_nav_filters',
			'woocommerce_price_filter',
			'woocommerce_product_categories',
			'woocommerce_product_search',
			'woocommerce_product_tag_cloud',
			'woocommerce_products',
			'woocommerce_recent_reviews',
			'woocommerce_recently_viewed_products',
			'woocommerce_top_rated_products'
		);

		foreach($widgets_array as $widget) {
			$active_widget = is_active_widget(false, false, $widget);

			if($active_widget) {
				return true;
			}
		}

		return false;
	}
}

if(!function_exists('suprema_qodef_get_woocommerce_pages')) {
	/**
	 * Function that returns all url woocommerce pages
	 * @return array array of WooCommerce pages
	 *
	 * @version 0.1
	 */
	function suprema_qodef_get_woocommerce_pages() {
		$woo_pages_array = array();

		if(suprema_qodef_is_woocommerce_installed()) {
			if(get_option('woocommerce_shop_page_id') != '') {
				$woo_pages_array[] = get_permalink(get_option('woocommerce_shop_page_id'));
			}
			if(get_option('woocommerce_cart_page_id') != '') {
				$woo_pages_array[] = get_permalink(get_option('woocommerce_cart_page_id'));
			}
			if(get_option('woocommerce_checkout_page_id') != '') {
				$woo_pages_array[] = get_permalink(get_option('woocommerce_checkout_page_id'));
			}
			if(get_option('woocommerce_pay_page_id') != '') {
				$woo_pages_array[] = get_permalink(get_option(' woocommerce_pay_page_id '));
			}
			if(get_option('woocommerce_thanks_page_id') != '') {
				$woo_pages_array[] = get_permalink(get_option(' woocommerce_thanks_page_id '));
			}
			if(get_option('woocommerce_myaccount_page_id') != '') {
				$woo_pages_array[] = get_permalink(get_option(' woocommerce_myaccount_page_id '));
			}
			if(get_option('woocommerce_edit_address_page_id') != '') {
				$woo_pages_array[] = get_permalink(get_option(' woocommerce_edit_address_page_id '));
			}
			if(get_option('woocommerce_view_order_page_id') != '') {
				$woo_pages_array[] = get_permalink(get_option(' woocommerce_view_order_page_id '));
			}
			if(get_option('woocommerce_terms_page_id') != '') {
				$woo_pages_array[] = get_permalink(get_option(' woocommerce_terms_page_id '));
			}

			$woo_products = get_posts(array('post_type'      => 'product',
				'post_status'    => 'publish',
				'posts_per_page' => '-1'
			));

			foreach($woo_products as $product) {
				$woo_pages_array[] = get_permalink($product->ID);
			}
		}

		return $woo_pages_array;
	}

}

if(!function_exists('suprema_qodef_woocommerce_share')) {
    /**
     * Function that social share for product page
     * Return array array of WooCommerce pages
     */
    function suprema_qodef_woocommerce_share()
    {
        if (suprema_qodef_is_woocommerce_installed()) {

            if (suprema_qodef_options()->getOptionValue('enable_social_share') == 'yes'
                && suprema_qodef_options()->getOptionValue('enable_social_share_on_product') == 'yes') :
                echo suprema_qodef_get_social_share_html();
            endif;
        }
    }

}

if(!function_exists('suprema_qodef_woocommerce_add_meta_box')) {
	/**
	 * Function that adds meta box field to product needed for masonry layout
	 */
	function suprema_qodef_woocommerce_add_meta_box() {
		$meta_box = suprema_qodef_add_meta_box(array(
			'scope' => 'product',
			'title' => 'Product Masonry Settings',
			'name'  => 'product-settings-meta-box'
		));

		suprema_qodef_add_meta_box_field(array(
			'name'        => 'shop_masonry_dimensions',
			'type'        => 'select',
			'label'       => 'Dimensions for Masonry',
			'description' => 'Choose image dimensions for Masonry Shop list',
			'parent'      => $meta_box,
			'options'     => array(
				'default'            => 'Default',
				'large_width'        => 'Large width',
				'large_height'       => 'Large height',
				'large_width_height' => 'Large width/height'
			)
		));
	}

	add_action('suprema_qodef_meta_boxes_map', 'suprema_qodef_woocommerce_add_meta_box');
}


if(!function_exists('suprema_qodef_woocommerce_add_category_thumb_size')) {
	/**
	 * Function that adds  size to category thumbnails
	 */
	function suprema_qodef_woocommerce_add_category_thumb_size() {
		remove_action( 'woocommerce_before_subcategory_title', 'woocommerce_subcategory_thumbnail', 10);
		add_action( 'woocommerce_before_subcategory_title', 'suprema_qodef_woocommerce_subcategory_thumbnail', 10);
	}

	add_action('woocommerce_before_subcategory_title', 'suprema_qodef_woocommerce_add_category_thumb_size', 5);
}


if ( ! function_exists( 'suprema_qodef_woocommerce_subcategory_thumbnail' ) ) {

	/**
	 * Show subcategory thumbnails.
	 *
	 * @param mixed $category
	 * @subpackage	Loop
	 * This is woocomerce function that is copied and only thing that is changed is image size - 'suprema_qodef_landscape'
	 */
	function suprema_qodef_woocommerce_subcategory_thumbnail( $category ) {
		$small_thumbnail_size  	= apply_filters( 'single_product_small_thumbnail_size', 'suprema_qodef_landscape' );
		$dimensions    			= wc_get_image_size( $small_thumbnail_size );
		$thumbnail_id  			= get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true  );

		if ( $thumbnail_id ) {
			$image = wp_get_attachment_image_src( $thumbnail_id, $small_thumbnail_size  );
			$image = $image[0];
		} else {
			$image = wc_placeholder_img_src();
		}

		if ( $image ) {
			// Prevent esc_url from breaking spaces in urls for image embeds
			// Ref: http://core.trac.wordpress.org/ticket/23605
			$image = str_replace( ' ', '%20', $image );

			echo '<img src="' . esc_url( $image ) . '" alt="' . esc_attr( $category->name ) . '" width="' . esc_attr( $dimensions['width'] ) . '" height="' . esc_attr( $dimensions['height'] ) . '" />';
		}
	}

}

if(!function_exists('suprema_qodef_woocommrece_override_wishlist_position')) {
	function suprema_qodef_woocommrece_override_wishlist_position() {
		$order =  array(
			'add-to-cart' => array( 'hook' => 'woocommerce_single_product_summary', 'priority' => 40 ),
			'thumbnails'  => array( 'hook' => 'woocommerce_product_thumbnails', 'priority' => 21 ),
			'summary'     => array( 'hook' => 'woocommerce_after_single_product_summary', 'priority' => 11 )
		);

		return $order;
	}
	add_filter('yith_wcwl_positions', 'suprema_qodef_woocommrece_override_wishlist_position' );
}

if(!function_exists('suprema_qodef_woocommrece_template_loop_wishlist')) {
	function suprema_qodef_woocommrece_template_loop_wishlist() {
		echo do_shortcode('[yith_wcwl_add_to_wishlist]');
	}

}

