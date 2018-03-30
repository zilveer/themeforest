<?php 
// fix bug confic with revolution slider
if(function_exists('layerslider_enqueue_content_res')){
    remove_action('wp_enqueue_scripts','layerslider_enqueue_content_res');
    add_action('wp_enqueue_scripts', 'layerslider_enqueue_content_res',36);
}


do_action('st_theme_start');
get_header(); 
/**
* WARNING : be careful when you change this file.
* load layout file.
*/

$post_id  = st_get_shop_page();
$st_page_builder = get_page_builder_options($post_id);

$wc_layout =   null ;
if(is_product_category() || is_product_tag()){
     $wc_layout = isset($st_page_builder['shop_tax_layout']) ?  $st_page_builder['shop_tax_layout'] : null;
}elseif(is_product()){
    $wc_layout = isset($st_page_builder['shop_single_layout']) ?  $st_page_builder['shop_single_layout'] : null;
}else{
    $wc_layout = isset($st_page_builder['layout']) ?  $st_page_builder['layout'] : null ;
}
  


global $woocommerce_loop;
$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 3 ); // only show 3 column



do_action('st_before_layout');
get_template_part('woocommerce/layout/'.st_get_layout($wc_layout));
do_action('st_after_layout');
get_footer();
do_action('st_theme_end');