<?php
/**
 * All hooks for the theme.
 *
 * @package WordPress
 * @subpackage YIW Themes
 * @since 1.0
 */

if ( is_shop_installed() ) {
    if( function_exists( 'yiw_woocommerce_object' ) ) {
        add_action('wp_enqueue_scripts', 'yiw_woocommerce_object', 110);
    }
}

remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
add_filter( 'yiw_sc_button_html', create_function( '$html', 'return str_replace( "button\"", "sc-button\"", $html );' ) );
add_filter( 'yiw_tabs_panel', create_function( '$tabs', 'return array();' ) ); // remove panel import

//
add_filter( 'yiw_slide_title', 'yiw_slide_convert_title' );
function yiw_slide_convert_title( $args = false ) {
    if( is_array($args) ) {
        $color = $args[1] != '' ? 'style="color:' . $args[1]. '"' : '';
        return str_replace('[', "<span {$color}>", str_replace(']', '</span>', str_replace('|', '<br />', $args[0])));
    } elseif( is_string($args) ) {
        return str_replace('[', '<span>', str_replace(']', '</span>', str_replace('|', '<br />', $args)));
    }
}

if( yiw_get_option( 'shop_show_star_rating_single_product' ) ) {
    add_action( 'woocommerce_single_product_summary','yiw_star_rating',35 );
}

if( yiw_get_option( 'shop_show_star_rating_loop' ) ) {
    add_action( 'woocommerce_after_shop_loop_item','yiw_star_rating', 5 );
}

if( _is_yiw_panel() ) {
    remove_action('admin_enqueue_scripts', 'advanced_nav_admin_scripts');
}


add_filter( 'the_content','yit_strip_content' );

function yit_strip_content( $content ){
    global $post;
    if ( $post->post_type == 'post' && !is_single() ){
        $content = strip_tags( $content, '<p><a>' );
    }
    return $content;
}

if( function_exists('layerslider_plugins_purchase_notice') ) {
    remove_action('after_plugin_row_'.LS_PLUGIN_BASE, 'layerslider_plugins_purchase_notice', 10, 3 );
}

if( function_exists('layerslider_premium_support') ) {
    remove_action('admin_notices', 'layerslider_premium_support');
}


add_filter( 'document_title_separator' , create_function( '', 'return "|";' ) );

?>