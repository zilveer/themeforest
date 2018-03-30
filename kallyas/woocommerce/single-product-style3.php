<?php if(! defined('ABSPATH')){ return; }

/**
 * Wrap WooCommerce Tabs in section
 */
add_action( 'woocommerce_after_single_product_summary',  'zn_wrap_prodpage_tabs', 9);
add_action( 'woocommerce_after_single_product_summary',  'zn_close_wrappings', 11);
function zn_wrap_prodpage_tabs()
{
	echo '<div class="wc-tabs-section">';
		echo '<div class="container">';
			echo '<div class="row">';
				echo '<div class="col-sm-12">';
}
/**
 * Wrap Related products & Upsells in section
 */
add_action( 'woocommerce_after_single_product_summary',  'zn_wrap_prodpage_rel_upsells', 14);
add_action( 'woocommerce_after_single_product_summary',  'zn_close_wrappings', 21);
function zn_wrap_prodpage_rel_upsells()
{
	echo '<div class="wc-related-upsells-section">';
		echo '<div class="container">';
			echo '<div class="row">';
				echo '<div class="col-sm-12">';
}
/**
 * Close Wrappings
 */
function zn_close_wrappings()
{
				echo '</div>';
			echo '</div>';
		echo '</div>';
	echo '</div>';
}


add_action( 'woocommerce_before_single_product_summary', 'zn_add_image_div', 2);
add_action( 'woocommerce_before_single_product_summary',  'zn_close_div', 20);
function zn_add_image_div()
{
	echo '<div class="fxb-row fxb-row-col-sm fxb-row-col-md product-page">';
		echo '<div class="fxb-col single_product_main_image fxb fxb-center-y fxb-center-x">';
}

add_action( 'woocommerce_before_single_product_summary', 'zn_add_summary_div', 25);
add_action( 'woocommerce_after_single_product_summary',  'zn_close_div', 3);
add_action( 'woocommerce_after_single_product_summary',  'zn_close_div', 8);
function zn_add_summary_div()
{
	echo '<div class="fxb-col main-data">';
}


add_action( 'woocommerce_product_thumbnails', 'zn_woocommerce_product_thumbnails_move' );
function zn_woocommerce_product_thumbnails_move() {
    remove_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20 );
    // Move thumbnails over the excerpt
    add_action('woocommerce_single_product_summary', 'woocommerce_show_product_thumbnails', 19);
}


/**
 * SET PRODUCT GALLERY IMAGES TO 4 COLUMNS
 */
add_filter ( 'woocommerce_product_thumbnails_columns', 'zn_woocommerce_product_thumbnails_columns' );
function zn_woocommerce_product_thumbnails_columns() {
    return 5; // .last class applied to every 4th thumbnail
}
