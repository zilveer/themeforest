<?php if(! defined('ABSPATH')){ return; }

add_action( 'woocommerce_before_single_product_summary', 'zn_add_image_div', 2);
add_action( 'woocommerce_before_single_product_summary',  'zn_close_div', 21);
function zn_add_image_div()
{
	echo '<div class="row product-page clearfix">';
		echo '<div class="single_product_main_image col-sm-5">';
}

add_action( 'woocommerce_before_single_product_summary', 'zn_add_summary_div', 25);
add_action( 'woocommerce_after_single_product_summary',  'zn_close_div', 3);
add_action( 'woocommerce_after_single_product_summary',  'zn_close_div', 8);
function zn_add_summary_div()
{
	echo '<div class="main-data col-sm-7">';
}


/**
 * SET PRODUCT GALLERY IMAGES TO 4 COLUMNS
 */
add_filter ( 'woocommerce_product_thumbnails_columns', 'zn_woocommerce_product_thumbnails_columns' );
function zn_woocommerce_product_thumbnails_columns() {
    return 4; // .last class applied to every 4th thumbnail
}
