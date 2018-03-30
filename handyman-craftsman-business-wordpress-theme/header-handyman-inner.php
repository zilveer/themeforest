<?php
use \Handyman\Front as F;
global $tl_is_popup;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <?php wp_head(); ?>
</head>
<body id="top" <?php body_class(); ?>>
    <?php if(!$tl_is_popup): ?>
        <?php get_template_part('partials/html-preloader'); ?>
        <?php get_sidebar( 'off-canvas'); ?>
    <?php endif; ?>
    <?php do_action( 'layers_before_site_wrapper' ); ?>
    <div <?php layer_site_wrapper_class(); ?>>

        <?php if(!$tl_is_popup): ?>
            <?php do_action( 'layers_before_header' ); ?>

            <!-- Adds left / right navigation menu if any -->
            <?php get_template_part( 'partials/header' , 'secondary' ); ?>

            <section <?php layers_header_class(); ?> >
                <?php do_action( 'layers_before_header_inner' ); ?>
                <div class="<?php if( 'layout-fullwidth' != layers_get_theme_mod( 'header-width' ) ) echo 'container'; ?> header-block">
                    <?php if( 'header-logo-center' == layers_get_theme_mod( 'header-menu-layout' ) ) {
                        get_template_part( 'partials/header' , 'handy-centered' );
                    } else {
                        get_template_part( 'partials/header' , 'handy-standard' );
                    } // if centered header ?>
                </div><!-- .header-block -->
                <?php do_action( 'layers_after_header_inner' ); ?>
            </section>
            <?php do_action( 'layers_after_header' ); ?>
        <?php endif; ?>
        <section id="wrapper-content" <?php layers_wrapper_class( 'wrapper_content', 'wrapper-content' ); ?>>