<?php 
add_filter('woocommerce_show_page_title','st_function_false'); // disable the shop title by wc

function st_wc_numb_pro_per_page(){
    return 9;
}


/**
 * Get WC shop page id 
 * @return page id
 */ 
function st_get_shop_page(){
    $post_id  = get_option('woocommerce_shop_page_id'); 
    if(st_is_wpml()){
      $post_id=   icl_object_id($post_id, 'page', true);
    }
    return $post_id;
}



add_filter( 'loop_shop_per_page', 'st_wc_numb_pro_per_page');


if ( ! function_exists( 'woocommerce_template_loop_product_thumbnail' ) ) {

	/**
	 * Get the product thumbnail for the loop.
	 *
	 * @access public
	 * @subpackage	Loop
	 * @return void
	 */
	function woocommerce_template_loop_product_thumbnail() {
		echo woocommerce_get_product_thumbnail('st_medium');
	}
}




if ( ! function_exists( 'woocommerce_content' ) ) {

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
	function woocommerce_content() {
	   
          
         remove_action('woocommerce_before_shop_loop','woocommerce_result_count',20);
         remove_action('woocommerce_before_shop_loop','woocommerce_catalog_ordering',30);
         
         remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
         
         remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

         if(is_product()){
                woocommerce_get_template( 'single-product.php' ) ;//  archive-product.php
         }elseif(is_product_category()){
              woocommerce_get_template( 'taxonomy-product_cat.php' ) ;//  archive-product.php
         }elseif(is_product_tag()){
                 woocommerce_get_template( 'taxonomy-product_tag.php' ) ;//  archive-product.php
         }else{
               woocommerce_get_template( 'archive-product.php' ) ;
         }
	   
		
	}
}

