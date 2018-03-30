<?php
// $productsperpage will set products per page
// $wish_hide_prices: options are yes and no.
// $wish_catalog options are enabled and disabled

$redux_wish = wish_redux();

$cata_mode = $redux_wish["wish-woocommerce-catalog-mode"];
$show_prices = $redux_wish["wish-woocommerce-show-prices"];

$wish_catalog = '';
$wish_hide_prices = '';


if($cata_mode){
    $wish_catalog = 'enabled';
}

if($show_prices){
    $wish_hide_prices = 'yes';
}


remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

add_action('woocommerce_after_shop_loop_item_title', 'get_star_rating' );
function get_star_rating()
{
    global $woocommerce, $product;
    $average = $product->get_average_rating();
if(is_shop()){
    echo '<div class="star-rating"><span style="width:'.( ( $average / 5 ) * 100 ) . '%"><strong itemprop="ratingValue" class="rating">'.$average.'</strong> '.__( 'out of 5', 'woocommerce' ).'</span></div>';
}
}

//remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );


add_action( 'wp', 'init' );

function init() {

  if ( is_shop() ) {

   add_filter( 'woocommerce_enqueue_styles', 'jk_dequeue_styles' );


  }

}
//
function jk_dequeue_styles( $enqueue_styles ) {
	unset( $enqueue_styles['woocommerce-layout'] );		// Remove the layout
	unset( $enqueue_styles['woocommerce-smallscreen'] );	// Remove the smallscreen optimisation
	return $enqueue_styles;
}

$wish_options['productsperpage'] = 6;
$productsperpage = '';
if ( isset( $wish_options['productsperpage'] ) ) {
    $productsperpage = $wish_options['productsperpage'];
}

// Number of products per page
if ( $productsperpage ) {
    add_filter( 'loop_shop_per_page', create_function( '$cols', "return $productsperpage;" ), 20 );
}

// Catalogue Mode
function wish_enable_catalog() {
    remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
    remove_action( 'woocommerce_simple_add_to_cart', 'woocommerce_simple_add_to_cart', 30 );
    remove_action( 'woocommerce_grouped_add_to_cart', 'woocommerce_grouped_add_to_cart', 30 );
    remove_action( 'woocommerce_variable_add_to_cart', 'woocommerce_variable_add_to_cart', 30 );
    remove_action( 'woocommerce_external_add_to_cart', 'woocommerce_external_add_to_cart', 30 );
}

// Hide prices
function wish_hide_prices() {
    remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
}

// Enable catalog mode 
if ( $wish_catalog == 'enabled' ) {
    add_action( 'init', 'wish_enable_catalog' );
}

if ( $wish_hide_prices == 'yes' ) {
    add_action( 'init', 'wish_hide_prices' );
}






/* Breadcrumb tweaks */

add_filter( 'woocommerce_breadcrumb_defaults', 'wish_breadcrumb_delimiter_change' );

function wish_breadcrumb_delimiter_change( $defaults ) {
    // Change the breadcrumb delimiter from '/' to '>'
    $defaults['delimiter'] = ' <i class="fa fa-angle-right"></i> ';
    return $defaults;
}
?>