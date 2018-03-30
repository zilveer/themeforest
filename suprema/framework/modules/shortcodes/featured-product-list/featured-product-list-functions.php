<?php
if(!function_exists('suprema_qodef_get_featured_product_list_filters')) {
    function suprema_qodef_get_featured_product_list_filters($params) {

        add_action('suprema_qodef_p_featured_woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
        add_action('suprema_qodef_p_featured_woocommerce_before_shop_loop_item_title', 'suprema_qodef_get_featured_product_list_image', 10);
        add_action('suprema_qodef_p_featured_woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 15);

        
        add_action('suprema_qodef_p_featured_woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 10);
        add_action('suprema_qodef_p_featured_woocommerce_shop_loop_item_title', 'suprema_qodef_get_featured_product_list_title', 15, 1);
        add_action('suprema_qodef_p_featured_woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 5);
		
		add_action('suprema_qodef_p_featured_woocommerce_shop_loop_item_categories', 'suprema_qodef_woocommerce_shop_loop_categories', 5);
		
    }

    add_action( 'suprema_qodef_before_featured_product_list', 'suprema_qodef_get_featured_product_list_filters', 5, 1);
}

/**
 * Creates title with selected tag
 *
 * @param $params
 * @return string
 */

if(!function_exists('suprema_qodef_get_featured_product_list_title')) {
    function suprema_qodef_get_featured_product_list_title($params){
        $tag = 'h6';
        return the_title('<' . $tag . ' class="qodef-product-list-product-title">', '</' . $tag . '>', true);
    }
}


/**
 * Get the product thumbnail for the loop.
 *
 * @subpackage	Loop
 */

if (!function_exists( 'suprema_qodef_get_featured_product_list_image' )){
	function suprema_qodef_get_featured_product_list_image() {
		echo woocommerce_get_product_thumbnail('shop_thumbnail');
	}
}