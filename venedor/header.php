<?php get_template_part('layout/head'); ?>
<?php

global $venedor_settings, $venedor_design;
$body_class = '';

?>
<body <?php body_class(array($body_class)); ?>>
    <?php
    // Get Meta Values
    wp_reset_postdata();
    global $venedor_layout, $venedor_sidebar;

    $venedor_layout = venedor_meta_layout();
    $venedor_sidebar = venedor_meta_sidebar();
    $breadcrumbs = venedor_meta_hide_breadcrumbs();
    $content_top = venedor_meta_content_top();
    $header_on_banner = venedor_meta_header_on_banner();

    $f_breadcrumbs = false;
    ?>

    <?php echo venedor_bg_slider() ?>

    <div id="wrapper" class="<?php if ($venedor_settings['wrapper-layout']) echo 'wrapper-full'; else echo 'wrapper-boxed'; ?>"><!-- wrapper -->
        <div class="header-wrapper clearfix
            <?php if (!$venedor_design['header-shadow']) echo ' shadow-none' ?>
            <?php if ($venedor_design['menu-main-arrow']) echo ' menu-arrow' ?>
            <?php if ($header_on_banner) echo ' header-on-banner' ?>"><!-- header wrapper -->
            <?php get_template_part('layout/header'); ?>
        </div><!-- end header wrapper -->
        
        <?php if ($venedor_settings['enable-sticky-header']) : ?>
        <div class="sticky-header<?php if ($venedor_design['menu-main-arrow']) echo ' menu-arrow' ?>"><!-- sticky header -->
            <?php get_template_part('layout/sticky-header'); ?>
        </div><!-- end sticky header -->
        <?php endif; ?>
        
        <?php if (!is_front_page() && $venedor_settings['show-breadcrumbs'] && $venedor_settings['breadcrumbs-before-banner'] && $breadcrumbs) : ?>
        <div class="breadcrumbs"><!-- breadcrumbs -->
            <div class="container">
                <?php venedor_breadcrumbs(); ?>
            </div>
        </div><!-- end breadcrumbs -->
        <?php $f_breadcrumbs = true; endif; ?>
        
        <!-- banner -->
        <?php
        $banner_class = '';
        if (!(is_home() || (!is_home() && is_front_page())) && $breadcrumbs && !$f_breadcrumbs)
            $banner_class = ' m-b-none';
        ?>
        <?php venedor_banner($banner_class); ?>
        <!-- end banner -->

        <?php if (!is_front_page() && $venedor_settings['show-breadcrumbs'] && !$venedor_settings['breadcrumbs-before-banner'] && $breadcrumbs) : ?>
        <div class="breadcrumbs"><!-- breadcrumbs -->
            <div class="container">
                <?php venedor_breadcrumbs(); ?>
            </div>
        </div><!-- end breadcrumbs -->
        <?php endif; ?>

        <div id="main" class="<?php if (($venedor_layout == 'left-sidebar' || $venedor_layout == 'right-sidebar') && $venedor_sidebar && is_active_sidebar( $venedor_sidebar )) echo 'column2' . ' column2-' . $venedor_layout; else echo 'column1'; ?><?php if ($venedor_layout == 'widewidth') echo ' wide' ?><?php if (!$breadcrumbs) echo ' no-breadcrumbs' ?>"><!-- main -->

            <?php if ($content_top) : ?>
                <div id="content-top"><!-- begin content top -->
                    <div class="container">
                        <?php echo do_shortcode('[block name="'.$content_top.'"]') ?>
                    </div>
                </div><!-- end content top -->
            <?php endif; ?>

            <?php if ($venedor_layout != 'widewidth') : ?>
            <div class="container">
                <div class="row">
            <?php endif; ?>
                    <?php if ($venedor_layout != 'widewidth') : ?>
                    <div class="main-content <?php if (($venedor_layout == 'left-sidebar' || $venedor_layout == 'right-sidebar') && $venedor_sidebar && is_active_sidebar( $venedor_sidebar )) echo 'col-sm-8 col-md-9'; else echo 'col-sm-12 col-md-12'; ?>">
                    <?php endif; ?>
                        <!-- main content -->
                            <?php if (function_exists('wc_print_notices')) : ?>
                                <?php if ($venedor_layout == 'widewidth') : ?><div class="container"><?php endif; ?>
                                    <?php wc_print_notices(); ?>
                                <?php if ($venedor_layout == 'widewidth') : ?></div><?php endif; ?>
                            <?php endif; ?>
                            <?php wp_reset_postdata(); ?>