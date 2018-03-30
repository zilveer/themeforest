<?php

/*=================================================================================
 * #WooCommerce helper functions
 *=================================================================================*/

if(!function_exists('qode_is_woocommerce_installed')) {
	/**
	 * Function that checks if woocommerce is installed
	 * @return bool
	 */
	function qode_is_woocommerce_installed() {
		return function_exists('is_woocommerce');
	}
}

if(!function_exists('qode_is_woocommerce_page')) {
	/**
	 * Function that checks if current page is woocommerce shop, product or product taxonomy
	 * @return bool
	 *
	 * @see is_woocommerce()
	 */
	function qode_is_woocommerce_page() {
		return function_exists('is_woocommerce') && is_woocommerce();
	}
}

if(!function_exists('qode_is_woocommerce_shop')) {
	/**
	 * Function that checks if current page is shop or product page
	 * @return bool
	 *
	 * @see is_shop()
	 */
	function qode_is_woocommerce_shop() {
		return function_exists('is_shop') && is_shop();
	}
}

if(!function_exists('qode_get_woo_shop_page_id')) {
	/**
	 * Function that returns shop page id that is set in WooCommerce settings page
	 * @return int id of shop page
	 */
	function qode_get_woo_shop_page_id() {
		if(qode_is_woocommerce_installed()) {
			return get_option('woocommerce_shop_page_id');
		}
	}
}

if(!function_exists('qode_is_product_category')) {
	function qode_is_product_category() {
		return function_exists('is_product_category') && is_product_category();
	}
}

if(!function_exists('qode_load_woo_assets')) {
	/**
	 * Function that checks whether WooCommerce assets needs to be loaded.
	 *
	 * @see qode_is_ajax_enabled()
	 * @see qode_is_woocommerce_page()
	 * @see qode_has_woocommerce_shortcode()
	 * @see qode_has_woocommerce_widgets()
	 * @return bool
	 */

	function qode_load_woo_assets() {
		return qode_is_woocommerce_installed() && (qode_is_ajax_enabled() || qode_is_woocommerce_page() ||
			qode_has_woocommerce_shortcode() || qode_has_woocommerce_widgets());
	}
}

if(!function_exists('qode_has_woocommerce_shortcode')) {
	/**
	 * Function that checks if current page has at least one of WooCommerce shortcodes added
	 * @return bool
	 */
	function qode_has_woocommerce_shortcode() {
		$woocommerce_shortcodes = array(
			'woocommerce_order_tracking',
			'add_to_cart',
			'product',
			'products',
			'product_categories',
			'product_category',
			'recent_products',
			'featured_products',
			'woocommerce_messages',
			'woocommerce_cart',
			'woocommerce_checkout',
			'woocommerce_my_account',
			'woocommerce_edit_address',
			'woocommerce_change_password',
			'woocommerce_view_order',
			'woocommerce_pay',
			'woocommerce_thankyou'
		);

		foreach ($woocommerce_shortcodes as $woocommerce_shortcode) {
			$has_shortcode = qode_has_shortcode($woocommerce_shortcode);

			if($has_shortcode) {
				return true;
			}
		}

		return false;
	}
}

if(!function_exists('qode_has_woocommerce_widgets')) {
	/**
	 * Function that checks if current page has at least one of WooCommerce shortcodes added
	 * @return bool
	 */
	function qode_has_woocommerce_widgets() {
		$widgets_array = array(
			'qode_woocommerce_dropdown_cart',
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

		foreach ($widgets_array as $widget) {
			$active_widget = is_active_widget(false, false, $widget);

			if($active_widget) {
				return true;
			}
		}

		return false;
	}
}

if(!function_exists('qode_get_woocommerce_pages')) {
	/**
	 * Function that returns all url woocommerce pages
	 * @return array array of WooCommerce pages
	 *
	 * @version 0.1
	 */
	function qode_get_woocommerce_pages() {
		$woo_pages_array = array();

		if(qode_is_woocommerce_installed()) {
			if(get_option('woocommerce_shop_page_id') != ''){ $woo_pages_array[] = get_permalink(get_option('woocommerce_shop_page_id')); }
			if(get_option('woocommerce_cart_page_id') != ''){ $woo_pages_array[] = get_permalink(get_option('woocommerce_cart_page_id')); }
			if(get_option('woocommerce_checkout_page_id') != ''){ $woo_pages_array[] = get_permalink(get_option('woocommerce_checkout_page_id')); }
			if(get_option('woocommerce_pay_page_id') != ''){ $woo_pages_array[] = get_permalink(get_option(' woocommerce_pay_page_id ')); }
			if(get_option('woocommerce_thanks_page_id') != ''){ $woo_pages_array[] = get_permalink(get_option(' woocommerce_thanks_page_id ')); }
			if(get_option('woocommerce_myaccount_page_id') != ''){ $woo_pages_array[] = get_permalink(get_option(' woocommerce_myaccount_page_id ')); }
			if(get_option('woocommerce_edit_address_page_id') != ''){ $woo_pages_array[] = get_permalink(get_option(' woocommerce_edit_address_page_id ')); }
			if(get_option('woocommerce_view_order_page_id') != ''){ $woo_pages_array[] = get_permalink(get_option(' woocommerce_view_order_page_id ')); }
			if(get_option('woocommerce_terms_page_id') != ''){ $woo_pages_array[] = get_permalink(get_option(' woocommerce_terms_page_id ')); }

			$woo_products = get_posts(array('post_type' => 'product','post_status' => 'publish', 'posts_per_page' => '-1') );

			foreach($woo_products as $product) {
				$woo_pages_array[] = get_permalink($product->ID);
			}
		}

		return $woo_pages_array;
	}
}

if(!function_exists('qode_woocommerce_columns_class')) {
	/**
	 * Function that adds number of columns class to header tag
	 * @param array array of classes from main filter
	 * @return array array of classes with added bottom header appearance class
	 */
	function qode_woocommerce_columns_class($classes) {
		global $qode_options;

		if (in_array("woocommerce", $classes)) {
			$products_list_number = 'columns-3';
			if(isset($qode_options['woo_products_list_number'])){
				$products_list_number = $qode_options['woo_products_list_number'];
			}
			$classes[]= $products_list_number;
			
			$products_list_type="";
			if(isset($qode_options['woo_products_list_type'])){
				$products_list_type = $qode_options['woo_products_list_type'];
			}
			$classes[]= $products_list_type;
		}

		return $classes;
	}

	add_filter('body_class', 'qode_woocommerce_columns_class');
}


/*=================================================================================
 * #Visual Composer helper functions
 *=================================================================================*/

if(!function_exists('qode_visual_composer_installed')) {
	/**
	 * Function that checks if visual composer installed
	 * @return bool
	 */
	function qode_visual_composer_installed() {
		//is Visual Composer installed?
		if(class_exists('WPBakeryVisualComposerAbstract')) {
			return true;
		}

		return false;
	}
}

if(!function_exists('qode_visual_composer_custom_shortcodce_css')) {
	/**
	 * Function that adds Visual composer's custom css to our action. Needed for ajax page transitions
	 */
	function qode_visual_composer_custom_shortcodce_css() {
		if(qode_visual_composer_installed()) {
			if(is_page() || is_single() || is_singular('portfolio_page')) {

				$shortcodes_custom_css = get_post_meta( qode_get_page_id(), '_wpb_shortcodes_custom_css', true );
				if ( ! empty( $shortcodes_custom_css ) ) {
					echo '<style type="text/css" data-type="vc_shortcodes-custom-css-'.esc_attr(qode_get_page_id()).'">';
					echo get_post_meta( qode_get_page_id(), '_wpb_shortcodes_custom_css', true );
					echo '</style>';
				}

				$post_custom_css = get_post_meta( qode_get_page_id(), '_wpb_post_custom_css', true );
				if ( ! empty( $post_custom_css ) ) {
					echo '<style type="text/css" data-type="vc_custom-css-'.esc_attr(qode_get_page_id()).'">';
					echo get_post_meta( qode_get_page_id(), '_wpb_post_custom_css', true );
					echo '</style>';
				}
			}
		}
	}

	add_action('qode_visual_composer_custom_shortcodce_css', 'qode_visual_composer_custom_shortcodce_css');
}

/*=================================================================================
 * #Yoast helper functions
 *=================================================================================*/
if(!function_exists('qode_seo_plugin_installed')) {
	/**
	 * Function that checks if popular seo plugins are installed
	 * @return bool
	 */
	function qode_seo_plugin_installed() {
		//is YOAST installed?
		if(defined('WPSEO_VERSION')) {
			return true;
		}

		return false;
	}
}

if(!function_exists('qode_remove_yoast_json_on_ajax')) {
    /**
     * Function that removes yoast json ld script
     * that stops page transition to work on home page
     * Hooks to wpseo_json_ld_output in order to disable json ld script
     * @return bool
     *
     * @param $data array json ld data that is being passed to filter
     *
     * @version 0.2
     */
    function qode_remove_yoast_json_on_ajax($data) {
        //is current request made through ajax?
        if(qode_is_ajax()) {
            //disable json ld script
            return array();
        }

        return $data;
    }

    //is yoast installed and it's version is greater or equal of 1.6?
    if(defined('WPSEO_VERSION') && version_compare(WPSEO_VERSION, '1.6') >= 0) {
        add_filter('wpseo_json_ld_output', 'qode_remove_yoast_json_on_ajax');
    }
}


/*=================================================================================
 * #Contact Form 7 helper functions
 *=================================================================================*/
if(!function_exists('qode_contact_form_7_installed')) {
	/**
	 * Function that checks if contact form 7 installed
	 * @return bool
	 */
	function qode_contact_form_7_installed() {
		//is Contact Form 7 installed?
		if(defined('WPCF7_VERSION')) {
			return true;
		}

		return false;
	}
}



/*=================================================================================
 * #WPML helper functions
 *=================================================================================*/
if(!function_exists('qode_is_wpml_installed')) {
	/**
	 * Function that checks if WPML plugin is installed
	 * @return bool
	 *
	 * @version 0.1
	 */
	function qode_is_wpml_installed() {
		return defined('ICL_SITEPRESS_VERSION');
	}
}

if(!function_exists('qode_get_wpml_pages_for_current_page')) {
	/**
	 * Function that returns urls translated pages for current page.
	 * @return array array of url urls translated pages for current page.
	 *
	 * @version 0.1
	 */
	function qode_get_wpml_pages_for_current_page() {
		$wpml_pages_for_current_page = array();

		if(qode_is_wpml_installed()) {
			$language_pages = icl_get_languages('skip_missing=0');

			foreach($language_pages as $key => $language_page) {
				$wpml_pages_for_current_page[] = $language_page["url"];
			}
		}

		return $wpml_pages_for_current_page;
	}
}
