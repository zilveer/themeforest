<?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */
?>
<?php
    global $qode_options;
    $classes = '';
    if (isset($qode_options['woo_products_list_type']) && $qode_options['woo_products_list_type'] != "") {
        $classes .= $qode_options['woo_products_list_type'];

        if($qode_options['woo_products_list_type'] == 'standard') {
            do_action('qode_shop_standard_initial_setup');
        }

        if($qode_options['woo_products_list_type'] == 'simple') {
            do_action('qode_shop_simple_initial_setup');
        }
    }
?>
<ul class="products clearfix  <?php echo esc_attr($classes); ?>">