<?php
/**
 * Product loop sale flash
 *
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

global $post, $product, $porto_settings;

$labels = '';
if ($porto_settings['product-hot']) {
    $featured = get_post_meta($post->ID, '_featured', 'true') == 'yes' ? true : false;
    if ($featured) {
        $hot_html = '<div class="onhot">'. ((isset($porto_settings['product-hot-label']) && $porto_settings['product-hot-label']) ? $porto_settings['product-hot-label'] : __('Hot', 'porto')) .'</div>';
        $labels .= $hot_html;
    }
}
if ($porto_settings['product-sale']) {
    if ($product->is_on_sale()) {
        $percentage = 0;
        if ($product->regular_price)
            $percentage = - round( ( ( $product->regular_price - $product->sale_price ) / $product->regular_price ) * 100 );
        if ($porto_settings['product-sale-percent'] && $percentage)
            $sales_html = '<div class="onsale">'. $percentage .'%</div>';
        else
            $sales_html = apply_filters('woocommerce_sale_flash', '<div class="onsale">'. ((isset($porto_settings['product-sale-label']) && $porto_settings['product-sale-label']) ? $porto_settings['product-sale-label'] : __('Sale', 'porto')) .'</div>', $post, $product);
        $labels .= $sales_html;
    }
}
echo '<div class="labels">';

echo  $labels;

$availability = $product->get_availability();
if ( $availability['availability'] == __( 'Out of stock', 'woocommerce' )) {
    if ($porto_settings['product-stock']) {
        echo apply_filters( 'woocommerce_stock_html', '<div class="stock ' . esc_attr( $availability['class'] ) . '">' . esc_html( $availability['availability'] ) . '</div>', $availability['availability'] );
    }
} else {
    echo '<div data-link="' . get_permalink( wc_get_page_id( 'cart' ) ) . '" class="viewcart ' . str_replace('minicart-icon', 'viewcart', $porto_settings['minicart-icon']) .' viewcart-'.$product->id.'" title="' . __('View Cart', 'woocommerce') . '"></div>';
}

echo '</div>';
