<!DOCTYPE html>
<!--[if IE 7 ]><html class="ie ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="ie ie9" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>">
    <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>"/>

    <!-- Mobile Specific Metas
   ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">

    <!-- Favicon && Apple touch -->
    <link rel="shortcut icon" href="<?php echo get_theme_option('favicon'); ?>" type="image/x-icon">
    <link rel="apple-touch-icon" href="<?php echo get_theme_option('apple_touch_57'); ?>">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_theme_option('apple_touch_72'); ?>">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_theme_option('apple_touch_114'); ?>">

    <title><?php wp_title(); ?></title>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <?php if (is_now_custom_font_selected(get_theme_option("additional_font")) == false) {
    ?><link href='http://fonts.googleapis.com/css?family=<?php echo get_theme_option("additional_font"); ?>:400,700,400italic,300,600,800' rel='stylesheet' type='text/css'>
    <?php
    }
    if (is_now_custom_font_selected(get_theme_option("text_headers_font")) == false) {
    ?><link href='http://fonts.googleapis.com/css?family=<?php echo get_theme_option("text_headers_font"); ?>:400,700,400italic,300,600,800' rel='stylesheet' type='text/css'>
    <?php
    }
    if (is_now_custom_font_selected(get_theme_option("main_content_font")) == false) {
    ?><link href='http://fonts.googleapis.com/css?family=<?php echo get_theme_option("main_content_font"); ?>:400,700,400italic,300,600,800' rel='stylesheet' type='text/css'>
    <?php
    }

    the_theme_option("google_analytics"); ?>

    <script>
        mixajaxurl = "<?php echo esc_url(get_option("siteurl")) ?>/wp-admin/admin-ajax.php";
        themerooturl = "<?php echo THEMEROOTURL; ?>";
    </script>
	<!--[if IE 8 ]><script>
		var e = ("article,aside,figcaption,figure,footer,header,hgroup,nav,section,time").split(',');
		for (var i = 0; i < e.length; i++) {
			document.createElement(e[i]);
		}		
	</script><![endif]-->

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<header>
    <div class="header_wrapper container">
        <a href="<?php echo get_site_url(); ?>" class="logo">
            <img src="<?php the_theme_option("logo"); ?>" alt="" width="<?php the_theme_option("header_logo_standart_width"); ?>" height="<?php the_theme_option("header_logo_standart_height"); ?>" class="logo_def">
            <img src="<?php the_theme_option("logo_retina"); ?>" alt="" width="<?php the_theme_option("header_logo_standart_width"); ?>" height="<?php the_theme_option("header_logo_standart_height"); ?>" class="logo_retina">
        </a>
        <div class="slogan">
            <span>
                <?php
                if (get_theme_option("translator_status") == "enable") {
                    the_text("translator_top_slogan");
                } else {
                    _e('Lorem ipsum dolor sit amet egestas ','theme_localization');
                }

                if (get_theme_option("translator_status") == "enable") {
                    the_text("call_us");
                } else {
                    _e('call us toll free ','theme_localization');
                }
                ?>
                <?php the_theme_option("phone"); ?>
            </span>
            <hr>
        </div>
		<div class="clear"></div>
        <nav>
            <?php wp_nav_menu(array('theme_location' => 'main_menu', 'menu_class' => 'menu', 'depth' => '3')); ?>
        </nav>
        <nav class="mobile_header">
            <select id="mobile_select"></select>
        </nav>
    </div>
    <div class="clear"></div>
</header>