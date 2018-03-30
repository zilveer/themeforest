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