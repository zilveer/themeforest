<?php
/**
 * Woocommerce configuration file
 */

// Adds theme support for woocommerce
add_theme_support('woocommerce');

//Disable the default WooCommerce stylesheet.
if ( version_compare( WOOCOMMERCE_VERSION, "2.1" ) >= 0 ) {
	add_filter( 'woocommerce_enqueue_styles', '__return_false' );
} else {
	define( 'WOOCOMMERCE_USE_CSS', false );
}

if (!function_exists('suprema_qodef_woocommerce_content')){
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
	function suprema_qodef_woocommerce_content() {

		if ( is_singular( 'product' ) ) {

			while ( have_posts() ) : the_post();

				wc_get_template_part( 'content', 'single-product' );

			endwhile;

		} else {

			if ( have_posts() ) :

				do_action('woocommerce_before_shop_loop');

				woocommerce_product_loop_start();

				woocommerce_product_subcategories();

				while ( have_posts() ) : the_post();

					wc_get_template_part( 'content', 'product' );

				endwhile; // end of the loop.

				woocommerce_product_loop_end();

				do_action('woocommerce_after_shop_loop');

			elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) :

				wc_get_template( 'loop/no-products-found.php' );

			endif;

		}
	}
}

if(!function_exists('suprema_qodef_register_my_account_menu_nav')) {
    function suprema_qodef_register_my_account_menu_nav() {
	    register_nav_menus(
		    array(
				'myaccount-navigation' => esc_html__('My Account Dropdown', 'suprema')
		    )
	    );
    }

	add_action('after_setup_theme', 'suprema_qodef_register_my_account_menu_nav');
}

/* GENERAL SETTINGS START */

//Define number of products per page
add_filter('loop_shop_per_page', 'suprema_qodef_woocommerce_products_per_page', 20);

//Set number of related products
add_filter( 'woocommerce_output_related_products_args', 'suprema_qodef_woocommerce_related_products_args');

//Change position of cross sels on cart page
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
add_action( 'woocommerce_after_cart', 'woocommerce_cross_sell_display' );

/* GENERAL SETTINGS END */

/* PRODUCT LIST START */

//Overide Product List Loop Title
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
add_action( 'woocommerce_shop_loop_item_title', 'suprema_qodef_woocommerce_template_loop_product_title', 10 );

//Product List Title Add Link
add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 5 );
add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 5 );

//Override Product List Loop Add To Cart
add_filter('woocommerce_loop_add_to_cart_link', 'suprema_qodef_woocommerce_loop_add_to_cart_link');

//Override Product List Rating
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

//Add Out Of Stock Label On Product List
add_action( 'woocommerce_before_shop_loop_item_title', 'suprema_qodef_get_woocommerce_out_of_stock', 5);

//Override Product List Link To Wrap Only Image
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 15);

//Override Product List Loop Pagination
add_filter('woocommerce_pagination_args', 'suprema_qodef_woocommerce_loop_pagination');

//Other hooks are placed in woocommerce-template-hoooks.php beacuse they depend of global options
//Check suprema_qodef_woocommerce_shop_loop_load_style_based_hooks() function

/* PRODUCT LIST END */

/* SINGLE PRODUCT START */

//Single Product Title template override
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
add_action( 'woocommerce_single_product_summary', 'suprema_qodef_woocommerce_template_single_title', 5 );

//Single Product override meta position
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
add_action('woocommerce_before_add_to_cart_button', 'woocommerce_template_single_meta', 30);

//Single Product override add to cart position
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 40);

//Single product add social share)
add_action( 'woocommerce_after_single_product_summary', 'suprema_qodef_woocommerce_share', 5);

//Sale flash template override
add_filter( 'woocommerce_sale_flash', 'suprema_qodef_woocommerce_sale_flash');
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
add_action( 'suprema_qodef_woocommerce_sale_single_action', 'woocommerce_show_product_sale_flash', 10 );

//Single Product Add Out Of Stock Label On Product
add_action( 'suprema_qodef_woocommerce_out_of_stock_single_action', 'suprema_qodef_get_woocommerce_out_of_stock');

/* SINGLE PRODUCT END */

//Override Checkout Fields
add_filter('woocommerce_checkout_fields', 'suprema_qodef_custom_override_checkout_fields');

//Set Woocommerce button style
//Simple and grouped products
add_action('suprema_qodef_woocommerce_add_to_cart_button', 'suprema_qodef_get_woocommerce_add_to_cart_button');

//External product
add_action('suprema_qodef_woocommerce_add_to_cart_button_external', 'suprema_qodef_get_woocommerce_add_to_cart_button_external');

//Variable product
remove_action( 'woocommerce_single_variation', 'woocommerce_single_variation_add_to_cart_button', 20 );
add_action( 'woocommerce_single_variation', 'suprema_qodef_woocommerce_single_variation_add_to_cart_button', 20 );

//Apply Coupon Button
add_action('suprema_qodef_woocommerce_apply_coupon_button', 'suprema_qodef_get_woocommerce_apply_coupon_button');

//Update Cart
add_action('suprema_qodef_woocommerce_update_cart_button', 'suprema_qodef_get_woocommerce_update_cart_button');

//Proceed To Checkout Button
remove_action( 'woocommerce_proceed_to_checkout', 'woocommerce_button_proceed_to_checkout', 20 );
add_action( 'woocommerce_proceed_to_checkout', 'suprema_qodef_woocommerce_button_proceed_to_checkout', 20 );

//Update Totals Button, Shipping Calculator
add_action('suprema_qodef_woocommerce_update_totals_button', 'suprema_qodef_get_woocommerce_update_totals_button');

//Pay For Order Button, Checkout page
add_filter('woocommerce_pay_order_button_html', 'suprema_qodef_woocommerce_pay_order_button_html');

//Place Order Button, Checkout page
add_filter('woocommerce_order_button_html', 'suprema_qodef_woocommerce_order_button_html');

//Add to cart button shortcode
add_action('suprema_qodef_woocommerce_custom_add_to_cart_button_shortocde', 'woocommerce_template_single_add_to_cart');

