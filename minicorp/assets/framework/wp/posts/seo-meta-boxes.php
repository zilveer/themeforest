<?php


/**
 * Edit the Title
 */
if ( ! function_exists( 'ishyoboy_metadata_seo_title' ) ) {
    function ishyoboy_metadata_seo_title( $title, $sep = '' ) {
    global $post;

    if( $post && !ishyoboy_seo_plugin_active() ) {

        if( $seo_title = IshYoMetaBox::get('ishyoboy_seo_title') ){
            if ( '' != $sep){
                return ' ' . $sep . ' ' . $seo_title;
            }
            else{
                return $seo_title;
            }

        }

    }
    return $title;
}
}
add_filter('wp_title', 'ishyoboy_metadata_seo_title', 15, 3);

/**
 * Add the Description
 */
if ( ! function_exists( 'ishyoboy_metadata_seo_description' ) ) {
    function ishyoboy_metadata_seo_description() {
    global $post;

    if( $post && !ishyoboy_seo_plugin_active() ) {

        if( $seo_description = IshYoMetaBox::get('ishyoboy_seo_description') ){
            echo '<meta name="description" content="'. esc_html(strip_tags($seo_description)) .'" />' . "\n";
        }

    }
}
}
add_action('ishyoboy_meta_head', 'ishyoboy_metadata_seo_description');


/**
 * Add the Keywords
 */
if ( ! function_exists( 'ishyoboy_metadata_seo_keywords' ) ) {
    function ishyoboy_metadata_seo_keywords() {

    global $post;

    if( $post && !ishyoboy_seo_plugin_active() ) {

        if( $seo_keywords = IshYoMetaBox::get('ishyoboy_seo_keywords') ){
            echo '<meta name="keywords" content="'. esc_html(strip_tags($seo_keywords)) .'" />' . "\n";
        }

    }
}
}
add_action('ishyoboy_meta_head', 'ishyoboy_metadata_seo_keywords');