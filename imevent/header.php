<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 7 ]><html class="ie ie7" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 8 ]><html class="ie ie8" <?php language_attributes(); ?>><![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<?php 
	global $theme_option; 
	global $wp_query;

    /* SEO */
	$seo_title = get_post_meta($wp_query->get_queried_object_id(), "_cmb_seo_title", true);
    $seo_description = get_post_meta($wp_query->get_queried_object_id(), "_cmb_seo_description", true);
    $seo_keywords = get_post_meta($wp_query->get_queried_object_id(), "_cmb_seo_keywords", true);

    /* Audio */
    $audio_background   = get_post_meta($wp_query->get_queried_object_id(), "_cmb_audio_background", true);
    $audio_path         = get_post_meta($wp_query->get_queried_object_id(), "_cmb_audio_path", true);
    

    /* Theme Options */
    $page_version = $theme_option['page_version']?$theme_option['page_version']:'body-light';

    if( get_post_meta($wp_query->get_queried_object_id(), "_cmb_bg_version", true) != 'global' || get_post_meta($wp_query->get_queried_object_id(), "_cmb_bg_version", true) != '' ){
        $page_version = get_post_meta($wp_query->get_queried_object_id(), "_cmb_bg_version", true);
    }


    $page_layout = $theme_option['page_layout']?$theme_option['page_layout']:'wide';
    if($page_layout == 'boxed'){$page_layout = 'boxednew';}
    if(is_rtl()){
        $page_text_direction = 'rtl';
    }else{
        $page_text_direction = 'ltr';
    }

    $template_blog = '';
    $single_class = '';
    $subpage = '';

    if(!is_page_template('home_template.php')){
        $subpage = 'sub-page';
    }

    $class_extra = $page_version.' '.$page_layout.' '. $page_text_direction.' '.$subpage.' '.$template_blog. ' '.$single_class;

    
?>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- For SEO -->
    <?php if($seo_description!="") { ?>
        <meta name="description" content="<?php echo esc_attr($seo_description); ?>">
    <?php }elseif(isset($theme_option['seo_des'])){ ?>
        <meta name="description" content="<?php echo esc_attr($theme_option['seo_des']); ?>">
    <?php } ?>
    <?php if($seo_keywords!="") { ?>
        <meta name="keywords" content="<?php echo esc_attr($seo_keywords); ?>">
    <?php }elseif(isset($theme_option['seo_keywords'])){ ?>
        <meta name="keywords" content="<?php echo esc_attr($theme_option['seo_keywords']); ?>">
    <?php } ?>
    <!-- End SEO-->

    <link rel="shortcut icon" href="<?php if(isset($theme_option['favicon']['url'])) echo esc_url($theme_option['favicon']['url']); ?>">
    <link rel="apple-touch-icon" href="<?php if(isset($theme_option['app_icon']['url'])) echo esc_url($theme_option['app_icon']['url']); ?>">

  
     

     <?php if($theme_option['page_layout'] == 'boxed'){ ?>
        <style>
            body.boxednew{
                background: url(<?php echo esc_url($theme_option['page_boxed_pattern']['url']); ?>) #6d7a83;
            }
        </style>
    <?php } ?>

    <?php wp_head(); ?>

</head>

<body <?php body_class($class_extra); ?>>

<!-- Google Analytics -->
<?php if (isset($theme_option['google_analytics'])){
    if($theme_option['google_analytics'] != "") { ?>
        <script>
            <?php echo wp_kses($theme_option['google_analytics'],true); ?>
        </script>
    <?php }
}
?>
<!-- /Google Analytics -->

<!-- Preloader -->
<?php if($theme_option['display_reload'] != 0){ ?>

    <?php if($theme_option['display_reload'] == 1){ ?>
        <div id="preloader">
            <div id="status"><div class="spinner"></div></div>
        </div>
    <?php } else if($theme_option['display_reload'] == 2){ ?>
        <div id="preloader">
            <div id="status">
                <img src="<?php echo esc_url($theme_option['reload_image']['url']); ?>" alt="spin">
            </div>
        </div>
    <?php } ?>
<?php } ?>
<!-- /Preloader -->

<!-- Wrap all content -->
<div class="wrapper container_boxed">


     <!-- Header -->
    <header class="header fixed">
        <div class="container">
            <div class="header-wrapper clearfix">

                <!-- Logo -->
                <div class="logo">
                    <a href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>" class="scroll-to">
                        <?php if($theme_option['logo_option'] == 'text'){ ?>
                            <span class="fa-stack">
                                <i class="fa logo-hex fa-stack-2x"></i>
                                <i class="fa logo-fa <?php echo esc_attr($theme_option['logo_icon_text']); ?> fa-stack-1x"></i>
                            </span>
                            <?php echo esc_attr($theme_option['logo_text']); ?>
                        <?php }else{ ?>
                            <img src="<?php echo esc_url($theme_option['logo_image']['url']); ?>" alt="<?php echo esc_attr(bloginfo('name')); ?>"/>
                        <?php } ?>
                    </a>
                </div>
                <!-- /Logo -->

                <!-- Navigation -->
                <div id="mobile-menu"></div>
                <nav class="navigation closed clearfix">
                    <a href="#" class="menu-toggle btn"><i class="fa fa-bars"></i></a>
                    <?php 
                        $menu_display = get_post_meta($wp_query->get_queried_object_id(), "_cmb_menu_display", true)?get_post_meta($wp_query->get_queried_object_id(), "_cmb_menu_display", true):'';

                        $menu_style = 'primary';

                        if(is_page_template('home_template.php') || !has_nav_menu('primary')){
                            $menu_style = 'one_page';
                        }

                        if($menu_display == 'primary'){
                            $menu_style = 'primary';
                        }else if($menu_display == 'one_page'){
                            $menu_style = 'one_page';
                        }
                        
                    ?>
                    <?php wp_nav_menu(
                        array(
                                'theme_location'  => $menu_style,
                                'menu'            => '',
                                'container'       => 'container',
                                'container_class' => 'container_class',
                                'container_id'    => '',
                                'menu_class'      => 'sf-menu nav',
                                'menu_id'         => '',
                                'echo'            => true,
                                'fallback_cb'     => 'wp_page_menu',
                                'before'          => '',
                                'after'           => '',
                                'link_before'     => '',
                                'link_after'      => '',
                                'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                'depth'           => 0,
                                'walker'          => ''
                            )
                    ); ?>
                    <?php if($audio_background == 'auto_play'){ ?>
                        <ul class="music_play"><li><a href="#" class="control play"><i class="fa fa-play"></i></a></li></ul>
                    <?php } else if($audio_background == 'manual_play'){ ?>
                        <ul class="music_play"><li><a href="#" class="control"><i class="fa fa-pause"></i></a></li></ul>
                    <?php } ?>
                </nav>
                <!-- /Navigation -->

            </div>
        </div>
    </header>
    <!-- /Header -->

    <!-- Content area-->
    <div class="content-area">

        <?php if($audio_background != 'none'){ ?>
            <audio id="player" preload="auto" data-play="<?php echo esc_attr($audio_background); ?>">
                <source src="<?php echo esc_url($audio_path); ?> "/>
            </audio>
        <?php } ?>