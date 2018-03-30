<?php
register_nav_menus( array(
        'Topbar_Navigation' => __( 'Top Bar Navigation', 'smooththemes' ),
    ) );
register_nav_menus( array(
        'Primary_Navigation' => __( 'Primary Navigation', 'smooththemes' ),
    ) );

function st_home_page_menu_args( $args ) {
    $args['show_home'] = true;
    return $args;
}
add_filter( 'wp_page_menu_args', 'st_home_page_menu_args' );