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

}
?>
