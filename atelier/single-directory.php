<?php get_header(); ?>

<?php
    global $sf_options;
    $default_sidebar_config = $sf_options['default_sidebar_config'];
    $default_left_sidebar   = $sf_options['default_left_sidebar'];
    $default_right_sidebar  = $sf_options['default_right_sidebar'];

    $sidebar_config = sf_get_post_meta( $post->ID, 'sf_sidebar_config', true );
    $left_sidebar   = sf_get_post_meta( $post->ID, 'sf_left_sidebar', true );
    $right_sidebar  = sf_get_post_meta( $post->ID, 'sf_right_sidebar', true );

    if ( $sidebar_config == "" ) {
        $sidebar_config = $default_sidebar_config;
    }
    if ( $left_sidebar == "" ) {
        $left_sidebar = $default_left_sidebar;
    }
    if ( $right_sidebar == "" ) {
        $right_sidebar = $default_right_sidebar;
    }

    sf_set_sidebar_global( $sidebar_config );
?>

<?php sf_base_layout( 'single-directory' ); ?>

<?php get_footer(); ?>