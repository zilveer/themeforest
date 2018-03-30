<?php
/**
 * The Header for our theme.
 *
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title><?php wp_title('-', true, 'right'); ?><?php bloginfo('name'); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<!-- #primary-nav-mobile -->
<nav id="primary-nav-mobile">
<a class="menu-toggle" href="#"></a>
<?php wp_nav_menu( array('theme_location' => 'primary-nav', 'container' => false, 'menu_class' => 'clearfix', 'menu_id' => 'mobile-menu', )); ?>
</nav>
<!-- /#primary-nav-mobile -->

<!-- #header -->
<header id="header" class="clearfix" role="banner">

<div class="ht-container">

<div id="header-inner" class="clearfix">
<!-- #logo -->
  <div id="logo">
      <a title="<?php bloginfo( 'name' ); ?>" href="<?php echo home_url(); ?>">
      <img alt="<?php bloginfo( 'name' ); ?>" src="<?php echo get_theme_mod( 'st_site_logo' ); ?>" />
      </a>
  </div>
<!-- /#logo -->


<!-- #primary-nav -->
<nav id="primary-nav" role="navigation" class="clearfix">
  <?php if ( has_nav_menu( 'primary-nav' ) ) { ?>
    <?php wp_nav_menu( array('theme_location' => 'primary-nav', 'container' => false, 'menu_class' => 'nav sf-menu clearfix' )); ?>
     <?php } else { ?>
	 <ul>
     <?php echo wp_list_pages( array( 'title_li' => '' ) ); ?>
    </ul>
  <?php } ?>
</nav>
<!-- #primary-nav -->


</div>
</div>
</header>
<!-- /#header -->

