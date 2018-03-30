<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Listable
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> data-mapbox-token="<?php echo listable_get_option('mapbox_token', ''); ?>" data-mapbox-style="<?php echo listable_get_option('mapbox_style', ''); ?>">
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'listable' ); ?></a>

	<header id="masthead" class="site-header  <?php if( is_page_template( 'page-templates/front_page.php' ) && (listable_get_option( 'header_transparent', true ) == true) ) echo 'header--transparent'; ?>" role="banner">
		<?php listable_display_logo(); ?>

		<?php get_template_part( 'template-parts/header-fields' ); ?>


		<?php
		// Output the navigation and mobile nav button only if there is a nav
		if ( has_nav_menu( 'primary' ) || has_nav_menu( 'secondary') ): ?>
		<button class="menu-trigger  menu--open  js-menu-trigger">
		<?php get_template_part( 'assets/svg/menu-bars-svg' ); ?>
		</button>
		<nav id="site-navigation" class="menu-wrapper" role="navigation">
			<button class="menu-trigger  menu--close  js-menu-trigger">

				<?php get_template_part( 'assets/svg/close-icon-svg' ); ?>

			</button>

			<?php
			wp_nav_menu( array(
				'container' => false,
				'theme_location' => 'primary',
				'menu_class' => 'primary-menu',
				'fallback_cb' => false,
				'walker' => new Listable_Walker_Nav_Menu(),
			) );
			wp_nav_menu( array(
				'container_class' => 'secondary-menu-wrapper',
				'theme_location' => 'secondary',
				'menu_class' => 'primary-menu secondary-menu',
				'fallback_cb' => false,
				'walker' => new Listable_Walker_Nav_Menu(),
			) ); ?>

		</nav>
		<?php endif; ?>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
