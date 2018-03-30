<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

?><!DOCTYPE html>
<!--[if lt IE 8]> <html class="no-js lt-ie10 lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie10 lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9]>    <html class="no-js lt-ie10" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>

<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php a13_favicon(); ?>

<?php
    global $apollo13;
    a13_theme_head();
    wp_head();
?>

</head>

<body id="top" <?php body_class(); ?>>

<?php
    a13_page_preloader();

    $fixed_header   = $apollo13->get_option( 'appearance', 'fixed_header' ) === 'on';
    $header_search  = $apollo13->get_option( 'appearance', 'header_search' ) === 'on';
    $header_cart    = a13_is_woocommerce_activated();
    $top_bar        = $apollo13->get_option( 'appearance', 'header_top_bar' ) === 'on';
    $socials        = $apollo13->get_option( 'appearance', 'header_socials' ) === 'on';
    $variant        = $apollo13->get_option( 'appearance', 'header_style' );

    $header_classes  = $fixed_header ? 'sticky ': '';
    $header_classes .= ' header-'.$variant;
    $header_classes .= ' bg-'.$apollo13->get_option( 'appearance', 'header_bg_fit' );
    $header_classes .= ($header_search?' with-search' : '');
    $header_classes .= ($header_cart?' with-cart' : '');
?>
    <header id="header" class="<?php echo $header_classes; ?>">
        <?php if($top_bar){ a13_header_top_bar(); } ?>
        <div class="head clearfix">
        <?php if($variant === 'one-line'):
        ?>
            <div class="logo-container"><?php a13_header_logo(); ?></div>
            <nav id="access" role="navigation" class="navigation-bar">
                <div class="menu-opener"></div>
                <?php a13_header_menu(); ?>
            </nav><!-- #access -->
            <?php if( $header_search ){ a13_header_search(); } ?>

            <?php a13_header_wc_cart(); ?>

        <?php else: ?>
            <div class="top-head">
                <div class="logo-container"><?php a13_header_logo(); ?></div>
                <?php if( $header_search ){ a13_header_search(); } ?>

                <?php a13_header_wc_cart(); ?>
                <div class="menu-opener"></div>
            </div>

            <div class="bottom-head">
                <nav id="access" role="navigation" class="navigation-bar">
                    <?php a13_header_menu(); ?>
                    <?php if ($socials) { echo a13_social_icons($apollo13->get_option( 'appearance', 'header_socials_color' )); } ?>
                </nav><!-- #access -->
            </div>

        <?php endif; ?>
        </div>
    </header>

    <div id="mid" class="clearfix<?php echo a13_get_mid_classes(); ?>">

        <?php
            if( 0 && WP_DEBUG ){ $apollo13->page_type_debug(); }
