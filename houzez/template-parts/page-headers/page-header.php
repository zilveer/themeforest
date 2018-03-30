<?php
global $post, $fave_header_full_screen, $adv_search_which_header_show, $adv_search_over_header_pages, $adv_search_selected_pages;

if( !is_404() && !is_search() ) {
    $header_type = get_post_meta($post->ID, 'fave_header_type', true);
    $fave_header_full_screen = get_post_meta($post->ID, 'fave_header_full_screen', true);
}
$adv_search_which_header_show = houzez_option('adv_search_which_header_show');
$adv_search_over_header_pages = houzez_option('adv_search_over_header_pages');
$adv_search_selected_pages = houzez_option('adv_search_selected_pages');

if( isset($_GET['fullscreen']) && $_GET['fullscreen'] == 'yes') {
    $fave_header_full_screen = 'yes';
}

if( $fave_header_full_screen == 'yes' ) {
    $fave_header_full_screen = 'fave-screen-fix';
} else {
    $fave_header_full_screen = '';
}

if( !empty( $header_type ) && $header_type != 'none' ) {

    if( $header_type == 'property_slider' ) {
        get_template_part( 'template-parts/page-headers/property', 'slider' );

    } elseif( $header_type == 'rev_slider' ) {
        get_template_part( 'template-parts/page-headers/revolution', 'slider' );

    } elseif( $header_type == 'property_map' ) {
        get_template_part( 'template-parts/page-headers/header', 'map' );

    } elseif( $header_type == 'static_image' ) {
        get_template_part( 'template-parts/page-headers/static', 'image' );

    } elseif( $header_type == 'video' ) {
        get_template_part( 'template-parts/page-headers/video' );
    }

}
?>