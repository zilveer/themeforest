<?php
global $post, $product;

if( !$product->is_in_stock() ) {
     echo apply_filters('woocommerce_out_of_stock_flash', '<span class="onsale outofstock">'.__('Out of stock', 'yiw' ).'</span>', $post, $product);
}