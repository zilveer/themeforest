<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!-- Consider adding an manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?> > <!--<![endif]-->
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <title><?php wp_title(); ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
        <?php if(jwOpt::get_option('custom_favicon', get_template_directory_uri() . '/favicon.png') != ""){ ?>
            <!-- Favicon  -->
            <link rel="shortcut icon" type="image/png" href="<?php echo jwOpt::get_option('custom_favicon', get_template_directory_uri() . '/favicon.png') ?>">
        <?php } ?>
        <!-- Feed -->
        <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> Feed" href="<?php echo home_url(); ?>/feed/">
        <?php
        if (function_exists('wp_get_theme')) {
            echo ' <!-- version of GoodStore: ' . THEMEVERSION . ' -->';
        }
        ?> 
        <!-- Enable Startup Image for iOS Home Screen Web App -->
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta property='fb:app_id' content='<?php echo jwOpt::get_option('fbcomments_appid', ''); ?>'/>

        <?php
        //GOOGLE fonts
        
        if (jwOpt::get_option('use_google_fonts', '1') == '1') {
            $fonts = array("Lato", "Open Sans");
            $g_font = jwOpt::get_option('title_font', 'Lato');
            if (isset($g_font)) {
                $fonts[] = $g_font;
            }
            $g_font = jwOpt::get_option('text_font', array('face' => 'Open Sans'));
            if (isset($g_font['face'])) {
                $fonts[] = $g_font['face'];
            }
            echo jwRender::link_google_fonts($fonts);
        }
        echo jwUtils::get_social_meta();
        echo jwOpt::get_option('custom_js_header');
        wp_head();
        ?>  
    </head>

    <?php
    $rtl = (jwOpt::get_option('site_rtl', '0') == '1') ? 'rtl' : '';

    $top_bar_fix = '';
    if (jwOpt::get_option('top_bar_fix', '0') == '1' && jwOpt::get_option('top_bar', 'on') == 'on') {
        $top_bar_fix = 'topbar-fixed';
    } else {
        $top_bar_fix = 'topbar-none';
    }

    $menu_class_str = '';
    $menu_class = array();
    if (jwOpt::get_option('header_style', 'header-small-444') == 'header-big') {
        $menu_class[] = " body-big-menu";
    }
    if (jwOpt::get_option('menu_bar_fix', 0) > 0) {
        $menu_class[] = " body-fix-menu";
    }
    $menu_class_str = implode($menu_class);

    $wide_class = 'normal-theme';
    if (jwOpt::get_option('wide_mode', '1') == '1') {
        $wide_class = 'wide-theme';
    }
    ?>

    <body <?php body_class($rtl . " " . jwOpt::get_option('cut_category_titles', 'non-shorten-category-names') . " " . jwOpt::get_option('theme_style', 'fullwidth') . " " . $top_bar_fix . " " . $wide_class . " " . $menu_class_str . " " . jwOpt::get_option('hide_sliders', 'hide-sliders')); ?>    >
        <div class="body-content">  
            <div id="container" class="container" role="document">
                <?php
                if (is_front_page() && jwOpt::get_option('woo_modal', '0') == '1') {
                    $data['id'] = 'jaw_Modal';
                    $data['page_id'] = jwOpt::get_option('woo_modal_page_id', '0');
                    jaw_template_set_data($data);
                    echo jaw_get_template_part('modal', 'header');
                }
                ?>           
                <?php if (jwOpt::get_option('top_bar', 'on') == 'on') { ?>
                    <div class="row-fullwidth">
                        <div class="page-top fullwidth-block row">
                            <?php
                            echo jaw_get_template_part('top-bar-1', 'header');
                            ?>
                        </div>
                    </div> 
                <?php } ?>
                <!-- Start the template box -->
                <div id="template-box">
                    <!-- Row for blog navigation -->
                    <!-- <noscript>Please turn on JavaScript</noscript> -->
                    <?php
                    if (jwOpt::get_option('skyscrapper_left_show', '0') == '1') {
                        echo jaw_get_template_part('skyscrapper_left', 'header');
                    }
                    ?>

                    <?php
                    if (jwOpt::get_option('skyscrapper_right_show', '0') == '1') {
                        echo jaw_get_template_part('skyscrapper_right', 'header');
                    }
                    ?>

                    <?php
                    if (jwOpt::get_option('totop_show', '0') == '1') {
                        echo jaw_get_template_part('to_top', 'header');
                    }
                    ?>

                    <div id="header">
                        <div class="row-fullwidth">
                            <?php
                            echo jaw_get_template_part(jwOpt::get_option('header_style', 'header-small-center'), 'header');
                            ?>
                        </div>
                        <?php
                        echo jaw_get_template_part('page-title', 'header');
                        ?>                        
                    </div>
                    <!-- Row for main content area -->
                    <div id="main" class="row">                                                
                        <?php
                        if (jwOpt::get_option('blog_featured_show', 'off') != 'off') {
                            if (jwOpt::get_option('blog_featured_show', 'off') == 'homepage' && is_front_page()) {
                                echo jaw_get_template_part('featured-area', 'featured-area');
                            } else if (jwOpt::get_option('blog_featured_show', 'off') == 'allweb') {
                                echo jaw_get_template_part('featured-area', 'featured-area');
                            }
                            ?>
                            <div class="clear"></div>
                            <?php
                        }
                        