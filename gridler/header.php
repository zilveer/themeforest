<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<!-- A Swish Theme (http://swishthemes.com) - Proudly powered by WordPress (http://wordpress.org) -->

<!-- BEGIN head -->
<head>
<!-- Title -->
<title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
<!-- Meta Tags -->
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<!-- RSS & Pingbacks -->
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?> RSS Feed" href="<?php if (of_get_option('feedburner')) { echo of_get_option('feedburner'); } else { bloginfo( 'rss2_url' ); } ?>" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    
<!-- Stylesheets -->
<?php get_template_part('templates/include_CSS'); ?>
<!-- JS -->
<?php get_template_part('templates/include_JS'); ?>
<!-- Head Hook -->
<?php wp_head(); ?>
<!-- END head -->

</head>
<!-- BEGIN body -->
<body id="body" <?php body_class(); ?>>

<!-- BEGIN #header -->
<header id="header"> 
    <!-- BEGIN #logo -->

    <div id="logo"> 
    <?php if (is_front_page()) { ?>
    <h1><a href="<?php echo home_url(); ?>"><img title="<?php echo of_get_option('logo_title'); ?>" alt="<?php echo of_get_option('logo_alt'); ?>" src="<?php echo of_get_option('logo'); ?>"></a></h1>
    <?php } else { ?>
    <a href="<?php echo home_url(); ?>"><img title="<?php echo of_get_option('logo_title'); ?>" alt="<?php echo of_get_option('logo_alt'); ?>" src="<?php echo of_get_option('logo'); ?>"></a>
    <?php } ?>
      <!-- END #logo --> 
    </div>
    
    <!-- BEGIN #tagline -->
    <?php if (of_get_option('tagline_visible') == "0") : ?>
    <div id="tagline"><?php echo of_get_option('tagline' ); ?></div>
    <?php endif; ?>
    <!-- END #tagline --> 
    
    <!-- BEGIN #nav -->
	<nav id="nav">
    <?php wp_nav_menu( array('theme_location' => 'primary-nav', 'container' => false, 'menu_class' => 'nav sf-shadow' )); ?>
    </nav>
    <div class="clear"></div>
  <!-- END #header --> 
</header>