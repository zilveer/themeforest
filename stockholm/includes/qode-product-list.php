<?php

if(!function_exists('qode_product_list_standard_actions')) {
    function qode_product_list_standard_actions($params) {


        add_action('qode_action_pl_standard_woocommerce_before_shop_loop_item', 'woocommerce_show_product_loop_sale_flash', 5);
        add_action('qode_action_pl_standard_woocommerce_before_shop_loop_item', 'qode_get_woocommerce_out_of_stock', 5);
        add_action('qode_action_pl_standard_woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);

        add_action('qode_action_pl_standard_woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);

        add_action('qode_action_pl_standard_woocommerce_shop_loop_item_hover_image', 'qode_woocommerce_shop_loop_hover_image', 10);

        add_action('qode_action_pl_standard_woocommerce_shop_loop_item_hover_link_close', 'woocommerce_template_loop_product_link_close', 15);

        add_action('qode_action_pl_standard_woocommerce_shop_loop_product_simple_button', 'qode_woocommerce_shop_loop_button', 5);

        if($params['display_categories'] != ''  && $params['display_categories'] == 'yes') {
            add_action('qode_action_pl_standard_woocommerce_shop_loop_item_categories', 'qode_woocommerce_shop_loop_categories', 5);
        }

        add_action('qode_action_pl_standard_woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 5);
        add_action('qode_action_pl_standard_woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
        add_action('qode_action_pl_standard_woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 15);

        add_action('qode_action_pl_standard_woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
    }

    add_action('qode_pl_standard_initial_setup','qode_product_list_standard_actions', 5, 1);
}

if(!function_exists('qode_product_list_simple_actions')) {
    function qode_product_list_simple_actions() {


        add_action('qode_action_pl_simple_woocommerce_before_shop_loop_item', 'woocommerce_show_product_loop_sale_flash', 5);
        add_action('qode_action_pl_simple_woocommerce_before_shop_loop_item', 'qode_get_woocommerce_out_of_stock', 5);
        add_action('qode_action_pl_simple_woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);

        add_action('qode_action_pl_simple_woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);

        add_action('qode_action_pl_simple_woocommerce_shop_loop_item_hover_link_close', 'woocommerce_template_loop_product_link_close', 15);

        add_action('qode_action_pl_simple_woocommerce_shop_loop_item_overlay', 'woocommerce_template_loop_product_link_open', 5);
        add_action('qode_action_pl_simple_woocommerce_shop_loop_item_overlay', 'woocommerce_template_loop_product_link_close', 10);

        add_action('qode_action_pl_simple_woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 5);
        add_action('qode_action_pl_simple_woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
        add_action('qode_action_pl_simple_woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 15);

        add_action('qode_action_pl_simple_woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
    }

    add_action('qode_pl_simple_initial_setup','qode_product_list_simple_actions', 5);
}

if(!function_exists('qode_woocommerce_shop_loop_hover_image')) {
    /**
     * Function that prints hover image on standard product list
     */
    function qode_woocommerce_shop_loop_hover_image() {
        global $product;
        $product_hover_image = '';

        $product_gallery_ids = $product->get_gallery_attachment_ids();
        if (!empty($product_gallery_ids)) {
            //get product image url, shop catalog size
            $product_hover_image = wp_get_attachment_image( $product_gallery_ids[0], 'shop_catalog' );
        }

        print $product_hover_image;
    }
}

if (!function_exists('qode_woocommerce_shop_loop_categories')) {
    /**
     * Function that prints html with product categories
     */
    function qode_woocommerce_shop_loop_categories(){

        global $product;

        $html = '<div class="qodef-product-list-categories">';
        $html .= $product->get_categories(', ');
        $html .= '</div>';

        print $html;
    }
}

if (!function_exists('qode_woocommerce_shop_loop_button')) {
    /**
     * Function that prints button for product list
     */
    function qode_woocommerce_shop_loop_button() {
        global $product;
        /* Adding classes to add to cart button. Should be checked after each woocommerce update */
        $class = ' ';
        $class .= ' button';
        $class .= ' product_type_' . $product->product_type;
        $class .= $product->is_purchasable() && $product->is_in_stock() ? ' add_to_cart_button' : ' ';
        $class .= $product->supports( 'ajax_add_to_cart' ) ? ' ajax_add_to_cart' : ' ';

        $button_text = $product->add_to_cart_text();
        if($product->is_type( 'variable' )) {
            $button_text = esc_html__( 'Options', 'qode' );
        }

        echo apply_filters( 'woocommerce_loop_add_to_cart_link',
            sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="qbutton add-to-cart-button %s">%s</a>',
                esc_url( $product->add_to_cart_url() ),
                esc_attr( isset( $quantity ) ? $quantity : 1 ),
                esc_attr( $product->id ),
                esc_attr( $product->get_sku() ),
                esc_attr( isset( $class ) ? $class : 'button' ),
                esc_html( $button_text )
            ),
            $product );
    }
}

if (!function_exists('qode_get_woocommerce_out_of_stock')) {
    /**
     * Function that prints html with out of stock text if product is out of stock
     */
    function qode_get_woocommerce_out_of_stock(){

        global $product;

        if (!$product->is_in_stock()) {
            print '<span class="onsale out-of-stock-button"><span>' . esc_html__("Out of stock", "qode") . '</span></span>';
        }


    }
}

if(!function_exists('qode_shop_standard_actions')) {
    function qode_shop_standard_actions() {


        add_action('qode_action_shop_standard_woocommerce_before_shop_loop_item', 'woocommerce_show_product_loop_sale_flash', 5);
        add_action('qode_action_shop_standard_woocommerce_before_shop_loop_item', 'qode_get_woocommerce_out_of_stock', 5);
        add_action('qode_action_shop_standard_woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);

        add_action('qode_action_shop_standard_woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);

        add_action('qode_action_shop_standard_woocommerce_shop_loop_item_hover_image', 'qode_woocommerce_shop_loop_hover_image', 10);

        add_action('qode_action_shop_standard_woocommerce_shop_loop_item_hover_link_close', 'woocommerce_template_loop_product_link_close', 15);

        add_action('qode_action_shop_standard_woocommerce_shop_loop_product_simple_button', 'qode_woocommerce_shop_loop_button', 5);

        add_action('qode_action_shop_standard_woocommerce_shop_loop_item_categories', 'qode_woocommerce_shop_loop_categories', 5);

        add_action('qode_action_shop_standard_woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 5);
        add_action('qode_action_shop_standard_woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
        add_action('qode_action_shop_standard_woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 15);

        add_action('qode_action_shop_standard_woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
    }

    add_action('qode_shop_standard_initial_setup','qode_shop_standard_actions');
}

if(!function_exists('qode_shop_simple_actions')) {
    function qode_shop_simple_actions() {


        add_action('qode_action_shop_simple_woocommerce_before_shop_loop_item', 'woocommerce_show_product_loop_sale_flash', 5);
        add_action('qode_action_shop_simple_woocommerce_before_shop_loop_item', 'qode_get_woocommerce_out_of_stock', 5);
        add_action('qode_action_shop_simple_woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);

        add_action('qode_action_shop_simple_woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);

        add_action('qode_action_shop_simple_woocommerce_shop_loop_item_hover_link_close', 'woocommerce_template_loop_product_link_close', 15);

        add_action('qode_action_shop_simple_woocommerce_shop_loop_item_overlay', 'woocommerce_template_loop_product_link_open', 5);
        add_action('qode_action_shop_simple_woocommerce_shop_loop_item_overlay', 'woocommerce_template_loop_product_link_close', 10);

        add_action('qode_action_shop_simple_woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 5);
        add_action('qode_action_shop_simple_woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
        add_action('qode_action_shop_simple_woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 15);

        add_action('qode_action_shop_simple_woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
    }

    add_action('qode_shop_simple_initial_setup','qode_shop_simple_actions');
}