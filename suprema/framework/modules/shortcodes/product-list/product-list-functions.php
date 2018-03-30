<?php

if(!function_exists('suprema_qodef_get_product_list_standard_filters')) {
    function suprema_qodef_get_product_list_standard_filters($params) {

        add_action('suprema_qodef_pl_standard_woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
        add_action('suprema_qodef_pl_standard_woocommerce_before_shop_loop_item', 'suprema_qodef_get_woocommerce_out_of_stock', 5);
        add_action('suprema_qodef_pl_standard_woocommerce_before_shop_loop_item', 'woocommerce_show_product_loop_sale_flash', 5);
        
        add_action('suprema_qodef_pl_standard_woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);

        add_action('suprema_qodef_pl_standard_woocommerce_shop_loop_item_hover_image', 'suprema_qodef_woocommerce_shop_loop_hover_image', 10);

        add_action('suprema_qodef_pl_standard_woocommerce_shop_loop_item_hover_link_close', 'woocommerce_template_loop_product_link_close', 15);

        add_action('suprema_qodef_pl_standard_woocommerce_shop_loop_product_simple_button', 'woocommerce_template_loop_add_to_cart', 5);

        if(suprema_qodef_is_wishlist_installed()) {
            add_action('suprema_qodef_pl_standard_woocommerce_after_shop_loop_item_title', 'suprema_qodef_woocommrece_template_loop_wishlist', 15);
        }


        if($params['display_categories'] != '' && $params['display_categories'] == 'yes') {
            add_action('suprema_qodef_pl_standard_woocommerce_shop_loop_item_categories', 'suprema_qodef_woocommerce_shop_loop_categories', 5);
        }


        add_action('suprema_qodef_pl_standard_woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 5);
        add_action('suprema_qodef_pl_standard_woocommerce_shop_loop_item_title', 'suprema_qodef_get_product_list_title', 10, 1);


        add_action('suprema_qodef_pl_standard_woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 5);
        add_action('suprema_qodef_pl_standard_woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);

    }

    add_action( 'suprema_qodef_before_product_list_standard', 'suprema_qodef_get_product_list_standard_filters', 5, 1);
}

if(!function_exists('suprema_qodef_get_product_list_simple_filters')) {
    function suprema_qodef_get_product_list_simple_filters($params) {

        add_action('suprema_qodef_pl_simple_woocommerce_link_overlay','woocommerce_template_loop_product_link_open',5);
        add_action('suprema_qodef_pl_simple_woocommerce_link_overlay','woocommerce_template_loop_product_link_close',10);

        add_action('suprema_qodef_pl_simple_woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);

        add_action('suprema_qodef_pl_simple_woocommerce_before_shop_loop_item_title', 'suprema_qodef_get_woocommerce_out_of_stock', 5);
        add_action('suprema_qodef_pl_simple_woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
        add_action('suprema_qodef_pl_simple_woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
        add_action('suprema_qodef_pl_simple_woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 15);

        add_action('suprema_qodef_pl_simple_woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 5);
        add_action('suprema_qodef_pl_simple_woocommerce_shop_loop_item_title', 'suprema_qodef_get_product_list_title', 10, 1);

        add_action('suprema_qodef_pl_simple_woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 5);
        if($params['display_categories'] != '' && $params['display_categories'] == 'yes') {
            add_action('suprema_qodef_pl_simple_woocommerce_after_shop_loop_item_title', 'suprema_qodef_woocommerce_shop_loop_categories', 5);
        }
        add_action('suprema_qodef_pl_simple_woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);

        add_action('suprema_qodef_pl_simple_woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);

    }

    add_action( 'suprema_qodef_before_product_list_simple', 'suprema_qodef_get_product_list_simple_filters', 5, 1);
}

if(!function_exists('suprema_qodef_get_product_list_boxed_filters')) {
    function suprema_qodef_get_product_list_boxed_filters($params) {

        add_action('suprema_qodef_pl_simple_woocommerce_link_overlay','woocommerce_template_loop_product_link_open',5);
        add_action('suprema_qodef_pl_simple_woocommerce_link_overlay','woocommerce_template_loop_product_link_close',10);

        add_action('suprema_qodef_pl_boxed_woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);

        add_action('suprema_qodef_pl_boxed_woocommerce_before_shop_loop_item_title', 'suprema_qodef_get_woocommerce_out_of_stock', 5);
        add_action('suprema_qodef_pl_boxed_woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
        add_action('suprema_qodef_pl_boxed_woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
        add_action('suprema_qodef_pl_boxed_woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 15);

        if($params['display_categories'] != '' && $params['display_categories'] == 'yes') {
            add_action('suprema_qodef_pl_boxed_woocommerce_shop_loop_item_title', 'suprema_qodef_woocommerce_shop_loop_categories', 5);
        }
        add_action('suprema_qodef_pl_boxed_woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 10);
        add_action('suprema_qodef_pl_boxed_woocommerce_shop_loop_item_title', 'suprema_qodef_get_product_list_title', 15, 1);

        add_action('suprema_qodef_pl_boxed_woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 5);
        add_action('suprema_qodef_pl_boxed_woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
    }

    add_action( 'suprema_qodef_before_product_list_boxed', 'suprema_qodef_get_product_list_boxed_filters', 5, 1);
}

/**
 * Creates title with selected tag
 *
 * @param $params
 * @return string
 */

if(!function_exists('suprema_qodef_get_product_list_title')) {
    function suprema_qodef_get_product_list_title($params)
    {

        if ($params['title_tag'] != '') {
            $tag = $params['title_tag'];
        } else {
            $tag = 'h5';
        }

        return the_title('<' . $tag . ' class="qodef-product-list-product-title">', '</' . $tag . '>', true);
    }
}
