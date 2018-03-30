<?php
/*
 *	contain all changes in woocommerce plugins action - hooks - functions.
 *
 *	@ since majesty 1.0
 */
 
if ( class_exists('woocommerce') ) {
	global $majesty_options;

// Reomve Breadcrumb
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

// Woocommerce loop
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
// @ see sama_woocommerce_subcategory_thumbnail
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);

// in content-product_cat
remove_action( 'woocommerce_before_subcategory_title', 'woocommerce_subcategory_thumbnail', 10 );

// @see function  sama_get_woo_sidebar && see sama_before_woo_sidebar() 
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

/*
 * Single Products
---------------------------------------------------------*/
// change position for price & meta
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

// Upsell Realed Prdocusts
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );


/*
 * Styles
 * Add CSS Class To li
 *
 * @see  sama_woocommerce_post_class() 
 */
add_filter( 'post_class', 'sama_woocommerce_post_class', 10, 1 );

/*
 * Remove WooCommerce default css
 *
 * @see  sama_remove_woocommerce_style() 
 */
add_filter( 'woocommerce_enqueue_styles', 'sama_remove_woocommerce_style', 20, 1);

// Edit Woocommerce Breadcrumb $args
add_filter('woocommerce_breadcrumb_defaults', 'sama_woocommerce_breadcrum_change', 10, 1);

/*
 * Displayed a link to the cart including the number of items present and the cart total
 *
 * @see  sama_cart_link_fragment() 
 */
if ( defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '2.3', '>=' ) ) {
	add_filter( 'woocommerce_add_to_cart_fragments', 'sama_cart_link_fragment' );
} else {
	add_filter( 'add_to_cart_fragments', 'sama_cart_link_fragment' );
}

/*
 * Edit Woocommerce Pagination $args
 *
 * @see  sama_woocommerce_pagination_args() 
 */
add_filter('woocommerce_pagination_args', 'sama_woocommerce_pagination_args');

/*
 * Hide WooCommerce Title in Archive page
 *
 * @see  sama_woocommerce_hidden_page_title() 
 */
add_filter('woocommerce_show_page_title', 'sama_woocommerce_hidden_page_title', 10, 1);

/*
 * Saleflash text
 *
 * @see  sama_woocommerce_saleflash() 
 */
add_filter('woocommerce_sale_flash', 'sama_woocommerce_saleflash');


/*
 * ShortCodes
 * Define Layout in Woocommerce shortcode is display
 * Change columns to be list, grid, masonry, masonry full width, grid full width
 * This filter inside woocommerce plugin class-wc-shortcodes.php
 * this variable used $majesty_options['shortcode_products_query'] && $majesty_options['shortcode_masonrry_loop'] = 1;
 * Declare Variable used in this functions
 *		sama_woocommerce_post_class()
 *		sama_woocommerce_before_shop_loop_item()
 *		sama_woocommerce_after_shop_loop_item()
 *		sama_woocommerce_after_shop_loop_item_100()
 * 
 * @see  sama_woocommerce_shortcode_products_query() 
 */
add_filter('woocommerce_shortcode_products_query', 'sama_woocommerce_shortcode_products_query', 10, 2);

/*
 * Single Product
 */
// wrap short description
add_filter('woocommerce_short_description', 'sama_woocommerce_short_description_wrap', 100);
// Change Large Thumbnail name
add_filter('single_product_large_thumbnail_size', 'sama_custom_single_product_large_thumbnail_size', 1);
// Numner of Columns For Product Thumbnails
add_filter('woocommerce_product_thumbnails_columns', 'sama_woocommerce_product_thumbnails_columns');
// Woo Gravatar size
add_filter('woocommerce_review_gravatar_size', 'sama_woocommerce_review_gravatar_size');
// wrap $args For woo comments
add_filter('woocommerce_product_review_comment_form_args', 'sama_woocommerce_product_review_comment_form_args');
// Number OF Related products
add_filter('woocommerce_output_related_products_args', 'sama_woocommerce_related_products_args');


/*
 * Change Product Image Size
 *
 * @see  sama_woocommerce_image_dimensions()
 */ 
add_action( 'after_switch_theme', 'sama_woocommerce_image_dimensions', 1 );


/*
 * Remove PrettyPhoto and used in theme
 * 
 * @see  sama_dequeue_scripts_woo()
 */
add_action('wp_enqueue_scripts', 'sama_dequeue_scripts_woo', 99 );

/*
 * customize sidebar position in single product
 * 
 * @see  woocommerce_get_sidebar()
 */
add_action('sama_get_woo_sidebar', 'woocommerce_get_sidebar', 10 );

/*
 * Used To Detect Related and Upsells is Displayed
 * 
 * @see  sama_add_css_class_to_li_products()
 */
add_action('woocommerce_after_single_product_summary', 'sama_add_css_class_to_li_products', 1);


/*
 * 	Archive Page
 *	Wrap woocommerce_result_count() && woocommerce_catalog_ordering
 *  @hooked woocommerce_result_count - 20
 *  @hooked woocommerce_catalog_ordering - 30
 */
add_action('woocommerce_before_shop_loop','sama_woocommerce_wrap_before_shop_loop', 1);
add_action('woocommerce_before_shop_loop','sama_woocommerce_wrap_after_before_shop_loop', 100);
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 9 );
add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 11 );
/*
 * 	Archive Page
 *	Used in All WooCommerce Loop
 *  For Masonry And Grid
 */
 
add_action('sama_woocommerce_loop_display_price_rate', 'woocommerce_template_loop_price', 5);
add_action('sama_woocommerce_loop_display_price_rate', 'woocommerce_template_loop_rating', 6);

/*
 * 	Archive Page
 *	Used in All WooCommerce Loop
 *  For List Display
 */
add_action('sama_woocommerce_loop_display_list_add_to_cart', 'woocommerce_template_loop_add_to_cart', 5);
add_action('sama_woocommerce_loop_display_list_excerpt', 'sama_woocommerce_show_product_loop_featured', 8 );
add_action('sama_woocommerce_loop_display_list_excerpt', 'woocommerce_show_product_loop_sale_flash', 10);
add_action('sama_woocommerce_loop_display_list_excerpt', 'woocommerce_template_loop_price', 20);
add_action('sama_woocommerce_loop_display_list_excerpt', 'woocommerce_template_loop_rating', 25);
add_action('sama_woocommerce_loop_display_list_excerpt', 'sama_woocommerce_get_custom_excerpt_display_list', 30);

/*
 * Archive Page
 * This Actions Used To Woocommerce default loop to sort what is display first
 * For Layout Type List, Masonry, Grid
 *
 * @see  sama_woocommerce_before_shop_loop_item()
 */
add_action('woocommerce_before_shop_loop_item','sama_woocommerce_before_shop_loop_item');

/*
 * Archive Page
 * Used in Woocommerce default loop
 * to do some actions depend on layout display List, Masonry, Grid
 *
 * @see  sama_woocommerce_after_shop_loop_item()
 */
add_action('woocommerce_after_shop_loop_item','sama_woocommerce_after_shop_loop_item', 5);

/*
 * Used in Woocommerce loop
 * to do some actions depend on layout display List, Masonry, Grid
 *
 * @see  sama_woocommerce_after_shop_loop_item_100()
 */
add_action('woocommerce_after_shop_loop_item','sama_woocommerce_after_shop_loop_item_100', 100);

/*
 * Woo Shortcodes
 *
 */
// Change thumbnail category size
add_action( 'woocommerce_before_subcategory_title', 'sama_woocommerce_subcategory_thumbnail', 10 );

/*
 * Single Products
---------------------------------------------------------*/

// Wrap Layout For Single Product
add_action('woocommerce_before_main_content', 'sama_woocommerce_woocommerce_before_main_content', 1);
add_action('woocommerce_after_main_content', 'sama_woocommerce_woocommerce_after_main_content', 1);

// wrap product info except image
add_action('woocommerce_before_single_product_summary', 'sama_woocommerce_before_single_product_summary_before_product_images', 2);
add_action('woocommerce_before_single_product_summary', 'sama_woocommerce_show_product_loop_featured', 5 );
// End wrap product info except image
add_action('woocommerce_before_single_product_summary', 'sama_woocommerce_before_single_product_summary_after_product_images', 50);

// Add Css Clearfix after price
add_action( 'woocommerce_single_product_summary', 'sama_woocommerce_template_single_priceafter', 7 );

// change position for price & meta
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 6 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 18 );

// Display Upsell Realed Prdocusts used inside function sama_before_woo_sidebar
add_action('sama_display_upsells_related_products', 'sama_woocommerce_before_upsell_display', 9 );
add_action('sama_display_upsells_related_products', 'woocommerce_upsell_display', 10 );
add_action('sama_display_upsells_related_products', 'sama_woocommerce_after_upsell_display', 11 );
add_action('sama_display_upsells_related_products', 'sama_woocommerce_output_before_related_products', 19 );
add_action('sama_display_upsells_related_products', 'woocommerce_output_related_products', 20 );
add_action('sama_display_upsells_related_products', 'sama_woocommerce_output_after_related_products', 21 );

// End Wrap before tabs
add_action('woocommerce_after_single_product_summary', 'sama_woocommerce_after_single_product_summary_before_tabs', 1);

add_filter('single_product_small_thumbnail_size', 'sama_custom_single_product_small_thumbnail_size', 1);

if( $majesty_options['shop_display_single_images'] == 'owlcarousel' ) {
	
	remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );	
	// using OWL Carouser
	add_action('woocommerce_before_single_product_summary', 'sama_display_single_product_images_thumbnails', 20);
}

add_filter( 'loop_shop_per_page', 'sama_loop_shop_per_page', 20 );

if( ! $majesty_options['shop_display_ordering_result_count'] ) {
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
}
if( $majesty_options['shop_display_categories'] ) {
	add_action('woocommerce_archive_description', 'sama_display_shop_categories', 5);
}
add_action('woocommerce_cart_collaterals', 'sama_add_css_class_to_li_products', 1);

}