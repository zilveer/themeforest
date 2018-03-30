<?php
add_theme_support( 'woocommerce' );

/** Template pages ********************************************************/

if (!function_exists('cs_woocommerce_content')) {

    function cs_woocommerce_content() {

        if (is_singular('product')) {
            wc_get_template_part('single', 'product');
        } else {
            wc_get_template_part('archive', 'product');
        }
    }

if ( !function_exists( 'woocommerce_template_loop_product_thumbnail' ) ) {

	/**
	 * Get the product thumbnail for the loop.
	 *
	 * @access public
	 * @subpackage	Loop
	 * @return void
	 */
	function woocommerce_template_loop_product_thumbnail() {
		echo woocommerce_get_product_thumbnail('shop_single');
	}
}
}
if(!function_exists('cshero_social_share')){
	function cshero_social_share(){
		global $post;
		$attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full', false);
    	$img = esc_attr($attachment_image[0]);
    	$title = get_the_title();
    	echo '<div class="cshero-product-share"><span>'.__('SHARE ON: ',THEMENAME).'</span> '.cshero_socials_share(get_the_permalink(),$img, $title).'</div>';
	}
}
?>
