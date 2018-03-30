<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <main id="main">.
 *
 * @package StagFramework
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>
<body <?php body_class(); stag_markup_helper( array( 'context' => 'body' ) ); ?>>

<div id="page" class="hfeed site">

	<div id="mobile-wrapper" class="mobile-menu">
		<h3><?php _e( 'Navigation', 'stag' ); ?></h3>
		<a href="#" id="advanced_menu_toggle"><i class="fa fa-align-justify"></i></a>
		<a href="#" id="advanced_menu_hide"><i class="fa fa-times"></i></a>
	</div><!-- #mobile-wrapper -->

	<header class="subheader">

		<div class="inside">

			<div class="grids">
				<div class="grid-6">
					<nav class="subheader-menu-wrap"<?php stag_markup_helper( array( 'context' => 'nav' ) ); ?>>
						<?php
						if ( has_nav_menu( 'subheader' ) ) {
							wp_nav_menu( array( 'theme_location' => 'subheader', 'menu_class' => 'subheader-menu navigation', 'menu_id' => 'subheader-menu', 'container' => false ) );
						}
						?>
					</nav>
				</div>
				<div class="grid-6 subheader-alert">
					<?php
						if ( stag_is_woocommerce_active() ) {
							echo woocommerce_demo_store();
						}
					?>
				</div>
			</div>

		</div>

	</header><!-- .inside  -->

	<header id="masthead" class="site-header"<?php stag_markup_helper( array( 'context' => 'header' ) ); ?>>

		<div class="inside site-branding">

			<div class="grids">
				<div class="grid-6">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
						<?php if ( 'off' == stag_get_option( 'general_text_logo' ) && stag_get_option( 'general_custom_logo' ) != '' ) : ?>
						<img src="<?php echo stag_get_option('general_custom_logo'); ?>" alt="<?php bloginfo( 'name' ); ?>">
						<?php else : ?>
						<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
						<?php endif; ?>
						<p class="site-description"><?php bloginfo( 'description' ); ?></p>
					</a>
				</div>

				<div class="grid-6 header--right">

					<div class="user-meta-wrap">
						<?php if ( stag_is_woocommerce_active() ) : ?>
						<nav class="woo-login-navigation navigation">
							<ul>
								<?php if ( ! is_user_logged_in() ) : ?>
								<li><a href="<?php echo get_permalink( woocommerce_get_page_id( 'myaccount' ) ); ?>"><?php _e( 'Login', 'stag' ); ?></a></li>
								<?php else: ?>
								<li><a href="<?php echo get_permalink( woocommerce_get_page_id( 'myaccount' ) ); ?>"><?php _e( 'My Account', 'stag' ); ?></a></li>
								<li><a href="<?php echo wp_logout_url( get_permalink( woocommerce_get_page_id( 'myaccount' ) ) ); ?>"><?php _e( 'Logout', 'stag' ); ?></a></li>
								<?php endif; ?>
							</ul>
						</nav><!-- .woo-login-navigation -->
						<?php endif; ?>

						<?php
							/**
							 * WPML Language Switcher
							 */
							do_action('icl_language_selector');

							/**
							 * Middle header hooks that can be used for plugin and theme extensions
							 *
							 * Currently: WooCommerce Shopping Cart
							 */
							do_action('crux_middle_header');
						?>
					</div><!-- .user-meta-wrap -->

				</div><!-- .header--right -->
			</div>

		</div><!-- .site-branding -->

		<div id="navbar" class="navbar">

			<nav id="site-navigation" class="main-navigation"<?php stag_markup_helper( array( 'context' => 'nav' ) ); ?>>
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'primary-menu', 'menu_id' => 'primary-menu', 'container' => false ) ); ?>
			</nav><!-- #site-navigation -->

		</div><!-- #navbar -->

	</header><!-- #masthead -->

	<div class="content-wrapper">
		<?php get_template_part('_helper-background'); ?>

		<div id="content" class="site-content">
