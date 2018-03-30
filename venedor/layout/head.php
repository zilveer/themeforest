<!DOCTYPE html>
<html xmlns="http<?php echo (is_ssl())? 's' : ''; ?>://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title><?php
    /*
     * Print the <title> tag based on what is being viewed.
     */
    global $page, $paged;

    wp_title( '|', true, 'right' );

    // Add the blog name.
    bloginfo( 'name' );

    // Add the blog description for the home/front page.
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) )
        echo " | $site_description";

    // Add a page number if necessary:
    if ( $paged >= 2 || $page >= 2 )
        echo ' | ' . sprintf( __( 'Page %s', 'venedor' ), max( $paged, $page ) );

    ?></title>

    <?php
    global $venedor_settings, $venedor_design;
    $theme_info = wp_get_theme();
    ?>
        
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <?php // For Favicon ?>
    <?php if($venedor_settings['favicon']): ?>
        <link rel="shortcut icon" href="<?php echo $venedor_settings['favicon']['url']; ?>" type="image/x-icon" />
    <?php endif; ?>

    <?php // For iPhone ?>
    <?php if($venedor_settings['icon-iphone']): ?>
        <link rel="apple-touch-icon-precomposed" href="<?php echo $venedor_settings['icon-iphone']['url']; ?>">
    <?php endif; ?>

    <?php // For iPhone Retina ?>
    <?php if($venedor_settings['icon-iphone-retina']): ?>
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $venedor_settings['icon-iphone-retina']['url']; ?>">
    <?php endif; ?>

    <?php // For iPad ?>
    <?php if($venedor_settings['icon-ipad']): ?>
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $venedor_settings['icon-ipad']['url']; ?>">
    <?php endif; ?>

    <?php // For iPad Retina ?>
    <?php if($venedor_settings['icon-ipad-retina']): ?>
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $venedor_settings['icon-ipad-retina']['url']; ?>">
    <?php endif; ?>

    <?php // Load Google Fonts ?>
    <?php 
    $gfont = array();
    $fonts = array('body', 'btn', 'heading', 'heading-desc', 'header', 'menu', 'submenu', 'footer-heading', 'footer', 'breadcrumbs', 'filter-heading', 'sidebar', 'product-price', 'product-sales');
    foreach ($fonts as $option) {
        if (isset($venedor_design[$option.'-font']['google']) && $venedor_design[$option.'-font']['google'] !== 'false') {
            $font = urlencode($venedor_design[$option.'-font']['font-family']);
            if (!in_array($font, $gfont))
                $gfont[] = $font;
        }
    }

    $font_family = '';
    foreach ($gfont as $font)
        $font_family .= $font . ':300,400,400italic,500,600,700,700italic%7C';
    if ($font_family) : ?>
        <link href="//fonts.googleapis.com/css?family=<?php echo $font_family ?>&amp;subset=latin,greek-ext,cyrillic,latin-ext,greek,cyrillic-ext,vietnamese" rel="stylesheet" />
    <?php endif; ?>

    <?php
    wp_head();
    ?>

    <!--[if lt IE 9]>
        <script type="text/javascript" src="<?php echo sys_theme_js ?>/ie8.js"></script>
        <script type="text/javascript" src="<?php echo sys_theme_js ?>/html5.js"></script>
        <script type="text/javascript" src="<?php echo sys_theme_js ?>/respond.min.js"></script>
    <![endif]-->

    <?php if (isset($venedor_settings['tracking-code'])) : ?>
        <?php echo $venedor_settings['tracking-code']; ?>
    <?php endif; ?>

</head>
