<!DOCTYPE html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><html lang="en" class="no-js" <?php language_attributes(); ?>> <![endif]-->
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="generator" content="HTML Template">
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">


    <?php if (defined('FW')) fw_theme_get_the_favicon(); ?>
    <?php if(defined('FW'))  $boxed = fw_theme_bg_style();?>
    <?php wp_head();?>
</head>
<body
    <?php
        if(!defined('FW'))
            body_class();
        else {
            body_class($boxed['class']);
            //echo custom style
            echo ($boxed['style']);
        }
    ?>
>
        <!-- GO TOP -->
        <div class="w-hidden-small w-hidden-tiny w-clearfix go-top" data-ix="move-top-btn">
            <a class="w-inline-block button btn-top" href="#top">
                <i class="fa fa-arrow-up"></i>
            </a>
        </div>
        <!-- END GO TOP -->
        <header>
            <?php
                if(defined('FW')):
                    get_template_part('templates/top', 'bar' );
                    $menu_bar = fw_get_db_settings_option('menubar');
                else:
                    $menu_bar = array('enable-menubar' => '');
                endif;
            ?>

            <!--get header type-->
            <?php if($menu_bar['enable-menubar'] == 'socials'):?>
                <?php get_template_part('templates/header', 'full' ); ?>
            <?php else:?>
                <?php get_template_part('templates/header', 'normal' ); ?>
            <?php endif;?>

        </header>