<?php
/**
 * Woocommerce configuration file
 */

// Adds theme support for woocommerce
add_theme_support('woocommerce');

//Disable the default WooCommerce stylesheet.
if (version_compare(WOOCOMMERCE_VERSION, "2.1") >= 0) {
    add_filter('woocommerce_enqueue_styles', '__return_false');
} else {
    define('WOOCOMMERCE_USE_CSS', false);
}

if (!function_exists('hashmag_mikado_woocommerce_content')) {
    /**
     * Output WooCommerce content.
     *
     * This function is only used in the optional 'woocommerce.php' template
     * which people can add to their themes to add basic woocommerce support
     * without hooks or modifying core templates.
     *
     * @access public
     * @return void
     */
    function hashmag_mikado_woocommerce_content() {

        if (is_singular('product')) {

            while (have_posts()) : the_post();

                wc_get_template_part('content', 'single-product');

            endwhile;

        } else {

            if (have_posts()) :

                do_action('woocommerce_before_shop_loop');

                woocommerce_product_loop_start();

                woocommerce_product_subcategories();

                while (have_posts()) : the_post();

                    wc_get_template_part('content', 'product');

                endwhile; // end of the loop.

                woocommerce_product_loop_end();

                do_action('woocommerce_after_shop_loop');

            elseif (!woocommerce_product_subcategories(array('before' => woocommerce_product_loop_start(false), 'after' => woocommerce_product_loop_end(false)))) :

                wc_get_template('loop/no-products-found.php');

            endif;
        }
    }
}

//Define number of products per page
add_filter('loop_shop_per_page', 'hashmag_mikado_woocommerce_products_per_page', 20);

//Define number of products per page
add_filter('woocommerce_product_tabs', 'hashmag_mikado_woocommerce_tab_additional_info');

//Set number of related products
add_filter('woocommerce_output_related_products_args', 'hashmag_mikado_woocommerce_related_products_args');

//Overide Product List Loop Title
remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
add_action('woocommerce_shop_loop_item_title', 'hashmag_mikado_woocommerce_template_loop_product_title', 10);

//List Product override price position
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
add_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 4);

//remove rating from product in list and put it before title
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
add_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);

//Override Product List Loop Add To Cart
add_filter('woocommerce_loop_add_to_cart_link', 'hashmag_mikado_woocommerce_loop_add_to_cart_link');


//Single Product override price position
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
add_action('woocommerce_single_product_summary', 'hashmag_mikado_woocommerce_template_single_title', 5);

//Single Product override price position
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 25);

//Single Product override tabs position
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
add_action('woocommerce_single_product_summary', 'woocommerce_output_product_data_tabs', 60);

//Single product add social share (default woocommerce_share)
add_action('woocommerce_single_product_summary', 'hashmag_mikado_woocommerce_share', 65);

//Sale flash template override
add_filter('woocommerce_sale_flash', 'hashmag_mikado_woocommerce_sale_flash');

// Place Button on center of image
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
add_action('hashmag_mikado_woocommerce_loop_sale_flash', 'woocommerce_show_product_loop_sale_flash', 10);

// Remove initial link on shop product on list cuz there is link over image
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );