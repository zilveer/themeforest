<?php
/**
 * Single Product Sale Flash
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product, $venedor_settings;

$labels_tl = ''; $labels_tr = ''; $labels_bl = ''; $labels_br = '';
if ($venedor_settings['product-hot']) {
    $featured = get_post_meta($post->ID, '_featured', 'true') == 'yes' ? true : false;
    if ($featured) {
        $hot_html = '<span class="onhot ' . $venedor_settings['product-hot-wrap'] . '">'. __('Hot', 'venedor') .'</span>';
        switch ($venedor_settings['product-hot-pos']) {
            case 'top-right': $labels_tr .= $hot_html; break;
            case 'bottom-left': $labels_bl .= $hot_html; break;
            case 'bottom-right': $labels_br .= $hot_html; break;
            default: $labels_tl .= $hot_html; break;
        }
    }
}
if ($venedor_settings['product-sale']) {
    if ($product->is_on_sale()) {
        $percentage = 0;
        if ($product->regular_price)
            $percentage = - round( ( ( $product->regular_price - $product->sale_price ) / $product->regular_price ) * 100 );
        if ($venedor_settings['product-sale-percent'] && $percentage)
            $sales_html = '<span class="onsale ' . $venedor_settings['product-sale-wrap'] . '">'. $percentage .'%</span>';
        else
            $sales_html = apply_filters('woocommerce_sale_flash', '<span class="onsale ' . $venedor_settings['product-sale-wrap'] . '">'.__( 'Sale', 'venedor' ).'</span>', $post, $product);
        switch ($venedor_settings['product-sale-pos']) {
            case 'top-right': $labels_tr .= $sales_html; break;
            case 'bottom-left': $labels_bl .= $sales_html; break;
            case 'bottom-right': $labels_br .= $sales_html; break;
            default: $labels_tl .= $sales_html; break;
        }
    }
}
if ($labels_tl) echo '<div class="labels top-left">' . $labels_tl . '</div>';
if ($labels_tr) echo '<div class="labels top-right">' . $labels_tr . '</div>';
if ($labels_bl) echo '<div class="labels bottom-left">' . $labels_bl . '</div>';
if ($labels_br) echo '<div class="labels bottom-right">' . $labels_br . '</div>';
?>

