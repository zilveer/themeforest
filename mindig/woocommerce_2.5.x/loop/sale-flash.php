<?php
/**
 * Product loop sale flash
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
 
global $post, $product;

if ( ! $product->is_in_stock() ) return;

$is_active                  = get_post_meta( $product->id, '_active_custom_onsale', true );
$preset                     = get_post_meta( $product->id, '_preset_onsale_icon', true );
$custom                     = get_post_meta( $product->id, '_custom_onsale_icon', true );
$regular_price              = get_post_meta( $product->id, '_regular_price', true );
$regular_price_var          = get_post_meta( $product->id, '_min_variation_price', true );
$stylesheet_directory_uri   = get_stylesheet_directory_uri();
$template_directory_uri     = get_template_directory_uri();
$stylesheet_directory       = get_stylesheet_directory();
$wc_images_directory        = '/woocommerce/images/';
$on_sale                    = $wc_images_directory . 'sale.png';
$minus_fifty                = $wc_images_directory . '50.png';
$minus_twentyfive           = $wc_images_directory . '25.png';
$minus_ten                  = $wc_images_directory . '10.png';

$image = '';

// set a preset image 
if ( $is_active == 'yes' && $preset != 'custom' ) {

    switch ( $preset ) {
        case 'onsale' :
            if( is_child_theme() ){
                $img = file_exists( $stylesheet_directory . $on_sale ) ? $stylesheet_directory_uri . $on_sale : $template_directory_uri . $on_sale;
            }else{
                $img = $stylesheet_directory_uri . $on_sale;
            }
            break;
        case '-50%' :
            if( is_child_theme() ){
                $img = file_exists( $stylesheet_directory . $minus_fifty ) ? $stylesheet_directory_uri . $minus_fifty : $template_directory_uri . $minus_fifty;
            }else{
                $img = $stylesheet_directory_uri . $minus_fifty;
            }
            break;
        case '-25%' :
            if( is_child_theme() ){
                $img = file_exists( $stylesheet_directory . $minus_twentyfive   ) ? $stylesheet_directory_uri . $minus_twentyfive : $template_directory_uri . $minus_twentyfive  ;
            }else{
                $img = $stylesheet_directory_uri . $minus_twentyfive;
            }
            break;
        case '-10%' :
            if( is_child_theme() ){
                $img = file_exists( $stylesheet_directory . $minus_ten ) ? $stylesheet_directory_uri . $minus_ten : $template_directory_uri . $minus_ten;
            }else{
                $img = $stylesheet_directory_uri . $minus_ten;
            }
            break;
    }
    $image = yit_image( "echo=no&src=$img&getimagesize=1&class=onsale");
}
elseif ( $preset == 'custom' && ! empty( $custom ) ){
    $image = yit_image( "echo=no&src=$custom&getimagesize=1&class=onsale");
}
elseif ( $product->is_on_sale() && ( ! empty( $regular_price ) || ! empty( $regular_price_var ) ) ) {

    if( is_child_theme() ){
        $img = file_exists( $stylesheet_directory . $on_sale ) ? $stylesheet_directory_uri . $on_sale : $template_directory_uri . $on_sale;
    }else{
        $img = $stylesheet_directory_uri . $on_sale;
    }
    $image = yit_image( "echo=no&src=$img&getimagesize=1&class=onsale&alt=" . __( 'On sale!', 'yit' ) );
}

if ( $image == '' ) return;

echo '<span class="onsale-icon">' . $image . '</span>';
