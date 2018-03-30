<?php

// Registrer Script
function flatsome_lightbox_script(){
     global $extensions_uri;
    // Use `get_stylesheet_directory_uri() if your script is inside your theme or child theme.
     wp_register_script( 'ux-quick-view', $extensions_uri.'/flatsome-wc-quick-view/flatsome-quick-view.js', array('flatsome-js'), 3.0, true);

}
add_action( 'wp_enqueue_scripts', 'flatsome_lightbox_script' );

// Add Button to Grid Tools
function flatsome_lightbox_button(){
    if(get_theme_mod('disable_quick_view', 0)) return;

    // Run Quick View Script
    wp_enqueue_script('wc-add-to-cart-variation');
    wp_enqueue_script('ux-quick-view');

    global $product;
    echo '  <a class="quick-view" data-prod="'.$product->id.'" href="#quick-view">'.__('Quick View','flatsome').'</a>';
}
add_action('flatsome_product_box_actions', 'flatsome_lightbox_button', 50);

/* Add stuff to lightbox */
add_action( 'woocommerce_single_product_lightbox_summary', 'woocommerce_template_single_price', 10 );
add_action( 'woocommerce_single_product_lightbox_summary', 'woocommerce_template_single_excerpt', 20 );

if(!get_theme_mod('product_info_meta')){
    remove_action('woocommerce_single_product_lightbox_summary','woocommerce_template_single_meta',40);
}
add_action( 'woocommerce_single_product_lightbox_summary', 'woocommerce_template_single_add_to_cart', 30 );
add_action( 'woocommerce_before_single_product_lightbox_summary','woocommerce_show_product_sale_flash', 20);

// Quick View Output
function flatsome_quickview() {
    global $post, $product, $woocommerce;
    $prod_id =  $_POST["product"];
    $post = get_post($prod_id);
    $product = get_product($prod_id);
    ob_start();

    woocommerce_get_template('content-single-product-lightbox.php');

    $output = ob_get_contents();
    ob_end_clean();
    echo $output;
    die();
}

add_action('wp_ajax_flatsome_quickview', 'flatsome_quickview');
add_action('wp_ajax_nopriv_flatsome_quickview', 'flatsome_quickview');