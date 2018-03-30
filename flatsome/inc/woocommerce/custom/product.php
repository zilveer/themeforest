<?php
//
// Shortcodes used for Creating Custom Product Page
/*

function flatsome_custom_product_remove_old_wc_hooks(){
    remove_action('woocommerce_single_product_summary', 'woocommerce_product_breadcrumb',  0 );
    remove_action('woocommerce_single_product_summary','woocommerce_template_single_title', 5);
    remove_action('woocommerce_single_product_summary','woocommerce_template_single_rating', 10);
    remove_action('woocommerce_single_product_summary','woocommerce_template_single_price', 10);
    remove_action('woocommerce_single_product_summary','woocommerce_template_single_excerpt', 20);
    remove_action('woocommerce_single_product_summary','woocommerce_template_single_add_to_cart', 30);
    remove_action('woocommerce_single_product_summary','woocommerce_template_single_meta', 40);
    remove_action('woocommerce_single_product_summary','woocommerce_template_single_sharing', 50);
    remove_action('woocommerce_after_single_product_summary','woocommerce_output_product_data_tabs', 10);
    remove_action('woocommerce_after_single_product_summary','woocommerce_upsell_display', 15);
    remove_action('woocommerce_after_single_product_summary','woocommerce_output_related_products', 20);
  
}

add_action('after_theme_setup','flatsome_custom_product_remove_old_wc_hooks');



function flatsome_custom_product_product_nav_shortcode(){
   if(is_product()){
        echo '<ul class="next-prev-thumbs nav nav-right smallest small-text-center">';
        flatsome_custom_product_next_post_link_product();
        flatsome_custom_product_previous_post_link_product();
        echo '</ul>';
   }
}
add_shortcode('product_nav','flatsome_custom_product_product_nav_shortcode');


function flatsome_custom_product_product_gallery(){
    ob_start();

    wc_get_template( 'single-product/product-image.php' );
    wc_get_template( 'single-product/sale-flash.php' );
    
    $content = ob_get_contents();
    ob_end_clean();

    return $content;}
add_shortcode('product_gallery','flatsome_custom_product_product_gallery');



function woocommerce_product_additional_information_tab_shortcode() {
    ob_start();
    wc_get_template( 'single-product/tabs/additional-information.php' );
    $content = ob_get_contents();
    ob_end_clean();

    return $content;
    }
add_shortcode('product_additional_info','woocommerce_product_additional_information_tab_shortcode');


function flatsome_custom_product_product_info(){

    ob_start();
    do_action( 'woocommerce_single_product_summary' );
    
    $content = ob_get_contents();
    ob_end_clean();

    return $content;
}

add_shortcode('product_info','flatsome_custom_product_product_info');

function flatsome_custom_product_product_sidebar(){
    ob_start();
    
    dynamic_sidebar('product-sidebar');

    $content = ob_get_contents();
    ob_end_clean();

    return $content;
}
add_shortcode('product_sidebar','flatsome_custom_product_product_sidebar');

function flatsome_custom_product_product_tabs(){
     ob_start();

     global $product;

     $tabs = apply_filters( 'woocommerce_product_tabs', array() );

        if ( ! empty( $tabs ) ) : ?>

        <div class="woocommerce-tabs">
            <ul class="product-tabs nav nav-tabs nav-tabs-grow nav-uppercase tabs">
                <?php foreach ( $tabs as $key => $tab ) : ?>

                    <li class="<?php echo $key ?>_tab">
                        <a href="#tab-<?php echo $key ?>"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', $tab['title'], $key ) ?></a>
                    </li>

                <?php endforeach; ?>
            </ul>
            <?php foreach ( $tabs as $key => $tab ) : ?>

                <div class="panel entry-content" id="tab-<?php echo $key ?>">
                    <?php call_user_func( $tab['callback'], $key, $tab ) ?>
                </div>

            <?php endforeach; ?>
        </div>
        <?php

        endif;

    $content = ob_get_contents();
    ob_end_clean();

    return $content;
}

add_shortcode('product_tabs','flatsome_custom_product_product_tabs');


function woocommerce_product_breadcrumb_shortcode() {
     ob_start();
     woocommerce_breadcrumb();

    $content = ob_get_contents();
    ob_end_clean();

    return $content;
}
add_shortcode( 'product_breadcrumb', 'woocommerce_product_breadcrumb_shortcode');


function woocommerce_template_single_title_shortcode() {
    ob_start();
    wc_get_template( 'single-product/title.php' );

    $content = ob_get_contents();
    ob_end_clean();

    return $content;
}
add_shortcode( 'product_title', 'woocommerce_template_single_title_shortcode');


function woocommerce_template_single_rating_shortcode() {
    ob_start();
    wc_get_template( 'single-product/rating.php' );

    $content = ob_get_contents();
    ob_end_clean();

    return $content;
}

add_shortcode( 'product_rating', 'woocommerce_template_single_rating_shortcode');


function woocommerce_template_related_shortcode() {
    ob_start();

    $args = array(
        'posts_per_page'    => 4,
        'columns'           => 4,
        'orderby'           => 'rand'
    );

    woocommerce_related_products( apply_filters( 'woocommerce_output_related_products_args', $args ) );

    $content = ob_get_contents();
    ob_end_clean();

    return $content;
}

add_shortcode( 'product_related', 'woocommerce_template_related_shortcode');



function woocommerce_template_upsell_shortcode() {
    ob_start();

    $posts_per_page = '-1';
    $columns = 4;
    $orderby = 'rand';

    wc_get_template( 'single-product/up-sells.php', array(
            'posts_per_page'    => $posts_per_page,
            'orderby'           => apply_filters( 'woocommerce_upsells_orderby', $orderby ),
            'columns'           => $columns
        ) );

    $content = ob_get_contents();
    ob_end_clean();

    return $content;
}

add_shortcode( 'product_upsell', 'woocommerce_template_upsell_shortcode');




function woocommerce_template_single_price_shortcode() {
    ob_start();
    wc_get_template( 'single-product/price.php' );

    $content = ob_get_contents();
    ob_end_clean();

    return $content;
   
}
add_shortcode( 'product_price', 'woocommerce_template_single_price_shortcode');


function woocommerce_template_single_excerpt_shortcode() {
    ob_start();
    global $product;
    
    wc_get_template( 'single-product/short-description.php' );

    $content = ob_get_contents();
    ob_end_clean();

    return $content;
}
add_shortcode( 'product_excerpt', 'woocommerce_template_single_excerpt_shortcode');


function woocommerce_template_single_meta_shortcode() {
      ob_start();
      wc_get_template( 'single-product/meta.php' );


    $content = ob_get_contents();
    ob_end_clean();

    return $content;
}
add_shortcode( 'product_meta', 'woocommerce_template_single_meta_shortcode');


function woocommerce_template_single_sharing_shortcode() {
        ob_start();
       wc_get_template( 'single-product/share.php' );



    $content = ob_get_contents();
    ob_end_clean();

    return $content;
}
add_shortcode( 'product_share', 'woocommerce_template_single_sharing_shortcode');


function woocommerce_template_single_add_to_cart_shortcode(){
    ob_start();
    global $product;
    do_action( 'woocommerce_' . $product->product_type . '_add_to_cart'  );

    $content = ob_get_contents();
    ob_end_clean();

    return $content;
  
}
add_shortcode( 'product_add_to_cart', 'woocommerce_template_single_add_to_cart_shortcode');




function woocommerce_template_description_shortcode(){
    ob_start();
    global $product;
    wc_get_template( 'single-product/tabs/description.php' );

    $content = ob_get_contents();
    ob_end_clean();

    return $content;
  
}
add_shortcode( 'product_description', 'woocommerce_template_description_shortcode');



function woocommerce_template_reviews_shortcode(){
    ob_start();
    global $product;

    wc_get_template( 'single-product-reviews.php');

    $content = ob_get_contents();
    ob_end_clean();

    return $content;
  
}
add_shortcode( 'product_reviews', 'woocommerce_template_reviews_shortcode');



// Add to UX Builder
if(function_exists('add_ux_builder_shortcode')){
    add_ux_builder_shortcode('product_gallery', array('name' => __( 'Product - Gallery' )) );
    add_ux_builder_shortcode('product_thumbnails', array('name' => __( 'Product - Thumbnails' )) );
    add_ux_builder_shortcode('product_additional_info', array('name' => __( 'Product - Additional Info' )) );
    add_ux_builder_shortcode('product_sidebar', array('name' => __( 'Product - Sidebar' )) );
    add_ux_builder_shortcode('product_reviews', array('name' => __( 'Product - Reviews' )) );
    add_ux_builder_shortcode('product_upsell', array('name' => __( 'Product - Upsell' )) );
    add_ux_builder_shortcode('product_related', array('name' => __( 'Product - Related' )) );
    add_ux_builder_shortcode('product_info', array('name' => __( 'Product - Info Hooked' )) );
    add_ux_builder_shortcode('product_tabs', array('name' => __( 'Product - Tabs' )) );
    add_ux_builder_shortcode('product_title', array('name' => __( 'Product - Title' )) );
    add_ux_builder_shortcode('product_breadcrumb', array('name' => __( 'Product - Breadcrumbs' ),) );
    add_ux_builder_shortcode('product_price', array('name' => __( 'Product - Price' )) );
    add_ux_builder_shortcode('product_rating', array('name' => __( 'Product - Rating' )) );
    add_ux_builder_shortcode('product_description', array('name' => __( 'Product - Description' )) );
    add_ux_builder_shortcode('product_excerpt', array('name' => __( 'Product - Short Description' )) );
    add_ux_builder_shortcode('product_add_to_cart', array('name' => __( 'Product - Add To Cart' )) );
    add_ux_builder_shortcode('product_share', array('name' => __( 'Product - Share' )) );
    add_ux_builder_shortcode('product_meta', array('name' => __( 'Product - Meta' )) );
}

*/
